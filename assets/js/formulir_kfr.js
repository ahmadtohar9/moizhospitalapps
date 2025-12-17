
(function ($) {
    'use strict';

    // Init Select2 if available
    if ($('.select2').length) {
        $('.select2').select2({ width: '100%' });
    }

    var $form = $('#formulirKfrForm');
    var isEdit = false;

    // Signature Pad Setup
    var canvas = document.getElementById('signaturePad');
    var signaturePad = null;

    function initSignaturePad() {
        if (!canvas) return;

        var ctx = canvas.getContext('2d');
        var drawing = false;
        var lastX = 0;
        var lastY = 0;

        // Set canvas size
        canvas.width = canvas.offsetWidth;
        canvas.height = 150;

        // Mouse events
        canvas.addEventListener('mousedown', function (e) {
            drawing = true;
            var rect = canvas.getBoundingClientRect();
            lastX = e.clientX - rect.left;
            lastY = e.clientY - rect.top;
        });

        canvas.addEventListener('mousemove', function (e) {
            if (!drawing) return;
            var rect = canvas.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.stroke();

            lastX = x;
            lastY = y;
        });

        canvas.addEventListener('mouseup', function () {
            drawing = false;
            saveSignature();
        });

        canvas.addEventListener('mouseleave', function () {
            drawing = false;
        });

        // Touch events for mobile
        canvas.addEventListener('touchstart', function (e) {
            e.preventDefault();
            drawing = true;
            var rect = canvas.getBoundingClientRect();
            var touch = e.touches[0];
            lastX = touch.clientX - rect.left;
            lastY = touch.clientY - rect.top;
        });

        canvas.addEventListener('touchmove', function (e) {
            e.preventDefault();
            if (!drawing) return;
            var rect = canvas.getBoundingClientRect();
            var touch = e.touches[0];
            var x = touch.clientX - rect.left;
            var y = touch.clientY - rect.top;

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.stroke();

            lastX = x;
            lastY = y;
        });

        canvas.addEventListener('touchend', function () {
            drawing = false;
            saveSignature();
        });
    }

    function saveSignature() {
        if (!canvas) return;
        var dataURL = canvas.toDataURL('image/png');
        $('#ttd_dokter').val(dataURL);
    }

    function clearSignature() {
        if (!canvas) return;
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        $('#ttd_dokter').val('');
    }

    function loadSignature(dataURL) {
        if (!canvas || !dataURL) return;
        var ctx = canvas.getContext('2d');
        var img = new Image();
        img.onload = function () {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };
        img.src = dataURL;
    }

    // Clear signature button
    $('#clearSignature').click(function () {
        clearSignature();
    });

    function initTime() {
        var now = new Date();
        var d = now.toISOString().substring(0, 10);
        var t = now.toTimeString().substring(0, 8);
        $('#tgl_perawatan').val(d);
        $('#jam_rawat').val(t);
    }

    function loadHistory() {
        var nr = $('#no_rawat').val();
        $.getJSON(SITE_URL + '/FormulirKfrRalanController/get_history', { no_rawat: nr }, function (res) {
            if (res.status === 'success') {
                var html = '';

                if (res.data && res.data.length > 0) {
                    res.data.forEach(function (item) {
                        html += `
                       <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 shadow-sm" style="border-radius: 8px; border-left: 5px solid #17a2b8;">
                           <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                               <div>
                                   <span class="badge badge-dark p-2 mb-1" style="font-size: 0.9rem;"><i class="fa fa-calendar"></i> ${item.tgl_perawatan}</span>
                                   <span class="badge badge-light border p-2 mb-1 text-dark" style="font-size: 0.9rem;"><i class="fa fa-clock-o"></i> ${item.jam_rawat}</span>
                               </div>
                               <div class="btn-group btn-group-sm">
                                   <button class="btn btn-primary lihat-kfr" 
                                        data-tgl="${item.tgl_perawatan}" 
                                        data-jam="${item.jam_rawat}" 
                                        title="Lihat Detail"><i class="fa fa-eye"></i></button>
                                   <button class="btn btn-secondary cetak-kfr" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Cetak PDF"><i class="fa fa-print"></i></button>
                                   <button class="btn btn-warning copy-kfr" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Copy Data"><i class="fa fa-copy"></i></button>
                                   <button class="btn btn-info edit-kfr" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Edit Data"><i class="fa fa-edit"></i></button>
                                   <button class="btn btn-danger delete-kfr" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Hapus Data"><i class="fa fa-trash"></i></button>
                               </div>
                           </div>
                           
                           <div class="mb-2 pb-2 border-bottom pl-1">
                                <div class="font-weight-bold text-dark mb-1" style="font-size: 1rem;"><i class="fa fa-hashtag text-muted"></i> ${item.no_rawat}</div>
                                <div class="text-primary mb-1"><i class="fa fa-user-md"></i> ${item.nm_dokter || '-'}</div>
                           </div>

                           <div class="p-2 mt-1 bg-light rounded border-top">
                                <div class="mb-1">
                                    <strong class="text-danger">S (Subjective):</strong><br>
                                    ${item.subjective || '-'}
                                </div>
                                <hr class="my-1">
                                <div class="mb-1">
                                    <strong class="text-primary">O (Objective):</strong><br>
                                    ${item.objective || '-'}
                                </div>
                                <hr class="my-1">
                                <div class="mb-1">
                                    <strong class="text-success">A (Assessment):</strong><br>
                                    ${item.assessment || '-'}
                                </div>
                                <hr class="my-1">
                                <div>
                                    <strong class="text-info">Tindakan Rehab:</strong><br>
                                    ${item.tindakan_rehab || '-'}
                                </div>
                           </div>
                       </div>
                       `;
                    });
                    $('#historyList').html(html);
                } else {
                    $('#historyList').html('<div class="p-3 text-center text-muted">Belum ada riwayat.</div>');
                }
            }
        });
    }

    $form.on('submit', function (e) {
        e.preventDefault();
        var url = isEdit ? '/FormulirKfrRalanController/update' : '/FormulirKfrRalanController/save';

        $.ajax({
            url: SITE_URL + url,
            type: 'POST',
            data: $form.serialize(),
            dataType: 'JSON',
            success: function (res) {
                if (res.status === 'success') {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: res.message, timer: 1500, showConfirmButton: false });
                    } else {
                        alert(res.message);
                    }
                    resetForm();
                    loadHistory();
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                alert('Gagal menyimpan data.');
            }
        });
    });

    // Populate Helper
    function populateForm(d) {
        $('#subjective').val(d.subjective);
        $('#objective').val(d.objective);
        $('#assessment').val(d.assessment);

        $('#goal_of_treatment').val(d.goal_of_treatment);
        $('#tindakan_rehab').val(d.tindakan_rehab);
        $('#edukasi').val(d.edukasi);
        $('#frekuensi_kunjungan').val(d.frekuensi_kunjungan);
        $('#rencana_tindak_lanjut').val(d.rencana_tindak_lanjut);

        $('#kd_dokter').val(d.kd_dokter).trigger('change');

        // Load signature if exists
        if (d.ttd_dokter) {
            loadSignature(d.ttd_dokter);
            $('#ttd_dokter').val(d.ttd_dokter);
        }
    }

    // Buttons Handlers
    $(document).on('click', '.copy-kfr', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.getJSON(SITE_URL + '/FormulirKfrRalanController/get_detail', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            if (res.status === 'success') {
                populateForm(res.data);
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'info', title: 'Data Disalin', text: 'Sesuaikan waktu & simpan.', timer: 1500 });
            }
        });
    });

    $(document).on('click', '.edit-kfr', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.getJSON(SITE_URL + '/FormulirKfrRalanController/get_detail', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            if (res.status === 'success') {
                isEdit = true;
                $('#original_jam_rawat').val(res.data.jam_rawat);
                $('#tgl_perawatan').val(res.data.tgl_perawatan);
                $('#jam_rawat').val(res.data.jam_rawat);

                populateForm(res.data);

                $form.find('button[type="submit"]').html('<i class="fa fa-edit"></i> Update Data').removeClass('btn-primary').addClass('btn-success');
            }
        });
    });

    $(document).on('click', '.delete-kfr', function () {
        if (!confirm('Hapus data ini?')) return;
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.post(SITE_URL + '/FormulirKfrRalanController/delete', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            var r = (typeof res === 'string') ? JSON.parse(res) : res;
            if (r.status === 'success') {
                loadHistory();
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'success', title: 'Terhapus', timer: 1000, showConfirmButton: false });
            } else {
                alert(r.message);
            }
        });
    });

    $(document).on('click', '.lihat-kfr', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.getJSON(SITE_URL + '/FormulirKfrRalanController/get_detail', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            if (res.status === 'success') {
                var d = res.data;
                $('#view_waktu').text(d.tgl_perawatan + ' ' + d.jam_rawat);
                $('#view_dokter').text(d.nm_dokter);

                $('#view_s').text(d.subjective || '-');
                $('#view_o').text(d.objective || '-');
                $('#view_a').text(d.assessment || '-');

                $('#view_goal').text(d.goal_of_treatment || '-');
                $('#view_tindakan').text(d.tindakan_rehab || '-');
                $('#view_edukasi').text(d.edukasi || '-');
                $('#view_frek').text(d.frekuensi_kunjungan || '-');
                $('#view_plan_lanjut').text(d.rencana_tindak_lanjut || '-');

                $('#modalLihatKfr').modal('show');
            }
        });
    });

    $(document).on('click', '.cetak-kfr', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();
        var url = SITE_URL + '/FormulirKfrRalanController/cetak' + '?no_rawat=' + encodeURIComponent(nr) + '&tgl_perawatan=' + encodeURIComponent(tgl) + '&jam_rawat=' + encodeURIComponent(jam);
        window.open(url, '_blank');
    });

    function resetForm() {
        isEdit = false;
        $form[0].reset();
        $('#original_jam_rawat').val('');
        $('#kd_dokter').trigger('change');
        $form.find('button[type="submit"]').html('<i class="fa fa-save"></i> Simpan Data').removeClass('btn-success').addClass('btn-primary');
        clearSignature(); // Clear signature pad
        initTime();
    }

    $('#btnCancel').click(resetForm);

    // Load latest SOAP Plan from Program Rehab Medik
    function loadLatestSoapPlan() {
        var nr = $('#no_rawat').val();
        if (!nr) return;

        $.getJSON(SITE_URL + '/FormulirKfrRalanController/get_latest_soap_plan', { no_rawat: nr }, function (res) {
            if (res.status === 'success' && res.soap) {
                // Populate all SOAP fields
                if (res.soap.subjective) $('#subjective').val(res.soap.subjective);
                if (res.soap.objective) $('#objective').val(res.soap.objective);
                if (res.soap.assessment) $('#assessment').val(res.soap.assessment);
                if (res.soap.plan) $('#tindakan_rehab').val(res.soap.plan);

                console.log('Auto-populated SOAP (S, O, A, P) from latest Program Rehab Medik');
            }
        });
    }

    // Initial Load
    initSignaturePad(); // Initialize signature pad
    initTime();
    loadHistory();
    loadLatestSoapPlan(); // Auto-populate from latest SOAP

})(jQuery);

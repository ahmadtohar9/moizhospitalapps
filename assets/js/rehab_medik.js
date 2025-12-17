
(function ($) {
    'use strict';

    // Init Select2 if available
    if ($('.select2').length) {
        $('.select2').select2({ width: '100%' });
    }

    var $form = $('#rehabForm');
    var isEdit = false;

    function initTime() {
        var now = new Date();
        var d = now.toISOString().substring(0, 10);
        var t = now.toTimeString().substring(0, 8);
        $('#tgl_perawatan').val(d);
        $('#jam_rawat').val(t);
    }

    function loadHistory() {
        var nr = $('#no_rawat').val();
        $.getJSON(SITE_URL + '/RehabMedikRalanController/get_history', { no_rawat: nr }, function (res) {
            if (res.status === 'success') {
                var html = '';
                // Get today's date YYYY-MM-DD
                var today = new Date().toISOString().slice(0, 10);

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
                                   <button class="btn btn-primary lihat-rehab" 
                                        data-tgl="${item.tgl_perawatan}" 
                                        data-jam="${item.jam_rawat}" 
                                        data-s="${item.subjective}"
                                        data-o="${item.objective}"
                                        data-a="${item.assessment}"
                                        data-p="${item.procedure_text}"
                                        data-dokter="${item.nm_dokter || '-'}"
                                        data-petugas="${item.nm_petugas || '-'}"
                                        title="Lihat Detail"><i class="fa fa-eye"></i></button>
                                   <button class="btn btn-secondary cetak-rehab" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Cetak PDF"><i class="fa fa-print"></i></button>
                                   <button class="btn btn-warning copy-rehab" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Copy Data"><i class="fa fa-copy"></i></button>
                                   <button class="btn btn-info edit-rehab" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Edit Data"><i class="fa fa-edit"></i></button>
                                   <button class="btn btn-danger delete-rehab" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" title="Hapus Data"><i class="fa fa-trash"></i></button>
                               </div>
                           </div>
                           
                           <div class="mb-2 pb-2 border-bottom pl-1">
                                <div class="font-weight-bold text-dark mb-1" style="font-size: 1rem;"><i class="fa fa-hashtag text-muted"></i> ${item.no_rawat}</div>
                                <div class="text-primary mb-1"><i class="fa fa-user-md"></i> ${item.nm_dokter || '-'}</div>
                                <div class="text-success"><i class="fa fa-users"></i> ${item.nm_petugas || '-'}</div>
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
                                 <div class="mb-1">
                                     <strong class="text-warning text-dark">P (Plan/Procedure):</strong><br>
                                     <span class="text-dark font-italic">${item.procedure_text || '-'}</span>
                                 </div>
                                 <hr class="my-2">
                                 <div class="mb-1">
                                     <strong class="text-info"><i class="fa fa-heartbeat"></i> TTV:</strong><br>
                                     <small>
                                         Tensi: ${item.tensi || '-'} | Nadi: ${item.nadi || '-'} | Suhu: ${item.suhu_tubuh || '-'}°C | 
                                         RR: ${item.respirasi || '-'} | SpO2: ${item.spo2 || '-'}% | Tinggi: ${item.tinggi || '-'}cm | 
                                         Berat: ${item.berat || '-'}kg | GCS: ${item.gcs || '-'}
                                     </small>
                                 </div>
                                 ${item.instruksi ? `<hr class="my-1"><div class="mb-1"><strong class="text-secondary"><i class="fa fa-clipboard-list"></i> Instruksi:</strong><br>${item.instruksi}</div>` : ''}
                                 ${item.evaluasi ? `<hr class="my-1"><div><strong class="text-dark"><i class="fa fa-check-circle"></i> Evaluasi:</strong><br>${item.evaluasi}</div>` : ''}
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
        var url = isEdit ? '/RehabMedikRalanController/update' : '/RehabMedikRalanController/save';

        $.ajax({
            url: SITE_URL + url,
            type: 'POST',
            data: $form.serialize(),
            dataType: 'JSON',
            success: function (res) {
                if (res.status === 'success') {
                    // Alert Toast style if possible, or sweetalert
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

    // Fitur Lihat Modal
    $(document).on('click', '.lihat-rehab', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');

        $('#view_waktu').text(tgl + ' Pukul ' + jam);
        $('#view_dokter').text($(this).data('dokter'));
        $('#view_petugas').text($(this).data('petugas'));

        $('#view_s').text($(this).data('s') || '-');
        $('#view_o').text($(this).data('o') || '-');
        $('#view_a').text($(this).data('a') || '-');
        $('#view_p').text($(this).data('p') || '-');

        $('#modalLihatRehab').modal('show');
    });

    // Fitur Cetak
    $(document).on('click', '.cetak-rehab', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        // Gunakan Query String biar aman dari slash
        var url = SITE_URL + '/RehabMedikRalanController/cetak' +
            '?no_rawat=' + encodeURIComponent(nr) +
            '&tgl_perawatan=' + encodeURIComponent(tgl) +
            '&jam_rawat=' + encodeURIComponent(jam);

        window.open(url, '_blank');
    });

    // Fitur Copy
    $(document).on('click', '.copy-rehab', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        // Load detail, tapi jangan set isEdit = true
        $.getJSON(SITE_URL + '/RehabMedikRalanController/get_detail', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            if (res.status === 'success') {
                var d = res.data;

                // Isi form kecuali waktu (biarkan waktu sekarang)
                // $('#tgl_perawatan').val(d.tgl_perawatan); // Jangan copy tanggal
                // $('#jam_rawat').val(d.jam_rawat); // Jangan copy jam

                $('#subjective').val(d.subjective);
                $('#objective').val(d.objective);
                $('#assessment').val(d.assessment);
                $('#procedure_text').val(d.procedure_text);

                // TTV fields
                $('#tensi').val(d.tensi || '');
                $('#nadi').val(d.nadi || '');
                $('#suhu_tubuh').val(d.suhu_tubuh || '');
                $('#respirasi').val(d.respirasi || '');
                $('#tinggi').val(d.tinggi || '');
                $('#berat').val(d.berat || '');
                $('#spo2').val(d.spo2 || '');
                $('#gcs').val(d.gcs || '');

                // Instruksi & Evaluasi
                $('#instruksi').val(d.instruksi || '');
                $('#evaluasi').val(d.evaluasi || '');

                // Set dokter/tim jika perlu, atau biarkan user pilih baru
                $('#kd_dokter').val(d.kd_dokter).trigger('change');
                $('#nip_tim_rehab').val(d.nip_tim_rehab).trigger('change');

                // Beri notifikasi visual
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'info', title: 'Data Disalin', text: 'Silakan sesuaikan tanggal/jam dan simpan sebagai data baru.', timer: 2000, showConfirmButton: false });
                }
            }
        });
    });

    $(document).on('click', '.edit-rehab', function () {
        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.getJSON(SITE_URL + '/RehabMedikRalanController/get_detail', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            if (res.status === 'success') {
                var d = res.data;
                isEdit = true;
                $('#original_jam_rawat').val(d.jam_rawat);

                $('#tgl_perawatan').val(d.tgl_perawatan);
                $('#jam_rawat').val(d.jam_rawat);
                $('#subjective').val(d.subjective);
                $('#objective').val(d.objective);
                $('#assessment').val(d.assessment);
                $('#procedure_text').val(d.procedure_text);

                // TTV fields
                $('#tensi').val(d.tensi || '');
                $('#nadi').val(d.nadi || '');
                $('#suhu_tubuh').val(d.suhu_tubuh || '');
                $('#respirasi').val(d.respirasi || '');
                $('#tinggi').val(d.tinggi || '');
                $('#berat').val(d.berat || '');
                $('#spo2').val(d.spo2 || '');
                $('#gcs').val(d.gcs || '');

                // Instruksi & Evaluasi
                $('#instruksi').val(d.instruksi || '');
                $('#evaluasi').val(d.evaluasi || '');

                $('#kd_dokter').val(d.kd_dokter).trigger('change');
                $('#nip_tim_rehab').val(d.nip_tim_rehab).trigger('change');

                $form.find('button[type="submit"]').html('<i class="fa fa-edit"></i> Update Data').removeClass('btn-primary').addClass('btn-success');
            }
        });
    });

    $(document).on('click', '.delete-rehab', function () {
        if (!confirm('Hapus data ini?')) return;

        var tgl = $(this).data('tgl');
        var jam = $(this).data('jam');
        var nr = $('#no_rawat').val();

        $.post(SITE_URL + '/RehabMedikRalanController/delete', { no_rawat: nr, tgl_perawatan: tgl, jam_rawat: jam }, function (res) {
            // Check if response is string or object
            var r = (typeof res === 'string') ? JSON.parse(res) : res;

            if (r.status === 'success') {
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'success', title: 'Terhapus', timer: 1000, showConfirmButton: false });
                loadHistory();
            } else {
                alert(r.message);
            }
        });
    });

    function resetForm() {
        isEdit = false;
        $form[0].reset();
        $('#original_jam_rawat').val('');
        // Trigger change biar select2 update tampilannya sesuai nilai reset form (default doctor/staff)
        $('#kd_dokter').trigger('change');
        $('#nip_tim_rehab').trigger('change');
        $form.find('button[type="submit"]').html('<i class="fa fa-save"></i> Simpan Data').removeClass('btn-success').addClass('btn-primary');
        initTime();
    }

    $('#btnCancel').click(resetForm);

    // Start
    initTime();
    loadHistory();

})(jQuery);

$(document).ready(function () {
    console.log("🚀 tindakanDokterRalan.js Loaded!");

    const noRawat = $('#no_rawat').val();
    const kdDokter = $('#kd_dokter').val();
    const noRkmMedis = $('#no_rkm_medis').val();
    const apiUrl = BASE_URL + "TindakanRalanDokterController";

    if (!noRawat) {
        console.warn("⚠️ No Rawat tidak ditemukan. Tidak bisa memuat data.");
        return;
    }

    // Load data tindakan dan hasil tindakan
    loadTindakan();
    loadHasilTindakan();

    // Fungsi format Rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR', 
            minimumFractionDigits: 0, 
            maximumFractionDigits: 0 
        }).format(angka);
    }

    $('#searchTindakan').on('input', function () {
        const keyword = $(this).val().toLowerCase();

        // Sembunyikan semua baris terlebih dahulu
        $('#tindakanBody tr').each(function () {
            $(this).toggle(false);
        });

        // Tampilkan baris yang sesuai dengan pencarian
        $('#tindakanBody tr').filter(function () {
            return $(this).text().toLowerCase().includes(keyword);
        }).toggle(true);

        // Prioritaskan baris yang telah dicentang untuk tampil di atas
        $('#tindakanBody').prepend($('#tindakanBody tr.checked-row'));
    });

    // Fungsi untuk memuat data tindakan dengan format Rupiah
    function loadTindakan() {
        $.get(`${apiUrl}/getTindakan`, { no_rawat: noRawat }, function (response) {
            let html = '';
            let tindakanCount = response.data.length; // Hitung jumlah tindakan

            if (response.status === 'success' && tindakanCount > 0) {
                response.data.forEach((tindakan, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <input type="checkbox" class="tindakan-checkbox" 
                                    data-kode="${tindakan.kd_jenis_prw}"
                                    data-material="${tindakan.material}"
                                    data-bhp="${tindakan.bhp}"
                                    data-tarif-tindakandr="${tindakan.tarif_tindakandr}"
                                    data-kso="${tindakan.kso}"
                                    data-menejemen="${tindakan.menejemen}"
                                    data-biaya-rawat="${tindakan.total_byrdr}">
                            </td>
                            <td>${tindakan.kd_jenis_prw}</td>
                            <td>${tindakan.nm_perawatan}</td>
                            <td>${tindakan.nm_kategori}</td>
                            <td>${formatRupiah(tindakan.total_byrdr)}</td>
                        </tr>`;
                });

                // Cek apakah jumlah data lebih dari 5, jika ya, aktifkan scroll
                if (tindakanCount > 5) {
                    $('#tindakanTable').parent().css('max-height', '250px');
                    $('#tindakanTable').parent().css('overflow-y', 'auto');
                } else {
                    $('#tindakanTable').parent().css('max-height', '');
                    $('#tindakanTable').parent().css('overflow-y', '');
                }

            } else {
                html = '<tr><td colspan="6" class="text-center">Tidak ada data tersedia.</td></tr>';
            }

            $('#tindakanBody').html(html);
        }, 'json');
    }

    // Tandai checklist baris sebagai prioritas
    $(document).on('change', '.tindakan-checkbox', function () {
        const row = $(this).closest('tr');
        if ($(this).is(':checked')) {
            row.addClass('checked-row');
        } else {
            row.removeClass('checked-row');
        }
    });

    function loadHasilTindakan() 
    {
        $.get(`${apiUrl}/getHasilTindakan`, { no_rawat: noRawat }, function (response) {
            let html = '';
            let totalTagihan = 0;

            if (response.status === 'success' && response.data.length > 0) {
                response.data.forEach((data, index) => {
                    totalTagihan += parseFloat(data.biaya_rawat); // hitung total
                    html += `
                        <tr>
                            <td>
                                <input type="checkbox" class="hasil-checkbox" 
                                    data-no_rawat="${data.no_rawat}" 
                                    data-kd_jenis_prw="${data.kd_jenis_prw}" 
                                    data-tgl_perawatan="${data.tgl_perawatan}" 
                                    data-jam_rawat="${data.jam_rawat}">
                            </td>
                            <td>${index + 1}</td>
                            <td>${data.tgl_perawatan}</td>
                            <td>${data.jam_rawat}</td>
                            <td>${data.nm_dokter}</td>
                            <td>${data.kd_jenis_prw}</td>
                            <td>${data.nm_perawatan}</td>
                            <td>${formatRupiah(data.biaya_rawat)}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-single" 
                                    data-no_rawat="${data.no_rawat}" 
                                    data-kd_jenis_prw="${data.kd_jenis_prw}" 
                                    data-tgl_perawatan="${data.tgl_perawatan}" 
                                    data-jam_rawat="${data.jam_rawat}">
                                    Hapus
                                </button>
                            </td>
                        </tr>`;
                });

                // Tambahkan baris total ke tbody
                html += `
                    <tr style="background:#f8f8f8;font-weight:bold;">
                        <td colspan="7" class="text-right">Total Tagihan</td>
                        <td colspan="2">${formatRupiah(totalTagihan)}</td>
                    </tr>`;
            } else {
                html = '<tr><td colspan="9" class="text-center text-muted">Belum ada tindakan.</td></tr>';
            }

            $('#hasilTindakanBody').html(html);
        }, 'json');
    }


    // Simpan tindakan
        $('#saveTindakan').on('click', function () {
            let selectedTindakan = [];
            const tglPerawatan = new Date().toISOString().split('T')[0];
            const jamRawat = new Date().toLocaleTimeString('it-IT');

            $('.tindakan-checkbox:checked').each(function () {
                selectedTindakan.push({
                    kd_jenis_prw: $(this).data('kode'),
                    kd_dokter: kdDokter,
                    material: $(this).data('material'),
                    bhp: $(this).data('bhp'),
                    tarif_tindakandr: $(this).data('tarif-tindakandr'),
                    kso: $(this).data('kso'),
                    menejemen: $(this).data('menejemen'),
                    biaya_rawat: $(this).data('biaya-rawat'),
                    tgl_perawatan: tglPerawatan,
                    jam_rawat: jamRawat,
                    stts_bayar: 'Belum'
                });
            });

            if (selectedTindakan.length === 0) {
                Swal.fire('Pilih minimal satu tindakan.', '', 'warning');
                return;
            }

            $.post(`${apiUrl}/saveTindakan`, { no_rawat: noRawat, kd_dokter: kdDokter, tindakan: selectedTindakan }, function (response) {
                Swal.fire({
                    title: 'Tindakan berhasil disimpan!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Hilangkan checklist setelah data tersimpan
                $('.tindakan-checkbox:checked').prop('checked', false).closest('tr').removeClass('checked-row');

                loadHasilTindakan();
            }, 'json');
        });


    // Hapus banyak tindakan
    $('#deleteSelectedTindakan').on('click', function () {
        let selectedItems = [];
        $('.hasil-checkbox:checked').each(function () {
            selectedItems.push({
                no_rawat: $(this).data('no_rawat'),
                kd_jenis_prw: $(this).data('kd_jenis_prw'),
                tgl_perawatan: $(this).data('tgl_perawatan'),
                jam_rawat: $(this).data('jam_rawat')
            });
        });

        if (selectedItems.length === 0) {
            Swal.fire('Pilih minimal satu tindakan untuk dihapus.', '', 'warning');
            return;
        }

        $.post(`${apiUrl}/deleteTindakan`, { items: selectedItems }, function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    title: 'Tindakan berhasil dihapus!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Hilangkan baris yang dicentang sebelum refresh data
                $('.hasil-checkbox:checked').closest('tr').fadeOut(2000, function () {
                    $(this).remove();
                    loadHasilTindakan();
                });

                // Hilangkan checklist setelah penghapusan
                $('.hasil-checkbox:checked').prop('checked', false);

            } else {
                Swal.fire('Gagal menghapus tindakan.', '', 'error');
            }
        }, 'json');
    });

    $('#btnRiwayatTindakan').on('click', function () {
        loadRiwayatTindakan(); // Panggil fungsi yang ambil dari input hidden
    });


   function loadRiwayatTindakan() 
   {
        const noRkmMedis = $('#no_rkm_medis').val();
        if (!noRkmMedis) return;

        $.get(`${apiUrl}/getRiwayatTindakanByNorm`, { no_rkm_medis: noRkmMedis }, function (res) {
            let html = '';
            if (res.status === 'success' && res.data.length > 0) {
                const grouped = {};
                res.data.forEach(item => {
                    if (!grouped[item.no_rawat]) grouped[item.no_rawat] = [];
                    grouped[item.no_rawat].push(item);
                });

                let index = 1;
                for (const [noRawat, items] of Object.entries(grouped)) {
                    const info = items[0];

                    html += `
                    <table class="table table-bordered mb-4">
                      <thead class="thead-light">
                        <tr class="bg-light">
                          <th colspan="6" class="text-left">
                            <strong>${index++}. No. Rawat:</strong> ${info.no_rawat}<br/>
                            <strong>Tanggal:</strong> ${info.tgl_perawatan} <br/>
                            <strong>Dokter:</strong> ${info.nm_dokter}
                            <br/>
                            <span class="float-right">
                              <input type="checkbox" class="check-group" data-group="${noRawat}">
                              <label class="mb-0 ml-1">Pilih Semua</label>
                            </span>
                          </th>
                        </tr>
                        <tr class="text-center">
                          <th style="width:5%">#</th>
                          <th style="width:5%"></th>
                          <th>Jam</th>
                          <th>Nama Tindakan</th>
                          <th>Tarif</th>
                          <th style="width:10%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>`;

                    items.forEach((item, i) => {
                        const jsonData = JSON.stringify(item).replace(/"/g, '&quot;');
                        html += `
                        <tr>
                          <td class="text-center">${i + 1}</td>
                          <td class="text-center">
                            <input type="checkbox" class="checkbox-copy-tindakan" 
                              data-json="${jsonData}" 
                              data-group="${noRawat}">
                          </td>
                          <td>${item.jam_rawat}</td>
                          <td>${item.nm_perawatan}</td>
                          <td>${formatRupiah(item.biaya_rawat)}</td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-primary btn-copy-tindakan"
                              data-kode="${item.kd_jenis_prw}"
                              data-material="${item.material}"
                              data-bhp="${item.bhp}"
                              data-tarif="${item.tarif_tindakandr}"
                              data-kso="${item.kso}"
                              data-menejemen="${item.menejemen}"
                              data-biaya="${item.biaya_rawat}">
                              Copy
                            </button>
                          </td>
                        </tr>`;
                    });

                    html += `</tbody></table>`;
                }
            } else {
                html = `<div class="alert alert-warning text-center">Tidak ada riwayat tindakan.</div>`;
            }

            $('#containerRiwayatTindakan').html(html);
            $('#modalRiwayatTindakan').modal('show');
        }, 'json');
    }


    $(document).on('change', '.check-group', function () 
    {
        const groupId = $(this).data('group');
        $(`.checkbox-copy-tindakan[data-group="${groupId}"]`).prop('checked', $(this).prop('checked'));
    });

    // Salin ke checklist tindakan saat klik “Copy”
    $(document).on('click', '.btn-copy-tindakan', function () {
        const tr = $('#tindakanBody tr').filter((_, el) => 
            $(el).find(`[data-kode="${$(this).data('kode')}"]`).length
        );
        if (tr.length > 0) {
            tr.find('input[type="checkbox"]').prop('checked', true).trigger('change');
            Swal.fire({
                    title: 'Data Berhasil Dicopy!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            return;
        } else {
            Swal.fire('⚠️ Tindakan tidak ditemukan di daftar master.', '', 'warning');
        }
        $('#modalRiwayatTindakan').modal('hide');
    });

    $('#btnCopySelected').on('click', function () 
    {
        const selectedData = [];

        $('.checkbox-copy-tindakan:checked').each(function () {
            const jsonStr = $(this).attr('data-json'); // ambil string JSON
            const data = JSON.parse(jsonStr); // parse ke object JS
            selectedData.push(data);
        });

        if (selectedData.length === 0) {
            Swal.fire({
                    title: 'Pilih Minimal 1 Data!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            return;
        }

        selectedData.forEach(item => {
            const row = $('#tindakanBody tr').filter((_, el) =>
                $(el).find(`[data-kode="${item.kd_jenis_prw}"]`).length
            );
            if (row.length > 0) {
                row.find('input[type="checkbox"]').prop('checked', true).trigger('change');
            }
        });

        $('#modalRiwayatTindakan').modal('hide');
        Swal.fire({
                    title: 'Data Berhasil Dicopy!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
    });




    // Hapus satu tindakan
    $(document).on('click', '.delete-single', function () {
        const no_rawat = $(this).data('no_rawat');
        const kd_jenis_prw = $(this).data('kd_jenis_prw');
        const tgl_perawatan = $(this).data('tgl_perawatan');
        const jam_rawat = $(this).data('jam_rawat');
        const row = $(this).closest('tr'); // Ambil baris yang akan dihapus

        $.post(`${apiUrl}/deleteTindakan`, { 
            items: [{ no_rawat, kd_jenis_prw, tgl_perawatan, jam_rawat }]
        }, function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    title: 'Tindakan berhasil dihapus!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Hilangkan baris yang dihapus sebelum refresh data
                row.fadeOut(2000, function () {
                    $(this).remove();
                    loadHasilTindakan();
                });

                // Hilangkan checklist setelah penghapusan
                $('.hasil-checkbox:checked').prop('checked', false);

            } else {
                Swal.fire('Gagal menghapus tindakan.', '', 'error');
            }
        }, 'json');
    });

    // Pilih semua checkbox
    $('#selectAllHasil').on('change', function () {
        $('.hasil-checkbox').prop('checked', $(this).prop('checked'));
    });
});
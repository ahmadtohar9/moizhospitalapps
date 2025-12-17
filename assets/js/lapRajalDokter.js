$(document).ready(function () {
    const today = new Date().toISOString().split('T')[0];
    $('#start_date').val(today);
    $('#end_date').val(today);

    // Fungsi utama untuk load data
    function loadLaporan() {
        let tgl_awal = $('#start_date').val();
        let tgl_akhir = $('#end_date').val();
        let kd_dokter = $('#dokter').val();

        $.ajax({
            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {
                tgl_awal: tgl_awal,
                tgl_akhir: tgl_akhir,
                kd_dokter: kd_dokter
            },
            success: function (res) {
                // Tabel
                let html = '';
                if (res.data.length > 0) {
                    $.each(res.data, function (i, item) {
                        html += `<tr>
                            <td>${i + 1}</td>
                            <td>${item.no_rawat}</td>
                            <td>${item.no_rkm_medis}</td>
                            <td>${item.nm_pasien}</td>
                            <td>${item.tgl_registrasi}</td>
                            <td>${item.nm_dokter}</td>
                            <td>${item.stts}</td>
                            <td>${item.no_tlp}</td>
                        </tr>`;
                    });
                } else {
                    html = '<tr><td colspan="8" class="text-center">Tidak ada data ditemukan.</td></tr>';
                }
                $('#laporanTable tbody').html(html);

                // Ringkasan Dokter
                let cardHTML = '';
                if (res.total_per_dokter.length > 0) {
                    $.each(res.total_per_dokter, function (i, d) {
                        cardHTML += `
                            <div class="col-md-3">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>${d.total_pasien}</h3>
                                        <p>${d.nm_dokter}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-user-md"></i>
                                    </div>
                                </div>
                            </div>`;
                    });
                }
                $('#cardSummary').html(cardHTML);
            },
            error: function () {
                alert('Gagal mengambil data laporan.');
            }
        });
    }

    // Cetak PDF
    $('#printPdf').on('click', function (e) {
        e.preventDefault();
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const dokter = $('#dokter').val();
        const url = PRINT_URL + `?start_date=${start_date}&end_date=${end_date}&dokter=${dokter}`;
        window.open(url, '_blank');
    });

    // Tombol filter
    $('#filterButton').on('click', function () {
        loadLaporan();
    });

    // Load otomatis saat buka halaman
    loadLaporan();
});

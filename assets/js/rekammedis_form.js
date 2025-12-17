$(document).ready(function () {
    // Fungsi untuk memuat data hasil SOAP
    function loadHasilSOAP() {
        $.ajax({
            url: API_GET_HASIL_SOAP,
            type: "GET",
            data: { no_rawat: NO_RAWAT },
            success: function (response) {
                if ($.trim(response) === '') {
                    $('#hasil-soap-body').html('<tr><td colspan="11" class="text-center">Belum ada data hasil SOAP.</td></tr>');
                } else {
                    $('#hasil-soap-body').html(response);
                }
            },
            error: function (xhr, status, error) {
                console.error('Gagal memuat data hasil SOAP:', error);
                alert('Terjadi kesalahan saat memuat data hasil SOAP.');
            }
        });
    }

    // Perbarui tanggal dan waktu secara otomatis
    function updateDateTime() {
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().split('T')[0]; // Format tanggal: YYYY-MM-DD
        const formattedTime = currentDate.toTimeString().split(' ')[0]; // Format waktu: HH:MM:SS

        $('#tgl_perawatan').val(formattedDate);
        $('#jam_rawat').val(formattedTime);
    }

    // Jalankan saat halaman dimuat
    loadHasilSOAP();
    updateDateTime();

    // Perbarui setiap detik
    setInterval(updateDateTime, 1000);
});

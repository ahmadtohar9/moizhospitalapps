document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const printButton = document.getElementById('printButton');
    const totalPiutangFooter = document.getElementById('totalPiutang');

   const piutangTable = $('#piutangTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true, // Aktifkan mode responsif
        scrollX: true // Tambahkan scroll horizontal jika tabel terlalu lebar
    });

    // Format angka menjadi format Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Update total piutang di footer
    function updateTotalPiutang() {
        let total = 0;
        piutangTable.rows({ search: 'applied' }).data().each(function (row) {
            const piutang = parseFloat(row[5].replace(/[^0-9.-]+/g, "")) || 0;
            total += piutang;
        });
        totalPiutangFooter.textContent = formatRupiah(total);
    }

    function loadData(start_date = '', end_date = '', penjab = '') {
        fetch(`${API_URL_RANAP}?start_date=${start_date}&end_date=${end_date}&penjab=${penjab}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                piutangTable.clear();
                data.forEach((item, index) => {
                    piutangTable.row.add([
                        index + 1,
                        item.no_rawat,
                        item.no_rkm_medis,
                        item.nm_pasien,
                        item.png_jawab,
                        formatRupiah(item.totalpiutang)
                    ]).draw(false);
                });
                updateTotalPiutang(); // Update total piutang setelah data dimuat
            })
            .catch(error => console.error('Error:', error));
    }

    // Load data default sesuai tanggal komputer
    loadData();

    // Update total setiap tabel berubah (pencarian/filter)
    piutangTable.on('draw', function () {
        updateTotalPiutang();
    });

    // Event listener untuk tombol Filter
    filterButton.addEventListener('click', function () {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const penjab = document.getElementById('penjab').value;

        loadData(start_date, end_date, penjab);
    });

    // Event listener untuk tombol Cetak PDF
    printButton.addEventListener('click', function () {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const penjab = document.getElementById('penjab').value;

        // Ambil data dari search bar (filter nama pasien)
        const searchValue = $('.dataTables_filter input').val();

        // Kirim parameter tambahan ke URL
        window.open(`${PRINT_URL_RANAP}?start_date=${start_date}&end_date=${end_date}&penjab=${penjab}&search=${searchValue}`, '_blank');
    });
});

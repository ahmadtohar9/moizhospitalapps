document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const printButton = document.getElementById('printButton');
    const copyButton = document.getElementById('copyButton');
    const totalTagihanFooter = document.getElementById('totalTagihan');

    // Set tanggal default hari ini
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("start_date").value = today;
    document.getElementById("end_date").value = today;

    // Format angka ke format Rupiah
    function formatRupiah(angka) {
        let value = parseFloat(angka);
        return 'Rp ' + (isNaN(value) ? 0 : value.toLocaleString('id-ID'));
    }

    // Inisialisasi DataTables
    const billingTable = $('#billingTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        scrollX: true,
        data: [],
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // No
            { data: 'tgl_byr', defaultContent: '-' },
            { data: 'no_rawat', defaultContent: '-' },
            { data: 'No_RM', defaultContent: '-' },
            { data: 'Nama_Pasien', defaultContent: '-' },
            { data: 'Nama_Dokter', defaultContent: '-' },
            { data: 'Adm', render: d => formatRupiah(d || 0) },
            { data: 'Total_Obat', render: d => formatRupiah(d || 0) },
            { data: 'Total_Labor', render: d => formatRupiah(d || 0) },
            { data: 'Tindakan_Konsul', render: d => formatRupiah(d || 0) },
            { data: 'Tindakan_USG', render: d => formatRupiah(d || 0) },
            { data: 'Tindakan_Lain', render: d => formatRupiah(d || 0) },
            { data: 'Sewa_Ruangan', render: d => formatRupiah(d || 0) },
            { data: 'Jasa_Layanan', render: d => formatRupiah(d || 0) },
            { data: 'Jasa_DokterTambahan', render: d => formatRupiah(d || 0) },
            { data: 'Tambahan_Biaya', render: d => formatRupiah(d || 0) },
            { data: 'Potongan_Biaya', render: d => formatRupiah(d || 0) },
            { data: 'Total_Tagihan', render: d => formatRupiah(d || 0) }
        ]
    });

    // Update total tagihan di footer
    function updateTotalTagihan() {
        let total = 0;
        billingTable.rows({ search: 'applied' }).data().each(function (row) {
            const tagihan = parseFloat(row.Total_Tagihan || 0);
            if (!isNaN(tagihan)) {
                total += tagihan;
            }
        });
        totalTagihanFooter.textContent = formatRupiah(total);
    }

    // Load data dari server
    function loadData() {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const dokter = document.getElementById('dokter').value;

        fetch(`${API_URL_RALAN}?start_date=${start_date}&end_date=${end_date}&dokter=${dokter}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                console.log("RESPON API:", result); // debug
                const data = result.data || result;
                billingTable.clear().rows.add(data).draw();
                updateTotalTagihan();
            })
            .catch(error => {
                console.error('Gagal memuat data:', error);
                billingTable.clear().draw();
                totalTagihanFooter.textContent = formatRupiah(0);
            });
    }

    // Load data saat halaman dibuka
    loadData();

    // Update total saat tabel digambar ulang
    billingTable.on('draw', function () {
        updateTotalTagihan();
    });

    // Tombol Filter
    filterButton.addEventListener('click', function () {
        loadData();
    });

    // Tombol Cetak PDF
    printButton.addEventListener('click', function () {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const dokter = document.getElementById('dokter').value;
        window.open(`${PRINT_URL_RALAN}?start_date=${start_date}&end_date=${end_date}&dokter=${dokter}`, '_blank');
    });

    // Tombol Copy ke clipboard
    if (copyButton) {
        copyButton.addEventListener('click', function () {
            const table = document.getElementById("billingTable");
            const range = document.createRange();
            range.selectNode(table);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("Data telah disalin! Silakan paste di Excel.");
        });
    } else {
        console.warn("Tombol Copy tidak ditemukan di halaman.");
    }
});

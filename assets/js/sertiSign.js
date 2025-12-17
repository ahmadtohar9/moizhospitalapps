// Fungsi untuk mengarahkan ke halaman rekam medis berdasarkan no_rawat
function redirectToForm(noRawat) {
    const formUrl = `${BASE_URL}admin/rekammedis/rekammedisRalanForm/${noRawat}`;
    window.location.href = formUrl;
}

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const penjabSelect = document.getElementById('penjab');
    const statusBayarSelect = document.getElementById('status_bayar');
    const statusPeriksaSelect = document.getElementById('status_periksa');

    // **Set Tanggal Default ke Tanggal Hari Ini**
    const today = new Date().toISOString().split('T')[0]; 
    startDateInput.value = today;
    endDateInput.value = today;

    console.log("Tanggal Default:", today); // ✅ Debugging

    // **Inisialisasi DataTable dengan Filter Default**
    const pasienTable = $('#pasienTable').DataTable({
        ajax: {
            url: API_URL,
            type: 'GET',
            data: function (d) {
                d.start_date = startDateInput.value;
                d.end_date = endDateInput.value;
                d.penjab = penjabSelect.value;
                d.status_bayar = statusBayarSelect.value;
                d.status_periksa = statusPeriksaSelect.value;

                console.log("Mengirim Data ke Server:", d); // ✅ Debugging Data Filter
            },
            dataSrc: '',
        },
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: 'no_rawat' },
            { data: 'no_rkm_medis' },
            { data: 'nm_pasien' },
            { data: 'nm_dokter' },
            { data: 'png_jawab' },
            { data: 'nm_poli' },
            { data: 'lokasi_file' },
            {
                data: null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger btn-sm" onclick="redirectToForm('${row.no_rawat}')">TTE SertiSign</button>`;
                }
            }
        ]
    });

    // **Filter Data saat Tombol Ditekan**
    filterButton.addEventListener('click', function () {
        console.log("Filter Ditekan, Reload Data");
        pasienTable.ajax.reload(null, false); // Reload tanpa reset paging
    });
});

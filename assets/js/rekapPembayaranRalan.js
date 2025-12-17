document.addEventListener('DOMContentLoaded', function () {
    const table = $('#rekapTable').DataTable({
        scrollX: true,
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: 'tgl_registrasi' },
            { data: 'no_nota' },
            { data: 'no_rkm_medis' },
            { data: 'nm_pasien' },
            { data: 'png_jawab', render: d => d || '-' },   // amanin null
            { data: 'nm_poli' },
            { data: 'perujuk' },
            { data: 'biaya_registrasi', render: d => formatRp(d) },
            { data: 'biaya_obat', render: d => formatRp(d) },
            { data: 'biaya_ralan', render: d => formatRp(d) },
            { data: 'biaya_operasi', render: d => formatRp(d) },
            { data: 'biaya_laborat', render: d => formatRp(d) },
            { data: 'biaya_radiologi', render: d => formatRp(d) },
            { data: 'biaya_tambahan', render: d => formatRp(d) },
            { data: 'biaya_potongan', render: d => formatRp(d) },
            { data: 'total_biaya', render: d => formatRp(d) },
            { data: 'nm_dokter' },
            { data: 'keterangan' }
        ]
    });

    const formatRp = val => {
        let n = parseFloat(val);
        return isNaN(n) ? 'Rp 0' : 'Rp ' + n.toLocaleString('id-ID');
    };

    function loadData() {
        const start_date = document.getElementById('start_date').value;
        const end_date   = document.getElementById('end_date').value;
        const dokter     = document.getElementById('dokter').value;
        const penjab     = document.getElementById('penjab').value; // ini kd_pj
        const poli       = document.getElementById('poli').value;

        const params = new URLSearchParams({
            start_date,
            end_date,
            dokter,
            penjab,  // sesuai dengan $kd_pj di PHP
            poli
        });

        fetch(`${API_URL}?${params.toString()}`)
            .then(res => res.json())
            .then(result => {
                const data = result.data || [];
                table.clear().rows.add(data).draw();
                updateTotal(data);
            })
            .catch(err => console.error('Load data error:', err));
    }


    function updateTotal(data) {
        let total = 0;
        data.forEach(d => {
            total += parseFloat(d.total_biaya || 0); // sudah benar
        });
        document.getElementById('totalSemua').textContent = formatRp(total);
    }


    document.getElementById('filterButton').addEventListener('click', loadData);

    document.getElementById('printButton').addEventListener('click', () => {
        const s = document.getElementById('start_date').value;
        const e = document.getElementById('end_date').value;
        const d = document.getElementById('dokter').value;
        const pj = document.getElementById('penjab').value;
        const pl = document.getElementById('poli').value;
        window.open(`${PRINT_URL}?start_date=${s}&end_date=${e}&dokter=${d}&penjab=${pj}&poli=${pl}`, '_blank');
    });

    // default load
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start_date').value = today;
    document.getElementById('end_date').value = today;
    loadData();
});

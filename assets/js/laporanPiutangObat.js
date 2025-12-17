document.addEventListener('DOMContentLoaded', function () {
    const filterBtn = document.getElementById('filterButton');
    const printBtn  = document.getElementById('printButton');
    const excelBtn = document.getElementById('excelButton');
    const copyBtn   = document.getElementById('copyButton');
    const totalTagihanEl = document.getElementById('totalTagihan');
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("start_date").value = today;
    document.getElementById("end_date").value = today;

    const table = $('#piutangTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        scrollX: true,
        autoWidth: false,
        destroy: true,
        columns: [
            { data: null, render: (_, __, ___, meta) => meta.row + 1 },
            { data: 'no_faktur' },
            { data: 'tgl_faktur' },
            { data: 'tgl_tempo' },
            { data: 'nama_suplier' },
            { data: 'total2', render: formatRupiah, className: 'text-right' },
            { data: 'ppn', render: formatRupiah, className: 'text-right' },
            { data: 'meterai', render: formatRupiah, className: 'text-right' },
            { data: 'tagihan', render: formatRupiah, className: 'text-right' },
            { data: 'status' },
            { data: 'sisa_hari', render: d => `${d} hari`, className: 'text-center' }
        ],
        createdRow: function (row, data) {
            const sisa = parseInt(data.sisa_hari);
            if (sisa < 0) $(row).css('background-color', '#ffe6e6');
            else if (sisa <= 7) $(row).css('background-color', '#fff7cc');
        }
    });

    function formatRupiah(angka) {
        return 'Rp ' + parseInt(angka || 0).toLocaleString('id-ID');
    }

    function updateTotalTagihan() {
        let total = 0;
        table.rows({ search: 'applied' }).data().each(row => {
            total += parseFloat(row.tagihan || 0);
        });
        totalTagihanEl.textContent = formatRupiah(total);
    }

    function loadData() {
        const params = {
            start_date: document.getElementById('start_date').value,
            end_date: document.getElementById('end_date').value,
            supplier: document.getElementById('supplier').value,
            status: document.getElementById('status').value
        };

        const queryString = new URLSearchParams(params).toString();
        fetch(`${API_URL_PIUTANG}?${queryString}`)
            .then(res => res.json())
            .then(res => {
                table.clear();
                table.rows.add(res.data).draw(false);
                updateTotalTagihan();
            })
            .catch(err => console.error("❌ Gagal load data:", err));
    }

    filterBtn.addEventListener('click', loadData);

    if (copyBtn) {
        copyBtn.addEventListener('click', () => {
            const range = document.createRange();
            range.selectNode(document.getElementById("piutangTable"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("📋 Data berhasil disalin!");
        });
    }

    printBtn.addEventListener('click', () => {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const supplier = document.getElementById('supplier').value;
        const status = document.getElementById('status').value;

        const url = `${PRINT_URL_PIUTANG}?start_date=${start_date}&end_date=${end_date}&supplier=${supplier}&status=${status}`;
        window.open(url, '_blank'); // Buka di tab baru
    });

    excelBtn.addEventListener('click', () => {
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const supplier = document.getElementById('supplier').value;
        const status = document.getElementById('status').value;

        const url = `${EXCEL_URL_PIUTANG}?start_date=${start_date}&end_date=${end_date}&supplier=${supplier}&status=${status}`;
        window.open(url, '_blank');
    });


    loadData();
    table.on('draw', updateTotalTagihan);
});


// document.addEventListener('DOMContentLoaded', function () {
//     const filterButton = document.getElementById('filterButton');
//     const printButton = document.getElementById('printButton');
//     const copyButton = document.getElementById('copyButton');

//     const today = new Date().toISOString().split('T')[0];
//     document.getElementById("start_date").value = today;
//     document.getElementById("end_date").value = today;

//     function parseRupiah(str) {
//       if (typeof str === 'string') {
//         return parseFloat(str.replace(/[^0-9,-]+/g, '').replace(',', '.')) || 0;
//       }
//       return typeof str === 'number' ? str : 0;
//     }

//     function formatRupiah(angka) {
//       return 'Rp ' + (angka || 0).toLocaleString('id-ID');
//     }


//     const billingTable = $('#billingTable').DataTable({
//           ajax: {
//             url: API_URL_RANAP,
//             type: 'GET',
//             data: function (d) {
//               d.start_date = $('#start_date').val();
//               d.end_date = $('#end_date').val();
//             },
//             dataSrc: function (json) {
//               console.log("📦 Response dari server:", json);
//               return json.data || [];
//             },
//             error: function (xhr) {
//               console.error("❌ Gagal memuat data:", xhr.responseText);
//             }
//           },

//           footerCallback: function (row, data, start, end, display) {
//             const api = this.api();

//            const totalColumns = [
//             7, 8,                // Tindakan Dokter Ranap & Alkes
//             9, 10,               // Dokter Ralan & Alkes
//             11, 12, 13, 14,      // Perawat Inap & Ralan
//             15, 16,              // Lab & Radiologi
//             17, 18, 19, 20, 21, 22, 
//             23,                  // BHP_Operasi
//             24,                  // ✅ Tarif_Kamar
//             25, 26, 27, 28       // Tambahan & Potongan Biaya
//           ];
//           const colIndexTotal = 29;


//             let pageGrandTotal = 0;
//             let fullGrandTotal = 0;

//             totalColumns.forEach(colIdx => {
//               // Validasi apakah kolom ada
//               if (typeof api.column(colIdx).data() === 'undefined') return;

//               const pageTotal = api.column(colIdx, { page: 'current' }).data()
//                 .reduce((a, b) => parseRupiah(b) + a, 0);
//               const grandTotal = api.column(colIdx).data()
//                 .reduce((a, b) => parseRupiah(b) + a, 0);

//               $(api.column(colIdx).footer()).eq(0).html(formatRupiah(pageTotal));
//               $(api.column(colIdx).footer()).eq(1).html(formatRupiah(grandTotal));

//               pageGrandTotal += pageTotal;
//               fullGrandTotal += grandTotal;
//             });

//             // Hitung Total Biaya
//             $(api.column(colIndexTotal).footer()).eq(0).html(`<strong>${formatRupiah(pageGrandTotal)}</strong>`);
//             $(api.column(colIndexTotal).footer()).eq(1).html(`<strong>${formatRupiah(fullGrandTotal)}</strong>`);
//           },

//           columns: [
//           { data: null, render: (data, type, row, meta) => meta.row + 1 }, // No
//           { data: 'No_RM' },
//           { data: 'Nama_Pasien' },
//           { data: 'Nama_Dokter' },
//           { data: 'Nama_Paket_Operasi' },
//           { data: 'Tgl_Masuk' },
//           { data: 'Ruangan' },
//           { data: 'Registrasi' },
//           { data: 'Tindakan_Dokter_Inap' },
//           { data: 'Alkes_Inap' },
//           { data: 'Tindakan_Dokter_Ralan' },
//           { data: 'Alkes_Ralan' },
//           { data: 'Tindakan_Perawat_Inap' },
//           { data: 'Alkes_Perawat_Inap' },
//           { data: 'Tindakan_Perawat_Ralan' },
//           { data: 'Alkes_Perawat_Ralan' },
//           { data: 'Laboratorium' },
//           { data: 'Radiologi' },
//           { data: 'Jasa_Dokter_Operasi' },
//           { data: 'Kamar_Operasi' },
//           { data: 'Operasi_Obat' },
//           { data: 'Kamar_Rawatan_Operasi' },
//           { data: 'Operasi_CTG' },
//           { data: 'BHP_Operasi' },
//           { data: 'Tarif_Kamar' },
//           { data: 'Obat_Tambahan' },
//           { data: 'Jasa_Dokter_Tambahan' },
//           { data: 'Jasa_Layanan' },
//           { data: 'Tambahan_Lainnya' },
//           { data: 'Potongan_Biaya' },
//           {
//             data: null,
//             title: "Total Biaya",
//             render: function (row, type) {
//               if (type === 'display') {
//                 const fields = [ /* semua key */ ];
//                 const total = fields.reduce((acc, key) => acc + parseRupiah(row[key]), 0) - parseRupiah(row.Potongan_Biaya);
//                 return `<strong>${formatRupiah(total)}</strong>`;
//               }
//               return '';
//             }
//           }
//         ],

//           dom: 'Bfrtip',
//           buttons: [],
//           paging: true,
//           searching: true,
//           ordering: true,
//           scrollX: true,
//           scrollCollapse: true,
//           fixedColumns: true,
//           autoWidth: false
//         });

//     filterButton.addEventListener('click', function () {
//         billingTable.ajax.reload();
//     });

//     printButton.addEventListener('click', function () {
//         const start = document.getElementById('start_date').value;
//         const end = document.getElementById('end_date').value;
//         window.open(`${PRINT_URL_RANAP}?start_date=${start}&end_date=${end}`, '_blank');
//     });

//     if (copyButton) {
//         copyButton.addEventListener('click', function () {
//             const table = document.getElementById("billingTable");
//             const range = document.createRange();
//             range.selectNode(table);
//             const selection = window.getSelection();
//             selection.removeAllRanges();
//             selection.addRange(range);
//             document.execCommand("copy");
//             alert("✅ Data disalin, paste di Excel!");
//         });
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const printButton = document.getElementById('printButton');
    const copyButton = document.getElementById('copyButton');

    const today = new Date().toISOString().split('T')[0];
    document.getElementById("start_date").value = today;
    document.getElementById("end_date").value = today;

    function parseRupiah(value) {
        if (typeof value === 'string') {
            return parseFloat(value.replace(/[^0-9,-]+/g, '').replace(',', '.')) || 0;
        }
        return typeof value === 'number' ? value : 0;
    }

    function formatRupiah(value) {
        return 'Rp ' + (value || 0).toLocaleString('id-ID');
    }

    const billingTable = $('#billingTable').DataTable({
        ajax: {
            url: API_URL_RANAP,
            type: 'GET',
            data: function (d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            dataSrc: function (json) {
                console.log("📦 Respon Server:", json);
                return json.data || [];
            },
            error: function (xhr) {
                console.error("❌ Gagal ambil data:", xhr.responseText);
            }
        },

        footerCallback: function (row, data, start, end, display) {
            const api = this.api();
            const totalColumns = Array.from({ length: 23 }, (_, i) => i + 7); // kolom 7 s/d 29 (tanpa Potongan_Biaya)

            totalColumns.forEach((colIdx) => {
                let pageTotal = api.column(colIdx, { page: 'current' }).data()
                    .reduce((a, b) => a + parseRupiah(b), 0);
                $(api.column(colIdx).footer()).html(formatRupiah(pageTotal));
            });

            // Kolom Potongan Biaya (29)
            const potonganIdx = 29;
            let potonganTotal = api.column(potonganIdx, { page: 'current' }).data()
                .reduce((a, b) => a + parseRupiah(b), 0);
            $(api.column(potonganIdx).footer()).html(formatRupiah(potonganTotal));

            // Total Biaya (30)
            const totalBiayaIdx = 30;
            let totalAll = display.map(i => {
                const rowData = data[i];
                const keys = [
                    'Registrasi', 'Tindakan_Dokter_Inap', 'Alkes_Inap', 'Tindakan_Dokter_Ralan',
                    'Alkes_Ralan', 'Tindakan_Perawat_Inap', 'Alkes_Perawat_Inap',
                    'Tindakan_Perawat_Ralan', 'Alkes_Perawat_Ralan', 'Laboratorium',
                    'Radiologi', 'Jasa_Dokter_Operasi', 'Kamar_Operasi', 'Operasi_Obat',
                    'Kamar_Rawatan_Operasi', 'Operasi_CTG', 'BHP_Operasi', 'Tarif_Kamar',
                    'Obat_Tambahan', 'Jasa_Dokter_Tambahan', 'Jasa_Layanan', 'Tambahan_Lainnya'
                ];
                let sum = keys.reduce((acc, key) => acc + parseRupiah(rowData[key]), 0);
                sum -= parseRupiah(rowData['Potongan_Biaya']);
                return sum;
            }).reduce((a, b) => a + b, 0);

            $(api.column(totalBiayaIdx).footer()).html(`<strong>${formatRupiah(totalAll)}</strong>`);
        },

        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: 'No_RM' },
            { data: 'Nama_Pasien' },
            { data: 'Nama_Dokter' },
            { data: 'Nama_Paket_Operasi' },
            { data: 'Tgl_Masuk' },
            { data: 'Ruangan' },
            { data: 'Registrasi' },
            { data: 'Tindakan_Dokter_Inap' },
            { data: 'Alkes_Inap' },
            { data: 'Tindakan_Dokter_Ralan' },
            { data: 'Alkes_Ralan' },
            { data: 'Tindakan_Perawat_Inap' },
            { data: 'Alkes_Perawat_Inap' },
            { data: 'Tindakan_Perawat_Ralan' },
            { data: 'Alkes_Perawat_Ralan' },
            { data: 'Laboratorium' },
            { data: 'Radiologi' },
            { data: 'Jasa_Dokter_Operasi' },
            { data: 'Kamar_Operasi' },
            { data: 'Operasi_Obat' },
            { data: 'Kamar_Rawatan_Operasi' },
            { data: 'Operasi_CTG' },
            { data: 'BHP_Operasi' },
            { data: 'Tarif_Kamar' },
            { data: 'Obat_Tambahan' },
            { data: 'Jasa_Dokter_Tambahan' },
            { data: 'Jasa_Layanan' },
            { data: 'Tambahan_Lainnya' },
            { data: 'Potongan_Biaya' },
            {
                data: null,
                title: 'Total Biaya',
                render: function (row, type) {
                    const keys = [
                        'Registrasi', 'Tindakan_Dokter_Inap', 'Alkes_Inap', 'Tindakan_Dokter_Ralan',
                        'Alkes_Ralan', 'Tindakan_Perawat_Inap', 'Alkes_Perawat_Inap',
                        'Tindakan_Perawat_Ralan', 'Alkes_Perawat_Ralan', 'Laboratorium',
                        'Radiologi', 'Jasa_Dokter_Operasi', 'Kamar_Operasi', 'Operasi_Obat',
                        'Kamar_Rawatan_Operasi', 'Operasi_CTG', 'BHP_Operasi', 'Tarif_Kamar',
                        'Obat_Tambahan', 'Jasa_Dokter_Tambahan', 'Jasa_Layanan', 'Tambahan_Lainnya'
                    ];

                    let total = keys.reduce((sum, key) => sum + parseRupiah(row[key]), 0);
                    total -= parseRupiah(row.Potongan_Biaya);
                    return type === 'display' ? `<strong>${formatRupiah(total)}</strong>` : total;
                }
            }
        ],

        dom: 'Bfrtip',
        buttons: [],
        paging: true,
        searching: true,
        ordering: true,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: true,
        autoWidth: false
    });

    filterButton.addEventListener('click', function () {
        billingTable.ajax.reload();
    });

    printButton.addEventListener('click', function () {
        const start = document.getElementById('start_date').value;
        const end = document.getElementById('end_date').value;
        window.open(`${PRINT_URL_RANAP}?start_date=${start}&end_date=${end}`, '_blank');
    });

    copyButton.addEventListener('click', function () {
        const table = document.getElementById("billingTable");
        const range = document.createRange();
        range.selectNode(table);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand("copy");
        alert("✅ Data disalin! Paste di Excel.");
    });
});





/**
 * CONTOH INTEGRASI PRINT BUTTON
 * 
 * File ini adalah CONTOH cara menambahkan tombol cetak
 * di riwayatPasien.js TANPA mengubah logic yang sudah ada.
 * 
 * CARA PAKAI:
 * 1. Buka file assets/js/riwayatPasien.js
 * 2. Cari bagian yang render button/action
 * 3. Tambahkan button cetak seperti contoh di bawah
 * 4. Jangan ubah function yang sudah ada
 * 
 * Dibuat: 2025-12-18
 */

// ============================================
// CONTOH 1: Tambahkan Button di Card Header
// ============================================

// SEBELUM (existing code - JANGAN DIUBAH):
function renderCardHeader(data) {
    return `
        <div class="card-header">
            <h5>Kunjungan: ${data.no_rawat}</h5>
            <div class="card-tools">
                <button class="btn btn-sm btn-info" onclick="lihatDetail('${data.no_rawat}')">
                    <i class="fas fa-eye"></i> Lihat
                </button>
            </div>
        </div>
    `;
}

// SESUDAH (tambahkan button cetak):
function renderCardHeader(data) {
    return `
        <div class="card-header">
            <h5>Kunjungan: ${data.no_rawat}</h5>
            <div class="card-tools">
                <button class="btn btn-sm btn-info" onclick="lihatDetail('${data.no_rawat}')">
                    <i class="fas fa-eye"></i> Lihat
                </button>
                <!-- TAMBAHAN BARU: Button Cetak -->
                <button class="btn btn-sm btn-primary" onclick="cetakPDF('${data.no_rawat}')">
                    <i class="fas fa-print"></i> Cetak PDF
                </button>
            </div>
        </div>
    `;
}

// ============================================
// CONTOH 2: Function Cetak PDF (TAMBAHAN BARU)
// ============================================

/**
 * Function untuk membuka window print
 * TAMBAHKAN function ini di akhir file riwayatPasien.js
 */
function cetakPDF(noRawat) {
    // Validasi
    if (!noRawat) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No. Rawat tidak ditemukan'
        });
        return;
    }

    // Encode no_rawat untuk URL
    const encodedNoRawat = encodeURIComponent(noRawat);

    // URL endpoint print
    const printUrl = baseUrl + 'print/riwayat_pasien/' + encodedNoRawat;

    // Buka window baru
    const printWindow = window.open(printUrl, '_blank');

    // Cek apakah window berhasil dibuka
    if (!printWindow) {
        Swal.fire({
            icon: 'warning',
            title: 'Pop-up Blocked',
            text: 'Mohon izinkan pop-up untuk mencetak dokumen',
            confirmButtonText: 'OK'
        });
    }
}

// ============================================
// CONTOH 3: Button Cetak di Modal Detail
// ============================================

// Jika ada modal detail, tambahkan button cetak di footer modal
function showModalDetail(noRawat) {
    // ... existing code untuk load data ...

    // Tambahkan button cetak di modal footer
    const modalFooter = `
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="cetakPDF('${noRawat}')">
            <i class="fas fa-print"></i> Cetak PDF
        </button>
    `;

    $('#modalDetailFooter').html(modalFooter);
}

// ============================================
// CONTOH 4: Dropdown Menu dengan Opsi Cetak
// ============================================

function renderActionMenu(data) {
    return `
        <div class="dropdown">
            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                    id="dropdownMenu${data.no_rawat}" data-toggle="dropdown">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onclick="lihatDetail('${data.no_rawat}')">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
                <a class="dropdown-item" href="#" onclick="editData('${data.no_rawat}')">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <div class="dropdown-divider"></div>
                <!-- TAMBAHAN BARU: Menu Cetak -->
                <a class="dropdown-item" href="#" onclick="cetakPDF('${data.no_rawat}')">
                    <i class="fas fa-print"></i> Cetak PDF
                </a>
                <a class="dropdown-item" href="#" onclick="cetakResume('${data.no_rawat}')">
                    <i class="fas fa-file-pdf"></i> Cetak Resume
                </a>
            </div>
        </div>
    `;
}

// ============================================
// CONTOH 5: Function Cetak dengan Loading
// ============================================

function cetakPDFWithLoading(noRawat) {
    // Tampilkan loading
    Swal.fire({
        title: 'Mempersiapkan dokumen...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Encode no_rawat
    const encodedNoRawat = encodeURIComponent(noRawat);

    // URL endpoint print
    const printUrl = baseUrl + 'print/riwayat_pasien/' + encodedNoRawat;

    // Simulasi delay (opsional, bisa dihapus)
    setTimeout(() => {
        // Tutup loading
        Swal.close();

        // Buka window print
        const printWindow = window.open(printUrl, '_blank');

        if (!printWindow) {
            Swal.fire({
                icon: 'warning',
                title: 'Pop-up Blocked',
                text: 'Mohon izinkan pop-up untuk mencetak dokumen'
            });
        } else {
            // Tampilkan notifikasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Dokumen siap dicetak',
                timer: 2000,
                showConfirmButton: false
            });
        }
    }, 500);
}

// ============================================
// CONTOH 6: Function Cetak Resume Medis
// ============================================

function cetakResume(noRawat) {
    if (!noRawat) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No. Rawat tidak ditemukan'
        });
        return;
    }

    const encodedNoRawat = encodeURIComponent(noRawat);
    const printUrl = baseUrl + 'print/resume_medis/' + encodedNoRawat;

    window.open(printUrl, '_blank');
}

// ============================================
// CONTOH 7: Function Cetak Asesmen IGD
// ============================================

function cetakAsesmenIGD(noRawat) {
    if (!noRawat) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No. Rawat tidak ditemukan'
        });
        return;
    }

    const encodedNoRawat = encodeURIComponent(noRawat);
    const printUrl = baseUrl + 'print/asesmen_igd/' + encodedNoRawat;

    window.open(printUrl, '_blank');
}

// ============================================
// CONTOH 8: Button Cetak di DataTable
// ============================================

// Jika menggunakan DataTables
const tableColumns = [
    { data: 'no_rawat' },
    { data: 'tgl_registrasi' },
    { data: 'nm_pasien' },
    { data: 'nm_poli' },
    { data: 'nm_dokter' },
    {
        data: null,
        render: function (data, type, row) {
            return `
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-info" onclick="lihatDetail('${row.no_rawat}')">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-primary" onclick="cetakPDF('${row.no_rawat}')">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            `;
        }
    }
];

// ============================================
// CONTOH 9: Cetak Multiple (Batch Print)
// ============================================

function cetakMultiple() {
    // Ambil semua checkbox yang dicentang
    const checkedBoxes = document.querySelectorAll('input[name="select_rawat"]:checked');

    if (checkedBoxes.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Pilih minimal 1 kunjungan untuk dicetak'
        });
        return;
    }

    // Konfirmasi
    Swal.fire({
        title: 'Cetak ' + checkedBoxes.length + ' Dokumen?',
        text: 'Akan membuka ' + checkedBoxes.length + ' tab baru',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Cetak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Loop dan buka window untuk setiap no_rawat
            checkedBoxes.forEach((checkbox, index) => {
                const noRawat = checkbox.value;
                const encodedNoRawat = encodeURIComponent(noRawat);
                const printUrl = baseUrl + 'print/riwayat_pasien/' + encodedNoRawat;

                // Delay sedikit agar tidak semua tab terbuka bersamaan
                setTimeout(() => {
                    window.open(printUrl, '_blank');
                }, index * 200);
            });
        }
    });
}

// ============================================
// CONTOH 10: Cetak dengan Preview
// ============================================

function previewSebelumCetak(noRawat) {
    if (!noRawat) {
        return;
    }

    const encodedNoRawat = encodeURIComponent(noRawat);
    const printUrl = baseUrl + 'print/riwayat_pasien/' + encodedNoRawat;

    // Buka dalam modal iframe (opsional)
    const modalContent = `
        <div class="modal fade" id="modalPreviewPrint" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 80vh;">
                        <iframe src="${printUrl}" style="width: 100%; height: 100%; border: none;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="window.open('${printUrl}', '_blank')">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Append modal ke body jika belum ada
    if ($('#modalPreviewPrint').length === 0) {
        $('body').append(modalContent);
    }

    // Tampilkan modal
    $('#modalPreviewPrint').modal('show');
}

// ============================================
// CATATAN PENTING
// ============================================

/*
JANGAN LUPA:

1. Pastikan baseUrl sudah di-define di view atau layout:
   <script>
       const baseUrl = '<?= base_url() ?>';
   </script>

2. Pastikan SweetAlert2 sudah di-load jika menggunakan Swal

3. Pastikan jQuery sudah di-load jika menggunakan $

4. Test di berbagai browser:
   - Chrome
   - Firefox
   - Safari
   - Edge

5. Test print preview dan print fisik

6. Pastikan pop-up blocker tidak menghalangi

7. Untuk production, tambahkan error handling yang lebih robust
*/

/**
 * Penilaian Medis Mata - JavaScript
 * Canvas Drawing & AJAX Operations
 */

// Canvas variables - pakai var untuk avoid redeclaration error
var canvasOD, canvasOS, ctxOD, ctxOS;
var isDrawing = false;
var lastX = 0, lastY = 0;

// Edit mode tracking
var isEditMode = false;

// Get base URL from global or construct it
var MATA_BASE_URL = (typeof BASE_URL !== 'undefined') ? BASE_URL : (window.location.origin + '/moizhospitalapps/');

$(document).ready(function () {
    // Initialize canvas
    initCanvas();

    // Load existing data - DISABLED: form harus kosong saat pertama kali dibuka
    // Data akan ter-load saat user klik tombol "Edit"
    // checkExistingData();

    // Load hasil & riwayat
    loadHasil();
    loadRiwayat();

    // Form submit
    $('#formPenilaianMata').on('submit', function (e) {
        e.preventDefault();
        saveData();
    });
});

/**
 * Initialize Canvas untuk drawing
 */
function initCanvas() {
    // Canvas OD (Mata Kanan)
    canvasOD = document.getElementById('canvas_od');
    ctxOD = canvasOD.getContext('2d');

    // Canvas OS (Mata Kiri)
    canvasOS = document.getElementById('canvas_os');
    ctxOS = canvasOS.getContext('2d');

    // Load template images
    loadTemplateImage('od');
    loadTemplateImage('os');

    // Setup drawing events untuk OD
    setupDrawing(canvasOD, ctxOD);

    // Setup drawing events untuk OS
    setupDrawing(canvasOS, ctxOS);
}

/**
 * Load template image mata
 */
function loadTemplateImage(type) {
    const canvas = type === 'od' ? canvasOD : canvasOS;
    const ctx = type === 'od' ? ctxOD : ctxOS;

    const img = new Image();
    img.onload = function () {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        console.log('Template ' + type + ' loaded successfully');
    };
    img.onerror = function () {
        console.error('Failed to load template image: ' + type);
    };
    img.src = MATA_BASE_URL + 'assets/images/mata/mata_' + type + '_template.png';
    console.log('Loading template from: ' + img.src);
}

/**
 * Setup drawing events
 */
function setupDrawing(canvas, ctx) {
    let drawing = false;

    canvas.addEventListener('mousedown', (e) => {
        drawing = true;
        const rect = canvas.getBoundingClientRect();
        lastX = e.clientX - rect.left;
        lastY = e.clientY - rect.top;
    });

    canvas.addEventListener('mousemove', (e) => {
        if (!drawing) return;

        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.strokeStyle = '#ff0000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();

        lastX = x;
        lastY = y;
    });

    canvas.addEventListener('mouseup', () => {
        drawing = false;
    });

    canvas.addEventListener('mouseleave', () => {
        drawing = false;
    });

    // Touch events untuk mobile
    canvas.addEventListener('touchstart', (e) => {
        e.preventDefault();
        drawing = true;
        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0];
        lastX = touch.clientX - rect.left;
        lastY = touch.clientY - rect.top;
    });

    canvas.addEventListener('touchmove', (e) => {
        e.preventDefault();
        if (!drawing) return;

        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;

        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.strokeStyle = '#ff0000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();

        lastX = x;
        lastY = y;
    });

    canvas.addEventListener('touchend', () => {
        drawing = false;
    });
}

/**
 * Clear canvas (hapus coretan tapi template tetap)
 */
function clearCanvas(type) {
    const canvas = type === 'od' ? canvasOD : canvasOS;
    const ctx = type === 'od' ? ctxOD : ctxOS;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    loadTemplateImage(type);
}

/**
 * Reset canvas (kembali ke template asli)
 */
function resetCanvas(type) {
    clearCanvas(type);
}

/**
 * Get canvas as base64
 */
function getCanvasBase64(type) {
    const canvas = type === 'od' ? canvasOD : canvasOS;
    return canvas.toDataURL('image/png');
}

/**
 * Load image to canvas
 */
function loadImageToCanvas(type, imageUrl) {
    const canvas = type === 'od' ? canvasOD : canvasOS;
    const ctx = type === 'od' ? ctxOD : ctxOS;

    const img = new Image();
    img.onload = function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };
    img.src = imageUrl;
}

/**
 * Check existing data (silent load)
 */
function checkExistingData() {
    const no_rawat = $('#no_rawat').val();

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/check_existing',
        type: 'POST',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            if (response.exists) {
                // Silent load - langsung load data tanpa popup
                loadDataToForm(response.data);

                // Load gambar ke canvas
                if (response.data.gambar_od_url) {
                    loadImageToCanvas('od', response.data.gambar_od_url);
                }
                if (response.data.gambar_os_url) {
                    loadImageToCanvas('os', response.data.gambar_os_url);
                }
            }
        }
    });
}

/**
 * Save data
 */
function saveData() {
    // Validasi field wajib
    const requiredFields = [
        { id: 'keluhan_utama', label: 'Keluhan Utama' },
        { id: 'rps', label: 'Riwayat Penyakit Sekarang' },
        { id: 'rpd', label: 'Riwayat Penyakit Dahulu' },
        { id: 'td', label: 'Tekanan Darah' },
        { id: 'nadi', label: 'Nadi' },
        { id: 'rr', label: 'Respiratory Rate' },
        { id: 'suhu', label: 'Suhu' }
    ];

    let emptyFields = [];

    requiredFields.forEach(field => {
        const value = $('#' + field.id).val();
        if (!value || value.trim() === '') {
            emptyFields.push(field.label);
        }
    });

    if (emptyFields.length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap!',
            html: '<strong>Field berikut wajib diisi:</strong><br>' +
                '<ul style="text-align: left; margin-top: 10px;">' +
                emptyFields.map(f => '<li>' + f + '</li>').join('') +
                '</ul>',
            confirmButtonText: 'OK'
        });
        return; // Stop execution
    }

    // Get canvas images
    $('#gambar_od_base64').val(getCanvasBase64('od'));
    $('#gambar_os_base64').val(getCanvasBase64('os'));

    const formData = $('#formPenilaianMata').serialize();
    const no_rawat = $('#no_rawat').val();

    // Jika dalam mode edit, langsung update tanpa cek
    if (isEditMode) {
        updateData(formData);
        return;
    }

    // Jika mode insert, cek dulu apakah data sudah ada
    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/check_existing',
        type: 'POST',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (checkResponse) {
            // Jika data sudah ada, BLOCK dan kasih warning
            if (checkResponse.exists) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Sudah Ada!',
                    text: 'Data untuk nomor rawat ini sudah ada. Gunakan tombol "Edit" untuk mengubah data.',
                    confirmButtonText: 'OK'
                });
                return; // Stop execution
            }

            // Jika data belum ada, lanjutkan save
            insertData(formData);
        }
    });
}

/**
 * Insert data baru
 */
function insertData(formData) {
    // Show loading
    Swal.fire({
        title: 'Menyimpan...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/save',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            Swal.close();

            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                // Reset form setelah save berhasil
                resetForm();

                loadHasil();
                loadRiwayat();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message
                });
            }
        },
        error: function () {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat menyimpan data'
            });
        }
    });
}

/**
 * Update data
 */
function updateData(formData) {
    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/update',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            Swal.close();

            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                // Reset form dan mode setelah update berhasil
                resetForm();
                isEditMode = false;
                $('#btnSimpan').html('<i class="fa fa-save"></i> Simpan');

                loadHasil();
                loadRiwayat();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message
                });
            }
        },
        error: function () {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat mengupdate data'
            });
        }
    });
}

/**
 * Load hasil
 */
function loadHasil() {
    const no_rawat = $('#no_rawat').val();

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/get_data',
        type: 'GET',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            const tbody = $('#tableHasil tbody');
            tbody.empty();

            if (response.status === 'success' && response.data) {
                const data = response.data;
                const row = `
                    <tr>
                        <td>1</td>
                        <td>${data.tanggal}</td>
                        <td>${data.nm_dokter || '-'}</td>
                        <td>${data.keluhan_utama || '-'}</td>
                        <td>${data.diagnosis || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewDetail('${data.no_rawat}')">
                                <i class="fa fa-eye"></i> Lihat
                            </button>
                            <button class="btn btn-sm btn-success" onclick="cetakPDF('${data.no_rawat}')">
                                <i class="fa fa-print"></i> Cetak
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editData('${data.no_rawat}')">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteData('${data.no_rawat}')">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            } else {
                tbody.append('<tr><td colspan="6" class="text-center">Belum ada data</td></tr>');
            }
        }
    });
}

/**
 * Load riwayat
 */
function loadRiwayat() {
    const no_rkm_medis = $('#no_rkm_medis').val();

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/get_riwayat',
        type: 'GET',
        data: { no_rkm_medis: no_rkm_medis },
        dataType: 'json',
        success: function (response) {
            const tbody = $('#tableRiwayat tbody');
            tbody.empty();

            if (response.status === 'success' && response.data.length > 0) {
                response.data.forEach((item, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.tanggal}</td>
                            <td>${item.no_rawat}</td>
                            <td>${item.nm_dokter || '-'}</td>
                            <td>${item.keluhan_utama || '-'}</td>
                            <td>${item.diagnosis || '-'}</td>
                            <td>
                                <button class="btn btn-xs btn-success" onclick="copyData('${item.no_rawat}')">
                                    <i class="fa fa-copy"></i> Copy
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            } else {
                tbody.append('<tr><td colspan="7" class="text-center">Belum ada riwayat</td></tr>');
            }
        }
    });
}

/**
 * View detail
 */
function viewDetail(no_rawat) {
    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/get_data',
        type: 'GET',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                const data = response.data;
                let html = `
                    <style>
                        .detail-section {
                            margin-bottom: 20px;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            padding: 15px;
                            background: #f9f9f9;
                        }
                        .detail-section h4 {
                            margin-top: 0;
                            color: #3c8dbc;
                            border-bottom: 2px solid #3c8dbc;
                            padding-bottom: 10px;
                        }
                        .detail-row {
                            margin-bottom: 10px;
                        }
                        .detail-label {
                            font-weight: bold;
                            color: #555;
                            display: inline-block;
                            width: 180px;
                        }
                        .detail-value {
                            color: #333;
                        }
                        .mata-section {
                            border: 2px solid #ddd;
                            border-radius: 5px;
                            padding: 10px;
                            margin-bottom: 10px;
                        }
                        .mata-section.od {
                            border-color: #3c8dbc;
                            background: #f0f8ff;
                        }
                        .mata-section.os {
                            border-color: #00a65a;
                            background: #f0fff0;
                        }
                    </style>

                    <!-- Info Umum -->
                    <div class="detail-section">
                        <h4><i class="fa fa-info-circle"></i> Informasi Umum</h4>
                        <div class="detail-row">
                            <span class="detail-label">Tanggal Perawatan:</span>
                            <span class="detail-value">${data.tanggal || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Dokter:</span>
                            <span class="detail-value">${data.nm_dokter || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Anamnesis:</span>
                            <span class="detail-value">${data.anamnesis || '-'} ${data.hubungan ? '(' + data.hubungan + ')' : ''}</span>
                        </div>
                    </div>

                    <!-- Riwayat Kesehatan -->
                    <div class="detail-section">
                        <h4><i class="fa fa-history"></i> Riwayat Kesehatan</h4>
                        <div class="detail-row">
                            <span class="detail-label">Keluhan Utama:</span>
                            <span class="detail-value">${data.keluhan_utama || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Riwayat Penyakit Sekarang:</span>
                            <span class="detail-value">${data.rps || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Riwayat Penyakit Dahulu:</span>
                            <span class="detail-value">${data.rpd || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Riwayat Penggunaan Obat:</span>
                            <span class="detail-value">${data.rpo || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Alergi:</span>
                            <span class="detail-value">${data.alergi || '-'}</span>
                        </div>
                    </div>

                    <!-- Pemeriksaan Fisik -->
                    <div class="detail-section">
                        <h4><i class="fa fa-stethoscope"></i> Pemeriksaan Fisik</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <span class="detail-label">TD:</span>
                                    <span class="detail-value">${data.td || '-'} mmHg</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Nadi:</span>
                                    <span class="detail-value">${data.nadi || '-'} /menit</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">RR:</span>
                                    <span class="detail-value">${data.rr || '-'} /menit</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <span class="detail-label">Suhu:</span>
                                    <span class="detail-value">${data.suhu || '-'} °C</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">BB:</span>
                                    <span class="detail-value">${data.bb || '-'} kg</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Nyeri:</span>
                                    <span class="detail-value">${data.nyeri || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status Nutrisi:</span>
                            <span class="detail-value">${data.status || '-'}</span>
                        </div>
                    </div>

                    <!-- Status Oftalmologis -->
                    <div class="detail-section">
                        <h4><i class="fa fa-eye"></i> Status Oftalmologis</h4>
                        
                        <div class="row">
                            <!-- Mata Kanan (OD) -->
                            <div class="col-md-6">
                                <div class="mata-section od">
                                    <h5 class="text-center"><strong>OD : Mata Kanan</strong></h5>
                                    <div class="text-center" style="margin-bottom: 15px;">
                                        <img src="${data.gambar_od_url}" class="img-responsive" style="border: 2px solid #3c8dbc; max-width: 100%;">
                                    </div>
                                    <div class="detail-row"><span class="detail-label">Visus SC:</span> <span class="detail-value">${data.visuskanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">CC:</span> <span class="detail-value">${data.cckanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Palpebra:</span> <span class="detail-value">${data.palkanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Conjungtiva:</span> <span class="detail-value">${data.conkanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Cornea:</span> <span class="detail-value">${data.corneakanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">COA:</span> <span class="detail-value">${data.coakanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Pupil:</span> <span class="detail-value">${data.pupilkanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Lensa:</span> <span class="detail-value">${data.lensakanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Fundus Media:</span> <span class="detail-value">${data.funduskanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Papil:</span> <span class="detail-value">${data.papilkanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Retina:</span> <span class="detail-value">${data.retinakanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Makula:</span> <span class="detail-value">${data.makulakanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">TIO:</span> <span class="detail-value">${data.tiokanan || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">MBO:</span> <span class="detail-value">${data.mbokanan || '-'}</span></div>
                                </div>
                            </div>

                            <!-- Mata Kiri (OS) -->
                            <div class="col-md-6">
                                <div class="mata-section os">
                                    <h5 class="text-center"><strong>OS : Mata Kiri</strong></h5>
                                    <div class="text-center" style="margin-bottom: 15px;">
                                        <img src="${data.gambar_os_url}" class="img-responsive" style="border: 2px solid #00a65a; max-width: 100%;">
                                    </div>
                                    <div class="detail-row"><span class="detail-label">Visus SC:</span> <span class="detail-value">${data.visuskiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">CC:</span> <span class="detail-value">${data.cckiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Palpebra:</span> <span class="detail-value">${data.palkiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Conjungtiva:</span> <span class="detail-value">${data.conkiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Cornea:</span> <span class="detail-value">${data.corneakiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">COA:</span> <span class="detail-value">${data.coakiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Pupil:</span> <span class="detail-value">${data.pupilkiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Lensa:</span> <span class="detail-value">${data.lensakiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Fundus Media:</span> <span class="detail-value">${data.funduskiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Papil:</span> <span class="detail-value">${data.papilkiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Retina:</span> <span class="detail-value">${data.retinakiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">Makula:</span> <span class="detail-value">${data.makulakiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">TIO:</span> <span class="detail-value">${data.tiokiri || '-'}</span></div>
                                    <div class="detail-row"><span class="detail-label">MBO:</span> <span class="detail-value">${data.mbokiri || '-'}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pemeriksaan Penunjang -->
                    <div class="detail-section">
                        <h4><i class="fa fa-flask"></i> Pemeriksaan Penunjang</h4>
                        <div class="detail-row">
                            <span class="detail-label">Laboratorium:</span>
                            <span class="detail-value">${data.lab || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Radiologi:</span>
                            <span class="detail-value">${data.rad || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Penunjang Lainnya:</span>
                            <span class="detail-value">${data.penunjang || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Tes Penglihatan:</span>
                            <span class="detail-value">${data.tes || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Pemeriksaan Lain:</span>
                            <span class="detail-value">${data.pemeriksaan || '-'}</span>
                        </div>
                    </div>

                    <!-- Diagnosis & Tatalaksana -->
                    <div class="detail-section">
                        <h4><i class="fa fa-medkit"></i> Diagnosis & Tatalaksana</h4>
                        <div class="detail-row">
                            <span class="detail-label">Asesmen Kerja:</span>
                            <span class="detail-value">${data.diagnosis || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Asesmen Banding:</span>
                            <span class="detail-value">${data.diagnosisbdg || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Permasalahan:</span>
                            <span class="detail-value">${data.permasalahan || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Terapi/Pengobatan:</span>
                            <span class="detail-value">${data.terapi || '-'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Tindakan:</span>
                            <span class="detail-value">${data.tindakan || '-'}</span>
                        </div>
                    </div>

                    <!-- Edukasi -->
                    <div class="detail-section">
                        <h4><i class="fa fa-graduation-cap"></i> Edukasi</h4>
                        <div class="detail-row">
                            <span class="detail-value">${data.edukasi || '-'}</span>
                        </div>
                    </div>
                `;

                $('#modalDetailBody').html(html);
                $('#modalDetail').modal('show');
            }
        }
    });
}

/**
 * Edit data
 */
function editData(no_rawat) {
    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/get_data',
        type: 'GET',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                loadDataToForm(response.data);

                // Load gambar ke canvas
                if (response.data.gambar_od_url) {
                    loadImageToCanvas('od', response.data.gambar_od_url);
                }
                if (response.data.gambar_os_url) {
                    loadImageToCanvas('os', response.data.gambar_os_url);
                }

                // Set mode edit dan ubah tombol
                isEditMode = true;
                $('#btnSimpan').html('<i class="fa fa-save"></i> Update');

                // Scroll to top
                $('html, body').animate({ scrollTop: 0 }, 500);
            }
        }
    });
}

/**
 * Delete data
 */
function deleteData(no_rawat) {
    Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: MATA_BASE_URL + 'penilaian-medis-mata/delete',
                type: 'POST',
                data: { no_rawat: no_rawat },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });

                        resetForm();
                        loadHasil();
                        loadRiwayat();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });
                    }
                }
            });
        }
    });
}

/**
 * Copy data dari riwayat
 */
function copyData(no_rawat_source) {
    const no_rawat_target = $('#no_rawat').val();

    $.ajax({
        url: MATA_BASE_URL + 'penilaian-medis-mata/copy_data',
        type: 'POST',
        data: {
            no_rawat_source: no_rawat_source,
            no_rawat_target: no_rawat_target
        },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                loadDataToForm(response.data);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                // Scroll to top
                $('html, body').animate({ scrollTop: 0 }, 500);
            }
        }
    });
}

/**
 * Load data to form
 */
function loadDataToForm(data) {
    // Tanggal & Jam
    const datetime = data.tanggal.split(' ');
    $('#tgl_perawatan').val(datetime[0]);
    $('#jam_rawat').val(datetime[1]);

    // Riwayat
    $('#anamnesis').val(data.anamnesis);
    $('#hubungan').val(data.hubungan);
    $('#keluhan_utama').val(data.keluhan_utama);
    $('#rps').val(data.rps);
    $('#rpd').val(data.rpd);
    $('#rpo').val(data.rpo);
    $('#alergi').val(data.alergi);

    // Fisik
    $('#td').val(data.td);
    $('#bb').val(data.bb);
    $('#suhu').val(data.suhu);
    $('#nadi').val(data.nadi);
    $('#rr').val(data.rr);
    $('#nyeri').val(data.nyeri);
    $('#status_nutrisi').val(data.status);

    // Oftalmologis - Mata Kanan
    $('#visuskanan').val(data.visuskanan);
    $('#cckanan').val(data.cckanan);
    $('#palkanan').val(data.palkanan);
    $('#conkanan').val(data.conkanan);
    $('#corneakanan').val(data.corneakanan);
    $('#coakanan').val(data.coakanan);
    $('#pupilkanan').val(data.pupilkanan);
    $('#lensakanan').val(data.lensakanan);
    $('#funduskanan').val(data.funduskanan);
    $('#papilkanan').val(data.papilkanan);
    $('#retinakanan').val(data.retinakanan);
    $('#makulakanan').val(data.makulakanan);
    $('#tiokanan').val(data.tiokanan);
    $('#mbokanan').val(data.mbokanan);

    // Oftalmologis - Mata Kiri
    $('#visuskiri').val(data.visuskiri);
    $('#cckiri').val(data.cckiri);
    $('#palkiri').val(data.palkiri);
    $('#conkiri').val(data.conkiri);
    $('#corneakiri').val(data.corneakiri);
    $('#coakiri').val(data.coakiri);
    $('#pupilkiri').val(data.pupilkiri);
    $('#lensakiri').val(data.lensakiri);
    $('#funduskiri').val(data.funduskiri);
    $('#papilkiri').val(data.papilkiri);
    $('#retinakiri').val(data.retinakiri);
    $('#makulakiri').val(data.makulakiri);
    $('#tiokiri').val(data.tiokiri);
    $('#mbokiri').val(data.mbokiri);

    // Penunjang
    $('#lab').val(data.lab);
    $('#rad').val(data.rad);
    $('#penunjang').val(data.penunjang);
    $('#tes').val(data.tes);
    $('#pemeriksaan').val(data.pemeriksaan);

    // Diagnosis
    $('#diagnosis').val(data.diagnosis);
    $('#diagnosisbdg').val(data.diagnosisbdg);

    // Tatalaksana
    $('#permasalahan').val(data.permasalahan);
    $('#terapi').val(data.terapi);
    $('#tindakan').val(data.tindakan);

    // Edukasi
    $('#edukasi').val(data.edukasi);
}

/**
 * Reset form
 */
function resetForm() {
    $('#formPenilaianMata')[0].reset();
    resetCanvas('od');
    resetCanvas('os');
    $('#tgl_perawatan').val($('#tgl_perawatan').attr('value'));
    $('#jam_rawat').val($('#jam_rawat').attr('value'));

    // Reset mode dan tombol
    isEditMode = false;
    $('#btnSimpan').html('<i class="fa fa-save"></i> Simpan');
}

/**
 * Cetak PDF
 */
function cetakPDF(no_rawat) {
    // Encode no_rawat untuk URL
    const encoded_no_rawat = encodeURIComponent(no_rawat);

    // Open PDF di tab baru (pakai query parameter)
    window.open(MATA_BASE_URL + 'penilaian-medis-mata/cetak-pdf?no_rawat=' + encoded_no_rawat, '_blank');
}

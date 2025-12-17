/**
 * Penilaian Medis Mata - JavaScript
 * Canvas Drawing & AJAX Operations
 */

// Canvas variables
let canvasOD, canvasOS, ctxOD, ctxOS;
let isDrawing = false;
let lastX = 0, lastY = 0;

// Base URLs
const BASE_URL = window.location.origin + '/moizhospitalapps/';

$(document).ready(function () {
    // Initialize canvas
    initCanvas();

    // Load existing data
    checkExistingData();

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
    };
    img.src = BASE_URL + 'assets/images/mata/mata_' + type + '_template.png';
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
 * Check existing data
 */
function checkExistingData() {
    const no_rawat = $('#no_rawat').val();

    $.ajax({
        url: BASE_URL + 'penilaian-medis-mata/check_existing',
        type: 'POST',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            if (response.exists) {
                Swal.fire({
                    icon: 'info',
                    title: 'Data Sudah Ada',
                    text: 'Data untuk nomor rawat ini sudah ada. Apakah ingin mengedit?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Edit',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        loadDataToForm(response.data);
                    }
                });
            }
        }
    });
}

/**
 * Save data
 */
function saveData() {
    // Get canvas images
    $('#gambar_od_base64').val(getCanvasBase64('od'));
    $('#gambar_os_base64').val(getCanvasBase64('os'));

    const formData = $('#formPenilaianMata').serialize();
    const no_rawat = $('#no_rawat').val();

    // Check if update or insert
    $.ajax({
        url: BASE_URL + 'penilaian-medis-mata/check_existing',
        type: 'POST',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (checkResponse) {
            const url = checkResponse.exists ?
                BASE_URL + 'penilaian-medis-mata/update' :
                BASE_URL + 'penilaian-medis-mata/save';

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
                url: url,
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
                            timer: 2000
                        });

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
    });
}

/**
 * Load hasil
 */
function loadHasil() {
    const no_rawat = $('#no_rawat').val();

    $.ajax({
        url: BASE_URL + 'penilaian-medis-mata/get_data',
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
        url: BASE_URL + 'penilaian-medis-mata/get_riwayat',
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
        url: BASE_URL + 'penilaian-medis-mata/get_data',
        type: 'GET',
        data: { no_rawat: no_rawat },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                const data = response.data;
                let html = `
                    <div class="row">
                        <div class="col-md-6">
                            <h4><strong>OD : Mata Kanan</strong></h4>
                            <img src="${data.gambar_od_url}" class="img-responsive" style="border: 2px solid #3c8dbc;">
                        </div>
                        <div class="col-md-6">
                            <h4><strong>OS : Mata Kiri</strong></h4>
                            <img src="${data.gambar_os_url}" class="img-responsive" style="border: 2px solid #00a65a;">
                        </div>
                    </div>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Tanggal</dt><dd>${data.tanggal}</dd>
                        <dt>Dokter</dt><dd>${data.nm_dokter || '-'}</dd>
                        <dt>Keluhan Utama</dt><dd>${data.keluhan_utama || '-'}</dd>
                        <dt>Diagnosis</dt><dd>${data.diagnosis || '-'}</dd>
                        <dt>Terapi</dt><dd>${data.terapi || '-'}</dd>
                    </dl>
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
        url: BASE_URL + 'penilaian-medis-mata/get_data',
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
                url: BASE_URL + 'penilaian-medis-mata/delete',
                type: 'POST',
                data: { no_rawat: no_rawat },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000
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
        url: BASE_URL + 'penilaian-medis-mata/copy_data',
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
                    timer: 2000
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
}

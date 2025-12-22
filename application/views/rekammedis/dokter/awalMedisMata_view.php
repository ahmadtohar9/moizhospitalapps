<!-- ASESMEN AWAL MEDIS MATA (OFTALMOLOGI) - COMPLETE VERSION -->
<style>
    .section-header {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        margin: 15px 0 10px 0;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .eye-diagram {
        text-align: center;
        padding: 20px;
        background: #f9fafb;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .eye-diagram img {
        max-width: 100%;
        height: auto;
        border: 2px solid #ddd;
        border-radius: 8px;
    }

    .eye-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .eye-column {
        border: 2px solid #ec4899;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
    }

    .eye-column h5 {
        color: #ec4899;
        margin-top: 0;
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="container-fluid">
    <form id="formMataAssessment" autocomplete="off">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat ?>">
        <input type="hidden" name="kd_dokter" value="<?= $kd_dokter ?>">

        <!-- TANGGAL & JAM ASESMEN -->
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label><i class="fa fa-calendar"></i> Tanggal Asesmen <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal" value="<?= $tgl_sekarang ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><i class="fa fa-clock"></i> Jam Asesmen <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="jam" value="<?= $jam_sekarang ?>" step="1" required>
                </div>
            </div>
        </div>

        <!-- I. ANAMNESIS -->
        <div class="section-header"><i class="fa fa-clipboard"></i> I. ANAMNESIS</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Anamnesis <span class="text-danger">*</span></label>
                    <select class="form-control" name="anamnesis" required onchange="toggleHubungan(this.value)">
                        <option value="">-- Pilih --</option>
                        <option value="Autoanamnesis">Autoanamnesis</option>
                        <option value="Alloanamnesis">Alloanamnesis</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="hubunganContainer" style="display:none;">
                <div class="form-group">
                    <label>Hubungan dengan Pasien</label>
                    <input type="text" class="form-control" name="hubungan" value=""
                        placeholder="Contoh: Ibu kandung, Ayah">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keluhan Utama <span class="text-danger">*</span></label>
            <textarea class="form-control" name="keluhan_utama" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label>Riwayat Penyakit Sekarang (RPS) <span class="text-danger">*</span></label>
            <textarea class="form-control" name="rps" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Penyakit Dahulu (RPD)</label>
                    <textarea class="form-control" name="rpd" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Penggunaan Obat (RPO)</label>
                    <textarea class="form-control" name="rpo" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Riwayat Alergi</label>
            <input type="text" class="form-control" name="alergi" value="">
        </div>

        <!-- II. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="status" required placeholder="Status pasien">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>TD (mmHg)</label>
                    <input type="text" class="form-control" name="td" value="" placeholder="120/80">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nadi (x/mnt)</label>
                    <input type="text" class="form-control" name="nadi" value="" placeholder="80">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>RR (x/mnt)</label>
                    <input type="text" class="form-control" name="rr" value="" placeholder="20">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="suhu" value="" placeholder="36.5">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>BB (kg) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="bb" value="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nyeri</label>
                    <input type="text" class="form-control" name="nyeri" value="" placeholder="Skala nyeri / lokasi">
                </div>
            </div>
        </div>

        <!-- III. PEMERIKSAAN MATA (OFTALMOLOGI) -->
        <div class="section-header"><i class="fa fa-eye"></i> III. PEMERIKSAAN MATA (OFTALMOLOGI)</div>

        <!-- Visus -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Visus OD (Mata Kanan)</strong></label>
                    <input type="text" class="form-control" name="visuskanan" placeholder="Contoh: 6/6">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Visus OS (Mata Kiri)</strong></label>
                    <input type="text" class="form-control" name="visuskiri" placeholder="Contoh: 6/6">
                </div>
            </div>
        </div>

        <!-- Gambar Mata dengan Canvas Coret -->
        <div class="eye-grid">
            <div class="eye-column">
                <h5>OD (Mata Kanan)</h5>
                <div class="eye-diagram">
                    <div style="margin-bottom:10px;">
                        <button type="button" class="btn btn-sm btn-danger" onclick="setDrawColorOD('red')"><i
                                class="fa fa-circle" style="color:red"></i> Merah</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="setDrawColorOD('blue')"><i
                                class="fa fa-circle" style="color:blue"></i> Biru</button>
                        <button type="button" class="btn btn-sm btn-dark" onclick="setDrawColorOD('black')"><i
                                class="fa fa-circle"></i> Hitam</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="setDrawColorOD('green')"><i
                                class="fa fa-circle" style="color:green"></i> Hijau</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="clearCanvasOD()"><i
                                class="fa fa-eraser"></i> Hapus</button>
                    </div>
                    <div style="position:relative; display:inline-block;">
                        <canvas id="mataCanvasOD" width="400" height="250"
                            style="border:2px solid #ddd; border-radius:8px; cursor:crosshair;"></canvas>
                        <input type="hidden" name="mata_od_image" id="mataODImage">
                    </div>
                </div>
            </div>
            <div class="eye-column">
                <h5>OS (Mata Kiri)</h5>
                <div class="eye-diagram">
                    <div style="margin-bottom:10px;">
                        <button type="button" class="btn btn-sm btn-danger" onclick="setDrawColorOS('red')"><i
                                class="fa fa-circle" style="color:red"></i> Merah</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="setDrawColorOS('blue')"><i
                                class="fa fa-circle" style="color:blue"></i> Biru</button>
                        <button type="button" class="btn btn-sm btn-dark" onclick="setDrawColorOS('black')"><i
                                class="fa fa-circle"></i> Hitam</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="setDrawColorOS('green')"><i
                                class="fa fa-circle" style="color:green"></i> Hijau</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="clearCanvasOS()"><i
                                class="fa fa-eraser"></i> Hapus</button>
                    </div>
                    <div style="position:relative; display:inline-block;">
                        <canvas id="mataCanvasOS" width="400" height="250"
                            style="border:2px solid #ddd; border-radius:8px; cursor:crosshair;"></canvas>
                        <input type="hidden" name="mata_os_image" id="mataOSImage">
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemeriksaan Detail Mata -->
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-center" style="color: #ec4899; font-weight: bold;">OD (Mata Kanan)</h6>

                <div class="form-group">
                    <label>Camera Oculi Anterior (CC)</label>
                    <input type="text" class="form-control" name="cckanan">
                </div>
                <div class="form-group">
                    <label>Palpebra</label>
                    <input type="text" class="form-control" name="palkanan">
                </div>
                <div class="form-group">
                    <label>Conjunctiva</label>
                    <input type="text" class="form-control" name="conkanan">
                </div>
                <div class="form-group">
                    <label>Cornea</label>
                    <input type="text" class="form-control" name="corneakanan">
                </div>
                <div class="form-group">
                    <label>COA (Camera Oculi Anterior)</label>
                    <input type="text" class="form-control" name="coakanan">
                </div>
                <div class="form-group">
                    <label>Pupil</label>
                    <input type="text" class="form-control" name="pupilkanan">
                </div>
                <div class="form-group">
                    <label>Lensa</label>
                    <input type="text" class="form-control" name="lensakanan">
                </div>
                <div class="form-group">
                    <label>Fundus</label>
                    <input type="text" class="form-control" name="funduskanan">
                </div>
                <div class="form-group">
                    <label>Papil</label>
                    <input type="text" class="form-control" name="papilkanan">
                </div>
                <div class="form-group">
                    <label>Retina</label>
                    <input type="text" class="form-control" name="retinakanan">
                </div>
                <div class="form-group">
                    <label>Makula</label>
                    <input type="text" class="form-control" name="makulakanan">
                </div>
                <div class="form-group">
                    <label>TIO (Tekanan Intra Okular)</label>
                    <input type="text" class="form-control" name="tiokanan">
                </div>
                <div class="form-group">
                    <label>MBO (Motilitas Bola Okuli)</label>
                    <input type="text" class="form-control" name="mbokanan">
                </div>
            </div>

            <div class="col-md-6">
                <h6 class="text-center" style="color: #ec4899; font-weight: bold;">OS (Mata Kiri)</h6>

                <div class="form-group">
                    <label>Camera Oculi Anterior (CC)</label>
                    <input type="text" class="form-control" name="cckiri">
                </div>
                <div class="form-group">
                    <label>Palpebra</label>
                    <input type="text" class="form-control" name="palkiri">
                </div>
                <div class="form-group">
                    <label>Conjunctiva</label>
                    <input type="text" class="form-control" name="conkiri">
                </div>
                <div class="form-group">
                    <label>Cornea</label>
                    <input type="text" class="form-control" name="corneakiri">
                </div>
                <div class="form-group">
                    <label>COA (Camera Oculi Anterior)</label>
                    <input type="text" class="form-control" name="coakiri">
                </div>
                <div class="form-group">
                    <label>Pupil</label>
                    <input type="text" class="form-control" name="pupilkiri">
                </div>
                <div class="form-group">
                    <label>Lensa</label>
                    <input type="text" class="form-control" name="lensakiri">
                </div>
                <div class="form-group">
                    <label>Fundus</label>
                    <input type="text" class="form-control" name="funduskiri">
                </div>
                <div class="form-group">
                    <label>Papil</label>
                    <input type="text" class="form-control" name="papilkiri">
                </div>
                <div class="form-group">
                    <label>Retina</label>
                    <input type="text" class="form-control" name="retinakiri">
                </div>
                <div class="form-group">
                    <label>Makula</label>
                    <input type="text" class="form-control" name="makulakiri">
                </div>
                <div class="form-group">
                    <label>TIO (Tekanan Intra Okular)</label>
                    <input type="text" class="form-control" name="tiokiri">
                </div>
                <div class="form-group">
                    <label>MBO (Motilitas Bola Okuli)</label>
                    <input type="text" class="form-control" name="mbokiri">
                </div>
            </div>
        </div>

        <!-- IV. PEMERIKSAAN PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> IV. PEMERIKSAAN PENUNJANG</div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Laboratorium</label>
                    <textarea class="form-control" name="lab" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Radiologi</label>
                    <textarea class="form-control" name="rad" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Penunjang Lainnya</label>
                    <textarea class="form-control" name="penunjang" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tes</label>
                    <textarea class="form-control" name="tes" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pemeriksaan</label>
                    <textarea class="form-control" name="pemeriksaan" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- V. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> V. DIAGNOSIS & TATALAKSANA</div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosis <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="diagnosis" rows="2" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosis Banding</label>
                    <textarea class="form-control" name="diagnosisbdg" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Permasalahan</label>
            <textarea class="form-control" name="permasalahan" rows="2"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Terapi</label>
                    <textarea class="form-control" name="terapi" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tindakan</label>
                    <textarea class="form-control" name="tindakan" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Edukasi</label>
            <textarea class="form-control" name="edukasi" rows="2"></textarea>
        </div>

        <!-- BUTTON SAVE -->
        <div style="text-align:right; margin:20px 0;">
            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan
                Asesmen</button>
        </div>
    </form>
</div>

<!-- HISTORY SECTION -->
<div class="container-fluid" style="margin-top:30px;">
    <div class="section-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"><i
            class="fa fa-history"></i> RIWAYAT ASESMEN MATA</div>

    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-4">
            <label>Dari Tanggal</label>
            <input type="date" id="filterStartDate" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="col-md-4">
            <label>Sampai Tanggal</label>
            <input type="date" id="filterEndDate" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="col-md-4" style="padding-top:25px;">
            <button type="button" class="btn btn-primary" onclick="loadHistory()"><i class="fa fa-search"></i>
                Tampilkan</button>
        </div>
    </div>

    <div id="historyContainer">
        <div style="text-align:center; padding:40px; color:#999;">
            <i class="fa fa-inbox" style="font-size:48px;"></i>
            <p>Memuat riwayat...</p>
        </div>
    </div>
</div>

<script>
    function toggleHubungan(value) {
        document.getElementById('hubunganContainer').style.display = value === 'Alloanamnesis' ? 'block' : 'none';
    }

    // Canvas Drawing for OD (Mata Kanan)
    var canvasOD, ctxOD, isDrawingOD = false, lastXOD, lastYOD, currentColorOD = 'red';

    // Canvas Drawing for OS (Mata Kiri)
    var canvasOS, ctxOS, isDrawingOS = false, lastXOS, lastYOS, currentColorOS = 'red';

    // Init Canvas OD
    setTimeout(function () {
        canvasOD = document.getElementById('mataCanvasOD');
        if (canvasOD) {
            ctxOD = canvasOD.getContext('2d');
            const imgOD = new Image();
            imgOD.onload = function () {
                ctxOD.drawImage(imgOD, 0, 0, canvasOD.width, canvasOD.height);
            };
            imgOD.src = '<?= base_url("assets/images/mata/mata_od_template.png") ?>';

            canvasOD.onmousedown = function (e) {
                isDrawingOD = true;
                const rect = canvasOD.getBoundingClientRect();
                lastXOD = (e.clientX - rect.left) * (canvasOD.width / rect.width);
                lastYOD = (e.clientY - rect.top) * (canvasOD.height / rect.height);
            };

            canvasOD.onmousemove = function (e) {
                if (!isDrawingOD) return;
                const rect = canvasOD.getBoundingClientRect();
                const x = (e.clientX - rect.left) * (canvasOD.width / rect.width);
                const y = (e.clientY - rect.top) * (canvasOD.height / rect.height);
                ctxOD.beginPath();
                ctxOD.strokeStyle = currentColorOD;
                ctxOD.lineWidth = 3;
                ctxOD.lineCap = 'round';
                ctxOD.moveTo(lastXOD, lastYOD);
                ctxOD.lineTo(x, y);
                ctxOD.stroke();
                lastXOD = x;
                lastYOD = y;
            };

            canvasOD.onmouseup = canvasOD.onmouseleave = function () {
                if (isDrawingOD) {
                    isDrawingOD = false;
                    document.getElementById('mataODImage').value = canvasOD.toDataURL('image/png');
                }
            };
        }

        // Init Canvas OS
        canvasOS = document.getElementById('mataCanvasOS');
        if (canvasOS) {
            ctxOS = canvasOS.getContext('2d');
            const imgOS = new Image();
            imgOS.onload = function () {
                ctxOS.drawImage(imgOS, 0, 0, canvasOS.width, canvasOS.height);
            };
            imgOS.src = '<?= base_url("assets/images/mata/mata_os_template.png") ?>';

            canvasOS.onmousedown = function (e) {
                isDrawingOS = true;
                const rect = canvasOS.getBoundingClientRect();
                lastXOS = (e.clientX - rect.left) * (canvasOS.width / rect.width);
                lastYOS = (e.clientY - rect.top) * (canvasOS.height / rect.height);
            };

            canvasOS.onmousemove = function (e) {
                if (!isDrawingOS) return;
                const rect = canvasOS.getBoundingClientRect();
                const x = (e.clientX - rect.left) * (canvasOS.width / rect.width);
                const y = (e.clientY - rect.top) * (canvasOS.height / rect.height);
                ctxOS.beginPath();
                ctxOS.strokeStyle = currentColorOS;
                ctxOS.lineWidth = 3;
                ctxOS.lineCap = 'round';
                ctxOS.moveTo(lastXOS, lastYOS);
                ctxOS.lineTo(x, y);
                ctxOS.stroke();
                lastXOS = x;
                lastYOS = y;
            };

            canvasOS.onmouseup = canvasOS.onmouseleave = function () {
                if (isDrawingOS) {
                    isDrawingOS = false;
                    document.getElementById('mataOSImage').value = canvasOS.toDataURL('image/png');
                }
            };
        }

        const anamnesis = document.querySelector('[name="anamnesis"]');
        if (anamnesis) toggleHubungan(anamnesis.value);
    }, 500);

    // Color & Clear functions for OD
    window.setDrawColorOD = function (color) {
        currentColorOD = color;
    };

    window.clearCanvasOD = function () {
        if (canvasOD && ctxOD) {
            ctxOD.clearRect(0, 0, canvasOD.width, canvasOD.height);
            const img = new Image();
            img.onload = function () {
                ctxOD.drawImage(img, 0, 0, canvasOD.width, canvasOD.height);
            };
            img.src = '<?= base_url("assets/images/mata/mata_od_template.png") ?>';
            document.getElementById('mataODImage').value = '';
        }
    };

    // Color & Clear functions for OS
    window.setDrawColorOS = function (color) {
        currentColorOS = color;
    };

    window.clearCanvasOS = function () {
        if (canvasOS && ctxOS) {
            ctxOS.clearRect(0, 0, canvasOS.width, canvasOS.height);
            const img = new Image();
            img.onload = function () {
                ctxOS.drawImage(img, 0, 0, canvasOS.width, canvasOS.height);
            };
            img.src = '<?= base_url("assets/images/mata/mata_os_template.png") ?>';
            document.getElementById('mataOSImage').value = '';
        }
    };

    // Helper function to reset form and button
    window.resetFormAndButton = function () {
        document.getElementById('formMataAssessment').reset();
        clearCanvasOD();
        clearCanvasOS();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    // Helper function to set edit mode
    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Form Submit
    document.getElementById('formMataAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisMataController/save") ?>', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    typeof Swal !== "undefined" && Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    resetFormAndButton();
                    setTimeout(function () { window.scrollTo({ top: 0, behavior: 'smooth' }); }, 3100);
                    setTimeout(function () { loadHistory(); }, 500);
                } else {
                    typeof Swal !== "undefined" && Swal.fire({ icon: 'error', title: 'Gagal!', text: data.message });
                }
            });
    });

    // History Functions
    function loadHistory() {
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;
        const noRkm = '<?= $no_rkm_medis ?>';
        const container = document.getElementById('historyContainer');

        container.innerHTML = '<div style="text-align:center; padding:40px;"><i class="fa fa-spinner fa-spin" style="font-size:32px;"></i></div>';

        fetch('<?= base_url("AwalMedisMataController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.data.length > 0) {
                    let html = '<div style="display:grid; gap:15px;">';
                    data.data.forEach(item => {
                        const date = new Date(item.tanggal);
                        const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
                        html += '<div style="background:white; border:1px solid #ddd; border-radius:8px; padding:20px;">';
                        html += '<div style="display:flex; justify-content:space-between; margin-bottom:15px; padding-bottom:15px; border-bottom:2px solid #f3f4f6;">';
                        html += '<div><div style="font-weight:600; margin-bottom:5px;"><i class="fa fa-calendar"></i> ' + formattedDate + '</div>';
                        html += '<div style="color:#666;"><i class="fa fa-user-md"></i> ' + (item.nm_dokter || 'Dokter') + '</div></div>';
                        html += '<div style="display:flex; gap:8px;">';
                        html += '<button onclick="viewDetail(\'' + item.no_rawat + '\')" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Lihat</button>';
                        html += '<button onclick="editAssessment(\'' + item.no_rawat + '\')" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>';
                        html += '<button onclick="printSinglePDF(\'' + item.no_rawat + '\')" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Cetak</button>';
                        html += '<button onclick="deleteAssessmentHistory(\'' + item.no_rawat + '\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>';
                        html += '</div></div>';
                        html += '<div><strong>Keluhan:</strong> ' + (item.keluhan_utama ? item.keluhan_utama.substring(0, 100) + '...' : '-') + '</div>';
                        html += '<div><strong>Diagnosis:</strong> ' + (item.diagnosis ? item.diagnosis.substring(0, 100) + '...' : '-') + '</div>';
                        html += '</div>';
                    });
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = '<div style="text-align:center; padding:40px; color:#999;"><i class="fa fa-inbox" style="font-size:48px;"></i><p>Tidak ada data</p></div>';
                }
            });
    }

    function viewDetail(noRawat) {
        fetch('<?= base_url("AwalMedisMataController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    const date = new Date(d.tanggal);
                    const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

                    let html = '<div style="text-align:left; max-height:600px; overflow-y:auto; padding:10px;">';
                    html += '<div style="background:linear-gradient(135deg, #ec4899 0%, #db2777 100%); color:white; padding:15px; border-radius:8px; margin-bottom:20px;">';
                    html += '<h4 style="margin:0 0 10px 0;"><i class="fa fa-calendar"></i> ' + formattedDate + '</h4>';
                    html += '<p style="margin:0;"><i class="fa fa-user-md"></i> ' + (d.nm_dokter || 'Dokter') + '</p></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-clipboard"></i> I. ANAMNESIS</h5>';
                    html += '<p><strong>Jenis:</strong> ' + (d.anamnesis || '-') + '</p>';
                    if (d.hubungan) html += '<p><strong>Hubungan:</strong> ' + d.hubungan + '</p>';
                    html += '<p><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p><strong>RPS:</strong><br>' + (d.rps || '-') + '</p>';
                    html += '<p><strong>RPD:</strong> ' + (d.rpd || '-') + '</p>';
                    html += '<p><strong>RPO:</strong> ' + (d.rpo || '-') + '</p>';
                    html += '<p><strong>Alergi:</strong> ' + (d.alergi || '-') + '</p></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981;"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px;">';
                    html += '<p><strong>Status:</strong> ' + (d.status || '-') + '</p>';
                    html += '<p><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '<p><strong>BB:</strong> ' + (d.bb || '-') + ' kg</p>';
                    html += '<p><strong>Nyeri:</strong> ' + (d.nyeri || '-') + '</p></div></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-eye"></i> III. PEMERIKSAAN MATA</h5>';
                    html += '<p><strong>Visus OD:</strong> ' + (d.visuskanan || '-') + ' | <strong>Visus OS:</strong> ' + (d.visuskiri || '-') + '</p>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-top:10px;">';
                    html += '<div><h6 style="color:#ec4899;">OD (Kanan)</h6><ul style="font-size:13px;">';
                    if (d.cckanan) html += '<li><strong>CC:</strong> ' + d.cckanan + '</li>';
                    if (d.palkanan) html += '<li><strong>Palpebra:</strong> ' + d.palkanan + '</li>';
                    if (d.conkanan) html += '<li><strong>Conjunctiva:</strong> ' + d.conkanan + '</li>';
                    if (d.corneakanan) html += '<li><strong>Cornea:</strong> ' + d.corneakanan + '</li>';
                    if (d.coakanan) html += '<li><strong>COA:</strong> ' + d.coakanan + '</li>';
                    if (d.pupilkanan) html += '<li><strong>Pupil:</strong> ' + d.pupilkanan + '</li>';
                    if (d.lensakanan) html += '<li><strong>Lensa:</strong> ' + d.lensakanan + '</li>';
                    if (d.funduskanan) html += '<li><strong>Fundus:</strong> ' + d.funduskanan + '</li>';
                    if (d.papilkanan) html += '<li><strong>Papil:</strong> ' + d.papilkanan + '</li>';
                    if (d.retinakanan) html += '<li><strong>Retina:</strong> ' + d.retinakanan + '</li>';
                    if (d.makulakanan) html += '<li><strong>Makula:</strong> ' + d.makulakanan + '</li>';
                    if (d.tiokanan) html += '<li><strong>TIO:</strong> ' + d.tiokanan + '</li>';
                    if (d.mbokanan) html += '<li><strong>MBO:</strong> ' + d.mbokanan + '</li>';
                    html += '</ul></div>';
                    html += '<div><h6 style="color:#ec4899;">OS (Kiri)</h6><ul style="font-size:13px;">';
                    if (d.cckiri) html += '<li><strong>CC:</strong> ' + d.cckiri + '</li>';
                    if (d.palkiri) html += '<li><strong>Palpebra:</strong> ' + d.palkiri + '</li>';
                    if (d.conkiri) html += '<li><strong>Conjunctiva:</strong> ' + d.conkiri + '</li>';
                    if (d.corneakiri) html += '<li><strong>Cornea:</strong> ' + d.corneakiri + '</li>';
                    if (d.coakiri) html += '<li><strong>COA:</strong> ' + d.coakiri + '</li>';
                    if (d.pupilkiri) html += '<li><strong>Pupil:</strong> ' + d.pupilkiri + '</li>';
                    if (d.lensakiri) html += '<li><strong>Lensa:</strong> ' + d.lensakiri + '</li>';
                    if (d.funduskiri) html += '<li><strong>Fundus:</strong> ' + d.funduskiri + '</li>';
                    if (d.papilkiri) html += '<li><strong>Papil:</strong> ' + d.papilkiri + '</li>';
                    if (d.retinakiri) html += '<li><strong>Retina:</strong> ' + d.retinakiri + '</li>';
                    if (d.makulakiri) html += '<li><strong>Makula:</strong> ' + d.makulakiri + '</li>';
                    if (d.tiokiri) html += '<li><strong>TIO:</strong> ' + d.tiokiri + '</li>';
                    if (d.mbokiri) html += '<li><strong>MBO:</strong> ' + d.mbokiri + '</li>';
                    html += '</ul></div></div>';

                    // Display Eye Drawing Images
                    html += '<div style="margin-top:20px;"><h6 style="color:#ec4899; text-align:center; margin-bottom:15px;">Gambar Hasil Pemeriksaan Mata</h6>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">';

                    // OD Image
                    var imgFileOD = 'mata_od_' + d.no_rawat.replace(/\//g, '') + '.png';
                    var imgUrlOD = '<?= base_url("assets/images/lokalis_mata/") ?>' + imgFileOD;
                    html += '<div style="text-align:center;"><h6 style="color:#ec4899;">OD (Mata Kanan)</h6>';
                    html += '<img src="' + imgUrlOD + '" style="max-width:100%; border:2px solid #ec4899; border-radius:8px;" onerror="this.src=\'<?= base_url("assets/images/mata/mata_od_template.png") ?>\'"></div>';

                    // OS Image
                    var imgFileOS = 'mata_os_' + d.no_rawat.replace(/\//g, '') + '.png';
                    var imgUrlOS = '<?= base_url("assets/images/lokalis_mata/") ?>' + imgFileOS;
                    html += '<div style="text-align:center;"><h6 style="color:#ec4899;">OS (Mata Kiri)</h6>';
                    html += '<img src="' + imgUrlOS + '" style="max-width:100%; border:2px solid #ec4899; border-radius:8px;" onerror="this.src=\'<?= base_url("assets/images/mata/mata_os_template.png") ?>\'"></div>';

                    html += '</div></div></div>';

                    if (d.lab || d.rad || d.penunjang || d.tes || d.pemeriksaan) {
                        html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #8b5cf6;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#8b5cf6;"><i class="fa fa-flask"></i> IV. PEMERIKSAAN PENUNJANG</h5>';
                        if (d.lab) html += '<p><strong>Lab:</strong> ' + d.lab + '</p>';
                        if (d.rad) html += '<p><strong>Radiologi:</strong> ' + d.rad + '</p>';
                        if (d.penunjang) html += '<p><strong>Penunjang:</strong> ' + d.penunjang + '</p>';
                        if (d.tes) html += '<p><strong>Tes:</strong> ' + d.tes + '</p>';
                        if (d.pemeriksaan) html += '<p><strong>Pemeriksaan:</strong> ' + d.pemeriksaan + '</p>';
                        html += '</div>';
                    }

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-notes-medical"></i> V. DIAGNOSIS & TATALAKSANA</h5>';
                    html += '<p><strong>Diagnosis:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    if (d.diagnosisbdg) html += '<p><strong>Diagnosis Banding:</strong><br>' + d.diagnosisbdg + '</p>';
                    if (d.permasalahan) html += '<p><strong>Permasalahan:</strong><br>' + d.permasalahan + '</p>';
                    if (d.terapi) html += '<p><strong>Terapi:</strong><br>' + d.terapi + '</p>';
                    if (d.tindakan) html += '<p><strong>Tindakan:</strong><br>' + d.tindakan + '</p>';
                    if (d.edukasi) html += '<p><strong>Edukasi:</strong><br>' + d.edukasi + '</p>';
                    html += '</div></div>';

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#ec4899;"><i class="fa fa-file-medical"></i> Detail Asesmen Mata</span>',
                        html: html,
                        width: '900px',
                        showDenyButton: true,
                        confirmButtonText: '<i class="fa fa-times"></i> Tutup',
                        denyButtonText: '<i class="fa fa-print"></i> Cetak PDF',
                        confirmButtonColor: '#ec4899',
                        denyButtonColor: '#10b981'
                    }).then((result) => {
                        if (result.isDenied) {
                            window.open('<?= base_url("AwalMedisMataController/print_pdf?no_rawat=") ?>' + d.no_rawat, '_blank');
                        }
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisMataController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;

                    if (d.tanggal) {
                        const parts = d.tanggal.split(' ');
                        if (parts.length >= 2) {
                            const dateStr = parts[0];
                            const timeParts = parts[1].split(':');
                            const timeStr = timeParts[0] + ':' + timeParts[1] + ':' + timeParts[2];
                            document.querySelector('[name="tanggal"]').value = dateStr;
                            document.querySelector('[name="jam"]').value = timeStr;
                        }
                    }

                    const fields = ['no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpo', 'alergi',
                        'status', 'td', 'nadi', 'rr', 'suhu', 'nyeri', 'bb',
                        'visuskanan', 'visuskiri', 'cckanan', 'cckiri', 'palkanan', 'palkiri',
                        'conkanan', 'conkiri', 'corneakanan', 'corneakiri', 'coakanan', 'coakiri',
                        'pupilkanan', 'pupilkiri', 'lensakanan', 'lensakiri', 'funduskanan', 'funduskiri',
                        'papilkanan', 'papilkiri', 'retinakanan', 'retinakiri', 'makulakanan', 'makulakiri',
                        'tiokanan', 'tiokiri', 'mbokanan', 'mbokiri',
                        'lab', 'rad', 'penunjang', 'tes', 'pemeriksaan',
                        'diagnosis', 'diagnosisbdg', 'permasalahan', 'terapi', 'tindakan', 'edukasi'];
                    fields.forEach(f => {
                        const el = document.querySelector('[name="' + f + '"]');
                        if (el && d[f]) el.value = d[f];
                    });
                    toggleHubungan(d.anamnesis);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    setEditMode();
                    typeof Swal !== "undefined" && Swal.fire({ icon: 'info', title: 'Mode Edit', text: 'Data dimuat. Silakan edit dan simpan.', timer: 2000, showConfirmButton: false });
                }
            });
    }

    function printSinglePDF(noRawat) {
        window.open('<?= base_url("AwalMedisMataController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
    }

    function deleteAssessmentHistory(noRawat) {
        typeof Swal !== "undefined" && Swal.fire({
            title: 'Hapus Asesmen?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url("AwalMedisMataController/delete") ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'no_rawat=' + noRawat
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            typeof Swal !== "undefined" && Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 3000, showConfirmButton: false });
                            setTimeout(function () { loadHistory(); }, 500);
                            resetFormAndButton();
                            setTimeout(function () { window.scrollTo({ top: 0, behavior: 'smooth' }); }, 3100);
                        }
                    });
            }
        });
    }

    // Auto-load history
    (function () {
        let attempts = 0;
        const checkAndLoad = setInterval(function () {
            attempts++;
            const startDate = document.getElementById('filterStartDate');
            const endDate = document.getElementById('filterEndDate');
            const container = document.getElementById('historyContainer');
            if (startDate && endDate && container && typeof loadHistory === 'function') {
                clearInterval(checkAndLoad);
                loadHistory();
            } else if (attempts >= 20) {
                clearInterval(checkAndLoad);
            }
        }, 500);
    })();

    // Force clear form on page load
    (function () {
        setTimeout(function () {
            const form = document.getElementById('formMataAssessment');
            if (form) {
                form.reset();
                form.querySelectorAll('input[type="text"], textarea').forEach(function (el) {
                    el.value = '';
                });
                form.querySelectorAll('select').forEach(function (el) {
                    el.selectedIndex = 0;
                });
                const btnSubmit = document.getElementById('btnSubmit');
                if (btnSubmit) {
                    btnSubmit.innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
                }
                console.log('✅ Form forcefully cleared on page load - all fields reset');
            }
        }, 800);
    })();
</script>
<!-- ASESMEN AWAL MEDIS UROLOGI - COMPLETE CLEAN VERSION -->
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

    .canvas-wrapper {
        border: 2px dashed #ddd;
        padding: 10px;
        background: #f9f9f9;
        text-align: center;
    }

    canvas {
        border: 1px solid #ccc;
        cursor: crosshair;
        max-width: 100%;
    }
</style>

<div class="container-fluid">
    <form id="formUROLOGIAssessment" autocomplete="off">
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
                        placeholder="Contoh: Istri, Suami, Anak">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Penyakit Dahulu (RPD)</label>
                    <textarea class="form-control" name="rpd" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Penyakit Keluarga (RPK)</label>
                    <textarea class="form-control" name="rpk" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Penggunaan Obat (RPO)</label>
                    <textarea class="form-control" name="rpo" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Kebiasaan</label>
                    <textarea class="form-control" name="riwayat_kebiasaan" rows="2"
                        placeholder="Merokok, alkohol, dll..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Operasi Urologi</label>
                    <textarea class="form-control" name="riwayat_operasi_urologi" rows="2"
                        placeholder="Riwayat operasi urologi sebelumnya..."></textarea>
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
            <div class="col-md-2">
                <div class="form-group">
                    <label>TD (mmHg)</label>
                    <input type="text" class="form-control" name="td" value="" placeholder="120/80">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Nadi (x/mnt)</label>
                    <input type="text" class="form-control" name="nadi" value="" placeholder="80">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>RR (x/mnt)</label>
                    <input type="text" class="form-control" name="rr" value="" placeholder="20">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="suhu" value="" placeholder="36.5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>BB (kg)</label>
                    <input type="text" class="form-control" name="bb" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>TB (cm)</label>
                    <input type="text" class="form-control" name="tb" value="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Keadaan Umum</label>
                    <select class="form-control" name="keadaan_umum">
                        <option value="">-- Pilih --</option>
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit Ringan">Sakit Ringan</option>
                        <option value="Sakit Sedang">Sakit Sedang</option>
                        <option value="Sakit Berat">Sakit Berat</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nyeri (1-10)</label>
                    <input type="text" class="form-control" name="nyeri" value="" placeholder="0-10">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status Nutrisi</label>
                    <input type="text" class="form-control" name="status_nutrisi" value=""
                        placeholder="Normal/Kurang/Lebih">
                </div>
            </div>
        </div>

        <!-- III. PEMERIKSAAN SISTEMIK -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> III. PEMERIKSAAN SISTEMIK</div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Thoraks <span class="text-danger">*</span></label>
                    <select class="form-control" name="thoraks" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Thoraks</label>
                    <input type="text" class="form-control" name="keterangan_thoraks" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Abdomen <span class="text-danger">*</span></label>
                    <select class="form-control" name="abdomen" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Abdomen</label>
                    <input type="text" class="form-control" name="keterangan_abdomen" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ekstrimitas <span class="text-danger">*</span></label>
                    <select class="form-control" name="ekstrimitas" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Ekstrimitas</label>
                    <input type="text" class="form-control" name="keterangan_ekstrimitas" value="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nyeri Ketok CVA</label>
                    <input type="text" class="form-control" name="nyeri_ketok_cva" value=""
                        placeholder="Positif/Negatif">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Genitalia Eksternal</label>
                    <input type="text" class="form-control" name="genitalia_eksternal" value=""
                        placeholder="Pemeriksaan genitalia...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Colok Dubur (RT)</label>
                    <input type="text" class="form-control" name="colok_dubur" value=""
                        placeholder="Hasil colok dubur...">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Pemeriksaan Lainnya</label>
            <textarea class="form-control" name="lainnya" rows="2"
                placeholder="Pemeriksaan fisik lainnya..."></textarea>
        </div>

        <!-- IV. PEMERIKSAAN PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> IV. PEMERIKSAAN PENUNJANG</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Urinalisis</label>
                    <textarea class="form-control" name="urinalisis" rows="3"
                        placeholder="Hasil pemeriksaan urinalisis..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Darah</label>
                    <textarea class="form-control" name="darah" rows="3"
                        placeholder="Hasil pemeriksaan darah..."></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>USG Urologi</label>
                    <textarea class="form-control" name="usg_urologi" rows="3"
                        placeholder="Hasil USG urologi..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Radiologi</label>
                    <textarea class="form-control" name="radiologi" rows="3"
                        placeholder="Hasil pemeriksaan radiologi..."></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Pemeriksaan Penunjang Lain</label>
            <textarea class="form-control" name="penunjang_lain" rows="2"
                placeholder="Pemeriksaan penunjang lainnya..."></textarea>
        </div>

        <!-- V. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> V. DIAGNOSIS & TATALAKSANA</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosis Utama <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="diagnosis" rows="2" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosis Sekunder</label>
                    <textarea class="form-control" name="diagnosis2" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Permasalahan</label>
            <textarea class="form-control" name="permasalahan" rows="2"></textarea>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Terapi</label>
                    <textarea class="form-control" name="terapi" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tindakan</label>
                    <textarea class="form-control" name="tindakan" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Edukasi</label>
                    <textarea class="form-control" name="edukasi" rows="3"></textarea>
                </div>
            </div>
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
            class="fa fa-history"></i> RIWAYAT ASESMEN UROLOGI</div>

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

    // Init
    setTimeout(function () {
        const anamnesis = document.querySelector('[name="anamnesis"]');
        if (anamnesis) toggleHubungan(anamnesis.value);
    }, 100);

    // Canvas
    var canvas, ctx, isDrawing = false, currentColor = 'red', lastX = 0, lastY = 0;
    var backgroundURL = '<?= base_url("assets/images/status_lokalis_urologi.png") ?>';

    setTimeout(function () {
        canvas = document.getElementById('urologiCanvas');
        if (!canvas) return;

        ctx = canvas.getContext('2d');
        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };
        img.src = backgroundURL;

        canvas.onmousedown = function (e) {
            isDrawing = true;
            const rect = canvas.getBoundingClientRect();
            lastX = (e.clientX - rect.left) * (canvas.width / rect.width);
            lastY = (e.clientY - rect.top) * (canvas.height / rect.height);
        };

        canvas.onmousemove = function (e) {
            if (!isDrawing) return;
            const rect = canvas.getBoundingClientRect();
            const x = (e.clientX - rect.left) * (canvas.width / rect.width);
            const y = (e.clientY - rect.top) * (canvas.height / rect.height);
            ctx.beginPath();
            ctx.strokeStyle = currentColor;
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.stroke();
            lastX = x;
            lastY = y;
        };

        canvas.onmouseup = canvas.onmouseleave = function () {
            if (isDrawing) {
                isDrawing = false;
                document.getElementById('lokalisImage').value = canvas.toDataURL('image/png');
            }
        };
    }, 500);

    window.setDrawColor = function (color) { currentColor = color; };
    window.clearCanvas = function () {
        if (!ctx || !canvas) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        var img = new Image();
        img.onload = function () { ctx.drawImage(img, 0, 0, canvas.width, canvas.height); };
        img.src = backgroundURL;
        document.getElementById('lokalisImage').value = '';
    };

    // Helper function to reset form and button
    window.resetFormAndButton = function () {
        document.getElementById('formUROLOGIAssessment').reset();
        if (typeof clearCanvas === 'function') clearCanvas();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    // Helper function to set edit mode
    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Form Submit
    document.getElementById('formUROLOGIAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisUROLOGIController/save") ?>', {
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

        fetch('<?= base_url("AwalMedisUROLOGIController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
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
        fetch('<?= base_url("AwalMedisUROLOGIController/get_detail") ?>?no_rawat=' + noRawat)
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

                    // Grid 2 kolom untuk section-section
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">';

                    // Kolom Kiri
                    html += '<div>';

                    // I. ANAMNESIS
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-clipboard"></i> I. ANAMNESIS</h5>';
                    html += '<p style="font-size:11px;"><strong>Jenis:</strong> ' + (d.anamnesis || '-') + '</p>';
                    if (d.hubungan) html += '<p style="font-size:11px;"><strong>Hubungan:</strong> ' + d.hubungan + '</p>';
                    html += '<p style="font-size:11px;"><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>RPS:</strong><br>' + (d.rps || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>RPD:</strong> ' + (d.rpd || '-') + '</p>';
                    if (d.rpk) html += '<p style="font-size:11px;"><strong>RPK:</strong> ' + d.rpk + '</p>';
                    html += '<p style="font-size:11px;"><strong>RPO:</strong> ' + (d.rpo || '-') + '</p>';
                    if (d.riwayat_kebiasaan) html += '<p style="font-size:11px;"><strong>Riwayat Kebiasaan:</strong> ' + d.riwayat_kebiasaan + '</p>';
                    if (d.riwayat_operasi_urologi) html += '<p style="font-size:11px;"><strong>Riwayat Operasi Urologi:</strong> ' + d.riwayat_operasi_urologi + '</p>';
                    html += '<p style="font-size:11px;"><strong>Alergi:</strong> ' + (d.alergi || '-') + '</p></div>';

                    // II. PEMERIKSAAN FISIK
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981;"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:5px;">';
                    html += '<p style="font-size:11px;"><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p style="font-size:11px;"><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '<p style="font-size:11px;"><strong>BB:</strong> ' + (d.bb || '-') + ' kg</p>';
                    html += '<p style="font-size:11px;"><strong>TB:</strong> ' + (d.tb || '-') + ' cm</p>';
                    if (d.keadaan_umum) html += '<p style="font-size:11px;"><strong>Keadaan Umum:</strong> ' + d.keadaan_umum + '</p>';
                    html += '<p style="font-size:11px;"><strong>Nyeri:</strong> ' + (d.nyeri || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Status Nutrisi:</strong> ' + (d.status_nutrisi || '-') + '</p></div></div>';

                    html += '</div>'; // End Kolom Kiri

                    // Kolom Kanan
                    html += '<div>';

                    // III. PEMERIKSAAN SISTEMIK
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#f59e0b;"><i class="fa fa-stethoscope"></i> III. PEMERIKSAAN SISTEMIK</h5>';
                    if (d.thoraks) {
                        html += '<p style="font-size:11px;"><strong>Thoraks:</strong> ' + d.thoraks;
                        if (d.keterangan_thoraks) html += ' <span style="color:#666;">(' + d.keterangan_thoraks + ')</span>';
                        html += '</p>';
                    }
                    if (d.abdomen) {
                        html += '<p style="font-size:11px;"><strong>Abdomen:</strong> ' + d.abdomen;
                        if (d.keterangan_abdomen) html += ' <span style="color:#666;">(' + d.keterangan_abdomen + ')</span>';
                        html += '</p>';
                    }
                    if (d.ekstrimitas) {
                        html += '<p style="font-size:11px;"><strong>Ekstrimitas:</strong> ' + d.ekstrimitas;
                        if (d.keterangan_ekstrimitas) html += ' <span style="color:#666;">(' + d.keterangan_ekstrimitas + ')</span>';
                        html += '</p>';
                    }
                    if (d.nyeri_ketok_cva) html += '<p style="font-size:11px;"><strong>Nyeri Ketok CVA:</strong> ' + d.nyeri_ketok_cva + '</p>';
                    if (d.genitalia_eksternal) html += '<p style="font-size:11px;"><strong>Genitalia Eksternal:</strong> ' + d.genitalia_eksternal + '</p>';
                    if (d.colok_dubur) html += '<p style="font-size:11px;"><strong>Colok Dubur:</strong> ' + d.colok_dubur + '</p>';
                    if (d.lainnya) html += '<p style="font-size:11px;"><strong>Lainnya:</strong><br>' + d.lainnya + '</p>';
                    html += '</div>';

                    // IV. PEMERIKSAAN PENUNJANG
                    if (d.urinalisis || d.darah || d.usg_urologi || d.radiologi || d.penunjang_lain) {
                        html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #06b6d4;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#06b6d4;"><i class="fa fa-flask"></i> IV. PEMERIKSAAN PENUNJANG</h5>';
                        if (d.urinalisis) html += '<p style="font-size:11px;"><strong>Urinalisis:</strong><br>' + d.urinalisis + '</p>';
                        if (d.darah) html += '<p style="font-size:11px;"><strong>Darah:</strong><br>' + d.darah + '</p>';
                        if (d.usg_urologi) html += '<p style="font-size:11px;"><strong>USG Urologi:</strong><br>' + d.usg_urologi + '</p>';
                        if (d.radiologi) html += '<p style="font-size:11px;"><strong>Radiologi:</strong><br>' + d.radiologi + '</p>';
                        if (d.penunjang_lain) html += '<p style="font-size:11px;"><strong>Penunjang Lain:</strong><br>' + d.penunjang_lain + '</p>';
                        html += '</div>';
                    }

                    html += '</div>'; // End Kolom Kanan
                    html += '</div>'; // End Grid 2 kolom

                    // V. DIAGNOSIS & TATALAKSANA (Full Width)
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-notes-medical"></i> V. DIAGNOSIS & TATALAKSANA</h5>';
                    html += '<p style="font-size:11px;"><strong>Diagnosis Utama:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    if (d.diagnosis2) html += '<p style="font-size:11px;"><strong>Diagnosis Sekunder:</strong><br>' + d.diagnosis2 + '</p>';
                    if (d.permasalahan) html += '<p style="font-size:11px;"><strong>Permasalahan:</strong><br>' + d.permasalahan + '</p>';
                    if (d.terapi) html += '<p style="font-size:11px;"><strong>Terapi:</strong><br>' + d.terapi + '</p>';
                    if (d.tindakan) html += '<p style="font-size:11px;"><strong>Tindakan:</strong><br>' + d.tindakan + '</p>';
                    if (d.edukasi) html += '<p style="font-size:11px;"><strong>Edukasi:</strong><br>' + d.edukasi + '</p>';
                    html += '</div></div>';

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#ec4899;"><i class="fa fa-file-medical"></i> Detail Asesmen UROLOGI</span>',
                        html: html,
                        width: '900px',
                        confirmButtonText: '<i class="fa fa-times"></i> Tutup',
                        confirmButtonColor: '#ec4899'
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisUROLOGIController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;

                    // Parse tanggal dan jam dari datetime
                    if (d.tanggal) {
                        // Format dari database: "2025-12-21 12:00:41"
                        // Split menjadi date dan time
                        const parts = d.tanggal.split(' ');
                        if (parts.length >= 2) {
                            const dateStr = parts[0]; // YYYY-MM-DD
                            const timeParts = parts[1].split(':');
                            const timeStr = timeParts[0] + ':' + timeParts[1]; // HH:MM (buang detik)
                            document.querySelector('[name="tanggal"]').value = dateStr;
                            document.querySelector('[name="jam"]').value = timeStr;
                        }
                    }

                    const fields = ['no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo',
                        'riwayat_kebiasaan', 'riwayat_operasi_urologi', 'alergi',
                        'td', 'nadi', 'rr', 'suhu', 'bb', 'tb', 'keadaan_umum', 'nyeri', 'status_nutrisi',
                        'thoraks', 'keterangan_thoraks', 'abdomen', 'keterangan_abdomen',
                        'ekstrimitas', 'keterangan_ekstrimitas', 'nyeri_ketok_cva', 'genitalia_eksternal', 'colok_dubur', 'lainnya',
                        'urinalisis', 'darah', 'usg_urologi', 'radiologi', 'penunjang_lain',
                        'diagnosis', 'diagnosis2', 'permasalahan', 'terapi', 'tindakan', 'edukasi'];
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
        window.open('<?= base_url("AwalMedisUROLOGIController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
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
                fetch('<?= base_url("AwalMedisUROLOGIController/delete") ?>', {
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

    // Force clear form on page load (prevent browser autocomplete)
    (function () {
        setTimeout(function () {
            const form = document.getElementById('formUROLOGIAssessment');
            if (form) {
                // Reset the entire form
                form.reset();

                // Explicitly clear all text inputs and textareas
                form.querySelectorAll('input[type="text"], textarea').forEach(function (el) {
                    el.value = '';
                });

                // Reset all selects to first option (empty option)
                form.querySelectorAll('select').forEach(function (el) {
                    el.selectedIndex = 0;
                });

                // Clear canvas if exists
                if (typeof clearCanvas === 'function') {
                    clearCanvas();
                }

                // Reset button text
                const btnSubmit = document.getElementById('btnSubmit');
                if (btnSubmit) {
                    btnSubmit.innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
                }

                console.log('✅ Form forcefully cleared on page load - all fields reset');
            }
        }, 800); // Run AFTER canvas init and all other scripts
    })();
</script>
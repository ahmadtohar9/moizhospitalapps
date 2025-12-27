<!-- ASESMEN AWAL MEDIS UMUM - Sesuai Tabel penilaian_medis_ralan -->
<style>
    .section-header {
        background: linear-gradient(135deg, #ec407a 0%, #d81b60 100%);
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
    <form id="formUmumAssessment" autocomplete="off">
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
                    <input type="text" class="form-control" name="hubungan" value="" maxlength="30"
                        placeholder="Contoh: Ibu kandung">
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

        <div class="form-group">
            <label>Riwayat Alergi</label>
            <input type="text" class="form-control" name="alergi" value="" maxlength="50" placeholder="Maks 50 karakter">
        </div>

        <!-- II. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Keadaan Umum <span class="text-danger">*</span></label>
                    <select class="form-control" name="keadaan" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit Ringan">Sakit Ringan</option>
                        <option value="Sakit Sedang">Sakit Sedang</option>
                        <option value="Sakit Berat">Sakit Berat</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Kesadaran <span class="text-danger">*</span></label>
                    <select class="form-control" name="kesadaran" required>
                        <option value="">-- Pilih --</option>
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolen">Somnolen</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Koma">Koma</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>GCS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="gcs" value="" required placeholder="E4V5M6" maxlength="10">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>SpO₂ (%)</label>
                    <input type="text" class="form-control" name="spo" value="" placeholder="98" maxlength="5">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>TD (mmHg)</label>
                    <input type="text" class="form-control" name="td" value="" placeholder="120/80" maxlength="8">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Nadi (x/mnt)</label>
                    <input type="text" class="form-control" name="nadi" value="" placeholder="80" maxlength="5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>RR (x/mnt)</label>
                    <input type="text" class="form-control" name="rr" value="" placeholder="20" maxlength="5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="suhu" value="" placeholder="36.5" maxlength="5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>BB (kg)</label>
                    <input type="text" class="form-control" name="bb" value="" maxlength="5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>TB (cm)</label>
                    <input type="text" class="form-control" name="tb" value="" maxlength="5">
                </div>
            </div>
        </div>

        <!-- III. PEMERIKSAAN SISTEMIK -->
        <div class="section-header"><i class="fa fa-user-md"></i> III. PEMERIKSAAN SISTEMIK</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kepala</label>
                    <select class="form-control" name="kepala">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Gigi & Mulut</label>
                    <select class="form-control" name="gigi">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>THT (Telinga, Hidung, Tenggorok)</label>
                    <select class="form-control" name="tht">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Thoraks</label>
                    <select class="form-control" name="thoraks">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Abdomen</label>
                    <select class="form-control" name="abdomen">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Genital</label>
                    <select class="form-control" name="genital">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ekstremitas</label>
                    <select class="form-control" name="ekstremitas">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kulit</label>
                    <select class="form-control" name="kulit">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keterangan Pemeriksaan Fisik</label>
            <textarea class="form-control" name="ket_fisik" rows="2"></textarea>
        </div>

        <!-- IV. STATUS LOKALIS -->
        <div class="section-header"><i class="fa fa-image"></i> IV. STATUS LOKALIS</div>

        <div class="row">
            <!-- Kolom Gambar Lokalis -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gambar Lokalis</label>
                    <div class="canvas-wrapper" style="height:450px;">
                        <div style="margin-bottom:10px;">
                            <button type="button" class="btn btn-sm btn-danger" onclick="setDrawColor('red')"><i
                                    class="fa fa-circle" style="color:red"></i> Merah</button>
                            <button type="button" class="btn btn-sm btn-primary" onclick="setDrawColor('blue')"><i
                                    class="fa fa-circle" style="color:blue"></i> Biru</button>
                            <button type="button" class="btn btn-sm btn-dark" onclick="setDrawColor('black')"><i
                                    class="fa fa-circle"></i> Hitam</button>
                            <button type="button" class="btn btn-sm btn-success" onclick="setDrawColor('green')"><i
                                    class="fa fa-circle" style="color:green"></i> Hijau</button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="clearCanvas()"><i
                                    class="fa fa-eraser"></i> Hapus</button>
                        </div>
                        <canvas id="umumCanvas" width="600" height="350"></canvas>
                        <input type="hidden" name="lokalis_image" id="lokalisImage">
                    </div>
                </div>
            </div>

            <!-- Kolom Keterangan Lokalis -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Keterangan Lokalis</label>
                    <textarea class="form-control" name="ket_lokalis" rows="18"
                        placeholder="Keterangan detail lokasi yang diperiksa..."></textarea>
                </div>
            </div>
        </div>

        <!-- V. PEMERIKSAAN PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</div>
        <div class="form-group">
            <label>Pemeriksaan Penunjang (Lab, Rad, EKG, dll)</label>
            <textarea class="form-control" name="penunjang" rows="3"></textarea>
        </div>

        <!-- VI. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS & TATALAKSANA</div>
        <div class="form-group">
            <label>Diagnosis <span class="text-danger">*</span></label>
            <textarea class="form-control" name="diagnosis" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label>Tatalaksana <span class="text-danger">*</span></label>
            <textarea class="form-control" name="tata" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Konsul / Rujukan</label>
            <textarea class="form-control" name="konsulrujuk" rows="2" placeholder="Jika ada"></textarea>
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
    <div class="section-header" style="background: linear-gradient(135deg, #ec407a 0%, #d81b60 100%);"><i
            class="fa fa-history"></i> RIWAYAT ASESMEN UMUM</div>

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
    var backgroundURL = '<?= base_url("assets/images/status_lokalis_igd.png") ?>'; 

    setTimeout(function () {
        canvas = document.getElementById('umumCanvas'); 
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
        document.getElementById('formUmumAssessment').reset();
        if (typeof clearCanvas === 'function') clearCanvas();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    // Helper function to set edit mode
    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Form Submit
    document.getElementById('formUmumAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisUmumController/save") ?>', {
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

        fetch('<?= base_url("AwalMedisUmumController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
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
        fetch('<?= base_url("AwalMedisUmumController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    const date = new Date(d.tanggal);
                    const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

                    let html = '<div style="text-align:left; max-height:600px; overflow-y:auto; padding:10px;">';
                    html += '<div style="background:linear-gradient(135deg, #ec407a 0%, #d81b60 100%); color:white; padding:15px; border-radius:8px; margin-bottom:20px;">';
                    html += '<h4 style="margin:0 0 10px 0;"><i class="fa fa-calendar"></i> ' + formattedDate + '</h4>';
                    html += '<p style="margin:0;"><i class="fa fa-user-md"></i> ' + (d.nm_dokter || 'Dokter') + '</p></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec407a;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec407a;"><i class="fa fa-clipboard"></i> I. ANAMNESIS</h5>';
                    html += '<p><strong>Jenis:</strong> ' + (d.anamnesis || '-') + '</p>';
                    if (d.hubungan) html += '<p><strong>Hubungan:</strong> ' + d.hubungan + '</p>';
                    html += '<p><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p><strong>RPS:</strong><br>' + (d.rps || '-') + '</p>';
                    html += '<p><strong>RPD:</strong> ' + (d.rpd || '-') + '</p>';
                    html += '<p><strong>RPK:</strong> ' + (d.rpk || '-') + '</p>';
                    html += '<p><strong>RPO:</strong> ' + (d.rpo || '-') + '</p>';
                    html += '<p><strong>Alergi:</strong> ' + (d.alergi || '-') + '</p></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981;"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">';
                    html += '<p><strong>Keadaan Umum:</strong> ' + (d.keadaan || '-') + '</p>';
                    html += '<p><strong>Kesadaran:</strong> ' + (d.kesadaran || '-') + '</p>';
                    html += '<p><strong>GCS:</strong> ' + (d.gcs || '-') + '</p>';
                    html += '<p><strong>SpO₂:</strong> ' + (d.spo || '-') + '%</p>';
                    html += '<p><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '<p><strong>BB:</strong> ' + (d.bb || '-') + ' kg</p>';
                    html += '<p><strong>TB:</strong> ' + (d.tb || '-') + ' cm</p></div></div>';

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#f59e0b;"><i class="fa fa-user-md"></i> III. PEMERIKSAAN SISTEMIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px; font-size:13px;">';
                    html += '<p><strong>Kepala:</strong> ' + (d.kepala || '-') + '</p>';
                    // Removed Mata, Added THT
                    html += '<p><strong>Gigi:</strong> ' + (d.gigi || '-') + '</p>';
                    html += '<p><strong>THT:</strong> ' + (d.tht || '-') + '</p>';
                    html += '<p><strong>Thoraks:</strong> ' + (d.thoraks || '-') + '</p>';
                    html += '<p><strong>Abdomen:</strong> ' + (d.abdomen || '-') + '</p>';
                    html += '<p><strong>Genital:</strong> ' + (d.genital || '-') + '</p>';
                    html += '<p><strong>Ekstremitas:</strong> ' + (d.ekstremitas || '-') + '</p>';
                    html += '<p><strong>Kulit:</strong> ' + (d.kulit || '-') + '</p>';
                    html += '</div>';
                    if (d.ket_fisik) html += '<p><strong>Keterangan Fisik:</strong><br>' + d.ket_fisik + '</p>';
                    html += '</div>';

                    // Always show Status Lokalis section (for image)
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec407a;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec407a;"><i class="fa fa-image"></i> IV. STATUS LOKALIS</h5>';
                    if (d.ket_lokalis) html += '<p><strong>Keterangan:</strong><br>' + d.ket_lokalis + '</p>';
                    var imgFile = 'lokalis_' + d.no_rawat.replace(/\//g, '') + '.png';
                    var imgUrl = '<?= base_url("assets/images/lokalis_resumemedis/") ?>' + imgFile;
                    html += '<div style="text-align:center; margin-top:10px;"><img src="' + imgUrl + '" style="max-width:100%; border-radius:8px; border:2px solid #ddd;" onerror="console.error(\'❌ Image failed to load:\', this.src); this.style.display=' + "'none'" + '"></div>';
                    html += '</div>';

                    if (d.penunjang) {
                        html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #8b5cf6;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#8b5cf6;"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</h5>';
                        html += '<p>' + nl2br(d.penunjang) + '</p>';
                        html += '</div>';
                    }

                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec407a;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec407a;"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS & TATALAKSANA</h5>';
                    html += '<p><strong>Diagnosis:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    html += '<p><strong>Tatalaksana:</strong><br>' + (d.tata || '-') + '</p>';
                    if(d.konsulrujuk) html += '<p><strong>Konsul/Rujuk:</strong><br>' + d.konsulrujuk + '</p>';
                    html += '</div></div>';

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#d81b60;"><i class="fa fa-file-medical"></i> Detail Asesmen Umum</span>',
                        html: html,
                        width: '900px',
                        confirmButtonText: '<i class="fa fa-times"></i> Tutup',
                        confirmButtonColor: '#d81b60'
                    });
                }
            });
    }

    function nl2br(str) {
        if (!str) return '';
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisUmumController/get_detail") ?>?no_rawat=' + noRawat)
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

                    const fields = ['no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi',
                        'keadaan', 'kesadaran', 'gcs', 'spo', 'td', 'nadi', 'rr', 'suhu', 'bb', 'tb',
                        'kepala', 'gigi', 'tht', 'thoraks', 'abdomen', 'genital', 'ekstremitas', 'kulit',
                        'ket_fisik', 'ket_lokalis', 'penunjang', 'diagnosis', 'tata', 'konsulrujuk'];
                        
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
        window.open('<?= base_url("AwalMedisUmumController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
    }

    function deleteAssessmentHistory(noRawat) {
        typeof Swal !== "undefined" && Swal.fire({
            title: 'Hapus Asesmen?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d81b60',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url("AwalMedisUmumController/delete") ?>', {
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

    (function () {
        setTimeout(function () {
            const form = document.getElementById('formUmumAssessment');
            if (form) {
                form.reset();
                form.querySelectorAll('input[type="text"], textarea').forEach(function (el) {
                    el.value = '';
                });
                form.querySelectorAll('select').forEach(function (el) {
                    el.selectedIndex = 0;
                });
                if (typeof clearCanvas === 'function') {
                    clearCanvas();
                }
                const btnSubmit = document.getElementById('btnSubmit');
                if (btnSubmit) {
                    btnSubmit.innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
                }
                console.log('✅ Form forcefully cleared on page load - all fields reset');
            }
        }, 800); 
    })();
</script>
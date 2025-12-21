<!-- ASESMEN AWAL MEDIS GERIATRI - COMPLETE CLEAN VERSION -->
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
    <form id="formGeriatriAssessment" autocomplete="off">
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
                    <input type="text" class="form-control" name="hubungan" value="">
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
                    <label>Riwayat Penggunaan Obat (RPO)</label>
                    <textarea class="form-control" name="rpo" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Alergi</label>
                    <input type="text" class="form-control" name="alergi" value="">
                </div>
            </div>
        </div>

        <!-- II. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</div>

        <div class="row">
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
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="suhu" value="" placeholder="36.5">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kondisi Umum</label>
                    <textarea class="form-control" name="kondisi_umum" rows="2"
                        placeholder="Deskripsi kondisi umum pasien..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tulang Belakang</label>
                    <select class="form-control" name="tulang_belakang">
                        <option value="Tegap">Tegap</option>
                        <option value="Membungkuk">Membungkuk</option>
                        <option value="Kifosis">Kifosis</option>
                        <option value="Skoliosis">Skoliosis</option>
                        <option value="Lordosis">Lordosis</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- III. PENGKAJIAN GERIATRI -->
        <div class="section-header"><i class="fa fa-user-check"></i> III. PENGKAJIAN KHUSUS GERIATRI</div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Psikologis (GDS)</label>
                    <select class="form-control" name="status_psikologis_gds">
                        <option value="">-- Pilih --</option>
                        <option value="Skor 1-4 Tidak Ada Depresi">Skor 1-4 Tidak Ada Depresi</option>
                        <option value="Skor Antara 5-9 Menunjukkan Kemungkinan Besar Depresi">Skor 5-9 Kemungkinan
                            Depresi</option>
                        <option value="Skor 10 Atau Lebih Menunjukkan Depresi">Skor 10+ Depresi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Kognitif (MMSE)</label>
                    <select class="form-control" name="status_kognitif_mmse">
                        <option value="">-- Pilih --</option>
                        <option value="24-30 : Tidak Ada Gangguan Kognitif">24-30 : Normal</option>
                        <option value="18-23 : Gangguan Kognitif Sedang">18-23 : Gangguan Sedang</option>
                        <option value="0-17 : Gangguan Kognitif Berat">0-17 : Gangguan Berat</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Fungsional (ADL)</label>
                    <select class="form-control" name="status_fungsional">
                        <option value="">-- Pilih --</option>
                        <option value="20 : Mandiri (A)">20 : Mandiri (A)</option>
                        <option value="12-19 : Ketergantungan Ringan (B)">12-19 : Ketergantungan Ringan (B)</option>
                        <option value="9-11 : Ketergantungan Sedang (B)">9-11 : Ketergantungan Sedang (B)</option>
                        <option value="5-8 : Ketergantungan Berat (C)">5-8 : Ketergantungan Berat (C)</option>
                        <option value="0-4 : Ketergantungan Total (C)">0-4 : Ketergantungan Total (C)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Nutrisi (MNA)</label>
                    <select class="form-control" name="status_nutrisi">
                        <option value="">-- Pilih --</option>
                        <option value="Skor 12-14 : Status Gizi Normal">12-14 : Normal</option>
                        <option value="Skor 8-11 : Berisiko Malnutrisi">8-11 : Risiko Malnutrisi</option>
                        <option value="Skor 0-7 : Malnutrisi">0-7 : Malnutrisi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Skrining Risiko Jatuh</label>
                    <select class="form-control" name="skrining_jatuh">
                        <option value="">-- Pilih --</option>
                        <option value="Risiko Rendah Skor 0-5">Risiko Rendah (0-5)</option>
                        <option value="Risiko Sedang Skor 6-16">Risiko Sedang (6-16)</option>
                        <option value="Risiko Tinggi Skor 17-30">Risiko Tinggi (17-30)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kondisi Sosial</label>
                    <textarea class="form-control" name="kondisi_sosial" rows="2"
                        placeholder="Support system, tempat tinggal, dll"></textarea>
                </div>
            </div>
        </div>

        <!-- IV. PEMERIKSAAN SISTEMIK & INTEGUMENT -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> IV. PEMERIKSAAN SISTEMIK & INTEGUMENT</div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Kepala</label>
                    <select class="form-control" name="kepala">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control mt-1" name="keterangan_kepala" placeholder="Keterangan...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Thoraks</label>
                    <select class="form-control" name="thoraks">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control mt-1" name="keterangan_thoraks" placeholder="Keterangan...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Abdomen</label>
                    <select class="form-control" name="abdomen">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control mt-1" name="keterangan_abdomen" placeholder="Keterangan...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ekstremitas</label>
                    <select class="form-control" name="ekstremitas">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control mt-1" name="keterangan_ekstremitas"
                        placeholder="Keterangan...">
                </div>
            </div>
        </div>

        <label
            style="font-weight:bold; width:100%; border-bottom:1px solid #ddd; padding-bottom:5px; margin-top:10px;">INTEGUMENT
            (KULIT)</label>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Kebersihan</label>
                    <select class="form-control" name="Integument_kebersihan">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Warna</label>
                    <select class="form-control" name="Integument_warna">
                        <option value="Normal">Normal</option>
                        <option value="Pucat">Pucat</option>
                        <option value="Sianosis">Sianosis</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Kelembaban</label>
                    <select class="form-control" name="Integument_kelembaban">
                        <option value="Lembab">Lembab</option>
                        <option value="Kering">Kering</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Gangguan Kulit</label>
                    <select class="form-control" name="Integument_gangguan_kulit">
                        <option value="Normal">Normal</option>
                        <option value="Rash">Rash</option>
                        <option value="Luka">Luka</option>
                        <option value="Memar">Memar</option>
                        <option value="Ptekie">Ptekie</option>
                        <option value="Bula">Bula</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Pemeriksaan Fisik Lainnya</label>
            <textarea class="form-control" name="lainnya" rows="2"></textarea>
        </div>

        <!-- V. PEMERIKSAAN PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Laboratorium</label>
                    <textarea class="form-control" name="lab" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Radiologi</label>
                    <textarea class="form-control" name="rad" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Penunjang Lain</label>
                    <textarea class="form-control" name="pemeriksaan" rows="3"></textarea>
                </div>
            </div>
        </div>

        <!-- VI. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS & TATALAKSANA</div>
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
            class="fa fa-history"></i> RIWAYAT ASESMEN GERIATRI</div>

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
    var backgroundURL = '<?= base_url("assets/images/status_lokalis_geriatri.png") ?>';

    setTimeout(function () {
        canvas = document.getElementById('geriatriCanvas');
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
        document.getElementById('formGeriatriAssessment').reset();
        if (typeof clearCanvas === 'function') clearCanvas();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    // Helper function to set edit mode
    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Form Submit
    document.getElementById('formGeriatriAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisGeriatriController/save") ?>', {
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

        fetch('<?= base_url("AwalMedisGeriatriController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
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
        fetch('<?= base_url("AwalMedisGeriatriController/get_detail") ?>?no_rawat=' + noRawat)
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

                    // Grid 2 kolom
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
                    html += '<p style="font-size:11px;"><strong>RPO:</strong> ' + (d.rpo || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Alergi:</strong> ' + (d.alergi || '-') + '</p></div>';

                    // II. PEMERIKSAAN FISIK
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981;"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:5px;">';
                    html += '<p style="font-size:11px;"><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p style="font-size:11px;"><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '</div>';
                    html += '<p style="font-size:11px; margin-top:5px;"><strong>Kondisi Umum:</strong><br>' + (d.kondisi_umum || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Tulang Belakang:</strong> ' + (d.tulang_belakang || '-') + '</p></div>';

                    // III. PENGKAJIAN GERIATRI
                    html += '<div style="background:#f0f9ff; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #3b82f6;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#3b82f6;"><i class="fa fa-user-check"></i> III. PENGKAJIAN KHUSUS</h5>';
                    html += '<p style="font-size:11px;"><strong>Psikologis (GDS):</strong><br>' + (d.status_psikologis_gds || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Kognitif (MMSE):</strong><br>' + (d.status_kognitif_mmse || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Fungsional (ADL):</strong><br>' + (d.status_fungsional || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Nutrisi (MNA):</strong><br>' + (d.status_nutrisi || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Risiko Jatuh:</strong><br>' + (d.skrining_jatuh || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Kondisi Sosial:</strong><br>' + (d.kondisi_sosial || '-') + '</p>';
                    html += '</div>';
                    
                    html += '</div>'; // End Kolom Kiri

                    // Kolom Kanan
                    html += '<div>';

                    // IV. PEMERIKSAAN SISTEMIK & INTEGUMENT
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#f59e0b;"><i class="fa fa-stethoscope"></i> IV. SISTEMIK & INTEGUMENT</h5>';
                    
                    const sys = [
                        {l:'Kepala', v:d.kepala, k:d.keterangan_kepala},
                        {l:'Thoraks', v:d.thoraks, k:d.keterangan_thoraks},
                        {l:'Abdomen', v:d.abdomen, k:d.keterangan_abdomen},
                        {l:'Ekstremitas', v:d.ekstremitas, k:d.keterangan_ekstremitas}
                    ];
                    sys.forEach(s => {
                        if(s.v && s.v !== 'Tidak Diperiksa'){
                            html += '<p style="font-size:11px;"><strong>' + s.l + ':</strong> ' + s.v + (s.k ? ' (' + s.k + ')' : '') + '</p>';
                        }
                    });

                    html += '<div style="margin-top:10px; padding-top:10px; border-top:1px dashed #ddd;">';
                    html += '<p style="font-size:11px; font-weight:bold; color:#555;">Integument (Kulit):</p>';
                    html += '<p style="font-size:11px;"><strong>Kebersihan:</strong> ' + (d.Integument_kebersihan || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Warna:</strong> ' + (d.Integument_warna || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Kelembaban:</strong> ' + (d.Integument_kelembaban || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Gangguan:</strong> ' + (d.Integument_gangguan_kulit || '-') + '</p>';
                    html += '</div>';
                    
                    if(d.lainnya) html += '<p style="font-size:11px; margin-top:5px;"><strong>Lainnya:</strong><br>' + d.lainnya + '</p>';
                    html += '</div>';

                    // V. PEMERIKSAAN PENUNJANG
                     if (d.lab || d.rad || d.pemeriksaan) {
                        html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #06b6d4;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#06b6d4;"><i class="fa fa-flask"></i> V. PENUNJANG</h5>';
                        if (d.lab) html += '<p style="font-size:11px;"><strong>Laboratorium:</strong><br>' + d.lab + '</p>';
                        if (d.rad) html += '<p style="font-size:11px;"><strong>Radiologi:</strong><br>' + d.rad + '</p>';
                        if (d.pemeriksaan) html += '<p style="font-size:11px;"><strong>Penunjang Lain:</strong><br>' + d.pemeriksaan + '</p>';
                        html += '</div>';
                    }

                    // VI. DIAGNOSIS
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS</h5>';
                    html += '<p style="font-size:11px;"><strong>Diagnosis Utama:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    if (d.diagnosis2) html += '<p style="font-size:11px;"><strong>Diagnosis Sekunder:</strong><br>' + d.diagnosis2 + '</p>';
                    html += '</div>';

                    html += '</div>'; // End Kolom Kanan
                    html += '</div>'; // End Grid 2 kolom
                    
                    // Full Width Bottom
                    if (d.permasalahan || d.terapi || d.tindakan || d.edukasi) {
                         html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-top:0px;">';
                         if (d.permasalahan) html += '<p style="font-size:11px;"><strong>Permasalahan:</strong><br>' + d.permasalahan + '</p>';
                         if (d.terapi) html += '<p style="font-size:11px;"><strong>Terapi:</strong><br>' + d.terapi + '</p>';
                         if (d.tindakan) html += '<p style="font-size:11px;"><strong>Tindakan:</strong><br>' + d.tindakan + '</p>';
                         if (d.edukasi) html += '<p style="font-size:11px;"><strong>Edukasi:</strong><br>' + d.edukasi + '</p>';
                         html += '</div>';
                    }

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#ec4899;"><i class="fa fa-file-medical"></i> Detail Asesmen GERIATRI</span>',
                        html: html,
                        width: '900px',
                        confirmButtonText: '<i class="fa fa-times"></i> Tutup',
                        confirmButtonColor: '#ec4899'
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisGeriatriController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;

                    if (d.tanggal) {
                        const parts = d.tanggal.split(' ');
                        if (parts.length >= 2) {
                            document.querySelector('[name="tanggal"]').value = parts[0];
                            document.querySelector('[name="jam"]').value = parts[1].substring(0, 5);
                        }
                    }

                    // Toggle visibility FIRST so the input is active/visible
                    toggleHubungan(d.anamnesis);

                    const fields = [
                        'no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpo', 'alergi',
                        'td', 'nadi', 'rr', 'suhu', 'kondisi_umum', 'tulang_belakang',
                        'status_psikologis_gds', 'status_kognitif_mmse', 'status_fungsional', 'status_nutrisi', 'skrining_jatuh', 'kondisi_sosial',
                        'kepala', 'keterangan_kepala', 'thoraks', 'keterangan_thoraks', 'abdomen', 'keterangan_abdomen', 'ekstremitas', 'keterangan_ekstremitas',
                        'Integument_kebersihan', 'Integument_warna', 'Integument_kelembaban', 'Integument_gangguan_kulit',
                        'lainnya', 'lab', 'rad', 'pemeriksaan',
                        'diagnosis', 'diagnosis2', 'permasalahan', 'terapi', 'tindakan', 'edukasi'
                    ];

                    fields.forEach(f => {
                        const el = document.querySelector('[name="' + f + '"]');
                        if (el) {
                            el.value = d[f] || ''; // Use empty string if null to clear
                        }
                    });
                    
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    setEditMode();
                    typeof Swal !== "undefined" && Swal.fire({ icon: 'info', title: 'Mode Edit', text: 'Data dimuat. Silakan edit dan simpan.', timer: 2000, showConfirmButton: false });
                }
            });
    }

    function printSinglePDF(noRawat) {
        window.open('<?= base_url("AwalMedisGeriatriController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
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
                fetch('<?= base_url("AwalMedisGeriatriController/delete") ?>', {
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
            const form = document.getElementById('formGeriatriAssessment');
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
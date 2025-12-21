<!-- ASESMEN AWAL MEDIS NEUROLOGI - COMPLETE CLEAN VERSION -->
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
    <form id="formNEUROLOGIAssessment" autocomplete="off">
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

        <!-- (Riwayat Kebiasaan & Operasi Removed) -->

        <div class="form-group">
            <label>Riwayat Alergi</label>
            <input type="text" class="form-control" name="alergi" value="">
        </div>

        <!-- II. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kesadaran <span class="text-danger">*</span></label>
                    <select class="form-control" name="kesadaran" required>
                        <option value="">-- Pilih --</option>
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Delirum">Delirum</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>GCS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="gcs" maxlength="10" value="" required
                        placeholder="E4V5M6">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status Pasien <span class="text-danger">*</span></label>
                    <select class="form-control" name="status" required>
                        <option value="">-- Pilih --</option>
                        <option value="Skor < 2">Skor < 2</option>
                        <option value="Skor >= 2">Skor >= 2</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>TD (mmHg)</label>
                    <input type="text" class="form-control" name="td" maxlength="8" value="" placeholder="120/80">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Nadi (x/mnt)</label>
                    <input type="text" class="form-control" name="nadi" maxlength="5" value="" placeholder="80">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>RR (x/mnt)</label>
                    <input type="text" class="form-control" name="rr" maxlength="5" value="" placeholder="20">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="suhu" maxlength="5" value="" placeholder="36.5">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>BB (kg)</label>
                    <input type="text" class="form-control" name="bb" maxlength="5" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Nyeri</label>
                    <input type="text" class="form-control" name="nyeri" value="" placeholder="0-10">
                </div>
            </div>
        </div>

        <!-- (Lower Physical Removed) -->

        <!-- III. PEMERIKSAAN SISTEMIK -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> III. PEMERIKSAAN SISTEMIK</div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kepala <span class="text-danger">*</span></label>
                    <select class="form-control" name="kepala" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Kepala</label>
                    <input type="text" class="form-control" name="keterangan_kepala" maxlength="30" value="">
                </div>
            </div>
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
                    <input type="text" class="form-control" name="keterangan_thoraks" maxlength="30" value="">
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
                    <input type="text" class="form-control" name="keterangan_abdomen" maxlength="30" value="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ekstremitas <span class="text-danger">*</span></label>
                    <select class="form-control" name="ekstremitas" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Ekstremitas</label>
                    <input type="text" class="form-control" name="keterangan_ekstremitas" maxlength="30" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Columna Vertebralis <span class="text-danger">*</span></label>
                    <select class="form-control" name="columna" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Columna</label>
                    <input type="text" class="form-control" name="keterangan_columna" maxlength="30" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Muskuloskeletal <span class="text-danger">*</span></label>
                    <select class="form-control" name="muskulos" required>
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan Muskulos</label>
                    <input type="text" class="form-control" name="keterangan_muskulos" maxlength="30" value="">
                </div>
            </div>
        </div>

        <!-- (Urologi-specific exams removed) -->

        <!-- IV. STATUS LOKALIS (NEUROLOGI) -->
        <div class="section-header"><i class="fa fa-image"></i> IV. STATUS LOKALIS & KETERANGAN LAINNYA</div>
        <div class="form-group">
            <label>Keterangan Lokalis / Pemeriksaan Lainnya</label>
            <textarea class="form-control" name="lainnya" rows="5"
                placeholder="Deskripsi status lokalis atau pemeriksaan lainnya..."></textarea>
        </div>

        <!-- V. PEMERIKSAAN PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Laboratorium</label>
                    <textarea class="form-control" name="lab" rows="3"
                        placeholder="Hasil pemeriksaan lab..."></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Radiologi</label>
                    <textarea class="form-control" name="rad" rows="3"
                        placeholder="Hasil pemeriksaan radiologi..."></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Pemeriksaan Penunjang Lain</label>
            <textarea class="form-control" name="penunjanglain" rows="2"
                placeholder="Pemeriksaan lainnya..."></textarea>
        </div>

        <!-- V. DIAGNOSIS & TATALAKSANA -->
        <!-- VI. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> VII. DIAGNOSIS & TATALAKSANA</div>
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
            class="fa fa-history"></i> RIWAYAT ASESMEN NEUROLOGI</div>

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

    // Canvas logic removed

    // Helper function to reset form and button
    window.resetFormAndButton = function () {
        document.getElementById('formNEUROLOGIAssessment').reset();
        if (typeof clearCanvas === 'function') clearCanvas();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    // Helper function to set edit mode
    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Form Submit
    document.getElementById('formNEUROLOGIAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisNeurologiController/save") ?>', {
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

        fetch('<?= base_url("AwalMedisNeurologiController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
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
        fetch('<?= base_url("AwalMedisNeurologiController/get_detail") ?>?no_rawat=' + noRawat)
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

                    // I. ANAMNESIS
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-clipboard"></i> I. ANAMNESIS</h5>';
                    html += '<p><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p><strong>RPS:</strong><br>' + (d.rps || '-') + '</p>';
                    if (d.rpd) html += '<p><strong>RPD:</strong> ' + d.rpd + '</p>';
                    if (d.rpo) html += '<p><strong>RPO:</strong> ' + d.rpo + '</p>';
                    if (d.alergi) html += '<p><strong>Alergi:</strong> ' + d.alergi + '</p></div>';

                    // II. PEMERIKSAAN FISIK
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981;"><i class="fa fa-heartbeat"></i> II. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px;">';
                    html += '<p><strong>Kesadaran:</strong> ' + (d.kesadaran || '-') + '</p>';
                    html += '<p><strong>GCS:</strong> ' + (d.gcs || '-') + '</p>';
                    html += '<p><strong>Status:</strong> ' + (d.status || '-') + '</p>';
                    html += '<p><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '<p><strong>BB:</strong> ' + (d.bb || '-') + ' kg</p>';
                    html += '<p><strong>Nyeri:</strong> ' + (d.nyeri || '-') + '</p></div>';
                    html += '</div>';

                    // III. PEMERIKSAAN SISTEMIK
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#f59e0b;"><i class="fa fa-stethoscope"></i> III. PEMERIKSAAN SISTEMIK (NEUROLOGIS)</h5>';
                    if (d.kepala) html += '<p><strong>Kepala:</strong> ' + d.kepala + (d.keterangan_kepala ? ' (' + d.keterangan_kepala + ')' : '') + '</p>';
                    if (d.thoraks) html += '<p><strong>Thoraks:</strong> ' + d.thoraks + (d.keterangan_thoraks ? ' (' + d.keterangan_thoraks + ')' : '') + '</p>';
                    if (d.abdomen) html += '<p><strong>Abdomen:</strong> ' + d.abdomen + (d.keterangan_abdomen ? ' (' + d.keterangan_abdomen + ')' : '') + '</p>';
                    if (d.ekstremitas) html += '<p><strong>Ekstremitas:</strong> ' + d.ekstremitas + (d.keterangan_ekstremitas ? ' (' + d.keterangan_ekstremitas + ')' : '') + '</p>';
                    if (d.columna) html += '<p><strong>Columna Vertebralis:</strong> ' + d.columna + (d.keterangan_columna ? ' (' + d.keterangan_columna + ')' : '') + '</p>';
                    if (d.muskulos) html += '<p><strong>Muskuloskeletal:</strong> ' + d.muskulos + (d.keterangan_muskulos ? ' (' + d.keterangan_muskulos + ')' : '') + '</p>';
                    html += '</div>';

                    // IV. STATUS LOKALIS
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ef4444;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ef4444;"><i class="fa fa-image"></i> IV. STATUS LOKALIS</h5>';
                    if (d.lainnya) html += '<p><strong>Keterangan:</strong><br>' + d.lainnya + '</p>';
                    html += '</div>';

                    // V. PENUNJANG
                    if (d.lab || d.rad || d.penunjanglain) {
                        html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #06b6d4;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#06b6d4;"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</h5>';
                        if (d.lab) html += '<p><strong>Lab:</strong><br>' + d.lab + '</p>';
                        if (d.rad) html += '<p><strong>Radiologi:</strong><br>' + d.rad + '</p>';
                        if (d.penunjanglain) html += '<p><strong>Lainnya:</strong><br>' + d.penunjanglain + '</p>';
                        html += '</div>';
                    }

                    // VI. DIAGNOSIS
                    html += '<div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899;"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS & TATALAKSANA</h5>';
                    html += '<p><strong>Diagnosis Utama:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    if (d.diagnosis2) html += '<p><strong>Diagnosis Sekunder:</strong><br>' + d.diagnosis2 + '</p>';
                    if (d.permasalahan) html += '<p><strong>Permasalahan:</strong><br>' + d.permasalahan + '</p>';
                    if (d.terapi) html += '<p><strong>Terapi:</strong><br>' + d.terapi + '</p>';
                    if (d.tindakan) html += '<p><strong>Tindakan:</strong><br>' + d.tindakan + '</p>';
                    if (d.edukasi) html += '<p><strong>Edukasi:</strong><br>' + d.edukasi + '</p>';
                    html += '</div></div>';

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#ec4899;"><i class="fa fa-file-medical"></i> Detail Asesmen NEUROLOGI</span>',
                        html: html,
                        width: '900px',
                        confirmButtonText: '<i class="fa fa-times"></i> Tutup',
                        confirmButtonColor: '#ec4899'
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisNeurologiController/get_detail") ?>?no_rawat=' + noRawat)
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

                    const fields = ['no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpo', 'alergi',
                        'kesadaran', 'gcs', 'status', 'td', 'nadi', 'rr', 'suhu', 'bb', 'nyeri',
                        'kepala', 'keterangan_kepala', 'thoraks', 'keterangan_thoraks', 'abdomen', 'keterangan_abdomen',
                        'ekstremitas', 'keterangan_ekstremitas', 'columna', 'keterangan_columna', 'muskulos', 'keterangan_muskulos',
                        'lainnya', 'lab', 'rad', 'penunjanglain',
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
        window.open('<?= base_url("AwalMedisNeurologiController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
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
                fetch('<?= base_url("AwalMedisNeurologiController/delete") ?>', {
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
            const form = document.getElementById('formNEUROLOGIAssessment');
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
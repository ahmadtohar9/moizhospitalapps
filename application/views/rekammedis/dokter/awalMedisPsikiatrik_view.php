<!-- ASESMEN AWAL MEDIS PSIKIATRIK - MATCHING NEUROLOGI ARCHITECTURE -->
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
</style>

<div class="container-fluid">
    <form id="formPsikiatrikAssessment" autocomplete="off">
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
                    <input type="text" class="form-control" name="hubungan" placeholder="Contoh: Istri, Suami, Anak">
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
                    <label>Riwayat Penyakit Keluarga (RPK)</label>
                    <textarea class="form-control" name="rpk" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Penggunaan Obat (RPO)</label>
                    <textarea class="form-control" name="rpo" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Alergi</label>
                    <input type="text" class="form-control" name="alergi" placeholder="Obat / Makanan / Lainnya">
                </div>
            </div>
        </div>

        <!-- II. STATUS PSIKIATRIK -->
        <div class="section-header"><i class="fa fa-user-md"></i> II. STATUS PSIKIATRIK</div>
        <div class="row">
            <?php 
            $status_files = [
                'Penampilan'=>'penampilan', 'Pembicaraan'=>'pembicaraan', 'Psikomotor'=>'psikomotor', 
                'Sikap'=>'sikap', 'Mood/Afek'=>'mood', 'Fungsi Kognitif'=>'fungsi_kognitif', 
                'Gangguan Persepsi'=>'gangguan_persepsi', 'Proses Pikir'=>'proses_pikir', 
                'Pengendalian Impuls'=>'pengendalian_impuls', 'Tilikan'=>'tilikan', 'RTA'=>'rta'
            ];
            foreach($status_files as $label=>$name): ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" name="<?= $name ?>" maxlength="200">
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- III. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> III. PEMERIKSAAN FISIK</div>
        <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                    <label>Keadaan Umum</label>
                    <select class="form-control" name="keadaan">
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
                    <label>GCS</label>
                    <input type="text" class="form-control" name="gcs" placeholder="E4V5M6" maxlength="10">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kesadaran</label>
                    <select class="form-control" name="kesadaran">
                        <option value="">-- Pilih --</option>
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolen">Somnolen</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Koma">Koma</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"><div class="form-group"><label>TD (mmHg)</label><input type="text" class="form-control" name="td" maxlength="8"></div></div>
            <div class="col-md-2"><div class="form-group"><label>Nadi (x/mnt)</label><input type="text" class="form-control" name="nadi" maxlength="5"></div></div>
            <div class="col-md-2"><div class="form-group"><label>RR (x/mnt)</label><input type="text" class="form-control" name="rr" maxlength="5"></div></div>
            <div class="col-md-2"><div class="form-group"><label>Suhu (°C)</label><input type="text" class="form-control" name="suhu" maxlength="5"></div></div>
            <div class="col-md-2"><div class="form-group"><label>SpO2 (%)</label><input type="text" class="form-control" name="spo" maxlength="5"></div></div>
            <div class="col-md-1"><div class="form-group"><label>BB (kg)</label><input type="text" class="form-control" name="bb" maxlength="5"></div></div>
            <div class="col-md-1"><div class="form-group"><label>TB (cm)</label><input type="text" class="form-control" name="tb" maxlength="5"></div></div>
        </div>

        <!-- IV. PEMERIKSAAN SISTEMIK -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> IV. PEMERIKSAAN SISTEMIK</div>
        <div class="row">
            <?php 
            $organs = [
                'kepala'=>'Kepala', 'gigi'=>'Gigi & Mulut', 'tht'=>'THT', 'thoraks'=>'Thoraks', 
                'abdomen'=>'Abdomen', 'genital'=>'Genital', 'ekstremitas'=>'Ekstremitas', 'kulit'=>'Kulit'
            ];
            foreach($organs as $k=>$v): ?>
            <div class="col-md-3">
                 <div class="form-group">
                    <label><?= $v ?></label>
                    <select class="form-control" name="<?= $k ?>">
                        <option value="">-- Pilih --</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <label>Keterangan Fisik / Kelainan yang ditemukan</label>
            <textarea class="form-control" name="ket_fisik" rows="3"></textarea>
        </div>

        <!-- V. PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</div>
        <div class="form-group">
            <label>Hasil Pemeriksaan Penunjang (Lab, Rad, Psikotes, dll)</label>
            <textarea class="form-control" name="penunjang" rows="3"></textarea>
        </div>

        <!-- VI. DIAGNOSIS & TATALAKSANA -->
        <div class="section-header"><i class="fa fa-notes-medical"></i> VI. DIAGNOSIS & TATALAKSANA</div>
        <div class="form-group">
            <label>Diagnosis Utama <span class="text-danger">*</span></label>
            <textarea class="form-control" name="diagnosis" rows="2" required></textarea>
        </div>
        <div class="form-group">
            <label>Tatalaksana / Terapi</label>
            <textarea class="form-control" name="tata" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Konsul / Rujukan (Jika ada)</label>
            <textarea class="form-control" name="konsulrujuk" rows="2"></textarea>
        </div>

        <!-- BUTTON SAVE MATCHING NEUROLOGI -->
        <div style="text-align:right; margin:20px 0;">
            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan Asesmen</button>
        </div>
    </form>
</div>

<!-- HISTORY SECTION MATCHING NEUROLOGI -->
<div class="container-fluid" style="margin-top:30px;">
    <div class="section-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"><i class="fa fa-history"></i> RIWAYAT ASESMEN PSIKIATRIK</div>

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
            <button type="button" class="btn btn-primary" onclick="loadHistory()"><i class="fa fa-search"></i> Tampilkan</button>
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

    window.resetFormAndButton = function () {
        document.getElementById('formPsikiatrikAssessment').reset();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    document.getElementById('formPsikiatrikAssessment').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('<?= base_url("AwalMedisPsikiatrikController/save") ?>', {
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

    function loadHistory() {
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;
        const noRkm = '<?= $no_rkm_medis ?>';
        const container = document.getElementById('historyContainer');

        container.innerHTML = '<div style="text-align:center; padding:40px;"><i class="fa fa-spinner fa-spin" style="font-size:32px;"></i></div>';

        fetch('<?= base_url("AwalMedisPsikiatrikController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
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
        fetch('<?= base_url("AwalMedisPsikiatrikController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    const date = new Date(d.tanggal);
                    const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

                    let html = '<div style="text-align:left; max-height:600px; overflow-y:auto; padding:10px;">';
                    
                    // HEADER
                    html += '<div style="background:linear-gradient(135deg, #ec4899 0%, #db2777 100%); color:white; padding:15px; border-radius:8px; margin-bottom:20px;">';
                    html += '<h4 style="margin:0 0 10px 0;"><i class="fa fa-calendar"></i> ' + formattedDate + '</h4>';
                    html += '<p style="margin:0;"><i class="fa fa-user-md"></i> ' + (d.nm_dokter || 'Dokter') + '</p></div>';

                    // I. ANAMNESIS
                    html += '<div style="background:#fdf2f8; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899; font-weight:bold;">I. ANAMNESIS</h5>';
                    html += '<p><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p><strong>RPS:</strong><br>' + (d.rps || '-') + '</p>';
                    if (d.rpd) html += '<p><strong>RPD:</strong><br>' + d.rpd + '</p>';
                    if (d.rpk) html += '<p><strong>RPK:</strong><br>' + d.rpk + '</p>';
                    if (d.rpo) html += '<p><strong>RPO:</strong><br>' + d.rpo + '</p>';
                    if (d.alergi) html += '<p><strong>Alergi:</strong> ' + d.alergi + '</p>';
                    html += '</div>';

                    // II. STATUS PSIKIATRIK
                    html += '<div style="background:#f0f9ff; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #0ea5e9;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#0ea5e9; font-weight:bold;">II. STATUS PSIKIATRIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">';
                    const statusLabels = {
                        'penampilan':'Penampilan', 'pembicaraan':'Pembicaraan', 'psikomotor':'Psikomotor', 
                        'sikap':'Sikap', 'mood':'Mood/Afek', 'fungsi_kognitif':'Fungsi Kognitif', 
                        'gangguan_persepsi':'Gangguan Persepsi', 'proses_pikir':'Proses Pikir', 
                        'pengendalian_impuls':'Pengendalian Impuls', 'tilikan':'Tilikan', 'rta':'RTA'
                    };
                    for(let k in statusLabels) {
                        html += '<div><strong style="color:#555;">'+statusLabels[k]+':</strong><br>' + (d[k] || '-') + '</div>';
                    }
                    html += '</div></div>';

                    // III. PEMERIKSAAN FISIK
                    html += '<div style="background:#ecfdf5; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#10b981; font-weight:bold;">III. PEMERIKSAAN FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px;">';
                    html += '<p><strong>Keadaan:</strong> ' + (d.keadaan || '-') + '</p>';
                    html += '<p><strong>Kesadaran:</strong> ' + (d.kesadaran || '-') + '</p>';
                    html += '<p><strong>GCS:</strong> ' + (d.gcs || '-') + '</p>';
                    html += '<p><strong>TD:</strong> ' + (d.td || '-') + ' mmHg</p>';
                    html += '<p><strong>Nadi:</strong> ' + (d.nadi || '-') + ' x/mnt</p>';
                    html += '<p><strong>RR:</strong> ' + (d.rr || '-') + ' x/mnt</p>';
                    html += '<p><strong>Suhu:</strong> ' + (d.suhu || '-') + ' °C</p>';
                    html += '<p><strong>SpO2:</strong> ' + (d.spo || '-') + ' %</p>';
                    html += '<p><strong>BB:</strong> ' + (d.bb || '-') + ' kg</p>';
                    html += '<p><strong>TB:</strong> ' + (d.tb || '-') + ' cm</p>';
                    html += '</div></div>';

                    // IV. PEMERIKSAAN SISTEMIK
                    html += '<div style="background:#fffbeb; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#f59e0b; font-weight:bold;">IV. PEMERIKSAAN SISTEMIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">';
                    const organs = {
                        'kepala':'Kepala', 'gigi':'Gigi & Mulut', 'tht':'THT', 'thoraks':'Thoraks', 
                        'abdomen':'Abdomen', 'genital':'Genital', 'ekstremitas':'Ekstremitas', 'kulit':'Kulit'
                    };
                    for(let k in organs) {
                        if(d[k]) html += '<div><strong>'+organs[k]+':</strong> ' + d[k] + '</div>';
                    }
                    html += '</div>';
                    if(d.ket_fisik) {
                        html += '<div style="margin-top:10px; border-top:1px dashed #ccc; padding-top:10px;"><strong>Keterangan Fisik:</strong><br>'+d.ket_fisik+'</div>';
                    }
                    html += '</div>';

                    // V. PENUNJANG
                    if(d.penunjang) {
                        html += '<div style="background:#f0f9ff; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #6366f1;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#6366f1; font-weight:bold;">V. PENUNJANG</h5>';
                        html += '<p>' + d.penunjang + '</p>';
                        html += '</div>';
                    }

                    // VI. DIAGNOSIS & TATALAKSANA
                    html += '<div style="background:#fdf2f8; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#ec4899; font-weight:bold;">VI. DIAGNOSIS & TATALAKSANA</h5>';
                    html += '<p><strong>Diagnosis:</strong><br>' + (d.diagnosis || '-') + '</p>';
                    if(d.tata) html += '<p><strong>Tatalaksana/Terapi:</strong><br>' + d.tata + '</p>';
                    if(d.konsulrujuk) html += '<p><strong>Konsul/Rujuk:</strong><br>' + d.konsulrujuk + '</p>';
                    html += '</div>';

                    html += '</div>'; // End container

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#ec4899;">Detail Asesmen Psikiatrik</span>',
                        html: html,
                        width: '800px',
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-print"></i> Cetak PDF',
                        showCancelButton: true,
                        cancelButtonText: 'Tutup',
                        confirmButtonColor: '#ec4899'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            printSinglePDF(noRawat);
                        }
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisPsikiatrikController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    document.querySelector('[name="no_rawat"]').value = d.no_rawat; // Ensure no_rawat is set for update
                    
                    if (d.tanggal) {
                        const parts = d.tanggal.split(' ');
                        document.querySelector('[name="tanggal"]').value = parts[0];
                        document.querySelector('[name="jam"]').value = parts[1].substring(0,5);
                    }

                    const fields = [
                        'anamnesis', 'hubungan', 'keluhan_utama', 'rps', 'rpd', 'rpk', 'rpo', 'alergi',
                        'penampilan', 'pembicaraan', 'psikomotor', 'sikap', 'mood', 'fungsi_kognitif', 'gangguan_persepsi', 'proses_pikir',
                        'pengendalian_impuls', 'tilikan', 'rta',
                        'keadaan', 'gcs', 'kesadaran', 'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb',
                        'kepala', 'gigi', 'tht', 'thoraks', 'abdomen', 'genital', 'ekstremitas', 'kulit', 'ket_fisik',
                        'penunjang', 'diagnosis', 'tata', 'konsulrujuk'
                    ];
                    fields.forEach(f => {
                         const el = document.querySelector('[name="'+f+'"]');
                         if(el) el.value = d[f] || '';
                    });
                    toggleHubungan(d.anamnesis);
                    setEditMode();
                }
            });
    }

    function printSinglePDF(noRawat) {
        window.open('<?= base_url("AwalMedisPsikiatrikController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
    }

    function deleteAssessmentHistory(noRawat) {
        if(!confirm('Hapus data?')) return;
        fetch('<?= base_url("AwalMedisPsikiatrikController/delete") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'no_rawat=' + noRawat
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                loadHistory(); 
                resetFormAndButton();
            } else {
                alert(data.message);
            }
        });
    }

    // Auto load
    (function () {
        setTimeout(function() { loadHistory(); }, 500);
    })();
</script>
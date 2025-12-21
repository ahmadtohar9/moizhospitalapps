<!-- ASESMEN AWAL MEDIS REHAB MEDIK - ENHANCED VERSION -->
<style>
    .section-header {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        margin: 15px 0 10px 0;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
        color: #374151;
    }

    /* PAIN SCALE CUSTOM SLIDER */
    .pain-scale-container {
        background: #fdf2f8;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #fbcfe8;
    }

    .pain-slider {
        -webkit-appearance: none;
        width: 100%;
        height: 15px;
        border-radius: 10px;
        background: linear-gradient(to right, #22c55e 0%, #eab308 50%, #ef4444 100%);
        outline: none;
        opacity: 0.9;
        transition: opacity .2s;
        cursor: pointer;
    }

    .pain-slider:hover {
        opacity: 1;
    }

    .pain-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #fff;
        border: 4px solid #db2777;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .pain-faces {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 24px;
        padding: 0 5px;
    }

    .pain-value-display {
        font-size: 20px;
        font-weight: bold;
        color: #db2777;
        margin-top: 10px;
    }

    /* SYSTEMIC EXAM GRID */
    .exam-row {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .exam-label {
        font-weight: bold;
        width: 150px;
    }

    .exam-options {
        display: flex;
        gap: 15px;
        width: 300px;
    }

    .exam-note {
        flex-grow: 1;
    }

    /* THERAPY ROW */
    .therapy-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
    }
</style>

<div class="container-fluid">
    <form id="formRehabMedikAssessment" autocomplete="off">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat ?>">
        <input type="hidden" name="kd_dokter" value="<?= $kd_dokter ?>">

        <!-- HEADER INFO -->
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
                    <label>Jenis Anamnesis</label>
                    <select class="form-control" name="anamnesis" onchange="toggleHubungan(this.value)">
                        <option value="Autoanamnesis">Autoanamnesis</option>
                        <option value="Alloanamnesis">Alloanamnesis</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="hubunganContainer" style="display:none;">
                <div class="form-group">
                    <label>Hubungan</label>
                    <input type="text" class="form-control" name="hubungan" placeholder="Wali/Keluarga">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keluhan Utama</label>
            <textarea class="form-control" name="keluhan_utama" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label>Riwayat Penyakit Sekarang (RPS)</label>
            <textarea class="form-control" name="rps" rows="3"></textarea>
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
                    <label>Riwayat Alergi</label>
                    <input type="text" class="form-control" name="alergi">
                </div>
            </div>
        </div>

        <!-- II. TANDA VITAL & NYERI (THE PERFECT UI) -->
        <div class="section-header"><i class="fa fa-heartbeat"></i> II. TANDA VITAL & NYERI</div>

        <div class="row">
            <div class="col-md-8">
                <!-- Vitals Grid -->
                <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px; margin-bottom:15px;">
                    <div><label>TD (mmHg)</label><input type="text" class="form-control" name="td" placeholder="120/80">
                    </div>
                    <div><label>Nadi (x/mnt)</label><input type="text" class="form-control" name="nadi"
                            placeholder="80"></div>
                    <div><label>RR (x/mnt)</label><input type="text" class="form-control" name="rr" placeholder="20">
                    </div>

                    <div><label>Suhu (°C)</label><input type="text" class="form-control" name="suhu" placeholder="36.5">
                    </div>
                    <div><label>BB (kg)</label><input type="text" class="form-control" name="bb"></div>
                    <div><label>Kesadaran</label>
                        <select class="form-control" name="kesadaran">
                            <option value="Compos Mentis">Compos Mentis</option>
                            <option value="Apatis">Apatis</option>
                            <option value="Delirum">Delirum</option>
                        </select>
                    </div>
                    <div><label>Kategori Nyeri</label>
                        <select class="form-control" name="nyeri" id="inputNyeriKategori">
                            <option value="Tidak Nyeri">Tidak Nyeri</option>
                            <option value="Nyeri Sedang">Nyeri Sedang</option>
                            <option value="Nyeri Sangat Hebat">Nyeri Sangat Hebat</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- PAIN SCALE UI -->
            <div class="col-md-4">
                <div class="pain-scale-container">
                    <label style="margin-bottom:10px;">Skala Nyeri (VAS 0-10)</label>

                    <div class="pain-faces">
                        <span title="Tidak Nyeri">😁</span>
                        <span title="Ringan">🙂</span>
                        <span title="Sedang">😐</span>
                        <span title="Berat">😣</span>
                        <span title="Sangat Berat">😭</span>
                    </div>

                    <input type="range" min="0" max="10" value="0" class="pain-slider" id="painSlider"
                        oninput="updatePainLevel(this.value)">

                    <div class="pain-value-display">
                        Skala: <span id="painValueText">0</span> - <span id="painCategoryText"
                            style="font-weight:normal; font-size:16px;">Tidak Nyeri</span>
                    </div>

                    <!-- Hidden Inputs for Form Submission -->
                    <input type="hidden" name="skala_nyeri" id="inputSkalaNyeri" value="0">
                </div>
            </div>
        </div>

        <!-- III. PEMERIKSAAN SISTEMIK -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> III. PEMERIKSAAN SISTEMIK</div>

        <?php
        $systems = [
            'kepala' => 'Kepala',
            'thoraks' => 'Thoraks',
            'abdomen' => 'Abdomen',
            'ekstremitas' => 'Ekstremitas',
            'columna' => 'Columna',
            'muskulos' => 'Muskuloskeletal'
        ];
        foreach ($systems as $key => $label):
            ?>
            <div class="exam-row">
                <div class="exam-label"><?= $label ?></div>
                <div class="exam-options">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="<?= $key ?>_n" name="<?= $key ?>" value="Normal"
                            class="custom-control-input" checked>
                        <label class="custom-control-label" for="<?= $key ?>_n">Normal</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="<?= $key ?>_ab" name="<?= $key ?>" value="Abnormal"
                            class="custom-control-input">
                        <label class="custom-control-label" for="<?= $key ?>_ab">Abnormal</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="<?= $key ?>_tp" name="<?= $key ?>" value="Tidak Diperiksa"
                            class="custom-control-input">
                        <label class="custom-control-label" for="<?= $key ?>_tp">T.D</label>
                    </div>
                </div>
                <div class="exam-note">
                    <input type="text" class="form-control form-control-sm" name="keterangan_<?= $key ?>"
                        placeholder="Keterangan jika abnormal...">
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-group" style="margin-top:10px;">
            <label>Pemeriksaan Lainnya</label>
            <textarea class="form-control" name="lainnya" rows="2"></textarea>
        </div>

        <!-- IV. RISIKO & FUNGSIONAL -->
        <div class="section-header"><i class="fa fa-wheelchair"></i> IV. RISIKO & FUNGSIONAL</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Risiko Jatuh</label>
                    <select class="form-control" name="resiko_jatuh">
                        <option value="Tidak Berisiko">Tidak Berisiko</option>
                        <option value="Berisiko Sedang">Berisiko Sedang</option>
                        <option value="Berisiko Tinggi">Berisiko Tinggi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Risiko Nutrisional</label>
                    <select class="form-control" name="resiko_nutrisional">
                        <option value="Tidak Berisiko Malnutrisi">Tidak Berisiko</option>
                        <option value="Berisiko Malnutrisi">Berisiko</option>
                        <option value="Malnutrisi">Malnutrisi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kebutuhan Fungsional</label>
                    <select class="form-control" name="kebutuhan_fungsional">
                        <option value="Tidak Perlu Bantuan">Mandiri</option>
                        <option value="Perlu Bantuan">Perlu Bantuan</option>
                        <option value="Perlu Bantuan Total">Bantuan Total</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- V. DIAGNOSIS -->
        <div class="section-header"><i class="fa fa-user-md"></i> V. DIAGNOSIS</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosa Medis</label>
                    <textarea class="form-control" name="diagnosa_medis" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diagnosa Fungsi</label>
                    <textarea class="form-control" name="diagnosa_fungsi" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- VI. PROGRAM TERAPI -->
        <div class="section-header"><i class="fa fa-tasks"></i> VI. PROGRAM TERAPI</div>

        <div style="background:#f9fafb; padding:15px; border-radius:8px;">
            <div class="row">
                <!-- LEft Column: Specific Therapies (Action + Date) -->
                <div class="col-md-7" style="border-right:1px dashed #ccc;">
                    <h6
                        style="font-weight:bold; color:#06b6d4; margin-bottom:15px; border-bottom:2px solid #06b6d4; padding-bottom:5px;">
                        DAFTAR TERAPI & TANGGAL</h6>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Fisioterapi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="fisio" placeholder="Tindakan...">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="fisioterapi" title="Rencana Tanggal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Okupasi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="okupasi" placeholder="Okupasi...">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="terapi_okupasi" title="Rencana Tanggal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Wicara</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="wicara" placeholder="Wicara...">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="terapi_wicara" title="Rencana Tanggal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Akupuntur</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="akupuntur" placeholder="Akupuntur...">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="terapi_akupuntur" title="Rencana Tanggal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lainnya</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="tatalain" placeholder="Tata Laksana Lain...">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="terapi_lainnya" title="Rencana Tanggal">
                        </div>
                    </div>
                </div>

                <!-- Right Column: General Info -->
                <div class="col-md-5">
                    <h6
                        style="font-weight:bold; color:#06b6d4; margin-bottom:15px; border-bottom:2px solid #06b6d4; padding-bottom:5px;">
                        PLANNING UMUM</h6>

                    <div class="form-group">
                        <label>Penunjang Lain</label>
                        <textarea class="form-control" name="penunjang_lain" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Frekuensi Terapi</label>
                        <input type="text" class="form-control" name="frekuensi_terapi"
                            placeholder="Misal: 2x seminggu">
                    </div>

                    <div class="form-group">
                        <label>Edukasi Pasien/Keluarga</label>
                        <textarea class="form-control" name="edukasi" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align:right; margin-top:20px;">
            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan
                Asesmen</button>
        </div>
    </form>
</div>

<!-- HISTORY START -->
<div class="container-fluid" style="margin-top:30px;">
    <div class="section-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"><i
            class="fa fa-history"></i> RIWAYAT ASESMEN REHAB MEDIK</div>
    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-4"><label>Dari Tanggal</label><input type="date" id="filterStartDate" class="form-control"
                value="<?= date('Y-m-d') ?>"></div>
        <div class="col-md-4"><label>Sampai Tanggal</label><input type="date" id="filterEndDate" class="form-control"
                value="<?= date('Y-m-d') ?>"></div>
        <div class="col-md-4" style="padding-top:25px;"><button type="button" class="btn btn-primary"
                onclick="loadHistory()"><i class="fa fa-search"></i> Tampilkan</button></div>
    </div>
    <div id="historyContainer"></div>
</div>
<!-- HISTORY END -->

<script>
    function toggleHubungan(val) {
        const container = document.getElementById('hubunganContainer');
        if (container) {
            container.style.display = (val === 'Alloanamnesis') ? 'block' : 'none';
        }
    }

    // Init Logic
    document.addEventListener("DOMContentLoaded", function () {
        const anamnesis = document.querySelector('select[name="anamnesis"]');
        if (anamnesis) {
            toggleHubungan(anamnesis.value);
            anamnesis.addEventListener('change', function () {
                toggleHubungan(this.value);
            });
        }
    });

    // INTERACTIVE PAIN SLIDER LOGIC
    function updatePainLevel(val) {
        document.getElementById('painValueText').innerText = val;
        document.getElementById('inputSkalaNyeri').value = val;

        let cat = 'Tidak Nyeri';
        if (val >= 1 && val <= 3) cat = 'Nyeri Sedang';
        else if (val >= 4 && val <= 6) cat = 'Nyeri Sedang';
        else if (val >= 7) cat = 'Nyeri Sangat Hebat';

        if (val == 0) cat = 'Tidak Nyeri';

        document.getElementById('painCategoryText').innerText = cat;
        // Update both hidden and visual select if it matches
        const sel = document.getElementById('inputNyeriKategori');
        if (sel) sel.value = cat;
    }

    // Listen to select change to update slider if user manually changes category?
    // Not strictly required but good for UX. For now let's keep it simple (Slider controls dropdown).

    // HELPER FUNCTIONS
    window.resetFormAndButton = function () {
        document.getElementById('formRehabMedikAssessment').reset();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
        // Reset slider
        const slider = document.getElementById('painSlider');
        if (slider) { slider.value = 0; updatePainLevel(0); }
        // Default date/time to now
        const now = new Date();
        const dateStr = now.toISOString().split('T')[0];
        const timeStr = now.toTimeString().split(' ')[0].substring(0, 5);
        document.querySelector('[name="tanggal"]').value = dateStr;
        document.querySelector('[name="jam"]').value = timeStr;
    };

    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    function loadHistory() {
        const noRkm = '<?= $no_rkm_medis ?>';
        const start = document.getElementById('filterStartDate').value;
        const end = document.getElementById('filterEndDate').value;

        fetch('<?= base_url("AwalMedisRehabMedikController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + start + '&end_date=' + end)
            .then(r => r.json())
            .then(d => {
                const c = document.getElementById('historyContainer');
                if (d.status === 'success' && d.data.length > 0) {
                    let h = '<div style="display:grid; gap:10px;">';
                    d.data.forEach(i => {
                        const date = new Date(i.tanggal);
                        const fmtDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
                        h += `<div style="border:1px solid #ddd; padding:15px; border-radius:8px; background:white;">
                        <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                            <strong>${fmtDate} - ${i.nm_dokter}</strong>
                            <div style="display:flex; gap:5px;">
                                <button onclick="viewDetail('${i.no_rawat}')" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Lihat</button>
                                <button onclick="editAssessment('${i.no_rawat}')" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
                                <button onclick="deleteAssessmentHistory('${i.no_rawat}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                <button onclick="printSinglePDF('${i.no_rawat}')" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Cetak</button>
                            </div>
                        </div>
                        <p style="margin:5px 0 0 0;">Diagnosa Medis: ${i.diagnosa_medis || '-'}</p>
                    </div>`;
                    });
                    h += '</div>';
                    c.innerHTML = h;
                } else {
                    c.innerHTML = '<p class="text-center text-muted">Tidak ada riwayat.</p>';
                }
            });
    }

    function viewDetail(noRawat) {
        fetch('<?= base_url("AwalMedisRehabMedikController/get_detail") ?>?no_rawat=' + noRawat)
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    const dt = d.data;
                    const date = new Date(dt.tanggal);
                    const fmtDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

                    let html = '<div style="text-align:left; max-height:600px; overflow-y:auto; padding:10px;">';

                    // Header
                    html += `<div style="background:linear-gradient(135deg, #ec4899 0%, #db2777 100%); color:white; padding:15px; border-radius:8px; margin-bottom:15px;">
                        <h4 style="margin:0;"><i class="fa fa-calendar"></i> ${fmtDate}</h4>
                        <p style="margin:0;">${dt.nm_dokter || 'Dokter'}</p>
                    </div>`;

                    // I. Anamnesis
                    html += `<div style="background:#fdf2f8; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #ec4899;">
                        <h5 style="color:#ec4899; font-weight:bold;">I. ANAMNESIS (${dt.anamnesis})</h5>
                        ${dt.anamnesis === 'Alloanamnesis' ? `<p><strong>Hubungan:</strong> ${dt.hubungan || '-'}</p>` : ''}
                        <p><strong>Keluhan Utama:</strong> ${dt.keluhan_utama || '-'}</p>
                        <p><strong>RPS:</strong> ${dt.rps || '-'}</p>
                        <p><strong>RPD:</strong> ${dt.rpd || '-'}</p>
                        <p><strong>Alergi:</strong> ${dt.alergi || '-'}</p>
                    </div>`;

                    // II. Vitals
                    const painVal = dt.skala_nyeri || 0;
                    const painPct = (painVal / 10) * 100;

                    html += `<div style="background:#ecfdf5; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #10b981;">
                        <h5 style="color:#10b981; font-weight:bold;">II. TANDA VITAL</h5>
                        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:5px;">
                            <div><strong>TD:</strong> ${dt.td}</div>
                            <div><strong>Nadi:</strong> ${dt.nadi}</div>
                            <div><strong>RR:</strong> ${dt.rr}</div>
                            <div><strong>Suhu:</strong> ${dt.suhu}</div>
                            <div><strong>BB:</strong> ${dt.bb}</div>
                            <div><strong>Kesadaran:</strong> ${dt.kesadaran}</div>
                        </div>
                        <div style="margin-top:10px; border-top:1px dashed #ccc; padding-top:10px;">
                            <div style="font-weight:bold; color:#ef4444; margin-bottom:5px;">
                                Nyeri: Skala ${painVal} (${dt.nyeri})
                            </div>
                            <!-- Visual Pain Scale Bar -->
                            <div style="text-align:center; margin-bottom:5px;">
                                <img src="<?= base_url('assets/images/skala_nyeri.png') ?>" style="width:100%; max-width:400px; height:auto;" alt="Skala Nyeri">
                            </div>
                            <div style="position:relative; width:100%; height:20px; background:linear-gradient(to right, #4caf50, #ffeb3b, #f44336); border-radius:10px; border:1px solid #ccc;">
                                <div style="position:absolute; left:${painPct}%; top:-5px; transform:translateX(-50%); width:30px; height:30px; background:white; border:2px solid #333; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold; box-shadow:0 2px 5px rgba(0,0,0,0.3);">
                                    ${painVal}
                                </div>
                            </div>
                            <div style="display:flex; justify-content:space-between; font-size:10px; margin-top:5px; color:#666;">
                                <span>0 (Tidak)</span>
                                <span>5 (Sedang)</span>
                                <span>10 (Berat)</span>
                            </div>
                        </div>
                    </div>`;

                    // III. Systemic
                    html += `<div style="background:#fffbeb; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #f59e0b;">
                        <h5 style="color:#f59e0b; font-weight:bold;">III. PEMERIKSAAN SISTEMIK</h5>
                        <ul style="padding-left:20px; margin:0;">
                            <li><strong>Kepala:</strong> ${dt.kepala} ${dt.keterangan_kepala ? '<i>(' + dt.keterangan_kepala + ')</i>' : ''}</li>
                            <li><strong>Thoraks:</strong> ${dt.thoraks} ${dt.keterangan_thoraks ? '<i>(' + dt.keterangan_thoraks + ')</i>' : ''}</li>
                            <li><strong>Abdomen:</strong> ${dt.abdomen} ${dt.keterangan_abdomen ? '<i>(' + dt.keterangan_abdomen + ')</i>' : ''}</li>
                            <li><strong>Ekstremitas:</strong> ${dt.ekstremitas} ${dt.keterangan_ekstremitas ? '<i>(' + dt.keterangan_ekstremitas + ')</i>' : ''}</li>
                            <li><strong>Columna:</strong> ${dt.columna} ${dt.keterangan_columna ? '<i>(' + dt.keterangan_columna + ')</i>' : ''}</li>
                            <li><strong>Muskulos:</strong> ${dt.muskulos} ${dt.keterangan_muskulos ? '<i>(' + dt.keterangan_muskulos + ')</i>' : ''}</li>
                        </ul>
                         ${dt.lainnya ? `<p><strong>Pemeriksaan Lainnya:</strong><br>${dt.lainnya}</p>` : ''}
                    </div>`;

                    // IV. RISIKO & FUNGSIONAL
                    html += `<div style="background:#eef2ff; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #6366f1;">
                         <h5 style="color:#6366f1; font-weight:bold;">IV. RISIKO & FUNGSIONAL</h5>
                         <p><strong>Risiko Jatuh:</strong> ${dt.resiko_jatuh || '-'}</p>
                         <p><strong>Risiko Nutrisional:</strong> ${dt.resiko_nutrisional || '-'}</p>
                         <p><strong>Kebutuhan Fungsional:</strong> ${dt.kebutuhan_fungsional || '-'}</p>
                    </div>`;

                    // V. Diagnosis
                    html += `<div style="background:#f3f4f6; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #4b5563;">
                         <h5 style="color:#4b5563; font-weight:bold;">V. DIAGNOSIS</h5>
                         <p><strong>Diagnosa Medis:</strong> ${dt.diagnosa_medis || '-'}</p>
                         <p><strong>Diagnosa Fungsi:</strong> ${dt.diagnosa_fungsi || '-'}</p>
                    </div>`;

                    // VI. PROGRAM TERAPI
                    html += `<div style="background:#f0f9ff; padding:10px; border-radius:8px; margin-bottom:10px; border-left:4px solid #06b6d4;">
                         <h5 style="color:#06b6d4; font-weight:bold;">VI. PROGRAM TERAPI</h5>
                         
                         ${dt.penunjang_lain ? `<p><strong>Penunjang Lain:</strong> ${dt.penunjang_lain}</p>` : ''}
                         
                         <table class="table table-sm table-bordered" style="margin-top:5px; background:white;">
                            <thead style="background:#e0f2fe;"><tr><th>Terapi</th><th>Tindakan / Ket</th><th>Rencana Tgl</th></tr></thead>
                            <tbody>
                                <tr><td>Fisioterapi</td><td>${dt.fisio || '-'}</td><td>${dt.fisioterapi}</td></tr>
                                <tr><td>Terapi Okupasi</td><td>${dt.okupasi || '-'}</td><td>${dt.terapi_okupasi}</td></tr>
                                <tr><td>Terapi Wicara</td><td>${dt.wicara || '-'}</td><td>${dt.terapi_wicara}</td></tr>
                                <tr><td>Akupuntur</td><td>${dt.akupuntur || '-'}</td><td>${dt.terapi_akupuntur}</td></tr>
                                <tr><td>Tata Laksana Lain</td><td>${dt.tatalain || '-'}</td><td>${dt.terapi_lainnya}</td></tr>
                            </tbody>
                         </table>
                         
                         <p><strong>Frekuensi Terapi:</strong> ${dt.frekuensi_terapi || '-'}</p>
                         ${dt.edukasi ? `<div style="border:1px dashed #06b6d4; padding:5px; margin-top:5px; background:#fff;"><b>Edukasi:</b><br>${dt.edukasi}</div>` : ''}
                    </div>`;

                    html += '</div>';

                    Swal.fire({
                        title: '',
                        html: html,
                        width: '850px',
                        showCloseButton: true,
                        confirmButtonText: '<i class="fa fa-print"></i> Cetak PDF',
                        showCancelButton: true,
                        cancelButtonText: 'Tutup',
                        confirmButtonColor: '#ec4899'
                    }).then((r) => {
                        if (r.isConfirmed) printSinglePDF(noRawat);
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisRehabMedikController/get_detail") ?>?no_rawat=' + noRawat)
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    const data = d.data;
                    const form = document.getElementById('formRehabMedikAssessment');

                    // Parse Date/Time
                    if (data.tanggal) {
                        const parts = data.tanggal.split(' ');
                        if (parts.length >= 2) {
                            form.querySelector('[name="tanggal"]').value = parts[0];
                            form.querySelector('[name="jam"]').value = parts[1].substring(0, 5);
                        }
                    }

                    // Populate Fields
                    for (let k in data) {
                        if (k === 'tanggal') continue; // Skip date, handled manually above
                        if (form.elements[k]) {
                            if (form.elements[k].type === 'radio') {
                                const rads = document.getElementsByName(k);
                                rads.forEach(r => {
                                    if (r.value === data[k]) r.checked = true;
                                });
                            } else {
                                form.elements[k].value = data[k];
                            }
                        }
                    }

                    // Manual Scale Update
                    if (data.skala_nyeri !== undefined) {
                        document.getElementById('painSlider').value = data.skala_nyeri;
                        updatePainLevel(data.skala_nyeri);
                    }

                    // Trigger visibility
                    if (data.anamnesis) toggleHubungan(data.anamnesis);

                    setEditMode();

                    Swal.fire({ icon: 'success', title: 'Mode Edit', text: 'Silakan edit data', timer: 3000, showConfirmButton: false });
                }
            });
    }

    function printSinglePDF(noRawat) {
        window.open('<?= base_url("AwalMedisRehabMedikController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
    }

    function deleteAssessmentHistory(noRawat) {
        if (!confirm('Hapus data ini?')) return;
        fetch('<?= base_url("AwalMedisRehabMedikController/delete") ?>', {
            method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'no_rawat=' + noRawat
        }).then(r => r.json()).then(d => {
            Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Data berhasil dihapus', timer: 3000, showConfirmButton: false });
            loadHistory();
            resetFormAndButton();
        });
    }

    document.getElementById('formRehabMedikAssessment').addEventListener('submit', function (e) {
        e.preventDefault();

        // Validation based on Screenshot (Anamnesis & Vitals)
        const requiredFields = [
            { name: 'keluhan_utama', label: 'Keluhan Utama' },
            { name: 'rps', label: 'Riwayat Penyakit Sekarang' },
            { name: 'rpd', label: 'Riwayat Penyakit Dahulu' },
            { name: 'td', label: 'Tekanan Darah' },
            { name: 'nadi', label: 'Nadi' },
            { name: 'rr', label: 'Respirasi (RR)' },
            { name: 'suhu', label: 'Suhu' },
            { name: 'bb', label: 'Berat Badan' }
        ];

        for (let field of requiredFields) {
            const el = this.querySelector(`[name="${field.name}"]`);
            if (!el || !el.value.trim()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: `Mohon isi kolom ${field.label} terlebih dahulu!`
                });
                // Focus on the empty field
                if (el) {
                    el.focus();
                    el.scrollIntoView({ behavior: "smooth", block: "center" });
                }
                return; // Stop submission
            }
        }

        fetch('<?= base_url("AwalMedisRehabMedikController/save") ?>', {
            method: 'POST', body: new FormData(this)
        }).then(r => r.json()).then(d => {
            if (d.status === 'success') {
                Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Data disimpan', timer: 3000, showConfirmButton: false });
                resetFormAndButton();
                loadHistory();
            } else {
                Swal.fire('Gagal', d.message, 'error');
            }
        });
    });

    // Auto load
    loadHistory();
</script>
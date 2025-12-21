<!-- ASESMEN AWAL MEDIS GAWAT DARURAT PSIKIATRI -->
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

    .subsection-title {
        font-weight: bold;
        color: #db2777;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-top: 15px;
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid">
    <form id="formGdPsikiatri" autocomplete="off">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat ?>">
        <input type="hidden" name="kd_dokter" value="<?= $kd_dokter ?>">

        <!-- TANGGAL & JAM -->
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
                        <option value="Autoanamnesis">Autoanamnesis</option>
                        <option value="Alloanamnesis">Alloanamnesis</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="hubunganContainer" style="display:none;">
                <div class="form-group">
                    <label>Hubungan dengan Pasien</label>
                    <input type="text" class="form-control" name="hubungan" placeholder="Contoh: Suami, Istri, Anak">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keluhan Utama <span class="text-danger">*</span></label>
            <textarea class="form-control" name="keluhan_utama" rows="2" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gejala Menyertai</label>
                    <textarea class="form-control" name="gejala_menyertai" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Faktor Pencetus</label>
                    <textarea class="form-control" name="faktor_pencetus" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- RIWAYAT DETAIL -->
        <div class="subsection-title">Riwayat & Faktor</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Penyakit Dahulu</label>
                    <select class="form-control mb-1" name="riwayat_penyakit_dahulu">
                        <option value="">-- Pilih --</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_riwayat_penyakit_dahulu"
                        placeholder="Keterangan RPD...">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Riwayat Kehamilan</label>
                    <input type="text" class="form-control" name="riwayat_kehamilan">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Sosial</label>
                    <select class="form-control mb-1" name="riwayat_sosial">
                        <option value="">-- Pilih --</option>
                        <option value="Bergaul">Bergaul</option>
                        <option value="Tidak Bergaul">Tidak Bergaul</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_riwayat_sosial" placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Pekerjaan</label>
                    <select class="form-control mb-1" name="riwayat_pekerjaan">
                        <option value="">-- Pilih --</option>
                        <option value="Bekerja">Bekerja</option>
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                        <option value="Ganti-gantian Pekerjaan">Ganti-gantian</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_riwayat_pekerjaan" placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Riwayat Obat Diminum</label>
                    <textarea class="form-control" name="riwayat_obat_diminum" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kepribadian Premorbid</label>
                    <input type="text" class="form-control" name="faktor_kepribadian_premorbid">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Faktor Keturunan</label>
                    <select class="form-control mb-1" name="faktor_keturunan">
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_faktor_keturunan"
                        placeholder="Keterangan...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Faktor Organik</label>
                    <select class="form-control mb-1" name="faktor_organik">
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_faktor_organik"
                        placeholder="Keterangan...">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Riwayat Alergi</label>
            <input type="text" class="form-control" name="riwayat_alergi">
        </div>

        <!-- II. PEMERIKSAAN FISIK -->
        <div class="section-header"><i class="fa fa-stethoscope"></i> II. PEMERIKSAAN FISIK</div>

        <!-- Tanda Vital -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Kesadaran</label>
                    <select class="form-control" name="fisik_kesadaran">
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolen">Somnolen</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Koma">Koma</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>GCS (E,V,M)</label>
                    <input type="text" class="form-control" name="fisik_gcs" placeholder="Ex: 4,5,6">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nyeri</label>
                    <select class="form-control" name="fisik_nyeri">
                        <option value="Tidak Nyeri">Tidak Nyeri</option>
                        <option value="Nyeri Ringan">Nyeri Ringan</option>
                        <option value="Nyeri Sedang">Nyeri Sedang</option>
                        <option value="Nyeri Berat">Nyeri Berat</option>
                        <option value="Nyeri Sangat Berat">Nyeri Sangat Berat</option>
                        <option value="Nyeri Tak Tertahankan">Tak Tertahankan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>TD (mmHg)</label>
                    <input type="text" class="form-control" name="fisik_td">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Nadi (x/mnt)</label>
                    <input type="text" class="form-control" name="fisik_nadi">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>RR (x/mnt)</label>
                    <input type="text" class="form-control" name="fisik_rr">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Suhu (°C)</label>
                    <input type="text" class="form-control" name="fisik_suhu">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>BB (Kg)</label>
                    <input type="text" class="form-control" name="fisik_bb">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>TB (cm)</label>
                    <input type="text" class="form-control" name="fisik_tb">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Status Nutrisi</label>
            <input type="text" class="form-control" name="fisik_status_nutrisi" placeholder="Keterangan Nutrisi...">
        </div>

        <!-- Status Kelainan (Head to Toe) -->
        <div class="subsection-title">Pemeriksaan Head To Toe</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kepala</label>
                    <select class="form-control mb-1" name="status_kelainan_kepala">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_status_kelainan_kepala"
                        placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Leher</label>
                    <select class="form-control mb-1" name="status_kelainan_leher">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_status_kelainan_leher"
                        placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Dada</label>
                    <select class="form-control mb-1" name="status_kelainan_dada">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_status_kelainan_dada" placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Perut</label>
                    <select class="form-control mb-1" name="status_kelainan_perut">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_status_kelainan_perut"
                        placeholder="Ket...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Anggota Gerak</label>
                    <select class="form-control mb-1" name="status_kelainan_anggota_gerak">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_status_kelainan_anggota_gerak"
                        placeholder="Ket...">
                </div>
            </div>
        </div>

        <!-- III. STATUS LOKALISATA -->
        <div class="section-header"><i class="fa fa-child"></i> III. STATUS LOKALISATA</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gambar Lokalis</label>
                    <div class="canvas-wrapper">
                        <div style="margin-bottom:5px;">
                            <button type="button" class="btn btn-xs btn-danger"
                                onclick="setDrawColor('red')">Merah</button>
                            <button type="button" class="btn btn-xs btn-primary"
                                onclick="setDrawColor('blue')">Biru</button>
                            <button type="button" class="btn btn-xs btn-dark"
                                onclick="setDrawColor('black')">Hitam</button>
                            <button type="button" class="btn btn-xs btn-warning" onclick="clearCanvas()">Reset</button>
                        </div>
                        <canvas id="lokalisCanvas" width="500" height="600"></canvas>
                        <input type="hidden" name="lokalis_image" id="lokalisImage">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Keterangan Lokalisata</label>
                    <textarea class="form-control" name="status_lokalisata" rows="20"
                        placeholder="Deskripsi lokalisata..."></textarea>
                </div>
            </div>
        </div>

        <!-- IV. STATUS PSIKIATRIK -->
        <div class="section-header"><i class="fa fa-brain"></i> IV. STATUS PSIKIATRIK</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kesan Umum</label>
                    <input type="text" class="form-control" name="psikiatrik_kesan_umum">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sikap & Prilaku</label>
                    <input type="text" class="form-control" name="psikiatrik_sikap_prilaku">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kesadaran (Psikiatrik)</label>
                    <input type="text" class="form-control" name="psikiatrik_kesadaran">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Orientasi</label>
                    <input type="text" class="form-control" name="psikiatrik_orientasi">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Daya Ingat</label>
                    <input type="text" class="form-control" name="psikiatrik_daya_ingat">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Persepsi</label>
                    <input type="text" class="form-control" name="psikiatrik_persepsi">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pikiran</label>
                    <input type="text" class="form-control" name="psikiatrik_pikiran">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Insight</label>
                    <input type="text" class="form-control" name="psikiatrik_insight">
                </div>
            </div>
        </div>

        <!-- V. PENUNJANG -->
        <div class="section-header"><i class="fa fa-flask"></i> V. PEMERIKSAAN PENUNJANG</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group"><label>Laboratorium</label><textarea class="form-control" name="laborat"
                        rows="2"></textarea></div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label>Radiologi</label><textarea class="form-control" name="radiologi"
                        rows="2"></textarea></div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label>EKG</label><textarea class="form-control" name="ekg" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- VI. DIAGNOSIS & TERAPI -->
        <div class="section-header"><i class="fa fa-user-md"></i> VI. DIAGNOSIS & TERAPI</div>
        <div class="form-group">
            <label>Diagnosis</label>
            <textarea class="form-control" name="diagnosis" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label>Permasalahan</label>
            <textarea class="form-control" name="permasalahan" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label>Instruksi Medis/Terapi</label>
            <textarea class="form-control" name="instruksi_medis" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Rencana/Target</label>
            <textarea class="form-control" name="rencana_target" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label>Edukasi</label>
            <textarea class="form-control" name="edukasi" rows="2"></textarea>
        </div>

        <!-- VII. RENCANA PULANG -->
        <div class="section-header"><i class="fa fa-home"></i> VII. KELUAR IGD (DISCHARGE PLANNING)</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Pulang/Keluar</label>
                    <select class="form-control mb-1" name="pulang_dipulangkan">
                        <option value="-">-</option>
                        <option value="Tidak Perlu Kontrol">Tidak Perlu Kontrol</option>
                        <option value="Kontrol/Berobat Jalan">Kontrol/Berobat Jalan</option>
                        <option value="Rawat Inap">Rawat Inap</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_pulang_dipulangkan"
                        placeholder="Keterangan...">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pulang Paksa</label>
                    <select class="form-control mb-1" name="pulang_paksa">
                        <option value="-">-</option>
                        <option value="Masalah Biaya">Masalah Biaya</option>
                        <option value="Kondisi Pasien">Kondisi Pasien</option>
                        <option value="Masalah Lokasi Rumah">Masalah Lokasi Rumah</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                    <input type="text" class="form-control" name="keterangan_pulang_paksa" placeholder="Keterangan...">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Dirawat di Ruang</label>
                    <input type="text" class="form-control" name="pulang_dirawat_diruang">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Indikasi Ranap</label>
                    <input type="text" class="form-control" name="pulang_indikasi_ranap">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Dirujuk Ke</label>
                    <input type="text" class="form-control mb-1" name="pulang_dirujuk_ke" placeholder="RS Tujuan...">
                    <select class="form-control" name="pulang_alasan_dirujuk">
                        <option value="-">-</option>
                        <option value="Tempat Penuh">Tempat Penuh</option>
                        <option value="Perlu Fasilitas Lebih">Perlu Fasilitas Lebih</option>
                        <option value="Permintaan Pasien/Keluarga">Permintaan Pasien/Keluarga</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Meninggal di IGD</label>
                    <select class="form-control mb-1" name="pulang_meninggal_igd">
                        <option value="-">-</option>
                        <option value="<= 2 Jam">
                            <= 2 Jam</option>
                        <option value="> 2 Jam">> 2 Jam</option>
                    </select>
                    <input type="text" class="form-control" name="pulang_penyebab_kematian"
                        placeholder="Penyebab Kematian...">
                </div>
            </div>
        </div>

        <div class="subsection-title">Kondisi Saat Pulang</div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group"><label>Kesadaran</label>
                    <select class="form-control" name="fisik_pulang_kesadaran">
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolen">Somnolen</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Koma">Koma</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group"><label>GCS</label><input type="text" class="form-control"
                        name="fisik_pulang_gcs"></div>
            </div>
            <div class="col-md-2">
                <div class="form-group"><label>TD</label><input type="text" class="form-control" name="fisik_pulang_td">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group"><label>Nadi</label><input type="text" class="form-control"
                        name="fisik_pulang_nadi"></div>
            </div>
            <div class="col-md-2">
                <div class="form-group"><label>Suhu</label><input type="text" class="form-control"
                        name="fisik_pulang_suhu"></div>
            </div>
            <div class="col-md-2">
                <div class="form-group"><label>RR</label><input type="text" class="form-control" name="fisik_pulang_rr">
                </div>
            </div>
        </div>

        <div style="text-align:right; margin:20px 0;">
            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan
                Asesmen</button>
        </div>
    </form>
</div>

<!-- HISTORY START -->
<div class="container-fluid" style="margin-top:30px;">
    <div class="section-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"><i
            class="fa fa-history"></i> RIWAYAT ASESMEN IGD PSIKIATRI</div>

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
<!-- HISTORY END -->

<script>
    function toggleHubungan(value) {
        document.getElementById('hubunganContainer').style.display = value === 'Alloanamnesis' ? 'block' : 'none';
    }
    
    // Canvas Init
    var canvas, ctx, isDrawing = false, currentColor = 'red', lastX = 0, lastY = 0;
    var backgroundURL = '<?= base_url("assets/images/status_lokalis_igd_psikiatri.png") ?>';

    setTimeout(function () {
        canvas = document.getElementById('lokalisCanvas');
        if (!canvas) return;
        ctx = canvas.getContext('2d');
        var img = new Image();
        img.onload = function () { ctx.drawImage(img, 0, 0, canvas.width, canvas.height); };
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
            ctx.beginPath(); ctx.strokeStyle = currentColor; ctx.lineWidth = 3; ctx.lineCap = 'round';
            ctx.moveTo(lastX, lastY); ctx.lineTo(x, y); ctx.stroke();
            lastX = x; lastY = y;
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

    // Helper function to reset form
    window.resetFormAndButton = function () {
        document.getElementById('formGdPsikiatri').reset();
        if (typeof clearCanvas === 'function') clearCanvas();
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-save"></i> Simpan Asesmen';
    };

    window.setEditMode = function () {
        document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-edit"></i> Update Asesmen';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Submit Handler
    document.getElementById('formGdPsikiatri').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('<?= base_url("AwalMedisGawatDaruratPsikiatriController/save") ?>', {
            method: 'POST', body: formData
        }).then(res => res.json()).then(data => {
            if (data.status === 'success') {
                Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message, timer: 2000, showConfirmButton: false });
                resetFormAndButton();
                setTimeout(() => loadHistory(), 500);
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
            }
        });
    });

    // Load History
    function loadHistory() {
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;
        const noRkm = '<?= $no_rkm_medis ?>';
        const container = document.getElementById('historyContainer');
        container.innerHTML = '<div style="text-align:center; padding:40px;"><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
        
        fetch('<?= base_url("AwalMedisGawatDaruratPsikiatriController/get_history") ?>?no_rkm_medis=' + noRkm + '&start_date=' + startDate + '&end_date=' + endDate)
            .then(res => res.json())
            .then(data => {
                let html = '';
                if(data.status === 'success' && data.data.length > 0) {
                     html += '<div style="display:grid; gap:15px;">';
                     data.data.forEach(item => {
                        const date = new Date(item.tanggal).toLocaleString('id-ID');
                        html += '<div style="background:white; border:1px solid #ddd; padding:15px; border-radius:8px;">';
                        html += '<div style="display:flex; justify-content:space-between; margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:5px;">';
                        html += '<strong>' + date + '</strong>';
                        html += '<div><button class="btn btn-sm btn-info" onclick="viewDetail(\''+item.no_rawat+'\')">Lihat</button> ';
                        html += '<button class="btn btn-sm btn-warning" onclick="editAssessment(\''+item.no_rawat+'\')">Edit</button> ';
                        html += '<button class="btn btn-sm btn-success" onclick="printSinglePDF(\''+item.no_rawat+'\')">Cetak</button> ';
                        html += '<button class="btn btn-sm btn-danger" onclick="deleteAssessmentHistory(\''+item.no_rawat+'\')">Hapus</button></div>';
                        html += '</div>';
                        html += '<div>Diagnosis: ' + (item.diagnosis || '-') + '</div>';
                        html += '</div>';
                     });
                     html += '</div>';
                } else {
                    html = '<div style="text-align:center; padding:20px;">Tidak ada data</div>';
                }
                container.innerHTML = html;
            });
    }

    function viewDetail(noRawat) {
        fetch('<?= base_url("AwalMedisGawatDaruratPsikiatriController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    const date = new Date(d.tanggal);
                    const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });

                    let html = '<div style="text-align:left; max-height:600px; overflow-y:auto; padding:10px;">';
                    
                    // Header Card
                    html += '<div style="background:linear-gradient(135deg, #ec4899 0%, #db2777 100%); color:white; padding:15px; border-radius:8px; margin-bottom:20px;">';
                    html += '<h4 style="margin:0 0 10px 0;"><i class="fa fa-calendar"></i> ' + formattedDate + '</h4>';
                    html += '<p style="margin:0;"><i class="fa fa-user-md"></i> ' + (d.nm_dokter || 'Dokter') + '</p></div>';

                    // Grid Layout
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">';

                    // --- COL 1 ---
                    html += '<div>';
                    
                    // I. ANAMNESIS
                    html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ec4899;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#db2777; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-clipboard"></i> I. ANAMNESIS (' + (d.anamnesis||'-') + ')</h5>';
                    if (d.hubungan) html += '<p style="font-size:11px;"><strong>Hubungan:</strong> ' + d.hubungan + '</p>';
                    html += '<p style="font-size:11px;"><strong>Keluhan Utama:</strong><br>' + (d.keluhan_utama || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Gejala Menyertai:</strong><br>' + (d.gejala_menyertai || '-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Faktor Pencetus:</strong><br>' + (d.faktor_pencetus || '-') + '</p>';
                    
                    html += '<div style="background:#f9f9f9; padding:10px; border-radius:5px; margin-top:10px;">';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Riw. Penyakit Dahulu:</strong> ' + (d.riwayat_penyakit_dahulu||'-') + ' (' + (d.keterangan_riwayat_penyakit_dahulu||'-') + ')</p>';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Riw. Sosial:</strong> ' + (d.riwayat_sosial||'-') + ' (' + (d.keterangan_riwayat_sosial||'-') + ')</p>';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Riw. Pekerjaan:</strong> ' + (d.riwayat_pekerjaan||'-') + ' (' + (d.keterangan_riwayat_pekerjaan||'-') + ')</p>';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Obat Diminum:</strong> ' + (d.riwayat_obat_diminum||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Kepribadian Premorbid:</strong> ' + (d.faktor_kepribadian_premorbid||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:2px;"><strong>Faktor Keturunan:</strong> ' + (d.faktor_keturunan||'-') + ' (' + (d.keterangan_faktor_keturunan||'-') + ')</p>';
                    html += '<p style="font-size:11px;"><strong>Alergi:</strong> ' + (d.riwayat_alergi||'-') + '</p>';
                    html += '</div>';
                    html += '</div>';

                    // II. FISIK
                    html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #10b981;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#059669; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-stethoscope"></i> II. FISIK</h5>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:5px; margin-bottom:10px;">';
                    html += '<p style="font-size:11px;"><strong>TD:</strong> ' + (d.fisik_td||'-') + ' mmHg</p>';
                    html += '<p style="font-size:11px;"><strong>Nadi:</strong> ' + (d.fisik_nadi||'-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>RR:</strong> ' + (d.fisik_rr||'-') + ' x/mnt</p>';
                    html += '<p style="font-size:11px;"><strong>Suhu:</strong> ' + (d.fisik_suhu||'-') + ' °C</p>';
                    html += '<p style="font-size:11px;"><strong>Kesadaran:</strong> ' + (d.fisik_kesadaran||'-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>GCS:</strong> ' + (d.fisik_gcs||'-') + '</p>';
                    html += '</div>';
                    html += '<p style="font-size:11px;"><strong>Head To Toe:</strong></p>';
                    html += '<ul style="font-size:11px; padding-left:20px; margin:0;">';
                    html += '<li>Kepala: ' + (d.status_kelainan_kepala||'-') + ' ' + (d.keterangan_status_kelainan_kepala ? '('+d.keterangan_status_kelainan_kepala+')' : '') + '</li>';
                    html += '<li>Leher: ' + (d.status_kelainan_leher||'-') + ' ' + (d.keterangan_status_kelainan_leher ? '('+d.keterangan_status_kelainan_leher+')' : '') + '</li>';
                    html += '<li>Dada: ' + (d.status_kelainan_dada||'-') + ' ' + (d.keterangan_status_kelainan_dada ? '('+d.keterangan_status_kelainan_dada+')' : '') + '</li>';
                    html += '<li>Perut: ' + (d.status_kelainan_perut||'-') + ' ' + (d.keterangan_status_kelainan_perut ? '('+d.keterangan_status_kelainan_perut+')' : '') + '</li>';
                    html += '<li>Gerak: ' + (d.status_kelainan_anggota_gerak||'-') + ' ' + (d.keterangan_status_kelainan_anggota_gerak ? '('+d.keterangan_status_kelainan_anggota_gerak+')' : '') + '</li>';
                    html += '</ul>';
                    html += '</div>';
                    
                    html += '</div>'; // End Col 1

                    // --- COL 2 ---
                    html += '<div>';
                    
                    // III. STATUS LOKALISATA
                    if(d.status_lokalisata || d.lokalis_image) {
                        html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #ef4444;">';
                        html += '<h5 style="margin:0 0 10px 0; color:#dc2626; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-child"></i> III. LOKALISATA</h5>';
                         if(d.status_lokalisata) html += '<p style="font-size:11px;">' + d.status_lokalisata + '</p>';
                         var imgUrl = '<?= base_url("assets/images/lokalis_igd_psikiatri/lokalis_") ?>' + d.no_rawat.replace(/\//g, '') + '.png';
                         html += '<img src="' + imgUrl + '" style="width:100%; border:1px solid #ccc; border-radius:4px;" onerror="this.style.display=\'none\'">';
                        html += '</div>';
                    }

                    // IV. STATUS PSIKIATRIK
                    html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #8b5cf6;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#7c3aed; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-brain"></i> IV. PSIKIATRIK</h5>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Kesan Umum:</strong> ' + (d.psikiatrik_kesan_umum||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Sikap & Prilaku:</strong> ' + (d.psikiatrik_sikap_prilaku||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Kesadaran:</strong> ' + (d.psikiatrik_kesadaran||'-') + '</p>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:5px;">';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Orientasi:</strong> ' + (d.psikiatrik_orientasi||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Daya Ingat:</strong> ' + (d.psikiatrik_daya_ingat||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Persepsi:</strong> ' + (d.psikiatrik_persepsi||'-') + '</p>';
                    html += '<p style="font-size:11px; margin-bottom:3px;"><strong>Pikiran:</strong> ' + (d.psikiatrik_pikiran||'-') + '</p>';
                    html += '</div>';
                    html += '<p style="font-size:11px; margin-top:3px;"><strong>Insight:</strong> ' + (d.psikiatrik_insight||'-') + '</p>';
                    html += '</div>';

                    // V. DIAGNOSIS
                    html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #f59e0b;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#d97706; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-user-md"></i> V. DIAGNOSIS & TERAPI</h5>';
                    html += '<p style="font-size:11px; font-weight:bold;">Diagnosis:</p><p style="font-size:11px; margin-bottom:8px;">' + (d.diagnosis||'-') + '</p>';
                    html += '<p style="font-size:11px; font-weight:bold;">Permasalahan:</p><p style="font-size:11px; margin-bottom:8px;">' + (d.permasalahan||'-') + '</p>';
                    html += '<p style="font-size:11px; font-weight:bold;">Terapi:</p><p style="font-size:11px;">' + (d.instruksi_medis||'-') + '</p>';
                    html += '</div>';

                    html += '</div>'; // End Col 2
                    html += '</div>'; // End Grid

                    // VII. KELUAR IGD (Full Width)
                    html += '<div style="background:#fff; border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:15px; border-left:4px solid #3b82f6;">';
                    html += '<h5 style="margin:0 0 10px 0; color:#2563eb; border-bottom:1px solid #eee; padding-bottom:5px;"><i class="fa fa-home"></i> VII. KELUAR IGD</h5>';
                    html += '<div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">';
                    html += '<div>';
                    html += '<p style="font-size:11px;"><strong>Status Pulang:</strong> ' + (d.pulang_dipulangkan||'-') + ' (' + (d.keterangan_pulang_dipulangkan||'-') + ')</p>';
                    html += '<p style="font-size:11px;"><strong>Dirawat:</strong> ' + (d.pulang_dirawat_diruang||'-') + '</p>';
                    html += '<p style="font-size:11px;"><strong>Dirujuk:</strong> ' + (d.pulang_dirujuk_ke||'-') + '</p>';
                    html += '</div>';
                    html += '<div>';
                    html += '<p style="font-size:11px; font-weight:bold;">Kondisi Saat Pulang:</p>';
                    html += '<div style="display:flex; gap:10px; font-size:11px;">';
                    html += '<span><strong>TD:</strong> '+(d.fisik_pulang_td||'-')+'</span>';
                    html += '<span><strong>Nadi:</strong> '+(d.fisik_pulang_nadi||'-')+'</span>';
                    html += '<span><strong>Suhu:</strong> '+(d.fisik_pulang_suhu||'-')+'</span>';
                    html += '<span><strong>GCS:</strong> '+(d.fisik_pulang_gcs||'-')+'</span>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    html += '</div>'; // Wrapper

                    typeof Swal !== "undefined" && Swal.fire({
                        title: '<span style="color:#db2777;">Detail Asesmen Psikiatri</span>',
                        html: html,
                        width: '900px',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fa fa-print"></i> Cetak',
                        cancelButtonText: '<i class="fa fa-times"></i> Tutup',
                        confirmButtonColor: '#10b981',
                        cancelButtonColor: '#db2777',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            printSinglePDF(d.no_rawat);
                        }
                    });
                }
            });
    }

    function editAssessment(noRawat) {
        fetch('<?= base_url("AwalMedisGawatDaruratPsikiatriController/get_detail") ?>?no_rawat=' + noRawat)
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    const d = data.data;
                     if (d.tanggal) {
                        const parts = d.tanggal.split(' ');
                        document.querySelector('[name="tanggal"]').value = parts[0];
                        document.querySelector('[name="jam"]').value = parts[1].substring(0, 5);
                    }
                    toggleHubungan(d.anamnesis);
                    
                    const fields = [
                        'no_rawat', 'anamnesis', 'hubungan', 'keluhan_utama', 'gejala_menyertai', 'faktor_pencetus',
                        'riwayat_penyakit_dahulu', 'keterangan_riwayat_penyakit_dahulu', 'riwayat_kehamilan',
                        'riwayat_sosial', 'keterangan_riwayat_sosial', 'riwayat_pekerjaan', 'keterangan_riwayat_pekerjaan',
                        'riwayat_obat_diminum', 'faktor_kepribadian_premorbid', 'faktor_keturunan', 'keterangan_faktor_keturunan',
                        'faktor_organik', 'keterangan_faktor_organik', 'riwayat_alergi',
                        'fisik_kesadaran', 'fisik_gcs', 'fisik_td', 'fisik_nadi', 'fisik_rr', 'fisik_suhu', 'fisik_bb', 'fisik_tb', 'fisik_status_nutrisi', 'fisik_nyeri',
                        'status_kelainan_kepala', 'keterangan_status_kelainan_kepala', 'status_kelainan_leher', 'keterangan_status_kelainan_leher',
                        'status_kelainan_dada', 'keterangan_status_kelainan_dada', 'status_kelainan_perut', 'keterangan_status_kelainan_perut',
                        'status_kelainan_anggota_gerak', 'keterangan_status_kelainan_anggota_gerak',
                        'status_lokalisata',
                        'psikiatrik_kesan_umum', 'psikiatrik_sikap_prilaku', 'psikiatrik_kesadaran', 'psikiatrik_orientasi', 'psikiatrik_daya_ingat', 'psikiatrik_persepsi', 'psikiatrik_pikiran', 'psikiatrik_insight',
                        'laborat', 'radiologi', 'ekg', 'diagnosis', 'permasalahan', 'instruksi_medis', 'rencana_target', 'edukasi',
                        'pulang_dipulangkan', 'keterangan_pulang_dipulangkan', 'pulang_paksa', 'keterangan_pulang_paksa','pulang_dirawat_diruang', 'pulang_indikasi_ranap', 'pulang_dirujuk_ke', 'pulang_alasan_dirujuk', 'pulang_meninggal_igd', 'pulang_penyebab_kematian',
                        'fisik_pulang_kesadaran', 'fisik_pulang_gcs', 'fisik_pulang_td', 'fisik_pulang_nadi', 'fisik_pulang_suhu', 'fisik_pulang_rr'
                    ];

                    fields.forEach(f => {
                         const el = document.querySelector('[name="' + f + '"]');
                         if (el && d[f]) el.value = d[f];
                    });
                    
                    setEditMode();
                }
            });
    }

    function printSinglePDF(noRawat) {
        window.open('<?= base_url("AwalMedisGawatDaruratPsikiatriController/print_pdf?no_rawat=") ?>' + noRawat, '_blank');
    }

    function deleteAssessmentHistory(noRawat) {
        Swal.fire({
            title: 'Hapus?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya', confirmButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed) {
                fetch('<?= base_url("AwalMedisGawatDaruratPsikiatriController/delete") ?>', {
                    method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'no_rawat=' + noRawat
                }).then(res => res.json()).then(data => {
                    if(data.status === 'success') {
                        loadHistory();
                        resetFormAndButton();
                    }
                });
            }
        });
    }

    // Auto load
    loadHistory();
</script>
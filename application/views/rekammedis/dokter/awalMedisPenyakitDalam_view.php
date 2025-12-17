<form id="formAwalMedisPenyakitDalam">
    <input type="hidden" name="no_rawat" id="apd_no_rawat" value="<?= $no_rawat ?>">

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <h3 style="margin-top: 0;"><i class="fa fa-stethoscope"></i> Asesmen Awal Medis Penyakit Dalam</h3>
        </div>

        <!-- BARIS 1: TGL, JAM, ANAMNESIS, HUBUNGAN -->
        <div class="col-md-2">
            <div class="form-group">
                <label>Tanggal Asesmen</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="date" class="form-control" name="tanggal_asesmen"
                        value="<?= isset($asesment['tanggal']) ? date('Y-m-d', strtotime($asesment['tanggal'])) : $tgl_sekarang ?>">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Jam Asesmen</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                    <!-- Tambahkan ID 'jam_asesmen' untuk script realtime -->
                    <input type="time" class="form-control" name="jam_asesmen" id="jam_asesmen"
                        value="<?= isset($asesment['tanggal']) ? date('H:i:s', strtotime($asesment['tanggal'])) : $jam_sekarang ?>">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Anamnesis</label>
                <select class="form-control" name="anamnesis" id="combo_anamnesis">
                    <option value="Autoanamnesis" <?= isset($asesment['anamnesis']) && $asesment['anamnesis'] == 'Autoanamnesis' ? 'selected' : '' ?>>Autoanamnesis</option>
                    <option value="Alloanamnesis" <?= isset($asesment['anamnesis']) && $asesment['anamnesis'] == 'Alloanamnesis' ? 'selected' : '' ?>>Alloanamnesis</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Hubungan (jika Alloanamnesis)</label>
                <input type="text" class="form-control" name="hubungan" id="input_hubungan"
                    value="<?= $asesment['hubungan'] ?? '' ?>">
            </div>
        </div>
    </div>

    <!-- ANAMNESIS LANJUTAN -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Keluhan Utama</label>
                <textarea class="form-control" name="keluhan_utama"
                    rows="2"><?= $asesment['keluhan_utama'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Riwayat Penyakit Sekarang (RPS)</label>
                <textarea class="form-control" name="rps" rows="3"><?= $asesment['rps'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Riwayat Penyakit Dahulu (RPD)</label>
                <textarea class="form-control" name="rpd" rows="3"><?= $asesment['rpd'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Riwayat Penggunaan Obat (RPO)</label>
                <textarea class="form-control" name="rpo" rows="2"><?= $asesment['rpo'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Riwayat Alergi</label>
                <input type="text" class="form-control" name="alergi" value="<?= $asesment['alergi'] ?? '' ?>">
            </div>
        </div>
    </div>

    <!-- 2. PEMERIKSAAN FISIK -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-green" style="border-bottom: 2px solid #00a65a; padding-bottom: 5px;"><i
                    class="fa fa-heartbeat"></i> Pemeriksaan Fisik</h4>
        </div>

        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>Kondisi Umum</label>
                <select class="form-control" name="kondisi">
                    <option <?php echo (isset($asesment['kondisi']) && $asesment['kondisi'] == 'Sehat') ? 'selected' : '' ?>>Sehat</option>
                    <option <?php echo (isset($asesment['kondisi']) && $asesment['kondisi'] == 'Sakit Ringan') ? 'selected' : '' ?>>Sakit Ringan</option>
                    <option <?php echo (isset($asesment['kondisi']) && $asesment['kondisi'] == 'Sakit Sedang') ? 'selected' : '' ?>>Sakit Sedang</option>
                    <option <?php echo (isset($asesment['kondisi']) && $asesment['kondisi'] == 'Sakit Berat') ? 'selected' : '' ?>>Sakit Berat</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>Status Psikologis</label>
                <select class="form-control" name="status">
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Tenang') ? 'selected' : '' ?>>Tenang</option>
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Cemas') ? 'selected' : '' ?>>Cemas</option>
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Takut') ? 'selected' : '' ?>>Takut</option>
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Marah') ? 'selected' : '' ?>>Marah</option>
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Sedih') ? 'selected' : '' ?>>Sedih</option>
                    <option <?php echo (isset($asesment['status']) && $asesment['status'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>GCS (E,V,M)</label>
                <input type="text" class="form-control" name="gcs" value="<?= $asesment['gcs'] ?? '' ?>"
                    placeholder="Contoh: 4,5,6">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>TD (mmHg)</label>
                <input type="text" class="form-control" name="td" value="<?= $asesment['td'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>Nadi (x/mnt)</label>
                <input type="text" class="form-control" name="nadi" value="<?= $asesment['nadi'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>Suhu (°C)</label>
                <input type="text" class="form-control" name="suhu" value="<?= $asesment['suhu'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>RR (x/mnt)</label>
                <input type="text" class="form-control" name="rr" value="<?= $asesment['rr'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>BB (Kg)</label>
                <input type="text" class="form-control" name="bb" value="<?= $asesment['bb'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="form-group">
                <label>Nyeri</label>
                <input type="text" class="form-control" name="nyeri" value="<?= $asesment['nyeri'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Keterangan Lain</label>
                <input type="text" class="form-control" name="lainnya" value="<?= $asesment['lainnya'] ?? '' ?>">
            </div>
        </div>
    </div>

    <!-- 3. STATUS LOKALIS / ORGAN -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-green" style="border-bottom: 2px solid #00a65a; padding-bottom: 5px;"><i
                    class="fa fa-user-md"></i> Pemeriksaan Organ</h4>
        </div>

        <!-- Kepala -->
        <div class="col-md-6">
            <div class="form-group bg-gray-light p-2 rounded">
                <label>Kepala</label><br>
                <label class="radio-inline"><input type="radio" name="kepala" value="Normal"
                        <?= isset($asesment['kepala']) && $asesment['kepala'] == 'Normal' ? 'checked' : 'checked' ?>>
                    Normal</label>
                <label class="radio-inline"><input type="radio" name="kepala" value="Abnormal"
                        <?= isset($asesment['kepala']) && $asesment['kepala'] == 'Abnormal' ? 'checked' : '' ?>>
                    Abnormal</label>
                <input type="text" class="form-control mt-2" name="keterangan_kepala" placeholder="Keterangan..."
                    value="<?= $asesment['keterangan_kepala'] ?? '' ?>">
            </div>
        </div>

        <!-- Thoraks -->
        <div class="col-md-6">
            <div class="form-group bg-gray-light p-2 rounded">
                <label>Thoraks (Paru & Jantung)</label><br>
                <label class="radio-inline"><input type="radio" name="thoraks" value="Normal"
                        <?= isset($asesment['thoraks']) && $asesment['thoraks'] == 'Normal' ? 'checked' : 'checked' ?>>
                    Normal</label>
                <label class="radio-inline"><input type="radio" name="thoraks" value="Abnormal"
                        <?= isset($asesment['thoraks']) && $asesment['thoraks'] == 'Abnormal' ? 'checked' : '' ?>>
                    Abnormal</label>
                <input type="text" class="form-control mt-2" name="keterangan_thorak" placeholder="Keterangan..."
                    value="<?= $asesment['keterangan_thorak'] ?? '' ?>">
            </div>
        </div>

        <!-- Abdomen -->
        <div class="col-md-6">
            <div class="form-group bg-gray-light p-2 rounded">
                <label>Abdomen</label><br>
                <label class="radio-inline"><input type="radio" name="abdomen" value="Normal"
                        <?= isset($asesment['abdomen']) && $asesment['abdomen'] == 'Normal' ? 'checked' : 'checked' ?>>
                    Normal</label>
                <label class="radio-inline"><input type="radio" name="abdomen" value="Abnormal"
                        <?= isset($asesment['abdomen']) && $asesment['abdomen'] == 'Abnormal' ? 'checked' : '' ?>>
                    Abnormal</label>
                <input type="text" class="form-control mt-2" name="keterangan_abdomen" placeholder="Keterangan..."
                    value="<?= $asesment['keterangan_abdomen'] ?? '' ?>">
            </div>
        </div>

        <!-- Ekstremitas -->
        <div class="col-md-6">
            <div class="form-group bg-gray-light p-2 rounded">
                <label>Ekstremitas</label><br>
                <label class="radio-inline"><input type="radio" name="ekstremitas" value="Normal"
                        <?= isset($asesment['ekstremitas']) && $asesment['ekstremitas'] == 'Normal' ? 'checked' : 'checked' ?>> Normal</label>
                <label class="radio-inline"><input type="radio" name="ekstremitas" value="Abnormal"
                        <?= isset($asesment['ekstremitas']) && $asesment['ekstremitas'] == 'Abnormal' ? 'checked' : '' ?>>
                    Abnormal</label>
                <input type="text" class="form-control mt-2" name="keterangan_ekstremitas" placeholder="Keterangan..."
                    value="<?= $asesment['keterangan_ekstremitas'] ?? '' ?>">
            </div>
        </div>
    </div>

    <!-- 4. HASIL PENUNJANG -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-green" style="border-bottom: 2px solid #00a65a; padding-bottom: 5px;"><i
                    class="fa fa-flask"></i> Pemeriksaan Penunjang</h4>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Laboratorium</label>
                <textarea class="form-control" name="lab" rows="3"><?= $asesment['lab'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Radiologi</label>
                <textarea class="form-control" name="rad" rows="3"><?= $asesment['rad'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Penunjang Lain</label>
                <textarea class="form-control" name="penunjanglain"
                    rows="3"><?= $asesment['penunjanglain'] ?? '' ?></textarea>
            </div>
        </div>
    </div>

    <!-- 5. DIAGNOSIS & PLAN -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-green" style="border-bottom: 2px solid #00a65a; padding-bottom: 5px;"><i
                    class="fa fa-pencil-square-o"></i> Diagnosis & Perencanaan</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Diagnosis Asesmen</label>
                <textarea class="form-control" name="diagnosis" rows="2"><?= $asesment['diagnosis'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Diagnosis Banding / Tambahan</label>
                <textarea class="form-control" name="diagnosis2"
                    rows="2"><?= $asesment['diagnosis2'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Permasalahan</label>
                <input type="text" class="form-control" name="permasalahan"
                    value="<?= $asesment['permasalahan'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Terapi / Pengobatan</label>
                <textarea class="form-control" name="terapi" rows="3"><?= $asesment['terapi'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tindakan</label>
                <textarea class="form-control" name="tindakan" rows="3"><?= $asesment['tindakan'] ?? '' ?></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Edukasi</label>
                <textarea class="form-control" name="edukasi" rows="2"><?= $asesment['edukasi'] ?? '' ?></textarea>
            </div>
        </div>
    </div>

    <div class="row text-right" style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 15px;">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="simpanAssesment()"><i class="fa fa-save"></i> Simpan
                Asesmen</button>
        </div>
    </div>
</form>

<!-- HISTORY TABLE -->
<div id="box-history-apd" class="box box-success box-solid"
    style="margin-top:20px; display: <?= !empty($asesment['no_rawat']) ? 'block' : 'none' ?>;">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-history"></i> Riwayat Asesmen Aktif</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="bg-gray-light">
                    <th>Tanggal Asesmen</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Anamnesis</th>
                    <th>Diagnosis Utama</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="apd_hist_tanggal" style="vertical-align:middle; font-weight:bold;">
                        <?= isset($asesment['tanggal']) ? date('d-m-Y H:i', strtotime($asesment['tanggal'])) : '-' ?>
                    </td>
                    <td style="vertical-align:middle;"><?= $detail_pasien['nm_dokter'] ?? '-' ?></td>
                    <td id="apd_hist_anamnesis" style="vertical-align:middle;"><?= $asesment['anamnesis'] ?? '-' ?></td>
                    <td id="apd_hist_diagnosa" style="vertical-align:middle; color:#d73925;">
                        <?= isset($asesment['diagnosis']) ? (strlen($asesment['diagnosis']) > 50 ? substr($asesment['diagnosis'], 0, 50) . '...' : $asesment['diagnosis']) : '-' ?>
                    </td>
                    <td style="vertical-align:middle;">
                        <button type="button" class="btn btn-info btn-sm btn-flat" onclick="lihatDetailAPD()"
                            title="Lihat Detail"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="cetakPdfAPD()"
                            title="Cetak PDF"><i class="fa fa-print"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="hapusAssesment()"
                            title="Hapus Data"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="modal-detail-apd">
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header bg-blue" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color:white; opacity:1;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-file-text-o"></i> Detail Asesmen Penyakit Dalam</h4>
            </div>
            <div class="modal-body" style="background: #ecf0f5;">
                <div class="row">
                    <!-- SIDEBAR PROFILE -->
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                    src="<?= base_url('assets/dist/img/avatar5.png') ?>" alt="Patient profile picture">
                                <h3 class="profile-username text-center"><?= $detail_pasien['nm_pasien'] ?></h3>
                                <p class="text-muted text-center"><?= $detail_pasien['no_rkm_medis'] ?></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Tanggal Lahir</b> <a
                                            class="pull-right"><?= date('d-m-Y', strtotime($detail_pasien['tgl_lahir'])) ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>JK</b> <a
                                            class="pull-right"><?= $detail_pasien['jk'] == 'L' ? 'Laki-Laki' : 'Perempuan' ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tgl Asesmen</b> <a class="pull-right" id="det_tanggal"></a>
                                    </li>
                                </ul>
                                <a href="#" onclick="cetakPdfAPD()" class="btn btn-primary btn-block"><b><i
                                            class="fa fa-print"></i> Cetak PDF</b></a>
                            </div>
                        </div>

                        <!-- VITAL SIGN BOX -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 id="det_td" style="font-size:24px">120/80</h3>
                                <p>Tekanan Darah (mmHg)</p>
                            </div>
                            <div class="icon"><i class="fa fa-heartbeat"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h4 id="det_nadi">80</h4>
                                        <p>Nadi (x/m)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h4 id="det_suhu">36.5</h4>
                                        <p>Suhu (°C)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MAIN CONTENT -->
                    <div class="col-md-8">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Anamnesis & Fisik</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Organ & Penunjang</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Diagnosis & Plan</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- TAB 1 -->
                                <div class="tab-pane active" id="tab_1">
                                    <strong class="text-blue"><i class="fa fa-commenting-o"></i> Keluhan Utama</strong>
                                    <p class="text-muted" id="det_keluhan"></p>
                                    <hr>
                                    <strong class="text-blue"><i class="fa fa-history"></i> Riwayat Penyakit
                                        Sekarang</strong>
                                    <p class="text-muted" id="det_rps"></p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong class="text-blue">RPD</strong>
                                            <p class="text-muted" id="det_rpd"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong class="text-blue">RPO</strong>
                                            <p class="text-muted" id="det_rpo"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <strong class="text-red"><i class="fa fa-warning"></i> Alergi</strong>
                                    <p class="text-danger" id="det_alergi"></p>
                                </div>

                                <!-- TAB 2 -->
                                <div class="tab-pane" id="tab_2">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Kepala</th>
                                            <td id="det_kepala"></td>
                                        </tr>
                                        <tr>
                                            <th>Thoraks</th>
                                            <td id="det_thoraks"></td>
                                        </tr>
                                        <tr>
                                            <th>Abdomen</th>
                                            <td id="det_abdomen"></td>
                                        </tr>
                                        <tr>
                                            <th>Ekstremitas</th>
                                            <td id="det_ekstremitas"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <strong class="text-blue">Laboratorium</strong>
                                    <p class="text-muted" id="det_lab"></p>
                                    <strong class="text-blue">Radiologi</strong>
                                    <p class="text-muted" id="det_rad"></p>
                                </div>

                                <!-- TAB 3 -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="callout callout-danger">
                                        <h4>Diagnosis Utama</h4>
                                        <p id="det_diagnosis"></p>
                                    </div>
                                    <strong class="text-blue">Diagnosis Banding</strong>
                                    <p class="text-muted" id="det_diagnosis2"></p>
                                    <hr>
                                    <strong class="text-blue">Terapi / Tindakan</strong>
                                    <p class="text-muted" id="det_terapi"></p>
                                    <hr>
                                    <strong class="text-blue">Edukasi</strong>
                                    <p class="text-muted" id="det_edukasi"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f4f4f4;">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. Logic Anamnesis Toggle (Dihapus sesuai request)
    // Hubungan bebas diisi kapan saja.

    // 2. Logic Jam Realtime (Hanya jika data belum ada alias form baru)
    const isEditMode = "<?= isset($asesment['tanggal']) ? 'true' : 'false' ?>";

    if (isEditMode === 'false') {
        let clockInterval = setInterval(() => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Update input
            if ($('#jam_asesmen').length) {
                document.getElementById('jam_asesmen').value = `${hours}:${minutes}`;
            }
        }, 1000);

        $('#jam_asesmen').on('input change', function () {
            clearInterval(clockInterval);
        });
    }

    function simpanAssesment() {
        $.ajax({
            url: "<?= base_url('AwalMedisPenyakitDalamController/save') ?>",
            type: "POST",
            data: $('#formAwalMedisPenyakitDalam').serialize(),
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => { Swal.showLoading() }
                });
            },
            success: function (response) {
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Update UI History without reload
                        updateHistoryUI();
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire('Error', 'Terjadi kesalahan server.', 'error');
            }
        });
    }

    // Function to show/update History Box from current Form Values
    function updateHistoryUI() {
        // Show box
        $('#box-history-apd').show();

        // Get values
        var tgl = $('input[name="tanggal_asesmen"]').val();
        var jam = $('input[name="jam_asesmen"]').val();
        var anam = $('#combo_anamnesis').val();
        var diag = $('textarea[name="diagnosis"]').val();

        // Format Date (YYYY-MM-DD -> DD-MM-YYYY)
        if (tgl) {
            var parts = tgl.split('-');
            if (parts.length == 3) tgl = parts[2] + '-' + parts[1] + '-' + parts[0];
        }

        // Update Table
        $('#apd_hist_tanggal').text(tgl + ' ' + jam);
        $('#apd_hist_anamnesis').text(anam);

        var shortDiag = diag.length > 50 ? diag.substring(0, 50) + '...' : diag;
        $('#apd_hist_diagnosa').text(shortDiag);
    }

    function hapusAssesment() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data asesmen ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('AwalMedisPenyakitDalamController/delete') ?>",
                    type: "POST",
                    data: { no_rawat: $('#apd_no_rawat').val() },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire('Terhapus!', response.message, 'success').then(() => {
                                $('#formAwalMedisPenyakitDalam')[0].reset();
                                $('#box-history-apd').hide();
                            });
                        } else {
                            Swal.fire('Gagal', response.message, 'error');
                        }
                    }
                });
            }
        })
    }

    function cetakPdfAPD() {
        var no_rawat = $('#apd_no_rawat').val();
        if (!no_rawat) return;
        var url = "<?= base_url('AwalMedisPenyakitDalamController/print_pdf?no_rawat=') ?>" + no_rawat;
        window.open(url, '_blank');
    }

    function lihatDetailAPD() {
        // Populate Modal from Form Values (Client Side Binding)
        // Header
        var tgl = $('input[name="tanggal_asesmen"]').val();
        var parts = tgl.split('-');
        if (parts.length == 3) tgl = parts[2] + '-' + parts[1] + '-' + parts[0];
        $('#det_tanggal').text(tgl + ' ' + $('input[name="jam_asesmen"]').val());

        // Vital
        $('#det_td').text($('input[name="td"]').val());
        $('#det_nadi').text($('input[name="nadi"]').val());
        $('#det_suhu').text($('input[name="suhu"]').val());

        // Tab 1
        $('#det_keluhan').text($('textarea[name="keluhan_utama"]').val());
        $('#det_rps').text($('textarea[name="rps"]').val());
        $('#det_rpd').text($('textarea[name="rpd"]').val());
        $('#det_rpo').text($('textarea[name="rpo"]').val());
        $('#det_alergi').text($('input[name="alergi"]').val());

        // Tab 2 (Organ)
        var kepala = $('input[name="kepala"]:checked').val() + ' ' + ($('input[name="keterangan_kepala"]').val() ? '(' + $('input[name="keterangan_kepala"]').val() + ')' : '');
        var thoraks = $('input[name="thoraks"]:checked').val() + ' ' + ($('input[name="keterangan_thorak"]').val() ? '(' + $('input[name="keterangan_thorak"]').val() + ')' : '');
        var abdomen = $('input[name="abdomen"]:checked').val() + ' ' + ($('input[name="keterangan_abdomen"]').val() ? '(' + $('input[name="keterangan_abdomen"]').val() + ')' : '');
        var ekstre = $('input[name="ekstremitas"]:checked').val() + ' ' + ($('input[name="keterangan_ekstremitas"]').val() ? '(' + $('input[name="keterangan_ekstremitas"]').val() + ')' : '');

        $('#det_kepala').text(kepala);
        $('#det_thoraks').text(thoraks);
        $('#det_abdomen').text(abdomen);
        $('#det_ekstremitas').text(ekstre);

        $('#det_lab').text($('textarea[name="lab"]').val());
        $('#det_rad').text($('textarea[name="rad"]').val());

        // Tab 3
        $('#det_diagnosis').text($('textarea[name="diagnosis"]').val());
        $('#det_diagnosis2').text($('textarea[name="diagnosis2"]').val());
        $('#det_terapi').text($('textarea[name="terapi"]').val());
        $('#det_edukasi').text($('textarea[name="edukasi"]').val());

        $('#modal-detail-apd').modal('show');
    }
</script>
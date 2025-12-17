<!-- Penilaian Medis Mata - Form dengan Canvas Drawing -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-eye"></i> Penilaian Medis Mata
            <small>Asesmen Oftalmologi</small>
        </h1>
    </section>

    <section class="content">
        <!-- Form Input -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Form Penilaian</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <form id="formPenilaianMata" class="form-horizontal">
                    <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
                    <input type="hidden" name="kd_dokter" id="kd_dokter" value="<?= $kd_dokter ?>">
                    <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">
                    <input type="hidden" name="gambar_od_base64" id="gambar_od_base64">
                    <input type="hidden" name="gambar_os_base64" id="gambar_os_base64">

                    <!-- Tanggal & Jam -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tanggal Perawatan</label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_perawatan" id="tgl_perawatan"
                                        class="form-control input-sm" value="<?= $tgl_sekarang ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jam Perawatan</label>
                                <div class="col-sm-8">
                                    <input type="time" name="jam_rawat" id="jam_rawat" step="1"
                                        class="form-control input-sm" value="<?= $jam_sekarang ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- I. RIWAYAT KESEHATAN -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">I. RIWAYAT KESEHATAN</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Anamnesis</label>
                                        <div class="col-sm-8">
                                            <select name="anamnesis" id="anamnesis" class="form-control input-sm">
                                                <option value="Autoanamnesis">Autoanamnesis</option>
                                                <option value="Alloanamnesis">Alloanamnesis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Hubungan</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="hubungan" id="hubungan"
                                                class="form-control input-sm" placeholder="Istri/Anak/Orang tua">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Keluhan Utama</label>
                                <div class="col-sm-10">
                                    <textarea name="keluhan_utama" id="keluhan_utama" rows="2" class="form-control"
                                        placeholder="Keluhan utama pasien"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Riwayat Penyakit Sekarang</label>
                                        <div class="col-sm-8">
                                            <textarea name="rps" id="rps" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Riwayat Penyakit Dahulu</label>
                                        <div class="col-sm-8">
                                            <textarea name="rpd" id="rpd" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Riwayat Penggunaan Obat</label>
                                        <div class="col-sm-8">
                                            <textarea name="rpo" id="rpo" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Riwayat Alergi</label>
                                        <div class="col-sm-8">
                                            <textarea name="alergi" id="alergi" rows="2"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- II. PEMERIKSAAN FISIK -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">II. PEMERIKSAAN FISIK</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>TD (mmHg)</label>
                                        <input type="text" name="td" id="td" class="form-control input-sm"
                                            placeholder="120/80">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>BB (kg)</label>
                                        <input type="text" name="bb" id="bb" class="form-control input-sm"
                                            placeholder="60">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Suhu (°C)</label>
                                        <input type="text" name="suhu" id="suhu" class="form-control input-sm"
                                            placeholder="36.5">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nadi (/menit)</label>
                                        <input type="text" name="nadi" id="nadi" class="form-control input-sm"
                                            placeholder="80">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>RR (/menit)</label>
                                        <input type="text" name="rr" id="rr" class="form-control input-sm"
                                            placeholder="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nyeri</label>
                                        <input type="text" name="nyeri" id="nyeri" class="form-control input-sm"
                                            placeholder="0-10">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status Nutrisi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="status_nutrisi" id="status_nutrisi"
                                        class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- III. STATUS OFTALMOLOGIS -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">III. STATUS OFTALMOLOGIS</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <!-- MATA KANAN (OD) -->
                                <div class="col-md-6">
                                    <div class="text-center bg-info" style="padding: 10px; margin-bottom: 15px;">
                                        <h4 style="margin: 0;"><strong>OD : Mata Kanan</strong></h4>
                                    </div>

                                    <!-- Canvas untuk gambar mata kanan -->
                                    <div class="text-center" style="margin-bottom: 15px;">
                                        <canvas id="canvas_od" width="400" height="200"
                                            style="border: 2px solid #3c8dbc; cursor: crosshair; background: white;"></canvas>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="clearCanvas('od')">
                                            <i class="fa fa-eraser"></i> Clear
                                        </button>
                                        <button type="button" class="btn btn-sm btn-info" onclick="resetCanvas('od')">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>

                                    <!-- Field pemeriksaan mata kanan -->
                                    <?php
                                    $fields_od = [
                                        'visuskanan' => 'Visus SC',
                                        'cckanan' => 'CC',
                                        'palkanan' => 'Palpebra',
                                        'conkanan' => 'Conjungtiva',
                                        'corneakanan' => 'Cornea',
                                        'coakanan' => 'COA',
                                        'pupilkanan' => 'Pupil',
                                        'lensakanan' => 'Lensa',
                                        'funduskanan' => 'Fundus Media',
                                        'papilkanan' => 'Papil',
                                        'retinakanan' => 'Retina',
                                        'makulakanan' => 'Makula',
                                        'tiokanan' => 'TIO',
                                        'mbokanan' => 'MBO'
                                    ];
                                    foreach ($fields_od as $name => $label): ?>
                                        <div class="form-group">
                                            <label><?= $label ?></label>
                                            <input type="text" name="<?= $name ?>" id="<?= $name ?>"
                                                class="form-control input-sm">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- MATA KIRI (OS) -->
                                <div class="col-md-6">
                                    <div class="text-center bg-success" style="padding: 10px; margin-bottom: 15px;">
                                        <h4 style="margin: 0;"><strong>OS : Mata Kiri</strong></h4>
                                    </div>

                                    <!-- Canvas untuk gambar mata kiri -->
                                    <div class="text-center" style="margin-bottom: 15px;">
                                        <canvas id="canvas_os" width="400" height="200"
                                            style="border: 2px solid #00a65a; cursor: crosshair; background: white;"></canvas>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="clearCanvas('os')">
                                            <i class="fa fa-eraser"></i> Clear
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="resetCanvas('os')">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>

                                    <!-- Field pemeriksaan mata kiri -->
                                    <?php
                                    $fields_os = [
                                        'visuskiri' => 'Visus SC',
                                        'cckiri' => 'CC',
                                        'palkiri' => 'Palpebra',
                                        'conkiri' => 'Conjungtiva',
                                        'corneakiri' => 'Cornea',
                                        'coakiri' => 'COA',
                                        'pupilkiri' => 'Pupil',
                                        'lensakiri' => 'Lensa',
                                        'funduskiri' => 'Fundus Media',
                                        'papilkiri' => 'Papil',
                                        'retinakiri' => 'Retina',
                                        'makulakiri' => 'Makula',
                                        'tiokiri' => 'TIO',
                                        'mbokiri' => 'MBO'
                                    ];
                                    foreach ($fields_os as $name => $label): ?>
                                        <div class="form-group">
                                            <label><?= $label ?></label>
                                            <input type="text" name="<?= $name ?>" id="<?= $name ?>"
                                                class="form-control input-sm">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IV. PEMERIKSAAN PENUNJANG -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">IV. PEMERIKSAAN PENUNJANG</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Laboratorium</label>
                                        <textarea name="lab" id="lab" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Radiologi</label>
                                        <textarea name="rad" id="rad" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Penunjang Lainnya</label>
                                        <textarea name="penunjang" id="penunjang" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tes Penglihatan</label>
                                        <textarea name="tes" id="tes" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pemeriksaan Lain</label>
                                        <textarea name="pemeriksaan" id="pemeriksaan" rows="2"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- V. DIAGNOSIS/ASESMEN -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">V. DIAGNOSIS / ASESMEN</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Asesmen Kerja</label>
                                        <textarea name="diagnosis" id="diagnosis" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Asesmen Banding</label>
                                        <textarea name="diagnosisbdg" id="diagnosisbdg" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- VI. PERMASALAHAN & TATALAKSANA -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">VI. PERMASALAHAN & TATALAKSANA</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Permasalahan</label>
                                        <textarea name="permasalahan" id="permasalahan" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Terapi/Pengobatan</label>
                                        <textarea name="terapi" id="terapi" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tindakan/Rencana Tindakan</label>
                                <textarea name="tindakan" id="tindakan" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- VII. EDUKASI -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h4 class="box-title">VII. EDUKASI</h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <textarea name="edukasi" id="edukasi" rows="3" class="form-control"
                                    placeholder="Edukasi yang diberikan kepada pasien/keluarga"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg" id="btnSimpan">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-default btn-lg" onclick="resetForm()">
                            <i class="fa fa-refresh"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hasil & Riwayat -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Data Penilaian Medis Mata</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="tableHasil">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Keluhan Utama</th>
                                    <th>Diagnosis</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pasien -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-history"></i> Riwayat Penilaian Pasien</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover" id="tableRiwayat">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Tanggal</th>
                                    <th>No. Rawat</th>
                                    <th>Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Diagnosis</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-text"></i> Detail Penilaian Medis Mata</h4>
            </div>
            <div class="modal-body" id="modalDetailBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/penilaian_medis_mata.js?v=' . time()) ?>"></script>
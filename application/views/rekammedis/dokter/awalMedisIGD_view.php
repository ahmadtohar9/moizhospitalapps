<style>
    .form-header {
        background: #f4f4f4;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.9em;
    }

    .input-sm {
        padding: 5px 10px;
        height: 30px;
        font-size: 13px;
    }

    .canvas-container {
        position: relative;
        border: 1px solid #ccc;
        background: #f9f9f9;
        margin: 0 auto;
        display: block;
    }

    canvas {
        cursor: crosshair;
    }

    .canvas-tools {
        margin-bottom: 5px;
        text-align: center;
    }

    .canvas-tools button {
        margin: 0 2px;
    }
</style>


<div class="box-header with-border">
    <h3 class="box-title"><b><i class="fa fa-user-md"></i> Asesmen Awal Medis Gawat Darurat</b></h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh"><i
                class="fa fa-refresh"></i></button>
    </div>
</div>
<div class="box-body">
    <style>
        .section-header {
            font-size: 16px;
            font-weight: 600;
            color: #3c8dbc;
            border-bottom: 2px solid #3c8dbc;
            padding-bottom: 5px;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .section-header i {
            margin-right: 8px;
        }

        .form-horizontal .control-label {
            text-align: left;
        }
    </style>

    <form id="form-awal-igd">
        <input type="hidden" name="no_rawat" id="igd_no_rawat" value="<?= $no_rawat; ?>">
        <input type="hidden" name="kd_dokter" id="igd_kd_dokter" value="<?= $kd_dokter; ?>">
        <input type="hidden" name="lokalis_image" id="lokalis_image">



            <!-- Baris Atas: Tanggal, Jam, Anamnesis, Hubungan -->
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control datepicker" name="tanggal"
                                value="<?= isset($asesment['tanggal']) ? explode(' ', $asesment['tanggal'])[0] : $tgl_sekarang; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Jam</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                            <input type="text" class="form-control" name="jam" id="jam_input"
                                value="<?= isset($asesment['tanggal']) ? explode(' ', $asesment['tanggal'])[1] : $jam_sekarang; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Anamnesis</label>
                        <select class="form-control" name="anamnesis">
                            <option value="Autoanamnesis" <?= (isset($asesment['anamnesis']) && $asesment['anamnesis'] == 'Autoanamnesis') ? 'selected' : ''; ?>>Autoanamnesis</option>
                            <option value="Alloanamnesis" <?= (isset($asesment['anamnesis']) && $asesment['anamnesis'] == 'Alloanamnesis') ? 'selected' : ''; ?>>Alloanamnesis</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Hubungan (jika Alloanamnesis)</label>
                        <input type="text" class="form-control" name="hubungan"
                            value="<?= $asesment['hubungan'] ?? ''; ?>"
                            placeholder="Sebutkan hubungan dengan pasien...">
                    </div>
                </div>
            </div>

            <!-- I. RIWAYAT KESEHATAN -->
            <div class="section-header"><i class="fa fa-history"></i> I. RIWAYAT KESEHATAN</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Keluhan Utama</label>
                        <textarea class="form-control" name="keluhan_utama"
                            rows="3"><?= $asesment['keluhan_utama'] ?? ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Riwayat Penyakit Sekarang</label>
                        <textarea class="form-control" name="rps" rows="3"><?= $asesment['rps'] ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Riw. Penyakit Dahulu</label>
                                <textarea class="form-control" name="rpd"
                                    rows="3"><?= $asesment['rpd'] ?? ''; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Riw. Penyakit Keluarga</label>
                                <textarea class="form-control" name="rpk"
                                    rows="3"><?= $asesment['rpk'] ?? ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Riw. Penggunaan Obat</label>
                                <textarea class="form-control" name="rpo"
                                    rows="3"><?= $asesment['rpo'] ?? ''; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Riwayat Alergi</label>
                                <input type="text" class="form-control" name="alergi"
                                    value="<?= $asesment['alergi'] ?? ''; ?>" placeholder="Tidak ada">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- II. PEMERIKSAAN FISIK -->
            <div class="section-header"><i class="fa fa-stethoscope"></i> II. PEMERIKSAAN FISIK</div>

            <div class="well" style="background: #fdfdfd; padding: 15px;">
                <div class="row">
                    <div class="col-md-2">
                        <label>Keadaan Umum</label>
                        <select class="form-control input-sm" name="keadaan">
                            <option value="">-- Pilih --</option>
                            <option value="Sehat" <?= ($asesment['keadaan'] ?? '') == 'Sehat' ? 'selected' : ''; ?>>Sehat
                            </option>
                            <option value="Sakit Ringan" <?= ($asesment['keadaan'] ?? '') == 'Sakit Ringan' ? 'selected' : ''; ?>>
                                Sakit Ringan</option>
                            <option value="Sakit Sedang" <?= ($asesment['keadaan'] ?? '') == 'Sakit Sedang' ? 'selected' : ''; ?>>
                                Sakit Sedang</option>
                            <option value="Sakit Berat" <?= ($asesment['keadaan'] ?? '') == 'Sakit Berat' ? 'selected' : ''; ?>>Sakit
                                Berat</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Kesadaran</label>
                        <select class="form-control input-sm" name="kesadaran">
                            <option value="">-- Pilih --</option>
                            <option value="Compos Mentis" <?= ($asesment['kesadaran'] ?? '') == 'Compos Mentis' ? 'selected' : ''; ?>>Compos Mentis</option>
                            <option value="Apatis" <?= ($asesment['kesadaran'] ?? '') == 'Apatis' ? 'selected' : ''; ?>>
                                Apatis
                            </option>
                            <option value="Somnolen" <?= ($asesment['kesadaran'] ?? '') == 'Somnolen' ? 'selected' : ''; ?>>Somnolen
                            </option>
                            <option value="Sopor" <?= ($asesment['kesadaran'] ?? '') == 'Sopor' ? 'selected' : ''; ?>>Sopor
                            </option>
                            <option value="Koma" <?= ($asesment['kesadaran'] ?? '') == 'Koma' ? 'selected' : ''; ?>>Koma
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>GCS</label>
                        <input type="text" class="form-control input-sm" name="gcs"
                            value="<?= $asesment['gcs'] ?? ''; ?>">
                    </div>
                    <div class="col-md-1">
                        <label>TB (cm)</label>
                        <input type="text" class="form-control input-sm" name="tb"
                            value="<?= $asesment['tb'] ?? ''; ?>">
                    </div>
                    <div class="col-md-1">
                        <label>BB (Kg)</label>
                        <input type="text" class="form-control input-sm" name="bb"
                            value="<?= $asesment['bb'] ?? ''; ?>">
                    </div>
                    <div class="col-md-1">
                        <label>TD</label>
                        <input type="text" class="form-control input-sm" name="td" value="<?= $asesment['td'] ?? ''; ?>"
                            placeholder="mmHg">
                    </div>
                    <div class="col-md-1">
                        <label>Nadi</label>
                        <input type="text" class="form-control input-sm" name="nadi"
                            value="<?= $asesment['nadi'] ?? ''; ?>" placeholder="x/m">
                    </div>
                    <div class="col-md-1">
                        <label>RR</label>
                        <input type="text" class="form-control input-sm" name="rr" value="<?= $asesment['rr'] ?? ''; ?>"
                            placeholder="x/m">
                    </div>
                    <div class="col-md-1">
                        <label>Suhu</label>
                        <input type="text" class="form-control input-sm" name="suhu"
                            value="<?= $asesment['suhu'] ?? ''; ?>" placeholder="C">
                    </div>
                    <div class="col-md-1">
                        <label>SpO2</label>
                        <input type="text" class="form-control input-sm" name="spo2"
                            value="<?= $asesment['spo'] ?? ($asesment['spo2'] ?? ''); ?>" placeholder="%">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless table-condensed">
                        <tr>
                            <td width="30%"><label>Kepala</label></td>
                            <td>
                                <select class="form-control input-sm" name="kepala">
                                    <option value="Normal" <?= ($asesment['kepala'] ?? '') == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['kepala'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['kepala'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Mata</label></td>
                            <td>
                                <select class="form-control input-sm" name="mata">
                                    <option value="Normal" <?= ($asesment['mata'] ?? '') == 'Normal' ? 'selected' : ''; ?>>
                                        Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['mata'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['mata'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Gigi & Mulut</label></td>
                            <td>
                                <select class="form-control input-sm" name="gigi">
                                    <option value="Normal" <?= ($asesment['gigi'] ?? '') == 'Normal' ? 'selected' : ''; ?>>
                                        Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['gigi'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['gigi'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Leher</label></td>
                            <td>
                                <select class="form-control input-sm" name="leher">
                                    <option value="Normal" <?= ($asesment['leher'] ?? '') == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['leher'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['leher'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-condensed">
                        <tr>
                            <td width="30%"><label>Thoraks</label></td>
                            <td>
                                <select class="form-control input-sm" name="thoraks">
                                    <option value="Normal" <?= ($asesment['thoraks'] ?? '') == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['thoraks'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['thoraks'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Abdomen</label></td>
                            <td>
                                <select class="form-control input-sm" name="abdomen">
                                    <option value="Normal" <?= ($asesment['abdomen'] ?? '') == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['abdomen'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['abdomen'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Genital</label></td>
                            <td>
                                <select class="form-control input-sm" name="genital">
                                    <option value="Normal" <?= ($asesment['genital'] ?? '') == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Abnormal" <?= ($asesment['genital'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>
                                        Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['genital'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Ekstremitas</label></td>
                            <td>
                                <select class="form-control input-sm" name="ekstremitas">
                                    <option value="Normal" <?= ($asesment['ekstremitas'] ?? '') == 'Normal' ? 'selected' : ''; ?>>
                                        Normal</option>
                                    <option value="Abnormal" <?= ($asesment['ekstremitas'] ?? '') == 'Abnormal' ? 'selected' : ''; ?>>Abnormal</option>
                                    <option value="Tidak Diperiksa" <?= ($asesment['ekstremitas'] ?? '') == 'Tidak Diperiksa' ? 'selected' : ''; ?>>Tidak Diperiksa</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label>Keterangan Fisik Lainnya</label>
                <textarea class="form-control" name="ket_fisik" rows="2"><?= $asesment['ket_fisik'] ?? ''; ?></textarea>
            </div>

            <!-- III. STATUS LOKALIS -->
            <div class="section-header"><i class="fa fa-male"></i> III. STATUS LOKALIS 3D</div>
            <div class="text-center">
                <div class="canvas-tools">
                    <button type="button" class="btn btn-default btn-sm" onclick="setBrushColor('#000000')"><i
                            class="fa fa-circle" style="color:black"></i></button>
                    <button type="button" class="btn btn-default btn-sm" onclick="setBrushColor('#ff0000')"><i
                            class="fa fa-circle" style="color:red"></i> Biasa</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="setBrushColor('#0000ff')"><i
                            class="fa fa-circle" style="color:blue"></i> Luka</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="setBrushColor('#00ff00')"><i
                            class="fa fa-circle" style="color:green"></i> Nyeri</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="clearCanvas()"><i
                            class="fa fa-eraser"></i> Reset</button>
                </div>
                <div class="canvas-wrapper"
                    style="overflow:auto; margin-top:5px; border:1px solid #ddd; background:#fff;">
                    <canvas id="lokalisCanvas" width="800" height="400"></canvas>
                </div>
                <div class="form-group mt-2 text-left">
                    <label>Keterangan Lokalis</label>
                    <textarea class="form-control" name="ket_lokalis"
                        rows="2"><?= $asesment['ket_lokalis'] ?? ''; ?></textarea>
                </div>
            </div>

            <!-- IV. PEMERIKSAAN PENUNJANG -->
            <div class="section-header"><i class="fa fa-flask"></i> IV. PEMERIKSAAN PENUNJANG</div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>EKG</label>
                        <textarea class="form-control" name="ekg" rows="3"><?= $asesment['ekg'] ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Radiologi</label>
                        <textarea class="form-control" name="rad" rows="3"><?= $asesment['rad'] ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Laboratorium</label>
                        <textarea class="form-control" name="lab" rows="3"><?= $asesment['lab'] ?? ''; ?></textarea>
                    </div>
                </div>
            </div>

            <!-- V_VI. DIAGNOSIS & TATALAKSANA -->
            <div class="row">
                <div class="col-md-6">
                    <div class="section-header"><i class="fa fa-medkit"></i> V. DIAGNOSIS / ASESMEN</div>
                    <div class="form-group">
                        <textarea class="form-control" name="diagnosis"
                            rows="5"><?= $asesment['diagnosis'] ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-header"><i class="fa fa-user-md"></i> VI. TATALAKSANA</div>
                    <div class="form-group">
                        <textarea class="form-control" name="tata_laksana"
                            rows="5"><?= $asesment['tata'] ?? ($asesment['tata_laksana'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="box-footer text-center" style="border-top: 1px solid #f4f4f4; padding-top: 20px;">
                <button type="button" class="btn btn-success btn-lg btn-flat" id="btn-save-igd"
                    style="min-width:120px; margin-right: 5px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-lg btn-flat" id="btn-print-igd"
                    style="min-width:120px; margin-right: 5px;"><i class="fa fa-print"></i> Cetak</button>
                <button type="button" class="btn btn-danger btn-lg btn-flat" id="btn-delete-igd"
                    style="min-width:120px;"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </form>

        <div id="history-container" style="<?= !empty($asesment['no_rawat']) ? '' : 'display:none;'; ?>">
            <div class="row" style="margin-top: 40px; margin-bottom: 20px;">
                <div class="col-md-12">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-check-square-o"></i> Riwayat Asesmen Aktif</h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Dokter</th>
                                        <th>Anamnesis</th>
                                        <th>Diagnosis Utama</th>
                                        <th style="width: 150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align:middle;" data-bind="tanggal">
                                            <?= isset($asesment['tanggal']) ? date('d-m-Y H:i', strtotime($asesment['tanggal'])) : '-'; ?>
                                        </td>
                                        <td style="vertical-align:middle;"><?= $detail_pasien['nm_dokter']; ?></td>
                                        <td style="vertical-align:middle;" data-bind="anamnesis">
                                            <?= $asesment['anamnesis'] ?? ''; ?>
                                        </td>
                                        <td style="vertical-align:middle;"><span class="label label-danger"
                                                style="font-size:12px;"
                                                data-bind="diagnosis_short"><?= isset($asesment['diagnosis']) ? substr($asesment['diagnosis'], 0, 50) . '...' : ''; ?></span>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <button type="button" class="btn btn-info btn-sm btn-flat"
                                                data-toggle="modal" data-target="#modal-detail-igd"
                                                title="Lihat Detail"><i class="fa fa-eye"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                id="btn-print-table" title="Cetak"><i class="fa fa-print"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                id="btn-delete-table" title="Hapus"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="modal-detail-igd">
                <div class="modal-dialog modal-lg" style="width: 90%;">
                    <div class="modal-content" style="border-radius: 5px;">
                        <div class="modal-header bg-blue"
                            style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="color:white; opacity:1;">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-file-medical-alt"></i> Detail Asesmen IGD Pasien
                            </h4>
                        </div>
                        <div class="modal-body" style="background: #ecf0f5;">

                            <div class="row">
                                <!-- Kolom Kiri: Vital & Riwayat -->
                                <div class="col-md-5">
                                    <!-- Tanda Vital -->
                                    <div class="box box-widget widget-user-2">
                                        <div class="widget-user-header bg-aqua-active">
                                            <div class="widget-user-image">
                                                <img class="img-circle"
                                                    src="<?= base_url('assets/dist/img/avatar5.png'); ?>"
                                                    alt="User Avatar" style="background:#fff;">
                                            </div>
                                            <h3 class="widget-user-username" style="font-size: 18px;">
                                                <?= $detail_pasien['nm_pasien']; ?>
                                            </h3>
                                            <h5 class="widget-user-desc">No. RM: <?= $detail_pasien['no_rkm_medis']; ?>
                                            </h5>
                                        </div>
                                        <div class="box-footer no-padding">
                                            <ul class="nav nav-stacked">
                                                <li><a href="#">Keadaan Umum <span class="pull-right badge bg-blue"
                                                            data-bind="keadaan"><?= $asesment['keadaan'] ?? ''; ?></span></a>
                                                </li>
                                                <li><a href="#">Kesadaran <span class="pull-right badge bg-blue"><span
                                                                data-bind="kesadaran"><?= $asesment['kesadaran'] ?? ''; ?></span>
                                                            (GCS: <span
                                                                data-bind="gcs"><?= $asesment['gcs'] ?? ''; ?></span>)</span></a>
                                                </li>
                                                <li><a href="#">Tekanan Darah <span
                                                            class="pull-right badge bg-aqua"><span
                                                                data-bind="td"><?= $asesment['td'] ?? ''; ?></span>
                                                            mmHg</span></a></li>
                                                <li><a href="#">Nadi <span class="pull-right badge bg-aqua"><span
                                                                data-bind="nadi"><?= $asesment['nadi'] ?? ''; ?></span>
                                                            x/m</span></a></li>
                                                <li><a href="#">RR (Napas) <span class="pull-right badge bg-aqua"><span
                                                                data-bind="rr"><?= $asesment['rr'] ?? ''; ?></span>
                                                            x/m</span></a></li>
                                                <li><a href="#">Suhu <span class="pull-right badge bg-red"><span
                                                                data-bind="suhu"><?= $asesment['suhu'] ?? ''; ?></span>
                                                            °C</span></a></li>
                                                <li><a href="#">SpO2 <span class="pull-right badge bg-green"><span
                                                                data-bind="spo2"><?= $asesment['spo'] ?? ($asesment['spo2'] ?? '-'); ?></span>
                                                            %</span></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-history"></i> Riwayat Kesehatan</h3>
                                        </div>
                                        <div class="box-body">
                                            <strong><i class="fa fa-commenting-o margin-r-5"></i> Keluhan Utama</strong>
                                            <p class="text-muted" data-bind="keluhan_utama">
                                                <?= $asesment['keluhan_utama'] ?? ''; ?>
                                            </p>
                                            <hr style="margin: 10px 0;">
                                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Riwayat Penyakit
                                                Sekarang</strong>
                                            <p class="text-muted" data-bind="rps"><?= $asesment['rps'] ?? ''; ?></p>
                                            <hr style="margin: 10px 0;">
                                            <strong><i class="fa fa-history margin-r-5"></i> Riwayat Penyakit
                                                Dahulu</strong>
                                            <p class="text-muted" data-bind="rpd"><?= $asesment['rpd'] ?? ''; ?></p>
                                            <hr style="margin: 10px 0;">
                                            <strong><i class="fa fa-warning margin-r-5"></i> Alergi</strong>
                                            <p class="text-danger" data-bind="alergi"><?= $asesment['alergi'] ?? ''; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kolom Kanan: Diagnosis & Lokalis -->
                                <div class="col-md-7">
                                    <!-- Callout Diagnosis -->
                                    <div class="callout callout-danger" style="border-left-width: 5px;">
                                        <h4 style="margin-bottom: 5px;"><i class="fa fa-stethoscope"></i> Diagnosis
                                            Kerja
                                        </h4>
                                        <p style="font-size: 16px;" data-bind="diagnosis">
                                            <?= $asesment['diagnosis'] ?? ''; ?>
                                        </p>
                                    </div>

                                    <!-- Status Lokalis & Penunjang -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_lokalis" data-toggle="tab">Status
                                                    Lokalis</a>
                                            </li>
                                            <li><a href="#tab_penunjang" data-toggle="tab">Pemeriksaan Penunjang</a>
                                            </li>
                                            <li><a href="#tab_tatalaksana" data-toggle="tab">Tatalaksana</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_lokalis">
                                                <p class="lead" style="font-size:14px; margin-bottom:10px;"
                                                    data-bind="ket_lokalis"><?= $asesment['ket_lokalis'] ?? ''; ?></p>
                                                <div class="text-center"
                                                    style="background: #fff; border: 1px solid #f4f4f4; padding: 10px;">
                                                    <img id="img_lokalis_view"
                                                        src="<?= isset($asesment['no_rawat']) && file_exists(FCPATH . 'assets/images/lokalis_igd/lokalis_' . str_replace('/', '', $asesment['no_rawat']) . '.png') ? base_url('assets/images/lokalis_igd/lokalis_' . str_replace('/', '', $asesment['no_rawat']) . '.png') : ''; ?>"
                                                        class="img-responsive"
                                                        style="max-height:300px; margin: 0 auto; display: <?= isset($asesment['no_rawat']) ? 'block' : 'none'; ?>">
                                                    <div id="no_img_lokalis" class="alert alert-warning"
                                                        style="display: <?= isset($asesment['no_rawat']) ? 'none' : 'block'; ?>">
                                                        Tidak ada gambar status lokalis.</div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_penunjang">
                                                <ul class="products-list product-list-in-box">
                                                    <li class="item">
                                                        <div class="product-img"><i
                                                                class="fa fa-heartbeat fa-2x text-red"></i></div>
                                                        <div class="product-info"><a href="javascript:void(0)"
                                                                class="product-title">EKG</a>
                                                            <span class="product-description"
                                                                data-bind="ekg"><?= $asesment['ekg'] ?? '-'; ?></span>
                                                        </div>
                                                    </li>
                                                    <li class="item">
                                                        <div class="product-img"><i
                                                                class="fa fa-film fa-2x text-black"></i>
                                                        </div>
                                                        <div class="product-info"><a href="javascript:void(0)"
                                                                class="product-title">Radiologi</a>
                                                            <span class="product-description"
                                                                data-bind="rad"><?= $asesment['rad'] ?? '-'; ?></span>
                                                        </div>
                                                    </li>
                                                    <li class="item">
                                                        <div class="product-img"><i
                                                                class="fa fa-flask fa-2x text-yellow"></i></div>
                                                        <div class="product-info"><a href="javascript:void(0)"
                                                                class="product-title">Laboratorium</a>
                                                            <span class="product-description"
                                                                data-bind="lab"><?= $asesment['lab'] ?? '-'; ?></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" id="tab_tatalaksana">
                                                <div class="well well-sm">
                                                    <h4 class="text-green">Rencana Tatalaksana / Terapi:</h4>
                                                    <p data-bind="tata_laksana">
                                                        <?= nl2br($asesment['tata'] ?? ($asesment['tata_laksana'] ?? '-')); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer" style="background: #f4f4f4;">
                            <button type="button" class="btn btn-default btn-flat pull-left"
                                data-dismiss="modal">Tutup</button>
                            <a href="javascript:void(0)" onclick="$('#btn-print-igd').click()"
                                class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Cetak Dokumen PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Bind buttons in table to main actions
                $('#btn-print-table').click(function () {
                    var nr = $('#igd_no_rawat').val();
                    var t = new Date().getTime();
                    window.open("<?= base_url('AwalMedisIGDController/print_pdf?no_rawat='); ?>" + nr + "&t=" + t, '_blank');
                });
                $('#btn-delete-table').click(function () { $('#btn-delete-igd').click(); });
            </script>
        </div>

        <script>
            $(document).ready(function () {
                initCanvas();

                $('#btn-save-igd').click(function () {
                    // Save logic with Canvas
                    saveCanvas();

                    const data = $('#form-awal-igd').serialize();
                    const btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

                    $.post('<?= base_url("AwalMedisIGDController/save") ?>', data, function (res) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');

                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Berhasil',
                                text: res.message,
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            });

                            // SMOOTH UPDATE UI WITHOUT REFRESH
                            $('#history-container').fadeIn();

                            // Update Data bindings
                            $('[data-bind]').each(function () {
                                var field = $(this).data('bind');
                                var val = $('[name="' + field + '"]').val();

                                // Special case for diagnosis_short
                                if (field === 'diagnosis_short') {
                                    var diag = $('[name="diagnosis"]').val();
                                    $(this).text(diag.length > 50 ? diag.substring(0, 50) + '...' : diag);
                                }
                                else {
                                    $(this).text(val ? val : '-');
                                }
                            });

                            // Update Image Lokalis
                            var canvasData = document.getElementById('lokalisCanvas').toDataURL();
                            $('#img_lokalis_view').attr('src', canvasData).show();
                            $('#no_img_lokalis').hide();

                            // Scroll to bottom
                            $('html, body').animate({
                                scrollTop: $("#history-container").offset().top
                            }, 1000);

                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }, 'json').fail(function (xhr) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                        Swal.fire('Error', 'Terjadi kesalahan sistem: ' + xhr.responseText, 'error');
                    });
                });

                $('#btn-print-igd').click(function () {
                    var no_rawat = $('#igd_no_rawat').val();
                    window.open('<?= base_url("AwalMedisIGDController/print_pdf?no_rawat=") ?>' + no_rawat, '_blank');
                });

                $('#btn-delete-igd').click(function () {
                    Swal.fire({
                        title: 'Hapus Asesmen?',
                        text: "Data akan dihapus permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('<?= base_url("AwalMedisIGDController/delete") ?>', { no_rawat: $('#igd_no_rawat').val() }, function (res) {
                                if (res.status === 'success') {
                                    Swal.fire('Terhapus', 'Data berhasil dihapus', 'success').then(() => location.reload()); // Delete still needs reload to clear inputs effectively or reset form
                                } else {
                                    Swal.fire('Gagal', res.message, 'error');
                                }
                            }, 'json');
                        }
                    });
                });
            });
        </script>


</div>

<script>
    var canvas, ctx;
    var isDrawing = false;
    var lastX = 0;
    var lastY = 0;

    $(document).ready(function () {
        // Real-time Clock for Time Picker
        <?php if (!isset($asesment['tanggal'])): ?>
            setInterval(function () {
                var now = new Date();
                var h = now.getHours().toString().padStart(2, '0');
                var m = now.getMinutes().toString().padStart(2, '0');
                var s = now.getSeconds().toString().padStart(2, '0');
                $('#jam_input').val(h + ':' + m + ':' + s);
            }, 1000);
        <?php endif; ?>

        initCanvas();

        // Update UI Helper
        function updateUIFromForm() {
            // Table updates
            $('[data-bind="tanggal"]').text($('#jam_input').val() ? $('.datepicker').val() + ' ' + $('#jam_input').val() : $('.datepicker').val());
            $('[data-bind="anamnesis"]').text($('[name="anamnesis"]').val());
            var diag = $('[name="diagnosis"]').val();
            $('[data-bind="diagnosis_short"]').text(diag.length > 50 ? diag.substring(0, 50) + '...' : diag);

            // Modal updates
            $('[data-bind="keadaan"]').text($('[name="keadaan"]').val());
            $('[data-bind="kesadaran"]').text($('[name="kesadaran"]').val());
            $('[data-bind="gcs"]').text($('[name="gcs"]').val());
            $('[data-bind="td"]').text($('[name="td"]').val());
            $('[data-bind="nadi"]').text($('[name="nadi"]').val());
            $('[data-bind="rr"]').text($('[name="rr"]').val());
            $('[data-bind="suhu"]').text($('[name="suhu"]').val());
            $('[data-bind="spo2"]').text($('[name="spo2"]').val());

            $('[data-bind="keluhan_utama"]').text($('[name="keluhan_utama"]').val());
            $('[data-bind="rps"]').text($('[name="rps"]').val());
            $('[data-bind="rpd"]').text($('[name="rpd"]').val());
            $('[data-bind="alergi"]').text($('[name="alergi"]').val());

            $('[data-bind="diagnosis"]').text(diag);
            $('[data-bind="ket_lokalis"]').text($('[name="ket_lokalis"]').val());
            $('[data-bind="ekg"]').text($('[name="ekg"]').val());
            $('[data-bind="rad"]').text($('[name="rad"]').val());
            $('[data-bind="lab"]').text($('[name="lab"]').val());
            $('[data-bind="tata_laksana"]').html($('[name="tata_laksana"]').val().replace(/\n/g, "<br>"));

            // Update Image in Modal
            var canvasData = document.getElementById('lokalisCanvas').toDataURL('image/png');
            $('#img_lokalis_view').attr('src', canvasData).show();
            $('#no_img_lokalis').hide();
        }

        // ENTER Key Navigation
        $('#form-awal-igd').on('keydown', 'input, select', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,select,button,textarea').filter(':visible').not('[readonly],[disabled]');
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                } else {
                    // Optional: Submit if last field? Or do nothing? User said "jangan save".
                    // So do nothing.
                }
                return false;
            }
        });

        // Unbind previous handlers to prevent duplication or old code execution
        $('#btn-save-igd').off('click').on('click', function (e) {
            e.preventDefault();
            // alert('Debug: Tombol Save Diklik'); // Test to ensure new code runs

            // Validation
            var requiredFields = [
                { name: 'keluhan_utama', label: 'Keluhan Utama' },
                { name: 'keadaan', label: 'Keadaan Umum' },
                { name: 'kesadaran', label: 'Kesadaran' },
                { name: 'gcs', label: 'GCS' },
                { name: 'tb', label: 'TB (Tinggi Badan)' },
                { name: 'bb', label: 'BB (Berat Badan)' },
                { name: 'td', label: 'TD (Tekanan Darah)' },
                { name: 'nadi', label: 'Nadi' },
                { name: 'rr', label: 'RR (Respirasi)' },
                { name: 'suhu', label: 'Suhu' },
                { name: 'spo2', label: 'SpO2' }
            ];

            var emptyFields = [];
            requiredFields.forEach(function(field) {
                // Use explicit selector with trim
                var el = $('[name="' + field.name + '"]');
                var val = el.val();
                if(val === null || val === undefined || (typeof val === 'string' && val.trim() === '')) {
                     emptyFields.push(field.label);
                }
            });

            if (emptyFields.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    html: 'Mohon isi data berikut:<br><b style="color:red">' + emptyFields.join(', ') + '</b>'
                });
                return false; // Stop execution
            }

            saveCanvas();

            // DEBUG: Check if image data is populated
            var imgData = $('#lokalis_image').val();
            if(!imgData || imgData.length < 1000) {
                 console.warn("Warning: Canvas data seems empty or too small.");
            }
            
            const data = $('#form-awal-igd').serialize();
            const btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

            $.post('<?= base_url("AwalMedisIGDController/save") ?>', data, function (res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                if (res.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: res.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Smooth Update without Refresh
                    updateUIFromForm();
                    $('#history-container').fadeIn();

                    // Scroll to history to show user it's saved
                    $('html, body').animate({
                        scrollTop: $("#history-container").offset().top - 20
                    }, 500);

                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            }, 'json').fail(function (xhr) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                Swal.fire('Error', 'Terjadi kesalahan sistem: ' + xhr.responseText, 'error');
            });
        });

        $('#btn-print-igd').click(function () {
            // Auto-Save before Printing to ensure drawing is updated
            saveCanvas();

            const data = $('#form-awal-igd').serialize();
            const btn = $(this);
            const originalText = btn.html();

            btn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Memproses...');

            $.post('<?= base_url("AwalMedisIGDController/save") ?>', data, function (res) {
                btn.prop('disabled', false).html(originalText);

                if (res.status === 'success') {
                    // Update UI immediately (just like Save button)
                    updateUIFromForm();
                    $('#history-container').fadeIn();

                    // Open PDF with cache busting
                    var no_rawat = $('#igd_no_rawat').val();
                    var timestamp = new Date().getTime();
                    window.open('<?= base_url("AwalMedisIGDController/print_pdf?no_rawat=") ?>' + no_rawat + '&t=' + timestamp, '_blank');

                } else {
                    Swal.fire('Gagal', 'Gagal menyimpan data sebelum mencetak: ' + res.message, 'error');
                }
            }, 'json').fail(function (xhr) {
                btn.prop('disabled', false).html(originalText);
                Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan: ' + xhr.responseText, 'error');
            });
        });

        $('#btn-delete-igd').click(function () {
            Swal.fire({
                title: 'Hapus Asesmen?',
                text: "Data akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?= base_url("AwalMedisIGDController/delete") ?>', { no_rawat: $('#igd_no_rawat').val() }, function (res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Terhapus',
                                text: 'Data berhasil dihapus',
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            // Hide History and Reset Form
                            $('#history-container').fadeOut();
                            
                            // Manual wipe of editable fields to ensure they clear
                            // (form.reset() would restore values rendered by PHP)
                            $('#form-awal-igd').find('textarea').val('');
                            $('#form-awal-igd').find('input[type="text"]').val('');
                            $('#form-awal-igd').find('select').prop('selectedIndex', 0);
                            
                            clearCanvas();

                            // Scroll back to top
                            $('html, body').animate({ scrollTop: 0 }, 500);

                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }, 'json');
                }
            });
        });
    });

    function initCanvas() {
        canvas = document.getElementById('lokalisCanvas');
        ctx = canvas.getContext('2d');

        // Load background image
        var img = new Image();
        
        <?php
        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $saved_file = FCPATH . 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
        $saved_url = base_url('assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png');

        if (file_exists($saved_file)) {
            echo "var existingImage = '" . $saved_url . "?t=" . time() . "';";
        } else {
            echo "var existingImage = '';";
        }
        ?>

        img.onload = function () {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };

        if (existingImage) {
            img.src = existingImage;
        } else {
            // Default Anatomy Image
            img.src = '<?= base_url("assets/images/human_body_anatomy_custom.png") ?>';
        }

        // Event Listeners
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);
    }

    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function draw(e) {
        if (!isDrawing) return;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function stopDrawing() {
     isDrawing = false;
    }

    function setBrushColor(color) {
        ctx.strokeStyle = color;
        ctx.lineWidth = 2; // Default width
    }

    function clearCanvas() {
        // Reload default image
        var img = new Image();
        img.onload = function () {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };
        img.src = '<?= base_url("assets/images/human_body_anatomy_custom.png") ?>';
    }

    function saveCanvas() {
        var dataURL = canvas.toDataURL('image/png');
        $('#lokalis_image').val(dataURL);
    }
</script>
```
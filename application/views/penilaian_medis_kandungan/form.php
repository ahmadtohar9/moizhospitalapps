<!-- Penilaian Medis Kandungan - Form RME -->
<style>
    .section-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 15px;
        margin: 15px 0 10px 0;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        margin-bottom: 20px;
    }

    .card-split {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .card-split .box {
        flex: 1;
        margin-bottom: 0;
    }

    .required-field::after {
        content: " *";
        color: red;
    }

    .alert-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .card-split {
            flex-direction: column;
        }
    }
</style>

<form id="formPenilaianKandungan">
    <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
    <input type="hidden" name="kd_dokter" id="kd_dokter" value="<?= $kd_dokter ?>">
    <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">

    <!-- Tanggal & Jam -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required-field">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_only" id="tanggal_only" class="form-control input-sm"
                    value="<?= $tgl_sekarang ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required-field">Jam Pemeriksaan</label>
                <input type="time" name="jam_only" id="jam_only" class="form-control input-sm"
                    value="<?= $jam_sekarang ?>" required>
            </div>
        </div>
    </div>

    <!-- I. ANAMNESIS -->
    <div class="box box-default">
        <div class="box-header with-border"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h4 class="box-title"><i class="fa fa-stethoscope"></i> I. ANAMNESIS</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required-field">Jenis Anamnesis</label>
                        <select class="form-control input-sm" name="anamnesis" required>
                            <option value="Autoanamnesis">Autoanamnesis</option>
                            <option value="Alloanamnesis">Alloanamnesis</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hubungan (jika Alloanamnesis)</label>
                        <input type="text" class="form-control input-sm" name="hubungan">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="required-field">Keluhan Utama</label>
                <textarea class="form-control input-sm" name="keluhan_utama" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label class="required-field">Riwayat Penyakit Sekarang (RPS)</label>
                <textarea class="form-control input-sm" name="rps" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required-field">Riwayat Penyakit Dahulu (RPD)</label>
                        <textarea class="form-control input-sm" name="rpd" rows="2" required></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Riwayat Penyakit Keluarga (RPK)</label>
                        <textarea class="form-control input-sm" name="rpk" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Riwayat Pengobatan (RPO)</label>
                        <textarea class="form-control input-sm" name="rpo" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="required-field">Alergi</label>
                <input type="text" class="form-control input-sm" name="alergi"
                    placeholder="Tulis 'Tidak Ada' jika tidak ada alergi" required>
            </div>
        </div>
    </div>

    <!-- II. TANDA VITAL -->
    <div class="box box-info">
        <div class="box-header with-border" style="background: #00c0ef; color: white;">
            <h4 class="box-title"><i class="fa fa-heartbeat"></i> II. TANDA VITAL & KESADARAN</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required-field">Keadaan Umum</label>
                        <select class="form-control input-sm" name="keadaan" required>
                            <option value="Sehat">Sehat</option>
                            <option value="Sakit Ringan">Sakit Ringan</option>
                            <option value="Sakit Sedang">Sakit Sedang</option>
                            <option value="Sakit Berat">Sakit Berat</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required-field">Kesadaran</label>
                        <select class="form-control input-sm" name="kesadaran" required>
                            <option value="Compos Mentis">Compos Mentis</option>
                            <option value="Apatis">Apatis</option>
                            <option value="Somnolen">Somnolen</option>
                            <option value="Sopor">Sopor</option>
                            <option value="Koma">Koma</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>GCS</label>
                        <input type="text" class="form-control input-sm" name="gcs" placeholder="E_V_M_">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="required-field">TD (mmHg)</label>
                        <input type="text" class="form-control input-sm" name="td" placeholder="120/80" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="required-field">Nadi (x/mnt)</label>
                        <input type="number" class="form-control input-sm" name="nadi" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="required-field">RR (x/mnt)</label>
                        <input type="number" class="form-control input-sm" name="rr" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="required-field">Suhu (°C)</label>
                        <input type="number" step="0.1" class="form-control input-sm" name="suhu" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>SpO2 (%)</label>
                        <input type="number" class="form-control input-sm" name="spo">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="required-field">BB (kg)</label>
                        <input type="number" step="0.1" class="form-control input-sm" name="bb" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="required-field">TB (cm)</label>
                        <input type="number" class="form-control input-sm" name="tb" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- III & IV - Split 2 Kolom -->
    <div class="card-split">
        <!-- III. PEMERIKSAAN FISIK -->
        <div class="box box-warning">
            <div class="box-header with-border" style="background: #f39c12; color: white;">
                <h4 class="box-title"><i class="fa fa-user-md"></i> III. PEMERIKSAAN FISIK</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kepala</label>
                            <select class="form-control input-sm" name="kepala">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mata</label>
                            <select class="form-control input-sm" name="mata">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>THT</label>
                            <select class="form-control input-sm" name="tht">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gigi</label>
                            <select class="form-control input-sm" name="gigi">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thoraks</label>
                            <select class="form-control input-sm" name="thoraks">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Abdomen</label>
                            <select class="form-control input-sm" name="abdomen">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Genital</label>
                            <select class="form-control input-sm" name="genital">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ekstremitas</label>
                            <select class="form-control input-sm" name="ekstremitas">
                                <option value="Normal">Normal</option>
                                <option value="Abnormal">Abnormal</option>
                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan Fisik</label>
                    <textarea class="form-control input-sm" name="ket_fisik" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- IV. PEMERIKSAAN OBSTETRI -->
        <div class="box box-success">
            <div class="box-header with-border" style="background: #00a65a; color: white;">
                <h4 class="box-title"><i class="fa fa-female"></i> IV. OBSTETRI</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>TFU (cm)</label>
                    <input type="text" class="form-control input-sm" name="tfu">
                </div>

                <div class="form-group">
                    <label>TBJ (gram)</label>
                    <input type="text" class="form-control input-sm" name="tbj">
                </div>

                <div class="form-group">
                    <label>DJJ (x/mnt)</label>
                    <input type="text" class="form-control input-sm" name="djj">
                </div>

                <div class="form-group">
                    <label>Kontraksi/His</label>
                    <select class="form-control input-sm" name="kontraksi">
                        <option value="Tidak">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keterangan His</label>
                    <input type="text" class="form-control input-sm" name="his" placeholder="Contoh: 3x/10 menit">
                </div>
            </div>
        </div>
    </div>

    <!-- V & VI - Split 2 Kolom -->
    <div class="card-split">
        <!-- V. PEMERIKSAAN GINEKOLOGI -->
        <div class="box box-danger">
            <div class="box-header with-border" style="background: #dd4b39; color: white;">
                <h4 class="box-title"><i class="fa fa-venus"></i> V. GINEKOLOGI</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Inspeksi Vulva</label>
                    <textarea class="form-control input-sm" name="inspeksi" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>Inspekulo</label>
                    <textarea class="form-control input-sm" name="inspekulo" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>VT (Vaginal Toucher)</label>
                    <textarea class="form-control input-sm" name="vt" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>RT (Rectal Toucher)</label>
                    <textarea class="form-control input-sm" name="rt" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- VI. PEMERIKSAAN PENUNJANG -->
        <div class="box box-primary">
            <div class="box-header with-border" style="background: #3c8dbc; color: white;">
                <h4 class="box-title"><i class="fa fa-flask"></i> VI. PENUNJANG</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>USG</label>
                    <textarea class="form-control input-sm" name="ultra" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>Kardiotokografi (CTG)</label>
                    <textarea class="form-control input-sm" name="kardio" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label>Laboratorium</label>
                    <textarea class="form-control input-sm" name="lab" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- VII. DIAGNOSIS & TATALAKSANA -->
    <div class="box box-default">
        <div class="box-header with-border"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h4 class="box-title"><i class="fa fa-medkit"></i> VII. DIAGNOSIS & TATALAKSANA</h4>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Diagnosis</label>
                <textarea class="form-control input-sm" name="diagnosis" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label>Tatalaksana</label>
                <textarea class="form-control input-sm" name="tata" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Konsultasi / Rujukan</label>
                <textarea class="form-control input-sm" name="konsul" rows="2"></textarea>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-success" id="btnCopyLast">
                <i class="fa fa-copy"></i> Copy Data Terakhir
            </button>
            <button type="submit" class="btn btn-primary" id="btnSimpan">
                <i class="fa fa-save"></i> Simpan
            </button>
            <button type="button" class="btn btn-default" id="btnReset">
                <i class="fa fa-refresh"></i> Reset
            </button>
        </div>
    </div>
</form>

<hr>

<!-- Tabel Hasil -->
<div class="box box-success">
    <div class="box-header with-border">
        <h4 class="box-title"><i class="fa fa-list"></i> Riwayat Penilaian</h4>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="tblHasil">
                <thead>
                    <tr class="bg-light-blue">
                        <th width="15%">Tanggal</th>
                        <th width="20%">Dokter</th>
                        <th>Diagnosis</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-text"></i> Detail Penilaian Kandungan</h4>
            </div>
            <div class="modal-body" id="detailContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Alert Container -->
<div id="alertContainer"></div>

<!-- Load JavaScript -->
<script src="<?= base_url('assets/js/penilaian_medis_kandungan.js?v=' . time()) ?>"></script>
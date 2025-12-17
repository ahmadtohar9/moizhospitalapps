<div class="row">
    <style>
        .select2-container {
            z-index: 0 !important;
        }
    </style>
    <!-- Form Section -->
    <div class="col-md-7">
        <div class="card shadow-sm border-primary mb-4">
            <div class="card-header bg-primary text-white py-2">
                <h6 class="m-0"><i class="fa fa-file-medical-alt"></i> Form Program Rehab Medik (KFR)</h6>
            </div>
            <div class="card-body">
                <form id="formulirKfrForm">
                    <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
                    <input type="hidden" name="original_jam_rawat" id="original_jam_rawat">

                    <!-- Baris 1: Waktu & Dokter -->
                    <div class="row mb-3 bg-light p-2 rounded shadow-sm mx-1">
                        <div class="col-md-2">
                            <label class="form-label mb-1 text-muted small font-weight-bold">Tanggal</label>
                            <input type="date" name="tgl_perawatan" id="tgl_perawatan"
                                class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1 text-muted small font-weight-bold">Jam</label>
                            <input type="time" name="jam_rawat" id="jam_rawat" step="1"
                                class="form-control form-control-sm">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label mb-1 text-muted small font-weight-bold">Dokter Sp.KFR</label>
                            <select class="form-control form-control-sm select2" name="kd_dokter" id="kd_dokter"
                                data-placeholder="Pilih Dokter Sp.KFR">
                                <option value="">-- Cari Dokter --</option>
                                <?php foreach ($dokters as $d): ?>
                                    <option value="<?= $d['kd_dokter'] ?>" <?= ($d['kd_dokter'] == $kd_dokter) ? 'selected' : '' ?>>
                                        <?= $d['nm_dokter'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 2: S & O -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-danger"><i class="fa fa-user"></i> Subjective
                                    (S)</label>
                                <textarea class="form-control" name="subjective" id="subjective" rows="4"
                                    placeholder="Keluhan / Anamnesis Subjektif..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-primary"><i class="fa fa-stethoscope"></i> Objective
                                    (O)</label>
                                <textarea class="form-control" name="objective" id="objective" rows="4"
                                    placeholder="Hasil Pemeriksaan Objektif..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 3: Assessment -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-success"><i class="fa fa-notes-medical"></i> Assessment
                            (A)</label>
                        <textarea class="form-control" name="assessment" id="assessment" rows="3"
                            placeholder="Diagnosa / Penilaian Medis..."></textarea>
                    </div>

                    <!-- Baris 4: Planning / Protokol Terapi Header -->
                    <div class="card mb-3 border-warning" style="border-left: 5px solid #ffc107;">
                        <div class="card-header bg-white py-2">
                            <h6 class="m-0 font-weight-bold text-warning text-dark"><i class="fa fa-list-alt"></i>
                                Planning / Protokol Terapi (P)</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small font-weight-bold">a. Goal of Treatment</label>
                                        <textarea class="form-control form-control-sm" name="goal_of_treatment"
                                            id="goal_of_treatment" rows="3"
                                            placeholder="Tujuan pengobatan..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small font-weight-bold">b. Tindakan / Program Rehab</label>
                                        <textarea class="form-control form-control-sm" name="tindakan_rehab"
                                            id="tindakan_rehab" rows="3"
                                            placeholder="Program terapi yang dilakukan..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="small font-weight-bold">c. Edukasi</label>
                                        <textarea class="form-control form-control-sm" name="edukasi" id="edukasi"
                                            rows="2" placeholder="Edukasi kepada pasien..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="small font-weight-bold">d. Frekuensi Kunjungan</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="frekuensi_kunjungan" id="frekuensi_kunjungan"
                                            placeholder="Contoh: 2x seminggu">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 5: Rencana Tindak Lanjut -->
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-info"><i class="fa fa-forward"></i> Rencana Tindak
                            Lanjut</label>
                        <textarea class="form-control" name="rencana_tindak_lanjut" id="rencana_tindak_lanjut" rows="2"
                            placeholder="Evaluasi / Rujuk / Selesai..."></textarea>
                    </div>

                    <!-- Tanda Tangan Dokter -->
                    <div class="form-group mb-3 mt-4">
                        <label class="font-weight-bold text-dark"><i class="fa fa-signature"></i> Tanda Tangan
                            Dokter</label>
                        <div class="border rounded p-3 bg-light">
                            <canvas id="signaturePad"
                                style="border: 2px dashed #007bff; background: white; width: 100%; height: 150px; cursor: crosshair;"></canvas>
                            <input type="hidden" name="ttd_dokter" id="ttd_dokter">
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-warning" id="clearSignature">
                                    <i class="fa fa-eraser"></i> Hapus Tanda Tangan
                                </button>
                                <small class="text-muted ml-2">Tanda tangan di area putih di atas</small>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4 pt-2 border-top">
                        <button type="button" class="btn btn-secondary btn-sm" id="btnCancel"><i class="fa fa-undo"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4"><i class="fa fa-save"></i> Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- History list -->
    <div class="col-md-5">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white py-2">
                <h6 class="m-0"><i class="fa fa-history"></i> Riwayat Formulir KFR</h6>
            </div>
            <div class="card-body p-0" style="max-height: 700px; overflow-y: auto;">
                <div class="list-group list-group-flush" id="historyList">
                    <div class="p-3 text-center text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat riwayat...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail -->
<div class="modal fade" id="modalLihatKfr" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fa fa-file-medical-alt"></i> Detail Formulir KFR</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-size: 1.1rem;">
                <!-- Content will be populated by JS -->
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-6"><strong><i class="fa fa-clock-o"></i> Waktu:</strong> <span
                            id="view_waktu">-</span></div>
                    <div class="col-md-6"><strong><i class="fa fa-user-md"></i> Dokter:</strong> <span
                            id="view_dokter">-</span></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>S:</strong> <span id="view_s"></span></p>
                        <p><strong>O:</strong> <span id="view_o"></span></p>
                        <p><strong>A:</strong> <span id="view_a"></span></p>
                    </div>
                    <div class="col-md-6 bg-light p-2 rounded">
                        <h6 class="text-warning font-weight-bold">Planning</h6>
                        <ul class="list-unstyled mb-0">
                            <li><strong>Goal:</strong> <span id="view_goal"></span></li>
                            <li><strong>Tindakan:</strong> <span id="view_tindakan"></span></li>
                            <li><strong>Edukasi:</strong> <span id="view_edukasi"></span></li>
                            <li><strong>Frekuensi:</strong> <span id="view_frek"></span></li>
                            <li class="mt-2 border-top pt-1"><strong>Lanjut:</strong> <span
                                    id="view_plan_lanjut"></span></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>var SITE_URL = "<?= site_url() ?>";</script>
<script src="<?= base_url('assets/js/formulir_kfr.js') ?>"></script>
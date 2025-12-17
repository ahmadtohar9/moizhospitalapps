<div class="row">
    <style>
        /* Fix Select2 muncul diatas SweetAlert/Modal */
        .select2-container {
            z-index: 0 !important;
        }

        /* Pastikan dropdown select2 (hasil pencarian) tetap muncul diatas form tapi dibawah swal jika perlu, 
           tapi z-index 0 di container biasanya cukup aman buat container inputnya. 
           Untuk dropdown-nya (list option), select2 biasanya handle sendiri di body. */
    </style>
    <!-- Form Section -->
    <div class="col-md-7">
        <div class="card shadow-sm border-primary mb-4">
            <div class="card-header bg-primary text-white py-2">
                <h5 class="m-0"><i class="fa fa-notes-medical"></i> Form Program Rehab Medik</h5>
            </div>
            <div class="card-body">
                <form id="rehabForm">
                    <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
                    <input type="hidden" name="original_jam_rawat" id="original_jam_rawat">

                    <!-- Baris 1: Waktu & Petugas -->
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label for="tgl_perawatan" class="form-label mb-1 text-muted small">Tanggal</label>
                                <input type="date" name="tgl_perawatan" id="tgl_perawatan"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label for="jam_rawat" class="form-label mb-1 text-muted small">Jam</label>
                                <input type="time" name="jam_rawat" id="jam_rawat" step="1"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="form-label mb-1 text-muted small">Dokter Sp.KFR</label>
                                <select class="form-control form-control-sm select2" name="kd_dokter" id="kd_dokter"
                                    data-placeholder="Cari Dokter...">
                                    <option value="">-- Cari Dokter --</option>
                                    <?php foreach ($dokters as $d): ?>
                                        <option value="<?= $d['kd_dokter'] ?>" <?= ($d['kd_dokter'] == $kd_dokter) ? 'selected' : '' ?>>
                                            <?= $d['nm_dokter'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="form-label mb-1 text-muted small">Tim Rehabilitasi Medik</label>
                                <?php $current_nip = $this->session->userdata('user_nip'); ?>
                                <select class="form-control form-control-sm select2" name="nip_tim_rehab"
                                    id="nip_tim_rehab" data-placeholder="Cari Petugas...">
                                    <option value="">-- Cari Petugas --</option>
                                    <?php foreach ($petugas as $p): ?>
                                        <option value="<?= $p['nip'] ?>" <?= ($p['nip'] == $current_nip) ? 'selected' : '' ?>>
                                            <?= $p['nama'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-3">

                    <!-- TTV (Tanda-Tanda Vital) -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="font-weight-bold text-info mb-2"><i class="fa fa-heartbeat"></i> Tanda-Tanda
                                Vital (TTV)</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">Tensi (mmHg)</label>
                                <input type="text" name="tensi" id="tensi" class="form-control form-control-sm"
                                    placeholder="120/80">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">Nadi (x/mnt)</label>
                                <input type="number" name="nadi" id="nadi" class="form-control form-control-sm"
                                    placeholder="80">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">Suhu (°C)</label>
                                <input type="number" step="0.1" name="suhu_tubuh" id="suhu_tubuh"
                                    class="form-control form-control-sm" placeholder="36.5">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">RR (x/mnt)</label>
                                <input type="number" name="respirasi" id="respirasi"
                                    class="form-control form-control-sm" placeholder="20">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">SpO2 (%)</label>
                                <input type="number" name="spo2" id="spo2" class="form-control form-control-sm"
                                    placeholder="98">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">Tinggi (cm)</label>
                                <input type="number" step="0.1" name="tinggi" id="tinggi"
                                    class="form-control form-control-sm" placeholder="170">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">Berat (Kg)</label>
                                <input type="number" step="0.1" name="berat" id="berat"
                                    class="form-control form-control-sm" placeholder="70">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label mb-1 text-muted small">GCS</label>
                                <input type="text" name="gcs" id="gcs" class="form-control form-control-sm"
                                    placeholder="E4V5M6">
                            </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-3">

                    <!-- SOAP Fields Grid -->
                    <div class="row">
                        <!-- Kolom Kiri: S & O -->
                        <div class="col-md-6 border-right">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-danger">Subjective (S)</label>
                                <textarea class="form-control" name="subjective" id="subjective" rows="5"
                                    placeholder="Keluhan / Anamnesis Subjektif..."></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-primary">Objective (O)</label>
                                <textarea class="form-control" name="objective" id="objective" rows="5"
                                    placeholder="Hasil Pemeriksaan Objektif..."></textarea>
                            </div>
                        </div>

                        <!-- Kolom Kanan: A & P -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-success">Assessment (A)</label>
                                <textarea class="form-control" name="assessment" id="assessment" rows="5"
                                    placeholder="Diagnosa / Penilaian..."></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-warning">Procedure / Plan (P)</label>
                                <textarea class="form-control" name="procedure_text" id="procedure_text" rows="5"
                                    placeholder="Tindakan / Rencana Terapi..."></textarea>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-3">

                    <!-- Instruksi & Evaluasi -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-secondary"><i class="fa fa-clipboard-list"></i>
                                    Instruksi</label>
                                <textarea class="form-control" name="instruksi" id="instruksi" rows="4"
                                    placeholder="Instruksi untuk pasien..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-dark"><i class="fa fa-check-circle"></i>
                                    Evaluasi</label>
                                <textarea class="form-control" name="evaluasi" id="evaluasi" rows="4"
                                    placeholder="Evaluasi hasil terapi..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-3 pt-2 border-top">
                        <button type="button" class="btn btn-secondary btn-sm" id="btnCancel"><i class="fa fa-undo"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan
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
                <h6 class="m-0"><i class="fa fa-history"></i> Riwayat Rehab Medik</h6>
            </div>
            <div class="card-body p-0" style="max-height: 700px; overflow-y: auto;">
                <div class="list-group list-group-flush" id="historyList">
                    <!-- Diisi JS -->
                    <div class="p-3 text-center text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat riwayat...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail -->
<div class="modal fade" id="modalLihatRehab" tabindex="-1" role="dialog" aria-labelledby="modalLihatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalLihatLabel"><i class="fa fa-file-medical-alt"></i> Detail Rehab Medik
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 1.1rem;">
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar"></i> Waktu:</strong> <span id="view_waktu">-</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="font-weight-bold text-muted">Dokter Sp.KFR</label>
                        <div id="view_dokter" class="font-weight-bold">-</div>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold text-muted">Tim Rehab Medik</label>
                        <div id="view_petugas" class="font-weight-bold">-</div>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-danger font-weight-bold">Subjective (S)</label>
                            <p id="view_s" class="mb-0" style="white-space: pre-wrap;">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-primary font-weight-bold">Objective (O)</label>
                            <p id="view_o" class="mb-0" style="white-space: pre-wrap;">-</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-success font-weight-bold">Assessment (A)</label>
                            <p id="view_a" class="mb-0" style="white-space: pre-wrap;">-</p>
                        </div>
                        <div>
                            <label class="text-warning font-weight-bold">Plan / Procedure (P)</label>
                            <p id="view_p" class="mb-0" style="white-space: pre-wrap;">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    var SITE_URL = "<?= site_url() ?>";
</script>
<script src="<?= base_url('assets/js/rehab_medik.js') ?>"></script>
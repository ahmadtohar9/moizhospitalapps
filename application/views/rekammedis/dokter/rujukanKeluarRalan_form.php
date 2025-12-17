<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <!-- ================= LEFT: FORM INPUT ================= -->
  <div class="col-md-7">
    <div class="card shadow-sm border-primary mb-4">
      <div class="card-header bg-primary text-white py-2">
        <h5 class="m-0"><i class="fa fa-share-square"></i> Surat Rujukan Keluar</h5>
      </div>
      <div class="card-body">
        <form id="rujukanKeluarForm" method="POST" autocomplete="off">
          <?php if (isset($this->security)) : ?>
            <input type="hidden"
                   name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
          <?php endif; ?>

          <!-- Hidden keys -->
          <input type="hidden" id="rk_id" value="<?= isset($existing['id']) ? (int)$existing['id'] : '' ?>">
          <input type="hidden" name="no_rawat" id="rk_no_rawat" value="<?= $no_rawat ?>">
          <input type="hidden" name="kd_dokter" id="rk_kd_dokter" value="<?= $kd_dokter ?>">
          <input type="hidden" id="rk_no_rkm_medis" value="<?= $no_rkm_medis ?>">

          <!-- Dokter & Poli -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label><i class="fa fa-user-md"></i> Dokter Pemeriksa</label>
                <input type="text" class="form-control" value="<?= html_escape($detail_pasien['nm_dokter'] ?? '') ?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label><i class="fa fa-hospital-o"></i> Poliklinik</label>
                <input type="text" class="form-control" value="<?= html_escape($detail_pasien['nm_poli'] ?? ($detail_pasien['poli'] ?? '')) ?>" readonly>
              </div>
            </div>
          </div>

          <!-- No Surat -->
          <div class="form-group mb-2">
            <label><i class="fa fa-hashtag"></i> No. Surat</label>
            <input type="text" id="rk_no_surat" class="form-control" value="<?= html_escape($existing['no_surat'] ?? '') ?>" readonly>
          </div>

          <!-- Tanggal Surat -->
          <div class="form-group mb-3">
            <label><i class="fa fa-calendar"></i> Tanggal Surat</label>
            <input type="date" name="tgl_surat" id="rk_tgl_surat" class="form-control"
                   value="<?= html_escape($existing['tgl_surat'] ?? date('Y-m-d')) ?>">
          </div>

          <!-- Tujuan Rujukan -->
          <div class="form-group mb-2">
            <label><i class="fa fa-user-md"></i> Kepada Yth. Dokter</label>
            <input type="text" name="kepada_dokter" id="rk_kepada_dokter" class="form-control"
                   value="<?= html_escape($existing['kepada_dokter'] ?? '') ?>">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label><i class="fa fa-stethoscope"></i> Spesialis Tujuan</label>
                <input type="text" name="spesialis_tujuan" id="rk_spesialis_tujuan" class="form-control"
                       value="<?= html_escape($existing['spesialis_tujuan'] ?? '') ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label><i class="fa fa-hospital"></i> RS / Klinik Tujuan</label>
                <input type="text" name="rs_tujuan" id="rk_rs_tujuan" class="form-control"
                       value="<?= html_escape($existing['rs_tujuan'] ?? '') ?>">
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-map-marker"></i> Alamat Tujuan</label>
            <textarea name="alamat_tujuan" id="rk_alamat_tujuan" class="form-control" rows="2"
                      placeholder="Alamat lengkap RS / Klinik tujuan..."><?= html_escape($existing['alamat_tujuan'] ?? '') ?></textarea>
          </div>

          <!-- Isi Medis -->
          <div class="form-group mb-3">
            <label><i class="fa fa-notes-medical"></i> Alasan / Ringkasan Rujukan</label>
            <textarea name="alasan_rujuk" id="rk_alasan_rujuk" class="form-control" rows="3"
                      placeholder="Tuliskan alasan rujukan pasien..."><?= html_escape($existing['alasan_rujuk'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-comment-medical"></i> Anamnesa</label>
            <textarea name="anamnesa" id="rk_anamnesa" class="form-control" rows="2"><?= html_escape($existing['anamnesa'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-heartbeat"></i> Pemeriksaan Fisik</label>
            <textarea name="pemeriksaan_fisik" id="rk_pemeriksaan_fisik" class="form-control" rows="2"><?= html_escape($existing['pemeriksaan_fisik'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-flask"></i> Pemeriksaan Penunjang</label>
            <textarea name="pemeriksaan_penunjang" id="rk_pemeriksaan_penunjang" class="form-control" rows="2"><?= html_escape($existing['pemeriksaan_penunjang'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-diagnoses"></i> Diagnosa Sementara</label>
            <textarea name="diagnosa_sementara" id="rk_diagnosa" class="form-control" rows="2"><?= html_escape($existing['diagnosa_sementara'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-hand-holding-medical"></i> Tindakan yang Telah Dilakukan</label>
            <textarea name="tindakan" id="rk_tindakan" class="form-control" rows="2"><?= html_escape($existing['tindakan'] ?? '') ?></textarea>
          </div>

          <div class="form-group mb-3">
            <label><i class="fa fa-pills"></i> Obat yang Diberikan</label>
            <textarea name="obat" id="rk_obat" class="form-control" rows="2"><?= html_escape($existing['obat'] ?? '') ?></textarea>
          </div>

          <!-- Wali -->
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="1" id="rk_is_guardian"
                   name="is_signed_by_guardian" <?= !empty($existing['is_signed_by_guardian']) ? 'checked' : '' ?>>
            <label class="form-check-label" for="rk_is_guardian">Ditandatangani oleh wali pasien</label>
          </div>

          <div id="guardian_fields" style="<?= empty($existing['is_signed_by_guardian']) ? 'display:none;' : '' ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label>Nama Wali</label>
                  <input type="text" name="nama_wali" id="rk_nama_wali" class="form-control"
                         value="<?= html_escape($existing['nama_wali'] ?? '') ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label>Hubungan Wali</label>
                  <input type="text" name="hubungan_wali" id="rk_hubungan_wali" class="form-control"
                         placeholder="Ayah / Ibu / Suami / Istri / Anak"
                         value="<?= html_escape($existing['hubungan_wali'] ?? '') ?>">
                </div>
              </div>
            </div>
          </div>

          <!-- Tombol -->
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success btn-sm" id="btnRKSave">
              <i class="fa fa-save"></i> Simpan
            </button>
            <button type="submit" class="btn btn-primary btn-sm" id="btnRKUpdate" style="display:none">
              <i class="fa fa-save"></i> Update
            </button>
            <button type="button" id="btnRKCancel" class="btn btn-secondary btn-sm">
              <i class="fa fa-times"></i> Batal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ================= RIGHT: STATUS, TTD, AKSI ================= -->
  <div class="col-md-5">

    <!-- Status -->
    <div class="card shadow-sm border-info mb-3">
      <div class="card-header bg-info text-white py-2">
        <h6 class="m-0"><i class="fa fa-info-circle"></i> Status Surat Rujukan Keluar</h6>
      </div>
      <div class="card-body p-3">
        <div id="statusRujukan" class="alert alert-warning mb-2">
          Belum ada surat rujukan keluar untuk <strong><?= html_escape($no_rawat) ?></strong>.
        </div>
        <table class="table table-sm table-bordered mb-0">
          <tbody>
            <tr><th style="width:140px">No. Surat</th><td id="sum_no_surat">-</td></tr>
            <tr><th>Tanggal Surat</th><td id="sum_tgl_surat">-</td></tr>
            <tr><th>Dokter Tujuan</th><td id="sum_kepada_dokter">-</td></tr>
            <tr><th>RS Tujuan</th><td id="sum_rs_tujuan">-</td></tr>
            <tr><th>Final</th><td id="sum_is_final">Belum</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Aksi -->
    <div class="card shadow-sm border-secondary mb-3">
      <div class="card-header bg-secondary text-white py-2">
        <h6 class="m-0"><i class="fa fa-wrench"></i> Aksi & Preview</h6>
      </div>
      <div class="card-body p-2">
        <div class="mb-2 d-flex flex-wrap gap-2">
          <button class="btn btn-info btn-sm" id="btnRKView"><i class="fa fa-eye"></i> View</button>
          <button class="btn btn-primary btn-sm" id="btnRKTTD"><i class="fa fa-pen"></i> TTD</button>
          <button class="btn btn-warning btn-sm" id="btnRKEdit"><i class="fa fa-edit"></i> Edit</button>
          <button class="btn btn-success btn-sm" id="btnRKPrint" disabled><i class="fa fa-print"></i> Print</button>
          <button class="btn btn-danger btn-sm" id="btnRKDelete"><i class="fa fa-trash"></i> Hapus</button>
        </div>

        <div class="row">
          <div class="col-6 text-center">
            <div class="small text-muted mb-1">TTD Dokter</div>
            <img id="preview-ttd-dokter" src="" alt="TTD Dokter" style="max-width:100%;display:none;border:1px dashed #ddd;padding:4px;border-radius:6px">
          </div>
          <div class="col-6 text-center">
            <div class="small text-muted mb-1">TTD Pasien / Wali</div>
            <img id="preview-ttd-pasien" src="" alt="TTD Pasien" style="max-width:100%;display:none;border:1px dashed #ddd;padding:4px;border-radius:6px">
          </div>
        </div>
      </div>
    </div>

    <!-- Canvas Dokter -->
    <div class="card shadow-sm border-primary mb-3">
      <div class="card-header bg-primary text-white py-2">
        <h6 class="m-0"><i class="fa fa-pen"></i> Tanda Tangan Dokter</h6>
      </div>
      <div class="card-body text-center">
        <canvas id="canvasTTDDokter" width="450" height="180" style="border:1px solid #ccc;width:100%;"></canvas>
        <div class="mt-2">
          <button id="btnClearTTDDokter" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i> Ulangi</button>
          <button id="btnSaveTTDDokter" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan TTD</button>
        </div>
      </div>
    </div>

    <!-- Canvas Pasien -->
    <div class="card shadow-sm border-success">
      <div class="card-header bg-success text-white py-2">
        <h6 class="m-0"><i class="fa fa-signature"></i> Tanda Tangan Pasien / Wali</h6>
      </div>
      <div class="card-body text-center">
        <canvas id="canvasTTDPasien" width="450" height="180" style="border:1px solid #ccc;width:100%;"></canvas>
        <div class="mt-2">
          <button id="btnClearTTDPasien" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i> Ulangi</button>
          <button id="btnSaveTTDPasien" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan TTD</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SignaturePad -->
<script src="<?= base_url('assets/vendor/signature-pad/signature_pad.umd.min.js') ?>"></script>

<script>
  window.API = window.API || {};
  window.API.rujukanKeluarRalan = {
    getData:    "<?= site_url('dokter-ralan/rujukanKeluar/get'); ?>",
    save:       "<?= site_url('dokter-ralan/rujukanKeluar/save'); ?>",
    update:     "<?= site_url('dokter-ralan/rujukanKeluar/update'); ?>",
    delete:     "<?= site_url('dokter-ralan/rujukanKeluar/delete'); ?>",
    signDoctor: "<?= site_url('dokter-ralan/rujukanKeluar/sign-dokter'); ?>",
    signPatient:"<?= site_url('dokter-ralan/rujukanKeluar/sign-pasien'); ?>",
    finalize:   "<?= site_url('dokter-ralan/rujukanKeluar/finalize'); ?>",
    print:      "<?= site_url('dokter-ralan/rujukanKeluar/print'); ?>"
  };

  document.getElementById('rk_is_guardian').addEventListener('change', function() {
    var el = document.getElementById('guardian_fields');
    if (el) el.style.display = this.checked ? 'block' : 'none';
  });
</script>

<script src="<?= base_url('assets/js/dokterRalan/rujukanKeluarRalan.js?v=') . time(); ?>"></script>

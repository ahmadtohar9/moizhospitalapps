<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <!-- Kolom kiri: Form Penunjang -->
  <div class="col-md-7">
    <div class="card shadow-sm border-primary mb-4">
      <div class="card-header bg-primary text-white py-2">
        <h5 class="m-0"><i class="fa fa-stethoscope"></i> Pemeriksaan Penunjang</h5>
      </div>
      <div class="card-body">
        <form id="penunjangForm" method="POST" autocomplete="off">
          <?php if (isset($this->security)) : ?>
            <input type="hidden"
                   name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
          <?php endif; ?>

          <input type="hidden" id="id_penunjang">
          <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
          <input type="hidden" name="kd_dokter" id="kd_dokter" value="<?= $kd_dokter ?>">
          <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">

          <!-- Tanggal & Jam -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="tgl_periksa"><i class="fa fa-calendar"></i> Tanggal</label>
                <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="jam_periksa"><i class="fa fa-clock-o"></i> Jam</label>
                <input type="text" name="jam_periksa" id="jam_periksa" class="form-control" placeholder="HH:MM:SS">
              </div>
            </div>
          </div>

          <!-- Hasil Pemeriksaan -->
          <div class="form-group">
            <label for="hasil_pemeriksaan"><i class="fa fa-file-alt"></i> Hasil Pemeriksaan Penunjang</label>
            <textarea name="hasil_pemeriksaan" id="hasil_pemeriksaan" class="form-control" rows="10" placeholder="Tulis hasil pemeriksaan penunjang di sini..."></textarea>
          </div>

          <!-- Tombol -->
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success btn-sm" id="btnSavePenunjang">
              <i class="fa fa-save"></i> Simpan
            </button>
            <button type="button" class="btn btn-primary btn-sm" id="btnSignPrint">
              <i class="fa fa-pen"></i> Tanda Tangani & Cetak
            </button>
            <button type="button" id="btnCancelPenunjang" class="btn btn-secondary btn-sm">
              <i class="fa fa-times"></i> Batal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kolom kanan: Riwayat Penunjang -->
  <div class="col-md-5">
    <div class="card shadow-sm border-info mb-4">
      <div class="card-header bg-info text-white py-2">
        <h5 class="m-0"><i class="fa fa-history"></i> Riwayat Pemeriksaan Penunjang</h5>
      </div>
      <div class="card-body p-2" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-sm table-bordered table-hover">
          <thead class="thead-light">
            <tr class="text-center">
              <th>No</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="penunjang-riwayat-body" class="text-center">
            <tr><td colspan="4" class="text-muted">Belum ada data.</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Hasil Penunjang -->
<div class="card shadow-sm border-secondary">
  <div class="card-header bg-secondary text-white py-2">
    <h6 class="m-0"><i class="fa fa-file-medical"></i> Hasil Pemeriksaan Saat Ini</h6>
  </div>
  <div class="card-body p-2">
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-hover">
        <thead class="thead-light text-center">
          <tr>
            <th style="width:50px;">No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Hasil Pemeriksaan</th>
          </tr>
        </thead>
        <tbody id="hasil-penunjang-body" class="text-center">
          <tr><td colspan="4" class="text-muted">Belum ada hasil pemeriksaan.</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tanda Tangan -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/signature-pad/signature-modal.css') ?>">
<div class="modal fade" id="modalTTD" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header py-2 bg-primary text-white">
        <h5 class="modal-title"><i class="fa fa-pen"></i> Tanda Tangan Dokter</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="border" style="position:relative">
          <canvas id="canvasTTD" style="width:100%; height:280px; touch-action:none;"></canvas>
        </div>
        <small class="text-muted">Tanda tangani dengan jari/stylus. Klik Ulangi jika perlu.</small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="btnUlangiTTD"><i class="fa fa-undo"></i> Ulangi</button>
        <button class="btn btn-primary" id="btnSimpanTTD"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url('assets/vendor/signature-pad/signature_pad.umd.min.js') ?>"></script>

<script>
  window.API = window.API || {};
  window.API.penunjangRalan = {
    getData:  "<?= site_url('dokterRalan/penunjang-ralan/getByNoRawat'); ?>",
    save:     "<?= site_url('dokterRalan/penunjang-ralan/save'); ?>",
    update:   "<?= site_url('dokterRalan/penunjang-ralan/update'); ?>",
    delete:   "<?= site_url('dokterRalan/penunjang-ralan/delete'); ?>",
    print:    "<?= site_url('dokterRalan/penunjang-ralan/print'); ?>",
    sign:     "<?= site_url('dokterRalan/penunjang-ralan/sign'); ?>"  // <— endpoint TTD
  };
</script>

<script src="<?= base_url('assets/js/dokterRalan/penunjangRalan.js?v=') . time(); ?>"></script>

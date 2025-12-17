<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <!-- Kolom kiri: Form Laporan Tindakan -->
  <div class="col-md-7">
    <div class="card shadow-sm border-primary mb-4">
      <div class="card-header bg-primary text-white py-2">
        <h5 class="m-0"><i class="fa fa-user-md"></i> Laporan Tindakan Rawat Jalan</h5>
      </div>
      <div class="card-body">
        <form id="laporanTindakanForm" method="POST" autocomplete="off">
          <?php if (isset($this->security)) : ?>
            <input type="hidden"
                   name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
          <?php endif; ?>

          <!-- Hidden keys -->
          <input type="hidden" id="lt_id" value="<?= isset($existing['id']) ? (int)$existing['id'] : '' ?>">
          <input type="hidden" name="no_rawat" id="lt_no_rawat" value="<?= $no_rawat ?>">
          <input type="hidden" name="kd_dokter" id="lt_kd_dokter" value="<?= $kd_dokter ?>">
          <input type="hidden" id="lt_no_rkm_medis" value="<?= $no_rkm_medis ?>">

          <!-- Dokter, Poli, Ruangan -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-user-md"></i> Dokter Operator</label>
                <input type="text" class="form-control" value="<?= html_escape($detail_pasien['nm_dokter'] ?? '') ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-hospital-o"></i> Poliklinik</label>
                <input type="text" class="form-control" value="<?= html_escape($detail_pasien['nm_poli'] ?? ($detail_pasien['poli'] ?? '')) ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-building"></i> Ruangan</label>
                <select name="ruangan" id="lt_ruangan" class="form-control">
                  <option value="">-- Pilih Ruangan --</option>
                  <option value="UGD" <?= (isset($existing['ruangan']) && $existing['ruangan']==='UGD') ? 'selected' : '' ?>>UGD</option>
                  <option value="Ruang Tindakan" <?= (isset($existing['ruangan']) && $existing['ruangan']==='Ruang Tindakan') ? 'selected' : '' ?>>Ruang Tindakan</option>
                  <option value="Ruang Poli 1" <?= (isset($existing['ruangan']) && $existing['ruangan']==='Ruang Poli 1') ? 'selected' : '' ?>>Ruang Poli 1</option>
                  <option value="Ruang Poli 2" <?= (isset($existing['ruangan']) && $existing['ruangan']==='Ruang Poli 2') ? 'selected' : '' ?>>Ruang Poli 2</option>
                  <option value="Ruang Poli 3" <?= (isset($existing['ruangan']) && $existing['ruangan']==='Ruang Poli 3') ? 'selected' : '' ?>>Ruang Poli 3</option>
                  <option value="Ruang Poli 4" <?= (isset($existing['ruangan']) && $existing['ruangan']==='Ruang Poli 4') ? 'selected' : '' ?>>Ruang Poli 4</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Waktu Tindakan + Anestesi -->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group mb-2">
                <label for="lt_jam_mulai"><i class="fa fa-clock-o"></i> Jam Mulai</label>
                <input type="time" step="1" name="jam_mulai" id="lt_jam_mulai" class="form-control"
                       value="<?= html_escape($existing['jam_mulai'] ?? '') ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group mb-2">
                <label for="lt_jam_selesai"><i class="fa fa-clock-o"></i> Jam Selesai</label>
                <input type="time" step="1" name="jam_selesai" id="lt_jam_selesai" class="form-control"
                       value="<?= html_escape($existing['jam_selesai'] ?? '') ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="lt_jenis_anastesi"><i class="fa fa-medkit"></i> Jenis Anestesi</label>
                <input type="text" name="jenis_anastesi" id="lt_jenis_anastesi" class="form-control"
                       placeholder="Mis. Lokal / General / Tanpa"
                       value="<?= html_escape($existing['jenis_anastesi'] ?? '') ?>">
              </div>
            </div>
          </div>

          <!-- Ringkas Tindakan -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="lt_diagnosa"><i class="fa fa-list-alt"></i> Diagnosa</label>
                <input type="text" name="diagnosa" id="lt_diagnosa" class="form-control" placeholder="Diagnosa"
                       value="<?= html_escape($existing['diagnosa'] ?? '') ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="lt_nama_tindakan"><i class="fa fa-scissors"></i> Nama Tindakan</label>
                <input type="text" name="nama_tindakan" id="lt_nama_tindakan" class="form-control" placeholder="Nama Tindakan"
                       value="<?= html_escape($existing['nama_tindakan'] ?? '') ?>">
              </div>
            </div>
          </div>

          <!-- Prosedur Tindakan (textarea besar) -->
          <div class="form-group">
            <label for="lt_prosedur_tindakan"><i class="fa fa-file-alt"></i> Prosedur Tindakan</label>
            <textarea name="prosedur_tindakan" id="lt_prosedur_tindakan" class="form-control" rows="10"
                      placeholder="Tuliskan prosedur tindakan secara rinci..."><?= html_escape($existing['prosedur_tindakan'] ?? '') ?></textarea>
          </div>

          <!-- TTD base64 (diisi saat sign) -->
          <input type="hidden" id="lt_ttd_base64" name="ttd" value="<?= !empty($existing['ttd']) ? html_escape($existing['ttd']) : '' ?>">

          <!-- Tombol Aksi -->
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success btn-sm" id="btnLTSave">
              <i class="fa fa-save"></i> Simpan
            </button>
            <button type="submit" class="btn btn-primary btn-sm" id="btnLTUpdate" style="display:none">
              <i class="fa fa-save"></i> Update
            </button>
            <button type="button" id="btnLTCancel" class="btn btn-secondary btn-sm">
              <i class="fa fa-times"></i> Batal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kolom kanan: Status/Ringkasan -->
  <div class="col-md-5">
    <div class="card shadow-sm border-info mb-4">
      <div class="card-header bg-info text-white py-2">
        <h5 class="m-0"><i class="fa fa-info-circle"></i> Status Laporan</h5>
      </div>
      <div class="card-body p-3">
        <?php if (!empty($existing)): ?>
          <div class="alert alert-success mb-2">
            Laporan untuk <strong><?= html_escape($no_rawat) ?></strong> sudah terisi.
          </div>
          <table class="table table-sm table-bordered">
            <tr><th style="width:160px;">Tanggal Input</th><td><?= html_escape($existing['tgl_input'] ?? '-') ?></td></tr>
            <tr><th>Dokter</th><td><?= html_escape($detail_pasien['nm_dokter'] ?? '-') ?></td></tr>
            <tr><th>Ruangan</th><td><?= html_escape($existing['ruangan'] ?? '-') ?></td></tr>
            <tr><th>TTD</th><td><?= !empty($existing['ttd']) ? '<span class="label label-success">Ada</span>' : '<span class="label label-default">Belum</span>' ?></td></tr>
          </table>
        <?php else: ?>
          <div class="alert alert-warning mb-0">
            Belum ada laporan untuk <strong><?= html_escape($no_rawat) ?></strong>. (Satu laporan per nomor rawat)
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="card shadow-sm border-secondary">
      <div class="card-header bg-secondary text-white py-2">
        <h6 class="m-0"><i class="fa fa-file-medical"></i> Ringkasan Laporan Saat Ini</h6>
      </div>
      <div class="card-body p-2">
        <div class="table-responsive">
          <table class="table table-sm table-bordered table-hover">
            <thead class="thead-light text-center">
              <tr>
                <th style="width:50px;">No</th>
                <th>Diagnosa</th>
                <th>Nama Tindakan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Ruangan</th>
                <th>Anestesi</th>
              </tr>
            </thead>
            <tbody class="text-center" id="lt-summary-body">
              <?php if (!empty($existing)): ?>
                <tr>
                  <td>1</td>
                  <td><?= html_escape($existing['diagnosa'] ?? '-') ?></td>
                  <td><?= html_escape($existing['nama_tindakan'] ?? '-') ?></td>
                  <td><?= html_escape($existing['jam_mulai'] ?? '-') ?></td>
                  <td><?= html_escape($existing['jam_selesai'] ?? '-') ?></td>
                  <td><?= html_escape($existing['ruangan'] ?? '-') ?></td>
                  <td><?= html_escape($existing['jenis_anastesi'] ?? '-') ?></td>
                </tr>
              <?php else: ?>
                <tr><td colspan="7" class="text-muted">Belum ada data.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
          <div id="lt-actions-toolbar" class="mt-2"></div>
        </div>
      </div>
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

<!-- Endpoint untuk JS -->
<script>
  window.API = window.API || {};
  window.API.laporanTindakanRalan = {
    getData:  "<?= site_url('dokterRalan/laporan-tindakan-ralan/getByNoRawat'); ?>",
    save:     "<?= site_url('dokterRalan/laporan-tindakan-ralan/save'); ?>",
    update:   "<?= site_url('dokterRalan/laporan-tindakan-ralan/update'); ?>",
    delete:   "<?= site_url('dokterRalan/laporan-tindakan-ralan/delete'); ?>",
    print:    "<?= site_url('dokterRalan/laporan-tindakan-ralan/print'); ?>",
    sign:     "<?= site_url('dokterRalan/laporan-tindakan-ralan/sign'); ?>"
  };

  // Isi jam otomatis jika kosong (HH:MM:SS)
  (function(){
    function pad2(n){return String(n).padStart(2,'0');}
    function nowHHMMSS(){ var d=new Date(); return pad2(d.getHours())+':'+pad2(d.getMinutes())+':'+pad2(d.getSeconds()); }
    var jm = document.getElementById('lt_jam_mulai');
    if (jm && !jm.value) jm.value = nowHHMMSS();
  })();
</script>

<!-- File JS utama -->
<script src="<?= base_url('assets/js/dokterRalan/laporanTindakanRalan.js?v=') . time(); ?>"></script>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <!-- ================= LEFT: FORM INPUT ================= -->
  <div class="col-md-7">
    <div class="card shadow-sm border-primary mb-4">
      <div class="card-header bg-primary text-white py-2">
        <h5 class="m-0"><i class="fa fa-file-medical"></i> Surat Keterangan Sakit</h5>
      </div>
      <div class="card-body">
        <form id="suratSakitForm" method="POST" autocomplete="off">
          <?php if (isset($this->security)) : ?>
            <input type="hidden"
                   name="<?= $this->security->get_csrf_token_name(); ?>"
                   value="<?= $this->security->get_csrf_hash(); ?>">
          <?php endif; ?>

          <!-- Hidden keys -->
          <input type="hidden" id="ss_id" value="<?= isset($existing['id']) ? (int)$existing['id'] : '' ?>">
          <input type="hidden" name="no_rawat" id="ss_no_rawat" value="<?= $no_rawat ?>">
          <input type="hidden" name="kd_dokter" id="ss_kd_dokter" value="<?= $kd_dokter ?>">
          <input type="hidden" id="ss_no_rkm_medis" value="<?= $no_rkm_medis ?>">

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

          <!-- No Surat (readonly, diisi saat loadData) -->
          <div class="form-group mb-2">
            <label><i class="fa fa-hashtag"></i> No. Surat</label>
            <input type="text" id="ss_no_surat" class="form-control" value="<?= html_escape($existing['no_surat'] ?? '') ?>" readonly>
          </div>

          <!-- Data Surat -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-calendar"></i> Tanggal Surat</label>
                <input type="date" name="tgl_surat" id="ss_tgl_surat" class="form-control"
                       value="<?= html_escape($existing['tgl_surat'] ?? date('Y-m-d')) ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-calendar-check-o"></i> Mulai Istirahat</label>
                <input type="date" name="tgl_mulai_istirahat" id="ss_tgl_mulai" class="form-control"
                       value="<?= html_escape($existing['tgl_mulai_istirahat'] ?? '') ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <label><i class="fa fa-bed"></i> Lama (Hari)</label>
                <input type="number" name="lama_istirahat_hari" id="ss_lama_hari" min="1" max="30"
                       class="form-control" value="<?= html_escape($existing['lama_istirahat_hari'] ?? '') ?>">
              </div>
            </div>
          </div>

          <!-- Keterangan -->
          <div class="form-group mb-3">
            <label for="ss_keterangan"><i class="fa fa-file-alt"></i> Keterangan Tambahan</label>
            <textarea name="keterangan" id="ss_keterangan" class="form-control" rows="4"
                      placeholder="Opsional: tulis catatan dokter di sini..."><?= html_escape($existing['keterangan'] ?? '') ?></textarea>
          </div>

          <!-- Wali jika tanda tangan bukan pasien -->
          <div class="form-group mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="ss_is_guardian"
                     name="is_signed_by_guardian" <?= !empty($existing['is_signed_by_guardian']) ? 'checked' : '' ?>>
              <label class="form-check-label" for="ss_is_guardian">Ditandatangani oleh wali pasien</label>
            </div>
          </div>

          <div id="guardian_fields" style="<?= empty($existing['is_signed_by_guardian']) ? 'display:none;' : '' ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label>Nama Wali</label>
                  <input type="text" name="nama_wali" id="ss_nama_wali" class="form-control"
                         value="<?= html_escape($existing['nama_wali'] ?? '') ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label>Hubungan Wali</label>
                  <input type="text" name="hubungan_wali" id="ss_hubungan_wali" class="form-control"
                         placeholder="Ayah / Ibu / Suami / Istri / Anak"
                         value="<?= html_escape($existing['hubungan_wali'] ?? '') ?>">
                </div>
              </div>
            </div>
          </div>

          <!-- Tombol form -->
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success btn-sm" id="btnSSSave">
              <i class="fa fa-save"></i> Simpan
            </button>
            <button type="submit" class="btn btn-primary btn-sm" id="btnSSUpdate" style="display:none">
              <i class="fa fa-save"></i> Update
            </button>
            <button type="button" id="btnSSCancel" class="btn btn-secondary btn-sm">
              <i class="fa fa-times"></i> Batal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ================= RIGHT: STATUS, RINGKASAN, TTD, AKSI ================= -->
  <div class="col-md-5">

    <!-- Status -->
    <div class="card shadow-sm border-info mb-3">
      <div class="card-header bg-info text-white py-2">
        <h6 class="m-0"><i class="fa fa-info-circle"></i> Status Surat Sakit</h6>
      </div>
      <div class="card-body p-3">
        <div id="statusSuratSakit" class="alert alert-warning mb-2">
          Belum ada surat sakit untuk <strong><?= html_escape($no_rawat) ?></strong>.
        </div>
        <table class="table table-sm table-bordered mb-0" id="ss-summary-table">
          <tbody>
            <tr><th style="width:140px">No. Surat</th><td id="sum_no_surat">-</td></tr>
            <tr><th>Tanggal Surat</th><td id="sum_tgl_surat">-</td></tr>
            <tr><th>Mulai Istirahat</th><td id="sum_tgl_mulai">-</td></tr>
            <tr><th>Lama (hari)</th><td id="sum_lama_hari">-</td></tr>
            <tr><th>Final</th><td id="sum_is_final">Belum</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Aksi/Toolbar & Preview -->
    <div class="card shadow-sm border-secondary mb-3">
      <div class="card-header bg-secondary text-white py-2">
        <h6 class="m-0"><i class="fa fa-wrench"></i> Aksi & Preview</h6>
      </div>
      <div class="card-body p-2">
        <!-- Toolbar Aksi -->
        <div class="mb-2 d-flex flex-wrap gap-2" id="ss-actions-toolbar">
          <button class="btn btn-info btn-sm"    id="btnSSView"><i class="fa fa-eye"></i> View</button>
          <button class="btn btn-primary btn-sm" id="btnSSTTD"><i class="fa fa-pen"></i> TTD</button>
          <button class="btn btn-warning btn-sm" id="btnSSEdit"><i class="fa fa-edit"></i> Edit</button>
          <button class="btn btn-success btn-sm" id="btnSSPrint" disabled><i class="fa fa-print"></i> Print</button>
          <button class="btn btn-danger btn-sm"  id="btnSSDelete"><i class="fa fa-trash"></i> Hapus</button>
        </div>

        <!-- Preview TTD -->
        <div class="row">
          <div class="col-6 text-center">
            <div class="small text-muted mb-1">TTD Dokter (tersimpan)</div>
            <img id="preview-ttd-dokter" src="" alt="TTD Dokter" style="max-width:100%;height:auto;display:none;border:1px dashed #ddd;padding:4px;border-radius:6px">
          </div>
          <div class="col-6 text-center">
            <div class="small text-muted mb-1">TTD Pasien / Wali (tersimpan)</div>
            <img id="preview-ttd-pasien" src="" alt="TTD Pasien" style="max-width:100%;height:auto;display:none;border:1px dashed #ddd;padding:4px;border-radius:6px">
          </div>
        </div>
      </div>
    </div>

    <!-- Canvas TTD Dokter -->
    <div class="card shadow-sm border-primary mb-3">
      <div class="card-header bg-primary text-white py-2">
        <h6 class="m-0"><i class="fa fa-pen"></i> Tanda Tangan Dokter</h6>
      </div>
      <div class="card-body text-center">
        <canvas id="canvasTTDDokter" width="450" height="180" style="border:1px solid #ccc; width:100%;"></canvas>
        <div class="mt-2">
          <button id="btnClearTTDDokter" class="btn btn-sm btn-secondary"><i class="fa fa-undo"></i> Ulangi</button>
          <button id="btnSaveTTDDokter" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan TTD</button>
        </div>
      </div>
    </div>

    <!-- Canvas TTD Pasien -->
    <div class="card shadow-sm border-success">
      <div class="card-header bg-success text-white py-2">
        <h6 class="m-0"><i class="fa fa-signature"></i> Tanda Tangan Pasien / Wali</h6>
      </div>
      <div class="card-body text-center">
        <canvas id="canvasTTDPasien" width="450" height="180" style="border:1px solid #ccc; width:100%;"></canvas>
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
  window.API.suratSakitRalan = {
    getData:    "<?= site_url('dokterRalan/surat-sakit-ralan/getByNoRawat'); ?>",
    save:       "<?= site_url('dokterRalan/surat-sakit-ralan/save'); ?>",
    update:     "<?= site_url('dokterRalan/surat-sakit-ralan/update'); ?>",
    delete:     "<?= site_url('dokterRalan/surat-sakit-ralan/delete'); ?>",
    signDoctor: "<?= site_url('dokterRalan/surat-sakit-ralan/signDoctor'); ?>",
    signPatient:"<?= site_url('dokterRalan/surat-sakit-ralan/signPatient'); ?>",
    finalize:   "<?= site_url('dokterRalan/surat-sakit-ralan/finalize'); ?>",
    print:      "<?= site_url('dokterRalan/surat-sakit-ralan/print'); ?>"
  };

  // Toggle field wali
  document.getElementById('ss_is_guardian').addEventListener('change', function() {
    var el = document.getElementById('guardian_fields');
    if (el) el.style.display = this.checked ? 'block' : 'none';
  });
</script>

<!-- File JS utama -->
<script src="<?= base_url('assets/js/dokterRalan/suratSakitRalan.js?v=') . time(); ?>"></script>

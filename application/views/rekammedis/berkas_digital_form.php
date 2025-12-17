<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
  .toolbar{display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin-bottom:10px}
  .toolbar .form-control{min-width:150px}
  .table thead th{position:sticky;top:0;background:#fff;z-index:1}
  /* Mini-list berkas di dalam sel tabel */
  .berkas-cell{min-width:280px}
  .berkas-mini{max-height:120px;overflow:auto;border:1px solid #eee;border-radius:6px;padding:6px}
  .berkas-mini .item{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:4px 0;border-bottom:1px dashed #eee}
  .berkas-mini .item:last-child{border-bottom:none}
  .berkas-mini .name{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:220px;font-size:12px}
  .berkas-mini .btn-xs{padding:2px 6px;font-size:11px}
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Berkas Digital Perawatan</h1>
  </section>

  <section class="content">
    <!-- Filter -->
    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="box-title">Filter</h3></div>
      <div class="box-body">
        <div class="toolbar">
          <label style="margin:0">Tanggal:</label>
          <input type="date" id="fDate" class="form-control">
          <input type="text" id="fKeyword" class="form-control" placeholder="Keyword (no.rawat / nama / dokter)">
          <button id="btnCari" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
        </div>
      </div>
    </div>

    <!-- Tabel Pasien -->
    <div class="box">
      <div class="box-header with-border"><h3 class="box-title">Daftar Pasien</h3></div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="pasienTable">
            <thead>
              <tr>
                <th style="width:60px">No</th>
                <th>No. Rawat</th>
                <th>No.RM</th>
                <th>Nama Pasien</th>
                <th>Dokter</th>
                <th class="berkas-cell">Berkas Digital Perawatan</th>
                <th style="width:110px">Aksi</th>
              </tr>
            </thead>
            <tbody><!-- Diisi JS --></tbody>
          </table>
        </div>
        <div class="text-right text-muted" id="rowCount" style="font-size:12px">Record: 0</div>
      </div>
    </div>
  </section>
</div>

<!-- MODAL UPLOAD -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display:flex;justify-content:space-between;align-items:center">
        <h4 class="modal-title">Upload Berkas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="border:none;background:transparent;font-size:24px;line-height:1">&times;</button>
      </div>

      <div class="modal-body">
        <div class="alert alert-info" id="um-no-rawat" style="margin-bottom:10px">No. Rawat: -</div>

        <div class="upload-form">
          <div class="row">
            <div class="col-sm-6">
              <label>Jenis Berkas</label>
              <select class="form-control upload-jenis um-jenis"></select>
            </div>

            <div class="col-sm-6">
              <label>File</label>
              <div class="input-group">
                <!-- Satu input untuk kamera / file -->
                <input type="file"
                       class="form-control upload-file um-file"
                       accept="image/*,application/pdf">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default btn-pick-camera">
                    <i class="fa fa-camera"></i> Kamera
                  </button>
                  <button type="button" class="btn btn-default btn-pick-file">
                    <i class="fa fa-folder-open"></i> File
                  </button>
                </div>
              </div>
              <small class="text-muted">Pilih <b>Kamera</b> untuk foto langsung, atau <b>File</b> untuk ambil dari galeri/berkas (gambar/PDF).</small>
            </div>
          </div>

          <div style="margin-top:10px">
            <button class="btn btn-primary btn-do-upload" id="um-upload-btn" data-no-rawat="">
              <i class="fa fa-cloud-upload"></i> Upload
            </button>
          </div>
        </div>

        <hr>
        <div id="um-riwayat" class="table-responsive">
          <p class="text-muted">Belum ada data.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
window.API_BERKAS = {
  getPasien:   "<?= site_url('admin/berkas-digital/get-pasien-by-tanggal'); ?>",
  getList:     "<?= site_url('admin/berkas-digital/get-list'); ?>",
  upload:      "<?= site_url('admin/berkas-digital/upload'); ?>",
  download:    "<?= site_url('admin/berkas-digital/download'); ?>",        // single (by id) — dipakai fallback view
  downloadAll: "<?= site_url('admin/berkas-digital/download_all'); ?>",    // ZIP semua berkas by no_rawat
  delete:      "<?= site_url('admin/berkas-digital/delete'); ?>",
  publicUrl:   "<?= rtrim(berkas_base_url(), '/'); ?>"
};
window.MASTER_BERKAS = <?= json_encode($master_berkas ?? []); ?>;
</script>

<!-- JS utama -->
<script src="<?= base_url('assets/js/berkas_digital.js'); ?>"></script>

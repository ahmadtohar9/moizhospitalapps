<?php
/** @var array $detail_pasien */
/** @var string $no_rawat */
/** @var string $no_rkm_medis */
/** @var array $penjab_list (opsional) */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style id="perawat-ralan-style">
  /* ===== Card & layout ===== */
  .box.box-success { border-top-color:#2ecc71; }
  #filterForm .form-control { border-radius:8px; }
  #filterForm label { font-weight:600; color:#374151; }
  #filterButton { margin-top:2px; border-radius:8px; font-weight:600; }

  /* jarak antar kolom kecil di mobile */
  @media (max-width: 991px){
    #filterForm .col-sm-6, #filterForm .col-md-2, #filterForm .col-md-3, #filterForm .col-md-1 {
      margin-bottom:10px;
    }
  }

  /* ===== DataTable polish ===== */
  #pasienTable { background:#fff; }
  #pasienTable thead th {
    background:#f8fafc; color:#111827; font-weight:700; border-bottom:1px solid #e5e7eb;
    position:sticky; top:0; z-index:2; /* sticky header saat scroll */
  }
  #pasienTable tbody td { vertical-align:middle; }
  #pasienTable .btn.btn-success.btn-sm { border-radius:8px; font-weight:600; }

  /* ===== Row status (match dengan JS) ===== */
  .row-belum  { background:#fff7e6 !important; }   /* oranye muda: belum dikerjakan */
  .row-sudah  { background:#eef9f0 !important; }   /* hijau muda: sudah dikerjakan */
  .row-bayar-belum { box-shadow: inset 4px 0 0 0 #e74c3c; } /* garis merah kiri: belum bayar */

  /* highlight entri baru */
  .row-new { animation: rjPulse 1.2s ease-in-out 0s 3; }
  @keyframes rjPulse {
    0% { box-shadow:0 0 0 0 rgba(46,204,113,.7); }
    70%{ box-shadow:0 0 0 10px rgba(46,204,113,0); }
    100%{ box-shadow:0 0 0 0 rgba(46,204,113,0); }
  }

  /* ===== Soft badges (dipakai di kolom status) ===== */
  .badge-soft { display:inline-block; padding:2px 8px; border-radius:999px; font-size:12px; font-weight:600; }
  .badge-soft.ok     { background:#2ecc71; color:#fff; }
  .badge-soft.warn   { background:#f39c12; color:#fff; }
  .badge-soft.danger { background:#e74c3c; color:#fff; }

  /* ===== Scroll wrapper agar tabel enak di HP ===== */
  .box-body > div[style*="overflow-x: auto"] { border:1px solid #e5e7eb; border-radius:10px; }

  /* ===== Print mode: rapikan untuk hardcopy ===== */
  @media print {
    .content-header, .box .box-header, .sidebar, .main-header, .main-sidebar, .main-footer,
    .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate,
    #filterForm, #filterButton { display:none !important; }

    body, .content-wrapper, .box-body { background:#fff !important; }
    #pasienTable { font-size:12px; }
    #pasienTable thead th { position:static; background:#f0f2f5 !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .row-belum { background:#fffaf0 !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .row-sudah { background:#f5fff6 !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .row-bayar-belum { box-shadow:none !important; border-left:4px solid #e74c3c; }
    .badge-soft { border:1px solid #ddd; color:#000 !important; background:#fff !important; }
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Pasien Rawat Jalan (Perawat)</h1>
  </section>

  <section class="content">
    <!-- ====== FILTER ====== -->
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Filter Data</h3>
      </div>
      <div class="box-body">
        <form id="filterForm" class="form-horizontal" onsubmit="return false;">
          <div class="row">
            <div class="col-md-2 col-sm-6">
              <label for="start_date">Tanggal Mulai</label>
              <input type="date" id="start_date" class="form-control">
            </div>

            <div class="col-md-2 col-sm-6">
              <label for="end_date">Tanggal Akhir</label>
              <input type="date" id="end_date" class="form-control">
            </div>

            <div class="col-md-3 col-sm-6">
              <label for="penjab">Penjamin</label>
              <select id="penjab" class="form-control">
                <option value="">-- Semua --</option>
                <?php if (!empty($penjab_list) && is_array($penjab_list)): ?>
                  <?php foreach ($penjab_list as $penjab): ?>
                    <option value="<?= htmlspecialchars($penjab['png_jawab'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                      <?= htmlspecialchars($penjab['png_jawab'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="col-md-2 col-sm-6">
              <label for="status_bayar">Status Bayar</label>
              <select id="status_bayar" class="form-control">
                <option value="">-- Semua --</option>
                <option value="Sudah Bayar">Sudah Bayar</option>
                <option value="Belum Bayar">Belum Bayar</option>
              </select>
            </div>

            <div class="col-md-2 col-sm-6">
              <label for="status_periksa">Status Periksa</label>
              <select id="status_periksa" class="form-control">
                <option value="">-- Semua --</option>
                <option value="Sudah">Sudah</option>
                <option value="Belum">Belum</option>
              </select>
            </div>

            <div class="col-md-1 col-sm-6">
              <label>&nbsp;</label>
              <button type="button" id="filterButton" class="btn btn-primary btn-block">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Data Pasien</h3>
      </div>
      <div class="box-body">
        <!-- Wrapper untuk scroll horizontal -->
        <div style="overflow-x: auto;">
          <table id="pasienTable" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>No.Rawat</th>
                <th>RM</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Penjamin</th>
                <th>Poliklinik</th>
                <th>StatusPeriksa</th>
                <th>Status Bayar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody><!-- populated by perawat_ralan.js --></tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  window.API_URL  = "<?= site_url('perawat/ralan/get-data'); ?>";
  window.OPEN_BASE = "<?= site_url('perawat/ralan/rekam-medis'); ?>";
</script>
<script src="<?= base_url('assets/js/perawat_ralan.js'); ?>"></script>





<style id="dokter-ralan-style">
  /* ===== Card & layout ===== */
  .box.box-success {
    border-top-color: #2ecc71;
  }

  #filterForm .form-control {
    border-radius: 8px;
  }

  #filterForm label {
    font-weight: 600;
    color: #374151;
  }

  #filterButton {
    margin-top: 2px;
    border-radius: 8px;
    font-weight: 600;
  }

  /* jarak antar kolom kecil di mobile */
  @media (max-width: 991px) {

    #filterForm .col-sm-6,
    #filterForm .col-md-2,
    #filterForm .col-md-3,
    #filterForm .col-md-1 {
      margin-bottom: 10px;
    }
  }

  /* ===== DataTable polish ===== */
  #pasienTable {
    background: #fff;
  }

  #pasienTable thead th {
    background: #f8fafc;
    color: #111827;
    font-weight: 700;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 2;
    /* sticky header saat scroll */
  }

  #pasienTable tbody td {
    vertical-align: middle;
  }

  #pasienTable .btn.btn-success.btn-sm {
    border-radius: 8px;
    font-weight: 600;
  }

  /* ===== Row status (match dengan JS) - Higher specificity ===== */
  #pasienTable tbody tr.row-belum {
    background: #fff !important;
  }

  /* putih: belum */
  #pasienTable tbody tr.row-sudah {
    background: #fce7f3 !important;
  }

  /* pink muda: sudah */
  #pasienTable tbody tr.row-berkas {
    background: #f3e8ff !important;
  }

  /* purple muda: berkas diterima */
  #pasienTable tbody tr.row-batal {
    background: #1f2937 !important;
    color: #fff !important;
  }

  /* hitam: batal */
  #pasienTable tbody tr.row-dirujuk {
    background: #dbeafe !important;
  }

  /* blue muda: dirujuk */
  #pasienTable tbody tr.row-meninggal {
    background: #fee2e2 !important;
  }

  /* red muda: meninggal */
  #pasienTable tbody tr.row-dirawat {
    background: #d1fae5 !important;
  }

  /* green muda: dirawat */
  #pasienTable tbody tr.row-pulang {
    background: #fef3c7 !important;
  }

  /* amber muda: pulang paksa */
  #pasienTable tbody tr.row-bayar {
    background: #ffedd5 !important;
  }

  /* orange muda: sudah bayar */
  #pasienTable tbody tr.row-bayar-belum {
    box-shadow: inset 4px 0 0 0 #e74c3c;
  }

  /* garis merah kiri: belum bayar */

  /* Ensure text color for batal rows */
  #pasienTable tbody tr.row-batal td {
    color: #fff !important;
  }

  /* highlight entri baru */
  .row-new {
    animation: rjPulse 1.2s ease-in-out 0s 3;
  }

  @keyframes rjPulse {
    0% {
      box-shadow: 0 0 0 0 rgba(46, 204, 113, .7);
    }

    70% {
      box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
    }

    100% {
      box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
    }
  }

  /* ===== Soft badges (dipakai di kolom status) ===== */
  .badge-soft {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }

  .badge-soft.ok {
    background: #2ecc71;
    color: #fff;
  }

  .badge-soft.warn {
    background: #f39c12;
    color: #fff;
  }

  .badge-soft.danger {
    background: #e74c3c;
    color: #fff;
  }

  /* Custom badge untuk Status Periksa */
  .badge-soft.badge-belum {
    background: #fff;
    color: #333;
    border: 1px solid #ddd;
  }

  /* Belum: putih */
  .badge-soft.badge-sudah {
    background: #ec4899;
    color: #fff;
  }

  /* Sudah: pink */
  .badge-soft.badge-berkas {
    background: #9333ea;
    color: #fff;
  }

  /* Berkas Diterima: purple */
  .badge-soft.badge-batal {
    background: #1f2937;
    color: #fff;
  }

  /* Batal: hitam */
  .badge-soft.badge-dirujuk {
    background: #3b82f6;
    color: #fff;
  }

  /* Dirujuk: blue */
  .badge-soft.badge-meninggal {
    background: #ef4444;
    color: #fff;
  }

  /* Meninggal: red */
  .badge-soft.badge-dirawat {
    background: #10b981;
    color: #fff;
  }

  /* Dirawat: green */
  .badge-soft.badge-pulang {
    background: #f59e0b;
    color: #fff;
  }

  /* Pulang Paksa: amber */

  /* Custom badge untuk Status Bayar */
  .badge-soft.badge-bayar {
    background: #f97316;
    color: #fff;
  }

  /* Sudah Bayar: orange */

  /* ===== Scroll wrapper agar tabel enak di HP ===== */
  .box-body>div[style*="overflow-x: auto"] {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
  }

  /* ===== Print mode: rapikan untuk hardcopy ===== */
  @media print {

    .content-header,
    .box .box-header,
    .sidebar,
    .main-header,
    .main-sidebar,
    .main-footer,
    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate,
    #filterForm,
    #filterButton {
      display: none !important;
    }

    body,
    .content-wrapper,
    .box-body {
      background: #fff !important;
    }

    #pasienTable {
      font-size: 12px;
    }

    #pasienTable thead th {
      position: static;
      background: #f0f2f5 !important;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .row-belum {
      background: #fffaf0 !important;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .row-sudah {
      background: #f5fff6 !important;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .row-bayar-belum {
      box-shadow: none !important;
      border-left: 4px solid #e74c3c;
    }

    .badge-soft {
      border: 1px solid #ddd;
      color: #000 !important;
      background: #fff !important;
    }
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Pasien Rawat Jalan</h1>
  </section>
  <section class="content">

    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Filter Data</h3>
      </div>
      <div class="box-body">
        <form id="filterForm" class="form-horizontal">
          <div class="row">
            <div class="col-md-2 col-sm-6">
              <label for="start_date">Tanggal Mulai</label>
              <input type="date" id="start_date" class="form-control" value="<?= date('Y-m-d'); ?>">
            </div>

            <div class="col-md-2 col-sm-6">
              <label for="end_date">Tanggal Akhir</label>
              <input type="date" id="end_date" class="form-control" value="<?= date('Y-m-d'); ?>">
            </div>

            <div class="col-md-3 col-sm-6">
              <label for="penjab">Penjamin</label>
              <select id="penjab" class="form-control">
                <option value="">-- Semua --</option>
                <?php foreach ($penjab_list as $penjab): ?>
                  <option value="<?= $penjab['png_jawab']; ?>"><?= $penjab['png_jawab']; ?></option>
                <?php endforeach; ?>
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
          <table id="pasienTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>No.Rawat</th>
                <th>No.Reg</th>
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
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  const API_URL = "<?= base_url('DokterRalanController/get_data'); ?>";
  const UPDATE_STATUS_URL = "<?= base_url('DokterRalanController/update_status'); ?>";
  const ANTRIAN_API_URL = "<?= base_url('AntrianController/'); ?>";
  const KD_DOKTER = "<?= $this->session->userdata('kd_dokter'); ?>";

  // Debug
  console.log('🔍 Debug Info:');
  console.log('KD_DOKTER:', KD_DOKTER);
</script>
<script src="<?= base_url('assets/js/dokterRalan.js'); ?>"></script>
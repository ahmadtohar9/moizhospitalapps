<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Rincian Billing Pasien Rawat Inap</h1>
  </section>

  <section class="content">
    <!-- Filter -->
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Filter Data</h3>
      </div>
      <div class="box-body">
        <form id="filterForm" class="form-inline">
          <div class="row">
            <div class="col-md-3">
              <label for="start_date">Tanggal Mulai:</label>
              <input type="date" id="start_date" name="start_date" class="form-control">
            </div>
            <div class="col-md-3">
              <label for="end_date">Tanggal Akhir:</label>
              <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
            <div class="col-md-4 mt-4">
              <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
              <button type="button" id="printButton" class="btn btn-success">Cetak PDF</button>
              <button type="button" id="copyButton" class="btn btn-info">Copy</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Table -->
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Billing Rawat Inap</h3>
      </div>
      <div class="box-body">
        <div style="overflow-x:auto;">
          <table id="billingTable" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>No RM</th>
      <th>Nama Pasien</th>
      <th>Nama Dokter</th>
      <th>Paket Operasi</th>
      <th>Tgl Masuk</th>
      <th>Ruangan</th>
      <th>Registrasi</th>
      <th>Tindakan Dokter Inap</th>
      <th>Alkes Inap</th>
      <th>Tindakan Dokter Ralan</th>
      <th>Alkes Ralan</th>
      <th>Tindakan Perawat Inap</th>
      <th>Alkes Perawat Inap</th>
      <th>Tindakan Perawat Ralan</th>
      <th>Alkes Perawat Ralan</th>
      <th>Laboratorium</th>
      <th>Radiologi</th>
      <th>Jasa Dokter Operasi</th>
      <th>Kamar Operasi</th>
      <th>Operasi Obat</th>
      <th>Kamar Rawatan Operasi</th>
      <th>Operasi CTG</th>
      <th>BHP Operasi</th>
      <th>Tarif Kamar</th>
      <th>Obat Tambahan</th>
      <th>Jasa Dokter Tambahan</th>
      <th>Jasa Layanan</th>
      <th>Tambahan Lainnya</th>
      <th>Potongan Biaya</th>
      <th>Total Biaya</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <!-- Buat jumlah <th> sesuai jumlah kolom di atas -->
      <th colspan="1"></th> <!-- No -->
      <th></th> <!-- No RM -->
      <th></th> <!-- Nama Pasien -->
      <th></th> <!-- Nama Dokter -->
      <th></th> <!-- Paket Operasi -->
      <th></th> <!-- Tgl Masuk -->
      <th></th> <!-- Ruangan -->
      <th></th> <!-- Registrasi -->
      <th></th> <!-- Tindakan Dokter Inap -->
      <th></th> <!-- Alkes Inap -->
      <th></th> <!-- Tindakan Dokter Ralan -->
      <th></th> <!-- Alkes Ralan -->
      <th></th> <!-- Tindakan Perawat Inap -->
      <th></th> <!-- Alkes Perawat Inap -->
      <th></th> <!-- Tindakan Perawat Ralan -->
      <th></th> <!-- Alkes Perawat Ralan -->
      <th></th> <!-- Laboratorium -->
      <th></th> <!-- Radiologi -->
      <th></th> <!-- Jasa Dokter Operasi -->
      <th></th> <!-- Kamar Operasi -->
      <th></th> <!-- Operasi Obat -->
      <th></th> <!-- Kamar Rawatan Operasi -->
      <th></th> <!-- Operasi CTG -->
      <th></th> <!-- BHP Operasi -->
      <th></th> <!-- Tarif Kamar -->
      <th></th> <!-- Obat Tambahan -->
      <th></th> <!-- Jasa Dokter Tambahan -->
      <th></th> <!-- Jasa Layanan -->
      <th></th> <!-- Tambahan Lainnya -->
      <th></th> <!-- Potongan Biaya -->
      <th></th> <!-- Total Biaya -->
    </tr>
  </tfoot>
</table>

        </div>
      </div>
    </div>
  </section>
</div>

<!-- URL untuk AJAX -->
<script>
  const API_URL_RANAP = "<?= base_url('admin/billRanap/get_data'); ?>";
  const PRINT_URL_RANAP = "<?= base_url('admin/billRanap/print_pdf'); ?>";
</script>

<!-- Script JavaScript utama -->
<script src="<?= base_url('assets/js/billRanap.js'); ?>"></script>

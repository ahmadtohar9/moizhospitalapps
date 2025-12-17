<!-- ✅ Tambahkan ini di paling atas View -->
<style>
/* Styling Hasil Racikan */
.hasil-racikan-container {
  border: 2px solid #007bff;
  padding: 10px;
  border-radius: 5px;
  background-color: #ffffff;
}

/* Header tabel hasil racikan */
.hasil-racikan-container .table thead {
  background-color: #007bff;
  color: #ffffff;
}

/* Tabel body hasil racikan */
.hasil-racikan-container .table tbody {
  background-color: #ffffff;
}

/* Styling Riwayat Racikan */
.riwayat-racikan-container {
  border: 2px solid #ffc107;
  padding: 10px;
  border-radius: 5px;
  background-color: #fffbea;
}

/* Table kecil */
.table-sm th, .table-sm td {
  padding: 0.5rem;
}

/* Tombol Hapus */
.btn-hapus-racikan {
  background-color: #dc3545;
  border: none;
  color: #fff;
  padding: 5px 10px;
  font-size: 14px;
  border-radius: 4px;
}

.btn-hapus-racikan:hover {
  background-color: #c82333;
}

/* Copy button di riwayat */
.btn-copy-racikan {
  background-color: #17a2b8;
  border: none;
  color: #fff;
  padding: 4px 8px;
  font-size: 12px;
  border-radius: 4px;
}

.btn-copy-racikan:hover {
  background-color: #138496;
}

/* Badge Tervalidasi */
.badge-tervalidasi {
  background-color: #28a745;
  color: #fff;
  padding: 4px 8px;
  font-size: 12px;
  border-radius: 4px;
}

/* Scrollable div */
.scrollable-div {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid #ddd;
  padding: 10px;
}
</style>

<!-- ✅ FORM INPUT RACIKAN -->
<form id="racikanForm" method="POST">
  <div class="row">
    <div class="col-md-2 mb-2">
      <label for="namaRacikan">Racikan:</label>
      <input type="text" id="namaRacikan" name="nama_racikan" class="form-control" placeholder="Masukkan nama racikan" required autocomplete="off">
      <input type="hidden" id="tgl_peresepan" name="tgl_peresepan">
      <input type="hidden" id="jam_peresepan" name="jam_peresepan">
      <input type="hidden" id="no_rawat" name="no_rawat" value="<?= $no_rawat; ?>">
      <input type="hidden" id="kd_dokter" name="kd_dokter" value="<?= $kd_dokter; ?>">
      <input type="hidden" id="no_rkm_medis" name="no_rkm_medis" value="<?= $no_rkm_medis ?>">
    </div>

    <div class="col-md-2 mb-2">
      <label for="metodeRacik">Metode:</label>
      <input type="text" id="metodeRacik" class="form-control" placeholder="Cari metode racik..." autocomplete="off">
      <input type="hidden" id="kdRacik" name="kd_racik">
    </div>

    <div class="col-md-2 mb-2">
      <label for="jumlahRacikan">Jumlah:</label>
      <input type="number" id="jumlahRacikan" name="jumlah_racikan" class="form-control" min="1" placeholder="Jumlah racikan" required>
    </div>

    <div class="col-md-3 mb-2">
      <label for="signa">Signa:</label>
      <input type="text" id="signa" name="signa" class="form-control" placeholder="Contoh: 3 x 1" required>
    </div>

    <div class="col-md-3 mb-2">
      <label for="keterangan">Keterangan:</label>
      <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan tambahan" autocomplete="off">
    </div>
  </div>

  <hr>

  <!-- ✅ Pencarian Obat -->
  <div class="form-group">
    <input type="text" id="searchObat" class="form-control" placeholder="Cari obat..." style="width: 300px;" autocomplete="off">
  </div>

  <!-- ✅ Tabel Obat Racikan -->
  <div class="table-responsive scrollable-div">
    <table class="table table-bordered table-hover table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Obat</th>
          <th>Nama Obat</th>
          <th>Stok</th>
          <th>Satuan</th>
          <th>Kapasitas</th>
          <th>Kandungan</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody id="racikanObatBody">
        <!-- Dinamis dari JavaScript -->
      </tbody>
    </table>
  </div>

  <div class="text-right mt-3">
    <button type="button" id="saveRacikan" class="btn btn-primary btn-md">
      <i class="fa fa-save"></i> Simpan Racikan
    </button>
  </div>
</form>

<hr>

<!-- ✅ HASIL RACIKAN -->
<h4 class="mt-4"><i class="fa fa-list"></i> Hasil Racikan</h4>
<div class="table-responsive hasil-racikan-container">
  <table class="table table-bordered table-hover table-sm mb-0">
    <thead>
      <tr>
        <th>No</th>
        <th>No Resep & Nama Racikan</th>
        <th>Kode Obat</th>
        <th>Nama Obat</th>
        <th>Jumlah Obat</th>
        <th>Signa</th>
        <th>Metode</th>
      </tr>
    </thead>
    <tbody id="hasilRacikanTableBody">
      <!-- Dinamis dari JavaScript -->
    </tbody>
  </table>
</div>

<hr>

<!-- ✅ RIWAYAT RACIKAN -->
<h5 class="mt-4"><i class="fa fa-history"></i> Riwayat Racikan Sebelumnya</h5>
<div class="table-responsive riwayat-racikan-container scrollable-div" id="containerRiwayatRacikan">
  <div class="text-center p-2 text-muted">Memuat riwayat racikan...</div>
</div>

<!-- ✅ Panggil file JavaScript -->
<script src="<?= asset_url('assets/js/resepRacikanRalan.js') ?>"></script>

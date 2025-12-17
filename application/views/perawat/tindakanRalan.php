<!-- application/views/perawat/tindakanRalan.php -->

<!-- Tabel Tindakan -->
<div class="table-responsive">
  <input type="hidden" id="no_rawat" name="no_rawat" value="<?= $no_rawat; ?>">
  <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">
  <input type="hidden" id="nip_perawat" value="<?= $nip_perawat ?>">

  <button id="btnRiwayatTindakan" class="btn btn-info">
    <i class="fa fa-history"></i> Riwayat Tindakan
  </button>
  <br/>

  <!-- Search Bar -->
  <div class="mb-2">
    <input type="text" id="searchTindakan" class="form-control" placeholder="Cari tindakan...">
  </div>

  <!-- Tabel dengan Scroll -->
  <div style="max-height: 250px; overflow-y: auto; border: 1px solid #ddd;">
    <table class="table table-bordered table-hover" id="tindakanTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Pilih</th>
          <th>Kode Tindakan</th>
          <th>Nama Tindakan</th>
          <th>Kategori</th>
          <th>Tarif Perawat</th>
        </tr>
      </thead>
      <tbody id="tindakanBody">
        <!-- Data akan dimuat melalui AJAX -->
      </tbody>
    </table>
  </div>
</div>

<!-- Tombol Simpan dan Hapus -->
<div class="text-right">
  <button id="saveTindakan" class="btn btn-primary">
    <i class="fa fa-save"></i> Simpan
  </button>
  <button id="deleteSelectedTindakan" class="btn btn-danger">
    <i class="fa fa-trash"></i> Hapus Semua
  </button>
</div>

<!-- Tabel Hasil Tindakan -->
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th width="20px"><input type="checkbox" id="selectAllHasil">CheckAll</th>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Perawat</th>
        <th>Kode Tindakan</th>
        <th>Nama Tindakan</th>
        <th>Tarif</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="hasilTindakanBody">
      <!-- Data + Total akan dimuat melalui AJAX -->
    </tbody>
  </table>
</div>

<!-- Modal Riwayat Tindakan -->
<div class="modal fade" id="modalRiwayatTindakan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Riwayat Tindakan Pasien</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="containerRiwayatTindakan"></div>
        <div class="text-right mt-3">
          <button class="btn btn-success" id="btnCopySelected">
            <i class="fa fa-copy"></i> Copy Semua
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Inline CSS -->
<style>
  /* Header tabel */
  #modalRiwayatTindakan .table thead th {
    background-color: #f1f5f9;
    vertical-align: middle;
  }

  /* Baris info No. Rawat, Tanggal, Perawat */
  .riwayat-header {
    background-color: #e2e8f0;
    font-weight: bold;
    font-size: 14px;
    padding: 10px;
    border: 1px solid #dee2e6;
    margin-bottom: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .riwayat-header .info { flex: 1; }

  .riwayat-header .pilih-semua-container {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    font-size: 13px;
  }

  .riwayat-header input[type="checkbox"] {
    transform: scale(1.2);
    margin-right: 5px;
  }

  /* Table styling */
  #containerRiwayatTindakan table {
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 20px;
    width: 100%;
  }

  #containerRiwayatTindakan table td,
  #containerRiwayatTindakan table th {
    vertical-align: middle !important;
  }

  /* Tombol copy kecil */
  .btn-copy-tindakan {
    padding: 2px 10px;
    font-size: 13px;
  }

  /* Modal scroll */
  #modalRiwayatTindakan .modal-body {
    max-height: 70vh;
    overflow-y: auto;
  }

  /* Numbering kolom */
  .tindakan-index {
    text-align: center;
    width: 40px;
  }

  .checkbox-td {
    width: 40px;
    text-align: center;
  }
</style>

<!-- JS khusus Perawat -->
<script src="<?= asset_url('assets/js/perawat/tindakanPerawatRalan.js') ?>"></script>

<!-- Tabel Tindakan -->
<div class="table-responsive">
    <input type="hidden" id="no_rawat" name="no_rawat" value="<?= $no_rawat; ?>">
    <input type="hidden" id="kd_dokter" name="kd_dokter" value="<?= $kd_dokter; ?>">

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
                    <th>Tarif Dokter</th>
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
<h4 class="mt-4"><i class="fa fa-list"></i> Hasil Tindakan</h4>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="20px"><input type="checkbox" id="selectAllHasil">CheckAll</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Kode Tindakan</th>
                <th>Nama Tindakan</th>
                <th>Tarif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="hasilTindakanBody">
            <!-- Data akan dimuat melalui AJAX -->
        </tbody>
    </table>
</div>
<script src="<?= base_url('assets/js/tindakanDokterRalan.js') ?>"></script>

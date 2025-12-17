<div class="row">
    <div class="col-md-6">
        <h5>Permintaan Radiologi</h5>

        <!-- Hidden Inputs -->
        <input type="hidden" id="no_rawat" value="<?= $no_rawat ?>">
        <input type="hidden" id="kd_dokter" value="<?= $kd_dokter ?>">
        <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">

        <!-- Informasi Tambahan -->
        <div class="form-group mb-2">
            <label for="informasi_tambahan">Informasi Tambahan</label>
            <textarea class="form-control" id="informasi_tambahan" rows="2"></textarea>
        </div>

        <!-- Diagnosa Klinis -->
        <div class="form-group mb-2">
            <label for="diagnosa_klinis">Diagnosa Klinis</label>
            <textarea class="form-control" id="diagnosa_klinis" rows="2"></textarea>
        </div>

        <!-- Cari Tindakan -->
        <div class="form-group mb-2">
            <label for="cariRadiologi">Cari Tindakan Radiologi</label>
            <input type="text" class="form-control form-control-sm" id="cariRadiologi" placeholder="Ketik nama/kode tindakan radiologi...">
        </div>

        <!-- Hasil Pencarian -->
        <div id="hasilPencarianRadiologi" class="mb-3" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 5px;"></div>

        <!-- Daftar Terpilih -->
        <div class="form-group mb-3">
            <strong>Daftar Tindakan Terpilih</strong>
            <div id="tabelTindakanRadiologiTerpilih" style="max-height: 180px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                <p class="text-muted mb-0">Belum ada tindakan dipilih.</p>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <button class="btn btn-primary mt-2 w-100" id="btnSimpanRadiologi">
            <i class="fa fa-save"></i> Simpan Permintaan
        </button>
    </div>

    <div class="col-md-6">
        <h5>Riwayat Permintaan Radiologi</h5>
        <div id="riwayatPermintaanRadiologi" style="max-height: 500px; overflow-y: auto;"></div>
    </div>
</div>

<!-- Script -->
<script src="<?= asset_url('assets/js/permintaanRadiologi.js') ?>"></script>

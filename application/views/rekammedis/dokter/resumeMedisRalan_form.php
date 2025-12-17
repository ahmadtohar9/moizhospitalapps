<style>
#containerRiwayatResume .table-responsive {
  max-height: 350px;
  overflow-y: auto;
  border: 1px solid #dee2e6;
}
</style>


<div class="container-fluid">
  <input type="hidden" id="no_rawat" value="<?= $no_rawat ?? '' ?>">
  <input type="hidden" id="kd_dokter" value="<?= $kd_dokter ?? '' ?>">
  <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?? '' ?>">

  <div class="row">
    <!-- FORM RESUME -->
    <div class="col-md-6">
      <div class="card shadow mb-3">
        <div class="card-body">

          <!-- TTV -->
          <div class="row">
            <div class="col-md-4">
              <label>🌡 Suhu (°C)</label>
              <input type="number" class="form-control" id="suhu">
            </div>
            <div class="col-md-4">
              <label>💓 Tensi (mmHg)</label>
              <input type="text" class="form-control" id="tensi">
            </div>
            <div class="col-md-4">
              <label>Nadi (BPM)</label>
              <input type="number" class="form-control" id="nadi">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-4">
              <label>Respirasi (RPM)</label>
              <input type="number" class="form-control" id="respirasi">
            </div>
            <div class="col-md-4">
              <label>📏 Tinggi (cm)</label>
              <input type="number" class="form-control" id="tinggi">
            </div>
            <div class="col-md-4">
              <label>⚖️ Berat (kg)</label>
              <input type="number" class="form-control" id="berat">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-4">
              <label>SPO2 (%)</label>
              <input type="number" class="form-control" id="spo2">
            </div>
            <div class="col-md-4">
              <label>GCS</label>
              <input type="text" class="form-control" id="gcs">
            </div>
            <div class="col-md-4">
              <label>Kesadaran</label>
              <select class="form-control" id="kesadaran">
                <option value="">- Pilih -</option>
                <option>Compos Mentis</option>
                <option>Somnolen</option>
                <option>Apatis</option>
                <option>Delirium</option>
                <option>Stupor</option>
                <option>Koma</option>
              </select>
            </div>
          </div>

          <!-- Resume -->
          <div class="form-group mt-3">
            <label>Keluhan Utama</label>
            <textarea id="keluhan_utama" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Pemeriksaan Penunjang</label>
              <textarea id="pemeriksaan_penunjang" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label>Hasil Laboratorium</label>
              <textarea id="hasil_laborat" class="form-control" rows="2"></textarea>
            </div>
          </div>

          <!-- Diagnosa Utama & Kode -->
          <div class="row mt-3">
            <div class="col-md-9">
              <label>Diagnosa Utama</label>
              <input type="text" class="form-control" id="diagnosa_utama">
            </div>
            <div class="col-md-3">
              <label>Kode</label>
              <input type="text" class="form-control" id="kd_diagnosa_utama">
            </div>
          </div>

          <!-- Diagnosa Sekunder 1-4 & Kode -->
          <?php for ($i = 1; $i <= 4; $i++): ?>
          <div class="row mt-2">
            <div class="col-md-9">
              <label>Diagnosa Sekunder <?= $i ?></label>
              <input type="text" class="form-control" id="diagnosa_sekunder<?= $i == 1 ? '' : $i ?>">
            </div>
            <div class="col-md-3">
              <label>Kode</label>
              <input type="text" class="form-control" id="kd_diagnosa_sekunder<?= $i == 1 ? '' : $i ?>">
            </div>
          </div>
          <?php endfor; ?>

          <div class="form-group mt-3">
            <label>Kondisi Pulang</label>
            <select class="form-control" id="kondisi_pulang">
              <option value="Hidup" selected>Hidup</option>
              <option value="Meninggal">Meninggal</option>
            </select>
          </div>


          <hr class="my-3">

          <!-- Prosedur Utama & Kode -->
          <div class="row">
            <div class="col-md-9">
              <label>Prosedur Utama</label>
              <input type="text" class="form-control" id="prosedur_utama">
            </div>
            <div class="col-md-3">
              <label>Kode</label>
              <input type="text" class="form-control" id="kd_prosedur_utama">
            </div>
          </div>

          <!-- Prosedur Sekunder 1-3 & Kode -->
          <?php for ($i = 1; $i <= 3; $i++): ?>
          <div class="row mt-2">
            <div class="col-md-9">
              <label>Prosedur Sekunder <?= $i ?></label>
              <input type="text" class="form-control" id="prosedur_sekunder<?= $i == 1 ? '' : $i ?>">
            </div>
            <div class="col-md-3">
              <label>Kode</label>
              <input type="text" class="form-control" id="kd_prosedur_sekunder<?= $i == 1 ? '' : $i ?>">
            </div>
          </div>
          <?php endfor; ?>

          <!-- Obat Pulang -->
          <div class="form-group mt-3">
            <label>Obat Pulang</label>
            <textarea id="obat_pulang" class="form-control" rows="3"></textarea>
          </div>

          <!-- Tombol Simpan -->
          <div class="text-right mt-3">
            <button class="btn btn-success" id="btnSimpanResume">
              <i class="fa fa-save"></i> Simpan
            </button>
          </div>

        </div>
      </div>
    </div>

   <!-- RIWAYAT RESUME -->
    <div class="col-md-6" id="containerRiwayatResume">
        <div class="card shadow mb-3">
          <div class="card-header bg-danger text-white">
            <i class="fa fa-history"></i> Riwayat Resume
          </div>
          <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
              <thead id="theadRiwayatResume"></thead>
              <tbody id="tabelRiwayatResume">
                <tr><td colspan="6" class="text-center text-muted">Tidak ada riwayat Resume.</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>



<script src="<?= base_url('assets/js/resumeMedisRalan.js?v=') . time(); ?>"></script>

<style>
  .card {
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 1rem;
  }

  .scroll-section {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 6px;
  }

  .template-panel-scroll {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 10px;
    background-color: #fffde7;
  }

  #wrapperTemplateLab {
    display: none;
  }
</style>

<script>const BASE_URL = "<?= base_url() ?>";</script>

<div class="container-fluid">
  <h5 class="mb-3"><i class="fa fa-vial"></i> Form Permintaan Laboratorium</h5>

  <input type="hidden" id="no_rawat" value="<?= $no_rawat ?>">
  <input type="hidden" id="kd_dokter" value="<?= $kd_dokter ?>">
  <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">
  <input type="hidden" id="umurdaftar" value="<?= isset($umurdaftar) ? $umurdaftar : 0 ?>">
  <input type="hidden" id="jk" value="<?= isset($jk) ? $jk : 'L' ?>">

  <div class="row">
    <!-- FORM KIRI -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body bg-light">
          <div class="form-group">
            <label><strong>Informasi Tambahan</strong></label>
            <textarea id="informasi_tambahan" class="form-control" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label><strong>Diagnosa Klinis</strong></label>
            <textarea id="diagnosa_klinis" class="form-control" rows="2"></textarea>
          </div>
          <div class="form-group">
            <input type="text" id="searchPemeriksaan" class="form-control form-control-sm" placeholder="🔍 Cari jenis pemeriksaan...">
          </div>

          <div class="scroll-section mb-2">
            <table class="table table-sm table-bordered mb-0">
              <thead class="thead-light">
                <tr>
                  <th style="width:30px">#</th>
                  <th style="width:40px">Pilih</th>
                  <th>Pemeriksaan</th>
                </tr>
              </thead>
              <tbody id="panelPemeriksaan"></tbody>
            </table>
          </div>

          <div class="text-right mt-3">
            <button class="btn btn-success" id="btnSimpanPermintaan">
              <i class="fa fa-save"></i> Simpan Permintaan
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- FORM KANAN -->
    <div class="col-md-6">
      <div class="card mb-3" id="wrapperTemplateLab">
        <div class="card-header bg-warning">
          <div class="d-flex justify-content-between">
            <span><i class="fa fa-list"></i> Pemeriksaan yang Dipilih</span>
            <button class="btn btn-sm btn-danger" id="btnCloseTemplate">
              <i class="fa fa-times"></i> Tutup
            </button>
          </div>
        </div>
        <div class="card-body template-panel-scroll" id="containerSemuaTemplate"></div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary text-white">
          <i class="fa fa-history"></i> Riwayat Permintaan Laboratorium
        </div>
        <div class="card-body" id="containerRiwayatLab" style="max-height: 600px; overflow-y: auto;">
          Memuat riwayat...
        </div>
        <div class="text-center mb-2" id="showAllRiwayatWrapper" style="display:none">
          <button class="btn btn-sm btn-outline-dark" id="btnShowAllRiwayat">
            <i class="fa fa-list"></i> Tampilkan Semua
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= asset_url('assets/js/permintaanLabRalan.js') ?>"></script>
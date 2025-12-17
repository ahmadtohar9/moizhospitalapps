<style>
  .table-sm td,
  .table-sm th {
    padding: 0.35rem !important;
  }

  .table-scroll {
    max-height: 300px;
    overflow-y: auto;
  }

  .box {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }

  .box-header {
    padding: 0.5rem 1rem;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
  }

  .box-body {
    padding: 1rem;
    background-color: #fff;
  }

  .box-footer {
    padding: 0.5rem 1rem;
    border-top: 1px solid #dee2e6;
    background: #f1f1f1;
  }

  .box-header.bg-light-blue {
    background-color: #e9f7fe;
    color: #0b5ed7;
  }

  .box-header.bg-red {
    background-color: #f8d7da;
    color: #842029;
  }

  .box-header.bg-blue {
    background-color: #d1ecf1;
    color: #0c5460;
  }
</style>

<!-- 0. Data SOAP Terakhir -->
<?php if (!empty($last_soap)): ?>
  <div class="box">
    <div class="box-header bg-success" style="background-color: #d1e7dd; color: #0f5132;">
      <i class="fa fa-stethoscope"></i> Resume Medis Terakhir (SOAP)
      <span class="float-right" style="font-size: 12px; font-weight: normal;">
        <?= date('d-m-Y', strtotime($last_soap->tgl_perawatan)) ?>   <?= $last_soap->jam_rawat ?>
      </span>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table class="table table-sm table-borderless mb-0">
            <tr>
              <td style="width: 100px;"><strong>S (Keluhan)</strong></td>
              <td>: <?= nl2br($last_soap->keluhan) ?></td>
            </tr>
            <tr>
              <td><strong>O (Pemeriksaan)</strong></td>
              <td>
                : <?= nl2br($last_soap->pemeriksaan) ?> <br>
                <small class="text-muted">
                  Tensi: <?= $last_soap->tensi ?> mmHg |
                  Nadi: <?= $last_soap->nadi ?> x/mnt |
                  Suhu: <?= $last_soap->suhu_tubuh ?> °C |
                  RR: <?= $last_soap->respirasi ?> x/mnt
                </small>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-sm table-borderless mb-0">
            <tr>
              <td style="width: 100px;"><strong>A (Penilaian)</strong></td>
              <td>: <?= nl2br($last_soap->penilaian) ?></td>
            </tr>
            <tr>
              <td><strong>P (Instruksi)</strong></td>
              <td>: <?= nl2br($last_soap->instruksi) ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- 1. Pencarian dan Input Resep -->
<div class="box">
  <div class="box-header bg-light-blue">
    <i class="fa fa-medkit"></i> Permintaan Resep
  </div>
  <div class="box-body">
    <input type="hidden" id="no_rawat" value="<?= $no_rawat ?>">
    <input type="hidden" id="kd_dokter" value="<?= $kd_dokter ?>">
    <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">
    <input type="hidden" id="tgl_peresepan" value="<?= date('Y-m-d') ?>">
    <input type="hidden" id="jam_peresepan" value="<?= date('H:i:s') ?>">

    <div class="form-group">
      <label>Cari Obat</label>
      <input type="text" id="searchObat" class="form-control" placeholder="Nama obat...">
    </div>

    <div class="table-scroll">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Obat</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Signa</th>
          </tr>
        </thead>
        <tbody id="obatBody"></tbody>
      </table>
    </div>

    <div class="text-right mt-2">
      <button class="btn btn-primary" id="saveResep"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</div>

<!-- 2. Resep Hari Ini -->
<div class="box">
  <div class="box-header bg-red">
    <i class="fa fa-pills"></i> Resep Hari Ini
  </div>
  <div class="box-body">
    <div class="table-scroll">
      <div id="hasilResepGrouped"></div>
    </div>
    <div class="text-right mt-2">
      <strong>Total Harga Obat: </strong><span id="totalHargaObat">Rp 0</span>
    </div>
  </div>
</div>

<!-- 3. Riwayat Resep -->
<div class="box">
  <div class="box-header bg-blue">
    <i class="fa fa-history"></i> Riwayat Resep
  </div>
  <div class="box-body" id="containerRiwayatResep" style="max-height: 300px; overflow-y: auto;">
    <!-- Akan diisi dari JavaScript -->
  </div>
  <div class="box-footer text-right">
    <button class="btn btn-success btn-sm" id="btnCopyResepSelected">
      <i class="fa fa-copy"></i> Copy Semua
    </button>
  </div>
</div>


<script src="<?= asset_url('assets/js/resepRalan.js') ?>"></script>
<script>
  console.log("✅ View Loaded | no_rkm_medis = '<?= $no_rkm_medis ?>', no_rawat = '<?= $no_rawat ?>'");
</script>
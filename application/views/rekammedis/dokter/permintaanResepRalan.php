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
    border: none;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }

  .box-header {
    padding: 12px 20px;
    font-weight: 600;
    font-size: 15px;
    color: white;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .box-body {
    padding: 1.25rem;
    background-color: #fff;
  }

  .box-footer {
    padding: 0.75rem 1.25rem;
    border-top: 1px solid #e5e7eb;
    background: #f9fafb;
  }

  /* Modern Gradient Headers */
  .box-header.bg-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
  }

  .box-header.bg-light-blue {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  }

  .box-header.bg-red {
    background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
  }

  .box-header.bg-blue {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
  }

  /* Action Buttons */
  .resep-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    margin-right: 4px;
    vertical-align: middle;
  }

  .resep-action-edit {
    background: #3b82f6;
    color: white;
  }

  .resep-action-edit:hover {
    background: #2563eb;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
  }

  .resep-action-delete {
    background: #ef4444;
    color: white;
  }

  .resep-action-delete:hover {
    background: #dc2626;
    box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
  }

  /* Total Harga */
  .total-harga-box {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border: 2px solid #10b981;
    border-radius: 8px;
    padding: 12px 16px;
    margin-top: 12px;
  }

  .total-harga-box strong {
    color: #065f46;
    font-size: 14px;
  }

  .total-harga-box .amount {
    color: #059669;
    font-size: 18px;
    font-weight: 700;
  }
</style>

<!-- 0. Data SOAP Terakhir -->
<?php if (!empty($last_soap)): ?>
  <div class="box">
    <div class="box-header bg-success">
      <i class="fa fa-stethoscope"></i> Resume Medis Terakhir (SOAP)
      <span class="ml-auto" style="font-size: 12px; font-weight: normal;">
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
      <label><i class="fa fa-search"></i> Cari Obat</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
        <input type="text" id="searchObat" class="form-control" placeholder="Ketik nama obat...">
      </div>
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
    <div class="total-harga-box text-right">
      <strong>Total Harga Obat: </strong><span id="totalHargaObat" class="amount">Rp 0</span>
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
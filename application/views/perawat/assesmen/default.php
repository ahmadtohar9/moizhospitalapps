<div class="box box-success">
  <div class="box-header"><h3 class="box-title">Assessment Awal Perawat</h3></div>
  <div class="box-body">
    <form id="formAssesmenPerawat" class="form form-horizontal" data-mode="create">
      <input type="hidden" id="no_rawat"    value="<?= html_escape($no_rawat) ?>">
      <input type="hidden" id="kd_poli"     value="<?= html_escape($kd_poli ?? ($detail_pasien['kd_poli'] ?? '')) ?>">
      <input type="hidden" id="nip"         value="<?= html_escape($nip_perawat ?? '') ?>">

      <div class="row">
        <div class="col-sm-6">
          <label>Keluhan Utama</label>
          <textarea id="keluhan_utama" class="form-control" rows="3"></textarea>

          <label style="margin-top:8px">Alergi</label>
          <input id="alergi" class="form-control">
        </div>
        <div class="col-sm-6">
          <div class="row">
            <div class="col-xs-6"><label>Tensi</label><input id="tensi" class="form-control"></div>
            <div class="col-xs-6"><label>Nadi</label><input id="nadi" type="number" class="form-control"></div>
            <div class="col-xs-6"><label>RR</label><input id="respirasi" type="number" class="form-control"></div>
            <div class="col-xs-6"><label>Suhu</label><input id="suhu" type="number" step="0.1" class="form-control"></div>
            <div class="col-xs-6"><label>SpO2</label><input id="spo2" type="number" class="form-control"></div>
            <div class="col-xs-6"><label>BB (kg)</label><input id="bb" type="number" step="0.1" class="form-control"></div>
            <div class="col-xs-6"><label>TB (cm)</label><input id="tb" type="number" step="0.1" class="form-control"></div>
          </div>
        </div>
      </div>

      <hr>
      <div id="dynamicFields"></div>

      <div class="text-right" style="margin-top:10px">
        <button type="button" id="btnSaveAssesmen" class="btn btn-success">
          <i class="fa fa-save"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<script src="<?= base_url('assets/js/perawat/assesmen_default.js') ?>"></script>

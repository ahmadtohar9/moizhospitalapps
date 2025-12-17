<!-- ======================= FORM PEMERIKSAAN MATA ======================= -->
<div class="box box-success box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-eye"></i> Form Pemeriksaan Mata (Ralan)</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>
    </div>
  </div>

 <div class="box-body">
    <!-- Hidden keys -->
    <form id="formAwalMata" method="POST" class="form-horizontal">
      <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
      <input type="hidden" name="kd_dokter" value="<?= $kd_dokter ?>">
      <input type="hidden" id="global_no_rkm_medis" value="<?= $no_rkm_medis ?>">

      <!-- A. Tanggal & Jam - FIXED: Default value dari PHP dengan fallback -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-4 control-label">Tanggal Perawatan</label>
            <div class="col-sm-8">
              <input type="date" name="tgl_perawatan" id="tgl_perawatan" 
                     class="form-control input-sm" 
                     value="<?= isset($tgl_sekarang) ? $tgl_sekarang : date('Y-m-d') ?>" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-4 control-label">Jam Perawatan</label>
            <div class="col-sm-8">
              <input type="time" name="jam_rawat" id="jam_rawat" step="1" 
                     class="form-control input-sm" 
                     value="<?= isset($jam_sekarang) ? $jam_sekarang : date('H:i:s') ?>" required>
            </div>
          </div>
        </div>
      </div>

      <hr style="margin:10px 0">

      <!-- B. Anamnesis -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-4 control-label">Anamnesis</label>
            <div class="col-sm-8">
              <select name="anamnesis" id="anamnesis" class="form-control input-sm">
                <option value="Autoanamnesis">Autoanamnesis</option>
                <option value="Alloanamnesis">Alloanamnesis</option>
              </select>
              <span class="help-block" style="margin-bottom:0">Pilih sumber anamnesis</span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-4 control-label">Hubungan</label>
            <div class="col-sm-8">
              <input type="text" name="hubungan" id="hubungan" class="form-control input-sm" placeholder="Istri/Anak/Orang tua, dll">
            </div>
          </div>
        </div>
      </div>

      <!-- C. Riwayat Kesehatan -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">I. Riwayat Kesehatan</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Keluhan Utama</label>
            <div class="col-sm-10">
              <textarea name="keluhan_utama" id="keluhan_utama" rows="2" class="form-control" placeholder="Keluhan utama pasien"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Riwayat Penyakit Sekarang</label>
            <div class="col-sm-4">
              <textarea name="rps" id="rps" rows="2" class="form-control" placeholder="Riwayat Penyakit Sekarang"></textarea>
            </div>
            <label class="col-sm-2 control-label">Riwayat Penyakit Dahulu</label>
            <div class="col-sm-4">
              <textarea name="rpd" id="rpd" rows="2" class="form-control" placeholder="Riwayat Penyakit Dahulu"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="col-sm-2 control-label">Alergi</label>
            <div class="col-sm-10">
              <textarea name="alergi" id="alergi" rows="2" class="form-control" placeholder="Alergi obat/makanan/lingkungan"></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- D. Pemeriksaan Fisik -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">II. Pemeriksaan Fisik</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php
              $fisik = ['td' => 'TD (mmHg)', 'bb' => 'BB (kg)', 'suhu' => 'Suhu (°C)', 'nadi' => 'Nadi (/menit)', 'rr' => 'RR (/menit)', 'nyeri' => 'Nyeri'];
              foreach ($fisik as $id => $label) {
                echo "
                <div class='col-md-2'>
                  <div class='form-group' style='margin-bottom:10px'>
                    <label class='control-label'>$label</label>
                    <input type='text' name='$id' id='$id' class='form-control input-sm'>
                  </div>
                </div>";
              }
            ?>
          </div>
        </div>
      </div>

      <!-- E. Status Oftalmologis -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">III. Status Oftalmologis</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php
              $mata_fields = [
                'visuskanan','visuskiri','cckanan','cckiri','palkanan','palkiri',
                'conkanan','conkiri','corneakanan','corneakiri','coakanan','coakiri',
                'pupilkanan','pupilkiri','lensakanan','lensakiri','funduskanan','funduskiri',
                'papilkanan','papilkiri','retinakanan','retinakiri','makulakanan','makulakiri',
                'tiokanan','tiokiri','mbokanan','mbokiri'
              ];
              foreach ($mata_fields as $field) {
                $label = ucwords(str_replace('_',' ', $field));
                echo "
                <div class='col-md-6'>
                  <div class='form-group' style='margin-bottom:10px'>
                    <label class='control-label'>$label</label>
                    <input type='text' name='$field' id='$field' class='form-control input-sm'>
                  </div>
                </div>";
              }
            ?>
          </div>
        </div>
      </div>

      <!-- F. Penunjang -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">IV. Pemeriksaan Penunjang</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Laboratorium</label>
            <div class="col-sm-4">
              <textarea name="lab" id="lab" rows="2" class="form-control" placeholder="Pemeriksaan lab terkait"></textarea>
            </div>
            <label class="col-sm-2 control-label">Radiologi</label>
            <div class="col-sm-4">
              <textarea name="rad" id="rad" rows="2" class="form-control" placeholder="Foto/USG/CT, dll"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="col-sm-2 control-label">Penunjang Lain</label>
            <div class="col-sm-4">
              <textarea name="penunjang" id="penunjang" rows="2" class="form-control"></textarea>
            </div>
            <label class="col-sm-2 control-label">Tes Penglihatan</label>
            <div class="col-sm-4">
              <textarea name="tes" id="tes" rows="2" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-top:10px; margin-bottom:0">
            <label class="col-sm-2 control-label">Pemeriksaan Lain</label>
            <div class="col-sm-10">
              <textarea name="pemeriksaan" id="pemeriksaan" rows="2" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- G. Diagnosis -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">V. Diagnosis / Asesmen</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Diagnosis</label>
            <div class="col-sm-4">
              <textarea name="diagnosis" id="diagnosis" rows="2" class="form-control" placeholder="Diagnosis kerja"></textarea>
            </div>
            <label class="col-sm-2 control-label">Diagnosis Banding</label>
            <div class="col-sm-4">
              <textarea name="diagnosisbdg" id="diagnosisbdg" rows="2" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- H. Tatalaksana -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">VI. Permasalahan & Tatalaksana</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Permasalahan</label>
            <div class="col-sm-4">
              <textarea name="permasalahan" id="permasalahan" rows="2" class="form-control"></textarea>
            </div>
            <label class="col-sm-2 control-label">Terapi</label>
            <div class="col-sm-4">
              <textarea name="terapi" id="terapi" rows="2" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="col-sm-2 control-label">Tindakan/Rencana</label>
            <div class="col-sm-10">
              <textarea name="tindakan" id="tindakan" rows="2" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- I. Edukasi -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">VII. Edukasi</h3>
        </div>
        <div class="box-body">
          <div class="form-group" style="margin-bottom:0">
            <label class="col-sm-2 control-label">Edukasi</label>
            <div class="col-sm-10">
              <textarea name="edukasi" id="edukasi" rows="3" class="form-control" placeholder="Edukasi yang diberikan kepada pasien/keluarga"></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol -->
      <div class="text-right">
        <button type="submit" class="btn btn-primary" id="btnSubmit">
          <i class="fa fa-save"></i> Simpan
        </button>
        <button type="button" class="btn btn-default" id="cancelEdit">
          <i class="fa fa-times"></i> Batal
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ======================= HASIL & RIWAYAT ======================= -->
<div class="row">
  <!-- Hasil Pemeriksaan -->
  <div class="col-md-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-clipboard-check"></i> Hasil Pemeriksaan</h3>
        <div class="box-tools pull-right">
          <span class="label label-default" id="count-hasil">0 data</span>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body no-padding">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th style="width:45px">No</th>
                <th style="width:110px">Tanggal</th>
                <th style="width:90px">Jam</th>
                <th style="width:130px">Dokter</th>
                <th>Keluhan Utama</th>
                <th>Diagnosis</th>
                <th>Rencana/Tindakan</th>
                <th style="width:210px">Aksi</th>
              </tr>
            </thead>
            <tbody id="hasil-pemeriksaan-body"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Riwayat Pemeriksaan -->
  <div class="col-md-12">
    <div class="box box-purple box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-history"></i> Riwayat Pemeriksaan</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-default btn-xs" id="btnCopyAll">
            <i class="fa fa-copy"></i> Copy Semua
          </button>
          <span class="label label-default" id="count-riwayat">0 data</span>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body no-padding">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th style="width:45px">No</th>
                <th style="width:110px">Tanggal</th>
                <th style="width:90px">Jam</th>
                <th style="width:130px">Dokter</th>
                <th>Keluhan Utama</th>
                <th>Diagnosis</th>
                <th>Rencana/Tindakan</th>
                <th style="width:120px">Aksi</th>
              </tr>
            </thead>
            <tbody id="riwayat-body"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ======================= MODAL DETAIL ======================= -->
<div class="modal fade" id="detailAwalMataModal" tabindex="-1" role="dialog" aria-labelledby="detailAwalMataLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
        <h4 class="modal-title" id="detailAwalMataLabel">
          <i class="fa fa-file-text-o"></i> Detail Pemeriksaan Mata
        </h4>
      </div>
      <div class="modal-body">
        <!-- Info ringkas -->
        <div class="row" style="margin-bottom:10px">
          <div class="col-sm-4"><strong>Tanggal</strong><br><span id="det_tgl" class="label label-primary">-</span></div>
          <div class="col-sm-4"><strong>Jam</strong><br><span id="det_jam" class="label label-success">-</span></div>
          <div class="col-sm-4"><strong>Dokter</strong><br><span id="det_dokter" class="label label-warning">-</span></div>
        </div>

        <!-- Tab semua bagian -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">I. Riwayat</a></li>
          <li><a href="#tab2" data-toggle="tab">II. Fisik</a></li>
          <li><a href="#tab3" data-toggle="tab">III. Oftalmologis</a></li>
          <li><a href="#tab4" data-toggle="tab">IV. Penunjang</a></li>
          <li><a href="#tab5" data-toggle="tab">V. Diagnosis</a></li>
          <li><a href="#tab6" data-toggle="tab">VI. Tatalaksana</a></li>
          <li><a href="#tab7" data-toggle="tab">VII. Edukasi</a></li>
        </ul>

        <div class="tab-content" style="margin-top:10px">
          <!-- I. Riwayat -->
          <div class="tab-pane active" id="tab1">
            <dl class="dl-horizontal">
              <dt>Anamnesis</dt><dd id="det_anamnesis">-</dd>
              <dt>Hubungan</dt><dd id="det_hubungan">-</dd>
              <dt>Keluhan Utama</dt><dd id="det_keluhan">-</dd>
              <dt>RPS</dt><dd id="det_rps">-</dd>
              <dt>RPD</dt><dd id="det_rpd">-</dd>
              <dt>Alergi</dt><dd id="det_alergi">-</dd>
            </dl>
          </div>

          <!-- II. Fisik -->
          <div class="tab-pane" id="tab2">
            <dl class="dl-horizontal">
              <dt>TD</dt><dd id="det_td">-</dd>
              <dt>BB</dt><dd id="det_bb">-</dd>
              <dt>Suhu</dt><dd id="det_suhu">-</dd>
              <dt>Nadi</dt><dd id="det_nadi">-</dd>
              <dt>RR</dt><dd id="det_rr">-</dd>
              <dt>Nyeri</dt><dd id="det_nyeri">-</dd>
            </dl>
          </div>

          <!-- III. Oftalmologis -->
          <div class="tab-pane" id="tab3">
            <div class="row">
              <div class="col-sm-6">
                <h5><strong>Mata Kanan</strong></h5>
                <ul class="list-unstyled">
                  <li>Visus: <span id="det_visuskanan">-</span></li>
                  <li>CC: <span id="det_cckanan">-</span></li>
                  <li>Palpebra: <span id="det_palkanan">-</span></li>
                  <li>Conj.: <span id="det_conkanan">-</span></li>
                  <li>Cornea: <span id="det_corneakanan">-</span></li>
                  <li>COA: <span id="det_coakanan">-</span></li>
                  <li>Pupil: <span id="det_pupilkanan">-</span></li>
                  <li>Lensa: <span id="det_lensakanan">-</span></li>
                  <li>Fundus: <span id="det_funduskanan">-</span></li>
                  <li>Papil: <span id="det_papilkanan">-</span></li>
                  <li>Retina: <span id="det_retinakanan">-</span></li>
                  <li>Makula: <span id="det_makulakanan">-</span></li>
                  <li>TIO: <span id="det_tiokanan">-</span></li>
                  <li>MBO: <span id="det_mbokanan">-</span></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <h5><strong>Mata Kiri</strong></h5>
                <ul class="list-unstyled">
                  <li>Visus: <span id="det_visuskiri">-</span></li>
                  <li>CC: <span id="det_cckiri">-</span></li>
                  <li>Palpebra: <span id="det_palkiri">-</span></li>
                  <li>Conj.: <span id="det_conkiri">-</span></li>
                  <li>Cornea: <span id="det_corneakiri">-</span></li>
                  <li>COA: <span id="det_coakiri">-</span></li>
                  <li>Pupil: <span id="det_pupilkiri">-</span></li>
                  <li>Lensa: <span id="det_lensakiri">-</span></li>
                  <li>Fundus: <span id="det_funduskiri">-</span></li>
                  <li>Papil: <span id="det_papilkiri">-</span></li>
                  <li>Retina: <span id="det_retinakiri">-</span></li>
                  <li>Makula: <span id="det_makulakiri">-</span></li>
                  <li>TIO: <span id="det_tiokiri">-</span></li>
                  <li>MBO: <span id="det_mbokiri">-</span></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- IV. Penunjang -->
          <div class="tab-pane" id="tab4">
            <dl class="dl-horizontal">
              <dt>Laboratorium</dt><dd id="det_lab">-</dd>
              <dt>Radiologi</dt><dd id="det_rad">-</dd>
              <dt>Penunjang</dt><dd id="det_penunjang">-</dd>
              <dt>Tes Penglihatan</dt><dd id="det_tes">-</dd>
              <dt>Pemeriksaan Lain</dt><dd id="det_pemeriksaan">-</dd>
            </dl>
          </div>

          <!-- V. Diagnosis -->
          <div class="tab-pane" id="tab5">
            <dl class="dl-horizontal">
              <dt>Diagnosis</dt><dd id="det_diagnosis">-</dd>
              <dt>Diagnosis Banding</dt><dd id="det_diagnosisbdg">-</dd>
            </dl>
          </div>

          <!-- VI. Tatalaksana -->
          <div class="tab-pane" id="tab6">
            <dl class="dl-horizontal">
              <dt>Permasalahan</dt><dd id="det_permasalahan">-</dd>
              <dt>Terapi</dt><dd id="det_terapi">-</dd>
              <dt>Tindakan / Rencana</dt><dd id="det_tindakan">-</dd>
            </dl>
          </div>

          <!-- VII. Edukasi -->
          <div class="tab-pane" id="tab7">
            <dl class="dl-horizontal">
              <dt>Edukasi</dt><dd id="det_edukasi">-</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Define API URLs dengan routes yang sudah ada -->
<script>
if (typeof API_URLS === 'undefined') {
  var API_URLS = {
    saveAwalMata: '<?= site_url("medis-mata/save") ?>',
    updateAwalMata: '<?= site_url("medis-mata/update") ?>',
    deleteAwalMata: '<?= site_url("medis-mata/delete") ?>',
    getAwalMata: '<?= site_url("medis-mata/get-hasil") ?>',
    getDetailAwalMata: '<?= site_url("medis-mata/get-detail") ?>',
    getRiwayatAwalMata: '<?= site_url("medis-mata/get-riwayat-norm") ?>',
    getLastAwalMata: '<?= site_url("medis-mata/get-last") ?>',
    printAwalMata: '<?= site_url("medis-mata/cetak") ?>',
    syncSession: '<?= site_url("medis-mata/sync-session") ?>'
  };
}

// Debug: Check if URLs are properly rendered
console.log("🔧 API_URLS check:", {
  getRiwayatAwalMata: API_URLS.getRiwayatAwalMata,
  isValid: API_URLS.getRiwayatAwalMata && !API_URLS.getRiwayatAwalMata.includes('undefined')
});

</script>

<!-- File JS utama -->
<script src="<?= base_url('assets/js/awalMedisDokterMataRalan.js?v=') . time(); ?>"></script>
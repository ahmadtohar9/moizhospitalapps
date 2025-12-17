/* assets/js/dokterRalan/rujukanKeluarRalan.js (FINAL) */
(function ($, window, document) {
  'use strict';

  /* =========================
   * Endpoint namespace
   * ========================= */
  var API = (window.API && window.API.rujukanKeluarRalan) ? window.API.rujukanKeluarRalan : {};
  if (!API || !API.getData) console.error('❌ Endpoint Surat Rujukan Keluar tidak terdefinisi.');

  /* =========================
   * CSRF Helpers (CI3)
   * ========================= */
  var csrf = { name: null, token: null };
  function updateCsrf(res) {
    if (res && res.csrfName && res.csrfToken) {
      csrf.name  = res.csrfName;
      csrf.token = res.csrfToken;
    }
  }
  function addCsrf(data) {
    if (!data) data = {};
    if (csrf.name && csrf.token) data[csrf.name] = csrf.token;
    return data;
  }
  $.ajaxSetup({
    beforeSend: function (_xhr, settings) {
      if (settings.type && settings.type.toUpperCase() === 'POST') {
        if (typeof settings.data === 'string') {
          var extra = csrf.name && csrf.token ? '&' + encodeURIComponent(csrf.name) + '=' + encodeURIComponent(csrf.token) : '';
          settings.data += extra;
        } else if ($.isPlainObject(settings.data)) {
          settings.data = addCsrf(settings.data);
        }
      }
    }
  });

  /* =========================
   * Utils
   * ========================= */
  function tryParseJSON(raw) {
    if (raw == null) return null;
    if (typeof raw !== 'string') return raw;
    try { return JSON.parse(raw); } catch { return null; }
  }
  function handleJSON(raw, cb, ctx) {
    var json = tryParseJSON(raw);
    if (json) { updateCsrf(json); cb(json); return; }
    console.error('❌ Expected JSON in ' + ctx + ':', raw);
    if (window.Swal) Swal.fire({ icon: 'error', title: 'Error', text: 'Respon tidak valid (' + ctx + ')' });
  }
  function fmt(x){ return (x==null||x==='')?'-':String(x); }
  function todayISO(){ return (new Date()).toISOString().slice(0,10); }
  function scrollTo(el){ $('html,body').animate({scrollTop: $(el).offset().top - 60}, 300); }

  /* =========================
   * DOM Cache
   * ========================= */
  var $form, $id, $no_rawat, $kd_dokter, $no_rkm_medis,
      $noSurat, $tglSurat,
      $kepadaDokter, $spesialis, $rs, $alamat, $alasan,
      $anamnesa, $fisik, $penunjang, $diagnosa, $tindakan, $obat,
      $isGuardian, $namaWali, $hubWali,
      $statusBox, $sumNoSurat, $sumTglSurat, $sumDokterTujuan, $sumRS, $sumFinal,
      $previewDok, $previewPas,
      $btnSave, $btnUpdate, $btnCancel,
      $btnView, $btnTTD, $btnEdit, $btnPrint, $btnDelete;

  function cacheDom(){
    $form         = $('#rujukanKeluarForm');
    $id           = $('#rk_id');
    $no_rawat     = $('#rk_no_rawat');
    $kd_dokter    = $('#rk_kd_dokter');
    $no_rkm_medis = $('#rk_no_rkm_medis');

    $noSurat  = $('#rk_no_surat');
    $tglSurat = $('#rk_tgl_surat');

    $kepadaDokter = $('#rk_kepada_dokter');
    $spesialis    = $('#rk_spesialis_tujuan');
    $rs           = $('#rk_rs_tujuan');
    $alamat       = $('#rk_alamat_tujuan');
    $alasan       = $('#rk_alasan_rujuk');
    $anamnesa     = $('#rk_anamnesa');
    $fisik        = $('#rk_pemeriksaan_fisik');
    $penunjang    = $('#rk_pemeriksaan_penunjang');
    $diagnosa     = $('#rk_diagnosa');
    $tindakan     = $('#rk_tindakan');
    $obat         = $('#rk_obat');

    $isGuardian = $('#rk_is_guardian');
    $namaWali   = $('#rk_nama_wali');
    $hubWali    = $('#rk_hubungan_wali');

    $statusBox        = $('#statusRujukan');
    $sumNoSurat       = $('#sum_no_surat');
    $sumTglSurat      = $('#sum_tgl_surat');
    $sumDokterTujuan  = $('#sum_kepada_dokter');
    $sumRS            = $('#sum_rs_tujuan');
    $sumFinal         = $('#sum_is_final');

    $previewDok = $('#preview-ttd-dokter');
    $previewPas = $('#preview-ttd-pasien');

    $btnSave   = $('#btnRKSave');
    $btnUpdate = $('#btnRKUpdate');
    $btnCancel = $('#btnRKCancel');

    $btnView   = $('#btnRKView');
    $btnTTD    = $('#btnRKTTD');
    $btnEdit   = $('#btnRKEdit');
    $btnPrint  = $('#btnRKPrint');
    $btnDelete = $('#btnRKDelete');
  }

  /* =========================
   * SignaturePad setup
   * ========================= */
  var sig = {
    dokter: { pad: null, canvas: null, clearBtn: '#btnClearTTDDokter', saveBtn: '#btnSaveTTDDokter' },
    pasien: { pad: null, canvas: null, clearBtn: '#btnClearTTDPasien', saveBtn: '#btnSaveTTDPasien' }
  };

  function initSignaturePads(){
    // Dokter
    sig.dokter.canvas = document.getElementById('canvasTTDDokter');
    if (sig.dokter.canvas) {
      sig.dokter.pad = new SignaturePad(sig.dokter.canvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
      $(sig.dokter.clearBtn).off('click').on('click', function(){ sig.dokter.pad.clear(); });
      $(sig.dokter.saveBtn).off('click').on('click', function(){
        var idVal = $id.val();
        if (!idVal) return Swal.fire('Info','Simpan dulu surat sebelum TTD dokter.','info');
        if (sig.dokter.pad.isEmpty()) return Swal.fire('Info','Silakan tanda tangan dokter dulu.','info');
        var dataURL = sig.dokter.pad.toDataURL('image/png');
        var post = addCsrf({ id:idVal, ttd:dataURL });
        $.post(API.signDoctor, $.param(post), function(res){
          handleJSON(res, function(r){
            if (r.status==='success') {
              Swal.fire({ icon:'success', title:'Berhasil', text:r.message||'TTD dokter tersimpan.', timer:1200, showConfirmButton:false });
              loadData();
            } else Swal.fire('Error', r.message||'Gagal menyimpan TTD dokter.', 'error');
          }, 'signDoctor');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
    }

    // Pasien
    sig.pasien.canvas = document.getElementById('canvasTTDPasien');
    if (sig.pasien.canvas) {
      sig.pasien.pad = new SignaturePad(sig.pasien.canvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
      $(sig.pasien.clearBtn).off('click').on('click', function(){ sig.pasien.pad.clear(); });
      $(sig.pasien.saveBtn).off('click').on('click', function(){
        var idVal = $id.val();
        if (!idVal) return Swal.fire('Info','Simpan dulu surat sebelum TTD pasien/wali.','info');
        if (sig.pasien.pad.isEmpty()) return Swal.fire('Info','Silakan tanda tangan pasien/wali dulu.','info');
        var dataURL = sig.pasien.pad.toDataURL('image/png');
        var post = addCsrf({ id:idVal, ttd:dataURL });
        $.post(API.signPatient, $.param(post), function(res){
          handleJSON(res, function(r){
            if (r.status==='success') {
              Swal.fire({ icon:'success', title:'Berhasil', text:r.message||'TTD pasien/wali tersimpan.', timer:1200, showConfirmButton:false });
              loadData();
            } else Swal.fire('Error', r.message||'Gagal menyimpan TTD pasien/wali.', 'error');
          }, 'signPatient');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
    }
  }

  /* =========================
   * Collect payload
   * ========================= */
  function collectPayload(withId){
    var data = {
      no_rawat: $no_rawat.val(),
      kd_dokter: $kd_dokter.val(),
      no_rkm_medis: $no_rkm_medis.val(),
      tgl_surat: $tglSurat.val(),
      kepada_dokter: $kepadaDokter.val(),
      spesialis_tujuan: $spesialis.val(),
      rs_tujuan: $rs.val(),
      alamat_tujuan: $alamat.val(),
      alasan_rujuk: $alasan.val(),
      anamnesa: $anamnesa.val(),
      pemeriksaan_fisik: $fisik.val(),
      pemeriksaan_penunjang: $penunjang.val(),
      diagnosa_sementara: $diagnosa.val(),
      tindakan: $tindakan.val(),
      obat: $obat.val(),
      is_signed_by_guardian: $isGuardian.is(':checked') ? 1 : 0,
      nama_wali: $namaWali.val(),
      hubungan_wali: $hubWali.val()
    };
    if (withId) data.id = $id.val();
    return addCsrf(data);
  }

  /* =========================
   * UI Sync
   * ========================= */
  function syncUI(row){
    if (row) {
      $statusBox.removeClass('alert-warning').addClass('alert-success')
        .html('Surat rujukan keluar untuk <strong>'+fmt($no_rawat.val())+'</strong> sudah tersimpan.');
      $btnPrint.prop('disabled', false);
    } else {
      $statusBox.removeClass('alert-success').addClass('alert-warning')
        .html('Belum ada surat rujukan keluar untuk <strong>'+fmt($no_rawat.val())+'</strong>.');
      $btnPrint.prop('disabled', true);
    }

    $sumNoSurat.text(fmt(row && row.no_surat));
    $sumTglSurat.text(fmt(row && row.tgl_surat));
    $sumDokterTujuan.text(fmt(row && row.kepada_dokter));
    $sumRS.text(fmt(row && row.rs_tujuan));
    $sumFinal.text((row && Number(row.is_final)===1) ? 'Ya' : 'Belum');

    var d = row && row.ttd_dokter ? row.ttd_dokter : '';
    var p = row && row.ttd_pasien ? row.ttd_pasien : '';
    if (d && d.indexOf('data:image') !== 0) d = 'data:image/png;base64,'+d;
    if (p && p.indexOf('data:image') !== 0) p = 'data:image/png;base64,'+p;

    if (d) $previewDok.attr('src', d).show(); else $previewDok.hide().attr('src','');
    if (p) $previewPas.attr('src', p).show(); else $previewPas.hide().attr('src','');

    var has = !!row;
    $btnView.prop('disabled', !has);
    $btnTTD.prop('disabled', !has);
    $btnEdit.prop('disabled', !has);
    $btnDelete.prop('disabled', !has);
  }

  /* =========================
   * Fill & Reset Form
   * ========================= */
  function fillForm(row){
    if (!row) return;
    $id.val(row.id || '');
    $noSurat.val(row.no_surat || '');
    $tglSurat.val(row.tgl_surat || todayISO());

    $kepadaDokter.val(row.kepada_dokter || '');
    $spesialis.val(row.spesialis_tujuan || '');
    $rs.val(row.rs_tujuan || '');
    $alamat.val(row.alamat_tujuan || '');
    $alasan.val(row.alasan_rujuk || '');
    $anamnesa.val(row.anamnesa || '');
    $fisik.val(row.pemeriksaan_fisik || '');
    $penunjang.val(row.pemeriksaan_penunjang || '');
    $diagnosa.val(row.diagnosa_sementara || '');
    $tindakan.val(row.tindakan || '');
    $obat.val(row.obat || '');

    var guardian = Number(row.is_signed_by_guardian||0)===1;
    $isGuardian.prop('checked', guardian).trigger('change');
    if (guardian){ $namaWali.val(row.nama_wali||''); $hubWali.val(row.hubungan_wali||''); }
    else { $namaWali.val(''); $hubWali.val(''); }

    $btnSave.hide(); $btnUpdate.show();
  }

  function setCreateMode(){
    $id.val('');
    $noSurat.val('');
    $tglSurat.val(todayISO());
    $kepadaDokter.val(''); $spesialis.val(''); $rs.val('');
    $alamat.val(''); $alasan.val(''); $anamnesa.val('');
    $fisik.val(''); $penunjang.val(''); $diagnosa.val('');
    $tindakan.val(''); $obat.val('');
    $isGuardian.prop('checked', false).trigger('change');
    $namaWali.val(''); $hubWali.val('');

    $btnUpdate.hide(); $btnSave.show();
    if (sig.dokter && sig.dokter.pad) sig.dokter.pad.clear();
    if (sig.pasien && sig.pasien.pad) sig.pasien.pad.clear();
    syncUI(null);
  }

  /* =========================
   * Load existing
   * ========================= */
  function loadData(cb){
    var nr = $no_rawat.val();
    if (!nr) { Swal.fire('Error','No. Rawat tidak ditemukan.','error'); return; }
    $.get(API.getData, { no_rawat: nr }, function(res){
      handleJSON(res, function(r){
        if (r.status==='success' && r.data){
          fillForm(r.data);
          syncUI(r.data);
          cb && cb(r.data);
        } else {
          setCreateMode(); cb && cb(null);
        }
      }, 'getByNoRawat');
    }).fail(function(xhr){ console.error('❌ loadData failed', xhr); });
  }

  /* =========================
   * Actions (CRUD + Print)
   * ========================= */
  function doSave(){
    var payload = collectPayload(false);
    if (!payload.no_rawat) return Swal.fire('Error','No. Rawat kosong.','error');
    if (!payload.kepada_dokter || !payload.rs_tujuan)
      return Swal.fire('Info','Dokter tujuan dan RS tujuan wajib diisi.','info');

    var old = $btnSave.html();
    $btnSave.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
    $.ajax({
      url: API.save, method:'POST', data:$.param(payload),
      statusCode:{
        409:function(xhr){
          let msg='Surat rujukan keluar untuk nomor rawat ini sudah ada.';
          try{const r=JSON.parse(xhr.responseText);if(r&&r.message)msg=r.message;updateCsrf(r);}catch(_){}
          Swal.fire('Info',msg,'info');loadData();
        }
      }
    })
    .done(function(res){ handleJSON(res,function(r){
      if(r.status==='success'){
        Swal.fire({icon:'success',title:'Berhasil',text:r.message||'Tersimpan.',timer:1400,showConfirmButton:false});
        loadData();
      } else Swal.fire('Error',r.message||'Gagal menyimpan.','error');
    },'save'); })
    .fail(()=>Swal.fire('Error','Gagal menghubungi server.','error'))
    .always(()=>{ $btnSave.prop('disabled',false).html(old); });
  }

  function doUpdate(){
    var payload=collectPayload(true);
    if(!payload.id)return Swal.fire('Error','ID tidak ditemukan.','error');
    var old=$btnUpdate.html();
    $btnUpdate.prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');
    $.post(API.update,$.param(payload),function(res){
      handleJSON(res,function(r){
        if(r.status==='success'){
          Swal.fire({icon:'success',title:'Berhasil',text:r.message||'Diperbarui.',timer:1200,showConfirmButton:false});
          loadData();
        }else Swal.fire('Error',r.message||'Gagal memperbarui.','error');
      },'update');
    }).fail(()=>Swal.fire('Error','Gagal menghubungi server.','error'))
    .always(()=>{$btnUpdate.prop('disabled',false).html(old);});
  }

  function doDelete(){
    var idVal=$id.val();
    if(!idVal)return Swal.fire('Error','ID tidak ditemukan.','error');
    Swal.fire({title:'Yakin hapus surat ini?',icon:'warning',showCancelButton:true,confirmButtonText:'Ya, hapus'})
      .then(r=>{
        if(!r.isConfirmed)return;
        var payload=addCsrf({id:idVal});
        $.post(API.delete,$.param(payload),function(res){
          handleJSON(res,function(d){
            if(d.status==='success'){
              Swal.fire({icon:'success',title:'Berhasil',text:d.message||'Terhapus.',timer:1200,showConfirmButton:false});
              setCreateMode();
            }else Swal.fire('Error',d.message||'Gagal menghapus.','error');
          },'delete');
        }).fail(()=>Swal.fire('Error','Gagal menghubungi server.','error'));
      });
  }

  function doPrint(){
    var idVal=$id.val();
    if(!idVal)return Swal.fire('Info','Belum ada data untuk dicetak.','info');
    var url=(API.print||'#')+'?id='+encodeURIComponent(idVal);
    window.open(url,'_blank');
  }

  /* =========================
   * Bindings
   * ========================= */
  $(document).ready(function(){
    cacheDom(); initSignaturePads();

    $('#rk_is_guardian').on('change',function(){
      document.getElementById('guardian_fields').style.display=this.checked?'block':'none';
    });

    $btnSave.on('click', e=>{e.preventDefault();doSave();});
    $btnUpdate.on('click', e=>{e.preventDefault();doUpdate();});
    $btnCancel.on('click', e=>{e.preventDefault();setCreateMode();});
    $btnView.on('click', e=>{e.preventDefault();loadData(row=>{if(row)Swal.fire({html:`<b>Tujuan:</b> ${fmt(row.rs_tujuan)}<br><b>Dokter:</b> ${fmt(row.kepada_dokter)}<br><b>Alasan:</b> ${fmt(row.alasan_rujuk)}`,showCloseButton:true});});});
    $btnTTD.on('click', e=>{e.preventDefault();scrollTo('#canvasTTDDokter');});
    $btnEdit.on('click', e=>{e.preventDefault();loadData(row=>{if(row){fillForm(row);scrollTo('#rujukanKeluarForm');}});});
    $btnPrint.on('click', e=>{e.preventDefault();doPrint();});
    $btnDelete.on('click', e=>{e.preventDefault();doDelete();});

    loadData();
  });

})(jQuery, window, document);

/* assets/js/dokterRalan/suratSakitRalan.js (FINAL) */
(function ($, window, document) {
  'use strict';

  /* =========================
   * Endpoint namespace
   * ========================= */
  var API = (window.API && window.API.suratSakitRalan) ? window.API.suratSakitRalan : {};
  if (!API || !API.getData) console.error('❌ Endpoint Surat Sakit Ralan tidak terdefinisi.');

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
      $noSurat, $tglSurat, $tglMulai, $lamaHari, $ket,
      $isGuardian, $namaWali, $hubWali,
      $statusBox, $sumNoSurat, $sumTglSurat, $sumTglMulai, $sumLama, $sumFinal,
      $previewDok, $previewPas,
      $btnSave, $btnUpdate, $btnCancel,
      $btnView, $btnTTD, $btnEdit, $btnPrint, $btnDelete;

  function cacheDom(){
    $form         = $('#suratSakitForm');
    $id           = $('#ss_id');
    $no_rawat     = $('#ss_no_rawat');
    $kd_dokter    = $('#ss_kd_dokter');
    $no_rkm_medis = $('#ss_no_rkm_medis');

    $noSurat   = $('#ss_no_surat');
    $tglSurat  = $('#ss_tgl_surat');
    $tglMulai  = $('#ss_tgl_mulai');
    $lamaHari  = $('#ss_lama_hari');
    $ket       = $('#ss_keterangan');

    $isGuardian = $('#ss_is_guardian');
    $namaWali   = $('#ss_nama_wali');
    $hubWali    = $('#ss_hubungan_wali');

    $statusBox   = $('#statusSuratSakit');
    $sumNoSurat  = $('#sum_no_surat');
    $sumTglSurat = $('#sum_tgl_surat');
    $sumTglMulai = $('#sum_tgl_mulai');
    $sumLama     = $('#sum_lama_hari');
    $sumFinal    = $('#sum_is_final');

    $previewDok = $('#preview-ttd-dokter');
    $previewPas = $('#preview-ttd-pasien');

    $btnSave   = $('#btnSSSave');
    $btnUpdate = $('#btnSSUpdate');
    $btnCancel = $('#btnSSCancel');

    $btnView   = $('#btnSSView');
    $btnTTD    = $('#btnSSTTD');
    $btnEdit   = $('#btnSSEdit');
    $btnPrint  = $('#btnSSPrint');
    $btnDelete = $('#btnSSDelete');
  }

  /* =========================
   * SignaturePad (Dokter & Pasien)
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
        if (!idVal) return Swal.fire('Info','Simpan dulu suratnya sebelum TTD dokter.','info');
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

    // Pasien / Wali
    sig.pasien.canvas = document.getElementById('canvasTTDPasien');
    if (sig.pasien.canvas) {
      sig.pasien.pad = new SignaturePad(sig.pasien.canvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
      $(sig.pasien.clearBtn).off('click').on('click', function(){ sig.pasien.pad.clear(); });
      $(sig.pasien.saveBtn).off('click').on('click', function(){
        var idVal = $id.val();
        if (!idVal) return Swal.fire('Info','Simpan dulu suratnya sebelum TTD pasien/wali.','info');
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
      tgl_mulai_istirahat: $tglMulai.val(),
      lama_istirahat_hari: $lamaHari.val(),
      keterangan: $ket.val(),
      is_signed_by_guardian: $isGuardian.is(':checked') ? 1 : 0,
      nama_wali: $namaWali.val(),
      hubungan_wali: $hubWali.val()
    };
    if (withId) data.id = $id.val();
    return addCsrf(data);
  }

  /* =========================
   * UI Sync (status, summary, preview, toolbar)
   * ========================= */
  function syncUI(row){
    // Status badge
    if (row) {
      $statusBox
        .removeClass('alert-warning').addClass('alert-success')
        .html('Surat sakit untuk <strong>'+ fmt($no_rawat.val()) +'</strong> sudah tersimpan.');
      $btnPrint.prop('disabled', false);
    } else {
      $statusBox
        .removeClass('alert-success').addClass('alert-warning')
        .html('Belum ada surat sakit untuk <strong>'+ fmt($no_rawat.val()) +'</strong>.');
      $btnPrint.prop('disabled', true);
    }

    // Summary
    $sumNoSurat.text(fmt(row && row.no_surat));
    $sumTglSurat.text(fmt(row && row.tgl_surat));
    $sumTglMulai.text(fmt(row && row.tgl_mulai_istirahat));
    $sumLama.text(fmt(row && row.lama_istirahat_hari));
    $sumFinal.text((row && Number(row.is_final)===1) ? 'Ya' : 'Belum');

    // Preview TTD
    var d = row && row.ttd_dokter ? row.ttd_dokter : '';
    var p = row && row.ttd_pasien ? row.ttd_pasien : '';
    if (d && d.indexOf('data:image') !== 0) d = 'data:image/png;base64,' + d;
    if (p && p.indexOf('data:image') !== 0) p = 'data:image/png;base64,' + p;

    if (d) { $previewDok.attr('src', d).show(); } else { $previewDok.hide().attr('src',''); }
    if (p) { $previewPas.attr('src', p).show(); } else { $previewPas.hide().attr('src',''); }

    // Toolbar state
    var has = !!row;
    $btnView.prop('disabled', !has);
    $btnTTD.prop('disabled', !has);
    $btnEdit.prop('disabled', !has);
    $btnDelete.prop('disabled', !has);
  }

  /* =========================
   * Fill form / reset
   * ========================= */
  function fillForm(row){
    if (!row) return;
    $id.val(row.id || '');
    $noSurat.val(row.no_surat || '');
    $tglSurat.val(row.tgl_surat || todayISO());
    $tglMulai.val(row.tgl_mulai_istirahat || '');
    $lamaHari.val(row.lama_istirahat_hari || '');
    $ket.val(row.keterangan || '');
    var guardian = Number(row.is_signed_by_guardian||0)===1;
    $isGuardian.prop('checked', guardian).trigger('change');
    if (guardian) { $namaWali.val(row.nama_wali || ''); $hubWali.val(row.hubungan_wali || ''); }
    else { $namaWali.val(''); $hubWali.val(''); }
    // buttons
    $btnSave.hide();
    $btnUpdate.show();
  }

  function setCreateMode(){
    $id.val('');
    $noSurat.val('');
    if (!$tglSurat.val()) $tglSurat.val(todayISO());
    $tglMulai.val('');
    $lamaHari.val('');
    $ket.val('');
    $isGuardian.prop('checked', false).trigger('change');
    $namaWali.val(''); $hubWali.val('');

    $btnUpdate.hide();
    $btnSave.show();

    // canvas clear
    if (sig.dokter && sig.dokter.pad) sig.dokter.pad.clear();
    if (sig.pasien && sig.pasien.pad) sig.pasien.pad.clear();

    syncUI(null);
  }

  /* =========================
   * Load existing (single-entry per no_rawat)
   * ========================= */
  function loadData(cb){
    var nr = $no_rawat.val();
    if (!nr) { Swal.fire('Error','No. Rawat tidak ditemukan.','error'); return; }
    $.get(API.getData, { no_rawat: nr }, function(res){
      handleJSON(res, function(r){
        if (r.status === 'success' && r.data) {
          fillForm(r.data);
          syncUI(r.data);
          cb && cb(r.data);
        } else {
          setCreateMode();
          cb && cb(null);
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
    if (!payload.tgl_mulai_istirahat || !payload.lama_istirahat_hari)
      return Swal.fire('Info','Tanggal mulai istirahat dan lama hari wajib diisi.','info');

    var old = $btnSave.html();
    $btnSave.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: API.save, method: 'POST', data: $.param(payload),
      statusCode: {
        409: function (xhr) {
          let msg = 'Surat sakit untuk nomor rawat ini sudah ada.';
          try { const r = JSON.parse(xhr.responseText); if (r && r.message) msg = r.message; updateCsrf(r); } catch(_){}
          Swal.fire('Info', msg, 'info'); loadData();
        }
      }
    })
    .done(function(res){
      handleJSON(res, function(r){
        if (r.status === 'success') {
          Swal.fire({ icon:'success', title:'Berhasil', text:r.message || 'Tersimpan.', timer:1400, showConfirmButton:false });
          loadData();
        } else Swal.fire('Error', r.message || 'Gagal menyimpan.', 'error');
      }, 'save');
    })
    .fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); })
    .always(function(){ $btnSave.prop('disabled', false).html(old); });
  }

  function doUpdate(){
    var payload = collectPayload(true);
    if (!payload.id) return Swal.fire('Error','ID tidak ditemukan.','error');

    var old = $btnUpdate.html();
    $btnUpdate.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

    $.post(API.update, $.param(payload), function(res){
      handleJSON(res, function(r){
        if (r.status === 'success') {
          Swal.fire({ icon:'success', title:'Berhasil', text:r.message || 'Diperbarui.', timer:1200, showConfirmButton:false });
          loadData();
        } else Swal.fire('Error', r.message || 'Gagal memperbarui.', 'error');
      }, 'update');
    }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); })
      .always(function(){ $btnUpdate.prop('disabled', false).html(old); });
  }

  function doDelete(){
    var idVal = $id.val();
    if (!idVal) return Swal.fire('Error','ID tidak ditemukan.','error');

    Swal.fire({ title:'Yakin hapus surat ini?', icon:'warning', showCancelButton:true, confirmButtonText:'Ya, hapus', cancelButtonText:'Batal' })
      .then(function(r){
        if (!r.isConfirmed) return;
        var payload = addCsrf({ id:idVal });
        $.post(API.delete, $.param(payload), function(res){
          handleJSON(res, function(d){
            if (d.status === 'success') {
              Swal.fire({ icon:'success', title:'Berhasil', text:d.message || 'Terhapus.', timer:1200, showConfirmButton:false });
              setCreateMode();
            } else Swal.fire('Error', d.message || 'Gagal menghapus.', 'error');
          }, 'delete');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
  }

  function doPrint(){
    var idVal = $id.val();
    if (!idVal) return Swal.fire('Info','Belum ada data untuk dicetak.','info');
    var url = (API.print || '#') + '?id=' + encodeURIComponent(idVal);
    window.open(url, '_blank');
  }

  /* =========================
   * View modal (rapi seperti print)
   * ========================= */
  function openViewModal(row){
    if (!row) return;
    var sigDok = row.ttd_dokter || '';
    var sigPas = row.ttd_pasien || '';
    if (sigDok && sigDok.indexOf('data:image') !== 0) sigDok = 'data:image/png;base64,'+sigDok;
    if (sigPas && sigPas.indexOf('data:image') !== 0) sigPas = 'data:image/png;base64,'+sigPas;

    var todayID = new Date().toLocaleDateString('id-ID');
    var html = `
    <div style="font-family:Arial,Helvetica,sans-serif;color:#000">
      <style>
        .kv{width:100%;border-collapse:collapse;font-size:12px}
        .kv td{padding:2px 0;vertical-align:top}
        .kv .label{width:120px;color:#333}
        .box{border:1px solid #999;border-radius:6px;padding:8px;margin-top:8px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .ttd-img{max-width:220px;display:block;margin:6px 0 4px auto}
        .footer{margin-top:16px;text-align:right}
      </style>
      <h4 style="text-align:center;margin:6px 0 8px">Surat Keterangan Sakit</h4>
      <table class="kv">
        <tr><td class="label">No. Surat</td><td>: ${fmt(row.no_surat)}</td><td class="label">Tanggal Surat</td><td>: ${fmt(row.tgl_surat)}</td></tr>
        <tr><td class="label">No. Rawat</td><td>: ${fmt($('#ss_no_rawat').val())}</td><td class="label">Mulai Istirahat</td><td>: ${fmt(row.tgl_mulai_istirahat)}</td></tr>
        <tr><td class="label">Lama (hari)</td><td>: ${fmt(row.lama_istirahat_hari)}</td><td class="label">Final</td><td>: ${(Number(row.is_final)===1?'Ya':'Belum')}</td></tr>
      </table>
      <div class="box"><b>Keterangan:</b><br>${fmt(row.keterangan)}</div>
      <div class="footer">
        Pekanbaru, ${todayID}<br>Dokter Pemeriksa,<br>
        ${sigDok ? `<img class="ttd-img" src="${sigDok}">` : `<div style="height:70px"></div>`}
        <div style="font-weight:bold;text-decoration:underline">${$('.info-nama-dokter').text() || '-'}</div>
      </div>
      ${sigPas ? `<div style="margin-top:10px;text-align:right">Pasien/Wali:<br><img class="ttd-img" src="${sigPas}"></div>` : ``}
    </div>`;
    Swal.fire({ html: html, width: 900, showConfirmButton: false, showCloseButton: true });
  }

  /* =========================
   * Bindings
   * ========================= */
  $(document).ready(function(){
    cacheDom();
    initSignaturePads();

    // Toggle guardian fields (sinkron)
    $('#ss_is_guardian').on('change', function(){
      document.getElementById('guardian_fields').style.display = this.checked ? 'block' : 'none';
    });

    // Tombol form
    $btnSave.on('click',   function(e){ e.preventDefault(); doSave(); });
    $btnUpdate.on('click', function(e){ e.preventDefault(); doUpdate(); });
    $btnCancel.on('click', function(e){ e.preventDefault(); setCreateMode(); });

    // Toolbar
    $btnView.on('click', function(e){ e.preventDefault(); loadData(function(row){ if(row) openViewModal(row); }); });
    $btnTTD.on('click',  function(e){ e.preventDefault(); scrollTo('#canvasTTDDokter'); });
    $btnEdit.on('click', function(e){ e.preventDefault(); loadData(function(row){ if(row){ fillForm(row); scrollTo('#suratSakitForm'); }}); });
    $btnPrint.on('click',function(e){ e.preventDefault(); doPrint(); });
    $btnDelete.on('click',function(e){ e.preventDefault(); doDelete(); });

    // Init – load existing (single-entry)
    loadData();
  });

})(jQuery, window, document);
s
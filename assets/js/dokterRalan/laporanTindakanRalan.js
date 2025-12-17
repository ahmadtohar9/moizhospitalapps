/* assets/js/dokterRalan/laporanTindakanRalan.js (FINAL) */
(function ($, window, document) {
  'use strict';

  /* =========================
   * Endpoint namespace
   * ========================= */
  var API = (window.API && window.API.laporanTindakanRalan) ? window.API.laporanTindakanRalan : {};
  if (!API || !API.getData) console.error('❌ Endpoint Laporan Tindakan Ralan tidak terdefinisi.');

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
  function pad2(n){return String(n).padStart(2,'0');}
  function setNowTime($timeInput) {
    var now = new Date();
    $timeInput.val(pad2(now.getHours()) + ':' + pad2(now.getMinutes()) + ':' + pad2(now.getSeconds()));
  }
  function fmt(x){ return (x==null||x==='')?'-':String(x); }

  /* =========================
   * SignaturePad helpers
   * ========================= */
  var sigPad, sigCanvas;
  function resizeCanvas() {
    if (!sigCanvas) return;
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    sigCanvas.width  = sigCanvas.offsetWidth  * ratio;
    sigCanvas.height = sigCanvas.offsetHeight * ratio;
    sigCanvas.getContext('2d').scale(ratio, ratio);
    if (sigPad) sigPad.clear();
  }
  function openTTDModal(cbDone) {
    var $m = $('#modalTTD');
    $m.off('shown.bs.modal').on('shown.bs.modal', function () {
      sigCanvas = document.getElementById('canvasTTD');
      if (!sigCanvas) { Swal.fire('Error','Canvas TTD tidak ditemukan.','error'); return; }
      resizeCanvas();
      sigPad = new SignaturePad(sigCanvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
    });
    $m.modal('show');

    $('#btnSimpanTTD').off('click').on('click', function(){
      if (!sigPad || sigPad.isEmpty()) { Swal.fire('Info','Silakan tanda tangan dulu.','info'); return; }
      cbDone && cbDone(sigPad.toDataURL('image/png'));
    });
    $('#btnUlangiTTD').off('click').on('click', function(){ sigPad && sigPad.clear(); });
  }
  $(window).on('resize', resizeCanvas);

  /* =========================
   * DOM Cache
   * ========================= */
  var $form, $id, $no_rawat, $kd_dokter, $ruangan, $jamMulai, $jamSelesai, $anastesi, $diagnosa, $namaTindakan, $prosedur, $ttdHidden;

  function cacheDom(){
    $form         = $('#laporanTindakanForm');
    $id           = $('#lt_id');
    $no_rawat     = $('#lt_no_rawat');
    $kd_dokter    = $('#lt_kd_dokter');
    $ruangan      = $('#lt_ruangan');            // <- ganti: string, bukan _id
    $jamMulai     = $('#lt_jam_mulai');
    $jamSelesai   = $('#lt_jam_selesai');
    $anastesi     = $('#lt_jenis_anastesi');
    $diagnosa     = $('#lt_diagnosa');
    $namaTindakan = $('#lt_nama_tindakan');
    $prosedur     = $('#lt_prosedur_tindakan');
    $ttdHidden    = $('#lt_ttd_base64');
  }

  /* =========================
   * Aksi toolbar (kanan)
   * ========================= */
  function ensureActionsContainer(){
    var $c = $('#lt-actions-toolbar');
    if (!$c.length) {
      var $tbl = $('#lt-summary-body').closest('table');
      $tbl.after('<div id="lt-actions-toolbar" class="mt-2"></div>');
      $c = $('#lt-actions-toolbar');
    }
    return $c;
  }
  function renderActions(row){
    var $c = ensureActionsContainer();
    if (!row) { $c.html(''); return; }

    var html = [
      '<div class="btn-group" role="group" aria-label="Aksi Laporan">',
        '<button class="btn btn-info btn-sm lt-view"  data-id="'+row.id+'"><i class="fa fa-eye"></i> Lihat</button> ',
        '<button class="btn btn-primary btn-sm lt-ttd"  data-id="'+row.id+'"><i class="fa fa-pen"></i> TTD</button> ',
        '<button class="btn btn-warning btn-sm lt-edit" data-id="'+row.id+'"><i class="fa fa-edit"></i> Edit</button> ',
        '<button class="btn btn-success btn-sm lt-print" data-id="'+row.id+'"><i class="fa fa-print"></i> Cetak</button> ',
        '<button class="btn btn-danger btn-sm lt-del"  data-id="'+row.id+'"><i class="fa fa-trash"></i> Hapus</button>',
      '</div>'
    ].join('');

    $c.html(html);
  }

  /* =========================
   * Render summary table
   * ========================= */
  function renderSummary(row){
    var $tbody = $('#lt-summary-body');
    if (!row) {
      $tbody.html('<tr><td colspan="7" class="text-muted">Belum ada data.</td></tr>');
      renderActions(null);
      return;
    }
    $tbody.html([
      '<tr>',
        '<td>1</td>',
        '<td>'+fmt(row.diagnosa)+'</td>',
        '<td>'+fmt(row.nama_tindakan)+'</td>',
        '<td>'+fmt(row.jam_mulai)+'</td>',
        '<td>'+fmt(row.jam_selesai)+'</td>',
        '<td>'+fmt(row.ruangan)+'</td>',
        '<td>'+fmt(row.jenis_anastesi)+'</td>',
      '</tr>'
    ].join(''));
    renderActions(row);
  }

  /* =========================
   * Fill form / reset
   * ========================= */
  function fillForm(row){
    if (!row) return;
    $id.val(row.id || '');
    $ruangan.val(row.ruangan || '');
    $jamMulai.val(row.jam_mulai || '');
    $jamSelesai.val(row.jam_selesai || '');
    $anastesi.val(row.jenis_anastesi || '');
    $diagnosa.val(row.diagnosa || '');
    $namaTindakan.val(row.nama_tindakan || '');
    $prosedur.val(row.prosedur_tindakan || '');
    if (row.ttd) $ttdHidden.val(row.ttd);
    // Toggle tombol
    $('#btnLTSave').hide();
    $('#btnLTUpdate, #btnLTPrint, #btnLTDelete').show();
  }

  function setCreateMode(){
    $id.val('');
    $ruangan.val('');
    if (!$jamMulai.val()) setNowTime($jamMulai);
    $jamSelesai.val('');
    $anastesi.val('');
    $diagnosa.val('');
    $namaTindakan.val('');
    $prosedur.val('');
    $ttdHidden.val('');
    renderSummary(null);
    $('#btnLTUpdate, #btnLTPrint, #btnLTDelete').hide();
    $('#btnLTSave').show();
  }

  /* =========================
   * Load existing (single-entry)
   * ========================= */
  function loadData(cb){
    var nr = $no_rawat.val();
    if (!nr) { Swal.fire('Error','No. Rawat tidak ditemukan.','error'); return; }
    $.get(API.getData, { no_rawat: nr }, function(res){
      handleJSON(res, function(r){
        if (r.status === 'success' && r.data) {
          fillForm(r.data);
          renderSummary(r.data);
          cb && cb(r.data);
        } else {
          setCreateMode();
          cb && cb(null);
        }
      }, 'getByNoRawat');
    }).fail(function(xhr){
      console.error('❌ loadData failed', xhr);
    });
  }

  /* =========================
   * Collect payload
   * ========================= */
  function collectPayload(withId){
    var data = {
      no_rawat: $no_rawat.val(),
      kd_dokter: $kd_dokter.val(),
      ruangan: $ruangan.val(),                     // <- kirim string ruangan
      jam_mulai: $jamMulai.val(),
      jam_selesai: $jamSelesai.val(),
      jenis_anastesi: $anastesi.val(),
      diagnosa: $diagnosa.val(),
      nama_tindakan: $namaTindakan.val(),
      prosedur_tindakan: $prosedur.val(),
      ttd: $ttdHidden.val()
    };
    if (withId) data.id = $id.val();
    return addCsrf(data);
  }

  /* =========================
   * Actions (CRUD + Print + Sign)
   * ========================= */
  function doSave(){
    var payload = collectPayload(false);
    if (!payload.no_rawat) return Swal.fire('Error','No. Rawat kosong.','error');
    if (!payload.prosedur_tindakan) return Swal.fire('Info','Prosedur Tindakan belum diisi.','info');

    var $btn = $('#btnLTSave'), old = $btn.html();
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: API.save, method: 'POST', data: $.param(payload),
      statusCode: {
        409: function (xhr) {
          let msg = 'Laporan untuk nomor rawat ini sudah ada.';
          try {
            const r = JSON.parse(xhr.responseText);
            if (r && r.message) msg = r.message;
            updateCsrf(r);
          } catch(_) {}
          Swal.fire('Info', msg, 'info');
          loadData();
        }
      }
    })
    .done(function(res){
      handleJSON(res, function(r){
        if (r.status === 'success') {
          Swal.fire({ icon:'success', title:'Berhasil', text:r.message || 'Tersimpan.', timer:1400, showConfirmButton:false });
          loadData();
        } else {
          Swal.fire('Error', r.message || 'Gagal menyimpan.', 'error');
        }
      }, 'save');
    })
    .fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); })
    .always(function(){ $btn.prop('disabled', false).html(old); });
  }

  function doUpdate(){
    var payload = collectPayload(true);
    if (!payload.id) return Swal.fire('Error','ID tidak ditemukan.','error');

    var $btn = $('#btnLTUpdate'), old = $btn.html();
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

    $.post(API.update, $.param(payload), function(res){
      handleJSON(res, function(r){
        if (r.status === 'success') {
          Swal.fire({ icon:'success', title:'Berhasil', text:r.message || 'Diperbarui.', timer:1200, showConfirmButton:false });
          loadData();
        } else {
          Swal.fire('Error', r.message || 'Gagal memperbarui.', 'error');
        }
      }, 'update');
    }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); })
      .always(function(){ $btn.prop('disabled', false).html(old); });
  }

  function doDelete(){
    var id = $id.val();
    if (!id) return Swal.fire('Error','ID tidak ditemukan.','error');

    Swal.fire({ title:'Yakin hapus laporan ini?', icon:'warning', showCancelButton:true, confirmButtonText:'Ya, hapus', cancelButtonText:'Batal' })
      .then(function(r){
        if (!r.isConfirmed) return;
        var payload = addCsrf({ id:id });
        $.post(API.delete, $.param(payload), function(res){
          handleJSON(res, function(d){
            if (d.status === 'success') {
              Swal.fire({ icon:'success', title:'Berhasil', text:d.message || 'Terhapus.', timer:1200, showConfirmButton:false });
              setCreateMode();
            } else {
              Swal.fire('Error', d.message || 'Gagal menghapus.', 'error');
            }
          }, 'delete');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
  }

  function doSignAndPrint(){
    var currentId = $id.val();

    function lanjutSign(id) {
      openTTDModal(function(dataURL){
        var post = addCsrf({ id: id, ttd: dataURL });
        $.post(API.sign, $.param(post), function(res){
          handleJSON(res, function (r) {
            if (r.status === 'success') {
              $('#modalTTD').modal('hide');
              loadData();
              if (r.print_url) window.open(r.print_url, '_blank');
            } else {
              Swal.fire('Error', r.message || 'Gagal menyimpan tanda tangan.', 'error');
            }
          }, 'sign');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
    }

    if (currentId) {
      lanjutSign(currentId);
    } else {
      var payload = collectPayload(false);
      if (!payload.prosedur_tindakan) return Swal.fire('Info','Prosedur Tindakan belum diisi.','info');

      $.ajax({
        url: API.save, method:'POST', data: $.param(payload),
        statusCode: {
          409: function(xhr){
            let msg = 'Laporan untuk nomor rawat ini sudah ada.';
            try {
              const r = JSON.parse(xhr.responseText);
              if (r && r.message) msg = r.message;
              updateCsrf(r);
            } catch(_){}
            Swal.fire('Info', msg, 'info');
            loadData(function(row){ if (row && row.id) lanjutSign(row.id); });
          }
        }
      }).done(function(res){
        handleJSON(res, function(r){
          if (r.status === 'success' && r.id) {
            loadData(function(){ lanjutSign(r.id); });
          } else if (r.status !== 'success') {
            Swal.fire('Error', r.message || 'Gagal menyimpan data awal.', 'error');
          }
        }, 'save-before-sign');
      }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
    }
  }

  function doPrint(){
    var id = $id.val();
    if (!id) return Swal.fire('Info','Belum ada data untuk dicetak.','info');
    var url = (API.print || '#') + '?id=' + encodeURIComponent(id);
    window.open(url, '_blank');
  }

  /* =========================
   * Toolbar buttons (lihat/ttd/edit/hapus)
   * ========================= */
  /* ===== View as neat print-like modal (FINAL) ===== */
  $(document).on('click', '.lt-view', function () {
    const row       = collectPayload(true);
    const nr        = $('#lt_no_rawat').val();
    const nrm       = $('#lt_no_rkm_medis').val();
    const pasien    = ($('.info-nama-pasien').text() || '').trim();
    const dokter    = ($('.info-nama-dokter').text() || '').trim();
    const poli      = ($('.info-nama-poli').text() || '').trim();
    const ruanganTx = $('#lt_ruangan option:selected').text() || '-';
    const waktuTx   = row.jam_mulai ? (row.jam_mulai + (row.jam_selesai ? ' s/d ' + row.jam_selesai : '')) : '-';
    const ttdImg    = row.ttd ? `<img src="${row.ttd}" alt="TTD" class="ttd-img">` : '';
    const todayID   = new Date().toLocaleDateString('id-ID');

    const html = `
    <div class="printlike">
      <style>
        .printlike{font-family:Arial,Helvetica,sans-serif;color:#000}
        .printlike .wrap{max-width:760px;margin:0 auto}
        .printlike .head{text-align:center;line-height:1.2}
        .printlike .head .instansi{font-weight:bold;font-size:16px;letter-spacing:.3px}
        .printlike .head .sub{font-size:11px;color:#555}
        .printlike .divider{border-top:2px solid #000;margin:8px 0 10px}
        .printlike .title{font-weight:bold;margin-bottom:8px}
        .printlike table{width:100%;border-collapse:collapse;font-size:12px}
        .printlike .kv td{padding:2px 0;vertical-align:top}
        .printlike .kv .label{width:120px;color:#333}
        .printlike .grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:8px}
        .printlike .box{border:1px solid #333;border-radius:6px;padding:8px;min-height:56px}
        .printlike .box-title{font-weight:bold;text-align:center;border:1px solid #333;border-bottom:none;border-radius:6px 6px 0 0;padding:6px}
        .printlike .box-wrap{border:1px solid #333;border-radius:0 0 6px 6px;padding:8px;min-height:60px}
        .printlike .proc-title{font-weight:bold;text-align:center;margin:12px 0 4px}
        .printlike .proc{border:1px solid #333;border-radius:6px;padding:10px;min-height:110px;white-space:pre-wrap;line-height:1.55}
        .printlike .footer{margin-top:20px;text-align:right}
        .printlike .ttd-img{max-width:220px;display:block;margin:6px 0 4px auto}
        /* force SweetAlert to give us space */
        .swal2-html-container{max-height:none!important}
      </style>

      <div class="wrap">
        <!-- Header -->
        <div class="head">
          <div class="instansi">RSUD PETALABUMI</div>
          <div class="sub">PEKANBARU • RIAU &nbsp;|&nbsp; Telp: 0853-6861-18832 • Email: rsudp@gmail.com</div>
        </div>
        <div class="divider"></div>
        <div class="title" style="text-align:center;">Laporan Tindakan Rawat Jalan</div>

        <!-- Meta (2 kolom) -->
        <table class="kv">
          <tr>
            <td class="label">No. Rawat</td><td>: ${fmt(nr)}</td>
            <td class="label">Waktu</td><td>: ${fmt(waktuTx)}</td>
          </tr>
          <tr>
            <td class="label">No. RM</td><td>: ${fmt(nrm)}</td>
            <td class="label">Dokter</td><td>: ${fmt(dokter || '-')}</td>
          </tr>
          <tr>
            <td class="label">Nama Pasien</td><td>: ${fmt(pasien || '-')}</td>
            <td class="label">Poli</td><td>: ${fmt(poli || '-')}</td>
          </tr>
          <tr>
            <td class="label">Ruangan</td><td>: ${fmt(ruanganTx)}</td>
            <td class="label">Anestesi</td><td>: ${fmt(row.jenis_anastesi)}</td>
          </tr>
        </table>

        <!-- Diagnosa / Nama Tindakan -->
        <div class="grid">
          <div>
            <div class="box-title">Diagnosa</div>
            <div class="box-wrap">${fmt(row.diagnosa)}</div>
          </div>
          <div>
            <div class="box-title">Nama Tindakan</div>
            <div class="box-wrap">${fmt(row.nama_tindakan)}</div>
          </div>
        </div>

        <!-- Prosedur -->
        <div class="proc-title">Prosedur Tindakan</div>
        <div class="proc">${fmt(row.prosedur_tindakan)}</div>

        <!-- Footer / TTD -->
        <div class="footer">
          PEKANBARU, ${todayID}<br>Dokter Operator,<br>
          ${ttdImg}
          <div style="font-weight:bold;text-decoration:underline;">${fmt(dokter || '-')}</div>
        </div>
      </div>
    </div>`;

    Swal.fire({
      title: '',
      html: html,
      width: 900,
      showConfirmButton: false,
      showCloseButton: true
    });
  });


  $(document).on('click', '.lt-ttd', function(){
    var currentId = $id.val();
    if (!currentId) { Swal.fire('Info','Simpan dulu datanya sebelum TTD.','info'); return; }
    doSignAndPrint();
  });

  $(document).on('click', '.lt-edit', function(){
    loadData(function(row){
      if (!row) { Swal.fire('Info','Belum ada data untuk diedit.','info'); return; }
      fillForm(row);
      $('html,body').animate({ scrollTop: $('#laporanTindakanForm').offset().top - 50 }, 300);
    });
  });

  $(document).on('click', '.lt-del', function(){
    doDelete();
  });

  $(document).on('click', '.lt-print', function(){
    var id = $(this).data('id');
    if (!id) return Swal.fire('Info','Data belum disimpan.','info');
    var url = (API.print || '#') + '?id=' + encodeURIComponent(id);
    window.open(url, '_blank');
  });

  /* =========================
   * Bindings
   * ========================= */
  $(document).ready(function(){
    cacheDom();

    if (!$jamMulai.val()) setNowTime($jamMulai);

    // Tombol form
    $('#btnLTSave').on('click', function(e){ e.preventDefault(); doSave(); });
    $('#btnLTUpdate').on('click', function(e){ e.preventDefault(); doUpdate(); });
    $('#btnLTDelete').on('click', function(e){ e.preventDefault(); doDelete(); });
    $('#btnLTSignPrint').on('click', function(e){ e.preventDefault(); doSignAndPrint(); });
    $('#btnLTPrint').on('click', function(e){ e.preventDefault(); doPrint(); });
    $('#btnLTCancel').on('click', function(e){ e.preventDefault(); setCreateMode(); });

    // Init – load existing (single-entry)
    loadData();
  });

})(jQuery, window, document);

/* ===== Berkas Digital – UI Ringkas (tabel saja + modal) ===== */
(function($){
  'use strict';

  if (!window.API_BERKAS) { console.error('API_BERKAS belum ada'); return; }

  const API = window.API_BERKAS;
  const MASTER = window.MASTER_BERKAS || [];
  const API_DELETE = API.delete || (API.download ? API.download.replace(/download\b/, 'delete') : null);

  let DATA = [];          // cache pasien (per tanggal)
  let currentNoRawat = null;

  /* ---------- Utils ---------- */
  const today = () => new Date().toISOString().slice(0,10);
  const cssId = (s) => String(s||'').replace(/[^\w]+/g,'_');

  const toast = (msg, type='info') => {
    if (window.Swal) Swal.fire({icon:(type==='error'?'error':(type==='success'?'success':'info')),text:msg,timer:1400,showConfirmButton:false});
    else alert(msg);
  };

  const setCSRF = (res)=>{ if(res?.csrfName && res?.csrfToken) window.CSRF = {name:res.csrfName, value:res.csrfToken}; };
  const addCSRF = (fd)=>{ if(window.CSRF?.name && window.CSRF?.value) fd.append(window.CSRF.name, window.CSRF.value); };

  /* ---------- Master jenis -> dropdown modal ---------- */
  function fillJenisDropdown(){
    const $sel = $('.um-jenis').empty();
    MASTER.forEach(m => $sel.append(`<option value="${m.kode}">${m.kode} - ${m.nama}</option>`));
  }

  /* ---------- Load & render tabel pasien ---------- */
  function loadPasien(tgl){
    $('#pasienTable tbody').html('<tr><td colspan="6" class="text-center">Memuat…</td></tr>');
    $.get(API.getPasien, { tanggal: tgl }, function(res){
      const rows = Array.isArray(res?.data) ? res.data : [];
      DATA = rows;
      renderTable(rows);
      $('#rowCount').text('Record: ' + rows.length);
    }).fail(()=> $('#pasienTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat.</td></tr>'));
  }

  function renderTable(rows){
    const $tb = $('#pasienTable tbody').empty();
    if (!rows.length) { $tb.html('<tr><td colspan="6" class="text-center text-muted">Tidak ada data.</td></tr>'); return; }

    rows.forEach((p,i)=>{
      const rid = 'cell-'+cssId(p.no_rawat);
      const tr = `
        <tr>
          <td>${i+1}</td>
          <td>${p.no_rawat}</td>
          <td>${p.nm_pasien||'-'}</td>
          <td>${p.nm_dokter||'-'}</td>
          <td class="berkas-cell">
            <div class="berkas-mini" id="${rid}" data-no-rawat="${p.no_rawat}">
              <div class="text-muted" style="font-size:12px">Memuat berkas…</div>
            </div>
          </td>
          <td>
            <button class="btn btn-xs btn-info act-upload" data-no-rawat="${p.no_rawat}">
              <i class="fa fa-upload"></i> Upload
            </button>
          </td>
        </tr>`;
      $tb.append(tr);
      fillCellBerkas(p.no_rawat, $('#'+rid));
    });
  }

  /* ---------- Isi mini-list berkas pada sel ---------- */
  function fillCellBerkas(no_rawat, $cell){
    $.get(API.getList, { no_rawat }, function(res){
      const list = Array.isArray(res?.data) ? res.data : [];
      if (!list.length){ $cell.html('<div class="text-muted" style="font-size:12px">— belum ada berkas —</div>'); return; }

      let html = '';
      list.forEach(f=>{
        const filename = (f.lokasi_file||'').split('/').pop();
        const viewUrl  = API.publicUrl ? (API.publicUrl + '/' + filename) : (API.download+'?id='+encodeURIComponent(f.id));
        html += `
          <div class="item" data-id="${f.id}" data-no-rawat="${no_rawat}">
            <span class="name">${f.kode} — ${f.nama||filename}</span>
            <span>
              <a class="btn btn-xs btn-info" target="_blank" href="${viewUrl}">Lihat</a>
              <button class="btn btn-xs btn-danger btn-del-berkas" data-id="${f.id}" data-no-rawat="${no_rawat}">Hapus</button>
            </span>
          </div>`;
      });
      $cell.html(html);
    }).fail(()=> $cell.html('<div class="text-danger" style="font-size:12px">Gagal memuat berkas.</div>'));
  }

  /* ---------- Upload (modal) ---------- */
  $(document).on('click', '.act-upload', function(){
    const nr = $(this).data('no-rawat');
    currentNoRawat = nr;
    $('#um-no-rawat').text('No. Rawat: ' + nr);
    $('#um-upload-btn').attr('data-no-rawat', nr);
    $('.um-file').val('');
    $('#uploadModal').modal('show');
    loadRiwayatModal(nr);
  });

  function loadRiwayatModal(no_rawat){
    $('#um-riwayat').html('<p class="text-muted">Memuat riwayat…</p>');
    $.get(API.getList, { no_rawat }, function(res){
      const list = Array.isArray(res?.data) ? res.data : [];
      if (!list.length) return $('#um-riwayat').html('<p class="text-muted">Belum ada berkas.</p>');
      let html = '<table class="table table-sm"><thead><tr><th>Kode</th><th>Nama</th><th>Aksi</th></tr></thead><tbody>';
      list.forEach(f=>{
        const filename = (f.lokasi_file||'').split('/').pop();
        const viewUrl  = API.publicUrl ? (API.publicUrl + '/' + filename) : (API.download+'?id='+encodeURIComponent(f.id));
        html += `<tr>
          <td>${f.kode}</td>
          <td>${f.nama||filename}</td>
          <td>
            <a class="btn btn-xs btn-info" target="_blank" href="${viewUrl}">Lihat</a>
            <button class="btn btn-xs btn-danger btn-del-berkas" data-id="${f.id}" data-no-rawat="${no_rawat}">Hapus</button>
          </td>
        </tr>`;
      });
      html += '</tbody></table>';
      $('#um-riwayat').html(html);
    }).fail(()=> $('#um-riwayat').html('<p class="text-danger">Gagal memuat riwayat.</p>'));
  }

  // Setelah upload sukses (ditangani di berkas_digital.js), refresh modal & cell
  $(document).ajaxSuccess(function(evt, xhr, settings){
    if (settings.url === API.upload) {
      try { setCSRF(xhr.responseJSON || JSON.parse(xhr.responseText)); } catch(e){}
      if (currentNoRawat){
        loadRiwayatModal(currentNoRawat);
        const $cell = $('#pasienTable .berkas-mini[data-no-rawat="'+currentNoRawat+'"]');
        if ($cell.length) fillCellBerkas(currentNoRawat, $cell);
      }
    }
  });

  /* ---------- Delete berkas ---------- */
  $(document).on('click', '.btn-del-berkas', function(){
    if (!API_DELETE) return toast('Endpoint delete belum disiapkan.', 'error');

    const id = $(this).data('id');
    const nr = $(this).data('no-rawat');

    const doDel = ()=>{
      const fd = new FormData();
      fd.append('id', id); addCSRF(fd);
      $.ajax({
        url: API_DELETE, method:'POST', data:fd, processData:false, contentType:false, dataType:'json',
        headers:{'X-Requested-With':'XMLHttpRequest'}
      }).done(res=>{
        setCSRF(res);
        if (res?.status === 'success'){
          toast('Berhasil menghapus berkas.','success');
          loadRiwayatModal(nr);
          const $cell = $('#pasienTable .berkas-mini[data-no-rawat="'+nr+'"]');
          if ($cell.length) fillCellBerkas(nr, $cell);
        } else {
          toast(res?.message||'Gagal menghapus berkas.','error');
        }
      }).fail(xhr=>{
        let msg='Gagal menghubungi server.'; try{ const r=xhr.responseJSON||JSON.parse(xhr.responseText); setCSRF(r); if(r?.message) msg=r.message; }catch(e){}
        toast(msg,'error');
      });
    };

    if (window.Swal){
      Swal.fire({icon:'warning',title:'Hapus berkas?',text:'File di server juga akan dihapus.',
                 showCancelButton:true,confirmButtonText:'Hapus',cancelButtonText:'Batal'})
          .then(r=>{ if(r.isConfirmed) doDel(); });
    } else if (confirm('Hapus berkas? File di server juga akan dihapus.')) {
      doDel();
    }
  });

  /* ---------- Filter keyword client-side ---------- */
  $('#fKeyword').on('input', function(){
    const q = (this.value||'').toLowerCase();
    const rows = DATA.filter(p => (p.no_rawat+' '+(p.nm_pasien||'')+' '+(p.nm_dokter||'')).toLowerCase().includes(q));
    renderTable(rows);
    $('#rowCount').text('Record: ' + rows.length);
  });

  /* ---------- Init ---------- */
  $(function(){
    fillJenisDropdown();
    const t = today();
    $('#fDate').val(t);
    loadPasien(t);

    $('#btnCari').on('click', ()=>{
      const d = $('#fDate').val();
      if (!d) return toast('Pilih tanggal terlebih dahulu.');
      loadPasien(d);
    });
  });

})(jQuery);

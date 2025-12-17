/* =======================================================================
 * Berkas Digital – versi final (single file)
 * - List pasien per tanggal
 * - Kolom "Berkas Digital Perawatan" (lihat & hapus)
 * - Modal upload (jenis + file) + kamera/galeri
 * - Delete via no_rawat + kode (tanpa kolom id)
 * - Download per file (direct public URL) & Download Semua (ZIP by no_rawat)
 * ======================================================================= */
(function ($, window, document) {
  'use strict';

  // ====== GUARD ======
  if (!window.API_BERKAS) {
    alert('API_BERKAS belum tersedia di view.');
    return;
  }
  const API     = window.API_BERKAS;
  const MASTER  = Array.isArray(window.MASTER_BERKAS) ? window.MASTER_BERKAS : [];
  const API_DEL = API.delete || null;          // endpoint delete (expects no_rawat + kode)
  const HAS_PUBLIC = !!API.publicUrl;          // base public URL untuk lihat/download per file

  // ====== CSRF & UTIL ======
  const setCSRF = (res)=>{ if(res && res.csrfName && res.csrfToken) window.CSRF = {name:res.csrfName, value:res.csrfToken}; };
  const addCSRF = (fd)=>{ if(window.CSRF?.name && window.CSRF?.value) fd.append(window.CSRF.name, window.CSRF.value); };
  const today   = () => new Date().toISOString().slice(0,10);
  const cssId   = (s) => String(s||'').replace(/[^\w]+/g,'_');

  const toast = (msg, type='info') => {
    if (window.Swal) Swal.fire({icon:(type==='error'?'error':(type==='success'?'success':'info')),text:msg,timer:1400,showConfirmButton:false});
    else alert(msg);
  };

  // ====== MASTER -> dropdown modal ======
  function fillJenisDropdown(){
    const $sel = $('.um-jenis').empty();
    MASTER.forEach(m => $sel.append(`<option value="${m.kode}">${m.kode} - ${m.nama}</option>`));
  }

  // ====== STATE ======
  let DATA = [];                // cache pasien per tanggal
  let currentNoRawat = null;    // untuk refresh modal & cell setelah upload/hapus

  // ====== LOAD PASIEN & RENDER TABEL ======
  function loadPasienByTanggal(tgl){
    $('#pasienTable tbody').html('<tr><td colspan="6" class="text-center">Memuat…</td></tr>');
    $.ajax({
      url: API.getPasien,
      method: 'GET',
      data: { tanggal: tgl },
      dataType: 'json',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).done((res)=>{
      const rows = Array.isArray(res?.data) ? res.data : [];
      DATA = rows;
      renderTable(rows);
      $('#rowCount').text('Record: ' + rows.length);
    }).fail(()=>{
      $('#pasienTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat.</td></tr>');
    });
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
          <td>${p.no_rkm_medis}</td>
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

  // ====== ISI MINI-LIST BERKAS PER BARIS ======
  function fillCellBerkas(no_rawat, $cell){
    $.get(API.getList, { no_rawat }, function(res){
      const list = Array.isArray(res?.data) ? res.data : [];
      if (!list.length){ $cell.html('<div class="text-muted" style="font-size:12px">— belum ada berkas —</div>'); return; }

      let html = '';
      list.forEach(f=>{
        const filename = (f.lokasi_file||'').split('/').pop();
        const viewUrl  = HAS_PUBLIC ? (API.publicUrl + '/' + filename) : '#';
        html += `
          <div class="item" data-no-rawat="${no_rawat}" data-kode="${f.kode}">
            <span class="name">${f.kode} — ${f.nama||filename}</span>
            <span>
              ${HAS_PUBLIC ? `<a class="btn btn-xs btn-info" target="_blank" href="${viewUrl}">Lihat</a>` : ''}
              ${HAS_PUBLIC ? `<a class="btn btn-xs btn-default" target="_blank" href="${viewUrl}" download>Download</a>` : ''}
              <button class="btn btn-xs btn-danger btn-del-berkas" data-no-rawat="${no_rawat}" data-kode="${f.kode}">Hapus</button>
            </span>
          </div>`;
      });
      $cell.html(html);
    }).fail(()=> $cell.html('<div class="text-danger" style="font-size:12px">Gagal memuat berkas.</div>'));
  }

  // ====== MODAL UPLOAD ======
  $(document).on('click', '.act-upload', function(){
    const nr = $(this).data('no-rawat');
    currentNoRawat = nr;
    $('#um-no-rawat').text('No. Rawat: ' + nr);
    $('#um-upload-btn').attr('data-no-rawat', nr);
    $('#um-download-all').attr('data-no-rawat', nr);   // set tombol Download Semua
    $('.um-file').val('');
    $('#uploadModal').modal('show');
    fillJenisDropdown();
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
        const viewUrl  = HAS_PUBLIC ? (API.publicUrl + '/' + filename) : '#';
        html += `<tr>
          <td>${f.kode}</td>
          <td>${f.nama || filename}</td>
          <td>
            ${HAS_PUBLIC ? `<a class="btn btn-xs btn-info" target="_blank" href="${viewUrl}"><i class="fa fa-eye"></i> Lihat</a>` : ''}
            ${HAS_PUBLIC ? `<a class="btn btn-xs btn-default" target="_blank" href="${viewUrl}" download>Download</a>` : ''}
            <button class="btn btn-xs btn-danger btn-del-berkas" data-no-rawat="${no_rawat}" data-kode="${f.kode}">
              <i class="fa fa-trash"></i> Hapus
            </button>
          </td>
        </tr>`;
      });
      html += '</tbody></table>';
      $('#um-riwayat').html(html);
    }).fail(()=> $('#um-riwayat').html('<p class="text-danger">Gagal memuat riwayat.</p>'));
  }

  // ====== UPLOAD ======
  $(document).on('click', '#um-upload-btn', function(){
    const noRawat = $(this).data('no-rawat');
    const kode    = $('.um-jenis').val();
    const fileEl  = $('.um-file')[0];
    const file    = fileEl?.files?.[0] || null;

    if (!noRawat) return toast('No. rawat tidak ditemukan!','error');
    if (!kode)    return toast('Pilih jenis berkas!','error');
    if (!file)    return toast('Pilih file untuk di-upload!','error');

    const fd = new FormData();
    fd.append('no_rawat', noRawat);
    fd.append('kode', kode);
    fd.append('file', file);
    addCSRF(fd);

    $.ajax({
      url: API.upload, method:'POST', data:fd,
      processData:false, contentType:false, dataType:'json',
      headers:{'X-Requested-With':'XMLHttpRequest'}
    }).done(res=>{
      setCSRF(res);
      if (res?.status === 'success'){
        toast('✅ Upload berhasil','success');
        $('.um-file').val('');
        loadRiwayatModal(noRawat);
        const $cell = $('#pasienTable .berkas-mini[data-no-rawat="'+noRawat+'"]');
        if ($cell.length) fillCellBerkas(noRawat, $cell);
      } else {
        toast(res?.message||'Gagal upload.','error');
      }
    }).fail(xhr=>{
      let msg='Gagal menghubungi server.'; try{ const r=xhr.responseJSON||JSON.parse(xhr.responseText); setCSRF(r); if(r?.message) msg=r.message; }catch(e){}
      toast('❌ '+msg,'error');
    });
  });

  // ====== DELETE BERKAS (no_rawat + kode) ======
  $(document).on('click', '.btn-del-berkas', function(){
    if (!API_DEL) return toast('Endpoint delete belum disiapkan di view.', 'error');

    const noRawat = $(this).data('no-rawat');
    const kode    = $(this).data('kode');
    if (!noRawat || !kode) return toast('Data berkas tidak lengkap (no_rawat/kode).','error');

    const doDel = ()=>{
      const fd = new FormData();
      fd.append('no_rawat', noRawat);
      fd.append('kode', kode);
      addCSRF(fd);

      $.ajax({
        url: API_DEL, method:'POST', data:fd,
        processData:false, contentType:false, dataType:'json',
        headers:{'X-Requested-With':'XMLHttpRequest'}
      }).done(res=>{
        setCSRF(res);
        if (res?.status === 'success'){
          toast('Berkas berhasil dihapus.','success');
          loadRiwayatModal(noRawat);
          const $cell = $('#pasienTable .berkas-mini[data-no-rawat="'+noRawat+'"]');
          if ($cell.length) fillCellBerkas(noRawat, $cell);
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

  // ====== FILTER KEYWORD CLIENT-SIDE ======
  $('#fKeyword').on('input', function(){
    const q = (this.value || '').toLowerCase();
    const rows = DATA.filter(p => (
      (p.no_rawat + ' ' + 
       (p.no_rkm_medis || '') + ' ' + 
       (p.nm_pasien || '') + ' ' + 
       (p.nm_dokter || '')
      ).toLowerCase().includes(q)
    ));
    renderTable(rows);
    $('#rowCount').text('Record: ' + rows.length);
  });


  // ====== INIT (mendukung berbagai id tanggal yang mungkin ada di view) ======
  $(function(){
    fillJenisDropdown();

    // Ambil tanggal dari salah satu input yang tersedia
    const $tglEl = $('#fStart').length ? $('#fStart') : ($('#tanggal').length ? $('#tanggal') : $('#fDate'));
    const $btnEl = $('#btnCari').length ? $('#btnCari') : $('#btnTampil');

    const tgl = $tglEl && $tglEl.val() ? $tglEl.val() : today();
    if ($tglEl && !$tglEl.val()) $tglEl.val(tgl);
    loadPasienByTanggal(tgl);

    if ($btnEl && $btnEl.length){
      $btnEl.on('click', ()=>{
        const d = ($tglEl && $tglEl.val()) || today();
        loadPasienByTanggal(d);
      });
    }
  });

  // ====== Kamera / File picker ======
  $(document).on('click', '.btn-pick-camera', function () {
    const $file = $(this).closest('.upload-form').find('.upload-file');
    $file.attr('accept', 'image/*').attr('capture', 'environment'); // kamera belakang (mobile)
    $file.trigger('click');
  });

  $(document).on('click', '.btn-pick-file', function () {
    const $file = $(this).closest('.upload-form').find('.upload-file');
    $file.attr('accept', 'image/*,application/pdf').removeAttr('capture');
    $file.trigger('click');
  });

  // ====== Download semua berkas (ZIP) ======
  $(document).on('click', '.btn-download-all', function(){
    const no_rawat = $(this).data('no-rawat') || currentNoRawat;
    if (!no_rawat) return toast('No. rawat tidak ditemukan.', 'error');

    const url = (API.downloadAll || API.download) + '?no_rawat=' + encodeURIComponent(no_rawat);
    window.open(url, '_blank');
  });

})(jQuery, window, document);

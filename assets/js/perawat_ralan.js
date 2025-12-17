function redirectToPerawatForm(noRawat, tglRegistrasi) {
  if (!window.OPEN_BASE) { console.error('OPEN_BASE belum diset'); return; }
  if (!noRawat) { alert('no_rawat kosong'); return; }

  if (noRawat.indexOf('/') === -1) {
    if (!tglRegistrasi) { alert('Tanggal registrasi tidak tersedia.'); return; }
    var ymd = String(tglRegistrasi).split('-'); // [YYYY,MM,DD]
    if (ymd.length !== 3) { alert('Format tgl_registrasi tidak valid.'); return; }
    noRawat = ymd[0] + '/' + ymd[1] + '/' + ymd[2] + '/' + noRawat;
  }

  // panggil gateway (tanpa '/perawat' di ujung)
  window.location.href = window.OPEN_BASE + '/' + noRawat;
}


(function () {
  'use strict';
  function waitForDT(maxMs, intervalMs) {
    return new Promise(function (resolve, reject) {
      var waited = 0;
      (function tick(){
        if (window.jQuery && typeof jQuery.fn.DataTable === 'function') return resolve();
        waited += intervalMs;
        if (waited >= maxMs) return reject(new Error('DataTables belum tersedia setelah menunggu.'));
        setTimeout(tick, intervalMs);
      })();
    });
  }
  function badge(htmlText, type) {
    var t = String(type || '').toLowerCase();
    var cls = (t === 'ok') ? 'ok' : (t === 'danger' ? 'danger' : 'warn');
    return '<span class="badge-soft ' + cls + '">' + htmlText + '</span>';
  }

  document.addEventListener('DOMContentLoaded', function () {
    if (typeof API_URL === 'undefined' || typeof OPEN_BASE === 'undefined') {
      console.error('Harus ada API_URL dan OPEN_BASE dari view.');
      return;
    }

    // Elemen filter (sama seperti dokter)
    var filterButton        = document.getElementById('filterButton');
    var startDateInput      = document.getElementById('start_date');
    var endDateInput        = document.getElementById('end_date');
    var penjabSelect        = document.getElementById('penjab');
    var statusBayarSelect   = document.getElementById('status_bayar');
    var statusPeriksaSelect = document.getElementById('status_periksa');

    // Default tanggal: hari ini
    var today = new Date().toISOString().split('T')[0];
    if (!startDateInput.value) startDateInput.value = today;
    if (!endDateInput.value)   endDateInput.value   = today;

    // State highlight
    var knownKeys = new Set();
    var lastSignature = '';
    var POLL_MS = 20000;
    var pollTimer = null;

    // Pastikan DataTables siap, lalu init
    waitForDT(5000, 50).then(function () {
      var $ = jQuery;

      var table = $('#pasienTable').DataTable({
        ajax: {
          url: API_URL,
          type: 'GET',
          data: function (d) {
            d.start_date     = startDateInput.value;
            d.end_date       = endDateInput.value;
            d.penjab         = penjabSelect.value;
            d.status_bayar   = statusBayarSelect.value;
            d.status_periksa = statusPeriksaSelect.value;
          },
          dataSrc: function (rows) {
            // Simpan signature sederhana untuk auto-highlight
            try {
              var arr = Array.isArray(rows) ? rows : (rows.data || []);
              lastSignature = JSON.stringify(arr.map(function (r){ return r.no_rawat; })).slice(0, 5000);
            } catch(e){}
            return Array.isArray(rows) ? rows : (rows.data || []);
          }
        },
        columns: [
          { data: null, render: function (_d, _t, _r, meta) { return meta.row + 1; } },
          { data: 'no_rawat' },
          { data: 'no_rkm_medis' },
          { data: 'nm_pasien' },
          { data: 'nm_dokter' },
          { data: 'png_jawab' },
          { data: 'nm_poli' },
          { data: 'status_periksa',
            render: function (v) {
              var val = String(v || '').toLowerCase();
              if (val === 'belum') return 'Belum';
              if (val === 'sudah') return 'Sudah';
              return (v || '-');
          }
          },
          { data: 'status_bayar', render: function (v) {
              var val = String(v||'').toLowerCase();
              if (val === 'belum bayar' || val === 'belum') return badge('Belum Bayar','danger');
              if (val === 'lunas' || val === 'sudah') return badge('Sudah Bayar','ok');
              return badge((v||'-'),'warn');
            }
          },
          {
            data: null,
            orderable: false,
            render: function (row) {
              return '<button class="btn btn-success btn-sm" ' +
                     'onclick="redirectToPerawatForm(\''+(row.no_rawat||'')+'\', \''+(row.tgl_registrasi||'')+'\')">' +
                     '<i class="fa fa-sign-in"></i> Aksi</button>';
            }
          }
        ],
        rowCallback: function (row, data) {
          row.classList.remove('row-belum','row-sudah','row-bayar-belum','row-new');

          var stts = String(data.stts || data.status_periksa || '').toLowerCase();
          if (stts === 'belum') row.classList.add('row-belum');
          else if (stts === 'sudah') row.classList.add('row-sudah');

          var bayar = String(data.status_bayar || '').toLowerCase();
          if (bayar === 'belum bayar' || bayar === 'belum') row.classList.add('row-bayar-belum');

          var key = data.no_rawat;
          if (key && !knownKeys.has(key)) row.classList.add('row-new');
        },
        drawCallback: function () {
          var api = this.api();
          var currentKeys = new Set();
          api.rows({page:'current'}).data().each(function (r) {
            if (r && r.no_rawat) currentKeys.add(r.no_rawat);
          });
          currentKeys.forEach(function (k){ knownKeys.add(k); });
        },
        order: [[1, 'desc']],
        pageLength: 25,
        deferRender: true,
        language: {
          emptyTable: 'Tidak ada pasien.',
          info:       'Menampilkan _START_–_END_ dari _TOTAL_ pasien',
          infoEmpty:  'Menampilkan 0 pasien',
          lengthMenu: 'Tampil _MENU_',
          search:     'Cari:',
          paginate:   { first:'Pertama', last:'Terakhir', next:'›', previous:'‹' }
        }
      });

      // Tombol Filter
      filterButton.addEventListener('click', function () {
        table.ajax.reload(null, true);
      });

      // Auto-refresh (polling)
      function startPolling(){
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(function(){
          var oldSig = lastSignature;
          table.ajax.reload(function(){
            // perbedaan signature → baris baru akan auto-highlight
          }, false);
        }, POLL_MS);
      }
      startPolling();

      // Ubah filter → reload
      [startDateInput, endDateInput, penjabSelect, statusBayarSelect, statusPeriksaSelect].forEach(function(el){
        if (!el) return;
        el.addEventListener('change', function(){
          knownKeys.clear();
          table.ajax.reload(null, true);
        });
      });
    }).catch(function (e) {
      console.error('perawat_ralan.js:', e.message || e);
    });
  });
})();

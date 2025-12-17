
(function bootstrapGlobals(){
  // Cari base app dari <base> atau segmen pertama path (untuk /rsiaandini)
  var appBase = (function(){
    var baseTag = document.querySelector('base');
    if (baseTag && baseTag.href) return baseTag.href.replace(/\/+$/,'');
    var seg = location.pathname.split('/').filter(Boolean)[0] || '';
    return location.origin + (seg ? '/' + seg : '');
  })();

  // Kalau view lupa set, sediakan fallback absolut (termasuk subfolder)
  if (!window.API_URL) {
    window.API_URL = appBase + '/dokter/ralan/get-data';
    console.warn('API_URL tidak diset di view, fallback:', window.API_URL);
  }
  if (!window.OPEN_BASE_DOKTER) {
    window.OPEN_BASE_DOKTER = appBase + '/dokter/ralan/rekam-medis';
    console.warn('OPEN_BASE_DOKTER tidak diset di view, fallback:', window.OPEN_BASE_DOKTER);
  }
})();

/* Arahkan ke form rekam medis berdasarkan no_rawat */
function redirectToForm(noRawat, tglRegistrasi) {
  if (!window.OPEN_BASE_DOKTER) { console.error('OPEN_BASE_DOKTER belum diset'); return; }
  if (!noRawat) { alert('no_rawat kosong'); return; }

  function pickYMD(s){
    if (!s) return null;
    const d = String(s).trim().split(' ')[0];
    return /^\d{4}-\d{2}-\d{2}$/.test(d) ? d : null;
  }

  // Jika no_rawat hanya nomor, lengkapi dengan YYYY/MM/DD/no_rawat
  if (noRawat.indexOf('/') === -1) {
    const ymd = pickYMD(tglRegistrasi);
    if (!ymd) { alert('Tanggal registrasi tidak tersedia/invalid.'); return; }
    const [Y,M,D] = ymd.split('-');
    noRawat = `${Y}/${M}/${D}/${noRawat}`;
  }

  // Gateway dokter → TANPA menambah "/dokter" di ujung
  window.location.href = String(window.OPEN_BASE_DOKTER).replace(/\/+$/,'') + '/' + noRawat;
}

document.addEventListener('DOMContentLoaded', function () {
  // Elemen filter
  const filterButton       = document.getElementById('filterButton');
  const startDateInput     = document.getElementById('start_date');
  const endDateInput       = document.getElementById('end_date');
  const penjabSelect       = document.getElementById('penjab');
  const statusBayarSelect  = document.getElementById('status_bayar');
  const statusPeriksaSelect= document.getElementById('status_periksa');

  // (Opsional) ID dokter dari PHP → window.CURRENT_DOKTER_ID
  const dokterId = (typeof CURRENT_DOKTER_ID !== 'undefined') ? CURRENT_DOKTER_ID : null;

  // ===== Style baris (sekali sisip) =====
  if (!document.getElementById('rj-list-css')) {
    const style = document.createElement('style');
    style.id = 'rj-list-css';
    style.textContent = `
      /* status pewarnaan */
      .row-belum  { background: #fff7e6 !important; }   /* oranye muda */
      .row-sudah  { background: #eef9f0 !important; }   /* hijau muda */
      .row-bayar-belum { box-shadow: inset 3px 0 0 0 #e74c3c; } /* garis merah di kiri utk belum bayar */
      /* highlight pasien baru */
      .row-new { animation: rjPulse 1.2s ease-in-out 0s 3; }
      @keyframes rjPulse {
        0% { box-shadow: 0 0 0 0 rgba(46, 204, 113, .7); }
        70%{ box-shadow: 0 0 0 8px rgba(46, 204, 113, 0); }
        100%{ box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
      }
      /* badge kecil */
      .badge-soft { display:inline-block;padding:2px 6px;border-radius:10px;font-size:11px; }
      .badge-soft.ok{ background:#2ecc71; color:#fff; }
      .badge-soft.warn{ background:#f39c12; color:#fff; }
      .badge-soft.danger{ background:#e74c3c; color:#fff; }
    `;
    document.head.appendChild(style);
  }

  // ===== Default tanggal: hari ini =====
  const today = new Date().toISOString().split('T')[0];
  if (!startDateInput.value) startDateInput.value = today;
  if (!endDateInput.value)   endDateInput.value   = today;

  // ===== State untuk auto-refresh & highlight =====
  let knownKeys = new Set();        // set of no_rawat yang sudah terlihat
  let lastSignature = '';           // fingerprint dataset (untuk smart reload)
  const POLL_MS = 20000;            // 20 detik
  let pollTimer = null;

  // ===== DataTable =====
  const pasienTable = $('#pasienTable').DataTable({
    ajax: {
      url: API_URL,
      type: 'GET',
      data: function (d) {
        d.start_date     = startDateInput.value;
        d.end_date       = endDateInput.value;
        d.penjab         = penjabSelect.value;
        d.status_bayar   = statusBayarSelect.value;
        d.status_periksa = statusPeriksaSelect.value;
        if (dokterId) d.dokter_id = dokterId; // backend bisa abaikan jika pakai session

        // console.debug("→ Filter ke server:", d);
      },
      dataSrc: function (rows) {
        // rows = array of objects
        // Hitung signature sederhana untuk deteksi perubahan
        try {
          const sig = JSON.stringify(rows.map(r => r.no_rawat)).slice(0, 5000);
          lastSignature = sig;
        } catch(e) {}
        return rows || [];
      }
    },
    columns: [
      { data: null, render: (data, type, row, meta) => meta.row + 1 },
      { data: 'no_rawat' },
      { data: 'no_rkm_medis' },
      { data: 'nm_pasien' },
      { data: 'nm_dokter' },
      { data: 'png_jawab' },
      { data: 'nm_poli' },
      { data: 'stts', render: (v) => {
          // tampilkan badge status periksa
          const val = String(v||'').toLowerCase();
          if (val === 'belum') return '<span class="badge-soft warn">Belum</span>';
          if (val === 'sudah') return '<span class="badge-soft ok">Sudah</span>';
          return `<span class="badge-soft">${v||'-'}</span>`;
        }
      },
      { data: 'status_bayar', render: (v) => {
          const val = String(v||'').toLowerCase();
          if (val === 'belum bayar' || val === 'belum') return '<span class="badge-soft danger">Belum Bayar</span>';
          if (val === 'lunas' || val === 'sudah') return '<span class="badge-soft ok">Lunas</span>';
          return `<span class="badge-soft">${v||'-'}</span>`;
        }
      },
      {
        data: null,
        orderable: false,
        render: function (data, type, row) {
          return `<button class="btn btn-success btn-sm"
                    onclick="redirectToForm('${row.no_rawat || ''}', '${row.tgl_registrasi || ''}')">
                    <i class="fa fa-sign-in"></i> Aksi
                  </button>`;
        }
      }
    ],
    // pewarnaan baris + highlight pasien baru
    rowCallback: function (row, data /*, index */) {
      // reset kelas dulu
      row.classList.remove('row-belum','row-sudah','row-bayar-belum','row-new');

      // status periksa → belum/sudah
      const stts = String(data.stts || '').toLowerCase();
      if (stts === 'belum') row.classList.add('row-belum');
      else if (stts)       row.classList.add('row-sudah');

      // status bayar → belum → beri garis merah di kiri
      const bayar = String(data.status_bayar || '').toLowerCase();
      if (bayar === 'belum bayar' || bayar === 'belum') {
        row.classList.add('row-bayar-belum');
      }

      // highlight kalau entry baru
      const key = data.no_rawat;
      if (key && !knownKeys.has(key)) {
        row.classList.add('row-new');
      }
    },
    drawCallback: function (settings) {
      // update knownKeys setelah draw
      const api = this.api();
      const currentKeys = new Set();
      api.rows({page:'current'}).data().each(function (r) {
        if (r && r.no_rawat) currentKeys.add(r.no_rawat);
      });
      // gabungkan (supaya tidak repeatedly mark new)
      currentKeys.forEach(k => knownKeys.add(k));
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

  // ===== Reload manual via tombol Filter
  filterButton.addEventListener('click', function () {
    pasienTable.ajax.reload(null, false);
  });

  // ===== Auto-refresh (polling) =====
  function startPolling(){
    if (pollTimer) clearInterval(pollTimer);
    pollTimer = setInterval(function(){
      // Reload tanpa reset paging; DataTables akan panggil dataSrc yg update lastSignature
      const oldSig = lastSignature;
      pasienTable.ajax.reload(function(){
        // Jika dataset sama, tidak perlu apa-apa; kalau berbeda, baris baru akan auto-highlight oleh rowCallback
        // console.debug('polled; changed?', oldSig !== lastSignature);
      }, false);
    }, POLL_MS);
  }

  startPolling();

  // ===== Auto-reload jika filter diubah (tanpa tombol) =====
  [startDateInput, endDateInput, penjabSelect, statusBayarSelect, statusPeriksaSelect].forEach(function(el){
    if (!el) return;
    el.addEventListener('change', function(){
      knownKeys.clear(); // reset agar muncul highlight lagi sesuai filter baru
      pasienTable.ajax.reload(null, true);
    });
  });
});

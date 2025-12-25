
(function bootstrapGlobals() {
  // Cari base app dari <base> atau segmen pertama path (untuk /rsiaandini)
  var appBase = (function () {
    var baseTag = document.querySelector('base');
    if (baseTag && baseTag.href) return baseTag.href.replace(/\/+$/, '');
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

  function pickYMD(s) {
    if (!s) return null;
    const d = String(s).trim().split(' ')[0];
    return /^\d{4}-\d{2}-\d{2}$/.test(d) ? d : null;
  }

  // Jika no_rawat hanya nomor, lengkapi dengan YYYY/MM/DD/no_rawat
  if (noRawat.indexOf('/') === -1) {
    const ymd = pickYMD(tglRegistrasi);
    if (!ymd) { alert('Tanggal registrasi tidak tersedia/invalid.'); return; }
    const [Y, M, D] = ymd.split('-');
    noRawat = `${Y}/${M}/${D}/${noRawat}`;
  }

  // Gateway dokter → TANPA menambah "/dokter" di ujung
  window.location.href = String(window.OPEN_BASE_DOKTER).replace(/\/+$/, '') + '/' + noRawat;
}

document.addEventListener('DOMContentLoaded', function () {
  // Elemen filter
  const filterButton = document.getElementById('filterButton');
  const startDateInput = document.getElementById('start_date');
  const endDateInput = document.getElementById('end_date');
  const penjabSelect = document.getElementById('penjab');
  const statusBayarSelect = document.getElementById('status_bayar');
  const statusPeriksaSelect = document.getElementById('status_periksa');

  // (Opsional) ID dokter dari PHP → window.CURRENT_DOKTER_ID
  const dokterId = (typeof CURRENT_DOKTER_ID !== 'undefined') ? CURRENT_DOKTER_ID : null;

  // ===== Style baris (sekali sisip) =====
  if (!document.getElementById('rj-list-css')) {
    const style = document.createElement('style');
    style.id = 'rj-list-css';
    style.textContent = `
      /* status pewarnaan row */
      .row-belum  { background: #fff !important; }   /* putih: belum */
      .row-sudah  { background: #fce7f3 !important; }   /* pink muda: sudah */
      .row-berkas { background: #f3e8ff !important; }   /* purple muda: berkas diterima */
      .row-batal  { background: #1f2937 !important; color: #fff !important; }   /* hitam: batal */
      .row-dirujuk { background: #dbeafe !important; }   /* blue muda: dirujuk */
      .row-meninggal { background: #fee2e2 !important; }   /* red muda: meninggal */
      .row-dirawat { background: #d1fae5 !important; }   /* green muda: dirawat */
      .row-pulang { background: #fef3c7 !important; }   /* amber muda: pulang paksa */
      .row-bayar  { background: #ffedd5 !important; }   /* orange muda: sudah bayar */
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
      
      /* Custom badge untuk Status Periksa */
      .badge-soft.badge-belum { background:#fff; color:#333; border:1px solid #ddd; }
      .badge-soft.badge-sudah { background:#ec4899; color:#fff; }
      .badge-soft.badge-berkas { background:#9333ea; color:#fff; }
      .badge-soft.badge-batal { background:#1f2937; color:#fff; }
      .badge-soft.badge-dirujuk { background:#3b82f6; color:#fff; }
      .badge-soft.badge-meninggal { background:#ef4444; color:#fff; }
      .badge-soft.badge-dirawat { background:#10b981; color:#fff; }
      .badge-soft.badge-pulang { background:#f59e0b; color:#fff; }
      
      /* Custom badge untuk Status Bayar */
      .badge-soft.badge-bayar { background:#f97316; color:#fff; }
    `;
    document.head.appendChild(style);
  }


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
        d.start_date = startDateInput.value;
        d.end_date = endDateInput.value;
        d.penjab = penjabSelect.value;
        d.status_bayar = statusBayarSelect.value;
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
        } catch (e) { }
        return rows || [];
      }
    },
    columns: [
      { data: null, render: (data, type, row, meta) => meta.row + 1 },
      { data: 'no_rawat' },
      {
        data: null,
        orderable: false,
        render: function (data, type, row) {
          const noReg = row.no_reg || '';
          const noRawat = row.no_rawat || '';
          const nmPasien = row.nm_pasien || '';
          const statusPeriksa = String(row.status_periksa || '').toLowerCase();
          const sudahDipanggil = (row.sudah_dipanggil == 1);

          let html = noReg ? `<span class="badge bg-blue">${noReg}</span>` : '-';

          // Always show Panggil/Panggil Ulang button regardless of status
          const btnText = sudahDipanggil ? 'Panggil Ulang' : 'Panggil';
          const btnIcon = sudahDipanggil ? 'fa-redo' : 'fa-bullhorn';
          const btnClass = sudahDipanggil ? 'btn-warning' : 'btn-primary';
          html += `<br><button class="btn ${btnClass} btn-xs btn-panggil-pasien" data-no-rawat="${noRawat}" data-nama="${nmPasien}" style="margin-top:5px;"><i class="fa ${btnIcon}"></i> ${btnText}</button>`;

          return html;
        }
      },
      { data: 'no_rkm_medis' },
      { data: 'nm_pasien' },
      { data: 'nm_dokter' },
      { data: 'png_jawab' },
      { data: 'nm_poli' },
      {
        data: 'status_periksa', render: (v, type, row) => {
          // tampilkan badge status periksa dengan warna custom & clickable
          const val = String(v || '').toLowerCase();
          const noRawat = row.no_rawat || '';
          const dataAttrs = `data-no-rawat="${noRawat}" data-current-status="${v || ''}"`;

          if (val === 'belum') return `<span class="badge-soft badge-belum status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Belum</span>`;
          if (val === 'sudah') return `<span class="badge-soft badge-sudah status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Sudah</span>`;
          if (val === 'berkas diterima') return `<span class="badge-soft badge-berkas status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Berkas Diterima</span>`;
          if (val === 'batal') return `<span class="badge-soft badge-batal status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Batal</span>`;
          if (val === 'dirujuk') return `<span class="badge-soft badge-dirujuk status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Dirujuk</span>`;
          if (val === 'meninggal') return `<span class="badge-soft badge-meninggal status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Meninggal</span>`;
          if (val === 'dirawat') return `<span class="badge-soft badge-dirawat status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Dirawat</span>`;
          if (val === 'pulang paksa') return `<span class="badge-soft badge-pulang status-badge-clickable" ${dataAttrs} style="cursor:pointer;">Pulang Paksa</span>`;
          return `<span class="badge-soft status-badge-clickable" ${dataAttrs} style="cursor:pointer;">${v || '-'}</span>`;
        }
      },
      {
        data: 'status_bayar', render: (v) => {
          const val = String(v || '').toLowerCase();
          if (val === 'belum bayar' || val === 'belum') return '<span class="badge-soft danger">Belum Bayar</span>';
          if (val === 'sudah bayar' || val === 'sudah') return '<span class="badge-soft badge-bayar">Sudah Bayar</span>';
          return `<span class="badge-soft">${v || '-'}</span>`;
        }
      },
      {
        data: null,
        orderable: false,
        render: function (data, type, row) {
          const noRawat = row.no_rawat || '';
          const tglReg = row.tgl_registrasi || '';
          const nmPasien = row.nm_pasien || '';
          const statusPeriksa = String(row.status_periksa || '').toLowerCase();

          let buttons = '';


          // Tombol Aksi (Rekam Medis)
          buttons += `<button class="btn btn-success btn-xs"
                        onclick="redirectToForm('${noRawat}', '${tglReg}')">
                        <i class="fa fa-sign-in"></i> Aksi
                      </button>`;

          return buttons;
        }
      }
    ],
    // pewarnaan baris + highlight pasien baru
    rowCallback: function (row, data /*, index */) {
      // reset kelas dulu
      row.classList.remove('row-belum', 'row-sudah', 'row-berkas', 'row-batal', 'row-dirujuk', 'row-meninggal', 'row-dirawat', 'row-pulang', 'row-bayar', 'row-bayar-belum', 'row-new');

      // status periksa → warna row berdasarkan status
      const stts = String(data.status_periksa || '').toLowerCase();
      if (stts === 'belum') row.classList.add('row-belum');
      else if (stts === 'sudah') row.classList.add('row-sudah');
      else if (stts === 'berkas diterima') row.classList.add('row-berkas');
      else if (stts === 'batal') row.classList.add('row-batal');
      else if (stts === 'dirujuk') row.classList.add('row-dirujuk');
      else if (stts === 'meninggal') row.classList.add('row-meninggal');
      else if (stts === 'dirawat') row.classList.add('row-dirawat');
      else if (stts === 'pulang paksa') row.classList.add('row-pulang');

      // status bayar → warna row jika sudah bayar
      const bayar = String(data.status_bayar || '').toLowerCase();
      if (bayar === 'sudah bayar' || bayar === 'sudah') {
        row.classList.add('row-bayar');
      } else if (bayar === 'belum bayar' || bayar === 'belum') {
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
      api.rows({ page: 'current' }).data().each(function (r) {
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
      info: 'Menampilkan _START_–_END_ dari _TOTAL_ pasien',
      infoEmpty: 'Menampilkan 0 pasien',
      lengthMenu: 'Tampil _MENU_',
      search: 'Cari:',
      paginate: { first: 'Pertama', last: 'Terakhir', next: '›', previous: '‹' }
    }
  });

  // ===== Reload manual via tombol Filter
  filterButton.addEventListener('click', function () {
    pasienTable.ajax.reload(null, false);
  });

  // ===== Auto-refresh (polling) =====
  function startPolling() {
    if (pollTimer) clearInterval(pollTimer);
    pollTimer = setInterval(function () {
      // Reload tanpa reset paging; DataTables akan panggil dataSrc yg update lastSignature
      const oldSig = lastSignature;
      pasienTable.ajax.reload(function () {
        // Jika dataset sama, tidak perlu apa-apa; kalau berbeda, baris baru akan auto-highlight oleh rowCallback
        // console.debug('polled; changed?', oldSig !== lastSignature);
      }, false);
    }, POLL_MS);
  }

  startPolling();

  // ===== Auto-reload jika filter diubah (tanpa tombol) =====
  [startDateInput, endDateInput, penjabSelect, statusBayarSelect, statusPeriksaSelect].forEach(function (el) {
    if (!el) return;
    el.addEventListener('change', function () {
      knownKeys.clear(); // reset agar muncul highlight lagi sesuai filter baru
      pasienTable.ajax.reload(null, true);
    });
  });

  // ===== Status Badge Click Handler (Dropdown Menu) =====
  let currentDropdown = null;

  // Click handler for status badges (using event delegation)
  $(document).on('click', '.status-badge-clickable', function (e) {
    e.stopPropagation();

    const $badge = $(this);
    const noRawat = $badge.data('no-rawat');
    const currentStatus = $badge.data('current-status');

    // Close existing dropdown if any
    if (currentDropdown) {
      currentDropdown.remove();
      currentDropdown = null;
    }

    // Create dropdown menu
    const statusOptions = [
      'Belum',
      'Sudah',
      'Berkas Diterima',
      'Batal',
      'Dirujuk',
      'Meninggal',
      'Dirawat',
      'Pulang Paksa'
    ];

    const dropdownHtml = `
      <div class="status-dropdown-menu" style="
        position: absolute;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        min-width: 180px;
        padding: 8px 0;
      ">
        ${statusOptions.map(status => `
          <div class="status-option ${status === currentStatus ? 'active' : ''}" 
               data-status="${status}"
               style="
                 padding: 8px 16px;
                 cursor: pointer;
                 font-size: 13px;
                 ${status === currentStatus ? 'background: #f0f9ff; font-weight: 600;' : ''}
               ">
            ${status === currentStatus ? '✓ ' : ''}${status}
          </div>
        `).join('')}
      </div>
    `;

    const $dropdown = $(dropdownHtml);
    $('body').append($dropdown);
    currentDropdown = $dropdown;

    // Position dropdown below badge
    const badgeOffset = $badge.offset();
    const badgeHeight = $badge.outerHeight();
    $dropdown.css({
      top: badgeOffset.top + badgeHeight + 5,
      left: badgeOffset.left
    });

    // Hover effect for dropdown options
    $dropdown.find('.status-option').hover(
      function () { $(this).css('background', '#f3f4f6'); },
      function () {
        if (!$(this).hasClass('active')) {
          $(this).css('background', 'white');
        }
      }
    );

    // Click handler for status options
    $dropdown.find('.status-option').on('click', function () {
      const newStatus = $(this).data('status');

      if (newStatus === currentStatus) {
        $dropdown.remove();
        currentDropdown = null;
        return;
      }

      // Confirm before changing
      if (confirm(`Ubah status dari "${currentStatus}" ke "${newStatus}"?`)) {
        updateStatus(noRawat, newStatus, $badge);
      }

      $dropdown.remove();
      currentDropdown = null;
    });
  });

  // Close dropdown when clicking outside
  $(document).on('click', function () {
    if (currentDropdown) {
      currentDropdown.remove();
      currentDropdown = null;
    }
  });

  // Function to update status via AJAX
  function updateStatus(noRawat, newStatus, $badge) {
    // Use global UPDATE_STATUS_URL from view, fallback to constructed URL
    const updateUrl = (typeof UPDATE_STATUS_URL !== 'undefined')
      ? UPDATE_STATUS_URL
      : window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/') + '/update_status';

    $.ajax({
      url: updateUrl,
      type: 'POST',
      dataType: 'json',
      data: {
        no_rawat: noRawat,
        new_status: newStatus
      },
      success: function (response) {
        console.log('✅ Update status response:', response);

        if (response.success) {
          console.log('✅ Status berhasil diubah:', response.message);

          try {
            // Update badge immediately
            const newStatus = response.new_status;
            console.log('🔄 New status:', newStatus);
            console.log('🔄 Badge element:', $badge);

            const statusLower = newStatus.toLowerCase();

            // Update badge text and class
            let badgeClass = 'badge-soft status-badge-clickable';
            if (statusLower === 'belum') badgeClass += ' badge-belum';
            else if (statusLower === 'sudah') badgeClass += ' badge-sudah';
            else if (statusLower === 'berkas diterima') badgeClass += ' badge-berkas';
            else if (statusLower === 'batal') badgeClass += ' badge-batal';
            else if (statusLower === 'dirujuk') badgeClass += ' badge-dirujuk';
            else if (statusLower === 'meninggal') badgeClass += ' badge-meninggal';
            else if (statusLower === 'dirawat') badgeClass += ' badge-dirawat';
            else if (statusLower === 'pulang paksa') badgeClass += ' badge-pulang';

            console.log('🔄 Badge class:', badgeClass);

            $badge.attr('class', badgeClass);
            $badge.attr('data-current-status', newStatus);
            $badge.text(newStatus);

            console.log('✅ Badge updated');

            // Update row color immediately
            const $row = $badge.closest('tr');
            console.log('🔄 Row element:', $row);
            console.log('🔄 Row length:', $row.length);

            if ($row.length === 0) {
              console.error('❌ Row not found!');
              return;
            }

            // Remove all status classes (including bayar classes to prevent override)
            $row.removeClass('row-belum row-sudah row-berkas row-batal row-dirujuk row-meninggal row-dirawat row-pulang row-bayar row-bayar-belum');
            console.log('🔄 Removed old classes');

            // Add new status class
            let rowClass = '';
            if (statusLower === 'belum') rowClass = 'row-belum';
            else if (statusLower === 'sudah') rowClass = 'row-sudah';
            else if (statusLower === 'berkas diterima') rowClass = 'row-berkas';
            else if (statusLower === 'batal') rowClass = 'row-batal';
            else if (statusLower === 'dirujuk') rowClass = 'row-dirujuk';
            else if (statusLower === 'meninggal') rowClass = 'row-meninggal';
            else if (statusLower === 'dirawat') rowClass = 'row-dirawat';
            else if (statusLower === 'pulang paksa') rowClass = 'row-pulang';

            console.log('🔄 Adding class:', rowClass);
            $row.addClass(rowClass);

            // Re-add status bayar class if needed (but only as secondary indicator)
            // Check if row has "Sudah Bayar" badge
            const statusBayarBadge = $row.find('.badge-bayar');
            if (statusBayarBadge.length > 0) {
              // Don't add row-bayar, it will override status periksa color
              // Instead, we keep the status periksa color as primary
              console.log('🔄 Status Bayar: Sudah (keeping status periksa color as primary)');
            }

            console.log('✅ Row updated with class:', $row.attr('class'));
            console.log('✅ Row background:', $row.css('background-color'));

            // Update DataTables internal data to keep in sync
            const rowData = pasienTable.row($row).data();
            if (rowData) {
              rowData.status_periksa = newStatus;
              console.log('✅ DataTables data updated');
            }

          } catch (error) {
            console.error('❌ Error updating row:', error);
            alert('Error: ' + error.message);
          }

        } else {
          console.error('❌ Update failed:', response.message);
          alert(response.message || 'Gagal mengubah status.');
        }
      },
      error: function (xhr) {
        console.error('❌ Error updating status:', xhr);
        alert('Terjadi kesalahan saat mengubah status.');
      }
    });
  }

  // ===== Tombol Panggil Pasien =====
  $(document).on('click', '.btn-panggil-pasien', function () {
    const btn = $(this);
    const noRawat = btn.data('no-rawat');
    const namaPasien = btn.data('nama');

    // Disable button (no confirm dialog)
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memanggil...');

    // Call API
    $.ajax({
      url: ANTRIAN_API_URL + 'panggil_pasien',
      method: 'POST',
      dataType: 'json',
      data: {
        no_rawat: noRawat
      },
      success: function (response) {
        if (response.success) {
          // Show success notification with SweetAlert2 (center, animated)
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            html: `<strong>${namaPasien}</strong><br>telah dipanggil`,
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'center',
            backdrop: true,
            showClass: {
              popup: 'animate__animated animate__bounceIn animate__faster'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOut animate__faster'
            }
          });

          // Reload table
          pasienTable.ajax.reload(null, false);
        } else {
          console.error('Failed to call patient:', response.message);
          btn.prop('disabled', false).html('<i class="fa fa-bullhorn"></i> Panggil');
        }
      },
      error: function (xhr, status, error) {
        console.error('Error calling patient:', error);
        btn.prop('disabled', false).html('<i class="fa fa-bullhorn"></i> Panggil');
      }
    });
  });
});

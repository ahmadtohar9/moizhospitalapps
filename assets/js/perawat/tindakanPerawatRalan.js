/* assets/js/perawat/tindakanPerawatRalan.js */
$(document).ready(function () {
  console.log("🚀 tindakanPerawatRalan.js Loaded!");

  // ====== Grab essentials ======
  const noRawat    = $('#no_rawat').val();
  const noRkmMedis = $('#no_rkm_medis').val();
  const nipPerawat = $('#nip_perawat').val();
  const apiUrl     = (typeof BASE_URL !== 'undefined' ? BASE_URL : (window.BASE_URL || '/')) + "perawat/TindakanRalanPerawatController";

  if (!noRawat) {
    console.warn("⚠️ No Rawat tidak ditemukan. Tidak bisa memuat data.");
    return;
  }

  // ====== Currency formatter ======
  function formatRupiah(angka) {
    const n = Number(angka || 0);
    try {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
      }).format(n);
    } catch (_) {
      // fallback
      return 'Rp ' + (n.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
    }
  }

  // ====== Search master tindakan ======
  $('#searchTindakan').on('input', function () {
    const keyword = $(this).val().toLowerCase();
    $('#tindakanBody tr').each(function () {
      const match = $(this).text().toLowerCase().includes(keyword);
      $(this).toggle(match);
    });
    // Prioritaskan baris yang dicentang di atas
    $('#tindakanBody').prepend($('#tindakanBody tr.checked-row'));
  });

  // ====== Load master tindakan (perawat) ======
  function loadTindakan() {
    $.get(`${apiUrl}/getTindakan`, { no_rawat: noRawat }, function (response) {
      let html = '';
      const list = (response && response.data) ? response.data : [];
      if (response.status === 'success' && list.length > 0) {
        list.forEach((tindakan, index) => {
          // field di model perawat:
          // kd_jenis_prw, nm_perawatan, nm_kategori, material, bhp,
          // tarif_tindakanpr, kso, menejemen, total_byrpr
          html += `
            <tr>
              <td>${index + 1}</td>
              <td>
                <input type="checkbox" class="tindakan-checkbox"
                  data-kode="${tindakan.kd_jenis_prw}"
                  data-material="${tindakan.material}"
                  data-bhp="${tindakan.bhp}"
                  data-tarif-tindakandr="${tindakan.tarif_tindakanpr || 0}"
                  data-kso="${tindakan.kso}"
                  data-menejemen="${tindakan.menejemen}"
                  data-biaya-rawat="${tindakan.total_byrpr || 0}">
              </td>
              <td>${tindakan.kd_jenis_prw}</td>
              <td>${tindakan.nm_perawatan}</td>
              <td>${tindakan.nm_kategori}</td>
              <td>${formatRupiah(tindakan.total_byrpr || 0)}</td>
            </tr>`;
        });

        // Scroll jika > 5 item (opsional, sudah ada wrapper)
        if (list.length > 5) {
          $('#tindakanTable').parent().css({ 'max-height': '250px', 'overflow-y': 'auto' });
        } else {
          $('#tindakanTable').parent().css({ 'max-height': '', 'overflow-y': '' });
        }
      } else {
        html = '<tr><td colspan="6" class="text-center text-muted">Tidak ada data tersedia.</td></tr>';
      }
      $('#tindakanBody').html(html);
    }, 'json').fail(function (xhr) {
      console.error('❌ loadTindakan fail:', xhr);
      $('#tindakanBody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat master tindakan.</td></tr>');
    });
  }

  // Tandai baris dicentang → prioritas tampil di atas
  $(document).on('change', '.tindakan-checkbox', function () {
    const row = $(this).closest('tr');
    if ($(this).is(':checked')) row.addClass('checked-row');
    else row.removeClass('checked-row');
    // Naikkan baris centang ke atas
    $('#tindakanBody').prepend($('#tindakanBody tr.checked-row'));
  });

  // ====== Load hasil tindakan (rawat_jl_pr) ======
  function loadHasilTindakan() 
  {
    $.get(`${apiUrl}/getHasilTindakan`, { no_rawat: noRawat }, function (response) {
      let html = '';
      let total = 0;

      if (response.status === 'success' && Array.isArray(response.data) && response.data.length > 0) {
        response.data.forEach((d, i) => {
          total += parseFloat(d.biaya_rawat || 0);
          const canDelete = Number(d.allow_delete) === 1;      // hanya perawat & owner
          const isDokter  = (d.sumber === 'dokter');

          html += `
            <tr class="${isDokter ? 'table-warning' : ''}">
              <td>
                <input type="checkbox" class="hasil-checkbox"
                  ${canDelete ? '' : 'disabled'}
                  data-allow_delete="${canDelete ? 1 : 0}"
                  data-sumber="${d.sumber}"
                  data-no_rawat="${d.no_rawat}"
                  data-kd_jenis_prw="${d.kd_jenis_prw}"
                  data-tgl_perawatan="${d.tgl_perawatan}"
                  data-jam_rawat="${d.jam_rawat}">
              </td>
              <td>${i + 1}</td>
              <td>${d.tgl_perawatan || '-'}</td>
              <td>${d.jam_rawat || '-'}</td>
              <td>${d.pemeriksa || '-'}</td>
              <td>${d.kd_jenis_prw || '-'}</td>
              <td>${d.nm_perawatan || '-'}</td>
              <td>${formatRupiah(d.biaya_rawat || 0)}</td>
              <td>
                ${canDelete
                  ? `<button class="btn btn-sm btn-danger delete-single"
                       data-sumber="${d.sumber}"
                       data-no_rawat="${d.no_rawat}"
                       data-kd_jenis_prw="${d.kd_jenis_prw}"
                       data-tgl_perawatan="${d.tgl_perawatan}"
                       data-jam_rawat="${d.jam_rawat}">
                       Hapus
                     </button>`
                  : `<span class="badge badge-secondary">Tidak bisa hapus</span>`}
              </td>
            </tr>`;
        });

        html += `
          <tr style="background:#f8f8f8;font-weight:bold;">
            <td colspan="7" class="text-right">Total Tagihan</td>
            <td colspan="2">${formatRupiah(total)}</td>
          </tr>`;
      } else {
        html = '<tr><td colspan="9" class="text-center text-muted">Belum ada tindakan.</td></tr>';
      }

      $('#hasilTindakanBody').html(html);
    }, 'json').fail(function (xhr) {
      console.error('❌ loadHasilTindakan fail:', xhr);
      $('#hasilTindakanBody').html('<tr><td colspan="9" class="text-center text-danger">Gagal memuat hasil tindakan.</td></tr>');
    });
  }


  // ====== Save tindakan terpilih ======
  $('#saveTindakan').on('click', function () {
    const selected = [];
    const now = new Date();
    const tglPerawatan = now.toISOString().slice(0, 10);                      // YYYY-MM-DD
    const jamRawat     = now.toTimeString().slice(0, 8);                       // HH:MM:SS

    $('.tindakan-checkbox:checked').each(function () {
      selected.push({
        kd_jenis_prw:       $(this).data('kode'),
        material:           $(this).data('material'),
        bhp:                $(this).data('bhp'),
        tarif_tindakandr:   $(this).data('tarif-tindakandr') || 0, // mapped to tarif_tindakanpr di server
        kso:                $(this).data('kso'),
        menejemen:          $(this).data('menejemen'),
        biaya_rawat:        $(this).data('biaya-rawat') || 0,
        tgl_perawatan:      tglPerawatan,
        jam_rawat:          jamRawat,
        stts_bayar:         'Belum'
      });
    });

    if (selected.length === 0) {
      if (window.Swal) return Swal.fire('Pilih minimal satu tindakan.', '', 'warning');
      return alert('Pilih minimal satu tindakan.');
    }

    $.post(`${apiUrl}/saveTindakan`, {
      no_rawat: noRawat,
      tindakan: selected
    }, function (res) {
      if (res.status === 'success') {
        if (window.Swal) Swal.fire({ title:'Tindakan berhasil disimpan!', icon:'success', timer: 1600, showConfirmButton:false });
        // uncheck & rapikan
        $('.tindakan-checkbox:checked').prop('checked', false).closest('tr').removeClass('checked-row');
        loadHasilTindakan();
      } else {
        const msg = res.message || 'Gagal menyimpan tindakan.';
        if (window.Swal) Swal.fire({ icon:'error', title:'Gagal', text: msg });
      }
    }, 'json').fail(function (xhr) {
      console.error('❌ saveTindakan fail:', xhr);
      let msg = 'Gagal menghubungi server.';
      try {
        const r = JSON.parse(xhr.responseText || '{}');
        if (r && r.message) msg = r.message;
      } catch(_) {}
      if (window.Swal) Swal.fire({ icon:'error', title:'Error', text: msg });
    });
  });

  // ====== Delete banyak tindakan (pakai helper → tampilkan pesan spesifik) ======
  $('#deleteSelectedTindakan').on('click', function () {
  const items = [];
  $('.hasil-checkbox:checked').each(function () {
    if (Number($(this).data('allow_delete')) === 1) {
      items.push({
        sumber:        $(this).data('sumber'),
        no_rawat:      $(this).data('no_rawat'),
        kd_jenis_prw:  $(this).data('kd_jenis_prw'),
        tgl_perawatan: $(this).data('tgl_perawatan'),
        jam_rawat:     $(this).data('jam_rawat')
      });
    }
  });

  if (items.length === 0) {
    if (window.Swal) return Swal.fire('Tidak ada item yang bisa dihapus.', '', 'info');
    return alert('Tidak ada item yang bisa dihapus.');
  }

  $.post(`${apiUrl}/deleteTindakan`, { items }, function (res) {
    if (res.status === 'success') {
      if (window.Swal) Swal.fire({ title:'Tindakan berhasil dihapus!', icon:'success', timer:1600, showConfirmButton:false });
      loadHasilTindakan();
      $('#selectAllHasil').prop('checked', false);
    } else {
      const msg = res.message || 'Gagal menghapus tindakan.';
      if (window.Swal) Swal.fire({ icon:'error', title:'Gagal', text: msg });
    }
  }, 'json').fail(function (xhr) {
    let msg = 'Gagal menghubungi server.';
    try { const r = JSON.parse(xhr.responseText||'{}'); if (r.message) msg = r.message; } catch(e){}
    if (window.Swal) Swal.fire({ icon:'error', title:'Gagal', text: msg });
  });
});



  // ====== Delete single tindakan ======
 $(document).on('click', '.delete-single', function () {
  const row = $(this).closest('tr');
  const item = {
    sumber:        $(this).data('sumber'),
    no_rawat:      $(this).data('no_rawat'),
    kd_jenis_prw:  $(this).data('kd_jenis_prw'),
    tgl_perawatan: $(this).data('tgl_perawatan'),
    jam_rawat:     $(this).data('jam_rawat')
  };

  $.post(`${apiUrl}/deleteTindakan`, { items: [item] }, function (res) {
    if (res.status === 'success') {
      if (window.Swal) Swal.fire({ title:'Tindakan berhasil dihapus!', icon:'success', timer:1400, showConfirmButton:false });
      row.remove();
      loadHasilTindakan();
    } else {
      const msg = res.message || 'Gagal menghapus tindakan.';
      if (window.Swal) Swal.fire({ icon:'error', title:'Gagal', text: msg });
    }
  }, 'json').fail(function (xhr) {
    let msg = 'Gagal menghubungi server.';
    try { const r = JSON.parse(xhr.responseText||'{}'); if (r.message) msg = r.message; } catch(e){}
    if (window.Swal) Swal.fire({ icon:'error', title:'Gagal', text: msg });
  });
});


  // ====== Select all hasil checkbox ======
  $('#selectAllHasil').on('change', function () {
    const state = $(this).prop('checked');
    $('.hasil-checkbox').each(function () {
      if (Number($(this).data('allow_delete')) === 1) {
        $(this).prop('checked', state);
      }
    });
  });



  // ====== Riwayat tindakan (by NoRM) ======
  $('#btnRiwayatTindakan').on('click', function () {
    loadRiwayatTindakan();
  });

  function loadRiwayatTindakan() {
    if (!noRkmMedis) return;
    $.get(`${apiUrl}/getRiwayatTindakanByNorm`, { no_rkm_medis: noRkmMedis }, function (res) {
      let html = '';
      if (res.status === 'success' && Array.isArray(res.data) && res.data.length > 0) {
        // group by no_rawat
        const grouped = {};
        res.data.forEach(it => {
          (grouped[it.no_rawat] = grouped[it.no_rawat] || []).push(it);
        });

        let idx = 1;
        for (const [keyNoRawat, items] of Object.entries(grouped)) {
          const info = items[0];
          html += `
            <table class="table table-bordered mb-4">
              <thead class="thead-light">
                <tr class="bg-light">
                  <th colspan="6" class="text-left">
                    <strong>${idx++}. No. Rawat:</strong> ${info.no_rawat}<br/>
                    <strong>Tanggal:</strong> ${info.tgl_perawatan} <br/>
                    <strong>Perawat:</strong> ${info.nama_perawat || '-'}
                    <span class="float-right">
                      <input type="checkbox" class="check-group" data-group="${keyNoRawat}">
                      <label class="mb-0 ml-1">Pilih Semua</label>
                    </span>
                  </th>
                </tr>
                <tr class="text-center">
                  <th style="width:5%">#</th>
                  <th style="width:5%"></th>
                  <th>Jam</th>
                  <th>Nama Tindakan</th>
                  <th>Tarif</th>
                  <th style="width:10%">Aksi</th>
                </tr>
              </thead>
              <tbody>`;

          items.forEach((item, i) => {
            const jsonData = JSON.stringify(item).replace(/"/g, '&quot;');
            html += `
              <tr>
                <td class="text-center">${i + 1}</td>
                <td class="text-center">
                  <input type="checkbox" class="checkbox-copy-tindakan"
                    data-json="${jsonData}"
                    data-group="${keyNoRawat}">
                </td>
                <td>${item.jam_rawat}</td>
                <td>${item.nm_perawatan}</td>
                <td>${formatRupiah(item.biaya_rawat)}</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-primary btn-copy-tindakan"
                    data-kode="${item.kd_jenis_prw}"
                    data-material="${item.material}"
                    data-bhp="${item.bhp}"
                    data-tarif="${item.tarif_tindakanpr || 0}"
                    data-kso="${item.kso}"
                    data-menejemen="${item.menejemen}"
                    data-biaya="${item.biaya_rawat || 0}">
                    Copy
                  </button>
                </td>
              </tr>`;
          });

          html += `</tbody></table>`;
        }
      } else {
        html = `<div class="alert alert-warning text-center">Tidak ada riwayat tindakan.</div>`;
      }

      $('#containerRiwayatTindakan').html(html);
      $('#modalRiwayatTindakan').modal('show');
    }, 'json').fail(function (xhr) {
      console.error('❌ loadRiwayatTindakan fail:', xhr);
      $('#containerRiwayatTindakan').html('<div class="alert alert-danger">Gagal memuat riwayat tindakan.</div>');
      $('#modalRiwayatTindakan').modal('show');
    });
  }

  // Group select in modal
  $(document).on('change', '.check-group', function () {
    const id = $(this).data('group');
    $(`.checkbox-copy-tindakan[data-group="${id}"]`).prop('checked', $(this).prop('checked'));
  });

  // Copy satu item dari riwayat → centang di master list
  $(document).on('click', '.btn-copy-tindakan', function () {
    const kode = $(this).data('kode');
    const row = $('#tindakanBody tr').filter((_, el) => $(el).find(`[data-kode="${kode}"]`).length);
    if (row.length) {
      row.find('input[type="checkbox"]').prop('checked', true).trigger('change');
      if (window.Swal) Swal.fire({ title: 'Data Berhasil Dicopy!', icon: 'success', timer: 1400, showConfirmButton: false });
    } else {
      if (window.Swal) Swal.fire('⚠️ Tindakan tidak ditemukan di daftar master.', '', 'warning');
    }
    // Tetap biarkan modal terbuka agar user bisa copy yang lain
  });

  // Copy semua item terpilih di modal → centang di master list
  $('#btnCopySelected').on('click', function () {
    const selected = [];
    $('.checkbox-copy-tindakan:checked').each(function () {
      try {
        selected.push(JSON.parse($(this).attr('data-json') || '{}'));
      } catch(_) {}
    });

    if (selected.length === 0) {
      if (window.Swal) Swal.fire({ title: 'Pilih Minimal 1 Data!', icon: 'warning', timer: 1400, showConfirmButton: false });
      return;
    }

    selected.forEach(item => {
      const row = $('#tindakanBody tr').filter((_, el) => $(el).find(`[data-kode="${item.kd_jenis_prw}"]`).length);
      if (row.length) {
        row.find('input[type="checkbox"]').prop('checked', true).trigger('change');
      }
    });

    $('#modalRiwayatTindakan').modal('hide');
    if (window.Swal) Swal.fire({ title: 'Data Berhasil Dicopy!', icon: 'success', timer: 1400, showConfirmButton: false });
  });

  // ====== Init ======
  loadTindakan();
  loadHasilTindakan();
});

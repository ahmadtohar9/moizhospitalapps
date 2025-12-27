// resepRalan.js - Versi Final dengan Fitur Lengkap (Stabil, Cegah Duplikat, Batasi Riwayat) + Over Budget BPJS

$(document).ready(function () {
  const BASE_URL = `${window.location.origin}/${window.location.pathname.split('/')[1]}/`;
  const noRawat = $('#no_rawat').val();
  const noRkmMedis = $('#no_rkm_medis').val();
  const kdDokter = $('#kd_dokter').val();
  const tglPeresepan = $('#tgl_peresepan').val();
  const jamPeresepan = $('#jam_peresepan').val();

  // ====== Over Budget Config ======
  const BUDGET_LIMIT = 80000; // Rp80.000
  let sumExisting = 0;        // total dari resep yang sudah tersimpan
  const priceIndex = {};      // kode_brng -> harga, diisi saat loadObat

  let inputCache = {};
  let showAllRiwayat = false;

  function formatRupiah(value) {
    try {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(Number(value || 0));
    } catch (e) {
      const n = Number(String(value || 0).replace(/[^\d]/g, '')) || 0;
      return 'Rp' + n.toLocaleString('id-ID');
    }
  }

  // ====== OVER BUDGET: helper ======
  function calcDraftTotal() {
    // total dari inputCache (qty * harga)
    let t = 0;
    for (const kode in inputCache) {
      const qty = Number(inputCache[kode]?.jumlah || 0);
      const harga = Number(priceIndex[kode] || 0);
      if (qty > 0 && harga > 0) t += (qty * harga);
    }
    return t;
  }

  function ensureBannerContainer() {
    // Dihilangkan sesuai request
    return null;
  }

  function renderOverBudgetBanner() {
    // Dihilangkan sesuai request - tidak menampilkan notifikasi diatas panel
    return;
  }

  // ====== OBAT LIST & INPUT ======
  function renderObatTable(obatList) {
    let html = '';
    obatList.forEach((obat, i) => {
      // simpan harga ke index untuk kalkulasi draft
      priceIndex[obat.kode_brng] = Number(obat.harga || 0);

      const jumlah = inputCache[obat.kode_brng]?.jumlah || '';
      const signa = inputCache[obat.kode_brng]?.signa || '';
      const bg = jumlah ? 'bg-success-subtle' : '';
      html += `<tr class="${bg}">
        <td>${i + 1}</td>
        <td>${obat.kode_brng}</td>
        <td>${obat.nama_brng}</td>
        <td class="text-end">${formatRupiah(obat.harga)}</td>
        <td>${obat.stok}</td>
        <td>${obat.satuan}</td>
        <td>
          <input type="number" min="0" class="form-control jumlah-obat" data-kode="${obat.kode_brng}" data-stok="${obat.stok}" value="${jumlah}" placeholder="0">
        </td>
        <td>
          <input type="text" class="form-control signa-obat" data-kode="${obat.kode_brng}" value="${signa}" placeholder="Signa">
        </td>
      </tr>`;
    });
    $('#obatBody').html(html);

    // Initialisasi autocomplete untuk signa
    if ($.fn.autocomplete) {
      $('.signa-obat').autocomplete({
        source: function (request, response) {
          $.ajax({
            url: `${BASE_URL}api/signaObat`,
            type: 'POST',
            dataType: 'json',
            data: { term: request.term },
            success: function (data) {
              response($.map(data, function (item) {
                return { label: item.aturan, value: item.aturan };
              }));
            }
          });
        },
        minLength: 1,
        select: function (event, ui) {
          // Trigger simpan inputCache saat dipilih
          // Note: $(this).val() belum ter-set otomatis saat event select, jadi kita pakai ui.item.value
          const kode = $(this).data('kode');
          // Update visual manual karena event change mungkin terlambat
          $(this).val(ui.item.value);
          // Kita panggil logic simpan
          // Perlu set inputCache manual atau panggil saveInput dengan value baru
          // Tapi saveInput membaca $(this).val(), jadi sudah aman karena kita set barusan.
          saveInput(kode);
        }
      });
    }

    // render banner ulang setelah table (harga-index mungkin baru)
    renderOverBudgetBanner();
  }

  function loadObat(keyword = '') {
    if (!keyword && Object.keys(inputCache).length === 0) {
      $('#obatBody').html('<tr><td colspan="8" class="text-center text-muted">Silakan cari nama obat untuk menampilkan data</td></tr>');
      renderOverBudgetBanner();
      return;
    }

    $.getJSON(`${BASE_URL}permintaanResepRalan/getObatList`, function (res) {
      if (res.status !== 'success') {
        $('#obatBody').html('<tr><td colspan="8" class="text-center">Tidak ada data obat</td></tr>');
        renderOverBudgetBanner();
        return;
      }

      let data = res.data || [];
      if (keyword) {
        data = data.filter(item => (item.nama_brng || '').toLowerCase().includes(keyword.toLowerCase()));
      } else {
        data = data.filter(item => inputCache[item.kode_brng]);
      }

      // cegah duplikat
      const seen = new Set();
      const filtered = [];
      data.forEach(item => {
        if (!seen.has(item.kode_brng)) {
          seen.add(item.kode_brng);
          filtered.push(item);
        }
      });

      renderObatTable(filtered);
    });
  }

  function saveInput(kode) {
    const $qty = $(`.jumlah-obat[data-kode='${kode}']`);
    const $sig = $(`.signa-obat[data-kode='${kode}']`);
    const jumlah = Number($qty.val() || 0);
    const signa = String($sig.val() || '');
    const stok = Number($qty.data('stok') || 0);

    if (jumlah > stok) {
      Swal.fire({ icon: 'warning', title: 'Stok Tidak Cukup', text: `Stok untuk obat ini tidak mencukupi.`, timer: 3000, showConfirmButton: false });
      $qty.val(0);
      inputCache[kode] = { jumlah: 0, signa };
    } else {
      inputCache[kode] = { jumlah, signa };
    }

    renderOverBudgetBanner();
  }

  // ====== HASIL / RINGKASAN RESEP (Redesign) ======
  function loadHasilResep() {
    $.getJSON(`${BASE_URL}permintaanResepRalan/getHasilResep?no_rawat=${noRawat}`, function (res) {
      const container = $('#hasilResepGrouped');
      if (res.status !== 'success' || !Array.isArray(res.data) || !res.data.length) {
        sumExisting = 0;
        container.html(`
          <div class="text-center py-5">
            <div style="font-size: 48px; color: #e2e8f0; margin-bottom: 10px;"><i class="fa fa-prescription-bottle"></i></div>
            <h5 class="text-muted">Belum ada resep untuk hari ini</h5>
            <p class="text-secondary small">Silakan input obat pada form di atas.</p>
          </div>`);
        $('#totalHargaObat').text(formatRupiah(0));
        return;
      }

      const grouped = {};
      let total = 0;
      res.data.forEach(item => {
        grouped[item.no_resep] = grouped[item.no_resep] || [];
        grouped[item.no_resep].push(item);
        total += Number(item.total || 0);
      });

      sumExisting = total;
      let html = '';
      const isOver = total > BUDGET_LIMIT;

      // Render Alert Over Budget (Hanya disini)
      if (isOver) {
        const selisih = total - BUDGET_LIMIT;
        html += `
        <div class="alert shadow-sm mb-3" style="background-color: #d32f2f; color: #ffffff; border: none; border-radius: 8px; padding: 15px 20px;">
          <div class="d-flex align-items-center">
            <i class="fa fa-exclamation-triangle me-4" style="color: #fff; font-size: 3em;"></i>
            <div>
              <h5 class="alert-heading text-white mb-0" style="font-weight: 800; font-size: 1.8rem; line-height: 1;">Over Budget BPJS</h5>
              <p class="mb-0" style="font-size: 1.25rem; line-height: 1.2; margin-top: 5px; font-weight: 500;">
                Total resep <strong>${formatRupiah(total)}</strong> melebihi limit <strong>${formatRupiah(BUDGET_LIMIT)}</strong> 
                sebesar <strong style="text-decoration: underline; color: #ffeb3b;">${formatRupiah(selisih)}</strong>. Mohon tinjau kembali.
              </p>
            </div>
          </div>
        </div>`;
      }

      // Loop per No Resep (Card Style)
      for (const [noResep, items] of Object.entries(grouped)) {
        const isValid = items[0].tgl_perawatan !== '0000-00-00' && items[0].jam !== '00:00:00';
        const subtotalGroup = items.reduce((a, b) => a + Number(b.total || 0), 0);

        // Warna header card based on validity
        const headerClass = isValid ? 'bg-success text-white' : 'bg-white text-dark';
        const borderClass = isValid ? 'border-success' : 'border-light';
        // Status Badge: perbesar ukuran font
        const statusBadge = isValid
          ? `<span class="badge bg-white text-success px-2 py-1" style="font-size: 0.9rem;"><i class="fa fa-check-circle"></i> Tervalidasi</span>`
          : `<span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.9rem;"><i class="fa fa-clock"></i> Belum Validasi</span>`;

        html += `
        <div class="card mb-3 shadow-sm ${borderClass}" style="border-radius: 8px; overflow: hidden; border: 1px solid #ddd;">
          <div class="card-header ${headerClass} d-flex justify-content-between align-items-center px-3 py-2">
            <div>
              <h6 class="mb-0 fw-bold"><i class="fa fa-file-prescription me-2"></i> No. Resep: ${noResep}</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
               ${statusBadge}
               <span class="badge bg-dark text-white shadow-sm px-2 py-1" style="font-size: 0.85rem;">${formatRupiah(subtotalGroup)}</span>
               ${!isValid ? `
               <button class="btn btn-sm btn-danger ms-2 px-2 py-1 delete-resep-group" data-no_resep="${noResep}" title="Hapus Satu Resep Full">
                 <i class="fa fa-trash"></i> Hapus
               </button>` : ''}
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped mb-0">
                <thead class="bg-light text-secondary">
                  <tr>
                    <th class="ps-3 py-2" style="width:5%">No</th>
                    <th class="py-2" style="width:15%">Kode</th>
                    <th class="py-2">Nama Obat</th>
                    <th class="text-center py-2" style="width:8%">Jml</th>
                    <th class="text-end py-2" style="width:15%">Harga</th>
                    <th class="py-2" style="width:25%">Signa</th>
                    <th class="text-center py-2" style="width:8%">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;

        items.forEach((item, i) => {
          html += `
          <tr>
            <td class="ps-3 py-2">${i + 1}</td>
            <td class="py-2"><span style="font-weight: 500; font-family: monospace;">${item.kode_brng}</span></td>
            <td class="fw-semibold text-dark py-2">${item.nama_brng}</td>
            <td class="text-center py-2"><span class="badge bg-info text-dark">${item.jumlah}</span></td>
            <td class="text-end fw-semibold text-secondary py-2">${formatRupiah(item.total)}</td>
            <td class="py-2"><span class="text-primary fst-italic">${item.signa}</span></td>
            <td class="text-center py-2">
              ${!isValid ? `
              <button class="btn btn-sm btn-outline-danger delete-resep" data-kode="${item.kode_brng}" data-jumlah="${item.jumlah}" title="Hapus Item" style="padding: 2px 8px;">
                <i class="fa fa-times"></i>
              </button>` : '<i class="fa fa-lock text-muted"></i>'}
            </td>
          </tr>`;
        });

        html += `
                </tbody>
              </table>
            </div>
          </div>
        </div>`;
      }

      container.html(html);
      $('#totalHargaObat').html(`<span class="badge bg-primary fs-5 shadow">${formatRupiah(total)}</span>`);
    });
  }

  // ====== RIWAYAT RESEP (Redesign w/ Limit 3) ======
  function loadRiwayatResepPasien() {
    const container = $('#containerRiwayatResep');
    $.getJSON(`${BASE_URL}permintaanResepRalan/getRiwayatObatByNorm?no_rkm_medis=${noRkmMedis}`, function (res) {
      if (res.status !== 'success' || !Array.isArray(res.data) || res.data.length === 0) {
        container.html(`
          <div class="text-center py-4 text-muted">
            <i class="fa fa-history fa-3x mb-2 text-gray-300"></i>
            <p>Tidak ada riwayat resep sebelumnya.</p>
          </div>`);
        return;
      }

      const grouped = {};
      res.data.forEach(item => {
        grouped[item.no_resep] = grouped[item.no_resep] || [];
        grouped[item.no_resep].push(item);
      });

      const allGroups = Object.entries(grouped);
      // Logic: Tampilkan semua jika flag true, jika tidak tampilkan 3 saja.
      const limit = showAllRiwayat ? allGroups.length : 3;
      const groupsToShow = allGroups.slice(0, limit);
      const hasMore = allGroups.length > 3;

      let html = '';

      groupsToShow.forEach(([noResep, items], index) => {
        const tglResep = items[0].tgl_peresepan ? items[0].tgl_peresepan : (items[0].tgl_perawatan || '-');

        html += `
          <div class="card mb-3 border bg-light">
           <div class="card-header bg-white d-flex justify-content-between align-items-center py-2">
              <div class="form-check m-0">
                <input class="form-check-input check-group" type="checkbox" id="chk_${noResep}" data-group="${noResep}" style="transform: scale(1.2);">
                <label class="form-check-label fw-bold text-primary ms-2" for="chk_${noResep}">
                  <i class="fa fa-receipt me-1"></i> No. Resep: ${noResep}
                </label>
                <div class="small text-muted ms-4 ps-2"><i class="fa fa-calendar-alt"></i> ${tglResep}</div>
              </div>
           </div>
           
           <div class="card-body p-0">
             <table class="table table-sm table-striped mb-0 table-hover">
               <tbody>`;

        items.forEach(item => {
          // Prep data for copy
          const safeJson = JSON.stringify({
            kode_brng: item.kode_brng,
            jml: item.jml,
            aturan_pakai: item.aturan_pakai
          }).replace(/"/g, '&quot;');

          html += `
           <tr>
             <td style="width: 40px;" class="text-center align-middle">
               <input type="checkbox" class="checkbox-copy-obat" data-json="${safeJson}" data-group="${noResep}">
             </td>
             <td class="align-middle">
               <div class="fw-bold text-dark">${item.nama_brng}</div>
               <div class="small text-muted"><i class="fa fa-tag scale-75"></i> ${formatRupiah(item.total_bayar)}</div>
             </td>
             <td style="width: 80px;" class="text-center align-middle">
                <span class="badge bg-secondary rounded-pill">${item.jml}</span>
             </td>
             <td style="width: 150px;" class="text-end align-middle fst-italic small text-primary pr-3">
               ${item.aturan_pakai}
             </td>
           </tr>`;
        });

        html += `
             </tbody>
             </table>
           </div>
        </div>`;
      });

      // Tombol Load More / Less
      if (hasMore) {
        if (!showAllRiwayat) {
          const remaining = allGroups.length - 3;
          html += `
          <div class="text-center mt-3">
            <button class="btn btn-outline-primary shadow-sm rounded-pill px-4" id="btnToggleRiwayat">
              <i class="fa fa-chevron-down me-1"></i> Tampilkan ${remaining} Riwayat Lainnya
            </button>
          </div>`;
        } else {
          html += `
          <div class="text-center mt-3">
            <button class="btn btn-outline-secondary shadow-sm rounded-pill px-4" id="btnToggleRiwayat">
              <i class="fa fa-chevron-up me-1"></i> Sembunyikan Riwayat Lama
            </button>
          </div>`;
        }
      }

      container.html(html);
    });
  }

  // Update event handler untuk toggle riwayat
  $(document).off('click', '#btnToggleRiwayat').on('click', '#btnToggleRiwayat', function () {
    showAllRiwayat = !showAllRiwayat;
    loadRiwayatResepPasien();
  });

  // ====== EVENTS ======
  $(document).on('click', '#lihatSemuaRiwayat', function () {
    showAllRiwayat = true;
    loadRiwayatResepPasien();
  });

  $(document).on('change keyup', '.jumlah-obat, .signa-obat', function () {
    saveInput($(this).data('kode'));
  });

  $(document).on('change', '.check-group', function () {
    const group = $(this).data('group');
    $(`.checkbox - copy - obat[data - group='${group}']`).prop('checked', this.checked);
  });

  $('#btnCopyResepSelected').on('click', function () {
    const selected = [];
    $('.checkbox-copy-obat:checked').each(function () {
      let rawJson = $(this).attr('data-json');
      try {
        rawJson = rawJson.replace(/&quot;/g, '"');
        const item = JSON.parse(rawJson);
        selected.push(item);
      } catch (err) {
        console.warn('❌ Gagal parse JSON:', rawJson);
      }
    });

    if (!selected.length) {
      return Swal.fire('Perhatian', 'Tidak ada yang dipilih.', 'warning');
    }

    selected.forEach(item => {
      inputCache[item.kode_brng] = {
        jumlah: Number(item.jml || 0),
        signa: item.aturan_pakai || ''
      };
    });

    // refresh list obat berlandaskan cache & render banner
    $('#searchObat').val(' ');
    loadObat();
    Swal.fire({ icon: 'success', title: 'Tersalin', text: 'Obat berhasil disalin.', timer: 3000, showConfirmButton: false });
  });

  $(document).on('click', '.delete-resep', function () {
    $.post(`${BASE_URL}permintaanResepRalan/delete`, {
      kode_brng: $(this).data('kode'),
      jumlah: $(this).data('jumlah')
    }, function (res) {
      if (res.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Terhapus',
          text: 'Item resep berhasil dihapus.',
          timer: 3000,
          showConfirmButton: false
        });
        loadHasilResep();
        loadRiwayatResepPasien();
      }
    }, 'json');
  });

  $(document).on('click', '.delete-resep-group', function () {
    Swal.fire({
      title: 'Hapus Resep?',
      text: "Seluruh item dalam resep ini akan dihapus permanen.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus Semua!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(`${BASE_URL}permintaanResepRalan/deleteAllResep`, {
          no_resep: $(this).data('no_resep')
        }, function (res) {
          if (res.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Terhapus',
              text: 'Seluruh resep berhasil dihapus.',
              timer: 3000,
              showConfirmButton: false
            });
            loadHasilResep();
            loadRiwayatResepPasien();
          }
        }, 'json');
      }
    });
  });

  $('#saveResep').on('click', function () {
    const resep = Object.entries(inputCache)
      .filter(([_, val]) => Number(val.jumlah) > 0)
      .map(([kode_brng, val]) => ({
        kode_brng,
        jumlah: Number(val.jumlah || 0),
        signa: String(val.signa || '')
      }));

    if (!resep.length) {
      return Swal.fire('Peringatan', 'Tidak ada obat yang diisi.', 'warning');
    }

    // Extract kode_brng for duplicate check
    const medicines = resep.map(r => r.kode_brng);

    // Check for duplicates first
    $.post(`${BASE_URL}permintaanResepRalan/checkDuplicateMedicine`, {
      no_rkm_medis: noRkmMedis,
      no_rawat: noRawat,
      medicines: medicines
    }, function (checkRes) {
      // If there are duplicates, show warning
      if (checkRes.has_duplicate && checkRes.duplicates && checkRes.duplicates.length > 0) {
        let duplicateList = '<ul style="text-align: left; margin-top: 10px;">';
        checkRes.duplicates.forEach(dup => {
          duplicateList += `
          <li style="margin-bottom: 10px;">
              <strong>${dup.nama_brng}</strong><br>
              <small>
                <i class="fa fa-hospital"></i> ${dup.nm_poli} - 
                <i class="fa fa-user-md"></i> ${dup.nm_dokter}<br>
                <i class="fa fa-clock"></i> ${dup.tgl_peresepan} ${dup.jam_peresepan} - 
                <i class="fa fa-pills"></i> ${dup.jml} - 
                <i class="fa fa-prescription"></i> ${dup.aturan_pakai}
              </small>
            </li>`;
        });
        duplicateList += '</ul>';

        Swal.fire({
          icon: 'warning',
          title: '⚠️ Peringatan Duplikasi Obat!',
          html: `
          <div style="text-align: left;">
            <p>Obat berikut sudah diberikan hari ini di poli lain:</p>
              ${duplicateList}
            <p style="margin-top: 15px;"><strong>Apakah tetap ingin menambahkan obat ini?</strong></p>
          </div>
          `,
          showCancelButton: true,
          confirmButtonText: '<i class="fa fa-check"></i> Tetap Tambahkan',
          cancelButtonText: '<i class="fa fa-times"></i> Batal',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          width: '600px'
        }).then((result) => {
          if (result.isConfirmed) {
            // User confirmed, proceed with budget check
            proceedWithBudgetCheck(resep);
          }
        });
      } else {
        // No duplicates, proceed with budget check
        proceedWithBudgetCheck(resep);
      }
    }, 'json').fail(function () {
      // If check fails, proceed anyway (don't block)
      proceedWithBudgetCheck(resep);
    });

    // Function to check budget and save
    function proceedWithBudgetCheck(resep) {
      const draft = calcDraftTotal();
      const combined = sumExisting + draft;

      const doSave = () => {
        $.post(`${BASE_URL}permintaanResepRalan/save`, {
          no_rawat: noRawat,
          kd_dokter: kdDokter,
          tgl_peresepan: tglPeresepan,
          jam_peresepan: jamPeresepan,
          resep
        }, function (res) {
          if (res.status === 'success') {
            const afterMsg = combined > BUDGET_LIMIT
              ? 'Resep berhasil disimpan. ⚠️ (Over Budget BPJS)'
              : 'Resep berhasil disimpan.';
            Swal.fire({ icon: 'success', title: 'Sukses', text: afterMsg, timer: 3000, showConfirmButton: false });

            inputCache = {};
            $('#searchObat').val('');
            loadObat();
            loadHasilResep();
            loadRiwayatResepPasien();
          }
        }, 'json');
      };

      if (combined > BUDGET_LIMIT) {
        const selisih = combined - BUDGET_LIMIT;
        Swal.fire({
          icon: 'warning',
          title: 'Over Budget BPJS',
          html: `Total resep sementara <b>${formatRupiah(combined)}</b> melebihi limit <b>${formatRupiah(BUDGET_LIMIT)}</b> sebesar <b>${formatRupiah(selisih)}</b>.<br>Ingin tetap menyimpan?`,
          showCancelButton: true,
          confirmButtonText: 'Tetap Simpan',
          cancelButtonText: 'Batal'
        }).then((r) => { if (r.isConfirmed) doSave(); });
      } else {
        doSave();
      }
    }
  });

  $('#searchObat').on('input', function () {
    loadObat($(this).val());
  });

  // Load awal
  loadObat();
  loadHasilResep();
  loadRiwayatResepPasien();
});

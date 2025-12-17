$(document).ready(function () {
  const BASE_URL = `${window.location.origin}/${window.location.pathname.split('/')[1]}/`;
  const apiUrl = `${BASE_URL}permintaanResepRacikanRalanController`;
  const noRawat = $('#no_rawat').val();
  const kdDokter = $('#kd_dokter').val();
  const noRkmMedis = $('#no_rkm_medis').val();
  let inputCache = {};
  let obatListCache = [];
  let metodeRacikList = [];
  let showAllRiwayat = false;

  setTanggalJamPeresepan();
  setupAutocompleteSigna();
  setupAutocompleteMetodeRacik();
  loadHasilRacikan();
  loadRiwayatRacikanPasien();

  // Muat daftar obat ke cache
  $.getJSON(`${apiUrl}/getObatList`, function (res) {
    if (res.status === 'success') obatListCache = res.data;
  });

  $.post(`${apiUrl}/getMetodeRacik`, { term: '' }, function (data) {
    metodeRacikList = data;
  }, 'json');

  $('#searchObat').on('input', renderSelectedObat);

  function renderSelectedObat() {
    const keyword = $('#searchObat').val().trim().toLowerCase();
    let filtered = keyword.length >= 2
      ? obatListCache.filter(item => item.nama_brng.toLowerCase().includes(keyword))
      : obatListCache.filter(item => Object.keys(inputCache).includes(item.kode_brng));
    renderObatTable(filtered);
  }

  function renderObatTable(data) {
    let html = '';
    data.forEach((obat, i) => {
      const jumlah = inputCache[obat.kode_brng]?.jumlah || '';
      const kandungan = inputCache[obat.kode_brng]?.kandungan || '';
      const bg = jumlah ? 'bg-success-subtle' : '';
      html += `<tr class="${bg}">
        <td>${i + 1}</td>
        <td><input type="hidden" name="kode_obat[]" value="${obat.kode_brng}">${obat.kode_brng}</td>
        <td>${obat.nama_brng}</td>
        <td>${obat.stok}</td>
        <td>${obat.satuan}</td>
        <td class="kapasitas">${obat.kapasitas}</td>
        <td><input type="number" class="form-control kandungan" data-kode="${obat.kode_brng}" min="0" value="${kandungan}"></td>
        <td><input type="number" class="form-control jumlah-obat" data-kode="${obat.kode_brng}" data-stok="${obat.stok}" min="0" value="${jumlah}"></td>
      </tr>`;
    });
    $('#racikanObatBody').html(html);
  }

  $(document).on('input', '.kandungan', function () {
    const kode = $(this).data('kode');
    const kandungan = parseFloat($(this).val()) || 0;
    const jumlahRacikan = parseFloat($('#jumlahRacikan').val()) || 1;
    const kapasitas = parseFloat($(this).closest('tr').find('.kapasitas').text()) || 1;
    const jumlah = kapasitas > 0 ? Math.ceil((kandungan * jumlahRacikan) / kapasitas) : 0;
    $(this).closest('tr').find('.jumlah-obat').val(jumlah).trigger('input');
  });

  // Validasi stok saat input jumlah obat
  $(document).on('input', '.jumlah-obat', function () {
    const kode = $(this).data('kode');
    const jumlah = parseFloat($(this).val()) || 0;
    const kandungan = parseFloat($(`.kandungan[data-kode="${kode}"]`).val()) || 0;
    const stok = parseFloat($(this).data('stok')) || 0;
    if (jumlah > stok) {
      Swal.fire('Stok Tidak Cukup', `Stok obat ${kode} tidak mencukupi.`, 'warning');
      $(this).val(0);
      delete inputCache[kode];
    } else {
      if (jumlah > 0) inputCache[kode] = { jumlah, kandungan };
      else delete inputCache[kode];
    }
  });

  $('#saveRacikan').on('click', function (e) {
    e.preventDefault();
    setTanggalJamPeresepan();

    const formData = {
      no_rawat: noRawat,
      kd_dokter: kdDokter,
      tgl_peresepan: $('#tgl_peresepan').val(),
      jam_peresepan: $('#jam_peresepan').val(),
      nama_racikan: $('#namaRacikan').val(),
      kd_racik: $('#kdRacik').val(),
      jumlah_racikan: $('#jumlahRacikan').val(),
      signa: $('#signa').val(),
      keterangan: $('#keterangan').val(),
      obat: []
    };

    Object.entries(inputCache).forEach(([kode_obat, val]) => {
      if (val.jumlah > 0) {
        formData.obat.push({
          kode_obat,
          kandungan: val.kandungan.toString(),
          jumlah: val.jumlah.toString()
        });
      }
    });

    if (formData.kd_racik.trim() === '') {
      return Swal.fire('Error', 'Kode racikan tidak boleh kosong.', 'error');
    }

    if (formData.obat.length === 0) {
      return Swal.fire({
        icon: 'error',
        title: 'Data Tidak Lengkap',
        text: 'Tambahkan setidaknya satu obat.',
        timer: 3000,
        showConfirmButton: false
      });
    }

    Swal.fire({
      title: 'Menyimpan data...',
      html: 'Mohon tunggu sebentar',
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    $.ajax({
      url: `${apiUrl}/simpanRacikan`,
      method: 'POST',
      data: JSON.stringify(formData),
      contentType: 'application/json',
      success: function (response) {
        if (typeof response === 'string') response = JSON.parse(response);
        if (response.status === 'success') {
          Swal.close();
          setTimeout(() => {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: response.message,
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              resetForm();
              loadHasilRacikan();        
              loadRiwayatRacikanPasien();
            });
          }, 300);
        } else {
          Swal.close();
          Swal.fire('Gagal', response.message || 'Terjadi kesalahan saat menyimpan.', 'error');
        }
      },
      error: function (xhr, status, error) {
        Swal.close();
        Swal.fire('Gagal', `Error: ${error}`, 'error');
      }
    });
  });


  $(document).on('click', '.btn-copy-racikan', function () {
    const noResep = $(this).data('no_resep');
    const items = $(`.riwayat-item[data-no_resep='${noResep}']`).map(function () {
      const raw = $(this).attr('data-json');
      return typeof raw === 'string' ? JSON.parse(raw) : raw;
    }).get();
    if (!items.length) return Swal.fire('Peringatan', 'Data tidak ditemukan.', 'warning');
    const first = items[0];
    $('#namaRacikan').val(first.nama_racik);
    $('#signa').val(first.aturan_pakai);
    $('#metodeRacik').val(first.nm_racik);
    $('#jumlahRacikan').val(first.jml_dr || '');
    $('#keterangan').val(first.keterangan || '');
    const match = metodeRacikList.find(m => m.nm_racik === first.nm_racik);
    $('#kdRacik').val(match ? match.kd_racik : '');
    inputCache = {};
    items.forEach(item => {
      inputCache[item.kode_brng] = {
        jumlah: parseFloat(item.jml),
        kandungan: parseFloat(item.kandungan) || 1
      };
    });
    $('#searchObat').val('').trigger('input');
    Swal.fire('Berhasil', 'Racikan berhasil disalin.', 'success');
  });

  // Set tanggal & jam otomatis
  function setTanggalJamPeresepan() {
    const now = new Date();
    $('#tgl_peresepan').val(now.toISOString().split('T')[0]);
    $('#jam_peresepan').val(now.toTimeString().split(' ')[0]);
  }

  // Setup autocomplete untuk Signa
  function setupAutocompleteSigna() {
    $('#signa').autocomplete({
      source: function (req, res) {
        $.post(`${apiUrl}/getSignaObat`, { term: req.term }, data => res(data.map(item => item.aturan)), 'json');
      },
      minLength: 1,
      select: function (e, ui) {
        $('#signa').val(ui.item.value);
        return false;
      }
    });
  }

  function setupAutocompleteMetodeRacik() {
    $('#metodeRacik').autocomplete({
      source: function (req, res) {
        $.post(`${apiUrl}/getMetodeRacik`, { term: req.term }, data => {
          res(data.map(item => ({ label: item.nm_racik, value: item.kd_racik })));
        }, 'json');
      },
      minLength: 1,
      select: function (e, ui) {
        $('#metodeRacik').val(ui.item.label);
        $('#kdRacik').val(ui.item.value);
        return false;
      }
    });
  }

  function resetForm() {
    $('#namaRacikan').val('');
    $('#metodeRacik').val('');
    $('#kdRacik').val('');
    $('#jumlahRacikan').val('');
    $('#signa').val('');
    $('#keterangan').val('');
    inputCache = {};
    $('#searchObat').val('').trigger('input');
  }

  function loadHasilRacikan() {
    $('#hasilRacikanTableBody').html('');
    $.ajax({
      url: `${apiUrl}/loadHasilRacikan?no_rawat=${noRawat}&_=${Date.now()}`,
      method: 'GET',
      cache: false,
      dataType: 'json',
      success: function (res) {
        let html = '';
        if (res.status !== 'success' || !res.data) {
          html = '<tr><td colspan="7" class="text-center text-muted">Belum ada data racikan</td></tr>';
        } else {
          let num = 1;
          for (const resep in res.data) {
            const r = res.data[resep];

            // ✅ Cek apakah resep sudah tervalidasi
            const sudahTervalidasi = !(r.tgl_perawatan === "0000-00-00" && r.jam === "00:00:00");

            html += `<tr class="bg-light">
              <td>${num++}</td>
              <td colspan="6">
                <div class="d-flex justify-content-between">
                  <div>
                    <strong>Resep: ${resep}</strong> - ${r.nama_racik} (${r.nm_racik})<br/>
                    Signa: ${r.aturan_pakai}, Jumlah: ${r.jml_dr}
                  </div>
                  <div>
                    ${!sudahTervalidasi ? 
                      `<button class="btn btn-danger btn-sm hapusResep" data-no_resep="${resep}"><i class="fa fa-trash"></i> Hapus</button>` : 
                      `<span class="badge badge-success">✅ Tervalidasi</span>`}
                  </div>
                </div>
              </td>
            </tr>`;

            r.obat.forEach((o, i) => {
              html += `<tr>
                <td>${i + 1}</td>
                <td>${o.kode_brng}</td>
                <td colspan="2">${o.nama_brng}</td>
                <td>${o.jml}</td>
                <td colspan="2">-</td>
              </tr>`;
            });
          }
        }
        $('#hasilRacikanTableBody').html(html);
      }
    });
  }

  function loadRiwayatRacikanPasien() {
    const container = $('#containerRiwayatRacikan');
    container.html('');
    $.ajax({
      url: `${apiUrl}/getRiwayatObatByNorm?no_rkm_medis=${noRkmMedis}&_=${Date.now()}`,
      method: 'GET',
      cache: false,
      dataType: 'json',
      success: function (res) {
        if (res.status !== 'success' || !res.data.length) {
          return container.html('<div class="alert alert-warning text-center">Tidak ada riwayat racikan ditemukan</div>');
        }
        const grouped = {};
        res.data.forEach(item => {
          grouped[item.no_resep] = grouped[item.no_resep] || [];
          grouped[item.no_resep].push(item);
        });
        const entries = Object.entries(grouped);
        const showData = showAllRiwayat ? entries : entries.slice(0, 5);
        let html = '';
        let index = 1;
        for (const [noResep, items] of showData) {
          const r = items[0];
          html += `<table class="table table-bordered table-sm mb-3">
            <thead class="table-light">
              <tr>
                <th colspan="7">
                  ${index++}. Resep: ${noResep} - ${r.nama_racik} (${r.nm_racik})
                  <button class="btn btn-sm btn-outline-primary float-right btn-copy-racikan" data-no_resep="${noResep}"><i class="fa fa-copy"></i> Copy Racikan Ini</button>
                </th>
              </tr>
              <tr><th>#</th><th>Kode</th><th>Nama Obat</th><th>Jumlah</th><th>Signa</th><th>Metode</th><th>Keterangan</th></tr>
            </thead><tbody>`;
          items.forEach((item, i) => {
            const json = JSON.stringify(item).replace(/"/g, '&quot;');
            html += `<tr>
              <td>${i + 1}</td>
              <td>${item.kode_brng}</td>
              <td>${item.nama_brng}</td>
              <td>${item.jml}</td>
              <td>${item.aturan_pakai}</td>
              <td>${item.nm_racik}</td>
              <td>${item.keterangan}</td>
              <td style="display:none;"><input type="hidden" class="riwayat-item" data-no_resep="${noResep}" data-json="${json}"></td>
            </tr>`;
          });
          html += '</tbody></table>';
        }
        if (entries.length > 5) {
          html += `<div class="text-center mb-3">
            <button class="btn btn-secondary btn-sm" id="toggleRiwayat">
              ${showAllRiwayat ? 'Sembunyikan' : 'Tampilkan Semua'} Riwayat
            </button>
          </div>`;
        }
        container.html(html);
      }
    });
  }

  $(document).on('click', '#toggleRiwayat', function () {
    showAllRiwayat = !showAllRiwayat;
    loadRiwayatRacikanPasien();
  });

  $(document).on('click', '.hapusResep', function () {
    const noResep = $(this).data('no_resep');
    Swal.fire({
      title: 'Yakin?',
      text: 'Hapus semua racikan pada resep ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus!'
    }).then(result => {
      if (result.isConfirmed) {
        $.ajax({
          url: `${apiUrl}/hapusResep`,
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({ no_resep: noResep }),
          success: function (res) {
            if (res.status === 'success') {
              loadHasilRacikan();
              loadRiwayatRacikanPasien();
              Swal.fire('Terhapus', res.message, 'success');
            }
          }
        });
      }
    });
  });
});
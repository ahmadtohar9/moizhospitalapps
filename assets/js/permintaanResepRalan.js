// public/assets/js/resepRalan.js

$(document).ready(function () {
  console.log("🚀 resepRalan.js Loaded!");

  const BASE_URL = window.location.origin + "/";
  const noRawat = $('#no_rawat').val();
  const noRkmMedis = $('#no_rkm_medis').val();
  const kdDokter = $('#kd_dokter').val();
  const tglPeresepan = $('#tgl_peresepan').val();
  const jamPeresepan = $('#jam_peresepan').val();

  console.log('View Loaded | no_rkm_medis =', noRkmMedis, ', no_rawat =', noRawat);

  function formatRupiah(value) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR'
    }).format(value || 0);
  }

  function loadObat() {
    $.getJSON(`${BASE_URL}permintaanResepRalan/getObatList`, function (res) {
      let html = '';
      if (res.status === 'success') {
        res.data.forEach((obat, i) => {
          html += `<tr>
            <td>${i + 1}</td>
            <td>${obat.kode_brng}</td>
            <td>${obat.nama_brng}</td>
            <td>${formatRupiah(obat.harga)}</td>
            <td>${obat.stok}</td>
            <td>${obat.satuan}</td>
            <td><input type="number" class="form-control jumlah-obat" data-kode="${obat.kode_brng}" value="0"></td>
            <td><input type="text" class="form-control signa-obat" data-kode="${obat.kode_brng}" placeholder="Signa"></td>
          </tr>`;
        });
      } else {
        html = '<tr><td colspan="8" class="text-center">Tidak ada data obat</td></tr>';
      }
      $('#obatBody').html(html);
    });
  }

  function loadHasilResep() {
    $.getJSON(`${BASE_URL}permintaanResepRalan/getHasilResep?no_rawat=${noRawat}`, function (res) {
      let html = '';
      let total = 0;
      if (res.status === 'success') {
        res.data.forEach((r, i) => {
          total += parseFloat(r.total);
          html += `<tr>
            <td>${i + 1}</td>
            <td>${r.no_resep}</td>
            <td>${r.nama_brng}</td>
            <td>${r.jumlah}</td>
            <td>${formatRupiah(r.total)}</td>
            <td>${r.signa}</td>
            <td><button class="btn btn-sm btn-danger delete-resep" data-kode="${r.kode_brng}" data-jumlah="${r.jumlah}">Hapus</button></td>
          </tr>`;
        });
      } else {
        html = '<tr><td colspan="7" class="text-center">Belum ada resep</td></tr>';
      }
      $('#hasilResepBody').html(html);
      $('#totalHargaObat').text(formatRupiah(total));
    });
  }

  window.loadRiwayatResepPasien = function () {
    const container = $('#containerRiwayatResep');
    container.html('<p class="text-center">Memuat riwayat resep...</p>');

    if (!noRkmMedis) {
      container.html('<div class="alert alert-warning text-center">Nomor RM tidak tersedia.</div>');
      return;
    }

    console.log("📦 Mengambil data riwayat resep untuk:", noRkmMedis);

    $.getJSON(`${BASE_URL}permintaanResepRalan/getRiwayatObatByNorm?no_rkm_medis=${noRkmMedis}`, function (res) {
      console.log("🧪 Response Riwayat Resep:", res);

      if (res.status !== 'success' || !Array.isArray(res.data) || res.data.length === 0) {
        return container.html('<div class="alert alert-warning text-center">Tidak ada riwayat resep ditemukan</div>');
      }

      const grouped = {};
      res.data.forEach(item => {
        if (!item.no_resep) return;
        if (!grouped[item.no_resep]) grouped[item.no_resep] = [];
        grouped[item.no_resep].push(item);
      });

      let html = '';
      let index = 1;
      for (const [noResep, items] of Object.entries(grouped)) {
        const info = items[0];
        html += `
          <table class="table table-bordered table-sm mb-4">
            <thead class="bg-light">
              <tr>
                <th colspan="6">
                  <strong>${index++}. No. Resep:</strong> ${info.no_resep}<br>
                  <strong>Tanggal:</strong> ${info.tgl_perawatan === '0000-00-00' ? '-' : info.tgl_perawatan}<br>
                  <strong>Jam:</strong> ${info.jam === '00:00:00' ? '-' : info.jam}
                  <span class="float-right">
                    <input type="checkbox" class="check-group" data-group="${noResep}"> Pilih Semua
                  </span>
                </th>
              </tr>
              <tr>
                <th>#</th>
                <th></th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Signa</th>
              </tr>
            </thead>
            <tbody>
        `;

        items.forEach((item, i) => {
          const json = JSON.stringify(item).replace(/"/g, '&quot;');
          html += `
            <tr>
              <td>${i + 1}</td>
              <td><input type="checkbox" class="checkbox-copy-obat" data-json="${json}" data-group="${noResep}"></td>
              <td>${item.nama_brng}</td>
              <td>${item.jml}</td>
              <td>${formatRupiah(item.total_bayar)}</td>
              <td>${item.aturan_pakai}</td>
            </tr>
          `;
        });

        html += '</tbody></table>';
      }

      container.html(html);
    });
  }

  $('#saveResep').on('click', function () {
    const resep = [];
    $('#obatBody tr').each(function () {
      const kode = $(this).find('.jumlah-obat').data('kode');
      const jumlah = $(this).find('.jumlah-obat').val();
      const signa = $(this).find('.signa-obat').val();
      if (jumlah > 0 && kode) resep.push({ kode_brng: kode, jumlah, signa });
    });

    if (!resep.length) return Swal.fire('Peringatan', 'Pilih dan isi jumlah obat.', 'warning');

    $.post(`${BASE_URL}permintaanResepRalan/save`, {
      no_rawat: noRawat,
      kd_dokter: kdDokter,
      tgl_peresepan: tglPeresepan,
      jam_peresepan: jamPeresepan,
      resep: resep
    }, function (res) {
      if (res.status === 'success') {
        Swal.fire('Berhasil', 'Resep berhasil disimpan.', 'success');
        loadHasilResep();
        window.loadRiwayatResepPasien();
      } else {
        Swal.fire('Gagal', res.message || 'Gagal menyimpan.', 'error');
      }
    }, 'json');
  });

  $(document).on('change', '.check-group', function () {
    const group = $(this).data('group');
    $(`.checkbox-copy-obat[data-group='${group}']`).prop('checked', this.checked);
  });

  $('#btnCopyResepSelected').on('click', function () {
    const selected = [];
    $('.checkbox-copy-obat:checked').each(function () {
      selected.push(JSON.parse($(this).data('json')));
    });

    if (!selected.length) return Swal.fire('Perhatian', 'Tidak ada yang dipilih.', 'warning');

    selected.forEach(item => {
      const row = $(`#obatBody input[data-kode='${item.kode_brng}']`);
      if (row.length) {
        row.val(item.jml);
        row.closest('tr').find('.signa-obat').val(item.aturan_pakai);
      }
    });

    Swal.fire('Tersalin', 'Data berhasil disalin ke form.', 'success');
  });

  $('#searchObat').on('input', function () {
    const keyword = $(this).val().toLowerCase();
    $('#obatBody tr').each(function () {
      $(this).toggle($(this).text().toLowerCase().includes(keyword));
    });
  });

  loadObat();
  loadHasilResep();
  window.loadRiwayatResepPasien();
});
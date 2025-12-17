$(document).ready(function () {
  const API = {
    getJenis: BASE_URL + 'permintaan-lab-ralan/get-jenis',
    getTemplate: BASE_URL + 'permintaan-lab-ralan/get-template-by-jenis/',
    save: BASE_URL + 'permintaan-lab-ralan/save',
    getRiwayat: BASE_URL + 'permintaan-lab-ralan/get-riwayat-grouped',
    delete: BASE_URL + 'permintaan-lab-ralan/delete'
  };

  let riwayatLabData = {};

  const no_rawat = $('#no_rawat').val();
  const kd_dokter = $('#kd_dokter').val();
  const no_rkm_medis = $('#no_rkm_medis').val();
  const pasien = {
    usia: parseInt($('#umurdaftar').val()),
    jk: $('#jk').val()
  };

  $('#informasi_tambahan, #diagnosa_klinis').on('input', function () {
    $(this).val($(this).val().toUpperCase());
  });

  // Load jenis pemeriksaan
  $.getJSON(API.getJenis, function (res) {
    res.forEach((item, index) => {
      $('#panelPemeriksaan').append(`
        <tr>
          <td>${index + 1}</td>
          <td><input class="form-check-input panel-checkbox" type="checkbox" value="${item.kd_jenis_prw}" id="panel_${item.kd_jenis_prw}"></td>
          <td><label for="panel_${item.kd_jenis_prw}" class="form-check-label">${item.nm_perawatan}</label></td>
        </tr>`);
    });
  });

  $('#searchPemeriksaan').on('keyup', function () {
    const keyword = $(this).val().toLowerCase();
    $('#panelPemeriksaan tr').each(function () {
      const text = $(this).text().toLowerCase();
      $(this).toggle(text.includes(keyword));
    });
  });

  $(document).on('change', '.panel-checkbox', function () {
    const kd_jenis_prw = $(this).val();
    const isChecked = $(this).is(':checked');
    const containerId = `template_${kd_jenis_prw}`;

    if (isChecked) {
      if ($(`#${containerId}`).length > 0) return;

      $.getJSON(API.getTemplate + kd_jenis_prw, function (res) {
        if (res.length === 0) return;

        const nm_perawatan = res[0]?.nm_perawatan || 'Pemeriksaan';

        let html = `<div class="card mb-3" id="${containerId}">
          <div class="card-header d-flex justify-content-between align-items-center">
            <b>${nm_perawatan}</b>
            <label class="mb-0"><input type="checkbox" class="check-all-template" data-panel="${kd_jenis_prw}"> Pilih Semua</label>
          </div>
          <div class="card-body template-panel-scroll p-0">
            <table class="table table-sm table-bordered mb-0">
              <thead><tr><th>#</th><th>Pemeriksaan</th><th>Satuan</th><th>Nilai Rujukan</th></tr></thead><tbody>`;

        res.forEach((item, index) => {
          let rujukan = '-';
          if (pasien.usia < 14) {
            rujukan = pasien.jk === 'L' ? item.nilai_la : item.nilai_pa;
          } else {
            rujukan = pasien.jk === 'L' ? item.nilai_ld : item.nilai_pd;
          }

          html += `<tr>
            <td><input type="checkbox" class="template-item" data-panel="${kd_jenis_prw}" value="${item.id_template}"></td>
            <td>${item.pemeriksaan}</td>
            <td>${item.satuan}</td>
            <td>${rujukan}</td>
          </tr>`;
        });

        html += '</tbody></table></div></div>';
        $('#containerSemuaTemplate').append(html);
        $('#wrapperTemplateLab').show();
      });
    } else {
      $(`#${containerId}`).remove();
      if ($('#containerSemuaTemplate').children().length === 0) {
        $('#wrapperTemplateLab').hide();
      }
    }
  });

  $('#btnCloseTemplate').on('click', function () {
    $('#containerSemuaTemplate').html('');
    $('#wrapperTemplateLab').hide();
    $('.panel-checkbox').prop('checked', false);
  });

  $(document).on('change', '.check-all-template', function () {
    const panel = $(this).data('panel');
    $(`#template_${panel} .template-item`).prop('checked', $(this).is(':checked'));
  });

  $('#btnSimpanPermintaan').on('click', function () {
    const dataPemeriksaan = {};
    $('.template-item:checked').each(function () {
      const panel = $(this).data('panel');
      if (!dataPemeriksaan[panel]) dataPemeriksaan[panel] = [];
      dataPemeriksaan[panel].push($(this).val());
    });

    const informasiTambahan = $('#informasi_tambahan').val().trim();
    const diagnosaKlinis = $('#diagnosa_klinis').val().trim();

    const payload = {
      no_rawat, kd_dokter,
      informasi_tambahan: informasiTambahan,
      diagnosa_klinis: diagnosaKlinis,
      pemeriksaan: []
    };

    for (const panel in dataPemeriksaan) {
      payload.pemeriksaan.push({
        kd_jenis_prw: panel,
        template: dataPemeriksaan[panel]
      });
    }

    if (payload.pemeriksaan.length === 0 || !informasiTambahan || !diagnosaKlinis) {
      Swal.fire({ icon: 'warning', title: 'Lengkapi Data', text: 'Isi data dan pilih pemeriksaan!', timer: 3000 });
      return;
    }

    $.ajax({
      url: API.save,
      method: 'POST',
      data: JSON.stringify(payload),
      contentType: 'application/json',
      success: function (res) {
        const parsed = typeof res === 'string' ? JSON.parse(res) : res;
        if (parsed.status) {
          Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Permintaan berhasil disimpan.', timer: 2500 });
          $('#containerSemuaTemplate').html('');
          $('.panel-checkbox').prop('checked', false);
          $('#informasi_tambahan, #diagnosa_klinis').val('');
          $('#wrapperTemplateLab').hide();
          loadRiwayatLab();
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: parsed.message || 'Gagal menyimpan!' });
        }
      }
    });
  });

  // Riwayat + tombol Copy, View, Delete
  function loadRiwayatLab(limit = 5) {
    const container = $('#containerRiwayatLab');
    container.html('<p class="text-muted">Memuat...</p>');

    $.getJSON(`${API.getRiwayat}?no_rkm_medis=${no_rkm_medis}&limit=${limit}`, function (data) {
      riwayatLabData = data;
      if (!data || Object.keys(data).length === 0) {
        container.html('<p class="text-muted">Tidak ada riwayat permintaan laboratorium.</p>');
        return;
      }

      let html = '';
      Object.entries(data).forEach(([noorder, item], idx) => {
        let rows = '';
        let noPanel = 1;

        for (const panel in item.template_detail) {
          const detailList = item.template_detail[panel];

          rows += `<tr class="table-light"><td colspan="3"><b>${noPanel++}. ${panel.toUpperCase()}</b></td></tr>`;

          detailList.forEach((detail, i) => {
            rows += `<tr>
                      <td>${i + 1}</td>
                      <td></td>
                      <td>${detail.pemeriksaan}</td>
                    </tr>`;
          });
        }

        html += `
          <div class="card mb-3 border-left-danger shadow-sm">
            <div class="card-header">
              <b>#${idx + 1}</b> — <b>No Rawat:</b> ${item.no_rawat || '-'} — <b>No Order:</b> ${noorder}
            </div>
            <div class="card-body p-2">
              <div class="mb-2"><b>Dokter:</b> ${item.nm_dokter}</div>
              <div class="mb-2"><b>Poli:</b> ${item.nm_poli}</div>
              <div class="mb-2"><b>Diagnosa Klinis:</b> ${item.diagnosa_klinis}</div>
              <div class="mb-3"><b>Informasi Tambahan:</b> ${item.informasi_tambahan}</div>

              <div class="table-responsive">
                <table class="table table-sm table-bordered mb-3">
                  <thead>
                    <tr><th style="width:40px">#</th><th>Panel</th><th>Pemeriksaan</th></tr>
                  </thead>
                  <tbody>${rows}</tbody>
                </table>
              </div>

              <div class="text-end">
                <button class="btn btn-success btn-sm me-2" onclick="copyPermintaan('${noorder}')">Copy</button>
                <button class="btn btn-primary btn-sm me-2" onclick="viewPermintaan('${noorder}')">View</button>
                <button class="btn btn-danger btn-sm" onclick="deletePermintaan('${noorder}')">Delete</button>
              </div>
            </div>
          </div>`;
      });

      container.html(html);
    });
  }


  window.copyPermintaan = function (noorder) {
    Swal.fire('Coming Soon!', 'Fitur salin permintaan ini sedang dikembangkan.', 'info');
  };

  window.viewPermintaan = function (noorder) {
    const item = riwayatLabData[noorder];
    if (!item) {
      Swal.fire('Data tidak ditemukan', 'Permintaan tidak tersedia untuk nomor tersebut.', 'error');
      return;
    }

    let pemeriksaanHtml = '';
    let no = 1;
    for (const jenis in item.template_detail) {
      pemeriksaanHtml += `<tr class="table-light"><td colspan="4"><b>${jenis}</b></td></tr>`;
      item.template_detail[jenis].forEach(detail => {
        pemeriksaanHtml += `
          <tr>
            <td>${no++}</td>
            <td>${detail.pemeriksaan}</td>
            <td>${detail.satuan || '-'}</td>
            <td>${detail.nilai_rujukan || '-'}</td>
          </tr>`;
      });
    }

    const htmlContent = `
      <div style="max-height: 75vh; overflow-y: auto; font-size: 0.95rem;">
        <table class="table table-sm mb-3">
          <tr><th style="width:200px">No Rawat</th><td>${item.no_rawat || '-'}</td></tr>
          <tr><th>No Order</th><td>${noorder}</td></tr>
          <tr><th>Dokter</th><td>${item.nm_dokter}</td></tr>
          <tr><th>Poli</th><td>${item.nm_poli}</td></tr>
          <tr><th>Asuransi</th><td>${item.nm_penjab || '-'}</td></tr>
          <tr><th>Diagnosa Klinis</th><td>${item.diagnosa_klinis}</td></tr>
          <tr><th>Informasi Tambahan</th><td>${item.informasi_tambahan}</td></tr>
        </table>

        <b class="d-block mt-4 mb-2">Detail Pemeriksaan:</b>
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead class="table-secondary">
              <tr><th style="width:40px">#</th><th>Pemeriksaan</th><th>Satuan</th><th>Nilai Rujukan</th></tr>
            </thead>
            <tbody>${pemeriksaanHtml}</tbody>
          </table>
        </div>
      </div>`;

    Swal.fire({
      title: '<strong>Detail Permintaan Laboratorium</strong>',
      html: htmlContent,
      width: '80vw',
      confirmButtonText: 'Tutup',
      showCloseButton: true,
      customClass: {
        htmlContainer: 'text-start'
      }
    });
  };




  window.deletePermintaan = function (noorder) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
    }).then(result => {
      if (result.isConfirmed) {
        $.post(API.delete, { noorder }, function (res) {
          if (res.status) {
            Swal.fire('Berhasil!', 'Data berhasil dihapus.', 'success');
            loadRiwayatLab();
          } else {
            Swal.fire('Gagal!', 'Tidak dapat menghapus data.', 'error');
          }
        }, 'json');
      }
    });
  };

  loadRiwayatLab();
});

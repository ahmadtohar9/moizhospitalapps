/* assets/js/perawat/soap_perawat.js (FINAL COMPLETE) */
(function ($, window, document) {
  'use strict';

  /* =========================
   * Endpoint namespace
   * ========================= */
  var API = (window.API && window.API.soapPerawat) ? window.API.soapPerawat : (window.API_URLS || {});
  if (!API || !API.getHasil) {
    console.error('❌ Endpoint SOAP Perawat tidak terdefinisi. Pastikan window.API.soapPerawat ada di view.');
  }

  /* =========================
   * CSRF Helpers (CI3)
   * ========================= */
  var csrf = { name: null, token: null };
  function updateCsrf(res) {
    if (res && res.csrfName && res.csrfToken) {
      csrf.name  = res.csrfName;
      csrf.token = res.csrfToken;
    }
  }
  function addCsrf(data) {
    if (!data) data = {};
    if (csrf.name && csrf.token) data[csrf.name] = csrf.token;
    return data;
  }
  $.ajaxSetup({
    beforeSend: function (xhr, settings) {
      if (settings.type && settings.type.toUpperCase() === 'POST') {
        if (typeof settings.data === 'string') {
          var extra = csrf.name && csrf.token ? ('&' + encodeURIComponent(csrf.name) + '=' + encodeURIComponent(csrf.token)) : '';
          settings.data += extra;
        } else if ($.isPlainObject(settings.data)) {
          settings.data = addCsrf(settings.data);
        }
      }
    }
  });

  /* =========================
   * Utils
   * ========================= */
  function tryParseJSON(raw) {
    if (raw == null) return null;
    if (typeof raw !== 'string') return raw;
    var s = raw.trim();
    if (!s || (s[0] !== '{' && s[0] !== '[')) return null;
    try { return JSON.parse(s); } catch { return null; }
  }
  function handleJSONorError(raw, onOk, ctx) {
    var json = tryParseJSON(raw);
    if (json) { updateCsrf(json); onOk(json); return; }
    console.error('❌ Expected JSON in ' + ctx + '. First 200 chars:',
      (typeof raw === 'string' ? raw.slice(0, 200) : raw));
    if (window.Swal) Swal.fire({ icon: 'error', title: 'Gagal memuat', text: 'Respon bukan JSON valid ('+ctx+').' });
  }
  function pad2(n) { return String(n).padStart(2, '0'); }
  function updateDateTimeInputs($tgl, $jam) {
    var now = new Date();
    $tgl.val(now.getFullYear() + '-' + pad2(now.getMonth()+1) + '-' + pad2(now.getDate()));
    $jam.val(pad2(now.getHours()) + ':' + pad2(now.getMinutes()) + ':' + pad2(now.getSeconds()));
  }

  /* =========================
   * Renderer - IMPROVED untuk field lengkap
   * ========================= */
  function renderHasilRow(d, index) {
    const details = [
      { label: 'Kesadaran',  value: d.kesadaran || '-' },
      { label: 'Alergi',     value: d.alergi || '-' },
      ...(d.lingkar_perut ? [{ label: 'Lingkar Perut', value: d.lingkar_perut + ' cm' }] : []),
      { label: 'Subjektif',  value: d.keluhan || '-' },
      { label: 'Objektif',   value: d.pemeriksaan || '-' },
      { label: 'Asesmen',    value: d.penilaian || '-' },
      { label: 'Plan',       value: d.rtl || '-' }
    ];
    const rightRowspan = 1 + details.length + 1;
    const qrHtml = d.qr_url ? `<div class="my-2"><img src="${d.qr_url}" alt="QR" style="width:100px;height:100px;"></div>` : '';

    let html = `
      <tr class="align-top">
        <td class="text-center align-top">${index + 1}</td>
        <td class="align-top" style="min-width:220px">
          <div><i class="fa fa-calendar"></i> ${d.tgl_perawatan || '-'}</div>
          <div class="text-muted"><i class="fa fa-clock-o"></i> ${d.jam_rawat || '-'}</div>
          <div class="text-muted">${d.nm_petugas || '-'}</div>
        </td>
        <td class="text-center">${d.suhu_tubuh || '-'}</td>
        <td class="text-center">${d.tensi || '-'}</td>
        <td class="text-center">${d.nadi || '-'}</td>
        <td class="text-center">${d.respirasi || '-'}</td>
        <td class="text-center">${d.tinggi || '-'}</td>
        <td class="text-center">${d.berat || '-'}</td>
        <td class="text-center">${d.gcs || '-'}</td>
        <td class="text-center">${d.spo2 || '-'}</td>
        <td class="text-center">${d.alergi || '-'}</td>
        <td class="align-top" rowspan="${rightRowspan}" style="min-width:260px">
          <div class="mb-2"><strong>Instruksi:</strong><br>${d.instruksi || '-'}</div>
          <div class="mb-2"><strong>Evaluasi:</strong><br>${d.evaluasi || '-'}</div>
          ${qrHtml}
        </td>
      </tr>`;
    details.forEach(function(row){
      html += `
        <tr>
          <td></td>
          <td class="font-weight-bold">${row.label}</td>
          <td colspan="9" class="text-left">${row.value}</td>
        </tr>`;
    });
    html += `
      <tr>
        <td colspan="2" class="pl-3">
          <button class="btn btn-secondary btn-sm copy-soap" data-soap='${JSON.stringify(d).replace(/'/g,"&apos;")}'>
            <i class="fa fa-copy"></i> Copy
          </button>
          <button class="btn btn-success btn-sm edit-soap"
            data-no_rawat="${d.no_rawat || ''}"
            data-tgl_perawatan="${d.tgl_perawatan || ''}"
            data-jam_rawat="${d.jam_rawat || ''}">
            <i class="fa fa-edit"></i> Edit
          </button>
          <button class="btn btn-danger btn-sm delete-soap"
            data-no_rawat="${d.no_rawat || ''}"
            data-tgl_perawatan="${d.tgl_perawatan || ''}"
            data-jam_rawat="${d.jam_rawat || ''}">
            <i class="fa fa-trash"></i> Hapus
          </button>
        </td>
        <td colspan="9"></td>
      </tr>`;
    return html;
  }

  function renderRiwayatRows(dataArr, showAll) {
    if (!Array.isArray(dataArr) || dataArr.length === 0) {
      return '<tr><td colspan="5" class="text-center text-muted">Tidak ada riwayat SOAP.</td></tr>';
    }
    var limit = showAll ? dataArr.length : 3;
    var rows = '';
    dataArr.slice(0, limit).forEach(function (data, index) {
      var safeSOAP = JSON.stringify(data).replace(/'/g, "&apos;");
      rows += (
        '<tr class="bg-light">' +
          '<td rowspan="2">' + (index + 1) + '</td>' +
          '<td><strong>' + (data.tgl_perawatan || '-') + '</strong></td>' +
          '<td><strong>' + (data.jam_rawat || '-') + '</strong></td>' +
          '<td><strong>' + (data.nm_petugas || '-') + '</strong></td>' +
          '<td rowspan="2" class="text-center align-middle">' +
            '<button class="btn btn-info btn-sm copy-soap" data-soap=\'' + safeSOAP + '\'>' +
              '<i class="fa fa-copy"></i> Copy' +
            '</button>' +
          '</td>' +
        '</tr>' +
        '<tr class="bg-warning-subtle">' +
          '<td colspan="3" class="text-left" style="white-space: normal;">' +
            '<div><strong>Subjektif:</strong> ' + (data.keluhan || '-') + '</div>' +
            '<div><strong>Objektif:</strong> ' + (data.pemeriksaan || '-') + '</div>' +
            '<div><strong>Asesmen:</strong> ' + (data.penilaian || '-') + '</div>' +
            '<div><strong>Plan:</strong> ' + (data.rtl || '-') + '</div>' +
          '</td>' +
        '</tr>'
      );
    });
    if (!showAll && dataArr.length > 3) {
      rows += (
        '<tr>' +
          '<td colspan="5" class="text-center">' +
            '<button id="btnShowAllRiwayat" class="btn btn-secondary btn-sm">' +
              '<i class="fa fa-eye"></i> Tampilkan Semua Riwayat' +
            '</button>' +
          '</td>' +
        '</tr>'
      );
    }
    return rows;
  }

  /* =========================
   * Main - IMPROVED dengan field lengkap
   * ========================= */
  $(document).ready(function () {
    var $form = $('#soapPerawatForm');
    var $tgl  = $('#tgl_perawatan');
    var $jam  = $('#jam_rawat');
    var $oJam = $('#original_jam_rawat');

    var noRawat = $('#no_rawat').val();
    var noRM    = $('#global_no_rkm_medis').val();
    if (!noRawat) {
      console.error('❌ No Rawat tidak ditemukan.');
      return;
    }

    var isEditMode = false;

    // Pagination state
    var hasilPage = 1, hasilSize = 50, hasilTotal = 0;
    var riwPage   = 1, riwSize   = 50, riwTotal   = 0;

    function updateDateTime() { updateDateTimeInputs($tgl, $jam); }
    function resetFormState() {
      isEditMode = false;
      $form[0].reset();
      $oJam.val('');
      var $btnSubmit = $form.find('button[type="submit"]');
      $btnSubmit.prop('disabled', false).removeClass('btn-success').addClass('btn-primary')
        .html('<i class="fa fa-save"></i> Simpan SOAP');
      updateDateTime(); // Reset ke waktu sekarang
    }

    // ---------- Load Hasil SOAP (paginated) ----------
    function renderPagingInfo($el, total, page, size) {
      var maxPage = Math.max(1, Math.ceil((total || 0) / (size || 1)));
      $el.text('Halaman ' + page + ' / ' + maxPage + ' • Total ' + (total || 0));
    }
    function bindPagingButtons(namespace, state, onPrev, onNext) {
      $(document).off('click', '#'+namespace+'Prev');
      $(document).off('click', '#'+namespace+'Next');
      $(document).on('click', '#'+namespace+'Prev', function(){ if (state.page > 1) onPrev(); });
      $(document).on('click', '#'+namespace+'Next', function(){ var max = Math.ceil(state.total/state.size)||1; if (state.page < max) onNext(); });
    }

    function loadHasilSOAP() {
      $.get(API.getHasil, { no_rawat: noRawat, page: hasilPage, size: hasilSize }, function (response) {
        handleJSONorError(response, function (res) {
          var rows = '';
          if (res.status === 'success' && Array.isArray(res.data) && res.data.length > 0) {
            hasilTotal = +res.total || 0; hasilPage = +res.page || 1; hasilSize = +res.size || 50;
            res.data.forEach(function (d, i) { rows += renderHasilRow(d, (hasilPage-1)*hasilSize + i); });
          } else {
            hasilTotal = res.total || 0;
            rows = '<tr><td colspan="12" class="text-center text-muted">Belum ada data SOAP.</td></tr>';
          }
          $('#hasil-soap-body').html(rows);

          // footer pagination
          var pgHtml =
            '<div class="d-flex justify-content-between align-items-center my-2">' +
              '<small id="hasilPagingInfo"></small>' +
              '<div>' +
                '<button class="btn btn-sm btn-outline-secondary mr-1" id="hasilPrev">&laquo; Prev</button>' +
                '<button class="btn btn-sm btn-outline-secondary" id="hasilNext">Next &raquo;</button>' +
              '</div>' +
            '</div>';
          $('#hasil-soap-footer').html(pgHtml);
          renderPagingInfo($('#hasilPagingInfo'), hasilTotal, hasilPage, hasilSize);
          bindPagingButtons('hasil', {page:hasilPage,size:hasilSize,total:hasilTotal}, function(){
            hasilPage--; loadHasilSOAP();
          }, function(){
            hasilPage++; loadHasilSOAP();
          });
        }, 'getHasil');
      }).fail(function (xhr) {
        console.error('❌ getHasil fail:', xhr);
        $('#hasil-soap-body').html('<tr><td colspan="12" class="text-center text-danger">Gagal menghubungi server.</td></tr>');
      });
    }

    // ---------- Load Riwayat by NoRM ----------
    var allRiwayatData = [];
    function loadRiwayatSOAPbyNorm() {
      if (!noRM) return;
      $.get(API.getRiwayat, { no_rkm_medis: noRM, page: riwPage, size: riwSize }, function (response) {
        handleJSONorError(response, function (res) {
          var rows = '';
          if (res.status === 'success' && Array.isArray(res.data)) {
            allRiwayatData = res.data;
            riwTotal = +res.total || 0; riwPage = +res.page || 1; riwSize = +res.size || 50;
            rows = renderRiwayatRows(allRiwayatData, false);
          } else {
            rows = '<tr><td colspan="5" class="text-center text-muted">Tidak ada riwayat SOAP.</td></tr>';
          }
          $('#soap-riwayat-body').html(rows);

          // footer pagination
          var pgHtml =
            '<div class="d-flex justify-content-between align-items-center my-2">' +
              '<small id="riwPagingInfo"></small>' +
              '<div>' +
                '<button class="btn btn-sm btn-outline-secondary mr-1" id="riwPrev">&laquo; Prev</button>' +
                '<button class="btn btn-sm btn-outline-secondary" id="riwNext">Next &raquo;</button>' +
              '</div>' +
            '</div>';
          $('#soap-riwayat-footer').html(pgHtml);
          renderPagingInfo($('#riwPagingInfo'), riwTotal, riwPage, riwSize);
          bindPagingButtons('riw', {page:riwPage,size:riwSize,total:riwTotal}, function(){
            riwPage--; loadRiwayatSOAPbyNorm();
          }, function(){
            riwPage++; loadRiwayatSOAPbyNorm();
          });
        }, 'getRiwayat');
      }).fail(function (xhr) {
        console.error('❌ getRiwayat fail:', xhr);
        $('#soap-riwayat-body').html('<tr><td colspan="5" class="text-center text-danger">Gagal menghubungi server.</td></tr>');
      });
    }

    // tombol "Tampilkan Semua"
    $(document).on('click', '#btnShowAllRiwayat', function () {
      $('#soap-riwayat-body').html(renderRiwayatRows(allRiwayatData, true));
    });

    // ---------- Auto isi TTV terakhir ----------
    function autoIsiTTVJikaAda() {
      $.get(API.lastTTV, { no_rawat: noRawat }, function (response) {
        handleJSONorError(response, function (res) {
          if (res.status === 'success' && res.data) {
            var d = res.data;
            $('#suhu_tubuh').val(d.suhu_tubuh);
            $('#tensi').val(d.tensi);
            $('#nadi').val(d.nadi);
            $('#respirasi').val(d.respirasi);
            $('#tinggi').val(d.tinggi);
            $('#berat').val(d.berat);
            $('#spo2').val(d.spo2);
            $('#gcs').val(d.gcs);
            $('#kesadaran').val(d.kesadaran);
          }
        }, 'get-last-ttv');
      }).fail(function (xhr) {
        console.error('❌ lastTTV fail:', xhr);
      });
    }

    // ---------- Submit (save/update) ----------
    $form.on('submit', function (e) {
      e.preventDefault();
      var url = isEditMode ? API.update : API.save;

      var formData = $form.serializeArray();
      if (!isEditMode) {
        formData = formData.filter(function (item) { return item.name !== 'original_jam_rawat'; });
      }

      // tambahkan CSRF jika belum otomatis
      var dataQS = $.param(formData);
      if (csrf.name && csrf.token && dataQS.indexOf(encodeURIComponent(csrf.name)+'=') === -1) {
        dataQS += '&' + encodeURIComponent(csrf.name) + '=' + encodeURIComponent(csrf.token);
      }

      var $btnSubmit = $form.find('button[type="submit"]');
      var oldHtml = $btnSubmit.html();
      $btnSubmit.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Proses...');

      $.post(url, dataQS, function (response) {
        var res = tryParseJSON(response); updateCsrf(res);
        if (res && res.status === 'success') {
          if (window.Swal) {
            Swal.fire({ 
              icon: 'success', 
              title: 'Berhasil', 
              text: res.message, 
              timer: 1800, 
              showConfirmButton: false 
            });
          }
          resetFormState(); 
          loadHasilSOAP(); 
          loadRiwayatSOAPbyNorm(); 
          autoIsiTTVJikaAda();
        } else if (res && res.status === 'conflict') {
          if (window.Swal) {
            Swal.fire({ 
              icon: 'warning', 
              title: 'Konflik Perubahan', 
              text: res.message || 'Data berubah di user lain. Muat ulang data.' 
            });
          }
          loadHasilSOAP(); // refresh list
        } else {
          var msg = (res && res.message) ? res.message : 'Gagal menyimpan.';
          if (window.Swal) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: msg });
          }
        }
      }).fail(function (xhr) {
        console.error('❌ save/update fail:', xhr);
        if (window.Swal) {
          Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server.' });
        }
      }).always(function () {
        $btnSubmit.prop('disabled', false).html(oldHtml);
      });
    });

    // ---------- Edit - IMPROVED untuk field lengkap ----------
    $(document).on('click', '.edit-soap', function () {
      isEditMode = true;
      var no_rawat      = $(this).data('no_rawat');
      var tgl_perawatan = $(this).data('tgl_perawatan');
      var jam_rawat     = $(this).data('jam_rawat');

      $.get(API.getDetail, { no_rawat: no_rawat, tgl_perawatan: tgl_perawatan, jam_rawat: jam_rawat }, function (response) {
        var res = tryParseJSON(response); updateCsrf(res);
        if (res && res.status === 'success' && res.data) {
          var d = res.data;
          // Set semua field form
          $tgl.val(d.tgl_perawatan || '');
          $jam.val(d.jam_rawat || '');
          $oJam.val(d.jam_rawat || '');

          // Tanda Vital
          $('#suhu_tubuh').val(d.suhu_tubuh);
          $('#tensi').val(d.tensi);
          $('#nadi').val(d.nadi);
          $('#respirasi').val(d.respirasi);
          $('#tinggi').val(d.tinggi);
          $('#berat').val(d.berat);
          $('#spo2').val(d.spo2);
          $('#gcs').val(d.gcs);
          $('#kesadaran').val(d.kesadaran);

          // Data SOAP lengkap
          $('#keluhan').val(d.keluhan);
          $('#pemeriksaan').val(d.pemeriksaan);
          $('#penilaian').val(d.penilaian);
          $('#rtl').val(d.rtl);
          $('#instruksi').val(d.instruksi);
          $('#evaluasi').val(d.evaluasi);
          $('#alergi').val(d.alergi);
          $('#lingkar_perut').val(d.lingkar_perut);

          // Update tombol submit
          var $btnSubmit = $form.find('button[type="submit"]');
          $btnSubmit.removeClass('btn-primary').addClass('btn-success')
                   .html('<i class="fa fa-save"></i> Update SOAP');

          // Scroll ke form
          $('html, body').animate({
            scrollTop: $form.offset().top - 100
          }, 500);

        } else {
          var msg = (res && res.message) ? res.message : 'Data tidak ditemukan.';
          if (window.Swal) {
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
          }
        }
      }).fail(function (xhr) {
        console.error('❌ getDetail fail:', xhr);
        if (window.Swal) {
          Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memuat detail.' });
        }
      });
    });

    // ---------- Delete ----------
    $(document).on('click', '.delete-soap', function () {
      var no_rawat      = $(this).data('no_rawat');
      var tgl_perawatan = $(this).data('tgl_perawatan');
      var jam_rawat     = $(this).data('jam_rawat');

      function doDelete() {
        var data = addCsrf({ no_rawat: no_rawat, tgl_perawatan: tgl_perawatan, jam_rawat: jam_rawat });
        $.post(API.delete, $.param(data), function (response) {
          var res = tryParseJSON(response); updateCsrf(res);
          if (res && res.status === 'success') {
            if (window.Swal) {
              Swal.fire({ 
                icon: 'success', 
                title: 'Berhasil', 
                text: res.message, 
                timer: 1400, 
                showConfirmButton: false 
              });
            }
            resetFormState(); 
            loadHasilSOAP(); 
            loadRiwayatSOAPbyNorm(); 
            autoIsiTTVJikaAda();
          } else {
            var msg = (res && res.message) ? res.message : 'Gagal menghapus.';
            if (window.Swal) {
              Swal.fire({ icon: 'error', title: 'Gagal', text: msg });
            }
          }
        }).fail(function (xhr) {
          console.error('❌ delete fail:', xhr);
          if (window.Swal) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server.' });
          }
        });
      }

      if (window.Swal) {
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: 'Data SOAP akan dihapus permanen',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then(function (r) { if (r.isConfirmed) doDelete(); });
      } else {
        if (confirm('Yakin ingin menghapus data SOAP?')) doDelete();
      }
    });

    // ---------- Copy dari riwayat ke form - IMPROVED ----------
    $(document).on('click', '.copy-soap', function () {
      try {
        var data = JSON.parse($(this).attr('data-soap'));
        // Copy semua field SOAP
        $('#keluhan').val(data.keluhan || '');
        $('#pemeriksaan').val(data.pemeriksaan || '');
        $('#penilaian').val(data.penilaian || '');
        $('#rtl').val(data.rtl || '');
        $('#instruksi').val(data.instruksi || '');
        $('#evaluasi').val(data.evaluasi || '');
        $('#alergi').val(data.alergi || '');
        $('#lingkar_perut').val(data.lingkar_perut || '');
        
        if (window.Swal) {
          Swal.fire({ 
            icon: 'success', 
            title: 'Tersalin', 
            text: 'Data SOAP berhasil disalin ke form.', 
            timer: 1200, 
            showConfirmButton: false 
          });
        }
      } catch (e) {
        console.error('❌ Gagal parse data-soap:', e);
        if (window.Swal) {
          Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menyalin data.' });
        }
      }
    });

    // ---------- Batal ----------
    $('#cancelEdit').on('click', function () {
      resetFormState();
    });

    // ---------- Init ----------
    updateDateTime();
    loadHasilSOAP();
    loadRiwayatSOAPbyNorm();
    autoIsiTTVJikaAda();
  });
})(jQuery, window, document);
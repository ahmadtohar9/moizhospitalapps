/* assets/js/dokterRalan/penunjangRalan.js (FINAL) */
(function ($, window, document) {
  'use strict';

  /* =========================
   * Endpoint namespace
   * ========================= */
  var API = (window.API && window.API.penunjangRalan) ? window.API.penunjangRalan : {};
  if (!API || !API.getData) console.error('❌ Endpoint Penunjang Ralan tidak terdefinisi.');

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
    beforeSend: function (_xhr, settings) {
      if (settings.type && settings.type.toUpperCase() === 'POST') {
        if (typeof settings.data === 'string') {
          var extra = csrf.name && csrf.token ? '&' + encodeURIComponent(csrf.name) + '=' + encodeURIComponent(csrf.token) : '';
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
    try { return JSON.parse(raw); } catch { return null; }
  }
  function handleJSON(raw, cb, ctx) {
    var json = tryParseJSON(raw);
    if (json) { updateCsrf(json); cb(json); return; }
    console.error('❌ Expected JSON in ' + ctx + ':', raw);
    if (window.Swal) Swal.fire({ icon: 'error', title: 'Error', text: 'Respon tidak valid (' + ctx + ')' });
  }
  function pad2(n){return String(n).padStart(2,'0');}
  function setNow($tgl, $jam) {
    var now = new Date();
    $tgl.val(now.getFullYear() + '-' + pad2(now.getMonth()+1) + '-' + pad2(now.getDate()));
    $jam.val(pad2(now.getHours()) + ':' + pad2(now.getMinutes()) + ':' + pad2(now.getSeconds()));
  }

  /* =========================
   * Renderers
   * ========================= */
  function renderRiwayat(rows) {
    if (!rows || rows.length === 0)
      return '<tr><td colspan="4" class="text-muted text-center">Belum ada data.</td></tr>';

    return rows.map(function (r, i) {
      var printUrl = (API.print || '#') + '?id=' + encodeURIComponent(r.id);
      var signed   = Number(r.is_locked) === 1;
      var badge    = signed ? '<span class="badge badge-success">Signed</span>'
                            : '<span class="badge badge-secondary">Draft</span>';
      var dokter   = r.nm_dokter ? ('<br><small class="text-muted">'+r.nm_dokter+'</small>') : '';

      return (
        '<tr>' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + (r.tgl_periksa || '-') + dokter + '</td>' +
          '<td>' + (r.jam_periksa || '-') + '<br>' + badge + '</td>' +
          '<td>' +
            '<a class="btn btn-secondary btn-sm" href="'+printUrl+'" target="_blank" title="Lihat Dokumen"><i class="fa fa-eye"></i></a> ' +
            '<button class="btn btn-warning btn-sm sign-penunjang" data-id="'+r.id+'" title="Tanda Tangani"><i class="fa fa-pencil"></i></button> '+
            '<button class="btn btn-info btn-sm edit-penunjang" data-id="'+r.id+'" title="Edit"><i class="fa fa-edit"></i></button> ' +
            '<button class="btn btn-danger btn-sm delete-penunjang" data-id="'+r.id+'" title="Hapus"><i class="fa fa-trash"></i></button>' +
          '</td>' +
        '</tr>'
      );
    }).join('');
  }

  function renderHasil(rows) {
    if (!rows || rows.length === 0)
      return '<tr><td colspan="4" class="text-muted text-center">Belum ada hasil pemeriksaan.</td></tr>';
    return rows.map(function (r, i) {
      var hasil = (r.hasil_pemeriksaan || '').replace(/\n/g, '<br>');
      return (
        '<tr>' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + (r.tgl_periksa || '-') + '</td>' +
          '<td>' + (r.jam_periksa || '-') + '</td>' +
          '<td class="text-left">' + hasil + '</td>' +
        '</tr>'
      );
    }).join('');
  }

  /* =========================
   * SignaturePad helpers
   * ========================= */
  var sigPad, sigCanvas;
  function resizeCanvas() {
    if (!sigCanvas) return;
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    sigCanvas.width  = sigCanvas.offsetWidth  * ratio;
    sigCanvas.height = sigCanvas.offsetHeight * ratio;
    sigCanvas.getContext('2d').scale(ratio, ratio);
    if (sigPad) sigPad.clear();
  }
  function openTTDModal(cbDone) {
    $('#modalTTD').modal('show');
    setTimeout(function(){
      sigCanvas = document.getElementById('canvasTTD');
      resizeCanvas();
      sigPad = new SignaturePad(sigCanvas, { backgroundColor: 'rgba(255,255,255,0)', penColor: 'black' });
    }, 150);
    $('#btnSimpanTTD').off('click').on('click', function(){
      if (!sigPad || sigPad.isEmpty()) { Swal.fire('Info','Silakan tanda tangan dulu.','info'); return; }
      var dataURL = sigPad.toDataURL('image/png');
      cbDone && cbDone(dataURL);
    });
    $('#btnUlangiTTD').off('click').on('click', function(){ sigPad && sigPad.clear(); });
  }
  $(window).on('resize', resizeCanvas);

  /* =========================
   * Main
   * ========================= */
  $(document).ready(function () {
    const $form  = $('#penunjangForm');
    const $tgl   = $('#tgl_periksa');
    const $jam   = $('#jam_periksa');
    const $hasil = $('#hasil_pemeriksaan');
    const $id    = $('#id_penunjang');
    const no_rawat  = $('#no_rawat').val();
    const kd_dokter = $('#kd_dokter').val();

    if (!no_rawat) { Swal && Swal.fire('Error', 'Nomor Rawat tidak ditemukan.', 'error'); return; }

    var editMode = false;

    function loadData(cb) {
      $.get(API.getData, { no_rawat: no_rawat }, function (res) {
        handleJSON(res, function (data) {
          if (data.status === 'success' && Array.isArray(data.data)) {
            $('#penunjang-riwayat-body').html(renderRiwayat(data.data));
            $('#hasil-penunjang-body').html(renderHasil(data.data));
          } else {
            $('#penunjang-riwayat-body').html('<tr><td colspan="4" class="text-muted text-center">Belum ada data.</td></tr>');
            $('#hasil-penunjang-body').html('<tr><td colspan="4" class="text-muted text-center">Belum ada hasil pemeriksaan.</td></tr>');
          }
          cb && cb(data);
        }, 'loadData');
      }).fail(function (xhr) {
        console.error('❌ loadData failed', xhr);
      });
    }

    function switchToEdit(found) {
      editMode = true;
      $id.val(found.id);
      $tgl.val(found.tgl_periksa);
      $jam.val(found.jam_periksa);
      $hasil.val(found.hasil_pemeriksaan);
      $('#btnSavePenunjang')
        .html('<i class="fa fa-edit"></i> Update')
        .removeClass('btn-success').addClass('btn-primary');
    }

    function loadExistingToEdit() {
      loadData(function(data){
        const rows = data.data || [];
        if (!rows.length) return;
        // server sudah sort DESC tgl & jam → ambil yang terbaru
        switchToEdit(rows[0]);
      });
    }

    function resetForm() {
    editMode = false;
    if ($form[0]) $form[0].reset();
    $id.val('');
    $hasil.val('').trigger('input change'); // paksa kosong utk editor/textarea
    $('#btnSavePenunjang')
      .html('<i class="fa fa-save"></i> Simpan')
      .removeClass('btn-primary').addClass('btn-success');
    setNow($tgl, $jam);
  }


    // Submit (save / update) — single-save tetap via 409
    $form.on('submit', function (e) {
      e.preventDefault();
      const url = editMode ? API.update : API.save;

      let data = addCsrf({
        id: $id.val(),
        no_rawat: no_rawat,
        kd_dokter: kd_dokter,
        tgl_periksa: $tgl.val(),
        jam_periksa: $jam.val(),
        hasil_pemeriksaan: $hasil.val()
      });

      const $btn = $('#btnSavePenunjang');
      const old = $btn.html();
      $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

      $.ajax({
        url: url,
        method: 'POST',
        data: $.param(data),
        statusCode: {
          409: function (xhr) {
            // Sudah pernah diisi → tampilkan info & cukup reload tabel
            let msg = 'Maaf, data sudah pernah diisi sebelumnya.';
            try {
              const r = JSON.parse(xhr.responseText);
              if (r && r.message) msg = r.message;
              updateCsrf(r);
            } catch(_) {}
            if (window.Swal) Swal.fire('Info', msg, 'info');
            loadData();
          }
        }
      })
      .done(function (res) {
        handleJSON(res, function (r) {
          if (r.status === 'success') {
            if (window.Swal) Swal.fire({
              icon: 'success', title: 'Berhasil', text: r.message,
              timer: 1400, showConfirmButton: false
            });
            // ⬇️ ini kuncinya: benar-benar bersihkan form, lalu reload tabel
            resetForm();
            loadData();
          } else {
            if (window.Swal) Swal.fire('Error', r.message || 'Gagal menyimpan.', 'error');
          }
        }, 'save/update');
      })
      .fail(function (xhr) {
        if (xhr && xhr.status !== 409) {
          if (window.Swal) Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        }
      })
      .always(function () {
        $btn.prop('disabled', false).html(old);
      });
    });

    // Edit
    $(document).on('click', '.edit-penunjang', function () {
      const id = $(this).data('id');
      $.get(API.getData, { no_rawat: no_rawat }, function (res) {
        handleJSON(res, function (data) {
          const found = (data.data || []).find(r => String(r.id) === String(id));
          if (!found) return Swal.fire('Error', 'Data tidak ditemukan.', 'error');
          switchToEdit(found);
        }, 'edit-load');
      });
    });

    // Delete
    $(document).on('click', '.delete-penunjang', function () {
      const id = $(this).data('id');
      if (window.Swal) {
        Swal.fire({
          title: 'Yakin hapus data ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus',
          cancelButtonText: 'Batal'
        }).then(function (r) {
          if (!r.isConfirmed) return;
          const data = addCsrf({ id: id });
          $.post(API.delete, $.param(data), function (res) {
            handleJSON(res, function (r) {
              if (r.status === 'success') {
                Swal.fire({ icon: 'success', title: 'Berhasil', text: r.message, timer: 1200, showConfirmButton: false });
                resetForm();
                loadData();
              } else {
                Swal.fire('Error', r.message || 'Gagal menghapus.', 'error');
              }
            }, 'delete');
          }).fail(function () {
            Swal.fire('Error', 'Gagal menghubungi server.', 'error');
          });
        });
      } else if (confirm('Yakin ingin menghapus?')) {
        const data = addCsrf({ id: id });
        $.post(API.delete, $.param(data), function () { loadData(); });
      }
    });

    // TTD dari form (simpan jika perlu, lalu sign)
    $('#btnSignPrint').on('click', function(){
      var currentId = $('#id_penunjang').val();

      function lanjutSign(id) {
        openTTDModal(function(dataURL){
          var post = addCsrf({ id: id, signature_base64: dataURL });
          $.post(API.sign, $.param(post), function(res){
            handleJSON(res, function (r) {
              if (r.status === 'success') {
                $('#modalTTD').modal('hide');
                loadData();
                if (r.print_url) window.open(r.print_url, '_blank');
              } else {
                Swal.fire('Error', r.message || 'Gagal menyimpan tanda tangan.', 'error');
              }
            }, 'sign');
          }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
        });
      }

      if (currentId) {
        lanjutSign(currentId);
      } else {
        // simpan dulu (kalau ini penyimpanan pertama, server akan OK; kalau sudah ada, server bisa balas 409)
        const dataSave = addCsrf({
          no_rawat: no_rawat,
          kd_dokter: kd_dokter,
          tgl_periksa: $tgl.val(),
          jam_periksa: $jam.val(),
          hasil_pemeriksaan: $hasil.val()
        });
        $.ajax({
          url: API.save, method: 'POST', data: $.param(dataSave),
          statusCode: {
            409: function (xhr) {
              let msg = 'Maaf, data sudah pernah diisi sebelumnya.';
              try {
                const r = JSON.parse(xhr.responseText);
                if (r && r.message) msg = r.message;
                updateCsrf(r);
              } catch(_) {}
              Swal.fire('Info', msg, 'info');
              // masuk ke edit lalu lanjut sign utk record existing
              loadData(function(d){
                const rows = d.data || [];
                if (rows.length) lanjutSign(rows[0].id);
              });
            }
          }
        }).done(function (res) {
          handleJSON(res, function (r) {
            if (r.status === 'success' && r.id) {
              lanjutSign(r.id);
            } else if (r.status !== 'success') {
              Swal.fire('Error', r.message || 'Gagal menyimpan data awal.', 'error');
            }
          }, 'save-before-sign');
        }).fail(function(){
          Swal.fire('Error','Gagal menghubungi server.','error');
        });
      }
    });

    // TTD dari baris riwayat
    $(document).on('click', '.sign-penunjang', function(){
      var id = $(this).data('id');
      openTTDModal(function(dataURL){
        var post = addCsrf({ id: id, signature_base64: dataURL });
        $.post(API.sign, $.param(post), function(res){
          handleJSON(res, function (r) {
            if (r.status === 'success') {
              $('#modalTTD').modal('hide');
              loadData();
              if (r.print_url) window.open(r.print_url, '_blank');
            } else {
              Swal.fire('Error', r.message || 'Gagal menyimpan tanda tangan.', 'error');
            }
          }, 'sign-row');
        }).fail(function(){ Swal.fire('Error','Gagal menghubungi server.','error'); });
      });
    });

    // Cancel
    $('#btnCancelPenunjang').on('click', function () {
      resetForm();
    });

    // Init
    setNow($tgl, $jam);
    loadData();
  });
})(jQuery, window, document);

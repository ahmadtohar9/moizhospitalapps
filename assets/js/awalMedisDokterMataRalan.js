$(document).ready(function () {
  console.log("🚀 JavaScript Medis Mata Loaded - FINAL FIXED VERSION");

  // ===== SAFETY CHECK API_URLS =====
  if (typeof API_URLS === 'undefined') {
    console.error("❌ API_URLS tidak terdefinisi!");
    window.API_URLS = {
      saveAwalMata: '<?= site_url("medis-mata/save") ?>',
      updateAwalMata: '<?= site_url("medis-mata/update") ?>',
      deleteAwalMata: '<?= site_url("medis-mata/delete") ?>',
      getAwalMata: '<?= site_url("medis-mata/get-hasil") ?>',
      getDetailAwalMata: '<?= site_url("medis-mata/get-detail") ?>',
      getRiwayatAwalMata: '<?= site_url("medis-mata/get-riwayat-norm") ?>',
      getLastAwalMata: '<?= site_url("medis-mata/get-last") ?>',
      printAwalMata: '<?= site_url("medis-mata/cetak") ?>',
      syncSession: '<?= site_url("medis-mata/sync-session") ?>'
    };
  }

  console.log("🔧 API_URLS Loaded:", API_URLS);

  // ===== VARIABLES =====
  var isEditMode = false;
  var currentEditNo = '';
  var noRawat = $('#no_rawat').val();
  var noRM = $('#global_no_rkm_medis').val();

  // ===== MAIN PROCESSING FUNCTION =====
  function processFormSubmission() {
    console.log('🚀 PROCESSING FORM SUBMISSION - FINAL VERSION');
    
    if (!$('#tgl_perawatan').val() || !$('#jam_rawat').val()) {
      Swal.fire("Error", "Tanggal dan jam harus diisi.", "error");
      return;
    }

    if (!API_URLS.saveAwalMata) {
      Swal.fire("Error", "Konfigurasi sistem tidak valid.", "error");
      return;
    }

    var url = isEditMode ? API_URLS.updateAwalMata : API_URLS.saveAwalMata;
    var formData = $('#formAwalMata').serialize();

    console.log('📤 Submission Details:', { url, formData, isEditMode });

    var submitBtn = $('#btnSubmit');
    var originalHtml = submitBtn.html();
    submitBtn.html('<i class="fa fa-spinner fa-spin"></i> ' + (isEditMode ? 'Updating...' : 'Menyimpan...')).prop('disabled', true);

    $.ajax({
      url: url,
      method: 'POST',
      data: formData,
      dataType: 'json',
      timeout: 30000
    })
    .done(function (res) {
      console.log('✅ Server response:', res);
      try {
        var json = (typeof res === 'string') ? JSON.parse(res) : res;
        if (json.status === 'success') {
          Swal.fire({ 
            icon: "success", 
            title: "Berhasil", 
            text: json.message, 
            timer: 2000,
            showConfirmButton: false 
          });
          resetForm();
          loadHasilPemeriksaan();
          loadRiwayat();
        } else {
          Swal.fire("Gagal", json.message, "error");
        }
      } catch (e) {
        Swal.fire("Error", "Format response tidak valid.", "error");
      }
    })
    .fail(function(xhr) {
      console.error('❌ Submit failed:', xhr);
      var errorMsg = "Gagal menyimpan data.";
      if (xhr.status === 0) errorMsg = "Tidak dapat terhubung ke server.";
      else if (xhr.status === 404) errorMsg = "Endpoint tidak ditemukan.";
      else if (xhr.status === 500) errorMsg = "Terjadi kesalahan server.";
      Swal.fire("Error", errorMsg, "error");
    })
    .always(function() {
      submitBtn.html(originalHtml).prop('disabled', false);
    });
  }

  // ===== EVENT HANDLERS =====
  console.log('🎯 Registering form submit handlers...');

  // PRIMARY EVENT HANDLER
  $('#formAwalMata').on('submit', function (e) {
    e.preventDefault();
    console.log('✅ FORM SUBMIT EVENT TRIGGERED');
    processFormSubmission();
  });

  // BACKUP EVENT HANDLER 
  $('#btnSubmit').on('click', function (e) {
    e.preventDefault();
    console.log('✅ BUTTON CLICK EVENT TRIGGERED');
    processFormSubmission();
  });

  // ===== TANGGAL & JAM OTOMATIS =====
  function updateDateTimeInputs() {
    var now = new Date();
    var tanggal = now.getFullYear() + '-' + 
                  String(now.getMonth() + 1).padStart(2, '0') + '-' + 
                  String(now.getDate()).padStart(2, '0');
    var jam = String(now.getHours()).padStart(2, '0') + ':' + 
              String(now.getMinutes()).padStart(2, '0') + ':' + 
              String(now.getSeconds()).padStart(2, '0');
    
    if ($('#tgl_perawatan').length > 0 && !isEditMode && !$('#tgl_perawatan').val()) {
        $('#tgl_perawatan').val(tanggal);
    }
    
    if ($('#jam_rawat').length > 0 && !isEditMode) {
        $('#jam_rawat').val(jam);
    }
  }

  function startRealTimeClock() {
    setInterval(function() {
        if (isEditMode) return;
        var now = new Date();
        var jam = String(now.getHours()).padStart(2, '0') + ':' + 
                  String(now.getMinutes()).padStart(2, '0') + ':' + 
                  String(now.getSeconds()).padStart(2, '0');
        $('#jam_rawat').val(jam);
    }, 1000);
  }

  // ===== HELPER FUNCTIONS =====
  function resetForm() {
    isEditMode = false;
    currentEditNo = '';
    $('#formAwalMata')[0].reset();
    $('#btnSubmit').html('<i class="fa fa-save"></i> Simpan');
    $('#cancelEdit').hide();
    updateDateTimeInputs();
    $('#no_rawat').val(noRawat);
  }

  function formatTanggalJam(dtString) {
    if (!dtString) return { tgl: '-', jam: '-' };
    try {
      var d = new Date(dtString.replace(' ', 'T'));
      if (isNaN(d.getTime())) return { tgl: '-', jam: '-' };
      var pad = function(n) { return String(n).padStart(2, '0'); };
      return {
        tgl: d.getFullYear() + '-' + pad(d.getMonth()+1) + '-' + pad(d.getDate()),
        jam: pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds())
      };
    } catch (e) {
      return { tgl: '-', jam: '-' };
    }
  }

  function short(text, max) {
    max = max || 50;
    if (!text) return '-';
    var s = String(text).trim();
    if (s.length <= max) return s;
    return '<span title="' + s.replace(/"/g,'&quot;') + '">' + s.slice(0,max) + '&hellip;</span>';
  }

  function label(type, val) {
    if (!val) val = '-';
    var map = { tgl: 'label-primary', jam: 'label-success', dr: 'label-warning' };
    return '<span class="label ' + (map[type] || 'label-default') + '">' + val + '</span>';
  }

  // ===== LOADERS =====
  function loadHasilPemeriksaan() {
    if (!API_URLS.getAwalMata) return;
    
    $.get(API_URLS.getAwalMata, { no_rawat: noRawat }, function (res) {
      var html = '';
      try {
        var json = (typeof res === 'string') ? JSON.parse(res) : res;
        var data = Array.isArray(json.data) ? json.data : [];
        $('#count-hasil').text((data.length || 0) + ' data');

        if (data.length) {
          data.forEach(function(d, i) {
            var fj = formatTanggalJam(d.tanggal || null);
            var no  = d.no_rawat || '';
            var hrefPDF = API_URLS.printAwalMata ? API_URLS.printAwalMata + '?no_rawat=' + encodeURIComponent(noRawat) : '#';

            html += 
              '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + label('tgl', fj.tgl) + '</td>' +
                '<td>' + label('jam', fj.jam) + '</td>' +
                '<td>' + label('dr', d.kd_dokter || '-') + '</td>' +
                '<td>' + short(d.keluhan_utama, 60) + '</td>' +
                '<td>' + short(d.diagnosis, 60) + '</td>' +
                '<td>' + short(d.tindakan, 60) + '</td>' +
                '<td>' +
                  '<a class="btn btn-success btn-xs" target="_blank" href="' + hrefPDF + '">' +
                    '<i class="fa fa-file-pdf-o"></i> PDF' +
                  '</a> ' +
                  '<button class="btn btn-info btn-xs btn-detail" data-no="' + no + '">' +
                    '<i class="fa fa-search"></i>' +
                  '</button> ' +
                  '<button class="btn btn-warning btn-xs edit-pemeriksaan" data-no="' + no + '">' +
                    '<i class="fa fa-edit"></i>' +
                  '</button> ' +
                  '<button class="btn btn-danger btn-xs delete-pemeriksaan" data-no="' + no + '">' +
                    '<i class="fa fa-trash"></i>' +
                  '</button>' +
                '</td>' +
              '</tr>';
          });
        } else {
          html = '<tr><td colspan="8" class="text-center text-muted">Belum ada data.</td></tr>';
        }
        $('#hasil-pemeriksaan-body').html(html);
      } catch (err) {
        console.error('loadHasilPemeriksaan error:', err);
        $('#hasil-pemeriksaan-body').html('<tr><td colspan="8" class="text-center text-danger">Error memuat data.</td></tr>');
      }
    });
  }

  function loadRiwayat() {
    if (!API_URLS.getRiwayatAwalMata) return;

    $.get(API_URLS.getRiwayatAwalMata, { no_rkm_medis: noRM }, function (res) {
      var html = '';
      try {
        var json = (typeof res === 'string') ? JSON.parse(res) : res;
        var data = json.data || [];
        $('#count-riwayat').text((data.length||0) + ' data');

        if (data.length) {
          data.forEach(function(d, i) {
            var fj = formatTanggalJam(d.tanggal || null);
            var safeData = encodeURIComponent(JSON.stringify(d));
            html += 
              '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + label('tgl', fj.tgl) + '</td>' +
                '<td>' + label('jam', fj.jam) + '</td>' +
                '<td>' + label('dr', d.kd_dokter || '-') + '</td>' +
                '<td>' + short(d.keluhan_utama, 60) + '</td>' +
                '<td>' + short(d.diagnosis, 60) + '</td>' +
                '<td>' + short(d.tindakan, 60) + '</td>' +
                '<td>' +
                  '<button class="btn btn-info btn-xs copy-riwayat" data-riwayat=\'' + safeData + '\'>' +
                    '<i class="fa fa-copy"></i>' +
                  '</button> ' +
                  '<button class="btn btn-default btn-xs btn-detail" data-no="' + d.no_rawat + '">' +
                    '<i class="fa fa-search"></i>' +
                  '</button>' +
                '</td>' +
              '</tr>';
          });
        } else {
          html = '<tr><td colspan="8" class="text-center text-muted">Tidak ada riwayat.</td></tr>';
        }
        $('#riwayat-body').html(html);
      } catch (err) {
        console.error('loadRiwayat error:', err);
      }
    });
  }

  // ===== OTHER EVENT HANDLERS =====
  $(document).on('click', '.btn-detail', function() {
    var no = $(this).data('no');
    if (!no) return;
    
    $.get(API_URLS.getDetailAwalMata, { no_rawat: no }, function(res) {
      try {
        var json = (typeof res === 'string') ? JSON.parse(res) : res;
        if (json.status === 'success' && json.data) {
          // Implement fillDetailModal here
          $('#detailAwalMataModal').modal('show');
        } else {
          Swal.fire('Error', json.message || 'Data tidak ditemukan.', 'error');
        }
      } catch (err) {
        console.error('Detail error:', err);
        Swal.fire('Error', 'Gagal memuat detail.', 'error');
      }
    });
  });

  $(document).on('click', '.edit-pemeriksaan', function() {
    var no = $(this).data('no');
    if (!no) return;
    
    $.get(API_URLS.getDetailAwalMata, { no_rawat: no }, function(res) {
      try {
        var json = (typeof res === 'string') ? JSON.parse(res) : res;
        var data = json.data || {};
        
        if (json.status === 'success' && data) {
          Object.keys(data).forEach(function(key) {
            var input = $('[name="' + key + '"]');
            if (input.length) {
              if (key === 'tanggal' && data[key]) {
                var fj = formatTanggalJam(data[key]);
                $('#tgl_perawatan').val(fj.tgl);
                $('#jam_rawat').val(fj.jam);
              } else {
                input.val(data[key]);
              }
            }
          });
          
          isEditMode = true;
          currentEditNo = no;
          $('#btnSubmit').html('<i class="fa fa-edit"></i> Update');
          $('#cancelEdit').show();
          
          Swal.fire("Info", "Mode edit diaktifkan.", "info");
        } else {
          Swal.fire('Error', json.message || 'Data tidak ditemukan.', 'error');
        }
      } catch (err) {
        console.error('Edit error:', err);
        Swal.fire('Error', 'Gagal memuat data untuk edit.', 'error');
      }
    });
  });

  $(document).on('click', '.delete-pemeriksaan', function() {
    var no = $(this).data('no');
    if (!no) return;
    
    Swal.fire({
      title: 'Hapus Data?',
      text: "Data tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then(function(result) {
      if (result.isConfirmed) {
        $.post(API_URLS.deleteAwalMata, { no_rawat: no }, function(res) {
          try {
            var json = (typeof res === 'string') ? JSON.parse(res) : res;
            if (json.status === 'success') {
              Swal.fire("Berhasil", json.message, "success");
              loadHasilPemeriksaan();
              loadRiwayat();
            } else {
              Swal.fire("Gagal", json.message, "error");
            }
          } catch (err) {
            console.error('Delete error:', err);
            Swal.fire('Error', 'Gagal menghapus data.', 'error');
          }
        });
      }
    });
  });

  $('#cancelEdit').on('click', function() {
    resetForm();
    Swal.fire("Info", "Mode edit dibatalkan.", "info");
  });

  // ===== INITIALIZATION =====
  console.log('🎯 Starting initialization...');
  
  if (!noRawat) {
    noRawat = $('#no_rawat').val();
    if (!noRawat) {
      console.error("❌ No Rawat tidak ditemukan!");
      return;
    }
  }

  // Initialize components
  updateDateTimeInputs();
  startRealTimeClock();
  loadHasilPemeriksaan();
  loadRiwayat();
  $('#cancelEdit').hide();
  
  console.log("✅ Assessment Dokter Mata FINAL Version initialized successfully");
});
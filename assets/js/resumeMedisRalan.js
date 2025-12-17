    $(document).ready(function () {
      const noRawat = $('#no_rawat').val();
      const noRm = $('#no_rkm_medis').val();

      loadResume(noRawat);
      loadRiwayatResume(noRm);
      loadTTVFromSOAP(noRawat);
      loadDiagnosaResume(noRawat);
      loadProsedurResume(noRawat);

      $('#btnSimpanResume').on('click', function () {
        saveResume();
      });
    });

    // ✅ Ambil data resume jika sudah ada
    function loadResume(noRawat) {
      $.getJSON(BASE_URL + 'resume-medis-ralan/get', { no_rawat: noRawat }, function (data) {
        if (data) {
          $('#keluhan_utama').val(data.keluhan_utama);
          $('#pemeriksaan_penunjang').val(data.pemeriksaan_penunjang);
          $('#hasil_laborat').val(data.hasil_laborat);

          $('#diagnosa_utama').val(data.diagnosa_utama);
          $('#kd_diagnosa_utama').val(data.kd_diagnosa_utama);
          $('#diagnosa_sekunder').val(data.diagnosa_sekunder);
          $('#kd_diagnosa_sekunder').val(data.kd_diagnosa_sekunder);
          $('#diagnosa_sekunder2').val(data.diagnosa_sekunder2);
          $('#kd_diagnosa_sekunder2').val(data.kd_diagnosa_sekunder2);
          $('#diagnosa_sekunder3').val(data.diagnosa_sekunder3);
          $('#kd_diagnosa_sekunder3').val(data.kd_diagnosa_sekunder3);
          $('#diagnosa_sekunder4').val(data.diagnosa_sekunder4);
          $('#kd_diagnosa_sekunder4').val(data.kd_diagnosa_sekunder4);

          $('#prosedur_utama').val(data.prosedur_utama);
          $('#kd_prosedur_utama').val(data.kd_prosedur_utama);
          $('#prosedur_sekunder').val(data.prosedur_sekunder);
          $('#kd_prosedur_sekunder').val(data.kd_prosedur_sekunder);
          $('#prosedur_sekunder2').val(data.prosedur_sekunder2);
          $('#kd_prosedur_sekunder2').val(data.kd_prosedur_sekunder2);
          $('#prosedur_sekunder3').val(data.prosedur_sekunder3);
          $('#kd_prosedur_sekunder3').val(data.kd_prosedur_sekunder3);

          $('#kondisi_pulang').val(data.kondisi_pulang);
          $('#obat_pulang').val(data.obat_pulang);

          $('#suhu').val(data.suhu_tubuh);
          $('#tensi').val(data.tensi);
          $('#nadi').val(data.nadi);
          $('#respirasi').val(data.respirasi);
          $('#tinggi').val(data.tinggi);
          $('#berat').val(data.berat);
          $('#spo2').val(data.spo2);
          $('#gcs').val(data.gcs);
          $('#kesadaran').val(data.kesadaran);
        }
      });
    }

      function saveResume() 
      {
        const formData = {
          no_rawat: $('#no_rawat').val(),
          kd_dokter: $('#kd_dokter').val(),
          keluhan_utama: $('#keluhan_utama').val(),
          jalannya_penyakit: 'membaik',
          pemeriksaan_penunjang: $('#pemeriksaan_penunjang').val(),
          hasil_laborat: $('#hasil_laborat').val(),

          diagnosa_utama: $('#diagnosa_utama').val(),
          kd_diagnosa_utama: $('#kd_diagnosa_utama').val(),
          diagnosa_sekunder: $('#diagnosa_sekunder').val(),
          kd_diagnosa_sekunder: $('#kd_diagnosa_sekunder').val(),
          diagnosa_sekunder2: $('#diagnosa_sekunder2').val(),
          kd_diagnosa_sekunder2: $('#kd_diagnosa_sekunder2').val(),
          diagnosa_sekunder3: $('#diagnosa_sekunder3').val(),
          kd_diagnosa_sekunder3: $('#kd_diagnosa_sekunder3').val(),
          diagnosa_sekunder4: $('#diagnosa_sekunder4').val(),
          kd_diagnosa_sekunder4: $('#kd_diagnosa_sekunder4').val(),

          prosedur_utama: $('#prosedur_utama').val(),
          kd_prosedur_utama: $('#kd_prosedur_utama').val(),
          prosedur_sekunder: $('#prosedur_sekunder').val(),
          kd_prosedur_sekunder: $('#kd_prosedur_sekunder').val(),
          prosedur_sekunder2: $('#prosedur_sekunder2').val(),
          kd_prosedur_sekunder2: $('#kd_prosedur_sekunder2').val(),
          prosedur_sekunder3: $('#prosedur_sekunder3').val(),
          kd_prosedur_sekunder3: $('#kd_prosedur_sekunder3').val(),

          kondisi_pulang: $('#kondisi_pulang').val(),
          obat_pulang: $('#obat_pulang').val(),

          suhu_tubuh: $('#suhu').val(),
          tensi: $('#tensi').val(),
          nadi: $('#nadi').val(),
          respirasi: $('#respirasi').val(),
          tinggi: $('#tinggi').val(),
          berat: $('#berat').val(),
          spo2: $('#spo2').val(),
          gcs: $('#gcs').val(),
          kesadaran: $('#kesadaran').val()
        };

        $.post(BASE_URL + 'resume-medis-ralan/save', formData, function (res) {
          if (res.success) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data Resume berhasil disimpan!',
              timer: 3000,
              showConfirmButton: false
            });
            loadRiwayatResume($('#no_rkm_medis').val());
          } else {
            // Kalau gagal, kemungkinan data sudah ada → update
            $.post(BASE_URL + 'resume-medis-ralan/update', formData, function (res2) {
              if (res2.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: 'Data Resume berhasil diperbarui!',
                  timer: 3000,
                  showConfirmButton: false
                });
                loadRiwayatResume($('#no_rkm_medis').val());
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: 'Gagal menyimpan atau memperbarui data.',
                  timer: 3000,
                  showConfirmButton: false
                });
              }
            }, 'json');
          }
        }, 'json');
      }




    // ✅ Ambil TTV terakhir dari SOAP
    function loadTTVFromSOAP(noRawat) {
      $.getJSON(BASE_URL + 'resume-medis-ralan/get-ttv-latest', { no_rawat: noRawat }, function (data) {
        if (data) {
          $('#suhu').val(data.suhu_tubuh);
          $('#tensi').val(data.tensi);
          $('#nadi').val(data.nadi);
          $('#respirasi').val(data.respirasi);
          $('#tinggi').val(data.tinggi);
          $('#berat').val(data.berat);
          $('#spo2').val(data.spo2);
          $('#gcs').val(data.gcs);
          $('#kesadaran').val(data.kesadaran);
          $('#keluhan_utama').val(data.keluhan); // dari SOAP juga
        }
      });
    }

    // ✅ Load diagnosa dari tabel diagnosa_pasien
    function loadDiagnosaResume(noRawat) {
      $.getJSON(BASE_URL + 'resume-medis-ralan/get-diagnosa', { no_rawat: noRawat }, function (res) {
        if (res.length > 0) {
          $('#diagnosa_utama').val(res[0].nm_penyakit);
          $('#kd_diagnosa_utama').val(res[0].kd_penyakit);
          if (res[1]) {
            $('#diagnosa_sekunder').val(res[1].nm_penyakit);
            $('#kd_diagnosa_sekunder').val(res[1].kd_penyakit);
          }
          if (res[2]) {
            $('#diagnosa_sekunder2').val(res[2].nm_penyakit);
            $('#kd_diagnosa_sekunder2').val(res[2].kd_penyakit);
          }
          if (res[3]) {
            $('#diagnosa_sekunder3').val(res[3].nm_penyakit);
            $('#kd_diagnosa_sekunder3').val(res[3].kd_penyakit);
          }
          if (res[4]) {
            $('#diagnosa_sekunder4').val(res[4].nm_penyakit);
            $('#kd_diagnosa_sekunder4').val(res[4].kd_penyakit);
          }
        }
      });
    }

  function loadRiwayatResume(no_rkm_medis) 
  {
    const currentNoRawat = $('#no_rawat').val();
    const maxInitialDisplay = 5;

    $.getJSON(BASE_URL + 'resume-medis-ralan/get-riwayat', { no_rkm_medis }, function (data) {
      let html = '';
      let showAllButton = '';

      if (data.length === 0) {
        html = '<tr><td colspan="6" class="text-center text-muted">Tidak ada riwayat Resume.</td></tr>';
      } else {
        const limitedData = data.slice(0, maxInitialDisplay);

        limitedData.forEach((item, index) => {
          const safeData = JSON.stringify(item).replace(/'/g, "&apos;");
          const isEditable = item.no_rawat === currentNoRawat;

          const editButton = isEditable
            ? `<button class="btn btn-sm btn-warning" onclick='editResume(${safeData})' title="Edit"><i class="fa fa-edit"></i></button>`
            : `<button class="btn btn-sm btn-secondary" onclick='editBlocked()' title="Tidak Bisa Edit"><i class="fa fa-lock"></i></button>`;

          const deleteButton = isEditable
            ? `<button class="btn btn-sm btn-danger" onclick='deleteResume("${item.no_rawat}")' title="Hapus"><i class="fa fa-trash"></i></button>`
            : `<button class="btn btn-sm btn-secondary" onclick='deleteBlocked()' title="Tidak Bisa Hapus"><i class="fa fa-lock"></i></button>`;

          html += `
            <tr>
              <td>${index + 1}</td>
              <td>${item.tgl_registrasi}</td>
              <td>
                ${item.no_rawat}
                <div class="mt-2">
                  <button class="btn btn-sm btn-info" onclick='copyResume(${safeData})' title="Copy"><i class="fa fa-copy"></i></button>
                  <button class="btn btn-sm btn-secondary" onclick='viewResume(${safeData})' title="Lihat"><i class="fa fa-eye"></i></button>
                  ${editButton}
                  ${deleteButton}
                </div>
              </td>
              <td>${item.nm_poli || '-'}</td>
              <td>${item.nm_dokter}</td>
              <td>${item.diagnosa_utama || '-'}</td>
            </tr>`;
        });

        if (data.length > maxInitialDisplay) {
          showAllButton = `
            <tr>
              <td colspan="6" class="text-center">
                <button class="btn btn-sm btn-outline-primary" onclick="loadRiwayatResumeAll()">Tampilkan Semua</button>
              </td>
            </tr>`;
        }
      }

      $('#tabelRiwayatResume').html(html + showAllButton);
      $('#theadRiwayatResume').html(`
        <tr class="bg-light">
          <th>No</th>
          <th>Tanggal</th>
          <th>No.Rawat</th>
          <th>Poli</th>
          <th>Dokter</th>
          <th>Diagnosa</th>
        </tr>
      `);
    });
  }



  // Fungsi untuk memuat semua data (tanpa batas)
  function loadRiwayatResumeAll() {
    const no_rkm_medis = $('#no_rkm_medis').val();
    // Versi tampil semua
    window.loadRiwayatResume = function(no_rkm_medis) {
      const currentNoRawat = $('#no_rawat').val();
      $.getJSON(BASE_URL + 'resume-medis-ralan/get-riwayat', { no_rkm_medis }, function (data) {
        let html = '';
        data.forEach((item, index) => {
          const safeData = JSON.stringify(item).replace(/'/g, "&apos;");
          const isEditable = item.no_rawat === currentNoRawat;

          const editButton = isEditable
            ? `<button class="btn btn-sm btn-warning" onclick='editResume(${safeData})' title="Edit"><i class="fa fa-edit"></i></button>`
            : `<button class="btn btn-sm btn-secondary" onclick='editBlocked()' title="Tidak Bisa Edit"><i class="fa fa-lock"></i></button>`;

          const deleteButton = isEditable
            ? `<button class="btn btn-sm btn-danger" onclick='deleteResume("${item.no_rawat}")' title="Hapus"><i class="fa fa-trash"></i></button>`
            : `<button class="btn btn-sm btn-secondary" onclick='deleteBlocked()' title="Tidak Bisa Hapus"><i class="fa fa-lock"></i></button>`;

          html += `
            <tr>
              <td>${index + 1}</td>
              <td>${item.tgl_registrasi}</td>
              <td>${item.nm_poli || '-'}</td>
              <td>
                ${item.nm_dokter}
                <div class="mt-2">
                  <button class="btn btn-sm btn-info" onclick='copyResume(${safeData})' title="Copy"><i class="fa fa-copy"></i></button>
                  <button class="btn btn-sm btn-secondary" onclick='viewResume(${safeData})' title="Lihat"><i class="fa fa-eye"></i></button>
                  ${editButton}
                  ${deleteButton}
                </div>
                <div class="text-muted small mt-1">No. Rawat: ${item.no_rawat}</div>
              </td>
              <td>${item.diagnosa_utama || '-'}</td>
            </tr>`;
        });
        $('#tabelRiwayatResume').html(html);
      });
    };
    loadRiwayatResume(no_rkm_medis); // Panggil ulang versi full
  }


    function editBlocked() 
    {
      Swal.fire({
        icon: 'warning',
        title: 'Akses Ditolak',
        text: 'Maaf, Anda hanya bisa mengedit resume dari kunjungan saat ini.',
        timer: 3000,
        showConfirmButton: false
      });
    }

    function deleteBlocked() {
      Swal.fire({
        icon: 'warning',
        title: 'Tidak Bisa Dihapus',
        text: 'Anda hanya dapat menghapus data resume dari kunjungan saat ini.',
        timer: 3000,
        showConfirmButton: false
      });
    }


   function viewResume(data) {
    $.getJSON(BASE_URL + 'resume-medis-ralan/get_detail_resume', { no_rawat: data.no_rawat }, function (res) {
      if (!res) {
        Swal.fire('Gagal', 'Data resume tidak ditemukan.', 'error');
        return;
      }

      const umurLengkap = `${res.umur_thn || 0} Th ${res.umur_bln || 0} B ${res.umur_hr || 0} Hr`;

      let detail = `
        <div style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; text-align:left;">
          <h5 style="text-align:center; font-weight:bold; margin-bottom:20px;">Resume Medis Rawat Jalan</h5>

          <!-- Informasi Pasien -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold; margin-bottom: 8px;">🧾 Informasi Pasien</h6>
            <table style="width:100%;">
              <tr><td style="width:150px;"><b>No. RM</b></td><td>: ${res.no_rkm_medis}</td></tr>
              <tr><td><b>Nama</b></td><td>: ${res.nm_pasien}</td></tr>
              <tr><td><b>Jenis Kelamin</b></td><td>: ${res.jk === 'L' ? 'Laki-laki' : 'Perempuan'}</td></tr>
              <tr><td><b>Umur</b></td><td>: ${umurLengkap}</td></tr>
              <tr><td><b>Asuransi</b></td><td>: ${res.png_jawab}</td></tr>
              <tr><td><b>Tanggal</b></td><td>: ${data.tgl_registrasi}</td></tr>
              <tr><td><b>No. Rawat</b></td><td>: ${data.no_rawat}</td></tr>
              <tr><td><b>Dokter</b></td><td>: ${data.nm_dokter}</td></tr>
            </table>
          </div>

          <!-- Tanda-Tanda Vital -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold; margin-bottom: 8px;">🩺 Tanda-Tanda Vital</h6>
            <table style="width: 100%;">
              <tr>
                <td><b>Suhu</b></td><td>: ${res.suhu || '-'} °C</td>
                <td><b>Nadi</b></td><td>: ${res.nadi || '-'} x/menit</td>
              </tr>
              <tr>
                <td><b>Respirasi</b></td><td>: ${res.respirasi || '-'} x/menit</td>
                <td><b>SPO2</b></td><td>: ${res.spo2 || '-'} %</td>
              </tr>
              <tr>
                <td><b>Tensi</b></td><td colspan="3">: ${res.tensi || '-'}</td>
              </tr>
            </table>
          </div>

          <!-- Keluhan Utama -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold; margin-bottom: 8px;">🗣️ Keluhan Utama</h6>
            <div>${res.keluhan_utama || '-'}</div>
          </div>

          <!-- Diagnosa -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold; margin-bottom: 8px;">🧠 Diagnosa</h6>
            <table style="width: 100%;">
              <tr><td><b>Utama</b></td><td>: ${res.diagnosa_utama || '-'} (${res.kd_diagnosa_utama || '-'})</td></tr>
              <tr><td><b>Sekunder 1</b></td><td>: ${res.diagnosa_sekunder || '-'} (${res.kd_diagnosa_sekunder || '-'})</td></tr>
              <tr><td><b>Sekunder 2</b></td><td>: ${res.diagnosa_sekunder2 || '-'} (${res.kd_diagnosa_sekunder2 || '-'})</td></tr>
              <tr><td><b>Sekunder 3</b></td><td>: ${res.diagnosa_sekunder3 || '-'} (${res.kd_diagnosa_sekunder3 || '-'})</td></tr>
              <tr><td><b>Sekunder 4</b></td><td>: ${res.diagnosa_sekunder4 || '-'} (${res.kd_diagnosa_sekunder4 || '-'})</td></tr>
            </table>
          </div>

          <!-- Prosedur -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold; margin-bottom: 8px;">🛠️ Prosedur</h6>
            <table style="width: 100%;">
              <tr><td><b>Utama</b></td><td>: ${res.prosedur_utama || '-'} (${res.kd_prosedur_utama || '-'})</td></tr>
              <tr><td><b>Sekunder 1</b></td><td>: ${res.prosedur_sekunder || '-'} (${res.kd_prosedur_sekunder || '-'})</td></tr>
              <tr><td><b>Sekunder 2</b></td><td>: ${res.prosedur_sekunder2 || '-'} (${res.kd_prosedur_sekunder2 || '-'})</td></tr>
              <tr><td><b>Sekunder 3</b></td><td>: ${res.prosedur_sekunder3 || '-'} (${res.kd_prosedur_sekunder3 || '-'})</td></tr>
            </table>
          </div>

          <!-- Kondisi dan Obat Pulang -->
          <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; background: rgba(255,255,255,0.8); border-radius: 6px;">
            <h6 style="font-weight: bold;">📋 Kondisi Pulang</h6>
            <p>${res.kondisi_pulang || '-'}</p>

            <h6 style="font-weight: bold;">💊 Obat Pulang</h6>
            <p>${res.obat_pulang || '-'}</p>
          </div>
        </div>
      `;


      Swal.fire({
        title: 'Detail Resume',
        html: detail,
        width: 750,
        icon: 'info',
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        confirmButtonText: 'Cetak PDF',
      }).then((result) => {
        if (result.isConfirmed) {
          const encodedRawat = btoa(data.no_rawat); // encode base64
          window.open(BASE_URL + 'resume-medis-ralan/cetak-pdf/' + encodedRawat, '_blank');
        }
      });
    });
  }



      function editResume(data) {
        // Sama seperti copyResume, tapi kamu bisa tambahkan penanda sedang edit
        copyResume(data);
        Swal.fire({
          icon: 'info',
          title: 'Edit Resume',
          text: 'Silakan ubah data pada form dan tekan simpan.'
        });
      }

      function deleteResume(no_rawat) {
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: "Data tidak bisa dikembalikan setelah dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            $.post(BASE_URL + 'resume-medis-ralan/delete', { no_rawat }, function (res) {
              if (res.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: 'Data resume berhasil dihapus!',
                  timer: 3000,
                  showConfirmButton: false
                });
                loadRiwayatResume($('#no_rkm_medis').val());
              } else {
                Swal.fire('Gagal', 'Tidak bisa menghapus data.', 'error');
              }
            }, 'json');
          }
        });
      }



    function loadProsedurResume(noRawat) {
      $.getJSON(BASE_URL + 'resume-medis-ralan/get-prosedur', { no_rawat: noRawat }, function (res) {
        if (res.length > 0) {
          $('#prosedur_utama').val(res[0].deskripsi_panjang);
          $('#kd_prosedur_utama').val(res[0].kode);

          if (res[1]) {
            $('#prosedur_sekunder').val(res[1].deskripsi_panjang);
            $('#kd_prosedur_sekunder').val(res[1].kode);
          }
          if (res[2]) {
            $('#prosedur_sekunder2').val(res[2].deskripsi_panjang);
            $('#kd_prosedur_sekunder2').val(res[2].kode);
          }
          if (res[3]) {
            $('#prosedur_sekunder3').val(res[3].deskripsi_panjang);
            $('#kd_prosedur_sekunder3').val(res[3].kode);
          }
        }
      });
    }


    function copyResume(data) 
    {
      // Salin data resume tanpa TTV (biar tetap pakai dari SOAP)
      $('#keluhan_utama').val(data.keluhan_utama);
      $('#pemeriksaan_penunjang').val(data.pemeriksaan_penunjang);
      $('#hasil_laborat').val(data.hasil_laborat);

      // Diagnosa
      $('#diagnosa_utama').val(data.diagnosa_utama);
      $('#kd_diagnosa_utama').val(data.kd_diagnosa_utama);
      $('#diagnosa_sekunder').val(data.diagnosa_sekunder);
      $('#kd_diagnosa_sekunder').val(data.kd_diagnosa_sekunder);
      $('#diagnosa_sekunder2').val(data.diagnosa_sekunder2);
      $('#kd_diagnosa_sekunder2').val(data.kd_diagnosa_sekunder2);
      $('#diagnosa_sekunder3').val(data.diagnosa_sekunder3);
      $('#kd_diagnosa_sekunder3').val(data.kd_diagnosa_sekunder3);
      $('#diagnosa_sekunder4').val(data.diagnosa_sekunder4);
      $('#kd_diagnosa_sekunder4').val(data.kd_diagnosa_sekunder4);

      // Prosedur
      $('#prosedur_utama').val(data.prosedur_utama);
      $('#kd_prosedur_utama').val(data.kd_prosedur_utama);
      $('#prosedur_sekunder').val(data.prosedur_sekunder);
      $('#kd_prosedur_sekunder').val(data.kd_prosedur_sekunder);
      $('#prosedur_sekunder2').val(data.prosedur_sekunder2);
      $('#kd_prosedur_sekunder2').val(data.kd_prosedur_sekunder2);
      $('#prosedur_sekunder3').val(data.prosedur_sekunder3);
      $('#kd_prosedur_sekunder3').val(data.kd_prosedur_sekunder3);

      $('#kondisi_pulang').val(data.kondisi_pulang);
      $('#obat_pulang').val(data.obat_pulang);

      // Tidak menyentuh TTV (biar tetap pakai dari SOAP)

      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Resume berhasil disalin ke form!',
        timer: 2000,
        showConfirmButton: false
      });
    }


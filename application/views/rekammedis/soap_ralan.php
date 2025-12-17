<div class="row">
  <!-- Kolom kiri: Form SOAP -->
  <div class="col-md-7">
    <div class="card shadow-sm border-primary mb-4">
      <div class="card-header bg-primary text-white py-2">
        <h5 class="m-0"><i class="fa fa-file-medical"></i> Form SOAP</h5>
      </div>
      <div class="card-body">
        <form id="soapForm" method="POST">
          <?php if (isset($this->security)): ?>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
              value="<?= $this->security->get_csrf_hash(); ?>">
          <?php endif; ?>

          <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat ?>">
          <input type="hidden" name="kd_dokter" value="<?= $kd_dokter ?>">
          <input type="hidden" id="global_no_rkm_medis" value="<?= $no_rkm_medis ?>">
          <input type="hidden" id="original_jam_rawat" name="original_jam_rawat">

          <!-- Tanggal & Jam -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="tgl_perawatan" class="form-label"><i class="fa fa-calendar"></i> Tanggal</label>
                <input type="date" name="tgl_perawatan" id="tgl_perawatan" class="form-control form-control-sm"
                  tabindex="1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="jam_rawat" class="form-label"><i class="fa fa-clock-o"></i> Jam</label>
                <input type="text" name="jam_rawat" id="jam_rawat" class="form-control form-control-sm"
                  placeholder="HH:MM:SS" tabindex="2">
              </div>
            </div>
          </div>

          <!-- Tanda Vital Section -->
          <div class="card mb-3 border-warning">
            <div class="card-header bg-warning text-dark py-2">
              <h6 class="m-0"><i class="fa fa-heartbeat"></i> Tanda Vital</h6>
            </div>
            <div class="card-body p-2">
              <div class="row">
                <!-- Baris 1 -->
                <div class="col-md-3 mb-2">
                  <label for="suhu_tubuh" class="form-label small">Suhu (°C)</label>
                  <input type="number" step="0.1" name="suhu_tubuh" id="suhu_tubuh" class="form-control form-control-sm"
                    placeholder="36.5" tabindex="3">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="tensi" class="form-label small">Tensi (mmHg)</label>
                  <input type="text" name="tensi" id="tensi" class="form-control form-control-sm" placeholder="120/80"
                    tabindex="4">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="nadi" class="form-label small">Nadi (BPM)</label>
                  <input type="number" step="0.1" name="nadi" id="nadi" class="form-control form-control-sm"
                    placeholder="72" tabindex="5">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="respirasi" class="form-label small">Respirasi (RPM)</label>
                  <input type="number" step="0.1" name="respirasi" id="respirasi" class="form-control form-control-sm"
                    placeholder="16" tabindex="6">
                </div>

                <!-- Baris 2 -->
                <div class="col-md-3 mb-2">
                  <label for="spo2" class="form-label small">SPO2 (%)</label>
                  <input type="number" step="0.1" name="spo2" id="spo2" class="form-control form-control-sm"
                    placeholder="98" tabindex="7">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="gcs" class="form-label small">GCS</label>
                  <input type="text" name="gcs" id="gcs" class="form-control form-control-sm" placeholder="15"
                    tabindex="8">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="berat" class="form-label small">Berat (kg)</label>
                  <input type="number" step="0.1" name="berat" id="berat" class="form-control form-control-sm"
                    placeholder="65" tabindex="9">
                </div>
                <div class="col-md-3 mb-2">
                  <label for="tinggi" class="form-label small">Tinggi (cm)</label>
                  <input type="number" step="0.1" name="tinggi" id="tinggi" class="form-control form-control-sm"
                    placeholder="170" tabindex="10">
                </div>

                <!-- Baris 3 -->
                <div class="col-md-6 mb-2">
                  <label for="kesadaran" class="form-label small">Kesadaran</label>
                  <select name="kesadaran" id="kesadaran" class="form-control form-control-sm" tabindex="11">
                    <option value="">Pilih Kesadaran</option>
                    <option value="Compos Mentis">Compos Mentis</option>
                    <option value="Alert">Alert</option>
                    <option value="Somnolence">Somnolence</option>
                    <option value="Confusion">Confusion</option>
                    <option value="Sopor">Sopor</option>
                    <option value="Coma">Coma</option>
                    <option value="Voice">Voice</option>
                    <option value="Pain">Pain</option>
                    <option value="Unresponsive">Unresponsive</option>
                    <option value="Apatis">Apatis</option>
                    <option value="Delirium">Delirium</option>
                  </select>
                </div>
                <div class="col-md-6 mb-2">
                  <label for="alergi" class="form-label small">Alergi</label>
                  <input type="text" name="alergi" id="alergi" class="form-control form-control-sm"
                    placeholder="Tidak ada alergi" tabindex="12">
                </div>

                <!-- Baris 4 -->
                <div class="col-md-6 mb-2">
                  <label for="lingkar_perut" class="form-label small">Lingkar Perut (cm)</label>
                  <input type="number" step="0.1" name="lingkar_perut" id="lingkar_perut"
                    class="form-control form-control-sm" placeholder="80" tabindex="13">
                </div>
              </div>
            </div>
          </div>


          <!-- SOAP Section -->
          <div class="card mb-3 border-info">
            <div class="card-header bg-info text-white py-2">
              <h6 class="m-0"><i class="fa fa-stethoscope"></i> Data SOAP</h6>
            </div>
            <div class="card-body p-2">
              <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                  <!-- Subjektif (Keluhan) -->
                  <div class="form-group mb-3">
                    <label for="keluhan" class="form-label font-weight-bold text-danger">
                      <i class="fa fa-comments"></i> Subjektif (Keluhan)
                    </label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="3"
                      placeholder="Keluhan utama pasien..." tabindex="14"></textarea>
                  </div>

                  <!-- Asesmen (Penilaian) -->
                  <div class="form-group mb-3">
                    <label for="penilaian" class="form-label font-weight-bold text-success">
                      <i class="fa fa-diagnoses"></i> Asesmen (Penilaian)
                    </label>
                    <textarea name="penilaian" id="penilaian" class="form-control" rows="3"
                      placeholder="Diagnosis dan penilaian..." tabindex="16"></textarea>
                  </div>

                  <!-- Instruksi -->
                  <div class="form-group mb-3">
                    <label for="instruksi" class="form-label font-weight-bold text-info">
                      <i class="fa fa-file-medical-alt"></i> Instruksi
                    </label>
                    <textarea name="instruksi" id="instruksi" class="form-control" rows="4"
                      placeholder="Instruksi dokter..." tabindex="18"></textarea>
                  </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                  <!-- Objektif (Pemeriksaan) -->
                  <div class="form-group mb-3">
                    <label for="pemeriksaan" class="form-label font-weight-bold text-warning">
                      <i class="fa fa-search"></i> Objektif (Pemeriksaan)
                    </label>
                    <textarea name="pemeriksaan" id="pemeriksaan" class="form-control" rows="3"
                      placeholder="Hasil pemeriksaan fisik..." tabindex="15"></textarea>
                  </div>

                  <!-- Plan (RTL) -->
                  <div class="form-group mb-3">
                    <label for="rtl" class="form-label font-weight-bold text-primary">
                      <i class="fa fa-clipboard-list"></i> Plan (RTL)
                    </label>
                    <textarea name="rtl" id="rtl" class="form-control" rows="3" placeholder="Rencana tindak lanjut..."
                      tabindex="17"></textarea>
                  </div>

                  <!-- Evaluasi -->
                  <div class="form-group mb-2">
                    <label for="evaluasi" class="form-label font-weight-bold text-secondary">
                      <i class="fa fa-chart-line"></i> Evaluasi
                    </label>
                    <textarea name="evaluasi" id="evaluasi" class="form-control" rows="4"
                      placeholder="Evaluasi hasil..." tabindex="19"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tombol -->
          <div class="text-right mt-3">
            <button type="submit" class="btn btn-success btn-sm" tabindex="20">
              <i class="fa fa-save"></i> Simpan SOAP
            </button>
            <button type="button" id="cancelEdit" class="btn btn-secondary btn-sm" tabindex="21">
              <i class="fa fa-times"></i> Batal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kolom kanan: Riwayat SOAP -->
  <div class="col-md-5">
    <div class="card shadow-sm border-danger mb-4">
      <div class="card-header bg-danger text-white py-2">
        <h5 class="m-0"><i class="fa fa-history"></i> Riwayat SOAP</h5>
      </div>
      <div class="card-body p-2" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-sm table-bordered table-hover">
          <thead class="thead-light">
            <tr class="text-center">
              <th>No</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Pemeriksa</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="soap-riwayat-body" class="text-center">
            <!-- Diisi via JS -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Hasil SOAP dengan DataTables -->
<div class="card shadow-sm border-info">
  <div class="card-header bg-info text-white py-2">
    <h6 class="m-0"><i class="fa fa-file-alt"></i> Hasil SOAP Saat Ini</h6>
  </div>
  <div class="card-body p-2">
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-hover" id="hasilSoapTable">
        <thead class="thead-light text-center">
          <tr>
            <th style="width:50px">No</th>
            <th>Tanggal</th>
            <th>Suhu(°C)</th>
            <th>Tensi(mmHg)</th>
            <th>Nadi(/menit)</th>
            <th>RR(/menit)</th>
            <th>Tinggi(cm)</th>
            <th>Berat(kg)</th>
            <th>GCS(E,V,M)</th>
            <th>SPO2</th>
            <th>Alergi</th>
            <th>Instruksi & Evaluasi</th>
          </tr>
        </thead>
        <tbody id="hasil-soap-body" class="text-center">
          <!-- Diisi via JS -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  window.API = window.API || {};
  window.API.soapRalan = {
    getHasil: "<?= site_url('soap-ralan/get-hasil'); ?>",
    getRiwayat: "<?= site_url('soap-ralan/get-riwayat-norm'); ?>",
    getDetail: "<?= site_url('soap-ralan/get-detail'); ?>",
    lastTTV: "<?= site_url('soap-ralan/get-last-ttv'); ?>",
    save: "<?= site_url('soap-ralan/save'); ?>",
    update: "<?= site_url('soap-ralan/update'); ?>",
    delete: "<?= site_url('soap-ralan/delete'); ?>"
  };
</script>

<script src="<?= asset_url('assets/js/soap_ralan.js') ?>"></script>

<!-- Initialize DataTables for Hasil SOAP -->
<script>
  $(document).ready(function () {
    // Initialize DataTables after data is loaded
    // Initialize DataTables after data is loaded
    // DISABLED: Table structure with rowspan/colspan is incompatible with DataTables
    // Using manual pagination instead
    function initHasilSoapDataTable() {
      // DataTables disabled due to complex table structure with rowspan
      console.info('DataTables disabled for SOAP table - using manual pagination');
      return;

      /* ORIGINAL CODE - DISABLED
      try {
        // Check if table element exists
        if (!$('#hasilSoapTable').length) {
          console.warn('Table #hasilSoapTable not found in DOM');
          return;
        }

        // Check if tbody exists and has proper structure
        if (!$('#hasilSoapTable tbody').length) {
          console.warn('Table tbody not found, skipping DataTable init');
          return;
        }

        // Destroy existing DataTable instance if exists
        if ($.fn.DataTable.isDataTable('#hasilSoapTable')) {
          $('#hasilSoapTable').DataTable().clear().destroy();
        }

        // Small delay to ensure DOM is ready
        setTimeout(function() {
          // Re-initialize DataTable
          $('#hasilSoapTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[1, 'desc']], // Sort by Tanggal descending
            "language": {
              "search": "Cari SOAP:",
              "lengthMenu": "Tampilkan _MENU_ data per halaman",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ SOAP",
              "infoEmpty": "Tidak ada data",
              "infoFiltered": "(difilter dari _MAX_ total SOAP)",
              "zeroRecords": "Tidak ada SOAP yang cocok",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
              }
            },
            "columnDefs": [
              { "orderable": false, "targets": 0 } // Disable sorting on No column
            ]
          });
        }, 100);
      } catch (error) {
        console.error('Error initializing DataTable:', error);
      }
      */
    }

    // Call this function after loading SOAP data
    // Add this to your soap_ralan.js after populating hasil-soap-body
    window.initHasilSoapDataTable = initHasilSoapDataTable;
  });
</script>

<style>
  /* DataTables styling */
  #hasilSoapTable_wrapper .dataTables_filter {
    float: right;
    margin-bottom: 10px;
  }

  #hasilSoapTable_wrapper .dataTables_length {
    float: left;
    margin-bottom: 10px;
  }

  #hasilSoapTable_wrapper .dataTables_info {
    padding-top: 8px;
  }

  #hasilSoapTable_wrapper .dataTables_paginate {
    float: right;
    padding-top: 8px;
  }

  /* Make table more compact */
  #hasilSoapTable th,
  #hasilSoapTable td {
    font-size: 12px;
    padding: 6px 8px;
  }

  /* Highlight row on hover */
  #hasilSoapTable tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
  }
</style>
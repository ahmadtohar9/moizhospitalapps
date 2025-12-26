<!-- Modern SOAP Interface -->
<style>
  /* Clean Medical Theme */
  :root {
    --soap-primary: #6366f1;
    --soap-primary-light: #818cf8;
    --soap-primary-dark: #4f46e5;
    --soap-border: #e5e7eb;
    --soap-bg-light: #f9fafb;
    --soap-text: #1f2937;
    --soap-text-muted: #6b7280;
  }

  /* Clean Card Styling */
  .soap-card {
    background: white;
    border: 1px solid var(--soap-border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    margin-bottom: 20px;
  }

  .soap-card:hover {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
  }

  /* Simple Headers */
  .soap-header-primary {
    background: var(--soap-primary);
    color: white;
    padding: 16px 20px;
    border-bottom: 3px solid var(--soap-primary-dark);
  }

  .soap-header-history {
    background: #f59e0b;
    color: white;
    padding: 16px 20px;
    border-bottom: 3px solid #d97706;
  }

  .soap-header-result {
    background: #10b981;
    color: white;
    padding: 16px 20px;
    border-bottom: 3px solid #059669;
  }

  .soap-header h5,
  .soap-header h6 {
    margin: 0;
    font-weight: 600;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  /* Fix for header with button */
  .soap-header.d-flex {
    padding: 16px 20px;
  }

  .soap-header i {
    font-size: 1.2em;
  }

  /* Clean Form Styling */
  .soap-form-control {
    border: 1px solid var(--soap-border);
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.2s ease;
    font-size: 14px;
    background: white;
  }

  .soap-form-control:focus {
    border-color: var(--soap-primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    outline: none;
  }

  .soap-form-control::placeholder {
    color: #9ca3af;
  }

  /* Clean Labels */
  .soap-label {
    font-weight: 600;
    font-size: 13px;
    color: var(--soap-text);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .soap-label i {
    font-size: 1em;
    color: var(--soap-text-muted);
  }

  /* Section Cards */
  .soap-section {
    background: var(--soap-bg-light);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 16px;
    border: 1px solid var(--soap-border);
  }

  .soap-section-title {
    font-weight: 700;
    font-size: 14px;
    color: var(--soap-text);
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--soap-border);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .soap-section-title i {
    color: var(--soap-primary);
  }

  /* Vital Signs Grid */
  .vital-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
  }

  .vital-item {
    background: white;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid var(--soap-border);
    transition: all 0.2s ease;
  }

  .vital-item:hover {
    border-color: var(--soap-primary-light);
    box-shadow: 0 2px 4px rgba(99, 102, 241, 0.1);
  }

  /* SOAP Fields Styling */
  .soap-field-group {
    margin-bottom: 16px;
  }

  .soap-textarea {
    border: 1px solid var(--soap-border);
    border-radius: 8px;
    padding: 12px;
    transition: all 0.2s ease;
    font-size: 14px;
    line-height: 1.6;
    resize: vertical;
    background: white;
  }

  .soap-textarea:focus {
    border-color: var(--soap-primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    outline: none;
  }

  /* Color-coded SOAP Labels */
  .label-subjective {
    color: #dc2626;
    font-weight: 700;
  }

  .label-objective {
    color: #ea580c;
    font-weight: 700;
  }

  .label-assessment {
    color: #16a34a;
    font-weight: 700;
  }

  .label-plan {
    color: #2563eb;
    font-weight: 700;
  }

  .label-instruction {
    color: #0891b2;
    font-weight: 700;
  }

  .label-evaluation {
    color: #9333ea;
    font-weight: 700;
  }

  /* Clean Buttons */
  .soap-btn {
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .soap-btn-save {
    background: var(--soap-primary);
    color: white;
  }

  .soap-btn-save:hover {
    background: var(--soap-primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
    color: white;
  }

  .soap-btn-cancel {
    background: #e5e7eb;
    color: #4b5563;
  }

  .soap-btn-cancel:hover {
    background: #d1d5db;
    color: #1f2937;
  }

  /* Clean Table Styling */
  .soap-table {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--soap-border);
  }

  .soap-table thead {
    background: var(--soap-bg-light);
    border-bottom: 2px solid var(--soap-border);
  }

  .soap-table thead th {
    border: none;
    padding: 12px;
    font-weight: 600;
    font-size: 13px;
    color: var(--soap-text);
  }

  .soap-table tbody tr {
    transition: background 0.15s ease;
    border-bottom: 1px solid #f3f4f6;
  }

  .soap-table tbody tr:hover {
    background: var(--soap-bg-light);
  }

  .soap-table tbody td {
    padding: 12px;
    font-size: 13px;
    vertical-align: middle;
  }

  /* Action Buttons in Table */
  .soap-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    margin-right: 4px;
    vertical-align: middle;
  }

  .soap-action-copy {
    background: #f3f4f6;
    color: #4b5563;
  }

  .soap-action-copy:hover {
    background: #e5e7eb;
    color: #1f2937;
  }

  .soap-action-edit {
    background: #3b82f6;
    color: white;
  }

  .soap-action-edit:hover {
    background: #2563eb;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
  }

  .soap-action-delete {
    background: #ef4444;
    color: white;
  }

  .soap-action-delete:hover {
    background: #dc2626;
    box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
  }

  /* PDF Button - Green */
  a.soap-action-btn {
    background: #10b981;
    color: white;
    text-decoration: none;
  }

  a.soap-action-btn:hover {
    background: #059669;
    color: white;
    text-decoration: none;
    box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
  }

  /* Scrollbar Styling */
  .soap-scroll::-webkit-scrollbar {
    width: 6px;
  }

  .soap-scroll::-webkit-scrollbar-track {
    background: #f3f4f6;
  }

  .soap-scroll::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
  }

  .soap-scroll::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .vital-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .soap-card {
      margin-bottom: 16px;
    }
  }
</style>

<div class="row">
  <!-- Kolom kiri: Form SOAP -->
  <div class="col-lg-7 col-md-12">
    <div class="soap-card">
      <div class="soap-header soap-header-primary">
        <h5 class="m-0"><i class="fa fa-file-medical"></i> Form SOAP - Rekam Medis</h5>
      </div>
      <div class="card-body p-4">
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
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <label for="tgl_perawatan" class="soap-label">
                <i class="fa fa-calendar-alt"></i> Tanggal Perawatan
              </label>
              <input type="date" name="tgl_perawatan" id="tgl_perawatan" class="form-control soap-form-control"
                tabindex="1">
            </div>
            <div class="col-md-6 mb-3">
              <label for="jam_rawat" class="soap-label">
                <i class="fa fa-clock"></i> Jam Rawat
              </label>
              <input type="text" name="jam_rawat" id="jam_rawat" class="form-control soap-form-control"
                placeholder="HH:MM:SS" tabindex="2">
            </div>
          </div>

          <!-- Tanda Vital Section -->
          <div class="soap-section">
            <div class="soap-section-title">
              <i class="fa fa-heartbeat"></i> Tanda Vital
            </div>

            <div class="vital-grid">
              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-thermometer-half text-danger"></i> Suhu (°C)
                </label>
                <input type="number" step="0.1" name="suhu_tubuh" id="suhu_tubuh"
                  class="form-control soap-form-control form-control-sm" placeholder="36.5" tabindex="3">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-heartbeat text-danger"></i> Tensi
                </label>
                <input type="text" name="tensi" id="tensi" class="form-control soap-form-control form-control-sm"
                  placeholder="120/80" tabindex="4">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-heart text-danger"></i> Nadi (BPM)
                </label>
                <input type="number" step="0.1" name="nadi" id="nadi"
                  class="form-control soap-form-control form-control-sm" placeholder="72" tabindex="5">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-lungs text-info"></i> Respirasi
                </label>
                <input type="number" step="0.1" name="respirasi" id="respirasi"
                  class="form-control soap-form-control form-control-sm" placeholder="16" tabindex="6">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-wind text-info"></i> SPO2 (%)
                </label>
                <input type="number" step="0.1" name="spo2" id="spo2"
                  class="form-control soap-form-control form-control-sm" placeholder="98" tabindex="7">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-brain text-purple"></i> GCS
                </label>
                <input type="text" name="gcs" id="gcs" class="form-control soap-form-control form-control-sm"
                  placeholder="15" tabindex="8">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-weight text-success"></i> Berat (kg)
                </label>
                <input type="number" step="0.1" name="berat" id="berat"
                  class="form-control soap-form-control form-control-sm" placeholder="65" tabindex="9">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-ruler-vertical text-success"></i> Tinggi (cm)
                </label>
                <input type="number" step="0.1" name="tinggi" id="tinggi"
                  class="form-control soap-form-control form-control-sm" placeholder="170" tabindex="10">
              </div>

              <div class="vital-item" style="grid-column: span 2;">
                <label class="soap-label small mb-2">
                  <i class="fa fa-eye text-primary"></i> Kesadaran
                </label>
                <select name="kesadaran" id="kesadaran" class="form-control soap-form-control form-control-sm"
                  tabindex="11">
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

              <div class="vital-item" style="grid-column: span 2;">
                <label class="soap-label small mb-2">
                  <i class="fa fa-allergies text-warning"></i> Alergi
                </label>
                <input type="text" name="alergi" id="alergi" class="form-control soap-form-control form-control-sm"
                  placeholder="Tidak ada alergi" tabindex="12">
              </div>

              <div class="vital-item">
                <label class="soap-label small mb-2">
                  <i class="fa fa-circle-notch text-secondary"></i> Lingkar Perut
                </label>
                <input type="number" step="0.1" name="lingkar_perut" id="lingkar_perut"
                  class="form-control soap-form-control form-control-sm" placeholder="80" tabindex="13">
              </div>
            </div>
          </div>

          <!-- SOAP Section -->
          <div class="soap-section">
            <div class="soap-section-title">
              <i class="fa fa-stethoscope"></i> Data SOAP
            </div>

            <div class="row">
              <!-- Kolom Kiri -->
              <div class="col-md-6">
                <!-- Subjektif -->
                <div class="soap-field-group">
                  <label for="keluhan" class="soap-label label-subjective">
                    <i class="fa fa-comments"></i> S - Subjektif (Keluhan)
                  </label>
                  <textarea name="keluhan" id="keluhan" class="form-control soap-textarea" rows="4"
                    placeholder="Keluhan utama pasien..." tabindex="14"></textarea>
                </div>

                <!-- Asesmen -->
                <div class="soap-field-group">
                  <label for="penilaian" class="soap-label label-assessment">
                    <i class="fa fa-diagnoses"></i> A - Asesmen (Penilaian)
                  </label>
                  <textarea name="penilaian" id="penilaian" class="form-control soap-textarea" rows="4"
                    placeholder="Diagnosis dan penilaian..." tabindex="16"></textarea>
                </div>

                <!-- Instruksi -->
                <div class="soap-field-group">
                  <label for="instruksi" class="soap-label label-instruction">
                    <i class="fa fa-file-medical-alt"></i> Instruksi Medis
                  </label>
                  <textarea name="instruksi" id="instruksi" class="form-control soap-textarea" rows="4"
                    placeholder="Instruksi dokter..." tabindex="18"></textarea>
                </div>
              </div>

              <!-- Kolom Kanan -->
              <div class="col-md-6">
                <!-- Objektif -->
                <div class="soap-field-group">
                  <label for="pemeriksaan" class="soap-label label-objective">
                    <i class="fa fa-search"></i> O - Objektif (Pemeriksaan)
                  </label>
                  <textarea name="pemeriksaan" id="pemeriksaan" class="form-control soap-textarea" rows="4"
                    placeholder="Hasil pemeriksaan fisik..." tabindex="15"></textarea>
                </div>

                <!-- Plan -->
                <div class="soap-field-group">
                  <label for="rtl" class="soap-label label-plan">
                    <i class="fa fa-clipboard-list"></i> P - Plan (RTL)
                  </label>
                  <textarea name="rtl" id="rtl" class="form-control soap-textarea" rows="4"
                    placeholder="Rencana tindak lanjut..." tabindex="17"></textarea>
                </div>

                <!-- Evaluasi -->
                <div class="soap-field-group">
                  <label for="evaluasi" class="soap-label label-evaluation">
                    <i class="fa fa-chart-line"></i> Evaluasi
                  </label>
                  <textarea name="evaluasi" id="evaluasi" class="form-control soap-textarea" rows="4"
                    placeholder="Evaluasi hasil..." tabindex="19"></textarea>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" id="cancelEdit" class="soap-btn soap-btn-cancel" tabindex="21">
              <i class="fa fa-times"></i> Batal
            </button>
            <button type="submit" class="soap-btn soap-btn-save" tabindex="20">
              <i class="fa fa-save"></i> Simpan SOAP
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kolom kanan: Riwayat SOAP -->
  <div class="col-lg-5 col-md-12">
    <div class="soap-card">
      <div class="soap-header d-flex justify-content-between align-items-center"
        style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%) !important; padding: 16px 20px;">
        <h5 class="m-0" style="color: white !important;"><i class="fa fa-history"></i> Riwayat SOAP</h5>
        <button id="btnFilterRiwayat" class="btn btn-sm"
          style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important; color: white !important; border: none !important; font-weight: 600; padding: 6px 12px; font-size: 13px;">
          <i class="fa fa-filter"></i> Filter Tanggal
        </button>
      </div>



      <div class="card-body p-3 soap-scroll" style="max-height: 600px; overflow-y: auto;">
        <table class="table soap-table table-sm mb-0">
          <thead>
            <tr class="text-center">
              <th style="width: 40px;">No</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Pemeriksa</th>
              <th style="width: 100px;">Aksi</th>
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

<!-- Hasil SOAP -->
<div class="soap-card mt-4">
  <div class="soap-header soap-header-result">
    <h6><i class="fa fa-file-alt"></i> Hasil SOAP Saat Ini</h6>
  </div>
  <div class="card-body p-3">
    <div class="table-responsive">
      <table class="table soap-table table-sm mb-0" id="hasilSoapTable">
        <thead>
          <tr>
            <th style="width:35px; text-align:center;">No</th>
            <th style="width:110px;">Tanggal</th>
            <th style="width:60px; text-align:center;">Suhu(°C)</th>
            <th style="width:70px; text-align:center;">Tensi</th>
            <th style="width:60px; text-align:center;">Nadi</th>
            <th style="width:50px; text-align:center;">RR</th>
            <th style="width:60px; text-align:center;">Tinggi</th>
            <th style="width:60px; text-align:center;">Berat</th>
            <th style="width:50px; text-align:center;">GCS</th>
            <th style="width:60px; text-align:center;">SPO2</th>
            <th style="width:100px;">Alergi</th>
            <th>Instruksi & Evaluasi</th>
          </tr>
        </thead>
        <tbody id="hasil-soap-body">
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
    delete: "<?= site_url('soap-ralan/delete'); ?>",
    printPdf: "<?= site_url('soap-ralan/print-pdf'); ?>"
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
      /* ORIGINAL CODE - DISABLED       try {         // Check if table element exists         if (!$('#hasilSoapTable').length) {           console.warn('Table #hasilSoapTable not found in DOM');           return;         }
        // Check if tbody exists and has proper structure         if (!$('#hasilSoapTable tbody').length) {           console.warn('Table tbody not found, skipping DataTable init');           return;         }
        // Destroy existing DataTable instance if exists         if ($.fn.DataTable.isDataTable('#hasilSoapTable')) {           $('#hasilSoapTable').DataTable().clear().destroy();         }
        // Small delay to ensure DOM is ready         setTimeout(function() {           // Re-initialize DataTable           $('#hasilSoapTable').DataTable({             "paging": true,             "lengthChange": true,             "searching": true,             "ordering": true,             "info": true,             "autoWidth": false,             "pageLength": 10,             "order": [[1, 'desc']], // Sort by Tanggal descending             "language": {               "search": "Cari SOAP:",               "lengthMenu": "Tampilkan _MENU_ data per halaman",               "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ SOAP",               "infoEmpty": "Tidak ada data",               "infoFiltered": "(difilter dari _MAX_ total SOAP)",               "zeroRecords": "Tidak ada SOAP yang cocok",               "paginate": {                 "first": "Pertama",                 "last": "Terakhir",                 "next": "Selanjutnya",                 "previous": "Sebelumnya"               }             },             "columnDefs": [               { "orderable": false, "targets": 0 } // Disable sorting on No column             ]           });         }, 100);       } catch (error) {         console.error('Error initializing DataTable:', error);       }       */
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

<!-- Modal Filter SOAP -->
<div class="modal fade" id="modalFilterSOAP" tabindex="-1" aria-labelledby="modalFilterSOAPLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border: none; border-radius: 12px; overflow: hidden;">
      <div class="modal-header"
        style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; padding: 20px;">
        <h5 class="modal-title" id="modalFilterSOAPLabel" style="color: white; font-weight: 600;">
          <i class="fa fa-filter"></i> Filter Tanggal SOAP
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding: 24px;">
        <div class="mb-3">
          <label for="filter_dari_tgl" class="form-label" style="font-weight: 600; color: #374151;">
            <i class="fa fa-calendar-alt text-primary"></i> Dari Tanggal
          </label>
          <input type="date" class="form-control" id="filter_dari_tgl"
            style="border: 2px solid #e5e7eb; padding: 10px; border-radius: 8px;">
        </div>
        <div class="mb-3">
          <label for="filter_sampai_tgl" class="form-label" style="font-weight: 600; color: #374151;">
            <i class="fa fa-calendar-alt text-primary"></i> Sampai Tanggal
          </label>
          <input type="date" class="form-control" id="filter_sampai_tgl"
            style="border: 2px solid #e5e7eb; padding: 10px; border-radius: 8px;">
        </div>
      </div>
      <div class="modal-footer" style="border: none; padding: 16px 24px; background: #f9fafb;">
        <button type="button" class="btn" data-bs-dismiss="modal"
          style="background: #e5e7eb; color: #374151; font-weight: 600; padding: 10px 20px; border-radius: 8px;">
          <i class="fa fa-times"></i> Batal
        </button>
        <button type="button" id="btnCetakFilteredPDF" class="btn"
          style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: 600; padding: 10px 24px; border-radius: 8px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);">
          <i class="fa fa-print"></i> Cetak PDF
        </button>
      </div>
    </div>
  </div>
</div>
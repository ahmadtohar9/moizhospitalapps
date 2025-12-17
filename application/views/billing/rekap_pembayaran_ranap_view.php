<div class="content-wrapper">
  <section class="content-header">
    <h1>Rekap Pembayaran Pasien Ranap</h1>
  </section>

  <section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <form class="form-inline" id="filterForm">
          <label>Tanggal Pulang:</label>
          <input type="date" id="start_date" name="start_date" class="form-control" required>
          <label>s.d</label>
          <input type="date" id="end_date" name="end_date" class="form-control" required>
          <button type="submit" class="btn btn-primary">Tampilkan</button>
          <button type="button" id="exportPdfBtn" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</button>
        </form>
      </div>

      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="rekapTable">
          <thead class="bg-success">
            <tr>
              <th>No.</th>
              <th>RM</th>
              <th>Pasien</th>
              <th>Asuransi</th>
              <th>Kamar</th>
              <th>Perujuk</th>
              <th>Registrasi</th>
              <th>Tindakan</th>
              <th>Obat+Emb+Tsl</th>
              <th>Retur Obat</th>
              <th>Resep Pulang</th>
              <th>Laborat</th>
              <th>Radiologi</th>
              <th>Potongan</th>
              <th>Tambahan</th>
              <th>Kamar+Service</th>
              <th>Operasi</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr class="bg-primary text-white text-center font-weight-bold">
              <td colspan="17" class="text-right">Grand Total</td>
              <td id="total_grand">Rp 0</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>
</div>

<!-- Inject JS -->
<script>
  const API_URL = "<?= base_url('admin/rekapPembayaranRanap/loadData'); ?>";
  const PRINT_URL = "<?= base_url('admin/rekapPembayaranRanap/export_pdf'); ?>";
</script>
<script src="<?= base_url('assets/js/rekapPembayaranRanap.js?v=') . time(); ?>"></script>

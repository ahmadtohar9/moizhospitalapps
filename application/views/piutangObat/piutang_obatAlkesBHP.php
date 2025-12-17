<div class="content-wrapper">
    <section class="content-header">
        <h1>Laporan Piutang Obat / Alkes / BHP</h1>
    </section>
    <section class="content">
        <!-- Box Filter Data -->
        <div class="box">
    <div class="box-header">
        <h3 class="box-title">Filter Data</h3>
    </div>
    <div class="box-body">
        <form id="filterForm">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai (Faktur):</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir (Faktur):</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="supplier">Supplier:</label>
                        <select id="supplier" name="supplier" class="form-control">
                            <option value="">-- Semua Supplier --</option>
                            <?php foreach ($supplier_list as $supplier): ?>
                                <option value="<?= $supplier['kode_suplier']; ?>"><?= $supplier['nama_suplier']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">Status Pembayaran:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">-- Semua Status --</option>
                            <option value="Belum Dibayar">Belum Dibayar</option>
                            <option value="Sudah Dibayar">Sudah Dibayar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 text-right">
                    <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                    <button type="button" id="printButton" class="btn btn-success">Cetak PDF</button>
                    <!-- <button type="button" id="excelButton" class="btn btn-warning">Export Excel</button> -->
                    <button type="button" id="copyButton" class="btn btn-info">Copy</button>
                </div>
            </div>
        </form>
    </div>
</div>

        <!-- Box Data Piutang -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Piutang Obat / Alkes / BHP</h3>
            </div>
            <div class="box-body">
                <div style="overflow-x: auto;">
                    <table id="piutangTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Tgl Faktur</th>
                                <th>Tgl Tempo</th>
                                <th>Supplier</th>
                                <th>Total Obat</th>
                                <th>PPN</th>
                                <th>Meterai</th>
                                <th>Total Tagihan</th>
                                <th>Status</th>
                                <th>Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Akan diisi via AJAX -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8" style="text-align: right;">Total Tagihan:</th>
                                <th id="totalTagihan" class="text-right">Rp 0</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

    <script>
    const API_URL_PIUTANG = "<?= base_url('PiutangObatAlkesBHPController/get_data'); ?>";
    const PRINT_URL_PIUTANG = "<?= base_url('PiutangObatAlkesBHPController/laporanPenerimaanPiutangObat_pdf'); ?>";
    const EXCEL_URL_PIUTANG = "<?= base_url('PiutangObatAlkesBHPController/export_excel'); ?>";
</script>

</script>
<script src="<?= base_url('assets/js/laporanPiutangObat.js'); ?>"></script>


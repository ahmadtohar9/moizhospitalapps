<div class="content-wrapper">
    <section class="content-header">
        <h1>Laporan Piutang Pasien Rawat Inap</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Filter Data</h3>
            </div>
            <div class="box-body">
                <form id="filterForm">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="penjab">Penjamin:</label>
                        <select id="penjab" name="penjab" class="form-control">
                            <option value="">-- Pilih Penjamin --</option>
                            <?php foreach ($penjab_list as $penjab): ?>
                                <option value="<?= $penjab['png_jawab']; ?>"><?= $penjab['png_jawab']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                    <button type="button" id="printButton" class="btn btn-success">Cetak PDF</button>
                </form>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Piutang Pasien</h3>
            </div>
            <div class="box-body">
                <!-- Tambahkan wrapper untuk scroll horizontal -->
                <div style="overflow-x: auto;">
                    <table id="piutangTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Rawat</th>
                                <th>No. Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Asuransi</th>
                                <th>Total Piutang</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align: right;">Total Piutang:</th>
                                <th id="totalPiutang">Rp 0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Tambahkan JavaScript -->
<script>
    const API_URL_RANAP = "<?= base_url('admin/piutangPasienRanap/get_data'); ?>";
    const PRINT_URL_RANAP = "<?= base_url('admin/piutangPasienRanap/print_pdf'); ?>";
</script>
<script src="<?= base_url('assets/js/piutangRanap.js'); ?>"></script>

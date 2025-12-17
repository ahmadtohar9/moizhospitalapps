<div class="content-wrapper">
    <section class="content-header">
        <h1>Laporan Pasien Rawat Jalan</h1>
    </section>

    <section class="content">
        <!-- Filter Box -->
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Filter Laporan</h3>
            </div>
            <div class="box-body">
                <form id="filterForm" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                        <input type="date" id="start_date" name="tgl_awal" class="form-control" required>
                    </div>
                    <div class="form-group mr-2">
                        <label for="end_date" class="mr-2">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="tgl_akhir" class="form-control" required>
                    </div>
                    <div class="form-group mr-2">
                        <label for="dokter" class="mr-2">Dokter:</label>
                        <select id="dokter" name="kd_dokter" class="form-control">
                            <option value="">-- Semua Dokter --</option>
                            <?php foreach ($dokter as $d): ?>
                                <option value="<?= $d->kd_dokter ?>"><?= $d->nm_dokter ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" id="filterButton" class="btn btn-primary">Tampilkan</button>
                    <a href="#" target="_blank" id="printPdf" class="btn btn-danger ml-2">
                        <i class="fa fa-file-pdf-o"></i> Cetak PDF
                    </a>
                </form>
            </div>
        </div>

        <!-- Ringkasan Dokter -->
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Total Pasien per Dokter</h3>
            </div>
            <div class="box-body">
                <div id="cardSummary" class="row"></div>
            </div>
        </div>

        <!-- Hasil Laporan -->
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Data Pasien</h3>
            </div>
            <div class="box-body">
                <div style="overflow-x:auto;">
                    <table id="laporanTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Rawat</th>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>No.HP</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS Config & Script -->
<script>
    const API_URL = "<?= base_url('admin/lapRajalDokter/get_data'); ?>";
    const PRINT_URL = "<?= base_url('admin/lapRajalDokter/print_pdf'); ?>";
</script>
<script src="<?= base_url('assets/js/lapRajalDokter.js'); ?>?v=<?= time() ?>"></script>


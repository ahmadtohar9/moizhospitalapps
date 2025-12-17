<div class="content-wrapper">
    <section class="content-header">
        <h1>Laporan Billing Pasien Rawat Jalan</h1>
    </section>
    <section class="content">
        <!-- Box Filter Data -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Filter Data</h3>
            </div>
            <div class="box-body">
                <form id="filterForm" class="form-inline">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="dokter">Dokter:</label>
                            <select id="dokter" name="dokter" class="form-control">
                                <option value="">-- Pilih Dokter --</option>
                                <?php foreach ($dokter_list as $dokter): ?>
                                    <option value="<?= $dokter['kd_dokter']; ?>"><?= $dokter['nm_dokter']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                            <button type="button" id="printButton" class="btn btn-success">Cetak PDF</button>
                            <button type="button" id="copyButton" class="btn btn-info">Copy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> 

        <!-- Box Data Billing -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Billing Pasien</h3>
            </div>
            <div class="box-body">
                <div style="overflow-x: auto;">
                    <table id="billingTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>No. Rawat</th>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Administrasi</th>
                                <th>Total Obat</th>
                                <th>Total Laboratorium</th>
                                <th>Tindakan Konsul</th>
                                <th>USG</th>
                                <th>Tindakan Lain</th>
                                <th>Sewa Ruangan</th>
                                <th>Jasa Layanan</th>
                                <th>Jasa Dokter</th>
                                <th>Tambahan Biaya</th>
                                <th>Potongan Biaya</th>
                                <th>Total Tagihan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="16" style="text-align: right;">Total Tagihan:</th>
                                <th id="totalTagihan">Rp 0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Konstanta API -->
<script>
    const API_URL_RALAN = "<?= base_url('admin/billRalan/get_data'); ?>";
    const PRINT_URL_RALAN = "<?= base_url('admin/billRalan/print_pdf'); ?>";
</script>

<script src="<?= base_url('assets/js/billRalan.js'); ?>"></script>

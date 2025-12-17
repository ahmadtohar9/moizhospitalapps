<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Pasien Rawat Jalan</h1>
    </section>
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Filter Data</h3>
            </div>
            <div class="box-body">
                <form id="filterForm" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                        <input type="date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group mr-2">
                        <label for="end_date" class="mr-2">Tanggal Akhir:</label>
                        <input type="date" id="end_date" class="form-control">
                    </div>
                    <div class="form-group mr-2">
                        <label for="penjab" class="mr-2">Penjamin:</label>
                        <select id="penjab" class="form-control">
                            <option value="">-- Pilih Penjamin --</option>
                            <?php foreach ($penjab_list as $penjab): ?>
                                <option value="<?= $penjab['png_jawab']; ?>"><?= $penjab['png_jawab']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label for="status_bayar" class="mr-2">Status Bayar:</label>
                        <select id="status_bayar" class="form-control">
                            <option value="">-- Semua --</option>
                            <option value="Sudah Bayar">Sudah Bayar</option>
                            <option value="Belum Bayar">Belum Bayar</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label for="status_periksa" class="mr-2">Status Periksa:</label>
                        <select id="status_periksa" class="form-control">
                            <option value="">-- Semua --</option>
                            <option value="Sudah">Sudah</option>
                            <option value="Belum">Belum</option>
                        </select>
                    </div>
                    <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Data Pasien</h3>
            </div>
            <div class="box-body">
                <!-- Wrapper untuk scroll horizontal -->
                <div style="overflow-x: auto;">
                    <table id="pasienTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No.Rawat</th>
                                <th>RM</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Penjamin</th>
                                <th>Poliklinik</th>
                                <th>StatusPeriksa</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
  window.API_URL          = "<?= site_url('dokter/ralan/get-data'); ?>";
  window.OPEN_BASE_DOKTER = "<?= site_url('dokter/ralan/rekam-medis'); ?>";
</script>
<script src="<?= base_url('assets/js/dokterRalan.js?v=4'); ?>"></script>



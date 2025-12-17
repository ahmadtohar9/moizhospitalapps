<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Rekap Pembayaran Rawat Jalan</h1>
    </section>
    <section class="content">
        <!-- Filter Box -->
        <div class="box box-info">
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
                        <div class="col-md-2">
                            <label for="dokter">Dokter:</label>
                            <select id="dokter" class="form-control">
                                <option value="">-- Semua Dokter --</option>
                                <?php foreach ($dokter_list as $d): ?>
                                    <option value="<?= $d['kd_dokter'] ?>"><?= $d['nm_dokter'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="penjab">Cara Bayar:</label>
                            <select id="penjab" class="form-control">
                                <option value="">-- Semua --</option>
                                <?php foreach ($penjab_list as $pj): ?>
                                    <option value="<?= $pj['kd_pj'] ?>"><?= $pj['png_jawab'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="poli">Poli:</label>
                            <select id="poli" class="form-control">
                                <option value="">-- Semua --</option>
                                <?php foreach ($poli_list as $pl): ?>
                                    <option value="<?= $pl['kd_poli'] ?>"><?= $pl['nm_poli'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="button" id="filterButton" class="btn btn-primary">Tampilkan</button>
                            <button type="button" id="printButton" class="btn btn-success">Cetak PDF</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Rekap Pembayaran</h3>
            </div>
            <div class="box-body">
                <div style="overflow-x: auto">
                    <table id="rekapTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No Nota</th>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Asuransi</th>
                                <th>Poli</th>
                                <th>Perujuk</th>
                                <th>Registrasi</th>
                                <th>Obat</th>
                                <th>Ralan</th>
                                <th>Operasi</th>
                                <th>Laborat</th>
                                <th>Radiologi</th>
                                <th>Tambahan</th>
                                <th>Potongan</th>
                                <th>Total</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="15" class="text-right">Total:</th>
                                <th id="totalSemua">Rp 0</th>
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
    const API_URL = "<?= base_url('admin/rekapPembayaranRalan/get_data'); ?>";
    const PRINT_URL = "<?= base_url('admin/rekapPembayaranRalan/print_pdf'); ?>";
</script>
<script src="<?= base_url('assets/js/rekapPembayaranRalan.js') ?>"></script>
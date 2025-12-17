<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-link"></i> Mapping BPJS
            <small>Pemetaan Data RS ke BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li class="active">Mapping BPJS</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info">
            <h4><i class="fa fa-info-circle"></i> Informasi</h4>
            <p>Halaman ini digunakan untuk melakukan pemetaan (mapping) data Rumah Sakit ke kode BPJS.
                Mapping yang akurat sangat penting untuk kelancaran proses bridging dengan BPJS.</p>
        </div>

        <!-- Statistics Row -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= isset($stats['total_mapped']) ? $stats['total_mapped'] : 0; ?></h3>
                        <p>Total Mapping</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= isset($stats['progress']) ? $stats['progress'] : 0; ?>%</h3>
                        <p>Progress Mapping</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= isset($stats['unmapped']) ? $stats['unmapped'] : 0; ?></h3>
                        <p>Belum Mapping</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-warning"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?= isset($stats['total_poli_bpjs']) ? $stats['total_poli_bpjs'] : 0; ?></h3>
                        <p>Referensi BPJS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================== -->
        <!-- ROW 1: DATA KLINIS UTAMA (Core Mapping) -->
        <!-- =========================================================== -->
        <h4 class="page-header"><i class="fa fa-star text-orange"></i> Data Klinis Utama</h4>
        <div class="row">
            <!-- Card 1: Mapping Poli -->
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hospital-o"></i> Mapping Poli</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-aqua" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-building-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">TOTAL POLI RS</span>
                                <span class="info-box-number"><?= defined('TOTAL_POLI') ? TOTAL_POLI : $this->db->count_all('poliklinik'); ?></span>
                                <span class="progress-description">Mapping Unit</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Mapping Poli RS ke Poli BPJS.</p>
                        <a href="<?= base_url('bpjs/mapping/poli'); ?>" class="btn btn-primary btn-block btn-sm">Buka Mapping Poli</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Mapping Dokter -->
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-md"></i> Mapping Dokter</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-green" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">TOTAL DOKTER RS</span>
                                <span class="info-box-number"><?= $this->db->count_all('dokter'); ?></span>
                                <span class="progress-description">Mapping DPJP</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Mapping Dokter RS ke DPJP BPJS.</p>
                        <a href="<?= base_url('bpjs/mapping/dokter'); ?>" class="btn btn-success btn-block btn-sm">Buka Mapping Dokter</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Ref Diagnosa -->
            <div class="col-md-3">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-heartbeat"></i> Ref Diagnosa</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                         <div class="info-box bg-red" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">REFERENSI ICD-10</span>
                                <span class="info-box-number">Diagnosa</span>
                                <span class="progress-description">Kamus Penyakit</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Pencarian Kode Diagnosa ICD-10.</p>
                        <a href="<?= base_url('bpjs/mapping/diagnosa'); ?>" class="btn btn-danger btn-block btn-sm">Buka Ref Diagnosa</a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Ref Prosedur -->
            <div class="col-md-3">
                <div class="box box-purple">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-scissors"></i> Ref Prosedur</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-purple" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-list-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">REFERENSI ICD-9</span>
                                <span class="info-box-number">Prosedur</span>
                                <span class="progress-description">Kamus Tindakan</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Pencarian Kode Tindakan ICD-9.</p>
                        <a href="<?= base_url('bpjs/mapping/prosedur'); ?>" class="btn bg-purple btn-block btn-sm">Buka Ref Prosedur</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================== -->
        <!-- ROW 2: DATA REFERENSI & WILAYAH -->
        <!-- =========================================================== -->
        <h4 class="page-header"><i class="fa fa-book text-blue"></i> Data Referensi & Wilayah</h4>
        <div class="row">
            <!-- Card 5: Ref Faskes -->
             <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hospital-o"></i> Ref Faskes</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-orange" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">DATA FASKES</span>
                                <span class="info-box-number">PPK 1 & 2</span>
                                <span class="progress-description">Ref Rujukan</span>
                            </div>
                        </div>
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Pencarian Faskes/RS Rujukan.</p>
                        <a href="<?= base_url('bpjs/mapping/faskes'); ?>" class="btn btn-warning btn-block btn-sm">Buka Ref Faskes</a>
                    </div>
                </div>
            </div>

            <!-- Card 6: Ref Lokasi -->
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-map-marker"></i> Ref Lokasi</h3>
                        <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                         <div class="info-box bg-blue" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-globe"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">DATA WILAYAH</span>
                                <span class="info-box-number">Prop/Kab/Kec</span>
                                <span class="progress-description">Ref Geografis</span>
                            </div>
                        </div>
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Referensi Propinsi, Kab, Kec.</p>
                        <a href="<?= base_url('bpjs/mapping/lokasi'); ?>" class="btn btn-primary btn-block btn-sm">Buka Ref Lokasi</a>
                    </div>
                </div>
            </div>

             <!-- Card 7: Diagnosa PRB -->
            <div class="col-md-3">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-medkit"></i> Diagnosa PRB</h3>
                         <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-maroon" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-heartbeat"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PROGRAM PRB</span>
                                <span class="info-box-number">Penyakit</span>
                                <span class="progress-description">Ref Kronis</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Daftar Diagnosa Program PRB.</p>
                        <a href="<?= base_url('bpjs/mapping/prb'); ?>" class="btn bg-maroon btn-block btn-sm">Buka Diagnosa PRB</a>
                    </div>
                </div>
            </div>

            <!-- Card 8: Obat PRB -->
             <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-flask"></i> Obat PRB</h3>
                         <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                        <div class="info-box bg-teal" style="min-height: 80px;">
                            <span class="info-box-icon"><i class="fa fa-leaf"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PROGRAM PRB</span>
                                <span class="info-box-number">Obat</span>
                                <span class="progress-description">Ref Farmasi</span>
                            </div>
                        </div>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Daftar Obat Program PRB.</p>
                        <a href="<?= base_url('bpjs/mapping/obat_prb'); ?>" class="btn bg-teal btn-block btn-sm">Buka Obat PRB</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================== -->
        <!-- ROW 3: REFERENSI LAINNYA -->
        <!-- =========================================================== -->
        <h4 class="page-header"><i class="fa fa-cogs text-gray"></i> Referensi Lainnya</h4>
        <div class="row">
            <!-- Card 9: Cara Keluar -->
             <div class="col-md-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-sign-out"></i> Cara Keluar</h3>
                         <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Referensi Status Pulang.</p>
                        <a href="<?= base_url('bpjs/mapping/cara_keluar'); ?>" class="btn btn-default btn-block btn-sm">Buka Referensi</a>
                    </div>
                </div>
            </div>

             <!-- Card 10: Kelas Rawat -->
             <div class="col-md-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-bed"></i> Kelas Rawat</h3>
                         <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Referensi Kelas Rawat.</p>
                        <a href="<?= base_url('bpjs/mapping/kelas_rawat'); ?>" class="btn btn-default btn-block btn-sm">Buka Referensi</a>
                    </div>
                </div>
            </div>

             <!-- Card 11: Ruang Rawat -->
             <div class="col-md-3">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-building"></i> Ruang Rawat</h3>
                         <span class="label label-success pull-right">ACTIVE</span>
                    </div>
                    <div class="box-body">
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Referensi Ruang Rawat.</p>
                        <a href="<?= base_url('bpjs/mapping/ruang_rawat'); ?>" class="btn btn-default btn-block btn-sm">Buka Referensi</a>
                    </div>
                </div>
            </div>

            <!-- Card 12: Sync Tool -->
            <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-refresh"></i> Sync Data</h3>
                         <span class="label label-warning pull-right">TOOLS</span>
                    </div>
                    <div class="box-body">
                         <p class="text-muted"><i class="fa fa-info-circle"></i> Sinkronisasi Data BPJS.</p>
                        <button class="btn btn-warning btn-block btn-sm" onclick="syncReferensi()">
                            <i class="fa fa-refresh"></i> Sync Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // BASE_URL already defined in header.php

    function syncReferensi() {
        Swal.fire({
            title: 'Sync Referensi BPJS',
            html: 'Pilih referensi yang ingin di-sync:',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sync Poli',
            cancelButtonText: 'Batal',
            showDenyButton: true,
            denyButtonText: 'Sync Semua (Coming Soon)'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke sync poli
                window.location.href = '<?= base_url("bpjs/mapping/poli"); ?>';
            }
        });
    }
</script>

<style>
    .box {
        transition: all 0.3s ease;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        z-index: 10;
    }

    .info-box {
        margin-bottom: 15px;
        box-shadow: none;
        border: 1px solid #eee;
    }
    
    .btn-block {
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: bold;
    }
</style>
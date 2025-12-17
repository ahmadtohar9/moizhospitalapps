<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-sign-out"></i> Referensi Cara Keluar
            <small>Status Pulang Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Cara Keluar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <a href="<?= base_url('bpjs/mapping'); ?>" class="btn btn-default"><i
                                class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Daftar Cara Keluar BPJS</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <thead class="bg-light-blue">
                                <tr>
                                    <th style="width: 100px; text-align: center;">Kode</th>
                                    <th>Keterangan Cara Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list_data) && is_array($list_data)): ?>
                                    <?php foreach ($list_data as $item): ?>
                                        <tr>
                                            <td align="center"><span class="badge bg-blue"><?= $item['kode']; ?></span></td>
                                            <td style="font-weight: bold;"><?= $item['nama']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center text-muted" style="padding: 20px;">
                                            <i class="fa fa-info-circle"></i> Tidak ada data / Gagal mengambil data dari
                                            BPJS
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
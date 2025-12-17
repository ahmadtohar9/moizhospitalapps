<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Registrasi Periksa Hari Ini
            <small>Pendaftaran</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pendaftaran</a></li>
            <li class="active">Registrasi</li>
        </ol>
    </section>

    <style>
        /* Remove DataTables Sorting Highlight */
        table.dataTable.display tbody tr.odd>.sorting_1,
        table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
            background-color: #f9f9f9;
            /* Match stripe color or white */
        }

        table.dataTable.display tbody tr.even>.sorting_1,
        table.dataTable.order-column.stripe tbody tr.even>.sorting_1 {
            background-color: #ffffff;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        /* FIX: Select2 appearing above Modals/Backdrop */
        .select2-container {
            z-index: 0 !important;
        }

        .select2-dropdown {
            z-index: 9999 !important;
        }
    </style>

    <section class="content">
        <form id="form_reg" class="form-horizontal">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Data Registrasi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <!-- COLUMN 1: Registration Details -->
                        <div class="col-md-4">
                            <h4 class="text-primary"><i class="fa fa-file-text-o"></i> Data Registrasi</h4>
                            <hr style="margin: 5px 0 15px 0;">

                            <div class="form-group">
                                <label class="col-sm-4 control-label input-sm">No. Reg</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="no_reg" class="form-control input-sm"
                                            placeholder="Auto" readonly>
                                        <span class="input-group-addon"><input type="checkbox" id="chk_auto_reg"
                                                checked></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label input-sm">No. Rawat</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_rawat" id="no_rawat" class="form-control input-sm"
                                        value="<?= $no_rawat_next ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label input-sm">Tgl. Reg</label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_registrasi" id="tgl_registrasi"
                                        class="form-control input-sm" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label input-sm">Jam</label>
                                <div class="col-sm-8">
                                    <input type="time" name="jam_reg" id="jam_reg" step="1"
                                        class="form-control input-sm" value="<?= date('H:i:s') ?>">
                                </div>
                            </div>
                        </div>

                        <!-- COLUMN 2: Patient & PJ -->
                        <div class="col-md-4">
                            <h4 class="text-primary"><i class="fa fa-user"></i> Data Pasien & PJ</h4>
                            <hr style="margin: 5px 0 15px 0;">

                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Pasien</label>
                                <div class="col-sm-9">
                                    <select name="no_rkm_medis" id="no_rkm_medis" class="form-control input-sm"
                                        style="width: 100%;"></select>
                                    <input type="text" id="nm_pasien_display" class="form-control input-sm" readonly
                                        placeholder="Nama Pasien" style="margin-top:5px; display:none;">
                                    <input type="hidden" id="no_tlp_pasien_local">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">P. Jawab</label>
                                <div class="col-sm-9">
                                    <input type="text" name="p_jawab" id="p_jawab" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Hubungan</label>
                                <div class="col-sm-9">
                                    <select name="hubunganpj" class="form-control input-sm">
                                        <option value="DIRI SENDIRI">DIRI SENDIRI</option>
                                        <option value="SUAMI">SUAMI</option>
                                        <option value="ISTRI">ISTRI</option>
                                        <option value="ANAK">ANAK</option>
                                        <option value="AYAH">AYAH</option>
                                        <option value="IBU">IBU</option>
                                        <option value="SAUDARA">SAUDARA</option>
                                        <option value="LAIN-LAIN">LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Alamat PJ</label>
                                <div class="col-sm-9">
                                    <input type="text" name="almt_pj" id="almt_pj" class="form-control input-sm">
                                </div>
                            </div>

                            <!-- BPJS BRIDGING BUTTONS (Moved Here) -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm"></label>
                                <div class="col-sm-9">
                                    <button type="button" class="btn btn-success btn-block btn-sm btn-flat"
                                        data-toggle="modal" data-target="#modal_bpjs_menu">
                                        <i class="fa fa-medkit"></i> BRIDGING BPJS
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMN 3: Medical Details -->
                        <div class="col-md-4">
                            <h4 class="text-primary"><i class="fa fa-stethoscope"></i> Layanan Medis</h4>
                            <hr style="margin: 5px 0 15px 0;">

                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Dokter</label>
                                <div class="col-sm-9">
                                    <select name="kd_dokter" id="kd_dokter" class="form-control input-sm"
                                        style="width: 100%;"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Poli</label>
                                <div class="col-sm-9">
                                    <select name="kd_poli" id="kd_poli" class="form-control input-sm"
                                        style="width: 100%;"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Bayar</label>
                                <div class="col-sm-9">
                                    <select name="kd_pj" id="kd_pj" class="form-control input-sm"
                                        style="width: 100%;"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label input-sm">Status</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="stts_daftar" class="form-control input-sm">
                                                <option value="Lama">Lama</option>
                                                <option value="Baru">Baru</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-6" style="padding-left:0;">
                                            <input type="text" name="asal_rujukan" placeholder="Rujukan?"
                                                class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>
                                <!-- BPJS BRIDGING BUTTONS REMOVED FROM HERE -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="button" onclick="simpan_reg()" class="btn btn-primary"><i class="fa fa-save"></i>
                        Simpan</button>
                    <button type="reset" class="btn btn-default">Batal</button>
                </div>
            </div>
        </form>
        <!-- LIST DATA TABLE -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pendaftaran Hari Ini</h3>
            </div>
            <div class="box-body">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-2">
                        <label>Dari Tanggal</label>
                        <input type="date" id="filter_tgl_mulai" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>Sampai Tanggal</label>
                        <input type="date" id="filter_tgl_akhir" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Status Bayar</label>
                        <select id="filter_status_bayar" class="form-control">
                            <option value="Semua">Semua</option>
                            <option value="Sudah Bayar">Sudah Bayar</option>
                            <option value="Belum Bayar">Belum Bayar</option>
                        </select>
                    </div>
                    <div class="col-md-6 text-right" style="padding-top:25px;">
                        <span class="btn btn-info btn-flat"><i class="fa fa-users"></i> Total: <span
                                id="stat_total">0</span></span>
                        <span class="btn btn-success btn-flat"><i class="fa fa-check"></i> Lunas: <span
                                id="stat_paid">0</span></span>
                        <span class="btn btn-danger btn-flat"><i class="fa fa-warning"></i> Belum: <span
                                id="stat_unpaid">0</span></span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="20">No</th>
                                <th>No. Rawat</th>
                                <th>Tgl & Jam</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Poli</th>
                                <th>Penanggung Jawab</th>
                                <th>Status</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ==================== MODALS BPJS ==================== -->

<!-- ==================== MODALS BPJS ==================== -->

<!-- MODAL MENU BRIDGING -->
<div class="modal fade" id="modal_bpjs_menu" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Menu Bridging BPJS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Card 1: Cek Peserta -->
                    <div class="col-md-4">
                        <div class="small-box bg-green" style="cursor:pointer;"
                            onclick="$('#modal_bpjs_menu').modal('hide'); setTimeout(function(){ $('#modal_cek_kartu').modal('show'); }, 500);">
                            <div class="inner">
                                <h3>Peserta</h3>
                                <p>Cek Status Kartu</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <a href="#" class="small-box-footer">Pilih <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Card 2: Rujukan Faskes 1 -->
                    <div class="col-md-4">
                        <div class="small-box bg-yellow" style="cursor:pointer;"
                            onclick="$('#modal_bpjs_menu').modal('hide'); setTimeout(function(){ $('#modal_rujukan_pcare').modal('show'); }, 500);">
                            <div class="inner">
                                <h3>Faskes 1</h3>
                                <p>Cek Rujukan PCare</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <a href="#" class="small-box-footer">Pilih <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Card 3: Rujukan Faskes 2 -->
                    <div class="col-md-4">
                        <div class="small-box bg-red" style="cursor:pointer;"
                            onclick="$('#modal_bpjs_menu').modal('hide'); setTimeout(function(){ $('#modal_rujukan_rs').modal('show'); }, 500);">
                            <div class="inner">
                                <h3>Faskes 2</h3>
                                <p>Cek Rujukan RS</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                            <a href="#" class="small-box-footer">Pilih <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CEK PESERTA -->
<div class="modal fade" id="modal_cek_kartu" role="dialog">
    <div class="modal-dialog" style="width: 95%;">
        <div class="modal-content" style="max-height: 90vh; overflow-y: auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pencarian Peserta BPJS & Pembuatan SEP</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Kolom Pencarian -->
                    <div class="col-md-12">
                        <form class="form-horizontal" onsubmit="return false;">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Nomor</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="bpjs_nomor" id="bpjs_nomor"
                                        placeholder="Masukkan No. Kartu / NIK">
                                </div>
                                <label class="col-sm-1 control-label">Jenis</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="bpjs_jenis_kartu" id="bpjs_jenis_kartu">
                                        <option value="kartu">No. Kartu</option>
                                        <option value="nik">NIK</option>
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label">Tgl. SEP</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="bpjs_tgl_sep" id="bpjs_tgl_sep"
                                        value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-block" onclick="cek_peserta_bpjs()"><i
                                            class="fa fa-search"></i> Cek Peserta</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>

                <div id="result_cek_kartu" class="text-center text-muted"></div>

                <!-- FORM SEP (Hidden by default) -->
                <div id="form_sep_area" style="display:none; text-align:left;">
                    <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-file-text-o"></i> Pembuatan SEP</h3>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal" id="form_sep_real">
                                <input type="hidden" id="sep_mode" value="insert">
                                <input type="hidden" id="sep_no_sep_update" name="no_sep">
                                <style>
                                    /* Khanza-like rounded inputs */
                                    .form-control.input-sm {
                                        border-radius: 15px !important;
                                    }

                                    .select2-container .select2-selection--single {
                                        border-radius: 15px !important;
                                    }

                                    .select2-container .select2-selection--single .select2-selection__arrow {
                                        border-top-right-radius: 15px !important;
                                        border-bottom-right-radius: 15px !important;
                                    }

                                    /* Tighten up rows */
                                    .form-group {
                                        margin-bottom: 5px !important;
                                    }
                                </style>

                                <!-- Row 1: No. Rawat, No. RM, Nama Pasien -->
                                <div class="form-group margin-bottom-none">
                                    <label class="col-sm-1 control-label">No.Rawat</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" id="sep_no_rawat" readonly
                                            placeholder="Auto">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control input-sm" id="sep_no_rm" readonly
                                            placeholder="No. RM">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-sm" id="sep_nama_pasien" readonly
                                            placeholder="Nama Pasien">
                                    </div>
                                </div>

                                <!-- Row 2: Tgl Lahir, Peserta, JK, Asal Rujukan -->
                                <div class="form-group margin-bottom-none">
                                    <label class="col-sm-1 control-label">Tgl.Lahir</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control input-sm" id="sep_tgl_lahir" readonly>
                                    </div>
                                    <label class="col-sm-1 control-label">Peserta</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" id="sep_jenis_peserta"
                                            readonly>
                                    </div>
                                    <label class="col-sm-1 control-label">J.K.:</label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control input-sm" id="sep_jk" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- LEFT COLUMN -->
                                    <div class="col-md-6">

                                        <!-- No. Kartu -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">No. Kartu</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_no_kartu"
                                                    name="no_kartu" readonly placeholder="No. Kartu BPJS">
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">PPK Pelayanan</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm"
                                                        id="sep_ppk_pelayanan_kode_disp" readonly style="width: 30%;">
                                                    <input type="text" class="form-control input-sm"
                                                        id="sep_ppk_pelayanan" readonly style="width: 70%;">
                                                </div>
                                                <!-- Hidden store -->
                                                <input type="hidden" id="sep_ppk_pelayanan_kode"
                                                    name="ppk_pelayanan_kode">
                                                <input type="hidden" id="sep_ppk_pelayanan_nama"
                                                    name="ppk_pelayanan_nama">
                                            </div>
                                        </div>

                                        <!-- Asal Rujukan & No SKDP -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Asal Rujukan</label>
                                            <div class="col-sm-4">
                                                <select class="form-control input-sm" id="sep_asal_rujukan"
                                                    name="asal_rujukan">
                                                    <option value="1">1. Faskes 1</option>
                                                    <option value="2">2. Faskes 2 (RS)</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label">No.SKDP</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" id="sep_no_skdp"
                                                    name="no_skdp">
                                            </div>
                                        </div>

                                        <!-- PPK Rujukan -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">PPK Rujukan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm"
                                                    id="sep_ppk_rujukan_txt" placeholder="Ketik nama faskes...">
                                                <input type="hidden" id="sep_ppk_rujukan_kode" name="ppk_rujukan">
                                                <input type="hidden" id="sep_ppk_rujukan_nama" name="ppk_rujukan_nama">
                                            </div>
                                        </div>

                                        <!-- Diagnosa Awal -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Diagnosa Awal</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control input-sm"
                                                    id="sep_diagnosa_kode_disp" placeholder="Kode" readonly>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control input-sm" id="sep_diagnosa_txt"
                                                    placeholder="Ketik nama diagnosa...">
                                                <input type="hidden" id="sep_diagnosa_kode" name="diagnosa_awal">
                                                <input type="hidden" id="sep_diagnosa_nama" name="diagnosa_nama">
                                            </div>
                                        </div>

                                        <!-- Poli Tujuan -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Poli Tujuan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_poli_txt"
                                                    placeholder="Ketik nama poli...">
                                                <input type="hidden" id="sep_poli_kode" name="poli_tujuan">
                                                <input type="hidden" id="sep_poli_nama" name="poli_nama">
                                            </div>
                                        </div>

                                        <!-- DPJP SEP (Pemberi Surat) -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">DPJP SEP</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_dpjp_skdp_txt"
                                                    name="nm_dpjp_skdp"
                                                    placeholder="Ketik nama dokter pemberi surat...">
                                                <input type="hidden" id="sep_dpjp_skdp_kode" name="dpjp_skdp">
                                            </div>
                                        </div>

                                        <!-- Jns Pelayanan, Kelas, Naik -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Jns.Pelayanan</label>
                                            <div class="col-sm-3">
                                                <select class="form-control input-sm" id="sep_jns_pelayanan"
                                                    name="jns_pelayanan">
                                                    <option value="2">2. Ralan</option>
                                                    <option value="1">1. Ranap</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-1 control-label">Kelas</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm" id="sep_kls_rawat_hak"
                                                    name="kls_rawat_hak">
                                                    <option value="3" selected>Kelas 3</option>
                                                    <option value="2">Kelas 2</option>
                                                    <option value="1">Kelas 1</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-1 control-label">Naik</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm" id="sep_naik_kelas"
                                                    name="naik_kelas">
                                                    <option value="">Tidak</option>
                                                    <option value="1">VVIP</option>
                                                    <option value="2">VIP</option>
                                                    <option value="3">Kelas 1</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Pembiayaan, PJ Naik -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Pembiayaan</label>
                                            <div class="col-sm-3">
                                                <select class="form-control input-sm" id="sep_pj_naik_kelas"
                                                    name="pembiayaan">
                                                    <option value="1">1. Pribadi</option>
                                                    <option value="2">2. Pemberi Kerja</option>
                                                    <option value="3">3. Asuransi Kesehatan Tambahan</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label">P.J. Naik</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-sm"
                                                    id="sep_penanggung_jawab" placeholder="Penanggung Jawab..">
                                            </div>
                                        </div>

                                        <!-- Eksekutif, COB, Katarak -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Eksekutif</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm" id="sep_eksekutif"
                                                    name="eksekutif">
                                                    <option value="0">0. Tidak</option>
                                                    <option value="1">1. Ya</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-1 control-label">COB</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm" id="sep_cob" name="cob">
                                                    <option value="0">0. Tidak</option>
                                                    <option value="1">1. Ya</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label"
                                                style="padding-left:0;">Katarak</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm" id="sep_katarak" name="katarak">
                                                    <option value="0">0. Tidak</option>
                                                    <option value="1">1. Ya</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Catatan & No Telp -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Catatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_catatan"
                                                    name="catatan">
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">No. Telp</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_no_telp"
                                                    name="no_telp" placeholder="No. Telp Pasien">
                                            </div>
                                        </div>

                                        <!-- No Rujukan & Tgl Rujukan -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">No.Rujuk</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-sm" id="sep_no_rujukan"
                                                    name="no_rujukan" placeholder="No Rujukan">
                                            </div>
                                            <label class="col-sm-2 control-label">Tgl.Rujuk</label>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control input-sm" id="sep_tgl_rujukan"
                                                    name="tgl_rujukan" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>

                                        <!-- Tgl SEP -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Tgl.SEP</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control input-sm" id="sep_tgl_sep"
                                                    name="tgl_sep" value="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END LEFT COLUMN -->

                                    <!-- RIGHT COLUMN -->
                                    <div class="col-md-6">

                                        <!-- KLL & Tgl Kejadian -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">KLL</label>
                                            <div class="col-sm-4">
                                                <select class="form-control input-sm" id="sep_laka_lantas"
                                                    onchange="toggleLakaInfo()">
                                                    <option value="0">0. Bukan KLL</option>
                                                    <option value="1">1. KLL</option>
                                                    <option value="2">2. KLL (Bukan Lalu Lintas)</option>
                                                    <option value="3">3. KLL (Laka Kerja)</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label laka-field"
                                                style="display:none;">Tgl.Laka</label>
                                            <div class="col-sm-3 laka-field" style="display:none;">
                                                <input type="date" class="form-control input-sm" id="sep_tgl_laka">
                                            </div>
                                        </div>

                                        <!-- Keterangan & No LP -->
                                        <div class="form-group margin-bottom-none laka-field" style="display:none;">
                                            <label class="col-sm-3 control-label">Keterangan</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control input-sm" id="sep_ket_laka">
                                            </div>
                                            <label class="col-sm-1 control-label">No.LP</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" id="sep_no_lp">
                                            </div>
                                        </div>

                                        <!-- Suplesi & No SEP Suplesi -->
                                        <div class="form-group margin-bottom-none laka-field" style="display:none;">
                                            <label class="col-sm-3 control-label">Suplesi</label>
                                            <div class="col-sm-4">
                                                <select class="form-control input-sm" id="sep_suplesi">
                                                    <option value="0">0. Tidak</option>
                                                    <option value="1">1. Ya</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label">No.Suplesi</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" id="sep_no_suplesi">
                                            </div>
                                        </div>

                                        <!-- Propinsi -->
                                        <div class="form-group margin-bottom-none laka-field" style="display:none;">
                                            <label class="col-sm-3 control-label">Propinsi</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_provinsi_laka"></select>
                                            </div>
                                        </div>
                                        <!-- Kabupaten -->
                                        <div class="form-group margin-bottom-none laka-field" style="display:none;">
                                            <label class="col-sm-3 control-label">Kabupaten</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_kab_laka"></select>
                                            </div>
                                        </div>
                                        <!-- Kecamatan -->
                                        <div class="form-group margin-bottom-none laka-field" style="display:none;">
                                            <label class="col-sm-3 control-label">Kecamatan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_kec_laka"></select>
                                            </div>
                                        </div>

                                        <!-- Dr Dituju (Optional/Placeholder) -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Dr Dituju</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_dr_dituju"
                                                    placeholder="Dokter tujuan jika ada...">
                                            </div>
                                        </div>

                                        <!-- Tujuan Kunj, Flag, Penunjang, Asesmen -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Tujuan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_tujuan_kunjungan">
                                                    <option value="0">0. Normal</option>
                                                    <option value="1">1. Prosedur</option>
                                                    <option value="2">2. Konsul Dokter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Flag Prosedur</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_flag_prosedur">
                                                    <option value="">-</option>
                                                    <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                    <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Penunjang</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_penunjang">
                                                    <option value="">-</option>
                                                    <option value="1">Radioterapi</option>
                                                    <option value="2">Kemoterapi</option>
                                                    <option value="3">Rehabilitasi Medik</option>
                                                    <option value="4">Rehabilitasi Psikososial</option>
                                                    <option value="5">Transfusi Darah</option>
                                                    <option value="6">Pelayanan Gigi</option>
                                                    <option value="7">Laboratorium</option>
                                                    <option value="8">USG</option>
                                                    <option value="9">Farmasi</option>
                                                    <option value="10">Lain-Lain</option>
                                                    <option value="11">MRI</option>
                                                    <option value="12">HEMODIALISA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">Asesmen</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-sm" id="sep_asesmen_pelayanan">
                                                    <option value="">-</option>
                                                    <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya
                                                    </option>
                                                    <option value="2">Jam Poli telah berakhir pada hari sebelumnya
                                                    </option>
                                                    <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada
                                                        hari sebelumnya</option>
                                                    <option value="4">Atas Instruksi RS</option>
                                                    <option value="5">Tujuan Kontrol</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- DPJP Layanan (The Main One) -->
                                        <div class="form-group margin-bottom-none">
                                            <label class="col-sm-3 control-label">DPJP Layanan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" id="sep_dpjp_txt"
                                                    name="nm_dpjp_layan" placeholder="Pilih poli dulu...">
                                                <input type="hidden" id="sep_dpjp_kode" name="dpjp_layan">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END RIGHT COLUMN -->
                                </div>

                                <!-- Simpan -->
                                <div class="row">
                                    <div class="col-md-12 text-center" style="margin-top: 10px;">
                                        <button type="button" class="btn btn-app btn-success"
                                            onclick="simpan_sep_real()"><i class="fa fa-save"></i> Buat SEP</button>
                                        <button type="button" class="btn btn-app btn-danger"
                                            onclick="$('#form_sep_area').slideUp()"><i class="fa fa-times"></i>
                                            Batal</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RUJUKAN PCARE -->
<div class="modal fade" id="modal_rujukan_pcare" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-hospital-o"></i> Rujukan Faskes 1 (PCare)</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. Kartu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pcare_no_kartu"
                                placeholder="Masukkan No. Kartu BPJS Pasien">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-warning btn-flat btn-block"
                                onclick="cek_rujukan_pcare()"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="active">
                                <th>No. Rujukan</th>
                                <th>Tgl Rujukan</th>
                                <th>Poli</th>
                                <th>Diagnosa</th>
                                <th>PPK Perujuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list_rujukan_pcare">
                            <tr>
                                <td colspan="6" class="text-center">Data belum dimuat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RUJUKAN RS -->
<div class="modal fade" id="modal_rujukan_rs" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-building"></i> Rujukan Faskes 2 (RS)</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. Kartu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="rs_no_kartu"
                                placeholder="Masukkan No. Kartu BPJS Pasien">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger btn-flat btn-block"
                                onclick="cek_rujukan_rs()"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="active">
                                <th>No. Rujukan</th>
                                <th>Tgl Rujukan</th>
                                <th>Poli</th>
                                <th>Diagnosa</th>
                                <th>PPK Perujuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list_rujukan_rs">
                            <tr>
                                <td colspan="6" class="text-center">Data belum dimuat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL GANTI DOKTER -->
<div class="modal fade" id="modal_dokter" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Ganti Dokter</h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form_dokter" class="form-horizontal">
                    <input type="hidden" value="" name="no_rawat" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Dokter Baru</label>
                        <div class="col-md-9">
                            <select name="kd_dokter_baru" id="kd_dokter_baru" class="form-control"
                                style="width:100%"></select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveDokter" onclick="simpan_dokter()"
                    class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL GANTI POLI -->
<div class="modal fade" id="modal_poli" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Ganti Poliklinik</h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form_poli" class="form-horizontal">
                    <input type="hidden" value="" name="no_rawat" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Poli Baru</label>
                        <div class="col-md-9">
                            <select name="kd_poli_baru" id="kd_poli_baru" class="form-control"
                                style="width:100%"></select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSavePoli" onclick="simpan_poli()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL GANTI BAYAR -->
<div class="modal fade" id="modal_bayar" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Ganti Jenis Bayar</h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form_bayar" class="form-horizontal">
                    <input type="hidden" value="" name="no_rawat" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Jenis Bayar</label>
                        <div class="col-md-9">
                            <select name="kd_pj_baru" id="kd_pj_baru" class="form-control" style="width:100%"></select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveBayar" onclick="simpan_bayar()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT SEP (REDESIGENED) -->
<div class="modal fade" id="modal_lihat_sep" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-text-o"></i> Detail Data SEP (Surat Eligibilitas Peserta)
                </h4>
            </div>
            <div class="modal-body" style="background-color: #f9f9f9; padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom box-shadow">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i>
                                        Info Utama</a></li>
                                <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-hospital-o"></i> Rujukan &
                                        Pelayanan</a></li>
                                <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-ambulance"></i> Laka &
                                        Lainnya</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- TAB 1: INFO UTAMA -->
                                <div class="tab-pane active" id="tab_1">
                                    <div class="callout callout-info" style="margin-bottom: 15px;">
                                        <h4 id="view_no_sep_head"
                                            style="margin-top:0; margin-bottom:5px; font-weight:bold;"></h4>
                                        <p>Tanggal SEP: <span id="view_tgl_sep"></span></p>
                                    </div>
                                    <div class="row invoice-info">
                                        <div class="col-sm-6 invoice-col">
                                            <label class="text-muted">DATA PASIEN</label>
                                            <address>
                                                <strong id="view_nama_pasien"></strong><br>
                                                No. Kartu: <span id="view_no_kartu"></span><br>
                                                No. MR: <span id="view_no_mr"></span><br>
                                                Tgl Lahir: <span id="view_tgl_lahir"></span> / Kelamin: <span
                                                    id="view_jkel"></span><br>
                                                Peserta: <span id="view_peserta"></span>
                                            </address>
                                        </div>
                                        <div class="col-sm-6 invoice-col">
                                            <label class="text-muted">DATA PERAWATAN</label>
                                            <address>
                                                <strong>Poli Tujuan:</strong> <span id="view_poli"></span><br>
                                                <strong>Kelas Rawat:</strong> <span id="view_kls_rawat"></span> (Hak:
                                                <span id="view_kls_hak"></span>)<br>
                                                <strong>Diagnosa Awal:</strong> <br><span id="view_diagnosa"></span><br>
                                                <strong>Catatan:</strong> <span id="view_catatan"
                                                    class="text-red"></span>
                                            </address>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB 2: RUJUKAN -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title text-success">Asal Rujukan</h3>
                                            </div>
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td width="30%">Asal Rujukan</td>
                                                    <td id="view_asal_rujukan"></td>
                                                </tr>
                                                <tr>
                                                    <td>No. Rujukan</td>
                                                    <td id="view_no_rujukan"></td>
                                                </tr>
                                                <tr>
                                                    <td>Tgl. Rujukan</td>
                                                    <td id="view_tgl_rujukan"></td>
                                                </tr>
                                                <tr>
                                                    <td>PPK Rujukan</td>
                                                    <td id="view_ppk_rujukan"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title text-success">Dokter & Pelayanan</h3>
                                            </div>
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td width="30%">DPJP Layanan</td>
                                                    <td id="view_dpjp_layan"></td>
                                                </tr>
                                                <tr>
                                                    <td>DPJP Skdp</td>
                                                    <td id="view_dpjp_skdp"></td>
                                                </tr>
                                                <tr>
                                                    <td>No. SKDP</td>
                                                    <td id="view_no_skdp"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Pelayanan</td>
                                                    <td id="view_jns_pelayanan"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB 3: LAINNYA -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title text-warning">Kecelakaan (Laka Lantas)</h3>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td width="35%">Status Laka</td>
                                                    <td id="view_laka"></td>
                                                </tr>
                                                <tr>
                                                    <td>Tgl. Kejadian</td>
                                                    <td id="view_tgl_laka"></td>
                                                </tr>
                                                <tr>
                                                    <td>Ket. Laka</td>
                                                    <td id="view_ket_laka"></td>
                                                </tr>
                                                <tr>
                                                    <td>Lokasi</td>
                                                    <td id="view_lokasi_laka"></td>
                                                </tr>
                                                <tr>
                                                    <td>Suplesi</td>
                                                    <td id="view_suplesi"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title text-info">Status Lain</h3>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td width="35%">Pembiayaan</td>
                                                    <td id="view_pembiayaan"></td>
                                                </tr>
                                                <tr>
                                                    <td>Penanggung Jwb</td>
                                                    <td id="view_penanggung_jawab"></td>
                                                </tr>
                                                <tr>
                                                    <td>COB</td>
                                                    <td id="view_cob"></td>
                                                </tr>
                                                <tr>
                                                    <td>Katarak</td>
                                                    <td id="view_katarak"></td>
                                                </tr>
                                                <tr>
                                                    <td>Eksekutif</td>
                                                    <td id="view_eksekutif"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <span class="text-muted"><i>Dibuat oleh: <span id="view_user_sep"></span></i></span>
                </div>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning btn-flat" onclick="edit_sep()"><i class="fa fa-pencil"></i>
                    Update SEP</button>
                <a href="#" id="link_cetak_sep" target="_blank" class="btn btn-success btn-flat"><i
                        class="fa fa-print"></i> Cetak SEP</a>
            </div>
        </div>
    </div>
</div>

<!-- Select2 & Scripts -->
<script>

    var table;
    $(document).ready(function () {
        // DataTable
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('pendaftaran/reg_periksa/ajax_list') ?>",
                "type": "POST",
                "data": function (d) {
                    d.filter_tgl_mulai = $('#filter_tgl_mulai').val();
                    d.filter_tgl_akhir = $('#filter_tgl_akhir').val();
                    d.filter_status_bayar = $('#filter_status_bayar').val();
                }
            },
            "drawCallback": function (settings) {
                var json = settings.json;
                if (json && json.stats) {
                    $('#stat_total').text(json.stats.total);
                    $('#stat_paid').text(json.stats.paid);
                    $('#stat_unpaid').text(json.stats.unpaid);
                }
            },
            "columnDefs": [
                { "targets": [-1], "orderable": false }
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            }
        });

        // Filter Events
        $('#filter_tgl_mulai, #filter_tgl_akhir, #filter_status_bayar').change(function () {
            table.ajax.reload();
        });

        // Select2 Initialization with AJAX

        // Dokter
        $('#kd_dokter').select2({
            placeholder: 'Pilih Dokter',
            ajax: {
                url: "<?= base_url('pendaftaran/reg_periksa/search_dokter') ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) { return { q: params.term }; },
                processResults: function (data) { return { results: data.results }; }
            }
        });

        // Poli
        $('#kd_poli').select2({
            placeholder: 'Pilih Poliklinik',
            ajax: {
                url: "<?= base_url('pendaftaran/reg_periksa/search_poli') ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) { return { q: params.term }; },
                processResults: function (data) { return { results: data.results }; }
            }
        });

        // Jenis Bayar (Penjab)
        $('#kd_pj').select2({
            placeholder: 'Pilih Jenis Bayar',
            ajax: {
                url: "<?= base_url('pendaftaran/reg_periksa/search_penjab') ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) { return { q: params.term }; },
                processResults: function (data) { return { results: data.results }; }
            }
        });

        // Pasien (No RM)
        $('#no_rkm_medis').select2({
            placeholder: 'Cari Pasien (Nama / No RM)',
            minimumInputLength: 3,
            ajax: {
                url: "<?= base_url('pendaftaran/reg_periksa/search_pasien') ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) { return { q: params.term }; },
                processResults: function (data) { return { results: data.results }; }
            }
        });

        // On Patient Select: Fill PJ and Address Info
        $('#no_rkm_medis').on('select2:select', function (e) {
            var data = e.params.data.pasien;
            $('#nm_pasien_display').val(data.nm_pasien);
            $('#p_jawab').val(data.namakeluarga);  // Assuming namakeluarga is PJ Name default
            $('#almt_pj').val(data.alamat);
            $('#no_tlp_pasien_local').val(data.no_tlp); // Store local phone

            // Auto Populate BPJS Number
            if (data.no_peserta) {
                $('#bpjs_nomor').val(data.no_peserta);
                $('#pcare_no_kartu').val(data.no_peserta);
                $('#rs_no_kartu').val(data.no_peserta);
            } else {
                $('#bpjs_nomor').val('');
                $('#pcare_no_kartu').val('');
                $('#rs_no_kartu').val('');
            }

            // Auto select jenis bayar if linked (optional)
            if (data.kd_pj) {
                // We need to fetch text for it, but for now let's just trigger value if loaded or leave it.
                // Usually complex to prefill select2 ajax without initial data.
                // Simple hack: create option and select it
                // $('#kd_pj').append(new Option(data.kd_pj, data.kd_pj, true, true)).trigger('change');
            }
        });

        // Auto No Reg Calculation when Poli/Dokter changes
        $('#kd_poli, #kd_dokter').on('change', function () {
            // Need to wait until both are selected ideally, or just fetch
            var p = $('#kd_poli').val();
            var d = $('#kd_dokter').val();
            if (p && d) {
                $.getJSON("<?= base_url('pendaftaran/reg_periksa/get_no_reg') ?>", { kd_poli: p, kd_dokter: d }, function (res) {
                    $('[name="no_reg"]').val(res.no_reg);
                });
            }
        });


        // Init Select2 for Modals
        $('#kd_dokter_baru').select2({
            dropdownParent: $('#modal_dokter'),
            placeholder: 'Pilih Dokter',
            ajax: { url: "<?= base_url('pendaftaran/reg_periksa/search_dokter') ?>", dataType: 'json', delay: 250, data: function (p) { return { q: p.term }; }, processResults: function (d) { return { results: d.results }; } }
        });

        $('#kd_poli_baru').select2({
            dropdownParent: $('#modal_poli'),
            placeholder: 'Pilih Poli',
            ajax: { url: "<?= base_url('pendaftaran/reg_periksa/search_poli') ?>", dataType: 'json', delay: 250, data: function (p) { return { q: p.term }; }, processResults: function (d) { return { results: d.results }; } }
        });

        $('#kd_pj_baru').select2({
            dropdownParent: $('#modal_bayar'),
            placeholder: 'Pilih Cara Bayar',
            ajax: { url: "<?= base_url('pendaftaran/reg_periksa/search_penjab') ?>", dataType: 'json', delay: 250, data: function (p) { return { q: p.term }; }, processResults: function (d) { return { results: d.results }; } }
        });

        // --- REALTIME CLOCK ---
        function updateClock() {
            var now = new Date();
            // Date Format YYYY-MM-DD
            var y = now.getFullYear();
            var m = String(now.getMonth() + 1).padStart(2, '0');
            var d = String(now.getDate()).padStart(2, '0');
            $('#tgl_registrasi').val(y + '-' + m + '-' + d);

            // Time Format HH:mm:ss
            var h = String(now.getHours()).padStart(2, '0');
            var min = String(now.getMinutes()).padStart(2, '0');
            var s = String(now.getSeconds()).padStart(2, '0');
            $('#jam_reg').val(h + ':' + min + ':' + s);
        }
        setInterval(updateClock, 1000); // Live update every second

        // Initialize Filters with Today's Date (Local Time)
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var todayString = yyyy + '-' + mm + '-' + dd;

        $('#filter_tgl_mulai').val(todayString);
        $('#filter_tgl_akhir').val(todayString);
    });

    // --- ACTIONS ---
    // Fix Dropdown clipped by table-responsive
    $(document).on('shown.bs.dropdown', '.table-responsive', function (e) {
        // The .dropdown-menu is direct child of .btn-group which is inside .table-responsive
        $(this).css('overflow', 'inherit');
    });
    $(document).on('hidden.bs.dropdown', '.table-responsive', function () {
        $(this).css('overflow', 'auto');
    });

    function cetak_antrian(no_rawat) {
        // Fix slash being escaped or causing issues in URL by using query param
        var url = "<?= base_url('pendaftaran/reg_periksa/cetak_antrian') ?>?no_rawat=" + encodeURIComponent(no_rawat);
        window.open(url, "Cetak Antrian", "width=400,height=600");
    }

    function hapus_reg(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data registrasi " + id + " akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('pendaftaran/reg_periksa/delete') ?>",
                    type: "POST",
                    data: { no_rawat: id },
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {

                            // Refresh No Rawat
                            $.getJSON("<?= base_url('pendaftaran/reg_periksa/get_no_rawat') ?>", function (res) {
                                $('#no_rawat').val(res.no_rawat);
                            });

                            table.ajax.reload();
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                    },
                    error: function () { Swal.fire('Error', 'Gagal menghapus data', 'error'); }
                });
            }
        });
    }

    function ganti_dokter(id) {
        $('#form_dokter')[0].reset();
        $('[name="no_rawat"]').val(id);
        $('#modal_dokter').modal('show');
    }

    function simpan_dokter() {
        $.ajax({
            url: "<?= base_url('pendaftaran/reg_periksa/update_dokter') ?>",
            type: "POST",
            data: $('#form_dokter').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#modal_dokter').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Dokter berhasil diubah',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    table.ajax.reload();
                } else Swal.fire('Gagal', data.message, 'error');
            }
        });
    }

    function ganti_poli(id) {
        $('#form_poli')[0].reset();
        $('[name="no_rawat"]').val(id);
        $('#modal_poli').modal('show');
    }

    function simpan_poli() {
        $.ajax({
            url: "<?= base_url('pendaftaran/reg_periksa/update_poli') ?>",
            type: "POST",
            data: $('#form_poli').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#modal_poli').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Poli berhasil diubah',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    table.ajax.reload();
                } else Swal.fire('Gagal', data.message, 'error');
            }
        });
    }

    function ganti_bayar(id) {
        $('#form_bayar')[0].reset();
        $('[name="no_rawat"]').val(id);
        $('#modal_bayar').modal('show');
    }

    function simpan_bayar() {
        $.ajax({
            url: "<?= base_url('pendaftaran/reg_periksa/update_bayar') ?>",
            type: "POST",
            data: $('#form_bayar').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#modal_bayar').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Jenis Bayar berhasil diubah',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    table.ajax.reload();
                } else Swal.fire('Gagal', data.message, 'error');
            }
        }

        );
    }

</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    .ui-autocomplete {
        z-index: 2147483647;
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        font-size: 12px;
    }
</style>
<script>
    $(document).ready(function () {
        // Init Autocomplete for SEP
        init_autocomplete_sep();
        get_ppk_pelayanan();
    });

    function get_ppk_pelayanan() {
        $.getJSON("<?= base_url('bpjs/mapping/get_ppk_pelayanan') ?>", function (res) {
            if (res.success) {
                $('#sep_ppk_pelayanan').val(res.data.nama); // Show Name only
                $('#sep_ppk_pelayanan_kode_disp').val(res.data.kode); // Show code in separate input
                $('#sep_ppk_pelayanan_kode').val(res.data.kode);
                $('#sep_ppk_pelayanan_nama').val(res.data.nama);
            }
        });
    }

    function init_autocomplete_sep() {
        // 1. Diagnosa
        $("#sep_diagnosa_txt").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('bpjs/mapping/search_diagnosa_bpjs') ?>",
                    dataType: "json",
                    type: 'POST',
                    data: { keyword: request.term },
                    success: function (data) {
                        var results = data.data || [];
                        response($.map(results, function (item) {
                            return {
                                label: item.kode + ' - ' + item.nama,
                                value: item.nama,
                                code: item.kode,
                                nama: item.nama
                            };
                        }));
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                $("#sep_diagnosa_kode").val(ui.item.code);
                $("#sep_diagnosa_kode_disp").val(ui.item.code);
                $("#sep_diagnosa_nama").val(ui.item.nama);
            }
        });

        // 2. Poli Tujuan
        $("#sep_poli_txt").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('bpjs/mapping/search_poli_bpjs') ?>",
                    dataType: "json",
                    type: 'POST',
                    data: { keyword: request.term },
                    success: function (data) {
                        var results = data.data || [];
                        response($.map(results, function (item) {
                            return {
                                label: item.kode + ' - ' + item.nama,
                                value: item.kode + ' - ' + item.nama,
                                code: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $("#sep_poli_kode").val(ui.item.code);
                $("#sep_poli_nama").val(ui.item.value); // Store name
                // Reset and Trigger DPJP Search if needed or just clear
                $("#sep_dpjp_txt").val('');
                $("#sep_dpjp_kode").val('');
            }
        });

        // 3. PPK Rujukan
        $("#sep_ppk_rujukan_txt").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('bpjs/mapping/search_faskes_bpjs') ?>",
                    dataType: "json",
                    type: 'POST',
                    data: {
                        keyword: request.term,
                        jenis_faskes: $('#sep_asal_rujukan').val()
                    },
                    success: function (data) {
                        var results = data.data || [];
                        response($.map(results, function (item) {
                            return {
                                label: item.kode + ' - ' + item.nama,
                                value: item.nama, // Use Name for text input
                                code: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                $("#sep_ppk_rujukan_kode").val(ui.item.code);
                $("#sep_ppk_rujukan_nama").val(ui.item.value);
            }
        });

        // 4. Dokter DPJP (Local Mapped)
        $("#sep_dpjp_txt").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('bpjs/mapping/search_dokter_local') ?>",
                    dataType: "json",
                    type: 'POST',
                    data: { keyword: request.term },
                    success: function (data) {
                        var results = data.data || [];
                        response($.map(results, function (item) {
                            return {
                                label: item.nama, // Format is handled in controller
                                value: item.nama,
                                code: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 0,
            select: function (event, ui) {
                $("#sep_dpjp_kode").val(ui.item.code);
            }
        }).focus(function () {
            $(this).autocomplete("search", "");
        });

        // 5. Dokter DPJP SKDP (Same Source)
        $("#sep_dpjp_skdp_txt").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('bpjs/mapping/search_dokter_local') ?>",
                    dataType: "json",
                    type: 'POST',
                    data: { keyword: request.term },
                    success: function (data) {
                        var results = data.data || [];
                        response($.map(results, function (item) {
                            return {
                                label: item.nama,
                                value: item.nama,
                                code: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 0,
            select: function (event, ui) {
                $("#sep_dpjp_skdp_kode").val(ui.item.code);
            }
        }).focus(function () {
            $(this).autocomplete("search", "");
        });

        // Laka Toggle Logic
        $('#sep_laka_lantas').change(function () {
            var val = $(this).val();
            if (val == '1') { $('.laka-field').show(); } else { $('.laka-field').hide(); }
        });
    }

    function cek_peserta_bpjs() {
        var nomor = $('#bpjs_nomor').val();
        var jenis = $('#bpjs_jenis_kartu').val();
        var tgl = $('#bpjs_tgl_sep').val();

        // Reset Mode to Insert whenever checking new participant
        $('#sep_mode').val('insert');
        $('#sep_no_sep_update').val('');
        $('#btn_simpan_sep').html('<i class="fa fa-save"></i> Buat SEP');

        if (!nomor) { Swal.fire('Perhatian', 'Nomor Kartu/NIK harus diisi', 'warning'); return; }

        $('#result_cek_kartu').html('<div class="text-center"><i class="fa fa-spin fa-spinner fa-3x"></i><br>Sedang menghubungi server BPJS...</div>');
        $('#form_sep_area').hide();


        $.ajax({
            url: "<?= base_url('bpjs/peserta/cek') ?>",
            type: "POST",
            dataType: "json",
            data: {
                type: jenis,
                nomor: nomor,
                tgl_sep: tgl
            },
            success: function (data) {
                if (data.metaData && data.metaData.code === '200') {
                    var p = data.response.peserta;
                    var statusClass = p.statusPeserta.kode == '0' ? 'alert-success' : 'alert-danger';
                    var statusIcon = p.statusPeserta.kode == '0' ? 'fa-check' : 'fa-times';

                    var html = '<div class="alert ' + statusClass + ' alert-dismissible">';
                    html += '<h4><i class="icon fa ' + statusIcon + '"></i> ' + p.statusPeserta.keterangan + '</h4>';
                    html += 'Nama: <b>' + p.nama + '</b><br>';
                    html += 'NIK: ' + p.nik + '<br>';
                    html += 'Jenis: ' + p.jenisPeserta.keterangan + '<br>';
                    html += 'Kelas: ' + p.hakKelas.keterangan + '<br>';
                    if (p.provUmum) {
                        html += 'Faskes 1: ' + p.provUmum.nmProvider + ' (' + p.provUmum.kdProvider + ')';
                    }
                    html += '</div>';

                    $('#result_cek_kartu').html(html);

                    if (p.statusPeserta.kode == '0') {
                        // Populate SEP Form - Advanced Fields
                        $('#sep_no_kartu').val(p.noKartu);
                        $('#sep_nama_pasien').val(p.nama);
                        $('#sep_no_rm').val($('#no_rkm_medis').find(':selected').val());
                        $('#sep_no_rawat').val($('#no_rawat').val()); // Capture No Rawat Here
                        $('#sep_tgl_lahir').val(p.tglLahir);
                        $('#sep_jk').val(p.sex);
                        $('#sep_jenis_peserta').val(p.jenisPeserta.keterangan);
                        $('#sep_jenis_peserta').val(p.jenisPeserta.keterangan);
                        // Try Hak Kelas
                        var kls = p.hakKelas.kode;
                        if (!kls) kls = '3';
                        $('#sep_kls_rawat_hak').val(kls);

                        // Faskes (PPK Rujukan) - Populate Text Input
                        if (p.provUmum) {
                            $('#sep_ppk_rujukan_txt').val(p.provUmum.nmProvider);
                            $('#sep_ppk_rujukan_kode').val(p.provUmum.kdProvider);
                            $('#sep_ppk_rujukan_nama').val(p.provUmum.nmProvider);
                        }

                        // Default Values
                        $('#sep_jns_pelayanan').val('2'); // Ralan

                        // Priority: BPJS Mobile > BPJS Data > Local DB > Default
                        var phone = p.mr.noTelepon || p.noTelepon || $('#no_tlp_pasien_local').val() || '000000000000';
                        $('#sep_no_telp').val(phone);

                        $('#form_sep_area').slideDown();
                    } else {
                        $('#form_sep_area').slideUp();
                    }

                } else {
                    var msg = data.metaData ? data.metaData.message : 'Respon tidak dikenali';
                    $('#result_cek_kartu').html('<div class="alert alert-danger"><i class="fa fa-warning"></i> ' + msg + '</div>');
                    $('#form_sep_area').slideUp();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#result_cek_kartu').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Gagal menghubungi server: ' + textStatus + '</div>');
                $('#form_sep_area').slideUp();
            }
        });
    }

    function simpan_sep_real() {
        // Collect Data Manually to ensure everything is correct
        var formData = {};
        formData.no_rawat = $('#sep_no_rawat').val();
        formData.no_sep = $('#sep_no_sep_update').val(); // For Update
        formData.no_kartu = $('#sep_no_kartu').val();
        formData.tgl_sep = $('#sep_tgl_sep').val();
        formData.ppk_pelayanan_kode = $('#sep_ppk_pelayanan_kode').val();
        formData.ppk_pelayanan_nama = $('#sep_ppk_pelayanan_nama').val();
        formData.jns_pelayanan = $('#sep_jns_pelayanan').val();
        formData.kls_rawat_hak = $('#sep_kls_rawat_hak').val() || '3';
        formData.naik_kelas = $('#sep_naik_kelas').val();
        formData.pembiayaan = $('#sep_pj_naik_kelas').val();
        formData.penanggung_jawab = '';
        formData.no_mr = $('#sep_no_rm').val();
        formData.nama_pasien = $('#sep_nama_pasien').val();
        formData.asal_rujukan = $('#sep_asal_rujukan').val();
        formData.tgl_rujukan = $('#sep_tgl_rujukan').val();
        formData.no_rujukan = $('#sep_no_rujukan').val();
        formData.ppk_rujukan_kode = $('#sep_ppk_rujukan_kode').val();
        formData.ppk_rujukan_nama = $('#sep_ppk_rujukan_nama').val();
        formData.catatan = $('#sep_catatan').val();
        formData.diagnosa_kode = $('#sep_diagnosa_kode').val();
        formData.diagnosa_txt = $('#sep_diagnosa_txt').val(); // For Update Text
        formData.diagnosa_nama = $('#sep_diagnosa_nama').val();
        formData.poli_kode = $('#sep_poli_kode').val();
        formData.poli_nama = $('#sep_poli_nama').val();
        formData.eksekutif = $('#sep_eksekutif').val();
        formData.cob = $('#sep_cob').val();
        formData.katarak = $('#sep_katarak').val();
        formData.laka_lantas = $('#sep_laka_lantas').val();
        formData.tgl_laka = $('#sep_tgl_laka').val();
        formData.ket_laka = $('#sep_ket_laka').val();
        formData.suplesi = $('#sep_suplesi').val();
        formData.no_suplesi = $('#sep_no_suplesi').val();
        formData.prov_laka = $('#sep_provinsi_laka').val();
        formData.kab_laka = $('#sep_kab_laka').val();
        formData.kec_laka = $('#sep_kec_laka').val();
        formData.tujuan_kunjungan = $('#sep_tujuan_kunjungan').val();
        formData.flag_prosedur = $('#sep_flag_prosedur').val();
        formData.penunjang = $('#sep_penunjang').val();
        formData.asesmen_pelayanan = $('#sep_asesmen_pelayanan').val();
        formData.no_skdp = $('#sep_no_skdp').val();
        formData.dpjp_skdp = $('#sep_dpjp_skdp_kode').val();
        formData.nm_dpjp_skdp = $('#sep_dpjp_skdp_txt').val();
        formData.dpjp_layan = $('#sep_dpjp_kode').val();
        formData.nm_dpjp_layan = $('#sep_dpjp_txt').val();
        formData.no_telp = $('#sep_no_telp').val() || '000000000000';
        formData.tgl_lahir = $('#sep_tgl_lahir').val();
        formData.jk = $('#sep_jk').val();
        formData.reg_tgl_registrasi = $('#tgl_registrasi').val();
        formData.reg_jam_reg = $('#jam_reg').val();
        formData.reg_kd_dokter = $('#kd_dokter').val();
        formData.reg_kd_poli = $('#kd_poli').val();
        formData.reg_no_rkm_medis = $('#no_rkm_medis').val();
        formData.reg_pj = $('#p_jawab').val();
        formData.reg_hubungan = $('[name="hubunganpj"]').val();
        formData.reg_alamat_pj = $('#almt_pj').val();
        formData.reg_kd_pj = $('#kd_pj').val();
        formData.reg_stts_daftar = $('[name="stts_daftar"]').val();
        formData.reg_asal_rujukan = $('[name="asal_rujukan"]').val();
        formData.reg_biaya_reg = 0;

        // Validation for Patient Data
        // If reg_no_rkm_medis (from main dropdown) is empty, try to grab from SEP Form (Update Mode scenario)
        if (!formData.reg_no_rkm_medis) {
            formData.reg_no_rkm_medis = $('#sep_no_rm').val();
        }

        if (!formData.reg_no_rkm_medis) {
            Swal.fire('Peringatan', 'Mohon pilih Pasien terlebih dahulu.', 'warning');
            return;
        }

        // Basic Validation
        if (!formData.tujuan_kunjungan) formData.tujuan_kunjungan = '0';
        if (!formData.flag_prosedur) formData.flag_prosedur = '';
        if (!formData.penunjang) formData.penunjang = '';
        if (!formData.asesmen_pelayanan) formData.asesmen_pelayanan = '';

        var mode = $('#sep_mode').val();
        var url = (mode == 'update') ? "<?= base_url('bpjs/sep/update') ?>" : "<?= base_url('bpjs/sep/insert') ?>";
        var txtMode = (mode == 'update') ? 'Update SEP?' : 'Simpan SEP?';

        Swal.fire({
            title: txtMode,
            text: "Data akan dikirim ke BPJS",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim'
        }).then((res) => {
            if (res.isConfirmed) {
                // Loading
                Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });

                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    success: function (resp) {
                        if (resp.status == 'success') {
                            var sep = resp.data;
                            Swal.fire({
                                title: 'Sukses',
                                text: resp.message,
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });
                            $('#modal_cek_kartu').modal('hide');
                            // Refresh table if needed
                            if (typeof table !== 'undefined') table.ajax.reload();
                        } else {
                            var errMsg = resp.message;
                            if (resp.meta && resp.meta.metaData) errMsg += ' (' + resp.meta.metaData.message + ')';
                            Swal.fire('Gagal', errMsg, 'error');
                        }
                    },
                    error: function (ts) {
                        Swal.fire('Error', 'Gagal menghubungkan ke server', 'error');
                    }
                });
            }
        });
    }

    // Stores current SEP data for Editing
    var current_sep = null;

    window.edit_sep = function () {
        if (!current_sep) return;
        var d = current_sep;

        // Reset Form
        $('#form_sep_real')[0].reset();
        // Need to explicitly clear hidden fields that reset() might miss if they are not in form (but they should be)

        // Switch Mode
        $('#sep_mode').val('update');
        $('#sep_no_sep_update').val(d.no_sep);

        // Show Modal Form (Assuming it accepts pre-fill)
        $('#modal_lihat_sep').modal('hide');
        $('#form_sep_area').show();
        $('#modal_cek_kartu').modal('show');

        // Populate Fields
        $('#sep_no_kartu').val(d.no_kartu);
        $('#sep_nama_pasien').val(d.nama_pasien);
        $('#sep_no_rm').val(d.nomr);
        $('#sep_no_rawat').val(d.no_rawat);
        $('#sep_tgl_sep').val(d.tglsep);

        // Missing fields fix:
        $('#sep_tgl_lahir').val(d.tanggal_lahir); // d.tanggal_lahir from db
        $('#sep_jk').val(d.jkel); // d.jkel from db
        $('#sep_jenis_peserta').val(d.peserta); // d.peserta from db

        // PPK Pelayanan
        $('#sep_ppk_pelayanan_kode').val(d.kdppkpelayanan);
        $('#sep_ppk_pelayanan_nama').val(d.nmppkpelayanan);
        // Display Input
        $('#sep_ppk_pelayanan_kode_disp').val(d.kdppkpelayanan);
        $('#sep_ppk_pelayanan_nama_disp').val(d.nmppkpelayanan);

        $('#sep_jns_pelayanan').val(d.jnspelayanan); // 1 or 2

        // Rujukan
        $('#sep_asal_rujukan').val(d.asal_rujukan.includes('2') ? '2' : '1'); // Rough matching
        $('#sep_no_rujukan').val(d.no_rujukan);
        $('#sep_tgl_rujukan').val(d.tglrujukan);
        $('#sep_ppk_rujukan_kode').val(d.kdppkrujukan);
        $('#sep_ppk_rujukan_nama').val(d.nmppkrujukan);
        $('#sep_ppk_rujukan_txt').val(d.nmppkrujukan);

        // Diagnosa
        $('#sep_diagnosa_kode').val(d.diagawal);
        $('#sep_diagnosa_kode_disp').val(d.diagawal);
        $('#sep_diagnosa_nama').val(d.nmdiagnosaawal);
        $('#sep_diagnosa_txt').val(d.nmdiagnosaawal);

        // Poli
        $('#sep_poli_kode').val(d.kdpolitujuan);
        $('#sep_poli_nama').val(d.nmpolitujuan);
        $('#sep_poli_txt').val(d.kdpolitujuan + ' - ' + d.nmpolitujuan);

        // Kelas
        $('#sep_kls_rawat_hak').val(d.klsrawat);

        // DPJP
        $('#sep_dpjp_kode').val(d.kddpjplayanan);
        $('#sep_dpjp_txt').val(d.nmdpjplayanan);

        // SKDP
        $('#sep_no_skdp').val(d.noskdp);
        $('#sep_dpjp_skdp_kode').val(d.kddpjp); // kddpjp in bridging_sep is SKDP DPJP?
        $('#sep_dpjp_skdp_txt').val(d.nmdpdjp);

        // Lainnya
        $('#sep_catatan').val(d.catatan);
        $('#sep_no_telp').val(d.notelep);

        $('#sep_eksekutif').val(d.eksekutif.includes('Tidak') ? '0' : '1');
        $('#sep_cob').val(d.cob.includes('Tidak') ? '0' : '1');
        $('#sep_katarak').val(d.katarak.includes('Tidak') ? '0' : '1');

        // Laka
        if (d.lakalantas && d.lakalantas != '0') {
            $('#sep_laka_lantas').val('1').trigger('change');
            $('#sep_tgl_laka').val(d.tglkkl);
            $('#sep_ket_laka').val(d.keterangankkl);
            // Suplesi, etc need specific data
        } else {
            $('#sep_laka_lantas').val('0').trigger('change');
        }

        $('#btn_simpan_sep').html('<i class="fa fa-save"></i> Update SEP');
    }

    var current_rujukan_list = [];

    function pilih_dari_list(i, asal) {
        var d = current_rujukan_list[i];
        pilih_rujukan(d, asal);
    }

    function cek_rujukan_pcare() {
        var no_kartu = $('#pcare_no_kartu').val();
        if (!no_kartu) { Swal.fire('Error', 'Masukkan No Kartu', 'error'); return; }

        var tbody = $('#list_rujukan_pcare');
        tbody.html('<tr><td colspan="6" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</td></tr>');

        $.ajax({
            url: "<?= base_url('bpjs/sep/cari_rujukan_pcare') ?>",
            type: "POST",
            data: { no_kartu: no_kartu },
            dataType: "JSON",
            success: function (res) {
                tbody.empty();
                if (res.metaData && res.metaData.code == 200) {
                    var list = res.response.rujukan;
                    if (!list) {
                        tbody.html('<tr><td colspan="6" class="text-center">Tidak ada data rujukan</td></tr>');
                        return;
                    }
                    if (!Array.isArray(list)) list = [list];
                   // Store in global
                    current_rujukan_list = list;

                    $.each(list, function (i, d) {
                        var btn = "<button class='btn btn-xs btn-success' onclick='pilih_dari_list(" + i + ", \"1\")'><i class='fa fa-check'></i> Pilih</button>";
                        var tr = '<tr>' +
                            '<td>' + d.noKunjungan + '</td>' +
                            '<td>' + d.tglKunjungan + '</td>' +
                            '<td>' + d.poliRujukan.nama + '</td>' +
                            '<td>' + d.diagnosa.kode + ' - ' + d.diagnosa.nama + '</td>' +
                            '<td>' + d.provPerujuk.nama + '</td>' +
                            '<td>' + btn + '</td>' +
                            '</tr>';
                        tbody.append(tr);
                    });
                } else {
                    tbody.html('<tr><td colspan="6" class="text-center">' + (res.metaData ? res.metaData.message : 'Gagal mengambil data') + '</td></tr>');
                }
            },
            error: function () {
                tbody.html('<tr><td colspan="6" class="text-center">Error Connection</td></tr>');
            }
        });
    }

    function cek_rujukan_rs() {
        var no_kartu = $('#rs_no_kartu').val();
        if (!no_kartu) { Swal.fire('Error', 'Masukkan No Kartu', 'error'); return; }

        var tbody = $('#list_rujukan_rs');
        tbody.html('<tr><td colspan="6" class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</td></tr>');

        $.ajax({
            url: "<?= base_url('bpjs/sep/cari_rujukan_rs') ?>",
            type: "POST",
            data: { no_kartu: no_kartu },
            dataType: "JSON",
            success: function (res) {
                tbody.empty();
                if (res.metaData && res.metaData.code == 200) {
                    var list = res.response.rujukan;
                    if (!list) {
                        tbody.html('<tr><td colspan="6" class="text-center">Tidak ada data rujukan</td></tr>');
                        return;
                    }
                    if (!Array.isArray(list)) list = [list];

                    // Store in global
                    current_rujukan_list = list;

                    $.each(list, function (i, d) {
                        var btn = "<button class='btn btn-xs btn-success' onclick='pilih_dari_list(" + i + ", \"2\")'><i class='fa fa-check'></i> Pilih</button>";
                        var tr = '<tr>' +
                            '<td>' + d.noKunjungan + '</td>' +
                            '<td>' + d.tglKunjungan + '</td>' +
                            '<td>' + d.poliRujukan.nama + '</td>' +
                            '<td>' + d.diagnosa.kode + ' - ' + d.diagnosa.nama + '</td>' +
                            '<td>' + d.provPerujuk.nama + '</td>' +
                            '<td>' + btn + '</td>' +
                            '</tr>';
                        tbody.append(tr);
                    });
                } else {
                    tbody.html('<tr><td colspan="6" class="text-center">' + (res.metaData ? res.metaData.message : 'Gagal mengambil data') + '</td></tr>');
                }
            },
            error: function () {
                tbody.html('<tr><td colspan="6" class="text-center">Error Connection</td></tr>');
            }
        });
    }

    function pilih_rujukan(d, asal) {
        // Hide Modal Rujukan
        $('#modal_rujukan_pcare').modal('hide');
        $('#modal_rujukan_rs').modal('hide');

        // Open SEP Form Modal
        $('#modal_cek_kartu').modal('show');
        $('#form_sep_area').slideDown();

        // Populate SEP Form
        $('#sep_asal_rujukan').val(asal);
        $('#sep_no_rujukan').val(d.noKunjungan);
        var tgl_rujuk = d.tglKunjungan;
        if (!tgl_rujuk) {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            tgl_rujuk = now.getFullYear() + "-" + (month) + "-" + (day);
        }
        $('#sep_tgl_rujukan').val(tgl_rujuk);

        // PPK Rujukan
        $('#sep_ppk_rujukan_kode').val(d.provPerujuk.kode);
        $('#sep_ppk_rujukan_nama').val(d.provPerujuk.nama);
        $('#sep_ppk_rujukan_txt').val(d.provPerujuk.nama);

        // Diagnosa (Often referral diag matches sep diag)
        $('#sep_diagnosa_kode').val(d.diagnosa.kode);
        $('#sep_diagnosa_nama').val(d.diagnosa.nama);
        $('#sep_diagnosa_txt').val(d.diagnosa.nama);
        $('#sep_diagnosa_kode_disp').val(d.diagnosa.kode);

        // Poli
        $('#sep_poli_kode').val(d.poliRujukan.kode);
        $('#sep_poli_nama').val(d.poliRujukan.nama);
        $('#sep_poli_txt').val(d.poliRujukan.nama + ' (' + d.poliRujukan.kode + ')');

        // No Kartu (Ensure it matches)
        $('#sep_no_kartu').val(d.peserta.noKartu);
        $('#sep_nama_pasien').val(d.peserta.nama);

        // Also Auto-fill simple fields
        $('#sep_tgl_lahir').val(d.peserta.tglLahir);
        $('#sep_jk').val(d.peserta.sex);
        $('#sep_jenis_peserta').val(d.peserta.jenisPeserta.keterangan);
        $('#sep_kls_rawat_hak').val(d.peserta.hakKelas.kode);

        Swal.fire('Terpilih', 'Data rujukan berhasil disalin ke Form SEP', 'success');

        // Auto Fetch DPJP based on Poli and Today
        // Try using Poli Code as Spesialis Code (BPJS often maps them similarly for common polis)
        get_dpjp_from_bpjs(d.poliRujukan.kode);
    }

    function get_dpjp_from_bpjs(poli_kode) {
        // Fix: Use the correct ID for the SEP Date input
        var tgl = $('#bpjs_tgl_sep').val();
        if (!tgl) {
            var d = new Date();
            var month = '' + (d.getMonth() + 1);
            var day = '' + d.getDate();
            var year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            tgl = year + "-" + month + "-" + day;
        }
        var jenis = $('#sep_jns_pelayanan').val(); // Default 2 (Ralan)

        // Reset DPJP Input
        $('#sep_dpjp_kode').val('');
        $('#sep_dpjp_nama').val('');
        $('#sep_dok_display').val('Loading dokter...'); // Placeholder if exists

        $.ajax({
            url: "<?= base_url('bpjs/sep/get_dpjp') ?>",
            type: "POST",
            data: {
                pelayanan: jenis,
                tgl_pelayanan: tgl,
                spesialis: poli_kode
            },
            dataType: "JSON",
            success: function (res) {
                if (res.metaData && res.metaData.code == 200) {
                     var list = res.response.list;
                     if (list && list.length > 0) {
                         // If only 1 doctor, auto select
                         if (list.length === 1) {
                             var dr = list[0];
                             set_dpjp_val(dr);
                             Swal.fire({toast:true, position:'top-end', icon:'success', title:'Dokter DPJP: ' + dr.nama, timer:2000, showConfirmButton: false});
                         } else {
                             // Multiple doctors: Let user choose
                             var options = {};
                             $.each(list, function(k, v){
                                 options[v.kode] = v.nama;
                             });

                             Swal.fire({
                                 title: 'Pilih Dokter DPJP',
                                 input: 'select',
                                 inputOptions: options,
                                 inputPlaceholder: 'Pilih dokter...',
                                 showCancelButton: true,
                                 confirmButtonText: 'Pilih',
                                 cancelButtonText: 'Batal',
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value) {
                                             resolve();
                                         } else {
                                             resolve('Anda harus memilih dokter!');
                                         }
                                     });
                                 }
                             }).then((result) => {
                                 if (result.isConfirmed) {
                                     var selectedKode = result.value;
                                     var selectedNama = options[selectedKode];
                                     set_dpjp_val({kode: selectedKode, nama: selectedNama});
                                 }
                             });
                         }
                     } else {
                         Swal.fire({toast:true, position:'top-end', icon:'warning', title:'Tidak ada dokter DPJP ditemukan', timer:3000});
                         $('#sep_dpjp_txt').val('');
                     }
                 } else {
                     console.log('DPJP Fetch Error: ', res.metaData);
                     Swal.fire('Info', 'Gagal menarik jadwal dokter dari BPJS', 'info');
                     $('#sep_dpjp_txt').val('');
                 }
            }
        });
    }

    function set_dpjp_val(dr) {
        // DPJP Layanan
        $('#sep_dpjp_kode').val(dr.kode);
        $('#sep_dpjp_nama').val(dr.nama);
        $('#sep_dpjp_txt').val(dr.nama);

        // DPJP SEP (Pemberi Surat)
        $('#sep_dpjp_skdp_kode').val(dr.kode);
        $('#sep_dpjp_skdp_txt').val(dr.nama);
    }

    function simpan_reg() {
        // Basic Client Validation
        if (!$('#no_rawat').val()) { Swal.fire('Error', 'No Rawat Kosong', 'error'); return; }
        if (!$('#no_rkm_medis').val()) { Swal.fire('Error', 'Pasien belum dipilih', 'error'); return; }
        if (!$('#kd_dokter').val()) { Swal.fire('Error', 'Dokter belum dipilih', 'error'); return; }
        if (!$('#kd_poli').val()) { Swal.fire('Error', 'Poli belum dipilih', 'error'); return; }

        var btn = $('[onclick="simpan_reg()"]');
        var txt = btn.html();
        btn.html('<i class="fa fa-spin fa-spinner"></i> Proses...');
        btn.attr('disabled', true);

        $.ajax({
            url: "<?= base_url('pendaftaran/reg_periksa/save') ?>",
            type: "POST",
            data: $('#form_reg').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Reload Table & Get New No Rawat
                    table.ajax.reload();
                    $.getJSON("<?= base_url('pendaftaran/reg_periksa/get_no_rawat') ?>", function (res) {
                        $('#no_rawat').val(res.no_rawat);
                    });

                    // Clear Form Pasien & Poli
                    $('#no_rkm_medis').val(null).trigger('change');
                    $('#kd_poli').val(null).trigger('change');
                    $('#kd_dokter').val(null).trigger('change'); // Clear Dokter
                    $('#kd_pj').val(null).trigger('change'); // Clear Bayar

                    $('#p_jawab').val('');
                    $('#almt_pj').val('');
                    $('#nm_pasien_display').val('');
                    $('#asal_rujukan').val('');

                    // Optional: Reset PJ / Hubungan if needed
                    // $('[name="hubunganpj"]').val('DIRI SENDIRI');
                } else {
                    Swal.fire('Gagal', data.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Gagal menyimpan data', 'error');
            },
            complete: function () {
                btn.html(txt);
                btn.attr('disabled', false);
            }
        });
    }

    // --- Laka Lantas Logic ---
    window.toggleLakaInfo = function () {
        var val = $('#sep_laka_lantas').val();
        if (val == '1') {
            $('.laka-field').show();
            // Load Propinsi if not loaded
            if ($('#sep_provinsi_laka option').length == 0) {
                get_propinsi_laka();
            }
        } else {
            $('.laka-field').hide();
        }
    }

    function get_propinsi_laka() {
        $.ajax({
            url: "<?= base_url('bpjs/mapping/get_propinsi') ?>",
            type: "POST",
            dataType: "JSON",
            success: function (res) {
                var html = '<option value="">-- Pilih Propinsi --</option>';
                if (res.metaData && res.metaData.code == 200) {
                    $.each(res.response.list, function (i, v) {
                        html += '<option value="' + v.kode + '">' + v.nama + '</option>';
                    });
                }
                $('#sep_provinsi_laka').html(html);
            }
        });
    }

    $('#sep_provinsi_laka').change(function () {
        var kd = $(this).val();
        get_kabupaten_laka(kd);
        $('#sep_kec_laka').html('');
    });

    function get_kabupaten_laka(prop) {
        if (!prop) return;
        $.ajax({
            url: "<?= base_url('bpjs/mapping/get_kabupaten') ?>",
            type: "POST",
            data: { propinsi: prop },
            dataType: "JSON",
            success: function (res) {
                var html = '<option value="">-- Pilih Kabupaten --</option>';
                if (res.metaData && res.metaData.code == 200) {
                    $.each(res.response.list, function (i, v) {
                        html += '<option value="' + v.kode + '">' + v.nama + '</option>';
                    });
                }
                $('#sep_kab_laka').html(html);
            }
        });
    }

    $('#sep_kab_laka').change(function () {
        var kd = $(this).val();
        get_kecamatan_laka(kd);
    });

    function get_kecamatan_laka(kab) {
        if (!kab) return;
        $.ajax({
            url: "<?= base_url('bpjs/mapping/get_kecamatan') ?>",
            type: "POST",
            data: { kabupaten: kab },
            dataType: "JSON",
            success: function (res) {
                var html = '<option value="">-- Pilih Kecamatan --</option>';
                if (res.metaData && res.metaData.code == 200) {
                    $.each(res.response.list, function (i, v) {
                        html += '<option value="' + v.kode + '">' + v.nama + '</option>';
                    });
                }
                $('#sep_kec_laka').html(html);
            }
        });
    }

    window.pilihan_sep = function (no_sep) {
        Swal.fire({
            title: 'Aksi SEP',
            text: 'Nomor SEP: ' + no_sep,
            icon: 'info',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#00a65a',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-eye"></i> Lihat',
            denyButtonText: '<i class="fa fa-print"></i> Cetak',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                lihat_sep(no_sep);
            } else if (result.isDenied) {
                var url = "<?= base_url('bpjs/sep/cetak') ?>?no_sep=" + no_sep;
                window.open(url, "Cetak SEP", "width=800,height=600");
            }
        });
    }

    window.lihat_sep = function (no_sep) {
        $.ajax({
            url: "<?= base_url('bpjs/sep/detail') ?>",
            type: "GET",
            data: { no_sep: no_sep },
            dataType: "JSON",
            success: function (res) {
                if (res.status) {
                    var d = res.data;
                    current_sep = d;

                    // Header
                    $('#view_no_sep_head').text(d.no_sep);
                    $('#view_tgl_sep').text(d.tglsep);

                    // Tab 1: Info Utama
                    $('#view_nama_pasien').text(d.nama_pasien);
                    $('#view_no_kartu').text(d.no_kartu);
                    $('#view_no_mr').text(d.nomr);
                    $('#view_tgl_lahir').text(d.tanggal_lahir);
                    $('#view_jkel').text(d.jkel);
                    $('#view_peserta').text(d.peserta);

                    $('#view_poli').text(d.nmpolitujuan + ' (' + d.kdpolitujuan + ')');
                    $('#view_kls_rawat').text(d.klsrawat);
                    $('#view_kls_hak').text('-'); // Add if available
                    $('#view_diagnosa').text(d.diagawal + ' - ' + d.nmdiagnosaawal);
                    $('#view_catatan').text(d.catatan || '-');

                    // Tab 2: Rujukan
                    $('#view_asal_rujukan').text(d.asal_rujukan);
                    $('#view_no_rujukan').text(d.no_rujukan);
                    $('#view_tgl_rujukan').text(d.tglrujukan);
                    $('#view_ppk_rujukan').text(d.nmppkrujukan + ' (' + d.kdppkrujukan + ')');

                    $('#view_dpjp_layan').text(d.nmdpjplayanan);
                    $('#view_dpjp_skdp').text(d.nmdpdjp);
                    $('#view_no_skdp').text(d.noskdp);
                    $('#view_jns_pelayanan').text(d.jnspelayanan == '1' ? 'Rawat Inap' : 'Rawat Jalan');

                    // Tab 3: Laka & Lainnya
                    $('#view_laka').text(d.lakalantas == '0' ? 'Tidak' : 'Ya');
                    $('#view_tgl_laka').text(d.tglkkl == '0000-00-00' ? '-' : d.tglkkl);
                    $('#view_ket_laka').text(d.keterangankkl || '-');
                    // Location construction if needed
                    $('#view_lokasi_laka').text('-');
                    $('#view_suplesi').text(d.suplesi);

                    $('#view_pembiayaan').text(d.pembiayaan);
                    $('#view_penanggung_jawab').text(d.pjnaikkelas);
                    $('#view_cob').text(d.cob);
                    $('#view_katarak').text(d.katarak);
                    $('#view_eksekutif').text(d.eksekutif);

                    $('#view_user_sep').text(d.user);

                    // Set print link
                    $('#link_cetak_sep').attr('href', '<?= base_url("bpjs/sep/cetak") ?>?no_sep=' + d.no_sep);

                    $('#modal_lihat_sep').modal('show');
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Gagal mengambil data SEP', 'error');
            }
        });
    }

    window.hapus_sep = function (no_sep) {
        Swal.fire({
            title: 'Hapus SEP?',
            text: "Anda yakin ingin menghapus SEP " + no_sep + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('bpjs/sep/delete') ?>",
                    type: "POST",
                    data: { no_sep: no_sep },
                    dataType: "JSON",
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Terhapus!', res.message, 'success');
                            table.ajax.reload();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }
                });
            }
        })
    }
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Data Pasien
            <small>Manajemen Data Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pendaftaran</a></li>
            <li class="active">Data Pasien</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button class="btn btn-success" onclick="add_pasien()"><i class="glyphicon glyphicon-plus"></i> Tambah
                    Pasien Baru</button>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" onclick="reload_table()"><i
                            class="fa fa-refresh"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No. RM</th>
                            <th>Nama Pasien / NIK</th>
                            <th style="width: 50px;">JK</th>
                            <th>TTL</th>
                            <th>Alamat Pasien</th>
                            <th>No. Telepon</th>
                            <th style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Pasien</h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />

                    <div class="row">
                        <!-- KOLOM KIRI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">No.R.Medis</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="no_rkm_medis" placeholder="AUTO" class="form-control input-sm"
                                            type="text" readonly style="font-weight: bold;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary btn-sm" type="button" onclick="generate_rm()"
                                                title="Baru"><i class="fa fa-refresh"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Nama Pasien</label>
                                <div class="col-md-9">
                                    <input name="nm_pasien" class="form-control input-sm" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">J.K.</label>
                                <div class="col-md-4">
                                    <select name="jk" class="form-control input-sm">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-2 input-sm">Gol.Darah</label>
                                <div class="col-md-3">
                                    <select name="gol_darah" class="form-control input-sm">
                                        <option value="-">-</option>
                                        <?php foreach ($gol_darah as $gol)
                                            echo "<option value='$gol'>$gol</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Tmp/Tgl.Lahir</label>
                                <div class="col-md-4">
                                    <input name="tmp_lahir" class="form-control input-sm" type="text">
                                </div>
                                <div class="col-md-5">
                                    <input name="tgl_lahir" class="form-control input-sm" type="date"
                                        onchange="hitungUmur(this.value)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Umur</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="umur" class="form-control input-sm" type="text" readonly
                                            placeholder="0 Th 0 Bl 0 Hr">
                                        <span class="input-group-addon"
                                            style="border:none; padding:0 5px;">Pendidikan</span>
                                        <select name="pnd" class="form-control input-sm" style="width: 100px;">
                                            <?php foreach ($pendidikan as $pd)
                                                echo "<option value='$pd'>$pd</option>"; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Nama Ibu</label>
                                <div class="col-md-9">
                                    <input name="nm_ibu" class="form-control input-sm" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Png. Jawab</label>
                                <div class="col-md-9">
                                    <select name="kd_pj" class="form-control input-sm">
                                        <?php foreach ($penjab as $pj)
                                            echo "<option value='{$pj->kd_pj}'>{$pj->png_jawab}</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Nama P.J.</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="namakeluarga" class="form-control input-sm" type="text">
                                        <span class="input-group-addon"
                                            style="border:none; padding:0 5px;">Hubungan</span>
                                        <select name="keluarga" class="form-control input-sm" style="width: 100px;">
                                            <?php foreach ($keluarga as $kel)
                                                echo "<option value='$kel'>$kel</option>"; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Pekerjaan P.J.</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaanpj" class="form-control select2-tags input-sm"
                                        style="width:100%;">
                                        <option value="-">-</option>
                                        <?php foreach ($pekerjaan as $pk)
                                            echo "<option value='$pk'>$pk</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Suku/Bangsa</label>
                                <div class="col-sm-9">
                                    <select name="suku_bangsa" class="form-control select2 input-sm">
                                        <?php foreach ($suku_bangsa as $sb)
                                            echo "<option value='{$sb->id}'>{$sb->nama_suku_bangsa}</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Bahasa Dipakai</label>
                                <div class="col-sm-9">
                                    <select name="bahasa_pasien" class="form-control select2 input-sm">
                                        <?php foreach ($bahasa_pasien as $bs)
                                            echo "<option value='{$bs->id}'>{$bs->nama_bahasa}</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Cacat Fisik</label>
                                <div class="col-sm-9">
                                    <select name="cacat_fisik" class="form-control select2 input-sm">
                                        <?php foreach ($cacat_fisik as $cf)
                                            echo "<option value='{$cf->id}'>{$cf->nama_cacat}</option>"; ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <!-- KOLOM KANAN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Agama</label>
                                <div class="col-md-4">
                                    <select name="agama" class="form-control input-sm">
                                        <?php foreach ($agama as $ag)
                                            echo "<option value='$ag'>$ag</option>"; ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-2 input-sm">Stts.Nikah</label>
                                <div class="col-md-3">
                                    <select name="stts_nikah" class="form-control input-sm">
                                        <?php foreach ($stts_nikah as $st)
                                            echo "<option value='$st'>$st</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">No.Peserta</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="no_peserta" class="form-control input-sm" type="text" placeholder="No Kartu BPJS">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-sm btn-flat" type="button" onclick="cek_kartu()" title="Cek BPJS by Kartu"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Email</label>
                                <div class="col-md-9">
                                    <input name="email" class="form-control input-sm" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">No.Telp</label>
                                <div class="col-md-4">
                                    <input name="no_tlp" class="form-control input-sm" type="text">
                                </div>
                                <label class="control-label col-md-2 input-sm">Tgl.Daftar</label>
                                <div class="col-md-3">
                                    <input name="tgl_daftar" value="<?= date('Y-m-d'); ?>" class="form-control input-sm"
                                        type="date" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <select name="pekerjaan" class="form-control select2-tags input-sm"
                                        style="width:100%;">
                                        <option value="-">-</option>
                                        <?php foreach ($pekerjaan as $pk)
                                            echo "<option value='$pk'>$pk</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">No.KTP/SIM</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input name="no_ktp" class="form-control input-sm" type="text" maxlength="16">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-sm btn-flat" type="button"
                                                onclick="cek_nik()" title="Cek BPJS by NIK"><i class="fa fa-search"></i>
                                                Cek NIK</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- ALAMAT PASIEN -->
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Alamat Pasien</label>
                                <div class="col-md-9">
                                    <textarea name="alamat" class="form-control input-sm" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <div class="col-xs-6">
                                            <select name="kd_prop" class="form-control select2-wilayah input-sm"
                                                data-type="prop" data-placeholder="Propinsi"></select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="kd_kab" class="form-control select2-wilayah input-sm"
                                                data-type="kab" data-placeholder="Kabupaten"></select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="kd_kec" class="form-control select2-wilayah input-sm"
                                                data-type="kec" data-placeholder="Kecamatan"></select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="kd_kel" class="form-control select2-wilayah input-sm"
                                                data-type="kel" data-placeholder="Kelurahan"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ALAMAT PJ -->
                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Alamat P.J.</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" id="chk_sama" title="Sama dengan Pasien">
                                        </span>
                                        <textarea name="alamatpj" class="form-control input-sm" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <div class="col-xs-6">
                                            <select name="propinsipj" class="form-control select2-wilayah input-sm"
                                                data-type="prop" data-placeholder="Propinsi"></select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="kabupatenpj" class="form-control select2-wilayah input-sm"
                                                data-type="kab" data-placeholder="Kabupaten"></select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="kecamatanpj" class="form-control select2-wilayah input-sm"
                                                data-type="kec" data-placeholder="Kecamatan"></select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="kelurahanpj" class="form-control select2-wilayah input-sm"
                                                data-type="kel" data-placeholder="Kelurahan"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 input-sm">Instansi Pasien</label>
                                <div class="col-md-4">
                                    <select name="perusahaan_pasien" class="form-control select2 input-sm">
                                        <?php foreach ($perusahaan_pasien as $pp)
                                            echo "<option value='{$pp->kode_perusahaan}'>{$pp->nama_perusahaan}</option>"; ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-2 input-sm">NIP/NRP</label>
                                <div class="col-md-3">
                                    <input name="nip" class="form-control input-sm" type="text">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-flat"><i
                        class="fa fa-save"></i> Simpan Data</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        // Init Select2 for static fields
        $('.select2').select2({ width: '100%' });

        // Init Select2 with Tags (Free Text)
        $('.select2-tags').select2({
            width: '100%',
            tags: true
        });

        // Init Select2 for Wilayah (Dynamic AJAX)
        $('.select2-wilayah').each(function () {
            var type = $(this).data('type');
            $(this).select2({
                width: '100%',
                placeholder: 'Cari...',
                minimumInputLength: 3,
                ajax: {
                    url: "<?= base_url('pendaftaran/pasien/search_wilayah') ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            type: type
                        };
                    },
                    processResults: function (data) {
                        return { results: data.results };
                    },
                    cache: true
                }
            });
        });

        //datatables
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('pendaftaran/pasien/list') ?>",
                "type": "POST"
            },
            "columnDefs": [
                { "targets": [-1], "orderable": false }
            ]
        });
        // Checkbox Copy Address Logic
        $('#chk_sama').click(function () {
            if ($(this).is(':checked')) {
                // Copy Text address
                $('[name="alamatpj"]').val($('[name="alamat"]').val());

                // Copy Select2 Values (Text because PJ uses same table structure visually but DB might differ, 
                // but here we copy the Option selected)

                // Helper to copy select2
                function copySelect2(sourceName, targetName) {
                    var data = $('[name="' + sourceName + '"]').select2('data');
                    if (data && data[0]) {
                        var newOption = new Option(data[0].text, data[0].id, true, true);
                        $('[name="' + targetName + '"]').append(newOption).trigger('change');
                    }
                }

                copySelect2('kd_kel', 'kelurahanpj');
                copySelect2('kd_kec', 'kecamatanpj');
                copySelect2('kd_kab', 'kabupatenpj');
                copySelect2('kd_prop', 'propinsipj');

            } else {
                // Optional: Clear or leave as is? Usually leave as is or clear. for now leave as is.
            }
        });


        // Datepicker or input masks if needed
    });

    function add_pasien() {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        // Enable fields & Button
        $('#form input, #form textarea, #form select').prop('disabled', false);
        $('#btnSave').show();

        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Pasien Baru');

        // Auto gen RM
        generate_rm();
    }

    function edit_pasien(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        // Enable fields & Button
        $('#form input, #form textarea, #form select').prop('disabled', false);
        $('[name="no_rkm_medis"]').prop('readonly', true); // RM always readonly on edit
        $('#btnSave').show();

        $.ajax({
            url: "<?php echo site_url('pendaftaran/pasien/edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                // Populate data (same as before)
                $('[name="no_rkm_medis"]').val(data.no_rkm_medis);
                $('[name="nm_pasien"]').val(data.nm_pasien);
                $('[name="no_ktp"]').val(data.no_ktp);
                $('[name="jk"]').val(data.jk);
                $('[name="tmp_lahir"]').val(data.tmp_lahir);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="nm_ibu"]').val(data.nm_ibu);
                $('[name="alamat"]').val(data.alamat);
                $('[name="no_tlp"]').val(data.no_tlp);
                $('[name="gol_darah"]').val(data.gol_darah);
                $('[name="agama"]').val(data.agama);
                $('[name="stts_nikah"]').val(data.stts_nikah);
                $('[name="pekerjaan"]').val(data.pekerjaan);
                $('[name="kd_pj"]').val(data.kd_pj);
                $('[name="no_peserta"]').val(data.no_peserta);

                // Set Select2 values
                $('[name="pekerjaan"]').val(data.pekerjaan).trigger('change');
                $('[name="pekerjaanpj"]').val(data.pekerjaanpj).trigger('change');

                // Helper for setting Select2 Wilayah (Needs pre-fetching option if not in list, but usually text is enough if we just show id? 
                // Ah, select2 ajax needs option to be present. 
                // For "View", text inputs are easier. But let's try populating select2.)

                // Since this is a quick fix, let's just populate the fields present in form.
                // Assuming controller sends all fields matching names.
                $.each(data, function (name, val) {
                    var $el = $('[name="' + name + '"]');
                    var type = $el.attr('type');
                    switch (type) {
                        case 'checkbox':
                            $el.attr('checked', 'checked');
                            break;
                        case 'radio':
                            $el.filter('[value="' + val + '"]').attr('checked', 'checked');
                            break;
                        default:
                            $el.val(val);
                    }
                    // Handle Select2 triggers
                    if ($el.hasClass('select2') || $el.hasClass('select2-tags')) {
                        $el.trigger('change');
                    }
                });

                // Recalculate Age
                hitungUmur(data.tgl_lahir);

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Pasien: ' + data.nm_pasien);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function view_pasien(id) {
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('pendaftaran/pasien/edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (name, val) {
                    var $el = $('[name="' + name + '"]');
                    // Check if it's select2 and needs Option creation (for AJAX loaded select2s)
                    if ($el.hasClass('select2-wilayah') && val) {
                        // We might not have the text for ID.
                        // For View purpose, it's better to just show.
                        // But without extra data from server (names of wilayah), we show ID.
                        // The controller 'edit' returns raw DB row. 
                        // To show names we need joins or separate calls.
                        // For now, let's just show what we have.
                    }
                    $el.val(val).trigger('change');
                });

                hitungUmur(data.tgl_lahir);

                // Disable fields & Hide Save Button
                $('#form input, #form textarea, #form select').prop('disabled', true);
                $('#btnSave').hide();

                $('#modal_form').modal('show');
                $('.modal-title').text('Detail Pasien: ' + data.nm_pasien);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save() {
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('pendaftaran/pasien/add') ?>";
        } else {
            url = "<?php echo site_url('pendaftaran/pasien/update') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data pasien berhasil disimpan',
                        timer: 1500
                    });
                }
                else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan Data');
                $('#btnSave').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan Data');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function delete_pasien(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data pasien akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('pendaftaran/pasien/delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        reload_table();
                        Swal.fire('Terhapus!', 'Data pasien berhasil dihapus.', 'success');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        })
    }

    function generate_rm() {
        $.ajax({
            url: "<?php echo site_url('pendaftaran/pasien/new_rm') ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="no_rkm_medis"]').val(data.no_rkm_medis);
            }
        });
    }
    function hitungUmur(tglLahir) {
        if (!tglLahir) return;
        var today = new Date();
        var birthDate = new Date(tglLahir);
        if (isNaN(birthDate.getTime())) return; // invalid date

        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        // approximate months
        var diffMonths = (today.getFullYear() * 12 + today.getMonth()) - (birthDate.getFullYear() * 12 + birthDate.getMonth());
        var remMonths = diffMonths % 12;
        if (today.getDate() < birthDate.getDate()) {
            remMonths--;
            if (remMonths < 0) remMonths += 12;
        }

        $('[name="umur"]').val(age + " Th " + remMonths + " Bl");
    }

    function cek_nik() {
        var nik = $('[name="no_ktp"]').val();
        if(!nik) {
             Swal.fire('Peringatan', 'NIK Kosong!', 'warning');
             return;
        }
        
        // Show loading state
        var btn = $('button[onclick="cek_nik()"]');
        var originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        
        $.ajax({
            url: "<?= base_url('pendaftaran/pasien/cek_bpjs_nik') ?>",
            type: "POST",
            data: {nik: nik},
            dataType: "JSON",
            success: function(data) {
                if(data.metaData && data.metaData.code == 200) {
                    var p = data.response.peserta;
                    // Auto fill
                    $('[name="nm_pasien"]').val(p.nama);
                    $('[name="tgl_lahir"]').val(p.tglLahir);
                    hitungUmur(p.tglLahir);
                    // $('[name="no_tlp"]').val(p.mr.noTelepon); // API might return mr struct like {noMR:.., noTelepon:..} but often depends on BPJS ver.
                    // Actually BPJS VClaim 2.0 returns mr: {noMR: "...", noTelepon: "..."} usually.
                     if(p.mr && p.mr.noTelepon) $('[name="no_tlp"]').val(p.mr.noTelepon);

                    $('[name="no_peserta"]').val(p.noKartu);
                    
                    // Sex
                    if(p.sex == 'L') $('[name="jk"]').val('Laki-Laki');
                    else if(p.sex == 'P') $('[name="jk"]').val('Perempuan');
                    
                     Swal.fire('Berhasil', 'Data ditemukan: ' + p.nama, 'success');
                } else {
                     var msg = data.metaData ? data.metaData.message : 'Data tidak ditemukan';
                     Swal.fire('Gagal', msg, 'error');
                }
            },
            error: function() {
                 Swal.fire('Error', 'Gagal menghubungkan ke server BPJS', 'error');
            },
            complete: function() {
                btn.html(originalText).prop('disabled', false);
            }
        });
    }

    function cek_kartu() {
        var kartu = $('[name="no_peserta"]').val();
        if(!kartu) {
             Swal.fire('Peringatan', 'Nomor Kartu Kosong!', 'warning');
             return;
        }
        
        var btn = $('button[onclick="cek_kartu()"]');
        var originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        
        $.ajax({
            url: "<?= base_url('pendaftaran/pasien/cek_bpjs_kartu') ?>",
            type: "POST",
            data: {no_peserta: kartu},
            dataType: "JSON",
            success: function(data) {
                if(data.metaData && data.metaData.code == 200) {
                    var p = data.response.peserta;
                    $('[name="nm_pasien"]').val(p.nama);
                    $('[name="tgl_lahir"]').val(p.tglLahir);
                    hitungUmur(p.tglLahir);
                    $('[name="no_ktp"]').val(p.nik);
                    if(p.mr && p.mr.noTelepon) $('[name="no_tlp"]').val(p.mr.noTelepon);

                     if(p.sex == 'L') $('[name="jk"]').val('Laki-Laki');
                    else if(p.sex == 'P') $('[name="jk"]').val('Perempuan');

                     Swal.fire('Berhasil', 'Data ditemukan: ' + p.nama, 'success');
                } else {
                     var msg = data.metaData ? data.metaData.message : 'Data tidak ditemukan';
                     Swal.fire('Gagal', msg, 'error');
                }
            },
            error: function() {
                 Swal.fire('Error', 'Gagal menghubungkan ke server BPJS', 'error');
            },
            complete: function() {
                btn.html(originalText).prop('disabled', false);
            }
        });
    }
</script>
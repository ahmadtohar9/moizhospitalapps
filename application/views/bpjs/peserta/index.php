<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cek Kepesertaan BPJS
            <small>Cek Status Peserta (NIK / Kartu BPJS)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li class="active">Cek Peserta</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pencarian Peserta</h3>
                    </div>
                    <div class="box-body">
                        <form id="formCekPeserta">
                            <div class="form-group text-center">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary active" style="width: 150px;">
                                        <input type="radio" name="searchType" id="typeKartu" value="kartu" checked
                                            autocomplete="off">
                                        <i class="fa fa-id-card"></i> No. Kartu
                                    </label>
                                    <label class="btn btn-primary" style="width: 150px;">
                                        <input type="radio" name="searchType" id="typeNik" value="nik"
                                            autocomplete="off">
                                        <i class="fa fa-user"></i> NIK
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Identitas</label>
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control" id="nomor"
                                        placeholder="Masukkan Nomor Kartu BPJS..." autocomplete="off" autofocus>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat"><i
                                                class="fa fa-search"></i> Cek</button>
                                    </span>
                                </div>
                                <small class="text-muted" id="helpText">Masukkan 13 digit Nomor Kartu BPJS</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal SEP (Opsional)</label>
                                <input type="date" class="form-control" id="tgl_sep" value="<?= date('Y-m-d'); ?>">
                                <small class="text-muted">Digunakan untuk mengecek keaktifan pada tanggal
                                    tertentu.</small>
                            </div>
                        </form>
                    </div>
                    <div class="overlay" id="loadingOverlay" style="display: none;">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESULT SECTION -->
        <div class="row" id="resultSection" style="display: none;">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-solid" id="statusBox">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-circle"></i> Data Peserta</h3>
                        <div class="box-tools pull-right">
                            <span class="badge bg-gray" id="statusBadge">Checking...</span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="<?= base_url('assets/dist/img/avatar3.png'); ?>" class="img-circle"
                                    alt="User Image"
                                    style="width: 100px; border: 3px solid #d2d6de; margin-bottom: 10px;">
                                <h4 id="resNama" style="font-weight: bold;">-</h4>
                                <p id="resNik" class="text-muted">-</p>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 150px;">No. Kartu</th>
                                        <td>: <span id="resNoKartu"
                                                style="font-size: 1.2em; font-weight: bold;">-</span></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>: <span id="resTglLahir">-</span> (<span id="resUmur">-</span>)</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>: <span id="resJk">-</span></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Peserta</th>
                                        <td>: <span id="resJenisPeserta">-</span></td>
                                    </tr>
                                    <tr>
                                        <th>Hak Kelas</th>
                                        <td>: <span id="resHakKelas">-</span></td>
                                    </tr>
                                    <tr>
                                        <th>Faskes Tk. 1</th>
                                        <td>: <span id="resFaskes">-</span></td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td>: <span id="resNoHp">-</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="alert alert-info" style="margin-top: 20px; display: none;" id="infoDinsos">
                            <i class="fa fa-info-circle"></i> Peserta terdaftar sebagai penerima bantuan sosial (PBI).
                        </div>
                    </div>
                    <div class="box-footer">
                        <div id="rawJson" style="display:none;"></div>
                        <button class="btn btn-default btn-xs" onclick="$('#rawJsonContainer').toggle()">Toggle Raw
                            Data</button>
                        <pre id="rawJsonContainer"
                            style="display:none; margin-top: 10px; background: #eee; padding: 10px;"></pre>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Toggle input placeholder based on radio
        $('input[name="searchType"]').change(function () {
            if (this.value === 'nik') {
                $('#nomor').attr('placeholder', 'Masukkan 16 digit NIK...').focus();
                $('#helpText').text('Masukkan 16 digit Nomor Induk Kependudukan');
            } else {
                $('#nomor').attr('placeholder', 'Masukkan 13 digit Nomor Kartu BPJS...').focus();
                $('#helpText').text('Masukkan 13 digit Nomor Kartu BPJS');
            }
        });

        $('#formCekPeserta').on('submit', function (e) {
            e.preventDefault();
            searchPeserta();
        });
    });

    function searchPeserta() {
        const type = $('input[name="searchType"]:checked').val();
        const nomor = $('#nomor').val().trim();
        const tgl_sep = $('#tgl_sep').val();

        if (!nomor) {
            Swal.fire('Input Kosong', 'Silakan masukkan Nomor Kartu atau NIK', 'warning');
            return;
        }

        $('#loadingOverlay').show();
        $('#resultSection').hide();

        $.ajax({
            url: '<?= base_url("bpjs/peserta/cek"); ?>',
            type: 'POST',
            data: { type: type, nomor: nomor, tgl_sep: tgl_sep },
            dataType: 'JSON',
            success: function (res) {
                $('#loadingOverlay').hide();

                if (res.metaData && res.metaData.code == '200') {
                    const p = res.response.peserta;
                    renderPeserta(p);
                    $('#resultSection').fadeIn();
                } else {
                    let msg = (res.metaData) ? res.metaData.message : 'Unknown Error';
                    Swal.fire('Gagal Mencari', msg, 'error');
                }

                // Debug JSON
                $('#rawJsonContainer').text(JSON.stringify(res, null, 2));
            },
            error: function (err) {
                $('#loadingOverlay').hide();
                Swal.fire('Error', 'Terjadi kesalahan koneksi ke server', 'error');
            }
        });
    }

    function renderPeserta(data) {
        // Status Handling
        const isActive = (data.statusPeserta.kode == '0');
        const box = $('#statusBox');
        const badge = $('#statusBadge');

        // Reset
        box.removeClass('box-danger box-success box-warning');
        badge.removeClass('bg-red bg-green bg-yellow');

        if (isActive) {
            box.addClass('box-success');
            badge.addClass('bg-green').text('AKTIF');
        } else {
            box.addClass('box-danger');
            badge.addClass('bg-red').text(data.statusPeserta.keterangan || 'TIDAK AKTIF');
        }

        $('#resNama').text(data.nama);
        $('#resNik').text(data.nik);
        $('#resNoKartu').text(data.noKartu);
        $('#resTglLahir').text(data.tglLahir);
        $('#resUmur').text(data.umur.umurSekarang);
        $('#resJk').text((data.sex === 'L') ? 'Laki-Laki' : 'Perempuan');

        let jns = data.jenisPeserta.keterangan;
        $('#resJenisPeserta').text(jns);

        $('#resHakKelas').text(data.hakKelas.keterangan);
        $('#resFaskes').text(data.provUmum.nmProvider);
        $('#resNoHp').text(data.mr.noTelepon || '-');

        if (jns.toLowerCase().includes('pbi')) {
            $('#infoDinsos').show();
        } else {
            $('#infoDinsos').hide();
        }
    }
</script>
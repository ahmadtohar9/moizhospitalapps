<style>
    .form-header {
        background: linear-gradient(90deg, #3c8dbc 0%, #605ca8 100%);
        color: white;
        padding: 15px;
        border-radius: 5px 5px 0 0;
        font-weight: bold;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-header h3 {
        margin: 0;
        font-size: 18px;
    }

    .card-box {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        border-top: 3px solid #3c8dbc;
    }

    .form-group label {
        font-weight: 600;
        color: #444;
        font-size: 12px;
    }

    .btn-save {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        border: none;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .table-custom thead {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .select2-container .select2-selection--single {
        height: 34px !important;
        border-radius: 0;
        border-color: #d2d6de;
    }

    /* Layout Helpers */
    .section-title {
        border-bottom: 1px solid #eee;
        margin-top: 25px;
        margin-bottom: 15px;
        padding-bottom: 5px;
        color: #555;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .input-group-addon {
        background-color: #f4f4f4;
    }

    /* FIX SELECT2 Z-INDEX & INPUT VISIBILITY */
    .select2-container--open {
        z-index: 999999 !important;
    }

    .select2-search__field {
        display: inline-block !important;
        visibility: visible !important;
    }
</style>

<div class="box-header with-border">
    <h3 class="box-title"><b><i class="fa fa-cut"></i> Input Tindakan Operasi</b></h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh"><i
                class="fa fa-refresh"></i></button>
    </div>
</div>

<div class="box-body" style="background: #ecf0f5;">

    <div class="row">
        <!-- LEFT COLUMN: INPUT FORM -->
        <div class="col-md-7">
            <div class="card-box">
                <div class="form-header">
                    <h3><i class="fa fa-edit"></i> Form Input Operasi</h3>
                </div>

                <form id="form-operasi">
                    <input type="hidden" name="no_rawat" id="no_rawat" value="<?= $no_rawat; ?>">

                    <!-- ---- WAKTU & PAKET ---- -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Operasi</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control datepicker" name="tgl_operasi"
                                        value="<?= date('d-m-Y', strtotime($tgl_sekarang)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mulai</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" class="form-control" name="jam_operasi" id="jam_input"
                                        value="<?= $jam_sekarang; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Selesai</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" class="form-control" name="jam_selesai" value=""
                                        placeholder="HH:MM:SS">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Paket Operasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control search-paket" placeholder="Ketik nama paket operasi..."
                            autocomplete="off">
                        <input type="hidden" name="kode_paket" id="kode_paket">
                        <input type="hidden" name="tgl_operasi_lama" id="tgl_operasi_lama" value="">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Anestesi</label>
                                <select class="form-control" name="jenis_anasthesi">
                                    <option value="Lokal">Lokal</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Spinal">Spinal</option>
                                    <option value="Epidural">Epidural</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="kategori">
                                    <option value="Khusus">Khusus</option>
                                    <option value="Besar">Besar</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Kecil">Kecil</option>
                                    <option value="Elektif">Elektif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Implan</label>
                        <input type="text" class="form-control" name="nomor_implan" placeholder="-">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Dikirim PA?</label>
                            <select class="form-control" name="request_pa">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Jaringan Eksisi/Insisi</label>
                            <input type="text" class="form-control" name="jaringan_pa">
                        </div>
                    </div>


                    <!-- ---- TENAGA MEDIS ---- -->
                    <div class="section-title"><i class="fa fa-user-md"></i> Tim Dokter</div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator 1 (Utama)</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="operator1" value="-">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator 2</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="operator2" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator 3</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="operator3" value="-">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokter Anestesi</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="dokter_anestesi" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokter Anak</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="dokter_anak" value="-">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokter PJ Anak</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="dokter_pjanak" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokter Umum</label>
                                <input type="text" class="form-control search-dokter" placeholder="Cari Dokter..."
                                    autocomplete="off">
                                <input type="hidden" name="dokter_umum" value="-">
                            </div>
                        </div>
                    </div>


                    <div class="section-title"><i class="fa fa-users"></i> Tim Asisten & Perawat</div>

                    <div class="row">
                        <!-- ASISTEN OPERATOR -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Asst. Op 1</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="asisten_operator1" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Asst. Op 2</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="asisten_operator2" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Asst. Op 3</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="asisten_operator3" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ASISTEN ANESTESI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Asst. Anestesi 1</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="asisten_anestesi" value="-">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Asst. Anestesi 2</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="asisten_anestesi2" value="-">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- BIDAN -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bidan 1</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Bidan..."
                                    autocomplete="off">
                                <input type="hidden" name="bidan" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bidan 2</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Bidan..."
                                    autocomplete="off">
                                <input type="hidden" name="bidan2" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bidan 3</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Bidan..."
                                    autocomplete="off">
                                <input type="hidden" name="bidan3" value="-">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Perawat Luar</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="perawat_luar" value="-">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instrumen</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="instrument" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Perawat Resusitasi</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="perawat_resusitas" value="-">
                            </div>
                        </div>
                    </div>


                    <div class="section-title"><i class="fa fa-refresh"></i> Omloop</div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label>Omloop 1</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="omloop" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Omloop 2</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="omloop2" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Omloop 3</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="omloop3" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Omloop 4</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="omloop4" value="-">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Omloop 5</label>
                                <input type="text" class="form-control search-petugas" placeholder="Cari Petugas..."
                                    autocomplete="off">
                                <input type="hidden" name="omloop5" value="-">
                            </div>
                        </div>
                    </div>

                    <div class="section-title"><i class="fa fa-file-text-o"></i> Laporan & Diagnosis</div>
                    <div class="form-group">
                        <label>Diagnosis Pre-Operatif</label>
                        <textarea class="form-control" name="diagnosa_pre" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Diagnosis Post-Operatif</label>
                        <textarea class="form-control" name="diagnosa_post" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Laporan Operasi</label>
                        <textarea class="form-control" name="laporan_operasi" rows="6"
                            placeholder="Tuliskan jalannya operasi..."></textarea>
                    </div>


                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-save btn-lg btn-block" id="btn-save-operasi">
                            <i class="fa fa-save"></i> SIMPAN DATA OPERASI
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: HISTORY -->
        <div class="col-md-5">
            <div class="card-box">
                <div class="form-header" style="background: linear-gradient(90deg, #dd4b39 0%, #b02a1b 100%);">
                    <h3><i class="fa fa-history"></i> Riwayat Operasi</h3>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 130px;">Tanggal</th>
                                <th>Paket Op / Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list-operasi-tbody">
                            <tr>
                                <td colspan="4" class="text-center"><i class="fa fa-spin fa-refresh"></i> Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="alert alert-info">
                <h4><i class="icon fa fa-info"></i> Informasi</h4>
                Pastikan data yang diinput sudah benar. Data operasi akan masuk ke tagihan pasien dan rekam medis.
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        // Manual Build URL
        var path = window.location.pathname;
        var root = path.split('/')[1];
        var API_URL = window.location.origin + '/' + root + '/index.php/operasi/';

        // =============== AUTOCOMPLETE SETUP ===============

        // 1. AUTOCOMPLETE PAKET
        $(".search-paket").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: API_URL + 'cari_paket',
                    dataType: "json",
                    data: { q: request.term },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.text,
                                value: item.text,
                                id: item.id
                            };
                        }));
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                // Set hidden field value
                $(this).next('input[type=hidden]').val(ui.item.id);
            },
            change: function (event, ui) {
                if (!ui.item) {
                    // Optional: Clear if no valid selection
                    // $(this).val(''); 
                    // $(this).next('input[type=hidden]').val('');
                }
            }
        });

        // 2. AUTOCOMPLETE DOKTER (Generic Class)
        $(".search-dokter").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: API_URL + 'cari_dokter',
                    dataType: "json",
                    data: { q: request.term },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.text,
                                value: item.text, // Fill input with name
                                id: item.id       // Hidden Key
                            };
                        }));
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                $(this).next('input[type=hidden]').val(ui.item.id);
            }
        });

        // 3. AUTOCOMPLETE PETUGAS (Generic Class)
        $(".search-petugas").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: API_URL + 'cari_petugas',
                    dataType: "json",
                    data: { q: request.term },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.text,
                                value: item.text,
                                id: item.id
                            };
                        }));
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                $(this).next('input[type=hidden]').val(ui.item.id);
            }
        });


        // Initialize Datepicker
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Real-time Clock for Jam Selesai
        var isJamSelesaiFocused = false;
        $('input[name="jam_selesai"]').on('focus', function () { isJamSelesaiFocused = true; });
        $('input[name="jam_selesai"]').on('blur', function () { isJamSelesaiFocused = false; });

        setInterval(function () {
            if (!isJamSelesaiFocused) {
                var now = new Date();
                var timeString = now.toTimeString().split(' ')[0];
                $('input[name="jam_selesai"]').val(timeString);
            }
        }, 1000);

        $('#btn-save-operasi').click(function () {
            var btn = $(this);
            var form = $('#form-operasi');

            // Validation simple
            if ($('#kode_paket').val() == '' || $('#kode_paket').val() == null || $('#kode_paket').val() == '-') {
                Swal.fire('Peringatan', 'Paket Operasi wajib dipilih (gunakan pencarian).', 'warning');
                return;
            }
            if ($('input[name="operator1"]').val() == '' || $('input[name="operator1"]').val() == '-') {
                Swal.fire('Peringatan', 'Operator 1 (Utama) wajib diisi.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Simpan Data Operasi?',
                text: "Pastikan data sudah benar",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

                    $.post('<?= base_url("OperasiController/save") ?>', form.serialize(), function (res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: res.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // Reset Form & Reload History
                            form[0].reset();
                            $('#tgl_operasi_lama').val(''); // Clear edit marker
                            $('.search-paket, .search-dokter, .search-petugas').val(''); // Clear auto inputs
                            $('[type=hidden]').not('[name=no_rawat]').not('[name=tgl_operasi_lama]').val('-');
                            loadHistory();

                            btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN DATA OPERASI');
                            // Scroll back to history/top
                            $('html, body').animate({
                                scrollTop: 0
                            }, 500);
                        } else {
                            btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN DATA OPERASI');
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }, 'json').fail(function (xhr) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN DATA OPERASI');
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    });
                }
            });
        });

        // Initial Load
        loadHistory();
    });

    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan;
    }

    function loadHistory() {
        var no_rawat = '<?= $no_rawat ?>';
        $.getJSON('<?= base_url("OperasiController/get_riwayat_operasi") ?>', { no_rawat: no_rawat }, function (res) {
            $('#list-operasi-tbody').html(res.html);
        });
    }

    function hapusOperasi(no_rawat, tgl_operasi) {
        Swal.fire({
            title: 'Hapus Operasi?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url("OperasiController/delete") ?>',
                    { no_rawat: no_rawat, tgl_operasi: tgl_operasi },
                    function (res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: res.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            loadHistory();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }, 'json');
            }
        });
    }

    function lihatOperasi(rawData) {
        var data = JSON.parse(atob(rawData));
        var val = (v) => (v && v !== '-' && v !== '0000-00-00 00:00:00') ? v : '<span class="text-muted">-</span>';
        var money = (v) => formatRupiah(v || 0);

        // Staff Row Helper (Filter '-')
        var rowStaff = (role, name, cost) => {
            if(!name || name === '-' || name === '') return '';
            return `<tr><td>${role}</td><td><i class="fa fa-user-md text-muted"></i> ${name}</td><td class="text-right">${money(cost)}</td></tr>`;
        };

        // SOAP Logic
        var s = data.soap || {};
        var soapHtml = '';
        if(s.tgl_perawatan) {
             soapHtml = `
             <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-heartbeat"></i> Tanda-Tanda Vital (TTV)</h3>
                        </div>
                        <div class="box-body">
                            <div class="row text-center">
                                <div class="col-xs-2 border-right"><h5><strong>${val(s.suhu_tubuh)}°C</strong></h5><small>Suhu</small></div>
                                <div class="col-xs-2 border-right"><h5><strong>${val(s.tensi)}</strong></h5><small>Tensi</small></div>
                                <div class="col-xs-2 border-right"><h5><strong>${val(s.nadi)}</strong></h5><small>Nadi</small></div>
                                <div class="col-xs-2 border-right"><h5><strong>${val(s.respirasi)}</strong></h5><small>RR</small></div>
                                <div class="col-xs-2 border-right"><h5><strong>${val(s.gcs)}</strong></h5><small>GCS</small></div>
                                <div class="col-xs-2"><h5><strong>${val(s.spo2)}%</strong></h5><small>SPO2</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pemeriksaan SOAP</h3>
                        </div>
                        <div class="box-body">
                             <dl class="dl-horizontal">
                                <dt class="text-blue">Subjektif (S)</dt><dd>${val(s.keluhan)}</dd>
                                <dt class="text-blue">Objektif (O)</dt><dd>${val(s.pemeriksaan)}</dd>
                                <dt class="text-blue">Asesmen (A)</dt><dd>${val(s.penilaian)}</dd>
                                <dt class="text-blue">Plan (P)</dt><dd>${val(s.rtl)}</dd>
                             </dl>
                        </div>
                    </div>
                </div>
             </div>`;
        } else {
             soapHtml = `<div class="callout callout-warning">Belum ada data pemeriksaan klinis (SOAP) yang terekam.</div>`;
        }

        var printUrl = '<?= base_url("OperasiController/cetak") ?>?no_rawat=' + data.no_rawat + '&tgl_operasi=' + data.tgl_operasi;

        var html = `
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_info" data-toggle="tab"><i class="fa fa-info-circle"></i> Ringkasan & Tim</a></li>
                <li><a href="#tab_laporan" data-toggle="tab"><i class="fa fa-file-text-o"></i> Laporan & Diagnosa</a></li>
                <li><a href="#tab_klinis" data-toggle="tab"><i class="fa fa-stethoscope"></i> Data Klinis (SOAP)</a></li>
                <li class="pull-right">
                    <button class="btn btn-danger btn-sm" onclick="window.open('${printUrl}', '_blank')"><i class="fa fa-print"></i> Cetak PDF Laporan</button>
                </li>
            </ul>
            <div class="tab-content">
                <!-- TAB 1: INFO & TIM -->
                <div class="tab-pane active" id="tab_info">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border"><h3 class="box-title">Info Operasi</h3></div>
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tr><td><strong>Paket</strong></td><td>${val(data.nm_paket_operasi)}</td></tr>
                                        <tr><td><strong>No. Rawat</strong></td><td><span class="label label-success">${data.no_rawat}</span></td></tr>
                                        <tr><td><strong>Waktu</strong></td><td>${val(data.tgl_operasi)}</td></tr>
                                        <tr><td><strong>Selesai</strong></td><td>${val(data.selesaioperasi)}</td></tr>
                                        <tr><td><strong>Anestesi</strong></td><td>${val(data.jenis_anasthesi)} (${val(data.kategori)})</td></tr>
                                        <tr><td><strong>Status</strong></td><td>${val(data.status)}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                             <h4 class="text-blue" style="margin-top:0">Tim Operasi & Biaya</h4>
                             <div class="table-responsive" style="max-height:400px; overflow-y:auto; border:1px solid #f4f4f4">
                                <table class="table table-hover table-condensed">
                                    <thead class="bg-gray-light">
                                        <tr><th>Peran</th><th>Nama</th><th class="text-right">Biaya</th></tr>
                                    </thead>
                                    <tbody>
                                        ${rowStaff('Operator 1', data.nm_operator1, data.biayaoperator1)}
                                        ${rowStaff('Operator 2', data.nm_operator2, data.biayaoperator2)}
                                        ${rowStaff('Operator 3', data.nm_operator3, data.biayaoperator3)}
                                        ${rowStaff('Asisten Op 1', data.nm_asisten_operator1, data.biayaasisten_operator1)}
                                        ${rowStaff('Asisten Op 2', data.nm_asisten_operator2, data.biayaasisten_operator2)}
                                        ${rowStaff('Dr. Anestesi', data.nm_dokter_anestesi, data.biayadokter_anestesi)}
                                        ${rowStaff('Ast. Anestesi', data.nm_asisten_anestesi, data.biayaasisten_anestesi)}
                                        ${rowStaff('Dr. Anak', data.nm_dokter_anak, data.biayadokter_anak)}
                                        ${rowStaff('Prw. Resus', data.nm_perawat_resusitas, data.biayaperawaat_resusitas)}
                                        ${rowStaff('Bidan', data.nm_bidan, data.biayabidan)}
                                        ${rowStaff('Instrumen', data.nm_instrumen, data.biayainstrumen)}
                                        ${rowStaff('Omloop', data.nm_omloop, data.biaya_omloop)}
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray-active">
                                            <th colspan="2" class="text-right">Total Estimasi</th>
                                            <th class="text-right">${money(parseInt(data.biayaoperator1) + parseInt(data.biayasewaok) + parseInt(data.biayaalat))}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: LAPORAN -->
                <div class="tab-pane" id="tab_laporan">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="15%" class="bg-gray-light">Diagnosa Pre-Op</th>
                                    <td width="35%">${val(data.diagnosa_preop)}</td>
                                    <th width="15%" class="bg-gray-light">Jaringan Eksisi</th>
                                    <td width="35%">${val(data.jaringan_dieksekusi)}</td>
                                </tr>
                                <tr>
                                    <th class="bg-gray-light">Diagnosa Post-Op</th>
                                    <td>${val(data.diagnosa_postop)}</td>
                                    <th class="bg-gray-light">Permintaan PA</th>
                                    <td>${val(data.permintaan_pa)} (Implan: ${val(data.nomor_implan)})</td>
                                </tr>
                            </table>
                            <div class="box box-success box-solid">
                                <div class="box-header with-border"><h3 class="box-title">Laporan Lengkap Jalannya Operasi</h3></div>
                                <div class="box-body">
                                    <div style="white-space: pre-wrap; font-family: 'Courier New', Courier, monospace; font-size:13px; line-height:1.5">${val(data.laporan_operasi)}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: SOAP -->
                <div class="tab-pane" id="tab_klinis">
                    ${soapHtml}
                </div>
            </div>
        </div>
        `;
        
        $('#detail-operasi-body').html(html);
        $('#modal-lihat-operasi').find('.modal-dialog').css('width', '90%');
        $('#modal-lihat-operasi').modal('show');
    }

    function editOperasi(rawData) {
        var data = JSON.parse(atob(rawData));

        // 1. Populate basic inputs
        $('input[name="tgl_operasi_lama"]').val(data.tgl_operasi);

        // Split datetime YYYY-MM-DD HH:mm:ss
        var dt = data.tgl_operasi.split(' ');
        var d = dt[0].split('-');
        $('input[name="tgl_operasi"]').val(d[2] + '-' + d[1] + '-' + d[0]);
        $('input[name="jam_operasi"]').val(dt[1]);

        $('select[name="jenis_anasthesi"]').val(data.jenis_anasthesi);
        $('select[name="kategori"]').val(data.kategori);

        // Populate Laporan (Map DB columns to Form Names CORRECTLY)
        $('textarea[name="diagnosa_pre"]').val(data.diagnosa_preop);
        $('textarea[name="diagnosa_post"]').val(data.diagnosa_postop);
        $('textarea[name="laporan_operasi"]').val(data.laporan_operasi);

        // Input names from form HTML (Step 366 reference)
        $('input[name="jaringan_pa"]').val(data.jaringan_dieksekusi);
        $('input[name="nomor_implan"]').val(data.nomor_implan);
        $('select[name="request_pa"]').val(data.permintaan_pa);

        // 2. Populate Autocomplete Inputs (Text and Hidden ID)
        // Correct Selector Logic: Find hidden input by NAME, then find sibling text input
        var setAC = (hiddenName, textVal, idVal) => {
            var hidden = $('input[name="' + hiddenName + '"]');
            var textInput = hidden.parents('.form-group').find('input[type="text"].search-dokter, input[type="text"].search-petugas, input[type="text"].search-paket');

            // If not found by generic class, try prev()
            if (textInput.length === 0) textInput = hidden.prev('input');

            hidden.val(idVal && idVal !== '-' ? idVal : '-');
            textInput.val(textVal && textVal !== '-' ? textVal : '');
        };

        setAC('kode_paket', data.nm_paket_operasi, data.kode_paket);

        setAC('operator1', data.nm_operator1, data.operator1);
        setAC('operator2', data.nm_operator2, data.operator2);
        setAC('operator3', data.nm_operator3, data.operator3);

        setAC('dokter_anestesi', data.nm_dokter_anestesi, data.dokter_anestesi);
        setAC('dokter_anak', data.nm_dokter_anak, data.dokter_anak);
        setAC('dokter_pjanak', data.nm_dokter_pjanak, data.dokter_pjanak);
        setAC('dokter_umum', data.nm_dokter_umum, data.dokter_umum);

        setAC('asisten_operator1', data.nm_asisten_operator1, data.asisten_operator1);
        setAC('asisten_operator2', data.nm_asisten_operator2, data.asisten_operator2);
        setAC('asisten_operator3', data.nm_asisten_operator3, data.asisten_operator3);

        setAC('asisten_anestesi', data.nm_asisten_anestesi, data.asisten_anestesi);
        setAC('asisten_anestesi2', data.nm_asisten_anestesi2, data.asisten_anestesi2);

        setAC('perawat_resusitas', data.nm_perawat_resusitas, data.perawaat_resusitas);
        setAC('perawat_luar', data.nm_perawat_luar, data.perawat_luar);

        setAC('bidan', data.nm_bidan, data.bidan);
        setAC('bidan2', data.nm_bidan2, data.bidan2);
        setAC('bidan3', data.nm_bidan3, data.bidan3);

        setAC('instrument', data.nm_instrumen, data.instrumen); // hidden name: instrument

        setAC('omloop', data.nm_omloop, data.omloop);
        setAC('omloop2', data.nm_omloop2, data.omloop2);
        setAC('omloop3', data.nm_omloop3, data.omloop3);
        setAC('omloop4', data.nm_omloop4, data.omloop4);
        setAC('omloop5', data.nm_omloop5, data.omloop5);

        // Change Button Text
        $('#btn-simpan').html('<i class="fa fa-pencil-square-o"></i> UPDATE DATA OPERASI');

        // Scroll Up
        $('html, body').animate({
            scrollTop: $("#form-operasi").offset().top - 50
        }, 500);

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'info',
            title: 'Mode Edit Aktif',
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>

<!-- MODAL LIHAT OPERASI -->
<div class="modal fade" id="modal-lihat-operasi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-procedures"></i> Detail Operasi</h4>
            </div>
            <div class="modal-body" id="detail-operasi-body">
                <!-- Content injected by JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
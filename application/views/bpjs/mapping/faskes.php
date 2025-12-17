<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-hospital-o"></i> Mapping Fasilitas Kesehatan
            <small>Mapping Perujuk RS ke Faskes BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Faskes</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info">
            <h4><i class="fa fa-info-circle"></i> Pencarian Faskes BPJS</h4>
            <p>Halaman ini digunakan untuk mencari kode dan nama Fasilitas Kesehatan (Faskes) yang terdaftar di BPJS
                Kesehatan (PCare/RS) sebagai referensi rujukan.</p>
        </div>

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

        <!-- SEARCH INTERFACE ONLY -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Faskes BPJS</h3>
                    </div>
                    <div class="box-body">
                        <!-- Jenis Faskes Selection -->
                        <div class="form-group">
                            <label>1. Pilih Jenis Faskes:</label>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="jenisFaskes" value="1" checked> Faskes Tingkat 1
                                        (Puskesmas/Klinik)
                                    </label>
                                </div>
                                <div class="col-xs-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="jenisFaskes" value="2"> Faskes Rujukan (RS)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Search Input -->
                        <div class="form-group">
                            <label>2. Cari Nama Faskes:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" id="keywordBPJS" class="form-control" placeholder="Ketik nama faskes minimal 3 huruf..." autocomplete="off">
                                <span class="input-group-addon" id="iconLoading" style="display:none;"><i class="fa fa-spinner fa-spin text-green"></i></span>
                            </div>
                            <small class="text-muted">Ketik untuk mencari otomatis (Puskesmas, RSUD, Klinik, dll)</small>
                        </div>

                        <!-- Results -->
                        <div id="searchResults" style="display: none; margin-top: 15px;">
                            <p><strong>Hasil Pencarian:</strong> <span id="resCount" class="badge bg-green">0</span></p>
                            <div id="bpjsList" class="list-group" style="max-height: 400px; overflow-y: auto;">
                                <!-- Items here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Lodash for debounce -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<script>
    let selectedRS = null;
    let selectedBPJS = null;

    $(document).ready(function () {
        $('#tableMapped').DataTable();

        $('#searchRS').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#rsList a').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // Select RS
        $(document).on('click', '.rs-item', function (e) {
            e.preventDefault();
            $('.rs-item').removeClass('active');
            $(this).addClass('active');
            selectedRS = $(this).data('nama');
            checkBtn();
        });

        // Debounced search function (wait 500ms after typing stops)
        const debouncedSearch = _.debounce(function() {
            searchBPJS();
        }, 500);

        $('#keywordBPJS').on('input', function() {
            let kw = $(this).val().trim();
            if(kw.length >= 3) {
                $('#iconLoading').show();
                debouncedSearch();
            } else {
                $('#searchResults').hide();
                $('#bpjsList').empty();
                $('#iconLoading').hide(); // Hide loading icon if input is too short
            }
        });

        // Re-search when type changes
        $('input[name="jenisFaskes"]').change(function() {
            if($('#keywordBPJS').val().trim().length >= 3) {
                searchBPJS();
            }
        });

        $('#btnMap').click(function () {
            simpanMapping();
        });
    });

    function searchBPJS() {
        let kw = $('#keywordBPJS').val().trim();
        let jenis = $('input[name="jenisFaskes"]:checked').val();

        if(kw.length < 3) return;

        $('#iconLoading').show();

        $.ajax({
            url: '<?= base_url("bpjs/mapping/search_faskes_bpjs"); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: { keyword: kw, jenis_faskes: jenis },
            success: function(res) {
                $('#iconLoading').hide();
                $('#searchResults').show();
                $('#bpjsList').empty();

                if(res.success) {
                    $('#resCount').text(res.count);
                    
                    if(res.data && res.data.length > 0) {
                        $.each(res.data, function(i, v){
                            let html = `
                                <div class="list-group-item bpjs-item" 
                                   data-kode="${v.kode}" data-nama="${v.nama}">
                                    <h4 class="list-group-item-heading text-primary font-weight-bold">${v.nama}</h4>
                                    <p class="list-group-item-text">
                                        Kode: <span class="label label-success" style="font-size: 100%;">${v.kode}</span>
                                        &nbsp; <i class="fa fa-check-circle text-success"></i> Aktif
                                    </p>
                                </div>
                            `;
                            $('#bpjsList').append(html);
                        });

                        // Bind click for selection
                        $('.bpjs-item').click(function (e) {
                            e.preventDefault();
                            $('.bpjs-item').removeClass('active');
                            $(this).addClass('active');
                            selectedBPJS = {
                                kode: $(this).data('kode'),
                                nama: $(this).data('nama')
                            };
                            checkBtn();
                        });

                    } else {
                        $('#bpjsList').html('<div class="alert alert-warning text-center">Data tidak ditemukan. Coba kata kunci lain.</div>');
                        $('#resCount').text('0');
                    }
                } else {
                    $('#bpjsList').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            error: function() {
                $('#iconLoading').hide();
                // Silent error or simple notification
                Swal.fire('Error', 'Gagal koneksi server', 'error');
            }
        });
    }

    function checkBtn() {
        if (selectedRS && selectedBPJS) {
            $('#btnMap').prop('disabled', false);
        } else {
            $('#btnMap').prop('disabled', true);
        }
    }

    function simpanMapping() {
        let jenis = $('input[name="jenisFaskes"]:checked').val();

        Swal.fire({
            title: 'Simpan Mapping?',
            html: `Map <b>${selectedRS}</b> <br>ke<br> <b>[${selectedBPJS.kode}] ${selectedBPJS.nama}</b>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("bpjs/mapping/save_mapping_faskes"); ?>',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        nama_faskes_rs: selectedRS,
                        kode_faskes_bpjs: selectedBPJS.kode,
                        nama_faskes_bpjs: selectedBPJS.nama,
                        jenis_faskes: jenis
                    },
                    success: function (r) {
                        if (r.success) {
                            Swal.fire('Berhasil', r.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Gagal', r.message, 'error');
                        }
                    }
                });
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Mapping?',
            text: 'Data akan dikembalikan ke daftar unmapped',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("bpjs/mapping/delete_mapping_faskes_ajax"); ?>',
                    type: 'POST',
                    dataType: 'JSON',
                    data: { id: id },
                    success: function (r) {
                        if (r.success) {
                            Swal.fire('Deleted!', 'Mapping dihapus.', 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Error', r.message, 'error');
                        }
                    }
                });
            }
        });
    }
</script>

<style>
    .list-group-item:hover {
        background: #f9f9f9;
    }

    .list-group-item.active {
        background: #3c8dbc;
        border-color: #3c8dbc;
        color: white;
    }

    .list-group-item.active h4,
    .list-group-item.active h5,
    .list-group-item.active p {
        color: white !important;
    }

    .list-group-item.active .label {
        background: white;
        color: #3c8dbc;
    }

    #btnMap:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    #btnMap:active:not(:disabled) {
        transform: translateY(-1px);
    }

    #btnMap:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
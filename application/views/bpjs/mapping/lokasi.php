<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-marker"></i> Referensi Lokasi
            <small>Propinsi, Kabupaten, Kecamatan BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Lokasi</li>
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
            <!-- PROPINSI -->
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-map"></i> 1. Propinsi</h3>
                        <div class="box-tools pull-right">
                            <input type="text" id="searchProp" class="form-control input-sm" placeholder="Cari..."
                                style="width: 150px;">
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="loadingProp" style="text-align: center; display: none;">
                            <i class="fa fa-spinner fa-spin text-green"></i> Loading...
                        </div>
                        <div class="list-group location-list" id="listPropinsi"
                            style="max-height: 500px; overflow-y: auto;">
                            <!-- List Propinsi -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- KABUPATEN -->
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-building"></i> 2. Kabupaten/Kota</h3>
                        <div class="box-tools pull-right">
                            <input type="text" id="searchKab" class="form-control input-sm" placeholder="Cari..."
                                style="width: 150px; display: none;">
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="loadingKab" style="text-align: center; display: none;">
                            <i class="fa fa-spinner fa-spin text-orange"></i> Loading...
                        </div>
                        <div id="emptyKab" class="text-center text-muted" style="padding: 20px;">
                            <i class="fa fa-arrow-left"></i> Pilih Propinsi dahulu
                        </div>
                        <div class="list-group location-list" id="listKabupaten"
                            style="max-height: 500px; overflow-y: auto; display: none;">
                            <!-- List Kabupaten -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- KECAMATAN -->
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-home"></i> 3. Kecamatan</h3>
                        <div class="box-tools pull-right">
                            <input type="text" id="searchKec" class="form-control input-sm" placeholder="Cari..."
                                style="width: 150px; display: none;">
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="loadingKec" style="text-align: center; display: none;">
                            <i class="fa fa-spinner fa-spin text-blue"></i> Loading...
                        </div>
                        <div id="emptyKec" class="text-center text-muted" style="padding: 20px;">
                            <i class="fa fa-arrow-left"></i> Pilih Kabupaten dahulu
                        </div>
                        <div class="list-group location-list" id="listKecamatan"
                            style="max-height: 500px; overflow-y: auto; display: none;">
                            <!-- List Kecamatan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .location-list .list-group-item {
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .location-list .list-group-item:hover {
        background-color: #f5f5f5;
    }

    .location-list .list-group-item.active {
        background-color: #3c8dbc;
        /* AdminLTE Blue */
        border-color: #3c8dbc;
        color: white;
    }

    .location-list .list-group-item.active .text-muted {
        color: #e6e6e6 !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // BASE_URL assumed defined
    let currentProp = null;
    let currentKab = null;

    $(document).ready(function () {
        loadPropinsi();

        // Search filters
        $('#searchProp').keyup(function () {
            filterList('#listPropinsi', $(this).val());
        });
        $('#searchKab').keyup(function () {
            filterList('#listKabupaten', $(this).val());
        });
        $('#searchKec').keyup(function () {
            filterList('#listKecamatan', $(this).val());
        });
    });

    function filterList(selector, value) {
        value = value.toLowerCase();
        $(selector + ' .list-group-item').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    }

    function loadPropinsi() {
        $('#loadingProp').show();
        $.ajax({
            url: '<?= base_url("bpjs/mapping/get_propinsi"); ?>',
            type: 'GET',
            dataType: 'JSON',
            success: function (res) {
                $('#loadingProp').hide();
                if (res.success) {
                    let html = '';
                    res.data.forEach(item => {
                        html += `
                            <a href="#" class="list-group-item" onclick="selectProp('${item.kode}', '${item.nama}', this)">
                                <h5 class="list-group-item-heading font-weight-bold">${item.nama}</h5>
                                <p class="list-group-item-text text-muted small">Kode: ${item.kode}</p>
                            </a>
                        `;
                    });
                    $('#listPropinsi').html(html);
                } else {
                    $('#listPropinsi').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function () {
                $('#loadingProp').hide();
                Swal.fire('Error', 'Gagal memuat data propinsi', 'error');
            }
        });
    }

    function selectProp(kode, nama, el) {
        // Highlight logic
        $('#listPropinsi .list-group-item').removeClass('active');
        $(el).addClass('active');

        currentProp = { kode, nama };
        currentKab = null;

        // Reset next columns
        $('#listKabupaten').hide().empty();
        $('#searchKab').hide().val('');
        $('#emptyKab').show();

        $('#listKecamatan').hide().empty();
        $('#searchKec').hide().val('');
        $('#emptyKec').show().html('<i class="fa fa-arrow-left"></i> Pilih Kabupaten dahulu');

        // Load Kabupaten
        loadKabupaten(kode);
    }

    function loadKabupaten(kodeProp) {
        $('#emptyKab').hide();
        $('#loadingKab').show();

        $.ajax({
            url: '<?= base_url("bpjs/mapping/get_kabupaten"); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: { kode_propinsi: kodeProp },
            success: function (res) {
                $('#loadingKab').hide();
                if (res.success) {
                    let html = '';
                    res.data.forEach(item => {
                        html += `
                            <a href="#" class="list-group-item" onclick="selectKab('${item.kode}', '${item.nama}', this)">
                                <h5 class="list-group-item-heading font-weight-bold">${item.nama}</h5>
                                <p class="list-group-item-text text-muted small">Kode: ${item.kode}</p>
                            </a>
                        `;
                    });
                    $('#listKabupaten').html(html).show();
                    $('#searchKab').show();
                } else {
                    $('#listKabupaten').html('<div class="alert alert-warning">Tidak ada data</div>').show();
                }
            },
            error: function () {
                $('#loadingKab').hide();
                Swal.fire('Error', 'Gagal memuat kabupaten', 'error');
            }
        });
    }

    function selectKab(kode, nama, el) {
        $('#listKabupaten .list-group-item').removeClass('active');
        $(el).addClass('active');

        currentKab = { kode, nama };

        // Reset next column
        $('#listKecamatan').hide().empty();
        $('#searchKec').hide().val('');
        $('#emptyKec').show();

        loadKecamatan(kode);
    }

    function loadKecamatan(kodeKab) {
        $('#emptyKec').hide();
        $('#loadingKec').show();

        // Controller expects 'kode_kabupaten'
        $.ajax({
            url: '<?= base_url("bpjs/mapping/get_kecamatan"); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: { kode_kabupaten: kodeKab },
            success: function (res) {
                $('#loadingKec').hide();
                if (res.success) {
                    let html = '';
                    res.data.forEach(item => {
                        html += `
                            <a href="#" class="list-group-item" onclick="return false;">
                                <h5 class="list-group-item-heading font-weight-bold">${item.nama}</h5>
                                <p class="list-group-item-text text-muted small">Kode: ${item.kode}</p>
                            </a>
                        `;
                    });
                    $('#listKecamatan').html(html).show();
                    $('#searchKec').show();
                } else {
                    $('#listKecamatan').html('<div class="alert alert-warning">Tidak ada data</div>').show();
                }
            },
            error: function () {
                $('#loadingKec').hide();
                Swal.fire('Error', 'Gagal memuat kecamatan', 'error');
            }
        });
    }
</script>
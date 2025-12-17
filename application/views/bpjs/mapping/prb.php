<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-heartbeat"></i> Mapping Diagnosa PRB
            <small>Program Rujuk Balik BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Diagnosa PRB</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info">
            <h4><i class="fa fa-info-circle"></i> Informasi PRB (Program Rujuk Balik)</h4>
            <p>Halaman ini untuk referensi kode dan nama diagnosa yang termasuk dalam Program Rujuk Balik (PRB) BPJS
                Kesehatan.</p>
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
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Diagnosa PRB</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Cari Nama/Kode Diagnosa PRB:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" id="keywordPRB" class="form-control"
                                    placeholder="Ketik minimal 3 huruf..." autocomplete="off">
                                <span class="input-group-addon" id="loadingIcon" style="display:none;"><i
                                        class="fa fa-spinner fa-spin text-green"></i></span>
                            </div>
                            <small class="text-muted">Data dimuat otomatis dari BPJS saat halaman dibuka (Client-side
                                filtering)</small>
                        </div>

                        <div id="resultsArea">
                            <hr>
                            <p><strong>Daftar Diagnosa PRB:</strong> <span id="resCount" class="badge bg-green">0</span>
                            </p>

                            <div id="loadingInitial" class="text-center" style="padding: 20px;">
                                <i class="fa fa-spinner fa-spin fa-3x text-green"></i>
                                <p>Mengambil data referensi PRB dari BPJS...</p>
                            </div>

                            <div id="prbList" class="list-group"
                                style="max-height: 500px; overflow-y: auto; display: none;">
                                <!-- Items will be injected here -->
                            </div>

                            <div id="emptyState" class="alert alert-warning text-center" style="display: none;">
                                Tidak ada diagnosa ditemukan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global store for PRB data to enable fast client-side filtering
    let prbData = [];

    $(document).ready(function () {
        // Load data immediately
        loadDataPRB();

        // Search filter
        $('#keywordPRB').on('keyup', function () {
            let val = $(this).val().toLowerCase();
            filterData(val);
        });
    });

    function loadDataPRB() {
        $('#loadingInitial').show();
        $('#prbList').hide();
        $('#emptyState').hide();

        $.ajax({
            url: '<?= base_url("bpjs/mapping/search_diagnosa_prb"); ?>', // actually fetches ALL
            type: 'GET',
            dataType: 'JSON',
            success: function (res) {
                $('#loadingInitial').hide();
                if (res.success && res.data) {
                    prbData = res.data;
                    renderList(prbData);
                } else {
                    $('#emptyState').text(res.message || 'Gagal mengambil data.').show();
                }
            },
            error: function () {
                $('#loadingInitial').hide();
                $('#emptyState').text('Terjadi kesalahan koneksi ke server.').show();
            }
        });
    }

    function renderList(data) {
        $('#prbList').empty();

        if (data.length === 0) {
            $('#emptyState').show();
            $('#prbList').hide();
            $('#resCount').text(0);
            return;
        }

        let html = '';
        data.forEach(item => {
            html += `
                <div class="list-group-item prb-item">
                    <h4 class="list-group-item-heading text-primary font-weight-bold">
                        ${item.nama}
                    </h4>
                    <p class="list-group-item-text">
                        Kode: <span class="label label-success" style="font-size: 100%;">${item.kode}</span>
                    </p>
                </div>
            `;
        });

        $('#prbList').html(html).show();
        $('#resCount').text(data.length);
        $('#emptyState').hide();
    }

    function filterData(keyword) {
        if (!prbData.length) return;

        let filtered = prbData.filter(item => {
            return item.nama.toLowerCase().includes(keyword) ||
                item.kode.toLowerCase().includes(keyword);
        });

        renderList(filtered);
    }
</script>
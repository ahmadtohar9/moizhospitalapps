<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> Obat Program Rujuk Balik (PRB)
            <small>Referensi Obat BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Obat PRB</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info" style="border-left: 5px solid #00a65a;">
            <h4><i class="fa fa-info-circle"></i> Referensi Obat PRB</h4>
            <p>Pencarian daftar obat-obatan yang termasuk dalam Program Rujuk Balik (PRB).</p>
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
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Obat PRB</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Ketik nama obat:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" style="background-color: #e8f5e9;"><i
                                        class="fa fa-leaf text-green"></i></span>
                                <input type="text" id="keywordObat" class="form-control"
                                    placeholder="Contoh: Metformin, Amlodipine..." autocomplete="off">
                                <span class="input-group-addon" id="loadingIcon" style="display:none;"><i
                                        class="fa fa-spinner fa-spin text-green"></i></span>
                            </div>
                            <small class="text-muted">Ketik minimal 3 karakter untuk mencari</small>
                        </div>

                        <div id="searchResults" style="display: none;">
                            <hr>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h4 style="margin: 0;">Hasil Pencarian:</h4>
                                <span id="resCount" class="badge bg-green" style="font-size: 14px; padding: 5px 10px;">0
                                    hasil</span>
                            </div>

                            <div id="listObat" class="list-group" style="max-height: 400px; overflow-y: auto;">
                                <!-- Results -->
                            </div>
                        </div>

                        <div id="searchEmpty" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p>Ketik kata kunci untuk mulai mencari obat PRB</p>
                        </div>
                        <div id="searchError" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-exclamation-triangle fa-3x text-red"></i>
                            <p class="text-red" id="errorMsg"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchEmpty').show();

        const doSearch = _.debounce(function () {
            searchObat();
        }, 600);

        $('#keywordObat').on('input', function () {
            if ($(this).val().trim().length >= 3) {
                $('#loadingIcon').show();
                doSearch();
            } else {
                $('#loadingIcon').hide();
                $('#searchResults').hide();
                $('#searchEmpty').show();
                $('#searchError').hide();
            }
        });
    });

    function searchObat() {
        const keyword = $('#keywordObat').val().trim();

        $.ajax({
            url: '<?= base_url("bpjs/mapping/search_obat_prb"); ?>',
            type: 'POST',
            data: { keyword: keyword },
            dataType: 'JSON',
            success: function (res) {
                $('#loadingIcon').hide();

                if (res.success && res.data && res.data.length > 0) {
                    $('#searchEmpty').hide();
                    $('#searchError').hide();

                    let html = '';
                    res.data.forEach(item => {
                        html += `
                            <div class="list-group-item">
                                <h4 class="list-group-item-heading text-green font-weight-bold">
                                    ${item.nama}
                                </h4>
                                <p class="list-group-item-text text-muted">
                                    Kode: <span class="label label-success">${item.kode}</span>
                                </p>
                            </div>
                        `;
                    });

                    $('#listObat').html(html);
                    $('#resCount').text(res.data.length + ' hasil');
                    $('#searchResults').show();
                } else {
                    $('#searchResults').hide();
                    $('#searchError').hide();

                    let msg = `Tidak ada obat ditemukan untuk "${keyword}"`;
                    // Check if server returned a specific message
                    if (res.message) {
                        msg += `<br><small class="text-muted">BPJS Response: ${res.message}</small>`;
                    }

                    $('#searchEmpty').html(`
                        <i class="fa fa-times-circle fa-3x text-warning"></i>
                        <p>${msg}</p>
                    `).show();
                }
            },
            error: function () {
                $('#loadingIcon').hide();
                $('#searchResults').hide();
                $('#searchEmpty').hide();
                $('#errorMsg').text('Gagal menghubungi server BPJS.');
                $('#searchError').show();
            }
        });
    }
</script>
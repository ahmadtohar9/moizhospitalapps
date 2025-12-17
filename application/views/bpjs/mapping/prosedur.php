<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-scissors"></i> Pencarian Prosedur/Tindakan
            <small>Referensi ICD-9 BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Prosedur</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info" style="border-left: 5px solid #605ca8;">
            <h4><i class="fa fa-info-circle"></i> Referensi Prosedur (ICD-9)</h4>
            <p>Halaman ini digunakan untuk mencari kode dan nama Prosedur/Tindakan (ICD-9 CM) yang terdaftar di BPJS
                kesehatan.</p>
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
                <div class="box box-purple">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Prosedur ICD-9</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Ketik kode atau nama tindakan ICD-9:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" style="background-color: #f3e5f5;"><i
                                        class="fa fa-search text-purple"></i></span>
                                <input type="text" id="keywordProsedur" class="form-control"
                                    placeholder="Contoh: 00.1, USG, Injection..." autocomplete="off">
                                <span class="input-group-addon" id="loadingIcon" style="display:none;"><i
                                        class="fa fa-spinner fa-spin text-purple"></i></span>
                            </div>
                            <small class="text-muted">Ketik minimal 3 karakter untuk mencari otomatis</small>
                        </div>

                        <div id="searchResults" style="display: none;">
                            <hr>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h4 style="margin: 0;">Hasil Pencarian:</h4>
                                <span id="resCount" class="badge bg-purple"
                                    style="font-size: 14px; padding: 5px 10px;">0 hasil</span>
                            </div>

                            <div id="listProsedur" class="list-group" style="max-height: 400px; overflow-y: auto;">
                                <!-- Results -->
                            </div>
                        </div>

                        <div id="searchEmpty" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p>Ketik kata kunci untuk mulai mencari prosedur</p>
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

        // Debounce search
        const doSearch = _.debounce(function () {
            searchProsedur();
        }, 600);

        $('#keywordProsedur').on('input', function () {
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

    function searchProsedur() {
        const keyword = $('#keywordProsedur').val().trim();

        $.ajax({
            url: '<?= base_url("bpjs/mapping/search_prosedur_bpjs"); ?>',
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
                                <h4 class="list-group-item-heading text-purple font-weight-bold">
                                    <span class="label bg-purple" style="font-size: 100%; margin-right: 10px;">${item.kode}</span>
                                    ${item.nama}
                                </h4>
                            </div>
                        `;
                    });

                    $('#listProsedur').html(html);
                    $('#resCount').text(res.data.length + ' hasil');
                    $('#searchResults').show();
                } else {
                    $('#searchResults').hide();
                    $('#searchError').hide();

                    let msg = `Tidak ada prosedur ditemukan untuk "${keyword}"`;
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
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-stethoscope"></i> Mapping Diagnosa
            <small>ICD-10 RS ke BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Diagnosa</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info Box -->
        <div class="callout callout-info">
            <h4><i class="fa fa-info-circle"></i> Pencarian Diagnosa BPJS (ICD-10)</h4>
            <p>Halaman ini digunakan untuk mencari kode dan nama Diagnosa (ICD-10) yang terdaftar di BPJS kesehatan
                sebagai referensi.</p>
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
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Diagnosa ICD-10</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Ketik kode atau nama diagnosa ICD-10:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" id="searchDiagnosaBPJS" class="form-control"
                                    placeholder="Contoh: A00, Cholera..." autocomplete="off">
                                <span class="input-group-addon" id="searchLoading" style="display:none;"><i
                                        class="fa fa-spinner fa-spin text-green"></i></span>
                            </div>
                            <small class="text-muted">Ketik minimal 3 karakter untuk mencari otomatis</small>
                        </div>

                        <div id="searchResults" style="display: none;">
                            <hr>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h4 style="margin: 0;">Hasil Pencarian:</h4>
                                <span id="resultCount" class="badge bg-green"
                                    style="font-size: 14px; padding: 5px 10px;">0 hasil</span>
                            </div>
                            <div id="diagnosaBPJSList" class="list-group" style="max-height: 400px; overflow-y: auto;">
                                <!-- Results will be loaded here -->
                            </div>
                            <small class="text-muted" id="scrollHint" style="display: none;">
                                <i class="fa fa-info-circle"></i> Scroll untuk melihat hasil lainnya
                            </small>
                        </div>

                        <div id="searchEmpty" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p>Ketik kata kunci untuk mulai mencari diagnosa BPJS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Lodash -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<script>
    // BASE_URL already defined in header.php

    $(document).ready(function () {
        // Debounced search BPJS
        const debouncedSearch = _.debounce(function () {
            searchBPJS();
        }, 500);

        $('#searchDiagnosaBPJS').on('input', function () {
            let kw = $(this).val().trim();
            if (kw.length >= 3) {
                $('#searchLoading').show();
                debouncedSearch();
            } else {
                $('#searchResults').hide();
                $('#searchEmpty').show();
                $('#searchLoading').hide();
            }
        });

        $('#searchEmpty').show();
    });

    function searchBPJS() {
        const keyword = $('#searchDiagnosaBPJS').val().trim();

        $('#searchEmpty').hide();
        $('#searchLoading').show();

        $.ajax({
            url: BASE_URL + 'bpjs/mapping/search_diagnosa_bpjs',
            method: 'POST',
            data: { keyword: keyword },
            success: function (response) {
                $('#searchLoading').hide();
                const res = JSON.parse(response);

                if (res.success && res.data && res.data.length > 0) {
                    displaySearchResults(res.data);
                } else {
                    $('#searchEmpty').html(
                        '<i class="fa fa-times-circle fa-3x text-warning"></i>' +
                        '<p>Tidak ada hasil untuk "' + keyword + '"</p>'
                    ).show();
                }
            },
            error: function (xhr, status, error) {
                $('#searchLoading').hide();
                Swal.fire('Error', 'Gagal mencari data dari BPJS: ' + error, 'error');
            }
        });
    }

    function displaySearchResults(data) {
        let html = '';
        data.forEach(function (diag) {
            html += '<a href="#" class="list-group-item diagnosa-bpjs-item" ' +
                'data-kode="' + diag.kode + '" data-nama="' + diag.nama + '">' +
                '<h4 class="list-group-item-heading">' +
                '<span class="label label-success">' + diag.kode + '</span>' +
                '</h4>' +
                '<p class="list-group-item-text">' + diag.nama + '</p>' +
                '</a>';
        });

        $('#diagnosaBPJSList').html(html);
        $('#resultCount').text(data.length + ' hasil');

        if (data.length > 5) $('#scrollHint').show();
        else $('#scrollHint').hide();

        $('#searchResults').show();

        $('.diagnosa-bpjs-item').click(function (e) {
            e.preventDefault();
            $('.diagnosa-bpjs-item').removeClass('active');
            $(this).addClass('active');
            selectedDiagnosaBPJS = {
                kode: $(this).data('kode'),
                nama: $(this).data('nama')
            };
            checkSelection();
        });
    }

    function checkSelection() {
        if (selectedDiagnosaRS && selectedDiagnosaBPJS) {
            $('#btnMap').prop('disabled', false);
        } else {
            $('#btnMap').prop('disabled', true);
        }
    }

    function saveMapping() {
        if (!selectedDiagnosaRS || !selectedDiagnosaBPJS) return;

        Swal.fire({
            title: 'Konfirmasi Mapping',
            html: `
            <p>Mapping Diagnosa:</p>
            <div class="alert alert-info">
                <strong>RS:</strong> [${selectedDiagnosaRS.kode}] ${selectedDiagnosaRS.nama}<br>
                <strong>BPJS:</strong> [${selectedDiagnosaBPJS.kode}] ${selectedDiagnosaBPJS.nama}
            </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Mapping!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/save_mapping_diagnosa',
                    method: 'POST',
                    data: {
                        kd_diags_rs: selectedDiagnosaRS.kode,
                        kd_diags_bpjs: selectedDiagnosaBPJS.kode,
                        nm_diags_bpjs: selectedDiagnosaBPJS.nama
                    },
                    success: function (response) {
                        const res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire('Berhasil!', res.message, 'success');

                            // Move from unmapped to mapped table
                            $('.diagnosa-rs-item[data-kode="' + selectedDiagnosaRS.kode + '"]').remove();

                            const table = $('#mappedTable').DataTable();
                            table.row.add([
                                table.rows().count() + 1,
                                '<span class="label label-warning">' + selectedDiagnosaRS.kode + '</span>',
                                selectedDiagnosaRS.nama,
                                '<span class="label label-success">' + selectedDiagnosaBPJS.kode + '</span>',
                                selectedDiagnosaBPJS.nama,
                                '<button class="btn btn-danger btn-sm" onclick="deleteMapping(\'' + selectedDiagnosaRS.kode + '\')"><i class="fa fa-trash"></i> Hapus</button>'
                            ]).draw(false);

                            selectedDiagnosaRS = null;
                            selectedDiagnosaBPJS = null;
                            $('#btnMap').prop('disabled', true);
                            $('#searchResults').hide();
                            $('#searchDiagnosaBPJS').val('');
                        } else {
                            Swal.fire('Gagal!', res.message, 'error');
                        }
                    }
                });
            }
        });
    }

    function deleteMapping(kd_diags_rs) {
        Swal.fire({
            title: 'Hapus Mapping?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/delete_mapping_diagnosa_ajax',
                    method: 'POST',
                    data: { kd_diags_rs: kd_diags_rs },
                    success: function (response) {
                        const res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire('Berhasil', res.message, 'success');
                            const table = $('#mappedTable').DataTable();
                            table.rows().every(function () {
                                if (this.data()[1].includes(kd_diags_rs)) this.remove();
                            });
                            table.draw(false);
                            // Optionally add back to unmapped list (simplified)
                            window.location.reload();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    }
                });
            }
        });
    }
</script>

<style>
    .list-group-item.active {
        background-color: #3c8dbc !important;
        border-color: #3c8dbc !important;
    }

    .diagnosa-rs-item:hover,
    .diagnosa-bpjs-item:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .info-box {
        min-height: 90px;
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
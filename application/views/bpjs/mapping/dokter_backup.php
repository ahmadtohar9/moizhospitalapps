<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-exchange"></i> Mapping Poli
            <small>RS ke BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Poli</li>
        </ol>
    </section>

    <section class="content">
        <!-- Alert -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check"></i> <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-times"></i> <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Statistics Box -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-hospital-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Poli RS</span>
                        <span class="info-box-number"><?= count($poli_rs) + count($mapped); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sudah Mapping</span>
                        <span class="info-box-number"><?= count($mapped); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-warning"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Belum Mapping</span>
                        <span class="info-box-number"><?= count($poli_rs); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Progress</span>
                        <span
                            class="info-box-number"><?= count($poli_rs) + count($mapped) > 0 ? round((count($mapped) / (count($poli_rs) + count($mapped))) * 100, 1) : 0; ?>%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cogs"></i> Quick Actions</h3>
                    </div>
                    <div class="box-body">
                        <a href="<?= base_url('bpjs/mapping'); ?>" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mapping Interface -->
        <div class="row">
            <!-- Poli RS (Belum Mapping) -->
            <div class="col-md-5">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hospital-o"></i> Poli RS (Belum Mapping)</h3>
                        <div class="box-tools">
                            <input type="text" id="searchPoliRS" class="form-control input-sm"
                                placeholder="Cari poli RS..." style="width: 200px;">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 0;">
                        <?php if (empty($poli_rs)): ?>
                            <div class="alert alert-success" style="margin: 15px;">
                                <i class="fa fa-check"></i> Semua poli sudah di-mapping!
                            </div>
                        <?php else: ?>
                            <div style="padding: 10px 15px; background: #f9f9f9; border-bottom: 1px solid #ddd;">
                                <small class="text-muted">
                                    <i class="fa fa-info-circle"></i>
                                    <strong><?= count($poli_rs); ?> poli</strong> belum di-mapping
                                </small>
                            </div>
                            <div id="poliRSList" style="max-height: 400px; overflow-y: auto; padding: 10px;">
                                <?php foreach ($poli_rs as $poli): ?>
                                    <a href="#" class="list-group-item poli-rs-item" data-kode="<?= $poli['kd_poli']; ?>"
                                        data-nama="<?= htmlspecialchars($poli['nm_poli']); ?>"
                                        style="margin-bottom: 5px; border-radius: 4px;">
                                        <h4 class="list-group-item-heading">
                                            <span class="label label-warning"><?= $poli['kd_poli']; ?></span>
                                        </h4>
                                        <p class="list-group-item-text"><?= $poli['nm_poli']; ?></p>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Arrow & Map Button -->
            <div class="col-md-2 text-center" style="padding-top: 150px;">
                <i class="fa fa-arrow-right fa-3x text-primary"></i>
                <br><br>
                <button class="btn btn-primary btn-lg" id="btnMap" disabled>
                    <i class="fa fa-link"></i><br>
                    MAP
                </button>
            </div>

            <!-- Poli BPJS (Search) -->
            <div class="col-md-5">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Poli BPJS</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Ketik nama poli BPJS untuk mencari:</label>
                            <div class="input-group">
                                <input type="text" id="searchPoliBPJS" class="form-control"
                                    placeholder="Contoh: dalam, anak, mata..." minlength="3">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btnSearchBPJS">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </span>
                            </div>
                            <small class="text-muted">Minimal 3 karakter untuk mencari</small>
                        </div>

                        <div id="searchResults" style="display: none;">
                            <hr>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h4 style="margin: 0;">Hasil Pencarian:</h4>
                                <span id="resultCount" class="badge bg-green"
                                    style="font-size: 14px; padding: 5px 10px;">0 hasil</span>
                            </div>
                            <div id="poliBPJSList" class="list-group" style="max-height: 350px; overflow-y: auto;">
                                <!-- Results will be loaded here -->
                            </div>
                            <small class="text-muted" id="scrollHint" style="display: none;">
                                <i class="fa fa-info-circle"></i> Scroll untuk melihat hasil lainnya
                            </small>
                        </div>

                        <div id="searchLoading" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
                            <p>Mencari data dari BPJS...</p>
                        </div>

                        <div id="searchEmpty" style="display: none; text-align: center; padding: 20px;">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p>Ketik kata kunci dan klik "Cari" untuk mencari poli BPJS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mapped Poli Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-check"></i> Poli yang Sudah Di-Mapping</h3>
                    </div>
                    <div class="box-body">
                        <table id="mappedTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode RS</th>
                                    <th>Nama Poli RS</th>
                                    <th>Kode BPJS</th>
                                    <th>Nama Poli BPJS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($mapped as $map): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><span class="label label-warning"><?= $map['kd_poli_rs']; ?></span></td>
                                        <td><?= $map['nm_poli_rs']; ?></td>
                                        <td><span class="label label-success"><?= $map['kd_poli_bpjs']; ?></span></td>
                                        <td><?= $map['nm_poli_bpjs']; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteMapping('<?= $map['kd_poli_rs']; ?>')">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // BASE_URL already defined in header.php
    let selectedPoliRS = null;
    let selectedPoliBPJS = null;
    let searchTimeout = null; // For autocomplete debounce

    $(document).ready(function () {
        // Initialize DataTable
        $('#mappedTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });

        // Auto-hide success/error alerts after 3 seconds
        setTimeout(function () {
            $('.alert-success, .alert-danger').fadeOut('slow');
        }, 3000);

        // Search poli RS
        $('#searchPoliRS').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $('.poli-rs-item').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Select poli RS
        $('.poli-rs-item').click(function (e) {
            e.preventDefault();
            $('.poli-rs-item').removeClass('active');
            $(this).addClass('active');
            selectedPoliRS = {
                kode: $(this).data('kode'),
                nama: $(this).data('nama')
            };
            checkSelection();
        });

        // Autocomplete search BPJS on keyup (with debounce)
        $('#searchPoliBPJS').on('keyup', function (e) {
            // Ignore Enter key (handled separately)
            if (e.which === 13) return;

            const keyword = $(this).val().trim();

            // Clear previous timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            // Auto-search after 500ms of no typing
            if (keyword.length >= 3) {
                searchTimeout = setTimeout(function () {
                    searchBPJS();
                }, 500);
            } else {
                // Clear results if less than 3 chars
                $('#searchResults').hide();
                $('#searchLoading').hide();
                $('#searchEmpty').html(
                    '<i class="fa fa-info-circle fa-3x text-muted"></i>' +
                    '<p>Ketik minimal 3 karakter untuk mencari poli BPJS</p>'
                ).show();
            }
        });

        // Search BPJS on Enter
        $('#searchPoliBPJS').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                searchBPJS();
            }
        });

        // Search BPJS button
        $('#btnSearchBPJS').click(function () {
            searchBPJS();
        });

        // Map button
        $('#btnMap').click(function () {
            saveMapping();
        });

        // Show empty state initially
        $('#searchEmpty').show();
    });

    function searchBPJS() {
        const keyword = $('#searchPoliBPJS').val().trim();

        if (keyword.length < 3) {
            Swal.fire('Perhatian', 'Minimal 3 karakter untuk mencari', 'warning');
            return;
        }

        // Show loading
        $('#searchResults').hide();
        $('#searchEmpty').hide();
        $('#searchLoading').show();

        $.ajax({
            url: BASE_URL + 'bpjs/mapping/search_poli_bpjs',
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
                        '<p>Tidak ada hasil untuk "' + keyword + '"</p>' +
                        '<p class="text-muted">Coba kata kunci lain</p>'
                    ).show();
                }
            },
            error: function (xhr, status, error) {
                $('#searchLoading').hide();
                $('#searchEmpty').html(
                    '<i class="fa fa-exclamation-triangle fa-3x text-danger"></i>' +
                    '<p>Gagal mencari data dari BPJS</p>' +
                    '<p class="text-muted">' + error + '</p>'
                ).show();
            }
        });
    }

    function displaySearchResults(data) {
        let html = '';

        data.forEach(function (poli) {
            html += '<a href="#" class="list-group-item poli-bpjs-item" ' +
                'data-kode="' + poli.kode + '" data-nama="' + poli.nama + '">' +
                '<h4 class="list-group-item-heading">' +
                '<span class="label label-success">' + poli.kode + '</span>' +
                '</h4>' +
                '<p class="list-group-item-text">' + poli.nama + '</p>' +
                '</a>';
        });

        $('#poliBPJSList').html(html);
        $('#resultCount').text(data.length + ' hasil');

        // Show scroll hint if more than 5 results
        if (data.length > 5) {
            $('#scrollHint').show();
        } else {
            $('#scrollHint').hide();
        }

        $('#searchResults').show();

        // Bind click event to results
        $('.poli-bpjs-item').click(function (e) {
            e.preventDefault();
            $('.poli-bpjs-item').removeClass('active');
            $(this).addClass('active');
            selectedPoliBPJS = {
                kode: $(this).data('kode'),
                nama: $(this).data('nama')
            };
            checkSelection();
        });
    }

    function checkSelection() {
        if (selectedPoliRS && selectedPoliBPJS) {
            $('#btnMap').prop('disabled', false);
        } else {
            $('#btnMap').prop('disabled', true);
        }
    }

    function saveMapping() {
        if (!selectedPoliRS || !selectedPoliBPJS) {
            Swal.fire('Error', 'Pilih poli RS dan BPJS terlebih dahulu!', 'error');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Mapping',
            html: `
            <p>Apakah Anda yakin ingin mapping:</p>
            <div class="alert alert-info">
                <strong>RS:</strong> [${selectedPoliRS.kode}] ${selectedPoliRS.nama}<br>
                <strong>BPJS:</strong> [${selectedPoliBPJS.kode}] ${selectedPoliBPJS.nama}
            </div>
        `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Mapping!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/save_mapping_poli',
                    method: 'POST',
                    data: {
                        kd_poli_rs: selectedPoliRS.kode,
                        kd_poli_bpjs: selectedPoliBPJS.kode,
                        nm_poli_bpjs: selectedPoliBPJS.nama
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.success) {
                            // Show success message
                            Swal.fire({
                                title: 'Berhasil!',
                                text: res.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                            // Remove from unmapped list
                            $('.poli-rs-item[data-kode="' + selectedPoliRS.kode + '"]').fadeOut(300, function() {
                                $(this).remove();
                                // Update count
                                const remaining = $('.poli-rs-item').length;
                                if (remaining === 0) {
                                    $('#poliRSList').parent().html(
                                        '<div class="alert alert-success" style="margin: 15px;">' +
                                        '<i class="fa fa-check"></i> Semua poli sudah di-mapping!' +
                                        '</div>'
                                    );
                                }
                            });
                            
                            // Add to mapped table
                            const table = $('#mappedTable').DataTable();
                            const rowCount = table.rows().count() + 1;
                            table.row.add([
                                rowCount,
                                '<span class="label label-warning">' + selectedPoliRS.kode + '</span>',
                                selectedPoliRS.nama,
                                '<span class="label label-success">' + selectedPoliBPJS.kode + '</span>',
                                selectedPoliBPJS.nama,
                                '<button class="btn btn-danger btn-sm" onclick="deleteMapping(\'' + selectedPoliRS.kode + '\')">' +
                                '<i class="fa fa-trash"></i> Hapus</button>'
                            ]).draw(false);
                            
                            // Reset selection
                            selectedPoliRS = null;
                            selectedPoliBPJS = null;
                            $('.poli-rs-item, .poli-bpjs-item').removeClass('active');
                            $('#btnMap').prop('disabled', true);
                            
                            // Clear search
                            $('#searchPoliBPJS').val('');
                            $('#searchResults').hide();
                            $('#searchEmpty').show();
                            
                        } else {
                            Swal.fire('Gagal!', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan mapping', 'error');
                    }
                });
            }
        });
    }

    function deleteMapping(kd_poli_rs) {
        Swal.fire({
            title: 'Hapus Mapping?',
            text: 'Mapping akan dihapus dan poli RS akan kembali ke status belum mapping',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/delete_mapping_poli_ajax',
                    method: 'POST',
                    data: { kd_poli_rs: kd_poli_rs },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: res.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                            // Remove from table
                            const table = $('#mappedTable').DataTable();
                            table.rows().every(function() {
                                const data = this.data();
                                // Check if this row contains the deleted kd_poli_rs
                                if (data[1].includes(kd_poli_rs)) {
                                    this.remove();
                                }
                            });
                            table.draw(false);
                            
                            // Add back to unmapped list if poli data available
                            if (res.poli_data) {
                                const html = '<a href="#" class="list-group-item poli-rs-item" ' +
                                    'data-kode="' + res.poli_data.kd_poli + '" ' +
                                    'data-nama="' + res.poli_data.nm_poli + '" ' +
                                    'style="margin-bottom: 5px; border-radius: 4px;">' +
                                    '<h4 class="list-group-item-heading">' +
                                    '<span class="label label-warning">' + res.poli_data.kd_poli + '</span>' +
                                    '</h4>' +
                                    '<p class="list-group-item-text">' + res.poli_data.nm_poli + '</p>' +
                                    '</a>';
                                
                                if ($('#poliRSList').length) {
                                    // If the "Semua poli sudah di-mapping!" message is present, replace it
                                    if ($('#poliRSList').parent().find('.alert-success').length) {
                                        $('#poliRSList').parent().html('<div class="list-group" id="poliRSList"></div>');
                                    }
                                    $('#poliRSList').prepend(html);
                                    // Re-bind click event
                                    $('.poli-rs-item').off('click').on('click', function(e) {
                                        e.preventDefault();
                                        $('.poli-rs-item').removeClass('active');
                                        $(this).addClass('active');
                                        selectedPoliRS = {
                                            kode: $(this).data('kode'),
                                            nama: $(this).data('nama')
                                        };
                                        checkSelection();
                                    });
                                }
                            }
                        } else {
                            Swal.fire('Gagal!', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus mapping', 'error');
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

    .poli-rs-item:hover,
    .poli-bpjs-item:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .info-box {
        min-height: 90px;
    }
</style>
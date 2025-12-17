<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-exchange"></i> Mapping Dokter
            <small>RS ke BPJS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Bridging BPJS</a></li>
            <li><a href="<?= base_url('bpjs/mapping'); ?>">Mapping BPJS</a></li>
            <li class="active">Dokter</li>
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
                        <span class="info-box-text">Total Dokter RS</span>
                        <span class="info-box-number"><?= count($dokter_rs) + count($mapped_dokter); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sudah Mapping</span>
                        <span class="info-box-number"><?= count($mapped_dokter); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-warning"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Belum Mapping</span>
                        <span class="info-box-number"><?= count($dokter_rs); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Progress</span>
                        <span
                            class="info-box-number"><?= count($dokter_rs) + count($mapped_dokter) > 0 ? round((count($mapped_dokter) / (count($dokter_rs) + count($mapped_dokter))) * 100, 1) : 0; ?>%</span>
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
            <!-- Dokter RS (Belum Mapping) -->
            <div class="col-md-5">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hospital-o"></i> Dokter RS (Belum Mapping)</h3>
                        <div class="box-tools">
                            <input type="text" id="searchDokterRS" class="form-control input-sm"
                                placeholder="Cari dokter RS..." style="width: 200px;">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 0;">
                        <?php if (empty($dokter_rs)): ?>
                            <div class="alert alert-success" style="margin: 15px;">
                                <i class="fa fa-check"></i> Semua poli sudah di-mapping!
                            </div>
                        <?php else: ?>
                            <div style="padding: 10px 15px; background: #f9f9f9; border-bottom: 1px solid #ddd;">
                                <small class="text-muted">
                                    <i class="fa fa-info-circle"></i>
                                    <strong><?= count($dokter_rs); ?> poli</strong> belum di-mapping
                                </small>
                            </div>
                            <div id="dokterRSList" style="max-height: 400px; overflow-y: auto; padding: 10px;">
                                <?php foreach ($dokter_rs as $poli): ?>
                                    <a href="#" class="list-group-item dokter-rs-item" data-kode="<?= $poli['kd_dokter']; ?>"
                                        data-nama="<?= htmlspecialchars($poli['nm_dokter']); ?>"
                                        style="margin-bottom: 5px; border-radius: 4px;">
                                        <h4 class="list-group-item-heading">
                                            <span class="label label-warning"><?= $poli['kd_dokter']; ?></span>
                                        </h4>
                                        <p class="list-group-item-text"><?= $poli['nm_dokter']; ?></p>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Arrow & Map Button -->
            <div class="col-md-2 text-center" style="padding-top: 150px;">
                <i class="fa fa-arrow-right fa-3x text-primary" style="margin-bottom: 20px;"></i>
                <br>
                <button class="btn btn-lg" id="btnMap" disabled style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                           color: white; 
                           border: none; 
                           border-radius: 10px; 
                           padding: 15px 25px;
                           box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
                           transition: all 0.3s ease;">
                    <i class="fa fa-link" style="font-size: 20px;"></i>
                    <br>
                    <strong style="font-size: 16px;">SIMPAN MAPPING</strong>
                </button>
            </div>

            <!-- Dokter BPJS (Search) -->
            <div class="col-md-5">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Cari Dokter BPJS</h3>
                    </div>
                    <div class="box-body">
                        <!-- Step 1: Search Spesialis (Autocomplete Only) -->
                        <div class="form-group">
                            <label>1. Cari Spesialis: <span class="text-danger">*</span></label>
                            <input type="text" id="searchSpesialis" class="form-control"
                                placeholder="Ketik: dalam, anak, mata, bedah..." autocomplete="off">
                            <small class="text-muted">
                                <i class="fa fa-lightbulb-o"></i> Ketik minimal 2 huruf untuk suggestions
                            </small>
                        </div>

                        <!-- Spesialis Results -->
                        <div id="spesialisResults" style="display: none; margin-bottom: 15px;">
                            <label>Pilih Spesialis:</label>
                            <select id="kdSpesialis" class="form-control" size="5" style="height: auto;">
                                <!-- Spesialis options will be loaded here -->
                            </select>
                        </div>

                        <hr>

                        <!-- Step 2: Jenis & Tanggal -->
                        <div id="formDokter" style="display: none;">
                            <div class="form-group">
                                <label>2. Jenis Pelayanan:</label>
                                <select id="jenisPelayanan" class="form-control">
                                    <option value="2">Rawat Jalan</option>
                                    <option value="1">Rawat Inap</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>3. Tanggal Pelayanan:</label>
                                <input type="date" id="tglPelayanan" class="form-control" value="<?= date('Y-m-d'); ?>">
                            </div>

                            <button class="btn btn-success btn-block" id="btnSearchBPJS">
                                <i class="fa fa-search"></i> Cari Dokter BPJS
                            </button>
                        </div>

                        <!-- Dokter Results -->
                        <div id="searchResults" style="display: none; margin-top: 20px;">
                            <hr>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h4 style="margin: 0;">Hasil Pencarian Dokter:</h4>
                                <span id="resultCount" class="badge bg-green"
                                    style="font-size: 14px; padding: 5px 10px;">0 hasil</span>
                            </div>
                            <div id="dokterBPJSList" class="list-group" style="max-height: 350px; overflow-y: auto;">
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

                        <div id="searchEmpty" style="display: block; text-align: center; padding: 20px;">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p><strong>Langkah 1:</strong> Cari spesialis terlebih dahulu</p>
                            <p class="text-muted">Contoh: dalam, anak, mata, bedah</p>
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
                                    <th>Nama Dokter RS</th>
                                    <th>Kode BPJS</th>
                                    <th>Nama Dokter BPJS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($mapped_dokter as $map): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><span class="label label-warning"><?= $map['kd_dokter']; ?></span></td>
                                        <td><?= $map['nm_dokter_rs']; ?></td>
                                        <td><span class="label label-success"><?= $map['kd_dokter_bpjs']; ?></span></td>
                                        <td><?= $map['nm_dokter_bpjs']; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteMapping('<?= $map['kd_dokter']; ?>')">
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

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Auto-expand sidebar on page load (multiple methods for compatibility)
    $(document).ready(function () {
        // Method 1: Remove collapse class
        $('body').removeClass('sidebar-collapse');

        // Method 2: Add open class
        $('body').addClass('sidebar-open');

        // Method 3: Force after small delay (for AdminLTE compatibility)
        setTimeout(function () {
            $('body').removeClass('sidebar-collapse').addClass('sidebar-open');
        }, 100);
    });

    // BASE_URL already defined in header.php
    let selectedDokterRS = null;
    let selectedDokterBPJS = null;
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

        // Search dokter RS
        $('#searchDokterRS').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $('.dokter-rs-item').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Select dokter RS
        $('.dokter-rs-item').click(function (e) {
            e.preventDefault();
            $('.dokter-rs-item').removeClass('active');
            $(this).addClass('active');
            selectedDokterRS = {
                kode: $(this).data('kode'),
                nama: $(this).data('nama')
            };
            checkSelection();
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

        // Specialist list for autocomplete
        const allSpesialis = [
            { kode: 'INT', nama: 'Penyakit Dalam', label: 'INT - Penyakit Dalam' },
            { kode: 'ANA', nama: 'Anak', label: 'ANA - Anak' },
            { kode: 'BED', nama: 'Bedah', label: 'BED - Bedah' },
            { kode: 'OBG', nama: 'Obgyn', label: 'OBG - Obgyn' },
            { kode: 'MAT', nama: 'Mata', label: 'MAT - Mata' },
            { kode: 'THT', nama: 'THT', label: 'THT - THT' },
            { kode: 'KUL', nama: 'Kulit & Kelamin', label: 'KUL - Kulit & Kelamin' },
            { kode: 'SAR', nama: 'Saraf', label: 'SAR - Saraf' },
            { kode: 'JIW', nama: 'Jiwa', label: 'JIW - Jiwa' },
            { kode: 'PAR', nama: 'Paru', label: 'PAR - Paru' },
            { kode: 'JAN', nama: 'Jantung', label: 'JAN - Jantung' },
            { kode: 'ORT', nama: 'Orthopedi', label: 'ORT - Orthopedi' },
            { kode: 'URO', nama: 'Urologi', label: 'URO - Urologi' },
            { kode: 'GIG', nama: 'Gigi & Mulut', label: 'GIG - Gigi & Mulut' },
            { kode: 'RAD', nama: 'Radiologi', label: 'RAD - Radiologi' },
            { kode: 'PAT', nama: 'Patologi Klinik', label: 'PAT - Patologi Klinik' },
            { kode: 'ANE', nama: 'Anestesi', label: 'ANE - Anestesi' },
            { kode: 'REH', nama: 'Rehabilitasi Medik', label: 'REH - Rehabilitasi Medik' },
            { kode: 'KDV', nama: 'Kedokteran Forensik', label: 'KDV - Kedokteran Forensik' },
            { kode: 'GZI', nama: 'Gizi Klinik', label: 'GZI - Gizi Klinik' }
        ];

        // Initialize autocomplete
        $('#searchSpesialis').autocomplete({
            source: allSpesialis,
            minLength: 2,
            select: function (event, ui) {
                // When user selects from autocomplete
                $('#kdSpesialis').html('<option value="' + ui.item.kode + '" selected>' + ui.item.label + '</option>');
                $('#spesialisResults').slideDown();
                $('#kdSpesialis').trigger('change');
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<div><strong>" + item.kode + "</strong> - " + item.nama + "</div>")
                .appendTo(ul);
        };

        // When spesialis selected, show form dokter
        $('#kdSpesialis').on('change', function () {
            if ($(this).val()) {
                $('#formDokter').slideDown();
                $('#searchEmpty').hide();
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
    });

    function searchSpesialis() {
        const keyword = $('#searchSpesialis').val().trim().toLowerCase();

        if (keyword.length < 3) {
            Swal.fire('Perhatian', 'Minimal 3 karakter untuk mencari spesialis', 'warning');
            return;
        }

        // Hardcoded specialist list (common in Indonesian hospitals)
        const allSpesialis = [
            { kode: 'INT', nama: 'Penyakit Dalam' },
            { kode: 'ANA', nama: 'Anak' },
            { kode: 'BED', nama: 'Bedah' },
            { kode: 'OBG', nama: 'Obgyn' },
            { kode: 'MAT', nama: 'Mata' },
            { kode: 'THT', nama: 'THT' },
            { kode: 'KUL', nama: 'Kulit & Kelamin' },
            { kode: 'SAR', nama: 'Saraf' },
            { kode: 'JIW', nama: 'Jiwa' },
            { kode: 'PAR', nama: 'Paru' },
            { kode: 'JAN', nama: 'Jantung' },
            { kode: 'ORT', nama: 'Orthopedi' },
            { kode: 'URO', nama: 'Urologi' },
            { kode: 'GIG', nama: 'Gigi & Mulut' },
            { kode: 'RAD', nama: 'Radiologi' },
            { kode: 'PAT', nama: 'Patologi Klinik' },
            { kode: 'ANE', nama: 'Anestesi' },
            { kode: 'REH', nama: 'Rehabilitasi Medik' },
            { kode: 'KDV', nama: 'Kedokteran Forensik' },
            { kode: 'GZI', nama: 'Gizi Klinik' },
            { kode: 'IGD', nama: 'Instalasi Gawat Darurat' }
        ];

        // Filter by keyword
        const filtered = allSpesialis.filter(sp =>
            sp.nama.toLowerCase().includes(keyword) ||
            sp.kode.toLowerCase().includes(keyword)
        );

        if (filtered.length > 0) {
            let options = '';
            filtered.forEach(function (sp) {
                options += '<option value="' + sp.kode + '">' + sp.kode + ' - ' + sp.nama + '</option>';
            });
            $('#kdSpesialis').html(options);
            $('#spesialisResults').slideDown();

            // Auto-select first if only one result
            if (filtered.length === 1) {
                $('#kdSpesialis').val(filtered[0].kode).trigger('change');
            }
        } else {
            Swal.fire('Tidak Ditemukan', 'Tidak ada spesialis untuk keyword "' + keyword + '"', 'info');
        }
    }

    function searchBPJS() {
        const jenisPelayanan = $('#jenisPelayanan').val();
        const tglPelayanan = $('#tglPelayanan').val();
        const kdSpesialis = $('#kdSpesialis').val();

        if (!kdSpesialis) {
            Swal.fire('Perhatian', 'Pilih spesialis terlebih dahulu!', 'warning');
            return;
        }

        // Show loading
        $('#searchResults').hide();
        $('#searchEmpty').hide();
        $('#searchLoading').show();

        $.ajax({
            url: BASE_URL + 'bpjs/mapping/search_dokter_bpjs',
            method: 'POST',
            data: {
                jenis_pelayanan: jenisPelayanan,
                tgl_pelayanan: tglPelayanan,
                spesialis: kdSpesialis
            },
            success: function (response) {
                $('#searchLoading').hide();

                const res = JSON.parse(response);

                if (res.success && res.data && res.data.length > 0) {
                    displaySearchResults(res.data);
                } else {
                    $('#searchEmpty').html(
                        '<i class="fa fa-times-circle fa-3x text-warning"></i>' +
                        '<p>Tidak ada dokter untuk spesialis "' + kdSpesialis + '"</p>' +
                        '<p class="text-muted">Coba spesialis lain atau tanggal berbeda</p>'
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
            html += '<a href="#" class="list-group-item dokter-bpjs-item" ' +
                'data-kode="' + poli.kode + '" data-nama="' + poli.nama + '">' +
                '<h4 class="list-group-item-heading">' +
                '<span class="label label-success">' + poli.kode + '</span>' +
                '</h4>' +
                '<p class="list-group-item-text">' + poli.nama + '</p>' +
                '</a>';
        });

        $('#dokterBPJSList').html(html);
        $('#resultCount').text(data.length + ' hasil');

        // Show scroll hint if more than 5 results
        if (data.length > 5) {
            $('#scrollHint').show();
        } else {
            $('#scrollHint').hide();
        }

        $('#searchResults').show();

        // Bind click event to results
        $('.dokter-bpjs-item').click(function (e) {
            e.preventDefault();
            $('.dokter-bpjs-item').removeClass('active');
            $(this).addClass('active');
            selectedDokterBPJS = {
                kode: $(this).data('kode'),
                nama: $(this).data('nama')
            };
            checkSelection();
        });
    }

    function checkSelection() {
        if (selectedDokterRS && selectedDokterBPJS) {
            $('#btnMap').prop('disabled', false);
        } else {
            $('#btnMap').prop('disabled', true);
        }
    }

    function saveMapping() {
        if (!selectedDokterRS || !selectedDokterBPJS) {
            Swal.fire('Error', 'Pilih dokter RS dan BPJS terlebih dahulu!', 'error');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Mapping',
            html: `
            <p>Apakah Anda yakin ingin mapping:</p>
            <div class="alert alert-info">
                <strong>RS:</strong> [${selectedDokterRS.kode}] ${selectedDokterRS.nama}<br>
                <strong>BPJS:</strong> [${selectedDokterBPJS.kode}] ${selectedDokterBPJS.nama}
            </div>
        `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Mapping!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/save_mapping_dokter',
                    method: 'POST',
                    data: {
                        kd_dokter: selectedDokterRS.kode,
                        kd_dokter_bpjs: selectedDokterBPJS.kode,
                        nm_dokter_bpjs: selectedDokterBPJS.nama
                    },
                    success: function (response) {
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
                            $('.dokter-rs-item[data-kode="' + selectedDokterRS.kode + '"]').fadeOut(300, function () {
                                $(this).remove();
                                // Update count
                                const remaining = $('.dokter-rs-item').length;
                                if (remaining === 0) {
                                    $('#dokterRSList').parent().html(
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
                                '<span class="label label-warning">' + selectedDokterRS.kode + '</span>',
                                selectedDokterRS.nama,
                                '<span class="label label-success">' + selectedDokterBPJS.kode + '</span>',
                                selectedDokterBPJS.nama,
                                '<button class="btn btn-danger btn-sm" onclick="deleteMapping(\'' + selectedDokterRS.kode + '\')">' +
                                '<i class="fa fa-trash"></i> Hapus</button>'
                            ]).draw(false);

                            // Reset selection
                            selectedDokterRS = null;
                            selectedDokterBPJS = null;
                            $('.dokter-rs-item, .dokter-bpjs-item').removeClass('active');
                            $('#btnMap').prop('disabled', true);

                            // Clear search
                            $('#searchDokterBPJS').val('');
                            $('#searchResults').hide();
                            $('#searchEmpty').show();

                        } else {
                            Swal.fire('Gagal!', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan mapping', 'error');
                    }
                });
            }
        });
    }

    function deleteMapping(kd_dokter) {
        Swal.fire({
            title: 'Hapus Mapping?',
            text: 'Mapping akan dihapus dan dokter RS akan kembali ke status belum mapping',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'bpjs/mapping/delete_mapping_dokter_ajax',
                    method: 'POST',
                    data: { kd_dokter: kd_dokter },
                    success: function (response) {
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
                            table.rows().every(function () {
                                const data = this.data();
                                // Check if this row contains the deleted kd_dokter
                                if (data[1].includes(kd_dokter)) {
                                    this.remove();
                                }
                            });
                            table.draw(false);

                            // Add back to unmapped list if poli data available
                            if (res.poli_data) {
                                const html = '<a href="#" class="list-group-item dokter-rs-item" ' +
                                    'data-kode="' + res.poli_data.kd_dokter + '" ' +
                                    'data-nama="' + res.poli_data.nm_dokter + '" ' +
                                    'style="margin-bottom: 5px; border-radius: 4px;">' +
                                    '<h4 class="list-group-item-heading">' +
                                    '<span class="label label-warning">' + res.poli_data.kd_dokter + '</span>' +
                                    '</h4>' +
                                    '<p class="list-group-item-text">' + res.poli_data.nm_dokter + '</p>' +
                                    '</a>';

                                if ($('#dokterRSList').length) {
                                    // If the "Semua poli sudah di-mapping!" message is present, replace it
                                    if ($('#dokterRSList').parent().find('.alert-success').length) {
                                        $('#dokterRSList').parent().html('<div class="list-group" id="dokterRSList"></div>');
                                    }
                                    $('#dokterRSList').prepend(html);
                                    // Re-bind click event
                                    $('.dokter-rs-item').off('click').on('click', function (e) {
                                        e.preventDefault();
                                        $('.dokter-rs-item').removeClass('active');
                                        $(this).addClass('active');
                                        selectedDokterRS = {
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
                    error: function () {
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

    .dokter-rs-item:hover,
    .dokter-bpjs-item:hover {
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
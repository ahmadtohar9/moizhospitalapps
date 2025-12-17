<div class="content-wrapper">
    <section class="content-header">
        <h1>Kelola Akses Tab Rekam Medis<small>Tab RME untuk <?= htmlspecialchars($user['nama_user']); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('user-access'); ?>"><i class="fa fa-users"></i> Hak Akses</a></li>
            <li class="active">Tab Medis</li>
        </ol>
    </section>
    
    <section class="content">
        <!-- User Info Box -->
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-yellow">
                <h3 class="widget-user-username"><?= htmlspecialchars($user['nama_user']); ?></h3>
                <h5 class="widget-user-desc">
                    <i class="fa fa-user"></i> <?= htmlspecialchars($user['username']); ?> 
                    | <i class="fa fa-envelope"></i> <?= htmlspecialchars($user['email'] ?? '-'); ?>
                </h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="<?= base_url('assets/dist/img/avatar5.png'); ?>" alt="User Avatar">
            </div>
        </div>

        <!-- RME Access Form -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Pilih Tab Rekam Medis</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm" id="checkAllRme">
                        <i class="fa fa-check-square-o"></i> Centang Semua
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" id="uncheckAllRme">
                        <i class="fa fa-square-o"></i> Hapus Semua
                    </button>
                </div>
            </div>
            
            <form action="<?= base_url('UserRmeAccessController/save'); ?>" method="POST" id="rmeAccessForm">
                <div class="box-body">
                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> 
                        <strong>Informasi:</strong> Centang tab menu yang <strong>BOLEH</strong> diakses oleh user ini 
                        saat membuka halaman Rekam Medis Elektronik (RME).
                    </div>

                    <!-- Search Box -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="rmeSearch" 
                                   placeholder="Cari tab medis... (ketik nama tab untuk filter)">
                            <span class="input-group-addon">
                                <span id="rmeSearchCount" class="badge bg-yellow">0</span> ditemukan
                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="fa fa-info-circle"></i> 
                            Ketik untuk mencari tab medis secara real-time. Tab yang cocok akan di-highlight.
                        </small>
                    </div>

                    <!-- Category Filter -->
                    <div class="form-group">
                        <label>Filter Kategori:</label>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default category-filter active" data-category="all">
                                <i class="fa fa-list"></i> Semua
                            </button>
                            <button type="button" class="btn btn-default category-filter" data-category="dokter">
                                <i class="fa fa-user-md"></i> Dokter
                            </button>
                            <button type="button" class="btn btn-default category-filter" data-category="perawat">
                                <i class="fa fa-user-nurse"></i> Perawat
                            </button>
                            <button type="button" class="btn btn-default category-filter" data-category="umum">
                                <i class="fa fa-users"></i> Umum
                            </button>
                        </div>
                    </div>

                    <!-- RME Table -->
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-hover" id="rmeTable">
                            <thead class="bg-yellow" style="position: sticky; top: 0; z-index: 10;">
                                <tr>
                                    <th style="width: 50px;" class="text-center">#</th>
                                    <th>Nama Tab Menu</th>
                                    <th style="width: 120px;">Kategori</th>
                                    <th style="width: 100px;" class="text-center">
                                        <input type="checkbox" id="toggleAllRme"> Akses
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="rmeTableBody">
                                <?php if (!empty($rme_menus)): ?>
                                        <?php foreach ($rme_menus as $key => $menu): ?>
                                                <tr class="rme-row" 
                                                    data-tab-name="<?= strtolower($menu['tab_name']); ?>"
                                                    data-category="<?= $menu['category']; ?>">
                                                    <td class="text-center"><?= $key + 1; ?></td>
                                                    <td class="tab-name-cell">
                                                        <i class="fa fa-file-text-o"></i>
                                                        <span class="tab-name-text"><?= htmlspecialchars($menu['tab_name']); ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if ($menu['category'] == 'dokter'): ?>
                                                                <span class="label label-primary">
                                                                    <i class="fa fa-user-md"></i> Dokter
                                                                </span>
                                                        <?php elseif ($menu['category'] == 'perawat'): ?>
                                                                <span class="label label-success">
                                                                    <i class="fa fa-user-nurse"></i> Perawat
                                                                </span>
                                                        <?php else: ?>
                                                                <span class="label label-default">
                                                                    <i class="fa fa-users"></i> Umum
                                                                </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="checkbox" 
                                                               class="rme-checkbox" 
                                                               name="menu_ids[]" 
                                                               value="<?= $menu['id']; ?>"
                                                               <?= in_array($menu['id'], $user_access) ? 'checked' : ''; ?>>
                                                    </td>
                                                </tr>
                                        <?php endforeach; ?>
                                <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-danger">
                                                <i class="fa fa-warning"></i> Tidak ada tab medis yang tersedia
                                            </td>
                                        </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div class="alert alert-warning" style="margin-top: 15px;">
                        <i class="fa fa-info-circle"></i>
                        <strong>Total Tab:</strong> <span id="totalTabs"><?= count($rme_menus); ?></span> tab |
                        <strong>Dipilih:</strong> <span id="selectedTabCount"><?= count($user_access); ?></span> tab |
                        <strong>Tampil:</strong> <span id="visibleTabCount"><?= count($rme_menus); ?></span> tab
                    </div>
                </div>
                
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="<?= base_url('user-access'); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fa fa-save"></i> Simpan Hak Akses Tab
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Update selected count
    function updateSelectedCount() {
        const count = $('.rme-checkbox:checked').length;
        $('#selectedTabCount').text(count);
    }

    // Update visible count
    function updateVisibleCount() {
        const count = $('.rme-row:visible').length;
        $('#visibleTabCount').text(count);
    }

    // Initial counts
    updateSelectedCount();
    updateVisibleCount();

    // Check all visible
    $('#checkAllRme').click(function() {
        $('.rme-checkbox:visible').prop('checked', true);
        $('#toggleAllRme').prop('checked', true);
        updateSelectedCount();
    });

    // Uncheck all
    $('#uncheckAllRme').click(function() {
        $('.rme-checkbox').prop('checked', false);
        $('#toggleAllRme').prop('checked', false);
        updateSelectedCount();
    });

    // Toggle all visible
    $('#toggleAllRme').change(function() {
        $('.rme-checkbox:visible').prop('checked', $(this).is(':checked'));
        updateSelectedCount();
    });

    // Update count on checkbox change
    $('.rme-checkbox').change(function() {
        updateSelectedCount();
    });

    // Category filter
    $('.category-filter').click(function() {
        $('.category-filter').removeClass('active');
        $(this).addClass('active');
        
        const category = $(this).data('category');
        
        if (category === 'all') {
            $('.rme-row').show();
        } else {
            $('.rme-row').hide();
            $(`.rme-row[data-category="${category}"]`).show();
        }
        
        updateVisibleCount();
        $('#rmeSearchCount').text($('.rme-row:visible').length);
        
        // Update toggle all checkbox
        const visibleChecked = $('.rme-checkbox:visible:checked').length;
        const visibleTotal = $('.rme-checkbox:visible').length;
        $('#toggleAllRme').prop('checked', visibleChecked === visibleTotal && visibleTotal > 0);
    });

    // Real-time search
    $('#rmeSearch').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        const activeCategory = $('.category-filter.active').data('category');
        let foundCount = 0;

        $('.rme-row').each(function() {
            const tabName = $(this).data('tab-name');
            const category = $(this).data('category');
            const tabText = $(this).find('.tab-name-text');
            
            // Check category filter
            const categoryMatch = activeCategory === 'all' || category === activeCategory;
            
            // Check search term
            const searchMatch = tabName.includes(searchTerm);
            
            if (categoryMatch && searchMatch) {
                $(this).show();
                foundCount++;
                
                // Highlight matching text
                if (searchTerm.length > 0) {
                    $(this).addClass('highlight-row');
                    const originalText = tabText.text();
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    const highlightedText = originalText.replace(regex, '<mark>$1</mark>');
                    tabText.html(highlightedText);
                } else {
                    $(this).removeClass('highlight-row');
                    tabText.text(tabText.text()); // Remove HTML
                }
            } else {
                $(this).hide();
                $(this).removeClass('highlight-row');
            }
        });

        $('#rmeSearchCount').text(foundCount);
        updateVisibleCount();
        
        // Update toggle all checkbox
        const visibleChecked = $('.rme-checkbox:visible:checked').length;
        const visibleTotal = $('.rme-checkbox:visible').length;
        $('#toggleAllRme').prop('checked', visibleChecked === visibleTotal && visibleTotal > 0);
    });

    // Form submission confirmation
    $('#rmeAccessForm').submit(function(e) {
        const selectedCount = $('.rme-checkbox:checked').length;
        
        if (selectedCount === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Tab Dipilih',
                text: 'Apakah Anda yakin ingin menghapus semua akses tab medis untuk user ini?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Semua',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#rmeAccessForm').off('submit').submit();
                }
            });
            return false;
        }
    });
});

// Show notifications
<?php if ($this->session->flashdata('notif')): ?>
        const notif = <?= json_encode($this->session->flashdata('notif')); ?>;
        Swal.fire({
            icon: notif.type,
            title: notif.type === 'success' ? 'Berhasil!' : 'Gagal!',
            text: notif.message,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
<?php endif; ?>
</script>

<style>
.bg-yellow {
    background-color: #f39c12 !important;
    color: white !important;
}

.highlight-row {
    background-color: #fffacd !important;
    transition: background-color 0.3s;
}

mark {
    background-color: #ffeb3b;
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: bold;
}

.tab-name-cell {
    font-size: 14px;
    font-weight: 500;
}

.rme-checkbox {
    transform: scale(1.3);
    cursor: pointer;
}

#rmeTable thead {
    background-color: #f39c12;
    color: white;
}

.widget-user-header.bg-yellow {
    background-color: #f39c12 !important;
}

.widget-user-username {
    margin-top: 0;
    margin-bottom: 5px;
    font-size: 25px;
    font-weight: 300;
    text-shadow: 0 1px 1px rgba(0,0,0,0.2);
}

.widget-user-desc {
    margin-top: 0;
}

.widget-user-image {
    position: absolute;
    top: 65px;
    left: 50%;
    margin-left: -45px;
}

.widget-user-image > img {
    width: 90px;
    height: auto;
    border: 3px solid #fff;
}

.box-widget {
    padding-top: 20px;
}

.table-responsive {
    border: 1px solid #ddd;
    border-radius: 4px;
}

#rmeSearchCount {
    font-size: 12px;
}

.category-filter {
    margin-right: 5px;
}

.category-filter.active {
    background-color: #f39c12;
    color: white;
    border-color: #f39c12;
}

.label {
    font-size: 90%;
    padding: 4px 8px;
}
</style>
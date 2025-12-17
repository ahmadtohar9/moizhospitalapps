<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Kelola Hak Akses User
            <small>Menu Sidebar untuk <?= htmlspecialchars($user['nama_user']); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('user-access'); ?>"><i class="fa fa-users"></i> Hak Akses</a></li>
            <li class="active">Kelola Menu</li>
        </ol>
    </section>
    
    <section class="content">
        <!-- User Info Box -->
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua">
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

        <!-- Menu Access Form -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bars"></i> Pilih Menu Sidebar</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm" id="checkAll">
                        <i class="fa fa-check-square-o"></i> Centang Semua
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" id="uncheckAll">
                        <i class="fa fa-square-o"></i> Hapus Semua
                    </button>
                </div>
            </div>
            
            <form action="<?= base_url('user-access/save'); ?>" method="POST" id="accessForm">
                <div class="box-body">
                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    
                    <!-- Search Box -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="menuSearch" 
                                   placeholder="Cari menu... (ketik nama menu untuk filter)">
                            <span class="input-group-addon">
                                <span id="searchCount" class="badge bg-blue">0</span> ditemukan
                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="fa fa-info-circle"></i> 
                            Ketik untuk mencari menu secara real-time. Menu yang cocok akan di-highlight.
                        </small>
                    </div>

                    <!-- Menu Table -->
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-hover" id="menuTable">
                            <thead class="bg-primary" style="position: sticky; top: 0; z-index: 10;">
                                <tr>
                                    <th style="width: 50px;" class="text-center">#</th>
                                    <th>Nama Menu</th>
                                    <th style="width: 100px;" class="text-center">
                                        <input type="checkbox" id="toggleAll"> Akses
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="menuTableBody">
                                <?php if (!empty($menus)): ?>
                                    <?php foreach ($menus as $key => $menu): ?>
                                        <tr class="menu-row" data-menu-name="<?= strtolower($menu['menu_name']); ?>">
                                            <td class="text-center"><?= $key + 1; ?></td>
                                            <td class="menu-name-cell">
                                                <?= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $menu['depth'] ?? 0); ?>
                                                <?= isset($menu['depth']) && $menu['depth'] > 0 ? '↳ ' : ''; ?>
                                                <i class="fa <?= $menu['icon'] ?? 'fa-circle-o'; ?>"></i>
                                                <span class="menu-name-text"><?= htmlspecialchars($menu['menu_name']); ?></span>
                                                <?php if ($menu['depth'] == 0): ?>
                                                    <span class="label label-primary">Parent</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" 
                                                       class="menu-checkbox" 
                                                       name="menu_ids[]" 
                                                       value="<?= $menu['id']; ?>"
                                                       <?= in_array($menu['id'], $user_menus) ? 'checked' : ''; ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">
                                            <i class="fa fa-warning"></i> Tidak ada menu yang tersedia
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div class="alert alert-info" style="margin-top: 15px;">
                        <i class="fa fa-info-circle"></i>
                        <strong>Total Menu:</strong> <span id="totalMenus"><?= count($menus); ?></span> menu |
                        <strong>Dipilih:</strong> <span id="selectedCount"><?= count($user_menus); ?></span> menu
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
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Simpan Hak Akses
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
        const count = $('.menu-checkbox:checked').length;
        $('#selectedCount').text(count);
    }

    // Initial count
    updateSelectedCount();

    // Check all
    $('#checkAll').click(function() {
        $('.menu-checkbox:visible').prop('checked', true);
        $('#toggleAll').prop('checked', true);
        updateSelectedCount();
    });

    // Uncheck all
    $('#uncheckAll').click(function() {
        $('.menu-checkbox').prop('checked', false);
        $('#toggleAll').prop('checked', false);
        updateSelectedCount();
    });

    // Toggle all visible
    $('#toggleAll').change(function() {
        $('.menu-checkbox:visible').prop('checked', $(this).is(':checked'));
        updateSelectedCount();
    });

    // Update count on checkbox change
    $('.menu-checkbox').change(function() {
        updateSelectedCount();
    });

    // Real-time search
    $('#menuSearch').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        let foundCount = 0;

        $('.menu-row').each(function() {
            const menuName = $(this).data('menu-name');
            const menuText = $(this).find('.menu-name-text');
            
            if (menuName.includes(searchTerm)) {
                $(this).show();
                foundCount++;
                
                // Highlight matching text
                if (searchTerm.length > 0) {
                    $(this).addClass('highlight-row');
                    const originalText = menuText.text();
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    const highlightedText = originalText.replace(regex, '<mark>$1</mark>');
                    menuText.html(highlightedText);
                } else {
                    $(this).removeClass('highlight-row');
                    menuText.text(menuText.text()); // Remove HTML
                }
            } else {
                $(this).hide();
                $(this).removeClass('highlight-row');
            }
        });

        $('#searchCount').text(foundCount);
        
        // Update toggle all checkbox
        const visibleChecked = $('.menu-checkbox:visible:checked').length;
        const visibleTotal = $('.menu-checkbox:visible').length;
        $('#toggleAll').prop('checked', visibleChecked === visibleTotal && visibleTotal > 0);
    });

    // Form submission confirmation
    $('#accessForm').submit(function(e) {
        const selectedCount = $('.menu-checkbox:checked').length;
        
        if (selectedCount === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Menu Dipilih',
                text: 'Apakah Anda yakin ingin menghapus semua akses menu untuk user ini?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Semua',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#accessForm').off('submit').submit();
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
.bg-primary {
    background-color: #3c8dbc !important;
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

.menu-name-cell {
    font-size: 14px;
}

.menu-checkbox {
    transform: scale(1.3);
    cursor: pointer;
}

#menuTable thead {
    background-color: #3c8dbc;
    color: white;
}

.widget-user-header {
    padding: 20px;
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

#searchCount {
    font-size: 12px;
}
</style>
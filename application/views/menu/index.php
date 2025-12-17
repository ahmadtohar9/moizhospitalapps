<div class="content-wrapper">
    <section class="content-header">
        <h1>Menu Management</h1>
    </section>
    <section class="content">
        <!-- Notification -->
        <?php if ($this->session->flashdata('notif')): ?>
            <?php $notif = $this->session->flashdata('notif'); ?>
            <div class="alert alert-<?= $notif['type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= $notif['type'] === 'success' ? 'Success!' : 'Error!'; ?></strong> <?= $notif['message']; ?>
            </div>
        <?php endif; ?>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Daftar Menu</h3>
                <br><br>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">
                    <i class="fa fa-plus"></i> Add New Menu
                </button>
            </div>
            <div class="box-body">
                <table id="MenuTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Menu Name</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th>Form Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_menus as $menu): ?>
                            <tr>
                                <td><?= $menu['id']; ?></td>
                                <td><?= htmlspecialchars($menu['menu_name']); ?></td>
                                <td><code><?= htmlspecialchars($menu['menu_url']); ?></code></td>
                                <td>
                                    <i class="fa <?= $menu['icon']; ?>" style="font-size: 18px; margin-right: 5px;"></i>
                                    <small class="text-muted"><?= $menu['icon']; ?></small>
                                </td>
                                <td>
                                    <?php if ($menu['parent_id']): ?>
                                        <span class="label label-info"><?= $menu['parent_id']; ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="label label-<?= $menu['is_active'] ? 'success' : 'default'; ?>">
                                        <?= $menu['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="label label-<?= isset($menu['is_aksi_form']) && $menu['is_aksi_form'] == 1 ? 'success' : 'default'; ?>">
                                        <?= isset($menu['is_aksi_form']) && $menu['is_aksi_form'] == 1 ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMenuModal"
                                        data-id="<?= $menu['id']; ?>"
                                        data-name="<?= htmlspecialchars($menu['menu_name'], ENT_QUOTES); ?>"
                                        data-url="<?= htmlspecialchars($menu['menu_url'], ENT_QUOTES); ?>"
                                        data-icon="<?= htmlspecialchars($menu['icon'], ENT_QUOTES); ?>"
                                        data-parent="<?= $menu['parent_id'] ?? ''; ?>"
                                        data-active="<?= $menu['is_active']; ?>"
                                        data-form="<?= isset($menu['is_aksi_form']) ? $menu['is_aksi_form'] : 0; ?>"
                                        data-menurm="<?= isset($menu['menurm']) ? htmlspecialchars($menu['menurm'], ENT_QUOTES) : ''; ?>"
                                        onclick="openEditModal(this)">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete-menu" data-id="<?= $menu['id']; ?>"
                                        data-name="<?= htmlspecialchars($menu['menu_name'], ENT_QUOTES); ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Add Menu -->
<div class="modal fade" id="addMenuModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('menu-manager/save'); ?>" method="POST" id="addMenuForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_name">Menu Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="menu_name" id="menu_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_url">Menu URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="menu_url" id="menu_url" required>
                                <small class="text-muted">Example: admin/dashboard</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i id="iconPreview" class="fa fa-circle-o" style="font-size: 20px;"></i>
                            </span>
                            <input type="text" class="form-control" name="icon" id="iconInput" placeholder="fa-circle-o"
                                required readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#iconPickerModal">
                                    <i class="fa fa-search"></i> Browse Icons
                                </button>
                            </span>
                        </div>
                        <small class="text-muted">Click "Browse Icons" to select from 600+ Font Awesome icons</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_id">Parent Menu</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="">No Parent (Main Menu)</option>
                                    <?php foreach ($all_menus as $parent): ?>
                                        <option value="<?= $parent['id']; ?>"><?= htmlspecialchars($parent['menu_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menurm">Menu RM</label>
                                <input type="text" class="form-control" name="menurm" id="menurm"
                                    placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_active" id="is_active">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_aksi_form">Form Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_aksi_form" id="is_aksi_form">
                                    <option value="1">Active</option>
                                    <option value="0" selected>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Menu -->
<div class="modal fade" id="editMenuModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editMenuForm" action="<?= base_url('menu-manager/update'); ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Menu</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menu_name">Menu Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="menu_name" id="edit_menu_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menu_url">Menu URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="menu_url" id="edit_menu_url" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_icon">Icon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i id="editIconPreview" class="fa fa-circle-o" style="font-size: 20px;"></i>
                            </span>
                            <input type="text" class="form-control" name="icon" id="edit_icon" required readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#iconPickerModal" onclick="setEditMode(true)">
                                    <i class="fa fa-search"></i> Browse Icons
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_parent_id">Parent Menu</label>
                                <select class="form-control" name="parent_id" id="edit_parent_id">
                                    <option value="">No Parent (Main Menu)</option>
                                    <?php foreach ($all_menus as $parent): ?>
                                        <option value="<?= $parent['id']; ?>"><?= htmlspecialchars($parent['menu_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menurm">Menu RM</label>
                                <input type="text" class="form-control" name="menurm" id="edit_menurm">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_is_active">Status</label>
                                <select class="form-control" name="is_active" id="edit_is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_is_aksi_form">Form Status</label>
                                <select class="form-control" name="is_aksi_form" id="edit_is_aksi_form">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-icons"></i> Select Icon</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="iconSearch"
                        placeholder="Search icons... (e.g., user, home, hospital)">
                </div>
                <div id="iconGrid" style="max-height: 400px; overflow-y: auto;">
                    <!-- Icons will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // BASE_URL already defined in header.php
    let isEditMode = false;

    // Font Awesome 4.7 Icons (600+ icons)
    const fontAwesomeIcons = [
        // Medical & Health
        'fa-ambulance', 'fa-h-square', 'fa-heart', 'fa-heart-o', 'fa-heartbeat', 'fa-hospital-o',
        'fa-medkit', 'fa-plus-square', 'fa-stethoscope', 'fa-user-md', 'fa-wheelchair', 'fa-wheelchair-alt',

        // Users & People
        'fa-user', 'fa-user-o', 'fa-user-circle', 'fa-user-circle-o', 'fa-user-plus', 'fa-user-secret',
        'fa-user-times', 'fa-users', 'fa-address-book', 'fa-address-book-o', 'fa-address-card',
        'fa-address-card-o', 'fa-id-badge', 'fa-id-card', 'fa-id-card-o',

        // Files & Documents
        'fa-file', 'fa-file-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-pdf-o', 'fa-file-word-o',
        'fa-file-excel-o', 'fa-file-powerpoint-o', 'fa-file-image-o', 'fa-file-archive-o',
        'fa-file-audio-o', 'fa-file-video-o', 'fa-file-code-o', 'fa-clipboard',

        // Navigation
        'fa-home', 'fa-dashboard', 'fa-tachometer', 'fa-bars', 'fa-navicon', 'fa-reorder',
        'fa-th', 'fa-th-large', 'fa-th-list', 'fa-list', 'fa-list-alt', 'fa-list-ol',
        'fa-list-ul', 'fa-sitemap', 'fa-map', 'fa-map-o', 'fa-map-marker', 'fa-map-pin',

        // Actions
        'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-minus',
        'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-edit', 'fa-pencil',
        'fa-pencil-square', 'fa-pencil-square-o', 'fa-trash', 'fa-trash-o', 'fa-save',
        'fa-floppy-o', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square',
        'fa-check-square-o', 'fa-times', 'fa-times-circle', 'fa-times-circle-o',

        // Arrows & Directions
        'fa-arrow-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-circle-up',
        'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-right', 'fa-angle-up',
        'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-double-up',
        'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right',

        // Status & Indicators
        'fa-circle', 'fa-circle-o', 'fa-circle-thin', 'fa-dot-circle-o', 'fa-exclamation',
        'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-question', 'fa-question-circle',
        'fa-question-circle-o', 'fa-info', 'fa-info-circle', 'fa-warning', 'fa-ban',

        // Communication
        'fa-envelope', 'fa-envelope-o', 'fa-envelope-open', 'fa-envelope-open-o', 'fa-envelope-square',
        'fa-inbox', 'fa-comment', 'fa-comment-o', 'fa-comments', 'fa-comments-o', 'fa-phone',
        'fa-phone-square', 'fa-bell', 'fa-bell-o', 'fa-bell-slash', 'fa-bell-slash-o',

        // Business & Finance
        'fa-briefcase', 'fa-building', 'fa-building-o', 'fa-money', 'fa-dollar', 'fa-credit-card',
        'fa-credit-card-alt', 'fa-bank', 'fa-institution', 'fa-university', 'fa-calculator',
        'fa-balance-scale', 'fa-chart-line', 'fa-chart-bar', 'fa-chart-pie', 'fa-chart-area',

        // Time & Calendar
        'fa-calendar', 'fa-calendar-o', 'fa-calendar-check-o', 'fa-calendar-minus-o',
        'fa-calendar-plus-o', 'fa-calendar-times-o', 'fa-clock-o', 'fa-hourglass',
        'fa-hourglass-start', 'fa-hourglass-half', 'fa-hourglass-end',

        // Settings & Tools
        'fa-cog', 'fa-cogs', 'fa-wrench', 'fa-sliders', 'fa-gears', 'fa-tools', 'fa-screwdriver',
        'fa-hammer', 'fa-magic', 'fa-key', 'fa-lock', 'fa-unlock', 'fa-unlock-alt',

        // Media & Playback
        'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-pause', 'fa-pause-circle',
        'fa-pause-circle-o', 'fa-stop', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-forward',
        'fa-backward', 'fa-step-forward', 'fa-step-backward', 'fa-eject', 'fa-volume-up',
        'fa-volume-down', 'fa-volume-off',

        // Social & Sharing
        'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o',
        'fa-thumbs-up', 'fa-thumbs-o-up', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-star',
        'fa-star-o', 'fa-star-half', 'fa-star-half-o',

        // Technology
        'fa-desktop', 'fa-laptop', 'fa-tablet', 'fa-mobile', 'fa-mobile-phone', 'fa-keyboard-o',
        'fa-mouse-pointer', 'fa-print', 'fa-fax', 'fa-wifi', 'fa-database', 'fa-server',
        'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload',

        // Shopping & Commerce
        'fa-shopping-cart', 'fa-shopping-basket', 'fa-shopping-bag', 'fa-barcode', 'fa-qrcode',
        'fa-tag', 'fa-tags', 'fa-ticket', 'fa-gift',

        // Transportation
        'fa-car', 'fa-taxi', 'fa-bus', 'fa-truck', 'fa-plane', 'fa-rocket', 'fa-ship', 'fa-bicycle',
        'fa-motorcycle', 'fa-subway', 'fa-train',

        // Weather
        'fa-sun-o', 'fa-moon-o', 'fa-cloud', 'fa-umbrella', 'fa-snowflake-o',

        // Food & Drink
        'fa-coffee', 'fa-cutlery', 'fa-glass', 'fa-beer', 'fa-birthday-cake',

        // Sports & Games
        'fa-futbol-o', 'fa-trophy', 'fa-gamepad', 'fa-puzzle-piece',

        // Misc
        'fa-search', 'fa-search-plus', 'fa-search-minus', 'fa-filter', 'fa-eye', 'fa-eye-slash',
        'fa-download', 'fa-upload', 'fa-refresh', 'fa-sync', 'fa-repeat', 'fa-undo', 'fa-history',
        'fa-bookmark', 'fa-bookmark-o', 'fa-flag', 'fa-flag-o', 'fa-flag-checkered',
        'fa-thumbtack', 'fa-paperclip', 'fa-link', 'fa-unlink', 'fa-chain', 'fa-chain-broken'
    ];

    // Initialize DataTable
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#MenuTable')) {
            $('#MenuTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 25,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        }

        // Load icons
        loadIcons();
    });

    // Load icons into grid
    function loadIcons(filter = '') {
        const iconGrid = document.getElementById('iconGrid');
        const filteredIcons = filter
            ? fontAwesomeIcons.filter(icon => icon.toLowerCase().includes(filter.toLowerCase()))
            : fontAwesomeIcons;

        let html = '<div class="row">';
        filteredIcons.forEach((icon, index) => {
            html += `
            <div class="col-xs-6 col-sm-4 col-md-3 text-center" style="padding: 10px;">
                <div class="icon-item" onclick="selectIcon('${icon}')" style="cursor: pointer; padding: 15px; border: 1px solid #ddd; border-radius: 5px; transition: all 0.3s;">
                    <i class="fa ${icon}" style="font-size: 24px; margin-bottom: 5px;"></i>
                    <br>
                    <small>${icon}</small>
                </div>
            </div>
        `;
        });
        html += '</div>';
        iconGrid.innerHTML = html;

        // Add hover effect
        $('.icon-item').hover(
            function () { $(this).css({ 'background': '#f0f0f0', 'border-color': '#3c8dbc' }); },
            function () { $(this).css({ 'background': 'white', 'border-color': '#ddd' }); }
        );
    }

    // Search icons
    $('#iconSearch').on('input', function () {
        loadIcons($(this).val());
    });

    // Select icon
    function selectIcon(icon) {
        if (isEditMode) {
            $('#edit_icon').val(icon);
            $('#editIconPreview').attr('class', 'fa ' + icon);
        } else {
            $('#iconInput').val(icon);
            $('#iconPreview').attr('class', 'fa ' + icon);
        }
        $('#iconPickerModal').modal('hide');
        isEditMode = false;
    }

    // Set edit mode
    function setEditMode(mode) {
        isEditMode = mode;
    }

    // Open edit modal
    function openEditModal(btn) {
        const data = $(btn).data();

        $('#editMenuForm').attr('action', BASE_URL + 'menu-manager/update/' + data.id);
        $('#edit_id').val(data.id);
        $('#edit_menu_name').val(data.name);
        $('#edit_menu_url').val(data.url);
        $('#edit_icon').val(data.icon);
        $('#editIconPreview').attr('class', 'fa ' + data.icon);
        $('#edit_parent_id').val(data.parent || '');
        $('#edit_is_active').val(data.active);
        $('#edit_is_aksi_form').val(data.form);
        $('#edit_menurm').val(data.menurm || '');
    }

    // Delete menu
    $(document).on('click', '.btn-delete-menu', function (e) {
        e.preventDefault();

        const menuId = $(this).data('id');
        const menuName = $(this).data('name');

        Swal.fire({
            title: 'Hapus Menu?',
            html: `
            <p style="font-size: 16px; margin-bottom: 10px;">
                Apakah Anda yakin ingin menghapus menu ini?
            </p>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                <p style="margin: 5px 0;"><strong>Menu:</strong> ${menuName}</p>
            </div>
            <p style="color: #dc3545; margin-top: 15px; font-size: 14px;">
                <i class="fa fa-warning"></i> Data yang dihapus tidak dapat dikembalikan!
            </p>
        `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fa fa-times"></i> Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                window.location.href = BASE_URL + 'menu-manager/delete/' + menuId;
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
    .icon-item:hover {
        transform: scale(1.05);
    }
</style>
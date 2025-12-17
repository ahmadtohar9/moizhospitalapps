<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Hak Akses User
            <small>Kelola Akses Menu Sidebar & Tab Medis</small>
        </h1>
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

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"></i> Daftar User</h3>
                <div class="box-tools pull-right">
                    <span class="label label-info">Total: <?= count($users); ?> users</span>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="userAccessTable">
                        <thead>
                            <tr class="bg-primary">
                                <th width="50">ID</th>
                                <th>Username</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        <strong><?= htmlspecialchars($user['username']); ?></strong>
                                    </td>
                                    <td><?= htmlspecialchars($user['nama_user']); ?></td>
                                    <td>
                                        <small><?= htmlspecialchars($user['email'] ?? '-'); ?></small>
                                    </td>
                                    <td>
                                        <?php
                                        $role_class = 'default';
                                        if ($user['role_id'] == 1)
                                            $role_class = 'danger';
                                        elseif ($user['role_id'] == 3)
                                            $role_class = 'success';
                                        elseif ($user['role_id'] == 2)
                                            $role_class = 'info';
                                        ?>
                                        <span class="label label-<?= $role_class; ?>">
                                            <?= htmlspecialchars($user['role_name'] ?? 'Unknown'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $user['is_active']
                                            ? '<span class="label label-success"><i class="fa fa-check"></i> Aktif</span>'
                                            : '<span class="label label-danger"><i class="fa fa-times"></i> Nonaktif</span>'
                                            ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('user-access/manage/' . $user['id']); ?>"
                                            class="btn btn-primary btn-sm" title="Kelola Menu Sidebar">
                                            <i class="fa fa-bars"></i> Menu Sidebar
                                        </a>
                                        <a href="<?= base_url('UserRmeAccessController/manage/' . $user['id']); ?>"
                                            class="btn btn-warning btn-sm" title="Kelola Tab Medis">
                                            <i class="fa fa-user-md"></i> Tab Medis
                                        </a>
                                        <button class="btn btn-success btn-sm btn-copy-access" data-id="<?= $user['id']; ?>"
                                            data-username="<?= htmlspecialchars($user['username'], ENT_QUOTES); ?>"
                                            data-nama="<?= htmlspecialchars($user['nama_user'], ENT_QUOTES); ?>"
                                            title="Copy Akses ke User Lain">
                                            <i class="fa fa-copy"></i> Copy Akses
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Copy Access -->
<div class="modal fade" id="copyAccessModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('user-access/copy_access'); ?>" method="POST" id="copyAccessForm">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <i class="fa fa-copy"></i> Copy Hak Akses User
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="source_user_id" id="source_user_id">

                    <!-- Source User Info -->
                    <div class="alert alert-info">
                        <h4><i class="fa fa-user"></i> User Sumber (Copy Dari):</h4>
                        <p style="font-size: 16px; margin: 5px 0;">
                            <strong id="source_user_name"></strong> (<span id="source_username"></span>)
                        </p>
                        <small>
                            <i class="fa fa-info-circle"></i>
                            Hak akses (Menu Sidebar & Tab Medis) dari user ini akan di-copy ke user tujuan
                        </small>
                    </div>

                    <!-- Target Users Selection -->
                    <div class="form-group">
                        <label>
                            <i class="fa fa-users"></i> Pilih User Tujuan (Copy Ke):
                            <span class="text-danger">*</span>
                        </label>

                        <!-- Search Box -->
                        <div class="input-group" style="margin-bottom: 10px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="targetUserSearch"
                                placeholder="Cari user tujuan...">
                        </div>

                        <!-- Select All / Deselect All -->
                        <div style="margin-bottom: 10px;">
                            <button type="button" class="btn btn-xs btn-success" id="selectAllTargets">
                                <i class="fa fa-check-square-o"></i> Pilih Semua
                            </button>
                            <button type="button" class="btn btn-xs btn-warning" id="deselectAllTargets">
                                <i class="fa fa-square-o"></i> Hapus Semua
                            </button>
                            <span class="label label-primary" id="selectedTargetCount">0 dipilih</span>
                        </div>

                        <!-- User List -->
                        <div
                            style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
                            <?php foreach ($users as $user): ?>
                                <div class="checkbox target-user-item" data-username="<?= strtolower($user['username']); ?>"
                                    data-nama="<?= strtolower($user['nama_user']); ?>">
                                    <label>
                                        <input type="checkbox" class="target-user-checkbox" name="target_user_ids[]"
                                            value="<?= $user['id']; ?>" data-id="<?= $user['id']; ?>">
                                        <strong><?= htmlspecialchars($user['nama_user']); ?></strong>
                                        <small class="text-muted">(<?= htmlspecialchars($user['username']); ?>)</small>
                                        <span
                                            class="label label-<?= $user['role_id'] == 1 ? 'danger' : ($user['role_id'] == 3 ? 'success' : 'info'); ?>">
                                            <?= htmlspecialchars($user['role_name'] ?? 'Unknown'); ?>
                                        </span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <small class="text-muted">
                            <i class="fa fa-info-circle"></i>
                            Centang user yang akan menerima copy hak akses. Bisa pilih lebih dari 1 user.
                        </small>
                    </div>

                    <!-- Warning -->
                    <div class="alert alert-warning">
                        <i class="fa fa-warning"></i>
                        <strong>Perhatian:</strong>
                        Hak akses user tujuan yang sudah ada akan <strong>DITIMPA</strong> dengan hak akses dari user
                        sumber!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa fa-copy"></i> Copy Hak Akses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Initialize DataTable
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#userAccessTable')) {
            $('#userAccessTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 25,
                "order": [[0, 'asc']],
                "language": {
                    "search": "Cari User:",
                    "lengthMenu": "Tampilkan _MENU_ user per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ user",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total user)",
                    "zeroRecords": "Tidak ada user yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": 6 } // Disable sorting on Actions column
                ]
            });
        }
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

    // ============================================
    // COPY ACCESS FUNCTIONALITY
    // ============================================

    // Open copy access modal
    $(document).on('click', '.btn-copy-access', function () {
        const sourceId = $(this).data('id');
        const sourceUsername = $(this).data('username');
        const sourceNama = $(this).data('nama');

        // Set source user info
        $('#source_user_id').val(sourceId);
        $('#source_username').text(sourceUsername);
        $('#source_user_name').text(sourceNama);

        // Reset target selections
        $('.target-user-checkbox').prop('checked', false);

        // Hide source user from target list
        $(`.target-user-checkbox[data-id="${sourceId}"]`).closest('.target-user-item').hide();

        // Show all other users
        $('.target-user-item').not(`:has(.target-user-checkbox[data-id="${sourceId}"])`).show();

        // Reset search
        $('#targetUserSearch').val('');

        // Update counter
        updateTargetCount();

        // Show modal
        $('#copyAccessModal').modal('show');
    });

    // Update target count
    function updateTargetCount() {
        const count = $('.target-user-checkbox:checked').length;
        $('#selectedTargetCount').text(count + ' dipilih');
    }

    // Target checkbox change
    $('.target-user-checkbox').change(function () {
        updateTargetCount();
    });

    // Select all visible targets
    $('#selectAllTargets').click(function () {
        $('.target-user-checkbox:visible').prop('checked', true);
        updateTargetCount();
    });

    // Deselect all targets
    $('#deselectAllTargets').click(function () {
        $('.target-user-checkbox').prop('checked', false);
        updateTargetCount();
    });

    // Search target users
    $('#targetUserSearch').on('input', function () {
        const searchTerm = $(this).val().toLowerCase();
        const sourceId = $('#source_user_id').val();

        $('.target-user-item').each(function () {
            const username = $(this).data('username');
            const nama = $(this).data('nama');
            const userId = $(this).find('.target-user-checkbox').data('id');

            // Skip source user
            if (userId == sourceId) {
                $(this).hide();
                return;
            }

            // Check if matches search
            if (username.includes(searchTerm) || nama.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Form validation
    $('#copyAccessForm').submit(function (e) {
        const selectedCount = $('.target-user-checkbox:checked').length;

        if (selectedCount === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Pilih User Tujuan',
                text: 'Pilih minimal 1 user tujuan untuk copy hak akses!',
                confirmButtonText: 'OK'
            });
            return false;
        }

        // Confirmation
        e.preventDefault();
        Swal.fire({
            icon: 'question',
            title: 'Konfirmasi Copy Akses',
            html: `
                <p>Apakah Anda yakin ingin copy hak akses ke <strong>${selectedCount} user</strong>?</p>
                <p style="color: #f39c12; margin-top: 10px;">
                    <i class="fa fa-warning"></i> 
                    Hak akses user tujuan yang sudah ada akan <strong>DITIMPA</strong>!
                </p>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-copy"></i> Ya, Copy Sekarang!',
            cancelButtonText: '<i class="fa fa-times"></i> Batal',
            confirmButtonColor: '#00a65a',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Copying...',
                    html: 'Mohon tunggu, sedang copy hak akses...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                $('#copyAccessForm').off('submit').submit();
            }
        });
    });
</script>

<style>
    .bg-primary {
        background-color: #3c8dbc !important;
        color: white !important;
    }

    .table>thead>tr>th {
        vertical-align: middle;
    }

    .label {
        font-size: 90%;
        padding: 4px 8px;
    }

    .modal-header.bg-success {
        background-color: #00a65a !important;
        color: white !important;
    }

    .target-user-item {
        padding: 5px;
        margin: 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .target-user-item:hover {
        background-color: #f9f9f9;
    }

    .target-user-item label {
        font-weight: normal;
        margin: 0;
        cursor: pointer;
        width: 100%;
    }

    #selectedTargetCount {
        font-size: 12px;
        padding: 4px 8px;
    }
</style>
```
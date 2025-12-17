<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Menu RME
            <small>Daftar Tab Form Rekam Medis Elektronik</small>
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
                <h3 class="box-title"><i class="fa fa-list"></i> Daftar Menu RME</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">
                        <i class="fa fa-plus"></i> Tambah Menu Baru
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="rmeMenuTable">
                        <thead>
                            <tr class="bg-primary">
                                <th width="50">No</th>
                                <th>Nama Tab</th>
                                <th>URL Path</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menus as $i => $m): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td style="font-weight:600; font-size:1.05em;">
                                        <i class="fa fa-file-text-o"></i> <?= htmlspecialchars($m['tab_name']) ?>
                                    </td>
                                    <td><code><?= htmlspecialchars($m['tab_url']) ?></code></td>
                                    <td>
                                        <?php if ($m['category'] == 'dokter'): ?>
                                            <span class="label label-primary"><i class="fa fa-user-md"></i> Dokter</span>
                                        <?php elseif ($m['category'] == 'perawat'): ?>
                                            <span class="label label-success"><i class="fa fa-user-nurse"></i> Perawat</span>
                                        <?php else: ?>
                                            <span class="label label-default"><i class="fa fa-users"></i> Umum</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $m['is_active']
                                            ? '<span class="label label-success"><i class="fa fa-check"></i> Aktif</span>'
                                            : '<span class="label label-danger"><i class="fa fa-times"></i> Nonaktif</span>'
                                            ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal"
                                            data-target="#editMenuModal" data-id="<?= $m['id'] ?>"
                                            data-name="<?= htmlspecialchars($m['tab_name'], ENT_QUOTES) ?>"
                                            data-url="<?= htmlspecialchars($m['tab_url'], ENT_QUOTES) ?>"
                                            data-category="<?= $m['category'] ?>" data-active="<?= $m['is_active'] ?>"
                                            onclick="openEditModal(this)">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-xs btn-delete-rme" data-id="<?= $m['id'] ?>"
                                            data-name="<?= htmlspecialchars($m['tab_name'], ENT_QUOTES) ?>">
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
    </section>
</div>

<!-- Modal Add Menu -->
<div class="modal fade" id="addMenuModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('rme-menu/create'); ?>" method="POST" id="addMenuForm">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Menu RME Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tab_name">Nama Tab <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tab_name" id="tab_name"
                            placeholder="Contoh: Asesmen Awal Medis" required>
                        <small class="text-muted">Nama tab yang akan ditampilkan di form RME</small>
                    </div>

                    <div class="form-group">
                        <label for="tab_url">URL Path (Controller/View) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tab_url" id="tab_url"
                            placeholder="Contoh: medis-mata atau AwalMedisDokterMataRalanController/index" required>
                        <small class="text-muted">Path ke controller atau view yang akan di-load</small>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="dokter">Dokter</option>
                            <option value="perawat">Perawat</option>
                            <option value="umum">Umum</option>
                        </select>
                        <small class="text-muted">Kategori akses menu (siapa yang bisa mengakses)</small>
                    </div>

                    <div class="form-group">
                        <label for="is_active">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Menu -->
<div class="modal fade" id="editMenuModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editMenuForm" action="<?= base_url('rme-menu/edit'); ?>" method="POST">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Menu RME</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label for="edit_tab_name">Nama Tab <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tab_name" id="edit_tab_name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_tab_url">URL Path (Controller/View) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tab_url" id="edit_tab_url" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_category">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="edit_category" required>
                            <option value="dokter">Dokter</option>
                            <option value="perawat">Perawat</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_is_active">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="is_active" id="edit_is_active">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Update Menu
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
    // BASE_URL already defined in header.php

    // Initialize DataTable
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#rmeMenuTable')) {
            $('#rmeMenuTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 25,
                "order": [[0, 'asc']], // Sort by No
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ menu",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total menu)",
                    "zeroRecords": "Tidak ada menu yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": 5 } // Disable sorting on Actions column
                ]
            });
        }
    });

    // Open edit modal
    function openEditModal(btn) {
        const data = $(btn).data();

        $('#editMenuForm').attr('action', BASE_URL + 'rme-menu/edit/' + data.id);
        $('#edit_id').val(data.id);
        $('#edit_tab_name').val(data.name);
        $('#edit_tab_url').val(data.url);
        $('#edit_category').val(data.category);
        $('#edit_is_active').val(data.active);
    }

    // Delete menu with SweetAlert2
    $(document).on('click', '.btn-delete-rme', function (e) {
        e.preventDefault();

        const menuId = $(this).data('id');
        const menuName = $(this).data('name');

        Swal.fire({
            title: 'Hapus Menu RME?',
            html: `
            <p style="font-size: 16px; margin-bottom: 10px;">
                Apakah Anda yakin ingin menghapus menu ini?
            </p>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                <p style="margin: 5px 0;"><strong>Menu:</strong> ${menuName}</p>
            </div>
            <p style="color: #dc3545; margin-top: 15px; font-size: 14px;">
                <i class="fa fa-warning"></i> Data akses user terkait menu ini juga akan hilang!
            </p>
        `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fa fa-times"></i> Batal',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Redirect to delete URL
                window.location.href = BASE_URL + 'rme-menu/delete/' + menuId;
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

    // Form validation
    $('#addMenuForm, #editMenuForm').on('submit', function (e) {
        const tabName = $(this).find('[name="tab_name"]').val().trim();
        const tabUrl = $(this).find('[name="tab_url"]').val().trim();
        const category = $(this).find('[name="category"]').val();

        if (!tabName || !tabUrl || !category) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Semua field wajib diisi!',
                timer: 3000,
                timerProgressBar: true
            });
            return false;
        }
    });
</script>

<style>
    .bg-primary {
        background-color: #3c8dbc !important;
        color: white !important;
    }

    .modal-header.bg-primary,
    .modal-header.bg-warning {
        color: white;
    }

    .modal-header.bg-warning {
        background-color: #f39c12 !important;
    }

    .table>thead>tr>th {
        vertical-align: middle;
    }

    .label {
        font-size: 90%;
        padding: 4px 8px;
    }
</style>
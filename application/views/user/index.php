<div class="content-wrapper">
  <section class="content-header">
    <h1>User Management</h1>
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
        <h3 class="box-title">Daftar User</h3>
        <br><br>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
          <i class="fa fa-plus"></i> Add New User
        </button>
      </div>
      <div class="box-body">
        <table id="MoizTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Nama User</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user['id']; ?></td>
                <td><?= htmlspecialchars($user['username'], ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($user['nama_user'], ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES); ?></td>
                <td>
                  <span
                    class="label label-<?= $user['role_id'] == 1 ? 'danger' : ($user['role_id'] == 3 ? 'success' : 'info'); ?>">
                    <?= htmlspecialchars($user['role_name'], ENT_QUOTES); ?>
                  </span>
                </td>
                <td>
                  <span class="label label-<?= $user['is_active'] ? 'success' : 'default'; ?>">
                    <?= $user['is_active'] ? 'Active' : 'Inactive'; ?>
                  </span>
                </td>
                <td>
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal"
                    data-id="<?= $user['id']; ?>" data-username="<?= htmlspecialchars($user['username'], ENT_QUOTES); ?>"
                    data-nama="<?= htmlspecialchars($user['nama_user'], ENT_QUOTES); ?>"
                    data-email="<?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES); ?>"
                    data-role_id="<?= (int) ($user['role_id'] ?? 0); ?>" data-active="<?= (int) $user['is_active']; ?>"
                    data-kd_pegawai="<?= htmlspecialchars($user['kd_pegawai'] ?? '', ENT_QUOTES); ?>"
                    data-kd_dokter="<?= htmlspecialchars($user['kd_dokter'] ?? '', ENT_QUOTES); ?>"
                    onclick="openEditModal(this)">
                    <i class="fa fa-edit"></i> Edit
                  </button>
                  <button class="btn btn-danger btn-sm btn-delete-user" data-id="<?= $user['id']; ?>"
                    data-username="<?= htmlspecialchars($user['username'], ENT_QUOTES); ?>"
                    data-nama="<?= htmlspecialchars($user['nama_user'], ENT_QUOTES); ?>">
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

<!-- Modal Add User -->
<div class="modal fade" id="addUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('user-manager/save'); ?>" method="POST" id="addUserForm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add New User</h4>
        </div>

        <div class="modal-body">
          <!-- Role -->
          <div class="form-group">
            <label for="role_id">Role <span class="text-danger">*</span></label>
            <select name="role_id" id="role_id" class="form-control" required>
              <option value="">-- Pilih Role --</option>
              <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id']; ?>"
                  data-role-name="<?= htmlspecialchars($role['role_name'], ENT_QUOTES); ?>">
                  <?= htmlspecialchars($role['role_name'], ENT_QUOTES); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Pilih Dokter (autocomplete) -->
          <div class="form-group" id="wrapDokter" style="display:none;">
            <label for="dokterSelect">Pilih Dokter <span class="text-danger">*</span></label>
            <select class="form-control select2-dokter" id="dokterSelect" style="width: 100%;">
              <option value="">-- Ketik untuk mencari dokter --</option>
            </select>
            <small class="text-muted">Ketik minimal 2 karakter untuk mencari</small>
          </div>

          <!-- Pilih Petugas (autocomplete) -->
          <div class="form-group" id="wrapPetugas" style="display:none;">
            <label for="petugasSelect">Pilih Petugas/Perawat <span class="text-danger">*</span></label>
            <select class="form-control select2-petugas" id="petugasSelect" style="width: 100%;">
              <option value="">-- Ketik untuk mencari petugas --</option>
            </select>
            <small class="text-muted">Ketik minimal 2 karakter untuk mencari</small>
          </div>

          <!-- Username & Nama (readonly, auto-filled) -->
          <div class="form-group">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" id="username" readonly required>
            <small class="text-muted">Otomatis terisi dari pilihan dokter/petugas</small>
          </div>

          <div class="form-group">
            <label for="nama_user">Nama User <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" readonly required>
            <small class="text-muted">Otomatis terisi dari pilihan dokter/petugas</small>
          </div>

          <!-- Email & Password -->
          <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
          </div>

          <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password"
              required>
            <small class="text-muted">Minimal 6 karakter</small>
          </div>

          <!-- Status -->
          <div class="form-group">
            <label for="is_active">Status <span class="text-danger">*</span></label>
            <select name="is_active" id="is_active" class="form-control" required>
              <option value="1" selected>Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <!-- Hidden fields -->
          <input type="hidden" name="kd_pegawai" id="kd_pegawai">
          <input type="hidden" name="kd_dokter" id="kd_dokter">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Save User
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editUserForm" action="<?= base_url('user-manager/update'); ?>" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-edit"></i> Edit User</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">

          <div class="form-group">
            <label for="edit_username">Username</label>
            <input type="text" class="form-control" name="username" id="edit_username" readonly required>
          </div>

          <div class="form-group">
            <label for="edit_nama_user">Nama User <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_user" id="edit_nama_user" required>
          </div>

          <div class="form-group">
            <label for="edit_email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="edit_email" required>
          </div>

          <div class="form-group">
            <label for="edit_password">New Password (optional)</label>
            <input type="password" class="form-control" name="password" id="edit_password"
              placeholder="Kosongkan jika tidak ingin mengganti password">
            <small class="text-muted">Minimal 6 karakter jika ingin mengganti</small>
          </div>

          <div class="form-group">
            <label for="edit_role_id">Role <span class="text-danger">*</span></label>
            <select name="role_id" id="edit_role_id" class="form-control">
              <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id']; ?>"
                  data-role-name="<?= htmlspecialchars($role['role_name'], ENT_QUOTES); ?>">
                  <?= htmlspecialchars($role['role_name'], ENT_QUOTES); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="edit_is_active">Status <span class="text-danger">*</span></label>
            <select name="is_active" id="edit_is_active" class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="form-group">
            <label for="edit_kd_pegawai">Kode Pegawai</label>
            <input type="text" class="form-control" name="kd_pegawai" id="edit_kd_pegawai" readonly>
          </div>

          <div class="form-group" id="edit_wrap_kd_dokter" style="display:none;">
            <label for="edit_kd_dokter">Kode Dokter</label>
            <input type="text" class="form-control" name="kd_dokter" id="edit_kd_dokter" readonly>
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


<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  // BASE_URL already defined in header.php
  const DOKTER_ROLE_ID = <?= isset($dokter_role_id) ? (int) $dokter_role_id : 0 ?>;

  // ============================================
  // OPTIMIZED AUTOCOMPLETE WITH SELECT2
  // ============================================

  // Initialize Select2 for Dokter with AJAX
  function initDokterSelect2() {
    $('.select2-dokter').select2({
      ajax: {
        url: BASE_URL + 'user-manager/search_dokter',
        dataType: 'json',
        delay: 300, // Debounce 300ms
        data: function (params) {
          return {
            q: params.term // search term
          };
        },
        processResults: function (response) {
          if (response.success) {
            return {
              results: response.data
            };
          }
          return { results: [] };
        },
        cache: true // Enable caching
      },
      minimumInputLength: 2,
      placeholder: '-- Ketik untuk mencari dokter --',
      allowClear: true,
      language: {
        inputTooShort: function () {
          return 'Ketik minimal 2 karakter';
        },
        searching: function () {
          return 'Mencari...';
        },
        noResults: function () {
          return 'Tidak ada hasil';
        }
      }
    });
  }

  // Initialize Select2 for Petugas with AJAX
  function initPetugasSelect2() {
    $('.select2-petugas').select2({
      ajax: {
        url: BASE_URL + 'user-manager/search_petugas',
        dataType: 'json',
        delay: 300, // Debounce 300ms
        data: function (params) {
          return {
            q: params.term // search term
          };
        },
        processResults: function (response) {
          if (response.success) {
            return {
              results: response.data
            };
          }
          return { results: [] };
        },
        cache: true // Enable caching
      },
      minimumInputLength: 2,
      placeholder: '-- Ketik untuk mencari petugas --',
      allowClear: true,
      language: {
        inputTooShort: function () {
          return 'Ketik minimal 2 karakter';
        },
        searching: function () {
          return 'Mencari...';
        },
        noResults: function () {
          return 'Tidak ada hasil';
        }
      }
    });
  }

  // Initialize on page load
  $(document).ready(function () {
    initDokterSelect2();
    initPetugasSelect2();

    // Initialize DataTable - check if already initialized
    if (!$.fn.DataTable.isDataTable('#MoizTable')) {
      $('#MoizTable').DataTable({
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
  });

  // ============================================
  // ROLE CHANGE HANDLER
  // ============================================

  function isDokterRole(roleId) {
    return DOKTER_ROLE_ID && parseInt(roleId) === DOKTER_ROLE_ID;
  }

  function toggleSourceByRole() {
    const roleSel = document.getElementById('role_id');
    const roleId = roleSel.value;
    const isDokter = isDokterRole(roleId);

    // Show/hide appropriate fields
    $('#wrapDokter').toggle(isDokter);
    $('#wrapPetugas').toggle(!isDokter);

    // Reset values
    $('#username').val('');
    $('#nama_user').val('');
    $('#kd_dokter').val('');
    $('#kd_pegawai').val('');

    // Reset Select2
    $('.select2-dokter').val(null).trigger('change');
    $('.select2-petugas').val(null).trigger('change');
  }

  // Role change event
  $('#role_id').on('change', toggleSourceByRole);

  // Modal shown event
  $('#addUserModal').on('shown.bs.modal', function () {
    toggleSourceByRole();
  });

  // ============================================
  // SELECT2 CHANGE HANDLERS
  // ============================================

  // Dokter selected
  $('.select2-dokter').on('select2:select', function (e) {
    const data = e.params.data;
    $('#username').val(data.kd_dokter);
    $('#nama_user').val(data.nm_dokter);
    $('#kd_dokter').val(data.kd_dokter);
    $('#kd_pegawai').val('');
  });

  // Petugas selected
  $('.select2-petugas').on('select2:select', function (e) {
    const data = e.params.data;
    $('#username').val(data.nik);
    $('#nama_user').val(data.nama);
    $('#kd_pegawai').val(data.nik);
    $('#kd_dokter').val('');
  });

  // ============================================
  // EDIT MODAL HANDLER
  // ============================================

  function openEditModal(btn) {
    const data = $(btn).data();

    $('#edit_id').val(data.id);
    $('#edit_username').val(data.username);
    $('#edit_nama_user').val(data.nama);
    $('#edit_email').val(data.email);
    $('#edit_role_id').val(data.role_id);
    $('#edit_is_active').val(data.active);
    $('#edit_kd_pegawai').val(data.kd_pegawai || '');
    $('#edit_kd_dokter').val(data.kd_dokter || '');

    // Show/hide dokter field
    const isDokter = isDokterRole(data.role_id);
    $('#edit_wrap_kd_dokter').toggle(isDokter);
  }

  // ============================================
  // FORM VALIDATION
  // ============================================

  $('#addUserForm').on('submit', function (e) {
    const password = $('#password').val();
    if (password.length < 6) {
      e.preventDefault();
      alert('Password minimal 6 karakter!');
      return false;
    }
  });

  $('#editUserForm').on('submit', function (e) {
    const password = $('#edit_password').val();
    if (password && password.length < 6) {
      e.preventDefault();
      alert('Password minimal 6 karakter!');
      return false;
    }
  });

  // ============================================
  // DELETE USER HANDLER
  // ============================================

  $(document).on('click', '.btn-delete-user', function (e) {
    e.preventDefault();

    const userId = $(this).data('id');
    const username = $(this).data('username');
    const nama = $(this).data('nama');

    // Beautiful confirmation with SweetAlert2
    Swal.fire({
      title: 'Hapus User?',
      html: `
            <p style="font-size: 16px; margin-bottom: 10px;">
                Apakah Anda yakin ingin menghapus user ini?
            </p>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                <p style="margin: 5px 0;"><strong>Username:</strong> ${username}</p>
                <p style="margin: 5px 0;"><strong>Nama:</strong> ${nama}</p>
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
        window.location.href = BASE_URL + 'user-manager/delete/' + userId;
      }
    });
  });
</script>

<style>
  /* Select2 custom styling */
  .select2-container--default .select2-selection--single {
    height: 34px;
    padding: 6px 12px;
    border: 1px solid #d2d6de;
    border-radius: 0;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 20px;
    padding-left: 0;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 32px;
  }

  .select2-dropdown {
    border: 1px solid #d2d6de;
    border-radius: 0;
  }

  /* Loading indicator */
  .select2-results__option--loading {
    color: #999;
  }

  /* Highlight search term */
  .select2-results__option--highlighted {
    background-color: #3c8dbc !important;
    color: white !important;
  }
</style>
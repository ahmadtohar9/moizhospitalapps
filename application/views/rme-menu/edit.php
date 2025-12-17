<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Menu RME</h1>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Data: <?= $menu['tab_name'] ?></h3>
            </div>
            <form action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama Tab Menu</label>
                        <input type="text" name="tab_name" class="form-control" value="<?= $menu['tab_name'] ?>"
                            required>
                        <small class="text-danger"><?= form_error('tab_name'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>URL / Path View</label>
                        <input type="text" name="tab_url" class="form-control" value="<?= $menu['tab_url'] ?>" required>
                        <p class="help-block">Hati-hati mengubah ini jika menu sudah digunakan.</p>
                        <small class="text-danger"><?= form_error('tab_url'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>Kategori Default</label>
                        <select name="category" class="form-control">
                            <option value="dokter" <?= $menu['category'] == 'dokter' ? 'selected' : ''; ?>>Dokter</option>
                            <option value="perawat" <?= $menu['category'] == 'perawat' ? 'selected' : ''; ?>>Perawat</option>
                            <option value="umum" <?= $menu['category'] == 'umum' ? 'selected' : ''; ?>>Umum</option>
                        </select>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_active" value="1" <?= $menu['is_active'] ? 'checked' : ''; ?>>
                            <strong>Aktif</strong> (Dapat dipilih user)
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Perbarui</button>
                    <a href="<?= base_url('rme-menu'); ?>" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>
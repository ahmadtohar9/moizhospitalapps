<div class="content-wrapper">
    <section class="content-header">
        <h1>Tambah Menu RME Baru</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Input</h3>
            </div>
            <form action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama Tab Menu</label>
                        <input type="text" name="tab_name" class="form-control" placeholder="Contoh: Asesmen Gizi"
                            required>
                        <small class="text-danger"><?= form_error('tab_name'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>URL / Path View</label>
                        <input type="text" name="tab_url" class="form-control"
                            placeholder="Contoh: rekammedis/gizi/form_gizi" required>
                        <p class="help-block">Masukkan path file view (jika load view) atau path controller (jika load
                            controller).</p>
                        <small class="text-danger"><?= form_error('tab_url'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>Kategori Default</label>
                        <select name="category" class="form-control">
                            <option value="dokter">Dokter</option>
                            <option value="perawat">Perawat</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_active" value="1" checked> <strong>Aktif</strong> (Dapat
                            dipilih user)
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="<?= base_url('rme-menu'); ?>" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>
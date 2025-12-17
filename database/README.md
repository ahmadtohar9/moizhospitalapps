# Database Migrations

Folder ini berisi file-file SQL migration untuk update database.

## Format Nama File

```
YYYY-MM-DD_deskripsi_singkat.sql
```

Contoh:
- `2025-12-17_add_rehab_medik_table.sql`
- `2025-12-18_update_reg_periksa_add_column.sql`

## Cara Membuat Migration

### 1. Export dari phpMyAdmin

1. Buat tabel/perubahan di database local
2. Di phpMyAdmin, pilih tabel yang baru dibuat
3. Klik tab "Export"
4. Pilih format "SQL"
5. Centang "Structure" dan "Data" (jika perlu)
6. Klik "Go" untuk download

### 2. Edit File SQL

Tambahkan header dan gunakan `IF NOT EXISTS`:

```sql
-- Migration: Tambah tabel rehab_medik
-- Date: 2025-12-17
-- Author: Ahmad Tohar
-- Description: Tabel untuk menyimpan data rehab medik pasien

-- Cek jika tabel sudah ada
CREATE TABLE IF NOT EXISTS `rehab_medik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rawat` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  -- ... kolom lainnya
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tambah index jika belum ada
ALTER TABLE `rehab_medik` 
ADD INDEX IF NOT EXISTS `idx_no_rawat` (`no_rawat`);
```

### 3. Simpan di Folder Migrations

Simpan file di folder `database/migrations/` dengan nama sesuai format.

### 4. Commit ke Git

```bash
git add database/migrations/2025-12-17_nama_migration.sql
git commit -m "Add migration: deskripsi singkat"
git push origin main
```

## Cara Menjalankan Migration

### Otomatis (via System Update)

1. Login sebagai admin
2. Buka menu **System Update**
3. Klik tombol **Update Now**
4. Migrations akan dijalankan otomatis

### Manual (via Controller)

Akses URL:
```
http://yourdomain.com/systemupdate/run_migrations
```

### Manual (via MySQL Command)

```bash
mysql -u username -p database_name < database/migrations/2025-12-17_nama_migration.sql
```

## Best Practices

### ✅ DO

- **Gunakan `IF NOT EXISTS`** untuk CREATE TABLE
- **Gunakan `IF NOT EXISTS`** untuk ALTER TABLE ADD COLUMN
- **Tambahkan komentar** di awal file
- **Test di local** sebelum commit
- **Backup database** sebelum run migration
- **Gunakan transaction** jika memungkinkan

### ❌ DON'T

- Jangan DROP TABLE tanpa backup
- Jangan ALTER TABLE tanpa IF NOT EXISTS
- Jangan hardcode data production
- Jangan commit file yang belum di-test

## Contoh Migration

### Tambah Tabel Baru

```sql
-- Migration: Add table formulir_kfr
-- Date: 2025-12-17

CREATE TABLE IF NOT EXISTS `formulir_kfr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rawat` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tambah Kolom

```sql
-- Migration: Add column status to reg_periksa
-- Date: 2025-12-17

ALTER TABLE `reg_periksa` 
ADD COLUMN IF NOT EXISTS `status_update` varchar(20) DEFAULT 'pending';
```

### Update Data

```sql
-- Migration: Update default values
-- Date: 2025-12-17

UPDATE `config_table` 
SET `value` = 'new_value' 
WHERE `key` = 'some_key' 
AND `value` = 'old_value';
```

### Tambah Index

```sql
-- Migration: Add indexes for performance
-- Date: 2025-12-17

ALTER TABLE `reg_periksa` 
ADD INDEX IF NOT EXISTS `idx_tgl_registrasi` (`tgl_registrasi`);

ALTER TABLE `reg_periksa` 
ADD INDEX IF NOT EXISTS `idx_no_rkm_medis` (`no_rkm_medis`);
```

## Tracking Migrations

Semua migrations yang sudah dijalankan akan dicatat di tabel `system_migrations`:

```sql
SELECT * FROM system_migrations ORDER BY executed_at DESC;
```

Kolom:
- `migration_file`: Nama file migration
- `executed_at`: Waktu eksekusi
- `executed_by`: User yang menjalankan
- `status`: success/failed
- `error_message`: Pesan error jika gagal

## Rollback

Untuk rollback migration, Anda perlu:

1. Buat migration baru yang undo perubahan
2. Atau restore dari backup database

Contoh rollback migration:

```sql
-- Migration: Rollback add column status
-- Date: 2025-12-17

ALTER TABLE `reg_periksa` 
DROP COLUMN IF EXISTS `status_update`;
```

## Troubleshooting

### Migration Gagal

1. Cek error message di tabel `system_migrations`
2. Cek log di `application/logs/`
3. Test SQL manual di phpMyAdmin
4. Fix error dan retry

### Migration Sudah Dijalankan Tapi Mau Retry

```sql
DELETE FROM system_migrations WHERE migration_file = 'nama_file.sql';
```

Lalu jalankan migration lagi.

## Tips

1. **Selalu backup** sebelum run migration di production
2. **Test di local** terlebih dahulu
3. **Gunakan transaction** untuk multiple queries
4. **Dokumentasikan** setiap perubahan
5. **Commit migration file** bersamaan dengan code changes

---

**Happy Migrating!** 🚀

# 🚀 IMPLEMENTASI OPTIMASI - STEP BY STEP

## Untuk Mendukung 300 Pasien/Hari dengan Puluhan Dokter & Perawat

---

## ✅ LANGKAH 1: BACKUP DATABASE (WAJIB!)

```bash
# Backup database sebelum melakukan perubahan
mysqldump -u root -p sik > backup_sik_$(date +%Y%m%d_%H%M%S).sql

# Atau via phpMyAdmin: Export > SQL > Go
```

---

## ✅ LANGKAH 2: JALANKAN SQL UNTUK MENAMBAH INDEXES

### A. Tambah Kolom yang Diperlukan

```bash
# Login ke MySQL
mysql -u root -p sik

# Jalankan file SQL
source /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/database/02_add_user_columns.sql
```

Atau via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database `sik`
3. Klik tab "SQL"
4. Copy-paste isi file `database/02_add_user_columns.sql`
5. Klik "Go"

### B. Tambah Performance Indexes

```bash
# Jalankan file SQL indexes
source /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/database/01_performance_indexes.sql
```

Atau via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database `sik`
3. Klik tab "SQL"
4. Copy-paste isi file `database/01_performance_indexes.sql`
5. Klik "Go"

**⚠️ PENTING:** Proses ini bisa memakan waktu 5-15 menit tergantung ukuran database!

---

## ✅ LANGKAH 3: UPDATE KONFIGURASI CODEIGNITER

### A. Aktifkan Output Compression

Edit file: `application/config/config.php`

Cari baris:
```php
$config['compress_output'] = FALSE;
```

Ubah menjadi:
```php
$config['compress_output'] = TRUE;
```

### B. Ubah Session ke Database (Opsional tapi Direkomendasikan)

Edit file: `application/config/config.php`

Cari baris:
```php
$config['sess_driver'] = 'files';
$config['sess_save_path'] = '/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/sessions/';
```

Ubah menjadi:
```php
$config['sess_driver'] = 'database';
$config['sess_save_path'] = 'ci_sessions';
```

**Note:** Tabel `ci_sessions` sudah dibuat oleh script SQL di Langkah 2.

---

## ✅ LANGKAH 4: UPDATE KONFIGURASI DATABASE

Edit file: `application/config/database.php`

Pastikan konfigurasi berikut:

```php
$db['default'] = array(
    // ... existing config ...
    'pconnect' => TRUE,  // ⚡ Persistent connections
    'db_debug' => FALSE, // Production mode
    'cache_on' => TRUE,  // ⚡ Query caching
    'cachedir' => APPPATH . 'cache/db/',
    'compress' => TRUE,  // ⚡ Compression
    'save_queries' => FALSE, // Disable in production
);
```

---

## ✅ LANGKAH 5: BUAT DIREKTORI CACHE

```bash
# Buat direktori cache jika belum ada
mkdir -p /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache
mkdir -p /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/db

# Set permissions
chmod 777 /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache
chmod 777 /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/db
```

---

## ✅ LANGKAH 6: LINK USER KE DOKTER/PEGAWAI

Sekarang Anda perlu menghubungkan user yang ada dengan data dokter/pegawai mereka.

### Untuk Dokter (Role ID = 3):

```sql
-- Contoh: Update user dokter dengan kd_dokter
UPDATE moizhospital_users 
SET kd_dokter = 'DR001'  -- Ganti dengan kode dokter yang sesuai
WHERE username = 'dr.ahmad' AND role_id = 3;

-- Atau jika username sama dengan kd_dokter:
UPDATE moizhospital_users u
INNER JOIN dokter d ON u.username = d.kd_dokter
SET u.kd_dokter = d.kd_dokter
WHERE u.role_id = 3;
```

### Untuk Perawat/Staff (Role ID = 2):

```sql
-- Contoh: Update user perawat dengan nik pegawai
UPDATE moizhospital_users 
SET kd_pegawai = '123456'  -- Ganti dengan NIK pegawai yang sesuai
WHERE username = 'perawat1' AND role_id = 2;

-- Atau jika username sama dengan NIK:
UPDATE moizhospital_users u
INNER JOIN pegawai p ON u.username = p.nik
SET u.kd_pegawai = p.nik
WHERE u.role_id = 2;
```

---

## ✅ LANGKAH 7: TEST LOGIN

1. Buka browser: `http://127.0.0.1/moizhospitalapps/auth/login`
2. Login dengan akun dokter
3. Login dengan akun perawat
4. Login dengan akun admin

**Cek log file:** `application/logs/log-YYYY-MM-DD.php`

Anda harus melihat log seperti:
```
INFO - Login successful: dr.ahmad (Role: 3) in 45.23ms
```

---

## ✅ LANGKAH 8: MONITORING PERFORMANCE

### A. Cek Query Performance

```sql
-- Lihat slow queries
SELECT * FROM mysql.slow_log 
ORDER BY start_time DESC 
LIMIT 10;

-- Cek index usage
SHOW INDEX FROM reg_periksa;
SHOW INDEX FROM moizhospital_users;
```

### B. Cek Cache

```bash
# Lihat isi cache directory
ls -lah /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/

# Lihat ukuran cache
du -sh /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/
```

### C. Monitor Log Files

```bash
# Tail log file untuk melihat real-time
tail -f /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/logs/log-*.php
```

---

## ✅ LANGKAH 9: CLEAR CACHE SAAT DIPERLUKAN

### Manual Clear Cache:

```bash
# Clear all cache
rm -rf /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/*

# Clear DB cache only
rm -rf /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/db/*
```

### Programmatic Clear Cache:

Tambahkan method di controller:

```php
public function clear_cache() {
    // Only allow admin
    if ($this->session->userdata('role_id') != 1) {
        show_error('Unauthorized', 403);
    }
    
    $this->load->driver('cache');
    $this->cache->clean();
    
    // Clear DB cache
    $this->db->cache_delete_all();
    
    echo "Cache cleared successfully!";
}
```

---

## ✅ LANGKAH 10: OPTIMIZE MYSQL CONFIGURATION

Edit file: `/Applications/XAMPP/xamppfiles/etc/my.cnf` (Mac)
Atau: `C:\xampp\mysql\bin\my.ini` (Windows)

Tambahkan/ubah:

```ini
[mysqld]
# Connection Settings
max_connections = 200
max_user_connections = 150
wait_timeout = 600
interactive_timeout = 600

# Buffer Pool (sesuaikan dengan RAM)
innodb_buffer_pool_size = 2G  # 50-70% dari RAM yang tersedia
innodb_buffer_pool_instances = 4

# Query Cache
query_cache_type = 1
query_cache_size = 256M
query_cache_limit = 2M

# InnoDB Settings
innodb_flush_log_at_trx_commit = 2
innodb_log_file_size = 512M
innodb_log_buffer_size = 16M
innodb_file_per_table = 1

# Thread Settings
thread_cache_size = 50
table_open_cache = 4000
table_definition_cache = 2000

# Temporary Tables
tmp_table_size = 64M
max_heap_table_size = 64M
```

**Restart MySQL setelah perubahan:**

```bash
# Mac
sudo /Applications/XAMPP/xamppfiles/bin/mysql.server restart

# Windows
# Restart MySQL via XAMPP Control Panel
```

---

## 📊 EXPECTED RESULTS

Setelah implementasi, Anda harus melihat:

### Login Performance:
- **Before:** 2-3 seconds
- **After:** < 0.5 seconds (85% faster) ⚡

### Page Load Performance:
- **Before:** 8-10 seconds
- **After:** < 2 seconds (80% faster) ⚡

### Database Queries:
- **Before:** 50+ queries per page
- **After:** < 10 queries per page (80% reduction) ⚡

### Concurrent Users:
- **Before:** 10-15 users max
- **After:** 100+ users (600% increase) ⚡

---

## 🚨 TROUBLESHOOTING

### Problem: Login gagal setelah update

**Solution:**
```sql
-- Cek apakah kolom kd_dokter/kd_pegawai ada
DESCRIBE moizhospital_users;

-- Cek apakah user sudah di-link
SELECT id, username, role_id, kd_dokter, kd_pegawai 
FROM moizhospital_users;
```

### Problem: Cache tidak bekerja

**Solution:**
```bash
# Cek permissions
ls -la /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/

# Set permissions
chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/cache/
```

### Problem: Session expired terus

**Solution:**
```php
// Di config.php, ubah:
$config['sess_expiration'] = 7200; // 2 jam
```

### Problem: MySQL error "Too many connections"

**Solution:**
```sql
-- Cek current connections
SHOW PROCESSLIST;

-- Increase max connections
SET GLOBAL max_connections = 200;
```

---

## 📝 MAINTENANCE CHECKLIST

### Daily:
- [ ] Monitor log files untuk errors
- [ ] Cek slow query log

### Weekly:
- [ ] Clear cache jika diperlukan
- [ ] Analyze tables: `ANALYZE TABLE reg_periksa, pasien, pemeriksaan_ralan;`
- [ ] Optimize tables: `OPTIMIZE TABLE reg_periksa, pasien, pemeriksaan_ralan;`

### Monthly:
- [ ] Backup database
- [ ] Review performance metrics
- [ ] Clean old log files
- [ ] Clean old session data

---

## 🎯 NEXT STEPS (PHASE 2)

Setelah Phase 1 stabil, lanjutkan dengan:

1. **Reduce AJAX Calls** - Gabungkan 16 AJAX calls menjadi 1
2. **Implement Response Caching** - Cache hasil query
3. **Add Lazy Loading** - Load images on demand
4. **Optimize Print Function** - Batch processing

Lihat file: `PERFORMANCE_OPTIMIZATION_PLAN.md` untuk detail lengkap.

---

**Selamat mengoptimasi! 🚀**

Jika ada pertanyaan atau masalah, cek log files di:
- Application logs: `application/logs/`
- MySQL slow query log: `/Applications/XAMPP/xamppfiles/logs/`

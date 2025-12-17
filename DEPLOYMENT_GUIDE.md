# Panduan Deployment ke aaPanel

## Masalah Session Path

Aplikasi ini menggunakan CodeIgniter 3 yang menyimpan session di folder `application/sessions/`. 

### Error yang Muncul di Production
```
A PHP Error was encountered
Severity: Warning
Message: ini_set(): open_basedir restriction in effect. File(/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/sessions) is not within the allowed path(s): (/www/wwwroot/192.168.99.251/:/tmp/)
```

### Solusi yang Sudah Diterapkan

File `application/config/config.php` sudah diupdate untuk menggunakan path relatif:

```php
// SEBELUM (hardcoded path lokal)
$config['sess_save_path'] = '/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/sessions/';

// SESUDAH (path relatif yang portable)
$config['sess_save_path'] = APPPATH . 'sessions/';
```

### Langkah-Langkah Deployment

1. **Push perubahan ke GitHub**
   ```bash
   git add application/config/config.php
   git commit -m "Fix session path untuk production deployment"
   git push origin main
   ```

2. **Pull perubahan di server aaPanel**
   ```bash
   cd /www/wwwroot/192.168.99.251/moizhospitalapps
   git pull origin main
   ```

3. **Pastikan folder sessions memiliki permission yang benar**
   ```bash
   chmod 755 application/sessions
   chown www:www application/sessions
   ```

4. **Bersihkan session lama (opsional)**
   ```bash
   rm -f application/sessions/ci_session*
   ```

5. **Test aplikasi**
   - Buka browser dan akses halaman admin
   - Login harus berhasil tanpa error session

### Catatan Penting

- **APPPATH** adalah konstanta CodeIgniter yang otomatis mengarah ke folder `application/` di mana pun aplikasi di-deploy
- Perubahan ini membuat aplikasi portable dan bisa berjalan di berbagai environment (local XAMPP, production server, dll)
- Folder `application/sessions/` harus writable oleh web server (biasanya user `www` atau `www-data`)

### Troubleshooting

Jika masih ada error setelah deployment:

1. **Cek permission folder sessions:**
   ```bash
   ls -la application/sessions
   ```
   Harus bisa di-write oleh web server user

2. **Cek open_basedir restriction di PHP:**
   ```bash
   php -i | grep open_basedir
   ```
   Pastikan `/www/wwwroot/192.168.99.251/` ada dalam allowed paths

3. **Gunakan /tmp sebagai alternatif (jika masih error):**
   Edit `application/config/config.php`:
   ```php
   $config['sess_save_path'] = sys_get_temp_dir();
   ```
   Tapi ini kurang aman karena shared dengan aplikasi lain.

4. **Cek error log:**
   ```bash
   tail -f application/logs/log-*.php
   ```

### Konfigurasi aaPanel

Pastikan di aaPanel PHP Settings:
- **open_basedir** sudah include: `/www/wwwroot/192.168.99.251/:/tmp/`
- **session.save_path** tidak di-override di php.ini
- PHP version sesuai dengan requirement aplikasi

## Masalah Case Sensitivity File

### Error yang Muncul di Production
```
GET http://192.168.99.251/moizhospitalapps/assets/js/dokterRalan.js net::ERR_ABORTED 404 (Not Found)
```

### Penyebab Masalah

**macOS/Windows** menggunakan **case-insensitive filesystem**, artinya:
- `DokterRalan.js` = `dokterRalan.js` = `DOKTERRALAN.js` (dianggap sama)

**Linux** (server aaPanel) menggunakan **case-sensitive filesystem**, artinya:
- `DokterRalan.js` ≠ `dokterRalan.js` (dianggap berbeda!)

Jika file di Git bernama `DokterRalan.js` tapi di view dipanggil dengan `dokterRalan.js`, maka di server Linux akan error 404.

### Solusi yang Sudah Diterapkan

File `assets/js/DokterRalan.js` sudah di-rename menjadi `assets/js/dokterRalan.js` untuk konsistensi dengan naming convention JavaScript (camelCase dengan huruf kecil di awal).

### Cara Mencegah Masalah Ini

1. **Gunakan naming convention yang konsisten:**
   - JavaScript files: `camelCase.js` (huruf kecil di awal)
   - PHP files: `PascalCase.php` atau `snake_case.php`
   - CSS files: `kebab-case.css` atau `camelCase.css`

2. **Test di environment yang sama dengan production:**
   - Jika production menggunakan Linux, test juga di Linux (atau Docker)
   - Atau selalu gunakan lowercase untuk semua nama file

3. **Cek sebelum push ke Git:**
   ```bash
   # Cek nama file yang akan di-commit
   git status
   
   # Cek nama file di Git vs filesystem
   git ls-files assets/js/*.js
   ```

## Update Konfigurasi Lainnya

Jangan lupa update konfigurasi berikut di server production:

1. **Base URL** (`application/config/config.php`):
   ```php
   $config['base_url'] = 'http://192.168.99.251/moizhospitalapps/';
   // atau
   $config['base_url'] = 'http://yourdomain.com/';
   ```

2. **Database** (`application/config/database.php`):
   - hostname
   - username
   - password
   - database name

3. **Webapps paths** (jika ada):
   ```php
   $config['webapps_root_url'] = 'http://192.168.99.251/webapps';
   $config['webapps_root_fs'] = '/www/wwwroot/192.168.99.251/webapps';
   ```

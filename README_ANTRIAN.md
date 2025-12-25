# 🎯 Dashboard Antrian Pasien Rawat Jalan - Installation Guide

## ✅ Status: COMPLETED

Sistem Dashboard Antrian Pasien dengan Text-to-Speech sudah berhasil dibuat!

---

## 📦 Yang Sudah Dibuat

### 1. **Database** ✅
- ✅ Tabel: `moizhospital_antrian_poli`
- ✅ View: `view_antrian_poli_lengkap`
- ✅ Stored Procedure: `sp_generate_nomor_antrian`
- ✅ Trigger: `trg_antrian_before_update`
- ✅ Function: `fn_count_antrian_menunggu`

### 2. **Backend** ✅
- ✅ Model: `application/models/AntrianPoliModel.php`
- ✅ Controller: `application/controllers/AntrianController.php`
- ✅ Routes: Sudah ditambahkan di `application/config/routes.php`

### 3. **Frontend** ✅
- ✅ Dashboard Display: `application/views/antrian/dashboard_display.php`
- ✅ Panel Pemanggilan: Terintegrasi di `application/views/dokter/dokter_ralan.php`
- ✅ JavaScript Dashboard: `assets/js/antrianDashboard.js`
- ✅ JavaScript Panel: `assets/js/panelPemanggilan.js`
- ✅ CSS: `assets/css/antrian.css`

### 4. **Menu & Routes** ✅
- ✅ Routes sudah ditambahkan
- ✅ SQL untuk insert menu: `insert_menu_antrian.sql`

---

## 🚀 Cara Install

### Step 1: Tambahkan Menu ke Database

Jalankan SQL berikut di phpMyAdmin:

```sql
-- Insert Parent Menu
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Antrian', '#', 'fa-tv', NULL, 1, 50, 1, NOW(), NOW());

SET @parent_id = LAST_INSERT_ID();

-- Insert Submenu
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Semua Poli', 'antrian/dashboard', 'fa-desktop', @parent_id, 0, 1, 1, NOW(), NOW());

-- Berikan akses ke Admin
SET @menu_id = LAST_INSERT_ID();
INSERT INTO `user_access` (`role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`)
VALUES 
(1, @menu_id, 1, 0, 0, 0);
```

### Step 2: Integrasi dengan Registrasi Pasien

Tambahkan kode berikut di controller registrasi pasien (saat save registrasi):

```php
// Load model antrian
$this->load->model('AntrianPoliModel');

// Insert antrian setelah registrasi berhasil
$antrian_data = [
    'no_rawat' => $no_rawat,
    'no_reg' => $no_reg,
    'kd_poli' => $kd_poli,
    'kd_dokter' => $kd_dokter,
    'no_rkm_medis' => $no_rkm_medis,
    'tgl_registrasi' => date('Y-m-d H:i:s')
];

$this->AntrianPoliModel->insert_antrian($antrian_data);
```

### Step 3: Test Dashboard

1. **Buka Dashboard Display** (untuk TV/Monitor):
   ```
   http://localhost/moizhospitalapps/antrian/dashboard
   ```

2. **Buka Halaman Dokter Rawat Jalan**:
   ```
   http://localhost/moizhospitalapps/dokter/ralan
   ```
   - Panel pemanggilan akan muncul di atas tabel pasien

3. **Test Text-to-Speech**:
   - Klik tombol "Panggil" di panel pemanggilan
   - Suara akan keluar di dashboard display
   - Pastikan speaker/audio aktif

---

## 🎨 Fitur-Fitur

### 1. Dashboard Display (Layar TV/Monitor)
- ✅ Full-screen mode
- ✅ Real-time updates (auto-refresh setiap 3 detik)
- ✅ Tampilan nomor antrian yang sedang dipanggil
- ✅ Informasi pasien, dokter, dan poli
- ✅ Daftar antrian berikutnya
- ✅ **Text-to-Speech** otomatis saat ada panggilan baru
- ✅ Animasi smooth saat update
- ✅ Responsive design

### 2. Panel Pemanggilan (untuk Dokter)
- ✅ Terintegrasi di halaman rawat jalan dokter
- ✅ Daftar antrian pasien hari ini
- ✅ Tombol "Panggil" untuk memanggil pasien
- ✅ Tombol "Panggil Ulang" untuk repeat panggilan
- ✅ Status badge (Menunggu, Dipanggil, Sedang Diperiksa, Selesai)
- ✅ Auto-refresh setiap 5 detik
- ✅ Notifikasi sukses/error

### 3. API Endpoints
- ✅ `GET /antrian/api/get_data` - Get antrian data
- ✅ `GET /antrian/api/latest_call` - Get panggilan terbaru
- ✅ `POST /antrian/api/panggil` - Panggil pasien
- ✅ `POST /antrian/api/panggil_ulang` - Panggil ulang
- ✅ `POST /antrian/api/update_status` - Update status antrian
- ✅ `GET /antrian/api/statistik` - Get statistik antrian
- ✅ `GET /antrian/api/menunggu` - Get antrian menunggu
- ✅ `POST /antrian/api/reset` - Reset antrian (admin only)
- ✅ `GET /antrian/api/poli_list` - Get list poli dengan antrian

---

## 🔊 Text-to-Speech Configuration

File: `assets/js/responsivevoice.js` (sudah ada)

Format suara:
```javascript
"Nomor antrian [NO_ANTRIAN], 
atas nama [NAMA_PASIEN], 
silakan menuju [NAMA_POLI], 
dokter [NAMA_DOKTER]"
```

Contoh:
```
"Nomor antrian A-001, 
atas nama AHMAD TOHAR, 
silakan menuju POLI UMUM, 
dokter dr. Budi Santoso, Sp.PD"
```

Settings:
- Voice: "Indonesian Female"
- Pitch: 1
- Rate: 0.85
- Volume: 1

---

## 📱 Cara Penggunaan

### Untuk Dokter:

1. **Login** ke sistem
2. **Buka menu** "Rawat Jalan" → "Data Pasien Rawat Jalan"
3. **Lihat Panel Pemanggilan** di bagian atas
4. **Klik "Panggil"** untuk memanggil pasien
5. **Klik "Panggil Ulang"** jika pasien tidak datang
6. **Klik "Mulai Periksa"** saat pasien sudah datang
7. **Klik "Selesai"** setelah pemeriksaan selesai

### Untuk Display (TV/Monitor):

1. **Buka browser** di komputer yang terhubung ke TV
2. **Akses URL**: `http://[server]/moizhospitalapps/antrian/dashboard`
3. **Tekan F11** untuk full-screen mode
4. **Biarkan terbuka** - akan auto-update otomatis
5. **Pastikan audio aktif** untuk text-to-speech

### Untuk Display Per Poli:

Jika ingin display terpisah per poli:
```
http://[server]/moizhospitalapps/antrian/display/[KD_POLI]
```

Contoh:
```
http://localhost/moizhospitalapps/antrian/display/U0001
```

---

## 🔧 Troubleshooting

### 1. Suara tidak keluar?
- ✅ Pastikan browser support audio (Chrome/Firefox recommended)
- ✅ Cek volume speaker/komputer
- ✅ Pastikan file `responsivevoice.js` ter-load
- ✅ Buka console browser, cek error
- ✅ Test manual: buka console, ketik `testSpeak()`

### 2. Data tidak update?
- ✅ Cek koneksi internet
- ✅ Buka console browser, cek error AJAX
- ✅ Pastikan API endpoint bisa diakses
- ✅ Cek database connection

### 3. Panel pemanggilan tidak muncul?
- ✅ Pastikan sudah login sebagai dokter
- ✅ Cek session `kd_dokter` ada
- ✅ Clear cache browser
- ✅ Cek file `panelPemanggilan.js` ter-load

### 4. Menu tidak muncul di sidebar?
- ✅ Jalankan SQL insert menu
- ✅ Cek tabel `menu` dan `user_access`
- ✅ Logout dan login ulang
- ✅ Clear cache

---

## 🎯 Next Steps (Optional Enhancements)

1. **Mobile App** - Notifikasi push untuk pasien
2. **QR Code** - Scan untuk check-in antrian
3. **Estimasi Waktu** - Prediksi waktu tunggu
4. **Analytics Dashboard** - Statistik antrian
5. **Multi-language** - Support bahasa lain
6. **WebSocket** - Real-time tanpa polling
7. **Video Call** - Integrasi telemedicine

---

## 📞 Support

Jika ada pertanyaan atau issue:
1. Cek file `README_ANTRIAN.md` ini
2. Cek implementation plan di `.agent/workflows/dashboard-antrian-pasien.md`
3. Cek console browser untuk error
4. Cek log database untuk query error

---

## 🎉 Selamat!

Sistem Dashboard Antrian Pasien dengan Text-to-Speech sudah siap digunakan!

**Happy Coding! 🚀**

---

**Created by:** Ahmad Tohar  
**Date:** 2025-12-25  
**Version:** 1.0.0

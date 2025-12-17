# ✅ TESTING CHECKLIST - UNTUK POLI

## 🎯 Tujuan Testing
Testing optimasi di beberapa poli untuk memastikan:
- ✅ Semua fitur masih berfungsi normal
- ✅ Performa lebih cepat
- ✅ Tidak ada error atau bug baru

---

## 📋 TESTING CHECKLIST

### 🔐 1. LOGIN & AUTHENTICATION (5 MENIT)

**Test Cases:**
- [ ] Login sebagai **Admin** → Berhasil masuk dashboard
- [ ] Login sebagai **Dokter** → Berhasil masuk form dokter
- [ ] Login sebagai **Perawat** → Berhasil masuk dashboard perawat
- [ ] Logout → Berhasil kembali ke login page
- [ ] Login dengan password salah → Muncul error yang benar
- [ ] Session timeout → Auto logout setelah idle

**Expected:**
- Login lebih cepat (dari 2-3 detik → <1 detik)
- Tidak ada error

---

### 👤 2. REGISTRASI PASIEN (10 MENIT)

**Test Cases:**
- [ ] Registrasi pasien baru → Data tersimpan
- [ ] Search pasien by No. RM → Ketemu
- [ ] Search pasien by Nama → Ketemu
- [ ] Search pasien by No. KTP → Ketemu
- [ ] Update data pasien → Data ter-update
- [ ] Lihat list registrasi hari ini → Tampil semua

**Expected:**
- Search lebih cepat (dari 3-5 detik → <1 detik)
- List registrasi load lebih cepat

---

### 📝 3. SOAP (CRITICAL!) (15 MENIT)

**Test Cases:**
- [ ] Buka form SOAP → Load cepat
- [ ] Input SOAP baru → Tersimpan
- [ ] Edit SOAP (dalam 48 jam) → Berhasil di-update
- [ ] Delete SOAP (dalam 48 jam) → Berhasil dihapus
- [ ] Lihat riwayat SOAP pasien → Tampil semua
- [ ] Auto-fill TTV dari SOAP terakhir → Berfungsi
- [ ] Input SOAP dengan data lengkap → Semua field tersimpan

**Expected:**
- Load form SOAP: <2 detik
- Save SOAP: <1 detik
- Load riwayat SOAP: <2 detik

**PENTING:** ⚠️
- Pastikan semua data SOAP tersimpan lengkap
- Cek tidak ada data yang hilang
- Cek tanggal & jam tersimpan benar

---

### 🏥 4. ASESMEN MEDIS (15 MENIT)

**Test untuk masing-masing asesmen:**

#### A. Asesmen IGD
- [ ] Buka form asesmen IGD → Load cepat
- [ ] Input asesmen lengkap → Tersimpan
- [ ] Upload gambar lokalis → Berhasil
- [ ] Lihat asesmen di riwayat → Tampil lengkap
- [ ] Print asesmen → PDF generate

#### B. Asesmen Penyakit Dalam
- [ ] Buka form asesmen PD → Load cepat
- [ ] Input pemeriksaan fisik → Tersimpan
- [ ] Input sistem organ → Tersimpan
- [ ] Lihat di riwayat → Tampil lengkap

#### C. Asesmen Orthopedi
- [ ] Buka form asesmen Ortho → Load cepat
- [ ] Input pemeriksaan → Tersimpan
- [ ] Lihat di riwayat → Tampil lengkap

**Expected:**
- Load form: <2 detik
- Save asesmen: <1 detik
- Gambar lokalis tampil dengan benar

---

### 💊 5. DIAGNOSA & PROSEDUR (10 MENIT)

**Test Cases:**
- [ ] Input diagnosa utama → Tersimpan
- [ ] Input diagnosa sekunder → Tersimpan
- [ ] Search ICD-10 → Ketemu & cepat
- [ ] Input prosedur → Tersimpan
- [ ] Search ICD-9 → Ketemu & cepat
- [ ] Lihat list diagnosa pasien → Tampil semua
- [ ] Lihat list prosedur pasien → Tampil semua

**Expected:**
- Search ICD lebih cepat
- List load lebih cepat

---

### 💉 6. TINDAKAN (10 MENIT)

**Test Cases:**
- [ ] Input tindakan dokter → Tersimpan
- [ ] Input tindakan perawat → Tersimpan
- [ ] Search tindakan → Ketemu & cepat
- [ ] Lihat list tindakan pasien → Tampil semua
- [ ] Total biaya tindakan → Hitung benar

**Expected:**
- Search tindakan lebih cepat
- List load lebih cepat

---

### 💊 7. RESEP OBAT (15 MENIT)

**Test Cases:**
- [ ] Input resep obat biasa → Tersimpan
- [ ] Input resep racikan → Tersimpan
- [ ] Search obat → Ketemu & cepat
- [ ] Lihat list resep pasien → Tampil semua
- [ ] Print resep → PDF generate
- [ ] Cek stok obat → Tampil benar

**Expected:**
- Search obat lebih cepat
- List resep load lebih cepat

---

### 🔬 8. LABORATORIUM (15 MENIT)

**Test Cases:**
- [ ] Permintaan lab baru → Tersimpan
- [ ] Search template lab → Ketemu & cepat
- [ ] Pilih pemeriksaan lab → Berfungsi
- [ ] Input hasil lab → Tersimpan
- [ ] Lihat hasil lab di riwayat → Tampil lengkap
- [ ] Print hasil lab → PDF generate

**Expected:**
- Search template lebih cepat
- Load hasil lab lebih cepat

---

### 📷 9. RADIOLOGI (15 MENIT)

**Test Cases:**
- [ ] Permintaan radiologi baru → Tersimpan
- [ ] Search jenis radiologi → Ketemu & cepat
- [ ] Input hasil radiologi → Tersimpan
- [ ] Upload gambar radiologi → Berhasil
- [ ] Lihat hasil radiologi di riwayat → Tampil lengkap
- [ ] Gambar radiologi tampil → Benar
- [ ] Print hasil radiologi → PDF generate

**Expected:**
- Upload gambar lebih cepat
- Load gambar lebih cepat

---

### 📋 10. RIWAYAT PASIEN (CRITICAL!) (20 MENIT)

**Test Cases:**
- [ ] Buka riwayat pasien → Load cepat
- [ ] Lihat list kunjungan → Tampil semua
- [ ] Klik 1 kunjungan → Detail load cepat
- [ ] Tab SOAP → Tampil data lengkap
- [ ] Tab Diagnosa → Tampil data lengkap
- [ ] Tab Prosedur → Tampil data lengkap
- [ ] Tab Tindakan → Tampil data lengkap
- [ ] Tab Resep → Tampil data lengkap
- [ ] Tab Lab → Tampil data lengkap
- [ ] Tab Radiologi → Tampil data lengkap
- [ ] Tab Asesmen → Tampil data lengkap
- [ ] Tab Resume → Tampil data lengkap
- [ ] Gambar radiologi → Tampil benar
- [ ] Berkas digital → Tampil benar

**Expected:**
- Load riwayat: dari 8-10 detik → <3 detik ⚡
- Semua data tampil lengkap
- Tidak ada data yang hilang

**PENTING:** ⚠️
- Ini fitur PALING SERING dipakai dokter
- Pastikan SEMUA data tampil lengkap
- Cek tidak ada error di console

---

### 📄 11. RESUME MEDIS (10 MENIT)

**Test Cases:**
- [ ] Input resume medis → Tersimpan
- [ ] Lihat resume di riwayat → Tampil lengkap
- [ ] Print resume medis → PDF generate
- [ ] PDF tampil lengkap → Semua field ada
- [ ] Gambar radiologi di PDF → Tampil
- [ ] Digital signature → Berfungsi

**Expected:**
- Generate PDF lebih cepat
- PDF tampil lengkap

---

### 💰 12. BILLING & PEMBAYARAN (10 MENIT)

**Test Cases:**
- [ ] Lihat tagihan pasien → Tampil benar
- [ ] Total tagihan → Hitung benar
- [ ] Input pembayaran → Tersimpan
- [ ] Print invoice → PDF generate
- [ ] Lihat piutang pasien → Tampil benar

**Expected:**
- Load tagihan lebih cepat
- Perhitungan tetap akurat

---

### 🖨️ 13. PRINT & EXPORT (10 MENIT)

**Test Cases:**
- [ ] Print surat sakit → PDF generate
- [ ] Print surat rujukan → PDF generate
- [ ] Print resume medis → PDF generate
- [ ] Print hasil lab → PDF generate
- [ ] Print hasil radiologi → PDF generate
- [ ] Export laporan → Excel/PDF generate

**Expected:**
- Generate PDF lebih cepat
- Semua data tampil lengkap di PDF

---

## 🔍 MONITORING SELAMA TESTING

### A. Monitor Logs (WAJIB!)

```bash
# Buka terminal dan jalankan:
tail -f /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/logs/log-*.php
```

**Cari error:**
- ❌ `ERROR` - Critical errors
- ❌ `CRITICAL` - System failures
- ❌ `Fatal error` - PHP errors
- ❌ `Database error` - Query errors

### B. Monitor Performance

**Catat waktu:**
- Login: _____ detik (target: <1 detik)
- Load riwayat pasien: _____ detik (target: <3 detik)
- Search pasien: _____ detik (target: <1 detik)
- Save SOAP: _____ detik (target: <1 detik)

### C. Monitor User Feedback

**Tanya user:**
- [ ] Apakah terasa lebih cepat?
- [ ] Ada fitur yang error?
- [ ] Ada data yang hilang?
- [ ] Ada tampilan yang aneh?

---

## 📊 HASIL TESTING

### ✅ SUKSES jika:
- [ ] Semua fitur berfungsi normal
- [ ] Tidak ada error di logs
- [ ] Performa lebih cepat (minimal 30%)
- [ ] User feedback positif
- [ ] Tidak ada data yang hilang

### ❌ ROLLBACK jika:
- [ ] Ada fitur yang tidak berfungsi
- [ ] Banyak error di logs
- [ ] Data ada yang hilang
- [ ] User komplain banyak
- [ ] Performa malah lebih lambat

---

## 🔄 ROLLBACK PROCEDURE

Jika ada masalah SERIUS:

```bash
# 1. Restore database config
cp application/config/database.php.backup application/config/database.php

# 2. Restore CI config
cp application/config/config.php.backup application/config/config.php

# 3. Restart Apache
sudo apachectl restart

# 4. Clear cache
rm -rf application/cache/*

# 5. Test login
# Buka: http://127.0.0.1/moizhospitalapps/auth/login
```

---

## 📝 LAPORAN TESTING

Setelah testing, isi laporan:

**Tanggal Testing:** _______________
**Poli yang di-test:** _______________
**Jumlah user:** _______________
**Durasi testing:** _______________

**Hasil:**
- [ ] ✅ SUKSES - Bisa lanjut ke poli lain
- [ ] ⚠️ ADA ISSUE - Perlu perbaikan
- [ ] ❌ GAGAL - Perlu rollback

**Issue yang ditemukan:**
1. _______________
2. _______________
3. _______________

**Catatan:**
_______________________________________________
_______________________________________________

---

## 🎯 NEXT STEPS

### Jika SUKSES:
1. ✅ Deploy ke poli lain secara bertahap
2. ✅ Monitor 1-2 hari
3. ✅ Jika stabil, deploy ke semua poli

### Jika ADA ISSUE:
1. ⚠️ Catat semua issue
2. ⚠️ Fix issue
3. ⚠️ Test ulang

### Jika GAGAL:
1. ❌ Rollback immediately
2. ❌ Analisis masalah
3. ❌ Test di staging dulu

---

**Good luck testing bro! 🚀**

Kalau ada masalah, langsung rollback dan kabari saya!

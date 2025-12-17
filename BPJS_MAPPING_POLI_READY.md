# 🎉 BPJS VCLAIM MAPPING POLI - READY TO USE!

## ✅ STATUS: SIAP DIPAKAI!

Sistem mapping poli BPJS sudah berhasil di-setup dan terintegrasi dengan tabel Khanza existing!

---

## 📊 CURRENT STATUS

### **Database:**
- ✅ Config BPJS: **Tersimpan** (RSIA PETALA BUMI)
- ✅ Referensi Poli BPJS: **19 poli**
- ✅ Mapping Existing: **5 poli sudah di-mapping**
- ✅ Belum Mapping: **22 poli**

### **Progress Mapping:**
- Total Poli RS: **27 poli**
- Sudah Mapping: **5 poli** (18.5%)
- Belum Mapping: **22 poli** (81.5%)

---

## 🗂️ STRUKTUR FOLDER BPJS

```
moizhospitalapps/
├── application/
│   ├── controllers/
│   │   └── Bpjs/
│   │       └── MappingController.php ✅
│   │
│   ├── models/
│   │   └── Bpjs/
│   │       └── MappingModel.php ✅
│   │
│   ├── views/
│   │   └── bpjs/
│   │       └── mapping/
│   │           └── poli.php ✅
│   │
│   └── libraries/
│       └── Bpjs/
│           └── BpjsService.php ✅
│
└── database/
    └── bpjs/
        └── 01_setup_bpjs_config.sql ✅
```

---

## 🎯 CARA MENGGUNAKAN

### **1. Akses Menu Mapping Poli**

```
URL: http://127.0.0.1/moizhospitalapps/bpjs/mapping/poli
```

**Login sebagai Admin** (role_id = 1)

### **2. Interface Mapping**

**Tampilan:**
- **Kiri:** Poli RS yang belum di-mapping (22 poli)
- **Kanan:** Poli BPJS referensi (19 poli)
- **Tengah:** Tombol MAP
- **Bawah:** Tabel poli yang sudah di-mapping

**Cara Mapping:**
1. Klik poli di **sebelah kiri** (Poli RS)
2. Klik poli di **sebelah kanan** (Poli BPJS)
3. Klik tombol **MAP** di tengah
4. Konfirmasi → Done! ✅

### **3. Quick Actions**

**A. Sync Referensi dari BPJS**
- Klik: "Sync Referensi dari BPJS"
- Sistem akan download referensi poli terbaru dari BPJS API
- Update tabel `bpjs_ref_poli`

**B. Auto Mapping (Kode Sama)**
- Klik: "Auto Mapping (Kode Sama)"
- Sistem otomatis mapping poli yang kodenya sama
- Contoh: Poli RS "IGD" → BPJS "IGD"

---

## 📋 POLI YANG SUDAH DI-MAPPING

| Kode RS | Nama Poli RS | Kode BPJS | Nama Poli BPJS |
|---------|--------------|-----------|----------------|
| IGDK | IGD | IGD | INSTALASI GAWAT DARURAT |
| U0002 | Poliklinik Anak | ANA | ANAK |
| U0003 | Poliklinik Penyakit Dalam | INT | PENYAKIT DALAM |
| U0004 | Poliklinik Bedah | BED | BEDAH |
| U0005 | Poliklinik Mata | MAT | MATA |

---

## 📋 POLI YANG BELUM DI-MAPPING (22 POLI)

Berikut poli RS yang masih perlu di-mapping:

1. ANA - ANA Poli Anak tr
2. BDS - BEDAH SARAF
3. BSY - Bedah Syaraf
4. U0053 - fisioterapi
5. 1. - INT
6. INT - INT Poli Penyakit Dalam
7. U0027 - MCU
8. OBG - OBG Poli Obstetri/Gyn.
9. U0016 - ORTHOPEDI
10. U0052 - POLI GINJAL
11. U0044 - Poli Syaraf
12. U0050 - POLIKLINIK DINDA
13. U0010 - Poliklinik Gigi & Mulut
14. U0012 - Poliklinik Jantung
15. U0001 - Poliklinik Kandungan
16. U0006 - Poliklinik Kulit & Kelamin
17. U0008 - Poliklinik Radiologi
18. U0007 - Poliklinik Syaraf / Neurologi
19. U0011 - Poliklinik THT
20. U0009 - Poliklinik Umum
21. UMU - UMUM
22. U0026 - Unit Laborat

---

## 🎨 FITUR UI

### **Statistics Dashboard**
- Total Poli RS
- Sudah Mapping (hijau)
- Belum Mapping (kuning)
- Ref BPJS (biru)

### **Search Functionality**
- Search poli RS (kiri)
- Search poli BPJS (kanan)
- Real-time filtering

### **Mapped Table**
- DataTables dengan pagination
- Sort by column
- Search global
- Delete mapping

---

## 🔧 TECHNICAL DETAILS

### **Tabel Database:**

#### 1. **bpjs_config** (Config BPJS)
```sql
- kode_ppk: 0069R035
- nama_ppk: RSIA PETALA BUMI
- cons_id: 15174
- secret_key: Evyxzqk0clxv
- user_key: 3c09584918d4b1c6e75886b33519b2cc1
- base_url: https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev
- environment: development
```

#### 2. **bpjs_ref_poli** (Referensi Poli BPJS)
```sql
- kode: Kode poli BPJS (ANA, INT, OBG, dll)
- nama: Nama poli BPJS
```

#### 3. **maping_poli_bpjs** (Tabel Khanza - Mapping)
```sql
- kd_poli_rs: Kode poli di RS
- kd_poli_bpjs: Kode poli BPJS
- nm_poli_bpjs: Nama poli BPJS
```

#### 4. **bpjs_sync_log** (Log Sync)
```sql
- jenis_referensi: poli, diagnosa, prosedur, dll
- status: success/failed
- jumlah_data: Jumlah data yang di-sync
```

### **View:**
```sql
v_mapping_poli - View untuk lihat status mapping
```

---

## 🚀 NEXT STEPS

### **PRIORITAS 1: Selesaikan Mapping Poli** (Hari ini)
1. Buka: http://127.0.0.1/moizhospitalapps/bpjs/mapping/poli
2. Mapping 22 poli yang belum di-mapping
3. Estimasi: 15-30 menit

### **PRIORITAS 2: Test Sync dari BPJS** (Hari ini)
1. Klik "Sync Referensi dari BPJS"
2. Verify referensi poli ter-update
3. Check log di tabel `bpjs_sync_log`

### **PRIORITAS 3: Mapping Lainnya** (Minggu ini)
- Mapping Diagnosa (ICD-10)
- Mapping Prosedur (ICD-9)
- Mapping Dokter DPJP

---

## 📝 REKOMENDASI MAPPING

Berdasarkan nama poli, saya sarankan mapping seperti ini:

| Kode RS | Nama Poli RS | → | Kode BPJS | Nama BPJS |
|---------|--------------|---|-----------|-----------|
| U0001 | Poliklinik Kandungan | → | OBG | Kebidanan dan Penyakit Kandungan |
| U0006 | Poliklinik Kulit & Kelamin | → | KUL | Kulit dan Kelamin |
| U0007 | Poliklinik Syaraf / Neurologi | → | SAR | Saraf |
| U0010 | Poliklinik Gigi & Mulut | → | GIG | Gigi |
| U0011 | Poliklinik THT | → | THT | THT |
| U0012 | Poliklinik Jantung | → | JAN | Jantung |
| U0016 | ORTHOPEDI | → | ORT | Orthopedi |
| U0044 | Poli Syaraf | → | SAR | Saraf |
| U0052 | POLI GINJAL | → | INT | Penyakit Dalam |
| U0053 | fisioterapi | → | REH | Rehabilitasi Medik |
| U0008 | Poliklinik Radiologi | → | RAD | Radiologi |
| U0026 | Unit Laborat | → | PAT | Patologi Klinik |

**Sisanya (MCU, Umum, dll)** bisa di-mapping ke poli yang paling sesuai atau buat custom.

---

## 🔍 TROUBLESHOOTING

### **Problem: Menu tidak muncul**

**Solusi:**
1. Cek apakah user login sebagai **Admin** (role_id = 1)
2. Clear cache browser (Ctrl+Shift+R)

### **Problem: Error saat mapping**

**Solusi:**
1. Cek log: `application/logs/log-*.php`
2. Verify tabel `maping_poli_bpjs` exists
3. Cek koneksi database

### **Problem: Sync dari BPJS gagal**

**Solusi:**
1. Cek credential di tabel `bpjs_config`
2. Verify internet connection
3. Check BPJS API status (development/production)

---

## 📞 SUPPORT

Kalau ada masalah atau pertanyaan:
1. Cek file: `BPJS_VCLAIM_KATALOG_REFERENSI.md`
2. Cek log: `application/logs/`
3. Cek database: `bpjs_sync_log`

---

## ✅ CHECKLIST IMPLEMENTASI

- [x] Database schema created
- [x] BPJS config saved
- [x] Referensi poli loaded
- [x] Controller created
- [x] Model created
- [x] View created
- [x] Library created
- [ ] Mapping poli completed (18.5% done)
- [ ] Test sync dari BPJS
- [ ] Test create SEP

---

**🎉 SELAMAT! Sistem BPJS Mapping Poli sudah siap dipakai!**

**Next:** Lanjut mapping poli yang belum, atau mau lanjut ke mapping diagnosa/prosedur?

Let me know bro! 💪

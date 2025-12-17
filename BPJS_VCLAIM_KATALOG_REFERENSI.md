# 📚 DAFTAR KATALOG REFERENSI BPJS VCLAIM

## 🎯 REFERENSI YANG PERLU DI-MAPPING

### 1. **DIAGNOSA (ICD-10)** ⭐ CRITICAL
- **Endpoint:** `/referensi/diagnosa/{kode}`
- **Kegunaan:** Mapping diagnosa RS ke kode ICD-10 BPJS
- **Contoh:** `A00.0` = Cholera due to Vibrio cholerae
- **Tabel RS:** `penyakit` (kd_penyakit, nm_penyakit)
- **Tabel BPJS:** `bpjs_ref_diagnosa` (kode, nama)

### 2. **PROSEDUR (ICD-9-CM)** ⭐ CRITICAL
- **Endpoint:** `/referensi/prosedur/{kode}`
- **Kegunaan:** Mapping prosedur/tindakan RS ke kode ICD-9
- **Contoh:** `00.01` = Therapeutic ultrasound
- **Tabel RS:** `icd9` (kode, deskripsi_panjang)
- **Tabel BPJS:** `bpjs_ref_prosedur` (kode, nama)

### 3. **POLI/SPESIALIS** ⭐ CRITICAL
- **Endpoint:** `/referensi/poli`
- **Kegunaan:** Mapping poliklinik RS ke kode poli BPJS
- **Contoh:** `INT` = Poli Penyakit Dalam
- **Tabel RS:** `poliklinik` (kd_poli, nm_poli)
- **Tabel BPJS:** `bpjs_ref_poli` (kode, nama)

### 4. **DOKTER DPJP** ⭐ CRITICAL
- **Endpoint:** `/referensi/dokter/{jenis}/{kode}`
- **Kegunaan:** Mapping dokter RS ke kode dokter BPJS
- **Jenis:** 1=DPJP, 2=Dokter Umum
- **Tabel RS:** `dokter` (kd_dokter, nm_dokter)
- **Tabel BPJS:** `bpjs_ref_dokter` (kode_dokter, nama_dokter)

### 5. **CARA KELUAR/PULANG** ⭐ IMPORTANT
- **Endpoint:** `/referensi/carakeluar`
- **Kegunaan:** Status pulang pasien
- **Contoh:**
  - `1` = Atas Persetujuan Dokter
  - `3` = Atas Permintaan Sendiri
  - `4` = Meninggal

---

## 🎯 MAPPING PRIORITY

### **PHASE 1: CRITICAL** ⭐⭐⭐
1. Diagnosa (ICD-10)
2. Prosedur (ICD-9)
3. Poli/Spesialis
4. Dokter DPJP
5. Cara Keluar

### **PHASE 2: IMPORTANT** ⭐⭐
6. Faskes (PPK)
7. Propinsi
8. Kabupaten
9. Kelas Rawat

---

**Saya akan buatkan sistem mapping lengkap untuk semua ini!** 🚀

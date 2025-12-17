# MOIZ Hospital Apps - Update Log

## Update: 2025-12-17

### 🎉 New Features

#### 1. **Program Rehab Medik (Rehabilitasi Medik)**
- ✅ Form SOAP (Subjective, Objective, Assessment, Plan/Procedure)
- ✅ Tanda-Tanda Vital (TTV): Tensi, Nadi, Suhu, RR, SpO2, Tinggi, Berat, GCS
- ✅ Instruksi untuk pasien
- ✅ Evaluasi hasil terapi
- ✅ Dual table save: SOAP fields ke `moizhospital_program_rehabmedik`, TTV/Instruksi/Evaluasi ke `pemeriksaan_ralan`
- ✅ History list dengan tampilan lengkap
- ✅ Print report functionality

#### 2. **Formulir KFR (Kedokteran Fisik dan Rehabilitasi)**
- ✅ Auto-populate S, O, A, P dari Program Rehab Medik terakhir
- ✅ Digital Signature Pad untuk tanda tangan dokter
  - Mouse & touch support
  - Save signature as base64
  - Display in print PDF
- ✅ Form lengkap: Goal of Treatment, Tindakan/Program Rehab, Edukasi, Frekuensi Kunjungan, Rencana Tindak Lanjut
- ✅ Print report dengan signature

#### 3. **Bug Fixes & Improvements**
- ✅ Fixed login issue for non-admin users (Perawat, role_id = 4)
- ✅ Fixed access control for "Rawat Jalan" menu (all roles can access, doctors see filtered data)
- ✅ Fixed duplicate print output issue
- ✅ Removed unnecessary fields from print reports
- ✅ Improved DataTables initialization to prevent re-initialization errors

### 📦 Database Changes

Run this SQL migration:
```sql
ALTER TABLE `moizhospital_lembarKFR_rehabmedik` 
ADD COLUMN `ttd_dokter` LONGTEXT NULL COMMENT 'Base64 encoded doctor signature' 
AFTER `rencana_tindak_lanjut`;
```

### 📁 New Files Added

**Controllers:**
- `application/controllers/RehabMedikRalanController.php`
- `application/controllers/FormulirKfrRalanController.php`
- `application/controllers/CheckRmeMenu.php`
- `application/controllers/FixRehabMenu.php`
- `application/controllers/FixRehabMenuRalan.php`
- `application/controllers/MigrateFormulirKfr.php`
- `application/controllers/MigrateRehab.php`

**Models:**
- `application/models/RehabMedikModel.php`
- `application/models/FormulirKfrModel.php`

**Views:**
- `application/views/rehab_medik/form.php`
- `application/views/rehab_medik/cetak.php`
- `application/views/formulir_kfr/form.php`
- `application/views/formulir_kfr/cetak.php`

**JavaScript:**
- `assets/js/rehab_medik.js`
- `assets/js/formulir_kfr.js`

**Migrations:**
- `database/migrations/add_ttd_dokter_to_formulir_kfr.sql`
- `database/migrations/2025-12-17_rehab_medik_and_kfr_features.sql`

### 📝 Modified Files

**Controllers:**
- `Auth.php` - Fixed role-based redirect
- `AdminController.php` - Removed strict role check
- `DokterRalanController.php` - Updated access control
- `RiwayatPasienController.php` - Added KFR & Rehab data endpoints
- `Perawat/SoapPerawatController.php` - Fixed NIP validation

**Models:**
- `AuthModel.php` - Relaxed Perawat validation
- `RiwayatPasien_model.php` - Added get methods for KFR & Rehab

**Views:**
- `templates/footer.php` - Fixed DataTables initialization
- `rekammedis/soap_ralan.php` - Disabled DataTables for complex table
- `rekammedis/riwayatPasien_form.php` - Added API endpoints

**JavaScript:**
- `assets/js/riwayatPasien.js` - Added KFR & Rehab rendering, fixed print duplicate

### 🚀 How to Use

#### Program Rehab Medik:
1. Navigate to "Rawat Jalan" → Select patient
2. Click "Program Rehab Medik" tab
3. Fill SOAP + TTV + Instruksi + Evaluasi
4. Click "Simpan Data"
5. View history and print reports

#### Formulir KFR:
1. Navigate to "Rawat Jalan" → Select patient
2. Click "Formulir KFR" tab
3. **S, O, A, P auto-populated** from latest Program Rehab Medik
4. Fill additional fields (Goal, Edukasi, etc.)
5. **Sign in signature pad** (mouse or touch)
6. Click "Simpan Data"
7. Print report will include signature

### 👨‍💻 Developer Notes

- Signature pad uses HTML5 Canvas API (no external library)
- Base64 signature stored in LONGTEXT column
- Auto-populate uses latest SOAP by `tgl_perawatan DESC, jam_rawat DESC`
- Print guard mechanism prevents duplicate print dialogs
- Transaction-based dual table save ensures data consistency

### 📊 Statistics

- **36 files changed**
- **3,373 insertions**
- **197 deletions**

---

**Developed by:** Ahmad Tohar  
**Date:** December 17, 2025  
**Version:** 1.5.0

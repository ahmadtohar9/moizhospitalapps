---
description: Implementation Plan - Dashboard Antrian Pasien Rawat Jalan dengan Text-to-Speech
---

# 🎯 Dashboard Antrian Pasien Rawat Jalan dengan Text-to-Speech

## 📋 Overview
Membuat sistem antrian pasien rawat jalan yang terdiri dari:
1. **Dashboard Display** - Layar tunggu untuk pasien (bisa multiple display per poli)
2. **Panel Pemanggilan** - Interface untuk dokter memanggil pasien dari menu rawat jalan
3. **Text-to-Speech** - Menggunakan ResponsiveVoice.js untuk memanggil nama pasien

## 🏗️ Struktur Fitur

### A. Database Schema
Buat tabel baru untuk tracking antrian dan panggilan:

```sql
CREATE TABLE IF NOT EXISTS `antrian_panggilan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rawat` varchar(17) NOT NULL,
  `no_reg` varchar(10) DEFAULT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `tgl_panggil` datetime DEFAULT NULL,
  `status_panggil` enum('Menunggu','Dipanggil','Selesai','Batal') DEFAULT 'Menunggu',
  `dipanggil_oleh` varchar(20) DEFAULT NULL,
  `jumlah_panggil` int(11) DEFAULT 0,
  `terakhir_panggil` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_rawat` (`no_rawat`),
  KEY `status_panggil` (`status_panggil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### B. Backend Components

#### 1. Model: `AntrianPanggilanModel.php`
**Location:** `/application/models/AntrianPanggilanModel.php`

**Methods:**
- `get_antrian_by_poli($kd_poli, $tgl = null)` - Ambil daftar antrian per poli
- `get_antrian_by_dokter($kd_dokter, $tgl = null)` - Ambil daftar antrian per dokter
- `get_all_antrian_today()` - Ambil semua antrian hari ini
- `panggil_pasien($no_rawat, $kd_dokter)` - Update status panggilan
- `get_latest_panggilan($limit = 10)` - Ambil panggilan terbaru untuk display
- `reset_antrian($no_rawat)` - Reset status ke menunggu
- `get_nomor_antrian($no_rawat)` - Generate nomor antrian otomatis

#### 2. Controller: `AntrianController.php`
**Location:** `/application/controllers/AntrianController.php`

**Methods:**
- `index()` - Dashboard display (public, untuk TV/monitor)
- `display_poli($kd_poli)` - Dashboard per poli spesifik
- `panel_pemanggilan()` - Panel untuk dokter (di menu rawat jalan)
- `get_antrian_data()` - API endpoint untuk real-time data
- `panggil_pasien()` - API endpoint untuk memanggil pasien
- `panggil_ulang()` - API endpoint untuk panggil ulang
- `get_latest_call()` - API endpoint untuk display dashboard

#### 3. Update: `DokterRalanController.php`
**Location:** `/application/controllers/DokterRalanController.php`

**Tambahkan:**
- Integrasi dengan sistem antrian
- Auto-generate nomor antrian saat registrasi
- Update status antrian saat pasien selesai diperiksa

### C. Frontend Components

#### 1. Dashboard Display (untuk TV/Monitor)
**File:** `/application/views/antrian/dashboard_display.php`

**Features:**
- Full-screen display
- Auto-refresh setiap 3 detik
- Tampilkan:
  - Nomor antrian yang sedang dipanggil
  - Nama pasien
  - Dokter yang memanggil
  - Poli tujuan
  - Daftar antrian berikutnya
- Text-to-Speech saat ada panggilan baru
- Responsive design (landscape untuk TV)

**Layout:**
```
┌─────────────────────────────────────────────┐
│  RSIA ANDINI - ANTRIAN RAWAT JALAN          │
├─────────────────────────────────────────────┤
│                                             │
│  SEDANG DIPANGGIL:                          │
│  ┌───────────────────────────────────────┐  │
│  │  No. Antrian: A-001                   │  │
│  │  Nama: AHMAD TOHAR                    │  │
│  │  Dokter: dr. Budi Santoso, Sp.PD     │  │
│  │  Poli: POLI UMUM                      │  │
│  └───────────────────────────────────────┘  │
│                                             │
│  ANTRIAN BERIKUTNYA:                        │
│  ┌─────┬──────────────┬─────────────────┐  │
│  │ A-2 │ SITI AMINAH  │ dr. Budi        │  │
│  │ A-3 │ JOKO SUSILO  │ dr. Budi        │  │
│  │ B-1 │ RINA WATI    │ dr. Susi, Sp.A  │  │
│  └─────┴──────────────┴─────────────────┘  │
└─────────────────────────────────────────────┘
```

#### 2. Panel Pemanggilan (untuk Dokter)
**File:** `/application/views/antrian/panel_pemanggilan.php`

**Features:**
- Embedded di halaman rawat jalan dokter
- Daftar pasien hari ini yang belum dipanggil
- Tombol "Panggil" dan "Panggil Ulang"
- Badge untuk status antrian
- Real-time update

**UI Components:**
```html
<div class="panel-antrian">
  <h4>🔔 Panel Pemanggilan Pasien</h4>
  <table>
    <tr>
      <td>No. Antrian</td>
      <td>Nama Pasien</td>
      <td>Status</td>
      <td>Aksi</td>
    </tr>
    <tr>
      <td>A-001</td>
      <td>AHMAD TOHAR</td>
      <td><badge>Menunggu</badge></td>
      <td>
        <button class="btn-panggil">🔊 Panggil</button>
      </td>
    </tr>
  </table>
</div>
```

#### 3. JavaScript Files

**a) `/assets/js/antrianDashboard.js`**
- Handle real-time updates untuk dashboard display
- Integrasi ResponsiveVoice.js
- Auto-refresh data
- Animasi saat ada panggilan baru

**b) `/assets/js/panelPemanggilan.js`**
- Handle tombol panggil/panggil ulang
- AJAX calls ke backend
- Update UI real-time
- Notifikasi sukses/error

#### 4. CSS Styling
**File:** `/assets/css/antrian.css`

- Modern, clean design
- Full-screen mode untuk dashboard
- Animasi smooth untuk panggilan baru
- Responsive layout
- Color coding untuk status

### D. Integration Points

#### 1. Menu Sidebar
**Update:** `/application/views/templates/menu.php`

Tambahkan menu baru via database:
- **Dashboard Antrian** (Parent Menu)
  - Semua Poli (child)
  - Per Poli (dynamic, child)

#### 2. Rawat Jalan Dokter
**Update:** `/application/views/dokter/dokter_ralan.php`

Tambahkan panel pemanggilan di atas tabel pasien.

#### 3. ResponsiveVoice Integration
**File:** `/assets/js/responsivevoice.js` (sudah ada)

**Usage:**
```javascript
function panggilPasien(data) {
  const text = `Nomor antrian ${data.no_antrian}, 
                atas nama ${data.nama_pasien}, 
                silakan menuju ${data.nm_poli}, 
                dokter ${data.nm_dokter}`;
  
  responsiveVoice.speak(text, "Indonesian Female", {
    pitch: 1,
    rate: 0.9,
    volume: 1
  });
}
```

## 🔄 Workflow

### 1. Registrasi Pasien
```
Pasien Registrasi → Auto-generate No. Antrian → 
Insert ke antrian_panggilan (status: Menunggu) → 
Tampil di Dashboard Display
```

### 2. Dokter Memanggil Pasien
```
Dokter klik "Panggil" → Update status (Dipanggil) → 
Broadcast ke Dashboard → Text-to-Speech aktif → 
Display update dengan animasi
```

### 3. Panggil Ulang
```
Dokter klik "Panggil Ulang" → Increment jumlah_panggil → 
Update terakhir_panggil → Broadcast ulang → 
Text-to-Speech aktif lagi
```

### 4. Selesai Periksa
```
Dokter selesai input data → Update status (Selesai) → 
Hilang dari daftar antrian → 
Dashboard update otomatis
```

## 📱 Features Detail

### Real-time Updates
- Menggunakan AJAX polling setiap 3 detik
- Atau bisa upgrade ke WebSocket/Server-Sent Events untuk lebih efisien

### Text-to-Speech
- Bahasa Indonesia
- Volume, pitch, rate bisa di-customize
- Auto-play saat ada panggilan baru
- Repeat untuk panggil ulang

### Multi-Display Support
- Dashboard bisa dibuka di multiple browser/device
- Filter per poli untuk display terpisah
- Sinkronisasi real-time

### Accessibility
- Large fonts untuk visibility
- Color-coded status
- Audio feedback
- High contrast mode

## 🎨 Design Principles

1. **Clean & Modern** - Minimalist design, fokus pada informasi penting
2. **High Visibility** - Font besar, kontras tinggi untuk dibaca dari jauh
3. **Smooth Animations** - Transisi halus saat update data
4. **Professional** - Sesuai dengan standar rumah sakit
5. **User-Friendly** - Mudah digunakan oleh dokter dan staf

## 🚀 Implementation Steps

### Phase 1: Database & Backend (Day 1)
1. Create database table `antrian_panggilan`
2. Create `AntrianPanggilanModel.php`
3. Create `AntrianController.php`
4. Update `DokterRalanController.php`

### Phase 2: Dashboard Display (Day 2)
1. Create dashboard view
2. Create `antrianDashboard.js`
3. Integrate ResponsiveVoice.js
4. Create `antrian.css`
5. Test text-to-speech

### Phase 3: Panel Pemanggilan (Day 3)
1. Create panel view
2. Integrate to dokter_ralan.php
3. Create `panelPemanggilan.js`
4. Test AJAX calls
5. Test real-time updates

### Phase 4: Menu Integration (Day 4)
1. Add menu to database
2. Test menu access
3. Create routes
4. Test navigation

### Phase 5: Testing & Polish (Day 5)
1. End-to-end testing
2. Multi-device testing
3. Performance optimization
4. Bug fixes
5. Documentation

## 📝 Notes

- Pastikan ResponsiveVoice.js sudah ter-load dengan benar
- Test audio di berbagai browser (Chrome, Firefox, Safari)
- Pertimbangkan fallback jika browser tidak support audio
- Buat setting untuk enable/disable suara
- Tambahkan volume control di dashboard
- Log semua panggilan untuk audit trail

## 🔐 Security Considerations

- Panel pemanggilan hanya bisa diakses oleh dokter yang bersangkutan
- Dashboard display bisa public (read-only)
- Validate semua input dari user
- Sanitize data sebelum text-to-speech
- Rate limiting untuk prevent spam panggilan

## 📊 Future Enhancements

1. **Mobile App** - Notifikasi push untuk pasien
2. **QR Code** - Scan untuk check-in antrian
3. **Estimasi Waktu** - Prediksi waktu tunggu
4. **Analytics** - Dashboard untuk analisa antrian
5. **Multi-language** - Support bahasa lain
6. **Video Call** - Integrasi telemedicine

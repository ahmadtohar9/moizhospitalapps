# SISTEM PRINT FINAL - SIMRS MOIZ ANDINI

## 📌 Overview

Sistem print final yang profesional, konsisten, dan siap produksi untuk SIMRS. Sistem ini dirancang untuk:
- ✅ Rapi dan konsisten di semua browser
- ✅ Tidak tergantung skala browser (100%)
- ✅ Aman untuk cetak PDF & cetak fisik
- ✅ 1 kunjungan = 1 halaman A4
- ✅ Header RS dan identitas pasien global
- ✅ Reusable untuk semua modul

## 📁 Struktur Folder

```
application/
├── config/
│   └── hospital.php              # Config data RS (GLOBAL)
├── controllers/
│   └── PrintController.php       # Controller khusus print
├── views/
│   └── print/
│       ├── print_layout.php      # Layout global
│       ├── print_final.css       # CSS print global
│       └── sections/             # Section-section konten
│           ├── soap.php
│           ├── diagnosa.php
│           ├── prosedur.php
│           ├── tindakan.php
│           ├── lab.php
│           └── radiologi.php
```

## 🚀 Cara Implementasi

### 1. Setup Config Hospital

Edit file `application/config/hospital.php` dan sesuaikan dengan data RS Anda:

```php
$config['hospital'] = array(
    'nama_rs'    => 'RSIA MOIZ ANDINI',
    'alamat'     => 'Jl. Raya Serang KM 16,5 Cikupa - Tangerang',
    'telepon'    => '(021) 5960 5555',
    // ... dst
);
```

### 2. Tambahkan Tombol Cetak di View

Contoh di `riwayatPasien.js` atau view lainnya:

```javascript
// JANGAN ubah logic yang ada
// Cukup tambahkan tombol baru

function renderCetakButton(noRawat) {
    return `
        <button class="btn btn-primary" onclick="cetakPDF('${noRawat}')">
            <i class="fas fa-print"></i> Cetak PDF
        </button>
    `;
}

function cetakPDF(noRawat) {
    // Buka window baru ke endpoint print
    const url = baseUrl + 'print/riwayat_pasien/' + encodeURIComponent(noRawat);
    window.open(url, '_blank');
}
```

### 3. Buat Method di Model (Jika Belum Ada)

Contoh di `RiwayatPasien_model.php`:

```php
public function get_visit_by_norawat($no_rawat) {
    $this->db->select('
        rp.no_rawat,
        rp.no_rkm_medis,
        rp.tgl_registrasi,
        rp.status_lanjut,
        p.nm_poli,
        d.nm_dokter,
        pj.png_jawab
    ');
    $this->db->from('reg_periksa rp');
    $this->db->join('poliklinik p', 'rp.kd_poli = p.kd_poli', 'left');
    $this->db->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'left');
    $this->db->join('penjab pj', 'rp.kd_pj = pj.kd_pj', 'left');
    $this->db->where('rp.no_rawat', $no_rawat);
    
    return $this->db->get()->row_array();
}

public function get_soap_by_norawat($no_rawat) {
    // Query SOAP dari tabel pemeriksaan_ralan atau sejenisnya
    $this->db->where('no_rawat', $no_rawat);
    $soap = $this->db->get('pemeriksaan_ralan')->row_array();
    
    if (empty($soap)) {
        return null;
    }
    
    // Format data SOAP
    return array(
        'keluhan'     => $soap['keluhan'],
        'pemeriksaan' => $soap['pemeriksaan'],
        'penilaian'   => $soap['penilaian'],
        'rtl'         => $soap['rtl'],
        'instruksi'   => $soap['instruksi'],
        'vital_signs' => array(
            'suhu'      => $soap['suhu_tubuh'],
            'tensi'     => $soap['tensi'],
            'nadi'      => $soap['nadi'],
            'respirasi' => $soap['respirasi'],
            'tinggi'    => $soap['tinggi'],
            'berat'     => $soap['berat'],
            'spo2'      => $soap['spo2'],
            'gcs'       => $soap['gcs'],
        )
    );
}

public function get_diagnosa_by_norawat($no_rawat) {
    $this->db->select('
        dp.kd_penyakit,
        p.nm_penyakit,
        dp.status,
        dp.prioritas
    ');
    $this->db->from('diagnosa_pasien dp');
    $this->db->join('penyakit p', 'dp.kd_penyakit = p.kd_penyakit', 'left');
    $this->db->where('dp.no_rawat', $no_rawat);
    $this->db->order_by('dp.prioritas', 'ASC');
    
    return $this->db->get()->result_array();
}

// ... dst untuk prosedur, tindakan, lab, radiologi
```

### 4. Implementasi di Controller

Sudah tersedia di `PrintController.php`. Tinggal sesuaikan dengan kebutuhan:

```php
public function riwayat_pasien($no_rawat = null) {
    // 1. Validasi
    // 2. Ambil data
    // 3. Siapkan sections
    // 4. Load view
}
```

## 🎨 CSS Print - Prinsip Utama

### ✅ DO (Yang Harus Dilakukan)

1. **Gunakan @page untuk ukuran A4**
   ```css
   @page {
       size: A4 portrait;
       margin: 10mm 15mm 10mm 15mm;
   }
   ```

2. **Gunakan page-break-inside: avoid**
   ```css
   .print-section {
       page-break-inside: avoid;
   }
   ```

3. **Font medis standar**
   ```css
   body {
       font-family: 'Times New Roman', Times, serif;
       font-size: 11pt;
   }
   ```

4. **Ukuran dalam mm atau pt**
   ```css
   .header {
       padding: 8mm 0;
       margin-bottom: 5mm;
   }
   ```

### ❌ DON'T (Yang Harus Dihindari)

1. **JANGAN gunakan transform: scale**
   ```css
   /* SALAH - JANGAN PAKAI INI */
   body {
       transform: scale(0.8);
   }
   ```

2. **JANGAN gunakan zoom**
   ```css
   /* SALAH - JANGAN PAKAI INI */
   body {
       zoom: 80%;
   }
   ```

3. **JANGAN gunakan px untuk ukuran print**
   ```css
   /* KURANG BAIK */
   .section {
       margin-bottom: 20px; /* Gunakan mm */
   }
   ```

4. **JANGAN biarkan section terpotong**
   ```css
   /* WAJIB tambahkan ini */
   .print-section {
       page-break-inside: avoid;
   }
   ```

## 🔧 Best Practices

### 1. Mencegah Halaman Kosong

```css
/* Hindari margin/padding berlebihan di akhir halaman */
.print-section:last-child {
    margin-bottom: 0;
}

/* Gunakan page-break-inside: avoid */
.print-section {
    page-break-inside: avoid;
}
```

### 2. Mencegah Konten Terpotong

```css
/* Untuk tabel */
table {
    page-break-inside: avoid;
}

/* Untuk heading */
h1, h2, h3, h4, h5, h6 {
    page-break-after: avoid;
    page-break-inside: avoid;
}

/* Untuk gambar */
img {
    page-break-inside: avoid;
    max-width: 100%;
    height: auto;
}
```

### 3. Orphans & Widows

```css
/* Hindari baris yatim piatu */
p {
    orphans: 3;  /* Min 3 baris di akhir halaman */
    widows: 3;   /* Min 3 baris di awal halaman */
}
```

### 4. Background Color untuk Print

```css
/* Paksa print background */
* {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    color-adjust: exact !important;
}
```

### 5. Ukuran Gambar Radiologi

```css
.print-image {
    max-width: 100%;
    max-height: 150mm; /* Jangan lebih dari tinggi A4 */
    height: auto;
    page-break-inside: avoid;
}
```

## 📝 Contoh Penggunaan

### Cetak Riwayat Pasien

```php
// Di controller lain (misal RiwayatPasienController)
public function index() {
    // ... existing code ...
}

// Tombol cetak di view akan memanggil:
// window.open('<?= base_url('print/riwayat_pasien/') ?>' + noRawat, '_blank');
```

### Cetak Resume Medis

```php
// Di PrintController
public function resume_medis($no_rawat) {
    // Ambil data resume
    $resume = $this->ResumeMedis_model->get_by_norawat($no_rawat);
    
    // Siapkan sections
    $sections = array(
        array('file' => 'resume_medis.php', 'data' => array('resume' => $resume))
    );
    
    // Load view
    $this->load->view('print/print_layout', array(
        'patient' => $patient,
        'visit' => $visit,
        'sections' => $sections,
        'document_title' => 'RESUME MEDIS PASIEN'
    ));
}
```

## 🐛 Troubleshooting

### Masalah: Halaman Kosong Muncul

**Solusi:**
1. Cek apakah ada section dengan height terlalu besar
2. Pastikan semua section menggunakan `page-break-inside: avoid`
3. Kurangi margin/padding di akhir section
4. Cek apakah ada element dengan `display: none` yang masih memakan space

### Masalah: Konten Terpotong

**Solusi:**
1. Pastikan tidak ada `overflow: hidden` di parent
2. Gunakan `page-break-inside: avoid` di section
3. Untuk tabel panjang, pertimbangkan split manual atau gunakan `page-break-before`
4. Cek margin @page tidak terlalu kecil

### Masalah: Font Tidak Konsisten

**Solusi:**
1. Pastikan font-family di-set di body
2. Hindari font custom yang tidak tersedia di printer
3. Gunakan font standar: Times New Roman, Arial, atau Courier

### Masalah: Gambar Tidak Muncul

**Solusi:**
1. Cek path gambar (gunakan absolute path atau base_url)
2. Pastikan gambar tidak terlalu besar (compress jika perlu)
3. Gunakan format gambar yang didukung (JPG, PNG)
4. Cek permission file gambar

## 📊 Checklist Sebelum Produksi

- [ ] Config hospital sudah diisi dengan benar
- [ ] Logo RS sudah di-upload dan path benar
- [ ] Semua section sudah dibuat dan ditest
- [ ] Print preview di Chrome/Firefox/Safari sudah OK
- [ ] Cetak PDF sudah ditest dan hasilnya rapi
- [ ] Cetak fisik sudah ditest di printer
- [ ] Tidak ada halaman kosong
- [ ] Tidak ada konten terpotong
- [ ] Font konsisten dan mudah dibaca
- [ ] Tanda tangan dan footer sudah sesuai
- [ ] Data RS dan pasien sudah benar semua

## 🎯 Keunggulan Sistem Ini

1. **Server-Side Rendering**: Tidak mengandalkan browser print
2. **Konsisten**: Hasil sama di semua browser dan printer
3. **Modular**: Section bisa dipakai ulang untuk modul lain
4. **Maintainable**: Mudah diupdate dan dikembangkan
5. **Production-Ready**: Siap untuk audit dan akreditasi
6. **No Scale/Zoom**: Menggunakan ukuran fisik A4 yang benar
7. **Professional**: Layout seperti dokumen medis resmi

## 📞 Support

Jika ada masalah atau pertanyaan, silakan hubungi tim development.

---

**Dibuat:** 2025-12-18  
**Versi:** 1.0.0  
**Status:** Production Ready  
**Untuk:** SIMRS MOIZ ANDINI

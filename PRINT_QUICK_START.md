# QUICK START - Implementasi Print Final

## 🚀 Langkah-Langkah Implementasi

### STEP 1: Konfigurasi Data Rumah Sakit (5 menit)

1. Buka file `application/config/hospital.php`
2. Edit data sesuai dengan RS Anda:

```php
$config['hospital'] = array(
    'nama_rs'    => 'RSIA MOIZ ANDINI',  // ← UBAH INI
    'alamat'     => 'Jl. ...',            // ← UBAH INI
    'telepon'    => '(021) ...',          // ← UBAH INI
    'email'      => 'info@...',           // ← UBAH INI
    // ... dst
);
```

3. Upload logo RS ke `assets/images/logo-rs.png`
4. Sesuaikan path logo di config jika berbeda

---

### STEP 2: Tambahkan Method di Model (15 menit)

Buka `application/models/RiwayatPasien_model.php` dan tambahkan method berikut:

```php
/**
 * Ambil data kunjungan berdasarkan no_rawat
 */
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

/**
 * Ambil data SOAP berdasarkan no_rawat
 */
public function get_soap_by_norawat($no_rawat) {
    // SESUAIKAN dengan nama tabel SOAP di database Anda
    $this->db->where('no_rawat', $no_rawat);
    $soap = $this->db->get('pemeriksaan_ralan')->row_array();
    
    if (empty($soap)) {
        return null;
    }
    
    return array(
        'keluhan'     => $soap['keluhan'] ?? '',
        'pemeriksaan' => $soap['pemeriksaan'] ?? '',
        'penilaian'   => $soap['penilaian'] ?? '',
        'rtl'         => $soap['rtl'] ?? '',
        'instruksi'   => $soap['instruksi'] ?? '',
        'vital_signs' => array(
            'suhu'      => $soap['suhu_tubuh'] ?? '',
            'tensi'     => $soap['tensi'] ?? '',
            'nadi'      => $soap['nadi'] ?? '',
            'respirasi' => $soap['respirasi'] ?? '',
            'tinggi'    => $soap['tinggi'] ?? '',
            'berat'     => $soap['berat'] ?? '',
            'spo2'      => $soap['spo2'] ?? '',
            'gcs'       => $soap['gcs'] ?? '',
        )
    );
}

/**
 * Ambil data diagnosa berdasarkan no_rawat
 */
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

/**
 * Ambil data prosedur berdasarkan no_rawat
 */
public function get_prosedur_by_norawat($no_rawat) {
    $this->db->select('
        pp.kode,
        icd.deskripsi_panjang,
        pp.status,
        pp.prioritas
    ');
    $this->db->from('prosedur_pasien pp');
    $this->db->join('icd9 icd', 'pp.kode = icd.kode', 'left');
    $this->db->where('pp.no_rawat', $no_rawat);
    $this->db->order_by('pp.prioritas', 'ASC');
    
    return $this->db->get()->result_array();
}

/**
 * Ambil data tindakan berdasarkan no_rawat
 */
public function get_tindakan_by_norawat($no_rawat) {
    $this->db->select('
        rp.nm_perawatan,
        rp.tgl_perawatan,
        d.nm_dokter,
        p.nama as nm_petugas,
        rp.keterangan
    ');
    $this->db->from('rawat_jl_dr rp');
    $this->db->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'left');
    $this->db->join('petugas p', 'rp.nip = p.nip', 'left');
    $this->db->where('rp.no_rawat', $no_rawat);
    $this->db->order_by('rp.tgl_perawatan', 'ASC');
    
    return $this->db->get()->result_array();
}

/**
 * Ambil data lab berdasarkan no_rawat
 */
public function get_lab_by_norawat($no_rawat) {
    // TODO: Implementasi sesuai struktur tabel lab di database Anda
    return null;
}

/**
 * Ambil data radiologi berdasarkan no_rawat
 */
public function get_radiologi_by_norawat($no_rawat) {
    // TODO: Implementasi sesuai struktur tabel radiologi di database Anda
    return null;
}
```

**PENTING:** Sesuaikan nama tabel dan field dengan database Anda!

---

### STEP 3: Tambahkan Tombol Cetak di View (10 menit)

Buka `assets/js/riwayatPasien.js` dan tambahkan:

```javascript
// 1. Tambahkan function cetak di akhir file
function cetakPDF(noRawat) {
    if (!noRawat) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No. Rawat tidak ditemukan'
        });
        return;
    }
    
    const encodedNoRawat = encodeURIComponent(noRawat);
    const printUrl = baseUrl + 'print/riwayat_pasien/' + encodedNoRawat;
    
    window.open(printUrl, '_blank');
}

// 2. Tambahkan button di function yang render card/list
// Contoh: di function renderCardHeader atau sejenisnya
// Tambahkan button ini:
`<button class="btn btn-sm btn-primary" onclick="cetakPDF('${data.no_rawat}')">
    <i class="fas fa-print"></i> Cetak PDF
</button>`
```

---

### STEP 4: Test Print (5 menit)

1. Buka halaman riwayat pasien
2. Klik tombol "Cetak PDF"
3. Akan terbuka tab baru dengan preview print
4. Tekan Ctrl+P (Windows) atau Cmd+P (Mac)
5. Pilih "Save as PDF" atau langsung print

---

## ✅ Checklist Testing

- [ ] Config hospital sudah diisi dengan benar
- [ ] Logo RS muncul di header
- [ ] Data pasien tampil lengkap
- [ ] Data SOAP tampil (jika ada)
- [ ] Data diagnosa tampil (jika ada)
- [ ] Data prosedur tampil (jika ada)
- [ ] Data tindakan tampil (jika ada)
- [ ] Layout rapi di preview
- [ ] Tidak ada halaman kosong
- [ ] Tidak ada konten terpotong
- [ ] Print PDF berhasil
- [ ] Print fisik berhasil (jika ada printer)

---

## 🔧 Troubleshooting Cepat

### Error: "Data kunjungan tidak ditemukan"
**Solusi:** Cek method `get_visit_by_norawat()` di model, pastikan query benar dan no_rawat ada di database.

### Error: "Call to undefined method"
**Solusi:** Pastikan semua method sudah ditambahkan di model.

### Halaman kosong muncul
**Solusi:** Cek CSS, pastikan tidak ada margin/padding berlebihan. Lihat console browser untuk error.

### Gambar tidak muncul
**Solusi:** Cek path gambar, pastikan menggunakan `base_url()` atau path absolut.

### Pop-up blocked
**Solusi:** Izinkan pop-up untuk domain Anda di browser settings.

---

## 📞 Butuh Bantuan?

Lihat dokumentasi lengkap di:
- `PRINT_FINAL_GUIDE.md` - Dokumentasi lengkap
- `PRINT_INTEGRATION_EXAMPLE.js` - Contoh integrasi

---

**Estimasi Total Waktu:** 35 menit  
**Tingkat Kesulitan:** ⭐⭐ (Mudah-Sedang)  
**Status:** Production Ready ✅

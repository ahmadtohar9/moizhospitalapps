# Perbandingan Tabel: penilaian_medis_ralan_anak vs penilaian_medis_ralan_bedah

## Field yang SAMA (Common Fields)
| Field | Type Anak | Type Bedah | Keterangan |
|-------|-----------|------------|------------|
| no_rawat | varchar(17) | varchar(17) | ✅ SAMA |
| tanggal | datetime | datetime | ✅ SAMA |
| kd_dokter | varchar(20) | varchar(20) | ✅ SAMA |
| anamnesis | enum | enum | ✅ SAMA |
| hubungan | varchar(100) | varchar(30) | ⚠️ BEDA SIZE |
| keluhan_utama | varchar(2000) | varchar(2000) | ✅ SAMA |
| rps | varchar(2000) | varchar(2000) | ✅ SAMA |
| rpd | varchar(1000) | varchar(1000) | ✅ SAMA |
| rpo | varchar(1000) | varchar(1000) | ✅ SAMA |
| alergi | varchar(100) | varchar(50) | ⚠️ BEDA SIZE |
| kesadaran | enum | enum | ⚠️ BEDA VALUES |
| td | varchar(8) | varchar(8) | ✅ SAMA |
| nadi | varchar(5) | varchar(5) | ✅ SAMA |
| rr | varchar(5) | varchar(5) | ✅ SAMA |
| suhu | varchar(5) | varchar(5) | ✅ SAMA |
| bb | varchar(5) | varchar(5) | ✅ SAMA |
| gcs | varchar(10) | varchar(10) | ✅ SAMA |
| kepala | enum | enum | ✅ SAMA |
| thoraks | enum | enum | ✅ SAMA |
| abdomen | enum | enum | ✅ SAMA |
| ekstremitas | enum | enum | ✅ SAMA |
| ket_lokalis | text | text | ✅ SAMA |
| diagnosis | varchar(500) | varchar(500) | ✅ SAMA |

## Field HANYA di ANAK (36 fields total)
| Field | Type | Keterangan |
|-------|------|------------|
| **rpk** | varchar(1000) | Riwayat Penyakit Keluarga |
| **keadaan** | enum('Sehat','Sakit Ringan','Sakit Sedang','Sakit Berat') | Keadaan Umum |
| **spo** | varchar(5) | SpO₂ (Saturasi Oksigen) |
| **tb** | varchar(5) | Tinggi Badan |
| **mata** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Mata |
| **gigi** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Gigi & Mulut |
| **tht** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan THT |
| **genital** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Genital |
| **kulit** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Kulit |
| **ket_fisik** | text | Keterangan Pemeriksaan Fisik |
| **penunjang** | text | Pemeriksaan Penunjang |
| **tata** | text | Tatalaksana |
| **konsul** | varchar(1000) | Konsultasi/Rujukan |

**Total: 13 field unik di ANAK**

## Field HANYA di BEDAH (36 fields total)
| Field | Type | Keterangan |
|-------|------|------------|
| **status** | varchar(50) | Status Pasien |
| **nyeri** | varchar(5) | Skala Nyeri |
| **genetalia** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Genetalia (typo: genital) |
| **columna** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Columna Vertebralis |
| **muskulos** | enum('Normal','Abnormal','Tidak Diperiksa') | Pemeriksaan Muskuloskeletal |
| **lainnya** | varchar(1000) | Pemeriksaan Lainnya |
| **lab** | varchar(500) | Hasil Lab |
| **rad** | varchar(500) | Hasil Radiologi |
| **pemeriksaan** | varchar(500) | Pemeriksaan Lain |
| **diagnosis2** | varchar(500) | Diagnosis Sekunder |
| **permasalahan** | varchar(500) | Permasalahan |
| **terapi** | varchar(500) | Terapi |
| **tindakan** | varchar(500) | Tindakan |
| **edukasi** | varchar(500) | Edukasi |

**Total: 14 field unik di BEDAH**

## Perbedaan ENUM Values

### kesadaran
- **ANAK**: 'Compos Mentis', 'Apatis', 'Somnolen', 'Sopor', 'Koma'
- **BEDAH**: 'Compos Mentis', 'Apatis', 'Delirum'

## Summary
- **Total fields ANAK**: 36 fields
- **Total fields BEDAH**: 36 fields
- **Common fields**: 22 fields
- **Unique to ANAK**: 13 fields (rpk, keadaan, spo, tb, mata, gigi, tht, genital, kulit, ket_fisik, penunjang, tata, konsul)
- **Unique to BEDAH**: 14 fields (status, nyeri, genetalia, columna, muskulos, lainnya, lab, rad, pemeriksaan, diagnosis2, permasalahan, terapi, tindakan, edukasi)

## Kesimpulan
Kedua tabel memiliki **struktur yang berbeda** karena:
1. **ANAK** lebih fokus pada pemeriksaan pediatrik lengkap (mata, gigi, THT, kulit, dll)
2. **BEDAH** lebih fokus pada pemeriksaan bedah (nyeri, columna, muskuloskeletal, tindakan, dll)
3. **BEDAH** memiliki field terpisah untuk lab, radiologi, diagnosis2, terapi, tindakan
4. **ANAK** menggabungkan semua dalam field "penunjang" dan "tata"

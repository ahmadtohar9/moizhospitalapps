-- Migration: Penilaian Medis Ralan Kandungan (Obstetri & Ginekologi)
-- Created: 2025-12-18
-- Description: Tabel untuk menyimpan data penilaian medis spesialisasi kandungan

CREATE TABLE IF NOT EXISTS `penilaian_medis_ralan_kandungan` (
  `no_rawat` varchar(17) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kd_dokter` varchar(20) DEFAULT NULL,
  
  -- ANAMNESIS
  `keluhan_utama` text DEFAULT NULL,
  `rps` text DEFAULT NULL COMMENT 'Riwayat Penyakit Sekarang',
  `hpht` date DEFAULT NULL COMMENT 'Hari Pertama Haid Terakhir',
  `siklus_haid` varchar(50) DEFAULT NULL,
  `lama_haid` varchar(50) DEFAULT NULL,
  `haid_teratur` enum('Ya','Tidak') DEFAULT NULL,
  `gravida` int(11) DEFAULT 0 COMMENT 'Jumlah Kehamilan',
  `para` int(11) DEFAULT 0 COMMENT 'Jumlah Persalinan',
  `abortus` int(11) DEFAULT 0 COMMENT 'Jumlah Keguguran',
  `anak_hidup` int(11) DEFAULT 0,
  `riwayat_persalinan` text DEFAULT NULL,
  `riwayat_kb` text DEFAULT NULL,
  `rpd` text DEFAULT NULL COMMENT 'Riwayat Penyakit Dahulu',
  `alergi` varchar(255) DEFAULT NULL,
  
  -- TANDA VITAL
  `td_sistolik` int(11) DEFAULT NULL,
  `td_diastolik` int(11) DEFAULT NULL,
  `nadi` int(11) DEFAULT NULL,
  `suhu` decimal(4,1) DEFAULT NULL,
  `rr` int(11) DEFAULT NULL COMMENT 'Respiratory Rate',
  `bb` decimal(5,2) DEFAULT NULL COMMENT 'Berat Badan (kg)',
  `tb` int(11) DEFAULT NULL COMMENT 'Tinggi Badan (cm)',
  
  -- PEMERIKSAAN FISIK UMUM
  `kepala_leher` text DEFAULT NULL,
  `thorax` text DEFAULT NULL,
  `abdomen` text DEFAULT NULL,
  `ekstremitas` text DEFAULT NULL,
  
  -- PEMERIKSAAN GINEKOLOGI
  `inspeksi_vulva` text DEFAULT NULL,
  `inspekulo_vagina` text DEFAULT NULL,
  `inspekulo_portio` text DEFAULT NULL,
  `vt` text DEFAULT NULL COMMENT 'Vaginal Toucher',
  
  -- PEMERIKSAAN OBSTETRI (jika hamil)
  `tfu` varchar(50) DEFAULT NULL COMMENT 'Tinggi Fundus Uteri',
  `leopold_1` varchar(100) DEFAULT NULL,
  `leopold_2` varchar(100) DEFAULT NULL,
  `leopold_3` varchar(100) DEFAULT NULL,
  `leopold_4` varchar(100) DEFAULT NULL,
  `djj` varchar(50) DEFAULT NULL COMMENT 'Denyut Jantung Janin',
  `his` varchar(100) DEFAULT NULL,
  
  -- DIAGNOSIS & TATALAKSANA
  `diagnosis_kerja` text DEFAULT NULL,
  `diagnosis_banding` text DEFAULT NULL,
  `terapi` text DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `edukasi` text DEFAULT NULL,
  `rencana` text DEFAULT NULL,
  
  PRIMARY KEY (`no_rawat`,`tanggal`),
  KEY `idx_kd_dokter` (`kd_dokter`),
  KEY `idx_tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

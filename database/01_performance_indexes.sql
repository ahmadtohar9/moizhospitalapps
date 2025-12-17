-- ============================================
-- PERFORMANCE OPTIMIZATION - DATABASE INDEXES
-- For 300 Patients/Day with Multiple Concurrent Users
-- ============================================
-- Created: 2025-12-11
-- Purpose: Add critical indexes for high-performance operations
-- ============================================

-- ============================================
-- SECTION 1: LOGIN & AUTHENTICATION INDEXES
-- ============================================

-- Users table - CRITICAL for login performance
ALTER TABLE moizhospital_users 
  ADD INDEX IF NOT EXISTS idx_username (username),
  ADD INDEX IF NOT EXISTS idx_active (is_active),
  ADD INDEX IF NOT EXISTS idx_role (role_id),
  ADD INDEX IF NOT EXISTS idx_username_active (username, is_active);

-- Add kd_dokter and kd_pegawai columns if not exist
ALTER TABLE moizhospital_users 
  ADD COLUMN IF NOT EXISTS kd_dokter VARCHAR(20) DEFAULT NULL AFTER role_id,
  ADD COLUMN IF NOT EXISTS kd_pegawai VARCHAR(20) DEFAULT NULL AFTER kd_dokter,
  ADD INDEX IF NOT EXISTS idx_kd_dokter (kd_dokter),
  ADD INDEX IF NOT EXISTS idx_kd_pegawai (kd_pegawai);

-- Dokter table - for doctor validation
ALTER TABLE dokter 
  ADD INDEX IF NOT EXISTS idx_kd_dokter_lookup (kd_dokter),
  ADD INDEX IF NOT EXISTS idx_status_dokter (status);

-- Pegawai table - for staff validation  
ALTER TABLE pegawai 
  ADD INDEX IF NOT EXISTS idx_nik_lookup (nik),
  ADD INDEX IF NOT EXISTS idx_status_pegawai (stts_aktif);

-- ============================================
-- SECTION 2: SESSION TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS ci_sessions (
    id VARCHAR(128) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    data BLOB NOT NULL,
    PRIMARY KEY (id),
    KEY ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- SECTION 3: PATIENT REGISTRATION INDEXES
-- ============================================

-- reg_periksa - MOST QUERIED TABLE (Critical!)
ALTER TABLE reg_periksa
  ADD INDEX IF NOT EXISTS idx_no_rawat_lookup (no_rawat),
  ADD INDEX IF NOT EXISTS idx_no_rkm_medis_lookup (no_rkm_medis),
  ADD INDEX IF NOT EXISTS idx_tgl_registrasi_lookup (tgl_registrasi),
  ADD INDEX IF NOT EXISTS idx_kd_dokter_lookup (kd_dokter),
  ADD INDEX IF NOT EXISTS idx_kd_poli_lookup (kd_poli),
  ADD INDEX IF NOT EXISTS idx_status_lanjut_lookup (status_lanjut),
  ADD INDEX IF NOT EXISTS idx_composite_search (no_rkm_medis, tgl_registrasi, kd_dokter),
  ADD INDEX IF NOT EXISTS idx_composite_doctor (kd_dokter, tgl_registrasi, status_lanjut),
  ADD INDEX IF NOT EXISTS idx_composite_poli (kd_poli, tgl_registrasi);

-- pasien - FREQUENTLY JOINED
ALTER TABLE pasien
  ADD INDEX IF NOT EXISTS idx_no_rkm_medis_lookup (no_rkm_medis),
  ADD INDEX IF NOT EXISTS idx_nm_pasien_search (nm_pasien(50)),
  ADD INDEX IF NOT EXISTS idx_no_ktp_lookup (no_ktp),
  ADD INDEX IF NOT EXISTS idx_no_peserta_lookup (no_peserta);

-- ============================================
-- SECTION 4: MEDICAL RECORDS INDEXES
-- ============================================

-- pemeriksaan_ralan - SOAP DATA (Very frequently accessed)
ALTER TABLE pemeriksaan_ralan
  ADD INDEX IF NOT EXISTS idx_no_rawat_soap (no_rawat),
  ADD INDEX IF NOT EXISTS idx_tgl_perawatan_soap (tgl_perawatan),
  ADD INDEX IF NOT EXISTS idx_composite_soap (no_rawat, tgl_perawatan, jam_rawat);

-- diagnosa_pasien
ALTER TABLE diagnosa_pasien
  ADD INDEX IF NOT EXISTS idx_no_rawat_diag (no_rawat),
  ADD INDEX IF NOT EXISTS idx_kd_penyakit_diag (kd_penyakit),
  ADD INDEX IF NOT EXISTS idx_status_diag (status),
  ADD INDEX IF NOT EXISTS idx_composite_diag (no_rawat, status);

-- prosedur_pasien
ALTER TABLE prosedur_pasien
  ADD INDEX IF NOT EXISTS idx_no_rawat_proc (no_rawat),
  ADD INDEX IF NOT EXISTS idx_kode_proc (kode),
  ADD INDEX IF NOT EXISTS idx_status_proc (status),
  ADD INDEX IF NOT EXISTS idx_composite_proc (no_rawat, status);

-- rawat_jl_dr (tindakan)
ALTER TABLE rawat_jl_dr
  ADD INDEX IF NOT EXISTS idx_no_rawat_tind (no_rawat),
  ADD INDEX IF NOT EXISTS idx_kd_jenis_prw_tind (kd_jenis_prw),
  ADD INDEX IF NOT EXISTS idx_kd_dokter_tind (kd_dokter),
  ADD INDEX IF NOT EXISTS idx_tgl_perawatan_tind (tgl_perawatan),
  ADD INDEX IF NOT EXISTS idx_composite_tind (no_rawat, tgl_perawatan);

-- ============================================
-- SECTION 5: PHARMACY & LAB INDEXES
-- ============================================

-- resep_obat
ALTER TABLE resep_obat
  ADD INDEX IF NOT EXISTS idx_no_rawat_resep (no_rawat),
  ADD INDEX IF NOT EXISTS idx_tgl_perawatan_resep (tgl_perawatan),
  ADD INDEX IF NOT EXISTS idx_tgl_peresepan_resep (tgl_peresepan),
  ADD INDEX IF NOT EXISTS idx_composite_resep (no_rawat, tgl_peresepan);

-- periksa_lab
ALTER TABLE periksa_lab
  ADD INDEX IF NOT EXISTS idx_no_rawat_lab (no_rawat),
  ADD INDEX IF NOT EXISTS idx_tgl_periksa_lab (tgl_periksa),
  ADD INDEX IF NOT EXISTS idx_status_lab (status),
  ADD INDEX IF NOT EXISTS idx_composite_lab (no_rawat, tgl_periksa, status);

-- periksa_radiologi
ALTER TABLE periksa_radiologi
  ADD INDEX IF NOT EXISTS idx_no_rawat_rad (no_rawat),
  ADD INDEX IF NOT EXISTS idx_tgl_periksa_rad (tgl_periksa),
  ADD INDEX IF NOT EXISTS idx_status_rad (status),
  ADD INDEX IF NOT EXISTS idx_composite_rad (no_rawat, tgl_periksa, status);

-- ============================================
-- SECTION 6: ASSESSMENT INDEXES
-- ============================================

-- penilaian_awal_keperawatan_igdrz (IGD Assessment)
ALTER TABLE penilaian_awal_keperawatan_igdrz
  ADD INDEX IF NOT EXISTS idx_no_rawat_igd (no_rawat);

-- penilaian_medis_ralan_penyakit_dalam (PD Assessment)
ALTER TABLE penilaian_medis_ralan_penyakit_dalam
  ADD INDEX IF NOT EXISTS idx_no_rawat_pd (no_rawat);

-- penilaian_medis_ralan_orthopedi (Ortho Assessment)
ALTER TABLE penilaian_medis_ralan_orthopedi
  ADD INDEX IF NOT EXISTS idx_no_rawat_ortho (no_rawat);

-- resume_pasien
ALTER TABLE resume_pasien
  ADD INDEX IF NOT EXISTS idx_no_rawat_resume (no_rawat);

-- ============================================
-- SECTION 7: CUSTOM MOIZ TABLES INDEXES
-- ============================================

-- moiz_resume_pasien_ralan
ALTER TABLE moiz_resume_pasien_ralan
  ADD INDEX IF NOT EXISTS idx_kd_dokter_moiz (kd_dokter),
  ADD INDEX IF NOT EXISTS idx_updated_at_moiz (updated_at);

-- moiz_penunjang_dokter
ALTER TABLE moiz_penunjang_dokter
  ADD INDEX IF NOT EXISTS idx_tgl_periksa_penunjang (tgl_periksa),
  ADD INDEX IF NOT EXISTS idx_composite_penunjang (no_rawat, kd_dokter, tgl_periksa);

-- moiz_laporan_tindakan_ralan
ALTER TABLE moiz_laporan_tindakan_ralan
  ADD INDEX IF NOT EXISTS idx_tgl_input_laptind (tgl_input),
  ADD INDEX IF NOT EXISTS idx_composite_laptind (no_rawat, kd_dokter);

-- moiz_surat_sakit
ALTER TABLE moiz_surat_sakit
  ADD INDEX IF NOT EXISTS idx_tgl_surat_sakit (tgl_surat),
  ADD INDEX IF NOT EXISTS idx_is_final_sakit (is_final);

-- moiz_surat_rujukan
ALTER TABLE moiz_surat_rujukan
  ADD INDEX IF NOT EXISTS idx_tgl_surat_rujuk (tgl_surat),
  ADD INDEX IF NOT EXISTS idx_is_final_rujuk (is_final);

-- ============================================
-- SECTION 8: OPTIMIZE TABLE ENGINES
-- ============================================

-- Ensure all custom tables use InnoDB
ALTER TABLE moizhospital_users ENGINE=InnoDB;
ALTER TABLE rsiaandini_roles ENGINE=InnoDB;
ALTER TABLE moizhospital_menus ENGINE=InnoDB;
ALTER TABLE rsiaandini_role_menu ENGINE=InnoDB;
ALTER TABLE moizhospital_user_menu ENGINE=InnoDB;
ALTER TABLE moiz_resume_pasien_ralan ENGINE=InnoDB;
ALTER TABLE moiz_penunjang_dokter ENGINE=InnoDB;
ALTER TABLE moiz_laporan_tindakan_ralan ENGINE=InnoDB;
ALTER TABLE moiz_surat_sakit ENGINE=InnoDB;
ALTER TABLE moiz_surat_rujukan ENGINE=InnoDB;
ALTER TABLE moiz_setting_perusahaan ENGINE=InnoDB;

-- ============================================
-- SECTION 9: ANALYZE TABLES FOR OPTIMIZATION
-- ============================================

ANALYZE TABLE moizhospital_users;
ANALYZE TABLE dokter;
ANALYZE TABLE pegawai;
ANALYZE TABLE reg_periksa;
ANALYZE TABLE pasien;
ANALYZE TABLE pemeriksaan_ralan;
ANALYZE TABLE diagnosa_pasien;
ANALYZE TABLE prosedur_pasien;
ANALYZE TABLE rawat_jl_dr;
ANALYZE TABLE resep_obat;
ANALYZE TABLE periksa_lab;
ANALYZE TABLE periksa_radiologi;

-- ============================================
-- SECTION 10: CLEANUP OLD DATA (Optional)
-- ============================================

-- Delete old session data (older than 7 days)
-- DELETE FROM ci_sessions WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY));

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Check indexes on critical tables
-- SHOW INDEX FROM moizhospital_users;
-- SHOW INDEX FROM reg_periksa;
-- SHOW INDEX FROM pemeriksaan_ralan;

-- Check table status
-- SHOW TABLE STATUS WHERE Name IN ('moizhospital_users', 'reg_periksa', 'pemeriksaan_ralan');

-- ============================================
-- END OF PERFORMANCE INDEXES
-- ============================================

SELECT 'Performance indexes created successfully!' AS Status;

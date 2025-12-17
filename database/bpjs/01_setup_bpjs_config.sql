-- ============================================
-- BPJS VCLAIM - SETUP CONFIGURATION
-- Menggunakan tabel existing dari Khanza
-- ============================================

-- 1. Tabel Konfigurasi BPJS
CREATE TABLE IF NOT EXISTS bpjs_config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_ppk VARCHAR(20) NOT NULL COMMENT 'Kode PPK Rumah Sakit',
    nama_ppk VARCHAR(255) NOT NULL COMMENT 'Nama Rumah Sakit',
    cons_id VARCHAR(50) NOT NULL COMMENT 'Consumer ID dari BPJS',
    secret_key VARCHAR(100) NOT NULL COMMENT 'Secret Key dari BPJS',
    user_key VARCHAR(100) NOT NULL COMMENT 'User Key dari BPJS',
    base_url VARCHAR(255) DEFAULT 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev' COMMENT 'Base URL API BPJS',
    environment ENUM('development', 'production') DEFAULT 'development',
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Konfigurasi BPJS VClaim';

-- Insert config dari credential RSIA PETALA BUMI
INSERT INTO bpjs_config (kode_ppk, nama_ppk, cons_id, secret_key, user_key, environment) 
VALUES (
    '0069R035',
    'RSIA PETALA BUMI',
    '15174',
    'Evyxzqk0clxv',
    '3c09584918d4b1c6e75886b33519b2cc1',
    'development'
) ON DUPLICATE KEY UPDATE 
    cons_id = VALUES(cons_id),
    secret_key = VALUES(secret_key),
    user_key = VALUES(user_key);

-- ============================================
-- 2. Tabel Referensi Poli BPJS (untuk dropdown)
-- ============================================
CREATE TABLE IF NOT EXISTS bpjs_ref_poli (
    kode VARCHAR(10) PRIMARY KEY COMMENT 'Kode Poli BPJS',
    nama VARCHAR(100) NOT NULL COMMENT 'Nama Poli BPJS',
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama (nama)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Referensi Poli dari BPJS';

-- Insert data poli BPJS yang umum
INSERT INTO bpjs_ref_poli (kode, nama) VALUES
('ANA', 'Anak'),
('INT', 'Penyakit Dalam'),
('OBG', 'Kebidanan dan Penyakit Kandungan'),
('BED', 'Bedah'),
('ORT', 'Orthopedi'),
('MAT', 'Mata'),
('THT', 'THT'),
('KUL', 'Kulit dan Kelamin'),
('JIW', 'Jiwa'),
('SAR', 'Saraf'),
('JAN', 'Jantung'),
('PAR', 'Paru'),
('URO', 'Urologi'),
('GIG', 'Gigi'),
('RAD', 'Radiologi'),
('PAT', 'Patologi Klinik'),
('REH', 'Rehabilitasi Medik'),
('GIZ', 'Gizi'),
('IGD', 'Instalasi Gawat Darurat')
ON DUPLICATE KEY UPDATE nama = VALUES(nama);

-- ============================================
-- 3. Tabel Log Sync Referensi
-- ============================================
CREATE TABLE IF NOT EXISTS bpjs_sync_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_referensi VARCHAR(50) NOT NULL COMMENT 'Jenis: poli, diagnosa, prosedur, dll',
    status ENUM('success', 'failed') NOT NULL,
    jumlah_data INT DEFAULT 0 COMMENT 'Jumlah data yang di-sync',
    response_message TEXT COMMENT 'Response dari BPJS',
    synced_by INT COMMENT 'User ID yang melakukan sync',
    synced_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_jenis (jenis_referensi),
    INDEX idx_status (status),
    INDEX idx_synced_at (synced_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Log Sinkronisasi Referensi BPJS';

-- ============================================
-- 4. View untuk Mapping Poli (menggunakan tabel Khanza)
-- ============================================
CREATE OR REPLACE VIEW v_mapping_poli AS
SELECT 
    p.kd_poli AS kd_poli_rs,
    p.nm_poli AS nm_poli_rs,
    m.kd_poli_bpjs,
    m.nm_poli_bpjs,
    CASE 
        WHEN m.kd_poli_rs IS NOT NULL THEN 'Sudah Mapping'
        ELSE 'Belum Mapping'
    END AS status_mapping
FROM poliklinik p
LEFT JOIN maping_poli_bpjs m ON p.kd_poli = m.kd_poli_rs
ORDER BY p.nm_poli;

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Cek konfigurasi BPJS
SELECT * FROM bpjs_config;

-- Cek referensi poli BPJS
SELECT * FROM bpjs_ref_poli ORDER BY nama;

-- Cek mapping poli (tabel Khanza)
SELECT * FROM maping_poli_bpjs;

-- Cek poli yang belum di-mapping
SELECT * FROM v_mapping_poli WHERE status_mapping = 'Belum Mapping';

-- Cek poli yang sudah di-mapping
SELECT * FROM v_mapping_poli WHERE status_mapping = 'Sudah Mapping';

-- ============================================
-- END OF SCHEMA
-- ============================================

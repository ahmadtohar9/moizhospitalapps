-- ============================================
-- Database Schema: Antrian Poli Rawat Jalan
-- Table: moizhospital_antrian_poli
-- Created: 2025-12-25
-- Purpose: Tracking antrian pasien dan panggilan
-- ============================================

-- Drop table if exists (untuk development)
-- DROP TABLE IF EXISTS `moizhospital_antrian_poli`;

-- Create main table
CREATE TABLE IF NOT EXISTS `moizhospital_antrian_poli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rawat` varchar(17) NOT NULL COMMENT 'FK ke reg_periksa.no_rawat',
  `no_reg` varchar(10) DEFAULT NULL COMMENT 'Nomor registrasi',
  `no_antrian` varchar(10) DEFAULT NULL COMMENT 'Nomor antrian (misal: A-001, B-002)',
  `prefix_antrian` varchar(5) DEFAULT NULL COMMENT 'Prefix antrian per poli (A, B, C, dst)',
  `urutan_antrian` int(11) DEFAULT NULL COMMENT 'Urutan nomor antrian',
  `kd_poli` varchar(5) DEFAULT NULL COMMENT 'FK ke poliklinik.kd_poli',
  `kd_dokter` varchar(20) DEFAULT NULL COMMENT 'FK ke dokter.kd_dokter',
  `no_rkm_medis` varchar(15) DEFAULT NULL COMMENT 'FK ke pasien.no_rkm_medis',
  `tgl_registrasi` datetime DEFAULT NULL COMMENT 'Tanggal registrasi pasien',
  `tgl_panggil` datetime DEFAULT NULL COMMENT 'Tanggal/waktu pertama kali dipanggil',
  `status_panggil` enum('Menunggu','Dipanggil','Sedang Diperiksa','Selesai','Batal','Tidak Hadir') DEFAULT 'Menunggu' COMMENT 'Status antrian pasien',
  `dipanggil_oleh` varchar(20) DEFAULT NULL COMMENT 'User/dokter yang memanggil',
  `jumlah_panggil` int(11) DEFAULT 0 COMMENT 'Berapa kali pasien dipanggil',
  `terakhir_panggil` datetime DEFAULT NULL COMMENT 'Waktu terakhir dipanggil (untuk panggil ulang)',
  `estimasi_waktu` int(11) DEFAULT NULL COMMENT 'Estimasi waktu tunggu (menit)',
  `keterangan` text DEFAULT NULL COMMENT 'Catatan tambahan',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_no_rawat` (`no_rawat`),
  KEY `idx_no_antrian` (`no_antrian`),
  KEY `idx_status_panggil` (`status_panggil`),
  KEY `idx_kd_poli` (`kd_poli`),
  KEY `idx_kd_dokter` (`kd_dokter`),
  KEY `idx_tgl_registrasi` (`tgl_registrasi`),
  KEY `idx_no_rkm_medis` (`no_rkm_medis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel antrian pasien rawat jalan dengan sistem pemanggilan';

-- ============================================
-- Insert sample data untuk testing
-- ============================================

-- Uncomment untuk insert sample data
/*
INSERT INTO `moizhospital_antrian_poli` 
(`no_rawat`, `no_reg`, `no_antrian`, `prefix_antrian`, `urutan_antrian`, `kd_poli`, `kd_dokter`, `no_rkm_medis`, `tgl_registrasi`, `status_panggil`, `jumlah_panggil`) 
VALUES
('2025/12/25/000001', '000001', 'A-001', 'A', 1, 'U0001', 'DR001', '000001', NOW(), 'Menunggu', 0),
('2025/12/25/000002', '000002', 'A-002', 'A', 2, 'U0001', 'DR001', '000002', NOW(), 'Menunggu', 0),
('2025/12/25/000003', '000003', 'B-001', 'B', 1, 'U0002', 'DR002', '000003', NOW(), 'Menunggu', 0);
*/

-- ============================================
-- Create view untuk kemudahan query
-- ============================================

CREATE OR REPLACE VIEW `view_antrian_poli_lengkap` AS
SELECT 
    a.id,
    a.no_rawat,
    a.no_reg,
    a.no_antrian,
    a.prefix_antrian,
    a.urutan_antrian,
    a.status_panggil,
    a.jumlah_panggil,
    a.tgl_panggil,
    a.terakhir_panggil,
    a.estimasi_waktu,
    a.keterangan,
    -- Data Pasien
    p.no_rkm_medis,
    p.nm_pasien,
    p.jk AS jenis_kelamin,
    p.tgl_lahir,
    TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()) AS umur,
    p.no_tlp,
    -- Data Poli
    pol.kd_poli,
    pol.nm_poli,
    -- Data Dokter
    d.kd_dokter,
    d.nm_dokter,
    -- Data Penjamin
    pj.kd_pj,
    pj.png_jawab,
    -- Data Registrasi
    r.tgl_registrasi,
    r.jam_reg,
    r.status_lanjut,
    r.stts AS status_periksa,
    r.status_bayar,
    -- Timestamps
    a.created_at,
    a.updated_at
FROM 
    moizhospital_antrian_poli a
    LEFT JOIN reg_periksa r ON a.no_rawat = r.no_rawat
    LEFT JOIN pasien p ON a.no_rkm_medis = p.no_rkm_medis
    LEFT JOIN poliklinik pol ON a.kd_poli = pol.kd_poli
    LEFT JOIN dokter d ON a.kd_dokter = d.kd_dokter
    LEFT JOIN penjab pj ON r.kd_pj = pj.kd_pj;

-- ============================================
-- Create stored procedure untuk generate nomor antrian
-- ============================================

DELIMITER $$

CREATE PROCEDURE `sp_generate_nomor_antrian`(
    IN p_kd_poli VARCHAR(5),
    IN p_tgl_registrasi DATE,
    OUT p_no_antrian VARCHAR(10),
    OUT p_prefix VARCHAR(5),
    OUT p_urutan INT
)
BEGIN
    DECLARE v_prefix VARCHAR(5);
    DECLARE v_urutan INT;
    
    -- Get prefix dari poli (bisa custom sesuai kebutuhan)
    -- Untuk sementara pakai huruf pertama dari kode poli
    SET v_prefix = UPPER(LEFT(p_kd_poli, 1));
    
    -- Get urutan terakhir untuk poli dan tanggal ini
    SELECT COALESCE(MAX(urutan_antrian), 0) + 1 INTO v_urutan
    FROM moizhospital_antrian_poli
    WHERE kd_poli = p_kd_poli 
    AND DATE(tgl_registrasi) = p_tgl_registrasi;
    
    -- Generate nomor antrian dengan format: PREFIX-XXX
    SET p_no_antrian = CONCAT(v_prefix, '-', LPAD(v_urutan, 3, '0'));
    SET p_prefix = v_prefix;
    SET p_urutan = v_urutan;
END$$

DELIMITER ;

-- ============================================
-- Create trigger untuk auto-update timestamp
-- ============================================

DELIMITER $$

CREATE TRIGGER `trg_antrian_before_update`
BEFORE UPDATE ON `moizhospital_antrian_poli`
FOR EACH ROW
BEGIN
    -- Update terakhir_panggil jika status berubah ke Dipanggil
    IF NEW.status_panggil = 'Dipanggil' AND OLD.status_panggil != 'Dipanggil' THEN
        SET NEW.terakhir_panggil = NOW();
        SET NEW.jumlah_panggil = OLD.jumlah_panggil + 1;
        
        -- Set tgl_panggil jika ini panggilan pertama
        IF OLD.tgl_panggil IS NULL THEN
            SET NEW.tgl_panggil = NOW();
        END IF;
    END IF;
END$$

DELIMITER ;

-- ============================================
-- Create function untuk cek antrian menunggu
-- ============================================

DELIMITER $$

CREATE FUNCTION `fn_count_antrian_menunggu`(
    p_kd_poli VARCHAR(5),
    p_kd_dokter VARCHAR(20)
) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE v_count INT;
    
    SELECT COUNT(*) INTO v_count
    FROM moizhospital_antrian_poli
    WHERE kd_poli = p_kd_poli
    AND kd_dokter = p_kd_dokter
    AND DATE(tgl_registrasi) = CURDATE()
    AND status_panggil IN ('Menunggu', 'Dipanggil');
    
    RETURN v_count;
END$$

DELIMITER ;

-- ============================================
-- Grant permissions (adjust sesuai user database)
-- ============================================

-- GRANT SELECT, INSERT, UPDATE, DELETE ON moizhospital_antrian_poli TO 'your_db_user'@'localhost';
-- GRANT SELECT ON view_antrian_poli_lengkap TO 'your_db_user'@'localhost';
-- GRANT EXECUTE ON PROCEDURE sp_generate_nomor_antrian TO 'your_db_user'@'localhost';
-- GRANT EXECUTE ON FUNCTION fn_count_antrian_menunggu TO 'your_db_user'@'localhost';

-- ============================================
-- Indexes untuk performance optimization
-- ============================================

-- Index sudah dibuat di CREATE TABLE
-- Tambahan index jika diperlukan:
-- CREATE INDEX idx_composite_poli_dokter_tgl ON moizhospital_antrian_poli(kd_poli, kd_dokter, tgl_registrasi);
-- CREATE INDEX idx_composite_status_tgl ON moizhospital_antrian_poli(status_panggil, tgl_registrasi);

-- ============================================
-- Query examples untuk testing
-- ============================================

-- 1. Lihat semua antrian hari ini
-- SELECT * FROM view_antrian_poli_lengkap WHERE DATE(tgl_registrasi) = CURDATE() ORDER BY urutan_antrian;

-- 2. Lihat antrian per poli
-- SELECT * FROM view_antrian_poli_lengkap WHERE kd_poli = 'U0001' AND DATE(tgl_registrasi) = CURDATE() ORDER BY urutan_antrian;

-- 3. Lihat antrian per dokter
-- SELECT * FROM view_antrian_poli_lengkap WHERE kd_dokter = 'DR001' AND DATE(tgl_registrasi) = CURDATE() ORDER BY urutan_antrian;

-- 4. Lihat antrian yang sedang menunggu
-- SELECT * FROM view_antrian_poli_lengkap WHERE status_panggil = 'Menunggu' AND DATE(tgl_registrasi) = CURDATE() ORDER BY urutan_antrian;

-- 5. Lihat panggilan terakhir (untuk display)
-- SELECT * FROM view_antrian_poli_lengkap WHERE status_panggil = 'Dipanggil' ORDER BY terakhir_panggil DESC LIMIT 5;

-- ============================================
-- Maintenance queries
-- ============================================

-- Reset antrian harian (jalankan setiap hari via cron job)
-- UPDATE moizhospital_antrian_poli SET status_panggil = 'Tidak Hadir' 
-- WHERE status_panggil IN ('Menunggu', 'Dipanggil') 
-- AND DATE(tgl_registrasi) < CURDATE();

-- Cleanup data lama (opsional, sesuaikan retention policy)
-- DELETE FROM moizhospital_antrian_poli WHERE tgl_registrasi < DATE_SUB(CURDATE(), INTERVAL 90 DAY);

-- ============================================
-- End of SQL Script
-- ============================================

-- Verification
SELECT 'Table moizhospital_antrian_poli created successfully!' AS Status;
SELECT 'View view_antrian_poli_lengkap created successfully!' AS Status;
SELECT 'Stored procedure sp_generate_nomor_antrian created successfully!' AS Status;
SELECT 'Function fn_count_antrian_menunggu created successfully!' AS Status;
SELECT 'Trigger trg_antrian_before_update created successfully!' AS Status;

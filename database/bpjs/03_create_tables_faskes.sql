-- ============================================
-- BPJS VCLAIM - 03 FASKES MAPPING
-- Fokus: Mapping Fasilitas Kesehatan (Perujuk)
-- ============================================

CREATE TABLE IF NOT EXISTS moizhospital_maping_faskes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_faskes_rs VARCHAR(255) NOT NULL COMMENT 'Nama Faskes/Perujuk dari data RS (distinct rujuk_masuk)',
    kode_faskes_bpjs VARCHAR(50) NOT NULL,
    nama_faskes_bpjs VARCHAR(255) NOT NULL,
    jenis_faskes TINYINT(1) DEFAULT 2 COMMENT '1: Faskes Tingkat 1, 2: Faskes Rujukan/RS',
    alamat_faskes_bpjs TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama_rs (nama_faskes_rs),
    INDEX idx_kode_bpjs (kode_faskes_bpjs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Mapping Faskes RS (Perujuk) ke BPJS';

-- ============================================
-- BPJS VCLAIM - 02 DIAGNOSA & PROSEDUR
-- Fokus: Mapping Diagnosa (ICD-10) & Prosedur (ICD-9)
-- ============================================

-- 1. Tabel Referensi Diagnosa BPJS (ICD-10)
CREATE TABLE IF NOT EXISTS bpjs_ref_diagnosa (
    kode VARCHAR(10) PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama (nama)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Referensi Diagnosa (ICD-10) dari BPJS';

-- 2. Tabel Referensi Prosedur BPJS (ICD-9)
CREATE TABLE IF NOT EXISTS bpjs_ref_prosedur (
    kode VARCHAR(10) PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama (nama)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Referensi Prosedur (ICD-9) dari BPJS';

-- 3. Tabel Mapping Diagnosa (RS <-> BPJS)
-- Menggunakan struktur Khanza: maping_diagnosa_bpjs (jika ada) atau buat baru
CREATE TABLE IF NOT EXISTS maping_diagnosa_bpjs (
    kd_diags_rs VARCHAR(10) NOT NULL,
    kd_diags_bpjs VARCHAR(10) NOT NULL,
    nm_diags_bpjs VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (kd_diags_rs, kd_diags_bpjs),
    INDEX idx_rs (kd_diags_rs),
    INDEX idx_bpjs (kd_diags_bpjs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Mapping Diagnosa RS ke BPJS';

-- 4. Tabel Mapping Prosedur (RS <-> BPJS)
CREATE TABLE IF NOT EXISTS maping_prosedur_bpjs (
    kd_prosedur_rs VARCHAR(10) NOT NULL,
    kd_prosedur_bpjs VARCHAR(10) NOT NULL,
    nm_prosedur_bpjs VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (kd_prosedur_rs, kd_prosedur_bpjs),
    INDEX idx_rs (kd_prosedur_rs),
    INDEX idx_bpjs (kd_prosedur_bpjs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Mapping Prosedur RS ke BPJS';

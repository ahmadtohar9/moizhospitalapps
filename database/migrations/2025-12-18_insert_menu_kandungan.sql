-- Insert Menu Penilaian Medis Kandungan ke RME Tab Menus
-- Date: 2025-12-18

INSERT INTO `moizhospital_rme_tab_menus` (`tab_name`, `tab_url`, `category`, `is_active`)
VALUES ('Penilaian Medis Kandungan', 'PenilaianMedisKandunganController/index', 'dokter', 1)
ON DUPLICATE KEY UPDATE 
    `tab_name` = 'Penilaian Medis Kandungan',
    `is_active` = 1;

-- Migration: Add ttd_dokter column to moizhospital_lembarKFR_rehabmedik table
-- Date: 2025-12-17
-- Description: Add signature field for doctor's digital signature

ALTER TABLE `moizhospital_lembarKFR_rehabmedik` 
ADD COLUMN `ttd_dokter` LONGTEXT NULL COMMENT 'Base64 encoded doctor signature' AFTER `rencana_tindak_lanjut`;

-- Note: Run this SQL manually in phpMyAdmin or MySQL client

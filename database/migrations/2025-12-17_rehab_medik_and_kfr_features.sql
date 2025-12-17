-- =====================================================
-- MOIZ HOSPITAL APPS - Database Migration
-- Date: 2025-12-17
-- Description: Database changes for Program Rehab Medik & Formulir KFR features
-- =====================================================

-- 1. Add ttd_dokter column to Formulir KFR table
-- This column stores doctor's digital signature in base64 format
ALTER TABLE `moizhospital_lembarKFR_rehabmedik` 
ADD COLUMN `ttd_dokter` LONGTEXT NULL COMMENT 'Base64 encoded doctor signature' 
AFTER `rencana_tindak_lanjut`;

-- =====================================================
-- NOTES:
-- =====================================================
-- 1. Program Rehab Medik uses existing table: moizhospital_program_rehabmedik
-- 2. SOAP data (TTV, Instruksi, Evaluasi) stored in: pemeriksaan_ralan
-- 3. Formulir KFR uses table: moizhospital_lembarKFR_rehabmedik
-- 
-- FEATURES ADDED:
-- - Program Rehab Medik with SOAP + TTV + Instruksi + Evaluasi
-- - Formulir KFR with auto-populate from latest SOAP
-- - Digital signature pad for doctors
-- - Print functionality with signature display
-- 
-- TABLES AFFECTED:
-- - moizhospital_lembarKFR_rehabmedik (added ttd_dokter column)
-- - moizhospital_program_rehabmedik (existing, no changes)
-- - pemeriksaan_ralan (existing, no changes)
-- =====================================================

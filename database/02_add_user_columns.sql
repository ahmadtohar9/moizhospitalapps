-- ============================================
-- ADD MISSING COLUMNS TO moizhospital_users
-- ============================================

-- Add last_login column for tracking
ALTER TABLE moizhospital_users 
  ADD COLUMN IF NOT EXISTS last_login DATETIME DEFAULT NULL AFTER is_active;

-- Add kd_dokter and kd_pegawai if not exist (for linking to master tables)
ALTER TABLE moizhospital_users 
  ADD COLUMN IF NOT EXISTS kd_dokter VARCHAR(20) DEFAULT NULL AFTER role_id,
  ADD COLUMN IF NOT EXISTS kd_pegawai VARCHAR(20) DEFAULT NULL AFTER kd_dokter;

-- Add indexes for performance
ALTER TABLE moizhospital_users 
  ADD INDEX IF NOT EXISTS idx_last_login (last_login);

SELECT 'User table columns added successfully!' AS Status;

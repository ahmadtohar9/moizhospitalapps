-- ============================================
-- FIX: Add last_login column to moizhospital_users
-- ============================================
-- Run this via phpMyAdmin or MySQL command line
-- ============================================

-- Add last_login column
ALTER TABLE moizhospital_users 
ADD COLUMN last_login DATETIME DEFAULT NULL 
AFTER is_active;

-- Verify column added
DESCRIBE moizhospital_users;

-- Success message
SELECT 'Column last_login added successfully!' AS Status;

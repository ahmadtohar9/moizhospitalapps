-- ============================================
-- RENAME TABLE: moizhospital_users -> moizhospital_users
-- ============================================
-- Run this SQL to rename the users table
-- ============================================

-- Rename table
RENAME TABLE moizhospital_users TO moizhospital_users;

-- Verify
DESCRIBE moizhospital_users;

-- Success message
SELECT 'Table renamed successfully from moizhospital_users to moizhospital_users!' AS Status;

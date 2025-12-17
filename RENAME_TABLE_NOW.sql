-- ============================================
-- QUICK FIX: Rename Table
-- ============================================
-- Copy-paste ke phpMyAdmin dan jalankan
-- ============================================

-- Rename table
RENAME TABLE rsiaandini_users TO moizhospital_users;

-- Verify
SHOW TABLES LIKE '%users%';

-- Check structure
DESCRIBE moizhospital_users;

-- Success!
SELECT 'Table renamed successfully!' AS Status;

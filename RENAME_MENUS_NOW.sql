-- ============================================
-- QUICK FIX: Rename Menus Table
-- ============================================
-- Copy-paste ke phpMyAdmin dan jalankan
-- ============================================

-- Rename table
RENAME TABLE rsiaandini_menus TO moizhospital_menus;

-- Verify
SHOW TABLES LIKE '%menus%';

-- Check structure
DESCRIBE moizhospital_menus;

-- Success!
SELECT 'Menus table renamed successfully!' AS Status;

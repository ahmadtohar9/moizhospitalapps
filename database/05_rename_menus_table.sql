-- ============================================
-- RENAME TABLE: moizhospital_menus -> moizhospital_menus
-- ============================================
-- Run this SQL to rename the menus table
-- ============================================

-- Rename table
RENAME TABLE moizhospital_menus TO moizhospital_menus;

-- Verify
DESCRIBE moizhospital_menus;

-- Success message
SELECT 'Table renamed successfully from moizhospital_menus to moizhospital_menus!' AS Status;

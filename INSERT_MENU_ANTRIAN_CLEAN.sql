-- ============================================
-- INSERT MENU DASHBOARD ANTRIAN
-- Copy-paste langsung ke SQLyog
-- ============================================

-- Step 1: Insert Parent Menu "Dashboard Antrian"
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Antrian', '#', 'fa-tv', NULL, 1, 50, 1, NOW(), NOW());

-- Step 2: Insert Submenu "Dashboard Semua Poli"
-- Ganti @PARENT_ID dengan ID dari menu "Dashboard Antrian" yang baru dibuat
-- Cek dulu: SELECT id FROM menu WHERE menu_name = 'Dashboard Antrian';
-- Misal hasilnya ID = 100, maka ganti @PARENT_ID dengan 100

INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Semua Poli', 'antrian/dashboard', 'fa-desktop', @PARENT_ID, 0, 1, 1, NOW(), NOW());

-- Step 3: Berikan akses ke role Admin
-- Ganti @MENU_ID dengan ID dari menu "Dashboard Semua Poli" yang baru dibuat
-- Cek dulu: SELECT id FROM menu WHERE menu_name = 'Dashboard Semua Poli';
-- Misal hasilnya ID = 101, maka ganti @MENU_ID dengan 101

INSERT INTO `user_access` (`role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`)
VALUES 
(1, @MENU_ID, 1, 0, 0, 0);

-- ============================================
-- ATAU gunakan cara otomatis dengan variable
-- (Jika SQLyog support variable)
-- ============================================

-- Cara Otomatis (All in one):
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Antrian', '#', 'fa-tv', NULL, 1, 50, 1, NOW(), NOW());

SET @parent_id = LAST_INSERT_ID();

INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Semua Poli', 'antrian/dashboard', 'fa-desktop', @parent_id, 0, 1, 1, NOW(), NOW());

SET @menu_id = LAST_INSERT_ID();

INSERT INTO `user_access` (`role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`)
VALUES 
(1, @menu_id, 1, 0, 0, 0);

-- ============================================
-- Verifikasi hasil
-- ============================================

SELECT * FROM menu WHERE menu_name LIKE '%Antrian%' ORDER BY id DESC;
SELECT * FROM user_access WHERE menu_id IN (SELECT id FROM menu WHERE menu_name LIKE '%Antrian%');

-- ============================================
-- Rollback jika ada kesalahan
-- ============================================

-- DELETE FROM user_access WHERE menu_id IN (SELECT id FROM menu WHERE menu_name LIKE '%Antrian%');
-- DELETE FROM menu WHERE menu_name LIKE '%Antrian%';

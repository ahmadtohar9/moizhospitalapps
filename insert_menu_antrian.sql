-- ============================================
-- SQL untuk menambahkan menu Dashboard Antrian
-- ke sidebar menu
-- ============================================

-- Cek dulu ID terakhir di tabel menu
SELECT MAX(id) FROM menu;

-- Insert Parent Menu: Dashboard Antrian
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Antrian', '#', 'fa-tv', NULL, 1, 50, 1, NOW(), NOW());

-- Ambil ID parent yang baru saja diinsert
SET @parent_id = LAST_INSERT_ID();

-- Insert Submenu: Dashboard Semua Poli
INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
VALUES 
('Dashboard Semua Poli', 'antrian/dashboard', 'fa-desktop', @parent_id, 0, 1, 1, NOW(), NOW());

-- Insert Submenu: Panel Pemanggilan (untuk dokter)
-- INSERT INTO `menu` (`menu_name`, `menu_url`, `icon`, `parent_id`, `has_submenu`, `order_num`, `is_active`, `created_at`, `updated_at`)
-- VALUES 
-- ('Panel Pemanggilan', 'antrian/panel', 'fa-bullhorn', @parent_id, 0, 2, 1, NOW(), NOW());

-- ============================================
-- Berikan akses ke role tertentu
-- ============================================

-- Cek dulu role yang ada
SELECT * FROM roles;

-- Berikan akses ke semua role (atau sesuaikan)
-- Ambil ID menu yang baru saja dibuat
SET @menu_dashboard_id = (SELECT id FROM menu WHERE menu_url = 'antrian/dashboard' LIMIT 1);
-- SET @menu_panel_id = (SELECT id FROM menu WHERE menu_url = 'antrian/panel' LIMIT 1);

-- Berikan akses ke role Admin (role_id = 1)
INSERT INTO `user_access` (`role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`)
VALUES 
(1, @menu_dashboard_id, 1, 0, 0, 0);

-- Berikan akses ke role Dokter (sesuaikan role_id dokter)
-- Misal role_id dokter = 2
-- INSERT INTO `user_access` (`role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`)
-- VALUES 
-- (2, @menu_panel_id, 1, 1, 1, 0);

-- ============================================
-- Verifikasi
-- ============================================

SELECT * FROM menu WHERE menu_name LIKE '%Antrian%';
SELECT * FROM user_access WHERE menu_id IN (SELECT id FROM menu WHERE menu_name LIKE '%Antrian%');

-- ============================================
-- Catatan:
-- ============================================
-- 1. Dashboard Semua Poli bisa diakses public (untuk TV di ruang tunggu)
-- 2. Panel Pemanggilan sudah terintegrasi di halaman dokter_ralan.php
--    jadi tidak perlu menu terpisah
-- 3. Sesuaikan role_id dengan struktur database Anda
-- 4. order_num bisa disesuaikan untuk urutan menu

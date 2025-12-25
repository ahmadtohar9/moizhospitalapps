-- ============================================
-- COPY-PASTE INI LANGSUNG KE SQLYOG
-- Jalankan semua sekaligus (blok semua, tekan F9)
-- ============================================

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

SELECT 'Menu berhasil ditambahkan!' AS Status;
SELECT * FROM menu WHERE menu_name LIKE '%Antrian%' ORDER BY id DESC LIMIT 2;

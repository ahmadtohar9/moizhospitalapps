-- ============================================
-- FIX MENU CIRCULAR REFERENCE
-- ============================================
-- Masalah: Menu dengan parent_id ke dirinya sendiri
-- Solusi: Update parent_id yang salah
-- ============================================

-- 1. Cek menu yang bermasalah
SELECT id, menu_name, parent_id, menurm 
FROM moizhospital_menus 
WHERE id = parent_id;

-- 2. Fix: Update menu yang parent_id-nya ke dirinya sendiri
UPDATE moizhospital_menus 
SET parent_id = NULL 
WHERE id = parent_id;

-- 3. Cek menu "Laporan Rawat Jalan" dan "Laporan Pasien Rawat Jalan"
SELECT id, menu_name, parent_id, menurm, is_active
FROM moizhospital_menus 
WHERE menu_name LIKE '%Laporan%Rawat%Jalan%'
ORDER BY id;

-- 4. OPTIONAL: Jika ingin gabungkan menu ke "Laporan Rawat Jalan" (ID 47)
-- Uncomment baris di bawah jika mau set parent_id ke 47

-- UPDATE moizhospital_menus 
-- SET parent_id = 47
-- WHERE id IN (SELECT id FROM (
--     SELECT id FROM moizhospital_menus 
--     WHERE menu_name LIKE '%Rawat Jalan%' 
--     AND id != 47 
--     AND parent_id IS NULL
-- ) AS temp);

-- 5. Verify: Pastikan tidak ada circular reference lagi
SELECT 
    m1.id,
    m1.menu_name,
    m1.parent_id,
    m2.menu_name AS parent_name
FROM moizhospital_menus m1
LEFT JOIN moizhospital_menus m2 ON m1.parent_id = m2.id
WHERE m1.id = m1.parent_id
OR m1.parent_id IS NOT NULL AND m2.id IS NULL;

-- Jika query di atas return 0 rows, berarti sudah OK!

-- ============================================
-- RME TAB MENUS INSERT - 13 NEW MODULES
-- Database: sik
-- Table: moizhospital_rme_tab_menus
-- ============================================

-- Check existing tabs first
SELECT * FROM moizhospital_rme_tab_menus ORDER BY urutan;

-- Insert 13 new tab menus
-- Note: Adjust urutan numbers based on existing tabs

-- 1. ANAK (Pediatri)
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Anak', 'AwalMedisAnakController', 'fa-child', 20, 'Aktif');

-- 2. BEDAH (Bedah Umum)
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Bedah', 'AwalMedisBedahController', 'fa-cut', 21, 'Aktif');

-- 3. BEDAH MULUT
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Bedah Mulut', 'AwalMedisBedahMulutController', 'fa-tooth', 22, 'Aktif');

-- 4. GAWAT DARURAT PSIKIATRI
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Gawat Darurat Psikiatri', 'AwalMedisGawatDaruratPsikiatriController', 'fa-ambulance', 23, 'Aktif');

-- 5. GERIATRI
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Geriatri', 'AwalMedisGeriatriController', 'fa-wheelchair', 24, 'Aktif');

-- 6. JANTUNG (Kardiologi)
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Jantung', 'AwalMedisJantungController', 'fa-heartbeat', 25, 'Aktif');

-- 7. KULIT DAN KELAMIN
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Kulit & Kelamin', 'AwalMedisKulitDanKelaminController', 'fa-user-md', 26, 'Aktif');

-- 8. NEUROLOGI
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Neurologi', 'AwalMedisNeurologiController', 'fa-brain', 27, 'Aktif');

-- 9. PARU (Pulmonologi)
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Paru', 'AwalMedisParuController', 'fa-lungs', 28, 'Aktif');

-- 10. PSIKIATRIK
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Psikiatrik', 'AwalMedisPsikiatrikController', 'fa-head-side-virus', 29, 'Aktif');

-- 11. REHAB MEDIK
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Rehab Medik', 'AwalMedisRehabMedikController', 'fa-procedures', 30, 'Aktif');

-- 12. THT
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen THT', 'AwalMedisTHTController', 'fa-ear-listen', 31, 'Aktif');

-- 13. UROLOGI
INSERT INTO moizhospital_rme_tab_menus (nama_tab, controller, icon, urutan, status) 
VALUES ('Asesmen Urologi', 'AwalMedisUrologiController', 'fa-kidneys', 32, 'Aktif');

-- Verify all tabs
SELECT * FROM moizhospital_rme_tab_menus ORDER BY urutan;

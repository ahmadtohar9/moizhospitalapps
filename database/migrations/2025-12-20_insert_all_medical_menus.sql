-- ============================================
-- AUTO-GENERATED MENU INSERT STATEMENTS
-- For 13 Medical Assessment Modules
-- ============================================

-- 1. ANAK (Pediatri)
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Anak', 'AwalMedisAnakController/index', 'fa-child', 'Dokter', 'Aktif', 20);

-- 2. BEDAH (Bedah Umum)
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Bedah', 'AwalMedisBedahController/index', 'fa-cut', 'Dokter', 'Aktif', 21);

-- 3. BEDAH MULUT
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Bedah Mulut', 'AwalMedisBedahMulutController/index', 'fa-tooth', 'Dokter', 'Aktif', 22);

-- 4. GAWAT DARURAT PSIKIATRI
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Gawat Darurat Psikiatri', 'AwalMedisGawatDaruratPsikiatriController/index', 'fa-ambulance', 'Dokter', 'Aktif', 23);

-- 5. GERIATRI
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Geriatri', 'AwalMedisGeriatriController/index', 'fa-wheelchair', 'Dokter', 'Aktif', 24);

-- 6. JANTUNG (Kardiologi)
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Jantung', 'AwalMedisJantungController/index', 'fa-heartbeat', 'Dokter', 'Aktif', 25);

-- 7. KULIT DAN KELAMIN
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Kulit & Kelamin', 'AwalMedisKulitDanKelaminController/index', 'fa-user-md', 'Dokter', 'Aktif', 26);

-- 8. NEUROLOGI
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Neurologi', 'AwalMedisNeurologiController/index', 'fa-brain', 'Dokter', 'Aktif', 27);

-- 9. PARU (Pulmonologi)
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Paru', 'AwalMedisParuController/index', 'fa-lungs', 'Dokter', 'Aktif', 28);

-- 10. PSIKIATRIK
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Psikiatrik', 'AwalMedisPsikiatrikController/index', 'fa-head-side-virus', 'Dokter', 'Aktif', 29);

-- 11. REHAB MEDIK
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Rehab Medik', 'AwalMedisRehabMedikController/index', 'fa-procedures', 'Dokter', 'Aktif', 30);

-- 12. THT
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis THT', 'AwalMedisTHTController/index', 'fa-ear-listen', 'Dokter', 'Aktif', 31);

-- 13. UROLOGI
INSERT INTO menu (nama_menu, url_path, icon, kategori, status, urutan) 
VALUES ('Penilaian Medis Urologi', 'AwalMedisUrologiController/index', 'fa-kidneys', 'Dokter', 'Aktif', 32);

-- ============================================
-- VERIFICATION QUERY
-- ============================================
SELECT * FROM menu WHERE kategori = 'Dokter' AND nama_menu LIKE 'Penilaian Medis%' ORDER BY urutan;

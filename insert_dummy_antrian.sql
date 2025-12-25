-- Insert dummy data untuk test dashboard
-- Ambil data dari reg_periksa hari ini

INSERT INTO moizhospital_antrian_poli (
    no_rawat,
    no_reg,
    no_rkm_medis,
    kd_poli,
    kd_dokter,
    no_antrian,
    prefix_antrian,
    urutan_antrian,
    status_panggil,
    jumlah_panggil,
    tgl_panggil,
    terakhir_panggil
)
SELECT 
    r.no_rawat,
    r.no_reg,
    r.no_rkm_medis,
    r.kd_poli,
    r.kd_dokter,
    CONCAT(UPPER(LEFT(r.kd_poli, 1)), '-', LPAD(r.no_reg, 3, '0')) as no_antrian,
    UPPER(LEFT(r.kd_poli, 1)) as prefix_antrian,
    r.no_reg as urutan_antrian,
    'Dipanggil' as status_panggil,
    1 as jumlah_panggil,
    NOW() as tgl_panggil,
    NOW() as terakhir_panggil
FROM reg_periksa r
WHERE DATE(r.tgl_registrasi) = CURDATE()
  AND r.stts = 'Belum'
LIMIT 1
ON DUPLICATE KEY UPDATE
    status_panggil = 'Dipanggil',
    jumlah_panggil = jumlah_panggil + 1,
    terakhir_panggil = NOW();

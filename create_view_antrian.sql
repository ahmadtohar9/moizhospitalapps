-- Create VIEW for antrian poli lengkap
-- This view combines data from moizhospital_antrian_poli with related tables

CREATE OR REPLACE VIEW `view_antrian_poli_lengkap` AS
SELECT 
    a.id,
    a.no_rawat,
    a.no_reg,
    a.no_antrian,
    a.prefix_antrian,
    a.urutan_antrian,
    a.status_panggil,
    a.jumlah_panggil,
    a.tgl_panggil,
    a.terakhir_panggil,
    a.estimasi_waktu,
    a.keterangan,
    a.no_rkm_medis,
    a.kd_poli,
    a.kd_dokter,
    p.nm_pasien,
    p.jk AS jenis_kelamin,
    p.tgl_lahir,
    TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()) AS umur,
    p.no_tlp,
    pol.nm_poli,
    d.nm_dokter,
    r.tgl_registrasi,
    r.jam_reg,
    r.status_lanjut,
    r.stts AS status_periksa,
    r.status_bayar,
    pj.kd_pj,
    pj.png_jawab,
    a.created_at,
    a.updated_at
FROM 
    moizhospital_antrian_poli a
    LEFT JOIN pasien p ON a.no_rkm_medis = p.no_rkm_medis
    LEFT JOIN poliklinik pol ON a.kd_poli = pol.kd_poli
    LEFT JOIN dokter d ON a.kd_dokter = d.kd_dokter
    LEFT JOIN reg_periksa r ON a.no_rawat = r.no_rawat
    LEFT JOIN penjab pj ON r.kd_pj = pj.kd_pj;

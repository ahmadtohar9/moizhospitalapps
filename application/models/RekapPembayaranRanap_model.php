<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapPembayaranRanap_model extends CI_Model {

    public function get_data($start_date, $end_date) {
        $sql = "
            SELECT
              ki.no_rawat,
              MAX(rp.no_rkm_medis) AS no_rkm_medis,
              MAX(p.nm_pasien) AS nm_pasien,
              MAX(ki.tgl_keluar) AS tgl_keluar,
              MAX(bsl.nm_bangsal) AS nm_bangsal,
              MAX(kmr.kd_kamar) AS kd_kamar,
              MAX(pj.png_jawab) AS png_jawab,
              (SELECT no_nota FROM nota_inap WHERE no_rawat = ki.no_rawat LIMIT 1) AS no_nota,
              (SELECT perujuk FROM rujuk_masuk WHERE no_rawat = ki.no_rawat LIMIT 1) AS perujuk,

              -- Biaya per jenis
              COALESCE(SUM(CASE WHEN b.status = 'Registrasi' THEN b.totalbiaya END), 0) AS biaya_registrasi,
              COALESCE(SUM(CASE WHEN b.status = 'Obat' THEN b.totalbiaya END), 0) AS biaya_obat,
              COALESCE(SUM(CASE WHEN b.status = 'Laborat' THEN b.totalbiaya END), 0) AS biaya_laborat,
              COALESCE(SUM(CASE WHEN b.status = 'Radiologi' THEN b.totalbiaya END), 0) AS biaya_radiologi,
              COALESCE(SUM(CASE WHEN b.status = 'Operasi' THEN b.totalbiaya END), 0) AS biaya_operasi,
              COALESCE(SUM(CASE WHEN b.status = 'Tambahan' THEN b.totalbiaya END), 0) AS biaya_tambahan,
              COALESCE(SUM(CASE WHEN b.status = 'Potongan' THEN b.totalbiaya END), 0) AS biaya_potongan,
              COALESCE(SUM(CASE WHEN b.status = 'Kamar' THEN b.totalbiaya END), 0) AS biaya_kamar,
              COALESCE(SUM(CASE WHEN b.status = 'Service' THEN b.totalbiaya END), 0) AS biaya_service,
              COALESCE(SUM(CASE WHEN b.status = 'Harian' THEN b.totalbiaya END), 0) AS biaya_harian,
              COALESCE(SUM(CASE WHEN b.status = 'Retur Obat' THEN b.totalbiaya END), 0) AS biaya_retur_obat,
              COALESCE(SUM(CASE WHEN b.status = 'Resep Pulang' THEN b.totalbiaya END), 0) AS biaya_resep_pulang,
              COALESCE(SUM(CASE WHEN b.status IN ('Ranap Dokter', 'Ranap Dokter Paramedis') THEN b.totalbiaya END), 0) AS biaya_ranap_dokter,
              COALESCE(SUM(CASE WHEN b.status = 'Ranap Paramedis' THEN b.totalbiaya END), 0) AS biaya_ranap_paramedis,
              COALESCE(SUM(CASE WHEN b.status IN ('Ralan Dokter', 'Ralan Dokter Paramedis', 'Ralan Paramedis') THEN b.totalbiaya END), 0) AS biaya_ralan,

              -- Total seluruh biaya
              COALESCE(SUM(b.totalbiaya), 0) AS total_biaya

            FROM kamar_inap ki
            JOIN reg_periksa rp ON ki.no_rawat = rp.no_rawat
            JOIN pasien p ON rp.no_rkm_medis = p.no_rkm_medis
            JOIN kamar kmr ON ki.kd_kamar = kmr.kd_kamar
            JOIN bangsal bsl ON kmr.kd_bangsal = bsl.kd_bangsal
            JOIN penjab pj ON rp.kd_pj = pj.kd_pj
            LEFT JOIN billing b ON b.no_rawat = ki.no_rawat

            WHERE
              ki.stts_pulang NOT IN ('-', 'Pindah Kamar')
              AND ki.tgl_keluar BETWEEN ? AND ?
              AND rp.no_rawat NOT IN (SELECT no_rawat FROM piutang_pasien)

            GROUP BY ki.no_rawat
            HAVING total_biaya > 0
            ORDER BY tgl_keluar
        ";

        return $this->db->query($sql, [$start_date, $end_date])->result_array();
    }

}

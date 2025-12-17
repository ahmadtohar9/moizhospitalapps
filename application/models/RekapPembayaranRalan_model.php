<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapPembayaranRalan_model extends CI_Model {

    public function get_data($start_date, $end_date, $kd_dokter = '', $kd_pj = '', $kd_poli = '') {
        $sql = "
            SELECT
                rp.tgl_registrasi,
                nj.no_nota,
                rp.no_rkm_medis,
                p.nm_pasien,
                COALESCE(pj.png_jawab, '-') AS png_jawab,
                pl.nm_poli,
                COALESCE(rm.perujuk, '-') AS perujuk,

                COALESCE(bl.biaya_registrasi, 0) AS biaya_registrasi,
                COALESCE(bl.biaya_obat, 0)        AS biaya_obat,
                COALESCE(bl.biaya_ralan, 0)       AS biaya_ralan,
                COALESCE(bl.biaya_operasi, 0)     AS biaya_operasi,
                COALESCE(bl.biaya_laborat, 0)     AS biaya_laborat,
                COALESCE(bl.biaya_radiologi, 0)   AS biaya_radiologi,
                COALESCE(bl.biaya_tambahan, 0)    AS biaya_tambahan,
                COALESCE(bl.biaya_potongan, 0)    AS biaya_potongan,
                COALESCE(bl.total_biaya, 0)       AS total_biaya,

                d.nm_dokter,

                CASE
                    WHEN COALESCE(bl.total_biaya, 0) > 0 THEN 'Sudah Bayar'
                    ELSE 'Belum Bayar'
                END AS keterangan

            FROM reg_periksa rp
            INNER JOIN pasien p      ON rp.no_rkm_medis = p.no_rkm_medis
            INNER JOIN poliklinik pl ON rp.kd_poli      = pl.kd_poli
            INNER JOIN dokter d      ON rp.kd_dokter    = d.kd_dokter
            LEFT JOIN penjab pj      ON rp.kd_pj        = pj.kd_pj
            LEFT JOIN nota_jalan nj  ON rp.no_rawat     = nj.no_rawat
            LEFT JOIN rujuk_masuk rm ON rp.no_rawat     = rm.no_rawat

            /* Agregasi billing per no_rawat agar rapi & efisien */
            LEFT JOIN (
                SELECT
                    b.no_rawat,
                    SUM(CASE WHEN b.status = 'Registrasi' THEN b.totalbiaya ELSE 0 END) AS biaya_registrasi,
                    SUM(CASE WHEN b.status = 'Obat'       THEN b.totalbiaya ELSE 0 END) AS biaya_obat,
                    SUM(CASE WHEN b.status IN ('Ralan Dokter','Ralan Dokter Paramedis','Ralan Paramedis') THEN b.totalbiaya ELSE 0 END) AS biaya_ralan,
                    SUM(CASE WHEN b.status = 'Operasi'    THEN b.totalbiaya ELSE 0 END) AS biaya_operasi,
                    SUM(CASE WHEN b.status = 'Laborat'    THEN b.totalbiaya ELSE 0 END) AS biaya_laborat,
                    SUM(CASE WHEN b.status = 'Radiologi'  THEN b.totalbiaya ELSE 0 END) AS biaya_radiologi,
                    SUM(CASE WHEN b.status = 'Tambahan'   THEN b.totalbiaya ELSE 0 END) AS biaya_tambahan,
                    SUM(CASE WHEN b.status = 'Potongan'   THEN b.totalbiaya ELSE 0 END) AS biaya_potongan,
                    SUM(CASE
                        WHEN b.status IN ('Registrasi','Obat','Ralan Dokter','Ralan Dokter Paramedis','Ralan Paramedis','Operasi','Laborat','Radiologi','Tambahan','Potongan')
                        THEN b.totalbiaya ELSE 0 END) AS total_biaya
                FROM billing b
                GROUP BY b.no_rawat
            ) bl ON rp.no_rawat = bl.no_rawat

            WHERE rp.status_lanjut = 'Ralan'
              AND rp.no_rawat NOT IN (SELECT no_rawat FROM piutang_pasien)
              AND rp.tgl_registrasi BETWEEN ? AND ?
              /* Hanya yang ada biayanya */
              AND COALESCE(bl.total_biaya, 0) > 0
        ";

        $params = [$start_date, $end_date];

        if (!empty($kd_dokter)) {
            $sql .= " AND rp.kd_dokter = ?";
            $params[] = $kd_dokter;
        }
        if (!empty($kd_pj)) {
            // filter by kode penjamin (kd_pj). Jika kamu mau filter berdasarkan nama penjamin,
            // ganti baris ini dengan:  $sql .= " AND pj.png_jawab = ?"; $params[] = $kd_pj;
            $sql .= " AND rp.kd_pj = ?";
            $params[] = $kd_pj;
        }
        if (!empty($kd_poli)) {
            $sql .= " AND rp.kd_poli = ?";
            $params[] = $kd_poli;
        }

        $sql .= " ORDER BY d.nm_dokter, rp.tgl_registrasi, rp.no_rawat";

        return $this->db->query($sql, $params)->result_array();
    }


    public function get_dokter_list() {
        return $this->db->get('dokter')->result_array();
    }

    public function get_penjab_list() {
        return $this->db->get('penjab')->result_array();
    }

    public function get_poli_list() {
        return $this->db->get('poliklinik')->result_array();
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DokterRalanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Ambil daftar pasien rawat jalan berdasarkan filter tanggal, penjamin, status bayar, dan status periksa.
     */
    // application/models/DokterRalanModel.php
    public function get_pasien_rajal($start_date=null, $end_date=null, $kd_pj=null, $status_bayar=null, $status_periksa=null)
    {
        $this->db->select("
            r.no_rawat,
            r.no_rkm_medis,
            p.nm_pasien,
            d.nm_dokter,
            j.png_jawab,
            k.nm_poli,
            r.stts          AS status_periksa,
            r.status_bayar,
            r.tgl_registrasi,
            r.jam_reg,
            (CASE WHEN EXISTS (
                SELECT 1 FROM pemeriksaan_ralan pr
                WHERE pr.no_rawat = r.no_rawat
                LIMIT 1
            ) THEN 1 ELSE 0 END) AS has_soap
        ", false);

        $this->db->from('reg_periksa r');
        $this->db->join('pasien p',     'p.no_rkm_medis = r.no_rkm_medis');
        $this->db->join('dokter d',     'd.kd_dokter    = r.kd_dokter');
        $this->db->join('poliklinik k', 'k.kd_poli      = r.kd_poli');
        $this->db->join('penjab j',     'j.kd_pj        = r.kd_pj');

        // filter tanggal
        if ($start_date) $this->db->where('r.tgl_registrasi >=', $start_date);
        if ($end_date)   $this->db->where('r.tgl_registrasi <=', $end_date);

        if ($kd_pj)         $this->db->where('r.kd_pj', $kd_pj);      // filter by kode penjamin
        if ($status_bayar)   $this->db->where('r.status_bayar', $status_bayar);
        if ($status_periksa) $this->db->where('r.stts', $status_periksa);

        $this->db->order_by('r.tgl_registrasi', 'DESC');
        $this->db->order_by('r.jam_reg', 'DESC');

        $rows = $this->db->get()->result_array();

        // flag 'baru' (≤ 10 menit)
        $now = new DateTime();
        foreach ($rows as &$it) {
            $ts = DateTime::createFromFormat('Y-m-d H:i:s', $it['tgl_registrasi'].' '.$it['jam_reg']);
            $it['is_baru'] = ($ts && ($now->getTimestamp() - $ts->getTimestamp() <= 600)) ? 1 : 0;
        }
        return $rows;
    }

    public function get_patient_detail($no_rawat)
    {
        return $this->db->select('
                r.no_rawat,
                r.no_rkm_medis,
                p.nm_pasien, p.jk, p.tgl_lahir, p.umur,
                d.nm_dokter,
                j.png_jawab,
                k.nm_poli, k.kd_poli,
                r.tgl_registrasi, r.jam_reg,
                r.stts AS status_periksa,
                r.status_bayar
            ')
            ->from('reg_periksa r')
            ->join('pasien p',     'p.no_rkm_medis = r.no_rkm_medis')
            ->join('dokter d',     'd.kd_dokter    = r.kd_dokter')
            ->join('penjab j',     'j.kd_pj        = r.kd_pj')
            ->join('poliklinik k', 'k.kd_poli      = r.kd_poli')
            ->where('r.no_rawat', $no_rawat)
            ->limit(1)->get()->row_array();
    }

    // (opsional) mapping akses dokter ↔ poli
    public function check_dokter_access($kd_dokter, $kd_poli)
    {
        $res = $this->db->select('1')
            ->from('dokter_poli_mapping')
            ->where('kd_dokter', $kd_dokter)
            ->where('kd_poli', $kd_poli)
            ->limit(1)->get()->num_rows();
        return $res > 0;
    }
}
?>

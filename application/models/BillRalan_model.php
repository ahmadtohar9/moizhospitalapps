<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillRalan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function get_billing_ralan($start_date, $end_date, $kd_dokter = '')
    {
        $this->db->select("
            b.tgl_byr, b.no_rawat, 
            r.no_rkm_medis AS No_RM, 
            p.nm_pasien AS Nama_Pasien,
            d.nm_dokter AS Nama_Dokter,

            COALESCE(SUM(CASE WHEN b.STATUS = 'Registrasi' THEN b.totalbiaya END), 0) AS Adm,
            COALESCE(SUM(CASE WHEN b.STATUS = 'Obat' THEN b.totalbiaya END), 0) AS Total_Obat,
            COALESCE(SUM(CASE WHEN b.STATUS = 'Laborat' THEN b.totalbiaya END), 0) AS Total_Labor,

            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%Konsul%' THEN b.totalbiaya END), 0) AS Tindakan_Konsul,
            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%USG%' THEN b.totalbiaya END), 0) AS Tindakan_USG,
            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%Sewa Ruangan%' THEN b.totalbiaya END), 0) AS Sewa_Ruangan,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Ralan Dokter' 
                    AND b.nm_perawatan NOT LIKE '%Konsul%' 
                    AND b.nm_perawatan NOT LIKE '%USG%' 
                    AND b.nm_perawatan NOT LIKE '%Sewa Ruangan%' 
                THEN b.totalbiaya 
            END), 0) AS Tindakan_Lain,

            COALESCE(SUM(CASE 
                WHEN LOWER(b.nm_perawatan) LIKE '%jasa layanan%' 
                THEN b.totalbiaya 
            END), 0) AS Jasa_Layanan,

            COALESCE(SUM(CASE 
                WHEN LOWER(b.nm_perawatan) LIKE '%jasa dokter%' 
                THEN b.totalbiaya 
            END), 0) AS Jasa_DokterTambahan,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Tambahan' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                THEN b.totalbiaya 
            END), 0) AS Tambahan_Biaya,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Potongan' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                THEN b.totalbiaya 
            END), 0) AS Potongan_Biaya,

            COALESCE(SUM(b.totalbiaya), 0) AS Total_Tagihan
        ", false);

        $this->db->from('billing b');
        $this->db->join('reg_periksa r', 'b.no_rawat = r.no_rawat', 'INNER');
        $this->db->join('pasien p', 'r.no_rkm_medis = p.no_rkm_medis', 'INNER');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'INNER');
        $this->db->where('r.status_lanjut', 'Ralan');
        $this->db->where('b.tgl_byr >=', $start_date);
        $this->db->where('b.tgl_byr <=', $end_date);

        if (!empty($kd_dokter)) {
            $this->db->where('r.kd_dokter', $kd_dokter);
        }

        $this->db->group_by('b.no_rawat');
        return $this->db->get()->result_array();
    }



   public function get_billing_data($start_date, $end_date, $kd_dokter = '')
    {
        $this->db->select("
            b.tgl_byr, b.no_rawat, 
            r.no_rkm_medis AS No_RM, 
            p.nm_pasien AS Nama_Pasien,
            d.nm_dokter AS Nama_Dokter,

            COALESCE(SUM(CASE WHEN b.STATUS = 'Registrasi' THEN b.totalbiaya END), 0) AS Adm,
            COALESCE(SUM(CASE WHEN b.STATUS = 'Obat' THEN b.totalbiaya END), 0) AS Total_Obat,
            COALESCE(SUM(CASE WHEN b.STATUS = 'Laborat' THEN b.totalbiaya END), 0) AS Total_Labor,

            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%Konsul%' THEN b.totalbiaya END), 0) AS Tindakan_Konsul,
            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%USG%' THEN b.totalbiaya END), 0) AS Tindakan_USG,
            COALESCE(SUM(CASE WHEN b.nm_perawatan LIKE '%Sewa Ruangan%' THEN b.totalbiaya END), 0) AS Sewa_Ruangan,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Ralan Dokter' 
                    AND b.nm_perawatan NOT LIKE '%Konsul%' 
                    AND b.nm_perawatan NOT LIKE '%USG%' 
                    AND b.nm_perawatan NOT LIKE '%Sewa Ruangan%' 
                THEN b.totalbiaya 
            END), 0) AS Tindakan_Lain,

            COALESCE(SUM(CASE 
                WHEN LOWER(b.nm_perawatan) LIKE '%jasa layanan%' THEN b.totalbiaya 
            END), 0) AS Jasa_Layanan,

            COALESCE(SUM(CASE 
                WHEN LOWER(b.nm_perawatan) LIKE '%jasa dokter%' THEN b.totalbiaya 
            END), 0) AS Jasa_Dokter,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Tambahan' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                THEN b.totalbiaya 
            END), 0) AS Tambahan_Biaya,

            COALESCE(SUM(CASE 
                WHEN b.STATUS = 'Potongan' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%' 
                    AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                THEN b.totalbiaya 
            END), 0) AS Potongan_Biaya,

            COALESCE(SUM(b.totalbiaya), 0) AS Total_Tagihan
        ", false);

        $this->db->from('billing b');
        $this->db->join('reg_periksa r', 'b.no_rawat = r.no_rawat', 'INNER');
        $this->db->join('pasien p', 'r.no_rkm_medis = p.no_rkm_medis', 'INNER');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'INNER');
        $this->db->where('r.status_lanjut', 'Ralan');
        $this->db->where('b.tgl_byr >=', $start_date);
        $this->db->where('b.tgl_byr <=', $end_date);

        if (!empty($kd_dokter)) {
            $this->db->where('r.kd_dokter', $kd_dokter);
        }

        $this->db->group_by('b.no_rawat');
        return $this->db->get()->result_array();
    }


    public function get_dokter_list() 
    {
        $this->db->select('kd_dokter, nm_dokter');
        $this->db->from('dokter');
        return $this->db->get()->result_array();
    }
}
?>

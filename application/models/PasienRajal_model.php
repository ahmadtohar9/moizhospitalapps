<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienRajal_model extends CI_Model {

    public function get_pasien_rajal($start_date = null, $end_date = null, $penjab = null, $status_bayar = null, $status_periksa = null) 
    {
        $this->db->start_cache(); // Memulai cache query

        $this->db->select('
            reg_periksa.no_rawat,
            reg_periksa.no_rkm_medis,
            pasien.nm_pasien,
            dokter.nm_dokter,
            penjab.png_jawab,
            poliklinik.nm_poli,
            reg_periksa.tgl_registrasi,
            reg_periksa.status_bayar,
            reg_periksa.stts
        ');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        // **Debugging - Pastikan Format Tanggal**
        log_message('debug', "Filter Tanggal - Start Date: {$start_date}, End Date: {$end_date}");

        // **Filter tanggal registrasi menggunakan DATE()**
        if (!empty($start_date)) {
            $this->db->where('DATE(reg_periksa.tgl_registrasi) >=', date('Y-m-d', strtotime($start_date)));
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(reg_periksa.tgl_registrasi) <=', date('Y-m-d', strtotime($end_date)));
        }

        // **Filter berdasarkan Penjamin**
        if (!empty($penjab)) {
            $this->db->where('penjab.png_jawab', $penjab);
        }

        // **Filter berdasarkan Status Bayar**
        if (!empty($status_bayar)) {
            $this->db->where('reg_periksa.status_bayar', $status_bayar);
        }

        // **Filter berdasarkan Status Periksa**
        if (!empty($status_periksa)) {
            $this->db->where('reg_periksa.stts', $status_periksa);
        }

        $this->db->stop_cache(); // Menghentikan cache query

        // Debug Query sebelum dieksekusi
        $query_string = $this->db->get_compiled_select();
        log_message('debug', "Query SQL yang akan dijalankan: {$query_string}");

        $query = $this->db->get();
        $this->db->flush_cache(); // Hapus cache query setelah dijalankan

        $result = $query->result_array();

        // Log jumlah hasil data yang ditemukan
        log_message('debug', "Jumlah data ditemukan: " . count($result));

        return $result;
    }

    public function get_penjamin() 
    {
        return $this->db->get('penjab')->result_array();
    }
}

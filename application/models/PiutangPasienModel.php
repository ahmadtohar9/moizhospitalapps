<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PiutangPasienModel extends CI_Model {

    public function get_piutang($start_date = null, $end_date = null, $penjab = null, $search = null) 
    
    {
        $this->db->select('
            piutang_pasien.no_rawat,
            piutang_pasien.no_rkm_medis,
            pasien.nm_pasien,
            penjab.png_jawab,
            piutang_pasien.totalpiutang
        ');
        $this->db->from('piutang_pasien');
        $this->db->join('reg_periksa', 'piutang_pasien.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'piutang_pasien.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        // Jika filter tanggal tidak diisi, gunakan tanggal hari ini
        if (empty($start_date) && empty($end_date)) {
            $current_date = date('Y-m-d');
            $this->db->where('reg_periksa.tgl_registrasi', $current_date);
        } else {
            if (!empty($start_date)) {
                $this->db->where('reg_periksa.tgl_registrasi >=', $start_date);
            }
            if (!empty($end_date)) {
                $this->db->where('reg_periksa.tgl_registrasi <=', $end_date);
            }
        }

        if (!empty($penjab)) {
            $this->db->where('penjab.png_jawab', $penjab);
        }

        // Filter berdasarkan nama pasien jika parameter search diisi
        if (!empty($search)) {
            $this->db->like('pasien.nm_pasien', $search);
        }

        return $this->db->get()->result_array();
    }


    public function get_piutangRanap($start_date = null, $end_date = null, $penjab = null) 
    
    {
        $this->db->select('
            piutang_pasien.no_rawat,
            piutang_pasien.no_rkm_medis,
            pasien.nm_pasien,
            penjab.png_jawab,
            piutang_pasien.totalpiutang
        ');
        $this->db->from('piutang_pasien');
        $this->db->join('reg_periksa', 'piutang_pasien.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'piutang_pasien.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->where('reg_periksa.status_lanjut','Ranap');

        // Jika filter tanggal tidak diisi, gunakan tanggal hari ini
        if (empty($start_date) && empty($end_date)) {
            $current_date = date('Y-m-d');
            $this->db->where('reg_periksa.tgl_registrasi', $current_date);
        } else {
            if (!empty($start_date)) {
                $this->db->where('reg_periksa.tgl_registrasi >=', $start_date);
            }
            if (!empty($end_date)) {
                $this->db->where('reg_periksa.tgl_registrasi <=', $end_date);
            }
        }

        if (!empty($penjab)) {
            $this->db->where('penjab.png_jawab', $penjab);
        }

        return $this->db->get()->result_array();
    }

    public function get_penjab() 
    
    {
        $this->db->select('png_jawab');
        $this->db->from('penjab');
        return $this->db->get()->result_array();
    }
}


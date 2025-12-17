<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiModel extends CI_Model {

    // Ambil semua data pegawai
    public function get_all_pegawai() 
    {
        $this->db->select('nik, nama');
        $this->db->from('pegawai');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get()->result_array();
    }

    // Ambil data pegawai berdasarkan NIK
    public function get_pegawai_by_nik($nik) {
        $this->db->select('nik, nama');
        $this->db->from('pegawai'); // Ganti dengan nama tabel pegawai Anda
        $this->db->where('nik', $nik);
        $this->db->where('is_active', 1); // Hanya ambil pegawai yang aktif
        return $this->db->get()->row_array();
    }

    // Cek apakah NIK sudah ada di tabel users
    public function check_user_exists($nik) {
        $this->db->select('id');
        $this->db->from('moizhospital_users');
        $this->db->where('username', $nik);
        return $this->db->get()->num_rows() > 0;
    }
}

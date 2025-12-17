<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisDokterMataRalanModel extends CI_Model
{
    private $table = 'penilaian_medis_ralan_mata';

    public function getHasil($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->order_by('tanggal', 'DESC')
                        ->get($this->table)
                        ->result_array();
    }

    public function getLastByNoRawat($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->order_by('tanggal', 'DESC')
                        ->get($this->table)
                        ->row_array();
    }

    public function getByNoRawat($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->get($this->table)
                        ->row_array();
    }

    public function getRiwayatByNoRM($no_rkm_medis)
    {
        return $this->db->select('p.*')
                        ->from($this->table.' p')
                        ->join('reg_periksa r', 'p.no_rawat = r.no_rawat')
                        ->where('r.no_rkm_medis', $no_rkm_medis)
                        ->order_by('p.tanggal', 'DESC')
                        ->get()->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // 🔁 Update berdasar no_rawat (tanpa mengubah kolom tanggal)
    public function updateByNoRawat($no_rawat, $data)
    {
        // Sekarang tanggal boleh ikut diubah
        return $this->db->where('no_rawat', $no_rawat)
                        ->update($this->table, $data);
    }


    public function deleteByNoRawat($no_rawat)
    {
        return $this->db->delete($this->table, ['no_rawat' => $no_rawat]);
    }

    public function exists($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->count_all_results($this->table) > 0;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisPenyakitDalamModel extends CI_Model
{

    public $table = 'penilaian_medis_ralan_penyakit_dalam';
    public $id = 'no_rawat';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil data by no_rawat
    public function get_by_no_rawat($no_rawat)
    {
        $this->db->where($this->id, $no_rawat);
        return $this->db->get($this->table)->row_array();
    }

    // Insert data
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data
    public function update($no_rawat, $data)
    {
        $this->db->where($this->id, $no_rawat);
        return $this->db->update($this->table, $data);
    }

    // Check exists
    public function exists($no_rawat)
    {
        $this->db->where($this->id, $no_rawat);
        return $this->db->count_all_results($this->table) > 0;
    }

    // Hapus data
    public function delete($no_rawat)
    {
        $this->db->where($this->id, $no_rawat);
        return $this->db->delete($this->table);
    }
}

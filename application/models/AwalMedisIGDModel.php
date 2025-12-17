<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisIGDModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_no_rawat($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)->get('penilaian_medis_igd')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('penilaian_medis_igd', $data);
    }

    public function update($no_rawat, $data)
    {
        return $this->db->where('no_rawat', $no_rawat)->update('penilaian_medis_igd', $data);
    }

    public function delete($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)->delete('penilaian_medis_igd');
    }

    public function exists($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)->count_all_results('penilaian_medis_igd') > 0;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisOrthopediModel extends CI_Model
{
    private $table = 'penilaian_medis_ralan_orthopedi';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_no_rawat($no_rawat)
    {
        return $this->db->get_where($this->table, ['no_rawat' => $no_rawat])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($no_rawat, $data)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update($this->table, $data);
    }

    public function delete($no_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->delete($this->table);
    }

    public function exists($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)->count_all_results($this->table) > 0;
    }
}

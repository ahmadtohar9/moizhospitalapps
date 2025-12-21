<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisRehabMedikModel extends CI_Model
{
    private $table = 'penilaian_medis_ralan_rehab_medik';

    public function get_by_no_rawat($no_rawat)
    {
        return $this->db->get_where($this->table, ['no_rawat' => $no_rawat])->row_array();
    }

    public function get_history($no_rkm_medis, $start_date = null, $end_date = null)
    {
        $this->db->select('a.*, d.nm_dokter');
        $this->db->from($this->table . ' a');
        $this->db->join('reg_periksa r', 'a.no_rawat = r.no_rawat', 'left');
        $this->db->join('dokter d', 'a.kd_dokter = d.kd_dokter', 'left');
        $this->db->where('r.no_rkm_medis', $no_rkm_medis);

        if ($start_date) {
            $this->db->where('DATE(a.tanggal) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(a.tanggal) <=', $end_date);
        }

        $this->db->order_by('a.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    public function exists($no_rawat)
    {
        return $this->db->get_where($this->table, ['no_rawat' => $no_rawat])->num_rows() > 0;
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
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormulirKfrModel extends CI_Model
{
    private $table = 'moizhospital_lembarKFR_rehabmedik';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_dokters()
    {
        return $this->db->get('dokter')->result_array();
    }

    public function get_by_no_rawat($no_rawat)
    {
        $this->db->select('r.*, d.nm_dokter');
        $this->db->from($this->table . ' r');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->where('r.no_rawat', $no_rawat);
        $this->db->order_by('r.tgl_perawatan', 'DESC');
        $this->db->order_by('r.jam_rawat', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_detail($no_rawat, $tgl, $jam)
    {
        $this->db->select('r.*, d.nm_dokter');
        $this->db->from($this->table . ' r');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->where('r.no_rawat', $no_rawat);
        $this->db->where('r.tgl_perawatan', $tgl);
        $this->db->where('r.jam_rawat', $jam);
        return $this->db->get()->row_array();
    }

    public function save($data)
    {
        // Prevent duplicate for same time
        $exists = $this->db->get_where($this->table, [
            'no_rawat' => $data['no_rawat'],
            'tgl_perawatan' => $data['tgl_perawatan'],
            'jam_rawat' => $data['jam_rawat']
        ]);

        if ($exists->num_rows() > 0) {
            return false;
        }

        return $this->db->insert($this->table, $data);
    }

    public function update($no_rawat, $tgl, $jam, $data)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tgl_perawatan', $tgl);
        $this->db->where('jam_rawat', $jam);
        return $this->db->update($this->table, $data);
    }

    public function delete($no_rawat, $tgl, $jam)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tgl_perawatan', $tgl);
        $this->db->where('jam_rawat', $jam);
        return $this->db->delete($this->table);
    }
}

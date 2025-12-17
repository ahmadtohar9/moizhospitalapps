<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RehabMedikModel extends CI_Model
{
    private $table = 'moizhospital_program_rehabmedik';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_dokters()
    {
        return $this->db->get('dokter')->result_array();
    }

    public function get_petugas()
    {
        return $this->db->get('petugas')->result_array();
    }

    public function get_by_no_rawat($no_rawat)
    {
        $this->db->select('r.*, d.nm_dokter, p.nama as nm_petugas');
        $this->db->from($this->table . ' r');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('petugas p', 'r.nip_tim_rehab = p.nip', 'left');
        $this->db->where('r.no_rawat', $no_rawat);
        $this->db->order_by('r.tgl_perawatan', 'DESC');
        $this->db->order_by('r.jam_rawat', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_detail($no_rawat, $tgl, $jam)
    {
        $this->db->select('r.*, d.nm_dokter, p.nama as nm_petugas, 
            s.tensi, s.nadi, s.suhu_tubuh, s.respirasi, s.tinggi, s.berat, s.spo2, s.gcs, 
            s.instruksi, s.evaluasi');
        $this->db->from($this->table . ' r');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('petugas p', 'r.nip_tim_rehab = p.nip', 'left');
        $this->db->join(
            'pemeriksaan_ralan s',
            'r.no_rawat = s.no_rawat AND r.tgl_perawatan = s.tgl_perawatan AND r.jam_rawat = s.jam_rawat',
            'left'
        );
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

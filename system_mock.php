<?php class CI_Controller {}; class CI_Model {};
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OperasiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_operasi_by_no_rawat($no_rawat)
    {
        $this->db->select("
            o.*,
            p.nm_perawatan AS nm_paket_operasi,
            d1.nm_dokter AS nm_operator1,
            d2.nm_dokter AS nm_operator2,
            d3.nm_dokter AS nm_operator3,
            d4.nm_dokter AS nm_dokter_anestesi
        ");
        $this->db->from('operasi o');
        $this->db->join('paket_operasi p', 'o.kode_paket = p.kode_paket', 'left');
        $this->db->join('dokter d1', 'o.operator1 = d1.kd_dokter', 'left');
        $this->db->join('dokter d2', 'o.operator2 = d2.kd_dokter', 'left');
        $this->db->join('dokter d3', 'o.operator3 = d3.kd_dokter', 'left');
        $this->db->join('dokter d4', 'o.dokter_anestesi = d4.kd_dokter', 'left');
        $this->db->where('o.no_rawat', $no_rawat);
        $this->db->order_by('o.tgl_operasi', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_paket_operasi()
    {
        return $this->db->select('kode_paket, nm_perawatan')
            ->from('paket_operasi')
            ->order_by('nm_perawatan', 'ASC')
            ->get()->result_array();
    }

    public function get_dokter()
    {
        return $this->db->select('kd_dokter, nm_dokter')
            ->from('dokter')
            ->where('status', '1') // Assuming active doctors have status 1
            ->order_by('nm_dokter', 'ASC')
            ->get()->result_array();
    }

    public function get_petugas()
    {
        return $this->db->select('nip, nama')
            ->from('petugas')
            ->order_by('nama', 'ASC')
            ->get()->result_array();
    }

    // --- LIMIT DATA FOR INITIAL LOAD ---
    public function get_dokter_limit($limit = 50)
    {
        return $this->db->select('kd_dokter, nm_dokter')
            ->from('dokter')
            ->where('status', '1')
            ->limit($limit)
            ->order_by('nm_dokter', 'ASC')
            ->get()->result_array();
    }

    public function get_petugas_limit($limit = 50)
    {
        return $this->db->select('nip, nama')
            ->from('petugas')
            ->limit($limit)
            ->order_by('nama', 'ASC')
            ->get()->result_array();
    }

    public function get_paket_operasi_limit($limit = 50)
    {
        return $this->db->select('kode_paket, nm_perawatan')
            ->from('paket_operasi')
            ->limit($limit)
            ->order_by('nm_perawatan', 'ASC')
            ->get()->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert('operasi', $data);
    }

    public function search_dokter($q)
    {
        $this->db->select('kd_dokter AS id, nm_dokter AS text');
        $this->db->from('dokter');
        $this->db->where('status', '1');
        $this->db->group_start();
        $this->db->like('nm_dokter', $q);
        $this->db->or_like('kd_dokter', $q);
        $this->db->group_end();
        $this->db->limit(20);
        return $this->db->get()->result_array();
    }

    public function search_petugas($q)
    {
        $this->db->select('nip AS id, nama AS text');
        $this->db->from('petugas');
        $this->db->group_start();
        $this->db->like('nama', $q);
        $this->db->or_like('nip', $q);
        $this->db->group_end();
        $this->db->limit(20);
        return $this->db->get()->result_array();
    }

    public function search_paket_operasi($q)
    {
        return $this->db->select('kode_paket AS id, nm_perawatan AS text')
            ->from('paket_operasi')
            ->like('nm_perawatan', $q)
            ->limit(20)
            ->get()->result_array();
    }

    // Deletion might need composite key. Assuming we delete by no_rawat and time? 
    // Or maybe just fail if we don't have a unique ID. 
    // Khanza operasi table usually has tgl_operasi as part of key.
    public function delete($no_rawat, $tgl_operasi)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tgl_operasi', $tgl_operasi);
        return $this->db->delete('operasi');
    }
}

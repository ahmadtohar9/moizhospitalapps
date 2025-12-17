<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianMedisMataModel extends CI_Model
{
    private $table = 'penilaian_medis_ralan_mata';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cek apakah sudah ada data untuk no_rawat tertentu
     */
    public function check_existing($no_rawat)
    {
        return $this->db->get_where($this->table, ['no_rawat' => $no_rawat])->row();
    }

    /**
     * Insert data baru
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update data
     */
    public function update($no_rawat, $data)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete data
     */
    public function delete($no_rawat)
    {
        return $this->db->delete($this->table, ['no_rawat' => $no_rawat]);
    }

    /**
     * Get data by no_rawat
     */
    public function get_by_no_rawat($no_rawat)
    {
        $this->db->select('penilaian_medis_ralan_mata.*, dokter.nm_dokter');
        $this->db->from($this->table);
        $this->db->join('dokter', 'penilaian_medis_ralan_mata.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('penilaian_medis_ralan_mata.no_rawat', $no_rawat);
        return $this->db->get()->row_array();
    }

    /**
     * Get riwayat by no_rkm_medis
     */
    public function get_riwayat_by_norm($no_rkm_medis)
    {
        $this->db->select('penilaian_medis_ralan_mata.*, dokter.nm_dokter, reg_periksa.tgl_registrasi');
        $this->db->from($this->table);
        $this->db->join('dokter', 'penilaian_medis_ralan_mata.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->join('reg_periksa', 'penilaian_medis_ralan_mata.no_rawat = reg_periksa.no_rawat', 'left');
        $this->db->where('reg_periksa.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('penilaian_medis_ralan_mata.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    /**
     * Get all data dengan join
     */
    public function get_all()
    {
        $this->db->select('penilaian_medis_ralan_mata.*, dokter.nm_dokter, pasien.nm_pasien, reg_periksa.tgl_registrasi');
        $this->db->from($this->table);
        $this->db->join('dokter', 'penilaian_medis_ralan_mata.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->join('reg_periksa', 'penilaian_medis_ralan_mata.no_rawat = reg_periksa.no_rawat', 'left');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->order_by('penilaian_medis_ralan_mata.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    /**
     * Get setting RS
     */
    public function get_setting()
    {
        return $this->db->get('setting')->row_array();
    }
}

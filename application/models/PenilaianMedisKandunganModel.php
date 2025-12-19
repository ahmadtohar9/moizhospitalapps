<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model untuk Penilaian Medis Ralan Kandungan (Obstetri & Ginekologi)
 * 
 * @package    Moiz Hospital Apps
 * @subpackage Models
 * @category   Medical Assessment
 * @author     Ahmad Tohar
 */
class PenilaianMedisKandunganModel extends CI_Model
{
    private $table = 'penilaian_medis_ralan_kandungan';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Simpan data penilaian baru
     */
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update data penilaian
     */
    public function update($no_rawat, $tanggal, $data)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tanggal', $tanggal);
        return $this->db->update($this->table, $data);
    }

    /**
     * Hapus data penilaian
     */
    public function delete($no_rawat, $tanggal)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tanggal', $tanggal);
        return $this->db->delete($this->table);
    }

    /**
     * Get data penilaian by no_rawat dan tanggal
     */
    public function get_by_id($no_rawat, $tanggal)
    {
        $this->db->select('p.*, d.nm_dokter');
        $this->db->from($this->table . ' p');
        $this->db->join('dokter d', 'd.kd_dokter = p.kd_dokter', 'left');
        $this->db->where('p.no_rawat', $no_rawat);
        $this->db->where('p.tanggal', $tanggal);

        return $this->db->get()->row_array();
    }

    /**
     * Get semua hasil penilaian untuk satu no_rawat
     */
    public function get_hasil_by_norawat($no_rawat)
    {
        $this->db->select('p.*, d.nm_dokter');
        $this->db->from($this->table . ' p');
        $this->db->join('dokter d', 'd.kd_dokter = p.kd_dokter', 'left');
        $this->db->where('p.no_rawat', $no_rawat);
        $this->db->order_by('p.tanggal', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Get riwayat penilaian by no_rkm_medis (untuk riwayat pasien)
     */
    public function get_riwayat_by_norm($no_rkm_medis, $limit = 10)
    {
        $this->db->select('p.*, d.nm_dokter, r.tgl_registrasi, r.jam_reg');
        $this->db->from($this->table . ' p');
        $this->db->join('reg_periksa r', 'r.no_rawat = p.no_rawat', 'left');
        $this->db->join('dokter d', 'd.kd_dokter = p.kd_dokter', 'left');
        $this->db->where('r.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('p.tanggal', 'DESC');
        $this->db->limit($limit);

        return $this->db->get()->result_array();
    }

    /**
     * Get data terakhir untuk auto-fill (copy last)
     */
    public function get_last_by_norm($no_rkm_medis)
    {
        $this->db->select('p.*');
        $this->db->from($this->table . ' p');
        $this->db->join('reg_periksa r', 'r.no_rawat = p.no_rawat', 'left');
        $this->db->where('r.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('p.tanggal', 'DESC');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    /**
     * Cek apakah sudah ada data untuk no_rawat + tanggal tertentu
     */
    public function is_exist($no_rawat, $tanggal)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tanggal', $tanggal);
        $count = $this->db->count_all_results($this->table);

        return $count > 0;
    }

    /**
     * Get data pasien untuk header form
     */
    public function get_pasien_info($no_rawat)
    {
        $this->db->select('r.no_rawat, r.no_rkm_medis, r.tgl_registrasi, r.jam_reg, 
                          r.umurdaftar, r.sttsumur,
                          p.nm_pasien, p.jk, p.tgl_lahir,
                          d.nm_dokter, d.kd_dokter, pol.nm_poli');
        $this->db->from('reg_periksa r');
        $this->db->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left');
        $this->db->join('dokter d', 'd.kd_dokter = r.kd_dokter', 'left');
        $this->db->join('poliklinik pol', 'pol.kd_poli = r.kd_poli', 'left');
        $this->db->where('r.no_rawat', $no_rawat);

        return $this->db->get()->row_array();
    }
}

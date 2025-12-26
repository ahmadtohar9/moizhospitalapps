<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanRekamMedisRawaJalan_model extends CI_Model
{

    /**
     * Get laporan with filters
     */
    public function get_laporan($filters = [])
    {
        $this->db->select('
            reg_periksa.no_rawat,
            reg_periksa.no_rkm_medis,
            reg_periksa.tgl_registrasi,
            reg_periksa.jam_reg,
            reg_periksa.status_bayar,
            reg_periksa.stts,
            reg_periksa.biaya_reg,
            pasien.nm_pasien,
            pasien.jk,
            pasien.tgl_lahir,
            pasien.alamat,
            pasien.no_tlp,
            dokter.nm_dokter,
            dokter.kd_dokter,
            penjab.png_jawab,
            penjab.kd_pj,
            poliklinik.nm_poli,
            poliklinik.kd_poli
        ');

        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        // Apply filters
        $this->apply_filters($filters);

        $this->db->order_by('reg_periksa.tgl_registrasi', 'DESC');
        $this->db->order_by('reg_periksa.jam_reg', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get count with filters
     */
    public function get_count($filters = [])
    {
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        // Apply filters
        $this->apply_filters($filters);

        return $this->db->count_all_results();
    }

    /**
     * Get statistics with filters
     */
    public function get_statistics($filters = [])
    {
        $stats = [];

        // Count by penjamin
        $this->db->select('penjab.png_jawab, COUNT(*) as jumlah');
        $this->db->from('reg_periksa');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->apply_filters($filters);
        $this->db->group_by('penjab.png_jawab');
        $this->db->order_by('jumlah', 'DESC');
        $stats['by_penjamin'] = $this->db->get()->result_array();

        // Count by dokter
        $this->db->select('dokter.nm_dokter, COUNT(*) as jumlah');
        $this->db->from('reg_periksa');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->apply_filters($filters);
        $this->db->group_by('dokter.nm_dokter');
        $this->db->order_by('jumlah', 'DESC');
        $stats['by_dokter'] = $this->db->get()->result_array();

        // Count by poli
        $this->db->select('poliklinik.nm_poli, COUNT(*) as jumlah');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->apply_filters($filters);
        $this->db->group_by('poliklinik.nm_poli');
        $this->db->order_by('jumlah', 'DESC');
        $stats['by_poli'] = $this->db->get()->result_array();

        // Count by status bayar
        $this->db->select('reg_periksa.status_bayar, COUNT(*) as jumlah');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->apply_filters($filters);
        $this->db->group_by('reg_periksa.status_bayar');
        $this->db->order_by('jumlah', 'DESC');
        $stats['by_status_bayar'] = $this->db->get()->result_array();

        return $stats;
    }

    /**
     * Apply filters to query
     */
    private function apply_filters($filters)
    {
        // Date range filter
        if (isset($filters['start_date']) && !empty($filters['start_date'])) {
            $this->db->where('DATE(reg_periksa.tgl_registrasi) >=', $filters['start_date']);
        }

        if (isset($filters['end_date']) && !empty($filters['end_date'])) {
            $this->db->where('DATE(reg_periksa.tgl_registrasi) <=', $filters['end_date']);
        }

        // Doctor filter (fuzzy match)
        if (isset($filters['dokter']) && !empty($filters['dokter'])) {
            $this->db->like('dokter.nm_dokter', $filters['dokter'], 'both');
        }

        // Penjamin filter (fuzzy match)
        if (isset($filters['penjamin']) && !empty($filters['penjamin'])) {
            $this->db->like('penjab.png_jawab', $filters['penjamin'], 'both');
        }

        // Poli filter (fuzzy match)
        if (isset($filters['poli']) && !empty($filters['poli'])) {
            $this->db->like('poliklinik.nm_poli', $filters['poli'], 'both');
        }

        // Status bayar filter
        if (isset($filters['status_bayar']) && !empty($filters['status_bayar'])) {
            $this->db->where('reg_periksa.status_bayar', $filters['status_bayar']);
        }

        // Status periksa filter
        if (isset($filters['status_periksa']) && !empty($filters['status_periksa'])) {
            $this->db->where('reg_periksa.stts', $filters['status_periksa']);
        }
    }

    /**
     * Get list of doctors
     */
    public function get_doctors($search = null)
    {
        $this->db->select('kd_dokter, nm_dokter');
        $this->db->from('dokter');

        if ($search) {
            $this->db->like('nm_dokter', $search, 'both');
        }

        $this->db->order_by('nm_dokter', 'ASC');
        $this->db->limit(20);

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get list of penjamin
     */
    public function get_penjamin()
    {
        $this->db->select('kd_pj, png_jawab');
        $this->db->from('penjab');
        $this->db->order_by('png_jawab', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get list of poli
     */
    public function get_poli()
    {
        $this->db->select('kd_poli, nm_poli');
        $this->db->from('poliklinik');
        $this->db->order_by('nm_poli', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get detail pasien by no_rawat
     */
    public function get_detail_pasien($no_rawat)
    {
        $this->db->select('
            reg_periksa.*,
            pasien.*,
            dokter.nm_dokter,
            penjab.png_jawab,
            poliklinik.nm_poli
        ');

        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.no_rawat', $no_rawat);

        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get data (alias for get_laporan but returns objects for PDF)
     */
    public function get_data($filters = [])
    {
        $this->db->select('
            reg_periksa.no_rawat,
            reg_periksa.no_rkm_medis,
            reg_periksa.tgl_registrasi,
            reg_periksa.jam_reg,
            reg_periksa.status_bayar,
            reg_periksa.stts,
            reg_periksa.biaya_reg,
            pasien.nm_pasien,
            pasien.jk,
            pasien.tgl_lahir,
            pasien.alamat,
            pasien.no_tlp,
            dokter.nm_dokter,
            dokter.kd_dokter,
            penjab.png_jawab,
            penjab.kd_pj,
            poliklinik.nm_poli,
            poliklinik.kd_poli
        ');

        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        // Apply filters
        $this->apply_filters($filters);

        $this->db->order_by('reg_periksa.tgl_registrasi', 'DESC');
        $this->db->order_by('reg_periksa.jam_reg', 'DESC');

        $query = $this->db->get();
        return $query->result(); // Return objects for PDF
    }
}

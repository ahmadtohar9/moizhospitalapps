<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model untuk mengelola antrian pasien rawat jalan
 * 
 * @package    MoizHospital
 * @subpackage Models
 * @category   Antrian
 * @author     Ahmad Tohar
 * @version    1.0.0
 */
class AntrianPoliModel extends CI_Model
{
    protected $table = 'moizhospital_antrian_poli';
    protected $view = 'view_antrian_poli_lengkap';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Generate nomor antrian otomatis
     * 
     * @param string $kd_poli Kode poliklinik
     * @param string $tgl_registrasi Tanggal registrasi (Y-m-d)
     * @return array ['no_antrian', 'prefix', 'urutan']
     */
    public function generate_nomor_antrian($kd_poli, $tgl_registrasi = null)
    {
        if (empty($tgl_registrasi)) {
            $tgl_registrasi = date('Y-m-d');
        }

        // Get prefix dari kode poli (huruf pertama)
        $prefix = strtoupper(substr($kd_poli, 0, 1));

        // Get urutan terakhir untuk poli dan tanggal ini
        $this->db->select_max('urutan_antrian');
        $this->db->where('kd_poli', $kd_poli);
        $this->db->where('DATE(tgl_registrasi)', $tgl_registrasi);
        $query = $this->db->get($this->table);
        $result = $query->row();

        $urutan = ($result && $result->urutan_antrian) ? $result->urutan_antrian + 1 : 1;

        // Format: PREFIX-XXX (misal: A-001, B-002)
        $no_antrian = $prefix . '-' . str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return [
            'no_antrian' => $no_antrian,
            'prefix' => $prefix,
            'urutan' => $urutan
        ];
    }

    /**
     * Insert antrian baru saat pasien registrasi
     * 
     * @param array $data Data registrasi pasien
     * @return bool|int Insert ID atau false jika gagal
     */
    public function insert_antrian($data)
    {
        // Get prefix from kd_poli
        $this->db->select('nm_poli');
        $this->db->from('poliklinik');
        $this->db->where('kd_poli', $data['kd_poli']);
        $poli = $this->db->get()->row_array();

        $prefix = $poli ? strtoupper(substr($poli['nm_poli'], 0, 1)) : 'X';
        $no_reg = isset($data['no_reg']) ? $data['no_reg'] : '001';
        $urutan = intval($no_reg);
        $no_antrian = $prefix . '-' . str_pad($no_reg, 3, '0', STR_PAD_LEFT);

        $insert_data = [
            'no_rawat' => $data['no_rawat'],
            'no_reg' => isset($data['no_reg']) ? $data['no_reg'] : null,
            'no_antrian' => $no_antrian,
            'prefix_antrian' => $prefix,
            'urutan_antrian' => $urutan,
            'kd_poli' => $data['kd_poli'],
            'kd_dokter' => $data['kd_dokter'],
            'no_rkm_medis' => $data['no_rkm_medis'],
            'tgl_registrasi' => isset($data['tgl_registrasi']) ? $data['tgl_registrasi'] : date('Y-m-d H:i:s'),
            'status_panggil' => 'Menunggu',
            'jumlah_panggil' => 0
        ];

        $this->db->insert($this->table, $insert_data);
        return $this->db->insert_id();
    }

    /**
     * Get antrian berdasarkan poli
     * 
     * @param string $kd_poli Kode poliklinik
     * @param string $tgl Tanggal (Y-m-d), default hari ini
     * @param string $status Status panggilan (optional)
     * @return array
     */
    public function get_antrian_by_poli($kd_poli, $tgl = null, $status = null)
    {
        if (empty($tgl)) {
            $tgl = date('Y-m-d');
        }

        $this->db->select('*');
        $this->db->from($this->view);
        $this->db->where('kd_poli', $kd_poli);
        $this->db->where('DATE(tgl_registrasi)', $tgl);

        if (!empty($status)) {
            $this->db->where('status_panggil', $status);
        }

        $this->db->order_by('urutan_antrian', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Get antrian berdasarkan dokter (langsung dari reg_periksa)
     * 
     * @param string $kd_dokter Kode dokter
     * @param string $tgl Tanggal (Y-m-d), default hari ini
     * @param string $status Status panggilan (optional)
     * @return array
     */
    public function get_antrian_by_dokter($kd_dokter, $tgl = null, $status = null)
    {
        if (empty($tgl)) {
            $tgl = date('Y-m-d');
        }

        // Query langsung dari reg_periksa
        $this->db->select('
            r.no_rawat,
            r.no_reg,
            r.no_rkm_medis,
            r.tgl_registrasi,
            r.jam_reg,
            r.kd_dokter,
            r.kd_poli,
            r.status_lanjut,
            r.stts as status_periksa,
            r.status_bayar,
            p.nm_pasien,
            p.jk,
            p.tgl_lahir,
            p.no_tlp,
            d.nm_dokter,
            pol.nm_poli,
            pj.png_jawab,
            CONCAT(UPPER(LEFT(r.kd_poli, 1)), "-", LPAD(r.no_reg, 3, "0")) as no_antrian
        ');
        $this->db->from('reg_periksa r');
        $this->db->join('pasien p', 'r.no_rkm_medis = p.no_rkm_medis', 'left');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('poliklinik pol', 'r.kd_poli = pol.kd_poli', 'left');
        $this->db->join('penjab pj', 'r.kd_pj = pj.kd_pj', 'left');
        $this->db->where('r.kd_dokter', $kd_dokter);
        $this->db->where('DATE(r.tgl_registrasi)', $tgl);
        $this->db->where('r.status_lanjut', 'Ralan');

        // Filter by status if provided
        if (!empty($status)) {
            $this->db->where('r.stts', $status);
        }

        $this->db->order_by('r.no_reg', 'ASC');
        $query = $this->db->get();

        $results = $query->result_array();

        // Add status_panggil based on stts
        foreach ($results as &$row) {
            $row['status_panggil'] = $this->map_status_periksa($row['status_periksa']);
        }

        return $results;
    }

    /**
     * Map status periksa ke status panggil
     */
    private function map_status_periksa($stts)
    {
        $mapping = [
            'Belum' => 'Menunggu',
            'Sudah' => 'Selesai',
            'Batal' => 'Batal',
            'Berkas Diterima' => 'Selesai',
            'Dirujuk' => 'Selesai',
            'Meninggal' => 'Selesai',
            'Dirawat' => 'Selesai',
            'Pulang Paksa' => 'Selesai'
        ];

        return isset($mapping[$stts]) ? $mapping[$stts] : 'Menunggu';
    }

    /**
     * Get semua antrian hari ini
     * 
     * @param string $tgl Tanggal (Y-m-d), default hari ini
     * @return array
     */
    public function get_all_antrian_today($tgl = null)
    {
        if (empty($tgl)) {
            $tgl = date('Y-m-d');
        }

        $this->db->select('*');
        $this->db->from($this->view);
        $this->db->where('DATE(tgl_registrasi)', $tgl);
        $this->db->order_by('kd_poli', 'ASC');
        $this->db->order_by('urutan_antrian', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Panggil pasien (update status)
     * 
     * @param string $no_rawat Nomor rawat
     * @param string $dipanggil_oleh User/dokter yang memanggil
     * @return bool
     */
    public function panggil_pasien($no_rawat, $dipanggil_oleh = null)
    {
        $update_data = [
            'status_panggil' => 'Dipanggil',
            'dipanggil_oleh' => $dipanggil_oleh,
            'terakhir_panggil' => date('Y-m-d H:i:s')
        ];

        // Cek apakah ini panggilan pertama
        $current = $this->get_antrian_by_no_rawat($no_rawat);
        if ($current && empty($current['tgl_panggil'])) {
            $update_data['tgl_panggil'] = date('Y-m-d H:i:s');
        }

        // Increment jumlah panggil
        if ($current) {
            $update_data['jumlah_panggil'] = $current['jumlah_panggil'] + 1;
        }

        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update($this->table, $update_data);
    }

    /**
     * Update status antrian
     * 
     * @param string $no_rawat Nomor rawat
     * @param string $status Status baru
     * @return bool
     */
    public function update_status($no_rawat, $status)
    {
        $allowed_status = ['Menunggu', 'Dipanggil', 'Sedang Diperiksa', 'Selesai', 'Batal', 'Tidak Hadir'];

        if (!in_array($status, $allowed_status)) {
            return false;
        }

        $update_data = ['status_panggil' => $status];

        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update($this->table, $update_data);
    }

    /**
     * Get antrian berdasarkan no_rawat
     * 
     * @param string $no_rawat Nomor rawat
     * @return array|null
     */
    public function get_antrian_by_no_rawat($no_rawat)
    {
        $this->db->select('*');
        $this->db->from($this->view);
        $this->db->where('no_rawat', $no_rawat);
        $query = $this->db->get();

        return $query->row_array();
    }

    /**
     * Get panggilan terakhir untuk display dashboard
     * 
     * @param int $limit Jumlah data
     * @param string $kd_poli Filter by poli (optional)
     * @return array
     */
    public function get_latest_panggilan($limit = 10, $kd_poli = null)
    {
        $this->db->select('*');
        $this->db->from($this->view);
        $this->db->where('status_panggil', 'Dipanggil');
        $this->db->where('DATE(tgl_registrasi)', date('Y-m-d'));

        if (!empty($kd_poli)) {
            $this->db->where('kd_poli', $kd_poli);
        }

        $this->db->order_by('terakhir_panggil', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Get antrian yang sedang menunggu
     * 
     * @param string $kd_poli Filter by poli (optional)
     * @param string $kd_dokter Filter by dokter (optional)
     * @return array
     */
    public function get_antrian_menunggu($kd_poli = null, $kd_dokter = null)
    {
        $this->db->select('*');
        $this->db->from($this->view);
        $this->db->where('status_panggil', 'Menunggu');
        $this->db->where('DATE(tgl_registrasi)', date('Y-m-d'));

        if (!empty($kd_poli)) {
            $this->db->where('kd_poli', $kd_poli);
        }

        if (!empty($kd_dokter)) {
            $this->db->where('kd_dokter', $kd_dokter);
        }

        $this->db->order_by('urutan_antrian', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Count antrian menunggu
     * 
     * @param string $kd_poli Kode poli
     * @param string $kd_dokter Kode dokter
     * @return int
     */
    public function count_antrian_menunggu($kd_poli = null, $kd_dokter = null)
    {
        $this->db->from($this->table);
        $this->db->where('DATE(tgl_registrasi)', date('Y-m-d'));
        $this->db->where_in('status_panggil', ['Menunggu', 'Dipanggil']);

        if (!empty($kd_poli)) {
            $this->db->where('kd_poli', $kd_poli);
        }

        if (!empty($kd_dokter)) {
            $this->db->where('kd_dokter', $kd_dokter);
        }

        return $this->db->count_all_results();
    }

    /**
     * Reset status antrian ke Menunggu
     * 
     * @param string $no_rawat Nomor rawat
     * @return bool
     */
    public function reset_antrian($no_rawat)
    {
        $update_data = [
            'status_panggil' => 'Menunggu',
            'tgl_panggil' => null,
            'terakhir_panggil' => null,
            'jumlah_panggil' => 0,
            'dipanggil_oleh' => null
        ];

        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update($this->table, $update_data);
    }

    /**
     * Get statistik antrian
     * 
     * @param string $tgl Tanggal (Y-m-d), default hari ini
     * @return array
     */
    public function get_statistik_antrian($tgl = null)
    {
        if (empty($tgl)) {
            $tgl = date('Y-m-d');
        }

        $this->db->select('
            COUNT(*) as total,
            SUM(CASE WHEN status_panggil = "Menunggu" THEN 1 ELSE 0 END) as menunggu,
            SUM(CASE WHEN status_panggil = "Dipanggil" THEN 1 ELSE 0 END) as dipanggil,
            SUM(CASE WHEN status_panggil = "Sedang Diperiksa" THEN 1 ELSE 0 END) as sedang_diperiksa,
            SUM(CASE WHEN status_panggil = "Selesai" THEN 1 ELSE 0 END) as selesai,
            SUM(CASE WHEN status_panggil = "Batal" THEN 1 ELSE 0 END) as batal,
            SUM(CASE WHEN status_panggil = "Tidak Hadir" THEN 1 ELSE 0 END) as tidak_hadir
        ');
        $this->db->from($this->table);
        $this->db->where('DATE(tgl_registrasi)', $tgl);
        $query = $this->db->get();

        return $query->row_array();
    }

    /**
     * Get list poli yang ada antrian hari ini
     * 
     * @param string $tgl Tanggal (Y-m-d), default hari ini
     * @return array
     */
    public function get_poli_with_antrian($tgl = null)
    {
        if (empty($tgl)) {
            $tgl = date('Y-m-d');
        }

        // Pakai query manual dengan JOIN biar gak perlu view
        $this->db->select('pol.kd_poli, pol.nm_poli, COUNT(*) as jumlah_antrian');
        $this->db->from($this->table . ' a');
        $this->db->join('poliklinik pol', 'a.kd_poli = pol.kd_poli', 'left');
        $this->db->where('DATE(a.tgl_registrasi)', $tgl);
        $this->db->group_by('pol.kd_poli, pol.nm_poli');
        $this->db->order_by('pol.nm_poli', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Check apakah pasien sudah ada di antrian
     * 
     * @param string $no_rawat Nomor rawat
     * @return bool
     */
    public function is_exist($no_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        $count = $this->db->count_all_results($this->table);
        return $count > 0;
    }

    /**
     * Delete antrian (jika diperlukan)
     * 
     * @param string $no_rawat Nomor rawat
     * @return bool
     */
    public function delete_antrian($no_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->delete($this->table);
    }
}

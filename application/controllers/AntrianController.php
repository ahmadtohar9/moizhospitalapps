<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AntrianController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('AntrianPoliModel');
    }

    /**
     * Dashboard display untuk TV
     */
    public function dashboard()
    {
        // Get hospital name only (skip logo for now)
        $this->db->select('nama_instansi');
        $this->db->from('setting');
        $this->db->limit(1);
        $query = $this->db->get();

        $result = $query->row_array();
        $data['hospital_name'] = $result['nama_instansi'] ?? 'Rumah Sakit';

        $this->load->view('antrian/dashboard_display', $data);
    }

    /**
     * Index - alias to dashboard
     */
    public function index()
    {
        $this->dashboard();
    }

    /**
     * Get latest call untuk dashboard TV
     */
    public function get_latest_call()
    {
        $this->db->select('*');
        $this->db->from('view_antrian_poli_lengkap');
        $this->db->where('DATE(tgl_panggil)', date('Y-m-d'));
        $this->db->where('status_panggil', 'Dipanggil');
        $this->db->order_by('terakhir_panggil', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get()->row_array();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result ? [$result] : []
            ]));
    }

    /**
     * Panggil pasien - insert/update ke moizhospital_antrian_poli
     */
    public function panggil_pasien()
    {
        $no_rawat = $this->input->post('no_rawat');

        if (empty($no_rawat)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'No rawat tidak boleh kosong'
                ]));
            return;
        }

        // Cek apakah sudah ada di tabel antrian
        $existing = $this->AntrianPoliModel->get_antrian_by_no_rawat($no_rawat);

        if ($existing) {
            // Sudah ada, panggil ulang
            $result = $this->AntrianPoliModel->panggil_pasien($no_rawat);
        } else {
            // Belum ada, insert baru dari reg_periksa
            $this->db->select('no_rawat, no_reg, no_rkm_medis, kd_poli, kd_dokter, tgl_registrasi');
            $this->db->from('reg_periksa');
            $this->db->where('no_rawat', $no_rawat);
            $reg_data = $this->db->get()->row_array();

            if (!$reg_data) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Data registrasi tidak ditemukan'
                    ]));
                return;
            }

            // Insert ke antrian
            $insert_id = $this->AntrianPoliModel->insert_antrian($reg_data);

            if ($insert_id) {
                // Langsung panggil
                $result = $this->AntrianPoliModel->panggil_pasien($no_rawat);
            } else {
                $result = false;
            }
        }

        if ($result) {
            // Get data lengkap untuk response
            $data = $this->AntrianPoliModel->get_antrian_by_no_rawat($no_rawat);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'message' => 'Pasien berhasil dipanggil',
                    'data' => $data
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Gagal memanggil pasien'
                ]));
        }
    }

    /**
     * Get antrian menunggu untuk dashboard TV
     */
    public function get_antrian_menunggu()
    {
        // Ambil dari reg_periksa yang belum dipanggil hari ini
        $this->db->select('
            r.no_rawat,
            r.no_reg,
            p.nm_pasien,
            pol.nm_poli,
            d.nm_dokter,
            CONCAT(UPPER(LEFT(r.kd_poli, 1)), "-", LPAD(r.no_reg, 3, "0")) as no_antrian
        ');
        $this->db->from('reg_periksa r');
        $this->db->join('pasien p', 'r.no_rkm_medis = p.no_rkm_medis', 'left');
        $this->db->join('poliklinik pol', 'r.kd_poli = pol.kd_poli', 'left');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left');
        $this->db->where('DATE(r.tgl_registrasi)', date('Y-m-d'));
        $this->db->where('r.stts', 'Belum');
        // Exclude yang sudah ada di antrian_poli
        $this->db->where('r.no_rawat NOT IN (SELECT no_rawat FROM moizhospital_antrian_poli WHERE DATE(tgl_panggil) = CURDATE())', NULL, FALSE);
        $this->db->order_by('r.no_reg', 'ASC');
        $this->db->limit(10);

        $results = $this->db->get()->result_array();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $results
            ]));
    }

    /**
     * Get hospital info from setting table
     */
    public function get_hospital_info()
    {
        $this->db->select('nama_instansi, logo');
        $this->db->from('setting');
        $this->db->limit(1);

        $result = $this->db->get()->row_array();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result
            ]));
    }

    /**
     * Get doctor queues - grouped by doctor AND poli
     */
    public function get_doctor_queues()
    {
        // Get all unique doctor-poli combinations with patients today
        $sql = "
            SELECT DISTINCT
                d.kd_dokter,
                d.nm_dokter,
                pol.kd_poli,
                pol.nm_poli
            FROM reg_periksa r
            LEFT JOIN dokter d ON r.kd_dokter = d.kd_dokter
            LEFT JOIN poliklinik pol ON r.kd_poli = pol.kd_poli
            WHERE DATE(r.tgl_registrasi) = CURDATE()
            ORDER BY d.nm_dokter ASC, pol.nm_poli ASC
        ";

        $doctors = $this->db->query($sql)->result_array();

        // For each doctor-poli combination, get their patients
        foreach ($doctors as &$doctor) {
            $sql_patients = "
                SELECT
                    r.no_rawat,
                    r.no_reg,
                    p.nm_pasien,
                    pj.png_jawab,
                    CONCAT(UPPER(LEFT(r.kd_poli, 1)), '-', LPAD(r.no_reg, 3, '0')) as no_antrian,
                    CASE
                        WHEN ap.no_rawat IS NOT NULL THEN 'Dipanggil'
                        ELSE 'Menunggu'
                    END as status_panggil
                FROM reg_periksa r
                LEFT JOIN pasien p ON r.no_rkm_medis = p.no_rkm_medis
                LEFT JOIN penjab pj ON r.kd_pj = pj.kd_pj
                LEFT JOIN moizhospital_antrian_poli ap ON r.no_rawat = ap.no_rawat AND DATE(ap.tgl_panggil) = CURDATE()
                WHERE DATE(r.tgl_registrasi) = CURDATE()
                AND r.kd_dokter = ?
                AND r.kd_poli = ?
                AND r.stts = 'Belum'
                ORDER BY r.no_reg ASC
            ";

            $doctor['patients'] = $this->db->query($sql_patients, [
                $doctor['kd_dokter'],
                $doctor['kd_poli']
            ])->result_array();
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $doctors
            ]));
    }
}

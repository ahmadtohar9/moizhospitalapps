<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiagnosaProsedurRalanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DiagnosaProsedurRalanModel');
        $this->load->model('MenuModel');
        $this->load->model('RekamMedisRalanModel');
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        // Ambil detail pasien berdasarkan no_rawat
        $detail = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$detail) {
            show_error('Data pasien tidak ditemukan.', 404);
            return;
        }

        // Simpan ke session agar dapat digunakan ulang di JS
        $this->session->set_userdata('no_rawat', $no_rawat);
        $this->session->set_userdata('no_rkm_medis', $detail['no_rkm_medis']);

        // Data untuk view
        $data = [
            'no_rawat'      => $no_rawat,
            'kd_dokter'     => $detail['kd_dokter'],
            'no_rkm_medis'  => $detail['no_rkm_medis'],
            'menus'         => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus'  => $this->MenuModel->get_active_action_menus()
        ];

        $this->load->view('rekammedis/dokter/diagnosaProsedurRalan', $data);
    }


    // === DIAGNOSA ===
    public function getDiagnosa() {
        $term = $this->input->get('term');
        $result = $this->DiagnosaProsedurRalanModel->searchDiagnosa($term);
        echo json_encode($result);
    }

    public function saveDiagnosa()
    {
        $no_rawat     = $this->input->post('no_rawat');
        $kd_penyakit  = $this->input->post('kd_penyakit');

        // Validasi input
        if (empty($no_rawat) || empty($kd_penyakit)) {
            echo json_encode([
                'success' => false,
                'message' => 'Data diagnosa tidak lengkap.'
            ]);
            return;
        }

        // Siapkan data untuk model
        $data = [
            'no_rawat'    => $no_rawat,
            'kd_penyakit' => $kd_penyakit
        ];

        // Proses simpan
        try {
            $result = $this->DiagnosaProsedurRalanModel->saveDiagnosa($data);

            if ($result === 'duplicate') {
                echo json_encode([
                    'success' => false,
                    'message' => 'Diagnosa sudah pernah dimasukkan.'
                ]);
            } elseif ($result === true) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan diagnosa.'
                ]);
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteDiagnosa()
    {
        $no_rawat    = $this->input->post('no_rawat');
        $kd_penyakit = $this->input->post('kd_penyakit');
        $status      = 'Ralan';

        if (empty($no_rawat) || empty($kd_penyakit)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
            return;
        }

        $deleted = $this->DiagnosaProsedurRalanModel->deleteDiagnosa($no_rawat, $kd_penyakit, $status);

        echo json_encode([
            'success' => $deleted,
            'message' => $deleted ? 'Berhasil dihapus.' : 'Gagal menghapus diagnosa.'
        ]);
    }


    public function getHasilDiagnosa() {
        $no_rawat = $this->input->get('no_rawat');
        $result = $this->DiagnosaProsedurRalanModel->getHasilDiagnosa($no_rawat);
        echo json_encode($result);
    }

    public function getRiwayatDiagnosaByNorm() {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $result = $this->DiagnosaProsedurRalanModel->getRiwayatDiagnosaByNorm($no_rkm_medis);
        echo json_encode($result);
    }


    // === PROSEDUR ===
    public function getProsedur()
    {
        $term = $this->input->get('term');
        $result = $this->DiagnosaProsedurRalanModel->searchProsedur($term);
        echo json_encode($result);
    }

    public function saveProsedur()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kode     = $this->input->post('kode');
        $status   = 'Ralan';

        if (empty($no_rawat) || empty($kode)) {
            echo json_encode([
                'success' => false,
                'message' => 'Data prosedur tidak lengkap.'
            ]);
            return;
        }

        $data = [
            'no_rawat' => $no_rawat,
            'kode'     => $kode,
            'status'   => $status
        ];

        try {
            $result = $this->DiagnosaProsedurRalanModel->saveProsedur($data);

            if ($result === 'duplicate') {
                echo json_encode([
                    'success' => false,
                    'message' => 'Prosedur sudah pernah dimasukkan.'
                ]);
            } elseif ($result === true) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan prosedur.'
                ]);
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function getHasilProsedur()
    {
        $no_rawat = $this->input->get('no_rawat');
        $result = $this->DiagnosaProsedurRalanModel->getHasilProsedur($no_rawat);
        echo json_encode($result);
    }

    public function getRiwayatProsedurByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $result = $this->DiagnosaProsedurRalanModel->getRiwayatProsedurByNorm($no_rkm_medis);
        echo json_encode($result);
    }

    public function deleteProsedur()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kode     = $this->input->post('kode');
        $status   = 'Ralan';

        if (empty($no_rawat) || empty($kode)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
            return;
        }

        $deleted = $this->DiagnosaProsedurRalanModel->deleteProsedur($no_rawat, $kode, $status);

        echo json_encode([
            'success' => $deleted,
            'message' => $deleted ? 'Berhasil dihapus.' : 'Gagal menghapus prosedur.'
        ]);
    }

}
?>

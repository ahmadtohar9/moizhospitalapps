<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanLabRalanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PermintaanLabRalanModel');
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

        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        $detail = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$detail) {
            show_error('Data pasien tidak ditemukan.', 404);
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);
        $this->session->set_userdata('no_rkm_medis', $detail['no_rkm_medis']);

        $data = [
            'no_rawat' => $no_rawat,
            'kd_dokter' => $detail['kd_dokter'],
            'no_rkm_medis' => $detail['no_rkm_medis'],
            'umurdaftar' => $detail['umurdaftar'],
            'jk' => $detail['jk'],
            'menus' => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus' => $this->MenuModel->get_active_action_menus()
        ];

        $this->load->view('rekammedis/dokter/permintaanLabRalan_form', $data);
    }

    public function getJenisPemeriksaanLab() {
        $result = $this->PermintaanLabRalanModel->getJenisPemeriksaanLab();
        echo json_encode($result);
    }

    public function savePermintaanLab() 
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (
            !isset($data['no_rawat']) ||
            !isset($data['kd_dokter']) ||
            !isset($data['pemeriksaan']) ||
            !isset($data['informasi_tambahan']) ||
            !isset($data['diagnosa_klinis'])
        ) {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $no_rawat = $data['no_rawat'];
        $kd_dokter = $data['kd_dokter'];
        $pemeriksaan = $data['pemeriksaan'];
        $informasi = $data['informasi_tambahan'];
        $diagnosa = $data['diagnosa_klinis'];

        $tgl_permintaan = date('Y-m-d');
        $jam_permintaan = date('H:i:s');
        $noorder = $this->PermintaanLabRalanModel->generateNoOrderLab();

        // Simpan ke permintaan_lab
        $this->PermintaanLabRalanModel->insertPermintaanLab(
            $noorder, $no_rawat, $tgl_permintaan, $jam_permintaan, $kd_dokter, $informasi, $diagnosa
        );

        foreach ($pemeriksaan as $item) {
            $kd_jenis_prw = $item['kd_jenis_prw'];

            // Simpan jenis
            $this->PermintaanLabRalanModel->insertPemeriksaan($noorder, $kd_jenis_prw);

            // Simpan template
            if (!empty($item['template']) && is_array($item['template'])) {
                foreach ($item['template'] as $id_template) {
                    $this->PermintaanLabRalanModel->insertDetailPermintaan($noorder, $kd_jenis_prw, $id_template);
                }
            }
        }

        echo json_encode(['status' => true, 'message' => 'Permintaan lab berhasil disimpan']);
    }


    public function getHasilPermintaanLab() {
        $no_rawat = $this->input->get('no_rawat');
        $hasil = $this->PermintaanLabRalanModel->getHasilPermintaanLab($no_rawat);
        echo json_encode($hasil);
    }


    public function getRiwayatGrouped()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $limit        = $this->input->get('limit'); // opsional

        if (!$no_rkm_medis) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => false, 'message' => 'no_rkm_medis wajib diisi.']));
        }

        $data = $this->PermintaanLabRalanModel->getRiwayatGroupedByOrder($no_rkm_medis, $limit);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    public function get_single_permintaan() 
    {
        $noorder = $this->input->get('noorder');
        $data = $this->PermintaanLabRalanModel->getSinglePermintaan($noorder);
        echo json_encode($data);
    }

    public function deletePermintaanLab() {
        $noorder = $this->input->post('noorder');
        $this->PermintaanLabRalanModel->deletePermintaanLab($noorder);
        echo json_encode(['status' => true, 'message' => 'Permintaan lab berhasil dihapus']);
    }

    public function getRiwayatByNoRm($no_rkm_medis) {
        $riwayat = $this->PermintaanLabRalanModel->getRiwayatLabByNoRm($no_rkm_medis);
        echo json_encode($riwayat);
    }

    public function get_template_by_jenis($kd_jenis_prw)
    {
        $data = $this->PermintaanLabRalanModel->getTemplateByJenis($kd_jenis_prw);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }


}

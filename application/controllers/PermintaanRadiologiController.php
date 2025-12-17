<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanRadiologiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PermintaanRadiologiModel');
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
            'menus' => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus' => $this->MenuModel->get_active_action_menus()
        ];

        $this->load->view('rekammedis/dokter/permintaanRadiologi_form', $data);
    }

    public function save() {
        $post = $this->input->post();
        $noorder = $this->generate_no_order();

        $header = [
            'noorder' => $noorder,
            'no_rawat' => $post['no_rawat'],
            'tgl_permintaan' => date('Y-m-d'),
            'jam_permintaan' => date('H:i:s'),
            'dokter_perujuk' => $post['kd_dokter'],
            'status' => 'ralan',
            'informasi_tambahan' => $post['informasi_tambahan'],
            'diagnosa_klinis' => $post['diagnosa_klinis']
        ];

        $detail = $post['kd_jenis_prw'];

        $saved = $this->PermintaanRadiologiModel->insert_radiologi($header, $detail);

        echo json_encode(['success' => $saved]);
    }

    private function generate_no_order() {
        $this->db->select('MAX(noorder) as last_order');
        $this->db->like('noorder', 'PR' . date('Ymd'));
        $query = $this->db->get('permintaan_radiologi');
        $last_order = $query->row()->last_order;

        if ($last_order) {
            $last_number = (int) substr($last_order, -4);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'PR' . date('Ymd') . sprintf('%04d', $new_number);
    }

    public function get_list_radiologi() {
        echo json_encode($this->PermintaanRadiologiModel->get_list_radiologi());
    }

    public function getRiwayatRadiologiByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $result = $this->PermintaanRadiologiModel->getRiwayatRadiologiByNorm($no_rkm_medis);
        echo json_encode($result);
    }

    public function deleteRadiologi()
    {
        $noorder = $this->input->post('noorder');
        $kd_jenis_prw = $this->input->post('kd_jenis_prw');
        $deleted = $this->PermintaanRadiologiModel->deleteRadiologi($noorder, $kd_jenis_prw);
        echo json_encode(['success' => $deleted]);
    }


}
?>

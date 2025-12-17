<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TindakanRalanDokterController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TindakanRalanDokterModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Tindakan Dokter Ralan';
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();
        $data['no_rawat'] = $this->session->userdata('no_rawat');

        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail($data['no_rawat']);
            $data['detail_pasien'] = $detail_pasien;
            $data['no_rkm_medis'] = $detail_pasien['no_rkm_medis'];
            $data['kd_dokter'] = $detail_pasien['kd_dokter'] ?? '';
        }


        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('rekammedis/dokter/tindakanRalan', $data);
        $this->load->view('templates/footer');
    }

    public function getTindakan()
    {
        $data = $this->TindakanRalanDokterModel->getAllTindakan();
        echo json_encode([
            'status' => !empty($data) ? 'success' : 'empty',
            'data' => $data
        ]);
    }

    public function saveTindakan()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kd_dokter = $this->input->post('kd_dokter');
        $tindakan = $this->input->post('tindakan');

        if (empty($no_rawat) || empty($kd_dokter) || empty($tindakan)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
            return;
        }

        $data = [];
        foreach ($tindakan as $t) {
            $data[] = [
                'no_rawat'        => $no_rawat,
                'kd_jenis_prw'    => $t['kd_jenis_prw'],
                'kd_dokter'       => $kd_dokter, // Tetap gunakan dari form
                'tgl_perawatan'   => $t['tgl_perawatan'],
                'jam_rawat'       => $t['jam_rawat'],
                'material'        => $t['material'],
                'bhp'             => $t['bhp'],
                'tarif_tindakandr'=> $t['tarif_tindakandr'],
                'kso'             => $t['kso'],
                'menejemen'       => $t['menejemen'],
                'biaya_rawat'     => $t['biaya_rawat'],
                'stts_bayar'      => 'Belum'
            ];
        }

        $this->TindakanRalanDokterModel->saveTindakan($data);
        echo json_encode(['status' => 'success', 'message' => 'Tindakan berhasil disimpan.']);
    }


    public function getHasilTindakan()
    {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->TindakanRalanDokterModel->getHasilTindakan($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function deleteTindakan()
    {
        $items = $this->input->post('items');

        if (empty($items)) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dipilih.']);
            return;
        }

        foreach ($items as $item) {
            $this->TindakanRalanDokterModel->deleteTindakan(
                $item['no_rawat'],
                $item['kd_jenis_prw'],
                $item['tgl_perawatan'],
                $item['jam_rawat']
            );
        }

        echo json_encode(['status' => 'success', 'message' => 'Tindakan berhasil dihapus.']);
    }

    public function getRiwayatTindakanByNorm() 
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        log_message('debug', '✅ getRiwayatTindakanByNorm: ' . $no_rkm_medis); // Tambah ini
        $data = $this->TindakanRalanDokterModel->getRiwayatTindakanByNorm($no_rkm_medis);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }


}
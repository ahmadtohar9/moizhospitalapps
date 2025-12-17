<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesertaController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Bpjs/Vclaim');
        $this->load->model('MenuModel');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Cek Kepesertaan BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/peserta/index', $data);
        $this->load->view('templates/footer');
    }

    public function cek_peserta()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $type = $this->input->post('type'); // 'kartu' or 'nik'
        $nomor = $this->input->post('nomor');
        $tgl_sep = $this->input->post('tgl_sep');

        if (empty($tgl_sep)) {
            $tgl_sep = date('Y-m-d');
        }

        if (empty($nomor)) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'Nomor Kartu/NIK tidak boleh kosong']]);
            return;
        }

        if ($type == 'nik') {
            $response = $this->vclaim->peserta_nik($nomor, $tgl_sep);
        } else {
            $response = $this->vclaim->peserta_nokartu($nomor, $tgl_sep);
        }

        // Return raw response for frontend to handle
        echo json_encode($response);
    }
}

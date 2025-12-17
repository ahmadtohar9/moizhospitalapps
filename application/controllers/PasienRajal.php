<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienRajal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PasienRajal_model'); // Load model
        $this->load->model('SettingModel');
        $this->load->model('MenuModel');

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    public function index() {
        // Ambil data penjamin untuk dropdown
        $data['penjab_list'] = $this->PasienRajal_model->get_penjamin();
        $data['nama_user']       = $this->session->userdata('nama_user');
        $role_id                 = $this->session->userdata('role_id');
        $data['menus']           = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title']           = 'Daftar Pasien Rawat Jalan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('rekammedis/pasien_rajal', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() 
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');
        $status_bayar = $this->input->get('status_bayar');
        $status_periksa = $this->input->get('status_periksa');

        // Ambil data pasien berdasarkan filter
        $data = $this->PasienRajal_model->get_pasien_rajal($start_date, $end_date, $penjab, $status_bayar, $status_periksa);

        echo json_encode($data);
    }
}
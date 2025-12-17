<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('MenuModel');
    }

    public function index() 
    {
        $role_id = $this->session->userdata('role_id'); // Ambil role_id dari session

        $data['title'] = 'Dashboard User';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Access control is now handled by menu permissions
        // All logged-in users (Admin, Perawat, Dokter) can access dashboard
        // But they will only see menus they have permission for

        $this->load->model('MenuModel');
    }

    public function index()
    {

        $data['title'] = 'Dashboard Admin';
        $data['nama_user'] = $this->session->userdata('nama_user');

        $user_id = $this->session->userdata('user_id'); // Ambil user_id dari session
        $role_id = $this->session->userdata('role_id'); // Ambil role_id dari session
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
}

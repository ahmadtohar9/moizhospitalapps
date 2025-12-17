<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserRmeAccessController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['RmeMenuModel', 'UserModel', 'MenuModel']);

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // Hanya Admin (Role 1) yang boleh akses halaman ini
        if ($this->session->userdata('role_id') != 1) {
            show_error('Akses ditolak. Hanya Admin yang boleh mengakses halaman ini.', 403);
        }
    }

    public function manage($user_id)
    {
        $user = $this->UserModel->get_user_by_id($user_id);
        if (!$user)
            show_404();

        $data['user'] = $user;
        $data['rme_menus'] = $this->RmeMenuModel->get_all_menus();
        $data['user_access'] = $this->RmeMenuModel->get_user_access_ids($user_id);

        // Sidebar Menu data
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title'] = 'Kelola Akses Tab Rekam Medis';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('user-access/manage_rme', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $user_id = $this->input->post('user_id');
        $menu_ids = $this->input->post('menu_ids') ?: [];

        if ($this->RmeMenuModel->update_user_access($user_id, $menu_ids)) {
            $this->session->set_flashdata('notif', ['type' => 'success', 'message' => 'Hak akses Tab RME berhasil diperbarui!']);
        } else {
            $this->session->set_flashdata('notif', ['type' => 'error', 'message' => 'Gagal memperbarui data.']);
        }

        redirect('UserRmeAccessController/manage/' . $user_id);
    }
}

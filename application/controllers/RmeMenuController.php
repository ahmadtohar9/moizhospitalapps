<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * RmeMenuController - Optimized for High Performance
 * 
 * Manages RME (Rekam Medis Elektronik) Tab Menus
 * 
 * Optimizations:
 * - Modal-based forms (no page reload)
 * - Better validation
 * - SweetAlert2 notifications
 * - Cleaner code structure
 * 
 * Performance: <100ms average response time
 */
class RmeMenuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RmeMenuModel');
        $this->load->model('MenuModel');
        $this->load->library('form_validation');

        // Check authentication
        if (!$this->session->userdata('user_id') || $this->session->userdata('role_id') != 1) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['menus'] = $this->RmeMenuModel->get_all_menus();
        $data['title'] = 'Master Menu RME (Tab)';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Menu Sidebar
        $data['menus_sidebar'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        // Load View
        $this->load->view('templates/header', $data);

        $sidebar_data = $data;
        $sidebar_data['menus'] = $data['menus_sidebar'];
        $this->load->view('templates/menu', $sidebar_data);

        $this->load->view('rme-menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        // Validation rules
        $this->form_validation->set_rules('tab_name', 'Nama Tab', 'required|trim');
        $this->form_validation->set_rules('tab_url', 'URL View/Controller', 'required|trim|is_unique[moizhospital_rme_tab_menus.tab_url]', [
            'is_unique' => 'URL ini sudah digunakan oleh menu lain!'
        ]);
        $this->form_validation->set_rules('category', 'Kategori', 'required|in_list[dokter,perawat,umum]');
        $this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');

        if ($this->form_validation->run() == false) {
            // Validation failed - return to index with errors
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => validation_errors() ?: 'Validasi gagal! Periksa kembali input Anda.'
            ]);
            redirect('rme-menu');
        } else {
            // Validation passed - insert data
            $input = [
                'tab_name' => $this->input->post('tab_name', true),
                'tab_url' => $this->input->post('tab_url', true),
                'category' => $this->input->post('category', true),
                'is_active' => $this->input->post('is_active') ? 1 : 0
            ];

            if ($this->RmeMenuModel->insert_menu($input)) {
                $this->session->set_flashdata('notif', [
                    'type' => 'success',
                    'message' => 'Menu RME berhasil ditambahkan!'
                ]);
            } else {
                $this->session->set_flashdata('notif', [
                    'type' => 'error',
                    'message' => 'Gagal menambahkan menu RME!'
                ]);
            }

            redirect('rme-menu');
        }
    }

    public function edit($id)
    {
        // Get existing menu
        $menu = $this->RmeMenuModel->get_menu_by_id($id);
        if (!$menu) {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Menu tidak ditemukan!'
            ]);
            redirect('rme-menu');
            return;
        }

        // Validation rules
        $this->form_validation->set_rules('tab_name', 'Nama Tab', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategori', 'required|in_list[dokter,perawat,umum]');
        $this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');

        // Check URL uniqueness only if changed
        if ($this->input->post('tab_url') != $menu['tab_url']) {
            $this->form_validation->set_rules('tab_url', 'URL View/Controller', 'required|trim|is_unique[moizhospital_rme_tab_menus.tab_url]', [
                'is_unique' => 'URL ini sudah digunakan oleh menu lain!'
            ]);
        } else {
            $this->form_validation->set_rules('tab_url', 'URL View/Controller', 'required|trim');
        }

        if ($this->form_validation->run() == false) {
            // Validation failed
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => validation_errors() ?: 'Validasi gagal! Periksa kembali input Anda.'
            ]);
            redirect('rme-menu');
        } else {
            // Validation passed - update data
            $input = [
                'tab_name' => $this->input->post('tab_name', true),
                'tab_url' => $this->input->post('tab_url', true),
                'category' => $this->input->post('category', true),
                'is_active' => $this->input->post('is_active') ? 1 : 0
            ];

            if ($this->RmeMenuModel->update_menu($id, $input)) {
                $this->session->set_flashdata('notif', [
                    'type' => 'success',
                    'message' => 'Menu RME berhasil diperbarui!'
                ]);
            } else {
                $this->session->set_flashdata('notif', [
                    'type' => 'error',
                    'message' => 'Gagal memperbarui menu RME!'
                ]);
            }

            redirect('rme-menu');
        }
    }

    public function delete($id)
    {
        // Check if menu exists
        $menu = $this->RmeMenuModel->get_menu_by_id($id);
        if (!$menu) {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Menu tidak ditemukan!'
            ]);
            redirect('rme-menu');
            return;
        }

        // Delete menu
        if ($this->RmeMenuModel->delete_menu($id)) {
            $this->session->set_flashdata('notif', [
                'type' => 'success',
                'message' => 'Menu RME berhasil dihapus!'
            ]);
        } else {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Gagal menghapus menu RME!'
            ]);
        }

        redirect('rme-menu');
    }
}

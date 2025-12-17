<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuManager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        // Pastikan hanya admin (role_id = 1) yang bisa mengakses
        if ($this->session->userdata('role_id') != 1) {
            show_error('Akses ditolak! Halaman ini hanya dapat diakses oleh admin.', 403, 'Error');
        }
    }


    public function index()
    {
        // Load semua menu untuk ditampilkan ke admin
        $role_id = $this->session->userdata('role_id');
        $data['all_menus'] = $this->MenuModel->get_all_menus(); // Untuk tabel & dropdown management
        $data['title'] = 'Menu Management';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')); // Untuk sidebar admin sendiri
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function save()
    {
        // Get parent_id
        $parent_id = $this->input->post('parent_id') ?: null;

        // ✅ VALIDASI: Cek jika parent_id ada, pastikan parent menu exists
        if ($parent_id !== null) {
            $parent_menu = $this->MenuModel->get_menu_by_id($parent_id);
            if (!$parent_menu) {
                $this->session->set_flashdata('notif', [
                    'type' => 'error',
                    'message' => 'Parent menu tidak ditemukan! Silakan pilih parent menu yang valid.'
                ]);
                redirect('menu-manager');
                return;
            }
        }

        // Data untuk disimpan
        $menu_data = [
            'menu_name' => $this->input->post('menu_name'),
            'menu_url' => $this->input->post('menu_url'),
            'icon' => $this->input->post('icon'),
            'parent_id' => $parent_id,
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'is_aksi_form' => $this->input->post('is_aksi_form') ? 1 : 0,
            'menurm' => $this->input->post('menurm') ?: null,
        ];

        // Simpan data
        if ($this->MenuModel->insert_menu($menu_data)) {
            $this->session->set_flashdata('notif', ['type' => 'success', 'message' => 'Menu berhasil ditambahkan!']);
        } else {
            $this->session->set_flashdata('notif', ['type' => 'error', 'message' => 'Menu gagal ditambahkan!']);
        }
        redirect('menu-manager');
    }

    public function update($id)
    {
        // Get parent_id
        $parent_id = $this->input->post('parent_id') ?: null;

        // ✅ VALIDASI 1: Cegah circular reference (menu tidak boleh jadi parent dirinya sendiri)
        if ($parent_id !== null && $parent_id == $id) {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Error! Menu tidak boleh menjadi parent dari dirinya sendiri (circular reference).'
            ]);
            redirect('menu-manager');
            return;
        }

        // ✅ VALIDASI 2: Cek jika parent_id ada, pastikan parent menu exists
        if ($parent_id !== null) {
            $parent_menu = $this->MenuModel->get_menu_by_id($parent_id);
            if (!$parent_menu) {
                $this->session->set_flashdata('notif', [
                    'type' => 'error',
                    'message' => 'Parent menu tidak ditemukan! Silakan pilih parent menu yang valid.'
                ]);
                redirect('menu-manager');
                return;
            }
        }

        // Data untuk diperbarui
        $menu_data = [
            'menu_name' => $this->input->post('menu_name'),
            'menu_url' => $this->input->post('menu_url'),
            'icon' => $this->input->post('icon'),
            'parent_id' => $parent_id,
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'is_aksi_form' => $this->input->post('is_aksi_form') ? 1 : 0,
            'menurm' => $this->input->post('menurm') ?: null,
        ];

        // Update data
        if ($this->MenuModel->update_menu($id, $menu_data)) {
            $this->session->set_flashdata('notif', ['type' => 'success', 'message' => 'Menu berhasil diperbarui!']);
        } else {
            $this->session->set_flashdata('notif', ['type' => 'error', 'message' => 'Menu gagal diperbarui!']);
        }
        redirect('menu-manager');
    }

    public function delete($id)
    {
        if ($this->MenuModel->delete_menu($id)) {
            $this->session->set_flashdata('notif', ['type' => 'success', 'message' => 'Menu berhasil dihapus!']);
        } else {
            $this->session->set_flashdata('notif', ['type' => 'error', 'message' => 'Menu gagal dihapus!']);
        }
        redirect('menu-manager');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccessController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('UserModel');
        $this->load->model('UserAccessModel');

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    public function index()
    {
        $role_id = $this->session->userdata('role_id'); // Ambil role_id dari session
        $data['menus'] = $this->MenuModel->get_all_menus(); // Tambahkan ini untuk menu sidebar
        $data['users'] = $this->UserModel->get_all_users(); // Ambil semua user
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title'] = 'Hak Akses User';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('user-access/index', $data);
        $this->load->view('templates/footer');
    }

    public function manage($user_id)
    {
        // Ambil role_id dari user yang sedang diedit
        $user = $this->UserModel->get_user_by_id($user_id);
        if (!$user) {
            show_404(); // Jika user tidak ditemukan, tampilkan error 404
        }

        $role_id = $user['role_id']; // Ambil role_id user
        $data['user'] = $user;

        // Ambil daftar semua menu
        $raw_menus = $this->MenuModel->get_all_menus();
        $data['menus'] = $this->_get_hierarchical_menus($raw_menus);

        // Ambil daftar menu yang telah diberikan ke user (berdasarkan user_id, bukan role_id)
        $data['user_menus'] = $this->UserAccessModel->get_user_menus($user_id);

        // Data tambahan untuk tampilan
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['title'] = 'Kelola Hak Akses User';

        // Load tampilan
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('user-access/manage', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $user_id = $this->input->post('user_id');
        $menu_ids = $this->input->post('menu_ids') ?: []; // Default kosong jika tidak ada checkbox terpilih

        if ($this->UserAccessModel->update_user_menus($user_id, $menu_ids)) {
            $this->session->set_flashdata('notif', ['type' => 'success', 'message' => 'Hak akses berhasil diperbarui!']);
        } else {
            $this->session->set_flashdata('notif', ['type' => 'error', 'message' => 'Hak akses gagal diperbarui!']);
        }

        redirect('user-access/manage/' . $user_id);
    }

    /**
     * Copy Access - Copy menu sidebar & RME tab access from one user to another
     */
    public function copy_access()
    {
        $source_user_id = $this->input->post('source_user_id');
        $target_user_ids = $this->input->post('target_user_ids');

        if (!$source_user_id || empty($target_user_ids)) {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Pilih user sumber dan minimal 1 user tujuan!'
            ]);
            redirect('user-access');
            return;
        }

        // Load RmeMenuModel
        $this->load->model('RmeMenuModel');

        $success_count = 0;
        $fail_count = 0;

        foreach ($target_user_ids as $target_id) {
            // Skip if source and target are the same
            if ($source_user_id == $target_id) {
                continue;
            }

            // Get source user's menu access
            $source_menus = $this->UserAccessModel->get_user_menus($source_user_id);

            // Get source user's RME tab access
            $source_rme_tabs = $this->RmeMenuModel->get_user_access_ids($source_user_id);

            // Copy menu sidebar access
            $menu_success = $this->UserAccessModel->update_user_menus($target_id, $source_menus);

            // Copy RME tab access
            $rme_success = $this->RmeMenuModel->update_user_access($target_id, $source_rme_tabs);

            if ($menu_success && $rme_success) {
                $success_count++;
            } else {
                $fail_count++;
            }
        }

        // Set notification
        if ($success_count > 0) {
            $this->session->set_flashdata('notif', [
                'type' => 'success',
                'message' => "Berhasil copy akses ke {$success_count} user!" .
                    ($fail_count > 0 ? " ({$fail_count} gagal)" : "")
            ]);
        } else {
            $this->session->set_flashdata('notif', [
                'type' => 'error',
                'message' => 'Gagal copy akses ke semua user!'
            ]);
        }

        redirect('user-access');
    }

    private function _get_hierarchical_menus($all_menus)
    {
        $grouped = [];
        foreach ($all_menus as $m) {
            $pid = $m['parent_id'] ? $m['parent_id'] : 0;
            $grouped[$pid][] = $m;
        }

        $result = [];
        $this->_flatten_tree($grouped, 0, $result, 0);
        return $result;
    }

    private function _flatten_tree($grouped, $parent_id, &$result, $depth)
    {
        if (!isset($grouped[$parent_id]))
            return;
        foreach ($grouped[$parent_id] as $menu) {
            $menu['depth'] = $depth;
            $result[] = $menu;
            $this->_flatten_tree($grouped, $menu['id'], $result, $depth + 1);
        }
    }
}

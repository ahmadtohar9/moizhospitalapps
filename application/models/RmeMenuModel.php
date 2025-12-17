<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RmeMenuModel extends CI_Model
{

    // Ambil semua menu tab yang tersedia (untuk halaman admin)
    public function get_all_menus()
    {
        return $this->db->get('moizhospital_rme_tab_menus')->result_array();
    }

    // Ambil daftar ID menu yang diizinkan untuk user tertentu
    public function get_user_access_ids($user_id)
    {
        $this->db->select('rme_tab_id');
        $this->db->where('user_id', $user_id);
        $rows = $this->db->get('moizhospital_user_rme_access')->result_array();
        return array_column($rows, 'rme_tab_id');
    }

    // Ambil daftar URL menu yang diizinkan (untuk filtering di Controller Rekam Medis)
    public function get_allowed_urls($user_id)
    {
        $this->db->select('m.tab_url');
        $this->db->from('moizhospital_rme_tab_menus m');
        $this->db->join('moizhospital_user_rme_access a', 'a.rme_tab_id = m.id');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('m.is_active', 1);
        $rows = $this->db->get()->result_array();
        return array_column($rows, 'tab_url');
    }

    // Ambil daftar menu lengkap (Nama & URL) sesuai hak akses user (Untuk Dynamic Tabs)
    public function get_menus_by_user_complete($user_id)
    {
        $this->db->select('m.tab_name, m.tab_url');
        $this->db->from('moizhospital_rme_tab_menus m');
        $this->db->join('moizhospital_user_rme_access a', 'a.rme_tab_id = m.id');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('m.is_active', 1);
        $this->db->order_by('m.id', 'ASC'); // Urutkan berdasarkan ID (insert order)
        return $this->db->get()->result_array();
    }

    // Simpan hak akses baru (Hapus lama -> Insert baru)
    public function update_user_access($user_id, $menu_ids)
    {
        $this->db->trans_start();

        // 1. Hapus access lama
        $this->db->where('user_id', $user_id);
        $this->db->delete('moizhospital_user_rme_access');

        // 2. Insert baru
        if (!empty($menu_ids)) {
            $data = [];
            foreach ($menu_ids as $mid) {
                $data[] = [
                    'user_id' => $user_id,
                    'rme_tab_id' => $mid
                ];
            }
            $this->db->insert_batch('moizhospital_user_rme_access', $data);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // === FITUR CRUD MASTER DATA (Baru) ===

    public function get_menu_by_id($id)
    {
        return $this->db->get_where('moizhospital_rme_tab_menus', ['id' => $id])->row_array();
    }

    public function insert_menu($data)
    {
        return $this->db->insert('moizhospital_rme_tab_menus', $data);
    }

    public function update_menu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('moizhospital_rme_tab_menus', $data);
    }

    public function delete_menu($id)
    {
        $this->db->trans_start();
        // Hapus juga relasi di tabel akses agar tidak orphan
        $this->db->where('rme_tab_id', $id);
        $this->db->delete('moizhospital_user_rme_access');

        $this->db->where('id', $id);
        $this->db->delete('moizhospital_rme_tab_menus');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuModel extends CI_Model
{


    public function get_menu_by_user($user_id)
    {
        // Ambil role_id user terlebih dahulu
        $user = $this->db->select('role_id')->get_where('moizhospital_users', ['id' => $user_id])->row();
        $role_id = $user ? $user->role_id : 0;

        $this->db->select('m.id, m.menu_name, m.menu_url, m.icon, m.parent_id, m.is_active,
                           (SELECT COUNT(*) FROM moizhospital_menus WHERE parent_id = m.id) AS has_submenu');
        $this->db->from('moizhospital_menus m');

        if ($role_id == 1) {
            // Admin: Show all active menus
            $this->db->where('m.is_active', 1);
        } else {
            // User: Show assigned menus
            $this->db->join('moizhospital_user_menu um', 'um.menu_id = m.id');
            $this->db->where('um.user_id', $user_id);
            $this->db->where('m.is_active', 1);
        }

        $this->db->order_by('m.parent_id', 'ASC');
        $this->db->order_by('m.id', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_all_menus()
    {
        $this->db->select('id, menu_name, menu_url, icon, parent_id, is_active, 
                           IFNULL(is_aksi_form, 0) AS is_aksi_form,
                           (SELECT COUNT(*) FROM moizhospital_menus WHERE parent_id = moizhospital_menus.id) AS has_submenu');
        $this->db->from('moizhospital_menus');
        $this->db->where('is_active', 1); // Hanya menu aktif
        $this->db->order_by('parent_id', 'ASC');
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }

    // Mengambil menu yang dapat menjadi parent
    public function get_parent_menus()
    {
        $this->db->select('id, menu_name');
        $this->db->from('moizhospital_menus');
        $this->db->where('parent_id IS NULL'); // Hanya parent menu
        $this->db->where('is_active', 1); // Hanya menu aktif
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }

    // Menambahkan menu baru
    public function insert_menu($menu_data)
    {
        return $this->db->insert('moizhospital_menus', $menu_data);
    }

    // Mengambil data menu berdasarkan ID
    public function get_menu_by_id($id)
    {
        return $this->db->get_where('moizhospital_menus', ['id' => $id])->row_array();
    }

    // Memperbarui menu berdasarkan ID
    public function update_menu($id, $menu_data)
    {
        $this->db->where('id', $id);
        return $this->db->update('moizhospital_menus', $menu_data);
    }

    // Menghapus menu berdasarkan ID
    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('moizhospital_menus');
    }

    // Mengambil menu berdasarkan kode menurm
    public function get_menus_by_menurm($menurm)
    {
        $this->db->select('id, menu_name, menu_url, icon, parent_id, is_active, is_active_form, is_aksi_form, menurm');
        $this->db->from('moizhospital_menus');
        $this->db->where('menurm', $menurm);
        $this->db->where('is_active', 1); // Hanya menu aktif
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_active_action_menus()
    {
        $this->db->select('menu_name, menu_url');
        $this->db->from('moizhospital_menus');
        $this->db->where('is_aksi_form', 1); // Hanya menu dengan aksi form aktif
        $this->db->where('is_active', 1);   // Pastikan menu aktif
        return $this->db->get()->result_array();
    }

}

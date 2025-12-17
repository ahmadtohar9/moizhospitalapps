<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccessModel extends CI_Model {

    public function get_user_menus($user_id) {
    $this->db->select('menu_id');
    $this->db->from('moizhospital_user_menu');
    $this->db->where('user_id', $user_id);
    $result = $this->db->get()->result_array();

    return array_column($result, 'menu_id'); // Kembalikan array daftar menu_id yang dimiliki user
}


    public function update_user_menus($user_id, $menu_ids) {
    // Hapus semua menu lama user ini
    $this->db->where('user_id', $user_id);
    $this->db->delete('moizhospital_user_menu');

    // Simpan menu baru yang dipilih
    foreach ($menu_ids as $menu_id) {
        $this->db->insert('moizhospital_user_menu', [
            'user_id' => $user_id,
            'menu_id' => $menu_id
        ]);
    }

    return true;
}


}

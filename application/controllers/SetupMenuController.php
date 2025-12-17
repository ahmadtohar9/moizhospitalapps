<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetupMenuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        echo "Starting Menu Setup...\n";

        // 1. Find 'Pendaftaran' Parent Menu
        $parent = $this->db->like('menu_name', 'Pendaftaran')->get('moizhospital_menus')->row();

        if (!$parent) {
            echo "Error: Parent menu 'Pendaftaran' not found.\n";
            return;
        }

        $parent_id = $parent->id;
        echo "Found Parent 'Pendaftaran' ID: $parent_id\n";

        // 2. Check if 'Registrasi' already exists
        $exist = $this->db->get_where('moizhospital_menus', ['menu_url' => 'pendaftaran/reg_periksa'])->row();

        if ($exist) {
            echo "Menu 'Registrasi' already exists (ID: {$exist->id}). Update parent if needed.\n";
            // Optional: Update parent just in case
            $this->db->where('id', $exist->id)->update('moizhospital_menus', ['parent_id' => $parent_id, 'is_active' => 1]);
        } else {
            // 3. Insert new menu
            $data = [
                'menu_name' => 'Registrasi',
                'menu_url' => 'pendaftaran/reg_periksa',
                'icon' => 'fa-user-plus', // Icon suggestion
                'parent_id' => $parent_id,
                'is_active' => 1,
                'is_aksi_form' => 0
            ];
            $this->db->insert('moizhospital_menus', $data);
            echo "Menu 'Registrasi' inserted successfully.\n";
        }

        // 4. Also ensure 'Data Pasien' is correctly ordered if needed, but 'after data pasien' is requested.
        // We can't easily control exact order without an 'order' column update, usually ID or a specific sort column determines it.
        // Assuming default sort is by ID, adding it now will put it at the end of the Pendaftaran list.

        echo "Done.\n";
    }
}

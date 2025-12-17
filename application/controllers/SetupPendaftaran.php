<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetupPendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        echo "<h1>Setup Menu Pendaftaran</h1>";

        // 1. Check if 'Pendaftaran' parent exists
        $parent = $this->db->get_where('moizhospital_menus', ['menu_name' => 'Pendaftaran', 'parent_id' => 0])->row();

        if (!$parent) {
            $this->db->insert('moizhospital_menus', [
                'menu_name' => 'Pendaftaran',
                'menu_url' => '#',
                'icon' => 'fa-hospital-o',
                'parent_id' => 0,
                'is_active' => 1
            ]);
            $parentId = $this->db->insert_id();
            echo "Created Parent Menu 'Pendaftaran' (ID: $parentId)<br>";
        } else {
            $parentId = $parent->id;
            echo "Parent Menu 'Pendaftaran' already exists (ID: $parentId)<br>";
        }

        // 2. Check if 'Data Pasien' exists under this parent
        $child = $this->db->get_where('moizhospital_menus', [
            'menu_name' => 'Data Pasien',
            'menu_url' => 'pendaftaran/pasien'
        ])->row();

        if (!$child) {
            $this->db->insert('moizhospital_menus', [
                'menu_name' => 'Data Pasien',
                'menu_url' => 'pendaftaran/pasien',
                'icon' => 'fa-user-plus',
                'parent_id' => $parentId,
                'is_active' => 1
            ]);
            echo "Created Child Menu 'Data Pasien'<br>";
        } else {
            // Update parent if managed separately before
            if ($child->parent_id != $parentId) {
                $this->db->where('id', $child->id);
                $this->db->update('moizhospital_menus', ['parent_id' => $parentId]);
                echo "Updated Parent for 'Data Pasien'<br>";
            } else {
                echo "Child Menu 'Data Pasien' already exists<br>";
            }
        }

        echo "Done.";
    }
}

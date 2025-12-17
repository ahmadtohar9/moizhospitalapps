<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrateRehab extends CI_Controller
{
    public function index()
    {
        echo "<h1>Migrasi Tabel Rehab Medik</h1>";

        $this->load->database();

        // 1. Create Table moizhospital_program_rehabmedik
        $table_name = 'moizhospital_program_rehabmedik';

        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
          `no_rawat` varchar(17) NOT NULL,
          `tgl_perawatan` date NOT NULL,
          `jam_rawat` time NOT NULL,
          `subjective` text DEFAULT NULL,
          `objective` text DEFAULT NULL,
          `assessment` text DEFAULT NULL,
          `procedure_text` text DEFAULT NULL,
          `kd_dokter` varchar(10) DEFAULT NULL,
          `nip_tim_rehab` varchar(20) DEFAULT NULL,
          PRIMARY KEY (`no_rawat`,`tgl_perawatan`,`jam_rawat`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        if ($this->db->query($sql)) {
            echo "<p style='color:green'>[OK] Tabel <strong>$table_name</strong> berhasil dibuat atau sudah ada.</p>";
        } else {
            echo "<p style='color:red'>[ERROR] Gagal membuat tabel $table_name: " . $this->db->error()['message'] . "</p>";
        }

        // 2. Insert Menu RME Tab
        $menu_tab = 'Rehab Medik';
        $menu_url = 'rehabmedikcontroller/index';

        $check = $this->db->get_where('moizhospital_rme_tab_menus', ['tab_url' => $menu_url]);

        if ($check->num_rows() == 0) {
            $data = [
                'tab_name' => $menu_tab,
                'tab_url' => $menu_url,
                'category' => 'dokter',
                'is_active' => 1
            ];

            if ($this->db->insert('moizhospital_rme_tab_menus', $data)) {
                echo "<p style='color:green'>[OK] Menu RME <strong>$menu_tab</strong> berhasil ditambahkan.</p>";
            } else {
                echo "<p style='color:red'>[ERROR] Gagal insert menu: " . $this->db->error()['message'] . "</p>";
            }
        } else {
            echo "<p style='color:orange'>[INFO] Menu RME <strong>$menu_tab</strong> sudah ada, skip insert.</p>";
        }

        echo "<hr><p>Selesai. Silakan hapus controller ini jika sudah tidak dipakai.</p>";
    }
}

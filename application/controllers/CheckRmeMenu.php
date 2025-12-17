<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckRmeMenu extends CI_Controller
{
    public function index()
    {
        $this->load->database();
        echo "<h1>Cek Data Menu RME</h1>";

        // Cek Tabel Menu Utama (Sidebar/Navigasi)
        echo "<h3>1. Tabel: moizhospital_menus (Sidebar/Akses Utama)</h3>";
        $main_menu = $this->db->like('menu_name', 'Rehab')->get('moizhospital_menus')->result_array();
        if ($main_menu) {
            echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Nama</th><th>URL</th><th>Aktif?</th><th>Aksi Form?</th></tr>";
            foreach ($main_menu as $m) {
                echo "<tr><td>{$m['id']}</td><td>{$m['menu_name']}</td><td>{$m['menu_url']}</td><td>{$m['is_active']}</td><td>{$m['is_aksi_form']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red'>Tidak ditemukan nama 'Rehab' di tabel moizhospital_menus</p>";
        }

        // Cek Tabel Tab RME (Tab dalam form dokter)
        echo "<h3>2. Tabel: moizhospital_rme_tab_menus (Tab Form Dokter)</h3>";
        $rme_menu = $this->db->like('tab_name', 'Rehab')->get('moizhospital_rme_tab_menus')->result_array();
        if ($rme_menu) {
            echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Tab Name</th><th>Tab URL (PENTING!)</th><th>Category</th><th>Aktif?</th></tr>";
            foreach ($rme_menu as $r) {
                // Highlight color if URL starts with lowercase
                $color = ctype_lower($r['tab_url'][0]) ? 'red' : 'green';

                echo "<tr>
                        <td>{$r['id']}</td>
                        <td>{$r['tab_name']}</td>
                        <td style='color:$color; font-weight:bold'>{$r['tab_url']}</td>
                        <td>{$r['category']}</td>
                        <td>{$r['is_active']}</td>
                      </tr>";
            }
            echo "</table>";
            echo "<p><em>Note: Jika 'Tab URL' berwarna merah (huruf kecil), kemungkinan itu penyebab error di Mac/Linux. <br>Harus sama persis dengan nama file controller: <strong>RehabMedikController/index</strong></em></p>";
        } else {
            echo "<p style='color:red'>Tidak ditemukan nama 'Rehab' di tabel moizhospital_rme_tab_menus</p>";
        }

        echo "<hr>";
        echo "<a href='" . site_url('fixrehabmenu') . "' target='_blank'>Klik Disini Untuk Perbaiki URL Otomatis</a>";
    }
}

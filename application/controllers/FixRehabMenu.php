<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FixRehabMenu extends CI_Controller
{
    public function index()
    {
        echo "<h1>Fixing Rehab Menu URL</h1>";
        $this->load->database();

        // Update URL di database agar sesuai Case Sensitivity Controller
        // Nama Controller: RehabMedikController.php
        // URL yang benar: RehabMedikController/index

        $target_url = 'RehabMedikController/index';
        $old_url_lower = 'rehabmedikcontroller/index';

        // Update 1: Coba update yang lowercase
        $this->db->where('tab_url', $old_url_lower);
        $this->db->update('moizhospital_rme_tab_menus', ['tab_url' => $target_url]);

        echo "<p>Update URL dari '$old_url_lower' ke '$target_url': " . $this->db->affected_rows() . " rows affected.</p>";

        // Update 2: Pastikan nama tab konsisten
        $this->db->where('tab_name', 'Rehab Medik');
        $this->db->update('moizhospital_rme_tab_menus', ['tab_url' => $target_url, 'is_active' => 1]);

        echo "<p>Force Update URL untuk tab 'Rehab Medik': " . $this->db->affected_rows() . " rows affected.</p>";

        echo "<hr><h3>Coba akses menu RME sekarang bro!</h3>";
    }
}

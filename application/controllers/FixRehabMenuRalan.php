<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FixRehabMenuRalan extends CI_Controller
{
    public function index()
    {
        echo "<h1>Fixing Rehab Menu URL (RALAN VERSION)</h1>";
        $this->load->database();

        // Update URL ke versi RehabMedikRalanController/index
        $target_url = 'RehabMedikRalanController/index';

        // Cari tab menu Rehab Medik
        $this->db->like('tab_name', 'Rehab');
        $this->db->update('moizhospital_rme_tab_menus', ['tab_url' => $target_url, 'is_active' => 1]);

        echo "<p>Update URL Rehab Medik ke '$target_url': " . $this->db->affected_rows() . " rows affected.</p>";

        echo "<hr><h3>Coba akses menu RME sekarang bro! (Refresh Page UI)</h3>";
    }
}

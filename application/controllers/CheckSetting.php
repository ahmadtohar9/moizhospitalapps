<?php
class CheckSetting extends CI_Controller {
    public function index() {
        echo "<h2>setting</h2>";
        $q = $this->db->query("SHOW COLUMNS FROM setting");
        foreach($q->result() as $row) { echo $row->Field . "<br>"; }
        
        echo "<h2>Data</h2>";
        $q = $this->db->query("SELECT * FROM setting LIMIT 1");
        print_r($q->row_array());
    }
}

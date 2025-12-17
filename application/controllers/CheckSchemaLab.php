<?php
class CheckSchemaLab extends CI_Controller {
    public function index() {
        echo "<h2>periksa_lab</h2>";
        $q = $this->db->query("SHOW COLUMNS FROM periksa_lab");
        foreach($q->result() as $row) { echo $row->Field . "<br>"; }

        echo "<h2>detail_periksa_lab</h2>";
        $q = $this->db->query("SHOW COLUMNS FROM detail_periksa_lab");
        foreach($q->result() as $row) { echo $row->Field . "<br>"; }
    }
}

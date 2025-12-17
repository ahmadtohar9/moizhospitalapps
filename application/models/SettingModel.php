<?php

class SettingModel extends CI_Model {
    public function get_setting() {
        return $this->db->get('setting')->row_array();
    }
}


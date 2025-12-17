<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DokterModel extends CI_Model {
    public function get_all() {
        return $this->db->select('kd_dokter, nm_dokter')
                        ->from('dokter')
                        ->order_by('nm_dokter', 'ASC')
                        ->get()->result_array();
    }
}

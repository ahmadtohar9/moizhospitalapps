<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PetugasModel extends CI_Model {
    public function get_all() {
        return $this->db->select('nip, nama')
                        ->from('petugas')
                        ->order_by('nama', 'ASC')
                        ->get()->result_array();
    }

    public function get_by_nip($nip) {
        return $this->db->select('nip, nama')
                        ->from('petugas')
                        ->where('nip', $nip)
                        ->limit(1)
                        ->get()->row_array();
    }
}

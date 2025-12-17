<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleModel extends CI_Model
{
    public function get_all_roles()
    {
        $this->db->select('id, role_name');
        $this->db->from('moizhospital_roles');
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }
}

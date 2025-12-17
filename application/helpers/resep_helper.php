<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_no_resep')) {
    function generate_no_resep()
    {
        $CI = &get_instance();
        $CI->load->database();
        
        $today = date('Ymd'); // Format YYYYMMDD
        $CI->db->select('MAX(no_resep) as max_resep');
        $CI->db->like('no_resep', $today, 'after');
        $query = $CI->db->get('resep_obat')->row();

        if ($query->max_resep) {
            $last_number = (int) substr($query->max_resep, -4); // Ambil 4 digit terakhir
            $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_number = '0001';
        }

        return $today . $new_number;
    }
}
?>

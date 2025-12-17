<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Middleware untuk memastikan pengguna sudah login
function is_logged_in() {
    $ci =& get_instance();
    if (!$ci->session->userdata('logged_in')) {
        redirect('auth/login');
    }
}

// Middleware untuk memastikan pengguna memiliki akses berdasarkan role
function check_role($required_role) {
    $ci =& get_instance();
    $role_id = $ci->session->userdata('role_id');

    if (!$ci->session->userdata('logged_in') || $role_id != $required_role) {
        show_error('Anda tidak memiliki akses ke halaman ini!', 403, 'Akses Ditolak');
    }
}

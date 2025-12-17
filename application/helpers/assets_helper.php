<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('asset_url')) {
    function asset_url($path)
    {
        $ci =& get_instance();
        $full_path = FCPATH . $path;

        if (file_exists($full_path)) {
            $version = filemtime($full_path);
            return base_url($path) . '?v=' . $version;
        } else {
            return base_url($path); // fallback kalau file ga ditemukan
        }
    }
}

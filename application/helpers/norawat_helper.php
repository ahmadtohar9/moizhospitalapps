<?php

if (!function_exists('get_no_rawat')) {
    /**
     * Generate full No Rawat from URI segments
     * Format: YYYY/MM/DD/NNNNNN
     * @return string|null
     */
    function get_no_rawat() {
        $CI =& get_instance(); // Ambil instance CodeIgniter
        $year = $CI->uri->segment(4);  // Ambil segmen 4 (tahun)
        $month = $CI->uri->segment(5); // Ambil segmen 5 (bulan)
        $day = $CI->uri->segment(6);   // Ambil segmen 6 (tanggal)
        $number = $CI->uri->segment(7); // Ambil segmen 7 (nomor urut)

        // Pastikan semua segmen tersedia
        if (!$year || !$month || !$day || !$number) {
            return null; // Jika segmen tidak lengkap, kembalikan null
        }

        // Gabungkan segmen menjadi format No Rawat
        return "$year/$month/$day/$number";
    }
}

if (!function_exists('build_url')) {
    /**
     * Generate URL dynamically based on controller, method, and menu URL
     * @param string $controller
     * @param string $method
     * @param string $menu_url
     * @param string $no_rawat
     * @return string
     */
    function build_url($controller, $method, $menu_url, $no_rawat) {
        // Pastikan semua parameter terisi
        if (!$controller || !$method || !$menu_url || !$no_rawat) {
            return '#'; // Kembalikan URL kosong jika parameter tidak lengkap
        }

        // Generate URL
        return base_url("{$controller}/{$method}/{$menu_url}/{$no_rawat}");
    }
}

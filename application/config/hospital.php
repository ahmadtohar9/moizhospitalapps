<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Konfigurasi Data Rumah Sakit
 * Digunakan untuk header print, kop surat, dan identitas RS
 * 
 * PENTING: Sesuaikan data ini dengan data RS Anda
 */

$config['hospital'] = array(
    // Identitas Rumah Sakit
    'nama_rs' => 'RSIA MOIZ ANDINI',
    'alamat' => 'Jl. Raya Serang KM 16,5 Cikupa - Tangerang',
    'kota' => 'Tangerang',
    'provinsi' => 'Banten',
    'kode_pos' => '15710',
    'telepon' => '(021) 5960 5555',
    'fax' => '(021) 5960 5556',
    'email' => 'info@rsiamoizandini.com',
    'website' => 'www.rsiamoizandini.com',

    // Logo & Branding
    'logo_path' => 'assets/images/logo-rs.png', // Path relatif dari base_url
    'logo_width' => '80px',
    'logo_height' => 'auto',

    // Informasi Legal
    'no_izin' => '503/1234/DINKES/2020',
    'tgl_izin' => '15 Januari 2020',
    'kelas_rs' => 'Kelas C',
    'jenis_rs' => 'Rumah Sakit Ibu dan Anak',
    'kepemilikan' => 'Swasta',

    // Akreditasi
    'status_akreditasi' => 'Terakreditasi',
    'tingkat_akreditasi' => 'Paripurna',
    'tgl_akreditasi' => '10 Maret 2021',

    // Direktur/Pimpinan
    'nama_direktur' => 'dr. Ahmad Tohar, Sp.OG',
    'nip_direktur' => '198501012010011001',

    // Print Settings
    'print_margin_top' => '10mm',
    'print_margin_bottom' => '10mm',
    'print_margin_left' => '15mm',
    'print_margin_right' => '15mm',

    // Watermark (opsional)
    'use_watermark' => false,
    'watermark_text' => 'DOKUMEN RESMI',

    // Footer Print
    'footer_text' => 'Dokumen ini dicetak secara otomatis dan sah tanpa tanda tangan basah',
    'show_print_date' => true,
    'show_page_number' => true,
);

/**
 * Fungsi helper untuk mengambil config hospital
 * Bisa dipanggil dari controller/view dengan: get_hospital_config('nama_rs')
 */
if (!function_exists('get_hospital_config')) {
    function get_hospital_config($key = null)
    {
        $CI =& get_instance();
        $CI->config->load('hospital', TRUE);
        $hospital = $CI->config->item('hospital', 'hospital');

        if ($key === null) {
            return $hospital;
        }

        return isset($hospital[$key]) ? $hospital[$key] : null;
    }
}

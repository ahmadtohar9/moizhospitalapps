<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifikasiController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ResumeMedisRalan_model');
    }

    // Method untuk verifikasi resume medis melalui QR code
    public function resume($encoded_no_rawat)
    {
        $no_rawat = base64_decode($encoded_no_rawat);

        // Ambil data resume berdasarkan no_rawat
        $resume = $this->ResumeMedisRalan_model->get_detail_by_no_rawat($no_rawat);

        if (!$resume) {
            show_404(); // Jika data tidak ditemukan
        }

        $data['resume'] = $resume;
        $data['decoded_no_rawat'] = $no_rawat;

        // Tampilkan view verifikasi
        $this->load->view('verifikasi/verifikasi_resume', $data);
    }
}

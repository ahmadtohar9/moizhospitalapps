<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PiutangPasienRanapController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PiutangPasienModel');
        $this->load->model('SettingModel');
        $this->load->model('MenuModel');

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    public function index() {
        $data['nama_user']       = $this->session->userdata('nama_user');
        $role_id                 = $this->session->userdata('role_id');
        $data['menus']           = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['penjab_list']     = $this->PiutangPasienModel->get_penjab();
        $data['title']           = 'Laporan Piutang Pasien';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('piutang_pasien/piutangRanap', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() 
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');

        $data = $this->PiutangPasienModel->get_piutangRanap($start_date, $end_date, $penjab);

        echo json_encode($data);
    }

   public function print_pdf() 
    {
        // Load library mPDF
        require_once APPPATH . '../vendor/autoload.php';

        // Data untuk laporan
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');
        $data['piutang'] = $this->PiutangPasienModel->get_piutangRanap($start_date, $end_date, $penjab);
        $data['setting'] = $this->SettingModel->get_setting();

        // Path logo langsung (tidak menggunakan base64)
        //$data['logo_path'] = base_url('assets/images/logoandini.jpg');

        // Render view HTML ke dalam string
        $html = $this->load->view('piutang_pasien/pdf_piutangpasienRanap', $data, true);

        // Konfigurasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => FCPATH . 'tmp/mpdf', // Lokasi penyimpanan temporary
            'format' => 'A4',
            'margin_top' => 30, // Margin atas
            'margin_bottom' => 15, // Margin bawah
        ]);

        // Load HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        $mpdf->Output("Laporan_Piutang_Pasien_Ranap.pdf", \Mpdf\Output\Destination::INLINE);
    }

}

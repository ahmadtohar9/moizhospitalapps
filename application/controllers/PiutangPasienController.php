<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PiutangPasienController extends CI_Controller {

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
        $this->load->view('piutang_pasien/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() 
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');

        $data = $this->PiutangPasienModel->get_piutang($start_date, $end_date, $penjab);

        echo json_encode($data);
    }

    public function print_pdf() 
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');
        $search = $this->input->get('search'); // Ambil parameter search

        $data['piutang'] = $this->PiutangPasienModel->get_piutang($start_date, $end_date, $penjab, $search);
        $data['total'] = array_sum(array_column($data['piutang'], 'totalpiutang')); // Hitung total piutang

        $data['setting'] = $this->SettingModel->get_setting();
        $html = $this->load->view('piutang_pasien/pdf_piutangpasien', $data, true);

        $mpdf = new \Mpdf\Mpdf(['tempDir' => FCPATH . 'tmp/mpdf', 'format' => 'A4']);
        $mpdf->WriteHTML($html);
        $mpdf->Output("Laporan_Piutang_Pasien.pdf", \Mpdf\Output\Destination::INLINE);
    }
}

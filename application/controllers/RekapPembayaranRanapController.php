<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapPembayaranRanapController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RekapPembayaranRanap_model');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        // Cek login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Rekap Pembayaran Ranap';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('billing/rekap_pembayaran_ranap_view', $data);
        $this->load->view('templates/footer');
    }

    public function loadData() {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');

        $data = $this->RekapPembayaranRanap_model->get_data($start_date, $end_date);
        echo json_encode(['data' => $data]);
    }

    public function export_pdf() {
        require_once APPPATH . '../vendor/autoload.php';

        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');

        $data['laporan'] = $this->RekapPembayaranRanap_model->get_data($start_date, $end_date);
        $data['setting'] = $this->SettingModel->get_setting();
        $data['start_date'] = $start_date;
        $data['end_date']   = $end_date;

        $html = $this->load->view('billing/pdf_rekap_pembayaran_ranap', $data, true);

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);
        $mpdf->WriteHTML($html);
        $mpdf->Output("Rekap_Pembayaran_Ranap_{$start_date}_sd_{$end_date}.pdf", \Mpdf\Output\Destination::INLINE);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapPembayaranRalanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RekapPembayaranRalan_model');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Rekap Pembayaran Ralan';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['dokter_list'] = $this->RekapPembayaranRalan_model->get_dokter_list();
        $data['penjab_list'] = $this->RekapPembayaranRalan_model->get_penjab_list();
        $data['poli_list']   = $this->RekapPembayaranRalan_model->get_poli_list();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('billing/rekapPembayaranRalan_view', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $kd_dokter  = $this->input->get('dokter');
        $kd_pj      = $this->input->get('penjab');
        $kd_poli    = $this->input->get('poli');

        $data = $this->RekapPembayaranRalan_model->get_data($start_date, $end_date, $kd_dokter, $kd_pj, $kd_poli);

        echo json_encode(['data' => $data]);
    }

    public function print_pdf() {
        require_once APPPATH . '../vendor/autoload.php';

        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $dokter     = $this->input->get('dokter');
        $penjab     = $this->input->get('penjab');
        $poli       = $this->input->get('poli');

        $data['billing'] = $this->RekapPembayaranRalan_model->get_data($start_date, $end_date, $dokter, $penjab, $poli);
        $data['setting'] = $this->SettingModel->get_setting();
        $data['start_date'] = $start_date;
        $data['end_date']   = $end_date;

        $html = $this->load->view('billing/pdf_rekapPembayaranRalan', $data, true);

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);
        $mpdf->WriteHTML($html);
        $mpdf->Output("Rekap_Pembayaran_Ralan.pdf", \Mpdf\Output\Destination::INLINE);
    }

}

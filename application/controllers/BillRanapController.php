<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillRanapController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BillRanap_model');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title'] = 'Rincian Billing Rawat Inap';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('billing/bill_ranap_view', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $data = $this->BillRanap_model->get_billing_ranap($start_date, $end_date);

        echo json_encode(['data' => $data]);
    }

    public function print_pdf() {
        require_once APPPATH . '../vendor/autoload.php';

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $data['billing'] = $this->BillRanap_model->get_billing_ranap($start_date, $end_date);
        $data['setting'] = $this->SettingModel->get_setting();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $html = $this->load->view('billing/pdf_billing_ranap', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => FCPATH . 'tmp/mpdf',
            'format' => 'A4-L',
            'margin_top' => 30,
            'margin_bottom' => 15,
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output("Laporan_Billing_Rawat_Inap.pdf", \Mpdf\Output\Destination::INLINE);
    }
}

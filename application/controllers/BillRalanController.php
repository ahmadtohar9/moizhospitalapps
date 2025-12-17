<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillRalanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BillRalan_model'); 
        $this->load->model('MenuModel'); 
        $this->load->model('SettingModel'); 

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    public function index() 
    {
        $data['dokter_list'] = $this->BillRalan_model->get_dokter_list(); // Ambil daftar dokter
        $data['nama_user'] = $this->session->userdata('nama_user');
        $role_id = $this->session->userdata('role_id');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title'] = 'Laporan Billing Ralan';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('billing/billRalan_view', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $kd_dokter = $this->input->get('dokter'); // Ambil parameter dokter

        $data = $this->BillRalan_model->get_billing_ralan($start_date, $end_date, $kd_dokter);

        echo json_encode(["data" => $data]);
    }

    public function print_pdf() 
    {
        // Load library mPDF
        require_once APPPATH . '../vendor/autoload.php';

        // Ambil parameter filter dari request GET
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $dokter = $this->input->get('dokter');

        // Ambil data billing pasien dari model
        $data['billing'] = $this->BillRalan_model->get_billing_data($start_date, $end_date, $dokter);
        $data['setting'] = $this->SettingModel->get_setting();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['dokter'] = $dokter;

        // Render view ke dalam HTML string
        $html = $this->load->view('billing/pdf_billing', $data, true);

        // Konfigurasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => FCPATH . 'tmp/mpdf', // Direktori sementara
            'format' => 'A4-L', // Landscape
            'margin_top' => 30, // Margin atas
            'margin_bottom' => 15, // Margin bawah
        ]);

        // Load HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        $mpdf->Output("Laporan_Billing_Rawat_Jalan.pdf", \Mpdf\Output\Destination::INLINE);
    }

}

?>

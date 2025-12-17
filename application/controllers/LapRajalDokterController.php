<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapRajalDokterController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LapRajalDokter_model');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Laporan Pasien Rawat Jalan';
        $data['dokter'] = $this->LapRajalDokter_model->get_dokter();
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('rekammedis/lapRajalDokter_view', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $kd_dokter = $this->input->post('kd_dokter');

        $data = $this->LapRajalDokter_model->get_laporan($tgl_awal, $tgl_akhir, $kd_dokter);
        $totals = $this->LapRajalDokter_model->get_total_per_dokter($tgl_awal, $tgl_akhir);

        echo json_encode([
            'data' => $data,
            'total_per_dokter' => $totals
        ]);
    }

    // (Opsional) Tambahan fungsi cetak PDF kalau nanti ingin export laporan
    public function print_pdf() {
        require_once APPPATH . '../vendor/autoload.php';

        $tgl_awal = $this->input->get('start_date');
        $tgl_akhir = $this->input->get('end_date');
        $kd_dokter = $this->input->get('dokter');

        $data['data_laporan'] = $this->LapRajalDokter_model->get_laporan($tgl_awal, $tgl_akhir, $kd_dokter);
        $data['setting'] = $this->SettingModel->get_setting();
        $data['start_date'] = $tgl_awal;
        $data['end_date'] = $tgl_akhir;
        $data['dokter'] = $kd_dokter;

        $html = $this->load->view('rekammedis/pdf_laporan_rajal', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => FCPATH . 'tmp/mpdf',
            'format' => 'A4-L',
            'margin_top' => 30,
            'margin_bottom' => 15,
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output("pdf_laporan_rajal.pdf", \Mpdf\Output\Destination::INLINE);
    }
}

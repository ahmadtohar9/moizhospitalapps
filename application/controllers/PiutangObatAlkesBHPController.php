<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PiutangObatAlkesBHPController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PiutangObatAlkesBHP_model');
        $this->load->model('SettingModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['nama_user']      = $this->session->userdata('nama_user');
        $data['menus']          = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title']          = 'Laporan Piutang Obat / Alkes / BHP';
        $data['supplier_list']  = $this->PiutangObatAlkesBHP_model->get_all_suppliers();
        $data['piutang']        = [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('piutangObat/piutang_obatAlkesBHP', $data);
        $this->load->view('templates/footer');
    }

    public function get_data() {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $supplier   = $this->input->get('supplier');
        $status     = $this->input->get('status');

        $result = $this->PiutangObatAlkesBHP_model->get_filtered_piutang($start_date, $end_date, $supplier, $status);
        echo json_encode(['data' => $result]);
    }

    public function laporanPenerimaanPiutangObat_pdf() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $supplier = $this->input->get('supplier');
        $status = $this->input->get('status');

        $this->load->model('SettingModel');
        $this->load->model('PiutangObatAlkesBHP_model');

        $data['setting'] = $this->SettingModel->get_setting();
        $data['piutang'] = $this->PiutangObatAlkesBHP_model->get_filtered_piutang($start_date, $end_date, $supplier, $status);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        // Ganti nama view sesuai file
        $html = $this->load->view('piutangObat/laporanPenerimaanPiutangObat_pdf', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => FCPATH . 'tmp/mpdf',
            'format' => 'A4-L',
            'margin_top' => 30,
            'margin_bottom' => 15
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output("Laporan_Piutang_Obat.pdf", \Mpdf\Output\Destination::INLINE);
    }

    public function export_excel() {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $supplier   = $this->input->get('supplier');
        $status     = $this->input->get('status');

        $data = $this->PiutangObatAlkesBHP_model->get_filtered_piutang($start_date, $end_date, $supplier, $status);

        // Pastikan tidak ada output sebelum header!
        if (ob_get_length()) ob_end_clean();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Piutang Obat');

        // Set header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'No Faktur');
        $sheet->setCellValue('C1', 'Tgl Faktur');
        $sheet->setCellValue('D1', 'Tgl Tempo');
        $sheet->setCellValue('E1', 'Supplier');
        $sheet->setCellValue('F1', 'Total');
        $sheet->setCellValue('G1', 'PPN');
        $sheet->setCellValue('H1', 'Meterai');
        $sheet->setCellValue('I1', 'Tagihan');
        $sheet->setCellValue('J1', 'Status');
        $sheet->setCellValue('K1', 'Sisa Hari');

        // Isi data
        $rowIndex = 2;
        $no = 1;
        foreach ($data as $row) {
            $sheet->setCellValue("A$rowIndex", $no++);
            $sheet->setCellValue("B$rowIndex", $row['no_faktur']);
            $sheet->setCellValue("C$rowIndex", $row['tgl_faktur']);
            $sheet->setCellValue("D$rowIndex", $row['tgl_tempo']);
            $sheet->setCellValue("E$rowIndex", $row['nama_suplier']);
            $sheet->setCellValue("F$rowIndex", $row['total2']);
            $sheet->setCellValue("G$rowIndex", $row['ppn']);
            $sheet->setCellValue("H$rowIndex", $row['meterai']);
            $sheet->setCellValue("I$rowIndex", $row['tagihan']);
            $sheet->setCellValue("J$rowIndex", $row['status']);
            $sheet->setCellValue("K$rowIndex", $row['sisa_hari']);
            $rowIndex++;
        }

        // Output Excel
        $filename = 'Laporan_Piutang_Obat_' . date('Ymd_His') . '.xlsx';

        // Jangan lupa: bersihkan output sebelum kirim header
        if (ob_get_length()) ob_end_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }



}

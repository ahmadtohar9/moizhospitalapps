<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanLabBaruController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PermintaanLabBaruModel');
        // Load helpers/libraries if needed
    }

    // Endpoint: /permintaanlabbarucontroller/get_master_data
    public function get_master_data()
    {
        // Cache could be implemented here if needed
        $data = $this->PermintaanLabBaruModel->get_all_master_lab();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    // Endpoint: /permintaanlabbarucontroller/simpan
    public function simpan()
    {
        $input = json_decode($this->input->raw_input_stream, true);

        if (!$input) {
            $this->output->set_status_header(400)->set_output(json_encode(['status' => false, 'message' => 'Invalid JSON']));
            return;
        }

        // Validasi basic
        if (empty($input['no_rawat']) || empty($input['items'])) {
            $this->output->set_status_header(400)->set_output(json_encode(['status' => false, 'message' => 'Data tidak lengkap (No Rawat / Item kosong)']));
            return;
        }

        // Generate No Order
        $input['noorder'] = $this->PermintaanLabBaruModel->generate_no_order();

        // Eksekusi Simpan
        $success = $this->PermintaanLabBaruModel->simpan_permintaan($input);

        if ($success) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'message' => 'Permintaan Lab Berhasil Disimpan', 'noorder' => $input['noorder']]));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => false, 'message' => 'Gagal menyimpan data ke database']));
        }
    }

    // Endpoint: /permintaanlabbarucontroller/get_riwayat
    public function get_riwayat()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            $this->output->set_status_header(400)->set_output(json_encode([]));
            return;
        }

        $data = $this->PermintaanLabBaruModel->get_riwayat_permintaan($no_rawat);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // Endpoint: /permintaanlabbarucontroller/hapus
    public function hapus()
    {
        $noorder = $this->input->post('noorder');
        if (!$noorder) {
            $this->output->set_status_header(400)->set_output(json_encode(['status' => false, 'message' => 'No Order required']));
            return;
        }

        $success = $this->PermintaanLabBaruModel->hapus_permintaan($noorder);

        if ($success) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'message' => 'Data berhasil dihapus']));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => false, 'message' => 'Gagal menghapus data']));
        }
    }

    // Index (fallback / testing)
    public function index()
    {
        // Usually loaded via RekamMedisRalanController->loadForm
        echo "Module Permintaan Lab Baru Ready.";
    }
}

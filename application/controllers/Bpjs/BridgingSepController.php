<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BridgingSepController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Bpjs/vclaim'); // Load VClaim
        if (!$this->session->userdata('logged_in')) {
            exit('No direct script access allowed');
        }
    }

    public function detail()
    {
        $no_sep = $this->input->get('no_sep');
        $sep = $this->db->get_where('bridging_sep', ['no_sep' => $no_sep])->row();

        if ($sep) {
            echo json_encode(['status' => true, 'data' => $sep]);
        } else {
            echo json_encode(['status' => false, 'message' => 'SEP tidak ditemukan']);
        }
    }

    public function cetak()
    {
        $no_sep = $this->input->get('no_sep');
        // Fetch SEP Data
        $sep = $this->db->get_where('bridging_sep', ['no_sep' => $no_sep])->row();

        if (!$sep) {
            show_error("SEP Data not found for No. SEP: " . $no_sep, 404);
            return;
        }

        // Generate QR Code
        // Content: Dikeluarkan di (nama rumah sakit ) Ditandatangani secara elektronik oleh (nama pasien dan nomor kartu bpjs dan tanggal create SEPnya)
        $rs_name = "RSUD PETALABUMI"; // Hardcoded or fetch from setting
        $qr_content = "Dikeluarkan di " . $rs_name . " Ditandatangani secara elektronik oleh " . $sep->nama_pasien . " " . $sep->no_kartu . " " . $sep->tglsep;

        $qr_filename = 'qrcode_sep_' . str_replace(['/', '\\'], '_', $no_sep) . '.png';
        $qr_path = FCPATH . 'assets/images/qrcode/' . $qr_filename;
        $qr_url = base_url('assets/images/qrcode/' . $qr_filename);

        // Create directory if not exists
        if (!is_dir(FCPATH . 'assets/images/qrcode/')) {
            mkdir(FCPATH . 'assets/images/qrcode/', 0777, true);
        }

        $this->load->library('QrCode_lib');
        $this->qrcode_lib->generate($qr_content, $qr_path, 2, 2);

        $data = [
            'sep' => $sep,
            'qr_url' => $qr_url,
            'logo_bpjs' => base_url('assets/images/bpjs_logo.png'), // Ensure this exists
            'rs_name' => $rs_name
        ];

        $this->load->view('bpjs/cetak_sep', $data);
    }

    public function delete()
    {
        $no_sep = $this->input->post('no_sep');
        $user = $this->session->userdata('nama_user') ?: 'Admin'; // User deleting

        // 1. Delete from BPJS API
        $resp = $this->vclaim->delete_sep($no_sep, $user);

        // Check Status
        // Note: Response structure depends on bpjs_service. Usually has metaData.code
        $is_success_bpjs = false;

        if (isset($resp['metaData']) && $resp['metaData']['code'] == '200') {
            $is_success_bpjs = true;
        }

        // Handling: If BPJS success OR SEP not found in BPJS (already deleted?), we delete local
        // But to be safe, stick to success. 
        // If metaData code is 200, it's deleted. 

        if ($is_success_bpjs) {
            // 2. Delete Local
            $result = $this->db->delete('bridging_sep', ['no_sep' => $no_sep]);

            if ($result) {
                echo json_encode(['status' => true, 'message' => 'SEP Berhasil dihapus dari BPJS & Lokal']);
            } else {
                echo json_encode(['status' => true, 'message' => 'SEP Berhasil dihapus di BPJS, tapi Gagal hapus lokal']);
            }
        } else {
            // Check if error is "Data tidak ditemukan" (maybe already deleted) -> force delete local?
            $msg = isset($resp['metaData']['message']) ? $resp['metaData']['message'] : 'Unknown Error BPJS';
            $code = isset($resp['metaData']['code']) ? $resp['metaData']['code'] : '';

            // Allow Force Delete if User wants? For now just report error.
            echo json_encode([
                'status' => false,
                'message' => 'Gagal hapus di BPJS: ' . $msg . ' (' . $code . '). User: ' . $user,
                'debug_info' => isset($resp['debug']) ? $resp['debug'] : null
            ]);
        }
    }
}

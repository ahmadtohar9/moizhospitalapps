<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResumeMedisRalanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ResumeMedisRalan_model');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        $detail = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$detail) {
            show_error('Data pasien tidak ditemukan.', 404);
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);
        $this->session->set_userdata('no_rkm_medis', $detail['no_rkm_medis']);

        $data = [
            'no_rawat' => $no_rawat,
            'kd_dokter' => $detail['kd_dokter'],
            'no_rkm_medis' => $detail['no_rkm_medis'],
            'menus' => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus' => $this->MenuModel->get_active_action_menus()
        ];

        $this->load->view('rekammedis/dokter/resumeMedisRalan_form', $data);
    }

    public function get() {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->ResumeMedisRalan_model->get_by_no_rawat($no_rawat);
        echo json_encode($data);
    }

    public function save() 
    {
        $data = $this->input->post();
        $result = $this->ResumeMedisRalan_model->save($data);

        if ($result === 'duplicate') {
            echo json_encode([
                'success' => false,
                'message' => 'Maaf, Resume Medis hanya bisa disimpan satu kali saja. Silakan cek datanya.'
            ]);
        } else {
            echo json_encode(['success' => $result]);
        }
    }

    public function update() 
    {
        $no_rawat = $this->input->post('no_rawat');
        $data = $this->input->post();

        if (empty($no_rawat)) {
            echo json_encode(['success' => false]);
            return;
        }

        // Resume
        $data_resume = [
            'kd_dokter' => $data['kd_dokter'],
            'keluhan_utama' => $data['keluhan_utama'],
            'jalannya_penyakit' => $data['jalannya_penyakit'],
            'pemeriksaan_penunjang' => $data['pemeriksaan_penunjang'],
            'hasil_laborat' => $data['hasil_laborat'],
            'diagnosa_utama' => $data['diagnosa_utama'] ?? null,
            'kd_diagnosa_utama' => $data['kd_diagnosa_utama'] ?? null,
            'diagnosa_sekunder' => $data['diagnosa_sekunder'] ?? null,
            'kd_diagnosa_sekunder' => $data['kd_diagnosa_sekunder'] ?? null,
            'diagnosa_sekunder2' => $data['diagnosa_sekunder2'] ?? null,
            'kd_diagnosa_sekunder2' => $data['kd_diagnosa_sekunder2'] ?? null,
            'diagnosa_sekunder3' => $data['diagnosa_sekunder3'] ?? null,
            'kd_diagnosa_sekunder3' => $data['kd_diagnosa_sekunder3'] ?? null,
            'diagnosa_sekunder4' => $data['diagnosa_sekunder4'] ?? null,
            'kd_diagnosa_sekunder4' => $data['kd_diagnosa_sekunder4'] ?? null,
            'prosedur_utama' => $data['prosedur_utama'] ?? null,
            'kd_prosedur_utama' => $data['kd_prosedur_utama'] ?? null,
            'prosedur_sekunder' => $data['prosedur_sekunder'] ?? null,
            'kd_prosedur_sekunder' => $data['kd_prosedur_sekunder'] ?? null,
            'prosedur_sekunder2' => $data['prosedur_sekunder2'] ?? null,
            'kd_prosedur_sekunder2' => $data['kd_prosedur_sekunder2'] ?? null,
            'prosedur_sekunder3' => $data['prosedur_sekunder3'] ?? null,
            'kd_prosedur_sekunder3' => $data['kd_prosedur_sekunder3'] ?? null,
            'kondisi_pulang' => $data['kondisi_pulang'] ?? null,
            'obat_pulang' => $data['obat_pulang'] ?? null
        ];

        // TTV
        $data_ttv = [
            'kd_dokter' => $data['kd_dokter'],
            'suhu_tubuh' => $data['suhu_tubuh'] ?? null,
            'tensi' => $data['tensi'] ?? null,
            'nadi' => $data['nadi'] ?? null,
            'respirasi' => $data['respirasi'] ?? null,
            'tinggi' => $data['tinggi'] ?? null,
            'berat' => $data['berat'] ?? null,
            'spo2' => $data['spo2'] ?? null,
            'gcs' => $data['gcs'] ?? null,
            'kesadaran' => $data['kesadaran'] ?? null,
            'diagnosa_utama' => $data['diagnosa_utama'] ?? null,
            'kd_diagnosa_utama' => $data['kd_diagnosa_utama'] ?? null,
            'diagnosa_sekunder' => $data['diagnosa_sekunder'] ?? null,
            'kd_diagnosa_sekunder' => $data['kd_diagnosa_sekunder'] ?? null,
            'diagnosa_sekunder2' => $data['diagnosa_sekunder2'] ?? null,
            'kd_diagnosa_sekunder2' => $data['kd_diagnosa_sekunder2'] ?? null,
            'diagnosa_sekunder3' => $data['diagnosa_sekunder3'] ?? null,
            'kd_diagnosa_sekunder3' => $data['kd_diagnosa_sekunder3'] ?? null,
            'diagnosa_sekunder4' => $data['diagnosa_sekunder4'] ?? null,
            'kd_diagnosa_sekunder4' => $data['kd_diagnosa_sekunder4'] ?? null,
            'prosedur_utama' => $data['prosedur_utama'] ?? null,
            'kd_prosedur_utama' => $data['kd_prosedur_utama'] ?? null,
            'prosedur_sekunder' => $data['prosedur_sekunder'] ?? null,
            'kd_prosedur_sekunder' => $data['kd_prosedur_sekunder'] ?? null,
            'prosedur_sekunder2' => $data['prosedur_sekunder2'] ?? null,
            'kd_prosedur_sekunder2' => $data['kd_prosedur_sekunder2'] ?? null,
            'prosedur_sekunder3' => $data['prosedur_sekunder3'] ?? null,
            'kd_prosedur_sekunder3' => $data['kd_prosedur_sekunder3'] ?? null,
            'kondisi_pulang' => $data['kondisi_pulang'] ?? null,
            'obat_pulang' => $data['obat_pulang'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->ResumeMedisRalan_model->update($no_rawat, $data_resume, $data_ttv);
        echo json_encode(['success' => $result]);
    }

    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');

        if (!$no_rawat) {
            echo json_encode(['success' => false, 'message' => 'Parameter no_rawat kosong']);
            return;
        }

        $result = $this->ResumeMedisRalan_model->delete($no_rawat);

        echo json_encode(['success' => $result]);
    }


    public function get_riwayat() {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $data = $this->ResumeMedisRalan_model->get_riwayat_by_norm($no_rkm_medis);
        echo json_encode($data);
    }

    public function get_ttv_latest() {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            echo json_encode(null);
            return;
        }

        $result = $this->ResumeMedisRalan_model->get_last_ttv($no_rawat);
        echo json_encode($result);
    }

    public function get_diagnosa_resume()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode([]);
            return;
        }

        $diagnosa = $this->ResumeMedisRalan_model->get_diagnosa_pasien($no_rawat);
        echo json_encode($diagnosa);
    }

    public function get_prosedur() {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->ResumeMedisRalan_model->get_prosedur_pasien($no_rawat);
        echo json_encode($data);
    }

    public function get_detail_resume()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(null);
            return;
        }

        $this->load->model('ResumeMedisRalan_model');
        $data = $this->ResumeMedisRalan_model->get_detail_by_no_rawat($no_rawat);
        echo json_encode($data);
    }

    public function cetak_pdf($encoded_no_rawat)
{
    $no_rawat = base64_decode($encoded_no_rawat);

    $this->load->model('ResumeMedisRalan_model');
    $resume = $this->ResumeMedisRalan_model->get_detail_by_no_rawat($no_rawat);
    if (!$resume) show_404();

    // Hitung umur lengkap
    $resume['umur_lengkap'] =
        ($resume['umur_thn'] ?? 0) . ' Th ' .
        ($resume['umur_bln'] ?? 0) . ' B ' .
        ($resume['umur_hr'] ?? 0) . ' Hr';

    // Ambil tanggal & dokter
    $reg = $this->db->select('tgl_registrasi, dokter.nm_dokter')
        ->from('reg_periksa')
        ->join('dokter', 'dokter.kd_dokter = reg_periksa.kd_dokter')
        ->where('no_rawat', $no_rawat)
        ->get()->row_array();
    $resume['tgl_registrasi'] = $reg['tgl_registrasi'] ?? '-';
    $resume['nm_dokter'] = $reg['nm_dokter'] ?? '-';

    // Load helper tanggal
    if (!function_exists('tanggal_indo')) $this->load->helper('tgl_indo');

    // === Generate QR Code ke base64 (tanpa buat file) ===
    $this->load->library('QrCode_lib');

    // Dapatkan IP LAN lokal agar bisa di-scan HP
    $ipLAN = getHostByName(getHostName());
    $port = $_SERVER['SERVER_PORT'];
    $urlQR = "http://{$ipLAN}:{$port}/rsiaandini/verifikasi/resume/" . $encoded_no_rawat;

    // Gunakan output buffering untuk tangkap hasil QR Code
    ob_start();
    $this->qrcode_lib->generate($urlQR, null); // null agar tidak disimpan ke file
    $imageData = ob_get_contents();
    ob_end_clean();

    // Simpan sebagai base64
    $resume['qr_code_base64'] = 'data:image/png;base64,' . base64_encode($imageData);

    // === Generate PDF pakai mPDF ===
    require_once FCPATH . 'vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
        'format' => [210, 330], // F4
        'orientation' => 'P'
    ]);

    $html = $this->load->view('resume_medis/pdf_resume_medis', ['resume' => $resume], true);
    $mpdf->WriteHTML($html);
    $mpdf->Output("resume_medis_{$no_rawat}.pdf", "I");
}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RehabMedikRalanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RehabMedikModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $no_rawat = $this->session->userdata('no_rawat');
        if (!$no_rawat) {
            // Fallback or error if accessible directly without valid session
            $data['error'] = 'No Rawat tidak ditemukan di sesi.';
        }

        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        // Fetch User Menu
        $user_id = $this->session->userdata('user_id');
        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);

        // Data pendukung untuk dropdown (Dokter & Petugas)
        $data['dokters'] = $this->RehabMedikModel->get_dokters();
        $data['petugas'] = $this->RehabMedikModel->get_petugas();

        $this->load->view('rehab_medik/form', $data);
    }

    public function get_history()
    {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->RehabMedikModel->get_by_no_rawat($no_rawat);

        // Enrich with doctor names if needed, or join in model. 
        // For simplicity, returning raw data today.

        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function get_detail()
    {
        $no_rawat = $this->input->get('no_rawat');
        $tgl = $this->input->get('tgl_perawatan');
        $jam = $this->input->get('jam_rawat');

        $data = $this->RehabMedikModel->get_detail($no_rawat, $tgl, $jam);
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    public function save()
    {
        // Get all POST data
        $post = $this->input->post();

        // Data for Rehab Medik table (SOAP)
        $rehabData = [
            'no_rawat' => $post['no_rawat'],
            'tgl_perawatan' => $post['tgl_perawatan'],
            'jam_rawat' => $post['jam_rawat'],
            'subjective' => $post['subjective'] ?? '',
            'objective' => $post['objective'] ?? '',
            'assessment' => $post['assessment'] ?? '',
            'procedure_text' => $post['procedure_text'] ?? '',
            'kd_dokter' => $post['kd_dokter'] ?? '',
            'nip_tim_rehab' => $post['nip_tim_rehab'] ?? ''
        ];

        // Data for SOAP table (SOAP + TTV + Instruksi + Evaluasi)
        $soapData = [
            'no_rawat' => $post['no_rawat'],
            'tgl_perawatan' => $post['tgl_perawatan'],
            'jam_rawat' => $post['jam_rawat'],
            // SOAP fields
            'keluhan' => $post['subjective'] ?? '',
            'pemeriksaan' => $post['objective'] ?? '',
            'penilaian' => $post['assessment'] ?? '',
            'rtl' => $post['procedure_text'] ?? '',
            // TTV fields
            'suhu_tubuh' => $post['suhu_tubuh'] ?? '',
            'tensi' => $post['tensi'] ?? '',
            'nadi' => $post['nadi'] ?? '',
            'respirasi' => $post['respirasi'] ?? '',
            'tinggi' => $post['tinggi'] ?? '',
            'berat' => $post['berat'] ?? '',
            'spo2' => $post['spo2'] ?? '',
            'gcs' => $post['gcs'] ?? '',
            // Instruksi & Evaluasi
            'instruksi' => $post['instruksi'] ?? '',
            'evaluasi' => $post['evaluasi'] ?? '',
            'nip' => $post['nip_tim_rehab'] ?? $this->session->userdata('user_nip')
        ];

        // Basic validation
        if (empty($rehabData['no_rawat']) || empty($rehabData['tgl_perawatan'])) {
            echo json_encode(['status' => 'error', 'message' => 'Data wajib (No Rawat/Tanggal) tidak lengkap.']);
            return;
        }

        // Start transaction
        $this->db->trans_start();

        // Save to Rehab Medik table
        $rehabSaved = $this->RehabMedikModel->save($rehabData);

        // Save to SOAP table (pemeriksaan_ralan)
        $soapSaved = $this->db->insert('pemeriksaan_ralan', $soapData);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE || !$rehabSaved) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data atau data duplikat']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan ke Rehab Medik dan SOAP']);
        }
    }

    public function update()
    {
        $post = $this->input->post();

        $no_rawat = $post['no_rawat'];
        $tgl = $post['tgl_perawatan'];
        $jam = $post['original_jam_rawat']; // Key lama

        // Data for Rehab Medik table
        $rehabData = [
            'tgl_perawatan' => $post['tgl_perawatan'],
            'jam_rawat' => $post['jam_rawat'],
            'subjective' => $post['subjective'] ?? '',
            'objective' => $post['objective'] ?? '',
            'assessment' => $post['assessment'] ?? '',
            'procedure_text' => $post['procedure_text'] ?? '',
            'kd_dokter' => $post['kd_dokter'] ?? '',
            'nip_tim_rehab' => $post['nip_tim_rehab'] ?? ''
        ];

        // Data for SOAP table
        $soapData = [
            'tgl_perawatan' => $post['tgl_perawatan'],
            'jam_rawat' => $post['jam_rawat'],
            // SOAP fields
            'keluhan' => $post['subjective'] ?? '',
            'pemeriksaan' => $post['objective'] ?? '',
            'penilaian' => $post['assessment'] ?? '',
            'rtl' => $post['procedure_text'] ?? '',
            // TTV fields
            'suhu_tubuh' => $post['suhu_tubuh'] ?? '',
            'tensi' => $post['tensi'] ?? '',
            'nadi' => $post['nadi'] ?? '',
            'respirasi' => $post['respirasi'] ?? '',
            'tinggi' => $post['tinggi'] ?? '',
            'berat' => $post['berat'] ?? '',
            'spo2' => $post['spo2'] ?? '',
            'gcs' => $post['gcs'] ?? '',
            // Instruksi & Evaluasi
            'instruksi' => $post['instruksi'] ?? '',
            'evaluasi' => $post['evaluasi'] ?? '',
            'nip' => $post['nip_tim_rehab'] ?? $this->session->userdata('user_nip')
        ];

        // Start transaction
        $this->db->trans_start();

        // Update Rehab Medik table
        $rehabUpdated = $this->RehabMedikModel->update($no_rawat, $tgl, $jam, $rehabData);

        // Update SOAP table
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tgl_perawatan', $tgl);
        $this->db->where('jam_rawat', $jam);
        $soapUpdated = $this->db->update('pemeriksaan_ralan', $soapData);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE || !$rehabUpdated) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal update']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        }
    }

    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tgl = $this->input->post('tgl_perawatan');
        $jam = $this->input->post('jam_rawat');

        if ($this->RehabMedikModel->delete($no_rawat, $tgl, $jam)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal hapus']);
        }
    }

    public function cetak()
    {
        $this->load->model('SettingModel');

        // Ambil dari GET Query String biar aman dari slash (/)
        $no_rawat = $this->input->get('no_rawat');
        $tgl_perawatan = $this->input->get('tgl_perawatan');
        $jam_rawat = $this->input->get('jam_rawat');

        if (empty($no_rawat) || empty($tgl_perawatan)) {
            show_error('Parameter cetak tidak lengkap.', 400);
            return;
        }

        $data['rehab'] = $this->RehabMedikModel->get_detail($no_rawat, $tgl_perawatan, $jam_rawat);
        $data['pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        // Ambil Header RS
        $data['setting'] = $this->db->get('setting')->row_array();

        if (empty($data['rehab'])) {
            show_error('Data tidak ditemukan', 404);
            return;
        }

        $this->load->view('rehab_medik/cetak', $data);
    }
}

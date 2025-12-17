<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedisPenyakitDalamController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AwalMedisPenyakitDalamModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->library('form_validation'); // Just in case
    }

    // Ini method yang akan dipanggil via RekamMedisRalanController/loadForm
    public function index()
    {
        // Data populated in RekamMedisRalanController usually, 
        // but if called directly via loadForm, data is passed linearly.
        // Actually, this method is mapped in RekamMedisRalanController, so the VIEW is loaded there.
        // But for completeness or direct access via AJAX if needed:

        $no_rawat = $this->input->get('no_rawat');
        // Note: The logic in RekamMedisRalanController handles the view loading.
        // This index method might be unused if strictly using the map mechanism which loads VIEW directly with data.

        // HOWEVER, to support standalone loading or debugging:
        if ($no_rawat) {
            $data['asesment'] = $this->AwalMedisPenyakitDalamModel->get_by_no_rawat($no_rawat);
            $this->load->view('rekammedis/dokter/awalMedisPenyakitDalam_view', $data);
        }
    }

    public function save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $no_rawat = $this->input->post('no_rawat');
        if (empty($no_rawat)) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak valid.']);
            return;
        }

        // Combine Tanggal & Jam Input
        $tgl_input = $this->input->post('tanggal_asesmen');
        $jam_input = $this->input->post('jam_asesmen');

        if ($tgl_input && $jam_input) {
            $tanggal_final = "$tgl_input $jam_input";
        } else {
            $tanggal_final = date('Y-m-d H:i:s');
        }

        // Collect Data
        $data = [
            'no_rawat' => $no_rawat,
            'tanggal' => $tanggal_final,
            'kd_dokter' => $this->session->userdata('kd_dokter') ?: '-', // Fallback if admin
            'anamnesis' => $this->input->post('anamnesis'),
            'hubungan' => $this->input->post('hubungan'),
            'keluhan_utama' => $this->input->post('keluhan_utama'),
            'rps' => $this->input->post('rps'),
            'rpd' => $this->input->post('rpd'),
            'rpo' => $this->input->post('rpo'),
            'alergi' => $this->input->post('alergi'),
            'kondisi' => $this->input->post('kondisi'),
            'status' => $this->input->post('status') ?: 'Tenang', // Fallback to prevent NULL error
            'td' => $this->input->post('td'),
            'nadi' => $this->input->post('nadi'),
            'suhu' => $this->input->post('suhu'),
            'rr' => $this->input->post('rr'),
            'bb' => $this->input->post('bb'),
            'nyeri' => $this->input->post('nyeri'),
            'gcs' => $this->input->post('gcs'),
            'kepala' => $this->input->post('kepala'),
            'keterangan_kepala' => $this->input->post('keterangan_kepala'),
            'thoraks' => $this->input->post('thoraks'),
            'keterangan_thorak' => $this->input->post('keterangan_thorak'),
            'abdomen' => $this->input->post('abdomen'),
            'keterangan_abdomen' => $this->input->post('keterangan_abdomen'),
            'ekstremitas' => $this->input->post('ekstremitas'),
            'keterangan_ekstremitas' => $this->input->post('keterangan_ekstremitas'),
            'lainnya' => $this->input->post('lainnya'),
            'lab' => $this->input->post('lab'),
            'rad' => $this->input->post('rad'),
            'penunjanglain' => $this->input->post('penunjanglain'),
            'diagnosis' => $this->input->post('diagnosis'),
            'diagnosis2' => $this->input->post('diagnosis2'),
            'permasalahan' => $this->input->post('permasalahan'),
            'terapi' => $this->input->post('terapi'),
            'tindakan' => $this->input->post('tindakan'),
            'edukasi' => $this->input->post('edukasi'),
        ];

        // Check exists
        if ($this->AwalMedisPenyakitDalamModel->exists($no_rawat)) {
            $updated = $this->AwalMedisPenyakitDalamModel->update($no_rawat, $data);
            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data.']);
            }
        } else {
            $inserted = $this->AwalMedisPenyakitDalamModel->insert($data);
            if ($inserted) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
            } else {
                $err = $this->db->error();
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan: ' . $err['message']]);
            }
        }
    }

    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        if ($this->AwalMedisPenyakitDalamModel->delete($no_rawat)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function print_pdf()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        require_once APPPATH . '../vendor/autoload.php';

        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        // Fallback for clean no_rawat
        if (!$data['detail_pasien']) {
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', $no_rawat));
        }

        $data['asesment'] = $this->AwalMedisPenyakitDalamModel->get_by_no_rawat($no_rawat);

        // Settings for logo etc
        $this->load->model('SettingModel');
        $data['setting'] = $this->SettingModel->get_setting();

        // Load view for PDF
        $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_penyakit_dalam', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Asesmen_Penyakit_Dalam_' . str_replace('/', '', $no_rawat) . '.pdf', 'I');
    }
}

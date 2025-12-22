<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedisPenyakitDalamController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AwalMedisPenyakitDalamModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $nr_get = $this->input->get('nr', true);
        $nr_compat = $this->input->get('no_rawat', true);
        $no_rawat = $nr_get ?: $nr_compat ?: $this->session->userdata('no_rawat');

        if (!$no_rawat) {
            redirect('RekamMedisRalanController');
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);
        $role_id = $this->session->userdata('role_id');

        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        if (!$data['detail_pasien']) {
            $clean = str_replace('/', '', $no_rawat);
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($clean);
            if ($data['detail_pasien'])
                $data['no_rawat'] = $clean;
        }

        $data['kd_dokter'] = ($role_id == 1)
            ? ($data['detail_pasien']['kd_dokter'] ?? '-')
            : $this->session->userdata('user_nip');

        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i');
        // Don't auto-load existing data - form should start blank
        $data['asesment'] = null; // Explicitly set to null to prevent any data loading
        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'] ?? '';

        $this->load->view('rekammedis/dokter/awalMedisPenyakitDalam_view', $data);
    }

    public function get_history()
    {
        $this->output->set_content_type('application/json');

        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'No RM tidak valid']);
            return;
        }

        $history = $this->AwalMedisPenyakitDalamModel->get_history($no_rkm_medis, $start_date, $end_date);
        echo json_encode(['status' => 'success', 'data' => $history]);
    }

    public function get_detail()
    {
        $this->output->set_content_type('application/json');

        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak valid']);
            return;
        }

        $detail = $this->AwalMedisPenyakitDalamModel->get_by_no_rawat($no_rawat);
        if ($detail) {
            echo json_encode(['status' => 'success', 'data' => $detail]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    public function save()
    {
        $this->output->set_content_type('application/json');
        $post = $this->input->post();

        if (empty($post['no_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak valid.']);
            return;
        }

        try {
            $tgl = $post['tanggal'] ?? date('Y-m-d');
            $jam = $post['jam'] ?? date('H:i');

            // Tambahkan detik :00 jika jam hanya format HH:MM
            if (preg_match('/^\d{2}:\d{2}$/', $jam)) {
                $jam .= ':00';
            }

            if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $tgl, $m)) {
                $tgl = $m[3] . '-' . $m[2] . '-' . $m[1];
            }
            $post['tanggal'] = "$tgl $jam";
            unset($post['jam']);

            // Whitelist: only save columns that exist in penilaian_medis_ralan_penyakit_dalam table
            $allowed = [
                'no_rawat',
                'tanggal',
                'kd_dokter',
                'anamnesis',
                'hubungan',
                'keluhan_utama',
                'rps',
                'rpd',
                'rpo',
                'alergi',
                'kondisi',
                'status',
                'td',
                'nadi',
                'suhu',
                'rr',
                'bb',
                'nyeri',
                'gcs',
                'kepala',
                'keterangan_kepala',
                'thoraks',
                'keterangan_thorak',
                'abdomen',
                'keterangan_abdomen',
                'ekstremitas',
                'keterangan_ekstremitas',
                'lainnya',
                'lab',
                'rad',
                'penunjanglain',
                'diagnosis',
                'diagnosis2',
                'permasalahan',
                'terapi',
                'tindakan',
                'edukasi'
            ];
            $post = array_intersect_key($post, array_flip($allowed));

            if ($this->AwalMedisPenyakitDalamModel->exists($post['no_rawat'])) {
                $this->AwalMedisPenyakitDalamModel->update($post['no_rawat'], $post);
            } else {
                $this->AwalMedisPenyakitDalamModel->insert($post);
            }

            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function delete()
    {
        $this->output->set_content_type('application/json');
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
        if (!$data['detail_pasien']) {
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', $no_rawat));
        }

        $data['asesment'] = $this->AwalMedisPenyakitDalamModel->get_by_no_rawat($no_rawat);

        $this->load->model('SettingModel');
        $data['setting'] = $this->SettingModel->get_setting();

        $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_penyakit_dalam', $data, true);

        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Asesmen_Penyakit_Dalam_' . $clean_no_rawat . '.pdf', 'I');
    }
}

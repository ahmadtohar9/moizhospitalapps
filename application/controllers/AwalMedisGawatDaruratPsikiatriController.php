<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedisGawatDaruratPsikiatriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AwalMedisGawatDaruratPsikiatriModel');
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
        $data['asesment'] = null;
        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'] ?? '';

        $this->load->view('rekammedis/dokter/awalMedisGawatDaruratPsikiatri_view', $data);
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

        $history = $this->AwalMedisGawatDaruratPsikiatriModel->get_history($no_rkm_medis, $start_date, $end_date);
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

        $detail = $this->AwalMedisGawatDaruratPsikiatriModel->get_by_no_rawat($no_rawat);
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

            if (!empty($post['lokalis_image'])) {
                $img = $post['lokalis_image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                if ($data) {
                    $dir = FCPATH . 'assets/images/lokalis_igd_psikiatri/';
                    if (!is_dir($dir))
                        mkdir($dir, 0777, true);

                    $filename = 'lokalis_' . str_replace('/', '', $post['no_rawat']) . '.png';
                    file_put_contents($dir . $filename, $data);
                }
            }
            unset($post['lokalis_image']);

            // Whitelist: Temporary full THT whitelist until specific schema is provided
            $allowed = [
                'no_rawat',
                'tanggal',
                'kd_dokter',
                'anamnesis',
                'hubungan',
                'keluhan_utama',
                'gejala_menyertai',
                'faktor_pencetus',
                'riwayat_penyakit_dahulu',
                'keterangan_riwayat_penyakit_dahulu',
                'riwayat_kehamilan',
                'riwayat_sosial',
                'keterangan_riwayat_sosial',
                'riwayat_pekerjaan',
                'keterangan_riwayat_pekerjaan',
                'riwayat_obat_diminum',
                'faktor_kepribadian_premorbid',
                'faktor_keturunan',
                'keterangan_faktor_keturunan',
                'faktor_organik',
                'keterangan_faktor_organik',
                'riwayat_alergi',
                'fisik_kesadaran',
                'fisik_td',
                'fisik_rr',
                'fisik_suhu',
                'fisik_nyeri',
                'fisik_nadi',
                'fisik_bb',
                'fisik_tb',
                'fisik_status_nutrisi',
                'fisik_gcs',
                'status_kelainan_kepala',
                'keterangan_status_kelainan_kepala',
                'status_kelainan_leher',
                'keterangan_status_kelainan_leher',
                'status_kelainan_dada',
                'keterangan_status_kelainan_dada',
                'status_kelainan_perut',
                'keterangan_status_kelainan_perut',
                'status_kelainan_anggota_gerak',
                'keterangan_status_kelainan_anggota_gerak',
                'status_lokalisata',
                'psikiatrik_kesan_umum',
                'psikiatrik_sikap_prilaku',
                'psikiatrik_kesadaran',
                'psikiatrik_orientasi',
                'psikiatrik_daya_ingat',
                'psikiatrik_persepsi',
                'psikiatrik_pikiran',
                'psikiatrik_insight',
                'laborat',
                'radiologi',
                'ekg',
                'diagnosis',
                'permasalahan',
                'instruksi_medis',
                'rencana_target',
                'pulang_dipulangkan',
                'keterangan_pulang_dipulangkan',
                'pulang_dirawat_diruang',
                'pulang_indikasi_ranap',
                'pulang_dirujuk_ke',
                'pulang_alasan_dirujuk',
                'pulang_paksa',
                'keterangan_pulang_paksa',
                'pulang_meninggal_igd',
                'pulang_penyebab_kematian',
                'fisik_pulang_kesadaran',
                'fisik_pulang_td',
                'fisik_pulang_nadi',
                'fisik_pulang_gcs',
                'fisik_pulang_suhu',
                'fisik_pulang_rr',
                'edukasi'
            ];
            $post = array_intersect_key($post, array_flip($allowed));

            if ($this->AwalMedisGawatDaruratPsikiatriModel->exists($post['no_rawat'])) {
                $this->AwalMedisGawatDaruratPsikiatriModel->update($post['no_rawat'], $post);
            } else {
                $this->AwalMedisGawatDaruratPsikiatriModel->insert($post);
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

        $clean = str_replace('/', '', $no_rawat);
        $path = FCPATH . 'assets/images/lokalis_igd_psikiatri/lokalis_' . $clean . '.png';
        if (file_exists($path))
            unlink($path);

        if ($this->AwalMedisGawatDaruratPsikiatriModel->delete($no_rawat)) {
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

        $data['asesment'] = $this->AwalMedisGawatDaruratPsikiatriModel->get_by_no_rawat($no_rawat);

        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $lokalis_path = FCPATH . 'assets/images/lokalis_igd_psikiatri/lokalis_' . $clean_no_rawat . '.png';
        if (file_exists($lokalis_path)) {
            $data['lokalis_path'] = $lokalis_path;
        } else {
            $data['lokalis_path'] = FCPATH . 'assets/images/status_lokalis_psikiatri.png'; // Updated placeholder
        }

        $this->load->model('SettingModel');
        $data['setting'] = $this->SettingModel->get_setting();

        $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_gawat_darurat_psikiatri', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Asesmen_IGD_Psikiatri_' . $clean_no_rawat . '.pdf', 'I');
    }
}

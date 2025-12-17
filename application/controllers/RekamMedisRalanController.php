<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekamMedisRalanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'RekamMedisRalanModel',
            'PasienRajal_model',
            'MenuModel',
            'SoapRalanModel'
        ]);
        $this->load->helper('norawat');

        if (!$this->session->userdata('user_id'))
            redirect('auth/login');

        $user_id = $this->session->userdata('user_id');
        $user_menus = $this->MenuModel->get_menu_by_user($user_id);
        if (empty($user_menus)) {
            log_message('error', "User ID: {$user_id} tidak memiliki akses menu.");
            show_error('Akses ditolak! Tidak ada menu yang tersedia untuk Anda.', 403, 'Error');
        }
    }

    /* ====== TABSET (DYNAMIC DB) ====== */
    private function getTabset(): array
    {
        // Load Model RME
        if (!isset($this->RmeMenuModel)) {
            $this->load->model('RmeMenuModel');
        }

        $tabs = [];

        // 1. Jika Admin (Role 1), Tampilkan SEMUA Menu Tab yang ada di DB
        if ($this->session->userdata('role_id') == 1) {
            $all_menus = $this->RmeMenuModel->get_all_menus();
            foreach ($all_menus as $m) {
                if ($m['is_active']) {
                    $tabs[$m['tab_name']] = $m['tab_url'];
                }
            }
            return $tabs;
        }

        // 2. Jika User Biasa (Dokter/Perawat), Tampilkan HANYA yang diberi akses
        $user_id = $this->session->userdata('user_id');
        $my_menus = $this->RmeMenuModel->get_menus_by_user_complete($user_id);

        if (empty($my_menus)) {
            // Fallback: Jika belum disetting sama sekali, tampilkan kosong (or logic lama jika mau)
            // Tapi demi keamanan dan fleksibilitas, kita return kosong agar Admin sadar harus setting.
            return [];
        }

        foreach ($my_menus as $m) {
            $tabs[$m['tab_name']] = $m['tab_url'];
        }

        return $tabs;
    }

    // ROUTE: /RekamMedisRalanController/rekammedisRalanForm/{YYYY}/{MM}/{DD}/{NO_RAWAT}[/{context}]
    public function rekammedisRalanForm($tahun, $bulan, $tanggal, $no_rawat, $context = null)
    {
        $full_no_rawat = "$tahun/$bulan/$tanggal/$no_rawat";
        $this->session->set_userdata('no_rawat', $full_no_rawat);

        $override = $context ?: $this->input->get('as', true);
        $override = $override ? strtolower(trim($override)) : null;

        $role_id = (int) $this->session->userdata('role_id');
        if (!in_array($role_id, [3, 4], true) && in_array($override, ['dokter', 'perawat'], true)) {
            $this->session->set_userdata('tabset_as', $override);
        }

        $data = [];
        $data['title'] = 'Form Rekam Medis';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['no_rawat'] = $full_no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($full_no_rawat);
        if (!$data['detail_pasien'])
            show_error('Detail pasien tidak ditemukan.', 404, 'Error');

        $data['tabs'] = $this->getTabset();
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['action_menus'] = [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('rekammedis/rekammedisRalanForm', $data);
        $this->load->view('templates/footer');
    }

    // Dipanggil via AJAX ketika klik tab.
    public function loadForm($menu_url)
    {
        // 1) Ambil no_rawat: utamakan query (?nr= / ?no_rawat=), fallback ke session
        $nr_get = $this->input->get('nr', true);
        $nr_compat = $this->input->get('no_rawat', true); // kompatibel dgn kode lama
        $no_rawat = $nr_get ?: $nr_compat ?: $this->session->userdata('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Buka form dari halaman utama pasien.', 400, 'Error');
            return;
        }

        // 2) Normalisasi: ijinkan format "YYYY/MM/DD/NNNNNN" (paling aman)
        //    Kalau bukan format penuh (tidak ada "/"), tetap lanjutkan—nanti get_patient_detail akan memvalidasi.
        $is_full_format = strpos($no_rawat, '/') !== false;

        // 3) Siapkan data dasar pasien (ini sekaligus validasi no_rawat)
        $data = [];
        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan atau no_rawat tidak valid.', 404, 'Error');
            return;
        }

        // 4) Turunan data yang sering dipakai view
        $data['kd_dokter'] = $data['detail_pasien']['kd_dokter'] ?? '';
        $data['no_rkm_medis'] = $this->RekamMedisRalanModel->getNormByNoRawat($no_rawat);
        $data['kd_poli'] = $data['detail_pasien']['kd_poli'] ?? null;
        $data['nm_poli'] = $data['detail_pasien']['nm_poli'] ?? null;

        $data['nip_perawat'] = ''; // Default kosong (untuk Admin/Dokter)
        $role_id = (int) $this->session->userdata('role_id');
        $as = strtolower((string) $this->session->userdata('tabset_as'));
        if ($role_id === 4 || $as === 'perawat') {
            $data['nip_perawat'] = $this->session->userdata('user_nip') ?: '';
        }

        // 5) Decode menu_url ("/" di-encode jadi "~" dari FE) + urldecode jaga-jaga
        $decodedUrl = urldecode(str_replace('~', '/', (string) $menu_url));

        // 6) Peta controller → model & view (yang memang perlu model)
        $form_map = [
            'AwalMedisIGDController/index' => ['model' => 'AwalMedisIGDModel', 'view' => 'rekammedis/dokter/awalMedisIGD_view'], // MENU IGD BARU
            'AwalMedisPenyakitDalamController/index' => [
                'model' => 'AwalMedisPenyakitDalamModel',
                'view' => 'rekammedis/dokter/awalMedisPenyakitDalam_view'
            ],
            'AwalMedisOrthopediController/index' => [
                'model' => 'AwalMedisOrthopediModel',
                'view' => 'rekammedis/dokter/awalMedisOrthopedi_view'
            ], // Assesmen Penyakit Dalam

            'AwalMedisDokterMataRalanController/index' => ['model' => 'awalMedisDokterMataRalanModel', 'view' => 'rekammedis/dokter/awalMedisDokterMata_view'],
            'SoapRalanController/index' => ['model' => 'SoapRalanModel', 'view' => 'rekammedis/soap_ralan'],
            'TindakanRalanDokterController/index' => ['model' => 'TindakanRalanDokterModel', 'view' => 'rekammedis/dokter/tindakanRalan'],
            'PermintaanResepRalan/index' => ['model' => 'PermintaanResepRalan_model', 'view' => 'rekammedis/dokter/permintaanResepRalan'],
            'PermintaanResepRacikanRalanController/index' => ['model' => 'PermintaanResepRacikanRalan_model', 'view' => 'rekammedis/dokter/permintaanResepRacikanRalan'],
            'DiagnosaProsedurRalanController/index' => ['model' => 'DiagnosaProsedurRalanModel', 'view' => 'rekammedis/dokter/diagnosaProsedurRalan'],
            'PermintaanRadiologiController/index' => ['model' => 'PermintaanRadiologiModel', 'view' => 'rekammedis/dokter/permintaanRadiologi_form'],
            'PermintaanLabRalanController/index' => ['model' => 'PermintaanLabRalanModel', 'view' => 'rekammedis/dokter/permintaanLabRalan_form'],
            'PermintaanLabBaruController/index' => ['model' => 'PermintaanLabBaruModel', 'view' => 'rekammedis/dokter/permintaanLabBaru_form'],
            'ResumeMedisRalanController/index' => ['model' => 'ResumeMedisRalan_model', 'view' => 'rekammedis/dokter/resumeMedisRalan_form'],
            'RiwayatPasienController/index' => ['model' => 'RiwayatPasien_model', 'view' => 'rekammedis/riwayatPasien_form'],

            'dokterRalan/PenunjangRalanController/index' => ['model' => 'DokterRalanModel/PenunjangRalanModel', 'view' => 'rekammedis/dokter/penunjangRalan_form'],
            'dokterRalan/LaporanTindakanRalanDokterController/index' => ['model' => 'DokterRalanModel/LaporanTindakanRalanDokterModel', 'view' => 'rekammedis/dokter/laporanTindakanRalan_form'],
            'dokterRalan/SuratSakitRalanController/index' => ['model' => 'DokterRalanModel/SuratSakitRalanModel', 'view' => 'rekammedis/dokter/suratSakitRalan_form'],
            'dokterRalan/RujukanKeluarRalanController/index' => ['model' => 'DokterRalanModel/RujukanKeluarRalanModel', 'view' => 'rekammedis/dokter/rujukanKeluarRalan_form'],

            'OperasiController/index' => ['model' => 'OperasiModel', 'view' => 'rekammedis/dokter/input_operasi_view'],

            // Rehab Medik (Handle both versions to be safe)
            'RehabMedikRalanController/index' => ['model' => 'RehabMedikModel', 'view' => 'rehab_medik/form'],
            'RehabMedikController/index' => ['model' => 'RehabMedikModel', 'view' => 'rehab_medik/form'],
            'FormulirKfrRalanController/index' => ['model' => 'FormulirKfrModel', 'view' => 'formulir_kfr/form'],

            // Perawat (yang pakai model)
            'perawat/SoapPerawatController/index' => ['model' => 'perawat/SoapPerawatModel', 'view' => 'perawat/soap_perawat'],
            'perawat/TindakanRalanPerawatController/index' => ['model' => 'perawat/TindakanRalanPerawatModel', 'view' => 'perawat/tindakanRalan'],
            // Note: Assessment perawat kita load via view langsung (router), jadi tidak perlu entry di sini
        ];

        // 7) Jika ada di peta, load model lalu view
        if (isset($form_map[$decodedUrl])) {
            $entry = $form_map[$decodedUrl];

            // [LOGIC KHUSUS] Awal Medis IGD (Injection Data)
            if ($decodedUrl === 'AwalMedisIGDController/index') {
                $this->load->model('AwalMedisIGDModel'); // Pastikan load model
                $data['asesment'] = $this->AwalMedisIGDModel->get_by_no_rawat($no_rawat);
                $data['tgl_sekarang'] = date('Y-m-d');
                $data['jam_sekarang'] = date('H:i:s');
            }

            // [LOGIC KHUSUS] Awal Medis Penyakit Dalam
            if ($decodedUrl === 'AwalMedisPenyakitDalamController/index') {
                $this->load->model('AwalMedisPenyakitDalamModel');
                $data['asesment'] = $this->AwalMedisPenyakitDalamModel->get_by_no_rawat($no_rawat);
                $data['tgl_sekarang'] = date('Y-m-d');
                $data['jam_sekarang'] = date('H:i:s');
            }

            // [LOGIC KHUSUS] Awal Medis Orthopedi
            if ($decodedUrl === 'AwalMedisOrthopediController/index') {
                $this->load->model('AwalMedisOrthopediModel');
                $data['asesment'] = $this->AwalMedisOrthopediModel->get_by_no_rawat($no_rawat);
                $data['tgl_sekarang'] = date('Y-m-d');
                $data['jam_sekarang'] = date('H:i:s');
            }

            if (!empty($entry['model']))
                $this->load->model($entry['model']);

            // [PATCH] Inject data SOAP terakhir khusus untuk menu Resep
            if ($decodedUrl === 'PermintaanResepRalan/index') {
                $soap_list = $this->RekamMedisRalanModel->getHasilSOAP($no_rawat);
                $data['last_soap'] = !empty($soap_list) ? $soap_list[0] : null;
            }

            // [PATCH] Inject data OPERASI
            if ($decodedUrl === 'OperasiController/index') {
                date_default_timezone_set('Asia/Jakarta');
                $data['tgl_sekarang'] = date('Y-m-d');
                $data['jam_sekarang'] = date('H:i:s');
                $data['paket_operasi'] = $this->OperasiModel->get_paket_operasi();
                $data['dokter'] = $this->OperasiModel->get_dokter();
                $data['petugas'] = $this->OperasiModel->get_petugas();
                $data['list_operasi'] = $this->OperasiModel->get_operasi_by_no_rawat($no_rawat);
            }

            // [PATCH] Inject data Rehab Medik
            if ($decodedUrl === 'RehabMedikRalanController/index' || $decodedUrl === 'RehabMedikController/index') {
                $this->load->model('RehabMedikModel'); // Load model
                // Ambil data pendukung buat dropdown
                $data['dokters'] = $this->RehabMedikModel->get_dokters();
                $data['petugas'] = $this->RehabMedikModel->get_petugas();
            }

            // [PATCH] Inject data Formulir KFR
            if ($decodedUrl === 'FormulirKfrRalanController/index') {
                $this->load->model('FormulirKfrModel');
                $data['dokters'] = $this->FormulirKfrModel->get_dokters();
            }

            $this->load->view($entry['view'], $data);
            return;
        }

        // 8) Fallback: path view langsung (termasuk perawat/assesmen/router)
        $form_path = $decodedUrl;

        // Lindungi traversal & whitespace aneh
        if (strpos($form_path, '..') !== false) {
            log_message('error', "Attempted path traversal: {$form_path}");
            show_error('Path tidak valid.', 400, 'Error');
            return;
        }
        $form_path = trim($form_path, '/');

        if (file_exists(APPPATH . "views/{$form_path}.php")) {
            $this->load->view($form_path, $data);
        } else {
            log_message('error', "Form tidak ditemukan di path: views/{$form_path}.php");
            echo '<div class="alert alert-danger">Form belum tersedia atau salah URL.</div>';
        }
    }


    public function setNoRawatSession()
    {
        $no_rawat = $this->input->post('no_rawat');
        if ($no_rawat) {
            $this->session->set_userdata('no_rawat', $no_rawat);
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'message' => 'No Rawat disimpan.']));
        } else {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.']));
        }
    }
}

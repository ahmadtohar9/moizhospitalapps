<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedisDokterMataRalanController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('awalMedisDokterMataRalanModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        // FIX: Ambil no_rawat dari multiple sources
        $nr_get    = $this->input->get('nr', true);
        $nr_compat = $this->input->get('no_rawat', true);
        $no_rawat  = $nr_get ?: $nr_compat ?: $this->session->userdata('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        // FIX: Update session dengan no_rawat yang valid
        $this->session->set_userdata('no_rawat', $no_rawat);

        $role_id = $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');

        $data['no_rawat'] = $no_rawat;
        
        // FIX: Coba kedua format no_rawat
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$data['detail_pasien']) {
            $no_rawat_clean = str_replace('/', '', $no_rawat);
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat_clean);
            if ($data['detail_pasien']) {
                $data['no_rawat'] = $no_rawat_clean;
                $this->session->set_userdata('no_rawat', $no_rawat_clean);
            }
        }

        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan.', 404, 'Error');
            return;
        }

        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'];
        $data['kd_dokter']    = ($role_id == 1)
            ? ($data['detail_pasien']['kd_dokter'] ?? null)
            : $this->session->userdata('user_nip');

        // ✅ FIX: Set tanggal dan jam default untuk view
        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i:s');

        $data['menus']        = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        $this->load->view('rekammedis/dokter/awalMedisDokterMataRalan_view', $data);
    }

    // ✅ FIXED: Simpan data dengan validasi lengkap
    public function save()
    {
        $this->output->set_content_type('application/json');
        
        $post = $this->input->post();
        
        // Debug log
        log_message('debug', 'Save Data: ' . print_r($post, true));
        
        if (!$post) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dikirim.']); 
            return;
        }

        // Validasi required fields
        $required = ['no_rawat', 'tgl_perawatan', 'jam_rawat'];
        foreach ($required as $field) {
            if (empty($post[$field])) {
                echo json_encode(['status' => 'error', 'message' => "Field $field wajib diisi."]); 
                return;
            }
        }

        try {
            // Gabungkan tanggal dan jam
            $post['tanggal'] = $post['tgl_perawatan'] . ' ' . $post['jam_rawat'];
            
            // Validasi format datetime
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $post['tanggal']);
            if (!$datetime) {
                echo json_encode(['status' => 'error', 'message' => 'Format tanggal dan jam tidak valid.']); 
                return;
            }

            // Set dokter dari session
            $role_id = $this->session->userdata('role_id');
            $post['kd_dokter'] = ($role_id == 1) 
                ? ($post['kd_dokter'] ?? null) 
                : $this->session->userdata('user_nip');

            // Hapus field helper
            unset($post['tgl_perawatan'], $post['jam_rawat']);

            // Cek duplikasi
            if ($this->awalMedisDokterMataRalanModel->exists($post['no_rawat'])) {
                echo json_encode(['status' => 'error', 'message' => 'Data untuk no_rawat ini sudah ada. Gunakan edit.']); 
                return;
            }

            // Simpan ke database
            if ($this->awalMedisDokterMataRalanModel->insert($post)) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
            }

        } catch (Exception $e) {
            log_message('error', 'Save Error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    // ✅ Update data (berdasarkan no_rawat, waktu awal tidak diubah)
    public function update()
    {
        $post = $this->input->post();
        if (empty($post['no_rawat']) || empty($post['tgl_perawatan']) || empty($post['jam_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'no_rawat, tgl_perawatan, dan jam_rawat wajib diisi.']);
            return;
        }

        // Ambil data lama
        $existing = $this->awalMedisDokterMataRalanModel->getByNoRawat($post['no_rawat']);
        if (!$existing) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan untuk no_rawat tersebut.']);
            return;
        }

        // Update kolom tanggal dari input user
        $post['tanggal'] = $post['tgl_perawatan'] . ' ' . $post['jam_rawat'];

        // Set dokter sesuai role
        $role_id = $this->session->userdata('role_id');
        $post['kd_dokter'] = ($role_id == 1)
            ? ($post['kd_dokter'] ?? $existing['kd_dokter'])
            : $this->session->userdata('user_nip');

        // Hapus helper fields
        unset($post['tgl_perawatan'], $post['jam_rawat'], $post['original_jam_rawat']);

        // Amankan: jangan ubah no_rawat di data
        $no_rawat = $post['no_rawat'];
        unset($post['no_rawat']);

        if ($this->awalMedisDokterMataRalanModel->updateByNoRawat($no_rawat, $post)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal update (tidak ada perubahan atau error DB).']);
        }
    }

    // ✅ Hapus data (1 baris per no_rawat)
    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter no_rawat tidak boleh kosong.']); return;
        }

        $cek = $this->awalMedisDokterMataRalanModel->getByNoRawat($no_rawat);
        if (!$cek) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan.']); return;
        }

        if ($this->awalMedisDokterMataRalanModel->deleteByNoRawat($no_rawat)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus dari database.']);
        }
    }

    // ✅ List hasil untuk no_rawat (tetap array)
    public function getHasil()
    {
        // FIX: Ambil no_rawat dari multiple sources
        $no_rawat_get = $this->input->get('no_rawat');
        $no_rawat_session = $this->session->userdata('no_rawat');
        $no_rawat = $no_rawat_get ?: $no_rawat_session;

        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.']); return;
        }

        $data = $this->awalMedisDokterMataRalanModel->getHasil($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data ?: []]);
    }

    // ✅ Detail untuk edit (split datetime → tgl_perawatan & jam_rawat)
    public function getDetail()
    {
        // FIX: Ambil no_rawat dari multiple sources
        $no_rawat_get = urldecode($this->input->get('no_rawat'));
        $no_rawat_session = $this->session->userdata('no_rawat');
        $no_rawat = $no_rawat_get ?: $no_rawat_session;

        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor rawat tidak ditemukan.']); return;
        }

        $row = $this->awalMedisDokterMataRalanModel->getByNoRawat($no_rawat);
        if (!$row) {
            // Coba tanpa slash
            $no_rawat_clean = str_replace('/', '', $no_rawat);
            $row = $this->awalMedisDokterMataRalanModel->getByNoRawat($no_rawat_clean);
        }

        if ($row) {
            if (!empty($row['tanggal'])) {
                $row['tgl_perawatan'] = date('Y-m-d', strtotime($row['tanggal']));
                $row['jam_rawat']     = date('H:i:s', strtotime($row['tanggal']));
            } else {
                $row['tgl_perawatan'] = '';
                $row['jam_rawat']     = '';
            }
            echo json_encode(['status' => 'success', 'data' => $row]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
        }
    }

    // ✅ Riwayat per No.RM
    public function getRiwayatByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor Rekam Medis tidak ditemukan.']); return;
        }

        $data = $this->awalMedisDokterMataRalanModel->getRiwayatByNoRM($no_rkm_medis);
        echo json_encode(['status' => 'success', 'data' => $data ?: []]);
    }

    // ✅ Auto-fill dari entri terakhir di no_rawat
    public function getLast()
    {
        // FIX: Ambil no_rawat dari multiple sources
        $no_rawat_get = $this->input->get('no_rawat');
        $no_rawat_session = $this->session->userdata('no_rawat');
        $no_rawat = $no_rawat_get ?: $no_rawat_session;

        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.']); return;
        }

        $row = $this->awalMedisDokterMataRalanModel->getLastByNoRawat($no_rawat);
        echo json_encode($row ? ['status' => 'success', 'data' => $row] : ['status' => 'empty', 'data' => null]);
    }

    // ✅ Sync session untuk maintain consistency
    public function syncSession()
    {
        $no_rawat = $this->input->post('no_rawat');
        if ($no_rawat) {
            $this->session->set_userdata('no_rawat', $no_rawat);
            echo json_encode(['status' => 'success', 'message' => 'Session updated']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No rawat required']);
        }
    }

    public function print_pdf()
{
    // FIX: Ambil no_rawat dari multiple sources
    $no_rawat_get = $this->input->get('no_rawat');
    $no_rawat_session = $this->session->userdata('no_rawat');
    $no_rawat = $no_rawat_get ?: $no_rawat_session;

    if (!$no_rawat) {
        show_error('No Rawat tidak ditemukan. Silakan pilih pasien dahulu.', 400, 'Error');
        return;
    }

    require_once APPPATH . '../vendor/autoload.php';

    // --- Ambil data pasien (dengan fallback tanpa slash) ---
    $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
    if (!$detail_pasien) {
        $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', $no_rawat));
    }
    if (!$detail_pasien) {
        show_error('Data pasien tidak ditemukan.', 404, 'Error');
        return;
    }

    // --- Ambil asesmen awal mata (fallback juga) ---
    $assesment = $this->awalMedisDokterMataRalanModel->getByNoRawat($no_rawat);
    if (!$assesment) {
        $assesment = $this->awalMedisDokterMataRalanModel->getByNoRawat(str_replace('/', '', $no_rawat));
    }
    if (!$assesment) {
        show_error('Data asesmen medis mata tidak ditemukan.', 404, 'Error');
        return;
    }

    // --- Setting RS (nama, alamat, logo) ---
    $setting = $this->SettingModel->get_setting();
    
    // Pecah tanggal
    $tgl = $jam = '-';
    if (!empty($assesment['tanggal'])) {
        $dt  = strtotime($assesment['tanggal']);
        if ($dt) {
            $tgl = date('d/m/Y', $dt);
            $jam = date('H:i:s', $dt);
        }
    }

    // Format tanggal lahir
    $tgl_lahir = '-';
    if (!empty($detail_pasien['tgl_lahir'])) {
        $tgl_lahir = date('d/m/Y', strtotime($detail_pasien['tgl_lahir']));
    }

    // View data
    $data = [
        'setting'       => $setting,
        'detail_pasien' => $detail_pasien,
        'assesment'     => $assesment,
        'tgl'           => $tgl,
        'jam'           => $jam,
        'tgl_lahir'     => $tgl_lahir,
        'app_name'      => $this->config->item('app_name') ?? 'SIMRS',
    ];

    // Render HTML body
    $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_mata', $data, true);

    // Temp dir mPDF
    $tempDir = FCPATH . 'tmp/mpdf';
    if (!is_dir($tempDir)) {
        @mkdir($tempDir, 0777, true);
    }

    // Inisialisasi mPDF
    $mpdf = new \Mpdf\Mpdf([
        'tempDir'       => $tempDir,
        'format'        => 'A4',
        'margin_top'    => 25,
        'margin_right'  => 12,
        'margin_bottom' => 15,
        'margin_left'   => 12,
        'default_font_size' => 9,
        'default_font' => 'arial'
    ]);

    // ===== LOGO HANDLING YANG FIXED =====
    $logo_data_uri = $this->getLogoDataUri($setting);
    
    $headerHtml = '
    <div style="font-size: 9px; border-bottom: 1px solid #000; padding-bottom: 3px; margin-bottom: 5px;">
        <table width="100%" style="border: none; margin: 0; padding: 0;">
            <tr>
                <td width="15%" style="border: none; vertical-align: middle; padding: 0; text-align: center;">
                    <img src="' . $logo_data_uri . '" style="height: 35px; max-width: 100%; display: block;">
                </td>
                <td style="border: none; vertical-align: middle; padding: 0 0 0 8px;">
                    <div style="font-weight: bold; font-size: 10px; line-height: 1.2;">' . htmlspecialchars($setting['nama_instansi'] ?? ($data['app_name'] ?? 'SIMRS')) . '</div>
                    <div style="font-size: 8px; line-height: 1.2;">' . htmlspecialchars($setting['alamat_instansi'] ?? '') . '</div>
                    <div style="font-size: 7px; line-height: 1.2;">
                        Telp: ' . htmlspecialchars($setting['kontak'] ?? '-') . '
                        ' . (!empty($setting['email']) ? ' | Email: ' . htmlspecialchars($setting['email']) : '') . '
                    </div>
                </td>
            </tr>
        </table>
    </div>';

    $mpdf->SetHTMLHeader($headerHtml);
    $mpdf->SetHTMLFooter('<div style="font-size:8px;color:#666;text-align:center">Halaman {PAGENO} dari {nb}</div>');

    // Tulis isi
    $mpdf->WriteHTML($html);

    // Output
    $filename = 'PENILAIAN_AWAL_MEDIS_MATA_' . preg_replace('~/~', '', $no_rawat) . '.pdf';
    $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
}

/**
 * Helper function untuk handle logo - FIXED VERSION
 */
private function getLogoDataUri($setting)
{
    if (empty($setting['logo'])) {
        // Return placeholder jika logo tidak ada
        return $this->createLogoPlaceholder();
    }

    $logo_val = $setting['logo'];

    // Cek jika sudah format data URI
    if (strpos($logo_val, 'data:image') === 0) {
        return $logo_val;
    }

    // Cek jika URL external
    if (filter_var($logo_val, FILTER_VALIDATE_URL) !== false) {
        return $logo_val;
    }

    // Cek jika path file lokal - DENGAN VALIDASI PATH
    $possible_paths = [];
    
    // Clean path dulu
    $clean_logo_val = ltrim($logo_val, '/\\');
    
    // Generate possible paths dengan validasi
    $base_paths = [
        '', // original path
        'uploads/',
        'assets/images/',
        'images/',
        'assets/',
        'upload/'
    ];

    foreach ($base_paths as $base) {
        $path = $base . $clean_logo_val;
        $full_path = FCPATH . $path;
        
        // Validasi path sebelum digunakan
        if ($this->isValidPath($full_path) && file_exists($full_path) && is_file($full_path)) {
            $possible_paths[] = $full_path;
        }
    }

    // Juga cek path asli (tanpa FCPATH) jika valid
    if ($this->isValidPath($logo_val) && file_exists($logo_val) && is_file($logo_val)) {
        $possible_paths[] = $logo_val;
    }

    // Coba setiap path yang valid
    foreach ($possible_paths as $path) {
        if ($this->isValidImageFile($path)) {
            $mime_type = mime_content_type($path);
            $image_data = @file_get_contents($path);
            if ($image_data && $mime_type) {
                return 'data:' . $mime_type . ';base64,' . base64_encode($image_data);
            }
        }
    }

    // Fallback ke placeholder jika semua gagal
    return $this->createLogoPlaceholder();
}

/**
 * Validasi path untuk mencegah error
 */
private function isValidPath($path)
{
    if (empty($path)) {
        return false;
    }
    
    // Cek jika path mengandung karakter berbahaya
    if (preg_match('/[<>:"|?*]/', $path)) {
        return false;
    }
    
    // Cek panjang path (Windows limit ~260 chars)
    if (strlen($path) > 250) {
        return false;
    }
    
    return true;
}

/**
 * Validasi file gambar
 */
private function isValidImageFile($path)
{
    if (!file_exists($path) || !is_file($path)) {
        return false;
    }
    
    $allowed_mimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
    $mime_type = mime_content_type($path);
    
    return in_array($mime_type, $allowed_mimes);
}

/**
 * Buat logo placeholder
 */
private function createLogoPlaceholder()
{
    return 'data:image/svg+xml;base64,' . base64_encode('
        <svg width="50" height="35" xmlns="http://www.w3.org/2000/svg">
            <rect width="50" height="35" fill="#f8f9fa" stroke="#dee2e6"/>
            <text x="25" y="20" font-family="Arial" font-size="10" text-anchor="middle" fill="#6c757d">LOGO</text>
        </svg>
    ');
}
}
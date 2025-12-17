<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerkasDigitalController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // MODEL
        $this->load->model('BerkasDigital/BerkasDigitalModel', 'BerkasModel');
        $this->load->model('MenuModel');

        // HELPER
        $this->load->helper(['url', 'berkas', 'file']);

         // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    /* ============================ UTIL ============================ */
    private function json($payload, $code = 200)
    {
        if (property_exists($this, 'security')) {
            $payload['csrfToken'] = $this->security->get_csrf_hash();
            $payload['csrfName']  = $this->security->get_csrf_token_name();
        }
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    /* ============================ VIEW ============================ */
    public function index()
    {
        $data = [];
        $data['nama_user']    = $this->session->userdata('nama_user');
        $data['menus']        = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();
        $data['tanggal']      = date('Y-m-d');
        $data['master_berkas']= $this->BerkasModel->getMasterAll();
        $data['title']        = 'Berkas Digital Perawatan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('rekammedis/berkas_digital_form', $data);
        $this->load->view('templates/footer');
    }


    /* ====================== PASIEN PER TANGGAL (JSON) ====================== */
    public function getPasienByTanggal()
    {
        $tgl = $this->input->get('tanggal', true) ?: date('Y-m-d');
        if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
            return $this->json(['status' => 'error', 'message' => 'Format tanggal tidak valid.'], 422);
        }

        $this->db->select('rp.no_rawat, rp.tgl_registrasi, rp.jam_reg,
                           p.no_rkm_medis, p.nm_pasien,
                           d.nm_dokter, pl.nm_poli, pj.png_jawab')
                 ->from('reg_periksa rp')
                 ->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'left')
                 ->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'left')
                 ->join('poliklinik pl', 'rp.kd_poli = pl.kd_poli', 'left')
                 ->join('penjab pj', 'rp.kd_pj = pj.kd_pj', 'left')
                 ->where('rp.tgl_registrasi', $tgl)
                 ->order_by('rp.jam_reg', 'DESC');

        $rows = $this->db->get()->result_array();
        return $this->json(['status' => 'success', 'data' => $rows ?: []]);
    }

    /* ======================== LIST BERKAS (JSON) ======================== */
    public function getListByNoRawat()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) return $this->json(['status' => 'error', 'message' => 'Parameter no_rawat wajib.'], 422);

        $rows = $this->BerkasModel->getListByNoRawat($no_rawat);
        if (empty($rows)) {
            return $this->json(['status' => 'empty', 'message' => 'Belum ada berkas diunggah.']);
        }
        return $this->json(['status' => 'success', 'data' => $rows]);
    }

    /* ============================ UPLOAD ============================ */
    public function upload()
    {
        if (!$this->session->userdata('user_id')) {
            return $this->json(['status' => 'unauthenticated', 'message' => 'Sesi habis.'], 401);
        }

        // Ambil langsung dari $_POST (FormData)
        $no_rawat = $_POST['no_rawat'] ?? null;
        $kode     = $_POST['kode'] ?? null;

        if (!$no_rawat || !$kode) {
            return $this->json([
                'status'  => 'error',
                'message' => 'no_rawat & kode wajib diisi.',
                'debug'   => ['post' => $_POST, 'files' => $_FILES]
            ], 422);
        }

        if (empty($_FILES['file']['name'])) {
            return $this->json(['status' => 'error', 'message' => 'File tidak ditemukan.'], 422);
        }

        // Validasi file
        $maxMb    = (int) berkas_max_size();
        $allowed  = berkas_allowed_mime();
        $tmp_path = $_FILES['file']['tmp_name'];
        $fileSize = (int) $_FILES['file']['size'];
        $mimeType = mime_content_type($tmp_path);

        if ($fileSize <= 0 || $fileSize > ($maxMb * 1024 * 1024)) {
            return $this->json(['status' => 'error', 'message' => "Ukuran file melebihi batas {$maxMb} MB."], 422);
        }
        if (!in_array($mimeType, $allowed, true)) {
            return $this->json(['status' => 'error', 'message' => 'Tipe file tidak diizinkan.'], 422);
        }

        // Cek apakah sudah ada berkas dengan kode yang sama untuk no_rawat ini
        $exists = $this->BerkasModel->findByRawatKode($no_rawat, $kode);
        if ($exists) {
            return $this->json([
                'status'  => 'duplicate',
                'message' => 'Berkas dengan kode ini sudah ada untuk pasien tersebut.',
                'data'    => $exists
            ]);
        }

        // Generate filename
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (!$ext) $ext = ($mimeType === 'application/pdf') ? 'pdf' : 'jpg';

        $filename     = time() . '_' . $kode . '.' . $ext;
        $relativeFile = 'pages/upload/' . $filename;
        $targetDir    = rtrim(berkas_base_dir(), '/');
        $targetPath   = $targetDir . '/' . $filename;

        if (!is_dir($targetDir) && !@mkdir($targetDir, 0775, true)) {
            return $this->json(['status' => 'error', 'message' => 'Gagal membuat folder upload.'], 500);
        }
        if (!@move_uploaded_file($tmp_path, $targetPath)) {
            return $this->json(['status' => 'error', 'message' => 'Gagal menyimpan file ke server.'], 500);
        }

        // Simpan DB
        $ok = $this->BerkasModel->insertUpload([
            'no_rawat'    => $no_rawat,
            'kode'        => $kode,
            'lokasi_file' => $relativeFile,
            'created_by'  => $this->session->userdata('user_id') ?: null
        ]);
        if (!$ok) {
            // hapus file jika gagal simpan DB
            if (is_file($targetPath)) @unlink($targetPath);
            return $this->json(['status' => 'error', 'message' => 'Gagal simpan ke database.'], 500);
        }

        $namaJenis = $this->BerkasModel->getNamaByKode($kode);
        return $this->json([
            'status'  => 'success',
            'message' => 'Berkas berhasil diunggah.',
            'data'    => [
                'no_rawat'    => $no_rawat,
                'kode'        => $kode,
                'nama'        => $namaJenis,
                'lokasi_file' => $relativeFile,
                'url'         => rtrim(berkas_base_url(), '/') . '/' . $filename
            ]
        ]);
    }


    /* ============================ DELETE ============================ */
    public function delete()
    {
        if (!$this->session->userdata('user_id')) {
            return $this->json(['status'=>'unauthenticated','message'=>'Sesi habis.'], 401);
        }
        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            return $this->json(['status'=>'error','message'=>'Metode tidak diizinkan.'], 405);
        }

        $no_rawat = trim((string)$this->input->post('no_rawat', true));
        $kode     = trim((string)$this->input->post('kode', true));
        if ($no_rawat === '' || $kode === '') {
            return $this->json(['status'=>'error','message'=>'Parameter no_rawat dan kode wajib.'], 422);
        }

        $row = $this->BerkasModel->findByRawatKode($no_rawat, $kode);
        if (!$row) return $this->json(['status'=>'error','message'=>'Data berkas tidak ditemukan.'], 404);

        // Hapus file fisik bila ada
        $filename = basename($row['lokasi_file'] ?? '');
        $fullPath = rtrim(berkas_base_dir(), '/') . '/' . $filename;
        $fileDeleted = is_file($fullPath) ? @unlink($fullPath) : false;

        // Hapus record
        if (!$this->BerkasModel->deleteByRawatKode($no_rawat, $kode)) {
            return $this->json(['status'=>'error','message'=>'Gagal menghapus data dari database.'], 500);
        }

        return $this->json(['status'=>'success','message'=>'Berkas berhasil dihapus.','file_deleted'=>$fileDeleted]);
    }



   /* ============================ DOWNLOAD ============================ */
    public function download()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            show_error('Bad Request', 400);
        }

        // Ambil daftar berkas
        $files = $this->BerkasModel->getListByNoRawat($no_rawat, 1000, 0);
        if (empty($files)) {
            show_error('Tidak ada berkas untuk No. Rawat ini.', 404);
        }

        // Siapkan ZIP
        $this->load->library('zip');
        $baseDir = rtrim(berkas_base_dir(), '/').'/';
        $added   = 0;

        foreach ($files as $f) {
            $basename = basename($f['lokasi_file'] ?? '');
            if ($basename === '') continue;

            $fullpath = $baseDir . $basename;
            if (is_file($fullpath)) {
                // Nama di dalam ZIP: kode - nama_atau_fileasli
                $innerName = ($f['kode'] ?? 'file') . ' - ' . ($f['nama'] ?? $basename);
                // Pastikan ekstensi tetap
                $ext = pathinfo($basename, PATHINFO_EXTENSION);
                if ($ext) $innerName .= '.' . $ext;

                $this->zip->read_file($fullpath, $innerName);
                $added++;
            }
        }

        if ($added === 0) {
            show_error('File fisik tidak ditemukan di server.', 404);
        }

        $zipName = 'berkas_' . str_replace('/', '-', $no_rawat) . '.zip';
        // Kirim file ZIP ke browser dan hentikan eksekusi
        $this->zip->download($zipName);
        // CI Zip sudah exit; baris di bawah ini hanya jaga-jaga
        exit;
    }


    public function download_all()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) show_error('Parameter no_rawat wajib.', 400);

        $files = $this->BerkasModel->getListByNoRawat($no_rawat);
        if (empty($files)) show_error('Tidak ada berkas untuk diunduh.', 404);

        $this->load->library('zip');
        foreach ($files as $f) {
            $path = FCPATH . $f['lokasi_file'];
            if (is_file($path)) {
                $this->zip->read_file($path);
            }
        }

        $filename = 'berkas_' . str_replace('/', '-', $no_rawat) . '.zip';
        $this->zip->download($filename);
    }

}

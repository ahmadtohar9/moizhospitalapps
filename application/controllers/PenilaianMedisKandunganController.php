<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controller untuk Penilaian Medis Ralan Kandungan
 * 
 * @package    Moiz Hospital Apps
 * @subpackage Controllers
 * @category   Medical Assessment
 * @author     Ahmad Tohar
 */
class PenilaianMedisKandunganController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $this->load->model('PenilaianMedisKandunganModel');
        $this->load->model('MenuModel');
    }

    /**
     * Halaman utama form
     */
    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            show_error('No. Rawat tidak ditemukan', 400);
            return;
        }

        // Get data pasien
        $pasien = $this->PenilaianMedisKandunganModel->get_pasien_info($no_rawat);

        if (!$pasien) {
            show_error('Data pasien tidak ditemukan', 404);
            return;
        }

        $data['pasien'] = $pasien;
        $data['no_rawat'] = $no_rawat;
        $data['title'] = 'Penilaian Medis Kandungan';

        // Load view (tanpa template, karena di-load via AJAX di RME)
        $this->load->view('penilaian_medis_kandungan/form', $data);
    }

    /**
     * Simpan data baru
     */
    public function save()
    {
        $post = $this->input->post();

        // Validasi
        if (empty($post['no_rawat']) || empty($post['tanggal'])) {
            echo json_encode(['status' => 'error', 'message' => 'No. Rawat dan Tanggal harus diisi']);
            return;
        }

        // Cek duplikasi
        if ($this->PenilaianMedisKandunganModel->is_exist($post['no_rawat'], $post['tanggal'])) {
            echo json_encode(['status' => 'error', 'message' => 'Data sudah ada untuk tanggal ini. Gunakan Edit untuk mengubah.']);
            return;
        }

        // Prepare data
        $data = [
            'no_rawat' => $post['no_rawat'],
            'tanggal' => $post['tanggal'],
            'kd_dokter' => $post['kd_dokter'] ?? $this->session->userdata('kd_dokter'),
            'anamnesis' => $post['anamnesis'] ?? 'Autoanamnesis',
            'hubungan' => $post['hubungan'] ?? '',
            'keluhan_utama' => $post['keluhan_utama'] ?? '',
            'rps' => $post['rps'] ?? '',
            'rpd' => $post['rpd'] ?? '',
            'rpk' => $post['rpk'] ?? '',
            'rpo' => $post['rpo'] ?? '',
            'alergi' => $post['alergi'] ?? '',
            'keadaan' => $post['keadaan'] ?? 'Sehat',
            'gcs' => $post['gcs'] ?? '',
            'kesadaran' => $post['kesadaran'] ?? 'Compos Mentis',
            'td' => $post['td'] ?? '',
            'nadi' => $post['nadi'] ?? '',
            'rr' => $post['rr'] ?? '',
            'suhu' => $post['suhu'] ?? '',
            'spo' => $post['spo'] ?? '',
            'bb' => $post['bb'] ?? '',
            'tb' => $post['tb'] ?? '',
            'kepala' => $post['kepala'] ?? 'Normal',
            'mata' => $post['mata'] ?? 'Normal',
            'gigi' => $post['gigi'] ?? 'Normal',
            'tht' => $post['tht'] ?? 'Normal',
            'thoraks' => $post['thoraks'] ?? 'Normal',
            'abdomen' => $post['abdomen'] ?? 'Normal',
            'genital' => $post['genital'] ?? 'Normal',
            'ekstremitas' => $post['ekstremitas'] ?? 'Normal',
            'kulit' => $post['kulit'] ?? 'Normal',
            'ket_fisik' => $post['ket_fisik'] ?? '',
            'tfu' => $post['tfu'] ?? '',
            'tbj' => $post['tbj'] ?? '',
            'his' => $post['his'] ?? '',
            'kontraksi' => $post['kontraksi'] ?? 'Tidak',
            'djj' => $post['djj'] ?? '',
            'inspeksi' => $post['inspeksi'] ?? '',
            'inspekulo' => $post['inspekulo'] ?? '',
            'vt' => $post['vt'] ?? '',
            'rt' => $post['rt'] ?? '',
            'ultra' => $post['ultra'] ?? '',
            'kardio' => $post['kardio'] ?? '',
            'lab' => $post['lab'] ?? '',
            'diagnosis' => $post['diagnosis'] ?? '',
            'tata' => $post['tata'] ?? '',
            'konsul' => $post['konsul'] ?? ''
        ];

        if ($this->PenilaianMedisKandunganModel->save($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
        }
    }

    /**
     * Update data
     */
    public function update()
    {
        $post = $this->input->post();

        if (empty($post['no_rawat']) || empty($post['tanggal'])) {
            echo json_encode(['status' => 'error', 'message' => 'No. Rawat dan Tanggal harus diisi']);
            return;
        }

        // Prepare data (sama seperti save, tapi tanpa no_rawat & tanggal karena itu PK)
        $data = [
            'kd_dokter' => $post['kd_dokter'] ?? $this->session->userdata('kd_dokter'),
            'anamnesis' => $post['anamnesis'] ?? 'Autoanamnesis',
            'hubungan' => $post['hubungan'] ?? '',
            'keluhan_utama' => $post['keluhan_utama'] ?? '',
            'rps' => $post['rps'] ?? '',
            'rpd' => $post['rpd'] ?? '',
            'rpk' => $post['rpk'] ?? '',
            'rpo' => $post['rpo'] ?? '',
            'alergi' => $post['alergi'] ?? '',
            'keadaan' => $post['keadaan'] ?? 'Sehat',
            'gcs' => $post['gcs'] ?? '',
            'kesadaran' => $post['kesadaran'] ?? 'Compos Mentis',
            'td' => $post['td'] ?? '',
            'nadi' => $post['nadi'] ?? '',
            'rr' => $post['rr'] ?? '',
            'suhu' => $post['suhu'] ?? '',
            'spo' => $post['spo'] ?? '',
            'bb' => $post['bb'] ?? '',
            'tb' => $post['tb'] ?? '',
            'kepala' => $post['kepala'] ?? 'Normal',
            'mata' => $post['mata'] ?? 'Normal',
            'gigi' => $post['gigi'] ?? 'Normal',
            'tht' => $post['tht'] ?? 'Normal',
            'thoraks' => $post['thoraks'] ?? 'Normal',
            'abdomen' => $post['abdomen'] ?? 'Normal',
            'genital' => $post['genital'] ?? 'Normal',
            'ekstremitas' => $post['ekstremitas'] ?? 'Normal',
            'kulit' => $post['kulit'] ?? 'Normal',
            'ket_fisik' => $post['ket_fisik'] ?? '',
            'tfu' => $post['tfu'] ?? '',
            'tbj' => $post['tbj'] ?? '',
            'his' => $post['his'] ?? '',
            'kontraksi' => $post['kontraksi'] ?? 'Tidak',
            'djj' => $post['djj'] ?? '',
            'inspeksi' => $post['inspeksi'] ?? '',
            'inspekulo' => $post['inspekulo'] ?? '',
            'vt' => $post['vt'] ?? '',
            'rt' => $post['rt'] ?? '',
            'ultra' => $post['ultra'] ?? '',
            'kardio' => $post['kardio'] ?? '',
            'lab' => $post['lab'] ?? '',
            'diagnosis' => $post['diagnosis'] ?? '',
            'tata' => $post['tata'] ?? '',
            'konsul' => $post['konsul'] ?? ''
        ];

        if ($this->PenilaianMedisKandunganModel->update($post['no_rawat'], $post['tanggal'], $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal update data']);
        }
    }

    /**
     * Hapus data
     */
    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tanggal = $this->input->post('tanggal');

        if (empty($no_rawat) || empty($tanggal)) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
            return;
        }

        if ($this->PenilaianMedisKandunganModel->delete($no_rawat, $tanggal)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    /**
     * Get hasil penilaian (list)
     */
    public function get_hasil()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'No. Rawat tidak ditemukan']);
            return;
        }

        $data = $this->PenilaianMedisKandunganModel->get_hasil_by_norawat($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    /**
     * Get detail satu penilaian
     */
    public function get_detail()
    {
        $no_rawat = $this->input->get('no_rawat');
        $tanggal = $this->input->get('tanggal');

        if (!$no_rawat || !$tanggal) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
            return;
        }

        $data = $this->PenilaianMedisKandunganModel->get_by_id($no_rawat, $tanggal);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    /**
     * Get riwayat by no_rkm_medis
     */
    public function get_riwayat_norm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');

        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'No. RM tidak ditemukan']);
            return;
        }

        $data = $this->PenilaianMedisKandunganModel->get_riwayat_by_norm($no_rkm_medis);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    /**
     * Get data terakhir (untuk copy last)
     */
    public function get_last()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');

        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'No. RM tidak ditemukan']);
            return;
        }

        $data = $this->PenilaianMedisKandunganModel->get_last_by_norm($no_rkm_medis);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data sebelumnya']);
        }
    }

    /**
     * Cetak PDF
     */
    public function cetak()
    {
        $no_rawat = $this->input->get('no_rawat');
        $tanggal = $this->input->get('tanggal');

        if (!$no_rawat || !$tanggal) {
            show_error('Parameter tidak lengkap', 400);
            return;
        }

        $data['penilaian'] = $this->PenilaianMedisKandunganModel->get_by_id($no_rawat, $tanggal);
        $data['pasien'] = $this->PenilaianMedisKandunganModel->get_pasien_info($no_rawat);

        // Get setting RS
        $this->load->model('SettingModel');
        $data['setting'] = $this->SettingModel->get_setting();

        if (!$data['penilaian']) {
            show_error('Data tidak ditemukan', 404);
            return;
        }

        $this->load->view('penilaian_medis_kandungan/cetak', $data);
    }
}

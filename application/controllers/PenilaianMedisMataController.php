<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianMedisMataController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('PenilaianMedisMataModel');
        $this->load->model('MenuModel');
    }

    /**
     * Halaman utama form
     */
    public function index()
    {
        // Get data dari session
        $no_rawat = $this->session->userdata('no_rawat');
        $no_rkm_medis = $this->session->userdata('no_rkm_medis');
        $kd_dokter = $this->session->userdata('kd_dokter');
        $user_id = $this->session->userdata('user_id');

        // Load menu untuk sidebar
        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);
        $data['nama_user'] = $this->session->userdata('nama');

        // Data untuk form
        $data['title'] = 'Penilaian Medis Mata';
        $data['content'] = 'penilaian_medis_mata/form';
        $data['no_rawat'] = $no_rawat;
        $data['no_rkm_medis'] = $no_rkm_medis;
        $data['kd_dokter'] = $kd_dokter;
        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i:s');

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view($data['content'], $data);
        $this->load->view('templates/footer');
    }

    /**
     * Cek apakah data sudah ada
     */
    public function check_existing()
    {
        $no_rawat = $this->input->post('no_rawat');
        $existing = $this->PenilaianMedisMataModel->check_existing($no_rawat);

        echo json_encode([
            'exists' => $existing ? true : false,
            'data' => $existing
        ]);
    }

    /**
     * Save data baru
     */
    public function save()
    {
        $no_rawat = $this->input->post('no_rawat');

        // Cek apakah sudah ada data
        $existing = $this->PenilaianMedisMataModel->check_existing($no_rawat);
        if ($existing) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data untuk nomor rawat ini sudah ada! Gunakan fitur Edit untuk mengubah data.'
            ]);
            return;
        }

        // Prepare data
        $data = [
            'no_rawat' => $no_rawat,
            'tanggal' => $this->input->post('tgl_perawatan') . ' ' . $this->input->post('jam_rawat'),
            'kd_dokter' => $this->input->post('kd_dokter'),
            'anamnesis' => $this->input->post('anamnesis'),
            'hubungan' => $this->input->post('hubungan'),
            'keluhan_utama' => $this->input->post('keluhan_utama'),
            'rps' => $this->input->post('rps'),
            'rpd' => $this->input->post('rpd'),
            'rpo' => $this->input->post('rpo'),
            'alergi' => $this->input->post('alergi'),
            'status' => $this->input->post('status_nutrisi'),
            'td' => $this->input->post('td'),
            'nadi' => $this->input->post('nadi'),
            'rr' => $this->input->post('rr'),
            'suhu' => $this->input->post('suhu'),
            'nyeri' => $this->input->post('nyeri'),
            'bb' => $this->input->post('bb'),
            'visuskanan' => $this->input->post('visuskanan'),
            'visuskiri' => $this->input->post('visuskiri'),
            'cckanan' => $this->input->post('cckanan'),
            'cckiri' => $this->input->post('cckiri'),
            'palkanan' => $this->input->post('palkanan'),
            'palkiri' => $this->input->post('palkiri'),
            'conkanan' => $this->input->post('conkanan'),
            'conkiri' => $this->input->post('conkiri'),
            'corneakanan' => $this->input->post('corneakanan'),
            'corneakiri' => $this->input->post('corneakiri'),
            'coakanan' => $this->input->post('coakanan'),
            'coakiri' => $this->input->post('coakiri'),
            'pupilkanan' => $this->input->post('pupilkanan'),
            'pupilkiri' => $this->input->post('pupilkiri'),
            'lensakanan' => $this->input->post('lensakanan'),
            'lensakiri' => $this->input->post('lensakiri'),
            'funduskanan' => $this->input->post('funduskanan'),
            'funduskiri' => $this->input->post('funduskiri'),
            'papilkanan' => $this->input->post('papilkanan'),
            'papilkiri' => $this->input->post('papilkiri'),
            'retinakanan' => $this->input->post('retinakanan'),
            'retinakiri' => $this->input->post('retinakiri'),
            'makulakanan' => $this->input->post('makulakanan'),
            'makulakiri' => $this->input->post('makulakiri'),
            'tiokanan' => $this->input->post('tiokanan'),
            'tiokiri' => $this->input->post('tiokiri'),
            'mbokanan' => $this->input->post('mbokanan'),
            'mbokiri' => $this->input->post('mbokiri'),
            'lab' => $this->input->post('lab'),
            'rad' => $this->input->post('rad'),
            'penunjang' => $this->input->post('penunjang'),
            'tes' => $this->input->post('tes'),
            'pemeriksaan' => $this->input->post('pemeriksaan'),
            'diagnosis' => $this->input->post('diagnosis'),
            'diagnosisbdg' => $this->input->post('diagnosisbdg'),
            'permasalahan' => $this->input->post('permasalahan'),
            'terapi' => $this->input->post('terapi'),
            'tindakan' => $this->input->post('tindakan'),
            'edukasi' => $this->input->post('edukasi')
        ];

        // Save to database
        if ($this->PenilaianMedisMataModel->insert($data)) {
            // Save gambar mata
            $this->save_gambar_mata($no_rawat);

            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan data!'
            ]);
        }
    }

    /**
     * Update data
     */
    public function update()
    {
        $no_rawat = $this->input->post('no_rawat');

        // Prepare data (sama seperti save)
        $data = [
            'tanggal' => $this->input->post('tgl_perawatan') . ' ' . $this->input->post('jam_rawat'),
            'kd_dokter' => $this->input->post('kd_dokter'),
            'anamnesis' => $this->input->post('anamnesis'),
            'hubungan' => $this->input->post('hubungan'),
            'keluhan_utama' => $this->input->post('keluhan_utama'),
            'rps' => $this->input->post('rps'),
            'rpd' => $this->input->post('rpd'),
            'rpo' => $this->input->post('rpo'),
            'alergi' => $this->input->post('alergi'),
            'status' => $this->input->post('status_nutrisi'),
            'td' => $this->input->post('td'),
            'nadi' => $this->input->post('nadi'),
            'rr' => $this->input->post('rr'),
            'suhu' => $this->input->post('suhu'),
            'nyeri' => $this->input->post('nyeri'),
            'bb' => $this->input->post('bb'),
            'visuskanan' => $this->input->post('visuskanan'),
            'visuskiri' => $this->input->post('visuskiri'),
            'cckanan' => $this->input->post('cckanan'),
            'cckiri' => $this->input->post('cckiri'),
            'palkanan' => $this->input->post('palkanan'),
            'palkiri' => $this->input->post('palkiri'),
            'conkanan' => $this->input->post('conkanan'),
            'conkiri' => $this->input->post('conkiri'),
            'corneakanan' => $this->input->post('corneakanan'),
            'corneakiri' => $this->input->post('corneakiri'),
            'coakanan' => $this->input->post('coakanan'),
            'coakiri' => $this->input->post('coakiri'),
            'pupilkanan' => $this->input->post('pupilkanan'),
            'pupilkiri' => $this->input->post('pupilkiri'),
            'lensakanan' => $this->input->post('lensakanan'),
            'lensakiri' => $this->input->post('lensakiri'),
            'funduskanan' => $this->input->post('funduskanan'),
            'funduskiri' => $this->input->post('funduskiri'),
            'papilkanan' => $this->input->post('papilkanan'),
            'papilkiri' => $this->input->post('papilkiri'),
            'retinakanan' => $this->input->post('retinakanan'),
            'retinakiri' => $this->input->post('retinakiri'),
            'makulakanan' => $this->input->post('makulakanan'),
            'makulakiri' => $this->input->post('makulakiri'),
            'tiokanan' => $this->input->post('tiokanan'),
            'tiokiri' => $this->input->post('tiokiri'),
            'mbokanan' => $this->input->post('mbokanan'),
            'mbokiri' => $this->input->post('mbokiri'),
            'lab' => $this->input->post('lab'),
            'rad' => $this->input->post('rad'),
            'penunjang' => $this->input->post('penunjang'),
            'tes' => $this->input->post('tes'),
            'pemeriksaan' => $this->input->post('pemeriksaan'),
            'diagnosis' => $this->input->post('diagnosis'),
            'diagnosisbdg' => $this->input->post('diagnosisbdg'),
            'permasalahan' => $this->input->post('permasalahan'),
            'terapi' => $this->input->post('terapi'),
            'tindakan' => $this->input->post('tindakan'),
            'edukasi' => $this->input->post('edukasi')
        ];

        // Update database
        if ($this->PenilaianMedisMataModel->update($no_rawat, $data)) {
            // Update gambar mata
            $this->save_gambar_mata($no_rawat);

            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal mengupdate data!'
            ]);
        }
    }

    /**
     * Delete data
     */
    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');

        if ($this->PenilaianMedisMataModel->delete($no_rawat)) {
            // Hapus gambar mata juga
            $this->delete_gambar_mata($no_rawat);

            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menghapus data!'
            ]);
        }
    }

    /**
     * Get data by no_rawat
     */
    public function get_data()
    {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->PenilaianMedisMataModel->get_by_no_rawat($no_rawat);

        if ($data) {
            // Tambahkan URL gambar
            $data['gambar_od_url'] = $this->get_gambar_url($no_rawat, 'od');
            $data['gambar_os_url'] = $this->get_gambar_url($no_rawat, 'os');

            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }

    /**
     * Get riwayat by no_rkm_medis
     */
    public function get_riwayat()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $data = $this->PenilaianMedisMataModel->get_riwayat_by_norm($no_rkm_medis);

        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Copy data dari riwayat
     */
    public function copy_data()
    {
        $no_rawat_source = $this->input->post('no_rawat_source');
        $no_rawat_target = $this->input->post('no_rawat_target');

        // Get data source
        $source_data = $this->PenilaianMedisMataModel->get_by_no_rawat($no_rawat_source);

        if (!$source_data) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data sumber tidak ditemukan!'
            ]);
            return;
        }

        // Remove primary key dan update no_rawat
        unset($source_data['no_rawat']);
        unset($source_data['nm_dokter']);
        unset($source_data['tgl_registrasi']);
        $source_data['no_rawat'] = $no_rawat_target;
        $source_data['tanggal'] = date('Y-m-d H:i:s');

        echo json_encode([
            'status' => 'success',
            'data' => $source_data,
            'message' => 'Data berhasil dicopy! Silakan review dan simpan.'
        ]);
    }

    /**
     * Save gambar mata (OD & OS)
     */
    private function save_gambar_mata($no_rawat)
    {
        $upload_path = FCPATH . 'assets/images/mata/';

        // Pastikan folder ada
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Ganti slash jadi underscore untuk nama file
        $filename = str_replace('/', '_', $no_rawat);

        // Save gambar OD (Mata Kanan)
        $gambar_od = $this->input->post('gambar_od_base64');
        if ($gambar_od) {
            $this->save_base64_image($gambar_od, $upload_path . $filename . '_od.png');
        }

        // Save gambar OS (Mata Kiri)
        $gambar_os = $this->input->post('gambar_os_base64');
        if ($gambar_os) {
            $this->save_base64_image($gambar_os, $upload_path . $filename . '_os.png');
        }
    }

    /**
     * Save base64 image to file
     */
    private function save_base64_image($base64_string, $output_file)
    {
        // Remove data:image/png;base64, prefix
        $image_parts = explode(";base64,", $base64_string);
        if (count($image_parts) == 2) {
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($output_file, $image_base64);
        }
    }

    /**
     * Delete gambar mata
     */
    private function delete_gambar_mata($no_rawat)
    {
        $upload_path = FCPATH . 'assets/images/mata/';
        $filename = str_replace('/', '_', $no_rawat);

        $file_od = $upload_path . $filename . '_od.png';
        $file_os = $upload_path . $filename . '_os.png';

        if (file_exists($file_od)) {
            unlink($file_od);
        }

        if (file_exists($file_os)) {
            unlink($file_os);
        }
    }

    /**
     * Get gambar URL
     */
    private function get_gambar_url($no_rawat, $type)
    {
        $filename = str_replace('/', '_', $no_rawat);
        $file_path = FCPATH . 'assets/images/mata/' . $filename . '_' . $type . '.png';

        if (file_exists($file_path)) {
            return base_url('assets/images/mata/' . $filename . '_' . $type . '.png?v=' . filemtime($file_path));
        }

        // Return template jika belum ada gambar
        return base_url('assets/images/mata/mata_' . $type . '_template.png');
    }

    /**
     * Cetak PDF
     */
    public function cetak_pdf($no_rawat = null)
    {
        // Get no_rawat dari parameter atau dari GET
        if (!$no_rawat) {
            $no_rawat = $this->input->get('no_rawat');
        }

        // Decode no_rawat
        $no_rawat = urldecode($no_rawat);

        // Get data
        $data['penilaian'] = $this->PenilaianMedisMataModel->get_by_no_rawat($no_rawat);

        if (!$data['penilaian']) {
            show_error('Data tidak ditemukan!', 404);
            return;
        }

        // Get detail pasien lengkap
        $this->load->model('RekamMedisRalanModel');
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        // Get setting RS
        $data['setting'] = $this->PenilaianMedisMataModel->get_setting();

        // Get gambar mata
        $data['gambar_od'] = $this->get_gambar_path($no_rawat, 'od');
        $data['gambar_os'] = $this->get_gambar_path($no_rawat, 'os');

        // Load view untuk PDF
        $html = $this->load->view('penilaian_medis_mata/pdf', $data, true);

        // === Generate PDF pakai mPDF ===
        require_once FCPATH . 'vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('Penilaian_Medis_Mata_' . str_replace('/', '_', $no_rawat) . '.pdf', 'I');
    }

    /**
     * Get gambar path (untuk PDF)
     */
    private function get_gambar_path($no_rawat, $type)
    {
        $filename = str_replace('/', '_', $no_rawat);
        $file_path = FCPATH . 'assets/images/mata/' . $filename . '_' . $type . '.png';

        if (file_exists($file_path)) {
            return $file_path;
        }

        // Return template jika belum ada gambar
        return FCPATH . 'assets/images/mata/mata_' . $type . '_template.png';
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatPasienController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RiwayatPasien_model');
        $this->load->model('MenuModel');
        $this->load->helper('berkas');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');
        $no_rkm_medis = $this->input->get('no_rkm_medis');

        // Set session data
        if ($no_rawat) {
            $this->session->set_userdata('no_rawat', $no_rawat);
        }
        if ($no_rkm_medis) {
            $this->session->set_userdata('no_rkm_medis', $no_rkm_medis);
        }

        $data = [
            'no_rawat' => $no_rawat ?: '',
            'no_rkm_medis' => $no_rkm_medis ?: '',
            'kd_dokter' => $this->input->get('kd_dokter') ?: '',
            'menus' => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus' => $this->MenuModel->get_active_action_menus()
        ];

        $this->load->view('rekammedis/riwayatPasien_form', $data);
    }

    /* ================== LIST RIWAYAT ================== */
    public function list()
    {
        header('Content-Type: application/json');

        try {
            $no_rkm_medis = $this->input->get('no_rkm_medis') ?: $this->session->userdata('no_rkm_medis');

            if (!$no_rkm_medis) {
                echo json_encode(['status' => 'error', 'message' => 'No. RM tidak ditemukan']);
                return;
            }

            // Setup filters
            $filters = [
                'q' => $this->input->get('q'),
                'date_from' => $this->input->get('date_from') ?: date('Y-m-d'),
                'date_to' => $this->input->get('date_to') ?: date('Y-m-d'),
                'poli' => $this->input->get('poli'),
                'dokter' => $this->input->get('dokter'),
                'penjamin' => $this->input->get('penjamin'),
                'has_soap' => $this->_toBool($this->input->get('has_soap')),
                'has_tind' => $this->_toBool($this->input->get('has_tind')),
                'has_resep' => $this->_toBool($this->input->get('has_resep')),
                'has_lab' => $this->_toBool($this->input->get('has_lab')),
                'has_rad' => $this->_toBool($this->input->get('has_rad')),
                'has_resume' => $this->_toBool($this->input->get('has_resume'))
            ];

            $page = max(1, (int) $this->input->get('page'));
            $per_page = min(100, max(10, (int) $this->input->get('per_page')));

            $result = $this->RiwayatPasien_model->get_kunjungan_by_norm($no_rkm_medis, $filters, $page, $per_page);

            echo json_encode([
                'status' => 'success',
                'data' => [
                    'rows' => $result['rows'],
                    'meta' => [
                        'page' => $page,
                        'per_page' => $per_page,
                        'total' => $result['total']
                    ]
                ]
            ]);

        } catch (Exception $e) {
            log_message('error', 'RiwayatPasien List Error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem']);
        }
    }

    /* ================== DETAIL METHODS ================== */
    public function detail_summary()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'no_rawat required']);
            return;
        }

        $data = $this->RiwayatPasien_model->get_summary_by_norawat($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function soap()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'no_rawat required']);
            return;
        }

        $data = $this->RiwayatPasien_model->get_soap_by_norawat($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function detail_diagnosa()
    {
        $this->_get_detail('get_diagnosa_by_norawat');
    }

    public function detail_prosedur()
    {
        $this->_get_detail('get_prosedur_by_norawat');
    }

    public function detail_tindakan()
    {
        $this->_get_detail('get_tindakan_by_norawat');
    }

    public function detail_resep()
    {
        $this->_get_detail('get_resep_by_norawat');
    }

    public function detail_lab()
    {
        $this->_get_detail('get_lab_by_norawat');
    }

    public function detail_penunjang()
    {
        $this->_get_detail('get_penunjang_by_norawat');
    }

    public function detail_laporan_tindakan()
    {
        $this->_get_detail('get_laporan_tindakan_by_norawat');
    }

    public function detail_asesmen_igd()
    {
        $this->_get_detail('get_asesmen_igd_by_norawat');
    }

    public function detail_asesmen_penyakit_dalam()
    {
        $this->_get_detail('get_awal_medis_penyakit_dalam_by_norawat');
    }

    public function detail_asesmen_orthopedi()
    {
        $this->_get_detail('get_awal_medis_orthopedi_by_norawat');
    }

    public function detail_formulir_kfr()
    {
        $this->_get_detail('get_formulir_kfr_by_norawat');
    }

    public function detail_program_rehab_medik()
    {
        $this->_get_detail('get_program_rehab_medik_by_norawat');
    }

    public function rad_list()
    {
        $this->_get_detail('get_radiologi_by_norawat');
    }

    public function berkas_list()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'no_rawat kosong']));
        }

        $rows = $this->db->select("
                        no_rawat,
                        COALESCE(kode, '')        AS kode,
                        COALESCE(lokasi_file, '') AS path
                    ")
            ->from('berkas_digital_perawatan')
            ->where('no_rawat', $no_rawat)
            ->order_by('kode', 'ASC')
            ->get()->result_array();

        $files = [];
        foreach ($rows as $r) {
            $raw = (string) ($r['path'] ?? '');

            // === NORMALISASI: hilangkan 'berkas/' dan prefix lain yang tidak perlu ===
            $rel = $this->_normalize_rel_berkas($raw);

            // Jika yang tersimpan sudah absolute URL, pakai langsung
            if (preg_match('~^https?://~i', $raw)) {
                $info = [
                    'url' => $raw,
                    'exists' => 1,
                    'mime' => null,
                    'ext' => pathinfo(parse_url($raw, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION),
                    'relative' => $raw,
                ];
            } else {
                // Bangun url/path dari bucket 'berkasrawat' (base: /webapps/berkasrawat/pages/upload/)
                $info = berkas_build('berkasrawat', $rel);
            }

            // Label: pakai kode jika ada, kalau tidak fallback ke nama file
            $label = $r['kode'] !== '' ? $r['kode'] : basename($info['relative']);

            $files[] = [
                'label' => $label,
                'url' => $info['url'],
                'exists' => (int) ($info['exists'] ?? 0),
                'tgl' => '',       // kolom tanggal tidak ada di tabel kamu
                'mime' => $info['mime'],
                'ext' => $info['ext'],
                'relative' => $info['relative'],
                'kode' => $r['kode'],
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => ['files' => $files]]));
    }

    /**
     * Hapus segmen yang bikin URL dobel, hasil akhirnya cukup "1761985506_001.jpg"
     * atau subfolder relatif di bawah /pages/upload/.
     */
    private function _normalize_rel_berkas(string $raw): string
    {
        $s = trim($raw);
        if ($s === '')
            return '';

        // absolute → cukup ambil nama file (tetap aman)
        $s = str_replace('\\', '/', $s);

        // hapus prefix umum
        $s = preg_replace('~^/?(pages/)?upload/berkas/~i', '', $s);
        $s = preg_replace('~^/?(pages/)?upload/~i', '', $s);
        $s = preg_replace('~^/?berkas/~i', '', $s);
        $s = preg_replace('~^/?webapps/berkasrawat/pages/upload/berkas/~i', '', $s);
        $s = preg_replace('~^/?webapps/berkasrawat/pages/upload/~i', '', $s);

        return ltrim($s, '/'); // pastikan tidak diawali '/'
    }

    public function rad_docs()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'no_rawat kosong']));
        }

        $rows = $this->db->select("
                        no_rawat,
                        COALESCE(tgl_periksa,'') AS tgl_periksa,
                        COALESCE(jam,'')         AS jam,
                        COALESCE(lokasi_gambar,'') AS path
                    ")
            ->from('gambar_radiologi')
            ->where('no_rawat', $no_rawat)
            ->order_by('tgl_periksa', 'ASC')
            ->order_by('jam', 'ASC')
            ->get()->result_array();

        $files = [];
        foreach ($rows as $r) {
            $raw = (string) ($r['path'] ?? '');

            // Normalisasi: buang 'berkas/' atau prefix duplikat
            $rel = $this->_normalize_rel_berkas($raw);

            if (preg_match('~^https?://~i', $raw)) {
                $info = [
                    'url' => $raw,
                    'exists' => 1,
                    'mime' => null,
                    'ext' => pathinfo(parse_url($raw, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION),
                    'relative' => $raw,
                ];
            } else {
                // Bucket radiologi → pastikan helper berkas_build('radiologi', ...) mengarah ke base radiologi
                $info = berkas_build('radiologi', $rel);
            }

            $files[] = [
                'label' => trim(($r['tgl_periksa'] . ' ' . $r['jam'])) ?: basename($info['relative']),
                'url' => $info['url'],
                'exists' => (int) ($info['exists'] ?? 0),
                'tgl' => trim(($r['tgl_periksa'] . ' ' . $r['jam'])),
                'mime' => $info['mime'],
                'ext' => $info['ext'],
                'relative' => $info['relative'],
                // optional: flag image (untuk grid)
                'is_image' => in_array(strtolower($info['ext']), ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 1 : 0,
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => ['files' => $files]]));
    }

    /* ================== BERKAS OPEN ================== */
    public function berkas_open()
    {
        $no_rawat = $this->input->get('no_rawat');
        $kode = $this->input->get('kode');

        if (!$no_rawat || !$kode) {
            show_error('Parameter tidak lengkap', 400);
            return;
        }

        $row = $this->db->select('lokasi_file')
            ->from('berkas_digital_perawatan')
            ->where(['no_rawat' => $no_rawat, 'kode' => $kode])
            ->get()->row_array();

        if (!$row || !$row['lokasi_file']) {
            show_error('Berkas tidak ditemukan', 404);
            return;
        }

        $file_path = $row['lokasi_file'];

        // GUNAKAN HELPER BERKAS
        $rel = berkas_rel('berkasrawat', $file_path);
        $info = berkas_build('berkasrawat', $rel);

        if (!$info['exists']) {
            show_error('File tidak ada di server', 404);
            return;
        }

        redirect($info['url']);
    }

    public function operasi_list()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'no_rawat kosong']));
        }

        // Panggil model - lebih clean!
        $rows = $this->RiwayatPasien_model->get_operasi_by_no_rawat($no_rawat);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => ['rows' => $rows]]));
    }

    /**
     * Get complete detail for a single visit (for bulk printing)
     */
    public function get_detail()
    {
        $no_rawat = $this->input->post('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['success' => false, 'message' => 'no_rawat required']);
            return;
        }

        try {
            // Aggregate all data
            $data = [
                'base' => $this->RiwayatPasien_model->get_base_info($no_rawat),
                'summary' => $this->RiwayatPasien_model->get_summary_by_norawat($no_rawat),
                'soapRaw' => $this->RiwayatPasien_model->get_soap_by_norawat($no_rawat),
                'diag' => $this->RiwayatPasien_model->get_diagnosa_by_norawat($no_rawat),
                'proc' => $this->RiwayatPasien_model->get_prosedur_by_norawat($no_rawat),
                'tind' => $this->RiwayatPasien_model->get_tindakan_by_norawat($no_rawat),
                'resep' => $this->RiwayatPasien_model->get_resep_by_norawat($no_rawat),
                'lab' => $this->RiwayatPasien_model->get_lab_by_norawat($no_rawat),
                'rad' => $this->RiwayatPasien_model->get_radiologi_by_norawat($no_rawat),
                'rdocs' => $this->RiwayatPasien_model->get_radiologi_docs($no_rawat),
                'berkas_digital' => $this->RiwayatPasien_model->get_berkas_digital($no_rawat),
                'igd' => $this->RiwayatPasien_model->get_asesmen_igd_by_norawat($no_rawat),
                'pd' => $this->RiwayatPasien_model->get_awal_medis_penyakit_dalam_by_norawat($no_rawat),
                'ortho' => $this->RiwayatPasien_model->get_awal_medis_orthopedi_by_norawat($no_rawat),
                'kfr' => $this->RiwayatPasien_model->get_formulir_kfr_by_norawat($no_rawat),
                'rehab' => $this->RiwayatPasien_model->get_program_rehab_medik_by_norawat($no_rawat),
            ];

            echo json_encode(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            log_message('error', 'get_detail error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
        }
    }

    private function _get_detail($method)
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'no_rawat required']);
            return;
        }

        $data = $this->RiwayatPasien_model->$method($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function info()
    {
        header('Content-Type: application/json');
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $patient = $this->RiwayatPasien_model->get_patient_detail($no_rkm_medis);
        $setting = $this->RiwayatPasien_model->get_hospital_setting();
        echo json_encode(['patient' => $patient, 'setting' => $setting]);
    }

    /* ================== UTILITIES ================== */
    private function _toBool($value)
    {
        if ($value === null || $value === '')
            return null;
        $val = strtolower((string) $value);
        return in_array($val, ['1', 'true', 'yes', 'ya']) ? 1 : 0;
    }
}
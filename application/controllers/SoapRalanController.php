<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoapRalanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoapRalanModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->helper('response'); // jika kamu pakai helper ini di tempat lain

        // Guard session
        if (!$this->session->userdata('user_id')) {
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'unauthenticated',
                        'message' => 'Sesi habis, silakan login lagi.'
                    ]));
            }
            redirect('auth/login');
        }
    }

    /** Helper JSON + CSRF */
    private function json($payload, $code = 200)
    {
        if (property_exists($this, 'security')) {
            $payload['csrfToken'] = $this->security->get_csrf_hash();
            $payload['csrfName'] = $this->security->get_csrf_token_name();
        }
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    /** Bersihkan payload POST dari noise FE + CSRF name */
    private function scrubPayload(array $data, array $preserve_keys = [])
    {
        if (isset($this->security)) {
            $csrfName = $this->security->get_csrf_token_name();
            unset($data[$csrfName]);
        }
        if (!in_array('original_jam_rawat', $preserve_keys, true)) {
            unset($data['original_jam_rawat']);
        }
        unset($data['btn'], $data['submit']);
        return $data;
    }

    /* =========================================
     * VIEW
     * ========================================= */
    public function index()
    {
        $no_rawat = $this->session->userdata('no_rawat');
        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        $role_id = (int) $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');

        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan.', 404, 'Error');
            return;
        }

        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'] ?? null;

        // kd_dokter: admin ambil dari data pasien, dokter/perawat dari session
        if ($role_id === 1) {
            $data['kd_dokter'] = $data['detail_pasien']['kd_dokter'] ?? null;
        } else {
            $data['kd_dokter'] = $this->session->userdata('user_nip');
        }

        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        log_message('debug', "Memuat SOAP Ralan untuk No Rawat: {$no_rawat} oleh Role ID: {$role_id}");
        $this->load->view('rekammedis/soap_ralan', $data);
    }

    /* =========================================
     * CREATE (AMAN & IDEMPOTEN)
     * ========================================= */
    public function save()
    {
        $data = $this->scrubPayload($this->input->post(null, true));

        // Isi nip sesuai role
        $role_id = (int) $this->session->userdata('role_id');
        if ($role_id === 1) {
            $data['nip'] = $data['kd_dokter'] ?? null;
        } else {
            $data['nip'] = $this->session->userdata('user_nip');
        }
        unset($data['kd_dokter']);

        log_message('debug', 'Data POST untuk save SOAP: ' . json_encode($data));

        try {
            $res = $this->SoapRalanModel->save($data);
            if (!empty($res['ok'])) {
                if (!empty($res['skipped'])) {
                    return $this->json([
                        'status' => 'success',
                        'skipped' => true,
                        'message' => 'Data SOAP sudah ada (idempotent), tidak disimpan ulang.'
                    ]);
                }
                return $this->json([
                    'status' => 'success',
                    'message' => 'Data SOAP berhasil disimpan.',
                    'id' => $res['id'] ?? null
                ]);
            }
            return $this->json([
                'status' => 'error',
                'message' => $res['error'] ?? 'Gagal menyimpan data SOAP.'
            ], 500);
        } catch (InvalidArgumentException $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        } catch (Exception $e) {
            log_message('error', 'Exception save SOAP: ' . $e->getMessage());
            return $this->json(['status' => 'error', 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    /* =========================================
     * UPDATE (OPTIMISTIC BY KEY)
     * ========================================= */
    public function update()
    {
        $postRaw = $this->input->post(null, true);

        $no_rawat = $postRaw['no_rawat'] ?? null;
        $tgl_perawatan = $postRaw['tgl_perawatan'] ?? null;
        $orig_jam = $postRaw['original_jam_rawat'] ?? null;

        if (!$no_rawat || !$tgl_perawatan || !$orig_jam) {
            return $this->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        $data = $this->scrubPayload($postRaw, ['original_jam_rawat']);
        $new_jam = $data['jam_rawat'] ?? null;

        // data update (tanpa key)
        unset($data['no_rawat'], $data['tgl_perawatan'], $data['original_jam_rawat'], $data['jam_rawat']);

        // isi nip
        $role_id = (int) $this->session->userdata('role_id');
        if ($role_id === 1) {
            $data['nip'] = $postRaw['kd_dokter'] ?? null;
        } else {
            $data['nip'] = $this->session->userdata('user_nip');
        }
        unset($data['kd_dokter']);

        // jam tidak berubah -> update biasa
        if (!$new_jam || $new_jam === $orig_jam) {
            $ok = $this->SoapRalanModel->updateByKey($no_rawat, $tgl_perawatan, $orig_jam, $data);
            if ($ok)
                return $this->json(['status' => 'success', 'message' => 'Data SOAP berhasil diperbarui.']);
            return $this->json(['status' => 'conflict', 'message' => 'Tidak ada perubahan atau data tidak ditemukan.'], 409);
        }

        // jam berubah -> ganti key + update
        $res = $this->SoapRalanModel->updateKeyAndData($no_rawat, $tgl_perawatan, $orig_jam, $new_jam, $data);
        if (!empty($res['ok'])) {
            return $this->json(['status' => 'success', 'message' => 'Data SOAP & jam berhasil diperbarui.']);
        }
        if (($res['code'] ?? null) === 'duplicate_key') {
            return $this->json(['status' => 'error', 'message' => 'Jam yang baru sudah dipakai. Pilih jam lain.'], 409);
        }
        return $this->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
    }

    /* =========================================
     * DELETE (GUARD 48 JAM + PEMILIK)
     * ========================================= */
    public function delete()
    {
        $post = $this->scrubPayload($this->input->post(null, true));

        $no_rawat = $post['no_rawat'] ?? null;
        $tgl_perawatan = $post['tgl_perawatan'] ?? null;
        $jam_rawat = $post['jam_rawat'] ?? null;

        if (!$no_rawat || !$tgl_perawatan || !$jam_rawat) {
            return $this->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        $role_id = (int) $this->session->userdata('role_id');
        $nipLogin = $this->session->userdata('user_nip');
        $enforce48 = true;

        if ($role_id === 1) {    // admin: bebas owner + bebas 48 jam
            $nipLogin = null;
            $enforce48 = false;
        }

        $ok = $this->SoapRalanModel->deleteByNoRawatAndTime(
            $no_rawat,
            $tgl_perawatan,
            $jam_rawat,
            $nipLogin,
            $enforce48
        );

        if ($ok === true) {
            return $this->json(['status' => 'success', 'message' => 'Data SOAP berhasil dihapus.']);
        }

        return $this->json([
            'status' => 'error',
            'message' => 'Gagal menghapus data SOAP (melewati 48 jam, bukan pemilik, atau data tidak ada).'
        ], 400);
    }

    /* =========================================
     * READ: SEMUA ENTri per no_rawat (+ last)
     * ========================================= */
    public function get_riwayat_norawat()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->json(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.'], 422);
        }

        // Ambil semua entri (urut DESC)
        $items = $this->SoapRalanModel->getAllByNoRawat($no_rawat, null, 0);
        $last = !empty($items) ? $items[0] : null; // karena DESC

        return $this->json([
            'status' => 'success',
            'last' => $last,
            'items' => $items
        ]);
    }

    /* =========================================
     * READ: HASIL per no_rawat (paginated)
     * ========================================= */
    public function getHasil()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->json(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.'], 422);
        }

        $page = max(1, (int) $this->input->get('page', true));
        $size = max(1, min(200, (int) $this->input->get('size', true) ?: 50));
        $offset = ($page - 1) * $size;

        $total = $this->SoapRalanModel->countHasil($no_rawat);
        $rows = $this->SoapRalanModel->getHasil($no_rawat, $size, $offset);

        if (empty($rows)) {
            return $this->json([
                'status' => 'empty',
                'message' => 'Belum ada data hasil SOAP.',
                'total' => (int) $total,
                'page' => (int) $page,
                'size' => (int) $size
            ]);
        }

        return $this->json([
            'status' => 'success',
            'data' => $rows,
            'total' => (int) $total,
            'page' => (int) $page,
            'size' => (int) $size
        ]);
    }

    /* =========================================
     * READ: riwayat lintas kunjungan (NoRM)
     * Support date range filter
     * ========================================= */
    public function getRiwayatByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis', true);
        if (!$no_rkm_medis) {
            return $this->json(['success' => false, 'message' => 'Nomor Rekam Medis tidak ditemukan.'], 422);
        }

        $page = max(1, (int) $this->input->get('page', true));
        $size = max(1, min(200, (int) $this->input->get('size', true) ?: 50));
        $offset = ($page - 1) * $size;

        // Date filter support
        $dari_tgl = $this->input->get('dari_tgl', true);
        $sampai_tgl = $this->input->get('sampai_tgl', true);

        // Get data with optional date filter
        if ($dari_tgl && $sampai_tgl) {
            // Filtered by date range
            $data = $this->SoapRalanModel->getRiwayatByNoRMFiltered($no_rkm_medis, $dari_tgl, $sampai_tgl);
            $total = count($data);
        } else {
            // All data (paginated)
            $total = $this->SoapRalanModel->countRiwayatByNoRM($no_rkm_medis);
            $data = $this->SoapRalanModel->getRiwayatByNoRM($no_rkm_medis, $size, $offset);
        }

        return $this->json([
            'success' => true,
            'data' => $data,
            'total' => (int) $total,
            'page' => (int) $page,
            'size' => (int) $size
        ]);
    }

    /* =========================================
     * READ: detail 1 record (by keys)
     * ========================================= */
    public function getDetail()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        $tgl_perawatan = $this->input->get('tgl_perawatan', true);
        $jam_rawat = $this->input->get('jam_rawat', true);

        if (!$no_rawat || !$tgl_perawatan || !$jam_rawat) {
            return $this->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        $data = $this->SoapRalanModel->getByNoRawat($no_rawat, $tgl_perawatan, $jam_rawat);
        if ($data) {
            return $this->json(['status' => 'success', 'data' => $data]);
        }
        return $this->json(['status' => 'error', 'message' => 'Data tidak ditemukan.'], 404);
    }

    /* =========================================
     * READ: last TTV (untuk auto-fill FE)
     * ========================================= */
    public function get_last_ttv()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            return $this->json(['status' => 'error', 'message' => 'No Rawat kosong.'], 422);
        }

        $lastTTV = $this->SoapRalanModel->getLastTTV($no_rawat);
        if ($lastTTV) {
            return $this->json(['status' => 'success', 'data' => $lastTTV]);
        }
        return $this->json(['status' => 'empty', 'message' => 'Belum ada data TTV.']);
    }

    /* =========================================
     * PRINT PDF: Cetak SOAP ke PDF
     * Supports:
     * - Single entry: ?no_rawat=xxx&tgl_perawatan=xxx&jam_rawat=xxx
     * - Date range: ?no_rawat=xxx&dari_tgl=xxx&sampai_tgl=xxx
     * - All entries: ?no_rawat=xxx
     * ========================================= */
    public function print_pdf()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        // Load data pasien
        $this->load->model('RekamMedisRalanModel');
        $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$detail_pasien) {
            show_error('Data pasien tidak ditemukan.', 404);
            return;
        }

        // Check if single entry print
        $tgl_perawatan = $this->input->get('tgl_perawatan', true);
        $jam_rawat = $this->input->get('jam_rawat', true);

        // Check if date range filter
        $dari_tgl = $this->input->get('dari_tgl', true);
        $sampai_tgl = $this->input->get('sampai_tgl', true);

        $soap_data = [];
        $title_suffix = '';

        if ($tgl_perawatan && $jam_rawat) {
            // Single entry
            $single = $this->SoapRalanModel->getByNoRawat($no_rawat, $tgl_perawatan, $jam_rawat);
            if ($single) {
                $soap_data = [$single];
                $title_suffix = ' - ' . date('d/m/Y H:i', strtotime($tgl_perawatan . ' ' . $jam_rawat));
            }
        } elseif ($dari_tgl && $sampai_tgl) {
            // Date range filter - lintas kunjungan (by no_rkm_medis)
            $no_rkm_medis = $detail_pasien['no_rkm_medis'];

            // Debug log
            log_message('debug', "PDF Filter - no_rkm_medis: {$no_rkm_medis}, dari: {$dari_tgl}, sampai: {$sampai_tgl}");

            if ($no_rkm_medis) {
                $soap_data = $this->SoapRalanModel->getRiwayatByNoRMFiltered($no_rkm_medis, $dari_tgl, $sampai_tgl);
                log_message('debug', "PDF Filter - Found " . count($soap_data) . " SOAP entries");
            } else {
                // Fallback: filter by no_rawat saja
                $all_data = $this->SoapRalanModel->getAllByNoRawat($no_rawat, null, 0);
                foreach ($all_data as $item) {
                    if ($item['tgl_perawatan'] >= $dari_tgl && $item['tgl_perawatan'] <= $sampai_tgl) {
                        $soap_data[] = $item;
                    }
                }
            }
            $title_suffix = ' - ' . date('d/m/Y', strtotime($dari_tgl)) . ' s/d ' . date('d/m/Y', strtotime($sampai_tgl));
        } else {
            // All entries
            $soap_data = $this->SoapRalanModel->getAllByNoRawat($no_rawat, null, 0);
        }

        if (empty($soap_data)) {
            show_error('Tidak ada data SOAP untuk dicetak.', 404);
            return;
        }

        // Load setting RS
        $this->load->model('SettingModel');
        $setting = $this->SettingModel->get_setting();

        // Prepare data untuk view
        $data = [
            'detail_pasien' => $detail_pasien,
            'soap_data' => $soap_data,
            'setting' => $setting,
            'no_rawat' => $no_rawat,
            'title_suffix' => $title_suffix
        ];

        // Load view untuk PDF
        $html = $this->load->view('print/sections/soap', $data, true);

        // Generate PDF dengan mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);

        $mpdf->WriteHTML($html);

        $clean_no_rawat = str_replace('/', '_', $no_rawat);
        $filename = 'SOAP_' . $clean_no_rawat;
        if ($title_suffix) {
            $filename .= '_' . date('YmdHis');
        }
        $mpdf->Output($filename . '.pdf', 'I');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanTindakanRalanDokterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Model utama laporan tindakan ralan
        $this->load->model('DokterRalanModel/LaporanTindakanRalanDokterModel', 'Model');

        // Model yang sudah ada di project
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');
        $this->load->helper('response');

        // Guard session
        if (!$this->session->userdata('user_id')) {
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'unauthenticated',
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
            $payload['csrfName']  = $this->security->get_csrf_token_name();
        }
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    /** Bersihkan payload POST dari noise FE + CSRF name */
    private function scrubPayload(array $data)
    {
        if (isset($this->security)) {
            $csrfName = $this->security->get_csrf_token_name();
            unset($data[$csrfName]);
        }
        unset($data['btn'], $data['submit']);
        return $data;
    }

    /* =========================
     * VIEW (FORM)
     * ========================= */
    public function index()
    {
        $no_rawat = $this->session->userdata('no_rawat');
        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        $role_id = (int) $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');

        $data['no_rawat']      = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan.', 404, 'Error');
            return;
        }

        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'] ?? null;

        // kd_dokter: admin ambil dari data pasien, dokter dari session (user_nip)
        if ($role_id === 1) {
            $data['kd_dokter'] = $data['detail_pasien']['kd_dokter'] ?? null;
        } else {
            $data['kd_dokter'] = $this->session->userdata('user_nip');
        }

        // preload (single-entry)
        $data['existing'] = $this->Model->getByNoRawat($no_rawat);

        $data['menus']        = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        log_message('debug', "Memuat Laporan Tindakan Ralan untuk No Rawat: {$no_rawat}");
        $this->load->view('rekammedis/dokter/laporanTindakanRalan_form', $data);
    }

    /* =========================
     * CREATE / SAVE
     * ========================= */
    public function save()
    {
        $post    = $this->scrubPayload($this->input->post(null, true));
        $role_id = (int) $this->session->userdata('role_id');

        if (empty($post['no_rawat']) || empty($post['prosedur_tindakan'])) {
            return $this->json(['status'=>'error','message'=>'Data tidak lengkap.'], 422);
        }

        // single-entry guard
        if ($this->Model->existsByNoRawat($post['no_rawat'])) {
            return $this->json([
                'status'  => 'error',
                'message' => 'Laporan tindakan untuk nomor rawat ini sudah ada.'
            ], 409);
        }

        // kd_dokter (operator) dari session (admin boleh override)
        $post['kd_dokter'] = ($role_id === 1)
            ? ($post['kd_dokter'] ?? $this->session->userdata('user_nip'))
            : $this->session->userdata('user_nip');

        // Normalisasi ruangan: trim, boleh kosong (NULL)
        $post['ruangan'] = isset($post['ruangan']) ? trim((string)$post['ruangan']) : null;
        if ($post['ruangan'] === '') $post['ruangan'] = null;

        // default jam bila kosong
        $post['jam_mulai']   = $post['jam_mulai']   ?: date('H:i:s');
        $post['jam_selesai'] = $post['jam_selesai'] ?: null;

        $post['tgl_input'] = date('Y-m-d H:i:s');

        try {
            $res = $this->Model->save($post);
            if (!empty($res['ok'])) {
                return $this->json([
                    'status'  => 'success',
                    'message' => 'Laporan tindakan berhasil disimpan.',
                    'id'      => $res['id'] ?? null
                ]);
            }
            return $this->json([
                'status'  => 'error',
                'message' => $res['error'] ?? 'Gagal menyimpan laporan tindakan.'
            ], 500);
        } catch (Exception $e) {
            log_message('error', 'Exception save laporan tindakan: '.$e->getMessage());
            return $this->json(['status'=>'error','message'=>'Terjadi kesalahan server.'], 500);
        }
    }

    /* =========================
     * UPDATE
     * ========================= */
    public function update()
    {
        $data = $this->scrubPayload($this->input->post(null, true));
        $id = (int)($data['id'] ?? 0);
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter ID tidak ditemukan.'], 422);

        // Normalisasi ruangan: trim, kosong → NULL
        $ru = isset($data['ruangan']) ? trim((string)$data['ruangan']) : null;
        if ($ru === '') $ru = null;

        // whitelist sesuai kolom tabel
        $payload = [
            'no_rawat'          => $data['no_rawat'] ?? null,
            'kd_dokter'         => $data['kd_dokter'] ?? null,
            'diagnosa'          => $data['diagnosa'] ?? null,
            'nama_tindakan'     => $data['nama_tindakan'] ?? null,
            'jam_mulai'         => $data['jam_mulai'] ?? null,
            'jam_selesai'       => $data['jam_selesai'] ?? null,
            'ruangan'           => $ru,
            'jenis_anastesi'    => $data['jenis_anastesi'] ?? null,
            'prosedur_tindakan' => $data['prosedur_tindakan'] ?? null,
            'ttd'               => $data['ttd'] ?? null,
            'tgl_input'         => date('Y-m-d H:i:s'),
        ];

        $ok = $this->Model->update($id, $payload);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Data laporan tindakan berhasil diperbarui.'])
            : $this->json(['status'=>'error','message'=>'Gagal memperbarui data laporan tindakan.'], 400);
    }

    /* =========================
     * READ / GET BY NO_RAWAT (single row)
     * ========================= */
    public function getByNoRawat()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) return $this->json(['status'=>'error','message'=>'No Rawat tidak ditemukan.'], 422);

        $row = $this->Model->getByNoRawat($no_rawat);
        if (empty($row)) return $this->json(['status'=>'empty','message'=>'Belum ada laporan tindakan.']);
        return $this->json(['status'=>'success','data'=>$row]);
    }

    /* =========================
     * DELETE
     * ========================= */
    public function delete()
    {
        $id = (int)$this->input->post('id');
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter ID tidak ditemukan.'], 422);

        $ok = $this->Model->delete($id);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Laporan tindakan berhasil dihapus.'])
            : $this->json(['status'=>'error','message'=>'Gagal menghapus data.'], 400);
    }

    /* =========================
     * SIGN (TTD)
     * ========================= */
    public function sign()
    {
        $id  = (int) $this->input->post('id', true);
        $ttd = $this->input->post('ttd', false); // base64 dataURL, jangan xss_clean

        if (!$id)  return $this->json(['status'=>'error','message'=>'Parameter id kosong.'], 422);
        if (!$ttd) return $this->json(['status'=>'error','message'=>'TTD kosong.'], 422);

        // normalisasi prefix dataURL
        if (strpos($ttd, 'data:image') !== 0) {
            $ttd = 'data:image/png;base64,' . $ttd;
        }

        $data = [
            'ttd'       => $ttd,
            'tgl_input' => date('Y-m-d H:i:s'),
        ];

        if ($this->Model->update($id, $data)) {
            return $this->json([
                'status'    => 'success',
                'message'   => 'Tanda tangan berhasil disimpan.',
                'print_url' => site_url('dokterRalan/laporan-tindakan-ralan/print?id='.$id)
            ]);
        }
        return $this->json(['status'=>'error','message'=>'Gagal menyimpan tanda tangan.'], 500);
    }

    /* =========================
     * PRINT (dokumen siap cetak)
     * ========================= */
    public function print()
    {
        $id = (int)$this->input->get('id');
        if (!$id) show_error('Parameter id tidak ditemukan', 422);

        $row = $this->Model->getById($id);
        if (!$row) show_error('Data tidak ditemukan', 404);

        // normalisasi base64 signature
        if (!empty($row['ttd']) && strpos($row['ttd'], 'data:image') !== 0) {
            $row['ttd'] = 'data:image/png;base64,' . $row['ttd'];
        }

        $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail($row['no_rawat']);
        $setting       = $this->SettingModel->get_setting();

        $logo_data_uri = null;
        if (!empty($setting['logo'])) {
            $logo_data_uri = 'data:image/png;base64,' . base64_encode($setting['logo']);
        }

        $data = [
            'row'           => $row,
            'detail_pasien' => $detail_pasien,
            'setting'       => $setting,
            'logo_data_uri' => $logo_data_uri,
            'app_name'      => $this->config->item('app_name') ?? 'SIMRS',
        ];

        $this->load->view('rekammedis/dokter/laporanTindakanRalan_print', $data);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenunjangRalanController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DokterRalanModel/PenunjangRalanModel', 'PenunjangRalanModel');
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

        // kd_dokter: admin ambil dari data pasien, dokter dari session
        if ($role_id === 1) {
            $data['kd_dokter'] = $data['detail_pasien']['kd_dokter'] ?? null;
        } else {
            $data['kd_dokter'] = $this->session->userdata('user_nip');
        }

        $data['menus']        = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        log_message('debug', "Memuat Penunjang Ralan untuk No Rawat: {$no_rawat}");
        $this->load->view('rekammedis/dokter/penunjangRalan_form', $data);
    }

    /* =========================
     * CREATE / SAVE
     * ========================= */
    public function save()
    {
        $data    = $this->scrubPayload($this->input->post(null, true));
        $role_id = (int) $this->session->userdata('role_id');

        if (empty($data['no_rawat']) || empty($data['hasil_pemeriksaan'])) {
            return $this->json(['status'=>'error','message'=>'Data tidak lengkap.'], 422);
        }

        // ❗CEK: sudah pernah diisi untuk no_rawat ini?
        if ($this->PenunjangRalanModel->existsByNoRawat($data['no_rawat'])) {
            return $this->json([
                'status'  => 'error',
                'message' => 'Maaf, data penunjang untuk nomor rawat ini sudah pernah diisi sebelumnya.'
            ], 409);
        }

        // kd_dokter dari session (admin boleh override)
        $data['kd_dokter'] = ($role_id === 1)
            ? ($data['kd_dokter'] ?? $this->session->userdata('user_nip'))
            : $this->session->userdata('user_nip');

        // tgl & jam default
        $data['tgl_periksa'] = $data['tgl_periksa'] ?: date('Y-m-d');
        $data['jam_periksa'] = $data['jam_periksa'] ?: date('H:i:s');

        try {
            $res = $this->PenunjangRalanModel->save($data);
            if (!empty($res['ok'])) {
                return $this->json([
                    'status'  => 'success',
                    'message' => 'Data penunjang berhasil disimpan.',
                    'id'      => $res['id'] ?? null
                ]);
            }
            return $this->json([
                'status'  => 'error',
                'message' => $res['error'] ?? 'Gagal menyimpan data penunjang.'
            ], 500);
        } catch (Exception $e) {
            log_message('error', 'Exception save penunjang: '.$e->getMessage());
            return $this->json(['status'=>'error','message'=>'Terjadi kesalahan server.'], 500);
        }
    }


    /* =========================
     * UPDATE (termasuk guard lock)
     * ========================= */
    public function update()
    {
        $data = $this->scrubPayload($this->input->post(null, true));
        $id = (int)($data['id'] ?? 0);
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter ID tidak ditemukan.'], 422);

        // ❌ HAPUS / KOMENTARI BLOK INI
        // $row     = $this->PenunjangRalanModel->getById($id);
        // $role_id = (int) $this->session->userdata('role_id');
        // if ($row && (int)$row['is_locked'] === 1 && $role_id !== 1) {
        //     return $this->json(['status'=>'error','message'=>'Dokumen sudah ditandatangani dan terkunci.'], 423);
        // }

        $data['updated_at'] = date('Y-m-d H:i:s');
        $ok = $this->PenunjangRalanModel->update($id, $data);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Data penunjang berhasil diperbarui.'])
            : $this->json(['status'=>'error','message'=>'Gagal memperbarui data penunjang.'], 400);
    }


    /* =========================
     * READ / GET BY NO_RAWAT
     * ========================= */
    public function getByNoRawat()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) return $this->json(['status'=>'error','message'=>'No Rawat tidak ditemukan.'], 422);

        $rows = $this->PenunjangRalanModel->getAllByNoRawat($no_rawat);
        if (empty($rows)) return $this->json(['status'=>'empty','message'=>'Belum ada data penunjang.']);
        return $this->json(['status'=>'success','data'=>$rows]);
    }

    /* =========================
     * DELETE (guard lock)
     * ========================= */
    public function delete()
    {
        $id = (int)$this->input->post('id');
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter ID tidak ditemukan.'], 422);

        // ❌ HAPUS / KOMENTARI BLOK INI KALAU PENGEN BOLEH HAPUS WALAU SIGNED
        // $row     = $this->PenunjangRalanModel->getById($id);
        // $role_id = (int) $this->session->userdata('role_id');
        // if ($row && (int)$row['is_locked'] === 1 && $role_id !== 1) {
        //     return $this->json(['status'=>'error','message'=>'Dokumen sudah ditandatangani dan terkunci.'], 423);
        // }

        $ok = $this->PenunjangRalanModel->delete($id);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Data penunjang berhasil dihapus.'])
            : $this->json(['status'=>'error','message'=>'Gagal menghapus data penunjang.'], 400);
    }


    /* =========================
     * SIGN (TTD + lock + link print)
     * ========================= */
    public function sign()
    {
        // Ambil ID aman (boleh lewat scrubPayload/xss_clean)
        $id = (int) $this->input->post('id', true);
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter tidak lengkap.'], 422);

        // ⬇️ Ambil signature TANPA xss_clean!
        $img = $this->input->post('signature_base64', false); // penting: false

        if (!$img) return $this->json(['status'=>'error','message'=>'Gambar tanda tangan kosong.'], 422);

        $row = $this->PenunjangRalanModel->getById($id);
        if (!$row) return $this->json(['status'=>'error','message'=>'Data tidak ditemukan.'], 404);

        // Normalisasi prefix dataURL
        if (strpos($img, 'data:image') !== 0) {
            $img = 'data:image/png;base64,' . $img;
        }

        $data = [
            'signature_base64' => $img,
            'signed_at'        => date('Y-m-d H:i:s'),
            'signed_by'        => $this->session->userdata('user_nip') ?: ($row['kd_dokter'] ?? null),
            'is_locked'        => 1,
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if ($this->PenunjangRalanModel->update($id, $data)) {
            return $this->json([
                'status'    => 'success',
                'message'   => 'Tanda tangan berhasil disimpan.',
                'print_url' => site_url('dokterRalan/penunjang-ralan/print?id='.$id)
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

        // data utama
        $row = $this->PenunjangRalanModel->getById($id);
        if (!$row) show_error('Data tidak ditemukan', 404);

        // normalisasi base64 signature
        if (!empty($row['signature_base64']) && strpos($row['signature_base64'], 'data:image') !== 0) {
            $row['signature_base64'] = 'data:image/png;base64,' . $row['signature_base64'];
        }

        $detail_pasien = $this->RekamMedisRalanModel->get_patient_detail($row['no_rawat']);
        $setting = $this->SettingModel->get_setting();

        // siapkan data logo (longblob -> data URI)
        $logo_data_uri = null;
        if (!empty($setting['logo'])) {
            // default anggap png; ganti ke image/jpeg jika logomu jpg
            $logo_data_uri = 'data:image/png;base64,' . base64_encode($setting['logo']);
        }

        $data = [
            'row'           => $row,
            'detail_pasien' => $detail_pasien,
            'setting'       => $setting,
            'logo_data_uri' => $logo_data_uri,
            'app_name'      => $this->config->item('app_name') ?? 'SIMRS',
        ];

        $this->load->view('rekammedis/dokter/penunjangRalan_print', $data);
    }


}

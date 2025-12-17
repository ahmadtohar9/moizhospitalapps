<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratSakitRalanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Model utama Surat Sakit
        $this->load->model('DokterRalanModel/SuratSakitRalanModel', 'Model');

        // Model yang sudah ada di project
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

        // Helper
        $this->load->helper(['response', 'nomorsurat']);

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

        // preload (single-entry per no_rawat)
        $data['existing'] = $this->Model->getByNoRawat($no_rawat);

        $data['menus']        = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        log_message('debug', "Memuat Surat Sakit Ralan untuk No Rawat: {$no_rawat}");
        $this->load->view('rekammedis/dokter/suratSakitRalan_form', $data);
    }

    /* =========================
     * CREATE / SAVE
     * ========================= */
    public function save()
    {
        $post    = $this->scrubPayload($this->input->post(null, true));
        $role_id = (int) $this->session->userdata('role_id');

        // Validasi minimal
        if (empty($post['no_rawat']) || empty($post['tgl_mulai_istirahat']) || empty($post['lama_istirahat_hari'])) {
            return $this->json(['status'=>'error','message'=>'Data tidak lengkap.'], 422);
        }

        // single-entry guard (1 surat sakit per no_rawat)
        if ($this->Model->existsByNoRawat($post['no_rawat'])) {
            return $this->json([
                'status'  => 'error',
                'message' => 'Surat sakit untuk nomor rawat ini sudah ada.'
            ], 409);
        }

        // Dokter operator dari session (admin bisa override dari form)
        $post['kd_dokter'] = ($role_id === 1)
            ? ($post['kd_dokter'] ?? $this->session->userdata('user_nip'))
            : $this->session->userdata('user_nip');

        // Ambil detail pasien
        $detail = $this->RekamMedisRalanModel->get_patient_detail($post['no_rawat']);
        if (!$detail) {
            return $this->json(['status'=>'error','message'=>'Detail pasien tidak ditemukan.'], 404);
        }
        $post['no_rkm_medis'] = $detail['no_rkm_medis'] ?? null;

        // Tanggal surat (default hari ini)
        $post['tgl_surat'] = $post['tgl_surat'] ?: date('Y-m-d');

        // Generate nomor surat (format: 001/SKS/PBEC/X/2025)
        // Sesuaikan KODE_RS jika perlu (PBEC mengikuti contohmu)
        $post['no_surat'] = generate_nomor_surat('SKS', 'PBEC', 'moiz_surat_sakit', 'no_surat', $post['tgl_surat'], 3, false);

        // Normalisasi tambahan
        $post['keterangan']            = $post['keterangan'] ?? null;
        $post['is_signed_by_guardian'] = !empty($post['is_signed_by_guardian']) ? 1 : 0;
        $post['nama_wali']             = $post['nama_wali'] ?? null;
        $post['hubungan_wali']         = $post['hubungan_wali'] ?? null;
        $post['is_final']              = 0;
        $post['tgl_input']             = date('Y-m-d H:i:s');

        try {
            $res = $this->Model->save($post);
            if (!empty($res['ok'])) {
                return $this->json([
                    'status'  => 'success',
                    'message' => 'Surat sakit berhasil disimpan.',
                    'id'      => $res['id'] ?? null,
                    'no_surat'=> $post['no_surat']
                ]);
            }
            return $this->json([
                'status'  => 'error',
                'message' => $res['error'] ?? 'Gagal menyimpan surat sakit.'
            ], 500);
        } catch (Exception $e) {
            log_message('error', 'Exception save surat sakit: '.$e->getMessage());
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

        // Jika sudah final → tolak update (kecuali kamu nanti siapkan route khusus revisi)
        $row = $this->Model->getById($id);
        if (!$row) return $this->json(['status'=>'error','message'=>'Data tidak ditemukan.'], 404);
        if ((int)$row['is_final'] === 1) {
            return $this->json(['status'=>'error','message'=>'Surat sudah final dan terkunci.'], 423);
        }

        // whitelist sesuai kolom tabel
        $payload = [
            'no_rawat'             => $data['no_rawat'] ?? $row['no_rawat'],
            'kd_dokter'            => $data['kd_dokter'] ?? $row['kd_dokter'],
            'no_rkm_medis'         => $data['no_rkm_medis'] ?? $row['no_rkm_medis'],
            'tgl_surat'            => $data['tgl_surat'] ?: $row['tgl_surat'],
            'tgl_mulai_istirahat'  => $data['tgl_mulai_istirahat'] ?? $row['tgl_mulai_istirahat'],
            'lama_istirahat_hari'  => $data['lama_istirahat_hari'] ?? $row['lama_istirahat_hari'],
            'keterangan'           => $data['keterangan'] ?? $row['keterangan'],
            'is_signed_by_guardian'=> !empty($data['is_signed_by_guardian']) ? 1 : 0,
            'nama_wali'            => $data['nama_wali'] ?? $row['nama_wali'],
            'hubungan_wali'        => $data['hubungan_wali'] ?? $row['hubungan_wali'],
            'tgl_input'            => date('Y-m-d H:i:s'),
        ];

        $ok = $this->Model->update($id, $payload);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Surat sakit berhasil diperbarui.'])
            : $this->json(['status'=>'error','message'=>'Gagal memperbarui surat sakit.'], 400);
    }

    /* =========================
     * READ
     * ========================= */
    public function getByNoRawat()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) return $this->json(['status'=>'error','message'=>'No Rawat tidak ditemukan.'], 422);

        $row = $this->Model->getByNoRawat($no_rawat);
        if (empty($row)) return $this->json(['status'=>'empty','message'=>'Belum ada surat sakit.']);
        return $this->json(['status'=>'success','data'=>$row]);
    }

    public function getById()
    {
        $id = (int)$this->input->get('id');
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter id tidak ditemukan.'], 422);

        $row = $this->Model->getById($id);
        if (!$row) return $this->json(['status'=>'empty','message'=>'Data tidak ditemukan.']);
        return $this->json(['status'=>'success','data'=>$row]);
    }

    /* =========================
     * DELETE
     * ========================= */
    public function delete()
    {
        $id = (int)$this->input->post('id');
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter ID tidak ditemukan.'], 422);

        // Cegah hapus jika sudah final
        $row = $this->Model->getById($id);
        if (!$row) return $this->json(['status'=>'error','message'=>'Data tidak ditemukan.'], 404);
        if ((int)$row['is_final'] === 1) {
            return $this->json(['status'=>'error','message'=>'Surat sudah final dan tidak dapat dihapus.'], 423);
        }

        $ok = $this->Model->delete($id);
        return $ok
            ? $this->json(['status'=>'success','message'=>'Surat sakit berhasil dihapus.'])
            : $this->json(['status'=>'error','message'=>'Gagal menghapus data.'], 400);
    }

    /* =========================
     * SIGN (TTD)
     * ========================= */
    public function signDoctor()
    {
        $id  = (int) $this->input->post('id', true);
        $ttd = $this->input->post('ttd', false); // base64 dataURL, jangan xss_clean

        if (!$id)  return $this->json(['status'=>'error','message'=>'Parameter id kosong.'], 422);
        if (!$ttd) return $this->json(['status'=>'error','message'=>'TTD kosong.'], 422);

        if (strpos($ttd, 'data:image') !== 0) {
            $ttd = 'data:image/png;base64,' . $ttd;
        }

        $ok = $this->Model->update($id, [
            'ttd_dokter' => $ttd,
            'tgl_input'  => date('Y-m-d H:i:s'),
        ]);

        return $ok
            ? $this->json(['status'=>'success','message'=>'TTD dokter tersimpan.'])
            : $this->json(['status'=>'error','message'=>'Gagal menyimpan TTD dokter.'], 500);
    }

    public function signPatient()
    {
        $id  = (int) $this->input->post('id', true);
        $ttd = $this->input->post('ttd', false);

        if (!$id)  return $this->json(['status'=>'error','message'=>'Parameter id kosong.'], 422);
        if (!$ttd) return $this->json(['status'=>'error','message'=>'TTD kosong.'], 422);

        if (strpos($ttd, 'data:image') !== 0) {
            $ttd = 'data:image/png;base64,' . $ttd;
        }

        $ok = $this->Model->update($id, [
            'ttd_pasien' => $ttd,
            'tgl_input'  => date('Y-m-d H:i:s'),
        ]);

        return $ok
            ? $this->json(['status'=>'success','message'=>'TTD pasien/wali tersimpan.'])
            : $this->json(['status'=>'error','message'=>'Gagal menyimpan TTD pasien/wali.'], 500);
    }

    /* =========================
     * FINALIZE (lock & siap cetak)
     * ========================= */
    public function finalize()
    {
        $id = (int)$this->input->post('id');
        if (!$id) return $this->json(['status'=>'error','message'=>'Parameter id tidak ditemukan.'], 422);

        $row = $this->Model->getById($id);
        if (!$row) return $this->json(['status'=>'error','message'=>'Data tidak ditemukan.'], 404);
        if ((int)$row['is_final'] === 1) {
            return $this->json(['status'=>'success','message'=>'Surat sudah final.']);
        }

        // Minimal: harus ada TTD dokter
        if (empty($row['ttd_dokter'])) {
            return $this->json(['status'=>'error','message'=>'TTD dokter belum ada.'], 422);
        }

        $ok = $this->Model->update($id, [
            'is_final' => 1,
            'tgl_input'=> date('Y-m-d H:i:s'),
        ]);

        return $ok
            ? $this->json(['status'=>'success','message'=>'Surat sakit difinalisasi.'])
            : $this->json(['status'=>'error','message'=>'Gagal finalisasi surat.'], 500);
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
        foreach (['ttd_dokter','ttd_pasien'] as $k) {
            if (!empty($row[$k]) && strpos($row[$k], 'data:image') !== 0) {
                $row[$k] = 'data:image/png;base64,' . $row[$k];
            }
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
            // hitung tgl selesai: mulai + (lama-1)
            'tgl_selesai'   => !empty($row['lama_istirahat_hari'])
                ? date('Y-m-d', strtotime($row['tgl_mulai_istirahat'].' +'.((int)$row['lama_istirahat_hari']-1).' day'))
                : $row['tgl_mulai_istirahat'],
        ];

        $this->load->view('rekammedis/dokter/suratSakitRalan_print', $data);
    }
}

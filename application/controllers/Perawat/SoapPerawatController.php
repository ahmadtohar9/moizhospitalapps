<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoapPerawatController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('perawat/SoapPerawatModel', 'SoapPerawatModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->helper('response');

        if (!$this->session->userdata('user_id')) {
            if ($this->input->is_ajax_request()) {
                response_json(['status' => 'unauthenticated', 'message' => 'Sesi habis, silakan login lagi.'], 401);
                exit;
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
        return $this->output->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    private function scrubPayload(array $data, array $preserve_keys = [])
    {
        if (isset($this->security)) {
            $csrfName = $this->security->get_csrf_token_name();
            unset($data[$csrfName]);
        }
        if (!in_array('original_jam_rawat', $preserve_keys, true)) {
            unset($data['original_jam_rawat']);
        }
        unset($data['btn'], $data['submit'], $data['kd_dokter']); // tidak dipakai di perawat
        return $data;
    }

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

        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'];
        $data['nip_perawat'] = $this->session->userdata('user_nip'); // identitas penginput
        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        log_message('debug', "Memuat SOAP Perawat untuk No Rawat: {$no_rawat} oleh Role ID: {$role_id}");

        $this->load->view('perawat/soap_perawat', $data);
    }

    // ---------- CREATE (AMAN & IDEMPOTEN) ----------
    public function save()
    {
        $data = $this->scrubPayload($this->input->post(null, true));

        // nip penginput = perawat login (kecuali admin boleh override tapi kita samakan saja)
        $nip_from_session = $this->session->userdata('user_nip');
        $username = $this->session->userdata('username');

        // Khusus admin: ambil dari kode dokter di reg_periksa
        if ($username === 'admin' || $username === 'administrator') {
            $no_rawat = $data['no_rawat'] ?? null;
            if ($no_rawat) {
                $reg = $this->db->select('kd_dokter')->get_where('reg_periksa', ['no_rawat' => $no_rawat])->row();
                if ($reg && $reg->kd_dokter) {
                    $data['nip'] = $reg->kd_dokter;
                    log_message('info', 'Admin menggunakan NIP dari dokter poli: ' . $reg->kd_dokter);
                } else {
                    return $this->json(['status' => 'error', 'message' => 'Kode dokter tidak ditemukan di registrasi.'], 422);
                }
            } else {
                return $this->json(['status' => 'error', 'message' => 'No. Rawat tidak ditemukan.'], 422);
            }
        } else {
            // Validasi: pastikan NIP ada di tabel pegawai
            if ($nip_from_session) {
                $check_nip = $this->db->get_where('pegawai', ['nik' => $nip_from_session])->row();
                if ($check_nip) {
                    $data['nip'] = $nip_from_session;
                } else {
                    // Fallback: coba ambil dari petugas berdasarkan user_id
                    $user_id = $this->session->userdata('user_id');
                    if ($user_id) {
                        $petugas = $this->db->select('nip')->get_where('petugas', ['user_id' => $user_id])->row();
                        if ($petugas && $petugas->nip) {
                            $data['nip'] = $petugas->nip;
                        } else {
                            return $this->json(['status' => 'error', 'message' => 'NIP petugas tidak ditemukan. Silakan hubungi administrator.'], 422);
                        }
                    } else {
                        return $this->json(['status' => 'error', 'message' => 'Session user tidak valid.'], 422);
                    }
                }
            } else {
                return $this->json(['status' => 'error', 'message' => 'NIP tidak ditemukan di session.'], 422);
            }
        }

        log_message('debug', 'SOAP Perawat save payload: ' . json_encode($data));

        try {
            $res = $this->SoapPerawatModel->save($data);
            if (!empty($res['ok'])) {
                if (!empty($res['skipped'])) {
                    return $this->json(['status' => 'success', 'skipped' => true, 'message' => 'Data SOAP sudah ada (idempotent).']);
                }
                return $this->json(['status' => 'success', 'message' => 'Data SOAP berhasil disimpan.', 'id' => $res['id'] ?? null]);
            }
            return $this->json(['status' => 'error', 'message' => $res['error'] ?? 'Gagal menyimpan data SOAP.'], 500);
        } catch (InvalidArgumentException $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        } catch (Exception $e) {
            log_message('error', 'Exception save SOAP Perawat: ' . $e->getMessage());
            return $this->json(['status' => 'error', 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    // ---------- UPDATE (OPTIMISTIC BY KEY) ----------
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

        // owner selalu nip perawat login
        $data['nip'] = $this->session->userdata('user_nip');
        unset($data['jam_rawat'], $data['no_rawat'], $data['tgl_perawatan'], $data['original_jam_rawat']);

        if (!$new_jam || $new_jam === $orig_jam) {
            $ok = $this->SoapPerawatModel->updateByKey($no_rawat, $tgl_perawatan, $orig_jam, $data);
            if ($ok)
                return $this->json(['status' => 'success', 'message' => 'Data SOAP berhasil diperbarui.']);
            return $this->json(['status' => 'conflict', 'message' => 'Data tidak diperbarui / tidak ada perubahan.'], 409);
        }

        $res = $this->SoapPerawatModel->updateKeyAndData($no_rawat, $tgl_perawatan, $orig_jam, $new_jam, $data);
        if (!empty($res['ok']))
            return $this->json(['status' => 'success', 'message' => 'Data SOAP & jam berhasil diperbarui.']);
        if (!empty($res['code']) && $res['code'] === 'duplicate_key') {
            return $this->json(['status' => 'error', 'message' => 'Jam yang baru sudah dipakai. Pilih jam lain.'], 409);
        }
        return $this->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
    }

    // ---------- DELETE (GUARD 48 JAM + PEMILIK) ----------
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

        if ($role_id === 1) { // admin
            $nipLogin = null;
            $enforce48 = false;
        }

        $res = $this->SoapPerawatModel->deleteByNoRawatAndTime($no_rawat, $tgl_perawatan, $jam_rawat, $nipLogin, $enforce48);

        if ($res === true) {
            return $this->json(['status' => 'success', 'message' => 'Data SOAP berhasil dihapus.']);
        }

        // Map code -> pesan + status code
        $msg = 'Gagal menghapus.';
        $code = 400;
        if (is_array($res) && !empty($res['code'])) {
            switch ($res['code']) {
                case 'not_owner':
                    $msg = 'Tidak bisa menghapus: data ini dibuat oleh pengguna lain.';
                    $code = 403;
                    break;
                case 'expired_48h':
                    $msg = 'Tidak bisa menghapus: melewati batas 48 jam.';
                    $code = 400;
                    break;
                case 'invalid_datetime':
                    $msg = 'Format tanggal/jam tidak valid.';
                    $code = 422;
                    break;
                case 'not_found':
                    $msg = 'Data SOAP tidak ditemukan atau sudah dihapus.';
                    $code = 404;
                    break;
                case 'no_login':
                    $msg = 'Sesi tidak valid. Silakan login ulang.';
                    $code = 401;
                    break;
                case 'bad_request':
                    $msg = 'Parameter hapus tidak lengkap.';
                    $code = 422;
                    break;
                default:
                    $msg = 'Kesalahan server saat menghapus data.';
                    $code = 500;
                    break;
            }
        }
        return $this->json(['status' => 'error', 'message' => $msg], $code);
    }


    // ---------- READ ----------
    public function getHasil()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat)
            return $this->json(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.'], 422);

        $page = max(1, (int) $this->input->get('page', true));
        $size = max(1, min(200, (int) $this->input->get('size', true) ?: 50));
        $offset = ($page - 1) * $size;

        $total = $this->SoapPerawatModel->countHasil($no_rawat);
        $rows = $this->SoapPerawatModel->getHasil($no_rawat, $size, $offset);

        if (empty($rows)) {
            return $this->json(['status' => 'empty', 'message' => 'Belum ada data hasil SOAP.', 'total' => $total, 'page' => $page, 'size' => $size]);
        }
        return $this->json(['status' => 'success', 'data' => $rows, 'total' => (int) $total, 'page' => (int) $page, 'size' => (int) $size]);
    }

    public function getRiwayatByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis', true);
        if (!$no_rkm_medis)
            return $this->json(['status' => 'error', 'message' => 'Nomor Rekam Medis tidak ditemukan.'], 422);

        $page = max(1, (int) $this->input->get('page', true));
        $size = max(1, min(200, (int) $this->input->get('size', true) ?: 50));
        $offset = ($page - 1) * $size;

        $total = $this->SoapPerawatModel->countRiwayatByNoRM($no_rkm_medis);
        $data = $this->SoapPerawatModel->getRiwayatByNoRM($no_rkm_medis, $size, $offset);

        return $this->json(['status' => 'success', 'data' => $data, 'total' => (int) $total, 'page' => (int) $page, 'size' => (int) $size]);
    }

    public function getDetail()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        $tgl_perawatan = $this->input->get('tgl_perawatan', true);
        $jam_rawat = $this->input->get('jam_rawat', true);

        if (!$no_rawat || !$tgl_perawatan || !$jam_rawat) {
            return $this->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        $data = $this->SoapPerawatModel->getByNoRawat($no_rawat, $tgl_perawatan, $jam_rawat);
        if ($data)
            return $this->json(['status' => 'success', 'data' => $data]);
        return $this->json(['status' => 'error', 'message' => 'Data tidak ditemukan.'], 404);
    }

    public function get_last_ttv()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat)
            return $this->json(['status' => 'error', 'message' => 'No Rawat kosong.'], 422);

        $lastTTV = $this->SoapPerawatModel->getLastTTV($no_rawat);
        if ($lastTTV)
            return $this->json(['status' => 'success', 'data' => $lastTTV]);
        return $this->json(['status' => 'empty', 'message' => 'Belum ada data TTV.']);
    }
}

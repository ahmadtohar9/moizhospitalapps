<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerawatRalanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Models & helper
        $this->load->model('Perawat/PerawatRalanModel', 'PerawatModel');
        $this->load->model('RekamMedisRalanModel', 'RM');
        $this->load->model('MenuModel');
        $this->load->model('PasienRajal_model'); // untuk dropdown penjamin
        $this->load->helper('response');

        // Auth guard
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // Role guard: Admin(1) & Perawat(4)
        $role = (int)$this->session->userdata('role_id');
        if (!in_array($role, [1,4], true)) {
            show_error('Akses ditolak (khusus perawat).', 403, 'Forbidden');
        }
    }

    /* ==========================
     * Util JSON & Payload
     * ========================== */
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

    /* ==========================
     * UI: LISTING
     * ========================== */
    public function index()
    {
        $data['penjab_list'] = $this->PasienRajal_model->get_penjamin() ?: [];
        $data['nama_user']   = $this->session->userdata('nama_user');
        $data['role_id']     = $this->session->userdata('role_id');
        $data['menus']       = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title']       = 'Perawat Rawat Jalan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('perawat/perawat_ralan', $data);  // <-- view listing perawat
        $this->load->view('templates/footer');
    }

    public function get_data()
    {
        $start_date     = $this->input->get('start_date');
        $end_date       = $this->input->get('end_date');
        $penjab         = $this->input->get('penjab');
        $status_bayar   = $this->input->get('status_bayar');
        $status_periksa = $this->input->get('status_periksa');
        $rows = $this->PerawatModel->get_pasien_rajal(
            $start_date, $end_date, $penjab, $status_bayar, $status_periksa
        );

        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($rows));
    }

    public function form()
    {
        return $this->index(); // alias ke halaman listing perawat
    }


    // PerawatRalanController
     public function rekamMedis($tahun, $bulan, $tanggal, $no_rawat)
    {
        $full_no_rawat = "$tahun/$bulan/$tanggal/$no_rawat";

        // opsional: validasi bahwa user login adalah perawat
        $role_id = (int)$this->session->userdata('role_id');
        if ($role_id !== 4) {
            // kalau bukan perawat tapi masuk lewat sini, tetap izinkan admin
            if ($role_id !== 1) {
                show_error('Akses ditolak. Halaman ini hanya untuk perawat.', 403, 'Error');
            }
        }

        // set session untuk dipakai container
        $this->session->set_userdata('no_rawat', $full_no_rawat);

        // lempar ke container dengan context "perawat"
        redirect("RekamMedisRalanController/rekammedisRalanForm/{$tahun}/{$bulan}/{$tanggal}/{$no_rawat}/perawat");
    }


    /* ==========================
     * Setter session no_rawat
     * ========================== */
    public function setNoRawatSession()
    {
        $no_rawat = $this->input->post('no_rawat', true);
        if (!$no_rawat) $no_rawat = $this->input->get('no_rawat', true);

        if (!$no_rawat) {
            return $this->json(['status'=>'error','message'=>'no_rawat tidak boleh kosong'], 422);
        }

        $row = $this->db->select('no_rawat,no_rkm_medis,kd_dokter,kd_poli')
                        ->get_where('reg_periksa', ['no_rawat'=>$no_rawat])
                        ->row_array();
        if (!$row) {
            return $this->json(['status'=>'error','message'=>'no_rawat tidak ditemukan di reg_periksa'], 404);
        }

        $this->session->set_userdata('no_rawat', $row['no_rawat']);
        $this->session->set_userdata('no_rkm_medis', $row['no_rkm_medis']);
        if (!empty($row['kd_dokter'])) $this->session->set_userdata('kd_dokter', $row['kd_dokter']);
        if (!empty($row['kd_poli']))   $this->session->set_userdata('kd_poli', $row['kd_poli']);

        return $this->json(['status'=>'success','message'=>'Session no_rawat diset']);
    }

    /* ==========================
     * API SAVE/GET
     * ========================== */
    public function save_ttv()
    {
        $post = $this->scrubPayload($this->input->post(null, true));
        $post['nip'] = $this->session->userdata('user_nip');

        try {
            $ok = $this->PerawatModel->saveTTV($post);
            return $ok
                ? $this->json(['status'=>'success','message'=>'TTV berhasil disimpan.'])
                : $this->json(['status'=>'error','message'=>'Gagal menyimpan TTV.'], 500);
        } catch (InvalidArgumentException $e) {
            return $this->json(['status'=>'error','message'=>$e->getMessage()], 422);
        } catch (Exception $e) {
            log_message('error', 'save_ttv exception: '.$e->getMessage());
            return $this->json(['status'=>'error','message'=>'Terjadi kesalahan server.'], 500);
        }
    }

    public function save_asesmen()
    {
        $post = $this->scrubPayload($this->input->post(null, true));
        $post['nip'] = $this->session->userdata('user_nip');

        try {
            $ok = $this->PerawatModel->saveAsesmen($post);
            return $ok
                ? $this->json(['status'=>'success','message'=>'Asesmen keperawatan tersimpan.'])
                : $this->json(['status'=>'error','message'=>'Gagal menyimpan asesmen.'], 500);
        } catch (InvalidArgumentException $e) {
            return $this->json(['status'=>'error','message'=>$e->getMessage()], 422);
        } catch (Exception $e) {
            log_message('error', 'save_asesmen exception: '.$e->getMessage());
            return $this->json(['status'=>'error','message'=>'Terjadi kesalahan server.'], 500);
        }
    }

    public function save_tindakan()
    {
        $post = $this->scrubPayload($this->input->post(null, true));
        $post['nip'] = $this->session->userdata('user_nip');

        try {
            $ok = $this->PerawatModel->saveTindakan($post);
            return $ok
                ? $this->json(['status'=>'success','message'=>'Tindakan perawat tersimpan.'])
                : $this->json(['status'=>'error','message'=>'Gagal menyimpan tindakan.'], 500);
        } catch (InvalidArgumentException $e) {
            return $this->json(['status'=>'error','message'=>$e->getMessage()], 422);
        } catch (Exception $e) {
            log_message('error', 'save_tindakan exception: '.$e->getMessage());
            return $this->json(['status'=>'error','message'=>'Terjadi kesalahan server.'], 500);
        }
    }

    public function riwayat_by_norm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis', true);
        if (!$no_rkm_medis) {
            return $this->json(['status'=>'error','message'=>'Nomor rekam medis kosong.'], 422);
        }

        $page = max(1, (int)$this->input->get('page', true));
        $size = max(1, min(200, (int)$this->input->get('size', true) ?: 50));
        $offset = ($page - 1) * $size;

        $total = (int)$this->PerawatModel->countRiwayatByNoRM($no_rkm_medis);
        $rows  = $this->PerawatModel->getRiwayatByNoRM($no_rkm_medis, $size, $offset);

        return $this->json([
            'status' => 'success',
            'data'   => $rows,
            'total'  => $total,
            'page'   => $page,
            'size'   => $size
        ]);
    }

    public function last_ttv()
    {
        $no_rawat = $this->input->get('no_rawat', true);
        if (!$no_rawat) return $this->json(['status'=>'error','message'=>'No. Rawat kosong.'], 422);

        $row = $this->PerawatModel->getLastTTV($no_rawat);
        return $row
            ? $this->json(['status'=>'success','data'=>$row])
            : $this->json(['status'=>'empty','message'=>'Belum ada data TTV.']);
    }

    public function delete_item()
    {
        $post = $this->scrubPayload($this->input->post(null, true));

        $nipLogin  = $this->session->userdata('user_nip');
        $role_id   = (int)$this->session->userdata('role_id');
        $enforce48 = ($role_id !== 1); // admin boleh hapus >48 jam

        $ok = $this->PerawatModel->deleteItem($post, $nipLogin, $enforce48);

        if ($ok === true) {
            return $this->json(['status'=>'success','message'=>'Data berhasil dihapus.']);
        }
        return $this->json([
            'status'  => 'error',
            'message' => 'Gagal menghapus data (melewati 48 jam, bukan pemilik, atau data tidak ada).'
        ], 400);
    }
}

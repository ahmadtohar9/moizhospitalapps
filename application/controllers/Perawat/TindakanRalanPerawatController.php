<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TindakanRalanPerawatController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('perawat/TindakanRalanPerawatModel', 'Model');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        if (!$this->session->userdata('user_id')) redirect('auth/login');
    }

    private function json($payload, $code=200){
        if (property_exists($this, 'security')) {
            $payload['csrfToken'] = $this->security->get_csrf_hash();
            $payload['csrfName']  = $this->security->get_csrf_token_name();
        }
        return $this->output->set_status_header($code)->set_content_type('application/json')->set_output(json_encode($payload));
    }

    public function index()
    {
        $data['title']         = 'Tindakan Perawat Ralan';
        $data['menus']         = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['action_menus']  = $this->MenuModel->get_active_action_menus();
        $data['no_rawat']      = $this->session->userdata('no_rawat');
        $detail_pasien         = $this->RekamMedisRalanModel->get_patient_detail($data['no_rawat']);
        $data['detail_pasien'] = $detail_pasien;
        $data['no_rkm_medis']  = $detail_pasien['no_rkm_medis'] ?? '';
        $data['nip_perawat']   = $this->session->userdata('user_nip'); // owner

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('perawat/tindakanRalan', $data); // → view perawat
        $this->load->view('templates/footer');
    }

    public function getTindakan()
    {
        $data = $this->Model->getAllTindakan();
        return $this->json(['status'=>!empty($data)?'success':'empty','data'=>$data]);
    }

    public function saveTindakan()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tindakan = $this->input->post('tindakan'); // array

        if (empty($no_rawat) || empty($tindakan)) {
            return $this->json(['status'=>'error','message'=>'Data tidak lengkap.'], 422);
        }

        $nip = $this->session->userdata('user_nip'); // owner perawat
        $rows = [];
        foreach ($tindakan as $t) {
            $rows[] = [
                'no_rawat'      => $no_rawat,
                'kd_jenis_prw'  => $t['kd_jenis_prw'],
                'nip'           => $nip,
                'tgl_perawatan' => $t['tgl_perawatan'],
                'jam_rawat'     => $t['jam_rawat'],
                'material'      => $t['material'],
                'bhp'           => $t['bhp'],
                'tarif_tindakanpr' => $t['tarif_tindakandr'] ?? 0, // mapping tarif perawat jika ada
                'kso'           => $t['kso'],
                'menejemen'     => $t['menejemen'],
                'biaya_rawat'   => $t['biaya_rawat'],
                'stts_bayar'    => 'Belum'
            ];
        }
        $this->Model->saveTindakan($rows);
        return $this->json(['status'=>'success','message'=>'Tindakan berhasil disimpan.']);
    }

    public function getHasilTindakan()
    {
        $no_rawat = $this->input->get('no_rawat');
        $rows = $this->Model->getHasilTindakanCombined($no_rawat);

        // flag boleh hapus → hanya perawat & owner = nip login
        $nipLogin = $this->session->userdata('user_nip');
        foreach ($rows as &$r) {
            $r['allow_delete'] = ($r['sumber'] === 'perawat' && $nipLogin && $r['owner_id'] === $nipLogin) ? 1 : 0;
        }
        unset($r);

        return $this->json(['status'=>'success','data'=>$rows]);
    }


    // ========= HAPUS (pakai helper 48 jam + owner) =========
    public function deleteTindakan()
    {
        $items = $this->input->post('items');
        if (empty($items)) return $this->json(['status'=>'error','message'=>'Tidak ada data yang dipilih.'], 422);

        $role_id   = (int) $this->session->userdata('role_id');
        $nipLogin  = $this->session->userdata('user_nip');
        $enforce48 = ($role_id === 1) ? false : true;
        if ($role_id === 1) $nipLogin = null;

        foreach ($items as $item) {
            // ⛔ blok kalau client coba kirim sumber dokter
            if (!empty($item['sumber']) && $item['sumber'] !== 'perawat') {
                return $this->json(['status'=>'error','message'=>'Tidak bisa menghapus tindakan milik dokter.'], 403);
            }

            $res = $this->Model->deleteOne(
                $item['no_rawat'] ?? null,
                $item['kd_jenis_prw'] ?? null,
                $item['tgl_perawatan'] ?? null,
                $item['jam_rawat'] ?? null,
                $nipLogin,
                $enforce48
            );
            if ($res !== true) {
                $msg='Gagal menghapus tindakan.'; $code=400;
                if (is_array($res) && !empty($res['code'])) {
                    switch ($res['code']) {
                        case 'not_owner':        $msg='Tidak bisa menghapus: data ini dibuat oleh pengguna lain.'; $code=403; break;
                        case 'expired_48h':      $msg='Tidak bisa menghapus: melewati batas 48 jam.';              $code=400; break;
                        case 'not_found':        $msg='Data tindakan tidak ditemukan atau sudah dihapus.';          $code=404; break;
                        case 'invalid_datetime': $msg='Format tanggal/jam tidak valid.';                            $code=422; break;
                        case 'bad_request':      $msg='Parameter hapus tidak lengkap.';                             $code=422; break;
                        default:                 $msg='Kesalahan server saat menghapus data.';                      $code=500;
                    }
                }
                return $this->json(['status'=>'error','message'=>$msg], $code);
            }
        }
        return $this->json(['status'=>'success','message'=>'Tindakan berhasil dihapus.']);
    }


    public function getRiwayatTindakanByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');
        $data = $this->Model->getRiwayatTindakanByNorm($no_rkm_medis);
        return $this->json(['status'=>'success','data'=>$data]);
    }
}

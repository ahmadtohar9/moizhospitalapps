<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssessmentPerawatController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('perawat/KeperawatanMasterModel', 'KM');
        $this->load->model('perawat/AsesmenAwalKeperawatanModel', 'AAK'); // ← MODEL BARU
        $this->load->database();
    }

    public function masterMasalahRencana()
    {
        $tree = $this->KM->getTreeMasalahRencana();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status'=>'ok','data'=>$tree]));
    }

    public function get()
    {
        $no_rawat      = $this->input->get('no_rawat', true);
        $tgl_perawatan = $this->input->get('tgl_perawatan', true);
        $jam_rawat     = $this->input->get('jam_rawat', true);

        if (!$no_rawat) {
            return $this->_json(['status' => 'error', 'message' => 'no_rawat wajib.'], 422);
        }

        // --- Ambil asesmen (by key jika tgl/jam ada; jika tidak ambil terakhir)
        $asesmen = null;
        try {
            if (!empty($tgl_perawatan) && !empty($jam_rawat)) {
                $asesmen = $this->AAK->get_by_key($no_rawat, $tgl_perawatan, $jam_rawat);
            } else {
                $asesmen = $this->AAK->get_latest($no_rawat);
            }

            // Normalisasi asesmen_json jika masih string
            if (is_array($asesmen) && isset($asesmen['asesmen_json']) && is_string($asesmen['asesmen_json'])) {
                $tmp = json_decode($asesmen['asesmen_json'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $asesmen['asesmen_json'] = $tmp;
                }
            }
        } catch (Throwable $e) {
            log_message('error', 'AAK get failed: '.$e->getMessage());
            $asesmen = null; // lanjutkan saja; demografi tetap dikirim
        }

        // --- Ambil demografi pasien (agama & bahasa)
        // Mapping: pasien.bahasa_pasien -> bahasa_pasien.id
        $demografi = $this->db->select("
                p.no_rkm_medis,
                p.nm_pasien,
                COALESCE(p.agama, '') AS agama,
                p.bahasa_pasien AS bahasa_id,
                COALESCE(bp.nama_bahasa, '') AS bahasa
            ", false)
            ->from('reg_periksa r')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis')
            ->join('bahasa_pasien bp', 'bp.id = p.bahasa_pasien', 'left')
            ->where('r.no_rawat', $no_rawat)
            ->limit(1)
            ->get()->row_array() ?: [];

        // --- Response sukses selalu, asesmen bisa null
        return $this->_json([
            'status' => 'success',
            'data'   => [
                'asesmen'      => $asesmen ?: null,
                'has_asesmen'  => $asesmen ? true : false,
                'demografi'    => $demografi,
            ],
        ]);
    }


    // POST /perawat/assessment/save  (UPSERT)
    public function save()
    {
        $d = $this->input->post(NULL, true);

        // asesmen_json dari FE bisa string JSON
        if (isset($d['asesmen_json']) && is_string($d['asesmen_json'])) {
            $json = json_decode($d['asesmen_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) $d['asesmen_json'] = $json;
        }

        try {
            $nip = $this->session->userdata('user_nip');
            $ok  = $this->AAK->upsert_from_payload($d, $nip);
            return $this->_json(['status'=>$ok?'success':'error']);
        } catch (Throwable $e) {
            log_message('error', 'save asesmen: '.$e->getMessage());
            return $this->_json(['status'=>'error','message'=>$e->getMessage()], 500);
        }
    }

    // POST /perawat/assessment/delete
    public function delete()
    {
        $no_rawat      = $this->input->post('no_rawat', true);
        $tgl_perawatan = $this->input->post('tgl_perawatan', true);
        $jam_rawat     = $this->input->post('jam_rawat', true);

        if (!$no_rawat || !$tgl_perawatan || !$jam_rawat) {
            return $this->_json(['status'=>'error','message'=>'no_rawat/tanggal/jam wajib.'], 422);
        }

        // Guard 48 jam & owner kalau perlu → di sini contoh sederhana tanpa guard
        try {
            $ok = $this->AAK->delete_by_key($no_rawat, $tgl_perawatan, $jam_rawat);
            return $this->_json([
                'status'  => $ok ? 'success' : 'error',
                'message' => $ok ? 'Asesmen terhapus.' : 'Data tidak ditemukan / gagal hapus.'
            ], $ok?200:400);
        } catch (Throwable $e) {
            log_message('error', 'delete asesmen: '.$e->getMessage());
            return $this->_json(['status'=>'error','message'=>$e->getMessage()], 500);
        }
    }

    private function _json($payload, $code=200) {
        if (property_exists($this, 'security')) {
            $payload['csrfToken'] = $this->security->get_csrf_hash();
            $payload['csrfName']  = $this->security->get_csrf_token_name();
        }
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}

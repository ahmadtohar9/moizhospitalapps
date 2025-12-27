<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanResepRalanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PermintaanResepRalan_model');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        // Validasi login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        // Ambil detail pasien berdasarkan no_rawat
        $detail = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$detail) {
            show_error('Data pasien tidak ditemukan.', 404);
            return;
        }

        // Simpan ke session agar dapat digunakan ulang di JS
        $this->session->set_userdata('no_rawat', $no_rawat);
        $this->session->set_userdata('no_rkm_medis', $detail['no_rkm_medis']);

        // Data untuk view
        $data = [
            'no_rawat' => $no_rawat,
            'kd_dokter' => $detail['kd_dokter'],
            'no_rkm_medis' => $detail['no_rkm_medis'],
            'menus' => $this->MenuModel->get_menu_by_user($this->session->userdata('user_id')),
            'action_menus' => $this->MenuModel->get_active_action_menus(),
            'last_soap' => ($soap = $this->RekamMedisRalanModel->getHasilSOAP($no_rawat)) ? $soap[0] : null
        ];

        $this->load->view('rekammedis/dokter/permintaanresepralan_form', $data);
    }

    public function getObatList()
    {
        $data = $this->PermintaanResepRalan_model->getObatList();
        echo json_encode([
            'status' => !empty($data) ? 'success' : 'empty',
            'data' => $data
        ]);
    }

    public function getHasilResep()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak ditemukan.']);
            return;
        }

        $data = $this->PermintaanResepRalan_model->getHasilResep($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function getRiwayatObatByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');

        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor Rekam Medis kosong.']);
            return;
        }

        $data = $this->PermintaanResepRalan_model->getRiwayatObatByNorm($no_rkm_medis);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    /**
     * Check if medicine was already prescribed today in other poli
     */
    public function checkDuplicateMedicine()
    {
        $no_rkm_medis = $this->input->post('no_rkm_medis');
        $no_rawat = $this->input->post('no_rawat');
        $medicines = $this->input->post('medicines'); // Array of kode_brng

        if (!$no_rkm_medis || !$no_rawat || empty($medicines)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
            return;
        }

        $duplicates = $this->PermintaanResepRalan_model->checkDuplicateMedicine(
            $no_rkm_medis,
            $no_rawat,
            $medicines,
            date('Y-m-d') // Today
        );

        if (!empty($duplicates)) {
            echo json_encode([
                'status' => 'warning',
                'has_duplicate' => true,
                'duplicates' => $duplicates
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'has_duplicate' => false
            ]);
        }
    }

    public function save()
    {
        $this->load->helper('resep');
        $no_resep = generate_no_resep();

        $no_rawat = $this->input->post('no_rawat');
        $kd_dokter = $this->input->post('kd_dokter');
        $tgl_peresepan = $this->input->post('tgl_peresepan');
        $jam_peresepan = $this->input->post('jam_peresepan');
        $resep = $this->input->post('resep');

        if (!$tgl_peresepan || !$jam_peresepan || empty($resep)) {
            echo json_encode(['status' => 'error', 'message' => 'Tanggal, jam, atau data resep kosong.']);
            return;
        }

        $data_resep_obat = [
            'no_resep' => $no_resep,
            'tgl_perawatan' => '0000-00-00',
            'jam' => '00:00:00',
            'no_rawat' => $no_rawat,
            'kd_dokter' => $kd_dokter,
            'tgl_peresepan' => $tgl_peresepan,
            'jam_peresepan' => $jam_peresepan,
            'status' => 'ralan',
            'tgl_penyerahan' => '0000-00-00',
            'jam_penyerahan' => '00:00:00'
        ];

        $this->db->insert('resep_obat', $data_resep_obat);

        $data_resep_dokter = [];
        foreach ($resep as $item) {
            $obat = $this->db->select('stok, nama_brng')
                ->from('gudangbarang')
                ->join('databarang', 'databarang.kode_brng = gudangbarang.kode_brng')
                ->where('gudangbarang.kode_brng', $item['kode_brng'])
                ->get()
                ->row();

            if ($item['jumlah'] > $obat->stok) {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Stok obat \"{$obat->nama_brng}\" hanya tersedia {$obat->stok}."
                ]);
                return;
            }

            $data_resep_dokter[] = [
                'no_resep' => $no_resep,
                'kode_brng' => $item['kode_brng'],
                'jml' => $item['jumlah'],
                'aturan_pakai' => $item['signa']
            ];
        }

        if (!empty($data_resep_dokter)) {
            $this->db->insert_batch('resep_dokter', $data_resep_dokter);
        }

        echo json_encode(['status' => 'success', 'message' => 'Resep berhasil disimpan.', 'no_resep' => $no_resep]);
    }

    public function delete()
    {
        $kode_brng = $this->input->post('kode_brng');
        $jumlah = $this->input->post('jumlah');

        if (!$kode_brng || !$jumlah) {
            echo json_encode(['status' => 'error', 'message' => 'Data penghapusan tidak lengkap.']);
            return;
        }

        $deleted = $this->db
            ->where('kode_brng', $kode_brng)
            ->where('jml', $jumlah)
            ->delete('resep_dokter');

        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Resep berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus resep.']);
        }
    }

    public function deleteAllResep()
    {
        $no_resep = $this->input->post('no_resep');
        if (!$no_resep) {
            echo json_encode(['status' => 'error', 'message' => 'No Resep kosong.']);
            return;
        }

        $this->db->where('no_resep', $no_resep)->delete('resep_dokter');
        $this->db->where('no_resep', $no_resep)->delete('resep_obat');

        echo json_encode(['status' => 'success', 'message' => 'Semua resep dihapus.']);
    }
}

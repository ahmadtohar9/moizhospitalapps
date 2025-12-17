<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanResepRacikanRalanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PermintaanResepRacikanRalan_model');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        // Cek apakah user masih login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // arahkan langsung ke halaman login
        }
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        // Ambil nomor rekam medis berdasarkan no_rawat
        $pasien = $this->db->select('no_rkm_medis')
                           ->where('no_rawat', $no_rawat)
                           ->get('reg_periksa')
                           ->row();

        if (!$pasien) {
            show_error('Data pasien tidak ditemukan untuk No Rawat ini.', 400, 'Error');
            return;
        }

        $data['no_rawat']       = $no_rawat;
        $data['no_rkm_medis']   = $pasien->no_rkm_medis; // dikirim ke view
        $data['menus']          = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['action_menus']   = $this->MenuModel->get_active_action_menus();
        $data['list_obat']      = $this->PermintaanResepRacikanRalan_model->getObatList();

        $this->load->view('rekammedis/dokter/permintaanResepRacikanRalan', $data);
    }


   public function getObatList()
    {

          $data = $this->PermintaanResepRacikanRalan_model->getObatList();
        echo json_encode([
            'status' => !empty($data) ? 'success' : 'empty',
            'data' => $data
        ]);
    }

    public function getMetodeRacik()
    {
        log_message('info', 'Endpoint getMetodeRacik dipanggil.');

        $term = $this->input->post('term');
        log_message('info', 'Parameter term: ' . $term);

        $query = $this->db->like('nm_racik', $term)->get('metode_racik')->result_array();

        echo json_encode($query);
    }

    public function getSignaObat()
    {
        log_message('info', 'Endpoint getSignaObat dipanggil.');

        $term = $this->input->post('term');
        log_message('info', 'Parameter term: ' . $term);

        $query = $this->db->like('aturan', $term)->get('master_aturan_pakai')->result_array();
        log_message('info', 'Jumlah data ditemukan: ' . count($query));

        echo json_encode($query);
    }

    public function getRiwayatObatByNorm()
    {
        $no_rkm_medis = $this->input->get('no_rkm_medis');

        if (!$no_rkm_medis) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor Rekam Medis kosong.']);
            return;
        }

        $data = $this->PermintaanResepRacikanRalan_model->getRiwayatObatByNorm($no_rkm_medis);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }



    public function loadHasilRacikan() 
    {
        $no_rawat = $this->input->get('no_rawat');

        if (empty($no_rawat)) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor rawat tidak boleh kosong']);
            return;
        }

        $hasil_racikan = $this->PermintaanResepRacikanRalan_model->getHasilRacikan($no_rawat);

        if (!empty($hasil_racikan)) {
            echo json_encode(['status' => 'success', 'data' => $hasil_racikan]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data hasil racikan tidak ditemukan']);
        }
    }



    public function simpanRacikan() 
    {
        $no_resep = generate_no_resep();

        // Ambil data dari JSON payload
        $input = json_decode($this->input->raw_input_stream, true);

        $no_rawat = $input['no_rawat'] ?? null;
        $kd_dokter = $input['kd_dokter'] ?? null;
        $tgl_peresepan = $input['tgl_peresepan'] ?? date('Y-m-d');  // Default ke tanggal hari ini
        $jam_peresepan = $input['jam_peresepan'] ?? date('H:i:s');  // Default ke jam saat ini
        $obat_list = $input['obat'] ?? [];  // Data obat

        // Validasi jika `no_rawat` atau `kd_dokter` kosong
        if (empty($no_rawat) || empty($kd_dokter) || empty($obat_list)) {
            echo json_encode(['status' => 'error', 'message' => 'Data no_rawat, kd_dokter, atau obat tidak boleh kosong.']);
            return;
        }

        // Data untuk tabel `resep_obat`
        $data_resep_obat = [
            'no_resep' => $no_resep,
            'no_rawat' => $no_rawat,
            'kd_dokter' => $kd_dokter,
            'tgl_peresepan' => $tgl_peresepan,
            'jam_peresepan' => $jam_peresepan,
            'status' => 'ralan',
            'tgl_perawatan'  => '0000-00-00',
            'tgl_penyerahan' => '0000-00-00',
            'jam_penyerahan' => '00:00:00'
        ];

        $this->db->trans_start();  // Mulai transaksi

        // Insert ke tabel `resep_obat`
        $this->db->insert('resep_obat', $data_resep_obat);

        // Nomor racikan autoincrement manual
        $no_racik = 1;

        // Ambil informasi racikan dari input
        $nama_racikan = $input['nama_racikan'] ?? '';
        $kd_racik = $input['kd_racik'] ?? '';
        $keterangan = $input['keterangan'] ?? '';
        $jumlah_racikan = $input['jumlah_racikan'] ?? 1;  // Ambil nilai dari form

        foreach ($obat_list as $obat) {
            $kode_brng = $obat['kode_obat'];
            $jumlah_obat = $obat['jumlah'];
            $aturan_pakai = $input['signa'] ?? '3x1';  // Default aturan pakai jika tidak diisi

            // **Insert ke `resep_dokter_racikan`**
            $data_racikan = [
                'no_resep' => $no_resep,
                'no_racik' => $no_racik,
                'nama_racik' => $nama_racikan,
                'kd_racik' => $kd_racik,
                'jml_dr' => $jumlah_racikan,  // Menggunakan nilai jumlah racikan dari form
                'aturan_pakai' => $aturan_pakai,
                'keterangan' => $keterangan
            ];
            $this->db->insert('resep_dokter_racikan', $data_racikan);
            // **2. Insert ke `resep_dokter_racikan_detail`**
            $data_racikan_detail = [
                'no_resep' => $no_resep,
                'no_racik' => $no_racik,
                'kode_brng' => $kode_brng,
                'p1' => 1,  // Default p1 = 1
                'p2' => 1,  // Default p2 = 1
                'kandungan' => $obat['kandungan'],
                'jml' => $jumlah_obat
            ];
            $this->db->insert('resep_dokter_racikan_detail', $data_racikan_detail);

            $no_racik++;  // Increment nomor racikan
        }

        $this->db->trans_complete();  // Selesaikan transaksi

        // Cek apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data.']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan ke resep_obat, resep_dokter_racikan, dan resep_dokter_racikan_detail', 'no_resep' => $no_resep]);
        }
    }


    public function hapusObat()
    {
        $kode_brng = $this->input->post('kode_brng');
        $jumlah = $this->input->post('jumlah');

        if (!$kode_brng || !$jumlah) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap untuk penghapusan']);
            return;
        }

        // Hapus berdasarkan kode_brng dan jumlah dari tabel resep_dokter
        $this->db->where('kode_brng', $kode_brng);
        $this->db->where('jml', $jumlah);
        $delete = $this->db->delete('resep_dokter_racikan_detail');

        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Resep berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus resep']);
        }
    }


    public function hapusResep()
    {
        header('Content-Type: application/json');
        
        // Ambil data dari JSON POST
        $input = json_decode(file_get_contents('php://input'), true);
        $no_resep = $input['no_resep'] ?? null;

        if (!$no_resep) {
            echo json_encode(['status' => 'error', 'message' => 'No Resep tidak valid']);
            return;
        }

        // Hapus seluruh resep terkait no_resep
        $this->db->where('no_resep', $no_resep);
        $deleted = $this->db->delete('resep_obat');

        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Seluruh resep berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus seluruh resep']);
        }
    }



}

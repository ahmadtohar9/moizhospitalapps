<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegPeriksaController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pendaftaran/RegPeriksaModel');
        $this->load->model('MenuModel');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Registrasi Periksa Hari Ini'; // Khanza title
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        // Initial Data for No Rawat (Prediction)
        $data['no_rawat_next'] = $this->RegPeriksaModel->get_next_no_rawat();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pendaftaran/reg_periksa_index', $data);
        $this->load->view('templates/footer');
    }

    public function get_no_reg()
    {
        $kd_poli = $this->input->get('kd_poli');
        $kd_dokter = $this->input->get('kd_dokter');
        $tgl = date('Y-m-d');

        $no_reg = $this->RegPeriksaModel->get_next_no_reg($kd_poli, $kd_dokter, $tgl);
        echo json_encode(['no_reg' => $no_reg]);
    }

    public function get_no_rawat()
    {
        echo json_encode(['no_rawat' => $this->RegPeriksaModel->get_next_no_rawat()]);
    }

    public function search_dokter()
    {
        $q = $this->input->get('q');
        $data = $this->RegPeriksaModel->search_dokter($q);
        $res = [];
        foreach ($data as $row) {
            $res[] = ['id' => $row->kd_dokter, 'text' => $row->nm_dokter . ' (' . $row->kd_dokter . ')'];
        }
        echo json_encode(['results' => $res]);
    }

    public function search_poli()
    {
        $q = $this->input->get('q');
        $data = $this->RegPeriksaModel->search_poli($q);
        $res = [];
        foreach ($data as $row) {
            $res[] = ['id' => $row->kd_poli, 'text' => $row->nm_poli . ' (' . $row->kd_poli . ')'];
        }
        echo json_encode(['results' => $res]);
    }

    public function search_penjab()
    {
        $q = $this->input->get('q');
        $data = $this->RegPeriksaModel->search_penjab($q);
        $res = [];
        foreach ($data as $row) {
            $res[] = ['id' => $row->kd_pj, 'text' => $row->png_jawab];
        }
        echo json_encode(['results' => $res]);
    }

    public function search_pasien()
    {
        $q = $this->input->get('q');
        $data = $this->RegPeriksaModel->search_pasien($q);
        $res = [];
        foreach ($data as $row) {
            // Prepare complex text for display if needed, but select2 usually good with text.
            // We return extra data for filling fields
            $res[] = [
                'id' => $row->no_rkm_medis,
                'text' => $row->no_rkm_medis . ' - ' . $row->nm_pasien,
                'pasien' => $row // Pass full object
            ];
        }
        echo json_encode(['results' => $res]);
    }

    public function save()
    {
        // Validation check
        if (!$this->input->post('no_rkm_medis') || !$this->input->post('kd_poli') || !$this->input->post('kd_dokter')) {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap!']);
            return;
        }

        $this->db->trans_start(); // START TRANSACTION

        // Generate No Rawat & No Reg again to be safe (concurrency)
        // We do this INSIDE transaction to minimize race condition window, 
        // though without 'FOR UPDATE' it is still optimistic.
        $no_rawat = $this->RegPeriksaModel->get_next_no_rawat();
        $tgl_registrasi = $this->input->post('tgl_registrasi') ?: date('Y-m-d');


        $kd_poli = $this->input->post('kd_poli');
        $kd_dokter = $this->input->post('kd_dokter');
        $no_rkm_medis = $this->input->post('no_rkm_medis');

        // VALIDATION: Check duplicate registration if status_bayar is 'Belum Bayar'
        $cek_unpaid = $this->db->get_where('reg_periksa', [
            'no_rkm_medis' => $no_rkm_medis,
            'status_bayar' => 'Belum Bayar'
        ])->num_rows();

        if ($cek_unpaid > 0) {
            echo json_encode(['status' => false, 'message' => 'Pasien masih memiliki status "Belum Bayar". Lunasi tagihan sebelumnya untuk mendaftar kembali.']);
            return;
        }

        $stts_daftar = $this->input->post('stts_daftar'); // Lama/Baru

        // Fetch Biaya Reg from Poliklinik
        $poli = $this->db->get_where('poliklinik', ['kd_poli' => $kd_poli])->row();
        $biaya_reg = 0;
        if ($poli) {
            if ($stts_daftar == 'Baru') {
                $biaya_reg = $poli->registrasibaru;
            } else {
                $biaya_reg = $poli->registrasilama;
            }
        }

        $no_reg = $this->RegPeriksaModel->get_next_no_reg($kd_poli, $kd_dokter, $tgl_registrasi);

        $data = [
            'no_reg' => $no_reg,
            'no_rawat' => $no_rawat,
            'tgl_registrasi' => $tgl_registrasi,
            'jam_reg' => $this->input->post('jam_reg') ?: date('H:i:s'),
            'kd_dokter' => $kd_dokter,
            'no_rkm_medis' => $no_rkm_medis,
            'kd_poli' => $kd_poli,
            'p_jawab' => $this->input->post('p_jawab'),
            'almt_pj' => $this->input->post('almt_pj'),
            'hubunganpj' => $this->input->post('hubunganpj'),
            'biaya_reg' => $biaya_reg,
            'stts' => 'Belum', // Default status periksa
            'stts_daftar' => $stts_daftar,
            'status_lanjut' => 'Ralan',
            'kd_pj' => $this->input->post('kd_pj'), // Jenis Bayar
            'umurdaftar' => 0, // Should be calculated or fetched
            'sttsumur' => 'Th',
            'status_bayar' => 'Belum Bayar',
            'status_poli' => $stts_daftar // Usually matches stts_daftar
        ];

        // Calculate age for 'umurdaftar'
        $pasien = $this->db->get_where('pasien', ['no_rkm_medis' => $data['no_rkm_medis']])->row();
        if ($pasien) {
            $bday = new DateTime($pasien->tgl_lahir);
            $today = new DateTime($tgl_registrasi);
            $diff = $today->diff($bday);

            if ($diff->y > 0) {
                $data['umurdaftar'] = $diff->y;
                $data['sttsumur'] = 'Th';
            } elseif ($diff->m > 0) {
                $data['umurdaftar'] = $diff->m;
                $data['sttsumur'] = 'Bl';
            } else {
                $data['umurdaftar'] = $diff->d;
                $data['sttsumur'] = 'Hr';
            }
        }

        $this->RegPeriksaModel->save($data);

        $this->db->trans_complete(); // COMPLETE TRANSACTION

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => false, 'message' => 'Gagal menyimpan data (Transaksi Gagal/Rollback)']);
        } else {
            echo json_encode(['status' => true, 'message' => 'Registrasi Berhasil', 'no_rawat' => $no_rawat]);
        }
    }

    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        if (!$no_rawat) {
            // Fallback to URL segment if needed, or just error
            $no_rawat = urldecode($this->uri->segment(4));
        }

        if ($this->RegPeriksaModel->delete($no_rawat)) {
            echo json_encode(['status' => true, 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal menghapus data']);
        }
    }

    public function update_dokter()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kd_dokter = $this->input->post('kd_dokter_baru');
        if ($this->RegPeriksaModel->update_dokter($no_rawat, $kd_dokter)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal update dokter']);
        }
    }

    public function update_poli()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kd_poli = $this->input->post('kd_poli_baru');
        if ($this->RegPeriksaModel->update_poli($no_rawat, $kd_poli)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal update poli']);
        }
    }

    public function update_bayar()
    {
        $no_rawat = $this->input->post('no_rawat');
        $kd_pj = $this->input->post('kd_pj_baru');
        if ($this->RegPeriksaModel->update_bayar($no_rawat, $kd_pj)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal update jenis bayar']);
        }
    }

    public function cetak_antrian()
    {
        $no_rawat = $this->input->get('no_rawat');
        $data['setting'] = $this->db->get('setting')->row();
        $data['reg'] = $this->RegPeriksaModel->get_by_no_rawat($no_rawat);
        $this->load->view('pendaftaran/print_antrian_thermal', $data);
    }

    public function ajax_list()
    {
        $list = $this->RegPeriksaModel->get_datatables();

        // Get Stats
        $mulai = $this->input->post('filter_tgl_mulai') ?: date('Y-m-d');
        $akhir = $this->input->post('filter_tgl_akhir') ?: date('Y-m-d');
        $stats = $this->RegPeriksaModel->get_stats($mulai, $akhir);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $biaya = 'Rp ' . number_format($r->biaya_reg, 0, ',', '.');
            $status_bayar_badge = ($r->status_bayar == 'Sudah Bayar') ? '<span class="label label-success">Sudah Bayar</span>' : '<span class="label label-danger">Belum Bayar</span>';
            $no_sep_badge = empty($r->no_sep) ? '<span class="label label-danger">Belum SEP</span>' : '<span class="label label-success" style="cursor:pointer" onclick="pilihan_sep(\'' . $r->no_sep . '\')">' . $r->no_sep . '</span>';
            $mjkn_badge = !empty($r->mjkn_check) ? '<span class="label label-success">MJKN</span>' : '<span class="label label-primary">Onsite</span>';

            $birthDate = new DateTime($r->tgl_lahir);
            $regDate = new DateTime($r->tgl_registrasi);
            $ageDiff = $regDate->diff($birthDate);
            $umur_lengkap = $ageDiff->y . ' Th ' . $ageDiff->m . ' Bl ' . $ageDiff->d . ' Hr';

            // Columns
            $row[] = $no; // 1. No
            $row[] = $r->no_rawat; // 2. No Rawat
            $row[] = $r->tgl_registrasi . ' ' . $r->jam_reg; // 3. Tgl & Jam
            $row[] = '<strong>' . $r->nm_pasien . '</strong><br>RM: ' . $r->no_rkm_medis . '<br>NIK: ' . $r->no_ktp . '<br>Umur: ' . $umur_lengkap . '<br>' . $r->alamat; // 4. Pasien

            // Kan hanya 4 kolom awal yang saya ubah, sisanya sama
            // Kolom Dokter + Tombol Cetak Antrian
            $btn_print = '<br><a href="javascript:void(0)" class="btn btn-xs btn-primary" style="margin-top:5px;" onclick="cetak_antrian(\'' . $r->no_rawat . '\')"><i class="fa fa-print"></i> No. Antrian: ' . $r->no_reg . '</a>';
            $row[] = $r->nm_dokter . $btn_print;

            $row[] = $r->nm_poli . '<br><small>Stts Poli: ' . $r->status_poli . '</small>';
            $row[] = $r->png_jawab . '<br><small>Biaya: ' . $biaya . '</small><br>' . $status_bayar_badge;
            $row[] = '<span class="label label-success">' . $r->stts . '</span> <span class="label label-info">' . $r->stts_daftar . '</span><br>' . $mjkn_badge . '<br>' . $no_sep_badge;

            // Action Dropdown
            $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           Aksi <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                          <li><a href="javascript:void(0)" onclick="ganti_dokter(' . "'" . $r->no_rawat . "'" . ')"><i class="fa fa-user-md"></i> Ganti Dokter</a></li>
                          <li><a href="javascript:void(0)" onclick="ganti_poli(' . "'" . $r->no_rawat . "'" . ')"><i class="fa fa-hospital-o"></i> Ganti Poliklinik</a></li>
                          <li><a href="javascript:void(0)" onclick="ganti_bayar(' . "'" . $r->no_rawat . "'" . ')"><i class="fa fa-money"></i> Ganti Jenis Bayar</a></li>
                          <li class="divider"></li>';

            if (!empty($r->no_sep)) {
                $no_sep_clean = htmlspecialchars(trim($r->no_sep), ENT_QUOTES);
                $btn .= '<li><a href="javascript:void(0)" data-sep="' . $no_sep_clean . '" onclick="lihat_sep(this.getAttribute(\'data-sep\'))"><i class="fa fa-eye"></i> Lihat SEP</a></li>';
                $btn .= '<li><a href="javascript:void(0)" data-sep="' . $no_sep_clean . '" onclick="hapus_sep(this.getAttribute(\'data-sep\'))"><i class="fa fa-trash"></i> Hapus SEP</a></li>';
                $btn .= '<li class="divider"></li>';
            }

            $btn .= '<li><a href="javascript:void(0)" onclick="hapus_reg(' . "'" . $r->no_rawat . "'" . ')"><i class="fa fa-trash"></i> Hapus Registrasi</a></li>
                        </ul>
                    </div>';
            $row[] = $btn;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->RegPeriksaModel->count_all(),
            "recordsFiltered" => $this->RegPeriksaModel->count_filtered(),
            "data" => $data,
            "stats" => $stats // Custom data
        );
        echo json_encode($output);
    }
}

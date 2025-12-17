<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DokterRalanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PasienRajal_model');
        $this->load->model('SettingModel');
        $this->load->model('MenuModel');
        $this->load->model('DokterRalanModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // Paksa filter dokter (alias reg_periksa = r)
    private function _restrict_by_dokter($alias = 'r')
    {
        $role = (int) $this->session->userdata('role_id');
        $kd = $this->session->userdata('kd_dokter');

        if ($role === 3) { // dokter
            if (!$kd)
                show_error('Akun dokter tidak memiliki kd_dokter pada session.', 403);
            $this->db->where("$alias.kd_dokter", $kd);
        } else {
            // admin/role lain: boleh lihat semua; opsional ?kd_dokter=...
            $kd_q = $this->input->get('kd_dokter', true);
            if ($kd_q)
                $this->db->where("$alias.kd_dokter", $kd_q);
        }
    }

    // Cegah akses detail no_rawat yang bukan milik dokter login
    private function _assert_belongs_to_logged_in_doctor($no_rawat)
    {
        $role = (int) $this->session->userdata('role_id');
        if ($role !== 3)
            return; // hanya dokter yang dibatasi ini

        $kd = $this->session->userdata('kd_dokter');
        if (!$kd)
            show_error('Akun dokter tidak memiliki kd_dokter pada session.', 403);

        $ok = $this->db->select('no_rawat')->from('reg_periksa')
            ->where('no_rawat', $no_rawat)
            ->where('kd_dokter', $kd)
            ->limit(1)->get()->num_rows() > 0;
        if (!$ok)
            show_error('Anda tidak berhak mengakses data ini.', 403);
    }

    public function index()
    {
        $data['penjab_list'] = $this->PasienRajal_model->get_penjamin();
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['role_id'] = $this->session->userdata('role_id');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['title'] = 'Dokter Rawat Jalan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('dokter/dokter_ralan', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        return $this->index(); // alias ke halaman listing perawat
    }

    public function get_data()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $penjab = $this->input->get('penjab');         // kirim kd_pj ya
        $status_bayar = $this->input->get('status_bayar');
        $status_periksa = $this->input->get('status_periksa');

        // tempel filter dokter ke query model
        $this->db->start_cache();
        $this->_restrict_by_dokter('r'); // alias reg_periksa = r
        $this->db->stop_cache();

        $rows = $this->DokterRalanModel->get_pasien_rajal(
            $start_date,
            $end_date,
            $penjab,
            $status_bayar,
            $status_periksa
        );

        $this->db->flush_cache();

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($rows));
    }

    public function rekamMedis($tahun, $bulan, $tanggal, $no_rawat)
    {
        $full = "$tahun/$bulan/$tanggal/$no_rawat";

        // Get user role
        $role = (int) $this->session->userdata('role_id');

        // If user is a doctor (role 3), ensure they can only access their own patients
        if ($role === 3) {
            $this->_assert_belongs_to_logged_in_doctor($full);
        }

        // All logged-in users can access (access controlled by menu permissions)
        // Set no_rawat to session for use in rekam medis container
        $this->session->set_userdata('no_rawat', $full);

        // Redirect to rekam medis page
        redirect(site_url("rekam-medis/{$tahun}/{$bulan}/{$tanggal}/{$no_rawat}/dokter"));
    }



}

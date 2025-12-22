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

    /**
     * Update status periksa pasien (AJAX endpoint)
     * Only accessible by perawat (role 2) and admin (role 1)
     */
    public function update_status()
    {
        // Check if request is AJAX
        if (!$this->input->is_ajax_request()) {
            show_error('Direct access not allowed', 403);
        }

        // Get current user role
        $role_id = (int) $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');

        // Only perawat (2) and admin (1) can update status
        if (!in_array($role_id, [1, 2])) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengubah status.'
                ]));
            return;
        }

        // Get POST data
        $no_rawat = $this->input->post('no_rawat', true);
        $new_status = $this->input->post('new_status', true);

        // Validate input
        if (empty($no_rawat) || empty($new_status)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Data tidak lengkap.'
                ]));
            return;
        }

        // Validate status value
        $valid_statuses = ['Belum', 'Sudah', 'Batal', 'Berkas Diterima', 'Dirujuk', 'Meninggal', 'Dirawat', 'Pulang Paksa'];
        if (!in_array($new_status, $valid_statuses)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Status tidak valid.'
                ]));
            return;
        }

        // Get old status for logging
        $old_data = $this->db->select('stts')->from('reg_periksa')->where('no_rawat', $no_rawat)->get()->row_array();

        if (!$old_data) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Data pasien tidak ditemukan.'
                ]));
            return;
        }

        $old_status = $old_data['stts'];

        // Update status
        $this->db->where('no_rawat', $no_rawat);
        $updated = $this->db->update('reg_periksa', ['stts' => $new_status]);

        if ($updated) {
            // Log the change (optional - create log table if needed)
            // $this->db->insert('status_change_log', [
            //     'no_rawat' => $no_rawat,
            //     'old_status' => $old_status,
            //     'new_status' => $new_status,
            //     'changed_by' => $user_id,
            //     'changed_at' => date('Y-m-d H:i:s')
            // ]);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'message' => "Status berhasil diubah dari '{$old_status}' ke '{$new_status}'.",
                    'new_status' => $new_status
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Gagal mengubah status.'
                ]));
        }
    }


}

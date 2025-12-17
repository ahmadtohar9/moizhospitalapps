<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftaran/PasienModel');
        $this->load->model('MenuModel');
        if (!$this->session->userdata('logged_in')) { // Standard auth check
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Pasien';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        // Pass reference data for modal
        $data['agama'] = $this->PasienModel->get_agama();
        $data['stts_nikah'] = $this->PasienModel->get_stts_nikah();
        $data['gol_darah'] = $this->PasienModel->get_gol_darah();
        $data['pekerjaan'] = $this->PasienModel->get_pekerjaan();
        $data['penjab'] = $this->PasienModel->get_penjab();
        $data['suku_bangsa'] = $this->PasienModel->get_suku_bangsa();
        $data['bahasa_pasien'] = $this->PasienModel->get_bahasa();
        $data['cacat_fisik'] = $this->PasienModel->get_cacat();
        $data['perusahaan_pasien'] = $this->PasienModel->get_perusahaan();
        $data['pendidikan'] = $this->PasienModel->get_pendidkan();
        $data['keluarga'] = $this->PasienModel->get_keluarga();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pendaftaran/pasien_index', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_list()
    {
        $list = $this->PasienModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pasien) {
            $no++;
            $row = array();
            $row[] = '<span class="label label-primary">' . $pasien->no_rkm_medis . '</span>';
            $row[] = '<strong>' . $pasien->nm_pasien . '</strong><br><small class="text-muted">' . $pasien->no_ktp . '</small>';
            $row[] = $pasien->jk;
            $row[] = $pasien->tmp_lahir . ', ' . date('d M Y', strtotime($pasien->tgl_lahir));
            $row[] = $pasien->alamat;
            $row[] = $pasien->no_tlp;

            // Actions
            $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Detail" onclick="view_pasien(' . "'" . $pasien->no_rkm_medis . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pasien(' . "'" . $pasien->no_rkm_medis . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pasien(' . "'" . $pasien->no_rkm_medis . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->PasienModel->count_all(),
            "recordsFiltered" => $this->PasienModel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->PasienModel->get_by_id($id);
        $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir;
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'no_rkm_medis' => $this->input->post('no_rkm_medis'),
            'nm_pasien' => $this->input->post('nm_pasien'),
            'no_ktp' => $this->input->post('no_ktp'),
            'jk' => $this->input->post('jk'),
            'tmp_lahir' => $this->input->post('tmp_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'nm_ibu' => $this->input->post('nm_ibu'),
            'alamat' => $this->input->post('alamat'),
            'gol_darah' => $this->input->post('gol_darah'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'stts_nikah' => $this->input->post('stts_nikah'),
            'agama' => $this->input->post('agama'),
            'tgl_daftar' => date('Y-m-d'),
            'no_tlp' => $this->input->post('no_tlp'),
            'umur' => $this->input->post('umur'), // Use posted age string directly if available, or calc
            'pnd' => $this->input->post('pnd'),
            'keluarga' => $this->input->post('keluarga'),
            'namakeluarga' => $this->input->post('namakeluarga'),
            'kd_pj' => $this->input->post('kd_pj'),
            'no_peserta' => $this->input->post('no_peserta'),
            'kd_kel' => $this->input->post('kd_kel'),
            'kd_kec' => $this->input->post('kd_kec'),
            'kd_kab' => $this->input->post('kd_kab'),
            'kd_prop' => $this->input->post('kd_prop'),
            'pekerjaanpj' => $this->input->post('pekerjaanpj'),
            'alamatpj' => $this->input->post('alamatpj'),
            'kelurahanpj' => $this->input->post('kelurahanpj'),
            'kecamatanpj' => $this->input->post('kecamatanpj'),
            'kabupatenpj' => $this->input->post('kabupatenpj'),
            'propinsipj' => $this->input->post('propinsipj'),
            'perusahaan_pasien' => $this->input->post('perusahaan_pasien'),
            'suku_bangsa' => $this->input->post('suku_bangsa'),
            'bahasa_pasien' => $this->input->post('bahasa_pasien'),
            'cacat_fisik' => $this->input->post('cacat_fisik'),
            'email' => $this->input->post('email'),
            'nip' => $this->input->post('nip'),
        );

        if (empty($data['no_rkm_medis']) || $data['no_rkm_medis'] == 'AUTO') {
            $data['no_rkm_medis'] = $this->PasienModel->generate_no_rkm_medis(true);
        }

        $insert = $this->PasienModel->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nm_pasien' => $this->input->post('nm_pasien'),
            'no_ktp' => $this->input->post('no_ktp'),
            'jk' => $this->input->post('jk'),
            'tmp_lahir' => $this->input->post('tmp_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'nm_ibu' => $this->input->post('nm_ibu'),
            'alamat' => $this->input->post('alamat'),
            'gol_darah' => $this->input->post('gol_darah'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'stts_nikah' => $this->input->post('stts_nikah'),
            'agama' => $this->input->post('agama'),
            'no_tlp' => $this->input->post('no_tlp'),
            'umur' => $this->input->post('umur'),
            'pnd' => $this->input->post('pnd'),
            'keluarga' => $this->input->post('keluarga'),
            'namakeluarga' => $this->input->post('namakeluarga'),
            'kd_pj' => $this->input->post('kd_pj'),
            'no_peserta' => $this->input->post('no_peserta'),
            'kd_kel' => $this->input->post('kd_kel'),
            'kd_kec' => $this->input->post('kd_kec'),
            'kd_kab' => $this->input->post('kd_kab'),
            'kd_prop' => $this->input->post('kd_prop'),
            'pekerjaanpj' => $this->input->post('pekerjaanpj'),
            'alamatpj' => $this->input->post('alamatpj'),
            'kelurahanpj' => $this->input->post('kelurahanpj'),
            'kecamatanpj' => $this->input->post('kecamatanpj'),
            'kabupatenpj' => $this->input->post('kabupatenpj'),
            'propinsipj' => $this->input->post('propinsipj'),
            'perusahaan_pasien' => $this->input->post('perusahaan_pasien'),
            'suku_bangsa' => $this->input->post('suku_bangsa'),
            'bahasa_pasien' => $this->input->post('bahasa_pasien'),
            'cacat_fisik' => $this->input->post('cacat_fisik'),
            'email' => $this->input->post('email'),
            'nip' => $this->input->post('nip'),
        );

        $this->PasienModel->update(array('no_rkm_medis' => $this->input->post('no_rkm_medis')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->PasienModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function get_new_rm()
    {
        echo json_encode(['no_rkm_medis' => $this->PasienModel->generate_no_rkm_medis()]);
    }

    // Helper to calculate simple age string (e.g. "25 Th")
    private function calculate_age($birthDate)
    {
        if (empty($birthDate) || $birthDate == '0000-00-00')
            return '0 Th';
        $birthDate = new DateTime($birthDate);
        $today = new DateTime("today");
        $y = $today->diff($birthDate)->y;
        return $y . " Th";
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nm_pasien') == '') {
            $data['inputerror'][] = 'nm_pasien';
            $data['error_string'][] = 'Nama Pasien wajib diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tgl_lahir') == '') {
            $data['inputerror'][] = 'tgl_lahir';
            $data['error_string'][] = 'Tanggal Lahir wajib diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jk') == '') {
            $data['inputerror'][] = 'jk';
            $data['error_string'][] = 'Jenis Kelamin wajib dipilih';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function cek_bpjs_nik()
    {
        $nik = $this->input->post('nik');
        if (!$nik) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'NIK Kosong']]);
            return;
        }
        $this->load->library('Bpjs/Vclaim');
        $result = $this->vclaim->peserta_nik($nik);
        echo json_encode($result);
    }

    public function cek_bpjs_kartu()
    {
        $no_kartu = $this->input->post('no_peserta');
        if (!$no_kartu) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'No Kartu Kosong']]);
            return;
        }
        $this->load->library('Bpjs/Vclaim');
        $result = $this->vclaim->peserta_nokartu($no_kartu);
        echo json_encode($result);
    }

    public function search_wilayah()
    {
        $q = $this->input->get('q');
        $type = $this->input->get('type'); // kel, kec, kab, prop

        $table = '';
        $key = '';
        $val = '';
        if ($type == 'kel') {
            $table = 'kelurahan';
            $key = 'kd_kel';
            $val = 'nm_kel';
        } elseif ($type == 'kec') {
            $table = 'kecamatan';
            $key = 'kd_kec';
            $val = 'nm_kec';
        } elseif ($type == 'kab') {
            $table = 'kabupaten';
            $key = 'kd_kab';
            $val = 'nm_kab';
        } elseif ($type == 'prop') {
            $table = 'propinsi';
            $key = 'kd_prop';
            $val = 'nm_prop';
        }

        if ($table) {
            $data = $this->PasienModel->search_wilayah($table, $q, $key, $val);
            // Format for Select2
            $res = [];
            foreach ($data as $row) {
                $res[] = ['id' => $row->$key, 'text' => $row->$val];
            }
            echo json_encode(['results' => $res]);
        }
    }
}

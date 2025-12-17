<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedisOrthopediController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AwalMedisOrthopediModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $nr_get = $this->input->get('nr', true);
        $nr_compat = $this->input->get('no_rawat', true);
        $no_rawat = $nr_get ?: $nr_compat ?: $this->session->userdata('no_rawat');

        if (!$no_rawat) {
            redirect('RekamMedisRalanController');
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);
        $role_id = $this->session->userdata('role_id');

        // Prepare Data
        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        // Fallback for cleaned No Rawat
        if (!$data['detail_pasien']) {
            $clean = str_replace('/', '', $no_rawat);
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($clean);
            if ($data['detail_pasien'])
                $data['no_rawat'] = $clean;
        }

        $data['kd_dokter'] = ($role_id == 1)
            ? ($data['detail_pasien']['kd_dokter'] ?? '-')
            : $this->session->userdata('user_nip');

        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i:s');

        // Load Assessment
        $data['asesment'] = $this->AwalMedisOrthopediModel->get_by_no_rawat($data['no_rawat']);

        // Jika dipanggil via AJAX untuk dimuat didalam tabs, kita load view tanpa header/footer
        $this->load->view('rekammedis/dokter/awalMedisOrthopedi_view', $data);
    }

    public function save()
    {
        $this->output->set_content_type('application/json');
        $post = $this->input->post();

        if (empty($post['no_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak valid.']);
            return;
        }

        try {
            // 1. Handle Tanggal & Jam -> Tanggal (Datetime)
            $tgl = $post['tanggal'] ?? date('Y-m-d');
            $jam = $post['jam'] ?? date('H:i:s');

            // Format DD-MM-YYYY correction
            if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $tgl, $m)) {
                $tgl = $m[3] . '-' . $m[2] . '-' . $m[1];
            }
            $post['tanggal'] = "$tgl $jam";
            unset($post['jam']); // Remove auxiliary field

            // 2. Handle Image Upload (Canvas Base64)
            if (!empty($post['lokalis_image'])) {
                $img = $post['lokalis_image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                if ($data) {
                    $dir = FCPATH . 'assets/images/lokalis_orthopedi/';
                    if (!is_dir($dir))
                        mkdir($dir, 0777, true);

                    $filename = 'lokalis_' . str_replace('/', '', $post['no_rawat']) . '.png';
                    file_put_contents($dir . $filename, $data);
                }
            }
            unset($post['lokalis_image']); // Don't insert into DB

            // 3. Save to DB
            if ($this->AwalMedisOrthopediModel->exists($post['no_rawat'])) {
                $this->AwalMedisOrthopediModel->update($post['no_rawat'], $post);
            } else {
                $this->AwalMedisOrthopediModel->insert($post);
            }

            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function delete()
    {
        $this->output->set_content_type('application/json');
        $no_rawat = $this->input->post('no_rawat');

        // Delete Image
        $clean = str_replace('/', '', $no_rawat);
        $path = FCPATH . 'assets/images/lokalis_orthopedi/lokalis_' . $clean . '.png';
        if (file_exists($path))
            unlink($path);

        if ($this->AwalMedisOrthopediModel->delete($no_rawat)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function print_pdf()
    {
        $no_rawat = $this->input->get('no_rawat');
        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        require_once APPPATH . '../vendor/autoload.php';

        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        if (!$data['detail_pasien']) {
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', $no_rawat));
        }

        $data['asesment'] = $this->AwalMedisOrthopediModel->get_by_no_rawat($no_rawat);

        // Image Lokalis
        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $lokalis_path = FCPATH . 'assets/images/lokalis_orthopedi/lokalis_' . $clean_no_rawat . '.png';
        if (file_exists($lokalis_path)) {
            $data['lokalis_path'] = $lokalis_path;
        } else {
            // Use default blank anatomy if no drawing saved? Or just empty.
            // Better empty or original base image if needed, but drawing is better.
            $data['lokalis_path'] = FCPATH . 'assets/images/human_body_anatomy_orthopedi.png';
        }

        $this->load->model('SettingModel');
        $data['setting'] = $this->SettingModel->get_setting();

        $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_orthopedi', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Asesmen_Orthopedi_' . $clean_no_rawat . '.pdf', 'I');
    }
}

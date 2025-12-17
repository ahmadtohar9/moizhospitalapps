<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedisIGDController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AwalMedisIGDModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');
        $this->load->model('SettingModel');

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
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);

        $role_id = $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');

        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        if (!$data['detail_pasien']) {
            $no_rawat_clean = str_replace('/', '', $no_rawat);
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat_clean);
            if ($data['detail_pasien']) {
                $data['no_rawat'] = $no_rawat_clean;
                $this->session->set_userdata('no_rawat', $no_rawat_clean);
            }
        }

        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan.', 404, 'Error');
            return;
        }

        $data['no_rkm_medis'] = $data['detail_pasien']['no_rkm_medis'];
        $data['kd_dokter'] = ($role_id == 1)
            ? ($data['detail_pasien']['kd_dokter'] ?? null)
            : $this->session->userdata('user_nip');

        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i:s');

        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        // Load existing data if any
        $data['asesmen'] = $this->AwalMedisIGDModel->get_by_no_rawat($data['no_rawat']);

        $this->load->view('rekammedis/dokter/awalMedisIGD_view', $data);
    }

    public function save()
    {
        $this->output->set_content_type('application/json');
        $post = $this->input->post();

        // DEBUG: Write to a test file to verify path and permissions
        $bg_dir = FCPATH . 'assets/images/lokalis_igd/';
        if (!is_dir($bg_dir))
            @mkdir($bg_dir, 0777, true);
        file_put_contents($bg_dir . 'debug_access.txt', date('Y-m-d H:i:s') . " - Access Check. Post Keys: " . implode(', ', array_keys($post)));

        if (!$post) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dikirim.']);
            return;
        }

        // Required
        if (empty($post['no_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat wajib diisi.']);
            return;
        }

        try {
            // Basic preparation
            $role_id = $this->session->userdata('role_id');
            if ($role_id !== 1) {
                $post['kd_dokter'] = $this->session->userdata('user_nip');
            }

            // FIX: Combine tanggal & jam -> tanggal (datetime)
            // FIX: Combine tanggal & jam -> tanggal (datetime)
            if (isset($post['tanggal']) && isset($post['jam'])) {
                // If format is DD-MM-YYYY, convert to YYYY-MM-DD
                if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $post['tanggal'], $matches)) {
                    $post['tanggal'] = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
                }
                $post['tanggal'] = $post['tanggal'] . ' ' . $post['jam'];
                unset($post['jam']);
            }

            // FIX: Map fields to DB columns
            if (isset($post['spo2'])) {
                $post['spo'] = $post['spo2'];
                unset($post['spo2']);
            }
            if (isset($post['tata_laksana'])) {
                $post['tata'] = $post['tata_laksana'];
                unset($post['tata_laksana']);
            }

            // Handle Image Lokalis (Canvas)
            if (!empty($post['lokalis_image'])) {
                file_put_contents($bg_dir . 'debug_access.txt', "\nImage Block Entered.", FILE_APPEND);

                $img = $post['lokalis_image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                file_put_contents($bg_dir . 'debug_access.txt', "\nDecoded Size: " . strlen($data), FILE_APPEND);

                if ($data === false) {
                    log_message('error', 'Base64 decode failed');
                    file_put_contents($bg_dir . 'debug_access.txt', "\nBase64 Decode Failed", FILE_APPEND);
                } else {
                    $dir = FCPATH . 'assets/images/lokalis_igd/';
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    $filename = 'lokalis_' . str_replace('/', '', $post['no_rawat']) . '.png';
                    $full_path = $dir . $filename;

                    file_put_contents($bg_dir . 'debug_access.txt', "\nAttempting write to: " . $full_path, FILE_APPEND);

                    $bytes = file_put_contents($full_path, $data);

                    if ($bytes === false) {
                        file_put_contents($bg_dir . 'debug_access.txt', "\nWrite Failed!", FILE_APPEND);
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan file gambar lokalis.']);
                        return;
                    } else {
                        file_put_contents($bg_dir . 'debug_access.txt', "\nWrite Success. Bytes: " . $bytes, FILE_APPEND);
                    }
                }
            } else {
                file_put_contents($bg_dir . 'debug_access.txt', "\nLokalis Image is EMPTY or NOT SET in IF check.", FILE_APPEND);
            }
            unset($post['lokalis_image']); // Don't try to insert this big string or non-column

            // Check exists
            if ($this->AwalMedisIGDModel->exists($post['no_rawat'])) {
                // Update
                if ($this->AwalMedisIGDModel->update($post['no_rawat'], $post)) {
                    echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data.']);
                }
            } else {
                // Insert
                if ($this->AwalMedisIGDModel->insert($post)) {
                    echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
                } else {
                    // Check DB Error
                    $error = $this->db->error();
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan: ' . $error['message']]);
                }
            }

        } catch (Exception $e) {
            log_message('error', 'Save Error IGD: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    public function delete()
    {
        $this->output->set_content_type('application/json');
        $no_rawat = $this->input->post('no_rawat');

        // Delete Image File
        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $file_path = FCPATH . 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if ($this->AwalMedisIGDModel->delete($no_rawat)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus']);
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
        if (!$data['detail_pasien'])
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', $no_rawat));

        $data['asesment'] = $this->AwalMedisIGDModel->get_by_no_rawat($no_rawat);
        $data['setting'] = $this->SettingModel->get_setting();

        // Load Lokalis Image if exists
        $clean_no_rawat = str_replace('/', '', $no_rawat);
        $lokalis_path = FCPATH . 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
        clearstatcache();

        if (file_exists($lokalis_path)) {
            // Pass absolute path for mPDF (better than base64)
            $data['lokalis_path'] = $lokalis_path;
            log_message('error', 'PDF Print: Image found at ' . $lokalis_path);
        } else {
            $data['lokalis_path'] = '';
            log_message('error', 'PDF Print: Image NOT found at ' . $lokalis_path);
        }

        $html = $this->load->view('rekammedis/dokter/pdf_awal_medis_igd', $data, true);

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'margin_top' => 10, 'margin_bottom' => 10, 'margin_left' => 10, 'margin_right' => 10]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Asesmen_IGD_' . $clean_no_rawat . '.pdf', 'I');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplaySettingsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DisplaySettings_model');
        $this->load->library(['upload', 'form_validation', 'session']);
        $this->load->helper(['url', 'form']);

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    /**
     * Main page - Pengaturan Display
     */
    public function index()
    {
        $data['title'] = 'Pengaturan Display Antrian';
        $data['global_settings'] = $this->DisplaySettings_model->get_all_global_settings();
        $data['dokter_settings'] = $this->DisplaySettings_model->get_all_dokter_settings();
        $data['all_dokter'] = $this->DisplaySettings_model->get_all_dokter();

        // Load menu for sidebar
        $data['nama_user'] = $this->session->userdata('nama_user');
        $this->load->model('MenuModel');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('antrian/pengaturan_display', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Update global settings (YouTube, theme, etc)
     */
    public function update_global_settings()
    {
        $this->form_validation->set_rules('youtube_url', 'YouTube URL', 'trim');
        $this->form_validation->set_rules('hospital_name', 'Nama Rumah Sakit', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('antrian/pengaturanDisplayPoli');
        }

        $settings = [
            'youtube_url' => $this->input->post('youtube_url'),
            'show_video' => $this->input->post('show_video') ? 'Ya' : 'Tidak',
            'video_title' => $this->input->post('video_title'),
            'hospital_name' => $this->input->post('hospital_name'),
            'theme_color' => $this->input->post('theme_color'),
            'auto_refresh_interval' => $this->input->post('auto_refresh_interval'),
            'carousel_interval' => $this->input->post('carousel_interval'),
            'scroll_duration' => $this->input->post('scroll_duration'),
            'max_patients_display' => $this->input->post('max_patients_display'),
            'show_ticker' => $this->input->post('show_ticker') ? 'Ya' : 'Tidak',
            'tts_enabled' => $this->input->post('tts_enabled') ? 'Ya' : 'Tidak',
            'tts_rate' => $this->input->post('tts_rate')
        ];

        $result = $this->DisplaySettings_model->update_global_settings($settings);

        if ($result) {
            $this->session->set_flashdata('success', 'Pengaturan global berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal update pengaturan global!');
        }

        redirect('antrian/pengaturanDisplayPoli');
    }

    /**
     * Upload foto dokter
     */
    public function upload_foto_dokter()
    {
        $kd_dokter = $this->input->post('kd_dokter');

        if (empty($kd_dokter)) {
            echo json_encode(['success' => false, 'message' => 'Kode dokter tidak boleh kosong']);
            return;
        }

        $upload_path = FCPATH . 'uploads/dokter_photos/';

        // Create directory if not exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Check if writable
        if (!is_writable($upload_path)) {
            chmod($upload_path, 0777);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'dokter_' . $kd_dokter . '_' . time();
        $config['overwrite'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            echo json_encode([
                'success' => false,
                'message' => $this->upload->display_errors('', '')
            ]);
            return;
        }

        $upload_data = $this->upload->data();
        $foto_path = 'uploads/dokter_photos/' . $upload_data['file_name'];

        // Resize image to 200x200
        $this->load->library('image_lib');
        $resize_config['image_library'] = 'gd2';
        $resize_config['source_image'] = $upload_data['full_path'];
        $resize_config['maintain_ratio'] = TRUE;
        $resize_config['width'] = 200;
        $resize_config['height'] = 200;

        $this->image_lib->initialize($resize_config);
        $this->image_lib->resize();

        // Save to database
        $result = $this->DisplaySettings_model->update_dokter_foto($kd_dokter, $foto_path);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Foto berhasil diupload!',
                'foto_path' => base_url($foto_path)
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyimpan ke database'
            ]);
        }
    }

    /**
     * Toggle show/hide dokter in display
     */
    public function toggle_dokter_display()
    {
        $kd_dokter = $this->input->post('kd_dokter');
        $show_in_display = $this->input->post('show_in_display') === 'true' ? 'Ya' : 'Tidak';

        $result = $this->DisplaySettings_model->toggle_dokter_display($kd_dokter, $show_in_display);

        echo json_encode(['success' => $result]);
    }

    /**
     * Delete foto dokter
     */
    public function delete_foto_dokter()
    {
        $kd_dokter = $this->input->post('kd_dokter');

        $dokter_setting = $this->DisplaySettings_model->get_dokter_setting($kd_dokter);

        if ($dokter_setting && $dokter_setting['foto_path']) {
            // Delete file
            if (file_exists($dokter_setting['foto_path'])) {
                unlink($dokter_setting['foto_path']);
            }

            // Update database
            $result = $this->DisplaySettings_model->update_dokter_foto($kd_dokter, null);

            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Foto tidak ditemukan']);
        }
    }

    /**
     * Get setting value by key (AJAX)
     */
    public function get_setting($key)
    {
        $value = $this->DisplaySettings_model->get_setting_value($key);
        echo json_encode(['value' => $value]);
    }
}

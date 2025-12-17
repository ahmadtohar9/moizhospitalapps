<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * System Update Controller
 * 
 * Controller untuk handle system auto-update
 * 
 * @package    Moiz Hospital Apps
 * @subpackage Controllers
 * @category   System
 * @author     Ahmad Tohar
 */
class SystemUpdate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Cek role admin (support role_id atau role)
        $role_id = $this->session->userdata('role_id');
        $role = $this->session->userdata('role');

        // Allow jika role_id = 1 (admin) atau role = admin/superadmin
        $is_admin = ($role_id == 1) || ($role === 'admin') || ($role === 'superadmin');

        if (!$is_admin) {
            show_error('Anda tidak memiliki akses ke halaman ini. Hanya admin yang dapat mengakses System Update.', 403);
        }

        $this->load->library('GitUpdater');
        $this->load->library('DatabaseMigration');
    }

    /**
     * Halaman utama system update
     */
    public function index()
    {
        // Load menu data untuk sidebar
        $this->load->model('MenuModel');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));
        $data['nama_user'] = $this->session->userdata('nama');

        $data['title'] = 'System Update';
        $data['content'] = 'admin/system_update/index';

        // Get current version info
        $version_file = FCPATH . 'version.json';
        if (file_exists($version_file)) {
            $version_data = json_decode(file_get_contents($version_file), true);
            $data['current_version'] = $version_data['version'];
            $data['release_date'] = $version_data['release_date'];
            $data['build'] = $version_data['build'];
        } else {
            $data['current_version'] = 'Unknown';
            $data['release_date'] = '-';
            $data['build'] = '-';
        }

        // Get migration info
        $migration_info = $this->databasemigration->get_migration_info();
        $data['pending_migrations'] = $migration_info['pending_count'];
        $data['executed_migrations'] = $migration_info['executed_count'];

        // Get update history
        $data['update_history'] = $this->gitupdater->get_update_history();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view($data['content'], $data);
        $this->load->view('templates/footer');
    }

    /**
     * Check update via AJAX
     */
    public function check_update()
    {
        $result = $this->gitupdater->check_update();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Run update via AJAX
     */
    public function run_update()
    {
        // Set time limit untuk update
        set_time_limit(300); // 5 menit

        $result = $this->gitupdater->run_update();

        // Save update history
        if ($result['status'] === 'success') {
            $this->gitupdater->save_update_history([
                'from_version' => $this->session->userdata('update_from_version'),
                'to_version' => $this->session->userdata('update_to_version'),
                'status' => 'success'
            ]);
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Get changelog
     */
    public function get_changelog()
    {
        $changelog_file = FCPATH . 'CHANGELOG.md';

        if (!file_exists($changelog_file)) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Changelog tidak ditemukan'
            ]);
            return;
        }

        $changelog = file_get_contents($changelog_file);

        // Parse markdown ke HTML (simple)
        $this->load->helper('text');
        $changelog_html = nl2br(htmlspecialchars($changelog));

        // Simple markdown parsing
        $changelog_html = preg_replace('/^## (.+)$/m', '<h3>$1</h3>', $changelog_html);
        $changelog_html = preg_replace('/^### (.+)$/m', '<h4>$1</h4>', $changelog_html);
        $changelog_html = preg_replace('/^- (.+)$/m', '<li>$1</li>', $changelog_html);
        $changelog_html = preg_replace('/\*\*(.+?)\*\*/m', '<strong>$1</strong>', $changelog_html);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'changelog' => $changelog_html
        ]);
    }

    /**
     * Get migration list
     */
    public function get_migrations()
    {
        $migration_info = $this->databasemigration->get_migration_info();

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $migration_info
        ]);
    }

    /**
     * Run migrations manually
     */
    public function run_migrations()
    {
        $result = $this->databasemigration->run_pending_migrations();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Get update history
     */
    public function get_update_history()
    {
        $history = $this->gitupdater->get_update_history();

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $history
        ]);
    }

    /**
     * Get system info
     */
    public function get_system_info()
    {
        $info = [
            'php_version' => phpversion(),
            'ci_version' => CI_VERSION,
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'git_available' => !empty(shell_exec('which git 2>&1')),
            'git_version' => trim(shell_exec('git --version 2>&1')),
            'writable_dirs' => [
                'application/logs' => is_writable(APPPATH . 'logs'),
                'application/cache' => is_writable(APPPATH . 'cache'),
                'application/sessions' => is_writable(APPPATH . 'sessions'),
                'database/backups' => is_writable(FCPATH . 'database/backups'),
                'database/migrations' => is_writable(FCPATH . 'database/migrations')
            ],
            'disk_free_space' => disk_free_space(FCPATH),
            'disk_total_space' => disk_total_space(FCPATH)
        ];

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $info
        ]);
    }
}

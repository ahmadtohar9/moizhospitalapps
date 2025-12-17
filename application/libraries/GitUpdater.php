<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Git Updater Library
 * 
 * Library untuk handle auto-update dari GitHub repository
 * 
 * @package    Moiz Hospital Apps
 * @subpackage Libraries
 * @category   System
 * @author     Ahmad Tohar
 */
class GitUpdater
{
    protected $CI;
    protected $github_repo;
    protected $github_branch;
    protected $current_version;
    protected $backup_path;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('file');

        // Load version config
        $version_file = FCPATH . 'version.json';
        if (file_exists($version_file)) {
            $version_data = json_decode(file_get_contents($version_file), true);
            $this->github_repo = $version_data['github_repo'] ?? 'ahmadtohar9/moizhospitalapps';
            $this->github_branch = $version_data['github_branch'] ?? 'main';
            $this->current_version = $version_data['version'] ?? '1.0.0';
        }

        $this->backup_path = FCPATH . 'database/backups/';

        // Buat folder backup jika belum ada
        if (!is_dir($this->backup_path)) {
            mkdir($this->backup_path, 0755, true);
        }
    }

    /**
     * Cek apakah ada update tersedia
     * 
     * @return array
     */
    public function check_update()
    {
        try {
            // Cek versi terbaru dari GitHub
            $latest_version = $this->get_latest_version_from_github();

            if (!$latest_version) {
                return [
                    'status' => 'error',
                    'message' => 'Tidak dapat mengecek update. Pastikan koneksi internet aktif.'
                ];
            }

            $has_update = version_compare($latest_version, $this->current_version, '>');

            return [
                'status' => 'success',
                'has_update' => $has_update,
                'current_version' => $this->current_version,
                'latest_version' => $latest_version,
                'changelog' => $has_update ? $this->get_changelog() : null
            ];

        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get latest version dari GitHub API
     * 
     * @return string|false
     */
    private function get_latest_version_from_github()
    {
        // Cek dari GitHub API (rate limit: 60 requests/hour tanpa auth)
        $api_url = "https://api.github.com/repos/{$this->github_repo}/contents/version.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Moiz-Hospital-Apps');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code !== 200) {
            return false;
        }

        $data = json_decode($response, true);

        if (!isset($data['content'])) {
            return false;
        }

        // Decode base64 content
        $version_json = base64_decode($data['content']);
        $version_data = json_decode($version_json, true);

        return $version_data['version'] ?? false;
    }

    /**
     * Get changelog dari GitHub
     * 
     * @return string
     */
    private function get_changelog()
    {
        $changelog_url = "https://raw.githubusercontent.com/{$this->github_repo}/{$this->github_branch}/CHANGELOG.md";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $changelog_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $changelog = curl_exec($ch);
        curl_close($ch);

        return $changelog ?: 'Changelog tidak tersedia.';
    }

    /**
     * Jalankan update
     * 
     * @return array
     */
    public function run_update()
    {
        try {
            $steps = [];

            // Step 1: Backup database
            $steps[] = ['step' => 'backup_database', 'status' => 'running'];
            $backup_result = $this->backup_database();
            if (!$backup_result['status']) {
                throw new Exception('Backup database gagal: ' . $backup_result['message']);
            }
            $steps[count($steps) - 1]['status'] = 'success';

            // Step 2: Backup files
            $steps[] = ['step' => 'backup_files', 'status' => 'running'];
            $backup_files_result = $this->backup_files();
            if (!$backup_files_result['status']) {
                throw new Exception('Backup files gagal: ' . $backup_files_result['message']);
            }
            $steps[count($steps) - 1]['status'] = 'success';

            // Step 3: Pull dari Git
            $steps[] = ['step' => 'git_pull', 'status' => 'running'];
            $git_result = $this->git_pull();
            if (!$git_result['status']) {
                throw new Exception('Git pull gagal: ' . $git_result['message']);
            }
            $steps[count($steps) - 1]['status'] = 'success';

            // Step 4: Run migrations
            $steps[] = ['step' => 'run_migrations', 'status' => 'running'];
            $migration_result = $this->run_migrations();
            if (!$migration_result['status']) {
                throw new Exception('Migration gagal: ' . $migration_result['message']);
            }
            $steps[count($steps) - 1]['status'] = 'success';

            // Step 5: Update version file
            $steps[] = ['step' => 'update_version', 'status' => 'running'];
            $this->update_current_version();
            $steps[count($steps) - 1]['status'] = 'success';

            return [
                'status' => 'success',
                'message' => 'Update berhasil!',
                'steps' => $steps
            ];

        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'steps' => $steps
            ];
        }
    }

    /**
     * Backup database
     * 
     * @return array
     */
    private function backup_database()
    {
        try {
            $this->CI->load->dbutil();

            $prefs = [
                'format' => 'zip',
                'filename' => 'backup_' . date('Y-m-d_His') . '.sql'
            ];

            $backup = $this->CI->dbutil->backup($prefs);
            $backup_file = $this->backup_path . 'db_backup_' . date('Y-m-d_His') . '.zip';

            write_file($backup_file, $backup);

            return [
                'status' => true,
                'file' => $backup_file
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Backup important files
     * 
     * @return array
     */
    private function backup_files()
    {
        try {
            $backup_file = $this->backup_path . 'files_backup_' . date('Y-m-d_His') . '.zip';

            $zip = new ZipArchive();
            if ($zip->open($backup_file, ZipArchive::CREATE) !== TRUE) {
                throw new Exception('Tidak dapat membuat file ZIP');
            }

            // Backup config files
            $files_to_backup = [
                'application/config/config.php',
                'application/config/database.php',
                'version.json'
            ];

            foreach ($files_to_backup as $file) {
                $full_path = FCPATH . $file;
                if (file_exists($full_path)) {
                    $zip->addFile($full_path, $file);
                }
            }

            $zip->close();

            return [
                'status' => true,
                'file' => $backup_file
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Git pull
     * 
     * @return array
     */
    private function git_pull()
    {
        try {
            // Cek apakah git tersedia
            $git_check = shell_exec('which git 2>&1');
            if (empty($git_check)) {
                throw new Exception('Git tidak terinstall di server');
            }

            // Cek apakah folder adalah git repository
            if (!is_dir(FCPATH . '.git')) {
                throw new Exception('Folder bukan git repository');
            }

            // Simpan current directory
            $old_dir = getcwd();
            chdir(FCPATH);

            // Git pull
            $output = [];
            $return_var = 0;
            exec('git pull origin ' . $this->github_branch . ' 2>&1', $output, $return_var);

            // Kembali ke directory sebelumnya
            chdir($old_dir);

            if ($return_var !== 0) {
                throw new Exception('Git pull error: ' . implode("\n", $output));
            }

            return [
                'status' => true,
                'output' => implode("\n", $output)
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Run database migrations
     * 
     * @return array
     */
    private function run_migrations()
    {
        try {
            $this->CI->load->library('DatabaseMigration');
            return $this->CI->databasemigration->run_pending_migrations();

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Update current version
     */
    private function update_current_version()
    {
        $version_file = FCPATH . 'version.json';
        if (file_exists($version_file)) {
            $version_data = json_decode(file_get_contents($version_file), true);
            $this->current_version = $version_data['version'];
        }
    }

    /**
     * Get update history
     * 
     * @return array
     */
    public function get_update_history()
    {
        $log_file = FCPATH . 'database/update_history.json';

        if (!file_exists($log_file)) {
            return [];
        }

        $history = json_decode(file_get_contents($log_file), true);
        return $history ?: [];
    }

    /**
     * Save update history
     * 
     * @param array $data
     */
    public function save_update_history($data)
    {
        $log_file = FCPATH . 'database/update_history.json';
        $history = $this->get_update_history();

        $history[] = array_merge($data, [
            'timestamp' => date('Y-m-d H:i:s'),
            'user' => $this->CI->session->userdata('username')
        ]);

        file_put_contents($log_file, json_encode($history, JSON_PRETTY_PRINT));
    }
}

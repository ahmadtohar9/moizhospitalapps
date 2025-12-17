<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Database Migration Library
 * 
 * Library untuk handle database migrations otomatis
 * 
 * @package    Moiz Hospital Apps
 * @subpackage Libraries
 * @category   Database
 * @author     Ahmad Tohar
 */
class DatabaseMigration
{
    protected $CI;
    protected $migrations_path;
    protected $migrations_table = 'system_migrations';

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->migrations_path = FCPATH . 'database/migrations/';

        // Buat folder migrations jika belum ada
        if (!is_dir($this->migrations_path)) {
            mkdir($this->migrations_path, 0755, true);
        }

        // Buat tabel migrations jika belum ada
        $this->create_migrations_table();
    }

    /**
     * Buat tabel untuk tracking migrations
     */
    private function create_migrations_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->migrations_table}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `migration_file` varchar(255) NOT NULL,
            `executed_at` datetime NOT NULL,
            `executed_by` varchar(100) DEFAULT NULL,
            `status` enum('success','failed') DEFAULT 'success',
            `error_message` text,
            PRIMARY KEY (`id`),
            UNIQUE KEY `migration_file` (`migration_file`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->CI->db->query($sql);
    }

    /**
     * Get daftar migrations yang belum dijalankan
     * 
     * @return array
     */
    public function get_pending_migrations()
    {
        // Get all migration files
        $files = glob($this->migrations_path . '*.sql');

        if (empty($files)) {
            return [];
        }

        $pending = [];

        foreach ($files as $file) {
            $filename = basename($file);

            // Cek apakah sudah dijalankan
            $executed = $this->CI->db
                ->where('migration_file', $filename)
                ->where('status', 'success')
                ->get($this->migrations_table)
                ->row();

            if (!$executed) {
                $pending[] = [
                    'file' => $filename,
                    'path' => $file,
                    'size' => filesize($file),
                    'modified' => date('Y-m-d H:i:s', filemtime($file))
                ];
            }
        }

        // Sort by filename (biasanya ada timestamp di awal)
        usort($pending, function ($a, $b) {
            return strcmp($a['file'], $b['file']);
        });

        return $pending;
    }

    /**
     * Get daftar migrations yang sudah dijalankan
     * 
     * @return array
     */
    public function get_executed_migrations()
    {
        return $this->CI->db
            ->order_by('executed_at', 'DESC')
            ->get($this->migrations_table)
            ->result_array();
    }

    /**
     * Jalankan semua pending migrations
     * 
     * @return array
     */
    public function run_pending_migrations()
    {
        $pending = $this->get_pending_migrations();

        if (empty($pending)) {
            return [
                'status' => true,
                'message' => 'Tidak ada migration yang perlu dijalankan',
                'executed' => []
            ];
        }

        $executed = [];
        $errors = [];

        foreach ($pending as $migration) {
            $result = $this->run_migration($migration['path'], $migration['file']);

            if ($result['status']) {
                $executed[] = $migration['file'];
            } else {
                $errors[] = [
                    'file' => $migration['file'],
                    'error' => $result['error']
                ];
            }
        }

        if (!empty($errors)) {
            return [
                'status' => false,
                'message' => 'Beberapa migration gagal dijalankan',
                'executed' => $executed,
                'errors' => $errors
            ];
        }

        return [
            'status' => true,
            'message' => count($executed) . ' migration berhasil dijalankan',
            'executed' => $executed
        ];
    }

    /**
     * Jalankan satu migration file
     * 
     * @param string $file_path
     * @param string $filename
     * @return array
     */
    private function run_migration($file_path, $filename)
    {
        try {
            // Baca SQL file
            $sql = file_get_contents($file_path);

            if (empty($sql)) {
                throw new Exception('File migration kosong');
            }

            // Split multiple queries (separated by semicolon)
            $queries = $this->split_sql_queries($sql);

            // Begin transaction
            $this->CI->db->trans_start();

            // Execute each query
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    $this->CI->db->query($query);
                }
            }

            // Commit transaction
            $this->CI->db->trans_complete();

            if ($this->CI->db->trans_status() === FALSE) {
                throw new Exception('Database transaction failed');
            }

            // Log migration
            $this->log_migration($filename, 'success');

            return [
                'status' => true,
                'file' => $filename
            ];

        } catch (Exception $e) {
            // Rollback jika error
            $this->CI->db->trans_rollback();

            // Log error
            $this->log_migration($filename, 'failed', $e->getMessage());

            return [
                'status' => false,
                'file' => $filename,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Split SQL file menjadi multiple queries
     * 
     * @param string $sql
     * @return array
     */
    private function split_sql_queries($sql)
    {
        // Remove comments
        $sql = preg_replace('/--.*$/m', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

        // Split by semicolon (but not inside quotes)
        $queries = [];
        $current_query = '';
        $in_string = false;
        $string_char = '';

        for ($i = 0; $i < strlen($sql); $i++) {
            $char = $sql[$i];

            // Check for string delimiters
            if (($char === '"' || $char === "'") && ($i === 0 || $sql[$i - 1] !== '\\')) {
                if (!$in_string) {
                    $in_string = true;
                    $string_char = $char;
                } elseif ($char === $string_char) {
                    $in_string = false;
                }
            }

            // Split on semicolon if not in string
            if ($char === ';' && !$in_string) {
                $queries[] = $current_query;
                $current_query = '';
            } else {
                $current_query .= $char;
            }
        }

        // Add last query if not empty
        if (!empty(trim($current_query))) {
            $queries[] = $current_query;
        }

        return $queries;
    }

    /**
     * Log migration execution
     * 
     * @param string $filename
     * @param string $status
     * @param string $error_message
     */
    private function log_migration($filename, $status, $error_message = null)
    {
        $data = [
            'migration_file' => $filename,
            'executed_at' => date('Y-m-d H:i:s'),
            'executed_by' => $this->CI->session->userdata('username') ?: 'system',
            'status' => $status,
            'error_message' => $error_message
        ];

        // Check if already exists (untuk retry)
        $existing = $this->CI->db
            ->where('migration_file', $filename)
            ->get($this->migrations_table)
            ->row();

        if ($existing) {
            $this->CI->db
                ->where('migration_file', $filename)
                ->update($this->migrations_table, $data);
        } else {
            $this->CI->db->insert($this->migrations_table, $data);
        }
    }

    /**
     * Rollback migration (hanya hapus dari log, tidak undo SQL)
     * 
     * @param string $filename
     * @return bool
     */
    public function rollback_migration($filename)
    {
        return $this->CI->db
            ->where('migration_file', $filename)
            ->delete($this->migrations_table);
    }

    /**
     * Get migration info
     * 
     * @return array
     */
    public function get_migration_info()
    {
        $pending = $this->get_pending_migrations();
        $executed = $this->get_executed_migrations();

        return [
            'pending_count' => count($pending),
            'executed_count' => count($executed),
            'pending' => $pending,
            'executed' => $executed,
            'last_migration' => !empty($executed) ? $executed[0] : null
        ];
    }
}

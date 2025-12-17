<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Model dengan Caching Support
 * 
 * Semua model harus extend dari MY_Model untuk mendapatkan:
 * - Automatic query caching
 * - Cache invalidation helpers
 * - Performance logging
 * 
 * Usage:
 * class YourModel extends MY_Model {
 *     protected $cache_ttl = 600; // 10 minutes
 *     
 *     public function get_data($id) {
 *         return $this->get_cached("data_{$id}", function() use ($id) {
 *             return $this->db->get_where('table', ['id' => $id])->row_array();
 *         });
 *     }
 * }
 */
class MY_Model extends CI_Model
{
    /**
     * Default cache TTL (seconds)
     * Override di child class jika perlu
     */
    protected $cache_ttl = 300; // 5 menit default

    /**
     * Cache driver: file, memcached, redis, apc
     */
    protected $cache_driver = 'file';

    /**
     * Enable/disable caching
     */
    protected $cache_enabled = TRUE;

    public function __construct()
    {
        parent::__construct();

        // Load cache driver
        $this->load->driver('cache', array(
            'adapter' => $this->cache_driver,
            'backup' => 'dummy'
        ));
    }

    /**
     * Get data dengan caching otomatis
     * 
     * @param string $cache_key Unique cache key
     * @param callable $callback Function yang return data
     * @param int $ttl Cache TTL (seconds), null = use default
     * @return mixed
     */
    protected function get_cached($cache_key, $callback, $ttl = null)
    {
        // Skip cache jika disabled
        if (!$this->cache_enabled) {
            return $callback();
        }

        $ttl = $ttl ?? $this->cache_ttl;

        // Try cache first
        $cached = $this->cache->get($cache_key);
        if ($cached !== FALSE) {
            log_message('debug', "Cache HIT: {$cache_key}");
            return $cached;
        }

        // Cache miss, execute callback
        log_message('debug', "Cache MISS: {$cache_key}");
        $start_time = microtime(true);

        $data = $callback();

        $execution_time = (microtime(true) - $start_time) * 1000;
        log_message('debug', sprintf(
            "Query executed in %.2fms for cache key: %s",
            $execution_time,
            $cache_key
        ));

        // Save to cache (only if data is valid)
        if ($data !== FALSE && $data !== NULL) {
            $this->cache->save($cache_key, $data, $ttl);
            log_message('debug', "Cache SAVED: {$cache_key} (TTL: {$ttl}s)");
        }

        return $data;
    }

    /**
     * Query dengan caching
     * 
     * @param string $sql SQL query
     * @param string $cache_key Cache key
     * @param int $ttl Cache TTL
     * @param bool $return_array Return as array (default) or object
     * @return array|object
     */
    protected function query_cached($sql, $cache_key, $ttl = null, $return_array = true)
    {
        return $this->get_cached($cache_key, function () use ($sql, $return_array) {
            $query = $this->db->query($sql);
            return $return_array ? $query->result_array() : $query->result();
        }, $ttl);
    }

    /**
     * Clear cache by key atau pattern
     * 
     * @param string $key_pattern Cache key atau pattern (null = clear all)
     */
    protected function clear_cache($key_pattern = null)
    {
        if ($key_pattern === null) {
            // Clear all cache
            $this->cache->clean();
            log_message('info', "All cache cleared");
        } else {
            // Clear specific key
            $this->cache->delete($key_pattern);
            log_message('info', "Cache cleared: {$key_pattern}");
        }
    }

    /**
     * Clear cache by prefix (untuk clear multiple keys)
     * 
     * @param string $prefix Cache key prefix
     */
    protected function clear_cache_by_prefix($prefix)
    {
        // Note: File cache driver doesn't support prefix deletion
        // You need to implement this based on your cache driver

        if ($this->cache_driver === 'file') {
            $cache_path = APPPATH . 'cache/';

            if (is_dir($cache_path)) {
                $files = glob($cache_path . $prefix . '*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                log_message('info', "Cache cleared by prefix: {$prefix}");
            }
        } else {
            // For other drivers, implement accordingly
            log_message('warning', "clear_cache_by_prefix not implemented for driver: {$this->cache_driver}");
        }
    }

    /**
     * Get cache info
     * 
     * @param string $cache_key
     * @return array|null
     */
    protected function get_cache_info($cache_key)
    {
        $cached = $this->cache->get($cache_key);

        if ($cached === FALSE) {
            return null;
        }

        return [
            'exists' => true,
            'key' => $cache_key,
            'size' => strlen(serialize($cached)),
        ];
    }

    /**
     * Temporarily disable caching
     */
    protected function disable_cache()
    {
        $this->cache_enabled = FALSE;
    }

    /**
     * Re-enable caching
     */
    protected function enable_cache()
    {
        $this->cache_enabled = TRUE;
    }
}

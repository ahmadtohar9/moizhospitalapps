<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rate Limiter Hook
 * 
 * Membatasi jumlah request per IP/User untuk mencegah:
 * - DoS attacks
 * - Spam/abuse
 * - Server overload
 * 
 * Limits:
 * - 60 requests per minute per IP
 * - 1000 requests per hour per IP
 * 
 * Whitelist:
 * - Localhost (127.0.0.1)
 * - CLI requests
 * - Admin users (configurable)
 */
class RateLimiter
{
    protected $CI;
    protected $cache;

    // Rate limits (requests per time period)
    protected $max_requests_per_minute = 60;   // 60 req/min
    protected $max_requests_per_hour = 1000;   // 1000 req/hour

    // Whitelist IPs (tidak kena rate limit)
    protected $whitelist_ips = [
        '127.0.0.1',
        '::1',
        'localhost'
    ];

    // Whitelist user roles (tidak kena rate limit)
    protected $whitelist_roles = [
        // 1 // Admin (uncomment jika mau whitelist admin)
    ];

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('cache', ['adapter' => 'file', 'backup' => 'dummy']);
        $this->cache = $this->CI->cache;
    }

    /**
     * Check rate limit
     */
    public function check()
    {
        // Skip untuk CLI
        if (php_sapi_name() === 'cli') {
            return;
        }

        // Get IP address
        $ip = $this->CI->input->ip_address();

        // Check whitelist IP
        if (in_array($ip, $this->whitelist_ips)) {
            return;
        }

        // Check whitelist role
        $role_id = $this->CI->session->userdata('role_id');
        if ($role_id && in_array($role_id, $this->whitelist_roles)) {
            return;
        }

        // Get user identifier
        $user_id = $this->CI->session->userdata('user_id') ?? 'guest';
        $identifier = "{$ip}_{$user_id}";

        // Check minute limit
        $this->_check_limit(
            $identifier,
            'minute',
            $this->max_requests_per_minute,
            60,
            'Too many requests. Please wait a minute.'
        );

        // Check hour limit
        $this->_check_limit(
            $identifier,
            'hour',
            $this->max_requests_per_hour,
            3600,
            'Too many requests. Please wait an hour.'
        );
    }

    /**
     * Check specific limit
     * 
     * @param string $identifier User identifier
     * @param string $period Time period (minute, hour)
     * @param int $max_requests Max requests allowed
     * @param int $ttl Cache TTL in seconds
     * @param string $error_message Error message
     */
    private function _check_limit($identifier, $period, $max_requests, $ttl, $error_message)
    {
        // Generate cache key
        $time_key = $period === 'minute' ? date('YmdHi') : date('YmdH');
        $cache_key = "rate_limit_{$identifier}_{$period}_{$time_key}";

        // Get current count
        $count = (int) $this->cache->get($cache_key);

        // Check if limit exceeded
        if ($count >= $max_requests) {
            log_message('warning', sprintf(
                'Rate limit exceeded for %s: %d requests in %s',
                $identifier,
                $count,
                $period
            ));

            $this->_block_request($error_message, $count, $max_requests);
        }

        // Increment counter
        $this->cache->save($cache_key, $count + 1, $ttl);
    }

    /**
     * Block request dengan HTTP 429
     * 
     * @param string $message Error message
     * @param int $current Current request count
     * @param int $limit Request limit
     */
    private function _block_request($message, $current = 0, $limit = 0)
    {
        // Set HTTP status
        header('HTTP/1.1 429 Too Many Requests');
        header('Content-Type: application/json');
        header('Retry-After: 60'); // Retry after 60 seconds

        // Response
        $response = [
            'success' => false,
            'message' => $message,
            'code' => 429,
            'current' => $current,
            'limit' => $limit,
            'retry_after' => 60
        ];

        echo json_encode($response);
        exit;
    }

    /**
     * Get rate limit status untuk user
     * (untuk debugging atau display ke user)
     * 
     * @return array
     */
    public function get_status()
    {
        $ip = $this->CI->input->ip_address();
        $user_id = $this->CI->session->userdata('user_id') ?? 'guest';
        $identifier = "{$ip}_{$user_id}";

        // Minute stats
        $time_key_minute = date('YmdHi');
        $cache_key_minute = "rate_limit_{$identifier}_minute_{$time_key_minute}";
        $count_minute = (int) $this->cache->get($cache_key_minute);

        // Hour stats
        $time_key_hour = date('YmdH');
        $cache_key_hour = "rate_limit_{$identifier}_hour_{$time_key_hour}";
        $count_hour = (int) $this->cache->get($cache_key_hour);

        return [
            'ip' => $ip,
            'user_id' => $user_id,
            'minute' => [
                'current' => $count_minute,
                'limit' => $this->max_requests_per_minute,
                'remaining' => max(0, $this->max_requests_per_minute - $count_minute),
                'percentage' => round(($count_minute / $this->max_requests_per_minute) * 100, 2)
            ],
            'hour' => [
                'current' => $count_hour,
                'limit' => $this->max_requests_per_hour,
                'remaining' => max(0, $this->max_requests_per_hour - $count_hour),
                'percentage' => round(($count_hour / $this->max_requests_per_hour) * 100, 2)
            ]
        ];
    }
}

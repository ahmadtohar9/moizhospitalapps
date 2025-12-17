<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bpjs_service - Final (compatible with your previous working version)
 *
 * - Robust config loading (multiple fallbacks)
 * - Build headers X-cons-id / X-timestamp / X-signature / user_key
 * - send_request() for GET/POST
 * - decrypt_response() : AES attempts + optional LZString decompress
 * - Does NOT throw in constructor; returns controlled errors if config missing
 */

class Bpjs_service
{

    private $CI;
    private $cons_id = '';
    private $secret_key = '';
    private $user_key = '';
    private $base_url = '';
    private $config_ok = false;

    public function __construct($params = null)
    {
        $this->CI =& get_instance();

        // Accept service_type param (array or string) but not heavily used here
        $service_type = 'vclaim';
        if (is_array($params)) {
            if (isset($params['service_type']))
                $service_type = $params['service_type'];
            elseif (isset($params[0]) && is_string($params[0]))
                $service_type = $params[0];
        } elseif (is_string($params) && $params !== '') {
            $service_type = $params;
        }

        // Try load config (robust)
        // Preferred: application/config/setting_bpjs.php with $config['bpjs']
        $this->CI->config->load('setting_bpjs', TRUE);
        $bpjs = $this->CI->config->item('bpjs');

        // If not found, try retrieving from the loaded file index
        if (!is_array($bpjs)) {
            $bpjs = $this->CI->config->item('bpjs', 'setting_bpjs'); // when loaded with TRUE
        }

        // Fallback: try reading individual keys from global config
        if (!is_array($bpjs)) {
            $possible = [];
            $keys = ['cons_id', 'consid', 'secret_key', 'secretkey', 'user_key_vclaim', 'user_key_antrol', 'base_url_vclaim', 'base_url_antrol', 'base_url', 'user_key'];
            foreach ($keys as $k) {
                $v = $this->CI->config->item($k);
                if ($v !== null)
                    $possible[$k] = $v;
            }
            if (!empty($possible))
                $bpjs = $possible;
        }

        if (is_array($bpjs) && !empty($bpjs)) {
            // normalize keys
            $this->cons_id = $bpjs['cons_id'] ?? $bpjs['consid'] ?? ($bpjs['CONS_ID'] ?? '');
            $this->secret_key = $bpjs['secret_key'] ?? $bpjs['secretkey'] ?? ($bpjs['SECRET_KEY'] ?? '');

            // choose user_key & base_url based on service type
            if ($service_type === 'vclaim') {
                $this->user_key = $bpjs['user_key_vclaim'] ?? $bpjs['user_key'] ?? '';
                $this->base_url = rtrim($bpjs['base_url_vclaim'] ?? $bpjs['base_url'] ?? '', '/');
            } else {
                $this->user_key = $bpjs['user_key_antrol'] ?? $bpjs['user_key'] ?? '';
                $this->base_url = rtrim($bpjs['base_url_antrol'] ?? $bpjs['base_url'] ?? '', '/');
            }

            if (!empty($this->cons_id) && !empty($this->secret_key) && !empty($this->base_url)) {
                $this->config_ok = true;
            } else {
                log_message('error', '[Bpjs_service] config loaded but missing essential keys (cons_id/secret_key/base_url).');
            }
        } else {
            log_message('error', '[Bpjs_service] setting_bpjs.php or $config[\'bpjs\'] not found. Service running in safe mode.');
        }

        log_message('debug', "[Bpjs_service] initialized. base_url={$this->base_url} config_ok=" . ($this->config_ok ? '1' : '0'));
    }

    /** timestamp **/
    public function get_timestamp()
    {
        // BPJS Documentation:
        // date_default_timezone_set('UTC');
        // $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $tStamp;
    }

    /** signature: base64(hmac-sha256(cons_id & timestamp, secret_key)) **/
    public function generate_signature($timestamp)
    {
        if (empty($this->cons_id) || empty($this->secret_key))
            return '';
        $message = $this->cons_id . "&" . $timestamp;
        $raw = hash_hmac('sha256', $message, $this->secret_key, true);
        return base64_encode($raw);
    }

    /** headers builder **/
    public function get_headers($timestamp = null)
    {
        if ($timestamp === null)
            $timestamp = $this->get_timestamp();
        $sig = $this->generate_signature($timestamp);
        return [
            'X-cons-id: ' . $this->cons_id,
            'X-timestamp: ' . $timestamp,
            'X-signature: ' . $sig,
            'user_key: ' . $this->user_key
        ];
    }

    /** AES decrypt helper with multiple attempts **/
    private function _aes_decrypt($key_raw, $encrypted_base64)
    {
        if (empty($encrypted_base64)) {
            log_message('error', '[Bpjs_service][_aes_decrypt] empty input');
            return false;
        }

        $key_hash = hash('sha256', $key_raw, true);
        $iv = substr($key_hash, 0, 16);

        $decoded = @base64_decode($encrypted_base64, true);

        $methods = [
            ['cipher' => 'AES-256-CBC', 'opt' => OPENSSL_RAW_DATA],
            ['cipher' => 'AES-128-CBC', 'opt' => OPENSSL_RAW_DATA],
            ['cipher' => 'AES-256-CBC', 'opt' => 0],
            ['cipher' => 'AES-128-CBC', 'opt' => 0],
        ];

        if ($decoded !== false) {
            foreach ($methods as $m) {
                $out = @openssl_decrypt($decoded, $m['cipher'], $key_hash, $m['opt'], $iv);
                if ($out !== false && $out !== null && $out !== '')
                    return $out;
            }
        }

        foreach ($methods as $m) {
            $out2 = @openssl_decrypt($encrypted_base64, $m['cipher'], $key_hash, $m['opt'], $iv);
            if ($out2 !== false && $out2 !== null && $out2 !== '')
                return $out2;
        }

        log_message('error', '[Bpjs_service][_aes_decrypt] all attempts failed');
        return false;
    }

    /** optional LZString decompress (if library present) **/
    private function _decompress_lz($str)
    {
        if (empty($str))
            return null;

        $autoload = APPPATH . '../vendor/autoload.php';
        if (!class_exists('\LZCompressor\LZString') && file_exists($autoload)) {
            require_once $autoload;
        }

        if (class_exists('\LZCompressor\LZString')) {
            $try_methods = ['decompressFromEncodedURIComponent', 'decompress', 'decompressFromBase64', 'decompressFromUTF16'];
            foreach ($try_methods as $m) {
                if (method_exists('\LZCompressor\LZString', $m)) {
                    try {
                        $res = call_user_func(['\LZCompressor\LZString', $m], $str);
                        if ($res !== null && $res !== false && $res !== '') {
                            log_message('debug', '[Bpjs_service][_decompress_lz] method ' . $m . ' succeeded');
                            return $res;
                        }
                    } catch (Exception $e) {
                        log_message('error', '[Bpjs_service][_decompress_lz] ' . $e->getMessage());
                    }
                }
            }
        } else {
            log_message('debug', '[Bpjs_service][_decompress_lz] LZString not available');
        }

        return null;
    }

    /** Full decrypt flow **/
    public function decrypt_response($encrypted_response, $timestamp)
    {
        if (empty($encrypted_response))
            return ['error' => 'empty input'];
        $key_raw = $this->cons_id . $this->secret_key . $timestamp;

        $aes_out = $this->_aes_decrypt($key_raw, $encrypted_response);
        if ($aes_out === false)
            return ['error' => 'AES decrypt failed'];

        $maybe = json_decode($aes_out, true);
        if (json_last_error() === JSON_ERROR_NONE)
            return $maybe;

        $dec = $this->_decompress_lz($aes_out);
        if ($dec !== null) {
            $decoded = json_decode($dec, true);
            if (json_last_error() === JSON_ERROR_NONE)
                return $decoded;
            return ['error' => 'JSON parse failed after decompress: ' . json_last_error_msg(), 'sample' => substr($dec, 0, 500)];
        }

        return ['error' => 'decrypt produced non-JSON output', 'sample' => substr($aes_out, 0, 500)];
    }

    /**
     * Send HTTP request (GET/POST). If config not OK, return controlled error.
     *
     * $endpoint: relative endpoint (e.g. 'referensi/poli/INT')
     * $method: 'GET' or 'POST'
     * $data: array for POST body (will be json_encoded)
     * $timestamp: optional, use same timestamp for header + decrypt
     */
    public function send_request($endpoint, $method = 'GET', $data = null, $timestamp = null)
    {
        if (!$this->config_ok) {
            return ['metaData' => ['code' => 500, 'message' => 'BPJS config missing/incomplete']];
        }

        if ($timestamp === null)
            $timestamp = $this->get_timestamp();

        $url = rtrim($this->base_url, '/') . '/' . ltrim($endpoint, '/');
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            log_message('error', '[Bpjs_service][send_request] Malformed URL: ' . $url);
            return ['metaData' => ['code' => 500, 'message' => 'Malformed URL: ' . $url]];
        }

        // Prepare body: if $data is array -> json_encode; if string assume already encoded
        $body = null;
        if ($data !== null) {
            if (is_array($data) || is_object($data)) {
                $body = json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                $body = (string) $data;
            }
        }

        // Headers (get_headers should already provide Auth headers + Content-Type maybe)
        $headers = $this->get_headers($timestamp);
        // Ensure content type JSON for POST/PUT/DELETE
        if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $hasCt = false;
            foreach ($headers as $h)
                if (stripos($h, 'Content-Type:') === 0)
                    $hasCt = true;
            if (!$hasCt) {
                // Special case for DELETE as per BPJS docs (verified text/plain via Postman)
                if (strtoupper($method) === 'DELETE') {
                    $headers[] = 'Content-Type: text/plain';
                } else {
                    $headers[] = 'Content-Type: application/json; charset=utf-8';
                }
            }
        }

        $ch = curl_init();
        $opts = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => ($this->bpjs_api['timeout'] ?? 30),
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => ($this->bpjs_api['ssl_verify'] ?? false),
            CURLOPT_SSL_VERIFYHOST => ($this->bpjs_api['ssl_verify'] ?? false) ? 2 : 0,
        ];

        $methodU = strtoupper($method);
        if ($methodU === 'POST') {
            $opts[CURLOPT_POST] = true;
            if ($body !== null) {
                $opts[CURLOPT_POSTFIELDS] = $body;
                log_message('debug', '[Bpjs_service][send_request] POST body: ' . substr($body, 0, 1000));
            }
        } elseif ($methodU !== 'GET') {
            $opts[CURLOPT_CUSTOMREQUEST] = $methodU;
            if ($body !== null)
                $opts[CURLOPT_POSTFIELDS] = $body;
        }

        curl_setopt_array($ch, $opts);
        $raw_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_err = curl_error($ch);
        curl_close($ch);

        if ($curl_err) {
            log_message('error', '[Bpjs_service][send_request] CURL error: ' . $curl_err);
            return ['metaData' => ['code' => 500, 'message' => 'CURL Error: ' . $curl_err]];
        }

        if ($raw_response === false || $raw_response === null || $raw_response === '') {
            return ['metaData' => ['code' => $http_code, 'message' => 'Empty response']];
        }

        // Try decode JSON
        $decoded = json_decode($raw_response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // Auto-decrypt if response is encrypted string
            if (isset($decoded['response']) && is_string($decoded['response']) && method_exists($this, 'decrypt_response')) {
                // Use the timestamp we sent with validity check
                // Note: Timestamp used for headers must match timestamp for decrypt
                $decrypted = $this->decrypt_response($decoded['response'], $timestamp);

                // If decryption success (returns array and not error)
                if (is_array($decrypted) && !isset($decrypted['error'])) {
                    $decoded['response'] = $decrypted;
                }
            }
            return $decoded;
        }

        // If not JSON, try to decrypt if you have decrypt_response() (vclaim sometimes encrypts)
        if (method_exists($this, 'decrypt_response')) {
            $decrypted = $this->decrypt_response($raw_response, $timestamp);
            if (is_array($decrypted) && !isset($decrypted['error'])) {
                return $decrypted;
            }
            // decrypt failed: log debug and continue to return raw
            log_message('error', '[Bpjs_service][send_request] decrypt failed or returned error: ' . (is_array($decrypted) ? json_encode($decrypted) : substr($raw_response, 0, 400)));
        }

        // Not JSON and not decryptable -> return debug with raw_start and http_code
        // Not JSON and not decryptable -> return debug with raw_start and http_code
        $snippet = strip_tags(substr($raw_response, 0, 500)); // Basic strip tags
        return [
            'metaData' => ['code' => $http_code, 'message' => 'Remote returned non-JSON error page (Code: ' . $http_code . '). Content: ' . $snippet],
            'debug' => [
                'http_code' => $http_code,
                'raw_start' => substr($raw_response, 0, 2000),
                'request_body' => $body,
                'request_headers' => $headers
            ]
        ];
    }

    public function insert_sep_v2($t_sep_data)
    {
        if (!$this->config_ok) {
            return [
                'status' => 'error',
                'message' => 'BPJS config not properly configured'
            ];
        }

        // Pastikan format request sesuai dengan BPJS
        $payload = [
            'request' => [
                't_sep' => $t_sep_data
            ]
        ];

        // Prepare URL
        $endpoint = 'SEP/2.0/insert';
        $url = rtrim($this->base_url, '/') . '/' . ltrim($endpoint, '/');

        return $this->_exec_v2($url, 'POST', $payload);
    }

    public function update_sep_v2($t_sep_data)
    {
        if (!$this->config_ok) {
            return [
                'status' => 'error',
                'message' => 'BPJS config not properly configured'
            ];
        }

        // Pastikan format request sesuai dengan BPJS
        $payload = [
            'request' => [
                't_sep' => $t_sep_data
            ]
        ];

        // Prepare URL
        $endpoint = 'SEP/2.0/update';
        $url = rtrim($this->base_url, '/') . '/' . ltrim($endpoint, '/');

        return $this->_exec_v2($url, 'PUT', $payload);
    }

    private function _exec_v2($url, $method, $payload)
    {
        // Generate timestamp untuk signature
        $timestamp = $this->get_timestamp();

        // Prepare headers
        $headers = $this->get_headers($timestamp);

        $headers = array_filter($headers, function ($h) {
            return stripos($h, 'Content-Type:') === false;
        });
        $headers = array_values($headers);
        $headers[] = 'Content-Type: text/plain';
        $headers[] = 'Expect:';

        $body = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        log_message('debug', '[Bpjs_service] URL: ' . $url);
        log_message('debug', '[Bpjs_service] Payload: ' . substr($body, 0, 1000));

        $ch = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ];

        curl_setopt_array($ch, $options);
        $raw_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_errno) {
            log_message('error', '[Bpjs_service] CURL Error: ' . $curl_error);
            return [
                'status' => 'error',
                'message' => 'CURL Error: ' . $curl_error,
                'http_code' => $http_code
            ];
        }

        // Try to decode JSON response
        $response = json_decode($raw_response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', '[Bpjs_service] Invalid JSON response: ' . $raw_response);
            return [
                'status' => 'error',
                'message' => 'Invalid response from BPJS (not JSON)',
                'http_code' => $http_code,
                'raw_response' => substr($raw_response, 0, 500)
            ];
        }

        if (isset($response['response']) && is_string($response['response'])) {
            $decrypted = $this->decrypt_response($response['response'], $timestamp);
            if (is_array($decrypted) && !isset($decrypted['error'])) {
                $response['response'] = $decrypted;
            }
        }

        if (isset($response['metaData']['code'])) {
            if ($response['metaData']['code'] == 200) {
                // Determine response data
                $respBody = $response['response'] ?? [];
                // Similar extraction
                $sep_data = $respBody['sep'] ?? $respBody['t_sep'] ?? $respBody ?? [];

                return [
                    'status' => 'success',
                    'message' => $response['metaData']['message'] ?? 'Action successful',
                    'data' => $sep_data,
                    'noSep' => $sep_data['noSep'] ?? '',
                    'tglSep' => $sep_data['tglSep'] ?? '',
                    'raw' => $response
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => $response['metaData']['message'] ?? 'BPJS returned error',
                    'code' => $response['metaData']['code'],
                    'raw' => $response
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Unknown response format from BPJS',
            'raw' => $response
        ];
    }


    /* ======= helpers ======= */
    public function test_referensi_poli($kode_poli = 'INT', $timestamp = null)
    {
        return $this->send_request('referensi/poli/' . $kode_poli, 'GET', null, $timestamp);
    }
    public function call($endpoint, $method = 'GET', $data = null, $timestamp = null)
    {
        return $this->send_request($endpoint, $method, $data, $timestamp);
    }
    public function get_cons_id()
    {
        return $this->cons_id;
    }
    public function test_decrypt($enc, $timestamp = null)
    {
        if ($timestamp === null)
            $timestamp = $this->get_timestamp();
        return $this->decrypt_response($enc, $timestamp);
    }

    /**
     * Get referensi poli (wrapper for compatibility)
     * 
     * @param string $keyword Optional keyword for search
     * @return array
     */
    public function get_referensi_poli($keyword = '')
    {
        $endpoint = 'referensi/poli';
        if (!empty($keyword)) {
            $endpoint .= '/' . urlencode($keyword);
        }

        $response = $this->send_request($endpoint, 'GET');

        // Return in format expected by controller
        return [
            'success' => isset($response['metaData']) && $response['metaData']['code'] == '200',
            'data' => $response,
            'message' => $response['metaData']['message'] ?? 'Unknown error'
        ];
    }

}
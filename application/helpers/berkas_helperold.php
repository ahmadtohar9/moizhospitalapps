<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('_berkas_scheme_host'))
{
    /**
     * Ambil scheme + host(+port) dari request, fallback ke base_url() bila ada.
     * @return array [$schemeHost, $scheme] contoh: ['http://127.0.0.1:80', 'http']
     */
    function _berkas_scheme_host()
    {
        // coba ambil dari CI config base_url jika ada & valid
        $CI = function_exists('get_instance') ? get_instance() : null;
        if ($CI && isset($CI->config))
        {
            $base = rtrim((string) $CI->config->item('base_url'), '/');
            if ($base !== '')
            {
                $p = @parse_url($base);
                if ($p && !empty($p['scheme']) && !empty($p['host'])) {
                    $hostport = $p['host'] . (isset($p['port']) ? ':' . $p['port'] : '');
                    return [ $p['scheme'] . '://' . $hostport, $p['scheme'] ];
                }
            }
        }

        // fallback dari $_SERVER
        $https  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                  (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
        $scheme = $https ? 'https' : 'http';
        $host   = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
                 : (!empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');

        // HTTP_HOST sering sudah termasuk port (127.0.0.1:8080), jadi langsung pakai
        return [ $scheme.'://'.$host, $scheme ];
    }
}

if ( ! function_exists('_berkas_roots'))
{
    /**
     * Hitung root URL & FS untuk /webapps/, bisa override via config
     * @return array [$rootUrl, $rootFs] ; masing-masing PASTI diakhiri slash
     */
    function _berkas_roots()
    {
        $CI = function_exists('get_instance') ? get_instance() : null;

        // 1) coba ambil dari config (opsional)
        $cfgUrl = $CI && isset($CI->config) ? rtrim((string)$CI->config->item('webapps_root_url'), '/') : '';
        $cfgFs  = $CI && isset($CI->config) ? rtrim((string)$CI->config->item('webapps_root_fs'),  DIRECTORY_SEPARATOR) : '';

        // 2) fallback ke deteksi otomatis
        if ($cfgUrl === '') {
            list($schemeHost,) = _berkas_scheme_host();
            $cfgUrl = $schemeHost . '/webapps';
        }
        if ($cfgFs === '') {
            // FCPATH biasanya .../htdocs/<nama-aplikasi>/
            $htdocs = rtrim(dirname(FCPATH), DIRECTORY_SEPARATOR);
            $cfgFs  = $htdocs . DIRECTORY_SEPARATOR . 'webapps';
        }

        // pastikan berakhiran slash
        $cfgUrl .= '/';
        $cfgFs  .= DIRECTORY_SEPARATOR;

        return [$cfgUrl, $cfgFs];
    }
}

/* ====================== public helpers ====================== */

if ( ! function_exists('berkas_base'))
{
    /**
     * Dapatkan base URL & base FS untuk subdir di bawah /webapps/
     * @param string $subdir contoh: 'radiologi', 'lab', 'resume'
     * @return array [$baseUrl, $baseFs] (keduanya diakhiri slash)
     */
    function berkas_base($subdir = '')
    {
        list($rootUrl, $rootFs) = _berkas_roots();

        $s = trim((string)$subdir, "/\\");
        $baseUrl = $rootUrl . ($s !== '' ? $s.'/' : '');
        $baseFs  = $rootFs  . ($s !== '' ? $s.DIRECTORY_SEPARATOR : '');

        return [$baseUrl, $baseFs];
    }
}

if ( ! function_exists('berkas_rel'))
{
    /**
     * Normalisasi path/file agar RELATIF terhadap subdir webapps
     * - Menghapus leading slash dan prefix 'webapps/<subdir>/'
     * - Mengganti backslash ke slash
     * @param string $subdir
     * @param string $path contoh: '/webapps/radiologi/pages/upload/a.png' atau 'pages/upload/a.png'
     * @return string path relatif (mis. 'pages/upload/a.png')
     */
    function berkas_rel($subdir, $path)
    {
        $s = trim((string)$subdir, "/\\");
        $p = str_replace('\\', '/', (string)$path);
        $p = ltrim($p, '/');
        if ($s !== '') {
            $p = preg_replace('~^webapps/'.$s.'/~i', '', $p);
        } else {
            $p = preg_replace('~^webapps/~i', '', $p);
        }
        return ltrim($p, '/');
    }
}

if ( ! function_exists('berkas_url'))
{
    /**
     * Buat URL absolut ke file tertentu
     * @param string $subdir
     * @param string $relativePath path relatif di bawah subdir (gunakan berkas_rel jika perlu)
     */
    function berkas_url($subdir, $relativePath)
    {
        list($baseUrl,) = berkas_base($subdir);
        $rel = ltrim(str_replace('\\','/',$relativePath), '/');
        return $baseUrl . $rel;
    }
}

if ( ! function_exists('berkas_path'))
{
    /**
     * Buat path filesystem absolut ke file tertentu
     * @param string $subdir
     * @param string $relativePath path relatif di bawah subdir (gunakan berkas_rel jika perlu)
     */
    function berkas_path($subdir, $relativePath)
    {
        list(,$baseFs) = berkas_base($subdir);
        $rel = ltrim(str_replace('\\','/',$relativePath), '/');
        return $baseFs . str_replace('/', DIRECTORY_SEPARATOR, $rel);
    }
}

if ( ! function_exists('berkas_is_image'))
{
    /**
     * Deteksi ekstensi image
     */
    function berkas_is_image($path)
    {
        $ext = strtolower(pathinfo((string)$path, PATHINFO_EXTENSION));
        return in_array($ext, ['png','jpg','jpeg','gif','webp','bmp'], true);
    }
}

if ( ! function_exists('berkas_build'))
{
    /**
     * Bangun info lengkap untuk sebuah file (url, path, exists, is_image)
     * @param string $subdir
     * @param string $pathBisaApaSaja bisa path relatif/absolut; akan dinormalisasi ke relatif
     * @return array ['url'=>..., 'path'=>..., 'exists'=>0|1, 'is_image'=>0|1, 'relative'=>...]
     */
    function berkas_build($subdir, $pathBisaApaSaja)
    {
        $rel  = berkas_rel($subdir, $pathBisaApaSaja);
        $url  = berkas_url($subdir, $rel);
        $fs   = berkas_path($subdir, $rel);
        $img  = berkas_is_image($rel);
        $ok   = is_file($fs) ? 1 : 0;

        return [
            'url'       => $url,
            'path'      => $fs,
            'exists'    => $ok,
            'is_image'  => $img ? 1 : 0,
            'relative'  => $rel,
        ];
    }
}

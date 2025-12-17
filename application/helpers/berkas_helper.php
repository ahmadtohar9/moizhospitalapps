<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ======================================
 *  Berkas Helper (FINAL, backward-safe)
 *  - Wrapper config: berkas_cfg()
 *  - Utils: berkas_base_dir, berkas_base_url, berkas_max_size, berkas_allowed_mime,
 *           berkas_storage_mode, berkas_https_required
 *  - Path/URL: berkas_kind_dir, berkas_join, berkas_is_url,
 *              berkas_rel($jenis, $lokasi)  // juga mendukung berkas_rel($lokasi)
 *  - Build info: berkas_build($jenis, $path)
 *  - Exists: berkas_exists($jenis, $lokasi) // juga mendukung berkas_exists($lokasi)
 * ======================================
 */

/* -------------------- CONFIG WRAPPER -------------------- */
if (!function_exists('berkas_cfg')) {
    function berkas_cfg(): array
    {
        $CI =& get_instance();
        $cfg = (array) $CI->config->item('berkas');

        $defaults = [
            'storage_mode' => 'hybrid', // private | hybrid | public
            'base_dir_private' => '',
            'base_url_public' => '',
            'thumb_dir' => '',
            'max_upload_mb' => 10,
            'allowed_mime' => ['image/jpeg', 'image/png', 'application/pdf'],
            'https_required' => false,
            'once_only_default' => false,
        ];

        // dukung nested 'paths'
        if (empty($cfg['base_dir_private']) && !empty($cfg['paths']['base_dir_private'])) {
            $cfg['base_dir_private'] = $cfg['paths']['base_dir_private'];
        }
        if (empty($cfg['base_url_public']) && !empty($cfg['paths']['base_url_public'])) {
            $cfg['base_url_public'] = $cfg['paths']['base_url_public'];
        }
        if (empty($cfg['thumb_dir']) && !empty($cfg['paths']['thumb_dir'])) {
            $cfg['thumb_dir'] = $cfg['paths']['thumb_dir'];
        }

        $cfg = array_merge($defaults, $cfg);

        // Fallback dev lokal
        if ($cfg['base_dir_private'] === '') {
            $docroot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
            if ($docroot !== '') {
                $cfg['base_dir_private'] = $docroot . '/webapps/berkasrawat/pages/upload';
            }
        }
        if ($cfg['base_url_public'] === '') {
            $host = $_SERVER['HTTP_HOST'] ?? '127.0.0.1';
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
            $cfg['base_url_public'] = $scheme . $host . '/webapps/berkasrawat/pages/upload';
        }

        return $cfg;
    }
}

if (!function_exists('berkas_base_dir')) {
    function berkas_base_dir(): string
    {
        return rtrim((string) berkas_cfg()['base_dir_private'], '/');
    }
}
if (!function_exists('berkas_base_url')) {
    function berkas_base_url(): string
    {
        return rtrim((string) berkas_cfg()['base_url_public'], '/');
    }
}
if (!function_exists('berkas_max_size')) {
    function berkas_max_size(): int
    {
        return (int) berkas_cfg()['max_upload_mb'];
    }
}
if (!function_exists('berkas_allowed_mime')) {
    function berkas_allowed_mime(): array
    {
        return (array) berkas_cfg()['allowed_mime'];
    }
}
if (!function_exists('berkas_storage_mode')) {
    function berkas_storage_mode(): string
    {
        return (string) berkas_cfg()['storage_mode'];
    }
}
if (!function_exists('berkas_https_required')) {
    function berkas_https_required(): bool
    {
        return (bool) berkas_cfg()['https_required'];
    }
}

/* -------------------- UTIL INTI -------------------- */

/** Folder per jenis (relatif dari base_dir/base_url) */
if (!function_exists('berkas_kind_dir')) {
    function berkas_kind_dir(string $jenis): string
    {
        $map = [
            'radiologi' => '', // Radiologi langsung di folder upload radiologi (bukan subfolder)
            'berkasrawat' => 'berkas',
            'berkas' => 'berkas',
            'lokalis' => 'gambarmedislokalis',
        ];
        $jenis = strtolower(trim($jenis));
        return $map[$jenis] ?? 'misc';
    }
}

/** Gabung path dengan normalisasi slash */
if (!function_exists('berkas_join')) {
    function berkas_join(string ...$parts): string
    {
        $path = join('/', array_map(static function ($p) {
            $p = str_replace('\\', '/', $p);
            return trim($p, '/');
        }, $parts));
        // jangan ganggu "C:/"
        return preg_replace('#(?<!:)/{2,}#', '/', $path);
    }
}

/** Cek string adalah URL penuh */
if (!function_exists('berkas_is_url')) {
    function berkas_is_url($s): bool
    {
        return is_string($s) && preg_match('~^https?://~i', $s);
    }
}

/**
 * Konversi path DB → RELATIVE path di bawah base upload.
 * Backward-compatible:
 *   - berkas_rel($lokasi)           // jenis default 'berkas'
 *   - berkas_rel($jenis, $lokasi)   // eksplisit
 */
if (!function_exists('berkas_rel')) {
    function berkas_rel(string $a, ?string $b = null): string
    {
        // tangani mode 1-argumen
        $jenis = ($b === null) ? 'berkas' : $a;
        $lokasi = ($b === null) ? $a : $b;

        $lokasi = trim(str_replace('\\', '/', $lokasi));
        if ($lokasi === '')
            return '';

        // Tentukan kandidat yang harus di-strip
        $candidates = [
            'webapps/berkasrawat/pages/upload',
            'webapps/radiologi/pages/upload',
            'pages/upload'
        ];

        // 1) Jika URL penuh → ambil path
        if (berkas_is_url($lokasi)) {
            $pathObj = parse_url($lokasi, PHP_URL_PATH);
            if ($pathObj)
                $lokasi = $pathObj;
        }

        // 2) Strip prefix folder fisik/url jika ada
        //    (Kita coba strip kandidat dari yang terpanjang dulu biar akurat)
        //    Misal: /opt/lampp/htdocs/webapps/radiologi/pages/upload/x.jpg
        //    Atau:  /webapps/radiologi/pages/upload/x.jpg

        $docroot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
        if ($docroot && strpos($lokasi, $docroot) === 0) {
            $lokasi = substr($lokasi, strlen($docroot));
        }
        $lokasi = ltrim($lokasi, '/');

        foreach ($candidates as $cand) {
            // Cek jika diawali kandidat (case-insensitive)
            if (stripos($lokasi, $cand . '/') === 0) {
                $lokasi = substr($lokasi, strlen($cand) + 1);
                break;
            }
        }

        // 3) Normalisasi akhir: Hilangkan subfolder jenis jika dobel
        //    (Tapi radiologi sudah diset '' di berkas_kind_dir, jadi aman)
        $lokasi = ltrim($lokasi, '/');
        $kindDir = berkas_kind_dir($jenis); // misal 'berkas' atau ''

        if ($kindDir !== '') {
            $firstSeg = strtolower(strtok($lokasi, '/'));
            if ($firstSeg === strtolower($kindDir)) {
                // Sudah ada 'berkas/', jangan tambah lagi
                return $lokasi;
            }
            return berkas_join($kindDir, $lokasi);
        }

        return $lokasi;
    }
}

/**
 * Build info lengkap file dari RELATIVE path.
 * Gunakan setelah berkas_rel().
 */
if (!function_exists('berkas_build')) {
    function berkas_build(string $jenis, string $relPath): array
    {
        $CI = &get_instance();
        $relPath = ltrim(str_replace('\\', '/', $relPath), '/');

        // --- LOGIC BASE: BEDA BUCKET PER JENIS ---
        $docroot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
        $host = $_SERVER['HTTP_HOST'] ?? '127.0.0.1';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';

        if ($jenis === 'radiologi') {
            // Radiologi punya folder sendiri di luar berkasrawat
            $baseDir = $docroot . '/webapps/radiologi/pages/upload';
            $baseUrl = $scheme . $host . '/webapps/radiologi/pages/upload';
        } else {
            // Default (berkasrawat)
            $baseDir = berkas_base_dir();
            $baseUrl = berkas_base_url();
        }

        $absPath = $baseDir . '/' . $relPath;

        $mode = berkas_storage_mode();
        if ($mode === 'public' || $mode === 'hybrid') {
            $url = rtrim($baseUrl, '/') . '/' . $relPath;
        } else {
            // PRIVATE: arahkan ke endpoint downloader jika perlu
            $url = site_url('berkas/open?jenis=' . rawurlencode($jenis) . '&path=' . rawurlencode($relPath));
        }

        $exists = is_file($absPath);
        $ext = strtolower(pathinfo($absPath, PATHINFO_EXTENSION));
        $is_img = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'], true);
        $is_pdf = ($ext === 'pdf');

        $mime = null;
        if ($exists && function_exists('mime_content_type')) {
            $mime = @mime_content_type($absPath) ?: null;
        } elseif ($is_img) {
            $mime = 'image/' . $ext;
        } elseif ($is_pdf) {
            $mime = 'application/pdf';
        }

        return [
            'relative' => $relPath,
            'absolute' => $absPath,
            'url' => $url,
            'exists' => $exists ? 1 : 0,
            'is_image' => $is_img ? 1 : 0,
            'is_pdf' => $is_pdf ? 1 : 0,
            'ext' => $ext,
            'mime' => $mime,
        ];
    }
}

/** Cek keberadaan file (mendukung 1 atau 2 argumen) */
if (!function_exists('berkas_exists')) {
    function berkas_exists(string $a, ?string $b = null): bool
    {
        $rel = ($b === null) ? berkas_rel($a) : berkas_rel($a, $b);
        $baseDir = berkas_base_dir();
        $absPath = $baseDir . '/' . ltrim($rel, '/');
        return is_file($absPath);
    }
}

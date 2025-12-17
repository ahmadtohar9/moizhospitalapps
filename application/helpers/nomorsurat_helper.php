<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper: nomorsurat_helper
 * Format default: 001/{JENIS}/{KODE_RS}/{BULAN_ROMAWI}/{TAHUN}
 * Contoh: 001/SKS/PBEC/X/2025
 *
 * Cara pakai (contoh Surat Sakit):
 *   $noSurat = generate_nomor_surat('SKS', 'PBEC', 'moiz_surat_sakit', 'nomor_surat');
 *   // hasil: 001/SKS/PBEC/X/2025
 *
 * Jika belum ada tabelnya:
 *   $noSurat = generate_nomor_surat('SKS', 'PBEC'); // mulai dari 001
 */

if (!function_exists('generate_nomor_surat')) {
    /**
     * Generate nomor surat dengan opsi membaca counter terakhir dari tabel target (tanpa tabel khusus nomor).
     *
     * @param string      $jenis         Kode jenis surat (mis. 'SKS', 'SKR', 'SKC')
     * @param string      $kode_rs       Kode RS/Klinik (mis. 'PBEC')
     * @param string|null $table         (Opsional) Nama tabel target yang menyimpan nomor surat (mis. 'moiz_surat_sakit')
     * @param string      $column        (Opsional) Nama kolom nomor surat di tabel target (default 'nomor_surat')
     * @param string|null $date          (Opsional) Tanggal referensi 'Y-m-d' (default: hari ini)
     * @param int         $pad_width     (Opsional) Lebar padding nomor (default: 3 → 001)
     * @param bool        $with_label    (Opsional) true → kembalikan "No : 001/..." ; false → "001/..."
     * @return string
     */
    function generate_nomor_surat(
        string $jenis,
        string $kode_rs,
        ?string $table = null,
        string $column = 'nomor_surat',
        ?string $date = null,
        int $pad_width = 3,
        bool $with_label = false
    ) {
        $CI =& get_instance();

        $date   = $date ?: date('Y-m-d');
        $tahun  = (int)date('Y', strtotime($date));
        $bulan  = (int)date('n', strtotime($date));
        $romawi = romawi_bulan($bulan);

        // 1) Tentukan counter awal
        $counter = 1;

        // 2) Jika ada tabel target, coba baca counter terakhir per (jenis, tahun)
        if ($table) {
            try {
                // Pola filter: .../{JENIS}/{KODE_RS}/.../{TAHUN}
                // Contoh LIKE: "%/SKS/%/2025"
                $like_pattern = "%/{$jenis}/%/{$tahun}";

                // Ambil hanya kolom nomor untuk efisiensi
                $CI->db->select($column, false);
                $CI->db->from($table);
                $CI->db->like($column, $like_pattern, 'both');
                // (opsional) bisa tambah filter status kalau perlu:
                // $CI->db->where('status <>', 'batal');

                $query = $CI->db->get();

                $max_found = 0;
                foreach ($query->result_array() as $row) {
                    $nomor = (string)$row[$column];
                    $first = ekstrak_counter_nomor($nomor); // ambil segmen pertama sebelum '/'
                    if ($first !== null) {
                        $val = (int)$first;
                        if ($val > $max_found) $max_found = $val;
                    }
                }
                if ($max_found > 0) {
                    $counter = $max_found + 1;
                }
            } catch (\Throwable $e) {
                // Jika gagal baca (tabel/kolom belum ada), fallback ke counter=1
                log_message('error', '[nomorsurat_helper] Gagal membaca counter dari tabel: ' . $e->getMessage());
            }
        }

        // 3) Rakit nomor
        $prefix = str_pad((string)$counter, $pad_width, '0', STR_PAD_LEFT);
        $nomor  = "{$prefix}/{$jenis}/{$kode_rs}/{$romawi}/{$tahun}";

        return $with_label ? ("No : " . $nomor) : $nomor;
    }
}

if (!function_exists('romawi_bulan')) {
    /**
     * Konversi angka bulan (1..12) ke Romawi (I..XII)
     * @param int $bulan
     * @return string
     */
    function romawi_bulan(int $bulan): string
    {
        static $map = [
            1=>'I', 2=>'II', 3=>'III', 4=>'IV', 5=>'V', 6=>'VI',
            7=>'VII', 8=>'VIII', 9=>'IX', 10=>'X', 11=>'XI', 12=>'XII'
        ];
        return $map[$bulan] ?? '';
    }
}

if (!function_exists('ekstrak_counter_nomor')) {
    /**
     * Ambil segmen angka pertama sebelum '/' dari string nomor.
     * Contoh input: "012/SKS/PBEC/X/2025" → return "012"
     * @param string $nomor
     * @return string|null
     */
    function ekstrak_counter_nomor(string $nomor): ?string
    {
        // Ambil sampai slash pertama
        $pos = strpos($nomor, '/');
        if ($pos === false) return null;
        $first = substr($nomor, 0, $pos);
        // Validasi numeric
        $first = trim($first);
        if ($first === '' || !ctype_digit(str_replace([' ', "\t"], '', $first))) {
            return null;
        }
        return $first;
    }
}

if (!function_exists('preview_nomor_surat')) {
    /**
     * Preview nomor surat berikutnya (helper util), tanpa label "No : "
     * @param string      $jenis
     * @param string      $kode_rs
     * @param string|null $table
     * @param string      $column
     * @param string|null $date
     * @param int         $pad_width
     * @return string
     */
    function preview_nomor_surat(
        string $jenis,
        string $kode_rs,
        ?string $table = null,
        string $column = 'nomor_surat',
        ?string $date = null,
        int $pad_width = 3
    ) {
        return generate_nomor_surat($jenis, $kode_rs, $table, $column, $date, $pad_width, false);
    }
}

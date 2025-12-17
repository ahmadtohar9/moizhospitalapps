<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('poli_slug')) {
  function poli_slug($nm_poli) {
    $s = strtolower(trim((string)$nm_poli));

    // hapus prefix umum
    $s = preg_replace('/^(pol(i|iklinik)\s+)/u', '', $s); // "poli " / "poliklinik "
    // ganti &/+/– dengan spasi
    $s = preg_replace('/[&+–—]+/u', ' ', $s);
    // buang karakter non huruf/angka/spasi
    $s = preg_replace('/[^a-z0-9\s\-]/u', '', $s);
    // spasi -> dash tunggal
    $s = preg_replace('/\s+/u', '-', $s);
    $s = preg_replace('/-+/', '-', $s);
    return trim($s, '-'); // contoh: "mata", "kandungan-kebidanan"
  }
}

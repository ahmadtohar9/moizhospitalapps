<?php
/** @var array $detail_pasien */
/** @var string|null $kd_poli */

$nm = $detail_pasien['nm_poli'] ?? '';           // contoh: "Poliklinik Mata"
$slug = function_exists('poli_slug') ? poli_slug($nm) : 'default';

// Path kandidat berdasar slug
$view_candidate = "perawat/assesmen/{$slug}";    // views/perawat/assesmen/{slug}.php
$js_candidate   = "assets/js/perawat/assesmen_{$slug}.js";

// Cek keberadaan file
$view_exists = file_exists(APPPATH . "views/{$view_candidate}.php");
$js_exists   = file_exists(FCPATH   . $js_candidate);

// Fallback ke default bila view nggak ada
$view_to_load = $view_exists ? $view_candidate : 'perawat/assesmen/default';
$js_to_load   = $js_exists   ? $js_candidate   : 'assets/js/perawat/assesmen_default.js';

// Render view spesifik / default
$this->load->view($view_to_load, get_defined_vars());

// Inject JS-nya
echo '<script src="'.base_url($js_to_load).'"></script>';

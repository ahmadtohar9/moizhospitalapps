<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BPJS Configuration
 * 
 * Config untuk BPJS VClaim dan Antrean
 */

$config['bpjs'] = [
    // Credentials
    'cons_id' => '15174',
    'secret_key' => 'EvuxgRoLkv',

    // VClaim
    'user_key_vclaim' => '3c09584911b4b1c67588063351952cc1',
    'base_url_vclaim' => 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev',

    // Antrean (if needed)
    'user_key_antrol' => '3c09584911b4b1c67588063351952cc1',
    'base_url_antrol' => 'https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev',

    // Default
    'user_key' => '3c09584911b4b1c67588063351952cc1',
    'base_url' => 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev',
];




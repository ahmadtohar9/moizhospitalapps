<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('response_json')) {
  function response_json($payload = [], $code = 200)
  {
    $CI = &get_instance();

    if (isset($CI->security)) {
      $payload['csrfToken'] = $CI->security->get_csrf_hash();
      $payload['csrfName']  = $CI->security->get_csrf_token_name();
    }

    $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
    if ($json === false) {
      $json = json_encode(
        ['status'=>'error','message'=>'Encoding JSON gagal','_raw'=>$payload],
        JSON_UNESCAPED_UNICODE
      );
      $code = 500;
    }

    return $CI->output
      ->set_status_header($code)
      ->set_content_type('application/json')
      ->set_output($json);
  }
}

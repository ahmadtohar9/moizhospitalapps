<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['berkas'] = [
  'storage_mode'     => 'hybrid',
  // SESUAIKAN PATH FISIK DI MAC:
  'base_dir_private' => '/Applications/XAMPP/xamppfiles/htdocs/webapps/berkasrawat/pages/upload',
  // SESUAIKAN URL PUBLIK:
  'base_url_public'  => 'http://127.0.0.1/webapps/berkasrawat/pages/upload',
  'thumb_dir'        => '',
  'max_upload_mb'    => 20,
  'allowed_mime'     => ['image/jpeg','image/png','application/pdf'],
  'https_required'   => false,
  'once_only_default'=> false,
];


<?php
class Test extends CI_Controller {
    public function index() {
        echo 'BASE URL: ' . base_url() . PHP_EOL;
        echo 'SITE URL (operasi/cari_dokter): ' . site_url('operasi/cari_dokter') . PHP_EOL;
    }
}


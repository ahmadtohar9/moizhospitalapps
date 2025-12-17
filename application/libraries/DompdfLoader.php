<?php
require_once APPPATH . 'libraries/Dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class DompdfLoader {
    public function __construct() {
        // Initialize Dompdf
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true); // Aktifkan remote resources
        $this->dompdf = $dompdf;
    }

    public function load($html) {
        $this->dompdf->loadHtml($html);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = []) {
        $this->dompdf->stream($filename, $options);
    }
}

<?php
require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Penting untuk load gambar dari URL
        parent::__construct($options);
    }

    public function load_view($view, $data = [], $filename = 'document', $paper = 'A4', $orientation = 'portrait')
    {
        $CI = &get_instance();
        $html = $CI->load->view($view, $data, TRUE);

        // Inline CSS tambahan agar layout lebih stabil dan tidak potong gambar
        $inline_css = '<style>
            body { margin: 10px; font-family: Arial, sans-serif; font-size: 11px; }
            .section { page-break-inside: avoid; }
        </style>';

        $html = $inline_css . $html;

        // Ubah ukuran jadi F4 jika diminta
        if (strtolower($paper) == 'f4') {
            $paper = [0, 0, 595.28, 935.43]; // F4: 210mm x 330mm
        }

        $this->setPaper($paper, $orientation);
        $this->loadHtml($html);
        $this->render();
        $this->stream($filename . ".pdf", array("Attachment" => false)); // tampilkan inline
    }
}

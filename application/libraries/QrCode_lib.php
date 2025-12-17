<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/phpqrcode/qrlib.php');

class QrCode_lib
{
    public function generate($data, $filepath, $size = 4, $margin = 2)
    {
        QRcode::png($data, $filepath, QR_ECLEVEL_L, $size, $margin);
    }
}

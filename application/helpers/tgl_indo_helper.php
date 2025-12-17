<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array(
            'Minggu', 'Senin', 'Selasa', 'Rabu',
            'Kamis', 'Jumat', 'Sabtu'
        );
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        if (!$tanggal || $tanggal == '0000-00-00') {
            return '-';
        }

        $pecahkan = explode('-', $tanggal);
        $tgl = (int) $pecahkan[2];
        $bln = (int) $pecahkan[1];
        $thn = $pecahkan[0];

        $tanggal_indo = $tgl . ' ' . $bulan[$bln] . ' ' . $thn;

        if ($cetak_hari) {
            $nama_hari = date('w', strtotime($tanggal));
            return $hari[$nama_hari] . ', ' . $tanggal_indo;
        }

        return $tanggal_indo;
    }
}

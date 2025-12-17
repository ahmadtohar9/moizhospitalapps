<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper 48Jam
 * Untuk validasi apakah data masih dalam batas 48 jam
 * dan untuk validasi kepemilikan data (nip).
 */

/**
 * Cek apakah data masih dalam batas waktu.
 *
 * @param string $tgl_perawatan (format YYYY-MM-DD)
 * @param string $jam_rawat     (format HH:MM:SS)
 * @param int    $secondsLimit  default 172800 (2x24 jam)
 * @return array ['ok'=>bool,'code'=>string]
 */
function cekBatas48Jam($tgl_perawatan, $jam_rawat, $secondsLimit = 172800)
{
    if (!$tgl_perawatan || !$jam_rawat) {
        return ['ok'=>false,'code'=>'bad_request'];
    }

    $ts = strtotime($tgl_perawatan.' '.$jam_rawat);
    if (!$ts) {
        return ['ok'=>false,'code'=>'invalid_datetime'];
    }

    if ((time() - $ts) > $secondsLimit) {
        return ['ok'=>false,'code'=>'expired_48h'];
    }

    return ['ok'=>true,'code'=>'ok'];
}

/**
 * Cek apakah data dimiliki user yang login.
 *
 * @param string $nipData   → NIP pemilik data (dari row tabel)
 * @param string $nipLogin  → NIP user login
 * @return array ['ok'=>bool,'code'=>string]
 */
function cekOwnerData($nipData, $nipLogin)
{
    if (!$nipLogin) {
        return ['ok'=>false,'code'=>'no_login'];
    }
    if ($nipData !== $nipLogin) {
        return ['ok'=>false,'code'=>'not_owner'];
    }
    return ['ok'=>true,'code'=>'ok'];
}

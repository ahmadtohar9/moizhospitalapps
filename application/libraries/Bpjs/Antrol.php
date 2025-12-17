<?php

defined('BASEPATH') OR exit('No direct script access allowed');


	class Antrol {


	/** @var CI_Controller */
	private $CI;
	/** @var Bpjs_service */
	private $bpjs;


	public function __construct()
	{
	$this->CI =& get_instance();
	// Load Bpjs_service but gunakan service_type 'antrol' supaya user_key & base_url benar
	$this->CI->load->library('bpjs_service', ['service_type' => 'antrol']);
	$this->bpjs = $this->CI->bpjs_service;


	log_message('debug', '[Antrol] library initialized. cons_id=' . substr($this->bpjs->get_cons_id(),0,6));
	}


	/**
	* Contoh: mendapatkan daftar poli / antrean
	* Endpoint bisa berbeda tergantung dokumentasi BPJS antrean
	* Misal: antreanrs/poli/{kodePoli}/tanggal/{yyyy-mm-dd}
	*/
	public function daftar_poli($kode_poli = 'INT', $tanggal = null, $timestamp = null)
	{
	$tanggal = $tanggal ?? date('Y-m-d');
	$endpoint = 'poli/' . urlencode($kode_poli) . '/tanggal/' . $tanggal; // sesuaikan bila doc beda
	return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}


	/**
	* Contoh: daftar antrean baru (pendaftaran)
	* POST .../antrean
	* $data sesuai payload antrol BPJS
	*/
	public function antrean_daftar(array $data, $timestamp = null)
	{
	$endpoint = 'antrean';
	return $this->bpjs->send_request($endpoint, 'POST', $data, $timestamp);
	}


	/**
	* Contoh: cek status antrean
	*/
	public function antrean_status($no_antrean, $timestamp = null)
	{
	$endpoint = 'antrean/' . urlencode($no_antrean);
	return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}


	/**
	* Generic helper to call arbitrary Antrol endpoint
	*/
}
?>
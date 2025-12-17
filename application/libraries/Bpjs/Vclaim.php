<?php
// File: application/libraries/Vclaim.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vclaim
{
	private $CI;
	private $bpjs;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('Bpjs/bpjs_service', ['service_type' => 'vclaim']);
		$this->bpjs = $this->CI->bpjs_service;
	}

	public function referensi_poli($param = null, $timestamp = null)
	{
		$endpoint = 'referensi/poli' . ($param ? '/' . urlencode($param) : '');
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_dokter_pelayanan($pelayanan = null, $tglPelayanan = null, $spesialis = null, $timestamp = null)
	{
		$parts = [];
		if ($pelayanan !== null && trim($pelayanan) !== '')
			$parts[] = 'pelayanan/' . urlencode(trim($pelayanan));
		if ($tglPelayanan !== null && trim($tglPelayanan) !== '')
			$parts[] = 'tglPelayanan/' . urlencode(trim($tglPelayanan));
		if ($spesialis !== null && trim($spesialis) !== '')
			$parts[] = 'Spesialis/' . urlencode(trim($spesialis));
		$endpoint = 'referensi/dokter';
		if (!empty($parts))
			$endpoint .= '/' . implode('/', $parts);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function rencanakontrol_by_surat($noSurat, $timestamp = null)
	{
		$noSurat = trim((string) $noSurat);
		if ($noSurat === '')
			return ['metaData' => ['code' => 400, 'message' => 'Parameter kosong']];
		$endpoint = 'RencanaKontrol/noSuratKontrol/' . urlencode($noSurat);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function peserta_nokartu($noKartu, $tglSep = null, $timestamp = null)
	{
		$noKartu = trim((string) $noKartu);
		if ($noKartu === '')
			return ['metaData' => ['code' => 400, 'message' => 'Nomor Kartu kosong']];
		if ($tglSep === null)
			$tglSep = date('Y-m-d');

		$endpoint = 'Peserta/nokartu/' . urlencode($noKartu) . '/tglSEP/' . urlencode($tglSep);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function peserta_nik($nik, $tglSep = null, $timestamp = null)
	{
		$nik = trim((string) $nik);
		if ($nik === '')
			return ['metaData' => ['code' => 400, 'message' => 'NIK kosong']];
		if ($tglSep === null)
			$tglSep = date('Y-m-d');

		$endpoint = 'Peserta/nik/' . urlencode($nik) . '/tglSEP/' . urlencode($tglSep);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_diagnosa($keyword, $timestamp = null)
	{
		$keyword = trim($keyword);
		if (empty($keyword))
			return ['metaData' => ['code' => 400, 'message' => 'Keyword kosong']];
		$endpoint = 'referensi/diagnosa/' . urlencode($keyword);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_faskes($nama, $jenis, $timestamp = null)
	{
		$nama = trim($nama);
		$jenis = trim($jenis); // 1 or 2
		if (empty($nama) || empty($jenis))
			return ['metaData' => ['code' => 400, 'message' => 'Parameter kurang']];

		$endpoint = 'referensi/faskes/' . urlencode($nama) . '/' . urlencode($jenis);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function insert_sep($data)
	{
		return $this->bpjs->insert_sep_v2($data);
	}

	public function update_sep($data)
	{
		return $this->bpjs->update_sep_v2($data);
	}

	public function referensi_spesialis($timestamp = null)
	{
		$endpoint = 'referensi/spesialis';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_propinsi($timestamp = null)
	{
		$endpoint = 'referensi/propinsi';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_kabupaten($kodePropinsi, $timestamp = null)
	{
		$endpoint = 'referensi/kabupaten/propinsi/' . urlencode($kodePropinsi);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_diagnosa_prb($timestamp = null)
	{
		$endpoint = 'referensi/diagnosaprb';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_kecamatan($kodeKabupaten, $timestamp = null)
	{
		$endpoint = 'referensi/kecamatan/kabupaten/' . urlencode($kodeKabupaten);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_prosedur($keyword, $timestamp = null)
	{
		$keyword = trim($keyword);
		if (empty($keyword))
			return ['metaData' => ['code' => 400, 'message' => 'Keyword kosong']];
		// BPJS VClaim usually uses 'referensi/tindakan' or 'referensi/procedure'
		$endpoint = 'referensi/tindakan/' . urlencode($keyword);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_obat_prb($keyword, $timestamp = null)
	{
		$keyword = trim($keyword);
		if (empty($keyword))
			return ['metaData' => ['code' => 400, 'message' => 'Keyword kosong']];
		$endpoint = 'referensi/obatprb/' . urlencode($keyword);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_cara_keluar($timestamp = null)
	{
		$endpoint = 'referensi/carakeluar';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_kelas_rawat($timestamp = null)
	{
		$endpoint = 'referensi/kelasrawat';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function referensi_ruang_rawat($timestamp = null)
	{
		$endpoint = 'referensi/ruangrawat';
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function delete_sep($noSep, $user)
	{
		$payload = [
			'request' => [
				't_sep' => [
					'noSep' => $noSep,
					'user' => $user
				]
			]
		];
		// Content-Type: Application/x-www-form-urlencoded (Wait, VClaim usually uses JSON or text/plain body)
		// SepController uses 'insert' logic. Let's assume send_request handles it.
		// Usually VClaim 2.0 uses DELETE method.
		// Revert to 'SEP/2.0/delete' based on Postman success
		// Pass array to let service handle encoding and Content-Type matching
		return $this->bpjs->send_request('SEP/2.0/delete', 'DELETE', $payload);
	}

	public function rujukan_list_pcare($noKartu, $timestamp = null)
	{
		$noKartu = trim((string) $noKartu);
		if ($noKartu === '')
			return ['metaData' => ['code' => 400, 'message' => 'Nomor Kartu kosong']];
		$endpoint = 'Rujukan/List/Peserta/' . urlencode($noKartu);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}

	public function rujukan_list_rs($noKartu, $timestamp = null)
	{
		$noKartu = trim((string) $noKartu);
		if ($noKartu === '')
			return ['metaData' => ['code' => 400, 'message' => 'Nomor Kartu kosong']];
		$endpoint = 'Rujukan/RS/List/Peserta/' . urlencode($noKartu);
		return $this->bpjs->send_request($endpoint, 'GET', null, $timestamp);
	}
}

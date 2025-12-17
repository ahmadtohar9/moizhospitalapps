<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SepController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Bpjs/vclaim');
        $this->load->database();
        $this->load->model('Pendaftaran/RegPeriksaModel');

        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }
    }

    public function insert()
    {
        // 1. Collect Input Data
        $no_rawat = $this->input->post('no_rawat');
        if (empty($no_rawat)) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak ditemukan']);
            return;
        }

        // 2. Validate Existence in reg_periksa
        //    Logic Update: If NOT exist, INSERT it now (Auto-Register)
        $reg = $this->RegPeriksaModel->get_by_no_rawat($no_rawat);

        if (!$reg) {
            // Auto Register Logic

            // 2a. Attempt to map BPJS Codes to Local Codes if missing
            $reg_kd_dokter = $this->input->post('reg_kd_dokter');
            $reg_kd_poli = $this->input->post('reg_kd_poli');

            // Map Dokter
            if (empty($reg_kd_dokter)) {
                $bpjs_dr_code = $this->input->post('dpjp_layan');
                if ($bpjs_dr_code) {
                    $map_dr = $this->db->get_where('maping_dokter_dpjpvclaim', ['kd_dokter_bpjs' => $bpjs_dr_code])->row();
                    if ($map_dr)
                        $reg_kd_dokter = $map_dr->kd_dokter;
                }
            }

            // Map Poli
            if (empty($reg_kd_poli)) {
                $bpjs_poli_code = $this->input->post('poli_kode'); // poli_tujuan code from form
                if ($bpjs_poli_code) {
                    $map_poli = $this->db->get_where('maping_poli_bpjs', ['kd_poli_bpjs' => $bpjs_poli_code])->row();
                    if ($map_poli)
                        $reg_kd_poli = $map_poli->kd_poli_rs;
                }
            }

            // Map KD PJ (Cara Bayar) - Fix FK Error 1452
            $reg_kd_pj = $this->input->post('reg_kd_pj');
            if (empty($reg_kd_pj)) {
                // 1. Try to get from Patient Data
                $pasien = $this->db->get_where('pasien', ['no_rkm_medis' => $this->input->post('reg_no_rkm_medis')])->row();
                if ($pasien && !empty($pasien->kd_pj)) {
                    $reg_kd_pj = $pasien->kd_pj;
                } else {
                    // 2. Default to 'BPJ' (BPJS Kesehatan) since we are creating SEP
                    $reg_kd_pj = 'BPJ';
                }
            }

            // Validate Mappings
            if (empty($reg_kd_dokter)) {
                echo json_encode(['status' => 'error', 'message' => 'Gagal Auto-Register: Dokter belum dipilih atau belum dimapping ke sistem lokal.']);
                return;
            }
            if (empty($reg_kd_poli)) {
                echo json_encode(['status' => 'error', 'message' => 'Gagal Auto-Register: Poliklinik belum dipilih atau belum dimapping ke sistem lokal.']);
                return;
            }

            $reg_data = [
                'no_reg' => $this->RegPeriksaModel->get_next_no_reg(
                    $reg_kd_poli,
                    $reg_kd_dokter,
                    $this->input->post('reg_tgl_registrasi')
                ),
                'no_rawat' => $no_rawat,
                'tgl_registrasi' => $this->input->post('reg_tgl_registrasi') ?: date('Y-m-d'),
                'jam_reg' => $this->input->post('reg_jam_reg') ?: date('H:i:s'),
                'kd_dokter' => $reg_kd_dokter,
                'no_rkm_medis' => $this->input->post('reg_no_rkm_medis'),
                'kd_poli' => $reg_kd_poli,
                'p_jawab' => $this->input->post('reg_pj'),
                'almt_pj' => $this->input->post('reg_alamat_pj'),
                'hubunganpj' => $this->input->post('reg_hubungan'),
                'biaya_reg' => 0,
                'stts' => 'Belum',
                'stts_daftar' => $this->input->post('reg_stts_daftar') ?: 'Lama',
                'status_lanjut' => 'Ralan',
                'kd_pj' => $reg_kd_pj,
                'umurdaftar' => 0,
                'sttsumur' => 'Th',
                'status_bayar' => 'Belum Bayar'
            ];

            // Validate Essential Reg Data
            if (empty($reg_data['no_rkm_medis'])) {
                echo json_encode(['status' => 'error', 'message' => 'Gagal Auto-Register: Data Pasien tidak lengkap.']);
                return;
            }

            // Insert Registration
            $this->db->insert('reg_periksa', $reg_data);

            // Re-check to ensure insertion worked
            // $reg = $this->RegPeriksaModel->get_by_no_rawat($no_rawat);
        }

        // 3. Prepare SEP Data for VClaim 2.0 (t_sep)
        $user_id = $this->session->userdata('nama_user');
        if (empty($user_id))
            $user_id = 'Admin';

        $naikKelasVal = $this->input->post('naik_kelas');
        $isNaik = ($naikKelasVal != '' && $naikKelasVal != 'Tidak');

        $data = [
            'noKartu' => $this->input->post('no_kartu') ?? '',
            'tglSep' => $this->input->post('tgl_sep') ?: date('Y-m-d'),
            'ppkPelayanan' => substr($this->input->post('ppk_pelayanan_kode') ?? '', 0, 8),
            'jnsPelayanan' => $this->input->post('jns_pelayanan') ?? '',
            'klsRawat' => [
                'klsRawatHak' => $this->input->post('kls_rawat_hak') ?? '',
                'klsRawatNaik' => $isNaik ? $naikKelasVal : '',
                'pembiayaan' => $isNaik ? ($this->input->post('pembiayaan') ?? '') : '',
                'penanggungJawab' => $isNaik ? ($this->input->post('penanggung_jawab') ?? '') : ''
            ],
            'noMR' => $this->input->post('no_mr') ?? '',
            'rujukan' => [
                'asalRujukan' => $this->input->post('asal_rujukan') ?? '',
                'tglRujukan' => $this->input->post('tgl_rujukan') ?? '',
                'noRujukan' => $this->input->post('no_rujukan') ?? '',
                'ppkRujukan' => $this->input->post('ppk_rujukan_kode') ?? ''
            ],
            'catatan' => $this->input->post('catatan') ?? '',
            'diagAwal' => $this->input->post('diagnosa_kode') ?? '',
            'poli' => [
                'tujuan' => $this->input->post('poli_kode') ?? '',
                'eksekutif' => $this->input->post('eksekutif') ?? '0'
            ],
            'cob' => [
                'cob' => $this->input->post('cob') ?? '0'
            ],
            'katarak' => [
                'katarak' => $this->input->post('katarak') ?? '0'
            ],
            'jaminan' => [
                'lakaLantas' => $this->input->post('laka_lantas') ?? '0',
                'noLP' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('no_lp') ?? '') : '', // Add No LP
                'penjamin' => [
                    'tglKejadian' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('tgl_laka') ?? '') : '',
                    'keterangan' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('ket_laka') ?? '') : '',
                    'suplesi' => [
                        'suplesi' => $this->input->post('suplesi') ?? '0',
                        'noSepSuplesi' => $this->input->post('no_suplesi') ?? '',
                        'lokasiLaka' => [
                            'kdPropinsi' => $this->input->post('prov_laka') ?? '',
                            'kdKabupaten' => $this->input->post('kab_laka') ?? '',
                            'kdKecamatan' => $this->input->post('kec_laka') ?? ''
                        ]
                    ]
                ]
            ],
            'tujuanKunj' => $this->input->post('tujuan_kunjungan') ?? '0',
            'flagProcedure' => $this->input->post('flag_prosedur') ?? '',
            'kdPenunjang' => $this->input->post('penunjang') ?? '',
            'assesmentPel' => $this->input->post('asesmen_pelayanan') ?? '',
            'skdp' => [
                'noSurat' => $this->input->post('no_skdp') ?? '',
                'kodeDPJP' => $this->input->post('dpjp_skdp') ?? ''
            ],
            'dpjpLayan' => $this->input->post('dpjp_layan') ?? '',
            'noTelp' => $this->input->post('no_telp') ?: '000000000000', // Wajib ada
            'user' => $user_id
        ];

        // 4. Send to BPJS
        $response = $this->vclaim->insert_sep($data);

        if ($response['status'] == 'success') {
            $sep = $response['data'];

            // 5. Prepare Data for Local Storage (bridging_sep)
            // Mapping based on user provided schema
            $local_data = [
                'no_sep' => $sep['noSep'],
                'no_rawat' => $no_rawat,
                'tglsep' => $sep['tglSep'],
                'tglrujukan' => $data['rujukan']['tglRujukan'],
                'no_rujukan' => $data['rujukan']['noRujukan'],
                'kdppkrujukan' => $data['rujukan']['ppkRujukan'],
                'nmppkrujukan' => $this->input->post('ppk_rujukan_nama'),
                'kdppkpelayanan' => $data['ppkPelayanan'],
                'nmppkpelayanan' => $this->input->post('ppk_pelayanan_nama'),
                // FORCE use POST data because BPJS might return text (e.g. "Rawat Jalan") 
                // while DB expects Enum/Code (e.g. "2")
                'jnspelayanan' => $this->input->post('jns_pelayanan'),
                'catatan' => $sep['catatan'],
                // Split code and name for diagnosis
                'diagawal' => explode(' - ', $sep['diagnosa'])[0] ?? $sep['diagnosa'],
                'nmdiagnosaawal' => isset(explode(' - ', $sep['diagnosa'])[1]) ? explode(' - ', $sep['diagnosa'])[1] : $sep['diagnosa'],
                'kdpolitujuan' => $data['poli']['tujuan'],
                // Clean Poli Name: Take Name after " - " if exists, else take full
                'nmpolitujuan' => (function ($str) {
                    $parts = explode(' - ', $str);
                    return isset($parts[1]) ? $parts[1] : $parts[0];
                })($this->input->post('poli_nama')),
                // FORCE use POST data for Class Code
                'klsrawat' => $this->input->post('kls_rawat_hak'),
                // Fixed/Mapped Columns
                'klsnaik' => $data['klsRawat']['klsRawatNaik'],
                'pembiayaan' => $data['klsRawat']['pembiayaan'],
                'pjnaikkelas' => $data['klsRawat']['penanggungJawab'],
                'lakalantas' => $data['jaminan']['lakaLantas'],
                'user' => $data['user'],
                'nomr' => $data['noMR'],
                'nama_pasien' => $this->input->post('nama_pasien'), // From Hidden
                'tanggal_lahir' => $this->input->post('tgl_lahir'),
                // Fix Peserta: Should be 'jnsPeserta' (Segment User), fallback to local logic/empty if needed.
                // If BPJS response is empty, maybe use 'penjamin' logic or default?
                'peserta' => $sep['peserta']['jnsPeserta'] ?? '-',
                // Fix Jkel: BPJS usually returns 'kelamin', fallback to POST 'jk'
                'jkel' => $sep['peserta']['kelamin'] ?? $this->input->post('jk'),
                'no_kartu' => $sep['peserta']['noKartu'] ?? $data['noKartu'],
                'tglpulang' => '0000-00-00 00:00:00', // Default
                'asal_rujukan' => $data['rujukan']['asalRujukan'] == '1' ? '1. Faskes 1' : '2. Faskes 2(RS)', // Enum mapping? check values
                'eksekutif' => $data['poli']['eksekutif'] == '0' ? '0. Tidak' : '1.Ya',
                'cob' => $data['cob']['cob'] == '0' ? '0. Tidak' : '1.Ya',
                'notelep' => $data['noTelp'],
                'katarak' => $data['katarak']['katarak'] == '0' ? '0. Tidak' : '1.Ya',
                'tglkkl' => $data['jaminan']['penjamin']['tglKejadian'] ?: '0000-00-00',
                'keterangankkl' => $data['jaminan']['penjamin']['keterangan'],
                'suplesi' => $data['jaminan']['penjamin']['suplesi']['suplesi'] == '0' ? '0. Tidak' : '1.Ya',
                'no_sep_suplesi' => $data['jaminan']['penjamin']['suplesi']['noSepSuplesi'],
                'kdprop' => $data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdPropinsi'],
                'nmprop' => '', // Lookup name if possible, or leave empty
                'kdkab' => $data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKabupaten'],
                'nmkab' => '',
                'kdkec' => $data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKecamatan'],
                'nmkec' => '',
                'noskdp' => $data['skdp']['noSurat'],
                // Use input post directly to ensure we get what was sent, fallback to $data array
                'kddpjp' => $this->input->post('dpjp_skdp') ?? $data['skdp']['kodeDPJP'],
                // Clean Doctor Name logic: Take text BEFORE '(' (BPJS Name), remove Local Name (in parens)
                'nmdpdjp' => (function ($str) {
                    $parts = explode('(', $str);
                    return trim($parts[0]);
                })($this->input->post('nm_dpjp_skdp')),
                'tujuankunjungan' => $data['tujuanKunj'],
                'flagprosedur' => $data['flagProcedure'],
                'penunjang' => $data['kdPenunjang'],
                'asesmenpelayanan' => $data['assesmentPel'],
                'kddpjplayanan' => $data['dpjpLayan'],
                'nmdpjplayanan' => (function ($str) {
                    $parts = explode('(', $str);
                    return trim($parts[0]);
                })($this->input->post('nm_dpjp_layan')),
            ];

            // 6. Insert Local
            // We use 'replace' or 'insert'
            $this->db->replace('bridging_sep', $local_data);

            echo json_encode([
                'status' => 'success',
                'message' => 'SEP Berhasil Terbit',
                'data' => $sep
            ]);

            echo json_encode([
                'status' => 'error',
                'message' => $response['message'],
                'meta' => $response
            ]);
        }
    }

    public function update()
    {
        // 1. Collect Input Data
        $no_rawat = $this->input->post('no_rawat');
        $no_sep = $this->input->post('no_sep');
        if (empty($no_rawat) || empty($no_sep)) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat atau No SEP tidak ditemukan']);
            return;
        }

        // 3. Prepare SEP Data for VClaim 2.0 (t_sep)
        $user_id = $this->session->userdata('nama_user');
        if (empty($user_id))
            $user_id = 'Admin';

        $naikKelasVal = $this->input->post('naik_kelas');
        $isNaik = ($naikKelasVal != '' && $naikKelasVal != 'Tidak');

        $data = [
            'noSep' => $no_sep, // Wajib untuk Update
            'klsRawat' => [
                'klsRawatHak' => $this->input->post('kls_rawat_hak') ?? '',
                'klsRawatNaik' => $isNaik ? $naikKelasVal : '',
                'pembiayaan' => $isNaik ? ($this->input->post('pembiayaan') ?? '') : '',
                'penanggungJawab' => $isNaik ? ($this->input->post('penanggung_jawab') ?? '') : ''
            ],
            'noMR' => $this->input->post('no_mr') ?? '',
            'catatan' => $this->input->post('catatan') ?? '',
            'diagAwal' => $this->input->post('diagnosa_kode') ?? '',
            'poli' => [
                'tujuan' => $this->input->post('poli_kode') ?? '',
                'eksekutif' => $this->input->post('eksekutif') ?? '0'
            ],
            'cob' => [
                'cob' => $this->input->post('cob') ?? '0'
            ],
            'katarak' => [
                'katarak' => $this->input->post('katarak') ?? '0'
            ],
            'jaminan' => [
                'lakaLantas' => $this->input->post('laka_lantas') ?? '0',
                'noLP' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('no_lp') ?? '') : '',
                'penjamin' => [
                    'tglKejadian' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('tgl_laka') ?? '') : '',
                    'keterangan' => ($this->input->post('laka_lantas') == '1') ? ($this->input->post('ket_laka') ?? '') : '',
                    'suplesi' => [
                        'suplesi' => $this->input->post('suplesi') ?? '0',
                        'noSepSuplesi' => $this->input->post('no_suplesi') ?? '',
                        'lokasiLaka' => [
                            'kdPropinsi' => $this->input->post('prov_laka') ?? '',
                            'kdKabupaten' => $this->input->post('kab_laka') ?? '',
                            'kdKecamatan' => $this->input->post('kec_laka') ?? ''
                        ]
                    ]
                ]
            ],
            'dpjpLayan' => $this->input->post('dpjp_layan') ?? '',
            'noTelp' => $this->input->post('no_telp') ?: '000000000000',
            'user' => $user_id
        ];

        // 4. Send to BPJS
        $response = $this->vclaim->update_sep($data);

        if ($response['status'] == 'success') {
            // 5. Update Local Data (bridging_sep)
            $update_data = [
                'catatan' => $data['catatan'],
                // Update Diag if changed
                'diagawal' => $this->input->post('diagnosa_kode') ?: (explode(' - ', $this->input->post('diagnosa_txt'))[0] ?? $data['diagAwal']),
                'nmdiagnosaawal' => $this->input->post('diagnosa_nama') ?: (function ($str) {
                    $p = explode(' - ', $str);
                    return isset($p[1]) ? $p[1] : $p[0];
                })($this->input->post('diagnosa_txt')),
                'kdpolitujuan' => $data['poli']['tujuan'],
                'nmpolitujuan' => (function ($str) {
                    $p = explode(' - ', $str);
                    return isset($p[1]) ? $p[1] : $p[0];
                })($this->input->post('poli_nama')),
                'klsrawat' => $data['klsRawat']['klsRawatHak'],
                'klsnaik' => $data['klsRawat']['klsRawatNaik'],
                'pembiayaan' => $data['klsRawat']['pembiayaan'],
                'pjnaikkelas' => $data['klsRawat']['penanggungJawab'],
                'lakalantas' => $data['jaminan']['lakaLantas'],
                'eksekutif' => $data['poli']['eksekutif'] == '0' ? '0. Tidak' : '1.Ya',
                'cob' => $data['cob']['cob'] == '0' ? '0. Tidak' : '1.Ya',
                'katarak' => $data['katarak']['katarak'] == '0' ? '0. Tidak' : '1.Ya',
                'kddpjplayanan' => $data['dpjpLayan'],
                'nmdpjplayanan' => (function ($str) {
                    $p = explode('(', $str);
                    return trim($p[0]);
                })($this->input->post('nm_dpjp_layan')),
                'notelep' => $data['noTelp'],
                'user' => $user_id
            ];

            $this->db->where('no_sep', $no_sep);
            $this->db->update('bridging_sep', $update_data);

            // 6. Update reg_periksa (Sync Poli & Dokter)
            // Need Mapping from BPJS Code to RS Code

            // Map Dokter
            $reg_kd_dokter = $this->input->post('kd_dokter'); // from select2 if changed
            // If user didn't change select2, it might still necessarily change if DPJP changed.
            // But usually format UI separates them. 
            // Let's rely on form inputs 'reg_kd_dokter' and 'reg_kd_poli' if provided, or mapped.

            // Try map again if needed (like insert logic)
            $bpjs_dr_code = $data['dpjpLayan'];
            $map_dr = $this->db->get_where('maping_dokter_dpjpvclaim', ['kd_dokter_bpjs' => $bpjs_dr_code])->row();
            if ($map_dr)
                $reg_kd_dokter = $map_dr->kd_dokter;

            // Map Poli
            $bpjs_poli_code = $data['poli']['tujuan'];
            $map_poli = $this->db->get_where('maping_poli_bpjs', ['kd_poli_bpjs' => $bpjs_poli_code])->row();
            $reg_kd_poli = ($map_poli) ? $map_poli->kd_poli_rs : '';

            $reg_update = [];
            if ($reg_kd_dokter)
                $reg_update['kd_dokter'] = $reg_kd_dokter;
            if ($reg_kd_poli)
                $reg_update['kd_poli'] = $reg_kd_poli;

            if (!empty($reg_update)) {
                $this->db->where('no_rawat', $no_rawat);
                $this->db->update('reg_periksa', $reg_update);
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'SEP Berhasil Diupdate',
                'data' => $response['data']
            ]);

        } else {
            echo json_encode([
                'status' => 'error',
                'message' => $response['message'],
                'meta' => $response
            ]);
        }
    }

    public function cari_rujukan_pcare()
    {
        $no_kartu = $this->input->post('no_kartu');
        if (empty($no_kartu)) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'No Kartu Kosong']]);
            return;
        }

        $result = $this->vclaim->rujukan_list_pcare($no_kartu);
        echo json_encode($result);
    }

    public function cari_rujukan_rs()
    {
        $no_kartu = $this->input->post('no_kartu');
        if (empty($no_kartu)) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'No Kartu Kosong']]);
            return;
        }

        $result = $this->vclaim->rujukan_list_rs($no_kartu);
        echo json_encode($result);
    }

    public function get_dpjp()
    {
        $jenis = $this->input->post('pelayanan') ?: '2'; // 1=Ranap, 2=Ralan
        $tgl = $this->input->post('tgl_pelayanan') ?: date('Y-m-d');
        $spesialis = $this->input->post('spesialis');

        if (empty($spesialis)) {
            echo json_encode(['metaData' => ['code' => 400, 'message' => 'Spesialis Kosong']]);
            return;
        }

        // Use VClaim library Request
        // Endpoint: referensi/dokter/pelayanan/{jenis}/tglPelayanan/{tgl}/Spesialis/{kd}
        $result = $this->vclaim->referensi_dokter_pelayanan($jenis, $tgl, $spesialis);
        echo json_encode($result);
    }

}

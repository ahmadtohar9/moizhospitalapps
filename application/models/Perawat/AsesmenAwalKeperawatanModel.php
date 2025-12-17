<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsesmenAwalKeperawatanModel extends CI_Model
{
    protected $table = 'penilaian_awal_keperawatan_ralan';

    /** Ambil satu baris terakhir (latest) per no_rawat (opsional filter kd_poli jika disimpan di tempat lain) */
    public function get_latest($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->order_by('tanggal','DESC')
                        ->limit(1)
                        ->get($this->table)
                        ->row_array();
    }

    /** Ambil satu baris by key (no_rawat + tgl + jam) */
    public function get_by_key($no_rawat, $tgl, $jam)
    {
        $dt = $this->combine_datetime($tgl, $jam);
        return $this->db->where('no_rawat', $no_rawat)
                        ->where('tanggal', $dt)
                        ->get($this->table)
                        ->row_array();
    }

    /** Hapus by key (respect 48 jam & owner bisa di-controller) */
    public function delete_by_key($no_rawat, $tgl, $jam)
    {
        $dt = $this->combine_datetime($tgl, $jam);
        $this->db->where('no_rawat', $no_rawat)
                 ->where('tanggal', $dt)
                 ->delete($this->table);
        return $this->db->affected_rows() > 0;
    }

    /** Upsert: jika ada (no_rawat,tanggal) → update; kalau tidak → insert */
    public function upsert_from_payload(array $d, $nip_session = null)
    {
        // mapping & normalisasi dari payload FE ke kolom tabel
        $row = $this->map_payload_to_row($d, $nip_session);

        // key
        $key = [
            'no_rawat' => $row['no_rawat'],
            'tanggal'  => $row['tanggal'],
        ];

        $exist = $this->db->get_where($this->table, $key)->row_array();
        if ($exist) {
            // jangan ubah key
            $payload = $row;
            unset($payload['no_rawat'], $payload['tanggal']);
            $this->db->where($key)->update($this->table, $payload);
            return $this->db->affected_rows() >= 0;
        } else {
            $this->db->insert($this->table, $row);
            return $this->db->affected_rows() > 0;
        }
    }

    /* ======================
     * Helpers
     * ====================== */

    private function combine_datetime($tgl, $jam)
    {
        $tgl = $tgl ?: date('Y-m-d');
        $jam = $jam ?: date('H:i:s');
        return date('Y-m-d H:i:s', strtotime("$tgl $jam"));
    }

    private function map_payload_to_row(array $d, $nip_session = null)
    {
        // ---------- helpers ----------
        $cap = function ($v, int $max) {
            $s = (string)($v ?? '');
            return (mb_strlen($s) > $max) ? mb_substr($s, 0, $max) : $s;
        };
        $yn = function ($v) { return (strtolower((string)$v) === 'ya') ? 'Ya' : 'Tidak'; };
        $enum = function ($v, array $allowed, $fallback) {
            $v = (string)$v;
            return in_array($v, $allowed, true) ? $v : $fallback;
        };

        $tgl = $d['tgl_perawatan'] ?? date('Y-m-d');
        $jam = $d['jam_rawat']     ?? date('H:i:s');
        $aj  = isset($d['asesmen_json']) && is_array($d['asesmen_json']) ? $d['asesmen_json'] : [];

        // ---------- KEADAAN UMUM ----------
        $td   = $cap(trim((string)($d['tensi'] ?? '')), 8);
        $nadi = $cap($d['nadi'] ?? '', 5);
        $rr   = $cap($d['respirasi'] ?? '', 5);
        $suhu = $cap($d['suhu'] ?? '', 5);
        $gcs  = $cap($d['gcs'] ?? '', 5);

        $bb   = $cap($d['bb'] ?? '', 5);
        $tb   = $cap($d['tb'] ?? '', 5);
        $bmi  = $cap($d['imt'] ?? '', 10);

        $info = $enum(($aj['info_sumber'] ?? 'Autoanamnesis'), ['Autoanamnesis','Alloanamnesis'], 'Autoanamnesis');

        // ---------- RIWAYAT ----------
        $keluhan_utama = $cap($d['keluhan_utama'] ?? '', 150);
        $rpd = $cap(($aj['riwayat_dahulu'] ?? ''), 100);
        $rpk = $cap(($aj['riwayat_keluarga'] ?? ''), 100);
        $rpo = $cap(($aj['riwayat_pengobatan'] ?? ''), 100);
        $alergi = $cap(($d['alergi'] ?? ''), 25);

        // ---------- FUNGSIONAL ----------
        $alat_bantu_src = (string)($aj['alat_bantu'] ?? 'Tidak');
        $alat_bantu = (strtoupper($alat_bantu_src) === 'TIDAK') ? 'Tidak' : 'Ya';
        $ket_bantu_det = $aj['ket_bantu'] ?? $alat_bantu_src;
        $ket_bantu = $cap(($alat_bantu === 'Ya') ? $ket_bantu_det : '', 50);

        $prothesa = $enum(($aj['prothesa'] ?? 'Tidak'), ['Tidak','Ya'], 'Tidak');
        $ket_pro  = $cap(($prothesa === 'Ya') ? ($aj['ket_pro'] ?? '') : '', 50);

        $adl = $enum(($aj['adl'] ?? 'Mandiri'), ['Mandiri','Dibantu'], 'Mandiri');

        // ---------- PSIKO-SOSIAL ----------
        $status_psiko = $enum(($aj['psikologis'] ?? 'Tenang'), ['Tenang','Takut','Cemas','Depresi','Lain-lain'], 'Tenang');
        $ket_psiko    = $cap(($aj['ket_psiko'] ?? ''), 70); // <- FIX pakai key yang benar

        $hub_form     = strtoupper((string)($aj['hub_keluarga'] ?? 'Sendiri'));
        $hub_keluarga = in_array($hub_form, ['TIDAK ORANG TUA','LAINNYA'], true) ? 'Tidak Baik' : 'Baik';

        $tinggal_map = [
            'SENDIRI'        => 'Sendiri',
            'KELUARGA'       => 'Orang Tua',
            'ASRAMA'         => 'Lainnya',
            'SUAMI / ISTRI'  => 'Suami / Istri'
        ];
        $tinggal_src    = strtoupper((string)($aj['tinggal_dengan'] ?? 'Sendiri'));
        $tinggal_dengan = $tinggal_map[$tinggal_src] ?? 'Sendiri';
        $ket_tinggal    = $cap(($aj['ket_tinggal'] ?? ''), 40);

        $ekonomi = $enum(($aj['ekonomi'] ?? 'Baik'), ['Baik','Cukup','Kurang'], 'Baik');

        $budaya_flag = (string)($aj['budaya_perlu_diperhatikan'] ?? 'Tidak Ada');
        $budaya      = (strtoupper($budaya_flag) === 'ADA') ? 'Ada' : 'Tidak Ada';
        $ket_budaya  = $cap(($aj['ket_budaya'] ?? ''), 50); // simpan catatan jika ada

        $edukasi     = $enum(($aj['edukasi_kepada'] ?? 'Pasien'), ['Pasien','Keluarga'], 'Pasien');
        $ket_edukasi = $cap(($aj['ket_edukasi'] ?? ''), 50);

        // ---------- RISIKO JATUH ----------
        $berjalan_a = $yn($aj['fall_gait_unsteady'] ?? 'tidak');
        $berjalan_b = $yn($aj['fall_aid'] ?? 'tidak');
        $berjalan_c = $yn($aj['fall_support'] ?? 'tidak');

        $hasil_raw  = (string)($aj['fall_result'] ?? '');
        $hasil_norm = str_ireplace('Risiko', 'Resiko', $hasil_raw);
        if (stripos($hasil_norm, 'Tidak beresiko') !== false)      $hasil = 'Tidak beresiko (tidak ditemukan a dan b)';
        elseif (stripos($hasil_norm, 'rendah') !== false)          $hasil = 'Resiko rendah (ditemukan a/b)';
        else                                                       $hasil = 'Resiko tinggi (ditemukan a dan b)';
        $lapor     = $enum(($aj['fall_reported'] ?? 'Tidak'), ['Ya','Tidak'], 'Tidak');
        $ket_lapor = $cap(($aj['fall_report_time'] ?? ''), 15);

        // ---------- SKRINING GIZI ----------
        $q1_val   = (string)($aj['nutr_q1'] ?? '0');
        $q1_label = (string)($aj['nutr_q1_label'] ?? '');
        $sg1_map_by_val = [
            '0' => 'Tidak',
            '1' => 'Ya, 1-5 Kg',
            '2' => $q1_label ?: 'Tidak Yakin',
            '3' => 'Ya, 11-15 Kg',
            '4' => 'Ya, >15 Kg',
        ];
        $sg1    = $sg1_map_by_val[$q1_val] ?? 'Tidak';
        $s1     = (string)($aj['nutr_q1_score'] ?? '0');
        $nilai1 = in_array($s1, ['0','1','2','3','4'], true) ? $s1 : '0';

        $q2     = (string)($aj['nutr_q2'] ?? '0');
        $sg2    = ($q2 === '1') ? 'Ya' : 'Tidak';
        $nilai2 = (string)($aj['nutr_q2_score'] ?? ($q2 === '1' ? '1' : '0'));

        $total_hasil = max(0, min(99, (int)($aj['nutr_score'] ?? 0)));

        // ---------- NYERI ----------
        $pain_status = (string)($aj['pain_status'] ?? 'Tidak Ada Nyeri');
        $nyeri = (stripos($pain_status, 'Tidak') !== false) ? 'Tidak Ada Nyeri' : 'Nyeri Akut';

        $cause = (string)($aj['pain_cause'] ?? 'Proses Penyakit');
        if ($cause === 'Trauma')              $provokes = 'Benturan';
        elseif ($cause === 'Proses Penyakit') $provokes = 'Proses Penyakit';
        else                                  $provokes = 'Lain-lain';
        $ket_provokes = $cap(($aj['ket_provokes'] ?? ''), 40);

        $quality_fe   = (string)($aj['pain_quality'] ?? 'Seperti Tertusuk');
        $quality_enum = ['Seperti Tertusuk','Berdenyut','Teriris','Tertindih','Tertiban','Lain-lain'];
        $quality      = in_array($quality_fe, $quality_enum, true) ? $quality_fe : 'Lain-lain';
        $ket_quality  = $cap((($quality === 'Lain-lain') ? $quality_fe : ($aj['ket_quality'] ?? '')), 50);

        $lokasi      = $cap(($aj['pain_location'] ?? ''), 50);
        $menyebar    = $enum(($aj['pain_radiating'] ?? 'Tidak'), ['Tidak','Ya'], 'Tidak');
        $skala_nyeri = (string)($aj['pain_score'] ?? '0'); // '0'..'10'
        $durasi      = $cap(($aj['pain_duration'] ?? ''), 25);

        // FE → tabel
        $hilang_fe   = (string)($aj['pain_relief'] ?? 'Istirahat');
        if ($hilang_fe === 'Analgesik')      $nyeri_hilang = 'Minum Obat';
        elseif ($hilang_fe === 'Kompress')   $nyeri_hilang = 'Medengar Musik'; // sesuai enum tabel
        else                                 $nyeri_hilang = 'Istirahat';
        $ket_nyeri   = $cap(($aj['ket_nyeri'] ?? ''), 40);

        $pada_dokter = $enum(($aj['pain_reported'] ?? 'Tidak'), ['Tidak','Ya'], 'Tidak');
        $ket_dokter  = $cap(($aj['pain_report_time'] ?? ''), 15);

        // ---------- RENCANA ----------
        $rencana = $cap(($aj['rk_flat'] ?? ''), 200);

        // NIP
        $nip = (string)($d['nip'] ?? $nip_session ?? '');

        return [
            'no_rawat'       => (string)($d['no_rawat'] ?? ''),
            'tanggal'        => $this->combine_datetime($tgl, $jam),
            'informasi'      => $info,

            'td' => $td, 'nadi' => $nadi, 'rr' => $rr, 'suhu' => $suhu, 'gcs' => $gcs,
            'bb' => $bb, 'tb' => $tb, 'bmi' => $bmi,

            'keluhan_utama' => $keluhan_utama,
            'rpd' => $rpd, 'rpk' => $rpk, 'rpo' => $rpo, 'alergi' => $alergi,

            'alat_bantu' => $alat_bantu, 'ket_bantu' => $ket_bantu,
            'prothesa'   => $prothesa,   'ket_pro'    => $ket_pro,
            'adl'        => $adl,

            'status_psiko' => $status_psiko, 'ket_psiko' => $ket_psiko,
            'hub_keluarga' => $hub_keluarga,
            'tinggal_dengan' => $tinggal_dengan, 'ket_tinggal' => $ket_tinggal,
            'ekonomi' => $ekonomi, 'budaya' => $budaya, 'ket_budaya' => $ket_budaya,
            'edukasi' => $edukasi, 'ket_edukasi' => $ket_edukasi,

            'berjalan_a' => $berjalan_a, 'berjalan_b' => $berjalan_b, 'berjalan_c' => $berjalan_c,
            'hasil' => $hasil, 'lapor' => $lapor, 'ket_lapor' => $ket_lapor,

            'sg1' => $sg1, 'nilai1' => $nilai1,
            'sg2' => $sg2, 'nilai2' => $nilai2,
            'total_hasil' => $total_hasil,

            'nyeri' => $nyeri, 'provokes' => $provokes, 'ket_provokes' => $ket_provokes,
            'quality' => $quality, 'ket_quality' => $ket_quality,
            'lokasi' => $lokasi, 'menyebar' => $menyebar,
            'skala_nyeri' => (string)$skala_nyeri, 'durasi' => $durasi,
            'nyeri_hilang' => $nyeri_hilang, 'ket_nyeri' => $ket_nyeri,
            'pada_dokter' => $pada_dokter, 'ket_dokter' => $ket_dokter,

            'rencana' => $rencana,
            'nip'     => $nip
        ];
    }



}

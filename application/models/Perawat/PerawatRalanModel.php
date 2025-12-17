<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerawatRalanModel extends CI_Model
{
    /* ==========================
     *  KONFIG & UTIL
     * ========================== */

    // Kolom yang diizinkan untuk TTV (pemeriksaan_ralan)
    private $ttv_fields = [
        'no_rawat','tgl_perawatan','jam_rawat',
        'tensi','nadi','respirasi','suhu','spo2','berat','tinggi','nyeri',
        'gcs','kesadaran','keluhan','informasi',
        'nip'
    ];

    // Kolom asesmen perawat (silakan modifikasi sesuai kebutuhanmu)
    private $asesmen_fields = [
        'no_rawat','tgl_perawatan','jam_rawat',
        'keluhan_utama','riwayat_penyakit','alergi','psikososial',
        'nutrisi','risiko_jatuh','edukasi','catatan',
        'skor_nyeri','skala_nyeri','gds','imt',
        'nip'
    ];

    // Nama tabel (ubah jika kamu punya nama lain)
    private $tbl_ttv      = 'pemeriksaan_ralan';
    private $tbl_asesmen  = 'moiz_asesmen_keperawatan_ralan';
    private $tbl_tindakan = 'rawat_jl_pr'; // tindakan perawat ralan (Khanza standar)
    private $tbl_jns      = 'jns_perawatan';

    // Batas hapus/edit 48 jam
    private function _batas48jam($tgl, $jam) {
        $ts = strtotime($tgl.' '.$jam);
        if (!$ts) return false;
        return (time() - $ts) <= 172800; // 48*3600
    }

    // Ambil subset array berdasarkan whitelist kolom
    private function pick(array $src, array $whitelist) {
        $out = [];
        foreach ($whitelist as $k) {
            if (array_key_exists($k, $src)) $out[$k] = $src[$k];
        }
        return $out;
    }

    // Validasi minimal key ralan
    private function require_keys(array $d, array $keys) {
        foreach ($keys as $k) {
            if (empty($d[$k]) && $d[$k] !== '0') {
                throw new InvalidArgumentException("Field {$k} wajib diisi.");
            }
        }
    }

    public function get_pasien_rajal($start_date=null, $end_date=null, $penjab=null, $status_bayar=null, $status_periksa=null)
    {
        // pastikan builder bersih
        $this->db->reset_query();

        $this->db->select("
            r.no_rawat,
            r.no_rkm_medis,
            p.nm_pasien,
            p.tgl_lahir,
            d.nm_dokter,
            j.png_jawab,
            k.nm_poli,
            r.stts          AS status_periksa,
            r.status_bayar,
            r.tgl_registrasi,
            r.jam_reg,
            (CASE WHEN EXISTS (
                SELECT 1 FROM pemeriksaan_ralan pr
                WHERE pr.no_rawat = r.no_rawat
                LIMIT 1
            ) THEN 1 ELSE 0 END) AS has_soap
        ", false);

        $this->db->from('reg_periksa r');
        $this->db->join('pasien p',     'p.no_rkm_medis = r.no_rkm_medis');
        $this->db->join('dokter d',     'd.kd_dokter    = r.kd_dokter');
        $this->db->join('poliklinik k', 'k.kd_poli      = r.kd_poli');
        $this->db->join('penjab j',     'j.kd_pj        = r.kd_pj');

        // Filter tanggal
        if ($start_date) $this->db->where('r.tgl_registrasi >=', $start_date);
        if ($end_date)   $this->db->where('r.tgl_registrasi <=', $end_date);

        // Penjamin: dukung kd_pj ATAU png_jawab tanpa query tambahan
        if ($penjab) {
            $this->db->group_start()
                     ->where('r.kd_pj', $penjab)      // jika user kirim kd_pj
                     ->or_where('j.png_jawab', $penjab) // atau nama penjamin
                     ->group_end();
        }

        if ($status_bayar)   $this->db->where('r.status_bayar', $status_bayar);
        if ($status_periksa) $this->db->where('r.stts', $status_periksa);

        $this->db->order_by('r.tgl_registrasi', 'DESC');
        $this->db->order_by('r.jam_reg', 'DESC');

        $rows = $this->db->get()->result_array();

        // flag 'baru' (≤ 10 menit)
        $now = new DateTime();
        foreach ($rows as &$it) {
            $ts = DateTime::createFromFormat('Y-m-d H:i:s', ($it['tgl_registrasi'] ?? '').' '.($it['jam_reg'] ?? '00:00:00'));
            $it['is_baru'] = ($ts && ($now->getTimestamp() - $ts->getTimestamp() <= 600)) ? 1 : 0;
        }
        return $rows;
    }



    /* ==========================
     *  TTV — UPSERT pemeriksaan_ralan
     *  Key: (no_rawat, tgl_perawatan, jam_rawat)
     * ========================== */
    public function saveTTV(array $d)
    {
        $this->require_keys($d, ['no_rawat','tgl_perawatan','jam_rawat']);
        // Build payload aman
        $payload = $this->pick($d, $this->ttv_fields);

        // Normalisasi beberapa alias dari FE (opsional)
        if (isset($d['rr']) && !isset($payload['respirasi'])) $payload['respirasi'] = $d['rr'];
        if (isset($d['bb']) && !isset($payload['berat']))     $payload['berat']     = $d['bb'];
        if (isset($d['tb']) && !isset($payload['tinggi']))    $payload['tinggi']    = $d['tb'];
        if (isset($d['skor_nyeri']) && !isset($payload['nyeri'])) $payload['nyeri'] = $d['skor_nyeri'];

        // Tambahkan tgl_input jika kolom ada di skema kamu
        $payload['tgl_input'] = date('Y-m-d');

        $key = [
            'no_rawat'      => $d['no_rawat'],
            'tgl_perawatan' => $d['tgl_perawatan'],
            'jam_rawat'     => $d['jam_rawat'],
        ];

        $exist = $this->db->get_where($this->tbl_ttv, $key)->row_array();
        if ($exist) {
            $this->db->where($key)->update($this->tbl_ttv, $payload);
            return $this->db->affected_rows() >= 0; // 0 artinya tidak ada perubahan → tetap dianggap ok
        } else {
            $this->db->insert($this->tbl_ttv, array_merge($key, $payload));
            return $this->db->affected_rows() > 0;
        }
    }

    /* ==========================
     *  ASESMEN KEPERAWATAN — UPSERT
     *  Key: (no_rawat, tgl_perawatan, jam_rawat)
     *  Catatan: siapkan tabel moiz_asesmen_keperawatan_ralan
     * ========================== */
    public function saveAsesmen(array $d)
    {
        $this->require_keys($d, ['no_rawat','tgl_perawatan','jam_rawat']);
        $payload = $this->pick($d, $this->asesmen_fields);

        // Contoh kalkulasi IMT jika bb & tb tersedia (tb dalam cm)
        if (isset($d['bb'], $d['tb']) && is_numeric($d['bb']) && is_numeric($d['tb']) && (float)$d['tb'] > 0) {
            $tb_m = ((float)$d['tb'])/100;
            $imt  = (float)$d['bb'] / max($tb_m*$tb_m, 0.0001);
            $payload['imt'] = round($imt, 2);
        }

        $key = [
            'no_rawat'      => $d['no_rawat'],
            'tgl_perawatan' => $d['tgl_perawatan'],
            'jam_rawat'     => $d['jam_rawat'],
        ];

        $exist = $this->db->get_where($this->tbl_asesmen, $key)->row_array();
        if ($exist) {
            $this->db->where($key)->update($this->tbl_asesmen, $payload);
            return $this->db->affected_rows() >= 0;
        } else {
            $this->db->insert($this->tbl_asesmen, array_merge($key, $payload));
            return $this->db->affected_rows() > 0;
        }
    }

    /* ==========================
     *  TINDAKAN PERAWAT — INSERT rawat_jl_pr
     *  Key dupe check: (no_rawat, kd_jenis_prw, tgl_perawatan, jam_rawat, nip)
     *  Tarif diambil dari jns_perawatan:
     *    material, bhp, tarif_tindakanpr, kso, menejemen
     * ========================== */
    public function saveTindakan(array $d)
    {
        $this->require_keys($d, ['no_rawat','tgl_perawatan','jam_rawat','kd_jenis_prw','nip']);

        // Ambil komponen tarif dari jns_perawatan
        $jns = $this->db->select('kd_jenis_prw, nm_perawatan, material, bhp, tarif_tindakanpr, kso, menejemen')
                        ->get_where($this->tbl_jns, ['kd_jenis_prw' => $d['kd_jenis_prw']])
                        ->row_array();
        if (!$jns) {
            throw new InvalidArgumentException('Kode tindakan tidak ditemukan di jns_perawatan.');
        }

        $material = (float)($jns['material'] ?? 0);
        $bhp      = (float)($jns['bhp'] ?? 0);
        $tarif    = (float)($jns['tarif_tindakanpr'] ?? 0);
        $kso      = (float)($jns['kso'] ?? 0);
        $man      = (float)($jns['menejemen'] ?? 0);

        $biaya = $material + $bhp + $tarif + $kso + $man;

        $row = [
            'no_rawat'         => $d['no_rawat'],
            'kd_jenis_prw'     => $d['kd_jenis_prw'],
            'nip'              => $d['nip'], // NIP perawat pelaksana
            'tgl_perawatan'    => $d['tgl_perawatan'],
            'jam_rawat'        => $d['jam_rawat'],
            'material'         => $material,
            'bhp'              => $bhp,
            'tarif_tindakanpr' => $tarif,
            'kso'              => $kso,
            'menejemen'        => $man,
            'biaya_rawat'      => $biaya,
            'stts'             => 'Belum', // konsisten dengan pola kamu
        ];

        // Cegah duplikat
        $uniq = [
            'no_rawat'      => $row['no_rawat'],
            'kd_jenis_prw'  => $row['kd_jenis_prw'],
            'tgl_perawatan' => $row['tgl_perawatan'],
            'jam_rawat'     => $row['jam_rawat'],
            'nip'           => $row['nip'],
        ];
        $exist = $this->db->get_where($this->tbl_tindakan, $uniq)->row_array();
        if ($exist) {
            // sudah ada → tidak perlu insert ulang
            return true;
        }

        $this->db->insert($this->tbl_tindakan, $row);
        return $this->db->affected_rows() > 0;
    }

    /* ==========================
     *  LAST TTV untuk autofill (per no_rawat)
     * ========================== */
    public function getLastTTV($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)
                        ->order_by('tgl_perawatan','DESC')
                        ->order_by('jam_rawat','DESC')
                        ->limit(1)
                        ->get($this->tbl_ttv)
                        ->row_array();
    }

    /* ==========================
     *  RIWAYAT by NoRM (ringkas dari TTV)
     *  - Sesuaikan jika ingin UNION dengan asesmen/tindakan
     * ========================== */
    public function countRiwayatByNoRM($no_rkm_medis)
    {
        $sql = "SELECT COUNT(*) AS jml
                  FROM {$this->tbl_ttv} pr
                  JOIN reg_periksa rp ON rp.no_rawat = pr.no_rawat
                 WHERE rp.no_rkm_medis = ?";
        $row = $this->db->query($sql, [$no_rkm_medis])->row();
        return (int)($row->jml ?? 0);
    }

    public function getRiwayatByNoRM($no_rkm_medis, $limit=50, $offset=0)
    {
        $sql = "SELECT pr.no_rawat, pr.tgl_perawatan, pr.jam_rawat,
                       pr.tensi, pr.nadi, pr.respirasi AS rr, pr.suhu, pr.spo2,
                       pr.berat AS bb, pr.tinggi AS tb, pr.nyeri AS skor_nyeri,
                       pr.keluhan
                  FROM {$this->tbl_ttv} pr
                  JOIN reg_periksa rp ON rp.no_rawat = pr.no_rawat
                 WHERE rp.no_rkm_medis = ?
              ORDER BY pr.tgl_perawatan DESC, pr.jam_rawat DESC
                 LIMIT ? OFFSET ?";
        return $this->db->query($sql, [$no_rkm_medis, (int)$limit, (int)$offset])->result_array();
    }

    /* ==========================
     *  DELETE item (ttv / asesmen / tindakan)
     *  Param minimal:
     *    - jenis: 'ttv'|'asesmen'|'tindakan'
     *    - no_rawat, tgl_perawatan, jam_rawat
     *    - untuk tindakan: kd_jenis_prw wajib
     *  Guard:
     *    - admin bypass 48 jam & owner
     * ========================== */
    public function deleteItem(array $d, $nipLogin, $enforce48=true)
    {
        if (empty($d['jenis'])) return false;
        $jenis = $d['jenis'];

        $this->require_keys($d, ['no_rawat','tgl_perawatan','jam_rawat']);

        if ($enforce48 && !$this->_batas48jam($d['tgl_perawatan'], $d['jam_rawat'])) {
            return false; // melewati 48 jam
        }

        if ($jenis === 'ttv') {
            // cek owner jika kolom nip ada
            if ($enforce48 && $nipLogin) {
                $row = $this->db->get_where($this->tbl_ttv, [
                    'no_rawat'      => $d['no_rawat'],
                    'tgl_perawatan' => $d['tgl_perawatan'],
                    'jam_rawat'     => $d['jam_rawat'],
                ])->row_array();
                if ($row && isset($row['nip']) && $row['nip'] !== $nipLogin) return false;
            }

            $this->db->where([
                'no_rawat'      => $d['no_rawat'],
                'tgl_perawatan' => $d['tgl_perawatan'],
                'jam_rawat'     => $d['jam_rawat'],
            ])->delete($this->tbl_ttv);
            return $this->db->affected_rows() > 0;
        }

        if ($jenis === 'asesmen') {
            if ($enforce48 && $nipLogin) {
                $row = $this->db->get_where($this->tbl_asesmen, [
                    'no_rawat'      => $d['no_rawat'],
                    'tgl_perawatan' => $d['tgl_perawatan'],
                    'jam_rawat'     => $d['jam_rawat'],
                ])->row_array();
                if ($row && isset($row['nip']) && $row['nip'] !== $nipLogin) return false;
            }

            $this->db->where([
                'no_rawat'      => $d['no_rawat'],
                'tgl_perawatan' => $d['tgl_perawatan'],
                'jam_rawat'     => $d['jam_rawat'],
            ])->delete($this->tbl_asesmen);
            return $this->db->affected_rows() > 0;
        }

        if ($jenis === 'tindakan') {
            if (empty($d['kd_jenis_prw'])) throw new InvalidArgumentException('kd_jenis_prw wajib untuk menghapus tindakan.');
            // owner check
            if ($enforce48 && $nipLogin) {
                $row = $this->db->get_where($this->tbl_tindakan, [
                    'no_rawat'      => $d['no_rawat'],
                    'kd_jenis_prw'  => $d['kd_jenis_prw'],
                    'tgl_perawatan' => $d['tgl_perawatan'],
                    'jam_rawat'     => $d['jam_rawat'],
                    'nip'           => $nipLogin
                ])->row_array();
                if (!$row) return false;
            }

            $where = [
                'no_rawat'      => $d['no_rawat'],
                'kd_jenis_prw'  => $d['kd_jenis_prw'],
                'tgl_perawatan' => $d['tgl_perawatan'],
                'jam_rawat'     => $d['jam_rawat'],
            ];
            // jika owner enforced, sertakan nip
            if ($enforce48 && $nipLogin) $where['nip'] = $nipLogin;

            $this->db->where($where)->delete($this->tbl_tindakan);
            return $this->db->affected_rows() > 0;
        }

        return false;
    }
}

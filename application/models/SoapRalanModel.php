<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoapRalanModel extends CI_Model
{
    /** Nama tabel utama */
    private $table = 'pemeriksaan_ralan';

    /** Cache daftar kolom agar onlyTableFields tidak query berulang */
    private $fieldCache = null;

    /* =========================================================
     * ----------------------- UTILITIES -----------------------
     * ========================================================= */

    private function required($data, $fields){
        foreach($fields as $f){
            if(!isset($data[$f]) || $data[$f]===''){
                throw new InvalidArgumentException("Field wajib: {$f}");
            }
        }
    }

    /** Ambil hanya kolom yang ada di tabel (whitelist) */
    private function onlyTableFields($table, array $data)
    {
        if ($this->fieldCache === null) {
            $this->fieldCache = array_flip($this->db->list_fields($table));
        }
        return array_intersect_key($data, $this->fieldCache);
    }

    /* =========================================================
     * ---------------------- CREATE (SAFE) --------------------
     * ========================================================= */

    /**
     * Simpan entri SOAP baru (idempotent berdasarkan no_rawat + tgl + jam + nip)
     * Menangani semua field SOAP lengkap termasuk penilaian, instruksi, evaluasi, alergi, lingkar_perut
     */
    public function save(array $data)
    {
        unset($data['original_jam_rawat']); // noise dari FE kalau ada
        $data = $this->onlyTableFields($this->table, $data);

        // validasi minimal key
        $this->required($data, ['no_rawat','tgl_perawatan','jam_rawat','nip']);

        // idempotensi
        $exists = $this->db->get_where($this->table, [
            'no_rawat'      => $data['no_rawat'],
            'tgl_perawatan' => $data['tgl_perawatan'],
            'jam_rawat'     => $data['jam_rawat'],
            'nip'           => $data['nip'],
        ])->num_rows() > 0;

        if ($exists) {
            log_message('debug', 'Skip insert: duplikat key SOAP (idempotent).');
            return ['ok'=>true, 'skipped'=>true];
        }

        // Set default values untuk field SOAP yang mungkin kosong
        $defaultValues = [
            'keluhan' => '',
            'pemeriksaan' => '',
            'penilaian' => '',
            'rtl' => '',
            'instruksi' => '',
            'evaluasi' => '',
            'alergi' => '',
            'lingkar_perut' => '',
            'suhu_tubuh' => null,
            'tensi' => '',
            'nadi' => null,
            'respirasi' => null,
            'spo2' => null,
            'gcs' => '',
            'berat' => null,
            'tinggi' => null,
            'kesadaran' => ''
        ];

        $data = array_merge($defaultValues, $data);

        $this->db->trans_start();
        $okInsert = $this->db->insert($this->table, $data);
        $aff      = $this->db->affected_rows();
        $insertId = $this->db->insert_id();
        $this->db->trans_complete();

        if (!$okInsert || !$this->db->trans_status() || $aff < 1) {
            $dberr = $this->db->error();
            log_message('error', 'Gagal insert '.$this->table.': '.print_r($dberr,true).' data='.json_encode($data));
            return ['ok'=>false, 'error'=>'Gagal menyimpan data'];
        }

        return ['ok'=>true, 'id'=>$insertId];
    }

    /* =========================================================
     * ------------------------- UPDATE ------------------------
     * ========================================================= */

    public function updateById($id, array $data, $expectedJamRawat=null)
    {
        if (!$id) return false;

        unset($data['jam_rawat']); // jam_rawat immutable via FE
        $data = $this->onlyTableFields($this->table, $data);

        $this->db->trans_start();
        $this->db->where('id', $id);
        if ($expectedJamRawat !== null) {
            $this->db->where('jam_rawat', $expectedJamRawat); // optimistic concurrency
        }
        $okUpdate = $this->db->update($this->table, $data);
        $aff      = $this->db->affected_rows();
        $this->db->trans_complete();

        if (!$okUpdate || !$this->db->trans_status()) {
            log_message('error','DB update error: '.print_r($this->db->error(),true));
            return false;
        }
        return $aff > 0;
    }

    /**
     * Ubah jam_rawat (key) + kolom lain sekaligus, dengan guard duplikasi key baru.
     */
    public function updateKeyAndData($no_rawat, $tgl_perawatan, $old_jam, $new_jam, array $data)
    {
        // Pastikan key baru tidak bentrok
        $exists = $this->db->get_where($this->table, [
            'no_rawat'      => $no_rawat,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat'     => $new_jam
        ])->num_rows() > 0;
        if ($exists) {
            return ['ok'=>false, 'code'=>'duplicate_key'];
        }

        // Hanya kolom valid, jam_rawat diganti via ->set
        unset($data['jam_rawat']);
        $data = $this->onlyTableFields($this->table, $data);

        $this->db->trans_start();
        $this->db->where([
            'no_rawat'      => $no_rawat,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat'     => $old_jam
        ]);
        $this->db->set('jam_rawat', $new_jam);
        $ok = $this->db->update($this->table, $data);
        $aff = $this->db->affected_rows();
        $this->db->trans_complete();

        if (!$ok || !$this->db->trans_status()) {
            log_message('error','DB updateKeyAndData error: '.print_r($this->db->error(),true));
            return ['ok'=>false, 'code'=>'db_error'];
        }
        return ($aff > 0) ? ['ok'=>true] : ['ok'=>false, 'code'=>'no_change'];
    }

    /**
     * Varian update bila tabel tidak punya kolom id (pakai key komposit).
     * Handle semua field SOAP lengkap
     */
    public function updateByKey($no_rawat, $tgl_perawatan, $jam_rawat, array $data)
    {
        unset($data['jam_rawat']); // immutable
        $data = $this->onlyTableFields($this->table, $data);

        $this->db->trans_start();
        $this->db->where(compact('no_rawat','tgl_perawatan','jam_rawat'));
        $okUpdate = $this->db->update($this->table, $data);
        $aff      = $this->db->affected_rows();
        $this->db->trans_complete();

        if (!$okUpdate || !$this->db->trans_status()) {
            log_message('error','DB update error: '.print_r($this->db->error(),true));
            return false;
        }
        return $aff > 0;
    }

    /* =========================================================
     * ------------------------- DELETE ------------------------
     * ========================================================= */

    /**
     * Hapus entri dengan guard 48 jam dan opsi batasi NIP.
     */
    public function deleteByNoRawatAndTime($no_rawat, $tgl_perawatan, $jam_rawat, $nip=null, $enforce48h=true)
    {
        if(!$no_rawat || !$tgl_perawatan || !$jam_rawat) return false;

        if ($enforce48h) {
            $ts = strtotime($tgl_perawatan.' '.$jam_rawat);
            if ($ts && (time() - $ts) > 172800) { // > 48 jam
                log_message('error','Delete ditolak: melewati batas 48 jam');
                return false;
            }
        }

        $this->db->trans_start();
        $this->db->where(compact('no_rawat','tgl_perawatan','jam_rawat'));
        if ($nip) $this->db->where('nip', $nip);
        $okDelete = $this->db->delete($this->table);
        $aff      = $this->db->affected_rows();
        $this->db->trans_complete();

        if (!$okDelete || !$this->db->trans_status()) {
            log_message('error','DB delete error: '.print_r($this->db->error(),true));
            return false;
        }
        return $aff > 0;
    }

    /* =========================================================
     * -------------------------- READ -------------------------
     * ========================================================= */

    /**
     * DAPATKAN SEMUA SOAP per no_rawat (bisa >1 entri).
     * Sekarang termasuk semua field SOAP lengkap
     */
    public function getAllByNoRawat($no_rawat, $limit=null, $offset=0)
    {
        if(!$no_rawat) return [];

        $this->db->select('
            pr.no_rawat, pr.tgl_perawatan, pr.jam_rawat,
            pr.keluhan, pr.pemeriksaan, pr.penilaian, pr.rtl, 
            pr.instruksi, pr.evaluasi, pr.alergi, pr.lingkar_perut,
            pr.kesadaran, pr.suhu_tubuh, pr.tensi, pr.nadi, pr.respirasi, 
            pr.tinggi, pr.berat, pr.spo2, pr.gcs,
            pr.nip, pg.nama AS nm_petugas
        ');
        $this->db->from($this->table.' pr');
        $this->db->join('pegawai pg', 'pr.nip = pg.nik', 'left');
        $this->db->where('pr.no_rawat', $no_rawat);
        $this->db->order_by('pr.tgl_perawatan', 'DESC');
        $this->db->order_by('pr.jam_rawat', 'DESC');
        if ($limit !== null) $this->db->limit((int)$limit, (int)$offset);
        return $this->db->get()->result_array();
    }

    /** Hitung total entri SOAP per no_rawat */
    public function countByNoRawat($no_rawat)
    {
        if(!$no_rawat) return 0;
        $this->db->from($this->table);
        $this->db->where('no_rawat', $no_rawat);
        return (int)$this->db->count_all_results();
    }

    /**
     * Paket paginasi praktis: return ['items'=>[], 'total'=>N]
     */
    public function getPagedByNoRawat($no_rawat, $limit=50, $offset=0)
    {
        return [
            'items' => $this->getAllByNoRawat($no_rawat, $limit, $offset),
            'total' => $this->countByNoRawat($no_rawat),
        ];
    }

    /**
     * Riwayat lintas kunjungan (per no_rkm_medis).
     * Sekarang include field SOAP lengkap
     */
    public function getAllByNoRM($no_rkm_medis, $limit=50, $offset=0)
    {
        if(!$no_rkm_medis) return [];

        $this->db->select('
            rp.no_rkm_medis, rp.no_rawat,
            pr.tgl_perawatan, pr.jam_rawat,
            pr.keluhan, pr.pemeriksaan, pr.penilaian, pr.rtl,
            pr.instruksi, pr.evaluasi, pr.alergi,
            pr.kesadaran, pr.suhu_tubuh, pr.tensi, pr.nadi, pr.respirasi,
            pr.berat, pr.tinggi, pr.spo2, pr.gcs,
            pr.nip, pg.nama AS nm_petugas
        ');
        $this->db->from('reg_periksa rp');
        $this->db->join($this->table.' pr', 'rp.no_rawat = pr.no_rawat', 'inner');
        $this->db->join('pegawai pg', 'pr.nip = pg.nik', 'left');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('pr.tgl_perawatan', 'DESC');
        $this->db->order_by('pr.jam_rawat', 'DESC');
        if ($limit !== null) $this->db->limit((int)$limit, (int)$offset);
        return $this->db->get()->result_array();
    }

    public function countAllByNoRM($no_rkm_medis)
    {
        if(!$no_rkm_medis) return 0;
        $this->db->from('reg_periksa rp');
        $this->db->join($this->table.' pr', 'rp.no_rawat = pr.no_rawat', 'inner');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        return (int)$this->db->count_all_results();
    }

    /**
     * Ambil entri TTV terakhir (tetap ada untuk auto-fill FE).
     */
    public function getLastTTV($no_rawat)
    {
        if(!$no_rawat) return null;

        $this->db->select('
            tgl_perawatan, jam_rawat,
            suhu_tubuh, tensi, nadi, respirasi, tinggi, berat, spo2, gcs, kesadaran
        ');
        $this->db->from($this->table);
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_perawatan', 'DESC');
        $this->db->order_by('jam_rawat', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    /**
     * Ambil entri terakhir (single) per no_rawat.
     * Sekarang include semua field SOAP
     */
    public function getLastByNoRawat($no_rawat)
    {
        if(!$no_rawat) return null;
        
        $this->db->select('
            no_rawat, tgl_perawatan, jam_rawat,
            keluhan, pemeriksaan, penilaian, rtl, instruksi, evaluasi,
            alergi, lingkar_perut, suhu_tubuh, tensi, nadi, respirasi,
            tinggi, berat, spo2, gcs, kesadaran, nip
        ');
        $this->db->from($this->table);
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_perawatan', 'DESC');
        $this->db->order_by('jam_rawat', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    /* --------- Backward compatibility alias (jika JS lama pakai getHasil) --------- */

    /** DEPRECATED alias: gunakan getAllByNoRawat */
    public function getHasil($no_rawat, $limit=50, $offset=0)
    {
        return $this->getAllByNoRawat($no_rawat, $limit, $offset);
    }

    public function countHasil($no_rawat)
    {
        return $this->countByNoRawat($no_rawat);
    }

    /** DEPRECATED alias: gunakan getAllByNoRM */
    public function getRiwayatByNoRM($no_rkm_medis, $limit=50, $offset=0)
    {
        return $this->getAllByNoRM($no_rkm_medis, $limit, $offset);
    }

    public function countRiwayatByNoRM($no_rkm_medis)
    {
        return $this->countAllByNoRM($no_rkm_medis);
    }

    /* =========================================================
     * ------------------------ GET SINGLE ---------------------
     * ========================================================= */

    public function getById($id)
    {
        if(!$id) return null;
        return $this->db->get_where($this->table, ['id'=>$id])->row_array();
    }

    /**
     * Ambil detail lengkap SOAP berdasarkan key
     * Sekarang include semua field SOAP lengkap
     */
    public function getByNoRawat($no_rawat, $tgl_perawatan, $jam_rawat)
    {
        if(!$no_rawat || !$tgl_perawatan || !$jam_rawat) return null;
        
        $this->db->select('
            no_rawat, tgl_perawatan, jam_rawat,
            keluhan, pemeriksaan, penilaian, rtl, instruksi, evaluasi,
            alergi, lingkar_perut, suhu_tubuh, tensi, nadi, respirasi,
            tinggi, berat, spo2, gcs, kesadaran, nip
        ');
        return $this->db->get_where($this->table, [
            'no_rawat'      => $no_rawat,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat'     => $jam_rawat
        ])->row_array();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RujukanKeluarRalanModel extends CI_Model
{
    protected $table  = 'moiz_surat_rujukan';
    protected $pk     = 'id';
    protected $fields = [
        'no_surat','no_rawat','kd_dokter','no_rkm_medis','tgl_surat',
        'kepada_dokter','spesialis_tujuan','rs_tujuan','alamat_tujuan',
        'alasan_rujuk','anamnesa','pemeriksaan_fisik','pemeriksaan_penunjang',
        'diagnosa_sementara','tindakan','obat',
        'ttd_dokter','ttd_pasien','is_signed_by_guardian','nama_wali',
        'hubungan_wali','is_final','tgl_input'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /* ==========================================================
     * Helpers
     * ========================================================== */
    private function onlyTableFields(array $data)
    {
        $clean = [];
        foreach ($this->fields as $f) {
            if (array_key_exists($f, $data)) $clean[$f] = $data[$f];
        }
        return $clean;
    }

    /* ==========================================================
     * READ
     * ========================================================== */

    /** Ambil 1 data berdasarkan No. Rawat (single-entry policy) */
    public function getByNoRawat(string $no_rawat)
    {
        return $this->db->from($this->table)
                        ->where('no_rawat', $no_rawat)
                        ->order_by($this->pk, 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
    }

    /** Ambil 1 data berdasarkan ID */
    public function getById(int $id)
    {
        return $this->db->from($this->table)
                        ->where($this->pk, $id)
                        ->get()
                        ->row_array();
    }

    /** Cek apakah sudah ada surat untuk no_rawat */
    public function existsByNoRawat(string $no_rawat): bool
    {
        return $this->db->from($this->table)
                        ->where('no_rawat', $no_rawat)
                        ->count_all_results() > 0;
    }

    /* ==========================================================
     * CREATE
     * ========================================================== */

    /**
     * Simpan data surat rujukan keluar.
     * Expect payload sudah berisi:
     *  - no_surat (hasil helper), no_rawat, kd_dokter, no_rkm_medis,
     *  - tgl_surat, data tujuan rujukan, isi medis, dll.
     *  - is_signed_by_guardian, nama_wali, hubungan_wali, is_final (default 0),
     *  - tgl_input (NOW)
     */
    public function save(array $data): array
    {
        $payload = $this->onlyTableFields($data);

        // Retry kalau terjadi duplicate nomor_surat (jika nanti ditambah UNIQUE)
        $maxRetry = 3;
        for ($i = 0; $i < $maxRetry; $i++) {
            $this->db->trans_start();

            $this->db->insert($this->table, $payload);
            $inserted = $this->db->affected_rows() > 0;
            $id       = $inserted ? (int)$this->db->insert_id() : null;

            $this->db->trans_complete();

            if ($this->db->trans_status() === false || !$inserted) {
                if (strpos((string)$this->db->error()['message'], 'Duplicate') !== false) {
                    if (function_exists('generate_nomor_surat') && !empty($payload['tgl_surat'])) {
                        $payload['no_surat'] = generate_nomor_surat('SRK', 'PBEC', $this->table, 'no_surat', $payload['tgl_surat'], 3, false);
                    }
                    continue;
                }
                return ['ok' => false, 'error' => 'DB error saat simpan surat rujukan keluar.'];
            }

            return ['ok' => true, 'id' => $id];
        }

        return ['ok' => false, 'error' => 'Gagal mendapatkan nomor unik untuk surat rujukan keluar.'];
    }

    /* ==========================================================
     * UPDATE
     * ========================================================== */

    /**
     * Update data berdasarkan ID.
     * Catatan: controller sudah mengunci update jika is_final=1.
     */
    public function update(int $id, array $data): bool
    {
        $payload = $this->onlyTableFields($data);
        if (empty($payload)) return false;

        $this->db->where($this->pk, $id)
                 ->update($this->table, $payload);
        return $this->db->affected_rows() >= 0;
    }

    /* ==========================================================
     * DELETE
     * ========================================================== */

    public function delete(int $id): bool
    {
        $this->db->where($this->pk, $id)
                 ->delete($this->table);
        return $this->db->affected_rows() > 0;
    }

    /* ==========================================================
     * (Opsional) Helper untuk kebutuhan print
     * ========================================================== */

    /**
     * Ambil detail lengkap untuk print (JOIN tabel Khanza).
     */
    public function getForPrint(int $id)
    {
        $this->db->select('rj.*, rp.no_rawat AS rp_no_rawat, p.no_rkm_medis AS p_norm, 
                           p.nm_pasien, p.jk, p.tgl_lahir, p.alamat, p.no_tlp, d.nm_dokter')
                 ->from($this->table.' rj')
                 ->join('reg_periksa rp', 'rp.no_rawat = rj.no_rawat', 'left')
                 ->join('pasien p', 'p.no_rkm_medis = rj.no_rkm_medis', 'left')
                 ->join('dokter d', 'd.kd_dokter = rj.kd_dokter', 'left')
                 ->where('rj.'.$this->pk, $id)
                 ->limit(1);
        return $this->db->get()->row_array();
    }
}

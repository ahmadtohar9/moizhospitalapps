<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratSakitRalanModel extends CI_Model
{
    protected $table  = 'moiz_surat_sakit';
    protected $pk     = 'id';
    protected $fields = [
        'no_surat','no_rawat','kd_dokter','no_rkm_medis','tgl_surat',
        'tgl_mulai_istirahat','lama_istirahat_hari','keterangan',
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
     * Simpan data surat sakit.
     * Expect payload sudah berisi:
     *  - no_surat (hasil helper), no_rawat, kd_dokter, no_rkm_medis,
     *  - tgl_surat, tgl_mulai_istirahat, lama_istirahat_hari, keterangan (ops),
     *  - is_signed_by_guardian, nama_wali, hubungan_wali, is_final (default 0),
     *  - tgl_input (NOW)
     */
    public function save(array $data): array
    {
        $payload = $this->onlyTableFields($data);

        // Antisipasi balapan nomor_surat ringan: retry hingga 3x kalau bentrok unique (jika nanti ditambah UNIQUE)
        $maxRetry = 3;
        for ($i = 0; $i < $maxRetry; $i++) {
            $this->db->trans_start();

            $this->db->insert($this->table, $payload);
            $inserted = $this->db->affected_rows() > 0;
            $id       = $inserted ? (int)$this->db->insert_id() : null;

            $this->db->trans_complete();

            if ($this->db->trans_status() === false || !$inserted) {
                // Kalau duplicate nomor (jika ada UNIQUE), regenerate nomor_surat lalu ulangi
                if (strpos((string)$this->db->error()['message'], 'Duplicate') !== false) {
                    // regenerate nomor_surat jika controller belum melakukannya (fallback defensif)
                    if (function_exists('generate_nomor_surat') && !empty($payload['tgl_surat'])) {
                        $payload['no_surat'] = generate_nomor_surat('SKS', 'PBEC', $this->table, 'no_surat', $payload['tgl_surat'], 3, false);
                    }
                    continue;
                }
                return ['ok' => false, 'error' => 'DB error saat simpan surat sakit.'];
            }

            return ['ok' => true, 'id' => $id];
        }

        return ['ok' => false, 'error' => 'Gagal mendapatkan nomor unik untuk surat sakit.'];
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
     * (Opsional) Helper untuk kebutuhan print: join info pasien/dokter dari Khanza
     * ========================================================== */

    /**
     * Ambil detail lengkap untuk print (JOIN tabel Khanza).
     * Gunakan kalau kamu ingin 1 query ambil semua informasi.
     * Pastikan model ini berada di schema yang sama (sik) atau gunakan prefix sesuai koneksi.
     */
    public function getForPrint(int $id)
    {
        // Ganti 'reg_periksa','pasien','dokter' sesuai schema aktif (mis. 'sik.reg_periksa' jika beda koneksi).
        $this->db->select('ss.*, rp.no_rawat AS rp_no_rawat, p.no_rkm_medis AS p_norm, p.nm_pasien, p.alamat, d.nm_dokter')
                 ->from($this->table.' ss')
                 ->join('reg_periksa rp', 'rp.no_rawat = ss.no_rawat', 'left')
                 ->join('pasien p', 'p.no_rkm_medis = ss.no_rkm_medis', 'left')
                 ->join('dokter d', 'd.kd_dokter = ss.kd_dokter', 'left')
                 ->where('ss.'.$this->pk, $id)
                 ->limit(1);
        return $this->db->get()->row_array();
    }
}

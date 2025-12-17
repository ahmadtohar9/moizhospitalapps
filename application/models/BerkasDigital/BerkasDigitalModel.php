<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerkasDigitalModel extends CI_Model
{
    // master_berkas_digital:  kode, nama
    // berkas_digital_perawatan: id (PK AI), no_rawat, kode, lokasi_file, created_at, created_by
    private $tbl_master = 'master_berkas_digital';
    private $tbl_berkas = 'berkas_digital_perawatan';

    public function __construct()
    {
        parent::__construct();
    }

    /* ========================= MASTER ========================= */

    /** Ambil semua jenis master berkas */
    public function getMasterAll()
    {
        return $this->db->order_by('kode', 'ASC')
                        ->get($this->tbl_master)
                        ->result_array();
    }

    /** Ambil nama berkas dari kode */
    public function getNamaByKode($kode)
    {
        $row = $this->db->select('nama')
                        ->where('kode', $kode)
                        ->get($this->tbl_master)
                        ->row_array();
        return $row['nama'] ?? null;
    }

    /* ===================== LIST BERKAS ===================== */

    /** Hitung total berkas untuk satu no_rawat */
    public function countByNoRawat($no_rawat)
    {
        return (int) $this->db->where('no_rawat', $no_rawat)
                              ->count_all_results($this->tbl_berkas);
    }

    /**
     * Ambil daftar berkas berdasarkan no_rawat (termasuk ID untuk aksi Hapus/Unduh)
     */
    public function getListByNoRawat($no_rawat, $limit = 100, $offset = 0)
    {
        return $this->db->select('b.no_rawat, b.kode, m.nama, b.lokasi_file')
                        ->from($this->tbl_berkas . ' b')
                        ->join($this->tbl_master . ' m', 'm.kode = b.kode', 'left')
                        ->where('b.no_rawat', $no_rawat)
                        ->order_by('b.kode', 'ASC')
                        ->limit((int) $limit, (int) $offset)
                        ->get()
                        ->result_array();
    }

    /**
     * Matriks status upload (setiap master kode -> uploaded/belum + lokasi_file jika ada)
     */
    public function getStatusMatrix($no_rawat)
    {
        $sql = "
            SELECT m.kode, m.nama,
                   CASE WHEN b.kode IS NULL THEN 0 ELSE 1 END AS uploaded,
                   b.lokasi_file, b.id
            FROM {$this->tbl_master} m
            LEFT JOIN {$this->tbl_berkas} b
              ON b.kode = m.kode AND b.no_rawat = ?
            ORDER BY m.kode ASC
        ";
        return $this->db->query($sql, [$no_rawat])->result_array();
    }

    /* ====================== CRUD BERKAS ====================== */

    /** Cek apakah pasangan (no_rawat, kode) sudah ada */
    public function existsPair($no_rawat, $kode)
    {
        return (bool) $this->db->where('no_rawat', $no_rawat)
                               ->where('kode', $kode)
                               ->limit(1)
                               ->get($this->tbl_berkas)
                               ->row();
    }

    /** Ambil satu data berkas berdasarkan (no_rawat, kode) */
    public function findByRawatKode(string $no_rawat, string $kode)
    {
        return $this->db->select('no_rawat, kode, lokasi_file')
                        ->from($this->tbl_berkas)
                        ->where('no_rawat', $no_rawat)
                        ->where('kode', $kode)
                        ->limit(1)
                        ->get()
                        ->row_array();
    }

    /**
     * Hapus data berkas berdasarkan pasangan no_rawat dan kode
     */
    public function deleteByRawatKode(string $no_rawat, string $kode): bool
    {
        return (bool) $this->db->where('no_rawat', $no_rawat)
                               ->where('kode', $kode)
                               ->delete($this->tbl_berkas);
    }

    /** Insert data berkas baru */
    /** Insert berkas baru, tolak jika kode berkas sudah ada untuk no_rawat tsb */
    public function insertUpload(array $data)
    {
        $row = [
            'no_rawat'    => trim((string)($data['no_rawat'] ?? '')),
            'kode'        => trim((string)($data['kode'] ?? '')),
            'lokasi_file' => trim((string)($data['lokasi_file'] ?? '')),
        ];

        // Validasi minimal
        if ($row['no_rawat'] === '' || $row['kode'] === '' || $row['lokasi_file'] === '') {
            return ['status' => 'error', 'message' => 'Data tidak lengkap.'];
        }

        // Cek apakah berkas dengan kode tsb sudah ada di no_rawat yang sama
        $exists = $this->db->where('no_rawat', $row['no_rawat'])
                           ->where('kode', $row['kode'])
                           ->limit(1)
                           ->get($this->tbl_berkas)
                           ->row_array();

        if ($exists) {
            return [
                'status'  => 'duplicate',
                'message' => 'Berkas dengan kode ini sudah ada untuk pasien tersebut.',
                'data'    => $exists
            ];
        }

        // Simpan baru jika belum ada
        $ok = $this->db->insert($this->tbl_berkas, $row);
        if (!$ok) {
            return ['status' => 'error', 'message' => 'Gagal menyimpan ke database.'];
        }

        return ['status' => 'success', 'message' => 'Berkas berhasil disimpan.'];
    }

    /** Find by primary key id */
    public function findById($id)
    {
        return $this->db->where('id', (int) $id)
                        ->get($this->tbl_berkas)
                        ->row_array();
    }

    /** Delete by primary key id */
    public function deleteById($id)
    {
        return (bool) $this->db->where('id', (int) $id)
                               ->delete($this->tbl_berkas);
    }
}

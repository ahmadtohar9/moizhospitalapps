<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenunjangRalanModel extends CI_Model
{
    private $table = 'moiz_penunjang_dokter';

    public function __construct()
    {
        parent::__construct();
    }

    /* ======================================================
     * GET ALL BY NO RAWAT
     * ====================================================== */
    public function getAllByNoRawat($no_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_periksa', 'DESC');
        $this->db->order_by('jam_periksa', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    /* ======================================================
     * GET BY ID
     * ====================================================== */
    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => (int)$id])->row_array();
    }

    /* ======================================================
     * SAVE
     * ====================================================== */
    public function save($data)
    {
        try {
            $ok = $this->db->insert($this->table, [
                'no_rawat'          => $data['no_rawat'],
                'kd_dokter'         => $data['kd_dokter'],
                'hasil_pemeriksaan' => $data['hasil_pemeriksaan'],
                'tgl_periksa'       => $data['tgl_periksa'] ?? date('Y-m-d'),
                'jam_periksa'       => $data['jam_periksa'] ?? date('H:i:s'),
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            if ($ok) {
                return ['ok' => true, 'id' => $this->db->insert_id()];
            }
            return ['ok' => false, 'error' => 'Insert gagal.'];
        } catch (Exception $e) {
            log_message('error', 'Insert moiz_penunjang_dokter gagal: ' . $e->getMessage());
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    /* ======================================================
     * UPDATE
     * ====================================================== */
    public function update($id, $data)
    {
        try {
            $this->db->where('id', (int)$id);
            $ok = $this->db->update($this->table, $data);
            return $ok;
        } catch (Exception $e) {
            log_message('error', 'Update moiz_penunjang_dokter gagal: ' . $e->getMessage());
            return false;
        }
    }

    /* ======================================================
     * DELETE
     * ====================================================== */
    public function delete($id)
    {
        try {
            $this->db->where('id', (int)$id);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Delete moiz_penunjang_dokter gagal: ' . $e->getMessage());
            return false;
        }
    }

    /* ======================================================
     * Tambahan opsional: ambil data terakhir (terbaru)
     * ====================================================== */
    public function getLastByNoRawat($no_rawat)
    {
        return $this->db
            ->where('no_rawat', $no_rawat)
            ->order_by('tgl_periksa', 'DESC')
            ->order_by('jam_periksa', 'DESC')
            ->limit(1)
            ->get($this->table)
            ->row_array();
    }

    /* ======================================================
     * GET ALL BY NO_RAWAT (DETAIL: +pasien +dokter +poli)
     * ====================================================== */
    public function getAllByNoRawatDetailed($no_rawat)
    {
        $this->db->select("
            pjd.*,
            r.no_rkm_medis,
            ps.nm_pasien,
            dk.nm_dokter,
            pl.nm_poli
        ");
        $this->db->from($this->table . " pjd");
        $this->db->join("reg_periksa r", "r.no_rawat = pjd.no_rawat", "left");
        $this->db->join("pasien ps", "ps.no_rkm_medis = r.no_rkm_medis", "left");
        $this->db->join("dokter dk", "dk.kd_dokter = pjd.kd_dokter", "left");
        $this->db->join("poliklinik pl", "pl.kd_poli = r.kd_poli", "left");
        $this->db->where("pjd.no_rawat", $no_rawat);
        $this->db->order_by("pjd.tgl_periksa", "DESC");
        $this->db->order_by("pjd.jam_periksa", "DESC");
        return $this->db->get()->result_array();
    }

    /* ======================================================
     * GET BY ID (DETAIL: +pasien +dokter +poli)
     * ====================================================== */
    public function getByIdDetailed($id)
    {
        $this->db->select("
            pjd.*,
            r.no_rkm_medis,
            ps.nm_pasien,
            dk.nm_dokter,
            pl.nm_poli
        ");
        $this->db->from($this->table . " pjd");
        $this->db->join("reg_periksa r", "r.no_rawat = pjd.no_rawat", "left");
        $this->db->join("pasien ps", "ps.no_rkm_medis = r.no_rkm_medis", "left");
        $this->db->join("dokter dk", "dk.kd_dokter = pjd.kd_dokter", "left");
        $this->db->join("poliklinik pl", "pl.kd_poli = r.kd_poli", "left");
        $this->db->where("pjd.id", (int)$id);
        return $this->db->get()->row_array();
    }

    public function existsByNoRawat($no_rawat): bool
    {
        return $this->db
            ->where('no_rawat', $no_rawat)
            ->count_all_results($this->table) > 0;
    }


}

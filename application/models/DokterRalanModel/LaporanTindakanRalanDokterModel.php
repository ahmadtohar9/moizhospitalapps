<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Laporan Tindakan Ralan (Satu baris per no_rawat)
 * Rekomendasi: beri UNIQUE INDEX di kolom no_rawat agar tunggal.
 */
class LaporanTindakanRalanDokterModel extends CI_Model
{
    private $table = 'moiz_laporan_tindakan_ralan';

    public function __construct()
    {
        parent::__construct();
    }

    /* ===================== GET ===================== */
    public function getByNoRawat($no_rawat)
    {
        return $this->db->get_where($this->table, ['no_rawat' => $no_rawat])->row_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => (int)$id])->row_array();
    }

    public function getByIdDetailed($id)
    {
        $this->db->select("
            lt.*,
            r.no_rkm_medis,
            ps.nm_pasien,
            dk.nm_dokter,
            pl.nm_poli
        ");
        $this->db->from($this->table . " lt");
        $this->db->join("reg_periksa r", "r.no_rawat = lt.no_rawat", "left");
        $this->db->join("pasien ps",     "ps.no_rkm_medis = r.no_rkm_medis", "left");
        $this->db->join("dokter dk",     "dk.kd_dokter   = lt.kd_dokter",    "left");
        $this->db->join("poliklinik pl", "pl.kd_poli     = r.kd_poli",       "left");
        $this->db->where("lt.id", (int)$id);
        return $this->db->get()->row_array();
    }

    public function existsByNoRawat($no_rawat): bool
    {
        return $this->db
            ->where('no_rawat', $no_rawat)
            ->count_all_results($this->table) > 0;
    }

    /* ============== SAVE / UPDATE / DELETE ============== */
    public function save($data)
    {
        // Guard tunggal per no_rawat
        if ($this->existsByNoRawat($data['no_rawat'])) {
            return ['ok' => false, 'error' => 'Laporan untuk nomor rawat ini sudah ada.'];
        }

        $payload = [
            'no_rawat'          => $data['no_rawat'],
            'kd_dokter'         => $data['kd_dokter'],
            'diagnosa'          => $data['diagnosa']          ?? null,
            'nama_tindakan'     => $data['nama_tindakan']     ?? null,
            'jam_mulai'         => $data['jam_mulai']         ?? null,
            'jam_selesai'       => $data['jam_selesai']       ?? null,
            'ruangan'           => isset($data['ruangan']) && $data['ruangan'] !== '' ? $data['ruangan'] : null,
            'jenis_anastesi'    => $data['jenis_anastesi']    ?? null,
            'prosedur_tindakan' => $data['prosedur_tindakan'] ?? null,
            'ttd'               => $data['ttd']               ?? null,
            'tgl_input'         => $data['tgl_input']         ?? date('Y-m-d H:i:s'),
        ];

        try {
            $this->db->trans_start();
            $ok = $this->db->insert($this->table, $payload);
            $id = $ok ? $this->db->insert_id() : null;
            $this->db->trans_complete();

            if ($this->db->trans_status() === false || !$ok) {
                return ['ok'=>false,'error'=>'Insert gagal.'];
            }
            return ['ok'=>true,'id'=>$id];
        } catch (Exception $e) {
            // Tangkap duplikat jika ada UNIQUE INDEX no_rawat (Error 1062)
            if (strpos($e->getMessage(), '1062') !== false) {
                return ['ok'=>false,'error'=>'Duplikat no_rawat: laporan sudah ada.'];
            }
            log_message('error', 'Insert '.$this->table.' gagal: '.$e->getMessage());
            return ['ok'=>false,'error'=>$e->getMessage()];
        }
    }

    public function update($id, $data)
    {
        try {
            // filter hanya kolom yang ada
            $allowed = [
                'no_rawat','kd_dokter','diagnosa','nama_tindakan',
                'jam_mulai','jam_selesai','ruangan','jenis_anastesi',
                'prosedur_tindakan','ttd','tgl_input'
            ];
            $clean = array_intersect_key($data, array_flip($allowed));

            // normalisasi ruangan: '' → NULL
            if (array_key_exists('ruangan', $clean) && $clean['ruangan'] === '') {
                $clean['ruangan'] = null;
            }

            $this->db->where('id', (int)$id);
            return $this->db->update($this->table, $clean);
        } catch (Exception $e) {
            log_message('error', 'Update '.$this->table.' gagal: ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $this->db->where('id', (int)$id);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Delete '.$this->table.' gagal: '.$e->getMessage());
            return false;
        }
    }
}

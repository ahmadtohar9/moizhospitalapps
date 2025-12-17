<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiagnosaProsedurRalanModel extends CI_Model {

    // === DIAGNOSA ===
    public function searchDiagnosa($term) {
        $this->db->select('kd_penyakit as kode, nm_penyakit as nama');
        $this->db->from('penyakit');
        $this->db->like('kd_penyakit', $term);
        $this->db->or_like('nm_penyakit', $term);
        return $this->db->get()->result();
    }

    public function saveDiagnosa($data) 
    {
        $no_rawat = $data['no_rawat'];
        $kd_penyakit = $data['kd_penyakit'];
        $status = 'Ralan';

        $query = $this->db->select('no_rkm_medis')
                          ->from('reg_periksa')
                          ->where('no_rawat', $no_rawat)
                          ->get();
        $result = $query->row_array();
        if (!$result) return false;

        $no_rkm_medis = $result['no_rkm_medis'];

        // Cek apakah sudah ada diagnosa ini di no_rawat & status
        $check = $this->db->get_where('diagnosa_pasien', [
            'no_rawat' => $no_rawat,
            'kd_penyakit' => $kd_penyakit,
            'status' => $status
        ]);

        if ($check->num_rows() > 0) {
            return 'duplicate';
        }

        // Cek status_penyakit (Baru/Lama)
        $sudah_ada = $this->db
            ->join('reg_periksa', 'diagnosa_pasien.no_rawat = reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis')
            ->where('pasien.no_rkm_medis', $no_rkm_medis)
            ->where('diagnosa_pasien.kd_penyakit', $kd_penyakit)
            ->count_all_results('diagnosa_pasien');

        $status_penyakit = $sudah_ada > 0 ? 'Lama' : 'Baru';

        $prioritas = $this->db->select('IFNULL(MAX(prioritas)+1, 1) AS prioritas')
                              ->from('diagnosa_pasien')
                              ->where('no_rawat', $no_rawat)
                              ->where('status', $status)
                              ->get()->row()->prioritas;

        $insert = [
            'no_rawat' => $no_rawat,
            'kd_penyakit' => $kd_penyakit,
            'status' => $status,
            'prioritas' => $prioritas,
            'status_penyakit' => $status_penyakit
        ];

        return $this->db->insert('diagnosa_pasien', $insert);
    }

    public function deleteDiagnosa($no_rawat, $kd_penyakit, $status)
    {
        return $this->db->delete('diagnosa_pasien', [
            'no_rawat'    => $no_rawat,
            'kd_penyakit' => $kd_penyakit,
            'status'      => $status
        ]);
    }


    public function getHasilDiagnosa($no_rawat) {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->get('diagnosa_pasien')->result();
    }


    public function getRiwayatDiagnosaByNorm($no_rkm_medis) 
    {
        $this->db->select('dp.no_rawat, dp.kd_penyakit, p.nm_penyakit, d.nm_dokter, pl.nm_poli');
        $this->db->from('diagnosa_pasien dp');
        $this->db->join('penyakit p', 'p.kd_penyakit = dp.kd_penyakit');
        $this->db->join('reg_periksa rp', 'dp.no_rawat = rp.no_rawat');
        $this->db->join('dokter d', 'd.kd_dokter = rp.kd_dokter', 'left');
        $this->db->join('poliklinik pl', 'pl.kd_poli = rp.kd_poli', 'left');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->where('rp.status_lanjut', 'Ralan');
        $this->db->order_by('dp.no_rawat', 'desc');
        return $this->db->get()->result();
    }
    

    // === PROSEDUR ===
    public function searchProsedur($term)
    {
        $this->db->select('kode, deskripsi_panjang');
        $this->db->from('icd9');
        $this->db->like('kode', $term);
        $this->db->or_like('deskripsi_panjang', $term);
        return $this->db->get()->result();
    }

    public function saveProsedur($data)
    {
        $no_rawat = $data['no_rawat'];
        $kode     = $data['kode'];
        $status   = 'Ralan';

        // Cek apakah sudah ada prosedur ini di no_rawat + status
        $check = $this->db->get_where('prosedur_pasien', [
            'no_rawat' => $no_rawat,
            'kode'     => $kode,
            'status'   => $status
        ]);

        if ($check->num_rows() > 0) {
            return 'duplicate';
        }

        // Hitung prioritas prosedur
        $prioritas = $this->db->select('IFNULL(MAX(prioritas)+1,1) AS prioritas')
                              ->from('prosedur_pasien')
                              ->where('no_rawat', $no_rawat)
                              ->where('status', $status)
                              ->get()->row()->prioritas;

        // Insert prosedur baru
        $insert = [
            'no_rawat'  => $no_rawat,
            'kode'      => $kode,
            'status'    => $status,
            'prioritas' => $prioritas
        ];

        return $this->db->insert('prosedur_pasien', $insert);
    }

    public function getHasilProsedur($no_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->get('prosedur_pasien')->result();
    }

    public function getRiwayatProsedurByNorm($no_rkm_medis) {
        $this->db->select('pp.no_rawat, pp.kode, i.deskripsi_panjang, d.nm_dokter, pl.nm_poli');
        $this->db->from('prosedur_pasien pp');
        $this->db->join('icd9 i', 'i.kode = pp.kode');
        $this->db->join('reg_periksa rp', 'pp.no_rawat = rp.no_rawat');
        $this->db->join('dokter d', 'd.kd_dokter = rp.kd_dokter', 'left');
        $this->db->join('poliklinik pl', 'pl.kd_poli = rp.kd_poli', 'left');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('pp.no_rawat', 'desc');
        return $this->db->get()->result();
    }




    public function deleteProsedur($no_rawat, $kode, $status)
    {
        return $this->db->delete('prosedur_pasien', [
            'no_rawat' => $no_rawat,
            'kode'     => $kode,
            'status'   => $status
        ]);
    }

}
?>

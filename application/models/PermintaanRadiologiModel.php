<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanRadiologiModel extends CI_Model {

    public function get_list_radiologi() {
        return $this->db->select('kd_jenis_prw, nm_perawatan, total_byr')
                        ->from('jns_perawatan_radiologi')
                        ->order_by('nm_perawatan', 'asc')
                        ->get()
                        ->result();
    }

    public function insert_radiologi($header, $detail_list) {
        $this->db->trans_start();

        $this->db->insert('permintaan_radiologi', $header);

        foreach ($detail_list as $kd_jenis_prw) {
            $this->db->insert('permintaan_pemeriksaan_radiologi', [
                'noorder' => $header['noorder'],
                'kd_jenis_prw' => $kd_jenis_prw,
                'stts_bayar' => 'Belum'
            ]);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function search_radiologi($term) {
        $this->db->select('kd_jenis_prw as kode, nm_perawatan as nama, total_byr');
        $this->db->from('jns_perawatan_radiologi');
        $this->db->like('kd_jenis_prw', $term);
        $this->db->or_like('nm_perawatan', $term);
        return $this->db->get()->result();
    }

    public function getRiwayatRadiologiByNorm($no_rkm_medis)
    {
        return $this->db->select('
                pr.noorder, 
                pr.no_rawat, 
                pr.tgl_permintaan, 
                pr.jam_permintaan,
                pr.tgl_hasil,
                pr.jam_hasil, 
                pr.informasi_tambahan, 
                pr.diagnosa_klinis, 
                jpr.kd_jenis_prw, 
                jpr.nm_perawatan, 
                d.nm_dokter, 
                p.nm_poli
            ')
            ->from('permintaan_radiologi pr')
            ->join('permintaan_pemeriksaan_radiologi ppr', 'pr.noorder = ppr.noorder')
            ->join('jns_perawatan_radiologi jpr', 'jpr.kd_jenis_prw = ppr.kd_jenis_prw')
            ->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat')
            ->join('dokter d', 'd.kd_dokter = pr.dokter_perujuk', 'left')
            ->join('poliklinik p', 'p.kd_poli = rp.kd_poli', 'left')
            ->where('rp.no_rkm_medis', $no_rkm_medis)
            ->order_by('pr.noorder', 'desc')
            ->get()
            ->result();
    }


    public function deleteRadiologi($noorder, $kd_jenis_prw)
    {
        // Hapus salah satu tindakan
        $this->db->where('noorder', $noorder)
                 ->where('kd_jenis_prw', $kd_jenis_prw)
                 ->delete('permintaan_pemeriksaan_radiologi');

        // Cek apakah masih ada tindakan tersisa untuk order tsb
        $remaining = $this->db->get_where('permintaan_pemeriksaan_radiologi', ['noorder' => $noorder])->num_rows();

        // Jika tidak ada tindakan tersisa, hapus permintaan_radiologi
        if ($remaining === 0) {
            $this->db->delete('permintaan_radiologi', ['noorder' => $noorder]);
        }

        return true;
    }



}
?>

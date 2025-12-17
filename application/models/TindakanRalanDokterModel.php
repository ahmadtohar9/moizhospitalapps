<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TindakanRalanDokterModel extends CI_Model {

    // Ambil semua tindakan dari master `jns_perawatan`
    public function getAllTindakan()
    {
        $this->db->select('
            jns_perawatan.kd_jenis_prw, 
            jns_perawatan.nm_perawatan, 
            kategori_perawatan.nm_kategori, 
            jns_perawatan.material, 
            jns_perawatan.bhp, 
            jns_perawatan.tarif_tindakandr, 
            jns_perawatan.kso, 
            jns_perawatan.menejemen, 
            jns_perawatan.total_byrdr
        ');
        $this->db->from('jns_perawatan');
        $this->db->join('kategori_perawatan', 'jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori');
        $this->db->where('jns_perawatan.total_byrdr >', 0);
        return $this->db->get()->result_array();
    }

    // Ambil detail tindakan berdasarkan `kd_jenis_prw`
    public function getTindakanDetail($kd_jenis_prw)
    {
        return $this->db->get_where('jns_perawatan', ['kd_jenis_prw' => $kd_jenis_prw])->row_array();
    }

    // Simpan tindakan ke tabel `rawat_jl_dr`
    public function saveTindakan($data)
    {
        return $this->db->insert_batch('rawat_jl_dr', $data);
    }

    public function deleteTindakan($no_rawat, $kd_jenis_prw, $tgl_perawatan, $jam_rawat)
    {
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('kd_jenis_prw', $kd_jenis_prw);
        $this->db->where('tgl_perawatan', $tgl_perawatan);
        $this->db->where('jam_rawat', $jam_rawat);
        return $this->db->delete('rawat_jl_dr');
    }



    // Ambil hasil tindakan berdasarkan `no_rawat`
    public function getHasilTindakan($no_rawat)
    {
        $this->db->select('
            rawat_jl_dr.no_rawat,
            rawat_jl_dr.tgl_perawatan,
            rawat_jl_dr.jam_rawat,
            rawat_jl_dr.kd_jenis_prw,
            jns_perawatan.nm_perawatan,
            rawat_jl_dr.material,
            rawat_jl_dr.bhp,
            rawat_jl_dr.tarif_tindakandr,
            rawat_jl_dr.kso,
            rawat_jl_dr.menejemen,
            rawat_jl_dr.biaya_rawat,
            rawat_jl_dr.stts_bayar,
            dokter.nm_dokter
        ');
        $this->db->from('rawat_jl_dr');
        $this->db->join('jns_perawatan', 'rawat_jl_dr.kd_jenis_prw = jns_perawatan.kd_jenis_prw');
        $this->db->join('dokter', 'rawat_jl_dr.kd_dokter = dokter.kd_dokter');
        $this->db->where('rawat_jl_dr.no_rawat', $no_rawat);
        $this->db->order_by('rawat_jl_dr.tgl_perawatan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getRiwayatTindakanByNorm($no_rkm_medis)
    {
        $this->db->select('rjd.*, jp.nm_perawatan, d.nm_dokter');
        $this->db->from('rawat_jl_dr rjd');
        $this->db->join('reg_periksa rp', 'rp.no_rawat = rjd.no_rawat');
        $this->db->join('jns_perawatan jp', 'rjd.kd_jenis_prw = jp.kd_jenis_prw');
        $this->db->join('dokter d', 'rjd.kd_dokter = d.kd_dokter');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('rjd.tgl_perawatan DESC, rjd.jam_rawat DESC');
        return $this->db->get()->result_array();
    }
}

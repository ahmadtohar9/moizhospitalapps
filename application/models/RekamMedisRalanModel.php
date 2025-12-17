<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekamMedisRalanModel extends CI_Model
{

    /**
     * Mendapatkan semua data pasien rawat jalan
     */
    public function get_all_pasien()
    {
        $this->db->select('
            reg_periksa.no_rawat,
            reg_periksa.no_rkm_medis,
            pasien.nm_pasien,
            dokter.nm_dokter,
            penjab.png_jawab,
            poliklinik.nm_poli,
            reg_periksa.stts,
            reg_periksa.status_bayar
        ');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Mendapatkan detail pasien berdasarkan no_rawat
     */
    public function get_patient_detail($no_rawat)
    {
        $this->db->select('
            reg_periksa.no_rawat,
            reg_periksa.no_rkm_medis,
            reg_periksa.umurdaftar,
            pasien.nm_pasien,
            pasien.jk,
            pasien.tgl_lahir,
            pasien.umur,
            pasien.alamat,
            dokter.nm_dokter,
            dokter.kd_dokter,
            penjab.png_jawab,
            poliklinik.nm_poli,
            poliklinik.kd_poli,
            reg_periksa.tgl_registrasi,
            reg_periksa.status_bayar,
            reg_periksa.stts
        ');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $this->db->where('reg_periksa.no_rawat', $no_rawat);

        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Mendapatkan hasil SOAP berdasarkan no_rawat
     */
    public function getHasilSOAP($no_rawat)
    {
        $this->db->select('
            tgl_perawatan,
            jam_rawat,
            suhu_tubuh,
            tensi,
            nadi,
            respirasi,
            keluhan,
            pemeriksaan,
            penilaian,
            instruksi,
            no_rawat
        ');
        $this->db->from('pemeriksaan_ralan'); // Nama tabel pemeriksaan
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_perawatan', 'DESC'); // Urutkan berdasarkan tanggal terbaru
        $this->db->order_by('jam_rawat', 'DESC'); // Urutkan berdasarkan waktu terbaru

        $query = $this->db->get();
        return $query->result(); // Kembalikan hasil sebagai array objek
    }

    public function getNormByNoRawat($no_rawat)
    {
        $this->db->select('no_rkm_medis');
        $this->db->from('reg_periksa');
        $this->db->where('no_rawat', $no_rawat);
        $query = $this->db->get()->row();
        return $query ? $query->no_rkm_medis : '';
    }

}

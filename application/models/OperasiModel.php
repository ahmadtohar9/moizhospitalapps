<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OperasiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_operasi_by_no_rawat($no_rawat)
    {
        $this->db->select("
            o.*,
            p.nm_perawatan AS nm_paket_operasi,
            d1.nm_dokter AS nm_operator1,
            d2.nm_dokter AS nm_operator2,
            d3.nm_dokter AS nm_operator3,
            d4.nm_dokter AS nm_dokter_anestesi,
            d5.nm_dokter AS nm_dokter_anak,
            d6.nm_dokter AS nm_dokter_pjanak,
            d7.nm_dokter AS nm_dokter_umum,
            p1.nama AS nm_asisten_operator1,
            p2.nama AS nm_asisten_operator2,
            p3.nama AS nm_asisten_operator3,
            p4.nama AS nm_asisten_anestesi,
            p5.nama AS nm_asisten_anestesi2,
            p6.nama AS nm_perawat_resusitas,
            p7.nama AS nm_perawat_luar,
            p8.nama AS nm_bidan,
            p9.nama AS nm_bidan2,
            p10.nama AS nm_bidan3,
            p11.nama AS nm_instrumen,
            p12.nama AS nm_omloop,
            p13.nama AS nm_omloop2,
            p14.nama AS nm_omloop3,
            p15.nama AS nm_omloop4,
            p15.nama AS nm_omloop4,
            p16.nama AS nm_omloop5,
            lo.diagnosa_preop,
            lo.diagnosa_postop,
            lo.laporan_operasi,
            lo.jaringan_dieksekusi,
            lo.selesaioperasi,
            lo.permintaan_pa,
            lo.nomor_implan
        ");
        $this->db->from('operasi o');
        $this->db->join('paket_operasi p', 'o.kode_paket = p.kode_paket', 'left');
        $this->db->join('laporan_operasi lo', 'o.no_rawat = lo.no_rawat AND o.tgl_operasi = lo.tanggal', 'left');

        // DOCTORS
        $this->db->join('dokter d1', 'o.operator1 = d1.kd_dokter', 'left');
        $this->db->join('dokter d2', 'o.operator2 = d2.kd_dokter', 'left');
        $this->db->join('dokter d3', 'o.operator3 = d3.kd_dokter', 'left');
        $this->db->join('dokter d4', 'o.dokter_anestesi = d4.kd_dokter', 'left');
        $this->db->join('dokter d5', 'o.dokter_anak = d5.kd_dokter', 'left');
        $this->db->join('dokter d6', 'o.dokter_pjanak = d6.kd_dokter', 'left');
        $this->db->join('dokter d7', 'o.dokter_umum = d7.kd_dokter', 'left');

        // PETUGAS
        $this->db->join('petugas p1', 'o.asisten_operator1 = p1.nip', 'left');
        $this->db->join('petugas p2', 'o.asisten_operator2 = p2.nip', 'left');
        $this->db->join('petugas p3', 'o.asisten_operator3 = p3.nip', 'left');
        $this->db->join('petugas p4', 'o.asisten_anestesi = p4.nip', 'left');
        $this->db->join('petugas p5', 'o.asisten_anestesi2 = p5.nip', 'left');
        $this->db->join('petugas p6', 'o.perawaat_resusitas = p6.nip', 'left');
        $this->db->join('petugas p7', 'o.perawat_luar = p7.nip', 'left');
        $this->db->join('petugas p8', 'o.bidan = p8.nip', 'left');
        $this->db->join('petugas p9', 'o.bidan2 = p9.nip', 'left');
        $this->db->join('petugas p10', 'o.bidan3 = p10.nip', 'left');
        $this->db->join('petugas p11', 'o.instrumen = p11.nip', 'left');
        $this->db->join('petugas p12', 'o.omloop = p12.nip', 'left');
        $this->db->join('petugas p13', 'o.omloop2 = p13.nip', 'left');
        $this->db->join('petugas p14', 'o.omloop3 = p14.nip', 'left');
        $this->db->join('petugas p15', 'o.omloop4 = p15.nip', 'left');
        $this->db->join('petugas p16', 'o.omloop5 = p16.nip', 'left');

        $this->db->where('o.no_rawat', $no_rawat);
        $this->db->order_by('o.tgl_operasi', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_paket_operasi()
    {
        return $this->db->select('kode_paket, nm_perawatan')
            ->from('paket_operasi')
            ->order_by('nm_perawatan', 'ASC')
            ->get()->result_array();
    }

    public function get_dokter()
    {
        return $this->db->select('kd_dokter, nm_dokter')
            ->from('dokter')
            ->where('status', '1') // Assuming active doctors have status 1
            ->order_by('nm_dokter', 'ASC')
            ->get()->result_array();
    }

    public function get_petugas()
    {
        return $this->db->select('nip, nama')
            ->from('petugas')
            ->order_by('nama', 'ASC')
            ->get()->result_array();
    }

    // --- LIMIT DATA FOR INITIAL LOAD ---
    public function get_dokter_limit($limit = 50)
    {
        return $this->db->select('kd_dokter, nm_dokter')
            ->from('dokter')
            ->where('status', '1')
            ->limit($limit)
            ->order_by('nm_dokter', 'ASC')
            ->get()->result_array();
    }

    public function get_petugas_limit($limit = 50)
    {
        return $this->db->select('nip, nama')
            ->from('petugas')
            ->limit($limit)
            ->order_by('nama', 'ASC')
            ->get()->result_array();
    }

    public function get_paket_operasi_limit($limit = 50)
    {
        return $this->db->select('kode_paket, nm_perawatan')
            ->from('paket_operasi')
            ->limit($limit)
            ->order_by('nm_perawatan', 'ASC')
            ->get()->result_array();
    }

    public function get_detail_paket($kode_paket)
    {
        return $this->db->where('kode_paket', $kode_paket)
            ->get('paket_operasi')
            ->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('operasi', $data);
    }

    public function insert_laporan($data)
    {
        return $this->db->insert('laporan_operasi', $data);
    }

    public function delete($no_rawat, $tgl_operasi)
    {
        // Delete from operasi
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tgl_operasi', $tgl_operasi);
        $del1 = $this->db->delete('operasi');

        // Delete from laporan_operasi (assuming key is no_rawat + tanggal)
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('tanggal', $tgl_operasi);
        $del2 = $this->db->delete('laporan_operasi');

        return $del1;
    }

    public function get_laporan_operasi($no_rawat, $tanggal)
    {
        return $this->db->where('no_rawat', $no_rawat)
            ->where('tanggal', $tanggal)
            ->get('laporan_operasi')
            ->row_array();
    }
    public function search_dokter($q)
    {
        $this->db->select('kd_dokter AS id, nm_dokter AS text');
        $this->db->from('dokter');
        $this->db->where('status', '1');
        $this->db->group_start();
        $this->db->like('nm_dokter', $q);
        $this->db->or_like('kd_dokter', $q);
        $this->db->group_end();
        $this->db->limit(20);
        return $this->db->get()->result_array();
    }

    public function search_petugas($q)
    {
        $this->db->select('nip AS id, nama AS text');
        $this->db->from('petugas');
        $this->db->group_start();
        $this->db->like('nama', $q);
        $this->db->or_like('nip', $q);
        $this->db->group_end();
        $this->db->limit(20);
        return $this->db->get()->result_array();
    }

    public function search_paket_operasi($q)
    {
        return $this->db->select('kode_paket AS id, nm_perawatan AS text')
            ->from('paket_operasi')
            ->like('nm_perawatan', $q)
            ->limit(20)
            ->get()->result_array();
    }

    public function get_pemeriksaan_terakhir($no_rawat)
    {
        // Try Ranap
        $ranap = $this->db->where('no_rawat', $no_rawat)
            ->order_by('tgl_perawatan DESC, jam_rawat DESC')
            ->limit(1)
            ->get('pemeriksaan_ranap')->row_array();
        if ($ranap)
            return $ranap;

        // Try Ralan
        return $this->db->where('no_rawat', $no_rawat)
            ->order_by('tgl_perawatan DESC, jam_rawat DESC')
            ->limit(1)
            ->get('pemeriksaan_ralan')->row_array();
    }

}

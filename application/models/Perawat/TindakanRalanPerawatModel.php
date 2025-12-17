<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TindakanRalanPerawatModel extends CI_Model {

    // ====== Master tindakan (sama seperti dokter) ======
    public function getAllTindakan()
    {
        $this->db->select('
            jns_perawatan.kd_jenis_prw,
            jns_perawatan.nm_perawatan,
            kategori_perawatan.nm_kategori,
            jns_perawatan.material, jns_perawatan.bhp,
            jns_perawatan.tarif_tindakanpr AS tarif_tindakanpr,
            jns_perawatan.kso, jns_perawatan.menejemen,
            jns_perawatan.total_byrpr AS total_byrpr
        ');
        $this->db->from('jns_perawatan');
        $this->db->join('kategori_perawatan', 'jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori');
        $this->db->where('jns_perawatan.total_byrpr >', 0);
        return $this->db->get()->result_array();
    }

    public function saveTindakan($rows) { return $this->db->insert_batch('rawat_jl_pr', $rows); }

    public function getHasilTindakanCombined($no_rawat)
    {
        if (!$no_rawat) return [];

        // PERAWAT
        $q1 = $this->db->select("
                rjp.no_rawat,
                rjp.tgl_perawatan,
                rjp.jam_rawat,
                rjp.kd_jenis_prw,
                jp.nm_perawatan,
                rjp.biaya_rawat,
                COALESCE(pg.nama, '-') AS pemeriksa,
                'perawat' AS sumber,
                rjp.nip       AS owner_id,
                rjp.material, rjp.bhp, rjp.tarif_tindakanpr AS tarif, rjp.kso, rjp.menejemen
            ", false)
            ->from('rawat_jl_pr rjp')
            ->join('jns_perawatan jp', 'rjp.kd_jenis_prw = jp.kd_jenis_prw')
            ->join('pegawai pg', 'rjp.nip = pg.nik', 'left')
            ->where('rjp.no_rawat', $no_rawat)
            ->get_compiled_select();

        // DOKTER
        $q2 = $this->db->select("
                rjd.no_rawat,
                rjd.tgl_perawatan,
                rjd.jam_rawat,
                rjd.kd_jenis_prw,
                jp.nm_perawatan,
                rjd.biaya_rawat,
                COALESCE(d.nm_dokter, '-') AS pemeriksa,
                'dokter' AS sumber,
                rjd.kd_dokter AS owner_id,
                rjd.material, rjd.bhp, rjd.tarif_tindakandr AS tarif, rjd.kso, rjd.menejemen
            ", false)
            ->from('rawat_jl_dr rjd')
            ->join('jns_perawatan jp', 'rjd.kd_jenis_prw = jp.kd_jenis_prw')
            ->join('dokter d', 'rjd.kd_dokter = d.kd_dokter', 'left')
            ->where('rjd.no_rawat', $no_rawat)
            ->get_compiled_select();

        $sql = "($q1) UNION ALL ($q2) ORDER BY tgl_perawatan DESC, jam_rawat DESC";
        return $this->db->query($sql)->result_array();
    }


    public function getRiwayatTindakanByNorm($no_rkm_medis)
    {
        $this->db->select('rjp.*, jp.nm_perawatan, pg.nama AS nama_perawat');
        $this->db->from('rawat_jl_pr rjp');
        $this->db->join('reg_periksa rp', 'rp.no_rawat = rjp.no_rawat');
        $this->db->join('jns_perawatan jp', 'rjp.kd_jenis_prw = jp.kd_jenis_prw');
        $this->db->join('pegawai pg', 'rjp.nip = pg.nik', 'left');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('rjp.tgl_perawatan', 'DESC');
        $this->db->order_by('rjp.jam_rawat', 'DESC');
        return $this->db->get()->result_array();
    }

    // ====== DELETE dgn helper 48 jam + owner ======
    public function deleteOne($no_rawat, $kd_jenis_prw, $tgl_perawatan, $jam_rawat, $nipLogin=null, $enforce48h=true)
    {
        $this->load->helper('empatdelapanjam');

        if (!$no_rawat || !$kd_jenis_prw || !$tgl_perawatan || !$jam_rawat) {
            return ['ok'=>false,'code'=>'bad_request'];
        }

        // Ambil record target
        $row = $this->db->get_where('rawat_jl_pr', [
            'no_rawat'      => $no_rawat,
            'kd_jenis_prw'  => $kd_jenis_prw,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat'     => $jam_rawat
        ])->row_array();

        if (!$row) return ['ok'=>false,'code'=>'not_found'];

        // Cek 48 jam
        if ($enforce48h) {
            $cek = cekBatas48Jam($row['tgl_perawatan'], $row['jam_rawat']);
            if (!$cek['ok']) return ['ok'=>false,'code'=>$cek['code']]; // expired_48h / invalid_datetime
        }

        // Cek owner (nip perawat)
        if ($nipLogin && isset($row['nip'])) {
            $own = cekOwnerData($row['nip'], $nipLogin);
            if (!$own['ok']) return ['ok'=>false,'code'=>$own['code']]; // not_owner / no_login
        }

        // Hapus
        $this->db->trans_start();
        $this->db->where([
            'no_rawat'      => $no_rawat,
            'kd_jenis_prw'  => $kd_jenis_prw,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat'     => $jam_rawat
        ]);
        $ok = $this->db->delete('rawat_jl_pr');
        $aff = $this->db->affected_rows();
        $this->db->trans_complete();

        if (!$ok || !$this->db->trans_status()) {
            log_message('error','DB delete rawat_jl_pr error: '.print_r($this->db->error(),true));
            return ['ok'=>false,'code'=>'db_error'];
        }
        return $aff > 0 ? true : ['ok'=>false,'code'=>'not_found'];
    }
}

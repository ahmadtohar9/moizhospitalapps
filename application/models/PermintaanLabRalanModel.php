<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanLabRalanModel extends CI_Model {

    public function getJenisPemeriksaanLab() {
        return $this->db->get('jns_perawatan_lab')->result_array();
    }

    public function generateNoOrderLab() {
        $prefix = 'PK' . date('Ymd');
        $last = $this->db->query("SELECT MAX(RIGHT(noorder, 4)) AS last_no FROM permintaan_lab WHERE noorder LIKE '{$prefix}%'")->row_array();
        $next = isset($last['last_no']) ? (int)$last['last_no'] + 1 : 1;
        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function insertPermintaanLab($noorder, $no_rawat, $tgl, $jam, $kd_dokter, $informasi_tambahan, $diagnosa_klinis) {
        $data = [
            'noorder' => $noorder,
            'no_rawat' => $no_rawat,
            'tgl_permintaan' => $tgl,
            'jam_permintaan' => $jam,
            'dokter_perujuk' => $kd_dokter,
            'status' => 'ralan',
            'informasi_tambahan' => $informasi_tambahan,
            'diagnosa_klinis' => $diagnosa_klinis
        ];
        $this->db->insert('permintaan_lab', $data);
    }

    public function insertPemeriksaan($noorder, $kd_jenis_prw) {
        $this->db->insert('permintaan_pemeriksaan_lab', [
            'noorder' => $noorder,
            'kd_jenis_prw' => $kd_jenis_prw,
            'stts_bayar' => 'Belum'
        ]);
    }

    public function insertDetailPermintaan($noorder, $kd_jenis_prw, $id_template) {
        $this->db->insert('permintaan_detail_permintaan_lab', [
            'noorder' => $noorder,
            'kd_jenis_prw' => $kd_jenis_prw,
            'id_template' => $id_template,
            'stts_bayar' => 'Belum'
        ]);
    }

    public function getRiwayatGroupedByOrder($no_rkm_medis, $limit = null)
{
    $pasien = $this->db->select('umurdaftar, jk')
        ->from('reg_periksa')
        ->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis')
        ->where('reg_periksa.no_rkm_medis', $no_rkm_medis)
        ->order_by('reg_periksa.tgl_registrasi', 'DESC')
        ->limit(1)
        ->get()->row_array();

    $usia = (int) ($pasien['umurdaftar'] ?? 0);
    $jk   = $pasien['jk'] ?? 'L';

    $this->db->select('
        pl.noorder, 
        pl.no_rawat, 
        pl.tgl_permintaan, 
        pl.jam_permintaan, 
        pl.tgl_hasil, 
        pl.jam_hasil,
        pl.informasi_tambahan,
        pl.diagnosa_klinis,
        d.nm_dokter, 
        p.nm_poli, 
        pj.png_jawab AS nm_penjab,
        jpl.kd_jenis_prw,
        jpl.nm_perawatan AS panel,
        tpl.pemeriksaan,
        tpl.satuan,
        tpl.nilai_rujukan_la, tpl.nilai_rujukan_ld, tpl.nilai_rujukan_pa, tpl.nilai_rujukan_pd
    ');
    $this->db->from('permintaan_lab pl');
    $this->db->join('reg_periksa rp', 'pl.no_rawat = rp.no_rawat');
    $this->db->join('dokter d', 'pl.dokter_perujuk = d.kd_dokter');
    $this->db->join('poliklinik p', 'rp.kd_poli = p.kd_poli');
    $this->db->join('penjab pj', 'rp.kd_pj = pj.kd_pj', 'left');
    $this->db->join('permintaan_detail_permintaan_lab pdpl', 'pl.noorder = pdpl.noorder');
    $this->db->join('jns_perawatan_lab jpl', 'jpl.kd_jenis_prw = pdpl.kd_jenis_prw');
    $this->db->join('template_laboratorium tpl', 'tpl.id_template = pdpl.id_template');
    $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
    $this->db->order_by('pl.tgl_permintaan', 'DESC');
    $this->db->order_by('pl.jam_permintaan', 'DESC');

    if ($limit !== null) {
        $this->db->limit($limit);
    }

    $query = $this->db->get()->result_array();
    $grouped = [];

    foreach ($query as $row) {
        $noorder = $row['noorder'];
        $panel   = $row['panel'];

        $rujukan = '-';
        if ($usia < 14) {
            $rujukan = $jk === 'L' ? $row['nilai_rujukan_la'] : $row['nilai_rujukan_pa'];
        } else {
            $rujukan = $jk === 'L' ? $row['nilai_rujukan_ld'] : $row['nilai_rujukan_pd'];
        }

        if (!isset($grouped[$noorder])) {
            $grouped[$noorder] = [
                'no_rawat'           => $row['no_rawat'],
                'tgl_permintaan'     => $row['tgl_permintaan'],
                'jam_permintaan'     => $row['jam_permintaan'],
                'tgl_hasil'          => $row['tgl_hasil'],
                'jam_hasil'          => $row['jam_hasil'],
                'nm_dokter'          => $row['nm_dokter'],
                'nm_poli'            => $row['nm_poli'],
                'nm_penjab'          => $row['nm_penjab'] ?? '-',
                'informasi_tambahan' => $row['informasi_tambahan'],
                'diagnosa_klinis'    => $row['diagnosa_klinis'],
                'pemeriksaan'        => [],
                'template_detail'    => [],
            ];
        }

        // Jangan grup berdasarkan md5, cukup masukkan semuanya apa adanya
        $grouped[$noorder]['pemeriksaan'][$panel][] = $row['pemeriksaan'];
        $grouped[$noorder]['template_detail'][$panel][] = [
            'pemeriksaan'   => $row['pemeriksaan'],
            'satuan'        => $row['satuan'] ?? '-',
            'nilai_rujukan' => $rujukan,
        ];
    }

    return $grouped;
}


    public function deletePermintaanLab($noorder) {
        $this->db->where('noorder', $noorder)->delete('permintaan_detail_permintaan_lab');
        $this->db->where('noorder', $noorder)->delete('permintaan_pemeriksaan_lab');
        $this->db->where('noorder', $noorder)->delete('permintaan_lab');
    }

    public function getSinglePermintaan($noorder) {
        $this->db->select('ppl.kd_jenis_prw, pdpl.id_template');
        $this->db->from('permintaan_pemeriksaan_lab ppl');
        $this->db->join('permintaan_detail_permintaan_lab pdpl', 'ppl.noorder = pdpl.noorder AND ppl.kd_jenis_prw = pdpl.kd_jenis_prw');
        $this->db->where('ppl.noorder', $noorder);
        $result = $this->db->get()->result_array();

        $grouped = [];
        foreach ($result as $row) {
            $grouped[$row['kd_jenis_prw']][] = $row['id_template'];
        }

        $labInfo = $this->db->get_where('permintaan_lab', ['noorder' => $noorder])->row_array();

        return [
            'noorder'             => $noorder,
            'pemeriksaan'         => $grouped,
            'informasi_tambahan'  => $labInfo['informasi_tambahan'] ?? '',
            'diagnosa_klinis'     => $labInfo['diagnosa_klinis'] ?? ''
        ];
    }

    public function getRiwayatLabByNoRm($no_rkm_medis) {
        $this->db->select('pl.noorder, pl.no_rawat, pl.tgl_permintaan, pl.jam_permintaan, tpl.pemeriksaan, jpl.nm_perawatan');
        $this->db->from('permintaan_lab pl');
        $this->db->join('reg_periksa rp', 'pl.no_rawat = rp.no_rawat');
        $this->db->join('permintaan_detail_permintaan_lab pdpl', 'pl.noorder = pdpl.noorder');
        $this->db->join('template_laboratorium tpl', 'tpl.id_template = pdpl.id_template');
        $this->db->join('jns_perawatan_lab jpl', 'jpl.kd_jenis_prw = pdpl.kd_jenis_prw');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('pl.tgl_permintaan', 'DESC');
        $this->db->order_by('pl.jam_permintaan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getTemplateByJenis($kd_jenis_prw) {
        $this->db->select('
            template_laboratorium.id_template, 
            template_laboratorium.Pemeriksaan as pemeriksaan, 
            template_laboratorium.satuan, 
            template_laboratorium.nilai_rujukan_ld as nilai_ld, 
            template_laboratorium.nilai_rujukan_la as nilai_la, 
            template_laboratorium.nilai_rujukan_pd as nilai_pd, 
            template_laboratorium.nilai_rujukan_pa as nilai_pa,
            jns_perawatan_lab.nm_perawatan
        ');
        $this->db->from('template_laboratorium');
        $this->db->join('jns_perawatan_lab', 'template_laboratorium.kd_jenis_prw = jns_perawatan_lab.kd_jenis_prw');
        $this->db->where('template_laboratorium.kd_jenis_prw', $kd_jenis_prw);
        $this->db->order_by('template_laboratorium.urut', 'ASC');
        return $this->db->get()->result_array();
    }
}

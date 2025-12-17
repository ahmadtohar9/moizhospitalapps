<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResumeMedisRalan_model extends CI_Model {

    private $table_resume = 'resume_pasien';
    private $table_ttv = 'moiz_resume_pasien_ralan';

    public function get_by_no_rawat($no_rawat) {
        return $this->db->get_where($this->table_resume, ['no_rawat' => $no_rawat])->row_array();
    }

    public function save($data)
    {
        if (empty($data['no_rawat'])) {
            return false;
        }

        // Cek apakah resume sudah ada sebelumnya
        $existing = $this->db->get_where($this->table_resume, ['no_rawat' => $data['no_rawat']])->row();
        if ($existing) {
            return 'duplicate'; // 🚫 jangan simpan dua kali
        }

        // Resume utama
        $data_resume = [
            'no_rawat' => $data['no_rawat'],
            'kd_dokter' => $data['kd_dokter'],
            'keluhan_utama' => $data['keluhan_utama'],
            'jalannya_penyakit' => $data['jalannya_penyakit'],
            'pemeriksaan_penunjang' => $data['pemeriksaan_penunjang'],
            'hasil_laborat' => $data['hasil_laborat'],
            'diagnosa_utama' => $data['diagnosa_utama'] ?? null,
            'kd_diagnosa_utama' => $data['kd_diagnosa_utama'] ?? null,
            'diagnosa_sekunder' => $data['diagnosa_sekunder'] ?? null,
            'kd_diagnosa_sekunder' => $data['kd_diagnosa_sekunder'] ?? null,
            'diagnosa_sekunder2' => $data['diagnosa_sekunder2'] ?? null,
            'kd_diagnosa_sekunder2' => $data['kd_diagnosa_sekunder2'] ?? null,
            'diagnosa_sekunder3' => $data['diagnosa_sekunder3'] ?? null,
            'kd_diagnosa_sekunder3' => $data['kd_diagnosa_sekunder3'] ?? null,
            'diagnosa_sekunder4' => $data['diagnosa_sekunder4'] ?? null,
            'kd_diagnosa_sekunder4' => $data['kd_diagnosa_sekunder4'] ?? null,
            'prosedur_utama' => $data['prosedur_utama'] ?? null,
            'kd_prosedur_utama' => $data['kd_prosedur_utama'] ?? null,
            'prosedur_sekunder' => $data['prosedur_sekunder'] ?? null,
            'kd_prosedur_sekunder' => $data['kd_prosedur_sekunder'] ?? null,
            'prosedur_sekunder2' => $data['prosedur_sekunder2'] ?? null,
            'kd_prosedur_sekunder2' => $data['kd_prosedur_sekunder2'] ?? null,
            'prosedur_sekunder3' => $data['prosedur_sekunder3'] ?? null,
            'kd_prosedur_sekunder3' => $data['kd_prosedur_sekunder3'] ?? null,
            'kondisi_pulang' => $data['kondisi_pulang'] ?? null,
            'obat_pulang' => $data['obat_pulang'] ?? null
        ];

        // Data TTV
        $data_ttv = [
            'no_rawat' => $data['no_rawat'],
            'kd_dokter' => $data['kd_dokter'],
            'keluhan_utama' => $data['keluhan_utama'] ?? null,
            'suhu_tubuh' => $data['suhu_tubuh'] ?? null,
            'tensi' => $data['tensi'] ?? null,
            'nadi' => $data['nadi'] ?? null,
            'respirasi' => $data['respirasi'] ?? null,
            'tinggi' => $data['tinggi'] ?? null,
            'berat' => $data['berat'] ?? null,
            'spo2' => $data['spo2'] ?? null,
            'gcs' => $data['gcs'] ?? null,
            'kesadaran' => $data['kesadaran'] ?? null,
            'diagnosa_utama' => $data['diagnosa_utama'] ?? null,
            'kd_diagnosa_utama' => $data['kd_diagnosa_utama'] ?? null,
            'diagnosa_sekunder' => $data['diagnosa_sekunder'] ?? null,
            'kd_diagnosa_sekunder' => $data['kd_diagnosa_sekunder'] ?? null,
            'diagnosa_sekunder2' => $data['diagnosa_sekunder2'] ?? null,
            'kd_diagnosa_sekunder2' => $data['kd_diagnosa_sekunder2'] ?? null,
            'diagnosa_sekunder3' => $data['diagnosa_sekunder3'] ?? null,
            'kd_diagnosa_sekunder3' => $data['kd_diagnosa_sekunder3'] ?? null,
            'diagnosa_sekunder4' => $data['diagnosa_sekunder4'] ?? null,
            'kd_diagnosa_sekunder4' => $data['kd_diagnosa_sekunder4'] ?? null,
            'prosedur_utama' => $data['prosedur_utama'] ?? null,
            'kd_prosedur_utama' => $data['kd_prosedur_utama'] ?? null,
            'prosedur_sekunder' => $data['prosedur_sekunder'] ?? null,
            'kd_prosedur_sekunder' => $data['kd_prosedur_sekunder'] ?? null,
            'prosedur_sekunder2' => $data['prosedur_sekunder2'] ?? null,
            'kd_prosedur_sekunder2' => $data['kd_prosedur_sekunder2'] ?? null,
            'prosedur_sekunder3' => $data['prosedur_sekunder3'] ?? null,
            'kd_prosedur_sekunder3' => $data['kd_prosedur_sekunder3'] ?? null,
            'kondisi_pulang' => $data['kondisi_pulang'] ?? null,
            'obat_pulang' => $data['obat_pulang'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Simpan ke dua tabel
        $this->db->trans_begin();

        $this->db->insert($this->table_resume, $data_resume);
        $this->db->insert($this->table_ttv, $data_ttv);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }



    public function update($no_rawat, $data_resume, $data_ttv)
    {
        if (empty($no_rawat)) {
            return false;
        }

        $this->db->trans_begin();

        $this->db->where('no_rawat', $no_rawat)->update($this->table_resume, $data_resume);
        $this->db->where('no_rawat', $no_rawat)->update($this->table_ttv, $data_ttv);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function delete($no_rawat)
    {
        return $this->db->where('no_rawat', $no_rawat)->delete($this->table_resume);
    }


    public function get_riwayat_by_norm($no_rkm_medis) {
        $this->db->select('
            r.*,
            rp.tgl_registrasi,
            d.nm_dokter,
            pl.nm_poli,
            r.diagnosa_utama
        ');
        $this->db->from("$this->table_resume r");
        $this->db->join('reg_periksa rp', 'r.no_rawat = rp.no_rawat');
        $this->db->join('dokter d', 'r.kd_dokter = d.kd_dokter');
        $this->db->join('poliklinik pl', 'rp.kd_poli = pl.kd_poli', 'left');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('rp.tgl_registrasi', 'DESC');
        return $this->db->get()->result_array();
    }


    public function get_last_ttv($no_rawat) {
        $this->db->select('suhu_tubuh, tensi, nadi, respirasi, tinggi, berat, spo2, gcs, kesadaran, keluhan');
        $this->db->from('pemeriksaan_ralan');
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_perawatan', 'DESC');
        $this->db->order_by('jam_rawat', 'DESC');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function get_diagnosa_pasien($no_rawat) {
        return $this->db->select('diagnosa_pasien.kd_penyakit, penyakit.nm_penyakit')
            ->from('diagnosa_pasien')
            ->join('penyakit', 'diagnosa_pasien.kd_penyakit = penyakit.kd_penyakit')
            ->where('diagnosa_pasien.no_rawat', $no_rawat)
            ->order_by('diagnosa_pasien.prioritas', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_prosedur_pasien($no_rawat) {
        $this->db->select('prosedur_pasien.kode, icd9.deskripsi_panjang');
        $this->db->from('prosedur_pasien');
        $this->db->join('icd9', 'prosedur_pasien.kode = icd9.kode');
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('prioritas');
        return $this->db->get()->result_array();
    }

    public function get_detail_by_no_rawat($no_rawat)
    {
        return $this->db->select('r.*, 
                rp.no_rkm_medis, 
                p.nm_pasien, 
                p.jk, 
                TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()) AS umur_thn,
                TIMESTAMPDIFF(MONTH, p.tgl_lahir, CURDATE()) % 12 AS umur_bln,
                TIMESTAMPDIFF(DAY, DATE_ADD(DATE_ADD(p.tgl_lahir, 
                    INTERVAL TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()) YEAR),
                    INTERVAL TIMESTAMPDIFF(MONTH, p.tgl_lahir, CURDATE()) % 12 MONTH), CURDATE()) AS umur_hr,
                CONCAT(
                  TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()), " Th ",
                  TIMESTAMPDIFF(MONTH, p.tgl_lahir, CURDATE()) % 12, " Bl ",
                  TIMESTAMPDIFF(DAY, DATE_ADD(DATE_ADD(p.tgl_lahir, 
                      INTERVAL TIMESTAMPDIFF(YEAR, p.tgl_lahir, CURDATE()) YEAR),
                      INTERVAL TIMESTAMPDIFF(MONTH, p.tgl_lahir, CURDATE()) % 12 MONTH), CURDATE()), " Hr"
                ) AS umur_lengkap,
                pj.png_jawab')
            ->from('moiz_resume_pasien_ralan r')
            ->join('reg_periksa rp', 'r.no_rawat = rp.no_rawat')
            ->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis')
            ->join('penjab pj', 'rp.kd_pj = pj.kd_pj')
            ->where('r.no_rawat', $no_rawat)
            ->get()
            ->row_array();
    }

}

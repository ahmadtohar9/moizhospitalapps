<?php
/**
 * CONTOH IMPLEMENTASI METHOD DI MODEL
 * 
 * File ini adalah CONTOH method yang perlu ditambahkan
 * di RiwayatPasien_model.php
 * 
 * CARA PAKAI:
 * 1. Buka application/models/RiwayatPasien_model.php
 * 2. Copy method-method di bawah ini
 * 3. Paste di dalam class RiwayatPasien_model
 * 4. Sesuaikan nama tabel dan field dengan database Anda
 * 
 * PENTING: 
 * - Sesuaikan nama tabel dengan database Anda
 * - Sesuaikan nama field dengan database Anda
 * - Test query di phpMyAdmin dulu sebelum implementasi
 * 
 * Dibuat: 2025-12-18
 */

class RiwayatPasien_model extends CI_Model
{

    // ... existing code ...

    /**
     * Ambil data kunjungan berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_visit_by_norawat($no_rawat)
    {
        $this->db->select('
            rp.no_rawat,
            rp.no_rkm_medis,
            rp.tgl_registrasi,
            rp.status_lanjut,
            rp.kd_poli,
            rp.kd_dokter,
            rp.kd_pj,
            p.nm_poli,
            d.nm_dokter,
            pj.png_jawab
        ');
        $this->db->from('reg_periksa rp');
        $this->db->join('poliklinik p', 'rp.kd_poli = p.kd_poli', 'left');
        $this->db->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('penjab pj', 'rp.kd_pj = pj.kd_pj', 'left');
        $this->db->where('rp.no_rawat', $no_rawat);

        return $this->db->get()->row_array();
    }

    /**
     * Ambil data SOAP berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_soap_by_norawat($no_rawat)
    {
        // SESUAIKAN nama tabel dengan database Anda
        // Contoh tabel: pemeriksaan_ralan, pemeriksaan_ranap, dll

        $this->db->where('no_rawat', $no_rawat);
        $soap = $this->db->get('pemeriksaan_ralan')->row_array();

        if (empty($soap)) {
            return null;
        }

        // Format data SOAP
        // SESUAIKAN nama field dengan database Anda
        return array(
            'keluhan' => $soap['keluhan'] ?? '',
            'pemeriksaan' => $soap['pemeriksaan'] ?? '',
            'penilaian' => $soap['penilaian'] ?? '',
            'rtl' => $soap['rtl'] ?? '',
            'instruksi' => $soap['instruksi'] ?? '',
            'vital_signs' => array(
                'suhu' => $soap['suhu_tubuh'] ?? '',
                'tensi' => $soap['tensi'] ?? '',
                'nadi' => $soap['nadi'] ?? '',
                'respirasi' => $soap['respirasi'] ?? '',
                'tinggi' => $soap['tinggi'] ?? '',
                'berat' => $soap['berat'] ?? '',
                'spo2' => $soap['spo2'] ?? '',
                'gcs' => $soap['gcs'] ?? '',
            )
        );
    }

    /**
     * Ambil data diagnosa berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array
     */
    public function get_diagnosa_by_norawat($no_rawat)
    {
        $this->db->select('
            dp.kd_penyakit,
            p.nm_penyakit,
            dp.status,
            dp.prioritas
        ');
        $this->db->from('diagnosa_pasien dp');
        $this->db->join('penyakit p', 'dp.kd_penyakit = p.kd_penyakit', 'left');
        $this->db->where('dp.no_rawat', $no_rawat);
        $this->db->order_by('dp.prioritas', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil data prosedur berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array
     */
    public function get_prosedur_by_norawat($no_rawat)
    {
        $this->db->select('
            pp.kode,
            icd.deskripsi_panjang,
            pp.status,
            pp.prioritas
        ');
        $this->db->from('prosedur_pasien pp');
        $this->db->join('icd9 icd', 'pp.kode = icd.kode', 'left');
        $this->db->where('pp.no_rawat', $no_rawat);
        $this->db->order_by('pp.prioritas', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil data tindakan berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array
     */
    public function get_tindakan_by_norawat($no_rawat)
    {
        // SESUAIKAN dengan tabel tindakan di database Anda
        // Contoh: rawat_jl_dr, rawat_inap_dr, dll

        $this->db->select('
            rjd.nm_perawatan,
            rjd.tgl_perawatan,
            d.nm_dokter,
            p.nama as nm_petugas,
            rjd.keterangan
        ');
        $this->db->from('rawat_jl_dr rjd');
        $this->db->join('dokter d', 'rjd.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('petugas p', 'rjd.nip = p.nip', 'left');
        $this->db->where('rjd.no_rawat', $no_rawat);
        $this->db->order_by('rjd.tgl_perawatan', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil data lab berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_lab_by_norawat($no_rawat)
    {
        // SESUAIKAN dengan struktur tabel lab di database Anda

        // 1. Ambil info permintaan lab
        $this->db->select('
            pl.noorder,
            pl.tgl_permintaan,
            pl.tgl_hasil,
            d.nm_dokter,
            pl.catatan_dokter
        ');
        $this->db->from('permintaan_lab pl');
        $this->db->join('dokter d', 'pl.kd_dokter = d.kd_dokter', 'left');
        $this->db->where('pl.no_rawat', $no_rawat);
        $info = $this->db->get()->row_array();

        if (empty($info)) {
            return null;
        }

        // 2. Ambil hasil lab
        $this->db->select('
            hl.nm_perawatan,
            hl.nilai,
            hl.satuan,
            hl.nilai_rujukan
        ');
        $this->db->from('hasil_lab hl');
        $this->db->where('hl.no_rawat', $no_rawat);
        $this->db->order_by('hl.id_template', 'ASC');
        $hasil = $this->db->get()->result_array();

        return array(
            'info' => $info,
            'hasil' => $hasil
        );
    }

    /**
     * Ambil data radiologi berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_radiologi_by_norawat($no_rawat)
    {
        // SESUAIKAN dengan struktur tabel radiologi di database Anda

        // 1. Ambil info permintaan radiologi
        $this->db->select('
            pr.noorder,
            pr.tgl_permintaan,
            pr.tgl_hasil,
            d.nm_dokter,
            dr.nm_dokter as nm_dokter_baca,
            pr.catatan_dokter
        ');
        $this->db->from('permintaan_radiologi pr');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'left');
        $this->db->join('dokter dr', 'pr.kd_dokter_baca = dr.kd_dokter', 'left');
        $this->db->where('pr.no_rawat', $no_rawat);
        $info = $this->db->get()->row_array();

        if (empty($info)) {
            return null;
        }

        // 2. Ambil hasil radiologi
        $this->db->select('
            hr.nm_perawatan,
            hr.proyeksi,
            hr.hasil,
            hr.kesan,
            hr.gambar
        ');
        $this->db->from('hasil_radiologi hr');
        $this->db->where('hr.no_rawat', $no_rawat);
        $this->db->order_by('hr.tgl_hasil', 'ASC');
        $hasil = $this->db->get()->result_array();

        return array(
            'info' => $info,
            'hasil' => $hasil
        );
    }

    /**
     * Ambil data asesmen IGD berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_asesmen_igd_by_norawat($no_rawat)
    {
        // SESUAIKAN dengan tabel asesmen IGD di database Anda

        $this->db->where('no_rawat', $no_rawat);
        $asesmen = $this->db->get('penilaian_medis_igd')->row_array();

        if (empty($asesmen)) {
            return null;
        }

        // Format data asesmen
        return array(
            'anamnesis' => true,
            'keluhan_utama' => $asesmen['keluhan_utama'] ?? '',
            'riwayat_penyakit_sekarang' => $asesmen['rps'] ?? '',
            'riwayat_penyakit_dahulu' => $asesmen['rpd'] ?? '',
            'riwayat_alergi' => $asesmen['alergi'] ?? '',

            'pemeriksaan_fisik' => true,
            'vital_signs' => array(
                'Kesadaran' => $asesmen['kesadaran'] ?? '',
                'GCS' => $asesmen['gcs'] ?? '',
                'Suhu' => ($asesmen['suhu'] ?? '') . ' °C',
                'Tekanan Darah' => ($asesmen['td'] ?? '') . ' mmHg',
                'Nadi' => ($asesmen['nadi'] ?? '') . ' x/menit',
                'Respirasi' => ($asesmen['respirasi'] ?? '') . ' x/menit',
                'SpO2' => ($asesmen['spo2'] ?? '') . ' %',
            ),

            'pemeriksaan_sistematis' => array(
                'Kepala' => $asesmen['kepala'] ?? '',
                'Mata' => $asesmen['mata'] ?? '',
                'THT' => $asesmen['tht'] ?? '',
                'Leher' => $asesmen['leher'] ?? '',
                'Thorax' => $asesmen['thorax'] ?? '',
                'Abdomen' => $asesmen['abdomen'] ?? '',
                'Ekstremitas' => $asesmen['ekstremitas'] ?? '',
            ),

            'lokalis_image' => $asesmen['gambar_lokalis'] ?? '',
            'diagnosis_kerja' => $asesmen['diagnosis_kerja'] ?? '',
            'tatalaksana' => $asesmen['tatalaksana'] ?? '',
            'instruksi' => $asesmen['instruksi'] ?? '',
        );
    }

    /**
     * Ambil data resume medis berdasarkan no_rawat
     * 
     * @param string $no_rawat
     * @return array|null
     */
    public function get_resume_by_norawat($no_rawat)
    {
        // SESUAIKAN dengan tabel resume medis di database Anda

        $this->db->where('no_rawat', $no_rawat);
        $resume = $this->db->get('resume_pasien')->row_array();

        if (empty($resume)) {
            return null;
        }

        // Ambil diagnosis utama
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('status', 'Primer');
        $this->db->join('penyakit p', 'diagnosa_pasien.kd_penyakit = p.kd_penyakit');
        $diagnosis_utama = $this->db->get('diagnosa_pasien')->row_array();

        // Ambil diagnosis sekunder
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('status', 'Sekunder');
        $this->db->join('penyakit p', 'diagnosa_pasien.kd_penyakit = p.kd_penyakit');
        $diagnosis_sekunder = $this->db->get('diagnosa_pasien')->result_array();

        // Ambil prosedur utama
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('status', 'Primer');
        $this->db->join('icd9', 'prosedur_pasien.kode = icd9.kode');
        $prosedur_utama = $this->db->get('prosedur_pasien')->row_array();

        // Ambil prosedur sekunder
        $this->db->where('no_rawat', $no_rawat);
        $this->db->where('status', 'Sekunder');
        $this->db->join('icd9', 'prosedur_pasien.kode = icd9.kode');
        $prosedur_sekunder = $this->db->get('prosedur_pasien')->result_array();

        // Ambil obat pulang
        $this->db->where('no_rawat', $no_rawat);
        $obat_pulang = $this->db->get('resep_pulang')->result_array();

        // Format data resume
        return array(
            'info_rawat_inap' => array(
                'tgl_masuk' => $resume['tgl_masuk'] ?? '',
                'tgl_keluar' => $resume['tgl_keluar'] ?? '',
                'lama_rawat' => $resume['lama_rawat'] ?? '',
                'ruang' => $resume['nm_bangsal'] ?? '',
            ),

            'ringkasan_riwayat' => $resume['ringkasan_riwayat'] ?? '',
            'pemeriksaan_fisik' => $resume['pemeriksaan_fisik'] ?? '',
            'pemeriksaan_penunjang' => $resume['pemeriksaan_penunjang'] ?? '',
            'terapi' => $resume['terapi'] ?? '',

            'diagnosis_utama' => array(
                'kode' => $diagnosis_utama['kd_penyakit'] ?? '',
                'nama' => $diagnosis_utama['nm_penyakit'] ?? '',
            ),

            'diagnosis_sekunder' => array_map(function ($d) {
                return array(
                    'kode' => $d['kd_penyakit'],
                    'nama' => $d['nm_penyakit'],
                );
            }, $diagnosis_sekunder),

            'prosedur_utama' => array(
                'kode' => $prosedur_utama['kode'] ?? '',
                'nama' => $prosedur_utama['deskripsi_panjang'] ?? '',
            ),

            'prosedur_sekunder' => array_map(function ($p) {
                return array(
                    'kode' => $p['kode'],
                    'nama' => $p['deskripsi_panjang'],
                );
            }, $prosedur_sekunder),

            'kondisi_keluar' => array(
                'keadaan' => $resume['keadaan_keluar'] ?? '',
                'cara_keluar' => $resume['cara_keluar'] ?? '',
            ),

            'obat_pulang' => array_map(function ($o) {
                return array(
                    'nama_obat' => $o['nama_obat'],
                    'dosis' => $o['dosis'],
                    'frekuensi' => $o['frekuensi'],
                    'keterangan' => $o['keterangan'],
                );
            }, $obat_pulang),

            'anjuran' => $resume['anjuran'] ?? '',
        );
    }

    // ... existing code ...
}

/**
 * CATATAN PENTING:
 * 
 * 1. SESUAIKAN nama tabel dengan database Anda:
 *    - reg_periksa
 *    - pemeriksaan_ralan
 *    - diagnosa_pasien
 *    - prosedur_pasien
 *    - rawat_jl_dr
 *    - permintaan_lab
 *    - hasil_lab
 *    - permintaan_radiologi
 *    - hasil_radiologi
 *    - penilaian_medis_igd
 *    - resume_pasien
 * 
 * 2. SESUAIKAN nama field dengan database Anda
 * 
 * 3. TEST query di phpMyAdmin sebelum implementasi
 * 
 * 4. Tambahkan error handling jika diperlukan
 * 
 * 5. Gunakan prepared statement untuk keamanan
 */

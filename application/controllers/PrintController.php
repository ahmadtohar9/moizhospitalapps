<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PRINT CONTROLLER - SIMRS MOIZ ANDINI
 *
 * Controller khusus untuk seluruh kebutuhan CETAK (server-side rendering)
 * Fokus: dokumen medis legal (audit, akreditasi, BPJS)
 *
 * ENDPOINT UTAMA:
 * - /print/riwayat_pasien/{no_rawat}
 *
 * Dibuat: 2025-12-18
 */

class PrintController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('berkas');
    }

    /**
     * CETAK RIWAYAT PASIEN (BULK)
     * --------------------------------
     * Prinsip:
     * - Bulk = loop per kunjungan
     * - Sumber data SAMA dengan cetak per kunjungan
     * - View hanya render, TIDAK logika berat
     */
    public function riwayat_pasien($no_rawat)
    {
        // ================== VALIDASI AWAL ==================
        if (empty($no_rawat)) {
            show_error('No. Rawat tidak valid');
        }

        // Convert dash to slash (URL encoding issue)
        // 2025-12-18-000001 -> 2025/12/18/000001
        $no_rawat = str_replace('-', '/', $no_rawat);

        // ================== HEADER PASIEN (KUNJUNGAN AKTIF) ==================
        $visit = $this->db->query("
            SELECT 
                rp.no_rawat,
                rp.no_rkm_medis,
                p.nm_pasien,
                p.jk,
                p.tgl_lahir,
                p.alamat,
                rp.tgl_registrasi,
                rp.jam_reg,
                pl.nm_poli,
                d.nm_dokter,
                pj.png_jawab
            FROM reg_periksa rp
            JOIN pasien p ON p.no_rkm_medis = rp.no_rkm_medis
            JOIN poliklinik pl ON pl.kd_poli = rp.kd_poli
            JOIN dokter d ON d.kd_dokter = rp.kd_dokter
            JOIN penjab pj ON pj.kd_pj = rp.kd_pj
            WHERE rp.no_rawat = ?
            LIMIT 1
        ", [$no_rawat])->row();

        if (!$visit) {
            show_error('Data pasien tidak ditemukan');
        }

        // ================== FETCH SEMUA DATA (SAMA SEPERTI BULK) ==================
        $d = new stdClass();
        $d->no_rawat = $no_rawat;
        $d->visit_info = $visit;

        // 1. ASESMEN IGD
        $d->igd = $this->db->get_where('penilaian_medis_igd', ['no_rawat' => $no_rawat])->row();
        if ($d->igd) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->igd->lokalis_url = base_url($path);
            }
        }

        // 2. ASESMEN KANDUNGAN
        $d->kandungan = $this->db->get_where('penilaian_medis_ralan_kandungan', ['no_rawat' => $no_rawat])->row();

        // 3. ASESMEN MATA
        $d->mata = $this->db->get_where('penilaian_medis_ralan_mata', ['no_rawat' => $no_rawat])->row();
        if ($d->mata) {
            $filename = str_replace('/', '_', $no_rawat);
            $path_od = 'assets/images/mata/' . $filename . '_od.png';
            if (file_exists(FCPATH . $path_od)) {
                $d->mata->gambar_od_url = base_url($path_od);
            }
            $path_os = 'assets/images/mata/' . $filename . '_os.png';
            if (file_exists(FCPATH . $path_os)) {
                $d->mata->gambar_os_url = base_url($path_os);
            }
        }

        // 4. ASESMEN PENYAKIT DALAM
        $d->penyakit_dalam = $this->db->get_where('penilaian_medis_ralan_penyakit_dalam', ['no_rawat' => $no_rawat])->row();
        if ($d->penyakit_dalam) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_pd/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->penyakit_dalam->lokalis_url = base_url($path);
            }
        }

        // 5. ASESMEN ORTHOPEDI
        $d->orthopedi = $this->db->get_where('penilaian_medis_ralan_orthopedi', ['no_rawat' => $no_rawat])->row();
        if ($d->orthopedi) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_orthopedi/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->orthopedi->lokalis_url = base_url($path);
            }
        }

        // --- TAMBAHAN ASESMEN BARU ---

        // 5.1 ASESMEN ANAK
        $d->anak = $this->db->get_where('penilaian_medis_ralan_anak', ['no_rawat' => $no_rawat])->row();
        if ($d->anak) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_anak/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->anak->lokalis_url = base_url($path);
            }
        }

        // 5.2 ASESMEN BEDAH
        $d->bedah = $this->db->get_where('penilaian_medis_ralan_bedah', ['no_rawat' => $no_rawat])->row();
        if ($d->bedah) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_bedah/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->bedah->lokalis_url = base_url($path);
            }
        }

        // 5.3 ASESMEN THT
        $d->tht = $this->db->get_where('penilaian_medis_ralan_tht', ['no_rawat' => $no_rawat])->row();
        if ($d->tht) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_tht/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->tht->lokalis_url = base_url($path);
            }
        }

        // 5.4 ASESMEN JANTUNG
        $d->jantung = $this->db->get_where('penilaian_medis_ralan_jantung', ['no_rawat' => $no_rawat])->row();
        if ($d->jantung) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_jantung/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->jantung->lokalis_url = base_url($path);
            }
        }

        // 5.5 ASESMEN KULIT & KELAMIN
        $d->kulitdankelamin = $this->db->get_where('penilaian_medis_ralan_kulitdankelamin', ['no_rawat' => $no_rawat])->row();
        if ($d->kulitdankelamin) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_kulitdankelamin/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->kulitdankelamin->lokalis_url = base_url($path);
            }
        }

        // 5.6 ASESMEN NEUROLOGI
        $d->neurologi = $this->db->get_where('penilaian_medis_ralan_neurologi', ['no_rawat' => $no_rawat])->row();
        if ($d->neurologi) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_neurologi/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->neurologi->lokalis_url = base_url($path);
            }
        }

        // 5.7 ASESMEN PARU
        $d->paru = $this->db->get_where('penilaian_medis_ralan_paru', ['no_rawat' => $no_rawat])->row();
        if ($d->paru) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_paru/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->paru->lokalis_url = base_url($path);
            }
        }

        // 5.8 ASESMEN PSIKIATRIK
        $d->psikiatrik = $this->db->get_where('penilaian_medis_ralan_psikiatrik', ['no_rawat' => $no_rawat])->row();

        // 5.9 ASESMEN IGD PSIKIATRI
        $d->igdPsikiatri = $this->db->get_where('penilaian_medis_ralan_gawat_darurat_psikiatri', ['no_rawat' => $no_rawat])->row();
        if ($d->igdPsikiatri) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $path = 'assets/images/lokalis_igd_psikiatri/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists(FCPATH . $path)) {
                $d->igdPsikiatri->lokalis_url = base_url($path);
            }
        }

        // 5.10 ASESMEN GERIATRI
        $d->geriatri = $this->db->get_where('penilaian_medis_ralan_geriatri', ['no_rawat' => $no_rawat])->row();

        // 5.11 ASESMEN REHAB MEDIK (MEDIS)
        $d->asesmenRehabMedik = $this->db->get_where('penilaian_medis_ralan_rehab_medik', ['no_rawat' => $no_rawat])->row();

        // 5.12 ASESMEN UROLOGI
        $d->asesmenUrologi = $this->db->get_where('penilaian_medis_ralan_urologi', ['no_rawat' => $no_rawat])->row();

        // 6. RESUME MEDIS
        $d->resume = $this->db->get_where('resume_pasien', ['no_rawat' => $no_rawat])->row();

        // 7. SOAP
        $d->soap = $this->db->query("
            SELECT *
            FROM pemeriksaan_ralan
            WHERE no_rawat = ?
            ORDER BY tgl_perawatan ASC, jam_rawat ASC
        ", [$no_rawat])->result();

        // 8. DIAGNOSA
        $d->diagnosa = $this->db->query("
            SELECT dp.*, p.nm_penyakit
            FROM diagnosa_pasien dp
            JOIN penyakit p ON p.kd_penyakit = dp.kd_penyakit
            WHERE dp.no_rawat = ?
        ", [$no_rawat])->result();

        // 9. PROSEDUR
        $d->prosedur = $this->db->query("
            SELECT pr.*, icd.deskripsi_panjang AS nama
            FROM prosedur_pasien pr
            JOIN icd9 icd ON icd.kode = pr.kode
            WHERE pr.no_rawat = ?
        ", [$no_rawat])->result();

        // 10. TINDAKAN
        $d->tindakan = $this->db->query("
            SELECT tgl_perawatan, jam_rawat, nm_perawatan, operator, biaya_rawat 
            FROM (
                SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, d.nm_dokter AS operator, rj.biaya_rawat
                FROM rawat_jl_dr rj
                JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw
                JOIN dokter d ON d.kd_dokter = rj.kd_dokter
                WHERE rj.no_rawat = ?
                
                UNION ALL
                
                SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, pt.nama AS operator, rj.biaya_rawat
                FROM rawat_jl_pr rj
                JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw
                JOIN petugas pt ON pt.nip = rj.nip
                WHERE rj.no_rawat = ?
            ) combined
            ORDER BY tgl_perawatan ASC, jam_rawat ASC
        ", [$no_rawat, $no_rawat])->result();

        // 11. RESEP
        $d->resep = $this->db->query("
            SELECT 
                ro.no_resep, ro.tgl_perawatan, ro.jam,
                d.nm_dokter,
                db.nama_brng AS nama_obat,
                db.ralan AS harga_satuan,
                (db.ralan * rd.jml) AS total_biaya,
                rd.jml, rd.aturan_pakai
            FROM resep_obat ro
            JOIN resep_dokter rd ON rd.no_resep = ro.no_resep
            JOIN databarang db ON db.kode_brng = rd.kode_brng
            LEFT JOIN dokter d ON d.kd_dokter = ro.kd_dokter
            WHERE ro.no_rawat = ?
            ORDER BY ro.tgl_perawatan ASC, ro.jam ASC
        ", [$no_rawat])->result();

        // 12. LAB
        $d->lab = $this->db->query("
            SELECT *
            FROM periksa_lab
            WHERE no_rawat = ?
        ", [$no_rawat])->result();

        // 13. RADIOLOGI
        $d->radiologi = $this->db->query("
            SELECT *
            FROM periksa_radiologi
            WHERE no_rawat = ?
        ", [$no_rawat])->result();

        // 14. KFR
        $d->kfr = $this->db->select('k.*, d.nm_dokter')
            ->from('moizhospital_lembarKFR_rehabmedik k')
            ->join('dokter d', 'k.kd_dokter = d.kd_dokter', 'left')
            ->where('k.no_rawat', $no_rawat)
            ->order_by('k.tgl_perawatan', 'DESC')
            ->order_by('k.jam_rawat', 'DESC')
            ->get()->result();

        // 15. REHAB MEDIK
        $d->rehab_medik = $this->db->select('r.*, d.nm_dokter, p.nama as nm_petugas')
            ->from('moizhospital_program_rehabmedik r')
            ->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left')
            ->join('petugas p', 'r.nip_tim_rehab = p.nip', 'left')
            ->where('r.no_rawat', $no_rawat)
            ->order_by('r.tgl_perawatan', 'DESC')
            ->order_by('r.jam_rawat', 'DESC')
            ->get()->result();

        // 16. BERKAS DIGITAL
        $d->berkas_digital = $this->db->select('no_rawat, kode, lokasi_file')
            ->from('berkas_digital_perawatan')
            ->where('no_rawat', $no_rawat)
            ->order_by('kode', 'ASC')
            ->get()->result();

        // 17. ASESMEN KEPERAWATAN
        $d->asesmen_keperawatan = $this->db->select('ak.*, p.nama as nm_petugas')
            ->from('penilaian_awal_keperawatan_ralan ak')
            ->join('petugas p', 'ak.nip = p.nip', 'left')
            ->where('ak.no_rawat', $no_rawat)
            ->order_by('ak.tanggal', 'DESC')
            ->get()->result();

        // 18. OPERASI (dengan total biaya)
        $d->operasi = $this->db->select("
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
            p16.nama AS nm_omloop5,
            lo.diagnosa_preop,
            lo.diagnosa_postop,
            lo.laporan_operasi,
            lo.jaringan_dieksekusi,
            lo.selesaioperasi,
            lo.permintaan_pa,
            lo.nomor_implan,
            (
                COALESCE(o.biayaoperator1, 0) +
                COALESCE(o.biayaoperator2, 0) +
                COALESCE(o.biayaoperator3, 0) +
                COALESCE(o.biayaasisten_operator1, 0) +
                COALESCE(o.biayaasisten_operator2, 0) +
                COALESCE(o.biayaasisten_operator3, 0) +
                COALESCE(o.biayainstrumen, 0) +
                COALESCE(o.biayadokter_anak, 0) +
                COALESCE(o.biayaperawaat_resusitas, 0) +
                COALESCE(o.biayadokter_anestesi, 0) +
                COALESCE(o.biayaasisten_anestesi, 0) +
                COALESCE(o.biayaasisten_anestesi2, 0) +
                COALESCE(o.biayabidan, 0) +
                COALESCE(o.biayabidan2, 0) +
                COALESCE(o.biayabidan3, 0) +
                COALESCE(o.biayaperawat_luar, 0) +
                COALESCE(o.biayaalat, 0) +
                COALESCE(o.biayasewaok, 0) +
                COALESCE(o.akomodasi, 0) +
                COALESCE(o.bagian_rs, 0) +
                COALESCE(o.biaya_omloop, 0) +
                COALESCE(o.biaya_omloop2, 0) +
                COALESCE(o.biaya_omloop3, 0) +
                COALESCE(o.biaya_omloop4, 0) +
                COALESCE(o.biaya_omloop5, 0) +
                COALESCE(o.biayasarpras, 0) +
                COALESCE(o.biaya_dokter_pjanak, 0) +
                COALESCE(o.biaya_dokter_umum, 0)
            ) AS total_biaya
        ")
            ->from('operasi o')
            ->join('paket_operasi p', 'o.kode_paket = p.kode_paket', 'left')
            ->join('laporan_operasi lo', 'o.no_rawat = lo.no_rawat AND o.tgl_operasi = lo.tanggal', 'left')
            ->join('dokter d1', 'o.operator1 = d1.kd_dokter', 'left')
            ->join('dokter d2', 'o.operator2 = d2.kd_dokter', 'left')
            ->join('dokter d3', 'o.operator3 = d3.kd_dokter', 'left')
            ->join('dokter d4', 'o.dokter_anestesi = d4.kd_dokter', 'left')
            ->join('dokter d5', 'o.dokter_anak = d5.kd_dokter', 'left')
            ->join('dokter d6', 'o.dokter_pjanak = d6.kd_dokter', 'left')
            ->join('dokter d7', 'o.dokter_umum = d7.kd_dokter', 'left')
            ->join('petugas p1', 'o.asisten_operator1 = p1.nip', 'left')
            ->join('petugas p2', 'o.asisten_operator2 = p2.nip', 'left')
            ->join('petugas p3', 'o.asisten_operator3 = p3.nip', 'left')
            ->join('petugas p4', 'o.asisten_anestesi = p4.nip', 'left')
            ->join('petugas p5', 'o.asisten_anestesi2 = p5.nip', 'left')
            ->join('petugas p6', 'o.perawaat_resusitas = p6.nip', 'left')
            ->join('petugas p7', 'o.perawat_luar = p7.nip', 'left')
            ->join('petugas p8', 'o.bidan = p8.nip', 'left')
            ->join('petugas p9', 'o.bidan2 = p9.nip', 'left')
            ->join('petugas p10', 'o.bidan3 = p10.nip', 'left')
            ->join('petugas p11', 'o.instrumen = p11.nip', 'left')
            ->join('petugas p12', 'o.omloop = p12.nip', 'left')
            ->join('petugas p13', 'o.omloop2 = p13.nip', 'left')
            ->join('petugas p14', 'o.omloop3 = p14.nip', 'left')
            ->join('petugas p15', 'o.omloop4 = p15.nip', 'left')
            ->join('petugas p16', 'o.omloop5 = p16.nip', 'left')
            ->where('o.no_rawat', $no_rawat)
            ->order_by('o.tgl_operasi', 'DESC')
            ->get()->result();

        // ================== FETCH HOSPITAL INFO ==================
        $hospital = $this->db->get('setting', 1)->row();

        // ================== KIRIM KE VIEW ==================
        $data = [
            'hospital' => $hospital,
            'pasien' => $visit,
            'data' => $d
        ];

        $this->load->view('print/print_single', $data);
    }

    /**
     * CETAK RIWAYAT BULK (SEMUA KUNJUNGAN PASIEN)
     * ============================================
     * Endpoint: /print/riwayat_bulk/{no_rkm_medis}
     * 
     * Prinsip:
     * - Loop SEMUA kunjungan pasien
     * - Gunakan VIEW PHP yang SAMA (modular sections)
     * - Server-side rendering = print quality 100%
     * - Gambar & field LENGKAP
     */
    public function riwayat_bulk($no_rkm_medis)
    {
        // Force UTF-8 encoding at PHP level
        mb_internal_encoding('UTF-8');
        mb_http_output('UTF-8');
        ob_start();

        // Set UTF-8 encoding header
        header('Content-Type: text/html; charset=UTF-8');

        // Force MySQL UTF-8 encoding
        $this->db->query("SET NAMES 'utf8'");
        $this->db->query("SET CHARACTER SET utf8");
        $this->db->query("SET character_set_connection=utf8");

        // ================== VALIDASI ==================
        if (empty($no_rkm_medis)) {
            show_error('No. RM tidak valid');
        }

        // ================== DATA PASIEN ==================
        $patient = $this->db->get_where('pasien', ['no_rkm_medis' => $no_rkm_medis])->row();
        if (!$patient) {
            show_error('Data pasien tidak ditemukan');
        }

        // ================== HOSPITAL SETTING ==================
        $hospital = $this->db->get('setting', 1)->row();

        // ================== GET FILTERS FROM POST/GET ==================
        $date_from = $this->input->get('date_from') ?: $this->input->post('date_from');
        $date_to = $this->input->get('date_to') ?: $this->input->post('date_to');
        $poli = $this->input->get('poli') ?: $this->input->post('poli');
        $dokter = $this->input->get('dokter') ?: $this->input->post('dokter');

        // ================== SEMUA KUNJUNGAN (WITH FILTERS) ==================
        $this->db->select('
            rp.no_rawat,
            rp.tgl_registrasi,
            rp.jam_reg,
            pl.nm_poli,
            d.nm_dokter
        ');
        $this->db->from('reg_periksa rp');
        $this->db->join('poliklinik pl', 'pl.kd_poli = rp.kd_poli');
        $this->db->join('dokter d', 'd.kd_dokter = rp.kd_dokter');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);

        // Apply filters
        if (!empty($date_from)) {
            $this->db->where('rp.tgl_registrasi >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('rp.tgl_registrasi <=', $date_to);
        }
        if (!empty($poli)) {
            $this->db->where('rp.kd_poli', $poli);
        }
        if (!empty($dokter)) {
            $this->db->where('rp.kd_dokter', $dokter);
        }

        $this->db->order_by('rp.tgl_registrasi', 'ASC');
        $this->db->order_by('rp.jam_reg', 'ASC');

        $visits = $this->db->get()->result();

        if (empty($visits)) {
            show_error('Tidak ada riwayat kunjungan');
        }

        // ================== LOOP & COLLECT DATA ==================
        $sections_all = [];

        foreach ($visits as $visit) {
            $no_rawat = $visit->no_rawat;

            // Siapkan object data untuk view
            $d = new stdClass();
            $d->no_rawat = $no_rawat;
            $d->visit_info = $visit;

            // ========== FETCH SEMUA DATA SECTION ==========

            // 1. ASESMEN IGD
            $d->igd = $this->db->get_where('penilaian_medis_igd', ['no_rawat' => $no_rawat])->row();
            if ($d->igd) {
                // Add lokalis image URL
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->igd->lokalis_url = base_url($path);
                }
            }

            // 2. ASESMEN KANDUNGAN
            $d->kandungan = $this->db->get_where('penilaian_medis_ralan_kandungan', ['no_rawat' => $no_rawat])->row();

            // 3. ASESMEN MATA
            $d->mata = $this->db->get_where('penilaian_medis_ralan_mata', ['no_rawat' => $no_rawat])->row();
            if ($d->mata) {
                // Add mata diagram images (OD & OS)
                $filename = str_replace('/', '_', $no_rawat);

                // Gambar OD (Mata Kanan)
                $path_od = 'assets/images/mata/' . $filename . '_od.png';
                if (file_exists(FCPATH . $path_od)) {
                    $d->mata->gambar_od_url = base_url($path_od);
                }

                // Gambar OS (Mata Kiri)
                $path_os = 'assets/images/mata/' . $filename . '_os.png';
                if (file_exists(FCPATH . $path_os)) {
                    $d->mata->gambar_os_url = base_url($path_os);
                }
            }

            // 4. ASESMEN PENYAKIT DALAM
            $d->penyakit_dalam = $this->db->get_where('penilaian_medis_ralan_penyakit_dalam', ['no_rawat' => $no_rawat])->row();
            if ($d->penyakit_dalam) {
                // Add lokalis image if exists
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_pd/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->penyakit_dalam->lokalis_url = base_url($path);
                }
            }

            // 5. ASESMEN ORTHOPEDI
            $d->orthopedi = $this->db->get_where('penilaian_medis_ralan_orthopedi', ['no_rawat' => $no_rawat])->row();
            if ($d->orthopedi) {
                // Add lokalis image if exists
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_orthopedi/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->orthopedi->lokalis_url = base_url($path);
                }
            }

            // 6. RESUME MEDIS
            $d->resume = $this->db->get_where('resume_pasien', ['no_rawat' => $no_rawat])->row();

            // 5. SOAP
            $d->soap = $this->db->query("
                SELECT *
                FROM pemeriksaan_ralan
                WHERE no_rawat = ?
                ORDER BY tgl_perawatan ASC, jam_rawat ASC
            ", [$no_rawat])->result();

            // 6. DIAGNOSA
            $d->diagnosa = $this->db->query("
                SELECT dp.*, p.nm_penyakit
                FROM diagnosa_pasien dp
                JOIN penyakit p ON p.kd_penyakit = dp.kd_penyakit
                WHERE dp.no_rawat = ?
            ", [$no_rawat])->result();

            // 7. PROSEDUR
            $d->prosedur = $this->db->query("
                SELECT pr.*, icd.deskripsi_panjang AS nama
                FROM prosedur_pasien pr
                JOIN icd9 icd ON icd.kode = pr.kode
                WHERE pr.no_rawat = ?
            ", [$no_rawat])->result();

            // 8. TINDAKAN (UNION dokter + perawat)
            $d->tindakan = $this->db->query("
                SELECT tgl_perawatan, jam_rawat, nm_perawatan, operator, biaya_rawat 
                FROM (
                    SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, d.nm_dokter AS operator, rj.biaya_rawat
                    FROM rawat_jl_dr rj
                    JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw
                    JOIN dokter d ON d.kd_dokter = rj.kd_dokter
                    WHERE rj.no_rawat = ?
                    
                    UNION ALL
                    
                    SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, pt.nama AS operator, rj.biaya_rawat
                    FROM rawat_jl_pr rj
                    JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw
                    JOIN petugas pt ON pt.nip = rj.nip
                    WHERE rj.no_rawat = ?
                ) combined
                ORDER BY tgl_perawatan ASC, jam_rawat ASC
            ", [$no_rawat, $no_rawat])->result();

            // 9. RESEP (dengan detail obat)
            $d->resep = $this->db->query("
                SELECT 
                    ro.no_resep, ro.tgl_perawatan, ro.jam,
                    d.nm_dokter,
                    db.nama_brng AS nama_obat,
                    db.ralan AS harga_satuan,
                    (db.ralan * rd.jml) AS total_biaya,
                    rd.jml, rd.aturan_pakai
                FROM resep_obat ro
                JOIN resep_dokter rd ON rd.no_resep = ro.no_resep
                JOIN databarang db ON db.kode_brng = rd.kode_brng
                LEFT JOIN dokter d ON d.kd_dokter = ro.kd_dokter
                WHERE ro.no_rawat = ?
                ORDER BY ro.tgl_perawatan ASC, ro.jam ASC
            ", [$no_rawat])->result();

            // 10. LAB
            $d->lab = $this->db->query("
                SELECT *
                FROM periksa_lab
                WHERE no_rawat = ?
            ", [$no_rawat])->result();

            // 11. RADIOLOGI
            $d->radiologi = $this->db->query("
                SELECT *
                FROM periksa_radiologi
                WHERE no_rawat = ?
            ", [$no_rawat])->result();

            // 12. FORMULIR KFR (Kedokteran Fisik & Rehabilitasi)
            $d->kfr = $this->db->select('k.*, d.nm_dokter')
                ->from('moizhospital_lembarKFR_rehabmedik k')
                ->join('dokter d', 'k.kd_dokter = d.kd_dokter', 'left')
                ->where('k.no_rawat', $no_rawat)
                ->order_by('k.tgl_perawatan', 'DESC')
                ->order_by('k.jam_rawat', 'DESC')
                ->get()->result();

            // 13. PROGRAM TERAPI REHAB MEDIK
            $d->rehab_medik = $this->db->select('r.*, d.nm_dokter, p.nama as nm_petugas')
                ->from('moizhospital_program_rehabmedik r')
                ->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left')
                ->join('petugas p', 'r.nip_tim_rehab = p.nip', 'left')
                ->where('r.no_rawat', $no_rawat)
                ->order_by('r.tgl_perawatan', 'DESC')
                ->order_by('r.jam_rawat', 'DESC')
                ->get()->result();

            // 14. BERKAS DIGITAL
            $d->berkas_digital = $this->db->select('no_rawat, kode, lokasi_file')
                ->from('berkas_digital_perawatan')
                ->where('no_rawat', $no_rawat)
                ->order_by('kode', 'ASC')
                ->get()->result();

            // 15. ASESMEN KEPERAWATAN
            $d->asesmen_keperawatan = $this->db->select('ak.*, p.nama as nm_petugas')
                ->from('penilaian_awal_keperawatan_ralan ak')
                ->join('petugas p', 'ak.nip = p.nip', 'left')
                ->where('ak.no_rawat', $no_rawat)
                ->order_by('ak.tanggal', 'DESC')
                ->get()->result();

            // 12. OPERASI (dengan JOIN lengkap untuk nama dokter & petugas + TOTAL BIAYA)
            $d->operasi = $this->db->select("
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
                p16.nama AS nm_omloop5,
                lo.diagnosa_preop,
                lo.diagnosa_postop,
                lo.laporan_operasi,
                lo.jaringan_dieksekusi,
                lo.selesaioperasi,
                lo.permintaan_pa,
                lo.nomor_implan,
                (
                    COALESCE(o.biayaoperator1, 0) +
                    COALESCE(o.biayaoperator2, 0) +
                    COALESCE(o.biayaoperator3, 0) +
                    COALESCE(o.biayaasisten_operator1, 0) +
                    COALESCE(o.biayaasisten_operator2, 0) +
                    COALESCE(o.biayaasisten_operator3, 0) +
                    COALESCE(o.biayainstrumen, 0) +
                    COALESCE(o.biayadokter_anak, 0) +
                    COALESCE(o.biayaperawaat_resusitas, 0) +
                    COALESCE(o.biayadokter_anestesi, 0) +
                    COALESCE(o.biayaasisten_anestesi, 0) +
                    COALESCE(o.biayaasisten_anestesi2, 0) +
                    COALESCE(o.biayabidan, 0) +
                    COALESCE(o.biayabidan2, 0) +
                    COALESCE(o.biayabidan3, 0) +
                    COALESCE(o.biayaperawat_luar, 0) +
                    COALESCE(o.biayaalat, 0) +
                    COALESCE(o.biayasewaok, 0) +
                    COALESCE(o.akomodasi, 0) +
                    COALESCE(o.bagian_rs, 0) +
                    COALESCE(o.biaya_omloop, 0) +
                    COALESCE(o.biaya_omloop2, 0) +
                    COALESCE(o.biaya_omloop3, 0) +
                    COALESCE(o.biaya_omloop4, 0) +
                    COALESCE(o.biaya_omloop5, 0) +
                    COALESCE(o.biayasarpras, 0) +
                    COALESCE(o.biaya_dokter_pjanak, 0) +
                    COALESCE(o.biaya_dokter_umum, 0)
                ) AS total_biaya
            ")
                ->from('operasi o')
                ->join('paket_operasi p', 'o.kode_paket = p.kode_paket', 'left')
                ->join('laporan_operasi lo', 'o.no_rawat = lo.no_rawat AND o.tgl_operasi = lo.tanggal', 'left')
                // DOCTORS
                ->join('dokter d1', 'o.operator1 = d1.kd_dokter', 'left')
                ->join('dokter d2', 'o.operator2 = d2.kd_dokter', 'left')
                ->join('dokter d3', 'o.operator3 = d3.kd_dokter', 'left')
                ->join('dokter d4', 'o.dokter_anestesi = d4.kd_dokter', 'left')
                ->join('dokter d5', 'o.dokter_anak = d5.kd_dokter', 'left')
                ->join('dokter d6', 'o.dokter_pjanak = d6.kd_dokter', 'left')
                ->join('dokter d7', 'o.dokter_umum = d7.kd_dokter', 'left')
                // PETUGAS
                ->join('petugas p1', 'o.asisten_operator1 = p1.nip', 'left')
                ->join('petugas p2', 'o.asisten_operator2 = p2.nip', 'left')
                ->join('petugas p3', 'o.asisten_operator3 = p3.nip', 'left')
                ->join('petugas p4', 'o.asisten_anestesi = p4.nip', 'left')
                ->join('petugas p5', 'o.asisten_anestesi2 = p5.nip', 'left')
                ->join('petugas p6', 'o.perawaat_resusitas = p6.nip', 'left')
                ->join('petugas p7', 'o.perawat_luar = p7.nip', 'left')
                ->join('petugas p8', 'o.bidan = p8.nip', 'left')
                ->join('petugas p9', 'o.bidan2 = p9.nip', 'left')
                ->join('petugas p10', 'o.bidan3 = p10.nip', 'left')
                ->join('petugas p11', 'o.instrumen = p11.nip', 'left')
                ->join('petugas p12', 'o.omloop = p12.nip', 'left')
                ->join('petugas p13', 'o.omloop2 = p13.nip', 'left')
                ->join('petugas p14', 'o.omloop3 = p14.nip', 'left')
                ->join('petugas p15', 'o.omloop4 = p15.nip', 'left')
                ->join('petugas p16', 'o.omloop5 = p16.nip', 'left')
                ->where('o.no_rawat', $no_rawat)
                ->order_by('o.tgl_operasi', 'DESC')
                ->get()->result();

            // ========== BUILD SECTIONS UNTUK KUNJUNGAN INI ==========
            $sections = [];

            // Mapping: data key => view file
            $section_map = [
                'igd' => 'asesmen_igd.php',
                'kandungan' => 'asesmen_kandungan.php',
                'mata' => 'asesmen_mata.php',
                'penyakit_dalam' => 'asesmen_penyakit_dalam.php',
                'orthopedi' => 'asesmen_orthopedi.php',
                'kfr' => 'formulir_kfr.php',
                'rehab_medik' => 'program_rehab_medik.php',
                'asesmen_keperawatan' => 'asesmen_keperawatan.php',
                'resume' => 'resume_medis.php',
                'soap' => 'soap.php',
                'diagnosa' => 'diagnosa.php',
                'prosedur' => 'prosedur.php',
                'tindakan' => 'tindakan.php',
                'resep' => 'resep.php',
                'lab' => 'lab.php',
                'radiologi' => 'radiologi.php',
                'operasi' => 'operasi.php',
                'berkas_digital' => 'berkas_digital.php'
            ];

            foreach ($section_map as $key => $view_file) {
                $data_item = $d->$key;

                // Skip jika kosong
                if (empty($data_item)) {
                    continue;
                }

                // Skip jika array kosong
                if (is_array($data_item) && count($data_item) === 0) {
                    continue;
                }

                $sections[] = [
                    'file' => $view_file,
                    'data' => ['d' => $d] // Pass entire $d object
                ];
            }

            // Simpan sections untuk kunjungan ini
            if (!empty($sections)) {
                $sections_all[] = [
                    'visit' => $visit,
                    'sections' => $sections
                ];
            }
        }

        // ================== RENDER VIEW ==================
        $data = [
            'hospital' => $hospital,
            'patient' => $patient,
            'visits_data' => $sections_all,
            'document_title' => 'RIWAYAT MEDIS LENGKAP',
            'is_bulk' => true
        ];

        $this->load->view('print/print_bulk_layout', $data);
        ob_end_flush();
    }

    /**
     * CETAK RIWAYAT BULK - PDF VERSION (DOMPDF)
     * ==========================================
     * Endpoint: /print/riwayat_bulk_pdf/{no_rkm_medis}
     * 
     * Generate PDF menggunakan Dompdf untuk hasil 100% perfect
     */
    public function riwayat_bulk_pdf($no_rkm_medis)
    {
        // Load mPDF via Composer autoload (same as Orthopedi)
        require_once APPPATH . '../vendor/autoload.php';

        // Force UTF-8 encoding at PHP level
        mb_internal_encoding('UTF-8');
        mb_http_output('UTF-8');

        // Force MySQL UTF-8 encoding
        $this->db->query("SET NAMES 'utf8'");
        $this->db->query("SET CHARACTER SET utf8");
        $this->db->query("SET character_set_connection=utf8");

        // ================== VALIDASI ==================
        if (empty($no_rkm_medis)) {
            show_error('No. RM tidak valid');
        }

        // ================== DATA PASIEN ==================
        $patient = $this->db->get_where('pasien', ['no_rkm_medis' => $no_rkm_medis])->row();
        if (!$patient) {
            show_error('Data pasien tidak ditemukan');
        }

        // ================== HOSPITAL SETTING ==================
        $hospital = $this->db->get('setting', 1)->row();

        // ================== GET FILTERS FROM POST/GET ==================
        $date_from = $this->input->get('date_from') ?: $this->input->post('date_from');
        $date_to = $this->input->get('date_to') ?: $this->input->post('date_to');
        $poli = $this->input->get('poli') ?: $this->input->post('poli');
        $dokter = $this->input->get('dokter') ?: $this->input->post('dokter');

        // ================== SEMUA KUNJUNGAN (WITH FILTERS) ==================
        $this->db->select('
            rp.no_rawat,
            rp.tgl_registrasi,
            rp.jam_reg,
            pl.nm_poli,
            d.nm_dokter
        ');
        $this->db->from('reg_periksa rp');
        $this->db->join('poliklinik pl', 'pl.kd_poli = rp.kd_poli');
        $this->db->join('dokter d', 'd.kd_dokter = rp.kd_dokter');
        $this->db->where('rp.no_rkm_medis', $no_rkm_medis);

        // Apply filters
        if (!empty($date_from)) {
            $this->db->where('rp.tgl_registrasi >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('rp.tgl_registrasi <=', $date_to);
        }
        if (!empty($poli)) {
            $this->db->where('rp.kd_poli', $poli);
        }
        if (!empty($dokter)) {
            $this->db->where('rp.kd_dokter', $dokter);
        }

        $this->db->order_by('rp.tgl_registrasi', 'ASC');
        $this->db->order_by('rp.jam_reg', 'ASC');

        $visits = $this->db->get()->result();

        if (empty($visits)) {
            show_error('Tidak ada riwayat kunjungan');
        }

        // ================== LOOP & COLLECT DATA ==================
        $sections_all = [];

        foreach ($visits as $visit) {
            $no_rawat = $visit->no_rawat;

            $d = new stdClass();
            $d->no_rawat = $no_rawat;
            $d->visit_info = $visit;

            // Fetch all data (same as riwayat_bulk)
            $d->igd = $this->db->get_where('penilaian_medis_igd', ['no_rawat' => $no_rawat])->row();
            if ($d->igd) {
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_igd/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->igd->lokalis_url = base_url($path);
                }
            }

            $d->kandungan = $this->db->get_where('penilaian_medis_ralan_kandungan', ['no_rawat' => $no_rawat])->row();

            $d->mata = $this->db->get_where('penilaian_medis_ralan_mata', ['no_rawat' => $no_rawat])->row();
            if ($d->mata) {
                $filename = str_replace('/', '_', $no_rawat);
                $path_od = 'assets/images/mata/' . $filename . '_od.png';
                if (file_exists(FCPATH . $path_od)) {
                    $d->mata->gambar_od_url = base_url($path_od);
                }
                $path_os = 'assets/images/mata/' . $filename . '_os.png';
                if (file_exists(FCPATH . $path_os)) {
                    $d->mata->gambar_os_url = base_url($path_os);
                }
            }

            $d->penyakit_dalam = $this->db->get_where('penilaian_medis_ralan_penyakit_dalam', ['no_rawat' => $no_rawat])->row();
            if ($d->penyakit_dalam) {
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_pd/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->penyakit_dalam->lokalis_url = base_url($path);
                }
            }

            $d->orthopedi = $this->db->get_where('penilaian_medis_ralan_orthopedi', ['no_rawat' => $no_rawat])->row();
            if ($d->orthopedi) {
                $clean_no_rawat = str_replace('/', '', $no_rawat);
                $path = 'assets/images/lokalis_orthopedi/lokalis_' . $clean_no_rawat . '.png';
                if (file_exists(FCPATH . $path)) {
                    $d->orthopedi->lokalis_url = base_url($path);
                }
            }

            $d->resume = $this->db->get_where('resume_pasien', ['no_rawat' => $no_rawat])->row();
            $d->soap = $this->db->query("SELECT * FROM pemeriksaan_ralan WHERE no_rawat = ? ORDER BY tgl_perawatan ASC, jam_rawat ASC", [$no_rawat])->result();
            $d->diagnosa = $this->db->query("SELECT dp.*, p.nm_penyakit FROM diagnosa_pasien dp JOIN penyakit p ON p.kd_penyakit = dp.kd_penyakit WHERE dp.no_rawat = ?", [$no_rawat])->result();
            $d->prosedur = $this->db->query("SELECT pr.*, icd.deskripsi_panjang AS nama FROM prosedur_pasien pr JOIN icd9 icd ON icd.kode = pr.kode WHERE pr.no_rawat = ?", [$no_rawat])->result();
            $d->tindakan = $this->db->query("SELECT tgl_perawatan, jam_rawat, nm_perawatan, operator, biaya_rawat FROM (SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, d.nm_dokter AS operator, rj.biaya_rawat FROM rawat_jl_dr rj JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw JOIN dokter d ON d.kd_dokter = rj.kd_dokter WHERE rj.no_rawat = ? UNION ALL SELECT rj.tgl_perawatan, rj.jam_rawat, jp.nm_perawatan, pt.nama AS operator, rj.biaya_rawat FROM rawat_jl_pr rj JOIN jns_perawatan jp ON jp.kd_jenis_prw = rj.kd_jenis_prw JOIN petugas pt ON pt.nip = rj.nip WHERE rj.no_rawat = ?) combined ORDER BY tgl_perawatan ASC, jam_rawat ASC", [$no_rawat, $no_rawat])->result();
            $d->resep = $this->db->query("SELECT ro.no_resep, ro.tgl_perawatan, ro.jam, d.nm_dokter, db.nama_brng AS nama_obat, db.ralan AS harga_satuan, (db.ralan * rd.jml) AS total_biaya, rd.jml, rd.aturan_pakai FROM resep_obat ro JOIN resep_dokter rd ON rd.no_resep = ro.no_resep JOIN databarang db ON db.kode_brng = rd.kode_brng LEFT JOIN dokter d ON d.kd_dokter = ro.kd_dokter WHERE ro.no_rawat = ? ORDER BY ro.tgl_perawatan ASC, ro.jam ASC", [$no_rawat])->result();
            $d->lab = $this->db->query("SELECT * FROM periksa_lab WHERE no_rawat = ?", [$no_rawat])->result();
            $d->radiologi = $this->db->query("SELECT * FROM periksa_radiologi WHERE no_rawat = ?", [$no_rawat])->result();

            // OPERASI (dengan JOIN lengkap + TOTAL BIAYA)
            $d->operasi = $this->db->select("
                o.*,
                p.nm_perawatan AS nm_paket_operasi,
                d1.nm_dokter AS nm_operator1,
                d2.nm_dokter AS nm_operator2,
                d3.nm_dokter AS nm_operator3,
                d4.nm_dokter AS nm_dokter_anestesi,
                p1.nama AS nm_asisten_operator1,
                p2.nama AS nm_asisten_operator2,
                p3.nama AS nm_asisten_operator3,
                p4.nama AS nm_asisten_anestesi,
                p5.nama AS nm_asisten_anestesi2,
                lo.diagnosa_preop,
                lo.diagnosa_postop,
                lo.laporan_operasi,
                lo.jaringan_dieksekusi,
                lo.selesaioperasi,
                lo.permintaan_pa,
                (
                    COALESCE(o.biayaoperator1, 0) +
                    COALESCE(o.biayaoperator2, 0) +
                    COALESCE(o.biayaoperator3, 0) +
                    COALESCE(o.biayaasisten_operator1, 0) +
                    COALESCE(o.biayaasisten_operator2, 0) +
                    COALESCE(o.biayaasisten_operator3, 0) +
                    COALESCE(o.biayainstrumen, 0) +
                    COALESCE(o.biayadokter_anak, 0) +
                    COALESCE(o.biayaperawaat_resusitas, 0) +
                    COALESCE(o.biayadokter_anestesi, 0) +
                    COALESCE(o.biayaasisten_anestesi, 0) +
                    COALESCE(o.biayaasisten_anestesi2, 0) +
                    COALESCE(o.biayabidan, 0) +
                    COALESCE(o.biayabidan2, 0) +
                    COALESCE(o.biayabidan3, 0) +
                    COALESCE(o.biayaperawat_luar, 0) +
                    COALESCE(o.biayaalat, 0) +
                    COALESCE(o.biayasewaok, 0) +
                    COALESCE(o.akomodasi, 0) +
                    COALESCE(o.bagian_rs, 0) +
                    COALESCE(o.biaya_omloop, 0) +
                    COALESCE(o.biaya_omloop2, 0) +
                    COALESCE(o.biaya_omloop3, 0) +
                    COALESCE(o.biaya_omloop4, 0) +
                    COALESCE(o.biaya_omloop5, 0) +
                    COALESCE(o.biayasarpras, 0) +
                    COALESCE(o.biaya_dokter_pjanak, 0) +
                    COALESCE(o.biaya_dokter_umum, 0)
                ) AS total_biaya
            ")
                ->from('operasi o')
                ->join('paket_operasi p', 'o.kode_paket = p.kode_paket', 'left')
                ->join('laporan_operasi lo', 'o.no_rawat = lo.no_rawat AND o.tgl_operasi = lo.tanggal', 'left')
                ->join('dokter d1', 'o.operator1 = d1.kd_dokter', 'left')
                ->join('dokter d2', 'o.operator2 = d2.kd_dokter', 'left')
                ->join('dokter d3', 'o.operator3 = d3.kd_dokter', 'left')
                ->join('dokter d4', 'o.dokter_anestesi = d4.kd_dokter', 'left')
                ->join('petugas p1', 'o.asisten_operator1 = p1.nip', 'left')
                ->join('petugas p2', 'o.asisten_operator2 = p2.nip', 'left')
                ->join('petugas p3', 'o.asisten_operator3 = p3.nip', 'left')
                ->join('petugas p4', 'o.asisten_anestesi = p4.nip', 'left')
                ->join('petugas p5', 'o.asisten_anestesi2 = p5.nip', 'left')
                ->where('o.no_rawat', $no_rawat)
                ->order_by('o.tgl_operasi', 'DESC')
                ->get()->result();

            // KFR & REHAB MEDIK
            $d->kfr = $this->db->select('k.*, d.nm_dokter')
                ->from('moizhospital_lembarKFR_rehabmedik k')
                ->join('dokter d', 'k.kd_dokter = d.kd_dokter', 'left')
                ->where('k.no_rawat', $no_rawat)
                ->order_by('k.tgl_perawatan', 'DESC')
                ->order_by('k.jam_rawat', 'DESC')
                ->get()->result();

            $d->rehab_medik = $this->db->select('r.*, d.nm_dokter, p.nama as nm_petugas')
                ->from('moizhospital_program_rehabmedik r')
                ->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left')
                ->join('petugas p', 'r.nip_tim_rehab = p.nip', 'left')
                ->where('r.no_rawat', $no_rawat)
                ->order_by('r.tgl_perawatan', 'DESC')
                ->order_by('r.jam_rawat', 'DESC')
                ->get()->result();

            $d->berkas_digital = $this->db->select('no_rawat, kode, lokasi_file')
                ->from('berkas_digital_perawatan')
                ->where('no_rawat', $no_rawat)
                ->order_by('kode', 'ASC')
                ->get()->result();

            $d->asesmen_keperawatan = $this->db->select('ak.*, p.nama as nm_petugas')
                ->from('penilaian_awal_keperawatan_ralan ak')
                ->join('petugas p', 'ak.nip = p.nip', 'left')
                ->where('ak.no_rawat', $no_rawat)
                ->order_by('ak.tanggal', 'DESC')
                ->get()->result();

            // ASESMEN ANAK (PEDIATRI)
            $d->anak = $this->db->get_where('penilaian_medis_ralan_anak', ['no_rawat' => $no_rawat])->row();

            // ASESMEN BEDAH
            $d->bedah = $this->db->get_where('penilaian_medis_ralan_bedah', ['no_rawat' => $no_rawat])->row();

            // ASESMEN THT
            $d->tht = $this->db->get_where('penilaian_medis_ralan_tht', ['no_rawat' => $no_rawat])->row();

            // ASESMEN JANTUNG (KARDIOLOGI)
            $d->jantung = $this->db->get_where('penilaian_medis_ralan_jantung', ['no_rawat' => $no_rawat])->row();

            // ASESMEN KULIT DAN KELAMIN (DERMATOLOGI)
            $d->kulitdankelamin = $this->db->get_where('penilaian_medis_ralan_kulitdankelamin', ['no_rawat' => $no_rawat])->row();

            // ASESMEN NEUROLOGI
            $d->neurologi = $this->db->get_where('penilaian_medis_ralan_neurologi', ['no_rawat' => $no_rawat])->row();

            // ASESMEN PARU (PULMONOLOGI)
            $d->paru = $this->db->get_where('penilaian_medis_ralan_paru', ['no_rawat' => $no_rawat])->row();

            // ASESMEN PSIKIATRIK
            $d->psikiatrik = $this->db->get_where('penilaian_medis_ralan_psikiatrik', ['no_rawat' => $no_rawat])->row();

            // ASESMEN GAWAT DARURAT PSIKIATRI
            $d->igdPsikiatri = $this->db->get_where('penilaian_medis_ralan_gawat_darurat_psikiatri', ['no_rawat' => $no_rawat])->row();

            // ASESMEN GERIATRI
            $d->geriatri = $this->db->get_where('penilaian_medis_ralan_geriatri', ['no_rawat' => $no_rawat])->row();

            // ASESMEN REHAB MEDIK
            $d->asesmenRehabMedik = $this->db->get_where('penilaian_medis_ralan_rehab_medik', ['no_rawat' => $no_rawat])->row();

            // ASESMEN UROLOGI
            $d->asesmenUrologi = $this->db->get_where('penilaian_medis_ralan_urologi', ['no_rawat' => $no_rawat])->row();

            $sections = [];
            $section_map = [
                'igd' => 'asesmen_igd.php',
                'kandungan' => 'asesmen_kandungan.php',
                'mata' => 'asesmen_mata.php',
                'penyakit_dalam' => 'asesmen_penyakit_dalam.php',
                'orthopedi' => 'asesmen_orthopedi.php',
                'anak' => 'asesmen_anak.php',
                'bedah' => 'asesmen_bedah.php',
                'tht' => 'asesmen_tht.php',
                'jantung' => 'asesmen_jantung.php',
                'kulitdankelamin' => 'asesmen_kulitdankelamin.php',
                'neurologi' => 'asesmen_neurologi.php',
                'paru' => 'asesmen_paru.php',
                'psikiatrik' => 'asesmen_psikiatrik.php',
                'igdPsikiatri' => 'asesmen_gawatdaruratpsikiatri.php',
                'geriatri' => 'asesmen_geriatri.php',
                'asesmenRehabMedik' => 'asesmen_rehabmedik.php',
                'asesmenUrologi' => 'asesmen_urologi.php',
                'kfr' => 'formulir_kfr.php',
                'rehab_medik' => 'program_rehab_medik.php',
                'asesmen_keperawatan' => 'asesmen_keperawatan.php',
                'resume' => 'resume_medis.php',
                'soap' => 'soap.php',
                'diagnosa' => 'diagnosa.php',
                'prosedur' => 'prosedur.php',
                'tindakan' => 'tindakan.php',
                'resep' => 'resep.php',
                'lab' => 'lab.php',
                'radiologi' => 'radiologi.php',
                'operasi' => 'operasi.php',
                'berkas_digital' => 'berkas_digital.php'
            ];

            foreach ($section_map as $key => $view_file) {
                $data_item = $d->$key;
                if (empty($data_item))
                    continue;
                if (is_array($data_item) && count($data_item) === 0)
                    continue;
                $sections[] = ['file' => $view_file, 'data' => ['d' => $d]];
            }

            if (!empty($sections)) {
                $sections_all[] = ['visit' => $visit, 'sections' => $sections];
            }
        }

        // ================== GENERATE PDF ==================
        $data = [
            'hospital' => $hospital,
            'patient' => $patient,
            'visits_data' => $sections_all,
            'document_title' => 'RIWAYAT MEDIS LENGKAP',
            'is_bulk' => true
        ];

        // Generate HTML from view
        $html = $this->load->view('print/print_bulk_layout', $data, true);

        // DEBUG: Uncomment to see HTML
        // echo $html; exit;

        // Generate PDF using mPDF with error handling
        try {
            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_left' => 15,
                'margin_right' => 15,
                'mode' => 'utf-8',
                'autoScriptToLang' => true,
                'autoLangToFont' => true
            ]);

            $mpdf->WriteHTML($html);

            $filename = 'Riwayat_Medis_' . $no_rkm_medis . '_' . date('Ymd_His') . '.pdf';
            $mpdf->Output($filename, 'I');
        } catch (\Mpdf\MpdfException $e) {
            echo '<h1>mPDF Error</h1>';
            echo '<pre>' . $e->getMessage() . '</pre>';
            echo '<h2>HTML Output:</h2>';
            echo '<pre>' . htmlspecialchars($html) . '</pre>';
            exit;
        }
    }

    // =====================================================
    // ================== HELPER INTERNAL ==================
    // =====================================================

    /**
     * Hitung umur pasien
     */
    private function _hitung_umur($tgl_lahir)
    {
        if (empty($tgl_lahir)) {
            return '-';
        }

        $lahir = new DateTime($tgl_lahir);
        $sekarang = new DateTime();
        $diff = $sekarang->diff($lahir);

        $umur = [];
        if ($diff->y > 0)
            $umur[] = $diff->y . ' tahun';
        if ($diff->m > 0)
            $umur[] = $diff->m . ' bulan';
        if ($diff->d > 0 && $diff->y == 0)
            $umur[] = $diff->d . ' hari';

        return implode(' ', $umur);
    }

    /**
     * Format tanggal Indonesia
     */
    private function _format_tanggal($date, $with_time = false)
    {
        if (empty($date)) {
            return '-';
        }

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $ts = strtotime($date);
        $result = date('j', $ts) . ' ' .
            $bulan[date('n', $ts)] . ' ' .
            date('Y', $ts);

        if ($with_time) {
            $result .= ' ' . date('H:i', $ts) . ' WIB';
        }

        return $result;
    }
}
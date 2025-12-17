<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanLabBaruModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua kategori pemeriksaan (Paket Lab)
    public function get_kategori_lab()
    {
        return $this->db->select('kd_jenis_prw, nm_perawatan, total_byr')
            ->from('jns_perawatan_lab')
            ->order_by('nm_perawatan', 'ASC')
            ->get()->result_array();
    }

    // Ambil detail template berdasarkan kode jenis perawatan
    public function get_template_lab_by_jenis($kd_jenis_prw)
    {
        return $this->db->select('*')
            ->from('template_laboratorium')
            ->where('kd_jenis_prw', $kd_jenis_prw)
            ->order_by('urut', 'ASC')
            ->get()->result_array();
    }

    // Ambil Semua Master Data Sekaligus (Optimasi Load Awal)
    public function get_all_master_lab()
    {
        // Ambil Parent
        $parents = $this->get_kategori_lab();

        // Ambil Semua Template
        $templates = $this->db->select('*')
            ->from('template_laboratorium')
            ->order_by('kd_jenis_prw', 'ASC')
            ->order_by('urut', 'ASC')
            ->get()->result_array();

        // Grouping template berdasarkan parent
        $template_map = [];
        foreach ($templates as $t) {
            $template_map[$t['kd_jenis_prw']][] = $t;
        }

        // Gabungkan
        $result = [];
        foreach ($parents as $p) {
            $kd = $p['kd_jenis_prw'];
            // Hanya masukkan jika punya template (opsional, tergantung aturan RS)
            // Tapi biasanya ada jenis perawatan yg ga ada template detilnya (cuma header), tetap kita masukkan.
            $p['items'] = isset($template_map[$kd]) ? $template_map[$kd] : [];
            $result[] = $p;
        }

        return $result;
    }

    public function generate_no_order()
    {
        $prefix = 'PK' . date('Ymd'); // Format: PKYYYYMMDD

        // Query manual untuk performa lebih baik pada tabel besar
        $sql = "SELECT max(noorder) as last_order FROM permintaan_lab WHERE noorder LIKE '$prefix%'";
        $row = $this->db->query($sql)->row_array();

        $lastNo = $row['last_order'];
        $urutan = 1;

        if ($lastNo) {
            $lastSequence = (int) substr($lastNo, -4);
            $urutan = $lastSequence + 1;
        }

        return $prefix . sprintf('%04d', $urutan);
    }

    public function simpan_permintaan($data)
    {
        $this->db->trans_start();

        // 1. Insert Header Permintaan
        $this->db->insert('permintaan_lab', [
            'noorder' => $data['noorder'],
            'no_rawat' => $data['no_rawat'],
            'jam_permintaan' => date('H:i:s'),
            'tgl_permintaan' => date('Y-m-d'),
            // Default nilai kosong untuk field2 yg belum ada isinya saat request
            'tgl_sampel' => '0000-00-00',
            'jam_sampel' => '00:00:00',
            'tgl_hasil' => '0000-00-00',
            'jam_hasil' => '00:00:00',
            'dokter_perujuk' => $data['kd_dokter'],
            'status' => 'ralan', // Karena di menu Ralan
            'informasi_tambahan' => $data['informasi_tambahan'],
            'diagnosa_klinis' => $data['diagnosa_klinis']
        ]);

        // 2. Loop Items
        // $data['items'] structure: 
        // [
        //    { kd_jenis_prw: '...', templates: [id_template, id_template...] }
        // ]

        foreach ($data['items'] as $item) {
            $kd_jenis_prw = $item['kd_jenis_prw'];

            // A. Insert ke permintaan_pemeriksaan_lab (Parent/Header Item)
            // Cek duplikasi dulu biar aman (meski controller harusnya udah filter)
            $this->db->insert('permintaan_pemeriksaan_lab', [
                'noorder' => $data['noorder'],
                'kd_jenis_prw' => $kd_jenis_prw,
                'stts_bayar' => 'Belum'
            ]);

            // B. Insert ke permintaan_detail_permintaan_lab (Children/Details)
            if (!empty($item['templates']) && is_array($item['templates'])) {
                foreach ($item['templates'] as $id_template) {
                    $this->db->insert('permintaan_detail_permintaan_lab', [
                        'noorder' => $data['noorder'],
                        'kd_jenis_prw' => $kd_jenis_prw,
                        'id_template' => $id_template,
                        'stts_bayar' => 'Belum'
                    ]);
                }
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function check_duplicate_order_today($no_rawat)
    {
        $tgl_sekarang = date('Y-m-d');
        return $this->db->where('no_rawat', $no_rawat)
            ->where('tgl_permintaan', $tgl_sekarang)
            ->get('permintaan_lab')
            ->num_rows() > 0;
    }

    public function get_riwayat_permintaan($no_rawat)
    {
        // Ambil Header
        $headers = $this->db->select('pl.*, d.nm_dokter')
            ->from('permintaan_lab pl')
            ->join('dokter d', 'pl.dokter_perujuk = d.kd_dokter', 'left')
            ->where('pl.no_rawat', $no_rawat)
            ->order_by('pl.tgl_permintaan', 'DESC')
            ->order_by('pl.jam_permintaan', 'DESC')
            ->get()->result_array();

        if (empty($headers))
            return [];

        // Loop untuk ambil detail (bisa dioptimasi dengan query IN, tapi loop header biasanya sedikit per pasien)
        foreach ($headers as &$header) {
            $noorder = $header['noorder'];

            // Ambil detail pemeriksaan + template
            // Join 3 tabel: detail -> template -> jenis_prw (optional nama parent)
            $details = $this->db->select('
                    pd.kd_jenis_prw, 
                    jpl.nm_perawatan, 
                    pd.id_template, 
                    tl.Pemeriksaan as nama_pemeriksaan, 
                    tl.satuan, 
                    tl.nilai_rujukan_ld, tl.nilai_rujukan_la, tl.nilai_rujukan_pd, tl.nilai_rujukan_pa
                ')
                ->from('permintaan_detail_permintaan_lab pd')
                ->join('jns_perawatan_lab jpl', 'pd.kd_jenis_prw = jpl.kd_jenis_prw')
                ->join('template_laboratorium tl', 'pd.id_template = tl.id_template')
                ->where('pd.noorder', $noorder)
                ->order_by('pd.kd_jenis_prw', 'ASC')
                ->order_by('tl.urut', 'ASC')
                ->get()->result_array();

            // Grouping by Jenis Perawatan
            $grouped = [];
            foreach ($details as $d) {
                if (!isset($grouped[$d['kd_jenis_prw']])) {
                    $grouped[$d['kd_jenis_prw']] = [
                        'nm_perawatan' => $d['nm_perawatan'],
                        'items' => []
                    ];
                }
                $grouped[$d['kd_jenis_prw']]['items'][] = $d;
            }

            $header['list_pemeriksaan'] = $grouped;
        }

        return $headers;
    }

    public function hapus_permintaan($noorder)
    {
        $this->db->trans_start();
        $this->db->where('noorder', $noorder)->delete('permintaan_detail_permintaan_lab');
        $this->db->where('noorder', $noorder)->delete('permintaan_pemeriksaan_lab');
        $this->db->where('noorder', $noorder)->delete('permintaan_lab');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

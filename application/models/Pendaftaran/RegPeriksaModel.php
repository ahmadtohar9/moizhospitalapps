<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegPeriksaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_next_no_rawat()
    {
        $today = date('Y/m/d');
        $prefix = $today . '/';

        $this->db->select('MAX(no_rawat) as max_no');
        $this->db->like('no_rawat', $prefix, 'after');
        $query = $this->db->get('reg_periksa');
        $row = $query->row();

        if ($row->max_no) {
            $last_no = substr($row->max_no, -6);
            $next_no = intval($last_no) + 1;
        } else {
            $next_no = 1;
        }

        return $prefix . sprintf('%06d', $next_no);
    }

    public function get_next_no_reg($kd_poli, $kd_dokter, $tgl_registrasi)
    {
        $this->db->select('MAX(no_reg) as max_reg');
        $this->db->where('kd_poli', $kd_poli);
        $this->db->where('kd_dokter', $kd_dokter);
        $this->db->where('tgl_registrasi', $tgl_registrasi);
        $query = $this->db->get('reg_periksa');
        $row = $query->row();

        if ($row->max_reg) {
            $next_reg = intval($row->max_reg) + 1;
        } else {
            $next_reg = 1;
        }

        return sprintf('%03d', $next_reg);
    }

    public function search_dokter($q)
    {
        $this->db->select('kd_dokter, nm_dokter');
        $this->db->like('nm_dokter', $q);
        $this->db->or_like('kd_dokter', $q);
        $this->db->limit(20);
        return $this->db->get('dokter')->result();
    }

    public function search_poli($q)
    {
        $this->db->select('kd_poli, nm_poli');
        $this->db->like('nm_poli', $q);
        $this->db->or_like('kd_poli', $q);
        $this->db->limit(20);
        return $this->db->get('poliklinik')->result();
    }

    public function search_penjab($q)
    {
        $this->db->select('kd_pj, png_jawab');
        $this->db->like('png_jawab', $q);
        $this->db->or_like('kd_pj', $q);
        $this->db->limit(20);
        return $this->db->get('penjab')->result();
    }

    public function search_pasien($q)
    {
        $this->db->select('no_rkm_medis, nm_pasien, namakeluarga, alamat, no_peserta, kd_pj, no_tlp');
        $this->db->group_start();
        $this->db->like('nm_pasien', $q);
        $this->db->or_like('no_rkm_medis', $q);
        $this->db->or_like('no_ktp', $q);
        $this->db->or_like('no_peserta', $q);
        $this->db->group_end();
        $this->db->limit(20);
        return $this->db->get('pasien')->result();
    }

    public function save($data)
    {
        return $this->db->insert('reg_periksa', $data);
    }

    public function delete($no_rawat)
    {
        return $this->db->delete('reg_periksa', ['no_rawat' => $no_rawat]);
    }

    public function update_dokter($no_rawat, $kd_dokter)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update('reg_periksa', ['kd_dokter' => $kd_dokter]);
    }

    public function update_poli($no_rawat, $kd_poli)
    {
        // Must regenerate no_reg if day is same? Usually complex, but for now just update code.
        // Khanza logic usually allows changing poli but keeping old valid logic is key.
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update('reg_periksa', ['kd_poli' => $kd_poli]);
    }

    public function update_bayar($no_rawat, $kd_pj)
    {
        $this->db->where('no_rawat', $no_rawat);
        return $this->db->update('reg_periksa', ['kd_pj' => $kd_pj]);
    }

    // DATATABLES
    var $table = 'reg_periksa';
    var $column_order = array(null, 'reg_periksa.no_reg', 'reg_periksa.no_rawat', 'reg_periksa.tgl_registrasi', 'reg_periksa.jam_reg', 'pasien.nm_pasien', 'reg_periksa.no_rkm_medis', 'dokter.nm_dokter', 'poliklinik.nm_poli', 'penjab.png_jawab', 'reg_periksa.stts');
    var $column_search = array('reg_periksa.no_rawat', 'pasien.nm_pasien', 'reg_periksa.no_rkm_medis', 'dokter.nm_dokter', 'poliklinik.nm_poli');
    var $order = array('reg_periksa.jam_reg' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('reg_periksa.*, pasien.nm_pasien, pasien.alamat, pasien.no_ktp, pasien.tgl_lahir, dokter.nm_dokter, poliklinik.nm_poli, penjab.png_jawab, bridging_sep.no_sep, referensi_mobilejkn_bpjs.no_rawat as mjkn_check');
        $this->db->from($this->table);
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->join('bridging_sep', 'reg_periksa.no_rawat = bridging_sep.no_rawat', 'left');
        $this->db->join('referensi_mobilejkn_bpjs', 'reg_periksa.no_rawat = referensi_mobilejkn_bpjs.no_rawat', 'left');

        // Filter by Date Range
        $mulai = $this->input->post('filter_tgl_mulai');
        $akhir = $this->input->post('filter_tgl_akhir');

        if ($mulai && $akhir) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $mulai);
            $this->db->where('reg_periksa.tgl_registrasi <=', $akhir);
        } else {
            // Default to today
            $this->db->where('reg_periksa.tgl_registrasi', date('Y-m-d'));
        }

        // Filter by Status Bayar
        if ($this->input->post('filter_status_bayar') && $this->input->post('filter_status_bayar') != 'Semua') {
            $this->db->where('reg_periksa.status_bayar', $this->input->post('filter_status_bayar'));
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $mulai = $this->input->post('filter_tgl_mulai');
        $akhir = $this->input->post('filter_tgl_akhir');

        if ($mulai && $akhir) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $mulai);
            $this->db->where('reg_periksa.tgl_registrasi <=', $akhir);
        } else {
            $this->db->where('reg_periksa.tgl_registrasi', date('Y-m-d'));
        }

        if ($this->input->post('filter_status_bayar') && $this->input->post('filter_status_bayar') != 'Semua') {
            $this->db->where('reg_periksa.status_bayar', $this->input->post('filter_status_bayar'));
        }

        return $this->db->count_all_results();
    }

    public function get_stats($mulai, $akhir)
    {
        // Total
        $this->db->where('tgl_registrasi >=', $mulai);
        $this->db->where('tgl_registrasi <=', $akhir);
        $total = $this->db->count_all_results('reg_periksa');

        // Sudah Bayar
        $this->db->where('tgl_registrasi >=', $mulai);
        $this->db->where('tgl_registrasi <=', $akhir);
        $this->db->where('status_bayar', 'Sudah Bayar');
        $paid = $this->db->count_all_results('reg_periksa');

        // Belum Bayar
        $this->db->where('tgl_registrasi >=', $mulai);
        $this->db->where('tgl_registrasi <=', $akhir);
        $this->db->where('status_bayar', 'Belum Bayar');
        $unpaid = $this->db->count_all_results('reg_periksa');

        return ['total' => $total, 'paid' => $paid, 'unpaid' => $unpaid];
    }

    public function get_by_no_rawat($no_rawat)
    {
        $this->db->select('reg_periksa.*, pasien.nm_pasien, pasien.no_rkm_medis, dokter.nm_dokter, poliklinik.nm_poli, penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj');
        $this->db->where('reg_periksa.no_rawat', $no_rawat);
        return $this->db->get()->row();
    }
}

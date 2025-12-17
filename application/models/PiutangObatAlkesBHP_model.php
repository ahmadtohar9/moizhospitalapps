<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PiutangObatAlkesBHP_model extends CI_Model {

    public function get_all_suppliers() {
        return $this->db->get('datasuplier')->result_array();
    }

    public function get_filtered_piutang($start_date, $end_date, $supplier, $status) {
        $this->db->select("
            p.no_faktur, p.tgl_faktur, p.tgl_tempo, p.status, 
            p.total2, p.ppn, p.meterai, p.tagihan, s.nama_suplier,
            DATEDIFF(p.tgl_tempo, CURDATE()) AS sisa_hari
        ");
        $this->db->from('pemesanan p');
        $this->db->join('datasuplier s', 'p.kode_suplier = s.kode_suplier');

        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where("p.tgl_faktur >=", $start_date);
            $this->db->where("p.tgl_faktur <=", $end_date);
        }

        if (!empty($supplier)) {
            $this->db->where("p.kode_suplier", $supplier);
        }

        if (!empty($status)) {
            $this->db->where("p.status", $status);
        } else {
            $this->db->where_in("p.status", ['Belum Dibayar', 'Titip Faktur']);
        }

        $this->db->order_by("p.tgl_tempo", "ASC");
        return $this->db->get()->result_array();
    }
}

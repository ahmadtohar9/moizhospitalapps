<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sumber data ruangan untuk dropdown (dinamis).
 */
class RuanganTindakanModel extends CI_Model
{
    private $table = 'moiz_ruangan_tindakan';

    public function __construct()
    {
        parent::__construct();
    }

    /** Ambil ruangan aktif untuk pilihan form */
    public function list_aktif()
    {
        return $this->db->select('id, nama_ruangan')
                        ->from($this->table)
                        ->where('status', 1)
                        ->order_by('nama_ruangan', 'ASC')
                        ->get()->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id'=>(int)$id])->row_array();
    }
}

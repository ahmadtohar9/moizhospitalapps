<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeperawatanMasterModel extends CI_Model
{
    private $tbl_masalah = 'master_masalah_keperawatan';
    private $tbl_rencana = 'master_rencana_keperawatan';

    /** Ambil seluruh masalah (untuk checklist kiri) */
    public function getMasalahAll(): array
    {
      return $this->db->order_by('nama_masalah','ASC')
                      ->get($this->tbl_masalah)
                      ->result_array();
    }

    /** Ambil rencana untuk 1 masalah */
    public function getRencanaByMasalah(string $kode_masalah): array
    {
      return $this->db->where('kode_masalah', $kode_masalah)
                      ->order_by('kode_rencana','ASC')
                      ->get($this->tbl_rencana)
                      ->result_array();
    }

    /** Ambil tree masalah → daftar rencana (sekali jalan) */
    public function getTreeMasalahRencana(): array
    {
      $rows = $this->db->select('m.kode_masalah, m.nama_masalah, r.kode_rencana, r.rencana_keperawatan')
                       ->from($this->tbl_masalah.' m')
                       ->join($this->tbl_rencana.' r', 'r.kode_masalah = m.kode_masalah', 'left')
                       ->order_by('m.nama_masalah','ASC')
                       ->order_by('r.kode_rencana','ASC')
                       ->get()->result_array();

      $tree = [];
      foreach ($rows as $it) {
        $km = $it['kode_masalah'];
        if (!isset($tree[$km])) {
          $tree[$km] = [
            'kode_masalah' => $km,
            'nama_masalah' => $it['nama_masalah'],
            'rencana'      => []
          ];
        }
        if (!empty($it['kode_rencana'])) {
          $tree[$km]['rencana'][] = [
            'kode_rencana'        => $it['kode_rencana'],
            'rencana_keperawatan' => $it['rencana_keperawatan']
          ];
        }
      }
      // fallback kalau ada masalah tanpa join (tidak punya rencana sama sekali)
      if (empty($rows)) {
        foreach ($this->getMasalahAll() as $m) {
          $tree[$m['kode_masalah']] = ['kode_masalah'=>$m['kode_masalah'], 'nama_masalah'=>$m['nama_masalah'], 'rencana'=>[]];
        }
      }
      return array_values($tree);
    }
}

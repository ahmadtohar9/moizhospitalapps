<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienModel extends CI_Model
{
    var $table = 'pasien';
    var $column_order = array(null, 'no_rkm_medis', 'nm_pasien', 'no_ktp', 'jk', 'alamat', 'no_tlp', 'tgl_daftar');
    var $column_search = array('no_rkm_medis', 'nm_pasien', 'no_ktp', 'alamat', 'no_tlp');
    var $order = array('no_rkm_medis' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
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

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('no_rkm_medis', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function generate_no_rkm_medis($update = false)
    {
        // If update=true, use transaction to lock and increment (used during SAVE)
        // If update=false, just peek current value + 1 (used for DISPLAY)

        if ($update) {
            $this->db->trans_start();
            $q = $this->db->query("SELECT no_rkm_medis FROM set_no_rkm_medis FOR UPDATE");
        } else {
            $q = $this->db->query("SELECT no_rkm_medis FROM set_no_rkm_medis");
        }

        $kd = "000001";
        if ($q->num_rows() > 0) {
            $row = $q->row();
            $last_no = (int) $row->no_rkm_medis;
            $next_no = $last_no + 1;
            $kd = sprintf("%06s", $next_no);

            if ($update) {
                $this->db->query("UPDATE set_no_rkm_medis SET no_rkm_medis = ?", array($kd));
            }
        } else {
            if ($update) {
                $this->db->query("INSERT INTO set_no_rkm_medis (no_rkm_medis) VALUES (?)", array($kd));
            }
        }

        if ($update) {
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
                return date('ymdHis');
        }

        return $kd;
    }

    public function save($data)
    {
        // Set Defaults for FKs if empty to prevent 1452 Error
        $defaults = [
            'kd_kel' => 4,      // Default Kelurahan
            'kd_kec' => 0,      // Default Kecamatan (Guessing, DB showed 0 but usually PK starts at 1, let's safe check or use valid one) -> DB showed 0 as valid. use 0.
            'kd_kab' => 4,      // Default Kabupaten
            'kd_prop' => 1,     // Default Propinsi
            'suku_bangsa' => 1,
            'bahasa_pasien' => 1,
            'cacat_fisik' => 1,
            'perusahaan_pasien' => '-',
            'pnd' => '-',
            'keluarga' => 'LAIN-LAIN',
            'namakeluarga' => '-',
            'pekerjaanpj' => '-',
            'alamatpj' => '-',
            'kelurahanpj' => '-',
            'kecamatanpj' => '-',
            'kabupatenpj' => '-',
            'propinsipj' => '-',
            'nip' => '-',
            'email' => '-',
        ];

        // Explicitly set default for 'kd_kec' to 0 if that is the valid ID in DB for empty
        if (empty($data['kd_kec']))
            $data['kd_kec'] = 0;

        foreach ($defaults as $key => $val) {
            if (empty($data[$key])) {
                $data[$key] = $val;
            }
        }

        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update($where, $data)
    {
        // Ensure constraints are met for update too
        $defaults = [
            'kd_kel' => 4,
            'kd_kec' => 0,
            'kd_kab' => 4,
            'kd_prop' => 1,
            'suku_bangsa' => 1,
            'bahasa_pasien' => 1,
            'cacat_fisik' => 1,
            'perusahaan_pasien' => '-'
        ];

        foreach ($defaults as $key => $val) {
            if (empty($data[$key]) && isset($data[$key])) { // Only if key exists but empty/null
                $data[$key] = $val;
            }
        }

        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('no_rkm_medis', $id);
        $this->db->delete($this->table);
    }

    // Autocomplete Helpers
    public function search_wilayah($table, $q, $key_col, $val_col)
    {
        // Need to be specific because table names differ
        $this->db->like($val_col, $q);
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }

    // Specific Getters
    public function get_suku_bangsa()
    {
        return $this->db->order_by('nama_suku_bangsa')->get('suku_bangsa')->result();
    }
    public function get_bahasa()
    {
        return $this->db->order_by('nama_bahasa')->get('bahasa_pasien')->result();
    }
    public function get_cacat()
    {
        return $this->db->order_by('nama_cacat')->get('cacat_fisik')->result();
    }
    public function get_perusahaan()
    {
        return $this->db->order_by('nama_perusahaan')->get('perusahaan_pasien')->result();
    }
    public function get_pendidkan()
    {
        return ['TS', 'TK', 'SD', 'SMP', 'SMA', 'SLTA/SEDERAJAT', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', '-'];
    }
    public function get_keluarga()
    {
        return ['AYAH', 'IBU', 'ISTRI', 'SUAMI', 'SAUDARA', 'ANAK', 'DIRI SENDIRI', 'LAIN-LAIN'];
    }

    // Dropdown helpers (Mocking typical tables or standardized arrays)
    public function get_agama()
    {
        return ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU', 'LAINNYA'];
    }

    public function get_stts_nikah()
    {
        return ['MENIKAH', 'BELUM MENIKAH', 'JANDA', 'DUDA'];
    }

    public function get_gol_darah()
    {
        return ['-', 'A', 'B', 'AB', 'O'];
    }

    public function get_pekerjaan()
    {
        return ['PNS', 'TNI/POLRI', 'SWASTA', 'WIRASWASTA', 'PETANI', 'NELAYAN', 'IBU RUMAH TANGGA', 'PELAJAR/MAHASISWA', 'LAINNYA'];
    }

    public function get_penjab()
    {
        // Asumsi ada tabel penjab
        return $this->db->get('penjab')->result();
    }
}

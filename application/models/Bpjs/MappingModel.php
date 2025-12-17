<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mapping Model - BPJS VClaim
 * 
 * Model untuk operasi mapping data RS ke BPJS
 * Menggunakan tabel Khanza: maping_poli_bpjs
 * 
 * @author Ahmad Tohar
 * @version 1.0
 */
class MappingModel extends CI_Model
{
    /**
     * Get poli RS yang belum di-mapping
     * 
     * @return array
     */
    public function get_unmapped_poli()
    {
        $this->db->select('p.kd_poli, p.nm_poli');
        $this->db->from('poliklinik p');
        $this->db->where('NOT EXISTS (
            SELECT 1 FROM maping_poli_bpjs m 
            WHERE m.kd_poli_rs = p.kd_poli
        )', NULL, FALSE);
        $this->db->order_by('p.nm_poli', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Get poli yang sudah di-mapping
     * 
     * @return array
     */
    public function get_mapped_poli()
    {
        $this->db->select('
            m.kd_poli_rs,
            m.kd_poli_bpjs,
            m.nm_poli_bpjs,
            p.nm_poli AS nm_poli_rs
        ');
        $this->db->from('maping_poli_bpjs m');
        $this->db->join('poliklinik p', 'm.kd_poli_rs = p.kd_poli', 'left');
        $this->db->order_by('p.nm_poli', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Save mapping poli
     * 
     * @param array $data
     * @return bool
     */
    public function save_mapping_poli($data)
    {
        // Check if mapping already exists
        $exists = $this->db->get_where('maping_poli_bpjs', [
            'kd_poli_rs' => $data['kd_poli_rs']
        ])->row_array();

        // Prepare data for Khanza table structure
        $mapping_data = [
            'kd_poli_rs' => $data['kd_poli_rs'],
            'kd_poli_bpjs' => $data['kd_poli_bpjs'],
            'nm_poli_bpjs' => $data['nm_poli_bpjs']
        ];

        if ($exists) {
            // Update existing mapping
            $this->db->where('kd_poli_rs', $data['kd_poli_rs']);
            return $this->db->update('maping_poli_bpjs', $mapping_data);
        } else {
            // Insert new mapping
            return $this->db->insert('maping_poli_bpjs', $mapping_data);
        }
    }

    /**
     * Get mapping poli by kode RS
     * 
     * @param string $kd_poli_rs
     * @return array|null
     */
    public function get_mapping_by_kode_rs($kd_poli_rs)
    {
        return $this->db->get_where('maping_poli_bpjs', [
            'kd_poli_rs' => $kd_poli_rs
        ])->row_array();
    }

    /**
     * Get kode poli BPJS by kode RS
     * 
     * @param string $kd_poli_rs
     * @return string|null
     */
    public function get_kode_bpjs($kd_poli_rs)
    {
        $mapping = $this->get_mapping_by_kode_rs($kd_poli_rs);
        return $mapping ? $mapping['kd_poli_bpjs'] : null;
    }

    /**
     * Delete mapping poli
     * 
     * @param string $kd_poli_rs
     * @return bool
     */
    public function delete_mapping($kd_poli_rs)
    {
        return $this->db->where('kd_poli_rs', $kd_poli_rs)->delete('maping_poli_bpjs');
    }

    /**
     * Get statistics mapping
     * 
     * @return array
     */
    public function get_statistics()
    {
        $stats = [];

        // Total poli RS
        $stats['total_poli_rs'] = $this->db->count_all('poliklinik');

        // Total poli BPJS (dari referensi)
        $stats['total_poli_bpjs'] = $this->db->query("
            SELECT COUNT(DISTINCT kd_poli_bpjs) as total 
            FROM maping_poli_bpjs
        ")->row()->total;

        // Total mapped
        $stats['total_mapped'] = $this->db->count_all('maping_poli_bpjs');

        // Total unmapped
        $stats['total_unmapped'] = $stats['total_poli_rs'] - $stats['total_mapped'];

        // Progress percentage
        $stats['progress'] = $stats['total_poli_rs'] > 0
            ? round(($stats['total_mapped'] / $stats['total_poli_rs']) * 100, 2)
            : 0;

        return $stats;
    }

    /**
     * Bulk import mapping from array
     * 
     * @param array $mappings Array of mapping data
     * @return array Result summary
     */
    public function bulk_import($mappings)
    {
        $result = [
            'success' => 0,
            'failed' => 0,
            'errors' => []
        ];

        foreach ($mappings as $index => $mapping) {
            try {
                // Validate
                if (empty($mapping['kd_poli_rs']) || empty($mapping['kd_poli_bpjs'])) {
                    throw new Exception('Kode poli RS dan BPJS harus diisi');
                }

                // Get nama poli
                $poli_rs = $this->db->get_where('poliklinik', [
                    'kd_poli' => $mapping['kd_poli_rs']
                ])->row_array();

                if (!$poli_rs) {
                    throw new Exception('Poli RS tidak ditemukan: ' . $mapping['kd_poli_rs']);
                }

                // Prepare data
                $data = [
                    'kd_poli_rs' => $mapping['kd_poli_rs'],
                    'kd_poli_bpjs' => $mapping['kd_poli_bpjs'],
                    'nm_poli_bpjs' => $mapping['nm_poli_bpjs'] ?? strtoupper($poli_rs['nm_poli'])
                ];

                // Save
                if ($this->save_mapping_poli($data)) {
                    $result['success']++;
                } else {
                    throw new Exception('Gagal menyimpan mapping');
                }

            } catch (Exception $e) {
                $result['failed']++;
                $result['errors'][] = "Row " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        return $result;
    }

    // ==================== MAPPING DIAGNOSA ====================

    public function get_unmapped_diagnosa($limit = 100)
    {
        // Get diagnosa RS that are NOT in maping_diagnosa_bpjs
        $this->db->select('kd_penyakit, nm_penyakit');
        $this->db->from('penyakit');
        $this->db->where('NOT EXISTS (
            SELECT 1 FROM maping_diagnosa_bpjs m 
            WHERE m.kd_diags_rs = penyakit.kd_penyakit
        )', NULL, FALSE);
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_mapped_diagnosa($limit = 100)
    {
        $this->db->select('m.*, p.nm_penyakit as nm_diags_rs');
        $this->db->from('maping_diagnosa_bpjs m');
        $this->db->join('penyakit p', 'm.kd_diags_rs = p.kd_penyakit');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function save_mapping_diagnosa($data)
    {
        $exists = $this->db->get_where('maping_diagnosa_bpjs', [
            'kd_diags_rs' => $data['kd_diags_rs']
        ])->row();

        if ($exists) {
            $this->db->where('kd_diags_rs', $data['kd_diags_rs']);
            return $this->db->update('maping_diagnosa_bpjs', $data);
        } else {
            return $this->db->insert('maping_diagnosa_bpjs', $data);
        }
    }

    public function delete_mapping_diagnosa($kd_diags_rs)
    {
        return $this->db->where('kd_diags_rs', $kd_diags_rs)->delete('maping_diagnosa_bpjs');
    }

    // ==================== MAPPING FASKES ====================

    public function get_unmapped_faskes($limit = 100)
    {
        // Get DISTINCT perujuk from rujuk_masuk that are NOT in moizhospital_maping_faskes
        // Filter empty or strip '-'
        $this->db->select('DISTINCT(perujuk) as nama_faskes_rs, alamat');
        $this->db->from('rujuk_masuk');
        $this->db->where("perujuk != ''");
        $this->db->where("perujuk != '-'");
        $this->db->where('NOT EXISTS (
            SELECT 1 FROM moizhospital_maping_faskes m 
            WHERE m.nama_faskes_rs = rujuk_masuk.perujuk
        )', NULL, FALSE);
        $this->db->group_by('perujuk');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_mapped_faskes($limit = 100)
    {
        return $this->db->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('moizhospital_maping_faskes')
            ->result_array();
    }

    public function save_mapping_faskes($data)
    {
        // Check duplicate by nama_faskes_rs
        $exists = $this->db->get_where('moizhospital_maping_faskes', [
            'nama_faskes_rs' => $data['nama_faskes_rs']
        ])->row();

        if ($exists) {
            $this->db->where('id', $exists->id);
            return $this->db->update('moizhospital_maping_faskes', $data);
        } else {
            return $this->db->insert('moizhospital_maping_faskes', $data);
        }
    }

    public function delete_mapping_faskes($id)
    {
        return $this->db->where('id', $id)->delete('moizhospital_maping_faskes');
    }
}

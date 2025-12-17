<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanResepRacikanRalan_model extends CI_Model
{
    private $table = 'permintaan_resep_ralan';

    // ✅ Ambil daftar obat dari gudang (Query Builder)
    public function getObatList()
    {
        return $this->db->select('gudangbarang.kode_brng, databarang.nama_brng,databarang.ralan,databarang.kapasitas,kodesatuan.satuan, gudangbarang.stok')
                        ->from('databarang')
                        ->join('gudangbarang', 'databarang.kode_brng = gudangbarang.kode_brng')
                        ->join('kodesatuan', 'databarang.kode_sat = kodesatuan.kode_sat')
                        ->where('gudangbarang.kd_bangsal', 'AP')
                        ->where('gudangbarang.stok >', 0)
                        ->get()
                        ->result_array();
    }

    public function getHasilRacikan($no_rawat)
    {
        $this->db->select('resep_obat.no_resep,
                           resep_obat.tgl_perawatan,
                           resep_obat.jam,
                           resep_dokter_racikan.nama_racik, 
                           metode_racik.nm_racik, 
                           resep_dokter_racikan.jml_dr, 
                           resep_dokter_racikan.aturan_pakai, 
                           resep_dokter_racikan_detail.kode_brng, 
                           databarang.nama_brng, 
                           resep_dokter_racikan_detail.jml');
        $this->db->from('resep_obat');
        $this->db->join('resep_dokter_racikan', 'resep_obat.no_resep = resep_dokter_racikan.no_resep', 'left');
        $this->db->join('resep_dokter_racikan_detail', 
                        'resep_dokter_racikan.no_resep = resep_dokter_racikan_detail.no_resep AND resep_dokter_racikan.no_racik = resep_dokter_racikan_detail.no_racik', 'left');
        $this->db->join('databarang', 'resep_dokter_racikan_detail.kode_brng = databarang.kode_brng', 'left');
        $this->db->join('metode_racik', 'resep_dokter_racikan.kd_racik = metode_racik.kd_racik', 'left');
        $this->db->where('resep_obat.no_rawat', $no_rawat);
        $this->db->order_by('resep_obat.no_resep, resep_dokter_racikan.nama_racik');

        $result = $this->db->get()->result_array();

        // Struktur ulang data agar mudah diproses di JS
        $groupedData = [];

        foreach ($result as $row) {
            if (empty($row['no_resep']) || empty($row['nama_racik'])) continue;

            $noResep = $row['no_resep'];

            if (!isset($groupedData[$noResep])) {
                $groupedData[$noResep] = [
                    'no_resep' => $noResep,
                    'nama_racik' => $row['nama_racik'],
                    'nm_racik' => $row['nm_racik'],
                    'jml_dr' => $row['jml_dr'],
                    'aturan_pakai' => $row['aturan_pakai'],
                    'tgl_perawatan' => $row['tgl_perawatan'],
                    'jam' => $row['jam'], 
                    'obat' => []
                ];
            }

            if (!empty($row['kode_brng']) && !empty($row['nama_brng'])) {
                $groupedData[$noResep]['obat'][] = [
                    'kode_brng' => $row['kode_brng'],
                    'nama_brng' => $row['nama_brng'],
                    'jml' => $row['jml']
                ];
            }
        }

        return $groupedData;
    }

    public function getRiwayatObatByNorm($no_rkm_medis)
    {
        $this->db->select('
            resep_obat.no_resep,
            resep_obat.no_rawat,
            pasien.no_rkm_medis,
            resep_dokter_racikan.nama_racik,
            metode_racik.nm_racik,
            resep_dokter_racikan.jml_dr,
            resep_dokter_racikan.aturan_pakai,
            resep_dokter_racikan_detail.kode_brng,
            databarang.nama_brng,
            resep_dokter_racikan_detail.jml,
            resep_dokter_racikan.keterangan
        ');
        $this->db->from('resep_obat');
        $this->db->join('reg_periksa', 'resep_obat.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('resep_dokter_racikan', 'resep_obat.no_resep = resep_dokter_racikan.no_resep');
        $this->db->join('resep_dokter_racikan_detail', 'resep_dokter_racikan.no_resep = resep_dokter_racikan_detail.no_resep AND resep_dokter_racikan.no_racik = resep_dokter_racikan_detail.no_racik');
        $this->db->join('databarang', 'resep_dokter_racikan_detail.kode_brng = databarang.kode_brng');
        $this->db->join('metode_racik', 'resep_dokter_racikan.kd_racik = metode_racik.kd_racik', 'left');
        $this->db->where('pasien.no_rkm_medis', $no_rkm_medis);
        $this->db->order_by('resep_obat.tgl_peresepan', 'DESC');

        return $this->db->get()->result_array();
    }

    // ✅ Simpan resep ke dalam database (Batch Insert)
    public function saveResep($no_rawat, $data)
    {
        foreach ($data as &$row) {
            $row['no_rawat'] = $no_rawat;
        }
        return $this->db->insert_batch($this->table, $data);
    }

    public function getHasilResep($no_rawat)
    {
        $this->db->select([
            'resep_obat.no_resep',
            'databarang.kode_brng',
            'databarang.nama_brng',
            'resep_dokter.jml',
            'databarang.ralan',
            'resep_dokter.aturan_pakai',
            'resep_obat.tgl_perawatan',
            'resep_obat.jam',
            '(resep_dokter.jml * databarang.ralan) AS total_bayar'
        ]);
        $this->db->from('resep_obat');
        $this->db->join('resep_dokter', 'resep_obat.no_resep = resep_dokter.no_resep', 'inner');
        $this->db->join('databarang', 'resep_dokter.kode_brng = databarang.kode_brng', 'inner');
        $this->db->where('resep_obat.no_rawat', $no_rawat);

        $query = $this->db->get();
        return $query->result();
    }

    // ✅ Hapus resep berdasarkan ID
    public function deleteById($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

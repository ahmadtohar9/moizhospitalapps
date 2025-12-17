<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermintaanResepRalan_model extends CI_Model
{
    private $table_obat = 'resep_obat';
    private $table_dokter = 'resep_dokter';

    // ✅ Ambil daftar obat dari gudang AP
    public function getObatList()
    {
        return $this->db->select('
                gudangbarang.kode_brng,
                databarang.nama_brng,
                databarang.ralan AS harga,
                kodesatuan.satuan,
                gudangbarang.stok
            ')
            ->from('databarang')
            ->join('gudangbarang', 'databarang.kode_brng = gudangbarang.kode_brng')
            ->join('kodesatuan', 'databarang.kode_sat = kodesatuan.kode_sat')
            ->where('gudangbarang.kd_bangsal', 'AP') // khusus gudang apotek
            ->where('gudangbarang.stok >', 0)
            ->get()
            ->result_array();
    }

    // ✅ Ambil hasil resep berdasarkan no_rawat
    public function getHasilResep($no_rawat)
    {
        return $this->db->select("
                resep_obat.no_resep,
                databarang.kode_brng,
                databarang.nama_brng,
                resep_obat.tgl_perawatan,
                resep_obat.jam, 
                resep_dokter.jml AS jumlah,
                databarang.ralan AS harga,
                resep_dokter.aturan_pakai AS signa,
                (resep_dokter.jml * databarang.ralan) AS total
            ")
            ->from('resep_obat')
            ->join('resep_dokter', 'resep_dokter.no_resep = resep_obat.no_resep')
            ->join('databarang', 'databarang.kode_brng = resep_dokter.kode_brng')
            ->where('resep_obat.no_rawat', $no_rawat)
            ->order_by('resep_obat.tgl_perawatan', 'ASC')
            ->order_by('resep_obat.jam', 'ASC')
            ->get()
            ->result_array();
    }

    // ✅ Ambil riwayat resep berdasarkan No RM
    public function getRiwayatObatByNorm($no_rkm_medis)
    {
        return $this->db->select("
                resep_obat.no_resep,
                resep_obat.tgl_perawatan,
                resep_obat.jam,
                resep_dokter.kode_brng,
                databarang.nama_brng,
                resep_dokter.jml,
                resep_dokter.aturan_pakai,
                (resep_dokter.jml * databarang.ralan) AS total_bayar,
                pasien.no_rkm_medis,
                pasien.nm_pasien
            ")
            ->from('resep_obat')
            ->join('resep_dokter', 'resep_obat.no_resep = resep_dokter.no_resep')
            ->join('databarang', 'resep_dokter.kode_brng = databarang.kode_brng')
            ->join('reg_periksa', 'resep_obat.no_rawat = reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis')
            ->where('pasien.no_rkm_medis', $no_rkm_medis)
            ->order_by('resep_obat.tgl_perawatan', 'ASC')
            ->order_by('resep_obat.jam', 'ASC')
            ->get()
            ->result_array();
    }

    // ✅ Simpan batch resep dokter (tidak digunakan langsung, tapi siap pakai)
    public function saveResep($no_resep, $resep)
    {
        foreach ($resep as &$item) {
            $item['no_resep'] = $no_resep;
        }
        return $this->db->insert_batch('resep_dokter', $resep);
    }

    // ✅ Hapus satuan resep
    public function deleteSingle($kode_brng, $jumlah)
    {
        return $this->db
            ->where('kode_brng', $kode_brng)
            ->where('jml', $jumlah)
            ->delete('resep_dokter');
    }

    // ✅ Hapus seluruh resep berdasarkan no_resep
    public function deleteAllByNoResep($no_resep)
    {
        $this->db->where('no_resep', $no_resep)->delete('resep_dokter');
        $this->db->where('no_resep', $no_resep)->delete('resep_obat');
        return true;
    }
}

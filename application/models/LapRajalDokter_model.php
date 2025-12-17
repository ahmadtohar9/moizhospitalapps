<?php
class LapRajalDokter_model extends CI_Model {

    public function get_dokter() {
        return $this->db->get('dokter')->result();
    }

   public function get_laporan($tgl_awal, $tgl_akhir, $kd_dokter = null) 
   {
        $this->db->select([
            'reg_periksa.no_rawat',
            'reg_periksa.no_rkm_medis',
            'pasien.nm_pasien',
            'reg_periksa.tgl_registrasi',
            'reg_periksa.kd_dokter',
            'dokter.nm_dokter',
            'reg_periksa.stts',
            'pasien.no_tlp'
        ]);
        
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');

        // ✅ Hanya pasien rawat jalan & tidak batal
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->db->where('reg_periksa.stts !=', 'Batal');

        // ✅ Filter tanggal jika tersedia
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        // ✅ Filter dokter jika dipilih
        if (!empty($kd_dokter)) {
            $this->db->where('reg_periksa.kd_dokter', $kd_dokter);
        }

        return $this->db->get()->result();
    }

public function get_total_per_dokter($tgl_awal, $tgl_akhir) {
    $this->db->select('dokter.nm_dokter, COUNT(reg_periksa.no_rawat) as total_pasien');
    $this->db->from('reg_periksa');
    $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter');
    $this->db->where('reg_periksa.status_lanjut', 'Ralan');
    $this->db->where('reg_periksa.stts !=', 'Batal');

    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
        $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
        $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
    }

    $this->db->group_by('reg_periksa.kd_dokter');
    return $this->db->get()->result();
}




}

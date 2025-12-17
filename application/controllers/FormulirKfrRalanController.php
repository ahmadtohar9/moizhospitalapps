<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormulirKfrRalanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('FormulirKfrModel');
        $this->load->model('RekamMedisRalanModel');
    }

    public function index()
    {
        // Loaded via RekamMedisRalanController
    }

    public function get_history()
    {
        $no_rawat = $this->input->get('no_rawat');
        $data = $this->FormulirKfrModel->get_by_no_rawat($no_rawat);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function get_detail()
    {
        $no_rawat = $this->input->get('no_rawat');
        $tgl = $this->input->get('tgl_perawatan');
        $jam = $this->input->get('jam_rawat');

        $data = $this->FormulirKfrModel->get_detail($no_rawat, $tgl, $jam);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // Get latest SOAP Plan from Program Rehab Medik
    public function get_latest_soap_plan()
    {
        $no_rawat = $this->input->get('no_rawat');

        if (empty($no_rawat)) {
            echo json_encode(['status' => 'error', 'message' => 'No rawat tidak ada']);
            return;
        }

        // Load RehabMedikModel
        $this->load->model('RehabMedikModel');

        // Get latest SOAP from rehab medik (all fields: S, O, A, P)
        $this->db->select('subjective, objective, assessment, procedure_text');
        $this->db->from('moizhospital_program_rehabmedik');
        $this->db->where('no_rawat', $no_rawat);
        $this->db->order_by('tgl_perawatan', 'DESC');
        $this->db->order_by('jam_rawat', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->row_array();

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'soap' => [
                    'subjective' => $result['subjective'] ?? '',
                    'objective' => $result['objective'] ?? '',
                    'assessment' => $result['assessment'] ?? '',
                    'plan' => $result['procedure_text'] ?? ''
                ]
            ]);
        } else {
            echo json_encode(['status' => 'success', 'soap' => null]);
        }
    }

    public function save()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tgl_perawatan = $this->input->post('tgl_perawatan');
        $jam_rawat = $this->input->post('jam_rawat');

        if (empty($no_rawat) || empty($tgl_perawatan) || empty($jam_rawat)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        $data = [
            'no_rawat' => $no_rawat,
            'tgl_perawatan' => $tgl_perawatan,
            'jam_rawat' => $jam_rawat,
            'kd_dokter' => $this->input->post('kd_dokter'),
            'subjective' => $this->input->post('subjective'),
            'objective' => $this->input->post('objective'),
            'assessment' => $this->input->post('assessment'),
            'goal_of_treatment' => $this->input->post('goal_of_treatment'),
            'tindakan_rehab' => $this->input->post('tindakan_rehab'),
            'edukasi' => $this->input->post('edukasi'),
            'frekuensi_kunjungan' => $this->input->post('frekuensi_kunjungan'),
            'rencana_tindak_lanjut' => $this->input->post('rencana_tindak_lanjut'),
            'ttd_dokter' => $this->input->post('ttd_dokter'), // Digital signature
        ];

        if ($this->FormulirKfrModel->save($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan / Data sudah ada']);
        }
    }

    public function update()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tgl_perawatan = $this->input->post('tgl_perawatan');
        $jam_rawat = $this->input->post('jam_rawat');
        $original_jam = $this->input->post('original_jam_rawat');

        // Jika jam diedit, flow-nya seharusnya check dulu availability. 
        // Tapi untuk simplifikasi, kita anggap primary key (tgl, jam) tidak diubah di mode edit 
        // kecuali user menghapus dan buat baru. Sesuai practice RehabMedik sebelumnya.

        // Tapi jika logic edit mengizinkan ubah waktu, ini jadi kompleks.
        // Asumsi: Edit hanya update content, bukan PK.

        $data = [
            'kd_dokter' => $this->input->post('kd_dokter'),
            'subjective' => $this->input->post('subjective'),
            'objective' => $this->input->post('objective'),
            'assessment' => $this->input->post('assessment'),
            'goal_of_treatment' => $this->input->post('goal_of_treatment'),
            'tindakan_rehab' => $this->input->post('tindakan_rehab'),
            'edukasi' => $this->input->post('edukasi'),
            'frekuensi_kunjungan' => $this->input->post('frekuensi_kunjungan'),
            'rencana_tindak_lanjut' => $this->input->post('rencana_tindak_lanjut'),
            'ttd_dokter' => $this->input->post('ttd_dokter'), // Digital signature
        ];

        // Gunakan jam original untuk where clause jika ada perubahan (tapi di form hidden input original_jam_rawat harusnya ada)
        $target_jam = $original_jam ? $original_jam : $jam_rawat;

        if ($this->FormulirKfrModel->update($no_rawat, $tgl_perawatan, $target_jam, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data']);
        }
    }

    public function delete()
    {
        $no_rawat = $this->input->post('no_rawat');
        $tgl_perawatan = $this->input->post('tgl_perawatan');
        $jam_rawat = $this->input->post('jam_rawat');

        if ($this->FormulirKfrModel->delete($no_rawat, $tgl_perawatan, $jam_rawat)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function cetak()
    {
        $this->load->model('SettingModel');

        $no_rawat = $this->input->get('no_rawat');
        $tgl_perawatan = $this->input->get('tgl_perawatan');
        $jam_rawat = $this->input->get('jam_rawat');

        if (empty($no_rawat) || empty($tgl_perawatan)) {
            show_error('Parameter cetak tidak lengkap.', 400);
            return;
        }

        $data['rehab'] = $this->FormulirKfrModel->get_detail($no_rawat, $tgl_perawatan, $jam_rawat);
        $data['pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);
        $data['setting'] = $this->db->get('setting')->row_array();

        if (empty($data['rehab'])) {
            show_error('Data tidak ditemukan', 404);
            return;
        }

        $this->load->view('formulir_kfr/cetak', $data);
    }
}

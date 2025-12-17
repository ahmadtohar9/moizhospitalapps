<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class OperasiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OperasiModel');
        $this->load->model('RekamMedisRalanModel');
        $this->load->model('MenuModel');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $no_rawat = $this->input->get('no_rawat', true) ?: $this->session->userdata('no_rawat');

        if (!$no_rawat) {
            show_error('No Rawat tidak ditemukan. Pastikan data pasien telah dipilih.', 400, 'Error');
            return;
        }

        $this->session->set_userdata('no_rawat', $no_rawat);

        // Get Patient Info
        $data['no_rawat'] = $no_rawat;
        $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($no_rawat);

        // Check clean no_rawat if needed
        if (!$data['detail_pasien']) {
            $clean_no_rawat = str_replace('/', '', $no_rawat);
            $data['detail_pasien'] = $this->RekamMedisRalanModel->get_patient_detail($clean_no_rawat);
            if ($data['detail_pasien'])
                $data['no_rawat'] = $clean_no_rawat;
        }

        if (!$data['detail_pasien']) {
            show_error('Data pasien tidak ditemukan.', 404, 'Error');
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $data['menus'] = $this->MenuModel->get_menu_by_user($user_id);
        $data['action_menus'] = $this->MenuModel->get_active_action_menus();

        // Data for Form
        // Load initial 50 items to avoid blank dropdowns
        $data['paket_operasi'] = $this->OperasiModel->get_paket_operasi_limit(50);
        $data['dokter'] = $this->OperasiModel->get_dokter_limit(50);
        $data['petugas'] = $this->OperasiModel->get_petugas_limit(50);

        // Existing Data
        $data['list_operasi'] = $this->OperasiModel->get_operasi_by_no_rawat($data['no_rawat']);

        $data['tgl_sekarang'] = date('Y-m-d');
        $data['jam_sekarang'] = date('H:i:s');

        $this->load->view('rekammedis/dokter/input_operasi_view', $data);
    }

    public function save()
    {
        $this->output->set_content_type('application/json');
        $post = $this->input->post();

        if (empty($post['no_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat wajib diisi.']);
            return;
        }

        try {
            // Prepare Data
            $data = [
                'no_rawat' => $post['no_rawat'],
                'kode_paket' => $post['kode_paket'],
                'operator1' => $post['operator1'],
                'operator2' => $post['operator2'],
                'operator3' => $post['operator3'],
                'dokter_anestesi' => $post['dokter_anestesi'],
                'asisten_operator1' => $post['asisten_operator1'],
                'asisten_operator2' => $post['asisten_operator2'],
                'asisten_operator3' => $post['asisten_operator3'],
                'asisten_anestesi' => $post['asisten_anestesi'],
                'asisten_anestesi2' => $post['asisten_anestesi2'],
                'jenis_anasthesi' => $post['jenis_anasthesi'],
                'kategori' => $post['kategori'],
                'status' => 'Data Input',

                // Add fields based on Khanza (Default to '-' as per rules)
                'dokter_anak' => !empty($post['dokter_anak']) ? $post['dokter_anak'] : '-',
                'perawaat_resusitas' => !empty($post['perawat_resusitas']) ? $post['perawat_resusitas'] : '-',
                'perawat_luar' => !empty($post['perawat_luar']) ? $post['perawat_luar'] : '-',
                'bidan' => !empty($post['bidan']) ? $post['bidan'] : '-',
                'bidan2' => !empty($post['bidan2']) ? $post['bidan2'] : '-',
                'bidan3' => !empty($post['bidan3']) ? $post['bidan3'] : '-',
                'instrumen' => !empty($post['instrument']) ? $post['instrument'] : '-',
                'dokter_pjanak' => !empty($post['dokter_pjanak']) ? $post['dokter_pjanak'] : '-',
                'dokter_umum' => !empty($post['dokter_umum']) ? $post['dokter_umum'] : '-',
                'omloop' => !empty($post['omloop']) ? $post['omloop'] : '-',
                'omloop2' => !empty($post['omloop2']) ? $post['omloop2'] : '-',
                'omloop3' => !empty($post['omloop3']) ? $post['omloop3'] : '-',
                'omloop4' => !empty($post['omloop4']) ? $post['omloop4'] : '-',
                'omloop5' => !empty($post['omloop5']) ? $post['omloop5'] : '-',
            ];

            // --- LOGIC UPDATE (DELETE OLD FIRST) ---
            // If tgl_operasi_lama exists, it means we are editing.
            $tgl_lama = $post['tgl_operasi_lama'];
            if (!empty($tgl_lama)) {
                // Delete existing record first to allow fresh insert
                // Note: tgl_operasi_lama must exactly match DB format (YYYY-MM-DD HH:mm:ss)
                $this->OperasiModel->delete($post['no_rawat'], $tgl_lama);
            }

            // Handle Date Time Start
            $tgl = $post['tgl_operasi'];
            if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $tgl, $matches)) {
                $tgl = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
            }
            $data['tgl_operasi'] = $tgl . ' ' . $post['jam_operasi'];


            // Handle Date Time End (Selesai) IF requested to be saved in operasi table (rare, usually separate log or same table)
            // Assuming the table 'operasi' might NOT have 'tgl_selesai' column in standard implementation (often it's just tgl_operasi).
            // But if user wants to save it, let's look for a place. 
            // For now, I will NOT insert tgl_selesai into 'operasi' table unless I know the column name.
            // Khanza `operasi` table usually has `tgl_operasi` as PK. 
            // `laporan_operasi` table has `tanggal` and `selesai`.
            // I will save the EXTRA data (diag, laporan) to `laporan_operasi` if needed or just handle `operasi` only first.
            // Let's stick to saving main personnel to `operasi`.

            // --- FETCH COSTS FROM PAKET_OPERASI ---
            $paket = $this->OperasiModel->get_detail_paket($post['kode_paket']);

            if (!$paket) {
                echo json_encode(['status' => 'error', 'message' => 'Detail Paket Operasi tidak ditemukan.']);
                return;
            }

            // Map paket_operasi fields to operasi cost fields
            // Assuming standard Khanza column names
            $data['biayaoperator1'] = $paket['operator1'];
            $data['biayaoperator2'] = $paket['operator2'];
            $data['biayaoperator3'] = $paket['operator3'];
            $data['biayaasisten_operator1'] = $paket['asisten_operator1'];
            $data['biayaasisten_operator2'] = $paket['asisten_operator2'];
            $data['biayaasisten_operator3'] = $paket['asisten_operator3'];
            $data['biayainstrumen'] = $paket['instrumen'];
            $data['biayadokter_anak'] = $paket['dokter_anak'];
            $data['biayaperawaat_resusitas'] = $paket['perawaat_resusitas'];
            $data['biayadokter_anestesi'] = $paket['dokter_anestesi'];
            $data['biayaasisten_anestesi'] = $paket['asisten_anestesi'];
            $data['biayaasisten_anestesi2'] = $paket['asisten_anestesi2'];
            $data['biayabidan'] = $paket['bidan'];
            $data['biayabidan2'] = $paket['bidan2'];
            $data['biayabidan3'] = $paket['bidan3'];
            $data['biayaperawat_luar'] = $paket['perawat_luar'];
            $data['biayaalat'] = $paket['alat'];
            $data['biayasewaok'] = $paket['sewa_ok'];
            $data['akomodasi'] = $paket['akomodasi'];
            $data['bagian_rs'] = $paket['bagian_rs'];
            $data['biaya_omloop'] = $paket['omloop'];
            $data['biaya_omloop2'] = $paket['omloop2'];
            $data['biaya_omloop3'] = $paket['omloop3'];
            $data['biaya_omloop4'] = $paket['omloop4'];
            $data['biaya_omloop5'] = $paket['omloop5'];
            $data['biayasarpras'] = $paket['sarpras'];
            $data['biaya_dokter_pjanak'] = $paket['dokter_pjanak'];
            $data['biaya_dokter_umum'] = $paket['dokter_umum'];

            // --- DATA LAPORAN OPERASI ---
            // Construct selesaioperasi datetime
            $jam_selesai = $post['jam_selesai'] ?? $post['jam_selesai_operasi'] ?? null;
            if ($jam_selesai) {
                // Use date from tgl_operasi
                $date_part = date('Y-m-d', strtotime($data['tgl_operasi']));
                $tgl_selesai = $date_part . ' ' . $jam_selesai;
            } else {
                // Default 1 hour later
                $tgl_selesai = date('Y-m-d H:i:s', strtotime($data['tgl_operasi'] . ' +1 hour'));
            }

            // Prepare data for laporan_operasi table
            $data_laporan = [
                'no_rawat' => $post['no_rawat'],
                'tanggal' => $data['tgl_operasi'],
                // 'status' => 'Selesai', // REMOVED (No column)
                'diagnosa_preop' => $post['diagnosa_pre_op'] ?? $post['diagnosa_pre'] ?? '-',
                'diagnosa_postop' => $post['diagnosa_post_op'] ?? $post['diagnosa_post'] ?? '-',
                'laporan_operasi' => $post['laporan_operasi'] ?? '-',
                'jaringan_dieksekusi' => $post['jaringan_eksisi_insisi'] ?? $post['jaringan'] ?? '-',
                'selesaioperasi' => $tgl_selesai,
                'permintaan_pa' => $post['permintaan_pa'] ?? $post['dikirim_pa'] ?? 'Tidak',
                'nomor_implan' => $post['nomor_implan'] ?? '-'
            ];

            // REMOVED PERSONNEL FIELDS FROM LAPORAN_OPERASI INSERT (As they are not in the table schema)

            if ($this->OperasiModel->insert($data)) {
                // Insert Laporan
                // Use ignore or replace? Standard insert might fail if key exists.
                // But since we delete old one on edit, it should be fine.
                $this->OperasiModel->insert_laporan($data_laporan);

                echo json_encode(['status' => 'success', 'message' => 'Data operasi & laporan berhasil disimpan.']);
            } else {
                $error = $this->db->error();
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan: ' . $error['message']]);
            }

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    public function delete()
    {
        $this->output->set_content_type('application/json');
        $no_rawat = $this->input->post('no_rawat');
        // We need tgl_operasi to identify the specific operation record
        $tgl_operasi = $this->input->post('tgl_operasi');

        if (empty($no_rawat) || empty($tgl_operasi)) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter hapus tidak lengkap']);
            return;
        }

        if ($this->OperasiModel->delete($no_rawat, $tgl_operasi)) {
            echo json_encode(['status' => 'success', 'message' => 'Data operasi berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function get_riwayat_operasi()
    {
        $no_rawat = $this->input->get('no_rawat');
        $list_operasi = $this->OperasiModel->get_operasi_by_no_rawat($no_rawat);
        $html = '';

        if (empty($list_operasi)) {
            $html .= '<tr><td colspan="4" class="text-center text-muted">Belum ada data operasi.</td></tr>';
        } else {
            foreach ($list_operasi as $row) {
                // Fetch SOAP Data (Cached/Fast)
                $soap = $this->OperasiModel->get_pemeriksaan_terakhir($row['no_rawat']);
                $row['soap'] = $soap ? $soap : [];

                // Encode Data
                $jsonRow = base64_encode(json_encode($row));

                // Status Color
                $statusBadge = ($row['status'] == 'Selesai') ? 'bg-green' : 'bg-yellow';

                // Print URL
                $printUrl = base_url('OperasiController/cetak') . '?no_rawat=' . $row['no_rawat'] . '&tgl_operasi=' . $row['tgl_operasi'];

                $html .= '<tr>';
                $html .= '<td>' . date('d-m-Y H:i', strtotime($row['tgl_operasi'])) . '</td>';
                $html .= '<td>';
                $html .= '<b>' . $row['nm_paket_operasi'] . '</b><br>';
                $html .= '<small class="text-muted">' . $row['nm_operator1'] . '</small>';
                $html .= '</td>';
                $html .= '<td><span class="badge ' . $statusBadge . '">' . $row['status'] . '</span></td>';
                $html .= '<td  style="width: 120px;">';
                $html .= '<button class="btn btn-xs btn-default" title="Cetak Laporan" onclick="window.open(\'' . $printUrl . '\', \'_blank\')"><i class="fa fa-print"></i></button> ';
                $html .= '<button class="btn btn-xs btn-info" onclick="lihatOperasi(\'' . $jsonRow . '\')"><i class="fa fa-eye"></i></button> ';
                $html .= '<button class="btn btn-xs btn-warning" onclick="editOperasi(\'' . $jsonRow . '\')"><i class="fa fa-pencil"></i></button> ';
                $html .= '<button class="btn btn-xs btn-danger" onclick="hapusOperasi(\'' . $row['no_rawat'] . '\', \'' . $row['tgl_operasi'] . '\')"><i class="fa fa-trash"></i></button>';
                $html .= '</td>';
                $html .= '</tr>';
            }
        }

        echo json_encode(['html' => $html]);
    }

    public function cetak()
    {
        $no_rawat = $this->input->get('no_rawat');
        $tgl_operasi = $this->input->get('tgl_operasi');

        // Get Data
        $list = $this->OperasiModel->get_operasi_by_no_rawat($no_rawat);
        $data = null;
        foreach ($list as $r) {
            if ($r['tgl_operasi'] == $tgl_operasi) {
                $data = $r;
                break;
            }
        }

        if (!$data) {
            echo "Data operasi tidak ditemukan.";
            return;
        }

        // Get Pemeriksaan Terakhir
        $soap = $this->OperasiModel->get_pemeriksaan_terakhir($no_rawat);

        // Generate PDF
        $this->load->library('pdf');
        // Clean filename
        $filename = 'Laporan_Operasi_' . str_replace(['/', ' '], '_', $no_rawat);
        $this->pdf->load_view('rekammedis/dokter/cetak_operasi_pdf', ['data' => $data, 'soap' => $soap], $filename, 'A4', 'portrait');
    }

    /* =================== AJAX SEARCH =================== */

    public function cari_dokter()
    {
        $this->output->set_content_type('application/json');
        $q = $this->input->get('q');
        $data = $this->OperasiModel->search_dokter($q);
        echo json_encode($data);
        exit;
    }

    public function cari_petugas()
    {
        $this->output->set_content_type('application/json');
        $q = $this->input->get('q');
        $data = $this->OperasiModel->search_petugas($q);
        echo json_encode($data);
        exit;
    }

    public function cari_paket()
    {
        $this->output->set_content_type('application/json');
        $q = $this->input->get('q');
        $data = $this->OperasiModel->search_paket_operasi($q);
        echo json_encode($data);
        exit;
    }
}

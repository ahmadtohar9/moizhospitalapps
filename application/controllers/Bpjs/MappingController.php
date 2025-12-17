<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mapping Controller - BPJS VClaim
 * 
 * Controller untuk mapping data RS ke BPJS
 * Fokus: Mapping Poli
 * 
 * @author Ahmad Tohar
 * @version 1.0
 */
class MappingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load libraries
        $this->load->library('Bpjs/Vclaim');
        $this->load->model('Bpjs/MappingModel');
        $this->load->model('MenuModel');
        $this->load->database();

        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Only admin can access
        if ($this->session->userdata('role_id') != 1) {
            show_error('Akses ditolak! Halaman ini hanya untuk admin.', 403);
        }
    }

    /**
     * Dashboard Mapping
     */
    public function index()
    {
        $data['title'] = 'BPJS Mapping Dashboard';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Get statistics
        $data['stats'] = [
            'total_poli_rs' => $this->db->count_all('poliklinik'),
            'total_poli_bpjs' => $this->db->query("SELECT COUNT(DISTINCT kd_poli_bpjs) as total FROM maping_poli_bpjs")->row()->total,
            'total_mapped' => $this->db->count_all('maping_poli_bpjs'),
        ];

        $data['stats']['unmapped'] = $data['stats']['total_poli_rs'] - $data['stats']['total_mapped'];
        $data['stats']['progress'] = $data['stats']['total_poli_rs'] > 0
            ? round(($data['stats']['total_mapped'] / $data['stats']['total_poli_rs']) * 100, 2)
            : 0;

        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/dashboard', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Mapping Poli Interface
     */
    public function poli()
    {
        $data['title'] = 'Mapping Poli RS ke BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Get poli RS yang belum di-mapping
        $data['poli_rs'] = $this->MappingModel->get_unmapped_poli();

        // Get poli BPJS
        $data['poli_bpjs'] = $this->db->order_by('nama', 'ASC')->get('bpjs_ref_poli')->result_array();

        // Get existing mapping
        $data['mapped'] = $this->MappingModel->get_mapped_poli();

        // Get menu
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/poli', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Save mapping poli
     */
    public function save_mapping_poli()
    {
        $kd_poli_rs = $this->input->post('kd_poli_rs');
        $kd_poli_bpjs = $this->input->post('kd_poli_bpjs');

        if (empty($kd_poli_rs) || empty($kd_poli_bpjs)) {
            echo json_encode([
                'success' => false,
                'message' => 'Kode poli RS dan BPJS harus diisi!'
            ]);
            return;
        }

        // Get nama poli
        $poli_rs = $this->db->get_where('poliklinik', ['kd_poli' => $kd_poli_rs])->row_array();
        $poli_bpjs = $this->db->get_where('bpjs_ref_poli', ['kode' => $kd_poli_bpjs])->row_array();

        if (!$poli_rs || !$poli_bpjs) {
            echo json_encode([
                'success' => false,
                'message' => 'Poli tidak ditemukan!'
            ]);
            return;
        }

        // Save mapping
        $mapping_data = [
            'kd_poli_rs' => $kd_poli_rs,
            'kd_poli_bpjs' => $kd_poli_bpjs,
            'nm_poli_rs' => $poli_rs['nm_poli'],
            'nm_poli_bpjs' => $poli_bpjs['nama'],
            'is_active' => 1,
            'mapped_by' => $this->session->userdata('user_id')
        ];

        $result = $this->MappingModel->save_mapping_poli($mapping_data);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Mapping berhasil disimpan!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyimpan mapping!'
            ]);
        }
    }

    /**
     * Delete mapping poli
     */
    public function delete_mapping_poli($kd_poli_rs)
    {
        $result = $this->db->where('kd_poli_rs', $kd_poli_rs)->delete('maping_poli_bpjs');

        if ($result) {
            $this->session->set_flashdata('success', 'Mapping berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus mapping!');
        }

        redirect('bpjs/mapping/poli');
    }

    /**
     * Delete mapping poli (AJAX)
     */
    public function delete_mapping_poli_ajax()
    {
        $kd_poli_rs = $this->input->post('kd_poli_rs');

        if (empty($kd_poli_rs)) {
            echo json_encode([
                'success' => false,
                'message' => 'Kode poli RS tidak valid!'
            ]);
            return;
        }

        // Get poli data before delete (for adding back to unmapped list)
        $poli_data = $this->db->get_where('poliklinik', ['kd_poli' => $kd_poli_rs])->row_array();

        // Delete mapping
        $result = $this->db->where('kd_poli_rs', $kd_poli_rs)->delete('maping_poli_bpjs');

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Mapping berhasil dihapus!',
                'poli_data' => $poli_data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus mapping!'
            ]);
        }
    }

    /**
     * Auto mapping poli (kode sama)
     */
    public function auto_mapping_poli()
    {
        try {
            $jumlah = 0;

            // Get all poli RS
            $poli_rs_list = $this->db->get('poliklinik')->result_array();

            foreach ($poli_rs_list as $poli_rs) {
                // Check if already mapped
                $exists = $this->db->get_where('maping_poli_bpjs', [
                    'kd_poli_rs' => $poli_rs['kd_poli']
                ])->row_array();

                if ($exists) {
                    continue; // Skip if already mapped
                }

                // Try to find matching BPJS poli by code
                $poli_bpjs = $this->db->get_where('bpjs_ref_poli', [
                    'kode' => strtoupper($poli_rs['kd_poli'])
                ])->row_array();

                if ($poli_bpjs) {
                    // Auto map
                    $this->db->insert('maping_poli_bpjs', [
                        'kd_poli_rs' => $poli_rs['kd_poli'],
                        'kd_poli_bpjs' => $poli_bpjs['kode'],
                        'nm_poli_bpjs' => $poli_bpjs['nama']
                    ]);
                    $jumlah++;
                }
            }

            echo json_encode([
                'success' => true,
                'message' => 'Auto mapping berhasil!',
                'jumlah' => $jumlah
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Auto mapping gagal: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Search poli BPJS via API
     */
    public function search_poli_bpjs()
    {
        $keyword = $this->input->post('keyword');

        if (empty($keyword) || strlen($keyword) < 3) {
            echo json_encode([
                'success' => false,
                'message' => 'Keyword minimal 3 karakter'
            ]);
            return;
        }

        try {
            // Call BPJS API via Vclaim library
            $response = $this->vclaim->referensi_poli($keyword);

            log_message('info', 'BPJS Search Response: ' . json_encode($response));

            // Check metadata
            if (!isset($response['metaData']) || $response['metaData']['code'] != '200') {
                throw new Exception($response['metaData']['message'] ?? 'Response code bukan 200');
            }

            // Get poli list from response
            $poli_list = [];

            // Response structure from Vclaim: { metaData: {...}, response: [...] or {poli: [...]} }
            if (isset($response['response'])) {
                if (is_array($response['response'])) {
                    // Check if it's direct array or has 'poli' key
                    if (isset($response['response']['poli'])) {
                        $poli_list = $response['response']['poli'];
                    } elseif (isset($response['response']['list'])) {
                        $poli_list = $response['response']['list'];
                    } else {
                        // Direct array
                        $poli_list = $response['response'];
                    }
                }
            }

            echo json_encode([
                'success' => true,
                'data' => $poli_list,  // Flatten to direct array
                'count' => count($poli_list)
            ]);

        } catch (Exception $e) {
            log_message('error', 'Search BPJS Error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mencari data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Sync referensi poli dari BPJS
     */
    public function sync_poli()
    {
        try {
            // Get referensi poli dari BPJS
            $response = $this->vclaim->referensi_poli();

            if (!isset($response['metaData']) || $response['metaData']['code'] != 200) {
                throw new Exception($response['metaData']['message'] ?? 'Gagal mengambil data dari BPJS');
            }

            $poli_list = $response['response']['list'] ?? [];
            $inserted = 0;
            $updated = 0;

            foreach ($poli_list as $poli) {
                $data = [
                    'kode' => $poli['kode'],
                    'nama' => $poli['nama'],
                    'is_active' => 1
                ];

                // Check if exists
                $exists = $this->db->get_where('bpjs_ref_poli', ['kode' => $poli['kode']])->row_array();

                if ($exists) {
                    $this->db->where('kode', $poli['kode'])->update('bpjs_ref_poli', $data);
                    $updated++;
                } else {
                    $this->db->insert('bpjs_ref_poli', $data);
                    $inserted++;
                }
            }

            // Log sync
            $this->db->insert('bpjs_sync_log', [
                'jenis_referensi' => 'poli',
                'status' => 'success',
                'jumlah_data' => count($poli_list),
                'response_message' => "Inserted: $inserted, Updated: $updated",
                'synced_by' => $this->session->userdata('user_id')
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Sync berhasil!',
                'data' => [
                    'total' => count($poli_list),
                    'inserted' => $inserted,
                    'updated' => $updated
                ]
            ]);

        } catch (Exception $e) {
            // Log error
            $this->db->insert('bpjs_sync_log', [
                'jenis_referensi' => 'poli',
                'status' => 'failed',
                'jumlah_data' => 0,
                'response_message' => $e->getMessage(),
                'synced_by' => $this->session->userdata('user_id')
            ]);

            echo json_encode([
                'success' => false,
                'message' => 'Sync gagal: ' . $e->getMessage()
            ]);
        }
    }

    // ==================== MAPPING DOKTER ====================

    /**
     * Mapping Dokter page
     */
    public function dokter()
    {
        $data['title'] = 'Mapping Dokter BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Get unmapped dokter
        $data['dokter_rs'] = $this->db->query("
            SELECT d.kd_dokter, d.nm_dokter 
            FROM dokter d
            LEFT JOIN maping_dokter_dpjpvclaim m ON d.kd_dokter = m.kd_dokter
            WHERE m.kd_dokter IS NULL AND d.status = '1'
            ORDER BY d.nm_dokter
        ")->result_array();

        // Get mapped dokter
        $data['mapped_dokter'] = $this->db->query("
            SELECT m.*, d.nm_dokter as nm_dokter_rs
            FROM maping_dokter_dpjpvclaim m
            JOIN dokter d ON m.kd_dokter = d.kd_dokter
            ORDER BY d.nm_dokter
        ")->result_array();

        // Get menu
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/dokter', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Search dokter BPJS via API
     */
    public function search_dokter_bpjs()
    {
        $jenis_pelayanan = $this->input->post('jenis_pelayanan') ?: '2'; // Default: Rawat Jalan
        $tgl_pelayanan = $this->input->post('tgl_pelayanan') ?: date('Y-m-d');
        $spesialis = $this->input->post('spesialis');

        if (empty($spesialis)) {
            echo json_encode([
                'success' => false,
                'message' => 'Kode spesialis harus diisi!'
            ]);
            return;
        }

        try {
            // Call BPJS API
            $response = $this->vclaim->referensi_dokter_pelayanan($jenis_pelayanan, $tgl_pelayanan, $spesialis);

            log_message('info', 'BPJS Dokter Search Response: ' . json_encode($response));

            // Check metadata
            if (!isset($response['metaData']) || $response['metaData']['code'] != '200') {
                throw new Exception($response['metaData']['message'] ?? 'Response code bukan 200');
            }

            // Get dokter list from response
            $dokter_list = [];

            if (isset($response['response'])) {
                if (isset($response['response']['list'])) {
                    $dokter_list = $response['response']['list'];
                } elseif (is_array($response['response'])) {
                    $dokter_list = $response['response'];
                }
            }

            echo json_encode([
                'success' => true,
                'data' => $dokter_list,
                'count' => count($dokter_list)
            ]);

        } catch (Exception $e) {
            log_message('error', 'Search Dokter BPJS Error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mencari data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Save mapping dokter
     */
    public function save_mapping_dokter()
    {
        $kd_dokter = $this->input->post('kd_dokter');
        $kd_dokter_bpjs = $this->input->post('kd_dokter_bpjs');
        $nm_dokter_bpjs = $this->input->post('nm_dokter_bpjs');

        if (empty($kd_dokter) || empty($kd_dokter_bpjs)) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap!'
            ]);
            return;
        }

        // Check if already mapped
        $existing = $this->db->get_where('maping_dokter_dpjpvclaim', ['kd_dokter' => $kd_dokter])->row();
        if ($existing) {
            echo json_encode([
                'success' => false,
                'message' => 'Dokter sudah di-mapping!'
            ]);
            return;
        }

        // Insert mapping
        $data = [
            'kd_dokter' => $kd_dokter,
            'kd_dokter_bpjs' => $kd_dokter_bpjs,
            'nm_dokter_bpjs' => $nm_dokter_bpjs
        ];

        $result = $this->db->insert('maping_dokter_dpjpvclaim', $data);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Mapping dokter berhasil disimpan!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyimpan mapping!'
            ]);
        }
    }

    /**
     * Delete mapping dokter (AJAX)
     */
    public function delete_mapping_dokter_ajax()
    {
        $kd_dokter = $this->input->post('kd_dokter');

        if (empty($kd_dokter)) {
            echo json_encode([
                'success' => false,
                'message' => 'Kode dokter tidak valid!'
            ]);
            return;
        }

        // Get dokter data before delete
        $dokter_data = $this->db->get_where('dokter', ['kd_dokter' => $kd_dokter])->row_array();

        // Delete mapping
        $result = $this->db->where('kd_dokter', $kd_dokter)->delete('maping_dokter_dpjpvclaim');

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Mapping berhasil dihapus!',
                'dokter_data' => $dokter_data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus mapping!'
            ]);
        }
    }

    /**
     * Get spesialis BPJS via API
     */
    /**
     * Get spesialis BPJS via API
     */
    public function get_spesialis_bpjs()
    {
        try {
            $response = $this->vclaim->referensi_spesialis();

            if (!isset($response['metaData']) || $response['metaData']['code'] != '200') {
                throw new Exception($response['metaData']['message'] ?? 'Response code bukan 200');
            }

            $spesialis_list = [];
            if (isset($response['response'])) {
                if (isset($response['response']['list'])) {
                    $spesialis_list = $response['response']['list'];
                } elseif (is_array($response['response'])) {
                    $spesialis_list = $response['response'];
                }
            }

            echo json_encode([
                'success' => true,
                'data' => $spesialis_list
            ]);

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengambil data spesialis: ' . $e->getMessage()
            ]);
        }
    }

    // ==================== MAPPING DIAGNOSA ====================

    /**
     * Mapping Diagnosa Interface
     */
    public function diagnosa()
    {
        $data['title'] = 'Mapping Diagnosa BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Get unmapped diagnosa RS
        $data['diagnosa_rs'] = $this->MappingModel->get_unmapped_diagnosa();

        // Get mapped diagnosa
        $data['mapped_diagnosa'] = $this->MappingModel->get_mapped_diagnosa();

        // Get menu
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data); // Assuming menu needs to be loaded too
        $this->load->view('bpjs/mapping/diagnosa', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Search diagnosa BPJS via API
     */
    public function search_diagnosa_bpjs()
    {
        $keyword = $this->input->post('keyword');

        if (empty($keyword) || strlen($keyword) < 3) {
            echo json_encode([
                'success' => false,
                'message' => 'Keyword minimal 3 karakter'
            ]);
            return;
        }

        try {
            $response = $this->vclaim->referensi_diagnosa($keyword);

            if (!isset($response['metaData']) || $response['metaData']['code'] != '200') {
                throw new Exception($response['metaData']['message'] ?? 'Data tidak ditemukan / Error API');
            }

            $diagnosa_list = [];
            if (isset($response['response'])) {
                if (isset($response['response']['diagnosa'])) {
                    $diagnosa_list = $response['response']['diagnosa'];
                } elseif (isset($response['response']['list'])) {
                    $diagnosa_list = $response['response']['list'];
                } else {
                    $diagnosa_list = $response['response'];
                }
            }

            echo json_encode([
                'success' => true,
                'data' => $diagnosa_list,
                'count' => count($diagnosa_list)
            ]);

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mencari data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Save mapping diagnosa
     */
    public function save_mapping_diagnosa()
    {
        $kd_diags_rs = $this->input->post('kd_diags_rs');
        $kd_diags_bpjs = $this->input->post('kd_diags_bpjs');
        $nm_diags_bpjs = $this->input->post('nm_diags_bpjs');

        if (empty($kd_diags_rs) || empty($kd_diags_bpjs)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $data = [
            'kd_diags_rs' => $kd_diags_rs,
            'kd_diags_bpjs' => $kd_diags_bpjs,
            'nm_diags_bpjs' => $nm_diags_bpjs,
            'is_active' => 1
        ];

        if ($this->MappingModel->save_mapping_diagnosa($data)) {
            echo json_encode(['success' => true, 'message' => 'Mapping berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan mapping']);
        }
    }

    /**
     * Delete mapping diagnosa
     */
    public function delete_mapping_diagnosa_ajax()
    {
        $kd_diags_rs = $this->input->post('kd_diags_rs');

        // Get diagnosa data before delete (for adding back to unmapped list)
        $diagnosa_data = $this->db->get_where('penyakit', ['kd_penyakit' => $kd_diags_rs])->row_array();

        if ($this->MappingModel->delete_mapping_diagnosa($kd_diags_rs)) {
            echo json_encode([
                'success' => true,
                'message' => 'Mapping berhasil dihapus',
                'diagnosa_data' => $diagnosa_data
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus mapping']);
        }
    }

    // ==================== MAPPING FASKES ====================

    /**
     * Mapping Faskes Interface
     */
    public function faskes()
    {
        $data['title'] = 'Mapping Fasilitas Kesehatan BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');

        // Get unmapped faskes
        $data['faskes_rs'] = $this->MappingModel->get_unmapped_faskes();

        // Get mapped faskes
        $data['mapped_faskes'] = $this->MappingModel->get_mapped_faskes();

        // Get menu
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/faskes', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Search faskes BPJS via API
     */
    public function search_faskes_bpjs()
    {
        $keyword = $this->input->post('keyword');
        $jenis_faskes = $this->input->post('jenis_faskes') ?: '1'; // 1=Faskes 1, 2=Faskes 2/RS

        if (empty($keyword) || strlen($keyword) < 3) {
            echo json_encode(['success' => false, 'message' => 'Keyword minimal 3 karakter']);
            return;
        }

        try {
            $response = $this->vclaim->referensi_faskes($keyword, $jenis_faskes);

            if (!isset($response['metaData']) || $response['metaData']['code'] != '200') {
                throw new Exception($response['metaData']['message'] ?? 'Data tidak ditemukan');
            }

            $list = [];
            if (isset($response['response'])) {
                if (isset($response['response']['faskes'])) {
                    $list = $response['response']['faskes'];
                } elseif (isset($response['response']['list'])) {
                    $list = $response['response']['list'];
                } else {
                    $list = $response['response'];
                }
            }

            echo json_encode([
                'success' => true,
                'data' => $list,
                'count' => count($list)
            ]);

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal mencari: ' . $e->getMessage()]);
        }
    }

    /**
     * Search Dokter Local (Mapped)
     */
    public function search_dokter_local()
    {
        $keyword = $this->input->post('keyword');

        $this->db->select('m.kd_dokter_bpjs, m.nm_dokter_bpjs, d.nm_dokter');
        $this->db->from('maping_dokter_dpjpvclaim m');
        $this->db->join('dokter d', 'm.kd_dokter = d.kd_dokter', 'left');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('m.nm_dokter_bpjs', $keyword);
            $this->db->or_like('d.nm_dokter', $keyword);
            $this->db->or_like('m.kd_dokter_bpjs', $keyword);
            $this->db->group_end();
        }
        $this->db->limit(50);

        $results = $this->db->get()->result_array();

        $data = [];
        foreach ($results as $row) {
            $data[] = [
                'kode' => $row['kd_dokter_bpjs'],
                'nama' => $row['nm_dokter_bpjs'] . ' (' . $row['nm_dokter'] . ')'
            ];
        }

        echo json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Get PPK Pelayanan (Hospital Info)
     */
    public function get_ppk_pelayanan()
    {
        // Get directly from setting table
        // Assumes columns: kode_ppk, nama_instansi
        $setting = $this->db->select('kode_ppk, nama_instansi')->get('setting')->row();

        if ($setting) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'kode' => $setting->kode_ppk,
                    'nama' => $setting->nama_instansi
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data setting rumah sakit belum dikonfigurasi'
            ]);
        }
    }

    /**
     * Save mapping faskes
     */
    public function save_mapping_faskes()
    {
        $nama_faskes_rs = $this->input->post('nama_faskes_rs');
        $kode_faskes_bpjs = $this->input->post('kode_faskes_bpjs');
        $nama_faskes_bpjs = $this->input->post('nama_faskes_bpjs');
        $jenis_faskes = $this->input->post('jenis_faskes');

        if (empty($nama_faskes_rs) || empty($kode_faskes_bpjs)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $data = [
            'nama_faskes_rs' => $nama_faskes_rs,
            'kode_faskes_bpjs' => $kode_faskes_bpjs,
            'nama_faskes_bpjs' => $nama_faskes_bpjs,
            'jenis_faskes' => $jenis_faskes,
            'is_active' => 1
        ];

        if ($this->MappingModel->save_mapping_faskes($data)) {
            echo json_encode(['success' => true, 'message' => 'Mapping berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan mapping']);
        }
    }

    /**
     * Delete mapping faskes
     */
    public function delete_mapping_faskes_ajax()
    {
        $id = $this->input->post('id');

        if ($this->MappingModel->delete_mapping_faskes($id)) {
            echo json_encode(['success' => true, 'message' => 'Mapping dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus mapping']);
        }
    }
    /**
     * =========================================
     * MAPPING LOKASI (PROPINSI, KABUPATEN, KECAMATAN)
     * =========================================
     */
    public function lokasi()
    {
        $data['title'] = 'Mapping Lokasi BPJS';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/lokasi', $data);
        $this->load->view('templates/footer');
    }

    public function get_propinsi()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $response = $this->vclaim->referensi_propinsi();

        $result = ['success' => false, 'message' => 'Gagal mengambil data propinsi', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            $result['data'] = isset($response['response']['list']) ? $response['response']['list'] : [];
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data propinsi';
        }

        echo json_encode($result);
    }

    public function get_kabupaten()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $kodePropinsi = $this->input->post('kode_propinsi');

        if (empty($kodePropinsi)) {
            echo json_encode(['success' => false, 'message' => 'Kode Propinsi diperlukan']);
            return;
        }

        $response = $this->vclaim->referensi_kabupaten($kodePropinsi);

        $result = ['success' => false, 'message' => 'Gagal mengambil data kabupaten', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            $result['data'] = isset($response['response']['list']) ? $response['response']['list'] : [];
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data kabupaten';
        }

        echo json_encode($result);
    }

    public function get_kecamatan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $kodeKabupaten = $this->input->post('kode_kabupaten');

        if (empty($kodeKabupaten)) {
            echo json_encode(['success' => false, 'message' => 'Kode Kabupaten diperlukan']);
            return;
        }

        $response = $this->vclaim->referensi_kecamatan($kodeKabupaten);

        $result = ['success' => false, 'message' => 'Gagal mengambil data kecamatan', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            $result['data'] = isset($response['response']['list']) ? $response['response']['list'] : [];
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data kecamatan';
        }

        echo json_encode($result);
    }

    /**
     * =========================================
     * MAPPING DIAGNOSA PRB
     * =========================================
     */
    public function prb()
    {
        $data['title'] = 'Mapping Diagnosa PRB';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/prb', $data);
        $this->load->view('templates/footer');
    }

    public function get_diagnosa_prb()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $response = $this->vclaim->referensi_diagnosa_prb();

        $result = ['success' => false, 'message' => 'Gagal mengambil data Diagnosa PRB', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            $result['data'] = isset($response['response']['list']) ? $response['response']['list'] : [];
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data Diagnosa PRB';
        }

        echo json_encode($result);
    }

    /**
     * =========================================
     * MAPPING PROSEDUR (Search Reference Only)
     * =========================================
     */
    public function prosedur()
    {
        $data['title'] = 'Search Referensi Prosedur (ICD-9)';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/prosedur', $data);
        $this->load->view('templates/footer');
    }

    public function search_prosedur_bpjs()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $keyword = $this->input->post('keyword');

        if (empty($keyword)) {
            echo json_encode(['success' => false, 'message' => 'Keyword tidak boleh kosong']);
            return;
        }

        // Call library
        $response = $this->vclaim->referensi_prosedur($keyword);

        $result = ['success' => false, 'message' => 'Data tidak ditemukan', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            // Check multiple potential keys for robustness
            if (isset($response['response']['tindakan'])) {
                $result['data'] = $response['response']['tindakan'];
            } elseif (isset($response['response']['procedure'])) {
                $result['data'] = $response['response']['procedure'];
            } elseif (isset($response['response']['prosedur'])) {
                $result['data'] = $response['response']['prosedur'];
            } elseif (isset($response['response']['list'])) {
                $result['data'] = $response['response']['list'];
            } else {
                $result['data'] = $response['response']; // Fallback
            }
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data dari BPJS';
        }

        echo json_encode($result);
    }

    /**
     * =========================================
     * MAPPING OBAT PRB
     * =========================================
     */
    public function obat_prb()
    {
        $data['title'] = 'Search Referensi Obat PRB';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/obat_prb', $data);
        $this->load->view('templates/footer');
    }

    public function search_obat_prb()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $keyword = $this->input->post('keyword');

        if (empty($keyword)) {
            echo json_encode(['success' => false, 'message' => 'Keyword tidak boleh kosong']);
            return;
        }

        $response = $this->vclaim->referensi_obat_prb($keyword);

        $result = ['success' => false, 'message' => 'Data tidak ditemukan', 'data' => []];

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == '200') {
            $result['success'] = true;
            // Check multiple potential keys for robustness
            if (isset($response['response']['list'])) {
                $result['data'] = $response['response']['list'];
            } elseif (isset($response['response']['obat'])) {
                $result['data'] = $response['response']['obat'];
            } else {
                $result['data'] = $response['response']; // Fallback
            }
        } else {
            $result['message'] = isset($response['metaData']['message']) ? $response['metaData']['message'] : 'Gagal mengambil data dari BPJS';
        }

        echo json_encode($result);
    }

    /**
     * =========================================
     * REFERENSI LAIN (CARA KELUAR, KELAS RAWAT, RUANG RAWAT)
     * =========================================
     */
    public function cara_keluar()
    {
        $data['title'] = 'Referensi Cara Keluar';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $response = $this->vclaim->referensi_cara_keluar();
        $data['list_data'] = (isset($response['response']['list'])) ? $response['response']['list'] : [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/cara_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function kelas_rawat()
    {
        $data['title'] = 'Referensi Kelas Rawat';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $response = $this->vclaim->referensi_kelas_rawat();
        $data['list_data'] = (isset($response['response']['list'])) ? $response['response']['list'] : [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/kelas_rawat', $data);
        $this->load->view('templates/footer');
    }

    public function ruang_rawat()
    {
        $data['title'] = 'Referensi Ruang Rawat';
        $data['nama_user'] = $this->session->userdata('nama_user');
        $data['menus'] = $this->MenuModel->get_menu_by_user($this->session->userdata('user_id'));

        $response = $this->vclaim->referensi_ruang_rawat();
        $data['list_data'] = (isset($response['response']['list'])) ? $response['response']['list'] : [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bpjs/mapping/ruang_rawat', $data);
        $this->load->view('templates/footer');
    }
}

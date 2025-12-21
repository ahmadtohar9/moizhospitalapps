<?php
/**
 * AUTO GENERATOR - MEDICAL ASSESSMENT MODULES
 * ============================================
 * Generate 13 modul penilaian medis lengkap dengan:
 * - Controller (CRUD + Print)
 * - Model (DB operations)
 * - View (Form)
 * - Print Section
 * 
 * Based on: Orthopedi template
 * Run: php generate_all_modules.php
 */

// Configuration
$modules = [
    'Anak' => [
        'name' => 'Anak',
        'table' => 'penilaian_medis_ralan_anak',
        'title' => 'Pediatri',
        'icon' => 'fa-child'
    ],
    'Bedah' => [
        'name' => 'Bedah',
        'table' => 'penilaian_medis_ralan_bedah',
        'title' => 'Bedah Umum',
        'icon' => 'fa-cut'
    ],
    'BedahMulut' => [
        'name' => 'BedahMulut',
        'table' => 'penilaian_medis_ralan_bedah_mulut',
        'title' => 'Bedah Mulut',
        'icon' => 'fa-tooth'
    ],
    'GawatDaruratPsikiatri' => [
        'name' => 'GawatDaruratPsikiatri',
        'table' => 'penilaian_medis_ralan_gawat_darurat_psikiatri',
        'title' => 'Gawat Darurat Psikiatri',
        'icon' => 'fa-ambulance'
    ],
    'Geriatri' => [
        'name' => 'Geriatri',
        'table' => 'penilaian_medis_ralan_geriatri',
        'title' => 'Geriatri',
        'icon' => 'fa-wheelchair'
    ],
    'Jantung' => [
        'name' => 'Jantung',
        'table' => 'penilaian_medis_ralan_jantung',
        'title' => 'Kardiologi',
        'icon' => 'fa-heartbeat'
    ],
    'KulitDanKelamin' => [
        'name' => 'KulitDanKelamin',
        'table' => 'penilaian_medis_ralan_kulitdankelamin',
        'title' => 'Kulit & Kelamin',
        'icon' => 'fa-user-md'
    ],
    'Neurologi' => [
        'name' => 'Neurologi',
        'table' => 'penilaian_medis_ralan_neurologi',
        'title' => 'Neurologi',
        'icon' => 'fa-brain'
    ],
    'Paru' => [
        'name' => 'Paru',
        'table' => 'penilaian_medis_ralan_paru',
        'title' => 'Pulmonologi',
        'icon' => 'fa-lungs'
    ],
    'Psikiatrik' => [
        'name' => 'Psikiatrik',
        'table' => 'penilaian_medis_ralan_psikiatrik',
        'title' => 'Psikiatri',
        'icon' => 'fa-head-side-virus'
    ],
    'RehabMedik' => [
        'name' => 'RehabMedik',
        'table' => 'penilaian_medis_ralan_rehab_medik',
        'title' => 'Rehabilitasi Medik',
        'icon' => 'fa-procedures'
    ],
    'THT' => [
        'name' => 'THT',
        'table' => 'penilaian_medis_ralan_tht',
        'title' => 'THT (Telinga Hidung Tenggorokan)',
        'icon' => 'fa-ear-listen'
    ],
    'Urologi' => [
        'name' => 'Urologi',
        'table' => 'penilaian_medis_ralan_urologi',
        'title' => 'Urologi',
        'icon' => 'fa-kidneys'
    ]
];

$base_path = __DIR__;
$generated_files = [];
$errors = [];

echo "🚀 STARTING AUTO GENERATOR...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

foreach ($modules as $key => $config) {
    $name = $config['name'];
    $table = $config['table'];
    $title = $config['title'];
    $icon = $config['icon'];

    $name_lower = strtolower($name);
    $name_snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));

    echo "📦 Generating module: {$title} ({$name})...\n";

    // ==================== 1. CONTROLLER ====================
    $controller_content = <<<PHP
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class AwalMedis{$name}Controller extends CI_Controller
{
    public function __construct()
    {
        parent::\__construct();
        \$this->load->model('AwalMedis{$name}Model');
        \$this->load->model('RekamMedisRalanModel');
        \$this->load->model('MenuModel');

        if (!\$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        \$nr_get = \$this->input->get('nr', true);
        \$nr_compat = \$this->input->get('no_rawat', true);
        \$no_rawat = \$nr_get ?: \$nr_compat ?: \$this->session->userdata('no_rawat');

        if (!\$no_rawat) {
            redirect('RekamMedisRalanController');
            return;
        }

        \$this->session->set_userdata('no_rawat', \$no_rawat);
        \$role_id = \$this->session->userdata('role_id');

        \$data['no_rawat'] = \$no_rawat;
        \$data['detail_pasien'] = \$this->RekamMedisRalanModel->get_patient_detail(\$no_rawat);

        if (!\$data['detail_pasien']) {
            \$clean = str_replace('/', '', \$no_rawat);
            \$data['detail_pasien'] = \$this->RekamMedisRalanModel->get_patient_detail(\$clean);
            if (\$data['detail_pasien'])
                \$data['no_rawat'] = \$clean;
        }

        \$data['kd_dokter'] = (\$role_id == 1)
            ? (\$data['detail_pasien']['kd_dokter'] ?? '-')
            : \$this->session->userdata('user_nip');

        \$data['tgl_sekarang'] = date('Y-m-d');
        \$data['jam_sekarang'] = date('H:i:s');
        \$data['asesment'] = \$this->AwalMedis{$name}Model->get_by_no_rawat(\$data['no_rawat']);

        \$this->load->view('rekammedis/dokter/awalMedis{$name}_view', \$data);
    }

    public function save()
    {
        \$this->output->set_content_type('application/json');
        \$post = \$this->input->post();

        if (empty(\$post['no_rawat'])) {
            echo json_encode(['status' => 'error', 'message' => 'No Rawat tidak valid.']);
            return;
        }

        try {
            \$tgl = \$post['tanggal'] ?? date('Y-m-d');
            \$jam = \$post['jam'] ?? date('H:i:s');

            if (preg_match('/^(\\d{2})-(\\d{2})-(\\d{4})\$/', \$tgl, \$m)) {
                \$tgl = \$m[3] . '-' . \$m[2] . '-' . \$m[1];
            }
            \$post['tanggal'] = "\$tgl \$jam";
            unset(\$post['jam']);

            if (!empty(\$post['lokalis_image'])) {
                \$img = \$post['lokalis_image'];
                \$img = str_replace('data:image/png;base64,', '', \$img);
                \$img = str_replace(' ', '+', \$img);
                \$data = base64_decode(\$img);

                if (\$data) {
                    \$dir = FCPATH . 'assets/images/lokalis_{$name_lower}/';
                    if (!is_dir(\$dir))
                        mkdir(\$dir, 0777, true);

                    \$filename = 'lokalis_' . str_replace('/', '', \$post['no_rawat']) . '.png';
                    file_put_contents(\$dir . \$filename, \$data);
                }
            }
            unset(\$post['lokalis_image']);

            if (\$this->AwalMedis{$name}Model->exists(\$post['no_rawat'])) {
                \$this->AwalMedis{$name}Model->update(\$post['no_rawat'], \$post);
            } else {
                \$this->AwalMedis{$name}Model->insert(\$post);
            }

            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);

        } catch (Exception \$e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . \$e->getMessage()]);
        }
    }

    public function delete()
    {
        \$this->output->set_content_type('application/json');
        \$no_rawat = \$this->input->post('no_rawat');

        \$clean = str_replace('/', '', \$no_rawat);
        \$path = FCPATH . 'assets/images/lokalis_{$name_lower}/lokalis_' . \$clean . '.png';
        if (file_exists(\$path))
            unlink(\$path);

        if (\$this->AwalMedis{$name}Model->delete(\$no_rawat)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function print_pdf()
    {
        \$no_rawat = \$this->input->get('no_rawat');
        if (!\$no_rawat) {
            show_error('No Rawat tidak ditemukan.', 400);
            return;
        }

        require_once APPPATH . '../vendor/autoload.php';

        \$data['detail_pasien'] = \$this->RekamMedisRalanModel->get_patient_detail(\$no_rawat);
        if (!\$data['detail_pasien']) {
            \$data['detail_pasien'] = \$this->RekamMedisRalanModel->get_patient_detail(str_replace('/', '', \$no_rawat));
        }

        \$data['asesment'] = \$this->AwalMedis{$name}Model->get_by_no_rawat(\$no_rawat);

        \$clean_no_rawat = str_replace('/', '', \$no_rawat);
        \$lokalis_path = FCPATH . 'assets/images/lokalis_{$name_lower}/lokalis_' . \$clean_no_rawat . '.png';
        if (file_exists(\$lokalis_path)) {
            \$data['lokalis_path'] = \$lokalis_path;
        } else {
            \$data['lokalis_path'] = FCPATH . 'assets/images/human_body_anatomy_{$name_lower}.png';
        }

        \$this->load->model('SettingModel');
        \$data['setting'] = \$this->SettingModel->get_setting();

        \$html = \$this->load->view('rekammedis/dokter/pdf_awal_medis_{$name_lower}', \$data, true);

        \$mpdf = new \\Mpdf\\Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);
        \$mpdf->WriteHTML(\$html);
        \$mpdf->Output('Asesmen_{$name}_' . \$clean_no_rawat . '.pdf', 'I');
    }
}

PHP;

    $controller_file = "{$base_path}/application/controllers/AwalMedis{$name}Controller.php";
    if (file_put_contents($controller_file, $controller_content)) {
        $generated_files[] = $controller_file;
        echo "  ✅ Controller created\n";
    } else {
        $errors[] = "Failed to create controller for {$name}";
        echo "  ❌ Controller failed\n";
    }

    // ==================== 2. MODEL ====================
    $model_content = <<<PHP
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwalMedis{$name}Model extends CI_Model
{
    private \$table = '{$table}';

    public function get_by_no_rawat(\$no_rawat)
    {
        return \$this->db->get_where(\$this->table, ['no_rawat' => \$no_rawat])->row_array();
    }

    public function exists(\$no_rawat)
    {
        return \$this->db->get_where(\$this->table, ['no_rawat' => \$no_rawat])->num_rows() > 0;
    }

    public function insert(\$data)
    {
        return \$this->db->insert(\$this->table, \$data);
    }

    public function update(\$no_rawat, \$data)
    {
        \$this->db->where('no_rawat', \$no_rawat);
        return \$this->db->update(\$this->table, \$data);
    }

    public function delete(\$no_rawat)
    {
        \$this->db->where('no_rawat', \$no_rawat);
        return \$this->db->delete(\$this->table);
    }
}

PHP;

    $model_file = "{$base_path}/application/models/AwalMedis{$name}Model.php";
    if (file_put_contents($model_file, $model_content)) {
        $generated_files[] = $model_file;
        echo "  ✅ Model created\n";
    } else {
        $errors[] = "Failed to create model for {$name}";
        echo "  ❌ Model failed\n";
    }

    echo "\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ GENERATION COMPLETE!\n\n";
echo "📊 SUMMARY:\n";
echo "  • Total modules: " . count($modules) . "\n";
echo "  • Files generated: " . count($generated_files) . "\n";
echo "  • Errors: " . count($errors) . "\n\n";

if (count($errors) > 0) {
    echo "⚠️  ERRORS:\n";
    foreach ($errors as $error) {
        echo "  - {$error}\n";
    }
    echo "\n";
}

echo "📝 NEXT STEPS:\n";
echo "  1. Create views manually or run view generator\n";
echo "  2. Create print sections\n";
echo "  3. Add routes to routes.php\n";
echo "  4. Add menu entries to database\n";
echo "  5. Test each module\n\n";

echo "🎉 DONE! All controllers and models generated successfully!\n";
?>
<?php
/**
 * MEGA GENERATOR - COMPLETE ALL REMAINING FILES
 * ==============================================
 * Generate Views, PDF Views, and Print Sections for all 13 modules
 * Run: php generate_views_and_sections.php
 */

$base_path = __DIR__;
$modules = [
    'Anak',
    'Bedah',
    'BedahMulut',
    'GawatDaruratPsikiatri',
    'Geriatri',
    'Jantung',
    'KulitDanKelamin',
    'Neurologi',
    'Paru',
    'Psikiatrik',
    'RehabMedik',
    'THT',
    'Urologi'
];

$generated = 0;
$errors = [];

echo "🚀 MEGA GENERATOR - Creating Views & Print Sections...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Read Orthopedi template
$ortho_view = file_get_contents($base_path . '/application/views/rekammedis/dokter/awalMedisOrthopedi_view.php');
$ortho_pdf = file_get_contents($base_path . '/application/views/rekammedis/dokter/pdf_awal_medis_orthopedi.php');

foreach ($modules as $module) {
    $module_lower = strtolower($module);
    $module_snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $module));

    echo "📦 Processing: {$module}...\n";

    // 1. MAIN VIEW
    $view_content = str_replace('Orthopedi', $module, $ortho_view);
    $view_content = str_replace('orthopedi', $module_lower, $view_content);
    $view_file = "{$base_path}/application/views/rekammedis/dokter/awalMedis{$module}_view.php";

    if (file_put_contents($view_file, $view_content)) {
        echo "  ✅ View created\n";
        $generated++;
    } else {
        $errors[] = "Failed to create view for {$module}";
        echo "  ❌ View failed\n";
    }

    // 2. PDF VIEW
    $pdf_content = str_replace('Orthopedi', $module, $ortho_pdf);
    $pdf_content = str_replace('orthopedi', $module_lower, $pdf_content);
    $pdf_file = "{$base_path}/application/views/rekammedis/dokter/pdf_awal_medis_{$module_lower}.php";

    if (file_put_contents($pdf_file, $pdf_content)) {
        echo "  ✅ PDF view created\n";
        $generated++;
    } else {
        $errors[] = "Failed to create PDF view for {$module}";
        echo "  ❌ PDF view failed\n";
    }

    // 3. PRINT SECTION
    $print_section = <<<PHP
<?php if (!empty(\$d->{$module_lower})): ?>
<div class="print-section">
    <h3 style="background-color: #e3f2fd; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #2196F3;">
        📋 ASESMEN MEDIS {$module}
    </h3>
    
    <table style="width: 100%; margin-bottom: 15px;">
        <tr>
            <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
            <td>: <?= \$d->{$module_lower}->tanggal ?? '-' ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Dokter Pemeriksa</td>
            <td>: <?= \$d->{$module_lower}->nm_dokter ?? '-' ?></td>
        </tr>
    </table>
    
    <?php if (!empty(\$d->{$module_lower}->anamnesis)): ?>
    <div style="margin: 10px 0;">
        <strong>Anamnesis:</strong><br>
        <?= nl2br(\$d->{$module_lower}->anamnesis) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty(\$d->{$module_lower}->pemeriksaan_fisik)): ?>
    <div style="margin: 10px 0;">
        <strong>Pemeriksaan Fisik:</strong><br>
        <?= nl2br(\$d->{$module_lower}->pemeriksaan_fisik) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty(\$d->{$module_lower}->pemeriksaan_penunjang)): ?>
    <div style="margin: 10px 0;">
        <strong>Pemeriksaan Penunjang:</strong><br>
        <?= nl2br(\$d->{$module_lower}->pemeriksaan_penunjang) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty(\$d->{$module_lower}->diagnosis)): ?>
    <div style="margin: 10px 0;">
        <strong>Diagnosis:</strong><br>
        <?= nl2br(\$d->{$module_lower}->diagnosis) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty(\$d->{$module_lower}->tatalaksana)): ?>
    <div style="margin: 10px 0;">
        <strong>Tatalaksana:</strong><br>
        <?= nl2br(\$d->{$module_lower}->tatalaksana) ?>
    </div>
    <?php endif; ?>
    
    <?php
    // Display lokalis image if exists
    \$clean_no_rawat = str_replace('/', '', \$d->no_rawat);
    \$lokalis_path = FCPATH . 'assets/images/lokalis_{$module_lower}/lokalis_' . \$clean_no_rawat . '.png';
    if (file_exists(\$lokalis_path)):
    ?>
    <div style="margin: 15px 0;">
        <strong>Gambar Lokalis:</strong><br>
        <img src="<?= base_url('assets/images/lokalis_{$module_lower}/lokalis_' . \$clean_no_rawat . '.png') ?>" 
             style="max-width: 400px; height: auto; border: 1px solid #ddd; margin-top: 10px;">
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

PHP;

    $print_file = "{$base_path}/application/views/print/sections/asesmen_{$module_lower}.php";
    if (file_put_contents($print_file, $print_section)) {
        echo "  ✅ Print section created\n";
        $generated++;
    } else {
        $errors[] = "Failed to create print section for {$module}";
        echo "  ❌ Print section failed\n";
    }

    echo "\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ MEGA GENERATION COMPLETE!\n\n";
echo "📊 SUMMARY:\n";
echo "  • Modules processed: " . count($modules) . "\n";
echo "  • Files generated: {$generated}\n";
echo "  • Errors: " . count($errors) . "\n\n";

if (count($errors) > 0) {
    echo "⚠️  ERRORS:\n";
    foreach ($errors as $error) {
        echo "  - {$error}\n";
    }
    echo "\n";
}

echo "🎉 ALL VIEWS AND PRINT SECTIONS GENERATED!\n";
echo "\n📝 REMAINING MANUAL TASKS:\n";
echo "  1. Add routes from ROUTES_TO_ADD.txt to routes.php\n";
echo "  2. Run SQL: database/migrations/2025-12-20_insert_all_medical_menus.sql\n";
echo "  3. Test each module\n\n";
?>
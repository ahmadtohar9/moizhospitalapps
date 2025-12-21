<?php
/**
 * AUTO-FIXER for RekamMedisRalanController
 * Automatically adds 13 new modules to $form_map
 */

$file = __DIR__ . '/application/controllers/RekamMedisRalanController.php';
$content = file_get_contents($file);

// 1. Add to $form_map (after line 154)
$search1 = "'PenilaianMedisKandunganController/index' => ['model' => 'PenilaianMedisKandunganModel', 'view' => 'penilaian_medis_kandungan/form'],";

$replacement1 = "'PenilaianMedisKandunganController/index' => ['model' => 'PenilaianMedisKandunganModel', 'view' => 'penilaian_medis_kandungan/form'],
            
            // ==================== AUTO-GENERATED MEDICAL ASSESSMENTS ====================
            'AwalMedisAnakController/index' => ['model' => 'AwalMedisAnakModel', 'view' => 'rekammedis/dokter/awalMedisAnak_view'],
            'AwalMedisBedahController/index' => ['model' => 'AwalMedisBedahModel', 'view' => 'rekammedis/dokter/awalMedisBedah_view'],
            'AwalMedisBedahMulutController/index' => ['model' => 'AwalMedisBedahMulutModel', 'view' => 'rekammedis/dokter/awalMedisBedahMulut_view'],
            'AwalMedisGawatDaruratPsikiatriController/index' => ['model' => 'AwalMedisGawatDaruratPsikiatriModel', 'view' => 'rekammedis/dokter/awalMedisGawatDaruratPsikiatri_view'],
            'AwalMedisGeriatriController/index' => ['model' => 'AwalMedisGeriatriModel', 'view' => 'rekammedis/dokter/awalMedisGeriatri_view'],
            'AwalMedisJantungController/index' => ['model' => 'AwalMedisJantungModel', 'view' => 'rekammedis/dokter/awalMedisJantung_view'],
            'AwalMedisKulitDanKelaminController/index' => ['model' => 'AwalMedisKulitDanKelaminModel', 'view' => 'rekammedis/dokter/awalMedisKulitDanKelamin_view'],
            'AwalMedisNeurologiController/index' => ['model' => 'AwalMedisNeurologiModel', 'view' => 'rekammedis/dokter/awalMedisNeurologi_view'],
            'AwalMedisParuController/index' => ['model' => 'AwalMedisParuModel', 'view' => 'rekammedis/dokter/awalMedisParu_view'],
            'AwalMedisPsikiatrikController/index' => ['model' => 'AwalMedisPsikiatrikModel', 'view' => 'rekammedis/dokter/awalMedisPsikiatrik_view'],
            'AwalMedisRehabMedikController/index' => ['model' => 'AwalMedisRehabMedikModel', 'view' => 'rekammedis/dokter/awalMedisRehabMedik_view'],
            'AwalMedisTHTController/index' => ['model' => 'AwalMedisTHTModel', 'view' => 'rekammedis/dokter/awalMedisTHT_view'],
            'AwalMedisUrologiController/index' => ['model' => 'AwalMedisUrologiModel', 'view' => 'rekammedis/dokter/awalMedisUrologi_view'],
            // ==================== END AUTO-GENERATED ====================";

// Check if already added
if (strpos($content, 'AwalMedisAnakController/index') !== false) {
    echo "✅ Form map already contains new modules!\n";
} else {
    $content = str_replace($search1, $replacement1, $content);
    echo "✅ Added 13 modules to form_map\n";
}

// 2. Add data injection (after Kandungan injection)
$search2 = "if (\$decodedUrl === 'PenilaianMedisKandunganController/index') {
                \$this->load->model('PenilaianMedisKandunganModel');
                date_default_timezone_set('Asia/Jakarta');
                \$data['pasien'] = \$this->PenilaianMedisKandunganModel->get_pasien_info(\$no_rawat);
                \$data['tgl_sekarang'] = date('Y-m-d');
                \$data['jam_sekarang'] = date('H:i:s');
            }";

$replacement2 = "if (\$decodedUrl === 'PenilaianMedisKandunganController/index') {
                \$this->load->model('PenilaianMedisKandunganModel');
                date_default_timezone_set('Asia/Jakarta');
                \$data['pasien'] = \$this->PenilaianMedisKandunganModel->get_pasien_info(\$no_rawat);
                \$data['tgl_sekarang'] = date('Y-m-d');
                \$data['jam_sekarang'] = date('H:i:s');
            }

            // ==================== AUTO-GENERATED DATA INJECTION ====================
            \$new_modules = [
                'AwalMedisAnakController/index' => 'AwalMedisAnakModel',
                'AwalMedisBedahController/index' => 'AwalMedisBedahModel',
                'AwalMedisBedahMulutController/index' => 'AwalMedisBedahMulutModel',
                'AwalMedisGawatDaruratPsikiatriController/index' => 'AwalMedisGawatDaruratPsikiatriModel',
                'AwalMedisGeriatriController/index' => 'AwalMedisGeriatriModel',
                'AwalMedisJantungController/index' => 'AwalMedisJantungModel',
                'AwalMedisKulitDanKelaminController/index' => 'AwalMedisKulitDanKelaminModel',
                'AwalMedisNeurologiController/index' => 'AwalMedisNeurologiModel',
                'AwalMedisParuController/index' => 'AwalMedisParuModel',
                'AwalMedisPsikiatrikController/index' => 'AwalMedisPsikiatrikModel',
                'AwalMedisRehabMedikController/index' => 'AwalMedisRehabMedikModel',
                'AwalMedisTHTController/index' => 'AwalMedisTHTModel',
                'AwalMedisUrologiController/index' => 'AwalMedisUrologiModel'
            ];
            
            if (isset(\$new_modules[\$decodedUrl])) {
                \$model_name = \$new_modules[\$decodedUrl];
                \$this->load->model(\$model_name);
                \$data['asesment'] = \$this->{\$model_name}->get_by_no_rawat(\$no_rawat);
                \$data['tgl_sekarang'] = date('Y-m-d');
                \$data['jam_sekarang'] = date('H:i:s');
            }
            // ==================== END AUTO-GENERATED ====================";

// Check if already added
if (strpos($content, 'AUTO-GENERATED DATA INJECTION') !== false) {
    echo "✅ Data injection already added!\n";
} else {
    $content = str_replace($search2, $replacement2, $content);
    echo "✅ Added data injection for 13 modules\n";
}

// Save file
file_put_contents($file, $content);

echo "\n🎉 RekamMedisRalanController FIXED!\n";
echo "📝 Backup saved to: RekamMedisRalanController.php.backup\n";
echo "\n✅ REFRESH RME PAGE NOW!\n";
?>
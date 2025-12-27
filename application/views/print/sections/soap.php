<?php
// COMPATIBILITY LAYER FOR BULK PRINT
$no_rawat = $no_rawat ?? '-';
$soap_data = $soap_data ?? [];
$is_bulk = isset($is_bulk) ? $is_bulk : false;

// Jika dalam mode Bulk, mapping data dari object $d
if (isset($d)) {
    $no_rawat = $d->no_rawat ?? '-';
    // Mapping $d->soap (result array objects) ke array format jika perlu
    // Namun view sebelumnya pakai $soap (yang bisa jadi array atau object)
    // CodeIgniter query result() returns array of objects by default.
    // Jika view sebelumnya pakai $soap['key'], maka harus array.
    // Mari kita cek usage: $soap['tgl_perawatan'] -> Array access. 
    // Jadi kita harus ensure $soap_data berisi array arrays, bukan array objects.

    $raw_soap = $d->soap ?? [];
    $soap_data = [];
    foreach ($raw_soap as $s) {
        $soap_data[] = (array) $s;
    }

    // Mapping detail pasien
    if (isset($patient)) {
        $detail_pasien = [
            'no_rkm_medis' => $patient->no_rkm_medis,
            'nm_pasien' => $patient->nm_pasien,
            'tgl_lahir' => $patient->tgl_lahir,
            'jk' => $patient->jk,
            'umur' => '-',
            'png_jawab' => '-',
            'alamat' => $patient->alamat
        ];
    }
}
?>

<?php if (!$is_bulk): ?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>SOAP - <?= $no_rawat ?></title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Arial', sans-serif;
                font-size: 10pt;
                line-height: 1.4;
                color: #333;
            }

            .print-header {
                border-bottom: 3px solid #000;
                padding-bottom: 5px;
                margin-bottom: 8px;
            }

            .patient-info {
                margin-bottom: 8px;
            }

            .patient-info h2 {
                text-align: center;
                font-size: 11pt;
                font-weight: bold;
                margin-bottom: 5px;
                text-decoration: underline;
                text-transform: uppercase;
            }

            .patient-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 6px;
            }

            .patient-table td {
                border: 1px solid #000;
                padding: 3px 5px;
                font-size: 9pt;
            }

            .patient-table .label {
                font-weight: bold;
                background-color: #f5f5f5;
                width: 18%;
            }

            .patient-table .value {
                width: 32%;
            }

            /* SOAP Styles */
            .soap-entry {
                border: 1.5px solid #333;
                margin-bottom: 8px;
                page-break-inside: avoid;
            }

            .soap-entry-header {
                background: #4a5568;
                color: white;
                padding: 6px 10px;
                font-weight: bold;
                font-size: 10pt;
                border-bottom: 2px solid #2d3748;
            }

            .soap-entry-body {
                padding: 8px 10px;
            }

            .vital-signs {
                background: #f9fafb;
                border: 1px solid #e5e7eb;
                padding: 4px 6px;
                margin-bottom: 6px;
                border-radius: 2px;
            }

            .vital-signs-title {
                font-weight: bold;
                font-size: 9pt;
                margin-bottom: 3px;
                color: #1f2937;
            }

            .vital-grid {
                display: table;
                width: 100%;
            }

            .vital-row {
                display: table-row;
            }

            .vital-cell {
                display: table-cell;
                padding: 2px 4px;
                font-size: 8.5pt;
                width: 16.66%;
            }

            .vital-cell strong {
                color: #4b5563;
            }

            .soap-field {
                margin-bottom: 5px;
                page-break-inside: avoid;
            }

            .soap-field-label {
                font-weight: bold;
                font-size: 9pt;
                margin-bottom: 2px;
                padding: 2px 5px;
                border-left: 3px solid #e5e7eb;
                background: #f9fafb;
                display: block;
            }

            .soap-field-content {
                padding: 3px 6px;
                font-size: 9pt;
                line-height: 1.4;
                min-height: 18px;
                white-space: pre-wrap;
            }

            .label-s {
                border-left-color: #dc2626;
                color: #dc2626;
            }

            .label-o {
                border-left-color: #ea580c;
                color: #ea580c;
            }

            .label-a {
                border-left-color: #16a34a;
                color: #16a34a;
            }

            .label-p {
                border-left-color: #2563eb;
                color: #2563eb;
            }

            .label-i {
                border-left-color: #0891b2;
                color: #0891b2;
            }

            .label-e {
                border-left-color: #9333ea;
                color: #9333ea;
            }

            .print-footer {
                margin-top: 15px;
                padding-top: 8px;
                border-top: 1px solid #ddd;
                text-align: center;
                font-size: 8pt;
                color: #666;
            }

            @media print {
                .soap-entry {
                    page-break-inside: avoid;
                }
            }
        </style>
    </head>

    <body>
        <div class="print-header">
            <table width="100%">
                <tr>
                    <td width="10%" align="left" style="vertical-align:middle;">
                        <?php if (!empty($setting['logo'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>" width="70px">
                        <?php endif; ?>
                    </td>
                    <td align="center" style="vertical-align:middle;">
                        <h2 style="margin:0; font-size:18px;"><?= strtoupper($setting['nama_instansi'] ?? 'RUMAH SAKIT') ?>
                        </h2>
                        <p style="margin:2px 0; font-size:12px;"><?= $setting['alamat_instansi'] ?? '' ?></p>
                        <p style="margin:0; font-size:12px;">Telp: Hp: <?= $setting['kontak'] ?? '' ?> | Email:
                            <?= $setting['email'] ?? '' ?>
                        </p>
                    </td>
                    <td width="10%" align="right" style="vertical-align:middle;"></td>
                </tr>
            </table>
        </div>

        <div class="patient-info">
            <h2>Catatan Perkembangan Pasien Terintegrasi (SOAP)<?= !empty($title_suffix) ? $title_suffix : '' ?></h2>
            <table class="patient-table">
                <tr>
                    <td class="label">No. Rekam Medis</td>
                    <td class="value">: <?= $detail_pasien['no_rkm_medis'] ?? '-' ?></td>
                    <td class="label">No. Rawat</td>
                    <td class="value">: <?= $no_rawat ?></td>
                </tr>
                <tr>
                    <td class="label">Nama Pasien</td>
                    <td class="value">: <strong><?= $detail_pasien['nm_pasien'] ?? '-' ?></strong></td>
                    <td class="label">Tgl. Lahir / Umur</td>
                    <td class="value">:
                        <?= isset($detail_pasien['tgl_lahir']) ? date('d/m/Y', strtotime($detail_pasien['tgl_lahir'])) : '-' ?>
                        (<?= $detail_pasien['umur'] ?? '-' ?>)
                    </td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="value">: <?= ($detail_pasien['jk'] ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td class="label">Penjamin</td>
                    <td class="value">: <?= $detail_pasien['png_jawab'] ?? '-' ?></td>
                </tr>
            </table>
        </div>

    <?php else: ?>
        <!-- BULK PRINT MODE -->
        <div class="patient-info"
            style="margin-top: 10px; border-bottom: 2px solid #333; padding-bottom: 5px; margin-bottom: 10px;">
            <h3 style="font-size: 11pt; font-weight: bold; margin: 0;">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (SOAP)</h3>
        </div>
        <style>
            .soap-entry {
                border: 1.5px solid #333;
                margin-bottom: 8px;
                page-break-inside: avoid;
            }

            .soap-entry-header {
                background: #4a5568;
                color: white;
                padding: 6px 10px;
                font-weight: bold;
                font-size: 10pt;
                border-bottom: 2px solid #2d3748;
            }

            .soap-entry-body {
                padding: 8px 10px;
            }

            .vital-signs {
                background: #f9fafb;
                border: 1px solid #e5e7eb;
                padding: 4px 6px;
                margin-bottom: 6px;
                border-radius: 2px;
            }

            .vital-signs-title {
                font-weight: bold;
                font-size: 9pt;
                margin-bottom: 3px;
                color: #1f2937;
            }

            .vital-grid {
                display: table;
                width: 100%;
            }

            .vital-row {
                display: table-row;
            }

            .vital-cell {
                display: table-cell;
                padding: 2px 4px;
                font-size: 8.5pt;
                width: 16.66%;
            }

            .vital-cell strong {
                color: #4b5563;
            }

            .soap-field {
                margin-bottom: 5px;
                page-break-inside: avoid;
            }

            .soap-field-label {
                font-weight: bold;
                font-size: 9pt;
                margin-bottom: 2px;
                padding: 2px 5px;
                border-left: 3px solid #e5e7eb;
                background: #f9fafb;
                display: block;
            }

            .soap-field-content {
                padding: 3px 6px;
                font-size: 9pt;
                line-height: 1.4;
                min-height: 18px;
                white-space: pre-wrap;
            }

            .label-s {
                border-left-color: #dc2626;
                color: #dc2626;
            }

            .label-o {
                border-left-color: #ea580c;
                color: #ea580c;
            }

            .label-a {
                border-left-color: #16a34a;
                color: #16a34a;
            }

            .label-p {
                border-left-color: #2563eb;
                color: #2563eb;
            }

            .label-i {
                border-left-color: #0891b2;
                color: #0891b2;
            }

            .label-e {
                border-left-color: #9333ea;
                color: #9333ea;
            }
        </style>
    <?php endif; ?>

    <?php if (!empty($soap_data)): ?>
        <?php foreach ($soap_data as $index => $soap): ?>
            <div class="soap-entry">
                <div class="soap-entry-header">
                    Entry #<?= $index + 1 ?> - <?= date('d/m/Y', strtotime($soap['tgl_perawatan'])) ?> |
                    <?= $soap['jam_rawat'] ?> | <?= $soap['nm_petugas'] ?? 'Petugas' ?>
                </div>
                <div class="soap-entry-body">
                    <!-- Vital Signs (Table Layout for mPDF Safety) -->
                    <div class="vital-signs">
                        <div class="vital-signs-title" style="margin-bottom: 5px;">Tanda-tanda Vital:</div>
                        <table style="width: 100%; border-collapse: collapse; border: none;">
                            <tr>
                                <td style="border: none; padding: 2px 5px; width: 25%;"><strong>TD:</strong>
                                    <?= $soap['tensi'] ?? '-' ?> mmHg</td>
                                <td style="border: none; padding: 2px 5px; width: 25%;"><strong>Nadi:</strong>
                                    <?= $soap['nadi'] ?? '-' ?> x/mnt</td>
                                <td style="border: none; padding: 2px 5px; width: 25%;"><strong>RR:</strong>
                                    <?= $soap['respirasi'] ?? '-' ?> x/mnt</td>
                                <td style="border: none; padding: 2px 5px; width: 25%;"><strong>Suhu:</strong>
                                    <?= $soap['suhu_tubuh'] ?? '-' ?> °C</td>
                            </tr>
                            <tr>
                                <td style="border: none; padding: 2px 5px;"><strong>SpO2:</strong> <?= $soap['spo2'] ?? '-' ?> %
                                </td>
                                <td style="border: none; padding: 2px 5px;"><strong>BB:</strong> <?= $soap['berat'] ?? '-' ?> Kg
                                </td>
                                <td style="border: none; padding: 2px 5px;"><strong>TB:</strong> <?= $soap['tinggi'] ?? '-' ?>
                                    Cm</td>
                                <td style="border: none; padding: 2px 5px;"><strong>GCS:</strong> <?= $soap['gcs'] ?? '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="border: none; padding: 2px 5px;"><strong>Kesadaran:</strong>
                                    <?= $soap['kesadaran'] ?? '-' ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- SOAP Fields -->
                    <?php if (!empty($soap['keluhan'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-s">SUBJECTIVE (Keluhan):</div>
                            <div class="soap-field-content"><?= nl2br($soap['keluhan']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($soap['pemeriksaan'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-o">OBJECTIVE (Pemeriksaan):</div>
                            <div class="soap-field-content"><?= nl2br($soap['pemeriksaan']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($soap['penilaian'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-a">ASSESSMENT (Penilaian):</div>
                            <div class="soap-field-content"><?= nl2br($soap['penilaian']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($soap['rtl'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-p">PLAN (Rencana):</div>
                            <div class="soap-field-content"><?= nl2br($soap['rtl']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($soap['instruksi'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-i">INSTRUCTION (Instruksi):</div>
                            <div class="soap-field-content"><?= nl2br($soap['instruksi']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($soap['evaluasi'])): ?>
                        <div class="soap-field">
                            <div class="soap-field-label label-e">EVALUATION (Evaluasi):</div>
                            <div class="soap-field-content"><?= nl2br($soap['evaluasi']) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="text-align:center; padding: 10px; color: #666; font-style:italic; border: 1px dashed #ccc;">
            Tidak ada data SOAP untuk kunjungan ini.
        </div>
    <?php endif; ?>

    <?php if (!$is_bulk): ?>
        <div class="print-footer">
            <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Rumah Sakit</p>
            <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?> WIB</p>
        </div>
    </body>

    </html>
<?php endif; ?>
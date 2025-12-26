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

        /* Header RS */
        .print-header {
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }

        .print-header-content {
            width: 100%;
        }

        .print-header-info {
            text-align: center;
        }

        .print-header-info h1 {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .print-header-info .alamat {
            font-size: 9pt;
            margin-bottom: 2px;
        }

        .print-header-info .kontak {
            font-size: 9pt;
            margin-bottom: 2px;
        }

        .print-header-info .akreditasi {
            font-size: 8pt;
            font-style: italic;
            color: #666;
        }

        /* Patient Info Table */
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

        /* SOAP Entries */
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

        /* Vital Signs Grid - More Compact */
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

        /* SOAP Fields - More Compact */
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
        }

        .soap-field-label.label-s {
            border-left-color: #dc2626;
            color: #dc2626;
        }

        .soap-field-label.label-o {
            border-left-color: #ea580c;
            color: #ea580c;
        }

        .soap-field-label.label-a {
            border-left-color: #16a34a;
            color: #16a34a;
        }

        .soap-field-label.label-p {
            border-left-color: #2563eb;
            color: #2563eb;
        }

        .soap-field-label.label-i {
            border-left-color: #0891b2;
            color: #0891b2;
        }

        .soap-field-label.label-e {
            border-left-color: #9333ea;
            color: #9333ea;
        }

        .soap-field-content {
            padding: 3px 6px;
            font-size: 9pt;
            line-height: 1.4;
            min-height: 18px;
            white-space: pre-wrap;
        }

        /* Footer */
        .print-footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 8pt;
            color: #666;
        }

        /* Page Break */
        @media print {
            .soap-entry {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <!-- Header RS -->
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
                <td width="10%" align="right" style="vertical-align:middle;">
                    <!-- Optional: Right Logo -->
                </td>
            </tr>
        </table>
    </div>

    <!-- Patient Info -->
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

    <!-- SOAP Entries -->
    <?php foreach ($soap_data as $index => $soap): ?>
        <div class="soap-entry">
            <div class="soap-entry-header">
                Entry #<?= $index + 1 ?> - <?= date('d/m/Y', strtotime($soap['tgl_perawatan'])) ?> |
                <?= $soap['jam_rawat'] ?> | <?= $soap['nm_petugas'] ?? 'Dokter' ?>
            </div>
            <div class="soap-entry-body">
                <!-- Tanda Vital -->
                <div class="vital-signs">
                    <div class="vital-signs-title">📊 Tanda Vital:</div>
                    <table style="width: 100%; font-size: 8.5pt; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 2px 4px;"><strong>Suhu:</strong> <?= $soap['suhu_tubuh'] ?? '-' ?> °C</td>
                            <td style="padding: 2px 4px;"><strong>Tensi:</strong> <?= $soap['tensi'] ?? '-' ?></td>
                            <td style="padding: 2px 4px;"><strong>Nadi:</strong> <?= $soap['nadi'] ?? '-' ?> x/mnt</td>
                            <td style="padding: 2px 4px;"><strong>RR:</strong> <?= $soap['respirasi'] ?? '-' ?> x/mnt</td>
                            <td style="padding: 2px 4px;"><strong>SPO2:</strong> <?= $soap['spo2'] ?? '-' ?> %</td>
                            <td style="padding: 2px 4px;"><strong>GCS:</strong> <?= $soap['gcs'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 4px;"><strong>BB:</strong> <?= $soap['berat'] ?? '-' ?> kg</td>
                            <td style="padding: 2px 4px;"><strong>TB:</strong> <?= $soap['tinggi'] ?? '-' ?> cm</td>
                            <td style="padding: 2px 4px;"><strong>Kesadaran:</strong> <?= $soap['kesadaran'] ?? '-' ?></td>
                            <td style="padding: 2px 4px;"><strong>LP:</strong> <?= $soap['lingkar_perut'] ?? '-' ?> cm</td>
                            <td colspan="2" style="padding: 2px 4px;"><strong>Alergi:</strong> <?= $soap['alergi'] ?? '-' ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- SOAP Fields -->
                <div class="soap-field">
                    <div class="soap-field-label label-s">S - Subjektif (Keluhan)</div>
                    <div class="soap-field-content">
                        <?= !empty($soap['keluhan']) ? nl2br(htmlspecialchars($soap['keluhan'])) : '-' ?>
                    </div>
                </div>

                <div class="soap-field">
                    <div class="soap-field-label label-o">O - Objektif (Pemeriksaan)</div>
                    <div class="soap-field-content">
                        <?= !empty($soap['pemeriksaan']) ? nl2br(htmlspecialchars($soap['pemeriksaan'])) : '-' ?>
                    </div>
                </div>

                <div class="soap-field">
                    <div class="soap-field-label label-a">A - Asesmen (Penilaian)</div>
                    <div class="soap-field-content">
                        <?= !empty($soap['penilaian']) ? nl2br(htmlspecialchars($soap['penilaian'])) : '-' ?>
                    </div>
                </div>

                <div class="soap-field">
                    <div class="soap-field-label label-p">P - Plan (Rencana Tindak Lanjut)</div>
                    <div class="soap-field-content">
                        <?= !empty($soap['rtl']) ? nl2br(htmlspecialchars($soap['rtl'])) : '-' ?>
                    </div>
                </div>

                <?php if (!empty($soap['instruksi'])): ?>
                    <div class="soap-field">
                        <div class="soap-field-label label-i">Instruksi Medis</div>
                        <div class="soap-field-content"><?= nl2br(htmlspecialchars($soap['instruksi'])) ?></div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($soap['evaluasi'])): ?>
                    <div class="soap-field">
                        <div class="soap-field-label label-e">Evaluasi</div>
                        <div class="soap-field-content"><?= nl2br(htmlspecialchars($soap['evaluasi'])) ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Footer -->
    <div class="print-footer">
        Dokumen ini dicetak secara otomatis pada <?= date('d/m/Y H:i:s') ?> dan sah tanpa tanda tangan basah.
    </div>

</body>

</html>
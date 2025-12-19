<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $document_title ?? 'Riwayat Medis Pasien' ?></title>

    <!-- MINIMAL CSS FOR mPDF -->
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        h1, h2, h3 {
            margin: 10px 0;
        }
        .print-section {
            margin: 15px 0;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <!-- ==================== HEADER RUMAH SAKIT ==================== -->
    <table style="width: 100%; border: none; margin-bottom: 20px;">
        <tr>
            <td style="width: 80px; border: none; vertical-align: top;">
                <?php if (!empty($hospital->logo)): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($hospital->logo) ?>" style="width: 70px; height: auto;" alt="Logo RS">
                <?php endif; ?>
            </td>
            <td style="border: none; vertical-align: top; text-align: center;">
                <h2 style="margin: 0; font-size: 16pt; font-weight: bold;">
                    <?= $hospital->nama_instansi ?? 'RUMAH SAKIT' ?>
                </h2>
                <p style="margin: 2px 0; font-size: 10pt;">
                    <?= $hospital->alamat_instansi ?? '' ?>, <?= $hospital->kabupaten ?? '' ?>, <?= $hospital->propinsi ?? '' ?>
                </p>
                <p style="margin: 2px 0; font-size: 10pt;">
                    Kontak: <?= $hospital->kontak ?? '-' ?> | Email: <?= $hospital->email ?? '-' ?>
                </p>
            </td>
        </tr>
    </table>
    
    <hr style="border: 2px solid #000; margin: 10px 0;">

    <!-- ==================== JUDUL DOKUMEN ==================== -->
    <h1 style="text-align: center; font-size: 14pt; font-weight: bold; margin: 15px 0; text-transform: uppercase;">
        <?= $document_title ?? 'RIWAYAT MEDIS LENGKAP' ?>
    </h1>

    <!-- ==================== IDENTITAS PASIEN ==================== -->
    <table style="width: 100%; margin-bottom: 20px; border: 2px solid #000;">
        <tr style="background-color: #e0e0e0;">
            <th colspan="4" style="text-align: center; padding: 8px; font-size: 12pt; border: none;">
                IDENTITAS PASIEN
            </th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #000;">No. Rekam Medis</td>
            <td style="width: 25%; padding: 5px; border-right: 1px solid #000;">: <?= $patient->no_rkm_medis ?? '-' ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #000;">Nama Pasien</td>
            <td style="width: 25%; padding: 5px;">: <?= $patient->nm_pasien ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Tanggal Lahir</td>
            <td style="padding: 5px; border-right: 1px solid #000;">: <?= $patient->tgl_lahir ?? '-' ?></td>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Jenis Kelamin</td>
            <td style="padding: 5px;">: <?= $patient->jk ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Alamat</td>
            <td colspan="3" style="padding: 5px;">: <?= $patient->alamat ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">No. Telepon</td>
            <td style="padding: 5px; border-right: 1px solid #000;">: <?= $patient->no_tlp ?? '-' ?></td>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Pekerjaan</td>
            <td style="padding: 5px;">: <?= $patient->pekerjaan ?? '-' ?></td>
        </tr>
    </table>

    <!-- ==================== LOOP SEMUA KUNJUNGAN ==================== -->
    <?php if (!empty($visits_data)): ?>
        <?php foreach ($visits_data as $idx => $visit_data): ?>

            <!-- SEPARATOR ANTAR KUNJUNGAN -->
            <?php if ($idx > 0): ?>
                <div style="page-break-before:always;"></div>
            <?php endif; ?>

            <!-- INFO KUNJUNGAN -->
            <table style="width: 100%; margin: 15px 0; border: 2px solid #0066cc; background-color: #e3f2fd;">
                <tr>
                    <td style="padding: 12px; border: none;">
                        <h3 style="margin: 0; color: #0066cc; font-size: 13pt;">
                            📋 KUNJUNGAN #<?= $idx + 1 ?> - <?= date('d/m/Y', strtotime($visit_data['visit']->tgl_registrasi)) ?>
                        </h3>
                        <p style="margin: 5px 0 0 0; font-size: 10pt;">
                            <strong>No. Rawat:</strong> <?= $visit_data['visit']->no_rawat ?> |
                            <strong>Poli:</strong> <?= $visit_data['visit']->nm_poli ?> |
                            <strong>Dokter:</strong> <?= $visit_data['visit']->nm_dokter ?>
                        </p>
                    </td>
                </tr>
            </table>

            <!-- RENDER SEMUA SECTIONS UNTUK KUNJUNGAN INI -->
            <?php foreach ($visit_data['sections'] as $section): ?>
                <?php
                // Extract data untuk view
                extract($section['data']);

                // Load view file
                $view_path = APPPATH . 'views/print/sections/' . $section['file'];
                if (file_exists($view_path)) {
                    include $view_path;
                }
                ?>
            <?php endforeach; ?>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="print-section">
            <p style="text-align:center; color:#999;">Tidak ada data riwayat medis.</p>
        </div>
    <?php endif; ?>

    <!-- ==================== FOOTER ==================== -->
    <div class="print-footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Rumah Sakit</p>
        <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?> WIB</p>
    </div>

    <!-- MANUAL PRINT BUTTON (NO AUTO PRINT) -->
    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: none;" id="printBtn"
        class="no-print">
        <button onclick="window.print()" style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        ">
            🖨️ Cetak Dokumen
        </button>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        // Show print button after page loads
        window.onload = function () {
            setTimeout(function() {
                document.getElementById('printBtn').style.display = 'block';
            }, 500);
    };
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $document_title ?? 'Riwayat Medis Pasien' ?></title>

    <!-- MINIMAL CSS FOR mPDF & BROWSER PRINT -->
    <style>
        /* @page removed to avoid conflict with mPDF constructor */

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            page-break-inside: avoid;
            /* Prevent table break errors */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        h1,
        h2,
        h3 {
            margin: 5px 0;
        }

        h1 {
            font-size: 16pt;
        }

        h2 {
            font-size: 14pt;
        }

        h3 {
            font-size: 12pt;
        }

        .print-section {
            margin: 10px 0;
            page-break-inside: avoid;
        }

        /* Utility */
        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .no-border {
            border: none !important;
        }

        .border-bottom {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>

    <!-- ==================== HEADER RUMAH SAKIT ==================== -->
    <table class="no-border" style="margin-bottom: 10px;">
        <tr>
            <td style="width: 80px;" class="no-border">
                <?php if (!empty($hospital->logo)): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($hospital->logo) ?>"
                        style="width: 70px; height: auto;" alt="Logo RS">
                <?php endif; ?>
            </td>
            <td class="text-center no-border">
                <h2 style="margin: 0; font-size: 16pt; font-weight: bold;">
                    <?= strtoupper($hospital->nama_instansi ?? 'RUMAH SAKIT') ?>
                </h2>
                <p style="margin: 2px 0; font-size: 9pt;">
                    <?= $hospital->alamat_instansi ?? '' ?>, <?= $hospital->kabupaten ?? '' ?>,
                    <?= $hospital->propinsi ?? '' ?>
                </p>
                <p style="margin: 2px 0; font-size: 9pt;">
                    Kontak: <?= $hospital->kontak ?? '-' ?> | Email: <?= $hospital->email ?? '-' ?>
                </p>
            </td>
            <td style="width: 80px;" class="no-border"></td>
        </tr>
    </table>

    <div style="border-bottom: 3px double #000; margin-bottom: 15px;"></div>

    <!-- ==================== JUDUL DOKUMEN ==================== -->
    <div class="text-center" style="margin-bottom: 20px;">
        <h1 style="font-size: 14pt; margin: 0; text-transform: uppercase; text-decoration: underline;">
            <?= $document_title ?? 'RIWAYAT MEDIS LENGKAP' ?>
        </h1>
    </div>

    <!-- ==================== IDENTITAS PASIEN ==================== -->
    <table style="border: 2px solid #000; margin-bottom: 20px;">
        <thead>
            <tr>
                <th colspan="4" class="text-center"
                    style="font-size: 11pt; padding: 6px; border-bottom: 1px solid #000; background-color: #f3f4f6;">
                    IDENTITAS PASIEN
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 20%; font-weight: bold;">No. Rekam Medis</td>
                <td style="width: 30%;">: <?= $patient->no_rkm_medis ?? '-' ?></td>
                <td style="width: 20%; font-weight: bold;">Nama Pasien</td>
                <td style="width: 30%;">: <?= $patient->nm_pasien ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tanggal Lahir</td>
                <td>: <?= $patient->tgl_lahir ?? '-' ?></td>
                <td style="font-weight: bold;">Jenis Kelamin</td>
                <td>: <?= ($patient->jk ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Alamat</td>
                <td>: <?= $patient->alamat ?? '-' ?></td>
                <td style="font-weight: bold;">Pekerjaan</td>
                <td>: <?= $patient->pekerjaan ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">No. Telepon</td>
                <td colspan="3">: <?= $patient->no_tlp ?? '-' ?></td>
            </tr>
        </tbody>
    </table>

    <!-- ==================== LOOP SEMUA KUNJUNGAN ==================== -->
    <?php if (!empty($visits_data)): ?>
        <?php foreach ($visits_data as $idx => $visit_data): ?>

            <!-- SEPARATOR ANTAR KUNJUNGAN -->
            <?php if ($idx > 0): ?>
                <div style="page-break-before:always; margin-top: 20px;"></div>
            <?php endif; ?>

            <!-- INFO KUNJUNGAN (Back to Table for safe mPDF rendering) -->
            <table style="width: 100%; margin: 15px 0; border: 2px solid #2563eb; background-color: #eff6ff;">
                <tr>
                    <td style="padding: 10px; border: none;">
                        <h3 style="margin: 0; color: #1e40af; font-size: 12pt;">
                            <span
                                style="background: #2563eb; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10pt; margin-right: 5px;">#<?= $idx + 1 ?></span>
                            KUNJUNGAN TANGGAL <?= date('d/m/Y', strtotime($visit_data['visit']->tgl_registrasi)) ?>
                        </h3>
                        <div style="margin-top: 5px; font-size: 9pt; border-top: 1px solid #bfdbfe; padding-top: 5px;">
                            <strong>No. Rawat:</strong> <?= $visit_data['visit']->no_rawat ?> &nbsp; | &nbsp;
                            <strong>Poli:</strong> <?= $visit_data['visit']->nm_poli ?> &nbsp; | &nbsp;
                            <strong>Dokter:</strong> <?= $visit_data['visit']->nm_dokter ?>
                        </div>
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
            <p style="text-align:center; color:#999; padding: 20px; border: 1px dashed #ccc;">Tidak ada data riwayat medis.
            </p>
        </div>
    <?php endif; ?>
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
            setTimeout(function () {
                document.getElementById('printBtn').style.display = 'block';
            }, 500);
        };
    </script>

</body>

</html>
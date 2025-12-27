<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekam Medis - <?= isset($patient['nm_pasien']) ? $patient['nm_pasien'] : 'Pasien' ?></title>

    <style>
        /* PAGE SETUP */
        @page {
            size: A4;
            margin: 10mm 15mm;
        }

        /* GENERAL STYLES */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            background-color: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .print-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
        }

        /* TABLES */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        th,
        td {
            padding: 4px 6px;
            vertical-align: top;
        }

        /* UTILITY CLASSES */
        .no-border {
            border: none !important;
        }

        .no-border td {
            border: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        /* HEADER RS */
        .hospital-header {
            border-bottom: 3px double #000;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }

        .hospital-header h2 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .hospital-header p {
            margin: 2px 0;
            font-size: 9pt;
        }

        /* IDENTITY TABLE */
        .identity-table {
            width: 100%;
            border: 2px solid #000;
            margin-bottom: 20px;
        }

        .identity-table td {
            border: 1px solid #000;
        }

        .identity-header {
            background-color: #f3f4f6;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #000;
            padding: 6px;
        }

        /* SECTION STYLES */
        .print-section {
            margin-top: 15px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        /* FOOTER */
        .print-footer {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            font-size: 8pt;
            color: #666;
            text-align: right;
            font-style: italic;
        }

        /* SIGNATURE */
        .signature-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="print-container">

        <!-- HEADER RUMAH SAKIT -->
        <div class="hospital-header">
            <table class="no-border">
                <tr>
                    <td style="width: 80px;" class="text-center">
                        <?php if (!empty($hospital['logo'])): ?>
                            <img src="data:image/jpeg;base64,<?= $hospital['logo'] ?>" style="width: 70px; height: auto;"
                                alt="Logo">
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <h2><?= strtoupper(isset($hospital['nama_instansi']) ? $hospital['nama_instansi'] : 'RUMAH SAKIT') ?>
                        </h2>
                        <p><?= $hospital['alamat_instansi'] ?>,
                            <?= isset($hospital['kabupaten']) ? $hospital['kabupaten'] : '' ?>
                            <?= isset($hospital['propinsi']) ? $hospital['propinsi'] : '' ?></p>
                        <p>Telp: <?= $hospital['kontak'] ?> | Email: <?= $hospital['email'] ?></p>
                    </td>
                    <td style="width: 80px;"></td> <!-- Spacer -->
                </tr>
            </table>
        </div>

        <!-- JUDUL -->
        <div class="text-center" style="margin-bottom: 15px;">
            <h1 style="font-size: 14pt; text-decoration: underline; margin: 0; text-transform: uppercase;">RIWAYAT MEDIS
                RAWAT JALAN</h1>
        </div>

        <!-- IDENTITAS PASIEN TABEL -->
        <table class="identity-table">
            <thead>
                <tr>
                    <td colspan="4" class="identity-header">
                        IDENTITAS PASIEN & KUNJUNGAN
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%;" class="font-bold">No. RM</td>
                    <td style="width: 35%;">: <?= isset($patient['no_rkm_medis']) ? $patient['no_rkm_medis'] : '-' ?>
                    </td>
                    <td style="width: 15%;" class="font-bold">No. Rawat</td>
                    <td style="width: 35%;">: <?= isset($visit['no_rawat']) ? $visit['no_rawat'] : '-' ?></td>
                </tr>
                <tr>
                    <td class="font-bold">Nama Pasien</td>
                    <td>: <strong><?= isset($patient['nm_pasien']) ? $patient['nm_pasien'] : '-' ?></strong></td>
                    <td class="font-bold">Tgl. Kunjungan</td>
                    <td>:
                        <?= isset($visit['tgl_registrasi']) ? date('d/m/Y', strtotime($visit['tgl_registrasi'])) : '-' ?>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Tgl. Lahir</td>
                    <td>: <?= isset($patient['tgl_lahir']) ? date('d/m/Y', strtotime($patient['tgl_lahir'])) : '-' ?>
                    </td>
                    <td class="font-bold">Poli / Dokter</td>
                    <td>: <?= isset($visit['nm_poli']) ? $visit['nm_poli'] : '-' ?> /
                        <?= isset($visit['nm_dokter']) ? $visit['nm_dokter'] : '-' ?></td>
                </tr>
                <tr>
                    <td class="font-bold">Alamat</td>
                    <td colspan="3">: <?= isset($patient['alamat']) ? $patient['alamat'] : '-' ?></td>
                </tr>
            </tbody>
        </table>

        <!-- KONTEN -->
        <?php if (isset($sections) && is_array($sections)): ?>
            <?php foreach ($sections as $section): ?>
                <?php
                if (isset($section['file']) && file_exists(APPPATH . 'views/print/sections/' . $section['file'])) {
                    // Inject $d if missing (compatibility)
                    if (isset($section['data'])) {
                        $section_data = $section['data'];
                    } else {
                        $section_data = [];
                    }

                    // IMPORTANT: Ensure $d exists for sections that rely on it (like updated resume_medis.php)
                    if (!isset($section_data['d'])) {
                        // Create a basic object structure if we can
                        // Note: In single print, variables are usually passed directly, not via $d
                        // But our new view resume_medis.php expects $d->resume or $resume variable
                        // Let's pass $resume directly from controller if available
                    }

                    $this->load->view('print/sections/' . $section['file'], $section_data);
                }
                ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- TANDA TANGAN -->
        <?php if (isset($show_signature) && $show_signature): ?>
            <div class="signature-section">
                <table class="no-border">
                    <tr>
                        <td style="width: 60%;"></td>
                        <td style="width: 40%; text-align: center;">
                            <p><?= isset($hospital['kabupaten']) ? $hospital['kabupaten'] : 'Kota' ?>, <?= date('d-m-Y') ?>
                            </p>
                            <p style="margin-bottom: 50px;">Dokter Penanggung Jawab</p>
                            <?php if (isset($qr_code) && $qr_code): ?>
                                <img src="<?= $qr_code ?>" style="width: 80px; margin-bottom: 5px;">
                            <?php else: ?>
                                <br><br>
                            <?php endif; ?>
                            <p style="text-decoration: underline; font-weight: bold;">
                                <?= isset($visit['nm_dokter']) ? $visit['nm_dokter'] : '.........................' ?></p>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

        <!-- FOOTER -->
        <div class="print-footer">
            Dicetak otomatis pada tanggal: <?= date('d/m/Y H:i:s') ?>
        </div>

    </div>
</body>

</html>
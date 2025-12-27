<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Riwayat Medis Pasien</title>

    <!-- MINIMAL CSS FOR mPDF & BROWSER PRINT -->
    <style>
        @page {
            size: A4;
            margin: 10mm 15mm;
        }

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

        /* Container to simulate A4 in browser */
        .page-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
            text-align: left;
        }

        th {
            background-color: #f3f4f6 !important;
            font-weight: bold;
        }

        h1,
        h2,
        h3 {
            margin: 3px 0 5px 0;
            page-break-after: avoid;
        }

        .print-section {
            margin: 5px 0;
            page-break-inside: auto;
        }

        /* Prevent orphan headers */
        h3 {
            page-break-after: avoid;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        /* Utility */
        .text-center {
            text-align: center;
        }

        .no-border {
            border: none !important;
        }

        .no-border td {
            border: none !important;
        }

        .print-footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            font-size: 8pt;
            color: #666;
            text-align: right;
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            /* Force compact spacing in print */
            .print-section {
                margin: 3px 0 !important;
            }

            h3 {
                margin: 2px 0 4px 0 !important;
            }

            table {
                margin-bottom: 4px !important;
            }
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
            RIWAYAT MEDIS LENGKAP
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
                <td style="width: 30%;">: <?= $pasien->no_rkm_medis ?? '-' ?></td>
                <td style="width: 20%; font-weight: bold;">Nama Pasien</td>
                <td style="width: 30%;">: <?= $pasien->nm_pasien ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tanggal Lahir</td>
                <td>: <?= $pasien->tgl_lahir ?? '-' ?></td>
                <td style="font-weight: bold;">Jenis Kelamin</td>
                <td>: <?= ($pasien->jk ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Alamat</td>
                <td colspan="3">: <?= $pasien->alamat ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">No. Telepon</td>
                <td>: -</td>
                <td style="font-weight: bold;">Pekerjaan</td>
                <td>: -</td>
            </tr>
        </tbody>
    </table>

    <!-- ==================== INFO KUNJUNGAN ==================== -->
    <table style="width: 100%; margin: 5px 0; border: 2px solid #0066cc; background-color: #e3f2fd;">
        <tr>
            <td style="padding: 8px; border: none;">
                <h3 style="margin: 0; color: #0066cc; font-size: 13pt;">
                    📋 KUNJUNGAN - <?= date('d/m/Y', strtotime($pasien->tgl_registrasi)) ?>
                </h3>
                <p style="margin: 5px 0 0 0; font-size: 10pt;">
                    <strong>No. Rawat:</strong> <?= $data->no_rawat ?> |
                    <strong>Poli:</strong> <?= $pasien->nm_poli ?> |
                    <strong>Dokter:</strong> <?= $pasien->nm_dokter ?>
                </p>
            </td>
        </tr>
    </table>

    <!-- RENDER SECTIONS -->
    <?php
    // Prepare data for sections
    $d = $data; // Use $data object directly
    
    // 1. IGD
    if (!empty($d->igd)) {
        include APPPATH . 'views/print/sections/asesmen_igd.php';
    }

    // 2. Penyakit Dalam
    if (!empty($d->penyakit_dalam)) {
        include APPPATH . 'views/print/sections/asesmen_penyakit_dalam.php';
    }

    // 3. Orthopedi
    if (!empty($d->orthopedi)) {
        include APPPATH . 'views/print/sections/asesmen_orthopedi.php';
    }

    // 4. Mata
    if (!empty($d->mata)) {
        include APPPATH . 'views/print/sections/asesmen_mata.php';
    }

    // 5. Kandungan
    if (!empty($d->kandungan)) {
        include APPPATH . 'views/print/sections/asesmen_kandungan.php';
    }

    // --- TAMBAHAN ASESMEN BARU ---
    
    // 5.1 Anak (Pediatri)
    if (!empty($d->anak)) {
        include APPPATH . 'views/print/sections/asesmen_anak.php';
    }

    // 5.2 Bedah
    if (!empty($d->bedah)) {
        include APPPATH . 'views/print/sections/asesmen_bedah.php';
    }

    // 5.3 THT
    if (!empty($d->tht)) {
        include APPPATH . 'views/print/sections/asesmen_tht.php';
    }

    // 5.4 Jantung
    if (!empty($d->jantung)) {
        include APPPATH . 'views/print/sections/asesmen_jantung.php';
    }

    // 5.5 Kulit & Kelamin
    if (!empty($d->kulitdankelamin)) {
        include APPPATH . 'views/print/sections/asesmen_kulitdankelamin.php';
    }

    // 5.6 Neurologi
    if (!empty($d->neurologi)) {
        include APPPATH . 'views/print/sections/asesmen_neurologi.php';
    }

    // 5.7 Paru
    if (!empty($d->paru)) {
        include APPPATH . 'views/print/sections/asesmen_paru.php';
    }

    // 5.8 Psikiatrik
    if (!empty($d->psikiatrik)) {
        include APPPATH . 'views/print/sections/asesmen_psikiatrik.php';
    }

    // 5.9 IGD Psikiatri
    if (!empty($d->igdPsikiatri)) {
        include APPPATH . 'views/print/sections/asesmen_gawatdaruratpsikiatri.php';
    }

    // 5.10 Geriatri
    if (!empty($d->geriatri)) {
        include APPPATH . 'views/print/sections/asesmen_geriatri.php';
    }

    // 5.11 Rehab Medik (Asesmen Medis)
    if (!empty($d->asesmenRehabMedik)) {
        include APPPATH . 'views/print/sections/asesmen_rehabmedik.php';
    }

    // 5.12 Urologi
    if (!empty($d->asesmenUrologi)) {
        include APPPATH . 'views/print/sections/asesmen_urologi.php';
    }

    // 5.13 UMUM (GENERAL)
    if (!empty($d->umum)) {
        include APPPATH . 'views/print/sections/asesmen_umum.php';
    }


    // 6. SOAP
    if (!empty($d->soap)) {
        include APPPATH . 'views/print/sections/soap.php';
    }

    // 7. Diagnosa
    if (!empty($d->diagnosa)) {
        include APPPATH . 'views/print/sections/diagnosa.php';
    }

    // 8. Prosedur
    if (!empty($d->prosedur)) {
        include APPPATH . 'views/print/sections/prosedur.php';
    }

    // 9. Tindakan
    if (!empty($d->tindakan)) {
        include APPPATH . 'views/print/sections/tindakan.php';
    }

    // 10. Resep
    if (!empty($d->resep)) {
        include APPPATH . 'views/print/sections/resep.php';
    }

    // 11. Lab
    if (!empty($d->lab)) {
        include APPPATH . 'views/print/sections/lab.php';
    }

    // 12. Radiologi
    if (!empty($d->radiologi)) {
        include APPPATH . 'views/print/sections/radiologi.php';
    }

    // 13. KFR
    if (!empty($d->kfr)) {
        include APPPATH . 'views/print/sections/formulir_kfr.php';
    }

    // 14. Rehab Medik
    if (!empty($d->rehab_medik)) {
        include APPPATH . 'views/print/sections/program_rehab_medik.php';
    }

    // 15. Berkas Digital
    if (!empty($d->berkas_digital)) {
        include APPPATH . 'views/print/sections/berkas_digital.php';
    }

    // 16. Operasi
    if (!empty($d->operasi)) {
        include APPPATH . 'views/print/sections/operasi.php';
    }

    // 17. Resume
    if (!empty($d->resume)) {
        include APPPATH . 'views/print/sections/resume_medis.php';
    }
    ?>

    <!-- FOOTER -->
    <div class="print-footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Rumah Sakit</p>
        <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?> WIB</p>
    </div>

    <!-- PRINT BUTTON -->
    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;" class="no-print">
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

</body>

</html>
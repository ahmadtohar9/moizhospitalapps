<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Riwayat Medis Pasien</title>

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

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        h1,
        h2,
        h3 {
            margin: 10px 0;
        }

        .print-section {
            margin: 15px 0;
            page-break-inside: avoid;
        }

        /* PRINT SPECIFIC STYLES */
        @media print {
            body {
                margin: 0 !important;
                padding: 0 !important;
            }

            table {
                margin: 5px 0 !important;
            }

            h1 {
                margin: 5px 0 !important;
            }

            hr {
                margin: 3px 0 !important;
            }

            .print-section {
                margin: 10px 0 !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <!-- ==================== HEADER RUMAH SAKIT ==================== -->
    <table style="width: 100%; border: none; margin-bottom: 10px;">
        <tr>
            <td style="width: 80px; border: none; vertical-align: top;">
                <?php if (!empty($hospital->logo)): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($hospital->logo) ?>"
                        style="width: 70px; height: auto;" alt="Logo RS">
                <?php endif; ?>
            </td>
            <td style="border: none; vertical-align: top; text-align: center;">
                <h2 style="margin: 0; font-size: 16pt; font-weight: bold;">
                    <?= $hospital->nama_instansi ?? 'RUMAH SAKIT' ?>
                </h2>
                <p style="margin: 2px 0; font-size: 10pt;">
                    <?= $hospital->alamat_instansi ?? '' ?>, <?= $hospital->kabupaten ?? '' ?>,
                    <?= $hospital->propinsi ?? '' ?>
                </p>
                <p style="margin: 2px 0; font-size: 10pt;">
                    Kontak: <?= $hospital->kontak ?? '-' ?> | Email: <?= $hospital->email ?? '-' ?>
                </p>
            </td>
        </tr>
    </table>

    <hr style="border: 2px solid #000; margin: 5px 0;">

    <!-- ==================== JUDUL DOKUMEN ==================== -->
    <h1 style="text-align: center; font-size: 14pt; font-weight: bold; margin: 10px 0; text-transform: uppercase;">
        RIWAYAT MEDIS LENGKAP
    </h1>

    <!-- ==================== IDENTITAS PASIEN ==================== -->
    <table style="width: 100%; margin-bottom: 10px; border: 2px solid #000;">
        <tr style="background-color: #e0e0e0;">
            <th colspan="4" style="text-align: center; padding: 8px; font-size: 12pt; border: none;">
                IDENTITAS PASIEN
            </th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #000;">No. Rekam Medis</td>
            <td style="width: 25%; padding: 5px; border-right: 1px solid #000;">: <?= $pasien->no_rkm_medis ?? '-' ?>
            </td>
            <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #000;">Nama Pasien</td>
            <td style="width: 25%; padding: 5px;">: <?= $pasien->nm_pasien ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Tanggal Lahir</td>
            <td style="padding: 5px; border-right: 1px solid #000;">: <?= $pasien->tgl_lahir ?? '-' ?></td>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Jenis Kelamin</td>
            <td style="padding: 5px;">: <?= $pasien->jk ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Alamat</td>
            <td colspan="3" style="padding: 5px;">: <?= $pasien->alamat ?? '-' ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">No. Telepon</td>
            <td style="padding: 5px; border-right: 1px solid #000;">: -</td>
            <td style="padding: 5px; font-weight: bold; border-right: 1px solid #000;">Pekerjaan</td>
            <td style="padding: 5px;">: -</td>
        </tr>
    </table>

    <!-- ==================== INFO KUNJUNGAN ==================== -->
    <table style="width: 100%; margin: 10px 0; border: 2px solid #0066cc; background-color: #e3f2fd;">
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
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Formulir KFR</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .header h3 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 10pt;
        }

        .judul-surat {
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
            font-size: 12pt;
            text-decoration: underline;
        }

        table.identitas {
            width: 100%;
            margin-bottom: 10px;
        }

        table.identitas td {
            padding: 2px 0;
            vertical-align: top;
        }

        .label {
            width: 150px;
        }

        .section-title {
            font-weight: bold;
            font-style: italic;
            margin-top: 10px;
            text-decoration: underline;
        }

        .content-box {
            margin-bottom: 5px;
            padding-left: 5px;
        }

        .planning-list {
            list-style-type: lower-alpha;
            padding-left: 20px;
            margin: 5px 0;
        }

        .planning-list li {
            margin-bottom: 3px;
        }

        .signature {
            margin-top: 30px;
            width: 100%;
        }

        .signature table {
            width: 100%;
        }

        .signature td {
            text-align: center;
        }

        .titik-titik {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 98%;
            min-height: 14px;
        }
    </style>
</head>

<body onload="window.print(); window.close();">

    <div class="header">
        <table width="100%" style="border: none; margin-bottom: 0;">
            <tr style="border: none;">
                <td width="15%" style="text-align: center; vertical-align: middle; border: none;">
                    <?php if (!empty($setting['logo'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>"
                            style="width: 80px; height: auto;">
                    <?php endif; ?>
                </td>
                <td width="85%" style="text-align: center; vertical-align: middle; border: none;">
                    <h3 class="text-upper" style="margin:0;">
                        <?= isset($setting['nama_instansi']) ? $setting['nama_instansi'] : 'MOIZ HOSPITAL' ?>
                    </h3>
                    <p style="margin:2px 0;">
                        <?= isset($setting['alamat_instansi']) ? $setting['alamat_instansi'] : 'Alamat Rumah Sakit' ?>
                    </p>
                    <p style="margin:0;">Telp: <?= isset($setting['kontak']) ? $setting['kontak'] : '-' ?>, Email:
                        <?= isset($setting['email']) ? $setting['email'] : '-' ?>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="judul-surat">Formulir Rawat Jalan KFR/Asesmen/Re-Asesmen/Protokol Terapi</div>

    <div style="font-weight: bold; margin-bottom: 5px;">Identitas Pasien</div>
    <table class="identitas">
        <tr>
            <td class="label">Nomor Rekam Medis</td>
            <td>: <?= $pasien['no_rkm_medis'] ?></td>
        </tr>
        <tr>
            <td class="label">Nama</td>
            <td>: <?= $pasien['nm_pasien'] ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Lahir</td>
            <td>: <?= date('d-m-Y', strtotime($pasien['tgl_lahir'])) ?> / <?= $pasien['umur'] ?></td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td>: <?= $pasien['alamat'] ?></td>
        </tr>
    </table>

    <div class="section-title">Subjective</div>
    <div class="content-box"><?= nl2br($rehab['subjective']) ?></div>
    <div class="titik-titik"></div>

    <div class="section-title">Objective</div>
    <div class="content-box"><?= nl2br($rehab['objective']) ?></div>
    <div class="titik-titik"></div>

    <div class="section-title">Assessment</div>
    <div class="content-box"><?= nl2br($rehab['assessment']) ?></div>
    <div class="titik-titik"></div>

    <div class="section-title">Planning</div>
    <div class="content-box">
        <div style="margin-left: 15px;">
            <div style="margin-bottom: 5px;">
                <strong>a. Goal of Treatment:</strong><br>
                <?= nl2br($rehab['goal_of_treatment']) ?>
                <div class="titik-titik"></div>
            </div>

            <div style="margin-bottom: 5px;">
                <strong>b. Tindakan/Program Rehabilitasi Medik:</strong><br>
                <?= nl2br($rehab['tindakan_rehab']) ?>
                <div class="titik-titik"></div>
            </div>

            <div style="margin-bottom: 5px;">
                <strong>c. Edukasi:</strong><br>
                <?= nl2br($rehab['edukasi']) ?>
                <div class="titik-titik"></div>
            </div>

            <div style="margin-bottom: 5px;">
                <strong>d. Frekuensi Kunjungan:</strong><br>
                <?= nl2br($rehab['frekuensi_kunjungan']) ?>
                <div class="titik-titik"></div>
            </div>
        </div>
    </div>

    <div class="section-title" style="margin-top: 15px;">Rencana Tindak Lanjut (Evaluasi/Rujuk/Selesai)*</div>
    <div class="content-box"><?= nl2br($rehab['rencana_tindak_lanjut']) ?></div>
    <div class="titik-titik"></div>

    <div class="signature">
        <table>
            <tr>
                <td width="60%"></td>
                <td width="40%">
                    <?= isset($setting['kabupaten']) ? $setting['kabupaten'] : 'Kota' ?>,
                    <?= date('d-m-Y', strtotime($rehab['tgl_perawatan'])) ?>
                    <br>
                    Dokter Penanggung Jawab Pelayanan
                    <br><br>
                    <?php if (!empty($rehab['ttd_dokter'])): ?>
                        <img src="<?= $rehab['ttd_dokter'] ?>" style="max-width: 200px; height: auto;">
                        <br>
                    <?php else: ?>
                        <br><br>
                    <?php endif; ?>
                    <u><strong><?= $rehab['nm_dokter'] ?></strong></u><br>
                    NIP. <?= $rehab['kd_dokter'] ?>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
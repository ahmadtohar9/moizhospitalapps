<!DOCTYPE html>
<html>

<head>
    <title>Cetak Penilaian Medis Kandungan</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            margin: 0;
            padding: 15mm 15mm 15mm 15mm;
            box-sizing: border-box;
        }

        * {
            box-sizing: border-box;
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

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        table.data th {
            background-color: #f0f0f0;
            font-weight: bold;
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

    <div class="judul-surat">Penilaian Medis Ralan Kandungan (Obstetri & Ginekologi)</div>

    <div style="font-weight: bold; margin-bottom: 5px;">Identitas Pasien</div>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <td style="width: 25%; padding: 2px 0;"><strong>No. Rekam Medis</strong></td>
            <td style="width: 25%; padding: 2px 0;">: <?= $pasien['no_rkm_medis'] ?></td>
            <td style="width: 25%; padding: 2px 0;"><strong>Tanggal Lahir</strong></td>
            <td style="width: 25%; padding: 2px 0;">: <?= date('d-m-Y', strtotime($pasien['tgl_lahir'])) ?></td>
        </tr>
        <tr>
            <td style="padding: 2px 0;"><strong>Nama Pasien</strong></td>
            <td style="padding: 2px 0;">: <?= $pasien['nm_pasien'] ?></td>
            <td style="padding: 2px 0;"><strong>Umur</strong></td>
            <td style="padding: 2px 0;">: <?= $pasien['umurdaftar'] ?> <?= $pasien['sttsumur'] ?></td>
        </tr>
        <tr>
            <td style="padding: 2px 0;"><strong>Jenis Kelamin</strong></td>
            <td style="padding: 2px 0;">: <?= $pasien['jk'] == 'P' ? 'Perempuan' : 'Laki-laki' ?></td>
            <td style="padding: 2px 0;"><strong>Tgl Pemeriksaan</strong></td>
            <td style="padding: 2px 0;">: <?= date('d-m-Y H:i', strtotime($penilaian['tanggal'])) ?> WIB</td>
        </tr>
        <tr>
            <td style="padding: 2px 0;"><strong>Dokter Pemeriksa</strong></td>
            <td colspan="3" style="padding: 2px 0;">: <?= $penilaian['nm_dokter'] ?></td>
        </tr>
    </table>

    <div class="section-title">Anamnesis</div>
    <div class="content-box">
        <strong>Keluhan Utama:</strong> <?= nl2br($penilaian['keluhan_utama']) ?><br>
        <strong>RPS:</strong> <?= nl2br($penilaian['rps']) ?><br>
        <strong>RPD:</strong> <?= nl2br($penilaian['rpd']) ?><br>
        <strong>Alergi:</strong> <?= $penilaian['alergi'] ?>
    </div>

    <div class="section-title">Tanda Vital</div>
    <table class="data">
        <tr>
            <th>TD</th>
            <th>Nadi</th>
            <th>RR</th>
            <th>Suhu</th>
            <th>SpO2</th>
            <th>BB</th>
            <th>TB</th>
        </tr>
        <tr>
            <td><?= $penilaian['td'] ?> mmHg</td>
            <td><?= $penilaian['nadi'] ?> x/mnt</td>
            <td><?= $penilaian['rr'] ?> x/mnt</td>
            <td><?= $penilaian['suhu'] ?> °C</td>
            <td><?= $penilaian['spo'] ?> %</td>
            <td><?= $penilaian['bb'] ?> kg</td>
            <td><?= $penilaian['tb'] ?> cm</td>
        </tr>
    </table>

    <div class="section-title">Pemeriksaan Fisik</div>
    <table class="data">
        <tr>
            <th>Kepala</th>
            <th>Mata</th>
            <th>THT</th>
            <th>Thoraks</th>
            <th>Abdomen</th>
            <th>Genital</th>
            <th>Ekstremitas</th>
        </tr>
        <tr>
            <td><?= $penilaian['kepala'] ?></td>
            <td><?= $penilaian['mata'] ?></td>
            <td><?= $penilaian['tht'] ?></td>
            <td><?= $penilaian['thoraks'] ?></td>
            <td><?= $penilaian['abdomen'] ?></td>
            <td><?= $penilaian['genital'] ?></td>
            <td><?= $penilaian['ekstremitas'] ?></td>
        </tr>
    </table>
    <?php if (!empty($penilaian['ket_fisik'])): ?>
        <div class="content-box"><strong>Keterangan:</strong> <?= nl2br($penilaian['ket_fisik']) ?></div>
    <?php endif; ?>

    <?php if (!empty($penilaian['tfu']) || !empty($penilaian['djj'])): ?>
        <div class="section-title">Pemeriksaan Obstetri</div>
        <table class="data">
            <tr>
                <th>TFU</th>
                <th>TBJ</th>
                <th>DJJ</th>
                <th>Kontraksi</th>
                <th>His</th>
            </tr>
            <tr>
                <td><?= $penilaian['tfu'] ?> cm</td>
                <td><?= $penilaian['tbj'] ?> gram</td>
                <td><?= $penilaian['djj'] ?> x/mnt</td>
                <td><?= $penilaian['kontraksi'] ?></td>
                <td><?= $penilaian['his'] ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <?php if (!empty($penilaian['inspeksi']) || !empty($penilaian['inspekulo']) || !empty($penilaian['vt'])): ?>
        <div class="section-title">Pemeriksaan Ginekologi</div>
        <div class="content-box">
            <?php if (!empty($penilaian['inspeksi'])): ?>
                <strong>Inspeksi:</strong> <?= nl2br($penilaian['inspeksi']) ?><br>
            <?php endif; ?>
            <?php if (!empty($penilaian['inspekulo'])): ?>
                <strong>Inspekulo:</strong> <?= nl2br($penilaian['inspekulo']) ?><br>
            <?php endif; ?>
            <?php if (!empty($penilaian['vt'])): ?>
                <strong>VT:</strong> <?= nl2br($penilaian['vt']) ?><br>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($penilaian['ultra']) || !empty($penilaian['lab'])): ?>
        <div class="section-title">Pemeriksaan Penunjang</div>
        <div class="content-box">
            <?php if (!empty($penilaian['ultra'])): ?>
                <strong>USG:</strong> <?= nl2br($penilaian['ultra']) ?><br>
            <?php endif; ?>
            <?php if (!empty($penilaian['lab'])): ?>
                <strong>Lab:</strong> <?= nl2br($penilaian['lab']) ?><br>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="section-title">Diagnosis & Tatalaksana</div>
    <div class="content-box">
        <strong>Diagnosis:</strong> <?= nl2br($penilaian['diagnosis']) ?><br>
        <strong>Tatalaksana:</strong> <?= nl2br($penilaian['tata']) ?>
    </div>

    <div class="signature">
        <table>
            <tr>
                <td width="60%"></td>
                <td width="40%">
                    <?= isset($setting['kabupaten']) ? $setting['kabupaten'] : 'Kota' ?>,
                    <?= date('d-m-Y', strtotime($penilaian['tanggal'])) ?>
                    <br>
                    Dokter Pemeriksa
                    <br><br><br><br>
                    <u><strong><?= $penilaian['nm_dokter'] ?></strong></u><br>
                    <?= $penilaian['kd_dokter'] ?>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
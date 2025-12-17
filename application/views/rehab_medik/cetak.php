<!DOCTYPE html>
<html>

<head>
    <title>Cetak Program Rehab Medik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table-data td {
            padding: 4px;
            vertical-align: top;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin: 20px 0;
            text-decoration: underline;
        }

        .content-box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }

        .ttd {
            text-align: center;
            float: right;
            width: 200px;
            margin-top: 30px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <!-- Logo bisa ditambahkan jika ada base64/url -->
        <?php if (!empty($setting['logo'])): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>"
                style="width: 60px; float: left; margin-right: 10px;">
        <?php endif; ?>

        <h2><?= $setting['nama_instansi'] ?></h2>
        <p><?= $setting['alamat_instansi'] ?>, <?= $setting['kabupaten'] ?>, <?= $setting['propinsi'] ?></p>
        <p>Telp: <?= $setting['kontak'] ?> | Email: <?= $setting['email'] ?></p>
    </div>

    <div class="title">LEMBAR PROGRAM TERAPI / REHAB MEDIK</div>

    <table class="table-data mb-4">
        <tr>
            <td width="15%">No. RM</td>
            <td width="2%">:</td>
            <td width="33%"><?= $pasien['no_rkm_medis'] ?></td>
            <td width="15%">Tgl Lahir</td>
            <td width="2%">:</td>
            <td><?= date('d-m-Y', strtotime($pasien['tgl_lahir'])) ?> (<?= $pasien['umur'] ?>)</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td><?= $pasien['nm_pasien'] ?></td>
            <td>JK</td>
            <td>:</td>
            <td><?= $pasien['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td colspan="4"><?= $pasien['alamat'] ?></td>
        </tr>
    </table>

    <div class="content-box">
        <p><span class="label">Subjective (S)</span> : <br><?= nl2br($rehab['subjective']) ?></p>
        <hr style="border-top: 1px dashed #ccc;">

        <p><span class="label">Objective (O)</span> : <br><?= nl2br($rehab['objective']) ?></p>
        <hr style="border-top: 1px dashed #ccc;">

        <p><span class="label">Assessment (A)</span> : <br><?= nl2br($rehab['assessment']) ?></p>
        <hr style="border-top: 1px dashed #ccc;">

        <p><span class="label">Plan / Procedure (P)</span> : <br><?= nl2br($rehab['procedure_text']) ?></p>
    </div>

    <div style="margin-top: 30px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; text-align: center; vertical-align: top;">
                    <p style="margin: 0;"><?= ucfirst(strtolower($setting['kabupaten'])) ?>,
                        <?= date('d-m-Y', strtotime($rehab['tgl_perawatan'])) ?>
                    </p>
                    <p style="margin: 0;">Dokter Penanggung Jawab Pelayanan,</p>
                    <br><br><br><br>
                    <p style="margin: 0; text-decoration: underline; font-weight: bold;">
                        <?= $rehab['nm_dokter'] ?? '..................................' ?>
                    </p>
                    <p style="margin: 0;">NIP. <?= $rehab['kd_dokter'] ?></p>
                </td>
                <td style="width: 50%; text-align: center; vertical-align: top;">
                    <br>
                    <p style="margin: 0;">Tim Rehabilitasi Medik</p>
                    <br><br><br><br>
                    <p style="margin: 0; text-decoration: underline; font-weight: bold;">
                        <?= $rehab['nm_petugas'] ?? '..................................' ?>
                    </p>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
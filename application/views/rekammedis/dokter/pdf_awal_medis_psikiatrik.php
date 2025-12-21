<!DOCTYPE html>
<html>

<head>
    <title>Asesmen Awal Medis PSIKIATRIK</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table-data th,
        .table-data td {
            padding: 4px;
            vertical-align: top;
            text-align: left;
        }

        .table-data th {
            width: 150px;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 5px;
            text-decoration: underline;
            background: #eee;
            padding: 2px;
        }

        .box {
            border: 1px solid #000;
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <table width="100%">
            <tr>
                <td width="10%" align="left" style="vertical-align:middle;">
                    <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>" width="70px">
                </td>
                <td align="center" style="vertical-align:middle;">
                    <h2 style="margin:0; font-size:18px;"><?= strtoupper($setting['nama_instansi']) ?></h2>
                    <p style="margin:2px 0; font-size:12px;"><?= $setting['alamat_instansi'] ?></p>
                    <p style="margin:0; font-size:12px;">Telp: <?= $setting['kontak'] ?> | Email:
                        <?= $setting['email'] ?>
                    </p>
                </td>
                <td width="10%" align="right" style="vertical-align:middle;"></td>
            </tr>
        </table>
    </div>

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS PSIKIATRIK</h3>

    <table width="100%">
        <tr>
            <td width="15%">No. RM</td>
            <td width="35%">: <?= $detail_pasien['no_rkm_medis'] ?></td>
            <td width="15%">Nama Pasien</td>
            <td width="35%">: <?= $detail_pasien['nm_pasien'] ?></td>
        </tr>
        <tr>
            <td>Tgl. Lahir</td>
            <td>: <?= date('d-m-Y', strtotime($detail_pasien['tgl_lahir'])) ?></td>
            <td>JK</td>
            <td>: <?= $detail_pasien['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
        </tr>
        <tr>
            <td>Tanggal Asesmen</td>
            <td>: <?= date('d-m-Y H:i', strtotime($asesment['tanggal'])) ?></td>
            <td>Dokter</td>
            <td>: <?= $detail_pasien['nm_dokter'] ?></td>
        </tr>
    </table>

    <div class="section-title">I. ANAMNESIS (<?= $asesment['anamnesis'] ?>)</div>
    <?php if ($asesment['anamnesis'] == 'Alloanamnesis'): ?>
        <p><b>Hubungan:</b> <?= $asesment['hubungan'] ?></p>
    <?php endif; ?>

    <table class="table-data">
        <tr>
            <th>Keluhan Utama</th>
            <td>: <?= nl2br($asesment['keluhan_utama']) ?></td>
        </tr>
        <tr>
            <th>Riw. Penyakit Sekarang</th>
            <td>: <?= nl2br($asesment['rps']) ?></td>
        </tr>
        <tr>
            <th>Riw. Penyakit Dahulu</th>
            <td>: <?= nl2br($asesment['rpd']) ?></td>
        </tr>
        <tr>
            <th>Riw. Penyakit Keluarga</th>
            <td>: <?= nl2br($asesment['rpk']) ?></td>
        </tr>
        <tr>
            <th>Riw. Penggunaan Obat</th>
            <td>: <?= nl2br($asesment['rpo']) ?></td>
        </tr>
        <tr>
            <th>Riwayat Alergi</th>
            <td>: <?= $asesment['alergi'] ?></td>
        </tr>
    </table>

    <div class="section-title">II. STATUS PSIKIATRIK</div>
    <table class="table-data">
        <tr>
            <th width="30%">Penampilan</th>
            <td>: <?= $asesment['penampilan'] ?></td>
        </tr>
        <tr>
            <th>Pembicaraan</th>
            <td>: <?= $asesment['pembicaraan'] ?></td>
        </tr>
        <tr>
            <th>Psikomotor</th>
            <td>: <?= $asesment['psikomotor'] ?></td>
        </tr>
        <tr>
            <th>Sikap</th>
            <td>: <?= $asesment['sikap'] ?></td>
        </tr>
        <tr>
            <th>Mood / Afek</th>
            <td>: <?= $asesment['mood'] ?></td>
        </tr>
        <tr>
            <th>Fungsi Kognitif</th>
            <td>: <?= $asesment['fungsi_kognitif'] ?></td>
        </tr>
        <tr>
            <th>Gangguan Persepsi</th>
            <td>: <?= $asesment['gangguan_persepsi'] ?></td>
        </tr>
        <tr>
            <th>Proses Pikir</th>
            <td>: <?= $asesment['proses_pikir'] ?></td>
        </tr>
        <tr>
            <th>Pengendalian Impuls</th>
            <td>: <?= $asesment['pengendalian_impuls'] ?></td>
        </tr>
        <tr>
            <th>Tilikan</th>
            <td>: <?= $asesment['tilikan'] ?></td>
        </tr>
        <tr>
            <th>RTA</th>
            <td>: <?= $asesment['rta'] ?></td>
        </tr>
    </table>

    <div class="section-title">III. PEMERIKSAAN FISIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="33%"><b>Keadaan Umum:</b> <?= $asesment['keadaan'] ?></td>
            <td width="33%"><b>Kesadaran:</b> <?= $asesment['kesadaran'] ?></td>
            <td width="33%"><b>GCS:</b> <?= $asesment['gcs'] ?></td>
        </tr>
    </table>
    <table width="100%" cellpadding="3">
        <tr>
            <td><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
            <td><b>Suhu:</b> <?= $asesment['suhu'] ?> &deg;C</td>
            <td><b>SpO2:</b> <?= $asesment['spo'] ?> %</td>
            <td><b>BB:</b> <?= $asesment['bb'] ?> kg</td>
            <td><b>TB:</b> <?= $asesment['tb'] ?> cm</td>
        </tr>
    </table>

    <div class="section-title">IV. PEMERIKSAAN SISTEMIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="25%"><b>Kepala:</b> <?= $asesment['kepala'] ?></td>
            <td width="25%"><b>Gigi & Mulut:</b> <?= $asesment['gigi'] ?></td>
            <td width="25%"><b>THT:</b> <?= $asesment['tht'] ?></td>
            <td width="25%"><b>Thoraks:</b> <?= $asesment['thoraks'] ?></td>
        </tr>
        <tr>
            <td><b>Abdomen:</b> <?= $asesment['abdomen'] ?></td>
            <td><b>Genital:</b> <?= $asesment['genital'] ?></td>
            <td><b>Ekstremitas:</b> <?= $asesment['ekstremitas'] ?></td>
            <td><b>Kulit:</b> <?= $asesment['kulit'] ?></td>
        </tr>
    </table>
    <?php if (!empty($asesment['ket_fisik'])): ?>
        <p><b>Keterangan Fisik:</b><br><?= nl2br($asesment['ket_fisik']) ?></p>
    <?php endif; ?>

    <div class="section-title">V. PEMERIKSAAN PENUNJANG</div>
    <p><?= nl2br($asesment['penunjang']) ?: '-' ?></p>

    <div class="section-title">VI. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr>
            <th>Diagnosis</th>
            <td>: <?= nl2br($asesment['diagnosis']) ?></td>
        </tr>
        <tr>
            <th>Tatalaksana</th>
            <td>: <?= nl2br($asesment['tata']) ?></td>
        </tr>
        <tr>
            <th>Konsul/Rujuk</th>
            <td>: <?= nl2br($asesment['konsulrujuk']) ?></td>
        </tr>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Dokter Penanggung Jawab,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>

</body>

</html>
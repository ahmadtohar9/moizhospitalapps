<!DOCTYPE html>
<html>

<head>
    <title>Asesmen Awal Medis THT</title>
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

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS THT</h3>

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
            <th>Riw. Penggunaan Obat</th>
            <td>: <?= nl2br($asesment['rpo']) ?></td>
        </tr>
        <tr>
            <th>Riwayat Alergi</th>
            <td>: <?= $asesment['alergi'] ?></td>
        </tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="25%"><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td width="25%"><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td width="25%"><b>Suhu:</b> <?= $asesment['suhu'] ?> &deg;C</td>
            <td width="25%"><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
        </tr>
        <tr>
            <td><b>BB:</b> <?= $asesment['bb'] ?> Kg</td>
            <td><b>TB:</b> <?= $asesment['tb'] ?> cm</td>
            <td><b>Nyeri:</b> <?= $asesment['nyeri'] ?></td>
            <td><b>Status Nutrisi:</b> <?= $asesment['status_nutrisi'] ?></td>
        </tr>
    </table>

    <?php if (!empty($asesment['kondisi'])): ?>
        <div class="box">
            <b>Kondisi Umum:</b><br>
            <?= nl2br($asesment['kondisi']) ?>
        </div>
    <?php endif; ?>

    <div class="section-title">III. STATUS LOKALIS THT</div>
    <?php if (!empty($asesment['ket_lokalis'])): ?>
        <p><b>Keterangan:</b> <?= nl2br($asesment['ket_lokalis']) ?></p>
    <?php endif; ?>
    <div style="text-align: center; margin: 10px 0;">
        <?php if (file_exists($lokalis_path)): ?>
            <img src="<?= $lokalis_path ?>" style="width: 100%; max-width: 600px; border: 1px solid #ccc;">
        <?php else: ?>
            <p><i>Tidak ada gambar lokalis.</i></p>
        <?php endif; ?>
    </div>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <table class="table-data">
        <tr>
            <th>Laboratorium</th>
            <td>: <?= nl2br($asesment['lab']) ?></td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td>: <?= nl2br($asesment['rad']) ?></td>
        </tr>
        <tr>
            <th>Tes Pendengaran</th>
            <td>: <?= nl2br($asesment['tes_pendengaran']) ?></td>
        </tr>
        <tr>
            <th>Penunjang Lain</th>
            <td>: <?= nl2br($asesment['penunjang']) ?></td>
        </tr>
    </table>

    <div class="section-title">V. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr>
            <th>Diagnosis Utama</th>
            <td>: <?= nl2br($asesment['diagnosis']) ?></td>
        </tr>
        <tr>
            <th>Diagnosis Banding</th>
            <td>: <?= nl2br($asesment['diagnosisbanding']) ?></td>
        </tr>
        <tr>
            <th>Permasalahan</th>
            <td>: <?= nl2br($asesment['permasalahan']) ?></td>
        </tr>
        <tr>
            <th>Terapi/Pengobatan</th>
            <td>: <?= nl2br($asesment['terapi']) ?></td>
        </tr>
        <tr>
            <th>Tindakan</th>
            <td>: <?= nl2br($asesment['tindakan']) ?></td>
        </tr>
        <tr>
            <th>Tatalaksana</th>
            <td>: <?= nl2br($asesment['tatalaksana']) ?></td>
        </tr>
        <tr>
            <th>Edukasi</th>
            <td>: <?= nl2br($asesment['edukasi']) ?></td>
        </tr>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Dokter Penanggung Jawab,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>

</body>

</html>
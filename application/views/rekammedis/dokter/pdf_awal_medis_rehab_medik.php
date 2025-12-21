<!DOCTYPE html>
<html>

<head>
    <title>Asesmen Awal Medis Rehab Medik</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
        }

        .section {
            font-weight: bold;
            background: #eee;
            padding: 3px;
            border-bottom: 1px solid #ccc;
            margin-top: 10px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        td,
        th {
            padding: 4px;
            vertical-align: top;
        }

        .data-label {
            width: 30%;
            font-weight: bold;
        }

        .data-value {
            width: 70%;
        }

        .box {
            border: 1px solid #000;
            padding: 5px;
            margin-top: 5px;
        }

        .grid-table td {
            border: 1px solid #ccc;
        }

        .grid-table th {
            border: 1px solid #000;
            background: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td width="10%"><img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>" width="60px">
                </td>
                <td align="center">
                    <h2 style="margin:0;"><?= strtoupper($setting['nama_instansi']) ?></h2>
                    <p style="margin:0; font-size:10px;"><?= $setting['alamat_instansi'] ?></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="title">ASESMEN AWAL MEDIS REHAB MEDIK</div>

    <table>
        <tr>
            <td width="15%"><b>No. RM</b></td>
            <td width="35%">: <?= $detail_pasien['no_rkm_medis'] ?></td>
            <td width="15%"><b>Nama Pasien</b></td>
            <td width="35%">: <?= $detail_pasien['nm_pasien'] ?></td>
        </tr>
        <tr>
            <td><b>Tgl Lahir</b></td>
            <td>: <?= date('d-m-Y', strtotime($detail_pasien['tgl_lahir'])) ?></td>
            <td><b>Dokter</b></td>
            <td>: <?= $detail_pasien['nm_dokter'] ?></td>
        </tr>
    </table>

    <div class="section">I. ANAMNESIS (<?= $asesment['anamnesis'] ?>)</div>
    <table>
        <tr>
            <td class="data-label">Keluhan Utama</td>
            <td>: <?= nl2br($asesment['keluhan_utama']) ?></td>
        </tr>
        <tr>
            <td class="data-label">RPS</td>
            <td>: <?= nl2br($asesment['rps']) ?></td>
        </tr>
        <tr>
            <td class="data-label">RPD</td>
            <td>: <?= nl2br($asesment['rpd']) ?></td>
        </tr>
        <tr>
            <td class="data-label">Alergi</td>
            <td>: <?= $asesment['alergi'] ?></td>
        </tr>
    </table>

    <br>
    <b>II. TANDA VITAL</b>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-size: 11px;">
        <tr>
            <td width="33%"><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td width="33%"><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td width="33%"><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
        </tr>
        <tr>
            <td><b>Suhu:</b> <?= $asesment['suhu'] ?> °C</td>
            <td><b>BB:</b> <?= $asesment['bb'] ?> kg</td>
            <td><b>Kesadaran:</b> <?= $asesment['kesadaran'] ?></td>
        </tr>
    </table>

    <div style="margin-top: 10px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
        <b>Penilaian Nyeri:</b> Skala <?= $asesment['skala_nyeri'] ?> - <?= $asesment['nyeri'] ?>
        <br><br>
        
    <?php if(file_exists(FCPATH . 'assets/images/skala_nyeri.png')): ?>
        <center><img src="assets/images/skala_nyeri.png" style="width: 300px;"></center>
        <br>
    <?php endif; ?>

    <!-- Visual Table Scale for PDF -->
        <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 10px; text-align: center;">
            <tr>
                <?php
                $colors = [
                    0 => '#4caf50',
                    1 => '#5db756',
                    2 => '#6ebf5c',
                    3 => '#7fc762', // Greens
                    4 => '#ffeb3b',
                    5 => '#fec830',
                    6 => '#fda525', // Yellow/Orange
                    7 => '#fc821a',
                    8 => '#fb6010',
                    9 => '#fa3d05',
                    10 => '#f44336' // Reds
                ];
                for ($i = 0; $i <= 10; $i++):
                    $bg = $colors[$i];
                    $isSelected = ($asesment['skala_nyeri'] == $i);
                    $border = $isSelected ? '3px solid #000' : '1px solid #fff';
                    $height = $isSelected ? '25px' : '20px';
                    $marker = $isSelected ? '<div style="background:white; border-radius:50%; width:14px; height:14px; margin:auto; border:1px solid #000; line-height:14px;">X</div>' : '';
                    ?>
                    <td
                        style="background-color: <?= $bg ?>; width: 9%; height: 30px; border: <?= $border ?>; color: white; font-weight: bold; vertical-align: middle;">
                        <?= $i ?><br>
                        <?= $marker ?>
                    </td>
                <?php endfor; ?>
            </tr>
        </table>
        <div style="width: 100%; display: flex; justify-content: space-between; font-size: 9px; margin-top: 5px;">
            <span style="float:left">0 (Tidak Nyeri)</span>
            <span style="float:right">10 (Sangat Hebat)</span>
            <center>5 (Sedang)</center>
        </div>
    </div>

    <br>
    <div class="section">III. PEMERIKSAAN SISTEMIK</div>
    <table class="grid-table">
        <tr>
            <th width="30%">Sistem</th>
            <th width="20%">Status</th>
            <th width="50%">Keterangan</th>
        </tr>
        <?php
        $systems = [
            'Kepala/Leher' => 'kepala',
            'Thorak/Jantung/Paru' => 'thoraks',
            'Abdomen' => 'abdomen',
            'Ekstremitas' => 'ekstremitas',
            'Columna Vertebralis' => 'columna',
            'Muskuloskeletal' => 'muskulos'
        ];
        foreach ($systems as $label => $key):
            ?>
            <tr>
                <td><?= $label ?></td>
                <td align="center"><?= $asesment[$key] ?></td>
                <td><?= $asesment['keterangan_' . $key] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($asesment['lainnya']): ?>
        <p><b>Pemeriksaan Lainnya:</b><br><?= nl2br($asesment['lainnya']) ?></p>
    <?php endif; ?>

    <div class="section">IV. PENILAIAN RISIKO & FUNGSIONAL</div>
    <table>
        <tr>
            <td><b>Risiko Jatuh:</b> <?= $asesment['resiko_jatuh'] ?></td>
        </tr>
        <tr>
            <td><b>Risiko Nutrisional:</b> <?= $asesment['resiko_nutrisional'] ?></td>
        </tr>
        <tr>
            <td><b>Kebutuhan Fungsional:</b> <?= $asesment['kebutuhan_fungsional'] ?></td>
        </tr>
    </table>

    <div class="section">V. DIAGNOSIS</div>
    <table>
        <tr>
            <td width="30%"><b>Diagnosa Medis</b></td>
            <td>: <?= nl2br($asesment['diagnosa_medis']) ?></td>
        </tr>
        <tr>
            <td><b>Diagnosa Fungsi</b></td>
            <td>: <?= nl2br($asesment['diagnosa_fungsi']) ?></td>
        </tr>
    </table>

    <div class="section">VI. PROGRAM TERAPI</div>
    <?php if ($asesment['penunjang_lain']): ?>
        <p><b>Penunjang Lain:</b> <?= $asesment['penunjang_lain'] ?></p>
    <?php endif; ?>

    <table class="grid-table">
        <tr>
            <th>Jenis Terapi</th>
            <th>Tindakan / Keterangan</th>
            <th>Rencana Tanggal</th>
        </tr>
        <tr>
            <td>Fisioterapi</td>
            <td><?= $asesment['fisio'] ?></td>
            <td align="center">
                <?= ($asesment['fisioterapi'] != '0000-00-00') ? date('d-m-Y', strtotime($asesment['fisioterapi'])) : '-' ?>
            </td>
        </tr>
        <tr>
            <td>Okupasi Terapi</td>
            <td><?= $asesment['okupasi'] ?></td>
            <td align="center">
                <?= ($asesment['terapi_okupasi'] != '0000-00-00') ? date('d-m-Y', strtotime($asesment['terapi_okupasi'])) : '-' ?>
            </td>
        </tr>
        <tr>
            <td>Terapi Wicara</td>
            <td><?= $asesment['wicara'] ?></td>
            <td align="center">
                <?= ($asesment['terapi_wicara'] != '0000-00-00') ? date('d-m-Y', strtotime($asesment['terapi_wicara'])) : '-' ?>
            </td>
        </tr>
        <tr>
            <td>Akupuntur</td>
            <td><?= $asesment['akupuntur'] ?></td>
            <td align="center">
                <?= ($asesment['terapi_akupuntur'] != '0000-00-00') ? date('d-m-Y', strtotime($asesment['terapi_akupuntur'])) : '-' ?>
            </td>
        </tr>
        <tr>
            <td>Tata Laksana Lain</td>
            <td><?= $asesment['tatalain'] ?></td>
            <td align="center">
                <?= ($asesment['terapi_lainnya'] != '0000-00-00') ? date('d-m-Y', strtotime($asesment['terapi_lainnya'])) : '-' ?>
            </td>
        </tr>
    </table>

    <p style="margin-top:10px;"><b>Frekuensi Terapi:</b> <?= $asesment['frekuensi_terapi'] ?></p>

    <?php if ($asesment['edukasi']): ?>
        <div class="box">
            <b>Edukasi:</b><br><?= nl2br($asesment['edukasi']) ?>
        </div>
    <?php endif; ?>

    <div style="float: right; text-align: center; margin-top: 30px;">
        <p>Dokter Pemeriksa,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>
</body>

</html>
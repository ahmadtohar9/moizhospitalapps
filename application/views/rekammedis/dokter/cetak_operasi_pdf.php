<!DOCTYPE html>
<html>

<head>
    <title>Laporan Operasi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .rs-name {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .rs-address {
            font-size: 10pt;
            margin-top: 5px;
        }

        .doc-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td,
        th {
            padding: 4px;
            vertical-align: top;
        }

        .info-table td {
            padding: 2px;
        }

        .bordered {
            width: 100%;
            border: 1px solid #000;
        }

        .bordered th,
        .bordered td {
            border: 1px solid #000;
            padding: 5px;
        }

        .bordered th {
            background-color: #f0f0f0;
        }

        .section-header {
            background-color: #ddd;
            font-weight: bold;
            padding: 5px;
            border: 1px solid #000;
            margin-top: 15px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            width: 100%;
        }

        .signature div {
            display: inline-block;
            width: 200px;
            text-align: center;
        }

        .signature p {
            margin-top: 60px;
            font-weight: bold;
            border-bottom: 1px solid #000;
        }

        .row {
            clear: both;
        }

        .col-left {
            float: left;
            width: 50%;
        }

        .col-right {
            float: right;
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="rs-name">RUMAH SAKIT UMUM MOIZ</div>
        <div class="rs-address">Jl. Kesehatan No. 123, Kota Medis, Indonesia<br>Telp: (021) 555-1234</div>
    </div>

    <div class="doc-title">LAPORAN OPERASI</div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>No. Rawat</strong></td>
            <td width="35%">: <?= $data['no_rawat'] ?></td>
            <td width="15%"><strong>Tgl Operasi</strong></td>
            <td width="35%">: <?= date('d-m-Y H:i', strtotime($data['tgl_operasi'])) ?></td>
        </tr>
        <tr>
            <td><strong>Paket Operasi</strong></td>
            <td>: <?= $data['nm_paket_operasi'] ?></td>
            <td><strong>Selesai</strong></td>
            <td>: <?= $data['selesaioperasi'] ? date('H:i', strtotime($data['selesaioperasi'])) : '-' ?></td>
        </tr>
        <tr>
            <td><strong>Operator</strong></td>
            <td>: <?= $data['nm_operator1'] ?></td>
            <td><strong>Status</strong></td>
            <td>: <?= $data['status'] ?></td>
        </tr>
        <tr>
            <td><strong>Jenis Anestesi</strong></td>
            <td>: <?= $data['jenis_anasthesi'] ?> (<?= $data['kategori'] ?>)</td>
        </tr>
    </table>

    <div class="section-header">DATA KLINIS PRA-OPERASI (Tanda Vital & SOAP Terakhir)</div>
    <table class="bordered">
        <tr>
            <td width="12%"><strong>Suhu</strong>: <?= $soap['suhu_tubuh'] ?? '-' ?> &deg;C</td>
            <td width="15%"><strong>Tensi</strong>: <?= $soap['tensi'] ?? '-' ?> mmHg</td>
            <td width="12%"><strong>Nadi</strong>: <?= $soap['nadi'] ?? '-' ?> x/m</td>
            <td width="12%"><strong>RR</strong>: <?= $soap['respirasi'] ?? '-' ?> x/m</td>
            <td width="12%"><strong>TB</strong>: <?= $soap['tinggi'] ?? '-' ?> cm</td>
            <td width="12%"><strong>BB</strong>: <?= $soap['berat'] ?? '-' ?> kg</td>
            <td width="12%"><strong>SPO2</strong>: <?= $soap['spo2'] ?? '-' ?> %</td>
            <td width="13%"><strong>GCS</strong>: <?= $soap['gcs'] ?? '-' ?></td>
        </tr>
    </table>
    <table class="bordered" style="margin-top:-1px">
        <tr>
            <td width="15%"><strong>Keluhan (S)</strong></td>
            <td><?= $soap['keluhan'] ?? '-' ?></td>
        </tr>
        <tr>
            <td><strong>Pemeriksaan (O)</strong></td>
            <td><?= $soap['pemeriksaan'] ?? '-' ?></td>
        </tr>
        <tr>
            <td><strong>Penilaian (A)</strong></td>
            <td><?= $soap['penilaian'] ?? '-' ?></td>
        </tr>
        <tr>
            <td><strong>Rencana (P)</strong></td>
            <td><?= $soap['rtl'] ?? '-' ?></td>
        </tr>
    </table>

    <div class="section-header">A. LAPORAN & DIAGNOSA</div>
    <table class="bordered">
        <tr>
            <td width="25%"><strong>Diagnosa Pre-Op</strong></td>
            <td><?= $data['diagnosa_preop'] ?: '-' ?></td>
        </tr>
        <tr>
            <td><strong>Diagnosa Post-Op</strong></td>
            <td><?= $data['diagnosa_postop'] ?: '-' ?></td>
        </tr>
        <tr>
            <td><strong>Jaringan Eksisi</strong></td>
            <td><?= $data['jaringan_dieksekusi'] ?: '-' ?></td>
        </tr>
        <tr>
            <td><strong>Permintaan PA</strong></td>
            <td><?= $data['permintaan_pa'] ?? 'Tidak' ?></td>
        </tr>
        <tr>
            <td><strong>No. Implan</strong></td>
            <td><?= $data['nomor_implan'] ?? '-' ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Laporan Jalannya Operasi:</strong><br><br>
                <?= nl2br($data['laporan_operasi'] ?: '-') ?>
            </td>
        </tr>
    </table>

    <div class="section-header">B. TIM OPERASI</div>
    <table class="bordered">
        <thead>
            <tr>
                <th>Peran</th>
                <th>Nama Petugas / Dokter</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr>
                <td>Operator Utama</td>
                <td><?= $data['nm_operator1'] ?></td>
            </tr>
            <?php if ($data['nm_operator2'] && $data['nm_operator2'] !== '-')
                echo "<tr><td>Operator 2</td><td>{$data['nm_operator2']}</td></tr>"; ?>
            <?php if ($data['nm_operator3'] && $data['nm_operator3'] !== '-')
                echo "<tr><td>Operator 3</td><td>{$data['nm_operator3']}</td></tr>"; ?>
            <?php if ($data['nm_dokter_anestesi'] && $data['nm_dokter_anestesi'] !== '-')
                echo "<tr><td>Dr. Anestesi</td><td>{$data['nm_dokter_anestesi']}</td></tr>"; ?>
            <?php if ($data['nm_dokter_anak'] && $data['nm_dokter_anak'] !== '-')
                echo "<tr><td>Dr. Anak</td><td>{$data['nm_dokter_anak']}</td></tr>"; ?>
            <?php if ($data['nm_asisten_operator1'] && $data['nm_asisten_operator1'] !== '-')
                echo "<tr><td>Asisten Op 1</td><td>{$data['nm_asisten_operator1']}</td></tr>"; ?>
            <?php if ($data['nm_asisten_operator2'] && $data['nm_asisten_operator2'] !== '-')
                echo "<tr><td>Asisten Op 2</td><td>{$data['nm_asisten_operator2']}</td></tr>"; ?>
            <?php if ($data['nm_asisten_operator3'] && $data['nm_asisten_operator3'] !== '-')
                echo "<tr><td>Asisten Op 3</td><td>{$data['nm_asisten_operator3']}</td></tr>"; ?>
            <?php if ($data['nm_asisten_anestesi'] && $data['nm_asisten_anestesi'] !== '-')
                echo "<tr><td>Asisten Anestesi</td><td>{$data['nm_asisten_anestesi']}</td></tr>"; ?>
            <?php if ($data['nm_asisten_anestesi2'] && $data['nm_asisten_anestesi2'] !== '-')
                echo "<tr><td>Asisten Anestesi 2</td><td>{$data['nm_asisten_anestesi2']}</td></tr>"; ?>
            <?php if ($data['nm_instrumen'] && $data['nm_instrumen'] !== '-')
                echo "<tr><td>Instrumen</td><td>{$data['nm_instrumen']}</td></tr>"; ?>
            <?php if ($data['nm_omloop'] && $data['nm_omloop'] !== '-')
                echo "<tr><td>Omloop</td><td>{$data['nm_omloop']}</td></tr>"; ?>
            <?php if ($data['nm_omloop2'] && $data['nm_omloop2'] !== '-')
                echo "<tr><td>Omloop 2</td><td>{$data['nm_omloop2']}</td></tr>"; ?>
            <?php if ($data['nm_omloop3'] && $data['nm_omloop3'] !== '-')
                echo "<tr><td>Omloop 3</td><td>{$data['nm_omloop3']}</td></tr>"; ?>
            <?php if ($data['nm_omloop4'] && $data['nm_omloop4'] !== '-')
                echo "<tr><td>Omloop 4</td><td>{$data['nm_omloop4']}</td></tr>"; ?>
            <?php if ($data['nm_omloop5'] && $data['nm_omloop5'] !== '-')
                echo "<tr><td>Omloop 5</td><td>{$data['nm_omloop5']}</td></tr>"; ?>
            <?php if ($data['nm_perawat_resusitas'] && $data['nm_perawat_resusitas'] !== '-')
                echo "<tr><td>Perawat Resusitasi</td><td>{$data['nm_perawat_resusitas']}</td></tr>"; ?>
            <?php if ($data['nm_perawat_luar'] && $data['nm_perawat_luar'] !== '-')
                echo "<tr><td>Perawat Luar</td><td>{$data['nm_perawat_luar']}</td></tr>"; ?>
            <?php if ($data['nm_bidan'] && $data['nm_bidan'] !== '-')
                echo "<tr><td>Bidan</td><td>{$data['nm_bidan']}</td></tr>"; ?>
            <?php if ($data['nm_bidan2'] && $data['nm_bidan2'] !== '-')
                echo "<tr><td>Bidan 2</td><td>{$data['nm_bidan2']}</td></tr>"; ?>
            <?php if ($data['nm_bidan3'] && $data['nm_bidan3'] !== '-')
                echo "<tr><td>Bidan 3</td><td>{$data['nm_bidan3']}</td></tr>"; ?>
        </tbody>
    </table>

    <div class="signature">
        <div style="float:right;">
            Kota Medis, <?= date('d-m-Y', strtotime($data['tgl_operasi'])) ?>
            <br>Dokter Operator
            <p style="margin-top:70px;"><?= $data['nm_operator1'] ?></p>
        </div>
    </div>
</body>

</html>
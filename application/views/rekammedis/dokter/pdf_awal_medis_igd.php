<!DOCTYPE html>
<html>

<head>
    <title>Asesmen Awal IGD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 5px;
        }

        .title {
            font-size: 14px;
            margin-bottom: 10px;
            text-decoration: underline;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .table-bor td,
        .table-bor th {
            border: 1px solid #000;
            padding: 3px;
        }

        .section-title {
            font-weight: bold;
            background-color: #eee;
            padding: 3px;
            margin-top: 10px;
            border: 1px solid #000;
        }

        .row-label {
            width: 150px;
            font-weight: bold;
            vertical-align: top;
        }

        .signature {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div style="font-size: 16px;"><?= $setting['nama_instansi']; ?></div>
        <div style="font-size: 10px; font-weight: normal;"><?= $setting['alamat_instansi']; ?></div>
    </div>

    <div class="title">ASESMEN AWAL MEDIS GAWAT DARURAT</div>

    <table>
        <tr>
            <td width="15%">No. RM</td>
            <td width="35%">: <?= $detail_pasien['no_rkm_medis']; ?></td>
            <td width="15%">Nama Pasien</td>
            <td width="35%">: <?= $detail_pasien['nm_pasien']; ?></td>
        </tr>
        <tr>
            <td>Tgl. Lahir / JK</td>
            <td>: <?= date('d-m-Y', strtotime($detail_pasien['tgl_lahir'])); ?> / <?= $detail_pasien['jk']; ?> /
                <?= $detail_pasien['umurdaftar']; ?> Th
            </td>
            <td>No. Rawat</td>
            <td>: <?= $asesment['no_rawat']; ?></td>
        </tr>
        <tr>
            <td>Poliklinik</td>
            <td>: <?= $detail_pasien['nm_poli']; ?></td>
            <td>Cara Bayar</td>
            <td>: <?= $detail_pasien['png_jawab']; ?></td>
        </tr>
        <tr>
            <td>Tgl. Asesmen</td>
            <td>: <?= date('d-m-Y H:i:s', strtotime($asesment['tanggal'])); ?></td>
            <td>Dokter</td>
            <td>: <?= $detail_pasien['nm_dokter']; ?></td>
        </tr>
    </table>

    <div class="section-title">I. RIWAYAT KESEHATAN</div>
    <table>
        <tr>
            <td class="row-label">Anamnesis</td>
            <td>: <?= $asesment['anamnesis']; ?></td>
        </tr>
        <tr>
            <td class="row-label">Keluhan Utama</td>
            <td>: <?= nl2br($asesment['keluhan_utama']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Riw. Penyakit Sekarang</td>
            <td>: <?= nl2br($asesment['rps']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Riw. Penyakit Dahulu</td>
            <td>: <?= nl2br($asesment['rpd']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Riw. Penyakit Keluarga</td>
            <td>: <?= nl2br($asesment['rpk'] ?? '-'); ?></td>
        </tr>
        <tr>
            <td class="row-label">Riw. Penggunaan Obat</td>
            <td>: <?= nl2br($asesment['rpo']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Alergi</td>
            <td>: <?= $asesment['alergi']; ?></td>
        </tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <table width="100%">
        <tr>
            <td><strong>KU:</strong> <?= $asesment['keadaan']; ?></td>
            <td><strong>Kesadaran:</strong> <?= $asesment['kesadaran']; ?></td>
            <td><strong>GCS:</strong> <?= $asesment['gcs']; ?></td>
            <td><strong>TD:</strong> <?= $asesment['td']; ?> mmHg</td>
        </tr>
        <tr>
            <td><strong>Nadi:</strong> <?= $asesment['nadi']; ?> x/m</td>
            <td><strong>RR:</strong> <?= $asesment['rr']; ?> x/m</td>
            <td><strong>Suhu:</strong> <?= $asesment['suhu']; ?> C</td>
            <td><strong>SpO2:</strong> <?= $asesment['spo'] ?? ($asesment['spo2'] ?? '-'); ?> %</td>
        </tr>
        <tr>
            <td><strong>BB:</strong> <?= $asesment['bb']; ?> Kg</td>
            <td><strong>TB:</strong> <?= $asesment['tb']; ?> cm</td>
            <td colspan="2"></td>
        </tr>
    </table>
    <br>
    <table class="table-bor">
        <tr>
            <td><strong>Kepala:</strong> <?= $asesment['kepala']; ?></td>
            <td><strong>Mata:</strong> <?= $asesment['mata']; ?></td>
            <td><strong>Gigi & Mulut:</strong> <?= $asesment['gigi'] ?? '-'; ?></td>
            <td><strong>Leher:</strong> <?= $asesment['leher'] ?? '-'; ?></td>
        </tr>
        <tr>
            <td><strong>Thoraks:</strong> <?= $asesment['thoraks']; ?></td>
            <td><strong>Abdomen:</strong> <?= $asesment['abdomen']; ?></td>
            <td><strong>Genital:</strong> <?= $asesment['genital'] ?? '-'; ?></td>
            <td><strong>Ekstremitas:</strong> <?= $asesment['ekstremitas']; ?></td>
        </tr>
    </table>
    <div style="margin-top: 5px;"><strong>Ket. Fisik Lain:</strong> <?= nl2br($asesment['ket_fisik']); ?></div>

    <div class="section-title">III. STATUS LOKALIS</div>
    <?php if (isset($lokalis_path) && !empty($lokalis_path)): ?>
        <div style="text-align:center; padding: 10px;">
            <!-- Use Absolute Path for mPDF -->
            <img src="<?= $lokalis_path; ?>" style="max-width: 100%; max-height: 400px;">
        </div>
    <?php else: ?>
        <div style="text-align:center; padding: 20px; color: #888;">(Tidak ada gambar lokalis)</div>
    <?php endif; ?>
    <div><strong>Keterangan:</strong> <?= nl2br($asesment['ket_lokalis'] ?? ''); ?></div>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <table>
        <tr>
            <td class="row-label">EKG</td>
            <td>: <?= nl2br($asesment['ekg']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Radiologi</td>
            <td>: <?= nl2br($asesment['rad']); ?></td>
        </tr>
        <tr>
            <td class="row-label">Laboratorium</td>
            <td>: <?= nl2br($asesment['lab']); ?></td>
        </tr>
    </table>

    <div class="section-title">V. DIAGNOSIS / ASESMEN</div>
    <div><?= nl2br($asesment['diagnosis']); ?></div>

    <div class="section-title">VI. TATALAKSANA</div>
    <div><?= nl2br($asesment['tata'] ?? ($asesment['tata_laksana'] ?? '')); ?></div>

    <table style="margin-top: 50px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">
                Dokter Yang Memeriksa,<br><br><br><br>
                ( <?= $detail_pasien['nm_dokter']; ?> )
            </td>
        </tr>
    </table>

</body>

</html>
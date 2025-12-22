<!DOCTYPE html>
<html>
<head>
    <title>Asesmen Awal Medis Kandungan</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .table-data th, .table-data td { padding: 4px; vertical-align: top; text-align: left; }
        .table-data th { width: 150px; font-weight: bold; }
        .section-title { font-weight: bold; font-size: 12px; margin-top: 10px; margin-bottom: 5px; 
                         text-decoration: underline; background: #eee; padding: 2px; }
        .box { border: 1px solid #000; padding: 5px; margin-bottom: 5px; }
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
                    <p style="margin:0; font-size:12px;">Telp: <?= $setting['kontak'] ?> | Email: <?= $setting['email'] ?></p>
                </td>
                <td width="10%" align="right" style="vertical-align:middle;"></td>
            </tr>
        </table>
    </div>

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS KANDUNGAN (OBSTETRI & GINEKOLOGI)</h3>

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
        <tr><th>Keluhan Utama</th><td>: <?= nl2br($asesment['keluhan_utama']) ?></td></tr>
        <tr><th>Riw. Penyakit Sekarang</th><td>: <?= nl2br($asesment['rps']) ?></td></tr>
        <tr><th>Riw. Penyakit Dahulu</th><td>: <?= nl2br($asesment['rpd']) ?></td></tr>
        <tr><th>Riw. Penyakit Keluarga</th><td>: <?= nl2br($asesment['rpk']) ?></td></tr>
        <tr><th>Riw. Penggunaan Obat</th><td>: <?= nl2br($asesment['rpo']) ?></td></tr>
        <tr><th>Riwayat Alergi</th><td>: <?= $asesment['alergi'] ?></td></tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="25%"><b>Keadaan Umum:</b> <?= $asesment['keadaan'] ?></td>
            <td width="25%"><b>Kesadaran:</b> <?= $asesment['kesadaran'] ?></td>
            <td width="25%"><b>GCS:</b> <?= $asesment['gcs'] ?></td>
            <td width="25%"><b>SpO₂:</b> <?= $asesment['spo'] ?>%</td>
        </tr>
        <tr>
            <td><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td><b>Suhu:</b> <?= $asesment['suhu'] ?> °C</td>
            <td><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
        </tr>
        <tr>
            <td><b>BB:</b> <?= $asesment['bb'] ?> kg</td>
            <td><b>TB:</b> <?= $asesment['tb'] ?> cm</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <div class="box">
        <b>Pemeriksaan Sistemik:</b><br>
        <table width="100%">
            <tr>
                <td width="33%">
                    <ul>
                        <li><b>Kepala:</b> <?= $asesment['kepala'] ?></li>
                        <li><b>Mata:</b> <?= $asesment['mata'] ?></li>
                        <li><b>Gigi & Mulut:</b> <?= $asesment['gigi'] ?></li>
                    </ul>
                </td>
                <td width="33%">
                    <ul>
                        <li><b>THT:</b> <?= $asesment['tht'] ?></li>
                        <li><b>Thoraks:</b> <?= $asesment['thoraks'] ?></li>
                        <li><b>Abdomen:</b> <?= $asesment['abdomen'] ?></li>
                    </ul>
                </td>
                <td width="34%">
                    <ul>
                        <li><b>Genital:</b> <?= $asesment['genital'] ?></li>
                        <li><b>Ekstremitas:</b> <?= $asesment['ekstremitas'] ?></li>
                        <li><b>Kulit:</b> <?= $asesment['kulit'] ?></li>
                    </ul>
                </td>
            </tr>
        </table>
        <?php if (!empty($asesment['ket_fisik'])): ?>
            <p><b>Keterangan Pemeriksaan Fisik:</b><br><?= nl2br($asesment['ket_fisik']) ?></p>
        <?php endif; ?>
    </div>

    <div class="section-title">III. PEMERIKSAAN OBSTETRI & GINEKOLOGI</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="20%"><b>TFU:</b> <?= $asesment['tfu'] ?: '-' ?> cm</td>
            <td width="20%"><b>TBJ:</b> <?= $asesment['tbj'] ?: '-' ?> gram</td>
            <td width="20%"><b>HIS:</b> <?= $asesment['his'] ?: '-' ?></td>
            <td width="20%"><b>Kontraksi:</b> <?= $asesment['kontraksi'] ?: '-' ?></td>
            <td width="20%"><b>DJJ:</b> <?= $asesment['djj'] ?: '-' ?> x/mnt</td>
        </tr>
    </table>
    <?php if (!empty($asesment['inspeksi']) || !empty($asesment['inspekulo']) || !empty($asesment['vt']) || !empty($asesment['rt']) || !empty($asesment['ultra']) || !empty($asesment['kardio'])): ?>
        <table class="table-data">
            <?php if (!empty($asesment['inspeksi'])): ?>
                <tr><th>Inspeksi</th><td>: <?= nl2br($asesment['inspeksi']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($asesment['inspekulo'])): ?>
                <tr><th>Inspekulo</th><td>: <?= nl2br($asesment['inspekulo']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($asesment['vt'])): ?>
                <tr><th>VT (Vaginal Toucher)</th><td>: <?= nl2br($asesment['vt']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($asesment['rt'])): ?>
                <tr><th>RT (Rectal Toucher)</th><td>: <?= nl2br($asesment['rt']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($asesment['ultra'])): ?>
                <tr><th>USG</th><td>: <?= nl2br($asesment['ultra']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($asesment['kardio'])): ?>
                <tr><th>Kardiotokografi</th><td>: <?= nl2br($asesment['kardio']) ?></td></tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <p><?= nl2br($asesment['lab'] ?: '-') ?></p>

    <div class="section-title">V. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr><th>Diagnosis</th><td>: <?= nl2br($asesment['diagnosis']) ?></td></tr>
        <tr><th>Tatalaksana</th><td>: <?= nl2br($asesment['tata']) ?></td></tr>
        <?php if (!empty($asesment['konsul'])): ?>
            <tr><th>Konsultasi/Rujukan</th><td>: <?= nl2br($asesment['konsul']) ?></td></tr>
        <?php endif; ?>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Dokter Penanggung Jawab,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>
</body>
</html>

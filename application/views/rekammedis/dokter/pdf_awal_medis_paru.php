<!DOCTYPE html>
<html>
<head>
    <title>Asesmen Awal Medis Paru</title>
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

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS PARU</h3>

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
        <tr><th>Riw. Penggunaan Obat</th><td>: <?= nl2br($asesment['rpo']) ?></td></tr>
        <tr><th>Riwayat Alergi</th><td>: <?= $asesment['alergi'] ?></td></tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="25%"><b>Kesadaran:</b> <?= $asesment['kesadaran'] ?></td>
            <td width="25%"><b>GCS:</b> <?= $asesment['gcs'] ?></td>
            <td width="50%" colspan="2"><b>Status Pasien:</b> <?= $asesment['status'] ?></td>
        </tr>
        <tr>
            <td><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
            <td><b>Suhu:</b> <?= $asesment['suhu'] ?> °C</td>
        </tr>
        <tr>
            <td><b>BB:</b> <?= $asesment['bb'] ?> kg</td>
            <td><b>Nyeri:</b> <?= $asesment['nyeri'] ?> (1-10)</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <div class="box">
        <b>Pemeriksaan Sistemik:</b><br>
        <table width="100%">
            <tr>
                <td width="50%">
                    <ul>
                        <li><b>Kepala:</b> <?= $asesment['kepala'] ?></li>
                        <li><b>Thoraks:</b> <?= $asesment['thoraks'] ?></li>
                    </ul>
                </td>
                <td width="50%">
                    <ul>
                        <li><b>Abdomen:</b> <?= $asesment['abdomen'] ?></li>
                        <li><b>Muskuloskeletal:</b> <?= $asesment['muskulos'] ?></li>
                    </ul>
                </td>
            </tr>
        </table>
        <?php if (!empty($asesment['lainnya'])): ?>
            <p><b>Pemeriksaan Lainnya:</b><br><?= nl2br($asesment['lainnya']) ?></p>
        <?php endif; ?>
    </div>

    <div class="section-title">III. STATUS LOKALIS PARU</div>
    <div>
        <table width="100%">
            <tr>
                <td width="50%" valign="top">
                    <?php if (file_exists($lokalis_path)): ?>
                        <img src="<?= $lokalis_path ?>" style="width: 100%; border: 1px solid #ccc;">
                    <?php else: ?>
                        <p><i>Tidak ada gambar lokalis.</i></p>
                    <?php endif; ?>
                </td>
                <td width="50%" valign="top" style="padding-left: 10px;">
                    <p><b>Keterangan Lokalis:</b></p>
                    <div style="border: 1px solid #ddd; padding: 5px; min-height: 200px;">
                        <?= nl2br($asesment['ket_lokalis'] ?: '-') ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <table class="table-data">
        <?php if (!empty($asesment['lab'])): ?>
            <tr><th>Laboratorium</th><td>: <?= nl2br($asesment['lab']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['rad'])): ?>
            <tr><th>Radiologi</th><td>: <?= nl2br($asesment['rad']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['pemeriksaan'])): ?>
            <tr><th>Pemeriksaan Lain</th><td>: <?= nl2br($asesment['pemeriksaan']) ?></td></tr>
        <?php endif; ?>
        <?php if (empty($asesment['lab']) && empty($asesment['rad']) && empty($asesment['pemeriksaan'])): ?>
            <tr><td colspan="2">- Tidak ada data penunjang -</td></tr>
        <?php endif; ?>
    </table>

    <div class="section-title">V. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr><th>Diagnosis Utama</th><td>: <?= nl2br($asesment['diagnosis']) ?></td></tr>
        <?php if (!empty($asesment['diagnosis2'])): ?>
            <tr><th>Diagnosis Sekunder</th><td>: <?= nl2br($asesment['diagnosis2']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['permasalahan'])): ?>
            <tr><th>Permasalahan</th><td>: <?= nl2br($asesment['permasalahan']) ?></td></tr>
        <?php endif; ?>
        <tr><th>Terapi</th><td>: <?= nl2br($asesment['terapi']) ?></td></tr>
        <tr><th>Tindakan</th><td>: <?= nl2br($asesment['tindakan']) ?></td></tr>
        <?php if (!empty($asesment['edukasi'])): ?>
            <tr><th>Edukasi</th><td>: <?= nl2br($asesment['edukasi']) ?></td></tr>
        <?php endif; ?>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Dokter Penanggung Jawab,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>
</body>
</html>

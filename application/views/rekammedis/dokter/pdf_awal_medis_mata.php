<!DOCTYPE html>
<html>
<head>
    <title>Asesmen Awal Medis Mata</title>
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

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS MATA (OFTALMOLOGI)</h3>

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
            <td width="25%"><b>Status:</b> <?= $asesment['status'] ?></td>
            <td width="25%"><b>TD:</b> <?= $asesment['td'] ?> mmHg</td>
            <td width="25%"><b>Nadi:</b> <?= $asesment['nadi'] ?> x/mnt</td>
            <td width="25%"><b>RR:</b> <?= $asesment['rr'] ?> x/mnt</td>
        </tr>
        <tr>
            <td><b>Suhu:</b> <?= $asesment['suhu'] ?> °C</td>
            <td><b>BB:</b> <?= $asesment['bb'] ?> kg</td>
            <td colspan="2"><b>Nyeri:</b> <?= $asesment['nyeri'] ?></td>
        </tr>
    </table>

    <div class="section-title">III. PEMERIKSAAN MATA (OFTALMOLOGI)</div>
    
    <p><b>Visus OD:</b> <?= $asesment['visuskanan'] ?: '-' ?> | <b>Visus OS:</b> <?= $asesment['visuskiri'] ?: '-' ?></p>

    <!-- Gambar Mata OD & OS Side by Side -->
    <table width="100%" cellpadding="5" style="border-collapse: collapse;">
        <tr>
            <td width="50%" style="vertical-align: top; border: 1px solid #ccc; padding: 10px;">
                <h4 style="text-align:center; margin:5px 0;">OD (Mata Kanan)</h4>
                <div style="text-align:center; margin:10px 0;">
                    <?php 
                    $clean_no_rawat = str_replace('/', '', $asesment['no_rawat']);
                    $img_od_path = FCPATH . 'assets/images/lokalis_mata/mata_od_' . $clean_no_rawat . '.png';
                    if (file_exists($img_od_path)): 
                    ?>
                        <img src="<?= $img_od_path ?>" style="max-width:90%; border:1px solid #ccc;">
                    <?php else: ?>
                        <img src="<?= FCPATH . 'assets/images/mata/mata_od_template.png' ?>" style="max-width:90%; border:1px solid #ccc;">
                    <?php endif; ?>
                </div>
                <ul style="font-size:10px; margin:5px 0; padding-left:20px;">
                    <?php if (!empty($asesment['cckanan'])): ?><li><b>CC:</b> <?= $asesment['cckanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['palkanan'])): ?><li><b>Palpebra:</b> <?= $asesment['palkanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['conkanan'])): ?><li><b>Conjunctiva:</b> <?= $asesment['conkanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['corneakanan'])): ?><li><b>Cornea:</b> <?= $asesment['corneakanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['coakanan'])): ?><li><b>COA:</b> <?= $asesment['coakanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['pupilkanan'])): ?><li><b>Pupil:</b> <?= $asesment['pupilkanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['lensakanan'])): ?><li><b>Lensa:</b> <?= $asesment['lensakanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['funduskanan'])): ?><li><b>Fundus:</b> <?= $asesment['funduskanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['papilkanan'])): ?><li><b>Papil:</b> <?= $asesment['papilkanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['retinakanan'])): ?><li><b>Retina:</b> <?= $asesment['retinakanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['makulakanan'])): ?><li><b>Makula:</b> <?= $asesment['makulakanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['tiokanan'])): ?><li><b>TIO:</b> <?= $asesment['tiokanan'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['mbokanan'])): ?><li><b>MBO:</b> <?= $asesment['mbokanan'] ?></li><?php endif; ?>
                </ul>
            </td>
            <td width="50%" style="vertical-align: top; border: 1px solid #ccc; padding: 10px;">
                <h4 style="text-align:center; margin:5px 0;">OS (Mata Kiri)</h4>
                <div style="text-align:center; margin:10px 0;">
                    <?php 
                    $img_os_path = FCPATH . 'assets/images/lokalis_mata/mata_os_' . $clean_no_rawat . '.png';
                    if (file_exists($img_os_path)): 
                    ?>
                        <img src="<?= $img_os_path ?>" style="max-width:90%; border:1px solid #ccc;">
                    <?php else: ?>
                        <img src="<?= FCPATH . 'assets/images/mata/mata_os_template.png' ?>" style="max-width:90%; border:1px solid #ccc;">
                    <?php endif; ?>
                </div>
                <ul style="font-size:10px; margin:5px 0; padding-left:20px;">
                    <?php if (!empty($asesment['cckiri'])): ?><li><b>CC:</b> <?= $asesment['cckiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['palkiri'])): ?><li><b>Palpebra:</b> <?= $asesment['palkiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['conkiri'])): ?><li><b>Conjunctiva:</b> <?= $asesment['conkiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['corneakiri'])): ?><li><b>Cornea:</b> <?= $asesment['corneakiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['coakiri'])): ?><li><b>COA:</b> <?= $asesment['coakiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['pupilkiri'])): ?><li><b>Pupil:</b> <?= $asesment['pupilkiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['lensakiri'])): ?><li><b>Lensa:</b> <?= $asesment['lensakiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['funduskiri'])): ?><li><b>Fundus:</b> <?= $asesment['funduskiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['papilkiri'])): ?><li><b>Papil:</b> <?= $asesment['papilkiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['retinakiri'])): ?><li><b>Retina:</b> <?= $asesment['retinakiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['makulakiri'])): ?><li><b>Makula:</b> <?= $asesment['makulakiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['tiokiri'])): ?><li><b>TIO:</b> <?= $asesment['tiokiri'] ?></li><?php endif; ?>
                    <?php if (!empty($asesment['mbokiri'])): ?><li><b>MBO:</b> <?= $asesment['mbokiri'] ?></li><?php endif; ?>
                </ul>
            </td>
        </tr>
    </table>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <table class="table-data">
        <?php if (!empty($asesment['lab'])): ?>
            <tr><th>Laboratorium</th><td>: <?= nl2br($asesment['lab']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['rad'])): ?>
            <tr><th>Radiologi</th><td>: <?= nl2br($asesment['rad']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['penunjang'])): ?>
            <tr><th>Penunjang Lainnya</th><td>: <?= nl2br($asesment['penunjang']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['tes'])): ?>
            <tr><th>Tes</th><td>: <?= nl2br($asesment['tes']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['pemeriksaan'])): ?>
            <tr><th>Pemeriksaan</th><td>: <?= nl2br($asesment['pemeriksaan']) ?></td></tr>
        <?php endif; ?>
    </table>
    <?php if (empty($asesment['lab']) && empty($asesment['rad']) && empty($asesment['penunjang']) && empty($asesment['tes']) && empty($asesment['pemeriksaan'])): ?>
        <p>-</p>
    <?php endif; ?>

    <div class="section-title">V. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr><th>Diagnosis</th><td>: <?= nl2br($asesment['diagnosis']) ?></td></tr>
        <?php if (!empty($asesment['diagnosisbdg'])): ?>
            <tr><th>Diagnosis Banding</th><td>: <?= nl2br($asesment['diagnosisbdg']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['permasalahan'])): ?>
            <tr><th>Permasalahan</th><td>: <?= nl2br($asesment['permasalahan']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['terapi'])): ?>
            <tr><th>Terapi</th><td>: <?= nl2br($asesment['terapi']) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($asesment['tindakan'])): ?>
            <tr><th>Tindakan</th><td>: <?= nl2br($asesment['tindakan']) ?></td></tr>
        <?php endif; ?>
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

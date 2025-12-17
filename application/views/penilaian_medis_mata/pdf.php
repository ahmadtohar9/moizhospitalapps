<!DOCTYPE html>
<html>

<head>
    <title>Penilaian Medis Mata</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .table-data th,
        .table-data td {
            padding: 3px;
            vertical-align: top;
            text-align: left;
        }

        .table-data th {
            width: 150px;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            font-size: 11px;
            margin-top: 8px;
            margin-bottom: 3px;
            text-decoration: underline;
            background: #eee;
            padding: 3px 5px;
        }

        .box {
            border: 1px solid #000;
            padding: 5px;
            margin-bottom: 5px;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 3px 5px;
            font-size: 10px;
        }

        .table-bordered th {
            background: #ddd;
            font-weight: bold;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 10px;
        }

        .table-info td {
            border: 1px solid #000;
            padding: 3px 5px;
            font-size: 10px;
        }

        .table-info td.label {
            width: 18%;
            font-weight: bold;
            background: #f5f5f5;
        }

        .table-info td.value {
            width: 32%;
        }
    </style>
</head>

<body>

    <div class="header">
        <table width="100%">
            <tr>
                <td width="10%" align="left" style="vertical-align:middle;">
                    <?php if (!empty($setting['logo'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>" width="60px">
                    <?php endif; ?>
                </td>
                <td align="center" style="vertical-align:middle;">
                    <h2 style="margin:0; font-size:16px;"><?= strtoupper($setting['nama_instansi'] ?? 'RUMAH SAKIT') ?>
                    </h2>
                    <p style="margin:2px 0; font-size:11px;"><?= $setting['alamat_instansi'] ?? '' ?></p>
                    <p style="margin:0; font-size:10px;">Telp: <?= $setting['kontak'] ?? '' ?> | Email:
                        <?= $setting['email'] ?? '' ?></p>
                </td>
                <td width="10%" align="right" style="vertical-align:middle;"></td>
            </tr>
        </table>
    </div>

    <h3 style="text-align:center; margin:5px 0 10px 0; text-decoration:underline; font-size:14px;">PENILAIAN MEDIS MATA
    </h3>

    <!-- Info Pasien dalam Tabel -->
    <table class="table-info">
        <tr>
            <td class="label">No. RM</td>
            <td class="value"><?= $detail_pasien['no_rkm_medis'] ?? '-' ?></td>
            <td class="label">Nama Pasien</td>
            <td class="value"><?= $detail_pasien['nm_pasien'] ?? '-' ?></td>
        </tr>
        <tr>
            <td class="label">Tgl. Lahir</td>
            <td class="value">
                <?= !empty($detail_pasien['tgl_lahir']) ? date('d-m-Y', strtotime($detail_pasien['tgl_lahir'])) : '-' ?>
            </td>
            <td class="label">JK</td>
            <td class="value"><?= ($detail_pasien['jk'] ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
        </tr>
        <tr>
            <td class="label">No. Rawat</td>
            <td class="value"><?= $penilaian['no_rawat'] ?></td>
            <td class="label">Tanggal Asesmen</td>
            <td class="value"><?= date('d-m-Y H:i', strtotime($penilaian['tanggal'])) ?></td>
        </tr>
        <tr>
            <td class="label">Poli</td>
            <td class="value"><?= $detail_pasien['nm_poli'] ?? '-' ?></td>
            <td class="label">Dokter</td>
            <td class="value"><?= $penilaian['nm_dokter'] ?? '-' ?></td>
        </tr>
        <tr>
            <td class="label">Asuransi</td>
            <td class="value" colspan="3"><?= $detail_pasien['png_jawab'] ?? '-' ?></td>
        </tr>
    </table>

    <div class="section-title">I. RIWAYAT KESEHATAN</div>
    <table class="table-data">
        <tr>
            <th>Anamnesis</th>
            <td>: <?= $penilaian['anamnesis'] ?? '-' ?>
                <?= !empty($penilaian['hubungan']) ? '(' . $penilaian['hubungan'] . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <th>Keluhan Utama</th>
            <td>: <?= nl2br($penilaian['keluhan_utama'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Riw. Penyakit Sekarang</th>
            <td>: <?= nl2br($penilaian['rps'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Riw. Penyakit Dahulu</th>
            <td>: <?= nl2br($penilaian['rpd'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Riw. Penggunaan Obat</th>
            <td>: <?= nl2br($penilaian['rpo'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Riwayat Alergi</th>
            <td>: <?= $penilaian['alergi'] ?? '-' ?></td>
        </tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <table width="100%" cellpadding="3">
        <tr>
            <td width="20%"><b>Status:</b> <?= $penilaian['status'] ?? '-' ?></td>
            <td width="20%"><b>TD:</b> <?= $penilaian['td'] ?? '-' ?> mmHg</td>
            <td width="20%"><b>Nadi:</b> <?= $penilaian['nadi'] ?? '-' ?> x/mnt</td>
            <td width="20%"><b>Suhu:</b> <?= $penilaian['suhu'] ?? '-' ?> &deg;C</td>
        </tr>
        <tr>
            <td><b>RR:</b> <?= $penilaian['rr'] ?? '-' ?> x/mnt</td>
            <td><b>BB:</b> <?= $penilaian['bb'] ?? '-' ?> Kg</td>
            <td><b>Nyeri:</b> <?= $penilaian['nyeri'] ?? '-' ?></td>
            <td></td>
        </tr>
    </table>

    <div class="section-title">III. STATUS OFTALMOLOGIS</div>

    <!-- Gambar Mata -->
    <div style="text-align: center; margin: 10px 0;">
        <table width="100%">
            <tr>
                <td width="50%" align="center">
                    <b>OD : Mata Kanan</b><br>
                    <?php if (file_exists($gambar_od)): ?>
                        <img src="<?= $gambar_od ?>"
                            style="width: 90%; max-width: 300px; border: 2px solid #3c8dbc; margin-top: 5px;">
                    <?php else: ?>
                        <p><i>Tidak ada gambar</i></p>
                    <?php endif; ?>
                </td>
                <td width="50%" align="center">
                    <b>OS : Mata Kiri</b><br>
                    <?php if (file_exists($gambar_os)): ?>
                        <img src="<?= $gambar_os ?>"
                            style="width: 90%; max-width: 300px; border: 2px solid #00a65a; margin-top: 5px;">
                    <?php else: ?>
                        <p><i>Tidak ada gambar</i></p>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- Detail Pemeriksaan Mata -->
    <table class="table-bordered">
        <thead>
            <tr>
                <th>Pemeriksaan</th>
                <th>OD (Mata Kanan)</th>
                <th>OS (Mata Kiri)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Visus SC</td>
                <td><?= $penilaian['visuskanan'] ?? '-' ?></td>
                <td><?= $penilaian['visuskiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>CC</td>
                <td><?= $penilaian['cckanan'] ?? '-' ?></td>
                <td><?= $penilaian['cckiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Palpebra</td>
                <td><?= $penilaian['palkanan'] ?? '-' ?></td>
                <td><?= $penilaian['palkiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Conjungtiva</td>
                <td><?= $penilaian['conkanan'] ?? '-' ?></td>
                <td><?= $penilaian['conkiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Cornea</td>
                <td><?= $penilaian['corneakanan'] ?? '-' ?></td>
                <td><?= $penilaian['corneakiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>COA</td>
                <td><?= $penilaian['coakanan'] ?? '-' ?></td>
                <td><?= $penilaian['coakiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Pupil</td>
                <td><?= $penilaian['pupilkanan'] ?? '-' ?></td>
                <td><?= $penilaian['pupilkiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Lensa</td>
                <td><?= $penilaian['lensakanan'] ?? '-' ?></td>
                <td><?= $penilaian['lensakiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Fundus Media</td>
                <td><?= $penilaian['funduskanan'] ?? '-' ?></td>
                <td><?= $penilaian['funduskiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Papil</td>
                <td><?= $penilaian['papilkanan'] ?? '-' ?></td>
                <td><?= $penilaian['papilkiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Retina</td>
                <td><?= $penilaian['retinakanan'] ?? '-' ?></td>
                <td><?= $penilaian['retinakiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Makula</td>
                <td><?= $penilaian['makulakanan'] ?? '-' ?></td>
                <td><?= $penilaian['makulakiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>TIO</td>
                <td><?= $penilaian['tiokanan'] ?? '-' ?></td>
                <td><?= $penilaian['tiokiri'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>MBO</td>
                <td><?= $penilaian['mbokanan'] ?? '-' ?></td>
                <td><?= $penilaian['mbokiri'] ?? '-' ?></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
    <table class="table-data">
        <tr>
            <th>Laboratorium</th>
            <td>: <?= nl2br($penilaian['lab'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td>: <?= nl2br($penilaian['rad'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Penunjang Lainnya</th>
            <td>: <?= nl2br($penilaian['penunjang'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Tes Penglihatan</th>
            <td>: <?= nl2br($penilaian['tes'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Pemeriksaan Lain</th>
            <td>: <?= nl2br($penilaian['pemeriksaan'] ?? '-') ?></td>
        </tr>
    </table>

    <div class="section-title">V. DIAGNOSIS & TATALAKSANA</div>
    <table class="table-data">
        <tr>
            <th>Asesmen Kerja</th>
            <td>: <?= nl2br($penilaian['diagnosis'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Asesmen Banding</th>
            <td>: <?= nl2br($penilaian['diagnosisbdg'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Permasalahan</th>
            <td>: <?= nl2br($penilaian['permasalahan'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Terapi/Pengobatan</th>
            <td>: <?= nl2br($penilaian['terapi'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Tindakan</th>
            <td>: <?= nl2br($penilaian['tindakan'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Edukasi</th>
            <td>: <?= nl2br($penilaian['edukasi'] ?? '-') ?></td>
        </tr>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p><?= $setting['kabupaten'] ?? '' ?>, <?= date('d-m-Y', strtotime($penilaian['tanggal'])) ?></p>
        <p>Dokter Pemeriksa,</p>
        <br><br><br>
        <p><b>( <?= $penilaian['nm_dokter'] ?? '-' ?> )</b></p>
    </div>

</body>

</html>
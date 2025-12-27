<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resume Medis</title>
    <style>
        @page {
            size: 210mm 330mm;
            /* Ukuran F4 */
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }

        .content {
            width: 95%;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.4;
            min-height: 1150px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .section {
            border: 1px solid #ccc;
            padding: 6px;
            margin-bottom: 6px;
            border-radius: 6px;
            page-break-inside: avoid;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
            text-decoration: underline;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            page-break-inside: avoid;
        }

        td {
            vertical-align: top;
        }

        tr {
            page-break-inside: avoid;
        }

        .info-table td {
            font-size: 9px;
            padding: 1px 4px;
            width: 25%;
        }

        .footer-ttd {
            margin-top: auto;
            page-break-inside: avoid;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 15px;
        }

        .qr-box img {
            width: 70px;
            height: 70px;
        }

        .ttd-box {
            text-align: right;
            font-size: 10px;
        }

        .ttd-box .nama {
            margin-top: 40px;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <?php
    $keluhanLength = strlen(strip_tags($resume['keluhan_utama']));
    $shrink = $keluhanLength > 1000 ? 'shrink' : '';

    // Ambil setting rumah sakit untuk header
    $CI =& get_instance();
    $setting = $CI->db->get('setting', 1)->row_array();
    ?>

    <div class="content <?= $shrink ?>">

        <!-- HEADER RUMAH SAKIT -->
        <div style="border-bottom: 3px solid #333; padding-bottom: 8px; margin-bottom: 10px;">
            <table width="100%" style="border: none;">
                <tr>
                    <td width="15%" align="left" style="vertical-align:middle; border: none;">
                        <?php if (!empty($setting['logo'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($setting['logo']) ?>"
                                style="width: 70px; height: auto;">
                        <?php endif; ?>
                    </td>
                    <td align="center" style="vertical-align:middle; border: none;">
                        <h2 style="margin:0; font-size:16px; font-weight: bold;">
                            <?= strtoupper($setting['nama_instansi'] ?? 'RSUD PETALABUMI') ?>
                        </h2>
                        <p style="margin:2px 0; font-size:11px;"><?= $setting['alamat_instansi'] ?? 'PEKANBARU' ?></p>
                        <p style="margin:0; font-size:10px;">
                            Kontak: Hp: <?= $setting['kontak'] ?? '085365811832' ?> |
                            Email: <?= $setting['email'] ?? 'rsud@gmail.com' ?>
                        </p>
                    </td>
                    <td width="15%" align="right" style="vertical-align:middle; border: none;"></td>
                </tr>
            </table>
        </div>

        <!-- JUDUL DOKUMEN -->
        <div style="border-bottom: 2px solid #333; padding-bottom: 5px; margin-bottom: 10px;">
            <h3 style="text-align:center; margin: 5px 0; font-size: 13px; font-weight: bold;">
                RESUME MEDIS RAWAT JALAN
            </h3>
        </div>

        <!-- Informasi Pasien -->
        <div class="section">
            <div class="section-title">🧾 Informasi Pasien</div>
            <table class="info-table">
                <tr>
                    <td><b>No. RM</b></td>
                    <td>: <?= $resume['no_rkm_medis'] ?></td>
                    <td><b>Nama Pasien</b></td>
                    <td>: <?= $resume['nm_pasien'] ?></td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td>: <?= $resume['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td><b>Umur</b></td>
                    <td>: <?= $resume['umur_lengkap'] ?></td>
                </tr>
                <tr>
                    <td><b>Asuransi</b></td>
                    <td>: <?= $resume['png_jawab'] ?></td>
                    <td><b>Tanggal</b></td>
                    <td>: <?= $resume['tgl_registrasi'] ?></td>
                </tr>
                <tr>
                    <td><b>No. Rawat</b></td>
                    <td>: <?= $resume['no_rawat'] ?></td>
                    <td><b>Dokter</b></td>
                    <td>: <?= $resume['nm_dokter'] ?></td>
                </tr>
            </table>
        </div>

        <!-- TTV -->
        <div class="section">
            <div class="section-title">🩺 Tanda-Tanda Vital</div>
            <table>
                <tr>
                    <td><b>Suhu</b></td>
                    <td>: <?= $resume['suhu_tubuh'] ?> °C</td>
                    <td><b>Nadi</b></td>
                    <td>: <?= $resume['nadi'] ?> x/menit</td>
                </tr>
                <tr>
                    <td><b>Respirasi</b></td>
                    <td>: <?= $resume['respirasi'] ?> x/menit</td>
                    <td><b>SPO2</b></td>
                    <td>: <?= $resume['spo2'] ?> %</td>
                </tr>
                <tr>
                    <td><b>Tensi</b></td>
                    <td colspan="3">: <?= $resume['tensi'] ?></td>
                </tr>
            </table>
        </div>

        <!-- Keluhan Utama -->
        <div class="section">
            <div class="section-title">🗣️ Keluhan Utama</div>
            <?= nl2br(htmlspecialchars_decode($resume['keluhan_utama'] ?? '-')) ?>
        </div>

        <!-- Diagnosa -->
        <div class="section">
            <div class="section-title">🧠 Diagnosa</div>
            <table>
                <tr>
                    <td><b>Utama</b></td>
                    <td>: <?= $resume['diagnosa_utama'] ?> (<?= $resume['kd_diagnosa_utama'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 1</b></td>
                    <td>: <?= $resume['diagnosa_sekunder'] ?> (<?= $resume['kd_diagnosa_sekunder'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 2</b></td>
                    <td>: <?= $resume['diagnosa_sekunder2'] ?> (<?= $resume['kd_diagnosa_sekunder2'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 3</b></td>
                    <td>: <?= $resume['diagnosa_sekunder3'] ?> (<?= $resume['kd_diagnosa_sekunder3'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 4</b></td>
                    <td>: <?= $resume['diagnosa_sekunder4'] ?> (<?= $resume['kd_diagnosa_sekunder4'] ?>)</td>
                </tr>
            </table>
        </div>

        <!-- Prosedur -->
        <div class="section">
            <div class="section-title">🛠️ Prosedur</div>
            <table>
                <tr>
                    <td><b>Utama</b></td>
                    <td>: <?= $resume['prosedur_utama'] ?> (<?= $resume['kd_prosedur_utama'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 1</b></td>
                    <td>: <?= $resume['prosedur_sekunder'] ?> (<?= $resume['kd_prosedur_sekunder'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 2</b></td>
                    <td>: <?= $resume['prosedur_sekunder2'] ?> (<?= $resume['kd_prosedur_sekunder2'] ?>)</td>
                </tr>
                <tr>
                    <td><b>Sekunder 3</b></td>
                    <td>: <?= $resume['prosedur_sekunder3'] ?> (<?= $resume['kd_prosedur_sekunder3'] ?>)</td>
                </tr>
            </table>
        </div>

        <!-- Kondisi Pulang -->
        <div class="section">
            <div class="section-title">📋 Kondisi Pulang</div>
            <p><?= htmlspecialchars_decode(nl2br($resume['kondisi_pulang'])) ?></p>

            <div class="section-title">💊 Obat Pulang</div>
            <p><?= htmlspecialchars_decode(nl2br($resume['obat_pulang'])) ?></p>
        </div>

        <div class="footer-ttd">
            <div class="ttd-box" style="text-align: right;">
                <p style="margin-bottom: 5px;">Pekanbaru, <?= tanggal_indo(date('Y-m-d')) ?></p>
                <p style="margin-bottom: 10px;">Dokter Pemeriksa,</p>

                <?php if (!empty($resume['qr_code_base64'])): ?>
                    <div style="margin-bottom: 5px;">
                        <img src="<?= $resume['qr_code_base64'] ?>" style="width: 80px; height: 80px;">
                    </div>
                <?php endif; ?>

                <div class="nama"
                    style="font-weight: bold; text-decoration: underline; font-size: 10px; margin-top: 0;">
                    <?= $resume['nm_dokter'] ?>
                </div>
            </div>
        </div>




    </div>

</body>

</html>
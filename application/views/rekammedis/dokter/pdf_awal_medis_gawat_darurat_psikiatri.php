<!DOCTYPE html>
<html>

<head>
    <title>Asesmen Awal Medis IGD Psikiatri</title>
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
            border: 1px solid #ddd;
        }

        .table-data th {
            width: 150px;
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .no-border td {
            border: none;
        }

        .section-title {
            font-weight: bold;
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 5px;
            text-decoration: underline;
            background: #eee;
            padding: 5px;
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

    <h3 style="text-align:center; margin:0 0 20px 0; text-decoration:underline;">ASESMEN AWAL MEDIS IGD PSIKIATRI</h3>

    <table width="100%" class="no-border">
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
        <p><b>Hubungan dengan Pasien:</b> <?= $asesment['hubungan'] ?></p>
    <?php endif; ?>

    <table class="table-data">
        <tr>
            <th width="30%">Keluhan Utama</th>
            <td><?= nl2br($asesment['keluhan_utama']) ?></td>
        </tr>
        <tr>
            <th>Gejala Menyertai</th>
            <td><?= nl2br($asesment['gejala_menyertai']) ?></td>
        </tr>
        <tr>
            <th>Faktor Pencetus</th>
            <td><?= nl2br($asesment['faktor_pencetus']) ?></td>
        </tr>
    </table>

    <p><b>Riwayat & Faktor:</b></p>
    <table class="table-data">
        <tr>
            <th>Riw. Penyakit Dahulu</th>
            <td><?= $asesment['riwayat_penyakit_dahulu'] ?> (<?= $asesment['keterangan_riwayat_penyakit_dahulu'] ?>)
            </td>
        </tr>
        <tr>
            <th>Riwayat Kehamilan</th>
            <td><?= $asesment['riwayat_kehamilan'] ?></td>
        </tr>
        <tr>
            <th>Riwayat Sosial</th>
            <td><?= $asesment['riwayat_sosial'] ?> (<?= $asesment['keterangan_riwayat_sosial'] ?>)</td>
        </tr>
        <tr>
            <th>Riwayat Pekerjaan</th>
            <td><?= $asesment['riwayat_pekerjaan'] ?> (<?= $asesment['keterangan_riwayat_pekerjaan'] ?>)</td>
        </tr>
        <tr>
            <th>Obat Diminum</th>
            <td><?= nl2br($asesment['riwayat_obat_diminum']) ?></td>
        </tr>
        <tr>
            <th>Kepribadian Premorbid</th>
            <td><?= $asesment['faktor_kepribadian_premorbid'] ?></td>
        </tr>
        <tr>
            <th>Faktor Keturunan</th>
            <td><?= $asesment['faktor_keturunan'] ?> (<?= $asesment['keterangan_faktor_keturunan'] ?>)</td>
        </tr>
        <tr>
            <th>Faktor Organik</th>
            <td><?= $asesment['faktor_organik'] ?> (<?= $asesment['keterangan_faktor_organik'] ?>)</td>
        </tr>
        <tr>
            <th>Riwayat Alergi</th>
            <td><?= $asesment['riwayat_alergi'] ?></td>
        </tr>
    </table>

    <div class="section-title">II. PEMERIKSAAN FISIK</div>
    <p><b>Tanda-tanda Vital:</b></p>
    <table width="100%" class="no-border" cellpadding="3">
        <tr>
            <td width="25%"><b>Kesadaran:</b><br> <?= $asesment['fisik_kesadaran'] ?></td>
            <td width="25%"><b>GCS:</b><br> <?= $asesment['fisik_gcs'] ?></td>
            <td width="25%"><b>TD:</b><br> <?= $asesment['fisik_td'] ?> mmHg</td>
            <td width="25%"><b>Nadi:</b><br> <?= $asesment['fisik_nadi'] ?> x/mnt</td>
        </tr>
        <tr>
            <td><b>RR:</b><br> <?= $asesment['fisik_rr'] ?> x/mnt</td>
            <td><b>Suhu:</b><br> <?= $asesment['fisik_suhu'] ?> &deg;C</td>
            <td><b>BB:</b><br> <?= $asesment['fisik_bb'] ?> Kg</td>
            <td><b>TB:</b><br> <?= $asesment['fisik_tb'] ?> cm</td>
        </tr>
        <tr>
            <td colspan="2"><b>Nyeri:</b> <?= $asesment['fisik_nyeri'] ?></td>
            <td colspan="2"><b>Nutrisi:</b> <?= $asesment['fisik_status_nutrisi'] ?></td>
        </tr>
    </table>

    <p style="margin-top:10px;"><b>Status Kelainan Head To Toe:</b></p>
    <table class="table-data">
        <tr>
            <th>Kepala</th>
            <td><?= $asesment['status_kelainan_kepala'] ?>
                <?= $asesment['keterangan_status_kelainan_kepala'] ? ' (' . $asesment['keterangan_status_kelainan_kepala'] . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <th>Leher</th>
            <td><?= $asesment['status_kelainan_leher'] ?>
                <?= $asesment['keterangan_status_kelainan_leher'] ? ' (' . $asesment['keterangan_status_kelainan_leher'] . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <th>Dada</th>
            <td><?= $asesment['status_kelainan_dada'] ?>
                <?= $asesment['keterangan_status_kelainan_dada'] ? ' (' . $asesment['keterangan_status_kelainan_dada'] . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <th>Perut</th>
            <td><?= $asesment['status_kelainan_perut'] ?>
                <?= $asesment['keterangan_status_kelainan_perut'] ? ' (' . $asesment['keterangan_status_kelainan_perut'] . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <th>Anggota Gerak</th>
            <td><?= $asesment['status_kelainan_anggota_gerak'] ?>
                <?= $asesment['keterangan_status_kelainan_anggota_gerak'] ? ' (' . $asesment['keterangan_status_kelainan_anggota_gerak'] . ')' : '' ?>
            </td>
        </tr>
    </table>

    <div class="section-title">III. STATUS LOKALISATA</div>
    <?php if (!empty($asesment['status_lokalisata'])): ?>
        <p><b>Keterangan:</b> <?= nl2br($asesment['status_lokalisata']) ?></p>
    <?php endif; ?>
    <div style="text-align: center; margin: 10px 0;">
        <?php if (file_exists($lokalis_path)): ?>
            <img src="<?= $lokalis_path ?>" style="width: 100%; max-width: 600px; border: 1px solid #ccc;">
        <?php else: ?>
            <p><i>Tidak ada gambar lokalis.</i></p>
        <?php endif; ?>
    </div>

    <div class="section-title">IV. STATUS PSIKIATRIK</div>
    <table class="table-data">
        <tr>
            <th width="30%">Kesan Umum</th>
            <td><?= $asesment['psikiatrik_kesan_umum'] ?></td>
        </tr>
        <tr>
            <th>Sikap & Prilaku</th>
            <td><?= $asesment['psikiatrik_sikap_prilaku'] ?></td>
        </tr>
        <tr>
            <th>Kesadaran</th>
            <td><?= $asesment['psikiatrik_kesadaran'] ?></td>
        </tr>
        <tr>
            <th>Orientasi</th>
            <td><?= $asesment['psikiatrik_orientasi'] ?></td>
        </tr>
        <tr>
            <th>Daya Ingat</th>
            <td><?= $asesment['psikiatrik_daya_ingat'] ?></td>
        </tr>
        <tr>
            <th>Persepsi</th>
            <td><?= $asesment['psikiatrik_persepsi'] ?></td>
        </tr>
        <tr>
            <th>Pikiran</th>
            <td><?= $asesment['psikiatrik_pikiran'] ?></td>
        </tr>
        <tr>
            <th>Insight</th>
            <td><?= $asesment['psikiatrik_insight'] ?></td>
        </tr>
    </table>

    <div class="section-title">V. PEMERIKSAAN PENUNJANG</div>
    <table class="table-data">
        <tr>
            <th>Laboratorium</th>
            <td><?= nl2br($asesment['laborat']) ?></td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td><?= nl2br($asesment['radiologi']) ?></td>
        </tr>
        <tr>
            <th>EKG</th>
            <td><?= nl2br($asesment['ekg']) ?></td>
        </tr>
    </table>

    <div class="section-title">VI. DIAGNOSIS & TERAPI</div>
    <table class="table-data">
        <tr>
            <th>Diagnosis</th>
            <td><?= nl2br($asesment['diagnosis']) ?></td>
        </tr>
        <tr>
            <th>Permasalahan</th>
            <td><?= nl2br($asesment['permasalahan']) ?></td>
        </tr>
        <tr>
            <th>Instruksi Medis</th>
            <td><?= nl2br($asesment['instruksi_medis']) ?></td>
        </tr>
        <tr>
            <th>Rencana/Target</th>
            <td><?= nl2br($asesment['rencana_target']) ?></td>
        </tr>
        <tr>
            <th>Edukasi</th>
            <td><?= nl2br($asesment['edukasi']) ?></td>
        </tr>
    </table>

    <div class="section-title">VII. KELUAR IGD</div>
    <table width="100%" class="no-border">
        <tr>
            <td width="30%"><b>Dipulangkan:</b></td>
            <td><?= $asesment['pulang_dipulangkan'] ?> (<?= $asesment['keterangan_pulang_dipulangkan'] ?>)</td>
        </tr>
        <tr>
            <td><b>Pulang Paksa:</b></td>
            <td><?= $asesment['pulang_paksa'] ?> (<?= $asesment['keterangan_pulang_paksa'] ?>)</td>
        </tr>
        <tr>
            <td><b>Dirawat di Ruang:</b></td>
            <td><?= $asesment['pulang_dirawat_diruang'] ?> (Indikasi: <?= $asesment['pulang_indikasi_ranap'] ?>)</td>
        </tr>
        <tr>
            <td><b>Dirujuk:</b></td>
            <td><?= $asesment['pulang_dirujuk_ke'] ?> (Alasan: <?= $asesment['pulang_alasan_dirujuk'] ?>)</td>
        </tr>
        <tr>
            <td><b>Meninggal di IGD:</b></td>
            <td><?= $asesment['pulang_meninggal_igd'] ?> (Penyebab: <?= $asesment['pulang_penyebab_kematian'] ?>)</td>
        </tr>
    </table>

    <p style="margin-top:10px;"><b>Kondisi Saat Pulang:</b></p>
    <table width="100%" class="no-border" style="border-top:1px solid #ddd; padding-top:5px;">
        <tr>
            <td>Kesadaran: <?= $asesment['fisik_pulang_kesadaran'] ?></td>
            <td>GCS: <?= $asesment['fisik_pulang_gcs'] ?></td>
            <td>TD: <?= $asesment['fisik_pulang_td'] ?> mmHg</td>
            <td>Nadi: <?= $asesment['fisik_pulang_nadi'] ?> x/mnt</td>
            <td>Suhu: <?= $asesment['fisik_pulang_suhu'] ?> &deg;C</td>
            <td>RR: <?= $asesment['fisik_pulang_rr'] ?> x/mnt</td>
        </tr>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Dokter Penanggung Jawab,</p>
        <br><br><br>
        <p><b>( <?= $detail_pasien['nm_dokter'] ?> )</b></p>
    </div>

</body>

</html>
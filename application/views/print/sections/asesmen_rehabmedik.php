<?php if (!empty($d->asesmenRehabMedik)): ?>
    <div class="print-section">
        <h3 style="background-color: #e3f2fd; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #1976d2;">
            ♿ ASESMEN AWAL MEDIS REHAB MEDIK
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->asesmenRehabMedik->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->asesmenRehabMedik->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->asesmenRehabMedik->anamnesis ?? '-' ?>)
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->asesmenRehabMedik->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->asesmenRehabMedik->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->asesmenRehabMedik->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->asesmenRehabMedik->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- TANDA VITAL -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. TANDA VITAL
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 33%;"><strong>TD:</strong> <?= $d->asesmenRehabMedik->td ?? '-' ?> mmHg</td>
                <td style="width: 33%;"><strong>Nadi:</strong> <?= $d->asesmenRehabMedik->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 33%;"><strong>RR:</strong> <?= $d->asesmenRehabMedik->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>Suhu:</strong> <?= $d->asesmenRehabMedik->suhu ?? '-' ?> °C</td>
                <td><strong>BB:</strong> <?= $d->asesmenRehabMedik->bb ?? '-' ?> kg</td>
                <td><strong>Kesadaran:</strong> <?= $d->asesmenRehabMedik->kesadaran ?? '-' ?></td>
            </tr>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Penilaian Nyeri:</strong> Skala <?= $d->asesmenRehabMedik->skala_nyeri ?? '-' ?> -
            <?= $d->asesmenRehabMedik->nyeri ?? '-' ?>
        </div>

        <!-- PEMERIKSAAN SISTEMIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PEMERIKSAAN SISTEMIK
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
            <tr style="background: #f0f0f0;">
                <th style="padding: 5px; text-align: left;">Sistem</th>
                <th style="padding: 5px; text-align: center;">Status</th>
                <th style="padding: 5px; text-align: left;">Keterangan</th>
            </tr>
            <tr>
                <td style="padding: 5px;">Kepala/Leher</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->kepala ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_kepala ?? '-' ?></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Thorak/Jantung/Paru</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->thoraks ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_thoraks ?? '-' ?></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Abdomen</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->abdomen ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_abdomen ?? '-' ?></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Ekstremitas</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->ekstremitas ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_ekstremitas ?? '-' ?></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Columna Vertebralis</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->columna ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_columna ?? '-' ?></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Muskuloskeletal</td>
                <td style="padding: 5px; text-align: center;"><?= $d->asesmenRehabMedik->muskulos ?? '-' ?></td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->keterangan_muskulos ?? '-' ?></td>
            </tr>
        </table>

        <?php if (!empty($d->asesmenRehabMedik->lainnya)): ?>
            <p><strong>Pemeriksaan Lainnya:</strong><br><?= nl2br($d->asesmenRehabMedik->lainnya) ?></p>
        <?php endif; ?>

        <!-- PENILAIAN RISIKO & FUNGSIONAL -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PENILAIAN RISIKO & FUNGSIONAL
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Risiko Jatuh</td>
                <td>: <?= $d->asesmenRehabMedik->resiko_jatuh ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Risiko Nutrisional</td>
                <td>: <?= $d->asesmenRehabMedik->resiko_nutrisional ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Kebutuhan Fungsional</td>
                <td>: <?= $d->asesmenRehabMedik->kebutuhan_fungsional ?? '-' ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosa Medis</td>
                <td>: <?= nl2br($d->asesmenRehabMedik->diagnosa_medis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Diagnosa Fungsi</td>
                <td>: <?= nl2br($d->asesmenRehabMedik->diagnosa_fungsi ?? '-') ?></td>
            </tr>
        </table>

        <!-- PROGRAM TERAPI -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VI. PROGRAM TERAPI
        </div>
        <?php if (!empty($d->asesmenRehabMedik->penunjang_lain)): ?>
            <p><strong>Penunjang Lain:</strong> <?= $d->asesmenRehabMedik->penunjang_lain ?></p>
        <?php endif; ?>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
            <tr style="background: #f0f0f0;">
                <th style="padding: 5px; text-align: left;">Jenis Terapi</th>
                <th style="padding: 5px; text-align: left;">Tindakan / Keterangan</th>
                <th style="padding: 5px; text-align: center;">Rencana Tanggal</th>
            </tr>
            <tr>
                <td style="padding: 5px;">Fisioterapi</td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->fisio ?? '-' ?></td>
                <td style="padding: 5px; text-align: center;">
                    <?= ($d->asesmenRehabMedik->fisioterapi != '0000-00-00') ? date('d-m-Y', strtotime($d->asesmenRehabMedik->fisioterapi)) : '-' ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px;">Okupasi Terapi</td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->okupasi ?? '-' ?></td>
                <td style="padding: 5px; text-align: center;">
                    <?= ($d->asesmenRehabMedik->terapi_okupasi != '0000-00-00') ? date('d-m-Y', strtotime($d->asesmenRehabMedik->terapi_okupasi)) : '-' ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px;">Terapi Wicara</td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->wicara ?? '-' ?></td>
                <td style="padding: 5px; text-align: center;">
                    <?= ($d->asesmenRehabMedik->terapi_wicara != '0000-00-00') ? date('d-m-Y', strtotime($d->asesmenRehabMedik->terapi_wicara)) : '-' ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px;">Akupuntur</td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->akupuntur ?? '-' ?></td>
                <td style="padding: 5px; text-align: center;">
                    <?= ($d->asesmenRehabMedik->terapi_akupuntur != '0000-00-00') ? date('d-m-Y', strtotime($d->asesmenRehabMedik->terapi_akupuntur)) : '-' ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px;">Tata Laksana Lain</td>
                <td style="padding: 5px;"><?= $d->asesmenRehabMedik->tatalain ?? '-' ?></td>
                <td style="padding: 5px; text-align: center;">
                    <?= ($d->asesmenRehabMedik->terapi_lainnya != '0000-00-00') ? date('d-m-Y', strtotime($d->asesmenRehabMedik->terapi_lainnya)) : '-' ?>
                </td>
            </tr>
        </table>

        <p><strong>Frekuensi Terapi:</strong> <?= $d->asesmenRehabMedik->frekuensi_terapi ?? '-' ?></p>

        <?php if (!empty($d->asesmenRehabMedik->edukasi)): ?>
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <strong>Edukasi:</strong><br><?= nl2br($d->asesmenRehabMedik->edukasi) ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
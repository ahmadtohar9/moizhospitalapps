<?php if (!empty($d->neurologi)): ?>
    <div class="print-section">
        <h3 style="background-color: #ede7f6; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #673ab7;">
            🧠 ASESMEN AWAL MEDIS NEUROLOGI
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->neurologi->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->neurologi->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->neurologi->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->neurologi->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->neurologi->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->neurologi->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->neurologi->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->neurologi->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->neurologi->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->neurologi->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 33%;"><strong>Kesadaran:</strong> <?= $d->neurologi->kesadaran ?? '-' ?></td>
                <td style="width: 33%;"><strong>GCS:</strong> <?= $d->neurologi->gcs ?? '-' ?></td>
                <td style="width: 33%;"><strong>Status Pasien:</strong> <?= $d->neurologi->status ?? '-' ?></td>
            </tr>
        </table>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 20%;"><strong>TD:</strong> <?= $d->neurologi->td ?? '-' ?> mmHg</td>
                <td style="width: 20%;"><strong>Nadi:</strong> <?= $d->neurologi->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 20%;"><strong>RR:</strong> <?= $d->neurologi->rr ?? '-' ?> x/mnt</td>
                <td style="width: 20%;"><strong>Suhu:</strong> <?= $d->neurologi->suhu ?? '-' ?> °C</td>
                <td style="width: 20%;"><strong>BB:</strong> <?= $d->neurologi->bb ?? '-' ?> Kg</td>
            </tr>
            <tr>
                <td colspan="5"><strong>Nyeri:</strong> <?= $d->neurologi->nyeri ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN SISTEMIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PEMERIKSAAN SISTEMIK (NEUROLOGIS)
        </div>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <p><strong>Kepala:</strong> <?= $d->neurologi->kepala ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_kepala)): ?><br><small>(<?= $d->neurologi->keterangan_kepala ?>)</small><?php endif; ?>
                        </p>

                        <p><strong>Thoraks:</strong> <?= $d->neurologi->thoraks ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_thoraks)): ?><br><small>(<?= $d->neurologi->keterangan_thoraks ?>)</small><?php endif; ?>
                        </p>

                        <p><strong>Abdomen:</strong> <?= $d->neurologi->abdomen ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_abdomen)): ?><br><small>(<?= $d->neurologi->keterangan_abdomen ?>)</small><?php endif; ?>
                        </p>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <p><strong>Ekstremitas:</strong> <?= $d->neurologi->ekstremitas ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_ekstremitas)): ?><br><small>(<?= $d->neurologi->keterangan_ekstremitas ?>)</small><?php endif; ?>
                        </p>

                        <p><strong>Columna Vertebralis:</strong> <?= $d->neurologi->columna ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_columna)): ?><br><small>(<?= $d->neurologi->keterangan_columna ?>)</small><?php endif; ?>
                        </p>

                        <p><strong>Muskuloskeletal:</strong> <?= $d->neurologi->muskulos ?? '-' ?>
                            <?php if (!empty($d->neurologi->keterangan_muskulos)): ?><br><small>(<?= $d->neurologi->keterangan_muskulos ?>)</small><?php endif; ?>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- STATUS LOKALIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. STATUS LOKALIS & KETERANGAN LAINNYA
        </div>
        <p><?= nl2br($d->neurologi->lainnya ?? '-') ?></p>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($d->neurologi->lab ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($d->neurologi->rad ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Penunjang Lain</td>
                <td>: <?= nl2br($d->neurologi->penunjanglain ?? '-') ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VI. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->neurologi->diagnosis ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->neurologi->diagnosis2)): ?>
                <tr>
                    <td style="font-weight: bold;">Diagnosis Sekunder</td>
                    <td>: <?= nl2br($d->neurologi->diagnosis2) ?></td>
                </tr><?php endif; ?>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($d->neurologi->permasalahan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Terapi/Pengobatan</td>
                <td>: <?= nl2br($d->neurologi->terapi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tindakan</td>
                <td>: <?= nl2br($d->neurologi->tindakan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($d->neurologi->edukasi ?? '-') ?></td>
            </tr>
        </table>
    </div>
<?php endif; ?>
<?php if (!empty($d->psikiatrik)): ?>
    <div class="print-section">
        <h3 style="background-color: #e8eaf6; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #3f51b5;">
            🧠 ASESMEN AWAL MEDIS PSIKIATRIK (JIWA)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->psikiatrik->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->psikiatrik->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->psikiatrik->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->psikiatrik->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->psikiatrik->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->psikiatrik->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->psikiatrik->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->psikiatrik->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Keluarga</td>
                <td>: <?= nl2br($d->psikiatrik->rpk ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->psikiatrik->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->psikiatrik->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- STATUS PSIKIATRIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. STATUS PSIKIATRIK
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 30%; font-weight: bold;">Penampilan</td>
                <td>: <?= $d->psikiatrik->penampilan ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pembicaraan</td>
                <td>: <?= $d->psikiatrik->pembicaraan ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Psikomotor</td>
                <td>: <?= $d->psikiatrik->psikomotor ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Sikap</td>
                <td>: <?= $d->psikiatrik->sikap ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Mood / Afek</td>
                <td>: <?= $d->psikiatrik->mood ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Fungsi Kognitif</td>
                <td>: <?= $d->psikiatrik->fungsi_kognitif ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Gangguan Persepsi</td>
                <td>: <?= $d->psikiatrik->gangguan_persepsi ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Proses Pikir</td>
                <td>: <?= $d->psikiatrik->proses_pikir ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pengendalian Impuls</td>
                <td>: <?= $d->psikiatrik->pengendalian_impuls ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tilikan</td>
                <td>: <?= $d->psikiatrik->tilikan ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">RTA</td>
                <td>: <?= $d->psikiatrik->rta ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PEMERIKSAAN FISIK
        </div>
        <table style="width: 100%; margin-bottom: 5px;">
            <tr>
                <td style="width: 33%;"><strong>Keadaan Umum:</strong> <?= $d->psikiatrik->keadaan ?? '-' ?></td>
                <td style="width: 33%;"><strong>Kesadaran:</strong> <?= $d->psikiatrik->kesadaran ?? '-' ?></td>
                <td style="width: 33%;"><strong>GCS:</strong> <?= $d->psikiatrik->gcs ?? '-' ?></td>
            </tr>
        </table>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->psikiatrik->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->psikiatrik->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->psikiatrik->rr ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->psikiatrik->suhu ?? '-' ?> °C</td>
            </tr>
            <tr>
                <td><strong>SpO2:</strong> <?= $d->psikiatrik->spo ?? '-' ?> %</td>
                <td><strong>BB:</strong> <?= $d->psikiatrik->bb ?? '-' ?> kg</td>
                <td><strong>TB:</strong> <?= $d->psikiatrik->tb ?? '-' ?> cm</td>
                <td></td>
            </tr>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Pemeriksaan Sistemik:</strong><br>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%;"><strong>Kepala:</strong> <?= $d->psikiatrik->kepala ?? '-' ?></td>
                    <td style="width: 25%;"><strong>Gigi & Mulut:</strong> <?= $d->psikiatrik->gigi ?? '-' ?></td>
                    <td style="width: 25%;"><strong>THT:</strong> <?= $d->psikiatrik->tht ?? '-' ?></td>
                    <td style="width: 25%;"><strong>Thoraks:</strong> <?= $d->psikiatrik->thoraks ?? '-' ?></td>
                </tr>
                <tr>
                    <td><strong>Abdomen:</strong> <?= $d->psikiatrik->abdomen ?? '-' ?></td>
                    <td><strong>Genital:</strong> <?= $d->psikiatrik->genital ?? '-' ?></td>
                    <td><strong>Ekstremitas:</strong> <?= $d->psikiatrik->ekstremitas ?? '-' ?></td>
                    <td><strong>Kulit:</strong> <?= $d->psikiatrik->kulit ?? '-' ?></td>
                </tr>
            </table>
            <?php if (!empty($d->psikiatrik->ket_fisik)): ?>
                <p style="margin: 10px 0 0 0;"><strong>Keterangan Fisik:</strong><br><?= nl2br($d->psikiatrik->ket_fisik) ?></p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <p><?= nl2br($d->psikiatrik->penunjang ?? '-') ?></p>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis</td>
                <td>: <?= nl2br($d->psikiatrik->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tatalaksana</td>
                <td>: <?= nl2br($d->psikiatrik->tata ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Konsul/Rujuk</td>
                <td>: <?= nl2br($d->psikiatrik->konsulrujuk ?? '-') ?></td>
            </tr>
        </table>
    </div>
<?php endif; ?>
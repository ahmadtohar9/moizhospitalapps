<?php if (!empty($d->anak)): ?>
    <div class="print-section">
        <h3 style="background-color: #e3f2fd; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #2196F3;">
            📋 ASESMEN AWAL MEDIS ANAK (PEDIATRI)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->anak->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->anak->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->anak->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->anak->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->anak->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->anak->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->anak->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->anak->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Keluarga</td>
                <td>: <?= nl2br($d->anak->rpk ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->anak->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->anak->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>Keadaan Umum:</strong> <?= $d->anak->keadaan ?? '-' ?></td>
                <td style="width: 25%;"><strong>Kesadaran:</strong> <?= $d->anak->kesadaran ?? '-' ?></td>
                <td style="width: 25%;"><strong>GCS:</strong> <?= $d->anak->gcs ?? '-' ?></td>
                <td style="width: 25%;"><strong>SpO₂:</strong> <?= $d->anak->spo ?? '-' ?>%</td>
            </tr>
            <tr>
                <td><strong>TD:</strong> <?= $d->anak->td ?? '-' ?> mmHg</td>
                <td><strong>Nadi:</strong> <?= $d->anak->nadi ?? '-' ?> x/mnt</td>
                <td><strong>Suhu:</strong> <?= $d->anak->suhu ?? '-' ?> °C</td>
                <td><strong>RR:</strong> <?= $d->anak->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->anak->bb ?? '-' ?> kg</td>
                <td><strong>TB:</strong> <?= $d->anak->tb ?? '-' ?> cm</td>
                <td colspan="2"></td>
            </tr>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Pemeriksaan Sistemik:</strong><br>
            <table style="width: 100%; margin-top: 5px;">
                <tr>
                    <td style="width: 33%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Kepala:</strong> <?= $d->anak->kepala ?? '-' ?></li>
                            <li><strong>Mata:</strong> <?= $d->anak->mata ?? '-' ?></li>
                            <li><strong>Gigi & Mulut:</strong> <?= $d->anak->gigi ?? '-' ?></li>
                        </ul>
                    </td>
                    <td style="width: 33%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>THT:</strong> <?= $d->anak->tht ?? '-' ?></li>
                            <li><strong>Thoraks:</strong> <?= $d->anak->thoraks ?? '-' ?></li>
                            <li><strong>Abdomen:</strong> <?= $d->anak->abdomen ?? '-' ?></li>
                        </ul>
                    </td>
                    <td style="width: 34%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Genital:</strong> <?= $d->anak->genital ?? '-' ?></li>
                            <li><strong>Ekstremitas:</strong> <?= $d->anak->ekstremitas ?? '-' ?></li>
                            <li><strong>Kulit:</strong> <?= $d->anak->kulit ?? '-' ?></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <?php if (!empty($d->anak->ket_fisik)): ?>
                <p style="margin: 10px 0 0 0;"><strong>Keterangan Pemeriksaan
                        Fisik:</strong><br><?= nl2br($d->anak->ket_fisik) ?></p>
            <?php endif; ?>
        </div>

        <!-- STATUS LOKALIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. STATUS LOKALIS
        </div>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_anak/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)):
                ?>
                <img src="<?= base_url('assets/images/lokalis_anak/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
            <?php endif; ?>
            <?php if (!empty($d->anak->ket_lokalis)): ?>
                <p style="margin: 10px 0;"><strong>Keterangan:</strong> <?= nl2br($d->anak->ket_lokalis) ?></p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <p><?= nl2br($d->anak->penunjang ?? '-') ?></p>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis</td>
                <td>: <?= nl2br($d->anak->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tatalaksana</td>
                <td>: <?= nl2br($d->anak->tata ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->anak->konsul)): ?>
                <tr>
                    <td style="font-weight: bold;">Konsultasi/Rujukan</td>
                    <td>: <?= nl2br($d->anak->konsul) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
<?php endif; ?>
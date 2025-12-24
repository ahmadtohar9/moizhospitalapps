<?php if (!empty($d->geriatri)): ?>
    <div class="print-section">
        <h3 style="background-color: #fff8e1; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #ffc107;">
            👵 ASESMEN AWAL MEDIS GERIATRI
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->geriatri->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->geriatri->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->geriatri->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->geriatri->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->geriatri->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->geriatri->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->geriatri->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->geriatri->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->geriatri->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->geriatri->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->geriatri->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->geriatri->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->geriatri->suhu ?? '-' ?> °C</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->geriatri->rr ?? '-' ?> x/mnt</td>
            </tr>
            <?php if (!empty($d->geriatri->kondisi_umum)): ?>
                <tr>
                    <td colspan="4"><strong>Kondisi Umum:</strong> <?= $d->geriatri->kondisi_umum ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($d->geriatri->tulang_belakang)): ?>
                <tr>
                    <td colspan="4"><strong>Tulang Belakang:</strong> <?= $d->geriatri->tulang_belakang ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- PENGKAJIAN KHUSUS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PENGKAJIAN KHUSUS GERIATRI
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Status Psikologis (GDS)</td>
                <td>: <?= $d->geriatri->status_psikologis_gds ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Status Kognitif (MMSE)</td>
                <td>: <?= $d->geriatri->status_kognitif_mmse ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Status Fungsional</td>
                <td>: <?= $d->geriatri->status_fungsional ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Status Nutrisi</td>
                <td>: <?= $d->geriatri->status_nutrisi ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Risiko Jatuh</td>
                <td>: <?= $d->geriatri->skrining_jatuh ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Kondisi Sosial</td>
                <td>: <?= nl2br($d->geriatri->kondisi_sosial ?? '-') ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN SISTEMIK & INTEGUMENT -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN SISTEMIK & INTEGUMENT
        </div>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%; vertical-align: top;">
                        <strong>Kepala:</strong> <?= $d->geriatri->kepala ?? '-' ?>
                        <?php if (!empty($d->geriatri->keterangan_kepala)): ?><br><small>(<?= $d->geriatri->keterangan_kepala ?>)</small><?php endif; ?>
                    </td>
                    <td style="width: 25%; vertical-align: top;">
                        <strong>Thoraks:</strong> <?= $d->geriatri->thoraks ?? '-' ?>
                        <?php if (!empty($d->geriatri->keterangan_thoraks)): ?><br><small>(<?= $d->geriatri->keterangan_thoraks ?>)</small><?php endif; ?>
                    </td>
                    <td style="width: 25%; vertical-align: top;">
                        <strong>Abdomen:</strong> <?= $d->geriatri->abdomen ?? '-' ?>
                        <?php if (!empty($d->geriatri->keterangan_abdomen)): ?><br><small>(<?= $d->geriatri->keterangan_abdomen ?>)</small><?php endif; ?>
                    </td>
                    <td style="width: 25%; vertical-align: top;">
                        <strong>Ekstremitas:</strong> <?= $d->geriatri->ekstremitas ?? '-' ?>
                        <?php if (!empty($d->geriatri->keterangan_ekstremitas)): ?><br><small>(<?= $d->geriatri->keterangan_ekstremitas ?>)</small><?php endif; ?>
                    </td>
                </tr>
            </table>

            <div style="margin-top: 10px; border-top: 1px dashed #ccc; padding-top: 10px;">
                <strong>Pemeriksaan Integument (Kulit):</strong>
                <ul style="margin: 5px 0 0 20px;">
                    <li><strong>Kebersihan:</strong> <?= $d->geriatri->Integument_kebersihan ?? '-' ?></li>
                    <li><strong>Warna:</strong> <?= $d->geriatri->Integument_warna ?? '-' ?></li>
                    <li><strong>Kelembaban:</strong> <?= $d->geriatri->Integument_kelembaban ?? '-' ?></li>
                    <li><strong>Gangguan:</strong> <?= $d->geriatri->Integument_gangguan_kulit ?? '-' ?></li>
                </ul>
            </div>

            <?php if (!empty($d->geriatri->lainnya)): ?>
                <p style="margin: 10px 0 0 0;"><strong>Lainnya:</strong><br><?= nl2br($d->geriatri->lainnya) ?></p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <?php if (!empty($d->geriatri->lab)): ?>
                <tr>
                    <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                    <td>: <?= nl2br($d->geriatri->lab) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->rad)): ?>
                <tr>
                    <td style="font-weight: bold;">Radiologi</td>
                    <td>: <?= nl2br($d->geriatri->rad) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->pemeriksaan)): ?>
                <tr>
                    <td style="font-weight: bold;">Penunjang Lain</td>
                    <td>: <?= nl2br($d->geriatri->pemeriksaan) ?></td>
                </tr><?php endif; ?>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VI. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->geriatri->diagnosis ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->geriatri->diagnosis2)): ?>
                <tr>
                    <td style="font-weight: bold;">Diagnosis Sekunder</td>
                    <td>: <?= nl2br($d->geriatri->diagnosis2) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->permasalahan)): ?>
                <tr>
                    <td style="font-weight: bold;">Permasalahan</td>
                    <td>: <?= nl2br($d->geriatri->permasalahan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->terapi)): ?>
                <tr>
                    <td style="font-weight: bold;">Terapi/Pengobatan</td>
                    <td>: <?= nl2br($d->geriatri->terapi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->tindakan)): ?>
                <tr>
                    <td style="font-weight: bold;">Tindakan</td>
                    <td>: <?= nl2br($d->geriatri->tindakan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->geriatri->edukasi)): ?>
                <tr>
                    <td style="font-weight: bold;">Edukasi</td>
                    <td>: <?= nl2br($d->geriatri->edukasi) ?></td>
                </tr><?php endif; ?>
        </table>
    </div>
<?php endif; ?>
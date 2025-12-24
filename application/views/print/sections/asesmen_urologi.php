<?php if (!empty($d->asesmenUrologi)): ?>
    <div class="print-section">
        <h3 style="background-color: #e0f2f1; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #009688;">
            💧 ASESMEN AWAL MEDIS UROLOGI
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->asesmenUrologi->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->asesmenUrologi->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->asesmenUrologi->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->asesmenUrologi->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->asesmenUrologi->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->asesmenUrologi->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->asesmenUrologi->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->asesmenUrologi->rpd ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->asesmenUrologi->rpk)): ?>
                <tr>
                    <td style="font-weight: bold;">Riw. Penyakit Keluarga</td>
                    <td>: <?= nl2br($d->asesmenUrologi->rpk) ?></td>
                </tr><?php endif; ?>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->asesmenUrologi->rpo ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->asesmenUrologi->riwayat_kebiasaan)): ?>
                <tr>
                    <td style="font-weight: bold;">Riwayat Kebiasaan</td>
                    <td>: <?= nl2br($d->asesmenUrologi->riwayat_kebiasaan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->riwayat_operasi_urologi)): ?>
                <tr>
                    <td style="font-weight: bold;">Riw. Operasi Urologi</td>
                    <td>: <?= nl2br($d->asesmenUrologi->riwayat_operasi_urologi) ?></td>
                </tr><?php endif; ?>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->asesmenUrologi->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->asesmenUrologi->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->asesmenUrologi->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->asesmenUrologi->suhu ?? '-' ?> °C</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->asesmenUrologi->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->asesmenUrologi->bb ?? '-' ?> Kg</td>
                <td><strong>TB:</strong> <?= $d->asesmenUrologi->tb ?? '-' ?> cm</td>
                <td><strong>Nyeri:</strong> <?= $d->asesmenUrologi->nyeri ?? '-' ?></td>
                <td><strong>Status Nutrisi:</strong> <?= $d->asesmenUrologi->status_nutrisi ?? '-' ?></td>
            </tr>
            <?php if (!empty($d->asesmenUrologi->keadaan_umum)): ?>
                <tr>
                    <td colspan="4"><strong>Keadaan Umum:</strong> <?= $d->asesmenUrologi->keadaan_umum ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- PEMERIKSAAN SISTEMIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PEMERIKSAAN SISTEMIK
        </div>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 33%; vertical-align: top;">
                        <strong>Thoraks:</strong> <?= $d->asesmenUrologi->thoraks ?? '-' ?>
                        <?php if (!empty($d->asesmenUrologi->keterangan_thoraks)): ?><br><small>(<?= $d->asesmenUrologi->keterangan_thoraks ?>)</small><?php endif; ?>
                    </td>
                    <td style="width: 33%; vertical-align: top;">
                        <strong>Abdomen:</strong> <?= $d->asesmenUrologi->abdomen ?? '-' ?>
                        <?php if (!empty($d->asesmenUrologi->keterangan_abdomen)): ?><br><small>(<?= $d->asesmenUrologi->keterangan_abdomen ?>)</small><?php endif; ?>
                    </td>
                    <td style="width: 34%; vertical-align: top;">
                        <strong>Ekstrimitas:</strong> <?= $d->asesmenUrologi->ekstrimitas ?? '-' ?>
                        <?php if (!empty($d->asesmenUrologi->keterangan_ekstrimitas)): ?><br><small>(<?= $d->asesmenUrologi->keterangan_ekstrimitas ?>)</small><?php endif; ?>
                    </td>
                </tr>
            </table>

            <?php if (!empty($d->asesmenUrologi->nyeri_ketok_cva) || !empty($d->asesmenUrologi->genitalia_eksternal) || !empty($d->asesmenUrologi->colok_dubur)): ?>
                <div style="margin-top: 10px; border-top: 1px dashed #ccc; padding-top: 10px;">
                    <table style="width: 100%;">
                        <tr>
                            <?php if (!empty($d->asesmenUrologi->nyeri_ketok_cva)): ?>
                                <td style="width: 33%;"><strong>Nyeri Ketok
                                        CVA:</strong><br><?= $d->asesmenUrologi->nyeri_ketok_cva ?></td>
                            <?php endif; ?>
                            <?php if (!empty($d->asesmenUrologi->genitalia_eksternal)): ?>
                                <td style="width: 33%;"><strong>Genitalia
                                        Eksternal:</strong><br><?= $d->asesmenUrologi->genitalia_eksternal ?></td>
                            <?php endif; ?>
                            <?php if (!empty($d->asesmenUrologi->colok_dubur)): ?>
                                <td style="width: 34%;"><strong>Colok Dubur:</strong><br><?= $d->asesmenUrologi->colok_dubur ?></td>
                            <?php endif; ?>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>

            <?php if (!empty($d->asesmenUrologi->lainnya)): ?>
                <p style="margin: 10px 0 0 0;"><strong>Lainnya:</strong><br><?= nl2br($d->asesmenUrologi->lainnya) ?></p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <?php if (!empty($d->asesmenUrologi->urinalisis)): ?>
                <tr>
                    <td style="width: 200px; font-weight: bold;">Urinalisis</td>
                    <td>: <?= nl2br($d->asesmenUrologi->urinalisis) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->darah)): ?>
                <tr>
                    <td style="font-weight: bold;">Darah</td>
                    <td>: <?= nl2br($d->asesmenUrologi->darah) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->usg_urologi)): ?>
                <tr>
                    <td style="font-weight: bold;">USG Urologi</td>
                    <td>: <?= nl2br($d->asesmenUrologi->usg_urologi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->radiologi)): ?>
                <tr>
                    <td style="font-weight: bold;">Radiologi</td>
                    <td>: <?= nl2br($d->asesmenUrologi->radiologi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->penunjang_lain)): ?>
                <tr>
                    <td style="font-weight: bold;">Penunjang Lain</td>
                    <td>: <?= nl2br($d->asesmenUrologi->penunjang_lain) ?></td>
                </tr><?php endif; ?>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->asesmenUrologi->diagnosis ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->asesmenUrologi->diagnosis2)): ?>
                <tr>
                    <td style="font-weight: bold;">Diagnosis Sekunder</td>
                    <td>: <?= nl2br($d->asesmenUrologi->diagnosis2) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->permasalahan)): ?>
                <tr>
                    <td style="font-weight: bold;">Permasalahan</td>
                    <td>: <?= nl2br($d->asesmenUrologi->permasalahan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->terapi)): ?>
                <tr>
                    <td style="font-weight: bold;">Terapi/Pengobatan</td>
                    <td>: <?= nl2br($d->asesmenUrologi->terapi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->tindakan)): ?>
                <tr>
                    <td style="font-weight: bold;">Tindakan</td>
                    <td>: <?= nl2br($d->asesmenUrologi->tindakan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->asesmenUrologi->edukasi)): ?>
                <tr>
                    <td style="font-weight: bold;">Edukasi</td>
                    <td>: <?= nl2br($d->asesmenUrologi->edukasi) ?></td>
                </tr><?php endif; ?>
        </table>
    </div>
<?php endif; ?>
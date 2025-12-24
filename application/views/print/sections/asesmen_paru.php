<?php if (!empty($d->paru)): ?>
    <div class="print-section">
        <h3 style="background-color: #e0f7fa; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #00bcd4;">
            🫁 ASESMEN AWAL MEDIS PARU (PULMONOLOGI)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->paru->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->paru->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->paru->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->paru->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->paru->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->paru->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->paru->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->paru->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->paru->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->paru->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 33%;"><strong>Kesadaran:</strong> <?= $d->paru->kesadaran ?? '-' ?></td>
                <td style="width: 33%;"><strong>GCS:</strong> <?= $d->paru->gcs ?? '-' ?></td>
                <td style="width: 33%;"><strong>Status Pasien:</strong> <?= $d->paru->status ?? '-' ?></td>
            </tr>
        </table>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->paru->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->paru->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->paru->rr ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->paru->suhu ?? '-' ?> °C</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->paru->bb ?? '-' ?> Kg</td>
                <td colspan="3"><strong>Nyeri:</strong> <?= $d->paru->nyeri ?? '-' ?> (1-10)</td>
            </tr>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Pemeriksaan Sistemik:</strong><br>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Kepala:</strong> <?= $d->paru->kepala ?? '-' ?></li>
                            <li><strong>Thoraks:</strong> <?= $d->paru->thoraks ?? '-' ?></li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Abdomen:</strong> <?= $d->paru->abdomen ?? '-' ?></li>
                            <li><strong>Muskuloskeletal:</strong> <?= $d->paru->muskulos ?? '-' ?></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <?php if (!empty($d->paru->lainnya)): ?>
                <p style="margin: 10px 0 0 0;"><strong>Pemeriksaan Lainnya:</strong><br><?= nl2br($d->paru->lainnya) ?></p>
            <?php endif; ?>
        </div>

        <!-- STATUS LOKALIS PARU -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. STATUS LOKALIS PARU
        </div>
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    <?php
                    $clean_no_rawat = str_replace('/', '', $d->no_rawat);
                    $lokalis_path = FCPATH . 'assets/images/lokalis_paru/lokalis_' . $clean_no_rawat . '.png';
                    if (file_exists($lokalis_path)): ?>
                        <img src="<?= base_url('assets/images/lokalis_paru/lokalis_' . $clean_no_rawat . '.png') ?>"
                            style="max-width: 100%; border: 1px solid #ddd;">
                    <?php else: ?>
                        <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
                    <?php endif; ?>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 15px;">
                    <strong>Keterangan Lokalis:</strong>
                    <div style="border: 1px solid #ddd; padding: 5px; margin-top: 5px;">
                        <?= nl2br($d->paru->ket_lokalis ?? '-') ?></div>
                </td>
            </tr>
        </table>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <?php if (!empty($d->paru->lab)): ?>
                <tr>
                    <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                    <td>: <?= nl2br($d->paru->lab) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->paru->rad)): ?>
                <tr>
                    <td style="font-weight: bold;">Radiologi</td>
                    <td>: <?= nl2br($d->paru->rad) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->paru->pemeriksaan)): ?>
                <tr>
                    <td style="font-weight: bold;">Pemeriksaan Lain</td>
                    <td>: <?= nl2br($d->paru->pemeriksaan) ?></td>
                </tr><?php endif; ?>
            <?php if (empty($d->paru->lab) && empty($d->paru->rad) && empty($d->paru->pemeriksaan)): ?>
                <tr>
                    <td colspan="2">- Tidak ada data penunjang -</td>
                </tr><?php endif; ?>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->paru->diagnosis ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->paru->diagnosis2)): ?>
                <tr>
                    <td style="font-weight: bold;">Diagnosis Sekunder</td>
                    <td>: <?= nl2br($d->paru->diagnosis2) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->paru->permasalahan)): ?>
                <tr>
                    <td style="font-weight: bold;">Permasalahan</td>
                    <td>: <?= nl2br($d->paru->permasalahan) ?></td>
                </tr><?php endif; ?>
            <tr>
                <td style="font-weight: bold;">Terapi</td>
                <td>: <?= nl2br($d->paru->terapi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tindakan</td>
                <td>: <?= nl2br($d->paru->tindakan ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->paru->edukasi)): ?>
                <tr>
                    <td style="font-weight: bold;">Edukasi</td>
                    <td>: <?= nl2br($d->paru->edukasi) ?></td>
                </tr><?php endif; ?>
        </table>
    </div>
<?php endif; ?>
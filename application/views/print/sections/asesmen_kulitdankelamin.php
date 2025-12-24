<?php if (!empty($d->kulitdankelamin)): ?>
    <div class="print-section">
        <h3 style="background-color: #f3e5f5; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #9c27b0;">
            🧴 ASESMEN AWAL MEDIS KULIT DAN KELAMIN (DERMATOLOGI)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->kulitdankelamin->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->kulitdankelamin->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->kulitdankelamin->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->kulitdankelamin->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->kulitdankelamin->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->kulitdankelamin->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->kulitdankelamin->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->kulitdankelamin->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->kulitdankelamin->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->kulitdankelamin->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>Status:</strong> <?= $d->kulitdankelamin->status ?? '-' ?></td>
                <td style="width: 25%;"><strong>Kesadaran:</strong> <?= $d->kulitdankelamin->kesadaran ?? '-' ?></td>
                <td style="width: 25%;"><strong>GCS:</strong> <?= $d->kulitdankelamin->gcs ?? '-' ?></td>
                <td style="width: 25%;"></td>
            </tr>
            <tr>
                <td><strong>TD:</strong> <?= $d->kulitdankelamin->td ?? '-' ?> mmHg</td>
                <td><strong>Nadi:</strong> <?= $d->kulitdankelamin->nadi ?? '-' ?> x/mnt</td>
                <td><strong>Suhu:</strong> <?= $d->kulitdankelamin->suhu ?? '-' ?> °C</td>
                <td><strong>RR:</strong> <?= $d->kulitdankelamin->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->kulitdankelamin->bb ?? '-' ?> Kg</td>
                <td><strong>Nyeri:</strong> <?= $d->kulitdankelamin->nyeri ?? '-' ?></td>
                <td colspan="2"></td>
            </tr>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Pemeriksaan Organ:</strong><br>
            <table style="width: 100%; margin-top: 5px;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Kepala:</strong> <?= $d->kulitdankelamin->kepala ?? '-' ?></li>
                            <li><strong>Thoraks:</strong> <?= $d->kulitdankelamin->thoraks ?? '-' ?></li>
                            <li><strong>Abdomen:</strong> <?= $d->kulitdankelamin->abdomen ?? '-' ?></li>
                            <li><strong>Ekstremitas:</strong> <?= $d->kulitdankelamin->ekstremitas ?? '-' ?></li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Genetalia:</strong> <?= $d->kulitdankelamin->genetalia ?? '-' ?></li>
                            <li><strong>Columna:</strong> <?= $d->kulitdankelamin->columna ?? '-' ?></li>
                            <li><strong>Muskulos:</strong> <?= $d->kulitdankelamin->muskulos ?? '-' ?></li>
                            <li><strong>Lainnya:</strong> <?= $d->kulitdankelamin->lainnya ?? '-' ?></li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <!-- STATUS LOKALIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. STATUS LOKALIS
        </div>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_kulitdankelamin/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)):
                ?>
                <img src="<?= base_url('assets/images/lokalis_kulitdankelamin/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
            <?php endif; ?>
            <?php if (!empty($d->kulitdankelamin->ket_lokalis)): ?>
                <p style="margin: 10px 0; text-align: left;"><strong>Keterangan:</strong>
                    <?= nl2br($d->kulitdankelamin->ket_lokalis) ?></p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($d->kulitdankelamin->lab ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($d->kulitdankelamin->rad ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pemeriksaan Lain</td>
                <td>: <?= nl2br($d->kulitdankelamin->pemeriksaan ?? '-') ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS & PERENCANAAN -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & PERENCANAAN
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->kulitdankelamin->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Diagnosis Banding</td>
                <td>: <?= nl2br($d->kulitdankelamin->diagnosis2 ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($d->kulitdankelamin->permasalahan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Terapi/Pengobatan</td>
                <td>: <?= nl2br($d->kulitdankelamin->terapi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tindakan</td>
                <td>: <?= nl2br($d->kulitdankelamin->tindakan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($d->kulitdankelamin->edukasi ?? '-') ?></td>
            </tr>
        </table>
    </div>
<?php endif; ?>
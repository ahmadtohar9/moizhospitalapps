<?php if (!empty($d->bedah)): ?>
    <div class="print-section">
        <h3 style="background-color: #ffebee; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #f44336;">
            🏥 ASESMEN AWAL MEDIS BEDAH
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->bedah->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->bedah->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->bedah->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->bedah->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->bedah->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->bedah->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->bedah->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->bedah->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->bedah->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->bedah->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>Status:</strong> <?= $d->bedah->status ?? '-' ?></td>
                <td style="width: 25%;"><strong>Kesadaran:</strong> <?= $d->bedah->kesadaran ?? '-' ?></td>
                <td style="width: 25%;"><strong>GCS:</strong> <?= $d->bedah->gcs ?? '-' ?></td>
                <td style="width: 25%;"><strong>Nyeri:</strong> <?= $d->bedah->nyeri ?? '-' ?></td>
            </tr>
            <tr>
                <td><strong>TD:</strong> <?= $d->bedah->td ?? '-' ?> mmHg</td>
                <td><strong>Nadi:</strong> <?= $d->bedah->nadi ?? '-' ?> x/mnt</td>
                <td><strong>Suhu:</strong> <?= $d->bedah->suhu ?? '-' ?> °C</td>
                <td><strong>RR:</strong> <?= $d->bedah->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->bedah->bb ?? '-' ?> Kg</td>
                <td colspan="3"></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN SISTEMIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. PEMERIKSAAN SISTEMIK
        </div>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Kepala:</strong> <?= $d->bedah->kepala ?? '-' ?></li>
                            <li><strong>Thoraks:</strong> <?= $d->bedah->thoraks ?? '-' ?></li>
                            <li><strong>Abdomen:</strong> <?= $d->bedah->abdomen ?? '-' ?></li>
                            <li><strong>Ekstremitas:</strong> <?= $d->bedah->ekstremitas ?? '-' ?></li>
                        </ul>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <li><strong>Genetalia:</strong> <?= $d->bedah->genetalia ?? '-' ?></li>
                            <li><strong>Columna Vertebralis:</strong> <?= $d->bedah->columna ?? '-' ?></li>
                            <li><strong>Muskuloskeletal:</strong> <?= $d->bedah->muskulos ?? '-' ?></li>
                            <?php if (!empty($d->bedah->lainnya)): ?>
                                <li><strong>Lainnya:</strong> <?= $d->bedah->lainnya ?></li>
                            <?php endif; ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <!-- STATUS LOKALIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. STATUS LOKALIS
        </div>
        <?php if (!empty($d->bedah->ket_lokalis)): ?>
            <p style="margin: 5px 0;"><strong>Keterangan:</strong> <?= nl2br($d->bedah->ket_lokalis) ?></p>
        <?php endif; ?>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_bedah/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)):
                ?>
                <img src="<?= base_url('assets/images/lokalis_bedah/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($d->bedah->lab ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($d->bedah->rad ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pemeriksaan Lain</td>
                <td>: <?= nl2br($d->bedah->pemeriksaan ?? '-') ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VI. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->bedah->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Diagnosis Sekunder</td>
                <td>: <?= nl2br($d->bedah->diagnosis2 ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($d->bedah->permasalahan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Terapi/Pengobatan</td>
                <td>: <?= nl2br($d->bedah->terapi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tindakan</td>
                <td>: <?= nl2br($d->bedah->tindakan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($d->bedah->edukasi ?? '-') ?></td>
            </tr>
        </table>
    </div>
<?php endif; ?>
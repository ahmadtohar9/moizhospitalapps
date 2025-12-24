<?php if (!empty($d->tht)): ?>
    <div class="print-section">
        <h3 style="background-color: #fff3e0; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #ff9800;">
            👂 ASESMEN AWAL MEDIS THT
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->tht->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->tht->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->tht->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->tht->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->tht->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->tht->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->tht->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->tht->rpd ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->tht->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->tht->alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->tht->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->tht->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->tht->suhu ?? '-' ?> °C</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->tht->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->tht->bb ?? '-' ?> Kg</td>
                <td><strong>TB:</strong> <?= $d->tht->tb ?? '-' ?> cm</td>
                <td><strong>Nyeri:</strong> <?= $d->tht->nyeri ?? '-' ?></td>
                <td><strong>Status Nutrisi:</strong> <?= $d->tht->status_nutrisi ?? '-' ?></td>
            </tr>
        </table>

        <?php if (!empty($d->tht->kondisi)): ?>
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <strong>Kondisi Umum:</strong><br>
                <?= nl2br($d->tht->kondisi) ?>
            </div>
        <?php endif; ?>

        <!-- STATUS LOKALIS THT -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. STATUS LOKALIS THT
        </div>
        <?php if (!empty($d->tht->ket_lokalis)): ?>
            <p style="margin: 5px 0;"><strong>Keterangan:</strong> <?= nl2br($d->tht->ket_lokalis) ?></p>
        <?php endif; ?>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_tht/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)):
                ?>
                <img src="<?= base_url('assets/images/lokalis_tht/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
            <?php endif; ?>
        </div>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($d->tht->lab ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($d->tht->rad ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tes Pendengaran</td>
                <td>: <?= nl2br($d->tht->tes_pendengaran ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Penunjang Lain</td>
                <td>: <?= nl2br($d->tht->penunjang ?? '-') ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS & TATALAKSANA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. DIAGNOSIS & TATALAKSANA
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis Utama</td>
                <td>: <?= nl2br($d->tht->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Diagnosis Banding</td>
                <td>: <?= nl2br($d->tht->diagnosisbanding ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($d->tht->permasalahan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Terapi/Pengobatan</td>
                <td>: <?= nl2br($d->tht->terapi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tindakan</td>
                <td>: <?= nl2br($d->tht->tindakan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tatalaksana</td>
                <td>: <?= nl2br($d->tht->tatalaksana ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($d->tht->edukasi ?? '-') ?></td>
            </tr>
        </table>
    </div>
<?php endif; ?>
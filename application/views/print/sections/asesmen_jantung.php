<?php if (!empty($d->jantung)): ?>
    <div class="print-section">
        <h3 style="background-color: #ffcdd2; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #e91e63;">
            ❤️ ASESMEN AWAL MEDIS JANTUNG (KARDIOLOGI)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->jantung->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->jantung->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">I. ANAMNESIS
            (<?= $d->jantung->anamnesis ?? '-' ?>)</div>
        <?php if (!empty($d->jantung->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $d->jantung->hubungan ?></p><?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->jantung->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
                <td>: <?= nl2br($d->jantung->rps ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= nl2br($d->jantung->rpd ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->jantung->rpk)): ?>
                <tr>
                    <td style="font-weight: bold;">Riw. Penyakit Keluarga</td>
                    <td>: <?= nl2br($d->jantung->rpk) ?></td>
                </tr><?php endif; ?>
            <tr>
                <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
                <td>: <?= nl2br($d->jantung->rpo ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->jantung->alergi ?? '-' ?></td>
            </tr>
        </table>

        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">II. PEMERIKSAAN FISIK</div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 25%;"><strong>TD:</strong> <?= $d->jantung->td ?? '-' ?> mmHg</td>
                <td style="width: 25%;"><strong>Nadi:</strong> <?= $d->jantung->nadi ?? '-' ?> x/mnt</td>
                <td style="width: 25%;"><strong>Suhu:</strong> <?= $d->jantung->suhu ?? '-' ?> °C</td>
                <td style="width: 25%;"><strong>RR:</strong> <?= $d->jantung->rr ?? '-' ?> x/mnt</td>
            </tr>
            <tr>
                <td><strong>BB:</strong> <?= $d->jantung->bb ?? '-' ?> Kg</td>
                <td><strong>TB:</strong> <?= $d->jantung->tb ?? '-' ?> cm</td>
                <td><strong>Nyeri:</strong> <?= $d->jantung->nyeri ?? '-' ?></td>
                <td><strong>Status Nutrisi:</strong> <?= $d->jantung->status_nutrisi ?? '-' ?></td>
            </tr>
            <?php if (!empty($d->jantung->keadaan_umum)): ?>
                <tr>
                    <td colspan="4"><strong>Keadaan Umum:</strong> <?= $d->jantung->keadaan_umum ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Pemeriksaan Sistemik:</strong><br>
            <p><strong>Jantung:</strong> <?= $d->jantung->jantung ?? '-' ?>
                <?php if (!empty($d->jantung->keterangan_jantung)): ?><br><small><i>Ket:
                            <?= $d->jantung->keterangan_jantung ?></i></small><?php endif; ?>
            </p>
            <p><strong>Paru:</strong> <?= $d->jantung->paru ?? '-' ?>
                <?php if (!empty($d->jantung->keterangan_paru)): ?><br><small><i>Ket:
                            <?= $d->jantung->keterangan_paru ?></i></small><?php endif; ?>
            </p>
            <p><strong>Ekstrimitas:</strong> <?= $d->jantung->ekstrimitas ?? '-' ?>
                <?php if (!empty($d->jantung->keterangan_ekstrimitas)): ?><br><small><i>Ket:
                            <?= $d->jantung->keterangan_ekstrimitas ?></i></small><?php endif; ?>
            </p>
            <?php if (!empty($d->jantung->lainnya)): ?>
                <p><strong>Lainnya:</strong> <?= nl2br($d->jantung->lainnya) ?></p><?php endif; ?>
        </div>

        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">III. STATUS LOKALIS</div>
        <?php if (!empty($d->jantung->ket_lokalis)): ?>
            <p><strong>Keterangan:</strong> <?= nl2br($d->jantung->ket_lokalis) ?></p><?php endif; ?>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_jantung/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)): ?>
                <img src="<?= base_url('assets/images/lokalis_jantung/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p><?php endif; ?>
        </div>

        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">IV. PEMERIKSAAN PENUNJANG</div>
        <table style="width: 100%; margin-bottom: 10px;">
            <?php if (!empty($d->jantung->lab)): ?>
                <tr>
                    <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                    <td>: <?= nl2br($d->jantung->lab) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->jantung->ekg)): ?>
                <tr>
                    <td style="font-weight: bold;">EKG</td>
                    <td>: <?= nl2br($d->jantung->ekg) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->jantung->penunjang_lain)): ?>
                <tr>
                    <td style="font-weight: bold;">Penunjang Lain</td>
                    <td>: <?= nl2br($d->jantung->penunjang_lain) ?></td>
                </tr><?php endif; ?>
        </table>

        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">V. DIAGNOSIS & TATALAKSANA</div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis</td>
                <td>: <?= nl2br($d->jantung->diagnosis ?? '-') ?></td>
            </tr>
            <?php if (!empty($d->jantung->diagnosis2)): ?>
                <tr>
                    <td style="font-weight: bold;">Diagnosis Sekunder</td>
                    <td>: <?= nl2br($d->jantung->diagnosis2) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->jantung->terapi)): ?>
                <tr>
                    <td style="font-weight: bold;">Terapi</td>
                    <td>: <?= nl2br($d->jantung->terapi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->jantung->tindakan)): ?>
                <tr>
                    <td style="font-weight: bold;">Tindakan</td>
                    <td>: <?= nl2br($d->jantung->tindakan) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($d->jantung->edukasi)): ?>
                <tr>
                    <td style="font-weight: bold;">Edukasi</td>
                    <td>: <?= nl2br($d->jantung->edukasi) ?></td>
                </tr><?php endif; ?>
        </table>
    </div>
<?php endif; ?>
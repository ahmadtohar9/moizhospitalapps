<?php
/**
 * SECTION: FORMULIR RAWAT JALAN KFR (Kedokteran Fisik & Rehabilitasi)
 */

// Handle data structure
$kfr_data = null;
if (isset($d->kfr)) {
    $kfr_data = $d->kfr;
} elseif (isset($d['kfr'])) {
    $kfr_data = $d['kfr'];
}

if (empty($kfr_data)) {
    return;
}
?>

<div class="print-section" style="margin: 10px 0; page-break-inside: avoid;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 5px 0 10px 0; font-size: 12pt;">
        FORMULIR RAWAT JALAN KEDOKTERAN FISIK & REHABILITASI (KFR)
    </h3>

    <?php foreach ($kfr_data as $idx => $item): ?>
        <table style="width: 100%; margin-bottom: 15px; border: 2px solid #000; page-break-inside: avoid;">
            <!-- HEADER -->
            <tr style="background-color: #d0d0d0;">
                <th colspan="2" style="padding: 6px; text-align: center; border-bottom: 2px solid #000; font-size: 10pt;">
                    FORMULIR KFR #<?= $idx + 1 ?> -
                    <?= date('d/m/Y H:i', strtotime($item->tgl_perawatan . ' ' . $item->jam_rawat)) ?>
                </th>
            </tr>

            <!-- INFO DOKTER -->
            <tr>
                <td style="width: 30%; padding: 4px; font-weight: bold; border-right: 1px solid #ccc; font-size: 9pt;">
                    Dokter Sp.KFR</td>
                <td style="padding: 4px; font-size: 9pt;"><?= htmlspecialchars($item->nm_dokter ?? '-') ?></td>
            </tr>

            <!-- SUBJECTIVE -->
            <?php if (!empty($item->subjective)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        S (SUBJECTIVE) - Keluhan Pasien
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->subjective)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- OBJECTIVE -->
            <?php if (!empty($item->objective)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        O (OBJECTIVE) - Pemeriksaan Fisik
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->objective)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- ASSESSMENT -->
            <?php if (!empty($item->assessment)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        A (ASSESSMENT) - Diagnosis Fungsional
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->assessment)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- GOAL OF TREATMENT -->
            <?php if (!empty($item->goal_of_treatment)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        TUJUAN TERAPI (Goal of Treatment)
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->goal_of_treatment)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- TINDAKAN REHAB -->
            <?php if (!empty($item->tindakan_rehab)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        TINDAKAN REHABILITASI MEDIK
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->tindakan_rehab)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- EDUKASI -->
            <?php if (!empty($item->edukasi)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        EDUKASI
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 6px; font-size: 9pt;">
                        <?= nl2br(htmlspecialchars($item->edukasi)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- FREKUENSI & RTL -->
            <?php if (!empty($item->frekuensi_kunjungan) || !empty($item->rencana_tindak_lanjut)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2"
                        style="padding: 4px; border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 9pt;">
                        RENCANA TINDAK LANJUT
                    </th>
                </tr>
                <?php if (!empty($item->frekuensi_kunjungan)): ?>
                    <tr>
                        <td style="padding: 4px; font-weight: bold; border-right: 1px solid #ccc; font-size: 9pt;">Frekuensi
                            Kunjungan</td>
                        <td style="padding: 4px; font-size: 9pt;"><?= htmlspecialchars($item->frekuensi_kunjungan) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($item->rencana_tindak_lanjut)): ?>
                    <tr>
                        <td colspan="2" style="padding: 6px; font-size: 9pt;">
                            <?= nl2br(htmlspecialchars($item->rencana_tindak_lanjut)) ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
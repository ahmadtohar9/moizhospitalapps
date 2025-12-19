<?php
/**
 * SECTION: PROGRAM TERAPI REHAB MEDIK
 */

// Handle data structure
$rehab_data = null;
if (isset($d->rehab_medik)) {
    $rehab_data = $d->rehab_medik;
} elseif (isset($d['rehab_medik'])) {
    $rehab_data = $d['rehab_medik'];
}

if (empty($rehab_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        PROGRAM TERAPI REHABILITASI MEDIK
    </h3>

    <?php foreach ($rehab_data as $idx => $item): ?>
        <table style="width: 100%; margin-bottom: 20px; border: 2px solid #000;">
            <!-- HEADER -->
            <tr style="background-color: #d0d0d0;">
                <th colspan="2" style="padding: 8px; text-align: center; border-bottom: 2px solid #000;">
                    PROGRAM REHAB MEDIK #<?= $idx + 1 ?> -
                    <?= date('d/m/Y H:i', strtotime($item->tgl_perawatan . ' ' . $item->jam_rawat)) ?>
                </th>
            </tr>

            <!-- INFO TIM -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="2" style="padding: 5px; border-bottom: 1px solid #000;">INFORMASI TIM</th>
            </tr>
            <tr>
                <td style="width: 30%; padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Dokter Penanggung
                    Jawab</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->nm_dokter ?? '-') ?></td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Tim Rehab Medik</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->nm_petugas ?? '-') ?></td>
            </tr>

            <!-- SUBJECTIVE -->
            <?php if (!empty($item->subjective)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        S (SUBJECTIVE) - Keluhan Pasien
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 8px;">
                        <?= nl2br(htmlspecialchars($item->subjective)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- OBJECTIVE -->
            <?php if (!empty($item->objective)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        O (OBJECTIVE) - Pemeriksaan Fisik
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 8px;">
                        <?= nl2br(htmlspecialchars($item->objective)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- ASSESSMENT -->
            <?php if (!empty($item->assessment)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        A (ASSESSMENT) - Diagnosis / Penilaian
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 8px;">
                        <?= nl2br(htmlspecialchars($item->assessment)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- PROCEDURE / PLAN -->
            <?php if (!empty($item->procedure_text)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="2" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        P (PROCEDURE) - Program Terapi / Tindakan
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 8px;">
                        <?= nl2br(htmlspecialchars($item->procedure_text)) ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
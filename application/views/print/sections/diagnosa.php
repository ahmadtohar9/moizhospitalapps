<?php
/**
 * SECTION: DIAGNOSA ICD-10
 */

// Handle data structure
$diagnosa_data = null;
if (isset($d->diagnosa)) {
    $diagnosa_data = $d->diagnosa;
} elseif (isset($d['diagnosa'])) {
    $diagnosa_data = $d['diagnosa'];
}

if (empty($diagnosa_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        DIAGNOSA (ICD-10)
    </h3>

    <table style="width: 100%; border: 1px solid #000;">
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%; padding: 5px; text-align: center; border: 1px solid #000;">No</th>
            <th style="width: 15%; padding: 5px; border: 1px solid #000;">Kode ICD-10</th>
            <th style="width: 50%; padding: 5px; border: 1px solid #000;">Nama Penyakit</th>
            <th style="width: 15%; padding: 5px; text-align: center; border: 1px solid #000;">Status</th>
            <th style="width: 15%; padding: 5px; text-align: center; border: 1px solid #000;">Prioritas</th>
        </tr>
        <?php foreach ($diagnosa_data as $index => $item): ?>
            <tr>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->kd_penyakit ?? '') ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->nm_penyakit ?? '') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;">
                    <?= ($item->status ?? '') == 'Ralan' ? 'Primer' : ($item->status ?? '-') ?>
                </td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $item->prioritas ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
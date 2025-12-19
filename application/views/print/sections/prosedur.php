<?php
/**
 * SECTION: PROSEDUR ICD-9
 */

// Handle data structure
$prosedur_data = null;
if (isset($d->prosedur)) {
    $prosedur_data = $d->prosedur;
} elseif (isset($d['prosedur'])) {
    $prosedur_data = $d['prosedur'];
}

if (empty($prosedur_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        PROSEDUR (ICD-9)
    </h3>

    <table style="width: 100%; border: 1px solid #000;">
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%; padding: 5px; text-align: center; border: 1px solid #000;">No</th>
            <th style="width: 15%; padding: 5px; border: 1px solid #000;">Kode ICD-9</th>
            <th style="width: 65%; padding: 5px; border: 1px solid #000;">Nama Prosedur</th>
            <th style="width: 15%; padding: 5px; text-align: center; border: 1px solid #000;">Prioritas</th>
        </tr>
        <?php foreach ($prosedur_data as $index => $item): ?>
            <tr>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->kode ?? '') ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->nama ?? '') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $item->prioritas ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
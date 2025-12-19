<?php
/**
 * SECTION: HASIL LABORATORIUM
 */

// Handle data structure
$lab_data = null;
if (isset($d->lab)) {
    $lab_data = $d->lab;
} elseif (isset($d['lab'])) {
    $lab_data = $d['lab'];
}

if (empty($lab_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        HASIL LABORATORIUM
    </h3>

    <table style="width: 100%; border: 1px solid #000;">
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%; padding: 5px; text-align: center; border: 1px solid #000;">No</th>
            <th style="width: 15%; padding: 5px; border: 1px solid #000;">Tanggal</th>
            <th style="width: 20%; padding: 5px; border: 1px solid #000;">Panel/Jenis</th>
            <th style="width: 25%; padding: 5px; border: 1px solid #000;">Pemeriksaan</th>
            <th style="width: 15%; padding: 5px; text-align: center; border: 1px solid #000;">Hasil</th>
            <th style="width: 10%; padding: 5px; text-align: center; border: 1px solid #000;">Satuan</th>
            <th style="width: 10%; padding: 5px; text-align: center; border: 1px solid #000;">Rujukan</th>
        </tr>
        <?php foreach ($lab_data as $index => $item): ?>
            <tr>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= date('d/m/Y', strtotime($item->tgl_periksa ?? '')) ?>
                </td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->panel ?? '-') ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->pemeriksaan ?? '-') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000; font-weight: bold;">
                    <?= htmlspecialchars($item->hasil ?? '-') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;">
                    <?= htmlspecialchars($item->satuan ?? '-') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000; font-size: 8pt;">
                    <?= htmlspecialchars($item->rujukan ?? '-') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
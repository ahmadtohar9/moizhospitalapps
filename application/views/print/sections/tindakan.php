<?php
/**
 * SECTION: TINDAKAN
 */

// Handle data structure
$tindakan_data = null;
if (isset($d->tindakan)) {
    $tindakan_data = $d->tindakan;
} elseif (isset($d['tindakan'])) {
    $tindakan_data = $d['tindakan'];
}

if (empty($tindakan_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        TINDAKAN MEDIS
    </h3>

    <table style="width: 100%; border: 1px solid #000;">
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%; padding: 5px; text-align: center; border: 1px solid #000;">No</th>
            <th style="width: 15%; padding: 5px; border: 1px solid #000;">Tanggal</th>
            <th style="width: 10%; padding: 5px; border: 1px solid #000;">Jam</th>
            <th style="width: 40%; padding: 5px; border: 1px solid #000;">Nama Tindakan</th>
            <th style="width: 20%; padding: 5px; border: 1px solid #000;">Operator</th>
            <th style="width: 10%; padding: 5px; text-align: right; border: 1px solid #000;">Biaya</th>
        </tr>
        <?php foreach ($tindakan_data as $index => $item): ?>
            <tr>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                <td style="padding: 5px; border: 1px solid #000;">
                    <?= date('d/m/Y', strtotime($item->tgl_perawatan ?? '')) ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= $item->jam_rawat ?? '' ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->nm_perawatan ?? '') ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->operator ?? '') ?></td>
                <td style="padding: 5px; text-align: right; border: 1px solid #000;">Rp
                    <?= number_format($item->biaya_rawat ?? 0, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
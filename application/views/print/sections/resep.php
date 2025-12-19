<?php
/**
 * SECTION: RESEP OBAT
 */

// Handle data structure
$resep_data = null;
if (isset($d->resep)) {
    $resep_data = $d->resep;
} elseif (isset($d['resep'])) {
    $resep_data = $d['resep'];
}

if (empty($resep_data)) {
    return;
}

// Hitung total keseluruhan
$grand_total = 0;
foreach ($resep_data as $item) {
    $grand_total += ($item->total_biaya ?? 0);
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        RESEP OBAT
    </h3>

    <table style="width: 100%; border: 1px solid #000;">
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%; padding: 5px; text-align: center; border: 1px solid #000;">No</th>
            <th style="width: 15%; padding: 5px; border: 1px solid #000;">Tanggal</th>
            <th style="width: 35%; padding: 5px; border: 1px solid #000;">Nama Obat</th>
            <th style="width: 10%; padding: 5px; text-align: center; border: 1px solid #000;">Jumlah</th>
            <th style="width: 25%; padding: 5px; border: 1px solid #000;">Aturan Pakai</th>
            <th style="width: 10%; padding: 5px; text-align: right; border: 1px solid #000;">Total</th>
        </tr>
        <?php foreach ($resep_data as $index => $item): ?>
            <tr>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                <td style="padding: 5px; border: 1px solid #000;">
                    <?= date('d/m/Y', strtotime($item->tgl_perawatan ?? '')) ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->nama_obat ?? '') ?></td>
                <td style="padding: 5px; text-align: center; border: 1px solid #000;"><?= $item->jml ?? '' ?></td>
                <td style="padding: 5px; border: 1px solid #000;"><?= htmlspecialchars($item->aturan_pakai ?? '') ?></td>
                <td style="padding: 5px; text-align: right; border: 1px solid #000;">Rp
                    <?= number_format($item->total_biaya ?? 0, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>

        <!-- TOTAL KESELURUHAN -->
        <tr style="background-color: #f5f5f5;">
            <td colspan="5" style="padding: 8px; text-align: right; font-weight: bold; border: 1px solid #000;">
                TOTAL KESELURUHAN:
            </td>
            <td style="padding: 8px; text-align: right; font-weight: bold; border: 1px solid #000; font-size: 11pt;">
                Rp <?= number_format($grand_total, 0, ',', '.') ?>
            </td>
        </tr>
    </table>
</div>
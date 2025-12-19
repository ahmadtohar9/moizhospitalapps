<?php
/**
 * SECTION: HASIL RADIOLOGI
 */

// Handle data structure
$radiologi_data = null;
if (isset($d->radiologi)) {
    $radiologi_data = $d->radiologi;
} elseif (isset($d['radiologi'])) {
    $radiologi_data = $d['radiologi'];
}

if (empty($radiologi_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        HASIL RADIOLOGI
    </h3>

    <?php foreach ($radiologi_data as $index => $item): ?>
        <table style="width: 100%; margin-bottom: 15px; border: 1px solid #000;">
            <tr style="background-color: #f5f5f5;">
                <th colspan="2" style="padding: 5px; text-align: left; border-bottom: 1px solid #000;">
                    RADIOLOGI #<?= $index + 1 ?> - <?= date('d/m/Y', strtotime($item->tgl_periksa ?? '')) ?>
                    <?= $item->jam ?? '' ?>
                </th>
            </tr>
            <tr>
                <td style="width: 30%; padding: 5px; font-weight: bold;">Jenis Pemeriksaan</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->nm_perawatan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold;">Dokter Perujuk</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->nm_dokter ?? '-') ?></td>
            </tr>
            <?php if (!empty($item->proyeksi)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Proyeksi</td>
                    <td style="padding: 5px;"><?= htmlspecialchars($item->proyeksi) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->keterangan)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; vertical-align: top;">Keterangan/Hasil</td>
                    <td style="padding: 5px;"><?= nl2br(htmlspecialchars($item->keterangan)) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
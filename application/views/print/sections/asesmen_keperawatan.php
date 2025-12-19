<?php
/**
 * SECTION: ASESMEN AWAL KEPERAWATAN
 */

// Handle data structure
$keperawatan_data = null;
if (isset($d->asesmen_keperawatan)) {
    $keperawatan_data = $d->asesmen_keperawatan;
} elseif (isset($d['asesmen_keperawatan'])) {
    $keperawatan_data = $d['asesmen_keperawatan'];
}

if (empty($keperawatan_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        ASESMEN AWAL KEPERAWATAN RAWAT JALAN
    </h3>

    <?php foreach ($keperawatan_data as $idx => $item): ?>
        <table style="width: 100%; margin-bottom: 20px; border: 2px solid #000;">
            <!-- HEADER -->
            <tr style="background-color: #d0d0d0;">
                <th colspan="4" style="padding: 8px; text-align: center; border-bottom: 2px solid #000;">
                    ASESMEN KEPERAWATAN #<?= $idx + 1 ?> - <?= date('d/m/Y H:i', strtotime($item->tanggal ?? '')) ?>
                </th>
            </tr>

            <!-- INFO PETUGAS -->
            <tr>
                <td colspan="4" style="padding: 5px;"><strong>Perawat:</strong>
                    <?= htmlspecialchars($item->nm_petugas ?? '-') ?></td>
            </tr>

            <!-- KEADAAN UMUM & VITAL SIGNS -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">KEADAAN
                    UMUM & TANDA VITAL</th>
            </tr>
            <tr>
                <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Tekanan Darah</td>
                <td style="width: 25%; padding: 5px; border-right: 1px solid #ccc;">
                    <?= htmlspecialchars($item->td ?? '-') ?> mmHg</td>
                <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Nadi</td>
                <td style="width: 25%; padding: 5px;"><?= htmlspecialchars($item->nadi ?? '-') ?> x/menit</td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Respirasi</td>
                <td style="padding: 5px; border-right: 1px solid #ccc;"><?= htmlspecialchars($item->rr ?? '-') ?> x/menit
                </td>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Suhu</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->suhu ?? '-') ?> °C</td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">GCS</td>
                <td style="padding: 5px; border-right: 1px solid #ccc;"><?= htmlspecialchars($item->gcs ?? '-') ?></td>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">BB / TB</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->bb ?? '-') ?> kg /
                    <?= htmlspecialchars($item->tb ?? '-') ?> cm</td>
            </tr>

            <!-- KELUHAN UTAMA -->
            <?php if (!empty($item->keluhan_utama)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">KELUHAN
                        UTAMA</th>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 8px;"><?= nl2br(htmlspecialchars($item->keluhan_utama)) ?></td>
                </tr>
            <?php endif; ?>

            <!-- RIWAYAT -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">RIWAYAT
                </th>
            </tr>
            <?php if (!empty($item->rpd)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Riwayat Penyakit Dahulu</td>
                    <td colspan="3" style="padding: 5px;"><?= htmlspecialchars($item->rpd) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->rpk)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Riwayat Penyakit Keluarga</td>
                    <td colspan="3" style="padding: 5px;"><?= htmlspecialchars($item->rpk) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->alergi)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Riwayat Alergi</td>
                    <td colspan="3" style="padding: 5px;"><?= htmlspecialchars($item->alergi) ?></td>
                </tr>
            <?php endif; ?>

            <!-- SKRINING NYERI -->
            <?php if (!empty($item->nyeri) && $item->nyeri != 'Tidak Ada Nyeri'): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">SKRINING
                        NYERI</th>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Status Nyeri</td>
                    <td style="padding: 5px; border-right: 1px solid #ccc;"><?= htmlspecialchars($item->nyeri) ?></td>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Skala Nyeri</td>
                    <td style="padding: 5px;"><?= htmlspecialchars($item->skala_nyeri ?? '-') ?>/10</td>
                </tr>
                <?php if (!empty($item->lokasi)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Lokasi Nyeri</td>
                        <td colspan="3" style="padding: 5px;"><?= htmlspecialchars($item->lokasi) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <!-- RISIKO JATUH -->
            <?php if (!empty($item->hasil)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">SKRINING
                        RISIKO JATUH</th>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 8px;"><?= htmlspecialchars($item->hasil) ?></td>
                </tr>
            <?php endif; ?>

            <!-- SKRINING GIZI -->
            <?php if (!empty($item->total_hasil)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">SKRINING
                        GIZI</th>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Total Skor</td>
                    <td colspan="3" style="padding: 5px;"><?= htmlspecialchars($item->total_hasil) ?></td>
                </tr>
            <?php endif; ?>

            <!-- RENCANA KEPERAWATAN -->
            <?php if (!empty($item->rencana)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">RENCANA
                        KEPERAWATAN</th>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 8px;"><?= nl2br(htmlspecialchars($item->rencana)) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
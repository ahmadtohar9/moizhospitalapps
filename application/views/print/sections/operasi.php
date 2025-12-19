<?php
/**
 * SECTION: OPERASI
 */

// Handle data structure
$operasi_data = null;
if (isset($d->operasi)) {
    $operasi_data = $d->operasi;
} elseif (isset($d['operasi'])) {
    $operasi_data = $d['operasi'];
}

if (empty($operasi_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        LAPORAN OPERASI
    </h3>

    <?php foreach ($operasi_data as $index => $item): ?>
        <table style="width: 100%; margin-bottom: 20px; border: 2px solid #000;">
            <!-- HEADER -->
            <tr style="background-color: #d0d0d0;">
                <th colspan="4" style="padding: 8px; text-align: center; border-bottom: 2px solid #000; font-size: 11pt;">
                    LAPORAN OPERASI #<?= $index + 1 ?> - <?= date('d/m/Y', strtotime($item->tgl_operasi ?? '')) ?>
                </th>
            </tr>

            <!-- INFO DASAR -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="4" style="padding: 5px; border-bottom: 1px solid #000;">INFORMASI OPERASI</th>
            </tr>
            <tr>
                <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Tanggal Operasi</td>
                <td style="width: 25%; padding: 5px; border-right: 1px solid #ccc;">
                    <?= date('d/m/Y H:i', strtotime($item->tgl_operasi ?? '')) ?>
                </td>
                <td style="width: 25%; padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Kategori</td>
                <td style="width: 25%; padding: 5px;"><?= htmlspecialchars($item->kategori ?? '-') ?></td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Jenis Anestesi</td>
                <td style="padding: 5px; border-right: 1px solid #ccc;">
                    <?= htmlspecialchars($item->jenis_anasthesi ?? '-') ?>
                </td>
                <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Status</td>
                <td style="padding: 5px;"><?= htmlspecialchars($item->status ?? '-') ?></td>
            </tr>


            <!-- BIAYA OPERASI -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">BIAYA
                    OPERASI</th>
            </tr>
            <tr style="background-color: #f5f5f5;">
                <td colspan="3" style="padding: 8px; text-align: right; font-weight: bold; font-size: 11pt;">
                    TOTAL BIAYA OPERASI:
                </td>
                <td style="padding: 8px; font-weight: bold; font-size: 12pt; color: #28a745;">
                    Rp <?= number_format($item->total_biaya ?? 0, 0, ',', '.') ?>
                </td>
            </tr>


            <!-- TIM OPERASI -->
            <tr style="background-color: #f0f0f0;">
                <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">TIM OPERASI
                </th>
            </tr>
            <?php if (!empty($item->operator1) || !empty($item->nm_operator1)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Operator 1</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_operator1 ?? $item->operator1 ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->operator2) || !empty($item->nm_operator2)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Operator 2</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_operator2 ?? $item->operator2 ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->operator3) || !empty($item->nm_operator3)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Operator 3</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_operator3 ?? $item->operator3 ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->dokter_anestesi) || !empty($item->nm_dokter_anestesi)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Dokter Anestesi</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_dokter_anestesi ?? $item->dokter_anestesi ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->asisten_operator1) || !empty($item->nm_asisten_operator1)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Asisten Operator 1</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_asisten_operator1 ?? $item->asisten_operator1 ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($item->asisten_anestesi) || !empty($item->nm_asisten_anestesi)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Asisten Anestesi</td>
                    <td colspan="3" style="padding: 5px;">
                        <?= htmlspecialchars($item->nm_asisten_anestesi ?? $item->asisten_anestesi ?? '-') ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- PAKET OPERASI -->
            <?php if (!empty($item->kode_paket) || !empty($item->nm_paket_operasi)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">PAKET
                        OPERASI</th>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Kode Paket</td>
                    <td style="padding: 5px; border-right: 1px solid #ccc;"><?= htmlspecialchars($item->kode_paket ?? '-') ?>
                    </td>
                    <td style="padding: 5px; font-weight: bold; border-right: 1px solid #ccc;">Nama Paket</td>
                    <td style="padding: 5px;"><?= htmlspecialchars($item->nm_paket_operasi ?? '-') ?></td>
                </tr>
            <?php endif; ?>

            <!-- DIAGNOSA -->
            <?php if (!empty($item->diagnosa_preop) || !empty($item->diagnosa_postop)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">DIAGNOSA
                    </th>
                </tr>
                <?php if (!empty($item->diagnosa_preop)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">Diagnosa
                            Pre-Operasi</td>
                        <td colspan="3" style="padding: 5px;"><?= nl2br(htmlspecialchars($item->diagnosa_preop)) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($item->diagnosa_postop)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">Diagnosa
                            Post-Operasi</td>
                        <td colspan="3" style="padding: 5px;"><?= nl2br(htmlspecialchars($item->diagnosa_postop)) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <!-- LAPORAN OPERASI -->
            <?php if (!empty($item->jaringan_dieksekusi) || !empty($item->selesaioperasi) || !empty($item->permintaan_pa)): ?>
                <tr style="background-color: #f0f0f0;">
                    <th colspan="4" style="padding: 5px; border-top: 1px solid #000; border-bottom: 1px solid #000;">LAPORAN
                        OPERASI</th>
                </tr>
                <?php if (!empty($item->jaringan_dieksekusi)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">Jaringan
                            yang Dieksekusi</td>
                        <td colspan="3" style="padding: 5px;"><?= nl2br(htmlspecialchars($item->jaringan_dieksekusi)) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($item->selesaioperasi)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">Laporan
                            Operasi</td>
                        <td colspan="3" style="padding: 5px;"><?= nl2br(htmlspecialchars($item->selesaioperasi)) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($item->permintaan_pa)): ?>
                    <tr>
                        <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">Permintaan
                            PA</td>
                        <td colspan="3" style="padding: 5px;"><?= nl2br(htmlspecialchars($item->permintaan_pa)) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
<?php
// Handle data structure
$pd = null;
if (isset($d->penyakit_dalam)) {
    $pd = $d->penyakit_dalam;
} elseif (isset($d['penyakit_dalam'])) {
    $pd = (object) $d['penyakit_dalam'];
}

if (!$pd) {
    return; // Tidak ada data penyakit dalam
}

if (!function_exists('val')) {
    function val($v)
    {
        return ($v !== null && $v !== '') ? $v : '-';
    }
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        ASESMEN AWAL MEDIS PENYAKIT DALAM
    </h3>

    <!-- ANAMNESIS -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">I. ANAMNESIS</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Jenis Anamnesis</td>
            <td style="padding: 5px;">: <?= val($pd->anamnesis ?? '') ?></td>
        </tr>
        <?php if (isset($pd->anamnesis) && $pd->anamnesis == 'Alloanamnesis'): ?>
            <tr>
                <td style="padding: 5px; font-weight: bold;">Hubungan dengan Pasien</td>
                <td style="padding: 5px;">: <?= val($pd->hubungan ?? '') ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Keluhan Utama</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->keluhan_utama ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penyakit Sekarang</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->rps ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penyakit Dahulu</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->rpd ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penggunaan Obat</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->rpo ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Alergi</td>
            <td style="padding: 5px;">: <?= val($pd->alergi ?? '') ?></td>
        </tr>
    </table>

    <!-- PEMERIKSAAN FISIK -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">II. PEMERIKSAAN FISIK</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Kondisi</td>
            <td style="width: 25%; padding: 5px;">: <?= val($pd->kondisi ?? '') ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Status</td>
            <td style="width: 25%; padding: 5px;">: <?= val($pd->status ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">GCS</td>
            <td style="padding: 5px;">: <?= val($pd->gcs ?? '') ?></td>
            <td style="padding: 5px; font-weight: bold;">Kesadaran</td>
            <td style="padding: 5px;">: <?= val($pd->kesadaran ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">TD</td>
            <td style="padding: 5px;">: <?= val($pd->td ?? '') ?> mmHg</td>
            <td style="padding: 5px; font-weight: bold;">Nadi</td>
            <td style="padding: 5px;">: <?= val($pd->nadi ?? '') ?> x/mnt</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Suhu</td>
            <td style="padding: 5px;">: <?= val($pd->suhu ?? '') ?> °C</td>
            <td style="padding: 5px; font-weight: bold;">RR</td>
            <td style="padding: 5px;">: <?= val($pd->rr ?? '') ?> x/mnt</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">BB</td>
            <td style="padding: 5px;">: <?= val($pd->bb ?? '') ?> Kg</td>
            <td style="padding: 5px; font-weight: bold;">Nyeri</td>
            <td style="padding: 5px;">: <?= val($pd->nyeri ?? '') ?></td>
        </tr>
    </table>

    <!-- PEMERIKSAAN ORGAN -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">Pemeriksaan Organ</th>
        </tr>
        <tr>
            <td style="padding: 5px;" colspan="2">
                <strong>• Kepala:</strong> <?= val($pd->kepala ?? '') ?>
                <?php if (isset($pd->keterangan_kepala) && $pd->keterangan_kepala): ?>
                    (<?= val($pd->keterangan_kepala) ?>)
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;" colspan="2">
                <strong>• Thoraks:</strong> <?= val($pd->thoraks ?? '') ?>
                <?php if (isset($pd->keterangan_thorak) && $pd->keterangan_thorak): ?>
                    (<?= val($pd->keterangan_thorak) ?>)
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;" colspan="2">
                <strong>• Abdomen:</strong> <?= val($pd->abdomen ?? '') ?>
                <?php if (isset($pd->keterangan_abdomen) && $pd->keterangan_abdomen): ?>
                    (<?= val($pd->keterangan_abdomen) ?>)
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;" colspan="2">
                <strong>• Ekstremitas:</strong> <?= val($pd->ekstremitas ?? '') ?>
                <?php if (isset($pd->keterangan_ekstremitas) && $pd->keterangan_ekstremitas): ?>
                    (<?= val($pd->keterangan_ekstremitas) ?>)
                <?php endif; ?>
            </td>
        </tr>
        <?php if (isset($pd->lainnya) && $pd->lainnya): ?>
            <tr>
                <td style="padding: 5px;" colspan="2">
                    <strong>• Lainnya:</strong> <?= val($pd->lainnya) ?>
                </td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- PEMERIKSAAN PENUNJANG -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">III. PEMERIKSAAN PENUNJANG</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Laboratorium</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->lab ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Radiologi</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->rad ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Penunjang Lain</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->penunjanglain ?? '')) ?></td>
        </tr>
    </table>

    <!-- DIAGNOSIS & PERENCANAAN -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">IV. DIAGNOSIS & PERENCANAAN</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Diagnosis Kerja</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->diagnosis ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Diagnosis Banding</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->diagnosis2 ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Permasalahan</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->permasalahan ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Terapi/Pengobatan</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->terapi ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Tindakan</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->tindakan ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Edukasi</td>
            <td style="padding: 5px;">: <?= nl2br(val($pd->edukasi ?? '')) ?></td>
        </tr>
    </table>
</div>
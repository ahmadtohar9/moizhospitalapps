<?php
// Handle data structure
$ortho = null;
if (isset($d->orthopedi)) {
    $ortho = $d->orthopedi;
} elseif (isset($d['orthopedi'])) {
    $ortho = (object) $d['orthopedi'];
}

if (!$ortho) {
    return; // Tidak ada data orthopedi
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
        ASESMEN AWAL MEDIS ORTHOPEDI
    </h3>

    <!-- ANAMNESIS -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">I. ANAMNESIS</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Jenis Anamnesis</td>
            <td style="padding: 5px;">: <?= val($ortho->anamnesis) ?></td>
        </tr>
        <?php if ($ortho->anamnesis == 'Alloanamnesis'): ?>
            <tr>
                <td style="padding: 5px; font-weight: bold;">Hubungan dengan Pasien</td>
                <td style="padding: 5px;">: <?= val($ortho->hubungan) ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Keluhan Utama</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->keluhan_utama)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penyakit Sekarang</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->rps)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penyakit Dahulu</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->rpd)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penggunaan Obat</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->rpo)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Alergi</td>
            <td style="padding: 5px;">: <?= val($ortho->alergi) ?></td>
        </tr>
    </table>

    <!-- PEMERIKSAAN FISIK -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">II. PEMERIKSAAN FISIK</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Status</td>
            <td style="width: 25%; padding: 5px;">: <?= val($ortho->status) ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Kesadaran</td>
            <td style="width: 25%; padding: 5px;">: <?= val($ortho->kesadaran) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">GCS</td>
            <td style="padding: 5px;">: <?= val($ortho->gcs) ?></td>
            <td style="padding: 5px; font-weight: bold;">TD</td>
            <td style="padding: 5px;">: <?= val($ortho->td) ?> mmHg</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Nadi</td>
            <td style="padding: 5px;">: <?= val($ortho->nadi) ?> x/mnt</td>
            <td style="padding: 5px; font-weight: bold;">Suhu</td>
            <td style="padding: 5px;">: <?= val($ortho->suhu) ?> °C</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">RR</td>
            <td style="padding: 5px;">: <?= val($ortho->rr) ?> x/mnt</td>
            <td style="padding: 5px; font-weight: bold;">BB</td>
            <td style="padding: 5px;">: <?= val($ortho->bb) ?> Kg</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Nyeri</td>
            <td colspan="3" style="padding: 5px;">: <?= val($ortho->nyeri) ?></td>
        </tr>
    </table>

    <!-- PEMERIKSAAN ORGAN -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">Pemeriksaan Organ</th>
        </tr>
        <tr>
            <td style="width: 50%; padding: 5px; vertical-align: top;">
                <strong>Kepala:</strong> <?= val($ortho->kepala) ?><br>
                <strong>Thoraks:</strong> <?= val($ortho->thoraks) ?><br>
                <strong>Abdomen:</strong> <?= val($ortho->abdomen) ?><br>
                <strong>Ekstremitas:</strong> <?= val($ortho->ekstremitas) ?>
            </td>
            <td style="width: 50%; padding: 5px; vertical-align: top;">
                <strong>Genetalia:</strong> <?= val($ortho->genetalia) ?><br>
                <strong>Columna:</strong> <?= val($ortho->columna) ?><br>
                <strong>Muskulos:</strong> <?= val($ortho->muskulos) ?><br>
                <strong>Lainnya:</strong> <?= val($ortho->lainnya) ?>
            </td>
        </tr>
    </table>

    <!-- STATUS LOKALIS -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th style="background-color: #f0f0f0; padding: 5px;">III. STATUS LOKALIS</th>
        </tr>
        <tr>
            <td style="padding: 10px; text-align: center;">
                <?php if (!empty($ortho->lokalis_url)): ?>
                    <img src="<?= $ortho->lokalis_url ?>"
                        style="max-width: 400px; max-height: 400px; border: 1px solid #ccc;">
                <?php else: ?>
                    <em>Tidak ada gambar lokalis</em>
                <?php endif; ?>
                <p style="margin-top: 10px;"><strong>Keterangan:</strong> <?= nl2br(val($ortho->ket_lokalis)) ?></p>
            </td>
        </tr>
    </table>

    <!-- PEMERIKSAAN PENUNJANG -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">IV. PEMERIKSAAN PENUNJANG</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Laboratorium</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->lab)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Radiologi</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->rad)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Pemeriksaan Lain</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->pemeriksaan)) ?></td>
        </tr>
    </table>

    <!-- DIAGNOSIS & PERENCANAAN -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px;">V. DIAGNOSIS & PERENCANAAN</th>
        </tr>
        <tr>
            <td style="width: 30%; padding: 5px; font-weight: bold;">Diagnosis Utama</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->diagnosis)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Diagnosis Banding</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->diagnosis2)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Permasalahan</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->permasalahan)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Terapi/Pengobatan</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->terapi)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Tindakan</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->tindakan)) ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Edukasi</td>
            <td style="padding: 5px;">: <?= nl2br(val($ortho->edukasi)) ?></td>
        </tr>
    </table>
</div>
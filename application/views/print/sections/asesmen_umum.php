<?php
// Handle data structure
$u = null;
if (isset($d->umum)) {
    $u = $d->umum;
} elseif (isset($d['umum'])) {
    $u = (object) $d['umum'];
}

if (!$u) {
    return; // Tidak ada data
}

if (!function_exists('val')) {
    function val($v)
    {
        return ($v !== null && $v !== '') ? $v : '-';
    }
}
?>

<div class="print-section" style="margin: 8px 0;">
    <h3 style="background-color: #e0e0e0; padding: 6px; margin: 5px 0; font-size: 11pt; font-weight: bold;">
        ASESMEN AWAL MEDIS UMUM
    </h3>

    <!-- I. ANAMNESIS -->
    <table style="width: 100%; margin-bottom: 6px; font-size: 9pt;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 4px; font-size: 10pt;">I. ANAMNESIS</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 3px; font-weight: bold;">Keluhan Utama</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->keluhan_utama ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Riwayat Penyakit Sekarang</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->rps ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Riwayat Penyakit Dahulu</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->rpd ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Riwayat Penyakit Keluarga</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->rpk ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Riwayat Penggunaan Obat</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->rpo ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Riwayat Alergi</td>
            <td style="padding: 3px;">: <?= val($u->alergi ?? '') ?></td>
        </tr>
    </table>

    <!-- II. PEMERIKSAAN FISIK & TTV -->
    <table style="width: 100%; margin-bottom: 6px; font-size: 9pt;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 4px; font-size: 10pt;">II. PEMERIKSAAN FISIK &
                TANDA VITAL</th>
        </tr>
        <tr>
            <td style="width: 20%; padding: 3px; font-weight: bold;">Keadaan Umum</td>
            <td style="width: 30%; padding: 3px;">: <?= val($u->keadaan ?? '') ?></td>
            <td style="width: 20%; padding: 3px; font-weight: bold;">Kesadaran</td>
            <td style="width: 30%; padding: 3px;">: <?= val($u->kesadaran ?? '') ?> | GCS: <?= val($u->gcs ?? '') ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">TD</td>
            <td style="padding: 3px;">: <?= val($u->td ?? '') ?> mmHg</td>
            <td style="padding: 3px; font-weight: bold;">Nadi</td>
            <td style="padding: 3px;">: <?= val($u->nadi ?? '') ?> x/mnt</td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">RR</td>
            <td style="padding: 3px;">: <?= val($u->rr ?? '') ?> x/mnt</td>
            <td style="padding: 3px; font-weight: bold;">Suhu</td>
            <td style="padding: 3px;">: <?= val($u->suhu ?? '') ?> °C</td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">SpO2</td>
            <td style="padding: 3px;">: <?= val($u->spo ?? '') ?> %</td>
            <td style="padding: 3px; font-weight: bold;">BB / TB</td>
            <td style="padding: 3px;">: <?= val($u->bb ?? '') ?> Kg / <?= val($u->tb ?? '') ?> cm</td>
        </tr>
    </table>

    <!-- III. STATUS GENERALIS -->
    <table style="width: 100%; margin-bottom: 6px; font-size: 9pt;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 4px; font-size: 10pt;">III. STATUS GENERALIS</th>
        </tr>
        <tr>
            <td style="width: 20%; padding: 3px; font-weight: bold;">Kepala</td>
            <td style="width: 30%; padding: 3px;">: <?= val($u->kepala ?? '') ?></td>
            <td style="width: 20%; padding: 3px; font-weight: bold;">Gigi & Mulut</td>
            <td style="width: 30%; padding: 3px;">: <?= val($u->gigi ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">THT</td>
            <td style="padding: 3px;">: <?= val($u->tht ?? '') ?></td>
            <td style="padding: 3px; font-weight: bold;">Thoraks</td>
            <td style="padding: 3px;">: <?= val($u->thoraks ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Abdomen</td>
            <td style="padding: 3px;">: <?= val($u->abdomen ?? '') ?></td>
            <td style="padding: 3px; font-weight: bold;">Genital & Anus</td>
            <td style="padding: 3px;">: <?= val($u->genital ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Ekstremitas</td>
            <td style="padding: 3px;">: <?= val($u->ekstremitas ?? '') ?></td>
            <td style="padding: 3px; font-weight: bold;">Kulit</td>
            <td style="padding: 3px;">: <?= val($u->kulit ?? '') ?></td>
        </tr>
        <?php if (isset($u->ket_fisik) && $u->ket_fisik): ?>
            <tr>
                <td style="padding: 3px; font-weight: bold;">Keterangan Lain</td>
                <td colspan="3" style="padding: 3px;">: <?= nl2br(val($u->ket_fisik)) ?></td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- IV. STATUS LOKALIS & PENUNJANG -->
    <?php if ((isset($u->lokalis_url) && $u->lokalis_url) || (isset($u->penunjang) && $u->penunjang)): ?>
        <table style="width: 100%; margin-bottom: 6px; font-size: 9pt;">
            <tr>
                <th colspan="2" style="background-color: #f0f0f0; padding: 4px; font-size: 10pt;">IV. STATUS LOKALIS &
                    PENUNJANG</th>
            </tr>
            <?php if (isset($u->lokalis_url) && $u->lokalis_url): ?>
                <tr>
                    <td colspan="2" style="padding: 8px; text-align: center;">
                        <img src="<?= $u->lokalis_url ?>" style="max-width: 350px; max-height: 250px; border: 1px solid #ccc;">
                        <?php if (isset($u->ket_lokalis) && $u->ket_lokalis): ?>
                            <p style="margin: 3px 0 0 0; font-size: 8pt; font-style: italic;"><?= nl2br($u->ket_lokalis) ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (isset($u->penunjang) && $u->penunjang): ?>
                <tr>
                    <td style="width: 25%; padding: 3px; font-weight: bold;">Pemeriksaan Penunjang</td>
                    <td style="padding: 3px;">: <?= nl2br($u->penunjang) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <!-- V. DIAGNOSIS & TATALAKSANA -->
    <table style="width: 100%; margin-bottom: 6px; font-size: 9pt;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 4px; font-size: 10pt;">V. DIAGNOSIS & TATALAKSANA
            </th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 3px; font-weight: bold;">Diagnosis</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->diagnosis ?? '')) ?></td>
        </tr>
        <tr>
            <td style="padding: 3px; font-weight: bold;">Tatalaksana</td>
            <td style="padding: 3px;">: <?= nl2br(val($u->tata ?? '')) ?></td>
        </tr>
        <?php if (isset($u->konsulrujuk) && $u->konsulrujuk): ?>
            <tr>
                <td style="padding: 3px; font-weight: bold;">Konsul / Rujuk</td>
                <td style="padding: 3px;">: <?= nl2br(val($u->konsulrujuk)) ?></td>
            </tr>
        <?php endif; ?>
    </table>
</div>
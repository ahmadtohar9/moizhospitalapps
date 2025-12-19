<?php
// Mengikuti pola asesmen_kandungan.php (AMAN)
$igd = null;

if (isset($d->igd)) {
    $igd = $d->igd;
} elseif (isset($d['igd'])) {
    $igd = (object) $d['igd'];
}

// kalau tetap kosong, pakai object kosong (supaya tidak error)
if (!$igd) {
    $igd = (object) [];
}


if (!function_exists('val')) {
    function val($v)
    {
        return ($v !== null && $v !== '') ? $v : '-';
    }
}
?>

<div class="print-section">
    <div class="section-title">ASESMEN GAWAT DARURAT (IGD)</div>

    <!-- A. ANAMNESIS -->
    <div class="sub-title">A. ANAMNESIS</div>
    <table class="print-table" style="border:none;">
        <tr>
            <td width="170"><b>Keluhan Utama</b></td>
            <td>: <?= val($igd->keluhan_utama ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Riwayat Penyakit Sekarang</b></td>
            <td>: <?= val($igd->rps ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Riwayat Penyakit Dahulu</b></td>
            <td>: <?= val($igd->rpd ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Riwayat Penyakit Keluarga</b></td>
            <td>: <?= val($igd->rpk ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Alergi</b></td>
            <td>: <?= val($igd->alergi ?? null) ?></td>
        </tr>
    </table>

    <!-- B. PEMERIKSAAN FISIK & TTV -->
    <div class="sub-title">B. PEMERIKSAAN FISIK & TTV</div>

    <table class="print-table" style="width:100%;">
        <tr>
            <td>TD : <?= val($igd->td ?? null) ?> mmHg</td>
            <td>Nadi : <?= val($igd->nadi ?? null) ?> x/m</td>
            <td>RR : <?= val($igd->rr ?? null) ?> x/m</td>
            <td>Suhu : <?= val($igd->suhu ?? null) ?> °C</td>
        </tr>
        <tr>
            <td>SpO2 : <?= val($igd->spo2 ?? null) ?> %</td>
            <td>BB : <?= val($igd->bb ?? null) ?> Kg</td>
            <td>TB : <?= val($igd->tb ?? null) ?> Cm</td>
            <td>GCS : <?= val($igd->gcs ?? null) ?></td>
        </tr>
    </table>

    <div style="margin:6px 0;">
        <b>Keadaan Umum:</b> <?= val($igd->keadaan ?? null) ?>
        &nbsp; | &nbsp;
        <b>Kesadaran:</b> <?= val($igd->kesadaran ?? null) ?>
    </div>

    <!-- C. PEMERIKSAAN FISIK DETAIL -->
    <div class="sub-title">C. PEMERIKSAAN FISIK</div>

    <table class="print-table" style="width:100%; table-layout:fixed;">
        <tr>
            <td width="50%" style="vertical-align:top;">
                <table class="print-table">
                    <tr>
                        <td>Kepala</td>
                        <td><?= val($igd->kepala ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Mata</td>
                        <td><?= val($igd->mata ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Gigi & Mulut</td>
                        <td><?= val($igd->gigi ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Leher</td>
                        <td><?= val($igd->leher ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Thoraks</td>
                        <td><?= val($igd->thoraks ?? null) ?></td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="vertical-align:top;">
                <table class="print-table">
                    <tr>
                        <td>Abdomen</td>
                        <td><?= val($igd->abdomen ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Genital</td>
                        <td><?= val($igd->genital ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Ekstremitas</td>
                        <td><?= val($igd->ekstremitas ?? null) ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Keterangan Fisik</b> : <?= val($igd->ket_fisik ?? null) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- D. STATUS LOKALIS -->
    <div class="sub-title">D. STATUS LOKALIS</div>

    <?php if (!empty($igd->lokalis_url)): ?>
        <div style="text-align:center; margin-bottom:6px;">
            <img src="<?= $igd->lokalis_url ?>" style="max-height:180px; border:1px solid #ccc;">
        </div>
    <?php endif; ?>

    <div>
        <b>Keterangan Lokalis:</b> <?= val($igd->ket_lokalis ?? null) ?>
    </div>

    <!-- E. DIAGNOSIS & TERAPI -->
    <div class="sub-title">E. DIAGNOSIS & TERAPI</div>
    <table class="print-table" style="border:none;">
        <tr>
            <td width="170"><b>Diagnosis Kerja</b></td>
            <td>: <?= val($igd->diagnosis ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Tatalaksana</b></td>
            <td>: <?= val($igd->tata_laksana ?? $igd->tata ?? null) ?></td>
        </tr>
    </table>
</div>
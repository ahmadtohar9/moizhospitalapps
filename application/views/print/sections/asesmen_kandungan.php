<?php
// Handle data structure (object or array)
$kd = null;
if (isset($d->kandungan)) {
    $kd = $d->kandungan;
} elseif (isset($d['kandungan'])) {
    $kd = (object) $d['kandungan'];
} elseif (isset($asesmen)) {
    $kd = is_array($asesmen) ? (object) $asesmen : $asesmen;
}

if (!$kd) {
    $kd = (object) [];
}


if (!function_exists('val')) {
    function val($v)
    {
        return ($v !== null && $v !== '') ? $v : '-';
    }
}
?>

<div class="print-section">
    <div class="section-title">PENILAIAN MEDIS KANDUNGAN</div>

    <!-- ANAMNESIS -->
    <div class="sub-title">A. ANAMNESIS</div>
    <table class="print-table" style="border:none;">
        <tr>
            <td width="170"><b>Jenis Anamnesis</b></td>
            <td>: <?= val($kd->anamnesis ?? null) ?><?= !empty($kd->hubungan) ? ' (' . val($kd->hubungan) . ')' : '' ?>
            </td>
        </tr>
        <tr>
            <td><b>Keluhan Utama</b></td>
            <td>: <?= val($kd->keluhan_utama ?? null) ?></td>
        </tr>
        <tr>
            <td><b>RPS</b></td>
            <td>: <?= val($kd->rps ?? null) ?></td>
        </tr>
        <tr>
            <td><b>RPD</b></td>
            <td>:
                <?= val($kd->rpd ?? null) ?><?= !empty($kd->rpk) ? ' | <b>RPK:</b> ' . val($kd->rpk) : '' ?><?= !empty($kd->rpo) ? ' | <b>RPO:</b> ' . val($kd->rpo) : '' ?>
            </td>
        </tr>
        <tr>
            <td><b>Alergi</b></td>
            <td>: <?= val($kd->alergi ?? null) ?></td>
        </tr>
    </table>

    <!-- TANDA VITAL -->
    <div class="sub-title">B. TANDA VITAL & KESADARAN</div>
    <table class="print-table" style="border:none;">
        <tr>
            <td width="170"><b>Keadaan Umum</b></td>
            <td>: <?= val($kd->keadaan ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Kesadaran</b></td>
            <td>: <?= val($kd->kesadaran ?? null) ?><?= !empty($kd->gcs) ? ' (GCS: ' . val($kd->gcs) . ')' : '' ?></td>
        </tr>
        <tr>
            <td><b>Tanda Vital</b></td>
            <td>: TD: <?= val($kd->td ?? null) ?> mmHg | Nadi: <?= val($kd->nadi ?? null) ?> x/m | RR:
                <?= val($kd->rr ?? null) ?> x/m | Suhu: <?= val($kd->suhu ?? null) ?>
                °C<?= !empty($kd->spo) ? ' | SpO2: ' . val($kd->spo) . '%' : '' ?>
            </td>
        </tr>
        <tr>
            <td><b>BB / TB</b></td>
            <td>: <?= val($kd->bb ?? null) ?> Kg / <?= val($kd->tb ?? null) ?> cm</td>
        </tr>
    </table>

    <!-- PEMERIKSAAN FISIK -->
    <?php if (!empty($kd->kepala) || !empty($kd->mata) || !empty($kd->tht) || !empty($kd->thoraks) || !empty($kd->abdomen) || !empty($kd->genital) || !empty($kd->ekstremitas)): ?>
        <div class="sub-title">C. PEMERIKSAAN FISIK</div>
        <table class="print-table" style="border:none;">
            <?php if (!empty($kd->kepala)): ?>
                <tr>
                    <td width="170"><b>Kepala</b></td>
                    <td>: <?= val($kd->kepala) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->mata)): ?>
                <tr>
                    <td><b>Mata</b></td>
                    <td>: <?= val($kd->mata) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->tht)): ?>
                <tr>
                    <td><b>THT</b></td>
                    <td>: <?= val($kd->tht) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->gigi)): ?>
                <tr>
                    <td><b>Gigi</b></td>
                    <td>: <?= val($kd->gigi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->thoraks)): ?>
                <tr>
                    <td><b>Thoraks</b></td>
                    <td>: <?= val($kd->thoraks) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->abdomen)): ?>
                <tr>
                    <td><b>Abdomen</b></td>
                    <td>: <?= val($kd->abdomen) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->genital)): ?>
                <tr>
                    <td><b>Genital</b></td>
                    <td>: <?= val($kd->genital) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->ekstremitas)): ?>
                <tr>
                    <td><b>Ekstremitas</b></td>
                    <td>: <?= val($kd->ekstremitas) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->ket_fisik)): ?>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td>: <?= val($kd->ket_fisik) ?></td>
                </tr><?php endif; ?>
        </table>
    <?php endif; ?>

    <!-- PEMERIKSAAN OBSTETRI -->
    <?php if (!empty($kd->tfu) || !empty($kd->djj)): ?>
        <div class="sub-title">D. PEMERIKSAAN OBSTETRI</div>
        <table class="print-table" style="border:none;">
            <?php if (!empty($kd->tfu)): ?>
                <tr>
                    <td width="170"><b>TFU</b></td>
                    <td>: <?= val($kd->tfu) ?> cm</td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->tbj)): ?>
                <tr>
                    <td><b>TBJ</b></td>
                    <td>: <?= val($kd->tbj) ?> gr</td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->djj)): ?>
                <tr>
                    <td><b>DJJ</b></td>
                    <td>: <?= val($kd->djj) ?> x/m</td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->kontraksi)): ?>
                <tr>
                    <td><b>Kontraksi</b></td>
                    <td>: <?= val($kd->kontraksi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->his)): ?>
                <tr>
                    <td><b>His</b></td>
                    <td>: <?= val($kd->his) ?></td>
                </tr><?php endif; ?>
        </table>
    <?php endif; ?>

    <!-- PEMERIKSAAN GINEKOLOGI -->
    <?php if (!empty($kd->inspeksi) || !empty($kd->inspekulo) || !empty($kd->vt) || !empty($kd->rt)): ?>
        <div class="sub-title">E. PEMERIKSAAN GINEKOLOGI</div>
        <table class="print-table" style="border:none;">
            <?php if (!empty($kd->inspeksi)): ?>
                <tr>
                    <td width="170"><b>Inspeksi Vulva</b></td>
                    <td>: <?= val($kd->inspeksi) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->inspekulo)): ?>
                <tr>
                    <td><b>Inspekulo</b></td>
                    <td>: <?= val($kd->inspekulo) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->vt)): ?>
                <tr>
                    <td><b>VT (Vaginal Toucher)</b></td>
                    <td>: <?= val($kd->vt) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->rt)): ?>
                <tr>
                    <td><b>RT (Rectal Toucher)</b></td>
                    <td>: <?= val($kd->rt) ?></td>
                </tr><?php endif; ?>
        </table>
    <?php endif; ?>

    <!-- PEMERIKSAAN PENUNJANG -->
    <?php if (!empty($kd->ultra) || !empty($kd->kardio) || !empty($kd->lab)): ?>
        <div class="sub-title">F. PEMERIKSAAN PENUNJANG</div>
        <table class="print-table" style="border:none;">
            <?php if (!empty($kd->ultra)): ?>
                <tr>
                    <td width="170"><b>USG</b></td>
                    <td>: <?= val($kd->ultra) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->kardio)): ?>
                <tr>
                    <td><b>Kardiotokografi</b></td>
                    <td>: <?= val($kd->kardio) ?></td>
                </tr><?php endif; ?>
            <?php if (!empty($kd->lab)): ?>
                <tr>
                    <td><b>Laboratorium</b></td>
                    <td>: <?= val($kd->lab) ?></td>
                </tr><?php endif; ?>
        </table>
    <?php endif; ?>

    <!-- DIAGNOSIS & TATALAKSANA -->
    <div class="sub-title">G. DIAGNOSIS & TATALAKSANA</div>
    <table class="print-table" style="border:none;">
        <tr>
            <td width="170"><b>Diagnosis</b></td>
            <td>: <?= val($kd->diagnosis ?? null) ?></td>
        </tr>
        <tr>
            <td><b>Tatalaksana</b></td>
            <td>:
                <?= val($kd->tata ?? null) ?><?= !empty($kd->konsul) ? '<br><b>Konsultasi:</b> ' . val($kd->konsul) : '' ?>
            </td>
        </tr>
    </table>
</div>
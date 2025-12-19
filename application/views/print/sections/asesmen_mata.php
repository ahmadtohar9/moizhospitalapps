<?php
// Handle data structure
$mata = null;
if (isset($d->mata)) {
    $mata = $d->mata;
} elseif (isset($d['mata'])) {
    $mata = (object) $d['mata'];
}

if (!$mata) {
    return; // Tidak ada data mata
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
        PENILAIAN AWAL MEDIS RAWAT JALAN MATA
    </h3>

    <!-- I. RIWAYAT KESEHATAN -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">I. RIWAYAT KESEHATAN</th>
        </tr>
        <tr>
            <td colspan="4" style="padding: 5px;"><strong>Anamnesis:</strong> <?= val($mata->anamnesis ?? '') ?>,
                <?= val($mata->hubungan ?? '') ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding: 5px;"><strong>Keluhan Utama:</strong> <?= val($mata->keluhan_utama ?? '') ?>
            </td>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Riwayat Penyakit Sekarang</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->rps ?? '') ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Riwayat Penyakit Dahulu</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->rpd ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Riwayat Penggunaan Obat</td>
            <td style="padding: 5px;"><?= val($mata->alergi ?? '') ?></td>
            <td style="padding: 5px; font-weight: bold;">Riwayat Alergi</td>
            <td style="padding: 5px;"><?= val($mata->alergi ?? '') ?></td>
        </tr>
    </table>

    <!-- II. PEMERIKSAAN FISIK -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="6" style="background-color: #f0f0f0; padding: 5px;">II. PEMERIKSAAN FISIK</th>
        </tr>
        <tr>
            <td style="width: 16%; padding: 5px; font-weight: bold;">TD</td>
            <td style="width: 16%; padding: 5px;"><?= val($mata->td ?? '') ?> mmHg</td>
            <td style="width: 16%; padding: 5px; font-weight: bold;">BB</td>
            <td style="width: 16%; padding: 5px;"><?= val($mata->bb ?? '') ?> Kg</td>
            <td style="width: 16%; padding: 5px; font-weight: bold;">Suhu</td>
            <td style="width: 16%; padding: 5px;"><?= val($mata->suhu ?? '') ?> °C</td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Nadi</td>
            <td style="padding: 5px;"><?= val($mata->nadi ?? '') ?> x/menit</td>
            <td style="padding: 5px; font-weight: bold;">RR</td>
            <td style="padding: 5px;"><?= val($mata->rr ?? '') ?> x/menit</td>
            <td style="padding: 5px; font-weight: bold;">Nyeri</td>
            <td style="padding: 5px;"><?= val($mata->nyeri ?? '') ?></td>
        </tr>
    </table>

    <!-- III. STATUS OFTAMOLOGIS -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="2" style="background-color: #f0f0f0; padding: 5px; text-align: center;">III. STATUS OFTAMOLOGIS
            </th>
        </tr>
        <tr>
            <th style="width: 50%; padding: 5px; text-align: center;">OD (Oculus Dextra)</th>
            <th style="width: 50%; padding: 5px; text-align: center;">OS (Oculus Sinistra)</th>
        </tr>
        <tr>
            <td style="padding: 5px; vertical-align: top;">
                <strong>• Visus SC:</strong> <?= val($mata->visuskanan ?? '') ?><br>
                <strong>• CC:</strong> <?= val($mata->cckanan ?? '') ?><br>
                <strong>• Palpebra:</strong> <?= val($mata->palkanan ?? '') ?><br>
                <strong>• Conjungtiwa:</strong> <?= val($mata->conkanan ?? '') ?><br>
                <strong>• Cornea:</strong> <?= val($mata->corneakanan ?? '') ?><br>
                <strong>• COA:</strong> <?= val($mata->coakanan ?? '') ?><br>
                <strong>• Iris/Pupil:</strong> <?= val($mata->pupilkanan ?? '') ?><br>
                <strong>• Lensa:</strong> <?= val($mata->lensakanan ?? '') ?><br>
                <strong>• Fundus Media:</strong> <?= val($mata->funduskanan ?? '') ?><br>
                <strong>• Papil:</strong> <?= val($mata->papilkanan ?? '') ?><br>
                <strong>• Retina:</strong> <?= val($mata->retinakanan ?? '') ?><br>
                <strong>• Makula:</strong> <?= val($mata->makulakanan ?? '') ?><br>
                <strong>• TIO:</strong> <?= val($mata->tiokanan ?? '') ?><br>
                <strong>• MBO:</strong> <?= val($mata->mbokanan ?? '') ?>
            </td>
            <td style="padding: 5px; vertical-align: top;">
                <strong>• Visus SC:</strong> <?= val($mata->visuskiri ?? '') ?><br>
                <strong>• CC:</strong> <?= val($mata->cckiri ?? '') ?><br>
                <strong>• Palpebra:</strong> <?= val($mata->palkiri ?? '') ?><br>
                <strong>• Conjungtiwa:</strong> <?= val($mata->conkiri ?? '') ?><br>
                <strong>• Cornea:</strong> <?= val($mata->corneakiri ?? '') ?><br>
                <strong>• COA:</strong> <?= val($mata->coakiri ?? '') ?><br>
                <strong>• Iris/Pupil:</strong> <?= val($mata->pupilkiri ?? '') ?><br>
                <strong>• Lensa:</strong> <?= val($mata->lensakiri ?? '') ?><br>
                <strong>• Fundus Media:</strong> <?= val($mata->funduskiri ?? '') ?><br>
                <strong>• Papil:</strong> <?= val($mata->papilkiri ?? '') ?><br>
                <strong>• Retina:</strong> <?= val($mata->retinakiri ?? '') ?><br>
                <strong>• Makula:</strong> <?= val($mata->makulakiri ?? '') ?><br>
                <strong>• TIO:</strong> <?= val($mata->tiokiri ?? '') ?><br>
                <strong>• MBO:</strong> <?= val($mata->mbokiri ?? '') ?>
            </td>
        </tr>
    </table>

    <!-- GAMBAR DIAGRAM MATA -->
    <?php if (isset($mata->gambar_od_url) || isset($mata->gambar_os_url)): ?>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <th colspan="2" style="background-color: #f0f0f0; padding: 5px; text-align: center;">DIAGRAM MATA</th>
            </tr>
            <tr>
                <td style="width: 50%; padding: 10px; text-align: center;">
                    <?php if (isset($mata->gambar_od_url) && $mata->gambar_od_url): ?>
                        <strong>OD (Kanan)</strong><br>
                        <img src="<?= $mata->gambar_od_url ?>"
                            style="max-width: 250px; max-height: 250px; border: 1px solid #ccc; margin-top: 5px;">
                    <?php else: ?>
                        <em>Tidak ada gambar OD</em>
                    <?php endif; ?>
                </td>
                <td style="width: 50%; padding: 10px; text-align: center;">
                    <?php if (isset($mata->gambar_os_url) && $mata->gambar_os_url): ?>
                        <strong>OS (Kiri)</strong><br>
                        <img src="<?= $mata->gambar_os_url ?>"
                            style="max-width: 250px; max-height: 250px; border: 1px solid #ccc; margin-top: 5px;">
                    <?php else: ?>
                        <em>Tidak ada gambar OS</em>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>

    <!-- IV. PEMERIKSAAN PENUNJANG -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">IV. PEMERIKSAAN PENUNJANG</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Laboratorium</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->lab ?? '') ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Radiologi</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->rad ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Penunjang Lainnya</td>
            <td style="padding: 5px;"><?= val($mata->penunjang ?? '') ?></td>
            <td style="padding: 5px; font-weight: bold;">Tes Penglihatan</td>
            <td style="padding: 5px;"><?= val($mata->tes ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Pemeriksaan Lain</td>
            <td colspan="3" style="padding: 5px;"><?= val($mata->pemeriksaan ?? '') ?></td>
        </tr>
    </table>

    <!-- V. DIAGNOSIS -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">V. DIAGNOSIS</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Asesmen Kerja</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->diagnosis ?? '') ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Asesmen Banding</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->diagnosisbdg ?? '') ?></td>
        </tr>
    </table>

    <!-- VI. PERMASALAHAN & TATALAKSANA -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th colspan="4" style="background-color: #f0f0f0; padding: 5px;">VI. PERMASALAHAN & TATALAKSANA</th>
        </tr>
        <tr>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Permasalahan</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->permasalahan ?? '') ?></td>
            <td style="width: 25%; padding: 5px; font-weight: bold;">Terapi/Pengobatan</td>
            <td style="width: 25%; padding: 5px;"><?= val($mata->terapi ?? '') ?></td>
        </tr>
        <tr>
            <td style="padding: 5px; font-weight: bold;">Tindakan/Rencana Tindakan</td>
            <td colspan="3" style="padding: 5px;"><?= val($mata->tindakan ?? '') ?></td>
        </tr>
    </table>

    <!-- VII. EDUKASI -->
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <th style="background-color: #f0f0f0; padding: 5px;">VII. EDUKASI</th>
        </tr>
        <tr>
            <td style="padding: 5px;"><?= val($mata->edukasi ?? '') ?></td>
        </tr>
    </table>
</div>
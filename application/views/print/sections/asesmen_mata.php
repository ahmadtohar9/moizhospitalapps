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

<div class="print-section" style="margin-bottom: 20px;">
    <h3 style="background-color: #e1f5fe; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #03a9f4;">
        👁️ ASESMEN AWAL MEDIS MATA (OFTALMOLOGI)
    </h3>

    <table style="width: 100%; margin-bottom: 15px;">
        <tr>
            <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
            <td>: <?= val($mata->tanggal ?? '') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Dokter Pemeriksa</td>
            <td>: <?= val($mata->nm_dokter ?? '') ?></td>
        </tr>
    </table>

    <!-- I. ANAMNESIS -->
    <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
        I. ANAMNESIS (<?= val($mata->anamnesis ?? '-') ?>)
    </div>
    <?php if (!empty($mata->hubungan)): ?>
        <p style="margin: 5px 0;"><strong>Hubungan:</strong> <?= $mata->hubungan ?></p>
    <?php endif; ?>

    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
            <td>: <?= nl2br(val($mata->keluhan_utama ?? '')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Riw. Penyakit Sekarang</td>
            <td>: <?= nl2br(val($mata->rps ?? '')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Riw. Penyakit Dahulu</td>
            <td>: <?= nl2br(val($mata->rpd ?? '')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Riw. Penggunaan Obat</td>
            <td>: <?= nl2br(val($mata->rpo ?? '')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Riwayat Alergi</td>
            <td>: <?= val($mata->alergi ?? '') ?></td>
        </tr>
    </table>

    <!-- II. PEMERIKSAAN FISIK -->
    <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
        II. PEMERIKSAAN FISIK
    </div>
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 25%;"><strong>Status:</strong> <?= val($mata->status ?? '') ?></td>
            <td style="width: 25%;"><strong>TD:</strong> <?= val($mata->td ?? '') ?> mmHg</td>
            <td style="width: 25%;"><strong>Nadi:</strong> <?= val($mata->nadi ?? '') ?> x/mnt</td>
            <td style="width: 25%;"><strong>RR:</strong> <?= val($mata->rr ?? '') ?> x/mnt</td>
        </tr>
        <tr>
            <td><strong>Suhu:</strong> <?= val($mata->suhu ?? '') ?> °C</td>
            <td><strong>BB:</strong> <?= val($mata->bb ?? '') ?> kg</td>
            <td colspan="2"><strong>Nyeri:</strong> <?= val($mata->nyeri ?? '') ?></td>
        </tr>
    </table>

    <!-- III. PEMERIKSAAN MATA -->
    <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
        III. STATUS OFTALMOLOGIS
    </div>

    <div
        style="background-color: #fff3e0; padding: 5px; text-align: center; font-weight: bold; border: 1px solid #ffe0b2; margin-bottom: 10px;">
        Visus OD: <?= val($mata->visuskanan ?? '') ?> &nbsp;&nbsp;|&nbsp;&nbsp; Visus OS:
        <?= val($mata->visuskiri ?? '') ?>
    </div>

    <!-- Layout 2 Kolom untuk OD dan OS -->
    <table style="width: 100%; border-collapse: separate; border-spacing: 5px;">
        <tr>
            <!-- OD (KANAN) -->
            <td style="width: 50%; vertical-align: top; border: 1px solid #ccc; padding: 10px;">
                <div
                    style="text-align: center; border-bottom: 2px solid #2196F3; margin-bottom: 10px; padding-bottom: 5px;">
                    <strong style="color: #2196F3;">OD (MATA KANAN)</strong>
                </div>

                <!-- GAMBAR OD -->
                <div style="text-align: center; margin-bottom: 15px;">
                    <?php
                    $clean_no_rawat = str_replace('/', '', $d->no_rawat);
                    $path_od = FCPATH . 'assets/images/lokalis_mata/mata_od_' . $clean_no_rawat . '.png';
                    $url_od = base_url('assets/images/lokalis_mata/mata_od_' . $clean_no_rawat . '.png');
                    $template_od = base_url('assets/images/mata/mata_od_template.png');

                    if (file_exists($path_od)): ?>
                        <img src="<?= $url_od ?>" style="max-width: 100%; border: 1px solid #ddd; padding: 2px;">
                    <?php else: ?>
                        <div
                            style="color: #999; font-style: italic; font-size: 10px; border: 1px dashed #ccc; padding: 20px;">
                            (Tidak ada gambar OD)
                        </div>
                    <?php endif; ?>
                </div>

                <!-- DETAIL OD -->
                <table style="width: 100%; font-size: 11px;">
                    <?php if (!empty($mata->cckanan)): ?>
                        <tr>
                            <td width="30%"><b>CC</b></td>
                            <td>: <?= $mata->cckanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->palkanan)): ?>
                        <tr>
                            <td><b>Palpebra</b></td>
                            <td>: <?= $mata->palkanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->conkanan)): ?>
                        <tr>
                            <td><b>Conjunctiva</b></td>
                            <td>: <?= $mata->conkanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->corneakanan)): ?>
                        <tr>
                            <td><b>Cornea</b></td>
                            <td>: <?= $mata->corneakanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->coakanan)): ?>
                        <tr>
                            <td><b>COA</b></td>
                            <td>: <?= $mata->coakanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->pupilkanan)): ?>
                        <tr>
                            <td><b>Pupil</b></td>
                            <td>: <?= $mata->pupilkanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->lensakanan)): ?>
                        <tr>
                            <td><b>Lensa</b></td>
                            <td>: <?= $mata->lensakanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->funduskanan)): ?>
                        <tr>
                            <td><b>Fundus</b></td>
                            <td>: <?= $mata->funduskanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->papilkanan)): ?>
                        <tr>
                            <td><b>Papil</b></td>
                            <td>: <?= $mata->papilkanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->retinakanan)): ?>
                        <tr>
                            <td><b>Retina</b></td>
                            <td>: <?= $mata->retinakanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->makulakanan)): ?>
                        <tr>
                            <td><b>Makula</b></td>
                            <td>: <?= $mata->makulakanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->tiokanan)): ?>
                        <tr>
                            <td><b>TIO</b></td>
                            <td>: <?= $mata->tiokanan ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->mbokanan)): ?>
                        <tr>
                            <td><b>MBO</b></td>
                            <td>: <?= $mata->mbokanan ?></td>
                        </tr><?php endif; ?>
                </table>
            </td>

            <!-- OS (KIRI) -->
            <td style="width: 50%; vertical-align: top; border: 1px solid #ccc; padding: 10px;">
                <div
                    style="text-align: center; border-bottom: 2px solid #4CAF50; margin-bottom: 10px; padding-bottom: 5px;">
                    <strong style="color: #4CAF50;">OS (MATA KIRI)</strong>
                </div>

                <!-- GAMBAR OS -->
                <div style="text-align: center; margin-bottom: 15px;">
                    <?php
                    $path_os = FCPATH . 'assets/images/lokalis_mata/mata_os_' . $clean_no_rawat . '.png';
                    $url_os = base_url('assets/images/lokalis_mata/mata_os_' . $clean_no_rawat . '.png');

                    if (file_exists($path_os)): ?>
                        <img src="<?= $url_os ?>" style="max-width: 100%; border: 1px solid #ddd; padding: 2px;">
                    <?php else: ?>
                        <div
                            style="color: #999; font-style: italic; font-size: 10px; border: 1px dashed #ccc; padding: 20px;">
                            (Tidak ada gambar OS)
                        </div>
                    <?php endif; ?>
                </div>

                <!-- DETAIL OS -->
                <table style="width: 100%; font-size: 11px;">
                    <?php if (!empty($mata->cckiri)): ?>
                        <tr>
                            <td width="30%"><b>CC</b></td>
                            <td>: <?= $mata->cckiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->palkiri)): ?>
                        <tr>
                            <td><b>Palpebra</b></td>
                            <td>: <?= $mata->palkiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->conkiri)): ?>
                        <tr>
                            <td><b>Conjunctiva</b></td>
                            <td>: <?= $mata->conkiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->corneakiri)): ?>
                        <tr>
                            <td><b>Cornea</b></td>
                            <td>: <?= $mata->corneakiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->coakiri)): ?>
                        <tr>
                            <td><b>COA</b></td>
                            <td>: <?= $mata->coakiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->pupilkiri)): ?>
                        <tr>
                            <td><b>Pupil</b></td>
                            <td>: <?= $mata->pupilkiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->lensakiri)): ?>
                        <tr>
                            <td><b>Lensa</b></td>
                            <td>: <?= $mata->lensakiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->funduskiri)): ?>
                        <tr>
                            <td><b>Fundus</b></td>
                            <td>: <?= $mata->funduskiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->papilkiri)): ?>
                        <tr>
                            <td><b>Papil</b></td>
                            <td>: <?= $mata->papilkiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->retinakiri)): ?>
                        <tr>
                            <td><b>Retina</b></td>
                            <td>: <?= $mata->retinakiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->makulakiri)): ?>
                        <tr>
                            <td><b>Makula</b></td>
                            <td>: <?= $mata->makulakiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->tiokiri)): ?>
                        <tr>
                            <td><b>TIO</b></td>
                            <td>: <?= $mata->tiokiri ?></td>
                        </tr><?php endif; ?>
                    <?php if (!empty($mata->mbokiri)): ?>
                        <tr>
                            <td><b>MBO</b></td>
                            <td>: <?= $mata->mbokiri ?></td>
                        </tr><?php endif; ?>
                </table>
            </td>
        </tr>
    </table>

    <!-- IV. PEMERIKSAAN PENUNJANG -->
    <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
        IV. PEMERIKSAAN PENUNJANG
    </div>
    <table style="width: 100%; margin-bottom: 10px;">
        <?php if (!empty($mata->lab)): ?>
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($mata->lab) ?></td>
            </tr><?php endif; ?>
        <?php if (!empty($mata->rad)): ?>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($mata->rad) ?></td>
            </tr><?php endif; ?>
        <?php if (!empty($mata->tes)): ?>
            <tr>
                <td style="font-weight: bold;">Tes Penglihatan</td>
                <td>: <?= nl2br($mata->tes) ?></td>
            </tr><?php endif; ?>
        <?php if (!empty($mata->penunjang)): ?>
            <tr>
                <td style="font-weight: bold;">Penunjang Lain</td>
                <td>: <?= nl2br($mata->penunjang) ?></td>
            </tr><?php endif; ?>
        <?php if (!empty($mata->pemeriksaan)): ?>
            <tr>
                <td style="font-weight: bold;">Pemeriksaan Lain</td>
                <td>: <?= nl2br($mata->pemeriksaan) ?></td>
            </tr><?php endif; ?>
    </table>

    <!-- V. DIAGNOSIS & TATALAKSANA -->
    <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
        V. DIAGNOSIS & TATALAKSANA
    </div>
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 200px; font-weight: bold;">Diagnosis Kerja</td>
            <td>: <?= nl2br(val($mata->diagnosis ?? '')) ?></td>
        </tr>
        <?php if (!empty($mata->diagnosisbdg)): ?>
            <tr>
                <td style="font-weight: bold;">Diagnosis Banding</td>
                <td>: <?= nl2br($mata->diagnosisbdg) ?></td>
            </tr><?php endif; ?>
        <?php if (!empty($mata->permasalahan)): ?>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($mata->permasalahan) ?></td>
            </tr><?php endif; ?>
        <tr>
            <td style="font-weight: bold;">Terapi/Pengobatan</td>
            <td>: <?= nl2br(val($mata->terapi ?? '')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Tindakan</td>
            <td>: <?= nl2br(val($mata->tindakan ?? '')) ?></td>
        </tr>
        <?php if (!empty($mata->edukasi)): ?>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($mata->edukasi) ?></td>
            </tr><?php endif; ?>
    </table>
</div>
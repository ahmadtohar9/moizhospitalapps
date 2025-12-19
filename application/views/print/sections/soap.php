<?php
/**
 * SECTION: SOAP (Subjective, Objective, Assessment, Plan)
 * 
 * Data yang dibutuhkan:
 * - $d->soap (array): Data SOAP dari database (multiple entries)
 */

// Handle data structure
$soap_data = null;
if (isset($d->soap)) {
    $soap_data = $d->soap;
} elseif (isset($d['soap'])) {
    $soap_data = $d['soap'];
}

if (empty($soap_data)) {
    return;
}

// Convert to array if single object
if (is_object($soap_data)) {
    $soap_data = [$soap_data];
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        CATATAN SOAP (Subjective, Objective, Assessment, Plan)
    </h3>

    <?php foreach ($soap_data as $idx => $soap): ?>
        <table style="width: 100%; margin-bottom: 15px; border: 1px solid #000;">
            <tr style="background-color: #f5f5f5;">
                <th colspan="2" style="padding: 5px; text-align: left; border-bottom: 1px solid #000;">
                    SOAP #<?= $idx + 1 ?> -
                    <?= isset($soap->tgl_perawatan) ? date('d/m/Y', strtotime($soap->tgl_perawatan)) : '' ?>
                    <?= $soap->jam_rawat ?? '' ?>
                </th>
            </tr>

            <!-- SUBJECTIVE -->
            <?php if (!empty($soap->keluhan)): ?>
                <tr>
                    <td style="width: 30%; padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">
                        S (Subjective) - Keluhan
                    </td>
                    <td style="padding: 5px;">
                        <?= nl2br(htmlspecialchars($soap->keluhan)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- OBJECTIVE -->
            <tr>
                <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">
                    O (Objective) - Pemeriksaan
                </td>
                <td style="padding: 5px;">
                    <!-- Vital Signs - ALWAYS SHOW -->
                    <strong>Tanda Vital:</strong><br>
                    <table style="border: none; margin: 5px 0; width: 100%;">
                        <tr>
                            <td style="border: none; padding: 2px; width: 150px;">• Tekanan Darah</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->tensi) ? $soap->tensi . ' mmHg' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Nadi</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->nadi) ? $soap->nadi . ' x/menit' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Suhu</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->suhu_tubuh) ? $soap->suhu_tubuh . ' °C' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Respirasi</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->respirasi) ? $soap->respirasi . ' x/menit' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• SpO2</td>
                            <td style="border: none; padding: 2px;">: <?= !empty($soap->spo2) ? $soap->spo2 . ' %' : '-' ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Berat Badan</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->berat) ? $soap->berat . ' kg' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Tinggi Badan</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->tinggi) ? $soap->tinggi . ' cm' : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• GCS</td>
                            <td style="border: none; padding: 2px;">: <?= !empty($soap->gcs) ? $soap->gcs : '-' ?></td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 2px;">• Kesadaran</td>
                            <td style="border: none; padding: 2px;">:
                                <?= !empty($soap->kesadaran) ? $soap->kesadaran : '-' ?></td>
                        </tr>
                    </table>

                    <!-- Pemeriksaan Fisik -->
                    <?php if (!empty($soap->pemeriksaan)): ?>
                        <br><strong>Pemeriksaan Fisik:</strong><br>
                        <?= nl2br(htmlspecialchars($soap->pemeriksaan)) ?>
                    <?php endif; ?>
                </td>
            </tr>

            <!-- ASSESSMENT -->
            <?php if (!empty($soap->penilaian)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">
                        A (Assessment) - Penilaian
                    </td>
                    <td style="padding: 5px;">
                        <?= nl2br(htmlspecialchars($soap->penilaian)) ?>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- PLAN -->
            <?php if (!empty($soap->rtl) || !empty($soap->instruksi)): ?>
                <tr>
                    <td style="padding: 5px; font-weight: bold; vertical-align: top; border-right: 1px solid #ccc;">
                        P (Plan) - Rencana
                    </td>
                    <td style="padding: 5px;">
                        <?php if (!empty($soap->rtl)): ?>
                            <strong>Rencana Tindak Lanjut:</strong><br>
                            <?= nl2br(htmlspecialchars($soap->rtl)) ?>
                        <?php endif; ?>

                        <?php if (!empty($soap->instruksi)): ?>
                            <br><strong>Instruksi:</strong><br>
                            <?= nl2br(htmlspecialchars($soap->instruksi)) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endforeach; ?>
</div>
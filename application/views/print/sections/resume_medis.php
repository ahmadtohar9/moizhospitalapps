<?php
// COMPATIBILITY LAYER
if (isset($d)) {
    $resume_obj = $d->resume ?? null;
} else {
    $resume_obj = isset($resume) ? (object) $resume : null;
}

if (empty($resume_obj))
    return;
?>

<div class="print-section">
    <!-- Inline Style for Resume Cards -->
    <style>
        .resume-card {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 12px;
            overflow: hidden;
            page-break-inside: avoid;
            background-color: #fff;
        }

        .resume-card-header {
            background-color: #f3f4f6;
            color: #111827;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 10pt;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            /* Flexbox might be limited in mPDF, use table fallback if needed */
            align-items: center;
        }

        .resume-card-body {
            padding: 10px 12px;
            font-size: 10pt;
            color: #374151;
            line-height: 1.5;
        }

        .resume-card-icon {
            display: inline-block;
            margin-right: 6px;
            font-family: sans-serif;
            /* Fallback for emoji */
        }

        .diagnosa-badge {
            display: inline-block;
            padding: 2px 6px;
            background-color: #e0e7ff;
            color: #3730a3;
            border-radius: 4px;
            font-size: 9pt;
            margin-bottom: 2px;
        }

        .ttv-table td {
            padding: 4px 8px;
            font-size: 9pt;
        }

        .ttv-label {
            color: #6b7280;
            font-weight: bold;
        }
    </style>

    <div style="padding: 5px; margin-bottom: 20px;">
        <h3 style="text-align: center; text-decoration: underline; margin-top:0; margin-bottom: 15px; font-size: 14pt;">
            RESUME MEDIS</h3>

        <!-- CARD: KELUHAN UTAMA -->
        <?php if (!empty($resume_obj->keluhan_utama)): ?>
            <div class="resume-card">
                <div class="resume-card-header">
                    <span class="resume-card-icon">📢</span> Keluhan Utama
                </div>
                <div class="resume-card-body">
                    <?= nl2br($resume_obj->keluhan_utama) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- CARD: JALANNYA PENYAKIT (History) -->
        <?php if (!empty($resume_obj->jalannya_penyakit)): ?>
            <div class="resume-card">
                <div class="resume-card-header">
                    <span class="resume-card-icon">📝</span> Jalannya Penyakit
                </div>
                <div class="resume-card-body">
                    <?= nl2br($resume_obj->jalannya_penyakit) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- CARD: PEMERIKSAAN & DIAGNOSA (Grid Layout Table) -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
            <tr>
                <td style="width: 49%; vertical-align: top; padding-right: 5px;">
                    <!-- DIAGNOSA -->
                    <div class="resume-card" style="height: 100%;">
                        <div class="resume-card-header">
                            <span class="resume-card-icon">🩺</span> Diagnosa
                        </div>
                        <div class="resume-card-body">
                            <div style="margin-bottom: 6px;">
                                <strong style="color:#000;">Utama:</strong><br>
                                <?= $resume_obj->kd_diagnosa_utama ?? '' ?> - <?= $resume_obj->diagnosa_utama ?? '-' ?>
                            </div>
                            <?php if (!empty($resume_obj->diagnosa_sekunder)): ?>
                                <div>
                                    <strong style="color:#000;">Sekunder:</strong><br>
                                    <ul style="margin: 0; padding-left: 15px;">
                                        <?php
                                        if (!empty($resume_obj->diagnosa_sekunder))
                                            echo '<li>' . ($resume_obj->kd_diagnosa_sekunder ?? '') . ' - ' . $resume_obj->diagnosa_sekunder . '</li>';
                                        if (!empty($resume_obj->diagnosa_sekunder2))
                                            echo '<li>' . ($resume_obj->kd_diagnosa_sekunder2 ?? '') . ' - ' . $resume_obj->diagnosa_sekunder2 . '</li>';
                                        if (!empty($resume_obj->diagnosa_sekunder3))
                                            echo '<li>' . ($resume_obj->kd_diagnosa_sekunder3 ?? '') . ' - ' . $resume_obj->diagnosa_sekunder3 . '</li>';
                                        if (!empty($resume_obj->diagnosa_sekunder4))
                                            echo '<li>' . ($resume_obj->kd_diagnosa_sekunder4 ?? '') . ' - ' . $resume_obj->diagnosa_sekunder4 . '</li>';
                                        ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td style="width: 49%; vertical-align: top; padding-left: 5px;">
                    <!-- PEMERIKSAAN / LAB -->
                    <?php if (!empty($resume_obj->pemeriksaan_penunjang) || !empty($resume_obj->hasil_laborat)): ?>
                        <div class="resume-card" style="height: 100%;">
                            <div class="resume-card-header">
                                <span class="resume-card-icon">🔬</span> Pemeriksaan / Lab
                            </div>
                            <div class="resume-card-body">
                                <?php if (!empty($resume_obj->pemeriksaan_penunjang)): ?>
                                    <div style="margin-bottom: 6px;">
                                        <strong>Penunjang:</strong> <?= nl2br($resume_obj->pemeriksaan_penunjang) ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($resume_obj->hasil_laborat)): ?>
                                    <div>
                                        <strong>Lab:</strong> <?= nl2br($resume_obj->hasil_laborat) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <!-- CARD: PROSEDUR -->
        <?php if (!empty($resume_obj->prosedur_utama)): ?>
            <div class="resume-card">
                <div class="resume-card-header">
                    <span class="resume-card-icon">🛠️</span> Prosedur
                </div>
                <div class="resume-card-body">
                    <?= $resume_obj->kd_prosedur_utama ?? '' ?> - <?= $resume_obj->prosedur_utama ?>
                    <?php if (!empty($resume_obj->prosedur_sekunder)): ?>
                        <br><?= $resume_obj->kd_prosedur_sekunder ?? '' ?> - <?= $resume_obj->prosedur_sekunder ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- CARD: OBAT & KONDISI PULANG -->
        <div class="resume-card">
            <div class="resume-card-header">
                <span class="resume-card-icon">💊</span> Obat & Kondisi Pulang
            </div>
            <div class="resume-card-body">
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 60%; vertical-align: top; padding-right: 10px;">
                            <strong>Obat Pulang / Terapi:</strong><br>
                            <?= !empty($resume_obj->obat_pulang) ? nl2br($resume_obj->obat_pulang) : '-' ?>
                        </td>
                        <td style="width: 40%; vertical-align: top; border-left: 1px dashed #ccc; padding-left: 10px;">
                            <strong>Kondisi Pulang:</strong><br>
                            <span
                                style="color: #60a5fa; font-weight: bold; font-size: 11pt;"><?= !empty($resume_obj->kondisi_pulang) ? $resume_obj->kondisi_pulang : 'Hidup' ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
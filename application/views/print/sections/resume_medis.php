<?php
/**
 * SECTION: RESUME MEDIS PASIEN
 * 
 * Data yang dibutuhkan:
 * - $resume (array): Data resume medis dari database
 * 
 * Dibuat: 2025-12-18
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($resume)) {
    return;
}
?>

<div class="print-section no-page-break">
    <div class="print-section-title">RESUME MEDIS PASIEN</div>

    <div class="print-section-content">

        <!-- Informasi Rawat Inap -->
        <?php if (!empty($resume['info_rawat_inap'])): ?>
            <div class="mb-3">
                <table class="print-table-noborder">
                    <?php if (!empty($resume['info_rawat_inap']['tgl_masuk'])): ?>
                        <tr>
                            <td class="label">Tanggal Masuk</td>
                            <td class="separator">:</td>
                            <td class="value"><?= date('d-m-Y H:i', strtotime($resume['info_rawat_inap']['tgl_masuk'])) ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($resume['info_rawat_inap']['tgl_keluar'])): ?>
                        <tr>
                            <td class="label">Tanggal Keluar</td>
                            <td class="separator">:</td>
                            <td class="value"><?= date('d-m-Y H:i', strtotime($resume['info_rawat_inap']['tgl_keluar'])) ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($resume['info_rawat_inap']['lama_rawat'])): ?>
                        <tr>
                            <td class="label">Lama Rawat</td>
                            <td class="separator">:</td>
                            <td class="value"><?= $resume['info_rawat_inap']['lama_rawat'] ?> hari</td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($resume['info_rawat_inap']['ruang'])): ?>
                        <tr>
                            <td class="label">Ruang Perawatan</td>
                            <td class="separator">:</td>
                            <td class="value"><?= htmlspecialchars($resume['info_rawat_inap']['ruang']) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endif; ?>

        <!-- Ringkasan Riwayat Penyakit -->
        <?php if (!empty($resume['ringkasan_riwayat'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">RINGKASAN RIWAYAT PENYAKIT</h4>
                <div style="padding-left: 5mm;">
                    <?= nl2br(htmlspecialchars($resume['ringkasan_riwayat'])) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Pemeriksaan Fisik -->
        <?php if (!empty($resume['pemeriksaan_fisik'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">PEMERIKSAAN FISIK</h4>
                <div style="padding-left: 5mm;">
                    <?= nl2br(htmlspecialchars($resume['pemeriksaan_fisik'])) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Pemeriksaan Penunjang -->
        <?php if (!empty($resume['pemeriksaan_penunjang'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">PEMERIKSAAN PENUNJANG</h4>
                <div style="padding-left: 5mm;">
                    <?= nl2br(htmlspecialchars($resume['pemeriksaan_penunjang'])) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Terapi/Pengobatan -->
        <?php if (!empty($resume['terapi'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">TERAPI/PENGOBATAN</h4>
                <div style="padding-left: 5mm;">
                    <?= nl2br(htmlspecialchars($resume['terapi'])) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Diagnosis Utama -->
        <?php if (!empty($resume['diagnosis_utama'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">DIAGNOSIS UTAMA</h4>
                <div class="diagnosa-item">
                    <span class="diagnosa-item-code"><?= htmlspecialchars($resume['diagnosis_utama']['kode']) ?></span>
                    <span class="diagnosa-item-name"><?= htmlspecialchars($resume['diagnosis_utama']['nama']) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Diagnosis Sekunder -->
        <?php if (!empty($resume['diagnosis_sekunder'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">DIAGNOSIS SEKUNDER</h4>
                <ul class="diagnosa-list">
                    <?php foreach ($resume['diagnosis_sekunder'] as $diag): ?>
                        <li class="diagnosa-item">
                            <span class="diagnosa-item-code"><?= htmlspecialchars($diag['kode']) ?></span>
                            <span class="diagnosa-item-name"><?= htmlspecialchars($diag['nama']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Prosedur Utama -->
        <?php if (!empty($resume['prosedur_utama'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">PROSEDUR UTAMA</h4>
                <div class="prosedur-item">
                    <span class="prosedur-item-code"><?= htmlspecialchars($resume['prosedur_utama']['kode']) ?></span>
                    <span class="prosedur-item-name"><?= htmlspecialchars($resume['prosedur_utama']['nama']) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Prosedur Sekunder -->
        <?php if (!empty($resume['prosedur_sekunder'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">PROSEDUR SEKUNDER</h4>
                <ul class="prosedur-list">
                    <?php foreach ($resume['prosedur_sekunder'] as $pros): ?>
                        <li class="prosedur-item">
                            <span class="prosedur-item-code"><?= htmlspecialchars($pros['kode']) ?></span>
                            <span class="prosedur-item-name"><?= htmlspecialchars($pros['nama']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Kondisi Keluar -->
        <?php if (!empty($resume['kondisi_keluar'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">KONDISI KELUAR</h4>
                <table class="print-table-noborder" style="margin-left: 5mm;">
                    <?php if (!empty($resume['kondisi_keluar']['keadaan'])): ?>
                        <tr>
                            <td class="label">Keadaan Umum</td>
                            <td class="separator">:</td>
                            <td class="value"><?= htmlspecialchars($resume['kondisi_keluar']['keadaan']) ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($resume['kondisi_keluar']['cara_keluar'])): ?>
                        <tr>
                            <td class="label">Cara Keluar</td>
                            <td class="separator">:</td>
                            <td class="value"><?= htmlspecialchars($resume['kondisi_keluar']['cara_keluar']) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endif; ?>

        <!-- Obat Pulang -->
        <?php if (!empty($resume['obat_pulang'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">OBAT PULANG</h4>
                <table class="print-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 40%;">Nama Obat</th>
                            <th style="width: 20%;">Dosis</th>
                            <th style="width: 15%;">Frekuensi</th>
                            <th style="width: 20%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resume['obat_pulang'] as $index => $obat): ?>
                            <tr>
                                <td class="text-center"><?= ($index + 1) ?></td>
                                <td><?= htmlspecialchars($obat['nama_obat']) ?></td>
                                <td><?= htmlspecialchars($obat['dosis']) ?></td>
                                <td><?= htmlspecialchars($obat['frekuensi']) ?></td>
                                <td><?= htmlspecialchars($obat['keterangan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- Anjuran -->
        <?php if (!empty($resume['anjuran'])): ?>
            <div class="mb-3">
                <h4 style="font-size: 11pt; font-weight: bold; margin-bottom: 2mm;">ANJURAN</h4>
                <div style="padding-left: 5mm;">
                    <?= nl2br(htmlspecialchars($resume['anjuran'])) ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
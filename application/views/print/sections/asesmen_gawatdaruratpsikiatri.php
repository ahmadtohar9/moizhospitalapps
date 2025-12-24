<?php if (!empty($d->igdPsikiatri)): ?>
    <div class="print-section">
        <h3 style="background-color: #ffebee; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #d32f2f;">
            🚑 ASESMEN MEDIS IGD PSIKIATRI (GAWAT DARURAT)
        </h3>

        <table style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
                <td>: <?= $d->igdPsikiatri->tanggal ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dokter Pemeriksa</td>
                <td>: <?= $d->igdPsikiatri->nm_dokter ?? '-' ?></td>
            </tr>
        </table>

        <!-- ANAMNESIS -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            I. ANAMNESIS (<?= $d->igdPsikiatri->anamnesis ?? '-' ?>)
        </div>
        <?php if (!empty($d->igdPsikiatri->hubungan)): ?>
            <p style="margin: 5px 0;"><strong>Hubungan dengan Pasien:</strong> <?= $d->igdPsikiatri->hubungan ?></p>
        <?php endif; ?>

        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Keluhan Utama</td>
                <td>: <?= nl2br($d->igdPsikiatri->keluhan_utama ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Gejala Menyertai</td>
                <td>: <?= nl2br($d->igdPsikiatri->gejala_menyertai ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Faktor Pencetus</td>
                <td>: <?= nl2br($d->igdPsikiatri->faktor_pencetus ?? '-') ?></td>
            </tr>
        </table>

        <p><strong>Riwayat & Faktor:</strong></p>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Riw. Penyakit Dahulu</td>
                <td>: <?= $d->igdPsikiatri->riwayat_penyakit_dahulu ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_riwayat_penyakit_dahulu ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Kehamilan</td>
                <td>: <?= $d->igdPsikiatri->riwayat_kehamilan ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Sosial</td>
                <td>: <?= $d->igdPsikiatri->riwayat_sosial ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_riwayat_sosial ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Pekerjaan</td>
                <td>: <?= $d->igdPsikiatri->riwayat_pekerjaan ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_riwayat_pekerjaan ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Obat Diminum</td>
                <td>: <?= nl2br($d->igdPsikiatri->riwayat_obat_diminum ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Kepribadian Premorbid</td>
                <td>: <?= $d->igdPsikiatri->faktor_kepribadian_premorbid ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Faktor Keturunan</td>
                <td>: <?= $d->igdPsikiatri->faktor_keturunan ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_faktor_keturunan ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Faktor Organik</td>
                <td>: <?= $d->igdPsikiatri->faktor_organik ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_faktor_organik ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Riwayat Alergi</td>
                <td>: <?= $d->igdPsikiatri->riwayat_alergi ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN FISIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            II. PEMERIKSAAN FISIK
        </div>
        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <strong>Tanda-tanda Vital:</strong>
            <table style="width: 100%; margin-top: 5px;">
                <tr>
                    <td style="width: 25%;"><strong>Kesadaran:</strong><br> <?= $d->igdPsikiatri->fisik_kesadaran ?? '-' ?>
                    </td>
                    <td style="width: 25%;"><strong>GCS:</strong><br> <?= $d->igdPsikiatri->fisik_gcs ?? '-' ?></td>
                    <td style="width: 25%;"><strong>TD:</strong><br> <?= $d->igdPsikiatri->fisik_td ?? '-' ?> mmHg</td>
                    <td style="width: 25%;"><strong>Nadi:</strong><br> <?= $d->igdPsikiatri->fisik_nadi ?? '-' ?> x/mnt</td>
                </tr>
                <tr>
                    <td><strong>RR:</strong><br> <?= $d->igdPsikiatri->fisik_rr ?? '-' ?> x/mnt</td>
                    <td><strong>Suhu:</strong><br> <?= $d->igdPsikiatri->fisik_suhu ?? '-' ?> °C</td>
                    <td><strong>BB:</strong><br> <?= $d->igdPsikiatri->fisik_bb ?? '-' ?> Kg</td>
                    <td><strong>TB:</strong><br> <?= $d->igdPsikiatri->fisik_tb ?? '-' ?> cm</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Nyeri:</strong> <?= $d->igdPsikiatri->fisik_nyeri ?? '-' ?></td>
                    <td colspan="2"><strong>Nutrisi:</strong> <?= $d->igdPsikiatri->fisik_status_nutrisi ?? '-' ?></td>
                </tr>
            </table>
        </div>

        <p><strong>Status Kelainan Head To Toe:</strong></p>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Kepala</td>
                <td>: <?= $d->igdPsikiatri->status_kelainan_kepala ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_status_kelainan_kepala ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Leher</td>
                <td>: <?= $d->igdPsikiatri->status_kelainan_leher ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_status_kelainan_leher ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dada</td>
                <td>: <?= $d->igdPsikiatri->status_kelainan_dada ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_status_kelainan_dada ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Perut</td>
                <td>: <?= $d->igdPsikiatri->status_kelainan_perut ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_status_kelainan_perut ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Anggota Gerak</td>
                <td>: <?= $d->igdPsikiatri->status_kelainan_anggota_gerak ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_status_kelainan_anggota_gerak ?? '' ?>)</td>
            </tr>
        </table>

        <!-- STATUS LOKALISATA -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            III. STATUS LOKALISATA
        </div>
        <?php if (!empty($d->igdPsikiatri->status_lokalisata)): ?>
            <p><strong>Keterangan:</strong> <?= nl2br($d->igdPsikiatri->status_lokalisata) ?></p>
        <?php endif; ?>
        <div style="text-align: center; margin: 10px 0;">
            <?php
            $clean_no_rawat = str_replace('/', '', $d->no_rawat);
            $lokalis_path = FCPATH . 'assets/images/lokalis_igd_psikiatri/lokalis_' . $clean_no_rawat . '.png';
            if (file_exists($lokalis_path)): ?>
                <img src="<?= base_url('assets/images/lokalis_igd_psikiatri/lokalis_' . $clean_no_rawat . '.png') ?>"
                    style="max-width: 500px; width: 100%; height: auto; border: 1px solid #ddd; margin-top: 10px;">
            <?php else: ?>
                <p style="font-style: italic; color: #999;">Tidak ada gambar lokalis.</p>
            <?php endif; ?>
        </div>

        <!-- STATUS PSIKIATRIK -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            IV. STATUS PSIKIATRIK
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 30%; font-weight: bold;">Kesan Umum</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_kesan_umum ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Sikap & Prilaku</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_sikap_prilaku ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Kesadaran</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_kesadaran ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Orientasi</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_orientasi ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Daya Ingat</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_daya_ingat ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Persepsi</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_persepsi ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pikiran</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_pikiran ?? '-' ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Insight</td>
                <td>: <?= $d->igdPsikiatri->psikiatrik_insight ?? '-' ?></td>
            </tr>
        </table>

        <!-- PEMERIKSAAN PENUNJANG -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            V. PEMERIKSAAN PENUNJANG
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Laboratorium</td>
                <td>: <?= nl2br($d->igdPsikiatri->laborat ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Radiologi</td>
                <td>: <?= nl2br($d->igdPsikiatri->radiologi ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">EKG</td>
                <td>: <?= nl2br($d->igdPsikiatri->ekg ?? '-') ?></td>
            </tr>
        </table>

        <!-- DIAGNOSIS & TERAPI -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VI. DIAGNOSIS & TERAPI
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Diagnosis</td>
                <td>: <?= nl2br($d->igdPsikiatri->diagnosis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Permasalahan</td>
                <td>: <?= nl2br($d->igdPsikiatri->permasalahan ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Instruksi Medis</td>
                <td>: <?= nl2br($d->igdPsikiatri->instruksi_medis ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Rencana/Target</td>
                <td>: <?= nl2br($d->igdPsikiatri->rencana_target ?? '-') ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Edukasi</td>
                <td>: <?= nl2br($d->igdPsikiatri->edukasi ?? '-') ?></td>
            </tr>
        </table>

        <!-- KELUAR IGD -->
        <div style="background: #f5f5f5; padding: 5px; margin: 10px 0; font-weight: bold;">
            VII. KELUAR IGD
        </div>
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 30%; font-weight: bold;">Dipulangkan</td>
                <td>: <?= $d->igdPsikiatri->pulang_dipulangkan ?? '-' ?>
                    (<?= $d->igdPsikiatri->keterangan_pulang_dipulangkan ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pulang Paksa</td>
                <td>: <?= $d->igdPsikiatri->pulang_paksa ?? '-' ?> (<?= $d->igdPsikiatri->keterangan_pulang_paksa ?? '' ?>)
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dirawat di Ruang</td>
                <td>: <?= $d->igdPsikiatri->pulang_dirawat_diruang ?? '-' ?> (Indikasi:
                    <?= $d->igdPsikiatri->pulang_indikasi_ranap ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Dirujuk</td>
                <td>: <?= $d->igdPsikiatri->pulang_dirujuk_ke ?? '-' ?> (Alasan:
                    <?= $d->igdPsikiatri->pulang_alasan_dirujuk ?? '' ?>)</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Meninggal di IGD</td>
                <td>: <?= $d->igdPsikiatri->pulang_meninggal_igd ?? '-' ?> (Penyebab:
                    <?= $d->igdPsikiatri->pulang_penyebab_kematian ?? '' ?>)</td>
            </tr>
        </table>

        <?php if (!empty($d->igdPsikiatri->fisik_pulang_td)): ?>
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <strong>Kondisi Saat Pulang:</strong>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td><strong>Kesadaran:</strong> <?= $d->igdPsikiatri->fisik_pulang_kesadaran ?? '-' ?></td>
                        <td><strong>GCS:</strong> <?= $d->igdPsikiatri->fisik_pulang_gcs ?? '-' ?></td>
                        <td><strong>TD:</strong> <?= $d->igdPsikiatri->fisik_pulang_td ?? '-' ?> mmHg</td>
                        <td><strong>Nadi:</strong> <?= $d->igdPsikiatri->fisik_pulang_nadi ?? '-' ?> x/mnt</td>
                        <td><strong>Suhu:</strong> <?= $d->igdPsikiatri->fisik_pulang_suhu ?? '-' ?> °C</td>
                        <td><strong>RR:</strong> <?= $d->igdPsikiatri->fisik_pulang_rr ?? '-' ?> x/mnt</td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
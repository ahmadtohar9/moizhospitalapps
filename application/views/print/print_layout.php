<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekam Medis - <?= isset($patient['nm_pasien']) ? $patient['nm_pasien'] : 'Pasien' ?></title>

    <!-- CSS Print Final - INLINE -->
    <style>
        <?php include(APPPATH . 'views/print/print_final.css'); ?>

        /* Custom styles jika diperlukan per halaman */
        <?php if (isset($custom_css)): ?>
            <?= $custom_css ?>
        <?php endif; ?>

        /* Style Tabel Identitas Spesifik agar mirip 'Cetak Riwayat Bulk' */
        .print-table-bordered-identity {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-bottom: 5mm;
        }
        .print-table-bordered-identity td {
            border: 1px solid #000;
            padding: 3px 5px;
            vertical-align: top;
        }
        .print-table-bordered-identity .label {
            font-weight: bold;
            background-color: #f9f9f9; /* Opsional: background tipis */
        }
        
    </style>
</head>
<body>
    <div class="print-container">
        <!-- HEADER RUMAH SAKIT (KOP SURAT) -->
        <div class="print-header">
            <div class="print-header-content">
                <div class="print-header-logo">
                    <?php if (!empty($hospital['logo'])): ?>
                        <img src="data:image/jpeg;base64,<?= $hospital['logo'] ?>" alt="Logo"
                            style="width: <?= isset($hospital['logo_width']) ? $hospital['logo_width'] : 45 ?>px;">
                    <?php endif; ?>
                </div>
                <div class="print-header-info">
                    <h1><?= isset($hospital['nama_instansi']) ? $hospital['nama_instansi'] : 'RUMAH SAKIT' ?></h1>
                    <div class="alamat"><?= $hospital['alamat_instansi'] ?>, <?= isset($hospital['kabupaten']) ? $hospital['kabupaten'] : '' ?>, <?= isset($hospital['propinsi']) ? $hospital['propinsi'] : '' ?></div>
                    <div class="kontak">Telp: <?= $hospital['kontak'] ?> | Email: <?= $hospital['email'] ?></div>
                    <?php if (isset($hospital['akreditasi']) && $hospital['akreditasi']): ?>
                        <div class="akreditasi">Terakreditasi <?= $hospital['akreditasi'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ============================================
             IDENTITAS PASIEN (MODEL TABEL)
             ============================================ -->
        <div class="print-patient-identity">
            <h2 style="margin-bottom: 2mm; text-align: center; border: none; font-size: 14pt; font-weight: bold; padding:0; text-transform: uppercase; text-decoration: underline;">RIWAYAT RAWAT JALAN</h2>
            
            <table class="print-table-bordered-identity">
                <tr>
                    <td class="label" style="width: 15%;">No. RM</td>
                    <td class="value" style="width: 35%;">: <?= isset($patient['no_rkm_medis']) ? $patient['no_rkm_medis'] : '-' ?></td>
                    <td class="label" style="width: 15%;">No. Rawat</td>
                    <td class="value" style="width: 35%;">: <?= isset($visit['no_rawat']) ? $visit['no_rawat'] : '-' ?></td>
                </tr>
                <tr>
                    <td class="label">Nama Pasien</td>
                    <td class="value">: <strong><?= isset($patient['nm_pasien']) ? $patient['nm_pasien'] : '-' ?></strong></td>
                    <td class="label">Tgl. Kunjungan</td>
                    <td class="value">: <?= isset($visit['tgl_registrasi']) ? date('d-m-Y', strtotime($visit['tgl_registrasi'])) . ' ' . (isset($visit['jam_reg']) ? $visit['jam_reg'] : '')  : '-' ?></td>
                </tr>
                <tr>
                    <td class="label">Tgl. Lahir</td>
                    <td class="value">: <?= isset($patient['tgl_lahir']) ? date('d/m/Y', strtotime($patient['tgl_lahir'])) : '-' ?></td>
                    <td class="label">Poli / Dokter</td>
                    <td class="value">: <?= isset($visit['nm_poli']) ? $visit['nm_poli'] : '-' ?> / <?= isset($visit['nm_dokter']) ? $visit['nm_dokter'] : '-' ?></td>
                </tr>
            </table>
        </div>

        <!-- ============================================
             KONTEN SECTIONS
             ============================================ -->
        <?php if (isset($sections) && is_array($sections)): ?>
            <?php foreach ($sections as $section): ?>
                <?php
                // Load section file
                if (isset($section['file']) && file_exists(APPPATH . 'views/print/sections/' . $section['file'])) {
                    // Pass data section ke view
                    $section_data = isset($section['data']) ? $section['data'] : array();
                    $this->load->view('print/sections/' . $section['file'], $section_data);
                }
                ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- ============================================
             TANDA TANGAN (OPSIONAL)
             ============================================ -->
        <?php if (isset($show_signature) && $show_signature): ?>
            <div class="signature-section">
                <div class="signature-grid">
                    <div class="signature-box">
                        <!-- Kosong untuk pasien/keluarga jika diperlukan -->
                    </div>
                    <div class="signature-box">
                        <div class="signature-city"><?= isset($hospital['kabupaten']) ? $hospital['kabupaten'] : 'Tangerang' ?>, <?= isset($print_date) ? $print_date : date('d-m-Y') ?></div>
                        <div class="signature-title">Dokter Penanggung Jawab</div>
                        <?php if (isset($qr_code) && $qr_code): ?>
                            <div class="signature-qr">
                                <img src="<?= $qr_code ?>" alt="QR Code">
                            </div>
                        <?php else: ?>
                            <div class="signature-space"></div>
                        <?php endif; ?>
                        <div class="signature-name">( <?= isset($visit['nm_dokter']) ? $visit['nm_dokter'] : '.........................' ?> )</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- ============================================
             FOOTER HALAMAN
             ============================================ -->
        <div class="print-footer">
            <div class="print-footer-text">
                Dokumen ini dicetak secara otomatis dan sah tanpa tanda tangan basah.
            </div>
        </div>

        <!-- WATERMARK (Opsional) -->
        <?php if (isset($hospital['use_watermark']) && $hospital['use_watermark']): ?>
            <div class="watermark"><?= isset($hospital['watermark_text']) ? $hospital['watermark_text'] : 'RSUD' ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
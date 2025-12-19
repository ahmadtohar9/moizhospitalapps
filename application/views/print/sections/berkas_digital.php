<?php
/**
 * SECTION: BERKAS DIGITAL
 */

// Handle data structure
$berkas_data = null;
if (isset($d->berkas_digital)) {
    $berkas_data = $d->berkas_digital;
} elseif (isset($d['berkas_digital'])) {
    $berkas_data = $d['berkas_digital'];
}

if (empty($berkas_data)) {
    return;
}
?>

<div class="print-section" style="margin: 20px 0;">
    <h3 style="background-color: #e0e0e0; padding: 8px; margin: 10px 0; font-size: 12pt;">
        BERKAS DIGITAL PERAWATAN
    </h3>

    <?php foreach ($berkas_data as $index => $item):
        $file_path = $item->lokasi_file ?? '';

        // Build path langsung tanpa helper (karena helper menambah subfolder berkas/)
        $docroot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
        $host = $_SERVER['HTTP_HOST'] ?? '127.0.0.1';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';

        // Clean path dari database
        $clean_path = ltrim(str_replace('\\', '/', $file_path), '/');

        // Jika path sudah lengkap dengan webapps, pakai langsung
        if (strpos($clean_path, 'webapps/') === 0) {
            $abs_path = $docroot . '/' . $clean_path;
            $file_url = $scheme . $host . '/' . $clean_path;
        } else {
            // Jika hanya pages/upload/xxx.png, tambahkan prefix
            $abs_path = $docroot . '/webapps/berkasrawat/' . $clean_path;
            $file_url = $scheme . $host . '/webapps/berkasrawat/' . $clean_path;
        }

        $file_exists = is_file($abs_path);
        $file_ext = strtoupper(pathinfo($abs_path, PATHINFO_EXTENSION));
        $is_image = in_array($file_ext, ['JPG', 'JPEG', 'PNG', 'GIF', 'BMP', 'WEBP']);
        $is_pdf = ($file_ext === 'PDF');
        ?>

        <div style="margin-bottom: 20px; border: 2px solid #000; padding: 10px; page-break-inside: avoid;">
            <table style="width: 100%; margin-bottom: 10px; font-size: 9pt;">
                <tr>
                    <td style="width: 20%; font-weight: bold;">Berkas #<?= $index + 1 ?></td>
                    <td style="width: 80%;"><?= htmlspecialchars($item->kode ?? 'Dokumen ' . ($index + 1)) ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Nama File:</td>
                    <td><?= htmlspecialchars(basename($file_path)) ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Tipe:</td>
                    <td><?= $file_ext ?>     <?= $file_exists ? '✓' : '✗ (File tidak ditemukan)' ?></td>
                </tr>
            </table>

            <?php if ($is_image): ?>
                <?php if ($file_exists): ?>
                    <!-- Tampilkan gambar -->
                    <div style="text-align: center; margin-top: 10px;">
                        <img src="<?= $file_url ?>" alt="<?= htmlspecialchars($item->kode ?? 'Berkas') ?>"
                            style="max-width: 100%; max-height: 600px; border: 1px solid #ccc; padding: 5px;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div
                            style="display: none; padding: 20px; background-color: #fff3cd; border: 1px solid #ffc107; text-align: center;">
                            <p style="margin: 0; color: #856404;"><strong>⚠️ Gambar tidak dapat ditampilkan</strong></p>
                            <p style="margin: 5px 0 0 0; font-size: 9pt; color: #856404;">
                                URL error: <?= htmlspecialchars($file_url) ?>
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- File tidak ditemukan -->
                    <div style="padding: 20px; background-color: #fff3cd; border: 1px solid #ffc107; text-align: center;">
                        <p style="margin: 0; color: #856404;"><strong>⚠️ Gambar tidak dapat ditampilkan</strong></p>
                        <p style="margin: 5px 0 0 0; font-size: 9pt; color: #856404;">
                            File tidak ditemukan di server
                        </p>
                    </div>
                <?php endif; ?>
            <?php elseif ($is_pdf): ?>
                <!-- Info PDF -->
                <div style="padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; text-align: center;">
                    <p style="margin: 0; font-size: 11pt;">📄 <strong>Dokumen PDF</strong></p>
                    <p style="margin: 5px 0 0 0; font-size: 9pt; color: #666;">
                        <?= $file_exists ? 'File tersedia' : 'File tidak ditemukan' ?>
                    </p>
                </div>
            <?php else: ?>
                <!-- File lainnya -->
                <div style="padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; text-align: center;">
                    <p style="margin: 0; font-size: 11pt;">📎 <strong>Berkas Digital (<?= $file_ext ?>)</strong></p>
                    <p style="margin: 5px 0 0 0; font-size: 9pt; color: #666;">
                        <?= $file_exists ? 'File tersedia' : 'File tidak ditemukan' ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

    <p style="margin-top: 10px; font-size: 9pt; font-style: italic; color: #666;">
        <strong>Catatan:</strong> Berkas digital tersimpan di sistem dan dapat diakses melalui aplikasi.
    </p>
</div>
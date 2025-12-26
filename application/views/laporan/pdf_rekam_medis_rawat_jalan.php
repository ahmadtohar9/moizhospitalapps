<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekam Medis Rawat Jalan</title>
    <style>
        /* Base Print Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
        }

        /* Header Styles - SAMA DENGAN print_layout.php */
        .print-header {
            border-bottom: 2px solid #000;
            padding-bottom: 5mm;
            margin-bottom: 5mm;
        }

        .print-header-content {
            display: table;
            width: 100%;
        }

        .print-header-logo {
            display: table-cell;
            width: 60px;
            vertical-align: middle;
            text-align: center;
        }

        .print-header-logo img {
            max-width: 50px;
            height: auto;
        }

        .print-header-info {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }

        .print-header-info h1 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 2mm;
        }

        .print-header-info .alamat,
        .print-header-info .kontak {
            font-size: 9pt;
            line-height: 1.3;
        }

        /* Title Section */
        .report-title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 5mm;
        }

        /* Summary Box */
        .summary-box {
            background: #f8f9fa;
            border-left: 3px solid #000;
            padding: 8px;
            margin-bottom: 5mm;
            font-size: 9pt;
        }

        .summary-box h3 {
            font-size: 10pt;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .summary-table {
            width: 100%;
            font-size: 9pt;
        }

        .summary-table td {
            padding: 2px 0;
        }

        .summary-table strong {
            font-weight: bold;
        }

        /* Data Table - SAMA DENGAN print_layout.php */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-top: 3mm;
        }

        .data-table th {
            background-color: #333;
            color: white;
            padding: 5px 3px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #000;
        }

        .data-table td {
            padding: 4px 3px;
            border: 1px solid #000;
            vertical-align: top;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Badge Styles */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 7pt;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Footer */
        .print-footer {
            margin-top: 10mm;
            text-align: center;
            font-size: 8pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        /* No Data */
        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- HEADER RUMAH SAKIT (KOP SURAT) - DENGAN LOGO -->
    <div class="print-header">
        <table width="100%">
            <tr>
                <td width="10%" align="left" style="vertical-align:middle;">
                    <?php if (!empty($hospital_logo)): ?>
                        <img src="<?= $hospital_logo ?>" width="70px">
                    <?php endif; ?>
                </td>
                <td align="center" style="vertical-align:middle;">
                    <h2 style="margin:0; font-size:18px;"><?= strtoupper($hospital_name ?? 'RUMAH SAKIT') ?></h2>
                    <p style="margin:2px 0; font-size:12px;"><?= $hospital_address ?? '' ?></p>
                    <p style="margin:0; font-size:12px;"><?= $hospital_contact ?? '' ?></p>
                </td>
                <td width="10%" align="right" style="vertical-align:middle;">
                    <!-- Optional: Right Logo -->
                </td>
            </tr>
        </table>
    </div>

    <!-- TITLE -->
    <div class="report-title"><?= isset($report_title) ? $report_title : 'Laporan Rekam Medis Rawat Jalan' ?></div>

    <!-- SUMMARY -->
    <div class="summary-box">
        <h3>📊 Ringkasan Laporan</h3>
        <table class="summary-table">
            <tr>
                <td width="25%"><strong>Total Kunjungan:</strong></td>
                <td width="25%"><?= $total_records ?> pasien</td>
                <td width="25%"><strong>Filter:</strong></td>
                <td width="25%"><?= $filter_desc ?: 'Semua data' ?></td>
            </tr>
            <tr>
                <td><strong>Dicetak oleh:</strong></td>
                <td><?= $user_name ?></td>
                <td><strong>Tanggal Cetak:</strong></td>
                <td><?= date('d F Y, H:i') ?> WIB</td>
            </tr>
        </table>
    </div>

    <!-- DATA TABLE -->
    <?php if ($total_records > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="3%">No.</th>
                    <th width="10%">No. Rawat</th>
                    <th width="7%">No. RM</th>
                    <th width="15%">Nama Pasien</th>
                    <th width="15%">Dokter</th>
                    <th width="12%">Poli</th>
                    <th width="12%">Penjamin</th>
                    <th width="12%">Tgl Registrasi</th>
                    <th width="7%">Status Bayar</th>
                    <th width="7%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($data_result as $row): ?>
                    <?php
                    $status_bayar_class = $row->status_bayar === 'Sudah Bayar' ? 'badge-success' : 'badge-warning';
                    $status_class = $row->stts === 'Sudah' ? 'badge-success' : 'badge-warning';
                    ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->no_rawat) ?></td>
                        <td><?= htmlspecialchars($row->no_rkm_medis) ?></td>
                        <td><?= htmlspecialchars($row->nm_pasien) ?></td>
                        <td><?= htmlspecialchars($row->nm_dokter) ?></td>
                        <td><?= htmlspecialchars($row->nm_poli) ?></td>
                        <td><?= htmlspecialchars($row->png_jawab) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->tgl_registrasi)) ?></td>
                        <td><span class="badge <?= $status_bayar_class ?>"><?= htmlspecialchars($row->status_bayar) ?></span>
                        </td>
                        <td><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row->stts) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-data">Tidak ada data untuk ditampilkan.</div>
    <?php endif; ?>

    <!-- FOOTER -->
    <div class="print-footer">
        Dokumen ini dicetak secara otomatis dari sistem SIMRS.
    </div>

</body>

</html>
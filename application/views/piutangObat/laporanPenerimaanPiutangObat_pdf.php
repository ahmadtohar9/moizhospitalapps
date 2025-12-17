<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Piutang Obat / Alkes / BHP</title>
    <style>
        body { font-family: "Times New Roman", serif; margin: 0; padding: 0; }

        .header {
            display: flex;
            align-items: flex-start;
            padding: 10px;
            border-bottom: 1px solid black;
        }

        .header img {
            width: 50px;
            height: auto;
            object-fit: contain;
            margin-right: 10px;
        }

        .header .details {
            flex: 1;
            line-height: 1.2;
        }

        .header .details h1 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
        }

        .header .details p {
            margin: 2px 0;
            font-size: 12px;
        }

        .content-title {
            text-align: center;
            margin-top: 10px;
        }

        .content-title h2 {
            font-size: 14px;
            margin: 0;
        }

        .content-title p {
            font-size: 12px;
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        table, th, td { border: 1px solid black; }
        th, td { padding: 4px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <img src="<?= base_url('assets/images/logoandini.jpg'); ?>" alt="Logo RS" style="width: 50px; height: 50px; object-fit: contain;">
        <div class="details">
            <h1><?= $setting['nama_instansi']; ?></h1>
            <p><?= $setting['alamat_instansi']; ?>, <?= $setting['kabupaten']; ?>, <?= $setting['propinsi']; ?></p>
            <p>Kontak: <?= $setting['kontak']; ?> | Email: <?= $setting['email']; ?></p>
        </div>
    </div>

    <div class="content-title">
        <h2>Laporan Piutang Obat / Alkes / BHP</h2>
        <p><strong>Periode:</strong> <?= date('d-m-Y', strtotime($start_date)); ?> s/d <?= date('d-m-Y', strtotime($end_date)); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Faktur</th>
                <th>Tgl Faktur</th>
                <th>Tgl Tempo</th>
                <th>Supplier</th>
                <th>Total Obat</th>
                <th>PPN</th>
                <th>Meterai</th>
                <th>Total Tagihan</th>
                <th>Status</th>
                <th>Sisa Hari</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($piutang)) : ?>
                <?php $no = 1; $total = 0; ?>
                <?php foreach ($piutang as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['no_faktur']; ?></td>
                        <td class="text-center"><?= $row['tgl_faktur']; ?></td>
                        <td class="text-center"><?= $row['tgl_tempo']; ?></td>
                        <td><?= $row['nama_suplier']; ?></td>
                        <td class="text-right">Rp <?= number_format($row['total2'], 0, ',', '.'); ?></td>
                        <td class="text-right">Rp <?= number_format($row['ppn'], 0, ',', '.'); ?></td>
                        <td class="text-right">Rp <?= number_format($row['meterai'], 0, ',', '.'); ?></td>
                        <td class="text-right">Rp <?= number_format($row['tagihan'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?= $row['status']; ?></td>
                        <td class="text-center"><?= $row['sisa_hari']; ?> hari</td>
                    </tr>
                    <?php $total += $row['tagihan']; ?>
                <?php endforeach; ?>
                <tr>
                    <th colspan="8" class="text-right">Total Tagihan:</th>
                    <th class="text-right">Rp <?= number_format($total, 0, ',', '.'); ?></th>
                    <th colspan="2"></th>
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="11" class="text-center">Tidak ada data tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
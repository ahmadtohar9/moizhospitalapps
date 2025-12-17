<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Piutang Pasien</title>
    <style>
        /* Body */
        body {
            font-family: "Times New Roman", serif;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center; /* Vertikal sejajar */
            margin-bottom: 5px; /* Jarak kecil ke bawah */
            border-bottom: 1px solid black;
            padding: 5px 10px; /* Atur padding lebih kecil */
        }

        .header img {
            width: 50px; /* Atur lebar gambar */
            height: auto; /* Pertahankan rasio aspek */
            margin-right: 10px; /* Jarak antara gambar dan teks */
        }

        .header .details {
            text-align: left; /* Sejajarkan teks ke kiri */
            flex: 1; /* Biarkan teks memenuhi ruang */
            line-height: 1.2; /* Jarak antar baris lebih rapat */
        }

        .header .details h1 {
            font-size: 16px; /* Judul lebih kecil */
            margin: 0;
            font-weight: bold;
        }

        .header .details p {
            margin: 2px 0;
            font-size: 12px; /* Font lebih kecil */
        }

        /* Konten Judul */
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
            margin: 5px 0;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px; /* Kurangi jarak tabel ke atas */
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        tfoot th {
            text-align: right;
        }

        /* Footer */
        .footer {
            text-align: right;
            font-size: 10px;
            margin-top: 10px;
        }
    </style>

</head>
<body>
    <div class="header">
        <!-- Pastikan path gambar sudah benar -->
        <img src="<?= base_url('assets/images/logoandini.jpg'); ?>" alt="Logo RS" width="50px" margin-top="1px" margin-bottom="5px">
        <div class="details">
            <h1><?= $setting['nama_instansi']; ?></h1>
            <p><?= $setting['alamat_instansi']; ?>, <?= $setting['kabupaten']; ?>, <?= $setting['propinsi']; ?></p>
            <p>Kontak: <?= $setting['kontak']; ?> | Email: <?= $setting['email']; ?></p>
        </div>
    </div>

    <div class="content-title">
        <h2>Laporan Piutang Pasien Asuransi</h2>
    </div>

    <!-- Isi Tabel -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Rawat</th>
                <th>No. Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Asuransi</th>
                <th>Total Piutang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $total = 0; ?>
            <?php foreach ($piutang as $item): ?>
                <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><?= $item['no_rawat']; ?></td>
                    <td><?= $item['no_rkm_medis']; ?></td>
                    <td><?= $item['nm_pasien']; ?></td>
                    <td><?= $item['png_jawab']; ?></td>
                    <td style="text-align: right;"><?= 'Rp ' . number_format($item['totalpiutang'], 0, ',', '.'); ?></td>
                </tr>
                <?php $total += $item['totalpiutang']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align: right;">Total Piutang:</th>
                <th style="text-align: right;"><?= 'Rp ' . number_format($total, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= date('d-m-Y H:i:s'); ?></p>
    </div>
</body>

</html>

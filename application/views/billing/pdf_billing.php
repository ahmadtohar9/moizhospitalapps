<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Billing Pasien Rawat Jalan</title>
    <style>
       /* Reset Margin dan Padding */
        body {
            font-family: "Times New Roman", serif;
            margin: 0;
            padding: 0;
        }

        /* Header */
    @media print {
        .header {
            display: flex;
            align-items: flex-start; /* Ubah dari center ke flex-start agar header lebih rapat ke atas */
            margin: 0; /* Hapus margin bawah agar header merapat ke atas */
            padding: 2px 10px; /* Kurangi padding lebih lanjut */
            border-bottom: 1px solid black;
        }

        .header img {
            width: 50px; /* Tetapkan lebar gambar secara eksplisit */
            height: auto; /* Tinggi otomatis untuk menjaga proporsi */
            object-fit: contain; /* Menyesuaikan gambar agar tidak terdistorsi */
            margin-right: 8px; /* Jarak antara gambar dan teks */
            margin-top: 2px; /* Tambahkan margin atas kecil agar gambar tidak terlalu menempel */
        }

        .header .details {
            text-align: left;
            flex: 1;
            line-height: 1.1; /* Mengurangi jarak antar baris */
            margin-top: 2px; /* Tambahkan margin atas kecil agar teks tidak terlalu menempel */
        }

        .header .details h1 {
            font-size: 14px; /* Mengecilkan ukuran judul */
            margin: 0;
            font-weight: bold;
        }

        .header .details p {
            margin: 1px 0;
            font-size: 11px; /* Mengecilkan font deskripsi */
        }

        /* Konten Judul */
        .content-title {
            text-align: center;
            margin-top: 5px; /* Mengurangi margin atas */
        }

        .content-title h2 {
            font-size: 13px; /* Menyesuaikan ukuran judul */
            margin: 0;
        }

        .content-title p {
            font-size: 11px;
            margin: 3px 0;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px; /* Mengurangi margin tabel */
            font-size: 11px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 4px; /* Mengurangi padding */
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
            margin-top: 5px; /* Mengurangi margin atas */
        }
    }
    </style>
</head>
<body>
     <div class="header">
        <img src="<?= base_url('assets/images/logoandini.jpg'); ?>" alt="Logo RS" style="width: 50px; height: auto; object-fit: contain;">
        <div class="details">
            <h1><?= $setting['nama_instansi']; ?></h1>
            <p><?= $setting['alamat_instansi']; ?>, <?= $setting['kabupaten']; ?>, <?= $setting['propinsi']; ?></p>
            <p>Kontak: <?= $setting['kontak']; ?> | Email: <?= $setting['email']; ?></p>
        </div>
    </div>

    <div class="content-title">
        <h2>Laporan Billing Pasien Rawat Jalan</h2>
        <p><strong>Periode:</strong> <?= date('d-m-Y', strtotime($start_date)); ?> s/d <?= date('d-m-Y', strtotime($end_date)); ?></p>
        <?php if (!empty($dokter)) : ?>
            <p><strong>Dokter:</strong> <?= $dokter; ?></p>
        <?php endif; ?>
    </div>
       <table border="1" cellpadding="6" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Bayar</th>
                <th>No. Rawat</th>
                <th>No. RM</th>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Administrasi</th>
                <th>Total Obat</th>
                <th>Total Laboratorium</th>
                <th>Tindakan Konsul</th>
                <th>USG</th>
                <th>Tindakan Lain</th>
                <th>Sewa Ruangan</th>
                <th>Jasa Layanan</th>
                <th>Jasa Dokter</th>
                <th>Tambahan Biaya</th>
                <th>Potongan Biaya</th>
                <th>Total Tagihan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($billing)) : ?>
                <?php $total = 0; $i = 1; ?>
                <?php foreach ($billing as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tgl_byr'])); ?></td>
                        <td><?= $row['no_rawat']; ?></td>
                        <td><?= $row['No_RM']; ?></td>
                        <td><?= $row['Nama_Pasien']; ?></td>
                        <td><?= $row['Nama_Dokter']; ?></td>
                        <td>Rp <?= number_format($row['Adm'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Total_Obat'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Total_Labor'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Tindakan_Konsul'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Tindakan_USG'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Tindakan_Lain'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Sewa_Ruangan'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Jasa_Layanan'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Jasa_Dokter'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Tambahan_Biaya'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['Potongan_Biaya'], 0, ',', '.'); ?></td>
                        <td><strong>Rp <?= number_format($row['Total_Tagihan'], 0, ',', '.'); ?></strong></td>
                    </tr>
                    <?php $total += $row['Total_Tagihan']; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="17" align="right"><strong>Total Semua:</strong></td>
                    <td><strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></td>
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="18" align="center">Tidak ada data tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

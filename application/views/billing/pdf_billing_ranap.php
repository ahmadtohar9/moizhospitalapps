<?php
function rupiah($angka) {
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}
?>

<page>
    <style>
        body { font-family: sans-serif; font-size: 9pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        th { background-color: #eee; }
    </style>

    <h4 style="text-align: center;">RINCIAN BILLING PASIEN RAWAT INAP</h4>
    <p>Periode: <?= date('d/m/Y', strtotime($start_date)) ?> s.d <?= date('d/m/Y', strtotime($end_date)) ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Rawat</th>
                <th>No. RM</th>
                <th>Nama Pasien</th>
                <th>Tgl Masuk</th>
                <th>Ruangan</th>
                <th>DPJP</th>
                <th>Paket Operasi</th>
                <th>Registrasi</th>
                <th>Tdk Dr Inap</th>
                <th>ALKES Inap</th>
                <th>Tdk Dr Ralan</th>
                <th>ALKES Ralan</th>
                <th>Tdk Prw Inap</th>
                <th>ALKES Prw Inap</th>
                <th>Tdk Prw Ralan</th>
                <th>ALKES Prw Ralan</th>
                <th>Laboratorium</th>
                <th>Radiologi</th>
                <th>Jasa Operasi</th>
                <th>Sewa OK</th>
                <th>Obat Operasi</th>
                <th>Kmr Rawat Op</th>
                <th>CTG</th>
                <th>BHP Operasi</th> <!-- ✅ Ganti dari "Op. Lain" -->
                <th>Obat</th>
                <th>Retur Obat</th>
                <th>Obat Bersih</th>
                <th>Jasa Dokter</th>
                <th>Jasa Layanan</th>
                <th>Tambahan</th>
                <th>Potongan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; $grand_total = 0; ?>
            <?php foreach ($billing as $row): 
                $total = 
                    ($row['Registrasi'] ?? 0) +
                    ($row['Tindakan_Dokter_Inap'] ?? 0) +
                    ($row['Alkes_Inap'] ?? 0) +
                    ($row['Tindakan_Dokter_Ralan'] ?? 0) +
                    ($row['Alkes_Ralan'] ?? 0) +
                    ($row['Tindakan_Perawat_Inap'] ?? 0) +
                    ($row['Alkes_Perawat_Inap'] ?? 0) +
                    ($row['Tindakan_Perawat_Ralan'] ?? 0) +
                    ($row['Alkes_Perawat_Ralan'] ?? 0) +
                    ($row['Laboratorium'] ?? 0) +
                    ($row['Radiologi'] ?? 0) +
                    ($row['Jasa_Dokter_Operasi'] ?? 0) +
                    ($row['Kamar_Operasi'] ?? 0) +
                    ($row['Operasi_Obat'] ?? 0) +
                    ($row['Kamar_Rawatan_Operasi'] ?? 0) +
                    ($row['Operasi_CTG'] ?? 0) +
                    ($row['BHP_Operasi'] ?? 0) + // ✅ ganti dari Operasi_Lainnya
                    ($row['Obat_Tambahan'] ?? 0) +
                    ($row['Jasa_Dokter_Tambahan'] ?? 0) +
                    ($row['Jasa_Layanan'] ?? 0) +
                    ($row['Tambahan_Lainnya'] ?? 0) -
                    abs($row['Potongan_Biaya'] ?? 0);

                $grand_total += $total;
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['no_rawat'] ?? '-' ?></td>
                <td><?= $row['No_RM'] ?? '-' ?></td>
                <td><?= $row['Nama_Pasien'] ?? '-' ?></td>
                <td><?= $row['Tgl_Masuk'] ?? '-' ?></td>
                <td><?= $row['Ruangan'] ?? '-' ?></td>
                <td><?= $row['Nama_Dokter'] ?? '-' ?></td>
                <td><?= $row['Nama_Paket_Operasi'] ?? '-' ?></td>
                <td><?= rupiah($row['Registrasi'] ?? 0) ?></td>
                <td><?= rupiah($row['Tindakan_Dokter_Inap'] ?? 0) ?></td>
                <td><?= rupiah($row['Alkes_Inap'] ?? 0) ?></td>
                <td><?= rupiah($row['Tindakan_Dokter_Ralan'] ?? 0) ?></td>
                <td><?= rupiah($row['Alkes_Ralan'] ?? 0) ?></td>
                <td><?= rupiah($row['Tindakan_Perawat_Inap'] ?? 0) ?></td>
                <td><?= rupiah($row['Alkes_Perawat_Inap'] ?? 0) ?></td>
                <td><?= rupiah($row['Tindakan_Perawat_Ralan'] ?? 0) ?></td>
                <td><?= rupiah($row['Alkes_Perawat_Ralan'] ?? 0) ?></td>
                <td><?= rupiah($row['Laboratorium'] ?? 0) ?></td>
                <td><?= rupiah($row['Radiologi'] ?? 0) ?></td>
                <td><?= rupiah($row['Jasa_Dokter_Operasi'] ?? 0) ?></td>
                <td><?= rupiah($row['Kamar_Operasi'] ?? 0) ?></td>
                <td><?= rupiah($row['Operasi_Obat'] ?? 0) ?></td>
                <td><?= rupiah($row['Kamar_Rawatan_Operasi'] ?? 0) ?></td>
                <td><?= rupiah($row['Operasi_CTG'] ?? 0) ?></td>
                <td><?= rupiah($row['BHP_Operasi'] ?? 0) ?></td> <!-- ✅ -->
                <td><?= rupiah($row['Obat'] ?? 0) ?></td>
                <td><?= rupiah($row['Retur_Obat'] ?? 0) ?></td>
                <td><?= rupiah($row['Obat_Tambahan'] ?? 0) ?></td>
                <td><?= rupiah($row['Jasa_Dokter_Tambahan'] ?? 0) ?></td>
                <td><?= rupiah($row['Jasa_Layanan'] ?? 0) ?></td>
                <td><?= rupiah($row['Tambahan_Lainnya'] ?? 0) ?></td>
                <td><?= rupiah($row['Potongan_Biaya'] ?? 0) ?></td>
                <td><strong><?= rupiah($total) ?></strong></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="32" style="text-align:right;">GRAND TOTAL:</th>
                <th><?= rupiah($grand_total) ?></th>
            </tr>
        </tbody>
    </table>
</page>

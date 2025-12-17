<h4 style="text-align: center;">REKAP PEMBAYARAN RAWAT JALAN</h4>
<p>Periode: <?= $start_date ?> s.d <?= $end_date ?></p>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th><th>Tanggal</th><th>No Nota</th><th>No RM</th><th>Pasien</th><th>Asuransi</th>
            <th>Poli</th><th>Perujuk</th><th>Dokter</th><th>Registrasi</th>
            <th>Obat</th><th>Ralan</th><th>Operasi</th><th>Laborat</th><th>Radiologi</th>
            <th>Tambahan</th><th>Potongan</th><th>Total</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1; $grand = 0;
    foreach ($billing as $row): $grand += $row['total_biaya']; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tgl_registrasi'] ?></td>
            <td><?= $row['no_nota'] ?></td>
            <td><?= $row['no_rkm_medis'] ?></td>
            <td><?= $row['nm_pasien'] ?></td>
            <td><?= $row['png_jawab'] ?></td>
            <td><?= $row['nm_poli'] ?></td>
            <td><?= $row['perujuk'] ?></td>
            <td><?= $row['nm_dokter'] ?></td>
            <td><?= number_format($row['biaya_registrasi']) ?></td>
            <td><?= number_format($row['biaya_obat']) ?></td>
            <td><?= number_format($row['biaya_ralan']) ?></td>
            <td><?= number_format($row['biaya_operasi']) ?></td>
            <td><?= number_format($row['biaya_laborat']) ?></td>
            <td><?= number_format($row['biaya_radiologi']) ?></td>
            <td><?= number_format($row['biaya_tambahan']) ?></td>
            <td><?= number_format($row['biaya_potongan']) ?></td>
            <td><?= number_format($row['total_biaya']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="16" align="right"><strong>Grand Total</strong></td>
            <td><strong><?= number_format($grand) ?></strong></td>
        </tr>
    </tfoot>
</table>

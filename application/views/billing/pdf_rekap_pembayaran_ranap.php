<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
  <style>
    body { font-family: sans-serif; font-size: 10pt; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: center; }
    th { background-color: #d4edda; } /* Hijau muda */
    .bg-primary { background-color: #007bff; color: white; }
    .text-right { text-align: right; }
    .font-weight-bold { font-weight: bold; }
  </style>

  <h4 style="text-align: center;">REKAP PEMBAYARAN PASIEN RAWAT INAP</h4>
  <p style="text-align: center;">Periode: <?= date('d/m/Y', strtotime($start_date)) ?> s.d <?= date('d/m/Y', strtotime($end_date)) ?></p>

  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>RM</th>
        <th>Pasien</th>
        <th>Asuransi</th>
        <th>Kamar</th>
        <th>Perujuk</th>
        <th>Registrasi</th>
        <th>Tindakan</th>
        <th>Obat+Emb+Tsl</th>
        <th>Retur Obat</th>
        <th>Resep Pulang</th>
        <th>Laborat</th>
        <th>Radiologi</th>
        <th>Potongan</th>
        <th>Tambahan</th>
        <th>Kamar+Service</th>
        <th>Operasi</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $grand_total = 0;
        foreach ($laporan as $row):
          $biaya_tindakan = ($row['biaya_ranap_dokter'] ?? 0) + ($row['biaya_ranap_paramedis'] ?? 0);
          $biaya_obat = ($row['biaya_obat'] ?? 0) + ($row['biaya_ralan'] ?? 0);
          $biaya_kamar_service = ($row['biaya_kamar'] ?? 0) + ($row['biaya_service'] ?? 0);
          $total = floatval($row['total_biaya']);
          $grand_total += $total;
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['no_rkm_medis'] ?></td>
        <td><?= $row['nm_pasien'] ?></td>
        <td><?= $row['png_jawab'] ?></td>
        <td><?= $row['nm_bangsal'] ?></td>
        <td><?= $row['perujuk'] ?: '-' ?></td>
        <td class="text-right"><?= number_format($row['biaya_registrasi'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($biaya_tindakan, 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($biaya_obat, 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_retur_obat'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_resep_pulang'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_laborat'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_radiologi'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_potongan'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_tambahan'], 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($biaya_kamar_service, 0, ',', '.') ?></td>
        <td class="text-right"><?= number_format($row['biaya_operasi'], 0, ',', '.') ?></td>
        <td class="text-right font-weight-bold"><?= number_format($total, 0, ',', '.') ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr class="bg-primary font-weight-bold">
        <td colspan="17" class="text-right">Grand Total</td>
        <td class="text-right"><?= number_format($grand_total, 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>
</page>

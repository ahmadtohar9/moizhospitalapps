<?php
// Variabel tersedia: $setting, $detail_pasien, $assesment, $tgl, $jam, $tgl_lahir
function safe($v){ return isset($v) && $v !== '' ? $v : '-'; }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PENILAIAN AWAL MEDIS RAWAT JALAN MATA</title>
  <style>
      body { 
          font-family: Arial, sans-serif; 
          font-size: 9px; 
          margin: 0;
          padding: 0;
          line-height: 1.2;
      }

      .head {
          display: flex;
          align-items: center;
          margin-bottom: 3px;
          padding: 2px 0;
      }

      .head-logo {
          height: 45px;
          margin-right: 8px;
      }

      .head-title {
          flex: 1;
      }

      .instansi {
          font-weight: bold;
          font-size: 11px;
          margin: 0;
      }

      .alamat {
          font-size: 8px;
          margin: 1px 0;
      }

      .kontak {
          font-size: 7px;
          margin: 1px 0;
      }

      .divider {
          border-bottom: 1px solid #000;
          margin: 2px 0 5px 0;
      }

      .judul {
          text-align: center;
          font-weight: bold;
          font-size: 10px;
          margin: 3px 0 6px 0;
      }

      table { 
          width: 100%; 
          border-collapse: collapse; 
          margin-bottom: 6px;
      }

      th, td { 
          border: 1px solid #000; 
          padding: 3px; 
          vertical-align: top;
          font-size: 8px;
      }

      th { 
          background-color: #f0f0f0; 
          font-weight: bold;
      }

      .section-title {
          background-color: #e0e0e0;
          font-weight: bold;
          padding: 3px;
          border: 1px solid #000;
          margin: 6px 0 4px 0;
          font-size: 9px;
      }

      .patient-info table {
          border: none;
          margin-bottom: 4px;
      }

      .patient-info td {
          border: none;
          padding: 1px 0;
          font-size: 8px;
      }

      .no-border td {
          border: none;
          padding: 0;
      }

      .text-center {
          text-align: center;
      }

      /* Tambahan untuk spacing yang lebih ketat */
      .section-content {
          margin: 0;
          padding: 0;
      }

      .compact-table {
          margin-bottom: 4px;
      }

      .compact-table th,
      .compact-table td {
          padding: 2px 3px;
      }
</style>
</head>
<body>

<!-- JUDUL UTAMA -->
<div class="judul">PENILAIAN AWAL MEDIS RAWAT JALAN MATA</div>

<!-- INFO PASIEN -->
<table class="patient-info">
  <tr class="no-border">
    <td width="40%" style="border: none;">
      <strong>No. RM :</strong> <?= safe($detail_pasien['no_rkm_medis'] ?? '') ?>
    </td>
    <td width="30%" style="border: none;">
      <strong>Jenis Kelamin :</strong> <?= safe($detail_pasien['jk'] ?? '') ?>
    </td>
    <td width="30%" style="border: none;">
      <strong>Tanggal :</strong> <?= safe($tgl) ?> <?= safe($jam) ?>
    </td>
  </tr>
  <tr class="no-border">
    <td style="border: none;">
      <strong>Nama Pasien :</strong> <?= safe($detail_pasien['nm_pasien'] ?? '') ?>
    </td>
    <td style="border: none;">
      <strong>Tanggal Lahir :</strong> <?= safe($tgl_lahir) ?>
    </td>
    <td style="border: none;">
      <strong>Anamnesis:</strong> <?= safe($assesment['anamnesis'] ?? '') ?>, <?= safe($assesment['hubungan'] ?? '') ?>
    </td>
  </tr>
</table>

<!-- I. RWAYAT KESEHATAN -->
<div class="section-title">I. RWAYAT KESEHATAN</div>
<table>
  <tr>
    <th width="20%">Keluhan Utama</th>
    <td colspan="3"><?= safe($assesment['keluhan_utama'] ?? '') ?></td>
  </tr>
  <tr>
    <th>Riwayat Penyakit Sekarang</th>
    <td width="30%"><?= safe($assesment['rps'] ?? '') ?></td>
    <th width="20%">Riwayat Penyakit Dahulu</th>
    <td width="30%"><?= safe($assesment['rpd'] ?? '') ?></td>
  </tr>
  <tr>
    <th>Riwayat Penggunaan Obat</th>
    <td><?= safe($assesment['alergi'] ?? '') ?></td>
    <th>Riwayat Alergi</th>
    <td><?= safe($assesment['alergi'] ?? '') ?></td>
  </tr>
</table>

<!-- II. PEMERIKSAAN FISIK -->
<div class="section-title">II. PEMERIKSAAN FISIK</div>
<table>
  <tr>
    <th width="16%">TD</th>
    <td width="16%"><?= safe($assesment['td'] ?? '') ?> mmHg</td>
    <th width="16%">BB</th>
    <td width="16%"><?= safe($assesment['bb'] ?? '') ?> Kg</td>
    <th width="16%">Suhu</th>
    <td width="16%"><?= safe($assesment['suhu'] ?? '') ?> °C</td>
  </tr>
  <tr>
    <th>Nadi</th>
    <td><?= safe($assesment['nadi'] ?? '') ?> x/menit</td>
    <th>RR</th>
    <td><?= safe($assesment['rr'] ?? '') ?> x/menit</td>
    <th>Nyeri</th>
    <td><?= safe($assesment['nyeri'] ?? '') ?></td>
  </tr>
</table>
<table>
  <tr>
    <th width="20%">Status Nutrisi</th>
    <td><?= safe($assesment['bb'] ?? '') ?></td>
  </tr>
</table>

<!-- III. STATUS OFTAMOLOGIS -->
<div class="section-title">III. STATUS OFTAMOLOGIS</div>
<table>
  <tr>
    <th width="50%">OD (Oculus Dextra)</th>
    <th width="50%">OS (Oculus Sinistra)</th>
  </tr>
  <tr>
    <td>
      <table style="border: none;">
        <tr><td>Visus SC</td><td>: <?= safe($assesment['visuskanan'] ?? '') ?></td></tr>
        <tr><td>CC</td><td>: <?= safe($assesment['cckanan'] ?? '') ?></td></tr>
        <tr><td>Palpebra</td><td>: <?= safe($assesment['palkanan'] ?? '') ?></td></tr>
        <tr><td>Conjungtiwa</td><td>: <?= safe($assesment['conkanan'] ?? '') ?></td></tr>
        <tr><td>Cornea</td><td>: <?= safe($assesment['corneakanan'] ?? '') ?></td></tr>
        <tr><td>COA</td><td>: <?= safe($assesment['coakanan'] ?? '') ?></td></tr>
        <tr><td>Iris/Pupil</td><td>: <?= safe($assesment['pupilkanan'] ?? '') ?></td></tr>
        <tr><td>Lensa</td><td>: <?= safe($assesment['lensakanan'] ?? '') ?></td></tr>
        <tr><td>Fundus Media</td><td>: <?= safe($assesment['funduskanan'] ?? '') ?></td></tr>
        <tr><td>Papil</td><td>: <?= safe($assesment['papilkanan'] ?? '') ?></td></tr>
        <tr><td>Retina</td><td>: <?= safe($assesment['retinakanan'] ?? '') ?></td></tr>
        <tr><td>Makula</td><td>: <?= safe($assesment['makulakanan'] ?? '') ?></td></tr>
        <tr><td>TIO</td><td>: <?= safe($assesment['tiokanan'] ?? '') ?></td></tr>
        <tr><td>MBO</td><td>: <?= safe($assesment['mbokanan'] ?? '') ?></td></tr>
      </table>
    </td>
    <td>
      <table style="border: none;">
        <tr><td>Visus SC</td><td>: <?= safe($assesment['visuskiri'] ?? '') ?></td></tr>
        <tr><td>CC</td><td>: <?= safe($assesment['cckiri'] ?? '') ?></td></tr>
        <tr><td>Palpebra</td><td>: <?= safe($assesment['palkiri'] ?? '') ?></td></tr>
        <tr><td>Conjungtiwa</td><td>: <?= safe($assesment['conkiri'] ?? '') ?></td></tr>
        <tr><td>Cornea</td><td>: <?= safe($assesment['corneakiri'] ?? '') ?></td></tr>
        <tr><td>COA</td><td>: <?= safe($assesment['coakiri'] ?? '') ?></td></tr>
        <tr><td>Iris/Pupil</td><td>: <?= safe($assesment['pupilkiri'] ?? '') ?></td></tr>
        <tr><td>Lensa</td><td>: <?= safe($assesment['lensakiri'] ?? '') ?></td></tr>
        <tr><td>Fundus Media</td><td>: <?= safe($assesment['funduskiri'] ?? '') ?></td></tr>
        <tr><td>Papil</td><td>: <?= safe($assesment['papilkiri'] ?? '') ?></td></tr>
        <tr><td>Retina</td><td>: <?= safe($assesment['retinakiri'] ?? '') ?></td></tr>
        <tr><td>Makula</td><td>: <?= safe($assesment['makulakiri'] ?? '') ?></td></tr>
        <tr><td>TIO</td><td>: <?= safe($assesment['tiokiri'] ?? '') ?></td></tr>
        <tr><td>MBO</td><td>: <?= safe($assesment['mbokiri'] ?? '') ?></td></tr>
      </table>
    </td>
  </tr>
</table>

<!-- IV. PEMERIKSAAN PENUNJANG -->
<div class="section-title">IV. PEMERIKSAAN PENUNJANG</div>
<table>
  <tr>
    <th width="25%">Laboratorium</th>
    <td width="25%"><?= safe($assesment['lab'] ?? '') ?></td>
    <th width="25%">Radiologi</th>
    <td width="25%"><?= safe($assesment['rad'] ?? '') ?></td>
  </tr>
  <tr>
    <th>Penunjang Lainnya</th>
    <td><?= safe($assesment['penunjang'] ?? '') ?></td>
    <th>Tes Penglihatan</th>
    <td><?= safe($assesment['tes'] ?? '') ?></td>
  </tr>
  <tr>
    <th>Pemeriksaan Lain</th>
    <td colspan="3"><?= safe($assesment['pemeriksaan'] ?? '') ?></td>
  </tr>
</table>

<!-- V. DIAGNOSIS -->
<div class="section-title">V. DIAGNOSIS</div>
<table>
  <tr>
    <th width="20%">Asesmen Kerja</th>
    <td width="30%"><?= safe($assesment['diagnosis'] ?? '') ?></td>
    <th width="20%">Asesmen Banding</th>
    <td width="30%"><?= safe($assesment['diagnosisbdg'] ?? '') ?></td>
  </tr>
</table>

<!-- VI. PERMASALAHAN & TATALAKSANA -->
<div class="section-title">VI. PERMASALAHAN & TATALAKSANA</div>
<table>
  <tr>
    <th width="20%">Permasalahan</th>
    <td width="30%"><?= safe($assesment['permasalahan'] ?? '') ?></td>
    <th width="20%">Terapi/Pengobatan</th>
    <td width="30%"><?= safe($assesment['terapi'] ?? '') ?></td>
  </tr>
  <tr>
    <th>Tindakan/Rencana Tindakan</th>
    <td colspan="3"><?= safe($assesment['tindakan'] ?? '') ?></td>
  </tr>
</table>

<!-- VII. EDUKASI -->
<div class="section-title">VII. EDUKASI</div>
<table>
  <tr>
    <td><?= safe($assesment['edukasi'] ?? '') ?></td>
  </tr>
</table>

<!-- TANDA TANGAN -->
<div style="margin-top: 20px; text-align: right;">
  <div style="margin-bottom: 50px;">
    Dokter Pemeriksa,<br><br><br><br>
    <strong><?= safe($assesment['kd_dokter'] ?? '') ?></strong>
  </div>
</div>

</body>
</html>
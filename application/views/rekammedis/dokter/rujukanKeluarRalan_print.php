<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Surat Rujukan Keluar - <?= html_escape($row['no_surat'] ?? $row['no_rawat']) ?></title>
  <style>
    *{box-sizing:border-box}
    @page { size: A4; margin:14mm 12mm 14mm 12mm; }
    body{font-family:Arial,Helvetica,sans-serif;font-size:11.5px;color:#000;margin:0;}
    .wrap{max-width:720px;margin:0 auto;}

    /* ===== Header Instansi ===== */
    .head{display:flex;align-items:center;gap:10px;margin-bottom:4px}
    .head-logo{width:56px;height:56px;object-fit:contain}
    .head-title{flex:1;text-align:center;line-height:1.2}
    .head-title .instansi{font-weight:bold;font-size:15px;text-transform:uppercase;letter-spacing:.3px}
    .head-title .alamat,.head-title .kontak{font-size:10px;color:#333}
    .divider{border-top:1.6px solid #000;margin:6px 0 8px}

    /* ===== Dokumen Title ===== */
    .doc-title{text-align:center;margin-top:2px;font-weight:bold;font-size:12.5px;text-transform:uppercase}
    .doc-no{text-align:center;font-size:11.5px;margin-bottom:6px}

    /* ===== Tabel & Box ===== */
    table{width:100%;border-collapse:collapse}
    .meta td{padding:2px 0;vertical-align:top}
    .meta .label{width:120px;color:#333}
    .meta td+td{padding-left:6px}
    .box{border:1px solid #bfbfbf;padding:6px 7px;background:#fff;border-radius:4px;page-break-inside:avoid}
    .pre{white-space:pre-wrap;line-height:1.35;margin:0}
    .section-title{font-weight:700;margin:6px 0 4px 0}

    /* ===== Grid ===== */
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:8px}
    .grid-gap-6{gap:6px}

    /* ===== Footer TTD ===== */
    .footer-ttd{margin-top:18px;width:100%;clear:both;page-break-inside:avoid}
    .footer-ttd .col{width:48%;display:inline-block;vertical-align:top}
    .footer-ttd .col.right{float:right;text-align:center}
    .footer-ttd .col.left{float:left;text-align:center}
    .jabatan{margin-bottom:4px}
    .ttd-img{width:180px;height:auto;margin:2px 0 0 0;object-fit:contain}

    /* Toolbar */
    .no-print{margin:8px 0}
    .no-print button{padding:6px 10px;margin-right:6px;cursor:pointer}
    @media print{ .no-print{display:none} }
  </style>
</head>
<body>
<div class="wrap">

  <!-- toolbar -->
  <div class="no-print">
    <button onclick="window.print()">🖨️ Cetak</button>
    <button onclick="window.close()">✖️ Tutup</button>
  </div>

  <!-- header -->
  <div class="head">
    <?php if (!empty($logo_data_uri)): ?>
      <img class="head-logo" src="<?= $logo_data_uri ?>" alt="Logo">
    <?php endif; ?>
    <div class="head-title">
      <div class="instansi"><?= html_escape($setting['nama_instansi'] ?? ($app_name ?? 'SIMRS')) ?></div>
      <div class="alamat">
        <?= html_escape($setting['alamat_instansi'] ?? '') ?>
        <?= !empty($setting['kabupaten']) ? ', ' . html_escape($setting['kabupaten']) : '' ?>
        <?= !empty($setting['propinsi']) ? ', ' . html_escape($setting['propinsi']) : '' ?>
      </div>
      <div class="kontak">
        Telp: <?= html_escape($setting['kontak'] ?? '-') ?>
        <?php if (!empty($setting['email'])): ?> | Email: <?= html_escape($setting['email']) ?><?php endif; ?>
      </div>
    </div>
  </div>
  <div class="divider"></div>

  <!-- Judul -->
  <div class="doc-title">SURAT RUJUKAN KELUAR</div>
  <div class="doc-no">No : <?= html_escape($row['no_surat'] ?? '-') ?></div>

  <!-- Pembuka -->
  <div class="box" style="margin-top:6px">
    Yang bertanda tangan di bawah ini, dokter pada
    <strong><?= html_escape($setting['nama_instansi'] ?? 'Rumah Sakit') ?></strong>,
    dengan ini menerangkan bahwa pasien berikut:
  </div>

  <!-- Data Pasien & Tujuan Rujukan: 2 kolom -->
  <div class="grid-2" style="margin-top:8px">
    <div class="box">
      <div class="section-title">Identitas Pasien</div>
      <table class="meta">
        <tr><td class="label">Nama</td><td>: <?= html_escape($detail_pasien['nm_pasien'] ?? '-') ?></td></tr>
        <tr><td class="label">Jenis Kelamin</td><td>: <?= html_escape($detail_pasien['jk'] ?? '-') ?></td></tr>
        <tr><td class="label">Umur</td><td>: <?= html_escape($detail_pasien['umur'] ?? '-') ?></td></tr>
        <tr><td class="label">No. RM</td><td>: <?= html_escape($detail_pasien['no_rkm_medis'] ?? ($row['no_rkm_medis'] ?? '-')) ?></td></tr>
        <tr><td class="label">No. Telp</td><td>: <?= html_escape($detail_pasien['no_tlp'] ?? '-') ?></td></tr>
        <tr><td class="label">Alamat</td><td>: <?= html_escape($detail_pasien['alamat'] ?? '-') ?></td></tr>
      </table>
    </div>

    <div class="box">
      <div class="section-title">Tujuan Rujukan</div>
      <table class="meta">
        <tr><td class="label">Kepada Yth. Dokter</td><td>: <?= html_escape($row['kepada_dokter'] ?? '-') ?></td></tr>
        <tr><td class="label">Spesialis Tujuan</td><td>: <?= html_escape($row['spesialis_tujuan'] ?? '-') ?></td></tr>
        <tr><td class="label">RS / Klinik Tujuan</td><td>: <?= html_escape($row['rs_tujuan'] ?? '-') ?></td></tr>
        <tr><td class="label">Alamat Tujuan</td><td>: <?= html_escape($row['alamat_tujuan'] ?? '-') ?></td></tr>
        <tr><td class="label">Tanggal Surat</td><td>: <?= !empty($row['tgl_surat']) ? date('d/m/Y', strtotime($row['tgl_surat'])) : date('d/m/Y') ?></td></tr>
      </table>
    </div>
  </div>

  <!-- Ringkasan Medis: 2 kolom, compact -->
  <div class="grid-2 grid-gap-6" style="margin-top:8px">
    <div class="box">
      <div class="section-title">Alasan / Ringkasan</div>
      <div class="pre"><?= nl2br(html_escape($row['alasan_rujuk'] ?? '-')) ?></div>
    </div>
    <div class="box">
      <div class="section-title">Anamnesa</div>
      <div class="pre"><?= nl2br(html_escape($row['anamnesa'] ?? '-')) ?></div>
    </div>
    <div class="box">
      <div class="section-title">Pemeriksaan Fisik</div>
      <div class="pre"><?= nl2br(html_escape($row['pemeriksaan_fisik'] ?? '-')) ?></div>
    </div>
    <div class="box">
      <div class="section-title">Pemeriksaan Penunjang</div>
      <div class="pre"><?= nl2br(html_escape($row['pemeriksaan_penunjang'] ?? '-')) ?></div>
    </div>
    <div class="box">
      <div class="section-title">Diagnosa Sementara</div>
      <div class="pre"><?= nl2br(html_escape($row['diagnosa_sementara'] ?? '-')) ?></div>
    </div>
    <div class="box">
      <div class="section-title">Tindakan yang Telah Dilakukan</div>
      <div class="pre"><?= nl2br(html_escape($row['tindakan'] ?? '-')) ?></div>
    </div>
    <div class="box" style="grid-column: span 2">
      <div class="section-title">Obat yang Telah Diberikan</div>
      <div class="pre"><?= nl2br(html_escape($row['obat'] ?? '-')) ?></div>
    </div>
  </div>

  <!-- Penutup -->
  <div class="box" style="margin-top:8px">
    Demikian surat rujukan ini dibuat agar pasien mendapat penanganan lebih lanjut sesuai dengan kondisi medisnya.
  </div>

  <!-- tanda tangan -->
  <div class="footer-ttd">
    <!-- Pasien / Wali -->
    <div class="col left">
      <div class="jabatan">
        Penerima Rujukan,<br>
        <?= !empty($row['is_signed_by_guardian']) ? 'Wali Pasien' : 'Pasien' ?>
      </div>
      <?php
        $sigPasien = $row['ttd_pasien'] ?? '';
        if ($sigPasien && strpos($sigPasien, 'data:image') !== 0) $sigPasien = 'data:image/png;base64,' . $sigPasien;
      ?>
      <?php if (!empty($sigPasien)): ?>
        <img src="<?= $sigPasien ?>" alt="TTD Pasien/Wali" class="ttd-img">
      <?php else: ?>
        <div style="height:70px"></div>
      <?php endif; ?>
      <div style="font-weight:bold;text-decoration:underline;margin-top:2px">
        <?= html_escape(!empty($row['is_signed_by_guardian']) ? ($row['nama_wali'] ?? '-') : ($detail_pasien['nm_pasien'] ?? '-')) ?>
      </div>
      <?php if (!empty($row['is_signed_by_guardian'])): ?>
        <div style="font-size:10.5px">Hubungan: <?= html_escape($row['hubungan_wali'] ?? '-') ?></div>
      <?php endif; ?>
    </div>

    <!-- Dokter -->
    <div class="col right">
      <div class="jabatan">
        <?= html_escape($setting['kabupaten'] ?? '') ?>,
        <?= !empty($row['tgl_surat']) ? date('d/m/Y', strtotime($row['tgl_surat'])) : date('d/m/Y') ?><br>
        Dokter Pengirim,
      </div>
      <?php
        $sigDokter = $row['ttd_dokter'] ?? '';
        if ($sigDokter && strpos($sigDokter, 'data:image') !== 0) $sigDokter = 'data:image/png;base64,' . $sigDokter;
      ?>
      <?php if (!empty($sigDokter)): ?>
        <img src="<?= $sigDokter ?>" alt="TTD Dokter" class="ttd-img">
      <?php else: ?>
        <div style="height:70px"></div>
      <?php endif; ?>
      <div style="font-weight:bold;text-decoration:underline;margin-top:2px">
        <?= html_escape($detail_pasien['nm_dokter'] ?? $row['kd_dokter']) ?>
      </div>
    </div>
  </div>
</div>

<script>setTimeout(function(){try{window.print();}catch(e){}},300);</script>
</body>
</html>

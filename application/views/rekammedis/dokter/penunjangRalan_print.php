<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dokumen Penunjang - <?= html_escape($row['no_rawat']) ?></title>
  <style>
    *{box-sizing:border-box}
    @page { size: A4; margin: 18mm 15mm 18mm 15mm; }
    body{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000;margin:0;}
    .wrap{max-width:730px;margin:0 auto;}

    /* ===== Header Instansi ===== */
    .head{display:flex;align-items:center;gap:14px;margin-bottom:8px;}
    .head-logo{width:68px;height:68px;object-fit:contain;}
    .head-title{flex:1;text-align:center;line-height:1.2}
    .head-title .instansi{font-weight:bold;font-size:16px;text-transform:uppercase;}
    .head-title .alamat,.head-title .kontak{font-size:11px;color:#333}
    .divider{border-top:2px solid #000;margin:8px 0 12px;}

    /* ===== Meta Pasien ===== */
    table{width:100%;border-collapse:collapse}
    .meta td{padding:2px 0;vertical-align:top;font-size:12px}
    .label{width:120px;color:#333}

    /* ===== Section Judul & Isi ===== */
    .section-title{
      margin:12px 0 6px 0;
      font-weight:bold;
      font-size:13px;
      text-transform:none;
    }
    .content-box{
      border:1px solid #333;
      padding:10px;
      min-height:120px;
    }
    .pre{white-space:pre-wrap;line-height:1.55}

    /* ===== TTD ===== */
    .footer-ttd{margin-top:28px;width:100%;}
    .footer-ttd .col{width:50%;display:inline-block;vertical-align:top;}
    .footer-ttd .col.right{text-align:center;float:right;}
    .jabatan{margin-bottom:6px}
    .ttd-img{width:220px;height:auto;margin:4px 0 0 0;object-fit:contain;}

    /* Toolbar */
    .no-print{margin:10px 0}
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

  <!-- header resmi -->
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
      <div style="margin-top:4px;font-weight:bold;">Lampiran Hasil Pemeriksaan Penunjang</div>
    </div>
  </div>
  <div class="divider"></div>

  <!-- meta pasien -->
  <table class="meta" style="margin-bottom:8px">
    <tr>
      <td class="label">No. Rawat</td><td>: <?= html_escape($row['no_rawat']) ?></td>
      <td class="label">Tanggal</td><td>: <?= html_escape($row['tgl_periksa']) ?> <?= html_escape($row['jam_periksa']) ?></td>
    </tr>
    <tr>
      <td class="label">No. RM</td><td>: <?= html_escape($detail_pasien['no_rkm_medis'] ?? '-') ?></td>
      <td class="label">Dokter</td><td>: <?= html_escape($detail_pasien['nm_dokter'] ?? $row['kd_dokter']) ?></td>
    </tr>
    <tr>
      <td class="label">Nama Pasien</td><td>: <?= html_escape($detail_pasien['nm_pasien'] ?? '-') ?></td>
      <td class="label">Poli</td><td>: <?= html_escape($detail_pasien['nm_poli'] ?? '-') ?></td>
    </tr>
  </table>

  <!-- judul di atas, isi di bawah -->
  <div class="section-title">Hasil Pemeriksaan Penunjang</div>
  <div class="content-box">
    <div class="pre"><?= nl2br(html_escape($row['hasil_pemeriksaan'])) ?></div>
  </div>

  <!-- tanda tangan -->
  <div class="footer-ttd">
    <div class="col"></div>
    <div class="col right">
      <div class="jabatan">
        <?= html_escape($setting['kabupaten'] ?? ''); ?>,
        <?= date('d/m/Y', strtotime($row['tgl_periksa'] ?? date('Y-m-d'))) ?><br>
        Dokter Pemeriksa,
      </div>

      <?php
        $sig = $row['signature_base64'] ?? '';
        if ($sig && strpos($sig, 'data:image') !== 0) {
          $sig = 'data:image/png;base64,' . $sig;
        }
      ?>
      <?php if ($sig): ?>
        <img src="<?= $sig ?>" alt="TTD Dokter" class="ttd-img">
      <?php else: ?>
        <div style="height:90px"></div>
      <?php endif; ?>

      <div style="margin-top:2px;font-weight:bold;text-decoration:underline;">
        <?= html_escape($detail_pasien['nm_dokter'] ?? $row['kd_dokter']) ?>
      </div>
    </div>
  </div>

</div>

<script>setTimeout(function(){try{window.print();}catch(e){}},300);</script>
</body>
</html>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Tindakan Ralan - <?= html_escape($row['no_rawat']) ?></title>
  <style>
    *{box-sizing:border-box}
    @page { size: A4; margin: 16mm 14mm 16mm 14mm; }
    body{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000;margin:0;}
    .wrap{max-width:730px;margin:0 auto;}

    /* ===== Header Instansi ===== */
    .head{display:flex;align-items:center;gap:12px;margin-bottom:6px;}
    .head-logo{width:60px;height:60px;object-fit:contain;}
    .head-title{flex:1;text-align:center;line-height:1.25}
    .head-title .instansi{font-weight:bold;font-size:16px;text-transform:uppercase;letter-spacing:.4px}
    .head-title .alamat,.head-title .kontak{font-size:10.5px;color:#333}
    .doc-title{margin-top:4px;font-weight:bold;font-size:13px}
    .divider{border-top:2px solid #000;margin:8px 0 10px;}

    /* ===== Tabel & Meta ===== */
    table{width:100%;border-collapse:collapse}
    .meta td{padding:3px 0;vertical-align:top;font-size:12px}
    .meta .label{width:95px;color:#333}
    .meta td+td{padding-left:6px}

    /* ===== Section & Kotak isi ===== */
    .section{
      margin-top:10px;
    }
    .section .title{
      font-weight:bold;
      font-size:12.5px;
      background:#f0f0f0;
      border:1px solid #bbb;
      border-bottom:none;
      padding:6px 8px;
    }
    .box{
      border:1px solid #bbb;
      padding:8px 9px;
      min-height:70px;              /* << diperkecil */
      background:#fff;
    }
    .grid2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .pre{white-space:pre-wrap;line-height:1.5}

    /* ===== Prosedur ===== */
    .proc .box{min-height:110px}

    /* ===== TTD ===== */
    .footer-ttd{margin-top:22px;width:100%;clear:both;}
    .footer-ttd .col{width:50%;display:inline-block;vertical-align:top;}
    .footer-ttd .col.right{text-align:center;float:right;}
    .jabatan{margin-bottom:6px}
    .ttd-img{width:200px;height:auto;margin:2px 0 0 0;object-fit:contain;}

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
      <div class="doc-title">Laporan Tindakan Rawat Jalan</div>
    </div>
  </div>
  <div class="divider"></div>

  <!-- meta pasien -->
  <table class="meta" style="margin-bottom:6px">
    <tr>
      <td class="label">No. Rawat</td><td>: <?= html_escape($row['no_rawat']) ?></td>
      <td class="label">Waktu</td>
      <td>:
        <?php
          $jm = $row['jam_mulai']   ?? '';
          $js = $row['jam_selesai'] ?? '';
          $waktu = trim(($jm ? $jm : '-') . ($js ? ' s/d ' . $js : ''));
          echo html_escape($waktu);
        ?>
      </td>
    </tr>
    <tr>
      <td class="label">No. RM</td><td>: <?= html_escape($detail_pasien['no_rkm_medis'] ?? '-') ?></td>
      <td class="label">Dokter</td><td>: <?= html_escape($detail_pasien['nm_dokter'] ?? $row['kd_dokter']) ?></td>
    </tr>
    <tr>
      <td class="label">Nama Pasien</td><td>: <?= html_escape($detail_pasien['nm_pasien'] ?? '-') ?></td>
      <td class="label">Poli</td><td>: <?= html_escape($detail_pasien['nm_poli'] ?? '-') ?></td>
    </tr>
    <tr>
      <td class="label">Ruangan</td><td>: <?= html_escape($row['ruangan'] ?? '-') ?></td>
      <td class="label">Anestesi</td><td>: <?= html_escape($row['jenis_anastesi'] ?? '-') ?></td>
    </tr>
  </table>

  <!-- ringkas diagnosa & nama tindakan -->
  <div class="grid2">
    <div class="section">
      <div class="title">Diagnosa</div>
      <div class="box"><div class="pre"><?= nl2br(html_escape($row['diagnosa'] ?? '-')) ?></div></div>
    </div>
    <div class="section">
      <div class="title">Nama Tindakan</div>
      <div class="box"><div class="pre"><?= nl2br(html_escape($row['nama_tindakan'] ?? '-')) ?></div></div>
    </div>
  </div>

  <!-- prosedur -->
  <div class="section proc">
    <div class="title">Prosedur Tindakan</div>
    <div class="box">
      <div class="pre"><?= nl2br(html_escape($row['prosedur_tindakan'] ?? '-')) ?></div>
    </div>
  </div>

  <!-- tanda tangan -->
  <div class="footer-ttd">
    <div class="col"></div>
    <div class="col right">
      <div class="jabatan">
        <?= html_escape($setting['kabupaten'] ?? '') ?>,
        <?= date('d/m/Y') ?><br>
        Dokter Operator,
      </div>

      <?php
        $sig = $row['ttd'] ?? '';
        if ($sig && strpos($sig, 'data:image') !== 0) {
          $sig = 'data:image/png;base64,' . $sig;
        }
      ?>
      <?php if (!empty($sig)): ?>
        <img src="<?= $sig ?>" alt="TTD Dokter" class="ttd-img">
      <?php else: ?>
        <div style="height:80px"></div>
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

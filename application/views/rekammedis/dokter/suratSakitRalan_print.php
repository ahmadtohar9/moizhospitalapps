<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Surat Sakit - <?= html_escape($row['no_surat'] ?? $row['no_rawat']) ?></title>
  <style>
    *{box-sizing:border-box}
    @page { size: A4; margin:16mm 14mm 16mm 14mm; }
    body{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000;margin:0;}
    .wrap{max-width:730px;margin:0 auto;}

    /* ===== Header Instansi ===== */
    .head{display:flex;align-items:center;gap:12px;margin-bottom:6px;}
    .head-logo{width:60px;height:60px;object-fit:contain;}
    .head-title{flex:1;text-align:center;line-height:1.25}
    .head-title .instansi{font-weight:bold;font-size:16px;text-transform:uppercase;letter-spacing:.4px}
    .head-title .alamat,.head-title .kontak{font-size:10.5px;color:#333}
    .divider{border-top:2px solid #000;margin:8px 0 10px;}

    /* ===== Dokumen Title ===== */
    .doc-title{text-align:center;margin-top:4px;font-weight:bold;font-size:13px}
    .doc-no{text-align:center;font-size:12px;margin-bottom:8px}

    /* ===== Tabel ===== */
    table{width:100%;border-collapse:collapse}
    .meta td{padding:3px 0;vertical-align:top;font-size:12px}
    .meta .label{width:120px;color:#333}
    .meta td+td{padding-left:6px}

    /* ===== Isi Surat ===== */
    .isi{margin-top:10px;line-height:1.65}
    .isi .par{margin:8px 0}

    /* ===== Kotak info ===== */
    .box{border:1px solid #bbb;padding:8px 9px;background:#fff;border-radius:4px}
    .pre{white-space:pre-wrap;line-height:1.5}

    /* ===== TTD ===== */
    .footer-ttd{margin-top:28px;width:100%;clear:both;}
    .footer-ttd .col{width:48%;display:inline-block;vertical-align:top;}
    .footer-ttd .col.right{float:right;text-align:center;}
    .footer-ttd .col.left{float:left;text-align:center;}
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
    </div>
  </div>
  <div class="divider"></div>

  <!-- Judul -->
  <div class="doc-title">SURAT KETERANGAN SAKIT</div>
  <div class="doc-no">No : <?= html_escape($row['no_surat'] ?? '-') ?></div>

  <!-- isi surat -->
  <div class="isi">
    <div class="par" style="text-align:justify">
      Yang bertanda tangan di bawah ini, dokter pada <strong><?= html_escape($setting['nama_instansi'] ?? 'Rumah Sakit') ?></strong>,
      menerangkan bahwa:
    </div>

    <div class="box" style="margin:8px 0">
      <table class="meta">
        <tr><td class="label">Nama</td><td>: <?= html_escape($detail_pasien['nm_pasien'] ?? '-') ?></td></tr>
        <tr><td class="label">Jenis Kelamin</td><td>: <?= html_escape($detail_pasien['jk'] ?? '-') ?></td></tr>
        <tr><td class="label">Umur</td><td>: <?= html_escape($detail_pasien['umur'] ?? '-') ?></td></tr>
        <tr><td class="label">No. RM</td><td>: <?= html_escape($detail_pasien['no_rkm_medis'] ?? ($row['no_rkm_medis'] ?? '-')) ?></td></tr>
        <tr><td class="label">No. Telp</td><td>: <?= html_escape($detail_pasien['no_tlp'] ?? '-') ?></td></tr>
        <tr><td class="label">Alamat</td><td>: <?= html_escape($detail_pasien['alamat'] ?? '-') ?></td></tr>
      </table>
    </div>

    <?php
      $tglMulai = $row['tgl_mulai_istirahat'] ?? '';
      $lama     = (int)($row['lama_istirahat_hari'] ?? 0);
      $tglSelesai = $tgl_selesai ?? (
        (!empty($tglMulai) && $lama>0) ? date('Y-m-d', strtotime($tglMulai.' +'.($lama-1).' day')) : $tglMulai
      );
    ?>

    <div class="par" style="text-align:justify">
      Setelah dilakukan pemeriksaan, pasien tersebut di atas <b>perlu beristirahat selama
      <?= $lama ?> (<?= $lama ?>) hari</b>, terhitung mulai tanggal
      <b><?= html_escape($tglMulai ?: '-') ?></b> sampai dengan <b><?= html_escape($tglSelesai ?: '-') ?></b>.
      <br>Adapun keterangan tambahan (bila ada) sebagai berikut:
    </div>

    <div class="box"><div class="pre"><?= nl2br(html_escape($row['keterangan'] ?? '-')) ?></div></div>

    <div class="par" style="text-align:justify">
      Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </div>
  </div>

  <!-- tanda tangan -->
  <div class="footer-ttd">
    <!-- Pasien / Wali -->
    <div class="col left">
      <div class="jabatan">
        Penerima,<br>
        <?= !empty($row['is_signed_by_guardian']) ? 'Wali Pasien' : 'Pasien' ?>
      </div>
      <?php
        $sigPasien = $row['ttd_pasien'] ?? '';
        if ($sigPasien && strpos($sigPasien, 'data:image') !== 0)
          $sigPasien = 'data:image/png;base64,' . $sigPasien;
      ?>
      <?php if (!empty($sigPasien)): ?>
        <img src="<?= $sigPasien ?>" alt="TTD Pasien/Wali" class="ttd-img">
      <?php else: ?>
        <div style="height:80px"></div>
      <?php endif; ?>
      <div style="font-weight:bold;text-decoration:underline;margin-top:2px">
        <?= html_escape(!empty($row['is_signed_by_guardian']) ? ($row['nama_wali'] ?? '-') : ($detail_pasien['nm_pasien'] ?? '-')) ?>
      </div>
      <?php if (!empty($row['is_signed_by_guardian'])): ?>
        <div style="font-size:11px">Hubungan: <?= html_escape($row['hubungan_wali'] ?? '-') ?></div>
      <?php endif; ?>
    </div>

    <!-- Dokter -->
    <div class="col right">
      <div class="jabatan">
        <?= html_escape($setting['kabupaten'] ?? '') ?>,
        <?= !empty($row['tgl_surat']) ? date('d/m/Y', strtotime($row['tgl_surat'])) : date('d/m/Y') ?><br>
        Dokter Pemeriksa,
      </div>
      <?php
        $sigDokter = $row['ttd_dokter'] ?? '';
        if ($sigDokter && strpos($sigDokter, 'data:image') !== 0)
          $sigDokter = 'data:image/png;base64,' . $sigDokter;
      ?>
      <?php if (!empty($sigDokter)): ?>
        <img src="<?= $sigDokter ?>" alt="TTD Dokter" class="ttd-img">
      <?php else: ?>
        <div style="height:80px"></div>
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

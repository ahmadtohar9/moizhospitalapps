<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Resume Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            color: #155724;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>✅ Verifikasi Resume Medis</h2>

    <div class="success">
        QR Code valid. Data resume medis berhasil ditemukan.
    </div>

    <div class="info"><span class="label">No. Rawat:</span> <?= $decoded_no_rawat ?></div>
    <div class="info"><span class="label">No. RM:</span> <?= $resume['no_rkm_medis'] ?></div>
    <div class="info"><span class="label">Nama Pasien:</span> <?= $resume['nm_pasien'] ?></div>
    <div class="info"><span class="label">Tanggal Registrasi:</span> <?= $resume['tgl_registrasi'] ?? '-' ?></div>
    <div class="info"><span class="label">Dokter Pemeriksa:</span> <?= $resume['nm_dokter'] ?? '-' ?></div>

    <div class="info"><span class="label">Diagnosa Utama:</span> <?= $resume['diagnosa_utama'] ?> (<?= $resume['kd_diagnosa_utama'] ?>)</div>

    <div class="footer">
        Verifikasi dilakukan melalui sistem RSIA Andini &mdash; <?= date('d F Y H:i') ?>
    </div>
</div>
</body>
</html>

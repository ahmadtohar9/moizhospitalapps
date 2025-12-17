<!DOCTYPE html>
<html>

<head>
    <title>Cetak Antrian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            width: 80mm;
            font-size: 11px;
            color: #000;
        }

        .container {
            padding: 5px;
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .header h3 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .content {
            text-align: left;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            margin-bottom: 2px;
        }

        .label {
            width: 60px;
            font-weight: bold;
        }

        .val {
            flex: 1;
        }

        .box-antrian {
            border: 2px solid #000;
            padding: 5px;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
        }

        .no-antrian {
            font-size: 32px;
            margin: 5px 0;
            display: block;
        }

        .footer {
            border-top: 1px dashed #000;
            padding-top: 5px;
            font-size: 9px;
            text-align: center;
        }

        @media print {
            @page {
                margin: 0;
                size: 80mm auto;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <div class="header">
            <h3><?= $setting->nama_instansi ?></h3>
            <p><?= $setting->alamat_instansi ?></p>
            <p><?= $setting->kabupaten ?>, <?= $setting->propinsi ?></p>
            <p><?= date('d-m-Y H:i:s') ?></p>
        </div>

        <div class="content">
            <div class="row">
                <span class="label">No. Rawat</span>
                <span class="val">: <?= $reg->no_rawat ?></span>
            </div>
            <div class="row">
                <span class="label">No. RM</span>
                <span class="val">: <?= $reg->no_rkm_medis ?></span>
            </div>
            <div class="row">
                <span class="label">Pasien</span>
                <span class="val">: <?= $reg->nm_pasien ?></span>
            </div>
            <div class="row">
                <span class="label">Dokter</span>
                <span class="val">: <?= $reg->nm_dokter ?></span>
            </div>
            <div class="row">
                <span class="label">Poli</span>
                <span class="val">: <?= $reg->nm_poli ?></span>
            </div>
            <div class="row">
                <span class="label">Bayar</span>
                <span class="val">: <?= $reg->png_jawab ?></span>
            </div>
        </div>

        <div class="box-antrian">
            NOMOR ANTRIAN
            <span class="no-antrian"><?= $reg->no_reg ?></span>
            <?= $reg->nm_poli ?>
        </div>

        <div class="footer">
            Simpan struk ini sebagai bukti pendaftaran.<br>
            Terima Kasih.
        </div>
    </div>

</body>

</html>
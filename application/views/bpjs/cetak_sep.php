<!DOCTYPE html>
<html>

<head>
    <title>Cetak SEP</title>
    <style>
        @page {
            size: A5 landscape;
            margin: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 10px;
        }

        .header {
            position: relative;
            width: 100%;
            height: 60px;
            margin-bottom: 20px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 5px;
            height: 50px;
            width: auto;
        }

        .header-title {
            width: 100%;
            text-align: center;
            padding-top: 5px;
        }

        .title-main {
            font-size: 18px;
            font-weight: bold;
            display: block;
        }

        .header-rs {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
            display: block;
        }

        .content {
            width: 100%;
            display: flex;
        }

        .col-left,
        .col-right {
            width: 50%;
            vertical-align: top;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px;
            vertical-align: top;
        }

        .label {
            width: 100px;
            font-weight: normal;
        }

        .separator {
            width: 10px;
            text-align: center;
        }

        .barcode-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            font-style: italic;
            font-size: 9px;
            position: relative;
        }

        .qr-code {
            position: absolute;
            bottom: 0px;
            right: 0px;
            text-align: center;
        }

        .qr-code img {
            width: 70px;
            height: 70px;
        }

        .qr-name {
            font-size: 10px;
            font-weight: bold;
            margin-top: 2px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="header">
        <!-- Logo -->
        <img src="<?= $logo_bpjs ?>" alt="BPJS Kesehatan">
        <div class="header-title">
            <span class="title-main">SURAT ELEGIBILITAS PESERTA</span>
            <span class="header-rs"><?= $rs_name ?></span>
        </div>
    </div>

    <div class="content">
        <div class="col-left">
            <table>
                <tr>
                    <td class="label">No. SEP</td>
                    <td class="separator">:</td>
                    <td><?= $sep->no_sep ?></td>
                </tr>
                <tr>
                    <td class="label">Tgl. SEP</td>
                    <td class="separator">:</td>
                    <td><?= date('d/m/Y', strtotime($sep->tglsep)) ?></td>
                </tr>
                <tr>
                    <td class="label">No. Kartu</td>
                    <td class="separator">:</td>
                    <td><?= $sep->no_kartu ?> ( MR : <?= $sep->nomr ?> )</td>
                </tr>
                <tr>
                    <td class="label">Nama Peserta</td>
                    <td class="separator">:</td>
                    <td><?= $sep->nama_pasien ?></td>
                </tr>
                <tr>
                    <td class="label">Tgl. Lahir</td>
                    <td class="separator">:</td>
                    <td><?= date('d/m/Y', strtotime($sep->tanggal_lahir)) ?> (Kelamin:
                        <?= $sep->jkel == 'L' ? 'Laki-Laki' : 'Perempuan' ?>)
                    </td>
                </tr>
                <tr>
                    <td class="label">No. Telepon</td>
                    <td class="separator">:</td>
                    <td><?= $sep->notelep ?></td>
                </tr>
                <tr>
                    <td class="label">Sub/Spesialis</td>
                    <td class="separator">:</td>
                    <td><?= $sep->nmpolitujuan ?></td>
                </tr>
                <tr>
                    <td class="label">Dokter</td>
                    <td class="separator">:</td>
                    <td><?= $sep->nmdpdjp ?></td>
                </tr>
                <tr>
                    <td class="label">Faskes Perujuk</td>
                    <td class="separator">:</td>
                    <td><?= $sep->nmppkrujukan ?: '-' ?></td>
                </tr>
                <tr>
                    <td class="label">Diagnosa Awal</td>
                    <td class="separator">:</td>
                    <td><?= $sep->nmdiagnosaawal ?> (<?= $sep->diagawal ?>)</td>
                </tr>
                <tr>
                    <td class="label">Catatan</td>
                    <td class="separator">:</td>
                    <td><?= $sep->catatan ?></td>
                </tr>
            </table>
        </div>
        <div class="col-right">
            <!-- Barcode (Placeholder with Font or simple text if no library) -->
            <!-- Using Google Fonts Libre Barcode 128 for simplicity if online, else just text -->
            <div class="barcode-container">
                <!-- For offline, usually we use a library to gen image. 
                      Since user didn't ask for barcode image explicitly in prompt but image shows it, 
                      I will use a simple CSS trick or Text if no lib. 
                      But wait, I have tcpdf examples but no easy bar generator. 
                      I will omit Barcode image for now or use a placeholder text "IIIIIIII" style to simulate layout 
                      unless I can use an external URL. 
                      Safest: Google Chart API (if internet allowed) -->
                <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $sep->no_sep ?>&code=Code128&dpi=96&dataseparator="
                    alt="Barcode" style="height: 40px;">
            </div>

            <table>
                <tr>
                    <td class="label">Peserta</td>
                    <td class="separator">:</td>
                    <td><?= $sep->peserta ?></td>
                </tr>
                <tr>
                    <td class="label">Jns. Rawat</td>
                    <td class="separator">:</td>
                    <td><?= $sep->jnspelayanan == '1' ? 'Rawat Inap' : 'Rawat Jalan' ?></td>
                </tr>
                <tr>
                    <td class="label">Jns. Kunjungan</td>
                    <td class="separator">:</td>
                    <td>- Konsultasi dokter(pertama)</td>
                </tr>
                <tr>
                    <td class="label">Poli Perujuk</td>
                    <td class="separator">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td class="label">Kls. Hak</td>
                    <td class="separator">:</td>
                    <td>Kelas <?= $sep->klsrawat ?></td>
                </tr>
                <tr>
                    <td class="label">Kls. Rawat</td>
                    <td class="separator">:</td>
                    <td>Kelas <?= $sep->klsrawat ?></td>
                </tr>
                <tr>
                    <td class="label">Penjamin</td>
                    <td class="separator">:</td>
                    <td>BPJS Kesehatan</td>
                </tr>
            </table>

            <div class="footer">
                <div style="width: 70%;">
                    *Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.<br>
                    *SEP bukan sebagai bukti penjaminan peserta<br>
                    Cetakan ke 1 <?= date('d/m/Y H:i:s A') ?>
                </div>
                <div class="qr-code">
                    Pasien/Keluarga Pasien<br>
                    <img src="<?= $qr_url ?>" alt="QR Code"><br>
                    <div class="qr-name"><?= $sep->nama_pasien ?></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
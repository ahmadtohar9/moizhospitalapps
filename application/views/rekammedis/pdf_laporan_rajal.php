<page>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        h4 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 9pt; }
        th { background-color: #eee; }
    </style>

    <h4>
        LAPORAN PASIEN RAWAT JALAN<br>
        Periode: <?= date('d-m-Y', strtotime($start_date)) ?> s/d <?= date('d-m-Y', strtotime($end_date)) ?>
    </h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Rawat</th>
                <th>No. RM</th>
                <th>Nama Pasien</th>
                <th>Tanggal</th>
                <th>Dokter</th>
                <th>Status</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data_laporan)) : ?>
                <?php foreach ($data_laporan as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $row->no_rawat ?></td>
                        <td><?= $row->no_rkm_medis ?></td>
                        <td><?= $row->nm_pasien ?></td>
                        <td><?= $row->tgl_registrasi ?></td>
                        <td><?= $row->nm_dokter ?></td>
                        <td><?= $row->stts ?></td>
                        <td><?= $row->no_tlp ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" align="center">Tidak ada data ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</page>

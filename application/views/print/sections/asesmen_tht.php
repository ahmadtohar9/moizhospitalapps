<?php if (!empty($d->tht)): ?>
<div class="print-section">
    <h3 style="background-color: #e3f2fd; padding: 8px; margin: 15px 0 10px 0; border-left: 4px solid #2196F3;">
        📋 ASESMEN MEDIS THT
    </h3>
    
    <table style="width: 100%; margin-bottom: 15px;">
        <tr>
            <td style="width: 25%; font-weight: bold;">Tanggal Pemeriksaan</td>
            <td>: <?= $d->tht->tanggal ?? '-' ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Dokter Pemeriksa</td>
            <td>: <?= $d->tht->nm_dokter ?? '-' ?></td>
        </tr>
    </table>
    
    <?php if (!empty($d->tht->anamnesis)): ?>
    <div style="margin: 10px 0;">
        <strong>Anamnesis:</strong><br>
        <?= nl2br($d->tht->anamnesis) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($d->tht->pemeriksaan_fisik)): ?>
    <div style="margin: 10px 0;">
        <strong>Pemeriksaan Fisik:</strong><br>
        <?= nl2br($d->tht->pemeriksaan_fisik) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($d->tht->pemeriksaan_penunjang)): ?>
    <div style="margin: 10px 0;">
        <strong>Pemeriksaan Penunjang:</strong><br>
        <?= nl2br($d->tht->pemeriksaan_penunjang) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($d->tht->diagnosis)): ?>
    <div style="margin: 10px 0;">
        <strong>Diagnosis:</strong><br>
        <?= nl2br($d->tht->diagnosis) ?>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($d->tht->tatalaksana)): ?>
    <div style="margin: 10px 0;">
        <strong>Tatalaksana:</strong><br>
        <?= nl2br($d->tht->tatalaksana) ?>
    </div>
    <?php endif; ?>
    
    <?php
    // Display lokalis image if exists
    $clean_no_rawat = str_replace('/', '', $d->no_rawat);
    $lokalis_path = FCPATH . 'assets/images/lokalis_tht/lokalis_' . $clean_no_rawat . '.png';
    if (file_exists($lokalis_path)):
    ?>
    <div style="margin: 15px 0;">
        <strong>Gambar Lokalis:</strong><br>
        <img src="<?= base_url('assets/images/lokalis_tht/lokalis_' . $clean_no_rawat . '.png') ?>" 
             style="max-width: 400px; height: auto; border: 1px solid #ddd; margin-top: 10px;">
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

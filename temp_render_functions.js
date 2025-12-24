// TEMPORARY FILE - 4 NEW RENDER FUNCTIONS FOR ANAK, BEDAH, THT, JANTUNG

// === RENDER PENILAIAN MEDIS ANAK ===
function renderPenilaianAnak() {
    const data = anak.data || anak || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = `<div style="font-size:13px; line-height:1.6;">
                        <div style="margin-bottom:12px;"><b>Keluhan Utama:</b> ${escHtml(data.keluhan_utama || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Diagnosis:</b> ${escHtml(data.diagnosis || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Tatalaksana:</b> ${escHtml(data.tata || '-')}</div>
                        ${data.nm_dokter ? `<div style="margin-top:10px; padding-top:8px; border-top:1px dashed #ddd; font-size:12px;"><i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b></div>` : ''}
                    </div>`;
        cardsToShow.push(cardWrap('anak', 'Asesmen Awal Medis Anak (Pediatri)', html));
    }
}

// === RENDER PENILAIAN MEDIS BEDAH ===
function renderPenilaianBedah() {
    const data = bedah.data || bedah || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = `<div style="font-size:13px; line-height:1.6;">
                        <div style="margin-bottom:12px;"><b>Keluhan Utama:</b> ${escHtml(data.keluhan_utama || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Diagnosis:</b> ${escHtml(data.diagnosis || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Tatalaksana:</b> ${escHtml(data.tata || '-')}</div>
                        ${data.nm_dokter ? `<div style="margin-top:10px; padding-top:8px; border-top:1px dashed #ddd; font-size:12px;"><i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b></div>` : ''}
                    </div>`;
        cardsToShow.push(cardWrap('bedah', 'Asesmen Awal Medis Bedah', html));
    }
}

// === RENDER PENILAIAN MEDIS THT ===
function renderPenilaianTHT() {
    const data = tht.data || tht || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = `<div style="font-size:13px; line-height:1.6;">
                        <div style="margin-bottom:12px;"><b>Keluhan Utama:</b> ${escHtml(data.keluhan_utama || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Diagnosis:</b> ${escHtml(data.diagnosis || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Tatalaksana:</b> ${escHtml(data.tata || '-')}</div>
                        ${data.nm_dokter ? `<div style="margin-top:10px; padding-top:8px; border-top:1px dashed #ddd; font-size:12px;"><i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b></div>` : ''}
                    </div>`;
        cardsToShow.push(cardWrap('tht', 'Asesmen Awal Medis THT (Otolaringologi)', html));
    }
}

// === RENDER PENILAIAN MEDIS JANTUNG ===
function renderPenilaianJantung() {
    const data = jantung.data || jantung || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = `<div style="font-size:13px; line-height:1.6;">
                        <div style="margin-bottom:12px;"><b>Keluhan Utama:</b> ${escHtml(data.keluhan_utama || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Diagnosis:</b> ${escHtml(data.diagnosis || '-')}</div>
                        <div style="margin-bottom:12px;"><b>Tatalaksana:</b> ${escHtml(data.tata || '-')}</div>
                        ${data.nm_dokter ? `<div style="margin-top:10px; padding-top:8px; border-top:1px dashed #ddd; font-size:12px;"><i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b></div>` : ''}
                    </div>`;
        cardsToShow.push(cardWrap('jantung', 'Asesmen Awal Medis Jantung (Kardiologi)', html));
    }
}

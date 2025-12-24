// ENHANCED RENDER FUNCTIONS - COPY PASTE MANUAL
// Replace lines 2429-2483 in riwayatPasien.js

// === RENDER PENILAIAN MEDIS ANAK ===
function renderPenilaianAnak() {
    const data = anak.data || anak || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';

        // ANAMNESIS
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-history"></i> Anamnesis
                        </h5>
                        <table style="width:100%; font-size:13px; border-collapse:collapse;">
                            ${row('Keluhan Utama', data.keluhan_utama)}
                            ${row('RPS', data.rps)}
                            ${row('RPD', data.rpd)}
                            ${row('RPK', data.rpk)}
                            ${row('Alergi', data.alergi)}
                        </table>
                    </div>`;

        // TTV
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-heartbeat"></i> Tanda Vital
                        </h5>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">
                            ${ttvBox('TD', data.td, 'mmHg')}
                            ${ttvBox('Nadi', data.nadi, 'x/m')}
                            ${ttvBox('Suhu', data.suhu, '°C')}
                            ${ttvBox('RR', data.rr, 'x/m')}
                            ${ttvBox('BB', data.bb, 'Kg')}
                            ${ttvBox('TB', data.tb, 'Cm')}
                        </div>
                    </div>`;

        // LOKALIS IMAGE
        if (data.lokalis_url) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-image"></i> Status Lokalis
                            </h5>
                            <div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">
                                </a>
                                ${data.ket_lokalis ? `<div style="margin-top:8px; font-size:12px; color:#525f7f;">${escHtml(data.ket_lokalis)}</div>` : ''}
                            </div>
                        </div>`;
        }

        // DIAGNOSIS
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f44336; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f44336; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-stethoscope"></i> Diagnosis & Tatalaksana
                        </h5>
                        <div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px; margin-bottom:8px;">
                            <div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>
                            <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                        </div>
                        <div style="background:#f6f9fc; border-left:4px solid #ff9800; padding:12px; border-radius:4px;">
                            <div style="font-size:11px; color:#ff9800; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana</div>
                            <div style="font-size:13px; color:#525f7f;">${escHtml(data.tata || '-')}</div>
                        </div>
                    </div>`;

        html += `<div style="margin-top:15px; padding-top:10px; border-top:1px dashed #e9ecef; font-size:12px; color:#525f7f;">
                        <i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter || '-')}</b>
                        <span style="color:#8898aa; margin:0 5px;">•</span>
                        <i class="fa fa-clock-o"></i> ${escHtml(data.tanggal || '-')}
                    </div>`;

        cardsToShow.push(cardWrap('anak', 'Asesmen Awal Medis Anak (Pediatri)', html));
    }
}

// === RENDER PENILAIAN MEDIS BEDAH ===
function renderPenilaianBedah() {
    const data = bedah.data || bedah || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-history"></i> Anamnesis
                        </h5>
                        <table style="width:100%; font-size:13px; border-collapse:collapse;">
                            ${row('Keluhan Utama', data.keluhan_utama)}
                            ${row('RPS', data.rps)}
                            ${row('RPD', data.rpd)}
                            ${row('Alergi', data.alergi)}
                        </table>
                    </div>`;
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-heartbeat"></i> Tanda Vital
                        </h5>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px;">
                            ${ttvBox('TD', data.td, 'mmHg')}
                            ${ttvBox('Nadi', data.nadi, 'x/m')}
                            ${ttvBox('Suhu', data.suhu, '°C')}
                            ${ttvBox('RR', data.rr, 'x/m')}
                        </div>
                    </div>`;
        if (data.lokalis_url) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-image"></i> Status Lokalis
                            </h5>
                            <div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">
                                </a>
                            </div>
                        </div>`;
        }
        html += `<div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px; margin-bottom:8px;">
                        <div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>
                        <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                    </div>`;
        cardsToShow.push(cardWrap('bedah', 'Asesmen Awal Medis Bedah', html));
    }
}

// === RENDER PENILAIAN MEDIS THT ===
function renderPenilaianTHT() {
    const data = tht.data || tht || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-history"></i> Anamnesis
                        </h5>
                        <table style="width:100%; font-size:13px; border-collapse:collapse;">
                            ${row('Keluhan Utama', data.keluhan_utama)}
                            ${row('RPS', data.rps)}
                            ${row('Alergi', data.alergi)}
                        </table>
                    </div>`;
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-heartbeat"></i> Tanda Vital
                        </h5>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px;">
                            ${ttvBox('TD', data.td, 'mmHg')}
                            ${ttvBox('Nadi', data.nadi, 'x/m')}
                            ${ttvBox('Suhu', data.suhu, '°C')}
                        </div>
                    </div>`;
        if (data.lokalis_url) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-image"></i> Status Lokalis
                            </h5>
                            <div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">
                                </a>
                            </div>
                        </div>`;
        }
        html += `<div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px;">
                        <div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>
                        <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                    </div>`;
        cardsToShow.push(cardWrap('tht', 'Asesmen Awal Medis THT (Otolaringologi)', html));
    }
}

// === RENDER PENILAIAN MEDIS JANTUNG ===
function renderPenilaianJantung() {
    const data = jantung.data || jantung || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-history"></i> Anamnesis
                        </h5>
                        <table style="width:100%; font-size:13px; border-collapse:collapse;">
                            ${row('Keluhan Utama', data.keluhan_utama)}
                            ${row('RPS', data.rps)}
                            ${row('Alergi', data.alergi)}
                        </table>
                    </div>`;
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-heartbeat"></i> Tanda Vital
                        </h5>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px;">
                            ${ttvBox('TD', data.td, 'mmHg')}
                            ${ttvBox('Nadi', data.nadi, 'x/m')}
                            ${ttvBox('Suhu', data.suhu, '°C')}
                        </div>
                    </div>`;
        if (data.lokalis_url) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-image"></i> Status Lokalis
                            </h5>
                            <div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">
                                </a>
                            </div>
                        </div>`;
        }
        html += `<div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px;">
                        <div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>
                        <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                    </div>`;
        cardsToShow.push(cardWrap('jantung', 'Asesmen Awal Medis Jantung (Kardiologi)', html));
    }
}

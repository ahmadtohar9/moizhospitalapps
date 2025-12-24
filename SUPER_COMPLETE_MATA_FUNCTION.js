// ============================================
// SUPER COMPLETE renderPenilaianMata() 
// Copy paste ini untuk replace function renderPenilaianMata() di riwayatPasien.js
// Line 2183 - 2311
// ============================================

// === RENDER PENILAIAN MEDIS MATA (SUPER COMPLETE) ===
function renderPenilaianMata() {
    const data = mata.data || mata || {};

    // DEBUG: Check if gambar URLs exist
    console.log('🔍 DEBUG Mata Data:', data);
    console.log('📸 Gambar OD URL:', data.gambar_od_url);
    console.log('📸 Gambar OS URL:', data.gambar_os_url);

    if (hasKeys(data, ['keluhan_utama', 'diagnosis', 'visuskanan', 'visuskiri'])) {
        let html = '';

        // I. RIWAYAT KESEHATAN / ANAMNESIS
        html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-history"></i> I. Riwayat Kesehatan
                            </h5>
                            <table style="width:100%; font-size:13px; border-collapse:collapse;">
                                ${row('Anamnesis', data.anamnesis + (data.hubungan ? ' (' + data.hubungan + ')' : ''))}
                                ${row('Keluhan Utama', data.keluhan_utama)}
                                ${row('Riw. Penyakit Sekarang', data.rps)}
                                ${row('Riw. Penyakit Dahulu', data.rpd)}
                                ${row('Riw. Penggunaan Obat', data.rpo)}
                                ${row('Riwayat Alergi', data.alergi)}
                            </table>
                        </div>`;

        // II. PEMERIKSAAN FISIK & VITAL
        html += `<div style="margin-bottom:20px;">
                             <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-heartbeat"></i> II. Pemeriksaan Fisik
                            </h5>
                            ${data.status ? `<div style="margin-bottom:8px;"><b>Status:</b> ${escHtml(data.status)}</div>` : ''}
                            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">
                                ${ttvBox('TD', data.td, 'mmHg')}
                                ${ttvBox('Nadi', data.nadi, 'x/m')}
                                ${ttvBox('Suhu', data.suhu, '°C')}
                                ${ttvBox('RR', data.rr, 'x/m')}
                                ${ttvBox('BB', data.bb, 'Kg')}
                                ${ttvBox('Nyeri', data.nyeri)}
                            </div>
                        </div>`;


        // III. STATUS OFTALMOLOGIS (dengan gambar di atas)
        html += `<div style="margin-bottom:20px;">
                             <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-eye"></i> III. Status Oftalmologis
                            </h5>`;

        // Gambar OD dan OS side by side
        if (data.gambar_od_url || data.gambar_os_url) {
            html += `<div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:16px;">`;

            if (data.gambar_od_url) {
                html += `<div style="background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:8px; box-shadow:0 2px 4px rgba(0,0,0,.1);">
                                <div style="font-weight:600; color:#3c8dbc; margin-bottom:6px; text-align:center; font-size:11px;">OD : Mata Kanan</div>
                                <a href="${data.gambar_od_url}?t=${new Date().getTime()}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="${data.gambar_od_url}?t=${new Date().getTime()}" style="width:100%; height:auto; display:block; border-radius:4px;" alt="OD">
                                </a>
                            </div>`;
            }

            if (data.gambar_os_url) {
                html += `<div style="background:#fff; border:2px solid #00a65a; border-radius:8px; padding:8px; box-shadow:0 2px 4px rgba(0,0,0,.1);">
                                <div style="font-weight:600; color:#00a65a; margin-bottom:6px; text-align:center; font-size:11px;">OS : Mata Kiri</div>
                                <a href="${data.gambar_os_url}?t=${new Date().getTime()}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="${data.gambar_os_url}?t=${new Date().getTime()}" style="width:100%; height:auto; display:block; border-radius:4px;" alt="OS">
                                </a>
                            </div>`;
            }

            html += `</div>`;
        }

        // Tabel Status Oftalmologis (LENGKAP dengan semua field)
        html += `<table style="width:100%; font-size:11px; border-collapse:collapse; border:1px solid #e5e7eb;">
                                <thead>
                                    <tr style="background:#f3f4f6;">
                                        <th style="border:1px solid #e5e7eb; padding:6px; text-align:left;">Pemeriksaan</th>
                                        <th style="border:1px solid #e5e7eb; padding:6px; text-align:center; color:#3c8dbc;">OD (Kanan)</th>
                                        <th style="border:1px solid #e5e7eb; padding:6px; text-align:center; color:#00a65a;">OS (Kiri)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Visus SC</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.visuskanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.visuskiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">CC</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.cckanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.cckiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Palpebra</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.palkanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.palkiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Conjungtiva</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.conkanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.conkiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Cornea</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.corneakanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.corneakiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">COA</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.coakanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.coakiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Pupil</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.pupilkanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.pupilkiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Lensa</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.lensakanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.lensakiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Fundus Media</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.funduskanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.funduskiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Papil</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.papilkanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.papilkiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Retina</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.retinakanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.retinakiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">Makula</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.makulakanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.makulakiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">TIO</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.tiokanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.tiokiri || '-')}</td></tr>
                                    <tr><td style="border:1px solid #e5e7eb; padding:4px; font-weight:600;">MBO</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.mbokanan || '-')}</td><td style="border:1px solid #e5e7eb; padding:4px; text-align:center;">${escHtml(data.mbokiri || '-')}</td></tr>
                                </tbody>
                            </table>
                        </div>`;

        // IV. PEMERIKSAAN PENUNJANG
        if (data.lab || data.rad || data.penunjang || data.tes || data.pemeriksaan) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#6366f1; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #6366f1; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-flask"></i> IV. Pemeriksaan Penunjang
                            </h5>
                            <table style="width:100%; font-size:13px; border-collapse:collapse;">
                                ${data.lab ? row('Laboratorium', data.lab) : ''}
                                ${data.rad ? row('Radiologi', data.rad) : ''}
                                ${data.penunjang ? row('Penunjang Lainnya', data.penunjang) : ''}
                                ${data.tes ? row('Tes Penglihatan', data.tes) : ''}
                                ${data.pemeriksaan ? row('Pemeriksaan Lain', data.pemeriksaan) : ''}
                            </table>
                        </div>`;
        }

        // V. DIAGNOSIS & TATALAKSANA
        html += `<div>
                            <h5 style="font-size:12px; font-weight:700; color:#f5365c; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f5365c; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-stethoscope"></i> V. Diagnosis & Tatalaksana
                            </h5>
                            
                            <div style="background:#fff5f5; border-left:4px solid #f5365c; padding:12px; border-radius:4px; margin-bottom:12px;">
                                <div style="font-size:11px; color:#f5365c; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Asesmen Kerja</div>
                                <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                                ${data.diagnosisbdg ? `<hr style="border-top:1px dashed #fcd34d; margin:8px 0;"><div style="font-size:11px; color:#888;"><b>Asesmen Banding:</b> ${escHtml(data.diagnosisbdg)}</div>` : ''}
                                ${data.permasalahan ? `<hr style="border-top:1px dashed #fcd34d; margin:8px 0;"><div style="font-size:11px; color:#888;"><b>Permasalahan:</b> ${escHtml(data.permasalahan)}</div>` : ''}
                            </div>

                            <div style="background:#f6f9fc; border-left:4px solid #f59e0b; padding:12px; border-radius:4px;">
                                <div style="font-size:11px; color:#f59e0b; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana</div>
                                <ul style="margin:0; padding-left:16px; font-size:13px; color:#525f7f; line-height:1.6;">
                                    ${data.terapi ? `<li><b>Terapi/Pengobatan:</b> ${escHtml(data.terapi)}</li>` : ''}
                                    ${data.tindakan ? `<li><b>Tindakan:</b> ${escHtml(data.tindakan)}</li>` : ''}
                                    ${data.edukasi ? `<li><b>Edukasi:</b> ${escHtml(data.edukasi)}</li>` : ''}
                                </ul>
                            </div>
                        </div>`;

        // Meta Footer
        html += `<div style="margin-top:20px; padding-top:10px; border-top:1px dashed #e9ecef; display:flex; justify-content:space-between; align-items:center;">
                        <div style="font-size:12px; color:#525f7f;">
                            <i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b>
                            <span style="color:#8898aa; margin:0 5px;">•</span>
                            <i class="fa fa-clock-o"></i> ${escHtml(data.tanggal)}
                        </div>
                    </div>`;

        cardsToShow.push(cardWrap('mata', 'Penilaian Medis Mata (Oftalmologi)', html));
    }
}

// ============================================
// SUPER COMPLETE renderPenilaianAnak() 
// Copy paste ini untuk replace function renderPenilaianAnak() di riwayatPasien.js
// ============================================

// === RENDER PENILAIAN MEDIS ANAK (SUPER COMPLETE) ===
function renderPenilaianAnak() {
    const data = anak.data || anak || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';

        // I. ANAMNESIS
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-history"></i> I. Anamnesis (${escHtml(data.anamnesis || '-')})
                        </h5>
                        ${data.anamnesis === 'Alloanamnesis' && data.hubungan ? `<div style="margin-bottom:8px;"><b>Hubungan:</b> ${escHtml(data.hubungan)}</div>` : ''}
                        <table style="width:100%; font-size:13px; border-collapse:collapse;">
                            ${row('Keluhan Utama', data.keluhan_utama)}
                            ${row('Riw. Penyakit Sekarang', data.rps)}
                            ${row('Riw. Penyakit Dahulu', data.rpd)}
                            ${row('Riw. Penyakit Keluarga', data.rpk)}
                            ${row('Riw. Penggunaan Obat', data.rpo)}
                            ${row('Riwayat Alergi', data.alergi)}
                        </table>
                    </div>`;

        // II. PEMERIKSAAN FISIK
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-heartbeat"></i> II. Pemeriksaan Fisik
                        </h5>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap:8px; margin-bottom:12px; font-size:12px;">
                            <div><b>Keadaan Umum:</b> ${escHtml(data.keadaan || '-')}</div>
                            <div><b>Kesadaran:</b> ${escHtml(data.kesadaran || '-')}</div>
                            <div><b>GCS:</b> ${escHtml(data.gcs || '-')}</div>
                            <div><b>SpO₂:</b> ${escHtml(data.spo || '-')}%</div>
                        </div>
                        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">
                            ${ttvBox('TD', data.td, 'mmHg')}
                            ${ttvBox('Nadi', data.nadi, 'x/m')}
                            ${ttvBox('Suhu', data.suhu, '°C')}
                            ${ttvBox('RR', data.rr, 'x/m')}
                            ${ttvBox('BB', data.bb, 'Kg')}
                            ${ttvBox('TB', data.tb, 'Cm')}
                        </div>
                    </div>`;

        // PEMERIKSAAN SISTEMIK
        if (data.kepala || data.mata || data.gigi || data.tht || data.thoraks || data.abdomen || data.genital || data.ekstremitas || data.kulit) {
            html += `<div style="margin-bottom:20px; border:1px solid #e5e7eb; border-radius:8px; padding:12px; background:#f9fafb;">
                            <div style="font-size:12px; font-weight:700; margin-bottom:10px; color:#6366f1;">
                                <i class="fa fa-user-md"></i> Pemeriksaan Sistemik
                            </div>
                            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:12px; font-size:12px;">
                                <div>
                                    ${data.kepala ? `<div style="margin-bottom:6px;"><b>Kepala:</b> ${escHtml(data.kepala)}</div>` : ''}
                                    ${data.mata ? `<div style="margin-bottom:6px;"><b>Mata:</b> ${escHtml(data.mata)}</div>` : ''}
                                    ${data.gigi ? `<div style="margin-bottom:6px;"><b>Gigi & Mulut:</b> ${escHtml(data.gigi)}</div>` : ''}
                                </div>
                                <div>
                                    ${data.tht ? `<div style="margin-bottom:6px;"><b>THT:</b> ${escHtml(data.tht)}</div>` : ''}
                                    ${data.thoraks ? `<div style="margin-bottom:6px;"><b>Thoraks:</b> ${escHtml(data.thoraks)}</div>` : ''}
                                    ${data.abdomen ? `<div style="margin-bottom:6px;"><b>Abdomen:</b> ${escHtml(data.abdomen)}</div>` : ''}
                                </div>
                                <div>
                                    ${data.genital ? `<div style="margin-bottom:6px;"><b>Genital:</b> ${escHtml(data.genital)}</div>` : ''}
                                    ${data.ekstremitas ? `<div style="margin-bottom:6px;"><b>Ekstremitas:</b> ${escHtml(data.ekstremitas)}</div>` : ''}
                                    ${data.kulit ? `<div style="margin-bottom:6px;"><b>Kulit:</b> ${escHtml(data.kulit)}</div>` : ''}
                                </div>
                            </div>
                            ${data.ket_fisik ? `<div style="margin-top:10px; padding-top:10px; border-top:1px dashed #e5e7eb;"><b>Keterangan:</b><br>${escHtml(data.ket_fisik)}</div>` : ''}
                        </div>`;
        }

        // III. STATUS LOKALIS (GAMBAR)
        if (data.lokalis_url) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-image"></i> III. Status Lokalis
                            </h5>
                            <div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">
                                </a>
                                ${data.ket_lokalis ? `<div style="margin-top:8px; font-size:12px; color:#525f7f;"><b>Keterangan:</b> ${escHtml(data.ket_lokalis)}</div>` : ''}
                            </div>
                        </div>`;
        }

        // IV. PEMERIKSAAN PENUNJANG
        if (data.penunjang) {
            html += `<div style="margin-bottom:20px;">
                            <h5 style="font-size:12px; font-weight:700; color:#6366f1; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #6366f1; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-flask"></i> IV. Pemeriksaan Penunjang
                            </h5>
                            <div style="font-size:13px; color:#525f7f; line-height:1.6;">${escHtml(data.penunjang)}</div>
                        </div>`;
        }

        // V. DIAGNOSIS & TATALAKSANA
        html += `<div style="margin-bottom:20px;">
                        <h5 style="font-size:12px; font-weight:700; color:#f44336; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f44336; display:inline-block; padding-bottom:4px;">
                            <i class="fa fa-stethoscope"></i> V. Diagnosis & Tatalaksana
                        </h5>
                        <div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px; margin-bottom:8px;">
                            <div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>
                            <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                        </div>
                        <div style="background:#f6f9fc; border-left:4px solid #ff9800; padding:12px; border-radius:4px; margin-bottom:8px;">
                            <div style="font-size:11px; color:#ff9800; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana</div>
                            <div style="font-size:13px; color:#525f7f;">${escHtml(data.tata || '-')}</div>
                        </div>
                        ${data.konsul ? `<div style="background:#f6f9fc; border-left:4px solid #2196f3; padding:12px; border-radius:4px;">
                            <div style="font-size:11px; color:#2196f3; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Konsultasi/Rujukan</div>
                            <div style="font-size:13px; color:#525f7f;">${escHtml(data.konsul)}</div>
                        </div>` : ''}
                    </div>`;

        html += `<div style="margin-top:15px; padding-top:10px; border-top:1px dashed #e9ecef; font-size:12px; color:#525f7f;">
                        <i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter || '-')}</b>
                        <span style="color:#8898aa; margin:0 5px;">•</span>
                        <i class="fa fa-clock-o"></i> ${escHtml(data.tanggal || '-')}
                    </div>`;

        cardsToShow.push(cardWrap('anak', 'Asesmen Awal Medis Anak (Pediatri)', html));
    }
}

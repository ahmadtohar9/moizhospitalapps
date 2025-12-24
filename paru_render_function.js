
// === RENDER PENILAIAN MEDIS PARU ===
function renderPenilaianParu() {
    const data = paru.data || paru || {};
    if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
        let html = '';

        // I. ANAMNESIS
        html += '<div style="margin-bottom:20px;">';
        html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#f59e0b !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">';
        html += '<i class="fa fa-history"></i> I. Anamnesis (' + escHtml(data.anamnesis || '-') + ')';
        html += '</h5>';
        if (data.anamnesis === 'Alloanamnesis' && data.hubungan) {
            html += '<div style="margin-bottom:8px;"><b>Hubungan:</b> ' + escHtml(data.hubungan) + '</div>';
        }
        html += '<table style="width:100%; font-size:13px; border-collapse:collapse;">';
        html += row('Keluhan Utama', data.keluhan_utama);
        html += row('Riw. Penyakit Sekarang', data.rps);
        html += row('Riw. Penyakit Dahulu', data.rpd);
        html += row('Riw. Penggunaan Obat', data.rpo);
        html += row('Riwayat Alergi', data.alergi);
        html += '</table></div>';

        // II. PEMERIKSAAN FISIK
        html += '<div style="margin-bottom:20px;">';
        html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#2dce89 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">';
        html += '<i class="fa fa-heartbeat"></i> II. Pemeriksaan Fisik</h5>';
        html += '<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap:8px; margin-bottom:12px; font-size:12px;">';
        html += '<div><b>Kesadaran:</b> ' + escHtml(data.kesadaran || '-') + '</div>';
        html += '<div><b>GCS:</b> ' + escHtml(data.gcs || '-') + '</div>';
        if (data.status) html += '<div><b>Status:</b> ' + escHtml(data.status) + '</div>';
        html += '</div>';
        html += '<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">';
        html += ttvBox('TD', data.td, 'mmHg');
        html += ttvBox('Nadi', data.nadi, 'x/m');
        html += ttvBox('RR', data.rr, 'x/m');
        html += ttvBox('Suhu', data.suhu, '°C');
        html += ttvBox('BB', data.bb, 'Kg');
        html += ttvBox('Nyeri', data.nyeri);
        html += '</div></div>';

        // PEMERIKSAAN SISTEMIK
        if (data.kepala || data.thoraks || data.abdomen || data.muskulos || data.lainnya) {
            html += '<div style="margin-bottom:20px; border:1px solid #e5e7eb; border-radius:8px; padding:12px; background:#f9fafb;">';
            html += '<div style="font-size:12px; font-weight:700; margin-bottom:10px; color:#6366f1;"><i class="fa fa-user-md"></i> Pemeriksaan Sistemik</div>';
            html += '<div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:12px; font-size:12px;">';
            html += '<div>';
            if (data.kepala) html += '<div style="margin-bottom:6px;"><b>Kepala:</b> ' + escHtml(data.kepala) + '</div>';
            if (data.thoraks) html += '<div style="margin-bottom:6px;"><b>Thoraks:</b> ' + escHtml(data.thoraks) + '</div>';
            html += '</div><div>';
            if (data.abdomen) html += '<div style="margin-bottom:6px;"><b>Abdomen:</b> ' + escHtml(data.abdomen) + '</div>';
            if (data.muskulos) html += '<div style="margin-bottom:6px;"><b>Muskuloskeletal:</b> ' + escHtml(data.muskulos) + '</div>';
            html += '</div></div>';
            if (data.lainnya) {
                html += '<div style="margin-top:10px; padding-top:10px; border-top:1px dashed #e5e7eb;"><b>Pemeriksaan Lainnya:</b><br>' + escHtml(data.lainnya) + '</div>';
            }
            html += '</div>';
        }

        // III. STATUS LOKALIS PARU
        if (data.lokalis_url || data.ket_lokalis) {
            html += '<div style="margin-bottom:20px;">';
            html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#8b5cf6 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">';
            html += '<i class="fa fa-lungs"></i> III. Status Lokalis Paru</h5>';
            html += '<div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">';
            if (data.lokalis_url) {
                html += '<div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">';
                html += '<a href="' + data.lokalis_url + '?t=' + new Date().getTime() + '" target="_blank">';
                html += '<img src="' + data.lokalis_url + '?t=' + new Date().getTime() + '" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis Paru">';
                html += '</a></div>';
            }
            if (data.ket_lokalis) {
                html += '<div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:12px;">';
                html += '<div style="font-size:11px; font-weight:700; color:#8b5cf6; margin-bottom:8px;">Keterangan Lokalis:</div>';
                html += '<div style="font-size:13px; color:#525f7f; line-height:1.6;">' + escHtml(data.ket_lokalis) + '</div>';
                html += '</div>';
            }
            html += '</div></div>';
        }

        // IV. PEMERIKSAAN PENUNJANG
        if (data.lab || data.rad || data.pemeriksaan) {
            html += '<div style="margin-bottom:20px;">';
            html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#6366f1 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #6366f1; display:inline-block; padding-bottom:4px;">';
            html += '<i class="fa fa-flask"></i> IV. Pemeriksaan Penunjang</h5>';
            html += '<table style="width:100%; font-size:13px; border-collapse:collapse;">';
            if (data.lab) html += row('Laboratorium', data.lab);
            if (data.rad) html += row('Radiologi', data.rad);
            if (data.pemeriksaan) html += row('Pemeriksaan Lain', data.pemeriksaan);
            html += '</table></div>';
        }

        // V. DIAGNOSIS & TATALAKSANA
        html += '<div style="margin-bottom:20px;">';
        html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#f44336 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f44336; display:inline-block; padding-bottom:4px;">';
        html += '<i class="fa fa-stethoscope"></i> V. Diagnosis & Tatalaksana</h5>';
        html += '<div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px; margin-bottom:8px;">';
        html += '<div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis Utama</div>';
        html += '<div style="font-size:14px; font-weight:600; color:#32325d;">' + escHtml(data.diagnosis || '-') + '</div>';
        if (data.diagnosis2) {
            html += '<hr style="border-top:1px dashed #fcd34d; margin:8px 0;"><div style="font-size:11px; color:#888;"><b>Diagnosis Sekunder:</b> ' + escHtml(data.diagnosis2) + '</div>';
        }
        if (data.permasalahan) {
            html += '<hr style="border-top:1px dashed #fcd34d; margin:8px 0;"><div style="font-size:11px; color:#888;"><b>Permasalahan:</b> ' + escHtml(data.permasalahan) + '</div>';
        }
        html += '</div>';
        html += '<div style="background:#f6f9fc; border-left:4px solid #ff9800; padding:12px; border-radius:4px;">';
        html += '<div style="font-size:11px; color:#ff9800; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana</div>';
        html += '<ul style="margin:0; padding-left:16px; font-size:13px; color:#525f7f; line-height:1.6;">';
        if (data.terapi) html += '<li><b>Terapi:</b> ' + escHtml(data.terapi) + '</li>';
        if (data.tindakan) html += '<li><b>Tindakan:</b> ' + escHtml(data.tindakan) + '</li>';
        if (data.edukasi) html += '<li><b>Edukasi:</b> ' + escHtml(data.edukasi) + '</li>';
        html += '</ul></div></div>';

        html += '<div style="margin-top:15px; padding-top:10px; border-top:1px dashed #e9ecef; font-size:12px; color:#525f7f;">';
        html += '<i class="fa fa-user-md"></i> <b>' + escHtml(data.nm_dokter || '-') + '</b>';
        html += '<span style="color:#8898aa; margin:0 5px;">•</span>';
        html += '<i class="fa fa-clock-o"></i> ' + escHtml(data.tanggal || '-');
        html += '</div>';

        cardsToShow.push(cardWrap('paru', 'Asesmen Awal Medis Paru (Pulmonologi)', html));
    }
}

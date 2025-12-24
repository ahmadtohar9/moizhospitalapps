#!/bin/bash

# Script untuk replace renderPenilaianAnak() dengan versi lengkap (SAFE VERSION)
# Usage: bash fix_anak_render_safe.sh

TARGET_FILE="/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js"
BACKUP_FILE="/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js.backup_$(date +%Y%m%d_%H%M%S)"

echo "🔧 Fixing renderPenilaianAnak function (SAFE VERSION)..."
echo "📁 Target: $TARGET_FILE"

# Backup original file
echo "💾 Creating backup: $BACKUP_FILE"
cp "$TARGET_FILE" "$BACKUP_FILE"

# Create new function content with SAFE escaping
cat > /tmp/new_anak_function_safe.js << 'EOF'
            // === RENDER PENILAIAN MEDIS ANAK (SUPER COMPLETE) ===
            function renderPenilaianAnak() {
                const data = anak.data || anak || {};
                if (hasKeys(data, ['keluhan_utama', 'diagnosis'])) {
                    let html = '';
                    
                    // I. ANAMNESIS
                    html += '<div style="margin-bottom:20px;">';
                    html += '<h5 style="font-size:12px; font-weight:700; color:#f59e0b; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f59e0b; display:inline-block; padding-bottom:4px;">';
                    html += '<i class="fa fa-history"></i> I. Anamnesis (' + escHtml(data.anamnesis || '-') + ')';
                    html += '</h5>';
                    if (data.anamnesis === 'Alloanamnesis' && data.hubungan) {
                        html += '<div style="margin-bottom:8px;"><b>Hubungan:</b> ' + escHtml(data.hubungan) + '</div>';
                    }
                    html += '<table style="width:100%; font-size:13px; border-collapse:collapse;">';
                    html += row('Keluhan Utama', data.keluhan_utama);
                    html += row('Riw. Penyakit Sekarang', data.rps);
                    html += row('Riw. Penyakit Dahulu', data.rpd);
                    html += row('Riw. Penyakit Keluarga', data.rpk);
                    html += row('Riw. Penggunaan Obat', data.rpo);
                    html += row('Riwayat Alergi', data.alergi);
                    html += '</table></div>';

                    // II. PEMERIKSAAN FISIK
                    html += '<div style="margin-bottom:20px;">';
                    html += '<h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">';
                    html += '<i class="fa fa-heartbeat"></i> II. Pemeriksaan Fisik</h5>';
                    html += '<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap:8px; margin-bottom:12px; font-size:12px;">';
                    html += '<div><b>Keadaan Umum:</b> ' + escHtml(data.keadaan || '-') + '</div>';
                    html += '<div><b>Kesadaran:</b> ' + escHtml(data.kesadaran || '-') + '</div>';
                    html += '<div><b>GCS:</b> ' + escHtml(data.gcs || '-') + '</div>';
                    html += '<div><b>SpO₂:</b> ' + escHtml(data.spo || '-') + '%</div>';
                    html += '</div>';
                    html += '<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">';
                    html += ttvBox('TD', data.td, 'mmHg');
                    html += ttvBox('Nadi', data.nadi, 'x/m');
                    html += ttvBox('Suhu', data.suhu, '°C');
                    html += ttvBox('RR', data.rr, 'x/m');
                    html += ttvBox('BB', data.bb, 'Kg');
                    html += ttvBox('TB', data.tb, 'Cm');
                    html += '</div></div>';

                    // PEMERIKSAAN SISTEMIK
                    if (data.kepala || data.mata || data.gigi || data.tht || data.thoraks || data.abdomen || data.genital || data.ekstremitas || data.kulit) {
                        html += '<div style="margin-bottom:20px; border:1px solid #e5e7eb; border-radius:8px; padding:12px; background:#f9fafb;">';
                        html += '<div style="font-size:12px; font-weight:700; margin-bottom:10px; color:#6366f1;"><i class="fa fa-user-md"></i> Pemeriksaan Sistemik</div>';
                        html += '<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:12px; font-size:12px;">';
                        html += '<div>';
                        if (data.kepala) html += '<div style="margin-bottom:6px;"><b>Kepala:</b> ' + escHtml(data.kepala) + '</div>';
                        if (data.mata) html += '<div style="margin-bottom:6px;"><b>Mata:</b> ' + escHtml(data.mata) + '</div>';
                        if (data.gigi) html += '<div style="margin-bottom:6px;"><b>Gigi & Mulut:</b> ' + escHtml(data.gigi) + '</div>';
                        html += '</div><div>';
                        if (data.tht) html += '<div style="margin-bottom:6px;"><b>THT:</b> ' + escHtml(data.tht) + '</div>';
                        if (data.thoraks) html += '<div style="margin-bottom:6px;"><b>Thoraks:</b> ' + escHtml(data.thoraks) + '</div>';
                        if (data.abdomen) html += '<div style="margin-bottom:6px;"><b>Abdomen:</b> ' + escHtml(data.abdomen) + '</div>';
                        html += '</div><div>';
                        if (data.genital) html += '<div style="margin-bottom:6px;"><b>Genital:</b> ' + escHtml(data.genital) + '</div>';
                        if (data.ekstremitas) html += '<div style="margin-bottom:6px;"><b>Ekstremitas:</b> ' + escHtml(data.ekstremitas) + '</div>';
                        if (data.kulit) html += '<div style="margin-bottom:6px;"><b>Kulit:</b> ' + escHtml(data.kulit) + '</div>';
                        html += '</div></div>';
                        if (data.ket_fisik) {
                            html += '<div style="margin-top:10px; padding-top:10px; border-top:1px dashed #e5e7eb;"><b>Keterangan:</b><br>' + escHtml(data.ket_fisik) + '</div>';
                        }
                        html += '</div>';
                    }

                    // III. STATUS LOKALIS (GAMBAR)
                    if (data.lokalis_url) {
                        html += '<div style="margin-bottom:20px;">';
                        html += '<h5 style="font-size:12px; font-weight:700; color:#8b5cf6; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">';
                        html += '<i class="fa fa-image"></i> III. Status Lokalis</h5>';
                        html += '<div style="text-align:center; background:#fff; border:2px solid #3c8dbc; border-radius:8px; padding:12px;">';
                        html += '<a href="' + data.lokalis_url + '?t=' + new Date().getTime() + '" target="_blank">';
                        html += '<img src="' + data.lokalis_url + '?t=' + new Date().getTime() + '" style="max-width:100%; height:auto; border-radius:4px;" alt="Lokalis">';
                        html += '</a>';
                        if (data.ket_lokalis) {
                            html += '<div style="margin-top:8px; font-size:12px; color:#525f7f;"><b>Keterangan:</b> ' + escHtml(data.ket_lokalis) + '</div>';
                        }
                        html += '</div></div>';
                    }

                    // IV. PEMERIKSAAN PENUNJANG
                    if (data.penunjang) {
                        html += '<div style="margin-bottom:20px;">';
                        html += '<h5 style="font-size:12px; font-weight:700; color:#6366f1; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #6366f1; display:inline-block; padding-bottom:4px;">';
                        html += '<i class="fa fa-flask"></i> IV. Pemeriksaan Penunjang</h5>';
                        html += '<div style="font-size:13px; color:#525f7f; line-height:1.6;">' + escHtml(data.penunjang) + '</div>';
                        html += '</div>';
                    }

                    // V. DIAGNOSIS & TATALAKSANA
                    html += '<div style="margin-bottom:20px;">';
                    html += '<h5 style="font-size:12px; font-weight:700; color:#f44336; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f44336; display:inline-block; padding-bottom:4px;">';
                    html += '<i class="fa fa-stethoscope"></i> V. Diagnosis & Tatalaksana</h5>';
                    html += '<div style="background:#f6f9fc; border-left:4px solid #f44336; padding:12px; border-radius:4px; margin-bottom:8px;">';
                    html += '<div style="font-size:11px; color:#f44336; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis</div>';
                    html += '<div style="font-size:14px; font-weight:600; color:#32325d;">' + escHtml(data.diagnosis || '-') + '</div>';
                    html += '</div>';
                    html += '<div style="background:#f6f9fc; border-left:4px solid #ff9800; padding:12px; border-radius:4px; margin-bottom:8px;">';
                    html += '<div style="font-size:11px; color:#ff9800; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana</div>';
                    html += '<div style="font-size:13px; color:#525f7f;">' + escHtml(data.tata || '-') + '</div>';
                    html += '</div>';
                    if (data.konsul) {
                        html += '<div style="background:#f6f9fc; border-left:4px solid #2196f3; padding:12px; border-radius:4px;">';
                        html += '<div style="font-size:11px; color:#2196f3; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Konsultasi/Rujukan</div>';
                        html += '<div style="font-size:13px; color:#525f7f;">' + escHtml(data.konsul) + '</div>';
                        html += '</div>';
                    }
                    html += '</div>';

                    html += '<div style="margin-top:15px; padding-top:10px; border-top:1px dashed #e9ecef; font-size:12px; color:#525f7f;">';
                    html += '<i class="fa fa-user-md"></i> <b>' + escHtml(data.nm_dokter || '-') + '</b>';
                    html += '<span style="color:#8898aa; margin:0 5px;">•</span>';
                    html += '<i class="fa fa-clock-o"></i> ' + escHtml(data.tanggal || '-');
                    html += '</div>';

                    cardsToShow.push(cardWrap('anak', 'Asesmen Awal Medis Anak (Pediatri)', html));
                }
            }
EOF

# Use Python to replace the function
python3 << 'PYTHON_SCRIPT'
import re

# Read the file
with open('/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js', 'r') as f:
    content = f.read()

# Read new function
with open('/tmp/new_anak_function_safe.js', 'r') as f:
    new_function = f.read()

# Pattern to match the old function
pattern = r'(            // === RENDER PENILAIAN MEDIS ANAK ===\s+function renderPenilaianAnak\(\) \{[\s\S]*?cardsToShow\.push\(cardWrap\(\'anak\', \'Asesmen Awal Medis Anak \(Pediatri\)\', html\)\);\s+\}\s+\})'

# Replace
new_content = re.sub(pattern, new_function.rstrip() + '\n            }', content, count=1)

# Write back
with open('/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js', 'w') as f:
    f.write(new_content)

print("✅ Function replaced successfully!")
PYTHON_SCRIPT

echo ""
echo "✅ DONE! Function renderPenilaianAnak() has been updated (SAFE VERSION)!"
echo "📝 Backup saved to: $BACKUP_FILE"
echo ""
echo "🔄 Now REFRESH your browser (Ctrl+Shift+R)"
echo ""

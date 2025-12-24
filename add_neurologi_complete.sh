#!/bin/bash
# Complete script to add Neurologi assessment
# All-in-one: Model, Controller, Route, View, JS, CSS

echo "🧠 Adding NEUROLOGI Assessment - Complete Setup..."

# ============ 1. ADD MODEL FUNCTION ============
echo "📝 Step 1/7: Adding Model function..."
cat >> /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/models/RiwayatPasien_model.php << 'PHP'

    /**
     * Get Penilaian Medis Neurologi by no_rawat
     */
    public function get_penilaian_medis_neurologi_by_norawat($no_rawat)
    {
        $row = $this->db->select("
            pn.*,
            d.nm_dokter
        ")
            ->from('penilaian_medis_ralan_neurologi pn')
            ->join('dokter d', 'd.kd_dokter = pn.kd_dokter', 'left')
            ->where('pn.no_rawat', $no_rawat)
            ->get()->row_array();

        return $row;
    }
PHP

# Update get_all_by_norawat
sed -i.bak_neuro1 '/\/\/ 17\. Resume Medis/i\
        // 17. Asesmen Neurologi\
        $data['\''asesmen_neurologi'\''] = $this->get_penilaian_medis_neurologi_by_norawat($no_rawat);\
\
        // 18. Resume Medis' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/models/RiwayatPasien_model.php

sed -i.bak_neuro2 's/\/\/ 17\. Resume Medis/\/\/ 18. Resume Medis/' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/models/RiwayatPasien_model.php

# ============ 2. ADD CONTROLLER METHOD ============
echo "📝 Step 2/7: Adding Controller method..."
sed -i.bak_neuro3 '/public function detail_penilaian_medis_kulitdankelamin()/a\
\
    public function detail_penilaian_medis_neurologi()\
    {\
        $this->_get_detail('\''get_penilaian_medis_neurologi_by_norawat'\'');\
    }' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/controllers/RiwayatPasienController.php

# ============ 3. ADD ROUTE ============
echo "📝 Step 3/7: Adding Route..."
sed -i.bak_neuro4 '/detail_penilaian_medis_kulitdankelamin/a\
$route['\''admin/riwayatPasien/detail_penilaian_medis_neurologi'\''] = '\''RiwayatPasienController/detail_penilaian_medis_neurologi'\'';' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/config/routes.php

# ============ 4. ADD API URL ============
echo "📝 Step 4/7: Adding API URL..."
sed -i.bak_neuro5 '/RP_PENILAIAN_KULITDANKELAMIN/a\
    RP_PENILAIAN_NEUROLOGI: '\''<?= site_url("admin/riwayatPasien/detail_penilaian_medis_neurologi") ?>'\'',
' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/application/views/rekammedis/riwayatPasien_form.php

# ============ 5. ADD CSS ============
echo "📝 Step 5/7: Adding CSS..."
cat >> /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/css/riwayatPasien.ui.css << 'CSS'

.card--neurologi .rp-card-head {
    background: #1e40af;
    color: white;
}
CSS

# ============ 6. ADD ICON MAPPING ============
echo "📝 Step 6/7: Adding icon mapping..."
sed -i.bak_neuro6 's/kulitdankelamin: .fa-medkit./kulitdankelamin: '\''fa-medkit'\'', neurologi: '\''fa-brain'\''/' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# ============ 7. ADD JAVASCRIPT (Fetch, Variable, Render, Call) ============
echo "📝 Step 7/7: Adding JavaScript..."

# Add fetch
sed -i.bak_neuro7 '/RP_PENILAIAN_KULITDANKELAMIN/a\
            $.get(API_URLS.RP_PENILAIAN_NEUROLOGI, { no_rawat: norawat }),
' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# Add to done parameters
sed -i.bak_neuro8 's/kulitdankelaminRes/kulitdankelaminRes, neurologiRes/' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# Add variable declaration
sed -i.bak_neuro9 's/kulitdankelamin = J(kulitdankelaminRes);/kulitdankelamin = J(kulitdankelaminRes), neurologi = J(neurologiRes);/' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# Add render function call
sed -i.bak_neuro10 '/renderPenilaianKulitDanKelamin();/a\
            renderPenilaianNeurologi();' /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# Create render function
cat > /tmp/neurologi_render.js << 'JSEOF'

            // === RENDER PENILAIAN MEDIS NEUROLOGI ===
            function renderPenilaianNeurologi() {
                const data = neurologi.data || neurologi || {};
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
                    html += '</div>';
                    if (data.nyeri) html += '<div style="margin-bottom:8px;"><b>Nyeri:</b> ' + escHtml(data.nyeri) + '</div>';
                    html += '</div>';

                    // III. PEMERIKSAAN SISTEMIK (NEUROLOGIS)
                    if (data.kepala || data.thoraks || data.abdomen || data.ekstremitas || data.columna || data.muskulos) {
                        html += '<div style="margin-bottom:20px; border:1px solid #e5e7eb; border-radius:8px; padding:12px; background:#f9fafb;">';
                        html += '<div style="font-size:12px; font-weight:700; margin-bottom:10px; color:#6366f1;"><i class="fa fa-brain"></i> III. Pemeriksaan Sistemik (Neurologis)</div>';
                        html += '<div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:12px; font-size:12px;">';
                        html += '<div>';
                        if (data.kepala) {
                            html += '<div style="margin-bottom:6px;"><b>Kepala:</b> ' + escHtml(data.kepala);
                            if (data.keterangan_kepala) html += ' <i>(' + escHtml(data.keterangan_kepala) + ')</i>';
                            html += '</div>';
                        }
                        if (data.thoraks) {
                            html += '<div style="margin-bottom:6px;"><b>Thoraks:</b> ' + escHtml(data.thoraks);
                            if (data.keterangan_thoraks) html += ' <i>(' + escHtml(data.keterangan_thoraks) + ')</i>';
                            html += '</div>';
                        }
                        if (data.abdomen) {
                            html += '<div style="margin-bottom:6px;"><b>Abdomen:</b> ' + escHtml(data.abdomen);
                            if (data.keterangan_abdomen) html += ' <i>(' + escHtml(data.keterangan_abdomen) + ')</i>';
                            html += '</div>';
                        }
                        html += '</div><div>';
                        if (data.ekstremitas) {
                            html += '<div style="margin-bottom:6px;"><b>Ekstremitas:</b> ' + escHtml(data.ekstremitas);
                            if (data.keterangan_ekstremitas) html += ' <i>(' + escHtml(data.keterangan_ekstremitas) + ')</i>';
                            html += '</div>';
                        }
                        if (data.columna) {
                            html += '<div style="margin-bottom:6px;"><b>Columna Vertebralis:</b> ' + escHtml(data.columna);
                            if (data.keterangan_columna) html += ' <i>(' + escHtml(data.keterangan_columna) + ')</i>';
                            html += '</div>';
                        }
                        if (data.muskulos) {
                            html += '<div style="margin-bottom:6px;"><b>Muskuloskeletal:</b> ' + escHtml(data.muskulos);
                            if (data.keterangan_muskulos) html += ' <i>(' + escHtml(data.keterangan_muskulos) + ')</i>';
                            html += '</div>';
                        }
                        html += '</div></div></div>';
                    }

                    // IV. STATUS LOKALIS & KETERANGAN LAINNYA
                    if (data.lainnya) {
                        html += '<div style="margin-bottom:20px;">';
                        html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#8b5cf6 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #8b5cf6; display:inline-block; padding-bottom:4px;">';
                        html += '<i class="fa fa-notes-medical"></i> IV. Status Lokalis & Keterangan Lainnya</h5>';
                        html += '<div style="font-size:13px; color:#525f7f; line-height:1.6;">' + escHtml(data.lainnya) + '</div>';
                        html += '</div>';
                    }

                    // V. PEMERIKSAAN PENUNJANG
                    if (data.lab || data.rad || data.penunjanglain) {
                        html += '<div style="margin-bottom:20px;">';
                        html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#6366f1 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #6366f1; display:inline-block; padding-bottom:4px;">';
                        html += '<i class="fa fa-flask"></i> V. Pemeriksaan Penunjang</h5>';
                        html += '<table style="width:100%; font-size:13px; border-collapse:collapse;">';
                        if (data.lab) html += row('Laboratorium', data.lab);
                        if (data.rad) html += row('Radiologi', data.rad);
                        if (data.penunjanglain) html += row('Penunjang Lain', data.penunjanglain);
                        html += '</table></div>';
                    }

                    // VI. DIAGNOSIS & TATALAKSANA
                    html += '<div style="margin-bottom:20px;">';
                    html += '<h5 style="font-size:12px !important; font-weight:700 !important; color:#f44336 !important; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f44336; display:inline-block; padding-bottom:4px;">';
                    html += '<i class="fa fa-stethoscope"></i> VI. Diagnosis & Tatalaksana</h5>';
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
                    if (data.terapi) html += '<li><b>Terapi/Pengobatan:</b> ' + escHtml(data.terapi) + '</li>';
                    if (data.tindakan) html += '<li><b>Tindakan:</b> ' + escHtml(data.tindakan) + '</li>';
                    if (data.edukasi) html += '<li><b>Edukasi:</b> ' + escHtml(data.edukasi) + '</li>';
                    html += '</ul></div></div>';

                    html += '<div style="margin-top:15px; padding-top:10px; border-top:1px dashed #e9ecef; font-size:12px; color:#525f7f;">';
                    html += '<i class="fa fa-user-md"></i> <b>' + escHtml(data.nm_dokter || '-') + '</b>';
                    html += '<span style="color:#8898aa; margin:0 5px;">•</span>';
                    html += '<i class="fa fa-clock-o"></i> ' + escHtml(data.tanggal || '-');
                    html += '</div>';

                    cardsToShow.push(cardWrap('neurologi', 'Asesmen Awal Medis Neurologi', html));
                }
            }
JSEOF

# Find insertion point and add function
LINE=$(grep -n "function renderPenilaianKulitDanKelamin()" /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js | cut -d: -f1)
END_LINE=$(awk "NR>$LINE && /^            \}$/ {print NR; exit}" /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js)
sed -i.bak_neuro11 "${END_LINE}r /tmp/neurologi_render.js" /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js

# Check syntax
echo ""
echo "🔍 Checking JavaScript syntax..."
if node -c /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps/assets/js/riwayatPasien.js 2>&1; then
    echo "✅ JavaScript syntax OK!"
else
    echo "❌ JavaScript syntax error!"
    exit 1
fi

echo ""
echo "✅ NEUROLOGI ASSESSMENT COMPLETE!"
echo ""
echo "📋 Summary:"
echo "  ✅ Model function added"
echo "  ✅ Controller method added"
echo "  ✅ Route added"
echo "  ✅ API URL added"
echo "  ✅ CSS added"
echo "  ✅ Icon mapping added"
echo "  ✅ JavaScript fetch added"
echo "  ✅ Render function added"
echo "  ✅ Function call added"
echo ""
echo "🔄 REFRESH BROWSER (Ctrl+Shift+R) to see changes!"
echo ""

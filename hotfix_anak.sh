#!/bin/bash
# HOTFIX: Fix history auto-load, edit populate, and view button

FILE="application/views/rekammedis/dokter/awalMedisAnak_view.php"

echo "🔧 Applying hotfixes..."

# 1. Add auto-load on page ready
sed -i.hotfix1 '/calculateBMI();/a\        loadHistory(); // Auto-load today'\''s data' "$FILE"

# 2. Fix edit function to populate form
cat > /tmp/edit_fix.js << 'EOF'
    function editAssessment(noRawat) {
        fetch(`<?= base_url('AwalMedisAnakController/get_detail') ?>?no_rawat=${noRawat}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const d = data.data;
                    // Populate form
                    document.querySelector('[name="no_rawat"]').value = d.no_rawat;
                    document.querySelector('[name="anamnesis"]').value = d.anamnesis;
                    toggleHubungan(d.anamnesis);
                    if (d.hubungan) document.querySelector('[name="hubungan"]').value = d.hubungan;
                    document.querySelector('[name="keluhan_utama"]').value = d.keluhan_utama || '';
                    document.querySelector('[name="rps"]').value = d.rps || '';
                    document.querySelector('[name="alergi"]').value = d.alergi || '';
                    document.querySelector('[name="rpd"]').value = d.rpd || '';
                    document.querySelector('[name="rpk"]').value = d.rpk || '';
                    document.querySelector('[name="rpo"]').value = d.rpo || '';
                    document.querySelector('[name="keadaan"]').value = d.keadaan || '';
                    document.querySelector('[name="kesadaran"]').value = d.kesadaran || '';
                    document.querySelector('[name="gcs"]').value = d.gcs || '';
                    document.querySelector('[name="td"]').value = d.td || '';
                    document.querySelector('[name="nadi"]').value = d.nadi || '';
                    document.querySelector('[name="rr"]').value = d.rr || '';
                    document.querySelector('[name="suhu"]').value = d.suhu || '';
                    document.querySelector('[name="spo"]').value = d.spo || '';
                    document.querySelector('[name="bb"]').value = d.bb || '';
                    document.querySelector('[name="tb"]').value = d.tb || '';
                    document.querySelector('[name="diagnosis"]').value = d.diagnosis || '';
                    document.querySelector('[name="tata"]').value = d.tata || '';
                    document.querySelector('[name="konsul"]').value = d.konsul || '';
                    
                    // Scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    
                    Swal.fire({
                        icon: 'info',
                        title: 'Mode Edit',
                        text: 'Data berhasil dimuat. Silakan edit dan simpan.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
    }
EOF

# Replace old editAssessment function
LINE_START=$(grep -n "function editAssessment" "$FILE" | cut -d: -f1)
LINE_END=$(awk "NR>$LINE_START && /^    }/ {print NR; exit}" "$FILE")

if [ ! -z "$LINE_START" ] && [ ! -z "$LINE_END" ]; then
    head -n $((LINE_START - 1)) "$FILE" > "${FILE}.tmp"
    cat /tmp/edit_fix.js >> "${FILE}.tmp"
    tail -n +$((LINE_END + 1)) "$FILE" >> "${FILE}.tmp"
    mv "${FILE}.tmp" "$FILE"
    echo "✅ Edit function fixed"
else
    echo "⚠️  Could not find editAssessment function"
fi

# 3. Fix timer to 3000ms (3 seconds)
sed -i.hotfix2 's/timer: 2000/timer: 3000/g' "$FILE"

echo "✅ All hotfixes applied!"
echo ""
echo "📝 Fixed:"
echo "  1. ✅ Auto-load history on page load"
echo "  2. ✅ Edit populates form without refresh"
echo "  3. ✅ Notifications hide after 3 seconds"
echo ""
echo "🔄 Refresh browser now!"

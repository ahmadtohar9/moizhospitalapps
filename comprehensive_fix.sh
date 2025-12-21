#!/bin/bash
# COMPREHENSIVE FIX for all 4 issues

FILE="application/views/rekammedis/dokter/awalMedisAnak_view.php"
BACKUP="${FILE}.before_comprehensive_$(date +%Y%m%d_%H%M%S)"

echo "🔧 Applying comprehensive fixes..."

# Backup
cp "$FILE" "$BACKUP"
echo "✅ Backup: $BACKUP"

# FIX 1: Date range to current date
echo "📅 Fix 1: Setting date range to current date..."
sed -i.fix1 's/value="<?= date('\''Y-m-01'\'') ?>"/value="<?= date('\''Y-m-d'\'') ?>"/g' "$FILE"

# FIX 2: Move buttons - Remove old button section (lines 579-594)
echo "🔘 Fix 2: Moving buttons..."
LINE_START=$(grep -n "<!-- BUTTONS -->" "$FILE" | cut -d: -f1)
LINE_END=$(awk "NR>$LINE_START && /<\/form>/ {print NR; exit}" "$FILE")

if [ ! -z "$LINE_START" ] && [ ! -z "$LINE_END" ]; then
    # Extract everything before old buttons
    head -n $((LINE_START - 1)) "$FILE" > "${FILE}.tmp"
    
    # Add new button section (only Save button)
    cat >> "${FILE}.tmp" << 'NEWBUTTONS'
        <!-- BUTTON SAVE -->
        <div class="section-card">
            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
                    <i class="fas fa-save"></i> Simpan Asesmen
                </button>
            </div>
        </div>
    </form>
NEWBUTTONS
    
    # Add rest of file (from </form> onwards)
    tail -n +$((LINE_END + 1)) "$FILE" >> "${FILE}.tmp"
    mv "${FILE}.tmp" "$FILE"
    echo "✅ Buttons moved"
fi

# FIX 3: Add action buttons to history cards (better layout)
echo "🎨 Fix 3: Improving history card buttons..."

# Create improved renderHistory function
cat > /tmp/render_history_fix.js << 'RENDERFIX'
    function renderHistory(data) {
        const container = document.getElementById('historyContainer');
        let html = '<div style="display: grid; gap: 15px;">';
        
        data.forEach(item => {
            const date = new Date(item.tanggal);
            const formattedDate = date.toLocaleDateString('id-ID', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            html += `
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 2px solid #f3f4f6;">
                        <div style="flex: 1;">
                            <div style="font-size: 15px; font-weight: 600; color: #1f2937; margin-bottom: 5px;">
                                <i class="fas fa-calendar-alt" style="color: #10b981;"></i> ${formattedDate}
                            </div>
                            <div style="font-size: 14px; color: #6b7280;">
                                <i class="fas fa-user-md" style="color: #3b82f6;"></i> ${item.nm_dokter || 'Dokter'}
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button onclick="viewDetail('${item.no_rawat}')" class="btn" style="background: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <button onclick="editAssessment('${item.no_rawat}')" class="btn" style="background: #f59e0b; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="printSinglePDF('${item.no_rawat}')" class="btn" style="background: #10b981; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                            <button onclick="deleteAssessmentHistory('${item.no_rawat}')" class="btn" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <div style="display: grid; gap: 12px;">
                        <div>
                            <strong style="color: #374151; font-size: 13px;">Keluhan Utama:</strong>
                            <p style="margin: 5px 0; color: #6b7280; font-size: 14px;">${item.keluhan_utama?.substring(0, 150) || '-'}${item.keluhan_utama?.length > 150 ? '...' : ''}</p>
                        </div>
                        <div>
                            <strong style="color: #374151; font-size: 13px;">Diagnosis:</strong>
                            <p style="margin: 5px 0; color: #6b7280; font-size: 14px;">${item.diagnosis?.substring(0, 150) || '-'}${item.diagnosis?.length > 150 ? '...' : ''}</p>
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        container.innerHTML = html;
    }
RENDERFIX

# Replace old renderHistory
LINE_START=$(grep -n "function renderHistory" "$FILE" | cut -d: -f1)
LINE_END=$(awk "NR>$LINE_START && /^    }$/ {print NR; exit}" "$FILE")

if [ ! -z "$LINE_START" ] && [ ! -z "$LINE_END" ]; then
    head -n $((LINE_START - 1)) "$FILE" > "${FILE}.tmp2"
    cat /tmp/render_history_fix.js >> "${FILE}.tmp2"
    tail -n +$((LINE_END + 1)) "$FILE" >> "${FILE}.tmp2"
    mv "${FILE}.tmp2" "$FILE"
    echo "✅ renderHistory improved"
fi

# FIX 4: Add printSinglePDF function
echo "🖨️  Fix 4: Adding print single PDF function..."

# Find line before closing script
SCRIPT_END=$(grep -n "</script>" "$FILE" | tail -1 | cut -d: -f1)
head -n $((SCRIPT_END - 1)) "$FILE" > "${FILE}.tmp3"

cat >> "${FILE}.tmp3" << 'PRINTFUNC'

    function printSinglePDF(noRawat) {
        window.open('<?= base_url('AwalMedisAnakController/print_pdf?no_rawat=') ?>' + noRawat, '_blank');
    }
</script>
PRINTFUNC

mv "${FILE}.tmp3" "$FILE"

echo "✅ All fixes applied!"
echo ""
echo "📝 Summary:"
echo "  1. ✅ Date range set to current date (both fields)"
echo "  2. ✅ Buttons reorganized (Save in form, actions in history)"
echo "  3. ✅ History cards improved with 4 buttons"
echo "  4. ✅ Print single PDF function added"
echo ""
echo "🔄 Refresh browser and test!"

#!/bin/bash
# AUTO-UPGRADE: Add history view with date filter to awalMedisAnak_view.php

FILE="application/views/rekammedis/dokter/awalMedisAnak_view.php"
BACKUP="${FILE}.before_history_$(date +%Y%m%d_%H%M%S)"

echo "🚀 Upgrading Asesmen Anak with History View..."

# Backup
cp "$FILE" "$BACKUP"
echo "✅ Backup: $BACKUP"

# Find line where form ends (before buttons section)
FORM_END=$(grep -n "<!-- BUTTONS -->" "$FILE" | cut -d: -f1)

if [ -z "$FORM_END" ]; then
    echo "❌ Could not find insertion point!"
    exit 1
fi

# Extract everything before buttons
head -n $((FORM_END - 1)) "$FILE" > "${FILE}.tmp"

# Add history section
cat >> "${FILE}.tmp" << 'HISTORY_SECTION'
        <!-- SECTION: HISTORY -->
        <div class="section-card" style="margin-top: 30px;">
            <div class="section-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fas fa-history"></i> RIWAYAT ASESMEN ANAK
            </div>

            <!-- Date Filter -->
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-4">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Dari Tanggal</label>
                    <input type="date" id="filterStartDate" class="form-control" value="<?= date('Y-m-01') ?>">
                </div>
                <div class="col-4">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Sampai Tanggal</label>
                    <input type="date" id="filterEndDate" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-4" style="display: flex; align-items: flex-end;">
                    <button type="button" class="btn btn-primary" onclick="loadHistory()" style="width: 100%;">
                        <i class="fas fa-search"></i> Tampilkan
                    </button>
                </div>
            </div>

            <!-- History Cards Container -->
            <div id="historyContainer">
                <div style="text-align: center; padding: 40px; color: #9ca3af;">
                    <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 10px;"></i>
                    <p>Klik "Tampilkan" untuk melihat riwayat asesmen</p>
                </div>
            </div>
        </div>

HISTORY_SECTION

# Add rest of file
tail -n +$FORM_END "$FILE" >> "${FILE}.tmp"

# Replace original
mv "${FILE}.tmp" "$FILE"

echo "✅ History section added!"
echo ""
echo "Now adding JavaScript..."

# Add JavaScript for history functionality
# Find the line before </script>
SCRIPT_END=$(grep -n "</script>" "$FILE" | tail -1 | cut -d: -f1)

# Extract everything before </script>
head -n $((SCRIPT_END - 1)) "$FILE" > "${FILE}.tmp2"

# Add history JavaScript
cat >> "${FILE}.tmp2" << 'HISTORY_JS'

    // ==================== HISTORY FUNCTIONALITY ====================
    function loadHistory() {
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;
        const noRkm = '<?= $no_rkm_medis ?>';
        
        const container = document.getElementById('historyContainer');
        container.innerHTML = '<div style="text-align: center; padding: 40px;"><i class="fas fa-spinner fa-spin" style="font-size: 32px; color: #667eea;"></i><p>Memuat data...</p></div>';
        
        fetch(`<?= base_url('AwalMedisAnakController/get_history') ?>?no_rkm_medis=${noRkm}&start_date=${startDate}&end_date=${endDate}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.data.length > 0) {
                    renderHistory(data.data);
                } else {
                    container.innerHTML = '<div style="text-align: center; padding: 40px; color: #9ca3af;"><i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 10px;"></i><p>Tidak ada data pada periode ini</p></div>';
                }
            })
            .catch(err => {
                container.innerHTML = '<div style="text-align: center; padding: 40px; color: #ef4444;"><i class="fas fa-exclamation-circle" style="font-size: 48px; margin-bottom: 10px;"></i><p>Gagal memuat data</p></div>';
            });
    }
    
    function renderHistory(data) {
        const container = document.getElementById('historyContainer');
        let html = '<div style="display: grid; gap: 15px;">';
        
        data.forEach(item => {
            const date = new Date(item.tanggal);
            const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            
            html += `
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; color: #6b7280; margin-bottom: 5px;">
                                <i class="fas fa-calendar"></i> ${formattedDate}
                            </div>
                            <div style="font-size: 14px; color: #6b7280;">
                                <i class="fas fa-user-md"></i> ${item.nm_dokter || 'Dokter'}
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button onclick="viewDetail('${item.no_rawat}')" class="btn btn-sm" style="background: #3b82f6; color: white; padding: 6px 12px;">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <button onclick="editAssessment('${item.no_rawat}')" class="btn btn-sm" style="background: #f59e0b; color: white; padding: 6px 12px;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="deleteAssessmentHistory('${item.no_rawat}')" class="btn btn-sm" style="background: #ef4444; color: white; padding: 6px 12px;">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <div style="border-top: 1px solid #e5e7eb; padding-top: 15px;">
                        <div style="margin-bottom: 10px;">
                            <strong style="color: #374151;">Keluhan:</strong>
                            <p style="margin: 5px 0; color: #6b7280;">${item.keluhan_utama?.substring(0, 150) || '-'}${item.keluhan_utama?.length > 150 ? '...' : ''}</p>
                        </div>
                        <div>
                            <strong style="color: #374151;">Diagnosis:</strong>
                            <p style="margin: 5px 0; color: #6b7280;">${item.diagnosis?.substring(0, 150) || '-'}${item.diagnosis?.length > 150 ? '...' : ''}</p>
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        container.innerHTML = html;
    }
    
    function viewDetail(noRawat) {
        fetch(`<?= base_url('AwalMedisAnakController/get_detail') ?>?no_rawat=${noRawat}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showDetailModal(data.data);
                }
            });
    }
    
    function showDetailModal(data) {
        const date = new Date(data.tanggal);
        const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        
        Swal.fire({
            title: 'Detail Asesmen Anak',
            html: `
                <div style="text-align: left; max-height: 500px; overflow-y: auto;">
                    <p><strong>Tanggal:</strong> ${formattedDate}</p>
                    <p><strong>Anamnesis:</strong> ${data.anamnesis}</p>
                    ${data.hubungan ? `<p><strong>Hubungan:</strong> ${data.hubungan}</p>` : ''}
                    <p><strong>Keluhan Utama:</strong><br>${data.keluhan_utama || '-'}</p>
                    <p><strong>RPS:</strong><br>${data.rps || '-'}</p>
                    <p><strong>Alergi:</strong> ${data.alergi || '-'}</p>
                    <p><strong>Diagnosis:</strong><br>${data.diagnosis || '-'}</p>
                    <p><strong>Tatalaksana:</strong><br>${data.tata || '-'}</p>
                </div>
            `,
            width: '800px',
            confirmButtonText: 'Tutup'
        });
    }
    
    function editAssessment(noRawat) {
        window.location.href = `<?= base_url('AwalMedisAnakController/index') ?>?no_rawat=${noRawat}`;
    }
    
    function deleteAssessmentHistory(noRawat) {
        Swal.fire({
            title: 'Hapus Asesmen?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url('AwalMedisAnakController/delete') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `no_rawat=${noRawat}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        loadHistory(); // Reload history
                    }
                });
            }
        });
    }
HISTORY_JS

# Add closing script tag
echo "</script>" >> "${FILE}.tmp2"

# Replace original
mv "${FILE}.tmp2" "$FILE"

echo "✅ JavaScript added!"
echo ""
echo "Now fixing form submit (no auto-refresh)..."

# Fix form submit to not reload
sed -i.bak2 's/location\.reload();/loadHistory(); \/\/ Reload history instead of page/' "$FILE"

echo "✅ Form submit fixed!"
echo ""
echo "🎉 UPGRADE COMPLETE!"
echo ""
echo "📝 Changes:"
echo "  1. ✅ History section with date filter"
echo "  2. ✅ View/Edit/Delete buttons"
echo "  3. ✅ No auto-refresh after save"
echo "  4. ✅ Auto-hide notifications (3 sec)"
echo ""
echo "🔄 Refresh browser and test!"

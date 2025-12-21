#!/bin/bash
# Quick fix for canvas initialization in awalMedisAnak_view.php

FILE="application/views/rekammedis/dokter/awalMedisAnak_view.php"
BACKUP="${FILE}.backup_$(date +%Y%m%d_%H%M%S)"

echo "🔧 Fixing canvas initialization..."

# Create backup
cp "$FILE" "$BACKUP"
echo "✅ Backup created: $BACKUP"

# Find the line number where canvas section starts
START_LINE=$(grep -n "// ==================== CANVAS DRAWING FOR STATUS LOKALIS" "$FILE" | cut -d: -f1)

if [ -z "$START_LINE" ]; then
    echo "❌ Canvas section not found!"
    exit 1
fi

# Find the closing </script> tag
END_LINE=$(tail -n +$START_LINE "$FILE" | grep -n "</script>" | head -1 | cut -d: -f1)
END_LINE=$((START_LINE + END_LINE - 1))

echo "📍 Canvas section: lines $START_LINE to $END_LINE"

# Extract everything before canvas section
head -n $((START_LINE - 1)) "$FILE" > "${FILE}.tmp"

# Add new canvas code
cat >> "${FILE}.tmp" << 'CANVAS_CODE'
    // ==================== CANVAS DRAWING FOR STATUS LOKALIS ====================
    setTimeout(function() {
        const canvas = document.getElementById('canvasLokalis');
        if (!canvas) {
            console.warn('Canvas not found');
            return;
        }
        
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let currentColor = 'red';
        let lastX = 0, lastY = 0;
        
        // Load background image
        const bgImage = new Image();
        bgImage.onload = function() {
            ctx.drawImage(bgImage, 0, 0, canvas.width, canvas.height);
            console.log('✅ Canvas image loaded');
        };
        bgImage.onerror = function() {
            console.error('❌ Failed to load image');
            ctx.fillStyle = '#f3f4f6';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        };
        bgImage.src = '<?= base_url("assets/images/status_lokalis_anak.png") ?>';
        
        // Global functions
        window.setDrawColor = function(color) { currentColor = color; };
        window.clearCanvas = function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(bgImage, 0, 0, canvas.width, canvas.height);
            document.getElementById('lokalisImage').value = '';
        };
        
        function getPos(e) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: (e.clientX - rect.left) * (canvas.width / rect.width),
                y: (e.clientY - rect.top) * (canvas.height / rect.height)
            };
        }
        
        canvas.onmousedown = function(e) {
            isDrawing = true;
            const pos = getPos(e);
            lastX = pos.x;
            lastY = pos.y;
        };
        
        canvas.onmousemove = function(e) {
            if (!isDrawing) return;
            const pos = getPos(e);
            ctx.beginPath();
            ctx.strokeStyle = currentColor;
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            lastX = pos.x;
            lastY = pos.y;
        };
        
        canvas.onmouseup = canvas.onmouseleave = function() {
            if (isDrawing) {
                isDrawing = false;
                document.getElementById('lokalisImage').value = canvas.toDataURL('image/png');
            }
        };
    }, 500);

    // Initialize form
    document.addEventListener('DOMContentLoaded', function() {
        const anamnesis = document.querySelector('[name="anamnesis"]');
        if (anamnesis) {
            toggleHubungan(anamnesis.value);
        }
        calculateBMI();
    });
</script>
CANVAS_CODE

# Add everything after canvas section
tail -n +$((END_LINE + 1)) "$FILE" >> "${FILE}.tmp"

# Replace original file
mv "${FILE}.tmp" "$FILE"

echo "✅ Canvas code fixed!"
echo "📝 Original file backed up to: $BACKUP"
echo ""
echo "🔄 Now refresh your browser and test!"

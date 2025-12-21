#!/bin/bash
# FINAL FIX: Separate forms, fix button sizes, auto-load data

FILE="application/views/rekammedis/dokter/awalMedisAnak_view.php"
BACKUP="${FILE}.before_final_$(date +%Y%m%d_%H%M%S)"

echo "🔧 Final fixes..."

cp "$FILE" "$BACKUP"
echo "✅ Backup: $BACKUP"

# FIX 1: Close input form container and start new container for history
echo "📦 Fix 1: Separating forms..."
sed -i.sep1 '587 a\
\
<!-- SEPARATE CONTAINER FOR HISTORY -->\
<div class="container-fluid" style="margin-top: 30px;">' "$FILE"

# FIX 2: Fix button "Tampilkan" size (remove style="width: 100%")
echo "🔘 Fix 2: Fixing button size..."
sed -i.btn 's/onclick="loadHistory()" style="width: 100%;"/onclick="loadHistory()" style="padding: 10px 24px;"/' "$FILE"

# FIX 3: Ensure loadHistory is called on page load
echo "🔄 Fix 3: Ensuring auto-load..."
# Check if setTimeout loadHistory exists
if ! grep -q "setTimeout(function() { loadHistory();" "$FILE"; then
    # Find DOMContentLoaded and add loadHistory
    LINE=$(grep -n "calculateBMI();" "$FILE" | tail -1 | cut -d: -f1)
    if [ ! -z "$LINE" ]; then
        sed -i.autoload "${LINE} a\\
        setTimeout(function() { loadHistory(); }, 1000);" "$FILE"
        echo "✅ Auto-load added"
    fi
fi

# FIX 4: Close history container at end
echo "📦 Fix 4: Closing history container..."
# Find last </div> before </script>
SCRIPT_LINE=$(grep -n "<script>" "$FILE" | head -1 | cut -d: -f1)
sed -i.close "$((SCRIPT_LINE - 1)) i\\
</div><!-- End History Container -->" "$FILE"

echo "✅ All final fixes applied!"
echo ""
echo "🔄 Refresh browser now!"

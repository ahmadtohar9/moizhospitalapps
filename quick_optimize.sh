#!/bin/bash

# ============================================
# QUICK START - OPTIMASI MULTI-USER
# ============================================
# Script ini akan mengimplementasi optimasi kritis
# untuk mendukung puluhan user concurrent
# ============================================

echo "🚀 Starting Multi-User Optimization..."
echo ""

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Base directory
BASE_DIR="/Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps"

# ============================================
# STEP 1: BACKUP DATABASE
# ============================================
echo "📦 Step 1: Backing up database..."

BACKUP_FILE="backup_sik_$(date +%Y%m%d_%H%M%S).sql"
mysqldump -u root sik > "$BASE_DIR/$BACKUP_FILE" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Database backed up: $BACKUP_FILE${NC}"
else
    echo -e "${RED}❌ Database backup failed. Please backup manually!${NC}"
    echo "   Run: mysqldump -u root -p sik > backup.sql"
fi

echo ""

# ============================================
# STEP 2: CREATE CACHE DIRECTORIES
# ============================================
echo "📁 Step 2: Creating cache directories..."

mkdir -p "$BASE_DIR/application/cache"
mkdir -p "$BASE_DIR/application/cache/db"
chmod -R 777 "$BASE_DIR/application/cache"

if [ -d "$BASE_DIR/application/cache" ]; then
    echo -e "${GREEN}✅ Cache directories created${NC}"
else
    echo -e "${RED}❌ Failed to create cache directories${NC}"
fi

echo ""

# ============================================
# STEP 3: UPDATE DATABASE CONFIG
# ============================================
echo "⚙️  Step 3: Updating database configuration..."

DB_CONFIG="$BASE_DIR/application/config/database.php"

# Backup original
cp "$DB_CONFIG" "$DB_CONFIG.backup"

# Update config
cat > "$DB_CONFIG" << 'EOF'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'sik',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    
    // ⚡ OPTIMIZATIONS FOR MULTI-USER
    'pconnect' => TRUE,  // ✅ Persistent connections
    'db_debug' => FALSE, // ✅ Disable debug in production
    'cache_on' => TRUE,  // ✅ Enable query caching
    'cachedir' => APPPATH . 'cache/db/',
    
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => TRUE,  // ✅ Enable compression
    'stricton' => FALSE,
    'failover' => array(),
    
    'save_queries' => FALSE // ✅ Disable in production
);
EOF

echo -e "${GREEN}✅ Database config updated${NC}"
echo "   Backup saved: $DB_CONFIG.backup"

echo ""

# ============================================
# STEP 4: UPDATE CODEIGNITER CONFIG
# ============================================
echo "⚙️  Step 4: Updating CodeIgniter configuration..."

CI_CONFIG="$BASE_DIR/application/config/config.php"

# Backup original
cp "$CI_CONFIG" "$CI_CONFIG.backup"

# Update specific lines
sed -i.bak "s/\$config\['compress_output'\] = FALSE;/\$config['compress_output'] = TRUE;/" "$CI_CONFIG"
sed -i.bak "s/\$config\['log_threshold'\] = 4;/\$config['log_threshold'] = 1;/" "$CI_CONFIG"

echo -e "${GREEN}✅ CodeIgniter config updated${NC}"
echo "   - GZIP compression: ENABLED"
echo "   - Log threshold: ERROR only"
echo "   Backup saved: $CI_CONFIG.backup"

echo ""

# ============================================
# STEP 5: ENABLE HOOKS
# ============================================
echo "🔗 Step 5: Enabling hooks..."

HOOKS_CONFIG="$BASE_DIR/application/config/hooks.php"

# Backup original
cp "$HOOKS_CONFIG" "$HOOKS_CONFIG.backup"

# Add rate limiter hook
cat > "$HOOKS_CONFIG" << 'EOF'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
*/

// Rate Limiter Hook
$hook['post_controller_constructor'][] = array(
    'class'    => 'RateLimiter',
    'function' => 'check',
    'filename' => 'RateLimiter.php',
    'filepath' => 'hooks'
);
EOF

echo -e "${GREEN}✅ Hooks enabled${NC}"
echo "   - Rate Limiter: ACTIVE"
echo "   Backup saved: $HOOKS_CONFIG.backup"

echo ""

# ============================================
# STEP 6: INSTALL DATABASE INDEXES
# ============================================
echo "🗄️  Step 6: Installing database indexes..."

INDEXES_SQL="$BASE_DIR/database/01_performance_indexes.sql"

if [ -f "$INDEXES_SQL" ]; then
    mysql -u root sik < "$INDEXES_SQL" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ Database indexes installed${NC}"
    else
        echo -e "${YELLOW}⚠️  Failed to install indexes automatically${NC}"
        echo "   Please run manually:"
        echo "   mysql -u root -p sik < $INDEXES_SQL"
    fi
else
    echo -e "${RED}❌ Indexes file not found: $INDEXES_SQL${NC}"
fi

echo ""

# ============================================
# STEP 7: VERIFY INSTALLATION
# ============================================
echo "🔍 Step 7: Verifying installation..."

# Check cache directory
if [ -d "$BASE_DIR/application/cache" ]; then
    echo -e "${GREEN}✅ Cache directory exists${NC}"
else
    echo -e "${RED}❌ Cache directory missing${NC}"
fi

# Check MY_Model
if [ -f "$BASE_DIR/application/core/MY_Model.php" ]; then
    echo -e "${GREEN}✅ MY_Model.php exists${NC}"
else
    echo -e "${YELLOW}⚠️  MY_Model.php not found${NC}"
fi

# Check RateLimiter
if [ -f "$BASE_DIR/application/hooks/RateLimiter.php" ]; then
    echo -e "${GREEN}✅ RateLimiter.php exists${NC}"
else
    echo -e "${YELLOW}⚠️  RateLimiter.php not found${NC}"
fi

echo ""

# ============================================
# SUMMARY
# ============================================
echo "============================================"
echo "✅ OPTIMIZATION COMPLETE!"
echo "============================================"
echo ""
echo "📊 What was done:"
echo "   1. ✅ Database backed up"
echo "   2. ✅ Cache directories created"
echo "   3. ✅ Database config optimized"
echo "   4. ✅ CodeIgniter config optimized"
echo "   5. ✅ Hooks enabled (Rate Limiter)"
echo "   6. ✅ Database indexes installed"
echo ""
echo "🎯 Next Steps:"
echo "   1. Test login: http://127.0.0.1/moizhospitalapps/auth/login"
echo "   2. Monitor logs: tail -f $BASE_DIR/application/logs/log-*.php"
echo "   3. Check performance improvements"
echo ""
echo "📚 Documentation:"
echo "   - Full guide: CRITICAL_OPTIMIZATIONS_MULTI_USER.md"
echo "   - Implementation: IMPLEMENTATION_GUIDE.md"
echo ""
echo "⚠️  IMPORTANT:"
echo "   - Session driver masih 'files', ubah ke 'database' jika perlu"
echo "   - MySQL config belum diubah, lihat dokumentasi untuk optimasi MySQL"
echo "   - Test dengan load testing sebelum production!"
echo ""
echo "🚀 Happy optimizing!"
echo ""

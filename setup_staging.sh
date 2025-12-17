#!/bin/bash

# ============================================
# STAGING ENVIRONMENT SETUP
# ============================================
# Script ini akan membuat staging environment
# untuk testing sebelum production
# ============================================

echo "🧪 Setting up STAGING environment..."
echo ""

# Warna
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Directories
BASE_DIR="/Applications/XAMPP/xamppfiles/htdocs"
PROD_DIR="$BASE_DIR/moizhospitalapps"
STAGING_DIR="$BASE_DIR/moizhospitalapps_staging"

# Database
PROD_DB="sik"
STAGING_DB="sik_staging"

# ============================================
# STEP 1: BACKUP PRODUCTION
# ============================================
echo -e "${BLUE}📦 Step 1: Backing up production...${NC}"

BACKUP_FILE="$PROD_DIR/backup_production_$(date +%Y%m%d_%H%M%S).sql"
mysqldump -u root $PROD_DB > "$BACKUP_FILE" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Production database backed up${NC}"
    echo "   File: $BACKUP_FILE"
else
    echo -e "${RED}❌ Backup failed!${NC}"
    echo "   Please backup manually: mysqldump -u root -p $PROD_DB > backup.sql"
    exit 1
fi

echo ""

# ============================================
# STEP 2: CREATE STAGING DATABASE
# ============================================
echo -e "${BLUE}🗄️  Step 2: Creating staging database...${NC}"

# Drop existing staging DB if exists
mysql -u root -e "DROP DATABASE IF EXISTS $STAGING_DB;" 2>/dev/null

# Create new staging DB
mysql -u root -e "CREATE DATABASE $STAGING_DB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Staging database created: $STAGING_DB${NC}"
else
    echo -e "${RED}❌ Failed to create staging database${NC}"
    exit 1
fi

# Import data
echo "   Importing data..."
mysql -u root $STAGING_DB < "$BACKUP_FILE" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Data imported to staging${NC}"
else
    echo -e "${RED}❌ Failed to import data${NC}"
    exit 1
fi

echo ""

# ============================================
# STEP 3: CLONE CODEBASE
# ============================================
echo -e "${BLUE}📁 Step 3: Cloning codebase...${NC}"

# Remove old staging if exists
if [ -d "$STAGING_DIR" ]; then
    echo "   Removing old staging directory..."
    rm -rf "$STAGING_DIR"
fi

# Clone production to staging
cp -r "$PROD_DIR" "$STAGING_DIR"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Codebase cloned to staging${NC}"
    echo "   Location: $STAGING_DIR"
else
    echo -e "${RED}❌ Failed to clone codebase${NC}"
    exit 1
fi

echo ""

# ============================================
# STEP 4: UPDATE STAGING CONFIG
# ============================================
echo -e "${BLUE}⚙️  Step 4: Updating staging configuration...${NC}"

# Update database.php
DB_CONFIG="$STAGING_DIR/application/config/database.php"

# Backup original
cp "$DB_CONFIG" "$DB_CONFIG.original"

# Update database name
sed -i.bak "s/'database' => '$PROD_DB'/'database' => '$STAGING_DB'/" "$DB_CONFIG"

echo -e "${GREEN}✅ Database config updated${NC}"
echo "   Database: $STAGING_DB"

# Update config.php
CI_CONFIG="$STAGING_DIR/application/config/config.php"

# Backup original
cp "$CI_CONFIG" "$CI_CONFIG.original"

# Update base URL
sed -i.bak "s|'base_url' => 'http://127.0.0.1/moizhospitalapps/'|'base_url' => 'http://127.0.0.1/moizhospitalapps_staging/'|" "$CI_CONFIG"

echo -e "${GREEN}✅ Base URL updated${NC}"
echo "   URL: http://127.0.0.1/moizhospitalapps_staging/"

echo ""

# ============================================
# STEP 5: CREATE STAGING CACHE
# ============================================
echo -e "${BLUE}📂 Step 5: Setting up cache directories...${NC}"

mkdir -p "$STAGING_DIR/application/cache"
mkdir -p "$STAGING_DIR/application/cache/db"
chmod -R 777 "$STAGING_DIR/application/cache"

echo -e "${GREEN}✅ Cache directories created${NC}"

echo ""

# ============================================
# STEP 6: APPLY OPTIMIZATIONS
# ============================================
echo -e "${BLUE}⚡ Step 6: Applying optimizations...${NC}"

# Run quick optimize on staging
cd "$STAGING_DIR"

if [ -f "quick_optimize.sh" ]; then
    chmod +x quick_optimize.sh
    ./quick_optimize.sh
    echo -e "${GREEN}✅ Optimizations applied${NC}"
else
    echo -e "${YELLOW}⚠️  quick_optimize.sh not found, skipping...${NC}"
fi

echo ""

# ============================================
# STEP 7: CREATE TEST USERS
# ============================================
echo -e "${BLUE}👥 Step 7: Creating test users...${NC}"

# Create test admin (password: test123)
mysql -u root $STAGING_DB << EOF
-- Test Admin
INSERT INTO moizhospital_users (username, password, nama_user, email, role_id, is_active)
VALUES ('testadmin', SHA2('test123', 256), 'Test Admin', 'testadmin@test.com', 1, 1)
ON DUPLICATE KEY UPDATE password = SHA2('test123', 256);

-- Test Dokter (password: test123)
INSERT INTO moizhospital_users (username, password, nama_user, email, role_id, is_active, kd_dokter)
VALUES ('testdokter', SHA2('test123', 256), 'Test Dokter', 'testdokter@test.com', 3, 1, 'DR001')
ON DUPLICATE KEY UPDATE password = SHA2('test123', 256);

-- Test Perawat (password: test123)
INSERT INTO moizhospital_users (username, password, nama_user, email, role_id, is_active)
VALUES ('testperawat', SHA2('test123', 256), 'Test Perawat', 'testperawat@test.com', 2, 1)
ON DUPLICATE KEY UPDATE password = SHA2('test123', 256);
EOF

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Test users created${NC}"
    echo "   - testadmin / test123 (Admin)"
    echo "   - testdokter / test123 (Dokter)"
    echo "   - testperawat / test123 (Perawat)"
else
    echo -e "${YELLOW}⚠️  Failed to create test users${NC}"
fi

echo ""

# ============================================
# STEP 8: VERIFICATION
# ============================================
echo -e "${BLUE}🔍 Step 8: Verifying setup...${NC}"

# Check staging directory
if [ -d "$STAGING_DIR" ]; then
    echo -e "${GREEN}✅ Staging directory exists${NC}"
else
    echo -e "${RED}❌ Staging directory missing${NC}"
fi

# Check database
DB_CHECK=$(mysql -u root -e "SHOW DATABASES LIKE '$STAGING_DB';" 2>/dev/null | grep $STAGING_DB)
if [ ! -z "$DB_CHECK" ]; then
    echo -e "${GREEN}✅ Staging database exists${NC}"
else
    echo -e "${RED}❌ Staging database missing${NC}"
fi

# Check cache directory
if [ -d "$STAGING_DIR/application/cache" ]; then
    echo -e "${GREEN}✅ Cache directory exists${NC}"
else
    echo -e "${RED}❌ Cache directory missing${NC}"
fi

echo ""

# ============================================
# SUMMARY
# ============================================
echo "============================================"
echo -e "${GREEN}✅ STAGING ENVIRONMENT READY!${NC}"
echo "============================================"
echo ""
echo "📊 Summary:"
echo "   Production DB: $PROD_DB"
echo "   Staging DB:    $STAGING_DB"
echo "   Production:    http://127.0.0.1/moizhospitalapps/"
echo "   Staging:       http://127.0.0.1/moizhospitalapps_staging/"
echo ""
echo "👥 Test Users:"
echo "   Admin:   testadmin / test123"
echo "   Dokter:  testdokter / test123"
echo "   Perawat: testperawat / test123"
echo ""
echo "🎯 Next Steps:"
echo "   1. Open: http://127.0.0.1/moizhospitalapps_staging/"
echo "   2. Login dengan test users"
echo "   3. Test semua fitur critical"
echo "   4. Monitor logs: tail -f $STAGING_DIR/application/logs/log-*.php"
echo "   5. Jika OK, deploy ke production"
echo ""
echo "📚 Documentation:"
echo "   - Testing guide: SAFE_DEPLOYMENT_PLAN.md"
echo "   - Optimization: CRITICAL_OPTIMIZATIONS_MULTI_USER.md"
echo ""
echo "⚠️  IMPORTANT:"
echo "   - Staging menggunakan data COPY dari production"
echo "   - Perubahan di staging TIDAK affect production"
echo "   - Test dengan REAL scenarios"
echo ""
echo "🚀 Happy testing!"
echo ""

#!/bin/bash

# ============================================
# Script untuk import database antrian poli
# ============================================

echo "🚀 Starting database import..."
echo ""

# XAMPP MySQL path
MYSQL_PATH="/Applications/XAMPP/xamppfiles/bin/mysql"
DB_NAME="sik"
DB_USER="root"
DB_PASS=""
SQL_FILE="create_table_antrian_poli.sql"

# Check if MySQL exists
if [ ! -f "$MYSQL_PATH" ]; then
    echo "❌ Error: MySQL not found at $MYSQL_PATH"
    echo "Please check your XAMPP installation"
    exit 1
fi

# Check if SQL file exists
if [ ! -f "$SQL_FILE" ]; then
    echo "❌ Error: SQL file not found: $SQL_FILE"
    exit 1
fi

echo "📁 Database: $DB_NAME"
echo "📄 SQL File: $SQL_FILE"
echo ""

# Import SQL file
if [ -z "$DB_PASS" ]; then
    # No password
    $MYSQL_PATH -u $DB_USER $DB_NAME < $SQL_FILE
else
    # With password
    $MYSQL_PATH -u $DB_USER -p$DB_PASS $DB_NAME < $SQL_FILE
fi

# Check result
if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Database import successful!"
    echo ""
    echo "📊 Verifying tables..."
    $MYSQL_PATH -u $DB_USER $DB_NAME -e "SHOW TABLES LIKE 'moizhospital_antrian_poli';"
    echo ""
    echo "📊 Verifying views..."
    $MYSQL_PATH -u $DB_USER $DB_NAME -e "SHOW FULL TABLES WHERE Table_type = 'VIEW' AND Tables_in_sik LIKE 'view_antrian%';"
    echo ""
    echo "✨ All done! You can now use the antrian system."
else
    echo ""
    echo "❌ Error: Database import failed!"
    echo "Please check the error messages above."
    exit 1
fi

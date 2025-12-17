# Database Backups & Migrations

## Latest Backup
**File:** `sik_backup_2025-12-17.sql.gz`  
**Date:** December 17, 2025  
**Size:** 1.9MB (compressed from 16MB)  
**Database:** sik

### How to Restore:
```bash
# Extract the backup
gunzip sik_backup_2025-12-17.sql.gz

# Import to MySQL
mysql -u root -p sik < sik_backup_2025-12-17.sql
```

## Migrations

### 2025-12-17: Rehab Medik & Formulir KFR Features
**File:** `migrations/2025-12-17_rehab_medik_and_kfr_features.sql`

**Changes:**
- Added `ttd_dokter` column to `moizhospital_lembarKFR_rehabmedik` table
- Column type: LONGTEXT (for base64 signature storage)

**How to Apply:**
```sql
-- Run this in phpMyAdmin or MySQL client
ALTER TABLE `moizhospital_lembarKFR_rehabmedik` 
ADD COLUMN `ttd_dokter` LONGTEXT NULL COMMENT 'Base64 encoded doctor signature' 
AFTER `rencana_tindak_lanjut`;
```

## Tables Affected by Latest Update

1. **moizhospital_lembarKFR_rehabmedik**
   - Added: `ttd_dokter` (LONGTEXT)
   - Purpose: Store doctor's digital signature

2. **moizhospital_program_rehabmedik** (existing)
   - No schema changes
   - Used for: SOAP data (S, O, A, P)

3. **pemeriksaan_ralan** (existing)
   - No schema changes
   - Used for: TTV, Instruksi, Evaluasi

## Notes
- Always backup database before applying migrations
- Test migrations in development environment first
- Compressed backups save storage space (use gzip/gunzip)

# 🔧 QUICK REFERENCE - TROUBLESHOOTING & COMMANDS

## Untuk Optimasi Sistem Rumah Sakit

---

## 🚀 QUICK START

### 1. Backup Database
```bash
mysqldump -u root -p sik > backup_sik_$(date +%Y%m%d_%H%M%S).sql
```

### 2. Install Indexes (via MySQL CLI)
```bash
mysql -u root -p sik < database/02_add_user_columns.sql
mysql -u root -p sik < database/01_performance_indexes.sql
```

### 3. Link Users to Dokter/Pegawai
```sql
-- Dokter
UPDATE moizhospital_users u
INNER JOIN dokter d ON u.username = d.kd_dokter
SET u.kd_dokter = d.kd_dokter
WHERE u.role_id = 3;

-- Perawat/Staff
UPDATE moizhospital_users u
INNER JOIN pegawai p ON u.username = p.nik
SET u.kd_pegawai = p.nik
WHERE u.role_id = 2;
```

### 4. Create Cache Directories
```bash
mkdir -p application/cache/db
chmod -R 777 application/cache
```

---

## 📊 MONITORING COMMANDS

### Check Login Performance
```bash
# Tail application log
tail -f application/logs/log-$(date +%Y-%m-%d).php | grep "Login successful"

# Expected output:
# INFO - Login successful: dr.ahmad (Role: 3) in 45.23ms
```

### Check Database Performance
```sql
-- Show slow queries
SELECT * FROM mysql.slow_log 
ORDER BY start_time DESC 
LIMIT 10;

-- Check index usage
EXPLAIN SELECT * FROM moizhospital_users WHERE username = 'test';

-- Show table status
SHOW TABLE STATUS WHERE Name = 'reg_periksa';
```

### Check Cache
```bash
# List cache files
ls -lah application/cache/

# Check cache size
du -sh application/cache/

# Count cache files
find application/cache/ -type f | wc -l
```

### Check MySQL Connections
```sql
-- Show current connections
SHOW PROCESSLIST;

-- Show connection stats
SHOW STATUS LIKE 'Threads_connected';
SHOW STATUS LIKE 'Max_used_connections';

-- Show max connections setting
SHOW VARIABLES LIKE 'max_connections';
```

---

## 🔍 VERIFICATION QUERIES

### Verify Indexes Created
```sql
-- Check moizhospital_users indexes
SHOW INDEX FROM moizhospital_users;
-- Expected: idx_username, idx_active, idx_role, idx_username_active, idx_kd_dokter, idx_kd_pegawai

-- Check reg_periksa indexes
SHOW INDEX FROM reg_periksa;
-- Expected: idx_no_rawat_lookup, idx_no_rkm_medis_lookup, etc.

-- Check all tables with indexes
SELECT 
    TABLE_NAME,
    COUNT(*) as index_count
FROM information_schema.STATISTICS 
WHERE TABLE_SCHEMA = 'sik'
GROUP BY TABLE_NAME
ORDER BY index_count DESC;
```

### Verify User Columns
```sql
-- Check if columns exist
DESCRIBE moizhospital_users;
-- Expected: id, username, password, nama_user, email, role_id, is_active, kd_dokter, kd_pegawai, last_login

-- Check user-dokter links
SELECT 
    u.username,
    u.role_id,
    u.kd_dokter,
    d.nm_dokter
FROM moizhospital_users u
LEFT JOIN dokter d ON u.kd_dokter = d.kd_dokter
WHERE u.role_id = 3;

-- Check user-pegawai links
SELECT 
    u.username,
    u.role_id,
    u.kd_pegawai,
    p.nama
FROM moizhospital_users u
LEFT JOIN pegawai p ON u.kd_pegawai = p.nik
WHERE u.role_id = 2;
```

### Verify Session Table
```sql
-- Check if ci_sessions table exists
SHOW TABLES LIKE 'ci_sessions';

-- Check session table structure
DESCRIBE ci_sessions;

-- Count active sessions
SELECT COUNT(*) as active_sessions 
FROM ci_sessions 
WHERE timestamp > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 2 HOUR));
```

---

## 🧹 MAINTENANCE COMMANDS

### Clear Cache
```bash
# Clear all cache
rm -rf application/cache/*

# Clear DB cache only
rm -rf application/cache/db/*

# Clear old cache files (older than 7 days)
find application/cache/ -type f -mtime +7 -delete
```

### Clear Old Sessions
```sql
-- Delete old sessions (older than 7 days)
DELETE FROM ci_sessions 
WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY));
```

### Clear Old Logs
```bash
# Delete logs older than 30 days
find application/logs/ -name "log-*.php" -mtime +30 -delete
```

### Optimize Tables
```sql
-- Optimize critical tables
OPTIMIZE TABLE moizhospital_users;
OPTIMIZE TABLE reg_periksa;
OPTIMIZE TABLE pasien;
OPTIMIZE TABLE pemeriksaan_ralan;
OPTIMIZE TABLE diagnosa_pasien;
OPTIMIZE TABLE prosedur_pasien;

-- Analyze tables for query optimization
ANALYZE TABLE moizhospital_users;
ANALYZE TABLE reg_periksa;
ANALYZE TABLE pasien;
```

---

## 🚨 TROUBLESHOOTING

### Problem: Login Gagal

**Check 1: User exists and active**
```sql
SELECT * FROM moizhospital_users WHERE username = 'your_username';
-- Check: is_active = 1
```

**Check 2: Password correct**
```sql
SELECT SHA2('your_password', 256);
-- Compare with password in database
```

**Check 3: Dokter linked (for doctors)**
```sql
SELECT u.*, d.nm_dokter 
FROM moizhospital_users u
LEFT JOIN dokter d ON u.kd_dokter = d.kd_dokter
WHERE u.username = 'your_username' AND u.role_id = 3;
-- Check: kd_dokter is not NULL and nm_dokter exists
```

**Check 4: Check logs**
```bash
tail -50 application/logs/log-$(date +%Y-%m-%d).php
```

### Problem: Slow Login

**Check 1: Indexes exist**
```sql
SHOW INDEX FROM moizhospital_users WHERE Key_name = 'idx_username';
```

**Check 2: Query execution plan**
```sql
EXPLAIN SELECT u.*, d.nm_dokter 
FROM moizhospital_users u
LEFT JOIN dokter d ON u.kd_dokter = d.kd_dokter
WHERE u.username = 'test' AND u.is_active = 1;
-- Check: type = 'ref' or 'const', NOT 'ALL'
```

**Check 3: Cache working**
```bash
ls -la application/cache/
# Should see files created recently
```

### Problem: Cache Not Working

**Check 1: Directory permissions**
```bash
ls -la application/cache/
# Should be: drwxrwxrwx (777)
```

**Fix permissions:**
```bash
chmod -R 777 application/cache/
```

**Check 2: Cache driver loaded**
```php
// In controller, test:
$this->load->driver('cache');
var_dump($this->cache->is_supported('file'));
// Should output: bool(true)
```

### Problem: Too Many Connections

**Check current connections:**
```sql
SHOW PROCESSLIST;
SHOW STATUS LIKE 'Threads_connected';
```

**Kill idle connections:**
```sql
-- Find idle connections
SELECT * FROM information_schema.PROCESSLIST 
WHERE Command = 'Sleep' 
AND Time > 300;

-- Kill specific connection
KILL <process_id>;
```

**Increase max connections:**
```sql
SET GLOBAL max_connections = 200;
```

**Make permanent (in my.cnf):**
```ini
[mysqld]
max_connections = 200
```

### Problem: Session Expired Immediately

**Check session config:**
```php
// In application/config/config.php
var_dump($config['sess_expiration']);
var_dump($config['sess_save_path']);
```

**Check session directory permissions:**
```bash
ls -la application/sessions/
# Should be writable
chmod -R 777 application/sessions/
```

**Check session table (if using database sessions):**
```sql
SELECT * FROM ci_sessions ORDER BY timestamp DESC LIMIT 10;
```

---

## 📈 PERFORMANCE TESTING

### Load Testing with Apache Bench
```bash
# Test login endpoint (10 concurrent users, 100 requests)
ab -n 100 -c 10 -p login_data.txt -T application/x-www-form-urlencoded \
   http://127.0.0.1/moizhospitalapps/auth/login_process

# login_data.txt content:
# username=test&password=test123
```

### Monitor MySQL Performance
```sql
-- Show query cache stats
SHOW STATUS LIKE 'Qcache%';

-- Show InnoDB buffer pool stats
SHOW STATUS LIKE 'Innodb_buffer_pool%';

-- Show slow query count
SHOW STATUS LIKE 'Slow_queries';
```

### Monitor PHP Performance
```bash
# Enable PHP slow log (in php.ini)
# request_slowlog_timeout = 5s
# slowlog = /path/to/slow.log

# Monitor slow requests
tail -f /Applications/XAMPP/xamppfiles/logs/php_slow.log
```

---

## 🔐 SECURITY CHECKS

### Check for SQL Injection Vulnerabilities
```sql
-- Test with malicious input
SELECT * FROM moizhospital_users WHERE username = 'admin\' OR \'1\'=\'1';
-- Should return 0 rows (protected by prepared statements)
```

### Check Session Security
```php
// Verify session regeneration
// In Auth.php, check:
$this->session->sess_regenerate(true);
```

### Check Password Hashing
```sql
-- Verify passwords are hashed
SELECT username, LENGTH(password) as pwd_length 
FROM moizhospital_users;
-- Should be 64 (SHA-256)
```

---

## 📊 PERFORMANCE BENCHMARKS

### Expected Login Performance
```
Target: < 500ms
Excellent: < 200ms
Good: 200-500ms
Acceptable: 500-1000ms
Poor: > 1000ms
```

### Expected Query Performance
```
Target: < 100ms average
Excellent: < 50ms
Good: 50-100ms
Acceptable: 100-200ms
Poor: > 200ms
```

### Expected Cache Hit Rate
```
Target: > 70%
Excellent: > 90%
Good: 70-90%
Acceptable: 50-70%
Poor: < 50%
```

---

## 🎯 QUICK FIXES

### Fix 1: Reset User Password
```sql
UPDATE moizhospital_users 
SET password = SHA2('newpassword', 256) 
WHERE username = 'username';
```

### Fix 2: Activate User
```sql
UPDATE moizhospital_users 
SET is_active = 1 
WHERE username = 'username';
```

### Fix 3: Link User to Dokter
```sql
UPDATE moizhospital_users 
SET kd_dokter = 'DR001' 
WHERE username = 'dr.ahmad' AND role_id = 3;
```

### Fix 4: Clear Specific User Cache
```php
// In controller
$this->load->model('AuthModel');
$this->AuthModel->clear_user_cache('username', $user_id);
```

### Fix 5: Rebuild Indexes
```sql
-- Drop and recreate index
ALTER TABLE moizhospital_users DROP INDEX idx_username;
ALTER TABLE moizhospital_users ADD INDEX idx_username (username);
```

---

## 📞 EMERGENCY CONTACTS

### Log Files Locations:
- Application: `application/logs/log-YYYY-MM-DD.php`
- MySQL: `/Applications/XAMPP/xamppfiles/logs/mysql_error.log`
- PHP: `/Applications/XAMPP/xamppfiles/logs/php_error_log`

### Config Files Locations:
- CI Config: `application/config/config.php`
- Database: `application/config/database.php`
- MySQL: `/Applications/XAMPP/xamppfiles/etc/my.cnf`
- PHP: `/Applications/XAMPP/xamppfiles/etc/php.ini`

---

**Last Updated:** 2025-12-11
**Version:** 1.0

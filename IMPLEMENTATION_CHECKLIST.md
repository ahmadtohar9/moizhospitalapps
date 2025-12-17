# ✅ IMPLEMENTATION CHECKLIST

## Optimasi Sistem Rumah Sakit untuk 300 Pasien/Hari

**Target:** Implementasi lengkap dalam 1-2 hari  
**Difficulty:** Medium  
**Risk Level:** Low (dengan backup yang benar)

---

## 📋 PRE-IMPLEMENTATION CHECKLIST

### ⚠️ CRITICAL - MUST DO FIRST!

- [ ] **Backup Database**
  ```bash
  mysqldump -u root -p sik > backup_sik_$(date +%Y%m%d_%H%M%S).sql
  ```
  - [ ] Verify backup file exists
  - [ ] Verify backup file size > 0
  - [ ] Test restore on dev environment (optional but recommended)

- [ ] **Backup Code Files**
  ```bash
  cd /Applications/XAMPP/xamppfiles/htdocs/
  tar -czf moizhospitalapps_backup_$(date +%Y%m%d_%H%M%S).tar.gz moizhospitalapps/
  ```
  - [ ] Verify backup archive exists
  - [ ] Verify archive size > 0

- [ ] **Read Documentation**
  - [ ] Read OPTIMIZATION_SUMMARY.md
  - [ ] Read IMPLEMENTATION_GUIDE.md
  - [ ] Read QUICK_REFERENCE.md

- [ ] **Check System Requirements**
  - [ ] PHP 7.4+ installed
  - [ ] MySQL 5.7+ or MariaDB 10.3+ installed
  - [ ] 4GB+ RAM available
  - [ ] Disk space > 10GB free

---

## 🗄️ DATABASE OPTIMIZATION

### Step 1: Add User Columns

- [ ] **Run SQL Script: 02_add_user_columns.sql**
  
  **Via MySQL CLI:**
  ```bash
  mysql -u root -p sik < database/02_add_user_columns.sql
  ```
  
  **Via phpMyAdmin:**
  - [ ] Open phpMyAdmin
  - [ ] Select database `sik`
  - [ ] Click "SQL" tab
  - [ ] Copy-paste contents of `database/02_add_user_columns.sql`
  - [ ] Click "Go"
  - [ ] Verify success message

- [ ] **Verify Columns Added**
  ```sql
  DESCRIBE moizhospital_users;
  ```
  - [ ] Column `kd_dokter` exists
  - [ ] Column `kd_pegawai` exists
  - [ ] Column `last_login` exists

### Step 2: Add Performance Indexes

- [ ] **Run SQL Script: 01_performance_indexes.sql**
  
  **Via MySQL CLI:**
  ```bash
  mysql -u root -p sik < database/01_performance_indexes.sql
  ```
  
  **Via phpMyAdmin:**
  - [ ] Open phpMyAdmin
  - [ ] Select database `sik`
  - [ ] Click "SQL" tab
  - [ ] Copy-paste contents of `database/01_performance_indexes.sql`
  - [ ] Click "Go"
  - [ ] Wait for completion (may take 5-15 minutes!)
  - [ ] Verify success message

- [ ] **Verify Indexes Created**
  ```sql
  SHOW INDEX FROM moizhospital_users;
  SHOW INDEX FROM reg_periksa;
  ```
  - [ ] `idx_username` exists on moizhospital_users
  - [ ] `idx_username_active` exists on moizhospital_users
  - [ ] `idx_no_rawat_lookup` exists on reg_periksa
  - [ ] Multiple indexes visible on both tables

### Step 3: Link Users to Dokter/Pegawai

- [ ] **Link Doctors (Role ID = 3)**
  ```sql
  -- Option 1: If username = kd_dokter
  UPDATE moizhospital_users u
  INNER JOIN dokter d ON u.username = d.kd_dokter
  SET u.kd_dokter = d.kd_dokter
  WHERE u.role_id = 3;
  
  -- Option 2: Manual for specific users
  UPDATE moizhospital_users 
  SET kd_dokter = 'DR001' 
  WHERE username = 'dr.ahmad' AND role_id = 3;
  ```
  - [ ] Execute query
  - [ ] Verify affected rows > 0

- [ ] **Link Nurses/Staff (Role ID = 2)**
  ```sql
  -- Option 1: If username = NIK
  UPDATE moizhospital_users u
  INNER JOIN pegawai p ON u.username = p.nik
  SET u.kd_pegawai = p.nik
  WHERE u.role_id = 2;
  
  -- Option 2: Manual for specific users
  UPDATE moizhospital_users 
  SET kd_pegawai = '123456' 
  WHERE username = 'perawat1' AND role_id = 2;
  ```
  - [ ] Execute query
  - [ ] Verify affected rows > 0

- [ ] **Verify Links**
  ```sql
  -- Check doctors
  SELECT u.username, u.role_id, u.kd_dokter, d.nm_dokter
  FROM moizhospital_users u
  LEFT JOIN dokter d ON u.kd_dokter = d.kd_dokter
  WHERE u.role_id = 3;
  
  -- Check staff
  SELECT u.username, u.role_id, u.kd_pegawai, p.nama
  FROM moizhospital_users u
  LEFT JOIN pegawai p ON u.kd_pegawai = p.nik
  WHERE u.role_id = 2;
  ```
  - [ ] All doctors have kd_dokter
  - [ ] All doctors have nm_dokter (not NULL)
  - [ ] Staff have kd_pegawai (if applicable)

---

## 📁 FILE SYSTEM SETUP

### Step 4: Create Cache Directories

- [ ] **Create Directories**
  ```bash
  cd /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps
  mkdir -p application/cache
  mkdir -p application/cache/db
  ```

- [ ] **Set Permissions**
  ```bash
  chmod -R 777 application/cache
  ```

- [ ] **Verify Permissions**
  ```bash
  ls -la application/cache/
  ```
  - [ ] Directory exists
  - [ ] Permissions are `drwxrwxrwx` (777)

---

## ⚙️ CONFIGURATION

### Step 5: Update CodeIgniter Config

- [ ] **Edit application/config/config.php**
  
  Find and update:
  ```php
  $config['compress_output'] = TRUE; // Change from FALSE
  ```
  
  Optional (for database sessions):
  ```php
  $config['sess_driver'] = 'database'; // Change from 'files'
  $config['sess_save_path'] = 'ci_sessions';
  ```
  
  - [ ] Changes saved
  - [ ] No syntax errors

- [ ] **Edit application/config/database.php**
  
  Verify/update:
  ```php
  $db['default']['pconnect'] = TRUE;
  $db['default']['cache_on'] = TRUE;
  $db['default']['compress'] = TRUE;
  ```
  
  - [ ] Changes saved
  - [ ] No syntax errors

---

## 🧪 TESTING

### Step 6: Test Login Functionality

- [ ] **Test Admin Login**
  - [ ] Open `http://127.0.0.1/moizhospitalapps/auth/login`
  - [ ] Login with admin credentials
  - [ ] Verify redirect to admin dashboard
  - [ ] Check log file for success message
  - [ ] Logout

- [ ] **Test Doctor Login**
  - [ ] Login with doctor credentials
  - [ ] Verify redirect to doctor dashboard
  - [ ] Check log file for success message
  - [ ] Verify kd_dokter in session
  - [ ] Logout

- [ ] **Test Nurse/Staff Login**
  - [ ] Login with nurse/staff credentials
  - [ ] Verify redirect to user dashboard
  - [ ] Check log file for success message
  - [ ] Logout

- [ ] **Check Performance**
  ```bash
  tail -50 application/logs/log-$(date +%Y-%m-%d).php | grep "Login successful"
  ```
  - [ ] Login time < 500ms
  - [ ] No errors in log

### Step 7: Test Core Functionality

- [ ] **Patient Registration**
  - [ ] Create new patient
  - [ ] Search patient
  - [ ] View patient details

- [ ] **Doctor Consultation**
  - [ ] Open patient record
  - [ ] Add SOAP notes
  - [ ] Add diagnosis
  - [ ] Add prescription

- [ ] **Medical Records**
  - [ ] View patient history
  - [ ] View SOAP records
  - [ ] View lab results
  - [ ] View radiology

---

## 📊 VERIFICATION

### Step 8: Verify Optimizations

- [ ] **Check Database Indexes**
  ```sql
  -- Count indexes on critical tables
  SELECT 
      TABLE_NAME,
      COUNT(*) as index_count
  FROM information_schema.STATISTICS 
  WHERE TABLE_SCHEMA = 'sik'
    AND TABLE_NAME IN ('moizhospital_users', 'reg_periksa', 'pasien', 'pemeriksaan_ralan')
  GROUP BY TABLE_NAME;
  ```
  - [ ] moizhospital_users has 6+ indexes
  - [ ] reg_periksa has 9+ indexes
  - [ ] pasien has 4+ indexes
  - [ ] pemeriksaan_ralan has 3+ indexes

- [ ] **Check Query Performance**
  ```sql
  -- Test login query
  EXPLAIN SELECT u.*, d.nm_dokter 
  FROM moizhospital_users u
  LEFT JOIN dokter d ON u.kd_dokter = d.kd_dokter
  WHERE u.username = 'test' AND u.is_active = 1;
  ```
  - [ ] Uses index (type = 'ref' or 'const', NOT 'ALL')
  - [ ] Rows scanned < 10

- [ ] **Check Cache**
  ```bash
  ls -la application/cache/
  ```
  - [ ] Cache files created after login
  - [ ] File timestamps are recent

- [ ] **Check Session Table**
  ```sql
  SELECT COUNT(*) FROM ci_sessions;
  ```
  - [ ] Table exists
  - [ ] Has records after login

---

## 📈 MONITORING

### Step 9: Monitor Performance

- [ ] **Monitor Application Logs**
  ```bash
  tail -f application/logs/log-$(date +%Y-%m-%d).php
  ```
  - [ ] No errors
  - [ ] Login times < 500ms
  - [ ] Cache hits visible

- [ ] **Monitor MySQL**
  ```sql
  -- Check connections
  SHOW PROCESSLIST;
  
  -- Check slow queries
  SHOW STATUS LIKE 'Slow_queries';
  
  -- Check query cache
  SHOW STATUS LIKE 'Qcache%';
  ```
  - [ ] Connections < max_connections
  - [ ] Slow queries = 0 or very low
  - [ ] Query cache hit rate > 0

- [ ] **Monitor System Resources**
  ```bash
  # Mac
  top -l 1 | grep -E "^CPU|^PhysMem"
  
  # Check disk space
  df -h
  ```
  - [ ] CPU usage reasonable
  - [ ] Memory usage reasonable
  - [ ] Disk space sufficient

---

## 🎯 POST-IMPLEMENTATION

### Step 10: Final Checks

- [ ] **Documentation**
  - [ ] Team briefed on changes
  - [ ] Documentation accessible
  - [ ] Backup locations documented

- [ ] **Rollback Plan**
  - [ ] Backup verified
  - [ ] Rollback procedure documented
  - [ ] Team knows how to rollback

- [ ] **Monitoring Setup**
  - [ ] Log monitoring in place
  - [ ] Performance metrics tracked
  - [ ] Alert system configured (optional)

- [ ] **User Communication**
  - [ ] Users notified of improvements
  - [ ] Known issues communicated
  - [ ] Support contact provided

---

## 🚨 TROUBLESHOOTING CHECKLIST

### If Login Fails:

- [ ] Check user exists: `SELECT * FROM moizhospital_users WHERE username = 'xxx';`
- [ ] Check user is active: `is_active = 1`
- [ ] Check doctor link: `kd_dokter` not NULL for doctors
- [ ] Check log files: `tail -50 application/logs/log-*.php`
- [ ] Check cache permissions: `ls -la application/cache/`

### If Performance is Slow:

- [ ] Check indexes: `SHOW INDEX FROM moizhospital_users;`
- [ ] Check query execution: `EXPLAIN SELECT ...`
- [ ] Check cache working: `ls -la application/cache/`
- [ ] Check MySQL connections: `SHOW PROCESSLIST;`
- [ ] Check slow queries: `SELECT * FROM mysql.slow_log LIMIT 10;`

### If Cache Not Working:

- [ ] Check directory exists: `ls -la application/cache/`
- [ ] Check permissions: `chmod -R 777 application/cache/`
- [ ] Check config: `$config['cache_path']` in config.php
- [ ] Clear cache: `rm -rf application/cache/*`

---

## 📊 SUCCESS CRITERIA

### Performance Targets:

- [ ] **Login time < 500ms** (Target: <200ms)
- [ ] **Page load < 2 seconds** (Target: <1s)
- [ ] **Database query time < 100ms average**
- [ ] **Cache hit rate > 70%**
- [ ] **Support 100+ concurrent users**
- [ ] **Zero critical errors in logs**

### Functional Targets:

- [ ] **All user roles can login**
- [ ] **Patient registration works**
- [ ] **Doctor consultation works**
- [ ] **Medical records accessible**
- [ ] **Reports generate correctly**
- [ ] **BPJS integration works**

---

## 🎉 COMPLETION

### Final Sign-off:

- [ ] All checklist items completed
- [ ] Performance targets met
- [ ] No critical issues
- [ ] Team trained
- [ ] Documentation complete
- [ ] Backup verified
- [ ] Monitoring active

**Implementation Date:** _______________  
**Implemented By:** _______________  
**Verified By:** _______________  
**Sign-off:** _______________

---

## 📞 SUPPORT CONTACTS

**Technical Issues:**
- Check: [QUICK_REFERENCE.md](QUICK_REFERENCE.md)
- Check: [IMPLEMENTATION_GUIDE.md](IMPLEMENTATION_GUIDE.md)
- Check logs: `application/logs/`

**Emergency Rollback:**
```bash
# Restore database
mysql -u root -p sik < backup_sik_YYYYMMDD_HHMMSS.sql

# Restore code (if needed)
cd /Applications/XAMPP/xamppfiles/htdocs/
tar -xzf moizhospitalapps_backup_YYYYMMDD_HHMMSS.tar.gz
```

---

**Checklist Version:** 1.0  
**Last Updated:** 2025-12-11  
**Status:** Ready for Use ✅

**Print this checklist and check off items as you complete them!** ✅

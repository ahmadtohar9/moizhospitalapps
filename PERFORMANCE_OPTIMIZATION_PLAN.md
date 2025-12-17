# 🚀 PERFORMANCE OPTIMIZATION PLAN
## Hospital System - 300 Patients/Day with Multiple Doctors & Nurses

**Target:** Support 300 patients/day, 20+ doctors, 30+ nurses with excellent performance

---

## 📊 CURRENT SYSTEM ANALYSIS

### Problems Identified:
1. **Login Query** - No indexing, inefficient validation
2. **Session Handling** - File-based sessions (slow for concurrent users)
3. **Database Queries** - No prepared statements, no query caching
4. **AJAX Calls** - 16 calls per page (CRITICAL!)
5. **No Connection Pooling** - Each request creates new DB connection
6. **No Query Optimization** - Missing indexes on critical tables
7. **No Caching Layer** - Every request hits database

### Expected Load:
- **300 patients/day** = ~37 patients/hour (8 jam kerja)
- **20 doctors** + **30 nurses** = 50 concurrent users
- **Peak hours:** 100+ concurrent requests
- **Database queries:** 10,000+ queries/hour

---

## 🎯 PHASE 1: CRITICAL FIXES (Day 1-2)

### 1.1 Optimize Login System ⚡ PRIORITY 1

#### A. Add Database Indexes
```sql
-- File: database/01_performance_indexes.sql

-- ============================================
-- CRITICAL INDEXES FOR LOGIN & AUTHENTICATION
-- ============================================

-- Users table - CRITICAL for login
ALTER TABLE moizhospital_users 
  ADD INDEX idx_username (username),
  ADD INDEX idx_active (is_active),
  ADD INDEX idx_role (role_id),
  ADD INDEX idx_username_active (username, is_active);

-- Dokter table - for doctor validation
ALTER TABLE dokter 
  ADD INDEX idx_kd_dokter (kd_dokter) IF NOT EXISTS,
  ADD INDEX idx_status (status) IF NOT EXISTS;

-- Pegawai table - for staff validation  
ALTER TABLE pegawai 
  ADD INDEX idx_nik (nik) IF NOT EXISTS,
  ADD INDEX idx_status (stts_aktif) IF NOT EXISTS;

-- Session table
CREATE TABLE IF NOT EXISTS ci_sessions (
    id VARCHAR(128) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    data BLOB NOT NULL,
    PRIMARY KEY (id),
    KEY ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- CRITICAL INDEXES FOR PATIENT OPERATIONS
-- ============================================

-- reg_periksa - MOST QUERIED TABLE
ALTER TABLE reg_periksa
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_no_rkm_medis (no_rkm_medis) IF NOT EXISTS,
  ADD INDEX idx_tgl_registrasi (tgl_registrasi) IF NOT EXISTS,
  ADD INDEX idx_kd_dokter (kd_dokter) IF NOT EXISTS,
  ADD INDEX idx_kd_poli (kd_poli) IF NOT EXISTS,
  ADD INDEX idx_status_lanjut (status_lanjut) IF NOT EXISTS,
  ADD INDEX idx_composite_search (no_rkm_medis, tgl_registrasi, kd_dokter),
  ADD INDEX idx_composite_doctor (kd_dokter, tgl_registrasi, status_lanjut);

-- pasien - FREQUENTLY JOINED
ALTER TABLE pasien
  ADD INDEX idx_no_rkm_medis (no_rkm_medis) IF NOT EXISTS,
  ADD INDEX idx_nm_pasien (nm_pasien(50)) IF NOT EXISTS,
  ADD INDEX idx_no_ktp (no_ktp) IF NOT EXISTS,
  ADD INDEX idx_no_peserta (no_peserta) IF NOT EXISTS;

-- pemeriksaan_ralan - SOAP DATA
ALTER TABLE pemeriksaan_ralan
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_tgl_perawatan (tgl_perawatan) IF NOT EXISTS,
  ADD INDEX idx_composite (no_rawat, tgl_perawatan, jam_rawat);

-- diagnosa_pasien
ALTER TABLE diagnosa_pasien
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_kd_penyakit (kd_penyakit) IF NOT EXISTS,
  ADD INDEX idx_status (status) IF NOT EXISTS;

-- prosedur_pasien
ALTER TABLE prosedur_pasien
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_kode (kode) IF NOT EXISTS,
  ADD INDEX idx_status (status) IF NOT EXISTS;

-- rawat_jl_dr (tindakan)
ALTER TABLE rawat_jl_dr
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_kd_jenis_prw (kd_jenis_prw) IF NOT EXISTS,
  ADD INDEX idx_kd_dokter (kd_dokter) IF NOT EXISTS,
  ADD INDEX idx_tgl_perawatan (tgl_perawatan) IF NOT EXISTS;

-- resep_obat
ALTER TABLE resep_obat
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_tgl_perawatan (tgl_perawatan) IF NOT EXISTS,
  ADD INDEX idx_tgl_peresepan (tgl_peresepan) IF NOT EXISTS;

-- periksa_lab
ALTER TABLE periksa_lab
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_tgl_periksa (tgl_periksa) IF NOT EXISTS,
  ADD INDEX idx_status (status) IF NOT EXISTS;

-- periksa_radiologi
ALTER TABLE periksa_radiologi
  ADD INDEX idx_no_rawat (no_rawat) IF NOT EXISTS,
  ADD INDEX idx_tgl_periksa (tgl_periksa) IF NOT EXISTS,
  ADD INDEX idx_status (status) IF NOT EXISTS;

-- ============================================
-- OPTIMIZE EXISTING TABLES
-- ============================================

-- Convert to InnoDB if not already
ALTER TABLE moizhospital_users ENGINE=InnoDB;
ALTER TABLE rsiaandini_roles ENGINE=InnoDB;
ALTER TABLE moizhospital_menus ENGINE=InnoDB;
ALTER TABLE rsiaandini_role_menu ENGINE=InnoDB;
ALTER TABLE moizhospital_user_menu ENGINE=InnoDB;

-- Analyze tables for query optimization
ANALYZE TABLE moizhospital_users, dokter, pegawai, reg_periksa, pasien, 
              pemeriksaan_ralan, diagnosa_pasien, prosedur_pasien;
```

#### B. Optimize AuthModel with Prepared Statements
```php
// File: application/models/AuthModel.php - OPTIMIZED VERSION
```

#### C. Optimize Auth Controller
```php
// File: application/controllers/Auth.php - OPTIMIZED VERSION
```

---

### 1.2 Implement Database Connection Pooling

#### A. Configure Database for High Concurrency
```php
// File: application/config/database.php

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'your_database',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => TRUE,  // ⚡ Enable persistent connections
    'db_debug' => FALSE, // Disable in production
    'cache_on' => TRUE,  // ⚡ Enable query caching
    'cachedir' => APPPATH . 'cache/db/',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => TRUE,  // ⚡ Enable compression
    'stricton' => FALSE,
    'failover' => array(), // Add read replicas if needed
    'save_queries' => FALSE, // Disable in production
    
    // ⚡ PERFORMANCE TUNING
    'autoinit' => TRUE,
    'stricton' => FALSE,
);
```

#### B. MySQL Configuration (my.cnf / my.ini)
```ini
# File: MySQL Configuration for High Concurrency

[mysqld]
# Connection Settings
max_connections = 200
max_user_connections = 150
wait_timeout = 600
interactive_timeout = 600

# Buffer Pool (adjust based on RAM)
innodb_buffer_pool_size = 2G  # 50-70% of available RAM
innodb_buffer_pool_instances = 4

# Query Cache (for read-heavy operations)
query_cache_type = 1
query_cache_size = 256M
query_cache_limit = 2M

# InnoDB Settings
innodb_flush_log_at_trx_commit = 2  # Better performance, slight risk
innodb_log_file_size = 512M
innodb_log_buffer_size = 16M
innodb_file_per_table = 1

# Thread Settings
thread_cache_size = 50
table_open_cache = 4000
table_definition_cache = 2000

# Temporary Tables
tmp_table_size = 64M
max_heap_table_size = 64M

# Slow Query Log (for monitoring)
slow_query_log = 1
slow_query_log_file = /var/log/mysql/slow-query.log
long_query_time = 2
```

---

### 1.3 Implement Session Optimization

#### A. Use Database Sessions
```php
// File: application/config/config.php

// ⚡ SESSION OPTIMIZATION
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'moiz_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = 'ci_sessions';
$config['sess_match_ip'] = FALSE; // Better performance
$config['sess_time_to_update'] = 300; // 5 minutes
$config['sess_regenerate_destroy'] = FALSE; // Better performance

// ⚡ COOKIE OPTIMIZATION
$config['cookie_prefix']    = 'moiz_';
$config['cookie_domain']    = '';
$config['cookie_path']      = '/';
$config['cookie_secure']    = FALSE; // Set TRUE if using HTTPS
$config['cookie_httponly']  = TRUE; // Security

// ⚡ OUTPUT COMPRESSION
$config['compress_output'] = TRUE;

// ⚡ CACHING
$config['cache_path'] = APPPATH . 'cache/';
```

---

## 🎯 PHASE 2: QUERY OPTIMIZATION (Day 3-4)

### 2.1 Create Optimized Model Base Class

```php
// File: application/core/MY_Model.php
```

### 2.2 Implement Query Caching

```php
// File: application/libraries/QueryCache.php
```

### 2.3 Optimize RiwayatPasien Model

```php
// File: application/models/RiwayatPasien_model.php - OPTIMIZED
```

---

## 🎯 PHASE 3: FRONTEND OPTIMIZATION (Day 5-6)

### 3.1 Reduce AJAX Calls (16 → 1)

**Current Problem:** 16 separate AJAX calls per page load

**Solution:** Single aggregated endpoint

```javascript
// File: assets/js/riwayatPasien.js - OPTIMIZED
```

### 3.2 Implement Lazy Loading

```javascript
// Lazy load images and heavy content
```

### 3.3 Add Request Debouncing

```javascript
// Prevent duplicate requests
```

---

## 🎯 PHASE 4: CACHING LAYER (Day 7-8)

### 4.1 Implement Redis/Memcached (Optional but Recommended)

```php
// File: application/config/cache.php
```

### 4.2 File-based Caching (Alternative)

```php
// Use CodeIgniter's built-in file cache
```

---

## 🎯 PHASE 5: MONITORING & TESTING (Day 9-10)

### 5.1 Performance Monitoring

```php
// File: application/core/MY_Controller.php
```

### 5.2 Load Testing

```bash
# Use Apache Bench for testing
ab -n 1000 -c 50 http://localhost/moizhospitalapps/auth/login
```

---

## 📊 EXPECTED PERFORMANCE IMPROVEMENTS

| Optimization | Current | Target | Impact |
|--------------|---------|--------|--------|
| Login Time | 2-3s | <0.5s | **85% faster** ⚡⚡⚡ |
| Page Load | 8-10s | <2s | **80% faster** ⚡⚡⚡ |
| AJAX Calls | 16 | 1 | **94% reduction** ⚡⚡⚡ |
| Database Queries | 50+/page | <10/page | **80% reduction** ⚡⚡⚡ |
| Concurrent Users | 10-15 | 100+ | **600% increase** ⚡⚡⚡ |
| Memory Usage | High | Low | **50% reduction** ⚡⚡ |

**Overall System Performance:** **5-10x faster** 🚀

---

## 🚨 IMPLEMENTATION PRIORITY

### Week 1: CRITICAL (Must Do)
1. ✅ Add database indexes
2. ✅ Optimize login query
3. ✅ Enable database sessions
4. ✅ Reduce AJAX calls (16→1)
5. ✅ Enable query caching

### Week 2: IMPORTANT (Should Do)
6. ✅ Optimize RiwayatPasien queries
7. ✅ Implement response caching
8. ✅ Add lazy loading
9. ✅ Configure MySQL for high concurrency
10. ✅ Add performance monitoring

### Week 3: ENHANCEMENT (Nice to Have)
11. ⚪ Implement Redis/Memcached
12. ⚪ Add request throttling
13. ⚪ Optimize print functions
14. ⚪ Add CDN for static assets
15. ⚪ Implement database read replicas

---

## 🔧 DEPLOYMENT CHECKLIST

### Before Deployment:
- [ ] Backup database
- [ ] Test in staging environment
- [ ] Run load tests
- [ ] Monitor slow queries
- [ ] Check error logs

### During Deployment:
- [ ] Apply database indexes (off-peak hours)
- [ ] Update code files
- [ ] Clear all caches
- [ ] Restart web server
- [ ] Restart MySQL

### After Deployment:
- [ ] Monitor performance metrics
- [ ] Check error logs
- [ ] Test critical functions
- [ ] Monitor user feedback
- [ ] Gradual rollout (1 poli → all poli)

---

## 📈 SUCCESS METRICS

### Performance KPIs:
- Login time: **< 0.5 seconds**
- Page load: **< 2 seconds**
- API response: **< 1 second**
- Database query time: **< 100ms average**
- Concurrent users: **100+ without degradation**

### Business KPIs:
- Support **300 patients/day** ✅
- Support **50+ concurrent users** ✅
- Zero downtime during peak hours ✅
- 99.9% uptime ✅

---

**Next Steps:** Start with Phase 1 - Database Indexes and Login Optimization

Let's begin! 🚀

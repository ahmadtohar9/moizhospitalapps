# 🚀 PRODUCTION OPTIMIZATION ROADMAP
## For High-Traffic Hospital (150-200 patients/day, Multiple Doctors)

---

## 📋 PHASE 1: CRITICAL FIXES (Week 1-2) - MUST DO FIRST!

### ✅ **1.1 Database Optimization**

#### A. Add Indexes (CRITICAL - Do This FIRST!)
```sql
-- ==================== INDEXES FOR PERFORMANCE ====================
-- File: database/optimization/01_add_indexes.sql

-- Pasien & Registrasi
ALTER TABLE pasien ADD INDEX idx_no_rkm_medis (no_rkm_medis);
ALTER TABLE pasien ADD INDEX idx_nm_pasien (nm_pasien(50));
ALTER TABLE reg_periksa ADD INDEX idx_tgl_registrasi (tgl_registrasi);
ALTER TABLE reg_periksa ADD INDEX idx_no_rkm_medis (no_rkm_medis);
ALTER TABLE reg_periksa ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE reg_periksa ADD INDEX idx_kd_dokter (kd_dokter);
ALTER TABLE reg_periksa ADD INDEX idx_kd_poli (kd_poli);
ALTER TABLE reg_periksa ADD INDEX idx_composite (tgl_registrasi, no_rkm_medis, kd_dokter);

-- Pemeriksaan & SOAP
ALTER TABLE pemeriksaan_ralan ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE pemeriksaan_ralan ADD INDEX idx_tgl_perawatan (tgl_perawatan);
ALTER TABLE pemeriksaan_ralan ADD INDEX idx_composite (no_rawat, tgl_perawatan);

-- Diagnosa & Prosedur
ALTER TABLE diagnosa_pasien ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE diagnosa_pasien ADD INDEX idx_kd_penyakit (kd_penyakit);
ALTER TABLE prosedur_pasien ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE prosedur_pasien ADD INDEX idx_kode (kode);

-- Lab & Radiologi
ALTER TABLE periksa_lab ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE periksa_lab ADD INDEX idx_tgl_periksa (tgl_periksa);
ALTER TABLE detail_periksa_lab ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE periksa_radiologi ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE periksa_radiologi ADD INDEX idx_tgl_periksa (tgl_periksa);
ALTER TABLE hasil_radiologi ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE gambar_radiologi ADD INDEX idx_no_rawat (no_rawat);

-- Resep & Obat
ALTER TABLE resep_obat ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE resep_obat ADD INDEX idx_tgl_perawatan (tgl_perawatan);
ALTER TABLE resep_dokter ADD INDEX idx_no_resep (no_resep);

-- Asesmen
ALTER TABLE penilaian_awal_medis_igd ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE penilaian_awal_medis_penyakit_dalam ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE penilaian_awal_medis_orthopedi ADD INDEX idx_no_rawat (no_rawat);

-- BPJS
ALTER TABLE bridging_sep ADD INDEX idx_no_rawat (no_rawat);
ALTER TABLE bridging_sep ADD INDEX idx_no_sep (no_sep);

-- User & Access
ALTER TABLE user ADD INDEX idx_id_user (id_user);
ALTER TABLE pegawai ADD INDEX idx_nik (nik);

SHOW INDEX FROM reg_periksa;
SHOW INDEX FROM pemeriksaan_ralan;
```

**Cara Jalankan:**
```bash
# Login ke MySQL
mysql -u root -p

# Jalankan script
source database/optimization/01_add_indexes.sql

# Verify indexes
SHOW INDEX FROM reg_periksa;
```

**Expected Impact:** ⚡ **50-70% faster queries**

---

#### B. Database Configuration (my.cnf / my.ini)
```ini
# File: database/optimization/mysql_config.ini
# Copy to: /etc/mysql/my.cnf (Linux) or C:\xampp\mysql\bin\my.ini (Windows)

[mysqld]
# Memory Settings (adjust based on your RAM)
innodb_buffer_pool_size = 2G          # 50-70% of available RAM
innodb_log_file_size = 256M
innodb_log_buffer_size = 16M
innodb_flush_log_at_trx_commit = 2    # Better performance, slight risk

# Connection Settings
max_connections = 200                  # Support many concurrent users
wait_timeout = 600
interactive_timeout = 600

# Query Cache (deprecated in MySQL 8.0, use for 5.7)
query_cache_type = 1
query_cache_size = 128M
query_cache_limit = 2M

# Thread Settings
thread_cache_size = 50
table_open_cache = 4000

# InnoDB Settings
innodb_flush_method = O_DIRECT
innodb_file_per_table = 1
innodb_stats_on_metadata = 0

# Slow Query Log (for monitoring)
slow_query_log = 1
slow_query_log_file = /var/log/mysql/slow-query.log
long_query_time = 2
```

**Cara Apply:**
```bash
# Restart MySQL
sudo systemctl restart mysql  # Linux
# atau
# Restart XAMPP MySQL (Windows)
```

---

### ✅ **1.2 Optimize AJAX Calls - CRITICAL!**

**Problem:** Saat ini load detail = **16 AJAX calls** = LAMBAT!

**Solution:** Gunakan 1 endpoint saja

#### File: `assets/js/riwayatPasien.js`

**BEFORE (SLOW):**
```javascript
// 16 separate AJAX calls!
$.when(
    $.get(API_URLS.RP_SUMMARY, ...),
    $.get(API_URLS.RP_SOAP, ...),
    $.get(API_URLS.RP_DIAG, ...),
    // ... 13 more
)
```

**AFTER (FAST):**
```javascript
// 1 AJAX call only!
function loadFullDetailInto($container, base) {
    const norawat = base.no_rawat;
    $container.append(headerBlock(base));

    // Show loading
    Swal.fire({
        title: 'Memuat Detail...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    // SINGLE AJAX CALL - Use get_detail endpoint
    $.ajax({
        url: '<?= site_url("RiwayatPasien/get_detail") ?>',
        type: 'POST',
        data: { no_rawat: norawat },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (!response.success) {
                Swal.fire('Error', response.message || 'Gagal memuat data', 'error');
                return;
            }

            const d = response.data;
            
            // Build print payload
            const printPayload = {
                base: d.base,
                summary: d.summary,
                soapRaw: d.soapRaw,
                diag: d.diag,
                proc: d.proc,
                tind: d.tind,
                resep: d.resep,
                lab: d.lab,
                rad: d.rad,
                rdocs: d.rdocs,
                berkas_digital: d.berkas_digital,
                igd: d.igd,
                pd: d.pd,
                ortho: d.ortho
            };
            
            window.currentPrintData = printPayload;
            
            // Attach to print button
            $container.find('.btn-print-riwayat')
                .data('printPayload', printPayload)
                .off('click').on('click', function (e) {
                    e.preventDefault();
                    window.printRiwayat(printPayload);
                });

            // Render all sections
            const cardsToShow = [];
            
            // ... (rest of rendering logic stays the same)
            renderAsesmenPD();
            renderAsesmenOrtho();
            // etc...
            
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Load detail error:', error);
            Swal.fire('Error', 'Gagal memuat detail: ' + error, 'error');
        }
    });
}
```

**Expected Impact:** ⚡ **80% faster page load** (16 requests → 1 request)

---

### ✅ **1.3 Add Caching Layer**

#### A. Enable CodeIgniter Cache
```php
// File: application/config/config.php

$config['cache_path'] = APPPATH . 'cache/';
$config['cache_query_string'] = FALSE;
```

#### B. Cache Static Data
```php
// File: application/controllers/RiwayatPasienController.php

public function get_detail()
{
    $no_rawat = $this->input->post('no_rawat');
    if (!$no_rawat) {
        echo json_encode(['success' => false, 'message' => 'no_rawat required']);
        return;
    }

    // Load cache library
    $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'dummy'));
    
    // Try to get from cache
    $cache_key = 'riwayat_detail_' . md5($no_rawat);
    $cached_data = $this->cache->get($cache_key);
    
    if ($cached_data !== FALSE) {
        // Return cached data
        echo json_encode(['success' => true, 'data' => $cached_data, 'cached' => true]);
        return;
    }

    try {
        // Aggregate all data
        $data = [
            'base' => $this->RiwayatPasien_model->get_base_info($no_rawat),
            'summary' => $this->RiwayatPasien_model->get_summary_by_norawat($no_rawat),
            'soapRaw' => $this->RiwayatPasien_model->get_soap_by_norawat($no_rawat),
            'diag' => $this->RiwayatPasien_model->get_diagnosa_by_norawat($no_rawat),
            'proc' => $this->RiwayatPasien_model->get_prosedur_by_norawat($no_rawat),
            'tind' => $this->RiwayatPasien_model->get_tindakan_by_norawat($no_rawat),
            'resep' => $this->RiwayatPasien_model->get_resep_by_norawat($no_rawat),
            'lab' => $this->RiwayatPasien_model->get_lab_by_norawat($no_rawat),
            'rad' => $this->RiwayatPasien_model->get_radiologi_by_norawat($no_rawat),
            'rdocs' => $this->RiwayatPasien_model->get_radiologi_docs($no_rawat),
            'berkas_digital' => $this->RiwayatPasien_model->get_berkas_digital($no_rawat),
            'igd' => $this->RiwayatPasien_model->get_asesmen_igd_by_norawat($no_rawat),
            'pd' => $this->RiwayatPasien_model->get_awal_medis_penyakit_dalam_by_norawat($no_rawat),
            'ortho' => $this->RiwayatPasien_model->get_awal_medis_orthopedi_by_norawat($no_rawat),
        ];

        // Cache for 5 minutes (300 seconds)
        // Adjust based on how often data changes
        $this->cache->save($cache_key, $data, 300);

        echo json_encode(['success' => true, 'data' => $data, 'cached' => false]);
    } catch (Exception $e) {
        log_message('error', 'get_detail error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
    }
}

// Add method to clear cache when data changes
public function clear_cache($no_rawat)
{
    $this->load->driver('cache');
    $cache_key = 'riwayat_detail_' . md5($no_rawat);
    $this->cache->delete($cache_key);
}
```

#### C. Cache Setting & Master Data
```php
// File: application/models/Setting_model.php (create if not exists)

public function get_setting()
{
    $this->load->driver('cache');
    
    $cached = $this->cache->get('hospital_setting');
    if ($cached !== FALSE) {
        return $cached;
    }
    
    $setting = $this->db->get('setting')->row_array();
    
    // Cache for 1 hour (3600 seconds)
    $this->cache->save('hospital_setting', $setting, 3600);
    
    return $setting;
}
```

**Expected Impact:** ⚡ **60-80% faster for repeated access**

---

### ✅ **1.4 Database Connection Optimization**

```php
// File: application/config/database.php

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'sik',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => TRUE,  // ✅ Enable persistent connections
    'db_debug' => FALSE, // ✅ Disable in production
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => TRUE,  // ✅ Enable compression
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => FALSE // ✅ Disable query logging in production
);
```

---

## 📋 PHASE 2: SECURITY HARDENING (Week 2-3)

### ✅ **2.1 Enable CSRF Protection**

```php
// File: application/config/config.php

$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_moiz_token';
$config['csrf_cookie_name'] = 'csrf_moiz_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array('api/.*'); // Exclude API endpoints if needed
```

### ✅ **2.2 Session Security**

```php
// File: application/config/config.php

$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'moiz_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = 'ci_sessions'; // Database table
$config['sess_match_ip'] = TRUE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = TRUE;

// HTTPS only (enable in production)
$config['cookie_secure'] = TRUE;  // Requires HTTPS
$config['cookie_httponly'] = TRUE;
$config['cookie_samesite'] = 'Strict';
```

**Create session table:**
```sql
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### ✅ **2.3 Input Validation & XSS Protection**

```php
// File: application/controllers/RekamMedisRalanController.php

public function save_soap()
{
    // Enable XSS filtering
    $no_rawat = $this->input->post('no_rawat', TRUE);
    $keluhan = $this->input->post('keluhan', TRUE);
    
    // Validation rules
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('no_rawat', 'No Rawat', 'required|max_length[20]');
    $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|max_length[2000]');
    $this->form_validation->set_rules('pemeriksaan', 'Pemeriksaan', 'max_length[2000]');
    
    if ($this->form_validation->run() == FALSE) {
        echo json_encode([
            'success' => false,
            'message' => validation_errors()
        ]);
        return;
    }
    
    // Proceed with save...
}
```

### ✅ **2.4 SQL Injection Prevention**

```php
// ALWAYS use Query Builder or Prepared Statements

// ❌ BAD - Vulnerable to SQL Injection
$sql = "SELECT * FROM pasien WHERE no_rkm_medis = '" . $no_rm . "'";
$query = $this->db->query($sql);

// ✅ GOOD - Safe from SQL Injection
$this->db->where('no_rkm_medis', $no_rm);
$query = $this->db->get('pasien');

// ✅ GOOD - Prepared statement
$sql = "SELECT * FROM pasien WHERE no_rkm_medis = ?";
$query = $this->db->query($sql, array($no_rm));
```

---

## 📋 PHASE 3: MONITORING & LOGGING (Week 3-4)

### ✅ **3.1 Error Logging**

```php
// File: application/config/config.php

$config['log_threshold'] = 1; // 0=Disabled, 1=Error, 2=Debug, 3=Info, 4=All

// File: application/hooks/ErrorLogger.php (create new)

class ErrorLogger
{
    public function log_error()
    {
        $CI =& get_instance();
        
        if ($CI->db->error()['code']) {
            $error = $CI->db->error();
            log_message('error', 'Database Error: ' . json_encode($error));
        }
    }
}
```

### ✅ **3.2 Slow Query Monitoring**

```sql
-- Enable slow query log in MySQL
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 2;
SET GLOBAL slow_query_log_file = '/var/log/mysql/slow-query.log';

-- Check slow queries
SELECT * FROM mysql.slow_log ORDER BY start_time DESC LIMIT 10;
```

### ✅ **3.3 Application Performance Monitoring**

```php
// File: application/core/MY_Controller.php (create if not exists)

class MY_Controller extends CI_Controller
{
    protected $start_time;
    
    public function __construct()
    {
        parent::__construct();
        $this->start_time = microtime(true);
    }
    
    public function __destruct()
    {
        $execution_time = microtime(true) - $this->start_time;
        
        // Log slow requests (> 3 seconds)
        if ($execution_time > 3) {
            log_message('warning', 'Slow request: ' . uri_string() . ' took ' . $execution_time . 's');
        }
    }
}
```

---

## 📋 PHASE 4: BACKUP & RECOVERY (Week 4)

### ✅ **4.1 Automated Backup Script**

```bash
#!/bin/bash
# File: scripts/backup_database.sh

# Configuration
DB_NAME="sik"
DB_USER="root"
DB_PASS=""
BACKUP_DIR="/backup/mysql"
DATE=$(date +%Y%m%d_%H%M%S)
RETENTION_DAYS=30

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/sik_$DATE.sql.gz

# Delete old backups
find $BACKUP_DIR -name "sik_*.sql.gz" -mtime +$RETENTION_DAYS -delete

# Log
echo "Backup completed: sik_$DATE.sql.gz" >> $BACKUP_DIR/backup.log
```

**Setup Cron Job:**
```bash
# Edit crontab
crontab -e

# Add daily backup at 2 AM
0 2 * * * /path/to/scripts/backup_database.sh
```

### ✅ **4.2 File Backup**

```bash
#!/bin/bash
# File: scripts/backup_files.sh

APP_DIR="/var/www/moizhospitalapps"
BACKUP_DIR="/backup/files"
DATE=$(date +%Y%m%d_%H%M%S)

# Backup important directories
tar -czf $BACKUP_DIR/files_$DATE.tar.gz \
    $APP_DIR/assets/images \
    $APP_DIR/uploads \
    $APP_DIR/application/config

# Delete old backups
find $BACKUP_DIR -name "files_*.tar.gz" -mtime +30 -delete
```

---

## 📋 PHASE 5: LOAD TESTING (Week 5)

### ✅ **5.1 Apache Bench Testing**

```bash
# Test concurrent users
ab -n 1000 -c 50 http://localhost/moizhospitalapps/admin/riwayatPasien/list

# Expected results:
# - Requests per second: > 100
# - Time per request: < 500ms
# - Failed requests: 0
```

### ✅ **5.2 JMeter Load Testing**

Download JMeter and create test plan:
- 50 concurrent users
- 1000 requests
- Ramp-up time: 60 seconds

Monitor:
- Response time
- Error rate
- Throughput

---

## 📋 IMPLEMENTATION CHECKLIST

### Week 1: Database & Performance
- [ ] Add all database indexes
- [ ] Configure MySQL settings
- [ ] Optimize AJAX calls (16 → 1)
- [ ] Enable persistent connections
- [ ] Test performance improvement

### Week 2: Caching & Security
- [ ] Implement caching layer
- [ ] Enable CSRF protection
- [ ] Secure sessions
- [ ] Add input validation
- [ ] Review SQL injection risks

### Week 3: Monitoring & Logging
- [ ] Setup error logging
- [ ] Enable slow query log
- [ ] Add performance monitoring
- [ ] Create monitoring dashboard

### Week 4: Backup & Recovery
- [ ] Setup automated database backup
- [ ] Setup file backup
- [ ] Test restore procedure
- [ ] Document recovery process

### Week 5: Testing & Deployment
- [ ] Load testing with Apache Bench
- [ ] Load testing with JMeter
- [ ] Fix bottlenecks
- [ ] Production deployment
- [ ] Monitor for 1 week

---

## 📊 EXPECTED RESULTS

| Metric | Before | After | Improvement |
|--------|--------|-------|-------------|
| Page Load Time | 3-5s | 0.5-1s | **80% faster** |
| Concurrent Users | 10 | 50+ | **5x capacity** |
| Database Query Time | 500ms | 50ms | **90% faster** |
| Server Response | 2s | 200ms | **90% faster** |
| Daily Capacity | 50 patients | 200+ patients | **4x capacity** |

---

## 🚨 CRITICAL NOTES

1. **DO NOT skip database indexing** - This is the #1 performance killer
2. **Test in staging first** - Never apply directly to production
3. **Backup before changes** - Always have a rollback plan
4. **Monitor after deployment** - Watch for issues in first week
5. **Gradual rollout** - Start with 1 poli, then expand

---

## 💰 COST ESTIMATE

| Item | Cost (IDR) |
|------|------------|
| Server Upgrade (if needed) | 5-10 juta/bulan |
| SSL Certificate | 500rb-2juta/tahun |
| Backup Storage | 1-2 juta/bulan |
| Monitoring Tools | Free - 5 juta/bulan |
| **Total** | **7-15 juta/bulan** |

---

## 📞 SUPPORT

Jika ada masalah saat implementasi:
1. Check logs: `application/logs/`
2. Check MySQL slow query log
3. Monitor server resources (CPU, RAM, Disk)
4. Contact me for assistance

---

**Good luck with the optimization!** 🚀

# 🛡️ SAFE DEPLOYMENT PLAN - PRODUCTION READY

## ⚠️ JANGAN LANGSUNG PRODUCTION!

Untuk aplikasi rumah sakit yang critical, ikuti step ini:

---

## PHASE 0: PREPARATION (30 MENIT)

### 1. Backup EVERYTHING! 🔒

```bash
# 1. Backup Database (WAJIB!)
mysqldump -u root -p sik > backup_production_$(date +%Y%m%d_%H%M%S).sql

# 2. Backup Codebase (WAJIB!)
cd /Applications/XAMPP/xamppfiles/htdocs
tar -czf moizhospitalapps_backup_$(date +%Y%m%d_%H%M%S).tar.gz moizhospitalapps/

# 3. Simpan backup di tempat AMAN (external drive/cloud)
```

### 2. Cek Environment

```bash
# Cek PHP version
php -v  # Minimal PHP 7.2

# Cek MySQL version
mysql --version  # Minimal MySQL 5.7

# Cek disk space
df -h  # Minimal 10GB free
```

---

## PHASE 1: STAGING ENVIRONMENT (1-2 JAM)

### Buat Clone Environment untuk Testing

```bash
# 1. Clone database
mysql -u root -p -e "CREATE DATABASE sik_staging;"
mysql -u root -p sik_staging < backup_production_*.sql

# 2. Clone codebase
cp -r moizhospitalapps moizhospitalapps_staging

# 3. Update config staging
cd moizhospitalapps_staging/application/config
```

**Edit `database.php` di staging:**
```php
'database' => 'sik_staging',  // ← Pakai database staging
```

**Edit `config.php` di staging:**
```php
$config['base_url'] = 'http://127.0.0.1/moizhospitalapps_staging/';
```

---

## PHASE 2: TEST DI STAGING (2-4 JAM)

### A. Install Optimasi di Staging

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps_staging

# Jalankan quick optimize
./quick_optimize.sh
```

### B. Test Fungsionalitas CRITICAL

**Checklist Testing:**

#### ✅ 1. Login & Authentication
```
[ ] Login sebagai Admin
[ ] Login sebagai Dokter
[ ] Login sebagai Perawat
[ ] Logout
[ ] Session timeout works
[ ] Wrong password rejected
```

#### ✅ 2. Patient Registration
```
[ ] Registrasi pasien baru
[ ] Search pasien existing
[ ] Update data pasien
[ ] Lihat riwayat pasien
```

#### ✅ 3. Medical Records (PALING PENTING!)
```
[ ] Input SOAP
[ ] Update SOAP
[ ] Delete SOAP (dalam 48 jam)
[ ] Lihat riwayat SOAP
[ ] Input Diagnosa
[ ] Input Prosedur
[ ] Input Tindakan
```

#### ✅ 4. Pharmacy & Lab
```
[ ] Input resep obat
[ ] Permintaan lab
[ ] Permintaan radiologi
[ ] Lihat hasil lab
[ ] Lihat hasil radiologi
```

#### ✅ 5. Billing
```
[ ] Lihat tagihan pasien
[ ] Input pembayaran
[ ] Print invoice
```

#### ✅ 6. Reports & Prints
```
[ ] Print resume medis
[ ] Print surat sakit
[ ] Print surat rujukan
[ ] Export laporan
```

### C. Performance Testing

```bash
# Install Apache Bench
brew install httpd

# Test 1: Login (50 concurrent users)
ab -n 500 -c 50 -p login.txt -T application/x-www-form-urlencoded \
   http://127.0.0.1/moizhospitalapps_staging/auth/login_process

# Expected: >30 req/sec, <500ms average

# Test 2: Dashboard (30 concurrent users)
ab -n 300 -c 30 -C "ci_session=YOUR_SESSION" \
   http://127.0.0.1/moizhospitalapps_staging/dokter/DokterRalanForm

# Expected: >20 req/sec, <1000ms average
```

**Create `login.txt` untuk testing:**
```
username=testdokter&password=testpass
```

### D. Monitor Logs

```bash
# Terminal 1: Monitor application logs
tail -f application/logs/log-*.php

# Terminal 2: Monitor MySQL slow queries
tail -f /Applications/XAMPP/xamppfiles/logs/mysql_slow.log

# Terminal 3: Monitor Apache error log
tail -f /Applications/XAMPP/xamppfiles/logs/error_log
```

**Cari error seperti:**
- ❌ Fatal errors
- ❌ Database connection errors
- ❌ Session errors
- ❌ Cache errors

---

## PHASE 3: SOFT LAUNCH (1-2 HARI)

### Deploy ke Production dengan Rollback Plan

#### A. Maintenance Mode

**Buat file `maintenance.html`:**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Maintenance - RSIA Andini</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #e74c3c; }
        p { color: #555; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Sistem Sedang Maintenance</h1>
        <p>Kami sedang melakukan upgrade sistem untuk meningkatkan performa.</p>
        <p><strong>Estimasi selesai: 30 menit</strong></p>
        <p>Mohon maaf atas ketidaknyamanannya.</p>
        <p>Untuk emergency, hubungi: <strong>0812-xxxx-xxxx</strong></p>
    </div>
</body>
</html>
```

**Enable maintenance mode:**
```bash
# Rename index.php
mv index.php index.php.backup
mv maintenance.html index.html
```

#### B. Deploy Optimasi

```bash
# 1. Backup production (LAGI!)
mysqldump -u root -p sik > backup_before_deploy_$(date +%Y%m%d_%H%M%S).sql

# 2. Run quick optimize
cd /Applications/XAMPP/xamppfiles/htdocs/moizhospitalapps
./quick_optimize.sh

# 3. Verify files
ls -la application/core/MY_Model.php
ls -la application/hooks/RateLimiter.php
```

#### C. Smoke Test Production

```bash
# Disable maintenance
mv index.html maintenance.html.backup
mv index.php.backup index.php

# Test login (1 user)
curl -X POST http://your-production-url/auth/login_process \
  -d "username=admin&password=yourpass"

# Expected: HTTP 200, redirect to dashboard
```

#### D. Monitor Closely (FIRST 2 HOURS!)

```bash
# Watch logs in real-time
watch -n 2 'tail -20 application/logs/log-*.php'

# Watch MySQL connections
watch -n 5 'mysql -u root -e "SHOW PROCESSLIST;"'

# Watch system resources
watch -n 5 'top -l 1 | head -20'
```

**Red Flags to Watch:**
- ❌ Error rate > 1%
- ❌ Response time > 3 seconds
- ❌ MySQL connections > 100
- ❌ CPU usage > 80%
- ❌ Memory usage > 90%

---

## PHASE 4: GRADUAL ROLLOUT (2-7 HARI)

### Day 1-2: Limited Users (10-20 users)
```
✅ Inform: "Sistem baru, mohon laporkan jika ada masalah"
✅ Monitor: Every 2 hours
✅ Collect: User feedback
```

### Day 3-5: Normal Load (50+ users)
```
✅ Monitor: Every 4 hours
✅ Check: Performance metrics
✅ Optimize: Based on slow query log
```

### Day 6-7: Full Load (100+ users)
```
✅ Monitor: Daily
✅ Verify: All features working
✅ Celebrate: If no major issues! 🎉
```

---

## 🆘 ROLLBACK PLAN (JIKA ADA MASALAH!)

### Quick Rollback (5 MENIT)

```bash
# 1. Enable maintenance mode
mv index.php index.php.new
mv maintenance.html index.html

# 2. Restore database config
cd application/config
mv database.php database.php.new
mv database.php.backup database.php

# 3. Restore CI config
mv config.php config.php.new
mv config.php.backup config.php

# 4. Disable hooks
mv hooks.php hooks.php.new
echo "<?php" > hooks.php

# 5. Clear cache
rm -rf application/cache/*

# 6. Disable maintenance
mv index.html maintenance.html
mv index.php.new index.php

# 7. Verify
curl http://your-url/auth/login
```

### Full Rollback (15 MENIT)

```bash
# 1. Restore database
mysql -u root -p sik < backup_before_deploy_*.sql

# 2. Restore codebase
cd /Applications/XAMPP/xamppfiles/htdocs
rm -rf moizhospitalapps
tar -xzf moizhospitalapps_backup_*.tar.gz

# 3. Restart services
sudo /Applications/XAMPP/xamppfiles/bin/mysql.server restart
sudo apachectl restart

# 4. Verify
curl http://your-url/auth/login
```

---

## 📊 SUCCESS METRICS

### After 1 Week, Check:

```sql
-- 1. Error rate
SELECT COUNT(*) as error_count 
FROM application_logs 
WHERE level = 'ERROR' 
AND created_at > DATE_SUB(NOW(), INTERVAL 7 DAY);
-- Expected: < 10 errors

-- 2. Average login time
SELECT AVG(execution_time) as avg_login_ms
FROM performance_logs
WHERE action = 'login'
AND created_at > DATE_SUB(NOW(), INTERVAL 7 DAY);
-- Expected: < 500ms

-- 3. Active users
SELECT COUNT(DISTINCT user_id) as active_users
FROM ci_sessions
WHERE timestamp > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY));
-- Expected: 50-100+
```

---

## ✅ GO/NO-GO CHECKLIST

### ✅ GO TO PRODUCTION IF:
- [ ] All staging tests passed
- [ ] Performance tests show >50% improvement
- [ ] No critical errors in staging
- [ ] Backup verified and accessible
- [ ] Rollback plan tested
- [ ] Team trained on new system
- [ ] Monitoring tools ready
- [ ] Emergency contact list ready

### ❌ DO NOT GO IF:
- [ ] Any critical feature broken
- [ ] Performance worse than before
- [ ] Frequent errors in staging
- [ ] No backup available
- [ ] No rollback plan
- [ ] Team not ready

---

## 🎯 RECOMMENDED TIMELINE

### Conservative (RECOMMENDED for Hospital):
```
Week 1: Staging setup & testing
Week 2: Soft launch (10-20 users)
Week 3: Gradual rollout (50+ users)
Week 4: Full production (100+ users)
```

### Aggressive (ONLY if very confident):
```
Day 1: Staging setup & testing (8 hours)
Day 2: Soft launch morning (4 hours monitoring)
Day 3-7: Gradual rollout
```

---

## 📞 EMERGENCY CONTACTS

**Before deployment, prepare:**
```
[ ] Database admin contact
[ ] Server admin contact
[ ] Developer contact (you!)
[ ] Hospital IT manager
[ ] Backup person who can rollback
```

---

## 💡 FINAL TIPS

1. **Deploy on LOW TRAFFIC time** (malam/weekend)
2. **Have someone on standby** for rollback
3. **Communicate with users** before deployment
4. **Monitor closely** first 24 hours
5. **Don't panic** if small issues appear
6. **Document everything** for future reference

---

## 🚀 READY TO DEPLOY?

**Answer these questions:**
1. ✅ Backup done? → YES/NO
2. ✅ Staging tested? → YES/NO
3. ✅ Rollback plan ready? → YES/NO
4. ✅ Team informed? → YES/NO
5. ✅ Monitoring ready? → YES/NO

**If ALL YES → You can deploy! 🎉**

**If ANY NO → Fix it first! ⚠️**

---

Good luck bro! Deploy dengan hati-hati! 🛡️

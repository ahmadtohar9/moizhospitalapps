# 🚀 Deployment Guide - MOIZ Hospital Apps to Ubuntu Server (aaPanel)

## Prerequisites
- Ubuntu Server (18.04 or higher)
- aaPanel installed
- Domain/subdomain (optional)
- SSH access to server

---

## 📋 Step-by-Step Deployment

### **STEP 1: Prepare aaPanel Environment**

#### 1.1 Install Required Software via aaPanel
Login to aaPanel web interface, then install:
- ✅ **Nginx** or **Apache** (recommended: Nginx)
- ✅ **PHP 7.4** or **PHP 8.0** (CodeIgniter compatible)
- ✅ **MySQL 5.7** or **MariaDB 10.x**
- ✅ **phpMyAdmin** (for database management)

**PHP Extensions Required:**
```
- php-mysqli
- php-curl
- php-gd
- php-mbstring
- php-xml
- php-zip
- php-json
```

Enable these in: **aaPanel → App Store → PHP → Settings → Install Extensions**

---

### **STEP 2: Create Website in aaPanel**

#### 2.1 Add New Site
1. Go to **Website → Add Site**
2. Fill in:
   - **Domain**: `yourdomain.com` or `subdomain.yourdomain.com`
   - **Root Directory**: `/www/wwwroot/moizhospitalapps`
   - **PHP Version**: Select PHP 7.4 or 8.0
   - **Database**: Create new database
     - Database Name: `sik`
     - Username: `sik_user`
     - Password: (generate strong password)
3. Click **Submit**

#### 2.2 Configure PHP Settings
1. Go to **Website → Your Site → Settings → PHP**
2. Set:
   - `upload_max_filesize = 100M`
   - `post_max_size = 100M`
   - `max_execution_time = 300`
   - `memory_limit = 256M`

---

### **STEP 3: Upload Application Files**

#### Option A: Via Git (RECOMMENDED)
```bash
# SSH to your server
ssh root@your-server-ip

# Navigate to website root
cd /www/wwwroot/moizhospitalapps

# Clone from GitHub
git clone https://github.com/ahmadtohar9/moizhospitalapps.git .

# Set permissions
chown -R www:www /www/wwwroot/moizhospitalapps
chmod -R 755 /www/wwwroot/moizhospitalapps
chmod -R 777 /www/wwwroot/moizhospitalapps/assets/images
chmod -R 777 /www/wwwroot/moizhospitalapps/assets/images/qrcode
```

#### Option B: Via aaPanel File Manager
1. Download ZIP from GitHub: https://github.com/ahmadtohar9/moizhospitalapps/archive/refs/heads/main.zip
2. Go to **aaPanel → Files**
3. Navigate to `/www/wwwroot/moizhospitalapps`
4. Click **Upload** → Select ZIP file
5. Right-click ZIP → **Extract**
6. Move all files from `moizhospitalapps-main/` to root directory
7. Delete empty folder and ZIP

---

### **STEP 4: Import Database**

#### 4.1 Via phpMyAdmin
1. Go to **aaPanel → Database → phpMyAdmin**
2. Login with root credentials
3. Select database `sik`
4. Click **Import** tab
5. Choose file: `database/sik_backup_2025-12-17.sql.gz`
6. Click **Go**

#### 4.2 Via SSH (Alternative)
```bash
# Extract backup
cd /www/wwwroot/moizhospitalapps/database
gunzip sik_backup_2025-12-17.sql.gz

# Import to MySQL
mysql -u sik_user -p sik < sik_backup_2025-12-17.sql
# Enter password when prompted
```

---

### **STEP 5: Configure Application**

#### 5.1 Update Database Configuration
Edit: `application/config/database.php`

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'sik_user',        // Your database username
    'password' => 'your_db_password', // Your database password
    'database' => 'sik',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

#### 5.2 Update Base URL
Edit: `application/config/config.php`

```php
$config['base_url'] = 'https://yourdomain.com/';
// or
$config['base_url'] = 'http://your-server-ip/';
```

#### 5.3 Set Environment to Production
Edit: `index.php` (root directory)

```php
define('ENVIRONMENT', 'production');
```

---

### **STEP 6: Configure Web Server**

#### For Nginx (Recommended)
Edit site config in aaPanel:
**Website → Your Site → Settings → Config File**

Add this inside `server` block:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/tmp/php-cgi-74.sock;
    fastcgi_index index.php;
    include fastcgi.conf;
}

# Deny access to sensitive files
location ~ /(application|system|database) {
    deny all;
    return 404;
}
```

#### For Apache
Create/edit `.htaccess` in root:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

# Deny access to sensitive directories
<IfModule mod_rewrite.c>
    RewriteRule ^(application|system|database) - [F,L]
</IfModule>
```

---

### **STEP 7: Set Proper Permissions**

```bash
# SSH to server
ssh root@your-server-ip

cd /www/wwwroot/moizhospitalapps

# Set ownership
chown -R www:www .

# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Writable directories
chmod -R 777 assets/images
chmod -R 777 assets/images/qrcode
chmod -R 777 application/logs
chmod -R 777 application/cache
```

---

### **STEP 8: Enable SSL (HTTPS) - OPTIONAL but RECOMMENDED**

#### Via aaPanel (Free Let's Encrypt)
1. Go to **Website → Your Site → Settings**
2. Click **SSL** tab
3. Select **Let's Encrypt**
4. Enter email address
5. Click **Apply**
6. Enable **Force HTTPS**

---

### **STEP 9: Test & Verify**

#### 9.1 Access Application
Open browser: `https://yourdomain.com`

#### 9.2 Test Login
- Username: `admin` (or your existing admin)
- Password: (your admin password)

#### 9.3 Check Features
- ✅ Login works
- ✅ Dashboard loads
- ✅ Rawat Jalan menu accessible
- ✅ Program Rehab Medik works
- ✅ Formulir KFR works
- ✅ Signature pad functional
- ✅ Print reports work

---

### **STEP 10: Post-Deployment Tasks**

#### 10.1 Secure Application
```bash
# Remove installer files (if any)
rm -rf install/

# Secure config files
chmod 640 application/config/database.php
chmod 640 application/config/config.php
```

#### 10.2 Setup Backup (aaPanel)
1. Go to **aaPanel → Cron**
2. Add new task:
   - **Type**: Backup Database
   - **Database**: sik
   - **Schedule**: Daily at 2:00 AM
   - **Retention**: 7 days

#### 10.3 Monitor Logs
```bash
# Application logs
tail -f /www/wwwroot/moizhospitalapps/application/logs/*.php

# Nginx error log
tail -f /www/wwwlogs/yourdomain.com.error.log

# PHP error log
tail -f /www/server/php/74/var/log/php-fpm.log
```

---

## 🔧 Troubleshooting

### Issue: 404 Not Found
**Solution**: Check Nginx/Apache config, ensure rewrite rules are correct

### Issue: Database Connection Error
**Solution**: 
- Verify database credentials in `application/config/database.php`
- Check MySQL is running: `systemctl status mysql`

### Issue: Permission Denied
**Solution**:
```bash
chown -R www:www /www/wwwroot/moizhospitalapps
chmod -R 755 /www/wwwroot/moizhospitalapps
```

### Issue: Signature Pad Not Working
**Solution**: Ensure HTTPS is enabled (signature pad requires secure context)

### Issue: Upload Failed
**Solution**: Check PHP upload limits in `php.ini` or aaPanel PHP settings

---

## 📞 Support

**GitHub Repository**: https://github.com/ahmadtohar9/moizhospitalapps  
**Issues**: https://github.com/ahmadtohar9/moizhospitalapps/issues

---

## 📝 Quick Command Reference

```bash
# Restart Nginx
systemctl restart nginx

# Restart PHP-FPM
systemctl restart php-fpm-74

# Restart MySQL
systemctl restart mysql

# Check disk space
df -h

# Check memory usage
free -m

# View real-time logs
tail -f /www/wwwlogs/yourdomain.com.error.log
```

---

**Deployment Guide Version**: 1.0  
**Last Updated**: December 17, 2025  
**Author**: Ahmad Tohar

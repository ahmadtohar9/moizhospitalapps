# 📋 Post-Download Setup Checklist

After downloading/cloning from GitHub, you need to manually configure these files:

## ⚠️ Files NOT in GitHub (Gitignored)

These files are excluded from Git for security/privacy reasons:

### 1. **Database Configuration**
**File:** `application/config/database.php`

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'YOUR_DB_USERNAME',  // ← Change this
    'password' => 'YOUR_DB_PASSWORD',  // ← Change this
    'database' => 'sik',
    // ... rest of config
);
```

### 2. **Base URL Configuration**
**File:** `application/config/config.php`

```php
$config['base_url'] = 'http://yourdomain.com/';  // ← Change this
```

### 3. **BPJS Configuration** (if using BPJS integration)
**File:** `application/config/setting_bpjs.php`

Update with your BPJS credentials:
- Consumer ID
- Consumer Secret
- Base URL
- Service Name

### 4. **Development Config** (optional)
**Folder:** `application/config/development/`

Create this folder if you need separate config for development environment.

### 5. **Session Files**
**Folder:** `application/sessions/`

This folder exists but is empty (sessions are runtime generated).

### 6. **Log Files**
**Folder:** `application/logs/`

Log files are auto-generated, not in Git.

---

## ✅ Files Included in Latest Push

- ✅ `.htaccess` - Apache rewrite rules
- ✅ `nginx.conf.example` - Nginx configuration example
- ✅ `DEPLOYMENT_GUIDE.md` - Full deployment instructions
- ✅ `UPDATE_LOG.md` - Feature changelog
- ✅ `database/sik_backup_2025-12-17.sql.gz` - Full database backup
- ✅ `database/migrations/` - Database migration scripts

---

## 🔧 Quick Setup Steps

### After Download/Clone:

1. **Import Database**
   ```bash
   cd database
   gunzip sik_backup_2025-12-17.sql.gz
   mysql -u root -p sik < sik_backup_2025-12-17.sql
   ```

2. **Configure Database**
   - Edit `application/config/database.php`
   - Set your DB username/password

3. **Configure Base URL**
   - Edit `application/config/config.php`
   - Set your domain/IP

4. **Set Permissions** (Linux/Mac)
   ```bash
   chmod -R 755 .
   chmod -R 777 assets/images
   chmod -R 777 application/logs
   chmod -R 777 application/sessions
   ```

5. **Test Access**
   - Open browser: `http://yourdomain.com`
   - Login with admin credentials

---

## 🔐 Security Notes

**Files NOT in Git for security:**
- Database credentials
- BPJS API keys
- Session data
- Log files
- Development configs

**Always:**
- Keep sensitive configs out of Git
- Use environment variables for production
- Backup database regularly
- Update `.gitignore` if adding new sensitive files

---

## 📞 Need Help?

If files are missing or not working:
1. Check this checklist
2. Review `DEPLOYMENT_GUIDE.md`
3. Check GitHub issues
4. Compare with your local working copy

---

**Last Updated:** December 17, 2025

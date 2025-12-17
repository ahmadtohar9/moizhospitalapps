# Changelog

All notable changes to this project will be documented in this file.

## [1.0.0] - 2025-12-17

### Added
- ✨ Initial release
- 🔐 Sistem login dan autentikasi
- 👥 Manajemen user dan role
- 📋 Pendaftaran pasien
- 🏥 Rawat jalan
- 💊 Resep dan farmasi
- 🔬 Laboratorium
- 📸 Radiologi
- 💰 Billing dan pembayaran
- 📊 Laporan dan statistik
- 🔄 Integrasi BPJS (SEP, Rujukan, Antrean)
- 🏋️ Rehab Medik & KFR
- 📄 Resume Medis
- 🗂️ Berkas Digital

### Fixed
- 🐛 Session path untuk production deployment
- 🐛 Case sensitivity file JavaScript di Linux server

### Security
- 🔒 CSRF protection
- 🔒 XSS filtering
- 🔒 SQL injection prevention

---

## How to Update

### Manual Update (Current Method)
```bash
# Di local
git push origin main

# Di server
git pull origin main
```

### Auto Update (Coming Soon)
- One-click update dari admin panel
- Auto backup sebelum update
- Auto migration database
- Rollback jika error

---

## Version Format

We use [Semantic Versioning](https://semver.org/):
- **MAJOR.MINOR.PATCH** (e.g., 1.0.0)
- **MAJOR**: Breaking changes
- **MINOR**: New features (backward compatible)
- **PATCH**: Bug fixes (backward compatible)

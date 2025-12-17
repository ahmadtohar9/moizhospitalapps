<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

INFO - 2025-08-04 10:46:55 --> Config Class Initialized
INFO - 2025-08-04 10:46:55 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:46:55 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:46:55 --> Utf8 Class Initialized
INFO - 2025-08-04 10:46:55 --> URI Class Initialized
INFO - 2025-08-04 10:46:55 --> Router Class Initialized
INFO - 2025-08-04 10:46:55 --> Output Class Initialized
INFO - 2025-08-04 10:46:55 --> Security Class Initialized
DEBUG - 2025-08-04 10:46:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:46:55 --> Input Class Initialized
INFO - 2025-08-04 10:46:55 --> Language Class Initialized
INFO - 2025-08-04 10:46:55 --> Loader Class Initialized
INFO - 2025-08-04 10:46:55 --> Helper loaded: url_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: form_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:46:55 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:46:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:46:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:46:55 --> Controller Class Initialized
INFO - 2025-08-04 10:46:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:46:55 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:46:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:46:55 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:46:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:46:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:46:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/dokter/dokter_ralan.php
INFO - 2025-08-04 10:46:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:46:55 --> Final output sent to browser
DEBUG - 2025-08-04 10:46:55 --> Total execution time: 0.0272
INFO - 2025-08-04 10:46:55 --> Config Class Initialized
INFO - 2025-08-04 10:46:55 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:46:55 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:46:55 --> Utf8 Class Initialized
INFO - 2025-08-04 10:46:55 --> URI Class Initialized
INFO - 2025-08-04 10:46:55 --> Router Class Initialized
INFO - 2025-08-04 10:46:55 --> Output Class Initialized
INFO - 2025-08-04 10:46:55 --> Security Class Initialized
DEBUG - 2025-08-04 10:46:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:46:55 --> Input Class Initialized
INFO - 2025-08-04 10:46:55 --> Language Class Initialized
INFO - 2025-08-04 10:46:55 --> Loader Class Initialized
INFO - 2025-08-04 10:46:55 --> Helper loaded: url_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: form_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:46:55 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:46:55 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:46:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:46:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:46:55 --> Controller Class Initialized
INFO - 2025-08-04 10:46:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:46:55 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:46:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:46:55 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 10:46:55 --> Filter Tanggal - Start Date: 2025-08-04, End Date: 2025-08-04
DEBUG - 2025-08-04 10:46:55 --> Query SQL yang akan dijalankan: SELECT `reg_periksa`.`no_rawat`, `reg_periksa`.`no_rkm_medis`, `pasien`.`nm_pasien`, `dokter`.`nm_dokter`, `penjab`.`png_jawab`, `poliklinik`.`nm_poli`, `reg_periksa`.`tgl_registrasi`, `reg_periksa`.`status_bayar`, `reg_periksa`.`stts`
FROM `reg_periksa`
JOIN `pasien` ON `reg_periksa`.`no_rkm_medis` = `pasien`.`no_rkm_medis`
JOIN `penjab` ON `reg_periksa`.`kd_pj` = `penjab`.`kd_pj`
JOIN `poliklinik` ON `reg_periksa`.`kd_poli` = `poliklinik`.`kd_poli`
JOIN `dokter` ON `reg_periksa`.`kd_dokter` = `dokter`.`kd_dokter`
WHERE `reg_periksa`.`status_lanjut` = 'Ralan'
AND DATE(reg_periksa.tgl_registrasi) >= '2025-08-04'
AND DATE(reg_periksa.tgl_registrasi) <= '2025-08-04'
DEBUG - 2025-08-04 10:46:55 --> Jumlah data ditemukan: 2
INFO - 2025-08-04 10:46:55 --> Final output sent to browser
DEBUG - 2025-08-04 10:46:55 --> Total execution time: 0.0236
INFO - 2025-08-04 10:46:57 --> Config Class Initialized
INFO - 2025-08-04 10:46:57 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:46:57 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:46:57 --> Utf8 Class Initialized
INFO - 2025-08-04 10:46:57 --> URI Class Initialized
INFO - 2025-08-04 10:46:57 --> Router Class Initialized
INFO - 2025-08-04 10:46:57 --> Output Class Initialized
INFO - 2025-08-04 10:46:57 --> Security Class Initialized
DEBUG - 2025-08-04 10:46:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:46:57 --> Input Class Initialized
INFO - 2025-08-04 10:46:57 --> Language Class Initialized
INFO - 2025-08-04 10:46:57 --> Loader Class Initialized
INFO - 2025-08-04 10:46:57 --> Helper loaded: url_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: form_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:46:57 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:46:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:46:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:46:57 --> Controller Class Initialized
INFO - 2025-08-04 10:46:57 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:46:57 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:46:57 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:46:57 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:46:57 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:46:57 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:46:57 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:46:57 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:46:57 --> Final output sent to browser
DEBUG - 2025-08-04 10:46:57 --> Total execution time: 0.0214
INFO - 2025-08-04 10:46:57 --> Config Class Initialized
INFO - 2025-08-04 10:46:57 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:46:57 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:46:57 --> Utf8 Class Initialized
INFO - 2025-08-04 10:46:57 --> URI Class Initialized
INFO - 2025-08-04 10:46:57 --> Router Class Initialized
INFO - 2025-08-04 10:46:57 --> Output Class Initialized
INFO - 2025-08-04 10:46:57 --> Security Class Initialized
DEBUG - 2025-08-04 10:46:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:46:57 --> Input Class Initialized
INFO - 2025-08-04 10:46:57 --> Language Class Initialized
INFO - 2025-08-04 10:46:57 --> Loader Class Initialized
INFO - 2025-08-04 10:46:57 --> Helper loaded: url_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: form_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:46:57 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:46:57 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:46:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:46:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:46:57 --> Controller Class Initialized
INFO - 2025-08-04 10:46:57 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:46:57 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:46:57 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:46:57 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:46:57 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:46:57 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
ERROR - 2025-08-04 10:46:57 --> Severity: error --> Exception: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/models/AwalMedisDokterMataRalanModel.php exists, but doesn't declare class AwalMedisDokterMataRalanModel /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/system/core/Loader.php 341
INFO - 2025-08-04 10:47:36 --> Config Class Initialized
INFO - 2025-08-04 10:47:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:36 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:36 --> URI Class Initialized
INFO - 2025-08-04 10:47:36 --> Router Class Initialized
INFO - 2025-08-04 10:47:36 --> Output Class Initialized
INFO - 2025-08-04 10:47:36 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:36 --> Input Class Initialized
INFO - 2025-08-04 10:47:36 --> Language Class Initialized
INFO - 2025-08-04 10:47:36 --> Loader Class Initialized
INFO - 2025-08-04 10:47:36 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:36 --> Controller Class Initialized
INFO - 2025-08-04 10:47:36 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:47:36 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:47:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:47:36 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:47:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:47:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:47:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:47:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:47:36 --> Final output sent to browser
DEBUG - 2025-08-04 10:47:36 --> Total execution time: 0.0251
INFO - 2025-08-04 10:47:36 --> Config Class Initialized
INFO - 2025-08-04 10:47:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:36 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:36 --> URI Class Initialized
INFO - 2025-08-04 10:47:36 --> Router Class Initialized
INFO - 2025-08-04 10:47:36 --> Output Class Initialized
INFO - 2025-08-04 10:47:36 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:36 --> Input Class Initialized
INFO - 2025-08-04 10:47:36 --> Language Class Initialized
INFO - 2025-08-04 10:47:36 --> Loader Class Initialized
INFO - 2025-08-04 10:47:36 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:36 --> Controller Class Initialized
INFO - 2025-08-04 10:47:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:47:36 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:47:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:47:36 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:47:36 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:47:36 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:47:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:47:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:47:36 --> Final output sent to browser
DEBUG - 2025-08-04 10:47:36 --> Total execution time: 0.0384
INFO - 2025-08-04 10:47:45 --> Config Class Initialized
INFO - 2025-08-04 10:47:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:45 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:45 --> URI Class Initialized
INFO - 2025-08-04 10:47:45 --> Router Class Initialized
INFO - 2025-08-04 10:47:45 --> Output Class Initialized
INFO - 2025-08-04 10:47:45 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:45 --> Input Class Initialized
INFO - 2025-08-04 10:47:45 --> Language Class Initialized
INFO - 2025-08-04 10:47:45 --> Loader Class Initialized
INFO - 2025-08-04 10:47:45 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:45 --> Controller Class Initialized
INFO - 2025-08-04 10:47:45 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:47:45 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:47:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:47:45 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:47:45 --> Config Class Initialized
INFO - 2025-08-04 10:47:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:45 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:45 --> URI Class Initialized
INFO - 2025-08-04 10:47:45 --> Router Class Initialized
INFO - 2025-08-04 10:47:45 --> Output Class Initialized
INFO - 2025-08-04 10:47:45 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:45 --> Input Class Initialized
INFO - 2025-08-04 10:47:45 --> Language Class Initialized
INFO - 2025-08-04 10:47:45 --> Loader Class Initialized
INFO - 2025-08-04 10:47:45 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:45 --> Controller Class Initialized
INFO - 2025-08-04 10:47:45 --> Model "AuthModel" initialized
INFO - 2025-08-04 10:47:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/auth/login.php
INFO - 2025-08-04 10:47:45 --> Final output sent to browser
DEBUG - 2025-08-04 10:47:45 --> Total execution time: 0.0334
INFO - 2025-08-04 10:47:48 --> Config Class Initialized
INFO - 2025-08-04 10:47:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:48 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:48 --> URI Class Initialized
INFO - 2025-08-04 10:47:48 --> Router Class Initialized
INFO - 2025-08-04 10:47:48 --> Output Class Initialized
INFO - 2025-08-04 10:47:48 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:48 --> Input Class Initialized
INFO - 2025-08-04 10:47:48 --> Language Class Initialized
INFO - 2025-08-04 10:47:48 --> Loader Class Initialized
INFO - 2025-08-04 10:47:48 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:48 --> Controller Class Initialized
INFO - 2025-08-04 10:47:48 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:47:48 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:47:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:47:48 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:47:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:47:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:47:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:47:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:47:48 --> Final output sent to browser
DEBUG - 2025-08-04 10:47:48 --> Total execution time: 0.0249
INFO - 2025-08-04 10:47:48 --> Config Class Initialized
INFO - 2025-08-04 10:47:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:47:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:47:48 --> Utf8 Class Initialized
INFO - 2025-08-04 10:47:48 --> URI Class Initialized
INFO - 2025-08-04 10:47:48 --> Router Class Initialized
INFO - 2025-08-04 10:47:48 --> Output Class Initialized
INFO - 2025-08-04 10:47:48 --> Security Class Initialized
DEBUG - 2025-08-04 10:47:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:47:48 --> Input Class Initialized
INFO - 2025-08-04 10:47:48 --> Language Class Initialized
INFO - 2025-08-04 10:47:48 --> Loader Class Initialized
INFO - 2025-08-04 10:47:48 --> Helper loaded: url_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: form_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:47:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:47:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:47:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:47:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:47:48 --> Controller Class Initialized
INFO - 2025-08-04 10:47:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:47:48 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:47:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:47:48 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:47:48 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:47:48 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:47:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:47:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:47:48 --> Final output sent to browser
DEBUG - 2025-08-04 10:47:48 --> Total execution time: 0.0465
INFO - 2025-08-04 10:52:20 --> Config Class Initialized
INFO - 2025-08-04 10:52:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:52:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:52:20 --> Utf8 Class Initialized
INFO - 2025-08-04 10:52:20 --> URI Class Initialized
INFO - 2025-08-04 10:52:20 --> Router Class Initialized
INFO - 2025-08-04 10:52:20 --> Output Class Initialized
INFO - 2025-08-04 10:52:20 --> Security Class Initialized
DEBUG - 2025-08-04 10:52:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:52:20 --> Input Class Initialized
INFO - 2025-08-04 10:52:20 --> Language Class Initialized
INFO - 2025-08-04 10:52:20 --> Loader Class Initialized
INFO - 2025-08-04 10:52:20 --> Helper loaded: url_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: form_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:52:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:52:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:52:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:52:20 --> Controller Class Initialized
INFO - 2025-08-04 10:52:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:52:20 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:52:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:52:20 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:52:20 --> Config Class Initialized
INFO - 2025-08-04 10:52:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:52:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:52:20 --> Utf8 Class Initialized
INFO - 2025-08-04 10:52:20 --> URI Class Initialized
INFO - 2025-08-04 10:52:20 --> Router Class Initialized
INFO - 2025-08-04 10:52:20 --> Output Class Initialized
INFO - 2025-08-04 10:52:20 --> Security Class Initialized
DEBUG - 2025-08-04 10:52:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:52:20 --> Input Class Initialized
INFO - 2025-08-04 10:52:20 --> Language Class Initialized
INFO - 2025-08-04 10:52:20 --> Loader Class Initialized
INFO - 2025-08-04 10:52:20 --> Helper loaded: url_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: form_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:52:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:52:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:52:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:52:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:52:20 --> Controller Class Initialized
INFO - 2025-08-04 10:52:20 --> Model "AuthModel" initialized
INFO - 2025-08-04 10:52:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/auth/login.php
INFO - 2025-08-04 10:52:20 --> Final output sent to browser
DEBUG - 2025-08-04 10:52:20 --> Total execution time: 0.0076
INFO - 2025-08-04 10:54:32 --> Config Class Initialized
INFO - 2025-08-04 10:54:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:54:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:54:32 --> Utf8 Class Initialized
INFO - 2025-08-04 10:54:32 --> URI Class Initialized
INFO - 2025-08-04 10:54:32 --> Router Class Initialized
INFO - 2025-08-04 10:54:32 --> Output Class Initialized
INFO - 2025-08-04 10:54:32 --> Security Class Initialized
DEBUG - 2025-08-04 10:54:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:54:32 --> Input Class Initialized
INFO - 2025-08-04 10:54:32 --> Language Class Initialized
INFO - 2025-08-04 10:54:32 --> Loader Class Initialized
INFO - 2025-08-04 10:54:32 --> Helper loaded: url_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: form_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:54:32 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:54:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:54:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:54:32 --> Controller Class Initialized
INFO - 2025-08-04 10:54:32 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:54:32 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:54:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:54:32 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:54:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:54:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:54:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:54:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:54:32 --> Final output sent to browser
DEBUG - 2025-08-04 10:54:32 --> Total execution time: 0.0397
INFO - 2025-08-04 10:54:32 --> Config Class Initialized
INFO - 2025-08-04 10:54:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:54:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:54:32 --> Utf8 Class Initialized
INFO - 2025-08-04 10:54:32 --> URI Class Initialized
INFO - 2025-08-04 10:54:32 --> Router Class Initialized
INFO - 2025-08-04 10:54:32 --> Output Class Initialized
INFO - 2025-08-04 10:54:32 --> Security Class Initialized
DEBUG - 2025-08-04 10:54:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:54:32 --> Input Class Initialized
INFO - 2025-08-04 10:54:32 --> Language Class Initialized
INFO - 2025-08-04 10:54:32 --> Loader Class Initialized
INFO - 2025-08-04 10:54:32 --> Helper loaded: url_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: form_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:54:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:54:32 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:54:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:54:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:54:32 --> Controller Class Initialized
INFO - 2025-08-04 10:54:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:54:32 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:54:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:54:32 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:54:32 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:54:32 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:54:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:54:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:54:32 --> Final output sent to browser
DEBUG - 2025-08-04 10:54:32 --> Total execution time: 0.0206
INFO - 2025-08-04 10:54:34 --> Config Class Initialized
INFO - 2025-08-04 10:54:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:54:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:54:34 --> Utf8 Class Initialized
INFO - 2025-08-04 10:54:34 --> URI Class Initialized
INFO - 2025-08-04 10:54:34 --> Router Class Initialized
INFO - 2025-08-04 10:54:34 --> Output Class Initialized
INFO - 2025-08-04 10:54:34 --> Security Class Initialized
DEBUG - 2025-08-04 10:54:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:54:34 --> Input Class Initialized
INFO - 2025-08-04 10:54:34 --> Language Class Initialized
INFO - 2025-08-04 10:54:34 --> Loader Class Initialized
INFO - 2025-08-04 10:54:34 --> Helper loaded: url_helper
INFO - 2025-08-04 10:54:34 --> Helper loaded: form_helper
INFO - 2025-08-04 10:54:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:54:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:54:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:54:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:54:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:54:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:54:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:54:34 --> Controller Class Initialized
INFO - 2025-08-04 10:54:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:54:34 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:54:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:54:34 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:54:34 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:54:34 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:54:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:54:34 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:54:34 --> Final output sent to browser
DEBUG - 2025-08-04 10:54:34 --> Total execution time: 0.0250
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
INFO - 2025-08-04 10:55:15 --> Loader Class Initialized
INFO - 2025-08-04 10:55:15 --> Helper loaded: url_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: form_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:55:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:55:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:55:15 --> Controller Class Initialized
INFO - 2025-08-04 10:55:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:55:15 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:55:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:55:15 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:55:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:55:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:55:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:55:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:55:15 --> Final output sent to browser
DEBUG - 2025-08-04 10:55:15 --> Total execution time: 0.0234
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
INFO - 2025-08-04 10:55:15 --> Loader Class Initialized
INFO - 2025-08-04 10:55:15 --> Helper loaded: url_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: form_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:55:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:55:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:55:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:55:15 --> Controller Class Initialized
INFO - 2025-08-04 10:55:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:55:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:55:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:55:15 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:55:15 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:55:15 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:55:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:55:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:55:15 --> Final output sent to browser
DEBUG - 2025-08-04 10:55:15 --> Total execution time: 0.0184
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
INFO - 2025-08-04 10:55:15 --> Config Class Initialized
INFO - 2025-08-04 10:55:15 --> Hooks Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
DEBUG - 2025-08-04 10:55:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:55:15 --> Utf8 Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:55:15 --> URI Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Router Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
INFO - 2025-08-04 10:55:15 --> Output Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Security Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
DEBUG - 2025-08-04 10:55:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:55:15 --> Input Class Initialized
INFO - 2025-08-04 10:55:15 --> Language Class Initialized
ERROR - 2025-08-04 10:55:15 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
INFO - 2025-08-04 10:56:25 --> Loader Class Initialized
INFO - 2025-08-04 10:56:25 --> Helper loaded: url_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: form_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:56:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:56:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:56:25 --> Controller Class Initialized
INFO - 2025-08-04 10:56:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:56:25 --> Model "SettingModel" initialized
INFO - 2025-08-04 10:56:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:56:25 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 10:56:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 10:56:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 10:56:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 10:56:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 10:56:25 --> Final output sent to browser
DEBUG - 2025-08-04 10:56:25 --> Total execution time: 0.0229
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
INFO - 2025-08-04 10:56:25 --> Loader Class Initialized
INFO - 2025-08-04 10:56:25 --> Helper loaded: url_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: form_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 10:56:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 10:56:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 10:56:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 10:56:25 --> Controller Class Initialized
INFO - 2025-08-04 10:56:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 10:56:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 10:56:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 10:56:25 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 10:56:25 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 10:56:25 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 10:56:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 10:56:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 10:56:25 --> Final output sent to browser
DEBUG - 2025-08-04 10:56:25 --> Total execution time: 0.0232
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 10:56:25 --> Config Class Initialized
INFO - 2025-08-04 10:56:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 10:56:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 10:56:25 --> Utf8 Class Initialized
INFO - 2025-08-04 10:56:25 --> URI Class Initialized
INFO - 2025-08-04 10:56:25 --> Router Class Initialized
INFO - 2025-08-04 10:56:25 --> Output Class Initialized
INFO - 2025-08-04 10:56:25 --> Security Class Initialized
DEBUG - 2025-08-04 10:56:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 10:56:25 --> Input Class Initialized
INFO - 2025-08-04 10:56:25 --> Language Class Initialized
ERROR - 2025-08-04 10:56:25 --> 404 Page Not Found: Dokter/awal_mata
INFO - 2025-08-04 11:10:51 --> Config Class Initialized
INFO - 2025-08-04 11:10:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:10:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:10:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:10:51 --> URI Class Initialized
INFO - 2025-08-04 11:10:51 --> Router Class Initialized
INFO - 2025-08-04 11:10:51 --> Output Class Initialized
INFO - 2025-08-04 11:10:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:10:51 --> Input Class Initialized
INFO - 2025-08-04 11:10:51 --> Language Class Initialized
INFO - 2025-08-04 11:10:51 --> Loader Class Initialized
INFO - 2025-08-04 11:10:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:10:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:10:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:10:51 --> Controller Class Initialized
INFO - 2025-08-04 11:10:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:10:51 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:10:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:10:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:10:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:10:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:10:51 --> Total execution time: 0.0419
INFO - 2025-08-04 11:10:51 --> Config Class Initialized
INFO - 2025-08-04 11:10:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:10:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:10:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:10:51 --> URI Class Initialized
INFO - 2025-08-04 11:10:51 --> Router Class Initialized
INFO - 2025-08-04 11:10:51 --> Output Class Initialized
INFO - 2025-08-04 11:10:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:10:51 --> Input Class Initialized
INFO - 2025-08-04 11:10:51 --> Language Class Initialized
INFO - 2025-08-04 11:10:51 --> Loader Class Initialized
INFO - 2025-08-04 11:10:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:10:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:10:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:10:51 --> Controller Class Initialized
INFO - 2025-08-04 11:10:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:10:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:10:51 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:10:51 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:10:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:10:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:10:51 --> Total execution time: 0.0168
INFO - 2025-08-04 11:10:51 --> Config Class Initialized
INFO - 2025-08-04 11:10:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:10:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:10:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:10:51 --> URI Class Initialized
INFO - 2025-08-04 11:10:51 --> Router Class Initialized
INFO - 2025-08-04 11:10:51 --> Output Class Initialized
INFO - 2025-08-04 11:10:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:10:51 --> Input Class Initialized
INFO - 2025-08-04 11:10:51 --> Language Class Initialized
INFO - 2025-08-04 11:10:51 --> Config Class Initialized
INFO - 2025-08-04 11:10:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:10:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:10:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:10:51 --> Loader Class Initialized
INFO - 2025-08-04 11:10:51 --> URI Class Initialized
INFO - 2025-08-04 11:10:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:10:51 --> Config Class Initialized
INFO - 2025-08-04 11:10:51 --> Hooks Class Initialized
INFO - 2025-08-04 11:10:51 --> Router Class Initialized
DEBUG - 2025-08-04 11:10:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:10:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:10:51 --> URI Class Initialized
INFO - 2025-08-04 11:10:51 --> Output Class Initialized
INFO - 2025-08-04 11:10:51 --> Database Driver Class Initialized
INFO - 2025-08-04 11:10:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:10:51 --> Input Class Initialized
INFO - 2025-08-04 11:10:51 --> Language Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:10:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:10:51 --> Loader Class Initialized
INFO - 2025-08-04 11:10:51 --> Controller Class Initialized
INFO - 2025-08-04 11:10:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:10:51 --> Helper loaded: url_helper
ERROR - 2025-08-04 11:10:51 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 122
INFO - 2025-08-04 11:10:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:10:51 --> Router Class Initialized
INFO - 2025-08-04 11:10:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:10:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:10:51 --> Output Class Initialized
INFO - 2025-08-04 11:10:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:10:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:10:51 --> Input Class Initialized
INFO - 2025-08-04 11:10:51 --> Language Class Initialized
INFO - 2025-08-04 11:10:51 --> Database Driver Class Initialized
ERROR - 2025-08-04 11:10:51 --> 404 Page Not Found: Medis-mata/get-last
DEBUG - 2025-08-04 11:10:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:10:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:10:51 --> Controller Class Initialized
INFO - 2025-08-04 11:10:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:10:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:10:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:10:51 --> Total execution time: 0.0193
INFO - 2025-08-04 11:15:48 --> Config Class Initialized
INFO - 2025-08-04 11:15:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:48 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:48 --> URI Class Initialized
INFO - 2025-08-04 11:15:48 --> Router Class Initialized
INFO - 2025-08-04 11:15:48 --> Output Class Initialized
INFO - 2025-08-04 11:15:48 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:48 --> Input Class Initialized
INFO - 2025-08-04 11:15:48 --> Language Class Initialized
INFO - 2025-08-04 11:15:48 --> Loader Class Initialized
INFO - 2025-08-04 11:15:48 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:48 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:48 --> Controller Class Initialized
INFO - 2025-08-04 11:15:48 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:48 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:48 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:49 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:49 --> Total execution time: 0.0342
INFO - 2025-08-04 11:15:49 --> Config Class Initialized
INFO - 2025-08-04 11:15:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:49 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:49 --> URI Class Initialized
INFO - 2025-08-04 11:15:49 --> Router Class Initialized
INFO - 2025-08-04 11:15:49 --> Output Class Initialized
INFO - 2025-08-04 11:15:49 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:49 --> Input Class Initialized
INFO - 2025-08-04 11:15:49 --> Language Class Initialized
INFO - 2025-08-04 11:15:49 --> Loader Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:49 --> Controller Class Initialized
INFO - 2025-08-04 11:15:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:15:49 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:15:49 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:15:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:15:49 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:49 --> Total execution time: 0.0244
INFO - 2025-08-04 11:15:49 --> Config Class Initialized
INFO - 2025-08-04 11:15:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:49 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:49 --> URI Class Initialized
INFO - 2025-08-04 11:15:49 --> Router Class Initialized
INFO - 2025-08-04 11:15:49 --> Output Class Initialized
INFO - 2025-08-04 11:15:49 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:49 --> Input Class Initialized
INFO - 2025-08-04 11:15:49 --> Language Class Initialized
INFO - 2025-08-04 11:15:49 --> Config Class Initialized
INFO - 2025-08-04 11:15:49 --> Config Class Initialized
INFO - 2025-08-04 11:15:49 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:49 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:15:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:49 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:49 --> Loader Class Initialized
INFO - 2025-08-04 11:15:49 --> URI Class Initialized
INFO - 2025-08-04 11:15:49 --> URI Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:49 --> Router Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:49 --> Output Class Initialized
INFO - 2025-08-04 11:15:49 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:49 --> Input Class Initialized
INFO - 2025-08-04 11:15:49 --> Language Class Initialized
INFO - 2025-08-04 11:15:49 --> Loader Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:49 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:49 --> Router Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:49 --> Output Class Initialized
INFO - 2025-08-04 11:15:49 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:49 --> Input Class Initialized
INFO - 2025-08-04 11:15:49 --> Language Class Initialized
DEBUG - 2025-08-04 11:15:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:49 --> Controller Class Initialized
INFO - 2025-08-04 11:15:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:15:49 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:15:49 --> Loader Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:49 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:49 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:49 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:15:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:49 --> Controller Class Initialized
INFO - 2025-08-04 11:15:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:49 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 11:15:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:49 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:49 --> Total execution time: 0.0188
INFO - 2025-08-04 11:15:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:49 --> Controller Class Initialized
INFO - 2025-08-04 11:15:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:49 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:15:49 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:15:52 --> Config Class Initialized
INFO - 2025-08-04 11:15:52 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:52 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:52 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:52 --> URI Class Initialized
INFO - 2025-08-04 11:15:52 --> Router Class Initialized
INFO - 2025-08-04 11:15:52 --> Output Class Initialized
INFO - 2025-08-04 11:15:52 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:52 --> Input Class Initialized
INFO - 2025-08-04 11:15:52 --> Language Class Initialized
INFO - 2025-08-04 11:15:52 --> Loader Class Initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:52 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:52 --> Controller Class Initialized
INFO - 2025-08-04 11:15:52 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:52 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:15:52 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:15:52 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 11:15:52 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:52 --> Total execution time: 0.0232
INFO - 2025-08-04 11:15:52 --> Config Class Initialized
INFO - 2025-08-04 11:15:52 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:52 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:52 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:52 --> URI Class Initialized
INFO - 2025-08-04 11:15:52 --> Router Class Initialized
INFO - 2025-08-04 11:15:52 --> Output Class Initialized
INFO - 2025-08-04 11:15:52 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:52 --> Input Class Initialized
INFO - 2025-08-04 11:15:52 --> Language Class Initialized
INFO - 2025-08-04 11:15:52 --> Loader Class Initialized
INFO - 2025-08-04 11:15:52 --> Config Class Initialized
INFO - 2025-08-04 11:15:52 --> Config Class Initialized
INFO - 2025-08-04 11:15:52 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:52 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: form_helper
DEBUG - 2025-08-04 11:15:52 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 11:15:52 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:52 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:52 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:52 --> URI Class Initialized
INFO - 2025-08-04 11:15:52 --> URI Class Initialized
INFO - 2025-08-04 11:15:52 --> Router Class Initialized
INFO - 2025-08-04 11:15:52 --> Router Class Initialized
INFO - 2025-08-04 11:15:52 --> Output Class Initialized
INFO - 2025-08-04 11:15:52 --> Output Class Initialized
INFO - 2025-08-04 11:15:52 --> Security Class Initialized
INFO - 2025-08-04 11:15:52 --> Security Class Initialized
INFO - 2025-08-04 11:15:52 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:52 --> Input Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:52 --> Input Class Initialized
INFO - 2025-08-04 11:15:52 --> Language Class Initialized
INFO - 2025-08-04 11:15:52 --> Language Class Initialized
INFO - 2025-08-04 11:15:52 --> Loader Class Initialized
INFO - 2025-08-04 11:15:52 --> Loader Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:52 --> Controller Class Initialized
INFO - 2025-08-04 11:15:52 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:52 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:52 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:52 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:52 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:52 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:52 --> Total execution time: 0.0116
INFO - 2025-08-04 11:15:52 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:52 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:52 --> Controller Class Initialized
DEBUG - 2025-08-04 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:52 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:52 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:52 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:52 --> Total execution time: 0.0140
INFO - 2025-08-04 11:15:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:52 --> Controller Class Initialized
INFO - 2025-08-04 11:15:52 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:52 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:52 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:52 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:52 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:52 --> Total execution time: 0.0166
INFO - 2025-08-04 11:15:53 --> Config Class Initialized
INFO - 2025-08-04 11:15:53 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:53 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:53 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:53 --> URI Class Initialized
INFO - 2025-08-04 11:15:53 --> Router Class Initialized
INFO - 2025-08-04 11:15:53 --> Output Class Initialized
INFO - 2025-08-04 11:15:53 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:53 --> Input Class Initialized
INFO - 2025-08-04 11:15:53 --> Language Class Initialized
INFO - 2025-08-04 11:15:53 --> Loader Class Initialized
INFO - 2025-08-04 11:15:53 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:53 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:53 --> Controller Class Initialized
INFO - 2025-08-04 11:15:53 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:53 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:15:53 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:15:53 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:15:53 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:15:53 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:53 --> Total execution time: 0.0236
INFO - 2025-08-04 11:15:53 --> Config Class Initialized
INFO - 2025-08-04 11:15:53 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:53 --> Config Class Initialized
INFO - 2025-08-04 11:15:53 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:53 --> Config Class Initialized
INFO - 2025-08-04 11:15:53 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:53 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:53 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:15:53 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:53 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:53 --> URI Class Initialized
DEBUG - 2025-08-04 11:15:53 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:53 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:53 --> URI Class Initialized
INFO - 2025-08-04 11:15:53 --> Router Class Initialized
INFO - 2025-08-04 11:15:53 --> URI Class Initialized
INFO - 2025-08-04 11:15:53 --> Router Class Initialized
INFO - 2025-08-04 11:15:53 --> Output Class Initialized
INFO - 2025-08-04 11:15:53 --> Router Class Initialized
INFO - 2025-08-04 11:15:53 --> Security Class Initialized
INFO - 2025-08-04 11:15:53 --> Output Class Initialized
INFO - 2025-08-04 11:15:53 --> Output Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:53 --> Input Class Initialized
INFO - 2025-08-04 11:15:53 --> Security Class Initialized
INFO - 2025-08-04 11:15:53 --> Language Class Initialized
INFO - 2025-08-04 11:15:53 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:53 --> Input Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:53 --> Input Class Initialized
INFO - 2025-08-04 11:15:53 --> Language Class Initialized
INFO - 2025-08-04 11:15:53 --> Language Class Initialized
INFO - 2025-08-04 11:15:53 --> Loader Class Initialized
INFO - 2025-08-04 11:15:53 --> Loader Class Initialized
INFO - 2025-08-04 11:15:53 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:53 --> Loader Class Initialized
INFO - 2025-08-04 11:15:53 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:53 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:53 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:53 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:53 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:53 --> Controller Class Initialized
INFO - 2025-08-04 11:15:53 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 11:15:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 11:15:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:53 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:53 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:53 --> Total execution time: 0.0176
INFO - 2025-08-04 11:15:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:53 --> Controller Class Initialized
INFO - 2025-08-04 11:15:53 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:15:53 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:15:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:53 --> Controller Class Initialized
INFO - 2025-08-04 11:15:53 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:53 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:15:53 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:15:54 --> Config Class Initialized
INFO - 2025-08-04 11:15:54 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:54 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:54 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:54 --> URI Class Initialized
INFO - 2025-08-04 11:15:54 --> Router Class Initialized
INFO - 2025-08-04 11:15:54 --> Output Class Initialized
INFO - 2025-08-04 11:15:54 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:54 --> Input Class Initialized
INFO - 2025-08-04 11:15:54 --> Language Class Initialized
INFO - 2025-08-04 11:15:54 --> Loader Class Initialized
INFO - 2025-08-04 11:15:54 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:54 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:54 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:54 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:54 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:54 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:55 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:55 --> Controller Class Initialized
INFO - 2025-08-04 11:15:55 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:15:55 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:15:55 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 11:15:55 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:55 --> Total execution time: 0.0260
INFO - 2025-08-04 11:15:55 --> Config Class Initialized
INFO - 2025-08-04 11:15:55 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:55 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:55 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:55 --> URI Class Initialized
INFO - 2025-08-04 11:15:55 --> Router Class Initialized
INFO - 2025-08-04 11:15:55 --> Output Class Initialized
INFO - 2025-08-04 11:15:55 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:55 --> Input Class Initialized
INFO - 2025-08-04 11:15:55 --> Language Class Initialized
INFO - 2025-08-04 11:15:55 --> Config Class Initialized
INFO - 2025-08-04 11:15:55 --> Hooks Class Initialized
INFO - 2025-08-04 11:15:55 --> Config Class Initialized
INFO - 2025-08-04 11:15:55 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:55 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:55 --> Loader Class Initialized
INFO - 2025-08-04 11:15:55 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:15:55 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:55 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:55 --> URI Class Initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:55 --> Router Class Initialized
INFO - 2025-08-04 11:15:55 --> URI Class Initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:55 --> Output Class Initialized
INFO - 2025-08-04 11:15:55 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:55 --> Input Class Initialized
INFO - 2025-08-04 11:15:55 --> Language Class Initialized
INFO - 2025-08-04 11:15:55 --> Router Class Initialized
INFO - 2025-08-04 11:15:55 --> Output Class Initialized
INFO - 2025-08-04 11:15:55 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:55 --> Loader Class Initialized
INFO - 2025-08-04 11:15:55 --> Security Class Initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:15:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:55 --> Input Class Initialized
INFO - 2025-08-04 11:15:55 --> Language Class Initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:15:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:55 --> Controller Class Initialized
INFO - 2025-08-04 11:15:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:55 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:55 --> Loader Class Initialized
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:55 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:55 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:55 --> Total execution time: 0.0131
INFO - 2025-08-04 11:15:55 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:15:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:55 --> Controller Class Initialized
INFO - 2025-08-04 11:15:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:55 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:55 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:55 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:55 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:55 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:55 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:55 --> Total execution time: 0.0166
DEBUG - 2025-08-04 11:15:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:55 --> Controller Class Initialized
INFO - 2025-08-04 11:15:55 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:55 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:55 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:15:55 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:15:55 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:55 --> Total execution time: 0.0328
INFO - 2025-08-04 11:15:59 --> Config Class Initialized
INFO - 2025-08-04 11:15:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:59 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:59 --> URI Class Initialized
INFO - 2025-08-04 11:15:59 --> Router Class Initialized
INFO - 2025-08-04 11:15:59 --> Output Class Initialized
INFO - 2025-08-04 11:15:59 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:59 --> Input Class Initialized
INFO - 2025-08-04 11:15:59 --> Language Class Initialized
INFO - 2025-08-04 11:15:59 --> Loader Class Initialized
INFO - 2025-08-04 11:15:59 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:59 --> Controller Class Initialized
INFO - 2025-08-04 11:15:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:15:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:15:59 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:15:59 --> Decoded menu_url: TindakanRalanDokterController/index
INFO - 2025-08-04 11:15:59 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:15:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/tindakanRalan.php
INFO - 2025-08-04 11:15:59 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:59 --> Total execution time: 0.0253
INFO - 2025-08-04 11:15:59 --> Config Class Initialized
INFO - 2025-08-04 11:15:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:59 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:59 --> URI Class Initialized
INFO - 2025-08-04 11:15:59 --> Router Class Initialized
INFO - 2025-08-04 11:15:59 --> Config Class Initialized
INFO - 2025-08-04 11:15:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:15:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:15:59 --> Utf8 Class Initialized
INFO - 2025-08-04 11:15:59 --> Output Class Initialized
INFO - 2025-08-04 11:15:59 --> URI Class Initialized
INFO - 2025-08-04 11:15:59 --> Security Class Initialized
INFO - 2025-08-04 11:15:59 --> Router Class Initialized
DEBUG - 2025-08-04 11:15:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:59 --> Input Class Initialized
INFO - 2025-08-04 11:15:59 --> Language Class Initialized
INFO - 2025-08-04 11:15:59 --> Output Class Initialized
INFO - 2025-08-04 11:15:59 --> Security Class Initialized
DEBUG - 2025-08-04 11:15:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:15:59 --> Input Class Initialized
INFO - 2025-08-04 11:15:59 --> Loader Class Initialized
INFO - 2025-08-04 11:15:59 --> Language Class Initialized
INFO - 2025-08-04 11:15:59 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:59 --> Loader Class Initialized
INFO - 2025-08-04 11:15:59 --> Helper loaded: url_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: form_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:15:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:15:59 --> Database Driver Class Initialized
INFO - 2025-08-04 11:15:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:15:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:59 --> Controller Class Initialized
INFO - 2025-08-04 11:15:59 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 11:15:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:15:59 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:59 --> Total execution time: 0.0153
INFO - 2025-08-04 11:15:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:15:59 --> Controller Class Initialized
INFO - 2025-08-04 11:15:59 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:15:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:15:59 --> Final output sent to browser
DEBUG - 2025-08-04 11:15:59 --> Total execution time: 0.0148
INFO - 2025-08-04 11:16:00 --> Config Class Initialized
INFO - 2025-08-04 11:16:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:00 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:00 --> URI Class Initialized
INFO - 2025-08-04 11:16:00 --> Router Class Initialized
INFO - 2025-08-04 11:16:00 --> Output Class Initialized
INFO - 2025-08-04 11:16:00 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:00 --> Input Class Initialized
INFO - 2025-08-04 11:16:00 --> Language Class Initialized
INFO - 2025-08-04 11:16:00 --> Loader Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:00 --> Controller Class Initialized
INFO - 2025-08-04 11:16:00 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:00 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:16:00 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:00 --> Total execution time: 0.0228
INFO - 2025-08-04 11:16:00 --> Config Class Initialized
INFO - 2025-08-04 11:16:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:00 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:00 --> URI Class Initialized
INFO - 2025-08-04 11:16:00 --> Router Class Initialized
INFO - 2025-08-04 11:16:00 --> Output Class Initialized
INFO - 2025-08-04 11:16:00 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:00 --> Input Class Initialized
INFO - 2025-08-04 11:16:00 --> Language Class Initialized
INFO - 2025-08-04 11:16:00 --> Loader Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:00 --> Controller Class Initialized
INFO - 2025-08-04 11:16:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:16:00 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:16:00 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:16:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:16:00 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:00 --> Total execution time: 0.0165
INFO - 2025-08-04 11:16:00 --> Config Class Initialized
INFO - 2025-08-04 11:16:00 --> Config Class Initialized
INFO - 2025-08-04 11:16:00 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:00 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:00 --> Config Class Initialized
INFO - 2025-08-04 11:16:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:00 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 11:16:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:00 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:00 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:00 --> URI Class Initialized
DEBUG - 2025-08-04 11:16:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:00 --> URI Class Initialized
INFO - 2025-08-04 11:16:00 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:00 --> URI Class Initialized
INFO - 2025-08-04 11:16:00 --> Router Class Initialized
INFO - 2025-08-04 11:16:00 --> Router Class Initialized
INFO - 2025-08-04 11:16:00 --> Output Class Initialized
INFO - 2025-08-04 11:16:00 --> Output Class Initialized
INFO - 2025-08-04 11:16:00 --> Security Class Initialized
INFO - 2025-08-04 11:16:00 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:00 --> Input Class Initialized
INFO - 2025-08-04 11:16:00 --> Language Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:00 --> Input Class Initialized
INFO - 2025-08-04 11:16:00 --> Language Class Initialized
INFO - 2025-08-04 11:16:00 --> Router Class Initialized
INFO - 2025-08-04 11:16:00 --> Loader Class Initialized
INFO - 2025-08-04 11:16:00 --> Output Class Initialized
INFO - 2025-08-04 11:16:00 --> Loader Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:00 --> Security Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 11:16:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:00 --> Input Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:00 --> Language Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:00 --> Loader Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:00 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:00 --> Controller Class Initialized
INFO - 2025-08-04 11:16:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 11:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:00 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:16:00 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:00 --> Controller Class Initialized
INFO - 2025-08-04 11:16:00 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:00 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:00 --> Total execution time: 0.0079
DEBUG - 2025-08-04 11:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:00 --> Controller Class Initialized
INFO - 2025-08-04 11:16:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:00 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:16:00 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:16:03 --> Config Class Initialized
INFO - 2025-08-04 11:16:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:03 --> URI Class Initialized
INFO - 2025-08-04 11:16:03 --> Router Class Initialized
INFO - 2025-08-04 11:16:03 --> Output Class Initialized
INFO - 2025-08-04 11:16:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:03 --> Input Class Initialized
INFO - 2025-08-04 11:16:03 --> Language Class Initialized
INFO - 2025-08-04 11:16:03 --> Loader Class Initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:03 --> Controller Class Initialized
INFO - 2025-08-04 11:16:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:16:03 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:16:03 --> Decoded menu_url: TindakanRalanDokterController/index
INFO - 2025-08-04 11:16:03 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:16:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/tindakanRalan.php
INFO - 2025-08-04 11:16:03 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:03 --> Total execution time: 0.0231
INFO - 2025-08-04 11:16:03 --> Config Class Initialized
INFO - 2025-08-04 11:16:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:03 --> URI Class Initialized
INFO - 2025-08-04 11:16:03 --> Router Class Initialized
INFO - 2025-08-04 11:16:03 --> Output Class Initialized
INFO - 2025-08-04 11:16:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:03 --> Input Class Initialized
INFO - 2025-08-04 11:16:03 --> Language Class Initialized
INFO - 2025-08-04 11:16:03 --> Config Class Initialized
INFO - 2025-08-04 11:16:03 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:03 --> Loader Class Initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:16:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:03 --> URI Class Initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:03 --> Router Class Initialized
INFO - 2025-08-04 11:16:03 --> Output Class Initialized
INFO - 2025-08-04 11:16:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:03 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:03 --> Input Class Initialized
INFO - 2025-08-04 11:16:03 --> Language Class Initialized
INFO - 2025-08-04 11:16:03 --> Loader Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:03 --> Controller Class Initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:03 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:03 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:03 --> Total execution time: 0.0135
INFO - 2025-08-04 11:16:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:03 --> Controller Class Initialized
INFO - 2025-08-04 11:16:03 --> Model "TindakanRalanDokterModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:03 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:03 --> Total execution time: 0.0155
INFO - 2025-08-04 11:16:04 --> Config Class Initialized
INFO - 2025-08-04 11:16:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:04 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:04 --> URI Class Initialized
INFO - 2025-08-04 11:16:04 --> Router Class Initialized
INFO - 2025-08-04 11:16:04 --> Output Class Initialized
INFO - 2025-08-04 11:16:04 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:04 --> Input Class Initialized
INFO - 2025-08-04 11:16:04 --> Language Class Initialized
INFO - 2025-08-04 11:16:04 --> Loader Class Initialized
INFO - 2025-08-04 11:16:04 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:04 --> Controller Class Initialized
INFO - 2025-08-04 11:16:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:16:04 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:16:04 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 11:16:04 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:04 --> Total execution time: 0.0222
INFO - 2025-08-04 11:16:04 --> Config Class Initialized
INFO - 2025-08-04 11:16:04 --> Config Class Initialized
INFO - 2025-08-04 11:16:04 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:04 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 11:16:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:04 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:04 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:04 --> URI Class Initialized
INFO - 2025-08-04 11:16:04 --> URI Class Initialized
INFO - 2025-08-04 11:16:04 --> Router Class Initialized
INFO - 2025-08-04 11:16:04 --> Router Class Initialized
INFO - 2025-08-04 11:16:04 --> Output Class Initialized
INFO - 2025-08-04 11:16:04 --> Output Class Initialized
INFO - 2025-08-04 11:16:04 --> Security Class Initialized
INFO - 2025-08-04 11:16:04 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:04 --> Input Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:04 --> Language Class Initialized
INFO - 2025-08-04 11:16:04 --> Input Class Initialized
INFO - 2025-08-04 11:16:04 --> Language Class Initialized
INFO - 2025-08-04 11:16:04 --> Loader Class Initialized
INFO - 2025-08-04 11:16:04 --> Config Class Initialized
INFO - 2025-08-04 11:16:04 --> Loader Class Initialized
INFO - 2025-08-04 11:16:04 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:04 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: form_helper
DEBUG - 2025-08-04 11:16:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:04 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:04 --> URI Class Initialized
INFO - 2025-08-04 11:16:04 --> Router Class Initialized
INFO - 2025-08-04 11:16:04 --> Output Class Initialized
INFO - 2025-08-04 11:16:04 --> Security Class Initialized
INFO - 2025-08-04 11:16:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:04 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:04 --> Input Class Initialized
INFO - 2025-08-04 11:16:04 --> Language Class Initialized
INFO - 2025-08-04 11:16:04 --> Loader Class Initialized
DEBUG - 2025-08-04 11:16:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 11:16:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:04 --> Controller Class Initialized
INFO - 2025-08-04 11:16:04 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:04 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:16:04 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:16:04 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:04 --> Total execution time: 0.0121
INFO - 2025-08-04 11:16:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:04 --> Controller Class Initialized
INFO - 2025-08-04 11:16:04 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:04 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 11:16:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:16:04 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:04 --> Total execution time: 0.0162
INFO - 2025-08-04 11:16:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:04 --> Controller Class Initialized
INFO - 2025-08-04 11:16:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:04 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:04 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:16:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:16:04 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:04 --> Total execution time: 0.0154
INFO - 2025-08-04 11:16:10 --> Config Class Initialized
INFO - 2025-08-04 11:16:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:10 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:10 --> URI Class Initialized
INFO - 2025-08-04 11:16:10 --> Router Class Initialized
INFO - 2025-08-04 11:16:10 --> Output Class Initialized
INFO - 2025-08-04 11:16:10 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:10 --> Input Class Initialized
INFO - 2025-08-04 11:16:10 --> Language Class Initialized
INFO - 2025-08-04 11:16:10 --> Loader Class Initialized
INFO - 2025-08-04 11:16:10 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:10 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:10 --> Controller Class Initialized
INFO - 2025-08-04 11:16:10 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:10 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:16:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:10 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:16:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:16:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:16:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:16:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:16:10 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:10 --> Total execution time: 0.0219
INFO - 2025-08-04 11:16:25 --> Config Class Initialized
INFO - 2025-08-04 11:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:25 --> URI Class Initialized
INFO - 2025-08-04 11:16:25 --> Router Class Initialized
INFO - 2025-08-04 11:16:25 --> Output Class Initialized
INFO - 2025-08-04 11:16:25 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:25 --> Input Class Initialized
INFO - 2025-08-04 11:16:25 --> Language Class Initialized
INFO - 2025-08-04 11:16:25 --> Loader Class Initialized
INFO - 2025-08-04 11:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:25 --> Controller Class Initialized
INFO - 2025-08-04 11:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:16:25 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:16:25 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:25 --> Total execution time: 0.0467
INFO - 2025-08-04 11:16:25 --> Config Class Initialized
INFO - 2025-08-04 11:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:25 --> URI Class Initialized
INFO - 2025-08-04 11:16:25 --> Config Class Initialized
INFO - 2025-08-04 11:16:25 --> Config Class Initialized
INFO - 2025-08-04 11:16:25 --> Hooks Class Initialized
INFO - 2025-08-04 11:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:25 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:16:25 --> URI Class Initialized
INFO - 2025-08-04 11:16:25 --> URI Class Initialized
INFO - 2025-08-04 11:16:25 --> Router Class Initialized
INFO - 2025-08-04 11:16:25 --> Router Class Initialized
INFO - 2025-08-04 11:16:25 --> Router Class Initialized
INFO - 2025-08-04 11:16:25 --> Output Class Initialized
INFO - 2025-08-04 11:16:25 --> Output Class Initialized
INFO - 2025-08-04 11:16:25 --> Output Class Initialized
INFO - 2025-08-04 11:16:25 --> Security Class Initialized
INFO - 2025-08-04 11:16:25 --> Security Class Initialized
INFO - 2025-08-04 11:16:25 --> Security Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:25 --> Input Class Initialized
INFO - 2025-08-04 11:16:25 --> Language Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:25 --> Input Class Initialized
INFO - 2025-08-04 11:16:25 --> Language Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:16:25 --> Input Class Initialized
INFO - 2025-08-04 11:16:25 --> Language Class Initialized
INFO - 2025-08-04 11:16:25 --> Loader Class Initialized
INFO - 2025-08-04 11:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:25 --> Loader Class Initialized
INFO - 2025-08-04 11:16:25 --> Loader Class Initialized
INFO - 2025-08-04 11:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:16:25 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:25 --> Database Driver Class Initialized
INFO - 2025-08-04 11:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:25 --> Controller Class Initialized
INFO - 2025-08-04 11:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:16:25 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
DEBUG - 2025-08-04 11:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 11:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:25 --> Controller Class Initialized
INFO - 2025-08-04 11:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:16:25 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:16:25 --> Controller Class Initialized
INFO - 2025-08-04 11:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 11:16:25 --> Total execution time: 0.0181
INFO - 2025-08-04 11:18:47 --> Config Class Initialized
INFO - 2025-08-04 11:18:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:18:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:18:47 --> Utf8 Class Initialized
INFO - 2025-08-04 11:18:47 --> URI Class Initialized
INFO - 2025-08-04 11:18:47 --> Router Class Initialized
INFO - 2025-08-04 11:18:47 --> Output Class Initialized
INFO - 2025-08-04 11:18:47 --> Security Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:18:47 --> Input Class Initialized
INFO - 2025-08-04 11:18:47 --> Language Class Initialized
INFO - 2025-08-04 11:18:47 --> Loader Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: url_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: form_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:18:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:18:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:18:47 --> Controller Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:18:47 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:18:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:18:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:18:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:18:47 --> Final output sent to browser
DEBUG - 2025-08-04 11:18:47 --> Total execution time: 0.0312
INFO - 2025-08-04 11:18:47 --> Config Class Initialized
INFO - 2025-08-04 11:18:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:18:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:18:47 --> Utf8 Class Initialized
INFO - 2025-08-04 11:18:47 --> URI Class Initialized
INFO - 2025-08-04 11:18:47 --> Router Class Initialized
INFO - 2025-08-04 11:18:47 --> Output Class Initialized
INFO - 2025-08-04 11:18:47 --> Security Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:18:47 --> Input Class Initialized
INFO - 2025-08-04 11:18:47 --> Language Class Initialized
INFO - 2025-08-04 11:18:47 --> Loader Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: url_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: form_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:18:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:18:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:18:47 --> Controller Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:18:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:18:47 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:18:47 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:18:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:18:47 --> Final output sent to browser
DEBUG - 2025-08-04 11:18:47 --> Total execution time: 0.0193
INFO - 2025-08-04 11:18:47 --> Config Class Initialized
INFO - 2025-08-04 11:18:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:18:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:18:47 --> Utf8 Class Initialized
INFO - 2025-08-04 11:18:47 --> URI Class Initialized
INFO - 2025-08-04 11:18:47 --> Router Class Initialized
INFO - 2025-08-04 11:18:47 --> Output Class Initialized
INFO - 2025-08-04 11:18:47 --> Security Class Initialized
INFO - 2025-08-04 11:18:47 --> Config Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:18:47 --> Hooks Class Initialized
INFO - 2025-08-04 11:18:47 --> Input Class Initialized
INFO - 2025-08-04 11:18:47 --> Language Class Initialized
DEBUG - 2025-08-04 11:18:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:18:47 --> Utf8 Class Initialized
INFO - 2025-08-04 11:18:47 --> Config Class Initialized
INFO - 2025-08-04 11:18:47 --> Hooks Class Initialized
INFO - 2025-08-04 11:18:47 --> Loader Class Initialized
DEBUG - 2025-08-04 11:18:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:18:47 --> Utf8 Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: url_helper
INFO - 2025-08-04 11:18:47 --> URI Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: form_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:18:47 --> URI Class Initialized
INFO - 2025-08-04 11:18:47 --> Router Class Initialized
INFO - 2025-08-04 11:18:47 --> Output Class Initialized
INFO - 2025-08-04 11:18:47 --> Security Class Initialized
INFO - 2025-08-04 11:18:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:18:47 --> Input Class Initialized
INFO - 2025-08-04 11:18:47 --> Language Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:18:47 --> Loader Class Initialized
INFO - 2025-08-04 11:18:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:18:47 --> Controller Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: url_helper
INFO - 2025-08-04 11:18:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Router Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: form_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: norawat_helper
ERROR - 2025-08-04 11:18:47 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getRiwayatByNoRM() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 186
INFO - 2025-08-04 11:18:47 --> Output Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:18:47 --> Security Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:18:47 --> Input Class Initialized
INFO - 2025-08-04 11:18:47 --> Language Class Initialized
INFO - 2025-08-04 11:18:47 --> Loader Class Initialized
INFO - 2025-08-04 11:18:47 --> Database Driver Class Initialized
INFO - 2025-08-04 11:18:47 --> Helper loaded: url_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: form_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:18:47 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:18:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:18:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:18:47 --> Controller Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:18:47 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:18:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:18:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:18:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:18:47 --> Controller Class Initialized
INFO - 2025-08-04 11:18:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:18:47 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:18:47 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:19:51 --> Config Class Initialized
INFO - 2025-08-04 11:19:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:19:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:19:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:19:51 --> URI Class Initialized
INFO - 2025-08-04 11:19:51 --> Router Class Initialized
INFO - 2025-08-04 11:19:51 --> Output Class Initialized
INFO - 2025-08-04 11:19:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:19:51 --> Input Class Initialized
INFO - 2025-08-04 11:19:51 --> Language Class Initialized
INFO - 2025-08-04 11:19:51 --> Loader Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:19:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:19:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:19:51 --> Controller Class Initialized
INFO - 2025-08-04 11:19:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:19:51 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:19:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:19:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:19:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:19:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:19:51 --> Total execution time: 0.0236
INFO - 2025-08-04 11:19:51 --> Config Class Initialized
INFO - 2025-08-04 11:19:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:19:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:19:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:19:51 --> URI Class Initialized
INFO - 2025-08-04 11:19:51 --> Router Class Initialized
INFO - 2025-08-04 11:19:51 --> Output Class Initialized
INFO - 2025-08-04 11:19:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:19:51 --> Input Class Initialized
INFO - 2025-08-04 11:19:51 --> Language Class Initialized
INFO - 2025-08-04 11:19:51 --> Loader Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:19:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:19:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:19:51 --> Controller Class Initialized
INFO - 2025-08-04 11:19:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:19:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:19:51 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:19:51 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:19:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:19:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:19:51 --> Total execution time: 0.0220
INFO - 2025-08-04 11:19:51 --> Config Class Initialized
INFO - 2025-08-04 11:19:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:19:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:19:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:19:51 --> URI Class Initialized
INFO - 2025-08-04 11:19:51 --> Router Class Initialized
INFO - 2025-08-04 11:19:51 --> Output Class Initialized
INFO - 2025-08-04 11:19:51 --> Config Class Initialized
INFO - 2025-08-04 11:19:51 --> Hooks Class Initialized
INFO - 2025-08-04 11:19:51 --> Security Class Initialized
INFO - 2025-08-04 11:19:51 --> Config Class Initialized
INFO - 2025-08-04 11:19:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:19:51 --> Input Class Initialized
INFO - 2025-08-04 11:19:51 --> Language Class Initialized
DEBUG - 2025-08-04 11:19:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:19:51 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:19:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:19:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:19:51 --> URI Class Initialized
INFO - 2025-08-04 11:19:51 --> URI Class Initialized
INFO - 2025-08-04 11:19:51 --> Loader Class Initialized
INFO - 2025-08-04 11:19:51 --> Router Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:19:51 --> Router Class Initialized
INFO - 2025-08-04 11:19:51 --> Output Class Initialized
INFO - 2025-08-04 11:19:51 --> Security Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:19:51 --> Output Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:19:51 --> Input Class Initialized
INFO - 2025-08-04 11:19:51 --> Language Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:19:51 --> Security Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:19:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:19:51 --> Input Class Initialized
INFO - 2025-08-04 11:19:51 --> Language Class Initialized
INFO - 2025-08-04 11:19:51 --> Loader Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:19:51 --> Loader Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:19:51 --> Database Driver Class Initialized
INFO - 2025-08-04 11:19:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:19:51 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:19:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:19:51 --> Controller Class Initialized
INFO - 2025-08-04 11:19:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:19:51 --> Database Driver Class Initialized
ERROR - 2025-08-04 11:19:51 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:19:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:19:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:19:51 --> Controller Class Initialized
INFO - 2025-08-04 11:19:51 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 11:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:19:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:19:51 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:19:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:19:51 --> Controller Class Initialized
INFO - 2025-08-04 11:19:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:19:51 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:19:51 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getRiwayatByNoRM() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 186
INFO - 2025-08-04 11:35:26 --> Config Class Initialized
INFO - 2025-08-04 11:35:26 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:35:26 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:35:26 --> Utf8 Class Initialized
INFO - 2025-08-04 11:35:26 --> URI Class Initialized
INFO - 2025-08-04 11:35:26 --> Router Class Initialized
INFO - 2025-08-04 11:35:26 --> Output Class Initialized
INFO - 2025-08-04 11:35:26 --> Security Class Initialized
DEBUG - 2025-08-04 11:35:26 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:35:26 --> Input Class Initialized
INFO - 2025-08-04 11:35:26 --> Language Class Initialized
INFO - 2025-08-04 11:35:26 --> Loader Class Initialized
INFO - 2025-08-04 11:35:26 --> Helper loaded: url_helper
INFO - 2025-08-04 11:35:26 --> Helper loaded: form_helper
INFO - 2025-08-04 11:35:26 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:35:26 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:35:26 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:35:26 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:35:26 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:35:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:35:26 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:35:26 --> Controller Class Initialized
INFO - 2025-08-04 11:35:26 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:35:26 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:35:26 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:35:26 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:35:26 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:35:26 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:35:26 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:35:26 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:35:26 --> Final output sent to browser
DEBUG - 2025-08-04 11:35:26 --> Total execution time: 0.0410
INFO - 2025-08-04 11:35:27 --> Config Class Initialized
INFO - 2025-08-04 11:35:27 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:35:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:35:27 --> Utf8 Class Initialized
INFO - 2025-08-04 11:35:27 --> URI Class Initialized
INFO - 2025-08-04 11:35:27 --> Router Class Initialized
INFO - 2025-08-04 11:35:27 --> Output Class Initialized
INFO - 2025-08-04 11:35:27 --> Security Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:35:27 --> Input Class Initialized
INFO - 2025-08-04 11:35:27 --> Language Class Initialized
INFO - 2025-08-04 11:35:27 --> Loader Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: url_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: form_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:35:27 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:35:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:35:27 --> Controller Class Initialized
INFO - 2025-08-04 11:35:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:35:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:35:27 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:35:27 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:35:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:35:27 --> Final output sent to browser
DEBUG - 2025-08-04 11:35:27 --> Total execution time: 0.0172
INFO - 2025-08-04 11:35:27 --> Config Class Initialized
INFO - 2025-08-04 11:35:27 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:35:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:35:27 --> Utf8 Class Initialized
INFO - 2025-08-04 11:35:27 --> URI Class Initialized
INFO - 2025-08-04 11:35:27 --> Router Class Initialized
INFO - 2025-08-04 11:35:27 --> Output Class Initialized
INFO - 2025-08-04 11:35:27 --> Security Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:35:27 --> Input Class Initialized
INFO - 2025-08-04 11:35:27 --> Language Class Initialized
INFO - 2025-08-04 11:35:27 --> Config Class Initialized
INFO - 2025-08-04 11:35:27 --> Hooks Class Initialized
INFO - 2025-08-04 11:35:27 --> Config Class Initialized
INFO - 2025-08-04 11:35:27 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:35:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:35:27 --> Utf8 Class Initialized
INFO - 2025-08-04 11:35:27 --> Loader Class Initialized
DEBUG - 2025-08-04 11:35:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:35:27 --> Utf8 Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: url_helper
INFO - 2025-08-04 11:35:27 --> URI Class Initialized
INFO - 2025-08-04 11:35:27 --> URI Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: form_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:35:27 --> Router Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:35:27 --> Output Class Initialized
INFO - 2025-08-04 11:35:27 --> Router Class Initialized
INFO - 2025-08-04 11:35:27 --> Security Class Initialized
INFO - 2025-08-04 11:35:27 --> Output Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:35:27 --> Input Class Initialized
INFO - 2025-08-04 11:35:27 --> Language Class Initialized
INFO - 2025-08-04 11:35:27 --> Security Class Initialized
INFO - 2025-08-04 11:35:27 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:35:27 --> Input Class Initialized
INFO - 2025-08-04 11:35:27 --> Language Class Initialized
INFO - 2025-08-04 11:35:27 --> Loader Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: url_helper
INFO - 2025-08-04 11:35:27 --> Loader Class Initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: form_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 11:35:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:35:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: url_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:35:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:35:27 --> Controller Class Initialized
INFO - 2025-08-04 11:35:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:35:27 --> Helper loaded: form_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:35:27 --> Helper loaded: assets_helper
ERROR - 2025-08-04 11:35:27 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getHasil() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 147
INFO - 2025-08-04 11:35:27 --> Database Driver Class Initialized
INFO - 2025-08-04 11:35:27 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:35:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:35:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:35:27 --> Controller Class Initialized
INFO - 2025-08-04 11:35:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 11:35:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:35:27 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:35:27 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getLastByNoRawat() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 202
INFO - 2025-08-04 11:35:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:35:27 --> Controller Class Initialized
INFO - 2025-08-04 11:35:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:35:27 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:35:27 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::getRiwayatByNoRM() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 186
INFO - 2025-08-04 11:37:24 --> Config Class Initialized
INFO - 2025-08-04 11:37:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:37:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:37:24 --> Utf8 Class Initialized
INFO - 2025-08-04 11:37:24 --> URI Class Initialized
INFO - 2025-08-04 11:37:24 --> Router Class Initialized
INFO - 2025-08-04 11:37:24 --> Output Class Initialized
INFO - 2025-08-04 11:37:24 --> Security Class Initialized
DEBUG - 2025-08-04 11:37:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:37:24 --> Input Class Initialized
INFO - 2025-08-04 11:37:24 --> Language Class Initialized
INFO - 2025-08-04 11:37:24 --> Loader Class Initialized
INFO - 2025-08-04 11:37:24 --> Helper loaded: url_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: form_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:37:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:37:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:37:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:37:24 --> Controller Class Initialized
INFO - 2025-08-04 11:37:24 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:37:24 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:37:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:37:24 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:37:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:37:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:37:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:37:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:37:24 --> Final output sent to browser
DEBUG - 2025-08-04 11:37:24 --> Total execution time: 0.0271
INFO - 2025-08-04 11:37:24 --> Config Class Initialized
INFO - 2025-08-04 11:37:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:37:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:37:24 --> Utf8 Class Initialized
INFO - 2025-08-04 11:37:24 --> URI Class Initialized
INFO - 2025-08-04 11:37:24 --> Router Class Initialized
INFO - 2025-08-04 11:37:24 --> Output Class Initialized
INFO - 2025-08-04 11:37:24 --> Security Class Initialized
DEBUG - 2025-08-04 11:37:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:37:24 --> Input Class Initialized
INFO - 2025-08-04 11:37:24 --> Language Class Initialized
INFO - 2025-08-04 11:37:24 --> Loader Class Initialized
INFO - 2025-08-04 11:37:24 --> Helper loaded: url_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: form_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:37:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:37:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:37:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:37:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:37:24 --> Controller Class Initialized
INFO - 2025-08-04 11:37:24 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:37:24 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:37:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:37:24 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:37:24 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:37:24 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:37:24 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:37:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:37:24 --> Final output sent to browser
DEBUG - 2025-08-04 11:37:24 --> Total execution time: 0.0139
INFO - 2025-08-04 11:37:25 --> Config Class Initialized
INFO - 2025-08-04 11:37:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:37:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:37:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:37:25 --> URI Class Initialized
INFO - 2025-08-04 11:37:25 --> Router Class Initialized
INFO - 2025-08-04 11:37:25 --> Output Class Initialized
INFO - 2025-08-04 11:37:25 --> Security Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:37:25 --> Input Class Initialized
INFO - 2025-08-04 11:37:25 --> Language Class Initialized
INFO - 2025-08-04 11:37:25 --> Loader Class Initialized
INFO - 2025-08-04 11:37:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:37:25 --> Config Class Initialized
INFO - 2025-08-04 11:37:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:37:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:37:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:37:25 --> URI Class Initialized
INFO - 2025-08-04 11:37:25 --> Router Class Initialized
INFO - 2025-08-04 11:37:25 --> Database Driver Class Initialized
INFO - 2025-08-04 11:37:25 --> Output Class Initialized
INFO - 2025-08-04 11:37:25 --> Security Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:37:25 --> Input Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:37:25 --> Language Class Initialized
INFO - 2025-08-04 11:37:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:37:25 --> Controller Class Initialized
INFO - 2025-08-04 11:37:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:37:25 --> Loader Class Initialized
INFO - 2025-08-04 11:37:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:37:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2025-08-04 11:37:25 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:37:25 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:37:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:37:25 --> Controller Class Initialized
INFO - 2025-08-04 11:37:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:37:25 --> Config Class Initialized
INFO - 2025-08-04 11:37:25 --> Hooks Class Initialized
ERROR - 2025-08-04 11:37:25 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
DEBUG - 2025-08-04 11:37:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:37:25 --> Utf8 Class Initialized
INFO - 2025-08-04 11:37:25 --> URI Class Initialized
INFO - 2025-08-04 11:37:25 --> Router Class Initialized
INFO - 2025-08-04 11:37:25 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:37:25 --> Output Class Initialized
INFO - 2025-08-04 11:37:25 --> Security Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:37:25 --> Input Class Initialized
INFO - 2025-08-04 11:37:25 --> Language Class Initialized
INFO - 2025-08-04 11:37:25 --> Loader Class Initialized
INFO - 2025-08-04 11:37:25 --> Helper loaded: url_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: form_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:37:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:37:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:37:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:37:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:37:25 --> Controller Class Initialized
INFO - 2025-08-04 11:37:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:37:25 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:37:25 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rkm_medis` = '000002'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:37:25 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:38:03 --> Config Class Initialized
INFO - 2025-08-04 11:38:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:03 --> URI Class Initialized
INFO - 2025-08-04 11:38:03 --> Router Class Initialized
INFO - 2025-08-04 11:38:03 --> Output Class Initialized
INFO - 2025-08-04 11:38:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:03 --> Input Class Initialized
INFO - 2025-08-04 11:38:03 --> Language Class Initialized
INFO - 2025-08-04 11:38:03 --> Loader Class Initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: url_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:03 --> Controller Class Initialized
INFO - 2025-08-04 11:38:03 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:38:03 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:38:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:38:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:38:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:38:03 --> Final output sent to browser
DEBUG - 2025-08-04 11:38:03 --> Total execution time: 0.0207
INFO - 2025-08-04 11:38:03 --> Config Class Initialized
INFO - 2025-08-04 11:38:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:03 --> URI Class Initialized
INFO - 2025-08-04 11:38:03 --> Router Class Initialized
INFO - 2025-08-04 11:38:03 --> Output Class Initialized
INFO - 2025-08-04 11:38:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:03 --> Input Class Initialized
INFO - 2025-08-04 11:38:03 --> Language Class Initialized
INFO - 2025-08-04 11:38:03 --> Loader Class Initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: url_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:03 --> Controller Class Initialized
INFO - 2025-08-04 11:38:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:38:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:38:03 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:38:03 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:38:03 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:38:03 --> Final output sent to browser
DEBUG - 2025-08-04 11:38:03 --> Total execution time: 0.0139
INFO - 2025-08-04 11:38:03 --> Config Class Initialized
INFO - 2025-08-04 11:38:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:03 --> URI Class Initialized
INFO - 2025-08-04 11:38:03 --> Router Class Initialized
INFO - 2025-08-04 11:38:03 --> Output Class Initialized
INFO - 2025-08-04 11:38:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:03 --> Input Class Initialized
INFO - 2025-08-04 11:38:03 --> Language Class Initialized
INFO - 2025-08-04 11:38:03 --> Config Class Initialized
INFO - 2025-08-04 11:38:03 --> Hooks Class Initialized
INFO - 2025-08-04 11:38:03 --> Loader Class Initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:38:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:03 --> URI Class Initialized
INFO - 2025-08-04 11:38:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:03 --> Controller Class Initialized
INFO - 2025-08-04 11:38:03 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:03 --> Router Class Initialized
INFO - 2025-08-04 11:38:03 --> Output Class Initialized
INFO - 2025-08-04 11:38:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:03 --> Input Class Initialized
INFO - 2025-08-04 11:38:03 --> Language Class Initialized
INFO - 2025-08-04 11:38:03 --> Config Class Initialized
INFO - 2025-08-04 11:38:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:03 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:03 --> URI Class Initialized
INFO - 2025-08-04 11:38:03 --> Loader Class Initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: url_helper
ERROR - 2025-08-04 11:38:03 --> Query error: Unknown column 'tgl_perawatan' in 'order clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:03 --> Router Class Initialized
INFO - 2025-08-04 11:38:03 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:38:03 --> Output Class Initialized
INFO - 2025-08-04 11:38:03 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:03 --> Database Driver Class Initialized
INFO - 2025-08-04 11:38:03 --> Input Class Initialized
INFO - 2025-08-04 11:38:03 --> Language Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:03 --> Controller Class Initialized
INFO - 2025-08-04 11:38:03 --> Loader Class Initialized
INFO - 2025-08-04 11:38:03 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:03 --> Helper loaded: url_helper
ERROR - 2025-08-04 11:38:03 --> Query error: Unknown column 'tgl_perawatan' in 'order clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:03 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:03 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:38:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:03 --> Controller Class Initialized
INFO - 2025-08-04 11:38:03 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:03 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:38:03 --> Query error: Unknown column 'no_rkm_medis' in 'where clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rkm_medis` = '000002'
ORDER BY `tgl_perawatan` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:03 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:38:33 --> Config Class Initialized
INFO - 2025-08-04 11:38:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:33 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:33 --> URI Class Initialized
INFO - 2025-08-04 11:38:33 --> Router Class Initialized
INFO - 2025-08-04 11:38:33 --> Output Class Initialized
INFO - 2025-08-04 11:38:33 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:33 --> Input Class Initialized
INFO - 2025-08-04 11:38:33 --> Language Class Initialized
INFO - 2025-08-04 11:38:33 --> Loader Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: url_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:33 --> Controller Class Initialized
INFO - 2025-08-04 11:38:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:38:33 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:38:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:38:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:38:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:38:33 --> Final output sent to browser
DEBUG - 2025-08-04 11:38:33 --> Total execution time: 0.0258
INFO - 2025-08-04 11:38:33 --> Config Class Initialized
INFO - 2025-08-04 11:38:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:33 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:33 --> URI Class Initialized
INFO - 2025-08-04 11:38:33 --> Router Class Initialized
INFO - 2025-08-04 11:38:33 --> Output Class Initialized
INFO - 2025-08-04 11:38:33 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:33 --> Input Class Initialized
INFO - 2025-08-04 11:38:33 --> Language Class Initialized
INFO - 2025-08-04 11:38:33 --> Loader Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: url_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:33 --> Controller Class Initialized
INFO - 2025-08-04 11:38:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:38:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:38:33 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:38:33 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:38:33 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:38:33 --> Final output sent to browser
DEBUG - 2025-08-04 11:38:33 --> Total execution time: 0.0162
INFO - 2025-08-04 11:38:33 --> Config Class Initialized
INFO - 2025-08-04 11:38:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:38:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:33 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:33 --> URI Class Initialized
INFO - 2025-08-04 11:38:33 --> Router Class Initialized
INFO - 2025-08-04 11:38:33 --> Output Class Initialized
INFO - 2025-08-04 11:38:33 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:33 --> Input Class Initialized
INFO - 2025-08-04 11:38:33 --> Language Class Initialized
INFO - 2025-08-04 11:38:33 --> Config Class Initialized
INFO - 2025-08-04 11:38:33 --> Hooks Class Initialized
INFO - 2025-08-04 11:38:33 --> Config Class Initialized
INFO - 2025-08-04 11:38:33 --> Hooks Class Initialized
INFO - 2025-08-04 11:38:33 --> Loader Class Initialized
DEBUG - 2025-08-04 11:38:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:33 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:38:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:38:33 --> Utf8 Class Initialized
INFO - 2025-08-04 11:38:33 --> URI Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:33 --> URI Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:33 --> Router Class Initialized
INFO - 2025-08-04 11:38:33 --> Output Class Initialized
INFO - 2025-08-04 11:38:33 --> Router Class Initialized
INFO - 2025-08-04 11:38:33 --> Security Class Initialized
INFO - 2025-08-04 11:38:33 --> Output Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:33 --> Input Class Initialized
INFO - 2025-08-04 11:38:33 --> Language Class Initialized
INFO - 2025-08-04 11:38:33 --> Database Driver Class Initialized
INFO - 2025-08-04 11:38:33 --> Security Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:38:33 --> Input Class Initialized
INFO - 2025-08-04 11:38:33 --> Loader Class Initialized
INFO - 2025-08-04 11:38:33 --> Language Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: url_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:33 --> Loader Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: url_helper
DEBUG - 2025-08-04 11:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:33 --> Helper loaded: form_helper
INFO - 2025-08-04 11:38:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:38:33 --> Controller Class Initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:38:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:38:33 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:38:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:38:33 --> Database Driver Class Initialized
ERROR - 2025-08-04 11:38:33 --> Query error: Unknown column 'jam_rawat' in 'order clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tanggal` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:33 --> Language file loaded: language/english/db_lang.php
DEBUG - 2025-08-04 11:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:38:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:33 --> Controller Class Initialized
INFO - 2025-08-04 11:38:33 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:38:33 --> Query error: Unknown column 'jam_rawat' in 'order clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tanggal` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:33 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:38:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:38:33 --> Controller Class Initialized
INFO - 2025-08-04 11:38:33 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:38:33 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:38:33 --> Query error: Unknown column 'no_rkm_medis' in 'where clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rkm_medis` = '000002'
ORDER BY `tanggal` DESC, `jam_rawat` DESC
INFO - 2025-08-04 11:38:33 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:39:51 --> Config Class Initialized
INFO - 2025-08-04 11:39:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:39:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:39:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:39:51 --> URI Class Initialized
INFO - 2025-08-04 11:39:51 --> Router Class Initialized
INFO - 2025-08-04 11:39:51 --> Output Class Initialized
INFO - 2025-08-04 11:39:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:39:51 --> Input Class Initialized
INFO - 2025-08-04 11:39:51 --> Language Class Initialized
INFO - 2025-08-04 11:39:51 --> Loader Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:39:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:39:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:39:51 --> Controller Class Initialized
INFO - 2025-08-04 11:39:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:39:51 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:39:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:39:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:39:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:39:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:39:51 --> Total execution time: 0.0217
INFO - 2025-08-04 11:39:51 --> Config Class Initialized
INFO - 2025-08-04 11:39:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:39:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:39:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:39:51 --> URI Class Initialized
INFO - 2025-08-04 11:39:51 --> Router Class Initialized
INFO - 2025-08-04 11:39:51 --> Output Class Initialized
INFO - 2025-08-04 11:39:51 --> Security Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:39:51 --> Input Class Initialized
INFO - 2025-08-04 11:39:51 --> Language Class Initialized
INFO - 2025-08-04 11:39:51 --> Loader Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:39:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:39:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:39:51 --> Controller Class Initialized
INFO - 2025-08-04 11:39:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:39:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:39:51 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:39:51 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:39:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:39:51 --> Final output sent to browser
DEBUG - 2025-08-04 11:39:51 --> Total execution time: 0.0214
INFO - 2025-08-04 11:39:51 --> Config Class Initialized
INFO - 2025-08-04 11:39:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:39:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:39:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:39:51 --> URI Class Initialized
INFO - 2025-08-04 11:39:51 --> Router Class Initialized
INFO - 2025-08-04 11:39:51 --> Output Class Initialized
INFO - 2025-08-04 11:39:51 --> Config Class Initialized
INFO - 2025-08-04 11:39:51 --> Security Class Initialized
INFO - 2025-08-04 11:39:51 --> Hooks Class Initialized
INFO - 2025-08-04 11:39:51 --> Config Class Initialized
INFO - 2025-08-04 11:39:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:39:51 --> Input Class Initialized
INFO - 2025-08-04 11:39:51 --> Language Class Initialized
DEBUG - 2025-08-04 11:39:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:39:51 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:39:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:39:51 --> Utf8 Class Initialized
INFO - 2025-08-04 11:39:51 --> URI Class Initialized
INFO - 2025-08-04 11:39:51 --> URI Class Initialized
INFO - 2025-08-04 11:39:51 --> Loader Class Initialized
INFO - 2025-08-04 11:39:51 --> Router Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:39:51 --> Router Class Initialized
INFO - 2025-08-04 11:39:51 --> Output Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:39:51 --> Security Class Initialized
INFO - 2025-08-04 11:39:51 --> Output Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:39:51 --> Input Class Initialized
INFO - 2025-08-04 11:39:51 --> Security Class Initialized
INFO - 2025-08-04 11:39:51 --> Language Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:39:51 --> Input Class Initialized
INFO - 2025-08-04 11:39:51 --> Language Class Initialized
INFO - 2025-08-04 11:39:51 --> Loader Class Initialized
INFO - 2025-08-04 11:39:51 --> Database Driver Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:39:51 --> Loader Class Initialized
INFO - 2025-08-04 11:39:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: url_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: form_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:39:51 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 11:39:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:39:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:39:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:39:51 --> Controller Class Initialized
INFO - 2025-08-04 11:39:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:39:51 --> Database Driver Class Initialized
INFO - 2025-08-04 11:39:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:39:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 11:39:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2025-08-04 11:39:51 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tanggal` DESC
INFO - 2025-08-04 11:39:51 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:39:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:39:51 --> Controller Class Initialized
INFO - 2025-08-04 11:39:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:39:51 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rkm_medis` = '000002'
ORDER BY `tanggal` DESC
INFO - 2025-08-04 11:39:51 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:39:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:39:51 --> Controller Class Initialized
INFO - 2025-08-04 11:39:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:39:51 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:39:51 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rawat` = '2025/08/04/000001'
ORDER BY `tanggal` DESC
INFO - 2025-08-04 11:39:51 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:40:11 --> Config Class Initialized
INFO - 2025-08-04 11:40:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:40:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:40:11 --> Utf8 Class Initialized
INFO - 2025-08-04 11:40:11 --> URI Class Initialized
INFO - 2025-08-04 11:40:11 --> Router Class Initialized
INFO - 2025-08-04 11:40:11 --> Output Class Initialized
INFO - 2025-08-04 11:40:11 --> Security Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:40:11 --> Input Class Initialized
INFO - 2025-08-04 11:40:11 --> Language Class Initialized
INFO - 2025-08-04 11:40:11 --> Loader Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: url_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: form_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:40:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:40:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:40:11 --> Controller Class Initialized
INFO - 2025-08-04 11:40:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:40:11 --> Model "SettingModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 11:40:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 11:40:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 11:40:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 11:40:11 --> Final output sent to browser
DEBUG - 2025-08-04 11:40:11 --> Total execution time: 0.0256
INFO - 2025-08-04 11:40:11 --> Config Class Initialized
INFO - 2025-08-04 11:40:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:40:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:40:11 --> Utf8 Class Initialized
INFO - 2025-08-04 11:40:11 --> URI Class Initialized
INFO - 2025-08-04 11:40:11 --> Router Class Initialized
INFO - 2025-08-04 11:40:11 --> Output Class Initialized
INFO - 2025-08-04 11:40:11 --> Security Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:40:11 --> Input Class Initialized
INFO - 2025-08-04 11:40:11 --> Language Class Initialized
INFO - 2025-08-04 11:40:11 --> Loader Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: url_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: form_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:40:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:40:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:40:11 --> Controller Class Initialized
INFO - 2025-08-04 11:40:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 11:40:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 11:40:11 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 11:40:11 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 11:40:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 11:40:11 --> Final output sent to browser
DEBUG - 2025-08-04 11:40:11 --> Total execution time: 0.0157
INFO - 2025-08-04 11:40:11 --> Config Class Initialized
INFO - 2025-08-04 11:40:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:40:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:40:11 --> Utf8 Class Initialized
INFO - 2025-08-04 11:40:11 --> URI Class Initialized
INFO - 2025-08-04 11:40:11 --> Router Class Initialized
INFO - 2025-08-04 11:40:11 --> Config Class Initialized
INFO - 2025-08-04 11:40:11 --> Hooks Class Initialized
INFO - 2025-08-04 11:40:11 --> Output Class Initialized
DEBUG - 2025-08-04 11:40:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:40:11 --> Security Class Initialized
INFO - 2025-08-04 11:40:11 --> Utf8 Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:40:11 --> Input Class Initialized
INFO - 2025-08-04 11:40:11 --> Language Class Initialized
INFO - 2025-08-04 11:40:11 --> URI Class Initialized
INFO - 2025-08-04 11:40:11 --> Config Class Initialized
INFO - 2025-08-04 11:40:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 11:40:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 11:40:11 --> Utf8 Class Initialized
INFO - 2025-08-04 11:40:11 --> Loader Class Initialized
INFO - 2025-08-04 11:40:11 --> Router Class Initialized
INFO - 2025-08-04 11:40:11 --> URI Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: url_helper
INFO - 2025-08-04 11:40:11 --> Output Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: form_helper
INFO - 2025-08-04 11:40:11 --> Router Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:40:11 --> Security Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:40:11 --> Output Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:40:11 --> Input Class Initialized
INFO - 2025-08-04 11:40:11 --> Language Class Initialized
INFO - 2025-08-04 11:40:11 --> Security Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 11:40:11 --> Input Class Initialized
INFO - 2025-08-04 11:40:11 --> Language Class Initialized
INFO - 2025-08-04 11:40:11 --> Loader Class Initialized
INFO - 2025-08-04 11:40:11 --> Database Driver Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: url_helper
INFO - 2025-08-04 11:40:11 --> Loader Class Initialized
INFO - 2025-08-04 11:40:11 --> Helper loaded: form_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: url_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: form_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 11:40:11 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 11:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:40:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:40:11 --> Controller Class Initialized
INFO - 2025-08-04 11:40:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:40:11 --> Database Driver Class Initialized
INFO - 2025-08-04 11:40:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 11:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 11:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 11:40:11 --> Final output sent to browser
DEBUG - 2025-08-04 11:40:11 --> Total execution time: 0.0128
INFO - 2025-08-04 11:40:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:40:11 --> Controller Class Initialized
INFO - 2025-08-04 11:40:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "MenuModel" initialized
ERROR - 2025-08-04 11:40:11 --> Query error: Unknown column 'no_rkm_medis' in 'where clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rkm_medis` = '000002'
ORDER BY `tanggal` DESC
INFO - 2025-08-04 11:40:11 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 11:40:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 11:40:11 --> Controller Class Initialized
INFO - 2025-08-04 11:40:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 11:40:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 11:40:11 --> Final output sent to browser
DEBUG - 2025-08-04 11:40:11 --> Total execution time: 0.0146
INFO - 2025-08-04 13:19:24 --> Config Class Initialized
INFO - 2025-08-04 13:19:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:24 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:24 --> URI Class Initialized
INFO - 2025-08-04 13:19:24 --> Router Class Initialized
INFO - 2025-08-04 13:19:24 --> Output Class Initialized
INFO - 2025-08-04 13:19:24 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:24 --> Input Class Initialized
INFO - 2025-08-04 13:19:24 --> Language Class Initialized
INFO - 2025-08-04 13:19:24 --> Loader Class Initialized
INFO - 2025-08-04 13:19:24 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:24 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:24 --> Controller Class Initialized
INFO - 2025-08-04 13:19:24 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:24 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:19:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:24 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:19:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:19:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:19:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:19:24 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:19:24 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:24 --> Total execution time: 0.0443
INFO - 2025-08-04 13:19:25 --> Config Class Initialized
INFO - 2025-08-04 13:19:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:25 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:25 --> URI Class Initialized
INFO - 2025-08-04 13:19:25 --> Router Class Initialized
INFO - 2025-08-04 13:19:25 --> Output Class Initialized
INFO - 2025-08-04 13:19:25 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:25 --> Input Class Initialized
INFO - 2025-08-04 13:19:25 --> Language Class Initialized
INFO - 2025-08-04 13:19:25 --> Loader Class Initialized
INFO - 2025-08-04 13:19:25 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:25 --> Controller Class Initialized
INFO - 2025-08-04 13:19:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:19:25 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:19:25 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:19:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:19:25 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:25 --> Total execution time: 0.0196
INFO - 2025-08-04 13:19:25 --> Config Class Initialized
INFO - 2025-08-04 13:19:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:25 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:25 --> URI Class Initialized
INFO - 2025-08-04 13:19:25 --> Router Class Initialized
INFO - 2025-08-04 13:19:25 --> Output Class Initialized
INFO - 2025-08-04 13:19:25 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:25 --> Input Class Initialized
INFO - 2025-08-04 13:19:25 --> Language Class Initialized
INFO - 2025-08-04 13:19:25 --> Config Class Initialized
INFO - 2025-08-04 13:19:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:25 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:25 --> Config Class Initialized
INFO - 2025-08-04 13:19:25 --> Hooks Class Initialized
INFO - 2025-08-04 13:19:25 --> Loader Class Initialized
INFO - 2025-08-04 13:19:25 --> URI Class Initialized
INFO - 2025-08-04 13:19:25 --> Helper loaded: url_helper
DEBUG - 2025-08-04 13:19:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:25 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:25 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:25 --> URI Class Initialized
INFO - 2025-08-04 13:19:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:25 --> Router Class Initialized
INFO - 2025-08-04 13:19:25 --> Router Class Initialized
INFO - 2025-08-04 13:19:25 --> Output Class Initialized
INFO - 2025-08-04 13:19:25 --> Output Class Initialized
INFO - 2025-08-04 13:19:25 --> Security Class Initialized
INFO - 2025-08-04 13:19:25 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:25 --> Input Class Initialized
INFO - 2025-08-04 13:19:25 --> Language Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:25 --> Input Class Initialized
INFO - 2025-08-04 13:19:25 --> Database Driver Class Initialized
INFO - 2025-08-04 13:19:25 --> Language Class Initialized
INFO - 2025-08-04 13:19:25 --> Loader Class Initialized
INFO - 2025-08-04 13:19:25 --> Loader Class Initialized
INFO - 2025-08-04 13:19:25 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:25 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 13:19:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:25 --> Controller Class Initialized
INFO - 2025-08-04 13:19:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:25 --> Database Driver Class Initialized
INFO - 2025-08-04 13:19:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 13:19:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:25 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:25 --> Total execution time: 0.0117
INFO - 2025-08-04 13:19:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:25 --> Controller Class Initialized
INFO - 2025-08-04 13:19:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:25 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:25 --> Total execution time: 0.0113
INFO - 2025-08-04 13:19:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:25 --> Controller Class Initialized
INFO - 2025-08-04 13:19:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:25 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:25 --> Total execution time: 0.0143
INFO - 2025-08-04 13:19:28 --> Config Class Initialized
INFO - 2025-08-04 13:19:28 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:28 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:28 --> URI Class Initialized
INFO - 2025-08-04 13:19:28 --> Router Class Initialized
INFO - 2025-08-04 13:19:28 --> Output Class Initialized
INFO - 2025-08-04 13:19:28 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:28 --> Input Class Initialized
INFO - 2025-08-04 13:19:28 --> Language Class Initialized
INFO - 2025-08-04 13:19:28 --> Loader Class Initialized
INFO - 2025-08-04 13:19:28 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:28 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:28 --> Controller Class Initialized
INFO - 2025-08-04 13:19:28 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:19:28 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:19:28 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 13:19:28 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:28 --> Total execution time: 0.0231
INFO - 2025-08-04 13:19:28 --> Config Class Initialized
INFO - 2025-08-04 13:19:28 --> Config Class Initialized
INFO - 2025-08-04 13:19:28 --> Config Class Initialized
INFO - 2025-08-04 13:19:28 --> Hooks Class Initialized
INFO - 2025-08-04 13:19:28 --> Hooks Class Initialized
INFO - 2025-08-04 13:19:28 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:28 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 13:19:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:28 --> Utf8 Class Initialized
DEBUG - 2025-08-04 13:19:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:28 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:28 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:28 --> URI Class Initialized
INFO - 2025-08-04 13:19:28 --> URI Class Initialized
INFO - 2025-08-04 13:19:28 --> URI Class Initialized
INFO - 2025-08-04 13:19:28 --> Router Class Initialized
INFO - 2025-08-04 13:19:28 --> Router Class Initialized
INFO - 2025-08-04 13:19:28 --> Router Class Initialized
INFO - 2025-08-04 13:19:28 --> Output Class Initialized
INFO - 2025-08-04 13:19:28 --> Output Class Initialized
INFO - 2025-08-04 13:19:28 --> Output Class Initialized
INFO - 2025-08-04 13:19:28 --> Security Class Initialized
INFO - 2025-08-04 13:19:28 --> Security Class Initialized
INFO - 2025-08-04 13:19:28 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 13:19:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:28 --> Input Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:28 --> Input Class Initialized
INFO - 2025-08-04 13:19:28 --> Input Class Initialized
INFO - 2025-08-04 13:19:28 --> Language Class Initialized
INFO - 2025-08-04 13:19:28 --> Language Class Initialized
INFO - 2025-08-04 13:19:28 --> Language Class Initialized
INFO - 2025-08-04 13:19:28 --> Loader Class Initialized
INFO - 2025-08-04 13:19:28 --> Loader Class Initialized
INFO - 2025-08-04 13:19:28 --> Loader Class Initialized
INFO - 2025-08-04 13:19:28 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:28 --> Database Driver Class Initialized
INFO - 2025-08-04 13:19:28 --> Database Driver Class Initialized
INFO - 2025-08-04 13:19:28 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 13:19:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:28 --> Controller Class Initialized
DEBUG - 2025-08-04 13:19:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:28 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:28 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:19:28 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:28 --> Total execution time: 0.0148
INFO - 2025-08-04 13:19:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:28 --> Controller Class Initialized
INFO - 2025-08-04 13:19:28 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:28 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:19:28 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:28 --> Total execution time: 0.0177
INFO - 2025-08-04 13:19:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:28 --> Controller Class Initialized
INFO - 2025-08-04 13:19:28 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:28 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:28 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:19:28 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:19:28 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:28 --> Total execution time: 0.0220
INFO - 2025-08-04 13:19:38 --> Config Class Initialized
INFO - 2025-08-04 13:19:38 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:38 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:38 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:38 --> URI Class Initialized
INFO - 2025-08-04 13:19:38 --> Router Class Initialized
INFO - 2025-08-04 13:19:38 --> Output Class Initialized
INFO - 2025-08-04 13:19:38 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:38 --> Input Class Initialized
INFO - 2025-08-04 13:19:38 --> Language Class Initialized
INFO - 2025-08-04 13:19:38 --> Loader Class Initialized
INFO - 2025-08-04 13:19:38 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:38 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:38 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:38 --> Controller Class Initialized
INFO - 2025-08-04 13:19:38 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:19:38 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:19:38 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:19:38 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:19:38 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:19:38 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:38 --> Total execution time: 0.0307
INFO - 2025-08-04 13:19:38 --> Config Class Initialized
INFO - 2025-08-04 13:19:38 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:38 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:38 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:38 --> URI Class Initialized
INFO - 2025-08-04 13:19:38 --> Router Class Initialized
INFO - 2025-08-04 13:19:38 --> Output Class Initialized
INFO - 2025-08-04 13:19:38 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:38 --> Input Class Initialized
INFO - 2025-08-04 13:19:38 --> Language Class Initialized
INFO - 2025-08-04 13:19:38 --> Loader Class Initialized
INFO - 2025-08-04 13:19:38 --> Config Class Initialized
INFO - 2025-08-04 13:19:38 --> Hooks Class Initialized
INFO - 2025-08-04 13:19:38 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: form_helper
DEBUG - 2025-08-04 13:19:38 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:38 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:38 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:38 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:38 --> URI Class Initialized
INFO - 2025-08-04 13:19:38 --> Router Class Initialized
INFO - 2025-08-04 13:19:38 --> Database Driver Class Initialized
INFO - 2025-08-04 13:19:38 --> Output Class Initialized
INFO - 2025-08-04 13:19:38 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:38 --> Input Class Initialized
INFO - 2025-08-04 13:19:38 --> Language Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:38 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:38 --> Controller Class Initialized
INFO - 2025-08-04 13:19:38 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Loader Class Initialized
INFO - 2025-08-04 13:19:38 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:38 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:38 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:38 --> Total execution time: 0.0111
INFO - 2025-08-04 13:19:38 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:38 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:38 --> Controller Class Initialized
INFO - 2025-08-04 13:19:38 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:38 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:38 --> Total execution time: 0.0118
INFO - 2025-08-04 13:19:38 --> Config Class Initialized
INFO - 2025-08-04 13:19:38 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:19:38 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:19:38 --> Utf8 Class Initialized
INFO - 2025-08-04 13:19:38 --> URI Class Initialized
INFO - 2025-08-04 13:19:38 --> Router Class Initialized
INFO - 2025-08-04 13:19:38 --> Output Class Initialized
INFO - 2025-08-04 13:19:38 --> Security Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:19:38 --> Input Class Initialized
INFO - 2025-08-04 13:19:38 --> Language Class Initialized
INFO - 2025-08-04 13:19:38 --> Loader Class Initialized
INFO - 2025-08-04 13:19:38 --> Helper loaded: url_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: form_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:19:38 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:19:38 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:19:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:19:38 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:19:38 --> Controller Class Initialized
INFO - 2025-08-04 13:19:38 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:19:38 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:19:38 --> Final output sent to browser
DEBUG - 2025-08-04 13:19:38 --> Total execution time: 0.0171
INFO - 2025-08-04 13:20:48 --> Config Class Initialized
INFO - 2025-08-04 13:20:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:20:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:20:48 --> Utf8 Class Initialized
INFO - 2025-08-04 13:20:48 --> URI Class Initialized
INFO - 2025-08-04 13:20:48 --> Router Class Initialized
INFO - 2025-08-04 13:20:48 --> Output Class Initialized
INFO - 2025-08-04 13:20:48 --> Security Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:20:48 --> Input Class Initialized
INFO - 2025-08-04 13:20:48 --> Language Class Initialized
INFO - 2025-08-04 13:20:48 --> Loader Class Initialized
INFO - 2025-08-04 13:20:48 --> Helper loaded: url_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: form_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:20:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:20:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:20:48 --> Controller Class Initialized
INFO - 2025-08-04 13:20:48 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:20:48 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:20:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:20:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:20:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:20:48 --> Final output sent to browser
DEBUG - 2025-08-04 13:20:48 --> Total execution time: 0.0239
INFO - 2025-08-04 13:20:48 --> Config Class Initialized
INFO - 2025-08-04 13:20:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:20:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:20:48 --> Utf8 Class Initialized
INFO - 2025-08-04 13:20:48 --> URI Class Initialized
INFO - 2025-08-04 13:20:48 --> Router Class Initialized
INFO - 2025-08-04 13:20:48 --> Output Class Initialized
INFO - 2025-08-04 13:20:48 --> Security Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:20:48 --> Input Class Initialized
INFO - 2025-08-04 13:20:48 --> Language Class Initialized
INFO - 2025-08-04 13:20:48 --> Loader Class Initialized
INFO - 2025-08-04 13:20:48 --> Helper loaded: url_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: form_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:20:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:20:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:20:48 --> Controller Class Initialized
INFO - 2025-08-04 13:20:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:20:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:20:48 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:20:48 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:20:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:20:48 --> Final output sent to browser
DEBUG - 2025-08-04 13:20:48 --> Total execution time: 0.0218
INFO - 2025-08-04 13:20:48 --> Config Class Initialized
INFO - 2025-08-04 13:20:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:20:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:20:48 --> Utf8 Class Initialized
INFO - 2025-08-04 13:20:48 --> URI Class Initialized
INFO - 2025-08-04 13:20:48 --> Router Class Initialized
INFO - 2025-08-04 13:20:48 --> Output Class Initialized
INFO - 2025-08-04 13:20:48 --> Security Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:20:48 --> Input Class Initialized
INFO - 2025-08-04 13:20:48 --> Language Class Initialized
INFO - 2025-08-04 13:20:48 --> Loader Class Initialized
INFO - 2025-08-04 13:20:48 --> Helper loaded: url_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: form_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:20:48 --> Database Driver Class Initialized
INFO - 2025-08-04 13:20:48 --> Config Class Initialized
INFO - 2025-08-04 13:20:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:20:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:20:48 --> Utf8 Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:20:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:20:48 --> Controller Class Initialized
INFO - 2025-08-04 13:20:48 --> URI Class Initialized
INFO - 2025-08-04 13:20:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:20:48 --> Router Class Initialized
INFO - 2025-08-04 13:20:48 --> Output Class Initialized
INFO - 2025-08-04 13:20:48 --> Final output sent to browser
DEBUG - 2025-08-04 13:20:48 --> Total execution time: 0.0093
INFO - 2025-08-04 13:20:48 --> Security Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:20:48 --> Input Class Initialized
INFO - 2025-08-04 13:20:48 --> Language Class Initialized
INFO - 2025-08-04 13:20:48 --> Loader Class Initialized
INFO - 2025-08-04 13:20:48 --> Helper loaded: url_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: form_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:20:48 --> Config Class Initialized
INFO - 2025-08-04 13:20:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:20:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:20:48 --> Utf8 Class Initialized
INFO - 2025-08-04 13:20:48 --> Database Driver Class Initialized
INFO - 2025-08-04 13:20:48 --> URI Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:20:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:20:48 --> Controller Class Initialized
INFO - 2025-08-04 13:20:48 --> Router Class Initialized
INFO - 2025-08-04 13:20:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:20:48 --> Output Class Initialized
INFO - 2025-08-04 13:20:48 --> Security Class Initialized
INFO - 2025-08-04 13:20:48 --> Final output sent to browser
DEBUG - 2025-08-04 13:20:48 --> Total execution time: 0.0126
DEBUG - 2025-08-04 13:20:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:20:48 --> Input Class Initialized
INFO - 2025-08-04 13:20:48 --> Language Class Initialized
INFO - 2025-08-04 13:20:48 --> Loader Class Initialized
INFO - 2025-08-04 13:20:48 --> Helper loaded: url_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: form_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:20:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:20:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:20:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:20:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:20:48 --> Controller Class Initialized
INFO - 2025-08-04 13:20:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:20:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:20:48 --> Final output sent to browser
DEBUG - 2025-08-04 13:20:48 --> Total execution time: 0.0148
INFO - 2025-08-04 13:21:11 --> Config Class Initialized
INFO - 2025-08-04 13:21:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:21:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:21:11 --> Utf8 Class Initialized
INFO - 2025-08-04 13:21:11 --> URI Class Initialized
INFO - 2025-08-04 13:21:11 --> Router Class Initialized
INFO - 2025-08-04 13:21:11 --> Output Class Initialized
INFO - 2025-08-04 13:21:11 --> Security Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:21:11 --> Input Class Initialized
INFO - 2025-08-04 13:21:11 --> Language Class Initialized
INFO - 2025-08-04 13:21:11 --> Loader Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: url_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: form_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:21:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:21:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:21:11 --> Controller Class Initialized
INFO - 2025-08-04 13:21:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:21:11 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:21:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:21:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:21:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:21:11 --> Final output sent to browser
DEBUG - 2025-08-04 13:21:11 --> Total execution time: 0.0249
INFO - 2025-08-04 13:21:11 --> Config Class Initialized
INFO - 2025-08-04 13:21:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:21:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:21:11 --> Utf8 Class Initialized
INFO - 2025-08-04 13:21:11 --> URI Class Initialized
INFO - 2025-08-04 13:21:11 --> Router Class Initialized
INFO - 2025-08-04 13:21:11 --> Output Class Initialized
INFO - 2025-08-04 13:21:11 --> Security Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:21:11 --> Input Class Initialized
INFO - 2025-08-04 13:21:11 --> Language Class Initialized
INFO - 2025-08-04 13:21:11 --> Loader Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: url_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: form_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:21:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:21:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:21:11 --> Controller Class Initialized
INFO - 2025-08-04 13:21:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:21:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:21:11 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:21:11 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:21:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:21:11 --> Final output sent to browser
DEBUG - 2025-08-04 13:21:11 --> Total execution time: 0.0191
INFO - 2025-08-04 13:21:11 --> Config Class Initialized
INFO - 2025-08-04 13:21:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:21:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:21:11 --> Utf8 Class Initialized
INFO - 2025-08-04 13:21:11 --> URI Class Initialized
INFO - 2025-08-04 13:21:11 --> Router Class Initialized
INFO - 2025-08-04 13:21:11 --> Output Class Initialized
INFO - 2025-08-04 13:21:11 --> Security Class Initialized
INFO - 2025-08-04 13:21:11 --> Config Class Initialized
INFO - 2025-08-04 13:21:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:21:11 --> Input Class Initialized
INFO - 2025-08-04 13:21:11 --> Language Class Initialized
DEBUG - 2025-08-04 13:21:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:21:11 --> Utf8 Class Initialized
INFO - 2025-08-04 13:21:11 --> URI Class Initialized
INFO - 2025-08-04 13:21:11 --> Config Class Initialized
INFO - 2025-08-04 13:21:11 --> Hooks Class Initialized
INFO - 2025-08-04 13:21:11 --> Loader Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: url_helper
DEBUG - 2025-08-04 13:21:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:21:11 --> Router Class Initialized
INFO - 2025-08-04 13:21:11 --> Utf8 Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: form_helper
INFO - 2025-08-04 13:21:11 --> URI Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:21:11 --> Output Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:21:11 --> Security Class Initialized
INFO - 2025-08-04 13:21:11 --> Router Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:21:11 --> Input Class Initialized
INFO - 2025-08-04 13:21:11 --> Output Class Initialized
INFO - 2025-08-04 13:21:11 --> Language Class Initialized
INFO - 2025-08-04 13:21:11 --> Security Class Initialized
INFO - 2025-08-04 13:21:11 --> Loader Class Initialized
DEBUG - 2025-08-04 13:21:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:21:11 --> Input Class Initialized
INFO - 2025-08-04 13:21:11 --> Database Driver Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: url_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: form_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:21:11 --> Language Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:21:11 --> Loader Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: url_helper
DEBUG - 2025-08-04 13:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:21:11 --> Helper loaded: form_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:21:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:21:11 --> Controller Class Initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:21:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:21:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:21:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:21:11 --> Database Driver Class Initialized
INFO - 2025-08-04 13:21:11 --> Final output sent to browser
DEBUG - 2025-08-04 13:21:11 --> Total execution time: 0.0103
DEBUG - 2025-08-04 13:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:21:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:21:11 --> Database Driver Class Initialized
INFO - 2025-08-04 13:21:11 --> Controller Class Initialized
INFO - 2025-08-04 13:21:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:21:11 --> Final output sent to browser
DEBUG - 2025-08-04 13:21:11 --> Total execution time: 0.0090
DEBUG - 2025-08-04 13:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:21:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:21:11 --> Controller Class Initialized
INFO - 2025-08-04 13:21:11 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:21:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:21:11 --> Final output sent to browser
DEBUG - 2025-08-04 13:21:11 --> Total execution time: 0.0110
INFO - 2025-08-04 13:22:00 --> Config Class Initialized
INFO - 2025-08-04 13:22:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:22:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:22:00 --> Utf8 Class Initialized
INFO - 2025-08-04 13:22:00 --> URI Class Initialized
INFO - 2025-08-04 13:22:00 --> Router Class Initialized
INFO - 2025-08-04 13:22:00 --> Output Class Initialized
INFO - 2025-08-04 13:22:00 --> Security Class Initialized
DEBUG - 2025-08-04 13:22:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:22:00 --> Input Class Initialized
INFO - 2025-08-04 13:22:00 --> Language Class Initialized
INFO - 2025-08-04 13:22:00 --> Loader Class Initialized
INFO - 2025-08-04 13:22:00 --> Helper loaded: url_helper
INFO - 2025-08-04 13:22:00 --> Helper loaded: form_helper
INFO - 2025-08-04 13:22:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:22:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:22:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:22:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:22:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:22:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:22:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:22:00 --> Controller Class Initialized
INFO - 2025-08-04 13:22:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:22:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:22:00 --> Model "MenuModel" initialized
ERROR - 2025-08-04 13:22:00 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::save() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 66
INFO - 2025-08-04 13:23:56 --> Config Class Initialized
INFO - 2025-08-04 13:23:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:23:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:23:56 --> Utf8 Class Initialized
INFO - 2025-08-04 13:23:56 --> URI Class Initialized
INFO - 2025-08-04 13:23:56 --> Router Class Initialized
INFO - 2025-08-04 13:23:56 --> Output Class Initialized
INFO - 2025-08-04 13:23:56 --> Security Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:23:56 --> Input Class Initialized
INFO - 2025-08-04 13:23:56 --> Language Class Initialized
INFO - 2025-08-04 13:23:56 --> Loader Class Initialized
INFO - 2025-08-04 13:23:56 --> Helper loaded: url_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: form_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:23:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:23:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:23:56 --> Controller Class Initialized
INFO - 2025-08-04 13:23:56 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:23:56 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:23:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:23:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:23:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:23:56 --> Final output sent to browser
DEBUG - 2025-08-04 13:23:56 --> Total execution time: 0.0245
INFO - 2025-08-04 13:23:56 --> Config Class Initialized
INFO - 2025-08-04 13:23:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:23:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:23:56 --> Utf8 Class Initialized
INFO - 2025-08-04 13:23:56 --> URI Class Initialized
INFO - 2025-08-04 13:23:56 --> Router Class Initialized
INFO - 2025-08-04 13:23:56 --> Output Class Initialized
INFO - 2025-08-04 13:23:56 --> Security Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:23:56 --> Input Class Initialized
INFO - 2025-08-04 13:23:56 --> Language Class Initialized
INFO - 2025-08-04 13:23:56 --> Loader Class Initialized
INFO - 2025-08-04 13:23:56 --> Helper loaded: url_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: form_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:23:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:23:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:23:56 --> Controller Class Initialized
INFO - 2025-08-04 13:23:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:23:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:23:56 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:23:56 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:23:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:23:56 --> Final output sent to browser
DEBUG - 2025-08-04 13:23:56 --> Total execution time: 0.0212
INFO - 2025-08-04 13:23:56 --> Config Class Initialized
INFO - 2025-08-04 13:23:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:23:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:23:56 --> Utf8 Class Initialized
INFO - 2025-08-04 13:23:56 --> URI Class Initialized
INFO - 2025-08-04 13:23:56 --> Router Class Initialized
INFO - 2025-08-04 13:23:56 --> Output Class Initialized
INFO - 2025-08-04 13:23:56 --> Security Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:23:56 --> Input Class Initialized
INFO - 2025-08-04 13:23:56 --> Language Class Initialized
INFO - 2025-08-04 13:23:56 --> Loader Class Initialized
INFO - 2025-08-04 13:23:56 --> Helper loaded: url_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: form_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:23:56 --> Config Class Initialized
INFO - 2025-08-04 13:23:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:23:56 --> Hooks Class Initialized
INFO - 2025-08-04 13:23:56 --> Config Class Initialized
INFO - 2025-08-04 13:23:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:23:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:23:56 --> Utf8 Class Initialized
DEBUG - 2025-08-04 13:23:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:23:56 --> Utf8 Class Initialized
INFO - 2025-08-04 13:23:56 --> URI Class Initialized
INFO - 2025-08-04 13:23:56 --> URI Class Initialized
INFO - 2025-08-04 13:23:56 --> Router Class Initialized
INFO - 2025-08-04 13:23:56 --> Router Class Initialized
INFO - 2025-08-04 13:23:56 --> Database Driver Class Initialized
INFO - 2025-08-04 13:23:56 --> Output Class Initialized
INFO - 2025-08-04 13:23:56 --> Output Class Initialized
INFO - 2025-08-04 13:23:56 --> Security Class Initialized
INFO - 2025-08-04 13:23:56 --> Security Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 13:23:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 13:23:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:23:56 --> Input Class Initialized
INFO - 2025-08-04 13:23:56 --> Input Class Initialized
INFO - 2025-08-04 13:23:56 --> Language Class Initialized
INFO - 2025-08-04 13:23:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:23:56 --> Language Class Initialized
INFO - 2025-08-04 13:23:56 --> Controller Class Initialized
INFO - 2025-08-04 13:23:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:23:56 --> Loader Class Initialized
INFO - 2025-08-04 13:23:56 --> Loader Class Initialized
INFO - 2025-08-04 13:23:56 --> Helper loaded: url_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: url_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: form_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:23:56 --> Final output sent to browser
DEBUG - 2025-08-04 13:23:56 --> Total execution time: 0.0091
INFO - 2025-08-04 13:23:56 --> Helper loaded: form_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:23:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:23:56 --> Database Driver Class Initialized
INFO - 2025-08-04 13:23:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:23:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:23:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:23:56 --> Controller Class Initialized
INFO - 2025-08-04 13:23:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 13:23:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:23:56 --> Final output sent to browser
DEBUG - 2025-08-04 13:23:56 --> Total execution time: 0.0097
INFO - 2025-08-04 13:23:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:23:56 --> Controller Class Initialized
INFO - 2025-08-04 13:23:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:23:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:23:56 --> Final output sent to browser
DEBUG - 2025-08-04 13:23:56 --> Total execution time: 0.0116
INFO - 2025-08-04 13:24:20 --> Config Class Initialized
INFO - 2025-08-04 13:24:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:24:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:24:20 --> Utf8 Class Initialized
INFO - 2025-08-04 13:24:20 --> URI Class Initialized
INFO - 2025-08-04 13:24:20 --> Router Class Initialized
INFO - 2025-08-04 13:24:20 --> Output Class Initialized
INFO - 2025-08-04 13:24:20 --> Security Class Initialized
DEBUG - 2025-08-04 13:24:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:24:20 --> Input Class Initialized
INFO - 2025-08-04 13:24:20 --> Language Class Initialized
INFO - 2025-08-04 13:24:20 --> Loader Class Initialized
INFO - 2025-08-04 13:24:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:24:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:24:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:24:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:24:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:24:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:24:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:24:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:24:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:24:20 --> Controller Class Initialized
INFO - 2025-08-04 13:24:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:24:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:24:20 --> Model "MenuModel" initialized
ERROR - 2025-08-04 13:24:20 --> Query error: Unknown column 'tgl_perawatan' in 'field list' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `tgl_perawatan`, `jam_rawat`, `keluhan_utama`, `riwayat_penggunaan_obat`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `nip`) VALUES ('2025/08/04/000001', '2025-08-04', '18:23:56', 'keluhan utama', 'sdsd', 'sds', 'sdsd', 'dsds', '21', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '150')
INFO - 2025-08-04 13:24:20 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 13:25:20 --> Config Class Initialized
INFO - 2025-08-04 13:25:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:25:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:20 --> Utf8 Class Initialized
INFO - 2025-08-04 13:25:20 --> URI Class Initialized
INFO - 2025-08-04 13:25:20 --> Router Class Initialized
INFO - 2025-08-04 13:25:20 --> Output Class Initialized
INFO - 2025-08-04 13:25:20 --> Security Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:20 --> Input Class Initialized
INFO - 2025-08-04 13:25:20 --> Language Class Initialized
INFO - 2025-08-04 13:25:20 --> Loader Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:25:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:25:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:20 --> Controller Class Initialized
INFO - 2025-08-04 13:25:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:25:20 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:25:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:25:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:25:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:25:20 --> Final output sent to browser
DEBUG - 2025-08-04 13:25:20 --> Total execution time: 0.0222
INFO - 2025-08-04 13:25:20 --> Config Class Initialized
INFO - 2025-08-04 13:25:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:25:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:20 --> Utf8 Class Initialized
INFO - 2025-08-04 13:25:20 --> URI Class Initialized
INFO - 2025-08-04 13:25:20 --> Router Class Initialized
INFO - 2025-08-04 13:25:20 --> Output Class Initialized
INFO - 2025-08-04 13:25:20 --> Security Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:20 --> Input Class Initialized
INFO - 2025-08-04 13:25:20 --> Language Class Initialized
INFO - 2025-08-04 13:25:20 --> Loader Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:25:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:25:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:20 --> Controller Class Initialized
INFO - 2025-08-04 13:25:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:25:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:25:20 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:25:20 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:25:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:25:20 --> Final output sent to browser
DEBUG - 2025-08-04 13:25:20 --> Total execution time: 0.0215
INFO - 2025-08-04 13:25:20 --> Config Class Initialized
INFO - 2025-08-04 13:25:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:25:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:20 --> Utf8 Class Initialized
INFO - 2025-08-04 13:25:20 --> URI Class Initialized
INFO - 2025-08-04 13:25:20 --> Router Class Initialized
INFO - 2025-08-04 13:25:20 --> Output Class Initialized
INFO - 2025-08-04 13:25:20 --> Security Class Initialized
INFO - 2025-08-04 13:25:20 --> Config Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:20 --> Hooks Class Initialized
INFO - 2025-08-04 13:25:20 --> Config Class Initialized
INFO - 2025-08-04 13:25:20 --> Hooks Class Initialized
INFO - 2025-08-04 13:25:20 --> Input Class Initialized
INFO - 2025-08-04 13:25:20 --> Language Class Initialized
DEBUG - 2025-08-04 13:25:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:20 --> Utf8 Class Initialized
DEBUG - 2025-08-04 13:25:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:20 --> Utf8 Class Initialized
INFO - 2025-08-04 13:25:20 --> URI Class Initialized
INFO - 2025-08-04 13:25:20 --> URI Class Initialized
INFO - 2025-08-04 13:25:20 --> Loader Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:20 --> Router Class Initialized
INFO - 2025-08-04 13:25:20 --> Router Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:20 --> Output Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:20 --> Output Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:25:20 --> Security Class Initialized
INFO - 2025-08-04 13:25:20 --> Security Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:20 --> Input Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:20 --> Language Class Initialized
INFO - 2025-08-04 13:25:20 --> Input Class Initialized
INFO - 2025-08-04 13:25:20 --> Language Class Initialized
INFO - 2025-08-04 13:25:20 --> Loader Class Initialized
INFO - 2025-08-04 13:25:20 --> Database Driver Class Initialized
INFO - 2025-08-04 13:25:20 --> Loader Class Initialized
INFO - 2025-08-04 13:25:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:20 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 13:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:25:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:20 --> Controller Class Initialized
INFO - 2025-08-04 13:25:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:25:20 --> Final output sent to browser
INFO - 2025-08-04 13:25:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Total execution time: 0.0090
INFO - 2025-08-04 13:25:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 13:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:25:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:20 --> Controller Class Initialized
INFO - 2025-08-04 13:25:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:25:20 --> Final output sent to browser
DEBUG - 2025-08-04 13:25:20 --> Total execution time: 0.0100
INFO - 2025-08-04 13:25:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:20 --> Controller Class Initialized
INFO - 2025-08-04 13:25:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:25:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:25:20 --> Final output sent to browser
DEBUG - 2025-08-04 13:25:20 --> Total execution time: 0.0114
INFO - 2025-08-04 13:25:43 --> Config Class Initialized
INFO - 2025-08-04 13:25:43 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:25:43 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:25:43 --> Utf8 Class Initialized
INFO - 2025-08-04 13:25:43 --> URI Class Initialized
INFO - 2025-08-04 13:25:43 --> Router Class Initialized
INFO - 2025-08-04 13:25:43 --> Output Class Initialized
INFO - 2025-08-04 13:25:43 --> Security Class Initialized
DEBUG - 2025-08-04 13:25:43 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:25:43 --> Input Class Initialized
INFO - 2025-08-04 13:25:43 --> Language Class Initialized
INFO - 2025-08-04 13:25:43 --> Loader Class Initialized
INFO - 2025-08-04 13:25:43 --> Helper loaded: url_helper
INFO - 2025-08-04 13:25:43 --> Helper loaded: form_helper
INFO - 2025-08-04 13:25:43 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:25:43 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:25:43 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:25:43 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:25:43 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:25:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:25:43 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:25:43 --> Controller Class Initialized
INFO - 2025-08-04 13:25:43 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:25:43 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:25:43 --> Model "MenuModel" initialized
ERROR - 2025-08-04 13:25:43 --> Severity: error --> Exception: Call to undefined method AwalMedisDokterMataRalanModel::insert() /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 74
INFO - 2025-08-04 13:26:04 --> Config Class Initialized
INFO - 2025-08-04 13:26:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:26:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:04 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:04 --> URI Class Initialized
INFO - 2025-08-04 13:26:04 --> Router Class Initialized
INFO - 2025-08-04 13:26:04 --> Output Class Initialized
INFO - 2025-08-04 13:26:04 --> Security Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:04 --> Input Class Initialized
INFO - 2025-08-04 13:26:04 --> Language Class Initialized
INFO - 2025-08-04 13:26:04 --> Loader Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: url_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:26:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:04 --> Controller Class Initialized
INFO - 2025-08-04 13:26:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:26:04 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:26:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:26:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:26:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:26:04 --> Final output sent to browser
DEBUG - 2025-08-04 13:26:04 --> Total execution time: 0.0234
INFO - 2025-08-04 13:26:04 --> Config Class Initialized
INFO - 2025-08-04 13:26:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:26:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:04 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:04 --> URI Class Initialized
INFO - 2025-08-04 13:26:04 --> Router Class Initialized
INFO - 2025-08-04 13:26:04 --> Output Class Initialized
INFO - 2025-08-04 13:26:04 --> Security Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:04 --> Input Class Initialized
INFO - 2025-08-04 13:26:04 --> Language Class Initialized
INFO - 2025-08-04 13:26:04 --> Loader Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: url_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:26:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:04 --> Controller Class Initialized
INFO - 2025-08-04 13:26:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:26:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:26:04 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:26:04 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:26:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:26:04 --> Final output sent to browser
DEBUG - 2025-08-04 13:26:04 --> Total execution time: 0.0168
INFO - 2025-08-04 13:26:04 --> Config Class Initialized
INFO - 2025-08-04 13:26:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:26:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:04 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:04 --> URI Class Initialized
INFO - 2025-08-04 13:26:04 --> Router Class Initialized
INFO - 2025-08-04 13:26:04 --> Output Class Initialized
INFO - 2025-08-04 13:26:04 --> Security Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:04 --> Input Class Initialized
INFO - 2025-08-04 13:26:04 --> Language Class Initialized
INFO - 2025-08-04 13:26:04 --> Config Class Initialized
INFO - 2025-08-04 13:26:04 --> Hooks Class Initialized
INFO - 2025-08-04 13:26:04 --> Config Class Initialized
INFO - 2025-08-04 13:26:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:26:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:04 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:04 --> Loader Class Initialized
DEBUG - 2025-08-04 13:26:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:04 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: url_helper
INFO - 2025-08-04 13:26:04 --> URI Class Initialized
INFO - 2025-08-04 13:26:04 --> URI Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:04 --> Router Class Initialized
INFO - 2025-08-04 13:26:04 --> Output Class Initialized
INFO - 2025-08-04 13:26:04 --> Router Class Initialized
INFO - 2025-08-04 13:26:04 --> Security Class Initialized
INFO - 2025-08-04 13:26:04 --> Output Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:04 --> Input Class Initialized
INFO - 2025-08-04 13:26:04 --> Language Class Initialized
INFO - 2025-08-04 13:26:04 --> Security Class Initialized
INFO - 2025-08-04 13:26:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:04 --> Input Class Initialized
INFO - 2025-08-04 13:26:04 --> Language Class Initialized
INFO - 2025-08-04 13:26:04 --> Loader Class Initialized
INFO - 2025-08-04 13:26:04 --> Loader Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: url_helper
DEBUG - 2025-08-04 13:26:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:26:04 --> Helper loaded: url_helper
INFO - 2025-08-04 13:26:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:04 --> Controller Class Initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:26:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:04 --> Final output sent to browser
DEBUG - 2025-08-04 13:26:04 --> Total execution time: 0.0088
INFO - 2025-08-04 13:26:04 --> Database Driver Class Initialized
INFO - 2025-08-04 13:26:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:26:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 13:26:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:26:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:04 --> Controller Class Initialized
INFO - 2025-08-04 13:26:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:26:04 --> Final output sent to browser
DEBUG - 2025-08-04 13:26:04 --> Total execution time: 0.0102
INFO - 2025-08-04 13:26:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:04 --> Controller Class Initialized
INFO - 2025-08-04 13:26:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:26:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:26:04 --> Final output sent to browser
DEBUG - 2025-08-04 13:26:04 --> Total execution time: 0.0112
INFO - 2025-08-04 13:26:24 --> Config Class Initialized
INFO - 2025-08-04 13:26:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:26:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:26:24 --> Utf8 Class Initialized
INFO - 2025-08-04 13:26:24 --> URI Class Initialized
INFO - 2025-08-04 13:26:24 --> Router Class Initialized
INFO - 2025-08-04 13:26:24 --> Output Class Initialized
INFO - 2025-08-04 13:26:24 --> Security Class Initialized
DEBUG - 2025-08-04 13:26:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:26:24 --> Input Class Initialized
INFO - 2025-08-04 13:26:24 --> Language Class Initialized
INFO - 2025-08-04 13:26:24 --> Loader Class Initialized
INFO - 2025-08-04 13:26:24 --> Helper loaded: url_helper
INFO - 2025-08-04 13:26:24 --> Helper loaded: form_helper
INFO - 2025-08-04 13:26:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:26:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:26:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:26:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:26:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:26:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:26:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:26:24 --> Controller Class Initialized
INFO - 2025-08-04 13:26:24 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:26:24 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:26:24 --> Model "MenuModel" initialized
ERROR - 2025-08-04 13:26:24 --> Query error: Unknown column 'riwayat_penggunaan_obat' in 'field list' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `keluhan_utama`, `riwayat_penggunaan_obat`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`, `nip`) VALUES ('2025/08/04/000001', 'sdsd', 'sdsd', 'sds', 'sds', 'sds', '12', '12', '12', '12', '12', 'tidak ada', 'dsd', 'sds', 'sds', 'sds', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 18:26:04', '150')
INFO - 2025-08-04 13:26:24 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 13:57:49 --> Config Class Initialized
INFO - 2025-08-04 13:57:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:57:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:57:49 --> Utf8 Class Initialized
INFO - 2025-08-04 13:57:49 --> URI Class Initialized
INFO - 2025-08-04 13:57:49 --> Router Class Initialized
INFO - 2025-08-04 13:57:49 --> Output Class Initialized
INFO - 2025-08-04 13:57:49 --> Security Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:57:49 --> Input Class Initialized
INFO - 2025-08-04 13:57:49 --> Language Class Initialized
INFO - 2025-08-04 13:57:49 --> Loader Class Initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: url_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: form_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:57:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:57:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:57:49 --> Controller Class Initialized
INFO - 2025-08-04 13:57:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:57:49 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:57:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:57:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:57:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:57:49 --> Final output sent to browser
DEBUG - 2025-08-04 13:57:49 --> Total execution time: 0.0283
INFO - 2025-08-04 13:57:49 --> Config Class Initialized
INFO - 2025-08-04 13:57:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:57:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:57:49 --> Utf8 Class Initialized
INFO - 2025-08-04 13:57:49 --> URI Class Initialized
INFO - 2025-08-04 13:57:49 --> Router Class Initialized
INFO - 2025-08-04 13:57:49 --> Output Class Initialized
INFO - 2025-08-04 13:57:49 --> Security Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:57:49 --> Input Class Initialized
INFO - 2025-08-04 13:57:49 --> Language Class Initialized
INFO - 2025-08-04 13:57:49 --> Loader Class Initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: url_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: form_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:57:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:57:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:57:49 --> Controller Class Initialized
INFO - 2025-08-04 13:57:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:57:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:57:49 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:57:49 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:57:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:57:49 --> Final output sent to browser
DEBUG - 2025-08-04 13:57:49 --> Total execution time: 0.0173
INFO - 2025-08-04 13:57:49 --> Config Class Initialized
INFO - 2025-08-04 13:57:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:57:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:57:49 --> Utf8 Class Initialized
INFO - 2025-08-04 13:57:49 --> URI Class Initialized
INFO - 2025-08-04 13:57:49 --> Router Class Initialized
INFO - 2025-08-04 13:57:49 --> Output Class Initialized
INFO - 2025-08-04 13:57:49 --> Security Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:57:49 --> Input Class Initialized
INFO - 2025-08-04 13:57:49 --> Language Class Initialized
INFO - 2025-08-04 13:57:49 --> Loader Class Initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: url_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: form_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:57:49 --> Config Class Initialized
INFO - 2025-08-04 13:57:49 --> Hooks Class Initialized
INFO - 2025-08-04 13:57:49 --> Config Class Initialized
INFO - 2025-08-04 13:57:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:57:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:57:49 --> Utf8 Class Initialized
DEBUG - 2025-08-04 13:57:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:57:49 --> Utf8 Class Initialized
INFO - 2025-08-04 13:57:49 --> URI Class Initialized
INFO - 2025-08-04 13:57:49 --> URI Class Initialized
INFO - 2025-08-04 13:57:49 --> Router Class Initialized
INFO - 2025-08-04 13:57:49 --> Router Class Initialized
INFO - 2025-08-04 13:57:49 --> Output Class Initialized
INFO - 2025-08-04 13:57:49 --> Output Class Initialized
INFO - 2025-08-04 13:57:49 --> Database Driver Class Initialized
INFO - 2025-08-04 13:57:49 --> Security Class Initialized
INFO - 2025-08-04 13:57:49 --> Security Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 13:57:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:57:49 --> Input Class Initialized
INFO - 2025-08-04 13:57:49 --> Input Class Initialized
INFO - 2025-08-04 13:57:49 --> Language Class Initialized
INFO - 2025-08-04 13:57:49 --> Language Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:57:49 --> Loader Class Initialized
INFO - 2025-08-04 13:57:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:57:49 --> Loader Class Initialized
INFO - 2025-08-04 13:57:49 --> Controller Class Initialized
INFO - 2025-08-04 13:57:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: url_helper
INFO - 2025-08-04 13:57:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: url_helper
INFO - 2025-08-04 13:57:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:57:49 --> Helper loaded: form_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: form_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:57:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:57:49 --> Final output sent to browser
DEBUG - 2025-08-04 13:57:49 --> Total execution time: 0.0094
INFO - 2025-08-04 13:57:49 --> Database Driver Class Initialized
INFO - 2025-08-04 13:57:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 13:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:57:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:57:49 --> Controller Class Initialized
INFO - 2025-08-04 13:57:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:57:49 --> Final output sent to browser
DEBUG - 2025-08-04 13:57:49 --> Total execution time: 0.0086
INFO - 2025-08-04 13:57:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:57:49 --> Controller Class Initialized
INFO - 2025-08-04 13:57:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:57:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:57:49 --> Final output sent to browser
DEBUG - 2025-08-04 13:57:49 --> Total execution time: 0.0097
INFO - 2025-08-04 13:58:14 --> Config Class Initialized
INFO - 2025-08-04 13:58:14 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:58:14 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:58:14 --> Utf8 Class Initialized
INFO - 2025-08-04 13:58:14 --> URI Class Initialized
INFO - 2025-08-04 13:58:15 --> Router Class Initialized
INFO - 2025-08-04 13:58:15 --> Output Class Initialized
INFO - 2025-08-04 13:58:15 --> Security Class Initialized
DEBUG - 2025-08-04 13:58:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:58:15 --> Input Class Initialized
INFO - 2025-08-04 13:58:15 --> Language Class Initialized
INFO - 2025-08-04 13:58:15 --> Loader Class Initialized
INFO - 2025-08-04 13:58:15 --> Helper loaded: url_helper
INFO - 2025-08-04 13:58:15 --> Helper loaded: form_helper
INFO - 2025-08-04 13:58:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:58:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:58:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:58:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:58:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:58:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:58:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:58:15 --> Controller Class Initialized
INFO - 2025-08-04 13:58:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:58:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:58:15 --> Model "MenuModel" initialized
ERROR - 2025-08-04 13:58:15 --> Query error: Unknown column 'nip' in 'field list' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`, `nip`) VALUES ('2025/08/04/000001', 'Autoanamnesis', 'Baik', 'Keluhan', 'RPS', 'rPD', 'Riwayat Alergi', '12', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 18:57:49', '150')
INFO - 2025-08-04 13:58:15 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 13:59:16 --> Config Class Initialized
INFO - 2025-08-04 13:59:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:16 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:16 --> URI Class Initialized
INFO - 2025-08-04 13:59:16 --> Router Class Initialized
INFO - 2025-08-04 13:59:16 --> Output Class Initialized
INFO - 2025-08-04 13:59:16 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:16 --> Input Class Initialized
INFO - 2025-08-04 13:59:16 --> Language Class Initialized
INFO - 2025-08-04 13:59:16 --> Loader Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:16 --> Controller Class Initialized
INFO - 2025-08-04 13:59:16 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:59:16 --> Model "SettingModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 13:59:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 13:59:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 13:59:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 13:59:16 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:16 --> Total execution time: 0.0261
INFO - 2025-08-04 13:59:16 --> Config Class Initialized
INFO - 2025-08-04 13:59:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:16 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:16 --> URI Class Initialized
INFO - 2025-08-04 13:59:16 --> Router Class Initialized
INFO - 2025-08-04 13:59:16 --> Output Class Initialized
INFO - 2025-08-04 13:59:16 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:16 --> Input Class Initialized
INFO - 2025-08-04 13:59:16 --> Language Class Initialized
INFO - 2025-08-04 13:59:16 --> Loader Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:16 --> Controller Class Initialized
INFO - 2025-08-04 13:59:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 13:59:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 13:59:16 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 13:59:16 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 13:59:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 13:59:16 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:16 --> Total execution time: 0.0247
INFO - 2025-08-04 13:59:16 --> Config Class Initialized
INFO - 2025-08-04 13:59:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:16 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:16 --> URI Class Initialized
INFO - 2025-08-04 13:59:16 --> Router Class Initialized
INFO - 2025-08-04 13:59:16 --> Output Class Initialized
INFO - 2025-08-04 13:59:16 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:16 --> Input Class Initialized
INFO - 2025-08-04 13:59:16 --> Config Class Initialized
INFO - 2025-08-04 13:59:16 --> Hooks Class Initialized
INFO - 2025-08-04 13:59:16 --> Language Class Initialized
DEBUG - 2025-08-04 13:59:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:16 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:16 --> Loader Class Initialized
INFO - 2025-08-04 13:59:16 --> URI Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:16 --> Router Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:16 --> Output Class Initialized
INFO - 2025-08-04 13:59:16 --> Security Class Initialized
INFO - 2025-08-04 13:59:16 --> Config Class Initialized
INFO - 2025-08-04 13:59:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:16 --> Input Class Initialized
INFO - 2025-08-04 13:59:16 --> Language Class Initialized
DEBUG - 2025-08-04 13:59:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:16 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:16 --> URI Class Initialized
INFO - 2025-08-04 13:59:16 --> Database Driver Class Initialized
INFO - 2025-08-04 13:59:16 --> Loader Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:16 --> Router Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:16 --> Output Class Initialized
INFO - 2025-08-04 13:59:16 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:16 --> Input Class Initialized
INFO - 2025-08-04 13:59:16 --> Language Class Initialized
INFO - 2025-08-04 13:59:16 --> Loader Class Initialized
DEBUG - 2025-08-04 13:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:16 --> Controller Class Initialized
INFO - 2025-08-04 13:59:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:16 --> Database Driver Class Initialized
INFO - 2025-08-04 13:59:16 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:16 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:16 --> Total execution time: 0.0136
DEBUG - 2025-08-04 13:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:16 --> Controller Class Initialized
INFO - 2025-08-04 13:59:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:16 --> Database Driver Class Initialized
INFO - 2025-08-04 13:59:16 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:16 --> Total execution time: 0.0128
DEBUG - 2025-08-04 13:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:16 --> Controller Class Initialized
INFO - 2025-08-04 13:59:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:16 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:16 --> Total execution time: 0.0125
INFO - 2025-08-04 13:59:34 --> Config Class Initialized
INFO - 2025-08-04 13:59:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:34 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:34 --> URI Class Initialized
INFO - 2025-08-04 13:59:34 --> Router Class Initialized
INFO - 2025-08-04 13:59:34 --> Output Class Initialized
INFO - 2025-08-04 13:59:34 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:34 --> Input Class Initialized
INFO - 2025-08-04 13:59:34 --> Language Class Initialized
INFO - 2025-08-04 13:59:34 --> Loader Class Initialized
INFO - 2025-08-04 13:59:34 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:34 --> Controller Class Initialized
INFO - 2025-08-04 13:59:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:34 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:34 --> Total execution time: 0.0298
INFO - 2025-08-04 13:59:34 --> Config Class Initialized
INFO - 2025-08-04 13:59:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 13:59:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:34 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:34 --> URI Class Initialized
INFO - 2025-08-04 13:59:34 --> Router Class Initialized
INFO - 2025-08-04 13:59:34 --> Output Class Initialized
INFO - 2025-08-04 13:59:34 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:34 --> Input Class Initialized
INFO - 2025-08-04 13:59:34 --> Language Class Initialized
INFO - 2025-08-04 13:59:34 --> Loader Class Initialized
INFO - 2025-08-04 13:59:34 --> Config Class Initialized
INFO - 2025-08-04 13:59:34 --> Config Class Initialized
INFO - 2025-08-04 13:59:34 --> Hooks Class Initialized
INFO - 2025-08-04 13:59:34 --> Hooks Class Initialized
INFO - 2025-08-04 13:59:34 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: form_helper
DEBUG - 2025-08-04 13:59:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:34 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:34 --> Helper loaded: auth_helper
DEBUG - 2025-08-04 13:59:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 13:59:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:34 --> Utf8 Class Initialized
INFO - 2025-08-04 13:59:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:34 --> URI Class Initialized
INFO - 2025-08-04 13:59:34 --> URI Class Initialized
INFO - 2025-08-04 13:59:34 --> Router Class Initialized
INFO - 2025-08-04 13:59:34 --> Database Driver Class Initialized
INFO - 2025-08-04 13:59:34 --> Router Class Initialized
INFO - 2025-08-04 13:59:34 --> Output Class Initialized
INFO - 2025-08-04 13:59:34 --> Output Class Initialized
INFO - 2025-08-04 13:59:34 --> Security Class Initialized
INFO - 2025-08-04 13:59:34 --> Security Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 13:59:34 --> Input Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 13:59:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:34 --> Input Class Initialized
INFO - 2025-08-04 13:59:34 --> Language Class Initialized
INFO - 2025-08-04 13:59:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:34 --> Controller Class Initialized
INFO - 2025-08-04 13:59:34 --> Language Class Initialized
INFO - 2025-08-04 13:59:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:34 --> Loader Class Initialized
INFO - 2025-08-04 13:59:34 --> Loader Class Initialized
INFO - 2025-08-04 13:59:34 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: url_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: form_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 13:59:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 13:59:34 --> Database Driver Class Initialized
INFO - 2025-08-04 13:59:34 --> Final output sent to browser
INFO - 2025-08-04 13:59:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Total execution time: 0.0183
DEBUG - 2025-08-04 13:59:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:34 --> Controller Class Initialized
DEBUG - 2025-08-04 13:59:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 13:59:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:34 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:34 --> Total execution time: 0.0180
INFO - 2025-08-04 13:59:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 13:59:34 --> Controller Class Initialized
INFO - 2025-08-04 13:59:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 13:59:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 13:59:34 --> Final output sent to browser
DEBUG - 2025-08-04 13:59:34 --> Total execution time: 0.0252
INFO - 2025-08-04 14:00:04 --> Config Class Initialized
INFO - 2025-08-04 14:00:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:00:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:04 --> Utf8 Class Initialized
INFO - 2025-08-04 14:00:04 --> URI Class Initialized
INFO - 2025-08-04 14:00:04 --> Router Class Initialized
INFO - 2025-08-04 14:00:04 --> Output Class Initialized
INFO - 2025-08-04 14:00:04 --> Security Class Initialized
DEBUG - 2025-08-04 14:00:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:04 --> Input Class Initialized
INFO - 2025-08-04 14:00:04 --> Language Class Initialized
INFO - 2025-08-04 14:00:04 --> Loader Class Initialized
INFO - 2025-08-04 14:00:04 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:04 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:00:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:04 --> Controller Class Initialized
INFO - 2025-08-04 14:00:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:04 --> Model "MenuModel" initialized
ERROR - 2025-08-04 14:00:04 --> Query error: Duplicate entry '2025/08/04/000001' for key 'PRIMARY' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `kd_dokter`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`) VALUES ('2025/08/04/000001', '150', 'Autoanamnesis', 'sdsd', 'sdsd', 'sds', 'sdsd', 'sdsd', '12', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 18:59:16')
INFO - 2025-08-04 14:00:04 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 14:00:09 --> Config Class Initialized
INFO - 2025-08-04 14:00:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:00:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:09 --> Utf8 Class Initialized
INFO - 2025-08-04 14:00:09 --> URI Class Initialized
INFO - 2025-08-04 14:00:09 --> Router Class Initialized
INFO - 2025-08-04 14:00:09 --> Output Class Initialized
INFO - 2025-08-04 14:00:09 --> Security Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:09 --> Input Class Initialized
INFO - 2025-08-04 14:00:09 --> Language Class Initialized
INFO - 2025-08-04 14:00:09 --> Loader Class Initialized
INFO - 2025-08-04 14:00:09 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:09 --> Controller Class Initialized
INFO - 2025-08-04 14:00:09 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 14:00:09 --> Model "SettingModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 14:00:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 14:00:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 14:00:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 14:00:09 --> Final output sent to browser
DEBUG - 2025-08-04 14:00:09 --> Total execution time: 0.0263
INFO - 2025-08-04 14:00:09 --> Config Class Initialized
INFO - 2025-08-04 14:00:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:00:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:09 --> Utf8 Class Initialized
INFO - 2025-08-04 14:00:09 --> URI Class Initialized
INFO - 2025-08-04 14:00:09 --> Router Class Initialized
INFO - 2025-08-04 14:00:09 --> Output Class Initialized
INFO - 2025-08-04 14:00:09 --> Security Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:09 --> Input Class Initialized
INFO - 2025-08-04 14:00:09 --> Language Class Initialized
INFO - 2025-08-04 14:00:09 --> Loader Class Initialized
INFO - 2025-08-04 14:00:09 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:09 --> Controller Class Initialized
INFO - 2025-08-04 14:00:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 14:00:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 14:00:09 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 14:00:09 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 14:00:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 14:00:09 --> Final output sent to browser
DEBUG - 2025-08-04 14:00:09 --> Total execution time: 0.0228
INFO - 2025-08-04 14:00:09 --> Config Class Initialized
INFO - 2025-08-04 14:00:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:00:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:09 --> Utf8 Class Initialized
INFO - 2025-08-04 14:00:09 --> URI Class Initialized
INFO - 2025-08-04 14:00:09 --> Router Class Initialized
INFO - 2025-08-04 14:00:09 --> Output Class Initialized
INFO - 2025-08-04 14:00:09 --> Config Class Initialized
INFO - 2025-08-04 14:00:09 --> Config Class Initialized
INFO - 2025-08-04 14:00:09 --> Hooks Class Initialized
INFO - 2025-08-04 14:00:09 --> Hooks Class Initialized
INFO - 2025-08-04 14:00:09 --> Security Class Initialized
DEBUG - 2025-08-04 14:00:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:09 --> Utf8 Class Initialized
DEBUG - 2025-08-04 14:00:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:09 --> Utf8 Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:09 --> Input Class Initialized
INFO - 2025-08-04 14:00:09 --> Language Class Initialized
INFO - 2025-08-04 14:00:09 --> URI Class Initialized
INFO - 2025-08-04 14:00:09 --> URI Class Initialized
INFO - 2025-08-04 14:00:09 --> Router Class Initialized
INFO - 2025-08-04 14:00:09 --> Router Class Initialized
INFO - 2025-08-04 14:00:09 --> Loader Class Initialized
INFO - 2025-08-04 14:00:09 --> Output Class Initialized
INFO - 2025-08-04 14:00:09 --> Output Class Initialized
INFO - 2025-08-04 14:00:09 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:09 --> Security Class Initialized
INFO - 2025-08-04 14:00:09 --> Security Class Initialized
INFO - 2025-08-04 14:00:09 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 14:00:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:09 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 14:00:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:09 --> Input Class Initialized
INFO - 2025-08-04 14:00:09 --> Input Class Initialized
INFO - 2025-08-04 14:00:09 --> Language Class Initialized
INFO - 2025-08-04 14:00:09 --> Language Class Initialized
INFO - 2025-08-04 14:00:09 --> Loader Class Initialized
INFO - 2025-08-04 14:00:09 --> Loader Class Initialized
INFO - 2025-08-04 14:00:09 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:00:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:09 --> Database Driver Class Initialized
INFO - 2025-08-04 14:00:09 --> Database Driver Class Initialized
INFO - 2025-08-04 14:00:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:09 --> Controller Class Initialized
INFO - 2025-08-04 14:00:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 14:00:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 14:00:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:09 --> Final output sent to browser
DEBUG - 2025-08-04 14:00:09 --> Total execution time: 0.0112
INFO - 2025-08-04 14:00:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:09 --> Controller Class Initialized
INFO - 2025-08-04 14:00:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:00:09 --> Final output sent to browser
DEBUG - 2025-08-04 14:00:09 --> Total execution time: 0.0128
INFO - 2025-08-04 14:00:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:09 --> Controller Class Initialized
INFO - 2025-08-04 14:00:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:00:09 --> Final output sent to browser
DEBUG - 2025-08-04 14:00:09 --> Total execution time: 0.0153
INFO - 2025-08-04 14:00:25 --> Config Class Initialized
INFO - 2025-08-04 14:00:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:00:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:00:25 --> Utf8 Class Initialized
INFO - 2025-08-04 14:00:25 --> URI Class Initialized
INFO - 2025-08-04 14:00:25 --> Router Class Initialized
INFO - 2025-08-04 14:00:25 --> Output Class Initialized
INFO - 2025-08-04 14:00:25 --> Security Class Initialized
DEBUG - 2025-08-04 14:00:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:00:25 --> Input Class Initialized
INFO - 2025-08-04 14:00:25 --> Language Class Initialized
INFO - 2025-08-04 14:00:25 --> Loader Class Initialized
INFO - 2025-08-04 14:00:25 --> Helper loaded: url_helper
INFO - 2025-08-04 14:00:25 --> Helper loaded: form_helper
INFO - 2025-08-04 14:00:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:00:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:00:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:00:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:00:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:00:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:00:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:00:25 --> Controller Class Initialized
INFO - 2025-08-04 14:00:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:00:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:00:25 --> Model "MenuModel" initialized
ERROR - 2025-08-04 14:00:25 --> Query error: Duplicate entry '2025/08/04/000001' for key 'PRIMARY' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `kd_dokter`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`) VALUES ('2025/08/04/000001', '150', 'Autoanamnesis', 'sdsds', 'sdsds', 'sds', 'sds', 'sds', '12', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 19:00:09')
INFO - 2025-08-04 14:00:25 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 14:30:15 --> Config Class Initialized
INFO - 2025-08-04 14:30:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:30:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:15 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:15 --> URI Class Initialized
INFO - 2025-08-04 14:30:15 --> Router Class Initialized
INFO - 2025-08-04 14:30:15 --> Output Class Initialized
INFO - 2025-08-04 14:30:15 --> Security Class Initialized
DEBUG - 2025-08-04 14:30:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:15 --> Input Class Initialized
INFO - 2025-08-04 14:30:15 --> Language Class Initialized
INFO - 2025-08-04 14:30:15 --> Loader Class Initialized
INFO - 2025-08-04 14:30:15 --> Helper loaded: url_helper
INFO - 2025-08-04 14:30:15 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:30:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:30:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:30:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:30:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:15 --> Controller Class Initialized
INFO - 2025-08-04 14:30:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 14:30:15 --> Model "SettingModel" initialized
INFO - 2025-08-04 14:30:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:30:15 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 14:30:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 14:30:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 14:30:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 14:30:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 14:30:15 --> Final output sent to browser
DEBUG - 2025-08-04 14:30:15 --> Total execution time: 0.0462
INFO - 2025-08-04 14:30:16 --> Config Class Initialized
INFO - 2025-08-04 14:30:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:30:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:16 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:16 --> URI Class Initialized
INFO - 2025-08-04 14:30:16 --> Router Class Initialized
INFO - 2025-08-04 14:30:16 --> Output Class Initialized
INFO - 2025-08-04 14:30:16 --> Security Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:16 --> Input Class Initialized
INFO - 2025-08-04 14:30:16 --> Language Class Initialized
INFO - 2025-08-04 14:30:16 --> Loader Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: url_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:30:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:16 --> Controller Class Initialized
INFO - 2025-08-04 14:30:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 14:30:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 14:30:16 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 14:30:16 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 14:30:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 14:30:16 --> Final output sent to browser
DEBUG - 2025-08-04 14:30:16 --> Total execution time: 0.0263
INFO - 2025-08-04 14:30:16 --> Config Class Initialized
INFO - 2025-08-04 14:30:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:30:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:16 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:16 --> URI Class Initialized
INFO - 2025-08-04 14:30:16 --> Router Class Initialized
INFO - 2025-08-04 14:30:16 --> Output Class Initialized
INFO - 2025-08-04 14:30:16 --> Security Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:16 --> Input Class Initialized
INFO - 2025-08-04 14:30:16 --> Language Class Initialized
INFO - 2025-08-04 14:30:16 --> Loader Class Initialized
INFO - 2025-08-04 14:30:16 --> Config Class Initialized
INFO - 2025-08-04 14:30:16 --> Hooks Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: url_helper
INFO - 2025-08-04 14:30:16 --> Config Class Initialized
INFO - 2025-08-04 14:30:16 --> Hooks Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 14:30:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:16 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 14:30:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:16 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:16 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:16 --> URI Class Initialized
INFO - 2025-08-04 14:30:16 --> URI Class Initialized
INFO - 2025-08-04 14:30:16 --> Router Class Initialized
INFO - 2025-08-04 14:30:16 --> Router Class Initialized
INFO - 2025-08-04 14:30:16 --> Output Class Initialized
INFO - 2025-08-04 14:30:16 --> Output Class Initialized
INFO - 2025-08-04 14:30:16 --> Security Class Initialized
INFO - 2025-08-04 14:30:16 --> Database Driver Class Initialized
INFO - 2025-08-04 14:30:16 --> Security Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:16 --> Input Class Initialized
INFO - 2025-08-04 14:30:16 --> Language Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:16 --> Input Class Initialized
INFO - 2025-08-04 14:30:16 --> Language Class Initialized
INFO - 2025-08-04 14:30:16 --> Loader Class Initialized
INFO - 2025-08-04 14:30:16 --> Loader Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: url_helper
DEBUG - 2025-08-04 14:30:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:30:16 --> Helper loaded: url_helper
INFO - 2025-08-04 14:30:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:16 --> Controller Class Initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:30:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:30:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:16 --> Final output sent to browser
DEBUG - 2025-08-04 14:30:16 --> Total execution time: 0.0166
INFO - 2025-08-04 14:30:16 --> Database Driver Class Initialized
INFO - 2025-08-04 14:30:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:30:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 14:30:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:30:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:16 --> Controller Class Initialized
INFO - 2025-08-04 14:30:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:30:16 --> Final output sent to browser
DEBUG - 2025-08-04 14:30:16 --> Total execution time: 0.0208
INFO - 2025-08-04 14:30:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:16 --> Controller Class Initialized
INFO - 2025-08-04 14:30:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:30:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 14:30:16 --> Final output sent to browser
DEBUG - 2025-08-04 14:30:16 --> Total execution time: 0.0234
INFO - 2025-08-04 14:30:33 --> Config Class Initialized
INFO - 2025-08-04 14:30:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 14:30:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 14:30:33 --> Utf8 Class Initialized
INFO - 2025-08-04 14:30:33 --> URI Class Initialized
INFO - 2025-08-04 14:30:33 --> Router Class Initialized
INFO - 2025-08-04 14:30:33 --> Output Class Initialized
INFO - 2025-08-04 14:30:33 --> Security Class Initialized
DEBUG - 2025-08-04 14:30:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 14:30:33 --> Input Class Initialized
INFO - 2025-08-04 14:30:33 --> Language Class Initialized
INFO - 2025-08-04 14:30:33 --> Loader Class Initialized
INFO - 2025-08-04 14:30:33 --> Helper loaded: url_helper
INFO - 2025-08-04 14:30:33 --> Helper loaded: form_helper
INFO - 2025-08-04 14:30:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 14:30:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 14:30:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 14:30:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 14:30:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 14:30:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 14:30:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 14:30:33 --> Controller Class Initialized
INFO - 2025-08-04 14:30:33 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 14:30:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 14:30:33 --> Model "MenuModel" initialized
ERROR - 2025-08-04 14:30:33 --> Query error: Duplicate entry '2025/08/04/000001' for key 'PRIMARY' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `kd_dokter`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`) VALUES ('2025/08/04/000001', '150', 'Autoanamnesis', 'erer', 'df', 'erer', 'erer', 'erer', '12', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 19:30:16')
INFO - 2025-08-04 14:30:33 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 18:15:57 --> Config Class Initialized
INFO - 2025-08-04 18:15:57 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:15:57 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:15:57 --> Utf8 Class Initialized
INFO - 2025-08-04 18:15:57 --> URI Class Initialized
INFO - 2025-08-04 18:15:57 --> Router Class Initialized
INFO - 2025-08-04 18:15:57 --> Output Class Initialized
INFO - 2025-08-04 18:15:57 --> Security Class Initialized
DEBUG - 2025-08-04 18:15:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:15:57 --> Input Class Initialized
INFO - 2025-08-04 18:15:57 --> Language Class Initialized
INFO - 2025-08-04 18:15:57 --> Loader Class Initialized
INFO - 2025-08-04 18:15:57 --> Helper loaded: url_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: form_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:15:57 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:15:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:15:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:15:57 --> Controller Class Initialized
INFO - 2025-08-04 18:15:57 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:15:57 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:15:57 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:15:57 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:15:57 --> Config Class Initialized
INFO - 2025-08-04 18:15:57 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:15:57 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:15:57 --> Utf8 Class Initialized
INFO - 2025-08-04 18:15:57 --> URI Class Initialized
INFO - 2025-08-04 18:15:57 --> Router Class Initialized
INFO - 2025-08-04 18:15:57 --> Output Class Initialized
INFO - 2025-08-04 18:15:57 --> Security Class Initialized
DEBUG - 2025-08-04 18:15:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:15:57 --> Input Class Initialized
INFO - 2025-08-04 18:15:57 --> Language Class Initialized
INFO - 2025-08-04 18:15:57 --> Loader Class Initialized
INFO - 2025-08-04 18:15:57 --> Helper loaded: url_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: form_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:15:57 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:15:57 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:15:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:15:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:15:57 --> Controller Class Initialized
INFO - 2025-08-04 18:15:57 --> Model "AuthModel" initialized
INFO - 2025-08-04 18:15:57 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/auth/login.php
INFO - 2025-08-04 18:15:57 --> Final output sent to browser
DEBUG - 2025-08-04 18:15:57 --> Total execution time: 0.0066
INFO - 2025-08-04 18:15:59 --> Config Class Initialized
INFO - 2025-08-04 18:15:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:15:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:15:59 --> Utf8 Class Initialized
INFO - 2025-08-04 18:15:59 --> URI Class Initialized
INFO - 2025-08-04 18:15:59 --> Router Class Initialized
INFO - 2025-08-04 18:15:59 --> Output Class Initialized
INFO - 2025-08-04 18:15:59 --> Security Class Initialized
DEBUG - 2025-08-04 18:15:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:15:59 --> Input Class Initialized
INFO - 2025-08-04 18:15:59 --> Language Class Initialized
INFO - 2025-08-04 18:15:59 --> Loader Class Initialized
INFO - 2025-08-04 18:15:59 --> Helper loaded: url_helper
INFO - 2025-08-04 18:15:59 --> Helper loaded: form_helper
INFO - 2025-08-04 18:15:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:15:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:15:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:15:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:15:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:15:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:15:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:15:59 --> Controller Class Initialized
INFO - 2025-08-04 18:15:59 --> Model "AuthModel" initialized
INFO - 2025-08-04 18:15:59 --> Config Class Initialized
INFO - 2025-08-04 18:15:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:15:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:15:59 --> Utf8 Class Initialized
INFO - 2025-08-04 18:15:59 --> URI Class Initialized
INFO - 2025-08-04 18:15:59 --> Router Class Initialized
INFO - 2025-08-04 18:15:59 --> Output Class Initialized
INFO - 2025-08-04 18:15:59 --> Security Class Initialized
DEBUG - 2025-08-04 18:15:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:15:59 --> Input Class Initialized
INFO - 2025-08-04 18:16:00 --> Language Class Initialized
INFO - 2025-08-04 18:16:00 --> Loader Class Initialized
INFO - 2025-08-04 18:16:00 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:00 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:00 --> Controller Class Initialized
INFO - 2025-08-04 18:16:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/admin/dashboard.php
INFO - 2025-08-04 18:16:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:00 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:00 --> Total execution time: 0.0148
INFO - 2025-08-04 18:16:03 --> Config Class Initialized
INFO - 2025-08-04 18:16:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:03 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:03 --> URI Class Initialized
INFO - 2025-08-04 18:16:03 --> Router Class Initialized
INFO - 2025-08-04 18:16:03 --> Output Class Initialized
INFO - 2025-08-04 18:16:03 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:03 --> Input Class Initialized
INFO - 2025-08-04 18:16:03 --> Language Class Initialized
INFO - 2025-08-04 18:16:03 --> Loader Class Initialized
INFO - 2025-08-04 18:16:03 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:03 --> Controller Class Initialized
INFO - 2025-08-04 18:16:03 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:03 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:03 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/dokter/dokter_ralan.php
INFO - 2025-08-04 18:16:03 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:03 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:03 --> Total execution time: 0.0255
INFO - 2025-08-04 18:16:03 --> Config Class Initialized
INFO - 2025-08-04 18:16:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:03 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:03 --> URI Class Initialized
INFO - 2025-08-04 18:16:03 --> Router Class Initialized
INFO - 2025-08-04 18:16:03 --> Output Class Initialized
INFO - 2025-08-04 18:16:03 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:03 --> Input Class Initialized
INFO - 2025-08-04 18:16:03 --> Language Class Initialized
INFO - 2025-08-04 18:16:03 --> Loader Class Initialized
INFO - 2025-08-04 18:16:03 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:03 --> Controller Class Initialized
INFO - 2025-08-04 18:16:03 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:03 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:03 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 18:16:03 --> Filter Tanggal - Start Date: 2025-08-04, End Date: 2025-08-04
DEBUG - 2025-08-04 18:16:03 --> Query SQL yang akan dijalankan: SELECT `reg_periksa`.`no_rawat`, `reg_periksa`.`no_rkm_medis`, `pasien`.`nm_pasien`, `dokter`.`nm_dokter`, `penjab`.`png_jawab`, `poliklinik`.`nm_poli`, `reg_periksa`.`tgl_registrasi`, `reg_periksa`.`status_bayar`, `reg_periksa`.`stts`
FROM `reg_periksa`
JOIN `pasien` ON `reg_periksa`.`no_rkm_medis` = `pasien`.`no_rkm_medis`
JOIN `penjab` ON `reg_periksa`.`kd_pj` = `penjab`.`kd_pj`
JOIN `poliklinik` ON `reg_periksa`.`kd_poli` = `poliklinik`.`kd_poli`
JOIN `dokter` ON `reg_periksa`.`kd_dokter` = `dokter`.`kd_dokter`
WHERE `reg_periksa`.`status_lanjut` = 'Ralan'
AND DATE(reg_periksa.tgl_registrasi) >= '2025-08-04'
AND DATE(reg_periksa.tgl_registrasi) <= '2025-08-04'
DEBUG - 2025-08-04 18:16:03 --> Jumlah data ditemukan: 2
INFO - 2025-08-04 18:16:03 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:03 --> Total execution time: 0.0253
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:05 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:05 --> Total execution time: 0.0202
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:05 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:05 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:16:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:16:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:05 --> Total execution time: 0.0157
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
ERROR - 2025-08-04 18:16:05 --> Severity: Notice --> Undefined index: tanggal /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 75
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
INFO - 2025-08-04 18:16:05 --> Config Class Initialized
INFO - 2025-08-04 18:16:05 --> Hooks Class Initialized
ERROR - 2025-08-04 18:16:05 --> Severity: Notice --> Undefined index: tanggal /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/controllers/AwalMedisDokterMataRalanController.php 76
DEBUG - 2025-08-04 18:16:05 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
INFO - 2025-08-04 18:16:05 --> URI Class Initialized
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Router Class Initialized
INFO - 2025-08-04 18:16:05 --> Output Class Initialized
INFO - 2025-08-04 18:16:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:05 --> Input Class Initialized
INFO - 2025-08-04 18:16:05 --> Language Class Initialized
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
ERROR - 2025-08-04 18:16:05 --> Query error: Duplicate entry '2025/08/04/000001' for key 'PRIMARY' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `kd_dokter`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`) VALUES ('2025/08/04/000001', '150', 'Autoanamnesis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')
INFO - 2025-08-04 18:16:05 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:05 --> Loader Class Initialized
INFO - 2025-08-04 18:16:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:05 --> Total execution time: 0.0270
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:05 --> Total execution time: 0.0169
INFO - 2025-08-04 18:16:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:05 --> Controller Class Initialized
INFO - 2025-08-04 18:16:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:05 --> Total execution time: 0.0169
INFO - 2025-08-04 18:16:19 --> Config Class Initialized
INFO - 2025-08-04 18:16:19 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:19 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:19 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:19 --> URI Class Initialized
INFO - 2025-08-04 18:16:19 --> Router Class Initialized
INFO - 2025-08-04 18:16:19 --> Output Class Initialized
INFO - 2025-08-04 18:16:19 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:19 --> Input Class Initialized
INFO - 2025-08-04 18:16:19 --> Language Class Initialized
INFO - 2025-08-04 18:16:19 --> Loader Class Initialized
INFO - 2025-08-04 18:16:19 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:19 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:19 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:19 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:19 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:19 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:19 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:19 --> Controller Class Initialized
INFO - 2025-08-04 18:16:19 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:19 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:19 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:19 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:19 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:19 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:19 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:19 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:19 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:19 --> Total execution time: 0.0202
INFO - 2025-08-04 18:16:20 --> Config Class Initialized
INFO - 2025-08-04 18:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:20 --> URI Class Initialized
INFO - 2025-08-04 18:16:20 --> Router Class Initialized
INFO - 2025-08-04 18:16:20 --> Output Class Initialized
INFO - 2025-08-04 18:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:20 --> Input Class Initialized
INFO - 2025-08-04 18:16:20 --> Language Class Initialized
INFO - 2025-08-04 18:16:20 --> Loader Class Initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:20 --> Controller Class Initialized
INFO - 2025-08-04 18:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:20 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:20 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:20 --> Total execution time: 0.0304
INFO - 2025-08-04 18:16:20 --> Config Class Initialized
INFO - 2025-08-04 18:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:20 --> URI Class Initialized
INFO - 2025-08-04 18:16:20 --> Router Class Initialized
INFO - 2025-08-04 18:16:20 --> Output Class Initialized
INFO - 2025-08-04 18:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:20 --> Input Class Initialized
INFO - 2025-08-04 18:16:20 --> Language Class Initialized
INFO - 2025-08-04 18:16:20 --> Loader Class Initialized
INFO - 2025-08-04 18:16:20 --> Config Class Initialized
INFO - 2025-08-04 18:16:20 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:20 --> URI Class Initialized
INFO - 2025-08-04 18:16:20 --> Router Class Initialized
INFO - 2025-08-04 18:16:20 --> Output Class Initialized
INFO - 2025-08-04 18:16:20 --> Security Class Initialized
INFO - 2025-08-04 18:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:20 --> Input Class Initialized
INFO - 2025-08-04 18:16:20 --> Language Class Initialized
INFO - 2025-08-04 18:16:20 --> Loader Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:20 --> Controller Class Initialized
INFO - 2025-08-04 18:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:20 --> Total execution time: 0.0092
INFO - 2025-08-04 18:16:20 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:20 --> Config Class Initialized
INFO - 2025-08-04 18:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:20 --> Controller Class Initialized
INFO - 2025-08-04 18:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 18:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:20 --> URI Class Initialized
INFO - 2025-08-04 18:16:20 --> Final output sent to browser
INFO - 2025-08-04 18:16:20 --> Router Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Total execution time: 0.0106
INFO - 2025-08-04 18:16:20 --> Output Class Initialized
INFO - 2025-08-04 18:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:20 --> Input Class Initialized
INFO - 2025-08-04 18:16:20 --> Language Class Initialized
INFO - 2025-08-04 18:16:20 --> Loader Class Initialized
INFO - 2025-08-04 18:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:20 --> Controller Class Initialized
INFO - 2025-08-04 18:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:20 --> Total execution time: 0.0126
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:21 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:21 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0262
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:21 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0118
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:21 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0154
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:21 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0184
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:21 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:21 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:16:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0246
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:21 --> Config Class Initialized
INFO - 2025-08-04 18:16:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
DEBUG - 2025-08-04 18:16:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> URI Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Router Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
INFO - 2025-08-04 18:16:21 --> Output Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Security Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:21 --> Input Class Initialized
INFO - 2025-08-04 18:16:21 --> Language Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Loader Class Initialized
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0113
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:21 --> Total execution time: 0.0122
INFO - 2025-08-04 18:16:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:21 --> Controller Class Initialized
INFO - 2025-08-04 18:16:22 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:22 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:22 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:22 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:22 --> Total execution time: 0.0142
INFO - 2025-08-04 18:16:25 --> Config Class Initialized
INFO - 2025-08-04 18:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:25 --> URI Class Initialized
INFO - 2025-08-04 18:16:25 --> Router Class Initialized
INFO - 2025-08-04 18:16:25 --> Output Class Initialized
INFO - 2025-08-04 18:16:25 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:25 --> Input Class Initialized
INFO - 2025-08-04 18:16:25 --> Language Class Initialized
INFO - 2025-08-04 18:16:25 --> Loader Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:25 --> Controller Class Initialized
INFO - 2025-08-04 18:16:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:25 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:25 --> Total execution time: 0.0241
INFO - 2025-08-04 18:16:25 --> Config Class Initialized
INFO - 2025-08-04 18:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:25 --> URI Class Initialized
INFO - 2025-08-04 18:16:25 --> Router Class Initialized
INFO - 2025-08-04 18:16:25 --> Output Class Initialized
INFO - 2025-08-04 18:16:25 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:25 --> Input Class Initialized
INFO - 2025-08-04 18:16:25 --> Language Class Initialized
INFO - 2025-08-04 18:16:25 --> Loader Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:25 --> Controller Class Initialized
INFO - 2025-08-04 18:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:25 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:25 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:25 --> Total execution time: 0.0170
INFO - 2025-08-04 18:16:25 --> Config Class Initialized
INFO - 2025-08-04 18:16:25 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:25 --> Config Class Initialized
INFO - 2025-08-04 18:16:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:25 --> URI Class Initialized
DEBUG - 2025-08-04 18:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:25 --> Router Class Initialized
INFO - 2025-08-04 18:16:25 --> Config Class Initialized
INFO - 2025-08-04 18:16:25 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:25 --> URI Class Initialized
INFO - 2025-08-04 18:16:25 --> Output Class Initialized
DEBUG - 2025-08-04 18:16:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:25 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:25 --> Router Class Initialized
INFO - 2025-08-04 18:16:25 --> Security Class Initialized
INFO - 2025-08-04 18:16:25 --> URI Class Initialized
INFO - 2025-08-04 18:16:25 --> Output Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:25 --> Input Class Initialized
INFO - 2025-08-04 18:16:25 --> Router Class Initialized
INFO - 2025-08-04 18:16:25 --> Language Class Initialized
INFO - 2025-08-04 18:16:25 --> Security Class Initialized
INFO - 2025-08-04 18:16:25 --> Output Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:25 --> Input Class Initialized
INFO - 2025-08-04 18:16:25 --> Language Class Initialized
INFO - 2025-08-04 18:16:25 --> Loader Class Initialized
INFO - 2025-08-04 18:16:25 --> Security Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:16:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:25 --> Input Class Initialized
INFO - 2025-08-04 18:16:25 --> Language Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:25 --> Loader Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:25 --> Loader Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:25 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:25 --> Controller Class Initialized
INFO - 2025-08-04 18:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:25 --> Total execution time: 0.0081
INFO - 2025-08-04 18:16:25 --> Session: Class initialized using 'files' driver.
DEBUG - 2025-08-04 18:16:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:25 --> Controller Class Initialized
INFO - 2025-08-04 18:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:25 --> Total execution time: 0.0078
INFO - 2025-08-04 18:16:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:25 --> Controller Class Initialized
INFO - 2025-08-04 18:16:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:25 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:25 --> Total execution time: 0.0101
INFO - 2025-08-04 18:16:27 --> Config Class Initialized
INFO - 2025-08-04 18:16:27 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:27 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:27 --> URI Class Initialized
INFO - 2025-08-04 18:16:27 --> Router Class Initialized
INFO - 2025-08-04 18:16:27 --> Output Class Initialized
INFO - 2025-08-04 18:16:27 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:27 --> Input Class Initialized
INFO - 2025-08-04 18:16:27 --> Language Class Initialized
INFO - 2025-08-04 18:16:27 --> Loader Class Initialized
INFO - 2025-08-04 18:16:27 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:27 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:27 --> Controller Class Initialized
INFO - 2025-08-04 18:16:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:16:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:16:27 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:16:27 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:16:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:16:27 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:27 --> Total execution time: 0.0240
INFO - 2025-08-04 18:16:27 --> Config Class Initialized
INFO - 2025-08-04 18:16:27 --> Config Class Initialized
INFO - 2025-08-04 18:16:27 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:27 --> Hooks Class Initialized
INFO - 2025-08-04 18:16:27 --> Config Class Initialized
INFO - 2025-08-04 18:16:27 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:16:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:27 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:16:27 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:16:27 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:16:27 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:27 --> Utf8 Class Initialized
INFO - 2025-08-04 18:16:27 --> URI Class Initialized
INFO - 2025-08-04 18:16:27 --> URI Class Initialized
INFO - 2025-08-04 18:16:27 --> URI Class Initialized
INFO - 2025-08-04 18:16:27 --> Router Class Initialized
INFO - 2025-08-04 18:16:27 --> Router Class Initialized
INFO - 2025-08-04 18:16:27 --> Router Class Initialized
INFO - 2025-08-04 18:16:27 --> Output Class Initialized
INFO - 2025-08-04 18:16:27 --> Output Class Initialized
INFO - 2025-08-04 18:16:27 --> Output Class Initialized
INFO - 2025-08-04 18:16:27 --> Security Class Initialized
INFO - 2025-08-04 18:16:27 --> Security Class Initialized
INFO - 2025-08-04 18:16:27 --> Security Class Initialized
DEBUG - 2025-08-04 18:16:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:16:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:27 --> Input Class Initialized
INFO - 2025-08-04 18:16:27 --> Input Class Initialized
DEBUG - 2025-08-04 18:16:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:16:27 --> Input Class Initialized
INFO - 2025-08-04 18:16:27 --> Language Class Initialized
INFO - 2025-08-04 18:16:27 --> Language Class Initialized
INFO - 2025-08-04 18:16:27 --> Language Class Initialized
INFO - 2025-08-04 18:16:27 --> Loader Class Initialized
INFO - 2025-08-04 18:16:27 --> Loader Class Initialized
INFO - 2025-08-04 18:16:27 --> Loader Class Initialized
INFO - 2025-08-04 18:16:27 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: url_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: form_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:27 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:16:27 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:27 --> Database Driver Class Initialized
INFO - 2025-08-04 18:16:27 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:27 --> Session: Class initialized using 'files' driver.
DEBUG - 2025-08-04 18:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:16:27 --> Controller Class Initialized
INFO - 2025-08-04 18:16:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:27 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:27 --> Total execution time: 0.0116
INFO - 2025-08-04 18:16:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:27 --> Controller Class Initialized
INFO - 2025-08-04 18:16:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:27 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:27 --> Total execution time: 0.0134
INFO - 2025-08-04 18:16:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:16:27 --> Controller Class Initialized
INFO - 2025-08-04 18:16:27 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:16:27 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:16:27 --> Final output sent to browser
DEBUG - 2025-08-04 18:16:27 --> Total execution time: 0.0148
INFO - 2025-08-04 18:21:15 --> Config Class Initialized
INFO - 2025-08-04 18:21:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:15 --> URI Class Initialized
INFO - 2025-08-04 18:21:15 --> Router Class Initialized
INFO - 2025-08-04 18:21:15 --> Output Class Initialized
INFO - 2025-08-04 18:21:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:15 --> Input Class Initialized
INFO - 2025-08-04 18:21:15 --> Language Class Initialized
INFO - 2025-08-04 18:21:15 --> Loader Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:15 --> Controller Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:21:15 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:21:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:21:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:21:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:21:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:15 --> Total execution time: 0.0344
INFO - 2025-08-04 18:21:15 --> Config Class Initialized
INFO - 2025-08-04 18:21:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:15 --> URI Class Initialized
INFO - 2025-08-04 18:21:15 --> Router Class Initialized
INFO - 2025-08-04 18:21:15 --> Output Class Initialized
INFO - 2025-08-04 18:21:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:15 --> Input Class Initialized
INFO - 2025-08-04 18:21:15 --> Language Class Initialized
INFO - 2025-08-04 18:21:15 --> Loader Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:15 --> Controller Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:21:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:21:15 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:21:15 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:21:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:21:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:15 --> Total execution time: 0.0116
INFO - 2025-08-04 18:21:15 --> Config Class Initialized
INFO - 2025-08-04 18:21:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:15 --> URI Class Initialized
INFO - 2025-08-04 18:21:15 --> Router Class Initialized
INFO - 2025-08-04 18:21:15 --> Output Class Initialized
INFO - 2025-08-04 18:21:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:15 --> Input Class Initialized
INFO - 2025-08-04 18:21:15 --> Language Class Initialized
INFO - 2025-08-04 18:21:15 --> Loader Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:15 --> Config Class Initialized
INFO - 2025-08-04 18:21:15 --> Hooks Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:21:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:15 --> URI Class Initialized
INFO - 2025-08-04 18:21:15 --> Router Class Initialized
INFO - 2025-08-04 18:21:15 --> Database Driver Class Initialized
INFO - 2025-08-04 18:21:15 --> Output Class Initialized
INFO - 2025-08-04 18:21:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:15 --> Input Class Initialized
INFO - 2025-08-04 18:21:15 --> Language Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:15 --> Controller Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Loader Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:15 --> Config Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:15 --> Hooks Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 18:21:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:15 --> URI Class Initialized
INFO - 2025-08-04 18:21:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:15 --> Total execution time: 0.0094
INFO - 2025-08-04 18:21:15 --> Router Class Initialized
INFO - 2025-08-04 18:21:15 --> Database Driver Class Initialized
INFO - 2025-08-04 18:21:15 --> Output Class Initialized
INFO - 2025-08-04 18:21:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:15 --> Input Class Initialized
INFO - 2025-08-04 18:21:15 --> Language Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:15 --> Controller Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:15 --> Loader Class Initialized
INFO - 2025-08-04 18:21:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:15 --> Total execution time: 0.0090
INFO - 2025-08-04 18:21:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:15 --> Controller Class Initialized
INFO - 2025-08-04 18:21:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:15 --> Total execution time: 0.0163
INFO - 2025-08-04 18:21:16 --> Config Class Initialized
INFO - 2025-08-04 18:21:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:16 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:16 --> URI Class Initialized
INFO - 2025-08-04 18:21:16 --> Router Class Initialized
INFO - 2025-08-04 18:21:16 --> Output Class Initialized
INFO - 2025-08-04 18:21:16 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:16 --> Input Class Initialized
INFO - 2025-08-04 18:21:16 --> Language Class Initialized
INFO - 2025-08-04 18:21:16 --> Loader Class Initialized
INFO - 2025-08-04 18:21:16 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:16 --> Controller Class Initialized
INFO - 2025-08-04 18:21:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:21:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:21:16 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:21:16 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:21:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:21:16 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:16 --> Total execution time: 0.0252
INFO - 2025-08-04 18:21:16 --> Config Class Initialized
INFO - 2025-08-04 18:21:16 --> Config Class Initialized
INFO - 2025-08-04 18:21:16 --> Hooks Class Initialized
INFO - 2025-08-04 18:21:16 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:16 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:21:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:16 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:16 --> URI Class Initialized
INFO - 2025-08-04 18:21:16 --> Config Class Initialized
INFO - 2025-08-04 18:21:16 --> Hooks Class Initialized
INFO - 2025-08-04 18:21:16 --> URI Class Initialized
DEBUG - 2025-08-04 18:21:16 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:16 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:16 --> Router Class Initialized
INFO - 2025-08-04 18:21:16 --> Router Class Initialized
INFO - 2025-08-04 18:21:16 --> URI Class Initialized
INFO - 2025-08-04 18:21:16 --> Output Class Initialized
INFO - 2025-08-04 18:21:16 --> Output Class Initialized
INFO - 2025-08-04 18:21:16 --> Security Class Initialized
INFO - 2025-08-04 18:21:16 --> Router Class Initialized
INFO - 2025-08-04 18:21:16 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:16 --> Input Class Initialized
INFO - 2025-08-04 18:21:16 --> Output Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:16 --> Input Class Initialized
INFO - 2025-08-04 18:21:16 --> Language Class Initialized
INFO - 2025-08-04 18:21:16 --> Language Class Initialized
INFO - 2025-08-04 18:21:16 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:16 --> Loader Class Initialized
INFO - 2025-08-04 18:21:16 --> Input Class Initialized
INFO - 2025-08-04 18:21:16 --> Loader Class Initialized
INFO - 2025-08-04 18:21:16 --> Language Class Initialized
INFO - 2025-08-04 18:21:16 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:16 --> Loader Class Initialized
INFO - 2025-08-04 18:21:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:16 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:16 --> Database Driver Class Initialized
INFO - 2025-08-04 18:21:16 --> Database Driver Class Initialized
INFO - 2025-08-04 18:21:16 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:16 --> Controller Class Initialized
INFO - 2025-08-04 18:21:16 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 18:21:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:21:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:16 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:16 --> Total execution time: 0.0121
INFO - 2025-08-04 18:21:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:16 --> Controller Class Initialized
INFO - 2025-08-04 18:21:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:16 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:16 --> Total execution time: 0.0135
INFO - 2025-08-04 18:21:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:16 --> Controller Class Initialized
INFO - 2025-08-04 18:21:16 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:16 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:21:16 --> Final output sent to browser
DEBUG - 2025-08-04 18:21:16 --> Total execution time: 0.0133
INFO - 2025-08-04 18:21:34 --> Config Class Initialized
INFO - 2025-08-04 18:21:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:21:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:21:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:21:34 --> URI Class Initialized
INFO - 2025-08-04 18:21:34 --> Router Class Initialized
INFO - 2025-08-04 18:21:34 --> Output Class Initialized
INFO - 2025-08-04 18:21:34 --> Security Class Initialized
DEBUG - 2025-08-04 18:21:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:21:34 --> Input Class Initialized
INFO - 2025-08-04 18:21:34 --> Language Class Initialized
INFO - 2025-08-04 18:21:34 --> Loader Class Initialized
INFO - 2025-08-04 18:21:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:21:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:21:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:21:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:21:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:21:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:21:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:21:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:21:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:21:34 --> Controller Class Initialized
INFO - 2025-08-04 18:21:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:21:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:21:34 --> Model "MenuModel" initialized
ERROR - 2025-08-04 18:21:34 --> Query error: Duplicate entry '2025/08/04/000001' for key 'PRIMARY' - Invalid query: INSERT INTO `penilaian_medis_ralan_mata` (`no_rawat`, `kd_dokter`, `anamnesis`, `hubungan`, `keluhan_utama`, `rps`, `rpd`, `alergi`, `td`, `bb`, `suhu`, `nadi`, `rr`, `nyeri`, `visuskanan`, `visuskiri`, `cckanan`, `cckiri`, `palkanan`, `palkiri`, `conkanan`, `conkiri`, `corneakanan`, `corneakiri`, `coakanan`, `coakiri`, `pupilkanan`, `pupilkiri`, `lensakanan`, `lensakiri`, `funduskanan`, `funduskiri`, `papilkanan`, `papilkiri`, `retinakanan`, `retinakiri`, `makulakanan`, `makulakiri`, `tiokanan`, `tiokiri`, `mbokanan`, `mbokiri`, `lab`, `rad`, `penunjang`, `tes`, `pemeriksaan`, `diagnosis`, `diagnosisbdg`, `permasalahan`, `terapi`, `tindakan`, `edukasi`, `tanggal`) VALUES ('2025/08/04/000001', '150', 'Autoanamnesis', 'sdsd', 'sdsd', 'qw', 'qw', 'qw', '12', '12', '12', '12', '12', 'tidak ada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-08-04 23:21:16')
INFO - 2025-08-04 18:21:34 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:23:51 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:23:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:23:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:23:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0330
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:23:51 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:23:51 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:23:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0142
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:23:51 --> Config Class Initialized
INFO - 2025-08-04 18:23:51 --> Hooks Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:23:51 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:23:51 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> URI Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
INFO - 2025-08-04 18:23:51 --> Router Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
INFO - 2025-08-04 18:23:51 --> Output Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0151
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> Security Class Initialized
DEBUG - 2025-08-04 18:23:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:23:51 --> Input Class Initialized
INFO - 2025-08-04 18:23:51 --> Language Class Initialized
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:23:51 --> Loader Class Initialized
INFO - 2025-08-04 18:23:51 --> Helper loaded: url_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: form_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:23:51 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0150
INFO - 2025-08-04 18:23:51 --> Database Driver Class Initialized
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0140
DEBUG - 2025-08-04 18:23:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:23:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:23:51 --> Controller Class Initialized
INFO - 2025-08-04 18:23:51 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:23:51 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:23:51 --> Final output sent to browser
DEBUG - 2025-08-04 18:23:51 --> Total execution time: 0.0161
INFO - 2025-08-04 18:24:03 --> Config Class Initialized
INFO - 2025-08-04 18:24:03 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:03 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:03 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:03 --> URI Class Initialized
INFO - 2025-08-04 18:24:03 --> Router Class Initialized
INFO - 2025-08-04 18:24:03 --> Output Class Initialized
INFO - 2025-08-04 18:24:03 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:03 --> Input Class Initialized
INFO - 2025-08-04 18:24:03 --> Language Class Initialized
INFO - 2025-08-04 18:24:03 --> Loader Class Initialized
INFO - 2025-08-04 18:24:03 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:03 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:03 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:03 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:03 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:03 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:03 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:03 --> Controller Class Initialized
INFO - 2025-08-04 18:24:03 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:03 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:03 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:03 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:03 --> Total execution time: 0.0223
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:09 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0248
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:24:09 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:24:09 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:24:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0310
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:09 --> Config Class Initialized
INFO - 2025-08-04 18:24:09 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:24:09 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:09 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> URI Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
INFO - 2025-08-04 18:24:09 --> Router Class Initialized
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
INFO - 2025-08-04 18:24:09 --> Output Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:09 --> Security Class Initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:24:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Input Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Language Class Initialized
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Loader Class Initialized
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0140
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:09 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:09 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0131
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0181
INFO - 2025-08-04 18:24:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:09 --> Controller Class Initialized
INFO - 2025-08-04 18:24:09 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:09 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:09 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:09 --> Total execution time: 0.0176
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:30 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:30 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:30 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:30 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0279
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:24:30 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:24:30 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:24:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0137
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Config Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:30 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:30 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> URI Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:30 --> Router Class Initialized
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Output Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Security Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 18:24:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> Input Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:30 --> Language Class Initialized
INFO - 2025-08-04 18:24:30 --> Loader Class Initialized
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0102
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0101
INFO - 2025-08-04 18:24:30 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:24:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0125
INFO - 2025-08-04 18:24:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:30 --> Controller Class Initialized
INFO - 2025-08-04 18:24:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:30 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:30 --> Total execution time: 0.0118
INFO - 2025-08-04 18:24:33 --> Config Class Initialized
INFO - 2025-08-04 18:24:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:33 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:33 --> URI Class Initialized
INFO - 2025-08-04 18:24:33 --> Router Class Initialized
INFO - 2025-08-04 18:24:33 --> Output Class Initialized
INFO - 2025-08-04 18:24:33 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:33 --> Input Class Initialized
INFO - 2025-08-04 18:24:33 --> Language Class Initialized
INFO - 2025-08-04 18:24:33 --> Loader Class Initialized
INFO - 2025-08-04 18:24:33 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:33 --> Controller Class Initialized
INFO - 2025-08-04 18:24:33 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:24:33 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:24:33 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 18:24:33 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:33 --> Total execution time: 0.0229
INFO - 2025-08-04 18:24:33 --> Config Class Initialized
INFO - 2025-08-04 18:24:33 --> Config Class Initialized
INFO - 2025-08-04 18:24:33 --> Config Class Initialized
INFO - 2025-08-04 18:24:33 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:33 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:33 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:33 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:24:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:33 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:33 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:24:33 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:33 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:33 --> URI Class Initialized
INFO - 2025-08-04 18:24:33 --> URI Class Initialized
INFO - 2025-08-04 18:24:33 --> URI Class Initialized
INFO - 2025-08-04 18:24:33 --> Router Class Initialized
INFO - 2025-08-04 18:24:33 --> Router Class Initialized
INFO - 2025-08-04 18:24:33 --> Router Class Initialized
INFO - 2025-08-04 18:24:33 --> Output Class Initialized
INFO - 2025-08-04 18:24:33 --> Output Class Initialized
INFO - 2025-08-04 18:24:33 --> Output Class Initialized
INFO - 2025-08-04 18:24:33 --> Security Class Initialized
INFO - 2025-08-04 18:24:33 --> Security Class Initialized
INFO - 2025-08-04 18:24:33 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:33 --> Input Class Initialized
INFO - 2025-08-04 18:24:33 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:33 --> Input Class Initialized
INFO - 2025-08-04 18:24:33 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:33 --> Input Class Initialized
INFO - 2025-08-04 18:24:33 --> Language Class Initialized
INFO - 2025-08-04 18:24:33 --> Loader Class Initialized
INFO - 2025-08-04 18:24:33 --> Loader Class Initialized
INFO - 2025-08-04 18:24:33 --> Loader Class Initialized
INFO - 2025-08-04 18:24:33 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:33 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:33 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:33 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:33 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:33 --> Controller Class Initialized
INFO - 2025-08-04 18:24:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:33 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:33 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:33 --> Total execution time: 0.0115
INFO - 2025-08-04 18:24:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:33 --> Controller Class Initialized
INFO - 2025-08-04 18:24:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:33 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:33 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:33 --> Total execution time: 0.0142
INFO - 2025-08-04 18:24:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:33 --> Controller Class Initialized
INFO - 2025-08-04 18:24:33 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:33 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:33 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:33 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:33 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:33 --> Total execution time: 0.0171
INFO - 2025-08-04 18:24:34 --> Config Class Initialized
INFO - 2025-08-04 18:24:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:34 --> URI Class Initialized
INFO - 2025-08-04 18:24:34 --> Router Class Initialized
INFO - 2025-08-04 18:24:34 --> Output Class Initialized
INFO - 2025-08-04 18:24:34 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:34 --> Input Class Initialized
INFO - 2025-08-04 18:24:34 --> Language Class Initialized
INFO - 2025-08-04 18:24:34 --> Loader Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:34 --> Controller Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:24:34 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:24:34 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:24:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:24:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:34 --> Total execution time: 0.0233
INFO - 2025-08-04 18:24:34 --> Config Class Initialized
INFO - 2025-08-04 18:24:34 --> Config Class Initialized
INFO - 2025-08-04 18:24:34 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:34 --> Config Class Initialized
DEBUG - 2025-08-04 18:24:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:34 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:34 --> URI Class Initialized
INFO - 2025-08-04 18:24:34 --> URI Class Initialized
DEBUG - 2025-08-04 18:24:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:34 --> Router Class Initialized
INFO - 2025-08-04 18:24:34 --> Router Class Initialized
INFO - 2025-08-04 18:24:34 --> Config Class Initialized
INFO - 2025-08-04 18:24:34 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:34 --> URI Class Initialized
INFO - 2025-08-04 18:24:34 --> Output Class Initialized
INFO - 2025-08-04 18:24:34 --> Output Class Initialized
DEBUG - 2025-08-04 18:24:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:34 --> Router Class Initialized
INFO - 2025-08-04 18:24:34 --> Security Class Initialized
INFO - 2025-08-04 18:24:34 --> Security Class Initialized
INFO - 2025-08-04 18:24:34 --> URI Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:34 --> Output Class Initialized
INFO - 2025-08-04 18:24:34 --> Input Class Initialized
INFO - 2025-08-04 18:24:34 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:34 --> Input Class Initialized
INFO - 2025-08-04 18:24:34 --> Router Class Initialized
INFO - 2025-08-04 18:24:34 --> Language Class Initialized
INFO - 2025-08-04 18:24:34 --> Security Class Initialized
INFO - 2025-08-04 18:24:34 --> Output Class Initialized
INFO - 2025-08-04 18:24:34 --> Loader Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:34 --> Input Class Initialized
INFO - 2025-08-04 18:24:34 --> Language Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:34 --> Loader Class Initialized
INFO - 2025-08-04 18:24:34 --> Security Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 18:24:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:34 --> Input Class Initialized
INFO - 2025-08-04 18:24:34 --> Loader Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:34 --> Language Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:34 --> Loader Class Initialized
INFO - 2025-08-04 18:24:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:34 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:34 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:34 --> Controller Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 18:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:34 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:34 --> Total execution time: 0.0153
INFO - 2025-08-04 18:24:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:34 --> Controller Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:34 --> Total execution time: 0.0166
INFO - 2025-08-04 18:24:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:34 --> Controller Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:34 --> Total execution time: 0.0181
INFO - 2025-08-04 18:24:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:34 --> Controller Class Initialized
INFO - 2025-08-04 18:24:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:34 --> Total execution time: 0.0182
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:47 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:24:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:24:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:24:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0221
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:24:47 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:24:47 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:24:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0146
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
INFO - 2025-08-04 18:24:47 --> Config Class Initialized
INFO - 2025-08-04 18:24:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
DEBUG - 2025-08-04 18:24:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:24:47 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
INFO - 2025-08-04 18:24:47 --> URI Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
INFO - 2025-08-04 18:24:47 --> Router Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
INFO - 2025-08-04 18:24:47 --> Output Class Initialized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
INFO - 2025-08-04 18:24:47 --> Security Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:24:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:24:47 --> Input Class Initialized
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Language Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Loader Class Initialized
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:24:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
INFO - 2025-08-04 18:24:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:24:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0114
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0128
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0123
INFO - 2025-08-04 18:24:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:24:47 --> Controller Class Initialized
INFO - 2025-08-04 18:24:47 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:24:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:24:47 --> Final output sent to browser
DEBUG - 2025-08-04 18:24:47 --> Total execution time: 0.0155
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:27:42 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:27:42 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:27:42 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:27:42 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0212
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:27:42 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:27:42 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:27:42 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0160
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Config Class Initialized
INFO - 2025-08-04 18:27:42 --> Hooks Class Initialized
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:27:42 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
INFO - 2025-08-04 18:27:42 --> URI Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Router Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Output Class Initialized
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Security Class Initialized
DEBUG - 2025-08-04 18:27:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:42 --> Input Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:42 --> Language Class Initialized
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Loader Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: auth_helper
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:42 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0116
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Database Driver Class Initialized
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:27:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0114
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0130
INFO - 2025-08-04 18:27:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:42 --> Controller Class Initialized
INFO - 2025-08-04 18:27:42 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:42 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:27:42 --> Final output sent to browser
DEBUG - 2025-08-04 18:27:42 --> Total execution time: 0.0131
INFO - 2025-08-04 18:27:49 --> Config Class Initialized
INFO - 2025-08-04 18:27:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:27:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:27:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:27:49 --> URI Class Initialized
INFO - 2025-08-04 18:27:49 --> Router Class Initialized
INFO - 2025-08-04 18:27:49 --> Output Class Initialized
INFO - 2025-08-04 18:27:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:27:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:27:49 --> Input Class Initialized
INFO - 2025-08-04 18:27:49 --> Language Class Initialized
INFO - 2025-08-04 18:27:49 --> Loader Class Initialized
INFO - 2025-08-04 18:27:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:27:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:27:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:27:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:27:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:27:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:27:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:27:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:27:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:27:49 --> Controller Class Initialized
INFO - 2025-08-04 18:27:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:27:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:27:49 --> Model "MenuModel" initialized
ERROR - 2025-08-04 18:27:49 --> Query error: Table 'sik.pemeriksaan_mata_ralan' doesn't exist - Invalid query: SELECT *
FROM `pemeriksaan_mata_ralan`
WHERE `no_rawat` = '2025/08/04/000001'
AND `tgl_perawatan` = '2025-08-04'
AND `jam_rawat` = '18:59:16'
INFO - 2025-08-04 18:27:49 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:28:36 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:28:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:28:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:28:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0219
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:28:36 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:28:36 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:28:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0243
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
INFO - 2025-08-04 18:28:36 --> Config Class Initialized
INFO - 2025-08-04 18:28:36 --> Hooks Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
DEBUG - 2025-08-04 18:28:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:36 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
INFO - 2025-08-04 18:28:36 --> URI Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
INFO - 2025-08-04 18:28:36 --> Router Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Output Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
INFO - 2025-08-04 18:28:36 --> Security Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:36 --> Input Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Language Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Loader Class Initialized
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Database Driver Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0122
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0122
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0159
INFO - 2025-08-04 18:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:36 --> Controller Class Initialized
INFO - 2025-08-04 18:28:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:28:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:28:36 --> Final output sent to browser
DEBUG - 2025-08-04 18:28:36 --> Total execution time: 0.0136
INFO - 2025-08-04 18:28:41 --> Config Class Initialized
INFO - 2025-08-04 18:28:41 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:28:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:28:41 --> Utf8 Class Initialized
INFO - 2025-08-04 18:28:41 --> URI Class Initialized
INFO - 2025-08-04 18:28:41 --> Router Class Initialized
INFO - 2025-08-04 18:28:41 --> Output Class Initialized
INFO - 2025-08-04 18:28:41 --> Security Class Initialized
DEBUG - 2025-08-04 18:28:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:28:41 --> Input Class Initialized
INFO - 2025-08-04 18:28:41 --> Language Class Initialized
INFO - 2025-08-04 18:28:41 --> Loader Class Initialized
INFO - 2025-08-04 18:28:41 --> Helper loaded: url_helper
INFO - 2025-08-04 18:28:41 --> Helper loaded: form_helper
INFO - 2025-08-04 18:28:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:28:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:28:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:28:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:28:41 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:28:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:28:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:28:41 --> Controller Class Initialized
INFO - 2025-08-04 18:28:41 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:28:41 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:28:41 --> Model "MenuModel" initialized
ERROR - 2025-08-04 18:28:41 --> Query error: Unknown column 'tgl_perawatan' in 'where clause' - Invalid query: SELECT *
FROM `penilaian_medis_ralan_mata`
WHERE `no_rawat` = '2025/08/04/000001'
AND `tgl_perawatan` = '2025-08-04'
AND `jam_rawat` = '18:59:16'
INFO - 2025-08-04 18:28:41 --> Language file loaded: language/english/db_lang.php
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
INFO - 2025-08-04 18:32:32 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:32:32 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:32:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:32:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:32:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0272
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
INFO - 2025-08-04 18:32:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:32:32 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:32:32 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:32:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0573
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
INFO - 2025-08-04 18:32:32 --> Config Class Initialized
INFO - 2025-08-04 18:32:32 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
DEBUG - 2025-08-04 18:32:32 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:32:32 --> Utf8 Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> URI Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Router Class Initialized
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Output Class Initialized
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:32:32 --> Security Class Initialized
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:32:32 --> Input Class Initialized
INFO - 2025-08-04 18:32:32 --> Language Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Loader Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: url_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: form_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:32:32 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
INFO - 2025-08-04 18:32:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0183
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
DEBUG - 2025-08-04 18:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:32:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0123
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
INFO - 2025-08-04 18:32:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0145
INFO - 2025-08-04 18:32:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:32:32 --> Controller Class Initialized
INFO - 2025-08-04 18:32:32 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:32:32 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:32:32 --> Final output sent to browser
DEBUG - 2025-08-04 18:32:32 --> Total execution time: 0.0160
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:34:10 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:34:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:34:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:34:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0222
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:34:10 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:34:10 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:34:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0284
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
INFO - 2025-08-04 18:34:10 --> Config Class Initialized
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Hooks Class Initialized
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 18:34:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Utf8 Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> URI Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Router Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Output Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Security Class Initialized
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:34:10 --> Input Class Initialized
INFO - 2025-08-04 18:34:10 --> Language Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:34:10 --> Loader Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: form_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:34:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:34:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0111
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:34:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0114
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0135
INFO - 2025-08-04 18:34:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:34:10 --> Controller Class Initialized
INFO - 2025-08-04 18:34:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:34:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:34:10 --> Final output sent to browser
DEBUG - 2025-08-04 18:34:10 --> Total execution time: 0.0147
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:49 --> Controller Class Initialized
INFO - 2025-08-04 18:36:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:36:49 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:36:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:49 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:36:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:36:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:36:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:36:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:36:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:49 --> Total execution time: 0.0195
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:49 --> Controller Class Initialized
INFO - 2025-08-04 18:36:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:36:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:49 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:36:49 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:36:49 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:36:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:36:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:49 --> Total execution time: 0.0166
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:49 --> Config Class Initialized
INFO - 2025-08-04 18:36:49 --> Hooks Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
DEBUG - 2025-08-04 18:36:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:49 --> URI Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Router Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
INFO - 2025-08-04 18:36:49 --> Output Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:49 --> Security Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
DEBUG - 2025-08-04 18:36:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:49 --> Input Class Initialized
INFO - 2025-08-04 18:36:49 --> Language Class Initialized
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:49 --> Loader Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:36:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:50 --> Database Driver Class Initialized
INFO - 2025-08-04 18:36:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:50 --> Controller Class Initialized
INFO - 2025-08-04 18:36:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:50 --> Total execution time: 0.0117
INFO - 2025-08-04 18:36:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:50 --> Controller Class Initialized
INFO - 2025-08-04 18:36:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:50 --> Total execution time: 0.0100
INFO - 2025-08-04 18:36:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:50 --> Controller Class Initialized
INFO - 2025-08-04 18:36:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:50 --> Total execution time: 0.0117
INFO - 2025-08-04 18:36:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:50 --> Controller Class Initialized
INFO - 2025-08-04 18:36:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:50 --> Total execution time: 0.0116
INFO - 2025-08-04 18:36:56 --> Config Class Initialized
INFO - 2025-08-04 18:36:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:56 --> URI Class Initialized
INFO - 2025-08-04 18:36:56 --> Router Class Initialized
INFO - 2025-08-04 18:36:56 --> Output Class Initialized
INFO - 2025-08-04 18:36:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:56 --> Input Class Initialized
INFO - 2025-08-04 18:36:56 --> Language Class Initialized
INFO - 2025-08-04 18:36:56 --> Loader Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:56 --> Controller Class Initialized
INFO - 2025-08-04 18:36:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:56 --> Total execution time: 0.0299
INFO - 2025-08-04 18:36:56 --> Config Class Initialized
INFO - 2025-08-04 18:36:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:56 --> URI Class Initialized
INFO - 2025-08-04 18:36:56 --> Router Class Initialized
INFO - 2025-08-04 18:36:56 --> Output Class Initialized
INFO - 2025-08-04 18:36:56 --> Config Class Initialized
INFO - 2025-08-04 18:36:56 --> Hooks Class Initialized
INFO - 2025-08-04 18:36:56 --> Security Class Initialized
INFO - 2025-08-04 18:36:56 --> Config Class Initialized
INFO - 2025-08-04 18:36:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:56 --> Input Class Initialized
DEBUG - 2025-08-04 18:36:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:56 --> Language Class Initialized
INFO - 2025-08-04 18:36:56 --> URI Class Initialized
DEBUG - 2025-08-04 18:36:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:36:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:36:56 --> URI Class Initialized
INFO - 2025-08-04 18:36:56 --> Router Class Initialized
INFO - 2025-08-04 18:36:56 --> Loader Class Initialized
INFO - 2025-08-04 18:36:56 --> Router Class Initialized
INFO - 2025-08-04 18:36:56 --> Output Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:56 --> Output Class Initialized
INFO - 2025-08-04 18:36:56 --> Security Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:56 --> Input Class Initialized
INFO - 2025-08-04 18:36:56 --> Language Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:36:56 --> Input Class Initialized
INFO - 2025-08-04 18:36:56 --> Language Class Initialized
INFO - 2025-08-04 18:36:56 --> Loader Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:56 --> Loader Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:56 --> Database Driver Class Initialized
INFO - 2025-08-04 18:36:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:36:56 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:36:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:56 --> Controller Class Initialized
INFO - 2025-08-04 18:36:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:56 --> Database Driver Class Initialized
INFO - 2025-08-04 18:36:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:56 --> Total execution time: 0.0106
INFO - 2025-08-04 18:36:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:36:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:56 --> Controller Class Initialized
INFO - 2025-08-04 18:36:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:36:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:36:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:56 --> Total execution time: 0.0108
INFO - 2025-08-04 18:36:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:36:56 --> Controller Class Initialized
INFO - 2025-08-04 18:36:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:36:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:36:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:36:56 --> Total execution time: 0.0128
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:38:15 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:38:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:38:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:38:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0250
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:38:15 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:38:15 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:38:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0299
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
INFO - 2025-08-04 18:38:15 --> Config Class Initialized
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
INFO - 2025-08-04 18:38:15 --> Hooks Class Initialized
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
DEBUG - 2025-08-04 18:38:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
INFO - 2025-08-04 18:38:15 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:15 --> URI Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Router Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Output Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:15 --> Security Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:38:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:15 --> Input Class Initialized
INFO - 2025-08-04 18:38:15 --> Language Class Initialized
INFO - 2025-08-04 18:38:15 --> Loader Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
INFO - 2025-08-04 18:38:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:15 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0156
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0150
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0166
INFO - 2025-08-04 18:38:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:15 --> Controller Class Initialized
INFO - 2025-08-04 18:38:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:15 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:15 --> Total execution time: 0.0194
INFO - 2025-08-04 18:38:21 --> Config Class Initialized
INFO - 2025-08-04 18:38:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:21 --> URI Class Initialized
INFO - 2025-08-04 18:38:21 --> Router Class Initialized
INFO - 2025-08-04 18:38:21 --> Output Class Initialized
INFO - 2025-08-04 18:38:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:21 --> Input Class Initialized
INFO - 2025-08-04 18:38:21 --> Language Class Initialized
INFO - 2025-08-04 18:38:21 --> Loader Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:21 --> Controller Class Initialized
INFO - 2025-08-04 18:38:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:21 --> Total execution time: 0.0233
INFO - 2025-08-04 18:38:21 --> Config Class Initialized
INFO - 2025-08-04 18:38:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:21 --> URI Class Initialized
INFO - 2025-08-04 18:38:21 --> Router Class Initialized
INFO - 2025-08-04 18:38:21 --> Output Class Initialized
INFO - 2025-08-04 18:38:21 --> Config Class Initialized
INFO - 2025-08-04 18:38:21 --> Security Class Initialized
INFO - 2025-08-04 18:38:21 --> Hooks Class Initialized
INFO - 2025-08-04 18:38:21 --> Config Class Initialized
INFO - 2025-08-04 18:38:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:21 --> Input Class Initialized
INFO - 2025-08-04 18:38:21 --> Language Class Initialized
DEBUG - 2025-08-04 18:38:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:21 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:38:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:38:21 --> Utf8 Class Initialized
INFO - 2025-08-04 18:38:21 --> URI Class Initialized
INFO - 2025-08-04 18:38:21 --> URI Class Initialized
INFO - 2025-08-04 18:38:21 --> Loader Class Initialized
INFO - 2025-08-04 18:38:21 --> Router Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:21 --> Router Class Initialized
INFO - 2025-08-04 18:38:21 --> Output Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:21 --> Output Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:21 --> Security Class Initialized
INFO - 2025-08-04 18:38:21 --> Security Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:21 --> Input Class Initialized
INFO - 2025-08-04 18:38:21 --> Language Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:38:21 --> Input Class Initialized
INFO - 2025-08-04 18:38:21 --> Language Class Initialized
INFO - 2025-08-04 18:38:21 --> Loader Class Initialized
INFO - 2025-08-04 18:38:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:21 --> Loader Class Initialized
INFO - 2025-08-04 18:38:21 --> Helper loaded: url_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: form_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:38:21 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:38:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:21 --> Controller Class Initialized
INFO - 2025-08-04 18:38:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:21 --> Total execution time: 0.0117
INFO - 2025-08-04 18:38:21 --> Database Driver Class Initialized
INFO - 2025-08-04 18:38:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:38:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:21 --> Controller Class Initialized
INFO - 2025-08-04 18:38:21 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 18:38:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:38:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:21 --> Total execution time: 0.0116
INFO - 2025-08-04 18:38:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:38:21 --> Controller Class Initialized
INFO - 2025-08-04 18:38:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:38:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:38:21 --> Final output sent to browser
DEBUG - 2025-08-04 18:38:21 --> Total execution time: 0.0131
INFO - 2025-08-04 18:39:37 --> Config Class Initialized
INFO - 2025-08-04 18:39:37 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:37 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:37 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:37 --> URI Class Initialized
INFO - 2025-08-04 18:39:37 --> Router Class Initialized
INFO - 2025-08-04 18:39:37 --> Output Class Initialized
INFO - 2025-08-04 18:39:37 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:37 --> Input Class Initialized
INFO - 2025-08-04 18:39:37 --> Language Class Initialized
INFO - 2025-08-04 18:39:37 --> Loader Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:37 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:37 --> Controller Class Initialized
INFO - 2025-08-04 18:39:37 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:37 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:37 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:37 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:37 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:37 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:37 --> Total execution time: 0.0234
INFO - 2025-08-04 18:39:37 --> Config Class Initialized
INFO - 2025-08-04 18:39:37 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:37 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:37 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:37 --> URI Class Initialized
INFO - 2025-08-04 18:39:37 --> Router Class Initialized
INFO - 2025-08-04 18:39:37 --> Output Class Initialized
INFO - 2025-08-04 18:39:37 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:37 --> Input Class Initialized
INFO - 2025-08-04 18:39:37 --> Language Class Initialized
INFO - 2025-08-04 18:39:37 --> Loader Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:37 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:37 --> Controller Class Initialized
INFO - 2025-08-04 18:39:37 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:37 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:39:37 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:39:37 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:39:37 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:39:37 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:37 --> Total execution time: 0.0159
INFO - 2025-08-04 18:39:37 --> Config Class Initialized
INFO - 2025-08-04 18:39:37 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:37 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:37 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:37 --> URI Class Initialized
INFO - 2025-08-04 18:39:37 --> Router Class Initialized
INFO - 2025-08-04 18:39:37 --> Output Class Initialized
INFO - 2025-08-04 18:39:37 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:37 --> Input Class Initialized
INFO - 2025-08-04 18:39:37 --> Language Class Initialized
INFO - 2025-08-04 18:39:37 --> Loader Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:37 --> Config Class Initialized
INFO - 2025-08-04 18:39:37 --> Config Class Initialized
INFO - 2025-08-04 18:39:37 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:37 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 18:39:37 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:39:37 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:37 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:37 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:37 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:37 --> URI Class Initialized
INFO - 2025-08-04 18:39:37 --> URI Class Initialized
INFO - 2025-08-04 18:39:37 --> Router Class Initialized
INFO - 2025-08-04 18:39:37 --> Output Class Initialized
INFO - 2025-08-04 18:39:37 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:37 --> Security Class Initialized
INFO - 2025-08-04 18:39:37 --> Router Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:37 --> Input Class Initialized
INFO - 2025-08-04 18:39:37 --> Language Class Initialized
INFO - 2025-08-04 18:39:37 --> Output Class Initialized
INFO - 2025-08-04 18:39:37 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:37 --> Loader Class Initialized
INFO - 2025-08-04 18:39:37 --> Input Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:37 --> Language Class Initialized
INFO - 2025-08-04 18:39:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:37 --> Controller Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:37 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:37 --> Loader Class Initialized
INFO - 2025-08-04 18:39:37 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:37 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:37 --> Total execution time: 0.0097
INFO - 2025-08-04 18:39:37 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:37 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:37 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:37 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:37 --> Controller Class Initialized
INFO - 2025-08-04 18:39:37 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 18:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:37 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:37 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:37 --> Total execution time: 0.0093
INFO - 2025-08-04 18:39:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:37 --> Controller Class Initialized
INFO - 2025-08-04 18:39:37 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:37 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:37 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:37 --> Total execution time: 0.0114
INFO - 2025-08-04 18:39:39 --> Config Class Initialized
INFO - 2025-08-04 18:39:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:39 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:39 --> URI Class Initialized
INFO - 2025-08-04 18:39:39 --> Router Class Initialized
INFO - 2025-08-04 18:39:39 --> Output Class Initialized
INFO - 2025-08-04 18:39:39 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:39 --> Input Class Initialized
INFO - 2025-08-04 18:39:39 --> Language Class Initialized
INFO - 2025-08-04 18:39:39 --> Loader Class Initialized
INFO - 2025-08-04 18:39:39 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:39 --> Controller Class Initialized
INFO - 2025-08-04 18:39:39 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:39:39 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:39:39 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 18:39:39 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:39 --> Total execution time: 0.0233
INFO - 2025-08-04 18:39:39 --> Config Class Initialized
INFO - 2025-08-04 18:39:39 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:39 --> Config Class Initialized
INFO - 2025-08-04 18:39:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:39 --> Config Class Initialized
INFO - 2025-08-04 18:39:39 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:39 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:39 --> URI Class Initialized
DEBUG - 2025-08-04 18:39:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:39 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:39 --> URI Class Initialized
INFO - 2025-08-04 18:39:39 --> Router Class Initialized
DEBUG - 2025-08-04 18:39:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:39 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:39 --> Output Class Initialized
INFO - 2025-08-04 18:39:39 --> Router Class Initialized
INFO - 2025-08-04 18:39:39 --> URI Class Initialized
INFO - 2025-08-04 18:39:39 --> Security Class Initialized
INFO - 2025-08-04 18:39:39 --> Output Class Initialized
INFO - 2025-08-04 18:39:39 --> Router Class Initialized
DEBUG - 2025-08-04 18:39:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:39 --> Input Class Initialized
INFO - 2025-08-04 18:39:39 --> Language Class Initialized
INFO - 2025-08-04 18:39:39 --> Security Class Initialized
INFO - 2025-08-04 18:39:39 --> Output Class Initialized
DEBUG - 2025-08-04 18:39:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:39 --> Input Class Initialized
INFO - 2025-08-04 18:39:39 --> Language Class Initialized
INFO - 2025-08-04 18:39:39 --> Loader Class Initialized
INFO - 2025-08-04 18:39:39 --> Security Class Initialized
INFO - 2025-08-04 18:39:39 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:39:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:39 --> Input Class Initialized
INFO - 2025-08-04 18:39:39 --> Language Class Initialized
INFO - 2025-08-04 18:39:39 --> Loader Class Initialized
INFO - 2025-08-04 18:39:39 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:39 --> Loader Class Initialized
INFO - 2025-08-04 18:39:39 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:39 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:39 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:39 --> Controller Class Initialized
INFO - 2025-08-04 18:39:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:39 --> Model "SettingModel" initialized
DEBUG - 2025-08-04 18:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 18:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:39 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:39 --> Total execution time: 0.0095
INFO - 2025-08-04 18:39:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:39 --> Controller Class Initialized
INFO - 2025-08-04 18:39:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:39 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:39 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:39 --> Total execution time: 0.0126
INFO - 2025-08-04 18:39:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:39 --> Controller Class Initialized
INFO - 2025-08-04 18:39:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:39 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:39 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:39 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:39 --> Total execution time: 0.0145
INFO - 2025-08-04 18:39:40 --> Config Class Initialized
INFO - 2025-08-04 18:39:40 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:40 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:40 --> URI Class Initialized
INFO - 2025-08-04 18:39:40 --> Router Class Initialized
INFO - 2025-08-04 18:39:40 --> Output Class Initialized
INFO - 2025-08-04 18:39:40 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:40 --> Input Class Initialized
INFO - 2025-08-04 18:39:40 --> Language Class Initialized
INFO - 2025-08-04 18:39:40 --> Loader Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:40 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:40 --> Controller Class Initialized
INFO - 2025-08-04 18:39:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:39:40 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:39:40 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:39:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:39:40 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:40 --> Total execution time: 0.0259
INFO - 2025-08-04 18:39:40 --> Config Class Initialized
INFO - 2025-08-04 18:39:40 --> Config Class Initialized
INFO - 2025-08-04 18:39:40 --> Config Class Initialized
INFO - 2025-08-04 18:39:40 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:40 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:40 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:40 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:39:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:40 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:40 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:39:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:40 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:40 --> URI Class Initialized
INFO - 2025-08-04 18:39:40 --> URI Class Initialized
INFO - 2025-08-04 18:39:40 --> URI Class Initialized
INFO - 2025-08-04 18:39:40 --> Router Class Initialized
INFO - 2025-08-04 18:39:40 --> Router Class Initialized
INFO - 2025-08-04 18:39:40 --> Output Class Initialized
INFO - 2025-08-04 18:39:40 --> Router Class Initialized
INFO - 2025-08-04 18:39:40 --> Output Class Initialized
INFO - 2025-08-04 18:39:40 --> Security Class Initialized
INFO - 2025-08-04 18:39:40 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:40 --> Input Class Initialized
INFO - 2025-08-04 18:39:40 --> Language Class Initialized
DEBUG - 2025-08-04 18:39:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:40 --> Output Class Initialized
INFO - 2025-08-04 18:39:40 --> Input Class Initialized
INFO - 2025-08-04 18:39:40 --> Loader Class Initialized
INFO - 2025-08-04 18:39:40 --> Language Class Initialized
INFO - 2025-08-04 18:39:40 --> Security Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: form_helper
DEBUG - 2025-08-04 18:39:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:40 --> Input Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:40 --> Language Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:40 --> Loader Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:40 --> Loader Class Initialized
INFO - 2025-08-04 18:39:40 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:40 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:40 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:40 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:40 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:40 --> Controller Class Initialized
INFO - 2025-08-04 18:39:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:39:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:39:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:40 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:40 --> Total execution time: 0.0129
INFO - 2025-08-04 18:39:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:40 --> Controller Class Initialized
INFO - 2025-08-04 18:39:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:40 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:40 --> Total execution time: 0.0140
INFO - 2025-08-04 18:39:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:40 --> Controller Class Initialized
INFO - 2025-08-04 18:39:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:40 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:40 --> Total execution time: 0.0161
INFO - 2025-08-04 18:39:41 --> Config Class Initialized
INFO - 2025-08-04 18:39:41 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:41 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:41 --> URI Class Initialized
INFO - 2025-08-04 18:39:41 --> Router Class Initialized
INFO - 2025-08-04 18:39:41 --> Output Class Initialized
INFO - 2025-08-04 18:39:41 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:41 --> Input Class Initialized
INFO - 2025-08-04 18:39:41 --> Language Class Initialized
INFO - 2025-08-04 18:39:41 --> Loader Class Initialized
INFO - 2025-08-04 18:39:41 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:41 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:41 --> Controller Class Initialized
INFO - 2025-08-04 18:39:41 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:41 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:39:41 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:39:41 --> Decoded menu_url: SoapRalanController/index
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/soap_ralan.php
INFO - 2025-08-04 18:39:41 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:41 --> Total execution time: 0.0262
INFO - 2025-08-04 18:39:41 --> Config Class Initialized
INFO - 2025-08-04 18:39:41 --> Config Class Initialized
INFO - 2025-08-04 18:39:41 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:41 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:41 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:39:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:41 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:41 --> URI Class Initialized
INFO - 2025-08-04 18:39:41 --> URI Class Initialized
INFO - 2025-08-04 18:39:41 --> Router Class Initialized
INFO - 2025-08-04 18:39:41 --> Router Class Initialized
INFO - 2025-08-04 18:39:41 --> Config Class Initialized
INFO - 2025-08-04 18:39:41 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:41 --> Output Class Initialized
INFO - 2025-08-04 18:39:41 --> Output Class Initialized
DEBUG - 2025-08-04 18:39:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:41 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:41 --> URI Class Initialized
INFO - 2025-08-04 18:39:41 --> Security Class Initialized
INFO - 2025-08-04 18:39:41 --> Security Class Initialized
INFO - 2025-08-04 18:39:41 --> Router Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:41 --> Input Class Initialized
INFO - 2025-08-04 18:39:41 --> Language Class Initialized
INFO - 2025-08-04 18:39:41 --> Output Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:41 --> Input Class Initialized
INFO - 2025-08-04 18:39:41 --> Security Class Initialized
INFO - 2025-08-04 18:39:41 --> Language Class Initialized
INFO - 2025-08-04 18:39:41 --> Loader Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:41 --> Input Class Initialized
INFO - 2025-08-04 18:39:41 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:41 --> Language Class Initialized
INFO - 2025-08-04 18:39:41 --> Loader Class Initialized
INFO - 2025-08-04 18:39:41 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:41 --> Loader Class Initialized
INFO - 2025-08-04 18:39:41 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:41 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:41 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:41 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:41 --> Controller Class Initialized
INFO - 2025-08-04 18:39:41 --> Model "PasienRajal_model" initialized
DEBUG - 2025-08-04 18:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:41 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 18:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:41 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:41 --> Total execution time: 0.0124
INFO - 2025-08-04 18:39:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:41 --> Controller Class Initialized
INFO - 2025-08-04 18:39:41 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:41 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:41 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:41 --> Total execution time: 0.0159
INFO - 2025-08-04 18:39:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:41 --> Controller Class Initialized
INFO - 2025-08-04 18:39:41 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:41 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:41 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:39:41 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:39:41 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:41 --> Total execution time: 0.0169
INFO - 2025-08-04 18:39:47 --> Config Class Initialized
INFO - 2025-08-04 18:39:47 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:47 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:47 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:47 --> URI Class Initialized
INFO - 2025-08-04 18:39:47 --> Router Class Initialized
INFO - 2025-08-04 18:39:47 --> Output Class Initialized
INFO - 2025-08-04 18:39:47 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:47 --> Input Class Initialized
INFO - 2025-08-04 18:39:47 --> Language Class Initialized
INFO - 2025-08-04 18:39:47 --> Loader Class Initialized
INFO - 2025-08-04 18:39:47 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:47 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:47 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:47 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:47 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:47 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:47 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:47 --> Controller Class Initialized
INFO - 2025-08-04 18:39:47 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:47 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:39:47 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:47 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:39:47 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:39:48 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:39:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:39:48 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:48 --> Total execution time: 0.0256
INFO - 2025-08-04 18:39:48 --> Config Class Initialized
INFO - 2025-08-04 18:39:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:48 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:48 --> URI Class Initialized
INFO - 2025-08-04 18:39:48 --> Router Class Initialized
INFO - 2025-08-04 18:39:48 --> Output Class Initialized
INFO - 2025-08-04 18:39:48 --> Config Class Initialized
INFO - 2025-08-04 18:39:48 --> Hooks Class Initialized
INFO - 2025-08-04 18:39:48 --> Security Class Initialized
DEBUG - 2025-08-04 18:39:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:48 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:48 --> Config Class Initialized
INFO - 2025-08-04 18:39:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:39:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:48 --> Input Class Initialized
INFO - 2025-08-04 18:39:48 --> URI Class Initialized
INFO - 2025-08-04 18:39:48 --> Language Class Initialized
DEBUG - 2025-08-04 18:39:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:39:48 --> Utf8 Class Initialized
INFO - 2025-08-04 18:39:48 --> URI Class Initialized
INFO - 2025-08-04 18:39:48 --> Router Class Initialized
INFO - 2025-08-04 18:39:48 --> Output Class Initialized
INFO - 2025-08-04 18:39:48 --> Router Class Initialized
INFO - 2025-08-04 18:39:48 --> Loader Class Initialized
INFO - 2025-08-04 18:39:48 --> Security Class Initialized
INFO - 2025-08-04 18:39:48 --> Output Class Initialized
DEBUG - 2025-08-04 18:39:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:48 --> Input Class Initialized
INFO - 2025-08-04 18:39:48 --> Security Class Initialized
INFO - 2025-08-04 18:39:48 --> Language Class Initialized
INFO - 2025-08-04 18:39:48 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:39:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:39:48 --> Input Class Initialized
INFO - 2025-08-04 18:39:48 --> Language Class Initialized
INFO - 2025-08-04 18:39:48 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:48 --> Loader Class Initialized
INFO - 2025-08-04 18:39:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:48 --> Loader Class Initialized
INFO - 2025-08-04 18:39:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: url_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: form_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:39:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:39:48 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:48 --> Database Driver Class Initialized
INFO - 2025-08-04 18:39:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:39:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:48 --> Controller Class Initialized
INFO - 2025-08-04 18:39:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:39:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 18:39:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:39:48 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:48 --> Total execution time: 0.0143
INFO - 2025-08-04 18:39:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:48 --> Controller Class Initialized
INFO - 2025-08-04 18:39:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:48 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:48 --> Total execution time: 0.0129
INFO - 2025-08-04 18:39:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:39:48 --> Controller Class Initialized
INFO - 2025-08-04 18:39:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:39:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:39:48 --> Final output sent to browser
DEBUG - 2025-08-04 18:39:48 --> Total execution time: 0.0136
INFO - 2025-08-04 18:40:49 --> Config Class Initialized
INFO - 2025-08-04 18:40:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:40:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:40:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:40:49 --> URI Class Initialized
INFO - 2025-08-04 18:40:49 --> Router Class Initialized
INFO - 2025-08-04 18:40:49 --> Output Class Initialized
INFO - 2025-08-04 18:40:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:40:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:40:49 --> Input Class Initialized
INFO - 2025-08-04 18:40:49 --> Language Class Initialized
INFO - 2025-08-04 18:40:49 --> Loader Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:40:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:40:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:40:49 --> Controller Class Initialized
INFO - 2025-08-04 18:40:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:40:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:40:49 --> Total execution time: 0.0285
INFO - 2025-08-04 18:40:49 --> Config Class Initialized
INFO - 2025-08-04 18:40:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:40:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:40:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:40:49 --> URI Class Initialized
INFO - 2025-08-04 18:40:49 --> Router Class Initialized
INFO - 2025-08-04 18:40:49 --> Config Class Initialized
INFO - 2025-08-04 18:40:49 --> Config Class Initialized
INFO - 2025-08-04 18:40:49 --> Hooks Class Initialized
INFO - 2025-08-04 18:40:49 --> Hooks Class Initialized
INFO - 2025-08-04 18:40:49 --> Output Class Initialized
INFO - 2025-08-04 18:40:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:40:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:40:49 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:40:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:40:49 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:40:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:40:49 --> URI Class Initialized
INFO - 2025-08-04 18:40:49 --> Input Class Initialized
INFO - 2025-08-04 18:40:49 --> Language Class Initialized
INFO - 2025-08-04 18:40:49 --> URI Class Initialized
INFO - 2025-08-04 18:40:49 --> Router Class Initialized
INFO - 2025-08-04 18:40:49 --> Router Class Initialized
INFO - 2025-08-04 18:40:49 --> Loader Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:40:49 --> Output Class Initialized
INFO - 2025-08-04 18:40:49 --> Output Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:40:49 --> Security Class Initialized
INFO - 2025-08-04 18:40:49 --> Security Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:40:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:40:49 --> Input Class Initialized
DEBUG - 2025-08-04 18:40:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:40:49 --> Input Class Initialized
INFO - 2025-08-04 18:40:49 --> Language Class Initialized
INFO - 2025-08-04 18:40:49 --> Language Class Initialized
INFO - 2025-08-04 18:40:49 --> Loader Class Initialized
INFO - 2025-08-04 18:40:49 --> Loader Class Initialized
INFO - 2025-08-04 18:40:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:40:49 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 18:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:40:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:40:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:40:49 --> Controller Class Initialized
INFO - 2025-08-04 18:40:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:40:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:40:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:40:49 --> Total execution time: 0.0176
INFO - 2025-08-04 18:40:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:40:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:40:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:40:49 --> Controller Class Initialized
INFO - 2025-08-04 18:40:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "RekamMedisRalanModel" initialized
DEBUG - 2025-08-04 18:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:40:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:40:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:40:49 --> Total execution time: 0.0197
INFO - 2025-08-04 18:40:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:40:49 --> Controller Class Initialized
INFO - 2025-08-04 18:40:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:40:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:40:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:40:49 --> Total execution time: 0.0213
INFO - 2025-08-04 18:41:00 --> Config Class Initialized
INFO - 2025-08-04 18:41:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:41:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:41:00 --> Utf8 Class Initialized
INFO - 2025-08-04 18:41:00 --> URI Class Initialized
INFO - 2025-08-04 18:41:00 --> Router Class Initialized
INFO - 2025-08-04 18:41:00 --> Output Class Initialized
INFO - 2025-08-04 18:41:00 --> Security Class Initialized
DEBUG - 2025-08-04 18:41:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:41:00 --> Input Class Initialized
INFO - 2025-08-04 18:41:00 --> Language Class Initialized
INFO - 2025-08-04 18:41:00 --> Loader Class Initialized
INFO - 2025-08-04 18:41:00 --> Helper loaded: url_helper
INFO - 2025-08-04 18:41:00 --> Helper loaded: form_helper
INFO - 2025-08-04 18:41:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:41:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:41:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:41:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:41:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:41:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:41:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:41:00 --> Controller Class Initialized
INFO - 2025-08-04 18:41:00 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:41:00 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:41:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:41:00 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:41:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:41:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:41:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:41:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:41:00 --> Final output sent to browser
DEBUG - 2025-08-04 18:41:00 --> Total execution time: 0.0185
INFO - 2025-08-04 18:41:01 --> Config Class Initialized
INFO - 2025-08-04 18:41:01 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:41:01 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:41:01 --> Utf8 Class Initialized
INFO - 2025-08-04 18:41:01 --> URI Class Initialized
INFO - 2025-08-04 18:41:01 --> Router Class Initialized
INFO - 2025-08-04 18:41:01 --> Output Class Initialized
INFO - 2025-08-04 18:41:01 --> Security Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:41:01 --> Input Class Initialized
INFO - 2025-08-04 18:41:01 --> Language Class Initialized
INFO - 2025-08-04 18:41:01 --> Loader Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: url_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: form_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:41:01 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:41:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:41:01 --> Controller Class Initialized
INFO - 2025-08-04 18:41:01 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:41:01 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:41:01 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:41:01 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:41:01 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:41:01 --> Final output sent to browser
DEBUG - 2025-08-04 18:41:01 --> Total execution time: 0.0149
INFO - 2025-08-04 18:41:01 --> Config Class Initialized
INFO - 2025-08-04 18:41:01 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:41:01 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:41:01 --> Utf8 Class Initialized
INFO - 2025-08-04 18:41:01 --> URI Class Initialized
INFO - 2025-08-04 18:41:01 --> Router Class Initialized
INFO - 2025-08-04 18:41:01 --> Output Class Initialized
INFO - 2025-08-04 18:41:01 --> Security Class Initialized
INFO - 2025-08-04 18:41:01 --> Config Class Initialized
INFO - 2025-08-04 18:41:01 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:41:01 --> Input Class Initialized
INFO - 2025-08-04 18:41:01 --> Language Class Initialized
INFO - 2025-08-04 18:41:01 --> Config Class Initialized
DEBUG - 2025-08-04 18:41:01 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:41:01 --> Hooks Class Initialized
INFO - 2025-08-04 18:41:01 --> Utf8 Class Initialized
INFO - 2025-08-04 18:41:01 --> URI Class Initialized
DEBUG - 2025-08-04 18:41:01 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:41:01 --> Utf8 Class Initialized
INFO - 2025-08-04 18:41:01 --> Loader Class Initialized
INFO - 2025-08-04 18:41:01 --> URI Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: url_helper
INFO - 2025-08-04 18:41:01 --> Router Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: form_helper
INFO - 2025-08-04 18:41:01 --> Router Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:41:01 --> Output Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:41:01 --> Output Class Initialized
INFO - 2025-08-04 18:41:01 --> Security Class Initialized
INFO - 2025-08-04 18:41:01 --> Security Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:41:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:41:01 --> Input Class Initialized
INFO - 2025-08-04 18:41:01 --> Input Class Initialized
INFO - 2025-08-04 18:41:01 --> Language Class Initialized
INFO - 2025-08-04 18:41:01 --> Language Class Initialized
INFO - 2025-08-04 18:41:01 --> Database Driver Class Initialized
INFO - 2025-08-04 18:41:01 --> Loader Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: url_helper
INFO - 2025-08-04 18:41:01 --> Loader Class Initialized
INFO - 2025-08-04 18:41:01 --> Helper loaded: form_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: url_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: form_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:41:01 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:41:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:41:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:41:01 --> Controller Class Initialized
INFO - 2025-08-04 18:41:01 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:41:01 --> Database Driver Class Initialized
INFO - 2025-08-04 18:41:01 --> Final output sent to browser
DEBUG - 2025-08-04 18:41:01 --> Total execution time: 0.0088
INFO - 2025-08-04 18:41:01 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:41:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:41:01 --> Controller Class Initialized
DEBUG - 2025-08-04 18:41:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:41:01 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:41:01 --> Final output sent to browser
DEBUG - 2025-08-04 18:41:01 --> Total execution time: 0.0090
INFO - 2025-08-04 18:41:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:41:01 --> Controller Class Initialized
INFO - 2025-08-04 18:41:01 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:41:01 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:41:01 --> Final output sent to browser
DEBUG - 2025-08-04 18:41:01 --> Total execution time: 0.0098
INFO - 2025-08-04 18:44:49 --> Config Class Initialized
INFO - 2025-08-04 18:44:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:44:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:44:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:44:49 --> URI Class Initialized
INFO - 2025-08-04 18:44:49 --> Router Class Initialized
INFO - 2025-08-04 18:44:49 --> Output Class Initialized
INFO - 2025-08-04 18:44:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:44:49 --> Input Class Initialized
INFO - 2025-08-04 18:44:49 --> Language Class Initialized
INFO - 2025-08-04 18:44:49 --> Loader Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:44:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:44:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:44:49 --> Controller Class Initialized
INFO - 2025-08-04 18:44:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:44:49 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:44:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:44:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:44:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:44:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:44:49 --> Total execution time: 0.0344
INFO - 2025-08-04 18:44:49 --> Config Class Initialized
INFO - 2025-08-04 18:44:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:44:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:44:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:44:49 --> URI Class Initialized
INFO - 2025-08-04 18:44:49 --> Router Class Initialized
INFO - 2025-08-04 18:44:49 --> Output Class Initialized
INFO - 2025-08-04 18:44:49 --> Security Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:44:49 --> Input Class Initialized
INFO - 2025-08-04 18:44:49 --> Language Class Initialized
INFO - 2025-08-04 18:44:49 --> Loader Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:44:49 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:44:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:44:49 --> Controller Class Initialized
INFO - 2025-08-04 18:44:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:44:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:44:49 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:44:49 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:44:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:44:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:44:49 --> Total execution time: 0.0229
INFO - 2025-08-04 18:44:49 --> Config Class Initialized
INFO - 2025-08-04 18:44:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:44:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:44:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:44:49 --> URI Class Initialized
INFO - 2025-08-04 18:44:49 --> Router Class Initialized
INFO - 2025-08-04 18:44:49 --> Output Class Initialized
INFO - 2025-08-04 18:44:49 --> Security Class Initialized
INFO - 2025-08-04 18:44:49 --> Config Class Initialized
INFO - 2025-08-04 18:44:49 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:44:49 --> Input Class Initialized
INFO - 2025-08-04 18:44:49 --> Language Class Initialized
DEBUG - 2025-08-04 18:44:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:44:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:44:49 --> URI Class Initialized
INFO - 2025-08-04 18:44:49 --> Loader Class Initialized
INFO - 2025-08-04 18:44:49 --> Router Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:44:49 --> Config Class Initialized
INFO - 2025-08-04 18:44:49 --> Hooks Class Initialized
INFO - 2025-08-04 18:44:49 --> Output Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: auth_helper
DEBUG - 2025-08-04 18:44:49 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:44:49 --> Utf8 Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:44:49 --> Security Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:44:49 --> URI Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:44:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:44:49 --> Input Class Initialized
INFO - 2025-08-04 18:44:49 --> Language Class Initialized
INFO - 2025-08-04 18:44:49 --> Router Class Initialized
INFO - 2025-08-04 18:44:49 --> Output Class Initialized
INFO - 2025-08-04 18:44:49 --> Security Class Initialized
INFO - 2025-08-04 18:44:49 --> Loader Class Initialized
DEBUG - 2025-08-04 18:44:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:44:49 --> Helper loaded: url_helper
INFO - 2025-08-04 18:44:49 --> Input Class Initialized
INFO - 2025-08-04 18:44:49 --> Language Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:44:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:44:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:44:49 --> Loader Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:44:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:44:49 --> Helper loaded: form_helper
INFO - 2025-08-04 18:44:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:44:49 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:44:49 --> Controller Class Initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:44:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:44:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:44:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:44:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:44:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:44:49 --> Total execution time: 0.0102
DEBUG - 2025-08-04 18:44:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:44:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:44:49 --> Controller Class Initialized
INFO - 2025-08-04 18:44:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Database Driver Class Initialized
INFO - 2025-08-04 18:44:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:44:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:44:49 --> Total execution time: 0.0091
DEBUG - 2025-08-04 18:44:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:44:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:44:49 --> Controller Class Initialized
INFO - 2025-08-04 18:44:49 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:44:49 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:44:49 --> Final output sent to browser
DEBUG - 2025-08-04 18:44:49 --> Total execution time: 0.0114
INFO - 2025-08-04 18:47:50 --> Config Class Initialized
INFO - 2025-08-04 18:47:50 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:47:50 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:47:50 --> Utf8 Class Initialized
INFO - 2025-08-04 18:47:50 --> URI Class Initialized
INFO - 2025-08-04 18:47:50 --> Router Class Initialized
INFO - 2025-08-04 18:47:50 --> Output Class Initialized
INFO - 2025-08-04 18:47:50 --> Security Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:47:50 --> Input Class Initialized
INFO - 2025-08-04 18:47:50 --> Language Class Initialized
INFO - 2025-08-04 18:47:50 --> Loader Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: url_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:47:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:47:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:47:50 --> Controller Class Initialized
INFO - 2025-08-04 18:47:50 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:47:50 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:47:50 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:47:50 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:47:50 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:47:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:47:50 --> Total execution time: 0.0320
INFO - 2025-08-04 18:47:50 --> Config Class Initialized
INFO - 2025-08-04 18:47:50 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:47:50 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:47:50 --> Utf8 Class Initialized
INFO - 2025-08-04 18:47:50 --> URI Class Initialized
INFO - 2025-08-04 18:47:50 --> Router Class Initialized
INFO - 2025-08-04 18:47:50 --> Output Class Initialized
INFO - 2025-08-04 18:47:50 --> Security Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:47:50 --> Input Class Initialized
INFO - 2025-08-04 18:47:50 --> Language Class Initialized
INFO - 2025-08-04 18:47:50 --> Loader Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: url_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:47:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:47:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:47:50 --> Controller Class Initialized
INFO - 2025-08-04 18:47:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:47:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:47:50 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:47:50 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:47:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:47:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:47:50 --> Total execution time: 0.0154
INFO - 2025-08-04 18:47:50 --> Config Class Initialized
INFO - 2025-08-04 18:47:50 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:47:50 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:47:50 --> Utf8 Class Initialized
INFO - 2025-08-04 18:47:50 --> URI Class Initialized
INFO - 2025-08-04 18:47:50 --> Router Class Initialized
INFO - 2025-08-04 18:47:50 --> Output Class Initialized
INFO - 2025-08-04 18:47:50 --> Security Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:47:50 --> Input Class Initialized
INFO - 2025-08-04 18:47:50 --> Language Class Initialized
INFO - 2025-08-04 18:47:50 --> Config Class Initialized
INFO - 2025-08-04 18:47:50 --> Hooks Class Initialized
INFO - 2025-08-04 18:47:50 --> Config Class Initialized
INFO - 2025-08-04 18:47:50 --> Hooks Class Initialized
INFO - 2025-08-04 18:47:50 --> Loader Class Initialized
DEBUG - 2025-08-04 18:47:50 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:47:50 --> Utf8 Class Initialized
DEBUG - 2025-08-04 18:47:50 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:47:50 --> Utf8 Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: url_helper
INFO - 2025-08-04 18:47:50 --> URI Class Initialized
INFO - 2025-08-04 18:47:50 --> URI Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:47:50 --> Router Class Initialized
INFO - 2025-08-04 18:47:50 --> Router Class Initialized
INFO - 2025-08-04 18:47:50 --> Output Class Initialized
INFO - 2025-08-04 18:47:50 --> Output Class Initialized
INFO - 2025-08-04 18:47:50 --> Security Class Initialized
INFO - 2025-08-04 18:47:50 --> Security Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2025-08-04 18:47:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:47:50 --> Input Class Initialized
INFO - 2025-08-04 18:47:50 --> Input Class Initialized
INFO - 2025-08-04 18:47:50 --> Language Class Initialized
INFO - 2025-08-04 18:47:50 --> Database Driver Class Initialized
INFO - 2025-08-04 18:47:50 --> Language Class Initialized
INFO - 2025-08-04 18:47:50 --> Loader Class Initialized
INFO - 2025-08-04 18:47:50 --> Loader Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: url_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:47:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:47:50 --> Controller Class Initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:47:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: form_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:47:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:47:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:47:50 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:47:50 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:47:50 --> Final output sent to browser
INFO - 2025-08-04 18:47:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Total execution time: 0.0098
INFO - 2025-08-04 18:47:50 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:47:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:47:50 --> Controller Class Initialized
INFO - 2025-08-04 18:47:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:47:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:47:50 --> Total execution time: 0.0119
INFO - 2025-08-04 18:47:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:47:50 --> Controller Class Initialized
INFO - 2025-08-04 18:47:50 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:47:50 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:47:50 --> Final output sent to browser
DEBUG - 2025-08-04 18:47:50 --> Total execution time: 0.0161
INFO - 2025-08-04 18:48:46 --> Config Class Initialized
INFO - 2025-08-04 18:48:46 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:48:46 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:48:46 --> Utf8 Class Initialized
INFO - 2025-08-04 18:48:46 --> URI Class Initialized
INFO - 2025-08-04 18:48:46 --> Router Class Initialized
INFO - 2025-08-04 18:48:46 --> Output Class Initialized
INFO - 2025-08-04 18:48:46 --> Security Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:48:46 --> Input Class Initialized
INFO - 2025-08-04 18:48:46 --> Language Class Initialized
INFO - 2025-08-04 18:48:46 --> Loader Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: url_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: form_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:48:46 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:48:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:48:46 --> Controller Class Initialized
INFO - 2025-08-04 18:48:46 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:48:46 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:48:46 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:48:46 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:48:46 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:48:46 --> Final output sent to browser
DEBUG - 2025-08-04 18:48:46 --> Total execution time: 0.0233
INFO - 2025-08-04 18:48:46 --> Config Class Initialized
INFO - 2025-08-04 18:48:46 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:48:46 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:48:46 --> Utf8 Class Initialized
INFO - 2025-08-04 18:48:46 --> URI Class Initialized
INFO - 2025-08-04 18:48:46 --> Router Class Initialized
INFO - 2025-08-04 18:48:46 --> Output Class Initialized
INFO - 2025-08-04 18:48:46 --> Security Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:48:46 --> Input Class Initialized
INFO - 2025-08-04 18:48:46 --> Language Class Initialized
INFO - 2025-08-04 18:48:46 --> Loader Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: url_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: form_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:48:46 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:48:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:48:46 --> Controller Class Initialized
INFO - 2025-08-04 18:48:46 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:48:46 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:48:46 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:48:46 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:48:46 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:48:46 --> Final output sent to browser
DEBUG - 2025-08-04 18:48:46 --> Total execution time: 0.0270
INFO - 2025-08-04 18:48:46 --> Config Class Initialized
INFO - 2025-08-04 18:48:46 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:48:46 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:48:46 --> Utf8 Class Initialized
INFO - 2025-08-04 18:48:46 --> URI Class Initialized
INFO - 2025-08-04 18:48:46 --> Router Class Initialized
INFO - 2025-08-04 18:48:46 --> Output Class Initialized
INFO - 2025-08-04 18:48:46 --> Config Class Initialized
INFO - 2025-08-04 18:48:46 --> Config Class Initialized
INFO - 2025-08-04 18:48:46 --> Hooks Class Initialized
INFO - 2025-08-04 18:48:46 --> Hooks Class Initialized
INFO - 2025-08-04 18:48:46 --> Security Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:48:46 --> Input Class Initialized
DEBUG - 2025-08-04 18:48:46 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 18:48:46 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:48:46 --> Language Class Initialized
INFO - 2025-08-04 18:48:46 --> Utf8 Class Initialized
INFO - 2025-08-04 18:48:46 --> Utf8 Class Initialized
INFO - 2025-08-04 18:48:46 --> URI Class Initialized
INFO - 2025-08-04 18:48:46 --> URI Class Initialized
INFO - 2025-08-04 18:48:46 --> Router Class Initialized
INFO - 2025-08-04 18:48:46 --> Router Class Initialized
INFO - 2025-08-04 18:48:46 --> Loader Class Initialized
INFO - 2025-08-04 18:48:46 --> Output Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: url_helper
INFO - 2025-08-04 18:48:46 --> Output Class Initialized
INFO - 2025-08-04 18:48:46 --> Security Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: form_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:48:46 --> Security Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:48:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:48:46 --> Input Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:48:46 --> Language Class Initialized
INFO - 2025-08-04 18:48:46 --> Input Class Initialized
INFO - 2025-08-04 18:48:46 --> Language Class Initialized
INFO - 2025-08-04 18:48:46 --> Loader Class Initialized
INFO - 2025-08-04 18:48:46 --> Loader Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: url_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: url_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: form_helper
INFO - 2025-08-04 18:48:46 --> Database Driver Class Initialized
INFO - 2025-08-04 18:48:46 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: form_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:48:46 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:48:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:48:46 --> Controller Class Initialized
INFO - 2025-08-04 18:48:46 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Database Driver Class Initialized
INFO - 2025-08-04 18:48:46 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:48:46 --> Database Driver Class Initialized
INFO - 2025-08-04 18:48:46 --> Final output sent to browser
DEBUG - 2025-08-04 18:48:46 --> Total execution time: 0.0090
DEBUG - 2025-08-04 18:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:48:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:48:46 --> Controller Class Initialized
DEBUG - 2025-08-04 18:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:48:46 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:48:46 --> Final output sent to browser
DEBUG - 2025-08-04 18:48:46 --> Total execution time: 0.0083
INFO - 2025-08-04 18:48:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:48:46 --> Controller Class Initialized
INFO - 2025-08-04 18:48:46 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:48:46 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:48:46 --> Final output sent to browser
DEBUG - 2025-08-04 18:48:46 --> Total execution time: 0.0096
INFO - 2025-08-04 18:52:56 --> Config Class Initialized
INFO - 2025-08-04 18:52:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:52:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:52:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:52:56 --> URI Class Initialized
INFO - 2025-08-04 18:52:56 --> Router Class Initialized
INFO - 2025-08-04 18:52:56 --> Output Class Initialized
INFO - 2025-08-04 18:52:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:52:56 --> Input Class Initialized
INFO - 2025-08-04 18:52:56 --> Language Class Initialized
INFO - 2025-08-04 18:52:56 --> Loader Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:52:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:52:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:52:56 --> Controller Class Initialized
INFO - 2025-08-04 18:52:56 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:52:56 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:52:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:52:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:52:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:52:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:52:56 --> Total execution time: 0.0262
INFO - 2025-08-04 18:52:56 --> Config Class Initialized
INFO - 2025-08-04 18:52:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:52:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:52:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:52:56 --> URI Class Initialized
INFO - 2025-08-04 18:52:56 --> Router Class Initialized
INFO - 2025-08-04 18:52:56 --> Output Class Initialized
INFO - 2025-08-04 18:52:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:52:56 --> Input Class Initialized
INFO - 2025-08-04 18:52:56 --> Language Class Initialized
INFO - 2025-08-04 18:52:56 --> Loader Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:52:56 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:52:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:52:56 --> Controller Class Initialized
INFO - 2025-08-04 18:52:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:52:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:52:56 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:52:56 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:52:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:52:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:52:56 --> Total execution time: 0.0306
INFO - 2025-08-04 18:52:56 --> Config Class Initialized
INFO - 2025-08-04 18:52:56 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:52:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:52:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:52:56 --> URI Class Initialized
INFO - 2025-08-04 18:52:56 --> Router Class Initialized
INFO - 2025-08-04 18:52:56 --> Output Class Initialized
INFO - 2025-08-04 18:52:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:52:56 --> Input Class Initialized
INFO - 2025-08-04 18:52:56 --> Language Class Initialized
INFO - 2025-08-04 18:52:56 --> Config Class Initialized
INFO - 2025-08-04 18:52:56 --> Hooks Class Initialized
INFO - 2025-08-04 18:52:56 --> Loader Class Initialized
DEBUG - 2025-08-04 18:52:56 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:52:56 --> Utf8 Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:52:56 --> URI Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:52:56 --> Router Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:52:56 --> Output Class Initialized
INFO - 2025-08-04 18:52:56 --> Security Class Initialized
DEBUG - 2025-08-04 18:52:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:52:56 --> Input Class Initialized
INFO - 2025-08-04 18:52:56 --> Language Class Initialized
INFO - 2025-08-04 18:52:56 --> Database Driver Class Initialized
INFO - 2025-08-04 18:52:56 --> Loader Class Initialized
INFO - 2025-08-04 18:52:56 --> Helper loaded: url_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: form_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:52:56 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 18:52:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:52:56 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:52:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:52:56 --> Controller Class Initialized
INFO - 2025-08-04 18:52:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:52:56 --> Database Driver Class Initialized
INFO - 2025-08-04 18:52:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:52:56 --> Total execution time: 0.0161
DEBUG - 2025-08-04 18:52:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:52:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:52:56 --> Controller Class Initialized
INFO - 2025-08-04 18:52:56 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:52:56 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:52:56 --> Final output sent to browser
DEBUG - 2025-08-04 18:52:56 --> Total execution time: 0.0187
INFO - 2025-08-04 18:53:04 --> Config Class Initialized
INFO - 2025-08-04 18:53:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:04 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:04 --> URI Class Initialized
INFO - 2025-08-04 18:53:04 --> Router Class Initialized
INFO - 2025-08-04 18:53:04 --> Output Class Initialized
INFO - 2025-08-04 18:53:04 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:04 --> Input Class Initialized
INFO - 2025-08-04 18:53:04 --> Language Class Initialized
INFO - 2025-08-04 18:53:04 --> Loader Class Initialized
INFO - 2025-08-04 18:53:04 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:04 --> Controller Class Initialized
INFO - 2025-08-04 18:53:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:04 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:04 --> Total execution time: 0.0335
INFO - 2025-08-04 18:53:04 --> Config Class Initialized
INFO - 2025-08-04 18:53:04 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:04 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:04 --> URI Class Initialized
INFO - 2025-08-04 18:53:04 --> Router Class Initialized
INFO - 2025-08-04 18:53:04 --> Output Class Initialized
INFO - 2025-08-04 18:53:04 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:04 --> Input Class Initialized
INFO - 2025-08-04 18:53:04 --> Language Class Initialized
INFO - 2025-08-04 18:53:04 --> Config Class Initialized
INFO - 2025-08-04 18:53:04 --> Hooks Class Initialized
INFO - 2025-08-04 18:53:04 --> Loader Class Initialized
DEBUG - 2025-08-04 18:53:04 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:04 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:04 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:04 --> URI Class Initialized
INFO - 2025-08-04 18:53:04 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:04 --> Router Class Initialized
INFO - 2025-08-04 18:53:04 --> Output Class Initialized
INFO - 2025-08-04 18:53:04 --> Security Class Initialized
INFO - 2025-08-04 18:53:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:04 --> Input Class Initialized
INFO - 2025-08-04 18:53:04 --> Language Class Initialized
INFO - 2025-08-04 18:53:04 --> Loader Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:04 --> Controller Class Initialized
INFO - 2025-08-04 18:53:04 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:04 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:04 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:04 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:04 --> Total execution time: 0.0103
INFO - 2025-08-04 18:53:04 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:04 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:04 --> Controller Class Initialized
INFO - 2025-08-04 18:53:04 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:04 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:04 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:04 --> Total execution time: 0.0122
INFO - 2025-08-04 18:53:18 --> Config Class Initialized
INFO - 2025-08-04 18:53:18 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:18 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:18 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:18 --> URI Class Initialized
INFO - 2025-08-04 18:53:18 --> Router Class Initialized
INFO - 2025-08-04 18:53:18 --> Output Class Initialized
INFO - 2025-08-04 18:53:18 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:18 --> Input Class Initialized
INFO - 2025-08-04 18:53:18 --> Language Class Initialized
INFO - 2025-08-04 18:53:18 --> Loader Class Initialized
INFO - 2025-08-04 18:53:18 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:18 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:18 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:18 --> Controller Class Initialized
INFO - 2025-08-04 18:53:18 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:18 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:18 --> Total execution time: 0.0254
INFO - 2025-08-04 18:53:18 --> Config Class Initialized
INFO - 2025-08-04 18:53:18 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:18 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:18 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:18 --> URI Class Initialized
INFO - 2025-08-04 18:53:18 --> Router Class Initialized
INFO - 2025-08-04 18:53:18 --> Output Class Initialized
INFO - 2025-08-04 18:53:18 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:18 --> Input Class Initialized
INFO - 2025-08-04 18:53:18 --> Language Class Initialized
INFO - 2025-08-04 18:53:18 --> Loader Class Initialized
INFO - 2025-08-04 18:53:18 --> Config Class Initialized
INFO - 2025-08-04 18:53:18 --> Hooks Class Initialized
INFO - 2025-08-04 18:53:18 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: resep_helper
DEBUG - 2025-08-04 18:53:18 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:18 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:18 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:18 --> URI Class Initialized
INFO - 2025-08-04 18:53:18 --> Router Class Initialized
INFO - 2025-08-04 18:53:18 --> Output Class Initialized
INFO - 2025-08-04 18:53:18 --> Database Driver Class Initialized
INFO - 2025-08-04 18:53:18 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:18 --> Input Class Initialized
INFO - 2025-08-04 18:53:18 --> Language Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:18 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:18 --> Controller Class Initialized
INFO - 2025-08-04 18:53:18 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:18 --> Loader Class Initialized
INFO - 2025-08-04 18:53:18 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:18 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:18 --> Total execution time: 0.0120
INFO - 2025-08-04 18:53:18 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:18 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:18 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:18 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:18 --> Controller Class Initialized
INFO - 2025-08-04 18:53:18 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:18 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:18 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:18 --> Total execution time: 0.0128
INFO - 2025-08-04 18:53:20 --> Config Class Initialized
INFO - 2025-08-04 18:53:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:20 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:20 --> URI Class Initialized
INFO - 2025-08-04 18:53:20 --> Router Class Initialized
INFO - 2025-08-04 18:53:20 --> Output Class Initialized
INFO - 2025-08-04 18:53:20 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:20 --> Input Class Initialized
INFO - 2025-08-04 18:53:20 --> Language Class Initialized
INFO - 2025-08-04 18:53:20 --> Loader Class Initialized
INFO - 2025-08-04 18:53:20 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:20 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:20 --> Controller Class Initialized
INFO - 2025-08-04 18:53:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:20 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:20 --> Total execution time: 0.0218
INFO - 2025-08-04 18:53:28 --> Config Class Initialized
INFO - 2025-08-04 18:53:28 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:28 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:28 --> URI Class Initialized
INFO - 2025-08-04 18:53:28 --> Router Class Initialized
INFO - 2025-08-04 18:53:28 --> Output Class Initialized
INFO - 2025-08-04 18:53:28 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:28 --> Input Class Initialized
INFO - 2025-08-04 18:53:28 --> Language Class Initialized
INFO - 2025-08-04 18:53:28 --> Loader Class Initialized
INFO - 2025-08-04 18:53:28 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:28 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:28 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:28 --> Controller Class Initialized
INFO - 2025-08-04 18:53:28 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:28 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:28 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:28 --> Total execution time: 0.0183
INFO - 2025-08-04 18:53:34 --> Config Class Initialized
INFO - 2025-08-04 18:53:34 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:53:34 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:53:34 --> Utf8 Class Initialized
INFO - 2025-08-04 18:53:34 --> URI Class Initialized
INFO - 2025-08-04 18:53:34 --> Router Class Initialized
INFO - 2025-08-04 18:53:34 --> Output Class Initialized
INFO - 2025-08-04 18:53:34 --> Security Class Initialized
DEBUG - 2025-08-04 18:53:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:53:34 --> Input Class Initialized
INFO - 2025-08-04 18:53:34 --> Language Class Initialized
INFO - 2025-08-04 18:53:34 --> Loader Class Initialized
INFO - 2025-08-04 18:53:34 --> Helper loaded: url_helper
INFO - 2025-08-04 18:53:34 --> Helper loaded: form_helper
INFO - 2025-08-04 18:53:34 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:53:34 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:53:34 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:53:34 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:53:34 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:53:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:53:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:53:34 --> Controller Class Initialized
INFO - 2025-08-04 18:53:34 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:53:34 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:53:34 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:53:34 --> Final output sent to browser
DEBUG - 2025-08-04 18:53:34 --> Total execution time: 0.0198
INFO - 2025-08-04 18:54:45 --> Config Class Initialized
INFO - 2025-08-04 18:54:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:54:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:54:45 --> Utf8 Class Initialized
INFO - 2025-08-04 18:54:45 --> URI Class Initialized
INFO - 2025-08-04 18:54:45 --> Router Class Initialized
INFO - 2025-08-04 18:54:45 --> Output Class Initialized
INFO - 2025-08-04 18:54:45 --> Security Class Initialized
DEBUG - 2025-08-04 18:54:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:54:45 --> Input Class Initialized
INFO - 2025-08-04 18:54:45 --> Language Class Initialized
INFO - 2025-08-04 18:54:45 --> Loader Class Initialized
INFO - 2025-08-04 18:54:45 --> Helper loaded: url_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: form_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:54:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:54:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:54:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:54:45 --> Controller Class Initialized
INFO - 2025-08-04 18:54:45 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:54:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:54:45 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:54:45 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:54:45 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:54:45 --> Final output sent to browser
DEBUG - 2025-08-04 18:54:45 --> Total execution time: 0.0337
INFO - 2025-08-04 18:54:45 --> Config Class Initialized
INFO - 2025-08-04 18:54:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:54:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:54:45 --> Utf8 Class Initialized
INFO - 2025-08-04 18:54:45 --> URI Class Initialized
INFO - 2025-08-04 18:54:45 --> Router Class Initialized
INFO - 2025-08-04 18:54:45 --> Output Class Initialized
INFO - 2025-08-04 18:54:45 --> Security Class Initialized
DEBUG - 2025-08-04 18:54:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:54:45 --> Config Class Initialized
INFO - 2025-08-04 18:54:45 --> Input Class Initialized
INFO - 2025-08-04 18:54:45 --> Hooks Class Initialized
INFO - 2025-08-04 18:54:45 --> Language Class Initialized
DEBUG - 2025-08-04 18:54:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:54:45 --> Utf8 Class Initialized
INFO - 2025-08-04 18:54:45 --> URI Class Initialized
INFO - 2025-08-04 18:54:45 --> Loader Class Initialized
INFO - 2025-08-04 18:54:45 --> Router Class Initialized
INFO - 2025-08-04 18:54:45 --> Helper loaded: url_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: form_helper
INFO - 2025-08-04 18:54:45 --> Output Class Initialized
INFO - 2025-08-04 18:54:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:54:45 --> Security Class Initialized
DEBUG - 2025-08-04 18:54:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:54:45 --> Input Class Initialized
INFO - 2025-08-04 18:54:45 --> Language Class Initialized
INFO - 2025-08-04 18:54:45 --> Loader Class Initialized
INFO - 2025-08-04 18:54:45 --> Helper loaded: url_helper
INFO - 2025-08-04 18:54:45 --> Database Driver Class Initialized
INFO - 2025-08-04 18:54:45 --> Helper loaded: form_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:54:45 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 18:54:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:54:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:54:45 --> Controller Class Initialized
INFO - 2025-08-04 18:54:45 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:54:45 --> Final output sent to browser
INFO - 2025-08-04 18:54:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:54:45 --> Total execution time: 0.0105
DEBUG - 2025-08-04 18:54:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:54:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:54:45 --> Controller Class Initialized
INFO - 2025-08-04 18:54:45 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:54:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:54:45 --> Final output sent to browser
DEBUG - 2025-08-04 18:54:45 --> Total execution time: 0.0154
INFO - 2025-08-04 18:55:45 --> Config Class Initialized
INFO - 2025-08-04 18:55:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:55:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:55:45 --> Utf8 Class Initialized
INFO - 2025-08-04 18:55:45 --> URI Class Initialized
INFO - 2025-08-04 18:55:45 --> Router Class Initialized
INFO - 2025-08-04 18:55:45 --> Output Class Initialized
INFO - 2025-08-04 18:55:45 --> Security Class Initialized
DEBUG - 2025-08-04 18:55:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:55:45 --> Input Class Initialized
INFO - 2025-08-04 18:55:45 --> Language Class Initialized
INFO - 2025-08-04 18:55:45 --> Loader Class Initialized
INFO - 2025-08-04 18:55:45 --> Helper loaded: url_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: form_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:55:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:55:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:55:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:55:45 --> Controller Class Initialized
INFO - 2025-08-04 18:55:45 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:55:45 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:55:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:55:45 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:55:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:55:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:55:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:55:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:55:45 --> Final output sent to browser
DEBUG - 2025-08-04 18:55:45 --> Total execution time: 0.0192
INFO - 2025-08-04 18:55:45 --> Config Class Initialized
INFO - 2025-08-04 18:55:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:55:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:55:45 --> Utf8 Class Initialized
INFO - 2025-08-04 18:55:45 --> URI Class Initialized
INFO - 2025-08-04 18:55:45 --> Router Class Initialized
INFO - 2025-08-04 18:55:45 --> Output Class Initialized
INFO - 2025-08-04 18:55:45 --> Security Class Initialized
DEBUG - 2025-08-04 18:55:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:55:45 --> Input Class Initialized
INFO - 2025-08-04 18:55:45 --> Language Class Initialized
INFO - 2025-08-04 18:55:45 --> Loader Class Initialized
INFO - 2025-08-04 18:55:45 --> Helper loaded: url_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: form_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:55:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:55:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:55:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:55:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:55:45 --> Controller Class Initialized
INFO - 2025-08-04 18:55:45 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:55:45 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:55:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:55:45 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:55:45 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:55:45 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:55:45 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:55:45 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:55:45 --> Final output sent to browser
DEBUG - 2025-08-04 18:55:45 --> Total execution time: 0.0600
INFO - 2025-08-04 18:56:05 --> Config Class Initialized
INFO - 2025-08-04 18:56:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:56:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:56:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:56:05 --> URI Class Initialized
INFO - 2025-08-04 18:56:05 --> Router Class Initialized
INFO - 2025-08-04 18:56:05 --> Output Class Initialized
INFO - 2025-08-04 18:56:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:56:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:56:05 --> Input Class Initialized
INFO - 2025-08-04 18:56:05 --> Language Class Initialized
INFO - 2025-08-04 18:56:05 --> Loader Class Initialized
INFO - 2025-08-04 18:56:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:56:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:56:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:56:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:56:05 --> Controller Class Initialized
INFO - 2025-08-04 18:56:05 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:56:05 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:56:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:56:05 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:56:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:56:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:56:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:56:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:56:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:56:05 --> Total execution time: 0.0390
INFO - 2025-08-04 18:56:05 --> Config Class Initialized
INFO - 2025-08-04 18:56:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:56:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:56:05 --> Utf8 Class Initialized
INFO - 2025-08-04 18:56:05 --> URI Class Initialized
INFO - 2025-08-04 18:56:05 --> Router Class Initialized
INFO - 2025-08-04 18:56:05 --> Output Class Initialized
INFO - 2025-08-04 18:56:05 --> Security Class Initialized
DEBUG - 2025-08-04 18:56:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:56:05 --> Input Class Initialized
INFO - 2025-08-04 18:56:05 --> Language Class Initialized
INFO - 2025-08-04 18:56:05 --> Loader Class Initialized
INFO - 2025-08-04 18:56:05 --> Helper loaded: url_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: form_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:56:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:56:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:56:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:56:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:56:05 --> Controller Class Initialized
INFO - 2025-08-04 18:56:05 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:56:05 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:56:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:56:05 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:56:05 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:56:05 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:56:05 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:56:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:56:05 --> Final output sent to browser
DEBUG - 2025-08-04 18:56:05 --> Total execution time: 0.0179
INFO - 2025-08-04 18:56:05 --> Config Class Initialized
INFO - 2025-08-04 18:56:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:56:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:56:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:56:06 --> URI Class Initialized
INFO - 2025-08-04 18:56:06 --> Router Class Initialized
INFO - 2025-08-04 18:56:06 --> Output Class Initialized
INFO - 2025-08-04 18:56:06 --> Security Class Initialized
DEBUG - 2025-08-04 18:56:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:56:06 --> Input Class Initialized
INFO - 2025-08-04 18:56:06 --> Language Class Initialized
INFO - 2025-08-04 18:56:06 --> Loader Class Initialized
INFO - 2025-08-04 18:56:06 --> Helper loaded: url_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:56:06 --> Config Class Initialized
INFO - 2025-08-04 18:56:06 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:56:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:56:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:56:06 --> Database Driver Class Initialized
INFO - 2025-08-04 18:56:06 --> URI Class Initialized
INFO - 2025-08-04 18:56:06 --> Router Class Initialized
INFO - 2025-08-04 18:56:06 --> Output Class Initialized
DEBUG - 2025-08-04 18:56:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:56:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:56:06 --> Controller Class Initialized
INFO - 2025-08-04 18:56:06 --> Security Class Initialized
INFO - 2025-08-04 18:56:06 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:56:06 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:56:06 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 18:56:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:56:06 --> Input Class Initialized
INFO - 2025-08-04 18:56:06 --> Language Class Initialized
INFO - 2025-08-04 18:56:06 --> Loader Class Initialized
INFO - 2025-08-04 18:56:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:56:06 --> Total execution time: 0.0094
INFO - 2025-08-04 18:56:06 --> Helper loaded: url_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:56:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:56:06 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:56:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:56:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:56:06 --> Controller Class Initialized
INFO - 2025-08-04 18:56:06 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:56:06 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:56:06 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:56:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:56:06 --> Total execution time: 0.0093
INFO - 2025-08-04 18:58:06 --> Config Class Initialized
INFO - 2025-08-04 18:58:06 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:06 --> URI Class Initialized
INFO - 2025-08-04 18:58:06 --> Router Class Initialized
INFO - 2025-08-04 18:58:06 --> Output Class Initialized
INFO - 2025-08-04 18:58:06 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:06 --> Input Class Initialized
INFO - 2025-08-04 18:58:06 --> Language Class Initialized
INFO - 2025-08-04 18:58:06 --> Loader Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: url_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:06 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:06 --> Controller Class Initialized
INFO - 2025-08-04 18:58:06 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:58:06 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:58:06 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:58:06 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:58:06 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:58:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:06 --> Total execution time: 0.0322
INFO - 2025-08-04 18:58:06 --> Config Class Initialized
INFO - 2025-08-04 18:58:06 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:06 --> URI Class Initialized
INFO - 2025-08-04 18:58:06 --> Router Class Initialized
INFO - 2025-08-04 18:58:06 --> Output Class Initialized
INFO - 2025-08-04 18:58:06 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:06 --> Input Class Initialized
INFO - 2025-08-04 18:58:06 --> Language Class Initialized
INFO - 2025-08-04 18:58:06 --> Loader Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: url_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:06 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:06 --> Controller Class Initialized
INFO - 2025-08-04 18:58:06 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:58:06 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:58:06 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:58:06 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:58:06 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:58:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:06 --> Total execution time: 0.0172
INFO - 2025-08-04 18:58:06 --> Config Class Initialized
INFO - 2025-08-04 18:58:06 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:06 --> URI Class Initialized
INFO - 2025-08-04 18:58:06 --> Router Class Initialized
INFO - 2025-08-04 18:58:06 --> Output Class Initialized
INFO - 2025-08-04 18:58:06 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:06 --> Input Class Initialized
INFO - 2025-08-04 18:58:06 --> Language Class Initialized
INFO - 2025-08-04 18:58:06 --> Config Class Initialized
INFO - 2025-08-04 18:58:06 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:06 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:06 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:06 --> Loader Class Initialized
INFO - 2025-08-04 18:58:06 --> URI Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: url_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:06 --> Router Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:06 --> Output Class Initialized
INFO - 2025-08-04 18:58:06 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:06 --> Input Class Initialized
INFO - 2025-08-04 18:58:06 --> Language Class Initialized
INFO - 2025-08-04 18:58:06 --> Database Driver Class Initialized
INFO - 2025-08-04 18:58:06 --> Loader Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: url_helper
DEBUG - 2025-08-04 18:58:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:06 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:06 --> Controller Class Initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:06 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:06 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:06 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:06 --> Total execution time: 0.0083
INFO - 2025-08-04 18:58:06 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:58:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:06 --> Controller Class Initialized
INFO - 2025-08-04 18:58:06 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:58:06 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:06 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:06 --> Total execution time: 0.0106
INFO - 2025-08-04 18:58:35 --> Config Class Initialized
INFO - 2025-08-04 18:58:35 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:35 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:35 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:35 --> URI Class Initialized
INFO - 2025-08-04 18:58:35 --> Router Class Initialized
INFO - 2025-08-04 18:58:35 --> Output Class Initialized
INFO - 2025-08-04 18:58:35 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:35 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:35 --> Input Class Initialized
INFO - 2025-08-04 18:58:35 --> Language Class Initialized
INFO - 2025-08-04 18:58:35 --> Loader Class Initialized
INFO - 2025-08-04 18:58:35 --> Helper loaded: url_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:35 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:58:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:35 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:35 --> Controller Class Initialized
INFO - 2025-08-04 18:58:35 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:58:35 --> Model "SettingModel" initialized
INFO - 2025-08-04 18:58:35 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:35 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 18:58:35 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 18:58:35 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 18:58:35 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 18:58:35 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 18:58:35 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:35 --> Total execution time: 0.0251
INFO - 2025-08-04 18:58:35 --> Config Class Initialized
INFO - 2025-08-04 18:58:35 --> Hooks Class Initialized
DEBUG - 2025-08-04 18:58:35 --> UTF-8 Support Enabled
INFO - 2025-08-04 18:58:35 --> Utf8 Class Initialized
INFO - 2025-08-04 18:58:35 --> URI Class Initialized
INFO - 2025-08-04 18:58:35 --> Router Class Initialized
INFO - 2025-08-04 18:58:35 --> Output Class Initialized
INFO - 2025-08-04 18:58:35 --> Security Class Initialized
DEBUG - 2025-08-04 18:58:35 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 18:58:35 --> Input Class Initialized
INFO - 2025-08-04 18:58:35 --> Language Class Initialized
INFO - 2025-08-04 18:58:35 --> Loader Class Initialized
INFO - 2025-08-04 18:58:35 --> Helper loaded: url_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: form_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: auth_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: norawat_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: resep_helper
INFO - 2025-08-04 18:58:35 --> Helper loaded: assets_helper
INFO - 2025-08-04 18:58:35 --> Database Driver Class Initialized
DEBUG - 2025-08-04 18:58:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 18:58:35 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 18:58:35 --> Controller Class Initialized
INFO - 2025-08-04 18:58:35 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 18:58:35 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 18:58:35 --> Model "MenuModel" initialized
INFO - 2025-08-04 18:58:35 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 18:58:35 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 18:58:35 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 18:58:35 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 18:58:35 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 18:58:35 --> Final output sent to browser
DEBUG - 2025-08-04 18:58:35 --> Total execution time: 0.0181
INFO - 2025-08-04 19:00:39 --> Config Class Initialized
INFO - 2025-08-04 19:00:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:00:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:00:39 --> Utf8 Class Initialized
INFO - 2025-08-04 19:00:39 --> URI Class Initialized
INFO - 2025-08-04 19:00:39 --> Router Class Initialized
INFO - 2025-08-04 19:00:39 --> Output Class Initialized
INFO - 2025-08-04 19:00:39 --> Security Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:00:39 --> Input Class Initialized
INFO - 2025-08-04 19:00:39 --> Language Class Initialized
INFO - 2025-08-04 19:00:39 --> Loader Class Initialized
INFO - 2025-08-04 19:00:39 --> Helper loaded: url_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: form_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:00:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:00:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:00:39 --> Controller Class Initialized
INFO - 2025-08-04 19:00:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:00:39 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:00:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:00:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:00:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:00:39 --> Final output sent to browser
DEBUG - 2025-08-04 19:00:39 --> Total execution time: 0.0228
INFO - 2025-08-04 19:00:39 --> Config Class Initialized
INFO - 2025-08-04 19:00:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:00:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:00:39 --> Utf8 Class Initialized
INFO - 2025-08-04 19:00:39 --> URI Class Initialized
INFO - 2025-08-04 19:00:39 --> Router Class Initialized
INFO - 2025-08-04 19:00:39 --> Output Class Initialized
INFO - 2025-08-04 19:00:39 --> Security Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:00:39 --> Input Class Initialized
INFO - 2025-08-04 19:00:39 --> Language Class Initialized
INFO - 2025-08-04 19:00:39 --> Loader Class Initialized
INFO - 2025-08-04 19:00:39 --> Helper loaded: url_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: form_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:00:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:00:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:00:39 --> Controller Class Initialized
INFO - 2025-08-04 19:00:39 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:00:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:00:39 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:00:39 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:00:39 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:00:39 --> Final output sent to browser
DEBUG - 2025-08-04 19:00:39 --> Total execution time: 0.0219
INFO - 2025-08-04 19:00:39 --> Config Class Initialized
INFO - 2025-08-04 19:00:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:00:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:00:39 --> Utf8 Class Initialized
INFO - 2025-08-04 19:00:39 --> URI Class Initialized
INFO - 2025-08-04 19:00:39 --> Router Class Initialized
INFO - 2025-08-04 19:00:39 --> Output Class Initialized
INFO - 2025-08-04 19:00:39 --> Security Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:00:39 --> Input Class Initialized
INFO - 2025-08-04 19:00:39 --> Language Class Initialized
INFO - 2025-08-04 19:00:39 --> Loader Class Initialized
INFO - 2025-08-04 19:00:39 --> Helper loaded: url_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: form_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:00:39 --> Database Driver Class Initialized
INFO - 2025-08-04 19:00:39 --> Config Class Initialized
INFO - 2025-08-04 19:00:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 19:00:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:00:39 --> Utf8 Class Initialized
INFO - 2025-08-04 19:00:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:00:39 --> Controller Class Initialized
INFO - 2025-08-04 19:00:39 --> URI Class Initialized
INFO - 2025-08-04 19:00:39 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:00:39 --> Router Class Initialized
INFO - 2025-08-04 19:00:39 --> Output Class Initialized
INFO - 2025-08-04 19:00:39 --> Final output sent to browser
DEBUG - 2025-08-04 19:00:39 --> Total execution time: 0.0155
INFO - 2025-08-04 19:00:39 --> Security Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:00:39 --> Input Class Initialized
INFO - 2025-08-04 19:00:39 --> Language Class Initialized
INFO - 2025-08-04 19:00:39 --> Loader Class Initialized
INFO - 2025-08-04 19:00:39 --> Helper loaded: url_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: form_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:00:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:00:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:00:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:00:39 --> Controller Class Initialized
INFO - 2025-08-04 19:00:39 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:00:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:00:39 --> Final output sent to browser
DEBUG - 2025-08-04 19:00:39 --> Total execution time: 0.0147
INFO - 2025-08-04 19:01:00 --> Config Class Initialized
INFO - 2025-08-04 19:01:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:01:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:01:00 --> Utf8 Class Initialized
INFO - 2025-08-04 19:01:00 --> URI Class Initialized
INFO - 2025-08-04 19:01:00 --> Router Class Initialized
INFO - 2025-08-04 19:01:00 --> Output Class Initialized
INFO - 2025-08-04 19:01:00 --> Security Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:01:00 --> Input Class Initialized
INFO - 2025-08-04 19:01:00 --> Language Class Initialized
INFO - 2025-08-04 19:01:00 --> Loader Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: url_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: form_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:01:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:01:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:01:00 --> Controller Class Initialized
INFO - 2025-08-04 19:01:00 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:01:00 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:01:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:01:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:01:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:01:00 --> Final output sent to browser
DEBUG - 2025-08-04 19:01:00 --> Total execution time: 0.0311
INFO - 2025-08-04 19:01:00 --> Config Class Initialized
INFO - 2025-08-04 19:01:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:01:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:01:00 --> Utf8 Class Initialized
INFO - 2025-08-04 19:01:00 --> URI Class Initialized
INFO - 2025-08-04 19:01:00 --> Router Class Initialized
INFO - 2025-08-04 19:01:00 --> Output Class Initialized
INFO - 2025-08-04 19:01:00 --> Security Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:01:00 --> Input Class Initialized
INFO - 2025-08-04 19:01:00 --> Language Class Initialized
INFO - 2025-08-04 19:01:00 --> Loader Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: url_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: form_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:01:00 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:01:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:01:00 --> Controller Class Initialized
INFO - 2025-08-04 19:01:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:01:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:01:00 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:01:00 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:01:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:01:00 --> Final output sent to browser
DEBUG - 2025-08-04 19:01:00 --> Total execution time: 0.0204
INFO - 2025-08-04 19:01:00 --> Config Class Initialized
INFO - 2025-08-04 19:01:00 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:01:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:01:00 --> Utf8 Class Initialized
INFO - 2025-08-04 19:01:00 --> URI Class Initialized
INFO - 2025-08-04 19:01:00 --> Router Class Initialized
INFO - 2025-08-04 19:01:00 --> Output Class Initialized
INFO - 2025-08-04 19:01:00 --> Security Class Initialized
INFO - 2025-08-04 19:01:00 --> Config Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:01:00 --> Hooks Class Initialized
INFO - 2025-08-04 19:01:00 --> Input Class Initialized
INFO - 2025-08-04 19:01:00 --> Language Class Initialized
DEBUG - 2025-08-04 19:01:00 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:01:00 --> Utf8 Class Initialized
INFO - 2025-08-04 19:01:00 --> URI Class Initialized
INFO - 2025-08-04 19:01:00 --> Loader Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: url_helper
INFO - 2025-08-04 19:01:00 --> Router Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: form_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:01:00 --> Output Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:01:00 --> Security Class Initialized
DEBUG - 2025-08-04 19:01:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:01:00 --> Input Class Initialized
INFO - 2025-08-04 19:01:00 --> Language Class Initialized
INFO - 2025-08-04 19:01:00 --> Loader Class Initialized
INFO - 2025-08-04 19:01:00 --> Database Driver Class Initialized
INFO - 2025-08-04 19:01:00 --> Helper loaded: url_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: form_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:01:00 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:01:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:01:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:01:00 --> Controller Class Initialized
INFO - 2025-08-04 19:01:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:01:00 --> Database Driver Class Initialized
INFO - 2025-08-04 19:01:00 --> Final output sent to browser
DEBUG - 2025-08-04 19:01:00 --> Total execution time: 0.0089
DEBUG - 2025-08-04 19:01:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:01:00 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:01:00 --> Controller Class Initialized
INFO - 2025-08-04 19:01:00 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:01:00 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:01:00 --> Final output sent to browser
DEBUG - 2025-08-04 19:01:00 --> Total execution time: 0.0097
INFO - 2025-08-04 19:02:10 --> Config Class Initialized
INFO - 2025-08-04 19:02:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:10 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:10 --> URI Class Initialized
INFO - 2025-08-04 19:02:10 --> Router Class Initialized
INFO - 2025-08-04 19:02:10 --> Output Class Initialized
INFO - 2025-08-04 19:02:10 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:10 --> Input Class Initialized
INFO - 2025-08-04 19:02:10 --> Language Class Initialized
INFO - 2025-08-04 19:02:10 --> Loader Class Initialized
INFO - 2025-08-04 19:02:10 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:10 --> Controller Class Initialized
INFO - 2025-08-04 19:02:10 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:02:10 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:02:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:02:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:02:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:02:10 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:10 --> Total execution time: 0.0188
INFO - 2025-08-04 19:02:10 --> Config Class Initialized
INFO - 2025-08-04 19:02:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:10 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:10 --> URI Class Initialized
INFO - 2025-08-04 19:02:10 --> Router Class Initialized
INFO - 2025-08-04 19:02:10 --> Output Class Initialized
INFO - 2025-08-04 19:02:10 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:10 --> Input Class Initialized
INFO - 2025-08-04 19:02:10 --> Language Class Initialized
INFO - 2025-08-04 19:02:10 --> Loader Class Initialized
INFO - 2025-08-04 19:02:10 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:10 --> Controller Class Initialized
INFO - 2025-08-04 19:02:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:02:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:02:10 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:02:10 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:02:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:02:10 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:10 --> Total execution time: 0.0218
INFO - 2025-08-04 19:02:10 --> Config Class Initialized
INFO - 2025-08-04 19:02:10 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:10 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:10 --> Config Class Initialized
INFO - 2025-08-04 19:02:10 --> Hooks Class Initialized
INFO - 2025-08-04 19:02:10 --> URI Class Initialized
DEBUG - 2025-08-04 19:02:10 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:10 --> Router Class Initialized
INFO - 2025-08-04 19:02:10 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:10 --> URI Class Initialized
INFO - 2025-08-04 19:02:10 --> Output Class Initialized
INFO - 2025-08-04 19:02:10 --> Security Class Initialized
INFO - 2025-08-04 19:02:10 --> Router Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:10 --> Input Class Initialized
INFO - 2025-08-04 19:02:10 --> Output Class Initialized
INFO - 2025-08-04 19:02:10 --> Language Class Initialized
INFO - 2025-08-04 19:02:10 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:10 --> Input Class Initialized
INFO - 2025-08-04 19:02:10 --> Language Class Initialized
INFO - 2025-08-04 19:02:10 --> Loader Class Initialized
INFO - 2025-08-04 19:02:10 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:10 --> Loader Class Initialized
INFO - 2025-08-04 19:02:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:10 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:10 --> Database Driver Class Initialized
INFO - 2025-08-04 19:02:10 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:10 --> Controller Class Initialized
INFO - 2025-08-04 19:02:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "MenuModel" initialized
DEBUG - 2025-08-04 19:02:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:10 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:10 --> Total execution time: 0.0095
INFO - 2025-08-04 19:02:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:10 --> Controller Class Initialized
INFO - 2025-08-04 19:02:10 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:10 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:10 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:10 --> Total execution time: 0.0092
INFO - 2025-08-04 19:02:14 --> Config Class Initialized
INFO - 2025-08-04 19:02:14 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:14 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:14 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:14 --> URI Class Initialized
INFO - 2025-08-04 19:02:14 --> Router Class Initialized
INFO - 2025-08-04 19:02:14 --> Output Class Initialized
INFO - 2025-08-04 19:02:14 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:14 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:14 --> Input Class Initialized
INFO - 2025-08-04 19:02:14 --> Language Class Initialized
INFO - 2025-08-04 19:02:14 --> Loader Class Initialized
INFO - 2025-08-04 19:02:14 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:14 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:14 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:14 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:14 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:14 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:14 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:14 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:14 --> Controller Class Initialized
INFO - 2025-08-04 19:02:14 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:14 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:14 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:14 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:14 --> Total execution time: 0.0167
INFO - 2025-08-04 19:02:21 --> Config Class Initialized
INFO - 2025-08-04 19:02:21 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:21 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:21 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:21 --> URI Class Initialized
INFO - 2025-08-04 19:02:21 --> Router Class Initialized
INFO - 2025-08-04 19:02:21 --> Output Class Initialized
INFO - 2025-08-04 19:02:21 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:21 --> Input Class Initialized
INFO - 2025-08-04 19:02:21 --> Language Class Initialized
INFO - 2025-08-04 19:02:21 --> Loader Class Initialized
INFO - 2025-08-04 19:02:21 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:21 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:21 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:21 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:21 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:21 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:21 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:21 --> Controller Class Initialized
INFO - 2025-08-04 19:02:21 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:21 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:21 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:21 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:21 --> Total execution time: 0.0194
INFO - 2025-08-04 19:02:29 --> Config Class Initialized
INFO - 2025-08-04 19:02:29 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:02:29 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:02:29 --> Utf8 Class Initialized
INFO - 2025-08-04 19:02:29 --> URI Class Initialized
INFO - 2025-08-04 19:02:29 --> Router Class Initialized
INFO - 2025-08-04 19:02:29 --> Output Class Initialized
INFO - 2025-08-04 19:02:29 --> Security Class Initialized
DEBUG - 2025-08-04 19:02:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:02:29 --> Input Class Initialized
INFO - 2025-08-04 19:02:29 --> Language Class Initialized
INFO - 2025-08-04 19:02:29 --> Loader Class Initialized
INFO - 2025-08-04 19:02:29 --> Helper loaded: url_helper
INFO - 2025-08-04 19:02:29 --> Helper loaded: form_helper
INFO - 2025-08-04 19:02:29 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:02:29 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:02:29 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:02:29 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:02:29 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:02:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:02:29 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:02:29 --> Controller Class Initialized
INFO - 2025-08-04 19:02:29 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:02:29 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:02:29 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:02:29 --> Final output sent to browser
DEBUG - 2025-08-04 19:02:29 --> Total execution time: 0.0200
INFO - 2025-08-04 19:03:05 --> Config Class Initialized
INFO - 2025-08-04 19:03:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:05 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:05 --> URI Class Initialized
INFO - 2025-08-04 19:03:05 --> Router Class Initialized
INFO - 2025-08-04 19:03:05 --> Output Class Initialized
INFO - 2025-08-04 19:03:05 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:05 --> Input Class Initialized
INFO - 2025-08-04 19:03:05 --> Language Class Initialized
INFO - 2025-08-04 19:03:05 --> Loader Class Initialized
INFO - 2025-08-04 19:03:05 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:05 --> Controller Class Initialized
INFO - 2025-08-04 19:03:05 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:03:05 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:03:05 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:05 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:03:05 --> Config Class Initialized
INFO - 2025-08-04 19:03:05 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:05 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:05 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:05 --> URI Class Initialized
INFO - 2025-08-04 19:03:05 --> Router Class Initialized
INFO - 2025-08-04 19:03:05 --> Output Class Initialized
INFO - 2025-08-04 19:03:05 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:05 --> Input Class Initialized
INFO - 2025-08-04 19:03:05 --> Language Class Initialized
INFO - 2025-08-04 19:03:05 --> Loader Class Initialized
INFO - 2025-08-04 19:03:05 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:05 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:05 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:05 --> Controller Class Initialized
INFO - 2025-08-04 19:03:05 --> Model "AuthModel" initialized
INFO - 2025-08-04 19:03:05 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/auth/login.php
INFO - 2025-08-04 19:03:05 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:05 --> Total execution time: 0.0094
INFO - 2025-08-04 19:03:08 --> Config Class Initialized
INFO - 2025-08-04 19:03:08 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:08 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:08 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:08 --> URI Class Initialized
INFO - 2025-08-04 19:03:08 --> Router Class Initialized
INFO - 2025-08-04 19:03:08 --> Output Class Initialized
INFO - 2025-08-04 19:03:08 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:08 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:08 --> Input Class Initialized
INFO - 2025-08-04 19:03:08 --> Language Class Initialized
INFO - 2025-08-04 19:03:08 --> Loader Class Initialized
INFO - 2025-08-04 19:03:08 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:08 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:08 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:08 --> Controller Class Initialized
INFO - 2025-08-04 19:03:08 --> Model "AuthModel" initialized
INFO - 2025-08-04 19:03:08 --> Config Class Initialized
INFO - 2025-08-04 19:03:08 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:08 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:08 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:08 --> URI Class Initialized
INFO - 2025-08-04 19:03:08 --> Router Class Initialized
INFO - 2025-08-04 19:03:08 --> Output Class Initialized
INFO - 2025-08-04 19:03:08 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:08 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:08 --> Input Class Initialized
INFO - 2025-08-04 19:03:08 --> Language Class Initialized
INFO - 2025-08-04 19:03:08 --> Loader Class Initialized
INFO - 2025-08-04 19:03:08 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:08 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:08 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:08 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:08 --> Controller Class Initialized
INFO - 2025-08-04 19:03:08 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:08 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:03:08 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:03:08 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/admin/dashboard.php
INFO - 2025-08-04 19:03:08 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:03:08 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:08 --> Total execution time: 0.0113
INFO - 2025-08-04 19:03:11 --> Config Class Initialized
INFO - 2025-08-04 19:03:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:11 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:11 --> URI Class Initialized
INFO - 2025-08-04 19:03:11 --> Router Class Initialized
INFO - 2025-08-04 19:03:11 --> Output Class Initialized
INFO - 2025-08-04 19:03:11 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:11 --> Input Class Initialized
INFO - 2025-08-04 19:03:11 --> Language Class Initialized
INFO - 2025-08-04 19:03:11 --> Loader Class Initialized
INFO - 2025-08-04 19:03:11 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:11 --> Controller Class Initialized
INFO - 2025-08-04 19:03:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:03:11 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:03:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:11 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:03:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:03:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:03:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/dokter/dokter_ralan.php
INFO - 2025-08-04 19:03:11 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:03:11 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:11 --> Total execution time: 0.0150
INFO - 2025-08-04 19:03:11 --> Config Class Initialized
INFO - 2025-08-04 19:03:11 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:11 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:11 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:11 --> URI Class Initialized
INFO - 2025-08-04 19:03:11 --> Router Class Initialized
INFO - 2025-08-04 19:03:11 --> Output Class Initialized
INFO - 2025-08-04 19:03:11 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:11 --> Input Class Initialized
INFO - 2025-08-04 19:03:11 --> Language Class Initialized
INFO - 2025-08-04 19:03:11 --> Loader Class Initialized
INFO - 2025-08-04 19:03:11 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:11 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:11 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:11 --> Controller Class Initialized
INFO - 2025-08-04 19:03:11 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:03:11 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:03:11 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:11 --> Model "DokterRalanModel" initialized
DEBUG - 2025-08-04 19:03:11 --> Filter Tanggal - Start Date: 2025-08-04, End Date: 2025-08-04
DEBUG - 2025-08-04 19:03:11 --> Query SQL yang akan dijalankan: SELECT `reg_periksa`.`no_rawat`, `reg_periksa`.`no_rkm_medis`, `pasien`.`nm_pasien`, `dokter`.`nm_dokter`, `penjab`.`png_jawab`, `poliklinik`.`nm_poli`, `reg_periksa`.`tgl_registrasi`, `reg_periksa`.`status_bayar`, `reg_periksa`.`stts`
FROM `reg_periksa`
JOIN `pasien` ON `reg_periksa`.`no_rkm_medis` = `pasien`.`no_rkm_medis`
JOIN `penjab` ON `reg_periksa`.`kd_pj` = `penjab`.`kd_pj`
JOIN `poliklinik` ON `reg_periksa`.`kd_poli` = `poliklinik`.`kd_poli`
JOIN `dokter` ON `reg_periksa`.`kd_dokter` = `dokter`.`kd_dokter`
WHERE `reg_periksa`.`status_lanjut` = 'Ralan'
AND DATE(reg_periksa.tgl_registrasi) >= '2025-08-04'
AND DATE(reg_periksa.tgl_registrasi) <= '2025-08-04'
DEBUG - 2025-08-04 19:03:11 --> Jumlah data ditemukan: 2
INFO - 2025-08-04 19:03:11 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:11 --> Total execution time: 0.0229
INFO - 2025-08-04 19:03:15 --> Config Class Initialized
INFO - 2025-08-04 19:03:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:15 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:15 --> URI Class Initialized
INFO - 2025-08-04 19:03:15 --> Router Class Initialized
INFO - 2025-08-04 19:03:15 --> Output Class Initialized
INFO - 2025-08-04 19:03:15 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:15 --> Input Class Initialized
INFO - 2025-08-04 19:03:15 --> Language Class Initialized
INFO - 2025-08-04 19:03:15 --> Loader Class Initialized
INFO - 2025-08-04 19:03:15 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:15 --> Controller Class Initialized
INFO - 2025-08-04 19:03:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:03:15 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:03:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:03:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:03:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:03:15 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:15 --> Total execution time: 0.0264
INFO - 2025-08-04 19:03:15 --> Config Class Initialized
INFO - 2025-08-04 19:03:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:15 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:15 --> URI Class Initialized
INFO - 2025-08-04 19:03:15 --> Router Class Initialized
INFO - 2025-08-04 19:03:15 --> Output Class Initialized
INFO - 2025-08-04 19:03:15 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:15 --> Input Class Initialized
INFO - 2025-08-04 19:03:15 --> Language Class Initialized
INFO - 2025-08-04 19:03:15 --> Loader Class Initialized
INFO - 2025-08-04 19:03:15 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:15 --> Controller Class Initialized
INFO - 2025-08-04 19:03:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:03:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:03:15 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:03:15 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:03:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:03:15 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:15 --> Total execution time: 0.0253
INFO - 2025-08-04 19:03:15 --> Config Class Initialized
INFO - 2025-08-04 19:03:15 --> Config Class Initialized
INFO - 2025-08-04 19:03:15 --> Hooks Class Initialized
INFO - 2025-08-04 19:03:15 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:15 --> UTF-8 Support Enabled
DEBUG - 2025-08-04 19:03:15 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:15 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:15 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:15 --> URI Class Initialized
INFO - 2025-08-04 19:03:15 --> URI Class Initialized
INFO - 2025-08-04 19:03:15 --> Router Class Initialized
INFO - 2025-08-04 19:03:15 --> Router Class Initialized
INFO - 2025-08-04 19:03:15 --> Output Class Initialized
INFO - 2025-08-04 19:03:15 --> Output Class Initialized
INFO - 2025-08-04 19:03:15 --> Security Class Initialized
INFO - 2025-08-04 19:03:15 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:15 --> Input Class Initialized
INFO - 2025-08-04 19:03:15 --> Language Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:15 --> Input Class Initialized
INFO - 2025-08-04 19:03:15 --> Language Class Initialized
INFO - 2025-08-04 19:03:15 --> Loader Class Initialized
INFO - 2025-08-04 19:03:15 --> Loader Class Initialized
INFO - 2025-08-04 19:03:15 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:15 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:15 --> Database Driver Class Initialized
INFO - 2025-08-04 19:03:15 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 19:03:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:15 --> Controller Class Initialized
INFO - 2025-08-04 19:03:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:15 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:15 --> Total execution time: 0.0085
INFO - 2025-08-04 19:03:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:15 --> Controller Class Initialized
INFO - 2025-08-04 19:03:15 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:15 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:15 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:15 --> Total execution time: 0.0094
INFO - 2025-08-04 19:03:19 --> Config Class Initialized
INFO - 2025-08-04 19:03:19 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:19 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:19 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:19 --> URI Class Initialized
INFO - 2025-08-04 19:03:19 --> Router Class Initialized
INFO - 2025-08-04 19:03:19 --> Output Class Initialized
INFO - 2025-08-04 19:03:19 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:19 --> Input Class Initialized
INFO - 2025-08-04 19:03:19 --> Language Class Initialized
INFO - 2025-08-04 19:03:19 --> Loader Class Initialized
INFO - 2025-08-04 19:03:19 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:19 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:19 --> Controller Class Initialized
INFO - 2025-08-04 19:03:19 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:19 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:19 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:19 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:19 --> Total execution time: 0.0278
INFO - 2025-08-04 19:03:19 --> Config Class Initialized
INFO - 2025-08-04 19:03:19 --> Config Class Initialized
INFO - 2025-08-04 19:03:19 --> Hooks Class Initialized
INFO - 2025-08-04 19:03:19 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:19 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:19 --> Utf8 Class Initialized
DEBUG - 2025-08-04 19:03:19 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:19 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:19 --> URI Class Initialized
INFO - 2025-08-04 19:03:19 --> URI Class Initialized
INFO - 2025-08-04 19:03:19 --> Router Class Initialized
INFO - 2025-08-04 19:03:19 --> Router Class Initialized
INFO - 2025-08-04 19:03:19 --> Output Class Initialized
INFO - 2025-08-04 19:03:19 --> Output Class Initialized
INFO - 2025-08-04 19:03:19 --> Security Class Initialized
INFO - 2025-08-04 19:03:19 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:19 --> Input Class Initialized
INFO - 2025-08-04 19:03:19 --> Language Class Initialized
DEBUG - 2025-08-04 19:03:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:19 --> Input Class Initialized
INFO - 2025-08-04 19:03:19 --> Language Class Initialized
INFO - 2025-08-04 19:03:19 --> Loader Class Initialized
INFO - 2025-08-04 19:03:19 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:19 --> Loader Class Initialized
INFO - 2025-08-04 19:03:19 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:19 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:19 --> Database Driver Class Initialized
INFO - 2025-08-04 19:03:19 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:19 --> Controller Class Initialized
INFO - 2025-08-04 19:03:19 --> Model "AwalMedisDokterMataRalanModel" initialized
DEBUG - 2025-08-04 19:03:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:19 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:19 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:19 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:19 --> Total execution time: 0.0089
INFO - 2025-08-04 19:03:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:19 --> Controller Class Initialized
INFO - 2025-08-04 19:03:19 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:19 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:19 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:19 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:19 --> Total execution time: 0.0101
INFO - 2025-08-04 19:03:36 --> Config Class Initialized
INFO - 2025-08-04 19:03:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:36 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:36 --> URI Class Initialized
INFO - 2025-08-04 19:03:36 --> Router Class Initialized
INFO - 2025-08-04 19:03:36 --> Output Class Initialized
INFO - 2025-08-04 19:03:36 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:36 --> Input Class Initialized
INFO - 2025-08-04 19:03:36 --> Language Class Initialized
INFO - 2025-08-04 19:03:36 --> Loader Class Initialized
INFO - 2025-08-04 19:03:36 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:36 --> Controller Class Initialized
INFO - 2025-08-04 19:03:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:36 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:36 --> Total execution time: 0.0255
INFO - 2025-08-04 19:03:36 --> Config Class Initialized
INFO - 2025-08-04 19:03:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:36 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:36 --> URI Class Initialized
INFO - 2025-08-04 19:03:36 --> Router Class Initialized
INFO - 2025-08-04 19:03:36 --> Output Class Initialized
INFO - 2025-08-04 19:03:36 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:36 --> Input Class Initialized
INFO - 2025-08-04 19:03:36 --> Language Class Initialized
INFO - 2025-08-04 19:03:36 --> Loader Class Initialized
INFO - 2025-08-04 19:03:36 --> Config Class Initialized
INFO - 2025-08-04 19:03:36 --> Hooks Class Initialized
INFO - 2025-08-04 19:03:36 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: form_helper
DEBUG - 2025-08-04 19:03:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:36 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:36 --> URI Class Initialized
INFO - 2025-08-04 19:03:36 --> Router Class Initialized
INFO - 2025-08-04 19:03:36 --> Output Class Initialized
INFO - 2025-08-04 19:03:36 --> Security Class Initialized
INFO - 2025-08-04 19:03:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:36 --> Input Class Initialized
INFO - 2025-08-04 19:03:36 --> Language Class Initialized
INFO - 2025-08-04 19:03:36 --> Loader Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:36 --> Controller Class Initialized
INFO - 2025-08-04 19:03:36 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:36 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:36 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:36 --> Total execution time: 0.0127
INFO - 2025-08-04 19:03:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:36 --> Controller Class Initialized
INFO - 2025-08-04 19:03:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:36 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:36 --> Total execution time: 0.0131
INFO - 2025-08-04 19:03:41 --> Config Class Initialized
INFO - 2025-08-04 19:03:41 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:41 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:41 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:41 --> URI Class Initialized
INFO - 2025-08-04 19:03:41 --> Router Class Initialized
INFO - 2025-08-04 19:03:41 --> Output Class Initialized
INFO - 2025-08-04 19:03:41 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:41 --> Input Class Initialized
INFO - 2025-08-04 19:03:41 --> Language Class Initialized
INFO - 2025-08-04 19:03:41 --> Loader Class Initialized
INFO - 2025-08-04 19:03:41 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:41 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:41 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:41 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:41 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:41 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:41 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:41 --> Controller Class Initialized
INFO - 2025-08-04 19:03:41 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:41 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:41 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:41 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:41 --> Total execution time: 0.0215
INFO - 2025-08-04 19:03:45 --> Config Class Initialized
INFO - 2025-08-04 19:03:45 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:03:45 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:03:45 --> Utf8 Class Initialized
INFO - 2025-08-04 19:03:45 --> URI Class Initialized
INFO - 2025-08-04 19:03:45 --> Router Class Initialized
INFO - 2025-08-04 19:03:45 --> Output Class Initialized
INFO - 2025-08-04 19:03:45 --> Security Class Initialized
DEBUG - 2025-08-04 19:03:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:03:45 --> Input Class Initialized
INFO - 2025-08-04 19:03:45 --> Language Class Initialized
INFO - 2025-08-04 19:03:45 --> Loader Class Initialized
INFO - 2025-08-04 19:03:45 --> Helper loaded: url_helper
INFO - 2025-08-04 19:03:45 --> Helper loaded: form_helper
INFO - 2025-08-04 19:03:45 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:03:45 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:03:45 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:03:45 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:03:45 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:03:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:03:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:03:45 --> Controller Class Initialized
INFO - 2025-08-04 19:03:45 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:03:45 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:03:45 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:03:45 --> Final output sent to browser
DEBUG - 2025-08-04 19:03:45 --> Total execution time: 0.0175
INFO - 2025-08-04 19:08:07 --> Config Class Initialized
INFO - 2025-08-04 19:08:07 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:07 --> URI Class Initialized
INFO - 2025-08-04 19:08:07 --> Router Class Initialized
INFO - 2025-08-04 19:08:07 --> Output Class Initialized
INFO - 2025-08-04 19:08:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:07 --> Input Class Initialized
INFO - 2025-08-04 19:08:07 --> Language Class Initialized
INFO - 2025-08-04 19:08:07 --> Loader Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:07 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:07 --> Controller Class Initialized
INFO - 2025-08-04 19:08:07 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:08:07 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:08:07 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:08:07 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:08:07 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:08:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:07 --> Total execution time: 0.0507
INFO - 2025-08-04 19:08:07 --> Config Class Initialized
INFO - 2025-08-04 19:08:07 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:07 --> URI Class Initialized
INFO - 2025-08-04 19:08:07 --> Router Class Initialized
INFO - 2025-08-04 19:08:07 --> Output Class Initialized
INFO - 2025-08-04 19:08:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:07 --> Input Class Initialized
INFO - 2025-08-04 19:08:07 --> Language Class Initialized
INFO - 2025-08-04 19:08:07 --> Loader Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:07 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:07 --> Controller Class Initialized
INFO - 2025-08-04 19:08:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:08:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:08:07 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:08:07 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:08:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:08:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:07 --> Total execution time: 0.0230
INFO - 2025-08-04 19:08:07 --> Config Class Initialized
INFO - 2025-08-04 19:08:07 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:07 --> URI Class Initialized
INFO - 2025-08-04 19:08:07 --> Router Class Initialized
INFO - 2025-08-04 19:08:07 --> Config Class Initialized
INFO - 2025-08-04 19:08:07 --> Hooks Class Initialized
INFO - 2025-08-04 19:08:07 --> Output Class Initialized
INFO - 2025-08-04 19:08:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:07 --> Utf8 Class Initialized
DEBUG - 2025-08-04 19:08:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:07 --> Input Class Initialized
INFO - 2025-08-04 19:08:07 --> Language Class Initialized
INFO - 2025-08-04 19:08:07 --> URI Class Initialized
INFO - 2025-08-04 19:08:07 --> Router Class Initialized
INFO - 2025-08-04 19:08:07 --> Loader Class Initialized
INFO - 2025-08-04 19:08:07 --> Output Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:07 --> Security Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: norawat_helper
DEBUG - 2025-08-04 19:08:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:07 --> Input Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:07 --> Language Class Initialized
INFO - 2025-08-04 19:08:07 --> Loader Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:07 --> Database Driver Class Initialized
INFO - 2025-08-04 19:08:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:07 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:08:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:07 --> Controller Class Initialized
INFO - 2025-08-04 19:08:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:07 --> Database Driver Class Initialized
INFO - 2025-08-04 19:08:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:07 --> Total execution time: 0.0148
DEBUG - 2025-08-04 19:08:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:07 --> Controller Class Initialized
INFO - 2025-08-04 19:08:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:07 --> Total execution time: 0.0129
INFO - 2025-08-04 19:08:12 --> Config Class Initialized
INFO - 2025-08-04 19:08:12 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:12 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:12 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:12 --> URI Class Initialized
INFO - 2025-08-04 19:08:12 --> Router Class Initialized
INFO - 2025-08-04 19:08:12 --> Output Class Initialized
INFO - 2025-08-04 19:08:12 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:12 --> Input Class Initialized
INFO - 2025-08-04 19:08:12 --> Language Class Initialized
INFO - 2025-08-04 19:08:12 --> Loader Class Initialized
INFO - 2025-08-04 19:08:12 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:12 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:12 --> Controller Class Initialized
INFO - 2025-08-04 19:08:12 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:12 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:12 --> Total execution time: 0.0261
INFO - 2025-08-04 19:08:12 --> Config Class Initialized
INFO - 2025-08-04 19:08:12 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:12 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:12 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:12 --> URI Class Initialized
INFO - 2025-08-04 19:08:12 --> Config Class Initialized
INFO - 2025-08-04 19:08:12 --> Hooks Class Initialized
INFO - 2025-08-04 19:08:12 --> Router Class Initialized
DEBUG - 2025-08-04 19:08:12 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:12 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:12 --> Output Class Initialized
INFO - 2025-08-04 19:08:12 --> URI Class Initialized
INFO - 2025-08-04 19:08:12 --> Security Class Initialized
INFO - 2025-08-04 19:08:12 --> Router Class Initialized
DEBUG - 2025-08-04 19:08:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:12 --> Input Class Initialized
INFO - 2025-08-04 19:08:12 --> Language Class Initialized
INFO - 2025-08-04 19:08:12 --> Output Class Initialized
INFO - 2025-08-04 19:08:12 --> Security Class Initialized
INFO - 2025-08-04 19:08:12 --> Loader Class Initialized
DEBUG - 2025-08-04 19:08:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:12 --> Input Class Initialized
INFO - 2025-08-04 19:08:12 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:12 --> Language Class Initialized
INFO - 2025-08-04 19:08:12 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:12 --> Loader Class Initialized
INFO - 2025-08-04 19:08:12 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:12 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:12 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:12 --> Controller Class Initialized
INFO - 2025-08-04 19:08:12 --> Database Driver Class Initialized
INFO - 2025-08-04 19:08:12 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:12 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:12 --> Total execution time: 0.0114
DEBUG - 2025-08-04 19:08:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:12 --> Controller Class Initialized
INFO - 2025-08-04 19:08:12 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:12 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:12 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:12 --> Total execution time: 0.0118
INFO - 2025-08-04 19:08:28 --> Config Class Initialized
INFO - 2025-08-04 19:08:28 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:28 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:28 --> URI Class Initialized
INFO - 2025-08-04 19:08:28 --> Router Class Initialized
INFO - 2025-08-04 19:08:28 --> Output Class Initialized
INFO - 2025-08-04 19:08:28 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:28 --> Input Class Initialized
INFO - 2025-08-04 19:08:28 --> Language Class Initialized
INFO - 2025-08-04 19:08:28 --> Loader Class Initialized
INFO - 2025-08-04 19:08:28 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:28 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:28 --> Controller Class Initialized
INFO - 2025-08-04 19:08:28 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:28 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:28 --> Total execution time: 0.0248
INFO - 2025-08-04 19:08:28 --> Config Class Initialized
INFO - 2025-08-04 19:08:28 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:28 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:28 --> URI Class Initialized
INFO - 2025-08-04 19:08:28 --> Router Class Initialized
INFO - 2025-08-04 19:08:28 --> Output Class Initialized
INFO - 2025-08-04 19:08:28 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:28 --> Input Class Initialized
INFO - 2025-08-04 19:08:28 --> Language Class Initialized
INFO - 2025-08-04 19:08:28 --> Loader Class Initialized
INFO - 2025-08-04 19:08:28 --> Config Class Initialized
INFO - 2025-08-04 19:08:28 --> Hooks Class Initialized
INFO - 2025-08-04 19:08:28 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: auth_helper
DEBUG - 2025-08-04 19:08:28 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:28 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:28 --> URI Class Initialized
INFO - 2025-08-04 19:08:28 --> Router Class Initialized
INFO - 2025-08-04 19:08:28 --> Output Class Initialized
INFO - 2025-08-04 19:08:28 --> Database Driver Class Initialized
INFO - 2025-08-04 19:08:28 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:28 --> Input Class Initialized
INFO - 2025-08-04 19:08:28 --> Language Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:28 --> Controller Class Initialized
INFO - 2025-08-04 19:08:28 --> Loader Class Initialized
INFO - 2025-08-04 19:08:28 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:28 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:28 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:28 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:28 --> Total execution time: 0.0120
INFO - 2025-08-04 19:08:28 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:28 --> Controller Class Initialized
INFO - 2025-08-04 19:08:28 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:28 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:28 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:28 --> Total execution time: 0.0121
INFO - 2025-08-04 19:08:30 --> Config Class Initialized
INFO - 2025-08-04 19:08:30 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:30 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:30 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:30 --> URI Class Initialized
INFO - 2025-08-04 19:08:30 --> Router Class Initialized
INFO - 2025-08-04 19:08:30 --> Output Class Initialized
INFO - 2025-08-04 19:08:30 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:30 --> Input Class Initialized
INFO - 2025-08-04 19:08:30 --> Language Class Initialized
INFO - 2025-08-04 19:08:30 --> Loader Class Initialized
INFO - 2025-08-04 19:08:30 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:30 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:30 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:30 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:30 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:30 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:30 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:30 --> Controller Class Initialized
INFO - 2025-08-04 19:08:30 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:30 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:30 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:30 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:30 --> Total execution time: 0.0216
INFO - 2025-08-04 19:08:36 --> Config Class Initialized
INFO - 2025-08-04 19:08:36 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:08:36 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:08:36 --> Utf8 Class Initialized
INFO - 2025-08-04 19:08:36 --> URI Class Initialized
INFO - 2025-08-04 19:08:36 --> Router Class Initialized
INFO - 2025-08-04 19:08:36 --> Output Class Initialized
INFO - 2025-08-04 19:08:36 --> Security Class Initialized
DEBUG - 2025-08-04 19:08:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:08:36 --> Input Class Initialized
INFO - 2025-08-04 19:08:36 --> Language Class Initialized
INFO - 2025-08-04 19:08:36 --> Loader Class Initialized
INFO - 2025-08-04 19:08:36 --> Helper loaded: url_helper
INFO - 2025-08-04 19:08:36 --> Helper loaded: form_helper
INFO - 2025-08-04 19:08:36 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:08:36 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:08:36 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:08:36 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:08:36 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:08:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:08:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:08:36 --> Controller Class Initialized
INFO - 2025-08-04 19:08:36 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:08:36 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:08:36 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:08:36 --> Final output sent to browser
DEBUG - 2025-08-04 19:08:36 --> Total execution time: 0.0190
INFO - 2025-08-04 19:12:59 --> Config Class Initialized
INFO - 2025-08-04 19:12:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:12:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:12:59 --> Utf8 Class Initialized
INFO - 2025-08-04 19:12:59 --> URI Class Initialized
INFO - 2025-08-04 19:12:59 --> Router Class Initialized
INFO - 2025-08-04 19:12:59 --> Output Class Initialized
INFO - 2025-08-04 19:12:59 --> Security Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:12:59 --> Input Class Initialized
INFO - 2025-08-04 19:12:59 --> Language Class Initialized
INFO - 2025-08-04 19:12:59 --> Loader Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: url_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: form_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:12:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:12:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:12:59 --> Controller Class Initialized
INFO - 2025-08-04 19:12:59 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:12:59 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:12:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:12:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:12:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:12:59 --> Final output sent to browser
DEBUG - 2025-08-04 19:12:59 --> Total execution time: 0.0249
INFO - 2025-08-04 19:12:59 --> Config Class Initialized
INFO - 2025-08-04 19:12:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:12:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:12:59 --> Utf8 Class Initialized
INFO - 2025-08-04 19:12:59 --> URI Class Initialized
INFO - 2025-08-04 19:12:59 --> Router Class Initialized
INFO - 2025-08-04 19:12:59 --> Output Class Initialized
INFO - 2025-08-04 19:12:59 --> Security Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:12:59 --> Input Class Initialized
INFO - 2025-08-04 19:12:59 --> Language Class Initialized
INFO - 2025-08-04 19:12:59 --> Loader Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: url_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: form_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:12:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:12:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:12:59 --> Controller Class Initialized
INFO - 2025-08-04 19:12:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:12:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:12:59 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:12:59 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:12:59 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:12:59 --> Final output sent to browser
DEBUG - 2025-08-04 19:12:59 --> Total execution time: 0.0267
INFO - 2025-08-04 19:12:59 --> Config Class Initialized
INFO - 2025-08-04 19:12:59 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:12:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:12:59 --> Utf8 Class Initialized
INFO - 2025-08-04 19:12:59 --> URI Class Initialized
INFO - 2025-08-04 19:12:59 --> Router Class Initialized
INFO - 2025-08-04 19:12:59 --> Output Class Initialized
INFO - 2025-08-04 19:12:59 --> Security Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:12:59 --> Input Class Initialized
INFO - 2025-08-04 19:12:59 --> Language Class Initialized
INFO - 2025-08-04 19:12:59 --> Config Class Initialized
INFO - 2025-08-04 19:12:59 --> Hooks Class Initialized
INFO - 2025-08-04 19:12:59 --> Loader Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: url_helper
DEBUG - 2025-08-04 19:12:59 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:12:59 --> Utf8 Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: form_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:12:59 --> URI Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:12:59 --> Router Class Initialized
INFO - 2025-08-04 19:12:59 --> Output Class Initialized
INFO - 2025-08-04 19:12:59 --> Security Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:12:59 --> Input Class Initialized
INFO - 2025-08-04 19:12:59 --> Language Class Initialized
INFO - 2025-08-04 19:12:59 --> Database Driver Class Initialized
INFO - 2025-08-04 19:12:59 --> Loader Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: url_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: form_helper
DEBUG - 2025-08-04 19:12:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:12:59 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:12:59 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:12:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:12:59 --> Controller Class Initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:12:59 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:12:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:12:59 --> Final output sent to browser
DEBUG - 2025-08-04 19:12:59 --> Total execution time: 0.0128
INFO - 2025-08-04 19:12:59 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:12:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:12:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:12:59 --> Controller Class Initialized
INFO - 2025-08-04 19:12:59 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:12:59 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:12:59 --> Final output sent to browser
DEBUG - 2025-08-04 19:12:59 --> Total execution time: 0.0150
INFO - 2025-08-04 19:13:07 --> Config Class Initialized
INFO - 2025-08-04 19:13:07 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:07 --> URI Class Initialized
INFO - 2025-08-04 19:13:07 --> Router Class Initialized
INFO - 2025-08-04 19:13:07 --> Output Class Initialized
INFO - 2025-08-04 19:13:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:07 --> Input Class Initialized
INFO - 2025-08-04 19:13:07 --> Language Class Initialized
INFO - 2025-08-04 19:13:07 --> Loader Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:07 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:07 --> Controller Class Initialized
INFO - 2025-08-04 19:13:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:07 --> Total execution time: 0.0312
INFO - 2025-08-04 19:13:07 --> Config Class Initialized
INFO - 2025-08-04 19:13:07 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:07 --> URI Class Initialized
INFO - 2025-08-04 19:13:07 --> Router Class Initialized
INFO - 2025-08-04 19:13:07 --> Output Class Initialized
INFO - 2025-08-04 19:13:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:07 --> Input Class Initialized
INFO - 2025-08-04 19:13:07 --> Language Class Initialized
INFO - 2025-08-04 19:13:07 --> Config Class Initialized
INFO - 2025-08-04 19:13:07 --> Hooks Class Initialized
INFO - 2025-08-04 19:13:07 --> Loader Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: url_helper
DEBUG - 2025-08-04 19:13:07 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:07 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:07 --> URI Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:07 --> Router Class Initialized
INFO - 2025-08-04 19:13:07 --> Output Class Initialized
INFO - 2025-08-04 19:13:07 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:07 --> Input Class Initialized
INFO - 2025-08-04 19:13:07 --> Language Class Initialized
INFO - 2025-08-04 19:13:07 --> Database Driver Class Initialized
INFO - 2025-08-04 19:13:07 --> Loader Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: url_helper
DEBUG - 2025-08-04 19:13:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:07 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:07 --> Controller Class Initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:07 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:07 --> Total execution time: 0.0133
INFO - 2025-08-04 19:13:07 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:07 --> Controller Class Initialized
INFO - 2025-08-04 19:13:07 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:07 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:07 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:07 --> Total execution time: 0.0123
INFO - 2025-08-04 19:13:25 --> Config Class Initialized
INFO - 2025-08-04 19:13:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:25 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:25 --> URI Class Initialized
INFO - 2025-08-04 19:13:25 --> Router Class Initialized
INFO - 2025-08-04 19:13:25 --> Output Class Initialized
INFO - 2025-08-04 19:13:25 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:25 --> Input Class Initialized
INFO - 2025-08-04 19:13:25 --> Language Class Initialized
INFO - 2025-08-04 19:13:25 --> Loader Class Initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:25 --> Controller Class Initialized
INFO - 2025-08-04 19:13:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:25 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:25 --> Total execution time: 0.0267
INFO - 2025-08-04 19:13:25 --> Config Class Initialized
INFO - 2025-08-04 19:13:25 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:25 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:25 --> URI Class Initialized
INFO - 2025-08-04 19:13:25 --> Router Class Initialized
INFO - 2025-08-04 19:13:25 --> Output Class Initialized
INFO - 2025-08-04 19:13:25 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:25 --> Input Class Initialized
INFO - 2025-08-04 19:13:25 --> Language Class Initialized
INFO - 2025-08-04 19:13:25 --> Config Class Initialized
INFO - 2025-08-04 19:13:25 --> Hooks Class Initialized
INFO - 2025-08-04 19:13:25 --> Loader Class Initialized
DEBUG - 2025-08-04 19:13:25 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:25 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:25 --> URI Class Initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:25 --> Router Class Initialized
INFO - 2025-08-04 19:13:25 --> Output Class Initialized
INFO - 2025-08-04 19:13:25 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:25 --> Input Class Initialized
INFO - 2025-08-04 19:13:25 --> Language Class Initialized
INFO - 2025-08-04 19:13:25 --> Database Driver Class Initialized
INFO - 2025-08-04 19:13:25 --> Loader Class Initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: url_helper
DEBUG - 2025-08-04 19:13:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:25 --> Controller Class Initialized
INFO - 2025-08-04 19:13:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:25 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:25 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:25 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:25 --> Total execution time: 0.0129
INFO - 2025-08-04 19:13:25 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:25 --> Controller Class Initialized
INFO - 2025-08-04 19:13:25 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:25 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:25 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:25 --> Total execution time: 0.0135
INFO - 2025-08-04 19:13:35 --> Config Class Initialized
INFO - 2025-08-04 19:13:35 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:35 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:35 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:35 --> URI Class Initialized
INFO - 2025-08-04 19:13:35 --> Router Class Initialized
INFO - 2025-08-04 19:13:35 --> Output Class Initialized
INFO - 2025-08-04 19:13:35 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:35 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:35 --> Input Class Initialized
INFO - 2025-08-04 19:13:35 --> Language Class Initialized
INFO - 2025-08-04 19:13:35 --> Loader Class Initialized
INFO - 2025-08-04 19:13:35 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:35 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:35 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:35 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:35 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:35 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:35 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:35 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:35 --> Controller Class Initialized
INFO - 2025-08-04 19:13:35 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:35 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:35 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:35 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:35 --> Total execution time: 0.0311
INFO - 2025-08-04 19:13:48 --> Config Class Initialized
INFO - 2025-08-04 19:13:48 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:48 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:48 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:48 --> URI Class Initialized
INFO - 2025-08-04 19:13:48 --> Router Class Initialized
INFO - 2025-08-04 19:13:48 --> Output Class Initialized
INFO - 2025-08-04 19:13:48 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:48 --> Input Class Initialized
INFO - 2025-08-04 19:13:48 --> Language Class Initialized
INFO - 2025-08-04 19:13:48 --> Loader Class Initialized
INFO - 2025-08-04 19:13:48 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:48 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:48 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:48 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:48 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:48 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:48 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:48 --> Controller Class Initialized
INFO - 2025-08-04 19:13:48 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:48 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:48 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:48 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:48 --> Total execution time: 0.0217
INFO - 2025-08-04 19:13:54 --> Config Class Initialized
INFO - 2025-08-04 19:13:54 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:54 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:54 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:54 --> URI Class Initialized
INFO - 2025-08-04 19:13:54 --> Router Class Initialized
INFO - 2025-08-04 19:13:54 --> Output Class Initialized
INFO - 2025-08-04 19:13:54 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:54 --> Input Class Initialized
INFO - 2025-08-04 19:13:54 --> Language Class Initialized
INFO - 2025-08-04 19:13:54 --> Loader Class Initialized
INFO - 2025-08-04 19:13:54 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:54 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:54 --> Controller Class Initialized
INFO - 2025-08-04 19:13:54 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:13:54 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:13:54 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:13:54 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:13:54 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:13:54 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:54 --> Total execution time: 0.0294
INFO - 2025-08-04 19:13:54 --> Config Class Initialized
INFO - 2025-08-04 19:13:54 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:54 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:54 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:54 --> URI Class Initialized
INFO - 2025-08-04 19:13:54 --> Router Class Initialized
INFO - 2025-08-04 19:13:54 --> Output Class Initialized
INFO - 2025-08-04 19:13:54 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:54 --> Input Class Initialized
INFO - 2025-08-04 19:13:54 --> Language Class Initialized
INFO - 2025-08-04 19:13:54 --> Loader Class Initialized
INFO - 2025-08-04 19:13:54 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:54 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:54 --> Controller Class Initialized
INFO - 2025-08-04 19:13:54 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:13:54 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:13:54 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:13:54 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:13:54 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:13:54 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:54 --> Total execution time: 0.0262
INFO - 2025-08-04 19:13:54 --> Config Class Initialized
INFO - 2025-08-04 19:13:54 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:54 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:54 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:54 --> URI Class Initialized
INFO - 2025-08-04 19:13:54 --> Router Class Initialized
INFO - 2025-08-04 19:13:54 --> Output Class Initialized
INFO - 2025-08-04 19:13:54 --> Security Class Initialized
INFO - 2025-08-04 19:13:54 --> Config Class Initialized
INFO - 2025-08-04 19:13:54 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:54 --> Input Class Initialized
INFO - 2025-08-04 19:13:54 --> Language Class Initialized
DEBUG - 2025-08-04 19:13:54 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:13:54 --> Utf8 Class Initialized
INFO - 2025-08-04 19:13:54 --> URI Class Initialized
INFO - 2025-08-04 19:13:54 --> Loader Class Initialized
INFO - 2025-08-04 19:13:54 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:54 --> Router Class Initialized
INFO - 2025-08-04 19:13:54 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:13:54 --> Output Class Initialized
INFO - 2025-08-04 19:13:54 --> Security Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:13:54 --> Input Class Initialized
INFO - 2025-08-04 19:13:54 --> Language Class Initialized
INFO - 2025-08-04 19:13:54 --> Database Driver Class Initialized
INFO - 2025-08-04 19:13:54 --> Loader Class Initialized
INFO - 2025-08-04 19:13:54 --> Helper loaded: url_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: form_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:13:54 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:13:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:54 --> Controller Class Initialized
INFO - 2025-08-04 19:13:54 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:54 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:54 --> Total execution time: 0.0082
INFO - 2025-08-04 19:13:54 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:13:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:13:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:13:54 --> Controller Class Initialized
INFO - 2025-08-04 19:13:54 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:13:54 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:13:54 --> Final output sent to browser
DEBUG - 2025-08-04 19:13:54 --> Total execution time: 0.0095
INFO - 2025-08-04 19:16:20 --> Config Class Initialized
INFO - 2025-08-04 19:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:20 --> URI Class Initialized
INFO - 2025-08-04 19:16:20 --> Router Class Initialized
INFO - 2025-08-04 19:16:20 --> Output Class Initialized
INFO - 2025-08-04 19:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:20 --> Input Class Initialized
INFO - 2025-08-04 19:16:20 --> Language Class Initialized
INFO - 2025-08-04 19:16:20 --> Loader Class Initialized
INFO - 2025-08-04 19:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:20 --> Controller Class Initialized
INFO - 2025-08-04 19:16:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:16:20 --> Model "SettingModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "DokterRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/header.php
INFO - 2025-08-04 19:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/menu.php
INFO - 2025-08-04 19:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/rekam_medis_dokter_form.php
INFO - 2025-08-04 19:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/templates/footer.php
INFO - 2025-08-04 19:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:20 --> Total execution time: 0.0247
INFO - 2025-08-04 19:16:20 --> Config Class Initialized
INFO - 2025-08-04 19:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:20 --> URI Class Initialized
INFO - 2025-08-04 19:16:20 --> Router Class Initialized
INFO - 2025-08-04 19:16:20 --> Output Class Initialized
INFO - 2025-08-04 19:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:20 --> Input Class Initialized
INFO - 2025-08-04 19:16:20 --> Language Class Initialized
INFO - 2025-08-04 19:16:20 --> Loader Class Initialized
INFO - 2025-08-04 19:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:20 --> Controller Class Initialized
INFO - 2025-08-04 19:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "PasienRajal_model" initialized
INFO - 2025-08-04 19:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "SoapRalanModel" initialized
DEBUG - 2025-08-04 19:16:20 --> Session no_rawat saat loadForm: 2025/08/04/000001
DEBUG - 2025-08-04 19:16:20 --> Decoded menu_url: AwalMedisDokterMataRalanController/index
INFO - 2025-08-04 19:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> File loaded: /Applications/XAMPP/xamppfiles/htdocs/rsiaandini/application/views/rekammedis/dokter/awalMedisDokterMata_view.php
INFO - 2025-08-04 19:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:20 --> Total execution time: 0.0232
INFO - 2025-08-04 19:16:20 --> Config Class Initialized
INFO - 2025-08-04 19:16:20 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:20 --> URI Class Initialized
INFO - 2025-08-04 19:16:20 --> Router Class Initialized
INFO - 2025-08-04 19:16:20 --> Output Class Initialized
INFO - 2025-08-04 19:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:20 --> Input Class Initialized
INFO - 2025-08-04 19:16:20 --> Language Class Initialized
INFO - 2025-08-04 19:16:20 --> Loader Class Initialized
INFO - 2025-08-04 19:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:20 --> Config Class Initialized
INFO - 2025-08-04 19:16:20 --> Hooks Class Initialized
INFO - 2025-08-04 19:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:16:20 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:20 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:20 --> URI Class Initialized
INFO - 2025-08-04 19:16:20 --> Router Class Initialized
INFO - 2025-08-04 19:16:20 --> Database Driver Class Initialized
INFO - 2025-08-04 19:16:20 --> Output Class Initialized
INFO - 2025-08-04 19:16:20 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:20 --> Input Class Initialized
INFO - 2025-08-04 19:16:20 --> Language Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:20 --> Controller Class Initialized
INFO - 2025-08-04 19:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> Loader Class Initialized
INFO - 2025-08-04 19:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:20 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:20 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:20 --> Total execution time: 0.0093
INFO - 2025-08-04 19:16:20 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:20 --> Controller Class Initialized
INFO - 2025-08-04 19:16:20 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:20 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:20 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:20 --> Total execution time: 0.0123
INFO - 2025-08-04 19:16:24 --> Config Class Initialized
INFO - 2025-08-04 19:16:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:24 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:24 --> URI Class Initialized
INFO - 2025-08-04 19:16:24 --> Router Class Initialized
INFO - 2025-08-04 19:16:24 --> Output Class Initialized
INFO - 2025-08-04 19:16:24 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:24 --> Input Class Initialized
INFO - 2025-08-04 19:16:24 --> Language Class Initialized
INFO - 2025-08-04 19:16:24 --> Loader Class Initialized
INFO - 2025-08-04 19:16:24 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:24 --> Controller Class Initialized
INFO - 2025-08-04 19:16:24 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:24 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:24 --> Total execution time: 0.0276
INFO - 2025-08-04 19:16:24 --> Config Class Initialized
INFO - 2025-08-04 19:16:24 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:24 --> Config Class Initialized
INFO - 2025-08-04 19:16:24 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:24 --> Hooks Class Initialized
INFO - 2025-08-04 19:16:24 --> URI Class Initialized
DEBUG - 2025-08-04 19:16:24 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:24 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:24 --> Router Class Initialized
INFO - 2025-08-04 19:16:24 --> URI Class Initialized
INFO - 2025-08-04 19:16:24 --> Output Class Initialized
INFO - 2025-08-04 19:16:24 --> Router Class Initialized
INFO - 2025-08-04 19:16:24 --> Security Class Initialized
INFO - 2025-08-04 19:16:24 --> Output Class Initialized
DEBUG - 2025-08-04 19:16:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:24 --> Input Class Initialized
INFO - 2025-08-04 19:16:24 --> Language Class Initialized
INFO - 2025-08-04 19:16:24 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:24 --> Input Class Initialized
INFO - 2025-08-04 19:16:24 --> Language Class Initialized
INFO - 2025-08-04 19:16:24 --> Loader Class Initialized
INFO - 2025-08-04 19:16:24 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:24 --> Loader Class Initialized
INFO - 2025-08-04 19:16:24 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:24 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:24 --> Database Driver Class Initialized
INFO - 2025-08-04 19:16:24 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2025-08-04 19:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:24 --> Controller Class Initialized
INFO - 2025-08-04 19:16:24 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:24 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:24 --> Total execution time: 0.0103
INFO - 2025-08-04 19:16:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:24 --> Controller Class Initialized
INFO - 2025-08-04 19:16:24 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:24 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:24 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:24 --> Total execution time: 0.0110
INFO - 2025-08-04 19:16:40 --> Config Class Initialized
INFO - 2025-08-04 19:16:40 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:40 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:40 --> URI Class Initialized
INFO - 2025-08-04 19:16:40 --> Router Class Initialized
INFO - 2025-08-04 19:16:40 --> Output Class Initialized
INFO - 2025-08-04 19:16:40 --> Security Class Initialized
DEBUG - 2025-08-04 19:16:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:40 --> Input Class Initialized
INFO - 2025-08-04 19:16:40 --> Language Class Initialized
INFO - 2025-08-04 19:16:40 --> Loader Class Initialized
INFO - 2025-08-04 19:16:40 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:16:40 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:40 --> Controller Class Initialized
INFO - 2025-08-04 19:16:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:40 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:40 --> Total execution time: 0.0303
INFO - 2025-08-04 19:16:40 --> Config Class Initialized
INFO - 2025-08-04 19:16:40 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:40 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:40 --> URI Class Initialized
INFO - 2025-08-04 19:16:40 --> Router Class Initialized
INFO - 2025-08-04 19:16:40 --> Output Class Initialized
INFO - 2025-08-04 19:16:40 --> Config Class Initialized
INFO - 2025-08-04 19:16:40 --> Security Class Initialized
INFO - 2025-08-04 19:16:40 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:16:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:40 --> Input Class Initialized
DEBUG - 2025-08-04 19:16:40 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:16:40 --> Utf8 Class Initialized
INFO - 2025-08-04 19:16:40 --> Language Class Initialized
INFO - 2025-08-04 19:16:40 --> URI Class Initialized
INFO - 2025-08-04 19:16:40 --> Loader Class Initialized
INFO - 2025-08-04 19:16:40 --> Router Class Initialized
INFO - 2025-08-04 19:16:40 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:40 --> Output Class Initialized
INFO - 2025-08-04 19:16:40 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:40 --> Security Class Initialized
INFO - 2025-08-04 19:16:40 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:16:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:16:40 --> Input Class Initialized
INFO - 2025-08-04 19:16:40 --> Language Class Initialized
INFO - 2025-08-04 19:16:40 --> Database Driver Class Initialized
INFO - 2025-08-04 19:16:40 --> Loader Class Initialized
INFO - 2025-08-04 19:16:40 --> Helper loaded: url_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: form_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:16:40 --> Helper loaded: assets_helper
DEBUG - 2025-08-04 19:16:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:40 --> Controller Class Initialized
INFO - 2025-08-04 19:16:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:40 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:40 --> Total execution time: 0.0158
INFO - 2025-08-04 19:16:40 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:16:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:16:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:16:40 --> Controller Class Initialized
INFO - 2025-08-04 19:16:40 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:16:40 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:16:40 --> Final output sent to browser
DEBUG - 2025-08-04 19:16:40 --> Total execution time: 0.0193
INFO - 2025-08-04 19:17:39 --> Config Class Initialized
INFO - 2025-08-04 19:17:39 --> Hooks Class Initialized
DEBUG - 2025-08-04 19:17:39 --> UTF-8 Support Enabled
INFO - 2025-08-04 19:17:39 --> Utf8 Class Initialized
INFO - 2025-08-04 19:17:39 --> URI Class Initialized
INFO - 2025-08-04 19:17:39 --> Router Class Initialized
INFO - 2025-08-04 19:17:39 --> Output Class Initialized
INFO - 2025-08-04 19:17:39 --> Security Class Initialized
DEBUG - 2025-08-04 19:17:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-08-04 19:17:39 --> Input Class Initialized
INFO - 2025-08-04 19:17:39 --> Language Class Initialized
INFO - 2025-08-04 19:17:39 --> Loader Class Initialized
INFO - 2025-08-04 19:17:39 --> Helper loaded: url_helper
INFO - 2025-08-04 19:17:39 --> Helper loaded: form_helper
INFO - 2025-08-04 19:17:39 --> Helper loaded: auth_helper
INFO - 2025-08-04 19:17:39 --> Helper loaded: norawat_helper
INFO - 2025-08-04 19:17:39 --> Helper loaded: resep_helper
INFO - 2025-08-04 19:17:39 --> Helper loaded: assets_helper
INFO - 2025-08-04 19:17:39 --> Database Driver Class Initialized
DEBUG - 2025-08-04 19:17:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-08-04 19:17:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-08-04 19:17:39 --> Controller Class Initialized
INFO - 2025-08-04 19:17:39 --> Model "AwalMedisDokterMataRalanModel" initialized
INFO - 2025-08-04 19:17:39 --> Model "RekamMedisRalanModel" initialized
INFO - 2025-08-04 19:17:39 --> Model "MenuModel" initialized
INFO - 2025-08-04 19:17:39 --> Final output sent to browser
DEBUG - 2025-08-04 19:17:39 --> Total execution time: 0.0315

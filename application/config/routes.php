<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
$route['admin/dashboard'] = 'AdminController/index';
$route['user/dashboard'] = 'UserController/index';

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ===================== MENU & USER MGMT ===================== */
$route['rme-menu'] = 'RmeMenuController/index';
$route['rme-menu/create'] = 'RmeMenuController/create';
$route['rme-menu/edit/(:num)'] = 'RmeMenuController/edit/$1';
$route['rme-menu/delete/(:num)'] = 'RmeMenuController/delete/$1';
$route['menu-manager'] = 'MenuManager';
$route['menu-manager/save'] = 'MenuManager/save';
$route['menu-manager/update/(:num)'] = 'MenuManager/update/$1';
$route['menu-manager/delete/(:num)'] = 'MenuManager/delete/$1';

$route['user-manager'] = 'UserManager';
$route['user-manager/save'] = 'UserManager/save';
$route['user-manager/update'] = 'UserManager/update';
$route['user-manager/delete/(:num)'] = 'UserManager/delete/$1';
$route['user-manager/search_dokter'] = 'UserManager/search_dokter';
$route['user-manager/search_petugas'] = 'UserManager/search_petugas';

$route['user-access'] = 'UserAccessController';
$route['user-access/manage/(:num)'] = 'UserAccessController/manage/$1';
$route['user-access/save'] = 'UserAccessController/save';
$route['user-access/copy_access'] = 'UserAccessController/copy_access';

/* ===================== ADMIN / LAPORAN DLL (AS IS) ===================== */
$route['admin/piutangPasien'] = 'PiutangPasienController/index';
$route['admin/piutangPasien/get_data'] = 'PiutangPasienController/get_data';
$route['admin/piutangPasien/print_pdf'] = 'PiutangPasienController/print_pdf';
$route['admin/piutangPasienRanap'] = 'PiutangPasienRanapController/index';
$route['admin/piutangPasienRanap/get_data'] = 'PiutangPasienRanapController/get_data';
$route['admin/piutangPasienRanap/print_pdf'] = 'PiutangPasienRanapController/print_pdf';

$route['admin/PasienRajal'] = 'PasienRajal/index';
$route['admin/PasienRajal/get_data'] = 'PasienRajal/get_data';

$route['admin/rekammedis/getPasienData'] = 'RekamMedisRalanController/getPasienData';

/* ===================== CONTAINER RME (CANONICAL) ===================== */

/* spesifik dengan context */
$route['rekam-medis/(:num)/(:num)/(:num)/(:any)/(dokter|perawat)']
  = 'RekamMedisRalanController/rekammedisRalanForm/$1/$2/$3/$4/$5';

/* umum tanpa context */
$route['rekam-medis/(:num)/(:num)/(:num)/(:any)']
  = 'RekamMedisRalanController/rekammedisRalanForm/$1/$2/$3/$4';

/* Loader form (kanonik + legacy) */
$route['rekam-medis/load/(:any)']
  = 'RekamMedisRalanController/loadForm/$1';
$route['rekammedisRalanController/loadForm/(:any)']
  = 'RekamMedisRalanController/loadForm/$1';     // legacy
$route['RekamMedisRalanController/loadForm/(:any)']
  = 'RekamMedisRalanController/loadForm/$1';     // legacy

/* admin lama (biarkan) */
$route['admin/rekammedis/rekammedisRalanForm/(:num)/(:num)/(:num)/(:num)']
  = 'RekamMedisRalanController/rekammedisRalanForm/$1/$2/$3/$4';

/* ===================== SOAP (AS IS) ===================== */
$route['rekammedis/soap'] = 'SoapRalanController/index';
$route['soap-ralan/get-hasil'] = 'SoapRalanController/getHasil';
$route['soap-ralan/get-riwayat-norm'] = 'SoapRalanController/getRiwayatByNorm';
$route['soap-ralan/get-detail'] = 'SoapRalanController/getDetail';
$route['soap-ralan/get-last-ttv'] = 'SoapRalanController/get_last_ttv';
$route['soap-ralan/save'] = 'SoapRalanController/save';
$route['soap-ralan/update'] = 'SoapRalanController/update';
$route['soap-ralan/delete'] = 'SoapRalanController/delete';

/* ===================== DOKTER (ROOT CONTROLLER) ===================== */
// Listing (menu sidebar) & legacy alias
$route['dokter/ralan'] = 'DokterRalanController/index';
$route['dokter/ralan/form']['get'] = 'DokterRalanController/index';
$route['Dokter/DokterRalanForm'] = 'DokterRalanController/index'; // legacy
// Data listing dokter
$route['dokter/ralan/get-data']['get'] = 'DokterRalan/DokterRalanController/get_data';
// Gateway -> container context dokter
$route['dokter/ralan/rekam-medis/(:num)/(:num)/(:num)/(:any)']['get']
  = 'DokterRalanController/rekamMedis/$1/$2/$3/$4';

/* ===================== PERAWAT (SUBFOLDER) ===================== */
$route['perawat/ralan'] = 'Perawat/PerawatRalanController/index';
$route['perawat/ralan/form']['get'] = 'Perawat/PerawatRalanController/index';
$route['Perawat/PerawatRalanForm'] = 'Perawat/PerawatRalanController/index'; // legacy
// Gateway -> container context perawat
$route['perawat/ralan/rekam-medis/(:num)/(:num)/(:num)/(:any)']['get']
  = 'Perawat/PerawatRalanController/rekamMedis/$1/$2/$3/$4';

/* ===================== ASSESMEN PERAWAT (SUBFOLDER) ===================== */
$route['perawat/assesmen/mata'] = 'perawat/AssessmentPerawatController/mata';
$route['perawat/assessment/master-masalah-rencana'] = 'perawat/AssessmentPerawatController/masterMasalahRencana';
$route['perawat/assessment/get'] = 'perawat/AssessmentPerawatController/get';
$route['perawat/assessment/save'] = 'perawat/AssessmentPerawatController/save';
$route['perawat/assessment/delete'] = 'perawat/AssessmentPerawatController/delete';
$route['perawat/assesment/master-masalah-rencana'] = 'perawat/AssessmentPerawatController/masterMasalahRencana';
$route['perawat/assesment/get'] = 'perawat/AssessmentPerawatController/get';
$route['perawat/assesment/save'] = 'perawat/AssessmentPerawatController/save';
$route['perawat/assesment/delete'] = 'perawat/AssessmentPerawatController/delete';




// ===== Awal Medis Dokter Mata (Ralan) =====
$route['medis-mata/sync-session'] = 'AwalMedisDokterMataRalanController/syncSession';
$route['medis-mata'] = 'AwalMedisDokterMataRalanController/index';
$route['medis-mata/get-hasil'] = 'AwalMedisDokterMataRalanController/getHasil';
$route['medis-mata/get-detail'] = 'AwalMedisDokterMataRalanController/getDetail';
$route['medis-mata/get-riwayat-norm'] = 'AwalMedisDokterMataRalanController/getRiwayatByNorm';
$route['medis-mata/get-last'] = 'AwalMedisDokterMataRalanController/getLast';
$route['medis-mata/save'] = 'AwalMedisDokterMataRalanController/save';
$route['medis-mata/update'] = 'AwalMedisDokterMataRalanController/update';
$route['medis-mata/delete'] = 'AwalMedisDokterMataRalanController/delete';
$route['medis-mata/cetak'] = 'AwalMedisDokterMataRalanController/print_pdf';

// API perawat
$route['perawat/ralan/get-data']['get'] = 'Perawat/PerawatRalanController/get_data';
$route['perawat/ralan/save-ttv']['post'] = 'Perawat/PerawatRalanController/save_ttv';
$route['perawat/ralan/save-asesmen']['post'] = 'Perawat/PerawatRalanController/save_asesmen';
$route['perawat/ralan/save-tindakan']['post'] = 'Perawat/PerawatRalanController/save_tindakan';
$route['perawat/ralan/riwayat-by-norm']['get'] = 'Perawat/PerawatRalanController/riwayat_by_norm';
$route['perawat/ralan/last-ttv']['get'] = 'Perawat/PerawatRalanController/last_ttv';
$route['perawat/ralan/delete']['post'] = 'Perawat/PerawatRalanController/delete_item';
$route['perawat/ralan/set-no-rawat']['post'] = 'Perawat/PerawatRalanController/setNoRawatSession';

// ======================== PERAWAT – SOAP RALAN ========================
$route['perawat/soap-ralan'] = 'perawat/SoapPerawatController/index';
$route['perawat/soap-ralan/get-hasil'] = 'perawat/SoapPerawatController/getHasil';
$route['perawat/soap-ralan/get-riwayat-norm'] = 'perawat/SoapPerawatController/getRiwayatByNorm';
$route['perawat/soap-ralan/get-detail'] = 'perawat/SoapPerawatController/getDetail';
$route['perawat/soap-ralan/get-last-ttv'] = 'perawat/SoapPerawatController/get_last_ttv';
$route['perawat/soap-ralan/save'] = 'perawat/SoapPerawatController/save';
$route['perawat/soap-ralan/update'] = 'perawat/SoapPerawatController/update';
$route['perawat/soap-ralan/delete'] = 'perawat/SoapPerawatController/delete';

// ======================== PERAWAT – TINDAKAN RALAN ========================
$route['perawat/tindakan'] = 'perawat/TindakanRalanPerawatController/index';
$route['perawat/tindakan/getTindakan'] = 'perawat/TindakanRalanPerawatController/getTindakan';
$route['perawat/tindakan/saveTindakan'] = 'perawat/TindakanRalanPerawatController/saveTindakan';
$route['perawat/tindakan/getHasilTindakan'] = 'perawat/TindakanRalanPerawatController/getHasilTindakan';
$route['perawat/tindakan/deleteTindakan'] = 'perawat/TindakanRalanPerawatController/deleteTindakan';
$route['perawat/tindakan/getRiwayatTindakanByNorm'] = 'perawat/TindakanRalanPerawatController/getRiwayatTindakanByNorm';


/* ===================== TINDAKAN DOKTER (AS IS) ===================== */
$route['tindakan-ralan-dokter'] = 'TindakanRalanDokterController/index';
$route['TindakanRalanDokterController/getTindakan'] = 'TindakanRalanDokterController/getTindakan';
$route['TindakanRalanDokterController/saveTindakan'] = 'TindakanRalanDokterController/saveTindakan';
$route['TindakanRalanDokterController/getHasilTindakan'] = 'TindakanRalanDokterController/getHasilTindakan';
$route['TindakanRalanDokterController/deleteTindakan'] = 'TindakanRalanDokterController/deleteTindakan';
$route['TindakanRalanDokterController/getRiwayatTindakanByNorm'] = 'TindakanRalanDokterController/getRiwayatTindakanByNorm';

/* ===================== RESEP / RACIKAN / DIAGNOSA / RAD / LAB / RESUME (AS IS) ===================== */
$route['permintaanResepRalan'] = 'PermintaanResepRalanController/index';
$route['permintaanResepRalan/index'] = 'PermintaanResepRalanController/index';
$route['permintaanResepRalan/getObatList'] = 'PermintaanResepRalanController/getObatList';
$route['permintaanResepRalan/getHasilResep'] = 'PermintaanResepRalanController/getHasilResep';
$route['permintaanResepRalan/getRiwayatObatByNorm'] = 'PermintaanResepRalanController/getRiwayatObatByNorm';
$route['permintaanResepRalan/save'] = 'PermintaanResepRalanController/save';
$route['permintaanResepRalan/delete'] = 'PermintaanResepRalanController/delete';
$route['permintaanResepRalan/deleteAllResep'] = 'PermintaanResepRalanController/deleteAllResep';

$route['PermintaanResepRacikanRalanController/index'] = 'PermintaanResepRacikanRalanController/index';
$route['permintaanRacikanResepRalan/getObatList'] = 'PermintaanResepRacikanRalanController/getObatList';
$route['permintaanRacikanResepRalan/loadHasilRacikan'] = 'PermintaanResepRacikanRalanController/loadHasilRacikan';
$route['api/metodeRacik/simpanRacikan'] = 'permintaanResepRacikanRalanController/simpanRacikan';
$route['permintaanRacikanResepRalan/hapusObat'] = 'PermintaanResepRacikanRalanController/hapusObat';
$route['permintaanRacikanResepRalan/hapusResep'] = 'PermintaanResepRacikanRalanController/hapusResep';
$route['api/metodeRacik'] = 'permintaanResepRacikanRalanController/getMetodeRacik';
$route['api/signaObat'] = 'permintaanResepRacikanRalanController/getSignaObat';

$route['DiagnosaProsedurRalanController/index'] = 'DiagnosaProsedurRalanController/index';
$route['DiagnosaProsedurRalanController/getDiagnosa'] = 'DiagnosaProsedurRalanController/getDiagnosa';
$route['DiagnosaProsedurRalanController/saveDiagnosa'] = 'DiagnosaProsedurRalanController/saveDiagnosa';
$route['DiagnosaProsedurRalanController/getHasilDiagnosa'] = 'DiagnosaProsedurRalanController/getHasilDiagnosa';
$route['DiagnosaProsedurRalanController/deleteDiagnosa'] = 'DiagnosaProsedurRalanController/deleteDiagnosa';
$route['DiagnosaProsedurRalanController/getRiwayatDiagnosaByNorm'] = 'DiagnosaProsedurRalanController/getRiwayatDiagnosaByNorm';
$route['DiagnosaProsedurRalanController/getProsedur'] = 'DiagnosaProsedurRalanController/getProsedur';
$route['DiagnosaProsedurRalanController/saveProsedur'] = 'DiagnosaProsedurRalanController/saveProsedur';
$route['DiagnosaProsedurRalanController/getHasilProsedur'] = 'DiagnosaProsedurRalanController/getHasilProsedur';
$route['DiagnosaProsedurRalanController/deleteProsedur'] = 'DiagnosaProsedurRalanController/deleteProsedur';
$route['DiagnosaProsedurRalanController/getRiwayatProsedurByNorm'] = 'DiagnosaProsedurRalanController/getRiwayatProsedurByNorm';

$route['PermintaanRadiologiController'] = 'PermintaanRadiologiController/index';
$route['PermintaanRadiologiController/index'] = 'PermintaanRadiologiController/index';
$route['PermintaanRadiologiController/save'] = 'PermintaanRadiologiController/save';
$route['PermintaanRadiologiController/get_list_radiologi'] = 'PermintaanRadiologiController/get_list_radiologi';
$route['PermintaanRadiologiController/getRiwayatRadiologiByNorm'] = 'PermintaanRadiologiController/getRiwayatRadiologiByNorm';
$route['PermintaanRadiologiController/deleteRadiologi'] = 'PermintaanRadiologiController/deleteRadiologi';

$route['permintaan-lab-ralan'] = 'PermintaanLabRalanController/index';
$route['permintaan-lab-ralan/get-jenis'] = 'PermintaanLabRalanController/getJenisPemeriksaanLab';
$route['permintaan-lab-ralan/get-template-by-jenis/(:any)'] = 'PermintaanLabRalanController/get_template_by_jenis/$1';
$route['permintaan-lab-ralan/save'] = 'PermintaanLabRalanController/savePermintaanLab';
$route['permintaan-lab-ralan/get-hasil'] = 'PermintaanLabRalanController/getHasilPermintaanLab';
$route['permintaan-lab-ralan/delete'] = 'PermintaanLabRalanController/deletePermintaanLab';
$route['permintaan-lab-ralan/get-riwayat-grouped'] = 'PermintaanLabRalanController/getRiwayatGrouped';
$route['permintaan-lab-ralan/get-riwayat-norm/(:any)'] = 'PermintaanLabRalanController/getRiwayatByNoRm/$1';
$route['permintaan-lab-ralan/get-single-permintaan'] = 'PermintaanLabRalanController/get_single_permintaan';

$route['resume-medis-ralan'] = 'ResumeMedisRalanController/index';
$route['resume-medis-ralan/get'] = 'ResumeMedisRalanController/get';
$route['resume-medis-ralan/save'] = 'ResumeMedisRalanController/save';
$route['resume-medis-ralan/update'] = 'ResumeMedisRalanController/update';
$route['resume-medis-ralan/delete'] = 'ResumeMedisRalanController/delete';
$route['resume-medis-ralan/get-riwayat'] = 'ResumeMedisRalanController/get_riwayat';
$route['resume-medis-ralan/get-ttv-latest'] = 'ResumeMedisRalanController/get_ttv_latest';
$route['resume-medis-ralan/get-diagnosa'] = 'ResumeMedisRalanController/get_diagnosa_resume';
$route['resume-medis-ralan/get-prosedur'] = 'ResumeMedisRalanController/get_prosedur';
$route['resume-medis-ralan/get_detail_resume'] = 'ResumeMedisRalanController/get_detail_resume';
$route['resume-medis-ralan/cetak-pdf/(:any)'] = 'ResumeMedisRalanController/cetak_pdf/$1';
$route['verifikasi/resume/(:any)'] = 'VerifikasiController/resume/$1';

$route['admin/riwayatPasien'] = 'RiwayatPasienController/index';
$route['admin/riwayatPasien/list'] = 'RiwayatPasienController/list';
$route['admin/riwayatPasien/detail_summary'] = 'RiwayatPasienController/detail_summary';
$route['admin/riwayatPasien/detail_diagnosa'] = 'RiwayatPasienController/detail_diagnosa';
$route['admin/riwayatPasien/detail_prosedur'] = 'RiwayatPasienController/detail_prosedur';
$route['admin/riwayatPasien/detail_tindakan'] = 'RiwayatPasienController/detail_tindakan';
$route['admin/riwayatPasien/detail_resep'] = 'RiwayatPasienController/detail_resep';
$route['admin/riwayatPasien/detail_lab'] = 'RiwayatPasienController/detail_lab';
$route['admin/riwayatPasien/soap'] = 'RiwayatPasienController/soap';
$route['admin/riwayatPasien/rad_list'] = 'RiwayatPasienController/rad_list';
$route['admin/riwayatPasien/rad_detail'] = 'RiwayatPasienController/rad_detail';
$route['admin/riwayatPasien/rad_docs'] = 'RiwayatPasienController/rad_docs';
$route['admin/riwayatPasien/rad_doc_detail'] = 'RiwayatPasienController/rad_doc_detail';
$route['admin/riwayatPasien/berkas_list'] = 'RiwayatPasienController/berkas_list';
$route['admin/riwayatPasien/berkas_open'] = 'RiwayatPasienController/berkas_open';
$route['admin/riwayatPasien/detail_penunjang'] = 'RiwayatPasienController/detail_penunjang';
$route['admin/riwayatPasien/detail_laporan_tindakan'] = 'RiwayatPasienController/detail_laporan_tindakan';
$route['admin/riwayatPasien/operasi_list'] = 'RiwayatPasienController/operasi_list';
$route['admin/riwayatPasien/detail_asesmen_igd'] = 'RiwayatPasienController/detail_asesmen_igd';
$route['admin/riwayatPasien/detail_asesmen_penyakit_dalam'] = 'RiwayatPasienController/detail_asesmen_penyakit_dalam';
$route['admin/riwayatPasien/detail_asesmen_orthopedi'] = 'RiwayatPasienController/detail_asesmen_orthopedi';
$route['admin/riwayatPasien/detail_formulir_kfr'] = 'RiwayatPasienController/detail_formulir_kfr';
$route['admin/riwayatPasien/detail_program_rehab_medik'] = 'RiwayatPasienController/detail_program_rehab_medik';
$route['admin/riwayatPasien/info'] = 'RiwayatPasienController/info';
$route['RiwayatPasien/get_detail'] = 'RiwayatPasienController/get_detail';

/* ===================== BILLING / PIUTANG / LAPORAN (AS IS) ===================== */
$route['piutang/obatAlkesBHP'] = 'PiutangObatAlkesBHPController/index';
$route['laporan-piutang-obat/pdf'] = 'PiutangObatAlkesBHPController/laporanPenerimaanPiutangObat_pdf';
$route['laporan-piutang-obat/excel'] = 'PiutangObatAlkesBHPController/export_excel';

$route['admin/sertiSign'] = 'SertiSignController/index';
$route['admin/sertiSign/get_data'] = 'SertiSignController/get_data';

$route['admin/billRalan'] = 'BillRalanController/index';
$route['admin/billRalan/get_data'] = 'BillRalanController/get_data';
$route['admin/billRalan/print_pdf'] = 'BillRalanController/print_pdf';

$route['admin/billRanap'] = 'BillRanapController/index';
$route['admin/billRanap/get_data'] = 'BillRanapController/get_data';
$route['admin/billRanap/print_pdf'] = 'BillRanapController/print_pdf';

$route['admin/lapRajalDokter'] = 'LapRajalDokterController/index';
$route['admin/lapRajalDokter/get_data'] = 'LapRajalDokterController/get_data';
$route['admin/lapRajalDokter/print_pdf'] = 'LapRajalDokterController/print_pdf';

// ==========================
// ROUTES PENUNJANG RALAN
// ==========================
$route['dokterRalan/penunjang-ralan'] = 'DokterRalan/PenunjangRalanController/index';
$route['dokterRalan/penunjang-ralan/getByNoRawat'] = 'DokterRalan/PenunjangRalanController/getByNoRawat';
$route['dokterRalan/penunjang-ralan/save'] = 'DokterRalan/PenunjangRalanController/save';
$route['dokterRalan/penunjang-ralan/update'] = 'DokterRalan/PenunjangRalanController/update';
$route['dokterRalan/penunjang-ralan/delete'] = 'DokterRalan/PenunjangRalanController/delete';
$route['dokterRalan/penunjang-ralan/sign'] = 'DokterRalan/PenunjangRalanController/sign';
$route['dokterRalan/penunjang-ralan/print'] = 'DokterRalan/PenunjangRalanController/print';

/* ===========================================
 * LAPORAN TINDAKAN RALAN DOKTER
 * =========================================== */
$route['dokterRalan/laporan-tindakan-ralan'] = 'DokterRalan/LaporanTindakanRalanDokterController/index';
$route['dokterRalan/laporan-tindakan-ralan/getByNoRawat'] = 'DokterRalan/LaporanTindakanRalanDokterController/getByNoRawat';
$route['dokterRalan/laporan-tindakan-ralan/save'] = 'DokterRalan/LaporanTindakanRalanDokterController/save';
$route['dokterRalan/laporan-tindakan-ralan/update'] = 'DokterRalan/LaporanTindakanRalanDokterController/update';
$route['dokterRalan/laporan-tindakan-ralan/delete'] = 'DokterRalan/LaporanTindakanRalanDokterController/delete';
$route['dokterRalan/laporan-tindakan-ralan/sign'] = 'DokterRalan/LaporanTindakanRalanDokterController/sign';
$route['dokterRalan/laporan-tindakan-ralan/print'] = 'DokterRalan/LaporanTindakanRalanDokterController/print';

/* ==============================
 * SURAT SAKIT RALAN (dokterRalan)
 * ============================== */
$route['dokterRalan/surat-sakit-ralan'] = 'dokterRalan/SuratSakitRalanController/index';
$route['dokterRalan/surat-sakit-ralan/getByNoRawat'] = 'dokterRalan/SuratSakitRalanController/getByNoRawat';
$route['dokterRalan/surat-sakit-ralan/save'] = 'dokterRalan/SuratSakitRalanController/save';
$route['dokterRalan/surat-sakit-ralan/update'] = 'dokterRalan/SuratSakitRalanController/update';
$route['dokterRalan/surat-sakit-ralan/delete'] = 'dokterRalan/SuratSakitRalanController/delete';
$route['dokterRalan/surat-sakit-ralan/signDoctor'] = 'dokterRalan/SuratSakitRalanController/signDoctor';
$route['dokterRalan/surat-sakit-ralan/signPatient'] = 'dokterRalan/SuratSakitRalanController/signPatient';
$route['dokterRalan/surat-sakit-ralan/finalize'] = 'dokterRalan/SuratSakitRalanController/finalize';
$route['dokterRalan/surat-sakit-ralan/print'] = 'dokterRalan/SuratSakitRalanController/print';


/* ===========================
 * SURAT RUJUKAN KELUAR RALAN
 * =========================== */
$route['dokter-ralan/rujukanKeluar'] = 'dokterRalan/RujukanKeluarRalanController/index';
$route['dokter-ralan/rujukanKeluar/get'] = 'dokterRalan/RujukanKeluarRalanController/getByNoRawat';
$route['dokter-ralan/rujukanKeluar/save'] = 'dokterRalan/RujukanKeluarRalanController/save';
$route['dokter-ralan/rujukanKeluar/update'] = 'dokterRalan/RujukanKeluarRalanController/update';
$route['dokter-ralan/rujukanKeluar/delete'] = 'dokterRalan/RujukanKeluarRalanController/delete';
$route['dokter-ralan/rujukanKeluar/sign-dokter'] = 'dokterRalan/RujukanKeluarRalanController/sign_dokter';
$route['dokter-ralan/rujukanKeluar/sign-pasien'] = 'dokterRalan/RujukanKeluarRalanController/sign_pasien';
$route['dokter-ralan/rujukanKeluar/print'] = 'dokterRalan/RujukanKeluarRalanController/print';

/* ==========================
|  ROUTES: BERKAS DIGITAL
========================== */
$route['admin/BerkasDigitalForm'] = 'BerkasDigital/BerkasDigitalController/index'; // alias lama (optional)
$route['admin/berkas-digital/get-pasien-by-tanggal'] = 'BerkasDigital/BerkasDigitalController/getPasienByTanggal';
$route['admin/berkas-digital/get-status-matrix'] = 'BerkasDigital/BerkasDigitalController/getStatusMatrix';
$route['admin/berkas-digital/get-list'] = 'BerkasDigital/BerkasDigitalController/getListByNoRawat';
$route['admin/berkas-digital/upload'] = 'BerkasDigital/BerkasDigitalController/upload';
$route['admin/berkas-digital/download'] = 'BerkasDigital/BerkasDigitalController/download';
$route['admin/berkas-digital/download-all'] = 'BerkasDigital/BerkasDigitalController/download_all';
$route['admin/berkas-digital/delete'] = 'BerkasDigital/BerkasDigitalController/delete';






/* ===================== OPERASI (INPUT) ===================== */
$route['operasi'] = 'OperasiController/index';
$route['operasi/save'] = 'OperasiController/save';
$route['operasi/delete'] = 'OperasiController/delete';

/* ===================== SECURE TOKEN ALIASES ===================== */
// Token: 7ba61e23ad460914 -> Pendaftaran Reg Periksa
$route['access/secure/7ba61e23ad460914'] = 'Pendaftaran/RegPeriksaController/index';
$route['app/token/reg-rx-8823'] = 'Pendaftaran/RegPeriksaController/index';

// Token: ea3f7e122938104d -> Pendaftaran Pasien
$route['access/secure/ea3f7e122938104d'] = 'Pendaftaran/PasienController/index';
$route['app/token/psn-mr-9921'] = 'Pendaftaran/PasienController/index';

/* ===================== END ===================== */

$route['operasi/cari_dokter'] = 'OperasiController/cari_dokter';
$route['operasi/cari_petugas'] = 'OperasiController/cari_petugas';
$route['operasi/cari_paket'] = 'OperasiController/cari_paket';

/* ===================== BPJS BRIDGING ===================== */
// Dashboard Mapping
$route['bpjs/mapping'] = 'Bpjs/MappingController/index';
$route['bpjs/mapping/index'] = 'Bpjs/MappingController/index';

// Mapping Poli
$route['bpjs/mapping/poli'] = 'Bpjs/MappingController/poli';
$route['bpjs/mapping/search_poli_bpjs'] = 'Bpjs/MappingController/search_poli_bpjs';
$route['bpjs/mapping/save_mapping_poli'] = 'Bpjs/MappingController/save_mapping_poli';
$route['bpjs/mapping/delete_mapping_poli_ajax'] = 'Bpjs/MappingController/delete_mapping_poli_ajax';
$route['bpjs/mapping/delete_mapping_poli/(:any)'] = 'Bpjs/MappingController/delete_mapping_poli/$1';
$route['bpjs/mapping/auto_mapping_poli'] = 'Bpjs/MappingController/auto_mapping_poli';
$route['bpjs/mapping/sync_poli'] = 'Bpjs/MappingController/sync_poli';

// Mapping Dokter
$route['bpjs/mapping/dokter'] = 'Bpjs/MappingController/dokter';
$route['bpjs/mapping/get_spesialis_bpjs'] = 'Bpjs/MappingController/get_spesialis_bpjs';
$route['bpjs/mapping/search_dokter_bpjs'] = 'Bpjs/MappingController/search_dokter_bpjs';
$route['bpjs/mapping/save_mapping_dokter'] = 'Bpjs/MappingController/save_mapping_dokter';
$route['bpjs/mapping/delete_mapping_dokter_ajax'] = 'Bpjs/MappingController/delete_mapping_dokter_ajax';
$route['bpjs/mapping/search_dokter_local'] = 'Bpjs/MappingController/search_dokter_local';
$route['bpjs/mapping/get_ppk_pelayanan'] = 'Bpjs/MappingController/get_ppk_pelayanan';
$route['bpjs/sep/insert'] = 'Bpjs/SepController/insert';
$route['bpjs/sep/update'] = 'Bpjs/SepController/update';
$route['bpjs/sep/detail'] = 'Bpjs/BridgingSepController/detail';
$route['bpjs/sep/cetak'] = 'Bpjs/BridgingSepController/cetak';
$route['bpjs/sep/delete'] = 'Bpjs/BridgingSepController/delete';
$route['bpjs/sep/cari_rujukan_pcare'] = 'Bpjs/SepController/cari_rujukan_pcare';
$route['bpjs/sep/cari_rujukan_rs'] = 'Bpjs/SepController/cari_rujukan_rs';
$route['bpjs/sep/get_dpjp'] = 'Bpjs/SepController/get_dpjp';

// Mapping Diagnosa
$route['bpjs/mapping/diagnosa'] = 'Bpjs/MappingController/diagnosa';
$route['bpjs/mapping/search_diagnosa_bpjs'] = 'Bpjs/MappingController/search_diagnosa_bpjs';
$route['bpjs/mapping/save_mapping_diagnosa'] = 'Bpjs/MappingController/save_mapping_diagnosa';
$route['bpjs/mapping/delete_mapping_diagnosa_ajax'] = 'Bpjs/MappingController/delete_mapping_diagnosa_ajax';

// Mapping Faskes
$route['bpjs/mapping/faskes'] = 'Bpjs/MappingController/faskes';
$route['bpjs/mapping/search_faskes_bpjs'] = 'Bpjs/MappingController/search_faskes_bpjs';
$route['bpjs/mapping/save_mapping_faskes'] = 'Bpjs/MappingController/save_mapping_faskes';
$route['bpjs/mapping/delete_mapping_faskes_ajax'] = 'Bpjs/MappingController/delete_mapping_faskes_ajax';

// Mapping Lokasi (Propinsi, Kabupaten, Kecamatan)
$route['bpjs/mapping/lokasi'] = 'Bpjs/MappingController/lokasi';
$route['bpjs/mapping/get_propinsi'] = 'Bpjs/MappingController/get_propinsi';
$route['bpjs/mapping/get_kabupaten'] = 'Bpjs/MappingController/get_kabupaten';
$route['bpjs/mapping/get_kecamatan'] = 'Bpjs/MappingController/get_kecamatan';

// Mapping Diagnosa PRB
$route['bpjs/mapping/prb'] = 'Bpjs/MappingController/prb';
$route['bpjs/mapping/search_diagnosa_prb'] = 'Bpjs/MappingController/get_diagnosa_prb';

// Mapping Prosedur (ICD-9)
$route['bpjs/mapping/prosedur'] = 'Bpjs/MappingController/prosedur';
$route['bpjs/mapping/search_prosedur_bpjs'] = 'Bpjs/MappingController/search_prosedur_bpjs';

// Mapping Obat PRB
$route['bpjs/mapping/obat_prb'] = 'Bpjs/MappingController/obat_prb';
$route['bpjs/mapping/search_obat_prb'] = 'Bpjs/MappingController/search_obat_prb';

// Mapping Referensi Lain (Static List)
$route['bpjs/mapping/cara_keluar'] = 'Bpjs/MappingController/cara_keluar';
$route['bpjs/mapping/get_cara_keluar'] = 'Bpjs/MappingController/get_cara_keluar'; // optional if ajax needed

$route['bpjs/mapping/kelas_rawat'] = 'Bpjs/MappingController/kelas_rawat';
$route['bpjs/mapping/get_kelas_rawat'] = 'Bpjs/MappingController/get_kelas_rawat'; // optional if ajax needed

$route['bpjs/mapping/ruang_rawat'] = 'Bpjs/MappingController/ruang_rawat';
$route['bpjs/mapping/get_ruang_rawat'] = 'Bpjs/MappingController/get_ruang_rawat'; // optional if ajax needed

/* ===================== CEK PESERTA ===================== */
$route['bpjs/peserta'] = 'Bpjs/PesertaController/index';
$route['bpjs/peserta/cek'] = 'Bpjs/PesertaController/cek_peserta';

/* ===================== PENDAFTARAN PASIEN ===================== */
$route['pendaftaran/pasien'] = 'Pendaftaran/PasienController/index';
$route['pendaftaran/pasien/list'] = 'Pendaftaran/PasienController/ajax_list';
$route['pendaftaran/pasien/add'] = 'Pendaftaran/PasienController/ajax_add';
$route['pendaftaran/pasien/edit/(:any)'] = 'Pendaftaran/PasienController/ajax_edit/$1';
$route['pendaftaran/pasien/update'] = 'Pendaftaran/PasienController/ajax_update';
$route['pendaftaran/pasien/delete/(:any)'] = 'Pendaftaran/PasienController/ajax_delete/$1';
$route['pendaftaran/pasien/new_rm'] = 'Pendaftaran/PasienController/get_new_rm';
$route['pendaftaran/pasien/search_wilayah'] = 'Pendaftaran/PasienController/search_wilayah';
$route['pendaftaran/pasien/cek_bpjs_nik'] = 'Pendaftaran/PasienController/cek_bpjs_nik';
$route['pendaftaran/pasien/cek_bpjs_kartu'] = 'Pendaftaran/PasienController/cek_bpjs_kartu';

$route['pendaftaran/reg_periksa/delete'] = 'Pendaftaran/RegPeriksaController/delete';
$route['pendaftaran/reg_periksa/delete/(:any)'] = 'Pendaftaran/RegPeriksaController/delete/$1';
$route['pendaftaran/reg_periksa/update_dokter'] = 'Pendaftaran/RegPeriksaController/update_dokter';
$route['pendaftaran/reg_periksa/update_poli'] = 'Pendaftaran/RegPeriksaController/update_poli';
$route['pendaftaran/reg_periksa/update_bayar'] = 'Pendaftaran/RegPeriksaController/update_bayar';

$route['pendaftaran/reg_periksa/ajax_list'] = 'Pendaftaran/RegPeriksaController/ajax_list';
$route['pendaftaran/reg_periksa'] = 'Pendaftaran/RegPeriksaController/index';
$route['pendaftaran/reg_periksa/get_no_reg'] = 'Pendaftaran/RegPeriksaController/get_no_reg';
$route['pendaftaran/reg_periksa/get_no_rawat'] = 'Pendaftaran/RegPeriksaController/get_no_rawat';
$route['pendaftaran/reg_periksa/cetak_antrian'] = 'Pendaftaran/RegPeriksaController/cetak_antrian';
$route['pendaftaran/reg_periksa/search_dokter'] = 'Pendaftaran/RegPeriksaController/search_dokter';
$route['pendaftaran/reg_periksa/search_poli'] = 'Pendaftaran/RegPeriksaController/search_poli';
$route['pendaftaran/reg_periksa/search_pasien'] = 'Pendaftaran/RegPeriksaController/search_pasien';
$route['pendaftaran/reg_periksa/search_penjab'] = 'Pendaftaran/RegPeriksaController/search_penjab';
$route['pendaftaran/reg_periksa/save'] = 'Pendaftaran/RegPeriksaController/save';

/* ===================== END ===================== */


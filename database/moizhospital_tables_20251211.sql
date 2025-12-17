-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: sik
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `moizhospital_users`
--

DROP TABLE IF EXISTS `moizhospital_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moizhospital_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(64) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `kd_pegawai` varchar(20) DEFAULT NULL,
  `kd_dokter` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_users_kd_pegawai` (`kd_pegawai`),
  KEY `idx_users_kd_dokter` (`kd_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moizhospital_users`
--

LOCK TABLES `moizhospital_users` WRITE;
/*!40000 ALTER TABLE `moizhospital_users` DISABLE KEYS */;
INSERT INTO `moizhospital_users` VALUES (1,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','Moiz Azhar','admin@example.com',1,NULL,NULL,1,'2025-01-17 22:35:37'),(12,'D018','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','dr. Ressa, Sp.M','ressa@gmail.com',3,NULL,'D018',1,'2025-10-03 14:25:36'),(13,'D0000004','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','dr. Hilyatul Nadia','hidayatul@gmail.com',3,NULL,'D0000004',1,'2025-10-03 14:42:02'),(15,'123124','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','FREDIAN AHMAD','ferdian@gmail.com',4,'123124',NULL,1,'2025-10-03 19:13:54');
/*!40000 ALTER TABLE `moizhospital_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moizhospital_menus`
--

DROP TABLE IF EXISTS `moizhospital_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moizhospital_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `menurm` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `icon` varchar(50) DEFAULT 'fa-circle-o',
  `is_aksi_form` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moizhospital_menus`
--

LOCK TABLES `moizhospital_menus` WRITE;
/*!40000 ALTER TABLE `moizhospital_menus` DISABLE KEYS */;
INSERT INTO `moizhospital_menus` VALUES (1,'Dashboard Admin','admin/dashboard',NULL,1,NULL,'2025-01-17 22:56:54','fa-dashboard',0),(3,'Dashboard User','user/dashboard',NULL,1,NULL,'2025-01-17 22:56:54','fa-dashboard',0),(13,'Piutang Pasien Rawat Jalan','admin/piutangPasien',45,1,NULL,'2025-01-18 00:51:36','fa-medkit',0),(14,'Piutang Pasien Rawat Inap','admin/piutangPasienRanap',45,1,NULL,'2025-01-20 08:48:44','fa-medkit',0),(20,'Dokter Rawat Jalan','Dokter/Ralan',NULL,0,NULL,'2025-01-21 21:53:23','fa-user-md',0),(21,'Soap','soap_ralan',20,0,NULL,'2025-01-21 21:53:51','fa-medkit',0),(24,'Tagihan Tindakan/Perawatan','dokter/tindakanRalan',20,0,NULL,'2025-01-24 20:09:27','fa-user-md',0),(32,'Resep Umum','dokter/permintaanResepRalan',20,0,NULL,'2025-01-29 19:12:41','fa-pills',0),(33,'Resep Racikan','dokter/permintaanResepRacikanRalan',20,0,NULL,'2025-01-30 18:19:09','fa-fa-pills',0),(35,'Rincian Bill Ralan','admin/billRalan',NULL,1,'RM0001','2025-03-17 14:58:08','fa-stethoscope',0),(36,'Dokter Rawat Jalan','Dokter/DokterRalanForm',NULL,1,NULL,'2025-03-21 09:44:37',' fa-user-md',0),(37,'Piutang Obat/Alkes/BHP','piutang/obatAlkesBHP',45,1,NULL,'2025-05-16 09:27:21','fa-medkit',0),(38,'Rincian Paket Bill Ranap','admin/billRanap',NULL,1,NULL,'2025-06-04 13:11:17','fa-hospital-o',0),(39,'Laporan Pasien Rawat Jalan','admin/lapRajalDokter',NULL,1,'RM001','2025-07-10 20:24:36','fa-user-md',1),(40,'Rekap Pembayaran Ralan','admin/rekapPembayaranRalan',45,1,'RM0001','2025-07-24 16:21:07','fa-users',1),(41,'Rekap Pembayaran Ranap','admin/rekapPembayaranRanap',45,1,NULL,'2025-07-24 16:53:23','fa-users',0),(42,'Riwayat Pasien','admin/riwayatPasien',NULL,0,NULL,'2025-09-22 12:05:18','fa-stethoscope',0),(43,'Pasien Rawat Jalan','Perawat/PerawatRalanForm',NULL,1,'RM001','2025-10-03 15:01:24','fa-stethoscope',1),(44,'Berkas Digital','admin/BerkasDigitalForm',NULL,1,NULL,'2025-10-31 14:09:02','fa-stethoscope',0),(45,'Laporan Keuangan','#',NULL,1,NULL,'2025-12-09 20:35:49','fa-money',0);
/*!40000 ALTER TABLE `moizhospital_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moizhospital_rme_tab_menus`
--

DROP TABLE IF EXISTS `moizhospital_rme_tab_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moizhospital_rme_tab_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab_name` varchar(100) NOT NULL,
  `tab_url` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'dokter',
  `is_active` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moizhospital_rme_tab_menus`
--

LOCK TABLES `moizhospital_rme_tab_menus` WRITE;
/*!40000 ALTER TABLE `moizhospital_rme_tab_menus` DISABLE KEYS */;
INSERT INTO `moizhospital_rme_tab_menus` VALUES (1,'Assessmen Awal Medis Mata','AwalMedisDokterMataRalanController/index','dokter',1),(2,'SOAP','SoapRalanController/index','dokter',1),(3,'Resep Umum','PermintaanResepRalan/index','dokter',1),(4,'Resep Racikan','PermintaanResepRacikanRalanController/index','dokter',1),(5,'Diagnosa & Prosedur','DiagnosaProsedurRalanController/index','dokter',1),(6,'Resume Medis','ResumeMedisRalanController/index','dokter',1),(7,'Radiologi','PermintaanRadiologiController/index','dokter',1),(8,'Laboratorium','PermintaanLabBaruController/index','dokter',1),(9,'Penunjang','dokterRalan/PenunjangRalanController/index','dokter',1),(10,'Laporan Tindakan','dokterRalan/LaporanTindakanRalanDokterController/index','dokter',1),(11,'Operasi','OperasiController/index','dokter',1),(12,'Surat Sakit','dokterRalan/SuratSakitRalanController/index','dokter',1),(13,'Rujukan Keluar','dokterRalan/RujukanKeluarRalanController/index','dokter',1),(14,'Assessment Awal Perawat','perawat/assesmen/router','perawat',1),(15,'SOAP Perawat','perawat/SoapPerawatController/index','perawat',1),(16,'Tindakan Keperawatan','perawat/TindakanRalanPerawatController/index','perawat',1),(17,'Riwayat Pasien','RiwayatPasienController/index','umum',1),(18,'Asesmen Medis IGD','AwalMedisIGDController/index','dokter',1),(19,'Assemen Awal Penyakit Dalam','AwalMedisPenyakitDalamController/index','dokter',1),(20,'Assemen Awal Orthopedi','AwalMedisOrthopediController/index','dokter',1);
/*!40000 ALTER TABLE `moizhospital_rme_tab_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moizhospital_user_menu`
--

DROP TABLE IF EXISTS `moizhospital_user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moizhospital_user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `moizhospital_user_menu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `moizhospital_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `moizhospital_user_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `moizhospital_menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moizhospital_user_menu`
--

LOCK TABLES `moizhospital_user_menu` WRITE;
/*!40000 ALTER TABLE `moizhospital_user_menu` DISABLE KEYS */;
INSERT INTO `moizhospital_user_menu` VALUES (58,15,36,'2025-12-09 20:01:18'),(59,15,43,'2025-12-09 20:01:18'),(60,12,36,'2025-12-11 23:18:33'),(61,12,13,'2025-12-11 23:18:33'),(62,13,36,'2025-12-11 23:34:24'),(63,13,13,'2025-12-11 23:34:24');
/*!40000 ALTER TABLE `moizhospital_user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moizhospital_user_rme_access`
--

DROP TABLE IF EXISTS `moizhospital_user_rme_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moizhospital_user_rme_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rme_tab_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moizhospital_user_rme_access`
--

LOCK TABLES `moizhospital_user_rme_access` WRITE;
/*!40000 ALTER TABLE `moizhospital_user_rme_access` DISABLE KEYS */;
INSERT INTO `moizhospital_user_rme_access` VALUES (53,15,1),(54,15,2),(55,12,1),(56,12,2),(57,12,3),(58,12,5),(59,12,6),(60,12,8),(61,12,9),(62,12,10),(63,12,11),(64,12,12),(65,12,13),(66,12,17),(67,12,18),(68,13,1),(69,13,2),(70,13,3),(71,13,5),(72,13,6),(73,13,8),(74,13,9),(75,13,10),(76,13,11),(77,13,12),(78,13,13),(79,13,17),(80,13,18);
/*!40000 ALTER TABLE `moizhospital_user_rme_access` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-11 23:47:11

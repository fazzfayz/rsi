-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: rsi2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `list_items` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abouts`
--

LOCK TABLES `abouts` WRITE;
/*!40000 ALTER TABLE `abouts` DISABLE KEYS */;
INSERT INTO `abouts` VALUES (1,NULL,'About Us','PT Ruang Solusi Internusa (RSI) is an Information Technology Company. Our main focus is to provide Information Technology solutions that suit our customers\' needs.\r\n\r\nWe have assisted various companies in system development, network infrastructure, and information security','“To be a leading technology company that delivers innovative solutions”','Creating innovative digital products\r\nProviding solutions based on customer needs\r\nMaintaining system security and reliability\r\nAdapting to the latest technological developments',NULL,'2026-04-08 23:05:36','2026-04-11 02:15:53');
/*!40000 ALTER TABLE `abouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignment_letters`
--

DROP TABLE IF EXISTS `assignment_letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignment_letters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `letter_number` varchar(255) NOT NULL,
  `signer_id` bigint(20) unsigned NOT NULL,
  `assigned_to_id` bigint(20) unsigned NOT NULL,
  `assignment_description` text NOT NULL,
  `assignment_date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('draft','active','completed','cancelled') NOT NULL DEFAULT 'draft',
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assignment_letters_letter_number_unique` (`letter_number`),
  KEY `assignment_letters_signer_id_foreign` (`signer_id`),
  KEY `assignment_letters_assigned_to_id_foreign` (`assigned_to_id`),
  CONSTRAINT `assignment_letters_assigned_to_id_foreign` FOREIGN KEY (`assigned_to_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `assignment_letters_signer_id_foreign` FOREIGN KEY (`signer_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_letters`
--

LOCK TABLES `assignment_letters` WRITE;
/*!40000 ALTER TABLE `assignment_letters` DISABLE KEYS */;
INSERT INTO `assignment_letters` VALUES (1,'001/ST-RSI/01/2026',1,1,'asdasdasdasd','2026-01-23','2026-01-23','2026-01-23','asdasdasd',NULL,'active','assignment-letters/surat_tugas_001_ST-RSI_01_2026_2026-01-23_07-18-57.pdf','2026-01-23 00:18:50','2026-01-23 00:19:02'),(2,'001/ST-RSI/02/2026',1,1,'pemeliharaan komputer','2026-02-19','2026-02-19','2026-02-19','BPAFK Jakarta',NULL,'active','assignment-letters/surat_tugas_001_ST-RSI_02_2026_2026-02-19_02-01-07.pdf','2026-02-18 19:00:37','2026-02-18 19:01:07'),(4,'001/ST-RSI/04/2026',2,1,'MAINTENANCE','2026-04-07','2026-04-07','2026-04-07','BALAI PENGAMANAN ALAT DAN FASILITAS KESEHATAN JAKARTA',NULL,'completed','assignment-letters/surat_tugas_001_ST-RSI_04_2026_2026-04-07_03-50-02.pdf','2026-04-06 20:49:44','2026-04-06 20:50:03'),(5,'001/ST-RSI/07/2026',2,1,'Untuk nelakukan Pekerjaan Perawatan Komputer, Laptop, dan Server','2026-05-06','2026-06-05','2026-06-05','Balai Pengamanan Alat Fasilitas Kesehatan  Jakarta',NULL,'completed','assignment-letters/surat_tugas_001_ST-RSI_07_2026_2026-07-07_02-59-47.pdf','2026-07-06 19:59:26','2026-07-06 20:13:14'),(6,'002/ST-RSI/07/2026',2,1,'Untuk melakukan Pekerjaan Perawatan Komputer, Laptop, dan Server','2026-05-06','2026-05-06','2026-05-06','Balai Pengamanan Alat Fasilitas Kesehatan Jakarta',NULL,'completed',NULL,'2026-07-06 20:12:11','2026-07-06 20:12:11'),(7,'001/ST-RSI/08/2026',2,1,'Untuk nelakukan Pekerjaan Perawatan Komputer, Laptop, dan Server','2026-08-20','2026-08-20','2026-08-20','Balai Pengamanan  Alat dan Fasilitas Kesehatan',NULL,'completed','assignment-letters/surat_tugas_001_ST-RSI_08_2026_2026-08-20_01-14-05.pdf','2026-08-19 18:13:26','2026-08-19 18:14:38'),(8,'001/ST-RSI/09/2026',2,1,'untuk melakukan Pekerjaan Perawatan Komputer, Laptop, dan Server','2026-09-10','2026-09-10','2026-09-10','Balai Pengamanan Alat dan Fasilitas Kesehatan',NULL,'completed','assignment-letters/surat_tugas_001_ST-RSI_09_2026_2026-09-10_01-40-51.pdf','2026-09-09 18:40:40','2026-09-09 18:40:52');
/*!40000 ALTER TABLE `assignment_letters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `join_year` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'PT SKHA INDONESIA','Pak Andi','Manager','081283714855','siapjadi@gmail.com','Bintara Alam Permai Blok A No 6\r\nBAP',NULL,2026,'active','2026-01-22 01:45:49','2026-01-27 23:03:35'),(2,'PT PAYUNG TEDUH BERDUA','Bpk Galih','Manager','081283714855','siapjadi@gmail.com','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat',NULL,2026,'active','2026-01-22 21:12:16','2026-02-02 01:04:33'),(3,'PT NADA HARMONI','Pak Devy','Manager','081287494767',NULL,'Mall STC Senayan Lantai 5 Jakarta Pusat',NULL,2026,'active','2026-02-05 19:18:50','2026-02-05 19:18:50'),(4,'PT Dachin Etech Global','Ibu Piesca Kusumaningtyas','Manager',NULL,NULL,'Kawasan Industri Terpadu Indonesia China (KITIC) Kav. 49 Nagasari Serang Baru Bekasi Jawa Barat',NULL,2024,'active','2026-02-10 23:18:59','2026-02-10 23:18:59'),(5,'PT DUA TEPIAN SUNGAI','Bpk Galih','Manager','081283714855','siapjadi@gmail.com','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat',NULL,2026,'active','2026-02-18 07:27:04','2026-02-18 07:27:04'),(6,'PT BOBOBOX MITRA INDONESIA','Aryadi','-','-','ASD@COM','Jl. Dr. Djunjunan No.3, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173','-',2026,'active','2026-05-12 17:06:08','2026-05-12 17:06:08'),(7,'PT. Yuasa Battery Indonesia','Bu Sulis','Manager','083896436937','yuasabattery@mail.com','Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143',NULL,2026,'active','2026-06-01 20:01:55','2026-06-01 20:01:55'),(8,'PT Visea Kreasi Teknologi','Bhovdair','CEO','-','boy@gmail.com','Premier Estate 2 Blok L32 Jl. Raya Kodau, RT.005/RW.003, Jatiwarna, Kec. Pd. Melati, Kota Bks, Jawa Barat 17422, Indonesia (Dekat Danau), Pondok Melati, Kota Bekasi, Jawa Barat 17422','-',2026,'active','2026-07-13 01:49:05','2026-07-13 01:49:05');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_order_items`
--

DROP TABLE IF EXISTS `delivery_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_order_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'Pcs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_order_items_delivery_order_id_foreign` (`delivery_order_id`),
  CONSTRAINT `delivery_order_items_delivery_order_id_foreign` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_order_items`
--

LOCK TABLES `delivery_order_items` WRITE;
/*!40000 ALTER TABLE `delivery_order_items` DISABLE KEYS */;
INSERT INTO `delivery_order_items` VALUES (1,1,'HDD DVR Seagate WD 1TB','PO/DTS-25006339',1,'UNIT','2026-01-22 01:49:38','2026-01-22 01:49:38'),(2,1,'Adaptor POE Ruijie','PO/DTS-25006476',1,'UNIT','2026-01-22 01:49:38','2026-01-22 01:49:38'),(3,1,'Access Point Ruijie RG-AP2200','PO/DTS-25006476',1,'UNIT','2026-01-22 01:49:38','2026-01-22 01:49:38'),(4,1,'UPS Mikropack','PO/DTS-25006338',1,'UNIT','2026-01-22 01:49:38','2026-01-22 01:49:38'),(7,2,'adwadwa','2121',1,'Pcs2','2026-01-22 02:35:07','2026-01-22 02:35:07'),(8,2,'111','121',1,'Pcs13','2026-01-22 02:35:07','2026-01-22 02:35:07'),(9,2,'221','1313131',1,'Pcs21','2026-01-22 02:35:07','2026-01-22 02:35:07'),(10,3,'HDD DVR Seagate WD 1TB','PO/DTS-25006339',1,'UNIT','2026-01-22 08:48:27','2026-01-22 08:48:27'),(11,3,'Adaptor POE Ruijie','PO/DTS-25006476',1,'UNIT','2026-01-22 08:48:27','2026-01-22 08:48:27'),(12,3,'Access Point Ruijie RG-AP2200','PO/DTS-25006476',1,'UNIT','2026-01-22 08:48:27','2026-01-22 08:48:27'),(13,3,'UPS Mikropack','PO/DTS-25006338',1,'UNIT','2026-01-22 08:48:27','2026-01-22 08:48:27'),(14,4,'HDD DVR Seagate WD 1TB','PO/DTS-25006339',1,'Pcs','2026-01-22 20:40:20','2026-01-22 20:40:20'),(15,5,'HDD DVR Seagate WD 1TB','PO/DTS-25006339',1,'UNIT','2026-01-22 21:05:32','2026-01-22 21:05:32'),(16,6,'a','2121',1,'Pcs','2026-01-22 21:09:22','2026-01-22 21:09:22'),(17,7,'a',NULL,1,'Pcs','2026-01-22 21:09:37','2026-01-22 21:09:37'),(18,8,'aa',NULL,1,'Pcs','2026-01-22 21:09:51','2026-01-22 21:09:51'),(19,9,'aaaa',NULL,1,'Pcs','2026-01-22 21:10:04','2026-01-22 21:10:04'),(20,10,'a',NULL,1,'Pcs','2026-01-22 21:10:22','2026-01-22 21:10:22'),(24,12,'IP Kamera Outdoor HIK ColorVU','-',4,'UNIT','2026-01-23 03:34:59','2026-01-23 03:34:59'),(25,12,'Braket Stand Meja','-',2,'UNIT','2026-01-23 03:34:59','2026-01-23 03:34:59'),(26,12,'NVR HIKVISION 4CH','-',1,'UNIT','2026-01-23 03:34:59','2026-01-23 03:34:59'),(27,12,'HDD SEAGATE 1TB','-',1,'UNIT','2026-01-23 03:34:59','2026-01-23 03:34:59'),(28,12,'Switch POE HIK 4Port','-',1,'UNIT','2026-01-23 03:34:59','2026-01-23 03:34:59'),(39,13,'IP Kamera Outdoor HIK ColorVU','-',4,'UNIT','2026-01-30 02:25:44','2026-01-30 02:25:44'),(40,13,'Braket Stand Meja','-',2,'UNIT','2026-01-30 02:25:44','2026-01-30 02:25:44'),(41,13,'NVR HIKVISION','-',1,'UNIT','2026-01-30 02:25:44','2026-01-30 02:25:44'),(42,13,'HDD SEAGATE 1TB','-',1,'UNIT','2026-01-30 02:25:44','2026-01-30 02:25:44'),(43,13,'Switch POE HIK 4Port','-',1,'UNIT','2026-01-30 02:25:44','2026-01-30 02:25:44'),(44,11,'aa','da',1,'Pcs','2026-01-30 02:31:59','2026-01-30 02:31:59'),(45,14,'Bracket Stand Meja','-',2,'UNIT','2026-02-02 01:05:33','2026-02-02 01:05:33'),(46,15,'Bracket Stand Meja','-',2,'UNIT','2026-02-02 01:11:29','2026-02-02 01:11:29'),(50,16,'Konektor BNC Cctv','PO/DTS-26000395',300,'UNIT','2026-02-02 18:55:56','2026-02-02 18:55:56'),(51,16,'Konektor Jack power Cctv','PO/DTS-26000395',100,'UNIT','2026-02-02 18:55:56','2026-02-02 18:55:56'),(52,16,'HDD SEAGATE 1TB','PO/DTS-26000412',1,'UNIT','2026-02-02 18:55:56','2026-02-02 18:55:56'),(53,17,'Power Supply Hikvision 8 Channel','PO/PTB-26001175',1,'UNIT','2026-02-05 19:14:26','2026-02-05 19:14:26'),(54,17,'Switch D-Link DGS108GL 8 Port','PO/PTB-26001177',1,'UNIT','2026-02-05 19:14:26','2026-02-05 19:14:26'),(55,17,'Access Point RUIJIE RG-RAP 2200','PO/DTS-26000451',1,'UNIT','2026-02-05 19:14:26','2026-02-05 19:14:26'),(56,17,'Adaptor AOE RUIJIE','PO/DTS-2600451',1,'UNIT','2026-02-05 19:14:26','2026-02-05 19:14:26'),(57,18,'Kamera Ezviz indoor C6N','-',1,'UNIT','2026-02-05 19:20:40','2026-02-05 19:20:40'),(58,18,'Akses point Ruijie RG-RAP2200(E)','-',1,'UNIT','2026-02-05 19:20:40','2026-02-05 19:20:40'),(59,18,'Adaptor POE Ruijie','-',1,'UNIT','2026-02-05 19:20:40','2026-02-05 19:20:40'),(60,19,'Power Supply Hikvison','PO/PTB-26001491',1,'UNIT','2026-02-16 21:19:46','2026-02-16 21:19:46'),(61,19,'Camera Hivison Indoor','PO/PTB-26001685',1,'UNIT','2026-02-16 21:19:46','2026-02-16 21:19:46'),(73,21,'Switch D-Link 16 port DGS-1016 C','PO/DTS-26000600',1,'Unit','2026-02-18 08:15:21','2026-02-18 08:15:21'),(74,20,'Adaptor POE Ruijie','PO/PTB-26001809',1,'Unit','2026-02-18 08:16:26','2026-02-18 08:16:26'),(75,20,'AP Ruijie RG-RAP 2200','PO/PTB-26001809',1,'Unit','2026-02-18 08:16:26','2026-02-18 08:16:26'),(76,20,'Adaptor POE Ruijie','PO/PTB-26002080',1,'Unit','2026-02-18 08:16:26','2026-02-18 08:16:26'),(77,20,'AP Ruijie RG-RAP 2200','PO/PTB-26002080',1,'Unit','2026-02-18 08:16:26','2026-02-18 08:16:26'),(82,22,'Adaptor Printer Thermal','PO/PTB-26001810',1,'Unit','2026-02-22 20:28:32','2026-02-22 20:28:32'),(83,22,'Adaptor Printer Thermal','PO/PTB-26001807',2,'Unit','2026-02-22 20:28:32','2026-02-22 20:28:32'),(84,22,'Adaptor Printer Thermal','PO/DTS-26000681',1,'Unit','2026-02-22 20:28:32','2026-02-22 20:28:32'),(85,22,'Konektor RJ 45 Belden','PO/DTS-26000770',4,'Pack','2026-02-22 20:28:32','2026-02-22 20:28:32'),(91,23,'POS Galia Core i5 Gen 8','PO/PTB-26001174',1,'Unit','2026-02-25 19:59:22','2026-02-25 19:59:22'),(92,23,'POS Galia Core i5 Gen 8','PO/PTB-26001680',1,'Unit','2026-02-25 19:59:22','2026-02-25 19:59:22'),(93,23,'POS Galia Core i5 Gen 8','PO/PTB-26001806',1,'Unit','2026-02-25 19:59:22','2026-02-25 19:59:22'),(94,23,'POS Galia Core i5 Gen 8','PO/PTB-26001869',1,'Unit','2026-02-25 19:59:22','2026-02-25 19:59:22'),(95,23,'POS Galia Core i5 Gen 8','PO/DTS-26000665',1,'Unit','2026-02-25 19:59:22','2026-02-25 19:59:22'),(96,24,'KAMERA IP HIKVISION OUTDOOR','-',8,'Pcs','2026-03-11 00:13:32','2026-03-11 00:13:32'),(97,24,'SWITCH POE HIKVISION','-',1,'Pcs','2026-03-11 00:13:32','2026-03-11 00:13:32'),(98,24,'HDD WD PURPLE 10TB','-',4,'Pcs','2026-03-11 00:13:32','2026-03-11 00:13:32'),(99,24,'KABEL BELDEN CAT 6','-',2,'Box','2026-03-11 00:13:32','2026-03-11 00:13:32'),(100,25,'Kamera Hikv Outdoor','PO/PTB-26002736',6,'Pcs','2026-03-29 19:46:34','2026-03-29 19:46:34'),(101,25,'DVR Hikv 16CH','PO/PTB-26002736',1,'Pcs','2026-03-29 19:46:34','2026-03-29 19:46:34'),(102,25,'HDD Seagate 1TB','PO/PTB-26002736',1,'Pcs','2026-03-29 19:46:34','2026-03-29 19:46:34'),(103,25,'Kabel CCTV Belden RG59','PO/PTB-26002736',1,'305M','2026-03-29 19:46:34','2026-03-29 19:46:34'),(104,25,'BNC CCTV','PO/PTB-26002736',100,'Pcs','2026-03-29 19:46:34','2026-03-29 19:46:34'),(105,25,'Konektor RJ45 Belden','PO/PTB-26002736',2,'Pack','2026-03-29 19:46:34','2026-03-29 19:46:34'),(106,26,'asdasd','1',1,'PCS','2026-04-14 07:36:56','2026-04-14 07:36:56'),(107,26,'asdasd','1',1,'Pcs','2026-04-14 07:36:56','2026-04-14 07:36:56'),(111,27,'Kabel belden RJ 45',NULL,2,'Box','2026-04-24 08:48:49','2026-04-24 08:48:49'),(112,27,'Kabel CCTV Belden RG 59',NULL,5,'Box','2026-04-24 08:48:49','2026-04-24 08:48:49'),(113,27,'Connector Belden RJ 45',NULL,2,'Pck','2026-04-24 08:48:49','2026-04-24 08:48:49'),(127,28,'Kabel CCTV Belden RG59','PO/DTS-26003129',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(128,28,'Akses Point Ruijie (RG2200E)','PO/DTS-26003129',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(129,28,'Adaptor PoE Ruijie','PO/DTS-26003129',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(130,28,'Akses Point Ruijie (RG2200E)','PO/DTS-26003008',2,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(131,28,'Adaptor PoE Ruijie','PO/DTS-26003008',2,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(132,28,'Switch D-Link 8 Port','PO/DTS-26003009',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(133,28,'DVR Hikvision 16Ch','PO/DTS-26003008',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(134,28,'DVR Hikvision 16Ch','PO/PTB-26006184',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(135,28,'Kamera Hikvision Indoor','PO/DTS-26003008',7,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(136,28,'Kamera Hikvision Outdoor','PO/DTS-26003008',19,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(137,28,'Kamera Hikvision Outdoor','PO/DTS-26006184',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(138,28,'Konektor Jack Power CCTV','PO/DTS-26003008',100,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(139,28,'Konektor BNC CCTV','PO/DTS-26003008',100,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(140,28,'Kabel CCTV Belden RG59','PO/PTB-26006151',1,'Pcs','2026-04-29 18:08:06','2026-04-29 18:08:06'),(141,29,'UPS Micropack','PO/PTB-26006152',1,'Pcs','2026-05-05 23:26:59','2026-05-05 23:26:59'),(142,29,'Power Supply Hikvision','PO/DTS-26003008',2,'Pcs','2026-05-05 23:26:59','2026-05-05 23:26:59'),(143,29,'Power Supply Hikvision','PO/PTB-26006122',1,'Pcs','2026-05-05 23:26:59','2026-05-05 23:26:59'),(144,30,'HDD Seagate 1 TB','PO/DTS-26003008',1,'Pcs','2026-05-10 07:46:12','2026-05-10 07:46:12'),(145,30,'Adaptor Printer Thermal','PO/PTB-26006234',1,'Pcs','2026-05-10 07:46:12','2026-05-10 07:46:12'),(146,30,'Adaptor Printer Thermal','PO/PTB-26006152',1,'Pcs','2026-05-10 07:46:12','2026-05-10 07:46:12'),(147,31,'Mikrotik RB3011UiAS-RM RB 3011',NULL,1,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(148,31,'Ruijie RG-ES210-GS-P, Smart Switch Cloud 18 Port PoE',NULL,1,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(149,31,'Belden Modular Connector RJ45 Cat6 UTP AP700008',NULL,3,'unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(150,31,'Ruijie RG-ES220GS-P Switch Smart Cloud 18 Port Gigabit PoE',NULL,1,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(151,31,'Flexible Putih  20mm 50 Meter',NULL,2,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(152,31,'Stop Kontak Arde 5 Lubang',NULL,2,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(153,31,'Unifi u6 Pro',NULL,5,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(154,31,'Ubiquiti Swiss Army Knife Ultra',NULL,1,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(155,31,'Wallmount rack 4U 19\" Dimension 450x600x260 mm',NULL,2,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(156,31,'Ezviz C6N 720p + SD Card 128Gb',NULL,19,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(157,31,'Ezviz H8c 4MP 2K + SD Card 128 GB',NULL,4,'Unit','2026-05-12 17:15:49','2026-05-12 17:15:49'),(158,32,'POS Galia Core i5 Gen 8','PO/DTS-26003369',1,'Unit','2026-05-18 23:08:50','2026-05-18 23:08:50'),(159,32,'PSU Hikvision 8 Channel','PO/DTS-26003369',1,'Unit','2026-05-18 23:08:50','2026-05-18 23:08:50'),(160,32,'Adaptor DVR 12V','PO/DTS-26002969',1,'Unit','2026-05-18 23:08:50','2026-05-18 23:08:50'),(161,33,'Power Supply Hikvision 8 CH','PO/DTS-26003369',1,'Unit','2026-05-25 19:44:57','2026-05-25 19:44:57'),(162,33,'Kamera Hikvision Outdoor DS-2CE16D0T','PO/DTS-26003678',2,'Unit','2026-05-25 19:44:57','2026-05-25 19:44:57'),(163,33,'Power Supply Hikvision 8 Ch','PO/DTS-26003678',3,'Unit','2026-05-25 19:44:57','2026-05-25 19:44:57'),(164,33,'Adaptor PoE Ruijie','PO/DTS-26003717',1,'Unit','2026-05-25 19:44:57','2026-05-25 19:44:57'),(166,34,'Adaptor PoE Ruijie','PO/DTS-26003717',1,'Pcs','2026-05-27 18:31:35','2026-05-27 18:31:35'),(167,35,'Handheld SEUIC  CRUISE GeP-X3PC (HD) GC13/5','4600035748',7,'Unit','2026-06-01 20:06:05','2026-06-01 20:06:05'),(168,35,'Barcode Printer TSC TL241','4600035748',2,'Unit','2026-06-01 20:06:05','2026-06-01 20:06:05'),(499,36,'POS SYSTEM   (S/N: JAW20260129008)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(500,36,'POS SYSTEM (S/N: JAW20260129002)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(501,36,'POS SYSTEM (S/N: JAW20260129011)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(502,36,'POS SYSTEM (S/N: JAW20250328044)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(503,36,'BARCODE SCANNER ZEBRA DS9308  (S/N: 24281523704563)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(504,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 24281523704944)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(505,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 24205523703494)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(506,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25234523701173)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(507,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25234523700835)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(508,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25241523703969)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(509,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25234523700752)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(510,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25234523700825)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(511,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25241523703971)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(512,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 24205523703558)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(513,36,'BARCODE SCANNER ZEBRA DS9308 (S/N: 25234523701254)','4600035748',1,'unit','2026-06-22 18:08:25','2026-06-22 18:08:25'),(515,38,'POS GALIA',NULL,1,'Pcs','2026-07-12 23:43:09','2026-07-12 23:43:09'),(517,37,'POS GALIA','PO-PTB/26011258',1,'Pcs','2026-07-12 23:52:48','2026-07-12 23:52:48'),(518,39,'Scanner Zebra DS9308','-',1,'Unit','2026-07-13 01:58:54','2026-07-13 01:58:54'),(519,40,'Adaptor printer thermal','PO/PTB-26010290',2,'Pcs','2026-07-17 01:41:38','2026-07-17 01:41:38'),(520,40,'Adaptor printer thermal','PO/PTB-26009875',1,'Pcs','2026-07-17 01:41:38','2026-07-17 01:41:38'),(530,41,'AIO POS System mini PC CPU I3 RAM 8GB SSD 128GB SN=JAW20260525021',NULL,1,'Unit','2026-07-31 17:24:48','2026-07-31 17:24:48'),(531,41,'AIO POS System mini PC CPU I3 RAM 8GB SSD 128GB SN=JAW20260525032',NULL,1,'Unit','2026-07-31 17:24:48','2026-07-31 17:24:48'),(532,41,'Printer TSC-TL241 SN=TL24T26160129',NULL,1,'Unit','2026-07-31 17:24:48','2026-07-31 17:24:48'),(533,41,'Barcode Scanner ZEBRA DS9308 SN=25234523702026',NULL,1,'Unit','2026-07-31 17:24:48','2026-07-31 17:24:48'),(534,41,'Barcode Scanner ZEBRA DS9308 SN=25234523701962',NULL,1,'Unit','2026-07-31 17:24:48','2026-07-31 17:24:48'),(535,42,'Printer Epson  L355 (C462J) SN: S46K037591','-',1,'Pcs','2026-08-02 17:16:23','2026-08-02 17:16:23'),(538,43,'Printer Epson  L355 (C462J) SN: S46K037591','-',1,'Pcs','2026-08-02 17:17:31','2026-08-02 17:17:31');
/*!40000 ALTER TABLE `delivery_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_orders`
--

DROP TABLE IF EXISTS `delivery_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `do_number` varchar(255) NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `delivery_date` date NOT NULL,
  `vehicle_no` varchar(255) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `carrier_employee_id` bigint(20) unsigned DEFAULT NULL,
  `signer_employee_id` bigint(20) unsigned DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `attention_to` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_orders_do_number_unique` (`do_number`),
  KEY `delivery_orders_client_id_foreign` (`client_id`),
  KEY `delivery_orders_carrier_employee_id_foreign` (`carrier_employee_id`),
  KEY `delivery_orders_signer_employee_id_foreign` (`signer_employee_id`),
  CONSTRAINT `delivery_orders_carrier_employee_id_foreign` FOREIGN KEY (`carrier_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `delivery_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_orders_signer_employee_id_foreign` FOREIGN KEY (`signer_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_orders`
--

LOCK TABLES `delivery_orders` WRITE;
/*!40000 ALTER TABLE `delivery_orders` DISABLE KEYS */;
INSERT INTO `delivery_orders` VALUES (1,'DO/2026/001',1,'2026-01-22',NULL,NULL,1,1,NULL,'BAP','Pak Andi',NULL,'pdfs/delivery-orders/SJ-DO-2026-001.pdf','2026-01-22 01:49:38','2026-01-22 01:49:50'),(2,'DO/2026/002',1,'2026-01-22',NULL,NULL,1,1,NULL,'qqq','Pak Andi',NULL,'pdfs/delivery-orders/SJ-DO-2026-002.pdf','2026-01-22 01:54:38','2026-01-22 01:54:42'),(3,'DO/2026/003',1,'2026-01-22',NULL,NULL,1,1,NULL,'Bojongsoang','Pak Andi','OKeh','pdfs/delivery-orders/SJ-DO-2026-003.pdf','2026-01-22 08:48:27','2026-01-22 08:48:43'),(4,'DO/2026/004',1,'2026-01-23',NULL,NULL,1,1,NULL,'bojong','Pak Andi',NULL,'pdfs/delivery-orders/SJ-DO-2026-004.pdf','2026-01-22 20:40:20','2026-01-22 20:40:40'),(5,'5/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,'bojong','Pak Andi',NULL,'pdfs/delivery-orders/SJ-5-DO-RSI-I-2026.pdf','2026-01-22 21:05:32','2026-01-22 21:05:35'),(6,'6/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,NULL,'Pak Andi',NULL,NULL,'2026-01-22 21:09:22','2026-01-22 21:09:22'),(7,'7/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,NULL,'Pak Andi',NULL,NULL,'2026-01-22 21:09:37','2026-01-22 21:09:37'),(8,'8/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,NULL,'Pak Andi',NULL,NULL,'2026-01-22 21:09:51','2026-01-22 21:09:51'),(9,'9/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,NULL,'Pak Andi',NULL,NULL,'2026-01-22 21:10:04','2026-01-22 21:10:04'),(10,'10/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,NULL,'Pak Andi',NULL,NULL,'2026-01-22 21:10:22','2026-01-22 21:10:22'),(11,'11/DO-RSI/I/2026',1,'2026-01-23',NULL,NULL,1,1,NULL,'Bintara Alam Permai Blok A No 6\r\nBAP','Pak Andi',NULL,NULL,'2026-01-23 00:37:01','2026-01-23 00:37:01'),(12,'12/DO-RSI/I/2026',2,'2026-01-23',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Riyadi',NULL,'pdfs/delivery-orders/SJ-12-DO-RSI-I-2026.pdf','2026-01-23 02:52:16','2026-01-23 03:35:14'),(13,'13/DO-RSI/I/2026',2,'2026-01-26',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Riyadi',NULL,'pdfs/delivery-orders/SJ-13-DO-RSI-I-2026.pdf','2026-01-25 20:39:49','2026-01-25 20:40:00'),(14,'14/DO-RSI/II/2026',2,'2026-02-02',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,NULL,'2026-02-02 01:05:33','2026-02-02 01:05:33'),(15,'15/DO-RSI/II/2026',2,'2026-02-02',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-15-DO-RSI-II-2026.pdf','2026-02-02 01:11:29','2026-02-02 01:11:32'),(16,'16/DO-RSI/II/2026',2,'2026-02-03',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-16-DO-RSI-II-2026.pdf','2026-02-02 18:23:59','2026-02-02 18:24:14'),(17,'17/DO-RSI/II/2026',2,'2026-02-06',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-17-DO-RSI-II-2026.pdf','2026-02-05 19:14:26','2026-02-05 19:15:02'),(18,'18/DO-RSI/II/2026',3,'2026-02-06',NULL,NULL,1,1,NULL,'Mall STC Senayan Lantai 5 Jakarta Pusat','Pak Devy',NULL,'pdfs/delivery-orders/SJ-18-DO-RSI-II-2026.pdf','2026-02-05 19:20:40','2026-02-05 19:20:45'),(19,'19/DO-RSI/II/2026',2,'2026-02-17',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-19-DO-RSI-II-2026.pdf','2026-02-16 21:19:46','2026-02-16 21:19:59'),(20,'20/DO-RSI/II/2026',2,'2026-02-19',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-20-DO-RSI-II-2026.pdf','2026-02-17 20:41:15','2026-02-18 08:16:26'),(21,'21/DO-RSI/II/2026',5,'2026-02-19',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-21-DO-RSI-II-2026.pdf','2026-02-18 08:15:21','2026-02-18 08:15:25'),(22,'22/DO-RSI/II/2026',2,'2026-02-23',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-22-DO-RSI-II-2026.pdf','2026-02-22 20:28:08','2026-02-22 20:28:37'),(23,'23/DO-RSI/II/2026',2,'2026-02-25',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-23-DO-RSI-II-2026.pdf','2026-02-24 21:37:11','2026-02-24 21:37:16'),(24,'24/DO-RSI/III/2026',4,'2026-03-11',NULL,NULL,1,2,NULL,'Kawasan Industri Terpadu Indonesia China (KITIC) Kav. 49 Nagasari Serang Baru Bekasi Jawa Barat','Ibu Piesca Kusumaningtyas',NULL,'pdfs/delivery-orders/SJ-24-DO-RSI-III-2026.pdf','2026-03-11 00:13:32','2026-03-11 00:13:40'),(25,'25/DO-RSI/III/2026',5,'2026-03-30',NULL,NULL,1,2,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-25-DO-RSI-III-2026.pdf','2026-03-29 19:46:34','2026-03-29 19:46:49'),(26,'26/DO-RSI/IV/2026',1,'2026-04-14',NULL,NULL,1,2,NULL,'Bintara Alam Permai Blok A No 6\r\nBAP','Pak Andi',NULL,'pdfs/delivery-orders/SJ-26-DO-RSI-IV-2026.pdf','2026-04-14 07:36:56','2026-04-14 07:37:02'),(27,'27/DO-RSI/IV/2026',2,'2026-04-24',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-27-DO-RSI-IV-2026.pdf','2026-04-24 08:45:15','2026-04-24 08:48:49'),(28,'28/DO-RSI/IV/2026',2,'2026-04-30',NULL,NULL,1,2,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-28-DO-RSI-IV-2026.pdf','2026-04-29 18:03:57','2026-04-29 18:04:03'),(29,'29/DO-RSI/V/2026',2,'2026-05-06',NULL,NULL,1,2,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-29-DO-RSI-V-2026.pdf','2026-05-05 23:26:59','2026-05-05 23:27:24'),(30,'30/DO-RSI/V/2026',2,'2026-05-11',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-30-DO-RSI-V-2026.pdf','2026-05-10 07:46:12','2026-05-10 07:46:15'),(31,'31/DO-RSI/V/2026',6,'2026-05-13',NULL,NULL,1,1,NULL,'7XXJ+2HF, Tugu Sel., Kec. Cisarua, Kabupaten Bogor, Jawa Barat 16750','Aryadi',NULL,'pdfs/delivery-orders/SJ-31-DO-RSI-V-2026.pdf','2026-05-12 17:15:49','2026-05-12 17:15:53'),(32,'32/DO-RSI/V/2026',2,'2026-05-20',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-32-DO-RSI-V-2026.pdf','2026-05-18 23:08:50','2026-05-18 23:08:54'),(33,'33/DO-RSI/V/2026',5,'2026-05-26',NULL,NULL,3,3,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-33-DO-RSI-V-2026.pdf','2026-05-25 19:44:57','2026-05-25 19:45:00'),(34,'34/DO-RSI/V/2026',2,'2026-05-28',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-34-DO-RSI-V-2026.pdf','2026-05-27 18:30:57','2026-05-27 18:31:35'),(35,'35/DO-RSI/VI/2026',7,'2026-06-02',NULL,NULL,1,1,NULL,'Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143','Bu Sulis',NULL,'pdfs/delivery-orders/SJ-35-DO-RSI-VI-2026.pdf','2026-06-01 20:06:05','2026-06-01 20:06:13'),(36,'36/DO-RSI/VI/2026',7,'2026-06-09',NULL,NULL,1,1,NULL,'Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143','Bu Sulis',NULL,'pdfs/delivery-orders/SJ-36-DO-RSI-VI-2026.pdf','2026-06-08 18:47:55','2026-06-08 19:15:07'),(37,'37/DO-RSI/VII/2026',5,'2026-07-13',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-37-DO-RSI-VII-2026.pdf','2026-07-12 23:43:09','2026-07-12 23:52:48'),(38,'38/DO-RSI/VII/2026',5,'2026-07-13',NULL,NULL,1,2,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,NULL,'2026-07-12 23:43:09','2026-07-12 23:43:09'),(39,'39/DO-RSI/VII/2026',8,'2026-07-13',NULL,NULL,3,3,NULL,'Premier Estate 2 Blok L32 Jl. Raya Kodau, RT.005/RW.003, Jatiwarna, Kec. Pd. Melati, Kota Bks, Jawa Barat 17422, Indonesia (Dekat Danau), Pondok Melati, Kota Bekasi, Jawa Barat 17422','Bhovdair','S/N=24281523704989','pdfs/delivery-orders/SJ-39-DO-RSI-VII-2026.pdf','2026-07-13 01:58:54','2026-07-13 01:58:59'),(40,'40/DO-RSI/VII/2026',2,'2026-07-17',NULL,NULL,1,1,NULL,'Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','Bpk Galih',NULL,'pdfs/delivery-orders/SJ-40-DO-RSI-VII-2026.pdf','2026-07-17 01:41:38','2026-07-17 01:41:40'),(41,'41/DO-RSI/VIII/2026',7,'2026-08-01',NULL,NULL,3,3,NULL,'Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143','Bu Sulis',NULL,'pdfs/delivery-orders/SJ-41-DO-RSI-VIII-2026.pdf','2026-07-31 09:05:14','2026-07-31 17:24:03'),(42,'42/DO-RSI/VIII/2026',7,'2026-08-03',NULL,NULL,1,2,NULL,'Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143','Bu Sulis',NULL,NULL,'2026-08-02 17:16:23','2026-08-02 17:16:23'),(43,'43/DO-RSI/VIII/2026',7,'2026-08-03',NULL,NULL,1,1,NULL,'Jalan Mh. Thamrin no.1 Panunggangan Utara Tangerang RT.001, RT.004/RW.001, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143','Bu Sulis',NULL,'pdfs/delivery-orders/SJ-43-DO-RSI-VIII-2026.pdf','2026-08-02 17:16:26','2026-08-02 17:17:31');
/*!40000 ALTER TABLE `delivery_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `hire_date` date NOT NULL,
  `salary` decimal(12,2) NOT NULL,
  `status` enum('active','inactive','terminated') NOT NULL DEFAULT 'active',
  `photo` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'EMP20260001','Daffa Raihan','Karyawan','Operations','apaaja@gmail.com','081283714855','Bintara Alam Permai Blok A No 6\r\nBAP','2026-01-22',1000000.00,'active',NULL,NULL,'2026-01-22 01:46:20','2026-01-22 01:46:20'),(2,'EMP20260002','Nani Hadijah','Tinggi','HR','nanihadijah@gmail.com','0812345678','asd','2026-03-03',12000.00,'active',NULL,'asd','2026-03-03 01:25:33','2026-03-03 01:25:33'),(3,'EMP20260003','Boy Agus Maulana','IT Engineer','IT','rahmatserang526@gmail.com','083896436937','kp kalapa lima','2026-05-19',0.00,'active','1779171953_XquQGmeZTu.jpg',NULL,'2026-05-18 23:25:53','2026-05-18 23:25:53');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `service_needed` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (1,'Budi Santoso (Test Lead)','PT Mitra Distribusi Nusantara','budi.santoso@mitradistribusi.co.id','+62 812-9876-5432','Hardware & IT Infrastructure (Pengadaan / Sewa OPEX)','Halo tim RSI, kami membutuhkan pengadaan 20 unit server rack & implementasi jaringan untuk cabang logistik baru kami di Cikarang.',0,'2026-09-21 08:52:07','2026-09-21 08:52:07');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (3,1,'s',1222,1111.00,1357642.00,'2026-01-27 23:48:17','2026-01-27 23:48:17'),(4,2,'a',1,1.00,1.00,'2026-01-27 23:48:53','2026-01-27 23:48:53'),(5,3,'a',1,1.00,1.00,'2026-01-27 23:54:51','2026-01-27 23:54:51'),(6,4,'a',1,1.00,1.00,'2026-01-27 23:59:52','2026-01-27 23:59:52'),(7,5,'a',1,1.00,1.00,'2026-01-28 00:03:03','2026-01-28 00:03:03'),(8,6,'1',1,1.00,1.00,'2026-01-28 00:26:45','2026-01-28 00:26:45'),(9,7,'a',1,1.00,1.00,'2026-01-28 00:30:50','2026-01-28 00:30:50'),(10,8,'a',1,1.00,1.00,'2026-01-28 00:36:24','2026-01-28 00:36:24'),(11,9,'a',1,1.00,1.00,'2026-01-28 00:38:25','2026-01-28 00:38:25'),(12,10,'a',1,1.00,1.00,'2026-01-28 00:48:37','2026-01-28 00:48:37'),(13,11,'a',1,1.00,1.00,'2026-01-28 00:50:54','2026-01-28 00:50:54'),(14,12,'a',1,1.00,1.00,'2026-01-28 00:51:43','2026-01-28 00:51:43'),(15,13,'a',1,1.00,1.00,'2026-01-28 00:53:31','2026-01-28 00:53:31'),(16,14,'a',1,1.00,1.00,'2026-01-28 00:55:02','2026-01-28 00:55:02'),(17,15,'a',1,1.00,1.00,'2026-01-28 00:56:34','2026-01-28 00:56:34'),(18,16,'a',1,1.00,1.00,'2026-01-28 00:57:03','2026-01-28 00:57:03'),(19,17,'a',1,1.00,1.00,'2026-01-28 00:58:44','2026-01-28 00:58:44'),(20,18,'a',1,1.00,1.00,'2026-01-28 00:59:34','2026-01-28 00:59:34'),(21,19,'a',1,1.00,1.00,'2026-01-28 01:05:47','2026-01-28 01:05:47'),(22,20,'a',1,1.00,1.00,'2026-01-28 01:11:36','2026-01-28 01:11:36'),(23,21,'a',1,1.00,1.00,'2026-01-28 01:16:13','2026-01-28 01:16:13'),(24,22,'a',1,1.00,1.00,'2026-01-28 01:18:33','2026-01-28 01:18:33'),(25,23,'q',1,1.00,1.00,'2026-01-28 01:21:01','2026-01-28 01:21:01'),(26,24,'a',1,1.00,1.00,'2026-01-28 01:30:04','2026-01-28 01:30:04'),(27,25,'a',1,1.00,1.00,'2026-01-28 01:38:44','2026-01-28 01:38:44'),(28,26,'q',1,1.00,1.00,'2026-01-28 01:43:57','2026-01-28 01:43:57'),(29,27,'a',1,1.00,1.00,'2026-01-28 01:44:18','2026-01-28 01:44:18'),(30,28,'a',1,1.00,1.00,'2026-01-28 01:48:42','2026-01-28 01:48:42'),(31,29,'CCTV',3,1000000.00,3000000.00,'2026-01-28 01:50:20','2026-01-28 01:50:20'),(32,29,'Kopi',5,5000.00,25000.00,'2026-01-28 01:50:20','2026-01-28 01:50:20'),(33,30,'a',1,1.00,1.00,'2026-01-28 02:11:36','2026-01-28 02:11:36'),(34,31,'a',1,1.00,1.00,'2026-01-28 02:19:24','2026-01-28 02:19:24'),(35,32,'a',1,1.00,1.00,'2026-01-28 02:20:19','2026-01-28 02:20:19'),(36,33,'a',1,1.00,1.00,'2026-01-28 02:22:47','2026-01-28 02:22:47'),(37,34,'a1',1,1.00,1.00,'2026-01-28 02:25:23','2026-01-28 02:25:23'),(38,35,'a',1,1.00,1.00,'2026-01-28 02:31:18','2026-01-28 02:31:18'),(39,36,'a',1,1.00,1.00,'2026-01-28 02:39:07','2026-01-28 02:39:07'),(40,37,'a',1,1.00,1.00,'2026-01-28 02:42:01','2026-01-28 02:42:01'),(42,39,'a',1,1.00,1.00,'2026-01-28 02:51:05','2026-01-28 02:51:05'),(43,40,'a',1,1.00,1.00,'2026-01-28 02:53:28','2026-01-28 02:53:28'),(44,41,'a',1,1.00,1.00,'2026-01-28 02:54:57','2026-01-28 02:54:57'),(45,42,'a',1,1.00,1.00,'2026-01-28 02:55:26','2026-01-28 02:55:26'),(46,43,'a',1,1.00,1.00,'2026-01-28 02:55:58','2026-01-28 02:55:58'),(47,44,'a',1,1.00,1.00,'2026-01-28 02:56:34','2026-01-28 02:56:34'),(48,45,'a',1,1.00,1.00,'2026-01-28 02:57:02','2026-01-28 02:57:02'),(49,46,'a',1,1.00,1.00,'2026-01-28 02:57:25','2026-01-28 02:57:25'),(50,47,'a1',1,1.00,1.00,'2026-01-28 02:58:28','2026-01-28 02:58:28'),(51,48,'a',1,11123.00,11123.00,'2026-01-28 03:07:13','2026-01-28 03:07:13'),(52,48,'21212',1,1111.00,1111.00,'2026-01-28 03:07:13','2026-01-28 03:07:13'),(53,49,'a',1,1.00,1.00,'2026-01-28 03:08:44','2026-01-28 03:08:44'),(54,50,'a',1,1.00,1.00,'2026-01-28 03:11:46','2026-01-28 03:11:46'),(55,51,'a',1,1.00,1.00,'2026-01-28 03:15:09','2026-01-28 03:15:09'),(56,52,'adda',1,12000000.00,12000000.00,'2026-01-28 03:40:15','2026-01-28 03:40:15');
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `signer_id` bigint(20) unsigned NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `vendor_code` varchar(255) DEFAULT NULL,
  `po_ref_number` varchar(255) DEFAULT NULL,
  `attention_to` varchar(255) DEFAULT NULL,
  `attention_name` text DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ppn_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `include_ppn` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('draft','sent','paid','overdue','cancelled') NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_signer_id_foreign` (`signer_id`),
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_signer_id_foreign` FOREIGN KEY (`signer_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,'001/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27','1',NULL,'Pak Andi','Manager',1357642.00,0.00,1357642.00,0,'draft',NULL,'storage/invoices/invoice_001_INV-RSI_01_2026.pdf','2026-01-27 22:54:25','2026-01-27 23:32:42'),(2,'002/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_002_INV-RSI_01_2026.pdf','2026-01-27 23:48:53','2026-01-27 23:48:53'),(3,'003/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_003_INV-RSI_01_2026.pdf','2026-01-27 23:54:51','2026-01-27 23:54:52'),(4,'004/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_004_INV-RSI_01_2026.pdf','2026-01-27 23:59:52','2026-01-27 23:59:53'),(5,'005/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_005_INV-RSI_01_2026.pdf','2026-01-28 00:03:03','2026-01-28 00:03:03'),(6,'006/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_006_INV-RSI_01_2026.pdf','2026-01-28 00:26:45','2026-01-28 00:26:46'),(7,'007/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_007_INV-RSI_01_2026.pdf','2026-01-28 00:30:50','2026-01-28 00:30:51'),(8,'008/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_008_INV-RSI_01_2026.pdf','2026-01-28 00:36:24','2026-01-28 00:36:25'),(9,'009/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_009_INV-RSI_01_2026.pdf','2026-01-28 00:38:25','2026-01-28 00:38:25'),(10,'010/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_010_INV-RSI_01_2026.pdf','2026-01-28 00:48:37','2026-01-28 00:48:38'),(11,'011/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_011_INV-RSI_01_2026.pdf','2026-01-28 00:50:54','2026-01-28 00:50:55'),(12,'012/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_012_INV-RSI_01_2026.pdf','2026-01-28 00:51:43','2026-01-28 00:51:44'),(13,'013/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_013_INV-RSI_01_2026.pdf','2026-01-28 00:53:31','2026-01-28 00:53:32'),(14,'014/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_014_INV-RSI_01_2026.pdf','2026-01-28 00:55:02','2026-01-28 00:55:03'),(15,'015/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_015_INV-RSI_01_2026.pdf','2026-01-28 00:56:34','2026-01-28 00:56:35'),(16,'016/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_016_INV-RSI_01_2026.pdf','2026-01-28 00:57:03','2026-01-28 00:57:04'),(17,'017/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_017_INV-RSI_01_2026.pdf','2026-01-28 00:58:44','2026-01-28 00:58:45'),(18,'018/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_018_INV-RSI_01_2026.pdf','2026-01-28 00:59:34','2026-01-28 00:59:35'),(19,'019/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_019_INV-RSI_01_2026.pdf','2026-01-28 01:05:47','2026-01-28 01:05:48'),(20,'020/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft','qqqqewqeqweqsdasd','storage/invoices/invoice_020_INV-RSI_01_2026.pdf','2026-01-28 01:11:36','2026-01-28 01:11:37'),(21,'021/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_021_INV-RSI_01_2026.pdf','2026-01-28 01:16:13','2026-01-28 01:16:14'),(22,'022/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_022_INV-RSI_01_2026.pdf','2026-01-28 01:18:33','2026-01-28 01:18:34'),(23,'023/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_023_INV-RSI_01_2026.pdf','2026-01-28 01:21:01','2026-01-28 01:21:02'),(24,'024/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_024_INV-RSI_01_2026.pdf','2026-01-28 01:30:04','2026-01-28 01:30:04'),(25,'025/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_025_INV-RSI_01_2026.pdf','2026-01-28 01:38:44','2026-01-28 01:38:45'),(26,'026/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_026_INV-RSI_01_2026.pdf','2026-01-28 01:43:57','2026-01-28 01:43:57'),(27,'027/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft','1323123143214','storage/invoices/invoice_027_INV-RSI_01_2026.pdf','2026-01-28 01:44:18','2026-01-28 01:44:19'),(28,'028/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft','aaaaa','storage/invoices/invoice_028_INV-RSI_01_2026.pdf','2026-01-28 01:48:42','2026-01-28 01:48:43'),(29,'029/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',3025000.00,332750.00,3357750.00,1,'draft','Asik','storage/invoices/invoice_029_INV-RSI_01_2026.pdf','2026-01-28 01:50:20','2026-01-28 01:50:20'),(30,'030/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_030_INV-RSI_01_2026.pdf','2026-01-28 02:11:36','2026-01-28 02:11:37'),(31,'031/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_031_INV-RSI_01_2026.pdf','2026-01-28 02:19:24','2026-01-28 02:19:25'),(32,'032/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_032_INV-RSI_01_2026.pdf','2026-01-28 02:20:19','2026-01-28 02:20:19'),(33,'033/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_033_INV-RSI_01_2026.pdf','2026-01-28 02:22:47','2026-01-28 02:22:48'),(34,'034/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_034_INV-RSI_01_2026.pdf','2026-01-28 02:25:22','2026-01-28 02:25:23'),(35,'035/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_035_INV-RSI_01_2026.pdf','2026-01-28 02:31:18','2026-01-28 02:31:19'),(36,'036/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_036_INV-RSI_01_2026.pdf','2026-01-28 02:39:07','2026-01-28 02:39:08'),(37,'037/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_037_INV-RSI_01_2026.pdf','2026-01-28 02:42:01','2026-01-28 02:42:02'),(39,'038/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_038_INV-RSI_01_2026.pdf','2026-01-28 02:51:05','2026-01-28 02:51:06'),(40,'039/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_039_INV-RSI_01_2026.pdf','2026-01-28 02:53:28','2026-01-28 02:53:29'),(41,'040/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_040_INV-RSI_01_2026.pdf','2026-01-28 02:54:57','2026-01-28 02:54:57'),(42,'041/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_041_INV-RSI_01_2026.pdf','2026-01-28 02:55:26','2026-01-28 02:55:26'),(43,'042/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_042_INV-RSI_01_2026.pdf','2026-01-28 02:55:58','2026-01-28 02:55:59'),(44,'043/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_043_INV-RSI_01_2026.pdf','2026-01-28 02:56:34','2026-01-28 02:56:35'),(45,'044/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,NULL,'Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_044_INV-RSI_01_2026.pdf','2026-01-28 02:57:02','2026-01-28 02:57:03'),(46,'045/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_045_INV-RSI_01_2026.pdf','2026-01-28 02:57:25','2026-01-28 02:57:26'),(47,'046/INV-RSI/01/2026',2,1,'2026-01-28','2026-02-27',NULL,NULL,'Bpk Riyadi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_046_INV-RSI_01_2026.pdf','2026-01-28 02:58:28','2026-01-28 02:58:29'),(48,'047/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27','adasd','100/RSI.PO/01/2026','Pak Andi','Manager',12234.00,1345.74,13579.74,1,'draft','aad','storage/invoices/invoice_047_INV-RSI_01_2026.pdf','2026-01-28 03:07:13','2026-01-28 03:07:14'),(49,'048/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27','aaddasd','100/RSI.PO/01/2026','Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_048_INV-RSI_01_2026.pdf','2026-01-28 03:08:44','2026-01-28 03:08:44'),(50,'049/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27','adad','098/RSI.PO/01/2026','Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_049_INV-RSI_01_2026.pdf','2026-01-28 03:11:46','2026-01-28 03:11:47'),(51,'050/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27','adasd','100/RSI.PO/01/2026','Pak Andi','Manager',1.00,0.00,1.00,0,'draft',NULL,'storage/invoices/invoice_050_INV-RSI_01_2026.pdf','2026-01-28 03:15:09','2026-01-28 03:15:10'),(52,'051/INV-RSI/01/2026',1,1,'2026-01-28','2026-02-27',NULL,'100/RSI.PO/01/2026','Pak Andi','Manager',12000000.00,1320000.00,13320000.00,1,'sent',NULL,'storage/invoices/invoice_051_INV-RSI_01_2026.pdf','2026-01-28 03:40:15','2026-01-28 03:40:16');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_07_24_153953_create_services_table',1),(6,'2025_07_25_161723_create_abouts_table',1),(7,'2025_07_29_080438_create_clients_table',1),(8,'2025_07_30_041837_create_employees_table',1),(9,'2025_07_30_055651_create_assignment_letters_table',1),(10,'2025_07_31_040944_create_invoices_table',1),(11,'2025_07_31_040949_create_invoice_items_table',1),(12,'2025_08_14_034020_create_jobs_table',1),(13,'2026_01_22_050207_create_delivery_orders_table',1),(14,'2026_01_22_050224_create_delivery_order_items_table',1),(15,'2026_01_31_000000_create_purchase_orders_table',1),(16,'2026_01_31_000001_create_purchase_order_items_table',1),(17,'2026_02_01_000001_add_po_number_to_delivery_order_items_table',1),(18,'2026_02_01_000002_add_employee_fields_to_delivery_orders_table',1),(19,'2026_08_08_000000_add_signatory_to_purchase_orders_table',1),(20,'2026_01_27_000001_add_item_type_to_purchase_order_items_table',2),(21,'2026_01_27_000002_add_terms_to_purchase_orders_table',3),(22,'2026_01_28_000001_create_pembukuans_table',4),(23,'2026_01_28_000002_create_pembukuan_items_table',4),(24,'2026_01_28_100000_add_jabatan_to_clients_table',5),(25,'2026_02_02_000001_add_po_ref_number_to_invoices_table',6),(26,'2026_04_09_000001_add_slug_and_excerpt_to_services_table',7),(27,'2026_04_09_000002_create_service_images_table',7),(28,'2026_04_09_000003_backfill_services_slug_and_excerpt',8),(29,'2026_04_09_000004_add_vision_and_mission_to_abouts_table',9),(30,'2026_04_09_000005_add_service_type_catalog_and_links_to_services_table',10),(31,'2026_04_09_000006_add_is_logo_to_service_images_table',11),(32,'2026_09_21_000001_create_inquiries_table',12),(33,'2026_09_21_000002_create_site_settings_table',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembukuan_items`
--

DROP TABLE IF EXISTS `pembukuan_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembukuan_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pembukuan_id` bigint(20) unsigned NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `quantity` decimal(12,2) NOT NULL DEFAULT 1.00,
  `harga_barang` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembukuan_items_pembukuan_id_foreign` (`pembukuan_id`),
  CONSTRAINT `pembukuan_items_pembukuan_id_foreign` FOREIGN KEY (`pembukuan_id`) REFERENCES `pembukuans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembukuan_items`
--

LOCK TABLES `pembukuan_items` WRITE;
/*!40000 ALTER TABLE `pembukuan_items` DISABLE KEYS */;
INSERT INTO `pembukuan_items` VALUES (5,1,'CCTV',1.00,1000000.00,1000000.00,'2026-01-27 21:53:47','2026-01-27 21:53:47'),(6,1,'Kopi Kapal Api',10.00,5000.00,50000.00,'2026-01-27 21:53:47','2026-01-27 21:53:47'),(9,2,'CCTV',1.00,1000000.00,1000000.00,'2026-01-28 03:48:09','2026-01-28 03:48:09'),(10,2,'Kopi Kapal Api',10.00,5000.00,50000.00,'2026-01-28 03:48:09','2026-01-28 03:48:09'),(11,3,'CCTV',1.00,120000.00,120000.00,'2026-01-28 03:53:23','2026-01-28 03:53:23'),(12,4,'asdasdads',1.00,100000.00,100000.00,'2026-01-28 03:53:54','2026-01-28 03:53:54'),(13,5,'asdasdsad',1.00,120000.00,120000.00,'2026-01-28 03:54:44','2026-01-28 03:54:44'),(14,6,'asdasdasd',1.00,100000.00,100000.00,'2026-01-28 03:59:41','2026-01-28 03:59:41'),(15,7,'CCTV',1.00,100000.00,100000.00,'2026-01-28 04:07:19','2026-01-28 04:07:19'),(16,8,'cctv',12.00,10000.00,120000.00,'2026-01-28 06:26:22','2026-01-28 06:26:22'),(17,8,'kabel',100.00,15000.00,1500000.00,'2026-01-28 06:26:22','2026-01-28 06:26:22'),(18,8,'Tiang',10.00,50000.00,500000.00,'2026-01-28 06:26:22','2026-01-28 06:26:22');
/*!40000 ALTER TABLE `pembukuan_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembukuans`
--

DROP TABLE IF EXISTS `pembukuans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembukuans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_project` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `total_jumlah` decimal(15,2) NOT NULL DEFAULT 0.00,
  `income` decimal(15,2) NOT NULL DEFAULT 0.00,
  `selisih` decimal(15,2) NOT NULL DEFAULT 0.00,
  `selisih_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembukuans`
--

LOCK TABLES `pembukuans` WRITE;
/*!40000 ALTER TABLE `pembukuans` DISABLE KEYS */;
INSERT INTO `pembukuans` VALUES (1,'Kaleyo','2026-01-28','2026-02-28',1050000.00,0.00,1050000.00,'profit','2026-01-27 21:42:04','2026-01-27 21:45:47'),(2,'Kaleyo','2026-01-28','2026-02-28',1050000.00,1050000.00,0.00,'loss','2026-01-27 22:07:17','2026-01-28 03:48:09'),(3,'Kaleyo','2026-01-28','2026-01-28',120000.00,120000.00,0.00,'nihil','2026-01-28 03:53:23','2026-01-28 03:53:23'),(4,'Kaleyo','2026-01-28','2026-01-28',100000.00,0.00,100000.00,'loss','2026-01-28 03:53:54','2026-01-28 03:53:54'),(5,'Kaleyo','2026-01-28','2026-01-28',120000.00,120000.00,0.00,'nihil','2026-01-28 03:54:44','2026-01-28 03:54:44'),(6,'Kaleyo','2026-01-28','2026-01-28',100000.00,100000.00,0.00,'nihil','2026-01-28 03:59:41','2026-01-28 03:59:41'),(7,'Kaleyo','2026-01-28','2026-01-28',100000.00,100000.00,0.00,'nihil','2026-01-28 04:07:19','2026-01-28 04:07:19'),(8,'Bobobox mandasari','2026-01-14','2026-01-26',2120000.00,5000000.00,2880000.00,'profit','2026-01-28 06:26:22','2026-01-28 06:26:22');
/*!40000 ALTER TABLE `pembukuans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint(20) unsigned NOT NULL,
  `item_type` varchar(20) NOT NULL DEFAULT 'hardware',
  `description` text NOT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `uom` varchar(255) NOT NULL DEFAULT 'Unit',
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
INSERT INTO `purchase_order_items` VALUES (4,2,'hardware','asaa','a13',12,'UNIT',10000.00,120000.00,'2026-01-26 03:22:24','2026-01-26 03:22:24'),(6,3,'hardware','asaa','a13',3,'PCS',25000.00,75000.00,'2026-01-26 05:35:02','2026-01-26 05:35:02'),(7,4,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:35:20','2026-01-26 05:35:20'),(8,5,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:37:06','2026-01-26 05:37:06'),(9,6,'hardware','q','q',1,'PCS',0.00,0.00,'2026-01-26 05:39:16','2026-01-26 05:39:16'),(10,7,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:41:52','2026-01-26 05:41:52'),(11,8,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:44:10','2026-01-26 05:44:10'),(12,9,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:45:42','2026-01-26 05:45:42'),(13,10,'hardware','e','e',1,'PCS',0.00,0.00,'2026-01-26 05:46:27','2026-01-26 05:46:27'),(14,11,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 05:49:36','2026-01-26 05:49:36'),(15,12,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 06:53:44','2026-01-26 06:53:44'),(16,13,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 06:57:33','2026-01-26 06:57:33'),(17,14,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 06:59:02','2026-01-26 06:59:02'),(18,15,'hardware','z','z',1,'PCS',0.00,0.00,'2026-01-26 07:11:41','2026-01-26 07:11:41'),(19,16,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 07:13:30','2026-01-26 07:13:30'),(20,17,'hardware','z','a',1,'PCS',0.00,0.00,'2026-01-26 07:53:14','2026-01-26 07:53:14'),(21,18,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 07:54:37','2026-01-26 07:54:37'),(22,19,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 07:56:22','2026-01-26 07:56:22'),(23,20,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 07:58:22','2026-01-26 07:58:22'),(24,21,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:01:58','2026-01-26 08:01:58'),(25,22,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:02:46','2026-01-26 08:02:46'),(26,22,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:02:46','2026-01-26 08:02:46'),(27,22,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:02:46','2026-01-26 08:02:46'),(28,22,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:02:46','2026-01-26 08:02:46'),(29,23,'hardware','a','221',1,'PCS',0.00,0.00,'2026-01-26 08:03:12','2026-01-26 08:03:12'),(30,23,'hardware','a','21',1,'PCS',0.00,0.00,'2026-01-26 08:03:12','2026-01-26 08:03:12'),(31,23,'hardware','a','11',1,'PCS',0.00,0.00,'2026-01-26 08:03:12','2026-01-26 08:03:12'),(32,23,'hardware','a','22',1,'PCS',0.00,0.00,'2026-01-26 08:03:12','2026-01-26 08:03:12'),(33,24,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:05:12','2026-01-26 08:05:12'),(34,25,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:08:27','2026-01-26 08:08:27'),(35,26,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 08:14:01','2026-01-26 08:14:01'),(36,27,'hardware','asdasd','asdasd',1,'PCS',12310.00,12310.00,'2026-01-26 20:03:17','2026-01-26 20:03:17'),(37,28,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:11:03','2026-01-26 20:11:03'),(38,29,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:12:59','2026-01-26 20:12:59'),(39,30,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:19:35','2026-01-26 20:19:35'),(40,31,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:23:57','2026-01-26 20:23:57'),(41,32,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:25:03','2026-01-26 20:25:03'),(42,33,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:29:23','2026-01-26 20:29:23'),(43,34,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 20:37:10','2026-01-26 20:37:10'),(44,35,'hardware','a','w',1,'PCS',0.00,0.00,'2026-01-26 20:42:02','2026-01-26 20:42:02'),(45,36,'hardware','w','aaa',111,'PCS',110.00,12210.00,'2026-01-26 20:48:42','2026-01-26 20:48:42'),(46,36,'hardware','w','121',2,'PCS',1110.00,2220.00,'2026-01-26 20:48:42','2026-01-26 20:48:42'),(47,36,'hardware','33','1212',12,'PCS',4440.00,53280.00,'2026-01-26 20:48:42','2026-01-26 20:48:42'),(48,37,'hardware','a','das',222,'PCS',111.00,24642.00,'2026-01-26 21:07:55','2026-01-26 21:07:55'),(49,37,'hardware','qq','sss',1,'PCS',3132.00,3132.00,'2026-01-26 21:07:55','2026-01-26 21:07:55'),(50,37,'hardware','qeq','aa',22,'PCS',222.00,4884.00,'2026-01-26 21:07:55','2026-01-26 21:07:55'),(51,37,'hardware','e12','ada',2,'PCS',1000.00,2000.00,'2026-01-26 21:07:55','2026-01-26 21:07:55'),(52,38,'hardware','a','a',1,'PCS',1111.00,1111.00,'2026-01-26 21:11:32','2026-01-26 21:11:32'),(53,39,'hardware','a','a',1,'PCS',141.00,141.00,'2026-01-26 21:15:28','2026-01-26 21:15:28'),(54,40,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 21:16:41','2026-01-26 21:16:41'),(55,41,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 21:50:44','2026-01-26 21:50:44'),(56,42,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 21:51:59','2026-01-26 21:51:59'),(57,43,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:06:31','2026-01-26 22:06:31'),(58,44,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:07:25','2026-01-26 22:07:25'),(59,45,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:08:18','2026-01-26 22:08:18'),(60,46,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:11:09','2026-01-26 22:11:09'),(61,47,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:24:21','2026-01-26 22:24:21'),(62,48,'hardware','a','a',1,'PCS',0.00,0.00,'2026-01-26 22:30:10','2026-01-26 22:30:10'),(63,49,'hardware','adda',NULL,1,'PCS',1222.00,1222.00,'2026-01-27 03:45:39','2026-01-27 03:45:39'),(64,49,'hardware','aa',NULL,1,'PCS',11.00,11.00,'2026-01-27 03:45:39','2026-01-27 03:45:39'),(65,50,'hardware','gas',NULL,12,'Meter',10101.00,121212.00,'2026-01-27 03:58:26','2026-01-27 03:58:26'),(66,50,'service','122',NULL,22,'Meter',2222.00,48884.00,'2026-01-27 03:58:26','2026-01-27 03:58:26'),(67,51,'hardware','g',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:18:25','2026-01-27 04:18:25'),(68,52,'hardware','a',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:23:15','2026-01-27 04:23:15'),(69,53,'hardware','a',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:32:58','2026-01-27 04:32:58'),(70,54,'hardware','a',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:35:47','2026-01-27 04:35:47'),(71,55,'hardware','aa',NULL,2,'Meter',10000.00,20000.00,'2026-01-27 04:37:41','2026-01-27 04:37:41'),(72,55,'hardware','aa',NULL,3,'Meter',1000.00,3000.00,'2026-01-27 04:37:41','2026-01-27 04:37:41'),(73,55,'service','ss',NULL,4,'Meter',200.00,800.00,'2026-01-27 04:37:41','2026-01-27 04:37:41'),(74,55,'service','ss',NULL,55,'Meter',100.00,5500.00,'2026-01-27 04:37:41','2026-01-27 04:37:41'),(75,56,'hardware','aa',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:45:58','2026-01-27 04:45:58'),(76,56,'hardware','aaa',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:45:58','2026-01-27 04:45:58'),(77,56,'service','aa',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:45:58','2026-01-27 04:45:58'),(78,56,'service','aaaa',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:45:58','2026-01-27 04:45:58'),(79,57,'hardware','aaa',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:50:40','2026-01-27 04:50:40'),(80,57,'service','dd',NULL,1,'Meter',0.00,0.00,'2026-01-27 04:50:40','2026-01-27 04:50:40'),(81,58,'hardware','aa','a',1,'Unit',0.00,0.00,'2026-01-27 05:16:58','2026-01-27 05:16:58'),(82,59,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:26:13','2026-01-27 05:26:13'),(83,60,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:29:44','2026-01-27 05:29:44'),(84,61,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:32:36','2026-01-27 05:32:36'),(85,62,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:35:41','2026-01-27 05:35:41'),(86,63,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:38:24','2026-01-27 05:38:24'),(87,64,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:46:08','2026-01-27 05:46:08'),(88,65,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:51:52','2026-01-27 05:51:52'),(89,66,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 05:56:11','2026-01-27 05:56:11'),(90,67,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:19:08','2026-01-27 07:19:08'),(91,68,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:24:05','2026-01-27 07:24:05'),(92,69,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:27:11','2026-01-27 07:27:11'),(93,70,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:32:06','2026-01-27 07:32:06'),(94,71,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:35:32','2026-01-27 07:35:32'),(95,72,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:37:43','2026-01-27 07:37:43'),(96,73,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:45:27','2026-01-27 07:45:27'),(97,74,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:50:27','2026-01-27 07:50:27'),(98,75,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:52:28','2026-01-27 07:52:28'),(99,76,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:54:05','2026-01-27 07:54:05'),(100,77,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:54:56','2026-01-27 07:54:56'),(101,78,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:56:03','2026-01-27 07:56:03'),(102,79,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:57:04','2026-01-27 07:57:04'),(103,80,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:58:13','2026-01-27 07:58:13'),(104,81,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 07:59:02','2026-01-27 07:59:02'),(105,82,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:02:12','2026-01-27 08:02:12'),(106,83,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:03:09','2026-01-27 08:03:09'),(107,84,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:03:49','2026-01-27 08:03:49'),(108,85,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:04:22','2026-01-27 08:04:22'),(109,86,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:06:56','2026-01-27 08:06:56'),(110,87,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:11:15','2026-01-27 08:11:15'),(111,88,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:15:23','2026-01-27 08:15:23'),(112,89,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:19:19','2026-01-27 08:19:19'),(113,90,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:21:46','2026-01-27 08:21:46'),(114,91,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:25:04','2026-01-27 08:25:04'),(115,92,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:27:12','2026-01-27 08:27:12'),(116,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(117,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(118,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(119,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(120,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(121,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(122,93,'hardware','a',NULL,1,'Unit',0.00,0.00,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(123,94,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:32:10','2026-01-27 08:32:10'),(124,95,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:33:20','2026-01-27 08:33:20'),(125,96,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:39:23','2026-01-27 08:39:23'),(126,97,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:41:59','2026-01-27 08:41:59'),(127,98,'hardware','a','a',1,'Unit',0.00,0.00,'2026-01-27 08:43:28','2026-01-27 08:43:28'),(128,99,'hardware','a','a',4,'Unit',12000.00,48000.00,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(129,99,'hardware','a','a',5,'Unit',300000.00,1500000.00,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(130,99,'hardware','a','a',2,'Unit',20000.00,40000.00,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(131,99,'hardware','a','a',9,'Unit',1900000.00,17100000.00,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(132,99,'hardware','a','a',99,'Unit',3000.00,297000.00,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(133,100,'hardware','a','a',1,'Unit',1.00,1.00,'2026-01-28 00:41:16','2026-01-28 00:41:16'),(134,101,'hardware','a','a',1,'Unit',1.00,1.00,'2026-01-28 01:57:29','2026-01-28 01:57:29');
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_number` varchar(255) NOT NULL,
  `po_date` date NOT NULL,
  `ref_number` varchar(255) DEFAULT NULL,
  `vendor_id` bigint(20) unsigned DEFAULT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_address` text NOT NULL,
  `vendor_email` varchar(255) DEFAULT NULL,
  `vendor_contact_person` varchar(255) DEFAULT NULL,
  `ship_to_company` varchar(255) NOT NULL,
  `ship_to_address` text NOT NULL,
  `attention_to` varchar(255) DEFAULT NULL,
  `attention_name` varchar(255) DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `vat_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `terms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`terms`)),
  `status` enum('draft','pending','approved','cancelled') NOT NULL DEFAULT 'draft',
  `created_by` bigint(20) unsigned NOT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `signatory_employee_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  KEY `purchase_orders_vendor_id_foreign` (`vendor_id`),
  KEY `purchase_orders_created_by_foreign` (`created_by`),
  KEY `purchase_orders_approved_by_foreign` (`approved_by`),
  KEY `purchase_orders_signatory_employee_id_foreign` (`signatory_employee_id`),
  CONSTRAINT `purchase_orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchase_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `purchase_orders_signatory_employee_id_foreign` FOREIGN KEY (`signatory_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchase_orders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
INSERT INTO `purchase_orders` VALUES (2,'001/RSI.PO/01/2026','2026-01-26','001/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,120000.00,14400.00,134400.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 00:46:55','2026-01-26 03:22:24'),(3,'002/RSI.PO/01/2026','2026-01-26','002/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,75000.00,9000.00,84000.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 04:47:49','2026-01-26 04:47:50'),(4,'003/RSI.PO/01/2026','2026-01-26','003/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:35:20','2026-01-26 05:35:20'),(5,'004/RSI.PO/01/2026','2026-01-26','004/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:37:06','2026-01-26 05:37:06'),(6,'005/RSI.PO/01/2026','2026-01-26','005/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:39:16','2026-01-26 05:39:16'),(7,'006/RSI.PO/01/2026','2026-01-26','006/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:41:52','2026-01-26 05:41:52'),(8,'007/RSI.PO/01/2026','2026-01-26','007/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:44:10','2026-01-26 05:44:10'),(9,'008/RSI.PO/01/2026','2026-01-26','008/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:45:42','2026-01-26 05:45:42'),(10,'009/RSI.PO/01/2026','2026-01-26','009/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:46:27','2026-01-26 05:46:27'),(11,'010/RSI.PO/01/2026','2026-01-26','010/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 05:49:36','2026-01-26 05:49:36'),(12,'011/RSI.PO/01/2026','2026-01-26','011/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 06:53:44','2026-01-26 06:53:44'),(13,'012/RSI.PO/01/2026','2026-01-26','012/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 06:57:33','2026-01-26 06:57:33'),(14,'013/RSI.PO/01/2026','2026-01-26','013/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 06:59:02','2026-01-26 06:59:02'),(15,'014/RSI.PO/01/2026','2026-01-26','014/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:11:41','2026-01-26 07:11:41'),(16,'015/RSI.PO/01/2026','2026-01-26','015/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:13:30','2026-01-26 07:13:30'),(17,'016/RSI.PO/01/2026','2026-01-26','016/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:53:14','2026-01-26 07:53:14'),(18,'017/RSI.PO/01/2026','2026-01-26','017/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:54:37','2026-01-26 07:54:37'),(19,'018/RSI.PO/01/2026','2026-01-26','018/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:56:22','2026-01-26 07:56:22'),(20,'019/RSI.PO/01/2026','2026-01-26','019/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 07:58:22','2026-01-26 07:58:22'),(21,'020/RSI.PO/01/2026','2026-01-26','020/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:01:58','2026-01-26 08:01:58'),(22,'021/RSI.PO/01/2026','2026-01-26','021/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:02:46','2026-01-26 08:02:46'),(23,'022/RSI.PO/01/2026','2026-01-26','021/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:03:12','2026-01-26 08:03:12'),(24,'023/RSI.PO/01/2026','2026-01-26','023/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:05:12','2026-01-26 08:05:12'),(25,'024/RSI.PO/01/2026','2026-01-26','024/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:08:27','2026-01-26 08:08:27'),(26,'025/RSI.PO/01/2026','2026-01-26','025/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 08:14:01','2026-01-26 08:14:01'),(27,'026/RSI.PO/01/2026','2026-01-27','026/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','asdasdasdasd',NULL,NULL,12310.00,1477.20,13787.20,NULL,NULL,'draft',2,NULL,NULL,1,'2026-01-26 20:03:17','2026-01-26 20:03:17'),(28,'027/RSI.PO/01/2026','2026-01-27','027/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:11:03','2026-01-26 20:11:03'),(29,'028/RSI.PO/01/2026','2026-01-27','028/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:12:59','2026-01-26 20:12:59'),(30,'029/RSI.PO/01/2026','2026-01-27','029/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:19:35','2026-01-26 20:19:35'),(31,'030/RSI.PO/01/2026','2026-01-27','030/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:23:57','2026-01-26 20:23:57'),(32,'031/RSI.PO/01/2026','2026-01-27','031/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:25:03','2026-01-26 20:25:03'),(33,'032/RSI.PO/01/2026','2026-01-27','032/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:29:23','2026-01-26 20:29:23'),(34,'033/RSI.PO/01/2026','2026-01-27','033/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:37:10','2026-01-26 20:37:10'),(35,'034/RSI.PO/01/2026','2026-01-27','034/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:42:02','2026-01-26 20:42:02'),(36,'035/RSI.PO/01/2026','2026-01-27','035/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,67710.00,8125.20,75835.20,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 20:48:42','2026-01-26 20:48:42'),(37,'036/RSI.PO/01/2026','2026-01-27','036/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,34658.00,4158.96,38816.96,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:07:55','2026-01-26 21:07:55'),(38,'037/RSI.PO/01/2026','2026-01-27','037/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,1111.00,133.32,1244.32,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:11:32','2026-01-26 21:11:32'),(39,'038/RSI.PO/01/2026','2026-01-27','038/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,141.00,16.92,157.92,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:15:28','2026-01-26 21:15:28'),(40,'039/RSI.PO/01/2026','2026-01-27','039/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:16:41','2026-01-26 21:16:41'),(41,'040/RSI.PO/01/2026','2026-01-27','040/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:50:44','2026-01-26 21:50:44'),(42,'041/RSI.PO/01/2026','2026-01-27','041/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 21:51:59','2026-01-26 21:51:59'),(43,'042/RSI.PO/01/2026','2026-01-27','042/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:06:31','2026-01-26 22:06:31'),(44,'043/RSI.PO/01/2026','2026-01-27','043/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:07:25','2026-01-26 22:07:25'),(45,'044/RSI.PO/01/2026','2026-01-27','044/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:08:18','2026-01-26 22:08:18'),(46,'045/RSI.PO/01/2026','2026-01-27','045/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:11:09','2026-01-26 22:11:09'),(47,'046/RSI.PO/01/2026','2026-01-27','046/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:24:21','2026-01-26 22:24:21'),(48,'047/RSI.PO/01/2026','2026-01-27','047/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-26 22:30:10','2026-01-26 22:30:10'),(49,'048/RSI.PO/01/2026','2026-01-27','048/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,1233.00,147.96,1380.96,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-27 03:45:39','2026-01-27 03:45:39'),(50,'049/RSI.PO/01/2026','2026-01-27','049/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,170096.00,18710.56,188806.56,NULL,NULL,'draft',1,NULL,NULL,1,'2026-01-27 03:58:26','2026-01-27 03:58:26'),(51,'050/RSI.PO/01/2026','2026-01-27','050/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"sed\"]','draft',1,NULL,NULL,1,'2026-01-27 04:18:25','2026-01-27 04:18:25'),(52,'051/RSI.PO/01/2026','2026-01-27','051/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"sed\"]','draft',1,NULL,NULL,1,'2026-01-27 04:23:15','2026-01-27 04:23:15'),(53,'052/RSI.PO/01/2026','2026-01-27','052/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"a\"]','draft',1,NULL,NULL,1,'2026-01-27 04:32:58','2026-01-27 04:32:58'),(54,'053/RSI.PO/01/2026','2026-01-27','053/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"a\"]','draft',1,NULL,NULL,1,'2026-01-27 04:35:47','2026-01-27 04:35:47'),(55,'054/RSI.PO/01/2026','2026-01-27','054/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,29300.00,3223.00,32523.00,NULL,'[\"sed\"]','draft',1,NULL,NULL,1,'2026-01-27 04:37:41','2026-01-27 04:37:41'),(56,'055/RSI.PO/01/2026','2026-01-27','055/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"aaa\"]','draft',1,NULL,NULL,1,'2026-01-27 04:45:58','2026-01-27 04:45:58'),(57,'056/RSI.PO/01/2026','2026-01-27','056/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,NULL,'[\"d\"]','draft',1,NULL,NULL,1,'2026-01-27 04:50:40','2026-01-27 04:50:40'),(58,'057/RSI.PO/01/2026','2026-01-27','057/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:16:58','2026-01-27 05:16:58'),(59,'058/RSI.PO/01/2026','2026-01-27','058/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:26:13','2026-01-27 05:26:13'),(60,'059/RSI.PO/01/2026','2026-01-27','059/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:29:44','2026-01-27 05:29:44'),(61,'060/RSI.PO/01/2026','2026-01-27','060/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:32:36','2026-01-27 05:32:36'),(62,'061/RSI.PO/01/2026','2026-01-27','061/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:35:41','2026-01-27 05:35:41'),(63,'062/RSI.PO/01/2026','2026-01-27','062/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:38:24','2026-01-27 05:38:24'),(64,'063/RSI.PO/01/2026','2026-01-27','063/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:46:08','2026-01-27 05:46:08'),(65,'064/RSI.PO/01/2026','2026-01-27','064/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:51:52','2026-01-27 05:51:52'),(66,'065/RSI.PO/01/2026','2026-01-27','065/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 05:56:11','2026-01-27 05:56:11'),(67,'066/RSI.PO/01/2026','2026-01-27','066/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:19:08','2026-01-27 07:19:08'),(68,'067/RSI.PO/01/2026','2026-01-27','067/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:24:05','2026-01-27 07:24:05'),(69,'068/RSI.PO/01/2026','2026-01-27','068/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:27:11','2026-01-27 07:27:11'),(70,'069/RSI.PO/01/2026','2026-01-27','069/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:32:06','2026-01-27 07:32:06'),(71,'070/RSI.PO/01/2026','2026-01-27','070/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:35:32','2026-01-27 07:35:32'),(72,'071/RSI.PO/01/2026','2026-01-27','071/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:37:43','2026-01-27 07:37:43'),(73,'072/RSI.PO/01/2026','2026-01-27','072/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:45:27','2026-01-27 07:45:27'),(74,'073/RSI.PO/01/2026','2026-01-27','073/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:50:27','2026-01-27 07:50:27'),(75,'074/RSI.PO/01/2026','2026-01-27','074/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:52:28','2026-01-27 07:52:28'),(76,'075/RSI.PO/01/2026','2026-01-27','075/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:54:05','2026-01-27 07:54:05'),(77,'076/RSI.PO/01/2026','2026-01-27','076/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:54:56','2026-01-27 07:54:56'),(78,'077/RSI.PO/01/2026','2026-01-27','077/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:56:03','2026-01-27 07:56:03'),(79,'078/RSI.PO/01/2026','2026-01-27','078/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:57:04','2026-01-27 07:57:04'),(80,'079/RSI.PO/01/2026','2026-01-27','079/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:58:13','2026-01-27 07:58:13'),(81,'080/RSI.PO/01/2026','2026-01-27','080/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 07:59:02','2026-01-27 07:59:02'),(82,'081/RSI.PO/01/2026','2026-01-27','081/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:02:12','2026-01-27 08:02:12'),(83,'082/RSI.PO/01/2026','2026-01-27','082/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:03:09','2026-01-27 08:03:09'),(84,'083/RSI.PO/01/2026','2026-01-27','083/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:03:49','2026-01-27 08:03:49'),(85,'084/RSI.PO/01/2026','2026-01-27','084/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:04:22','2026-01-27 08:04:22'),(86,'085/RSI.PO/01/2026','2026-01-27','085/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:06:56','2026-01-27 08:06:56'),(87,'086/RSI.PO/01/2026','2026-01-27','086/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:11:15','2026-01-27 08:11:15'),(88,'087/RSI.PO/01/2026','2026-01-27','087/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,1,'2026-01-27 08:15:23','2026-01-27 08:15:23'),(89,'088/RSI.PO/01/2026','2026-01-27','088/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:19:19','2026-01-27 08:19:19'),(90,'089/RSI.PO/01/2026','2026-01-27','089/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:21:46','2026-01-27 08:21:46'),(91,'090/RSI.PO/01/2026','2026-01-27','090/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:25:04','2026-01-27 08:25:04'),(92,'091/RSI.PO/01/2026','2026-01-27','091/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:27:12','2026-01-27 08:27:12'),(93,'092/RSI.PO/01/2026','2026-01-27','092/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:27:39','2026-01-27 08:27:39'),(94,'093/RSI.PO/01/2026','2026-01-27','093/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:32:10','2026-01-27 08:32:10'),(95,'094/RSI.PO/01/2026','2026-01-27','094/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:33:20','2026-01-27 08:33:20'),(96,'095/RSI.PO/01/2026','2026-01-27','095/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:39:23','2026-01-27 08:39:23'),(97,'096/RSI.PO/01/2026','2026-01-27','096/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:41:59','2026-01-27 08:41:59'),(98,'097/RSI.PO/01/2026','2026-01-27','097/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,0.00,0.00,0.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:43:28','2026-01-27 08:43:28'),(99,'098/RSI.PO/01/2026','2026-01-27','098/RSI.PO/01/2026',2,'PT PAYUNG TEDUH BERDUA','Jalan Cempaka Putih Barat VII No.138 Jakarta Pusat','siapjadi@gmail.com','Bpk Riyadi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,18985000.00,2088350.00,21073350.00,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-27 08:45:19','2026-01-27 08:45:19'),(100,'099/RSI.PO/01/2026','2026-01-28','099/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,1.00,0.11,1.11,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-28 00:41:16','2026-01-28 00:41:16'),(101,'100/RSI.PO/01/2026','2026-01-28','100/RSI.PO/01/2026',1,'PT SKHA INDONESIA','Bintara Alam Permai Blok A No 6\r\nBAP','siapjadi@gmail.com','Pak Andi','PT. RSI','Jl. Contoh No. 123, Jakarta',NULL,NULL,1.00,0.11,1.11,'- All shipments must include notes, invoices and receipts\r\n- We will return the goods if not in accordance with the order\r\n- Purchase order (PO) number must be listed on the note / invoice / receipt\r\n- If delivery of goods by partial, please include a copy of the PO','[]','draft',1,NULL,NULL,NULL,'2026-01-28 01:57:29','2026-01-28 01:57:29');
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_images`
--

DROP TABLE IF EXISTS `service_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_logo` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_images_service_id_foreign` (`service_id`),
  CONSTRAINT `service_images_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_images`
--

LOCK TABLES `service_images` WRITE;
/*!40000 ALTER TABLE `service_images` DISABLE KEYS */;
INSERT INTO `service_images` VALUES (15,20,'services/logos/SIXeqSS1HpNABweA66Xi3yto2tfIugxaUOg5jDlA.png','Integrated Managed Service',0,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(17,20,'services/logos/6xoHCbqP4Vk7VKq3nkaOO9kurr6Gjf4iGK4E3bmX.jpg','Integrated Managed Service',2,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(18,20,'services/logos/H3LNSd3NgKjLZWx5sZRx3UJHNPNcfUQEOaFbIzBk.png','Integrated Managed Service',3,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(19,20,'services/logos/MQh8cruefAiXSlqZ6tBSmsIN0mzGYXe58bcchKez.png','Integrated Managed Service',4,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(20,20,'services/logos/hjAjNwVNj6uo2dqIm063VF7bVBLMAZtEEFm5L3Ra.jpg','Integrated Managed Service',5,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(21,20,'services/logos/6JxYPRZJz8mDahznWkY4iHSXrslK4nORtFH0zBum.png','Integrated Managed Service',6,1,'2026-04-11 03:20:18','2026-04-11 03:20:18'),(22,20,'services/logos/zOtkM5C8B4EYUzekL41Ru8WJM5O3AAXlbc1q9UsV.jpg','Integrated Managed Service',7,1,'2026-04-11 03:22:25','2026-04-11 03:22:25'),(25,20,'services/logos/HDhg6cSugAVbzi1TvCWc6Fh0FdyRIHPkrxM1LSMt.png','Integrated Manage Service',8,1,'2026-04-22 19:44:37','2026-04-22 19:44:37'),(26,20,'services/logos/IeC04hNor0FVSCi4EP2Z24wt4Ze1fEg7jrxAfKxe.png','Integrated Manage Service',9,1,'2026-04-22 19:44:37','2026-04-22 19:44:37');
/*!40000 ALTER TABLE `service_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL DEFAULT 'managed_service',
  `slug` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `catalog_file` varchar(255) DEFAULT NULL,
  `extra_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_links`)),
  `label` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (20,'Integrated Manage Service','managed_service','managed-service','haloooooo','This service aims to provide daily technical support to customers. Improving operational efficiency and reducing computer and system maintenance costs.','services/a4F2B4X1I7aS5R8jiypfKshpYuYdMXFltaHrbym1.png','services/catalogs/e5mOFdO4P0kI0PZgYHWRmUOyV64cs0wRvsdkCroe.pdf','[]','Managed Service','2026-04-10 00:10:08','2026-04-22 04:54:21'),(21,'IT Solution','infrastruktur_teknologi','infrastruktur-teknologi','halooo','Selecting the right technology is crucial for optimizing your business. We provide technology and information tailored to your needs, scale, and type of business or activity.\r\n\r\nConsult us on hardware and software selection, design, testing, and even management to support your work and data security.','services/qNvIsaKvfxxl4ThKs2qkYaXyzw70XiTdanZR4m4z.jpg',NULL,'[]','Infrastructure Technology','2026-04-10 00:11:35','2026-04-22 07:53:29'),(22,'Web & Software Development','web_software_development','web-software-development','We provide tailored digital solutions, including web and software development, to help businesses transition into efficient and scalable digital operations.','We provide tailored digital solutions, including web and software development, to help businesses transition into efficient and scalable digital operations.','services/fWQ4fZZd3S5HiZ1CHzgVjquzmCI4sF7SHjEBkxKX.jpg','services/catalogs/bz5WMC9GH7ezVPxnVEqj8FyRaREWw5zEQte0ChBB.pdf','[]','Web & Software Development','2026-04-10 00:12:58','2026-04-22 06:43:29'),(23,'Cloud Hosting','cloud_hosting','cloud-hosting','This service acts as a \"home\" for your website, ensuring that data is stored securely and easily accessible at any time by visitors via the domain name.','This service acts as a \"home\" for your website, ensuring that data is stored securely and easily accessible at any time by visitors via the domain name.','services/2Is1eci67KxHdej36ShR2AXpLRHP2dal16ZetiK5.png',NULL,'[{\"label\":\"mugglecloud.com\",\"url\":\"https:\\/\\/mugglecloud.com\"}]','Cloud Hosting','2026-04-10 00:13:28','2026-04-13 03:39:52');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'wms_demo_url','https://demo-wms.ruang-solusi.com','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(2,'hero_badge','Integrated IT Infrastructure & Managed Service Provider','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(3,'hero_title','Mitra Teknologi Terpercaya untuk Infrastruktur IT, Managed Service 24/7, dan Aplikasi Tailor-Made','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(4,'hero_subtitle','Ruang Solusi Internusa (RSI) menghadirkan solusi pengadaan dan sewa hardware berstandar enterprise, layanan monitoring NOC 24/7, sistem WMS siap pakai secara online realtime, serta rekayasa perangkat lunak tailor-made yang presisi bagi bisnis Anda.','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(5,'contact_email','info@ruang-solusi.com','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(6,'contact_phone','+62 815-1940-7954','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(7,'contact_whatsapp','6281519407954','general','2026-09-21 02:06:35','2026-09-21 02:06:35'),(8,'contact_address','Jl. Alam Utama XI, RT.13/RW.3, Bintara Jaya, Kec. Bekasi Barat, Kota Bekasi, Jawa Barat 17136','general','2026-09-21 02:06:35','2026-09-21 02:06:35');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Farrezell Fayz Arifrianto','fazzfayz321@gmail.com',NULL,'$2y$12$LZs2pZl2cXWHM5ZYOq3AMOScukbBe392CmLXCyXbGOSSmkIbjvZue','g2n3ifdE55C2XS6anfKMpyoxvWqnbnfGvEKPdAFbfB4beIi5qLVIwNupAXCh','2026-01-22 01:45:09','2026-03-29 19:09:39'),(2,'boboyagus','rahmatserang526@gmail.com',NULL,'$2y$12$y6r.9J6zGTT8.5ApqyRHv.LAYHYAWiAN73kZ9U6lpWCouz9IrPqyS',NULL,'2026-01-23 00:00:04','2026-01-23 00:00:04'),(3,'Nani Hadijah','nanihadijah@gmail.com',NULL,'$2y$12$Sscpj1GkQ0xiJ3YgPp.aIeCVRIM0Hssvg3tHOZOAhmESwpB.6Lexq',NULL,'2026-02-03 00:16:33','2026-02-03 00:16:33'),(4,'Dedy Arifrianto','dedyjelek@gmail.com',NULL,'$2y$12$3ti7.z1qpMKHV6nlzxBXEeu5LMuRZqec1FLVIODTvbQYPgUuOllYu',NULL,'2026-02-03 00:17:51','2026-02-03 00:17:51'),(5,'Andri','andriyani@ruang-solusi.com',NULL,'$2y$12$p4tBqsFUeQapjcksMCKtXe27UYFB30y7QlEpkeOVzlMmPc0SM1fMu','hLQsaW8AvNpIvFMqXVH5ldCZXv88IorGkJo6v86OuDFhPATw0YiYhnpziktL','2026-02-10 21:57:11','2026-02-10 21:57:11'),(6,'Daffa Raihan','mochdaffa.div@gmail.com',NULL,'$2y$12$MC/cc6MqHeFmcAUu8ggCAOzsgXg2P9cdAoKwgOBPDxtdj/THFdzfu',NULL,'2026-02-18 07:22:12','2026-04-28 19:43:51'),(7,'daniyal riedho wahyudi','riedhodaniyal@gmail.com',NULL,'$2y$12$jHSzi.wW5uYaaRHcPOe3Ku5V7bTCmzLCxW9LsEMKkSppaPaGDw2oa',NULL,'2026-06-08 18:17:41','2026-06-08 18:17:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-22 13:19:41

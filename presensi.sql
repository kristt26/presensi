# Host: localhost  (Version 5.5.8)
# Date: 2018-01-12 18:01:48
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "absen"
#

DROP TABLE IF EXISTS `absen`;
CREATE TABLE `absen` (
  `IdAbsen` int(11) NOT NULL AUTO_INCREMENT,
  `Nip` varchar(30) DEFAULT NULL,
  `TglAbsen` date DEFAULT NULL,
  `JamDatang` time DEFAULT NULL,
  `JamPulang` time DEFAULT '00:00:00',
  `Keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdAbsen`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

#
# Data for table "absen"
#

INSERT INTO `absen` VALUES (1,'121347384738','2018-01-05','07:23:39','14:23:51','Hadir'),(2,'1988100110','2018-12-03','07:31:49','00:00:00','Hadir'),(3,'1988100110','2017-11-01','08:01:49','00:00:00','Hadir'),(4,'1988100110','2017-11-02','08:10:33','00:00:00','Hadir'),(5,'1988100110','2017-11-03','08:11:00','00:00:00','Hadir'),(7,'1988100110','2017-11-07','08:32:33','00:00:00','Hadir'),(8,'1988100110','2017-11-08','08:27:43','00:00:00','Hadir'),(9,'1988100110','2017-11-09','08:22:52','00:00:00','Hadir'),(10,'1988100110','2017-11-10','08:26:05','00:00:00','Hadir'),(11,'1988100110','2017-11-13','08:37:32','00:00:00','Hadir'),(12,'1988100110','2017-11-14','08:26:46','00:00:00','Hadir'),(13,'1988100110','2017-11-15','08:17:57','00:00:00','Hadir'),(14,'1988100110','2017-11-16','08:17:06','00:00:00','Hadir'),(15,'1988100110','2017-11-17','08:10:17','00:00:00','Hadir'),(16,'1988100110','2017-11-20','08:07:29','00:00:00','Hadir'),(17,'1988100110','2017-11-21','08:04:39','00:00:00','Hadir'),(18,'1988100110','2017-11-22','08:13:48','00:00:00','Hadir'),(19,'1988100110','2017-11-23','08:39:57','00:00:00','Hadir'),(20,'1988100110','2017-11-24','08:42:07','00:00:00','Hadir'),(21,'1988100110','2017-11-27','08:30:21','00:00:00','Hadir'),(22,'1988100110','2017-11-28','08:26:29','00:00:00','Hadir'),(23,'1988100110','2017-11-29','08:21:37','00:00:00','Hadir'),(24,'1988100110','2017-11-30','08:23:52','00:00:00','Hadir'),(25,'1988100110','2017-12-08','08:25:27','00:00:00','Hadir'),(26,'1988100110','2017-12-11','08:22:40','00:00:00','Hadir'),(27,'1988100110','2017-12-12','08:56:49','00:00:00','Hadir'),(28,'1988100110','2017-12-13','08:50:57','00:00:00','Hadir'),(29,'1988100110','2017-12-14','08:23:04','00:00:00','Hadir'),(30,'1988100110','2017-12-15','08:07:17','00:00:00','Hadir'),(31,'1988100110','2018-01-02','08:08:10','00:00:00','Hadir'),(32,'1988100110','2018-01-03','08:14:19','00:00:00','Hadir'),(33,'1988100110','2018-01-04','08:16:26','00:00:00','Hadir'),(34,'1988100110','2018-01-05','08:23:34','00:00:00','Hadir'),(35,'1988100110','2018-01-08','08:37:42','00:00:00','Hadir'),(36,'1988100110','2018-01-09','08:20:49','00:00:00','Hadir'),(37,'1988100110','2018-01-10','08:22:57','00:00:00','Hadir'),(38,'1988100110','2018-01-11','08:01:06','00:00:00','Hadir'),(39,'198810 0110','2018-01-12','08:17:13','00:00:00','Hadir'),(40,'1988100110','2018-01-15','08:19:25','00:00:00','Hadir'),(41,'1988100110','2018-01-16','08:21:31','00:00:00','Hadir'),(42,'1988100110','2018-01-17','08:33:36','00:00:00','Hadir'),(43,'1988100110','2018-01-18','08:35:42','00:00:00','Hadir'),(44,'1988100110','2018-01-19','08:45:59','00:00:00','Hadir'),(45,'1988100110','2018-01-22','08:51:15','00:00:00','Hadir'),(46,'2001122003','2017-11-01','08:54:44','00:00:00','Hadir'),(47,'2001122003','2017-11-02','08:19:56','00:00:00','Hadir'),(48,'2001122003','2017-11-03','08:36:03','00:00:00','Hadir'),(49,'2001122003','2017-11-10','08:39:04','00:00:00','Hadir'),(50,'2001122003','2017-11-13','08:49:16','00:00:00','Hadir'),(51,'2001122003','2017-11-14','08:55:26','00:00:00','Hadir'),(52,'2001122003','2017-11-15','08:20:34','00:00:00','Hadir'),(53,'2001122003','2017-11-16','08:03:40','00:00:00','Hadir'),(54,'2001122003','2017-11-17','08:13:47','00:00:00','Hadir'),(55,'2001122003','2017-11-20','08:24:54','00:00:00','Hadir'),(56,'2001122003','2017-11-21','08:37:02','00:00:00','Hadir'),(57,'2001122003','2017-11-22','08:48:11','00:00:00','Hadir'),(58,'2001122003','2017-11-23','08:46:19','00:00:00','Hadir'),(59,'2001122003','2017-11-24','08:25:27','00:00:00','Hadir'),(60,'2001122003','2017-11-27','08:19:35','00:00:00','Hadir'),(61,'2001122003','2017-11-28','08:41:41','00:00:00','Hadir'),(62,'2001122003','2017-11-29','08:39:46','00:00:00','Hadir'),(63,'2001122003','2017-11-30','08:54:56','00:00:00','Hadir'),(64,'2001122003','2017-12-04','08:55:15','00:00:00','Hadir'),(65,'2001122003','2017-12-05','08:27:22','00:00:00','Hadir'),(66,'2001122003','2017-12-06','08:10:31','00:00:00','Hadir'),(67,'2001122003','2017-12-07','08:22:43','00:00:00','Hadir'),(68,'2001122003','2017-12-08','08:23:50','00:00:00','Hadir'),(69,'2001122003','2017-12-11','08:34:02','00:00:00','Hadir'),(70,'2001122003','2017-12-12','08:43:08','00:00:00','Hadir'),(71,'2001122003','2017-12-13','08:33:15','00:00:00','Hadir'),(72,'2001122003','2017-12-14','08:45:21','00:00:00','Hadir'),(73,'2001122003','2017-12-15','08:06:35','00:00:00','Hadir'),(74,'2001122003','2018-01-02','08:08:51','00:00:00','Hadir'),(75,'2001122003','2018-01-03','08:20:57','00:00:00','Hadir'),(76,'2001122003','2018-01-04','08:32:03','00:00:00','Hadir'),(77,'2001122003','2018-01-05','08:38:09','00:00:00','Hadir'),(78,'2001122003','2018-01-08','08:26:15','00:00:00','Hadir'),(79,'2001122003','2018-01-09','08:54:25','00:00:00','Hadir'),(80,'2001122003','2018-01-10','08:58:32','00:00:00','Hadir'),(81,'2001122003','2018-01-11','08:54:52','00:00:00','Hadir'),(82,'2001122003','2018-01-12','08:04:00','00:00:00','Hadir'),(83,'2001122003','2018-01-15','08:31:08','00:00:00','Hadir'),(84,'2001122003','2018-01-16','08:33:16','00:00:00','Hadir'),(85,'2001122003','2018-01-17','08:06:22','00:00:00','Hadir'),(86,'2001122003','2018-01-18','08:15:31','00:00:00','Hadir'),(87,'2001122003','2018-01-19','08:18:38','00:00:00','Hadir'),(88,'2001122003','2018-01-22','08:20:48','00:00:00','Hadir');

#
# Structure for table "bidang"
#

DROP TABLE IF EXISTS `bidang`;
CREATE TABLE `bidang` (
  `IdBidang` int(11) NOT NULL AUTO_INCREMENT,
  `NamaBidang` varchar(30) DEFAULT NULL,
  `KepalaBagian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdBidang`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "bidang"
#

INSERT INTO `bidang` VALUES (8,'Seketariat','Ali. Mas\'udi'),(9,'Penetapan','Titus Toding'),(10,'Pendaftaran dan Pendataan','Roby Kepas Awi'),(11,'Penagihan dan Pembukuan','Margarheta Waromi'),(12,'PBB-P2 dan BPHTB','Adolfina Taniau');

#
# Structure for table "harilibur"
#

DROP TABLE IF EXISTS `harilibur`;
CREATE TABLE `harilibur` (
  `IdHari` int(11) NOT NULL AUTO_INCREMENT,
  `DariTgl` date DEFAULT NULL,
  `SampaiTgl` date DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdHari`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Data for table "harilibur"
#

INSERT INTO `harilibur` VALUES (1,'2017-12-24','2018-01-07','Libur Natal'),(2,'2017-11-04','2017-11-04','Sabtu'),(3,'2017-11-05','2017-11-05','Minggu'),(4,'2017-11-11','2017-11-11','Sabtu'),(5,'2017-11-12','2017-11-12','Minggu'),(6,'2017-11-18','2017-11-18','Sabtu'),(7,'2017-11-19','2017-11-19','Minggu'),(8,'2017-11-25','2017-11-25','Sabtu'),(9,'2017-11-26','2017-11-26','Minggu'),(10,'2017-12-01','2017-12-01','Maulid Nabi'),(11,'2017-12-02','2017-12-02','Sabtu'),(12,'2017-12-03','2017-12-03','Minggu'),(13,'2017-12-09','2017-12-09','Sabtu'),(14,'2017-12-10','2017-12-10','Minggu'),(15,'2017-12-16','2017-12-16','Sabtu'),(16,'2017-12-17','2017-12-17','Minggu'),(17,'2017-12-23','2017-12-23','Sabtu'),(18,'2017-12-24','2017-12-24','Minggu'),(19,'2017-12-30','2017-12-30','Sabtu'),(20,'2017-12-31','2017-12-31','Minggu'),(21,'2018-01-01','2018-01-01','Tahun Baru Masehi'),(22,'2018-01-06','2018-01-06','Sabtu'),(23,'2018-01-07','2018-01-07','Minggu'),(24,'2018-01-13','2018-01-13','Sabtu'),(25,'2018-01-14','2018-01-14','Minggu'),(26,'2018-01-20','2018-01-20','Sabtu'),(27,'2018-01-21','2018-01-21','Minggu'),(28,'2018-01-27','2018-01-27','Sabtu'),(29,'2018-01-28','2018-01-28','Minggu');

#
# Structure for table "keteranganabsen"
#

DROP TABLE IF EXISTS `keteranganabsen`;
CREATE TABLE `keteranganabsen` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nip` varchar(30) DEFAULT NULL,
  `Jenis` enum('Izin','Cuti','Sakit','DL') DEFAULT NULL,
  `TglPengajuan` date DEFAULT NULL,
  `TglMulai` date DEFAULT NULL,
  `TglSelesai` date DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "keteranganabsen"
#

INSERT INTO `keteranganabsen` VALUES (1,'19822102003','Izin','2017-11-01','2017-11-02','2017-11-08','Kepentingan Keluarga'),(2,'1988100110','Sakit','2017-12-04','2017-12-04','2017-12-07','Sakit'),(3,'2003122008','DL','2018-01-03','2018-01-05','2018-01-11','Dinas Luar');

#
# Structure for table "pegawai"
#

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `Nip` varchar(30) NOT NULL DEFAULT '',
  `Nama` varchar(50) NOT NULL DEFAULT '',
  `Alamat` varchar(255) DEFAULT NULL,
  `Kontak` varchar(14) NOT NULL DEFAULT '',
  `Sex` enum('L','P') NOT NULL DEFAULT 'L',
  `IdBidang` int(11) DEFAULT NULL,
  `Jabatan` varchar(255) DEFAULT NULL,
  `Pangkat` varchar(5) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "pegawai"
#

INSERT INTO `pegawai` VALUES ('121347384738','Setiyo Rini','Tanah Hitam','082248813836','P',8,'Admin','III/a','rinisaja@gmail.com','25d55ad283aa400af464c76d713c07ad'),('19822102003','Margarheta Waromi','Polimak','082198179737','P',11,'Kepala Bidang','III/d','Waromi@gmail.com','25d55ad283aa400af464c76d713c07ad'),('1988100110','Titus Toding','Apo Kali','08234517816','L',9,'Kepala Bidang','IV/a','Titus@gmail.com','25d55ad283aa400af464c76d713c07ad'),('1997031004','Asis','Kotaraja Jayapura','082199563342','L',10,'Staf','III/c','Asis@gmail.com','25d55ad283aa400af464c76d713c07ad'),('2001122003','Agustina Afaar','Argapura','085244168657','P',12,'Kasi. BPHTB','III/c','Agus@gmail.com','25d55ad283aa400af464c76d713c07ad'),('2003122008','Yanthi S','Kotaraja Dalam','081344452432','P',8,'Staff','III/c','Yanthi@gmail.com','25d55ad283aa400af464c76d713c07ad');

#
# Structure for table "perangkat"
#

DROP TABLE IF EXISTS `perangkat`;
CREATE TABLE `perangkat` (
  `IdPerangkat` int(11) NOT NULL AUTO_INCREMENT,
  `Nip` varchar(30) NOT NULL DEFAULT '',
  `MacAddress` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdPerangkat`,`Nip`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "perangkat"
#

INSERT INTO `perangkat` VALUES (4,'121347384738','3c-b6-b7-1d-6f-ed'),(5,'1988100110','30-cb-f8-e3-c9-af'),(6,'19822102003','70-78-8b-c6-6d-37'),(7,'1997031004','20-72-0d-39-09-cc'),(8,'2001122003','30-c7-AE-76-2E-ED');

# Host: localhost  (Version 5.5.8)
# Date: 2017-12-24 17:54:18
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "bidang"
#

DROP TABLE IF EXISTS `bidang`;
CREATE TABLE `bidang` (
  `IdBidang` int(11) NOT NULL AUTO_INCREMENT,
  `NamaBidang` varchar(30) DEFAULT NULL,
  `KepalaBagian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdBidang`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "bidang"
#

INSERT INTO `bidang` VALUES (8,'Kepegawaian','Candra Putra Wijaksana'),(9,'Humas','Yaqin'),(10,'Umum','Wahyu'),(11,'Sekertaris','Husen');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

#
# Data for table "harilibur"
#

INSERT INTO `harilibur` VALUES (8,'2017-12-03','2017-12-03','Hari Minggu'),(9,'2017-12-10','2017-12-10','Hari Minggu'),(10,'2017-12-17','2017-12-17','Hari Minggu'),(11,'2017-12-24','2017-12-24','Hari Minggu'),(12,'2017-12-31','2017-12-31','Hari Minggu'),(13,'2017-12-02','2017-12-02','Hari Sabtu'),(14,'2017-12-09','2017-12-09','Hari Sabtu'),(15,'2017-12-16','2017-12-16','Hari Sabtu'),(16,'2017-12-23','2017-12-23','Hari Sabtu'),(17,'2017-12-30','2017-12-30','Hari Sabtu'),(18,'2017-12-21','2017-12-22','Libur Natal'),(19,'2017-12-25','2017-12-27','Libur Natal'),(20,'2018-01-01','2018-01-05','Libur Tahun Baru'),(21,'2018-01-07','2018-01-07','Hari Minggu');

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
  PRIMARY KEY (`Nip`),
  KEY `IdBidang` (`IdBidang`),
  CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`IdBidang`) REFERENCES `bidang` (`IdBidang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "pegawai"
#

INSERT INTO `pegawai` VALUES ('121347384738','Ajenkris Y. Kungkung','Tanah Hitam','082238281801','L',8,'Admin','III/a','kristt26@gmail.com','25d55ad283aa400af464c76d713c07ad'),('247529874927','Wahyu Sidiq A. Prakoso','Entrop','08472937423','L',9,'Staff','III/a','wahyu@gmail.com','25d55ad283aa400af464c76d713c07ad'),('435634563','Candra Kampret','Tanah Hitam','0173412346612','L',8,'Staff','III/a','candra@kampret.com','25d55ad283aa400af464c76d713c07ad');

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
  PRIMARY KEY (`Id`),
  KEY `Pegawai` (`Nip`),
  CONSTRAINT `Pegawai` FOREIGN KEY (`Nip`) REFERENCES `pegawai` (`Nip`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "keteranganabsen"
#

INSERT INTO `keteranganabsen` VALUES (2,'121347384738','Izin','2017-12-04','2017-12-05','2017-12-08','Urusan Keluarga'),(3,'121347384738','Cuti','2017-12-15','2017-12-19','2017-12-20','Cuti Hari Raya');

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
  PRIMARY KEY (`IdAbsen`),
  KEY `Nip` (`Nip`),
  CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`Nip`) REFERENCES `pegawai` (`Nip`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "absen"
#

INSERT INTO `absen` VALUES (1,'121347384738','2017-12-13','07:03:33','12:42:39','Hadir'),(4,'121347384738','2017-12-14','07:45:13','12:45:53','Hadir'),(5,'435634563','2017-12-15','07:15:06','15:18:26','Hadir'),(6,'247529874927','2017-12-15','07:16:51','15:18:52','Hadir'),(7,'121347384738','2017-12-15','07:17:30','15:17:48','Hadir'),(8,'247529874927','2017-12-18','07:19:22','15:21:24','Hadir'),(9,'121347384738','2017-12-18','07:19:53','15:21:01','Hadir'),(10,'435634563','2017-12-18','07:20:15','15:20:27','Hadir');

#
# Structure for table "perangkat"
#

DROP TABLE IF EXISTS `perangkat`;
CREATE TABLE `perangkat` (
  `IdPerangkat` int(11) NOT NULL AUTO_INCREMENT,
  `Nip` varchar(30) NOT NULL DEFAULT '',
  `MacAddress` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdPerangkat`,`Nip`),
  KEY `Nip` (`Nip`),
  CONSTRAINT `perangkat_ibfk_1` FOREIGN KEY (`Nip`) REFERENCES `pegawai` (`Nip`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "perangkat"
#

INSERT INTO `perangkat` VALUES (1,'435634563',NULL),(2,'121347384738',NULL),(3,'247529874927','58-48-22-50-aa-e9');

/*
Navicat MySQL Data Transfer

Source Server         : Server Local
Source Server Version : 50532
Source Host           : 127.0.0.1:3306
Source Database       : pariwisata

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-10-19 10:18:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user` text NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_view_password` varchar(100) DEFAULT NULL,
  `admin_hak_akses` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 'admin1', '1');

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `berita_id` int(11) NOT NULL AUTO_INCREMENT,
  `berita_judul` text NOT NULL,
  `berita_deskripsi` text NOT NULL,
  `berita_tgl` date NOT NULL,
  `berita_autor` text NOT NULL,
  `berita_foto` varchar(100) NOT NULL,
  `berita_tag` text NOT NULL,
  PRIMARY KEY (`berita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of berita
-- ----------------------------

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_judul` text NOT NULL,
  `event_foto` varchar(100) NOT NULL,
  `event_penyelenggara` text NOT NULL,
  `event_tgl_pelaksanaan` date NOT NULL,
  `event_deskripsi` text NOT NULL,
  `event_url_file_jadwal` varchar(100) NOT NULL,
  `event_tag` text NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event
-- ----------------------------

-- ----------------------------
-- Table structure for fasilitas_pendukung
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas_pendukung`;
CREATE TABLE `fasilitas_pendukung` (
  `faspen_id` int(11) NOT NULL AUTO_INCREMENT,
  `faspen_nama` text NOT NULL,
  `faspen_icon` varchar(100) NOT NULL,
  PRIMARY KEY (`faspen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fasilitas_pendukung
-- ----------------------------

-- ----------------------------
-- Table structure for fasilitas_wisata
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas_wisata`;
CREATE TABLE `fasilitas_wisata` (
  `faswis_id` int(11) NOT NULL AUTO_INCREMENT,
  `faswis_nama` text NOT NULL,
  `faswis_icon` varchar(100) NOT NULL,
  PRIMARY KEY (`faswis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fasilitas_wisata
-- ----------------------------

-- ----------------------------
-- Table structure for foto
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_file_foto` varchar(100) NOT NULL,
  `wisata_id` int(11) NOT NULL,
  PRIMARY KEY (`foto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of foto
-- ----------------------------

-- ----------------------------
-- Table structure for info
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `info_tahun` int(11) NOT NULL AUTO_INCREMENT,
  `info_jum_lokal` int(11) NOT NULL,
  `info_jum_manca` int(11) NOT NULL,
  `info_pendapatan` int(11) NOT NULL,
  PRIMARY KEY (`info_tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of info
-- ----------------------------

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `wisata_id` int(11) NOT NULL,
  `kategori_nama` text NOT NULL,
  `kategori_icon` text NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kategori
-- ----------------------------

-- ----------------------------
-- Table structure for komentar
-- ----------------------------
DROP TABLE IF EXISTS `komentar`;
CREATE TABLE `komentar` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `komentar_ip` text NOT NULL,
  `komentar_deskripsi` text NOT NULL,
  `komentar_tgl` date NOT NULL,
  `komentar_nilai_rating` double NOT NULL,
  `wisata_id` int(11) NOT NULL,
  PRIMARY KEY (`komentar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of komentar
-- ----------------------------

-- ----------------------------
-- Table structure for mainmenu
-- ----------------------------
DROP TABLE IF EXISTS `mainmenu`;
CREATE TABLE `mainmenu` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `idmenu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `active_menu` varchar(50) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `link_menu` varchar(50) NOT NULL,
  `menu_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mainmenu
-- ----------------------------
INSERT INTO `mainmenu` VALUES ('1', '1', 'Dashboard', '', 'menu-icon fa fa-dashboard', 'Home', '', '2017-10-19 10:15:39', null);

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) NOT NULL,
  `mainmenu_idmenu` int(11) NOT NULL,
  `active_sub` varchar(20) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `link_sub` varchar(50) NOT NULL,
  `sub_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of submenu
-- ----------------------------

-- ----------------------------
-- Table structure for tab_akses_mainmenu
-- ----------------------------
DROP TABLE IF EXISTS `tab_akses_mainmenu`;
CREATE TABLE `tab_akses_mainmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tab_akses_mainmenu
-- ----------------------------
INSERT INTO `tab_akses_mainmenu` VALUES ('1', '1', '1', null, '1', null, null, '2017-09-25 11:49:01', 'direktur');

-- ----------------------------
-- Table structure for tab_akses_submenu
-- ----------------------------
DROP TABLE IF EXISTS `tab_akses_submenu`;
CREATE TABLE `tab_akses_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tab_akses_submenu
-- ----------------------------

-- ----------------------------
-- Table structure for user_type
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES ('1', 'Administrator');

-- ----------------------------
-- Table structure for wahana
-- ----------------------------
DROP TABLE IF EXISTS `wahana`;
CREATE TABLE `wahana` (
  `wahana_id` int(11) NOT NULL AUTO_INCREMENT,
  `wahana_nama` text NOT NULL,
  `wahana_icon` varchar(100) NOT NULL,
  `wahana_deskripsi` text NOT NULL,
  PRIMARY KEY (`wahana_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wahana
-- ----------------------------

-- ----------------------------
-- Table structure for wahana_wisata
-- ----------------------------
DROP TABLE IF EXISTS `wahana_wisata`;
CREATE TABLE `wahana_wisata` (
  `wahwis_id` int(11) NOT NULL AUTO_INCREMENT,
  `wahana_id` int(11) NOT NULL,
  `wisata_id` int(11) NOT NULL,
  `wahwis_htm` varchar(20) NOT NULL,
  PRIMARY KEY (`wahwis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wahana_wisata
-- ----------------------------

-- ----------------------------
-- Table structure for wisata
-- ----------------------------
DROP TABLE IF EXISTS `wisata`;
CREATE TABLE `wisata` (
  `wisata_id` int(11) NOT NULL AUTO_INCREMENT,
  `wisata_url_video` text NOT NULL,
  `wisata_nama` text NOT NULL,
  `wisata_deskripsi` text NOT NULL,
  `wisata_tag` text NOT NULL,
  `wisata_htm_lokal` varchar(20) NOT NULL,
  `wisata_htm_intl` varchar(20) NOT NULL,
  `wisata_latitude` varchar(50) NOT NULL,
  `wisata_longitude` varchar(50) NOT NULL,
  `wisata_tampil` int(11) NOT NULL,
  PRIMARY KEY (`wisata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata
-- ----------------------------

-- ----------------------------
-- Table structure for wisata_berfasilitas
-- ----------------------------
DROP TABLE IF EXISTS `wisata_berfasilitas`;
CREATE TABLE `wisata_berfasilitas` (
  `wistas_id` int(11) NOT NULL AUTO_INCREMENT,
  `wisata_id` int(11) NOT NULL,
  `faswis_id` int(11) NOT NULL,
  `wistas_status` text NOT NULL,
  PRIMARY KEY (`wistas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata_berfasilitas
-- ----------------------------

-- ----------------------------
-- Table structure for wisata_berpendukung
-- ----------------------------
DROP TABLE IF EXISTS `wisata_berpendukung`;
CREATE TABLE `wisata_berpendukung` (
  `wiskung_id` int(11) NOT NULL AUTO_INCREMENT,
  `wisata_id` int(11) NOT NULL,
  `faspen_id` int(11) NOT NULL,
  `wiskung_nama` varchar(100) NOT NULL,
  `wiskung_alamat` text NOT NULL,
  `wiskung_telp` varchar(50) NOT NULL,
  `wiskung_website` varchar(50) NOT NULL,
  `wiskung_latitude` varchar(50) NOT NULL,
  `wiskung_longitude` varchar(50) NOT NULL,
  `wiskung_url_foto` text NOT NULL,
  PRIMARY KEY (`wiskung_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata_berpendukung
-- ----------------------------

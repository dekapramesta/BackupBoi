/*
Navicat MySQL Data Transfer

Source Server         : Server Local
Source Server Version : 50532
Source Host           : 127.0.0.1:3306
Source Database       : pariwisata

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-10-28 12:32:08
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of berita
-- ----------------------------
INSERT INTO `berita` VALUES ('1', 'Ashanti Buka Objek Wisata Baru di Kepanjen', 'Artis Ibukota Ashanti Hermansyah telah membulatkan niatnya untuk membuka tempat wisata', '2016-10-19', 'edwin', 'home1.jpg', 'ashanti Wisataahanti');
INSERT INTO `berita` VALUES ('2', 'Tragedi di Pantai Balekambang', 'Tragedi di Pantai Balekambang', '2017-10-19', 'edwin', 'home1.jpg', 'balekambang savebalekambang');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES ('1', 'Festival Layang - Layang Kepanjen', '1.jpg', ' Festival Layang - Layang Kepanjen adalah sebuah event yang diselenggarakan', '2017-10-28', 'Festival Layang - Layang Kepanjen ', '', 'layangan');
INSERT INTO `event` VALUES ('2', 'Malang Batik Parade 2017', '2.jpg', 'Malang Batik Parade 2017 adalah sebuah event yang diselenggarakan', '2017-10-25', 'Malang Batik Parade 2017', '', 'batik');

-- ----------------------------
-- Table structure for fasilitas_pendukung
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas_pendukung`;
CREATE TABLE `fasilitas_pendukung` (
  `faspen_id` int(11) NOT NULL AUTO_INCREMENT,
  `faspen_nama` text NOT NULL,
  `faspen_icon` varchar(100) NOT NULL,
  PRIMARY KEY (`faspen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fasilitas_pendukung
-- ----------------------------
INSERT INTO `fasilitas_pendukung` VALUES ('1', 'adda', 'asasase.jpg');

-- ----------------------------
-- Table structure for fasilitas_wisata
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas_wisata`;
CREATE TABLE `fasilitas_wisata` (
  `faswis_id` int(11) NOT NULL AUTO_INCREMENT,
  `faswis_nama` text NOT NULL,
  `faswis_icon` varchar(100) NOT NULL,
  PRIMARY KEY (`faswis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fasilitas_wisata
-- ----------------------------
INSERT INTO `fasilitas_wisata` VALUES ('1', 'KEAMANAN', 'awe-icon awe-icon-key');
INSERT INTO `fasilitas_wisata` VALUES ('2', 'KLINIK KESEHATAN', 'awe-icon awe-icon-briefcase-plus');
INSERT INTO `fasilitas_wisata` VALUES ('3', 'LOKER/PENITIPAN BARANG', 'awe-icon awe-icon-culture');
INSERT INTO `fasilitas_wisata` VALUES ('4', 'PARKIR', 'awe-icon awe-icon-car');
INSERT INTO `fasilitas_wisata` VALUES ('5', 'PENGINAPAN', 'awe-icon awe-icon-bed');
INSERT INTO `fasilitas_wisata` VALUES ('6', 'SOUVENIR SHOP', 'awe-icon awe-icon-cart');
INSERT INTO `fasilitas_wisata` VALUES ('7', 'TEMPAT IBADAH', 'awe-icon awe-icon-culture');
INSERT INTO `fasilitas_wisata` VALUES ('8', 'TEMPAT MAKAN', 'awe-icon awe-icon-food');
INSERT INTO `fasilitas_wisata` VALUES ('9', 'TOILET', 'awe-icon awe-icon-shower');
INSERT INTO `fasilitas_wisata` VALUES ('10', 'TOUR GUIDE', 'awe-icon awe-icon-antarctica');
INSERT INTO `fasilitas_wisata` VALUES ('11', 'TOURIST INFORMATION', 'awe-icon awe-icon-antarctica');

-- ----------------------------
-- Table structure for foto
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_file_foto` varchar(100) NOT NULL,
  `wisata_id` int(11) NOT NULL,
  PRIMARY KEY (`foto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of foto
-- ----------------------------
INSERT INTO `foto` VALUES ('1', '_DSC2653 (FILEminimizer).JPG', '48');
INSERT INTO `foto` VALUES ('2', '_DSC2659 (FILEminimizer).JPG', '48');
INSERT INTO `foto` VALUES ('3', '_DSC2660 (FILEminimizer).JPG', '48');
INSERT INTO `foto` VALUES ('4', 'DSC03068 (FILEminimizer).JPG', '48');
INSERT INTO `foto` VALUES ('5', 'DSC03083 (FILEminimizer).JPG', '48');
INSERT INTO `foto` VALUES ('6', '_DSC2653 (FILEminimizer).JPG', '49');
INSERT INTO `foto` VALUES ('7', '_DSC2659 (FILEminimizer).JPG', '49');
INSERT INTO `foto` VALUES ('8', '_DSC2660 (FILEminimizer).JPG', '49');
INSERT INTO `foto` VALUES ('9', 'DSC03068 (FILEminimizer).JPG', '49');
INSERT INTO `foto` VALUES ('10', 'DSC03083 (FILEminimizer).JPG', '49');
INSERT INTO `foto` VALUES ('11', '_DSC2808 (FILEminimizer).JPG', '64');
INSERT INTO `foto` VALUES ('12', 'DSC03393 (FILEminimizer).JPG', '64');
INSERT INTO `foto` VALUES ('13', 'DSC03403 (FILEminimizer).JPG', '64');
INSERT INTO `foto` VALUES ('14', 'DSC03405 (FILEminimizer).JPG', '64');
INSERT INTO `foto` VALUES ('15', 'DSC03420 (FILEminimizer).JPG', '64');
INSERT INTO `foto` VALUES ('16', 'DSC02923 (FILEminimizer).JPG', '31');
INSERT INTO `foto` VALUES ('17', 'DSC02928 (FILEminimizer).JPG', '31');
INSERT INTO `foto` VALUES ('18', 'DSC02932 (FILEminimizer).JPG', '31');
INSERT INTO `foto` VALUES ('19', 'DSC02937 (FILEminimizer).JPG', '31');
INSERT INTO `foto` VALUES ('20', 'DSC02952 (FILEminimizer).JPG', '31');
INSERT INTO `foto` VALUES ('21', 'DSC02923 (FILEminimizer).JPG', '32');
INSERT INTO `foto` VALUES ('22', 'DSC02928 (FILEminimizer).JPG', '32');
INSERT INTO `foto` VALUES ('23', 'DSC02932 (FILEminimizer).JPG', '32');
INSERT INTO `foto` VALUES ('24', 'DSC02937 (FILEminimizer).JPG', '32');
INSERT INTO `foto` VALUES ('25', 'DSC02952 (FILEminimizer).JPG', '32');
INSERT INTO `foto` VALUES ('26', 'DSC02690 (FILEminimizer).JPG', '14');
INSERT INTO `foto` VALUES ('27', 'DSC02696 (FILEminimizer).JPG', '14');
INSERT INTO `foto` VALUES ('28', 'DSC02698 (FILEminimizer).JPG', '14');
INSERT INTO `foto` VALUES ('29', 'DSC02702 (FILEminimizer).JPG', '14');
INSERT INTO `foto` VALUES ('30', 'DSC02709 (FILEminimizer).JPG', '14');
INSERT INTO `foto` VALUES ('31', 'DSC02690 (FILEminimizer).JPG', '15');
INSERT INTO `foto` VALUES ('32', 'DSC02696 (FILEminimizer).JPG', '15');
INSERT INTO `foto` VALUES ('33', 'DSC02698 (FILEminimizer).JPG', '15');
INSERT INTO `foto` VALUES ('34', 'DSC02702 (FILEminimizer).JPG', '15');
INSERT INTO `foto` VALUES ('35', 'DSC02709 (FILEminimizer).JPG', '15');
INSERT INTO `foto` VALUES ('36', 'DSC02690 (FILEminimizer).JPG', '16');
INSERT INTO `foto` VALUES ('37', 'DSC02696 (FILEminimizer).JPG', '16');
INSERT INTO `foto` VALUES ('38', 'DSC02698 (FILEminimizer).JPG', '16');
INSERT INTO `foto` VALUES ('39', 'DSC02702 (FILEminimizer).JPG', '16');
INSERT INTO `foto` VALUES ('40', 'DSC02709 (FILEminimizer).JPG', '16');
INSERT INTO `foto` VALUES ('41', 'DSC02670 (FILEminimizer).JPG', '11');
INSERT INTO `foto` VALUES ('42', 'DSC02674 (FILEminimizer).JPG', '11');
INSERT INTO `foto` VALUES ('43', 'DSC02677 (FILEminimizer).JPG', '11');
INSERT INTO `foto` VALUES ('44', 'DSC02687 (FILEminimizer).JPG', '11');
INSERT INTO `foto` VALUES ('45', 'DSC02688 (FILEminimizer).JPG', '11');
INSERT INTO `foto` VALUES ('46', 'DSC02670 (FILEminimizer).JPG', '12');
INSERT INTO `foto` VALUES ('47', 'DSC02674 (FILEminimizer).JPG', '12');
INSERT INTO `foto` VALUES ('48', 'DSC02677 (FILEminimizer).JPG', '12');
INSERT INTO `foto` VALUES ('49', 'DSC02687 (FILEminimizer).JPG', '12');
INSERT INTO `foto` VALUES ('50', 'DSC02688 (FILEminimizer).JPG', '12');
INSERT INTO `foto` VALUES ('51', 'DSC02670 (FILEminimizer).JPG', '13');
INSERT INTO `foto` VALUES ('52', 'DSC02674 (FILEminimizer).JPG', '13');
INSERT INTO `foto` VALUES ('53', 'DSC02677 (FILEminimizer).JPG', '13');
INSERT INTO `foto` VALUES ('54', 'DSC02687 (FILEminimizer).JPG', '13');
INSERT INTO `foto` VALUES ('55', 'DSC02688 (FILEminimizer).JPG', '13');
INSERT INTO `foto` VALUES ('56', 'DSC03027 (FILEminimizer).JPG', '42');
INSERT INTO `foto` VALUES ('57', 'DSC03030 (FILEminimizer).JPG', '42');
INSERT INTO `foto` VALUES ('58', 'DSC03033 (FILEminimizer).JPG', '42');
INSERT INTO `foto` VALUES ('59', 'DSC03036 (FILEminimizer).JPG', '42');
INSERT INTO `foto` VALUES ('60', 'DSC03044 (FILEminimizer).JPG', '42');
INSERT INTO `foto` VALUES ('61', 'DSC03027 (FILEminimizer).JPG', '43');
INSERT INTO `foto` VALUES ('62', 'DSC03030 (FILEminimizer).JPG', '43');
INSERT INTO `foto` VALUES ('63', 'DSC03033 (FILEminimizer).JPG', '43');
INSERT INTO `foto` VALUES ('64', 'DSC03036 (FILEminimizer).JPG', '43');
INSERT INTO `foto` VALUES ('65', 'DSC03044 (FILEminimizer).JPG', '43');
INSERT INTO `foto` VALUES ('66', 'DSC03027 (FILEminimizer).JPG', '44');
INSERT INTO `foto` VALUES ('67', 'DSC03030 (FILEminimizer).JPG', '44');
INSERT INTO `foto` VALUES ('68', 'DSC03033 (FILEminimizer).JPG', '44');
INSERT INTO `foto` VALUES ('69', 'DSC03036 (FILEminimizer).JPG', '44');
INSERT INTO `foto` VALUES ('70', 'DSC03044 (FILEminimizer).JPG', '44');
INSERT INTO `foto` VALUES ('71', '_DSC2777 (FILEminimizer).JPG', '60');
INSERT INTO `foto` VALUES ('72', 'a.JPG', '60');
INSERT INTO `foto` VALUES ('73', 'b.JPG', '60');
INSERT INTO `foto` VALUES ('74', 'c.JPG', '60');
INSERT INTO `foto` VALUES ('75', 'd.JPG', '60');
INSERT INTO `foto` VALUES ('76', '_DSC2664 (FILEminimizer).JPG', '53');
INSERT INTO `foto` VALUES ('77', '_DSC2672 (FILEminimizer).JPG', '53');
INSERT INTO `foto` VALUES ('78', 'DJI_0112 (FILEminimizer).JPG', '53');
INSERT INTO `foto` VALUES ('79', 'DSC03134 (FILEminimizer).JPG', '53');
INSERT INTO `foto` VALUES ('80', 'DSC03178 (FILEminimizer).JPG', '53');
INSERT INTO `foto` VALUES ('81', 'DSC02636 (FILEminimizer).JPG', '10');
INSERT INTO `foto` VALUES ('82', 'DSC02639 (FILEminimizer).JPG', '10');
INSERT INTO `foto` VALUES ('83', 'DSC02641 (FILEminimizer).JPG', '10');
INSERT INTO `foto` VALUES ('84', 'DSC02650 (FILEminimizer).JPG', '10');
INSERT INTO `foto` VALUES ('85', 'DSC02660 (FILEminimizer).JPG', '10');
INSERT INTO `foto` VALUES ('86', '_DSC2619 (FILEminimizer).JPG', '33');
INSERT INTO `foto` VALUES ('87', 'DSC02968 (FILEminimizer).JPG', '33');
INSERT INTO `foto` VALUES ('88', 'DSC02975 (FILEminimizer).JPG', '33');
INSERT INTO `foto` VALUES ('89', 'DSC02992 (FILEminimizer).JPG', '33');
INSERT INTO `foto` VALUES ('90', 'DSC02999 (FILEminimizer).JPG', '33');
INSERT INTO `foto` VALUES ('91', '_DSC2619 (FILEminimizer).JPG', '34');
INSERT INTO `foto` VALUES ('92', 'DSC02968 (FILEminimizer).JPG', '34');
INSERT INTO `foto` VALUES ('93', 'DSC02975 (FILEminimizer).JPG', '34');
INSERT INTO `foto` VALUES ('94', 'DSC02992 (FILEminimizer).JPG', '34');
INSERT INTO `foto` VALUES ('95', 'DSC02999 (FILEminimizer).JPG', '34');
INSERT INTO `foto` VALUES ('96', '_DSC2619 (FILEminimizer).JPG', '35');
INSERT INTO `foto` VALUES ('97', 'DSC02968 (FILEminimizer).JPG', '35');
INSERT INTO `foto` VALUES ('98', 'DSC02975 (FILEminimizer).JPG', '35');
INSERT INTO `foto` VALUES ('99', 'DSC02992 (FILEminimizer).JPG', '35');
INSERT INTO `foto` VALUES ('100', 'DSC02999 (FILEminimizer).JPG', '35');
INSERT INTO `foto` VALUES ('101', '_DSC2619 (FILEminimizer).JPG', '36');
INSERT INTO `foto` VALUES ('102', 'DSC02968 (FILEminimizer).JPG', '36');
INSERT INTO `foto` VALUES ('103', 'DSC02975 (FILEminimizer).JPG', '36');
INSERT INTO `foto` VALUES ('104', 'DSC02992 (FILEminimizer).JPG', '36');
INSERT INTO `foto` VALUES ('105', 'DSC02999 (FILEminimizer).JPG', '36');
INSERT INTO `foto` VALUES ('106', '_DSC2619 (FILEminimizer).JPG', '37');
INSERT INTO `foto` VALUES ('107', 'DSC02968 (FILEminimizer).JPG', '37');
INSERT INTO `foto` VALUES ('108', 'DSC02975 (FILEminimizer).JPG', '37');
INSERT INTO `foto` VALUES ('109', 'DSC02992 (FILEminimizer).JPG', '37');
INSERT INTO `foto` VALUES ('110', 'DSC02999 (FILEminimizer).JPG', '37');
INSERT INTO `foto` VALUES ('111', '_DSC2619 (FILEminimizer).JPG', '38');
INSERT INTO `foto` VALUES ('112', 'DSC02968 (FILEminimizer).JPG', '38');
INSERT INTO `foto` VALUES ('113', 'DSC02975 (FILEminimizer).JPG', '38');
INSERT INTO `foto` VALUES ('114', 'DSC02992 (FILEminimizer).JPG', '38');
INSERT INTO `foto` VALUES ('115', 'DSC02999 (FILEminimizer).JPG', '38');
INSERT INTO `foto` VALUES ('116', '_DSC2619 (FILEminimizer).JPG', '39');
INSERT INTO `foto` VALUES ('117', 'DSC02968 (FILEminimizer).JPG', '39');
INSERT INTO `foto` VALUES ('118', 'DSC02975 (FILEminimizer).JPG', '39');
INSERT INTO `foto` VALUES ('119', 'DSC02992 (FILEminimizer).JPG', '39');
INSERT INTO `foto` VALUES ('120', 'DSC02999 (FILEminimizer).JPG', '39');
INSERT INTO `foto` VALUES ('121', '_DSC2619 (FILEminimizer).JPG', '40');
INSERT INTO `foto` VALUES ('122', 'DSC02968 (FILEminimizer).JPG', '40');
INSERT INTO `foto` VALUES ('123', 'DSC02975 (FILEminimizer).JPG', '40');
INSERT INTO `foto` VALUES ('124', 'DSC02992 (FILEminimizer).JPG', '40');
INSERT INTO `foto` VALUES ('125', 'DSC02999 (FILEminimizer).JPG', '40');
INSERT INTO `foto` VALUES ('126', 'DSC03197 (FILEminimizer).JPG', '54');
INSERT INTO `foto` VALUES ('127', 'DSC03210 (FILEminimizer).JPG', '54');
INSERT INTO `foto` VALUES ('128', 'DSC03219 (FILEminimizer).JPG', '54');
INSERT INTO `foto` VALUES ('129', 'DSC03223 (FILEminimizer).JPG', '54');
INSERT INTO `foto` VALUES ('130', 'DSC03225 (FILEminimizer).JPG', '54');
INSERT INTO `foto` VALUES ('131', 'DSC02615 (FILEminimizer).JPG', '7');
INSERT INTO `foto` VALUES ('132', 'DSC02622 (FILEminimizer).JPG', '7');
INSERT INTO `foto` VALUES ('133', 'DSC02625 (FILEminimizer).JPG', '7');
INSERT INTO `foto` VALUES ('134', 'DSC02626 (FILEminimizer).JPG', '7');
INSERT INTO `foto` VALUES ('135', 'DSC02631 (FILEminimizer).JPG', '7');
INSERT INTO `foto` VALUES ('136', 'DSC02615 (FILEminimizer).JPG', '8');
INSERT INTO `foto` VALUES ('137', 'DSC02622 (FILEminimizer).JPG', '8');
INSERT INTO `foto` VALUES ('138', 'DSC02625 (FILEminimizer).JPG', '8');
INSERT INTO `foto` VALUES ('139', 'DSC02626 (FILEminimizer).JPG', '8');
INSERT INTO `foto` VALUES ('140', 'DSC02631 (FILEminimizer).JPG', '8');
INSERT INTO `foto` VALUES ('141', 'DSC02615 (FILEminimizer).JPG', '9');
INSERT INTO `foto` VALUES ('142', 'DSC02622 (FILEminimizer).JPG', '9');
INSERT INTO `foto` VALUES ('143', 'DSC02625 (FILEminimizer).JPG', '9');
INSERT INTO `foto` VALUES ('144', 'DSC02626 (FILEminimizer).JPG', '9');
INSERT INTO `foto` VALUES ('145', 'DSC02631 (FILEminimizer).JPG', '9');
INSERT INTO `foto` VALUES ('146', 'DSC03284 (FILEminimizer).JPG', '59');
INSERT INTO `foto` VALUES ('147', 'DSC03285 (FILEminimizer).JPG', '59');
INSERT INTO `foto` VALUES ('148', 'DSC03286 (FILEminimizer).JPG', '59');
INSERT INTO `foto` VALUES ('149', 'DSC03289 (FILEminimizer).JPG', '59');
INSERT INTO `foto` VALUES ('150', 'DSC03291 (FILEminimizer).JPG', '59');
INSERT INTO `foto` VALUES ('151', '_DSC2823 (FILEminimizer).JPG', '65');
INSERT INTO `foto` VALUES ('152', '_DSC2828 (FILEminimizer).JPG', '65');
INSERT INTO `foto` VALUES ('153', 'DSC03426 (FILEminimizer).JPG', '65');
INSERT INTO `foto` VALUES ('154', 'DSC03428 (FILEminimizer).JPG', '65');
INSERT INTO `foto` VALUES ('155', 'DSC03436 (FILEminimizer).JPG', '65');
INSERT INTO `foto` VALUES ('156', '_DSC2823 (FILEminimizer).JPG', '66');
INSERT INTO `foto` VALUES ('157', '_DSC2828 (FILEminimizer).JPG', '66');
INSERT INTO `foto` VALUES ('158', 'DSC03426 (FILEminimizer).JPG', '66');
INSERT INTO `foto` VALUES ('159', 'DSC03428 (FILEminimizer).JPG', '66');
INSERT INTO `foto` VALUES ('160', 'DSC03436 (FILEminimizer).JPG', '66');
INSERT INTO `foto` VALUES ('161', '_DSC2823 (FILEminimizer).JPG', '67');
INSERT INTO `foto` VALUES ('162', '_DSC2828 (FILEminimizer).JPG', '67');
INSERT INTO `foto` VALUES ('163', 'DSC03426 (FILEminimizer).JPG', '67');
INSERT INTO `foto` VALUES ('164', 'DSC03428 (FILEminimizer).JPG', '67');
INSERT INTO `foto` VALUES ('165', 'DSC03436 (FILEminimizer).JPG', '67');
INSERT INTO `foto` VALUES ('166', 'DSC02845 (FILEminimizer).JPG', '24');
INSERT INTO `foto` VALUES ('167', 'DSC02856 (FILEminimizer).JPG', '24');
INSERT INTO `foto` VALUES ('168', 'DSC02859 (FILEminimizer).JPG', '24');
INSERT INTO `foto` VALUES ('169', 'DSC02860 (FILEminimizer).JPG', '24');
INSERT INTO `foto` VALUES ('170', 'DSC02863 (FILEminimizer).JPG', '24');
INSERT INTO `foto` VALUES ('171', 'DSC02845 (FILEminimizer).JPG', '25');
INSERT INTO `foto` VALUES ('172', 'DSC02856 (FILEminimizer).JPG', '25');
INSERT INTO `foto` VALUES ('173', 'DSC02859 (FILEminimizer).JPG', '25');
INSERT INTO `foto` VALUES ('174', 'DSC02860 (FILEminimizer).JPG', '25');
INSERT INTO `foto` VALUES ('175', 'DSC02863 (FILEminimizer).JPG', '25');
INSERT INTO `foto` VALUES ('176', 'DSC02876 (FILEminimizer).JPG', '26');
INSERT INTO `foto` VALUES ('177', 'DSC02881 (FILEminimizer).JPG', '26');
INSERT INTO `foto` VALUES ('178', 'DSC02893 (FILEminimizer).JPG', '26');
INSERT INTO `foto` VALUES ('179', 'DSC02896 (FILEminimizer).JPG', '26');
INSERT INTO `foto` VALUES ('180', 'DSC02917 (FILEminimizer).JPG', '26');
INSERT INTO `foto` VALUES ('181', 'DSC02876 (FILEminimizer).JPG', '27');
INSERT INTO `foto` VALUES ('182', 'DSC02881 (FILEminimizer).JPG', '27');
INSERT INTO `foto` VALUES ('183', 'DSC02893 (FILEminimizer).JPG', '27');
INSERT INTO `foto` VALUES ('184', 'DSC02896 (FILEminimizer).JPG', '27');
INSERT INTO `foto` VALUES ('185', 'DSC02917 (FILEminimizer).JPG', '27');
INSERT INTO `foto` VALUES ('186', 'DSC02876 (FILEminimizer).JPG', '28');
INSERT INTO `foto` VALUES ('187', 'DSC02881 (FILEminimizer).JPG', '28');
INSERT INTO `foto` VALUES ('188', 'DSC02893 (FILEminimizer).JPG', '28');
INSERT INTO `foto` VALUES ('189', 'DSC02896 (FILEminimizer).JPG', '28');
INSERT INTO `foto` VALUES ('190', 'DSC02917 (FILEminimizer).JPG', '28');
INSERT INTO `foto` VALUES ('191', 'DSC02876 (FILEminimizer).JPG', '29');
INSERT INTO `foto` VALUES ('192', 'DSC02881 (FILEminimizer).JPG', '29');
INSERT INTO `foto` VALUES ('193', 'DSC02893 (FILEminimizer).JPG', '29');
INSERT INTO `foto` VALUES ('194', 'DSC02896 (FILEminimizer).JPG', '29');
INSERT INTO `foto` VALUES ('195', 'DSC02917 (FILEminimizer).JPG', '29');
INSERT INTO `foto` VALUES ('196', 'DSC02876 (FILEminimizer).JPG', '30');
INSERT INTO `foto` VALUES ('197', 'DSC02881 (FILEminimizer).JPG', '30');
INSERT INTO `foto` VALUES ('198', 'DSC02893 (FILEminimizer).JPG', '30');
INSERT INTO `foto` VALUES ('199', 'DSC02896 (FILEminimizer).JPG', '30');
INSERT INTO `foto` VALUES ('200', 'DSC02917 (FILEminimizer).JPG', '30');
INSERT INTO `foto` VALUES ('201', 'DSC02781 (FILEminimizer).JPG', '22');
INSERT INTO `foto` VALUES ('202', 'DSC02783 (FILEminimizer).JPG', '22');
INSERT INTO `foto` VALUES ('203', 'DSC02792 (FILEminimizer).JPG', '22');
INSERT INTO `foto` VALUES ('204', 'DSC02825 (FILEminimizer).JPG', '22');
INSERT INTO `foto` VALUES ('205', 'DSC02866 (FILEminimizer).JPG', '22');
INSERT INTO `foto` VALUES ('206', 'DSC02781 (FILEminimizer).JPG', '23');
INSERT INTO `foto` VALUES ('207', 'DSC02783 (FILEminimizer).JPG', '23');
INSERT INTO `foto` VALUES ('208', 'DSC02792 (FILEminimizer).JPG', '23');
INSERT INTO `foto` VALUES ('209', 'DSC02825 (FILEminimizer).JPG', '23');
INSERT INTO `foto` VALUES ('210', 'DSC02866 (FILEminimizer).JPG', '23');
INSERT INTO `foto` VALUES ('211', 'DSC02718 (FILEminimizer).JPG', '17');
INSERT INTO `foto` VALUES ('212', 'DSC02720 (FILEminimizer).JPG', '17');
INSERT INTO `foto` VALUES ('213', 'DSC02728 (FILEminimizer).JPG', '17');
INSERT INTO `foto` VALUES ('214', 'DSC02730 (FILEminimizer).JPG', '17');
INSERT INTO `foto` VALUES ('215', 'DSC02733 (FILEminimizer).JPG', '17');
INSERT INTO `foto` VALUES ('216', 'DSC02718 (FILEminimizer).JPG', '18');
INSERT INTO `foto` VALUES ('217', 'DSC02720 (FILEminimizer).JPG', '18');
INSERT INTO `foto` VALUES ('218', 'DSC02728 (FILEminimizer).JPG', '18');
INSERT INTO `foto` VALUES ('219', 'DSC02730 (FILEminimizer).JPG', '18');
INSERT INTO `foto` VALUES ('220', 'DSC02733 (FILEminimizer).JPG', '18');
INSERT INTO `foto` VALUES ('221', 'DSC02745 (FILEminimizer).JPG', '19');
INSERT INTO `foto` VALUES ('222', 'DSC02748 (FILEminimizer).JPG', '19');
INSERT INTO `foto` VALUES ('223', 'DSC02750 (FILEminimizer).JPG', '19');
INSERT INTO `foto` VALUES ('224', 'DSC02751 (FILEminimizer).JPG', '19');
INSERT INTO `foto` VALUES ('225', 'DSC02756 (FILEminimizer).JPG', '19');
INSERT INTO `foto` VALUES ('226', 'DSC02745 (FILEminimizer).JPG', '20');
INSERT INTO `foto` VALUES ('227', 'DSC02748 (FILEminimizer).JPG', '20');
INSERT INTO `foto` VALUES ('228', 'DSC02750 (FILEminimizer).JPG', '20');
INSERT INTO `foto` VALUES ('229', 'DSC02751 (FILEminimizer).JPG', '20');
INSERT INTO `foto` VALUES ('230', 'DSC02756 (FILEminimizer).JPG', '20');
INSERT INTO `foto` VALUES ('231', 'DSC02745 (FILEminimizer).JPG', '21');
INSERT INTO `foto` VALUES ('232', 'DSC02748 (FILEminimizer).JPG', '21');
INSERT INTO `foto` VALUES ('233', 'DSC02750 (FILEminimizer).JPG', '21');
INSERT INTO `foto` VALUES ('234', 'DSC02751 (FILEminimizer).JPG', '21');
INSERT INTO `foto` VALUES ('235', 'DSC02756 (FILEminimizer).JPG', '21');
INSERT INTO `foto` VALUES ('236', '_DSC2626 (FILEminimizer).JPG', '41');
INSERT INTO `foto` VALUES ('237', '_DSC2628 (FILEminimizer).JPG', '41');
INSERT INTO `foto` VALUES ('238', '_DSC2635 (FILEminimizer).JPG', '41');
INSERT INTO `foto` VALUES ('239', 'DSC03015 (FILEminimizer).JPG', '41');
INSERT INTO `foto` VALUES ('240', 'DSC03020 (FILEminimizer).JPG', '41');
INSERT INTO `foto` VALUES ('241', '_DSC2713 (FILEminimizer).JPG', '55');
INSERT INTO `foto` VALUES ('242', '_DSC2718 (FILEminimizer).JPG', '55');
INSERT INTO `foto` VALUES ('243', 'DSC03227 (FILEminimizer).JPG', '55');
INSERT INTO `foto` VALUES ('244', 'DSC03228 (FILEminimizer).JPG', '55');
INSERT INTO `foto` VALUES ('245', 'DSC03238 (FILEminimizer).JPG', '55');
INSERT INTO `foto` VALUES ('246', '_DSC2713 (FILEminimizer).JPG', '56');
INSERT INTO `foto` VALUES ('247', '_DSC2718 (FILEminimizer).JPG', '56');
INSERT INTO `foto` VALUES ('248', 'DSC03227 (FILEminimizer).JPG', '56');
INSERT INTO `foto` VALUES ('249', 'DSC03228 (FILEminimizer).JPG', '56');
INSERT INTO `foto` VALUES ('250', 'DSC03238 (FILEminimizer).JPG', '56');
INSERT INTO `foto` VALUES ('251', 'DSC02584 (FILEminimizer).JPG', '6');
INSERT INTO `foto` VALUES ('252', 'DSC02588 (FILEminimizer).JPG', '6');
INSERT INTO `foto` VALUES ('253', 'DSC02589 (FILEminimizer).JPG', '6');
INSERT INTO `foto` VALUES ('254', 'DSC02591 (FILEminimizer).JPG', '6');
INSERT INTO `foto` VALUES ('255', 'DSC02597 (FILEminimizer).JPG', '6');
INSERT INTO `foto` VALUES ('256', '_DSC2792 (FILEminimizer).JPG', '63');
INSERT INTO `foto` VALUES ('257', 'DSC03355 (FILEminimizer).JPG', '63');
INSERT INTO `foto` VALUES ('258', 'DSC03360 (FILEminimizer).JPG', '63');
INSERT INTO `foto` VALUES ('259', 'DSC03388 (FILEminimizer).JPG', '63');
INSERT INTO `foto` VALUES ('260', 'DSC03390 (FILEminimizer).JPG', '63');
INSERT INTO `foto` VALUES ('261', '_DSC2739 (FILEminimizer).JPG', '57');
INSERT INTO `foto` VALUES ('262', '_DSC2740 (FILEminimizer).JPG', '57');
INSERT INTO `foto` VALUES ('263', '_DSC2744 (FILEminimizer).JPG', '57');
INSERT INTO `foto` VALUES ('264', 'DSC03268 (FILEminimizer).JPG', '57');
INSERT INTO `foto` VALUES ('265', 'DSC03276 (FILEminimizer).JPG', '57');
INSERT INTO `foto` VALUES ('266', '_DSC2739 (FILEminimizer).JPG', '58');
INSERT INTO `foto` VALUES ('267', '_DSC2740 (FILEminimizer).JPG', '58');
INSERT INTO `foto` VALUES ('268', '_DSC2744 (FILEminimizer).JPG', '58');
INSERT INTO `foto` VALUES ('269', 'DSC03268 (FILEminimizer).JPG', '58');
INSERT INTO `foto` VALUES ('270', 'DSC03276 (FILEminimizer).JPG', '58');
INSERT INTO `foto` VALUES ('271', '_DSC2786 (FILEminimizer).JPG', '61');
INSERT INTO `foto` VALUES ('272', 'DSC03320 (FILEminimizer).JPG', '61');
INSERT INTO `foto` VALUES ('273', 'DSC03326 (FILEminimizer).JPG', '61');
INSERT INTO `foto` VALUES ('274', 'DSC03332 (FILEminimizer).JPG', '61');
INSERT INTO `foto` VALUES ('275', 'DSC03335 (FILEminimizer).JPG', '61');
INSERT INTO `foto` VALUES ('276', '_DSC2786 (FILEminimizer).JPG', '62');
INSERT INTO `foto` VALUES ('277', 'DSC03320 (FILEminimizer).JPG', '62');
INSERT INTO `foto` VALUES ('278', 'DSC03326 (FILEminimizer).JPG', '62');
INSERT INTO `foto` VALUES ('279', 'DSC03332 (FILEminimizer).JPG', '62');
INSERT INTO `foto` VALUES ('280', 'DSC03335 (FILEminimizer).JPG', '62');
INSERT INTO `foto` VALUES ('281', 'DSC03089 (FILEminimizer).JPG', '51');
INSERT INTO `foto` VALUES ('282', 'DSC03096 (FILEminimizer).JPG', '51');
INSERT INTO `foto` VALUES ('283', 'DSC03104 (FILEminimizer).JPG', '51');
INSERT INTO `foto` VALUES ('284', 'DSC03112 (FILEminimizer).JPG', '51');
INSERT INTO `foto` VALUES ('285', 'DSC03120 (FILEminimizer).JPG', '51');
INSERT INTO `foto` VALUES ('286', 'DSC03089 (FILEminimizer).JPG', '52');
INSERT INTO `foto` VALUES ('287', 'DSC03096 (FILEminimizer).JPG', '52');
INSERT INTO `foto` VALUES ('288', 'DSC03104 (FILEminimizer).JPG', '52');
INSERT INTO `foto` VALUES ('289', 'DSC03112 (FILEminimizer).JPG', '52');
INSERT INTO `foto` VALUES ('290', 'DSC03120 (FILEminimizer).JPG', '52');
INSERT INTO `foto` VALUES ('291', '_DSC2637 (FILEminimizer).JPG', '45');
INSERT INTO `foto` VALUES ('292', '_DSC2649 (FILEminimizer).JPG', '45');
INSERT INTO `foto` VALUES ('293', 'DSC03048 (FILEminimizer).JPG', '45');
INSERT INTO `foto` VALUES ('294', 'DSC03049 (FILEminimizer).JPG', '45');
INSERT INTO `foto` VALUES ('295', 'DSC03053 (FILEminimizer).JPG', '45');
INSERT INTO `foto` VALUES ('296', '_DSC2637 (FILEminimizer).JPG', '46');
INSERT INTO `foto` VALUES ('297', '_DSC2649 (FILEminimizer).JPG', '46');
INSERT INTO `foto` VALUES ('298', 'DSC03048 (FILEminimizer).JPG', '46');
INSERT INTO `foto` VALUES ('299', 'DSC03049 (FILEminimizer).JPG', '46');
INSERT INTO `foto` VALUES ('300', 'DSC03053 (FILEminimizer).JPG', '46');
INSERT INTO `foto` VALUES ('301', '_DSC2637 (FILEminimizer).JPG', '47');
INSERT INTO `foto` VALUES ('302', '_DSC2649 (FILEminimizer).JPG', '47');
INSERT INTO `foto` VALUES ('303', 'DSC03048 (FILEminimizer).JPG', '47');
INSERT INTO `foto` VALUES ('304', 'DSC03049 (FILEminimizer).JPG', '47');
INSERT INTO `foto` VALUES ('305', 'DSC03053 (FILEminimizer).JPG', '47');

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
  `kategori_nama` text NOT NULL,
  `kategori_icon` text NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('1', 'Alam', 'ini_file.jpg');
INSERT INTO `kategori` VALUES ('2', 'Budaya', 'jhjhj.jpg');
INSERT INTO `kategori` VALUES ('3', 'Sejarah', '');
INSERT INTO `kategori` VALUES ('4', 'Pendidikan', '');
INSERT INTO `kategori` VALUES ('5', 'Pertanian', '');
INSERT INTO `kategori` VALUES ('6', 'Religi', '');
INSERT INTO `kategori` VALUES ('7', 'Bahari', '');
INSERT INTO `kategori` VALUES ('8', 'Kuliner', '');

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
INSERT INTO `mainmenu` VALUES ('1', '1', 'Dashboard', '', 'menu-icon fa fa-dashboard', 'Dashboard', '', '2017-10-19 10:48:01', null);
INSERT INTO `mainmenu` VALUES ('2', '2', 'Berita', '', 'menu-icon fa fa-credit-card', 'C_berita', '', '2017-10-24 22:10:59', null);
INSERT INTO `mainmenu` VALUES ('3', '3', 'Event', '', 'menu-icon fa fa-calendar', 'C_event', '', '2017-10-24 22:11:02', null);
INSERT INTO `mainmenu` VALUES ('4', '4', 'Wisata', '', 'menu-icon fa fa-binoculars', '#', '', '2017-10-24 22:10:55', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES ('1', 'Kategori Wisata', '4', '', '', 'Kategori', '', '2017-10-19 15:10:19', null);
INSERT INTO `submenu` VALUES ('2', 'Wisata Berfasilitas', '4', '', '', 'Fasilitas_wisata', '', '2017-10-19 15:09:04', null);
INSERT INTO `submenu` VALUES ('3', 'Wisata Berpendukung', '4', '', '', 'Fasilitas_pendukung', '', '2017-10-19 15:09:54', null);

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
INSERT INTO `tab_akses_mainmenu` VALUES ('2', '2', '1', '0', '1', '0', '0', '2017-10-19 10:29:29', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('3', '3', '1', '0', '1', '0', '0', '2017-10-19 11:39:59', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('4', '4', '1', '0', '1', '0', '0', '2017-10-19 14:41:35', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tab_akses_submenu
-- ----------------------------
INSERT INTO `tab_akses_submenu` VALUES ('1', '1', '1', '0', '1', '0', '0', '2017-10-19 15:10:28', '');
INSERT INTO `tab_akses_submenu` VALUES ('2', '2', '1', '0', '1', '0', '0', '2017-10-19 15:11:54', '');
INSERT INTO `tab_akses_submenu` VALUES ('3', '3', '1', '0', '1', '0', '0', '2017-10-19 15:11:55', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wahana
-- ----------------------------
INSERT INTO `wahana` VALUES ('1', 'PENYEWAAN BAN (Rp 5.000,- s.d. Rp 6.000,-)', 'awe-icon awe-icon-key', 'PENYEWAAN BAN (Rp 5.000,- s.d. Rp 6.000,-)');
INSERT INTO `wahana` VALUES ('2', 'KUDA WISATA (Rp 5.000,-)', 'awe-icon awe-icon-key', 'KUDA WISATA (Rp 5.000,-)');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wahana_wisata
-- ----------------------------
INSERT INTO `wahana_wisata` VALUES ('1', '1', '1', 'Rp. 5000');
INSERT INTO `wahana_wisata` VALUES ('2', '2', '1', 'Rp. 5000');
INSERT INTO `wahana_wisata` VALUES ('3', '1', '2', '');
INSERT INTO `wahana_wisata` VALUES ('4', '2', '2', '');

-- ----------------------------
-- Table structure for wisata
-- ----------------------------
DROP TABLE IF EXISTS `wisata`;
CREATE TABLE `wisata` (
  `wisata_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata
-- ----------------------------
INSERT INTO `wisata` VALUES ('1', '1', '', 'COBAN PELANGI', 'Coban Pelangi merupakan Objek Wisata yang berlokasi di Desa Gubuk Klakah, Kecamatan Poncokusumo, Kabupaten Malang. Coban Pelangi mengalir dari sebuah tebing dengan ketinggian 30 M. Bila beruntung, para pengunjung juga bisa menyaksikan pelani yang terbias dari pucuk-pucuk tebing.', 'SELFIE RILEKS NONGKRONG', '', '', '-7.85605', '112.45487', '61');
INSERT INTO `wisata` VALUES ('2', '5', '', 'PUJON KIDUL', '', 'SELFIE RILEKS NONGKRONG', '', '', '-7.85605', '112.45487', '4');
INSERT INTO `wisata` VALUES ('3', '8', '', 'PUJON KIDUL', '', 'SELFIE RILEKS NONGKRONG', '', '', '-7.85605', '112.45487', '4');
INSERT INTO `wisata` VALUES ('4', '1', '', 'WADUK SELOREJO', '', 'SELFIE RILEKS MANCING', '', '', '-7.87736', '112.36101', '1');
INSERT INTO `wisata` VALUES ('5', '8', '', 'WADUK SELOREJO', '', 'SELFIE RILEKS MANCING', '', '', '-7.87736', '112.36101', '0');
INSERT INTO `wisata` VALUES ('6', '1', '', 'SUMBER SIRA', 'Wisata Sumber Sira merupakan Objek Wisata yang berlokasi di Desa Sumberjaya, Kecamatan Gondanglegi, Kabupaten Malang. Sumber Sira merupakan salah satu tempat wisata air yang dapat digunakan untuk berenang maupun snorkeling karena airnya yang sangat jernih. ', 'SELFIE UNDERWATER PIKNIK SNORKLING', 'Rp 3.000,-', '', '-8.12287', '112.6206', '1');
INSERT INTO `wisata` VALUES ('7', '4', '', 'MASJID TIBAN', 'Masjid Tiban merupakan Masjid yang berlokasi di Desa Sananrejo, Kecamatan Turen, Kabupaten Malang. Masjid Tiban ini memiliki arsitektur bangunan masjid yang sangat megah. Sebenarnya, Masjid Tiban masuk ke dalam kompleks Pondok Pesantren Salafiah Bihaaru Bahri Asali Fadlaailir Rahmah.', 'IBADAH ARSITEKTUR SELFIE KULINER PENDIDIKAN', 'FREE', '', '-8.15102', '112.71309', '1');
INSERT INTO `wisata` VALUES ('8', '6', '', 'MASJID TIBAN', 'Masjid Tiban merupakan Masjid yang berlokasi di Desa Sananrejo, Kecamatan Turen, Kabupaten Malang. Masjid Tiban ini memiliki arsitektur bangunan masjid yang sangat megah. Sebenarnya, Masjid Tiban masuk ke dalam kompleks Pondok Pesantren Salafiah Bihaaru Bahri Asali Fadlaailir Rahmah.', 'IBADAH ARSITEKTUR SELFIE KULINER PENDIDIKAN', 'FREE', '', '-8.15102', '112.71309', '0');
INSERT INTO `wisata` VALUES ('9', '8', '', 'MASJID TIBAN', 'Masjid Tiban merupakan Masjid yang berlokasi di Desa Sananrejo, Kecamatan Turen, Kabupaten Malang. Masjid Tiban ini memiliki arsitektur bangunan masjid yang sangat megah. Sebenarnya, Masjid Tiban masuk ke dalam kompleks Pondok Pesantren Salafiah Bihaaru Bahri Asali Fadlaailir Rahmah.', 'IBADAH ARSITEKTUR SELFIE KULINER PENDIDIKAN', 'FREE', '', '-8.15102', '112.71309', '0');
INSERT INTO `wisata` VALUES ('10', '1', '', 'EKO WISATA BOON PRING ANDEMAN', 'Eko Wisata Boon Pring Andeman merupakan Objek Wisata yang berloksi di Desa Sananrejo, Kecamatan Turen, Kabupaten Malang. Di Eko Wisata ini dapat dijumpai beragam jenis tanaman bambu dan terdapat berbagai macam wahana permainan.', 'SELFIE RILEKS PIKNIK ADVENTURE', 'Rp 5.000,-', '', '-8.15578', '112.76192', '7');
INSERT INTO `wisata` VALUES ('11', '2', '', 'CANDI KIDAL', 'Candi Kidal merupakan Candi yang berlokasi di Desa Rejokidal, Kecamatan Tumpang, Kabupaten Malang. Candi Kidal merupakan salah satu candi warisan dari Kerajaan Singosari sebagai bentuk penghormatan atas jasa besar Anusapati, Raja kedua dari Kerajaan Singosari yang memerintah selama 20 tahun (1227-1248).', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.02577', '112.70905', '38');
INSERT INTO `wisata` VALUES ('12', '3', '', 'CANDI KIDAL', 'Candi Kidal merupakan Candi yang berlokasi di Desa Rejokidal, Kecamatan Tumpang, Kabupaten Malang. Candi Kidal merupakan salah satu candi warisan dari Kerajaan Singosari sebagai bentuk penghormatan atas jasa besar Anusapati, Raja kedua dari Kerajaan Singosari yang memerintah selama 20 tahun (1227-1248).', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.02577', '112.70905', '0');
INSERT INTO `wisata` VALUES ('13', '4', '', 'CANDI KIDAL', 'Candi Kidal merupakan Candi yang berlokasi di Desa Rejokidal, Kecamatan Tumpang, Kabupaten Malang. Candi Kidal merupakan salah satu candi warisan dari Kerajaan Singosari sebagai bentuk penghormatan atas jasa besar Anusapati, Raja kedua dari Kerajaan Singosari yang memerintah selama 20 tahun (1227-1248).', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.02577', '112.70905', '0');
INSERT INTO `wisata` VALUES ('14', '2', '', 'CANDI JAGO', 'Candi Jago merupakan Candi yang berlokasi di Dusun Jago, Desa Tumpang, Kecamatan Tumpang, Kabupaten Tumpang. Menurut Kitab Negarakertagama dan Pararaton, nama Candi Jago sebenarnya berasal dari kata “Jajaghu” yang didirikan pada masa Kerajaan Singosari Pada abad ke-13. Jajaghu yang artinya adalah keagungan merupakan istilah yang digunakan untuk menyebut tempat suci.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.00586', '112.7641', '0');
INSERT INTO `wisata` VALUES ('15', '3', '', 'CANDI JAGO', 'Candi Jago merupakan Candi yang berlokasi di Dusun Jago, Desa Tumpang, Kecamatan Tumpang, Kabupaten Tumpang. Menurut Kitab Negarakertagama dan Pararaton, nama Candi Jago sebenarnya berasal dari kata “Jajaghu” yang didirikan pada masa Kerajaan Singosari Pada abad ke-13. Jajaghu yang artinya adalah keagungan merupakan istilah yang digunakan untuk menyebut tempat suci.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.00586', '112.7641', '0');
INSERT INTO `wisata` VALUES ('16', '4', '', 'CANDI JAGO', 'Candi Jago merupakan Candi yang berlokasi di Dusun Jago, Desa Tumpang, Kecamatan Tumpang, Kabupaten Tumpang. Menurut Kitab Negarakertagama dan Pararaton, nama Candi Jago sebenarnya berasal dari kata “Jajaghu” yang didirikan pada masa Kerajaan Singosari Pada abad ke-13. Jajaghu yang artinya adalah keagungan merupakan istilah yang digunakan untuk menyebut tempat suci.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-8.00586', '112.7641', '0');
INSERT INTO `wisata` VALUES ('17', '1', '', 'PANTAI NGLIYEP', 'Pantai Ngliyep merupakan Objek Wisata Pantai yang berlokasi di Desa Kedungsalam, Kecamatan Donomulyo, Kabupaten Malang. Pantai Ngliyep berada di tepi Samudera Indonesia. Luas Area Wisata Pantai Ngliyep ± 10 Ha yang terdiri dari hutan lindung, areal wisata, penginapan, dan lahan parkir.', 'SELFIE RILEKS PANORAMA CAMPING NONGKRONG', 'Rp 16.000,-', '', '-8.38365', '112.4243', '2');
INSERT INTO `wisata` VALUES ('18', '7', '', 'PANTAI NGLIYEP', 'Pantai Ngliyep merupakan Objek Wisata Pantai yang berlokasi di Desa Kedungsalam, Kecamatan Donomulyo, Kabupaten Malang. Pantai Ngliyep berada di tepi Samudera Indonesia. Luas Area Wisata Pantai Ngliyep ± 10 Ha yang terdiri dari hutan lindung, areal wisata, penginapan, dan lahan parkir.', 'SELFIE RILEKS PANORAMA CAMPING NONGKRONG', 'Rp 16.000,-', '', '-8.38365', '112.4243', '0');
INSERT INTO `wisata` VALUES ('19', '1', '', 'PANTAI NGUDEL', 'Pantai Ngudel merupakan Objek Wisata Pantai yang berlokasi di Desa Sindurejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Nguder ini bersebelahan dengan Pantai Ngantep.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.41675', '112.58593', '2');
INSERT INTO `wisata` VALUES ('20', '4', '', 'PANTAI NGUDEL', 'Pantai Ngudel merupakan Objek Wisata Pantai yang berlokasi di Desa Sindurejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Nguder ini bersebelahan dengan Pantai Ngantep.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.41675', '112.58593', '0');
INSERT INTO `wisata` VALUES ('21', '7', '', 'PANTAI NGUDEL', 'Pantai Ngudel merupakan Objek Wisata Pantai yang berlokasi di Desa Sindurejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Nguder ini bersebelahan dengan Pantai Ngantep.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.41675', '112.58593', '0');
INSERT INTO `wisata` VALUES ('22', '1', '', 'PANTAI BATU BENGKUNG', 'Pantai Batu Bengkung merupakan Objek WIsata Pantai yang berlokasi di Desa Gajahrejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Batu Bengkung merupakan salah satu pantai dengan batuan karang yang membentang membentuk barisan. Batuan karang ini akan memecah ombak besar di tepian pantai. Tidak jarang air yang terbawa ombak terjebak di dalam cekungan karang sehingga menghasilkan kolam air asin alami yang aman untuk berenang.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.43017', '112.6151', '3');
INSERT INTO `wisata` VALUES ('23', '7', '', 'PANTAI BATU BENGKUNG', 'Pantai Batu Bengkung merupakan Objek WIsata Pantai yang berlokasi di Desa Gajahrejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Batu Bengkung merupakan salah satu pantai dengan batuan karang yang membentang membentuk barisan. Batuan karang ini akan memecah ombak besar di tepian pantai. Tidak jarang air yang terbawa ombak terjebak di dalam cekungan karang sehingga menghasilkan kolam air asin alami yang aman untuk berenang.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.43017', '112.6151', '0');
INSERT INTO `wisata` VALUES ('24', '1', '', 'PANTAI BAJUL MATI', 'Pantai Bajul Mati merupakan Objek Wisata Pantai yang berlokasi di Desa Gajahrejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Bajul Mati ini memiliki teluk-teluk yang indah.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.43137', '112.63558', '0');
INSERT INTO `wisata` VALUES ('25', '7', '', 'PANTAI BAJUL MATI', 'Pantai Bajul Mati merupakan Objek Wisata Pantai yang berlokasi di Desa Gajahrejo, Kecamatan Gedangan, Kabupaten Malang. Pantai Bajul Mati ini memiliki teluk-teluk yang indah.', 'SELFIE RILEKS PANORAMA CAMPING', 'Rp 10.000,-', '', '-8.43137', '112.63558', '0');
INSERT INTO `wisata` VALUES ('26', '1', '', 'PANTAI BALEKAMBANG', 'Pantai Balekambang merupakan Objek Wisata Pantai yang tereltak di Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Kabupaten Malang. Suasana yang ditawarkan Pantai Balekambang sangat menarik sekali dengan ditumbuhi aneka pepohonan yang rindang. Pantai Balekambang memiliki 3 pulau kecil yaitu Pulau Ismoyo, Pulau Anoman, dan Pulau Wisanggeni. Di tiap-tiap pulau disambungkan dengan jembatan. Di Pulau Ismoyo terdapat Pura yang bernama Pura Amarta Jati.', 'SELFIE IBADAH PANORAMA CAMPING KULINER', 'Rp 16.000,-', '', '-8.40276', '112.53365', '0');
INSERT INTO `wisata` VALUES ('27', '2', '', 'PANTAI BALEKAMBANG', 'Pantai Balekambang merupakan Objek Wisata Pantai yang tereltak di Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Kabupaten Malang. Suasana yang ditawarkan Pantai Balekambang sangat menarik sekali dengan ditumbuhi aneka pepohonan yang rindang. Pantai Balekambang memiliki 3 pulau kecil yaitu Pulau Ismoyo, Pulau Anoman, dan Pulau Wisanggeni. Di tiap-tiap pulau disambungkan dengan jembatan. Di Pulau Ismoyo terdapat Pura yang bernama Pura Amarta Jati.', 'SELFIE IBADAH PANORAMA CAMPING KULINER', 'Rp 16.000,-', '', '-8.40276', '112.53365', '1');
INSERT INTO `wisata` VALUES ('28', '6', '', 'PANTAI BALEKAMBANG', 'Pantai Balekambang merupakan Objek Wisata Pantai yang tereltak di Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Kabupaten Malang. Suasana yang ditawarkan Pantai Balekambang sangat menarik sekali dengan ditumbuhi aneka pepohonan yang rindang. Pantai Balekambang memiliki 3 pulau kecil yaitu Pulau Ismoyo, Pulau Anoman, dan Pulau Wisanggeni. Di tiap-tiap pulau disambungkan dengan jembatan. Di Pulau Ismoyo terdapat Pura yang bernama Pura Amarta Jati.', 'SELFIE IBADAH PANORAMA CAMPING KULINER', 'Rp 16.000,-', '', '-8.40276', '112.53365', '0');
INSERT INTO `wisata` VALUES ('29', '7', '', 'PANTAI BALEKAMBANG', 'Pantai Balekambang merupakan Objek Wisata Pantai yang tereltak di Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Kabupaten Malang. Suasana yang ditawarkan Pantai Balekambang sangat menarik sekali dengan ditumbuhi aneka pepohonan yang rindang. Pantai Balekambang memiliki 3 pulau kecil yaitu Pulau Ismoyo, Pulau Anoman, dan Pulau Wisanggeni. Di tiap-tiap pulau disambungkan dengan jembatan. Di Pulau Ismoyo terdapat Pura yang bernama Pura Amarta Jati.', 'SELFIE IBADAH PANORAMA CAMPING KULINER', 'Rp 16.000,-', '', '-8.40276', '112.53365', '0');
INSERT INTO `wisata` VALUES ('30', '8', '', 'PANTAI BALEKAMBANG', 'Pantai Balekambang merupakan Objek Wisata Pantai yang tereltak di Dusun Sumber Jambe, Desa Srigonco, Kecamatan Bantur, Kabupaten Malang. Suasana yang ditawarkan Pantai Balekambang sangat menarik sekali dengan ditumbuhi aneka pepohonan yang rindang. Pantai Balekambang memiliki 3 pulau kecil yaitu Pulau Ismoyo, Pulau Anoman, dan Pulau Wisanggeni. Di tiap-tiap pulau disambungkan dengan jembatan. Di Pulau Ismoyo terdapat Pura yang bernama Pura Amarta Jati.', 'SELFIE IBADAH PANORAMA CAMPING KULINER', 'Rp 16.000,-', '', '-8.40276', '112.53365', '0');
INSERT INTO `wisata` VALUES ('31', '1', '', 'BENDUNGAN KARANGKATES', 'Bendungan Karangkates merupakan Objek Wisata yang berlokasi di Kecamatan Sumberpucung, Kabupaten Malang. Bendungan ini juga bisa disebut Waduk Ir. Sutami, Waduk Karangkates, atau Bendungan Sutami. Air bendungan ini berasal dari mata air di Gunung Arjuno dan ditambah air hujan.', 'SELFIE MANCING PIKNIK BELAJAR RENANG', 'Rp 7.000,-', '', '-8.15589', '112.4494', '1');
INSERT INTO `wisata` VALUES ('32', '4', '', 'BENDUNGAN KARANGKATES', 'Bendungan Karangkates merupakan Objek Wisata yang berlokasi di Kecamatan Sumberpucung, Kabupaten Malang. Bendungan ini juga bisa disebut Waduk Ir. Sutami, Waduk Karangkates, atau Bendungan Sutami. Air bendungan ini berasal dari mata air di Gunung Arjuno dan ditambah air hujan.', 'SELFIE MANCING PIKNIK BELAJAR RENANG', 'Rp 7.000,-', '', '-8.15589', '112.4494', '0');
INSERT INTO `wisata` VALUES ('33', '2', '', 'PESAREAN GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 3.000,- ', '', '-8.02346', '112.4933', '0');
INSERT INTO `wisata` VALUES ('34', '3', '', 'PESAREAN GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 3.000,- ', '', '-8.02346', '112.4933', '0');
INSERT INTO `wisata` VALUES ('35', '6', '', 'PESAREAN GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 3.000,- ', '', '-8.02346', '112.4933', '0');
INSERT INTO `wisata` VALUES ('36', '8', '', 'PESAREAN GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 3.000,- ', '', '-8.02346', '112.4933', '20');
INSERT INTO `wisata` VALUES ('37', '2', '', 'KRATON GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 10.000,-', '', '-8.00317', '112.48574', '0');
INSERT INTO `wisata` VALUES ('38', '3', '', 'KRATON GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 10.000,-', '', '-8.00317', '112.48574', '0');
INSERT INTO `wisata` VALUES ('39', '6', '', 'KRATON GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 10.000,-', '', '-8.00317', '112.48574', '0');
INSERT INTO `wisata` VALUES ('40', '8', '', 'KRATON GUNUNG KAWI', 'Gunung Kawi merupakan salah satu gunung berapi yang masih aktif dan berlokasi di Kecamatan Wonosari, Kabupaten Malang. Saat berkunjung ke Gunung Kawi suasana magis akan terasa kental. Terdapat beberapa tempat atau petilasan untuk beberapa orang yang berdoa dan memohon berkat untuk kesuksesan usaha, jodoh, dan banyak hal lainnya.', 'PESAREAN IBADAH BELANJA RAMAL NASIB HOKI', 'Rp 10.000,-', '', '-8.00317', '112.48574', '0');
INSERT INTO `wisata` VALUES ('41', '1', '', 'PEMANDIAN KENDEDES', 'Pemandian Kendedes merupakan Objek Wisata yang berlokasi di Jalan Kendedes, Desa Candirenggo, Kecamatan Singosari, Kabupaten Malang. Konon, pemandian ini dipercaya sebagai tempat madni dari Putri Ken Dedes yang terkenal akan kecantikannya tersebut. Hal ini menimbulkan kepercayaan di masyarakat bahwa dengan mandi di pemandian ini maka akan membuat awet muda.', 'RENANG SELFIE RILEKS PIKNIK', 'Rp 10.000,-', '', '-7.88154', '112.66017', '23');
INSERT INTO `wisata` VALUES ('42', '2', '', 'CANDI SINGOSARI', 'Candi Singosari merupakan Objek Wisata Candi yang berlokasi di Desa Candirenggo, Kecamatan Singosari, Kabupaten Malang. Menurut para ahli, Candi ini diperkirakan dibangun sekitar tahun 1300 M sebagai persembahan untuk menghormati Raja Kertanegara dari Kerajaan Singosari.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-7.88779', '112.66386', '0');
INSERT INTO `wisata` VALUES ('43', '3', '', 'CANDI SINGOSARI', 'Candi Singosari merupakan Objek Wisata Candi yang berlokasi di Desa Candirenggo, Kecamatan Singosari, Kabupaten Malang. Menurut para ahli, Candi ini diperkirakan dibangun sekitar tahun 1300 M sebagai persembahan untuk menghormati Raja Kertanegara dari Kerajaan Singosari.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-7.88779', '112.66386', '0');
INSERT INTO `wisata` VALUES ('44', '4', '', 'CANDI SINGOSARI', 'Candi Singosari merupakan Objek Wisata Candi yang berlokasi di Desa Candirenggo, Kecamatan Singosari, Kabupaten Malang. Menurut para ahli, Candi ini diperkirakan dibangun sekitar tahun 1300 M sebagai persembahan untuk menghormati Raja Kertanegara dari Kerajaan Singosari.', 'SELFIE PENDIDIKAN SEJARAH CAGAR BUDAYA', 'N/A', '', '-7.88779', '112.66386', '0');
INSERT INTO `wisata` VALUES ('45', '4', '', 'WISATA PETIK MADU AGRO TAWON RIMBA RAYA', 'Wisata Petik Madu Agro Tawon Rimba Raya merupakan Objek Wisata yang berlokasi di Puri Kencana, Desa Bedali, Kecamatan Lawang, Kabupaten Malang. Wisata Agro ini dapat dijadikan sebagai tempat wisata edukasi tentang lebah.', 'EDUKASI TERAPI WISATA PETIK LEBAH SELFIE ADVENTURE', 'FREE', '', '-7.84885', '112.69511', '0');
INSERT INTO `wisata` VALUES ('46', '5', '', 'WISATA PETIK MADU AGRO TAWON RIMBA RAYA', 'Wisata Petik Madu Agro Tawon Rimba Raya merupakan Objek Wisata yang berlokasi di Puri Kencana, Desa Bedali, Kecamatan Lawang, Kabupaten Malang. Wisata Agro ini dapat dijadikan sebagai tempat wisata edukasi tentang lebah.', 'EDUKASI TERAPI WISATA PETIK LEBAH SELFIE ADVENTURE', 'FREE', '', '-7.84885', '112.69511', '0');
INSERT INTO `wisata` VALUES ('47', '8', '', 'WISATA PETIK MADU AGRO TAWON RIMBA RAYA', 'Wisata Petik Madu Agro Tawon Rimba Raya merupakan Objek Wisata yang berlokasi di Puri Kencana, Desa Bedali, Kecamatan Lawang, Kabupaten Malang. Wisata Agro ini dapat dijadikan sebagai tempat wisata edukasi tentang lebah.', 'EDUKASI TERAPI WISATA PETIK LEBAH SELFIE ADVENTURE', 'FREE', '', '-7.84885', '112.69511', '0');
INSERT INTO `wisata` VALUES ('48', '1', '', 'AGROWISATA KEBUN TEH WONOSARI', 'Agrowisata Kebun Teh Wonosari merupakan Objek Wisata yang berlokasi di Kecamatan Lawang dan berada di lereng Gunung Arjuno. Perkebunan ini berada di ketinggian 950-1250 mdpl dan menawarkan hamparan hijau kebun teh dengan suasana yang sejuk dan damai.', 'SELFIE PENDIDIKAN PIKNIK RILEKS ADVENTURE', 'Rp 10.000,-', '', '-7.82167', '112.6426', '0');
INSERT INTO `wisata` VALUES ('49', '4', '', 'AGROWISATA KEBUN TEH WONOSARI', 'Agrowisata Kebun Teh Wonosari merupakan Objek Wisata yang berlokasi di Kecamatan Lawang dan berada di lereng Gunung Arjuno. Perkebunan ini berada di ketinggian 950-1250 mdpl dan menawarkan hamparan hijau kebun teh dengan suasana yang sejuk dan damai.', 'SELFIE PENDIDIKAN PIKNIK RILEKS ADVENTURE', 'Rp 10.000,-', '', '-7.82167', '112.6426', '0');
INSERT INTO `wisata` VALUES ('50', '5', '', 'AGROWISATA KEBUN TEH WONOSARI', 'Agrowisata Kebun Teh Wonosari merupakan Objek Wisata yang berlokasi di Kecamatan Lawang dan berada di lereng Gunung Arjuno. Perkebunan ini berada di ketinggian 950-1250 mdpl dan menawarkan hamparan hijau kebun teh dengan suasana yang sejuk dan damai.', 'SELFIE PENDIDIKAN PIKNIK RILEKS ADVENTURE', 'Rp 10.000,-', '', '-7.82167', '112.6426', '0');
INSERT INTO `wisata` VALUES ('51', '1', '', 'WISATA AIR SUMBER KRABYAKAN', 'Wisata Air Sumber Krabyakan  merupakan Objek Wisata yang berlokasi di Desa Sumber Ngepoh, Kecamatan Lawang, Kabupaten Malang. Wisata Sumber Krabyakan yang berlokasi di kaki pegunungan menjadikan tempat ini dapat menghadirkan kenyamanan dan keharmonisan bagi pengunjungnya.', 'SELFIE BERENDAM RILEKS TERAPI IKAN', 'Rp 5.000,-', '', '-7.84278', '112.72037', '0');
INSERT INTO `wisata` VALUES ('52', '5', '', 'WISATA AIR SUMBER KRABYAKAN', 'Wisata Air Sumber Krabyakan  merupakan Objek Wisata yang berlokasi di Desa Sumber Ngepoh, Kecamatan Lawang, Kabupaten Malang. Wisata Sumber Krabyakan yang berlokasi di kaki pegunungan menjadikan tempat ini dapat menghadirkan kenyamanan dan keharmonisan bagi pengunjungnya.', 'SELFIE BERENDAM RILEKS TERAPI IKAN', 'Rp 5.000,-', '', '-7.84278', '112.72037', '0');
INSERT INTO `wisata` VALUES ('53', '1', '', 'COBAN RONDO', 'Coban Rondo merupakan Objek Wisata yang berlokasi di Desa Pandansari, Kecamatan Pujon, Kabupaten Malang. Air Terjun di Coban Rondo memiliki ketinggian 84 M dan merupakan wahana air terjun yang paling mudah di tempuh.', 'SELFIE RILEKS ADVENTURE TRACKING CAMPING PIKNIK GATHERING AIR TERJUN', 'Rp 20.000,-', 'Rp 35.000,-', '-7.88503', '112.47729', '0');
INSERT INTO `wisata` VALUES ('54', '1', '', 'LEMBAH TUMPANG RESORT', 'Lembah Tumpang Resort merupakan Objek WIsata yang berlokasi di Dusun Nglanggang, Desa Slamet, Kecamatan Tumpang, Kabupaten Malang. Lembah Tumpang Resort ini masih dalam proses pembangunan tetapi sudah banyak tempat yang bisa digunakan untuk berwisata.', 'SELFIE PIKNIK RENANG GATHERING RILEKS ADVENTURE', 'Rp 30.000,-', '', '-7.99458', '112.73803', '0');
INSERT INTO `wisata` VALUES ('55', '1', '', 'SUMBER PITU', 'Sumber Pitu merupakan Objek Wisata yang berlokasi di Desa Duwet Krajan, Kecamatan Tumpang, Kabupaten Malang.', 'SELFIE SUMBER ADVENTURE TRACKING BERENDAM UNDERWATER ARI TERJUN', 'FREE', '', '-8.0136', '112.82169', '1');
INSERT INTO `wisata` VALUES ('56', '5', '', 'SUMBER PITU', 'Sumber Pitu merupakan Objek Wisata yang berlokasi di Desa Duwet Krajan, Kecamatan Tumpang, Kabupaten Malang.', 'SELFIE SUMBER ADVENTURE TRACKING BERENDAM UNDERWATER ARI TERJUN', 'FREE', '', '-8.0136', '112.82169', '0');
INSERT INTO `wisata` VALUES ('57', '1', '', 'TUBING LEDOK AMPRONG', 'Tubing Ledok Amprong merupakan Objek Wisata yang berlokasi di Desa Gubuk Klakah, Kecamatan Poncokusumo, Kabupaten Malang. River Tubing ini berada satu aliran dengan Coban Pelangi yaitu di Sungai Amprong.', 'TRACKING SELFIE ADVENTURE CAMPING TUBING', 'Rp 5.000,-', '', '-8.03208', '112.82791', '0');
INSERT INTO `wisata` VALUES ('58', '5', '', 'TUBING LEDOK AMPRONG', 'Tubing Ledok Amprong merupakan Objek Wisata yang berlokasi di Desa Gubuk Klakah, Kecamatan Poncokusumo, Kabupaten Malang. River Tubing ini berada satu aliran dengan Coban Pelangi yaitu di Sungai Amprong.', 'TRACKING SELFIE ADVENTURE CAMPING TUBING', 'Rp 5.000,-', '', '-8.03208', '112.82791', '0');
INSERT INTO `wisata` VALUES ('59', '1', '', 'NDAYUNG RAFTING', 'Ndayung Rafting merupakan Objek Wisata yang berlokasi di Desa Gubuk Klakah, Kecamatan Poncokusumo, Kabupaten Malang. Letak Ndayung Rafting sendiri berada di aliran Sungai Amprong yang merupakan kawasan wisata alam Coban Pelangi yang berada di Taman Nasional Bromo Tengger Semeru.', 'RAFTING ADVENTURE SELFIE TRACKING CAMPING GATHERING', 'FREE', '', '-8.01406', '112.85337', '0');
INSERT INTO `wisata` VALUES ('60', '1', '', 'COBAN PELANGI', 'Coban Pelangi merupakan Objek Wisata yang berlokasi di Desa Gubuk Klakah, Kecamatan Poncokusumo, Kabupaten Malang. Coban Pelangi mengalir dari sebuah tebing dengan ketinggian 30 M. Bila beruntung, para pengunjung juga bisa menyaksikan pelani yang terbias dari pucuk-pucuk tebing.', 'SELFIE ADVENTURE TRACKING CAMPING AIR TERJUN', 'Rp 10.000,-', 'Rp 15.000,-', '-8.01149', '\'112.86535', '0');
INSERT INTO `wisata` VALUES ('61', '1', '', 'WENDIT WATER PARK', 'Wendit Water Park merupakan Objek Wisata yang berlokasi di Desa Mangliawan, Kecamatan Pakis, Kabupaten Malang. Air di Wendit Water Park ini berasal dari sumber alami yang bernama Sendang Widodaren. Di Wendit Water Park terdapat banyak kera berekor panjang.', 'PIKNIK RENANG PEMANDIAN RILEKS BERENDAM SELFIE', 'Rp 18.200,-', '', '-7.95216', '112.6741', '1');
INSERT INTO `wisata` VALUES ('62', '6', '', 'WENDIT WATER PARK', 'Wendit Water Park merupakan Objek Wisata yang berlokasi di Desa Mangliawan, Kecamatan Pakis, Kabupaten Malang. Air di Wendit Water Park ini berasal dari sumber alami yang bernama Sendang Widodaren. Di Wendit Water Park terdapat banyak kera berekor panjang.', 'PIKNIK RENANG PEMANDIAN RILEKS BERENDAM SELFIE', 'Rp 18.200,-', '', '-7.95216', '112.6741', '0');
INSERT INTO `wisata` VALUES ('63', '1', '', 'TAMAN REKREASI SENGKALING UMM', 'Taman Rekreasi Sengkaling UMM merupakan Objek Wisata yang berlokasi di Jl. Raya Mulyoagung No. 188, Kecamatan Dau, Kabupaten Malang. Taman Rekreasi Sengkaling mempunyai berbagai fasilitas yang memiliki keunggulan dengan adanya wisata air yang berasal dari sumber alami yang salah satunya adalah Kolam Tirta Alam.', 'SELFIE RENANG PIKNIK RILEKS PLAYGROUND', 'Rp 25.000,-', '', '-7.19538', '112.58892', '1');
INSERT INTO `wisata` VALUES ('64', '1', '', 'BEDENGAN ADVENTURE PARK', 'Bedengan Adventure Park merupakan Bumi Perkemahan yang berlokasi di Dusun Selokerto, Desa Selorejo, Kecamatan Dau, Kabupaten Malang. Di tempat ini dapat digunakan untuk camping maupun hanya sekedar ingin menikmati hutan pinus dengan menggunakan hammock.', 'SELFIE CAMPING ADVENTURE TRACKING HAMMOCK', 'FREE', '', '-7.93844', '112.53102', '0');
INSERT INTO `wisata` VALUES ('65', '2', '', 'PADEPOKAN SENI TOPENG MALANGAN \"ASMORO BANGUN\"', 'Padepokan Seni Topeng Malangan \"Asmoro Bangun\" merupakan padepokan topeng malangan yang berlokasi di Dusun Kedungmonggo, Desa Karangpandan, Kecamatan Pakisaji, Kabupaten Malang. Padepokan Topeng Malangan ini merupakan satu-satunya padepokan yang masih sangat giat untuk mempertahankan dan mengembangkan kesenian dan kebudayaan asli Malang. Padepokan Seni Topeng Malangan \"Asmoro Bangun\" saat ini dikelola oleh Tri Handoyo.', 'TARI SENI TOPENG MALANGAN PERTUNJUKAN UKIRAN', 'FREE', '', '-8.07325', '112.58925', '0');
INSERT INTO `wisata` VALUES ('66', '3', '', 'PADEPOKAN SENI TOPENG MALANGAN \"ASMORO BANGUN\"', 'Padepokan Seni Topeng Malangan \"Asmoro Bangun\" merupakan padepokan topeng malangan yang berlokasi di Dusun Kedungmonggo, Desa Karangpandan, Kecamatan Pakisaji, Kabupaten Malang. Padepokan Topeng Malangan ini merupakan satu-satunya padepokan yang masih sangat giat untuk mempertahankan dan mengembangkan kesenian dan kebudayaan asli Malang. Padepokan Seni Topeng Malangan \"Asmoro Bangun\" saat ini dikelola oleh Tri Handoyo.', 'TARI SENI TOPENG MALANGAN PERTUNJUKAN UKIRAN', 'FREE', '', '-8.07325', '112.58925', '0');
INSERT INTO `wisata` VALUES ('67', '4', '', 'PADEPOKAN SENI TOPENG MALANGAN \"ASMORO BANGUN\"', 'Padepokan Seni Topeng Malangan \"Asmoro Bangun\" merupakan padepokan topeng malangan yang berlokasi di Dusun Kedungmonggo, Desa Karangpandan, Kecamatan Pakisaji, Kabupaten Malang. Padepokan Topeng Malangan ini merupakan satu-satunya padepokan yang masih sangat giat untuk mempertahankan dan mengembangkan kesenian dan kebudayaan asli Malang. Padepokan Seni Topeng Malangan \"Asmoro Bangun\" saat ini dikelola oleh Tri Handoyo.', 'TARI SENI TOPENG MALANGAN PERTUNJUKAN UKIRAN', 'FREE', '', '-8.07325', '112.58925', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=738 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata_berfasilitas
-- ----------------------------
INSERT INTO `wisata_berfasilitas` VALUES ('1', '1', '1', '');
INSERT INTO `wisata_berfasilitas` VALUES ('2', '1', '2', '');
INSERT INTO `wisata_berfasilitas` VALUES ('3', '1', '3', '');
INSERT INTO `wisata_berfasilitas` VALUES ('4', '1', '4', '');
INSERT INTO `wisata_berfasilitas` VALUES ('5', '1', '5', '');
INSERT INTO `wisata_berfasilitas` VALUES ('6', '1', '6', '');
INSERT INTO `wisata_berfasilitas` VALUES ('7', '1', '7', '');
INSERT INTO `wisata_berfasilitas` VALUES ('8', '1', '8', '');
INSERT INTO `wisata_berfasilitas` VALUES ('9', '1', '9', '');
INSERT INTO `wisata_berfasilitas` VALUES ('10', '1', '10', '');
INSERT INTO `wisata_berfasilitas` VALUES ('11', '1', '11', '');
INSERT INTO `wisata_berfasilitas` VALUES ('12', '2', '1', '');
INSERT INTO `wisata_berfasilitas` VALUES ('13', '2', '2', '');
INSERT INTO `wisata_berfasilitas` VALUES ('14', '2', '3', '');
INSERT INTO `wisata_berfasilitas` VALUES ('15', '2', '4', '');
INSERT INTO `wisata_berfasilitas` VALUES ('16', '2', '5', '');
INSERT INTO `wisata_berfasilitas` VALUES ('17', '2', '6', '');
INSERT INTO `wisata_berfasilitas` VALUES ('18', '2', '7', '');
INSERT INTO `wisata_berfasilitas` VALUES ('19', '2', '8', '');
INSERT INTO `wisata_berfasilitas` VALUES ('20', '2', '9', '');
INSERT INTO `wisata_berfasilitas` VALUES ('21', '2', '10', '');
INSERT INTO `wisata_berfasilitas` VALUES ('22', '2', '11', '');
INSERT INTO `wisata_berfasilitas` VALUES ('23', '3', '1', '');
INSERT INTO `wisata_berfasilitas` VALUES ('24', '3', '2', '');
INSERT INTO `wisata_berfasilitas` VALUES ('25', '3', '3', '');
INSERT INTO `wisata_berfasilitas` VALUES ('26', '3', '4', '');
INSERT INTO `wisata_berfasilitas` VALUES ('27', '3', '5', '');
INSERT INTO `wisata_berfasilitas` VALUES ('28', '3', '6', '');
INSERT INTO `wisata_berfasilitas` VALUES ('29', '3', '7', '');
INSERT INTO `wisata_berfasilitas` VALUES ('30', '3', '8', '');
INSERT INTO `wisata_berfasilitas` VALUES ('31', '3', '9', '');
INSERT INTO `wisata_berfasilitas` VALUES ('32', '3', '10', '');
INSERT INTO `wisata_berfasilitas` VALUES ('33', '3', '11', '');
INSERT INTO `wisata_berfasilitas` VALUES ('34', '4', '1', '');
INSERT INTO `wisata_berfasilitas` VALUES ('35', '4', '2', '');
INSERT INTO `wisata_berfasilitas` VALUES ('36', '4', '3', '');
INSERT INTO `wisata_berfasilitas` VALUES ('37', '4', '4', '');
INSERT INTO `wisata_berfasilitas` VALUES ('38', '4', '5', '');
INSERT INTO `wisata_berfasilitas` VALUES ('39', '4', '6', '');
INSERT INTO `wisata_berfasilitas` VALUES ('40', '4', '7', '');
INSERT INTO `wisata_berfasilitas` VALUES ('41', '4', '8', '');
INSERT INTO `wisata_berfasilitas` VALUES ('42', '4', '9', '');
INSERT INTO `wisata_berfasilitas` VALUES ('43', '4', '10', '');
INSERT INTO `wisata_berfasilitas` VALUES ('44', '4', '11', '');
INSERT INTO `wisata_berfasilitas` VALUES ('45', '5', '1', '');
INSERT INTO `wisata_berfasilitas` VALUES ('46', '5', '2', '');
INSERT INTO `wisata_berfasilitas` VALUES ('47', '5', '3', '');
INSERT INTO `wisata_berfasilitas` VALUES ('48', '5', '4', '');
INSERT INTO `wisata_berfasilitas` VALUES ('49', '5', '5', '');
INSERT INTO `wisata_berfasilitas` VALUES ('50', '5', '6', '');
INSERT INTO `wisata_berfasilitas` VALUES ('51', '5', '7', '');
INSERT INTO `wisata_berfasilitas` VALUES ('52', '5', '8', '');
INSERT INTO `wisata_berfasilitas` VALUES ('53', '5', '9', '');
INSERT INTO `wisata_berfasilitas` VALUES ('54', '5', '10', '');
INSERT INTO `wisata_berfasilitas` VALUES ('55', '5', '11', '');
INSERT INTO `wisata_berfasilitas` VALUES ('56', '6', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('57', '6', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('58', '6', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('59', '6', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('60', '6', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('61', '6', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('62', '6', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('63', '6', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('64', '6', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('65', '6', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('66', '6', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('67', '7', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('68', '7', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('69', '7', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('70', '7', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('71', '7', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('72', '7', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('73', '7', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('74', '7', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('75', '7', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('76', '7', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('77', '7', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('78', '8', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('79', '8', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('80', '8', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('81', '8', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('82', '8', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('83', '8', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('84', '8', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('85', '8', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('86', '8', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('87', '8', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('88', '8', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('89', '9', '1', '1');
INSERT INTO `wisata_berfasilitas` VALUES ('90', '9', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('91', '9', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('92', '9', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('93', '9', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('94', '9', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('95', '9', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('96', '9', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('97', '9', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('98', '9', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('99', '9', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('100', '10', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('101', '10', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('102', '10', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('103', '10', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('104', '10', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('105', '10', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('106', '10', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('107', '10', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('108', '10', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('109', '10', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('110', '10', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('111', '11', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('112', '11', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('113', '11', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('114', '11', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('115', '11', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('116', '11', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('117', '11', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('118', '11', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('119', '11', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('120', '11', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('121', '11', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('122', '12', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('123', '12', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('124', '12', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('125', '12', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('126', '12', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('127', '12', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('128', '12', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('129', '12', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('130', '12', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('131', '12', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('132', '12', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('133', '13', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('134', '13', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('135', '13', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('136', '13', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('137', '13', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('138', '13', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('139', '13', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('140', '13', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('141', '13', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('142', '13', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('143', '13', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('144', '14', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('145', '14', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('146', '14', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('147', '14', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('148', '14', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('149', '14', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('150', '14', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('151', '14', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('152', '14', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('153', '14', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('154', '14', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('155', '15', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('156', '15', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('157', '15', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('158', '15', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('159', '15', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('160', '15', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('161', '15', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('162', '15', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('163', '15', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('164', '15', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('165', '15', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('166', '16', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('167', '16', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('168', '16', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('169', '16', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('170', '16', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('171', '16', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('172', '16', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('173', '16', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('174', '16', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('175', '16', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('176', '16', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('177', '17', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('178', '17', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('179', '17', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('180', '17', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('181', '17', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('182', '17', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('183', '17', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('184', '17', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('185', '17', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('186', '17', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('187', '17', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('188', '18', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('189', '18', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('190', '18', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('191', '18', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('192', '18', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('193', '18', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('194', '18', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('195', '18', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('196', '18', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('197', '18', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('198', '18', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('199', '19', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('200', '19', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('201', '19', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('202', '19', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('203', '19', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('204', '19', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('205', '19', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('206', '19', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('207', '19', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('208', '19', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('209', '19', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('210', '20', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('211', '20', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('212', '20', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('213', '20', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('214', '20', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('215', '20', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('216', '20', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('217', '20', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('218', '20', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('219', '20', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('220', '20', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('221', '21', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('222', '21', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('223', '21', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('224', '21', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('225', '21', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('226', '21', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('227', '21', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('228', '21', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('229', '21', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('230', '21', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('231', '21', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('232', '22', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('233', '22', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('234', '22', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('235', '22', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('236', '22', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('237', '22', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('238', '22', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('239', '22', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('240', '22', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('241', '22', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('242', '22', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('243', '23', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('244', '23', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('245', '23', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('246', '23', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('247', '23', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('248', '23', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('249', '23', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('250', '23', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('251', '23', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('252', '23', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('253', '23', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('254', '24', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('255', '24', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('256', '24', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('257', '24', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('258', '24', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('259', '24', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('260', '24', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('261', '24', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('262', '24', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('263', '24', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('264', '24', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('265', '25', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('266', '25', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('267', '25', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('268', '25', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('269', '25', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('270', '25', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('271', '25', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('272', '25', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('273', '25', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('274', '25', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('275', '25', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('276', '26', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('277', '26', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('278', '26', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('279', '26', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('280', '26', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('281', '26', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('282', '26', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('283', '26', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('284', '26', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('285', '26', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('286', '26', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('287', '27', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('288', '27', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('289', '27', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('290', '27', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('291', '27', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('292', '27', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('293', '27', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('294', '27', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('295', '27', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('296', '27', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('297', '27', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('298', '28', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('299', '28', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('300', '28', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('301', '28', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('302', '28', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('303', '28', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('304', '28', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('305', '28', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('306', '28', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('307', '28', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('308', '28', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('309', '29', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('310', '29', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('311', '29', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('312', '29', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('313', '29', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('314', '29', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('315', '29', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('316', '29', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('317', '29', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('318', '29', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('319', '29', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('320', '30', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('321', '30', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('322', '30', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('323', '30', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('324', '30', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('325', '30', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('326', '30', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('327', '30', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('328', '30', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('329', '30', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('330', '30', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('331', '31', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('332', '31', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('333', '31', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('334', '31', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('335', '31', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('336', '31', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('337', '31', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('338', '31', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('339', '31', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('340', '31', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('341', '31', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('342', '32', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('343', '32', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('344', '32', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('345', '32', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('346', '32', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('347', '32', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('348', '32', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('349', '32', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('350', '32', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('351', '32', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('352', '32', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('353', '33', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('354', '33', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('355', '33', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('356', '33', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('357', '33', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('358', '33', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('359', '33', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('360', '33', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('361', '33', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('362', '33', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('363', '33', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('364', '34', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('365', '34', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('366', '34', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('367', '34', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('368', '34', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('369', '34', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('370', '34', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('371', '34', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('372', '34', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('373', '34', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('374', '34', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('375', '35', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('376', '35', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('377', '35', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('378', '35', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('379', '35', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('380', '35', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('381', '35', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('382', '35', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('383', '35', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('384', '35', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('385', '35', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('386', '36', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('387', '36', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('388', '36', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('389', '36', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('390', '36', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('391', '36', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('392', '36', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('393', '36', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('394', '36', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('395', '36', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('396', '36', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('397', '37', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('398', '37', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('399', '37', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('400', '37', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('401', '37', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('402', '37', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('403', '37', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('404', '37', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('405', '37', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('406', '37', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('407', '37', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('408', '38', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('409', '38', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('410', '38', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('411', '38', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('412', '38', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('413', '38', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('414', '38', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('415', '38', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('416', '38', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('417', '38', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('418', '38', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('419', '39', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('420', '39', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('421', '39', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('422', '39', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('423', '39', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('424', '39', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('425', '39', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('426', '39', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('427', '39', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('428', '39', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('429', '39', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('430', '40', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('431', '40', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('432', '40', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('433', '40', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('434', '40', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('435', '40', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('436', '40', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('437', '40', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('438', '40', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('439', '40', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('440', '40', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('441', '41', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('442', '41', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('443', '41', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('444', '41', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('445', '41', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('446', '41', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('447', '41', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('448', '41', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('449', '41', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('450', '41', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('451', '41', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('452', '42', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('453', '42', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('454', '42', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('455', '42', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('456', '42', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('457', '42', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('458', '42', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('459', '42', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('460', '42', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('461', '42', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('462', '42', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('463', '43', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('464', '43', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('465', '43', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('466', '43', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('467', '43', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('468', '43', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('469', '43', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('470', '43', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('471', '43', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('472', '43', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('473', '43', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('474', '44', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('475', '44', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('476', '44', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('477', '44', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('478', '44', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('479', '44', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('480', '44', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('481', '44', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('482', '44', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('483', '44', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('484', '44', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('485', '45', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('486', '45', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('487', '45', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('488', '45', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('489', '45', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('490', '45', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('491', '45', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('492', '45', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('493', '45', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('494', '45', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('495', '45', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('496', '46', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('497', '46', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('498', '46', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('499', '46', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('500', '46', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('501', '46', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('502', '46', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('503', '46', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('504', '46', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('505', '46', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('506', '46', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('507', '47', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('508', '47', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('509', '47', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('510', '47', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('511', '47', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('512', '47', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('513', '47', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('514', '47', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('515', '47', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('516', '47', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('517', '47', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('518', '48', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('519', '48', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('520', '48', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('521', '48', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('522', '48', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('523', '48', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('524', '48', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('525', '48', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('526', '48', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('527', '48', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('528', '48', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('529', '49', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('530', '49', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('531', '49', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('532', '49', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('533', '49', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('534', '49', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('535', '49', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('536', '49', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('537', '49', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('538', '49', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('539', '49', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('540', '50', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('541', '50', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('542', '50', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('543', '50', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('544', '50', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('545', '50', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('546', '50', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('547', '50', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('548', '50', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('549', '50', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('550', '50', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('551', '51', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('552', '51', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('553', '51', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('554', '51', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('555', '51', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('556', '51', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('557', '51', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('558', '51', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('559', '51', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('560', '51', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('561', '51', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('562', '52', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('563', '52', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('564', '52', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('565', '52', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('566', '52', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('567', '52', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('568', '52', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('569', '52', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('570', '52', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('571', '52', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('572', '52', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('573', '53', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('574', '53', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('575', '53', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('576', '53', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('577', '53', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('578', '53', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('579', '53', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('580', '53', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('581', '53', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('582', '53', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('583', '53', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('584', '54', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('585', '54', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('586', '54', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('587', '54', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('588', '54', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('589', '54', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('590', '54', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('591', '54', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('592', '54', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('593', '54', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('594', '54', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('595', '55', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('596', '55', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('597', '55', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('598', '55', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('599', '55', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('600', '55', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('601', '55', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('602', '55', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('603', '55', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('604', '55', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('605', '55', '11', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('606', '56', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('607', '56', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('608', '56', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('609', '56', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('610', '56', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('611', '56', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('612', '56', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('613', '56', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('614', '56', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('615', '56', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('616', '56', '11', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('617', '57', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('618', '57', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('619', '57', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('620', '57', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('621', '57', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('622', '57', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('623', '57', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('624', '57', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('625', '57', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('626', '57', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('627', '57', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('628', '58', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('629', '58', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('630', '58', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('631', '58', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('632', '58', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('633', '58', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('634', '58', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('635', '58', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('636', '58', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('637', '58', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('638', '58', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('639', '59', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('640', '59', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('641', '59', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('642', '59', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('643', '59', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('644', '59', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('645', '59', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('646', '59', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('647', '59', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('648', '59', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('649', '59', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('650', '60', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('651', '60', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('652', '60', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('653', '60', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('654', '60', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('655', '60', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('656', '60', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('657', '60', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('658', '60', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('659', '60', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('660', '60', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('661', '61', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('662', '61', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('663', '61', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('664', '61', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('665', '61', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('666', '61', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('667', '61', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('668', '61', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('669', '61', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('670', '61', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('671', '61', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('672', '62', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('673', '62', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('674', '62', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('675', '62', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('676', '62', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('677', '62', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('678', '62', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('679', '62', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('680', '62', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('681', '62', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('682', '62', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('683', '63', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('684', '63', '2', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('685', '63', '3', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('686', '63', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('687', '63', '5', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('688', '63', '6', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('689', '63', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('690', '63', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('691', '63', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('692', '63', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('693', '63', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('694', '64', '1', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('695', '64', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('696', '64', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('697', '64', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('698', '64', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('699', '64', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('700', '64', '7', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('701', '64', '8', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('702', '64', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('703', '64', '10', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('704', '64', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('705', '65', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('706', '65', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('707', '65', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('708', '65', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('709', '65', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('710', '65', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('711', '65', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('712', '65', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('713', '65', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('714', '65', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('715', '65', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('716', '66', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('717', '66', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('718', '66', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('719', '66', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('720', '66', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('721', '66', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('722', '66', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('723', '66', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('724', '66', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('725', '66', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('726', '66', '11', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('727', '67', '1', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('728', '67', '2', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('729', '67', '3', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('730', '67', '4', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('731', '67', '5', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('732', '67', '6', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('733', '67', '7', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('734', '67', '8', 'N');
INSERT INTO `wisata_berfasilitas` VALUES ('735', '67', '9', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('736', '67', '10', 'Y');
INSERT INTO `wisata_berfasilitas` VALUES ('737', '67', '11', 'Y');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wisata_berpendukung
-- ----------------------------
INSERT INTO `wisata_berpendukung` VALUES ('1', '1', '0', '', '', '', '', '', '', '');

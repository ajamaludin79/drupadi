/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 100108
Source Host           : localhost:3306
Source Database       : mymaps

Target Server Type    : MYSQL
Target Server Version : 100108
File Encoding         : 65001

Date: 2017-09-08 16:54:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for area_actionplan
-- ----------------------------
DROP TABLE IF EXISTS `area_actionplan`;
CREATE TABLE `area_actionplan` (
  `area_id` varchar(16) NOT NULL,
  `action` varchar(60) NOT NULL,
  `subaction` varchar(20) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  KEY `area_id` (`area_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_actionplan
-- ----------------------------
INSERT INTO `area_actionplan` VALUES ('1709001', 'sds', '', null, '2017-09-04 08:41:04', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709002', 'sds', '', null, '2017-09-04 08:41:54', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709008', 'Kacang', '', null, '2017-09-04 14:59:17', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709009', 'jack', '', null, '2017-09-04 16:56:15', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709010', 'jeruk', '', null, '2017-09-05 10:23:47', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709012', 'KECAPI', '', null, '2017-09-05 10:25:45', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709013', 'PEPAYA', '', null, '2017-09-05 10:35:07', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709014', 'KETIMUN', '', null, '2017-09-05 10:38:07', '1702005');
INSERT INTO `area_actionplan` VALUES ('1709015', 'DF', '', null, '2017-09-05 14:55:36', '1702005');

-- ----------------------------
-- Table structure for area_location
-- ----------------------------
DROP TABLE IF EXISTS `area_location`;
CREATE TABLE `area_location` (
  `area_id` varchar(16) NOT NULL,
  `area` varchar(60) NOT NULL,
  `type` varchar(30) NOT NULL,
  `m_tanam` date NOT NULL,
  `status` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `org_id` varchar(15) NOT NULL,
  `projectid` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  PRIMARY KEY (`area_id`),
  KEY `area_id` (`area_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_location
-- ----------------------------
INSERT INTO `area_location` VALUES ('1709001', 'sds', '', '0000-00-00', 'sdsds', '2017-09-04 08:41:04', '1702005', '2017-09-04 14:45:27', '1', '20160505', '1702005');
INSERT INTO `area_location` VALUES ('1709002', 'sds', '', '2017-02-02', 'sdsd', '2017-09-04 08:41:54', '1702005', '2017-09-04 14:43:54', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1709008', 'Kacang', 'IR 64', '2017-08-01', 'Daunya pada kering', '2017-09-04 14:59:17', '1702005', '2017-09-04 14:59:17', '1', '20160505', '1704001');
INSERT INTO `area_location` VALUES ('1709009', 'jack', 'IR 64', '2017-11-01', 'test', '2017-09-04 16:56:15', '1702005', '2017-09-04 16:56:15', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1709010', 'jeruk', 'IR 64', '2017-02-20', 'test', '2017-09-05 10:23:47', '1702005', '2017-09-05 10:23:47', '1', '20160507', '1707001');
INSERT INTO `area_location` VALUES ('1709012', 'KECAPI', 'IR 64', '2017-09-05', 'bijinya banyak', '2017-09-05 10:25:45', '1702005', '2017-09-05 10:25:45', '1', '20160507', '1707001');
INSERT INTO `area_location` VALUES ('1709013', 'PEPAYA', 'IR 64', '2017-08-30', 'daunnya kering', '2017-09-05 10:35:07', '1702005', '2017-09-05 10:35:07', '1', '20160507', '1704001');
INSERT INTO `area_location` VALUES ('1709014', 'KETIMUN', 'IR 64', '2017-02-02', 'ketimunnya pait', '2017-09-05 10:38:07', '1702005', '2017-09-05 10:38:07', '1', '20160507', '1707001');
INSERT INTO `area_location` VALUES ('1709015', 'DF', 'IR 67 test', '2017-01-30', 'test', '2017-09-05 14:55:36', '1702005', '2017-09-05 14:55:36', '1', '20160507', '1707001');
INSERT INTO `area_location` VALUES ('1709016', 'SINGKONG', 'ubi jalar', '2017-09-30', 'test', '2017-09-08 10:13:41', '1702005', '2017-09-08 10:13:41', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1709017', 'UBI', 'ubi jalar', '2017-12-20', 'sdsdsds', '2017-09-08 10:14:37', '1702005', '2017-09-08 10:14:37', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1709018', 'SD', 'sds', '2017-09-05', 'sdsd', '2017-09-08 16:12:07', '1702005', '2017-09-08 16:12:07', '1', '20160505', '1707001');

-- ----------------------------
-- Table structure for area_location_d
-- ----------------------------
DROP TABLE IF EXISTS `area_location_d`;
CREATE TABLE `area_location_d` (
  `area_id` varchar(16) NOT NULL,
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  KEY `area_id` (`area_id`),
  CONSTRAINT `are_fk2` FOREIGN KEY (`area_id`) REFERENCES `area_location` (`area_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_location_d
-- ----------------------------
INSERT INTO `area_location_d` VALUES ('1709001', '0.5591458734908274', '123.05674016475677');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5588401162154292', '123.05671334266663');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5585987288815019', '123.0577164888382');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5589313069834487', '123.0577701330185');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5577136419056331', '123.05648267269135');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5571182196833361', '123.05633783340454');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5569090172666156', '123.0569440126419');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5568285547966771', '123.05738389492035');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5568982889373524', '123.05738925933838');
INSERT INTO `area_location_d` VALUES ('1709002', '0.556635444864316', '123.05837631225586');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5568821964434257', '123.05838704109192');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5571504046698662', '123.05747509002686');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5574400695406988', '123.05750727653503');
INSERT INTO `area_location_d` VALUES ('1709008', '0.5578370176738845', '123.05908977985382');
INSERT INTO `area_location_d` VALUES ('1709008', '0.5575044395100569', '123.05903613567352');
INSERT INTO `area_location_d` VALUES ('1709008', '0.5573274220926269', '123.0596798658371');
INSERT INTO `area_location_d` VALUES ('1709008', '0.5577887401996616', '123.05975496768951');
INSERT INTO `area_location_d` VALUES ('1709008', '0.5578960234751951', '123.05907905101776');
INSERT INTO `area_location_d` VALUES ('1709009', '0.5580462200576418', '123.05754482746124');
INSERT INTO `area_location_d` VALUES ('1709009', '0.5576814569221817', '123.05689036846161');
INSERT INTO `area_location_d` VALUES ('1709009', '0.5576117227907682', '123.05808126926422');
INSERT INTO `area_location_d` VALUES ('1709010', '0.5591405093282378', '123.05675625801086');
INSERT INTO `area_location_d` VALUES ('1709010', '0.5587864745865171', '123.0567079782486');
INSERT INTO `area_location_d` VALUES ('1709010', '0.558604093044575', '123.05771112442017');
INSERT INTO `area_location_d` VALUES ('1709010', '0.5589473994717775', '123.05779159069061');
INSERT INTO `area_location_d` VALUES ('1709012', '0.5588186595639254', '123.05999636650085');
INSERT INTO `area_location_d` VALUES ('1709012', '0.55845389647639', '123.05992662906647');
INSERT INTO `area_location_d` VALUES ('1709012', '0.558416347333733', '123.06026458740234');
INSERT INTO `area_location_d` VALUES ('1709012', '0.5587650179348226', '123.06033432483673');
INSERT INTO `area_location_d` VALUES ('1709013', '0.5591834226288154', '123.06005537509918');
INSERT INTO `area_location_d` VALUES ('1709013', '0.5588562087039998', '123.05999636650085');
INSERT INTO `area_location_d` VALUES ('1709013', '0.5587864745865171', '123.06034505367279');
INSERT INTO `area_location_d` VALUES ('1709013', '0.5591297810030457', '123.06038796901703');
INSERT INTO `area_location_d` VALUES ('1709014', '0.5578906593114604', '123.05909514427185');
INSERT INTO `area_location_d` VALUES ('1709014', '0.5574776186895769', '123.0590307712555');
INSERT INTO `area_location_d` VALUES ('1709014', '0.5573435145853448', '123.0596798658371');
INSERT INTO `area_location_d` VALUES ('1709014', '0.5577511910527683', '123.05976569652557');
INSERT INTO `area_location_d` VALUES ('1709015', '0.559961226147363', '123.05691719055176');
INSERT INTO `area_location_d` VALUES ('1709015', '0.559408717451692', '123.05745899677277');
INSERT INTO `area_location_d` VALUES ('1709015', '0.5595267290221259', '123.05613934993744');
INSERT INTO `area_location_d` VALUES ('1709016', '0.5587811104236093', '123.0599856376648');
INSERT INTO `area_location_d` VALUES ('1709016', '0.5584860814556049', '123.05991590023041');
INSERT INTO `area_location_d` VALUES ('1709016', '0.5584002548439538', '123.06028604507446');
INSERT INTO `area_location_d` VALUES ('1709016', '0.5587542896089435', '123.06033432483673');
INSERT INTO `area_location_d` VALUES ('1709016', '0.5588293878896773', '123.05999100208282');
INSERT INTO `area_location_d` VALUES ('1709017', '0.5584378039866998', '123.05992662906647');
INSERT INTO `area_location_d` VALUES ('1709017', '0.558158867491961', '123.05986762046814');
INSERT INTO `area_location_d` VALUES ('1709017', '0.5580569483848058', '123.06023240089417');
INSERT INTO `area_location_d` VALUES ('1709017', '0.5583680698642556', '123.06025385856628');
INSERT INTO `area_location_d` VALUES ('1709018', '0.5592638850665539', '123.05604815483093');
INSERT INTO `area_location_d` VALUES ('1709018', '0.5589366711462292', '123.05597305297852');
INSERT INTO `area_location_d` VALUES ('1709018', '0.558942035308997', '123.05625200271606');
INSERT INTO `area_location_d` VALUES ('1709018', '0.5592424284165896', '123.0562949180603');

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for feed
-- ----------------------------
DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed` text,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of feed
-- ----------------------------
INSERT INTO `feed` VALUES ('1', 'test', '1', '20170715');

-- ----------------------------
-- Table structure for login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for organization_project
-- ----------------------------
DROP TABLE IF EXISTS `organization_project`;
CREATE TABLE `organization_project` (
  `projectid` varchar(15) NOT NULL,
  `organizationid` varchar(15) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of organization_project
-- ----------------------------
INSERT INTO `organization_project` VALUES ('1', 'PT ENCONA INTI ', '2017-04-13 14:35:24', '2017-08-09 14:24:41', '');
INSERT INTO `organization_project` VALUES ('2', 'encona engineer', '2017-03-21 10:46:50', '2017-03-24 09:29:35', '1702005');
INSERT INTO `organization_project` VALUES ('6', 'BUMDES GORONTAL', '2017-04-03 08:21:23', '2017-04-03 08:21:23', '1702005');
INSERT INTO `organization_project` VALUES ('C170001', 'asep inc', '2017-05-05 13:27:54', '2017-05-05 13:27:54', '1704003');

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `projectid` varchar(15) NOT NULL,
  `project` varchar(100) DEFAULT NULL,
  `imagepath` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('20160505', 'Ary MP 5 Dec 2017', 'jamal', '2017-04-13 14:35:24', '2017-08-10 10:33:54', '');
INSERT INTO `project` VALUES ('20160506', 'Ary MP 12 Dec 2017', 'jamal', '2017-04-13 14:35:24', '2017-08-10 10:34:02', '');
INSERT INTO `project` VALUES ('20160507', 'Ary MP 25 Dec 2017', 'jamal', '2017-04-13 14:35:24', '2017-08-10 10:34:09', '');

-- ----------------------------
-- Table structure for rf_organization
-- ----------------------------
DROP TABLE IF EXISTS `rf_organization`;
CREATE TABLE `rf_organization` (
  `org_id` varchar(15) NOT NULL,
  `organization` varchar(150) DEFAULT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rf_organization
-- ----------------------------
INSERT INTO `rf_organization` VALUES ('1', 'PT ENCONA INTI INDUSTRI', 'jamal', 'mail@encona.co.id', '021-8900530', '18 Office Park Building 12th Floor, Jalan T.B. Simatupang Kav 18, Pasar Minggu, Kebagusan, Jakarta Selatan 12520', 'public/img/logo-husada.png', '$2a$08$2yTusj7pT0p6uoOZwPXbc.YBE7AsanrS./PS7niPnEyKZ.bxdcCFi', '1', '2017-04-13 14:35:24', '', '2017-08-09 14:24:41');
INSERT INTO `rf_organization` VALUES ('1708001', 'TOFAN ENERGI', '1', 'ajsas@gmail.com', '454544545', 'sdsdsdsd', null, null, '1', '2017-08-11 10:21:37', '1', '2017-08-11 10:21:37');
INSERT INTO `rf_organization` VALUES ('1708002', 'TOPAZ', '1708001', 'ajsas@gmail.com', '4444', 'test', null, null, '1', '2017-08-11 11:02:06', '1', '2017-08-11 11:02:06');
INSERT INTO `rf_organization` VALUES ('1708003', 'WOKEH ENERGY', '1707001', 'dyah.sodikin@encona.co.id', '455454545', 'test', null, null, '1', '2017-08-11 11:16:16', '1', '2017-08-11 11:16:16');
INSERT INTO `rf_organization` VALUES ('1708004', 'WOWOWOY', '1', 'ssss@gmail.com', '7878787', 'stetes', null, null, '1', '2017-08-11 11:18:10', '1', '2017-08-11 11:18:10');
INSERT INTO `rf_organization` VALUES ('1708005', 'FLASH AND FLIP ENERGY', '1704001', 'jennis.fitria@encona.co.id', '1233333', 'test', null, null, '1', '2017-08-11 11:19:51', '1', '2017-08-11 11:19:51');
INSERT INTO `rf_organization` VALUES ('2', 'ENCONA ENGINEERING', '1708001', 'ajamaludin@gmail.com', '454545', '', null, null, '1', '2017-03-21 10:46:50', '1', '2017-08-11 13:59:04');
INSERT INTO `rf_organization` VALUES ('6', 'BUMDES GORONTALO', 'justin', 'justin.the@encona.co.id', '081133333', '', null, null, '1', '2017-04-03 08:21:23', '1', '2017-08-11 13:59:16');
INSERT INTO `rf_organization` VALUES ('c170001', 'ASEP INC', 'james', 'ajamaludin@gmail.com', '121212', '', null, null, '1', '2017-05-05 13:27:54', '1', '2017-08-11 13:58:53');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `org_id` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobilenumber` varchar(30) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `access` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `language` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `birthday` date NOT NULL,
  `jkelamin` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `alamat` text,
  `hide_menu` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `penugasan` set('1','0') DEFAULT '1',
  PRIMARY KEY (`id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1702005', '1', 'jamal', 'Jamal', 'Jamaludin', '$2a$08$RcXpDGgi1N1TIwWBAfGFU.PCvJSsdjSBJA66T8HBNGrzc7ApWrz0u', 'ajamaludin@gmail.com', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-09-08 15:15:11', '1702005.jpg', 'admin', null, '1989-04-05', '1', 'encona', '1', '2017-08-03 16:34:41', '2017-09-08 15:15:11', '1', '1');
INSERT INTO `users` VALUES ('1704001', '1', '1704001', 'justin', 'the', '$2a$08$hb9HSglUewBt0aGIb4.Py.0DbnEr06zOq6GY6k4fpM8Zu2qviaB6W', 'justin.the@encona.co.id', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-09-08 10:40:39', '1704001.png', 'user', 'id', '1985-04-03', '2', '', null, '2017-08-04 08:40:46', '2017-09-08 10:40:39', '1', '1');
INSERT INTO `users` VALUES ('1707001', '1', 'jamaludin', 'jack', 'daniels', '$2a$08$bDusM/O7Z9UEGgwY5HzUrONnuKYImsiVZk.a6D5xxdsKl3MmtqVS6', 'asep.jamaludin@encona.co.id', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-07-20 10:58:59', '1707001.png', 'admin', null, '2002-02-01', '1', 'test', null, '2017-08-08 10:29:59', '2017-09-04 08:49:58', '1', '1');
INSERT INTO `users` VALUES ('1708001', '6', 'jamalud87', 'JAMAL', 'UDINSS', '$2a$08$buqQAXa/StDCmLlkvOX2tumRG4szGLZX3DhH.qHgHrHha.5/NNK9m', 'ajamaludins@hotmail.com', '081311345499', '02121221212', '1', '0', null, null, null, null, null, '127.0.0.1', '0000-00-00 00:00:00', null, 'user', null, '2012-12-12', '1', 'test', null, '2017-08-03 16:35:47', '2017-08-28 10:07:42', '1', '1');

-- ----------------------------
-- Table structure for user_autologin
-- ----------------------------
DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user_autologin
-- ----------------------------

-- ----------------------------
-- Table structure for user_profiles
-- ----------------------------
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user_profiles
-- ----------------------------
INSERT INTO `user_profiles` VALUES ('1', '1', null, null);
INSERT INTO `user_profiles` VALUES ('2', '1707001', null, null);

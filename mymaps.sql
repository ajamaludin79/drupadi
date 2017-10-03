/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 100108
Source Host           : localhost:3306
Source Database       : mymaps

Target Server Type    : MYSQL
Target Server Version : 100108
File Encoding         : 65001

Date: 2017-10-02 15:00:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for area_actionplan
-- ----------------------------
DROP TABLE IF EXISTS `area_actionplan`;
CREATE TABLE `area_actionplan` (
  `area_id` varchar(16) NOT NULL,
  `action` varchar(100) NOT NULL,
  `subaction` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  KEY `area_id` (`area_id`),
  CONSTRAINT `area_actionplan_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area_location` (`area_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_actionplan
-- ----------------------------
INSERT INTO `area_actionplan` VALUES ('1709003', 'pestisida<br>', 'lt', '3', '2017-09-25 08:39:11', '1704001');
INSERT INTO `area_actionplan` VALUES ('1709003', 'Air', 'lt', '20', '2017-09-25 08:39:11', '1704001');
INSERT INTO `area_actionplan` VALUES ('1709003', 'pupuk', 'lt', '20', '2017-09-25 08:39:11', '1704001');

-- ----------------------------
-- Table structure for area_actionplan_old
-- ----------------------------
DROP TABLE IF EXISTS `area_actionplan_old`;
CREATE TABLE `area_actionplan_old` (
  `area_id` varchar(16) NOT NULL,
  `action` varchar(100) NOT NULL,
  `subaction` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  KEY `area_id` (`area_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_actionplan_old
-- ----------------------------
INSERT INTO `area_actionplan_old` VALUES ('1709016', 'df', 'dfd', 'fdf', '2017-09-13 10:53:39', '1702005');
INSERT INTO `area_actionplan_old` VALUES ('1709017', 'asa<br>', 'sasa', 'asas', '2017-09-13 11:16:08', '1702005');
INSERT INTO `area_actionplan_old` VALUES ('1709017', 'zxzxzx', 'zx', 'zxzx', '2017-09-13 11:16:08', '1702005');
INSERT INTO `area_actionplan_old` VALUES ('1709017', 'zxzx<br>', 'zxz', 'xzx', '2017-09-13 11:16:08', '1702005');

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
  `modified` datetime NOT NULL,
  `org_id` varchar(15) NOT NULL,
  `projectid` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  PRIMARY KEY (`area_id`),
  KEY `area_id` (`area_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_location
-- ----------------------------
INSERT INTO `area_location` VALUES ('1709001', 'PADI SPECIAL', 'nk1', '2017-09-05', 'sehat', '2017-09-20 13:03:07', '1704001', '0000-00-00 00:00:00', '1', '20160507', '1707001');
INSERT INTO `area_location` VALUES ('1709002', 'PADI CILACAP', 'k1', '2017-09-04', ' ', '2017-09-20 13:04:07', '1704001', '0000-00-00 00:00:00', '1', '20160507', '1702005');
INSERT INTO `area_location` VALUES ('1709003', 'PADI CILACAP', 'k1', '2017-09-04', ' ', '2017-09-20 13:04:09', '1704001', '0000-00-00 00:00:00', '1', '20160507', '1702005');
INSERT INTO `area_location` VALUES ('1709004', 'SDSD', 'dssds', '2017-09-08', 'sdsd', '2017-09-25 09:21:33', '1709001', '0000-00-00 00:00:00', '1709001', '1709001', '1709002');
INSERT INTO `area_location` VALUES ('1709005', 'DFD', 'dfdf', '2017-09-21', 'dfdf', '2017-09-25 10:32:04', '1702005', '0000-00-00 00:00:00', '1', '', '1707001');

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
INSERT INTO `area_location_d` VALUES ('1709001', '0.5598673533143967', '123.05941700935364');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5597922550469193', '123.0597522854805');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5592317000915883', '123.05967181921005');
INSERT INTO `area_location_d` VALUES ('1709001', '0.5592692492290163', '123.05933386087418');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5598003012899261', '123.05976569652557');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5597466596697797', '123.06013584136963');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5594462665879878', '123.06009292602539');
INSERT INTO `area_location_d` VALUES ('1709002', '0.5594999082108822', '123.05972278118134');
INSERT INTO `area_location_d` VALUES ('1709003', '0.5598003012899261', '123.05976569652557');
INSERT INTO `area_location_d` VALUES ('1709003', '0.5597466596697797', '123.06013584136963');
INSERT INTO `area_location_d` VALUES ('1709003', '0.5594462665879878', '123.06009292602539');
INSERT INTO `area_location_d` VALUES ('1709003', '0.5594999082108822', '123.05972278118134');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5592317000915883', '123.05966913700104');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5588132954010432', '123.05966377258301');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5588293878896773', '123.0599856376648');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5591834226288154', '123.06005537509918');
INSERT INTO `area_location_d` VALUES ('1709005', '0.5594999082108822', '123.05972278118134');
INSERT INTO `area_location_d` VALUES ('1709005', '0.5592424284165896', '123.05971205234528');
INSERT INTO `area_location_d` VALUES ('1709005', '0.5591887867913669', '123.06004464626312');
INSERT INTO `area_location_d` VALUES ('1709005', '0.559440902425678', '123.0600768327713');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------
INSERT INTO `login_attempts` VALUES ('1', '127.0.0.1', 'fgfg', '2017-09-27 08:11:37');
INSERT INTO `login_attempts` VALUES ('3', '127.0.0.1', 'xzxz', '2017-09-27 08:15:29');

-- ----------------------------
-- Table structure for markers
-- ----------------------------
DROP TABLE IF EXISTS `markers`;
CREATE TABLE `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of markers
-- ----------------------------
INSERT INTO `markers` VALUES ('1', 'Love.Fish', '580 Darling Street, Rozelle, NSW', '-33.861034', '151.171936', 'restaurant');
INSERT INTO `markers` VALUES ('2', 'Young Henrys', '76 Wilford Street, Newtown, NSW', '-33.898113', '151.174469', 'bar');

-- ----------------------------
-- Table structure for organization_project
-- ----------------------------
DROP TABLE IF EXISTS `organization_project`;
CREATE TABLE `organization_project` (
  `projectid` varchar(15) NOT NULL,
  `organizationid` varchar(15) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
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
  `modified` datetime NOT NULL,
  `created_by` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `org_id` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `lat` varchar(200) NOT NULL,
  `long` varchar(200) NOT NULL,
  `imglnorth` varchar(200) DEFAULT NULL,
  `imglsouth` varchar(200) DEFAULT NULL,
  `imgleast` varchar(200) DEFAULT NULL,
  `imglwest` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1709001', 'XXX PROYEK', '59c87c98dce36.png', '2017-09-25 09:16:12', '2017-09-25 10:48:40', '1709001', '1709001', '0.5585831513372275', '123.05879216169362', '0.556706230317291', '123.05865000461586', '0.5601580693606888', '123.06106935714729');
INSERT INTO `project` VALUES ('1709002', 'JOKO PRY', '59c88143329a1.jpg', '2017-09-25 11:08:35', '0000-00-00 00:00:00', '1702005', '1', '', '', null, null, null, null);
INSERT INTO `project` VALUES ('20160505', 'Ary MP 5 Dec 2017', '1491411269.png', '2017-04-13 14:35:24', '2017-08-10 10:33:54', '', '1', '0.5585831513372275', '123.05879216169362', '0.556706230317291', '123.05865000461586', '0.5601580693606888', '123.06106935714729');
INSERT INTO `project` VALUES ('20160506', 'Ary MP 12 Dec 2017', '1491411269.png', '2017-04-13 14:35:24', '2017-08-10 10:34:02', '', '1', '0.5585831513372275', '123.05879216169362', '0.556706230317291', '123.05865000461586', '0.5601580693606888', '123.06106935714729');
INSERT INTO `project` VALUES ('20160507', 'Ary MP 25 Dec 2017', '1491411269.png', '2017-04-13 14:35:24', '2017-09-20 20:02:49', '1704001', '1', '0.5585831513372275', '123.05879216169362', '0.556706230317291', '123.05865000461586', '0.5601580693606888', '123.06106935714729');

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
  `modified` datetime NOT NULL,
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
INSERT INTO `rf_organization` VALUES ('1709001', 'TOPAN COMPANY', '1709001', 'aaa@xxx.com', '08121212', 'wewew', null, null, '1', '2017-09-25 09:09:09', '1702005', '0000-00-00 00:00:00');
INSERT INTO `rf_organization` VALUES ('1709002', 'JOKO ORG', '1709004', 'joko@xx.com', '12333', 'sds', null, null, '1', '2017-09-25 11:08:17', '1702005', '2017-09-25 13:42:19');
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
INSERT INTO `users` VALUES ('1702005', '1', 'jamal', 'Jamal', 'Jamaludin', '$2a$08$RcXpDGgi1N1TIwWBAfGFU.PCvJSsdjSBJA66T8HBNGrzc7ApWrz0u', 'ajamaludin@gmail.com', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-09-27 16:45:53', '1702005.jpg', 'admin', null, '1989-04-05', '1', 'encona', '', '2017-08-03 16:34:41', '2017-09-27 16:45:53', '1', '1');
INSERT INTO `users` VALUES ('1704001', '1', 'justin', 'justin', 'the', '$2a$08$hb9HSglUewBt0aGIb4.Py.0DbnEr06zOq6GY6k4fpM8Zu2qviaB6W', 'justin.the@encona.co.id', null, null, '1', '0', null, null, null, null, null, '202.74.73.186', '2017-09-25 08:41:08', '1704001.png', 'spv', 'id', '1985-04-03', '2', '', '', '2017-08-04 08:40:46', '2017-09-25 01:41:08', '1', '1');
INSERT INTO `users` VALUES ('1707001', '1', 'jamaludin', 'jack', 'daniels', '$2a$08$bDusM/O7Z9UEGgwY5HzUrONnuKYImsiVZk.a6D5xxdsKl3MmtqVS6', 'asep.jamaludin@encona.co.id', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-07-20 10:58:59', '1707001.png', 'admin', null, '2002-02-01', '1', 'test', null, '2017-08-08 10:29:59', '2017-09-04 08:49:58', '1', '1');
INSERT INTO `users` VALUES ('1708001', '6', 'jamalud87', 'JAMAL', 'UDINSS', '$2a$08$buqQAXa/StDCmLlkvOX2tumRG4szGLZX3DhH.qHgHrHha.5/NNK9m', 'ajamaludins@hotmail.com', '081311345499', '02121221212', '1', '0', null, null, null, null, null, '127.0.0.1', '0000-00-00 00:00:00', null, 'user', null, '2012-12-12', '1', 'test', null, '2017-08-03 16:35:47', '2017-08-28 10:07:42', '1', '1');
INSERT INTO `users` VALUES ('1709001', '1709001', 'alito6', 'ALI', 'TOPAN', '$2a$08$v3EIF7tTYshL6FZ4WGdj..8xcyXjctBjR21e2VpB8qHFEKq6e2/7e', 'ali.topan@xxx.com', '0855886699', '12345454', '1', '0', null, null, null, null, null, '127.0.0.1', '2017-09-25 10:49:00', null, 'spv', null, '1985-09-30', '1', '', '', '2017-09-25 09:07:53', '2017-09-25 11:03:15', '1702005', '1');
INSERT INTO `users` VALUES ('1709002', '1709001', 'jhonyha81', 'JHONY', 'HALLO', '$2a$08$Q4x2tZg5Qd8DbhYKox/OTOBSLFZCVNJxl9mfxJl3GJo1kztbMsx2u', 'jhony@xxx.com', '45454', 'sdsd', '1', '0', null, null, null, null, null, '202.74.73.186', '0000-00-00 00:00:00', null, 'user', null, '1987-09-30', '1', 'dsdsd', null, '2017-09-25 09:13:21', '2017-09-25 02:13:21', '1709001', '1');
INSERT INTO `users` VALUES ('1709003', '1709001', 'sdsds53', 'SDS', 'DSDS', '$2a$08$6n0WDiGsSkXyAog./5YTZu0imoIe7JZBzf5mtdtQ7scRO.XETBq.m', 'asasa@email.com', 'sd', 'sd', '1', '0', null, null, null, null, null, '127.0.0.1', '0000-00-00 00:00:00', null, 'user', null, '2017-09-25', '1', 'sd', null, '2017-09-25 11:04:54', '2017-09-25 11:04:54', '1709001', '1');
INSERT INTO `users` VALUES ('1709004', '1709002', 'jokosu88', 'JOKO', 'SUSANTO', '$2a$08$Z0b1W9XIyhA1/Ml.u/g3NefxiijYylN7NV7zFrOYgV2TE3dKCLCM6', 'joko@xx.com', 'dsd', 'dsds', '1', '0', null, null, null, null, null, '127.0.0.1', '0000-00-00 00:00:00', null, 'user', null, '2017-09-25', '1', 'sdsd', null, '2017-09-25 11:06:31', '2017-09-25 13:42:19', '1702005', '1');

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
INSERT INTO `user_autologin` VALUES ('4712a0404cc798c074b5c9d5db32088c', '1704001', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', '118.136.1.192', '2017-09-20 13:03:45');
INSERT INTO `user_autologin` VALUES ('c6fa9f7ff4d5d20184335e3d81ea7def', '1704001', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36', '202.74.73.186', '2017-09-25 01:20:30');

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

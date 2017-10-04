/*
Navicat MySQL Data Transfer

Source Server         : map.eidaramata.com
Source Server Version : 50552
Source Host           : localhost:3306
Source Database       : eidaramata_map

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-10-04 14:49:22
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
INSERT INTO `area_actionplan` VALUES ('1710012', '', '', '', '2017-10-03 09:07:02', '1704001');
INSERT INTO `area_actionplan` VALUES ('1710012', 'Pupuk N', 'lt', '20', '2017-10-03 09:07:02', '1704001');
INSERT INTO `area_actionplan` VALUES ('1710012', 'Air', 'lt', '10', '2017-10-03 09:07:02', '1704001');

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
  KEY `area_index` (`area`,`org_id`,`projectid`,`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area_location
-- ----------------------------
INSERT INTO `area_location` VALUES ('1709004', 'SDSD', 'dssds', '2017-09-08', 'sdsd', '2017-09-25 09:21:33', '1709001', '0000-00-00 00:00:00', '1709001', '1709001', '1709002');
INSERT INTO `area_location` VALUES ('1710001', 'INTANI1', 'hibrida', '2017-09-01', 'Sehat', '2017-10-03 08:51:52', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710002');
INSERT INTO `area_location` VALUES ('1710002', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 08:53:16', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710002');
INSERT INTO `area_location` VALUES ('1710003', 'INTANI1', 'hibrida', '2017-09-01', 'SEhat', '2017-10-03 08:53:50', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710002');
INSERT INTO `area_location` VALUES ('1710004', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 08:54:23', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710002');
INSERT INTO `area_location` VALUES ('1710005', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 08:54:46', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710002');
INSERT INTO `area_location` VALUES ('1710006', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 09:02:45', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710003');
INSERT INTO `area_location` VALUES ('1710007', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 09:03:10', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710003');
INSERT INTO `area_location` VALUES ('1710008', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 09:03:33', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710003');
INSERT INTO `area_location` VALUES ('1710009', 'ROKAN', 'unggul', '2017-10-01', 'sehat', '2017-10-03 09:04:11', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1710010', 'ROKAN', 'unggul', '2017-10-01', 'sehat', '2017-10-03 09:04:37', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1707001');
INSERT INTO `area_location` VALUES ('1710011', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 09:05:05', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710003');
INSERT INTO `area_location` VALUES ('1710012', 'INTANI1', 'hibrida', '2017-09-01', 'sehat', '2017-10-03 09:05:36', '1704001', '0000-00-00 00:00:00', '1', '20160505', '1710003');

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
INSERT INTO `area_location_d` VALUES ('1709004', '0.5592317000915883', '123.05966913700104');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5588132954010432', '123.05966377258301');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5588293878896773', '123.0599856376648');
INSERT INTO `area_location_d` VALUES ('1709004', '0.5591834226288154', '123.06005537509918');
INSERT INTO `area_location_d` VALUES ('1710001', '0.5599397694999558', '123.05911123752594');
INSERT INTO `area_location_d` VALUES ('1710001', '0.5598807637191916', '123.05944919586182');
INSERT INTO `area_location_d` VALUES ('1710001', '0.5592853417164292', '123.05934190750122');
INSERT INTO `area_location_d` VALUES ('1710001', '0.5593711683151544', '123.0589771270752');
INSERT INTO `area_location_d` VALUES ('1710002', '0.5598727174763121', '123.05945724248886');
INSERT INTO `area_location_d` VALUES ('1710002', '0.5598003012899261', '123.05978178977966');
INSERT INTO `area_location_d` VALUES ('1710002', '0.5592290180103315', '123.05967718362808');
INSERT INTO `area_location_d` VALUES ('1710002', '0.5592880237976477', '123.05934458971024');
INSERT INTO `area_location_d` VALUES ('1710003', '0.5598083475328947', '123.05978178977966');
INSERT INTO `area_location_d` VALUES ('1710003', '0.5597359313456943', '123.0601304769516');
INSERT INTO `area_location_d` VALUES ('1710003', '0.5594489486691554', '123.06008756160736');
INSERT INTO `area_location_d` VALUES ('1710003', '0.5595133186165168', '123.05972009897232');
INSERT INTO `area_location_d` VALUES ('1710004', '0.5595106365353874', '123.05972278118134');
INSERT INTO `area_location_d` VALUES ('1710004', '0.5594543128314652', '123.06008756160736');
INSERT INTO `area_location_d` VALUES ('1710004', '0.5591887867913669', '123.06003928184509');
INSERT INTO `area_location_d` VALUES ('1710004', '0.5592290180103315', '123.05968523025513');
INSERT INTO `area_location_d` VALUES ('1710005', '0.559738613426722', '123.0601304769516');
INSERT INTO `area_location_d` VALUES ('1710005', '0.5596635151576163', '123.06047648191452');
INSERT INTO `area_location_d` VALUES ('1710005', '0.5591002781086625', '123.060382604599');
INSERT INTO `area_location_d` VALUES ('1710005', '0.5591861047100976', '123.06005001068115');
INSERT INTO `area_location_d` VALUES ('1710006', '0.5591700122224175', '123.06006342172623');
INSERT INTO `area_location_d` VALUES ('1710006', '0.5588106133195829', '123.05999636650085');
INSERT INTO `area_location_d` VALUES ('1710006', '0.5587650179348226', '123.06033164262772');
INSERT INTO `area_location_d` VALUES ('1710006', '0.559089549783394', '123.06038796901703');
INSERT INTO `area_location_d` VALUES ('1710007', '0.5592156076040354', '123.0596798658371');
INSERT INTO `area_location_d` VALUES ('1710007', '0.5591700122224175', '123.06004196405411');
INSERT INTO `area_location_d` VALUES ('1710007', '0.5588025670752531', '123.0599856376648');
INSERT INTO `area_location_d` VALUES ('1710007', '0.5588454803782987', '123.05962890386581');
INSERT INTO `area_location_d` VALUES ('1710008', '0.5593416654219798', '123.05897980928421');
INSERT INTO `area_location_d` VALUES ('1710008', '0.5592182896853048', '123.05965572595596');
INSERT INTO `area_location_d` VALUES ('1710008', '0.5588508445411556', '123.05961549282074');
INSERT INTO `area_location_d` VALUES ('1710008', '0.5589125324136723', '123.05926948785782');
INSERT INTO `area_location_d` VALUES ('1710008', '0.5592907058788916', '123.05896371603012');
INSERT INTO `area_location_d` VALUES ('1710009', '0.5592531567415908', '123.0589610338211');
INSERT INTO `area_location_d` VALUES ('1710009', '0.5582929715776186', '123.05880546569824');
INSERT INTO `area_location_d` VALUES ('1710009', '0.5582178732900274', '123.0591407418251');
INSERT INTO `area_location_d` VALUES ('1710009', '0.5588883936810264', '123.05925607681274');
INSERT INTO `area_location_d` VALUES ('1710010', '0.5588749832739415', '123.05926948785782');
INSERT INTO `area_location_d` VALUES ('1710010', '0.5582795611691851', '123.05985420942307');
INSERT INTO `area_location_d` VALUES ('1710010', '0.5581052258568405', '123.0598247051239');
INSERT INTO `area_location_d` VALUES ('1710010', '0.5582178732900274', '123.0591568350792');
INSERT INTO `area_location_d` VALUES ('1710011', '0.558883029518195', '123.05929362773895');
INSERT INTO `area_location_d` VALUES ('1710011', '0.5587757462606889', '123.05997222661972');
INSERT INTO `area_location_d` VALUES ('1710011', '0.5582554224339439', '123.05988371372223');
INSERT INTO `area_location_d` VALUES ('1710012', '0.5587837925050569', '123.05999368429184');
INSERT INTO `area_location_d` VALUES ('1710012', '0.5587355150386073', '123.06032091379166');
INSERT INTO `area_location_d` VALUES ('1710012', '0.5579711217668956', '123.06018948554993');
INSERT INTO `area_location_d` VALUES ('1710012', '0.5582581045156331', '123.0598971247673');

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
-- Table structure for login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `index_project` (`ip_address`,`login`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------
INSERT INTO `login_attempts` VALUES ('11', '139.194.136.126', 'justin5678', '2017-10-03 12:05:16');
INSERT INTO `login_attempts` VALUES ('12', '139.194.136.126', 'justin5678', '2017-10-03 12:05:17');

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
  PRIMARY KEY (`projectid`),
  KEY `index_project` (`project`,`org_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1709001', 'XXX PROYEK', '59c866ec32d4c.png', '2017-09-25 09:16:12', '0000-00-00 00:00:00', '1702005', '1709001', '0.5585831513372275', '123.05879216169362', '0.556706230317291', '123.05865000461586', '0.5601580693606888', '123.06106935714729');
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
INSERT INTO `rf_organization` VALUES ('1', 'PT ENCONA INTI INDUSTRI', '1704001', 'mail@encona.co.id', '021-8900530', '18 Office Park Building 12th Floor, Jalan T.B. Simatupang Kav 18, Pasar Minggu, Kebagusan, Jakarta Selatan 12520', 'public/img/logo-husada.png', '$2a$08$2yTusj7pT0p6uoOZwPXbc.YBE7AsanrS./PS7niPnEyKZ.bxdcCFi', '1', '2017-04-13 14:35:24', '1702005', '2017-10-03 09:44:31');
INSERT INTO `rf_organization` VALUES ('1708001', 'TOFAN ENERGI', '1', 'ajsas@gmail.com', '454544545', 'sdsdsdsd', null, null, '1', '2017-08-11 10:21:37', '1', '2017-08-11 10:21:37');
INSERT INTO `rf_organization` VALUES ('1708002', 'TOPAZ', '1708001', 'ajsas@gmail.com', '4444', 'test', null, null, '1', '2017-08-11 11:02:06', '1', '2017-08-11 11:02:06');
INSERT INTO `rf_organization` VALUES ('1708003', 'WOKEH ENERGY', '1707001', 'dyah.sodikin@encona.co.id', '455454545', 'test', null, null, '1', '2017-08-11 11:16:16', '1', '2017-08-11 11:16:16');
INSERT INTO `rf_organization` VALUES ('1708004', 'WOWOWOY', '1', 'ssss@gmail.com', '7878787', 'stetes', null, null, '1', '2017-08-11 11:18:10', '1', '2017-08-11 11:18:10');
INSERT INTO `rf_organization` VALUES ('1708005', 'FLASH AND FLIP ENERGY', '1704001', 'jennis.fitria@encona.co.id', '1233333', 'test', null, null, '1', '2017-08-11 11:19:51', '1', '2017-08-11 11:19:51');
INSERT INTO `rf_organization` VALUES ('1709001', 'TOPAN COMPANY', '1709001', 'aaa@xxx.com', '08121212', 'wewew', null, null, '1', '2017-09-25 09:09:09', '1702005', '0000-00-00 00:00:00');
INSERT INTO `rf_organization` VALUES ('2', 'ENCONA ENGINEERING', '1708001', 'ajamaludin@gmail.com', '454545', '', null, null, '1', '2017-03-21 10:46:50', '1', '2017-08-11 13:59:04');
INSERT INTO `rf_organization` VALUES ('6', 'BUMDES GORONTALO', 'justin', 'justin.the@encona.co.id', '081133333', '', null, null, '1', '2017-04-03 08:21:23', '1', '2017-08-11 13:59:16');
INSERT INTO `rf_organization` VALUES ('c170001', 'ASEP INC', 'james', 'ajamaludin@gmail.com', '121212', '', null, null, '1', '2017-05-05 13:27:54', '1', '2017-08-11 13:58:53');

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
  PRIMARY KEY (`id`,`email`),
  KEY `index_login` (`org_id`,`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1702005', '1', 'jamal', 'Jamal', 'Jamaludin', '$2a$08$RcXpDGgi1N1TIwWBAfGFU.PCvJSsdjSBJA66T8HBNGrzc7ApWrz0u', 'ajamaludin@gmail.com', null, null, '1', '0', null, null, null, null, null, '202.74.73.186', '2017-10-04 14:10:09', '1702005.jpg', 'admin', null, '1989-04-05', '1', 'encona', '1', '2017-08-03 16:34:41', '2017-10-04 07:10:09', '1', '1');
INSERT INTO `users` VALUES ('1704001', '1', 'justin', 'justin', 'the', '$2a$08$hb9HSglUewBt0aGIb4.Py.0DbnEr06zOq6GY6k4fpM8Zu2qviaB6W', 'justin.the@encona.co.id', '12121212', '', '1', '0', null, null, null, null, null, '139.194.136.126', '2017-10-03 19:05:19', '1704001.png', 'spv', 'id', '1985-04-03', '2', '', '', '2017-10-03 09:44:51', '2017-10-03 12:05:19', '1702005', '1');
INSERT INTO `users` VALUES ('1707001', '1', 'jamaludin', 'jack', 'daniels', '$2a$08$bDusM/O7Z9UEGgwY5HzUrONnuKYImsiVZk.a6D5xxdsKl3MmtqVS6', 'asep.jamaludin@encona.co.id', null, null, '1', '0', null, null, null, null, null, '127.0.0.1', '2017-07-20 10:58:59', '1707001.png', 'admin', null, '2002-02-01', '1', 'test', null, '2017-08-08 10:29:59', '2017-09-04 08:49:58', '1', '1');
INSERT INTO `users` VALUES ('1708001', '6', 'jamalud87', 'JAMAL', 'UDINSS', '$2a$08$buqQAXa/StDCmLlkvOX2tumRG4szGLZX3DhH.qHgHrHha.5/NNK9m', 'ajamaludins@hotmail.com', '081311345499', '02121221212', '1', '0', null, null, null, null, null, '127.0.0.1', '0000-00-00 00:00:00', null, 'user', null, '2012-12-12', '1', 'test', null, '2017-08-03 16:35:47', '2017-08-28 10:07:42', '1', '1');
INSERT INTO `users` VALUES ('1709001', '1709001', 'alito6', 'ALI', 'TOPAN', '$2a$08$v3EIF7tTYshL6FZ4WGdj..8xcyXjctBjR21e2VpB8qHFEKq6e2/7e', 'ali.topan@xxx.com', '0855886699', '12345454', '1', '0', null, null, null, null, null, '202.74.73.186', '2017-09-25 09:20:25', null, 'spv', null, '1985-09-30', '1', '', '1', '2017-09-25 09:07:53', '2017-09-25 02:22:08', '1702005', '1');
INSERT INTO `users` VALUES ('1709002', '1709001', 'jhonyha81', 'JHONY', 'HALLO', '$2a$08$Q4x2tZg5Qd8DbhYKox/OTOBSLFZCVNJxl9mfxJl3GJo1kztbMsx2u', 'jhony@xxx.com', '45454', 'sdsd', '1', '0', null, null, null, null, null, '202.74.73.186', '0000-00-00 00:00:00', null, 'user', null, '1987-09-30', '1', 'dsdsd', null, '2017-09-25 09:13:21', '2017-09-25 02:13:21', '1709001', '1');
INSERT INTO `users` VALUES ('1710001', '1', 'rizkipr44', 'RIZKI', 'PRATAMA', '$2a$08$bWjYcgWCy/SslNRWRvSEK.R9xsjDLa9ypIvLjU.3TQIVAe8fXxU3S', 'rpratama@email.com', '08123456', '12345', '1', '0', null, null, null, null, null, '202.74.73.186', '0000-00-00 00:00:00', null, 'user', null, '2009-02-05', '1', 'Jakarta', null, '2017-10-03 08:45:59', '2017-10-03 01:45:59', '1704001', '1');
INSERT INTO `users` VALUES ('1710002', '1', 'mustofaal92', 'MUSTOFA', 'AL', '$2a$08$d4/jocU/nfaRFwXory.LpuAaLF673.ZzBNYkAU2uxqc1JhK3anu2a', 'mustofa@email.com', '1234566', '12345', '1', '0', null, null, null, null, null, '202.74.73.186', '0000-00-00 00:00:00', null, 'user', null, '1980-10-12', '1', 'jakarta', null, '2017-10-03 08:47:00', '2017-10-03 01:47:00', '1704001', '1');
INSERT INTO `users` VALUES ('1710003', '1', 'bernardar36', 'BERNARD', 'ARIONO', '$2a$08$ewtbfQPhDEJDQJp29UHUTe6y/tLhc783GSL4GtrhjMNMOxK3FD2Ym', 'pass@email.com', '1234', '1234', '1', '0', null, null, null, null, null, '202.74.73.186', '0000-00-00 00:00:00', null, 'user', null, '2007-12-12', '1', 'jakarta', null, '2017-10-03 08:50:31', '2017-10-03 01:50:31', '1704001', '1');

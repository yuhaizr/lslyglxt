/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : lslyglxt

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-11-06 14:00:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oyyq_access`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_access`;
CREATE TABLE `oyyq_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oyyq_access
-- ----------------------------
INSERT INTO `oyyq_access` VALUES ('2', '1', '1', null, null);
INSERT INTO `oyyq_access` VALUES ('2', '11', '3', null, '10');
INSERT INTO `oyyq_access` VALUES ('2', '20', '3', null, '19');
INSERT INTO `oyyq_access` VALUES ('2', '100', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '400', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '21', '3', null, '10');
INSERT INTO `oyyq_access` VALUES ('1', '1', '1', null, null);
INSERT INTO `oyyq_access` VALUES ('1', '2', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '3', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '5', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '100', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '300', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '200', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '19', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('1', '4', '3', null, '3');
INSERT INTO `oyyq_access` VALUES ('1', '6', '3', null, '5');
INSERT INTO `oyyq_access` VALUES ('1', '101', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('1', '102', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('1', '103', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('1', '104', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('1', '302', '3', null, '300');
INSERT INTO `oyyq_access` VALUES ('1', '201', '3', null, '200');
INSERT INTO `oyyq_access` VALUES ('1', '202', '3', null, '200');
INSERT INTO `oyyq_access` VALUES ('1', '20', '3', null, '19');
INSERT INTO `oyyq_access` VALUES ('3', '1', '1', null, null);
INSERT INTO `oyyq_access` VALUES ('3', '19', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('3', '200', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('3', '300', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('3', '100', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('3', '101', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('3', '103', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('3', '302', '3', null, '300');
INSERT INTO `oyyq_access` VALUES ('3', '20', '3', null, '19');
INSERT INTO `oyyq_access` VALUES ('2', '19', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '200', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '300', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '502', '3', null, '500');
INSERT INTO `oyyq_access` VALUES ('2', '101', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('2', '102', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('2', '103', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('2', '104', '3', null, '100');
INSERT INTO `oyyq_access` VALUES ('2', '401', '3', null, '400');
INSERT INTO `oyyq_access` VALUES ('2', '402', '3', null, '400');
INSERT INTO `oyyq_access` VALUES ('2', '201', '3', null, '200');
INSERT INTO `oyyq_access` VALUES ('2', '202', '3', null, '200');
INSERT INTO `oyyq_access` VALUES ('2', '301', '3', null, '300');
INSERT INTO `oyyq_access` VALUES ('2', '302', '3', null, '300');
INSERT INTO `oyyq_access` VALUES ('2', '501', '3', null, '500');
INSERT INTO `oyyq_access` VALUES ('2', '500', '2', null, '1');
INSERT INTO `oyyq_access` VALUES ('2', '503', '3', null, '500');

-- ----------------------------
-- Table structure for `oyyq_check_work`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_check_work`;
CREATE TABLE `oyyq_check_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `is_valid` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_check_work
-- ----------------------------
INSERT INTO `oyyq_check_work` VALUES ('2', '2016-10-28', '1', '2016-10-29 17:43:10', '2016-10-29 17:43:24', '1');
INSERT INTO `oyyq_check_work` VALUES ('3', '2016-10-27', '1', '2016-10-29 17:46:49', '2016-10-29 17:46:24', '1');
INSERT INTO `oyyq_check_work` VALUES ('4', '2016-10-29', '1', '2016-10-29 17:47:10', '2016-10-29 17:47:14', '1');
INSERT INTO `oyyq_check_work` VALUES ('5', '2016-10-29', '4', '2016-10-29 19:06:08', '2016-10-29 19:06:14', '1');

-- ----------------------------
-- Table structure for `oyyq_hotel`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_hotel`;
CREATE TABLE `oyyq_hotel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin NOT NULL,
  `intro` text COLLATE utf8_bin,
  `addr` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `cyear` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `myear` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `average_price` bigint(20) DEFAULT NULL,
  `start` bigint(20) DEFAULT NULL,
  `totalnum` bigint(20) DEFAULT NULL,
  `strategy` text COLLATE utf8_bin,
  `is_valid` bigint(20) DEFAULT '1',
  `ctime` datetime DEFAULT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_hotel
-- ----------------------------
INSERT INTO `oyyq_hotel` VALUES ('1', '1', 0xE69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0E69292E5A4A7E5A3B0E59CB0, '1', '2016-04', '2016-07', '1', '1', '1', 0xE998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB76173E998BFE890A8E5BEB7E998BFE890A8E5BEB7, '1', '2016-10-29 08:44:52', '1');
INSERT INTO `oyyq_hotel` VALUES ('2', '121', 0x31, '1', '2016-02', '2016-09', '1', '1', '1', 0x31, '1', '2016-10-29 09:41:40', '1');
INSERT INTO `oyyq_hotel` VALUES ('3', '', 0xE6B094E6B8A9E6B094E6B8A9, null, null, null, null, null, null, null, '1', '2016-10-29 21:36:18', '1');

-- ----------------------------
-- Table structure for `oyyq_local_product`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_local_product`;
CREATE TABLE `oyyq_local_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `intro` text COLLATE utf8_bin,
  `average_price` double(20,2) DEFAULT NULL,
  `unit` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `best_produc_area` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  `is_valid` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_local_product
-- ----------------------------
INSERT INTO `oyyq_local_product` VALUES ('1', '232问问', 0xE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891E58EBBE8AFB7E997AEE8AFB7E997AEE8AFB7E68891E58EBBE68891, '1225.22', '1 阿萨德', '请我去我去请问请问请我去我去请问请问请我去我去请问请问请我去我去请问请问请我去我去请问请问请我去我去请问请问请我去我去请问请问请我去我去请问请问', '2016-10-29 10:58:44', '1', '0');
INSERT INTO `oyyq_local_product` VALUES ('2', '1212', 0x31323132, '1211.00', '元', '12', '2016-10-29 11:19:40', '1', '1');
INSERT INTO `oyyq_local_product` VALUES ('3', 'wqeqwe', '', '0.00', '', '', '2016-10-29 11:20:09', '1', '0');
INSERT INTO `oyyq_local_product` VALUES ('4', 'asddddddddd 水电费水电费收到', 0x617364646464646464646420E6B0B4E794B5E8B4B9E6B0B4E794B5E8B4B9E694B6E588B0E58F91E98081E588B0E58F91E98081E588B0E6B0B4E794B5E8B4B9E68980E58F91E7949FE79A84E6B0B4E794B5E8B4B9736466617364646464646464646420E6B0B4E794B5E8B4B9E6B0B4E794B5E8B4B9E694B6E588B0E58F91E98081E588B0E58F91E98081E588B0E6B0B4E794B5E8B4B9E68980E58F91E7949FE79A84E6B0B4E794B5E8B4B9736466617364646464646464646420E6B0B4E794B5E8B4B9E6B0B4E794B5E8B4B9E694B6E588B0E58F91E98081E588B0E58F91E98081E588B0E6B0B4E794B5E8B4B9E68980E58F91E7949FE79A84E6B0B4E794B5E8B4B9736466617364646464646464646420E6B0B4E794B5E8B4B9E6B0B4E794B5E8B4B9E694B6E588B0E58F91E98081E588B0E58F91E98081E588B0E6B0B4E794B5E8B4B9E68980E58F91E7949FE79A84E6B0B4E794B5E8B4B9736466, '111.00', '元/斤', 'asddddddddd 水电费水电费收到发送到发送到水电费所发生的水电费sdfasddddddddd 水电费水电费收到发送到发送到水电费所发生的水电费sdfasddddddddd 水电费水电费收到发送到发送到水电费所发生的水电费sdfasddddddddd 水电费水电费收', '2016-10-29 11:20:36', '1', '1');

-- ----------------------------
-- Table structure for `oyyq_news`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_news`;
CREATE TABLE `oyyq_news` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin,
  `is_valid` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_news
-- ----------------------------

-- ----------------------------
-- Table structure for `oyyq_node`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_node`;
CREATE TABLE `oyyq_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=504 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oyyq_node
-- ----------------------------
INSERT INTO `oyyq_node` VALUES ('1', 'Home', 'Home', '1', null, null, '0', '1');
INSERT INTO `oyyq_node` VALUES ('2', 'System', '系统管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('3', 'Role', '角色管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('4', 'roleList', '角色列表', '1', null, null, '3', '3');
INSERT INTO `oyyq_node` VALUES ('5', 'User', '用户管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('6', 'userList', '用户列表', '1', null, null, '5', '3');
INSERT INTO `oyyq_node` VALUES ('401', 'showList', '路线列表', '1', null, null, '400', '3');
INSERT INTO `oyyq_node` VALUES ('400', 'TourRoute', '线路管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('100', 'ScenicSpot', '景点管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('101', 'showList', '景点列表', '1', null, null, '100', '3');
INSERT INTO `oyyq_node` VALUES ('300', 'LocalProduct', '庐山特产管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('301', 'add', '添加庐山特产', '1', null, null, '300', '3');
INSERT INTO `oyyq_node` VALUES ('302', 'showList', '庐山特产列表', '1', null, null, '300', '3');
INSERT INTO `oyyq_node` VALUES ('200', 'Hotel', '酒店管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('201', 'add', '添加酒店', '1', null, null, '200', '3');
INSERT INTO `oyyq_node` VALUES ('202', 'showList', '酒店列表', '1', null, null, '200', '3');
INSERT INTO `oyyq_node` VALUES ('102', 'add', '添加景点', '1', null, null, '100', '3');
INSERT INTO `oyyq_node` VALUES ('19', 'Index', '主页', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('20', 'index', '主页', '1', null, null, '19', '3');
INSERT INTO `oyyq_node` VALUES ('103', 'detail', '景点详情', '1', null, null, '100', '3');
INSERT INTO `oyyq_node` VALUES ('104', 'modify', '修改景点', '1', null, null, '100', '3');
INSERT INTO `oyyq_node` VALUES ('402', 'add', '添加旅游路线', '1', null, null, '400', '3');
INSERT INTO `oyyq_node` VALUES ('500', 'CheckWork', '考勤管理', '1', null, null, '1', '2');
INSERT INTO `oyyq_node` VALUES ('501', 'add', '员工考勤(页面显示)', '1', null, null, '500', '3');
INSERT INTO `oyyq_node` VALUES ('502', 'showList', '考勤记录', '1', null, null, '500', '3');
INSERT INTO `oyyq_node` VALUES ('503', 'save', '员工考勤', '1', null, null, '500', '3');

-- ----------------------------
-- Table structure for `oyyq_role`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_role`;
CREATE TABLE `oyyq_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oyyq_role
-- ----------------------------
INSERT INTO `oyyq_role` VALUES ('1', '管理员', '0', '1', '11');
INSERT INTO `oyyq_role` VALUES ('2', '普通员工', '0', '1', '普通员工');
INSERT INTO `oyyq_role` VALUES ('3', '游客', '0', '1', '游客');

-- ----------------------------
-- Table structure for `oyyq_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_role_user`;
CREATE TABLE `oyyq_role_user` (
  `role_id` mediumint(9) unsigned NOT NULL,
  `user_id` char(32) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oyyq_role_user
-- ----------------------------
INSERT INTO `oyyq_role_user` VALUES ('1', '1');
INSERT INTO `oyyq_role_user` VALUES ('1', '2');
INSERT INTO `oyyq_role_user` VALUES ('2', '4');
INSERT INTO `oyyq_role_user` VALUES ('3', '5');
INSERT INTO `oyyq_role_user` VALUES ('3', '6');
INSERT INTO `oyyq_role_user` VALUES ('3', '7');
INSERT INTO `oyyq_role_user` VALUES ('3', '8');
INSERT INTO `oyyq_role_user` VALUES ('3', '9');

-- ----------------------------
-- Table structure for `oyyq_scenic_spot`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_scenic_spot`;
CREATE TABLE `oyyq_scenic_spot` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin NOT NULL,
  `intro` text COLLATE utf8_bin,
  `traffic` text COLLATE utf8_bin,
  `ticket` text COLLATE utf8_bin,
  `start_time` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `end_time` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `playtime` double DEFAULT NULL COMMENT '游玩时间',
  `is_valid` bigint(20) DEFAULT '1' COMMENT '是否有效',
  `ctime` datetime DEFAULT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_scenic_spot
-- ----------------------------
INSERT INTO `oyyq_scenic_spot` VALUES ('1', '庐山三叠泉', 0xE4B889E58FA0E6B389E58F88E5908DE4B889E7BAA7E6B389E38081E6B0B4E5B898E6B389EFBC8CE4BD8DE4BA8EE6B19FE8A5BFE79C81E89197E5908DE9A38EE699AFE58CBAE5BA90E5B1B1E9A38EE699AFE58CBAE4B8ADE38082E58FA4E4BABAE7A7B0E2809CE58CA1E5BA90E78091E5B883EFBC8CE9A696E68EA8E4B889E58FA0E2809DEFBC8CE8AA89E4B8BAE2809CE5BA90E5B1B1E7ACACE4B880E5A587E8A782E2809DEFBC8CE794B1E5A4A7E69C88E5B1B1E38081E4BA94E88081E5B3B0E79A84E6B6A7E6B0B4E6B187E59088EFBC8CE4BB8EE5A4A7E69C88E5B1B1E6B581E587BAEFBC8CE7BB8FE8BF87E4BA94E88081E5B3B0E8838CEFBC8CE794B1E58C97E5B496E682ACE58FA3E6B3A8E585A5E5A4A7E79B98E79FB3E4B88AEFBC8CE58F88E9A39EE6B3BBE588B0E4BA8CE7BAA7E5A4A7E79B98E79FB3EFBC8CE5868DE596B7E6B492E887B3E4B889E7BAA7E79B98E79FB3EFBC8CE5BDA2E68890E4B889E58FA0EFBC8CE59BA0E6ADA4E5BE97E5908DE380820D0AE4B889E58FA0E6B389E6AF8FE58FA0E59084E585B7E789B9E889B2EFBC8CE4B880E58FA0E79BB4E59E82EFBC8CE6B0B4E4BB8E3230E5A49AE7B1B3E79A84E5B785E89081E8838CE4B88AE4B880E580BEE8808CE4B88BEFBC9BE4BA8CE58FA0E5BCAFE69BB2EFBC8CE79BB4E585A5E6BDADE4B8ADE38082E7AB99E59CA8E7ACACE4B889E58FA0E68AACE5A4B4E4BBB0E69C9BEFBC8CE4B889E58FA0E6B389E68A9BE78FA0E6BA85E78E89EFBC8CE5AE9BE5A682E799BDE9B9ADE58D83E78987EFBC8CE4B88AE4B88BE4BA89E9A39EEFBC9BE58F88E5A682E799BEE589AFE586B0E7BBA1EFBC8CE68A96E885BEE995BFE7A9BAEFBC8CE4B887E6969BE6988EE78FA0EFBC8CE4B99DE5A4A9E9A39EE6B492E38082E5A682E69E9CE698AFE69AAEE698A5E5889DE5A48FE5A49AE99BA8E5ADA3E88A82EFBC8CE9A39EE78091E5A682E58F91E68092E79A84E78E89E9BE99EFBC8CE586B2E7A0B4E99D92E5A4A9EFBC8CE5878CE7A9BAE9A39EE4B88BEFBC8CE99BB7E5A3B0E8BDB0E9B8A3EFBC8CE4BBA4E4BABAE58FB9E4B8BAE8A782E6ADA2E38082E69585E69C89E2809CE4B88DE588B0E4B889E58FA0E6B389EFBC8CE4B88DE7AE97E5BA90E5B1B1E5AEA2E2809DE4B98BE8AFB4E38082, 0xE4B889E58FA0E6B389E5B19EE4BA8EE5BA90E5B1B1E9A38EE699AFE5908DE8839CE58CBAEFBC8CE588B0E8BEBEE5BA90E5B1B1E9A38EE699AFE5908DE8839CE58CBAE69C89E4BBA5E4B88BE696B9E5BC8F0D0AE887AAE9A9BEEFBC9A312E20E4BB8EE4B99DE6B19FE696B9E59091E587BAE58F91EFBC9AE78EAFE5BA90E5B1B1E5A4A7E98193E887B3E5BA90E5B1B1E4B89CE997A8322E20E4BB8EE58D97E6988CE696B9E59091E587BAE58F91EFBC9AE6B2BFE4BAACE4B99DE9AB98E9809FEFBC8CE6989FE5AD90E4B88BE9AB98E9809FE7BB8FE78EAFE5BA90E5B1B1E585ACE8B7AFE4BEBFE58FAFE8BEBEEFBC9B, 0xE587ADE5A4A7E997A8E7A5A8E5858DE8B4B9EFBC8CE4BD86E5A682E4BB8EE5B1B1E4B88BE5BA90E5B1B1E58CBAE6B5B7E4BC9AE99587E5898DE5BE80E4B889E58FA0E6B389EFBC8CE4BB8DE99C80E8B4AD3634E58583E997A8E7A5A80D0AE5858DE7A5A8E694BFE7AD96EFBC9AE584BFE7ABA5E8BAABE9AB98312E326DE4BBA5E4B88BE5858DE8B4B9EFBC9B3730E5B281E4BBA5E4B88AE68C81E8BAABE4BBBDE8AF81E5858DE7A5A8EFBC9BE78EB0E5BDB9E5869BE4BABAE68C81E5869BE5AE98E8AF81E5858DE7A5A80D0AE4BC98E683A0E694BFE7AD96EFBC9AE584BFE7ABA5E8BAABE9AB98312E322D312E346DE8B4ADE584BFE7ABA5E7A5A8, '4:30', '21:15', '18', '1', '2016-10-28 23:09:33', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('2', '111', 0x313131, 0x313131, 0x313131, '23:00', '23:00', '11', '0', '2016-10-28 23:10:21', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('3', '22', 0x3232, 0x3232, 0x3232, '7:00', '7:00', '22', '1', '2016-10-29 06:52:16', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('4', '3', 0x33, 0x33, 0x33, '7:00', '7:00', '3', '1', '2016-10-29 06:53:32', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('5', '4', 0x34, 0x34, 0x34, '7:00', '7:00', '4', '1', '2016-10-29 06:53:55', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('6', '6', 0x36, 0x36, 0x36, '7:00', '7:00', '0', '1', '2016-10-29 06:54:26', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('7', '7', 0x37, 0x37, 0x37, '7:00', '7:00', '7', '1', '2016-10-29 06:54:40', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('8', '8', 0x38, '', '', '7:00', '7:00', '0', '1', '2016-10-29 06:54:50', '1');
INSERT INTO `oyyq_scenic_spot` VALUES ('9', '9', 0x3131323132, 0x31323132, '', '7:00', '7:00', '0', '1', '2016-10-29 06:55:23', '1');

-- ----------------------------
-- Table structure for `oyyq_suggestion`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_suggestion`;
CREATE TABLE `oyyq_suggestion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `is_valid` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_suggestion
-- ----------------------------
INSERT INTO `oyyq_suggestion` VALUES ('1', 0x4153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB0617364, '1', '2016-10-29 21:37:37', '1');
INSERT INTO `oyyq_suggestion` VALUES ('3', 0x53446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB0617364415353445157416173E69292446173646173E69292E5A4A7E5A3B0E59CB06173644153534451574153444153446173646173E69292E5A4A7E5A3B0E59CB061736441, '1', '2016-10-29 21:41:15', '1');

-- ----------------------------
-- Table structure for `oyyq_tour_route`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_tour_route`;
CREATE TABLE `oyyq_tour_route` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin NOT NULL,
  `reason` text COLLATE utf8_bin,
  `scenic_spot_list` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `price` double DEFAULT NULL,
  `day_num` double DEFAULT NULL,
  `ctime` date DEFAULT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  `is_valid` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_tour_route
-- ----------------------------
INSERT INTO `oyyq_tour_route` VALUES ('1', '啊实打实大声道阿萨德阿萨', 0xE998BFE890A8E5BEB7E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958AE5958AE5AE9EE68993E5AE9EE5A4A7E5A3B0E98193E998BFE890A8E5BEB7E998BFE890A8E5BEB7E5AE89E68A9AE698AFE590A6E595A5E4BA8BE5958A, '', '11.1', '1', '0000-00-00', '1', '0');
INSERT INTO `oyyq_tour_route` VALUES ('2', 'asdas asd asasd', 0x617364617364202C2C6173646173646173, '', '0', '0', '2016-10-29', '1', null);
INSERT INTO `oyyq_tour_route` VALUES ('3', 'qweqw', 0x7177657177657177, '4,1', '1212', '112', '2016-10-29', '1', '1');

-- ----------------------------
-- Table structure for `oyyq_user`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_user`;
CREATE TABLE `oyyq_user` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `nickname` varchar(256) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `status` bigint(11) NOT NULL DEFAULT '1',
  `last_login_time` datetime DEFAULT NULL,
  `login_count` bigint(20) DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `remark` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_user
-- ----------------------------
INSERT INTO `oyyq_user` VALUES ('1', 'super_admin', '超级管理员', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-11-04 21:57:13', '1', '0.0.0.0', '超级管理员不需要付利就能操作');
INSERT INTO `oyyq_user` VALUES ('2', 'admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-10-29 07:59:33', '1', '0.0.0.0', '');
INSERT INTO `oyyq_user` VALUES ('3', '12131', '1111', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-10-29 18:57:04', '1', '0.0.0.0', '');
INSERT INTO `oyyq_user` VALUES ('4', 'yg1', '普通员工1', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-10-29 19:04:44', '1', '0.0.0.0', '');
INSERT INTO `oyyq_user` VALUES ('5', 'ykykyk1', '游客1', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-10-30 00:38:03', '1', '0.0.0.0', null);
INSERT INTO `oyyq_user` VALUES ('6', 'ykykyk2', 'you asd', 'e10adc3949ba59abbe56e057f20f883e', '1', null, null, null, null);
INSERT INTO `oyyq_user` VALUES ('7', 'sadasdas', '2121', 'e10adc3949ba59abbe56e057f20f883e', '1', null, null, null, null);
INSERT INTO `oyyq_user` VALUES ('8', 'wewewer', 'wewe', 'e10adc3949ba59abbe56e057f20f883e', '1', null, null, null, null);
INSERT INTO `oyyq_user` VALUES ('9', 'ouyangyuqing', '欧阳雨晴', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-10-30 00:38:51', '1', '0.0.0.0', null);

-- ----------------------------
-- Table structure for `oyyq_visitors`
-- ----------------------------
DROP TABLE IF EXISTS `oyyq_visitors`;
CREATE TABLE `oyyq_visitors` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `totalnum` bigint(20) NOT NULL,
  `date` varchar(16) COLLATE utf8_bin NOT NULL,
  `ctime` datetime DEFAULT NULL,
  `cuid` bigint(20) DEFAULT NULL,
  `is_valid` bigint(20) DEFAULT '1',
  `scenic_spot_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of oyyq_visitors
-- ----------------------------
INSERT INTO `oyyq_visitors` VALUES ('1', '1000', '2016-10-28', '2016-10-29 22:25:31', '1', '1', '5');
INSERT INTO `oyyq_visitors` VALUES ('2', '1232', '2016-10-13', '2016-10-29 22:48:45', '1', '1', '6');
INSERT INTO `oyyq_visitors` VALUES ('3', '1212', '2016-10-27', '2016-10-29 22:51:03', '1', '1', '5');
INSERT INTO `oyyq_visitors` VALUES ('4', '1', '2016-10-19', '2016-10-29 22:51:13', '1', '1', '9');
INSERT INTO `oyyq_visitors` VALUES ('5', '778', '2016-09-26', '2016-10-29 22:53:39', '1', '1', '9');

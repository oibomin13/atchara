/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : thesisdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-13 19:54:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for eb_borrow
-- ----------------------------
DROP TABLE IF EXISTS `eb_borrow`;
CREATE TABLE `eb_borrow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `borrow_date` date DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `return_status` tinyint(1) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_borrow
-- ----------------------------
INSERT INTO `eb_borrow` VALUES ('12', '2019-01-18', '2019-01-19', '1', '7', '2019-01-18 09:09:51', '2019-01-18 09:11:34', '6', '1');
INSERT INTO `eb_borrow` VALUES ('14', '2019-01-21', '2019-01-21', '1', '3', '2019-01-21 14:26:48', '2019-01-22 06:16:26', '4', '4');
INSERT INTO `eb_borrow` VALUES ('16', '2019-01-22', '2019-01-22', '1', '7', '2019-01-22 06:10:40', '2019-01-22 06:13:44', '6', '6');
INSERT INTO `eb_borrow` VALUES ('20', '2019-01-23', '2019-01-23', '1', '10', '2019-01-23 04:12:20', '2019-01-23 04:38:36', '4', '8');
INSERT INTO `eb_borrow` VALUES ('22', '2019-01-23', '2019-01-23', '2', '9', '2019-01-23 04:57:50', '2019-01-23 05:02:25', '4', '8');
INSERT INTO `eb_borrow` VALUES ('23', '2019-01-23', '2019-01-23', '1', '10', '2019-01-23 05:04:01', '2019-01-23 05:04:45', '4', '8');
INSERT INTO `eb_borrow` VALUES ('24', '2019-01-23', '2019-01-24', '1', '11', '2019-01-23 05:07:27', '2019-01-23 05:09:37', '8', '8');
INSERT INTO `eb_borrow` VALUES ('25', '2019-01-23', '2019-01-24', '2', '11', '2019-01-23 05:10:09', '2019-02-02 20:12:05', '9', '8');
INSERT INTO `eb_borrow` VALUES ('26', '2019-01-02', '2019-01-08', '2', '10', '2019-01-26 12:58:08', '2019-02-02 20:12:16', '9', '8');
INSERT INTO `eb_borrow` VALUES ('27', '2019-01-23', '2019-01-27', '1', '10', '2019-01-27 08:34:03', '2019-01-28 05:52:55', '9', '8');
INSERT INTO `eb_borrow` VALUES ('31', '2019-01-27', '2019-01-27', '1', '10', '2019-01-27 08:44:59', '2019-01-28 05:53:29', '4', '8');
INSERT INTO `eb_borrow` VALUES ('32', '2019-01-30', '2019-01-31', '1', '9', '2019-01-30 18:20:36', '2019-02-02 16:33:45', '8', '8');
INSERT INTO `eb_borrow` VALUES ('36', '2019-02-01', '2019-02-21', '1', '9', '2019-02-01 10:52:50', '2019-02-02 16:28:12', '9', '8');
INSERT INTO `eb_borrow` VALUES ('37', '2019-02-01', '2019-02-02', '1', '9', '2019-02-01 10:56:10', '2019-02-02 16:33:49', '9', '8');
INSERT INTO `eb_borrow` VALUES ('38', '2019-02-02', '2019-02-02', '2', '13', '2019-02-02 12:58:47', '2019-02-07 15:22:10', '11', '11');
INSERT INTO `eb_borrow` VALUES ('39', '2019-02-02', '2019-02-13', '2', '11', '2019-02-02 14:45:10', '2019-02-08 13:15:44', '9', '8');
INSERT INTO `eb_borrow` VALUES ('41', '2019-02-02', '2019-02-21', '2', '9', '2019-02-02 15:23:19', '2019-02-02 16:34:15', '8', '8');
INSERT INTO `eb_borrow` VALUES ('42', '2019-02-02', '2019-02-13', '2', '9', '2019-02-02 15:26:04', '2019-02-02 16:35:10', '8', '8');
INSERT INTO `eb_borrow` VALUES ('43', '2019-02-02', '2019-02-08', '2', '9', '2019-02-02 15:59:08', '2019-02-09 13:44:40', '8', '8');
INSERT INTO `eb_borrow` VALUES ('44', '2019-02-02', '2019-02-09', '2', '11', '2019-02-02 16:59:22', '2019-02-02 17:01:29', '9', '8');
INSERT INTO `eb_borrow` VALUES ('45', '2019-02-02', '2019-02-03', '2', '9', '2019-02-02 18:55:13', '2019-02-02 18:55:45', '8', '8');
INSERT INTO `eb_borrow` VALUES ('46', '2019-02-02', '2019-02-20', '2', '9', '2019-02-02 20:10:54', '2019-02-02 20:11:13', '8', '8');
INSERT INTO `eb_borrow` VALUES ('47', '2019-02-02', '2019-02-13', '2', '9', '2019-02-02 20:17:26', '2019-02-02 20:17:35', '8', '8');
INSERT INTO `eb_borrow` VALUES ('48', '2019-02-02', '2019-02-28', '2', '9', '2019-02-02 20:18:32', '2019-02-02 20:18:49', '8', '8');
INSERT INTO `eb_borrow` VALUES ('49', '2019-02-07', '2019-02-08', '2', '13', '2019-02-07 15:32:53', '2019-02-07 22:21:06', '11', '8');
INSERT INTO `eb_borrow` VALUES ('50', '2019-02-07', '2019-02-08', '2', '13', '2019-02-07 22:51:54', '2019-02-07 22:58:35', '11', '8');
INSERT INTO `eb_borrow` VALUES ('51', '2019-02-09', '2019-02-12', '2', '9', '2019-02-09 13:44:08', '2019-02-09 13:44:22', '8', '8');
INSERT INTO `eb_borrow` VALUES ('64', '2019-02-09', '2019-03-07', '1', '9', '2019-02-09 17:45:09', '2019-02-09 18:51:28', '8', '8');
INSERT INTO `eb_borrow` VALUES ('65', '2019-02-09', '2019-02-09', '2', '9', '2019-02-09 18:42:22', '2019-02-09 18:42:36', '8', '8');
INSERT INTO `eb_borrow` VALUES ('66', '2019-02-09', '2019-03-09', '2', '9', '2019-02-09 19:46:06', '2019-02-09 19:46:42', '8', '8');
INSERT INTO `eb_borrow` VALUES ('67', '2019-02-09', '2019-02-15', '2', '11', '2019-02-09 20:27:49', '2019-02-13 13:52:36', '9', '9');

-- ----------------------------
-- Table structure for eb_borrow_detail
-- ----------------------------
DROP TABLE IF EXISTS `eb_borrow_detail`;
CREATE TABLE `eb_borrow_detail` (
  `id` int(11) NOT NULL,
  `return_status` tinyint(1) DEFAULT NULL,
  `borrow_quantity` decimal(10,2) DEFAULT NULL,
  `return_quantity` decimal(10,2) DEFAULT NULL,
  `borrow_id` bigint(20) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `serial_number_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`borrow_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_borrow_detail
-- ----------------------------
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '1', '5', '1');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '7', '6', '7');
INSERT INTO `eb_borrow_detail` VALUES ('1', '0', '1.00', '0.00', '10', '5', '4');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '5.00', '5.00', '12', '3', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '14', '5', '3');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '16', '5', '2');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '20', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '22', '5', '2');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '23', '2', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '24', '4', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '25', '4', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '26', '6', '8');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '27', '5', '1');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '1.00', '31', '2', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '0.00', '32', '5', '3');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '0.00', '36', '5', '2');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '0.00', '37', '5', '1');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '3.00', '0.00', '38', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '39', '6', '7');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '41', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '42', '1', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '43', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '44', '6', '8');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '45', '2', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '5.00', '0.00', '46', '7', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '47', '6', '7');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '48', '3', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '3.00', '0.00', '49', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '50', '2', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '51', '6', '7');
INSERT INTO `eb_borrow_detail` VALUES ('1', '1', '1.00', '0.00', '64', '1', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '65', '6', '8');
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '1.00', '66', '1', null);
INSERT INTO `eb_borrow_detail` VALUES ('1', '2', '1.00', '0.00', '67', '6', '7');
INSERT INTO `eb_borrow_detail` VALUES ('2', '1', '3.00', '3.00', '7', '3', null);
INSERT INTO `eb_borrow_detail` VALUES ('2', '1', '1.00', '1.00', '31', '5', '3');
INSERT INTO `eb_borrow_detail` VALUES ('2', '2', '1.00', '1.00', '42', '6', '6');
INSERT INTO `eb_borrow_detail` VALUES ('3', '1', '2.00', '2.00', '31', '6', '6');

-- ----------------------------
-- Table structure for eb_category
-- ----------------------------
DROP TABLE IF EXISTS `eb_category`;
CREATE TABLE `eb_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_category
-- ----------------------------
INSERT INTO `eb_category` VALUES ('15', 'วัสดุสำนักงาน');
INSERT INTO `eb_category` VALUES ('16', 'วัสดุก่อสร้าง');

-- ----------------------------
-- Table structure for eb_department
-- ----------------------------
DROP TABLE IF EXISTS `eb_department`;
CREATE TABLE `eb_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_department
-- ----------------------------
INSERT INTO `eb_department` VALUES ('1', 'บัญชี');
INSERT INTO `eb_department` VALUES ('2', 'เทคโนโลยีสารสนเทศ');
INSERT INTO `eb_department` VALUES ('3', 'คลังสินค้า');

-- ----------------------------
-- Table structure for eb_member
-- ----------------------------
DROP TABLE IF EXISTS `eb_member`;
CREATE TABLE `eb_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `address` text,
  `department_id` int(11) DEFAULT NULL,
  `membertype_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `idcard` varchar(15) NOT NULL,
  `usertype` varchar(11) NOT NULL,
  `key` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_member
-- ----------------------------
INSERT INTO `eb_member` VALUES ('9', 'แอดมิน วีวี', '123', 'adminn', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', '', '096739857', '56/7', '1', '3', '2019-01-23 03:59:34', '2019-01-30 18:20:47', '1', '8', '1234567891234', 'ADMIN', 'f033c3afb738452d887c774e7a2b93e504624f8e', '2019-02-13 11:53:37');
INSERT INTO `eb_member` VALUES ('10', 'วารุณี อิ่นแก้ว', '1234', 'tester001', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', '', '0934387843', null, '1', '4', '2019-01-23 04:11:41', '2019-01-23 04:11:47', '8', '8', '1357898765432', 'USER', null, null);
INSERT INTO `eb_member` VALUES ('11', 'พิมอัปสร พิม', '135', 'pppppp', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', '', '083567823', null, '3', '4', '2019-01-23 05:06:08', null, '8', null, '3456789012345', 'USER', null, null);
INSERT INTO `eb_member` VALUES ('16', 'testetetst', 'estestset', 'test1234', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', '123456', '1234561111', 'test', '2', '4', '2019-02-13 13:51:06', '2019-02-13 13:51:33', '9', '9', '123456', 'USER', null, null);

-- ----------------------------
-- Table structure for eb_membertype
-- ----------------------------
DROP TABLE IF EXISTS `eb_membertype`;
CREATE TABLE `eb_membertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_membertype
-- ----------------------------
INSERT INTO `eb_membertype` VALUES ('3', 'แอดมิน');
INSERT INTO `eb_membertype` VALUES ('4', 'พนักงาน');

-- ----------------------------
-- Table structure for eb_product
-- ----------------------------
DROP TABLE IF EXISTS `eb_product`;
CREATE TABLE `eb_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `is_serial_number` tinyint(1) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `is_return` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_product
-- ----------------------------
INSERT INTO `eb_product` VALUES ('1', 'คอมพิวเตอร์', 'SK00123456', '9.00', '0', '2', '17', '2019-01-23 21:21:54', '2018-04-20 23:58:48', '1', '1', '1');
INSERT INTO `eb_product` VALUES ('2', 'ปากกาด้านดี', 'SK0032990', '20.00', '0', '40', '15', '2018-04-20 23:56:08', '2018-04-20 23:56:53', '1', '1', '1');
INSERT INTO `eb_product` VALUES ('3', 'ดินสอเขียนงาม', 'SK0392480', '100.00', '0', '40', '15', '2018-04-20 23:56:44', '2019-02-02 19:15:37', '1', '8', '1');
INSERT INTO `eb_product` VALUES ('4', 'ยางลบคุณภาพดี', 'SK02349008', '29.00', '0', '70', '15', '2018-04-20 23:59:28', null, '1', null, '1');
INSERT INTO `eb_product` VALUES ('5', 'คอมพิวเตอร์ Acer', 'AC032948234', '0.00', '1', '34', '15', '2018-04-21 00:01:15', '2019-02-09 17:49:39', '1', '8', '1');
INSERT INTO `eb_product` VALUES ('6', 'เหล็ก', 'AC0924709', '0.00', '1', '34', '16', '2018-04-21 00:02:12', '2019-02-02 20:20:24', '1', '8', '0');
INSERT INTO `eb_product` VALUES ('7', 'test', 'test', '5.00', '0', '15', '16', '2019-02-02 19:16:24', '2019-02-02 20:08:20', '8', '8', '0');
INSERT INTO `eb_product` VALUES ('8', 'testtest', 'tests', '32.00', '0', '2', '17', '2019-02-09 13:50:31', null, '8', null, '1');
INSERT INTO `eb_product` VALUES ('12', 'ดดดดด', '22222', '2.00', '0', '2', '17', '2019-02-09 18:52:53', null, '8', null, '1');
INSERT INTO `eb_product` VALUES ('13', 'พพพพพพ', '00006', '123.00', '0', '4', '17', '2019-02-09 19:34:42', '2019-02-09 20:09:34', '8', '8', '1');

-- ----------------------------
-- Table structure for eb_serial_number
-- ----------------------------
DROP TABLE IF EXISTS `eb_serial_number`;
CREATE TABLE `eb_serial_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_serial_number
-- ----------------------------
INSERT INTO `eb_serial_number` VALUES ('1', 'AC001', '10.00', '5');
INSERT INTO `eb_serial_number` VALUES ('2', 'AC002', '10.00', '5');
INSERT INTO `eb_serial_number` VALUES ('3', 'AC003', '10.00', '5');
INSERT INTO `eb_serial_number` VALUES ('4', 'AC004', '10.00', '5');
INSERT INTO `eb_serial_number` VALUES ('6', 'B320474', '3.00', '6');
INSERT INTO `eb_serial_number` VALUES ('7', 'B02923487', '1.00', '6');
INSERT INTO `eb_serial_number` VALUES ('8', 'B2048234', '3.00', '6');
INSERT INTO `eb_serial_number` VALUES ('9', 'B2492324', '5.00', '6');
INSERT INTO `eb_serial_number` VALUES ('10', 'SLSOI08342-23489327', '3.00', '8');
INSERT INTO `eb_serial_number` VALUES ('11', 'SLDFKU-2-47-000', '2.00', '8');

-- ----------------------------
-- Table structure for eb_unit
-- ----------------------------
DROP TABLE IF EXISTS `eb_unit`;
CREATE TABLE `eb_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_unit
-- ----------------------------
INSERT INTO `eb_unit` VALUES ('1', 'นิ้ว');
INSERT INTO `eb_unit` VALUES ('2', 'ถุง');
INSERT INTO `eb_unit` VALUES ('3', 'เล่ม');
INSERT INTO `eb_unit` VALUES ('4', 'ขวด');
INSERT INTO `eb_unit` VALUES ('5', 'กระป๋อง');
INSERT INTO `eb_unit` VALUES ('6', 'กล่อง');
INSERT INTO `eb_unit` VALUES ('7', 'คาร์ตัน');
INSERT INTO `eb_unit` VALUES ('8', 'ถ้วย');
INSERT INTO `eb_unit` VALUES ('9', 'หีบ');
INSERT INTO `eb_unit` VALUES ('10', 'ถัง');
INSERT INTO `eb_unit` VALUES ('11', 'โหล');
INSERT INTO `eb_unit` VALUES ('12', 'ชิ้น');
INSERT INTO `eb_unit` VALUES ('13', 'แฟ้ม');
INSERT INTO `eb_unit` VALUES ('14', 'ออนซ์หน่วยวัดของเหลว US');
INSERT INTO `eb_unit` VALUES ('15', 'ฟุต');
INSERT INTO `eb_unit` VALUES ('16', 'ตารางฟุต');
INSERT INTO `eb_unit` VALUES ('17', 'กรัม');
INSERT INTO `eb_unit` VALUES ('18', 'ออนซ์');
INSERT INTO `eb_unit` VALUES ('19', 'คู่');
INSERT INTO `eb_unit` VALUES ('20', 'แพค/ห่อ');
INSERT INTO `eb_unit` VALUES ('21', 'งวด');
INSERT INTO `eb_unit` VALUES ('22', 'รีม');
INSERT INTO `eb_unit` VALUES ('23', 'Roll');
INSERT INTO `eb_unit` VALUES ('24', 'ผืน');
INSERT INTO `eb_unit` VALUES ('25', 'แผ่น');
INSERT INTO `eb_unit` VALUES ('26', 'ชุด');
INSERT INTO `eb_unit` VALUES ('27', 'ท่อน');
INSERT INTO `eb_unit` VALUES ('28', 'ตัน');
INSERT INTO `eb_unit` VALUES ('29', 'กิโลกรัม');
INSERT INTO `eb_unit` VALUES ('30', 'ลิตร');
INSERT INTO `eb_unit` VALUES ('31', 'เมตร');
INSERT INTO `eb_unit` VALUES ('32', 'โมลต่อลิตร');
INSERT INTO `eb_unit` VALUES ('33', 'ตารางเมตร');
INSERT INTO `eb_unit` VALUES ('34', 'เครื่อง');
INSERT INTO `eb_unit` VALUES ('35', 'มัด');
INSERT INTO `eb_unit` VALUES ('36', 'มิลลิกรัม');
INSERT INTO `eb_unit` VALUES ('37', 'มิลลิลิตร');
INSERT INTO `eb_unit` VALUES ('38', 'มิลลิเมตร');
INSERT INTO `eb_unit` VALUES ('39', 'ท่อ');
INSERT INTO `eb_unit` VALUES ('40', 'แท่ง');
INSERT INTO `eb_unit` VALUES ('41', 'ขด');
INSERT INTO `eb_unit` VALUES ('42', 'โคม');
INSERT INTO `eb_unit` VALUES ('43', 'คิว');
INSERT INTO `eb_unit` VALUES ('44', 'ปี๊บ');
INSERT INTO `eb_unit` VALUES ('45', 'ซอง');
INSERT INTO `eb_unit` VALUES ('46', 'ดวง');
INSERT INTO `eb_unit` VALUES ('47', 'ดอก');
INSERT INTO `eb_unit` VALUES ('48', 'แผง');
INSERT INTO `eb_unit` VALUES ('49', 'ตลับ');
INSERT INTO `eb_unit` VALUES ('50', 'เที่ยว');
INSERT INTO `eb_unit` VALUES ('51', 'ตัว');
INSERT INTO `eb_unit` VALUES ('52', 'นัด');
INSERT INTO `eb_unit` VALUES ('53', 'แท่น');
INSERT INTO `eb_unit` VALUES ('54', 'บาน');
INSERT INTO `eb_unit` VALUES ('55', 'ใบ');
INSERT INTO `eb_unit` VALUES ('56', 'ภาพ/รูป');
INSERT INTO `eb_unit` VALUES ('57', 'เรือน');
INSERT INTO `eb_unit` VALUES ('58', 'ล้อ');
INSERT INTO `eb_unit` VALUES ('59', 'ลัง');
INSERT INTO `eb_unit` VALUES ('60', 'วง');
INSERT INTO `eb_unit` VALUES ('61', 'เส้น');
INSERT INTO `eb_unit` VALUES ('62', 'ลูก');
INSERT INTO `eb_unit` VALUES ('63', 'หลอด');
INSERT INTO `eb_unit` VALUES ('64', 'หลัง');
INSERT INTO `eb_unit` VALUES ('65', 'เม็ด');
INSERT INTO `eb_unit` VALUES ('66', 'กรง');
INSERT INTO `eb_unit` VALUES ('67', 'กรอบ');
INSERT INTO `eb_unit` VALUES ('68', 'กระถาง');
INSERT INTO `eb_unit` VALUES ('69', 'กระบอก');
INSERT INTO `eb_unit` VALUES ('70', 'ก้อน');
INSERT INTO `eb_unit` VALUES ('71', 'หน่วย');
INSERT INTO `eb_unit` VALUES ('72', 'วัสดุที่คิดมูลค่าเท่านั้น');

-- ----------------------------
-- Table structure for eb_user
-- ----------------------------
DROP TABLE IF EXISTS `eb_user`;
CREATE TABLE `eb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `usertype` enum('ADMIN','USER') DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `key` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eb_user
-- ----------------------------
INSERT INTO `eb_user` VALUES ('4', 'tester001', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'วารุณี อิ่นแก้ว', 'USER', '2019-01-27 08:34:21', '23bc91a74e7ae3350066dcc0e9d80df9af64647a');
INSERT INTO `eb_user` VALUES ('8', 'adminn', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'แอดมิน วีวี', 'ADMIN', '2019-02-12 17:20:38', '7920c9c8729db6d945b01b1bee0937256f295742');
INSERT INTO `eb_user` VALUES ('9', 'pppppp', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'พิมอัปสร พิม', 'USER', '2019-02-09 20:27:39', '1b3289defea5c085c95042997e490983c1c34f2c');
INSERT INTO `eb_user` VALUES ('10', 'qqqqqq', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'สสส ววว', 'USER', '2019-01-28 04:47:42', '7f0cfc686d0e76c17715b6c9bb033447b5734948');
INSERT INTO `eb_user` VALUES ('11', 'testtest', 'a907eaddc97a1bad8d9e26c12104996c5a65be8a', 'test test', 'USER', '2019-02-09 13:57:03', '8b216b1f1d7af06fbadc7d65a656ba4ab1cbf262');
INSERT INTO `eb_user` VALUES ('12', 'aaaaaa', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'testtt', 'USER', '2019-02-02 17:06:24', '0afd4ec0f03b845e35c309746ca8d7fdb8423a00');
INSERT INTO `eb_user` VALUES ('15', 'eeeeee', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'อัจฉรา เงินฤทธิ์', '', null, null);
INSERT INTO `eb_user` VALUES ('16', 'wwwwww', '16b163a3d42abbe8aa8bb37875d328f351c8a2af', 'สสส ลล', 'USER', null, null);

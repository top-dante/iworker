/*
Navicat MariaDB Data Transfer

Source Server         : localhost
Source Server Version : 100312
Source Host           : localhost:3306
Source Database       : ritaoa

Target Server Type    : MariaDB
Target Server Version : 100312
File Encoding         : 65001

Date: 2021-01-03 18:07:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rita_project
-- ----------------------------
DROP TABLE IF EXISTS `rita_project`;
CREATE TABLE `rita_project` (
  `id` int(11) NOT NULL,
  `title` varchar(120) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `create_id` int(11) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `headline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

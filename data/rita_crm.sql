/*
Navicat MariaDB Data Transfer

Source Server         : localhost
Source Server Version : 100312
Source Host           : localhost:3306
Source Database       : rita_crm

Target Server Type    : MariaDB
Target Server Version : 100312
File Encoding         : 65001

Date: 2021-01-07 18:03:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rita_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `rita_admin_user`;
CREATE TABLE `rita_admin_user` (
  `openid` varchar(18) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `reg_ip` varchar(50) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `last_ip` varchar(50) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`openid`),
  KEY `username` (`username`,`email`,`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_admin_user
-- ----------------------------
INSERT INTO `rita_admin_user` VALUES ('0id5ff6788dcc745f1', 'admin1', '$2y$10$pySJeo0Wz5i5b4S0m8z/8Oh3FIQC.xwrc8Q0wkvijEA1JrRjH0szO', null, null, '62e0e0ode0dmqhe0e0kfod', '0.0.0.0', '1609988237', '0.0.0.0', '1609988237', '1');
INSERT INTO `rita_admin_user` VALUES ('50e5ff678173a4eas8', 'admin', '$2y$10$FZEKIpRK/fIat2CDRXYjSe75GLmvt2wKPjGGB.uenfgDxc9lTEmTW', null, null, '62e0e0ode0dmqhe0e0kfod', '0.0.0.0', '1609988119', '0.0.0.0', '1609988119', '1');

-- ----------------------------
-- Table structure for rita_customer
-- ----------------------------
DROP TABLE IF EXISTS `rita_customer`;
CREATE TABLE `rita_customer` (
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_customer
-- ----------------------------

-- ----------------------------
-- Table structure for rita_group
-- ----------------------------
DROP TABLE IF EXISTS `rita_group`;
CREATE TABLE `rita_group` (
  `group_id` varchar(18) NOT NULL,
  `user_id` varchar(18) DEFAULT '',
  `group_name` varchar(120) NOT NULL,
  `group_mobile` varchar(100) DEFAULT NULL,
  `group_address` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `default` int(2) DEFAULT 0,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id` (`group_id`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_group
-- ----------------------------

-- ----------------------------
-- Table structure for rita_group_department
-- ----------------------------
DROP TABLE IF EXISTS `rita_group_department`;
CREATE TABLE `rita_group_department` (
  `depart_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT 0,
  `group_id` varchar(18) NOT NULL,
  `user_id` varchar(18) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`depart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_group_department
-- ----------------------------

-- ----------------------------
-- Table structure for rita_group_map
-- ----------------------------
DROP TABLE IF EXISTS `rita_group_map`;
CREATE TABLE `rita_group_map` (
  `map_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_group_map
-- ----------------------------

-- ----------------------------
-- Table structure for rita_group_member
-- ----------------------------
DROP TABLE IF EXISTS `rita_group_member`;
CREATE TABLE `rita_group_member` (
  `user_id` varchar(18) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(24) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `reg_ip` varchar(50) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `last_ip` varchar(50) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`,`email`,`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_group_member
-- ----------------------------

-- ----------------------------
-- Table structure for rita_product
-- ----------------------------
DROP TABLE IF EXISTS `rita_product`;
CREATE TABLE `rita_product` (
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_product
-- ----------------------------

-- ----------------------------
-- Table structure for rita_project
-- ----------------------------
DROP TABLE IF EXISTS `rita_project`;
CREATE TABLE `rita_project` (
  `id` int(11) NOT NULL,
  `subject` varchar(120) DEFAULT NULL COMMENT '项目标题',
  `description` varchar(200) DEFAULT NULL COMMENT '项目描述',
  `bm_id` int(11) DEFAULT NULL COMMENT '业务员',
  `pm_id` int(11) DEFAULT NULL COMMENT '项目经理',
  `user_id` int(11) DEFAULT NULL COMMENT '创建人',
  `customer_id` int(11) DEFAULT NULL COMMENT '客户ID',
  `team` varchar(200) DEFAULT NULL COMMENT '参与团队',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `deadline` int(11) DEFAULT NULL COMMENT '截止时间',
  `status` int(11) DEFAULT NULL COMMENT '项目状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_project
-- ----------------------------

-- ----------------------------
-- Table structure for rita_project_lists
-- ----------------------------
DROP TABLE IF EXISTS `rita_project_lists`;
CREATE TABLE `rita_project_lists` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_project_lists
-- ----------------------------

-- ----------------------------
-- Table structure for rita_tasks
-- ----------------------------
DROP TABLE IF EXISTS `rita_tasks`;
CREATE TABLE `rita_tasks` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  ` attachment` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rita_tasks
-- ----------------------------

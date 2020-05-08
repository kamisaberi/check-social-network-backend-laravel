/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100128
 Source Host           : localhost:3306
 Source Schema         : check

 Target Server Type    : MySQL
 Target Server Version : 100128
 File Encoding         : 65001

 Date: 15/11/2018 13:20:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(10) UNSIGNED NOT NULL,
  `group` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES (1, 2, 8, NULL, NULL);
INSERT INTO `user_group` VALUES (2, 3, 8, NULL, NULL);
INSERT INTO `user_group` VALUES (3, 4, 8, NULL, NULL);
INSERT INTO `user_group` VALUES (4, 5, 8, NULL, NULL);
INSERT INTO `user_group` VALUES (5, 2, 9, NULL, NULL);
INSERT INTO `user_group` VALUES (6, 3, 9, NULL, NULL);
INSERT INTO `user_group` VALUES (7, 4, 9, NULL, NULL);
INSERT INTO `user_group` VALUES (8, 5, 9, NULL, NULL);
INSERT INTO `user_group` VALUES (9, 1, 9, NULL, NULL);
INSERT INTO `user_group` VALUES (10, 2, 10, NULL, NULL);
INSERT INTO `user_group` VALUES (11, 1, 10, NULL, NULL);
INSERT INTO `user_group` VALUES (12, 7, 11, NULL, NULL);
INSERT INTO `user_group` VALUES (13, 6, 11, NULL, NULL);
INSERT INTO `user_group` VALUES (14, 1, 11, NULL, NULL);
INSERT INTO `user_group` VALUES (15, 2, 12, NULL, NULL);
INSERT INTO `user_group` VALUES (16, 3, 12, NULL, NULL);
INSERT INTO `user_group` VALUES (17, 4, 12, NULL, NULL);
INSERT INTO `user_group` VALUES (18, 5, 12, NULL, NULL);
INSERT INTO `user_group` VALUES (19, 1, 12, NULL, NULL);
INSERT INTO `user_group` VALUES (20, 2, 13, NULL, NULL);
INSERT INTO `user_group` VALUES (21, 3, 13, NULL, NULL);
INSERT INTO `user_group` VALUES (22, 4, 13, NULL, NULL);
INSERT INTO `user_group` VALUES (23, 5, 13, NULL, NULL);
INSERT INTO `user_group` VALUES (24, 1, 13, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

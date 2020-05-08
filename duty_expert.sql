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

 Date: 14/01/2019 01:26:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for duty_expert
-- ----------------------------
DROP TABLE IF EXISTS `duty_expert`;
CREATE TABLE `duty_expert`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `duty` int(10) UNSIGNED NOT NULL,
  `expert` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of duty_expert
-- ----------------------------
INSERT INTO `duty_expert` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `duty_expert` VALUES (2, 1, 2, NULL, NULL);
INSERT INTO `duty_expert` VALUES (3, 1, 3, NULL, NULL);
INSERT INTO `duty_expert` VALUES (4, 2, 4, NULL, NULL);
INSERT INTO `duty_expert` VALUES (5, 3, 4, NULL, NULL);
INSERT INTO `duty_expert` VALUES (6, 4, 5, NULL, NULL);
INSERT INTO `duty_expert` VALUES (7, 4, 1, NULL, NULL);
INSERT INTO `duty_expert` VALUES (8, 4, 8, NULL, NULL);

-- ----------------------------
-- Table structure for experts
-- ----------------------------
DROP TABLE IF EXISTS `experts`;
CREATE TABLE `experts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of experts
-- ----------------------------
INSERT INTO `experts` VALUES (1, 'C#', NULL, NULL);
INSERT INTO `experts` VALUES (2, 'C++', NULL, NULL);
INSERT INTO `experts` VALUES (3, 'JAVA', NULL, NULL);
INSERT INTO `experts` VALUES (4, 'PHP', NULL, NULL);
INSERT INTO `experts` VALUES (5, 'Python', NULL, NULL);
INSERT INTO `experts` VALUES (6, 'Flutter', NULL, NULL);
INSERT INTO `experts` VALUES (7, 'React-Native', NULL, NULL);
INSERT INTO `experts` VALUES (8, 'React-Js', NULL, NULL);
INSERT INTO `experts` VALUES (9, 'Baby Sitting', NULL, NULL);
INSERT INTO `experts` VALUES (10, 'Nursing', NULL, NULL);
INSERT INTO `experts` VALUES (11, 'Back-end', NULL, NULL);
INSERT INTO `experts` VALUES (12, 'Full Stack', NULL, NULL);
INSERT INTO `experts` VALUES (13, 'Front-End', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

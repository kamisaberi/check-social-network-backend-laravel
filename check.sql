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

 Date: 24/11/2018 00:41:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for duties
-- ----------------------------
DROP TABLE IF EXISTS `duties`;
CREATE TABLE `duties`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `start_date` bigint(20) NOT NULL,
  `duration` bigint(20) NOT NULL,
  `group` int(255) UNSIGNED NULL DEFAULT 0,
  `creator` int(10) UNSIGNED NOT NULL,
  `priority` int(255) NULL DEFAULT NULL,
  `exact_time` int(11) NULL DEFAULT 0,
  `can_continue_after_timeout` tinyint(4) NULL DEFAULT 0,
  `finish_type` int(255) NULL DEFAULT 0,
  `finish_time` bigint(20) NULL DEFAULT 0,
  `parent` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of duties
-- ----------------------------
INSERT INTO `duties` VALUES (1, 'test adevertise app', NULL, 1542827185005, 47174400000, 0, 1, 1, 0, 0, 1, 1542990678010, 0, NULL, NULL);
INSERT INTO `duties` VALUES (2, 'write app basic codes', NULL, 1542826000000, 345600000, 0, 2, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (3, 'worldwide learn the fundamentals of modern busines', NULL, 1542827318572, 345600000, 0, 3, 3, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (4, 'write article about advertising', NULL, 1542827185005, 345600000, 2, 1, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (5, 'read book', NULL, 1542827318572, 345600000, 0, 2, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (6, 'not be reproduced, displayed, modified,', NULL, 1542827185005, 345600000, 0, 1, 1, 0, 0, 1, 1542995872931, 0, NULL, NULL);
INSERT INTO `duties` VALUES (7, 'deadline is extremely effective. If you set a goal to hav', NULL, 1542827318572, 345600000, 1, 1, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (8, 'Lion Air\'s flight data recorder retrieved', NULL, 1542826000000, 345600000, 0, 2, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (9, 'Bolton praises Brazil\'s far-right leader', NULL, 1542826000000, 345600000, 0, 1, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (10, 'Ryanair changes hand luggage rules again', NULL, 1542826000000, 345600000, 0, 1, 3, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (11, 'The hard right is going for Europe\'s jugular', NULL, 1542826000000, 345600000, 0, 3, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (12, 'WeWork to limit free beer all-day perk to four glasses', NULL, 1542826000000, 345600000, 2, 1, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (13, 'Where to find the world\'s best sake', NULL, 1542826000000, 345600000, 0, 4, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (14, 'Last of the samurai swordsmiths', NULL, 1542826000000, 47174400000, 0, 5, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (15, 'Parkinson\'s risk may be 20% lower if your appendix was removed.', NULL, 1542826000000, 345600000, 0, 6, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (16, 'Not all tasks are created equal', NULL, 1542827185005, 345600000, 0, 7, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (17, 'some are more important than others', NULL, 1542826000000, 345600000, 1, 1, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (18, 'You only have so much time and energy', NULL, 1542826000000, 47174400000, 3, 2, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (19, 'Riot police protect referee from players', NULL, 1542826000000, 345600000, 0, 3, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (20, 'most of your limited time and energy', NULL, 1542826000000, 345600000, 4, 1, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (21, 'make it easier to focus on achieving them first.', NULL, 1542826000000, 345600000, 1, 1, 3, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (22, 'When creating your list of MITs, it’s useful t', NULL, 1542827185005, 345600000, 0, 1, 4, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (23, 'Achieve your MITs as quickly as possible', NULL, 1542826000000, 47174400000, 0, 4, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (24, 'Questions About ', NULL, 1542826000000, 345600000, 0, 4, 3, 0, 0, 1, 1542995866808, 0, NULL, NULL);
INSERT INTO `duties` VALUES (25, 'You’ve got to think about the big things ', NULL, 1542826000000, 345600000, 0, 5, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (26, 'A world-class business education in a single volume', NULL, 1542826000000, 345600000, 0, 6, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (27, 'Learn the universal principles behind every successfu', NULL, 1542826000000, 345600000, 0, 7, 3, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (28, 'business, then use these ideas', NULL, 1542826000000, 345600000, 4, 8, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (29, 'and have more fun in your life and work', NULL, 1542826000000, 245600000, 0, 1, 2, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (30, 'Josh Kaufman is an acclaimed business', NULL, 1542826145214, 155700000, 2, 1, 3, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (36, 'fvc', 'vvvvvb', 1541922283802, 47174400000, 0, 1, 2, 0, 0, 0, 0, 3, '2018-11-11 07:45:38', '2018-11-11 07:45:38');
INSERT INTO `duties` VALUES (37, 'fucyxxy', 'vgxyd', 1542376500000, 345600000, 0, 1, 2, 0, 0, 0, 0, 0, '2018-11-12 13:56:32', '2018-11-12 13:56:32');
INSERT INTO `duties` VALUES (38, 'ffffffffff', 'fgdfdgf', 1542376500000, 345600000, 0, 1, 1, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `duties` VALUES (39, 'meeting iot', NULL, 1542920700000, 141900000, 22, 1, 1, 1, 0, 0, 0, 0, '2018-11-22 21:08:26', '2018-11-22 21:08:26');

-- ----------------------------
-- Table structure for friends
-- ----------------------------
DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a` int(10) UNSIGNED NOT NULL,
  `b` int(10) UNSIGNED NOT NULL,
  `friendship_type` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of friends
-- ----------------------------
INSERT INTO `friends` VALUES (2, 2, 3, 3, NULL, NULL);
INSERT INTO `friends` VALUES (3, 1, 3, 3, NULL, NULL);
INSERT INTO `friends` VALUES (4, 5, 6, 3, NULL, NULL);
INSERT INTO `friends` VALUES (5, 5, 8, 3, NULL, NULL);
INSERT INTO `friends` VALUES (7, 1, 8, 3, NULL, NULL);
INSERT INTO `friends` VALUES (9, 6, 8, 3, NULL, NULL);
INSERT INTO `friends` VALUES (10, 8, 9, 3, NULL, NULL);
INSERT INTO `friends` VALUES (11, 8, 10, 3, NULL, NULL);
INSERT INTO `friends` VALUES (12, 9, 10, 3, NULL, NULL);
INSERT INTO `friends` VALUES (13, 2, 6, 3, NULL, NULL);
INSERT INTO `friends` VALUES (14, 2, 7, 3, NULL, NULL);
INSERT INTO `friends` VALUES (15, 7, 4, 3, NULL, NULL);
INSERT INTO `friends` VALUES (16, 7, 6, 3, NULL, NULL);
INSERT INTO `friends` VALUES (18, 6, 1, 3, NULL, NULL);
INSERT INTO `friends` VALUES (26, 1, 2, 3, NULL, NULL);
INSERT INTO `friends` VALUES (27, 1, 7, 1, NULL, NULL);

-- ----------------------------
-- Table structure for friendship_types
-- ----------------------------
DROP TABLE IF EXISTS `friendship_types`;
CREATE TABLE `friendship_types`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of friendship_types
-- ----------------------------
INSERT INTO `friendship_types` VALUES (1, 'requested', NULL, NULL);
INSERT INTO `friendship_types` VALUES (2, 'rejected', NULL, NULL);
INSERT INTO `friendship_types` VALUES (3, 'accepted', NULL, NULL);

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `creator` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (0, 'no_group', NULL, 0, NULL, NULL);
INSERT INTO `groups` VALUES (1, 'narij', NULL, 1, NULL, NULL);
INSERT INTO `groups` VALUES (2, 'arnahit', NULL, 1, NULL, NULL);
INSERT INTO `groups` VALUES (3, 'pars veda', NULL, 2, NULL, NULL);
INSERT INTO `groups` VALUES (4, 'mft education', NULL, 3, NULL, NULL);
INSERT INTO `groups` VALUES (6, 'yest', NULL, 1, '2018-11-11 12:38:40', '2018-11-11 12:38:40');
INSERT INTO `groups` VALUES (7, 'testc', NULL, 1, '2018-11-11 13:47:50', '2018-11-11 13:47:50');
INSERT INTO `groups` VALUES (8, 'lots of tests', NULL, 1, '2018-11-13 14:17:13', '2018-11-13 14:17:13');
INSERT INTO `groups` VALUES (9, 'lots of tests', NULL, 1, '2018-11-13 14:18:12', '2018-11-13 14:18:12');
INSERT INTO `groups` VALUES (10, 'check programm', 'test', 1, '2018-11-13 17:00:52', '2018-11-13 17:00:52');
INSERT INTO `groups` VALUES (11, 'fggg', 'gggg', 1, '2018-11-13 17:02:44', '2018-11-13 17:02:44');
INSERT INTO `groups` VALUES (12, 'lots of tests', NULL, 1, '2018-11-13 21:45:32', '2018-11-13 21:45:32');
INSERT INTO `groups` VALUES (13, 'lots of tests', NULL, 1, '2018-11-13 21:45:50', '2018-11-13 21:45:50');
INSERT INTO `groups` VALUES (22, 'iot', NULL, 1, '2018-11-22 21:07:33', '2018-11-22 21:07:33');

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `duty` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `date` bigint(20) NOT NULL,
  `log` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES (11, 6, 1, 0, 'tty', '2018-11-02 02:19:20', '2018-11-02 02:19:20');
INSERT INTO `logs` VALUES (12, 6, 1, 0, 'fghhhh', '2018-11-02 02:27:35', '2018-11-02 02:27:35');
INSERT INTO `logs` VALUES (13, 6, 1, 0, 'ffggh', '2018-11-02 04:04:03', '2018-11-02 04:04:03');
INSERT INTO `logs` VALUES (14, 6, 1, 1541556556991, 'ffhhffhf', '2018-11-07 02:09:15', '2018-11-07 02:09:15');
INSERT INTO `logs` VALUES (15, 6, 1, 1541556560912, 'ffhhffhf', '2018-11-07 02:09:19', '2018-11-07 02:09:19');
INSERT INTO `logs` VALUES (16, 6, 1, 1541556639946, 'this is a test log', '2018-11-07 02:10:38', '2018-11-07 02:10:38');
INSERT INTO `logs` VALUES (17, 21, 1, 1541556671120, 'hdhddhd', '2018-11-07 02:11:09', '2018-11-07 02:11:09');
INSERT INTO `logs` VALUES (18, 35, 1, 1541556877170, 'teststs', '2018-11-07 02:14:35', '2018-11-07 02:14:35');
INSERT INTO `logs` VALUES (19, 1, 1, 1542639313392, 'hdhdhhd', '2018-11-19 14:55:14', '2018-11-19 14:55:14');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` bigint(20) NOT NULL,
  `duty` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES (1, 1, 'test 1', 1542539516000, 1, NULL, NULL);
INSERT INTO `messages` VALUES (2, 2, 'test 2', 1542539816000, 1, NULL, NULL);
INSERT INTO `messages` VALUES (3, 3, 'test 3', 1542589516125, 1, NULL, NULL);
INSERT INTO `messages` VALUES (4, 1, 'test 4', 1542589717001, 1, NULL, NULL);
INSERT INTO `messages` VALUES (5, 1, 'test 5', 1542539947923, 2, NULL, NULL);
INSERT INTO `messages` VALUES (6, 2, 'test 6', 1542540005512, 3, NULL, NULL);
INSERT INTO `messages` VALUES (7, 4, 'test7', 1542540015959, 1, NULL, NULL);
INSERT INTO `messages` VALUES (8, 2, 'test 8', 1542540026135, 2, NULL, NULL);
INSERT INTO `messages` VALUES (9, 1, 'test 9', 1542540036112, 1, NULL, NULL);
INSERT INTO `messages` VALUES (10, 1, 'test 10', 1542540047438, 1, NULL, NULL);
INSERT INTO `messages` VALUES (11, 1, 'test 11', 1542540055504, 2, NULL, NULL);
INSERT INTO `messages` VALUES (12, 1, 'test 12', 1542540065333, 3, NULL, NULL);
INSERT INTO `messages` VALUES (13, 1, 'tettttte', 1542543386835, 1, '2018-11-18 12:16:26', '2018-11-18 12:16:26');
INSERT INTO `messages` VALUES (14, 1, 'dhxhhfuchhfj', 1542543403883, 1, '2018-11-18 12:16:43', '2018-11-18 12:16:43');
INSERT INTO `messages` VALUES (15, 1, 'dhdhhhch', 1542543474351, 1, '2018-11-18 12:17:54', '2018-11-18 12:17:54');
INSERT INTO `messages` VALUES (16, 1, 'hddhdh', 1542543478389, 1, '2018-11-18 12:17:58', '2018-11-18 12:17:58');
INSERT INTO `messages` VALUES (17, 1, 'ddddddddd', 1542543482166, 1, '2018-11-18 12:18:02', '2018-11-18 12:18:02');
INSERT INTO `messages` VALUES (18, 1, 'eeeeee', 1542543485103, 1, '2018-11-18 12:18:05', '2018-11-18 12:18:05');
INSERT INTO `messages` VALUES (19, 1, 'wwwwwwww', 1542543488011, 1, '2018-11-18 12:18:08', '2018-11-18 12:18:08');
INSERT INTO `messages` VALUES (20, 1, 'shfhcjjfv', 1542546958480, 1, '2018-11-18 13:15:58', '2018-11-18 13:15:58');
INSERT INTO `messages` VALUES (21, 1, 'ffffffff', 1542546962097, 1, '2018-11-18 13:16:02', '2018-11-18 13:16:02');
INSERT INTO `messages` VALUES (22, 1, 'ffgggggg', 1542546965071, 1, '2018-11-18 13:16:05', '2018-11-18 13:16:05');
INSERT INTO `messages` VALUES (23, 1, 'تبتتبتب', 1542546972490, 1, '2018-11-18 13:16:12', '2018-11-18 13:16:12');
INSERT INTO `messages` VALUES (24, 1, 'الکترونیکی', 1542546978584, 1, '2018-11-18 13:16:18', '2018-11-18 13:16:18');
INSERT INTO `messages` VALUES (25, 1, 'allow', 1542546986643, 1, '2018-11-18 13:16:26', '2018-11-18 13:16:26');
INSERT INTO `messages` VALUES (26, 1, 'لبایتتقب\nبلدلببلل', 1542547241024, 1, '2018-11-18 13:20:41', '2018-11-18 13:20:41');
INSERT INTO `messages` VALUES (27, 1, 'للوللوالل\nد\nل\nل\nل\nل\nلا', 1542547247606, 1, '2018-11-18 13:20:47', '2018-11-18 13:20:47');
INSERT INTO `messages` VALUES (28, 1, 'رراا', 1542573349856, 1, '2018-11-18 20:35:50', '2018-11-18 20:35:50');
INSERT INTO `messages` VALUES (29, 3, 'ffffff', 1542573488027, 1, NULL, NULL);
INSERT INTO `messages` VALUES (30, 2, 'gggggg', 1542573506825, 1, NULL, NULL);
INSERT INTO `messages` VALUES (31, 1, 'test\n\nffffffgvgg\n\ng\ng\ng\ng', 1542655127085, 1, '2018-11-19 19:18:47', '2018-11-19 19:18:47');
INSERT INTO `messages` VALUES (32, 1, 'test\n\nffffffgvgg\n\ng\ng\ng\ng', 1542655130624, 1, '2018-11-19 19:18:51', '2018-11-19 19:18:51');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_10_30_022338_create_duties_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_10_30_023908_create_friends_table', 1);
INSERT INTO `migrations` VALUES (5, '2018_10_30_031322_create_user_duty_table', 1);
INSERT INTO `migrations` VALUES (6, '2018_10_30_031342_create_logs_table', 1);
INSERT INTO `migrations` VALUES (7, '2018_11_03_033252_create_priority_table', 2);
INSERT INTO `migrations` VALUES (8, '2018_11_03_033252_create_priorities_table', 3);
INSERT INTO `migrations` VALUES (9, '2018_11_04_034000_create_groups_table', 3);
INSERT INTO `migrations` VALUES (10, '2018_11_08_003043_create_friendship_types_table', 4);
INSERT INTO `migrations` VALUES (11, '2018_11_13_140252_create_user_group', 5);
INSERT INTO `migrations` VALUES (12, '2018_11_17_055152_create_messages_table', 6);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for priorities
-- ----------------------------
DROP TABLE IF EXISTS `priorities`;
CREATE TABLE `priorities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of priorities
-- ----------------------------
INSERT INTO `priorities` VALUES (1, 'Urgent', NULL, NULL);
INSERT INTO `priorities` VALUES (2, 'High', NULL, NULL);
INSERT INTO `priorities` VALUES (3, 'Normal', NULL, NULL);
INSERT INTO `priorities` VALUES (4, 'Low', NULL, NULL);

-- ----------------------------
-- Table structure for user_duty
-- ----------------------------
DROP TABLE IF EXISTS `user_duty`;
CREATE TABLE `user_duty`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` int(10) UNSIGNED NOT NULL,
  `duty` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_duty
-- ----------------------------
INSERT INTO `user_duty` VALUES (1, 2, 1, NULL, NULL);
INSERT INTO `user_duty` VALUES (2, 3, 2, NULL, NULL);
INSERT INTO `user_duty` VALUES (3, 1, 3, NULL, NULL);
INSERT INTO `user_duty` VALUES (4, 2, 4, NULL, NULL);
INSERT INTO `user_duty` VALUES (5, 3, 5, NULL, NULL);
INSERT INTO `user_duty` VALUES (6, 4, 6, NULL, NULL);
INSERT INTO `user_duty` VALUES (7, 5, 7, NULL, NULL);
INSERT INTO `user_duty` VALUES (8, 8, 8, NULL, NULL);
INSERT INTO `user_duty` VALUES (9, 7, 9, NULL, NULL);
INSERT INTO `user_duty` VALUES (10, 6, 10, NULL, NULL);
INSERT INTO `user_duty` VALUES (11, 2, 11, NULL, NULL);
INSERT INTO `user_duty` VALUES (12, 4, 12, NULL, NULL);
INSERT INTO `user_duty` VALUES (13, 4, 13, NULL, NULL);
INSERT INTO `user_duty` VALUES (14, 5, 14, NULL, NULL);
INSERT INTO `user_duty` VALUES (15, 6, 15, NULL, NULL);
INSERT INTO `user_duty` VALUES (16, 2, 16, NULL, NULL);
INSERT INTO `user_duty` VALUES (17, 2, 17, NULL, NULL);
INSERT INTO `user_duty` VALUES (18, 1, 18, NULL, NULL);
INSERT INTO `user_duty` VALUES (19, 7, 19, NULL, NULL);
INSERT INTO `user_duty` VALUES (20, 8, 20, NULL, NULL);
INSERT INTO `user_duty` VALUES (21, 3, 21, NULL, NULL);
INSERT INTO `user_duty` VALUES (22, 3, 22, NULL, NULL);
INSERT INTO `user_duty` VALUES (23, 2, 23, NULL, NULL);
INSERT INTO `user_duty` VALUES (24, 1, 24, NULL, NULL);
INSERT INTO `user_duty` VALUES (25, 2, 25, NULL, NULL);
INSERT INTO `user_duty` VALUES (26, 3, 26, NULL, NULL);
INSERT INTO `user_duty` VALUES (27, 4, 27, NULL, NULL);
INSERT INTO `user_duty` VALUES (28, 5, 28, NULL, NULL);
INSERT INTO `user_duty` VALUES (29, 6, 29, NULL, NULL);
INSERT INTO `user_duty` VALUES (30, 7, 30, NULL, NULL);
INSERT INTO `user_duty` VALUES (42, 8, 36, NULL, NULL);
INSERT INTO `user_duty` VALUES (43, 3, 36, NULL, NULL);
INSERT INTO `user_duty` VALUES (44, 3, 37, NULL, NULL);
INSERT INTO `user_duty` VALUES (45, 2, 38, NULL, NULL);
INSERT INTO `user_duty` VALUES (46, 1, 39, NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
INSERT INTO `user_group` VALUES (29, 1, 22, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fcm_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `avatar` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verification_code` int(10) NULL DEFAULT NULL,
  `activated` bit(1) NULL DEFAULT b'0',
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  UNIQUE INDEX `users_phone_unique`(`phone`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'kami Saberi', 'kami@yahoo.com', 'kami111', '+989365982333', '1234', 'fZd3ZSlEpCs:APA91bHLHKa6SocLRlTMYrMDXnBSDmG4KG_M5SagnMMrjpjDh5SRPltWLmDXbc5ZzNF3XLtNjeLU_6wgSwIllOsdcS26VfBDeFhcjLlVQZnov6ax9EfUL1Dnd060y71V3Ltp9760X8kc', '1542651719913.jpg', 54125, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'reza', 'reza@yahoo.com', 'reza', '+989112547896', '1234', NULL, '', NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'a', 'a', 'a', '+989304982233', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'b', 'b', 'b', '+981245692322', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'c', 'c', 'c', '+961442525252', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'd', 'd', 'd', '+145236521411', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (7, 'e', 'e', 'e', '+145236521412', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (8, 'f', 'f', 'f', '333333', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (9, 'g', 'g', 'g', '444444', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (10, 'h', 'h', 'h', '555555', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);
INSERT INTO `users` VALUES (32, 'siamak', 'khanjani', 'sia2018', '+989113334886', '1234', NULL, NULL, NULL, b'1', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

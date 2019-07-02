/*
 Navicat Premium Data Transfer

 Source Server         : baza
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : bioskop

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 30/06/2019 13:35:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator`  (
  `administrator_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`administrator_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of administrator
-- ----------------------------
INSERT INTO `administrator` VALUES (1, 'admin', '$2y$10$VnlC7jrSzEZvvC6PETvFSOJ.KTUMoeGNgPyfbNSN1C2O8eYHreu2y');

-- ----------------------------
-- Table structure for film
-- ----------------------------
DROP TABLE IF EXISTS `film`;
CREATE TABLE `film`  (
  `film_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kategorija` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reziser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `trajanje` int(11) NOT NULL,
  `administrator_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`film_id`) USING BTREE,
  INDEX `fk_film_administrator_id`(`administrator_id`) USING BTREE,
  CONSTRAINT `fk_film_administrator_id` FOREIGN KEY (`administrator_id`) REFERENCES `administrator` (`administrator_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of film
-- ----------------------------
INSERT INTO `film` VALUES (3, 'Paddington', 'Ekranizaciju kultne engleske serije slikovnica za decu predškolskog uzrasta, čiji je glavni lik meda koji više od pet decenija oduševljava decu širom sveta. Simpatični Pedington je već godinama klasični lik dečje književnosti. Ovaj peruanski medvedić svoje londonske avanture započinje kada se nađe sam i izgubljen na stanici Pedington. Aii, sreća će mu se osmehnuti kada ga pronađe porodicy Braun.', 'Avantura, Animirani', 'Paul King', 95, 1, '4690');
INSERT INTO `film` VALUES (4, 'Paddington', 'Ekranizaciju kultne engleske serije slikovnica za decu predškolskog uzrasta, čiji je glavni lik meda koji više od pet decenija oduševljava decu širom sveta. Simpatični Pedington je već godinama klasični lik dečje književnosti. Ovaj peruanski medvedić svoje londonske avanture započinje kada se nađe sam i izgubljen na stanici Pedington. Aii, sreća će mu se osmehnuti kada ga pronađe porodicy Braun.', 'Avantura, Animirani', 'Paul King', 95, 1, '9526');
INSERT INTO `film` VALUES (5, 'Paddington', 'Ekranizaciju kultne engleske serije slikovnica za decu predškolskog uzrasta, čiji je glavni lik meda koji više od pet decenija oduševljava decu širom sveta. Simpatični Pedington je već godinama klasični lik dečje književnosti. Ovaj peruanski medvedić svoje londonske avanture započinje kada se nađe sam i izgubljen na stanici Pedington. Aii, sreća će mu se osmehnuti kada ga pronađe porodicy Braun.', 'Avantura, Animirani', 'Paul King', 95, 1, '6735');
INSERT INTO `film` VALUES (6, 'Paddington', 'Ekranizaciju kultne engleske serije slikovnica za decu predškolskog uzrasta, čiji je glavni lik meda koji više od pet decenija oduševljava decu širom sveta. Simpatični Pedington je već godinama klasični lik dečje književnosti. Ovaj peruanski medvedić svoje londonske avanture započinje kada se nađe sam i izgubljen na stanici Pedington. Aii, sreća će mu se osmehnuti kada ga pronađe porodicy Braun.', 'Avantura, Animirani', 'Paul King', 95, 1, '1190');
INSERT INTO `film` VALUES (7, 'dada', 'dada', 'dada', 'dada', 556, 1, '6096');
INSERT INTO `film` VALUES (8, 'asxc', 'czcz', 'czcz', 'czcz', 50, 1, '6032');
INSERT INTO `film` VALUES (9, 'sda', 'dasa', 'sasa', 'sasa', 20, 1, '2114');
INSERT INTO `film` VALUES (10, 'test', 'test test', 'avantura', 'test', 60, 1, '9619');
INSERT INTO `film` VALUES (11, '123', 'asd', 'avantura', 'SD', 123, 1, '3708');
INSERT INTO `film` VALUES (12, 'adsf', 'dasf', 'avantura', 'sdfa', 20, 1, '6001');
INSERT INTO `film` VALUES (13, 'sdf', 'sdfa', 'dsfa', 'asdfa', 0, 1, '6516');
INSERT INTO `film` VALUES (14, 'sdf', 'sdfa', 'dsfa', 'asdfa', 0, 1, '1141');

-- ----------------------------
-- Table structure for mesto
-- ----------------------------
DROP TABLE IF EXISTS `mesto`;
CREATE TABLE `mesto`  (
  `mesto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sala_id` int(10) UNSIGNED NOT NULL,
  `red` int(10) NOT NULL,
  `broj_sedista` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`mesto_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for projekcija
-- ----------------------------
DROP TABLE IF EXISTS `projekcija`;
CREATE TABLE `projekcija`  (
  `projekcija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `termin_at` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  `film_id` int(10) UNSIGNED NOT NULL,
  `sala_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`projekcija_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of projekcija
-- ----------------------------
INSERT INTO `projekcija` VALUES (4, '2019-08-03 06:06:00', 3, 0, 0);
INSERT INTO `projekcija` VALUES (5, '2019-06-15 10:00:00', 10, 0, 1);
INSERT INTO `projekcija` VALUES (6, '2019-06-16 12:12:00', 9, 0, 1);

-- ----------------------------
-- Table structure for rezervacija
-- ----------------------------
DROP TABLE IF EXISTS `rezervacija`;
CREATE TABLE `rezervacija`  (
  `rezervacija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime_korisnika` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime_korisnika` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `broj_telefona` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`rezervacija_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for rezervacija_mesta
-- ----------------------------
DROP TABLE IF EXISTS `rezervacija_mesta`;
CREATE TABLE `rezervacija_mesta`  (
  `rezervacija_mesta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesto_id` int(10) UNSIGNED NOT NULL,
  `rezervacija_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`rezervacija_mesta_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sala
-- ----------------------------
DROP TABLE IF EXISTS `sala`;
CREATE TABLE `sala`  (
  `sala_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sala_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sala
-- ----------------------------
INSERT INTO `sala` VALUES (1, '2D mala');
INSERT INTO `sala` VALUES (2, '2D velika');
INSERT INTO `sala` VALUES (3, '3D mala');
INSERT INTO `sala` VALUES (4, '3D velika');

SET FOREIGN_KEY_CHECKS = 1;

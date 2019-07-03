/*
 Navicat Premium Data Transfer

 Source Server         : bioskop
 Source Server Type    : MySQL
 Source Server Version : 100133
 Source Host           : localhost:3306
 Source Schema         : bioskop

 Target Server Type    : MySQL
 Target Server Version : 100133
 File Encoding         : 65001

 Date: 02/07/2019 23:05:13
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
  `trajanje` int(10) NOT NULL,
  `administrator_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`film_id`) USING BTREE,
  INDEX `fk_film_administrator_id`(`administrator_id`) USING BTREE,
  CONSTRAINT `fk_film_administrator_id` FOREIGN KEY (`administrator_id`) REFERENCES `administrator` (`administrator_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of film
-- ----------------------------
INSERT INTO `film` VALUES (16, 'Mrtav ladan', 'Mrtav ’ladan je domaća filmska komedija iz 2002. godine, scenariste i režisera Milorada Milinkovića. Glavne uloge tumače Nenad Jezdić, Srđan Todorović, Mihajlo Bata Paskaljević i Nikola Đuričko.', 'Komedija', 'Milorad Milinković', 90, 1, '2821');
INSERT INTO `film` VALUES (17, 'Aladdin', 'ALADIN je uzbudljiva priča o šarmantnom mladiću Aladinu, koji većinu života provodi na ulici, hrabroj i odlučnoj princezi Jasmin i Duhu iz lampe koji može da bude glavni u određivanju njihove sudbine. ', 'Avantura, fantazija, porodični', 'Guy Ritchie', 128, 1, '3722');
INSERT INTO `film` VALUES (18, 'Anna', 'Ispod zapanjujuće lepote top modela, Anne Poliatove, skriva se njena neverovatna snaga i veštine koje je čine jednom od najstrašnijih ubica vlade. Uzbudljiva, energična vožnja s neočekivanim preokretima i akcijom koja oduzima dah, uvodi nas u radnju ove priče. U glavnim ulogama su Saša Lus, dobitnica nagrade Oskar Helen Mirren, Kilijen Merfi i Luk Evans.', 'Akcija, triler', 'Luc Besson', 119, 1, '8890');
INSERT INTO `film` VALUES (19, 'Tajne avanture kucnih ljubimaca ', 'Kao peti zajednički dugometražni animirani film, Illumination Entertainment i Universal Pictures predstavljaju „Tajne avanture kućnih ljubimaca“, komediju o životima naših kućnih ljubimaca koje vode kad mi odemo na posao ili u školu svakog dana.', 'Crtani', 'Yarrow Cheney, Chris Renaud', 100, 1, '4277');

-- ----------------------------
-- Table structure for mesto
-- ----------------------------
DROP TABLE IF EXISTS `mesto`;
CREATE TABLE `mesto`  (
  `mesto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sala_id` int(10) UNSIGNED NOT NULL,
  `red` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `broj_sedista` int(3) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `projekcija_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`mesto_id`) USING BTREE,
  INDEX `fk_mesto_sala_id`(`sala_id`) USING BTREE,
  INDEX `fk_mesto_projekcija_id`(`projekcija_id`) USING BTREE,
  CONSTRAINT `fk_mesto_projekcija_id` FOREIGN KEY (`projekcija_id`) REFERENCES `projekcija` (`projekcija_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_mesto_sala_id` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`sala_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mesto
-- ----------------------------
INSERT INTO `mesto` VALUES (3, 1, 'b', 5, 0, 6);
INSERT INTO `mesto` VALUES (4, 1, 'b', 6, 0, 6);

-- ----------------------------
-- Table structure for projekcija
-- ----------------------------
DROP TABLE IF EXISTS `projekcija`;
CREATE TABLE `projekcija`  (
  `projekcija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `termin_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `film_id` int(10) UNSIGNED NOT NULL,
  `sala_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`projekcija_id`) USING BTREE,
  INDEX `fk_projekcija_sala_id`(`sala_id`) USING BTREE,
  INDEX `fk_projekcija_film_id`(`film_id`) USING BTREE,
  CONSTRAINT `fk_projekcija_film_id` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_projekcija_sala_id` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`sala_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of projekcija
-- ----------------------------
INSERT INTO `projekcija` VALUES (5, '2019-07-31 05:05:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (6, '2019-07-13 01:02:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (7, '2019-07-02 21:57:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (8, '2019-07-02 21:56:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (9, '2019-07-02 20:05:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (10, '2019-07-13 01:02:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (11, '2019-07-05 21:01:00', 16, 1, 1);
INSERT INTO `projekcija` VALUES (12, '2019-07-02 22:01:00', 16, 1, 1);

-- ----------------------------
-- Table structure for rezervacija
-- ----------------------------
DROP TABLE IF EXISTS `rezervacija`;
CREATE TABLE `rezervacija`  (
  `rezervacija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime_korisnika` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime_korisnika` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `broj_telefona` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `projekcija_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`rezervacija_id`) USING BTREE,
  INDEX `fk_rezervacija_projekcija_id`(`projekcija_id`) USING BTREE,
  CONSTRAINT `fk_rezervacija_projekcija_id` FOREIGN KEY (`projekcija_id`) REFERENCES `projekcija` (`projekcija_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of rezervacija
-- ----------------------------
INSERT INTO `rezervacija` VALUES (7, 'asdasd', 'asdasd', '+123123', '2019-07-02 22:33:16', 6);

-- ----------------------------
-- Table structure for rezervacija_mesta
-- ----------------------------
DROP TABLE IF EXISTS `rezervacija_mesta`;
CREATE TABLE `rezervacija_mesta`  (
  `rezervacija_mesta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesto_id` int(10) UNSIGNED NOT NULL,
  `rezervacija_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`rezervacija_mesta_id`) USING BTREE,
  INDEX `fk_rezervacija_mesta_mesto_id`(`mesto_id`) USING BTREE,
  INDEX `fk_rezervacija_mesta_rezervacija_id`(`rezervacija_id`) USING BTREE,
  CONSTRAINT `fk_rezervacija_mesta_mesto_id` FOREIGN KEY (`mesto_id`) REFERENCES `mesto` (`mesto_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_rezervacija_mesta_rezervacija_id` FOREIGN KEY (`rezervacija_id`) REFERENCES `rezervacija` (`rezervacija_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of rezervacija_mesta
-- ----------------------------
INSERT INTO `rezervacija_mesta` VALUES (3, 3, 7);
INSERT INTO `rezervacija_mesta` VALUES (4, 4, 7);

-- ----------------------------
-- Table structure for sala
-- ----------------------------
DROP TABLE IF EXISTS `sala`;
CREATE TABLE `sala`  (
  `sala_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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

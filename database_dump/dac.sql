-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dac
DROP DATABASE IF EXISTS `dac`;
CREATE DATABASE IF NOT EXISTS `dac` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dac`;

-- Dumping structure for table dac.address
DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `addrs` varchar(191) NOT NULL,
  `pincode` varchar(191) NOT NULL,
  `state` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id_fk`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dac.address: ~3 rows (approximately)
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
REPLACE INTO `address` (`id`, `name`, `phone`, `addrs`, `pincode`, `state`, `country`, `user_id_fk`) VALUES
	(20, 'Meh ', '9662804073', 'ss', '360015', 'gg', 'gg', 1),
	(21, 'Abhay', '9662804073', 'ss', '360015', '22', '22', 6),
	(22, 'Meh ', '9662804073', 'ss', '360015', '22', '22', 6);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;

-- Dumping structure for table dac.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `saltvalue` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dac.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`first_name`, `last_name`, `pincode`, `email`, `id`, `password`, `saltvalue`, `verified`) VALUES
	('Abhay', 'Ruparel', '380015', 'abhay@gmail.com', 8, '9f8191dc3b3f7b107a03bb96669157beca73b76f86387d0c733720bdb19debbd', 'e734b97e41a4c55b87324134dd76e5e1', 0),
	('Raj', 'patel', '360015', 'patel@gmail.com', 9, 'f73986dc873712f5ae960d2692b7c2969d03d0e5a8e6933175e1d1379ca16506', 'c9a4819903c6cb52fdab6e0ba83add30', 0);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table dac.manager
DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pincode` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `saltvalue` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dac.manager: ~1 rows (approximately)
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
REPLACE INTO `manager` (`first_name`, `last_name`, `address`, `id`, `pincode`, `email`, `password`, `verified`, `saltvalue`) VALUES
	('Ramesh', 'Patel', '', 1, 0, 'abhay@gmail.com', '8c48369056e7a63f16ce5ccc8c61c0259ed6d5153412b8d7a602b92951bb873a', 0, '973fb80bc6622f4025147f4753f83831');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;

-- Dumping structure for table dac.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pincode` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saltvalue` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `manager_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_manager_fk` (`manager_id_fk`),
  CONSTRAINT `user_manager_fk` FOREIGN KEY (`manager_id_fk`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dac.user: ~6 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`first_name`, `last_name`, `pincode`, `email`, `password`, `id`, `saltvalue`, `verified`, `manager_id_fk`) VALUES
	('mesh', 'ss', 0, 'ss@gmail.com', '138d8867c1bc5cfbfaa11258f434517f18c52324e0ca7b95fc65b15f334d708a', 1, '8a187734ff80070155556f04e264a64f', 0, NULL),
	('Raj', 'Patel', 0, 'raj@gmail.com', '407b4bd88d8b1cfad5678687be62ed9e9eae20c0dc2b803848d5d983c3c874e0', 2, '93d6dfee8a57d11142069ba74d3ae927', 0, NULL),
	('Ramesh', 'ss', 0, 'ramesh@gmail.com', '3e488e81a390d73a3cc3a56f159e84a06ffe97cbf0364b37e619fc5129221515', 3, '502e44f99b3b9f608c3ea9e937ac9d0a', 0, NULL),
	('a', 'a', 0, 'a@gmail.com', '7d39279ec2eb20c079453524b9f969104ea30bf7f90a4cbf2b84ee88ecd9bc3f', 4, 'ab3c60c1773f575fb7b14556330feefc', 0, 1),
	('Abhay', 'Ruparel', 0, 'abhay@gmail.com', '9cf81ef3f38c537e9940cd770d2513ac9025eb35d027f44ed4372b175032fd80', 5, '47f46dac131a8d7ae24982d2b9e468be', 0, 1),
	('yash', 'patel', NULL, 'patel@gmail.com', '44c6def705a16bb2ee872323087f414072abf50393ea044d9724b9c5a00abf11', 6, '4dedca8df5550449955bdc826d406f21', 0, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

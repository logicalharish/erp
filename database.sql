-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for erp
DROP DATABASE IF EXISTS `erp`;
CREATE DATABASE IF NOT EXISTS `erp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `erp`;


-- Dumping structure for table erp.area_master
DROP TABLE IF EXISTS `area_master`;
CREATE TABLE IF NOT EXISTS `area_master` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `area_name` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.area_master: ~0 rows (approximately)
DELETE FROM `area_master`;
/*!40000 ALTER TABLE `area_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `area_master` ENABLE KEYS */;


-- Dumping structure for table erp.branch_master
DROP TABLE IF EXISTS `branch_master`;
CREATE TABLE IF NOT EXISTS `branch_master` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.branch_master: ~0 rows (approximately)
DELETE FROM `branch_master`;
/*!40000 ALTER TABLE `branch_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch_master` ENABLE KEYS */;


-- Dumping structure for table erp.city_master
DROP TABLE IF EXISTS `city_master`;
CREATE TABLE IF NOT EXISTS `city_master` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(100) DEFAULT NULL,
  `state_id` int(100) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.city_master: ~0 rows (approximately)
DELETE FROM `city_master`;
/*!40000 ALTER TABLE `city_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `city_master` ENABLE KEYS */;


-- Dumping structure for table erp.country_master
DROP TABLE IF EXISTS `country_master`;
CREATE TABLE IF NOT EXISTS `country_master` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table erp.country_master: ~13 rows (approximately)
DELETE FROM `country_master`;
/*!40000 ALTER TABLE `country_master` DISABLE KEYS */;
INSERT INTO `country_master` (`country_id`, `country_name`, `status`, `created_datetime`, `created_by`, `modified_datetime`, `modified_by`) VALUES
	(1, 'India', 'Inactive', '2014-05-29 10:25:28', 1, '2014-05-29 10:25:31', 1),
	(2, 'asd', NULL, '0000-00-00 00:00:00', NULL, NULL, NULL),
	(3, 'asd', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(4, 'asd', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(5, 'asd', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(6, 'dasdas', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(7, 'dasddads', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(8, 'dasddads', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(9, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(10, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(11, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(12, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(13, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL),
	(14, 'Active', NULL, '0000-00-00 00:00:00', 1, NULL, NULL);
/*!40000 ALTER TABLE `country_master` ENABLE KEYS */;


-- Dumping structure for table erp.designation_master
DROP TABLE IF EXISTS `designation_master`;
CREATE TABLE IF NOT EXISTS `designation_master` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.designation_master: ~0 rows (approximately)
DELETE FROM `designation_master`;
/*!40000 ALTER TABLE `designation_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `designation_master` ENABLE KEYS */;


-- Dumping structure for table erp.module_master
DROP TABLE IF EXISTS `module_master`;
CREATE TABLE IF NOT EXISTS `module_master` (
  `module_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `module_menu_link` varchar(100) DEFAULT NULL,
  `module_menu_icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table erp.module_master: ~6 rows (approximately)
DELETE FROM `module_master`;
/*!40000 ALTER TABLE `module_master` DISABLE KEYS */;
INSERT INTO `module_master` (`module_id`, `module_name`, `module_menu_link`, `module_menu_icon`) VALUES
	(1, 'website', 'website', 'icon-globe'),
	(2, 'pages', 'pages', 'icon-file'),
	(3, 'posts', 'posts', 'icon-pencil'),
	(4, 'videos', 'videos', 'icon-film'),
	(5, 'store', 'store', 'icon-shopping-cart'),
	(6, 'users', 'users', 'icon-shopping-cart');
/*!40000 ALTER TABLE `module_master` ENABLE KEYS */;


-- Dumping structure for table erp.nob_master
DROP TABLE IF EXISTS `nob_master`;
CREATE TABLE IF NOT EXISTS `nob_master` (
  `nob_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `nob_name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`nob_master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.nob_master: ~0 rows (approximately)
DELETE FROM `nob_master`;
/*!40000 ALTER TABLE `nob_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `nob_master` ENABLE KEYS */;


-- Dumping structure for table erp.privileged_user
DROP TABLE IF EXISTS `privileged_user`;
CREATE TABLE IF NOT EXISTS `privileged_user` (
  `privileged_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `module_id` tinyint(4) DEFAULT NULL,
  `priv_create` enum('Y','N') DEFAULT NULL,
  `priv_read` enum('Y','N') DEFAULT NULL,
  `priv_update` enum('Y','N') DEFAULT NULL,
  `priv_delete` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`privileged_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table erp.privileged_user: 0 rows
DELETE FROM `privileged_user`;
/*!40000 ALTER TABLE `privileged_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `privileged_user` ENABLE KEYS */;


-- Dumping structure for table erp.role_master
DROP TABLE IF EXISTS `role_master`;
CREATE TABLE IF NOT EXISTS `role_master` (
  `role_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `public_read` enum('Y','N') DEFAULT NULL,
  `public_create` enum('Y','N') DEFAULT NULL,
  `public_update` enum('Y','N') DEFAULT NULL,
  `public_delete` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table erp.role_master: 1 rows
DELETE FROM `role_master`;
/*!40000 ALTER TABLE `role_master` DISABLE KEYS */;
INSERT INTO `role_master` (`role_id`, `role_name`, `public_read`, `public_create`, `public_update`, `public_delete`) VALUES
	(1, 'Master-Admin', 'Y', 'Y', 'Y', 'Y');
/*!40000 ALTER TABLE `role_master` ENABLE KEYS */;


-- Dumping structure for table erp.user_master
DROP TABLE IF EXISTS `user_master`;
CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_role_id` tinyint(4) DEFAULT NULL,
  `is_role_updated` enum('Y','N') DEFAULT NULL,
  `user_modules` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table erp.user_master: 1 rows
DELETE FROM `user_master`;
/*!40000 ALTER TABLE `user_master` DISABLE KEYS */;
INSERT INTO `user_master` (`user_id`, `client_id`, `name`, `email`, `username`, `password`, `user_role_id`, `is_role_updated`, `user_modules`) VALUES
	(1, 1, 'Harish sharma', 'sharmaharish09@yahoo.co.in', 'admin', 'admin123', 1, 'N', '1');
/*!40000 ALTER TABLE `user_master` ENABLE KEYS */;


-- Dumping structure for table erp.user_module_master
DROP TABLE IF EXISTS `user_module_master`;
CREATE TABLE IF NOT EXISTS `user_module_master` (
  `user_id` smallint(6) DEFAULT NULL,
  `module_id` tinyint(4) DEFAULT NULL,
  KEY `FK` (`module_id`),
  CONSTRAINT `FK` FOREIGN KEY (`module_id`) REFERENCES `module_master` (`module_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.user_module_master: ~6 rows (approximately)
DELETE FROM `user_module_master`;
/*!40000 ALTER TABLE `user_module_master` DISABLE KEYS */;
INSERT INTO `user_module_master` (`user_id`, `module_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 1),
	(1, 4),
	(1, 5),
	(1, 6);
/*!40000 ALTER TABLE `user_module_master` ENABLE KEYS */;


-- Dumping structure for table erp.zone_master
DROP TABLE IF EXISTS `zone_master`;
CREATE TABLE IF NOT EXISTS `zone_master` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zone_name` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp.zone_master: ~0 rows (approximately)
DELETE FROM `zone_master`;
/*!40000 ALTER TABLE `zone_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `zone_master` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

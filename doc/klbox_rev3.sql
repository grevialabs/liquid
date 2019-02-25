/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `klbox` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `klbox`;

CREATE TABLE IF NOT EXISTS `ms_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `article` varchar(100) DEFAULT NULL,
  `customer_article` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `uom` varchar(100) DEFAULT NULL,
  `conversion_value` int(11) DEFAULT NULL,
  `safety_stock` int(11) DEFAULT NULL,
  `column` varchar(100) DEFAULT NULL,
  `rack` varchar(100) DEFAULT NULL,
  `row` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_article` DISABLE KEYS */;
INSERT INTO `ms_article` (`article_id`, `site_id`, `article`, `customer_article`, `description`, `uom`, `conversion_value`, `safety_stock`, `column`, `rack`, `row`, `price`, `chamber_sync_flag`, `field_sync`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, '2', '22', '2', '2', '2', 2, 2, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, '3', '33', '3', '3', '3', 3, 3, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_article` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_article_attribute` (
  `article_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(100) NOT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_article_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_article_attribute` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_article_attribute_value` (
  `article_attribute_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `article_attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(100) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_attribute_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_article_attribute_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_article_attribute_value` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_article_stock` (
  `article_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `article` varchar(100) NOT NULL,
  `customer_article` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_stock_id`),
  UNIQUE KEY `site_id_article` (`site_id`,`article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_article_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_article_stock` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_capability` (
  `capability_id` int(11) NOT NULL AUTO_INCREMENT,
  `capability` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`capability_id`),
  UNIQUE KEY `capability` (`capability`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_capability` DISABLE KEYS */;
INSERT INTO `ms_capability` (`capability_id`, `capability`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 'site', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'pic', 1, NULL, NULL, NULL, '2019-02-18 07:35:34', '1', '::1'),
	(3, 'company', 1, NULL, NULL, NULL, '2019-02-18 07:35:11', '1', '::1'),
	(4, 'transaction', 1, '2019-02-18 07:35:21', '1', '::1', NULL, NULL, NULL),
	(5, 'dashboard', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'role', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'capability', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'role-capability', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'user', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'user-attribute', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'user-role', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'article', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'article-attribute', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'article-stock', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'article-attribute-value', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 'article-po', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 'rfid-article', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 'level', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 'reason', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 'reason-type', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 'reason-type-mapping', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 'movement-article', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 'movement-quota-level', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 'article-logistic-site', 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_capability` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_phone` varchar(50) DEFAULT NULL,
  `company_pic` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_company` DISABLE KEYS */;
INSERT INTO `ms_company` (`company_id`, `company_name`, `company_address`, `company_phone`, `company_pic`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(2, 'cacac', 'a', '22', '121', 1, NULL, NULL, NULL, '2019-02-22 11:03:34', '1', '::1'),
	(3, 'masih', 'testing', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'gokil', 'ceo', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'angka', 'reksa', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'Rusdi Karsandi', 'tetes', '13213', '1021', -1, NULL, NULL, NULL, '2019-02-11 02:53:31', '1', '::1'),
	(7, 'Rusdi Karsandi', 'tetes', '13213', '1021', 1, '2019-01-24 11:01:44', '1', '::1', NULL, NULL, NULL),
	(8, 'Rusdi Karsandi', 'tetes', '13213', '1021', 1, '2019-01-24 11:02:28', '1', '::1', NULL, NULL, NULL),
	(9, 'damai', 'tes', '2123', 'pic tester', -1, '2019-01-29 11:21:04', '1', '::1', '2019-02-21 04:03:28', '1', '::1'),
	(10, 'damai', 'tes aaa', '2123', 'pic tester aa', -1, '2019-01-29 11:22:58', '1', '::1', '2019-02-11 02:56:34', '1', '::1'),
	(1100000204, 'PT. UNILEVER INDONESIA TBK', 'JL. BSD BOULEVARD BARAT GREEN OFFICE PARK KAVLING 3 BSD CITY SAMPORA CISAUK KAB. TANGERANG BANTEN', '11230*', 'Darmawan aa', -1, NULL, NULL, NULL, '2019-02-11 04:16:19', '1', '::1');
/*!40000 ALTER TABLE `ms_company` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `config_name` varchar(100) DEFAULT NULL,
  `config_value` tinyint(4) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_config` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_hierarchy` int(11) DEFAULT '1',
  `level_name` varchar(100) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_level` DISABLE KEYS */;
INSERT INTO `ms_level` (`level_id`, `level_hierarchy`, `level_name`, `chamber_sync_flag`, `field_sync`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 1, 'Product Manager aa', 0, 0, 1, NULL, NULL, NULL, '2019-02-06 11:09:26', '1', '::1'),
	(2, 2, 'Assistant Director', 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_level` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_pic` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `pic_name` varchar(100) DEFAULT NULL,
  `pic_phone` varchar(100) DEFAULT NULL,
  `pic_email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_pic` DISABLE KEYS */;
INSERT INTO `ms_pic` (`pic_id`, `site_id`, `pic_name`, `pic_phone`, `pic_email`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 'SZ24', 'selena gwena', '20121111', 'ese@gmail.com', 1, NULL, NULL, NULL, '2019-02-06 08:35:24', '1', '::1'),
	(2, 'SZ24', 'Maria', '112313131', 'mari@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_pic` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_reason` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_value` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_reason` DISABLE KEYS */;
INSERT INTO `ms_reason` (`reason_id`, `reason_value`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 'No money dollar', 1, NULL, NULL, NULL, '2019-02-06 08:51:11', '1', '::1'),
	(2, 'machine error', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'Testing Reasin', 1, '2019-02-06 08:51:43', '1', '::1', NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_reason` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_rfid_article` (
  `rfid_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `outbound_delivery` varchar(15) NOT NULL,
  `article` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `rfid` varchar(200) DEFAULT NULL,
  `picktime` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sync_date` datetime DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`rfid_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_rfid_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_rfid_article` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_role` DISABLE KEYS */;
INSERT INTO `ms_role` (`role_id`, `role_name`, `chamber_sync_flag`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 'admin', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'super admin', 0, -1, NULL, NULL, NULL, '2019-02-18 07:36:38', '1', '::1'),
	(3, 'replenisha', 0, 1, NULL, NULL, NULL, '2019-02-18 07:36:23', '1', '::1'),
	(4, 'engineer', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'director', 0, 1, '2019-02-18 07:36:31', '1', '::1', NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_role` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_role_capability` (
  `role_capability_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(100) DEFAULT NULL,
  `capability_id` int(11) NOT NULL,
  `create` tinyint(4) NOT NULL DEFAULT '0',
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `update` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`role_capability_id`),
  UNIQUE KEY `role_id_capability_id` (`role_id`,`capability_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_role_capability` DISABLE KEYS */;
INSERT INTO `ms_role_capability` (`role_capability_id`, `role_id`, `capability_id`, `create`, `read`, `update`, `delete`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, '1', 1, 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, '1', 2, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, '1', 3, 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, '1', 4, 1, 0, 0, 1, 1, NULL, NULL, NULL, '2019-02-18 16:33:58', NULL, NULL),
	(13, '2', 1, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, '2', 3, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, '2', 4, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, '1', 5, 0, 1, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(17, '1', 6, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(18, '1', 7, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(19, '1', 8, 1, 1, 1, 1, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(20, '1', 9, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(21, '1', 10, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(22, '1', 11, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(23, '1', 12, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(24, '1', 13, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(25, '1', 14, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(26, '1', 15, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(27, '1', 16, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(28, '1', 17, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(29, '1', 18, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(30, '1', 19, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(31, '1', 20, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(32, '1', 21, 0, 0, 0, 0, 1, '2019-02-21 03:01:05', NULL, NULL, NULL, NULL, NULL),
	(51, '2', 5, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(52, '2', 6, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(53, '2', 7, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(54, '2', 8, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(55, '2', 9, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(56, '2', 10, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(57, '2', 11, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(58, '2', 12, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(59, '2', 13, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(60, '2', 14, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(61, '2', 15, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(62, '2', 16, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(63, '2', 17, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(64, '2', 18, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(65, '2', 19, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(66, '2', 20, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(67, '2', 21, 0, 0, 0, 0, 1, '2019-02-21 03:38:08', NULL, NULL, NULL, NULL, NULL),
	(82, '0', 1, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(83, '0', 3, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(84, '0', 4, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(85, '0', 5, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(86, '0', 6, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(87, '0', 7, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(88, '0', 8, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(89, '0', 9, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(90, '0', 10, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(91, '0', 11, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(92, '0', 12, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(93, '0', 13, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(94, '0', 14, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(95, '0', 15, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(96, '0', 16, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(97, '0', 17, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(98, '0', 18, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(99, '0', 19, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(100, '0', 20, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(101, '0', 21, 0, 0, 0, 0, 1, '2019-02-22 08:29:05', NULL, NULL, NULL, NULL, NULL),
	(113, '1', 22, 0, 0, 0, 0, 1, '2019-02-22 08:56:33', NULL, NULL, NULL, NULL, NULL),
	(114, '1', 23, 0, 0, 0, 0, 1, '2019-02-22 08:56:33', NULL, NULL, NULL, NULL, NULL),
	(115, '1', 24, 0, 0, 0, 0, 1, '2019-02-22 08:56:33', NULL, NULL, NULL, NULL, NULL),
	(134, '0', 2, 0, 0, 0, 0, 1, '2019-02-25 02:31:42', NULL, NULL, NULL, NULL, NULL),
	(135, '0', 22, 0, 0, 0, 0, 1, '2019-02-25 02:31:42', NULL, NULL, NULL, NULL, NULL),
	(136, '0', 23, 0, 0, 0, 0, 1, '2019-02-25 02:31:42', NULL, NULL, NULL, NULL, NULL),
	(137, '0', 24, 0, 0, 0, 0, 1, '2019-02-25 02:31:42', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_role_capability` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_site` (
  `site_id` varchar(10) NOT NULL,
  `company_id` int(11) NOT NULL,
  `site_name` varchar(100) DEFAULT NULL,
  `site_address` varchar(200) DEFAULT NULL,
  `site_qty_value` int(11) DEFAULT NULL,
  `flag_qty_value` varchar(100) DEFAULT NULL,
  `method_calc` varchar(25) DEFAULT NULL,
  `start_date_counting` datetime DEFAULT NULL,
  `reset_days` int(11) DEFAULT NULL,
  `logo_file_name` text,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_site` DISABLE KEYS */;
INSERT INTO `ms_site` (`site_id`, `company_id`, `site_name`, `site_address`, `site_qty_value`, `flag_qty_value`, `method_calc`, `start_date_counting`, `reset_days`, `logo_file_name`, `chamber_sync_flag`, `field_sync`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	('SZ20', 2, 'KL002', 'Jl mesin no 9', 2, '20', 'ter', '0000-00-00 00:00:00', 3, '', 0, 0, 1, NULL, NULL, NULL, '2019-02-14 04:23:57', '1', '::1'),
	('SZ24', 1100000204, 'KL001', 'Jl antara no 1', 5, '2', '2', '2019-02-06 10:39:44', 4, '', 0, 0, 1, NULL, NULL, NULL, '2019-02-13 04:44:49', '1', '::1');
/*!40000 ALTER TABLE `ms_site` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `ms_token` DISABLE KEYS */;
INSERT INTO `ms_token` (`token_id`, `name`, `token`, `expired_at`) VALUES
	(2, 'key', 'macbook', NULL);
/*!40000 ALTER TABLE `ms_token` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(10) DEFAULT NULL,
  `parent_user_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `user_code` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `quota_initial` int(11) DEFAULT NULL,
  `quota_additional` int(11) DEFAULT NULL,
  `quota_remaining` int(11) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_category` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `counter_wrong_pass` tinyint(4) DEFAULT '0',
  `status_lock` tinyint(4) DEFAULT '0',
  `locked_time` datetime DEFAULT NULL,
  `reset_by` varchar(100) DEFAULT NULL,
  `reset_time` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_user` DISABLE KEYS */;
INSERT INTO `ms_user` (`user_id`, `site_id`, `parent_user_id`, `level_id`, `user_code`, `firstname`, `lastname`, `quota_initial`, `quota_additional`, `quota_remaining`, `job_title`, `division`, `email`, `user_category`, `password`, `counter_wrong_pass`, `status_lock`, `locked_time`, `reset_by`, `reset_time`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 'SZ20', NULL, 1, 'admin', 'selena', 'gwen', NULL, NULL, NULL, 'Presdir', 'IT', 'selena@gmail.com', 'client', 'eyJpdiI6IlN5S3BXQmlmOGdOY2VPaDVocGVIYUE9PSIsInZhbHVlIjoiQ3BQRTE3SVVXK2d4ZTRrVjRcL3dFK2c9PSIsIm1hYyI6ImRlMmM3ZjUxZTc5Y2RlMDE1YTI5Y2Y4YTQzNzI1YTI1MmIxYWM5MmMyMjU2NDA4ODkzYjIzZjdhMmFlM2U3NjQifQ==', 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'SZ20', NULL, 2, 'domo', 'domo', 'tester', NULL, NULL, NULL, 'staff', 'Sales', 'domo@a.com', 'replenish', 'eyJpdiI6IlN5S3BXQmlmOGdOY2VPaDVocGVIYUE9PSIsInZhbHVlIjoiQ3BQRTE3SVVXK2d4ZTRrVjRcL3dFK2c9PSIsIm1hYyI6ImRlMmM3ZjUxZTc5Y2RlMDE1YTI5Y2Y4YTQzNzI1YTI1MmIxYWM5MmMyMjU2NDA4ODkzYjIzZjdhMmFlM2U3NjQifQ==', 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_user` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_user_attribute` (
  `user_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `ms_user_attribute` DISABLE KEYS */;
INSERT INTO `ms_user_attribute` (`user_attribute_id`, `user_id`, `attribute`, `value`, `chamber_sync_flag`, `field_sync`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, 2, '15', 'ayamgoreng kampung', 0, 0, 1, '2019-02-12 04:33:07', '1', '::1', '2019-02-20 08:13:55', '1', '::1');
/*!40000 ALTER TABLE `ms_user_attribute` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ms_user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `ms_user_role` DISABLE KEYS */;
INSERT INTO `ms_user_role` (`user_role_id`, `role_id`, `user_id`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	(1, '1', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ms_user_role` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_article_logistic_site` (
  `article_logistic_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(4) NOT NULL,
  `outbound_delivery` varchar(15) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_logistic_site_id`,`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `tr_article_logistic_site` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_article_logistic_site` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_article_logistic_site_detail` (
  `article_logistic_site_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `outbound_delivery` int(11) NOT NULL,
  `article` varchar(100) NOT NULL,
  `customer_article` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `qty_issue` int(11) DEFAULT NULL,
  `conv_uom` varchar(10) DEFAULT NULL,
  `qty_receive_actual` int(11) DEFAULT NULL,
  `qty_receive` int(11) DEFAULT NULL,
  `disc_minus` int(11) DEFAULT NULL,
  `disc_plus` int(11) DEFAULT NULL,
  `conversion_diff` int(11) DEFAULT NULL COMMENT 'selisih conversion',
  `dashboard_received_date` datetime DEFAULT NULL,
  `qty_chamber` varchar(100) DEFAULT NULL,
  `chamber_disc_minus` int(11) DEFAULT NULL,
  `chamber_disc_plus` int(11) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`article_logistic_site_detail_id`,`outbound_delivery`,`article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tr_article_logistic_site_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_article_logistic_site_detail` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_log` (
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `data` text,
  `json` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `tr_log` DISABLE KEYS */;
INSERT INTO `tr_log` (`log_id`, `name`, `url`, `data`, `json`, `created_at`, `created_by`, `created_ip`) VALUES
	(1, '/kalibri/client/company', '/kalibri/client/company', '{"name":"ujang"}', '{"name":"ujang"}', '2019-02-01 11:35:56', 'BOT', '::1');
/*!40000 ALTER TABLE `tr_log` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_movement_article` (
  `movement_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiving_site_id` varchar(4) DEFAULT NULL,
  `article` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `movement_type` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`movement_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tr_movement_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_movement_article` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_movement_quota_level` (
  `movement_quota_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` varchar(4) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `balance_qty` int(11) DEFAULT NULL,
  `balance_value` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`movement_quota_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tr_movement_quota_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_movement_quota_level` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_prepack_bundling_detail` (
  `prepack_bundling_detail` int(11) NOT NULL AUTO_INCREMENT,
  `prepack_id` int(11) NOT NULL,
  `outbound_delivery` int(11) NOT NULL,
  `article` varchar(100) DEFAULT NULL,
  `line_id` int(11) DEFAULT NULL,
  `qty_dashboard` int(11) DEFAULT NULL,
  `reference` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`prepack_bundling_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tr_prepack_bundling_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_prepack_bundling_detail` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_prepack_bundling_header` (
  `prepack_id` int(11) NOT NULL AUTO_INCREMENT,
  `outbound_delivery` int(11) NOT NULL,
  `site_created_on` varchar(4) DEFAULT NULL,
  `status_prepack` varchar(100) DEFAULT NULL,
  `conv_uom` varchar(100) DEFAULT NULL,
  `combine_qty` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`prepack_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `tr_prepack_bundling_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_prepack_bundling_header` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tr_transaction` (
  `transaction_id` varchar(100) NOT NULL,
  `site_id` varchar(4) NOT NULL,
  `user_id` varchar(4) NOT NULL,
  `article` varchar(100) DEFAULT NULL,
  `customer_article` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `status_in_out` varchar(10) DEFAULT NULL COMMENT 'in or out',
  `reason_id` int(11) DEFAULT NULL,
  `wo_wbs` varchar(100) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `chamber_sync_flag` tinyint(4) DEFAULT '0',
  `field_sync` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created_ip` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `updated_ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `tr_transaction` DISABLE KEYS */;
INSERT INTO `tr_transaction` (`transaction_id`, `site_id`, `user_id`, `article`, `customer_article`, `description`, `qty`, `value`, `status_in_out`, `reason_id`, `wo_wbs`, `remark`, `chamber_sync_flag`, `field_sync`, `status`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
	('22', '2', '3', NULL, NULL, NULL, 321231, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tr_transaction` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

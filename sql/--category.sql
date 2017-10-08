# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.33)
# Database: tannhatquang_DB
# Generation Time: 2017-10-07 02:57:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `url` varchar(256) NOT NULL,
  `thumbnail` varchar(256) DEFAULT NULL,
  `desc` varchar(2048) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` tinyint(1) NOT NULL,
  `path` varchar(256) NOT NULL DEFAULT '',
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(256) DEFAULT NULL,
  `updated_by` varchar(256) DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `url`, `thumbnail`, `desc`, `order`, `parent_id`, `path`, `created_datetime`, `updated_datetime`, `created_by`, `updated_by`, `status`)
VALUES
	(1,'Sản phẩm','san-pham',NULL,NULL,0,0,'0-1-','2017-10-07 09:35:54',NULL,'admin',NULL,'active'),
	(2,'Tin tức','tin-tuc',NULL,NULL,0,0,'0-2-','2017-10-07 09:35:54',NULL,'admin',NULL,'active'),
	(3,'Dây điện','day-dien','','',0,1,'0-1-3-','2017-10-07 09:41:29','2017-10-07 09:41:29','admin',NULL,'active'),
	(4,'Dây cáp','day-cap','','',0,1,'0-1-4-','2017-10-07 09:41:36','2017-10-07 09:41:36','admin',NULL,'active'),
	(5,'Dây dân dụng','day-dan-dung','','',0,3,'0-1-3-5-','2017-10-07 09:41:44','2017-10-07 09:41:44','admin',NULL,'active'),
	(6,'Dây điện lực','day-dien-luc','','',0,3,'0-1-3-6-','2017-10-07 09:41:52','2017-10-07 09:41:52','admin',NULL,'active'),
	(7,'Camera quan sát','camera-quan-sat','','',0,1,'0-1-7-','2017-10-07 09:43:05','2017-10-07 09:43:05','admin',NULL,'active'),
	(8,'Đèn trang trí','den-trang-tri','','',0,1,'0-1-8-','2017-10-07 09:43:24','2017-10-07 09:43:24','admin',NULL,'active'),
	(9,'Đèn dân dụng','den-dan-dung','','',0,1,'0-1-9-','2017-10-07 09:43:33','2017-10-07 09:43:33','admin',NULL,'active'),
	(10,'Đèn công nghiệp','den-cong-nghiep','','',0,1,'0-1-10-','2017-10-07 09:43:44','2017-10-07 09:43:44','admin',NULL,'active'),
	(11,'Thiết bị điện','thiet-bi-dien','','',0,1,'0-1-11-','2017-10-07 09:43:55','2017-10-07 09:43:55','admin',NULL,'active'),
	(12,'Thiết bị đóng cắt','thiet-bi-dong-cat','','',0,1,'0-1-12-','2017-10-07 09:44:11','2017-10-07 09:44:11','admin',NULL,'active'),
	(13,'Thiết bị thông minh','thiet-bi-thong-minh','','',0,1,'0-1-13-','2017-10-07 09:44:18','2017-10-07 09:44:18','admin',NULL,'active'),
	(14,'Sản phẩm khác','san-pham-khac','','',0,1,'0-1-14-','2017-10-07 09:44:40','2017-10-07 09:44:40','admin',NULL,'active');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

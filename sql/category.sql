# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.33)
# Database: tannhatquang_DB
# Generation Time: 2017-08-04 02:09:03 +0000
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
  `url` varchar(1024) DEFAULT NULL,
  `thumbnail` varchar(256) DEFAULT NULL,
  `desc` varchar(2048) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` tinyint(1) NOT NULL,
  `path` varchar(256) NOT NULL DEFAULT '',
  `created_datetime` datetime DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `created_by` varchar(256) DEFAULT NULL,
  `modified_by` varchar(256) DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `url`, `thumbnail`, `desc`, `order`, `parent_id`, `path`, `created_datetime`, `modified_datetime`, `created_by`, `modified_by`, `status`)
VALUES
	(1,'default','default',NULL,'default',0,0,'0-1-','2014-12-25 00:00:01',NULL,'admin',NULL,'active'),
	(2,'product','product',NULL,'product',0,0,'0-2-','2014-12-25 00:00:01',NULL,'admin',NULL,'active'),
	(3,'news','news',NULL,'news',0,0,'0-3-','2014-12-25 00:00:01',NULL,'admin',NULL,'active'),
	(4,'Camera quan sát','camera-quan-sat','','Camera quan sát',0,2,'0-2-4-','2017-07-27 21:52:20',NULL,'admin',NULL,'active'),
	(5,'Dây điện','day-dien','','Dây điện',0,2,'0-2-5-','2017-07-27 22:32:00',NULL,'admin',NULL,'active'),
	(6,'Dây dân dụng','day-dan-dung','','',0,5,'0-2-5-6-','2017-07-27 23:17:28',NULL,'admin',NULL,'active'),
	(7,'Dây điện lực','day-dien-luc','','',0,5,'0-2-5-7-','2017-07-27 23:17:55',NULL,'admin',NULL,'active'),
	(8,'Đèn trang trí','den-trang-tri','','',0,2,'0-2-8-','2017-07-28 22:55:21',NULL,'admin',NULL,'active'),
	(9,'Đèn dân dụng','den-dan-dung','','',0,8,'0-2-8-9-','2017-07-28 22:55:44','2017-07-28 23:41:15','admin','admin','active'),
	(10,'Đèn công nghiệp','den-cong-nghiep','','',0,8,'0-2-8-10-','2017-07-28 23:39:06',NULL,'admin',NULL,'active'),
	(11,'Thiết bị điện','thiet-bi-dien','','',0,2,'0-2-11-','2017-07-29 18:44:35',NULL,'admin',NULL,'active'),
	(13,'Thiết bị đóng cắt','thiet-bi-dong-cat','','',0,2,'0-2-13-','2017-08-04 09:08:13',NULL,'admin',NULL,'active'),
	(14,'Thiết bị thông minh','thiet-bi-thong-minh','','',0,2,'0-2-14-','2017-08-04 09:08:25',NULL,'admin',NULL,'active'),
	(15,'Sản phẩm khác','san-pham-khac','','',0,2,'0-2-15-','2017-08-04 09:08:38',NULL,'admin',NULL,'active');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

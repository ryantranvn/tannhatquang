# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.33)
# Database: tannhatquang_DB
# Generation Time: 2017-09-24 14:26:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table captcha
# ------------------------------------------------------------

DROP TABLE IF EXISTS `captcha`;

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `security_code` varchar(256) NOT NULL DEFAULT '',
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `captcha` WRITE;
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;

INSERT INTO `captcha` (`captcha_id`, `security_code`, `captcha_time`, `ip_address`, `word`)
VALUES
	(254,'f800d207d913274325d14e3c14401257',1506257897,'::1','ESWTL');

/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'Sản phẩm','san-pham','','',0,0,'0-1-','2017-09-24 21:14:14','2017-09-24 21:14:14','admin',NULL,'active');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL DEFAULT '56136fc330019e0e526cfbe08f940fa08610be81',
  `thumbnail` varchar(256) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_datetime` datetime DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;

INSERT INTO `member` (`id`, `username`, `password`, `thumbnail`, `status`, `created_datetime`, `modified_datetime`)
VALUES
	(1,'admin','e8e5d2936cf84860ef65dc3281ea42e907fad148',NULL,'active','2014-12-25 00:00:01',NULL);

/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_permission`;

CREATE TABLE `member_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL,
  `id_permission` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `member_permission` WRITE;
/*!40000 ALTER TABLE `member_permission` DISABLE KEYS */;

INSERT INTO `member_permission` (`id`, `id_member`, `id_module`, `id_permission`, `active`)
VALUES
	(1,1,1,1,1),
	(2,1,1,2,1),
	(3,1,1,3,1),
	(4,1,1,4,1),
	(5,1,2,1,1),
	(6,1,2,2,1),
	(7,1,2,3,1),
	(8,1,2,4,1),
	(9,1,3,1,1),
	(10,1,3,2,1),
	(11,1,3,3,1),
	(12,1,3,4,1),
	(13,1,4,1,1),
	(14,1,4,2,1),
	(15,1,4,3,1),
	(16,1,4,4,1),
	(17,1,5,1,1),
	(18,1,5,2,1),
	(19,1,5,3,1),
	(20,1,5,4,1),
	(21,1,6,1,1),
	(22,1,6,2,1),
	(23,1,6,3,1),
	(24,1,6,4,1),
	(25,1,7,1,1),
	(26,1,7,2,1),
	(27,1,7,3,1),
	(28,1,7,4,1),
	(29,1,8,1,1),
	(30,1,8,2,1),
	(31,1,8,3,1),
	(32,1,8,4,1),
	(33,1,9,1,1),
	(34,1,9,2,1),
	(35,1,9,3,1),
	(36,1,9,4,1),
	(37,1,10,1,1),
	(38,1,10,2,1),
	(39,1,10,3,1),
	(40,1,10,4,1);

/*!40000 ALTER TABLE `member_permission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `control_name` varchar(256) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `desc` varchar(512) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;

INSERT INTO `module` (`id`, `name`, `control_name`, `url`, `desc`, `icon`, `active`, `order`)
VALUES
	(1,'Dashboard','Dashboard','dashboard','dashboard','fa fa-lg fa-fw fa-home',1,0),
	(2,'Category','Category','category','category','fa fa-lg fa-fw fa-list',1,0),
	(3,'Member','Member','member','member','fa fa-lg fa-fw fa-user',1,0),
	(4,'Module','Module','module','module','fa fa-lg fa-fw fa-cubes',1,0),
	(5,'Setting','Setting','setting','setting','fa fa-lg fa-fw fa-gears',1,0),
	(6,'User','User','user','Manage users','fa fa-group',1,0),
	(7,'Product Category','Product_category','product-category','Manage product category','fa fa-reorder',1,0),
	(8,'Product','Product','product','Manage product','fa fa-th-list',1,0),
	(9,'News Category','News_category','news-category','Manage news category','fa fa-folder',1,0),
	(10,'News','News','news','Manage news','fa fa-file-text',1,0);

/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `thumbnail` varchar(256) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `detail` text,
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;

INSERT INTO `permission` (`id`, `name`, `description`)
VALUES
	(1,'read','can just view'),
	(2,'add','can just view or add'),
	(3,'edit','can just view or edit'),
	(4,'delete','can just view or delete');

/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT 'active',
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(256) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `category_id`, `type`, `status`, `created_datetime`, `created_by`, `updated_datetime`, `updated_by`, `del_flg`)
VALUES
	(3,1,'product','active','2017-09-24 21:15:42','admin','2017-09-24 21:20:06','admin',0);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_picture`;

CREATE TABLE `post_picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post_picture` WRITE;
/*!40000 ALTER TABLE `post_picture` DISABLE KEYS */;

INSERT INTO `post_picture` (`id`, `post_id`, `url`)
VALUES
	(1,1,''),
	(4,3,'');

/*!40000 ALTER TABLE `post_picture` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `code` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `unit` varchar(256) DEFAULT NULL,
  `manufacturer` varchar(256) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `stock_in_trade` int(11) DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `price_sale` int(11) DEFAULT '0',
  `price_sale_percent` int(11) DEFAULT '0',
  `detail` text,
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `post_id`, `code`, `name`, `url`, `description`, `unit`, `manufacturer`, `quantity`, `stock_in_trade`, `price`, `price_sale`, `price_sale_percent`, `detail`, `order`)
VALUES
	(3,3,'A001','Attomat BS121 2P 15A','attomat-bs121-2p-15a','','','Việt Nam',0,0,0,0,0,'',0);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `value` varchar(1024) DEFAULT NULL,
  `status` varchar(256) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;

INSERT INTO `setting` (`id`, `name`, `value`, `status`)
VALUES
	(1,'page_title','Tân Nhật Quang','active'),
	(2,'meta_key','điện','active'),
	(3,'meta_description','cửa hàng điện Tân Nhật Quang','active');

/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table url_route
# ------------------------------------------------------------

DROP TABLE IF EXISTS `url_route`;

CREATE TABLE `url_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(256) NOT NULL,
  `updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(256) NOT NULL,
  `status` varchar(256) DEFAULT 'active',
  `del_flg` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `url_route` WRITE;
/*!40000 ALTER TABLE `url_route` DISABLE KEYS */;

INSERT INTO `url_route` (`id`, `url`, `category_id`, `post_id`, `created_datetime`, `created_by`, `updated_datetime`, `updated_by`, `status`, `del_flg`)
VALUES
	(1,'san-pham-c1',1,NULL,'2017-09-24 21:14:14','admin',NULL,'','active',0),
	(2,'attomat-bs121-2p-15a-A001-p3',1,3,'2017-09-24 21:15:42','admin','2017-09-24 21:20:06','','active',0);

/*!40000 ALTER TABLE `url_route` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

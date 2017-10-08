# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.33)
# Database: tannhatquang_DB
# Generation Time: 2017-10-08 23:17:33 +0000
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
	(275,'192b83c9db12901a55ac70eba5125243',1507425724,'::1','ADVTC');

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

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `post_id`, `title`, `url`, `thumbnail`, `description`, `detail`, `order`)
VALUES
	(2,1326,'Tin tức 3','tin-tuc-3',NULL,'',NULL,0),
	(3,1327,'dfa adf asd','dfa-adf-asd',NULL,'',NULL,0),
	(4,1328,'sa dfasd adfa df','sa-dfasd-adfa-df',NULL,'',NULL,0),
	(5,1329,'adsf asdfa df','adsf-asdfa-df',NULL,'','<p>&nbsp;asdfadfa dfasdf<img alt=\"\" src=\"/upload/images/temp/112.jpg\" style=\"height:720px; width:720px\" /></p>\n',0);

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


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
  `category_name` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT 'active',
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(256) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `del_flg` tinyint(4) DEFAULT '0',
  `hot_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `category_id`, `category_name`, `type`, `status`, `created_datetime`, `created_by`, `updated_datetime`, `updated_by`, `del_flg`, `hot_flg`)
VALUES
	(1,10,'Đèn công nghiệp','product','active','2017-10-07 10:04:58','admin','2017-10-08 09:06:57',NULL,0,1),
	(2,10,'Đèn công nghiệp','product','active','2017-10-07 10:05:51','admin','2017-10-07 10:05:51',NULL,0,0),
	(3,10,'Đèn công nghiệp','product','active','2017-10-07 10:06:41','admin','2017-10-07 10:06:41',NULL,0,0),
	(4,12,'Thiết bị đóng cắt','product','active','2017-10-07 10:22:30','admin','2017-10-08 09:06:54','admin',0,1),
	(5,12,'Thiết bị đóng cắt','product','active','2017-10-07 10:23:55','admin','2017-10-08 09:41:12','admin',0,1),
	(6,4,'Dây cáp','product','active','2017-10-07 10:26:01','admin','2017-10-08 09:25:55','admin',0,0);

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
	(1,1,'/upload/images/temp/59d8443b2c9d2_1507345467.jpg'),
	(2,1,'/upload/images/temp/59d8443b3201c_1507345467.jpg'),
	(3,2,'/upload/images/temp/59d8443b0c0f6_1507345467.jpg'),
	(4,3,'/upload/images/temp/59d8443b1fa79_1507345467.jpg'),
	(6,5,'/upload/images/temp/59d848bdcae79_1507346621.jpg'),
	(7,4,'/upload/images/temp/59d848aebd389_1507346606.jpg'),
	(9,6,'/upload/images/temp/59d84939d6763_1507346745.jpg');

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
	(1,1,'DCN001','Đèn MELOS','den-melos','Chiếu sáng công xưởng, nhà kho, nhà ga, bãi đỗ xe, gầm cầu vượt...','','Hàn Quốc',0,0,0,0,0,'<p><strong>Mô tả sản phẩm:</strong></p>\n\n<ul>\n	<li>Nguồn sáng: Module Led (Hàn Quốc).</li>\n	<li>Bộ nguồn: Tự động bảo vệ khi ngắn mạch, quá tải, quá nhiệt.</li>\n	<li>SPD: bảo vệ chống sét lan truyền tới 10kV.</li>\n	<li>Màu sơn:&nbsp;Sơn tĩnh điện màu đen mở.</li>\n	<li>Thân đèn:&nbsp;Nhôm anot hóa.</li>\n	<li>Hộp bộ điện: Nhựa kĩ thuật chịu lão hóa</li>\n	<li>Cút luồn dây: PG-13.5</li>\n	<li>Tay bắt đèn bằng thép</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<table>\n	<tbody>\n		<tr>\n			<td><strong>MELOS 90</strong></td>\n			<td><strong>&nbsp;MELOS 110 &amp; 140</strong></td>\n		</tr>\n		<tr>\n			<td><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%2090-2.jpg\" style=\"height:168px; width:247px\" /></td>\n			<td><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%20140-2.jpg\" style=\"height:147px; width:200px\" /></td>\n		</tr>\n		<tr>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%2090-3.jpg\" style=\"height:121px; width:213px\" /></td>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%20140-3.jpg\" style=\"height:119px; width:166px\" /></td>\n		</tr>\n		<tr>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%2090-4.jpg\" style=\"height:146px; width:257px\" /></td>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/MELOS%20140-4.jpg\" style=\"height:122px; width:219px\" /></td>\n		</tr>\n		<tr>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/duong%20cong%20MELOS%2090.jpg\" style=\"height:306px; width:444px\" /></td>\n			<td>&nbsp;<img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/MELOS/Melos%20100-140.jpg\" style=\"height:298px; width:412px\" /></td>\n		</tr>\n	</tbody>\n</table>\n',0),
	(2,2,'HB485','Đèn Highbay','den-highbay','Chiếu sáng công xưởng, nhà kho, siêu thị, khu mua sắm, nhà ga …','','Hàn Quốc',0,0,0,0,0,'<p><strong>Mô tả sản phẩm:&nbsp;</strong></p>\n\n<p>- Hộp bộ điện làm bằng nhôm đúc áp lực cao.</p>\n\n<p>- Chụp phản quang đa diện tán xạ ánh sáng, chống chói lóa được làm bằng nhôm tinh khiết, được a-nốt hóa.</p>\n\n<p>- Kính đèn làm bằng thủy tinh cường lực.</p>\n\n<p>- Gioăng hơi bằng Silicon đảm bảo độ kín khít.</p>\n\n<p>- Bộ điện 220V-50Hz lắp bên trong đèn, sử dụng bóng Sodium hoặc Metal Halide.</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Kích thước - Lắp đặt:</strong></p>\n\n<p>- W: 485mm; L: 615mm; H: 215mm</p>\n\n<p><strong>-&nbsp;</strong>Đèn được treo bằng móc vào trần, xà ...&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Hình ảnh:&nbsp;</strong></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB485_2.png\" style=\"height:367px; width:355px\" /></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB485_3.png\" style=\"height:329px; width:293px\" /></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB485_4.png\" style=\"height:336px; width:819px\" /></p>\n',0),
	(3,3,'HB520','Đèn Highbay','den-highbay','Chiếu sáng công xưởng, nhà kho, siêu thị, khu mua sắm, nhà ga …','','Hàn Quốc',0,0,0,0,0,'<p><strong>Mô tả sản phẩm:&nbsp;</strong></p>\n\n<p>- Hộp bộ điện làm bằng nhôm đúc áp lực cao.</p>\n\n<p>- Chụp phản quang được làm bằng nhôm tinh khiết, được a-nốt hóa.</p>\n\n<p>- Kính đèn làm bằng thủy tinh cường lực.</p>\n\n<p>- Gioăng hơi bằng Silicon đảm bảo độ kín khít.</p>\n\n<p>- Bộ điện 220V-50Hz lắp bên trong đèn, sử dụng được cho cả hai loại bóng Sodium hoặc Metal Halide.</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Kích thước - Lắp đặt:</strong></p>\n\n<p>- W: 520mm; L: 570mm; H: 290mm</p>\n\n<p>- Đèn được treo bằng cách móc vào trần, xà ...</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Hình ảnh:</strong></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB520_2.png\" style=\"height:356px; width:354px\" /></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB520_3.png\" style=\"height:316px; width:294px\" /></p>\n\n<p><img alt=\"\" src=\"http://www.hapulico.com/uploads/tiny_uploads/02-Den%20pha/HB520_4.png\" style=\"height:337px; width:817px\" /></p>\n',0),
	(4,4,'BH-D6 1P 6A','Cầu dao tự động MCB Mitsubishi','cau-dao-tu-dong-mcb-mitsubishi','MCB Mitsubishi  loại từ nhiệt BH-D6-1P-6A.\nSố cực 1P.\nDòng điện định mức 6A.\nĐiện áp định mức 230V.\nĐường đặc tính tải loại B hoặc C.\nTiêu chuẩn bảo vệ IP2X.','','Mitsubishi',0,0,65000,0,0,'<p>Thông số kĩ thuật trên Vatgia.com chỉ mang tính tham khảo, thông số có thể thay đổi mà không báo trước.<br />\nNếu bạn phát hiện thông số sai xin hãy&nbsp;<a href=\"javascript:;\" onclick=\"windowPrompt({ width: 600, height: 400, href: con_ajax_path + \'load_send_error_product.php?v=3&amp;record_id=3653005\', iframe: true });\" rel=\"nofollow\" title=\"Báo lỗi thông số kỹ thuật, ảnh sản phẩm\">Click vào đây</a>&nbsp;để thông báo cho chúng tôi. Xin trân trọng cảm ơn bạn!</p>\n\n<table cellpadding=\"0\" cellspacing=\"0\">\n	<tbody>\n		<tr>\n			<td>Cập nhật:&nbsp;29/09/2017 - 17:02</td>\n			<td>Tình trạng:&nbsp;Mới</td>\n		</tr>\n		<tr>\n			<td>Bảo hành:&nbsp;12 Tháng</td>\n			<td>Nguồn gốc:&nbsp;Chính hãng</td>\n		</tr>\n		<tr>\n			<td>Hãng sản xuất</td>\n			<td><a href=\"http://dienchaua.com/s/mitsubishi\">Mitsubishi</a></td>\n		</tr>\n		<tr>\n			<td>Số pha</td>\n			<td><a href=\"http://dienchaua.com/s/1+pha\">1 pha</a></td>\n		</tr>\n		<tr>\n			<td>Dòng điện định mức (A)</td>\n			<td>6</td>\n		</tr>\n		<tr>\n			<td>Điện áp định mức (V)</td>\n			<td>230V</td>\n		</tr>\n		<tr>\n			<td>Xuất xứ</td>\n			<td>Đang cập nhật</td>\n		</tr>\n	</tbody>\n</table>\n',0),
	(5,5,'NF63-CV-3P 20A','Aptomat MCCB Mitsubishi','aptomat-mccb-mitsubishi','','','Mitsubishi',0,0,660000,55000,0,'<p>Thông số kĩ thuật trên Vatgia.com chỉ mang tính tham khảo, thông số có thể thay đổi mà không báo trước.<br />\nNếu bạn phát hiện thông số sai xin hãy&nbsp;<a href=\"javascript:;\" onclick=\"windowPrompt({ width: 600, height: 400, href: con_ajax_path + \'load_send_error_product.php?v=3&amp;record_id=3852064\', iframe: true });\" rel=\"nofollow\" title=\"Báo lỗi thông số kỹ thuật, ảnh sản phẩm\">Click vào đây</a>&nbsp;để thông báo cho chúng tôi. Xin trân trọng cảm ơn bạn!</p>\n\n<table cellpadding=\"0\" cellspacing=\"0\">\n	<tbody>\n		<tr>\n			<td>Cập nhật:&nbsp;29/09/2017 - 17:01</td>\n			<td>Tình trạng:&nbsp;Mới</td>\n		</tr>\n		<tr>\n			<td>Bảo hành:&nbsp;12 Tháng</td>\n			<td>Nguồn gốc:&nbsp;Chính hãng</td>\n		</tr>\n		<tr>\n			<td>Hãng sản xuất</td>\n			<td><a href=\"http://dienchaua.com/s/mitsubishi\">Mitsubishi</a></td>\n		</tr>\n		<tr>\n			<td>Số pha</td>\n			<td><a href=\"http://dienchaua.com/s/3+pha\">3 pha</a></td>\n		</tr>\n		<tr>\n			<td>Số cực</td>\n			<td><a href=\"http://dienchaua.com/s/ba+c%E1%BB%B1c\">Ba cực</a></td>\n		</tr>\n		<tr>\n			<td>Dòng điện định mức (A)</td>\n			<td>20</td>\n		</tr>\n		<tr>\n			<td>Điện áp định mức (V)</td>\n			<td>240</td>\n		</tr>\n		<tr>\n			<td>Công suất định mức (Kw)</td>\n			<td>240</td>\n		</tr>\n		<tr>\n			<td>Dòng cắt (kA)</td>\n			<td>5</td>\n		</tr>\n		<tr>\n			<td>Xuất xứ</td>\n			<td>Nhật Bản</td>\n		</tr>\n	</tbody>\n</table>\n',0),
	(6,6,'CV-250','Cáp CADIVI','cap-cadivi','','','',0,0,352000,0,0,'<p>Thông số kĩ thuật trên Vatgia.com chỉ mang tính tham khảo, thông số có thể thay đổi mà không báo trước.<br />\nNếu bạn phát hiện thông số sai xin hãy&nbsp;<a href=\"javascript:;\" onclick=\"windowPrompt({ width: 600, height: 400, href: con_ajax_path + \'load_send_error_product.php?v=3&amp;record_id=339972\', iframe: true });\" rel=\"nofollow\" title=\"Báo lỗi thông số kỹ thuật, ảnh sản phẩm\">Click vào đây</a>&nbsp;để thông báo cho chúng tôi. Xin trân trọng cảm ơn bạn!</p>\n\n<table cellpadding=\"0\" cellspacing=\"0\">\n	<tbody>\n		<tr>\n			<td>Cập nhật:&nbsp;29/09/2017 - 17:02</td>\n			<td>Tình trạng:&nbsp;Mới</td>\n		</tr>\n		<tr>\n			<td>Bảo hành:&nbsp;Không có</td>\n			<td>Nguồn gốc:&nbsp;Chính hãng</td>\n		</tr>\n		<tr>\n			<td>Hãng sản xuất</td>\n			<td><a href=\"http://dienchaua.com/s/cadivi\">Cadivi</a></td>\n		</tr>\n		<tr>\n			<td>Loại cáp</td>\n			<td><a href=\"http://dienchaua.com/s/c%C3%A1p+%C4%91%E1%BB%93ng+tr%E1%BB%A5c+cao+t%E1%BA%A7n\">Cáp đồng trục cao tần</a></td>\n		</tr>\n	</tbody>\n</table>\n',0);

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
	(1,'san-pham-c1',1,NULL,'2017-10-07 10:01:42','admin',NULL,'','active',0),
	(2,'tin-tuc-c2',2,NULL,'2017-10-07 10:01:42','admin',NULL,'','active',0),
	(3,'den-melos-DCN001-p1',10,1,'2017-10-07 10:04:58','admin',NULL,'','active',0),
	(4,'den-highbay-HB485-p2',10,2,'2017-10-07 10:05:51','admin',NULL,'','active',0),
	(5,'den-highbay-HB520-p3',10,3,'2017-10-07 10:06:41','admin',NULL,'','active',0),
	(6,'cau-dao-tu-dong-mcb-mitsubishi-BH-D6 1P 6A-p4',12,4,'2017-10-07 10:22:30','admin',NULL,'','active',0),
	(7,'aptomat-mccb-mitsubishi-NF63-CV-3P 20A-p5',12,5,'2017-10-07 10:23:55','admin',NULL,'','active',0),
	(8,'cap-cadivi-CV-250-p6',4,6,'2017-10-07 10:26:01','admin',NULL,'','active',0);

/*!40000 ALTER TABLE `url_route` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

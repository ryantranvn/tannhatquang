# Captcha
	DROP TABLE IF EXISTS `captcha`;

	CREATE TABLE `captcha` (
	  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
	  `security_code` varchar(255) NOT NULL,
	  `captcha_time` int(10) unsigned NOT NULL,
	  `ip_address` varchar(16) NOT NULL DEFAULT '0',
	  `word` varchar(20) NOT NULL,
	  PRIMARY KEY (`captcha_id`),
	  KEY `word` (`word`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

	TRUNCATE captcha;

# Category
	CREATE TABLE `category` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(512) NOT NULL,
	  `url` varchar(1024) DEFAULT NULL,
	  `thumbnail` varchar(255) DEFAULT NULL,
	  `desc` varchar(2048) DEFAULT NULL,
	  `order` int(11) NOT NULL DEFAULT '0',
	  `parent_id` tinyint(1) NOT NULL,
	  `path` varchar(255) NOT NULL,
	  `created_datetime` datetime DEFAULT NULL,
	  `modified_datetime` datetime DEFAULT NULL,
	  `created_by` varchar(255) DEFAULT NULL,
	  `modified_by` varchar(255) DEFAULT NULL,
	  `status` varchar(255) NOT NULL DEFAULT 'active',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

	LOCK TABLES `category` WRITE;

	TRUNCATE category;

	INSERT INTO category (`name`,`url`,`desc`,`parent_id`,`path`,`created_datetime`, `created_by`) VALUES
	('default', 'default', 'default', '0', '0-1-', '2014-12-25 0:0:01', 'admin'),
	('product', 'product', 'product', '0', '0-2-', '2014-12-25 0:0:01', 'admin'),
	('news', 'news', 'news', '0', '0-3-', '2014-12-25 0:0:01', 'admin');

# Member for customer
	DROP TABLE IF EXISTS `member`;

	CREATE TABLE `member` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `username` varchar(255) NOT NULL,
	  `password` varchar(255) NOT NULL DEFAULT '56136fc330019e0e526cfbe08f940fa08610be81',
	  `thumbnail` varchar(255) DEFAULT NULL,
	  `status` varchar(255) NOT NULL DEFAULT '1',
	  `created_datetime` datetime DEFAULT NULL,
	  `modified_datetime` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `username` (`username`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

	LOCK TABLES `member` WRITE;

	TRUNCATE member;

	INSERT INTO member (`id`, `username`, `password`, `status`, `created_datetime`) VALUES
    (1, 'admin', 'e8e5d2936cf84860ef65dc3281ea42e907fad148', 'active', '2014-12-25 0:0:01');

    #pass : *123#

# Module
	DROP TABLE IF EXISTS `module`;

	CREATE TABLE `module` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(255) DEFAULT NULL,
	  `url` varchar(255) DEFAULT NULL,
	  `desc` varchar(512) DEFAULT NULL,
	  `icon` varchar(255) DEFAULT NULL,
	  `active` tinyint(4) DEFAULT '1',
	  `order` int(11) DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	LOCK TABLES `module` WRITE;

	TRUNCATE module;

	INSERT INTO module (`id`, `name`, `url`, `desc`, `icon`, `active`) VALUES
	(1, 'Dashboard', 'dashboard', 'dashboard', 'fa fa-lg fa-fw fa-home', 1),
	(2, 'Category', 'category', 'category', 'fa fa-lg fa-fw fa-list', 1),
	(3, 'Member', 'member', 'member', 'fa fa-lg fa-fw fa-user', 1),
	(4, 'Module', 'module', 'module', 'fa fa-lg fa-fw fa-cubes', 1),
	(5, 'Setting', 'setting', 'setting', 'fa fa-lg fa-fw fa-gears', 1),
	(6, 'User', 'user', 'Manage users', 'fa fa-group', 1);

	UNLOCK TABLES;

# Member Permission
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

	TRUNCATE member_permission;

	INSERT INTO member_permission (`id_member`,`id_module`,`id_permission`,`active`) VALUES
    (1,1,1,1), (1,1,2,1), (1,1,3,1), (1,1,4,1),
    (1,2,1,1), (1,2,2,1), (1,2,3,1), (1,2,4,1),
    (1,3,1,1), (1,3,2,1), (1,3,3,1), (1,3,4,1),
    (1,4,1,1), (1,4,2,1), (1,4,3,1), (1,4,4,1),
    (1,5,1,1), (1,5,2,1), (1,5,3,1), (1,5,4,1),
	(1,6,1,1), (1,6,2,1), (1,6,3,1), (1,6,4,1);

# Permission
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

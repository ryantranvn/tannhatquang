truncate `category`;
truncate `post`;
truncate `product`;
truncate `news`;
truncate `customer`;
truncate `order`;
truncate `order_detail`;
truncate `url_route`;
truncate `post_picture`;
truncate `manufacturer`;
INSERT INTO `category` (`id`, `name`, `url`, `thumbnail`, `desc`, `order`, `parent_id`, `path`, `created_datetime`, `updated_datetime`, `created_by`, `updated_by`, `status`)
VALUES
	(1,'Product','product','','Manage product',0,0,'0-1-','2017-08-07 23:44:13',NULL,'admin',NULL,'active'),
	(2,'News','news','','Manage news',0,0,'0-2-','2017-08-07 23:44:42',NULL,'admin',NULL,'active');
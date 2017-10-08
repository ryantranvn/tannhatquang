truncate table `url_route`;
insert into `url_route`
(`url`, `category_id`, `created_by`) values
('san-pham-c1', '1', 'admin'),
('tin-tuc-c2', '2', 'admin');
truncate table `category`;
insert into `category`  values
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


truncate table `post`;
truncate table `post_picture`;
truncate table `product`;
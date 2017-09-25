truncate table `url_route`;
insert into `url_route`
(`url`, `category_id`, `created_by`) values
('san-pham-c1', '1', 'admin'),
('tin-tuc-c2', '2', 'admin');
truncate table `category`;
insert into `category`
(`name`, 		`url`, 			`parent_id`, 	`path`, 	`created_by`) values
('Sản phẩm', 	'san-pham', 	'0', 			'0-1-', 	'admin'),
('Tin tức', 	'tin-tuc', 		'0', 			'0-2-', 	'admin');

truncate table `post`;
truncate table `product`;
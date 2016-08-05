# Captcha
	TRUNCATE captcha;

# Category
	TRUNCATE category;
	INSERT INTO category (`name`,`url`,`desc`,`parent_id`,`path`) 
	VALUES ('default','default','default','0','0-1-');


# Member for customer
	TRUNCATE member;
	INSERT INTO member (`id`, `username`, `password`, `status`, `created_datetime`) VALUES 
    (1, 'admin', 'e8e5d2936cf84860ef65dc3281ea42e907fad148', 'active', '2014-12-25 0:0:01');

    #pass : *123#

# Module
	TRUNCATE module;
	INSERT INTO module (`id`, `name`, `url`, `desc`, `icon`, `active`)
	VALUES
	(1, 'Dashboard', 'dashboard', 'dashboard', 'fa fa-lg fa-fw fa-home', 1),
	(2, 'Category', 'category', 'category', 'fa fa-lg fa-fw fa-list', 1),
	(3, 'Member', 'member', 'member', 'fa fa-lg fa-fw fa-user', 1),
	(4, 'Module', 'module', 'module', 'fa fa-lg fa-fw fa-cubes', 1),
	(5, 'Setting', 'setting', 'setting', 'fa fa-lg fa-fw fa-gears', 1);
    
# Member Permission
	TRUNCATE member_permission;
	INSERT INTO member_permission (`id_member`,`id_module`,`id_permission`,`active`) VALUES 
    (1,1,1,1), (1,1,2,1), (1,1,3,1), (1,1,4,1),
    (1,2,1,1), (1,2,2,1), (1,2,3,1), (1,2,4,1),
    (1,3,1,1), (1,3,2,1), (1,3,3,1), (1,3,4,1),
    (1,4,1,1), (1,4,2,1), (1,4,3,1), (1,4,4,1),
    (1,5,1,1), (1,5,2,1), (1,5,3,1), (1,5,4,1);

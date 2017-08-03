<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// is testing ?
    if (ENVIRONMENT == 'understruction') {
    	$route['default_controller'] = "frontend/maintain";
        $route['(:any)'] = "frontend/maintain";
    }
    else {
		$route['default_controller'] = 'frontend/Home';
    }

/* FRONTEND */
    $route['bang-gia'] = 'frontend/Home/banggia';
    $route['lien-he'] = 'frontend/Home/lienhe';
	$route['gioi-thieu'] = 'frontend/Home/gioithieu';

    $route['tin-tuc'] = 'frontend/Home/tintuc';

    $route['san-pham/chi-tiet'] = 'frontend/Home/sanpham_chitiet';
    $route['san-pham'] = 'frontend/Home/sanpham';

    $route['gio-hang'] = 'frontend/Home/giohang';


// 404
    $route['404'] = 'frontend/maintain/page404';
    $route['backend/404'] = 'backend/maintain/page404';

/* ALL DASHBOARD */
    $route['backend/product-category/delete/(:num)'] 	= "backend/category/delete/$1";

	$route['backend/(:any)/ajax_status'] 	= "backend/$1/ajax_status";
	$route['backend/(:any)/multi_delete'] 	= "backend/$1/multi_delete";
	$route['backend/(:any)/edit/(:num)'] 	= "backend/$1/edit/$2";
	$route['backend/(:any)/delete/(:num)'] 	= "backend/$1/delete/$2";
	$route['backend/(:any)/(:any)'] 	= "backend/$1/$2";
	$route['backend/(:any)'] 	= "backend/$1";
	$route['backend'] = "backend/dashboard";



$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

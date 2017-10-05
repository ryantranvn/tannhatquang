<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// is testing ?
    if (ENVIRONMENT == 'commingsoon' || ENVIRONMENT == 'understruction') {
        $route['default_controller'] = "frontend/Maintain";
        $route['(:any)'] = "frontend/Maintain";
    }
    else {
		$route['default_controller'] = 'frontend/Home';
    }
/* BACKEND */
    $route['backend/product-category/delete/(:num)'] 	= "backend/category/delete/$1";

    $route['backend/(:any)/ajax_status'] 	= "backend/$1/ajax_status";
    $route['backend/(:any)/multi_delete'] 	= "backend/$1/multi_delete";
    $route['backend/(:any)/edit/(:num)'] 	= "backend/$1/edit/$2";
    $route['backend/(:any)/delete/(:num)'] 	= "backend/$1/delete/$2";
    $route['backend/(:any)/(:any)'] 	= "backend/$1/$2";
    $route['backend/(:any)'] 	= "backend/$1";
    $route['backend'] = "backend/dashboard";
/* FRONTEND */
    $route['get_product_categories'] = 'frontend/Product/ajax_product_categroies';

    $route['bang-gia'] = 'frontend/Home/banggia';
    $route['lien-he'] = 'frontend/Home/lienhe';
	$route['gioi-thieu'] = 'frontend/Home/gioithieu';

    $route['tin-tuc'] = 'frontend/News';
    $route['tin-tuc/page/(:num)'] = 'frontend/News';

    $route['(:any)'] = 'frontend/Product';
    /*
    $route['san-pham/chi-tiet'] = 'frontend/Home/sanpham_chitiet';
    $route['san-pham/(:any)'] = 'frontend/Home/sanpham';
    $route['gio-hang'] = 'frontend/Home/giohang';
    */



	$maintain_uri = explode('/', $_SERVER['REQUEST_URI']);
    if ($maintain_uri[1]=='backend') {
        $route['404_override'] = "";
    }
    else {
        $route['404_override'] = 'Maintain';
    }

$route['translate_uri_dashes'] = TRUE;

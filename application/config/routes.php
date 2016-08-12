<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* FRONTEND */

	$route['vn/ajax_gallery'] = 'frontend/Gallery/ajax_gallery';
	$route['en/gallery/(:any)'] = 'frontend/Gallery';
	$route['vn/thu-vien/(:any)'] = 'frontend/Gallery';
	$route['en/gallery'] = 'frontend/Gallery';
	$route['vn/thu-vien'] = 'frontend/Gallery';

	$route['en/news/(:any)'] = 'frontend/News/detail';
	$route['vn/tin-tuc/(:any)'] = 'frontend/News/detail';
	$route['en/news'] = 'frontend/News';
	$route['vn/tin-tuc'] = 'frontend/News';

	$route['vn/ajax_get_user'] = 'frontend/Home/ajax_get_user';

	$route['vn/booking/ajax_submitBooking'] = 'frontend/Booking/ajax_submitBooking';
	$route['vn/contact/ajax_submitContactPage'] = 'frontend/Contact/ajax_submitContactPage';
	$route['vn/contact/ajax_submitContactBox'] = 'frontend/Contact/ajax_submitContactBox';

	$route['booking/submit'] = 'frontend/Booking/submit';
	$route['vn/booking/ajax_upload'] = 'frontend/Booking/ajax_upload';
	$route['vn/dat-hen-tu-van'] = 'frontend/Booking';
	$route['en/booking'] = 'frontend/Booking';

	$route['vn/dich-vu/(:any)'] = 'frontend/Service';
	$route['en/service/(:any)'] = 'frontend/Service';
	$route['vn/dich-vu'] = 'frontend/Service';
	$route['en/service'] = 'frontend/Service';

	$route['vn/lien-he'] = 'frontend/Contact';
	$route['en/contact'] = 'frontend/Contact';

	$route['switch_lang/(:any)'] = 'Languageswitcher/switch_lang/$1';

	$route['en'] = 'frontend/Home';
	$route['vn'] = 'frontend/Home';
// 404
    $route['404'] = 'frontend/maintain/page404';
    $route['backend/404'] = 'backend/maintain/page404';

/* ALL DASHBOARD */
	$route['backend/(:any)/ajax_status'] 	= "backend/$1/ajax_status";
	$route['backend/(:any)/multi_delete'] 	= "backend/$1/multi_delete";
	$route['backend/(:any)/edit/(:num)'] 	= "backend/$1/edit/$2";
	$route['backend/(:any)/delete/(:num)'] 	= "backend/$1/delete/$2";
	$route['backend/(:any)/(:any)'] 	= "backend/$1/$2";
	$route['backend/(:any)'] 	= "backend/$1";
	$route['backend'] = "backend/dashboard";

// is testing ?
    if (ENVIRONMENT == 'understruction') {
    	$route['default_controller'] = "frontend/maintain";
        $route['(:any)'] = "frontend/maintain";
    }
    else {
		$route['default_controller'] = 'frontend/Home';
    }


    
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

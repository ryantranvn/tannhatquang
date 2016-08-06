<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* FRONTEND */
	$route['news/(:any)'] = 'frontend/News/detail';
	$route['tin-tuc/(:any)'] = 'frontend/News/detail';
	$route['news'] = 'frontend/News';
	$route['tin-tuc'] = 'frontend/News';

	$route['ajax_get_user'] = 'frontend/Home/ajax_get_user';

	$route['booking/ajax_submitBooking'] = 'frontend/Booking/ajax_submitBooking';
	$route['contact/ajax_submitContactPage'] = 'frontend/Contact/ajax_submitContactPage';
	$route['contact/ajax_submitContactBox'] = 'frontend/Contact/ajax_submitContactBox';

	$route['booking/submit'] = 'frontend/Booking/submit';
	$route['booking/ajax_upload'] = 'frontend/Booking/ajax_upload';
	$route['dat-hen-tu-van'] = 'frontend/Booking';
	$route['booking'] = 'frontend/Booking';

	$route['dich-vu/(:any)'] = 'frontend/Service';
	$route['service/(:any)'] = 'frontend/Service';
	$route['dich-vu'] = 'frontend/Service';
	$route['service'] = 'frontend/Service';

	$route['lien-he'] = 'frontend/Contact';
	$route['contact'] = 'frontend/Contact';

	$route['switch_lang/(:any)'] = 'Languageswitcher/switch_lang/$1';
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

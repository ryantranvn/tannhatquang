<?php
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
	// understruction
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		ini_set('memory_limit', '-1');
		break;
	case 'commingsoon':
		break;
	case 'understruction':
		break;
	case 'testing':
		break;
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}
$whitelist = array(
    '127.0.0.1',
    '::1'
);
// set ONAIR to add GA
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	define('ONAIR', 1);
}
else {
   	define('ONAIR', 0);
}
/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * For more info please see the user guide:
 *
 * https://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to it here. The directory can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application directory.
 * If you do move this, use an absolute (full) server path.
 *
 * NO TRAILING SLASH!
 */
	$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here. For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller. Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 */
	// The directory name, relative to the "controllers" directory.  Leave blank
	// if your controller is not in a sub-directory within the "controllers" one
	// $routing['directory'] = '';

	// The controller class file name.  Example:  mycontroller
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (($_temp = realpath($system_path)) !== FALSE)
	{
		$system_path = $_temp.DIRECTORY_SEPARATOR;
	}
	else
	{
		// Ensure there's a trailing slash
		$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
	}

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system directory
	define('BASEPATH', $system_path);

	// Path to the front controller (this file) directory
	define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

	// Name of the "system" directory
	define('SYSDIR', basename(BASEPATH));

	// The path to the "application" directory
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}
		else
		{
			$application_folder = strtr(
				rtrim($application_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
	{
		$application_folder = BASEPATH.strtr(
			trim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

	// The path to the "views" directory
	if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.'views';
	}
	elseif (is_dir($view_folder))
	{
		if (($_temp = realpath($view_folder)) !== FALSE)
		{
			$view_folder = $_temp;
		}
		else
		{
			$view_folder = strtr(
				rtrim($view_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.strtr(
			trim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

/* --------------------------------------------------------------------
 * --------------------------------------------------------------------
 * *******************    MY CONFIGs
 * --------------------------------------------------------------------
 * --------------------------------------------------------------------
 */
	define('CACHE', FALSE);
	define('ENCRYPTION_KEY', 'Ifv3tiG2w6UyDrhB8TB29PHgGtiB3K7g');

	// set PATH_URL
    if ( isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ) {
        define('F_URL', "https://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
    }
    else {
        define('F_URL',"http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
    }
    define('B_URL', F_URL.'backend/');
    // define('M_URL', F_URL.'mobile/');
	define('ASSETS_URL', F_URL.'assets/');
	define('LIB_URL', F_URL.'library/');

    // project name
    define("PROJECT_FOLDER","tannhatquang");
    define("PAGE_NAME", "tannhatquang");
    define("PAGE_TITLE", "Tân Nhật Quang");
    define("LOGO_URL", F_URL."assets/frontend/images/logo.png");
	define("IMG_ALT", PAGE_TITLE);

    // valid email
    // define('EMAIL_DOMAIN', '@prudential.com.vn');

    //define('OFF', date("2016-11-30 23:59:59"));
    // define('OFF', date("2016-11-27 10:29:39"));
// DATABASE
    // haveDB ?
    	define('HAVE_DB', TRUE);
    	define('DEBUG_DB', TRUE);
    // local
	    define('DB_HOST', 'localhost');
	    define('DB_PREFIX', '');

	    define('DB_NAME', 'tannhatquang_DB');
	    define('DB_USER', 'root');
	    define('DB_PASS', 'root');
    // online
	     //define('DB_NAME', 'tane66c4_db');
	     //define('DB_USER', 'tane66c4');
	     //define('DB_PASS', 'c8436eebA@!');

// set local time
    date_default_timezone_set('Asia/Ho_Chi_Minh');

// EMAIL
    define('MAIL_SERVER', '');
    define('EMAIL', '');
    define('EMAILPASS', '');
    define('ATTACH_FOLDER', '');
// PUSHER

// FILE
    // define('MAXUPLOAD', 10);
    // define('THUMB_SIZE', 1024);     define('THUMB_WIDTH', 1024);        define('THUMB_HEIGHT', 1024);
    // define('IMG_SIZE', 5120);       define('IMG_WIDTH', 4000);          define('IMG_HEIGHT', 4000);
    // define('IMG_MAX_WIDTH', 4000);          define('IMG_MAX_HEIGHT', 4000);
    // define('IMG_MIN_WIDTH', 300);          define('IMG_MIN_HEIGHT', 300);
    // define('VIDEO_SIZE', 112400);
    // define('DOCUMENT_SIZE', 2048);
    // $picture_extensions = array("image/gif", "image/jpeg", "image/pjpeg", "image/pjpeg", "image/png");
    // $video_extensions = array('video/mp4','video/ogg','video/x-flv');
    // $video_extensions = array('video/quicktime','video/mp4','video/mpeg','video/ogg','video/x-ms-wmv','video/x-msvideo','video/x-flv');
    // $document_extensions = array('application/msword','application/pdf');


// FACEBOOK
    /* https://www.facebook.com/dialog/pagetab?app_id=appID&redirect_uri=URL */
	/*
	define('FBAPP_ID', '');
    define('FBAPP_SECRET', '');
    define('FANPAGE_ID', '');
    define('FBSCOPE', "email,public_profile,user_likes");
    $fb_scope = array("email", "public_profile", "user_likes");
    define('FB_REDIRECT_URL', '');
    */
// GOOGLE
	// define('GAPP_CLIENT_ID', '');
	// define('GAPP_SECRET', '');
	// define('GAPP_REDIRECT_URI', F_URL);
	// define('GAPP_API_KEY', '');

define('MAX_NUMBER_ITEM_CART', 9999);
define('NOTE_PRICE_NEED_CONTACT', '*** Với các sản phẩm có giá bằng 0 VND, vui lòng liên hệ để biết giá chính xác.');

define('NO_IMG', ASSETS_URL . 'frontend/images/light.png');

define('PREFIX_CODE_CAT', '-c');
define('PREFIX_CODE_PRODUCT', '-p');

define('TYPE_POST_PRODUCT', 'product');
define('TYPE_POST_NEWS', 'news');

define('PAGING_NUMBER_NOWS', 3);
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';

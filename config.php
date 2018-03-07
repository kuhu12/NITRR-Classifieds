<?php
defined('_KUHUG') or die('Restricted Access.');

// to overwrite php.ini file
ini_set('display_errors', 1);

// Set TimeZone
date_default_timezone_set('Asia/Kolkata');

// Site settings
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__FILE__).DS);
define('SITE_URL', 'http://localhost/projects/php/personal/nitrr_classifieds/');
define('SITE_NAME', 'NIT RR Classifieds');

// Database settings 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'nit_rr_classifieds_prod');
define('DB_PREFIX', 'jzedf_');
define('DB_DATETIME_FRMT', 'Y-m-d H:i:s');
define('DB_DATE_FRMT', 'Y-m-d');
define('DB_DATE_DSPLY_FRMT', 'd M, Y');

// UI path settings
define('JS_PATH_LIB', 'js/libraries/');
define('JS_PATH_CUSTOM', 'js/customs/');
define('PATH_CSS', 'css/');
define('IMG_DIR_URL', SITE_URL.'img/');

// Developer settings
define('VIEW_FTYPE', '.php');
define('VIEWS', BASE_PATH.'views'.DS);
define('CONTROLLERS', BASE_PATH.'controllers'.DS);
define('SECRET_KEY', '**********'); 
define('EMAIL_TEMPLATE', 'emailBody');

// Email settings
define('FROM_EMAIL', 'kuhu.gupta08@gmail.com');
define('FROM_NAME', 'NIT RR Classifieds');
$noitifcation_recipient = 'nitrrclassifieds@gmail.com';
$bcc_recipients = array();

// Essential Variables
$gender = array(1=>'Male', 2=>'Female', 3=>'Other');
$registered_user_group_id = 2;
$booleanChoice = array(1=>'Yes', 0=>'No');
$safeTextRegEx = '/[^A-Za-z0-9 +-.&()*,]/';

// Session Settings
define('SESSION_LIFE', 20); // in minutes

  
?>

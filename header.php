<?php 
defined('_KUHUG') or die('Restricted Access.');

$view = 'dashboard'; $pageTitle = 'Home'; 
$error = 0; $errorMsg = ''; $success = 0; $successMsg = ''; $bodyElements = ''; $innerLayout = 0;
$verification_views = ['login', 'registration', 'forgotpassword', 'resetpassword', '404', 'profile', 'submitad']; 

$live_css = []; $live_js = []; $lib_js = [];
$css = ['common.css'];
$custom_js = ['commonValidations.js']; 

if(isset($_REQUEST['view'])) {
	$req_view = getSafeString($_REQUEST['view']); 
	switch($req_view) {
		case 'login' : $view = $req_view; $pageTitle = 'Login'; $custom_js[] = 'login.js';
		break;
		case 'registration' : $view = $req_view; $pageTitle = 'Registration'; $custom_js[] = 'registration.js';
		break;
		case 'forgotpassword' : $view = $req_view; $pageTitle = 'Forgot Password'; $custom_js[] = 'forgotpassword.js';
		break;
		case 'resetpassword' : $view = $req_view; $pageTitle = 'Reset Password'; $custom_js[] = 'resetpassword.js';
		break;
		case 'profile' : $view = $req_view; $pageTitle = 'My Profile'; $custom_js[] = 'profile.js';
		break;
		case 'submitad' : $view = $req_view; $pageTitle = 'Submit New Ad'; $custom_js[] = 'submitad.js';
		break;
		
		case 'team' : $view = $req_view; $pageTitle = 'Who We Are'; break;
		case 'termsservice' : $view = $req_view; $pageTitle = 'Terms & Service'; break;
		case 'myads' : $view = $req_view; $pageTitle = 'My Ads'; break;
		case 'viewads' : $view = $req_view; $pageTitle = 'View Ads'; break;
		
		default : $view = '404';
	}
}

$view = (file_exists(VIEWS.$view.VIEW_FTYPE))? $view:'404';
$pageTitle = ($view == '404')? 'Page not found':$pageTitle;	

if(in_array($view, $verification_views)) { 
	$css[] = 'demo.css'; $css[] = 'forms.css'; $bodyClass = ' bg-multi-color';
}
else {
	$innerLayout = 1; $bodyClass = ''; $bodyElements .= 'data-spy="scroll"'; 
	$live_css[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css';
	$css = array_merge($css, array('preloader.css', 'style.css', 'responsive.css', 'animate.css', 'simple-line-icons.css'));
	
	$live_js[] = 'http://code.jquery.com/jquery-latest.min.js';
	$live_js[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js';
	
	$lib_js = array_merge($lib_js, array('jquery.nicescroll.min.js', 'jquery.jribbble-1.0.1.ugly.js', 'drifolio.js', 'wow.min.js'));
}
	
if($view != '404') { require_once(CONTROLLERS.$view.VIEW_FTYPE); }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php echo $pageTitle.' - '.SITE_NAME; ?></title>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<?php 
			if(count($live_css) > 0) { 
				foreach($live_css as $cv) { ?>
					<link rel="stylesheet" href="<?php echo $cv;?>">
				<?php }
			}
			if(count($css) > 0) { 
				foreach($css as $ck => $cv) { ?>
					<link rel="stylesheet" href="<?php echo SITE_URL.PATH_CSS.$cv;?>">
				<?php }
			}
		?>
		<link rel="icon" href="<?php echo IMG_DIR_URL; ?>favicon.png">
		<?php if($innerLayout) { ?>  
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Antic|Raleway:300">
		<?php } ?>
	</head>
	<body class="<?php echo $view.$bodyClass; ?>" <?php echo $bodyElements;?>>
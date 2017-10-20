<?php 
defined('_KUHUG') or die('Restricted Access.');

session_start();
is_logged_in();
$user_id = $_SESSION['user_info']['user_id'];

$db = connectMySQL();

$categories = getAD_Categories($db); 
$all_category = $categories[2];

$myAds = getMyAds($db, $user_id);
?>
<?php 
defined('_KUHUG') or die('Restricted Access.');

session_start();
is_logged_in();
$user_id = $_SESSION['user_info']['user_id'];

$db = connectMySQL();

$categories = getAD_Categories($db); 
$parent_category=$categories[0];
$child_category=$categories[1];
$all_category=$categories[2];

function getAddDetails_Email($data) {
	global $all_category, $booleanChoice,$safeTextRegEx;
	
	$emailbody = getEmailParagraph(getEmailBoldText('Ad Details :'));
	$para = array();
	$para[] = 'Title : '.getEmailBoldText(getSafeString($data['adtitle'], $safeTextRegEx));
	$para[] = 'Category :'.getEmailBoldText($all_category[$data['category']]);
	$para[] = 'Description : '.getEmailBoldText(getSafeString($data['addescription'], $safeTextRegEx));
	$para[] = ($data['price']!='')? 'Price :'.getEmailBoldText($data['price']):'';
	$para[] = 'Negotiable :'.getEmailBoldText($booleanChoice[$data['negotiable']]);
	$emailbody .= getEmailParagraph(implode('<br />', $para));

return $emailbody;	
}

function sendSubmitAdNotificationToUser($data, $ad_id=0) {
	$subject = 'Acknowledgement for your Ad submission';
	$user_email = strtolower($_SESSION['user_info']['user_email']);
	$first_name = $_SESSION['user_info']['user_fname']; $last_name = $_SESSION['user_info']['user_lname'];
	
	$emailbody = getEmailBodyHeader(ucwords($subject));
	$emailbody .= getEmailParagraph('Hello '.$first_name.',');
	$emailbody .= getEmailParagraph('Thank you for submitting your ad at '.SITE_NAME.'. Your Ad is under verification process and it will be published soon.');
	$emailbody .= getAddDetails_Email($data);
	$emailbody .= getEmailBodyFooter();
	
	_sendEMail($user_email, $subject, array(), $emailbody);
}
function sendSubmitAdNotificationToAdministrators($data, $ad_id=0){
	global $noitifcation_recipient, $bcc_recipients;
	
	$roll_no = $_SESSION['user_info']['user_rollno'];
	$first_name = $_SESSION['user_info']['user_fname']; $last_name = $_SESSION['user_info']['user_lname'];
	
	$subject = $first_name.' '.$last_name.' ('.$roll_no.') - ';
	$subject .= ($ad_id > 0)? 'Updated':'New';
	$subject .= ' Ad Submission';
	
	$emailbody = getEmailBodyHeader(ucwords($subject));
	$emailbody .= getEmailParagraph('Hello,');
	$emailbody .= getEmailParagraph(' A registered User has submitted an Ad.');
	$emailbody .= getAddDetails_Email($data);
	$emailbody .= getEmailBodyFooter();
	
	_sendEMail($noitifcation_recipient, $subject, $bcc_recipients, $emailbody);
}

function PostDataValidation_submitad($data){
	global $all_category;
	$error=0;$errorMsg='';
	
$adtitle_length = strlen($data['adtitle']);
if(filter_var($adtitle_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>15 , 'max_range'=>100))) === false) { 
		return array(1, ' Enter the Ad Title in 15 to 100 characters.You can use only these special characters(+ - & * () , .) ');
	}
if(empty($data['category'])){
    return array(1,"Select your Ad category.");   
}

if(!array_key_exists($data['category'], $all_category)) {
	return array(1,"Please select ad category from list.");
}
$addes_length = strlen($data['addescription']);
if(filter_var($addes_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>50, 'max_range'=>200))) === false) { 
		return array(1, ' Enter the Ad Description in 50 to 200 characters . You can use only these special characters(+ - & * () , .)');
	}
if($data['price'] !='' && (filter_var($data['price'], FILTER_VALIDATE_INT, array('options'=>array('min_range'=>1 , 'max_range'=>500000))) === false)) { 
		return array(1, ' Entered price is not valid.Please enter valid price.The price may range from Rs. 1 to Rs.500000.');
	}


return array($error, $errorMsg);
}

if(isset($_POST['task'])) {	
	$task=trim($_POST['task']);
	if(decode($task) == 'doSubmitAd')
	{
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_submitad($data);
		if($val_res[0] == 1){
			$error=$val_res[0]; $errorMsg=$val_res[1];
		}
		else{
			$ad_id = 0;
			if(isset($data['sdg'])) {
				if($data['sdg'] !='') {
					$ad_id = decode($data['sdg']);
					$ad_id = (filter_var($ad_id, FILTER_VALIDATE_INT))? $ad_id:0;
				}
			}
			
			if($ad_id > 0) {
				if(!updateDataIntoSubmitAd($db, $ad_id, $data, $user_id, $user_id)) { 
					$error = 1;
				}
			}			
			else {
				if(!insertDataIntoSubmitAd($db, $data, $user_id, $user_id)) { 
					$error = 1;
				}
			}
			
			if(!$error) {
				setEmailTemplateEnv();
				sendSubmitAdNotificationToUser($data, $ad_id);
				sendSubmitAdNotificationToAdministrators($data, $ad_id);
				$success = 1; $successMsg = ($ad_id > 0)? 'You have successfully updated your Ad.':'You have successfully submitted your Ad.';
				$successMsg .= 'Your Ad will be activated within 24 hours.';
			}
			else {
				$error = 1; $errorMsg = 'Your request for Ad submission could not be processed. Please try again.';
			}
		}

	}
}

$Ad_title=''; $Ad_category=0; $Ad_description=''; $Ad_price=''; $Ad_negotiable=''; $Ad_published=''; $adID = 0;

if(isset($_REQUEST['sdg'])) {
	if($_REQUEST['sdg'] !='') {
		$adID = decode($_REQUEST['sdg']);
		if(filter_var($adID, FILTER_VALIDATE_INT)) {
			$Ad_result = getAdData($db, $adID, $user_id);
			if($Ad_result->num_rows > 0) {
				$row_obj = $Ad_result->fetch_object();
				$Ad_title=$row_obj->ad_title; 
				$Ad_category=$row_obj->category_id; 
				$Ad_description=$row_obj->ad_description; 
				$Ad_price=$row_obj->price; 
				$Ad_negotiable=$row_obj->negotiable; 
				$Ad_published=$row_obj->published; 
			}
		}
		else {
			$adID = 0;
		}
	}
}

closeMySQL($db);
?>
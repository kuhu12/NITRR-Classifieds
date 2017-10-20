<?php 
defined('_KUHUG') or die('Restricted Access.');

destroyUserSession();

function sendRegistrationNotificationToUser($data){
	$subject = 'Account Details';
	$user_email = strtolower($data['email']);
	$first_name = ucwords($data['firstname']); $last_name = ucwords($data['lastname']);
	
	$emailbody = getEmailBodyHeader(ucwords($subject));
	$emailbody .= getEmailParagraph('Hello '.$first_name.',');
	$emailbody .= getEmailParagraph('Thank you for registering at '.SITE_NAME.'. Your account has been created. Your account will be activated within 24 hours after successful verification.');
	$emailbody .= getEmailParagraph(getEmailBoldText('Details :'));
	
	$para = array();
	$para[] = 'Name : '.getEmailBoldText($first_name.' '.$last_name);
	$para[] = 'Email : '.getEmailBoldText($user_email);
	$para[] = 'Roll No. : '.getEmailBoldText($data['username']);
	$para[] = 'Password : '.getEmailBoldText($data['password']);
	$para[] = 'Mobile : '.getEmailBoldText($data['mobile']);
	
	$emailbody .= getEmailParagraph(implode('<br />', $para));
	$emailbody .= getEmailBodyFooter();
	
	_sendEMail($user_email, $subject, array(), $emailbody);
}
function sendRegistrationNotificationToAdministrators($data){
	global $noitifcation_recipient, $bcc_recipients;
	
	$user_email = strtolower($data['email']);
	$first_name = ucwords($data['firstname']); $last_name = ucwords($data['lastname']);
	
	$subject = $first_name.' '.$last_name.' - New Registered User';
	
	$emailbody = getEmailBodyHeader(ucwords($subject));
	$emailbody .= getEmailParagraph('Hello,');
	$emailbody .= getEmailParagraph('A new user has registered at '.SITE_NAME.'. Account details is given below.');
	
	$para = array();
	$para[] = 'Name : '.getEmailBoldText($first_name.' '.$last_name);
	$para[] = 'Email : '.getEmailBoldText($user_email);
	$para[] = 'Roll No. : '.getEmailBoldText($data['username']);
	$para[] = 'Mobile : '.getEmailBoldText($data['mobile']);
	
	$emailbody .= getEmailParagraph(implode('<br />', $para));
	$emailbody .= getEmailBodyFooter();
	
	_sendEMail($noitifcation_recipient, $subject, $bcc_recipients, $emailbody);
}

function PostDataValidation_registration($data) { 
global $gender; 
$error=0;$errorMsg='';

if((filter_var($data['username'],FILTER_VALIDATE_INT)===false)||strlen($data['username'])!=8){
	return array(1,'Entered Roll no. is not valid.Please enter valid Roll no.');
}
if(filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
			return array(1, 'Entered email is not valid. Please enter valid email address.');
	}
	
$password_length = strlen($data['password']);
if(filter_var($password_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>5, 'max_range'=>10))) === false) { 
		return array(1, 'Password length must be 5 to 10 characters long.');
	}
	
if($data['password']!=$data['conpassword']){
	return array(1,'Password and Confirm Password must be same.');
}

if(!validateStrings($data['mobile'],'/^[0-9]{10,10}$/')){
	return array(1,'Entered Mobile no. is not valid.Please enter valid Mobile no.');
} 

if(!validateStrings($data['firstname'],'/^[A-Za-z .]+$/i')){
	return array(1,'Entered First Name is not valid.Please enter valid First Name');
}

$firstname_length = strlen($data['firstname']);
if(filter_var($firstname_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>2, 'max_range'=>50))) === false) {
	return array(1,'Entered FirstName is not containing 2 to 50 characters');
}

if(!validateStrings($data['lastname'],'/^[A-Za-z .]+$/i')){
	return array(1,'Entered LastName is not valid.Please enter valid LastName');
}

$lasttname_length = strlen($data['lastname']);
if(filter_var($firstname_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>2, 'max_range'=>50))) === false) {
	return array(1,'Entered LasttName is not containing 2 to 50 characters');
}


if(!array_key_exists($data['gender'], $gender)){
    return array(1,"Please select gender from the list"); 
}
if(empty($data['checkbox'])){
    return array(1,"If you agree to the terms, please check the box below");   
}

return array($error, $errorMsg);	

}

if(isset($_POST['task'])) { 
	$task=trim($_POST['task']);
	if(decode($task) == 'doRegistration')
	{
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_registration($data);
		if($val_res[0] == 1){
			$error=$val_res[0];$errorMsg=$val_res[1];
		}
		else{
			$db = connectMySQL();
			$result = getUserData($db, 0, '', $data['email'],'');
			
			if($result->num_rows) {
				$error = 1; $errorMsg = 'Your email is already registered';
			}
			else {
				$result = getUserData($db, 0, $data['username'], '','');
				if($result->num_rows) {
					$error = 1; $errorMsg = 'Your Roll No is already registered';
				}
			}

			if(!$error) 
			{
				if(insertDataIntoRegistration($db, $data)) {
					$success = 1; $successMsg = 'You have successfully registered. Your account will be activated within 24 hours.';
					setEmailTemplateEnv();
					sendRegistrationNotificationToUser($data);
					sendRegistrationNotificationToAdministrators($data);
				}
			}
			closeMySQL($db);	
		}
		
	}
}
?>
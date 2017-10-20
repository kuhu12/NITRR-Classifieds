<?php 
defined('_KUHUG') or die('Restricted Access.');

function sendTokenToUser($user_email, $token) {
	setEmailTemplateEnv();
	
	$subject = 'Verification token to reset password';
	
	$emailbody = getEmailBodyHeader(ucwords($subject));
	$emailbody .= getEmailParagraph('An automated token number has been generated to reset your password. Please enter this token number into reset password page.');
	$para = 'Token : '.getEmailBoldText($token);
	$emailbody .= getEmailParagraph($para);
	$emailbody .= getEmailBodyFooter();
	
	_sendEMail($user_email, $subject, array(), $emailbody);
}

function PostDataValidation_forgotpassword($data) {
	$data = array_filter($data, 'trim'); $error = 0; $errorMsg = '';
	
	if(filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
			return array(1, 'Entered email is not valid. Please enter valid email address.');
	}
}

if(isset($_POST['task'])) {
	$task = trim($_POST['task']);
	if(decode($task) == 'doForgotPassword') {
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_forgotpassword($data);
		if($val_res[0] == 1) { 
			$error = $val_res[0]; $errorMsg = $val_res[1];
		}
		else { 
			$db = connectMySQL();
			$result = getUserData($db, 0, '', $data['email'],''); 
			if($result->num_rows < 1) {
				$error = 1; $errorMsg = 'Entered email is not correct';
			}
			else{
				$row_obj = $result->fetch_object();
				$reset_pwd_token = uniqid().$row_obj->id;
				
				$sql = 'UPDATE '.DB_PREFIX.'users SET pwd_reset_token = "'.$reset_pwd_token.'" WHERE id = '.$row_obj->id;
				$db->query($sql) or die($db->error);
				if($db->affected_rows){
					sendTokenToUser($row_obj->email, $reset_pwd_token);
					redirectTo('resetpassword');
				}
				else{
					$error = 1; $errorMsg = 'There is some problem.Please try again';	
				}
			}
			closeMySQL($db);
		}
	}
}
?>
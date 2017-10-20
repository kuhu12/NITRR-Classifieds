<?php 
defined('_KUHUG') or die('Restricted Access.');

function PostDataValidation_resetpassword($data) {
	$data = array_filter($data, 'trim'); $error = 0; $errorMsg = '';
	
	if(!validateStrings($data['confirmationtoken'])){
		return array(1,'Entered Confirmation Code is not valid.Please enter valid Confirmation Code');
	}
$password_length = strlen($data['password']);
if(filter_var($password_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>5, 'max_range'=>10))) === false) { 
		return array(1, 'Password length must be 5 to 10 characters long.');
	}
if($data['password'] != $data['conpassword']){
	return array(1,'Password and Confirm Password must be same.');
}
return array($error, $errorMsg);	

}

if(isset($_POST['task'])) {
	$task=trim($_POST['task']);
	if(decode($task) == 'doResetPassword')
	{
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_resetpassword($data);
		if($val_res[0] == 1){
			$error=$val_res[0];$errorMsg=$val_res[1];
		}
		else{
			$db = connectMySQL();
			$result = getUserData($db, 0, '', '', $data['confirmationtoken']);
			
			if($result->num_rows < 1) {
				$error = 1; $errorMsg = 'Entered confirmation code is not correct';
			}
			else {
				$row_obj = $result->fetch_object();
				$sql = 'UPDATE '.DB_PREFIX.'users SET password ="'.getHashPassword($data['password']).'", pwd_reset_token = "" WHERE id = '.$row_obj->id;
				$db->query($sql) or die($db->error);
				if($db->affected_rows){
					$success = 1; $successMsg='Your new password is set succesfully';
				}
				else{
					$error = 1; $errorMsg = 'Your request could not be processed.Please try again';
				}
			}	
			closeMySQL($db);	
		}
		
	}
}
?>
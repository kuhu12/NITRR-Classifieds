<?php 
defined('_KUHUG') or die('Restricted Access.');

destroyUserSession();

function PostDataValidation_login($data) {
	$error = 0; $errorMsg = '';
	if($data['username'] == '' && $data['email'] == '') {
		return array(1, 'Please enter roll no or email.');
	}
	if(((filter_var($data['username'], FILTER_VALIDATE_INT) === false) || strlen($data['username']) != 8) && $data['username'] !='') {
		return array(1, 'Entered roll no is not valid. Please enter valid roll no.');
	} 
	if((filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) && $data['email'] != '') {
		return array(1, 'Entered email is not valid. Please enter valid email address.');
	}
	
	$password_length = strlen($data['password']);
	if(filter_var($password_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>5, 'max_range'=>10))) === false) { 
		return array(1, 'Password length must be 5 to 10 characters long.');
	}

return array($error, $errorMsg);	
}

if(isset($_POST['task'])) {
	$task = trim($_POST['task']);
	if(decode($task) == 'doLogin') {
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_login($data);
		if($val_res[0] == 1) { 
			$error = $val_res[0]; $errorMsg = $val_res[1];
		}
		else { 
			$db = connectMySQL();
			if(!empty($data['username'])) { $result = getUserData($db, 0, $data['username'], '',''); }
			else { $result = getUserData($db, 0, '', $data['email'],''); }
			
			if($result->num_rows < 1) {
				$error = 1; $errorMsg = 'You do not have an account yet. Please register.';
			}
			else { 
				$row_obj = $result->fetch_object();
				
				if($row_obj->block == 1) { 
					$error = 1; $errorMsg = 'Your account has been blocked. Please contact to site administrator.';
				}
				elseif($row_obj->status == 0) {
					$error = 1; $errorMsg = 'Your account has not been activated yet. It takes atleast 24 hours to verify your registered data.';
				}
				//elseif(password_verify($data['password'], $row_obj->password)) {
				elseif(crypt($data['password'], $row_obj->password) == $row_obj->password) {
					$success = 1; $successMsg='You have successfully logged in';
					update_user_loginTime_IP($db, $row_obj->id);
					
					session_start();
					setUserInfoSessionData($row_obj);
					redirectTo();
				}
				else {
					$error = 1; $errorMsg = 'Entered password is not correct. Please try again. If problem persists, please click on forgot password link.';
				}
				
			}
			
			closeMySQL($db);
		}
		
	}
}
?>
<?php 
defined('_KUHUG') or die('Restricted Access.');

session_start();
is_logged_in();
$user_id = $_SESSION['user_info']['user_id'];

$db = connectMySQL();

$branch_category = getBranch_Categories($db);
$semesters = range(1,10);

function PostDataValidation_profile($data) { 
global $branch_category, $semesters;

$error=0; $errorMsg = '';

if(!validateStrings($data['firstname'],'/^[A-Za-z .]+$/i')){
	return array(1,'Entered First Name is not valid.Please enter valid First Name');
}

$firstname_length = strlen($data['firstname']);
if(filter_var($firstname_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>2, 'max_range'=>50))) === false) {
	return array(1,'Entered First Name is not containing 2 to 50 characters');
}

if(!validateStrings($data['lastname'],'/^[A-Za-z .]+$/i')){
	return array(1,'Entered Last Name is not valid.Please enter valid LastName');
}

$lasttname_length = strlen($data['lastname']);
if(filter_var($firstname_length, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>2, 'max_range'=>50))) === false) {
	return array(1,'Entered LasttName is not containing 2 to 50 characters');
}

if(empty($data['dept_id'])){
    return array(1,"Select your branch.");   
}

if(!array_key_exists($data['dept_id'], $branch_category)) {
	return array(1,"Please select branch from list.");
}

if(empty($data['semester'])){
    return array(1,"Select your semester.");   
}

if(!in_array($data['semester'], $semesters)) {
	return array(1,"Please select semester from list.");  
}

if((filter_var($data['enroll_no'], FILTER_VALIDATE_INT) === false) && strlen($data['enroll_no']) == 6) { 
	return array(1, 'Entered enrollment no is invalid. Enrollment no. must contain only 6 digits.');
}

if(filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
	return array(1, 'Entered email is not valid. Please enter valid email address.');
}

if(!validateStrings($data['mobile'],'/^[0-9]{10,10}$/')){
	return array(1,'Entered Mobile no. is not valid.Please enter valid Mobile no.');
}
 
return array($error, $errorMsg);
}

if(isset($_POST['task'])) {
	$task=trim($_POST['task']);
	if(decode($task) == 'SaveProfile')
	{
		$data = FilterPostArray($_POST);
		$val_res = PostDataValidation_profile($data);
		if($val_res[0] == 1){
			$error=$val_res[0]; $errorMsg=$val_res[1];
		}
		else{
			if(checkUserEmailAvailablity_Profile($db, $data['email'], $user_id)) {
				$error=1; $errorMsg='Entered email address already exits. Please enter other email address';
			}
			else { 
				if(updateUsersData($db, $data, $user_id, $user_id) && updateUserProfile($db, $data, $user_id, $user_id)){
					$result = getUserData($db, $user_id);
					$row = $result->fetch_object();
					setUserInfoSessionData($row);
					$success = 1; $successMsg = 'Your profile is successfully updated.';
				}
			}
		}
	}
}

$profileData = getProfileData($db, $user_id);

closeMySQL($db);
?>
<?php
defined('_KUHUG') or die('Restricted Access.'); 

function checkUserEmailAvailablity_Profile($mysqli, $email, $user_id) {
	$email = $mysqli->real_escape_string($email);
	$result = $mysqli->query('SELECT id FROM '.DB_PREFIX.'users where LOWER(email)="'.strtolower($email).'" and id !='.$user_id) or die($mysqli->error);
return $result->num_rows;	
}

function getUserData($mysqli, $id=0, $username='', $email='', $pwd_token='') {
	$whereCls = [];
	
	if($id > 0) { $whereCls[] = 'id="'.$id.'"'; }
	if($username !='') { $whereCls[] = 'username="'.$mysqli->real_escape_string($username).'"'; }
	if($email !='') { $whereCls[] = 'LOWER(email)="'.$mysqli->real_escape_string(strtolower($email)).'"'; }
    if($pwd_token !='') { $whereCls[] = 'pwd_reset_token="'.$mysqli->real_escape_string($pwd_token).'"'; }
	
	$whereCls = (count($whereCls) > 0)? implode(' and ', $whereCls):'';
	$result = $mysqli->query('SELECT * FROM '.DB_PREFIX.'users where '.$whereCls) or die($mysqli->error);
	
return $result; 	
}

function getProfileData($mysqli, $user_id) {
	$result = $mysqli->query('SELECT * FROM '.DB_PREFIX.'users_profile where user_id='.$user_id) or die($mysqli->error);
return $result->fetch_object();		
}

function BuildUserGroupMap($mysqli, $user_id) {
	global $registered_user_group_id;
	$values=array($mysqli->real_escape_string($user_id), $mysqli->real_escape_string($registered_user_group_id));
	
	$sql = 'INSERT INTO '.DB_PREFIX.'users_usergroups_map (`user_id`,`group_id`) VALUES ('.implode(', ', $values).')';
	$mysqli->query($sql) or die($mysqli->error);
}

function insertDataIntoRegistration($mysqli, $data){
	
	$jdate = new DateTime();
	
	$values = array($mysqli->real_escape_string($data['username']), 
		$mysqli->real_escape_string(strtolower($data['email'])),
		$mysqli->real_escape_string(getHashPassword($data['password'])),
		$mysqli->real_escape_string($data['mobile']),
		$mysqli->real_escape_string(ucwords($data['firstname'])),
		$mysqli->real_escape_string(ucwords($data['lastname'])),
		$mysqli->real_escape_string($data['gender']),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string(getClientIP())
	);
	$values = AddQuotesToArrayVals($values);
	
	
	$sql = 'INSERT INTO '.DB_PREFIX.'users (`username`,`email`,`password`,`mobile`,`firstname`,`lastname`,`gender`,`registered_on`,`modified_on`,`last_ip_address`) VALUES ('.implode(', ', $values).')'; 
	$mysqli->query($sql) or die($mysqli->error);
	
	$last_insert_id = mysqli_insert_id($mysqli);
	BuildUserGroupMap($mysqli, $last_insert_id);
	InsertNewUser_Profile($mysqli, $last_insert_id, $jdate->format(DB_DATETIME_FRMT));
	
	
return $last_insert_id;
}

function getAD_Categories($mysqli){
	$sql='SELECT id,category_name,parent_id FROM '.DB_PREFIX.'classifieds_categories where published=1 order by parent_id,category_name asc';
	$result=$mysqli->query($sql) or die($mysqli->error);
	
	$parent_category=array();
	$child_category=array();
	$all_category=array();
	
	if($result->num_rows > 0)
		{
			while($row_obj = $result->fetch_object())
			{
				if($row_obj->parent_id > 0) { $child_category[$row_obj->parent_id][] = $row_obj->id; }
				else { $parent_category[] = $row_obj->id; }
				
				$all_category[$row_obj->id] = $row_obj->category_name;
			}
				
			
		}

return array($parent_category, $child_category, $all_category);		
}

function getBranch_Categories($mysqli){
	$sql='SELECT id,dept_name FROM '.DB_PREFIX.'departments where published=1 order by dept_name asc';
	$result=$mysqli->query($sql) or die($mysqli->error);
	
	$dept_category = array();
	
	if($result->num_rows > 0){
		while($row_obj = $result->fetch_object()){
			$dept_category[$row_obj->id] = $row_obj->dept_name;
		}	
	}
return $dept_category;
}

function insertDataIntoSubmitAd($mysqli, $data, $user_id, $modified_by){
	global $safeTextRegEx;
	$jdate = new DateTime();
	$values = array($mysqli->real_escape_string(getSafeString($data['adtitle'], $safeTextRegEx)),
		$mysqli->real_escape_string($user_id),
        $mysqli->real_escape_string($data['category']),	
		$mysqli->real_escape_string(getSafeString($data['addescription'], $safeTextRegEx)),
		$mysqli->real_escape_string($data['price']),
		$mysqli->real_escape_string($data['negotiable']),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string($modified_by),
		$mysqli->real_escape_string($data['published'])
	);
	
	$sql = 'INSERT INTO '.DB_PREFIX.'users_submit_ad(`ad_title`, `user_id`,`category_id`,`ad_description`,`price`,`negotiable`,`modified_on`,`modified_by`,`published`) VALUES ('.implode(', ', AddQuotesToArrayVals($values)).')'; 
	$mysqli->query($sql) or die($mysqli->error);
    $last_insert_id = mysqli_insert_id($mysqli);  
return $last_insert_id;
}
function updateUserProfile($mysqli, $data, $user_id, $modified_by){
	$jdate = new DateTime();
	$values = array($mysqli->real_escape_string($data['dept_id']),
        $mysqli->real_escape_string($data['enroll_no']),	
		$mysqli->real_escape_string($data['semester']),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string($modified_by)
	);
	$values = AddQuotesToArrayVals($values);
	$sql = 'UPDATE '.DB_PREFIX.'users_profile SET dept_id='.$values[0].',enroll_no='.$values[1].',semester='.$values[2].', modified_on='.$values[3].', modified_by='.$values[4].' WHERE user_id='.$user_id; 
	$mysqli->query($sql) or die($mysqli->error);
return $mysqli->affected_rows;
}

function updateUsersData($mysqli, $data, $user_id, $modified_by) {
	$jdate = new DateTime();
	$values = array($mysqli->real_escape_string(strtolower($data['email'])),
        $mysqli->real_escape_string(ucwords($data['firstname'])),
		$mysqli->real_escape_string(ucwords($data['lastname'])),
		$mysqli->real_escape_string($data['mobile']),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string($modified_by)
	);
	$values = AddQuotesToArrayVals($values);
	
	$sql = 'UPDATE '.DB_PREFIX.'users SET email='.$values[0].', firstname='.$values[1].', lastname='.$values[2].', mobile='.$values[3].', modified_on='.$values[4].', modified_by='.$values[5].' WHERE id='.$user_id;
	$mysqli->query($sql) or die($mysqli->error);

return $mysqli->affected_rows;
}

function InsertNewUser_Profile($mysqli, $user_id, $modified_on) {
	$values= array($mysqli->real_escape_string($user_id), $mysqli->real_escape_string($modified_on));
	$sql = 'INSERT INTO '.DB_PREFIX.'users_profile (`user_id`,`modified_on`) VALUES ('.implode(', ', AddQuotesToArrayVals($values)).')';
	$mysqli->query($sql) or die($mysqli->error);
}

function update_user_loginTime_IP($mysqli, $user_id){
	$jdate = new DateTime();
	$sql = 'UPDATE '.DB_PREFIX.'users SET last_login_time="'.$jdate->format(DB_DATETIME_FRMT).'", last_ip_address="'.getClientIP().'" WHERE id='.$user_id;
	$mysqli->query($sql) or die($mysqli->error);
}

function getMyAds($mysqli, $user_id) {
	$sql = 'SELECT * FROM '.DB_PREFIX.'users_submit_ad where id='.$user_id.' order by id desc';
	$result = $mysqli->query($sql) or die($mysqli->error);
return $result;
}

function getAdData($mysqli, $id=0, $user_id=0) {
	$whereCls = [];
	
	if($id > 0) { $whereCls[] = 'id="'.$id.'"'; }
	if($user_id > 0) { $whereCls[] = 'user_id="'.$user_id.'"'; }
	
	$whereCls = (count($whereCls) > 0)? implode(' and ', $whereCls):'';
	$result = $mysqli->query('SELECT * FROM '.DB_PREFIX.'users_submit_ad where '.$whereCls) or die($mysqli->error);
	
return $result; 
}

function updateDataIntoSubmitAd($mysqli, $Ad_id, $data, $user_id, $modified_by){
	global $safeTextRegEx;
	$jdate = new DateTime();
	$values = array($mysqli->real_escape_string(getSafeString($data['adtitle'], $safeTextRegEx)),
        $mysqli->real_escape_string($data['category']),	
		$mysqli->real_escape_string(getSafeString($data['addescription'], $safeTextRegEx)),
		$mysqli->real_escape_string($data['price']),
		$mysqli->real_escape_string($data['negotiable']),
		$mysqli->real_escape_string($jdate->format(DB_DATETIME_FRMT)),
		$mysqli->real_escape_string($modified_by),
		$mysqli->real_escape_string($data['published']),
		$mysqli->real_escape_string(0)
	);
	
	$values = AddQuotesToArrayVals($values);
	$sql = 'UPDATE '.DB_PREFIX.'users_submit_ad SET ad_title='.$values[0].',category_id='.$values[1].',ad_description='.$values[2].', price='.$values[3].',negotiable='.$values[4].',modified_on='.$values[5].', modified_by='.$values[6].', published='.$values[7].',status='.$values[8].'  WHERE id='.$Ad_id.' and user_id='.$user_id; 
	$mysqli->query($sql) or die($mysqli->error);
	
return $mysqli->affected_rows;
}

function getViewAds($mysqli, $user_id) {
	$sql = 'SELECT a.id,a.ad_title,a.category_id,a.status,a.published,a.modified_on,u.firstname,u.lastname FROM '.DB_PREFIX.'users_submit_ad as a inner join '.DB_PREFIX.'users as u on u.id = a.user_id where a.published=1 and a.status=1 and a.user_id not in('.$user_id.')';
	$result = $mysqli->query($sql) or die($mysqli->error);
return $result;
}

?>
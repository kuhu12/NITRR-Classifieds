<?php 
defined('_KUHUG') or die('Restricted Access.');

	function safe_b64encode($string) {
		$data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
 
    function encode($value){ 
		if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SECRET_KEY, $text, MCRYPT_MODE_ECB, $iv);
        return trim(safe_b64encode($crypttext)); 
    }
 
    function decode($value){
		if(!$value){return false;}
        $crypttext = safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SECRET_KEY, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
	
	function FilterPostArray($data) {
		return array_map('trim', $data);
	}
	
	function redirectTo($view='') {
		($view)? @header('location: index.php?view='.$view):@header('location:'.SITE_URL);		
	}

	function validateStrings($string, $pattern = '/^[a-z0-9]/') {
		return preg_match($pattern, trim(strip_tags($string)));
	}
			
	function getSafeString($string, $pattern = '/[^a-z0-9]/') {
		return preg_replace($pattern, '', trim(strip_tags($string)));
	}

	function getHashPassword($password){
		//$password_encrypted = password_hash($password, PASSWORD_DEFAULT);
		$password_encrypted = crypt($password, SECRET_KEY);
		return $password_encrypted;
	}
	function connectMySQL() { 
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if ($mysqli->connect_error) { 
			die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error); 
		}
		return $mysqli;
	}

	function closeMySQL($mysqli) {
		$mysqli->close();
	}

	function showError($error, $errorMsg) {
		if($error) { ?><p class="error"><?php echo $errorMsg; ?></p><p>&nbsp;</p><?php } 
	}

	function showSuccess($success, $successMsg) {
		if($success) { ?><p class="success"><?php echo $successMsg; ?></p><p>&nbsp;</p><?php } 
	}

	function getClientIP() {
		if(isset($_SERVER)) {
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { return $_SERVER["HTTP_X_FORWARDED_FOR"]; }
			if (isset($_SERVER["HTTP_CLIENT_IP"])) { return $_SERVER["HTTP_CLIENT_IP"]; }
		return $_SERVER["REMOTE_ADDR"];
		}
		
		if(getenv('HTTP_X_FORWARDED_FOR')) { return getenv('HTTP_X_FORWARDED_FOR'); }
		if(getenv('HTTP_CLIENT_IP')) { return getenv('HTTP_CLIENT_IP'); } 
	return getenv('REMOTE_ADDR');
	}

	function _sendEMail($to, $subject, $bcc, $emailbody) {
		$subject .= ' - '.SITE_NAME;
		$headers = "From: ".FROM_NAME."<".strip_tags(FROM_EMAIL).">\r\n";
		$headers .= "Reply-To: ".FROM_NAME."<". strip_tags(FROM_EMAIL) .">\r\n";
		$headers .= (count($bcc) > 0)? "BCc: ".implode(', ', $bcc)."\r\n":'';
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	return mail($to, $subject, $emailbody, $headers);
	}
	
	function setEmailTemplateEnv() {
		require_once(VIEWS.EMAIL_TEMPLATE.VIEW_FTYPE);
	}
	
	function destroyUserSession() {
		session_start();
		if(isset($_SESSION['user_info'])) {
			unset($_SESSION['user_info']);
		}
	}
	
	function is_logged_in() {
		$clearSession = 1;
		if(isset($_SESSION['user_info'])) { 
			$interval = ((time() - $_SESSION['user_info']['login_time'])/60);
			if((SESSION_LIFE >= $interval) && (filter_var($_SESSION['user_info']['user_id'], FILTER_VALIDATE_INT))) {
				$clearSession = 0; 
				$_SESSION['user_info']['login_time'] = time();
			}
		}
		if($clearSession) { 
			redirectTo('login'); 
		}
	}
	
	function setUserInfoSessionData($data) {
		$info = array();
		$info['login_time'] = time();
		$info['user_id'] = $data->id;
		$info['user_fname'] = $data->firstname;
		$info['user_lname'] = $data->lastname; 
		$info['user_rollno'] = $data->username; 
		$info['user_email'] = $data->email;
		$info['user_mobile'] = $data->mobile;
		
 		$_SESSION['user_info'] = $info;	
	}
	
	function AddQuotesToArrayVals($values) {
		$string = '"'.implode('","', $values).'"';
	return explode(',', $string);	
	}
	
	function getChoiceOptions($selected='') {
		global $booleanChoice;
		$html = '';
		foreach($booleanChoice as $k => $v) { $selectedAtr = ($selected == $k)? ' selected="selected"':'';
			$html .= '<option value="'.$k.'"'.$selectedAtr.'>'.$v.'</option>';
		}
	return $html;
	}
	
	function callInnerLayoutHeader() {
		global $innerLayout;
		if($innerLayout) { require_once(VIEWS.'innerlayout_header'.VIEW_FTYPE); }
	}
	
?>
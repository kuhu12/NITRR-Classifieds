

function validateFormlogin() { 
if(document.forms["login"]["username"].value == '' && document.forms["login"]["email"].value == '') { 
	alert('Roll No & email both can not be empty. Please enter Roll No. or email.');
		return false;
}
if(document.forms["login"]["username"].value !=''){
	if(!validateRollno(document.forms["login"]["username"].value)){
		alert('Entered Roll No is not valid. Please enter valid Roll No.');
		return false;
	}
}

if(document.forms["login"]["email"].value !='') {
    if(!validateEmail(document.forms["login"]["email"].value)){
		alert('Entered Email address is not valid. Please enter valid Email address.');
		return false;
	}
}

if(document.forms["login"]["password"].value == ''){
		alert('Please enter the password');
		return false;
	}
	return true;
}
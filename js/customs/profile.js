
function validateFormProfile(){
    if(!validateName(document.forms["profile"]["firstname"].value)){
		alert('Entered First Name is not valid. Please enter valid First Name.');
		return false;
	}
	if(!textlength(document.forms["profile"]["firstname"].value, 2, 50)){
        alert('Enter the First Name containing 2 to 50 characters.');
	    return false;
	}
	if(!validateName(document.forms["profile"]["lastname"].value)){
		alert('Entered Last Name is not valid. Please enter valid Last Name.');
		return false;
	}
	if(!textlength(document.forms["profile"]["lastname"].value, 2, 50)){
        alert('Enter the Last Name containing 2 to 50 characters.');
	    return false;
	}
	if((document.forms["profile"]["dept_id"].value) == ''){
		alert('Please select your Branch');
		return false;
	}
	if((document.forms["profile"]["semester"].value) == ''){
		alert('Please select your Semester');
		return false;
	}
	if(!validateEnrollNo(document.forms["profile"]["enroll"].value)){
		alert('Entered Enrollment No. is not valid. Please enter valid Enrollment No.');
		return false;
	}
	if(!validateEmail(document.forms["profile"]["email"].value)){
	alert('Entered Email address is not valid. Please enter valid Email address');
		return false;	
	}
	if(!validatePhoneNo(document.forms["profile"]["mobile"].value)){
		alert('Entered Mobile No. is not valid. Please enter valid Mobile No.');
		return false;
	}
	return true;
}
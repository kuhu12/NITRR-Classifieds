

var emailRegx= /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
var phoneRegx= /^[0-9]{10,10}$/;
var rollRegx= /^[0-9]{8,8}$/;
var nameRegx= /^[A-Za-z .]+$/i;
var passRegx= /.{5,10}$/;
var enrollRegx= /^[0-9]{6,6}$/;

function validateEmail(value) {
    if(emailRegx.test(value)){
		return true;
	}
	else {
		return false;
	}
}

function validatePhoneNo(value) {
    if(phoneRegx.test(value)){
	   return true;
	}
    else {
	   return false;
	}
}

function validateRollno(value) {
    if(rollRegx.test(value)){
	   return true;
	}
    else {
	   return false;
	}
}

function validateName(value){
    if(nameRegx.test(value)){
	   return true;
	}
    else {
	   return false;
    }
}

function validatePassword(value){
    if(passRegx.test(value)){
	   return true;
	}
    else {
	   return false;
    }
}

function validateEnrollNo(value){
    if(enrollRegx.test(value)){
	   return true;
	}
    else {
	   return false;
    }
}
	
function textlength(inputtxt, minlength, maxlength)
{ 
	if(inputtxt.length < minlength || inputtxt.length > maxlength) { return false; }
	else { 
		return true;
	}
}

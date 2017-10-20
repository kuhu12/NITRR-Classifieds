

function validateFormResetPassword() {
	
	var confirmationCodeRegx=/^[a-zA-Z0-9]*$/;
    if(!confirmationCodeRegx.test(document.forms["resetpassword"]["confirmationtoken"].value)){
		alert('Confirmation code is invalid.Please enter valid Confirmation Code');
		return false;
	}
if(!validatePassword(document.forms["resetpassword"]["password"].value)){
		alert('Password length must be 5 to 10 cahracters');
		return false;
		}
	var a = document.forms["resetpassword"]["password"].value;
	var b = document.forms["resetpassword"]["conpassword"].value;
    if (a!=b) {
        alert("Password and Confirm Password must be the same");
        return false;
	}
    
		return true;
}
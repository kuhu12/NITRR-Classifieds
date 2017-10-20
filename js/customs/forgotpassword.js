

function validateFormForgotPassword() {
if(!validateEmail(document.forms["forgotpassword"]["email"].value)){
		alert('Entered Email address is not valid. Please enter valid Email address');
		return false;
		}
		return true;
}
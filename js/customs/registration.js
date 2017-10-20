

function validateFormRegistration() {
	if(!validateRollno(document.forms["registration"]["username"].value)) {
		alert('Entered Roll No is not valid. Please enter valid Roll No.');
		return false;
	}
    if(!validateEmail(document.forms["registration"]["email"].value)){
	alert('Entered Email address is not valid. Please enter valid Email address');
		return false;
	}
    if(!validatePassword(document.forms["registration"]["password"].value)){
		alert('Password length must be 8 to 10 cahracters');
		return false;
	}
	var a = document.forms["registration"]["password"].value;
	var b = document.forms["registration"]["conpassword"].value;
    if (a!=b) {
        alert("Password and Confirm Password must be same");
        return false;
	}
	
	if(!validatePhoneNo(document.forms["registration"]["mobile"].value)){
		alert('Entered Mobile No. is not valid. Please enter valid Mobile No.');
		return false;
	}
	if(!validateName(document.forms["registration"]["firstname"].value)){
		alert('Entered First Name is not valid. Please enter valid First Name.');
		return false;
	}
	if(!textlength(document.forms["registration"]["firstname"].value,2,50)){
        alert('Enter the First Name containing 2 to 50 characters.');
	    return false;
	}
	if(!validateName(document.forms["registration"]["lastname"].value)){
		alert('Entered Last Name is not valid. Please enter valid Last Name.');
		return false;
	}
	if(!textlength(document.forms["registration"]["lastname"].value,2,50)){
        alert('Enter the Last Name containing 2 to 50 characters.');
	    return false;
	}
	
    var x = document.forms["registration"]["gender"].value;
    if (x == null || x == "") {
        alert("Please choose gender");
        return false;
	}
	if(document.registration.checkbox.checked == false){
    alert("Before registration,please agree to the Terms of Services");
	return false;
    }
	
	
		return true;
}
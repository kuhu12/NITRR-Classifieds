

function validateFormSubmitAd(){
    if(!textlength(document.forms["submitad"]["adtitle"].value,15,50)){
        alert('Enter the Ad Title in 15 to 50 characters.You can use only these special characters(+ - & * () , .)');
	    return false;
	}
	if((document.forms["submitad"]["category"].value) == ''){
        alert('Select the Ad Category');
	    return false;
	}
	if(!textlength(document.forms["submitad"]["addescription"].value,50,200)){
        alert('Enter the Ad Description in 50 to 200 characters.You can use only these special characters(+ - & * () , .)');
	    return false;
	}
	return true;
 }
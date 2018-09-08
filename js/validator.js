function isInvalidEmail(email){
	
	if (typeof(email) == 'undefined' || email == null || 
		email.length == 0 ||
		email.length > 254 ||
		email[0] == '@' ||
		/[^a-zA-Z0-9.@_-]/.test(email)){
		return true;
	}

	var aronCount = email.match(/@/g);

	if(aronCount == null || aronCount.length != 1 ){
		return true;
	}

	var dotCount = email.match(/\./);

	if (dotCount == null){
		return true;
	}
	else {
		var splitDot = email.split('.');

		if (splitDot[splitDot.length - 1].length < 2){
			return true;
		}
	}

	return false;
}

function isInvalidUsername(username){
	if (typeof(username) == "undefined" ||
		username == null ||
		username.length == 0 ||
		username.length > 32 ||
		/\s/.test(username) ||
		/[^a-zA-Z0-9_]/.test(username) ||
		/^[0-9]/.test(username)){
		return true;
	}

	return false;
}

function isInvalidPassword(password){
	if (typeof(password) == "undefined" ||
			password == null ||
			password.length == 0 ||
			password.length > 32){
			return true;
		}
}
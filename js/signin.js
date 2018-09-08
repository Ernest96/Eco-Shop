function checkform(){
		var username = $('#username').val();
		var password = $('#password').val();
		var error = '';

		$("#error").html("");
		$("#error").hide();

		if (isInvalidUsername(username)){
			error += 'Username is invalid <br>';
		}

		if (isInvalidPassword(password)){
			error += 'Password is invalid <br>';
		}

		if (error.length > 0){
			$("#error").html(error)
			$("#error").show();
			return false;
		}

		return true;
}
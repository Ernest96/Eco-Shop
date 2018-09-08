$(document).ready(function (){
	$("#register").click(function (){
		event.preventDefault();

		if (typeof (loading) != 'undefined' && loading == true){
			return;
		}

		var username = $("#username").val();
		var email = $("#email").val();
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();
		var error = "";
			loading = false;

		var btnText = $("#register").html();
		$("#error").html("");
		$("#error").hide();

		if (isInvalidUsername(username)){
			error += "Username is in invalid form, contains forbidden characters or is too long (32 characters max).<br><br>";
		}

		if (isInvalidEmail(email)){
			error += "Email is in invalid form or contains forbidden characters.<br><br>";
		}

		if (isInvalidPassword(password1)){
			error += "Password is empty or is too long (32 characters max).<br><br>";
		}

		if (password1 != password2){
			error += "Passwords does not match<br><br>";
		}

		if (error.length > 0){
			error = error.substring(0, error.length - 6);
			$("#error").html(error)
			$("#error").show();
			return;
		}

		loading = true;
		$('#register').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

		$.post("/register.php",{username: username, email: email, 
								password: password1 })
			.done(function(data) {
				if (data != null && typeof (data) == "object" &&
					typeof data.error != 'undefined' && data.error.length > 0){
						$("#error").html(data.error)
						$("#error").show();
				}
				else{
					window.location.assign("/");
				}
			})
			.fail(function (data){
				alert("Uknown error. Please contact administration.")
			})
			.always(function (){
				$("#register").html(btnText);
				loading = false;
			});

	});
});
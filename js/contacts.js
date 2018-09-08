function myMap() {
var mapOptions = {
    center: new google.maps.LatLng(47.04596799999999,28.862616200000048),
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.HYBRID
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

$(document).ready(function (){

	$('#ask_question').click(function (){
		event.preventDefault();

		if (typeof (loading) != 'undefined' && loading == true){
			return;
		}

		var email = $('#email').val();
		var question = $('#question').val();
		var btnText = $(this).html();
			loading = false;

		if (isInvalidEmail(email)){
			alert("Email addres is not provided in correct form or contains invalid characters.");
			return;
		}
		else if (question == null || question.trim().length == 0){
			alert("Question is empty");
			return;
		}

		loading = true;
		$('#email').val("");
		$('#question').val("");
		$('#ask_question').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

		$.post("/mail.php",{question: question, email: email})
			.done(function(data) {
				if (data != null && typeof (data) == "string" && data.length > 0){
					alert(data);
				}
				else{
					alert("Your question was send! Thank you.");
				}
			})
			.fail(function (data){
				$('#email').val(email);
				$('#question').val(question);
				if (data != null && typeof (data) == "string" && data.length > 0){
					alert("Server error:" + data);
				}
			})
			.always(function (){
				loading = false;
				$('#ask_question').html(btnText);
			});

	});

})
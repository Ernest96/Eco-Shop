<?php
	require_once './header.php'
?>

<div class="main-view">
	<div class="container">
		<h2>Contacts</h2>
		<hr>
		<div class="row">
			<div class="col-sm-5">
				<strong>Location:</strong> Bd. Moscovei 2, Chisinau
				<br><br>
				<strong>Phone:</strong> +373 (022) 49 40 18
				<br><br>
				<strong>Mobile Phone:</strong> +373 78 079 134
				<br><br>
				<strong>Email:</strong> bitca.ernest@gmail.com
				<br><br>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<form class="form-horizontal">
					<div class="form-group">
						<h4>&nbsp; Ask a question</h4>
						<br>
						<div class="col-xs-3">
							<label for="email" class="form-label">Email</label>
						</div>
						<div class="col-xs-9">
							<?php
								$value = "";
								if($loged)
								{
									$value = $_SESSION["email"];
								}
								echo "<input type='text' value='$value' id='email' class='form-control'>";
							?>
						</div>
						<br><br>
						<div class="col-xs-3">
							<label for="question" class="form-label">Question</label>
						</div>
						<div class="col-xs-9">
							<input type="text" id="question" class="form-control">
						</div>
					</div>
					<button id="ask_question" class="btn btn-success pull-right">
							Submit your question
					</button>
				</form>
			</div>
		</div>
		<br>
		<div class="row" >
			<div class="col-xs-12">
				<div id="map" style="width:340px;height:340px;"></div>
			</div>
		</div>
	</div>
</div>

<?php
	require_once "./footer.php";
?>

<script type="text/javascript" src="/js/validator.js"></script>
<script type="text/javascript" src="/js/contacts.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPGdtmaTAxg0-glHQ2HCLF0UK9YNBex1g&callback=myMap"></script>

<?php
	if (session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}

	$loged = false;
	if (isset($_SESSION["username"]))
	{
		$loged = true;
	}
?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/style.css">
</head>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/">
				<img src="/img/logo.png" class="img-responsive" id="logo"/>
			</a>
		</div>
		<div class="navbar-collapse collapse">
			<div class="header-items">
				<ul class="nav navbar-nav">
					<li><a href="market.php">Market</a></li>
					<li><a href="contacts.php">Contacts</a></li>
					<li><a href="about.php">About us</a></li>
				</ul>
			</div>
			<form class="navbar-form navbar-right">
				
				<?php
					if ($loged)
					{
						echo '<strong> Hello, '. $_SESSION["username"] . " &nbsp;</strong> ";
						echo '<a class="btn btn-default btn-sm" href="/logoff.php">Log Off</a>';
					}
					else
					{
						echo '<a class="btn btn-success btn-sm" href="signin.php">Sign in <i class="fas fa-sign-in-alt" ></i></a> ';
						echo '<a class="btn btn-default btn-sm" href="/register.php">Register</a>';
					}
				?>
			</form>
		</div>
	</div>
</nav>

<script>
	$(document).ready(function (){
		$('.fadein').fadeIn(800);
	})
</script>
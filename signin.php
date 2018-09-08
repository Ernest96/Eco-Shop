<?php
	require_once "./header.php";
	require_once "./login.php";

	if (is_authenticated())
	{
		header("Location: /");
		exit();
	}

	$error = '';

	if (isset($_POST["username"]) && isset($_POST["password"]))
	{
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
		{
			$error = 'Could not connect to database. Contact administration';
		}
		else
		{
			$username = mysql_fix_string($conn, $_POST["username"]);
			$password = md5(mysql_fix_string($conn, $_POST["password"]));

			$check = "SELECT * FROM user WHERE username='" . $username 
						. "' AND password='" . $password . "';";
			$res = $conn->query($check);

			if ($res->num_rows == 1)
			{
				$user = $res->fetch_array(MYSQLI_ASSOC);
			}
			else
			{
				$error = 'Invalid username or password';
			}
			
		}
		
		if (!$error)
		{
			authenticate($username, $user["email"]);
			header("Location: /");
		}
	}
?>

<div class="main-view signin-bg">
	<div class="container-fluid centered">
		<form class="form-horizontal main-form fadein" action="/signin.php" method="post">
				<div class="form-group gray-bold">
					<h2>&nbsp; Sign in</h2>
					<br>
					<div class="col-sm-4 col-sm-offset-4 well">
						<div class="col-sm-12 input-icon">
							<input id="username" name="username" type="text" class="form-control" placeholder="Username or Email">
							<i class="fas fa-user"></i>
						</div>
						<br><br>
						<div class="col-sm-12 input-icon">
							<input id="password" name="password" type="password" class="form-control" placeholder="Password">
							<i class="fas fa-key"></i>
						</div>
						<br><br>
						<button id="signin"  class="btn btn-success" onclick="return checkform()">
							Sign in
						</button>
					</div>
				</div>
		</form>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div id="error" class="alert alert-danger" style="display:none;" >
					<br>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	require_once "./footer.php";
	if ($error)
	{
		printf('<script> $("#error").show(); $("#error").html("%s") </script>',$error);
	}
?>

<script type="text/javascript" src="/js/validator.js"></script>
<script type="text/javascript" src="/js/signin.js"></script>
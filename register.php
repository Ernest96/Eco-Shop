<?php
	require_once './login.php';

	if (is_authenticated())
	{
		header("Location: /");
		exit();
	}

	if (isset($_POST["username"]) &&
		isset($_POST["email"]) &&
		isset($_POST["password"]))
	{
		header('Content-type: application/json');
		$error = '';

		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
		{
			$error = 'Could not connect to database. Contact administration';
		}
		else
		{
			$username = mysql_fix_string($conn, $_POST["username"]);
			$email = mysql_fix_string($conn, $_POST["email"]);
			$password = md5(mysql_fix_string($conn, $_POST["password"]));

			$check = "SELECT Count(*) FROM user WHERE username='" . $username. "';";
			$res = $conn->query($check);
			$count = $res->fetch_array(MYSQLI_NUM)[0];

			if ($count > 0)
			{
				$error .= "This username is in use. <br>";
			}

			$check = "SELECT Count(*) FROM user WHERE email='" . $email . "';";
			$res = $conn->query($check);
			$count = $res->fetch_array(MYSQLI_NUM)[0];

			if ($count > 0)
			{
				$error .= "This email is in use. <br>";
			}

			if (!$error)
			{
				$insert = $conn->prepare('INSERT INTO user VALUES(?,?,?)');
				$insert->bind_param('sss', $username, $email, $password);
				$insert->execute();
				$insert->close();
				authenticate($username, $email);
			}
			
			$conn->close();
		}

		$result["error"] = $error;
		echo json_encode($result);
		exit();
	}

?>

<?php
	require_once './header.php';
?>

<div class="main-view register-bg centered">
	<div class="container-fluid">
				<form class="form-horizontal main-form fadein">
					<div class="form-group gray-bold">
						<h2>&nbsp; Register</h2>
						<br>
						<div class="col-sm-4 col-sm-offset-4 well">
							<div class="col-sm-12 input-icon">
								<input id="username" type="text" class="form-control" placeholder="Username">
								<i class="fas fa-user"></i>
							</div>
							<br><br>
							<div class="col-sm-12 input-icon">
								<input id="email" type="text" class="form-control" placeholder="Email">
								<i class="fas fa-at"></i>
							</div>
							<br><br>
							<div class="col-sm-12 input-icon">
								<input id="password1" type="password" class="form-control" placeholder="Password">
								<i class="fas fa-key"></i>
							</div>
							<br><br>
							<div class="col-sm-12 input-icon">
								<input id="password2" type="password" class="form-control" placeholder="Repeat password">
								<i class="fas fa-key"></i>
							</div>
							<br><br>
								<button id="register" class="btn btn-success ">
									Register
								</button>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div id="error" class="alert alert-danger" style="display:none;">
							<br>
						</div>
					</div>
				</div>
	</div>
</div>

<?php
	require_once "./footer.php";
?>

<script type="text/javascript" src="/js/validator.js"></script>
<script type="text/javascript" src="/js/register.js"></script>

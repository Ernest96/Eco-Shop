<?php
	require_once "./login.php";

	session_start();

	if (isset($_SESSION["username"]))
	{
		reset_session();
	}

	header("Location: /");
?>
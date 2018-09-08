<?php
	$hn = 'localhost';
	$db = 'db_name';
	$un = 'root';
	$pw = 'password';

	function mysql_fix_string($conn, $string)
	{
		if (get_magic_quotes_gpc())
		{
			$string = stripslashes($string);
		}

		return htmlentities($conn->real_escape_string($string));
	}

	function authenticate($username, $email)
	{
		if (session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}

		$_SESSION = array();
		$_SESSION["username"] = $username;
		$_SESSION["email"] = $email;
	}

	function reset_session()
	{
		if (session_status() == PHP_SESSION_NONE)
			session_start();

		$_SESSION = array();
		session_unset();
		session_destroy();
	}

	function is_authenticated()
	{
		if (session_status() == PHP_SESSION_NONE)
			session_start();

		if (isset($_SESSION["username"]))
			return true;
		else
			return false;
	}

	function is_admin()
	{
		if (session_status() == PHP_SESSION_NONE)
			session_start();

		if (isset($_SESSION["username"]))
		{
			if ($_SESSION["username"] == "admin")
				return true;
		}
		else
			return false;
	}
?>
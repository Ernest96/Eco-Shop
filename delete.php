<?php
	require_once "./header.php";
	require_once "./login.php";

	if (!is_admin())
	{
		header("Location: /");
		exit();
	}
	
	$id = -1;
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error)
	{
		echo 'Could not connect to database. Contact administration';
	}
	else
	{
		if (isset($_POST["id"]))
		{
			$id = mysql_fix_string($conn, $_POST["id"]);
			$query = "DELETE FROM product WHERE id=$id LIMIT 1;";
			$result = $conn->query($query);
			$conn->close();
			header("Location: /market.php");
		}
		if (isset($_GET["id"]))
		{
			$id = mysql_fix_string($conn, $_GET["id"]);
			echo <<< _END
			<br><br><h2 class='centered'>Are you sure you want to delete product with id $id ?
			<form action="delete.php" method="post">
				<input type="hidden" name="id" value="$id">
				<br>
				<button type="submit" class="btn btn-danger"> Delete </button>
			</form>
_END;
		}
	}
	$conn->close();
?>
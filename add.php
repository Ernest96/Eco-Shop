<?php
	require_once "./header.php";
	require_once "./login.php";

	$error = '';
	if (!is_admin())
	{
		header("Location: /");
		exit();
	}

	if (isset($_POST["name"]))
	{
		$name = $_POST["name"];
		$price = $_POST["price"];
		$distributor = $_POST["distributor"];
		$img_link = $_POST["img_link"];
		$contact = $_POST["contact"];
		$description = $_POST["description"];

		if (ctype_space($name) || 
			strlen($name) == 0 ||
			strlen($name) > 22)
		{
			$error .= "Product name is in invalid form (empty or too long)<br>";
		}
		if (ctype_space($contact) || 
			strlen($contact) == 0 ||
			strlen($contact) > 50 ||
			preg_match('/[^0-9+ ]/', $contact))
		{
			$error .= "Product contact is in invalid form (empty,too long or contains invalid characters)<br>";
		}
		if (ctype_space($distributor) || 
			strlen($distributor) > 50)
		{
			$error .= "Product contact is in invalid form (empty or too long)<br>";
		}

		if (!$error)
		{
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error)
			{
				$error = 'Could not connect to database. Contact administration';
			}
			else
			{
				$insert = $conn->prepare('INSERT into product VALUES(?,?,?,?,?,?,?);');
				$insert->bind_param('isdssss', $id, $name, $price, $img_link, $description, $contact, $distributor);
				$insert->execute();
				if ($insert->affected_rows != 1)
				{
					$error .= "Error in inserting data";
				}
				$insert->close();
				$conn->close();
			}
			
		}
		
	}
?>

<div class="main-view centered">
	<div class="container-fluid">
		<form action="add.php" method="post" class="form-horizontal main-form fadein">
			<div class="form-group gray-bold">
				<h2>Add product</h2>
				<br>
				<div class="col-sm-4 col-sm-offset-4 well">
					<div class="col-sm-12 input-icon">
						<input name="name" type="text" class="form-control" placeholder="Product name">
						<i class="fab fa-product-hunt"></i>
					</div>
					<br><br>
					<div class="col-sm-12 input-icon">
						<input name="price" type="text" class="form-control" placeholder="Price">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<br><br>
					<div class="col-sm-12 input-icon">
						<input name="contact" type="text" class="form-control" placeholder="Contact phone">
						<i class="fas fa-phone-volume"></i>
					</div>
					<br><br>
					<div class="col-sm-12 input-icon">
						<input name="distributor" type="text" class="form-control" placeholder="Distributor">
						<i class="fas fa-address-card"></i>
					</div>
					<br><br>
					<div class="col-sm-12 input-icon">
						<input name="img_link" type="text" class="form-control" placeholder="Image URL">
						<i class="fas fa-image"></i>
					</div>
					<br><br>
					<div class="col-sm-12">
						<textarea placeholder="Description" class="form-control" rows="4" name="description"></textarea>
					</div>
					<button id="register" class="btn btn-success" style="margin-top: 10px">
							Add
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
	if ($error)
	{
		printf('<script> $("#error").show(); $("#error").html("%s") </script>',$error);
	}
?>
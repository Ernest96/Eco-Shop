<?php
	require_once "./header.php";
	require_once "./login.php";

	$error = '';
	if (!is_admin())
	{
		header("Location: /");
		exit();
	}

	if (isset($_POST["id"]))
	{
		$id = $_POST["id"];
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
				$update = $conn->prepare('UPDATE product SET' . 
						' name = ?, price = ?, img_link = ?, description = ?, contact = ?, distributor = ? WHERE id = ?;');
				$update->bind_param('sdssssi',  $name, $price, $img_link, $description, $contact, $distributor, $id);
				$update->execute();
				if ($update->affected_rows != 1)
				{
					$error .= "Error in updating data";
				}
				$update->close();
				$conn->close();
			}
		}
	}

?>

<div class="main-view centered">
	<div class="container-fluid">
		<form action="edit.php" method="post" class="form-horizontal main-form fadein">
			<div class="form-group gray-bold">
				<?php
					$conn = new mysqli($hn, $un, $pw, $db);
					if ($conn->connect_error)
					{
						echo 'Could not connect to database. Contact administration';
					}
					else
					{
						$id = -1;
						if (isset($_GET["id"]))
						{
							$id = mysql_fix_string($conn, $_GET["id"]);
						}
						else if (isset($_POST["id"]))
						{
							$id = mysql_fix_string($conn, $_POST["id"]);
						}
						else
						{
							header("Location: /");
							exit();
						}

						$query = 'SELECT * FROM product WHERE id = ' . $id .';';
						$result = $conn->query($query);
						$rows = $result->num_rows;

						if ($rows > 0)
						{
							$product= $result->fetch_array(MYSQLI_ASSOC);
							$name = $product["name"];
							$img_link = $product["img_link"];
							$price = $product["price"];
							$description = $product["description"];
							$id = $product["id"];
							$contact = $product["contact"];
							$distributor = $product["distributor"];

							echo <<< _END
							<h2>Edit product <a href="/product.php?id=$id">(id = $id)</a></h2>
							<br>
							<div class="col-sm-4 col-sm-offset-4 well">
								<div class="col-sm-12 input-icon">
									<input name="name" type="text" class="form-control" placeholder="Product name" value="$name">
									<i class="fab fa-product-hunt"></i>
								</div>
								<br><br>
								<div class="col-sm-12 input-icon">
									<input name="price" type="text" class="form-control" placeholder="Price" value="$price">
									<i class="fas fa-dollar-sign"></i>
								</div>
								<br><br>
								<div class="col-sm-12 input-icon">
									<input name="contact" type="text" class="form-control" placeholder="Contact phone" value="$contact">
									<i class="fas fa-phone-volume"></i>
								</div>
								<br><br>
								<div class="col-sm-12 input-icon">
									<input name="distributor" type="text" class="form-control" placeholder="Distributor" value="$distributor">
									<i class="fas fa-address-card"></i>
								</div>
								<br><br>
								<div class="col-sm-12 input-icon">
									<input name="img_link" type="text" class="form-control" placeholder="Image URL" value="$img_link">
									<i class="fas fa-image"></i>
								</div>
								<br><br>
								<div class="col-sm-12">
									<textarea placeholder="Description" class="form-control" rows="4" name="description">
									$description</textarea>
								</div>
								<input type="hidden" name="id" value="$id">
								<button id="register" class="btn btn-success" style="margin-top: 10px">
										Confirm
								</button>
							</div>			
_END;
						}
						else
						{
							echo "<h5 class='centered gray-bold'>No product with such an id</h5>";
						}
						
					}
				?>			
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
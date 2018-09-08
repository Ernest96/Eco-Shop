<?php
	require_once "./header.php";
	require_once "./login.php";
?>

<div class="main-view">
	<div class="container">
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
							if ($id == NULL)
							{
								header("Location: /");
								exit();
							}
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
							<h2 class="centered">$name</h2>
							<hr>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-3">
									<div align="center">
										<img class="fadein img-responsive product-img" src="$img_link">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3">
									<br>
									<div class="product-about">
										<i class="fas fa-phone-volume"></i>
										<b>Contact: </b> $contact
										<br> <br>
										<i class="fas fa-address-card"></i>
										<b>Distributor: </b> $distributor
										<br><br>
										<i class="fas fa-dollar-sign"></i>
										<b>Price: </b> $price $/kg
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 justified">
								<hr>
									<p>
										 $description
									</p>
								</div>
							</div>

_END;
							if (is_admin())
							{
								echo <<< _END
								<div class="row">
									<div class="col-xs-12 centered">
										<a class="btn btn-default" href="/edit.php?id=$id">Edit</a> 
										<a class="btn btn-danger" href="/delete.php?id=$id">Delete</a> 
									</div>
								</div>
_END;
							}
						}
						else
						{
							echo "<h5 class='centered gray-bold'>No product with such an id</h5>";
						}
						
					}
				?>
	</div>
</div>
<?php
	require_once "./footer.php";
?>
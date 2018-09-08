<?php
	require_once "header.php";
	require_once "login.php";
?>
<div class="main-view">
	<div class="container">
		<h1 class="centered">Market</h1>
		<br>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 input-icon">
			<form>
				<input name="search" placeholder="Search..." type="text" class="form-control">
				<i class="fas fa-search"></i>
			</form>
			</div>
		</div>
		<br><br>
				<?php
					$conn = new mysqli($hn, $un, $pw, $db);
					if ($conn->connect_error)
					{
						echo 'Could not connect to database. Contact administration';
					}
					else
					{
						$search = "";
						if (isset($_GET["search"]))
						{
							$search = mysql_fix_string($conn, $_GET["search"]);
						}

						$query = 'SELECT * FROM product WHERE name LIKE "%'. $search .'%";';
						$result = $conn->query($query);
						$rows = $result->num_rows;

						if ($rows > 0)
						{
							for ($j = 0; $j < $rows; ++$j)
							{
								$result->data_seek($j);
								$row = $result->fetch_array(MYSQLI_ASSOC);
								$name = $row["name"];
								$img_link = $row["img_link"];
								$price = $row["price"];
								$id = $row["id"];
								$distributor = $row["distributor"];

								echo <<< _END
								<div class="col-xs-12 col-sm-4 col-lg-3">
								<a href="/product.php?id=$id" class="product-link">
									<div class="product">
											<h4>$name</h4>
											<img class="market-img img-responsive" src="$img_link">
										<div class="about-market">
											<h6>$price $/kg</h6>
											<h6>$distributor</h6>
										</div>
									</div>
								</a>
								</div>

_END;
							}
						}
						else
						{
							echo "<h5 class='centered gray-bold'>No products</h5>";
						}
						if (is_admin())
						{
							echo <<< _END
							<div class="row">
									<div class="col-xs-12 centered">
										<br><br>
										<a class="btn btn-success" href="/add.php">Add product</a> 
									</div>
							</div>
_END;
						}
						$conn->close();
					}
				?>
	</div>
</div>
<?php
	require_once "footer.php";
?>
<html><head><title>Confirm Product Update</title></head>
<body>
<?php
	$admin_pass = $_POST["Admin_ID"];
	$item_ID = $_POST["Product_ID"];
	$item_name = $_POST["Product_Name"];
	$item_details = $_POST["Details"];
	@$item_color = @$_POST["Color"];
	@$item_size = @$_POST["Size"];
	$item_price = $_POST["Base_Price"];
	$item_stock = $_POST["Stock"];

	include("credentials.php");

	try
	{
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}

	// Update DB entry
	$update_rs = $pdo->prepare("UPDATE Product SET 
		Product_Name = :Product_Name,
		Details = :Details,
		Color = :Color,
		Size = :Size,
		Base_Price = :Base_Price,
		Stock = :Stock

		WHERE Product_ID = :Product_ID;");

	$update_rs->execute(array(
		":Product_Name" => $item_name,
		":Details" => $item_details,
		":Color" => @$item_color,
		":Size" => @$item_size,
		":Base_Price" => $item_price,
		":Stock" => $item_stock,
		":Product_ID" => $item_ID));


	echo "The product has been updated with the following data: <br />";

	// Print table with new data
	echo "<table border=2 cellspacing=2>";

	echo "<tr><td><b>Product ID</b></td>";
	echo "<td>" . $item_ID . "</td></tr>";

	echo "<tr><td><b>Product Name</b></td>";
	echo "<td>" . $item_name . "</td></tr>";

	echo "<tr><td><b>Details</b></td>";
	echo "<td>" . $item_details . "</td></tr>";

	echo "<tr><td><b>Color</b></td>";
	echo "<td>" . $item_color . "</td></tr>";

	echo "<tr><td><b>Size</b></td>";
	echo "<td>" . $item_size . "</td></tr>";

	echo "<tr><td><b>Price</b></td>";
	echo "<td>" . $item_price . "</td></tr>";

	echo "<tr><td><b>Stock</b></td>";
	echo "<td>" . $item_stock . "</td></tr>";

	// Button to go back
	echo "<form action=\"manage_inventory.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Admin_ID\" value=\"" . @$admin_pass . "\"/>";
	echo "<input type=\"submit\" value=\"OK\" />";
	echo "</form>";
?>
</body>
</html>

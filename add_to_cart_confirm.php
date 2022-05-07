<html><head><title>Add to Cart</head></title>
<body>
<?php

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

	// Home button
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";
	
	@$item_size = $_POST["Size"];
	@$item_color = $_POST["Color"];
	$item_quantity = $_POST["Quantity"];
	$C_ID = $_POST["Customer_ID"];
	$item_ID = $_POST["Product_ID"];
	$item_name = $_POST["Product_Name"];

	// Print out item info
	echo "Confirm addition to cart<br />";
	echo $item_quantity . " x " . $item_name . "<br />";

	// Print size if applicable
	if(@$item_size != NULL)
	{
		echo "Size: " . @$item_size . "<br />";
	}

	// Print color if applicable
	if(@$item_color != NULL)
	{
		echo "Color: " . @$item_color . "<br />";
	}

	echo "<br />";

	// Search for correct ID if color or size are applicable
	if(@$item_size || @$item_color)
	{
		// Search if only size applies
		if(@$item_size && !@$item_color)
		{
			$item_ID_rs = $pdo->prepare("SELECT Product_ID FROM Product WHERE Product_Name = :Product_Name AND Size = :Size;");
			$item_ID_rs->execute(array(":Product_Name" => $item_name, ":Size" => @$item_size));
			$item_ID = $item_ID_rs->fetch(PDO::FETCH_ASSOC);
		}

		// Search if only color applies
		if(@$item_color && !@$item_size)
		{
			$item_ID_rs = $pdo->prepare("SELECT Product_ID FROM Product WHERE Product_Name = :Product_Name AND Color = :Color;");
			$item_ID_rs->execute(array(":Product_Name" => $item_name, ":Color" => @$item_color));
			$item_ID = $item_ID_rs->fetch(PDO::FETCH_ASSOC);
		}

		// Search if both apply
		if(@$item_color && @$item_size)
		{
			$item_ID_rs = $pdo->prepare("SELECT Product_ID FROM Product WHERE Product_Name = :Product_Name AND (Size = :Size AND Color = :Color);");
			$item_ID_rs->execute(array(":Product_Name" => $item_name, ":Size" => @$item_size, ":Color" => @$item_color));
			$item_ID = $item_ID_rs->fetch(PDO::FETCH_ASSOC);
		}
	}
	else
	{
		// Search if none apply
		$item_ID_rs = $pdo->prepare("SELECT Product_ID FROM Product WHERE Product_Name = :Product_Name;");
		$item_ID_rs->execute(array(":Product_Name" => $item_name));
		$item_ID = $item_ID_rs->fetch(PDO::FETCH_ASSOC);
	}


	// Submit here
	echo "<form action=\"shopping_cart.php\" method=\"POST\">";

	// Data to pass
	echo "<input type=\"hidden\" name=\"Quantity\" value=\"" . $item_quantity . "\" />";
	echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item_ID["Product_ID"] . "\" />";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID . "\" />";

	echo "<input type=\"submit\" value=\"Confirm\">";

	echo "</form>";
?>
</body>
</html>

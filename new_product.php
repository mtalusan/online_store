<html><head><title>New Product Added</title></head>
<body>
<?php
	@$admin_pass = @$_POST["Admin_ID"];
	if(@$admin_pass != "admin")
	{
		echo "Incorrect ID, please enter \"admin\" in the employee logon screen<br />";
		echo "<form action=\"admin_logon.php\" method=\"POST\">";
		echo "<input type=\"submit\" value=\"Back\" />";
		echo "</form>";
	}
	else
	{
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


		$item_name = $_POST["Product_Name"];
		$item_details = $_POST["Details"];
		@$item_size = @$_POST["Size"];
		@$item_color = @$_POST["Color"];
		$item_price = $_POST["Base_Price"];
		$item_stock = $_POST["Stock"];

		// Submit new product to Product DB
		if(@$item_size != NULL && @$item_color != NULL)
		{
			// Case if the product has both size and color
			$insert_rs = $pdo->prepare("INSERT INTO Product (Product_Name, Details, Size, Color, Base_Price, Stock) VALUES (:Product_Name, :Details, :Size, :Color, :Base_Price, :Stock);");
			$insert_rs->execute(array(":Product_Name" => $item_name, ":Details" => $item_details, ":Size" => @$item_size, ":Color" => @$item_color, ":Base_Price" => $item_price, ":Stock" => $item_stock));
		}
		else if(@$item_size != NULL && @$item_color == NULL)
		{
			// Case if the product has size but no color
			$insert_rs = $pdo->prepare("INSERT INTO Product (Product_Name, Details, Size, Base_Price, Stock) VALUES (:Product_Name, :Details, :Size, :Base_Price, :Stock);");
			$insert_rs->execute(array(":Product_Name" => $item_name, ":Details" => $item_details, ":Size" => @$item_size, ":Base_Price" => $item_price, ":Stock" => $item_stock));
		}
		else if(@$item_size == NULL && @$item_color != NULL)
		{
			// Case if the product has color but no size
			$insert_rs = $pdo->prepare("INSERT INTO Product (Product_Name, Details, Color, Base_Price, Stock) VALUES (:Product_Name, :Details, :Color, :Base_Price, :Stock);");
			$insert_rs->execute(array(":Product_Name" => $item_name, ":Details" => $item_details, ":Color" => @$item_color, ":Base_Price" => $item_price, ":Stock" => $item_stock));
		}
		else if(@$item_size == NULL && @$item_color == NULL)
		{
			// Case if the product has neither color nor size
			$insert_rs = $pdo->prepare("INSERT INTO Product (Product_Name, Details, Base_Price, Stock) VALUES (:Product_Name, :Details, :Base_Price, :Stock);");
			$insert_rs->execute(array(":Product_Name" => $item_name, ":Details" => $item_details, ":Base_Price" => $item_price, ":Stock" => $item_stock));
		}


		// Print information about the item added
		echo "This item has been added to the inventory:";
		echo "<table border=2 cellspacing=2";

		echo "<tr><td><b>Product Name</b></td>";
		echo "<td>" . $item_name . "</td></tr>";

		echo "<tr><td><b>Details</b></td>";
		echo "<td>" . $item_details . "</td></tr>";

		echo "<tr><td><b>Base Price</b></td>";
		echo "<td>" . $item_price . "</td></tr>";

		echo "<tr><td><b>Stock</b></td>";
		echo "<td>" . $item_stock . "</td></tr>";

		// Printing size if applicable
		echo "<tr><td><b>Size</b></td>";
		if(@$item_size != NULL)
		{
			echo "<td>" . $item_size . "</td>";
		}
		else
		{
			echo "<td>N/A<td>";
		}

		// Printing color if applicable
		echo "<tr><td><b>Color</b></td>";
		if(@$item_color != NULL)
		{
			echo "<td>" . $item_color . "</td>";
		}
		else
		{
			echo "<td>N/A<td>";
		}
		echo "</tr></table>";


		// Button to go back to inventory management
		echo "<form action=\"manage_inventory.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"Admin_ID\" value=\"" . @$admin_pass . "\"/>";
		echo "<input type=\"submit\" value=\"Return to Inventory Management\" />";
		echo "</form>";
	}
?>
</body>
</html>

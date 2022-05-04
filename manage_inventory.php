<html><head><title>Manage Inventory</title></head>
<body>
	<a href="index.php">Home</a><br />
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

		// Get all inventory
		$inventory_rs = $pdo->query("SELECT * FROM Product");
		$inventory = $inventory_rs->fetchAll(PDO::FETCH_ASSOC);

		// Get out of stock inventory
		$oos_rs = $pdo->query("SELECT * FROM Product WHERE Stock = 0;");
		$oos = $oos_rs->fetchAll(PDO::FETCH_ASSOC);


		// Print any items that are oos if there are any
		if($oos)
		{
			// Print all items that are out of stock
			echo "These products are out of stock:<br />";
			foreach($oos as $item)
			{
				echo "<table border=2 cellspacing=2>";
				echo "<tr><th>Product ID</th><th>Product Name</th></tr>";
				echo "<tr><td>" . $item["Product_ID"] . "</td><td>" . $item["Product_Name"] . "</td></tr>";
			}

			echo "</table><br /><br/>";
		}
		else
		{
			echo "There are currently no products that are out of stock<br /><br />";
		}


		// Create new products to add to the store page
		echo "<u>Add A New Product</u>";
		echo "<form action=\"new_product.php\" method=\"POST\">";

		echo "Product Name:<br />";
		echo "<input type=\"text\" name=\"Product_Name\"/><br />";

		echo "Details:<br />";
		echo "<input type=\"text\" name=\"Details\"/><br />";

		echo "Size:<br />";
		echo "<input type=\"text\" name=\"Size\"/><br />";

		echo "Color:<br />";
		echo "<input type=\"text\" name=\"Color\"/><br />";

		echo "Price:<br />";
		echo "<input type=\"text\" name=\"Base_Price\"/><br />";

		echo "Stock:<br />";
		echo "<input type=\"text\" name=\"Stock\"/><br />";

		echo "<input type=\"submit\" value=\"Add to Inventory\" />";
		echo "</form><br /><br />";

		// Print info about product and a field to change item attributes
		foreach($inventory as $item_info)
		{
			echo "<table border=2 cellspacing=2>";
			echo "<tr><td><b>Product ID</b></td>";
			echo "<td>" . $item_info["Product_ID"] . "</td></tr>";
			echo "<tr><td><b>Product Name</b></td>";
			echo "<td>" . $item_info["Product_Name"] . "</td></tr>";
			echo "<tr><td><b>Details</b></td>";
			echo "<td>" . $item_info["Details"] . "</td></tr>";
			echo "<tr><td><b>Price</b></td>";
			echo "<td>" . $item_info["Base_Price"] . "</td></tr>";
			echo "<tr><td><b>Stock</b></td>";
			echo "<td>" . $item_info["Stock"] . "</td></tr>";
			
			// Checking if size is applicable and printing if so
			echo "<tr><td><b>Sizes</b></td>";
			if($item_info["Size"] != NULL)
			{
				echo "<td>" . $item_info["Size"] . "</td></tr>";
			}
			else
			{
				echo "<td>N/A</td></tr>";
			}


			// Checking if color is applicable and printing if so
			echo "<tr><td><b>Color</b></td>";
			if($item_info["Color"] != NULL)
			{
				echo "<td>" . $item_info["Color"] . "</td></tr>";
			}
			else
			{
				echo "<td>N/A</td></tr>";
			}

			echo "</table>";


			// Print empty data cells that will allow for employee to change 
			// attributes about the product
			echo "<form action=\"edit_item.php\" method=\"POST\">";
			echo "<table border=2 cellspacing=2>";

			echo "<tr><td><b>Product ID</b></td>";
			echo "<td><input type=\"text\" name=\"Product_ID\"/></td></tr>";

			echo "<tr><td><b>Product Name</b></td>";
			echo "<td><input type=\"text\" name=\"Product_Name\"/></td></tr>";

			echo "<tr><td><b>Details</b></td>";
			echo "<td><input type=\"text\" name=\"Details\"/></td></tr>";

			echo "<tr><td><b>Color</b></td>";
			echo "<td><input type=\"text\" name=\"Color\"/></td></tr>";

			echo "<tr><td><b>Size</b></td>";
			echo "<td><input type=\"text\" name=\"Size\"/></td></tr>";

			echo "<tr><td><b>Price</b></td>";
			echo "<td><input type=\"text\" name=\"Base_Price\"/></td></tr>";

			echo "<tr><td><b>Stock</b></td>";
			echo "<td><input type=\"text\" name=\"Stock\"/></td></tr>";

			echo "<input type=\"submit\" value=\"Update\"/>";
			echo "</form><br />";
		}


	}
?>
</body>
</html>

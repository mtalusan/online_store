<html>
<?php
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";

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

	$item_ID = $_POST["Product_ID"];
	@$C_ID = @$_POST["Customer_ID"];

	// Get item information
	$item_info_rs = $pdo->prepare("SELECT * FROM Product WHERE Product_ID = :item;");
	$item_info_rs->execute(array(":item" => $item_ID));
	$item_info = $item_info_rs->fetch(PDO::FETCH_ASSOC);

	// Item's name in the tab's name
	echo "<head><title>" . $item_info["Product_Name"] . "</title></head>";
	echo "<body>";

	// Print item details
	echo "<table border=2 cellspacing=2>";
	echo "<tr><td><b>Product Name</b></td>";
	echo "<td>" . $item_info["Product_Name"] . "</td></tr>";
	echo "<tr><td><b>Details</b></td>";
	echo "<td>" . $item_info["Details"] . "</td></tr>";
	echo "<tr><td><b>Price</b></td>";
	echo "<td>" . $item_info["Base_Price"] . "</td></tr>";


	// Checking if size are applicable and printing if so
	echo "<tr><td><b>Sizes</b></td>";
	if($item_info["Size"] != NULL)
	{
		// Run another query if there is size
		$item_sizes_rs = $pdo->prepare("SELECT Size FROM Product WHERE Product_Name = :item_name;");
		$item_sizes_rs->execute(array(":item_name" => $item_info["Product_Name"]));
		$item_sizes = $item_sizes_rs->fetchAll(PDO::FETCH_ASSOC);

		// Print sizes
		echo "<td>";
		foreach($item_sizes as $item_size)
		{
			echo $item_size["Size"] . "<br />";
		}
		echo "</td></tr>";
	}
	else
	{
		echo "<td>N/A</td></tr>";
	}


	// Checking color if applicable and printing if so
	echo "<tr><td><b>Colors</b></td>";
	if($item_info["Color"] != NULL)
	{
		// Run another query if there is color
		$item_colors_rs = $pdo->prepare("SELECT Color FROM Product WHERE Product_Name = :item_name;");
		$item_colors_rs->execute(array(":item_name" => $item_info["Product_Name"]));
		$item_colors = $item_colors_rs->fetchAll(PDO::FETCH_ASSOC);

		echo "<td>";

		// Print colors
		$previous_color = NULL;
		foreach($item_colors as $item_color)
		{
			if($item_color["Color"] != $previous_color)
			{
				echo $item_color["Color"] . "<br />";
				$previous_color = $item_color["Color"];
			}
			else
			{
				continue;
			}
		}
		echo "</td></tr>";
	}
	else
	{
		echo "<td>N/A</td></tr>";
	}


	// Select quantity, size or color options to submit to car
	// Pass Product_Name, Customer_ID, and Product_ID
	echo "<form action=\"add_to_cart_confirm.php\" method=\"POST\">";

	// Select size
	if($item_info["Size"] != NULL)
	{
		echo "<select name=\"Size\">";
		foreach($item_sizes as $item_size)
		{
			echo "<option>" . $item_size["Size"] . "</option>";
		}
		echo "</select><br />";
	}

	// Select Color
	$previous_item = NULL;
	if($item_info["Color"] != NULL)
	{
		echo "<select name=\"Color\">";
		foreach($item_colors as $item_color)
		{
			echo "<option>" . $item_color["Color"] . "</option>";
			$previous_item = $item_color["Color"];
		}
		echo "</select><br />";
	}

	// Enter quantity
	echo "<input type=\"text\" name=\"Quantity\" value=\"Enter Quantity Here\"/><br />";

	// Pass Customer_ID if known
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . @$C_ID . "\"/>";

	// Pass Product_ID
	echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item_info["Product_ID"] . "\"/>";

	// Pass Product_Name
	echo "<input type=\"hidden\" name=\"Product_Name\" value=\"" . $item_info["Product_Name"] . "\"/>";

	echo "<input type=\"submit\" value=\"Add to Cart\"/>";

	echo "</form>";
	echo "</body>";

?>
</html>

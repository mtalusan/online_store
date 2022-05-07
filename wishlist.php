<html><head><title>Your Wishlist</title></head>
<body>
<?php
	// Create a button back to the home page that passes the
	// Customer_ID
	
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

	@$item_ID = @$_POST["Product_ID"];
	@$remove_item_ID = @$_POST["remove_item_ID"];
	$C_ID = $_POST["Customer_ID"];

	// If remove_item_ID was passed to this page
	// remove the item from the wishlist
	if(@$remove_item_ID)
	{
		$remove_rs = $pdo->prepare("DELETE FROM Wishlist WHERE Product_ID = :Product_ID AND Customer_ID = :Customer_ID");
		$remove_rs->execute(array(":Product_ID" => @$remove_item_ID, ":Customer_ID" => $C_ID));
	}

	// If this page was passed an item_ID, check if it's already wishlisted
	// and add it to the wishlist if it isn't
	if(@$item_ID != NULL)
	{
		// Check if its already on the list
		// This is pretty much a copy of the query done below
		// that fills the table bc the wishlist at this point
		// doesn't have the new item that was submitted to be added
		$item_check_rs = $pdo->prepare("SELECT * FROM Wishlist WHERE Customer_ID = :Customer_ID AND Product_ID = :Product_ID;");
		$item_check_rs->execute(array(":Customer_ID" => $C_ID, ":Product_ID" => @$item_ID));
		$item_check = $item_check_rs->fetchALL(PDO::FETCH_ASSOC);

		if(!$item_check)
		{
			$add_rs = $pdo->prepare("INSERT INTO Wishlist (Product_ID, Customer_ID) VALUES(:item_ID, :Customer_ID);");
			$add_rs->execute(array(":item_ID" => @$item_ID, ":Customer_ID" => $C_ID));
		}
	}

	// Fetch the customer's wishlist
	$item_ID_list_rs = $pdo->prepare("SELECT * FROM Wishlist WHERE Customer_ID = :Customer_ID;");
	$item_ID_list_rs->execute(array(":Customer_ID" => $C_ID));
	$item_ID_list = $item_ID_list_rs->fetchALL(PDO::FETCH_ASSOC);

	// Print items on wishlist if any
	if($item_ID_list)
	{
		echo "<table border=2 cellspacing=2>";
		echo "<tr><th>Product Name</th>";
		echo "<th>Link to Store Page</th>";
		echo "<th>Remove from Wishlist</th></tr>";

		foreach($item_ID_list as $item)
		{
			// Run second query to get Product_Name
			$item_name_rs = $pdo->prepare("SELECT Product_Name FROM Product WHERE Product_ID = :Product_ID");
			$item_name_rs->execute(array(":Product_ID" => $item["Product_ID"]));
			$item_name = $item_name_rs->fetch(PDO::FETCH_ASSOC);

			// Print Product_Name, link to item_page.php, and button
			// to remove item from wishlist
			echo "<tr><td>" . $item_name["Product_Name"] . "</td>";

			// Link to store page
			echo "<td><form action=\"item_page.php\" method=\"POST\">";
			echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item["Product_ID"] . "\"/>";
			echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID . "\"/>";
			echo "<input type=\"submit\" value=\"Buy\"/>";
			echo "</td></form>";

			// Remove this item from wishlist button
			echo "<td><form action=\"wishlist.php\" method=\"POST\">";
			echo "<input type=\"hidden\" name=\"remove_item_ID\" value=\"" . $item["Product_ID"] . "\"/>";
			echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID . "\"/>";
			echo "<input type=\"submit\" value=\"Remove from List\"/>";
			echo "</td></form>";
			echo "</tr>";
		}

		echo "</table>";
	}
	else
	{
		// If they aren't watching any products
		echo "You aren't currently watching any products";
	}
?>
</body>
</html>

<html><head><title>Add to Cart</head></title>
<body>
<a href= "index.php">Home</a><br />
<?php
/**
 * Used to query for additional product info, but am now
 * using the queries from item_page and then passing the 
 * info I need to this page
	include("credentials.php")
	
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
 */
	
	@$item_size = $_POST["Size"];
	@$item_color = $_POST["Color"];
	$item_quantity = $_POST["Quantity"];
	@$C_ID = $_POST["Customer_ID"];
	$item_ID = $_POST["Product_ID"];
	$item_name = $_POST["Product_Name"];

	// Print out info
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

	// Submit here
	echo "<form action=\"shopping_cart.php\" method=\"POST\">";

	// Enter Customer_ID if not already known
	if(@$C_ID == NULL)
	{
		echo "Please enter your Customer_ID/Username<br />";
		echo "<input type=\"text\" name=\"Customer_ID\" /><br />";
		echo "<input type=\"hidden\" name=\"Size\" value=\"" . $item_size . "\" />";
		echo "<input type=\"hidden\" name=\"Color\" value=\"" . $item_color . "\" />";
		echo "<input type=\"hidden\" name=\"Quantity\" value=\"" . $item_quantity . "\" />";
		echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item_ID . "\" />";
	}
	else
	{
		echo "<input type=\"hidden\" name=\"Size\" value=\"" . $item_size . "\" />";
		echo "<input type=\"hidden\" name=\"Color\" value=\"" . $item_color . "\" />";
		echo "<input type=\"hidden\" name=\"Quantity\" value=\"" . $item_quantity . "\" />";
		echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item_ID . "\" />";
		echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID . "\" />";

	}

	echo "<input type=\"submit\" value=\"Confirm\">";

	echo "</form>";
?>
</body>
</html>

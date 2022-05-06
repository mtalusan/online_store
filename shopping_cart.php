<html><head><title>Shopping Cart</title></head><body><pre>
<?php
	$C_ID = $_POST["Customer_ID"];

	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";

	$Product_ID = $_POST["Product_ID"];
	$Quantity = $_POST["Quantity"];

	include("secrets.php");

	$dsn = "mysql:host=courses;dbname=z1960742";
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	// Add to cart
	if($Quantity)
	{
		$sql = "UPDATE Shopping_Cart SET Quantity = ? WHERE Product_ID = ? ANd Customer_ID = ?";		
			
	//	$sql = "INSERT INTO Shopping_Cart (Product_ID, Customer_ID, Quantity) VALUES (?, ?, ?)";
		$stmt= $pdo->prepare($sql);
		$stmt->execute(array($Quantity, $Product_ID, $C_ID));
	}
	else if($Product_ID)
	{
		// Remove from cart
		$remove_rs = $pdo->prepare("DELETE FROM Shopping Cart WHERE Customer_ID = :Customer_ID AND Product_ID = :Product_ID");
		$remove_rs->execute(array(":Customer_ID" => $C_ID, ":Product_ID" => $Product_ID));
		echo $Product_ID . " was removed from the shopping cart due to shortage in stock quantity";

	}

	// Print Table
	$shopping_cart_rs = $pdo->prepare("SELECT * FROM Shopping_Cart WHERE Customer_ID = :Customer_ID");
	$shopping_cart_rs->execute(array(":Customer_ID" => $C_ID));
	$shopping_cart = $shopping_cart_rs->fetchAll(PDO::FETCH_ASSOC);
	
	echo "Your shopping cart<br />";
	echo "<table border=2 cellspacing=3>";
//	echo "<tr><th>Product ID</th>";
//	echo "<th>Quantity</th>";

	foreach($shopping_cart as $row)
	{	
		echo "<tr>";
		foreach($row as $item)
		{
			echo "<td>$item</td>";
		}

/*		echo "<td><form action=\"shopping_cart.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item['Product_ID'] . "\"/>";
		echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID. "\"/>";
		echo "<input type=\"submit\" value=\"Remove\"/>";
		echo "</form></td></tr>";
 */		echo "</tr>";		
	}
	echo "</table>";


	echo "<form action=\"checkout.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST['Customer_ID'] . "\"/>";
	echo "<input type=\"submit\" value=\"Checkout\"/>";
	echo "</form><br /><br />";

?>

</pre></body></html>

<?php

	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";


	$customer_id = $_POST["Customer_ID"];
	@$product_id = $_POST["Product_ID"];
	@$quantity = @$_POST['Quantity'];

	include("credentials.php");

	$dsn = "mysql:host=courses;dbname=z1714949";
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	
	// Add to cart
	if(@$quantity)
	{
		$sql = "INSERT INTO Shopping_Cart (Product_ID, Customer_ID, Quantity) VALUES (:Product_ID, :Customer_ID, :Quantity)";
		$stmt= $pdo->prepare($sql);
		$stmt->execute(array(':Product_ID' => @$product_id, ':Customer_ID' => $customer_id, ':Quantity'=> @$quantity));
	}
	else if(@$product_id)
	{
		// Remove from cart
		$remove_rs = $pdo->prepare("DELETE FROM Shopping_Cart WHERE Customer_ID = :Customer_ID AND Product_ID = :Product_ID;");
		$remove_rs->execute(array(":Customer_ID" => $customer_id, ":Product_ID" => @$product_id));

	}

	// Print Table
	$shopping_cart_rs = $pdo->prepare("SELECT * FROM Shopping_Cart WHERE Customer_ID = :Customer_ID");
	$shopping_cart_rs->execute(array(":Customer_ID" => $customer_id));
	$shopping_cart = $shopping_cart_rs->fetchAll(PDO::FETCH_ASSOC);


	if($shopping_cart)
	{
		echo "Your shopping cart<br />";
		foreach($shopping_cart as $item)
		{
			echo "<table border=2 cellspacing=2>";
			echo "<tr><th>Product Name</th>";
			echo "<th>Quantity</th>";
			echo "<th>Remove from Cart</th></tr>";

			$item_name_rs = $pdo->prepare("SELECT Product_Name FROM Product WHERE Product_ID = :Product_ID");
			$item_name_rs->execute(array(":Product_ID" => $item["Product_ID"]));
			$item_name = $item_name_rs->fetch(PDO::FETCH_ASSOC);

			echo "<tr><td>" . $item_name["Product_Name"] . "</td>";
			echo "<td>" . $item["Quantity"] . "</td>";
			echo "<td><form action=\"shopping_cart.php\" method=\"POST\">";
			echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item["Product_ID"] . "\"/>";
			echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $customer_id . "\"/>";
			echo "<input type=\"submit\" value=\"Remove\"/>";
			echo "</form></td></tr>";
		}

		echo "</table>";

		echo "<form action=\"checkout.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
		echo "<input type=\"submit\" value=\"Checkout\"/>";
		echo "</form><br /><br />";
	}
	else
	{
		echo "Your shopping cart is empty";
	}



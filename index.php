<hmtl>
	<head>
		<title>Welcome to Pizza Hut</title>
	</head>

	<body>
		<p><b><h1>TA'S, IF YOU SEE THIS I'M QUICKLY TESTING THE GROUP PROJECT, PLZ COMEBACK LATER OR CONTACT ME DIRECTLY TO LET ME KNOW YOU NEED TO SEE ASSIGNMENT 9 AND I'LL CHANGE IT BACK</h1></b></p><br />
	
	<?php
		include("credentials.php");

		// Open MariaDB
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

		// Tracking the customer between pages
		// i.e. they're "logged on"
		@$C_ID = $_POST["Customer_ID"];

		// Greet the client/confirm their Customer_ID
		// Otherwise display link to log on
		if(@$C_ID == NULL)
		{
			// Link to logon screen
			echo "<p style=\"text-align:right;\"><a href =\"logon.php\">Sign In</a></p>";
		}
		else
		{
			// Greeting
			echo "<p style=\"text-align:right;\">Hello,<b> " . @$C_ID . "</b>! <a href =\"logon.php\">Not you?</a></p>";
		}

		// Get inventory from DB
		$rs = $pdo->query("SELECT * FROM Product;");
		$all_inventory = $rs->fetchAll(PDO::FETCH_ASSOC);
		$previous_item = NULL;

		// Print table headers for inventory
		echo "<table border=2 cellspacing=2>";
		echo "<th>Product Name</th>";
		echo "<th>Product Details</th>";
		echo "<th>Link to Product Page</th>";

		// Print inventory
		foreach($all_inventory as $item)
		{
			// Check for items with the same ID but same name
			if($item["Product_Name"] != $previous_item)
			{
				// Print item out with button that links to item page
				echo "<tr>";
				echo "<td>" . $item["Product_Name"] . "</td>";
				echo "<td>" . $item["Details"] . "</td>";

				// Button with link to item page
				echo "<td>";
				echo "<form action=\"item_page.php\" method=\"POST\">";
				echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . @$C_ID . "\"/>";
				echo "<input type=\"hidden\" name=\"Product_ID\" value=\"" . $item["Product_ID"] . "\"/>";
				echo "<input type=\"submit\" value=\"Buy\"/>";
				echo "</form></td></tr>";
			}

			$previous_item = $item["Product_Name"];
		}
		echo "</table>";


		echo "<a href="admin_logon.php">Employee Login</a><br/>";
		echo "<a href="show_orders.php">View Orders</a><br/>";
		echo "<a href="Past_Orders.php">View Previous Orders</a><br/>";
		
		
	?>
	</body>
</html>

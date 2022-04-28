<hmtl>
	<head>
		<title>Welcome to Pizza Hut</title>
	</head>

	<body>
		<p><b><h1>TA'S, IF YOU SEE THIS I'M QUICKLY TESTING THE GROUP PROJECT, PLZ COMEBACK LATER OR CONTACT ME DIRECTLY TO LET ME KNOW YOU NEED TO SEE ASSIGNMENT 9 AND I'LL CHANGE IT BACK</h1></b></p><br />
	<?php
		include("credentials.php");
		include("openMariaDB.txt");
		
		openMariaDB($username, $password);

		// Get inventory
		$rs = $pdo->query("SELECT Product_ID, Product_Name, Details FROM Product;");
		$all_inventory = $rs->fetchAll(PDO::FETCH_ASSOC);
		$previous_item = 0;

		// Print table headers for inventory
		echo "<table border=2 cellspacing=2>";
		echo "<th>Product Name</th>";
		echo "<th>Product Details</th>";

		// Print inventory
		foreach($all_inventory as $item)
		{
			// Check for items with the same ID but same name
			if(Product_Name != $previous_item)
			{
				// Print item out with button that links to item page
				echo "<tr>";
				echo "<td>" . $item["Product_Name"] . "</td>";
				echo "<td>" . $item["Details"] . "</td>";
				echo "</tr>";

				// Button with link to item page
				echo "<form> action=\"item_page.php\" method=\"POST\">";
				echo "<input type=\"submit\" name=\"item\" value=\"" . $item["Product_ID"] . "\"/>";
				echo "</form>";
			}

			$previous_item = $item["Product_Name"];
		}
		echo "</table>";

		

	?>

	</body>

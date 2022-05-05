<html>
<a href="index.php">Home</a><br />
<?php

	// Edit Inventory
	echo "<form action=\"manage_inventory.php\" method=\"POST\"/>";
	echo "Enter \"admin\" to access inventory management:<br />";
	echo "<input type=\"text\" name=\"Admin_ID\"/>";
	echo "<input type=\"submit\" value=\"Log On\">";
	echo "</form>";

	// Process Orders
	echo "<form action=\"see_orders.php\" method=\"POST\"/>";
	echo "Enter \"admino\" to access order management:<br />";
	echo "<input type=\"text\" name=\"Admin_ID\"/>";
	echo "<input type=\"submit\" value=\"Log On\">";
	echo "</form>";
?>
</html>

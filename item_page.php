<html>
<?php
	include("credentials.php");
	include("openMariaDB.php");

	$item = $_POST["item"];

	// Item's name in the tab's name
	echo "<head><title>" . $item["Product_Name"] . "</head></title>";

	openMariaDB($username, $password);

	// Get item information
	$rs = pdo->prepare("SELECT * FROM Product WHERE Product_ID = :item");
	$rs->execute(array(":item" => $item));
	$item_info = $rs->fetchAll(PDO::FETCH_ASSOC);

	echo "<table border=2 cellspacing=2>";
	echo "<tr><td><b>Product Name</b></td>";
	echo "<td>" . $item["Product_Name"] . "</td></tr>";
?>

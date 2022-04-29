<html>
<?php
	include("credentials.php");
	include("openMariaDB.php");

	$item = $_POST["item"];

	// Item's name in the tab's name
	echo "<head><title>" . $item["Product_Name"] . "</head></title>";

	openMariaDB($username, $password);

	// Get item information
	$item_info_rs = pdo->prepare("SELECT * FROM Product WHERE Product_ID = :item");
	$item_info_rs->execute(array(":item" => $item));
	$item_info = $item_info_rs->fetchAll(PDO::FETCH_ASSOC);

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
		$item_sizes_rs = pdo->prepare("SELECT Size FROM Product WHERE Product_Name = :item_name");
		$item_sizes_rs->execute(array(":item_name" => $item_info["Product_Name"]));
		$item_sizes = $item_size_rs->fetchAll(PDO::FETCH_ASSOC);

		echo "<td>";
		foreach($item_sizes as $item_size)
		{
			echo $item_sizes["Size"] . "<br />";
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
		$item_colors_rs = pdo->prepare("SELECT Color FROM Product WHERE Product_Name = :item_name");
		$item_colors_rs->execute(array(":item_name" => $item_info["Product_Name"]));
		$item_colors = $item_colors_rs->fetchAll(PDO::FETCH_ASSOC);

		echo "<td>";
		foreach($item_colors as $item_color)
		{
			echo $item_colors["Color"] . "<br />";
		}
		echo "</td></tr>";
	}
	else
	{
		echo "<td>N/A</td></tr>";
	}
?>

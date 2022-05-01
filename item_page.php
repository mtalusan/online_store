<html>
<?php
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

	// Get item information
	$item_info_rs = $pdo->prepare("SELECT * FROM Product WHERE Product_ID = :item;");
	$item_info_rs->execute(array(":item" => $item_ID));
	$item_info = $item_info_rs->fetch(PDO::FETCH_ASSOC);

	// Item's name in the tab's name
	echo "<head><title>" . $item_info["Product_Name"] . "</title></head>";

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
?>

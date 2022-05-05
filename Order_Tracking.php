<html><head><title>Order Tracking</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}

	@$Customer_ID = @$_POST['Customer_ID'];

	// Button to return to the home page
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . @$Customer_ID . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";


	echo"\n\t\tPlease Enter the tracking number for the order\n\n";
	
	echo '<form action="Order_Tracking.php\" method="POST">';
	echo '<input type="text" name="quicknote"/>\t';
	echo '<input type="submit" name="submit"/>';
	echo '</form>';

	@$Tracking_Number = @$_POST['quicknote'];

	$rs = $pdo->prepare("SELECT distinct Order_ID, Tracking_Number,Processing_status  FROM Order_Info where Tracking_Number = ?");

	$rs->execute(array($Tracking_Number));
	$rows = $rs->fetchALL(PDO::FETCH_ASSOC);
		
	if(empty($rows))
	{	
		echo "\n\n\t\tORDER NOT FOUND\n";
	}
	else
	{
		echo "<table border=1 cellspacing=10>";
       		echo "<tr>";
		foreach($rows[0] as $key => $item)
		{	
			echo "<th>$key</th>";
		}
		echo "</tr>";
		foreach($rows as $row)
		{
			echo "<tr>";
			foreach ($row as $key => $item)
			{
				echo "<td>$item</td>";
			}
			echo "</tr>";
		}
		echo "</table>";		
	}
?>	
</pre></body></html>

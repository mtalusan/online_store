<html><head><title>Orders</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		$rs = $pdo->query("select distinct Order_ID, Stock, Quantity from Product, Ordered_item");
		$rows = $rs->fetchALL(PDO::FETCH_ASSOC);
		foreach($rows as $row)
		{	
			if($row['Quantity'] > $row['Stock'])
			{	
				$dr = $pdo->prepare("delete from Ordered_Item where Order_ID = ?");
				$dr->execute(array($row['Order_ID']));
				$dr = $pdo->prepare("delete from Order_Info where Order_ID = ?");
				$dr->execute(array($row['Order_ID']));
				echo "\n\nThe order(s) " . $row['Order_ID'] ;
				echo " was removed from the Order\n\n";
			}
			else
			{	
				$row['Stock'] - $row['Quantity'];
			}
		}	

		// Button to return to the home page
		echo "<form action=\"index.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . @$Customer_ID . "\"/>";
		echo "<input type=\"submit\" value=\"Home\"/>";
		echo "</form><br /><br />";

		@$Customer_ID = @$_POST['Customer_ID'];
		
		if(!@$Customer_ID)
		{
			echo '<form action="show_orders.php" method="POST">';
			echo "<input type='text' name='Customer_ID'/>\t";
			echo "<input type='submit' name='submit'/>";
			echo '</form>';
		}

		$rs = $pdo->prepare("SELECT distinct Order_ID, Tracking_Number, Price FROM Order_Info where Customer_ID = ?");

		$rs->execute(array(@$Customer_ID));
		$rows = $rs->fetchALL(PDO::FETCH_ASSOC);

		if(empty($rows))
		{
			echo "\n\n\t\tCustomer ID not found\n";
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
				foreach($row as $item)
				echo "<th>$item</th>";
				echo "</tr>";
				$Tprice = $Tprice + $row['Price'];
			}
			echo "</table>";	

			echo "\n\n\tTotal Price = " . $Tprice;


			// Button to Order Tracking
			echo "<form action=\"Order_Tracking.php\" method=\"POST\">";
			echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . @$Customer_ID . "\"/>";
			echo "<input type=\"submit\" value=\"Track an Order\"/>";
			echo "</form><br /><br />";

		}
	}

	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
</pre></body></html>

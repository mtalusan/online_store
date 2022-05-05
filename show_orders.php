<html><head><title>Orders</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		echo '<form action="show_orders.php" method="POST">';
		echo "<input type='text' name='quicknote'/>\t";
		echo "<input type='submit' name='submit'/>";
		echo '</form>';
	
		$Customer_ID = $_POST['quicknote'];

		$rs = $pdo->prepare("SELECT distinct Order_ID, Tracking_Number, Price FROM Order_Info where Customer_ID = ?");

		$rs->execute(array($Customer_ID));
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

			echo "\n\n\t\t<a href='Order_Tracking.php'>Track Order</a>\n\n";
		}
	}

	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
</pre></body></html>

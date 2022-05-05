<html><head><title>Past Orders</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		echo '<form action="Past_Orders.php" method="POST">';
		echo "<input type='text' name='quicknote'/>\t";
		echo "<input type='submit' name='submit'/>";
		echo '</form>';

		$Customer_ID = $_POST['quicknote'];

		$rs = $pdo->prepare("SELECT distinct Order_ID, Price FROM Order_Info where Processing_status = 'Delivered' and Customer_ID = ?");
		$rs->execute(array($Customer_ID));
		$rows = $rs->fetchALL(PDO::FETCH_ASSOC);

		if(empty($rows))
		{
			echo "\n\t\tNo Past Orders Found for this Customer ID";
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
	}

	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>	
</pre></body></html>

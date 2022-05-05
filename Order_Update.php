<html><head><title>Update</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		//creating table
		$rs = $pdo->query("SELECT * FROM Order_Info where Processing_status != 'Delivered' and Processing_status != 'Shipped'");
		$rows = $rs->fetchALL(PDO::FETCH_ASSOC);

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
		
		//form to user input data
		echo '<form action="Order_Update.php" method="POST">';
		echo "<input type='textbox' name='orderid'/>\t";
		echo "<input type='radio' name='status' value='Processed'>Processed\t";
		echo "<input type='radio' name='status' value='Shipped'>Shipped\t";
		echo "<textarea name='notes'>Notes</textarea>\n\n";
		echo "<input type='submit' name='submit'/>";
		echo '</form>';

		$orderid = $_POST['orderid'];
		$notes = $_POST['notes'];
		$status = $_POST['status'];
		
		//process the submitted data
		$rs = $pdo->prepare("update Order_Info set Processing_status = ? where Order_ID = ?");
		$rs->execute(array($status, $orderid));

		$rs = $pdo->prepare("update Order_Info set Seller_Notes = ? where Order_ID = ?");
		$rs->execute(array($notes, $orderid));

	}

	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
</pre></body></html>
	

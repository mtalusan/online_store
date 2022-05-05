<html><head><title>Orders to be Processed</title></head><body><pre>
<?php

	include('credentials.php');

	try{ // if something goes wrong, an exception is thrown
		$dsn = "mysql:host=courses;dbname=z1714949";
		$pdo = new PDO($dsn,$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$rs = $pdo->query("SELECT * FROM Order_Info where Processing_status != 'Shipped' and Processing_status != 'Delivered'");
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

		echo "\n\n\t\t<a href='Order_Update.php'>Update Order Status</a>\n\n";
	}
	catch(PDOexception $e)
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
</pre></body></html>
	

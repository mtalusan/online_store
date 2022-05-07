<html><head><title>Logged In!</title></head>
<body>
<?php
	$C_ID = $_POST["Customer_ID"];

	echo "<form action=\"index.php\" method=\"POST\"/>";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $C_ID . "\"/>";
	echo "<input type=\"submit\" value=\"Home\">";
	echo "</form><br/>";

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


	// Query if this customer already has an account
	$C_exists_rs = $pdo->prepare("SELECT Customer_ID FROM Customer WHERE Customer_ID = :Customer_ID;");
	$C_exists_rs->execute(array(":Customer_ID" => $C_ID));
	$C_exists = $C_exists_rs->fetch(PDO::FETCH_ASSOC);

	if($C_exists)
	{
		echo "Welcome back " . $C_ID . "!";
	}
	else
	{
		// If this is the customer's first time, create a new row in Customer DB
		$C_insert_rs = $pdo->prepare("INSERT INTO Customer (Customer_ID) VALUES (:Customer_ID);");
		$C_insert_rs->execute(array(":Customer_ID" => $C_ID));

		echo "Welcome " . $C_ID . "!";
	}
?>
</body>
</html>

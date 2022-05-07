<html>
<a href="index.php">Home</a><br />
<?php

	echo "<form action=\"logon_success.php\" method=\"POST\"/>";
	echo "Enter your Customer ID/Username:<br />";
	echo "<input type=\"text\" name=\"Customer_ID\"/>";
	echo "<input type=\"submit\" value=\"Log On\">";
	echo "</form>";

?>
</html>

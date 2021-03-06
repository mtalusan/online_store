<?php

	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"hidden\" name=\"Customer_ID\" value=\"" . $_POST["Customer_ID"] . "\"/>";
	echo "<input type=\"submit\" value=\"Home\"/>";
	echo "</form><br /><br />";

$customer_id= $_POST["Customer_ID"];

include("secrets.php");

$dsn = "mysql:host=courses;dbname=z1960742";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



if(!empty($_POST)){
   //echo "<pre>";print_r($_POST);die;

if(!empty($_POST['checkout'])){
    $customer_id=$_POST['Customer_ID'];
}

    if(!empty($_POST['submit'])){
        try
        {
            $customer_id=$_POST['Customer_ID'];
           // echo "<pre>";print_r($_POST);die;
            $sql = "INSERT INTO Customer(Customer_ID, Phone_Number, Shipping_Address, Customer_Name, Card_Number) VALUES (?,?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute(array($customer_id, $_POST['Phone_Number'], $_POST['address'], $_POST['Customer_Name'], $_POST['Card_Number']));

            $sql = "INSERT INTO Ordered_Item(Customer_ID, Product_ID, Quantity, Price) VALUES (?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($customer_id, $_POST['Product_ID'], $_POST['Quantity'], $_POST['Price']);


            $sql = "DELETE FROM Shopping_Cart WHERE Customer_ID = :customer_id ";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([':customer_id'=>$customer_id]);


            echo "<p>You order is completed successfully, please shop again <a href='index.php'>Click here</a> </p>";
            exit();
        }
        catch(PDOexception $e)
        {
            echo "Connection to database failed: " . $e->getMessage();
        }
    }
}

try
{
    // Get Cart/wishlist information
//	$item_info_rs = $pdo->prepare("SELECt * FROM Shopping_Cart as w JOIN Product as p ON w.Product_ID=p.Product_ID  WHERE w.Customer_ID = :customer;");
	$item_info_rs = $pdo->prepare("SELECT Product_ID, Quantity, Base_Price from Product, Shopping_Cart where Customer_ID = ?");	
    	$item_info_rs->execute(array($customer_id));
    	$item_info = $item_info_rs->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOexception $e)
{
    echo "Connection to database failed: " . $e->getMessage();
}

$price='';
$quantity='';
$productIds='';

if(!empty($item_info)){
    foreach ($item_info as $val){
        $price+=$val['Base_Price'] * $val['quantity'];
        $quantity+=$val['quantity'];
        $productIds.=$val['Product_ID'];
    }
}

//echo "<pre>";print_r($productIds);die;
?>

<html><head><title>Shopping Cart</title>
<style>
    div{
        padding-bottom: 10px;
    }
</style>
</head>
<body>
<table border=2 cellspacing=2>
    i<thead>
    <th>Total Amount to be paid</th>
    <th>Total items in cart</th>
    </thead>
    <tbody>
    <tr>
        <td>$<?=$price?></td>
        <td><?=$quantity?></td>
    </tr>
    </tbody>
</table>
<form method="post" action="checkout.php">
    <h2>Billing Information</h2>
    <div>
    <label>Name</label>
    <input type="text" required name="Customer_Name">
    </div>
    <div>
    <label>Phone</label>
    <input type="tel" maxlength="10" required name="Phone_Number">
    </div>
    <hr>
    <h2>Shipping Information</h2>
    <div>
    <label>Shipping Address</label>
    <input type="text" required name="address">
    </div>

    <div>
    <label>Card Number</label>
    <textarea name="Card_Number"></textarea>
    </div>

    <div>

        <input type="hidden" required name="Customer_ID" value="<?=$customer_id?>">
    </div>


    <div>

        <input type="hidden" required name="Quantity" value="<?=$quantity?>">
    </div>


    <div>

        <input type="hidden" required name="Price" value="<?=$price?>">
    </div>


    <div>

        <input type="hidden" required name="Product_ID" value="<?=$productIds?>">
    </div>

    <button type="submit" name="submit" value="submit">Submit</button>
</form>
</body>
</html>

<?php


$customer_id='';
$product_id='';

include("credentials.php");

$dsn = "mysql:host=courses;dbname=z1714949";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


if(!empty($_POST)){

    if(!empty($_POST['submit'])){
//echo "<pre>";print_r($_POST);die;
if($_POST['submit'] == 'add_quantity'){
    try
    {
    $quantity=($_POST['quantity'] + 1);
    $cart_id=$_POST['cart_id'];
    $sql = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id ";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([':quantity'=>$quantity,':cart_id'=>$cart_id]);
    }
    catch(PDOexception $e)
    {
        echo "Connection to database failed: " . $e->getMessage();
    }

} elseif($_POST['submit'] == 'remove'){
    try
    {

        $quantity=($_POST['quantity'] - 1);
        $cart_id=$_POST['cart_id'];

        /*Remove product from cart if quantity is 0*/
        if($quantity =='0'){
            $sql = "DELETE FROM cart WHERE cart_id = :cart_id ";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([':cart_id'=>$cart_id]);
        }else{
            $sql = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id ";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([':quantity'=>$quantity,':cart_id'=>$cart_id]);
        }

    }
    catch(PDOexception $e)
    {
        echo "Connection to database failed: " . $e->getMessage();
    }
}

    }else{
        $product_id=$_POST['Product_ID'];
        $customer_id=$_POST['Customer_ID'];
    }



}



try
{


//echo $product_id.'--'.$customer_id;die;
    // Insert into  Cart/wishlist table
    if($product_id!='' && $customer_id!=''){

        $sql = "INSERT INTO cart (Product_ID,Customer_ID,quantity) VALUES (?,?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$product_id, $customer_id,'1']);
    }


    // Get Cart/wishlist information
    $item_info_rs = $pdo->prepare("SELECT * FROM cart as w JOIN Product as p ON w.Product_ID=p.Product_ID  WHERE w.Customer_ID = :customer;");
    $item_info_rs->execute(array(':customer'=>$customer_id));
    $item_info = $item_info_rs->fetchAll(PDO::FETCH_ASSOC);

   // echo "<pre>";print_r($item_info);die;
}
catch(PDOexception $e)
{
echo "Connection to database failed: " . $e->getMessage();
}

?>

<html><head><title>Shopping Cart</head></title>
<body>

<?php if(!empty($item_info)){?>
    <table border=2 cellspacing=2>
        <thead>
        <th>Product Name</th>
        <th>Details</th>
        <th>Price</th>
        <th>Size</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Add</th>
        <th>Remove</th>
        </thead>
        <tbody>
        <?php


        foreach ($item_info as $cart){?>
    <tr>
        <td><?=$cart['Product_Name']?></td>
        <td><?=$cart['Details']?></td>
        <td><?=$cart['Base_Price']?></td>
        <td><?=$cart['Size']?></td>
        <td><?=$cart['Color']?></td>
        <td><?=$cart['quantity']?></td>
        <td>
            <form method="post" action="">
                <input type="hidden" name="product_id" value="<?=$cart['Product_ID']?>">
                <input type="hidden" name="cart_id" value="<?=$cart['cart_id']?>">
                <input type="hidden" name="quantity" value="<?=$cart['quantity']?>">
                <button type="submit" name="submit" value="add_quantity">Add</button>
            </form>
        </td>
        <td>
            <form method="post" action="">
                <input type="hidden" name="product_id" value="<?=$cart['Product_ID']?>">
                <input type="hidden" name="cart_id" value="<?=$cart['cart_id']?>">
                <input type="hidden" name="quantity" value="<?=$cart['quantity']?>">
                <button type="submit"  name="submit"  value="remove">Remove</button>
            </form>
        </td>

    </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else{ ?>

<p>You cart is empty please shop from <a href="add_to_cart_confirm.php"> here</a> </p>
<?php } ?>



</body>
</html>

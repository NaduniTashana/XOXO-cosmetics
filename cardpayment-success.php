<?php
require_once 'config.php';
session_start();

$user_id = $_SESSION['user_id'];



$orderQuery = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id '") or die('query failed');
if ($orderQuery && mysqli_num_rows($orderQuery) > 0) {
    $orderDetails = mysqli_fetch_assoc($orderQuery);
    
    $orderNumber = $orderDetails['id'];
    $customerName = $orderDetails['name'];
    $customerEmail = $orderDetails['email'];
    $customerPhone = $orderDetails['number'];
    $orderDate = $orderDetails['placed_on'];
    $orderAddress = $orderDetails['address'];
   
    // Fetch ordered items from the database
    $orderedItemsQuery = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
    $orderedItems = [];
    if ($orderedItemsQuery && mysqli_num_rows($orderedItemsQuery) > 0) {
        while ($item = mysqli_fetch_assoc($orderedItemsQuery)) {
            $orderedItems[] = $item; // Store items in an array
        }
    }
}
$orderNumber = uniqid('ORDER');

// Get the current date and time
$orderDate = date('Y-m-d');
$orderTime = date('H:i:s');


    // Clear the cart or perform other post-order actions
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('query failed');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="icon" type="image/x-icon" href="images/XOXO.png">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        h1, h2 {
            color: #333;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f8f8f8; /* Updated color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 20px
        }

        button:hover {
            background-color: #555;
        }

        .container{
            background-color: #FFC9E9;
            padding: 20px; /* Adjust the padding as needed */
            border-radius: 20px; /* Adjust the border-radius for rounded edges */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

    </style>

    
    
</head>

<body>
<div class="container">
<h1>Order Confirmed <img src="images/order.png" alt="" width="4%"></h1>
        <p>Order Number: <?php echo $orderNumber; ?></p>
        
        <p>Date: <?php echo date('d/m/Y', strtotime($orderDate)); ?>
        <p>Pickup at: <?php echo $orderAddress ;?></p>
        <p>Customer Name: <?php echo $customerName; ?></p>
        <p>Email: <?php echo $customerEmail; ?></p>
        <p>Phone: <?php echo $customerPhone; ?></p>
        
        <h2>Ordered Items Summary:</h2>
        
        <ul>
            <?php foreach ($orderedItems as $item) : ?>
                <li><?php echo $item['name']; ?> - Quantity: <?php echo $item['quantity']; ?> - Price of each: Rs <?php echo $item['price']; ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Reduce the stock after the payment -->
        <?php 
            $product_name = $item['name'];
            $select_product = mysqli_query($conn, "SELECT * FROM products WHERE name = '$product_name'") or die('query failed');
            $row = mysqli_fetch_assoc($select_product);
            $available_quantity =  $row['quantity']-$item['quantity'];
            mysqli_query($conn, "UPDATE products SET quantity = '$available_quantity' WHERE name = '$product_name'") or die('query failed');     
        ?>

        <p>Your order has been sent to our shop. Thank you for shopping with us!</p>

        <a href="shop.php">
            <button>Continue Shopping</button>
        </a>
</div>        
</body>


</html>
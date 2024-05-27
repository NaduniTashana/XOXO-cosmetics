

<?php

include 'config.php';

session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    if($user_id != null){
       $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       $select_product = mysqli_query($conn, "SELECT * FROM products WHERE name = '$product_name'") or die('query failed');
       $row = mysqli_fetch_assoc($select_product);
       $available_quantity =  $row['quantity'];
 
       if (mysqli_num_rows($check_cart_numbers) > 0) {
          $message[] = 'already added to cart!';
       }else if($available_quantity==0){
          $message[] = '0ut of stock!';
       }else if($available_quantity<$product_quantity){
          $message[] = 'Ordered quantity is not available in the stock!';
       }else {
          mysqli_query($conn, "INSERT INTO cart(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
          $message[] = 'product added to cart!';
       }
    }else{
       $message[] = 'Please login!';
    }
    
 }
?>
<?php


// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details based on the provided ID
    $select_product = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id") or die('Query failed');
    
    if(mysqli_num_rows($select_product) > 0) {
        $product_details = mysqli_fetch_assoc($select_product);
        // Display product details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details </title>
    <link rel="icon" type="image/x-icon" href="images/XOXO.png">
    
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/user_style.css">
   <style>
    .product-display{
        display:flex;
        margin:0px 170px;
    }
    .productdisplay-left{
        display:flex;
        gap:17px;
    }
    .product-image-small{
        display:flex;
        flex-direction:column;
        gap:16px
    }
    .product-image-small img{
        height:163px;
    }
    .product-image{
        width:380px;
        height:700px;
    }


    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Apply the animation to the .details class */
    .details {
        animation: fadeIn 1s ease-in-out;
    }
    .details{
        font-size: 2em;
        margin:0px 70px;
        display:flex;
        flex-direction:column;
        gap:5px;
    }
    .stars{
        display:flex;
        align-items:center;
        margin-top:13px;
        gap:5px;
        color:#1c1c1c;
        font-size:16px;
    }
</style>

</head>
<body>
<?php
// Include the appropriate header based on user login status
if ($isLoggedIn) {
    include 'header.php'; // Include the header for logged-in users
} else {
    include 'non_user_header.php'; // Include the header for non-users
}
?>    
<?php include 'shop_navigation.php'; ?>

    <div class="product-display">
    <div class="productdisplay-left">
        <div  class= "product-image">
        <img style="width:30rem;" src="uploaded_img/<?php echo $product_details['image']; ?>" alt="<?php echo $product_details['name']; ?> Image">
        </div>

        <div  class= "product-image-small">
        <img src="uploaded_img/<?php echo $product_details['image']; ?>" alt="<?php echo $product_details['name']; ?> Image">
        <img src="uploaded_img/<?php echo $product_details['image']; ?>" alt="<?php echo $product_details['name']; ?> Image">
        <img src="uploaded_img/<?php echo $product_details['image']; ?>" alt="<?php echo $product_details['name']; ?> Image">
        </div>
    </div>
       
        <div class= "details">   
        <br><h3 style="color:var(--purple)"><?php echo $product_details['name']; ?></h3><br>
        <h4>price: Rs <?php echo $product_details['price']; ?>/-</h4><br>
        <p><?php echo $product_details['description']; ?></p>
        <div class="stars">
            <img src="images/star_icon.png" alt="">
            <img src="images/star_icon.png" alt="">
            <img src="images/star_icon.png" alt="">
            <img src="images/star_icon.png" alt="">
            <img src="images/star_icon.png" alt="">
        </div>
        
        <form action="" method="post">
    <input style="border:2px solid black; width:100px; height:30px; padding-left: 5px;" type="number" min="1" name="product_quantity" value="1" class="qty">
    <input type="hidden" name="product_name" value="<?php echo $product_details['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $product_details['price']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $product_details['image']; ?>">
    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>

        
        </div>
        
    </div>
    
    

<!-- custom js file link  -->
    <script src="js/script.js"></script>
    
</body>

</html>
 <?php
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid product ID!";
}
?>

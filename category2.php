<?php

include 'config.php';

session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;


if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
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
// Get the selected category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Modify the SQL query to include the category condition
$queryCondition = ($category !== 'all') ? "AND category_2 = '$category'" : '';
$select_products = mysqli_query($conn, "SELECT * FROM products WHERE 1 $queryCondition") or die('query failed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="icon" type="image/x-icon" href="images/XOXO.png">


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">

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

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
      // Get the selected category from the URL
        $category = isset($_GET['category']) ? $_GET['category'] : 'all';

        // Modify the SQL query to include the category condition
        $queryCondition = ($category !== 'all') ? "AND category_2 = '$category'" : '';
        $select_products = mysqli_query($conn, "SELECT * FROM products WHERE 1 $queryCondition") or die('query failed');

         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>

     <form action="" method="post" class="box">
                  <a href="details.php?id=<?php echo $fetch_products['id']; ?>">
                     <img style="width:20rem;" class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""> </a>
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
                  <?php 
                     if($fetch_products['quantity']==0){?>
                        <div class="quantity"><?php echo "Out of Stock"; ?></div>
                        <?php
                     }
                  ?>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                  <button type="submit" name="add_to_wishlist" class="btn" onclick="add_to_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></button>

               </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>

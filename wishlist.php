<?php

include 'config.php';

session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;



if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$delete_id'") or die('query failed');
  header('location:wishlist.php');
}

if (isset($_GET['delete_all'])) {
  mysqli_query($conn, "DELETE FROM wishlist WHERE user_id = '$user_id'") or die('query failed');
  header('location:wishlist.php');
}

// Handle add to cart form submission
if (isset($_POST['add_to_cart'])) {
  $wishlist_id = $_POST['wishlist_id'];
  $wishlist_quantity = $_POST['wishlist_quantity'];

  // Fetch product details from the wishlist based on wishlist_id
  $fetch_wishlist_details = mysqli_query($conn, "SELECT * FROM wishlist WHERE id = '$wishlist_id'") or die('query failed');
  $wishlist_product = mysqli_fetch_assoc($fetch_wishlist_details);

  $select_product = mysqli_query($conn, "SELECT * FROM products WHERE name = '{$wishlist_product['name']}'") or die('query failed');
  $row = mysqli_fetch_assoc($select_product);
  $available_quantity =  $row['quantity'];

  if($available_quantity==0){
   $message[] = '0ut of stock!';
  }else if($available_quantity<$wishlist_quantity){
    $message[] = 'Ordered quantity is not available in the stock!';
  }else{
    // Add the product to the cart
    mysqli_query($conn, "INSERT INTO cart (user_id, name, price, quantity, image) VALUES ('$user_id', '{$wishlist_product['name']}', '{$wishlist_product['price']}', '$wishlist_quantity', '{$wishlist_product['image']}')") or die('query failed');

    // Remove the product from the wishlist
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$wishlist_id'") or die('query failed');
    $message[] = 'product added to cart!';
  }
  
  // Redirect to wishlist page
  header('location:wishlist.php');
 }
  
if(isset($message)){
  foreach($message as $message){
     echo '
     <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
     </div>
     ';
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist</title>
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

  <div class="heading">
    <h3>My Wishlist</h3>
    <p> <a href="home.php">home</a> / wishlist </p>
  </div>

  <section class="shopping-cart">
    <div class="box-container">
      <?php
      $grand_total = 0;
      $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_wishlist) > 0) {
        while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {
      ?>
          <div class="box">
            <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
            <img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
            <div class="price">Rs <?php echo $fetch_wishlist['price']; ?>/-</div>
            <form action="" method="post">
              <input type="hidden" name="wishlist_id" value="<?php echo $fetch_wishlist['id']; ?>">
              <input type="number" min="1" name="wishlist_quantity" value="<?php echo $fetch_wishlist['quantity']; ?>">
              <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">your wishlist is empty</p>';
      }
      ?>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <!-- custom js file link  -->
  <script src="js/script.js"></script>

</body>

</html>

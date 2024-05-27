<?php

include 'config.php';

session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}
if (isset($_POST['add_to_wishlist'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      $message[] = 'Already added to wishlist!';
   } else {
      mysqli_query($conn, "INSERT INTO `wishlist`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product added to wishlist!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
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


<section class="home">

   <div class="content">
      <h3>Unleash Your Radiance</h3>
      <!-- <p>Welcome to our beauty oasis! Explore a curated collection of premium cosmetics designed to accentuate your natural charm. From vibrant eyeshadows to luxe lipsticks, our carefully selected range ensures you'll find your perfect beauty match. Elevate your routine with products that prioritize both performance and skin health. Discover the joy of self-expression and confidence in every purchase. Welcome to a world where beauty meets empowerment!</p> -->
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
     <a href="details.php?id=<?php echo $fetch_products['id']; ?>" >
      <img style="width:20rem;" class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></a>
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
      <?php 
                     if($fetch_products['quantity']==0){?>
                        <div class="quantity"><?php echo "Out of Stock"; ?></div>
                        <?php
                     }
                  ?>
      
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <?php
         // Include the appropriate header based on user login status
         if ($isLoggedIn) { ?>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            <button type="submit" name="add_to_wishlist" class="btn" onclick="add_to_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></button>
            <?php
         } 
         ?>
      

     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about1.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Unleash Your Radiance: Where Beauty Meets Confidence. Discover Your Signature Glow with Our Premium Cosmetics Collection!</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>We've got answers! Reach out for beauty tips, product advice, or anything else you'd like to know. Our team is here to make your experience seamless and enjoyable. Connect with us because, at [Your Brand Name], your questions are our priority!</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>
<script>
    // Array of background image URLs
    const backgroundImages = [
        'url(images/cover2.jpg)',
        'url(images/cover3.jpg)',
        'url(images/cover4.jpg)',
        'url(images/cover6.jpg)'
        
        // Add more image URLs as needed
    ];

    let index = 0;

    // Function to change the background image
    function changeBackground() {
        const homeSection = document.querySelector('.home');
        homeSection.style.background = backgroundImages[index];
        homeSection.style.backgroundRepeat = 'no-repeat';
        homeSection.style.backgroundSize = 'cover';
        index = (index + 1) % backgroundImages.length;
    }

    // Change the background image every 5 seconds
    setInterval(changeBackground, 5000); // Change image after 5 seconds
    changeBackground(); // Change background image when the page loads
</script>




<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
<?php
include 'config.php';
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

// Get the selected categories from the URL
$category_1 = isset($_GET['category_1']) ? $_GET['category_1'] : 'all';
$category_2 = isset($_GET['category_2']) ? $_GET['category_2'] : 'all';

// Modify the SQL query to include conditions for either category_1 or category_2
$queryCondition = "AND (category_1 = '$category_1' OR category_2 = '$category_2')";

// If 'all' is selected for both categories, remove the condition
if ($category_1 === 'all' && $category_2 === 'all') {
    $queryCondition = '';
}

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
<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
         <form action="" method="post" class="box">
            <a href="details.php?id=<?php echo $fetch_products['id']; ?>" >
               <img style="width:20rem;" class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            </a>
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
         </form>
      <?php
         }
      } else {
         echo '<p class="empty">No products match the selected categories!</p>';
      }
      ?>
   </div>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

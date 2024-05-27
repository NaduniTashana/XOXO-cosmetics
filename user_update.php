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

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

  

}
if (isset($_POST['add_to_wishlist'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM wishlist WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   
}

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
   <style>
      /*CSS for product box */
 .box-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.form-container{
   min-height: 100vh;
   background-color: var(--light-bg);
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
}

.form-container form{
   padding:2rem;
   width: 50rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   background-color: var(--white);
   text-align: center;
}

.form-container form h3{
   font-size: 3rem;
   margin-bottom: 1rem;
   text-transform: uppercase;
   color:var(--black);
}

.form-container form .box{
   width: 100%;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--black);
   border:var(--border);
   margin:1rem 0;
}

.form-container form .box1{
   background-color: var(--white);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--purple);
   border:none;
   margin-bottom:2rem ; 
}

.form-container form p{
   padding-top: 1.5rem;
   font-size: 2rem;
   color:var(--black);
   text-align:left;
}

.form-container form p a{
   color:var(--purple);
}

.form-container form p a:hover{
   text-decoration: none;
}

.form-container form p .button{
   text-align:center;
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




if(isset($_POST['update_user'])){

   $update_name = $_POST['update_name'];
   $update_email = $_POST['update_email'];
   $update_pw = ($_POST['update_password']);
   $update_cpw = ($_POST['update_cpassword']);
 
   $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$update_email'") or die('query failed');
   $number_of_users = mysqli_num_rows($select_users);
   $fetch_user=mysqli_fetch_assoc($select_users);
   
   if(empty($update_name)){
      $message[] = 'username cannot be empty';
   }else if(empty($update_email)){
      $message[] = 'email cannot be empty';
   }else if(!empty($update_cpw) && !empty($update_pw)){
      if($update_pw != $update_cpw){
         $message[] = 'passwords do not match!';
      }else{
         $update_cpw = md5($_POST['update_cpassword']);
      }
   }else if(empty($update_cpw) && empty($update_pw)){
      $update_cpw = $fetch_user['password'];
   }else if($update_email !== $_SESSION['user_email']){
      
      if( $number_of_users > 0 ){ 
         $message[] = 'this email already exist!';
      }
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
   }else{
      mysqli_query($conn, "UPDATE users SET name = '$update_name', email = '$update_email', password ='$update_cpw' WHERE id = '$user_id'") or die('query failed');     
      $_SESSION['user_name'] = $update_name;
      $_SESSION['user_email'] = $update_email;  
      $message[] = 'updated successfully!';  
      header('location:user_update.php');
   }
}
?>


<div class="heading">
   <h3>User Profile</h3>
   <p> <a href="home.php">User Profile</a> / shop </p>
</div>
<div class="form-container">
   <?php
      $select =mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'") or die('query failed');
      $row = mysqli_fetch_assoc($select);
      $username = $row['name'];
      $email =  $row['email'];
   ?>
  
<form action="" method="post">
   <p>
               <label for="update_name">Email : </label>
               <input type="email" name="update_email" value="<?php echo $email; ?>" class="box1" readonly ><br>
               <label for="update_name">Username : </label>
               <input type="text" name="update_name" value="<?php echo $username; ?>" class="box"><br>
               <label for="update_name">New Password : </label>
               <input type="password" name="update_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="box"> <br> 
               <label for="update_name">Confirm password : </label>
               <input type="password" name="update_cpassword" class="box"><br>   
               <div class="button">   
               <input type="submit" value="update" name="update_user" class="btn">
               <input type="reset" value="cancel" name="cancel_update" class="btn">
               </div>    
            </p>
            </form>





</div>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
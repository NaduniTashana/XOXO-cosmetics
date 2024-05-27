<?php
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

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo"><!--<img src="images/XOXO.png" width="15%"><br>-->XOXO</a>

         <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
            
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            
           
            </div>

         
      </div>
   </div>

</header>
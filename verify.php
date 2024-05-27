<?php
include 'config.php';
 
if(isset($_GET['email']) && isset($_GET['v_code'])){
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND verification_code = '$v_code'");
    if($result){
        if(mysqli_num_rows($result) == 1){
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_verified'] == 0){
                $update = "UPDATE users SET is_verified='1' WHERE email = '$email'";
                if(mysqli_query($conn, $update)){
                    echo '<script>
                            alert("Email verification successful!");
                            window.location.href = "login.php";
                          </script>';
                    exit(); // Exiting to prevent further execution
                }
            }else{
                echo '<script>
                        alert("Email already verified!");
                        window.location.href = "login.php";
                      </script>';
                exit(); // Exiting to prevent further execution
            }
        }
    }else{
        echo '<script>
                alert("Cannot run query!");
                window.location.href = "login.php";
              </script>';
        exit(); // Exiting to prevent further execution
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="icon" type="image/x-icon" href="images/XOXO.png">


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">

</head>
<body>
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
</body>
</html>
<?php

include 'Config.php';


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, ($_POST['pass']));
   $cpass = mysqli_real_escape_string($conn, ($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email` = '$email' AND `pass` = '$pass'") or die('query failed');


   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exist'; 
   }else{
      if(!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pass)){
         $message[] = 'Password length min 8 & must contain one capital letter, one integer!';

      }elseif($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `admin`(name, email, pass) VALUES('$name', '$email', '$pass')") or die('query failed');

         if($insert){
            
            echo "<script>alert('Registered Successfully!.')</script>";
            header('location:admin_login.php');
         }else{
            $message[] = 'Registeration Failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="registration.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="pass" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="admin_login.php">login now</a></p>
   </form>

</div>

</body>
</html>
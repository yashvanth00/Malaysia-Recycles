<?php

include 'Config.php';
session_start();
$name = $_SESSION['name'];

if(isset($_POST['update_profile'])){

   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_age = mysqli_real_escape_string($conn, $_POST['update_age']);
   $update_contact = mysqli_real_escape_string($conn, $_POST['update_contact']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
   

   mysqli_query($conn, "UPDATE `user` SET age = '$update_age',phoneNumber = '$update_contact', email = '$update_email', address = '$update_address' WHERE name = '$name'") or die('query failed');

   if(!empty($update_contact)){
      if(!preg_match ("/^(01)[0-9]{8,9}$/", $update_contact)){
         $message[] = 'invalid contact!';
      }else{
         mysqli_query($conn, "UPDATE `user` SET phoneNumber = '$update_contact' WHERE name = '$name'") or die('query failed');
         $message[] = 'contact updated successfully!';
      }
   }

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, ($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, ($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, ($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif (!preg_match ("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $new_pass)){
         $message[] = 'Password length min 8 & must contain one capital letter, one integer!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user` SET pass = '$confirm_pass' WHERE name = '$name'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'img/upload/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$update_image' WHERE name = '$name'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">


    <style>
    .profile-image {
    width: 200px; 
    height: 200px; 
    border-radius: 50%; 
    overflow: hidden; 
    margin: 0 auto; 
    border: 10px solid #008000;
}

   .profile-image img {
    width: 100%; /* Ensures the image fills the circular container */
    height: auto; /* Maintains aspect ratio */
    display: block; /* Prevents any extra spacing */

    

}

.message {
    background-color: #008000; /* Dark Green */
    color: #fff; /* White text */
    padding: 10px;
    margin: 10px auto; /* Center the message horizontally */
    border-radius: 5px;
    text-align: center; /* Center the text */
}

    </style>
</head>
<body>
    <div class="profile-container">
        <header>
            <h1>Profile Details</h1>
        </header>

        <?php
      $select = mysqli_query($conn, "SELECT * FROM `user` WHERE name = '$name'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
     ?>

        <form method="POST" action="" enctype="multipart/form-data">
        
        <?php
    if ($fetch['image'] == '') {
        echo '<div class="profile-image"><img src="img/upload/default-avatar.png"></div>';
    } else {
        echo '<div class="profile-image"><img src="img/upload/'.$fetch['image'].'"></div>';
    }
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">'.$msg.'</div>';
        }
    }
?>

            <div class="proform-group">
                <label for="name">Full Name</label>
                <input type="text" name="update_fullName" value="<?php echo $fetch['name']; ?>" >
            </div>
            <div class="proform-group">
                <label for="age">Age</label>
                <input type="text" name="update_age" value="<?php echo $fetch['age']; ?>" >
            </div>
            <div class="proform-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="update_contact" value="<?php echo $fetch['phoneNumber']; ?>" >
            </div>
            <div class="proform-group">
                <label for="address">Address</label>
                <input type="text" name="update_address" value="<?php echo $fetch['address']; ?>" >
            </div>
            <div class="proform-group">
                <label for="email">Email</label>
                <input type="text" name="update_email" value="<?php echo $fetch['email']; ?>" >
            </div>

            <input type="hidden" name="old_pass" value="<?php echo $fetch['pass']; ?>"  >
            <div class="proform-group">
                <label for="oldpassword">Old password</label>
                <input type="password" name="update_pass" placeholder="enter previous password"  >
            </div>
            <div class="proform-group">
                <label for="newpassword">New password</label>
                <input type="password" name="new_pass" placeholder="enter new password"   >
            </div>
            <div class="proform-group">
                <label for="confirmpassword">Confirm password</label>
                <input type="password" name="confirm_pass" placeholder="confirm new password" >
            </div>


            <!-- File upload for profile picture -->
            <div class="proform-group">
                <label for="profilePicture">Upload Profile Picture</label>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" >
                
            </div>

            <!-- Submit button -->
            <div class="proform-group">
                <button type="submit" name="update_profile">Update Profile</button>
            </div>
            <div class="proform-group">
                <a href="User.php" class="delete-btn">Go back</a>
            </div>
        </form>
    </div>
</body>
</html>
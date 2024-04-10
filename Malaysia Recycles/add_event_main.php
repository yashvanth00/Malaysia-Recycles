<?php


include 'Config.php';
session_start();

$name = $_SESSION['name'];

// Retrieve the image from the database based on the user's session information
$imageData = '';
$sqll = "SELECT image FROM admin WHERE name = '$name'";
$resultt = $conn->query($sqll);
if ($resultt->num_rows > 0) {
    $row = $resultt->fetch_assoc();
    $imageData = $row["image"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

<div class="sidenav">
      <div class="profile">
        <!-- Display the retrieved image -->
            <?php if (!empty($imageData)) : ?>
                <img src="img/upload/<?php echo $imageData; ?>" alt="Profile Picture">
            <?php else : ?>
                <img src="img/profile-pic.jpg" alt="Profile Picture">
            <?php endif; ?>
        <h3><?php echo $_SESSION['name'] ?></h3>
      </div>
      <a href="admin.php">Home</a>
      <a href="admin-events.php">Events</a>
      <a href="admin-eventconfirmation.php">Event Confirmation</a>
      <a href="admin-eventregistration.php">Event Registration</a>
      <a href="admin-contactus.php">Contact Us</a>
      <a href="admin-manageuser.php">Manage User Profile</a>
      <a href="admin_profile.php">Edit Profile</a>
      <a href="index.php">LogOut</a>
      
    </div>

    <div class="content">
    <h2>Add Event</h2>
    <form action="add_event.php" method="POST">
        <label for="title">Title: </label>
        <input type="text" id="title" name="title" required><br>

        <label for="date">Date: </label>
        <input type="date" id="date" name="date" required><br>

        <label for="location">Location: </label>
        <input type="text" id="location" name="location" required><br>

        <button type="submit" name="submit">Submit</button>
    </form>
   </div>

</body>
</html>

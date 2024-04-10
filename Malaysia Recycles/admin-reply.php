<?php


include 'Config.php';
session_start();

$name = $_SESSION['name'];


// Populate name, email, and original message fields
$id = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$message = $_GET['message'];

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
    <title>Contact Management System</title>
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
        <div class="reply-form">
            <h2>Reply to Message</h2>
            <form action="send_reply.php" method="post">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="number" id="id" name="id" value="<?php echo $id; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="original-message">Original Message:</label>
                    <textarea id="original-message" name="original_message" rows="4" readonly><?php echo $message; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="reply">Your Reply:</label>
                    <textarea id="reply" name="reply" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <button type="button" onclick="history.back()" class="back-button">Go Back</button>
                    <button type="submit" name="submit">Send Reply</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
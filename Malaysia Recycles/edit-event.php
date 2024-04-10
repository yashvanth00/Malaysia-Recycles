<?php
// Connect to your database
$servername = ""; 
$username = ""; 
$password = ""; 
$database = ""; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve event details based on the passed event ID
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $sql = "SELECT * FROM event WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $date = $row["date"];
        $location = $row["location"];
    } else {
        echo "Event not found";
    }
}

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
// Close the database connection
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event</title>
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
        <h2>Edit Event</h2>
        <form action="update_event.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $event_id; ?>">
            <label for="title">Title: </label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br>

            <label for="date">Date: </label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br>

            <label for="location">Location: </label>
            <input type="text" id="location" name="location" value="<?php echo $location; ?>" required><br>

            <button type="submit" name="edit">Update</button>
        </form>
    </div>

</body>
</html>

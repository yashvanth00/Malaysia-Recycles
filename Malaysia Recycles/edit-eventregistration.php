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

// Retrieve event registration details based on the passed ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM event_register WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $age = $row["age"];
        $gender = $row["gender"];
        $email = $row["email"];
        $phone_number = $row["phone_number"];
        $emergency_contact = $row["emergency_contact"];
        $event_title = $row["event_title"];
        $date = $row["date"];
    } else {
        echo "Event registration not found";
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
    <title>Edit Event Registration</title>
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
    <h2>Edit Event Registration</h2>
    <form action="update_eventregistration.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
            <option value="Other" <?php if ($gender == "Other") echo "selected"; ?>>Other</option>
        </select><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" required><br>

        <label for="emergency_contact">Emergency Contact:</label>
        <input type="tel" id="emergency_contact" name="emergency_contact" value="<?php echo $emergency_contact; ?>" required><br>

        <label for="event">Event:</label>
        <select id="event" name="event" required>
            <?php
            // Connect to your database
            $servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $database = "website"; 

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch event titles
            $sql = "SELECT title FROM event";
            $result = $conn->query($sql);

            // Check if there are any event titles
            if ($result->num_rows > 0) {
                // Loop through each row of event titles and output them as separate options
                while($row = $result->fetch_assoc()) {
                    $selected = ($event_title == $row["title"]) ? "selected" : "";
                    echo "<option value='" . $row["title"] . "' $selected>" . $row["title"] . "</option>\n";
                }
            } else {
                // If there are no event titles
                echo "<option value='' disabled>No events found</option>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </select><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br>

        <button type="submit" name="edit">Update</button>
    </form>
</div>

</body>
</html>

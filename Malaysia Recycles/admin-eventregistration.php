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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // Sanitize the input
    $delete_id = intval($_POST['delete_id']);
    
    // Delete the record from the database
    $delete_sql = "DELETE FROM event_register WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<div class='success-message'>Record deleted successfully!</div>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Query to fetch event registration data from the database
$sql = "SELECT id, name, age, gender, email, phone_number, emergency_contact, event_title, date FROM event_register";
$result = $conn->query($sql);
session_start();

$name = $_SESSION['name'];

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
    <style>
        
        .button-container {
            display: flex;
        }
        .button-container button {
            margin-right: 5px;
        }
    </style>
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
    <!-- Header Area -->
    <div class="header-area">
        <h2 style="float: left;">Event Registration</h2>
        <a href="add_event_registration.php">
        <button style="float: right; background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="window.location.href='add_event_registration.php';">Add</button>
        </a>
        <div style="clear: both;"></div>
    </div>

    <!-- Event Registration Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Emergency Contact</th>
            <th>Event</th>
            <th>Date</th>
            <th>Options</th>
        </tr>
        <?php
        // Check if there are any event registrations
        if ($result->num_rows > 0) {
            // Loop through each row of event registrations
            while($row = $result->fetch_assoc()) {
                // Display each event registration in a table row
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["age"]."</td>";
                echo "<td>".$row["gender"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["phone_number"]."</td>";
                echo "<td>".$row["emergency_contact"]."</td>";
                echo "<td>".$row["event_title"]."</td>";
                // Assuming you have a date column in your database table
                echo "<td>".$row["date"]."</td>";
                // Add edit and delete buttons here
                echo "<td class='button-container'>
                
                <a href='edit-eventregistration.php?id=".$row["id"]."' style='background-color: orange; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;'>Edit</a>
                
                            
                        <form method='post'>
                            <input type='hidden' name='delete_id' value='".$row["id"]."'>
                            <button type='submit' style='background-color: red; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If there are no event registrations in the database
            echo "<tr><td colspan='10'>No event registrations found</td></tr>";
        }
        ?>
    </table>
   </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

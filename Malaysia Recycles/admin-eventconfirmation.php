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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'status' and 'id' are set in the POST data
    if (isset($_POST['status']) && isset($_POST['id'])) {
        // Sanitize the input
        $status = $conn->real_escape_string($_POST['status']);
        $id = intval($_POST['id']);
        
        // Update the database
        $update_sql = "UPDATE event_register SET confirmation = '$status' WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {
            echo "<div class='success-message'>Update successful!</div>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

// Query to fetch event confirmation data from the database
$sql = "SELECT id, name, email, event_title, confirmation FROM event_register";
$result = $conn->query($sql);
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
        <div class="header-area">
            <h2 style="float: left;">Event Confirmation</h2>
        </div>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Event Title</th>
                <th>Status</th>
            </tr>
            <?php
            // Check if there are any event confirmations
            if ($result->num_rows > 0) {
                // Loop through each row of event confirmations
                while($row = $result->fetch_assoc()) {
                    // Display each event confirmation in a table row
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["event_title"]."</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<select name='status' class='status-dropdown'>";
                    // Set the selected option based on the database value
                    echo "<option value='going' ".($row["confirmation"] == "going" ? "selected" : "").">Going</option>";
                    echo "<option value='notgoing' ".($row["confirmation"] == "notgoing" ? "selected" : "").">Not Going</option>";
                    // Add a third option for no confirmation yet
                    echo "<option value='' ".(empty($row["confirmation"]) ? "selected" : "").">No Confirmation Yet</option>";
                    echo "</select>";
                    echo "<input type='hidden' name='id' value='".$row["id"]."'>";
                    echo "<button type='submit' class='status-button'>Update</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there are no event confirmations in the database
                echo "<tr><td colspan='5'>No event confirmations found</td></tr>";
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

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

// Query to fetch contact form entries from the database
$sql = "SELECT * FROM contact_us";
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
    <style>
        .replied {
            background-color: #d4edda; /* Add your desired styling for replied messages */
        }
    </style>

  <script>
    function replyToEntry(id, name, email, message) {
    window.location.href = "admin-reply.php?id=" + encodeURIComponent(id) + "&name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email) + "&message=" + encodeURIComponent(message);
}
    </script>
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
      <h2>Contact Form Entries</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Reply</th>
          <th>Options</th>
          
        </tr>
        <?php
        // Check if there are any contact form entries
        if ($result->num_rows > 0) {
            // Loop through each row of contact form entries
            while($row = $result->fetch_assoc()) {
                // Display each contact form entry in a table row
                echo "<tr class='" . ($row['reply'] ? 'replied' : '') . "'>"; // Add class 'replied' if the message has been replied to
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["subject"]."</td>";
                echo "<td>".$row["message"]."</td>";
                echo "<td>".$row["reply"]."</td>";
                echo "<td>
                <button class='button reply-button' onclick='replyToEntry(\"".$row["id"]."\", \"".$row["name"]."\", \"".$row["email"]."\", \"".$row["message"]."\")'>✉️ Reply</button>
                </td>";
                echo "</tr>";
            }
        } else {
            // If there are no contact form entries in the database
            echo "<tr><td colspan='5'>No contact form entries found</td></tr>";
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

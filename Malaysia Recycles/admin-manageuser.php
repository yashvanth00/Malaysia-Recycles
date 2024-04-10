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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user_id'])) {
    // Sanitize the input
    $delete_user_id = $conn->real_escape_string($_POST['delete_user_id']);
    
    // Delete the record from the database
    $delete_sql = "DELETE FROM user WHERE user_id = '$delete_user_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<div class='success-message'>Record deleted successfully!</div>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Query to fetch user data from the database
$sql = "SELECT user_id, name, age, email, image, address, phoneNumber FROM user";
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
        /* Add CSS styles for image size and table column widths */
        .profile-image img {
            width: 20%; /* Increased size of the image */
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #006400; /* Dark green background for table header */
            color: #ffffff; /* White text color for table header */
        }
        .image-column {
            text-align:center;
        }

        
        
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
        <div class="header-area">
            <h2 style="float: left;">Registered Users</h2>
            <button style="float: right; background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="window.location.href='add-user.php';">Add</button>
            <div style="clear: both;"></div>
        </div>
        
        <table>
            <tr>
                <th style="width: 5%;">User ID</th>
                <th style="width: 15%;">Name</th>
                <th style="width: 5%;">Age</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 15%;">Image</th>
                <th style="width: 20%;">Address</th>
                <th style="width: 15%;">Phone Number</th>
                <th style="width: 10%;">Options</th>
            </tr>
            <?php
            // Loop through each row of users
            while($row = $result->fetch_assoc()) {
                // Display each user in a table row
                echo "<tr>";
                echo "<td>".$row["user_id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["age"]."</td>";
                echo "<td>".$row["email"]."</td>";
                // Display the image using an <img> tag
                echo '<td class="image-column"><div class="profile-image"><img src="img/upload/'.$row['image'].'"></div></td>';
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["phoneNumber"]."</td>";
                echo "<td class='button-container'>
                    <a href='edit-manageuser.php?id=".$row["user_id"]."' style='background-color: orange; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; margin-right: 5px;'>Edit</a>
                    <form method='post'>
                         <input type='hidden' name='delete_user_id' value='".$row["user_id"]."'>
                         <button type='submit' style='background-color: red; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;'>🗑️ Delete</button>
                    </form>
                        
                      </td>";
                echo "</tr>";
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

<?php
// Connect to your database
$servername = "db-malaysiarecycles.chi2egcg0rwc.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "admin_1234";
$database = "malaysia_recycles";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO event (title, date, location) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $date, $location);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div>Event added successfully</div>";
        header('location:admin-events.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

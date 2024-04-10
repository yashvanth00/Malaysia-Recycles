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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // Update event in the database
    $sql = "UPDATE event SET title='$title', date='$date', location='$location' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to admin-events.php upon successful update
        header("Location: admin-events.php");
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

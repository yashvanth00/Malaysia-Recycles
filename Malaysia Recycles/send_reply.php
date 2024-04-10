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

// Get data from the form
$id = $_POST['id']; // Assuming you're passing 'id' from the form
$reply = $_POST['reply'];

// Update database with reply and mark as replied
$sql = "UPDATE contact_us SET reply='$reply', replied=1 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Reply sent successfully";
    header('location:admin-contactus.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

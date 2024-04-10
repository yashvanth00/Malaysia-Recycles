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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $emergency_contact = $_POST['emergency_contact'];
    $event_title = $_POST['event'];
    $date = $_POST['date'];

    // Update query
    $update_sql = "UPDATE event_register SET 
                    name = '$name', 
                    age = '$age', 
                    gender = '$gender', 
                    email = '$email', 
                    phone_number = '$phone_number', 
                    emergency_contact = '$emergency_contact', 
                    event_title = '$event_title', 
                    date = '$date' 
                    WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        // If update successful, redirect to event registration page
        header("Location: admin-eventregistration.php");
        exit();
    } else {
        // If update fails, display error message
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

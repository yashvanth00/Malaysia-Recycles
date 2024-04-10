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

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$emergency_contact = $_POST['emergency_contact'];
$event_title = $_POST['event'];
$date = $_POST['date'];

// Prepare and execute SQL statement to insert data into the event_register table
$insert_sql = "INSERT INTO event_register (name, age, gender, email, phone_number, emergency_contact, event_title, date) 
               VALUES ('$name', '$age', '$gender', '$email', '$phone_number', '$emergency_contact', '$event_title', '$date')";

if ($conn->query($insert_sql) === TRUE) {
    echo "Event registration successful!";
    header('location:admin-eventregistration.php');

} else {
    echo "Error: " . $insert_sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

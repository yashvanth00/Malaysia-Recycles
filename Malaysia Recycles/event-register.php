<?php
include 'Config.php';

// Initialize variables to store form data
$name = $email = $age = $gender = $phone_number = $emergency_contact = $event_title ="";
$agreeTerms = false;
$errorMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $emergency_contact = $_POST['emergency_contact'];
    $event_title = $_POST['event_title'];
    $date = $_POST['event_date'];
    $agreeTerms = isset($_POST['agreeTerms']); // Check if terms were agreed

    // Validate inputs and agreement to terms
    if (empty($name) || empty($email) || !$agreeTerms) {
        $errorMessage = "Please fill in all required fields and agree to the terms.";
    } else {
        // Process the registration (save to database)
        $conn = mysqli_connect('$servername','$username','$password','$database');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL statement to insert data
        $sql = "INSERT INTO event_register (name, email, age, gender, phone_number, emergency_contact, event_title, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Bind parameters and execute statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssss", $name, $email, $age, $gender, $phone_number, $emergency_contact, $event_title, $date);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to success page
            header('location:get_involved.php');
            exit();
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>

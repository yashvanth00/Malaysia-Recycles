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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $email =$_POST['email'];

    // Retrieve image data
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/upload/'.$image_name;

    // Check if image is uploaded
    if (!empty($image_name)) {
        if ($image_size > 2000000) {
            echo "Image is too large";
        } else {
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO user (name, age, address, phoneNumber, pass, image, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisssss", $name, $age, $address, $number, $pass, $image_name,$email);

            // Execute the statement
            if ($stmt->execute()) {
                // Move uploaded image to destination folder
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "<div>User added successfully</div>";
                header('location:admin-manageuser.php');
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "Please upload an image";
    }

    // Close connection
    $conn->close();
}
?>

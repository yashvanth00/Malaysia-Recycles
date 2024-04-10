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

// Check if form is submitted and the required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['name'], $_POST['age'], $_POST['email'], $_POST['address'], $_POST['number'])) {
    // Sanitize and validate the input
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $age = intval($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $phoneNumber = $conn->real_escape_string($_POST['number']);

    // Handle image upload if a new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $target_dir = "img/upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Try to upload the file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                // Update the image column in the database
                $image_name = basename($_FILES["image"]["name"]);
                $update_image_sql = "UPDATE user SET image = '$image_name' WHERE user_id = $id";
                if (!$conn->query($update_image_sql)) {
                    echo "Error updating image: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Prepare and execute SQL statement to update user details
    $update_sql = "UPDATE user SET name = '$name', age = $age, email = '$email', address = '$address', phoneNumber = '$phoneNumber' WHERE user_id = $id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='success-message'>User details updated successfully!</div>";
        header('location:admin-manageuser.php');
    } else {
        echo "Error updating user details: " . $conn->error;
    }
} else {
    echo "Invalid request. Please fill all required fields.";
}

// Close the database connection
$conn->close();
?>

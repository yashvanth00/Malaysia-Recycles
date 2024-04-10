<?php
session_start(); // Start the session.

// Check if the user is logged in.
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in.
    exit;
}

// Include database connection file here (e.g., include 'db_connect.php';)
// Make sure this file sets up a PDO connection and stores it in a variable, for example, $pdo

// Function to upload and save the profile picture
function uploadProfilePicture($file) {
    $targetDirectory = "uploads/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $targetFile = $targetDirectory . uniqid() . '.' . $imageFileType;

    // Check if image file is an actual image or fake image
    if (isset($file)) {
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($file["size"] > 500000) { // 500KB size limit for example
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    // Try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            return false;
        }
    }
}

// Process the form when it is submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form data to variables
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $confirmNewPassword = $_POST['confirmnewpassword'];

    // Initialize an error array to hold any error messages.
    $errors = [];

    // Placeholder variable for the profile picture path.
    $profilePicturePath = null;

    // If a new profile picture was uploaded, handle the upload.
    if (!empty($_FILES['profilepicture']['name'])) {
        $profilePicturePath = uploadProfilePicture($_FILES['profilepicture']);
        
        if (!$profilePicturePath) {
            $errors[] = "There was an error uploading the profile picture.";
        }
    }

    // Check if new password matches the confirm new password.
    if (!empty($newPassword) && $newPassword !== $confirmNewPassword) {
        $errors[] = "New password and confirm new password do not match.";
    }

    // If there are no errors, proceed to update the admin profile.
    if (count($errors) === 0) {
        try {
            // Update the database record for the admin user.
            // You should be checking the old password before allowing a password change.
            // This is also a very simple example and you should be hashing your passwords!

            $query = "UPDATE admins SET fullname = ?, age = ?, contactno = ?, address = ?, email = ?";
            $query_params = [$fullname, $age, $contactno, $address, $email];

            // If there is a new password, update it.
            if (!empty($newPassword)) {
                $query .= ", password = ?";
                $query_params[] = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password.
            }

            // If there is a new profile picture, update it.
            if ($profilePicturePath !== null) {
                $query .= ", profilepicture = ?";
                $query_params[] = $profilePicturePath;
            }

            $query .= " WHERE admin_id = ?";
            $query_params[] = $_SESSION['admin_id'];

            $stmt = $pdo->prepare($query);
            $stmt->execute($query_params);

            // If everything is ok, redirect to a confirmation page or display a success message.
            echo "Profile updated successfully!";
            // In real-world use, you might want to redirect to another page.
            // header('Location: success-page.php');
            // exit;
        } catch (PDOException $e) {
            // Handle potential errors here.
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // If there were errors, output them here.
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
} else {
    header('Location: edit-page.php');
    exit;
}
?>

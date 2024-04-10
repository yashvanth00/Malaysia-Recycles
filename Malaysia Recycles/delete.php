<?php
// delete_account.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect them to the login page if not logged in
    header('Location: login.php');
    exit;
}

// Process deletion after user confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you would retrieve the user's ID from session or a hidden field within the form (make sure to validate it)
    $userId = $_SESSION['user_id']; // Example user ID from session

    // Database connection
    // $db = new mysqli('localhost', 'username', 'password', 'database');
    
    // SQL query to delete the user account
    // $query = "DELETE FROM users WHERE id = ?";

    // Prepared statement to avoid SQL injection
    // $stmt = $db->prepare($query);
    // $stmt->bind_param("i", $userId);
    // $stmt->execute();

    // Check if the delete was successful
    // if ($stmt->affected_rows > 0) {
        // Handle successful account deletion, like logging the user out
        // session_destroy();
        // Redirect to index page
        header('Location: index.php');
        exit;
    // } else {
        // Handle error in account deletion
        // echo "Error deleting account.";
    // }
}

// If the form is not submitted via POST, redirect to the profile page
header('Location: profile.php');
exit;
?>

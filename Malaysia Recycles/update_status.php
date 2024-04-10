<?php
// Assuming you have a session started and a logged-in user
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Database connection (update with your actual database credentials)
    $pdo = new PDO('mysql:host=$servername','$username','$password','$database');

    // Prepare and execute the update statement
    $stmt = $pdo->prepare("UPDATE events SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);

    // Redirect back to the event confirmation page or show a success message
    header("Location: admin-eventconfirmation.php");
    exit;
}
?>

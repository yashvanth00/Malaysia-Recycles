<?php
include 'Config.php';
session_start();

// Fetch profile image path from the database
$name = $_SESSION['name'];
$query = "SELECT image FROM user WHERE name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Check if a profile image exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profile_image = $row['image'];
} else {
    // If no profile image found, use a default one
    $profile_image = 'default-avatar.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">

    <style>
    .profile-image {
    width: 200px; 
    height: 200px; 
    border-radius: 50%; 
    overflow: hidden; 
    margin: 0 auto; 
    
}

   .profile-image img {
    width: 100%; /* Ensures the image fills the circular container */
    height: auto; /* Maintains aspect ratio */
    display: block; /* Prevents any extra spacing */
    
    

}

    </style>
    
</head>
<body>
    
    <div class="dashboard-container">
        <div class="profile-section">
        <?php
            // Display profile image
            echo '<div class="profile-image"><img src="img/upload/' . $profile_image . '"></div>';
            ?>
            <h1>My name is <?php echo $_SESSION['name'] ?>.</h1>
            
        </div>
        <div class="features">
            <div class="feature-item">
                <a href="profile.php" class="feature-link">
                    <img src="img/images.png" alt="Profile">
                    <h2>Profile</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="registered_events.php" class="feature-link">
                    <img src="img/registered-events.png" alt="Registered Events">
                    <h2>Registered Events</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="get_involved.php" class="feature-link">
                    <img src="img/upcoming-events.png" alt="Upcoming Events">
                    <h2>Upcoming Events</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="logout.php" class="feature-link">
                    <img src="img/logout.png" alt="Website">
                    <h2>Log Out</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="user_about-us.php" class="feature-link">
                    <img src="img/about-us.png" alt="Website">
                    <h2>About Us</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="user_contact-us.php" class="feature-link">
                    <img src="img/contact-us.png" alt="Website">
                    <h2>Contact Us</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="user_blog.php" class="feature-link">
                    <img src="img/blog.png" alt="Website">
                    <h2>Blog</h2>
                </a>
            </div>
            <div class="feature-item">
                <a href="user_green-guide.php" class="feature-link">
                    <img src="img/green-guide.jpg" alt="Website">
                    <h2>Green Guide</h2>
                </a>
            </div>
        </div>        

    <footer class="site-footer">
        <div class="container">
            <div class="footer-about">
                <h3>Malaysia Recycles</h3>
                <p>Join us in our mission to make Malaysia greener. <br>
                    Together, we can make a difference.</p>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: info@malaysiarecycles.com</p>
                <p>Phone: +60 3-1234 5678</p>
            </div>
            <div class="footer-social">
                <h3>Follow Us</h3>
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">Twitter</a>
                <a href="#" class="social-link">Instagram</a>
            </div>
        </div>
    </footer>
</body>
</html>
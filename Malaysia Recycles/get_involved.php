<?php
session_start();
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>


<head>
    <title> Malaysia Recycles</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <nav class="navbar">
        <div class="logo">Malaysia Recycles</div>
        <ul class="nav-links">
            <li><a href="User.php">Home</a></li>
            <li><a href="user_about-us.php">About Us</a></li>
            <li><a href="user_green-guide.php">GreenGuide</a></li>
            <li><a href="get_involved.php">Upcoming Events</a></li>
            <li><a href="registered_events.php">Registered Events</a></li>
            <li><a href="user_contact-us.php">Contact Us</a></li>
            <li><a href="user_blog.php">Blog</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </nav>

        <header>
            <h1>Recycling Events - Get Involved</h1>
        </header>
        <section id="events">
            <div class="involved-container">
            <?php
            $servername = "";
			$username = "";
			$password = "";
			$database = "";

			// Create connection
			$connection = new mysqli($servername, $username, $password, $database);
            // Check connection
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
			}
            
            
            // read all row from database table
			$sql = "SELECT * FROM event";
			$result = $connection->query($sql);

            if (!$result) {
				die("Invalid query: " . $connection->error);
			}
            // read data of each row
			while($row = $result->fetch_assoc()) 
            {
                ?>
                <!-- Event 1 -->
                <div class="event">
                    <h2><?php echo $row ["title"];?></h2>
                    <p>Date: <?php echo $row ["date"];?></p>
                    <p>Location: <?php echo $row ["location"];?></p>
                    <a href="event-register-main.php?event_title=<?php echo urlencode($row["title"]); ?>&event_date=<?php echo urlencode($row["date"]); ?>&name=<?php echo urlencode($_SESSION['name']); ?>">
                         <button>Register</button>
                    </a>
                </div>
                              
               <?php

            }
            $connection->close();
?>
                
                
                
                
            </div>
        </section>

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
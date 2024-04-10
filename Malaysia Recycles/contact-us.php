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
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="green-guide.php">GreenGuide</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Login</a>
                <div class="dropdown-content">
                  <a href="admin_login.php">Admin</a><br>
                  <a href="User_login.php">User</a>
                </div>
            </li>
        </ul>
    </nav>

    <main>
        <section class="contact-section">
            <h1>Contact Us</h1>
            <form id="contactForm" action="Contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject">
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit">Send Message</button>
            </form>
        </section>

        <section class="map-section">
            <h2>Our Location</h2>
            <!-- Replace the src with your actual Google Maps link -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.1234567890!2d101.686855!3d3.139003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z4YCsMMKwMDgnMjAuMiJOIDEwMcKwNDEnMTMuNyJF!5e0!3m2!1sen!2smy!4v1234567890123"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>

    </main>


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
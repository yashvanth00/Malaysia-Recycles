
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


        <main class="registration-container">
            <header>
                <h1>Event Registration</h1>
                <p>Register to become a volunteer for <span id="eventName">[Event Name]</span>.</p>
            </header>
            
            <form id="registrationForm" action="event-register.php" method="POST">
                <div class="form-group">
                    <label for="event_title">Event Title:</label>
                    <input type="text" id="event_title" name="event_title" required>
                </div>
                <div class="form-group">
                    <label for="date">Event Date:</label>
                    <input type="text" id="event_date" name="event_date" required>
                </div>
                <div class="form-group">
                    <label for="name">Full Name: </label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone_number">
                </div>
                <div class="form-group">
                    <label for="emergency_contact">Emergency Contact:</label>
                    <input type="tel" id="emergency_contact" name="emergency_contact">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                    <label for="agreeTerms">I agree to the <a href="terms.html">Terms and Conditions</a>.</label>
                </div>
                <button type="submit">Submit Registration</button>
            </form>
        </main>

        <script>
        // Retrieve the event title and date from query parameters in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const eventTitle = urlParams.get('event_title');
        const eventDate = urlParams.get('event_date');
        const fullName = urlParams.get('name');
        
        // Update the event title and date fields in the form if provided
        if (eventTitle) {
            document.getElementById('event_title').value = eventTitle;
            document.getElementById('eventName').textContent = eventTitle;
        }
        if (eventDate) {
            document.getElementById('event_date').value = eventDate;
            document.getElementById('eventDate').textContent = eventDate;
        }
        if (fullName) {
            document.getElementById('name').value = fullName;
            
        }
    </script>


</body>
</html>
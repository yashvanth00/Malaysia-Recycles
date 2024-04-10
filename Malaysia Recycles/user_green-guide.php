<!DOCTYPE html>
<html>


<head>
    <title> Malaysia Recycles</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
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

    <main>
        <section class="recycling-centers">
            <div class="container">
                <div class="column side">
                    <h2>Search for Recycling Centers</h2>
                    <p>Find centers by location, materials, and hours.</p>
                    <form>
                        <input type="text" id="loactionInput" placeholder="Enter location">
                        <select id="materialSelect">
                            <option value="">Select material</option>
                            <option value="plastic">Plastic</option>
                            <option value="paper">Paper</option>
                            <option value="Metal">Metal</option>
                            <option value="Glass">Glass</option>
                            <option value="General Waste">General Waste</option>
                            <!-- Additional options -->
                        </select>
                        <button type="submit">Search</button>
                    </form>
                </div>
                <div class="column middle">
                    <h2>Recycling Center Locations</h2>
                    <p>Click on a location for more details.</p>
                    <div id="mapContent" style="background-color: #eee; height: 200px; text-align: center; line-height: 200px;">Map Placeholder</div>
                </div>
            </div>
        </section>

        
        <section class="recycling-guide">
            <div class="container">
                <div class="column">
                    <h2>What Can Be Recycled</h2>
                    <p>Infographics and videos explaining the recycling process.</p>
                </div>
                <div class="column">
                    <h2>Recycling Process</h2>
                    <p>Infographics and videos explaining the recycling process.</p>
                </div>
            </div>
        </section>

        <section class="tips-resources">
            <div class="container">
                <h2>Tips & Resources</h2>
                <div class="column">
                    <h3>Reducing Waste</h3>
                    <p>Practical tips and examples.</p>
                </div>
                <div class="column">
                    <h3>Recycling at Home</h3>
                    <p>Step-by-step guides.</p>
                </div>
                <div class="column">
                    <h3>Educational Resources</h3>
                    <p>Filterable repository for different audiences.</p>
                </div>
            </div>
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
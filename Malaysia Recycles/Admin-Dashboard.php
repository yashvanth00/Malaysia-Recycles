<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <header class="dashboard-header">
        HEADER
        <button class="logout-button">Logout Button</button>
    </header>
    <div class="dashboard-container">
        <aside class="dashboard-sidebar">
            <img src="profile-pic.jpg" alt="Profile Picture" class="profile-picture">
            <h3>Admin Name (Profile Page)</h3>
            <nav class="sidebar-nav">
                <a href="events-page.php">Events Page</a>
                <a href="events-confirmation.php">Event Confirmation Page</a>
                <a href="events-registration.php">Event Registration Page</a>
                <a href="contact-page.php">Contact Us Page</a>
                <a href="manage-user.php">Manage User Profile Page</a>
            </nav>
        </aside>
        <main>
            <div id="eventsCount" class="info-box">Number of Events: <span>0</span></div>
            <div id="usersCount" class="info-box">Number of Users: <span>0</span></div>
            <div id="registrationsCount" class="info-box">Total Number of Registrations: <span>0</span></div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>

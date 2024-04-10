<?php
include 'Config.php';
session_start();
$name = $_SESSION['name'];

// Function to check the confirmation status for an event
function getConfirmationStatus($connection, $eventId, $name) {
    $sql = "SELECT confirmation FROM event_register WHERE id='$eventId' AND name='$name'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['confirmation']; // Return the confirmation status
    } else {
        return ""; // If no record found, return empty string
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = $_POST['eventId'];
    $status = $_POST['status'];

    // Update confirmation status in the database
    $sql = "UPDATE event_register SET confirmation='$status' WHERE id='$eventId' AND name='$name'";
    if ($conn->query($sql) === TRUE) {
        echo "Updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Events</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function updateConfirmation(eventId, status) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Change button color to green
                    var button = document.getElementById('event' + eventId).querySelectorAll('button');
                    button[0].style.backgroundColor = status === 'going' ? 'green' : '';
                    button[1].style.backgroundColor = status === 'notgoing' ? 'green' : '';
                }
            };
            xhttp.open("POST", "", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("eventId=" + eventId + "&status=" + status);
        }
    </script>
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
        <h1>Registered Events</h1>
    </header>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "website";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    // read all row from database table
    $sql = "SELECT * FROM event_register where name='$name' ";
    $result = $connection->query($sql);

    if (!$result) {
        die("Invalid query: " . $connection->error);
    }
    // read data of each row
    while ($row = $result->fetch_assoc()) {
        $eventId = $row["id"];
        $goingStatus = getConfirmationStatus($connection, $eventId, $name);
        ?>
        <div class="registered-events-container">
            <!-- Event -->
            <div class="registered-events" id="event<?php echo $eventId; ?>">
                <h3><?php echo $row["event_title"]; ?></h3>
                <p><?php echo $row["date"]; ?></p>
                <button onclick="updateConfirmation('<?php echo $eventId; ?>', 'going')" style="background-color: <?php echo $goingStatus === 'going' ? 'green' : ''; ?>">Going</button>
                <button onclick="updateConfirmation('<?php echo $eventId; ?>', 'notgoing')" style="background-color: <?php echo $goingStatus === 'notgoing' ? 'green' : ''; ?>">Not Going</button>
            </div>
        </div>
        <?php
    }
    $connection->close();
    ?>

</body>
</html>

<?php
// Database connection
$db_host = 'localhost'; // Change this to your database host
$db_user = 'root'; // Change this to your database username
$db_pass = ''; // Change this to your database password
$db_name = 'travaldb'; // Change this to your database name

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $destination = $_POST['destination'];
    $duration = $_POST['duration'];
    $transportation = $_POST['transportation'];
    $overall = $_POST['overall'];

    // Insert data into database
    $sql = "INSERT INTO feedback_form_user (name, email, phone, date, destination, duration, transportation, overall) 
            VALUES ('$name', '$email', '$phone', '$date', '$destination', '$duration', '$transportation', '$overall')";

    if (mysqli_query($conn, $sql)) {
        header("Location: thank_you_feedback.php");   // this is the link of  thank_you_feedback.php
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>

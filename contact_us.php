<?php
// Start the session
session_start();

// Database connection
$db = mysqli_connect('localhost', 'root', '', 'travaldb');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $packages = mysqli_real_escape_string($db, $_POST['packages']);
    $message = mysqli_real_escape_string($db, $_POST['message']);

    // Insert data into database
    $query = "INSERT INTO contact_us (name, email, phone, packages, message) VALUES ('$name', '$email', '$phone', '$packages', '$message')";
    if (mysqli_query($db, $query)) {
        // Store submitted data in session
        $_SESSION['submitted_data'][] = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'packages' => $packages,
            'message' => $message
        );
        // Redirect to a thank you page
        header("Location: thank_you.php"); // Redirect to thank_you.php
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}

// Close database connection
mysqli_close($db);
?>

<?php
include('server.php');

// Initialize variables
$email = "";
$errors = array();

// If the user submits the form
if (isset($_POST['reset_password'])) {
    // Get the email from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Check if the email field is empty
    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    // Check if the email exists in the database
    $check_email_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $check_email_query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        array_push($errors, "Email is not registered. Please enter a registered email address.");
    }

    // If there are no errors, proceed with sending OTP
    if (count($errors) == 0) {
        // Generate OTP
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        // Store OTP in the database
        $insert_otp_query = "INSERT INTO reset_password (email, otp, created_at) VALUES ('$email', '$otp', NOW())";
        mysqli_query($db, $insert_otp_query);

        // Send OTP to user's email
        $to = $email;
        $subject = "Password Reset OTP";
        $message = "Your OTP for password reset is: $otp";
        $headers = "From: gajrebalraj34@gmail.com"; // Replace with your email address or use a valid email from your server
        mail($to, $subject, $message, $headers);

        // Redirect to OTP verification page
        header('location: verify_otp.php?email=' . urlencode($email));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add your CSS styles here -->
</head>
<style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    text-align: center;
}

.container {
    width: 300px;
    margin: 100px auto;
    border: 1px solid #ccc;
    padding: 40px;
    border-radius: 5px;
    background-color: #fff;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    border-radius: 3px;
    border: 1px solid #ccc;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 3px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

strong{
    color: red;
}
</style>
<body>
<div class="container">
    <h2>Forgot Password</h2>
    <form method="post" action="forgot_password.php">
        <?php include('errors.php'); ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <p> <strong>NOTE</strong> : Enter Registered Email id Only</p>
        <button type="submit" class="btn" name="reset_password">Reset Password</button>
    </form>
</div>
</body>
</html>

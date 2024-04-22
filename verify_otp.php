<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/SMTP.php';

// Database connection parameters
$servername = "localhost"; // Assuming your database is hosted locally
$username = "root"; // Replace with your database username
$password = ""; // Assuming your password is empty
$database = "travaldb"; // Replace with your database name

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Initialize variables
$email = "";
$errors = array();

// Retrieve the email parameter from the URL
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Check if the email exists in the database
    $check_email_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $check_email_query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        array_push($errors, "Email not found or OTP expired.");
    }
}

// If the user submits the form to verify OTP
if (isset($_POST['verify_otp'])) {
    // Get the OTP from the form
    $otp_entered = mysqli_real_escape_string($db, $_POST['otp']);

    // Retrieve the stored OTP from the database
    $stored_otp = $user['otp'];

    // Compare the OTPs
    if ($otp_entered == $stored_otp) {
        // OTP matched, allow the user to reset their password
        header('location: reset_password.php?email=' . urlencode($email));
        exit();
    } else {
        array_push($errors, "Invalid OTP. Please try again.");
    }
}

// Function to send OTP email using PHPMailer
function sendOTP($to, $otp) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // SMTP host
        $mail->SMTPAuth   = true;                // Enable SMTP authentication
        $mail->Username   = 'gajrebalraj34@gmail.com';  // SMTP username
        $mail->Password   = 'gajrebalraj@12';     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                 // TCP port to connect to

        //Recipients
        $mail->setFrom('gajrebalraj34@gmail.com', 'Your Name');
        $mail->addAddress($to);                   // Add a recipient

        // Content
        $mail->isHTML(true);                      // Set email format to HTML
        $mail->Subject = 'Password Reset OTP';
        $mail->Body    = "Your OTP for password reset is: $otp";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Send OTP email if there are no errors
if (count($errors) == 0) {
    // Generate OTP
    $otp = rand(100000, 999999); // Generate a 6-digit OTP

    // Store OTP in the database
    $insert_otp_query = "INSERT INTO reset_password (email, otp, created_at) VALUES ('$email', '$otp', NOW())";
    mysqli_query($db, $insert_otp_query);

    // Send OTP email
    if (!sendOTP($email, $otp)) {
        array_push($errors, "Failed to send OTP. Please try again later.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
<div class="container">
    <h2>Verify OTP</h2>
    <?php include('errors.php'); ?>
    <form method="post" action="verify_otp.php?email=<?php echo urlencode($email); ?>">
        <div class="form-group">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn" name="verify_otp">Verify OTP</button>
        <p id="resend-text">Didn't receive OTP? Resend in <span id="countdown">30</span> seconds.</p>
        <button type="button" id="resend-otp" onclick="resendOTP()" disabled>Resend OTP</button>
    </form>
</div>

<script>
    var countdown = 30;
    var countdownElement = document.getElementById('countdown');
    var resendButton = document.getElementById('resend-otp');

    function startCountdown() {
        var interval = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(interval);
                countdownElement.textContent = '';
                resendButton.textContent = 'Resend OTP';
                resendButton.disabled = false;
            }
        }, 1000);
    }

    function resendOTP() {
        // Add logic to resend OTP here
        // For demonstration purposes, let's alert the user
        alert('Resending OTP...');
        // Reset countdown and start again
        countdown = 30;
        countdownElement.textContent = countdown;
        resendButton.disabled = true;
        startCountdown();
    }

    // Start the countdown when the page loads
    window.onload = startCountdown;
</script>
</body>
</html>

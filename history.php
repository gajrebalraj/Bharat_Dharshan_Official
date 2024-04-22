<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form History</title>
</head>

<body>
    <h1>Contact Form History</h1>
    <?php if (isset($_SESSION['submitted_data']) && !empty($_SESSION['submitted_data'])): ?>
        <ul>
            <?php foreach ($_SESSION['submitted_data'] as $submission): ?>
                <li>
                    <strong>Name:</strong> <?php echo $submission['name']; ?><br>
                    <strong>Email:</strong> <?php echo $submission['email']; ?><br>
                    <strong>Phone:</strong> <?php echo $submission['phone']; ?><br>
                    <strong>Packages:</strong> <?php echo $submission['packages']; ?><br>
                    <strong>Message:</strong> <?php echo $submission['message']; ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No forms have been submitted yet.</p>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <p>User is logged in.</p>
    <?php else: ?>
    
    <?php endif; ?>

    <a href="index.php">Back to Contact Form</a>
</body>

</html>

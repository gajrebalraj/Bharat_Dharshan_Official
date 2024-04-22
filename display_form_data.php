<?php
// Start the session
session_start();

// Check if submitted data exists in session
if (isset($_SESSION['submitted_data'])) {
    $data = $_SESSION['submitted_data'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and store in session
    $data = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'email' => isset($_POST['email']) ? $_POST['email'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
        'packages' => isset($_POST['packages']) ? $_POST['packages'] : '',
        'message' => isset($_POST['message']) ? $_POST['message'] : ''
    ];

    // Check if status is set to complete and send email if it is
    if ($_POST['status'] == 'complete') {
        $to = $data['email'];
        $subject = "Form Submission Completed";
        $message = "Your form submission has been completed successfully.";
        $headers = "From: your@example.com";

        // Send email
        mail($to, $subject, $message, $headers);

        // Redirect to the next form page
        header("Location: next_form.php");
        exit();
    }

    $_SESSION['submitted_data'] = $data;
} else {
    echo '<a class="logout-btn" href="logout.php">Logout</a>';
    exit; // Exit if there's no submitted data
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Data</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}
h2{
    text-align: center;
}

nav {
    background-color: #333;
    color: #fff;
    padding: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin-right: 10px;
}

form {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

label {
    display: inline-block;
    /* width: 100px; */
    font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
    width: calc(100% - 110px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
}

textarea {
    height: 100px;
}

input[type="radio"] {
    margin-right: 5px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    display: block;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

<!-- Navigation bar -->
<nav>
    <a href="#">Home</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
</nav>

<!-- Form -->
<h2>Submitted Data</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label>Name: </label><?php echo isset($data['name']) ? $data['name'] : ''; ?><br><br>
    <label>Email: </label><?php echo isset($data['email']) ? $data['email'] : ''; ?><br><br>
    <label>Phone: </label><?php echo isset($data['phone']) ? $data['phone'] : ''; ?><br><br>
    <label>Packages: </label><?php echo isset($data['packages']) ? $data['packages'] : ''; ?><br><br>
    <label>Message: </label><?php echo isset($data['message']) ? $data['message'] : ''; ?><br><br>

    <!-- Option to mark whether the form is complete or not -->
    <label><input type="radio" name="status" value="complete" checked> Complete</label><br>
    <label><input type="radio" name="status" value="pending"> Pending</label><br><br>

    <!-- Button for saving -->
    <button type="submit" name="action" value="save">Submit</button><br>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) && $_POST['status'] == 'pending'): ?>
    <p style="color: red;">Form submission is pending. Please complete the form.</p><br>
<?php endif; ?>
</form>

</body>
</html>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Check if username and password match
        if ($_POST['username'] === 'admin' && $_POST['password'] === 'balraj') {
            // Redirect to admin page upon successful login
            header("Location: display_form_data.php");
            exit;
        } else {
            // If username or password is incorrect, set an error message
            $error_message = "Incorrect username or password. Please try again.";
        }
    } else {
        // If username or password is empty, set an error message
        $error_message = "Username and password are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Set background color */
        }

        h2 {
            text-align: center;
            margin-top: 50px; /* Adjust spacing from the top */
        }

        form {
            width: 300px; /* Set form width */
            margin: 0 auto; /* Center the form horizontally */
            background-color: #fff; /* Set form background color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow for styling */
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box; /* Ensure input box size includes padding */
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff; /* Set button background color */
            color: white; /* Set button text color */
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3; /* Change button background color on hover */
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
    <title>Admin page</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php
    // Display error message if set
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }
    ?>
    <form action="admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
